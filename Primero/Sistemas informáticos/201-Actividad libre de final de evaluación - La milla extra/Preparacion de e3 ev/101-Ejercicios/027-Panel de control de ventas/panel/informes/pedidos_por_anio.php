<?php
// Database connection
$db = new SQLite3('../jocarsa.db');
$db->exec('PRAGMA foreign_keys = ON;');

// Query: Number of orders per year
$result = $db->query("
    SELECT
        strftime('%Y', fecha_pedido) as anio,
        COUNT(*) as total_pedidos
    FROM pedidos
    GROUP BY strftime('%Y', fecha_pedido)
    ORDER BY anio
");

$pedidos_por_anio = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $pedidos_por_anio[] = $row;
}

// Prepare historical data
$years = [];
$orders = [];

foreach ($pedidos_por_anio as $row) {
    $years[] = (int)$row['anio'];
    $orders[] = (int)$row['total_pedidos'];
}

// Build a simple linear forecast for next 10 years
$forecast_years = [];
$forecast_orders = [];

$n = count($years);

if ($n >= 2) {
    $sumX = array_sum($years);
    $sumY = array_sum($orders);

    $sumXY = 0;
    $sumX2 = 0;

    for ($i = 0; $i < $n; $i++) {
        $sumXY += $years[$i] * $orders[$i];
        $sumX2 += $years[$i] * $years[$i];
    }

    $den = ($n * $sumX2) - ($sumX * $sumX);

    if ($den != 0) {
        $m = (($n * $sumXY) - ($sumX * $sumY)) / $den;
        $b = ($sumY - ($m * $sumX)) / $n;
    } else {
        $m = 0;
        $b = $orders[$n - 1] ?? 0;
    }

    $last_year = max($years);

    for ($i = 1; $i <= 10; $i++) {
        $fy = $last_year + $i;
        $fo = round(($m * $fy) + $b);
        if ($fo < 0) {
            $fo = 0;
        }
        $forecast_years[] = $fy;
        $forecast_orders[] = $fo;
    }
} elseif ($n === 1) {
    $last_year = $years[0];
    $last_value = $orders[0];
    for ($i = 1; $i <= 10; $i++) {
        $forecast_years[] = $last_year + $i;
        $forecast_orders[] = $last_value;
    }
}

// Strings for AI prompts
$years_str = implode(', ', $years);
$orders_str = implode(', ', $orders);

// JSON for JS charts
$historical_labels_json = json_encode($years, JSON_UNESCAPED_UNICODE);
$historical_data_json = json_encode($orders, JSON_UNESCAPED_UNICODE);

$forecast_labels_json = json_encode($forecast_years, JSON_UNESCAPED_UNICODE);
$forecast_data_json = json_encode($forecast_orders, JSON_UNESCAPED_UNICODE);

// Unified chart for past + future
$combined_labels = array_merge($years, $forecast_years);
$combined_historical_data = array_merge($orders, array_fill(0, count($forecast_years), null));
$combined_forecast_data = array_merge(array_fill(0, count($years), null), $forecast_orders);

