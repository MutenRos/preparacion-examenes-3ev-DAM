<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Hoja de pedido</title>
  <style>
    :root{
      --b:#e6e6e6;
      --b2:#d6d6d6;
      --bg:#fff;
      --muted:#666;
      --txt:#111;
      --soft:#f7f7f7;
      --soft2:#f3f3f3;
      --radius:12px;
    }

    body{font-family:system-ui,Arial,sans-serif;margin:24px;color:var(--txt);background:var(--bg)}
    .grid2{display:grid;grid-template-columns:1fr 1fr;gap:16px}
    .card{border:1px solid var(--b);border-radius:var(--radius);padding:16px;background:#fff}
    .muted{color:var(--muted);font-size:13px;margin:0;line-height:1.45}
    h2,h3{margin:0 0 10px 0}
    label{display:block;font-size:13px;color:#333;margin:8px 0 6px}
    input,select{width:100%;padding:10px 12px;border:1px solid var(--b2);border-radius:10px;background:#fff}

    /* Factura: mejor espaciado */
    .factura-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px;align-items:end}
    .field{display:flex;flex-direction:column}

    table{width:100%;border-collapse:collapse;margin-top:12px}
    th,td{border-bottom:1px solid #efefef;padding:12px 10px;text-align:left;vertical-align:top}
    th{font-size:12.5px;color:#444;letter-spacing:.2px}
    .right{text-align:right}

    .actions{display:flex;gap:8px;justify-content:flex-end;margin-top:12px}
    button{padding:9px 11px;border:1px solid var(--b2);border-radius:10px;background:var(--soft);cursor:pointer}
    button:hover{background:var(--soft2)}
    .btn_del{padding:6px 9px;border-radius:10px}

    .totales{max-width:420px;margin-left:auto;margin-top:14px;border-top:1px dashed var(--b);padding-top:10px}
    .row{display:flex;justify-content:space-between;padding:6px 0}
    .row strong{font-weight:750}
    .danger{color:#b00020}

    /* --- "H3 seleccionable" para el cliente (no duplicar nombre) --- */
    .h3select-wrap{position:relative}
    .h3select{
      appearance:none;
      -webkit-appearance:none;
      -moz-appearance:none;

      font-size:18px;
      font-weight:750;
      padding:10px 38px 10px 12px;
      border:1px solid var(--b2);
      border-radius:12px;
      background:var(--soft);
      color:var(--txt);
      cursor:pointer;
      line-height:1.2;
    }
    .h3select:hover{background:var(--soft2)}
    .h3select:focus{outline:none;box-shadow:0 0 0 3px rgba(0,0,0,.06)}
    .h3select-caret{
      pointer-events:none;
      position:absolute;
      right:12px; top:50%;
      transform:translateY(-50%);
      width:0;height:0;
      border-left:6px solid transparent;
      border-right:6px solid transparent;
      border-top:8px solid #444;
      opacity:.75;
    }

    /* --- Select de producto: "parece texto" pero sigue siendo select --- */
    .select-ghost-wrap{position:relative}
    .select-ghost{
      appearance:none;
      -webkit-appearance:none;
      -moz-appearance:none;

      width:100%;
      border:1px solid transparent;
      background:transparent;
      padding:6px 28px 6px 6px;
      font-size:14px;
      font-weight:650;
      color:var(--txt);
      border-radius:10px;
      cursor:pointer;
    }
    .select-ghost:hover{background:var(--soft)}
    .select-ghost:focus{outline:none;background:var(--soft);border-color:var(--b2)}
    .select-ghost-caret{
      pointer-events:none;
      position:absolute;
      right:8px; top:50%;
      transform:translateY(-50%);
      width:0;height:0;
      border-left:5px solid transparent;
      border-right:5px solid transparent;
      border-top:7px solid #555;
      opacity:.6;
    }

    .linea .muted{margin-top:6px}
    .cantidad{max-width:120px;margin-left:auto}
  </style>
</head>
<body>

<?php
  $conexion = new mysqli("localhost", "mitienda", "Mitienda123$", "mitienda");
  if ($conexion->connect_error) {
    die("Error de conexión: " . htmlspecialchars($conexion->connect_error));
  }

  $clientes = [];
  if ($res = $conexion->query("SELECT * FROM clientes")) {
    while ($fila = $res->fetch_assoc()) $clientes[] = $fila;
    $res->free();
  }

  $productos = [];
  if ($res2 = $conexion->query("SELECT * FROM productos")) {
    while ($fila2 = $res2->fetch_assoc()) $productos[] = $fila2;
    $res2->free();
  }

  $conexion->close();

  $fecha_hoy = date("Y-m-d");
  // 2) Formato solicitado
  $numero_factura = "F2026XXX";
?>

<!-- 1) Emisor y receptor -->
<div class="grid2">
  <div class="card">
    <h3>Emisor</h3>
    <p class="muted">Tu empresa / Tu nombre</p>
    <p class="muted">CIF/NIF: ____________</p>
    <p class="muted">Dirección: __________________________</p>
    <p class="muted">CP / Localidad: ______________________</p>
    <p class="muted">Email: _______________________________</p>
  </div>

  <div class="card">
    <h3>Receptor</h3>

    <!-- 1) El selector ES el "h3 seleccionable" -->
    <div class="h3select-wrap" style="margin-top:8px">
      <select name="cliente" id="selector_cliente" class="h3select">
        <option value="" selected>Selecciona un cliente...</option>
        <?php foreach ($clientes as $fila): ?>
          <?php
            $nombre = $fila["nombre"] ?? "";
            $apellidos = $fila["apellidos"] ?? "";
            $email = $fila["email"] ?? "";
            $direccion = $fila["direccion"] ?? "";
            $cp = $fila["cp"] ?? "";
            $localidad = $fila["localidad"] ?? "";
            $full = trim($nombre . " " . $apellidos);
          ?>
          <option
            value="<?= htmlspecialchars($full) ?>"
            data-nombre="<?= htmlspecialchars($nombre) ?>"
            data-apellidos="<?= htmlspecialchars($apellidos) ?>"
            data-email="<?= htmlspecialchars($email) ?>"
            data-direccion="<?= htmlspecialchars($direccion) ?>"
            data-cp="<?= htmlspecialchars($cp) ?>"
            data-localidad="<?= htmlspecialchars($localidad) ?>"
          >
            <?= htmlspecialchars($full) ?>
          </option>
        <?php endforeach; ?>
      </select>
      <span class="h3select-caret"></span>
    </div>

    <!-- 1) Ya NO mostramos el nombre dos veces; solo detalles -->
    <div id="datos_cliente" style="margin-top:10px">
      <p id="email" class="muted"></p>
      <p id="direccion" class="muted"></p>
      <p class="muted"><span id="cp"></span> <span id="localidad"></span></p>
    </div>
  </div>
</div>

<!-- 2) Datos de la factura -->
<div class="card" style="margin-top:16px">
  <h3>Datos de la factura</h3>

  <div class="factura-grid" style="margin-top:6px">
    <div class="field">
      <label for="fecha_factura">Fecha</label>
      <input type="date" id="fecha_factura" value="<?= htmlspecialchars($fecha_hoy) ?>">
    </div>
    <div class="field">
      <label for="numero_factura">Número</label>
      <input type="text" id="numero_factura" value="<?= htmlspecialchars($numero_factura) ?>">
    </div>
  </div>
</div>

<!-- 3) Líneas dinámicas -->
<div class="card" style="margin-top:16px">
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

  <!-- 4) Totales -->
  <div class="totales">
    <div class="row"><span>Base imponible</span><span id="base" class="right">0,00 €</span></div>
    <div class="row"><span>IVA (21%)</span><span id="iva" class="right">0,00 €</span></div>
    <div class="row"><strong>Total</strong><strong id="total" class="right">0,00 €</strong></div>
    <p id="aviso" class="muted danger" style="display:none;margin-top:8px">Hay líneas sin producto seleccionado.</p>
  </div>
