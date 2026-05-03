<?php
// Database connection
$db = new SQLite3('../jocarsa.db');
$db->exec('PRAGMA foreign_keys = ON;');

date_default_timezone_set('Europe/Madrid');

// ======================================================
// FECHA ACTUAL REAL DESDE PHP
// ======================================================
$fecha_actual = date('Y-m-d');
$anio_actual = (int)date('Y');
$anio_inicio = $anio_actual - 19; // últimos 20 años incluyendo el actual

// ======================================================
// LISTA DE AÑOS
// ======================================================
$anios = [];
for ($y = $anio_inicio; $y <= $anio_actual; $y++) {
    $anios[] = $y;
}

// ======================================================
// OBTENER PRODUCTOS
// ======================================================
$productos = [];
$result = $db->query("
    SELECT id, nombre, categoria, sku, precio, activo
    FROM productos
    ORDER BY nombre ASC
");

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $producto_id = (int)$row['id'];
    $productos[$producto_id] = [
        'producto_id' => $producto_id,
        'nombre' => $row['nombre'] ?: ('Producto #' . $producto_id),
        'categoria' => $row['categoria'] ?? '',
        'sku' => $row['sku'] ?? '',
        'precio' => isset($row['precio']) ? (float)$row['precio'] : 0.0,
        'activo' => isset($row['activo']) ? (int)$row['activo'] : 1,
        'serie' => [],
        'unidades' => [],
        'total_global' => 0.0,
        'unidades_globales' => 0
    ];

    foreach ($anios as $anio) {
        $productos[$producto_id]['serie'][$anio] = 0.0;
        $productos[$producto_id]['unidades'][$anio] = 0;
    }
}

// ======================================================
// VENTAS POR PRODUCTO Y AÑO
// ======================================================
$sql = "
    SELECT
        pr.id AS producto_id,
        CAST(strftime('%Y', pe.fecha_pedido) AS INTEGER) AS anio,
        SUM(COALESCE(lp.total_linea, 0)) AS total_vendido,
        SUM(COALESCE(lp.cantidad, 0)) AS unidades_vendidas
    FROM productos pr
    LEFT JOIN lineas_pedido lp
        ON lp.producto_id = pr.id
    LEFT JOIN pedidos pe
        ON pe.id = lp.pedido_id
        AND date(pe.fecha_pedido) >= date('now', '-20 years')
    GROUP BY pr.id, anio
    ORDER BY pr.id ASC, anio ASC
";

$result = $db->query($sql);

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $producto_id = (int)$row['producto_id'];

    if (!isset($productos[$producto_id])) {
        continue;
    }

    if (!empty($row['anio'])) {
        $anio = (int)$row['anio'];

        if (in_array($anio, $anios, true)) {
            $total_vendido = round((float)$row['total_vendido'], 2);
            $unidades_vendidas = (int)$row['unidades_vendidas'];

            $productos[$producto_id]['serie'][$anio] = $total_vendido;
            $productos[$producto_id]['unidades'][$anio] = $unidades_vendidas;
            $productos[$producto_id]['total_global'] += $total_vendido;
            $productos[$producto_id]['unidades_globales'] += $unidades_vendidas;
        }
    }
}

// ======================================================
// MÉTRICAS POR PRODUCTO
// ======================================================
$productos_resumen = [];

