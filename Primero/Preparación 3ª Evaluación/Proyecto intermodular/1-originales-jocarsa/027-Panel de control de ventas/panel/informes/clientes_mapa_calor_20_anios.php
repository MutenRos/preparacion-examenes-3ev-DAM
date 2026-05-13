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
// DATOS DE COMPRAS POR CLIENTE Y AÑO
// ======================================================
$sql = "
    SELECT
        c.id AS cliente_id,
        TRIM(COALESCE(c.nombre, '') || ' ' || COALESCE(c.apellidos, '')) AS cliente_nombre,
        CAST(strftime('%Y', p.fecha_pedido) AS INTEGER) AS anio,
        SUM(COALESCE(p.total, 0)) AS total_compras,
        COUNT(p.id) AS total_pedidos
    FROM clientes c
    LEFT JOIN pedidos p
        ON p.cliente_id = c.id
        AND date(p.fecha_pedido) >= date('now', '-20 years')
    GROUP BY c.id, anio
    ORDER BY cliente_nombre ASC, anio ASC
";

$result = $db->query($sql);

// ======================================================
// ESTRUCTURAS
// ======================================================
$clientes = [];
$max_total = 0.0;

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $cliente_id = (int)$row['cliente_id'];
    $cliente_nombre = trim((string)$row['cliente_nombre']);
    if ($cliente_nombre === '') {
        $cliente_nombre = 'Cliente #' . $cliente_id;
    }

    if (!isset($clientes[$cliente_id])) {
        $clientes[$cliente_id] = [
            'cliente_id' => $cliente_id,
            'cliente_nombre' => $cliente_nombre,
            'por_anio' => [],
            'total_global' => 0.0,
            'pedidos_globales' => 0
        ];

        foreach ($anios as $anio) {
            $clientes[$cliente_id]['por_anio'][$anio] = [
                'total_compras' => 0.0,
                'total_pedidos' => 0
            ];
        }
    }

    if (!empty($row['anio'])) {
        $anio = (int)$row['anio'];
        if (in_array($anio, $anios, true)) {
            $total_compras = round((float)$row['total_compras'], 2);
            $total_pedidos = (int)$row['total_pedidos'];

            $clientes[$cliente_id]['por_anio'][$anio] = [
                'total_compras' => $total_compras,
                'total_pedidos' => $total_pedidos
            ];

            $clientes[$cliente_id]['total_global'] += $total_compras;
            $clientes[$cliente_id]['pedidos_globales'] += $total_pedidos;

            if ($total_compras > $max_total) {
                $max_total = $total_compras;
            }
        }
    }
}

// ======================================================
// MÉTRICAS POR CLIENTE
// ======================================================
$clientes_resumen = [];

foreach ($clientes as $cliente) {
    $anios_con_compra = 0;
    $primera_compra = null;
    $ultima_compra = null;
    $serie = [];

    foreach ($anios as $anio) {
        $valor = (float)$cliente['por_anio'][$anio]['total_compras'];
        $serie[$anio] = $valor;

        if ($valor > 0) {
            $anios_con_compra++;
            if ($primera_compra === null) {
                $primera_compra = $anio;
            }
            $ultima_compra = $anio;
        }
    }

    $primer_tramo = array_slice(array_values($serie), 0, min(5, count($serie)));
    $ultimo_tramo = array_slice(array_values($serie), max(0, count($serie) - 5), min(5, count($serie)));

    $media_inicial = count($primer_tramo) ? array_sum($primer_tramo) / count($primer_tramo) : 0;
    $media_final = count($ultimo_tramo) ? array_sum($ultimo_tramo) / count($ultimo_tramo) : 0;

    $delta = $media_final - $media_inicial;
    $tendencia = 'estable';

    if ($delta > 0.01) {
        $tendencia = 'creciente';
    } elseif ($delta < -0.01) {
        $tendencia = 'decreciente';
    }

    $activo_ultimo_anio = ((float)$cliente['por_anio'][$anio_actual]['total_compras']) > 0 ? 1 : 0;
    $activo_penultimo_anio = isset($cliente['por_anio'][$anio_actual - 1]) && ((float)$cliente['por_anio'][$anio_actual - 1]['total_compras']) > 0 ? 1 : 0;

    $segmento_local = 'sin compras';
    if ($anios_con_compra >= 8 && $activo_ultimo_anio) {
        $segmento_local = 'regular';
    } elseif (!$activo_ultimo_anio && $ultima_compra !== null && $ultima_compra <= ($anio_actual - 2)) {
        $segmento_local = 'inactivo';
    } elseif ($tendencia === 'creciente') {
        $segmento_local = 'creciente';
    } elseif ($tendencia === 'decreciente') {
        $segmento_local = 'decreciente';
    } elseif ($anios_con_compra > 0 && $anios_con_compra <= 3) {
        $segmento_local = 'esporadico';
    } elseif ($anios_con_compra > 0) {
        $segmento_local = 'ocasional';
    }

    $clientes_resumen[] = [
        'cliente_id' => $cliente['cliente_id'],
        'cliente_nombre' => $cliente['cliente_nombre'],
        'total_global' => round($cliente['total_global'], 2),
        'pedidos_globales' => (int)$cliente['pedidos_globales'],
        'anios_con_compra' => $anios_con_compra,
        'primera_compra' => $primera_compra,
        'ultima_compra' => $ultima_compra,
        'tendencia' => $tendencia,
        'activo_ultimo_anio' => $activo_ultimo_anio,
        'activo_penultimo_anio' => $activo_penultimo_anio,
        'segmento_local' => $segmento_local,
        'serie' => $serie
    ];
}

