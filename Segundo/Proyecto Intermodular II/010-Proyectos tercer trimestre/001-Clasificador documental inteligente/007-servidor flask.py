#!/usr/bin/env python3
# -*- coding: utf-8 -*-

"""
Flask web app: PDF/document classifier + Markdown taxonomy tree editor + file sorter.

What it does (3 panes):
1) LEFT: Load/save a Markdown taxonomy as an editable tree (CRUD categories).
2) CENTER: Choose a *server-side* source folder (path input) and list its contents.
3) RIGHT: Choose a *server-side* destination folder (path input).
   Press "Play" -> For each file in source:
     a) extract text (PDF via pypdf; txt/md fallback; others -> skip)
     b) classify into an existing leaf category using Ollama
     c) create subfolders in destination based on category path
     d) move (or simulate with DRY RUN)
   During processing, app returns a per-file result list incl. chosen category.

Important browser note:
- Browsers cannot grant a server arbitrary filesystem access via "folder picker" safely.
- This app is intended to run locally on the same machine as the files.
- You provide folder paths (e.g. /home/josevicente/docs/inbox) in the UI.

Requirements:
  pip install flask pypdf

Run:
  python3 app.py
Open:
  http://127.0.0.1:5000

Environment options:
  OLLAMA_URL   (default http://localhost:11434/api/generate)
  OLLAMA_MODEL (default qwen2.5:3b-instruct)
  TAXONOMY_MD  (default categorias_documentales.md)
  MAX_CHARS_PER_CHUNK (default 12000)
  MIN_TEXT_LEN        (default 30)
  MAX_LABELS_IN_PROMPT (default 350)
  KEYWORD_PREFILTER_MAX (default 120)
"""

import os
import re
import json
import shutil
import mimetypes
import urllib.request
from dataclasses import dataclass
from typing import List, Dict, Optional, Tuple

from flask import Flask, request, jsonify, render_template_string
from pypdf import PdfReader


# ==========================================================
# CONFIG
# ==========================================================
APP_TITLE = "Jocarsa | Clasificador documental"
TAXONOMY_MD = os.environ.get("TAXONOMY_MD", "categorias_documentales.md")

OLLAMA_URL   = os.environ.get("OLLAMA_URL", "http://localhost:11434/api/generate")
OLLAMA_MODEL = os.environ.get("OLLAMA_MODEL", "qwen2.5:3b-instruct")

MAX_CHARS_PER_CHUNK   = int(os.environ.get("MAX_CHARS_PER_CHUNK", "12000"))
MIN_TEXT_LEN          = int(os.environ.get("MIN_TEXT_LEN", "30"))
MAX_LABELS_IN_PROMPT  = int(os.environ.get("MAX_LABELS_IN_PROMPT", "350"))
KEYWORD_PREFILTER_MAX = int(os.environ.get("KEYWORD_PREFILTER_MAX", "120"))

ALLOWED_EXTS_DEFAULT = {".pdf", ".txt", ".md"}  # expand if you add extractors


# ==========================================================
# TAXONOMY STRUCTURES
# ==========================================================
@dataclass
class LeafCategory:
    path: str
    leaf: str
    ancestors: List[str]


def parse_taxonomy_markdown(md_path: str) -> List[LeafCategory]:
    """
    Parses Markdown taxonomy:
      ## Level 1
      ### Level 2
      #### Level 3
      - Leaf

    Leaves are "- item" and path is "L1 > L2 > Leaf".
    """
    if not os.path.isfile(md_path):
        # Create a minimal taxonomy if missing
        with open(md_path, "w", encoding="utf-8") as f:
            f.write("# CATEGORÍAS DOCUMENTALES\n\n## Otros\n- Otro\n")

    header_re = re.compile(r"^(#{2,6})\s+(.+?)\s*$")
    bullet_re = re.compile(r"^\s*-\s+(.+?)\s*$")

    stack: List[Tuple[int, str]] = []
    leaves: List[LeafCategory] = []

    with open(md_path, "r", encoding="utf-8") as f:
        for raw in f:
            line = raw.rstrip("\n")

            mh = header_re.match(line.strip())
            if mh:
                level = len(mh.group(1))
                title = mh.group(2).strip()
                while stack and stack[-1][0] >= level:
                    stack.pop()
                stack.append((level, title))
                continue

            mb = bullet_re.match(line)
            if mb:
                leaf = mb.group(1).strip()
                ancestors = [t for _, t in stack]
                path = " > ".join(ancestors + [leaf]) if ancestors else leaf
                leaves.append(LeafCategory(path=path, leaf=leaf, ancestors=ancestors))
                continue

    # Deduplicate (preserve order)
    out: List[LeafCategory] = []
    seen = set()
    for c in leaves:
        k = c.path.lower()
        if k not in seen:
            seen.add(k)
            out.append(c)
    return out


