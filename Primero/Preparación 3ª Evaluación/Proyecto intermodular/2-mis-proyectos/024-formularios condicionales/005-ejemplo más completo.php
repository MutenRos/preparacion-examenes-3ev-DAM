<?php
function normalizarNombre($texto) {
    $texto = mb_strtolower($texto, 'UTF-8');
    $texto = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $texto);
    $texto = preg_replace('/[^a-z0-9]+/', '_', $texto);
    $texto = trim($texto, '_');
    if ($texto === '') {
        $texto = 'campo_' . uniqid();
    }
    return $texto;
}

function contarTabs($linea) {
    preg_match('/^\t*/', $linea, $m);
    return strlen($m[0]);
}

function extraerEtiquetas($linea) {
    preg_match_all('/\[(.*?)\]/', $linea, $matches);
    return $matches[1];
}

function extraerTextoSinEtiquetas($linea) {
    return trim(preg_replace('/\[(.*?)\]/', '', $linea));
}

function esTipoCampo($tag) {
    return in_array($tag, ['text', 'number', 'email', 'date', 'textarea', 'radio', 'select', 'checkbox']);
}

function crearCampoSimple($tipo, $etiqueta, $prefijo, $required = false) {
    return [
        'tipo' => $tipo,
        'etiqueta' => $etiqueta,
        'name' => normalizarNombre($prefijo . '_' . $etiqueta),
        'required' => $required
    ];
}

function parsearBloque(&$lineas, &$i, $nivel = 0, $prefijo = 'campo') {
    $estructura = [];

    while ($i < count($lineas)) {
        $lineaOriginal = rtrim($lineas[$i], "\r\n");
        if (trim($lineaOriginal) === '') {
            $i++;
            continue;
        }

        $nivelActual = contarTabs($lineaOriginal);
        if ($nivelActual < $nivel) {
            break;
        }
        if ($nivelActual > $nivel) {
            $i++;
            continue;
        }

        $linea = trim($lineaOriginal);
        $tags = extraerEtiquetas($linea);
        $texto = extraerTextoSinEtiquetas($linea);

        $required = in_array('required', $tags);

        $tipoPrincipal = null;
        foreach ($tags as $tag) {
            if (esTipoCampo($tag)) {
                $tipoPrincipal = $tag;
                break;
            }
        }

        if (in_array($tipoPrincipal, ['text', 'number', 'email', 'date', 'textarea'])) {
            $estructura[] = crearCampoSimple($tipoPrincipal, $texto, $prefijo, $required);
            $i++;
            continue;
        }

        if (in_array($tipoPrincipal, ['radio', 'select', 'checkbox'])) {
            $nombreCampo = normalizarNombre($prefijo . '_' . $texto);

            $campo = [
                'tipo' => $tipoPrincipal,
                'etiqueta' => $texto,
                'name' => $nombreCampo,
                'required' => $required,
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

                if ($subnivel == $nivel + 1 && preg_match('/^\[case\]\s*(.+)$/', $sublinea, $m)) {
                    $valor = trim($m[1]);
                    $i++;

                    $hijos = parsearBloque($lineas, $i, $nivel + 2, $prefijo . '_' . $texto . '_' . $valor);

                    $campo['opciones'][] = [
                        'valor' => $valor,
                        'hijos' => $hijos
                    ];
                    continue;
                }

                $i++;
            }

            $estructura[] = $campo;
            continue;
        }

        $i++;
    }

    return $estructura;
}

function atributoRequired($campo) {
    return !empty($campo['required']) ? ' required' : '';
}

