// static/app.js
// REPLACE your whole file with this Spanish UI version.

let TREE = null;
let selectedPath = [];
let selectedNodeId = null;

let evtSource = null; // SSE
let lastDestTree = null;

// --------------------------
// Utilidades
// --------------------------
function pathKey(arr){ return arr.join(" / "); }

function findNodeByPath(tree, pathArr){
  let cur = tree;
  for(const name of pathArr){
    const next = (cur.children || []).find(ch => ch.name === name);
    if(!next) return null;
    cur = next;
  }
  return cur;
}

function computeLeafCount(tree){
  let count = 0;
  function walk(node){
    const children = node.children || [];
    if(node.name !== "ROOT" && children.length === 0) count++;
    for(const ch of children) walk(ch);
  }
  for(const ch of (tree.children || [])) walk(ch);
  return count;
}

async function apiGet(url){
  const r = await fetch(url);
  if(!r.ok) throw new Error("HTTP " + r.status);
  return await r.json();
}

async function apiPost(url, body){
  const r = await fetch(url, {
    method:"POST",
    headers:{"Content-Type":"application/json"},
    body: JSON.stringify(body)
  });
  if(!r.ok){
    const t = await r.text();
    throw new Error("HTTP " + r.status + ": " + t);
  }
  return await r.json();
}

// --------------------------
// Paneles redimensionables
// --------------------------
function setupResizablePanes(){
  const layout = document.querySelector(".layout");
  const panes = Array.from(layout.querySelectorAll(".pane"));
  if(panes.length !== 3) return;

  const splitter1 = document.createElement("div");
  splitter1.className = "splitter";
  const splitter2 = document.createElement("div");
  splitter2.className = "splitter";

  layout.insertBefore(splitter1, panes[1]);
  layout.insertBefore(splitter2, panes[2]);

  const saved = localStorage.getItem("paneWidths");
  let w = saved ? JSON.parse(saved) : [28, 32, 40];

  function applyWidths(){
    const total = w[0] + w[1] + w[2];
    const ww = w.map(x => (x / total) * 100);
    panes[0].style.flex = `0 0 ${ww[0]}%`;
    panes[1].style.flex = `0 0 ${ww[1]}%`;
    panes[2].style.flex = `1 1 ${ww[2]}%`;
  }

  function saveWidths(){
    localStorage.setItem("paneWidths", JSON.stringify(w));
  }

  applyWidths();

  function drag(splitterIndex, startX){
    document.body.classList.add("resizing");
    const rect = layout.getBoundingClientRect();
    const start = { x: startX, w: w.slice(), width: rect.width };

    function onMove(ev){
      const dx = ev.clientX - start.x;
      const dxPct = (dx / start.width) * 100;

      if(splitterIndex === 1){
        let a = start.w[0] + dxPct;
        let b = start.w[1] - dxPct;
        const min = 15;
        if(a < min || b < min) return;
        w[0] = a; w[1] = b;
      } else {
        let b = start.w[1] + dxPct;
        let c = start.w[2] - dxPct;
        const min = 15;
        if(b < min || c < min) return;
        w[1] = b; w[2] = c;
      }
      applyWidths();
    }

    function onUp(){
      document.body.classList.remove("resizing");
      window.removeEventListener("mousemove", onMove);
      window.removeEventListener("mouseup", onUp);
      saveWidths();
    }

    window.addEventListener("mousemove", onMove);
    window.addEventListener("mouseup", onUp);
  }

  splitter1.addEventListener("mousedown", (ev) => drag(1, ev.clientX));
  splitter2.addEventListener("mousedown", (ev) => drag(2, ev.clientX));
}

// --------------------------
// Árbol de categorías (izquierda)
// --------------------------
function renderTree(){
  const container = document.getElementById("tree");
  container.innerHTML = "";

  document.getElementById("leafCount").textContent = "Hojas: " + computeLeafCount(TREE);

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
      tg.textContent = (ch.children || []).length === 0 ? "hoja" : "";

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
        const ind = document.createElement("div");
        ind.className = "indent";
        target.appendChild(ind);
        renderChildren(ind, ch.children, chPath);
      }
    }
  }

  renderChildren(container, TREE.children || [], []);
}

async function loadTree(){
  const data = await apiGet("/api/taxonomy");
  TREE = data.tree;
  //document.getElementById("modelSpan").textContent = data.model || "-";
  selectedPath = [];
  selectedNodeId = null;
  renderTree();
}

function ensureSelected(){
  if(!selectedNodeId || !selectedPath.length){
    alert("Selecciona un nodo primero.");
    return false;
  }
  return true;
}

