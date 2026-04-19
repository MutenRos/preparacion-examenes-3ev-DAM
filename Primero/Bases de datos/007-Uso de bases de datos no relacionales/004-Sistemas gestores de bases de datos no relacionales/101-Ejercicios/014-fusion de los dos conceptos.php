<?php
// =======================
//  PANEL FACTURAS (SINGLE FILE)
//  - MySQL: clientes/productos (para crear factura)
//  - MongoDB: facturas guardadas (listar + crear)
// =======================

// --------- CONFIG MYSQL ----------
$MYSQL_HOST = "localhost";
$MYSQL_USER = "mitienda";
$MYSQL_PASS = "Mitienda123$";
$MYSQL_DB   = "mitienda";

// --------- CONFIG MONGODB ----------
$MONGO_URI = "mongodb://127.0.0.1:27017";
$MONGO_DB  = "mitienda";
$MONGO_COL = "facturas";

// --------- HELPERS ----------
function json_out($arr, $code = 200) {
  http_response_code($code);
  header("Content-Type: application/json; charset=utf-8");
  echo json_encode($arr, JSON_UNESCAPED_UNICODE);
  exit;
}

function mongo_manager($uri) {
  if (!class_exists("MongoDB\\Driver\\Manager")) {
    json_out(["ok"=>false, "error"=>"No está disponible la extensión MongoDB para PHP (php-mongodb)."], 500);
  }
  return new MongoDB\Driver\Manager($uri);
}

// --------- API: GUARDAR FACTURA ----------
if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["action"] ?? "") === "guardar_factura") {
  try {
    $raw = $_POST["payload"] ?? "";
    $data = json_decode($raw, true);
    if (!is_array($data)) json_out(["ok"=>false,"error"=>"Payload JSON inválido."], 400);

    if (empty($data["factura"]["numero"])) json_out(["ok"=>false,"error"=>"Falta el número de factura."], 400);
    if (empty($data["factura"]["fecha"])) json_out(["ok"=>false,"error"=>"Falta la fecha de factura."], 400);
    if (empty($data["receptor"]["display"])) json_out(["ok"=>false,"error"=>"Falta el receptor."], 400);

    $lineas = $data["lineas"] ?? [];
    if (!is_array($lineas) || count($lineas) === 0) json_out(["ok"=>false,"error"=>"No hay líneas de pedido."], 400);
    foreach ($lineas as $l) {
      if (empty($l["producto"])) json_out(["ok"=>false,"error"=>"Hay líneas sin producto."], 400);
      if (empty($l["cantidad"]) || (int)$l["cantidad"] < 1) json_out(["ok"=>false,"error"=>"Cantidad inválida en una línea."], 400);
    }

    $manager = mongo_manager($GLOBALS["MONGO_URI"]);

    $doc = [
      "emisor"   => $data["emisor"]   ?? [],
      "receptor" => $data["receptor"] ?? [],
      "factura"  => $data["factura"]  ?? [],
      "lineas"   => $data["lineas"]   ?? [],
      "totales"  => $data["totales"]  ?? [],
      "status"   => "borrador",
      "createdAt"=> new MongoDB\BSON\UTCDateTime((int)(microtime(true) * 1000)),
      "updatedAt"=> new MongoDB\BSON\UTCDateTime((int)(microtime(true) * 1000)),
    ];

    $bulk = new MongoDB\Driver\BulkWrite();
    $insertedId = $bulk->insert($doc);

    $wc = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
    $result = $manager->executeBulkWrite($GLOBALS["MONGO_DB"].".".$GLOBALS["MONGO_COL"], $bulk, $wc);

    json_out([
      "ok" => true,
      "insertedCount" => $result->getInsertedCount(),
      "insertedId" => (string)$insertedId
    ]);

  } catch (Throwable $e) {
    json_out(["ok"=>false, "error"=>$e->getMessage()], 500);
  }
}