function renderizarCampos($estructura) {
    $html = '';

    foreach ($estructura as $campo) {
        $tipo = $campo['tipo'];

        if (in_array($tipo, ['text', 'number', 'email', 'date'])) {
            $html .= '<div class="campo">';
            $html .= '<label>' . htmlspecialchars($campo['etiqueta']) . '</label>';
            $html .= '<input type="' . htmlspecialchars($tipo) . '" name="' . htmlspecialchars($campo['name']) . '"' . atributoRequired($campo) . '>';
            $html .= '</div>';
        }

        elseif ($tipo === 'textarea') {
            $html .= '<div class="campo">';
            $html .= '<label>' . htmlspecialchars($campo['etiqueta']) . '</label>';
            $html .= '<textarea name="' . htmlspecialchars($campo['name']) . '"' . atributoRequired($campo) . '></textarea>';
            $html .= '</div>';
        }

        elseif ($tipo === 'radio') {
            $html .= '<div class="campo grupo-condicional">';
            $html .= '<label>' . htmlspecialchars($campo['etiqueta']) . '</label>';

            foreach ($campo['opciones'] as $indice => $opcion) {
                $condicionalId = 'cond_' . md5($campo['name'] . '_' . $opcion['valor']);

                $html .= '<div class="opcion">';
                $html .= '<label class="inline">';
                $html .= '<input type="radio" name="' . htmlspecialchars($campo['name']) . '" value="' . htmlspecialchars($opcion['valor']) . '" data-group="' . htmlspecialchars($campo['name']) . '" data-target="' . $condicionalId . '"' . atributoRequired($campo) . '> ';
                $html .= htmlspecialchars($opcion['valor']);
                $html .= '</label>';
                $html .= '</div>';

                $html .= '<div class="condicional" id="' . $condicionalId . '" data-parent-group="' . htmlspecialchars($campo['name']) . '">';
                $html .= renderizarCampos($opcion['hijos']);
                $html .= '</div>';
            }

            $html .= '</div>';
        }

        elseif ($tipo === 'select') {
            $targetMap = [];

            foreach ($campo['opciones'] as $opcion) {
                $targetMap[$opcion['valor']] = 'cond_' . md5($campo['name'] . '_' . $opcion['valor']);
            }

            $html .= '<div class="campo grupo-condicional">';
            $html .= '<label>' . htmlspecialchars($campo['etiqueta']) . '</label>';
            $html .= '<select name="' . htmlspecialchars($campo['name']) . '" class="select-condicional" data-group="' . htmlspecialchars($campo['name']) . '" data-map=\'' . htmlspecialchars(json_encode($targetMap), ENT_QUOTES, 'UTF-8') . '\'' . atributoRequired($campo) . '>';
            $html .= '<option value="">Selecciona una opción</option>';

            foreach ($campo['opciones'] as $opcion) {
                $html .= '<option value="' . htmlspecialchars($opcion['valor']) . '">' . htmlspecialchars($opcion['valor']) . '</option>';
            }

            $html .= '</select>';

            foreach ($campo['opciones'] as $opcion) {
                $condicionalId = 'cond_' . md5($campo['name'] . '_' . $opcion['valor']);
                $html .= '<div class="condicional" id="' . $condicionalId . '" data-parent-group="' . htmlspecialchars($campo['name']) . '">';
                $html .= renderizarCampos($opcion['hijos']);
                $html .= '</div>';
            }

            $html .= '</div>';
        }

        elseif ($tipo === 'checkbox') {
            $html .= '<div class="campo grupo-condicional">';
            $html .= '<label>' . htmlspecialchars($campo['etiqueta']) . '</label>';

            foreach ($campo['opciones'] as $indice => $opcion) {
                $condicionalId = 'cond_' . md5($campo['name'] . '_' . $opcion['valor']);

                $html .= '<div class="opcion">';
                $html .= '<label class="inline">';
                $html .= '<input type="checkbox" name="' . htmlspecialchars($campo['name']) . '[]" value="' . htmlspecialchars($opcion['valor']) . '" data-target="' . $condicionalId . '"> ';
                $html .= htmlspecialchars($opcion['valor']);
                $html .= '</label>';
                $html .= '</div>';

                $html .= '<div class="condicional" id="' . $condicionalId . '" data-parent-group="' . htmlspecialchars($campo['name']) . '">';
                $html .= renderizarCampos($opcion['hijos']);
                $html .= '</div>';
            }

            $html .= '</div>';
        }
    }

    return $html;
}

$archivo = '003-me invento sintaxis.md';
$lineas = file_exists($archivo) ? file($archivo) : [];
$i = 0;
$estructura = parsearBloque($lineas, $i, 0, 'formulario');
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Formulario dinámico</title>
<style>
    body{
        font-family:Arial,sans-serif;
        padding:30px;
        background:#f7f7f7;
    }
    form{
        max-width:900px;
        background:white;
        padding:20px;
        border-radius:10px;
        box-shadow:0 2px 10px rgba(0,0,0,0.08);
    }
    .campo{
        margin-bottom:20px;
    }
    label{
        display:block;
        margin-bottom:8px;
        font-weight:bold;
    }
    label.inline{
        display:inline-block;
        font-weight:normal;
        margin-bottom:0;
    }
    input[type="text"],
    input[type="number"],
    input[type="email"],
    input[type="date"],
    select,
    textarea{
        width:100%;
        max-width:500px;
        padding:10px;
        box-sizing:border-box;
        border:1px solid #ccc;
        border-radius:6px;
    }
    textarea{
        min-height:120px;
        resize:vertical;
    }
    .opcion{
        margin-bottom:8px;
    }
    .condicional{
        display:none;
        margin-top:10px;
        margin-bottom:10px;
        margin-left:25px;
        padding-left:15px;
        border-left:3px solid #d0d0d0;
    }
    button{
        padding:12px 18px;
        border:0;
        border-radius:6px;
        background:#222;
        color:white;
        cursor:pointer;
    }
</style>
</head>
<body>

<form method="post" action="">
    <?php echo renderizarCampos($estructura); ?>
    <button type="submit">Enviar</button>
</form>

<script>
function limpiarCamposInternos(contenedor) {
    contenedor.querySelectorAll('input, select, textarea').forEach(function(el) {
        if (el.type === 'radio' || el.type === 'checkbox') {
            el.checked = false;
        } else {
            el.value = '';
        }
    });

    contenedor.querySelectorAll('.condicional').forEach(function(bloque) {
        bloque.style.display = 'none';
    });
}

function ocultarCondicionalesDeGrupo(nombreGrupo) {
    document.querySelectorAll('.condicional[data-parent-group="' + CSS.escape(nombreGrupo) + '"]').forEach(function(bloque) {
        limpiarCamposInternos(bloque);
        bloque.style.display = 'none';
    });
}

document.querySelectorAll('input[type="radio"][data-target]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        const group = this.dataset.group;
        const target = this.dataset.target;

        ocultarCondicionalesDeGrupo(group);

        const bloque = document.getElementById(target);
        if (bloque) {
            bloque.style.display = 'block';
        }
    });
});

document.querySelectorAll('.select-condicional').forEach(function(select) {
    select.addEventListener('change', function() {
        const map = JSON.parse(this.dataset.map);
        const group = this.dataset.group;

        ocultarCondicionalesDeGrupo(group);

        if (this.value && map[this.value]) {
            const bloque = document.getElementById(map[this.value]);
            if (bloque) {
                bloque.style.display = 'block';
            }
        }
    });
});

document.querySelectorAll('input[type="checkbox"][data-target]').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        const target = this.dataset.target;
        const bloque = document.getElementById(target);

        if (!bloque) return;

        if (this.checked) {
            bloque.style.display = 'block';
        } else {
            limpiarCamposInternos(bloque);
            bloque.style.display = 'none';
        }
    });
});
</script>

</body>
</html>
