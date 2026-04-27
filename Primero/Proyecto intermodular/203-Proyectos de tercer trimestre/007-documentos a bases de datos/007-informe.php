<?php
declare(strict_types=1);

/**
 * viewer.php (CSS claro, limpio, plano y profesional)
 * - Lee out/modules.json
 * - UI con desplegables por módulo: info, RA+criterios, contenidos (unidades/subunidades)
 */

function h(string $s): string {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

$JSON_PATH = __DIR__ . DIRECTORY_SEPARATOR . 'out' . DIRECTORY_SEPARATOR . 'modules.json';

$err = "";
$data = null;

if (!file_exists($JSON_PATH)) {
  $err = "No se encuentra el archivo JSON en: " . $JSON_PATH;
} else {
  $raw = file_get_contents($JSON_PATH);
  if ($raw === false) {
    $err = "No se ha podido leer el archivo JSON.";
  } else {
    $data = json_decode($raw, true);
    if (!is_array($data)) {
      $err = "JSON inválido o no se ha podido parsear. Revisa out/modules.json.";
    }
  }
}

$modules = [];
if (!$err && isset($data["modules"]) && is_array($data["modules"])) {
  $modules = $data["modules"];
}

usort($modules, function($a, $b){
  $na = mb_strtolower((string)($a["name"] ?? ""));
  $nb = mb_strtolower((string)($b["name"] ?? ""));
  return $na <=> $nb;
});

?><!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Visor de módulos (modules.json)</title>
  <style>
    :root{
      --bg:#f6f7f9;
      --panel:#ffffff;
      --text:#1f2937;
      --muted:#6b7280;
      --border:#e5e7eb;
      --accent:#2563eb;   /* azul profesional */
      --accent2:#111827;  /* casi negro */
      --soft:#f3f4f6;
      --radius:10px;
      --shadow: 0 1px 2px rgba(16,24,40,0.06), 0 6px 18px rgba(16,24,40,0.06);
      --mono: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
      --sans: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial;
    }

    *{ box-sizing:border-box; }
    html,body{ height:100%; }
    body{
      margin:0;
      font-family:var(--sans);
      background:var(--bg);
      color:var(--text);
    }

    header{
      background:var(--panel);
      border-bottom:1px solid var(--border);
    }

    .wrap{
      max-width:1200px;
      margin:0 auto;
      padding:16px;
    }

    .top{
      display:flex;
      align-items:flex-start;
      justify-content:space-between;
      gap:14px;
      flex-wrap:wrap;
    }

    h1{
      margin:0;
      font-size:16px;
      font-weight:700;
      color:var(--accent2);
    }

    .meta{
      margin-top:6px;
      color:var(--muted);
      font-size:12px;
      display:flex;
      gap:10px;
      flex-wrap:wrap;
    }

    .badge{
      display:inline-flex;
      gap:8px;
      align-items:center;
      padding:6px 10px;
      border:1px solid var(--border);
      border-radius:999px;
      background:#fff;
    }

    code.inline{
      font-family:var(--mono);
      font-size:12px;
      background:var(--soft);
      border:1px solid var(--border);
      padding:2px 6px;
      border-radius:7px;
      color:var(--accent2);
    }

    .controls{
      display:flex;
      gap:10px;
      align-items:center;
      flex-wrap:wrap;
    }

    .search{
      display:flex;
      align-items:center;
      gap:8px;
      padding:8px 10px;
      border:1px solid var(--border);
      border-radius:10px;
      background:#fff;
      min-width:320px;
    }
    .search input{
      width:100%;
      border:0;
      outline:none;
      font-size:13px;
      color:var(--text);
      background:transparent;
    }

    .btn{
      border:1px solid var(--border);
      background:#fff;
      color:var(--text);
      padding:8px 10px;
      border-radius:10px;
      font-size:13px;
      cursor:pointer;
      user-select:none;
    }
    .btn:hover{
      background:var(--soft);
    }
    .btn.primary{
      border-color: rgba(37,99,235,0.35);
      background: rgba(37,99,235,0.10);
      color: var(--accent);
    }
    .btn.primary:hover{
      background: rgba(37,99,235,0.14);
    }

    main .wrap{ padding-top:16px; padding-bottom:28px; }

    .grid{
      display:grid;
      grid-template-columns: 360px 1fr;
      gap:14px;
      align-items:start;
    }
    @media (max-width: 980px){
      .grid{ grid-template-columns:1fr; }
      .search{ min-width:unset; width:100%; }
    }

    .panel{
      background:var(--panel);
      border:1px solid var(--border);
      border-radius:var(--radius);
      box-shadow:var(--shadow);
      overflow:hidden;
    }
    .panel .head{
      padding:12px 14px;
      border-bottom:1px solid var(--border);
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:12px;
    }
    .panel .head h2{
      margin:0;
      font-size:12px;
      letter-spacing:0.08em;
      color:var(--muted);
      font-weight:700;
      text-transform:uppercase;
    }
    .panel .body{ padding:12px 14px; }

    .error{
      margin-top:12px;
      padding:12px 14px;
      border:1px solid #fecaca;
      background:#fff1f2;
      color:#7f1d1d;
      border-radius:10px;
      font-size:13px;
    }

    .list{
      display:flex;
      flex-direction:column;
      gap:8px;
      max-height: calc(100vh - 190px);
      overflow:auto;
      padding-right:6px;
    }

    .item{
      border:1px solid var(--border);
      border-radius:10px;
      padding:10px;
      background:#fff;
      cursor:pointer;
    }
    .item:hover{ background:var(--soft); }
    .item.active{
      border-color: rgba(37,99,235,0.45);
      box-shadow: 0 0 0 3px rgba(37,99,235,0.10);
    }
    .item .name{
      font-size:13px;
      font-weight:700;
      line-height:1.25;
      color:var(--accent2);
    }
    .item .sub{
      margin-top:6px;
      display:flex;
      gap:8px;
      flex-wrap:wrap;
      font-size:12px;
      color:var(--muted);
    }
    .pill{
      font-family:var(--mono);
      font-size:11px;
      padding:2px 8px;
      border:1px solid var(--border);
      border-radius:999px;
      background:var(--soft);
      color:var(--muted);
    }

    .details .empty{
      padding:12px 2px;
      color:var(--muted);
      font-size:13px;
    }

    details{
      border-top:1px solid var(--border);
    }
    details:first-of-type{ border-top:0; }

    summary{
      list-style:none;
      cursor:pointer;
      padding:12px 14px;
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:12px;
      user-select:none;
    }
    summary::-webkit-details-marker{ display:none; }

    .sum-left{
      display:flex;
      flex-direction:column;
      gap:3px;
      min-width:0;
    }
    .sum-title{
      font-weight:700;
      font-size:13px;
      color:var(--accent2);
      white-space:nowrap;
      overflow:hidden;
      text-overflow:ellipsis;
    }
    .sum-desc{
      font-size:12px;
      color:var(--muted);
    }

    .chev{
      width:10px; height:10px;
      border-right:2px solid var(--muted);
      border-bottom:2px solid var(--muted);
      transform: rotate(-45deg);
      transition: transform .15s ease;
      flex:0 0 auto;
      margin-left:8px;
    }
    details[open] .chev{ transform: rotate(45deg); }

    .section{
      padding:0 14px 14px 14px;
      font-size:13px;
      color:var(--text);
    }

    .kv{
      display:grid;
      grid-template-columns: 160px 1fr;
      gap:8px 12px;
      padding-top:4px;
    }
    .k{ color:var(--muted); }
    .v{ color:var(--text); }

    .hr{
      height:1px;
      background:var(--border);
      margin:12px 0;
    }

    .card{
      border:1px solid var(--border);
      border-radius:10px;
      background:#fff;
      padding:12px;
      margin:10px 0;
    }

    .ra-title{
      margin:0;
      font-weight:700;
      font-size:13px;
      color:var(--accent2);
    }
    .ra-text{
      margin:8px 0 0 0;
      color:var(--muted);
      line-height:1.45;
    }

    ul.criteria, ul.subunits{
      margin:10px 0 0 0;
      padding-left:18px;
    }
    ul.criteria li, ul.subunits li{
      margin:6px 0;
      line-height:1.45;
    }
    ul.criteria li span{
      color:var(--muted);
      font-family:var(--mono);
      font-size:12px;
      margin-right:6px;
    }

    .unit{
      border:1px solid var(--border);
      border-radius:10px;
      background:#fff;
      margin:10px 0;
      overflow:hidden;
    }
    .unit-head{
      padding:10px 12px;
      border-bottom:1px solid var(--border);
      background:var(--soft);
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:10px;
    }
    .u-title{
      font-weight:700;
      font-size:13px;
      color:var(--accent2);
      white-space:nowrap;
      overflow:hidden;
      text-overflow:ellipsis;
    }
    .unit-body{
      padding:10px 12px;
    }

    footer{
      border-top:1px solid var(--border);
      background:#fff;
      color:var(--muted);
      font-size:12px;
      padding:12px 16px;
      text-align:center;
    }

    .muted{ color:var(--muted); }
  </style>
</head>
<body>

<header>
  <div class="wrap">
    <div class="top">
      <div>
        <h1>Visor de módulos profesionales</h1>
        <div class="meta">
          <div class="badge">JSON: <code class="inline"><?php echo h(str_replace(__DIR__ . DIRECTORY_SEPARATOR, "", $JSON_PATH)); ?></code></div>
          <div class="badge">Módulos: <strong id="modCount"><?php echo (int)count($modules); ?></strong></div>
          <?php if(!$err && isset($data["source"])): ?>
            <div class="badge">Fuente: <strong><?php echo h((string)$data["source"]); ?></strong></div>
          <?php endif; ?>
        </div>
      </div>

      <div class="controls">
        <div class="search" title="Filtrar por nombre o código">
          <span class="muted" style="font-size:12px;">Buscar</span>
          <input id="q" type="text" placeholder="Nombre del módulo o código..." autocomplete="off" />
        </div>
        <button class="btn" id="expandAll">Expandir</button>
        <button class="btn" id="collapseAll">Contraer</button>
        <button class="btn primary" id="clearSel">Quitar selección</button>
      </div>
    </div>

    <?php if($err): ?>
      <div class="error">
        <strong>Error:</strong> <?php echo h($err); ?><br/>
        Comprueba que existe <code class="inline">out/modules.json</code> y que el JSON es válido.
      </div>
    <?php endif; ?>
  </div>
</header>

<main>
  <div class="wrap">
    <div class="grid">
      <!-- Lista -->
      <section class="panel">
        <div class="head">
          <h2>Asignaturas / módulos</h2>
          <div class="badge"><span class="muted">Filtrados:</span> <strong id="filteredCount"><?php echo (int)count($modules); ?></strong></div>
        </div>
        <div class="body">
          <div class="list" id="moduleList" aria-label="Lista de módulos">
            <?php if(!$err && count($modules) > 0): ?>
              <?php foreach($modules as $idx => $m): ?>
                <?php
                  $name = (string)($m["name"] ?? ("Módulo #" . ($idx+1)));
                  $code = (string)($m["code"] ?? "");
                  $ects = $m["ects"] ?? null;
                  $dur  = (string)($m["duration"] ?? "");
                  $raCount = is_array($m["learning_outcomes"] ?? null) ? count($m["learning_outcomes"]) : 0;
                  $udCount = is_array($m["unidades_didacticas"] ?? null) ? count($m["unidades_didacticas"]) : 0;
                ?>
                <div class="item"
                     role="button"
                     tabindex="0"
                     data-idx="<?php echo (int)$idx; ?>"
                     data-name="<?php echo h(mb_strtolower($name)); ?>"
                     data-code="<?php echo h(mb_strtolower($code)); ?>">
                  <div class="name"><?php echo h($name); ?></div>
                  <div class="sub">
                    <?php if($code !== ""): ?><span class="pill">COD <?php echo h($code); ?></span><?php endif; ?>
                    <?php if(is_int($ects) || is_float($ects)): ?><span class="pill"><?php echo (int)$ects; ?> ECTS</span><?php endif; ?>
                    <?php if($dur !== ""): ?><span class="pill"><?php echo h($dur); ?></span><?php endif; ?>
                    <span class="pill">RA <?php echo (int)$raCount; ?></span>
                    <span class="pill">UD <?php echo (int)$udCount; ?></span>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <div class="muted">No hay módulos para mostrar.</div>
            <?php endif; ?>
          </div>
        </div>
      </section>

      <!-- Detalle -->
      <section class="panel details">
        <div class="head">
          <h2>Detalle</h2>
          <div class="badge"><span class="muted">Seleccionado:</span> <strong id="selName">Ninguno</strong></div>
        </div>
        <div class="body" id="detailsBody">
          <div class="empty">Selecciona un módulo a la izquierda para ver su información.</div>
        </div>
      </section>
    </div>
  </div>
</main>

<footer>
  Viewer local · PHP lee <code class="inline">out/modules.json</code> · Desplegables: info / RA / contenidos
</footer>

<script>
  const DATA = <?php echo $err ? "null" : json_encode($modules, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;

  const $ = (sel, el=document) => el.querySelector(sel);
  const $$ = (sel, el=document) => Array.from(el.querySelectorAll(sel));

  const moduleList = $("#moduleList");
  const detailsBody = $("#detailsBody");
  const selName = $("#selName");
  const q = $("#q");
  const filteredCount = $("#filteredCount");

  let currentIdx = null;

  function esc(s){
    return String(s ?? "")
      .replaceAll("&", "&amp;")
      .replaceAll("<", "&lt;")
      .replaceAll(">", "&gt;")
      .replaceAll('"', "&quot;")
      .replaceAll("'", "&#039;");
  }

  function expandCollapseAll(open){
    $$("#detailsBody details").forEach(d => d.open = !!open);
  }

  function setActiveItem(idx){
    $$(".item", moduleList).forEach(el => {
      el.classList.toggle("active", Number(el.dataset.idx) === idx);
    });
  }

  function applyFilter(){
    const term = (q.value || "").trim().toLowerCase();
    let count = 0;
    $$(".item", moduleList).forEach(el => {
      const name = el.dataset.name || "";
      const code = el.dataset.code || "";
      const ok = !term || name.includes(term) || code.includes(term);
      el.style.display = ok ? "" : "none";
      if(ok) count++;
    });
    filteredCount.textContent = String(count);
  }

  function renderDetails(idx){
    if(!DATA || !DATA[idx]){
      detailsBody.innerHTML = `<div class="empty">No hay datos del módulo seleccionado.</div>`;
      selName.textContent = "Ninguno";
      currentIdx = null;
      return;
    }

    currentIdx = idx;
    const m = DATA[idx];

    const name = m.name ?? ("Módulo #" + (idx+1));
    selName.textContent = name;

    const code = m.code ?? "";
    const ects = (m.ects ?? null);
    const duration = m.duration ?? "";

    const ras = Array.isArray(m.learning_outcomes) ? m.learning_outcomes : [];
    const uds = Array.isArray(m.unidades_didacticas) ? m.unidades_didacticas : [];
    const flat = Array.isArray(m.contenidos_minimos) ? m.contenidos_minimos : [];

    const infoHTML = `
      <div class="section">
        <div class="kv">
          <div class="k">Nombre</div><div class="v">${esc(name)}</div>
          <div class="k">Código</div><div class="v">${code ? esc(code) : '<span class="muted">—</span>'}</div>
          <div class="k">ECTS</div><div class="v">${(ects !== null && ects !== undefined) ? esc(ects) : '<span class="muted">—</span>'}</div>
          <div class="k">Duración</div><div class="v">${duration ? esc(duration) : '<span class="muted">—</span>'}</div>
          <div class="k">RA (count)</div><div class="v">${ras.length}</div>
          <div class="k">Unidades (count)</div><div class="v">${uds.length}</div>
        </div>
      </div>
    `;

    let raHTML = "";
    if(ras.length === 0){
      raHTML = `<div class="section"><div class="muted">No se han detectado resultados de aprendizaje en el JSON.</div></div>`;
    } else {
      raHTML = `<div class="section">` + ras.map(ra => {
        const num = ra.number ?? "";
        const text = ra.text ?? "";
        const criteria = Array.isArray(ra.criteria) ? ra.criteria : [];
        return `
          <div class="card">
            <p class="ra-title">RA ${esc(num)}.</p>
            <p class="ra-text">${esc(text)}</p>
            <div class="hr"></div>
            ${
              criteria.length
                ? `<ul class="criteria">` + criteria.map((c,i)=>`<li><span>${String.fromCharCode(97+i)})</span>${esc(c)}</li>`).join("") + `</ul>`
                : `<div class="muted">Sin criterios detectados para este RA.</div>`
            }
          </div>
        `;
      }).join("") + `</div>`;
    }

    let contHTML = "";
    if(uds.length === 0){
      contHTML = `<div class="section"><div class="muted">No se han detectado unidades didácticas derivadas en el JSON.</div></div>`;
    } else {
      contHTML = `<div class="section">` + uds.map(u => {
        const ut = u.unidad ?? "Unidad";
        const subs = Array.isArray(u.subunidades) ? u.subunidades : [];
        return `
          <div class="unit">
            <div class="unit-head">
              <div class="u-title">${esc(ut)}</div>
              <div class="pill">${subs.length} subunidades</div>
            </div>
            <div class="unit-body">
              ${
                subs.length
                  ? `<ul class="subunits">` + subs.map(s=>`<li>${esc(s)}</li>`).join("") + `</ul>`
                  : `<div class="muted">Sin subunidades detectadas.</div>`
              }
            </div>
          </div>
        `;
      }).join("") + `</div>`;
    }

    const flatHTML = flat.length
      ? `<div class="section"><ul class="subunits">${flat.map(s=>`<li>${esc(s)}</li>`).join("")}</ul></div>`
      : `<div class="section"><div class="muted">No hay lista plana de contenidos mínimos.</div></div>`;

    detailsBody.innerHTML = `
      <details open>
        <summary>
          <div class="sum-left">
            <div class="sum-title">Información del módulo</div>
            <div class="sum-desc">Código, ECTS, duración y contadores</div>
          </div>
          <span class="chev" aria-hidden="true"></span>
        </summary>
        ${infoHTML}
      </details>

      <details open>
        <summary>
          <div class="sum-left">
            <div class="sum-title">Resultados de aprendizaje y criterios</div>
            <div class="sum-desc">RA + criterios de evaluación</div>
          </div>
          <span class="chev" aria-hidden="true"></span>
        </summary>
        ${raHTML}
      </details>

      <details open>
        <summary>
          <div class="sum-left">
            <div class="sum-title">Contenidos por unidades y subunidades</div>
            <div class="sum-desc">Unidades derivadas desde “Contenidos básicos”</div>
          </div>
          <span class="chev" aria-hidden="true"></span>
        </summary>
        ${contHTML}
      </details>

      <details>
        <summary>
          <div class="sum-left">
            <div class="sum-title">Contenidos mínimos (lista plana)</div>
            <div class="sum-desc">Bullets detectados</div>
          </div>
          <span class="chev" aria-hidden="true"></span>
        </summary>
        ${flatHTML}
      </details>
    `;
  }

  moduleList?.addEventListener("click", (ev) => {
    const item = ev.target.closest(".item");
    if(!item) return;
    const idx = Number(item.dataset.idx);
    renderDetails(idx);
    setActiveItem(idx);
  });

  moduleList?.addEventListener("keydown", (ev) => {
    if(ev.key !== "Enter" && ev.key !== " ") return;
    const item = ev.target.closest(".item");
    if(!item) return;
    ev.preventDefault();
    const idx = Number(item.dataset.idx);
    renderDetails(idx);
    setActiveItem(idx);
  });

  q?.addEventListener("input", applyFilter);

  $("#expandAll")?.addEventListener("click", () => expandCollapseAll(true));
  $("#collapseAll")?.addEventListener("click", () => expandCollapseAll(false));

  $("#clearSel")?.addEventListener("click", () => {
    currentIdx = null;
    setActiveItem(-1);
    detailsBody.innerHTML = `<div class="empty">Selecciona un módulo a la izquierda para ver su información.</div>`;
    selName.textContent = "Ninguno";
  });

  // Init
  if(DATA && Array.isArray(DATA) && DATA.length){
    applyFilter();
    renderDetails(0);
    setActiveItem(0);
  }
</script>

</body>
</html>