// --------- API: LISTAR FACTURAS ----------
if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["action"] ?? "") === "listar_facturas") {
  try {
    $manager = mongo_manager($GLOBALS["MONGO_URI"]);

    $filter = []; // todas
    $options = [
      "sort" => ["createdAt" => -1],
      "limit" => 200
    ];

    $query = new MongoDB\Driver\Query($filter, $options);
    $cursor = $manager->executeQuery($GLOBALS["MONGO_DB"].".".$GLOBALS["MONGO_COL"], $query);

    $out = [];
    foreach ($cursor as $doc) {
      // MongoDB\BSON\UTCDateTime -> string
      $createdAt = "";
      if (isset($doc->createdAt) && $doc->createdAt instanceof MongoDB\BSON\UTCDateTime) {
        $createdAt = $doc->createdAt->toDateTime()->format("Y-m-d H:i:s");
      }

      $out[] = [
        "id" => (string)$doc->_id,
        "numero" => $doc->factura->numero ?? "",
        "fecha" => $doc->factura->fecha ?? "",
        "cliente" => $doc->receptor->display ?? "",
        "base" => $doc->totales->base ?? 0,
        "iva" => $doc->totales->iva ?? 0,
        "total" => $doc->totales->total ?? 0,
        "status" => $doc->status ?? "",
        "createdAt" => $createdAt
      ];
    }

    json_out(["ok"=>true, "items"=>$out]);

  } catch (Throwable $e) {
    json_out(["ok"=>false, "error"=>$e->getMessage()], 500);
  }
}

// --------- VIEW (HTML) ----------
$view = $_GET["view"] ?? "crear"; // crear | listar

// Cargar clientes/productos desde MySQL para la vista "crear"
$clientes = [];
$productos = [];
if ($view === "crear") {
  $conexion = new mysqli($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS, $MYSQL_DB);
  if ($conexion->connect_error) {
    die("Error de conexión MySQL: " . htmlspecialchars($conexion->connect_error));
  }

  if ($res = $conexion->query("SELECT * FROM clientes")) {
    while ($fila = $res->fetch_assoc()) $clientes[] = $fila;
    $res->free();
  }
  if ($res2 = $conexion->query("SELECT * FROM productos")) {
    while ($fila2 = $res2->fetch_assoc()) $productos[] = $fila2;
    $res2->free();
  }
  $conexion->close();
}

