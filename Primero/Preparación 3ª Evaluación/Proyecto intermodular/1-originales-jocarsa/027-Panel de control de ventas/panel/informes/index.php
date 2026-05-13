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
        :root {
            --sidebar-bg: #1f2937;
            --sidebar-hover: #374151;
            --content-bg: #f3f4f6;
            --card-bg: #ffffff;
            --card-border: #e5e7eb;
            --text-main: #111827;
            --text-soft: #6b7280;
            --accent: #2563eb;
            --accent-soft: #dbeafe;
            --success-soft: #dcfce7;
            --warning-soft: #fef3c7;
            --purple-soft: #ede9fe;
            --pink-soft: #fce7f3;
        }

        * {
            box-sizing: border-box;
        }

        body {
            overflow-x: hidden;
            background: var(--content-bg);
            color: var(--text-main);
        }

        .admin-sidebar {
            background: var(--sidebar-bg);
            color: #fff;
            padding: 24px 16px;
            min-height: 100vh;
            position: fixed;
            width: 220px;
            z-index: 1000;
            box-shadow: 2px 0 12px rgba(0,0,0,0.08);
        }

        .admin-sidebar h4 {
            font-size: 22px;
            margin-bottom: 24px;
            font-weight: 700;
        }

        .admin-sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 8px;
            transition: all 0.2s ease;
        }

        .admin-sidebar a:hover,
        .admin-sidebar a.active {
            background: var(--sidebar-hover);
        }

        .admin-sidebar i {
            width: 20px;
            margin-right: 10px;
            text-align: center;
        }

        .admin-content {
            margin-left: 220px;
            padding: 32px;
            width: calc(100% - 220px);
        }

        .page-header {
            background: linear-gradient(135deg, #ffffff, #eef2ff);
            border: 1px solid var(--card-border);
            border-radius: 18px;
            padding: 28px;
            margin-bottom: 28px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.04);
        }

        .page-header h2 {
            margin: 0 0 10px 0;
            font-size: 30px;
            font-weight: 800;
        }

        .page-header p {
            margin: 0;
            color: var(--text-soft);
            font-size: 16px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
        }

        .report-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 18px;
            padding: 22px;
            text-decoration: none;
            color: inherit;
            box-shadow: 0 4px 14px rgba(0,0,0,0.04);
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
            display: flex;
            flex-direction: column;
            min-height: 220px;
        }

        .report-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 24px rgba(0,0,0,0.08);
            border-color: #c7d2fe;
            color: inherit;
        }

        .report-icon {
            width: 58px;
            height: 58px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 18px;
        }

        .bg-blue-soft { background: var(--accent-soft); color: #1d4ed8; }
        .bg-green-soft { background: var(--success-soft); color: #15803d; }
        .bg-yellow-soft { background: var(--warning-soft); color: #b45309; }
        .bg-purple-soft { background: var(--purple-soft); color: #7c3aed; }
        .bg-pink-soft { background: var(--pink-soft); color: #be185d; }

        .report-card h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .report-card p {
            color: var(--text-soft);
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 18px;
            flex-grow: 1;
        }

        .report-card .card-footer-text {
            font-size: 13px;
            font-weight: 600;
            color: var(--accent);
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        @media (max-width: 991px) {
            .admin-sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
                border-radius: 0 0 16px 16px;
            }

            .admin-content {
                margin-left: 0;
                width: 100%;
                padding: 20px;
            }
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
        <a href="index.php" class="active"><i class="fas fa-chart-bar"></i> Informes</a>
    </div>

    <div class="admin-content">
        <div class="page-header">
            <h2>Dashboard de informes</h2>
            <p>
                Accede rápidamente a los análisis disponibles del sistema. Cada tarjeta abre un informe específico con sus visualizaciones, métricas y comentarios automáticos.
            </p>
        </div>

        <div class="section-title">Informes disponibles</div>

        <div class="dashboard-grid">
            <a href="pedidos_por_anio.php" class="report-card">
                <div class="report-icon bg-blue-soft">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3>Pedidos por Año</h3>
                <p>
                    Visualiza la evolución anual del número de pedidos y consulta un análisis apoyado por IA sobre rendimiento histórico, situación actual y previsión futura.
                </p>
                <div class="card-footer-text">Abrir informe <i class="fas fa-arrow-right ms-1"></i></div>
            </a>

            <a href="ventas_por_mes_20_anios.php" class="report-card">
                <div class="report-icon bg-green-soft">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h3>Ventas por mes en 20 años</h3>
                <p>
                    Analiza el comportamiento mensual de las ventas en los últimos veinte años, detecta estacionalidad y evalúa si se aproxima un pico o una temporada baja.
                </p>
                <div class="card-footer-text">Abrir informe <i class="fas fa-arrow-right ms-1"></i></div>
            </a>

            <a href="clientes_mapa_calor_20_anios.php" class="report-card">
                <div class="report-icon bg-yellow-soft">
                    <i class="fas fa-fire"></i>
                </div>
                <h3>Mapa de calor de compras por cliente</h3>
                <p>
                    Revisa las compras agregadas por cliente y año mediante un mapa de calor, y obtén una segmentación detallada de clientes con clasificación completa.
                </p>
                <div class="card-footer-text">Abrir informe <i class="fas fa-arrow-right ms-1"></i></div>
            </a>

            <a href="ventas_por_producto_y_anio.php" class="report-card">
                <div class="report-icon bg-purple-soft">
                    <i class="fas fa-box-open"></i>
                </div>
                <h3>Ventas por año de cada producto</h3>
                <p>
                    Consulta el ciclo de vida de cada producto con una gráfica individual, métricas clave y un comentario específico generado para cada referencia.
                </p>
                <div class="card-footer-text">Abrir informe <i class="fas fa-arrow-right ms-1"></i></div>
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