foreach ($productos as $producto) {
    $anios_con_ventas = 0;
    $primer_anio_ventas = null;
    $ultimo_anio_ventas = null;
    $max_anual = 0.0;
    $anio_pico = null;

    foreach ($anios as $anio) {
        $valor = (float)$producto['serie'][$anio];

        if ($valor > 0) {
            $anios_con_ventas++;
            if ($primer_anio_ventas === null) {
                $primer_anio_ventas = $anio;
            }
            $ultimo_anio_ventas = $anio;

            if ($valor > $max_anual) {
                $max_anual = $valor;
                $anio_pico = $anio;
            }
        }
    }

    $serie_values = array_values($producto['serie']);
    $primer_tramo = array_slice($serie_values, 0, min(5, count($serie_values)));
    $ultimo_tramo = array_slice($serie_values, max(0, count($serie_values) - 5), min(5, count($serie_values)));

    $media_inicial = count($primer_tramo) ? array_sum($primer_tramo) / count($primer_tramo) : 0;
    $media_final = count($ultimo_tramo) ? array_sum($ultimo_tramo) / count($ultimo_tramo) : 0;

    $delta = $media_final - $media_inicial;
    $tendencia = 'estable';

    if ($delta > 0.01) {
        $tendencia = 'creciente';
    } elseif ($delta < -0.01) {
        $tendencia = 'decreciente';
    }

    $ultimo_valor = (float)$producto['serie'][$anio_actual];
    $valor_penultimo = isset($producto['serie'][$anio_actual - 1]) ? (float)$producto['serie'][$anio_actual - 1] : 0.0;

    $estado_reciente = 'sin ventas recientes';
    if ($ultimo_valor > 0 && $valor_penultimo > 0) {
        $estado_reciente = 'activo';
    } elseif ($ultimo_valor > 0 && $valor_penultimo <= 0) {
        $estado_reciente = 'reactivado o nuevo impulso';
    } elseif ($ultimo_valor <= 0 && $valor_penultimo > 0) {
        $estado_reciente = 'caída reciente';
    }

    $fase_local = 'indefinida';
    if ($anios_con_ventas === 0) {
        $fase_local = 'sin ventas';
    } elseif ($anios_con_ventas <= 2 && $ultimo_anio_ventas === $anio_actual) {
        $fase_local = 'introduccion';
    } elseif ($tendencia === 'creciente' && $ultimo_valor > 0) {
        $fase_local = 'crecimiento';
    } elseif ($tendencia === 'estable' && $ultimo_valor > 0) {
        $fase_local = 'madurez';
    } elseif ($tendencia === 'decreciente') {
        $fase_local = 'declive';
    } elseif ($ultimo_anio_ventas !== null && $ultimo_anio_ventas <= ($anio_actual - 2)) {
        $fase_local = 'retirado o dormido';
    }

    $productos_resumen[] = [
        'producto_id' => $producto['producto_id'],
        'nombre' => $producto['nombre'],
        'categoria' => $producto['categoria'],
        'sku' => $producto['sku'],
        'precio' => $producto['precio'],
        'activo' => $producto['activo'],
        'serie' => $producto['serie'],
        'unidades' => $producto['unidades'],
        'total_global' => round($producto['total_global'], 2),
        'unidades_globales' => (int)$producto['unidades_globales'],
        'anios_con_ventas' => $anios_con_ventas,
        'primer_anio_ventas' => $primer_anio_ventas,
        'ultimo_anio_ventas' => $ultimo_anio_ventas,
        'anio_pico' => $anio_pico,
        'max_anual' => round($max_anual, 2),
        'tendencia' => $tendencia,
        'estado_reciente' => $estado_reciente,
        'fase_local' => $fase_local
    ];
}

// Ordenar por ventas globales descendente
usort($productos_resumen, function ($a, $b) {
    return $b['total_global'] <=> $a['total_global'];
});

// ======================================================
// RESUMEN LOCAL
// ======================================================
$conteo_introduccion = 0;
$conteo_crecimiento = 0;
$conteo_madurez = 0;
$conteo_declive = 0;
$conteo_sin_ventas = 0;
$conteo_retirados = 0;

foreach ($productos_resumen as $p) {
    switch ($p['fase_local']) {
        case 'introduccion': $conteo_introduccion++; break;
        case 'crecimiento': $conteo_crecimiento++; break;
        case 'madurez': $conteo_madurez++; break;
        case 'declive': $conteo_declive++; break;
        case 'sin ventas': $conteo_sin_ventas++; break;
        case 'retirado o dormido': $conteo_retirados++; break;
    }
}

// ======================================================
// DATOS PARA JS
// ======================================================
$productos_js = [];

foreach ($productos_resumen as $p) {
    $productos_js[] = [
        'producto_id' => $p['producto_id'],
        'nombre' => $p['nombre'],
        'categoria' => $p['categoria'],
        'sku' => $p['sku'],
        'precio' => $p['precio'],
        'activo' => $p['activo'],
        'total_global' => $p['total_global'],
        'unidades_globales' => $p['unidades_globales'],
        'anios_con_ventas' => $p['anios_con_ventas'],
        'primer_anio_ventas' => $p['primer_anio_ventas'],
        'ultimo_anio_ventas' => $p['ultimo_anio_ventas'],
        'anio_pico' => $p['anio_pico'],
        'max_anual' => $p['max_anual'],
        'tendencia' => $p['tendencia'],
        'estado_reciente' => $p['estado_reciente'],
        'fase_local' => $p['fase_local'],
        'serie' => $p['serie'],
        'unidades' => $p['unidades']
    ];
}

