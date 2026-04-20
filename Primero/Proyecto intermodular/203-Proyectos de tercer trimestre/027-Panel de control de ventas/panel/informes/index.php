<?php
// Database connection
$db = new SQLite3('../jocarsa.db');
$db->exec('PRAGMA foreign_keys = ON;');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { overflow-x: hidden; }
        .admin-sidebar {
            background: #222;
            color: #fff;
            padding: 20px;
            min-height: 100vh;
            position: fixed;
            width: 200px;
            z-index: 1000;
        }
        .admin-sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px;
        }
        .admin-sidebar a:hover { background: #333; }
        .admin-content {
            margin-left: 220px;
            padding: 20px;
            width: calc(100% - 220px);
        }
    </style>
</head>
<body>
    <div class="admin-sidebar">
        <h4>Admin Panel</h4>
        <a href="../index.php?table=clientes"><i class="fas fa-users"></i> Clientes</a>
        <a href="../index.php?table=productos"><i class="fas fa-boxes"></i> Productos</a>
        <a href="../index.php?table=pedidos"><i class="fas fa-shopping-cart"></i> Pedidos</a>
        <a href="../index.php?table=lineas_pedido"><i class="fas fa-list"></i> Líneas Pedido</a>
        <a href="index.php"><i class="fas fa-chart-bar"></i> Informes</a>
    </div>
    <div class="admin-content">
        <h2>Informes</h2>
        <p>Seleccione un informe del menú lateral.</p>
        <ul>
            <li><a href="pedidos_por_anio.php">Pedidos por Año</a></li>
            <li><a href="ventas_por_mes_20_anios.php">Ventas por mes en 20 años</a></li>
            <!-- Add more reports here -->
        </ul>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