def markdown_to_tree(md_path: str) -> Dict:
    """
    Convert Markdown taxonomy into a JSON tree:
      {"name":"ROOT","children":[{"name":"Admin","children":[...]}]}
    Rules:
      - Headers define intermediate nodes.
      - Bullet lines are leaves under the current header path.
    """
    leaves = parse_taxonomy_markdown(md_path)

    root = {"name": "ROOT", "children": []}

    def ensure_path(node: Dict, parts: List[str]) -> Dict:
        cur = node
        for p in parts:
            found = None
            for ch in cur["children"]:
                if ch["name"] == p:
                    found = ch
                    break
            if not found:
                found = {"name": p, "children": []}
                cur["children"].append(found)
            cur = found
        return cur

    for leaf in leaves:
        if leaf.ancestors:
            parent = ensure_path(root, leaf.ancestors)
            # add leaf under parent (if not exists)
            if not any(ch["name"] == leaf.leaf for ch in parent["children"]):
                parent["children"].append({"name": leaf.leaf, "children": []})
        else:
            # leaf directly under root
            if not any(ch["name"] == leaf.leaf for ch in root["children"]):
                root["children"].append({"name": leaf.leaf, "children": []})

    return root


def tree_to_markdown(tree: Dict, md_path: str) -> None:
    """
    Serialize JSON tree back to Markdown.
    Strategy:
      - root children become "##"
      - next levels become "###", "####", ...
      - leaf nodes become "- leaf" under their parent header
    """
    lines: List[str] = ["# CATEGORÍAS DOCUMENTALES", ""]

    def walk(node: Dict, level: int) -> None:
        children = node.get("children", [])
        if not children:
            return

        # If this node is ROOT: children are top-level headers
        if node.get("name") == "ROOT":
            for ch in children:
                lines.append("## " + ch["name"])
                # Under a header, if it has leaf children, write bullets for leaf children
                leaf_children = [c for c in ch.get("children", []) if not c.get("children")]
                branch_children = [c for c in ch.get("children", []) if c.get("children")]

                for lf in leaf_children:
                    lines.append(f"- {lf['name']}")

                # For branch children, recurse with deeper headers
                for br in branch_children:
                    walk(br, 3)  # ### for next
                lines.append("")
            return

        # For non-root nodes:
        header_prefix = "#" * max(2, min(6, level))
        lines.append(f"{header_prefix} {node['name']}")

        leaf_children = [c for c in children if not c.get("children")]
        branch_children = [c for c in children if c.get("children")]

        for lf in leaf_children:
            lines.append(f"- {lf['name']}")

        for br in branch_children:
            walk(br, level + 1)

        lines.append("")

    walk(tree, 2)

    md = "\n".join(lines).rstrip() + "\n"
    with open(md_path, "w", encoding="utf-8") as f:
        f.write(md)


# ==========================================================
# TEXT EXTRACTION
# ==========================================================
def extract_pdf_text(path: str) -> str:
    reader = PdfReader(path)
    parts: List[str] = []
    for page in reader.pages:
        t = page.extract_text() or ""
        if t.strip():
            parts.append(t)
    text = "\n".join(parts).strip()
    text = re.sub(r"[ \t]+", " ", text)
    text = re.sub(r"\n{3,}", "\n\n", text)
    return text


def extract_text_generic(path: str) -> str:
    ext = os.path.splitext(path)[1].lower()

    if ext == ".pdf":
        return extract_pdf_text(path)

    if ext in (".txt", ".md"):
        with open(path, "r", encoding="utf-8", errors="replace") as f:
            return f.read().strip()

    # Unknown file types: no extraction
    return ""


