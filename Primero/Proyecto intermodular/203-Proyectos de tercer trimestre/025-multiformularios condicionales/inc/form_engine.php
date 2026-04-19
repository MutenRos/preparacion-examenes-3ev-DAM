<?php
declare(strict_types=1);

function fe_normalize_name(string $text): string {
    $text = mb_strtolower($text, 'UTF-8');
    $text = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text);
    if ($text === false) {
        $text = strtolower($text);
    }
    $text = preg_replace('/[^a-z0-9]+/', '_', $text);
    $text = trim((string)$text, '_');
    if ($text === '') {
        $text = 'campo_' . uniqid();
    }
    return $text;
}

function fe_count_tabs(string $line): int {
    preg_match('/^\t*/', $line, $m);
    return strlen($m[0] ?? '');
}

function fe_extract_tags(string $line): array {
    preg_match_all('/\[(.*?)\]/', $line, $matches);
    return $matches[1] ?? [];
}

function fe_extract_text(string $line): string {
    return trim((string)preg_replace('/\[(.*?)\]/', '', $line));
}

function fe_is_field_type(string $tag): bool {
    return in_array($tag, ['text', 'number', 'email', 'date', 'textarea', 'radio', 'select', 'checkbox'], true);
}

function fe_create_simple_field(string $type, string $label, string $prefix, bool $required = false): array {
    return [
        'tipo' => $type,
        'etiqueta' => $label,
        'name' => fe_normalize_name($prefix . '_' . $label),
        'required' => $required
    ];
}

function fe_parse_block(array &$lines, int &$i, int $level = 0, string $prefix = 'campo'): array {
    $structure = [];

    while ($i < count($lines)) {
        $raw = rtrim($lines[$i], "\r\n");
        if (trim($raw) === '') {
            $i++;
            continue;
        }

        $currentLevel = fe_count_tabs($raw);
        if ($currentLevel < $level) {
            break;
        }
        if ($currentLevel > $level) {
            $i++;
            continue;
        }

        $line = trim($raw);
        $tags = fe_extract_tags($line);
        $text = fe_extract_text($line);

        $required = in_array('required', $tags, true);
        $mainType = null;

        foreach ($tags as $tag) {
            if (fe_is_field_type($tag)) {
                $mainType = $tag;
                break;
            }
        }

        if (in_array($mainType, ['text', 'number', 'email', 'date', 'textarea'], true)) {
            $structure[] = fe_create_simple_field($mainType, $text, $prefix, $required);
            $i++;
            continue;
        }

        if (in_array($mainType, ['radio', 'select', 'checkbox'], true)) {
            $fieldName = fe_normalize_name($prefix . '_' . $text);

            $field = [
                'tipo' => $mainType,
                'etiqueta' => $text,
                'name' => $fieldName,
                'required' => $required,
                'opciones' => []
            ];

            $i++;

            while ($i < count($lines)) {
                $subRaw = rtrim($lines[$i], "\r\n");
                if (trim($subRaw) === '') {
                    $i++;
                    continue;
                }

                $subLevel = fe_count_tabs($subRaw);
                $subLine = trim($subRaw);

                if ($subLevel < $level + 1) {
                    break;
                }

                if ($subLevel === $level + 1 && preg_match('/^\[case\]\s*(.+)$/', $subLine, $m)) {
                    $value = trim($m[1]);
                    $i++;
                    $children = fe_parse_block($lines, $i, $level + 2, $prefix . '_' . $text . '_' . $value);

                    $field['opciones'][] = [
                        'valor' => $value,
                        'hijos' => $children
                    ];
                    continue;
                }

                $i++;
            }

            $structure[] = $field;
            continue;
        }

        $i++;
    }

    return $structure;
}

function fe_parse_markup(string $markup): array {
    $lines = preg_split("/\r\n|\n|\r/", $markup) ?: [];
    $i = 0;
    return fe_parse_block($lines, $i, 0, 'formulario');
}

function fe_attr_required(array $field): string {
    return !empty($field['required']) ? ' required data-required="1"' : '';
}