$fecha_hoy = date("Y-m-d");
$numero_factura = "F2026XXX";
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Panel de facturas</title>
  <style>
    html,body{padding:0;margin:0;height:100%;width:100%;}
    body{display:flex;font-family:system-ui,Arial,sans-serif;color:#111;background:#fff;}
    nav{background:indigo;flex:1;display:flex;flex-direction:column;gap:10px;padding:10px;min-width:220px;}
    main{flex:5;padding:14px;background:#fafafa;overflow:auto;}
    nav a{background:white;padding:10px 12px;color:orange;text-decoration:none;border-radius:10px;font-weight:650;}
    nav a.active{outline:3px solid rgba(255,165,0,.25)}
    .card{background:#fff;border:1px solid #e6e6e6;border-radius:14px;padding:16px}
    .row2{display:grid;grid-template-columns:1fr 1fr;gap:14px}
    .muted{color:#666;font-size:13px;margin:0;line-height:1.45}
    h2{margin:0 0 12px 0}
    h3{margin:0 0 10px 0}
    label{display:block;font-size:13px;color:#333;margin:8px 0 6px}
    input,select{width:100%;padding:10px 12px;border:1px solid #d6d6d6;border-radius:10px;background:#fff}

    table{width:100%;border-collapse:collapse}
    th,td{border-bottom:1px solid #eee;padding:12px 10px;text-align:left;vertical-align:top}
    th{font-size:12.5px;color:#444}
    .right{text-align:right}

    /* Botones */
    .actions{display:flex;gap:10px;justify-content:flex-end;margin-top:12px}
    button{padding:10px 12px;border:1px solid #d6d6d6;border-radius:12px;background:#f3f3f3;cursor:pointer}
    button:hover{background:#ededed}
    .primary{background:#111;color:#fff;border-color:#111}
    .primary:hover{background:#000}

    /* Select estilizados */
    .h3select-wrap{position:relative}
    .h3select{
      appearance:none;-webkit-appearance:none;-moz-appearance:none;
      font-size:18px;font-weight:750;
      padding:10px 38px 10px 12px;
      border:1px solid #d6d6d6;border-radius:12px;
      background:#f7f7f7;color:#111;cursor:pointer;line-height:1.2;
    }
    .h3select:hover{background:#f2f2f2}
    .h3select-caret{
      pointer-events:none;position:absolute;right:12px;top:50%;transform:translateY(-50%);
      width:0;height:0;border-left:6px solid transparent;border-right:6px solid transparent;border-top:8px solid #444;opacity:.75;
    }

    .select-ghost-wrap{position:relative}
    .select-ghost{
      appearance:none;-webkit-appearance:none;-moz-appearance:none;
      width:100%;border:1px solid transparent;background:transparent;
      padding:6px 28px 6px 6px;font-size:14px;font-weight:650;color:#111;border-radius:10px;cursor:pointer;
    }
    .select-ghost:hover{background:#f7f7f7}
    .select-ghost:focus{outline:none;background:#f7f7f7;border-color:#d6d6d6}
    .select-ghost-caret{
      pointer-events:none;position:absolute;right:8px;top:50%;transform:translateY(-50%);
      width:0;height:0;border-left:5px solid transparent;border-right:5px solid transparent;border-top:7px solid #555;opacity:.6;
    }

    /* Totales */
    .totales{max-width:420px;margin-left:auto;margin-top:14px;border-top:1px dashed #e6e6e6;padding-top:10px}
    .trow{display:flex;justify-content:space-between;padding:6px 0}
    .trow strong{font-weight:750}

    /* Toast */
    .toast{
      position:fixed;right:18px;bottom:18px;
      background:#111;color:#fff;padding:12px 14px;border-radius:12px;
      box-shadow:0 10px 30px rgba(0,0,0,.20);
      display:none;max-width:520px;font-size:13px;line-height:1.35;z-index:9999
    }
    .toast.ok{background:#0f5132}
    .toast.err{background:#842029}

    /* Lista facturas */
    .toolbar{display:flex;gap:10px;align-items:center;justify-content:space-between;margin-bottom:12px}
    .pill{display:inline-block;padding:4px 10px;border-radius:999px;background:#f0f0f0;font-size:12px}
  </style>
</head>
<body>
  <nav>
    <a class="<?= $view==="crear" ? "active" : "" ?>" href="?view=crear">Crear nueva factura</a>
    <a class="<?= $view==="listar" ? "active" : "" ?>" href="?view=listar">Listar facturas</a>
  </nav>

  <main>
    <?php if ($view === "crear"): ?>
      <h2>Crear nueva factura</h2>

      <div class="row2">
        <div class="card">
          <h3>Emisor</h3>
          <p class="muted" id="emisor_nombre">Tu empresa / Tu nombre</p>
          <p class="muted" id="emisor_nif">CIF/NIF: ____________</p>
          <p class="muted" id="emisor_direccion">Dirección: __________________________</p>
          <p class="muted" id="emisor_poblacion">CP / Localidad: ______________________</p>
          <p class="muted" id="emisor_email">Email: _______________________________</p>
        </div>

        <div class="card">
          <h3>Receptor</h3>
          <div class="h3select-wrap" style="margin-top:8px">
            <select id="selector_cliente" class="h3select">
              <option value="" selected>Selecciona un cliente...</option>
              <?php foreach ($clientes as $fila): ?>
                <?php
                  $nombre = $fila["nombre"] ?? "";
                  $apellidos = $fila["apellidos"] ?? "";
                  $email = $fila["email"] ?? "";
                  $direccion = $fila["direccion"] ?? "";
                  $cp = $fila["cp"] ?? "";
                  $localidad = $fila["localidad"] ?? "";
                  $full = trim($nombre." ".$apellidos);
                ?>
                <option
                  value="<?= htmlspecialchars($full) ?>"
                  data-nombre="<?= htmlspecialchars($nombre) ?>"
                  data-apellidos="<?= htmlspecialchars($apellidos) ?>"
                  data-email="<?= htmlspecialchars($email) ?>"
                  data-direccion="<?= htmlspecialchars($direccion) ?>"
                  data-cp="<?= htmlspecialchars($cp) ?>"
                  data-localidad="<?= htmlspecialchars($localidad) ?>"
                ><?= htmlspecialchars($full) ?></option>
              <?php endforeach; ?>
            </select>
            <span class="h3select-caret"></span>
          </div>

          <div style="margin-top:10px">
            <p id="receptor_email" class="muted"></p>
            <p id="receptor_direccion" class="muted"></p>
            <p class="muted"><span id="receptor_cp"></span> <span id="receptor_localidad"></span></p>
          </div>
        </div>
      </div>

      <div class="card" style="margin-top:14px">
        <h3>Datos de la factura</h3>
        <div class="row2" style="margin-top:6px">
          <div>
            <label for="fecha_factura">Fecha</label>
            <input type="date" id="fecha_factura" value="<?= htmlspecialchars($fecha_hoy) ?>">
          </div>
          <div>
            <label for="numero_factura">Número</label>
            <input type="text" id="numero_factura" value="<?= htmlspecialchars($numero_factura) ?>">
          </div>
        </div>
      </div>

      <div class="card" style="margin-top:14px">
        <h3>Líneas de producto</h3>

        <table>
          <thead>
            <tr>
              <th style="width:48%">Producto</th>
              <th style="width:14%" class="right">Precio</th>
              <th style="width:14%" class="right">Cantidad</th>
              <th style="width:16%" class="right">Subtotal</th>
              <th style="width:8%"></th>
            </tr>
          </thead>
          <tbody id="lineas"></tbody>
        </table>

        <div class="actions">
          <button type="button" id="btn_add">Añadir línea</button>
        </div>

        <div class="totales">
          <div class="trow"><span>Base imponible</span><span id="base">0,00 €</span></div>
          <div class="trow"><span>IVA (21%)</span><span id="iva">0,00 €</span></div>
          <div class="trow"><strong>Total</strong><strong id="total">0,00 €</strong></div>
        </div>

        <div class="actions">
          <button type="button" class="primary" id="btn_guardar">Guardar factura</button>
        </div>
        <p id="aviso" class="muted" style="display:none;color:#842029;margin-top:8px">Revisa: cliente, número de factura y líneas.</p>
      </div>

      <template id="tpl_linea">
        <tr class="linea">
          <td>
            <div class="select-ghost-wrap">
              <select class="sel_producto select-ghost">
                <option value="">Selecciona un producto...</option>
                <?php foreach ($productos as $p): ?>
                  <?php
                    $nombrep = $p["nombre"] ?? "";
                    $descripcionp = $p["descripcion"] ?? "";
                    $preciop = $p["precio"] ?? 0;
                    $stockp = $p["stock"] ?? "";
                    $categoriap = $p["categoria"] ?? "";
                    $marcap = $p["marca"] ?? "";
                  ?>
                  <option
                    value="<?= htmlspecialchars($nombrep) ?>"
                    data-nombre="<?= htmlspecialchars($nombrep) ?>"
                    data-descripcion="<?= htmlspecialchars($descripcionp) ?>"
                    data-precio="<?= htmlspecialchars((string)$preciop) ?>"
                    data-stock="<?= htmlspecialchars((string)$stockp) ?>"
                    data-categoria="<?= htmlspecialchars($categoriap) ?>"
                    data-marca="<?= htmlspecialchars($marcap) ?>"
                  >
                    <?= htmlspecialchars($nombrep) ?> — <?= htmlspecialchars((string)$preciop) ?> €
                  </option>
                <?php endforeach; ?>
              </select>
              <span class="select-ghost-caret"></span>
            </div>

            <p class="muted" style="margin-top:6px">
              <span class="desc"></span><br>
              <span class="meta"></span>
            </p>
          </td>
          <td class="right"><span class="precio">0,00</span> €</td>
          <td class="right"><input class="cantidad" type="number" min="1" value="1"></td>
          <td class="right"><span class="subtotal">0,00</span> €</td>
          <td class="right"><button type="button" class="btn_del" title="Eliminar">✕</button></td>
        </tr>
      </template>

    <?php else: ?>
      <div class="toolbar">
        <h2 style="margin:0">Facturas existentes</h2>
        <button type="button" id="btn_recargar">Recargar</button>
      </div>

      <div class="card">
        <p class="muted" style="margin-bottom:12px">
          Se listan las últimas 200 facturas guardadas en <strong><?= htmlspecialchars($MONGO_DB.".".$MONGO_COL) ?></strong>.
        </p>

        <table>
          <thead>
            <tr>
              <th>Número</th>
              <th>Fecha</th>
              <th>Cliente</th>
              <th class="right">Base</th>
              <th class="right">IVA</th>
              <th class="right">Total</th>
              <th>Estado</th>
              <th>Creada</th>
            </tr>
          </thead>
          <tbody id="tabla_facturas">
            <tr><td colspan="8" class="muted">Cargando…</td></tr>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </main>

  <div id="toast" class="toast"></div>

<script>
  // ---------- TOAST ----------
  const toast = document.querySelector("#toast");
  let toastTimer = null;
  function showToast(msg, ok=true) {
    toast.className = "toast " + (ok ? "ok" : "err");
    toast.textContent = msg;
    toast.style.display = "block";
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => toast.style.display = "none", 3500);
  }

  // ---------- VISTA: CREAR ----------
  <?php if ($view === "crear"): ?>
    const selectorCliente = document.querySelector("#selector_cliente");
    const IVA = 0.21;
    const tbody = document.querySelector("#lineas");
    const tpl = document.querySelector("#tpl_linea");
    const btnAdd = document.querySelector("#btn_add");
    const btnGuardar = document.querySelector("#btn_guardar");
    const aviso = document.querySelector("#aviso");

    const fmt = (n) => (Number(n) || 0).toLocaleString("es-ES", { minimumFractionDigits: 2, maximumFractionDigits: 2 });

    selectorCliente.addEventListener("change", function(){
      const opt = this.selectedOptions[0];
      document.querySelector("#receptor_email").textContent = opt?.dataset?.email || "";
      document.querySelector("#receptor_direccion").textContent = opt?.dataset?.direccion || "";
      document.querySelector("#receptor_cp").textContent = opt?.dataset?.cp || "";
      document.querySelector("#receptor_localidad").textContent = opt?.dataset?.localidad || "";
    });

    function recalcularTotales() {
      let base = 0;
      let hayIncompletas = false;

      tbody.querySelectorAll("tr.linea").forEach(tr => {
        const sel = tr.querySelector(".sel_producto");
        const qty = tr.querySelector(".cantidad");
        const precio = Number(sel?.selectedOptions?.[0]?.dataset?.precio || 0);
        const cantidad = Math.max(1, Number(qty.value || 1));
        if (!sel.value) hayIncompletas = true;

        const subtotal = precio * cantidad;
        base += subtotal;
        tr.querySelector(".precio").textContent = fmt(precio);
        tr.querySelector(".subtotal").textContent = fmt(subtotal);
      });

      const iva = base * IVA;
      const total = base + iva;

      document.querySelector("#base").textContent = fmt(base) + " €";
      document.querySelector("#iva").textContent = fmt(iva) + " €";
      document.querySelector("#total").textContent = fmt(total) + " €";

      aviso.style.display = hayIncompletas ? "block" : "none";
    }

    function actualizarInfoProducto(tr) {
      const sel = tr.querySelector(".sel_producto");
      const opt = sel.selectedOptions[0];
      const desc = tr.querySelector(".desc");
      const meta = tr.querySelector(".meta");

      if (!sel.value) { desc.textContent = ""; meta.textContent = ""; return; }

      const d = opt.dataset;
      desc.textContent = d.descripcion || "";
      meta.textContent = [
        d.marca ? ("Marca: " + d.marca) : "",
        d.categoria ? ("Categoría: " + d.categoria) : "",
        (d.stock !== undefined && d.stock !== "") ? ("Stock: " + d.stock) : ""
      ].filter(Boolean).join(" · ");
    }

    function crearLinea() {
      const node = tpl.content.cloneNode(true);
      const tr = node.querySelector("tr.linea");

      const sel = tr.querySelector(".sel_producto");
      const qty = tr.querySelector(".cantidad");
      const del = tr.querySelector(".btn_del");

      sel.addEventListener("change", () => { actualizarInfoProducto(tr); recalcularTotales(); });
      qty.addEventListener("input", () => { if (Number(qty.value) < 1 || !qty.value) qty.value = 1; recalcularTotales(); });
      del.addEventListener("click", () => { tr.remove(); recalcularTotales(); });

      tbody.appendChild(node);
      recalcularTotales();
    }

    btnAdd.addEventListener("click", crearLinea);
    crearLinea();

    function parseEUR(s) {
      return Number(String(s).replace(/[€\s]/g,"").replace(/\./g,"").replace(",", ".")) || 0;
    }

    function getEmisor() {
      return {
        nombre: document.querySelector("#emisor_nombre")?.textContent?.trim() || "",
        nif: document.querySelector("#emisor_nif")?.textContent?.replace(/^CIF\/NIF:\s*/i,"").trim() || "",
        direccion: document.querySelector("#emisor_direccion")?.textContent?.replace(/^Dirección:\s*/i,"").trim() || "",
        poblacion: document.querySelector("#emisor_poblacion")?.textContent?.replace(/^CP\s*\/\s*Localidad:\s*/i,"").trim() || "",
        email: document.querySelector("#emisor_email")?.textContent?.replace(/^Email:\s*/i,"").trim() || ""
      };
    }

    function getReceptor() {
      const opt = selectorCliente.selectedOptions[0];
      return {
        nombre: opt?.dataset?.nombre || "",
        apellidos: opt?.dataset?.apellidos || "",
        email: opt?.dataset?.email || "",
        direccion: opt?.dataset?.direccion || "",
        cp: opt?.dataset?.cp || "",
        localidad: opt?.dataset?.localidad || "",
        display: opt?.value || ""
      };
    }

    function getFactura() {
      return {
        fecha: document.querySelector("#fecha_factura").value || "",
        numero: document.querySelector("#numero_factura").value?.trim() || ""
      };
    }

    function getLineas() {
      const lineas = [];
      tbody.querySelectorAll("tr.linea").forEach(tr => {
        const sel = tr.querySelector(".sel_producto");
        const opt = sel.selectedOptions[0];
        const cantidad = Math.max(1, Number(tr.querySelector(".cantidad").value || 1));
        const precio = Number(opt?.dataset?.precio || 0);
        const subtotal = precio * cantidad;

        lineas.push({
          producto: opt?.dataset?.nombre || "",
          descripcion: opt?.dataset?.descripcion || "",
          marca: opt?.dataset?.marca || "",
          categoria: opt?.dataset?.categoria || "",
          stock: (opt?.dataset?.stock ?? ""),
          precio: precio,
          cantidad: cantidad,
          subtotal: subtotal
        });
      });
      return lineas;
    }

    function getTotales() {
      return {
        ivaTipo: 0.21,
        base: parseEUR(document.querySelector("#base").textContent || "0"),
        iva: parseEUR(document.querySelector("#iva").textContent || "0"),
        total: parseEUR(document.querySelector("#total").textContent || "0")
      };
    }

    async function guardarFactura() {
      recalcularTotales();

      const receptor = getReceptor();
      const factura = getFactura();
      const lineas = getLineas();

      const haySinProducto = lineas.some(l => !l.producto);

      if (!receptor.display || !factura.numero || !factura.fecha || lineas.length === 0 || haySinProducto) {
        showToast("Revisa: cliente, número/fecha de factura y líneas.", false);
        return;
      }

      const payload = {
        emisor: getEmisor(),
        receptor: receptor,
        factura: factura,
        lineas: lineas,
        totales: getTotales()
      };

      const form = new FormData();
      form.append("action", "guardar_factura");
      form.append("payload", JSON.stringify(payload));

      try {
        const r = await fetch(location.pathname + "?view=crear", { method: "POST", body: form });
        const j = await r.json();

        if (!r.ok || !j.ok) {
          showToast("Error al guardar: " + (j.error || "desconocido"), false);
          return;
        }

        showToast("Factura guardada. ID: " + j.insertedId, true);
      } catch (e) {
        showToast("Error de red: " + e.message, false);
      }
    }

    btnGuardar.addEventListener("click", guardarFactura);
  <?php endif; ?>

  // ---------- VISTA: LISTAR ----------
  <?php if ($view === "listar"): ?>
    const tbodyFacturas = document.querySelector("#tabla_facturas");
    const btnRecargar = document.querySelector("#btn_recargar");

    const fmt = (n) => (Number(n) || 0).toLocaleString("es-ES", { minimumFractionDigits: 2, maximumFractionDigits: 2 });

    async function cargarFacturas() {
      tbodyFacturas.innerHTML = `<tr><td colspan="8" class="muted">Cargando…</td></tr>`;

      const form = new FormData();
      form.append("action", "listar_facturas");

      try {
        const r = await fetch(location.pathname + "?view=listar", { method: "POST", body: form });
        const j = await r.json();

        if (!r.ok || !j.ok) {
          tbodyFacturas.innerHTML = `<tr><td colspan="8" style="color:#842029">Error: ${(j && j.error) ? j.error : "desconocido"}</td></tr>`;
          return;
        }

        if (!j.items || j.items.length === 0) {
          tbodyFacturas.innerHTML = `<tr><td colspan="8" class="muted">No hay facturas.</td></tr>`;
          return;
        }

        tbodyFacturas.innerHTML = j.items.map(it => `
          <tr>
            <td><strong>${escapeHtml(it.numero || "")}</strong><div class="muted">${escapeHtml(it.id || "")}</div></td>
            <td>${escapeHtml(it.fecha || "")}</td>
            <td>${escapeHtml(it.cliente || "")}</td>
            <td class="right">${fmt(it.base)} €</td>
            <td class="right">${fmt(it.iva)} €</td>
            <td class="right"><strong>${fmt(it.total)} €</strong></td>
            <td><span class="pill">${escapeHtml(it.status || "")}</span></td>
            <td class="muted">${escapeHtml(it.createdAt || "")}</td>
          </tr>
        `).join("");

      } catch (e) {
        tbodyFacturas.innerHTML = `<tr><td colspan="8" style="color:#842029">Error de red: ${escapeHtml(e.message)}</td></tr>`;
      }
    }

    function escapeHtml(s){
      return String(s ?? "")
        .replaceAll("&","&amp;")
        .replaceAll("<","&lt;")
        .replaceAll(">","&gt;")
        .replaceAll('"',"&quot;")
        .replaceAll("'","&#039;");
    }

    btnRecargar.addEventListener("click", cargarFacturas);
    cargarFacturas();
  <?php endif; ?>
</script>
</body>
</html>