def chunk_text(text: str, max_chars: int) -> List[str]:
    if len(text) <= max_chars:
        return [text]
    chunks = []
    start = 0
    while start < len(text):
        end = min(start + max_chars, len(text))
        cut = text.rfind("\n", start, end)
        if cut == -1 or cut <= start + int(max_chars * 0.6):
            cut = end
        ch = text[start:cut].strip()
        if ch:
            chunks.append(ch)
        start = cut
    return chunks


# ==========================================================
# OLLAMA
# ==========================================================
def ollama_generate(prompt: str) -> str:
    payload = {
        "model": OLLAMA_MODEL,
        "prompt": prompt,
        "stream": False,
        "options": {"temperature": 0.0, "top_p": 1.0},
    }
    req = urllib.request.Request(
        OLLAMA_URL,
        data=json.dumps(payload).encode("utf-8"),
        headers={"Content-Type": "application/json"},
        method="POST",
    )
    with urllib.request.urlopen(req, timeout=600) as resp:
        data = json.loads(resp.read().decode("utf-8"))
    return (data.get("response") or "").strip()


def normalize_label(s: str) -> str:
    s = (s or "").strip()
    s = s.replace("\n", " ").replace("\r", " ")
    s = re.sub(r"\s+", " ", s).strip()
    return s


def keyword_prefilter(text: str, labels: List[str], max_keep: int) -> List[str]:
    t = text.lower()
    t = re.sub(r"[^a-záéíóúüñ0-9\s]", " ", t)
    tokens = [w for w in t.split() if len(w) >= 4]
    if not tokens:
        return labels[:max_keep]
    token_set = set(tokens)

    scored: List[Tuple[int, str]] = []
    for lab in labels:
        l = lab.lower()
        l = re.sub(r"[^a-záéíóúüñ0-9\s>]", " ", l)
        words = [w for w in l.split() if len(w) >= 4]
        score = sum(1 for w in words if w in token_set)
        scored.append((score, lab))

    scored.sort(key=lambda x: (-x[0], x[1]))
    top = [lab for score, lab in scored[:max_keep]]
    if scored and scored[0][0] == 0:
        return labels[:max_keep]
    return top


def choose_label_with_ollama(text: str, labels: List[str]) -> str:
    label_lines = "\n".join([f"{i+1}. {lab}" for i, lab in enumerate(labels)])
    prompt = (
        "Eres un clasificador documental.\n"
        "Debes elegir EXACTAMENTE UNA categoría de la lista (sin añadir texto extra).\n"
        "Responde con la categoría tal cual aparece (misma escritura), o si no encaja, responde: Otro\n\n"
        "CATEGORÍAS:\n"
        f"{label_lines}\n\n"
        "TEXTO DEL DOCUMENTO:\n"
        f"{text}\n\n"
        "RESPUESTA (una sola línea):"
    )
    return normalize_label(ollama_generate(prompt))


def map_response_to_known_label(resp: str, labels: List[str]) -> str:
    if not resp:
        return "Otro"
    if resp.strip().lower() == "otro":
        return "Otro"

    # number -> label
    if re.fullmatch(r"\d+", resp.strip()):
        idx = int(resp.strip()) - 1
        if 0 <= idx < len(labels):
            return labels[idx]
        return "Otro"

    # exact
    for lab in labels:
        if resp == lab:
            return lab

    # case-insensitive exact
    low = resp.lower()
    for lab in labels:
        if low == lab.lower():
            return lab

    # contains fallback
    for lab in labels:
        ll = lab.lower()
        if low in ll or ll in low:
            return lab

    return "Otro"


def classify_document(text: str, all_labels: List[str]) -> str:
    labels = all_labels
    if len(labels) > MAX_LABELS_IN_PROMPT:
        labels = keyword_prefilter(text, labels, KEYWORD_PREFILTER_MAX)

    chunks = chunk_text(text, MAX_CHARS_PER_CHUNK)
    votes: Dict[str, int] = {}
    for ch in chunks:
        resp = choose_label_with_ollama(ch, labels)
        lab = map_response_to_known_label(resp, labels)
        votes[lab] = votes.get(lab, 0) + 1

    best = sorted(votes.items(), key=lambda x: (-x[1], x[0]))[0][0]
    return best


# ==========================================================
# FILE SORTING
# ==========================================================
def sanitize_path_part(name: str) -> str:
    """
    Make safe folder names: remove slashes, control chars, etc.
    """
    name = name.strip()
    name = re.sub(r"[\/\\]+", "-", name)          # avoid path separators
    name = re.sub(r"[\x00-\x1F\x7F]+", "", name)  # control chars
    name = re.sub(r"\s+", " ", name).strip()
    if not name:
        return "Otro"
    return name[:120]


