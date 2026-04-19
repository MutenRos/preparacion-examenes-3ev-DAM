# app.py
#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import os
import re
import json
import shutil
import urllib.request
from dataclasses import dataclass
from typing import List, Dict, Tuple, Optional, Any
from flask import Flask, request, jsonify, render_template, Response

from pypdf import PdfReader


# ==========================================================
# CONFIG
# ==========================================================
APP_TITLE = "jocarsa | clasificador documental"

BASE_DIR = os.path.dirname(os.path.abspath(__file__))
DEFAULT_TAXONOMY_MD = os.path.join(BASE_DIR, "categorias_documentales.md")
TAXONOMY_MD = os.environ.get("TAXONOMY_MD", DEFAULT_TAXONOMY_MD)

OLLAMA_URL   = os.environ.get("OLLAMA_URL", "http://localhost:11434/api/generate")
OLLAMA_MODEL = os.environ.get("OLLAMA_MODEL", "qwen2.5:3b-instruct")

MAX_CHARS_PER_CHUNK   = int(os.environ.get("MAX_CHARS_PER_CHUNK", "12000"))
MIN_TEXT_LEN          = int(os.environ.get("MIN_TEXT_LEN", "30"))
MAX_LABELS_IN_PROMPT  = int(os.environ.get("MAX_LABELS_IN_PROMPT", "350"))
KEYWORD_PREFILTER_MAX = int(os.environ.get("KEYWORD_PREFILTER_MAX", "120"))

ALLOWED_EXTS = {".pdf", ".txt", ".md"}


# ==========================================================
# TAXONOMY
# ==========================================================
@dataclass
class LeafCategory:
    path: str
    leaf: str
    ancestors: List[str]


def ensure_taxonomy_exists(md_path: str) -> None:
    if not os.path.isfile(md_path):
        os.makedirs(os.path.dirname(md_path), exist_ok=True)
        with open(md_path, "w", encoding="utf-8") as f:
            f.write("# CATEGORÍAS DOCUMENTALES\n\n## Otros\n- Otro\n")


def parse_taxonomy_markdown(md_path: str) -> List[LeafCategory]:
    ensure_taxonomy_exists(md_path)

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

    # de-dup preserving order
    out: List[LeafCategory] = []
    seen = set()
    for c in leaves:
        k = c.path.lower()
        if k not in seen:
            seen.add(k)
            out.append(c)
    return out


def markdown_to_tree(md_path: str) -> Dict[str, Any]:
    leaves = parse_taxonomy_markdown(md_path)
    root = {"name": "ROOT", "children": []}

    def ensure_path(node: Dict[str, Any], parts: List[str]) -> Dict[str, Any]:
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
            if not any(ch["name"] == leaf.leaf for ch in parent["children"]):
                parent["children"].append({"name": leaf.leaf, "children": []})
        else:
            if not any(ch["name"] == leaf.leaf for ch in root["children"]):
                root["children"].append({"name": leaf.leaf, "children": []})

    return root


def tree_to_markdown(tree: Dict[str, Any], md_path: str) -> None:
    lines: List[str] = ["# CATEGORÍAS DOCUMENTALES", ""]

    def walk_root(root: Dict[str, Any]) -> None:
        for ch in root.get("children", []):
            lines.append(f"## {ch['name']}")
            leaf_children = [c for c in ch.get("children", []) if not c.get("children")]
            branch_children = [c for c in ch.get("children", []) if c.get("children")]

            for lf in leaf_children:
                lines.append(f"- {lf['name']}")

            for br in branch_children:
                walk(br, 3)

            lines.append("")

    def walk(node: Dict[str, Any], level: int) -> None:
        header_prefix = "#" * max(2, min(6, level))
        lines.append(f"{header_prefix} {node['name']}")

        children = node.get("children", [])
        leaf_children = [c for c in children if not c.get("children")]
        branch_children = [c for c in children if c.get("children")]

        for lf in leaf_children:
            lines.append(f"- {lf['name']}")

        for br in branch_children:
            walk(br, level + 1)

        lines.append("")

    if tree.get("name") != "ROOT":
        raise ValueError("Invalid tree root (expected ROOT)")

    walk_root(tree)

    md = "\n".join(lines).rstrip() + "\n"
    with open(md_path, "w", encoding="utf-8") as f:
        f.write(md)


