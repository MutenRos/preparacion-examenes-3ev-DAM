<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Hoja de pedido</title>
  <style>
    body{font-family:system-ui,Arial,sans-serif;margin:24px;color:#111}
    .grid2{display:grid;grid-template-columns:1fr 1fr;gap:16px}
    .card{border:1px solid #ddd;border-radius:10px;padding:14px}
    .muted{color:#666;font-size:13px;margin:0}
    h2,h3{margin:0 0 8px 0}
    label{display:block;font-size:13px;color:#333;margin:8px 0 4px}
    input,select{width:100%;padding:8px;border:1px solid #ccc;border-radius:8px}
    table{width:100%;border-collapse:collapse;margin-top:14px}
    th,td{border-bottom:1px solid #eee;padding:10px;text-align:left;vertical-align:top}
    th{font-size:13px;color:#444}
    .right{text-align:right}
    .actions{display:flex;gap:8px;justify-content:flex-end;margin-top:10px}
    button{padding:8px 10px;border:1px solid #ccc;border-radius:8px;background:#f7f7f7;cursor:pointer}
    button:hover{background:#f1f1f1}
    .totales{max-width:420px;margin-left:auto;margin-top:14px}
    .row{display:flex;justify-content:space-between;padding:6px 0}
    .row strong{font-weight:700}
    .danger{color:#b00020}
  </style>
</head>
<body>

<?php
  // Conexión única
  $conexion = new mysqli("localhost", "mitienda", "Mitienda123$", "mitienda");
  if ($conexion->connect_error) {
    die("Error de conexión: " . htmlspecialchars($conexion->connect_error));
  }

  // Clientes
  $clientes = [];
  if ($res = $conexion->query("SELECT * FROM clientes")) {
    while ($fila = $res->fetch_assoc()) $clientes[] = $fila;
    $res->free();
  }

  // Productos
  $productos = [];
  if ($res2 = $conexion->query("SELECT * FROM productos")) {
    while ($fila2 = $res2->fetch_assoc()) $productos[] = $fila2;
    $res2->free();
  }

  $conexion->close();

  // Factura: valores por defecto
  $fecha_hoy = date("Y-m-d");
  // Número de factura simple (puedes sustituirlo por el siguiente correlativo desde BD cuando tengas tabla de facturas)
  $numero_factura = "F-" . date("Ymd-His");
?>

<!-- 1) Emisor y receptor -->
<div class="grid2">
  <div class="card">
    <h3>Emisor</h3>
    <!-- Sustituye estos datos por los tuyos -->
    <p class="muted">Tu empresa / Tu nombre</p>
    <p class="muted">CIF/NIF: ____________</p>
    <p class="muted">Dirección: __________________________</p>
    <p class="muted">CP / Localidad: ______________________</p>
    <p class="muted">Email: _______________________________</p>
  </div>

  <div class="card">
    <h3>Receptor</h3>

    <label for="selector_cliente">Cliente</label>
    <select name="cliente" id="selector_cliente">
      <option value="">Selecciona un cliente...</option>
      <?php foreach ($clientes as $fila): ?>
        <?php
          $nombre = $fila["nombre"] ?? "";
          $apellidos = $fila["apellidos"] ?? "";
          $email = $fila["email"] ?? "";
          $direccion = $fila["direccion"] ?? "";
          $cp = $fila["cp"] ?? "";
          $localidad = $fila["localidad"] ?? "";
        ?>
        <option
          value="<?= htmlspecialchars($nombre . " " . $apellidos) ?>"
          data-nombre="<?= htmlspecialchars($nombre) ?>"
          data-apellidos="<?= htmlspecialchars($apellidos) ?>"
          data-email="<?= htmlspecialchars($email) ?>"
          data-direccion="<?= htmlspecialchars($direccion) ?>"
          data-cp="<?= htmlspecialchars($cp) ?>"
          data-localidad="<?= htmlspecialchars($localidad) ?>"
        >
          <?= htmlspecialchars($nombre . " " . $apellidos) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <div id="datos_cliente" style="margin-top:10px">
      <h3 style="margin-top:10px"><span id="nombre"></span> <span id="apellidos"></span></h3>
      <p id="email" class="muted"></p>
      <p id="direccion" class="muted"></p>
      <p class="muted"><span id="cp"></span> <span id="localidad"></span></p>
    </div>
  </div>
</div>

<!-- 2) Datos de la factura -->
<div class="card" style="margin-top:16px">
  <h3>Datos de la factura</h3>
  <div class="grid2">
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

<!-- 3) Líneas dinámicas de productos -->
<div class="card" style="margin-top:16px">
  <h3>Líneas de producto</h3>

  <table>
    <thead>
      <tr>
        <th style="width:44%">Producto</th>
        <th style="width:16%" class="right">Precio</th>
        <th style="width:16%" class="right">Cantidad</th>
        <th style="width:16%" class="right">Subtotal</th>
        <th style="width:8%"></th>
      </tr>
    </thead>
    <tbody id="lineas"></tbody>
  </table>

  <div class="actions">
    <button type="button" id="btn_add">Añadir línea</button>
  </div>

  <!-- 4) Totales con IVA 21% -->
  <div class="totales">
    <div class="row"><span>Base imponible</span><span id="base" class="right">0,00</span></div>
    <div class="row"><span>IVA (21%)</span><span id="iva" class="right">0,00</span></div>
    <div class="row"><strong>Total</strong><strong id="total" class="right">0,00</strong></div>
    <p id="aviso" class="muted danger" style="display:none;margin-top:8px">Hay líneas sin producto seleccionado.</p>
  </div>
</div>

<!-- Plantilla de una línea -->
<template id="tpl_linea">
  <tr class="linea">
    <td>
      <select class="sel_producto">
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

      <div class="muted" style="margin-top:6px">
        <div class="desc"></div>
        <div class="meta"></div>
      </div>
    </td>

    <td class="right"><span class="precio">0,00</span> €</td>

    <td class="right">
      <input class="cantidad" type="number" min="1" value="1" style="max-width:120px;margin-left:auto">
    </td>

    <td class="right"><span class="subtotal">0,00</span> €</td>

    <td class="right">
      <button type="button" class="btn_del" title="Eliminar">✕</button>
    </td>
  </tr>
</template>

<script>
  // --- Cliente (receptor) ---
  const selectorCliente = document.querySelector("#selector_cliente");
  selectorCliente.addEventListener("change", function () {
    const opcion = this.selectedOptions[0];
    if (!opcion || !opcion.dataset) return;

    document.querySelector("#nombre").textContent = opcion.dataset.nombre || "";
    document.querySelector("#apellidos").textContent = opcion.dataset.apellidos || "";
    document.querySelector("#email").textContent = opcion.dataset.email || "";
    document.querySelector("#direccion").textContent = opcion.dataset.direccion || "";
    document.querySelector("#cp").textContent = opcion.dataset.cp || "";
    document.querySelector("#localidad").textContent = opcion.dataset.localidad || "";
  });

  // --- Líneas dinámicas ---
  const IVA = 0.21;
  const tbody = document.querySelector("#lineas");
  const tpl = document.querySelector("#tpl_linea");
  const btnAdd = document.querySelector("#btn_add");

  const fmt = (n) => {
    // Formato ES: 1.234,56
    return (Number(n) || 0).toLocaleString("es-ES", { minimumFractionDigits: 2, maximumFractionDigits: 2 });
  };

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

    const aviso = document.querySelector("#aviso");
    aviso.style.display = hayIncompletas ? "block" : "none";
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
    desc.textContent = d.descripcion ? d.descripcion : "";
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
      // Forzar mínimo 1
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

  // Crear 1 línea inicial por defecto
  crearLinea();
</script>

</body>
</html>