def category_to_dest_subpath(category_path: str) -> str:
    """
    "A > B > C" -> "A/B/C"
    """
    if not category_path or category_path.strip().lower() == "otro":
        return "Otro"
    parts = [sanitize_path_part(p) for p in category_path.split(">")]
    parts = [p.strip() for p in parts if p.strip()]
    if not parts:
        return "Otro"
    return os.path.join(*parts)


def list_folder(path: str) -> List[Dict]:
    if not path or not os.path.isdir(path):
        return []
    out = []
    for name in sorted(os.listdir(path)):
        full = os.path.join(path, name)
        is_dir = os.path.isdir(full)
        size = None
        if not is_dir:
            try:
                size = os.path.getsize(full)
            except OSError:
                size = None
        out.append({
            "name": name,
            "path": full,
            "is_dir": is_dir,
            "size": size,
        })
    return out


def move_or_simulate(src_file: str, dst_file: str, dry_run: bool) -> None:
    os.makedirs(os.path.dirname(dst_file), exist_ok=True)
    if dry_run:
        return
    shutil.move(src_file, dst_file)


# ==========================================================
# FLASK APP
# ==========================================================
app = Flask(__name__)
app.config["JSON_AS_ASCII"] = False


INDEX_HTML = r"""
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>{{title}}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    :root { --border:#e5e7eb; --bg:#f8fafc; --fg:#0f172a; --muted:#64748b; --accent:#0ea5e9; }
    body { margin:0; font-family: system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, "Noto Sans", Arial; color:var(--fg); background: white; }
    header { padding:12px 16px; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; }
    header h1 { font-size:16px; margin:0; font-weight:600; }
    header .meta { font-size:12px; color:var(--muted); }
    .layout { display:grid; grid-template-columns: 1.1fr 1.3fr 1.3fr; height: calc(100vh - 52px); }
    .pane { border-right:1px solid var(--border); padding:12px; overflow:auto; }
    .pane:last-child { border-right:none; }
    .pane h2 { font-size:13px; margin:0 0 10px 0; color:var(--muted); font-weight:600; text-transform:uppercase; letter-spacing:.04em; }
    .card { border:1px solid var(--border); border-radius:10px; padding:10px; background:var(--bg); }
    .row { display:flex; gap:8px; align-items:center; flex-wrap:wrap; }
    input[type="text"] { width:100%; box-sizing:border-box; padding:8px 10px; border:1px solid var(--border); border-radius:10px; background:white; }
    button { padding:8px 10px; border:1px solid var(--border); border-radius:10px; background:white; cursor:pointer; }
    button.primary { background:var(--accent); border-color:var(--accent); color:white; }
    button.danger { background:#ef4444; border-color:#ef4444; color:white; }
    button:disabled { opacity:.6; cursor:not-allowed; }
    .tree { margin-top:10px; }
    .node { padding:6px 8px; border-radius:8px; display:flex; gap:6px; align-items:center; }
    .node:hover { background:#eef2ff; }
    .node.active { background:#dbeafe; outline:1px solid #93c5fd; }
    .node .name { flex:1; }
    .node .tag { font-size:11px; color:var(--muted); }
    .indent { margin-left:16px; border-left:1px dashed var(--border); padding-left:10px; }
    .small { font-size:12px; color:var(--muted); }
    .list { margin-top:10px; }
    .item { padding:8px; border:1px solid var(--border); border-radius:10px; margin-bottom:8px; display:flex; justify-content:space-between; gap:10px; }
    .item .left { min-width:0; }
    .item .name { font-weight:600; font-size:13px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
    .item .sub { font-size:12px; color:var(--muted); overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
    .results { margin-top:10px; }
    .result { padding:8px; border:1px solid var(--border); border-radius:10px; margin-bottom:8px; }
    .result .top { display:flex; justify-content:space-between; gap:10px; }
    .result .file { font-weight:600; font-size:13px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
    .result .cat { font-size:12px; color:var(--muted); text-align:right; }
    .result .msg { font-size:12px; color:var(--muted); margin-top:6px; }
    .footerbar { margin-top:10px; display:flex; gap:10px; align-items:center; flex-wrap:wrap; }
    .pill { padding:6px 10px; border:1px solid var(--border); border-radius:999px; font-size:12px; color:var(--muted); background:white; }
    .checkbox { display:flex; gap:8px; align-items:center; font-size:12px; color:var(--muted); }
    .mono { font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New"; }
  </style>
</head>
<body>
<header>
  <h1>{{title}}</h1>
  <div class="meta">Ollama: <span class="mono" id="modelSpan"></span></div>
</header>

<div class="layout">
  <!-- LEFT: Taxonomy -->
  <div class="pane">
    <h2>Categories</h2>

    <div class="card">
      <div class="row">
        <button id="btnReloadTree">Reload</button>
        <button class="primary" id="btnSaveTree">Save</button>
        <span class="pill" id="leafCount">Leaves: -</span>
      </div>
      <div class="small" style="margin-top:8px;">
        Edit the tree (add/rename/delete). Leaves are final categories used for classification.
      </div>
    </div>

    <div class="card" style="margin-top:10px;">
      <div class="row">
        <input id="nodeName" type="text" placeholder="New / rename node name" />
        <button id="btnAddChild">Add child</button>
        <button id="btnRename">Rename</button>
        <button class="danger" id="btnDelete">Delete</button>
      </div>
      <div class="small" style="margin-top:8px;">
        Select a node in the tree, then apply actions.
      </div>
    </div>

    <div class="tree" id="tree"></div>
  </div>

  <!-- CENTER: Source folder -->
  <div class="pane">
    <h2>Source folder</h2>

    <div class="card">
      <div class="row">
        <input id="srcPath" type="text" placeholder="/path/to/source/folder" />
        <button id="btnListSrc">List</button>
      </div>
      <div class="small" style="margin-top:8px;">
        This is a server-side path. Run locally for access to your files.
      </div>
    </div>

    <div class="list" id="srcList"></div>
  </div>

  <!-- RIGHT: Destination folder + run -->
  <div class="pane">
    <h2>Destination & run</h2>

    <div class="card">
      <div class="row">
        <input id="dstPath" type="text" placeholder="/path/to/destination/folder" />
        <button id="btnListDst">List</button>
      </div>
      <div class="footerbar">
        <label class="checkbox">
          <input type="checkbox" id="dryRun" />
          DRY RUN (simulate, do not move files)
        </label>
        <button class="primary" id="btnPlay">▶ Play</button>
      </div>
      <div class="small" style="margin-top:8px;">
        On Play: each file is classified and moved into destination subfolders based on category path.
      </div>
    </div>

    <div class="list" id="dstList"></div>

    <div class="results" id="results"></div>
  </div>
</div>

<script>
let TREE = null;
let selectedPath = []; // array of names
let selectedNodeId = null; // path string key
let LEAF_PATHS = new Set();

function pathKey(pathArr){ return pathArr.join(" / "); }

function findNodeByPath(tree, pathArr){
  let cur = tree;
  for(const name of pathArr){
    const next = (cur.children || []).find(ch => ch.name === name);
    if(!next) return null;
    cur = next;
  }
  return cur;
}

function computeLeafPaths(tree){
  const leaves = [];
  function walk(node, stack){
    const children = node.children || [];
    if(node.name !== "ROOT"){
      stack = stack.concat([node.name]);
    }
    if(children.length === 0){
      if(stack.length > 0) leaves.push(stack.join(" > "));
      return;
    }
    for(const ch of children) walk(ch, stack);
  }
  for(const ch of (tree.children || [])) walk(ch, []);
  return leaves;
}

function renderTree(){
  const container = document.getElementById("tree");
  container.innerHTML = "";
  LEAF_PATHS = new Set(computeLeafPaths(TREE));

  document.getElementById("leafCount").textContent = "Leaves: " + LEAF_PATHS.size;

  function renderNode(node, pathArr){
    const div = document.createElement("div");
    div.className = "node";
    const key = pathKey(pathArr);

    if(selectedNodeId === key){
      div.classList.add("active");
    }

    const nameSpan = document.createElement("div");
    nameSpan.className = "name";
    nameSpan.textContent = node.name;

    const tag = document.createElement("div");
    tag.className = "tag";
    const isLeaf = (node.children || []).length === 0;
    tag.textContent = isLeaf ? "leaf" : "";

    div.appendChild(nameSpan);
    div.appendChild(tag);

    div.addEventListener("click", (e) => {
      e.stopPropagation();
      selectedPath = pathArr.slice();
      selectedNodeId = key;
      document.getElementById("nodeName").value = node.name;
      renderTree();
    });

    container.appendChild(div);

    const children = node.children || [];
    if(children.length){
      const ind = document.createElement("div");
      ind.className = "indent";
      container.appendChild(ind);
      const prev = container;
      // temporarily render children into ind
      const oldContainer = container;
      // can't rebind const; so use helper recursion that appends to a target
      function renderChildren(target, children, basePath){
        for(const ch of children){
          const row = document.createElement("div");
          row.className = "node";
          const chPath = basePath.concat([ch.name]);
          const chKey = pathKey(chPath);
          if(selectedNodeId === chKey) row.classList.add("active");

          const nm = document.createElement("div");
          nm.className = "name";
          nm.textContent = ch.name;

          const tg = document.createElement("div");
          tg.className = "tag";
          const isLeaf2 = (ch.children || []).length === 0;
          tg.textContent = isLeaf2 ? "leaf" : "";

          row.appendChild(nm);
          row.appendChild(tg);

          row.addEventListener("click", (e) => {
            e.stopPropagation();
            selectedPath = chPath.slice();
            selectedNodeId = chKey;
            document.getElementById("nodeName").value = ch.name;
            renderTree();
          });

          target.appendChild(row);

          if((ch.children || []).length){
            const ind2 = document.createElement("div");
            ind2.className = "indent";
            target.appendChild(ind2);
            renderChildren(ind2, ch.children, chPath);
          }
        }
      }
      renderChildren(ind, children, pathArr);
    }
  }

  // render root children as top nodes
  for(const ch of (TREE.children || [])){
    renderNode(ch, [ch.name]);
  }
}

async function apiGet(url){
  const r = await fetch(url);
  if(!r.ok) throw new Error("HTTP " + r.status);
  return await r.json();
}
async function apiPost(url, body){
  const r = await fetch(url, {method:"POST", headers:{"Content-Type":"application/json"}, body: JSON.stringify(body)});
  if(!r.ok){
    const t = await r.text();
    throw new Error("HTTP " + r.status + ": " + t);
  }
  return await r.json();
}

async function loadTree(){
  const data = await apiGet("/api/taxonomy");
  TREE = data.tree;
  document.getElementById("modelSpan").textContent = data.model;
  selectedPath = [];
  selectedNodeId = null;
  renderTree();
}

function ensureSelected(){
  if(!selectedNodeId || !selectedPath.length){
    alert("Select a node first.");
    return false;
  }
  return true;
}

function addChild(){
  if(!ensureSelected()) return;
  const name = document.getElementById("nodeName").value.trim();
  if(!name){ alert("Write a name."); return; }

  const parentPath = selectedPath.slice();
  const parentName = parentPath[parentPath.length-1];

  // Build the node reference
  const parentNode = findNodeByPath(TREE, parentPath);
  if(!parentNode){ alert("Parent not found."); return; }

  parentNode.children = parentNode.children || [];
  if(parentNode.children.some(ch => ch.name === name)){
    alert("Child already exists.");
    return;
  }
  parentNode.children.push({name, children: []});
  renderTree();
}

function renameNode(){
  if(!ensureSelected()) return;
  const newName = document.getElementById("nodeName").value.trim();
  if(!newName){ alert("Write a name."); return; }

  // rename by finding parent + replacing child name
  if(selectedPath.length === 1){
    // root child
    const node = findNodeByPath(TREE, [selectedPath[0]]);
    if(!node) return;
    node.name = newName;
    selectedPath = [newName];
    selectedNodeId = pathKey(selectedPath);
  } else {
    const parentPath = selectedPath.slice(0, -1);
    const oldName = selectedPath[selectedPath.length-1];
    const parentNode = findNodeByPath(TREE, parentPath);
    if(!parentNode) return;
    const ch = (parentNode.children || []).find(c => c.name === oldName);
    if(!ch) return;
    ch.name = newName;
    selectedPath = parentPath.concat([newName]);
    selectedNodeId = pathKey(selectedPath);
  }
  renderTree();
}

function deleteNode(){
  if(!ensureSelected()) return;
  if(!confirm("Delete selected node and all children?")) return;

  if(selectedPath.length === 1){
    const name = selectedPath[0];
    TREE.children = (TREE.children || []).filter(ch => ch.name !== name);
  } else {
    const parentPath = selectedPath.slice(0, -1);
    const name = selectedPath[selectedPath.length-1];
    const parentNode = findNodeByPath(TREE, parentPath);
    if(!parentNode) return;
    parentNode.children = (parentNode.children || []).filter(ch => ch.name !== name);
  }
  selectedPath = [];
  selectedNodeId = null;
  document.getElementById("nodeName").value = "";
  renderTree();
}

async function saveTree(){
  await apiPost("/api/taxonomy/save", {tree: TREE});
  alert("Saved.");
}

function renderFolderList(containerId, items){
  const el = document.getElementById(containerId);
  el.innerHTML = "";
  if(!items.length){
    el.innerHTML = '<div class="small">No items (or folder not accessible).</div>';
    return;
  }
  for(const it of items){
    const row = document.createElement("div");
    row.className = "item";
    const left = document.createElement("div");
    left.className = "left";
    const name = document.createElement("div");
    name.className = "name";
    name.textContent = it.name + (it.is_dir ? "/" : "");
    const sub = document.createElement("div");
    sub.className = "sub";
    sub.textContent = it.path;
    left.appendChild(name);
    left.appendChild(sub);
    row.appendChild(left);

    const right = document.createElement("div");
    right.className = "sub";
    right.textContent = it.is_dir ? "dir" : ((it.size ?? "-") + " bytes");
    row.appendChild(right);

    el.appendChild(row);
  }
}

function highlightCategoryPath(catPath){
  // We highlight by selecting a node if possible (match leaf path parts)
  if(!catPath || catPath === "Otro") return;

  const parts = catPath.split(">").map(s => s.trim()).filter(Boolean);
  if(!parts.length) return;

  // find deepest existing path
  let cur = TREE;
  let okParts = [];
  for(const p of parts){
    const next = (cur.children || []).find(ch => ch.name === p);
    if(!next) break;
    okParts.push(p);
    cur = next;
  }
  if(okParts.length){
    selectedPath = okParts;
    selectedNodeId = pathKey(okParts);
    document.getElementById("nodeName").value = okParts[okParts.length-1];
    renderTree();
  }
}

function renderResults(results){
  const el = document.getElementById("results");
  el.innerHTML = "";
  for(const r of results){
    const box = document.createElement("div");
    box.className = "result";
    const top = document.createElement("div");
    top.className = "top";

    const file = document.createElement("div");
    file.className = "file";
    file.textContent = r.file;

    const cat = document.createElement("div");
    cat.className = "cat";
    cat.textContent = r.category;

    top.appendChild(file);
    top.appendChild(cat);

    const msg = document.createElement("div");
    msg.className = "msg";
    msg.textContent = r.message || "";

    box.appendChild(top);
    box.appendChild(msg);
    el.appendChild(box);
  }
}

async function listSrc(){
  const p = document.getElementById("srcPath").value.trim();
  const data = await apiPost("/api/list_folder", {path: p});
  renderFolderList("srcList", data.items);
}
async function listDst(){
  const p = document.getElementById("dstPath").value.trim();
  const data = await apiPost("/api/list_folder", {path: p});
  renderFolderList("dstList", data.items);
}

async function play(){
  const src = document.getElementById("srcPath").value.trim();
  const dst = document.getElementById("dstPath").value.trim();
  const dry = document.getElementById("dryRun").checked;

  if(!src || !dst){
    alert("Source and destination paths are required.");
    return;
  }

  document.getElementById("btnPlay").disabled = true;
  document.getElementById("btnPlay").textContent = "Running...";

  try{
    const data = await apiPost("/api/run", {source: src, destination: dst, dry_run: dry});
    renderResults(data.results || []);
    if((data.results || []).length){
      // highlight last processed category
      const last = data.results[data.results.length - 1];
      highlightCategoryPath(last.category);
    }
    // refresh lists
    await listSrc();
    await listDst();
  } catch(e){
    alert(String(e));
  } finally {
    document.getElementById("btnPlay").disabled = false;
    document.getElementById("btnPlay").textContent = "▶ Play";
  }
}

document.getElementById("btnReloadTree").addEventListener("click", loadTree);
document.getElementById("btnSaveTree").addEventListener("click", saveTree);
document.getElementById("btnAddChild").addEventListener("click", addChild);
document.getElementById("btnRename").addEventListener("click", renameNode);
document.getElementById("btnDelete").addEventListener("click", deleteNode);

document.getElementById("btnListSrc").addEventListener("click", listSrc);
document.getElementById("btnListDst").addEventListener("click", listDst);
document.getElementById("btnPlay").addEventListener("click", play);

loadTree();
</script>

</body>
</html>
"""