// Ordenar por facturación total descendente
usort($clientes_resumen, function ($a, $b) {
    return $b['total_global'] <=> $a['total_global'];
});

// ======================================================
// RESUMEN LOCAL
// ======================================================
$conteo_regulares = 0;
$conteo_inactivos = 0;
$conteo_crecientes = 0;
$conteo_decrecientes = 0;
$conteo_esporadicos = 0;
$conteo_ocasionales = 0;
$conteo_sin_compras = 0;

foreach ($clientes_resumen as $c) {
    switch ($c['segmento_local']) {
        case 'regular': $conteo_regulares++; break;
        case 'inactivo': $conteo_inactivos++; break;
        case 'creciente': $conteo_crecientes++; break;
        case 'decreciente': $conteo_decrecientes++; break;
        case 'esporadico': $conteo_esporadicos++; break;
        case 'ocasional': $conteo_ocasionales++; break;
        case 'sin compras': $conteo_sin_compras++; break;
    }
}

// ======================================================
// DATOS PARA IA
// ======================================================
$dataset_ia = [];
foreach ($clientes_resumen as $c) {
    $serie_txt = [];
    foreach ($c['serie'] as $anio => $importe) {
        $serie_txt[] = $anio . '=' . number_format((float)$importe, 2, '.', '');
    }

    $dataset_ia[] = [
        'cliente_id' => $c['cliente_id'],
        'cliente_nombre' => $c['cliente_nombre'],
        'total_global' => $c['total_global'],
        'pedidos_globales' => $c['pedidos_globales'],
        'anios_con_compra' => $c['anios_con_compra'],
        'primera_compra' => $c['primera_compra'],
        'ultima_compra' => $c['ultima_compra'],
        'tendencia' => $c['tendencia'],
        'activo_ultimo_anio' => $c['activo_ultimo_anio'],
        'activo_penultimo_anio' => $c['activo_penultimo_anio'],
        'segmento_local' => $c['segmento_local'],
        'serie' => $c['serie']
    ];
}