function addChild(){
  if(!ensureSelected()) return;
  const name = document.getElementById("nodeName").value.trim();
  if(!name){ alert("Escribe un nombre."); return; }

  const parentNode = findNodeByPath(TREE, selectedPath);
  if(!parentNode){ alert("No se ha encontrado el nodo padre."); return; }

  parentNode.children = parentNode.children || [];
  if(parentNode.children.some(ch => ch.name === name)){
    alert("Ese hijo ya existe.");
    return;
  }
  parentNode.children.push({name, children: []});
  renderTree();
}

function renameNode(){
  if(!ensureSelected()) return;
  const newName = document.getElementById("nodeName").value.trim();
  if(!newName){ alert("Escribe un nombre."); return; }

  if(selectedPath.length === 1){
    const node = findNodeByPath(TREE, [selectedPath[0]]);
    node.name = newName;
    selectedPath = [newName];
  } else {
    const parentPath = selectedPath.slice(0, -1);
    const oldName = selectedPath[selectedPath.length - 1];
    const parentNode = findNodeByPath(TREE, parentPath);
    const ch = (parentNode.children || []).find(c => c.name === oldName);
    if(!ch){ alert("No se ha encontrado el nodo."); return; }
    ch.name = newName;
    selectedPath = parentPath.concat([newName]);
  }
  selectedNodeId = pathKey(selectedPath);
  renderTree();
}

function deleteNode(){
  if(!ensureSelected()) return;
  if(!confirm("¿Eliminar el nodo seleccionado y todos sus hijos?")) return;

  if(selectedPath.length === 1){
    const name = selectedPath[0];
    TREE.children = (TREE.children || []).filter(ch => ch.name !== name);
  } else {
    const parentPath = selectedPath.slice(0, -1);
    const name = selectedPath[selectedPath.length - 1];
    const parentNode = findNodeByPath(TREE, parentPath);
    parentNode.children = (parentNode.children || []).filter(ch => ch.name !== name);
  }

  selectedPath = [];
  selectedNodeId = null;
  document.getElementById("nodeName").value = "";
  renderTree();
}

async function saveTree(){
  await apiPost("/api/taxonomy/save", {tree: TREE});
  alert("Guardado.");
}

// --------------------------
// Listado de carpetas
// --------------------------
function renderFolderList(containerId, items){
  const el = document.getElementById(containerId);
  el.innerHTML = "";
  if(!items.length){
    el.innerHTML = '<div class="small">Sin elementos (o carpeta inaccesible).</div>';
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

    const right = document.createElement("div");
    right.className = "sub";
    right.textContent = it.is_dir ? "carpeta" : ((it.size ?? "-") + " bytes");

    row.appendChild(left);
    row.appendChild(right);
    el.appendChild(row);
  }
}

async function listFolderTo(containerId, path){
  const data = await apiPost("/api/list_folder", {path});
  renderFolderList(containerId, data.items || []);
}

async function pickFolder(kind){
  const data = await apiPost("/api/pick_folder", {kind});
  if(!data.ok){
    alert(data.error || "Selector de carpetas no disponible.");
    return null;
  }
  return data.path;
}

// --------------------------
// Informe destino (carpetas + archivos dentro)
// --------------------------
function renderDestReportTree(tree){
  const el = document.getElementById("destTree");
  el.innerHTML = "";

  if(!tree || !tree.children){
    el.innerHTML = '<div class="small">Aún no hay informe.</div>';
    return;
  }

  const topKeys = Object.keys(tree.children).sort((a,b)=>a.localeCompare(b));
  if(!topKeys.length){
    el.innerHTML = '<div class="small">Aún no hay informe.</div>';
    return;
  }

  function renderFolder(target, name, node){
    const row = document.createElement("div");
    row.className = "dnode";

    const icon = document.createElement("div");
    icon.textContent = "📁";

    const fname = document.createElement("div");
    fname.className = "fname";
    fname.textContent = name;

    const badge = document.createElement("div");
    badge.className = "badge";
    const fileCount = (node.files || []).length;
    const childCount = Object.keys(node.children || {}).length;
    badge.textContent = `${childCount} subcarpetas · ${fileCount} archivos`;

    row.appendChild(icon);
    row.appendChild(fname);
    row.appendChild(badge);
    target.appendChild(row);

    const ind = document.createElement("div");
    ind.className = "dindent";
    target.appendChild(ind);

    const childKeys = Object.keys(node.children || {}).sort((a,b)=>a.localeCompare(b));
    for(const k of childKeys){
      renderFolder(ind, k, node.children[k]);
    }

    const files = (node.files || []).slice().sort((a,b)=>a.localeCompare(b));
    for(const f of files){
      const fr = document.createElement("div");
      fr.className = "dnode";

      const ic = document.createElement("div");
      ic.textContent = "📄";

      const fn = document.createElement("div");
      fn.className = "fname";
      fn.textContent = f;

      const b = document.createElement("div");
      b.className = "badge";
      b.textContent = "archivo";

      fr.appendChild(ic);
      fr.appendChild(fn);
      fr.appendChild(b);
      ind.appendChild(fr);
    }
  }

  for(const k of topKeys){
    renderFolder(el, k, tree.children[k]);
  }
}