$combined_labels_json = json_encode($combined_labels, JSON_UNESCAPED_UNICODE);
$combined_historical_json = json_encode($combined_historical_data, JSON_UNESCAPED_UNICODE);
$combined_forecast_json = json_encode($combined_forecast_data, JSON_UNESCAPED_UNICODE);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos por Año</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Chart.js for forecast visualization -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Marked.js for Markdown -> HTML -->
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

        .table { margin-top: 20px; }

        .barra {
            background: #0d6efd;
            color: white;
            display: inline-block;
            border-radius: 10px;
            padding: 6px 10px;
            text-align: center;
            min-width: 40px;
            white-space: nowrap;
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

        .markdown-body p {
            margin-bottom: 0.8rem;
        }

        .markdown-body ul,
        .markdown-body ol {
            padding-left: 1.5rem;
        }

        .markdown-body code {
            background: #eef1f4;
            padding: 2px 6px;
            border-radius: 4px;
        }

        .markdown-body pre {
            background: #1f2430;
            color: #f8f8f2;
            padding: 12px;
            border-radius: 8px;
            overflow-x: auto;
        }

        .section-title {
            margin-bottom: 16px;
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
            <h2 class="section-title">Pedidos por Año</h2>

            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th>Año</th>
                        <th>Total Pedidos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $max_pedidos = 0;
                    foreach ($pedidos_por_anio as $row) {
                        if ($row['total_pedidos'] > $max_pedidos) {
                            $max_pedidos = $row['total_pedidos'];
                        }
                    }
                    ?>
                    <?php foreach ($pedidos_por_anio as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['anio']); ?></td>
                        <td style="padding: 6px;">
                            <span
                                class="barra"
                                style="width:<?php echo $max_pedidos > 0 ? (($row['total_pedidos'] / $max_pedidos) * 320) : 0; ?>px"
                            >
                                <?php echo (int)$row['total_pedidos']; ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="card-block">
            <h3 class="section-title">Gráfica histórica y estimación futura</h3>
            <canvas id="forecastChart" height="110"></canvas>
        </div>

        <div class="card-block">
            <h3 class="section-title">Análisis con IA</h3>

            <div id="ai-performance" class="ai-response">
                <p class="loading">Cargando análisis de rendimiento pasado...</p>
            </div>

            <div id="ai-current" class="ai-response">
                <p class="loading">Cargando análisis de la situación actual...</p>
            </div>

            <div id="ai-forecast" class="ai-response">
                <p class="loading">Cargando pronóstico para los próximos 10 años...</p>
            </div>
        </div>
    </div>

    <script>
        // Historical data
        const historicalYears = <?php echo $historical_labels_json; ?>;
        const historicalOrders = <?php echo $historical_data_json; ?>;

        // Forecast data
        const forecastYears = <?php echo $forecast_labels_json; ?>;
        const forecastOrders = <?php echo $forecast_data_json; ?>;

        // Combined for chart
        const combinedLabels = <?php echo $combined_labels_json; ?>;
        const combinedHistorical = <?php echo $combined_historical_json; ?>;
        const combinedForecast = <?php echo $combined_forecast_json; ?>;

        // Data for AI questions
        const years = historicalYears.join(', ');
        const orders = historicalOrders.join(', ');
        const forecastYearsText = forecastYears.join(', ');
        const forecastOrdersText = forecastOrders.join(', ');

        // Markdown -> HTML helper
        function renderMarkdownIntoElement(elementId, markdownText) {
            const el = document.getElementById(elementId);
            el.innerHTML = `<div class="markdown-body">${marked.parse(markdownText)}</div>`;
        }

        // AI questions
        const questions = [
            {
                element: 'ai-performance',
                question: `Analiza el rendimiento del negocio en los últimos años según estos datos:
Años: ${years}
Pedidos: ${orders}

Responde en markdown.
Comenta tendencias, crecimiento o decrecimiento, y posibles causas.`
            },
            {
                element: 'ai-current',
                question: `Basado en los siguientes datos de pedidos por año:
Años: ${years}
Pedidos: ${orders}

Responde en markdown.
¿Cómo describirías la situación actual del negocio? ¿Hay señales de alerta o oportunidades?`
            },
            {
                element: 'ai-forecast',
                question: `Con los siguientes datos históricos de pedidos por año:
Años: ${years}
Pedidos: ${orders}

Y con esta estimación lineal automática para los próximos 10 años:
Años futuros estimados: ${forecastYearsText}
Pedidos futuros estimados: ${forecastOrdersText}

Responde en markdown.
Haz un pronóstico razonado para los próximos 10 años, indicando riesgos, oportunidades y lectura de la tendencia.`
            }
        ];

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

        function initForecastChart() {
            const ctx = document.getElementById('forecastChart').getContext('2d');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: combinedLabels,
                    datasets: [
                        {
                            label: 'Histórico',
                            data: combinedHistorical,
                            borderWidth: 3,
                            tension: 0.25,
                            spanGaps: false
                        },
                        {
                            label: 'Estimación futura',
                            data: combinedForecast,
                            borderWidth: 3,
                            tension: 0.25,
                            borderDash: [8, 6],
                            spanGaps: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    interaction: {
                        mode: 'nearest',
                        intersect: false
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Número de pedidos'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Año'
                            }
                        }
                    }
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            initForecastChart();

            questions.forEach(({ element, question }) => {
                fetchAIResponse(question, element);
            });
        });
    </script>
</body>
</html>