# ==========================================================
# EXTRACTION
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
    s = (s or "").strip().replace("\n", " ").replace("\r", " ")
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

    if re.fullmatch(r"\d+", resp.strip()):
        idx = int(resp.strip()) - 1
        if 0 <= idx < len(labels):
            return labels[idx]
        return "Otro"

    for lab in labels:
        if resp == lab:
            return lab

    low = resp.lower()
    for lab in labels:
        if low == lab.lower():
            return lab

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
# FILE OPS + DEST TREE (incremental)
# ==========================================================
def sanitize_part(name: str) -> str:
    name = name.strip()
    name = re.sub(r"[\/\\]+", "-", name)
    name = re.sub(r"[\x00-\x1F\x7F]+", "", name)
    name = re.sub(r"\s+", " ", name).strip()
    return name[:120] if name else "Otro"


def category_to_subpath(category_path: str) -> str:
    if not category_path or category_path.strip().lower() == "otro":
        return "Otro"
    parts = [sanitize_part(p.strip()) for p in category_path.split(">")]
    parts = [p for p in parts if p]
    return os.path.join(*parts) if parts else "Otro"


def ensure_unique_dest(dst_folder: str, filename: str) -> str:
    os.makedirs(dst_folder, exist_ok=True)
    dst_path = os.path.join(dst_folder, filename)
    if not os.path.exists(dst_path):
        return dst_path
    base, ext = os.path.splitext(filename)
    k = 2
    while True:
        cand = os.path.join(dst_folder, f"{base} ({k}){ext}")
        if not os.path.exists(cand):
            return cand
        k += 1


def insert_into_tree(tree: Dict[str, Any], parts: List[str], filename: Optional[str] = None) -> None:
    cur = tree
    for p in parts:
        if "children" not in cur:
            cur["children"] = {}
        if p not in cur["children"]:
            cur["children"][p] = {"children": {}}
        cur = cur["children"][p]
    if filename:
        cur.setdefault("files", [])
        cur["files"].append(filename)


def list_folder(path: str) -> List[Dict[str, Any]]:
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
        out.append({"name": name, "path": full, "is_dir": is_dir, "size": size})
    return out


# ==========================================================
# SERVER-SIDE FOLDER PICKER (local GUI)
# ==========================================================
def pick_directory_dialog(title: str) -> Optional[str]:
    """
    Opens a native folder picker on the server machine.
    Works when running locally with a GUI session.
    If headless, returns None.
    """
    try:
        import tkinter as tk
        from tkinter import filedialog
        root = tk.Tk()
        root.withdraw()
        root.attributes("-topmost", True)
        path = filedialog.askdirectory(title=title)
        root.destroy()
        if not path:
            return None
        return path
    except Exception:
        return None


# ==========================================================
# FLASK
# ==========================================================
app = Flask(__name__)
app.config["JSON_AS_ASCII"] = False


@app.get("/")
def index():
    return render_template("index.html", title=APP_TITLE)


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
    tree_to_markdown(tree, TAXONOMY_MD)
    return jsonify({"ok": True})


@app.post("/api/list_folder")
def api_list_folder():
    data = request.get_json(force=True, silent=False) or {}
    path = (data.get("path") or "").strip()
    return jsonify({"items": list_folder(path)})


@app.post("/api/pick_folder")
def api_pick_folder():
    data = request.get_json(force=True, silent=False) or {}
    kind = (data.get("kind") or "folder").strip().lower()
    title = "Select folder"
    if kind == "source":
        title = "Select SOURCE folder"
    elif kind == "destination":
        title = "Select DESTINATION folder"

    path = pick_directory_dialog(title)
    if not path:
        return jsonify({"ok": False, "error": "Folder picker not available (headless) or cancelled."}), 200
    return jsonify({"ok": True, "path": path})


def sse_event(data: Dict[str, Any], event: str = "message") -> str:
    return f"event: {event}\ndata: {json.dumps(data, ensure_ascii=False)}\n\n"


