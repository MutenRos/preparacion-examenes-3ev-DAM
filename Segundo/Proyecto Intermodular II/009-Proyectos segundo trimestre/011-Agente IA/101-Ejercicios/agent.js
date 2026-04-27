(() => {
  const CFG = window.JV_AGENT_CONFIG || {};
  const endpoint = CFG.endpoint || "./agent.php";
  const siteToken = CFG.siteToken || "";
  const title = CFG.title || "Asistente";
  const placeholder = CFG.placeholder || "Escribe tu pregunta…";

  let csrfToken = null;
  let isOpen = false;
  let isHandshaking = false;

  function el(tag, attrs = {}, children = []) {
    const n = document.createElement(tag);
    for (const [k, v] of Object.entries(attrs)) {
      if (k === "class") n.className = v;
      else if (k === "style") n.setAttribute("style", v);
      else if (k.startsWith("on") && typeof v === "function") n.addEventListener(k.slice(2), v);
      else n.setAttribute(k, v);
    }
    for (const c of children) n.appendChild(typeof c === "string" ? document.createTextNode(c) : c);
    return n;
  }

  function escapeHtml(s) {
    return String(s)
      .replaceAll("&", "&amp;")
      .replaceAll("<", "&lt;")
      .replaceAll(">", "&gt;")
      .replaceAll('"', "&quot;")
      .replaceAll("'", "&#039;");
  }

  async function postForm(params) {
    const body = new URLSearchParams(params);
    const res = await fetch(endpoint, {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8" },
      credentials: "same-origin",
      body
    });
    const txt = await res.text();
    let json;
    try { json = JSON.parse(txt); } catch { throw new Error("Respuesta no JSON del servidor."); }
    if (!res.ok || json.ok === false) {
      throw new Error(json && json.error ? json.error : "Error del servidor.");
    }
    return json;
  }

  // ---------- UI ----------
  const style = el("style", {}, [`
    .jv-agent-btn{
      position:fixed; right:18px; bottom:18px; z-index:2147483647;
      width:56px; height:56px; border-radius:999px; border:0;
      cursor:pointer;
      box-shadow:0 10px 30px rgba(0,0,0,.18);
      background:#0f766e; color:#fff;
      display:flex; align-items:center; justify-content:center;
      font-size:22px; line-height:1;
      user-select:none;
    }
    .jv-agent-panel{
      position:fixed; right:18px; bottom:86px; z-index:2147483647;
      width:360px; max-width:calc(100vw - 36px);
      height:520px; max-height:calc(100vh - 120px);
      background:#ffffff;
      border:1px solid rgba(15,23,42,.12);
      border-radius:16px;
      box-shadow:0 18px 50px rgba(0,0,0,.20);
      overflow:hidden;
      display:none;
    }
    .jv-agent-panel.open{ display:flex; flex-direction:column; }
    .jv-agent-header{
      padding:12px 14px;
      background:#0f766e;
      color:#fff;
      display:flex; align-items:center; justify-content:space-between;
      gap:10px;
    }
    .jv-agent-title{ font-size:13px; font-weight:600; }
    .jv-agent-close{
      width:32px; height:32px; border-radius:10px; border:0;
      cursor:pointer; background:rgba(255,255,255,.14); color:#fff;
      display:flex; align-items:center; justify-content:center;
      font-size:18px;
    }
    .jv-agent-body{
      padding:12px;
      background:#f6f7fb;
      flex:1;
      overflow:auto;
      display:flex;
      flex-direction:column;
      gap:10px;
    }
    .jv-agent-bubble{
      max-width:90%;
      padding:10px 12px;
      border-radius:14px;
      border:1px solid rgba(15,23,42,.08);
      background:#fff;
      font-size:13px;
      line-height:1.35;
      color:#0f172a;
      white-space:pre-wrap;
      word-break:break-word;
    }
    .jv-agent-bubble.me{
      margin-left:auto;
      background:#ecfeff;
      border-color:rgba(14,116,144,.20);
    }
    .jv-agent-footer{
      padding:10px;
      background:#fff;
      border-top:1px solid rgba(15,23,42,.10);
      display:flex;
      gap:8px;
      align-items:flex-end;
    }
    .jv-agent-input{
      flex:1;
      min-height:42px;
      max-height:120px;
      resize:none;
      border:1px solid rgba(15,23,42,.18);
      border-radius:12px;
      padding:10px 10px;
      font-size:13px;
      outline:none;
    }
    .jv-agent-send{
      width:44px; height:44px;
      border-radius:12px; border:0;
      cursor:pointer;
      background:#0f766e; color:#fff;
      display:flex; align-items:center; justify-content:center;
      font-size:18px;
    }
    .jv-agent-send:disabled{ opacity:.55; cursor:not-allowed; }

    .jv-agent-loading{
      display:inline-flex; align-items:center; gap:8px;
      font-size:12px;
      color:rgba(15,23,42,.75);
    }
    .jv-agent-spinner{
      width:16px; height:16px;
      border-radius:999px;
      border:2px solid rgba(15,23,42,.18);
      border-top-color: rgba(15,23,42,.70);
      animation:jvspin .8s linear infinite;
    }
    @keyframes jvspin{ to{ transform:rotate(360deg); } }
  `]);

  const body = el("div", { class: "jv-agent-body" });

  const btn = el("button", {
    class: "jv-agent-btn",
    type: "button",
    "aria-label": "Abrir asistente",
    onclick: async () => {
      // Un click: abre y listo
      toggle(true);
      await ensureHandshake(); // handshake en background, pero el panel ya está abierto
      input.focus();
    }
  }, ["💬"]);

  const closeBtn = el("button", {
    class: "jv-agent-close",
    type: "button",
    "aria-label": "Cerrar",
    onclick: () => toggle(false)
  }, ["×"]);

  const header = el("div", { class: "jv-agent-header" }, [
    el("div", { class: "jv-agent-title" }, [title]),
    closeBtn
  ]);

  const input = el("textarea", {
    class: "jv-agent-input",
    placeholder,
    rows: "1"
  });

  const sendBtn = el("button", {
    class: "jv-agent-send",
    type: "button",
    "aria-label": "Enviar"
  }, ["➤"]);

  const panel = el("div", { class: "jv-agent-panel" }, [
    header,
    body,
    el("div", { class: "jv-agent-footer" }, [input, sendBtn])
  ]);

  document.head.appendChild(style);
  document.body.appendChild(btn);
  document.body.appendChild(panel);

  function toggle(open) {
    isOpen = !!open;
    panel.classList.toggle("open", isOpen);
  }

  function addBubble(text, who) {
    const b = el("div", { class: "jv-agent-bubble" + (who === "me" ? " me" : "") });
    b.innerHTML = escapeHtml(text);
    body.appendChild(b);
    body.scrollTop = body.scrollHeight;
    return b;
  }

  function addLoading() {
    const wrap = el("div", { class: "jv-agent-bubble" }, [
      el("div", { class: "jv-agent-loading" }, [
        el("div", { class: "jv-agent-spinner" }),
        el("span", {}, ["Pensando…"])
      ])
    ]);
    body.appendChild(wrap);
    body.scrollTop = body.scrollHeight;
    return wrap;
  }

  async function ensureHandshake() {
    if (csrfToken || isHandshaking) return;
    isHandshaking = true;
    try {
      const json = await postForm({ action: "handshake", siteToken });
      csrfToken = json.csrf || null;
    } finally {
      isHandshaking = false;
    }
  }

  async function send() {
    const q = (input.value || "").trim();
    if (!q) return;

    input.value = "";
    addBubble(q, "me");

    sendBtn.disabled = true;
    input.disabled = true;

    const loading = addLoading();

    try {
      await ensureHandshake();
      const json = await postForm({
        action: "ask",
        siteToken,
        csrf: csrfToken || "",
        question: q
      });

      loading.remove();
      addBubble(json.answer || "(Sin respuesta)", "ai");
    } catch (e) {
      loading.remove();
      addBubble("Error: " + (e && e.message ? e.message : "No se pudo completar la solicitud."), "ai");
    } finally {
      sendBtn.disabled = false;
      input.disabled = false;
      input.focus();
    }
  }

  // Enter para enviar, Shift+Enter para salto de línea
  input.addEventListener("keydown", (ev) => {
    if (ev.key === "Enter" && !ev.shiftKey) {
      ev.preventDefault();
      send();
    }
  });

  sendBtn.addEventListener("click", send);

  // Mensaje inicial
  addBubble("Hola. Solo respondo preguntas técnicas de programación y desarrollo. ¿Qué necesitas?", "ai");
})();