// --------------------------
// Progreso + resultados
// --------------------------
function setProgress(pct, fileText){
  const bar = document.getElementById("progressBar");
  const txt = document.getElementById("progressText");
  const file = document.getElementById("progressFile");

  bar.style.width = `${pct}%`;
  txt.textContent = `${pct}%`;
  file.textContent = fileText || "-";
}

function addResultRow(r){
  const el = document.getElementById("results");

  const box = document.createElement("div");
  box.className = "result";

  const top = document.createElement("div");
  top.className = "top";

  const file = document.createElement("div");
  file.className = "file";
  file.textContent = r.file;

  const cat = document.createElement("div");
  cat.className = "cat";
  cat.textContent = r.category || "Otro";

  top.appendChild(file);
  top.appendChild(cat);

  const msg = document.createElement("div");
  msg.className = "msg";
  msg.textContent = r.message || "";

  box.appendChild(top);
  box.appendChild(msg);

  el.insertBefore(box, el.firstChild);
}

// --------------------------
// Ejecución en streaming (SSE)
// --------------------------
function stopRun(){
  if(evtSource){
    evtSource.close();
    evtSource = null;
  }
  document.getElementById("btnPlay").disabled = false;
  document.getElementById("btnStop").disabled = true;
  document.getElementById("btnPlay").textContent = "▶ Ejecutar";
}

function startRun(){
  const src = document.getElementById("srcPath").value.trim();
  const dst = document.getElementById("dstPath").value.trim();
  const dry = document.getElementById("dryRun").checked ? "1" : "0";

  if(!src || !dst){
    alert("Debes indicar la carpeta de origen y la carpeta de destino.");
    return;
  }

  document.getElementById("results").innerHTML = "";
  setProgress(0, "-");
  renderDestReportTree({children:{}});

  document.getElementById("btnPlay").disabled = true;
  document.getElementById("btnStop").disabled = false;
  document.getElementById("btnPlay").textContent = "Procesando...";

  const url = `/api/run_stream?source=${encodeURIComponent(src)}&destination=${encodeURIComponent(dst)}&dry_run=${dry}`;
  evtSource = new EventSource(url);

  evtSource.addEventListener("start", (ev) => {
    const data = JSON.parse(ev.data);
    setProgress(0, `Iniciando… (${data.total} archivos)`);
  });

  evtSource.addEventListener("progress", async (ev) => {
    const data = JSON.parse(ev.data);

    setProgress(data.progress || 0, `${data.index}/${data.total}: ${data.file}`);
    addResultRow(data);

    if(data.dest_tree){
      lastDestTree = data.dest_tree;
      renderDestReportTree(lastDestTree);
    }

    if(data.index % 3 === 0){
      await listFolderTo("srcList", src);
      await listFolderTo("dstList", dst);
    }
  });

  evtSource.addEventListener("done", async (ev) => {
    const data = JSON.parse(ev.data);
    setProgress(100, `Finalizado (${data.total} archivos).`);
    await listFolderTo("srcList", src);
    await listFolderTo("dstList", dst);
    stopRun();
  });

  evtSource.addEventListener("error", (ev) => {
    try{
      if(ev && ev.data){
        const data = JSON.parse(ev.data);
        alert(data.message || "Error.");
      } else {
        alert("Error de conexión (SSE).");
      }
    } catch {
      alert("Error.");
    }
    stopRun();
  });
}

// --------------------------
// Enlazar UI
// --------------------------
document.getElementById("btnReloadTree").addEventListener("click", loadTree);
document.getElementById("btnSaveTree").addEventListener("click", saveTree);
document.getElementById("btnAddChild").addEventListener("click", addChild);
document.getElementById("btnRename").addEventListener("click", renameNode);
document.getElementById("btnDelete").addEventListener("click", deleteNode);

document.getElementById("btnListSrc").addEventListener("click", async () => {
  const p = document.getElementById("srcPath").value.trim();
  await listFolderTo("srcList", p);
});
document.getElementById("btnListDst").addEventListener("click", async () => {
  const p = document.getElementById("dstPath").value.trim();
  await listFolderTo("dstList", p);
});

document.getElementById("btnPickSrc").addEventListener("click", async () => {
  const p = await pickFolder("source");
  if(p){
    document.getElementById("srcPath").value = p;
    await listFolderTo("srcList", p);
  }
});
document.getElementById("btnPickDst").addEventListener("click", async () => {
  const p = await pickFolder("destination");
  if(p){
    document.getElementById("dstPath").value = p;
    await listFolderTo("dstList", p);
  }
});

document.getElementById("btnPlay").addEventListener("click", startRun);
document.getElementById("btnStop").addEventListener("click", stopRun);

// Init
setupResizablePanes();
loadTree();
