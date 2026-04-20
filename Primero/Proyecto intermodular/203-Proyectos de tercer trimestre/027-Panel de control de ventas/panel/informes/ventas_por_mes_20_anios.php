<?php
// Database connection
$db = new SQLite3('../jocarsa.db');
$db->exec('PRAGMA foreign_keys = ON;');

date_default_timezone_set('Europe/Madrid');

// ======================================================
// DATOS PRINCIPALES: ventas por mes en los últimos 20 años
// ======================================================
$result = $db->query("
    SELECT
        strftime('%Y-%m', fecha_pedido) AS periodo,
        CAST(strftime('%Y', fecha_pedido) AS INTEGER) AS anio,
        CAST(strftime('%m', fecha_pedido) AS INTEGER) AS mes_num,
        SUM(COALESCE(total, 0)) AS total_ventas,
        COUNT(*) AS total_pedidos
    FROM pedidos
    WHERE date(fecha_pedido) >= date('now', '-20 years')
    GROUP BY strftime('%Y-%m', fecha_pedido)
    ORDER BY periodo ASC
");

$ventas_por_mes = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $ventas_por_mes[] = [
        'periodo' => $row['periodo'],
        'anio' => (int)$row['anio'],
        'mes_num' => (int)$row['mes_num'],
        'total_ventas' => round((float)$row['total_ventas'], 2),
        'total_pedidos' => (int)$row['total_pedidos']
    ];
}

// ======================================================
// ESTACIONALIDAD: media por mes del año a lo largo de 20 años
// ======================================================
$result = $db->query("
    SELECT
        CAST(strftime('%m', fecha_pedido) AS INTEGER) AS mes_num,
        SUM(COALESCE(total, 0)) AS total_ventas,
        COUNT(DISTINCT strftime('%Y', fecha_pedido)) AS anios_con_datos,
        COUNT(*) AS total_pedidos
    FROM pedidos
    WHERE date(fecha_pedido) >= date('now', '-20 years')
    GROUP BY strftime('%m', fecha_pedido)
    ORDER BY mes_num ASC
");

$meses_nombres = [
    1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
    5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
    9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
];

$estacionalidad = [];
$media_mensual = array_fill(1, 12, 0);

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $mes = (int)$row['mes_num'];
    $total_ventas = (float)$row['total_ventas'];
    $anios_con_datos = max(1, (int)$row['anios_con_datos']);
    $media = round($total_ventas / $anios_con_datos, 2);

    $estacionalidad[] = [
        'mes_num' => $mes,
        'mes' => $meses_nombres[$mes],
        'media_ventas' => $media,
        'total_pedidos' => (int)$row['total_pedidos']
    ];

    $media_mensual[$mes] = $media;
}

// ======================================================
// FECHA ACTUAL Y PRÓXIMOS MESES
// ======================================================
$mes_actual = (int)date('n');   // abril = 4 según la fecha actual del servidor
$anio_actual = (int)date('Y');

$proximos_meses = [];
for ($i = 0; $i < 6; $i++) {
    $mes_calc = (($mes_actual - 1 + $i) % 12) + 1;
    $proximos_meses[] = [
        'mes_num' => $mes_calc,
        'mes' => $meses_nombres[$mes_calc],
        'media_ventas' => $media_mensual[$mes_calc] ?? 0
    ];
}

// Buscar mes pico y mes bajo por media histórica
$mes_pico = null;
$mes_bajo = null;

if (!empty($estacionalidad)) {
    $mes_pico = $estacionalidad[0];
    $mes_bajo = $estacionalidad[0];

    foreach ($estacionalidad as $item) {
        if ($item['media_ventas'] > $mes_pico['media_ventas']) {
            $mes_pico = $item;
        }
        if ($item['media_ventas'] < $mes_bajo['media_ventas']) {
            $mes_bajo = $item;
        }
    }
}

// ======================================================
// DATOS PARA JS / IA
// ======================================================
$labels_historico = [];
$data_ventas_historico = [];
$data_pedidos_historico = [];

