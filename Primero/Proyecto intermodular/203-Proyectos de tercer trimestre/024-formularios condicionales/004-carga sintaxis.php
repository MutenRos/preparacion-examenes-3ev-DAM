<?php
function normalizarNombre($texto) {
    $texto = mb_strtolower($texto, 'UTF-8');
    $texto = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $texto);
    $texto = preg_replace('/[^a-z0-9]+/', '_', $texto);
    $texto = trim($texto, '_');
    return $texto;
}

function contarTabs($linea) {
    preg_match('/^\t*/', $linea, $coincidencias);
    return strlen($coincidencias[0]);
}

function parsearBloque(&$lineas, &$i, $nivel = 0, $prefijo = '') {
    $estructura = [];

    while ($i < count($lineas)) {
        $lineaOriginal = rtrim($lineas[$i], "\r\n");
        if (trim($lineaOriginal) === '') {
            $i++;
            continue;
        }

        $nivelActual = contarTabs($lineaOriginal);
        $linea = trim($lineaOriginal);

        if ($nivelActual < $nivel) {
            break;
        }

        if ($nivelActual > $nivel) {
            $i++;
            continue;
        }

        if (preg_match('/^\[text\]\s*(.+)$/', $linea, $m)) {
            $etiqueta = trim($m[1]);
            $estructura[] = [
                'tipo' => 'text',
                'etiqueta' => $etiqueta,
                'name' => normalizarNombre($prefijo . '_' . $etiqueta)
            ];
        } elseif (preg_match('/^\[number\]\s*(.+)$/', $linea, $m)) {
            $etiqueta = trim($m[1]);
            $estructura[] = [
                'tipo' => 'number',
                'etiqueta' => $etiqueta,
                'name' => normalizarNombre($prefijo . '_' . $etiqueta)
            ];
        } elseif (preg_match('/^\[radio\]\s*(.+)$/', $linea, $m)) {
            $etiqueta = trim($m[1]);
            $nombreRadio = normalizarNombre($prefijo . '_' . $etiqueta);

            $radio = [
                'tipo' => 'radio',
                'etiqueta' => $etiqueta,
                'name' => $nombreRadio,
                'opciones' => []
            ];

            $i++;

            while ($i < count($lineas)) {
                $sublineaOriginal = rtrim($lineas[$i], "\r\n");
                if (trim($sublineaOriginal) === '') {
                    $i++;
                    continue;
                }

                $subnivel = contarTabs($sublineaOriginal);
                $sublinea = trim($sublineaOriginal);

                if ($subnivel < $nivel + 1) {
                    break;
                }

                if ($subnivel == $nivel + 1 && preg_match('/^\[case\]\s*(.+)$/', $sublinea, $m2)) {
                    $valor = trim($m2[1]);
                    $i++;

                    $hijos = parsearBloque($lineas, $i, $nivel + 2, $prefijo . '_' . $valor);

                    $radio['opciones'][] = [
                        'valor' => $valor,
                        'hijos' => $hijos
                    ];
                    continue;
                }

                $i++;
            }

            $estructura[] = $radio;
            continue;
        }

        $i++;
    }

    return $estructura;
}

function renderizarCampos($estructura, $grupoPadre = null) {
    $html = '';

    foreach ($estructura as $campo) {
        if ($campo['tipo'] === 'text' || $campo['tipo'] === 'number') {
            $html .= '<div class="campo">';
            $html .= '<label>' . htmlspecialchars($campo['etiqueta']) . '</label>';
            $html .= '<input type="' . htmlspecialchars($campo['tipo']) . '" name="' . htmlspecialchars($campo['name']) . '">';
            $html .= '</div>';
        }

        if ($campo['tipo'] === 'radio') {
            $html .= '<div class="campo">';
            $html .= '<label>' . htmlspecialchars($campo['etiqueta']) . '</label>';

            foreach ($campo['opciones'] as $indice => $opcion) {
                $valorSeguro = htmlspecialchars($opcion['valor']);
                $radioId = $campo['name'] . '_' . $indice;
                $condicionalId = 'condicional_' . md5($campo['name'] . '_' . $opcion['valor']);

                $html .= '<div class="opcion-radio">';
                $html .= '<label>';
                $html .= '<input type="radio" name="' . htmlspecialchars($campo['name']) . '" value="' . $valorSeguro . '" data-target="' . $condicionalId . '"> ';
                $html .= $valorSeguro;
                $html .= '</label>';
                $html .= '</div>';

                $html .= '<div class="condicional" id="' . $condicionalId . '" data-group="' . htmlspecialchars($campo['name']) . '">';
                $html .= renderizarCampos($opcion['hijos'], $campo['name']);
                $html .= '</div>';
            }

            $html .= '</div>';
        }
    }

    return $html;
}

$archivo = '003-me invento sintaxis.md';
$contenido = file_exists($archivo) ? file($archivo) : [];
$i = 0;
$estructura = parsearBloque($contenido, $i, 0, 'campo');
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Formulario dinámico condicional</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        form {
            max-width: 800px;
        }
        .campo {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            max-width: 400px;
            padding: 8px;
            box-sizing: border-box;
        }
        .opcion-radio label {
            font-weight: normal;
            display: inline-block;
            margin-bottom: 6px;
        }
        .condicional {
            display: none;
            margin-left: 25px;
            padding-left: 15px;
            border-left: 3px solid #cccccc;
            margin-top: 8px;
            margin-bottom: 12px;
        }
    </style>
</head>
<body>

    <h1>Formulario generado desde plantilla</h1>

    <form method="post" action="">
        <?php echo renderizarCampos($estructura); ?>
        <button type="submit">Enviar</button>
    </form>

    <script>
        function ocultarCondicionalesDelGrupo(nombreGrupo) {
            document.querySelectorAll('.condicional[data-group="' + nombreGrupo + '"]').forEach(function(bloque) {
                bloque.style.display = 'none';

                bloque.querySelectorAll('input[type="radio"]').forEach(function(radio) {
                    radio.checked = false;
                });

                bloque.querySelectorAll('.condicional').forEach(function(subbloque) {
                    subbloque.style.display = 'none';
                });
            });
        }

        document.querySelectorAll('input[type="radio"][data-target]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                const nombreGrupo = this.name;
                const destino = this.dataset.target;

                ocultarCondicionalesDelGrupo(nombreGrupo);

                const bloque = document.getElementById(destino);
                if (bloque) {
                    bloque.style.display = 'block';
                }
            });
        });
    </script>

</body>
</html>
