# Reporte de proyecto

## Estructura del proyecto

```
/var/www/html/jocarsa-rosybrown
├── .gitignore
├── README.md
├── api
│   ├── get_pending_payments.php
│   ├── invoice.php
│   └── update_paid.php
├── config.php
├── config_sample.php
├── css
│   └── style.css
├── export_ods.php
├── factura.html
├── inc
│   ├── cerrarsesion.php
│   ├── inicializardb.php
│   └── login.php
├── index.php
├── js
│   ├── charts.js
│   └── script.js
├── landing.html
├── paginas
│   ├── clientes.php
│   ├── crearcliente.php
│   ├── crearepigrafe.php
│   ├── crearfactura.php
│   ├── creargasto.php
│   ├── crearpresupuesto.php
│   ├── crearproducto.php
│   ├── crearproveedor.php
│   ├── crearusuario.php
│   ├── descargar_plantilla_importar.php
│   ├── editarcliente.php
│   ├── editarfactura.php
│   ├── editargasto.php
│   ├── editarpresupuesto.php
│   ├── editarproducto.php
│   ├── editarproveedor.php
│   ├── editarusuario.php
│   ├── epigrafes.php
│   ├── epigrafes_editar.php
│   ├── escritorio.php
│   ├── export_ods.php
│   ├── exportar.php
│   ├── facturas.php
│   ├── gastos.php
│   ├── importar.php
│   ├── imprimirfactura.php
│   ├── imprimirpresupuesto.php
│   ├── informes.php
│   ├── informes_libro_gastos.php
│   ├── informes_libro_ingresos.php
│   ├── informes_libro_mayor.php
│   ├── invoice_template.php
│   ├── misdatos.php
│   ├── presupuesto_template.php
│   ├── presupuestos.php
│   ├── productos.php
│   ├── proveedores.php
│   ├── retenciones.php
│   ├── retenciones_crear.php
│   ├── retenciones_editar.php
│   ├── usuarios.php
│   ├── verfactura.php
│   └── verpresupuesto.php
└── rosybrown.png
```

## Código (intercalado)