@app.get("/")
def index():
    return render_template_string(INDEX_HTML, title=APP_TITLE)


@app.get("/api/taxonomy")
def api_taxonomy():
    tree = markdown_to_tree(TAXONOMY_MD)
    leaves = parse_taxonomy_markdown(TAXONOMY_MD)
    return jsonify({
        "tree": tree,
        "leaf_count": len(leaves),
        "model": OLLAMA_MODEL,
        "taxonomy_md": TAXONOMY_MD,
    })


@app.post("/api/taxonomy/save")
def api_taxonomy_save():
    data = request.get_json(force=True, silent=False) or {}
    tree = data.get("tree")
    if not isinstance(tree, dict) or tree.get("name") != "ROOT":
        return jsonify({"error": "Invalid tree format"}), 400

    # Persist to Markdown
    tree_to_markdown(tree, TAXONOMY_MD)
    return jsonify({"ok": True})


@app.post("/api/list_folder")
def api_list_folder():
    data = request.get_json(force=True, silent=False) or {}
    path = (data.get("path") or "").strip()
    items = list_folder(path)
    return jsonify({"items": items})


@app.post("/api/run")
def api_run():
    data = request.get_json(force=True, silent=False) or {}
    source = (data.get("source") or "").strip()
    dest   = (data.get("destination") or "").strip()
    dry_run = bool(data.get("dry_run", False))

    if not source or not os.path.isdir(source):
        return jsonify({"error": "Source folder not found or not a directory"}), 400
    if not dest:
        return jsonify({"error": "Destination folder required"}), 400
    if not os.path.isdir(dest):
        # create destination if missing (unless dry_run? we still can simulate without creating)
        if not dry_run:
            os.makedirs(dest, exist_ok=True)

    # Load current labels (leaves)
    leaves = parse_taxonomy_markdown(TAXONOMY_MD)
    labels = [c.path for c in leaves]
    if not labels:
        labels = ["Otro"]

    results = []

    # Only files (no recursion by default)
    names = sorted(os.listdir(source))
    for name in names:
        src_path = os.path.join(source, name)
        if os.path.isdir(src_path):
            continue

        ext = os.path.splitext(name)[1].lower()
        if ext not in ALLOWED_EXTS_DEFAULT:
            results.append({
                "file": name,
                "category": "Otro",
                "message": f"Skipped (unsupported extension: {ext})"
            })
            continue

        try:
            text = extract_text_generic(src_path)
            if len(text) < MIN_TEXT_LEN:
                category = "Otro"
                msg = "No extractable text (or too short)."
            else:
                category = classify_document(text, labels)
                msg = "Classified."

            subpath = category_to_dest_subpath(category)
            dst_folder = os.path.join(dest, subpath)
            dst_path = os.path.join(dst_folder, name)

            # Avoid overwrite: if exists, add suffix
            if os.path.exists(dst_path):
                base, ext2 = os.path.splitext(name)
                k = 2
                while True:
                    candidate = os.path.join(dst_folder, f"{base} ({k}){ext2}")
                    if not os.path.exists(candidate):
                        dst_path = candidate
                        break
                    k += 1

            move_or_simulate(src_path, dst_path, dry_run=dry_run)

            results.append({
                "file": name,
                "category": category,
                "message": (msg + (" DRY RUN (not moved)." if dry_run else f" Moved to: {dst_path}"))
            })

        except Exception as e:
            results.append({
                "file": name,
                "category": "Otro",
                "message": f"ERROR: {e}"
            })

    return jsonify({
        "ok": True,
        "dry_run": dry_run,
        "results": results
    })


if __name__ == "__main__":
    # For local use; if you deploy behind a reverse proxy, use gunicorn, etc.
    app.run(host="127.0.0.1", port=5000, debug=True)