$dataset_ia_json = json_encode($dataset_ia, JSON_UNESCAPED_UNICODE);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa de calor de compras por cliente</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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

        .table-responsive {
            overflow-x: auto;
        }

        .heatmap-table {
            font-size: 13px;
            border-collapse: separate;
            border-spacing: 0;
            min-width: 1500px;
        }

        .heatmap-table th,
        .heatmap-table td {
            text-align: center;
            vertical-align: middle;
            border: 1px solid #e5e7eb;
            padding: 8px;
        }

        .heatmap-table thead th {
            position: sticky;
            top: 0;
            background: #f8f9fa;
            z-index: 2;
        }

        .heatmap-table .sticky-col {
            position: sticky;
            left: 0;
            background: #fff;
            z-index: 3;
            text-align: left;
            min-width: 240px;
            max-width: 240px;
        }

        .heatmap-table thead .sticky-col {
            background: #f8f9fa;
            z-index: 4;
        }

        .heat-cell {
            color: #111;
            font-weight: 600;
            border-radius: 6px;
            min-width: 72px;
        }

        .muted-small {
            color: #666;
            font-size: 12px;
            display: block;
            margin-top: 2px;
        }

        .legend-box {
            width: 22px;
            height: 22px;
            border-radius: 4px;
            display: inline-block;
            margin-right: 8px;
            border: 1px solid rgba(0,0,0,0.08);
            vertical-align: middle;
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

        .badge-soft {
            background: #eef4ff;
            color: #1d4ed8;
            border: 1px solid #dbeafe;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
        }

        .segment-card {
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 16px;
            background: #fafafa;
        }

        .segment-card h5 {
            margin-bottom: 12px;
        }

        .client-pill {
            display: inline-block;
            background: #f1f5f9;
            border: 1px solid #cbd5e1;
            border-radius: 999px;
            padding: 5px 10px;
            margin: 4px;
            font-size: 12px;
        }

        .small-note {
            font-size: 12px;
            color: #666;
        }

        .classification-row td {
            vertical-align: top;
        }

        .mono {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            white-space: pre-wrap;
            word-break: break-word;
            font-size: 12px;
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
            <h2>Mapa de calor de compras por cliente y año</h2>
            <p>
                Periodo analizado: <strong><?php echo $anio_inicio; ?> - <?php echo $anio_actual; ?></strong>.
                Fecha actual real del sistema: <strong><?php echo htmlspecialchars($fecha_actual); ?></strong>.
            </p>
            <p>
                Cada celda muestra el importe comprado por un cliente en un año concreto.
                Cuanto más intenso el color, mayor volumen de compra.
            </p>
        </div>

        <div class="card-block">
            <h3>Resumen automático local</h3>
            <div class="d-flex flex-wrap gap-2">
                <span class="badge-soft">Regulares: <?php echo $conteo_regulares; ?></span>
                <span class="badge-soft">Inactivos: <?php echo $conteo_inactivos; ?></span>
                <span class="badge-soft">Crecientes: <?php echo $conteo_crecientes; ?></span>
                <span class="badge-soft">Decrecientes: <?php echo $conteo_decrecientes; ?></span>
                <span class="badge-soft">Esporádicos: <?php echo $conteo_esporadicos; ?></span>
                <span class="badge-soft">Ocasionales: <?php echo $conteo_ocasionales; ?></span>
                <span class="badge-soft">Sin compras: <?php echo $conteo_sin_compras; ?></span>
            </div>

            <div class="mt-3">
                <span class="legend-box" style="background: rgba(13,110,253,0.10);"></span> Bajo
                <span class="legend-box ms-3" style="background: rgba(13,110,253,0.35);"></span> Medio
                <span class="legend-box ms-3" style="background: rgba(13,110,253,0.75);"></span> Alto
            </div>
        </div>

        <div class="card-block">
            <h3>Mapa de calor</h3>
            <div class="table-responsive">
                <table class="table heatmap-table">
                    <thead>
                        <tr>
                            <th class="sticky-col">Cliente</th>
                            <?php foreach ($anios as $anio): ?>
                                <th><?php echo $anio; ?></th>
                            <?php endforeach; ?>
                            <th>Total</th>
                            <th>Años con compra</th>
                            <th>Última compra</th>
                            <th>Tendencia</th>
                            <th>Segmento local</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes_resumen as $cliente): ?>
                            <tr>
                                <td class="sticky-col">
                                    <strong><?php echo htmlspecialchars($cliente['cliente_nombre']); ?></strong>
                                    <span class="muted-small">ID: <?php echo (int)$cliente['cliente_id']; ?></span>
                                </td>

                                <?php foreach ($anios as $anio): ?>
                                    <?php
                                    $valor = (float)$cliente['serie'][$anio];
                                    $intensidad = 0;

                                    if ($max_total > 0) {
                                        $intensidad = $valor / $max_total;
                                    }

                                    $alpha = 0.08 + ($intensidad * 0.82);
                                    if ($valor <= 0) {
                                        $alpha = 0.03;
                                    }

                                    $background = "rgba(13,110,253," . number_format($alpha, 2, '.', '') . ")";
                                    $textColor = $alpha > 0.55 ? '#fff' : '#111';
                                    ?>
                                    <td
                                        title="<?php echo htmlspecialchars($cliente['cliente_nombre']) . ' - ' . $anio . ': ' . number_format($valor, 2, ',', '.') . ' €'; ?>"
                                        style="background: <?php echo $background; ?>; color: <?php echo $textColor; ?>;"
                                    >
                                        <div class="heat-cell">
                                            <?php echo $valor > 0 ? number_format($valor, 0, ',', '.') . '€' : '·'; ?>
                                        </div>
                                    </td>
                                <?php endforeach; ?>

                                <td><strong><?php echo number_format($cliente['total_global'], 2, ',', '.'); ?> €</strong></td>
                                <td><?php echo (int)$cliente['anios_con_compra']; ?></td>
                                <td><?php echo $cliente['ultima_compra'] ? (int)$cliente['ultima_compra'] : '—'; ?></td>
                                <td><?php echo htmlspecialchars($cliente['tendencia']); ?></td>
                                <td><?php echo htmlspecialchars($cliente['segmento_local']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-block">
            <h3>Fase 1: propuesta de segmentos con IA</h3>
            <div id="ai-segmentation" class="ai-response">
                <p class="loading">Cargando propuesta de segmentación...</p>
            </div>
        </div>

        <div class="card-block">
            <h3>Fase 2: listado completo de clientes por segmento</h3>
            <p class="small-note">
                Cada cliente se clasifica individualmente mediante una petición separada a la IA para asegurar que todos los clientes queden asignados a un segmento.
            </p>
            <div id="segment-groups">
                <p class="loading">Clasificando clientes uno a uno...</p>
            </div>
        </div>

        <div class="card-block">
            <h3>Detalle individual de clasificación</h3>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Segmento IA</th>
                            <th>Razón breve</th>
                            <th>Acción recomendada</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody id="classification-table-body">
                        <tr>
                            <td colspan="5" class="loading">Esperando clasificación...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
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

        function safeJsonParse(text) {
            try {
                return JSON.parse(text);
            } catch (e) {
                const match = text.match(/\{[\s\S]*\}|\[[\s\S]*\]/);
                if (match) {
                    try {
                        return JSON.parse(match[0]);
                    } catch (e2) {
                        return null;
                    }
                }
                return null;
            }
        }

        function escapeHtml(str) {
            return String(str)
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');
        }

        function renderSegmentGroups(groups) {
            const container = document.getElementById('segment-groups');
            const keys = Object.keys(groups);

            if (!keys.length) {
                container.innerHTML = '<p>No se han generado grupos.</p>';
                return;
            }

            let html = '';
            for (const segment of keys) {
                const clients = groups[segment];

                html += `
                    <div class="segment-card">
                        <h5>${escapeHtml(segment)} <span class="small-note">(${clients.length} clientes)</span></h5>
                        <div>
                            ${clients.map(c => `<span class="client-pill">${escapeHtml(c.cliente_nombre)} <span class="small-note">#${c.cliente_id}</span></span>`).join('')}
                        </div>
                    </div>
                `;
            }

            container.innerHTML = html;
        }

        function renderClassificationRows(rows) {
            const tbody = document.getElementById('classification-table-body');

            if (!rows.length) {
                tbody.innerHTML = `<tr><td colspan="5">No hay clasificaciones.</td></tr>`;
                return;
            }

            tbody.innerHTML = rows.map(row => `
                <tr class="classification-row">
                    <td>
                        <strong>${escapeHtml(row.cliente_nombre)}</strong><br>
                        <span class="small-note">#${row.cliente_id}</span>
                    </td>
                    <td>${escapeHtml(row.segmento_ia || 'sin clasificar')}</td>
                    <td>${escapeHtml(row.razon_breve || '')}</td>
                    <td>${escapeHtml(row.accion_recomendada || '')}</td>
                    <td>${escapeHtml(row.estado || '')}</td>
                </tr>
            `).join('');
        }

        document.addEventListener('DOMContentLoaded', async () => {
            const clientes = <?php echo $dataset_ia_json; ?>;

            const segmentationQuestion = `Analiza esta cartera de clientes y propón una segmentación útil para negocio.

La fecha actual REAL del sistema, proporcionada por PHP, es: <?php echo $fecha_actual; ?>.
El año actual REAL del sistema es: <?php echo $anio_actual; ?>.

No uses tu fecha interna de entrenamiento.
Debes basarte únicamente en la fecha real proporcionada arriba.

Resumen local previo:
- Regulares: <?php echo $conteo_regulares; ?>
- Inactivos: <?php echo $conteo_inactivos; ?>
- Crecientes: <?php echo $conteo_crecientes; ?>
- Decrecientes: <?php echo $conteo_decrecientes; ?>
- Esporádicos: <?php echo $conteo_esporadicos; ?>
- Ocasionales: <?php echo $conteo_ocasionales; ?>
- Sin compras: <?php echo $conteo_sin_compras; ?>

Dataset completo:
${JSON.stringify(clientes)}

Responde en markdown.

Quiero:
1. Una propuesta de segmentos útil para negocio.
2. Definición breve de cada segmento.
3. Riesgos y oportunidades por segmento.
4. Qué acciones comerciales convienen por segmento.`;

            try {
                const segmentationText = await fetchAIText(segmentationQuestion);
                renderMarkdownIntoElement('ai-segmentation', segmentationText);
            } catch (error) {
                document.getElementById('ai-segmentation').innerHTML = `<p style="color:red;">Error al obtener propuesta de segmentación: ${escapeHtml(error.message)}</p>`;
            }

            const groups = {};
            const classificationRows = [];

            for (let i = 0; i < clientes.length; i++) {
                const c = clientes[i];

                classificationRows.push({
                    cliente_id: c.cliente_id,
                    cliente_nombre: c.cliente_nombre,
                    segmento_ia: '',
                    razon_breve: '',
                    accion_recomendada: '',
                    estado: `Pendiente (${i + 1}/${clientes.length})`
                });
                renderClassificationRows(classificationRows);

                const classificationQuestion = `Clasifica este cliente en un único segmento de negocio.

Fecha actual REAL del sistema: <?php echo $fecha_actual; ?>
Año actual REAL del sistema: <?php echo $anio_actual; ?>

No uses tu fecha interna de entrenamiento.

Cliente:
${JSON.stringify(c)}

Segmentos sugeridos que puedes usar si encajan:
- regular
- inactivo
- creciente
- decreciente
- esporadico
- ocasional
- sin compras

Si ninguno encaja bien, puedes proponer otro segmento corto, pero solo uno.

Responde SOLO en JSON válido, sin markdown, con esta estructura exacta:
{
  "segmento": "nombre del segmento",
  "razon_breve": "explicación muy corta",
  "accion_recomendada": "acción comercial concreta"
}`;

                try {
                    const raw = await fetchAIText(classificationQuestion);
                    const parsed = safeJsonParse(raw);

                    let segmento = 'sin clasificar';
                    let razon = 'No se pudo interpretar la respuesta.';
                    let accion = '';

                    if (parsed && typeof parsed === 'object' && !Array.isArray(parsed)) {
                        segmento = (parsed.segmento || 'sin clasificar').toString().trim() || 'sin clasificar';
                        razon = (parsed.razon_breve || '').toString().trim();
                        accion = (parsed.accion_recomendada || '').toString().trim();
                    }

                    if (!groups[segmento]) {
                        groups[segmento] = [];
                    }

                    groups[segmento].push({
                        cliente_id: c.cliente_id,
                        cliente_nombre: c.cliente_nombre
                    });

                    classificationRows[i] = {
                        cliente_id: c.cliente_id,
                        cliente_nombre: c.cliente_nombre,
                        segmento_ia: segmento,
                        razon_breve: razon,
                        accion_recomendada: accion,
                        estado: 'Clasificado'
                    };

                    renderSegmentGroups(groups);
                    renderClassificationRows(classificationRows);

                } catch (error) {
                    const segmento = 'error de clasificacion';

                    if (!groups[segmento]) {
                        groups[segmento] = [];
                    }

                    groups[segmento].push({
                        cliente_id: c.cliente_id,
                        cliente_nombre: c.cliente_nombre
                    });

                    classificationRows[i] = {
                        cliente_id: c.cliente_id,
                        cliente_nombre: c.cliente_nombre,
                        segmento_ia: segmento,
                        razon_breve: 'Fallo al consultar la IA.',
                        accion_recomendada: '',
                        estado: 'Error'
                    };

                    renderSegmentGroups(groups);
                    renderClassificationRows(classificationRows);
                }
            }
        });
    </script>
</body>
</html>