$productos_js_json = json_encode($productos_js, JSON_UNESCAPED_UNICODE);
$anios_json = json_encode($anios, JSON_UNESCAPED_UNICODE);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas por año de cada producto</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <style>
        body {
            overflow-x: hidden;
            background: #f5f6fa;
        }

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

        .badge-soft {
            background: #eef4ff;
            color: #1d4ed8;
            border: 1px solid #dbeafe;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
        }

        .product-card {
            background: #fff;
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            margin-bottom: 24px;
        }

        .product-meta {
            color: #666;
            font-size: 14px;
        }

        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 12px;
            margin-top: 16px;
            margin-bottom: 16px;
        }

        .metric-box {
            background: #f8f9fa;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 12px;
        }

        .metric-label {
            font-size: 12px;
            color: #666;
            margin-bottom: 4px;
        }

        .metric-value {
            font-weight: 700;
            font-size: 16px;
        }

        .comment-box {
            background: #f8f9fa;
            border-left: 4px solid #0d6efd;
            padding: 15px;
            margin-top: 18px;
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

        .small-note {
            font-size: 12px;
            color: #666;
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
            <h2>Ventas por año de cada producto</h2>
            <p>
                Periodo analizado: <strong><?php echo $anio_inicio; ?> - <?php echo $anio_actual; ?></strong>.
                Fecha actual real del sistema: <strong><?php echo htmlspecialchars($fecha_actual); ?></strong>.
            </p>
            <p>
                Este informe muestra una gráfica por producto para observar su ciclo de vida:
                introducción, crecimiento, madurez, declive o retirada.
            </p>
        </div>

        <div class="card-block">
            <h3>Resumen automático local</h3>
            <div class="d-flex flex-wrap gap-2">
                <span class="badge-soft">Introducción: <?php echo $conteo_introduccion; ?></span>
                <span class="badge-soft">Crecimiento: <?php echo $conteo_crecimiento; ?></span>
                <span class="badge-soft">Madurez: <?php echo $conteo_madurez; ?></span>
                <span class="badge-soft">Declive: <?php echo $conteo_declive; ?></span>
                <span class="badge-soft">Retirados o dormidos: <?php echo $conteo_retirados; ?></span>
                <span class="badge-soft">Sin ventas: <?php echo $conteo_sin_ventas; ?></span>
            </div>
        </div>

        <div id="products-container">
            <?php foreach ($productos_resumen as $index => $producto): ?>
                <div class="product-card" id="product-card-<?php echo (int)$producto['producto_id']; ?>">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                        <div>
                            <h3 class="mb-1"><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                            <div class="product-meta">
                                ID: <?php echo (int)$producto['producto_id']; ?>
                                · SKU: <?php echo htmlspecialchars($producto['sku'] ?: '—'); ?>
                                · Categoría: <?php echo htmlspecialchars($producto['categoria'] ?: '—'); ?>
                                · Precio actual: <?php echo number_format((float)$producto['precio'], 2, ',', '.'); ?> €
                                · Activo: <?php echo $producto['activo'] ? 'Sí' : 'No'; ?>
                            </div>
                        </div>
                        <div>
                            <span class="badge-soft">Fase local: <?php echo htmlspecialchars($producto['fase_local']); ?></span>
                        </div>
                    </div>

                    <div class="metrics-grid">
                        <div class="metric-box">
                            <div class="metric-label">Ventas acumuladas</div>
                            <div class="metric-value"><?php echo number_format((float)$producto['total_global'], 2, ',', '.'); ?> €</div>
                        </div>
                        <div class="metric-box">
                            <div class="metric-label">Unidades acumuladas</div>
                            <div class="metric-value"><?php echo (int)$producto['unidades_globales']; ?></div>
                        </div>
                        <div class="metric-box">
                            <div class="metric-label">Años con ventas</div>
                            <div class="metric-value"><?php echo (int)$producto['anios_con_ventas']; ?></div>
                        </div>
                        <div class="metric-box">
                            <div class="metric-label">Primer año con ventas</div>
                            <div class="metric-value"><?php echo $producto['primer_anio_ventas'] ? (int)$producto['primer_anio_ventas'] : '—'; ?></div>
                        </div>
                        <div class="metric-box">
                            <div class="metric-label">Último año con ventas</div>
                            <div class="metric-value"><?php echo $producto['ultimo_anio_ventas'] ? (int)$producto['ultimo_anio_ventas'] : '—'; ?></div>
                        </div>
                        <div class="metric-box">
                            <div class="metric-label">Año pico</div>
                            <div class="metric-value">
                                <?php
                                if ($producto['anio_pico']) {
                                    echo (int)$producto['anio_pico'] . ' (' . number_format((float)$producto['max_anual'], 2, ',', '.') . ' €)';
                                } else {
                                    echo '—';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="metric-box">
                            <div class="metric-label">Tendencia</div>
                            <div class="metric-value"><?php echo htmlspecialchars($producto['tendencia']); ?></div>
                        </div>
                        <div class="metric-box">
                            <div class="metric-label">Estado reciente</div>
                            <div class="metric-value"><?php echo htmlspecialchars($producto['estado_reciente']); ?></div>
                        </div>
                    </div>

                    <div class="small-note mb-2">
                        Comentario IA individual por producto. Se realiza una petición independiente al servidor remoto para este producto.
                    </div>

                    <canvas id="chart-product-<?php echo (int)$producto['producto_id']; ?>" height="110"></canvas>

                    <div id="comment-product-<?php echo (int)$producto['producto_id']; ?>" class="comment-box">
                        <p class="loading">Cargando comentario del ciclo de vida del producto...</p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        const years = <?php echo $anios_json; ?>;
        const products = <?php echo $productos_js_json; ?>;

        function renderMarkdownIntoElement(elementId, markdownText) {
            const el = document.getElementById(elementId);
            el.innerHTML = `<div class="markdown-body">${marked.parse(markdownText)}</div>`;
        }

        async function fetchAIText(question) {
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

            return await response.text();
        }

        function initProductChart(product) {
            const canvas = document.getElementById(`chart-product-${product.producto_id}`);
            if (!canvas) return;

            const ctx = canvas.getContext('2d');
            const data = years.map(year => {
                const value = product.serie[String(year)] ?? product.serie[year] ?? 0;
                return Number(value);
            });

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: years,
                    datasets: [{
                        label: 'Ventas anuales (€)',
                        data: data,
                        borderWidth: 3,
                        tension: 0.25,
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
                            title: {
                                display: true,
                                text: 'Año'
                            }
                        }
                    }
                }
            });
        }

        async function analyzeProduct(product) {
            const elementId = `comment-product-${product.producto_id}`;

            const yearlySeries = years.map(year => {
                const value = product.serie[String(year)] ?? product.serie[year] ?? 0;
                const units = product.unidades[String(year)] ?? product.unidades[year] ?? 0;
                return `${year}: ventas=${Number(value).toFixed(2)} EUR, unidades=${units}`;
            }).join('\n');

            const question = `Analiza el ciclo de vida de este producto usando ventas anuales históricas.

La fecha actual REAL del sistema, proporcionada por PHP, es: <?php echo $fecha_actual; ?>.
El año actual REAL del sistema es: <?php echo $anio_actual; ?>.

No uses tu fecha interna de entrenamiento.
Debes basarte únicamente en la fecha real proporcionada arriba.

Datos del producto:
- ID: ${product.producto_id}
- Nombre: ${product.nombre}
- Categoría: ${product.categoria || 'N/D'}
- SKU: ${product.sku || 'N/D'}
- Precio actual: ${Number(product.precio).toFixed(2)} EUR
- Activo: ${product.activo ? 'Sí' : 'No'}

Resumen local:
- Ventas acumuladas: ${Number(product.total_global).toFixed(2)} EUR
- Unidades acumuladas: ${product.unidades_globales}
- Años con ventas: ${product.anios_con_ventas}
- Primer año con ventas: ${product.primer_anio_ventas ?? 'N/D'}
- Último año con ventas: ${product.ultimo_anio_ventas ?? 'N/D'}
- Año pico: ${product.anio_pico ?? 'N/D'}
- Pico anual: ${Number(product.max_anual).toFixed(2)} EUR
- Tendencia local: ${product.tendencia}
- Estado reciente: ${product.estado_reciente}
- Fase local sugerida: ${product.fase_local}

Serie anual completa:
${yearlySeries}

Responde en markdown.

Quiero exactamente:
1. Una lectura breve de la evolución histórica del producto.
2. En qué fase del ciclo de vida parece estar: introducción, crecimiento, madurez, declive u otra.
3. Si las ventas crecen, decrecen o están estabilizadas.
4. Riesgos y oportunidades para este producto.
5. Una recomendación comercial concreta.`;

            try {
                const text = await fetchAIText(question);
                renderMarkdownIntoElement(elementId, text);
            } catch (error) {
                document.getElementById(elementId).innerHTML =
                    `<p style="color:red;">Error al obtener comentario IA: ${error.message}</p>`;
            }
        }

        document.addEventListener('DOMContentLoaded', async () => {
            for (const product of products) {
                initProductChart(product);
            }

            for (const product of products) {
                await analyzeProduct(product);
            }
        });
    </script>
</body>
</html>