@app.get("/api/run_stream")
def api_run_stream():
    """
    Server-Sent Events:
      - progressive updates after each file
      - progress bar support
      - destination tree updates incrementally
    """
    source = (request.args.get("source") or "").strip()
    dest = (request.args.get("destination") or "").strip()
    dry_run = (request.args.get("dry_run") or "0").strip() in ("1", "true", "True", "yes", "on")

    def generate():
        # Validate
        if not source or not os.path.isdir(source):
            yield sse_event({"type": "error", "message": "Source folder not found or not a directory."}, event="error")
            return
        if not dest:
            yield sse_event({"type": "error", "message": "Destination folder is required."}, event="error")
            return
        if not os.path.isdir(dest) and not dry_run:
            try:
                os.makedirs(dest, exist_ok=True)
            except Exception as e:
                yield sse_event({"type": "error", "message": f"Cannot create destination folder: {e}"}, event="error")
                return

        # Load taxonomy leaves (labels)
        leaves = parse_taxonomy_markdown(TAXONOMY_MD)
        labels = [c.path for c in leaves] or ["Otro"]

        # Build file list (files only, no recursion)
        names = sorted(os.listdir(source))
        files = []
        for name in names:
            full = os.path.join(source, name)
            if os.path.isdir(full):
                continue
            ext = os.path.splitext(name)[1].lower()
            if ext in ALLOWED_EXTS:
                files.append(name)
            else:
                # We'll still report skipped items
                files.append(name)

        total = len(files)
        dest_tree = {"children": {}}  # incremental tree (dictionary-based)

        yield sse_event({
            "type": "start",
            "total": total,
            "dry_run": dry_run,
            "source": source,
            "destination": dest,
            "model": OLLAMA_MODEL
        }, event="start")

        done = 0

        for name in files:
            done += 1
            src_path = os.path.join(source, name)
            ext = os.path.splitext(name)[1].lower()

            # Default payload
            payload = {
                "type": "file",
                "file": name,
                "index": done,
                "total": total,
                "progress": int((done * 100) / max(1, total)),
                "category": "Otro",
                "dest_path": None,
                "message": ""
            }

            if os.path.isdir(src_path):
                payload["message"] = "Skipped (directory)."
                yield sse_event(payload, event="progress")
                continue

            if ext not in ALLOWED_EXTS:
                payload["message"] = f"Skipped (unsupported extension: {ext})."
                yield sse_event(payload, event="progress")
                continue

            try:
                text = extract_text_generic(src_path)

                if len(text) < MIN_TEXT_LEN:
                    category = "Otro"
                    payload["message"] = "No extractable text (or too short)."
                else:
                    category = classify_document(text, labels)
                    payload["message"] = "Classified."

                payload["category"] = category
                subpath = category_to_subpath(category)
                dst_folder = os.path.join(dest, subpath)
                dst_path = os.path.join(dst_folder, name)

                # Insert into tree incrementally
                parts = [p.strip() for p in category.split(">")] if category and category != "Otro" else ["Otro"]
                parts = [sanitize_part(p) for p in parts if p.strip()]
                if not parts:
                    parts = ["Otro"]
                insert_into_tree(dest_tree, parts, filename=name)

                if not dry_run:
                    # create folder + choose unique name
                    final_dst = ensure_unique_dest(dst_folder, name)
                    shutil.move(src_path, final_dst)
                    payload["dest_path"] = final_dst
                    payload["message"] += f" Moved."
                else:
                    payload["dest_path"] = os.path.join(dst_folder, name)
                    payload["message"] += " DRY RUN (not moved)."

                # attach updated dest tree
                payload["dest_tree"] = dest_tree

                yield sse_event(payload, event="progress")

            except Exception as e:
                payload["message"] = f"ERROR: {e}"
                payload["dest_tree"] = dest_tree
                yield sse_event(payload, event="progress")

        yield sse_event({"type": "done", "total": total}, event="done")

    return Response(generate(), mimetype="text/event-stream")


if __name__ == "__main__":
    ensure_taxonomy_exists(TAXONOMY_MD)
    app.run(host="127.0.0.1", port=5000, debug=True)