foreach ($ventas_por_mes as $row) {
    $labels_historico[] = $row['periodo'];
    $data_ventas_historico[] = $row['total_ventas'];
    $data_pedidos_historico[] = $row['total_pedidos'];
}

$labels_estacionalidad = [];
$data_estacionalidad = [];
foreach ($estacionalidad as $row) {
    $labels_estacionalidad[] = $row['mes'];
    $data_estacionalidad[] = $row['media_ventas'];
}

$historico_json_labels = json_encode($labels_historico, JSON_UNESCAPED_UNICODE);
$historico_json_data = json_encode($data_ventas_historico, JSON_UNESCAPED_UNICODE);
$estacionalidad_json_labels = json_encode($labels_estacionalidad, JSON_UNESCAPED_UNICODE);
$estacionalidad_json_data = json_encode($data_estacionalidad, JSON_UNESCAPED_UNICODE);

$estacionalidad_texto = [];
foreach ($estacionalidad as $row) {
    $estacionalidad_texto[] = $row['mes'] . ': ' . number_format($row['media_ventas'], 2, ',', '.') . ' €';
}

$proximos_meses_texto = [];
foreach ($proximos_meses as $row) {
    $proximos_meses_texto[] = $row['mes'] . ': ' . number_format($row['media_ventas'], 2, ',', '.') . ' €';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas por Mes - Últimos 20 años</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <style>
        body { overflow-x: hidden; background:#f5f6fa; }

        .admin-sidebar {
            background: #222;
            color: #fff;
            padding: 20px;
            min-height: 100vh;
            position: fixed;
            width: 220px;
            z-index: 1000;
        }

        .admin-sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 6px;
        }

        .admin-sidebar a:hover {
            background: #333;
        }

        .admin-content {
            margin-left: 240px;
            padding: 20px;
            width: calc(100% - 240px);
        }

        .card-block {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            margin-bottom: 24px;
        }

        .ai-response {
            background: #f8f9fa;
            border-left: 4px solid #0d6efd;
            padding: 15px;
            margin: 20px 0;
            border-radius: 8px;
        }

        .loading {
            color: #6c757d;
            font-style: italic;
        }

        .markdown-body h1,
        .markdown-body h2,
        .markdown-body h3,
        .markdown-body h4,
        .markdown-body h5,
        .markdown-body h6 {
            margin-top: 1rem;
            margin-bottom: 0.75rem;
        }

        .markdown-body p { margin-bottom: 0.8rem; }
        .markdown-body ul, .markdown-body ol { padding-left: 1.5rem; }

        .table-sm td, .table-sm th {
            padding: .45rem;
            vertical-align: middle;
        }

        .metric {
            font-size: 1.1rem;
            font-weight: 600;
        }

        canvas {
            max-width: 100%;
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
        <div class="card-block">
            <h2>Ventas por mes en los últimos 20 años</h2>
            <p>
                Informe histórico mensual de ventas y análisis de estacionalidad.
                El sistema toma como referencia el mes actual:
                <strong><?php echo htmlspecialchars($meses_nombres[$mes_actual]); ?> de <?php echo $anio_actual; ?></strong>.
            </p>
        </div>

        <div class="card-block">
            <h3>Serie histórica mensual</h3>
            <canvas id="historicoChart" height="110"></canvas>
        </div>

        <div class="card-block">
            <h3>Estacionalidad media por mes</h3>
            <canvas id="estacionalidadChart" height="100"></canvas>
        </div>

        <div class="card-block">
            <h3>Indicadores estacionales</h3>
            <div class="row">
                <div class="col-md-4">
                    <p class="metric">Mes actual</p>
                    <p><?php echo htmlspecialchars($meses_nombres[$mes_actual]); ?></p>
                </div>
                <div class="col-md-4">
                    <p class="metric">Mes históricamente más fuerte</p>
                    <p>
                        <?php echo $mes_pico ? htmlspecialchars($mes_pico['mes']) . ' (' . number_format($mes_pico['media_ventas'], 2, ',', '.') . ' €)' : 'N/D'; ?>
                    </p>
                </div>
                <div class="col-md-4">
                    <p class="metric">Mes históricamente más flojo</p>
                    <p>
                        <?php echo $mes_bajo ? htmlspecialchars($mes_bajo['mes']) . ' (' . number_format($mes_bajo['media_ventas'], 2, ',', '.') . ' €)' : 'N/D'; ?>
                    </p>
                </div>
            </div>

            <hr>

            <h5>Próximos meses según media histórica</h5>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Mes</th>
                            <th>Media histórica de ventas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($proximos_meses as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['mes']); ?></td>
                            <td><?php echo number_format($row['media_ventas'], 2, ',', '.'); ?> €</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-block">
            <h3>Análisis con IA</h3>

            <div id="ai-seasonality" class="ai-response">
                <p class="loading">Cargando análisis de estacionalidad y tendencia próxima...</p>
            </div>
        </div>
    </div>

    <script>
        const historicoLabels = <?php echo $historico_json_labels; ?>;
        const historicoData = <?php echo $historico_json_data; ?>;

        const estacionalidadLabels = <?php echo $estacionalidad_json_labels; ?>;
        const estacionalidadData = <?php echo $estacionalidad_json_data; ?>;

        function renderMarkdownIntoElement(elementId, markdownText) {
            const el = document.getElementById(elementId);
            el.innerHTML = `<div class="markdown-body">${marked.parse(markdownText)}</div>`;
        }

        function initHistoricoChart() {
            const ctx = document.getElementById('historicoChart').getContext('2d');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: historicoLabels,
                    datasets: [{
                        label: 'Ventas mensuales (€)',
                        data: historicoData,
                        borderWidth: 2,
                        tension: 0.2,
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: true }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Ventas (€)'
                            }
                        },
                        x: {
                            ticks: {
                                maxTicksLimit: 24
                            }
                        }
                    }
                }
            });
        }

        function initEstacionalidadChart() {
            const ctx = document.getElementById('estacionalidadChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: estacionalidadLabels,
                    datasets: [{
                        label: 'Media histórica de ventas por mes (€)',
                        data: estacionalidadData,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: true }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Media de ventas (€)'
                            }
                        }
                    }
                }
            });
        }

        async function fetchAIResponse(question, elementId) {
            const responseElement = document.getElementById(elementId);

            try {
                const response = await fetch('../iaremota.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `question=${encodeURIComponent(question)}`
                });

                if (!response.ok) {
                    throw new Error(`Error: ${response.status} ${response.statusText}`);
                }

                const text = await response.text();
                renderMarkdownIntoElement(elementId, text);

            } catch (error) {
                responseElement.innerHTML = `<p style="color:red;">Error al obtener respuesta: ${error.message}</p>`;
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            initHistoricoChart();
            initEstacionalidadChart();

            const question = `Analiza estos datos de ventas mensuales de los últimos 20 años.

Mes actual: <?php echo $meses_nombres[$mes_actual]; ?>.
Año actual: <?php echo $anio_actual; ?>.

Serie histórica mensual completa:
<?php
foreach ($ventas_por_mes as $row) {
    echo $row['periodo'] . ': ' . number_format($row['total_ventas'], 2, '.', '') . " EUR\\n";
}
?>

Media histórica por mes del año:
<?php echo implode("\\n", array_map(function($x){ return $x; }, $estacionalidad_texto)); ?>

Próximos meses desde el mes actual:
<?php echo implode("\\n", array_map(function($x){ return $x; }, $proximos_meses_texto)); ?>

Responde en markdown.
Quiero que indiques:
1. Si, teniendo en cuenta el mes actual, es probable que venga un pico de pedidos o temporada baja.
2. Qué meses parecen más fuertes y cuáles más débiles.
3. Si la tendencia inmediata de los próximos meses parece ascendente, descendente o estable.
4. Qué decisiones comerciales recomendarías en consecuencia.`;

            fetchAIResponse(question, 'ai-seasonality');
        });
    </script>
</body>
</html>