# jocarsa-rosybrown
**README.md**
```markdown
# jocarsa-rosybrown
```
**config.php**
```php
<?php
// config.php
return [
    'db_url' => 'sqlite:../databases/rosybrown.sqlite'
];


```
**config_sample.php**
```php
<?php
// config.php
return [
    'db_url' => 'sqlite:rosybrown.sqlite'
];


```
**export_ods.php**
```php
<?php
// export_ods.php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
require_once 'config.php';
try {
  $db = new PDO($config['db_url']);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $ex) {
  die("Error al conectar con la base de datos");
}

$allowedTables = ['clientes', 'facturas', 'productos', 'gastos', 'proveedores', 'epigrafes', 'retenciones', 'usuarios'];
$table = isset($_GET['table']) ? $_GET['table'] : '';
if (!in_array($table, $allowedTables)) {
  die("Tabla no permitida para exportación.");
}
$userId = $_SESSION['usuario']['id'];
$query = "";
$params = [];
$headers = [];
switch ($table) {
  case 'clientes':
    $query = "SELECT id, name, address, postal_code, city, id_number FROM clientes WHERE user_id = ?";
    $params = [$userId];
    $headers = ["No.", "ID", "Nombre", "Dirección", "Código Postal", "Ciudad", "Nº Identificación"];
    break;
  case 'facturas':
    $query = "SELECT id, invoice_number, fecha, cliente_id, total FROM facturas WHERE user_id = ?";
    $params = [$userId];
    $headers = ["No.", "ID", "Nº Factura", "Fecha", "Cliente ID", "Total (€)"];
    break;
  case 'productos':
    $query = "SELECT id, nombre, descripcion, price FROM productos WHERE user_id = ?";
    $params = [$userId];
    $headers = ["No.", "ID", "Nombre", "Descripción", "Precio (€)"];
    break;
  case 'gastos':
    $query = "SELECT id, gasto_deducible, fecha_emision, fecha_operaciones, numero_factura, fecha_factura, proveedor_id, total_factura, base_imponible, tipo_retencion, importe_retencion, tipo_iva, cuota_iva, iva_deducido FROM gastos WHERE user_id = ?";
    $params = [$userId];
    $headers = ["No.", "ID", "Gasto Deducible (€)", "Fecha Emisión", "Fecha Operaciones", "Nº Factura", "Fecha Factura", "Proveedor ID", "Total Factura (€)", "Base Imponible (€)", "Tipo Retención", "Importe Retención (€)", "Tipo IVA", "Cuota IVA (€)", "IVA Deducido (€)"];
    break;
  case 'proveedores':
    $query = "SELECT id, razon_social, direccion, codigo_postal, poblacion, identificacion_fiscal, contacto_nombre, contacto_email, contacto_telefono FROM proveedores WHERE user_id = ?";
    $params = [$userId];
    $headers = ["No.", "ID", "Razón Social", "Dirección", "Código Postal", "Población", "Identificación Fiscal", "Contacto", "Email", "Teléfono"];
    break;
  case 'epigrafes':
    $query = "SELECT id, name, iva_percentage FROM epigrafes WHERE user_id = ?";
    $params = [$userId];
    $headers = ["No.", "ID", "Nombre", "IVA (%)"];
    break;
  case 'retenciones':
    $query = "SELECT id, name, percentage FROM retenciones WHERE user_id = ?";
    $params = [$userId];
    $headers = ["No.", "ID", "Nombre", "Porcentaje (%)"];
    break;
  case 'usuarios':
    $query = "SELECT id, usuario, email, nombre FROM usuarios";
    $params = []; // You can add filtering if desired.
    $headers = ["No.", "ID", "Usuario", "Email", "Nombre"];
    break;
  default:
    die("Export para esta tabla no implementado.");
}

$stmt = $db->prepare($query);
$stmt->execute($params);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Build rows array with sequential numbering
$rows = [];
$i = 1;
foreach($data as $row) {
  $rowWithNo = array_merge(["No." => $i], $row);
  $rows[] = array_values($rowWithNo);
  $i++;
}

// Add final footer row with total rows count
$footer = ["Total filas: " . count($rows)];
while(count($footer) < count($headers)) {
    $footer[] = "";
}
$rows[] = $footer;

// Output minimal Flat ODS (FODS) file
header("Content-Type: application/vnd.oasis.opendocument.spreadsheet");
header("Content-Disposition: attachment; filename=\"{$table}_export.ods\"");
header("Cache-Control: max-age=0");
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<office:document-content 
    xmlns:office="urn:oasis:names:tc:opendocument:xmlns:office:1.0"
    xmlns:table="urn:oasis:names:tc:opendocument:xmlns:table:1.0"
    xmlns:text="urn:oasis:names:tc:opendocument:xmlns:text:1.0"
    office:version="1.2">
  <office:body>
    <office:spreadsheet>
      <table:table table:name="Sheet1">
        <!-- Header Row -->
        <table:table-row>
        <?php foreach($headers as $header): ?>
          <table:table-cell office:value-type="string">
            <text:p><?php echo htmlspecialchars($header); ?></text:p>
          </table:table-cell>
        <?php endforeach; ?>
        </table:table-row>
        <!-- Data Rows -->
        <?php foreach($rows as $row): ?>
        <table:table-row>
          <?php foreach($row as $cell): ?>
          <table:table-cell office:value-type="string">
            <text:p><?php echo htmlspecialchars($cell); ?></text:p>
          </table:table-cell>
          <?php endforeach; ?>
        </table:table-row>
        <?php endforeach; ?>
      </table:table>
    </office:spreadsheet>
  </office:body>
</office:document-content>


```
**factura.html**
```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura Teresa Tortajada</title>
    <style>
        @import url('https://static.jocarsa.com/fuentes/ubuntu-font-family-0.83/ubuntu.css');

        body {
            font-family: Ubuntu, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            background: black;
            color: white;
            padding: 20px;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
            font-weight: bold;
        }
        .header h2 {
            font-size: 18px;
            margin: 0;
            font-weight: bold;
            color: white;
        }
        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .sender-details, .recipient-details {
            width: 48%;
        }
        .sender-details h3, .recipient-details h3 {
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
            margin-top: 0;
        }
        .invoice-number {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .invoice-table th {
            background-color: #f5f5f5;
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .invoice-table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .invoice-table .price-column {
            text-align: right;
        }
        .total-section {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            margin-bottom: 30px;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            width: 250px;
            margin-bottom: 5px;
        }
        .total-row.final {
            font-weight: bold;
            border-top: 1px solid #ddd;
            padding-top: 5px;
        }
        .footer {
            font-size: 10px;
            color: #666;
            margin-top: 40px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .bank-details {
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>TERESA TORTAJADA</h1>
            <h2>MARKETING - DISEÑO - COMUNICACIÓN</h2>
        </div>
        
        <div class="invoice-number">
            <div>
                <strong>FACTURA NÚMERO:</strong> 5/24
            </div>
            <div>
                <strong>FECHA:</strong> 3/1/2024
            </div>
        </div>

        <div class="invoice-details">
            <div class="sender-details">
                <h3>Emisor</h3>
                <p>Teresa Tortajada Calaforra<br>
                Av/Primero de mayo 40, 3<br>
                46017 Valencia<br>
                24443845C</p>
            </div>
            <div class="recipient-details">
                <h3>Cliente</h3>
                <p>Plantación Spain SL<br>
                C/Almirante Cadarso, 11 bajo<br>
                46005 Valencia<br>
                B97017164</p>
            </div>
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>UNIDADES</th>
                    <th>DESCRIPCIÓN</th>
                    <th class="price-column">PRECIO</th>
                    <th class="price-column">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        Creación, gestión y mantenimiento de contenidos en RRSS (3+1 redes)
                        <ul><li>Diseño gráfico</li> <li>Gestión de comunidades Google My Business</li> <li>Campañas de RRSS</li></ul>
                    </td>
                    <td class="price-column">900,00€</td>
                    <td class="price-column">900,00€</td>
                </tr>
            </tbody>
        </table>

        <div class="total-section">
            <div class="total-row">
                <div>TOTAL LÍNEAS:</div>
                <div>900,00€</div>
            </div>
            <div class="total-row">
                <div>Total IVA:</div>
                <div>189,00€</div>
            </div>
            <div class="total-row">
                <div>IRPF (15%):</div>
                <div>135,00€</div>
            </div>
            <div class="total-row final">
                <div>TOTAL:</div>
                <div>954,00€</div>
            </div>
        </div>

        <div class="bank-details">
            <strong>CUENTA:</strong> ES24 0049 1283 1525 1009 3107
        </div>

        <div class="footer">
            Le recordamos que su dirección de correo electrónico junto con la información de carácter personal que nos haya facilitado, ha sido incorporada según lo establecido en el Reglamento (UE) 2016/679
            del Parlamento Europeo y del Consejo, de 27 de abril de 2016, de Protección de Datos de la Unión a un fichero titularidad de TERESA TORTAJADA CALAFORRA, cuya finalidad es la debida gestión
            administrativa y contable de la actividad. De acuerdo con lo establecido en el Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo, de 27 de abril de 2016, de Protección de Datos, usted
            tiene derecho de acceso, rectificación y cancelación sobre los mismos en los términos legales, dirigiéndose por escrito a: TERESA TORTAJADA CALAFORRA, Avd. Primero de Mayo nº 40, puerta 3, 46017
            Valencia, teresatortajadacalaforra@gmail.com
        </div>
    </div>
</body>
</html>


```
**index.php**
```php
<?php
$config = require 'config.php';
session_start();
include "../jocarsa-red/jocarsa | red.php";

// Conexión a la base de datos usando la URL de config.php
try {
    $db = new PDO($config['db_url']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $ex) {
    die("Error al conectar con la base de datos");
}

include "inc/inicializardb.php";
inicializarDB($db);

include "inc/cerrarsesion.php";

include "inc/login.php";

function activo($pagina){
    if(isset($_GET['page'])){
        if($_GET['page'] == $pagina){
            echo "class='activo'";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>jocarsa | rosybrown - Panel de Administración</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
    <link rel="icon" type="image/svg+xml" href="rosybrown.png">
</head>
<body>
    <header class="admin-header" title="Panel de administración de jocarsa | rosybrown">
        <h1><img src="rosybrown.png">jocarsa | rosybrown</h1>
       
    </header>
    <div class="admin-container">
        <nav class="admin-nav">
            <ul>
                <li <?php activo("inicio") ?>><a href="index.php" title="Ir a la página de inicio"><span class="icono">I</span> Inicio</a></li>
                <hr>
                <li <?php activo("mis_datos") ?>><a href="index.php?page=mis_datos" title="Editar mis datos de factura"><span class="icono">D</span> Mis Datos</a></li>
                <li <?php activo("epigrafes") ?>><a href="index.php?page=epigrafes" title="Gestionar epígrafe"><span class="icono">E</span> Epígrafes</a></li>
                <li <?php activo("retenciones") ?>><a href="index.php?page=retenciones" title="Gestionar retenciones"><span class="icono">R</span> Retenciones</a></li>
                <hr>
                <li <?php activo("clientes") ?>><a href="index.php?page=clientes" title="Gestionar clientes"><span class="icono">C</span> Clientes</a></li>
                <li <?php activo("productos") ?>><a href="index.php?page=productos" title="Gestionar productos"><span class="icono">P</span> Productos</a></li>
                <li <?php activo("facturas") ?>><a href="index.php?page=facturas" title="Gestionar facturas"><span class="icono">F</span> Facturas</a></li>
                <li <?php activo("presupuestos") ?>><a href="index.php?page=presupuestos" title="Gestionar presupuestos"><span class="icono">P</span> Presupuestos</a></li>
                <hr>
                <li <?php activo("proveedores") ?>><a href="index.php?page=proveedores" title="Gestionar proveedores"><span class="icono">P</span> Proveedores</a></li>
                <li <?php activo("gastos") ?>><a href="index.php?page=gastos" title="Gestionar gastos"><span class="icono">G</span> Gastos</a></li>
                <hr>
                <li <?php activo("informes") ?>><a href="index.php?page=informes" title="Ver informes"><span class="icono">I</span> Informes</a></li>
                <hr>
                <!-- Nuevo grupo: Importar/Exportar -->
					<li><a href="index.php?page=exportar" title="Exportar datos"><span class="icono">E</span> Exportar</a></li>
					<li><a href="index.php?page=importar" title="Importar facturas"><span class="icono">I</span> Importar</a></li>
<hr>
                <li <?php activo("usuarios") ?>><a href="index.php?page=usuarios" title="Gestionar usuarios"><span class="icono">U</span> Usuarios</a></li>
                <hr>
                <li><a href="index.php?accion=logout" title="Cerrar sesión">Cerrar Sesión</a></li>
            </ul>
        </nav>
        <main class="admin-content">
            <?php
            // Enrutado de páginas mediante "page"
            $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
            switch ($page) {
                case 'dashboard':
                    include "paginas/escritorio.php";
                    break;
                case 'mis_datos':
                    include "paginas/misdatos.php";
                    break;
                case 'clientes':
                    include "paginas/clientes.php";
                    break;
                case 'cliente_crear':
                    include "paginas/crearcliente.php";
                    exit;
                case 'cliente_editar':
                    include "paginas/editarcliente.php";
                    exit;
                case 'productos':
                    include "paginas/productos.php";
                    break;
                case 'producto_crear':
                    include "paginas/crearproducto.php";
                    exit;
                case 'producto_editar':
                    include "paginas/editarproducto.php";
                    exit;
                case 'facturas':
                    include "paginas/facturas.php";
                    break;
                case 'factura_crear':
                    include "paginas/crearfactura.php";
                    exit;
                case 'factura_editar':
                    include "paginas/editarfactura.php";
                    exit;
                case 'factura_ver':
                    include "paginas/verfactura.php";
                    exit;
                case 'factura_imprimir':
                    include "paginas/imprimirfactura.php";
                    exit;
                // NUEVA RUTEA para Presupuestos:
                case 'presupuestos':
                    include "paginas/presupuestos.php";
                    break;
                case 'presupuesto_crear':
                    include "paginas/crearpresupuesto.php";
                    exit;
                case 'presupuesto_editar':
                    include "paginas/editarpresupuesto.php";
                    exit;
                case 'presupuesto_ver':
                    include "paginas/verpresupuesto.php";
                    exit;
                case 'presupuesto_imprimir':
                    include "paginas/imprimirpresupuesto.php";
                    exit;
                case 'usuarios':
                    include "paginas/usuarios.php";
                    break;
                case 'usuario_crear':
                    include "paginas/crearusuario.php";
                    exit;
                case 'usuario_editar':
                    include "paginas/editarusuario.php";
                    exit;
                case 'epigrafes':
                    include "paginas/epigrafes.php";
                    break;
                case 'epigrafes_crear':
                    include "paginas/crearepigrafe.php";
                    exit;
                case 'epigrafes_editar':
                    include "paginas/epigrafes_editar.php";
                    exit;
                case 'proveedores':
                    include "paginas/proveedores.php";
                    break;
                case 'crearproveedor':
                    include "paginas/crearproveedor.php";
                    exit;
                case 'editarproveedor':
                    include "paginas/editarproveedor.php";
                    exit;
                case 'gastos':
                    include "paginas/gastos.php";
                    break;
                case 'creargasto':
                    include "paginas/creargasto.php";
                    exit;
                case 'editargasto':
                    include "paginas/editargasto.php";
                    exit;
                case 'informes':
                    include "paginas/informes.php";
                    break;
                case 'informes_libro_ingresos':
                    include "paginas/informes_libro_ingresos.php";
                    break;
                case 'informes_libro_gastos':
                    include "paginas/informes_libro_gastos.php";
                    break;
                case 'informes_libro_mayor':
                    include "paginas/informes_libro_mayor.php";
                    break;
                case 'retenciones':
                    include "paginas/retenciones.php";
                    break;
                case 'retenciones_crear':
                    include "paginas/retenciones_crear.php";
                    exit;
                case 'retenciones_editar':
                    include "paginas/retenciones_editar.php";
                    exit;
                    // New routes for Importar / Exportar functionality
          case 'exportar':
              include "paginas/exportar.php";
              break;
          case 'importar':
              include "paginas/importar.php";
              break;
          case 'descargar_plantilla_importar':
              include "paginas/descargar_plantilla_importar.php";
              break;
                default:
                    echo "<p title='Página no encontrada'>Página no encontrada.</p>";
            }
            ?>
        </main>
    </div>
    <script src="https://ghostwhite.jocarsa.com/analytics.js?user=rosybrown.jocarsa.com"></script>
    
    
    <link rel="stylesheet" href="https://jocarsa.github.io/jocarsa-pink/jocarsa%20%7C%20pink.css">
    <script src="https://jocarsa.github.io/jocarsa-pink/jocarsa%20%7C%20pink.js"></script>
    <link rel="stylesheet" href="https://jocarsa.github.io/jocarsa-seashell/jocarsa%20%7C%20seashell.css">
    <script src="https://jocarsa.github.io/jocarsa-seashell/jocarsa%20%7C%20seashell.js"></script>
    <script src="https://jocarsa.github.io/jocarsa-silver/jocarsa-silver.js"></script>
    <link rel="stylesheet" href="https://jocarsa.github.io/jocarsa-silver/jocarsa-silver.css">
</body>
</html>


```
**landing.html**
```html
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jocarsa | rosybrown - Software Integral de Facturación y Administración</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    /* Estilos generales para la landing page extendida */
    body {
      font-family: 'Ubuntu', sans-serif;
      background: #f4f4f4;
      color: #333;
      line-height: 1.6;
      margin: 0;
      padding: 0;
    }
    header {
      background: #333;
      color: #fff;
      padding: 20px;
      text-align: center;
    }
    header img {
      width: 60px;
      vertical-align: middle;
    }
    header h1 {
      display: inline-block;
      vertical-align: middle;
      margin-left: 10px;
    }
    nav {
      background: #555;
      padding: 10px;
      text-align: center;
    }
    nav a {
      color: #fff;
      margin: 0 15px;
      text-decoration: none;
      font-weight: bold;
      transition: color 0.3s;
    }
    nav a:hover {
      color: #28a745;
    }
    /* Sección Hero */
    .hero {
      background: url('rosybrown.png') no-repeat center center/cover;
      padding: 100px 20px;
      color: #fff;
      text-align: center;
      position: relative;
    }
    .hero::after {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.5);
      z-index: 0;
    }
    .hero-content {
      position: relative;
      z-index: 1;
    }
    .hero-content h2 {
      font-size: 2.8em;
      margin-bottom: 20px;
    }
    .hero-content p {
      font-size: 1.2em;
      max-width: 800px;
      margin: 0 auto 20px;
    }
    .cta {
      display: inline-block;
      background: #28a745;
      color: #fff;
      padding: 15px 30px;
      border-radius: 5px;
      text-decoration: none;
      font-size: 1.2em;
      margin-top: 20px;
      transition: background 0.3s;
    }
    .cta:hover {
      background: #218838;
    }
    /* Secciones generales */
    .section {
      padding: 60px 20px;
    }
    .section h2 {
      text-align: center;
      margin-bottom: 30px;
      font-size: 2em;
    }
    .info-section {
      max-width: 1000px;
      margin: auto;
    }
    .features {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
    }
    .feature {
      background: #fff;
      border: 1px solid #ddd;
      padding: 20px;
      border-radius: 4px;
      width: 300px;
      text-align: center;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .feature h3 {
      margin-bottom: 15px;
      font-size: 1.5em;
    }
    .feature p {
      font-size: 0.95em;
    }
    .beneficios ul {
      list-style: none;
      padding: 0;
      font-size: 1.1em;
    }
    .beneficios li {
      margin-bottom: 15px;
    }
    .beneficios li strong {
      color: #28a745;
    }
    /* Sección Informes y Análisis */
    .informes {
      background: #e9ecef;
      padding: 40px 20px;
      border-radius: 4px;
      margin-bottom: 20px;
    }
    .informes p {
      font-size: 1.1em;
      line-height: 1.5;
    }
    /* Sección Demo */
    .demo-video {
      display: block;
      width: 100%;
      max-width: 800px;
      height: 450px;
      margin: 20px auto;
      border: none;
    }
    /* Sección de Precios */
    .pricing-cards {
      display: flex;
      justify-content: center;
      gap: 20px;
      flex-wrap: wrap;
    }
    .price-card {
      background: #fff;
      border: 1px solid #ddd;
      padding: 20px;
      border-radius: 4px;
      width: 300px;
      text-align: center;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .price-card h3 {
      margin-bottom: 15px;
      font-size: 1.5em;
    }
    .price-card p {
      font-size: 2em;
      margin: 20px 0;
    }
    .price-card ul {
      list-style: none;
      padding: 0;
      text-align: left;
    }
    /* Formulario de Contacto */
    .contact-form {
      max-width: 600px;
      margin: auto;
    }
    .contact-form label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }
    .contact-form input, .contact-form textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .contact-form button {
      background: #007bff;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 1em;
    }
    .contact-form button:hover {
      background: #0056b3;
    }
    footer {
      background: #333;
      color: #fff;
      text-align: center;
      padding: 20px;
      font-size: 0.9em;
    }
  </style>
</head>
<body>
  <header>
    <img src="rosybrown.png" alt="Logo jocarsa | rosybrown">
    <h1>jocarsa | rosybrown</h1>
  </header>
  <nav>
    <a href="#inicio">Inicio</a>
    <a href="#caracteristicas">Características</a>
    <a href="#beneficios">Beneficios</a>
    <a href="#informes">Informes y Análisis</a>
    <a href="#demo">Demo</a>
    <a href="#precios">Precios</a>
    <a href="#contacto">Contacto</a>
  </nav>
  <!-- Sección Hero -->
  <section id="inicio" class="hero">
    <div class="hero-content">
      <h2>Gestiona tu facturación y administración con total eficiencia</h2>
      <p>jocarsa | rosybrown es un software integral que te permite emitir facturas profesionales, gestionar clientes, productos, proveedores y gastos, y generar informes financieros interactivos.</p>
      <a href="index.php" class="cta">Acceder al Panel de Administración</a>
    </div>
  </section>
  <!-- Sección de Características -->
  <section id="caracteristicas" class="section">
    <div class="info-section">
      <h2>Características Destacadas</h2>
      <div class="features">
        <div class="feature">
          <h3>Facturación Completa</h3>
          <p>Crea, edita, imprime y elimina facturas de forma sencilla, con soporte para retenciones, epígrafes y observaciones personalizadas.</p>
        </div>
        <div class="feature">
          <h3>Gestión de Clientes y Productos</h3>
          <p>Administra toda la información de tus clientes y productos. Busca, filtra y actualiza registros para una facturación ágil.</p>
        </div>
        <div class="feature">
          <h3>Proveedores y Gastos</h3>
          <p>Registra proveedores y gastos, incluyendo fechas, totales y deducciones fiscales, facilitando la gestión contable.</p>
        </div>
        <div class="feature">
          <h3>Informes Financieros</h3>
          <p>Genera informes detallados: Libro de Ingresos, Gastos y Mayor. Visualiza datos mensuales, trimestrales y consolidados en gráficos interactivos.</p>
        </div>
        <div class="feature">
          <h3>Panel Multiusuario</h3>
          <p>Acceso seguro y controlado, con gestión de usuarios y roles. Permite que varios colaboradores trabajen simultáneamente sin comprometer la seguridad.</p>
        </div>
        <div class="feature">
          <h3>Personalización Total</h3>
          <p>Ajusta datos de facturación, retenciones, epígrafes y más. Configura tu información de empresa para que tus facturas reflejen tu identidad.</p>
        </div>
      </div>
    </div>
  </section>
  <!-- Sección de Beneficios -->
  <section id="beneficios" class="section" style="background: #e9ecef;">
    <div class="info-section beneficios">
      <h2>Beneficios y Ventajas</h2>
      <ul>
        <li><strong>Eficiencia y Productividad:</strong> Automatiza tareas administrativas y reduce el tiempo invertido en la gestión manual.</li>
        <li><strong>Informes Interactivos:</strong> Visualiza gráficos de líneas, barras y pastel para un análisis detallado de tus ingresos y gastos.</li>
        <li><strong>Interfaz Intuitiva:</strong> Diseñada para facilitar su uso, incluso para quienes no cuentan con conocimientos técnicos.</li>
        <li><strong>Seguridad y Control:</strong> Acceso restringido y gestión de múltiples usuarios, garantizando la confidencialidad de los datos.</li>
        <li><strong>Flexibilidad y Escalabilidad:</strong> Adaptable a negocios de cualquier tamaño, con capacidad para personalizar cada aspecto del sistema.</li>
      </ul>
    </div>
  </section>
  <!-- Sección de Informes y Análisis -->
  <section id="informes" class="section">
    <div class="info-section">
      <h2>Informes y Análisis</h2>
      <p>Con jocarsa | rosybrown, obtén una visión clara de la salud financiera de tu negocio. Gracias a sus módulos de informes podrás:</p>
      <ul>
        <li>Consolidar ingresos y gastos por periodos (mensuales, trimestrales y anuales) mediante el Libro Mayor.</li>
        <li>Generar gráficos interactivos en el escritorio que muestran la evolución de tu facturación.</li>
        <li>Realizar búsquedas y filtrados avanzados en cada módulo: Ingresos, Gastos y reportes detallados.</li>
        <li>Acceder a información en tiempo real para tomar decisiones basadas en datos precisos.</li>
      </ul>
      <p>Estas herramientas están diseñadas para que puedas monitorear el rendimiento de tu empresa y ajustar tus estrategias de forma oportuna.</p>
    </div>
  </section>
  <!-- Sección Demo -->
  <section id="demo" class="section" style="background: #f0f2f5;">
    <div class="info-section">
      <h2>Demostración del Software</h2>
      <p>Explora cómo jocarsa | rosybrown simplifica la gestión administrativa y contable con una interfaz intuitiva y potentes herramientas de informes.</p>
      <!-- Video incrustado de YouTube -->
      <iframe class="demo-video" src="https://www.youtube.com/embed/VEu8hz-vdYs" title="Demo jocarsa | rosybrown" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      <p style="text-align:center; font-size:1.1em;">Conoce la demo interactiva y descubre por qué miles de usuarios confían en nuestra solución.</p>
    </div>
  </section>
  <!-- Sección de Precios -->
  <section id="precios" class="section" style="background: #e9ecef;">
    <div class="info-section">
      <h2>Precios</h2>
      <div class="pricing-cards">
        <div class="price-card">
          <h3>Básico</h3>
          <p>9,95€/mes</p>
          <ul>
            <li>Funcionalidades básicas</li>
            <li>Soporte por email</li>
          </ul>
        </div>
        <div class="price-card">
          <h3>Pro</h3>
          <p>19,95€/mes</p>
          <ul>
            <li>Todo lo del Básico</li>
            <li>Funcionalidades avanzadas</li>
            <li>Soporte prioritario</li>
          </ul>
        </div>
        <div class="price-card">
          <h3>Enterprise</h3>
          <p>45,95€/mes</p>
          <ul>
            <li>Todo lo del Pro</li>
            <li>Soporte dedicado</li>
            <li>Personalización total</li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- Sección de Contacto -->
  <section id="contacto" class="section">
    <div class="info-section">
      <h2>Contacto</h2>
      <p>¿Tienes alguna pregunta o deseas obtener más información? Nuestro equipo está listo para ayudarte.</p>
      <form class="contact-form" action="mailto:soporte@jocarsa.com" method="post" enctype="text/plain">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>
        <label for="mensaje">Mensaje:</label>
        <textarea id="mensaje" name="mensaje" rows="5" required></textarea>
        <div style="text-align:center;">
          <button type="submit">Enviar Mensaje</button>
        </div>
      </form>
    </div>
  </section>
  <footer>
    <p>&copy; 2025 jocarsa | rosybrown. Todos los derechos reservados.</p>
    <p>Contacto: soporte@jocarsa.com</p>
  </footer>
</body>
</html>


```
## api
**get_pending_payments.php**
```php
<?php
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION['usuario'])) {
    echo json_encode(['error' => 'Not logged in']);
    exit;
}
$config = require_once '../config.php';

try {
    $db = new PDO("sqlite:../../databases/rosybrown.sqlite");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $ex) {
    echo json_encode(['error' => 'Database connection error']);
    exit;
}
$userId = $_SESSION['usuario']['id'];

$stmt = $db->prepare("SELECT f.*, c.name as cliente_nombre FROM facturas f
                      LEFT JOIN clientes c ON f.cliente_id = c.id
                      WHERE f.user_id = ? AND f.paid = 0");
$stmt->execute([$userId]);
$pendingInvoices = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalPending = 0;
$pendingByCustomer = [];
foreach ($pendingInvoices as $inv) {
    $totalPending += (float)$inv['total'];
    $customer = $inv['cliente_nombre'] ? $inv['cliente_nombre'] : 'Sin cliente';
    if (!isset($pendingByCustomer[$customer])) {
        $pendingByCustomer[$customer] = 0;
    }
    $pendingByCustomer[$customer] += (float)$inv['total'];
}

echo json_encode(['total' => $totalPending, 'byCustomer' => $pendingByCustomer]);
?>


```
**invoice.php**
```php
<?php
// /var/www/html/jocarsa-rosybrown/api/invoice.php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON']);
    exit;
}

$headers = getallheaders();
$apiKey = isset($headers['Authorization']) ? trim(str_replace('Bearer', '', $headers['Authorization'])) : '';
if ($apiKey !== 'YOUR_API_TOKEN') {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$config = require_once '../config.php';
try {
    $db = new PDO($config['db_url']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $ex) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection error']);
    exit;
}

// Map input data
$invoice_number = $input['invoice_number'] ?? null;
$date           = $input['date'] ?? null;
$customer       = $input['customer'] ?? null;
$lines          = $input['lines'] ?? [];
$subtotal       = $input['subtotal'] ?? 0;
$iva            = $input['iva'] ?? 0;
$retention      = $input['retention'] ?? 0;
$total          = $input['total'] ?? 0;
$softwareBUserId = $input['software_b_user_id'] ?? null;

if (!$invoice_number || !$date || !$customer || !$softwareBUserId) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required fields']);
    exit;
}

// Function to get or create customer record for the given Software B user id
function getOrCreateCustomer($db, $customer, $softwareBUserId) {
    $stmt = $db->prepare("SELECT id FROM clientes WHERE email = ? AND user_id = ? LIMIT 1");
    $stmt->execute([$customer['email'], $softwareBUserId]);
    $existing = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($existing) {
        return $existing['id'];
    } else {
        $stmt = $db->prepare("INSERT INTO clientes (name, email, address, id_number, user_id) VALUES (?,?,?,?,?)");
        $stmt->execute([
            $customer['name'],
            $customer['email'],
            $customer['address'] ?? '',
            $customer['id_number'] ?? '',
            $softwareBUserId
        ]);
        return $db->lastInsertId();
    }
}

$customer_id = getOrCreateCustomer($db, $customer, $softwareBUserId);

// Insert invoice record into "facturas" (in Software B)
$stmt = $db->prepare("INSERT INTO facturas (invoice_number, fecha, cliente_id, total, user_id) VALUES (?,?,?,?,?)");
$stmt->execute([$invoice_number, $date, $customer_id, $total, $softwareBUserId]);
$invoice_id = $db->lastInsertId();

// Insert each invoice line into "lineas_factura"
$stmtLine = $db->prepare("INSERT INTO lineas_factura (factura_id, producto, description, cantidad, precio_unitario, total) VALUES (?,?,?,?,?,?)");
foreach ($lines as $line) {
    $cantidad = $line['quantity'] ?? 0;
    $precio_unitario = $line['unit_price'] ?? 0;
    $line_total = $cantidad * $precio_unitario;
    $stmtLine->execute([
        $invoice_id,
        $line['product']['name'] ?? '',
        $line['product']['description'] ?? '',
        $cantidad,
        $precio_unitario,
        $line_total
    ]);
}

http_response_code(201);
echo json_encode(['success' => true, 'invoice_id' => $invoice_id]);


```
**update_paid.php**
```php
<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['usuario'])) {
    echo json_encode(['error' => 'Not logged in']);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Invalid method']);
    exit;
}

$config = require_once '../config.php';

try {
    $db = new PDO("sqlite:../../databases/rosybrown.sqlite");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $ex) {
    echo json_encode(['error' => 'Database connection error 2']);
    exit;
}

if (!isset($_POST['invoice_id']) || !isset($_POST['paid'])) {
    echo json_encode(['error' => 'Missing parameters']);
    exit;
}
$invoice_id = intval($_POST['invoice_id']);
$paid = ($_POST['paid'] == '1') ? 1 : 0;
$userId = $_SESSION['usuario']['id'];

$stmt = $db->prepare("UPDATE facturas SET paid = ? WHERE id = ? AND user_id = ?");
$result = $stmt->execute([$paid, $invoice_id, $userId]);
if ($result) {
    echo json_encode(['success' => true, 'paid' => $paid]);
} else {
    echo json_encode(['error' => 'Update failed']);
}
?>


```
## css
**style.css**
```css
/* Reset y configuración base */
@import url('https://static.jocarsa.com/fuentes/ubuntu-font-family-0.83/ubuntu.css');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Ubuntu', sans-serif;
    background: #f0f2f5;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    background:#333;
}

/* Panel de Administración */
.admin-header {
    background: #333;
    color: #fff;
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-left:10px;
}

.admin-container {
    flex: 1;
    display: flex;
    width: 100%;
}

.admin-nav {
    width: 220px;
    background: #333;
    padding: 20px;
    padding-right:0px;
}

.admin-nav ul {
    list-style: none;
}

.admin-nav ul li {
    margin-bottom: 15px;
    margin-top:10px;
    padding-left:0px;
}

.admin-nav ul li a {
    color: #fff;
    text-decoration: none;
    font-weight: bold;
}

.admin-content {
    flex: 1;
    padding: 30px;
    background: #fff;
    overflow-y: auto;
    border-radius:20px 0px 0px 0px;
}

/* Formularios a ancho completo */
form {
    margin-bottom: 20px;
    width: 100%;
}

.form-full {
    width: 100%;
}

form label {
    display: block;
    margin: 10px 0 5px;
    font-weight: bold;
}

form input[type="text"],
form input[type="password"],
form input[type="date"],
form input[type="number"],
form textarea,
form select {
    width: 100%;
    padding: 10px;
    border: 1px solid #bbb;
    border-radius: 4px;
    margin-bottom: 10px;
}

form button, .btn-submit {
    background: #28a745;
    color: #fff;
    border: none;
    padding: 12px 20px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 10px;
    margin-bottom: 20px;
    width:100%;
}

form button:hover, .btn-submit:hover {
    background: #218838;
}

/* Login */
.login-container {
    max-width: 400px;
    margin: 100px auto;
    background: #fff;
    padding: 30px;
    border-radius: 250px 250px 4px 4px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.login-container h2 {
    text-align: center;
    margin-bottom: 20px;
}

.login-container .error {
    color: red;
    text-align: center;
    margin-bottom: 10px;
}

/* Factura: creación/edición/imprimir */
.invoice-preview {
    border: 1px solid #ddd;
    padding: 20px;
    margin-bottom: 20px;
    background: #fff;
    width: 100%;
}

.invoice-preview .header {
    text-align: center;
    background: black;
    color: white;
    padding: 20px;
    margin-bottom: 20px;
}

.invoice-preview .header h1 {
    font-size: 24px;
    margin-bottom: 5px;
}

.invoice-preview .header h2 {
    font-size: 18px;
    margin-top: 0;
}

.invoice-number {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
}

.invoice-details {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
}

.invoice-details .sender-details,
.invoice-details .recipient-details {
    width: 48%;
}

.invoice-details h3 {
    border-bottom: 1px solid #ddd;
    padding-bottom: 5px;
    margin-bottom: 10px;
}

.invoice-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

.invoice-table th,
.invoice-table td {
    border: 1px solid #ddd;
    padding: 10px;
}

.invoice-table th {
    background: #f8f8f8;
}

.price-column {
    text-align: right;
}

.total-section {
    text-align: right;
    padding: 10px 0;
}

.total-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 5px;
}

.total-row.final {
    font-weight: bold;
    border-top: 1px solid #ddd;
    padding-top: 10px;
}

.bank-details {
    margin-top: 20px;
    border-top: 1px solid #ddd;
    padding-top: 10px;
}

.footer {
    font-size: 10px;
    text-align: center;
    border-top: 1px solid #ddd;
    padding: 10px;
    margin-top: 20px;
}

/* Tablas en listados CRUD */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 10px;
    text-align: left;
}

@media print {
    header, nav {
        display: none !important;
    }
    #factura {
        display: block !important;
        visibility: visible !important;
        position: relative;
        left: 0;
        top: 0;
        width: 100%;
    }
    body {
        margin: 0;
        padding: 0;
    }
    @page {
        size: A4;
        margin: 20mm;
    }
}

/* Estilo para formularios en dos columnas */
.admin-container .form-row {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.form-label {
    flex: 0 0 40%;
    padding-right: 10px;
    font-weight: bold;
}

.form-field {
    flex: 1;
}

/* New styles for charts grid layout */
#charts-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    padding: 20px;
}
header h1{
	display: flex;
	flex-direction: row;
	flex-wrap: nowrap;
	justify-content: center;
	align-items: center;
	align-content: stretch;
	padding-left:6px;
}
header h1 img{
	width:40px;
	margin-right:20px;
}
hr{
	border:none;
	border-top:1px solid gainsboro;
	margin-bottom:10px;
}
.activo{
	background:white;
	padding:10px;
	width:100%;
	border-radius:100px 0px 0px 100px;
}
.activo .icono{
	color:white;
	background:#333;
	margin-left:10px;
}
.activo a{
	color:black !important;
}
p{
	padding:20px;
}
.observaciones{
	padding:10px;
}
.observaciones h3{
	border-bottom:1px solid #ddd;
}
/* Toggle Switch */
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  transition: 0.4s;
  border-radius: 24px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 18px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  transition: 0.4s;
  border-radius: 50%;
}

input:checked + .slider {
  background-color: #28a745;
}

input:checked + .slider:before {
  transform: translateX(26px);
}
#pending-summary ul{
	padding-left:50px;
}
.cabecera{
	display: flex;
	flex-direction: row;
	flex-wrap: nowrap;
	justify-content: space-between;
	align-items: center;
	align-content: stretch;
	gap:20px;
}
.cabecera a{
	flex:1;
	text-align:center;
	text-decoration:none;
}
.cabecera h2{
	flex:1;
}
.cabecera p{
	flex:5;
}
.icono{
	width:30px;
	height:30px;
	background:white;
	border-radius:30px;
	color:black;
	display:inline-block;
	text-align:center;
	font-size:16px;
	line-height:30px;
	margin-right:10px;
}


```
## inc
**cerrarsesion.php**
```php
<?php
// Procesar cierre de sesión
if (isset($_GET['accion']) && $_GET['accion'] == 'logout') {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>

```
**inicializardb.php**
```php
<?php
// inc/inicializardb.php
function inicializarDB($db) {
    // -----------------------
    // Table: usuarios (unchanged)
    // -----------------------
    $db->exec("CREATE TABLE IF NOT EXISTS usuarios (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        usuario TEXT UNIQUE,
        email TEXT,
        nombre TEXT,
        password TEXT
    )");
    $stmt = $db->prepare("SELECT COUNT(*) FROM usuarios WHERE usuario = ?");
    $stmt->execute(['jocarsa']);
    if ($stmt->fetchColumn() == 0) {
        // In production use password_hash()/password_verify()
        $stmt = $db->prepare("INSERT INTO usuarios (usuario, email, nombre, password) VALUES (?,?,?,?)");
        $stmt->execute(['jocarsa', 'info@josevicentecarratala.com', 'José Vicente Carratala', 'jocarsa']);
    }
    
    // -----------------------
    // Table: mis_datos – one record per user now
    // -----------------------
    $db->exec("CREATE TABLE IF NOT EXISTS mis_datos (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        invoice_title TEXT,
        invoice_subtitle TEXT,
        my_name TEXT,
        address TEXT,
        postal_code TEXT,
        city TEXT,
        id_number TEXT,
        bank_account TEXT,
        invoice_footer TEXT,
        user_id INTEGER,
        FOREIGN KEY(user_id) REFERENCES usuarios(id)
    )");
    $stmt = $db->prepare("SELECT COUNT(*) FROM mis_datos WHERE user_id = ?");
    $stmt->execute([1]);
    if ($stmt->fetchColumn() == 0) {
        $db->exec("INSERT INTO mis_datos (invoice_title, invoice_subtitle, my_name, address, postal_code, city, id_number, bank_account, invoice_footer, user_id)
        VALUES ('FACTURA', 'SERVICIO PROFESIONAL', 'Su Nombre', 'Su Dirección', '00000', 'Ciudad', 'ID123456', 'ESXX XXXX XXXX XXXX XXXX XXXX', 'Gracias por su compra', 1)");
    }
    
    // -----------------------
    // Table: clientes – add user_id
    // -----------------------
    $db->exec("CREATE TABLE IF NOT EXISTS clientes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT,
        address TEXT,
        postal_code TEXT,
        city TEXT,
        id_number TEXT,
        user_id INTEGER,
        FOREIGN KEY(user_id) REFERENCES usuarios(id)
    )");

    // -----------------------
    // Table: productos – add user_id
    // -----------------------
    $db->exec("CREATE TABLE IF NOT EXISTS productos (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nombre TEXT,
        descripcion TEXT,
        price REAL,
        user_id INTEGER,
        FOREIGN KEY(user_id) REFERENCES usuarios(id)
    )");

    // -----------------------
    // Table: epigrafes – add user_id
    // -----------------------
    $db->exec("CREATE TABLE IF NOT EXISTS epigrafes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT,
        iva_percentage INTEGER,
        user_id INTEGER,
        FOREIGN KEY(user_id) REFERENCES usuarios(id)
    )");

    // -----------------------
    // Table: facturas – add retencion_id, paid flag and user_id
    // -----------------------
    $db->exec("CREATE TABLE IF NOT EXISTS facturas (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        invoice_number TEXT,
        fecha TEXT,
        cliente_id INTEGER,
        mis_datos_id INTEGER,
        total REAL,
        epigrafe_id INTEGER,
        retencion_id INTEGER,
        paid INTEGER DEFAULT 1,
        user_id INTEGER,
        FOREIGN KEY(cliente_id) REFERENCES clientes(id),
        FOREIGN KEY(mis_datos_id) REFERENCES mis_datos(id),
        FOREIGN KEY(epigrafe_id) REFERENCES epigrafes(id),
        FOREIGN KEY(retencion_id) REFERENCES retenciones(id),
        FOREIGN KEY(user_id) REFERENCES usuarios(id)
    )");

    // -----------------------
    // Table: lineas_factura
    // -----------------------
    $db->exec("CREATE TABLE IF NOT EXISTS lineas_factura (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        factura_id INTEGER,
        producto_id INTEGER,
        cantidad INTEGER,
        precio_unitario REAL,
        total REAL,
        FOREIGN KEY(factura_id) REFERENCES facturas(id),
        FOREIGN KEY(producto_id) REFERENCES productos(id)
    )");

    // -----------------------
    // Table: proveedores – add user_id
    // -----------------------
    $db->exec("CREATE TABLE IF NOT EXISTS proveedores (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        razon_social TEXT,
        direccion TEXT,
        codigo_postal TEXT,
        poblacion TEXT,
        identificacion_fiscal TEXT,
        contacto_nombre TEXT,
        contacto_email TEXT,
        contacto_telefono TEXT,
        user_id INTEGER,
        FOREIGN KEY(user_id) REFERENCES usuarios(id)
    )");

    // -----------------------
    // Table: gastos – add user_id
    // -----------------------
    $db->exec("CREATE TABLE IF NOT EXISTS gastos (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        gasto_deducible REAL,
        fecha_emision TEXT,
        fecha_operaciones TEXT,
        numero_factura TEXT,
        fecha_factura TEXT,
        proveedor_id INTEGER,
        total_factura REAL,
        base_imponible REAL,
        tipo_retencion TEXT,
        importe_retencion REAL,
        tipo_iva TEXT,
        cuota_iva REAL,
        iva_deducido REAL,
        user_id INTEGER,
        FOREIGN KEY(proveedor_id) REFERENCES proveedores(id),
        FOREIGN KEY(user_id) REFERENCES usuarios(id)
    )");

    // -----------------------
    // Table: retenciones – for IRPF/retención settings per user
    // -----------------------
    $db->exec("CREATE TABLE IF NOT EXISTS retenciones (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT,
        percentage REAL,
        user_id INTEGER,
        FOREIGN KEY(user_id) REFERENCES usuarios(id)
    )");

    // -----------------------
    // Table: observaciones_factura – to store invoice observations
    // -----------------------
    $db->exec("CREATE TABLE IF NOT EXISTS observaciones_factura (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        factura_id INTEGER,
        observaciones TEXT,
        user_id INTEGER,
        FOREIGN KEY(factura_id) REFERENCES facturas(id),
        FOREIGN KEY(user_id) REFERENCES usuarios(id)
    )");

    // -----------------------
    // Table: presupuestos – for quotes
    // -----------------------
    $db->exec("CREATE TABLE IF NOT EXISTS presupuestos (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        presupuesto_number TEXT,
        fecha TEXT,
        cliente_id INTEGER,
        mis_datos_id INTEGER,
        total REAL,
        epigrafe_id INTEGER,
        retencion_id INTEGER,
        user_id INTEGER,
        FOREIGN KEY(cliente_id) REFERENCES clientes(id),
        FOREIGN KEY(mis_datos_id) REFERENCES mis_datos(id),
        FOREIGN KEY(epigrafe_id) REFERENCES epigrafes(id),
        FOREIGN KEY(retencion_id) REFERENCES retenciones(id),
        FOREIGN KEY(user_id) REFERENCES usuarios(id)
    )");

    // -----------------------
    // Table: lineas_presupuesto – for quote lines
    // -----------------------
    $db->exec("CREATE TABLE IF NOT EXISTS lineas_presupuesto (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        presupuesto_id INTEGER,
        producto_id INTEGER,
        cantidad INTEGER,
        precio_unitario REAL,
        total REAL,
        FOREIGN KEY(presupuesto_id) REFERENCES presupuestos(id),
        FOREIGN KEY(producto_id) REFERENCES productos(id)
    )");
}
inicializarDB($db);
?>


```
**login.php**
```php
<?php

	// Procesar login si el usuario no está autenticado
if (!isset($_SESSION['usuario'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['usuario'], $_POST['password'])) {
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->execute([$_POST['usuario']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && $user['password'] === $_POST['password']) {
            $_SESSION['usuario'] = $user;
            header("Location: index.php");
            exit;
        } else {
            $error_login = "Usuario o contraseña incorrectos.";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>jocarsa | rosybrown - Iniciar Sesión</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="login-container">
            <!-- Cabecera con nombre de la aplicación y logo -->
            <div class="app-header" title="jocarsa | rosybrown">
                <img src="rosybrown.png" alt="Logo jocarsa | rosybrown" title="Logo jocarsa | rosybrown" style="max-width:100%; display:block; margin:0 auto;">
                <h1 style="text-align:center">jocarsa | rosybrown</h1>
            </div>
            
            <?php if(isset($error_login)) echo "<p class='error' title='Mensaje de error'>$error_login</p>"; ?>
            <form method="post" action="index.php">
                <div class="form-row">
                    <div class="form-label">
                        <label title="Ingrese su usuario (ej: jocarsa)">Usuario:</label>
                    </div>
                    <div class="form-field">
                        <input type="text" name="usuario" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-label">
                        <label title="Ingrese su contraseña">Contraseña:</label>
                    </div>
                    <div class="form-field">
                        <input type="password" name="password" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field" style="margin-left: auto;">
                        <button type="submit" title="Haga clic para acceder">Acceder</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
}

?>

```
## js
**charts.js**
```js
// myCharts.js

// Helper: create an SVG element with the proper namespace.
function createSVG(width, height) {
  const svgNS = "http://www.w3.org/2000/svg";
  const svg = document.createElementNS(svgNS, "svg");
  svg.setAttribute("width", width);
  svg.setAttribute("height", height);
  svg.style.border = "1px solid #ddd";
  return svg;
}

// Helper: create a tooltip element (hidden by default)
function createTooltip() {
  const tooltip = document.createElement("div");
  tooltip.style.position = "absolute";
  tooltip.style.background = "rgba(0,0,0,0.7)";
  tooltip.style.color = "#fff";
  tooltip.style.padding = "5px 10px";
  tooltip.style.borderRadius = "4px";
  tooltip.style.pointerEvents = "none";
  tooltip.style.fontSize = "12px";
  tooltip.style.display = "none";
  document.body.appendChild(tooltip);
  return tooltip;
}

const tooltip = createTooltip();

// Chart Library Object
const MyCharts = {
  // Create an interactive line chart
  createLineChart: function (data, config = {}) {
  // Configuration
  const width = config.width || 600;
  const height = config.height || 400;
  // Increase bottom and left margins to allow space for axis labels
  const margin = config.margin || { top: 20, right: 20, bottom: 50, left: 50 };
  const stroke = config.stroke || "steelblue";
  const strokeWidth = config.strokeWidth || 2;
  const circleRadius = config.circleRadius || 4;
  
  const svg = createSVG(width, height);
  const plotWidth = width - margin.left - margin.right;
  const plotHeight = height - margin.top - margin.bottom;
  const svgNS = "http://www.w3.org/2000/svg";
  
  // Determine scales
  // x values are timestamps; y values start at 0
  const xMin = Math.min(...data.map(d => d.x));
  const xMax = Math.max(...data.map(d => d.x));
  const yMin = 0;
  const yMax = Math.max(...data.map(d => d.y));
  
  // Scale functions (linear)
  const scaleX = d => margin.left + ((d - xMin) / (xMax - xMin)) * plotWidth;
  const scaleY = d => margin.top + plotHeight - ((d - yMin) / (yMax - yMin)) * plotHeight;
  
  // Draw horizontal gridlines and y-axis labels
  const numYTicks = 5;
  for (let i = 0; i <= numYTicks; i++) {
    const tickValue = yMin + (i * (yMax - yMin)) / numYTicks;
    const y = scaleY(tickValue);
    
    // Horizontal gridline
    const hLine = document.createElementNS(svgNS, "line");
    hLine.setAttribute("x1", margin.left);
    hLine.setAttribute("y1", y);
    hLine.setAttribute("x2", margin.left + plotWidth);
    hLine.setAttribute("y2", y);
    hLine.setAttribute("stroke", "#ccc");
    hLine.setAttribute("stroke-dasharray", "4 2");
    svg.appendChild(hLine);
    
    // Y-axis label
    const text = document.createElementNS(svgNS, "text");
    text.setAttribute("x", margin.left - 10);
    text.setAttribute("y", y + 4); // Adjust vertically to center the text
    text.setAttribute("text-anchor", "end");
    text.setAttribute("font-size", "12px");
    text.textContent = tickValue.toFixed(0);
    svg.appendChild(text);
  }
  
  // Draw vertical gridlines and x-axis labels
  // Here we assume each data point corresponds to a month (data is sorted)
  const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
  data.forEach(d => {
    const x = scaleX(d.x);
    // Vertical gridline
    const vLine = document.createElementNS(svgNS, "line");
    vLine.setAttribute("x1", x);
    vLine.setAttribute("y1", margin.top);
    vLine.setAttribute("x2", x);
    vLine.setAttribute("y2", margin.top + plotHeight);
    vLine.setAttribute("stroke", "#ccc");
    vLine.setAttribute("stroke-dasharray", "4 2");
    svg.appendChild(vLine);
    
    // X-axis label: convert timestamp to month-year format
    const date = new Date(d.x);
    const label = monthNames[date.getMonth()] + " " + date.getFullYear();
    const text = document.createElementNS(svgNS, "text");
    text.setAttribute("x", x);
    text.setAttribute("y", margin.top + plotHeight + 20);
    text.setAttribute("text-anchor", "middle");
    text.setAttribute("font-size", "12px");
    text.textContent = label;
    svg.appendChild(text);
  });
  
  // Draw the line path
  const pathData = data.map((d, i) => {
    const prefix = i === 0 ? "M" : "L";
    return `${prefix} ${scaleX(d.x)} ${scaleY(d.y)}`;
  }).join(" ");
  
  const path = document.createElementNS(svgNS, "path");
  path.setAttribute("d", pathData);
  path.setAttribute("fill", "none");
  path.setAttribute("stroke", stroke);
  path.setAttribute("stroke-width", strokeWidth);
  svg.appendChild(path);
  
  // Draw data points and add labels with the value on top of each dot
  data.forEach(d => {
    const cx = scaleX(d.x);
    const cy = scaleY(d.y);
    
    // Draw the dot
    const circle = document.createElementNS(svgNS, "circle");
    circle.setAttribute("cx", cx);
    circle.setAttribute("cy", cy);
    circle.setAttribute("r", circleRadius);
    circle.setAttribute("fill", stroke);
    circle.style.cursor = "pointer";
    svg.appendChild(circle);
    
    // Label the dot with its y value
    const labelText = document.createElementNS(svgNS, "text");
    labelText.setAttribute("x", cx);
    labelText.setAttribute("y", cy - circleRadius - 5);
    labelText.setAttribute("text-anchor", "middle");
    labelText.setAttribute("font-size", "12px");
    labelText.setAttribute("fill", "#000");
    labelText.textContent = d.y.toFixed(2);
    svg.appendChild(labelText);
    
    // Optional tooltip events for additional interactivity
    circle.addEventListener("mouseover", (e) => {
      tooltip.innerHTML = `x: ${new Date(d.x).toLocaleDateString()}<br>y: ${d.y}`;
      tooltip.style.display = "block";
    });
    circle.addEventListener("mousemove", (e) => {
      tooltip.style.left = e.pageX + 10 + "px";
      tooltip.style.top = e.pageY + 10 + "px";
    });
    circle.addEventListener("mouseout", () => {
      tooltip.style.display = "none";
    });
  });
  
  return svg;
}
,

  createBarChart: function (data, config = {}) {
  const width = config.width || 600;
  const height = config.height || 400;
  const margin = config.margin || { top: 20, right: 20, bottom: 40, left: 40 };
  const barColor = config.barColor || "purple";

  const svg = createSVG(width, height);
  const plotWidth = width - margin.left - margin.right;
  const plotHeight = height - margin.top - margin.bottom;
  const svgNS = "http://www.w3.org/2000/svg";

  // Calculate bar dimensions
  const barWidth = plotWidth / data.length * 0.8;
  const barGap = (plotWidth / data.length) * 0.2;
  const maxValue = Math.max(...data.map(d => d.value));

  // Draw horizontal gridlines (for y-axis ticks)
  const numYTicks = 5;
  for (let i = 0; i <= numYTicks; i++) {
    const tickValue = (i * maxValue) / numYTicks;
    const y = margin.top + plotHeight - (tickValue / maxValue) * plotHeight;
    const line = document.createElementNS(svgNS, "line");
    line.setAttribute("x1", margin.left);
    line.setAttribute("y1", y);
    line.setAttribute("x2", margin.left + plotWidth);
    line.setAttribute("y2", y);
    line.setAttribute("stroke", "#ccc");
    line.setAttribute("stroke-dasharray", "4 2");
    svg.appendChild(line);
  }

  // Draw bars
  data.forEach((d, i) => {
    const x = margin.left + i * (barWidth + barGap) + barGap / 2;
    const barHeight = (d.value / maxValue) * plotHeight;
    const y = margin.top + plotHeight - barHeight;
    const rect = document.createElementNS(svgNS, "rect");
    rect.setAttribute("x", x);
    rect.setAttribute("y", y);
    rect.setAttribute("width", barWidth);
    rect.setAttribute("height", barHeight);
    rect.setAttribute("fill", barColor);
    rect.style.cursor = "pointer";
    rect.addEventListener("mouseover", (e) => {
      tooltip.innerHTML = `${d.label}: ${d.value}`;
      tooltip.style.display = "block";
    });
    rect.addEventListener("mousemove", (e) => {
      tooltip.style.left = e.pageX + 10 + "px";
      tooltip.style.top = e.pageY + 10 + "px";
    });
    rect.addEventListener("mouseout", () => {
      tooltip.style.display = "none";
    });
    svg.appendChild(rect);

    // Add label below each bar
    const text = document.createElementNS(svgNS, "text");
    text.setAttribute("x", x + barWidth / 2);
    text.setAttribute("y", margin.top + plotHeight + 15);
    text.setAttribute("text-anchor", "middle");
    text.setAttribute("font-size", "12px");
    text.textContent = d.label;
    svg.appendChild(text);
  });

  return svg;
},

  // Create an interactive pie chart
  createPieChart: function (data, config = {}) {
  const width = 600;
  const height = config.height || 400;
  const colors = config.colors || ["#4daf4a", "#377eb8", "#ff7f00", "#984ea3", "#e41a1c"];
  const radius = Math.min(width, height) / 2;
  const svg = createSVG(width, height);
  const svgNS = "http://www.w3.org/2000/svg";
  const centerX = width / 2;
  const centerY = height / 2;
  
  const total = data.reduce((acc, d) => acc + d.value, 0);
  let startAngle = 0;
  
  data.forEach((d, i) => {
    const sliceAngle = (d.value / total) * Math.PI * 2;
    const endAngle = startAngle + sliceAngle;
    
    // Calculate path for the slice
    const x1 = centerX + radius * Math.cos(startAngle);
    const y1 = centerY + radius * Math.sin(startAngle);
    const x2 = centerX + radius * Math.cos(endAngle);
    const y2 = centerY + radius * Math.sin(endAngle);
    const largeArcFlag = sliceAngle > Math.PI ? 1 : 0;
    
    const pathData = [
      `M ${centerX} ${centerY}`,
      `L ${x1} ${y1}`,
      `A ${radius} ${radius} 0 ${largeArcFlag} 1 ${x2} ${y2}`,
      "Z"
    ].join(" ");
    
    const path = document.createElementNS(svgNS, "path");
    path.setAttribute("d", pathData);
    path.setAttribute("fill", colors[i % colors.length]);
    path.style.cursor = "pointer";
    
    // Tooltip events for the slice
    path.addEventListener("mouseover", (e) => {
      tooltip.innerHTML = `${d.label}: ${d.value}`;
      tooltip.style.display = "block";
    });
    path.addEventListener("mousemove", (e) => {
      tooltip.style.left = e.pageX + 10 + "px";
      tooltip.style.top = e.pageY + 10 + "px";
    });
    path.addEventListener("mouseout", () => {
      tooltip.style.display = "none";
    });
    svg.appendChild(path);
    
    // Calculate the middle angle for label positioning
    const midAngle = startAngle + sliceAngle / 2;
    const labelRadius = radius * 0.7; // adjust for inside placement
    const labelX = centerX + labelRadius * Math.cos(midAngle);
    const labelY = centerY + labelRadius * Math.sin(midAngle);
    const percentage = ((d.value / total) * 100).toFixed(1);
    const text = document.createElementNS(svgNS, "text");
    text.setAttribute("x", labelX);
    text.setAttribute("y", labelY);
    text.setAttribute("text-anchor", "middle");
    text.setAttribute("font-size", "12px");
    text.setAttribute("fill", "#fff");
    text.textContent = `${d.label}: ${d.value} (${percentage}%)`;
    svg.appendChild(text);
    
    startAngle = endAngle;
  });
  
  return svg;
}
};


```
**script.js**
```js
let indiceLinea = 1;

function agregarLinea(){
    const contenedor = document.getElementById('lineas_factura');
    // Get the options from the first select (which now include data-price attributes)
    const primerSelect = contenedor.querySelector('select');
    const opcionesHTML = primerSelect ? primerSelect.innerHTML : '<option value="">--Selecciona Producto--</option>';
    const tr = document.createElement('tr');
    tr.className = 'linea_factura';
    tr.innerHTML = `
        <td>
            <input type="number" name="lineas[${indiceLinea}][cantidad]" placeholder="Cantidad" required>
        </td>
        <td>
            <select name="lineas[${indiceLinea}][producto_id]" required>
                <option value="">--Selecciona Producto--</option>
                ${opcionesHTML}
            </select>
        </td>
        <td>
            <input type="number" step="0.01" name="lineas[${indiceLinea}][precio_unitario]" placeholder="Precio" required>
        </td>
        <td>
            <span class="total_linea">0,00€</span>
            <button type="button" onclick="this.parentElement.parentElement.remove();">Eliminar</button>
        </td>
    `;
    contenedor.appendChild(tr);
    
    // Add change event listener to preload the product price when a product is selected.
    const selectElem = tr.querySelector('select');
    const priceInput = tr.querySelector('input[name^="lineas"][name*="[precio_unitario]"]');
    selectElem.addEventListener('change', function() {
        const price = this.options[this.selectedIndex].getAttribute('data-price');
        if(price) {
            priceInput.value = price;
        }
    });
    
    indiceLinea++;
}


```
## paginas
**clientes.php**
```php
<?php
// paginas/clientes.php

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Clientes</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="cabecera">
<a href="index.php?page=cliente_crear" class="btn-submit" title="Crear nuevo cliente" style="margin-bottom:20px; display:inline-block;">Crear Cliente</a>
<h2 title="Listado de clientes">Clientes</h2>
<p>Esta sección está dedicada a la administración de la información de sus clientes. Podrá crear nuevos registros, editar datos existentes o eliminar clientes cuando ya no sean necesarios.</p>

</div>
<form method="GET" action="index.php">
  <input type="hidden" name="page" value="clientes">
  <table title="Tabla de clientes">
    <thead>
      <!-- Search Filter Row -->
      <tr>
      	<th></th>
      	<th></th>
        <th>
          <input type="text" name="name" placeholder="Buscar nombre" value="<?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : ''; ?>">
        </th>
        <th>
          <input type="text" name="address" placeholder="Buscar dirección" value="<?php echo isset($_GET['address']) ? htmlspecialchars($_GET['address']) : ''; ?>">
        </th>
        <th>
          <input type="text" name="postal_code" placeholder="Buscar código postal" value="<?php echo isset($_GET['postal_code']) ? htmlspecialchars($_GET['postal_code']) : ''; ?>">
        </th>
        <th>
          <input type="text" name="city" placeholder="Buscar ciudad" value="<?php echo isset($_GET['city']) ? htmlspecialchars($_GET['city']) : ''; ?>">
        </th>
        <th>
          <input type="text" name="id_number" placeholder="Buscar NIF/CIF" value="<?php echo isset($_GET['id_number']) ? htmlspecialchars($_GET['id_number']) : ''; ?>">
        </th>
        <th>
          <button type="submit">Buscar</button>
        </th>
      </tr>
      <!-- Table Header with extra columns -->
      <tr>
        <th>No.</th>
        <th>ID</th>
        <th>Nombre</th>
        <th>Dirección</th>
        <th>Código Postal</th>
        <th>Ciudad</th>
        <th>Nº Identificación</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
    <?php
      require_once 'config.php';
      try {
          $db = new PDO($config['db_url']);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(Exception $ex) {
          die("Error al conectar con la base de datos");
      }
      $query = "SELECT * FROM clientes WHERE user_id = ?";
      $params = [$_SESSION['usuario']['id']];
      if (isset($_GET['name']) && $_GET['name'] !== "") {
          $query .= " AND name LIKE ?";
          $params[] = "%" . $_GET['name'] . "%";
      }
      if (isset($_GET['address']) && $_GET['address'] !== "") {
          $query .= " AND address LIKE ?";
          $params[] = "%" . $_GET['address'] . "%";
      }
      if (isset($_GET['postal_code']) && $_GET['postal_code'] !== "") {
          $query .= " AND postal_code LIKE ?";
          $params[] = "%" . $_GET['postal_code'] . "%";
      }
      if (isset($_GET['city']) && $_GET['city'] !== "") {
          $query .= " AND city LIKE ?";
          $params[] = "%" . $_GET['city'] . "%";
      }
      if (isset($_GET['id_number']) && $_GET['id_number'] !== "") {
          $query .= " AND id_number LIKE ?";
          $params[] = "%" . $_GET['id_number'] . "%";
      }
      $stmt = $db->prepare($query);
      $stmt->execute($params);
      $i = 1;
      $totalRows = 0;
      while ($cliente = $stmt->fetch(PDO::FETCH_ASSOC)) :
          $totalRows++;
    ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo htmlspecialchars($cliente['id']); ?></td>
        <td><?php echo htmlspecialchars($cliente['name']); ?></td>
        <td><?php echo htmlspecialchars($cliente['address']); ?></td>
        <td><?php echo htmlspecialchars($cliente['postal_code']); ?></td>
        <td><?php echo htmlspecialchars($cliente['city']); ?></td>
        <td><?php echo htmlspecialchars($cliente['id_number']); ?></td>
        <td>
          <a href="index.php?page=cliente_ver&id=<?php echo $cliente['id']; ?>" title="Ver cliente">Ver</a> |
          <a href="index.php?page=cliente_editar&id=<?php echo $cliente['id']; ?>" title="Editar cliente">Editar</a> |
          <a href="index.php?page=clientes&accion=eliminar&id=<?php echo $cliente['id']; ?>" onclick="return confirm('¿Está seguro?')" title="Eliminar cliente">Eliminar</a>
        </td>
      </tr>
    <?php $i++; endwhile; ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="7">Total de filas: <?php echo $totalRows; ?></td>
        <td></td>
      </tr>
    </tfoot>
  </table>
</form>
<!-- Export link: passes along current GET parameters -->
<a href="export_ods.php?table=clientes&<?php echo http_build_query($_GET); ?>">Exportar a ODS</a>
<?php
if (isset($_GET['accion']) && $_GET['accion'] == 'eliminar' && isset($_GET['id'])) {
    $stmt = $db->prepare("DELETE FROM clientes WHERE id=? AND user_id=?");
    $stmt->execute([$_GET['id'], $_SESSION['usuario']['id']]);
    echo "<p class='success' title='Cliente eliminado'>Cliente eliminado.</p>";
}
?>
</body>
</html>


```
**crearcliente.php**
```php
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cliente_nombre'])) {
    $stmt = $db->prepare("INSERT INTO clientes (name, address, postal_code, city, id_number, user_id) VALUES (?,?,?,?,?,?)");
    $stmt->execute([
        $_POST['cliente_nombre'],
        $_POST['address'],
        $_POST['postal_code'],
        $_POST['city'],
        $_POST['id_number'],
        $_SESSION['usuario']['id']
    ]);
    echo "<script>window.location.href='index.php?page=clientes';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Cliente</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2 title="Crear nuevo cliente">Crear Cliente</h2>
    <form method="post" action="index.php?page=cliente_crear" class="form-full">
        <div class="form-row">
            <div class="form-label">
                <label title="Nombre completo del cliente">Nombre:</label>
            </div>
            <div class="form-field">
                <input type="text" name="cliente_nombre" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">
                <label title="Dirección del cliente">Dirección:</label>
            </div>
            <div class="form-field">
                <input type="text" name="address" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">
                <label title="Código postal del cliente">Código Postal:</label>
            </div>
            <div class="form-field">
                <input type="text" name="postal_code" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">
                <label title="Ciudad del cliente">Ciudad:</label>
            </div>
            <div class="form-field">
                <input type="text" name="city" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">
                <label title="Número de identificación fiscal">Nº Identificación:</label>
            </div>
            <div class="form-field">
                <input type="text" name="id_number" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-field" style="margin-left: auto;">
                <button type="submit" class="btn-submit" title="Crear cliente">Crear Cliente</button>
            </div>
        </div>
    </form>
</body>
</html>


```
**crearepigrafe.php**
```php
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
    $stmt = $db->prepare("INSERT INTO epigrafes (name, iva_percentage, user_id) VALUES (?,?,?)");
    $stmt->execute([
        $_POST['name'],
        $_POST['iva_percentage'],
        $_SESSION['usuario']['id']
    ]);
    echo "<script>window.location.href='index.php?page=epigrafes';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Epígrafe</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2 title="Crear nuevo epígrafe">Crear Epígrafe</h2>
    <form method="post" action="index.php?page=epigrafes_crear" class="form-full">
        <div class="form-row">
            <div class="form-label">
                <label title="Nombre del epígrafe">Nombre:</label>
            </div>
            <div class="form-field">
                <input type="text" name="name" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">
                <label title="IVA asociado (%)">IVA (%):</label>
            </div>
            <div class="form-field">
                <select name="iva_percentage" required>
                    <option value="">--Selecciona IVA--</option>
                    <option value="21">General (21%)</option>
                    <option value="10">Reducido (10%)</option>
                    <option value="4">Superreducido (4%)</option>
                    <option value="0">Exento (0%)</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-field" style="margin-left: auto;">
                <button type="submit" class="btn-submit" title="Crear epígrafe">Crear Epígrafe</button>
            </div>
        </div>
    </form>
</body>
</html>


```
**crearfactura.php**
```php
<?php
// crearfactura.php

// Redirect to login if no user is in session
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

$config = require 'config.php';
try {
    $db = new PDO($config['db_url']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $ex) {
    die("Error al conectar con la base de datos: " . $ex->getMessage());
}

include_once "inc/inicializardb.php";

// Retrieve user-specific invoice settings (mis_datos)
$stmt = $db->prepare("SELECT * FROM mis_datos WHERE user_id = ?");
$stmt->execute([$_SESSION['usuario']['id']]);
$misDatos = $stmt->fetch(PDO::FETCH_ASSOC);

// If mis_datos does not exist, create a default record for the user
if (!$misDatos) {
    $default = "FACTURA";
    $defaultSub = "SERVICIO PROFESIONAL";
    $defaultName = "Su Nombre";
    $defaultAddr = "Su Dirección";
    $defaultPostal = "00000";
    $defaultCity = "Ciudad";
    $defaultId = "ID123456";
    $defaultBank = "ESXX XXXX XXXX XXXX XXXX XXXX";
    $defaultFooter = "Gracias por su compra";
    $db->exec("INSERT INTO mis_datos (invoice_title, invoice_subtitle, my_name, address, postal_code, city, id_number, bank_account, invoice_footer, user_id)
              VALUES ('$default', '$defaultSub', '$defaultName', '$defaultAddr', '$defaultPostal', '$defaultCity', '$defaultId', '$defaultBank', '$defaultFooter', " . $_SESSION['usuario']['id'] . ")");
    // Re-fetch after insertion
    $stmt = $db->prepare("SELECT * FROM mis_datos WHERE user_id = ?");
    $stmt->execute([$_SESSION['usuario']['id']]);
    $misDatos = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Retrieve user-specific clients, products, epigrafes and retenciones
$stmt = $db->prepare("SELECT * FROM clientes WHERE user_id = ?");
$stmt->execute([$_SESSION['usuario']['id']]);
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $db->prepare("SELECT * FROM productos WHERE user_id = ?");
$stmt->execute([$_SESSION['usuario']['id']]);
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $db->prepare("SELECT * FROM epigrafes WHERE user_id = ?");
$stmt->execute([$_SESSION['usuario']['id']]);
$epigrafes = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['invoice_number'])) {
    try {
        // Get the "paid" flag from checkbox (default true)
        $paid = isset($_POST['paid']) ? 1 : 0;
        // Insert new invoice with user_id, mis_datos_id, retencion_id and paid flag
        $stmt = $db->prepare("INSERT INTO facturas (invoice_number, fecha, cliente_id, mis_datos_id, total, epigrafe_id, retencion_id, paid, user_id) VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->execute([
            $_POST['invoice_number'],
            $_POST['fecha'],
            $_POST['cliente_id'],
            $misDatos['id'],
            0, // Temporary total value
            $_POST['epigrafe_id'],
            $_POST['retencion_id'],
            $paid,
            $_SESSION['usuario']['id']
        ]);
        $factura_id = $db->lastInsertId();
        $subtotal = 0;
        if (isset($_POST['lineas']) && is_array($_POST['lineas'])) {
            foreach ($_POST['lineas'] as $linea) {
                $subtotal_linea = $linea['cantidad'] * $linea['precio_unitario'];
                $subtotal += $subtotal_linea;
                $stmt_linea = $db->prepare("INSERT INTO lineas_factura (factura_id, producto_id, cantidad, precio_unitario, total) VALUES (?,?,?,?,?)");
                $stmt_linea->execute([
                    $factura_id,
                    $linea['producto_id'],
                    $linea['cantidad'],
                    $linea['precio_unitario'],
                    $subtotal_linea
                ]);
            }
        }
        // Update the invoice total
        $stmt = $db->prepare("UPDATE facturas SET total=? WHERE id=?");
        $stmt->execute([$subtotal, $factura_id]);
        
        // *** NEW: Insert invoice observation if provided ***
        if(isset($_POST['observaciones']) && trim($_POST['observaciones']) !== ""){
            $stmtObs = $db->prepare("INSERT INTO observaciones_factura (factura_id, observaciones, user_id) VALUES (?,?,?)");
            $stmtObs->execute([$factura_id, $_POST['observaciones'], $_SESSION['usuario']['id']]);
        }
        
        header("Location: index.php?page=factura_ver&id=" . $factura_id);
        exit;
    } catch (Exception $e) {
        echo "Error al crear la factura: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Factura</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
    <style>
        .container {
            max-width: 800px;
            margin: 20px auto;
            border: 1px solid #ddd;
            padding: 20px;
            background: #fff;
        }
        .invoice-number input, .invoice-details select, .invoice-details input {
            border: 1px solid #bbb;
            padding: 5px;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Invoice Header -->
        <div class="header" style="background: black; color:white; padding:20px; text-align:center;">
            <h1><?php echo htmlspecialchars($misDatos['invoice_title']); ?></h1>
            <h2><?php echo htmlspecialchars($misDatos['invoice_subtitle']); ?></h2>
        </div>
        
        <!-- Invoice Number and Date -->
        <form method="post" action="index.php?page=factura_crear" class="form-full">
            <div class="invoice-number" style="display:flex; justify-content:space-between; margin:20px 0;">
                <div>
                    <strong>FACTURA NÚMERO:</strong> 
                    <input type="text" name="invoice_number" placeholder="Nº Factura" required>
                </div>
                <div>
                    <strong>FECHA:</strong>
                    <input type="date" name="fecha" required>
                </div>
            </div>
            
            <!-- Invoice Details: Emisor and Cliente -->
            <div class="invoice-details" style="display:flex; justify-content:space-between; margin-bottom:20px;">
                <div class="sender-details" style="width:48%;">
                    <h3>Emisor</h3>
                    <p>
                        <?php echo htmlspecialchars($misDatos['my_name']); ?><br>
                        <?php echo htmlspecialchars($misDatos['address']); ?><br>
                        <?php echo htmlspecialchars($misDatos['postal_code']); ?>, <?php echo htmlspecialchars($misDatos['city']); ?><br>
                        <?php echo htmlspecialchars($misDatos['id_number']); ?>
                    </p>
                </div>
                <div class="recipient-details" style="width:48%;">
                    <h3>Cliente</h3>
                    <select name="cliente_id" required>
                        <option value="">--Selecciona Cliente--</option>
                        <?php foreach ($clientes as $cliente): ?>
                            <option value="<?php echo $cliente['id']; ?>">
                                <?php echo htmlspecialchars($cliente['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <!-- Epígrafe Selection -->
            <div class="form-row" style="margin-bottom:20px;">
                <div class="form-label">
                    <label>Epígrafe:</label>
                </div>
                <div class="form-field">
                    <select name="epigrafe_id" required>
                        <option value="">--Selecciona Epígrafe--</option>
                        <?php foreach ($epigrafes as $epi): ?>
                            <option value="<?php echo $epi['id']; ?>">
                                <?php echo htmlspecialchars($epi['name']) . " (" . $epi['iva_percentage'] . "% IVA)"; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <!-- Retención Selection -->
            <div class="form-row" style="margin-bottom:20px;">
                <div class="form-label">
                    <label>Retención (IRPF):</label>
                </div>
                <div class="form-field">
                    <select name="retencion_id" required>
                        <option value="">--Selecciona Retención--</option>
                        <?php 
                        $stmt = $db->prepare("SELECT * FROM retenciones WHERE user_id = ?");
                        $stmt->execute([$_SESSION['usuario']['id']]);
                        $retenciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($retenciones as $ret) {
                            echo "<option value='{$ret['id']}'>" . htmlspecialchars($ret['name']) . " (" . htmlspecialchars($ret['percentage']) . "% IRPF)</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            
            <!-- Pagado Checkbox -->
            <div class="form-row">
                <div class="form-label">
                    <label title="Marque si la factura está pagada">Pagado:</label>
                </div>
                <div class="form-field">
                    <label class="switch">
                        <input type="checkbox" name="paid" checked>
                        <span class="slider"></span>
                    </label>
                </div>
            </div>
            
            <!-- Invoice Lines Table -->
            <table class="invoice-table" style="width:100%; border-collapse:collapse; margin-bottom:20px;">
                <thead>
                    <tr>
                        <th>UNIDADES</th>
                        <th>DESCRIPCIÓN (Producto)</th>
                        <th>PRECIO</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody id="lineas_factura">
                    <tr class="linea_factura">
                        <td>
                            <input type="number" name="lineas[0][cantidad]" placeholder="Cantidad" required>
                        </td>
                        <td>
                            <select name="lineas[0][producto_id]" required>
                                <option value="">--Selecciona Producto--</option>
                                <?php foreach ($productos as $producto): ?>
                                    <option value="<?php echo $producto['id']; ?>" data-price="<?php echo $producto['price']; ?>">
                                        <?php echo htmlspecialchars($producto['nombre']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" step="0.01" name="lineas[0][precio_unitario]" placeholder="Precio" required>
                        </td>
                        <td>
                            <span class="total_linea">0,00€</span>
                            <button type="button" onclick="this.parentElement.parentElement.remove();">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="button" onclick="agregarLinea()">Agregar Línea</button>
            
            <!-- Totals Section -->
            <div class="total-section" style="display:flex; flex-direction:column; align-items:flex-end; margin:20px 0;">
                <div class="total-row">
                    <div>TOTAL LÍNEAS:</div>
                    <div id="total_lineas">0,00€</div>
                </div>
                <div class="total-row">
                    <div>Total IVA (<?php echo htmlspecialchars($epigrafes[0]['iva_percentage'] ?? 21); ?>%):</div>
                    <div id="total_iva">0,00€</div>
                </div>
                <div class="total-row">
                    <div><?php echo htmlspecialchars("Retención"); ?>:</div>
                    <div id="total_retencion">0,00€</div>
                </div>
                <div class="total-row final" style="font-weight:bold; border-top:1px solid #ddd; padding-top:10px;">
                    <div>TOTAL:</div>
                    <div id="total_final">0,00€</div>
                </div>
            </div>
            
            <!-- Observaciones Field -->
            <div class="form-row">
                <div class="form-label">
                    <label>Observaciones:</label>
                </div>
                <div class="form-field">
                    <textarea name="observaciones" rows="4" placeholder="Ingrese observaciones especiales para esta factura"></textarea>
                </div>
            </div>
            
            <!-- Bank Details and Footer -->
            <div class="bank-details" style="margin-top:20px; border-top:1px solid #ddd; padding-top:10px;">
                <strong>CUENTA:</strong> <?php echo htmlspecialchars($misDatos['bank_account']); ?>
            </div>
            <div class="footer" style="font-size:10px; color:#666; text-align:center; border-top:1px solid #ddd; padding-top:10px; margin-top:20px;">
                <?php echo htmlspecialchars($misDatos['invoice_footer']); ?>
            </div>
            
            <!-- Submit Button -->
            <div class="form-row" style="text-align:right; margin-top:20px;">
                <button type="submit" class="btn-submit">Guardar Factura</button>
            </div>
        </form>
    </div>
        <link rel="stylesheet" href="https://jocarsa.github.io/jocarsa-seashell/jocarsa%20%7C%20seashell.css">
    <script src="https://jocarsa.github.io/jocarsa-seashell/jocarsa%20%7C%20seashell.js"></script>
</body>
</html>


```
**creargasto.php**
```php
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['gasto_deducible'])) {
    $stmt = $db->prepare("INSERT INTO gastos (gasto_deducible, fecha_emision, fecha_operaciones, numero_factura, fecha_factura, proveedor_id, total_factura, base_imponible, tipo_retencion, importe_retencion, tipo_iva, cuota_iva, iva_deducido, user_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->execute([
        $_POST['gasto_deducible'],
        $_POST['fecha_emision'],
        $_POST['fecha_operaciones'],
        $_POST['numero_factura'],
        $_POST['fecha_factura'],
        $_POST['proveedor_id'],
        $_POST['total_factura'],
        $_POST['base_imponible'],
        $_POST['tipo_retencion'],
        $_POST['importe_retencion'],
        $_POST['tipo_iva'],
        $_POST['cuota_iva'],
        $_POST['iva_deducido'],
        $_SESSION['usuario']['id']
    ]);
    echo "<script>window.location.href='index.php?page=gastos';</script>";
    exit;
}
$proveedoresStmt = $db->prepare("SELECT * FROM proveedores WHERE user_id = ?");
$proveedoresStmt->execute([$_SESSION['usuario']['id']]);
$proveedores = $proveedoresStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Gasto</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2 title="Crear nuevo gasto">Crear Gasto</h2>
    <form method="post" action="index.php?page=creargasto" class="form-full">
        <div class="form-row">
            <div class="form-label"><label>Gasto Deducible (€):</label></div>
            <div class="form-field"><input type="number" step="0.01" name="gasto_deducible" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Fecha Emisión:</label></div>
            <div class="form-field"><input type="date" name="fecha_emision" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Fecha Operaciones:</label></div>
            <div class="form-field"><input type="date" name="fecha_operaciones" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Nº Factura:</label></div>
            <div class="form-field"><input type="text" name="numero_factura" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Fecha Factura:</label></div>
            <div class="form-field"><input type="date" name="fecha_factura" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Proveedor:</label></div>
            <div class="form-field">
                <select name="proveedor_id" required>
                    <option value="">--Selecciona Proveedor--</option>
                    <?php foreach ($proveedores as $prov): ?>
                        <option value="<?php echo $prov['id']; ?>"><?php echo htmlspecialchars($prov['razon_social']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Total Factura (€):</label></div>
            <div class="form-field"><input type="number" step="0.01" name="total_factura" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Base Imponible (€):</label></div>
            <div class="form-field"><input type="number" step="0.01" name="base_imponible" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Tipo de Retención:</label></div>
            <div class="form-field"><input type="text" name="tipo_retencion" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Importe Retención (€):</label></div>
            <div class="form-field"><input type="number" step="0.01" name="importe_retencion" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Tipo de IVA:</label></div>
            <div class="form-field"><input type="text" name="tipo_iva" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Cuota IVA (€):</label></div>
            <div class="form-field"><input type="number" step="0.01" name="cuota_iva" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>IVA Deducido (€):</label></div>
            <div class="form-field"><input type="number" step="0.01" name="iva_deducido" required></div>
        </div>
        <div class="form-row">
            <div class="form-field" style="margin-left: auto;">
                <button type="submit" class="btn-submit" title="Crear gasto">Crear Gasto</button>
            </div>
        </div>
    </form>
</body>
</html>


```
**crearpresupuesto.php**
```php
<?php
// crearpresupuesto.php
session_start(); // Ensure the session is started

// Redirect to login if no user is in session
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

$config = require 'config.php';
try {
    $db = new PDO($config['db_url']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $ex) {
    die("Error al conectar con la base de datos: " . $ex->getMessage());
}

include_once "inc/inicializardb.php";

// Retrieve user-specific invoice settings (mis_datos)
$stmt = $db->prepare("SELECT * FROM mis_datos WHERE user_id = ?");
$stmt->execute([$_SESSION['usuario']['id']]);
$misDatos = $stmt->fetch(PDO::FETCH_ASSOC);

// If mis_datos does not exist, create a default record for the user
if (!$misDatos) {
    $default = "PRESUPUESTO";
    $defaultSub = "SERVICIO PROFESIONAL";
    $defaultName = "Su Nombre";
    $defaultAddr = "Su Dirección";
    $defaultPostal = "00000";
    $defaultCity = "Ciudad";
    $defaultId = "ID123456";
    $defaultBank = "ESXX XXXX XXXX XXXX XXXX XXXX";
    $defaultFooter = "Gracias por su interés";
    $db->exec("INSERT INTO mis_datos (invoice_title, invoice_subtitle, my_name, address, postal_code, city, id_number, bank_account, invoice_footer, user_id)
              VALUES ('$default', '$defaultSub', '$defaultName', '$defaultAddr', '$defaultPostal', '$defaultCity', '$defaultId', '$defaultBank', '$defaultFooter', " . $_SESSION['usuario']['id'] . ")");
    // Re-fetch after insertion
    $stmt = $db->prepare("SELECT * FROM mis_datos WHERE user_id = ?");
    $stmt->execute([$_SESSION['usuario']['id']]);
    $misDatos = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Retrieve user-specific clients, products, epigrafes and retenciones
$stmt = $db->prepare("SELECT * FROM clientes WHERE user_id = ?");
$stmt->execute([$_SESSION['usuario']['id']]);
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $db->prepare("SELECT * FROM productos WHERE user_id = ?");
$stmt->execute([$_SESSION['usuario']['id']]);
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $db->prepare("SELECT * FROM epigrafes WHERE user_id = ?");
$stmt->execute([$_SESSION['usuario']['id']]);
$epigrafes = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['presupuesto_number'])) {
    try {
        // Insert new presupuesto with user_id, mis_datos_id and retencion_id from current user
        $stmt = $db->prepare("INSERT INTO presupuestos (presupuesto_number, fecha, cliente_id, mis_datos_id, total, epigrafe_id, retencion_id, user_id) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->execute([
            $_POST['presupuesto_number'],
            $_POST['fecha'],
            $_POST['cliente_id'],
            $misDatos['id'],
            0, // Temporary total value
            $_POST['epigrafe_id'],
            $_POST['retencion_id'],
            $_SESSION['usuario']['id']
        ]);
        $presupuesto_id = $db->lastInsertId();
        $subtotal = 0;
        if (isset($_POST['lineas']) && is_array($_POST['lineas'])) {
            foreach ($_POST['lineas'] as $linea) {
                $subtotal_linea = $linea['cantidad'] * $linea['precio_unitario'];
                $subtotal += $subtotal_linea;
                $stmt_linea = $db->prepare("INSERT INTO lineas_presupuesto (presupuesto_id, producto_id, cantidad, precio_unitario, total) VALUES (?,?,?,?,?)");
                $stmt_linea->execute([
                    $presupuesto_id,
                    $linea['producto_id'],
                    $linea['cantidad'],
                    $linea['precio_unitario'],
                    $subtotal_linea
                ]);
            }
        }
        // Update the presupuesto total
        $stmt = $db->prepare("UPDATE presupuestos SET total=? WHERE id=?");
        $stmt->execute([$subtotal, $presupuesto_id]);
        
        // *** NEW: Insert presupuesto observation if provided ***
        if(isset($_POST['observaciones']) && trim($_POST['observaciones']) !== ""){
            $stmtObs = $db->prepare("INSERT INTO observaciones_factura (factura_id, observaciones, user_id) VALUES (?,?,?)");
            // Note: Reusing the same table structure for observations.
            $stmtObs->execute([$presupuesto_id, $_POST['observaciones'], $_SESSION['usuario']['id']]);
        }
        
        header("Location: index.php?page=presupuesto_ver&id=" . $presupuesto_id);
        exit;
    } catch (Exception $e) {
        echo "Error al crear el presupuesto: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Presupuesto</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
    <style>
        .container {
            max-width: 800px;
            margin: 20px auto;
            border: 1px solid #ddd;
            padding: 20px;
            background: #fff;
        }
        .invoice-number input, .invoice-details select, .invoice-details input {
            border: 1px solid #bbb;
            padding: 5px;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Presupuesto Header -->
        <div class="header" style="background: black; color:white; padding:20px; text-align:center;">
            <h1><?php echo htmlspecialchars($misDatos['invoice_title']); ?> (Presupuesto)</h1>
            <h2><?php echo htmlspecialchars($misDatos['invoice_subtitle']); ?></h2>
        </div>
        
        <!-- Presupuesto Number and Date -->
        <form method="post" action="index.php?page=presupuesto_crear" class="form-full">
            <div class="invoice-number" style="display:flex; justify-content:space-between; margin:20px 0;">
                <div>
                    <strong>PRESUPUESTO NÚMERO:</strong> 
                    <input type="text" name="presupuesto_number" placeholder="Nº Presupuesto" required>
                </div>
                <div>
                    <strong>FECHA:</strong>
                    <input type="date" name="fecha" required>
                </div>
            </div>
            
            <!-- Presupuesto Details: Emisor and Cliente -->
            <div class="invoice-details" style="display:flex; justify-content:space-between; margin-bottom:20px;">
                <div class="sender-details" style="width:48%;">
                    <h3>Emisor</h3>
                    <p>
                        <?php echo htmlspecialchars($misDatos['my_name']); ?><br>
                        <?php echo htmlspecialchars($misDatos['address']); ?><br>
                        <?php echo htmlspecialchars($misDatos['postal_code']); ?>, <?php echo htmlspecialchars($misDatos['city']); ?><br>
                        <?php echo htmlspecialchars($misDatos['id_number']); ?>
                    </p>
                </div>
                <div class="recipient-details" style="width:48%;">
                    <h3>Cliente</h3>
                    <select name="cliente_id" required>
                        <option value="">--Selecciona Cliente--</option>
                        <?php foreach ($clientes as $cliente): ?>
                            <option value="<?php echo $cliente['id']; ?>">
                                <?php echo htmlspecialchars($cliente['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <!-- Epígrafe Selection -->
            <div class="form-row" style="margin-bottom:20px;">
                <div class="form-label">
                    <label>Epígrafe:</label>
                </div>
                <div class="form-field">
                    <select name="epigrafe_id" required>
                        <option value="">--Selecciona Epígrafe--</option>
                        <?php foreach ($epigrafes as $epi): ?>
                            <option value="<?php echo $epi['id']; ?>">
                                <?php echo htmlspecialchars($epi['name']) . " (" . $epi['iva_percentage'] . "% IVA)"; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <!-- Retención Selection -->
            <div class="form-row" style="margin-bottom:20px;">
                <div class="form-label">
                    <label>Retención (IRPF):</label>
                </div>
                <div class="form-field">
                    <select name="retencion_id" required>
                        <option value="">--Selecciona Retención--</option>
                        <?php 
                        $stmt = $db->prepare("SELECT * FROM retenciones WHERE user_id = ?");
                        $stmt->execute([$_SESSION['usuario']['id']]);
                        $retenciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($retenciones as $ret) {
                            echo "<option value='{$ret['id']}'>" . htmlspecialchars($ret['name']) . " (" . htmlspecialchars($ret['percentage']) . "% IRPF)</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            
            <!-- Presupuesto Lines Table -->
            <table class="invoice-table" style="width:100%; border-collapse:collapse; margin-bottom:20px;">
                <thead>
                    <tr>
                        <th>UNIDADES</th>
                        <th>DESCRIPCIÓN (Producto)</th>
                        <th>PRECIO</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody id="lineas_factura">
                    <tr class="linea_factura">
                        <td>
                            <input type="number" name="lineas[0][cantidad]" placeholder="Cantidad" required>
                        </td>
                        <td>
                            <select name="lineas[0][producto_id]" required>
                                <option value="">--Selecciona Producto--</option>
                                <?php foreach ($productos as $producto): ?>
                                    <option value="<?php echo $producto['id']; ?>" data-price="<?php echo $producto['price']; ?>">
                                        <?php echo htmlspecialchars($producto['nombre']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" step="0.01" name="lineas[0][precio_unitario]" placeholder="Precio" required>
                        </td>
                        <td>
                            <span class="total_linea">0,00€</span>
                            <button type="button" onclick="this.parentElement.parentElement.remove();">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="button" onclick="agregarLinea()">Agregar Línea</button>
            
            <!-- Totals Section -->
            <div class="total-section" style="display:flex; flex-direction:column; align-items:flex-end; margin:20px 0;">
                <div class="total-row">
                    <div>TOTAL LÍNEAS:</div>
                    <div id="total_lineas">0,00€</div>
                </div>
                <div class="total-row">
                    <div>Total IVA (<?php echo htmlspecialchars($epigrafes[0]['iva_percentage'] ?? 21); ?>%):</div>
                    <div id="total_iva">0,00€</div>
                </div>
                <div class="total-row">
                    <div><?php echo htmlspecialchars("Retención"); ?>:</div>
                    <div id="total_retencion">0,00€</div>
                </div>
                <div class="total-row final" style="font-weight:bold; border-top:1px solid #ddd; padding-top:10px;">
                    <div>TOTAL:</div>
                    <div id="total_final">0,00€</div>
                </div>
            </div>
            
            <!-- Observaciones Field -->
            <div class="form-row">
                <div class="form-label">
                    <label>Observaciones:</label>
                </div>
                <div class="form-field">
                    <textarea name="observaciones" rows="4" placeholder="Ingrese observaciones especiales para este presupuesto"></textarea>
                </div>
            </div>
            
            <!-- Bank Details and Footer -->
            <div class="bank-details" style="margin-top:20px; border-top:1px solid #ddd; padding-top:10px;">
                <strong>CUENTA:</strong> <?php echo htmlspecialchars($misDatos['bank_account']); ?>
            </div>
            <div class="footer" style="font-size:10px; color:#666; text-align:center; border-top:1px solid #ddd; padding-top:10px; margin-top:20px;">
                <?php echo htmlspecialchars($misDatos['invoice_footer']); ?>
            </div>
            
            <!-- Submit Button -->
            <div class="form-row" style="text-align:right; margin-top:20px;">
                <button type="submit" class="btn-submit">Guardar Presupuesto</button>
            </div>
        </form>
    </div>
</body>
</html>


```
**crearproducto.php**
```php
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre'])) {
    $stmt = $db->prepare("INSERT INTO productos (nombre, descripcion, price, user_id) VALUES (?,?,?,?)");
    $stmt->execute([
        $_POST['nombre'],
        $_POST['descripcion'],
        $_POST['price'],
        $_SESSION['usuario']['id']
    ]);
    echo "<script>window.location.href='index.php?page=productos';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Producto</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2 title="Crear nuevo producto">Crear Producto</h2>
    <form method="post" action="index.php?page=producto_crear" class="form-full">
        <div class="form-row">
            <div class="form-label">
                <label title="Nombre del producto">Nombre del Producto:</label>
            </div>
            <div class="form-field">
                <input type="text" name="nombre" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">
                <label title="Descripción del producto">Descripción:</label>
            </div>
            <div class="form-field">
                <textarea name="descripcion" rows="4" required></textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">
                <label title="Precio del producto">Precio:</label>
            </div>
            <div class="form-field">
                <input type="number" step="0.01" name="price" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-field" style="margin-left: auto;">
                <button type="submit" class="btn-submit" title="Crear producto">Crear Producto</button>
            </div>
        </div>
    </form>
</body>
</html>


```
**crearproveedor.php**
```php
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['razon_social'])) {
    $stmt = $db->prepare("INSERT INTO proveedores (razon_social, direccion, codigo_postal, poblacion, identificacion_fiscal, contacto_nombre, contacto_email, contacto_telefono, user_id) VALUES (?,?,?,?,?,?,?,?,?)");
    $stmt->execute([
        $_POST['razon_social'],
        $_POST['direccion'],
        $_POST['codigo_postal'],
        $_POST['poblacion'],
        $_POST['identificacion_fiscal'],
        $_POST['contacto_nombre'],
        $_POST['contacto_email'],
        $_POST['contacto_telefono'],
        $_SESSION['usuario']['id']
    ]);
    echo "<script>window.location.href='index.php?page=proveedores';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Proveedor</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2 title="Crear nuevo proveedor">Crear Proveedor</h2>
    <form method="post" action="index.php?page=crearproveedor" class="form-full">
        <div class="form-row">
            <div class="form-label"><label>Razón Social:</label></div>
            <div class="form-field"><input type="text" name="razon_social" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Dirección:</label></div>
            <div class="form-field"><input type="text" name="direccion" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Código Postal:</label></div>
            <div class="form-field"><input type="text" name="codigo_postal" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Población:</label></div>
            <div class="form-field"><input type="text" name="poblacion" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Identificación Fiscal:</label></div>
            <div class="form-field"><input type="text" name="identificacion_fiscal" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Nombre de Contacto:</label></div>
            <div class="form-field"><input type="text" name="contacto_nombre" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Email de Contacto:</label></div>
            <div class="form-field"><input type="email" name="contacto_email" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Teléfono de Contacto:</label></div>
            <div class="form-field"><input type="text" name="contacto_telefono" required></div>
        </div>
        <div class="form-row">
            <div class="form-field" style="margin-left: auto;">
                <button type="submit" class="btn-submit" title="Crear proveedor">Crear Proveedor</button>
            </div>
        </div>
    </form>
</body>
</html>


```
**crearusuario.php**
```php
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['usuario'])) {
    $stmt = $db->prepare("INSERT INTO usuarios (usuario, email, nombre, password) VALUES (?,?,?,?)");
    $stmt->execute([
        $_POST['usuario'],
        $_POST['email'],
        $_POST['nombre'],
        $_POST['password']
    ]);
    echo "<script>window.location.href='index.php?page=usuarios';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2 title="Crear nuevo usuario">Crear Usuario</h2>
    <form method="post" action="index.php?page=usuario_crear" class="form-full">
        <div class="form-row">
            <div class="form-label">
                <label title="Nombre de usuario">Usuario:</label>
            </div>
            <div class="form-field">
                <input type="text" name="usuario" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">
                <label title="Correo electrónico">Email:</label>
            </div>
            <div class="form-field">
                <input type="email" name="email" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">
                <label title="Nombre completo">Nombre:</label>
            </div>
            <div class="form-field">
                <input type="text" name="nombre" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">
                <label title="Contraseña">Contraseña:</label>
            </div>
            <div class="form-field">
                <input type="password" name="password" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-field" style="margin-left: auto;">
                <button type="submit" class="btn-submit" title="Crear usuario">Crear Usuario</button>
            </div>
        </div>
    </form>
</body>
</html>


```
**descargar_plantilla_importar.php**
```php
<?php
ob_start();
ob_clean();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=\"plantilla_importar.csv\"");

$output = fopen("php://output", "w");
// Write the header row
fputcsv($output, [
    'invoice_number',
    'fecha',
    'customer_name',
    'customer_address',
    'customer_postal',
    'customer_city',
    'customer_id_number',
    'product_name',
    'product_description',
    'quantity',
    'unit_price',
    'observations'
]);
// Write sample data rows
fputcsv($output, ['F001', '2024-03-01', 'Cliente Ejemplo', 'Calle Falsa 123', '28080', 'Madrid', 'X1234567Y', 'Producto A', 'Descripción del producto A', '2', '50.00', 'Observaciones opcionales']);
fputcsv($output, ['F001', '2024-03-01', 'Cliente Ejemplo', 'Calle Falsa 123', '28080', 'Madrid', 'X1234567Y', 'Producto B', 'Descripción del producto B', '1', '30.00', '']);
fputcsv($output, ['F002', '2024-03-02', 'Otro Cliente', 'Avenida Siempre Viva 742', '08080', 'Barcelona', 'Z9876543X', 'Producto C', 'Descripción del producto C', '3', '20.00', '']);
fclose($output);
ob_end_flush();
exit;
?>


```
**editarcliente.php**
```php
<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "ID de cliente no proporcionado.";
    exit;
}

$cliente_id = intval($_GET['id']);

$config = require 'config.php';
try {
    $db = new PDO($config['db_url']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $ex) {
    die("Error al conectar con la base de datos: " . $ex->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cliente_nombre'])) {
    // Update the client data, ensuring only the current user's records are updated
    $stmt = $db->prepare("UPDATE clientes SET name=?, address=?, postal_code=?, city=?, id_number=? WHERE id=? AND user_id=?");
    $stmt->execute([
        $_POST['cliente_nombre'],
        $_POST['address'],
        $_POST['postal_code'],
        $_POST['city'],
        $_POST['id_number'],
        $cliente_id,
        $_SESSION['usuario']['id']
    ]);
    echo "<script>window.location.href='index.php?page=clientes';</script>";
    exit;
}

// Retrieve the client record filtered by the logged-in user
$stmt = $db->prepare("SELECT * FROM clientes WHERE id=? AND user_id=?");
$stmt->execute([$cliente_id, $_SESSION['usuario']['id']]);
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cliente) {
    echo "Cliente no encontrado o no tiene permisos para editarlo.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2 title="Editar datos del cliente">Editar Cliente</h2>
    <form method="post" action="index.php?page=cliente_editar&id=<?php echo $cliente_id; ?>" class="form-full">
        <div class="form-row">
            <div class="form-label">
                <label title="Nombre completo del cliente">Nombre:</label>
            </div>
            <div class="form-field">
                <input type="text" name="cliente_nombre" value="<?php echo htmlspecialchars($cliente['name']); ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">
                <label title="Dirección del cliente">Dirección:</label>
            </div>
            <div class="form-field">
                <input type="text" name="address" value="<?php echo htmlspecialchars($cliente['address']); ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">
                <label title="Código postal del cliente">Código Postal:</label>
            </div>
            <div class="form-field">
                <input type="text" name="postal_code" value="<?php echo htmlspecialchars($cliente['postal_code']); ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">
                <label title="Ciudad del cliente">Ciudad:</label>
            </div>
            <div class="form-field">
                <input type="text" name="city" value="<?php echo htmlspecialchars($cliente['city']); ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">
                <label title="Número de identificación fiscal">Nº Identificación:</label>
            </div>
            <div class="form-field">
                <input type="text" name="id_number" value="<?php echo htmlspecialchars($cliente['id_number']); ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-field" style="margin-left: auto;">
                <button type="submit" class="btn-submit" title="Actualizar cliente">Actualizar Cliente</button>
            </div>
        </div>
    </form>
</body>
</html>


```
**editarfactura.php**
```php
<?php
if (!isset($_GET['id'])) {
    echo "ID de factura no proporcionado.";
    exit;
}
$factura_id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['invoice_number'])) {
    // Get paid flag from checkbox
    $paid = isset($_POST['paid']) ? 1 : 0;
    // Update invoice header (filtered by user_id) including the paid column
    $stmt = $db->prepare("UPDATE facturas SET invoice_number=?, fecha=?, cliente_id=?, epigrafe_id=?, paid=? WHERE id=? AND user_id=?");
    $stmt->execute([
        $_POST['invoice_number'],
        $_POST['fecha'],
        $_POST['cliente_id'],
        $_POST['epigrafe_id'],
        $paid,
        $factura_id,
        $_SESSION['usuario']['id']
    ]);
    // Delete existing invoice lines
    $db->prepare("DELETE FROM lineas_factura WHERE factura_id=?")->execute([$factura_id]);
    $subtotal = 0;
    if (isset($_POST['lineas']) && is_array($_POST['lineas'])) {
        foreach ($_POST['lineas'] as $linea) {
            $subtotal_linea = $linea['cantidad'] * $linea['precio_unitario'];
            $subtotal += $subtotal_linea;
            $stmt_linea = $db->prepare("INSERT INTO lineas_factura (factura_id, producto_id, cantidad, precio_unitario, total) VALUES (?,?,?,?,?)");
            $stmt_linea->execute([$factura_id, $linea['producto_id'], $linea['cantidad'], $linea['precio_unitario'], $subtotal_linea]);
        }
    }
    $stmt = $db->prepare("UPDATE facturas SET total=? WHERE id=? AND user_id=?");
    $stmt->execute([$subtotal, $factura_id, $_SESSION['usuario']['id']]);
    
    // Process Observaciones: Update or Insert observation for this invoice
    $stmtObsCheck = $db->prepare("SELECT COUNT(*) FROM observaciones_factura WHERE factura_id = ?");
    $stmtObsCheck->execute([$factura_id]);
    if($stmtObsCheck->fetchColumn() > 0) {
        $stmtObsUpdate = $db->prepare("UPDATE observaciones_factura SET observaciones = ? WHERE factura_id = ?");
        $stmtObsUpdate->execute([$_POST['observaciones'], $factura_id]);
    } else {
        $stmtObsInsert = $db->prepare("INSERT INTO observaciones_factura (factura_id, observaciones, user_id) VALUES (?,?,?)");
        $stmtObsInsert->execute([$factura_id, $_POST['observaciones'], $_SESSION['usuario']['id']]);
    }
    
    exit;
}

// For GET, select the invoice with a user filter.
$stmt = $db->prepare("SELECT * FROM facturas WHERE id=? AND user_id=?");
$stmt->execute([$factura_id, $_SESSION['usuario']['id']]);
$factura = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = $db->prepare("SELECT * FROM lineas_factura WHERE factura_id=?");
$stmt->execute([$factura_id]);
$lineas = $stmt->fetchAll(PDO::FETCH_ASSOC);
$misDatosStmt = $db->query("SELECT * FROM mis_datos WHERE id=1");
$misDatos = $misDatosStmt->fetch(PDO::FETCH_ASSOC);
$clientes = $db->query("SELECT * FROM clientes")->fetchAll(PDO::FETCH_ASSOC);
$productos = $db->query("SELECT * FROM productos")->fetchAll(PDO::FETCH_ASSOC);
$epigrafes = $db->query("SELECT * FROM epigrafes")->fetchAll(PDO::FETCH_ASSOC);

$stmtObs = $db->prepare("SELECT observaciones FROM observaciones_factura WHERE factura_id = ?");
$stmtObs->execute([$factura_id]);
$observacion = $stmtObs->fetchColumn();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Factura</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
</head>
<body>
    <h2>Editar Factura</h2>
    <form method="post" action="index.php?page=factura_editar&id=<?php echo $factura_id; ?>" class="form-full">
        <div class="form-row">
            <div class="form-label">
                <label>Nº Factura:</label>
            </div>
            <div class="form-field">
                <input type="text" name="invoice_number" value="<?php echo htmlspecialchars($factura['invoice_number']); ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">
                <label>Fecha:</label>
            </div>
            <div class="form-field">
                <input type="date" name="fecha" value="<?php echo htmlspecialchars($factura['fecha']); ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">
                <label>Cliente:</label>
            </div>
            <div class="form-field">
                <select name="cliente_id" required>
                    <option value="">--Selecciona Cliente--</option>
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?php echo $cliente['id']; ?>" <?php if($cliente['id'] == $factura['cliente_id']) echo "selected"; ?>>
                            <?php echo htmlspecialchars($cliente['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <!-- New Epígrafe selection -->
        <div class="form-row">
            <div class="form-label">
                <label>Epígrafe:</label>
            </div>
            <div class="form-field">
                <select name="epigrafe_id" required>
                    <option value="">--Selecciona Epígrafe--</option>
                    <?php foreach ($epigrafes as $epi): ?>
                        <option value="<?php echo $epi['id']; ?>" <?php if($epi['id'] == $factura['epigrafe_id']) echo "selected"; ?>>
                            <?php echo htmlspecialchars($epi['name']) . " (" . $epi['iva_percentage'] . "% IVA)"; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <!-- Pagado Checkbox -->
        <div class="form-row">
            <div class="form-label">
                <label title="Marque si la factura está pagada">Pagado:</label>
            </div>
            <div class="form-field">
                <label class="switch">
                    <input type="checkbox" name="paid" <?php echo ($factura['paid'] ? 'checked' : ''); ?>>
                    <span class="slider"></span>
                </label>
            </div>
        </div>
        <!-- Invoice Lines Table -->
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>UNIDADES</th>
                    <th>DESCRIPCIÓN</th>
                    <th>PRECIO</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody id="lineas_factura">
                <?php 
                $i = 0;
                foreach ($lineas as $linea):
                ?>
                <tr class="linea_factura">
                    <td>
                        <input type="number" name="lineas[<?php echo $i; ?>][cantidad]" value="<?php echo htmlspecialchars($linea['cantidad']); ?>" required>
                    </td>
                    <td>
                        <select name="lineas[<?php echo $i; ?>][producto_id]" required>
                            <option value="">--Selecciona Producto--</option>
                            <?php foreach ($productos as $producto): ?>
                                <option value="<?php echo $producto['id']; ?>" <?php if($producto['id'] == $linea['producto_id']) echo "selected"; ?> data-price="<?php echo $producto['price']; ?>">
                                    <?php echo htmlspecialchars($producto['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <input type="number" step="0.01" name="lineas[<?php echo $i; ?>][precio_unitario]" value="<?php echo htmlspecialchars($linea['precio_unitario']); ?>" required>
                    </td>
                    <td>
                        <span class="total_linea"><?php echo number_format($linea['total'], 2, ',', '.'); ?>€</span>
                        <button type="button" onclick="this.parentElement.parentElement.remove();">Eliminar</button>
                    </td>
                </tr>
                <?php $i++; endforeach; ?>
            </tbody>
        </table>
        <button type="button" onclick="agregarLinea()">Agregar Línea</button>
        
        <!-- NEW: Observaciones Field -->
        <div class="form-row">
            <div class="form-label">
                <label>Observaciones:</label>
            </div>
            <div class="form-field">
                <textarea name="observaciones" rows="4" placeholder="Ingrese observaciones especiales"><?php echo htmlspecialchars($observacion); ?></textarea>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-field" style="margin-left: auto;">
                <button type="submit" class="btn-submit">Actualizar Factura</button>
            </div>
        </div>
    </form>
    <p>Después de actualizar, la vista completa de la factura se mostrará.</p>
</body>
</html>


```
**editargasto.php**
```php
<?php
if (!isset($_GET['id'])) {
    echo "ID de gasto no proporcionado.";
    exit;
}
$gasto_id = intval($_GET['id']);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['gasto_deducible'])) {
    $stmt = $db->prepare("UPDATE gastos SET gasto_deducible=?, fecha_emision=?, fecha_operaciones=?, numero_factura=?, fecha_factura=?, proveedor_id=?, total_factura=?, base_imponible=?, tipo_retencion=?, importe_retencion=?, tipo_iva=?, cuota_iva=?, iva_deducido=? WHERE id=? AND user_id=?");
    $stmt->execute([
        $_POST['gasto_deducible'],
        $_POST['fecha_emision'],
        $_POST['fecha_operaciones'],
        $_POST['numero_factura'],
        $_POST['fecha_factura'],
        $_POST['proveedor_id'],
        $_POST['total_factura'],
        $_POST['base_imponible'],
        $_POST['tipo_retencion'],
        $_POST['importe_retencion'],
        $_POST['tipo_iva'],
        $_POST['cuota_iva'],
        $_POST['iva_deducido'],
        $gasto_id,
        $_SESSION['usuario']['id']
    ]);
    echo "<script>window.location.href='index.php?page=gastos';</script>";
    exit;
}
$stmt = $db->prepare("SELECT * FROM gastos WHERE id=? AND user_id=?");
$stmt->execute([$gasto_id, $_SESSION['usuario']['id']]);
$gasto = $stmt->fetch(PDO::FETCH_ASSOC);
$proveedoresStmt = $db->prepare("SELECT * FROM proveedores WHERE user_id = ?");
$proveedoresStmt->execute([$_SESSION['usuario']['id']]);
$proveedores = $proveedoresStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Gasto</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2 title="Editar gasto">Editar Gasto</h2>
    <form method="post" action="index.php?page=editargasto&id=<?php echo $gasto_id; ?>" class="form-full">
        <div class="form-row">
            <div class="form-label"><label>Gasto Deducible (€):</label></div>
            <div class="form-field"><input type="number" step="0.01" name="gasto_deducible" value="<?php echo htmlspecialchars($gasto['gasto_deducible']); ?>" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Fecha Emisión:</label></div>
            <div class="form-field"><input type="date" name="fecha_emision" value="<?php echo htmlspecialchars($gasto['fecha_emision']); ?>" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Fecha Operaciones:</label></div>
            <div class="form-field"><input type="date" name="fecha_operaciones" value="<?php echo htmlspecialchars($gasto['fecha_operaciones']); ?>" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Nº Factura:</label></div>
            <div class="form-field"><input type="text" name="numero_factura" value="<?php echo htmlspecialchars($gasto['numero_factura']); ?>" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Fecha Factura:</label></div>
            <div class="form-field"><input type="date" name="fecha_factura" value="<?php echo htmlspecialchars($gasto['fecha_factura']); ?>" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Proveedor:</label></div>
            <div class="form-field">
                <select name="proveedor_id" required>
                    <option value="">--Selecciona Proveedor--</option>
                    <?php foreach($proveedores as $prov): ?>
                        <option value="<?php echo $prov['id']; ?>" <?php if($prov['id'] == $gasto['proveedor_id']) echo "selected"; ?>><?php echo htmlspecialchars($prov['razon_social']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <!-- Resto de los campos -->
        <div class="form-row">
            <div class="form-label"><label>Total Factura (€):</label></div>
            <div class="form-field"><input type="number" step="0.01" name="total_factura" value="<?php echo htmlspecialchars($gasto['total_factura']); ?>" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Base Imponible (€):</label></div>
            <div class="form-field"><input type="number" step="0.01" name="base_imponible" value="<?php echo htmlspecialchars($gasto['base_imponible']); ?>" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Tipo de Retención:</label></div>
            <div class="form-field"><input type="text" name="tipo_retencion" value="<?php echo htmlspecialchars($gasto['tipo_retencion']); ?>" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Importe Retención (€):</label></div>
            <div class="form-field"><input type="number" step="0.01" name="importe_retencion" value="<?php echo htmlspecialchars($gasto['importe_retencion']); ?>" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Tipo de IVA:</label></div>
            <div class="form-field"><input type="text" name="tipo_iva" value="<?php echo htmlspecialchars($gasto['tipo_iva']); ?>" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Cuota IVA (€):</label></div>
            <div class="form-field"><input type="number" step="0.01" name="cuota_iva" value="<?php echo htmlspecialchars($gasto['cuota_iva']); ?>" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>IVA Deducido (€):</label></div>
            <div class="form-field"><input type="number" step="0.01" name="iva_deducido" value="<?php echo htmlspecialchars($gasto['iva_deducido']); ?>" required></div>
        </div>
        <div class="form-row">
            <div class="form-field" style="margin-left: auto;">
                <button type="submit" class="btn-submit" title="Actualizar gasto">Actualizar Gasto</button>
            </div>
        </div>
    </form>
</body>
</html>


```
**editarpresupuesto.php**
```php
<?php
if (!isset($_GET['id'])) {
    echo "ID de presupuesto no proporcionado.";
    exit;
}
$presupuesto_id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['presupuesto_number'])) {
    // Update presupuesto header (filtered by user_id)
    $stmt = $db->prepare("UPDATE presupuestos SET presupuesto_number=?, fecha=?, cliente_id=?, epigrafe_id=? WHERE id=? AND user_id=?");
    $stmt->execute([
        $_POST['presupuesto_number'],
        $_POST['fecha'],
        $_POST['cliente_id'],
        $_POST['epigrafe_id'],
        $presupuesto_id,
        $_SESSION['usuario']['id']
    ]);
    // Delete existing presupuesto lines
    $db->prepare("DELETE FROM lineas_presupuesto WHERE presupuesto_id=?")->execute([$presupuesto_id]);
    $subtotal = 0;
    if (isset($_POST['lineas']) && is_array($_POST['lineas'])) {
        foreach ($_POST['lineas'] as $linea) {
            $subtotal_linea = $linea['cantidad'] * $linea['precio_unitario'];
            $subtotal += $subtotal_linea;
            $stmt_linea = $db->prepare("INSERT INTO lineas_presupuesto (presupuesto_id, producto_id, cantidad, precio_unitario, total) VALUES (?,?,?,?,?)");
            $stmt_linea->execute([$presupuesto_id, $linea['producto_id'], $linea['cantidad'], $linea['precio_unitario'], $subtotal_linea]);
        }
    }
    $stmt = $db->prepare("UPDATE presupuestos SET total=? WHERE id=? AND user_id=?");
    $stmt->execute([$subtotal, $presupuesto_id, $_SESSION['usuario']['id']]);
    
    // Process Observaciones: Update or Insert observation for this presupuesto
    $stmtObsCheck = $db->prepare("SELECT COUNT(*) FROM observaciones_factura WHERE factura_id = ?");
    $stmtObsCheck->execute([$presupuesto_id]);
    if($stmtObsCheck->fetchColumn() > 0) {
        // Update the existing observation
        $stmtObsUpdate = $db->prepare("UPDATE observaciones_factura SET observaciones = ? WHERE factura_id = ?");
        $stmtObsUpdate->execute([$_POST['observaciones'], $presupuesto_id]);
    } else {
        // Insert a new observation record
        $stmtObsInsert = $db->prepare("INSERT INTO observaciones_factura (factura_id, observaciones, user_id) VALUES (?,?,?)");
        $stmtObsInsert->execute([$presupuesto_id, $_POST['observaciones'], $_SESSION['usuario']['id']]);
    }
    
    header("Location: index.php?page=presupuesto_ver&id=" . $presupuesto_id);
    exit;
}

// For GET, select the presupuesto with a user filter.
$stmt = $db->prepare("SELECT * FROM presupuestos WHERE id=? AND user_id=?");
$stmt->execute([$presupuesto_id, $_SESSION['usuario']['id']]);
$presupuesto = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = $db->prepare("SELECT * FROM lineas_presupuesto WHERE presupuesto_id=?");
$stmt->execute([$presupuesto_id]);
$lineas = $stmt->fetchAll(PDO::FETCH_ASSOC);
$misDatosStmt = $db->query("SELECT * FROM mis_datos WHERE id=1");
$misDatos = $misDatosStmt->fetch(PDO::FETCH_ASSOC);
$clientes = $db->query("SELECT * FROM clientes")->fetchAll(PDO::FETCH_ASSOC);
$productos = $db->query("SELECT * FROM productos")->fetchAll(PDO::FETCH_ASSOC);
$epigrafes = $db->query("SELECT * FROM epigrafes")->fetchAll(PDO::FETCH_ASSOC);

// Fetch the current observation, if any
$stmtObs = $db->prepare("SELECT observaciones FROM observaciones_factura WHERE factura_id = ?");
$stmtObs->execute([$presupuesto_id]);
$observacion = $stmtObs->fetchColumn();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Presupuesto</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
</head>
<body>
    <h2>Editar Presupuesto</h2>
    <form method="post" action="index.php?page=presupuesto_editar&id=<?php echo $presupuesto_id; ?>" class="form-full">
        <div class="form-row">
            <div class="form-label">
                <label>Nº Presupuesto:</label>
            </div>
            <div class="form-field">
                <input type="text" name="presupuesto_number" value="<?php echo htmlspecialchars($presupuesto['presupuesto_number']); ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">
                <label>Fecha:</label>
            </div>
            <div class="form-field">
                <input type="date" name="fecha" value="<?php echo htmlspecialchars($presupuesto['fecha']); ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">
                <label>Cliente:</label>
            </div>
            <div class="form-field">
                <select name="cliente_id" required>
                    <option value="">--Selecciona Cliente--</option>
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?php echo $cliente['id']; ?>" <?php if($cliente['id'] == $presupuesto['cliente_id']) echo "selected"; ?>>
                            <?php echo htmlspecialchars($cliente['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <!-- Epígrafe selection -->
        <div class="form-row">
            <div class="form-label">
                <label>Epígrafe:</label>
            </div>
            <div class="form-field">
                <select name="epigrafe_id" required>
                    <option value="">--Selecciona Epígrafe--</option>
                    <?php foreach ($epigrafes as $epi): ?>
                        <option value="<?php echo $epi['id']; ?>" <?php if($epi['id'] == $presupuesto['epigrafe_id']) echo "selected"; ?>>
                            <?php echo htmlspecialchars($epi['name']) . " (" . $epi['iva_percentage'] . "% IVA)"; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <!-- Presupuesto Lines Table -->
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>UNIDADES</th>
                    <th>DESCRIPCIÓN</th>
                    <th class="price-column">PRECIO</th>
                    <th class="price-column">TOTAL</th>
                </tr>
            </thead>
            <tbody id="lineas_factura">
                <?php 
                $i = 0;
                foreach ($lineas as $linea):
                ?>
                <tr class="linea_factura">
                    <td>
                        <input type="number" name="lineas[<?php echo $i; ?>][cantidad]" value="<?php echo htmlspecialchars($linea['cantidad']); ?>" required>
                    </td>
                    <td>
                        <select name="lineas[<?php echo $i; ?>][producto_id]" required>
                            <option value="">--Selecciona Producto--</option>
                            <?php foreach ($productos as $producto): ?>
                                <option value="<?php echo $producto['id']; ?>" <?php if($producto['id'] == $linea['producto_id']) echo "selected"; ?> data-price="<?php echo $producto['price']; ?>">
                                    <?php echo htmlspecialchars($producto['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <input type="number" step="0.01" name="lineas[<?php echo $i; ?>][precio_unitario]" value="<?php echo htmlspecialchars($linea['precio_unitario']); ?>" required>
                    </td>
                    <td>
                        <span class="total_linea"><?php echo number_format($linea['total'], 2, ',', '.'); ?>€</span>
                        <button type="button" onclick="this.parentElement.parentElement.remove();">Eliminar</button>
                    </td>
                </tr>
                <?php $i++; endforeach; ?>
            </tbody>
        </table>
        <button type="button" onclick="agregarLinea()">Agregar Línea</button>
        
        <!-- Observaciones Field -->
        <div class="form-row">
            <div class="form-label">
                <label>Observaciones:</label>
            </div>
            <div class="form-field">
                <textarea name="observaciones" rows="4" placeholder="Ingrese observaciones especiales"><?php echo htmlspecialchars($observacion); ?></textarea>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-field" style="margin-left: auto;">
                <button type="submit" class="btn-submit">Actualizar Presupuesto</button>
            </div>
        </div>
    </form>
    <p>Después de actualizar, la vista completa del presupuesto se mostrará.</p>
</body>
</html>


```
**editarproducto.php**
```php
<?php
if (!isset($_GET['id'])) {
    echo "ID de producto no proporcionado.";
    exit;
}
$producto_id = intval($_GET['id']);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre'])) {
    $stmt = $db->prepare("UPDATE productos SET nombre=?, descripcion=?, price=? WHERE id=? AND user_id=?");
    $stmt->execute([
        $_POST['nombre'],
        $_POST['descripcion'],
        $_POST['price'],
        $producto_id,
        $_SESSION['usuario']['id']
    ]);
    echo "<script>window.location.href='index.php?page=productos';</script>";
    exit;
}
$stmt = $db->prepare("SELECT * FROM productos WHERE id=? AND user_id=?");
$stmt->execute([$producto_id, $_SESSION['usuario']['id']]);
$producto = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2 title="Editar producto">Editar Producto</h2>
    <form method="post" action="index.php?page=producto_editar&id=<?php echo $producto_id; ?>" class="form-full">
        <div class="form-row">
            <div class="form-label">
                <label title="Nombre del producto">Nombre del Producto:</label>
            </div>
            <div class="form-field">
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">
                <label title="Descripción del producto">Descripción:</label>
            </div>
            <div class="form-field">
                <textarea name="descripcion" rows="4" required><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">
                <label title="Precio del producto">Precio:</label>
            </div>
            <div class="form-field">
                <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($producto['price']); ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-field" style="margin-left: auto;">
                <button type="submit" class="btn-submit" title="Actualizar producto">Actualizar Producto</button>
            </div>
        </div>
    </form>
</body>
</html>


```
**editarproveedor.php**
```php
<?php
if (!isset($_GET['id'])) {
    echo "ID de proveedor no proporcionado.";
    exit;
}
$prov_id = intval($_GET['id']);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['razon_social'])) {
    $stmt = $db->prepare("UPDATE proveedores SET razon_social=?, direccion=?, codigo_postal=?, poblacion=?, identificacion_fiscal=?, contacto_nombre=?, contacto_email=?, contacto_telefono=? WHERE id=? AND user_id=?");
    $stmt->execute([
        $_POST['razon_social'],
        $_POST['direccion'],
        $_POST['codigo_postal'],
        $_POST['poblacion'],
        $_POST['identificacion_fiscal'],
        $_POST['contacto_nombre'],
        $_POST['contacto_email'],
        $_POST['contacto_telefono'],
        $prov_id,
        $_SESSION['usuario']['id']
    ]);
    echo "<script>window.location.href='index.php?page=proveedores';</script>";
    exit;
}
$stmt = $db->prepare("SELECT * FROM proveedores WHERE id=? AND user_id=?");
$stmt->execute([$prov_id, $_SESSION['usuario']['id']]);
$prov = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Proveedor</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2 title="Editar proveedor">Editar Proveedor</h2>
    <form method="post" action="index.php?page=editarproveedor&id=<?php echo $prov_id; ?>" class="form-full">
        <div class="form-row">
            <div class="form-label"><label>Razón Social:</label></div>
            <div class="form-field"><input type="text" name="razon_social" value="<?php echo htmlspecialchars($prov['razon_social']); ?>" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Dirección:</label></div>
            <div class="form-field"><input type="text" name="direccion" value="<?php echo htmlspecialchars($prov['direccion']); ?>" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Código Postal:</label></div>
            <div class="form-field"><input type="text" name="codigo_postal" value="<?php echo htmlspecialchars($prov['codigo_postal']); ?>" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Población:</label></div>
            <div class="form-field"><input type="text" name="poblacion" value="<?php echo htmlspecialchars($prov['poblacion']); ?>" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Identificación Fiscal:</label></div>
            <div class="form-field"><input type="text" name="identificacion_fiscal" value="<?php echo htmlspecialchars($prov['identificacion_fiscal']); ?>" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Nombre de Contacto:</label></div>
            <div class="form-field"><input type="text" name="contacto_nombre" value="<?php echo htmlspecialchars($prov['contacto_nombre']); ?>" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Email de Contacto:</label></div>
            <div class="form-field"><input type="email" name="contacto_email" value="<?php echo htmlspecialchars($prov['contacto_email']); ?>" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Teléfono de Contacto:</label></div>
            <div class="form-field"><input type="text" name="contacto_telefono" value="<?php echo htmlspecialchars($prov['contacto_telefono']); ?>" required></div>
        </div>
        <div class="form-row">
            <div class="form-field" style="margin-left: auto;">
                <button type="submit" class="btn-submit" title="Actualizar proveedor">Actualizar Proveedor</button>
            </div>
        </div>
    </form>
</body>
</html>


```
**editarusuario.php**
```php
<?php
if (!isset($_GET['id'])) {
    echo "ID de usuario no proporcionado.";
    exit;
}
$usuario_id = intval($_GET['id']);
// Here you might want to check if the current user is allowed to edit this record.
// For a self‑edit page, enforce that $usuario_id == $_SESSION['usuario']['id'].
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['usuario'])) {
    $stmt = $db->prepare("UPDATE usuarios SET usuario=?, email=?, nombre=?, password=? WHERE id=?");
    $stmt->execute([
        $_POST['usuario'],
        $_POST['email'],
        $_POST['nombre'],
        $_POST['password'],
        $usuario_id
    ]);
    echo "<script>window.location.href='index.php?page=usuarios';</script>";
    exit;
}
$stmt = $db->prepare("SELECT * FROM usuarios WHERE id=?");
$stmt->execute([$usuario_id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2 title="Editar datos del usuario">Editar Usuario</h2>
    <form method="post" action="index.php?page=usuario_editar&id=<?php echo $usuario_id; ?>" class="form-full">
        <div class="form-row">
            <div class="form-label">
                <label title="Nombre de usuario">Usuario:</label>
            </div>
            <div class="form-field">
                <input type="text" name="usuario" value="<?php echo htmlspecialchars($usuario['usuario']); ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">
                <label title="Correo electrónico">Email:</label>
            </div>
            <div class="form-field">
                <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">
                <label title="Nombre completo">Nombre:</label>
            </div>
            <div class="form-field">
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">
                <label title="Contraseña">Contraseña:</label>
            </div>
            <div class="form-field">
                <input type="password" name="password" value="<?php echo htmlspecialchars($usuario['password']); ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-field" style="margin-left: auto;">
                <button type="submit" class="btn-submit" title="Actualizar usuario">Actualizar Usuario</button>
            </div>
        </div>
    </form>
</body>
</html>


```
**epigrafes.php**
```php
<?php
// paginas/epigrafes.php

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
echo "<h2 title='Listado de epígrafes'>Epigrafes</h2>";
echo "<p>Introduzca los códigos o nombres que identifican su actividad económica junto con el porcentaje de IVA correspondiente.</p>";
echo "<a href='index.php?page=epigrafes_crear' class='btn-submit' title='Crear nuevo epígrafe' style='margin-bottom:20px; display:inline-block;'>Crear Epígrafe</a>";

echo "<form method='GET' action='index.php'>";
echo "<input type='hidden' name='page' value='epigrafes'>";
echo "<table title='Tabla de epígrafes'>
        <thead>
          <tr>
            <th>No.</th>
            <th>ID</th>
            <th>Nombre</th>
            <th>IVA (%)</th>
            <th>Acciones</th>
          </tr>
          <tr>
            <th></th>
            <th></th>
            <th><input type='text' name='name' placeholder='Buscar nombre' value='" . (isset($_GET['name']) ? htmlspecialchars($_GET['name']) : "") . "'></th>
            <th><input type='text' name='iva_percentage' placeholder='Buscar IVA' value='" . (isset($_GET['iva_percentage']) ? htmlspecialchars($_GET['iva_percentage']) : "") . "'></th>
            <th><button type='submit'>Buscar</button></th>
          </tr>
        </thead>
        <tbody>";
$query = "SELECT * FROM epigrafes WHERE user_id = ?";
$params = [$_SESSION['usuario']['id']];
if (isset($_GET['name']) && $_GET['name'] !== "") {
    $query .= " AND name LIKE ?";
    $params[] = "%" . $_GET['name'] . "%";
}
if (isset($_GET['iva_percentage']) && $_GET['iva_percentage'] !== "") {
    $query .= " AND iva_percentage = ?";
    $params[] = $_GET['iva_percentage'];
}
require_once 'config.php';
try {
    $db = new PDO($config['db_url']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $ex) {
    die("Error al conectar con la base de datos");
}
$stmt = $db->prepare($query);
$stmt->execute($params);
$i = 1;
$totalRows = 0;
while ($epi = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $totalRows++;
    echo "<tr>";
    echo "<td>" . $i . "</td>";
    echo "<td>" . htmlspecialchars($epi['id']) . "</td>";
    echo "<td>" . htmlspecialchars($epi['name']) . "</td>";
    echo "<td>" . htmlspecialchars($epi['iva_percentage']) . "</td>";
    echo "<td>";
    echo "<a href='index.php?page=epigrafes_editar&id=" . $epi['id'] . "' title='Editar epígrafe'>Editar</a> | ";
    echo "<a href='index.php?page=epigrafes&accion=eliminar&id=" . $epi['id'] . "' onclick='return confirm(\"¿Está seguro?\")' title='Eliminar epígrafe'>Eliminar</a>";
    echo "</td>";
    echo "</tr>";
    $i++;
}
echo "</tbody>";
echo "<tfoot>
      <tr>
        <td colspan='4'>Total de filas: " . $totalRows . "</td>
        <td></td>
      </tr>
      </tfoot>";
echo "</table>";
echo "</form>";

echo "<a href='export_ods.php?table=epigrafes&" . http_build_query($_GET) . "'>Exportar a ODS</a>";

if (isset($_GET['accion']) && $_GET['accion'] == 'eliminar' && isset($_GET['id'])) {
    $stmt = $db->prepare("DELETE FROM epigrafes WHERE id=? AND user_id=?");
    $stmt->execute([$_GET['id'], $_SESSION['usuario']['id']]);
    echo "<p class='success' title='Epígrafe eliminado'>Epigrafe eliminado.</p>";
}
?>


```
**epigrafes_editar.php**
```php
<?php
if (!isset($_GET['id'])) {
    echo "ID de epígrafe no proporcionado.";
    exit;
}
$epi_id = intval($_GET['id']);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
    $stmt = $db->prepare("UPDATE epigrafes SET name=?, iva_percentage=? WHERE id=? AND user_id=?");
    $stmt->execute([
        $_POST['name'],
        $_POST['iva_percentage'],
        $epi_id,
        $_SESSION['usuario']['id']
    ]);
    echo "<script>window.location.href='index.php?page=epigrafes';</script>";
    exit;
}
$stmt = $db->prepare("SELECT * FROM epigrafes WHERE id=? AND user_id=?");
$stmt->execute([$epi_id, $_SESSION['usuario']['id']]);
$epi = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Epígrafe</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2 title="Editar epígrafe">Editar Epígrafe</h2>
    <form method="post" action="index.php?page=epigrafes_editar&id=<?php echo $epi_id; ?>" class="form-full">
        <div class="form-row">
            <div class="form-label">
                <label title="Nombre del epígrafe">Nombre:</label>
            </div>
            <div class="form-field">
                <input type="text" name="name" value="<?php echo htmlspecialchars($epi['name']); ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">
                <label title="IVA (%)">IVA (%):</label>
            </div>
            <div class="form-field">
                <select name="iva_percentage" required>
                    <option value="21" <?php if($epi['iva_percentage']==21) echo "selected"; ?>>General (21%)</option>
                    <option value="10" <?php if($epi['iva_percentage']==10) echo "selected"; ?>>Reducido (10%)</option>
                    <option value="4" <?php if($epi['iva_percentage']==4) echo "selected"; ?>>Superreducido (4%)</option>
                    <option value="0" <?php if($epi['iva_percentage']==0) echo "selected"; ?>>Exento (0%)</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-field" style="margin-left: auto;">
                <button type="submit" class="btn-submit" title="Actualizar epígrafe">Actualizar Epígrafe</button>
            </div>
        </div>
    </form>
</body>
</html>


```
**escritorio.php**
```php
<?php

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
$userId = $_SESSION['usuario']['id'];

// Monthly totals (line chart)
$stmt = $db->prepare("
    SELECT strftime('%Y-%m', fecha) AS month, SUM(total) AS total 
    FROM facturas 
    WHERE user_id = ? 
    AND fecha LIKE '%2025%'
    GROUP BY strftime('%Y-%m', fecha) 
    ORDER BY month
");
$stmt->execute([$userId]);
$monthlyData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Quarterly totals for ALL years (aggregate by quarter letter)
$stmt = $db->prepare("
    SELECT 
         CASE
            WHEN CAST(STRFTIME('%m', fecha) AS INTEGER) BETWEEN 1 AND 3 THEN 'Q1'
            WHEN CAST(STRFTIME('%m', fecha) AS INTEGER) BETWEEN 4 AND 6 THEN 'Q2'
            WHEN CAST(STRFTIME('%m', fecha) AS INTEGER) BETWEEN 7 AND 9 THEN 'Q3'
            ELSE 'Q4'
         END AS quarter,
         SUM(total) AS total
    FROM facturas
    WHERE user_id = ?
    GROUP BY quarter
    ORDER BY quarter
");
$stmt->execute([$userId]);
$quarterlyAllData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Quarterly totals for CURRENT year only
$currentYear = date('Y');
$stmt = $db->prepare("
    SELECT 
         CASE
            WHEN CAST(STRFTIME('%m', fecha) AS INTEGER) BETWEEN 1 AND 3 THEN 'Q1'
            WHEN CAST(STRFTIME('%m', fecha) AS INTEGER) BETWEEN 4 AND 6 THEN 'Q2'
            WHEN CAST(STRFTIME('%m', fecha) AS INTEGER) BETWEEN 7 AND 9 THEN 'Q3'
            ELSE 'Q4'
         END AS quarter,
         SUM(total) AS total
    FROM facturas
    WHERE user_id = ? AND STRFTIME('%Y', fecha) = ?
    GROUP BY quarter
    ORDER BY quarter
");
$stmt->execute([$userId, $currentYear]);
$quarterlyCurrentData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Yearly totals (total invoiced per year)
$stmt = $db->prepare("
    SELECT strftime('%Y', fecha) AS year, SUM(total) AS total
    FROM facturas
    WHERE user_id = ?
    GROUP BY year
    ORDER BY year
");
$stmt->execute([$userId]);
$yearlyData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Pie chart: Total invoiced per customer (aggregated)
$stmt = $db->prepare("
    SELECT c.name AS cliente, SUM(f.total) AS total 
    FROM facturas f 
    JOIN clientes c ON f.cliente_id = c.id 
    WHERE f.user_id = ? 
    GROUP BY c.name 
    ORDER BY total DESC
");
$stmt->execute([$userId]);
$customerData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// For each customer, get quarterly totals (with quarter label including year)
$stmt = $db->prepare("
    SELECT DISTINCT c.id, c.name AS customer 
    FROM facturas f 
    JOIN clientes c ON f.cliente_id = c.id 
    WHERE f.user_id = ? 
    ORDER BY c.name
");
$stmt->execute([$userId]);
$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
$customerChartsData = [];
foreach ($customers as $cust) {
    $stmt = $db->prepare("
         SELECT 
           CASE
              WHEN CAST(STRFTIME('%m', fecha) AS INTEGER) BETWEEN 1 AND 3 THEN 'Q1-' || STRFTIME('%Y', fecha)
              WHEN CAST(STRFTIME('%m', fecha) AS INTEGER) BETWEEN 4 AND 6 THEN 'Q2-' || STRFTIME('%Y', fecha)
              WHEN CAST(STRFTIME('%m', fecha) AS INTEGER) BETWEEN 7 AND 9 THEN 'Q3-' || STRFTIME('%Y', fecha)
              ELSE 'Q4-' || STRFTIME('%Y', fecha)
           END AS quarter,
           SUM(total) AS total
         FROM facturas
         WHERE user_id = ? AND cliente_id = ?
         GROUP BY quarter
         ORDER BY quarter
    ");
    $stmt->execute([$userId, $cust['id']]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $customerChartsData[] = ['customer' => $cust['customer'], 'data' => $data];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Escritorio - Panel de Administración</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/charts.js"></script>
    <style>
      /* Container for main charts */
      #charts-container {
         display: grid;
         grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
         gap: 20px;
         padding: 20px;
      }
      .chart-title {
          text-align: center;
          font-size: 18px;
          font-weight: bold;
          margin-bottom: 10px;
      }
      /* Container for per-customer charts rendered as a grid */
      #customer-charts-container {
          display: grid;
          grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
          gap: 20px;
          padding: 20px;
      }
      #customer-charts-container .customer-chart {
          border: 1px solid #ddd;
          padding: 10px;
          background: #fff;
          box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      }
    </style>
</head>
<body>
    <div id="charts-container">
        <div>
            <div class="chart-title" title="Total Facturado Por Mes">Total Facturado Por Mes</div>
            <div id="line-chart" title="Total Facturado Por Mes"></div>
        </div>
        <div>
            <div class="chart-title" title="Total Facturado Por Trimestre (Todos los años)">Total Facturado Por Trimestre (Todos los años)</div>
            <div id="quarterly-all-chart" title="Trimestre - Todos los años"></div>
        </div>
        <div>
            <div class="chart-title" title="Total Facturado Por Trimestre (Año Actual)">Total Facturado Por Trimestre (Año Actual)</div>
            <div id="quarterly-current-chart" title="Trimestre - Año Actual"></div>
        </div>
        <div>
            <div class="chart-title" title="Total Facturado Por Año">Total Facturado Por Año</div>
            <div id="yearly-chart" title="Facturado Por Año"></div>
        </div>
        <div>
            <div class="chart-title" title="Total Facturado Por Cliente">Total Facturado Por Cliente</div>
            <div id="pie-chart" title="Facturado Por Cliente"></div>
        </div>
    </div>
    <div id="customer-charts-container">
        <h2 style="grid-column: 1 / -1; text-align: center;">Total Facturado Por Cliente por Trimestre</h2>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Monthly data processing
            const monthlyDataRaw = <?php echo json_encode(array_map(function($row){
                return [$row['month'], (float)$row['total']];
            }, $monthlyData)); ?>;
            const monthlyData = monthlyDataRaw.map(d => ({
                x: new Date(d[0] + "-01").getTime(),
                y: d[1]
            }));

            // Quarterly data for all years
            const quarterlyAllDataRaw = <?php echo json_encode(array_map(function($row){
                return [$row['quarter'], (float)$row['total']];
            }, $quarterlyAllData)); ?>;
            const quarterlyAllData = quarterlyAllDataRaw.map(d => ({
                label: d[0],
                value: d[1]
            }));

            // Quarterly data for current year
            const quarterlyCurrentDataRaw = <?php echo json_encode(array_map(function($row){
                return [$row['quarter'], (float)$row['total']];
            }, $quarterlyCurrentData)); ?>;
            const quarterlyCurrentData = quarterlyCurrentDataRaw.map(d => ({
                label: d[0],
                value: d[1]
            }));

            // Yearly data processing
            const yearlyDataRaw = <?php echo json_encode(array_map(function($row){
                return [$row['year'], (float)$row['total']];
            }, $yearlyData)); ?>;
            const yearlyData = yearlyDataRaw.map(d => ({
                label: d[0],
                value: d[1]
            }));

            // Customer pie chart data
            const customerDataRaw = <?php echo json_encode(array_map(function($row){
                return [$row['cliente'], (float)$row['total']];
            }, $customerData)); ?>;
            const customerDataPie = customerDataRaw.map(d => ({
                label: d[0],
                value: d[1]
            }));

            // Create monthly line chart
            const lineChart = MyCharts.createLineChart(monthlyData, {
                width: 600,
                height: 400,
                stroke: "green",
                strokeWidth: 2,
                circleRadius: 4,
                margin: { top: 60, right: 20, bottom: 50, left: 50 }
            });
            document.getElementById('line-chart').appendChild(lineChart);

            // Create quarterly (all years) bar chart
            const quarterlyAllChart = MyCharts.createBarChart(quarterlyAllData, {
                width: 600,
                height: 400,
                barColor: "purple",
                margin: { top: 20, right: 20, bottom: 40, left: 40 }
            });
            document.getElementById('quarterly-all-chart').appendChild(quarterlyAllChart);

            // Create quarterly (current year) bar chart
            const quarterlyCurrentChart = MyCharts.createBarChart(quarterlyCurrentData, {
                width: 600,
                height: 400,
                barColor: "orange",
                margin: { top: 20, right: 20, bottom: 40, left: 40 }
            });
            document.getElementById('quarterly-current-chart').appendChild(quarterlyCurrentChart);

            // Create yearly bar chart
            const yearlyChart = MyCharts.createBarChart(yearlyData, {
                width: 600,
                height: 400,
                barColor: "blue",
                margin: { top: 20, right: 20, bottom: 40, left: 40 }
            });
            document.getElementById('yearly-chart').appendChild(yearlyChart);

            // Create pie chart for total per customer
            const pieChart = MyCharts.createPieChart(customerDataPie, {
                width: 400,
                height: 400,
                colors: ["#4daf4a", "#377eb8", "#ff7f00", "#984ea3", "#e41a1c"]
            });
            document.getElementById('pie-chart').appendChild(pieChart);

            // Create per-customer quarterly charts in grid
            const customerChartsData = <?php echo json_encode($customerChartsData); ?>;
            const customerContainer = document.getElementById('customer-charts-container');
            customerChartsData.forEach(customerObj => {
                const div = document.createElement('div');
                div.className = "customer-chart";
                const title = document.createElement('div');
                title.className = "chart-title";
                title.textContent = "Cliente: " + customerObj.customer;
                div.appendChild(title);
                const chartData = customerObj.data.map(d => ({
                    label: d.quarter,
                    value: parseFloat(d.total)
                }));
                const barChart = MyCharts.createBarChart(chartData, {
                    width: 300,
                    height: 250,
                    barColor: "teal",
                    margin: { top: 20, right: 20, bottom: 40, left: 40 }
                });
                div.appendChild(barChart);
                customerContainer.appendChild(div);
            });
        });
    </script>
</body>
</html>


```
**export_ods.php**
```php
<?php
// export_ods.php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
require_once 'config.php';
try {
  $db = new PDO($config['db_url']);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $ex) {
  die("Error al conectar con la base de datos");
}

// Allowed tables to export
$allowedTables = ['clientes', 'facturas'];
$table = isset($_GET['table']) ? $_GET['table'] : '';
if (!in_array($table, $allowedTables)) {
  die("Tabla no permitida para exportación.");
}
$userId = $_SESSION['usuario']['id'];

switch ($table) {
  case 'clientes':
    $query = "SELECT id, name, address, postal_code, city, id_number FROM clientes WHERE user_id = ?";
    $params = [$userId];
    break;
  case 'facturas':
    $query = "SELECT id, invoice_number, fecha, cliente_id, total FROM facturas WHERE user_id = ?";
    $params = [$userId];
    break;
  default:
    die("Export para esta tabla no implementado.");
}

$stmt = $db->prepare($query);
$stmt->execute($params);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Build headers from data keys; add extra “No.” column at the beginning
$headers = [];
if(count($data) > 0) {
  $headers = array_keys($data[0]);
  array_unshift($headers, "No.");
} else {
  // Define default headers for known tables
  if ($table === 'clientes') {
    $headers = ["No.", "id", "name", "address", "postal_code", "city", "id_number"];
  } elseif ($table === 'facturas') {
    $headers = ["No.", "id", "invoice_number", "fecha", "cliente_id", "total"];
  }
}

// Build rows array (each row as an indexed array)
$rows = [];
$i = 1;
foreach($data as $row) {
  $rowWithNo = array_merge(["No." => $i], $row);
  $rows[] = array_values($rowWithNo);
  $i++;
}

// (Optional) You might add a final row with totals; here we simply add a row with the row count.
$footer = ["Total filas: " . count($rows)];
// Pad the footer array to match number of columns
while(count($footer) < count($headers)) {
    $footer[] = "";
}
$rows[] = $footer;

// Output a minimal Flat ODS (FODS) file
header("Content-Type: application/vnd.oasis.opendocument.spreadsheet");
header("Content-Disposition: attachment; filename=\"{$table}_export.ods\"");
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<office:document-content 
    xmlns:office="urn:oasis:names:tc:opendocument:xmlns:office:1.0"
    xmlns:table="urn:oasis:names:tc:opendocument:xmlns:table:1.0"
    xmlns:text="urn:oasis:names:tc:opendocument:xmlns:text:1.0"
    office:version="1.2">
  <office:body>
    <office:spreadsheet>
      <table:table table:name="Sheet1">
        <!-- Header Row -->
        <table:table-row>
        <?php foreach($headers as $header): ?>
          <table:table-cell office:value-type="string">
            <text:p><?php echo htmlspecialchars($header); ?></text:p>
          </table:table-cell>
        <?php endforeach; ?>
        </table:table-row>
        <!-- Data Rows -->
        <?php foreach($rows as $row): ?>
        <table:table-row>
          <?php foreach($row as $cell): ?>
          <table:table-cell office:value-type="string">
            <text:p><?php echo htmlspecialchars($cell); ?></text:p>
          </table:table-cell>
          <?php endforeach; ?>
        </table:table-row>
        <?php endforeach; ?>
      </table:table>
    </office:spreadsheet>
  </office:body>
</office:document-content>


```
**exportar.php**
```php
<?php
ob_start(); // Start output buffering

session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

$config = require 'config.php';
try {
    $db = new PDO($config['db_url']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $ex) {
    die("Error al conectar con la base de datos");
}

$userId = $_SESSION['usuario']['id'];

// Define each sheet with its SQL query and the header names.
$sheets = [
    "mis_datos" => [
        "query" => "SELECT invoice_title, invoice_subtitle, my_name, address, postal_code, city, id_number, bank_account, invoice_footer FROM mis_datos WHERE user_id = ?",
        "headers" => ["invoice_title", "invoice_subtitle", "my_name", "address", "postal_code", "city", "id_number", "bank_account", "invoice_footer"]
    ],
    "epigrafes" => [
        "query" => "SELECT id, name, iva_percentage FROM epigrafes WHERE user_id = ?",
        "headers" => ["id", "name", "iva_percentage"]
    ],
    "retenciones" => [
        "query" => "SELECT id, name, percentage FROM retenciones WHERE user_id = ?",
        "headers" => ["id", "name", "percentage"]
    ],
    "clientes" => [
        "query" => "SELECT id, name, address, postal_code, city, id_number FROM clientes WHERE user_id = ?",
        "headers" => ["id", "name", "address", "postal_code", "city", "id_number"]
    ],
    "facturas" => [
        "query" => "SELECT id, invoice_number, fecha, cliente_id, total FROM facturas WHERE user_id = ?",
        "headers" => ["id", "invoice_number", "fecha", "cliente_id", "total"]
    ],
    "productos" => [
        "query" => "SELECT id, nombre, descripcion, price FROM productos WHERE user_id = ?",
        "headers" => ["id", "nombre", "descripcion", "price"]
    ],
    "gastos" => [
        "query" => "SELECT id, gasto_deducible, fecha_emision, fecha_operaciones, numero_factura, fecha_factura, proveedor_id, total_factura, base_imponible, tipo_retencion, importe_retencion, tipo_iva, cuota_iva, iva_deducido FROM gastos WHERE user_id = ?",
        "headers" => ["id", "gasto_deducible", "fecha_emision", "fecha_operaciones", "numero_factura", "fecha_factura", "proveedor_id", "total_factura", "base_imponible", "tipo_retencion", "importe_retencion", "tipo_iva", "cuota_iva", "iva_deducido"]
    ],
    "proveedores" => [
        "query" => "SELECT id, razon_social, direccion, codigo_postal, poblacion, identificacion_fiscal, contacto_nombre, contacto_email, contacto_telefono FROM proveedores WHERE user_id = ?",
        "headers" => ["id", "razon_social", "direccion", "codigo_postal", "poblacion", "identificacion_fiscal", "contacto_nombre", "contacto_email", "contacto_telefono"]
    ],
    "presupuestos" => [
        "query" => "SELECT id, presupuesto_number, fecha, cliente_id, total FROM presupuestos WHERE user_id = ?",
        "headers" => ["id", "presupuesto_number", "fecha", "cliente_id", "total"]
    ]
];

// Begin building the ODS file in Flat ODS (FODS) XML format.
$xml = '<?xml version="1.0" encoding="UTF-8"?>';
$xml .= '<office:document-content 
    xmlns:office="urn:oasis:names:tc:opendocument:xmlns:office:1.0"
    xmlns:table="urn:oasis:names:tc:opendocument:xmlns:table:1.0"
    xmlns:text="urn:oasis:names:tc:opendocument:xmlns:text:1.0"
    office:version="1.2">';
$xml .= '<office:body><office:spreadsheet>';

foreach ($sheets as $sheetName => $sheetData) {
    $query = $sheetData['query'];
    $headers = $sheetData['headers'];
    
    $stmt = $db->prepare($query);
    $stmt->execute([$userId]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Only add the sheet if there is data.
    if (!$data) continue;
    
    // Start the sheet with the table name.
    $xml .= '<table:table table:name="' . htmlspecialchars($sheetName) . '">';
    
    // Write header row (prepend a "No." column for numbering).
    $xml .= '<table:table-row>';
    $xml .= '<table:table-cell office:value-type="string"><text:p>No.</text:p></table:table-cell>';
    foreach ($headers as $header) {
        $xml .= '<table:table-cell office:value-type="string"><text:p>' . htmlspecialchars($header) . '</text:p></table:table-cell>';
    }
    $xml .= '</table:table-row>';
    
    // Write each data row.
    $rowNumber = 1;
    foreach ($data as $row) {
        $xml .= '<table:table-row>';
        $xml .= '<table:table-cell office:value-type="string"><text:p>' . $rowNumber . '</text:p></table:table-cell>';
        foreach ($headers as $header) {
            $cellValue = isset($row[$header]) ? $row[$header] : "";
            $xml .= '<table:table-cell office:value-type="string"><text:p>' . htmlspecialchars($cellValue) . '</text:p></table:table-cell>';
        }
        $xml .= '</table:table-row>';
        $rowNumber++;
    }
    
    // Optional footer row with the total number of rows.
    $xml .= '<table:table-row>';
    $xml .= '<table:table-cell office:value-type="string"><text:p>Total filas: ' . ($rowNumber - 1) . '</text:p></table:table-cell>';
    for ($i = 0; $i < count($headers); $i++) {
        $xml .= '<table:table-cell office:value-type="string"><text:p></text:p></table:table-cell>';
    }
    $xml .= '</table:table-row>';
    
    $xml .= '</table:table>';
}

$xml .= '</office:spreadsheet></office:body></office:document-content>';

// Clear any previous output and send headers to prevent caching.
ob_clean();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Type: application/vnd.oasis.opendocument.spreadsheet");
header("Content-Disposition: attachment; filename=\"export_{$userId}.ods\"");
echo $xml;
exit;
?>


```
**facturas.php**
```php
<?php
// paginas/facturas.php

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
require_once 'config.php';
try {
    $db = new PDO($config['db_url']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $ex) {
    die("Error al conectar con la base de datos");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Facturas</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2 title="Listado de facturas">Facturas</h2>

<!-- Pending Payments Box -->
<div id="pending-payments" style="border:1px solid #ddd; padding:10px; margin-bottom:20px;">
  <h3>Pagos Pendientes</h3>
  <div id="pending-summary">
    Cargando información...
  </div>
</div>

<p>Esta área le permite crear, visualizar, editar, imprimir y eliminar facturas.</p>
<a href="index.php?page=factura_crear" class="btn-submit" title="Crear nueva factura" style="margin-bottom:20px; display:inline-block;">Crear Factura</a>

<form method="GET" action="index.php">
  <input type="hidden" name="page" value="facturas">
  <table title="Tabla de facturas">
    <thead>
      <!-- Search Filter Row -->
      <tr>
        <th></th>
        <th></th>
        <th>
          <input type="text" name="invoice_number" placeholder="Buscar factura" value="<?php echo isset($_GET['invoice_number']) ? htmlspecialchars($_GET['invoice_number']) : ''; ?>">
        </th>
        <th>
          <input type="date" name="fecha" value="<?php echo isset($_GET['fecha']) ? htmlspecialchars($_GET['fecha']) : ''; ?>">
        </th>
        <th>
          <select name="cliente_id">
            <option value="">Todos</option>
            <?php
              $clientes = $db->query("SELECT * FROM clientes WHERE user_id = " . $_SESSION['usuario']['id'])->fetchAll(PDO::FETCH_ASSOC);
              foreach ($clientes as $cliente) {
                $selected = (isset($_GET['cliente_id']) && $_GET['cliente_id'] == $cliente['id']) ? "selected" : "";
                echo "<option value='{$cliente['id']}' $selected>" . htmlspecialchars($cliente['name']) . "</option>";
              }
            ?>
          </select>
        </th>
        <th>
          <select name="epigrafe_id">
            <option value="">Todos</option>
            <?php
              $epigrafes = $db->query("SELECT * FROM epigrafes WHERE user_id = " . $_SESSION['usuario']['id'])->fetchAll(PDO::FETCH_ASSOC);
              foreach ($epigrafes as $epi) {
                $selected = (isset($_GET['epigrafe_id']) && $_GET['epigrafe_id'] == $epi['id']) ? "selected" : "";
                echo "<option value='{$epi['id']}' $selected>" . htmlspecialchars($epi['name']) . "</option>";
              }
            ?>
          </select>
        </th>
        <th>
          <input type="text" name="total" placeholder="Total" value="<?php echo isset($_GET['total']) ? htmlspecialchars($_GET['total']) : ''; ?>">
        </th>
        <!-- New Column: Pagado -->
        <th>Pagado</th>
        <th>
          <button type="submit">Buscar</button>
        </th>
      </tr>
      <!-- Table header with extra columns -->
      <tr>
        <th>No.</th>
        <th>ID</th>
        <th>Nº Factura</th>
        <th>Fecha</th>
        <th>Cliente</th>
        <th>Epígrafe</th>
        <th>Total (€)</th>
        <th>Pagado</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $query = "SELECT f.*, c.name as cliente_nombre, e.name as epigrafe_name 
          FROM facturas f
          LEFT JOIN clientes c ON f.cliente_id = c.id
          LEFT JOIN epigrafes e ON f.epigrafe_id = e.id
          WHERE f.user_id = ?
          ORDER BY f.fecha DESC";
      $params = [$_SESSION['usuario']['id']];
      if (isset($_GET['invoice_number']) && $_GET['invoice_number'] !== "") {
          $query .= " AND f.invoice_number LIKE ?";
          $params[] = "%" . $_GET['invoice_number'] . "%";
      }
      if (isset($_GET['fecha']) && $_GET['fecha'] !== "") {
          $query .= " AND f.fecha = ?";
          $params[] = $_GET['fecha'];
      }
      if (isset($_GET['cliente_id']) && $_GET['cliente_id'] !== "") {
          $query .= " AND f.cliente_id = ?";
          $params[] = $_GET['cliente_id'];
      }
      if (isset($_GET['epigrafe_id']) && $_GET['epigrafe_id'] !== "") {
          $query .= " AND f.epigrafe_id = ?";
          $params[] = $_GET['epigrafe_id'];
      }
      if (isset($_GET['total']) && $_GET['total'] !== "") {
          $query .= " AND f.total = ?";
          $params[] = $_GET['total'];
      }
      $stmt = $db->prepare($query);
      $stmt->execute($params);
      $i = 1;
      $totalRows = 0;
      $sumTotal = 0;
      while ($factura = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $totalRows++;
          $sumTotal += (float)$factura['total'];
      ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo htmlspecialchars($factura['id']); ?></td>
        <td><?php echo htmlspecialchars($factura['invoice_number']); ?></td>
        <td><?php echo htmlspecialchars($factura['fecha']); ?></td>
        <td><?php echo htmlspecialchars($factura['cliente_nombre']); ?></td>
        <td><?php echo htmlspecialchars($factura['epigrafe_name'] ?: 'N/A'); ?></td>
        <td><?php echo number_format($factura['total'], 2, ',', '.') . "€"; ?></td>
        <td>
          <label class="switch">
            <input type="checkbox" class="paid-checkbox" data-id="<?php echo $factura['id']; ?>" <?php echo $factura['paid'] ? 'checked' : ''; ?>>
            <span class="slider"></span>
          </label>
        </td>
        <td>
          <a href='index.php?page=factura_ver&id=<?php echo $factura['id']; ?>' title='Ver factura'>Ver</a> |
          <a href='index.php?page=factura_editar&id=<?php echo $factura['id']; ?>' title='Editar factura'>Editar</a> |
          <a href='index.php?page=factura_imprimir&id=<?php echo $factura['id']; ?>' title='Imprimir factura'>Imprimir</a> |
          <a href='index.php?page=facturas&accion=eliminar&id=<?php echo $factura['id']; ?>' onclick='return confirm("¿Está seguro?")' title='Eliminar factura'>Eliminar</a>
        </td>
      </tr>
      <?php $i++; } ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="6">Total de filas: <?php echo $totalRows; ?></td>
        <td><?php echo number_format($sumTotal, 2, ',', '.') . "€"; ?></td>
        <td colspan="2"></td>
      </tr>
    </tfoot>
  </table>
</form>
<a href="export_ods.php?table=facturas&<?php echo http_build_query($_GET); ?>">Exportar a ODS</a>

<script>
// Function to update invoice "paid" status via Ajax
document.querySelectorAll('.paid-checkbox').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        const invoiceId = this.getAttribute('data-id');
        const newPaid = this.checked ? '1' : '0';
        fetch('api/update_paid.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'invoice_id=' + invoiceId + '&paid=' + newPaid
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Invoice " + invoiceId + " updated to paid=" + data.paid);
                fetchPendingPayments(); // refresh pending payments summary
            } else {
                alert("Error updating invoice: " + (data.error || "Unknown error"));
            }
        })
        .catch(error => {
            alert("Request failed: " + error);
        });
    });
});

// Function to fetch pending payments summary
function fetchPendingPayments() {
    fetch('api/get_pending_payments.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                document.getElementById('pending-summary').innerHTML = "Error: " + data.error;
            } else {
                let html = "<p>Total Pendiente: " + data.total.toFixed(2) + "€</p>";
                html += "<ul>";
                for (const customer in data.byCustomer) {
                    html += "<li>" + customer + ": " + data.byCustomer[customer].toFixed(2) + "€</li>";
                }
                html += "</ul>";
                document.getElementById('pending-summary').innerHTML = html;
            }
        })
        .catch(error => {
            document.getElementById('pending-summary').innerHTML = "Error fetching data";
        });
}

// Fetch pending payments on page load
fetchPendingPayments();
</script>

<?php
// Delete invoice along with its invoice lines
if (isset($_GET['accion']) && $_GET['accion'] == 'eliminar' && isset($_GET['id'])) {
    $invoiceIdToDelete = $_GET['id'];
    // First, delete all invoice lines for this invoice
    $stmtDeleteLines = $db->prepare("DELETE FROM lineas_factura WHERE factura_id = ?");
    $stmtDeleteLines->execute([$invoiceIdToDelete]);
    
    // Then, delete the invoice
    $stmtDeleteInvoice = $db->prepare("DELETE FROM facturas WHERE id=? AND user_id=?");
    $stmtDeleteInvoice->execute([$invoiceIdToDelete, $_SESSION['usuario']['id']]);
    echo "<p class='success' title='Factura eliminada'>Factura eliminada.</p>";
}
?>

</body>
</html>


```
**gastos.php**
```php
<?php
// paginas/gastos.php

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Gastos</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2 title="Listado de gastos">Gastos</h2>
<p>Gestione el registro de gastos. Cada gasto se almacena con datos fiscales y deducibles.</p>
<a href="index.php?page=creargasto" class="btn-submit" title="Crear nuevo gasto" style="margin-bottom:20px; display:inline-block;">Crear Gasto</a>

<form method="GET" action="index.php">
  <input type="hidden" name="page" value="gastos">
  <table title="Tabla de gastos">
    <thead>
      <!-- Search Filter Row -->
      <tr>
       <th></th>
      <th></th>
        <th>
          <input type="text" name="gasto_deducible" placeholder="Buscar gasto deducible" value="<?php echo isset($_GET['gasto_deducible']) ? htmlspecialchars($_GET['gasto_deducible']) : ''; ?>">
        </th>
        <th>
          <input type="date" name="fecha_emision" value="<?php echo isset($_GET['fecha_emision']) ? htmlspecialchars($_GET['fecha_emision']) : ''; ?>">
        </th>
        <th>
          <input type="date" name="fecha_operaciones" value="<?php echo isset($_GET['fecha_operaciones']) ? htmlspecialchars($_GET['fecha_operaciones']) : ''; ?>">
        </th>
        <th>
          <input type="text" name="numero_factura" placeholder="Buscar Nº Factura" value="<?php echo isset($_GET['numero_factura']) ? htmlspecialchars($_GET['numero_factura']) : ''; ?>">
        </th>
        <th>
          <input type="date" name="fecha_factura" value="<?php echo isset($_GET['fecha_factura']) ? htmlspecialchars($_GET['fecha_factura']) : ''; ?>">
        </th>
        <th>
          <select name="proveedor_id">
            <option value="">Todos</option>
            <?php
              require_once 'config.php';
              try {
                  $db = new PDO($config['db_url']);
                  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              } catch(Exception $ex) {
                  die("Error al conectar con la base de datos");
              }
              $proveedores = $db->query("SELECT * FROM proveedores WHERE user_id = " . $_SESSION['usuario']['id'])->fetchAll(PDO::FETCH_ASSOC);
              foreach ($proveedores as $prov) {
                $selected = (isset($_GET['proveedor_id']) && $_GET['proveedor_id'] == $prov['id']) ? "selected" : "";
                echo "<option value='{$prov['id']}' $selected>" . htmlspecialchars($prov['razon_social']) . "</option>";
              }
            ?>
          </select>
        </th>
        <th>
          <input type="text" name="total_factura" placeholder="Buscar Total Factura" value="<?php echo isset($_GET['total_factura']) ? htmlspecialchars($_GET['total_factura']) : ''; ?>">
        </th>
        <th>
          <input type="text" name="base_imponible" placeholder="Buscar Base Imponible" value="<?php echo isset($_GET['base_imponible']) ? htmlspecialchars($_GET['base_imponible']) : ''; ?>">
        </th>
        <th>
          <input type="text" name="tipo_retencion" placeholder="Buscar Tipo Retención" value="<?php echo isset($_GET['tipo_retencion']) ? htmlspecialchars($_GET['tipo_retencion']) : ''; ?>">
        </th>
        <th>
          <input type="text" name="importe_retencion" placeholder="Buscar Importe Retención" value="<?php echo isset($_GET['importe_retencion']) ? htmlspecialchars($_GET['importe_retencion']) : ''; ?>">
        </th>
        <th>
          <input type="text" name="tipo_iva" placeholder="Buscar Tipo IVA" value="<?php echo isset($_GET['tipo_iva']) ? htmlspecialchars($_GET['tipo_iva']) : ''; ?>">
        </th>
        <th>
          <input type="text" name="cuota_iva" placeholder="Buscar Cuota IVA" value="<?php echo isset($_GET['cuota_iva']) ? htmlspecialchars($_GET['cuota_iva']) : ''; ?>">
        </th>
        <th>
          <input type="text" name="iva_deducido" placeholder="Buscar IVA Deducido" value="<?php echo isset($_GET['iva_deducido']) ? htmlspecialchars($_GET['iva_deducido']) : ''; ?>">
        </th>
        <th>
          <button type="submit">Buscar</button>
        </th>
      </tr>
      <!-- Table Header with extra columns -->
      <tr>
        <th>No.</th>
        <th>ID</th>
        <th>Gasto Deducible (€)</th>
        <th>Fecha Emisión</th>
        <th>Fecha Operaciones</th>
        <th>Nº Factura</th>
        <th>Fecha Factura</th>
        <th>Proveedor</th>
        <th>Total Factura (€)</th>
        <th>Base Imponible (€)</th>
        <th>Tipo Retención</th>
        <th>Importe Retención (€)</th>
        <th>Tipo IVA</th>
        <th>Cuota IVA (€)</th>
        <th>IVA Deducido (€)</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $query = "SELECT g.*, p.razon_social as proveedor_razon FROM gastos g LEFT JOIN proveedores p ON g.proveedor_id = p.id WHERE g.user_id = ?";
      $params = [$_SESSION['usuario']['id']];
      if (isset($_GET['gasto_deducible']) && $_GET['gasto_deducible'] !== "") {
          $query .= " AND g.gasto_deducible = ?";
          $params[] = $_GET['gasto_deducible'];
      }
      if (isset($_GET['fecha_emision']) && $_GET['fecha_emision'] !== "") {
          $query .= " AND g.fecha_emision = ?";
          $params[] = $_GET['fecha_emision'];
      }
      if (isset($_GET['fecha_operaciones']) && $_GET['fecha_operaciones'] !== "") {
          $query .= " AND g.fecha_operaciones = ?";
          $params[] = $_GET['fecha_operaciones'];
      }
      if (isset($_GET['numero_factura']) && $_GET['numero_factura'] !== "") {
          $query .= " AND g.numero_factura LIKE ?";
          $params[] = "%" . $_GET['numero_factura'] . "%";
      }
      if (isset($_GET['fecha_factura']) && $_GET['fecha_factura'] !== "") {
          $query .= " AND g.fecha_factura = ?";
          $params[] = $_GET['fecha_factura'];
      }
      if (isset($_GET['proveedor_id']) && $_GET['proveedor_id'] !== "") {
          $query .= " AND g.proveedor_id = ?";
          $params[] = $_GET['proveedor_id'];
      }
      if (isset($_GET['total_factura']) && $_GET['total_factura'] !== "") {
          $query .= " AND g.total_factura = ?";
          $params[] = $_GET['total_factura'];
      }
      if (isset($_GET['base_imponible']) && $_GET['base_imponible'] !== "") {
          $query .= " AND g.base_imponible = ?";
          $params[] = $_GET['base_imponible'];
      }
      if (isset($_GET['tipo_retencion']) && $_GET['tipo_retencion'] !== "") {
          $query .= " AND g.tipo_retencion LIKE ?";
          $params[] = "%" . $_GET['tipo_retencion'] . "%";
      }
      if (isset($_GET['importe_retencion']) && $_GET['importe_retencion'] !== "") {
          $query .= " AND g.importe_retencion = ?";
          $params[] = $_GET['importe_retencion'];
      }
      if (isset($_GET['tipo_iva']) && $_GET['tipo_iva'] !== "") {
          $query .= " AND g.tipo_iva LIKE ?";
          $params[] = "%" . $_GET['tipo_iva'] . "%";
      }
      if (isset($_GET['cuota_iva']) && $_GET['cuota_iva'] !== "") {
          $query .= " AND g.cuota_iva = ?";
          $params[] = $_GET['cuota_iva'];
      }
      if (isset($_GET['iva_deducido']) && $_GET['iva_deducido'] !== "") {
          $query .= " AND g.iva_deducido = ?";
          $params[] = $_GET['iva_deducido'];
      }
      $stmt = $db->prepare($query);
      $stmt->execute($params);
      $i = 1;
      $totalRows = 0;
      // Sum variables for monetary columns
      $sumGastoDeducible = 0;
      $sumTotalFactura = 0;
      $sumBaseImponible = 0;
      $sumImporteRetencion = 0;
      $sumCuotaIva = 0;
      $sumIvaDeducido = 0;
      while ($gasto = $stmt->fetch(PDO::FETCH_ASSOC)) :
          $totalRows++;
          $sumGastoDeducible += (float)$gasto['gasto_deducible'];
          $sumTotalFactura += (float)$gasto['total_factura'];
          $sumBaseImponible += (float)$gasto['base_imponible'];
          $sumImporteRetencion += (float)$gasto['importe_retencion'];
          $sumCuotaIva += (float)$gasto['cuota_iva'];
          $sumIvaDeducido += (float)$gasto['iva_deducido'];
      ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo htmlspecialchars($gasto['id']); ?></td>
        <td><?php echo number_format($gasto['gasto_deducible'], 2, ',', '.') . "€"; ?></td>
        <td><?php echo htmlspecialchars($gasto['fecha_emision']); ?></td>
        <td><?php echo htmlspecialchars($gasto['fecha_operaciones']); ?></td>
        <td><?php echo htmlspecialchars($gasto['numero_factura']); ?></td>
        <td><?php echo htmlspecialchars($gasto['fecha_factura']); ?></td>
        <td><?php echo htmlspecialchars($gasto['proveedor_razon']); ?></td>
        <td><?php echo number_format($gasto['total_factura'], 2, ',', '.') . "€"; ?></td>
        <td><?php echo number_format($gasto['base_imponible'], 2, ',', '.') . "€"; ?></td>
        <td><?php echo htmlspecialchars($gasto['tipo_retencion']); ?></td>
        <td><?php echo number_format($gasto['importe_retencion'], 2, ',', '.') . "€"; ?></td>
        <td><?php echo htmlspecialchars($gasto['tipo_iva']); ?></td>
        <td><?php echo number_format($gasto['cuota_iva'], 2, ',', '.') . "€"; ?></td>
        <td><?php echo number_format($gasto['iva_deducido'], 2, ',', '.') . "€"; ?></td>
        <td>
          <a href="index.php?page=editargasto&id=<?php echo $gasto['id']; ?>" title="Editar gasto">Editar</a> |
          <a href="index.php?page=gastos&accion=eliminar&id=<?php echo $gasto['id']; ?>" onclick="return confirm('¿Está seguro?')" title="Eliminar gasto">Eliminar</a>
        </td>
      </tr>
      <?php $i++; endwhile; ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2">Total de filas: <?php echo $totalRows; ?></td>
        <td><?php echo number_format($sumGastoDeducible, 2, ',', '.') . "€"; ?></td>
        <td colspan="3"></td>
        <td></td>
        <td><?php echo number_format($sumTotalFactura, 2, ',', '.') . "€"; ?></td>
        <td><?php echo number_format($sumBaseImponible, 2, ',', '.') . "€"; ?></td>
        <td colspan="1"></td>
        <td><?php echo number_format($sumImporteRetencion, 2, ',', '.') . "€"; ?></td>
        <td colspan="1"></td>
        <td><?php echo number_format($sumCuotaIva, 2, ',', '.') . "€"; ?></td>
        <td><?php echo number_format($sumIvaDeducido, 2, ',', '.') . "€"; ?></td>
        <td></td>
      </tr>
    </tfoot>
  </table>
</form>
<a href="export_ods.php?table=gastos&<?php echo http_build_query($_GET); ?>">Exportar a ODS</a>
<?php
if (isset($_GET['accion']) && $_GET['accion'] == 'eliminar' && isset($_GET['id'])) {
    $stmt = $db->prepare("DELETE FROM gastos WHERE id=? AND user_id=?");
    $stmt->execute([$_GET['id'], $_SESSION['usuario']['id']]);
    echo "<p class='success' title='Gasto eliminado'>Gasto eliminado.</p>";
}
?>
</body>
</html>


```
**importar.php**
```php
<?php
// paginas/importar.php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
$config = require 'config.php';
try {
    $db = new PDO($config['db_url']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $ex) {
    die("Error al conectar con la base de datos");
}

$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['csv_file'])) {
    $csvFile = $_FILES['csv_file']['tmp_name'];
    if (($handle = fopen($csvFile, "r")) !== false) {
        // Read header row; expected columns:
        // invoice_number, fecha, customer_name, customer_address, customer_postal, customer_city, customer_id_number, product_name, product_description, quantity, unit_price, observations
        $header = fgetcsv($handle, 1000, ",");
        $invoices = [];
        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            $row = array_combine($header, $data);
            $invNum = $row['invoice_number'];
            if (!isset($invoices[$invNum])) {
                $invoices[$invNum] = [
                    'fecha'             => $row['fecha'],
                    'customer_name'     => $row['customer_name'],
                    'customer_address'  => $row['customer_address'],
                    'customer_postal'   => $row['customer_postal'],
                    'customer_city'     => $row['customer_city'],
                    'customer_id_number'=> $row['customer_id_number'],
                    'observations'      => isset($row['observations']) ? $row['observations'] : "",
                    'lines'             => []
                ];
            }
            $invoices[$invNum]['lines'][] = [
                'product_name'        => $row['product_name'],
                'product_description' => $row['product_description'],
                'quantity'            => $row['quantity'],
                'unit_price'          => $row['unit_price']
            ];
        }
        fclose($handle);

        // Process each invoice
        foreach ($invoices as $invoiceNumber => $invoiceData) {
            // Check if customer exists (by name and id_number)
            $stmt = $db->prepare("SELECT id FROM clientes WHERE name = ? AND id_number = ? AND user_id = ?");
            $stmt->execute([$invoiceData['customer_name'], $invoiceData['customer_id_number'], $_SESSION['usuario']['id']]);
            $customerId = $stmt->fetchColumn();
            if (!$customerId) {
                $stmt = $db->prepare("INSERT INTO clientes (name, address, postal_code, city, id_number, user_id) VALUES (?,?,?,?,?,?)");
                $stmt->execute([
                    $invoiceData['customer_name'],
                    $invoiceData['customer_address'],
                    $invoiceData['customer_postal'],
                    $invoiceData['customer_city'],
                    $invoiceData['customer_id_number'],
                    $_SESSION['usuario']['id']
                ]);
                $customerId = $db->lastInsertId();
            }
            // Get mis_datos record id for the user
            $stmt = $db->prepare("SELECT id FROM mis_datos WHERE user_id = ? LIMIT 1");
            $stmt->execute([$_SESSION['usuario']['id']]);
            $misDatosId = $stmt->fetchColumn();
            // Insert invoice (using default epigrafe and retencion IDs, e.g. 1)
            $stmt = $db->prepare("INSERT INTO facturas (invoice_number, fecha, cliente_id, mis_datos_id, total, epigrafe_id, retencion_id, user_id) VALUES (?,?,?,?,?,?,?,?)");
            $stmt->execute([
                $invoiceNumber,
                $invoiceData['fecha'],
                $customerId,
                $misDatosId,
                0, // provisional total
                1, // default epígrafe_id
                1, // default retencion_id
                $_SESSION['usuario']['id']
            ]);
            $facturaId = $db->lastInsertId();
            $subtotal = 0;
            foreach ($invoiceData['lines'] as $line) {
                // Check if product exists
                $stmt = $db->prepare("SELECT id, price FROM productos WHERE nombre = ? AND user_id = ?");
                $stmt->execute([$line['product_name'], $_SESSION['usuario']['id']]);
                $product = $stmt->fetch(PDO::FETCH_ASSOC);
                if (!$product) {
                    $stmt = $db->prepare("INSERT INTO productos (nombre, descripcion, price, user_id) VALUES (?,?,?,?)");
                    $stmt->execute([
                        $line['product_name'],
                        $line['product_description'],
                        $line['unit_price'],
                        $_SESSION['usuario']['id']
                    ]);
                    $productId = $db->lastInsertId();
                    $unitPrice = $line['unit_price'];
                } else {
                    $productId = $product['id'];
                    $unitPrice = $product['price'];
                }
                $lineTotal = $line['quantity'] * $unitPrice;
                $subtotal += $lineTotal;
                $stmt = $db->prepare("INSERT INTO lineas_factura (factura_id, producto_id, cantidad, precio_unitario, total) VALUES (?,?,?,?,?)");
                $stmt->execute([$facturaId, $productId, $line['quantity'], $unitPrice, $lineTotal]);
            }
            $stmt = $db->prepare("UPDATE facturas SET total=? WHERE id=?");
            $stmt->execute([$subtotal, $facturaId]);
            if (!empty($invoiceData['observations'])) {
                $stmt = $db->prepare("INSERT INTO observaciones_factura (factura_id, observaciones, user_id) VALUES (?,?,?)");
                $stmt->execute([$facturaId, $invoiceData['observations'], $_SESSION['usuario']['id']]);
            }
        }
        $message = "Importación completada exitosamente.";
    } else {
        $message = "No se pudo abrir el archivo CSV.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Importar Facturas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Importar Facturas (CSV)</h2>
    <?php if($message) echo "<p>$message</p>"; ?>
    <form method="post" action="index.php?page=importar" enctype="multipart/form-data">
        <div>
            <label for="csv_file">Seleccione el archivo CSV:</label>
            <input type="file" name="csv_file" id="csv_file" accept=".csv" required>
        </div>
        <div>
            <button type="submit">Importar</button>
        </div>
    </form>
    <p>Descargar plantilla CSV: <a href="paginas/descargar_plantilla_importar.php" target="_blank" title="Descargar plantilla CSV">Descargar Plantilla</a>
</p>
</body>
</html>


```
**imprimirfactura.php**
```php
<?php
if (!isset($_GET['id'])) {
    echo "ID de factura no proporcionado.";
    exit;
}
$factura_id = intval($_GET['id']);

// Retrieve the invoice joining with clientes and epigrafes to get IVA data.
$stmt = $db->prepare("SELECT f.*, 
                           c.name as cliente_nombre, 
                           c.address as cliente_address, 
                           c.postal_code as cliente_postal, 
                           c.city as cliente_city, 
                           c.id_number as cliente_id_number,
                           e.iva_percentage as epigrafe_iva,
                           e.name as epigrafe_name
                      FROM facturas f 
                      LEFT JOIN clientes c ON f.cliente_id = c.id 
                      LEFT JOIN epigrafes e ON f.epigrafe_id = e.id
                      WHERE f.id = ? AND f.user_id = ?");
$stmt->execute([$factura_id, $_SESSION['usuario']['id']]);
$factura = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$factura) {
    echo "Factura no encontrada.";
    exit;
}

// Retrieve invoice lines.
$stmt = $db->prepare("SELECT * FROM lineas_factura WHERE factura_id = ?");
$stmt->execute([$factura_id]);
$lineas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Retrieve user's invoice settings.
$misDatosStmt = $db->prepare("SELECT * FROM mis_datos WHERE user_id = ?");
$misDatosStmt->execute([$_SESSION['usuario']['id']]);
$misDatos = $misDatosStmt->fetch(PDO::FETCH_ASSOC);

// Calculate totals using the epígrafe's IVA percentage if available.
$subtotal = $factura['total'];
$iva_percentage = (isset($factura['epigrafe_iva']) && $factura['epigrafe_iva'] !== null) ? $factura['epigrafe_iva'] / 100 : 0.21;
$iva = $subtotal * $iva_percentage;
$irpf = $subtotal * 0.15;
$total_final = $subtotal + $iva - $irpf;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Imprimir Factura</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        @media print {
            header, nav, button {
                display: none !important;
            }
            #factura {
                display: block !important;
                visibility: visible !important;
                position: relative;
                left: 0;
                top: 0;
                width: 100%;
                border: none;
            }
            body {
                margin: 0;
                padding: 0;
            }
            @page {
                size: A4;
                margin: 20mm;
            }
        }
    </style>
    <script>
        function printInvoice() {
            setTimeout(function() {
                window.print();
            }, 500);
        }
    </script>
</head>
<body onload="printInvoice()">
    <?php include 'invoice_template.php'; ?>
</body>
</html>


```
**imprimirpresupuesto.php**
```php
<?php
if (!isset($_GET['id'])) {
    echo "ID de presupuesto no proporcionado.";
    exit;
}
$presupuesto_id = intval($_GET['id']);

// Retrieve the presupuesto joining with clientes and epigrafes to get IVA data.
$stmt = $db->prepare("SELECT p.*, 
                           c.name as cliente_nombre, 
                           c.address as cliente_address, 
                           c.postal_code as cliente_postal, 
                           c.city as cliente_city, 
                           c.id_number as cliente_id_number,
                           e.iva_percentage as epigrafe_iva,
                           e.name as epigrafe_name
                      FROM presupuestos p 
                      LEFT JOIN clientes c ON p.cliente_id = c.id 
                      LEFT JOIN epigrafes e ON p.epigrafe_id = e.id
                      WHERE p.id = ? AND p.user_id = ?");
$stmt->execute([$presupuesto_id, $_SESSION['usuario']['id']]);
$presupuesto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$presupuesto) {
    echo "Presupuesto no encontrado.";
    exit;
}

// Retrieve presupuesto lines.
$stmt = $db->prepare("SELECT * FROM lineas_presupuesto WHERE presupuesto_id = ?");
$stmt->execute([$presupuesto_id]);
$lineas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Retrieve user's invoice settings.
$misDatosStmt = $db->prepare("SELECT * FROM mis_datos WHERE user_id = ?");
$misDatosStmt->execute([$_SESSION['usuario']['id']]);
$misDatos = $misDatosStmt->fetch(PDO::FETCH_ASSOC);

// Calculate totals using the epigrafe's IVA percentage if available.
$subtotal = $presupuesto['total'];
$iva_percentage = (isset($presupuesto['epigrafe_iva']) && $presupuesto['epigrafe_iva'] !== null) ? $presupuesto['epigrafe_iva'] / 100 : 0.21;
$iva = $subtotal * $iva_percentage;
$irpf = $subtotal * 0.15;
$total_final = $subtotal + $iva - $irpf;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Imprimir Presupuesto</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        @media print {
            header, nav, button {
                display: none !important;
            }
            #presupuesto {
                display: block !important;
                visibility: visible !important;
                position: relative;
                left: 0;
                top: 0;
                width: 100%;
                border: none;
            }
            body {
                margin: 0;
                padding: 0;
            }
            @page {
                size: A4;
                margin: 20mm;
            }
        }
    </style>
    <script>
        function printPresupuesto() {
            setTimeout(function() {
                window.print();
            }, 500);
        }
    </script>
</head>
<body onload="printPresupuesto()">
    <?php include 'presupuesto_template.php'; ?>
</body>
</html>


```
**informes.php**
```php
<?php
// páginas/informes.php

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Informes</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    .informes-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
      margin-top: 20px;
    }
    .informe-card {
      background: #fff;
      border: 1px solid #ddd;
      padding: 20px;
      border-radius: 4px;
      width: 300px;
      text-align: center;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      transition: transform 0.2s;
    }
    .informe-card:hover {
      transform: translateY(-5px);
    }
    .informe-card h3 {
      margin-bottom: 10px;
      color: #333;
    }
    .informe-card p {
      font-size: 14px;
      color: #555;
      margin-bottom: 20px;
    }
    .informe-card a.btn-submit {
      background: #007bff;
      color: #fff;
      padding: 10px 20px;
      border-radius: 4px;
      text-decoration: none;
      font-weight: bold;
    }
    .informe-card a.btn-submit:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>
  <h2 title="Informes">Informes</h2>
  <p>Seleccione el informe que desea visualizar. Todos los informes muestran datos únicamente del usuario actual.</p>
  <div class="informes-container">
    <div class="informe-card" title="Libro de Ingresos">
      <h3>Libro de Ingresos</h3>
      <p>Listado detallado de todos los ingresos facturados.</p>
      <a href="index.php?page=informes_libro_ingresos" class="btn-submit" title="Ver Libro de Ingresos">Ver</a>
    </div>
    <div class="informe-card" title="Libro de Gastos">
      <h3>Libro de Gastos</h3>
      <p>Listado detallado de todos los gastos registrados.</p>
      <a href="index.php?page=informes_libro_gastos" class="btn-submit" title="Ver Libro de Gastos">Ver</a>
    </div>
    <div class="informe-card" title="Libro Mayor">
      <h3>Libro Mayor</h3>
      <p>Consolidado de ingresos y gastos ordenado cronológicamente.</p>
      <a href="index.php?page=informes_libro_mayor" class="btn-submit" title="Ver Libro Mayor">Ver</a>
    </div>
  </div>
</body>
</html>


```
**informes_libro_gastos.php**
```php
<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
$userId = $_SESSION['usuario']['id'];

// --- Tabla Resumen (Agregado) de Gastos ---
$summaryQuery = "
  SELECT STRFTIME('%Y', fecha_emision) AS year,
         CASE 
           WHEN CAST(STRFTIME('%m', fecha_emision) AS INTEGER) BETWEEN 1 AND 3 THEN 'Q1'
           WHEN CAST(STRFTIME('%m', fecha_emision) AS INTEGER) BETWEEN 4 AND 6 THEN 'Q2'
           WHEN CAST(STRFTIME('%m', fecha_emision) AS INTEGER) BETWEEN 7 AND 9 THEN 'Q3'
           ELSE 'Q4'
         END AS quarter,
         SUM(total_factura) AS total
  FROM gastos
  WHERE user_id = ?
  GROUP BY year, quarter
  ORDER BY year, quarter
";
$stmt = $db->prepare($summaryQuery);
$stmt->execute([$userId]);
$summaryData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Organizar los totales por año
$summaryGastos = [];
foreach ($summaryData as $row) {
    $year = $row['year'];
    $quarter = $row['quarter'];
    $summaryGastos[$year][$quarter] = $row['total'];
}
$years = array_keys($summaryGastos);
sort($years);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Libro de Gastos</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
    th, td { border: 1px solid #ddd; padding: 5px; text-align: center; }
  </style>
</head>
<body>
  <h2>Libro de Gastos – Resumen Agregado</h2>
  <table>
    <thead>
      <tr>
        <th>Año</th>
        <th>Q1 (Ene-Mar)</th>
        <th>Q2 (Abr-Jun)</th>
        <th>Q3 (Jul-Sep)</th>
        <th>Q4 (Oct-Dic)</th>
        <th>Total Anual</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($years as $year): 
          $q1 = isset($summaryGastos[$year]['Q1']) ? $summaryGastos[$year]['Q1'] : 0;
          $q2 = isset($summaryGastos[$year]['Q2']) ? $summaryGastos[$year]['Q2'] : 0;
          $q3 = isset($summaryGastos[$year]['Q3']) ? $summaryGastos[$year]['Q3'] : 0;
          $q4 = isset($summaryGastos[$year]['Q4']) ? $summaryGastos[$year]['Q4'] : 0;
          $totalAnual = $q1 + $q2 + $q3 + $q4;
      ?>
      <tr>
        <td><?php echo $year; ?></td>
        <td><?php echo number_format($q1, 2, ',', '.'); ?>€</td>
        <td><?php echo number_format($q2, 2, ',', '.'); ?>€</td>
        <td><?php echo number_format($q3, 2, ',', '.'); ?>€</td>
        <td><?php echo number_format($q4, 2, ',', '.'); ?>€</td>
        <td><?php echo number_format($totalAnual, 2, ',', '.'); ?>€</td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <!-- Tabla Detallada -->
  <h2>Libro de Gastos – Detalle</h2>
  <?php
  $detailedStmt = $db->prepare("SELECT fecha_emision AS fecha, numero_factura AS descripcion, total_factura AS monto FROM gastos WHERE user_id = ? ORDER BY fecha_emision");
  $detailedStmt->execute([$userId]);
  $gastosDetalles = $detailedStmt->fetchAll(PDO::FETCH_ASSOC);

  $currentYear = null;
  $currentQuarter = null;
  $yearTotal = 0;
  $quarterTotal = 0;
  ?>
  <table>
    <thead>
      <tr>
        <th>Fecha</th>
        <th>Factura</th>
        <th>Monto</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($gastosDetalles as $item):
            $timestamp = strtotime($item['fecha']);
            $year = date("Y", $timestamp);
            $month = date("n", $timestamp);
            if ($month >= 1 && $month <= 3) {
              $quarter = "Q1 (Ene-Mar)";
            } elseif ($month >= 4 && $month <= 6) {
              $quarter = "Q2 (Abr-Jun)";
            } elseif ($month >= 7 && $month <= 9) {
              $quarter = "Q3 (Jul-Sep)";
            } else {
              $quarter = "Q4 (Oct-Dic)";
            }
            if ($currentYear === null || $year != $currentYear) {
                if ($currentYear !== null) {
                    echo "<tr style='background:#e0e0e0; font-weight:bold;'><td colspan='2'>Subtotal de $currentQuarter</td><td>" . number_format($quarterTotal, 2, ',', '.') . "€</td></tr>";
                    echo "<tr style='background:#e0e0e0; font-weight:bold;'><td colspan='2'>Total del Año $currentYear</td><td>" . number_format($yearTotal, 2, ',', '.') . "€</td></tr>";
                }
                echo "<tr style='background:#f0f0f0; font-weight:bold;'><td colspan='3'>Año: $year</td></tr>";
                $currentYear = $year;
                $yearTotal = 0;
                $currentQuarter = null;
                $quarterTotal = 0;
            }
            if ($currentQuarter === null || $quarter != $currentQuarter) {
                if ($currentQuarter !== null) {
                    echo "<tr style='background:#e0e0e0; font-weight:bold;'><td colspan='2'>Subtotal de $currentQuarter</td><td>" . number_format($quarterTotal, 2, ',', '.') . "€</td></tr>";
                }
                echo "<tr style='background:#f0f0f0; font-weight:bold;'><td colspan='3'>$quarter</td></tr>";
                $currentQuarter = $quarter;
                $quarterTotal = 0;
            }
            echo "<tr>";
            echo "<td>" . htmlspecialchars($item['fecha']) . "</td>";
            echo "<td>" . htmlspecialchars($item['descripcion']) . "</td>";
            echo "<td style='text-align: right;'>" . number_format($item['monto'], 2, ',', '.') . "€</td>";
            echo "</tr>";
            $quarterTotal += $item['monto'];
            $yearTotal += $item['monto'];
         endforeach;
         if ($currentYear !== null) {
            echo "<tr style='background:#e0e0e0; font-weight:bold;'><td colspan='2'>Subtotal de $currentQuarter</td><td>" . number_format($quarterTotal, 2, ',', '.') . "€</td></tr>";
            echo "<tr style='background:#e0e0e0; font-weight:bold;'><td colspan='2'>Total del Año $currentYear</td><td>" . number_format($yearTotal, 2, ',', '.') . "€</td></tr>";
         }
    ?>
    </tbody>
  </table>
</body>
</html>


```
**informes_libro_ingresos.php**
```php
<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
$userId = $_SESSION['usuario']['id'];

// --- Tabla Resumen (Agregado) de Ingresos ---
$summaryQuery = "
  SELECT STRFTIME('%Y', fecha) AS year,
         CASE 
           WHEN CAST(STRFTIME('%m', fecha) AS INTEGER) BETWEEN 1 AND 3 THEN 'Q1'
           WHEN CAST(STRFTIME('%m', fecha) AS INTEGER) BETWEEN 4 AND 6 THEN 'Q2'
           WHEN CAST(STRFTIME('%m', fecha) AS INTEGER) BETWEEN 7 AND 9 THEN 'Q3'
           ELSE 'Q4'
         END AS quarter,
         SUM(total) AS total
  FROM facturas
  WHERE user_id = ?
  GROUP BY year, quarter
  ORDER BY year, quarter
";
$stmt = $db->prepare($summaryQuery);
$stmt->execute([$userId]);
$summaryData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Organizar los totales por año
$summaryIngresos = [];
foreach ($summaryData as $row) {
    $year = $row['year'];
    $quarter = $row['quarter'];
    $summaryIngresos[$year][$quarter] = $row['total'];
}
$years = array_keys($summaryIngresos);
sort($years);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Libro de Ingresos</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
    th, td { border: 1px solid #ddd; padding: 5px; text-align: center; }
  </style>
</head>
<body>
  <h2>Libro de Ingresos – Resumen Agregado</h2>
  <table>
    <thead>
      <tr>
        <th>Año</th>
        <th>Q1 (Ene-Mar)</th>
        <th>Q2 (Abr-Jun)</th>
        <th>Q3 (Jul-Sep)</th>
        <th>Q4 (Oct-Dic)</th>
        <th>Total Anual</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($years as $year): 
          $q1 = isset($summaryIngresos[$year]['Q1']) ? $summaryIngresos[$year]['Q1'] : 0;
          $q2 = isset($summaryIngresos[$year]['Q2']) ? $summaryIngresos[$year]['Q2'] : 0;
          $q3 = isset($summaryIngresos[$year]['Q3']) ? $summaryIngresos[$year]['Q3'] : 0;
          $q4 = isset($summaryIngresos[$year]['Q4']) ? $summaryIngresos[$year]['Q4'] : 0;
          $totalAnual = $q1 + $q2 + $q3 + $q4;
      ?>
      <tr>
        <td><?php echo $year; ?></td>
        <td><?php echo number_format($q1, 2, ',', '.'); ?>€</td>
        <td><?php echo number_format($q2, 2, ',', '.'); ?>€</td>
        <td><?php echo number_format($q3, 2, ',', '.'); ?>€</td>
        <td><?php echo number_format($q4, 2, ',', '.'); ?>€</td>
        <td><?php echo number_format($totalAnual, 2, ',', '.'); ?>€</td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <!-- Tabla Detallada -->
  <h2>Libro de Ingresos – Detalle</h2>
  <?php
  $detailedStmt = $db->prepare("SELECT fecha, invoice_number AS descripcion, total AS monto FROM facturas WHERE user_id = ? ORDER BY fecha");
  $detailedStmt->execute([$userId]);
  $ingresosDetalles = $detailedStmt->fetchAll(PDO::FETCH_ASSOC);

  $currentYear = null;
  $currentQuarter = null;
  $yearTotal = 0;
  $quarterTotal = 0;
  ?>
  <table>
    <thead>
      <tr>
        <th>Fecha</th>
        <th>Factura</th>
        <th>Monto</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($ingresosDetalles as $item):
            $timestamp = strtotime($item['fecha']);
            $year = date("Y", $timestamp);
            $month = date("n", $timestamp);
            if ($month >= 1 && $month <= 3) {
              $quarter = "Q1 (Ene-Mar)";
            } elseif ($month >= 4 && $month <= 6) {
              $quarter = "Q2 (Abr-Jun)";
            } elseif ($month >= 7 && $month <= 9) {
              $quarter = "Q3 (Jul-Sep)";
            } else {
              $quarter = "Q4 (Oct-Dic)";
            }
            // Si cambia el año, imprimir subtotal del trimestre anterior y total del año previo
            if ($currentYear === null || $year != $currentYear) {
                if ($currentYear !== null) {
                    echo "<tr style='background:#e0e0e0; font-weight:bold;'><td colspan='2'>Subtotal de $currentQuarter</td><td>" . number_format($quarterTotal, 2, ',', '.') . "€</td></tr>";
                    echo "<tr style='background:#e0e0e0; font-weight:bold;'><td colspan='2'>Total del Año $currentYear</td><td>" . number_format($yearTotal, 2, ',', '.') . "€</td></tr>";
                }
                echo "<tr style='background:#f0f0f0; font-weight:bold;'><td colspan='3'>Año: $year</td></tr>";
                $currentYear = $year;
                $yearTotal = 0;
                $currentQuarter = null;
                $quarterTotal = 0;
            }
            // Si cambia el trimestre dentro del mismo año
            if ($currentQuarter === null || $quarter != $currentQuarter) {
                if ($currentQuarter !== null) {
                    echo "<tr style='background:#e0e0e0; font-weight:bold;'><td colspan='2'>Subtotal de $currentQuarter</td><td>" . number_format($quarterTotal, 2, ',', '.') . "€</td></tr>";
                }
                echo "<tr style='background:#f0f0f0; font-weight:bold;'><td colspan='3'>$quarter</td></tr>";
                $currentQuarter = $quarter;
                $quarterTotal = 0;
            }
            echo "<tr>";
            echo "<td>" . htmlspecialchars($item['fecha']) . "</td>";
            echo "<td>" . htmlspecialchars($item['descripcion']) . "</td>";
            echo "<td style='text-align: right;'>" . number_format($item['monto'], 2, ',', '.') . "€</td>";
            echo "</tr>";
            $quarterTotal += $item['monto'];
            $yearTotal += $item['monto'];
         endforeach;
         if ($currentYear !== null) {
            echo "<tr style='background:#e0e0e0; font-weight:bold;'><td colspan='2'>Subtotal de $currentQuarter</td><td>" . number_format($quarterTotal, 2, ',', '.') . "€</td></tr>";
            echo "<tr style='background:#e0e0e0; font-weight:bold;'><td colspan='2'>Total del Año $currentYear</td><td>" . number_format($yearTotal, 2, ',', '.') . "€</td></tr>";
         }
    ?>
    </tbody>
  </table>
</body>
</html>


```
**informes_libro_mayor.php**
```php
<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
$userId = $_SESSION['usuario']['id'];

// --- Resumen Agregado para Ingresos ---
$ingresosQuery = "
  SELECT STRFTIME('%Y', fecha) AS year,
         CASE 
           WHEN CAST(STRFTIME('%m', fecha) AS INTEGER) BETWEEN 1 AND 3 THEN 'Q1'
           WHEN CAST(STRFTIME('%m', fecha) AS INTEGER) BETWEEN 4 AND 6 THEN 'Q2'
           WHEN CAST(STRFTIME('%m', fecha) AS INTEGER) BETWEEN 7 AND 9 THEN 'Q3'
           ELSE 'Q4'
         END AS quarter,
         SUM(total) AS total
  FROM facturas
  WHERE user_id = ?
  GROUP BY year, quarter
  ORDER BY year, quarter
";
$stmt = $db->prepare($ingresosQuery);
$stmt->execute([$userId]);
$ingresosData = $stmt->fetchAll(PDO::FETCH_ASSOC);
$ingresosSummary = [];
foreach ($ingresosData as $row) {
    $year = $row['year'];
    $quarter = $row['quarter'];
    $ingresosSummary[$year][$quarter] = $row['total'];
}

// --- Resumen Agregado para Gastos ---
$gastosQuery = "
  SELECT STRFTIME('%Y', fecha_emision) AS year,
         CASE 
           WHEN CAST(STRFTIME('%m', fecha_emision) AS INTEGER) BETWEEN 1 AND 3 THEN 'Q1'
           WHEN CAST(STRFTIME('%m', fecha_emision) AS INTEGER) BETWEEN 4 AND 6 THEN 'Q2'
           WHEN CAST(STRFTIME('%m', fecha_emision) AS INTEGER) BETWEEN 7 AND 9 THEN 'Q3'
           ELSE 'Q4'
         END AS quarter,
         SUM(total_factura) AS total
  FROM gastos
  WHERE user_id = ?
  GROUP BY year, quarter
  ORDER BY year, quarter
";
$stmt = $db->prepare($gastosQuery);
$stmt->execute([$userId]);
$gastosData = $stmt->fetchAll(PDO::FETCH_ASSOC);
$gastosSummary = [];
foreach ($gastosData as $row) {
    $year = $row['year'];
    $quarter = $row['quarter'];
    $gastosSummary[$year][$quarter] = $row['total'];
}

// Calcular el neto (Ingresos - Gastos) para cada año y trimestre
$allYears = array_unique(array_merge(array_keys($ingresosSummary), array_keys($gastosSummary)));
sort($allYears);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Libro Mayor</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
    th, td { border: 1px solid #ddd; padding: 5px; text-align: center; }
  </style>
</head>
<body>
  <h2>Libro Mayor – Resumen Agregado (Ingresos - Gastos)</h2>
  <table>
    <thead>
      <tr>
        <th>Año</th>
        <th>Q1 (Ene-Mar)</th>
        <th>Q2 (Abr-Jun)</th>
        <th>Q3 (Jul-Sep)</th>
        <th>Q4 (Oct-Dic)</th>
        <th>Total Anual</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($allYears as $year): 
          $netQ1 = (isset($ingresosSummary[$year]['Q1']) ? $ingresosSummary[$year]['Q1'] : 0) - (isset($gastosSummary[$year]['Q1']) ? $gastosSummary[$year]['Q1'] : 0);
          $netQ2 = (isset($ingresosSummary[$year]['Q2']) ? $ingresosSummary[$year]['Q2'] : 0) - (isset($gastosSummary[$year]['Q2']) ? $gastosSummary[$year]['Q2'] : 0);
          $netQ3 = (isset($ingresosSummary[$year]['Q3']) ? $ingresosSummary[$year]['Q3'] : 0) - (isset($gastosSummary[$year]['Q3']) ? $gastosSummary[$year]['Q3'] : 0);
          $netQ4 = (isset($ingresosSummary[$year]['Q4']) ? $ingresosSummary[$year]['Q4'] : 0) - (isset($gastosSummary[$year]['Q4']) ? $gastosSummary[$year]['Q4'] : 0);
          $totalAnual = $netQ1 + $netQ2 + $netQ3 + $netQ4;
      ?>
      <tr>
        <td><?php echo $year; ?></td>
        <td><?php echo number_format($netQ1, 2, ',', '.'); ?>€</td>
        <td><?php echo number_format($netQ2, 2, ',', '.'); ?>€</td>
        <td><?php echo number_format($netQ3, 2, ',', '.'); ?>€</td>
        <td><?php echo number_format($netQ4, 2, ',', '.'); ?>€</td>
        <td><?php echo number_format($totalAnual, 2, ',', '.'); ?>€</td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <!-- Tabla Detallada (Fusion de Ingresos y Gastos) -->
  <h2>Libro Mayor – Detalle</h2>
  <?php
  $ingresosStmt = $db->prepare("SELECT fecha, invoice_number AS descripcion, total AS monto, 'Ingreso' AS tipo 
                                FROM facturas 
                                WHERE user_id = ? ORDER BY fecha");
  $ingresosStmt->execute([$userId]);
  $ingresos = $ingresosStmt->fetchAll(PDO::FETCH_ASSOC);

  $gastosStmt = $db->prepare("SELECT fecha_emision AS fecha, numero_factura AS descripcion, total_factura AS monto, 'Gasto' AS tipo 
                              FROM gastos 
                              WHERE user_id = ? ORDER BY fecha_emision");
  $gastosStmt->execute([$userId]);
  $gastos = $gastosStmt->fetchAll(PDO::FETCH_ASSOC);

  $items = array_merge($ingresos, $gastos);
  usort($items, function($a, $b) {
      return strtotime($a['fecha']) - strtotime($b['fecha']);
  });

  $currentYear = null;
  $currentQuarter = null;
  $yearTotal = 0;
  $quarterTotal = 0;
  ?>
  <table>
    <thead>
      <tr>
        <th>Fecha</th>
        <th>Tipo</th>
        <th>Descripción</th>
        <th>Monto</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($items as $item):
              $timestamp = strtotime($item['fecha']);
              $year = date("Y", $timestamp);
              $month = date("n", $timestamp);
              if ($month >= 1 && $month <= 3) {
                $quarter = "Q1 (Ene-Mar)";
              } elseif ($month >= 4 && $month <= 6) {
                $quarter = "Q2 (Abr-Jun)";
              } elseif ($month >= 7 && $month <= 9) {
                $quarter = "Q3 (Jul-Sep)";
              } else {
                $quarter = "Q4 (Oct-Dic)";
              }
              if ($currentYear === null || $year != $currentYear) {
                  if ($currentYear !== null) {
                      echo "<tr style='background:#e0e0e0; font-weight:bold;'><td colspan='3'>Subtotal de $currentQuarter</td><td>" . number_format($quarterTotal, 2, ',', '.') . "€</td></tr>";
                      echo "<tr style='background:#e0e0e0; font-weight:bold;'><td colspan='3'>Total del Año $currentYear</td><td>" . number_format($yearTotal, 2, ',', '.') . "€</td></tr>";
                  }
                  echo "<tr style='background:#f0f0f0; font-weight:bold;'><td colspan='4'>Año: $year</td></tr>";
                  $currentYear = $year;
                  $yearTotal = 0;
                  $currentQuarter = null;
                  $quarterTotal = 0;
              }
              if ($currentQuarter === null || $quarter != $currentQuarter) {
                  if ($currentQuarter !== null) {
                      echo "<tr style='background:#e0e0e0; font-weight:bold;'><td colspan='3'>Subtotal de $currentQuarter</td><td>" . number_format($quarterTotal, 2, ',', '.') . "€</td></tr>";
                  }
                  echo "<tr style='background:#f0f0f0; font-weight:bold;'><td colspan='4'>$quarter</td></tr>";
                  $currentQuarter = $quarter;
                  $quarterTotal = 0;
              }
              echo "<tr>";
              echo "<td>" . htmlspecialchars($item['fecha']) . "</td>";
              echo "<td>" . htmlspecialchars($item['tipo']) . "</td>";
              echo "<td>" . htmlspecialchars($item['descripcion']) . "</td>";
              echo "<td style='text-align: right;'>" . number_format($item['monto'], 2, ',', '.') . "€</td>";
              echo "</tr>";
              $quarterTotal += $item['monto'];
              $yearTotal += $item['monto'];
           endforeach;
           if ($currentYear !== null) {
              echo "<tr style='background:#e0e0e0; font-weight:bold;'><td colspan='3'>Subtotal de $currentQuarter</td><td>" . number_format($quarterTotal, 2, ',', '.') . "€</td></tr>";
              echo "<tr style='background:#e0e0e0; font-weight:bold;'><td colspan='3'>Total del Año $currentYear</td><td>" . number_format($yearTotal, 2, ',', '.') . "€</td></tr>";
           }
      ?>
    </tbody>
  </table>
</body>
</html>


```
**invoice_template.php**
```php
<?php
// invoice_template.php
// This file renders the complete invoice view.
// It assumes that $misDatos, $factura, $lineas, and $subtotal are already defined.

// Use IVA percentage from the epigrafe if available; otherwise, default to 21%
if (isset($factura['epigrafe_iva']) && $factura['epigrafe_iva'] !== null) {
    $iva_percentage = $factura['epigrafe_iva'] / 100;
} else {
    $iva_percentage = 0.21;
}
$iva = $subtotal * $iva_percentage;

// Determine the retención percentage (default to 15% if not selected)
$retencion_percentage = 0.15;
$retencion_name = "IRPF";
if (isset($factura['retencion_id'])) {
    $stmt = $db->prepare("SELECT percentage, name FROM retenciones WHERE id = ? AND user_id = ?");
    $stmt->execute([$factura['retencion_id'], $_SESSION['usuario']['id']]);
    $retData = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($retData) {
        $retencion_percentage = $retData['percentage'] / 100;
        $retencion_name = $retData['name'];
    }
}
$retencion = $subtotal * $retencion_percentage;
$total_final = $subtotal + $iva - $retencion;
?>
<div class="invoice-preview" id="factura">
    <div class="header" style="background: black; color:white; padding:20px; text-align:center;">
        <h1><?php echo htmlspecialchars($misDatos['invoice_title']); ?></h1>
        <h2><?php echo htmlspecialchars($misDatos['invoice_subtitle']); ?></h2>
    </div>
     <div class="invoice-number" style="display:flex; justify-content:space-between; padding:10px;">
        <div><strong>FACTURA NÚMERO:</strong> <?php echo htmlspecialchars($factura['invoice_number']); ?></div>
        <div><strong>FECHA:</strong> <?php echo htmlspecialchars($factura['fecha']); ?></div>
    </div>
    <div class="invoice-details" style="display:flex; justify-content:space-between; padding:10px;">
        <div class="sender-details">
            <h3>Emisor</h3>
            <p>
                <?php echo htmlspecialchars($misDatos['my_name']); ?><br>
                <?php echo htmlspecialchars($misDatos['address']); ?><br>
                <?php echo htmlspecialchars($misDatos['postal_code']); ?>, <?php echo htmlspecialchars($misDatos['city']); ?><br>
                <?php echo htmlspecialchars($misDatos['id_number']); ?>
            </p>
        </div>
        <div class="recipient-details">
            <h3>Cliente</h3>
            <p>
                <?php echo htmlspecialchars($factura['cliente_nombre']); ?><br>
                <?php echo htmlspecialchars($factura['cliente_address']); ?><br>
                <?php echo htmlspecialchars($factura['cliente_postal']); ?>, <?php echo htmlspecialchars($factura['cliente_city']); ?><br>
                <?php echo htmlspecialchars($factura['cliente_id_number']); ?>
            </p>
        </div>
    </div>
   
     <?php
    $stmtObsDisplay = $db->prepare("SELECT observaciones FROM observaciones_factura WHERE factura_id = ?");
    $stmtObsDisplay->execute([$factura['id']]);
    $observacionesDisplay = $stmtObsDisplay->fetchColumn();
    if($observacionesDisplay) {
        echo "<div class='observaciones'><h3>Observaciones:</h3><p>" . nl2br(htmlspecialchars($observacionesDisplay)) . "</p></div>";
    }
    ?>
    <table class="invoice-table" style="width:100%; border-collapse:collapse; margin:10px 0;">
        <thead>
            <tr>
                <th>UNIDADES</th>
                <th>DESCRIPCIÓN</th>
                <th style="text-align:right;">PRECIO</th>
                <th style="text-align:right;">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lineas as $linea): 
                $stmtProd = $db->prepare("SELECT * FROM productos WHERE id=? AND user_id=?");
                $stmtProd->execute([$linea['producto_id'], $_SESSION['usuario']['id']]);
                $prod = $stmtProd->fetch(PDO::FETCH_ASSOC);
            ?>
            <tr>
                <td><?php echo htmlspecialchars($linea['cantidad']); ?></td>
                <td>
                    <strong><?php echo htmlspecialchars($prod['nombre']); ?></strong>
                    <p><?php echo nl2br(htmlspecialchars($prod['descripcion'])); ?></p>
                </td>
                <td style="text-align:right;"><?php echo number_format($linea['precio_unitario'], 2, ',', '.'); ?>€</td>
                <td style="text-align:right;"><?php echo number_format($linea['total'], 2, ',', '.'); ?>€</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- NEW: Display Observaciones if available -->
   
    <div class="total-section" style="text-align:right; padding:10px;">
        <div class="total-row">
            <div>TOTAL LÍNEAS:</div>
            <div><?php echo number_format($subtotal, 2, ',', '.'); ?>€</div>
        </div>
        <div class="total-row">
            <div>Total IVA (<?php echo htmlspecialchars($factura['epigrafe_iva'] ?? 21); ?>%):</div>
            <div><?php echo number_format($iva, 2, ',', '.'); ?>€</div>
        </div>
        <div class="total-row">
            <div><?php echo htmlspecialchars($retencion_name); ?> (<?php echo htmlspecialchars($retData['percentage'] ?? 15); ?>%):</div>
            <div><?php echo number_format($retencion, 2, ',', '.'); ?>€</div>
        </div>
        <div class="total-row final">
            <div>TOTAL:</div>
            <div><?php echo number_format($total_final, 2, ',', '.'); ?>€</div>
        </div>
    </div>
    <div class="bank-details" style="padding:10px;">
        <strong>CUENTA:</strong> <?php echo htmlspecialchars($misDatos['bank_account']); ?>
    </div>
    <div class="footer" style="font-size:10px; text-align:center; border-top:1px solid #ddd; padding:10px;">
        <?php echo htmlspecialchars($misDatos['invoice_footer']); ?>
    </div>
    <title>Factura <?php echo htmlspecialchars($misDatos['my_name']); ?> - <?php echo htmlspecialchars($factura['invoice_number']); ?> - <?php echo htmlspecialchars($factura['fecha']); ?> - <?php echo htmlspecialchars($factura['cliente_nombre']); ?></title>
</div>
<button onclick="window.print();" class="btn-submit" style="margin-top:20px;">Imprimir Factura</button>
<script>
    document.title = "<?php echo htmlspecialchars($misDatos['my_name']); ?> - <?php echo htmlspecialchars($factura['invoice_number']); ?> - <?php echo htmlspecialchars($factura['fecha']); ?> - <?php echo htmlspecialchars($factura['cliente_nombre']); ?>";
</script>


```
**misdatos.php**
```php
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $db->prepare("UPDATE mis_datos SET invoice_title=?, invoice_subtitle=?, my_name=?, address=?, postal_code=?, city=?, id_number=?, bank_account=?, invoice_footer=? WHERE user_id=?");
    $stmt->execute([
        $_POST['invoice_title'],
        $_POST['invoice_subtitle'],
        $_POST['my_name'],
        $_POST['address'],
        $_POST['postal_code'],
        $_POST['city'],
        $_POST['id_number'],
        $_POST['bank_account'],
        $_POST['invoice_footer'],
        $_SESSION['usuario']['id']
    ]);
    echo "<p class='success' title='Operación exitosa'>Datos actualizados correctamente.</p>";
}
$stmt = $db->prepare("SELECT * FROM mis_datos WHERE user_id=?");
$stmt->execute([$_SESSION['usuario']['id']]);
$misDatos = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<h2 title="Editar datos de la factura">Mis Datos</h2>
<p>Actualice la información que aparecerá en sus facturas.</p>
<form method="post" action="index.php?page=mis_datos" class="form-full">
                        <div class="form-row">
                            <div class="form-label">
                                <label title="Ingrese el título de la factura (ej: FACTURA)">Título de Factura:</label>
                            </div>
                            <div class="form-field">
                                <input type="text" name="invoice_title" value="<?php echo htmlspecialchars($misDatos['invoice_title']); ?>" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label">
                                <label title="Ingrese el subtítulo de la factura (ej: SERVICIO PROFESIONAL)">Subtítulo de Factura:</label>
                            </div>
                            <div class="form-field">
                                <input type="text" name="invoice_subtitle" value="<?php echo htmlspecialchars($misDatos['invoice_subtitle']); ?>" required>
                            </div>
                        </div>
                        <!-- Additional form rows follow the same two-column layout -->
                        <div class="form-row">
                            <div class="form-label">
                                <label title="Ingrese su nombre o razón social">Mi Nombre:</label>
                            </div>
                            <div class="form-field">
                                <input type="text" name="my_name" value="<?php echo htmlspecialchars($misDatos['my_name']); ?>" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label">
                                <label title="Ingrese la dirección completa">Dirección:</label>
                            </div>
                            <div class="form-field">
                                <input type="text" name="address" value="<?php echo htmlspecialchars($misDatos['address']); ?>" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label">
                                <label title="Ingrese el código postal">Código Postal:</label>
                            </div>
                            <div class="form-field">
                                <input type="text" name="postal_code" value="<?php echo htmlspecialchars($misDatos['postal_code']); ?>" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label">
                                <label title="Ingrese la ciudad">Ciudad:</label>
                            </div>
                            <div class="form-field">
                                <input type="text" name="city" value="<?php echo htmlspecialchars($misDatos['city']); ?>" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label">
                                <label title="Ingrese el número de identificación fiscal (NIF/CIF)">Nº Identificación:</label>
                            </div>
                            <div class="form-field">
                                <input type="text" name="id_number" value="<?php echo htmlspecialchars($misDatos['id_number']); ?>" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label">
                                <label title="Ingrese la cuenta bancaria completa">Cuenta Bancaria:</label>
                            </div>
                            <div class="form-field">
                                <input type="text" name="bank_account" value="<?php echo htmlspecialchars($misDatos['bank_account']); ?>" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label">
                                <label title="Ingrese el pie de factura (mensaje final)">Pie de Factura:</label>
                            </div>
                            <div class="form-field">
                                <textarea name="invoice_footer" required><?php echo htmlspecialchars($misDatos['invoice_footer']); ?></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-field" style="margin-left: auto;">
                                <button type="submit" class="btn-submit" title="Guardar datos de la factura">Guardar Datos</button>
                            </div>
                        </div>
                    </form>
                    <?php
?>

```
**presupuesto_template.php**
```php
<?php
// presupuesto_template.php
// This file renders the complete presupuesto view.
// It assumes that $misDatos, $presupuesto, $lineas, and $subtotal are already defined.

// Use IVA percentage from the epigrafe if available; otherwise, default to 21%
if (isset($presupuesto['epigrafe_iva']) && $presupuesto['epigrafe_iva'] !== null) {
    $iva_percentage = $presupuesto['epigrafe_iva'] / 100;
} else {
    $iva_percentage = 0.21;
}
$iva = $subtotal * $iva_percentage;

// Determine the retención percentage (default to 15% if not selected)
$retencion_percentage = 0.15;
$retencion_name = "IRPF";
if (isset($presupuesto['retencion_id'])) {
    $stmt = $db->prepare("SELECT percentage, name FROM retenciones WHERE id = ? AND user_id = ?");
    $stmt->execute([$presupuesto['retencion_id'], $_SESSION['usuario']['id']]);
    $retData = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($retData) {
        $retencion_percentage = $retData['percentage'] / 100;
        $retencion_name = $retData['name'];
    }
}
$retencion = $subtotal * $retencion_percentage;
$total_final = $subtotal + $iva - $retencion;
?>
<div class="invoice-preview" id="presupuesto">
    <div class="header" style="background: black; color:white; padding:20px; text-align:center;">
        <h1><?php echo htmlspecialchars($misDatos['invoice_title']); ?> (Presupuesto)</h1>
        <h2><?php echo htmlspecialchars($misDatos['invoice_subtitle']); ?></h2>
    </div>
     <div class="invoice-number" style="display:flex; justify-content:space-between; padding:10px;">
        <div><strong>PRESUPUESTO NÚMERO:</strong> <?php echo htmlspecialchars($presupuesto['presupuesto_number']); ?></div>
        <div><strong>FECHA:</strong> <?php echo htmlspecialchars($presupuesto['fecha']); ?></div>
    </div>
    <div class="invoice-details" style="display:flex; justify-content:space-between; padding:10px;">
        <div class="sender-details">
            <h3>Emisor</h3>
            <p>
                <?php echo htmlspecialchars($misDatos['my_name']); ?><br>
                <?php echo htmlspecialchars($misDatos['address']); ?><br>
                <?php echo htmlspecialchars($misDatos['postal_code']); ?>, <?php echo htmlspecialchars($misDatos['city']); ?><br>
                <?php echo htmlspecialchars($misDatos['id_number']); ?>
            </p>
        </div>
        <div class="recipient-details">
            <h3>Cliente</h3>
            <p>
                <?php echo htmlspecialchars($presupuesto['cliente_nombre']); ?><br>
                <?php echo htmlspecialchars($presupuesto['cliente_address']); ?><br>
                <?php echo htmlspecialchars($presupuesto['cliente_postal']); ?>, <?php echo htmlspecialchars($presupuesto['cliente_city']); ?><br>
                <?php echo htmlspecialchars($presupuesto['cliente_id_number']); ?>
            </p>
        </div>
    </div>
   
     <?php
    $stmtObsDisplay = $db->prepare("SELECT observaciones FROM observaciones_factura WHERE factura_id = ?");
    $stmtObsDisplay->execute([$presupuesto['id']]);
    $observacionesDisplay = $stmtObsDisplay->fetchColumn();
    if($observacionesDisplay) {
        echo "<div class='observaciones'><h3>Observaciones:</h3><p>" . nl2br(htmlspecialchars($observacionesDisplay)) . "</p></div>";
    }
    ?>
    <table class="invoice-table" style="width:100%; border-collapse:collapse; margin:10px 0;">
        <thead>
            <tr>
                <th>UNIDADES</th>
                <th>DESCRIPCIÓN</th>
                <th style="text-align:right;">PRECIO</th>
                <th style="text-align:right;">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lineas as $linea): 
                $stmtProd = $db->prepare("SELECT * FROM productos WHERE id=? AND user_id=?");
                $stmtProd->execute([$linea['producto_id'], $_SESSION['usuario']['id']]);
                $prod = $stmtProd->fetch(PDO::FETCH_ASSOC);
            ?>
            <tr>
                <td><?php echo htmlspecialchars($linea['cantidad']); ?></td>
                <td>
                    <strong><?php echo htmlspecialchars($prod['nombre']); ?></strong>
                    <p><?php echo nl2br(htmlspecialchars($prod['descripcion'])); ?></p>
                </td>
                <td style="text-align:right;"><?php echo number_format($linea['precio_unitario'], 2, ',', '.'); ?>€</td>
                <td style="text-align:right;"><?php echo number_format($linea['total'], 2, ',', '.'); ?>€</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="total-section" style="text-align:right; padding:10px;">
        <div class="total-row">
            <div>TOTAL LÍNEAS:</div>
            <div><?php echo number_format($subtotal, 2, ',', '.'); ?>€</div>
        </div>
        <div class="total-row">
            <div>Total IVA (<?php echo htmlspecialchars($presupuesto['epigrafe_iva'] ?? 21); ?>%):</div>
            <div><?php echo number_format($iva, 2, ',', '.'); ?>€</div>
        </div>
        <div class="total-row">
            <div><?php echo htmlspecialchars($retencion_name); ?> (<?php echo htmlspecialchars($retData['percentage'] ?? 15); ?>%):</div>
            <div><?php echo number_format($retencion, 2, ',', '.'); ?>€</div>
        </div>
        <div class="total-row final">
            <div>TOTAL:</div>
            <div><?php echo number_format($total_final, 2, ',', '.'); ?>€</div>
        </div>
    </div>
   
    <div class="footer" style="font-size:10px; text-align:center; border-top:1px solid #ddd; padding:10px;">
        <?php echo htmlspecialchars($misDatos['invoice_footer']); ?>
    </div>
    <title>Presupuesto <?php echo htmlspecialchars($misDatos['my_name']); ?> - <?php echo htmlspecialchars($presupuesto['presupuesto_number']); ?> - <?php echo htmlspecialchars($presupuesto['fecha']); ?> - <?php echo htmlspecialchars($presupuesto['cliente_nombre']); ?></title>
</div>
<button onclick="window.print();" class="btn-submit" style="margin-top:20px;">Imprimir Presupuesto</button>
<script>
    document.title = "<?php echo htmlspecialchars($misDatos['my_name']); ?> - <?php echo htmlspecialchars($presupuesto['presupuesto_number']); ?> - <?php echo htmlspecialchars($presupuesto['fecha']); ?> - <?php echo htmlspecialchars($presupuesto['cliente_nombre']); ?>";
</script>


```
**presupuestos.php**
```php
<?php
// presupuestos.php

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Presupuestos</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2 title="Listado de presupuestos">Presupuestos</h2>
<p>Esta área le permite crear, visualizar, editar, imprimir y eliminar presupuestos.</p>
<a href="index.php?page=presupuesto_crear" class="btn-submit" title="Crear nuevo presupuesto" style="margin-bottom:20px; display:inline-block;">Crear Presupuesto</a>

<form method="GET" action="index.php">
  <input type="hidden" name="page" value="presupuestos">
  <table title="Tabla de presupuestos">
    <thead>
      <!-- Search/filter row -->
      <tr>
       <th></th>
       <th></th>
        <th>
          <input type="text" name="presupuesto_number" placeholder="Buscar presupuesto" value="<?php echo isset($_GET['presupuesto_number']) ? htmlspecialchars($_GET['presupuesto_number']) : ''; ?>">
        </th>
        <th>
          <input type="date" name="fecha" value="<?php echo isset($_GET['fecha']) ? htmlspecialchars($_GET['fecha']) : ''; ?>">
        </th>
        <th>
          <select name="cliente_id">
            <option value="">Todos</option>
            <?php
              require_once 'config.php';
              try {
                  $db = new PDO($config['db_url']);
                  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              } catch(Exception $ex) {
                  die("Error al conectar con la base de datos");
              }
              $clientes = $db->query("SELECT * FROM clientes WHERE user_id = " . $_SESSION['usuario']['id'])->fetchAll(PDO::FETCH_ASSOC);
              foreach ($clientes as $cliente) {
                $selected = (isset($_GET['cliente_id']) && $_GET['cliente_id'] == $cliente['id']) ? "selected" : "";
                echo "<option value='{$cliente['id']}' $selected>" . htmlspecialchars($cliente['name']) . "</option>";
              }
            ?>
          </select>
        </th>
        <th>
          <input type="text" name="total" placeholder="Total" value="<?php echo isset($_GET['total']) ? htmlspecialchars($_GET['total']) : ''; ?>">
        </th>
        <th>
          <button type="submit">Buscar</button>
        </th>
      </tr>
      <!-- Table header -->
      <tr>
        <th>No.</th>
        <th>ID</th>
        <th>Nº Presupuesto</th>
        <th>Fecha</th>
        <th>Cliente</th>
        <th>Total (€)</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
    <?php
      $query = "SELECT p.*, c.name as cliente_nombre FROM presupuestos p
                LEFT JOIN clientes c ON p.cliente_id = c.id
                WHERE p.user_id = ?";
      $params = [$_SESSION['usuario']['id']];
      if (isset($_GET['presupuesto_number']) && $_GET['presupuesto_number'] !== "") {
          $query .= " AND p.presupuesto_number LIKE ?";
          $params[] = "%" . $_GET['presupuesto_number'] . "%";
      }
      if (isset($_GET['fecha']) && $_GET['fecha'] !== "") {
          $query .= " AND p.fecha = ?";
          $params[] = $_GET['fecha'];
      }
      if (isset($_GET['cliente_id']) && $_GET['cliente_id'] !== "") {
          $query .= " AND p.cliente_id = ?";
          $params[] = $_GET['cliente_id'];
      }
      if (isset($_GET['total']) && $_GET['total'] !== "") {
          $query .= " AND p.total = ?";
          $params[] = $_GET['total'];
      }
      $stmt = $db->prepare($query);
      $stmt->execute($params);
      $i = 1;
      $totalRows = 0;
      $sumTotal = 0;
      while ($presupuesto = $stmt->fetch(PDO::FETCH_ASSOC)) :
          $totalRows++;
          $sumTotal += (float)$presupuesto['total'];
    ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo htmlspecialchars($presupuesto['id']); ?></td>
        <td><?php echo htmlspecialchars($presupuesto['presupuesto_number']); ?></td>
        <td><?php echo htmlspecialchars($presupuesto['fecha']); ?></td>
        <td><?php echo htmlspecialchars($presupuesto['cliente_nombre']); ?></td>
        <td><?php echo number_format($presupuesto['total'], 2, ',', '.') . "€"; ?></td>
        <td>
          <a href='index.php?page=presupuesto_ver&id=<?php echo $presupuesto['id']; ?>' title='Ver presupuesto'>Ver</a> |
          <a href='index.php?page=presupuesto_editar&id=<?php echo $presupuesto['id']; ?>' title='Editar presupuesto'>Editar</a> |
          <a href='index.php?page=presupuesto_imprimir&id=<?php echo $presupuesto['id']; ?>' title='Imprimir presupuesto'>Imprimir</a> |
          <a href='index.php?page=presupuestos&accion=eliminar&id=<?php echo $presupuesto['id']; ?>' onclick='return confirm("¿Está seguro?")' title='Eliminar presupuesto'>Eliminar</a>
        </td>
      </tr>
    <?php $i++; endwhile; ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="5">Total de filas: <?php echo $totalRows; ?></td>
        <td><?php echo number_format($sumTotal, 2, ',', '.') . "€"; ?></td>
        <td></td>
      </tr>
    </tfoot>
  </table>
</form>
<?php
if (isset($_GET['accion']) && $_GET['accion'] == 'eliminar' && isset($_GET['id'])) {
    $stmt = $db->prepare("DELETE FROM presupuestos WHERE id=? AND user_id=?");
    $stmt->execute([$_GET['id'], $_SESSION['usuario']['id']]);
    echo "<p class='success' title='Presupuesto eliminado'>Presupuesto eliminado.</p>";
}
?>
</body>
</html>


```
**productos.php**
```php
<?php
// paginas/productos.php

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Productos</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2 title="Listado de productos">Productos</h2>
<p>En "Productos" se gestionan los artículos o servicios que ofrece. Aquí puede definir o modificar el nombre, descripción y precio de cada producto.</p>
<a href="index.php?page=producto_crear" class="btn-submit" title="Crear nuevo producto" style="margin-bottom:20px; display:inline-block;">Crear Producto</a>

<form method="GET" action="index.php">
  <input type="hidden" name="page" value="productos">
  <table title="Tabla de productos">
    <thead>
      <!-- Search Filter Row -->
      <tr>
      <th></th>
      <th></th>
        <th>
          <input type="text" name="nombre" placeholder="Buscar nombre" value="<?php echo isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : ''; ?>">
        </th>
        <th>
          <input type="text" name="descripcion" placeholder="Buscar descripción" value="<?php echo isset($_GET['descripcion']) ? htmlspecialchars($_GET['descripcion']) : ''; ?>">
        </th>
        <th>
          <input type="text" name="price" placeholder="Buscar precio" value="<?php echo isset($_GET['price']) ? htmlspecialchars($_GET['price']) : ''; ?>">
        </th>
        <th>
          <button type="submit">Buscar</button>
        </th>
      </tr>
      <!-- Table header with extra columns -->
      <tr>
        <th>No.</th>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio (€)</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      require_once 'config.php';
      try {
          $db = new PDO($config['db_url']);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(Exception $ex) {
          die("Error al conectar con la base de datos");
      }
      $query = "SELECT * FROM productos WHERE user_id = ?";
      $params = [$_SESSION['usuario']['id']];
      if (isset($_GET['nombre']) && $_GET['nombre'] !== "") {
          $query .= " AND nombre LIKE ?";
          $params[] = "%" . $_GET['nombre'] . "%";
      }
      if (isset($_GET['descripcion']) && $_GET['descripcion'] !== "") {
          $query .= " AND descripcion LIKE ?";
          $params[] = "%" . $_GET['descripcion'] . "%";
      }
      if (isset($_GET['price']) && $_GET['price'] !== "") {
          $query .= " AND price = ?";
          $params[] = $_GET['price'];
      }
      $stmt = $db->prepare($query);
      $stmt->execute($params);
      $i = 1;
      $sumPrice = 0;
      $totalRows = 0;
      while ($producto = $stmt->fetch(PDO::FETCH_ASSOC)) :
          $totalRows++;
          $sumPrice += (float)$producto['price'];
      ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo htmlspecialchars($producto['id']); ?></td>
        <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
        <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
        <td><?php echo number_format($producto['price'], 2, ',', '.') . "€"; ?></td>
        <td>
          <a href="index.php?page=producto_ver&id=<?php echo $producto['id']; ?>" title="Ver producto">Ver</a> |
          <a href="index.php?page=producto_editar&id=<?php echo $producto['id']; ?>" title="Editar producto">Editar</a> |
          <a href="index.php?page=productos&accion=eliminar&id=<?php echo $producto['id']; ?>" onclick="return confirm('¿Está seguro?')" title="Eliminar producto">Eliminar</a>
        </td>
      </tr>
      <?php $i++; endwhile; ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="4">Total de filas: <?php echo $totalRows; ?></td>
        <td><?php echo number_format($sumPrice, 2, ',', '.') . "€"; ?></td>
        <td></td>
      </tr>
    </tfoot>
  </table>
</form>
<a href="export_ods.php?table=productos&<?php echo http_build_query($_GET); ?>">Exportar a ODS</a>
<?php
if (isset($_GET['accion']) && $_GET['accion'] == 'eliminar' && isset($_GET['id'])) {
    $stmt = $db->prepare("DELETE FROM productos WHERE id=? AND user_id=?");
    $stmt->execute([$_GET['id'], $_SESSION['usuario']['id']]);
    echo "<p class='success' title='Producto eliminado'>Producto eliminado.</p>";
}
?>
</body>
</html>


```
**proveedores.php**
```php
<?php
// paginas/proveedores.php

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Proveedores</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2 title="Listado de proveedores">Proveedores</h2>
<p>Gestione los proveedores. Puede crear, editar o eliminar registros.</p>
<a href="index.php?page=crearproveedor" class="btn-submit" title="Crear nuevo proveedor" style="margin-bottom:20px; display:inline-block;">Crear Proveedor</a>

<form method="GET" action="index.php">
  <input type="hidden" name="page" value="proveedores">
  <table title="Tabla de proveedores">
    <thead>
      <!-- Search Filter Row -->
      <tr>
       <th></th>
      <th></th>
        <th>
          <input type="text" name="razon_social" placeholder="Buscar razón social" value="<?php echo isset($_GET['razon_social']) ? htmlspecialchars($_GET['razon_social']) : ''; ?>">
        </th>
        <th>
          <input type="text" name="direccion" placeholder="Buscar dirección" value="<?php echo isset($_GET['direccion']) ? htmlspecialchars($_GET['direccion']) : ''; ?>">
        </th>
        <th>
          <input type="text" name="codigo_postal" placeholder="Buscar código postal" value="<?php echo isset($_GET['codigo_postal']) ? htmlspecialchars($_GET['codigo_postal']) : ''; ?>">
        </th>
        <th>
          <input type="text" name="poblacion" placeholder="Buscar población" value="<?php echo isset($_GET['poblacion']) ? htmlspecialchars($_GET['poblacion']) : ''; ?>">
        </th>
        <th>
          <input type="text" name="identificacion_fiscal" placeholder="Buscar identificación" value="<?php echo isset($_GET['identificacion_fiscal']) ? htmlspecialchars($_GET['identificacion_fiscal']) : ''; ?>">
        </th>
        <th>
          <input type="text" name="contacto_nombre" placeholder="Buscar contacto" value="<?php echo isset($_GET['contacto_nombre']) ? htmlspecialchars($_GET['contacto_nombre']) : ''; ?>">
        </th>
        <th>
          <input type="text" name="contacto_email" placeholder="Buscar email" value="<?php echo isset($_GET['contacto_email']) ? htmlspecialchars($_GET['contacto_email']) : ''; ?>">
        </th>
        <th>
          <input type="text" name="contacto_telefono" placeholder="Buscar teléfono" value="<?php echo isset($_GET['contacto_telefono']) ? htmlspecialchars($_GET['contacto_telefono']) : ''; ?>">
        </th>
        <th>
          <button type="submit">Buscar</button>
        </th>
      </tr>
      <!-- Table header with extra columns -->
      <tr>
        <th>No.</th>
        <th>ID</th>
        <th>Razón Social</th>
        <th>Dirección</th>
        <th>Código Postal</th>
        <th>Población</th>
        <th>Identificación Fiscal</th>
        <th>Contacto</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      require_once 'config.php';
      try {
          $db = new PDO($config['db_url']);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(Exception $ex) {
          die("Error al conectar con la base de datos");
      }
      $query = "SELECT * FROM proveedores WHERE user_id = ?";
      $params = [$_SESSION['usuario']['id']];
      if (isset($_GET['razon_social']) && $_GET['razon_social'] !== "") {
          $query .= " AND razon_social LIKE ?";
          $params[] = "%" . $_GET['razon_social'] . "%";
      }
      if (isset($_GET['direccion']) && $_GET['direccion'] !== "") {
          $query .= " AND direccion LIKE ?";
          $params[] = "%" . $_GET['direccion'] . "%";
      }
      if (isset($_GET['codigo_postal']) && $_GET['codigo_postal'] !== "") {
          $query .= " AND codigo_postal LIKE ?";
          $params[] = "%" . $_GET['codigo_postal'] . "%";
      }
      if (isset($_GET['poblacion']) && $_GET['poblacion'] !== "") {
          $query .= " AND poblacion LIKE ?";
          $params[] = "%" . $_GET['poblacion'] . "%";
      }
      if (isset($_GET['identificacion_fiscal']) && $_GET['identificacion_fiscal'] !== "") {
          $query .= " AND identificacion_fiscal LIKE ?";
          $params[] = "%" . $_GET['identificacion_fiscal'] . "%";
      }
      if (isset($_GET['contacto_nombre']) && $_GET['contacto_nombre'] !== "") {
          $query .= " AND contacto_nombre LIKE ?";
          $params[] = "%" . $_GET['contacto_nombre'] . "%";
      }
      if (isset($_GET['contacto_email']) && $_GET['contacto_email'] !== "") {
          $query .= " AND contacto_email LIKE ?";
          $params[] = "%" . $_GET['contacto_email'] . "%";
      }
      if (isset($_GET['contacto_telefono']) && $_GET['contacto_telefono'] !== "") {
          $query .= " AND contacto_telefono LIKE ?";
          $params[] = "%" . $_GET['contacto_telefono'] . "%";
      }
      $stmt = $db->prepare($query);
      $stmt->execute($params);
      $i = 1;
      $totalRows = 0;
      while ($prov = $stmt->fetch(PDO::FETCH_ASSOC)) :
          $totalRows++;
      ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo htmlspecialchars($prov['id']); ?></td>
        <td><?php echo htmlspecialchars($prov['razon_social']); ?></td>
        <td><?php echo htmlspecialchars($prov['direccion']); ?></td>
        <td><?php echo htmlspecialchars($prov['codigo_postal']); ?></td>
        <td><?php echo htmlspecialchars($prov['poblacion']); ?></td>
        <td><?php echo htmlspecialchars($prov['identificacion_fiscal']); ?></td>
        <td><?php echo htmlspecialchars($prov['contacto_nombre']); ?></td>
        <td><?php echo htmlspecialchars($prov['contacto_email']); ?></td>
        <td><?php echo htmlspecialchars($prov['contacto_telefono']); ?></td>
        <td>
          <a href="index.php?page=editarproveedor&id=<?php echo $prov['id']; ?>" title="Editar proveedor">Editar</a> |
          <a href="index.php?page=proveedores&accion=eliminar&id=<?php echo $prov['id']; ?>" onclick="return confirm('¿Está seguro?')" title="Eliminar proveedor">Eliminar</a>
        </td>
      </tr>
      <?php $i++; endwhile; ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="10">Total de filas: <?php echo $totalRows; ?></td>
        <td></td>
      </tr>
    </tfoot>
  </table>
</form>
<a href="export_ods.php?table=proveedores&<?php echo http_build_query($_GET); ?>">Exportar a ODS</a>
<?php
if (isset($_GET['accion']) && $_GET['accion'] == 'eliminar' && isset($_GET['id'])) {
    $stmt = $db->prepare("DELETE FROM proveedores WHERE id=? AND user_id=?");
    $stmt->execute([$_GET['id'], $_SESSION['usuario']['id']]);
    echo "<p class='success' title='Proveedor eliminado'>Proveedor eliminado.</p>";
}
?>
</body>
</html>


```
**retenciones.php**
```php
<?php
// paginas/retenciones.php

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
echo "<h2 title='Listado de retenciones'>Retenciones</h2>";
echo "<p>Introduzca el nombre y el porcentaje de retención (IRPF) que se aplicará a sus facturas.</p>";
echo "<a href='index.php?page=retenciones_crear' class='btn-submit' title='Crear nueva retención' style='margin-bottom:20px; display:inline-block;'>Crear Retención</a>";

echo "<form method='GET' action='index.php'>";
echo "<input type='hidden' name='page' value='retenciones'>";
echo "<table title='Tabla de retenciones'>
        <thead>
          <tr>
            <th>No.</th>
            <th>ID</th>
            <th>Nombre</th>
            <th>Porcentaje (%)</th>
            <th>Acciones</th>
          </tr>
          <tr>
            <th></th>
            <th></th>
            <th><input type='text' name='name' placeholder='Buscar nombre' value='" . (isset($_GET['name']) ? htmlspecialchars($_GET['name']) : "") . "'></th>
            <th><input type='text' name='percentage' placeholder='Buscar porcentaje' value='" . (isset($_GET['percentage']) ? htmlspecialchars($_GET['percentage']) : "") . "'></th>
            <th><button type='submit'>Buscar</button></th>
          </tr>
        </thead>
        <tbody>";
$query = "SELECT * FROM retenciones WHERE user_id = ?";
$params = [$_SESSION['usuario']['id']];
if (isset($_GET['name']) && $_GET['name'] !== "") {
    $query .= " AND name LIKE ?";
    $params[] = "%" . $_GET['name'] . "%";
}
if (isset($_GET['percentage']) && $_GET['percentage'] !== "") {
    $query .= " AND percentage = ?";
    $params[] = $_GET['percentage'];
}
require_once 'config.php';
try {
    $db = new PDO($config['db_url']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $ex) {
    die("Error al conectar con la base de datos");
}
$stmt = $db->prepare($query);
$stmt->execute($params);
$i = 1;
$totalRows = 0;
while ($ret = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $totalRows++;
    echo "<tr>";
    echo "<td>" . $i . "</td>";
    echo "<td>" . htmlspecialchars($ret['id']) . "</td>";
    echo "<td>" . htmlspecialchars($ret['name']) . "</td>";
    echo "<td>" . htmlspecialchars($ret['percentage']) . "</td>";
    echo "<td>";
    echo "<a href='index.php?page=retenciones_editar&id=" . $ret['id'] . "' title='Editar retención'>Editar</a> | ";
    echo "<a href='index.php?page=retenciones&accion=eliminar&id=" . $ret['id'] . "' onclick='return confirm(\"¿Está seguro?\")' title='Eliminar retención'>Eliminar</a>";
    echo "</td>";
    echo "</tr>";
    $i++;
}
echo "</tbody>";
echo "<tfoot>
      <tr>
        <td colspan='4'>Total de filas: " . $totalRows . "</td>
        <td></td>
      </tr>
      </tfoot>";
echo "</table>";
echo "</form>";

echo "<a href='export_ods.php?table=retenciones&" . http_build_query($_GET) . "'>Exportar a ODS</a>";

if (isset($_GET['accion']) && $_GET['accion'] == 'eliminar' && isset($_GET['id'])) {
    $stmt = $db->prepare("DELETE FROM retenciones WHERE id=? AND user_id=?");
    $stmt->execute([$_GET['id'], $_SESSION['usuario']['id']]);
    echo "<p class='success' title='Retención eliminada'>Retención eliminada.</p>";
}
?>


```
**retenciones_crear.php**
```php
<?php
// retenciones_crear.php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
    $stmt = $db->prepare("INSERT INTO retenciones (name, percentage, user_id) VALUES (?,?,?)");
    $stmt->execute([
        $_POST['name'],
        $_POST['percentage'],
        $_SESSION['usuario']['id']
    ]);
    echo "<script>window.location.href='index.php?page=retenciones';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Retención</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2 title="Crear nueva retención">Crear Retención</h2>
    <form method="post" action="index.php?page=retenciones_crear" class="form-full">
        <div class="form-row">
            <div class="form-label"><label>Nombre de Retención:</label></div>
            <div class="form-field"><input type="text" name="name" required></div>
        </div>
        <div class="form-row">
            <div class="form-label"><label>Porcentaje (%):</label></div>
            <div class="form-field"><input type="number" step="0.01" name="percentage" min="0" max="100" required></div>
        </div>
        <div class="form-row">
            <div class="form-field" style="margin-left: auto;">
                <button type="submit" class="btn-submit" title="Crear retención">Crear Retención</button>
            </div>
        </div>
    </form>
</body>
</html>


```
**retenciones_editar.php**
```php
<?php
// retenciones_editar.php
if (!isset($_GET['id'])) {
    echo "ID de retención no proporcionado.";
    exit;
}
$ret_id = intval($_GET['id']);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
    $stmt = $db->prepare("UPDATE retenciones SET name=?, percentage=? WHERE id=? AND user_id=?");
    $stmt->execute([
        $_POST['name'],
        $_POST['percentage'],
        $ret_id,
        $_SESSION['usuario']['id']
    ]);
    echo "<script>window.location.href='index.php?page=retenciones';</script>";
    exit;
}
$stmt = $db->prepare("SELECT * FROM retenciones WHERE id=? AND user_id=?");
$stmt->execute([$ret_id, $_SESSION['usuario']['id']]);
$ret = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Retención</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2 title="Editar retención">Editar Retención</h2>
    <form method="post" action="index.php?page=retenciones_editar&id=<?php echo $ret_id; ?>" class="form-full">
        <div class="form-row">
            <div class="form-label">
                <label>Nombre de Retención:</label>
            </div>
            <div class="form-field">
                <input type="text" name="name" value="<?php echo htmlspecialchars($ret['name']); ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">
                <label>Porcentaje (%):</label>
            </div>
            <div class="form-field">
                <input type="number" step="0.01" name="percentage" value="<?php echo htmlspecialchars($ret['percentage']); ?>" min="0" max="100" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-field" style="margin-left: auto;">
                <button type="submit" class="btn-submit" title="Actualizar retención">Actualizar Retención</button>
            </div>
        </div>
    </form>
</body>
</html>


```
**usuarios.php**
```php
<?php
// paginas/usuarios.php

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Usuarios</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2 title="Listado de usuarios">Usuarios</h2>
<p>La sección "Usuarios" le permite gestionar el acceso al sistema. Puede crear nuevos usuarios, así como editar o eliminar aquellos que ya no requiera. Asegúrese de que sólo el personal autorizado tenga acceso al panel de administración.</p>
<a href="index.php?page=usuario_crear" class="btn-submit" title="Crear nuevo usuario" style="margin-bottom:20px; display:inline-block;">Crear Usuario</a>

<form method="GET" action="index.php">
  <input type="hidden" name="page" value="usuarios">
  <table title="Tabla de usuarios">
    <thead>
      <!-- Search Filter Row -->
      <tr>
       <th></th>
      <th></th>
        <th>
          <input type="text" name="usuario" placeholder="Buscar usuario" value="<?php echo isset($_GET['usuario']) ? htmlspecialchars($_GET['usuario']) : ''; ?>">
        </th>
        <th>
          <input type="text" name="email" placeholder="Buscar email" value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>">
        </th>
        <th>
          <input type="text" name="nombre" placeholder="Buscar nombre" value="<?php echo isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : ''; ?>">
        </th>
        <th>
          <button type="submit">Buscar</button>
        </th>
      </tr>
      <!-- Table header with extra columns -->
      <tr>
        <th>No.</th>
        <th>ID</th>
        <th>Usuario</th>
        <th>Email</th>
        <th>Nombre</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      require_once 'config.php';
      try {
          $db = new PDO($config['db_url']);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(Exception $ex) {
          die("Error al conectar con la base de datos");
      }
      $query = "SELECT * FROM usuarios WHERE 1";
      $params = [];
      if (isset($_GET['usuario']) && $_GET['usuario'] !== "") {
          $query .= " AND usuario LIKE ?";
          $params[] = "%" . $_GET['usuario'] . "%";
      }
      if (isset($_GET['email']) && $_GET['email'] !== "") {
          $query .= " AND email LIKE ?";
          $params[] = "%" . $_GET['email'] . "%";
      }
      if (isset($_GET['nombre']) && $_GET['nombre'] !== "") {
          $query .= " AND nombre LIKE ?";
          $params[] = "%" . $_GET['nombre'] . "%";
      }
      $stmt = $db->prepare($query);
      $stmt->execute($params);
      $i = 1;
      $totalRows = 0;
      while ($usuario = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $totalRows++;
      ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo htmlspecialchars($usuario['id']); ?></td>
        <td><?php echo htmlspecialchars($usuario['usuario']); ?></td>
        <td><?php echo htmlspecialchars($usuario['email']); ?></td>
        <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
        <td>
          <a href='index.php?page=usuario_editar&id=<?php echo $usuario['id']; ?>' title='Editar usuario'>Editar</a> |
          <a href='index.php?page=usuarios&accion=eliminar&id=<?php echo $usuario['id']; ?>' onclick='return confirm("¿Está seguro?")' title='Eliminar usuario'>Eliminar</a>
        </td>
      </tr>
      <?php $i++; } ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="5">Total de filas: <?php echo $totalRows; ?></td>
        <td></td>
      </tr>
    </tfoot>
  </table>
</form>
<a href="export_ods.php?table=usuarios&<?php echo http_build_query($_GET); ?>">Exportar a ODS</a>
<?php
if (isset($_GET['accion']) && $_GET['accion'] == 'eliminar' && isset($_GET['id'])) {
    $stmt = $db->prepare("DELETE FROM usuarios WHERE id=?");
    $stmt->execute([$_GET['id']]);
    echo "<p class='success' title='Usuario eliminado'>Usuario eliminado.</p>";
}
?>
</body>
</html>


```
**verfactura.php**
```php
<?php
if (!isset($_GET['id'])) {
    echo "ID de factura no proporcionado.";
    exit;
}
$factura_id = intval($_GET['id']);
$stmt = $db->prepare("SELECT f.*, 
                           c.name as cliente_nombre, 
                           c.address as cliente_address, 
                           c.postal_code as cliente_postal, 
                           c.city as cliente_city, 
                           c.id_number as cliente_id_number,
                           e.iva_percentage as epigrafe_iva,
                           e.name as epigrafe_name
                      FROM facturas f 
                      LEFT JOIN clientes c ON f.cliente_id = c.id 
                      LEFT JOIN epigrafes e ON f.epigrafe_id = e.id
                      WHERE f.id=? AND f.user_id=?");
$stmt->execute([$factura_id, $_SESSION['usuario']['id']]);
$factura = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $db->prepare("SELECT * FROM lineas_factura WHERE factura_id=?");
$stmt->execute([$factura_id]);
$lineas = $stmt->fetchAll(PDO::FETCH_ASSOC);

$misDatosStmt = $db->prepare("SELECT * FROM mis_datos WHERE user_id=?");
$misDatosStmt->execute([$_SESSION['usuario']['id']]);
$misDatos = $misDatosStmt->fetch(PDO::FETCH_ASSOC);

// Use the invoice total as the subtotal; further calculations occur in invoice_template.php
$subtotal = $factura['total'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Factura</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Ver Factura</h2>
    <?php include 'invoice_template.php'; ?>
</body>
</html>


```
**verpresupuesto.php**
```php
<?php
if (!isset($_GET['id'])) {
    echo "ID de presupuesto no proporcionado.";
    exit;
}
$presupuesto_id = intval($_GET['id']);
$stmt = $db->prepare("SELECT p.*, 
                           c.name as cliente_nombre, 
                           c.address as cliente_address, 
                           c.postal_code as cliente_postal, 
                           c.city as cliente_city, 
                           c.id_number as cliente_id_number,
                           e.iva_percentage as epigrafe_iva,
                           e.name as epigrafe_name
                      FROM presupuestos p 
                      LEFT JOIN clientes c ON p.cliente_id = c.id 
                      LEFT JOIN epigrafes e ON p.epigrafe_id = e.id
                      WHERE p.id=? AND p.user_id=?");
$stmt->execute([$presupuesto_id, $_SESSION['usuario']['id']]);
$presupuesto = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $db->prepare("SELECT * FROM lineas_presupuesto WHERE presupuesto_id=?");
$stmt->execute([$presupuesto_id]);
$lineas = $stmt->fetchAll(PDO::FETCH_ASSOC);

$misDatosStmt = $db->prepare("SELECT * FROM mis_datos WHERE user_id=?");
$misDatosStmt->execute([$_SESSION['usuario']['id']]);
$misDatos = $misDatosStmt->fetch(PDO::FETCH_ASSOC);

// Use the presupuesto total as the subtotal; further calculations occur in presupuesto_template.php
$subtotal = $presupuesto['total'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Presupuesto</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Ver Presupuesto</h2>
    <?php include 'presupuesto_template.php'; ?>
</body>
</html>


```