</div>

<!-- Plantilla de línea -->
<template id="tpl_linea">
  <tr class="linea">
    <td>
      <!-- 4) Select "no parece select" -->
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

      <div class="muted">
        <div class="desc"></div>
        <div class="meta"></div>
      </div>
    </td>

    <td class="right"><span class="precio">0,00</span> €</td>

    <td class="right">
      <input class="cantidad" type="number" min="1" value="1">
    </td>

    <td class="right"><span class="subtotal">0,00</span> €</td>

    <td class="right">
      <button type="button" class="btn_del" title="Eliminar">✕</button>
    </td>
  </tr>
</template>

<script>
  // --- Cliente ---
  const selectorCliente = document.querySelector("#selector_cliente");
  selectorCliente.addEventListener("change", function () {
    const opt = this.selectedOptions[0];
    if (!opt) return;

    document.querySelector("#email").textContent = opt.dataset.email || "";
    document.querySelector("#direccion").textContent = opt.dataset.direccion || "";
    document.querySelector("#cp").textContent = opt.dataset.cp || "";
    document.querySelector("#localidad").textContent = opt.dataset.localidad || "";
  });

  // --- Líneas y totales ---
  const IVA = 0.21;
  const tbody = document.querySelector("#lineas");
  const tpl = document.querySelector("#tpl_linea");
  const btnAdd = document.querySelector("#btn_add");

  const fmt = (n) => (Number(n) || 0).toLocaleString("es-ES", { minimumFractionDigits: 2, maximumFractionDigits: 2 });

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

    document.querySelector("#aviso").style.display = hayIncompletas ? "block" : "none";
  }

  function actualizarInfoProducto(tr) {
    const sel = tr.querySelector(".sel_producto");
    const opt = sel.selectedOptions[0];
    const desc = tr.querySelector(".desc");
    const meta = tr.querySelector(".meta");

    if (!sel.value) {
      desc.textContent = "";
      meta.textContent = "";
      return;
    }

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

    sel.addEventListener("change", () => {
      actualizarInfoProducto(tr);
      recalcularTotales();
    });

    qty.addEventListener("input", () => {
      if (Number(qty.value) < 1 || !qty.value) qty.value = 1;
      recalcularTotales();
    });

    del.addEventListener("click", () => {
      tr.remove();
      recalcularTotales();
    });

    tbody.appendChild(node);
    recalcularTotales();
  }

  btnAdd.addEventListener("click", crearLinea);

  // Línea inicial
  crearLinea();
</script>

</body>
</html>