function fe_render_fields(array $structure, bool $public = true): string {
    $html = '';

    foreach ($structure as $field) {
        $type = $field['tipo'];

        if (in_array($type, ['text', 'number', 'email', 'date'], true)) {
            $html .= '<div class="campo">';
            $html .= '<label>' . htmlspecialchars($field['etiqueta'], ENT_QUOTES, 'UTF-8') . '</label>';
            $html .= '<input type="' . htmlspecialchars($type, ENT_QUOTES, 'UTF-8') . '" name="' . htmlspecialchars($field['name'], ENT_QUOTES, 'UTF-8') . '"' . fe_attr_required($field) . '>';
            $html .= '</div>';
        } elseif ($type === 'textarea') {
            $html .= '<div class="campo">';
            $html .= '<label>' . htmlspecialchars($field['etiqueta'], ENT_QUOTES, 'UTF-8') . '</label>';
            $html .= '<textarea name="' . htmlspecialchars($field['name'], ENT_QUOTES, 'UTF-8') . '"' . fe_attr_required($field) . '></textarea>';
            $html .= '</div>';
        } elseif ($type === 'radio') {
            $html .= '<div class="campo grupo-condicional">';
            $html .= '<label>' . htmlspecialchars($field['etiqueta'], ENT_QUOTES, 'UTF-8') . '</label>';

            foreach ($field['opciones'] as $option) {
                $conditionalId = 'cond_' . md5($field['name'] . '_' . $option['valor']);

                $html .= '<div class="opcion">';
                $html .= '<label class="inline">';
                $html .= '<input type="radio" name="' . htmlspecialchars($field['name'], ENT_QUOTES, 'UTF-8') . '" value="' . htmlspecialchars($option['valor'], ENT_QUOTES, 'UTF-8') . '" data-group="' . htmlspecialchars($field['name'], ENT_QUOTES, 'UTF-8') . '" data-target="' . $conditionalId . '"' . fe_attr_required($field) . '> ';
                $html .= htmlspecialchars($option['valor'], ENT_QUOTES, 'UTF-8');
                $html .= '</label>';
                $html .= '</div>';

                $html .= '<div class="condicional" id="' . $conditionalId . '" data-parent-group="' . htmlspecialchars($field['name'], ENT_QUOTES, 'UTF-8') . '">';
                $html .= fe_render_fields($option['hijos'], $public);
                $html .= '</div>';
            }

            $html .= '</div>';
        } elseif ($type === 'select') {
            $targetMap = [];
            foreach ($field['opciones'] as $option) {
                $targetMap[$option['valor']] = 'cond_' . md5($field['name'] . '_' . $option['valor']);
            }

            $html .= '<div class="campo grupo-condicional">';
            $html .= '<label>' . htmlspecialchars($field['etiqueta'], ENT_QUOTES, 'UTF-8') . '</label>';
            $html .= '<select name="' . htmlspecialchars($field['name'], ENT_QUOTES, 'UTF-8') . '" class="select-condicional" data-group="' . htmlspecialchars($field['name'], ENT_QUOTES, 'UTF-8') . '" data-map=\'' . htmlspecialchars(json_encode($targetMap), ENT_QUOTES, 'UTF-8') . '\'' . fe_attr_required($field) . '>';
            $html .= '<option value="">Selecciona una opción</option>';
            foreach ($field['opciones'] as $option) {
                $html .= '<option value="' . htmlspecialchars($option['valor'], ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($option['valor'], ENT_QUOTES, 'UTF-8') . '</option>';
            }
            $html .= '</select>';

            foreach ($field['opciones'] as $option) {
                $conditionalId = 'cond_' . md5($field['name'] . '_' . $option['valor']);
                $html .= '<div class="condicional" id="' . $conditionalId . '" data-parent-group="' . htmlspecialchars($field['name'], ENT_QUOTES, 'UTF-8') . '">';
                $html .= fe_render_fields($option['hijos'], $public);
                $html .= '</div>';
            }

            $html .= '</div>';
        } elseif ($type === 'checkbox') {
            $html .= '<div class="campo grupo-condicional">';
            $html .= '<label>' . htmlspecialchars($field['etiqueta'], ENT_QUOTES, 'UTF-8') . '</label>';

            foreach ($field['opciones'] as $option) {
                $conditionalId = 'cond_' . md5($field['name'] . '_' . $option['valor']);

                $html .= '<div class="opcion">';
                $html .= '<label class="inline">';
                $html .= '<input type="checkbox" name="' . htmlspecialchars($field['name'], ENT_QUOTES, 'UTF-8') . '[]" value="' . htmlspecialchars($option['valor'], ENT_QUOTES, 'UTF-8') . '" data-target="' . $conditionalId . '"> ';
                $html .= htmlspecialchars($option['valor'], ENT_QUOTES, 'UTF-8');
                $html .= '</label>';
                $html .= '</div>';

                $html .= '<div class="condicional" id="' . $conditionalId . '" data-parent-group="' . htmlspecialchars($field['name'], ENT_QUOTES, 'UTF-8') . '">';
                $html .= fe_render_fields($option['hijos'], $public);
                $html .= '</div>';
            }

            $html .= '</div>';
        }
    }

    return $html;
}

function fe_collect_labels(array $structure, array &$map = []): array {
    foreach ($structure as $field) {
        $map[$field['name']] = $field['etiqueta'];
        if (!empty($field['opciones'])) {
            foreach ($field['opciones'] as $option) {
                if (!empty($option['hijos'])) {
                    fe_collect_labels($option['hijos'], $map);
                }
            }
        }
    }
    return $map;
}

function fe_public_styles(): string {
    return '<style>
    body{font-family:Arial,sans-serif;background:#f4f5f7;margin:0;padding:24px;color:#222}
    .wrap{max-width:900px;margin:0 auto}
    .card{background:#fff;border-radius:14px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,.08)}
    .campo{margin-bottom:18px}
    label{display:block;font-weight:bold;margin-bottom:8px}
    label.inline{display:inline-block;font-weight:normal;margin-bottom:0}
    input[type=text],input[type=number],input[type=email],input[type=date],select,textarea{
      width:100%;padding:10px;box-sizing:border-box;border:1px solid #ccc;border-radius:8px
    }
    textarea{min-height:120px;resize:vertical}
    .opcion{margin-bottom:8px}
    .condicional{display:none;margin-top:10px;margin-bottom:10px;margin-left:25px;padding-left:15px;border-left:3px solid #d0d0d0}
    button{padding:12px 18px;border:0;border-radius:8px;background:#111;color:#fff;cursor:pointer}
    .ok{background:#e7f7e7;border:1px solid #b8e0b8;padding:12px;border-radius:8px}
    .muted{color:#666}
    </style>';
}

function fe_public_script(): string {
    return '<script>
    function fe_markRequired(container, enabled){
        container.querySelectorAll("[data-required=\'1\']").forEach(function(el){
            if(enabled){ el.setAttribute("required","required"); }
            else{ el.removeAttribute("required"); }
        });
    }

    function fe_clearInputs(container){
        container.querySelectorAll("input, select, textarea").forEach(function(el){
            if(el.type === "radio" || el.type === "checkbox"){ el.checked = false; }
            else{ el.value = ""; }
            if(el.classList.contains("select-condicional")){ el.selectedIndex = 0; }
        });
        container.querySelectorAll(".condicional").forEach(function(block){
            block.style.display = "none";
            fe_markRequired(block, false);
        });
    }

    function fe_hideGroup(groupName){
        document.querySelectorAll(\'.condicional[data-parent-group="\' + CSS.escape(groupName) + \'"]\').forEach(function(block){
            fe_clearInputs(block);
            block.style.display = "none";
            fe_markRequired(block, false);
        });
    }

    document.querySelectorAll(\'input[type="radio"][data-target]\').forEach(function(radio){
        radio.addEventListener("change", function(){
            var group = this.dataset.group;
            var target = this.dataset.target;
            fe_hideGroup(group);
            var block = document.getElementById(target);
            if(block){
                block.style.display = "block";
                fe_markRequired(block, true);
            }
        });
    });

    document.querySelectorAll(".select-condicional").forEach(function(select){
        select.addEventListener("change", function(){
            var map = JSON.parse(this.dataset.map);
            var group = this.dataset.group;
            fe_hideGroup(group);
            if(this.value && map[this.value]){
                var block = document.getElementById(map[this.value]);
                if(block){
                    block.style.display = "block";
                    fe_markRequired(block, true);
                }
            }
        });
    });

    document.querySelectorAll(\'input[type="checkbox"][data-target]\').forEach(function(checkbox){
        checkbox.addEventListener("change", function(){
            var target = this.dataset.target;
            var block = document.getElementById(target);
            if(!block) return;
            if(this.checked){
                block.style.display = "block";
                fe_markRequired(block, true);
            }else{
                fe_clearInputs(block);
                block.style.display = "none";
                fe_markRequired(block, false);
            }
        });
    });

    document.querySelectorAll(".condicional").forEach(function(block){
        fe_markRequired(block, false);
    });
    </script>';
}
