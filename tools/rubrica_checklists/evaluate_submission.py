#!/usr/bin/env python3
"""
Evaluador ligero de entregas en Markdown según la rúbrica proporcionada.

Comprueba la presencia de las 4 secciones: Introducción, Desarrollo, Aplicación práctica, Conclusión.
Asigna 25% a cada sección y puntúa según longitud y presencia de elementos básicos.

Uso:
  python3 tools/rubrica_checklists/evaluate_submission.py ruta/al/archivo.md

Salida: JSON con desglose por sección y puntuación total (0-10).
"""
import sys
import re
import json
from pathlib import Path

SECTIONS = [
    ('Introducción', 0.25),
    ('Desarrollo', 0.25),
    ('Aplicación práctica', 0.25),
    ('Conclusión', 0.25),
]

MIN_WORDS_PER_SECTION = 40  # heurística: mínimo por sección para considerar 'completo'


def split_sections(text: str):
    # Buscar encabezados por nombre (case-insensitive)
    parts = {}
    # Normalizar saltos
    norm = text.replace('\r\n', '\n')

    # Crear patrón que encuentre los encabezados
    for name, _w in SECTIONS:
        # buscar encabezados Markdown '## Name' o líneas que comienzan con el nombre
        pat = re.compile(r'(^#+\s*' + re.escape(name) + r'.*$)|(^' + re.escape(name) + r'\s*$)', re.IGNORECASE | re.MULTILINE)
        m = pat.search(norm)
        if m:
            start = m.end()
            parts[name] = {'start': start}
    # Ordenar por posición y extraer textos
    ordered = sorted([(v['start'], k) for k, v in parts.items()])
    for i, (pos, name) in enumerate(ordered):
        start = pos
        end = ordered[i+1][0] if i+1 < len(ordered) else len(norm)
        parts[name]['text'] = norm[start:end].strip()

    return {k: v.get('text', '') for k, v in parts.items()}


def score_section(text: str):
    if not text or len(text.strip()) == 0:
        return 0.0, 'Sección ausente o vacía'
    words = len(re.findall(r"\w+", text))
    if words >= MIN_WORDS_PER_SECTION:
        return 1.0, f'Adecuada ({words} palabras)'
    # si tiene al menos 15 palabras se considera parcial
    if words >= 15:
        return 0.6, f'Parcial ({words} palabras)'
    return 0.2, f'Muy corta ({words} palabras)'


def evaluate(text: str):
    sec_texts = split_sections(text)
    results = {}
    total_score = 0.0
    for name, weight in SECTIONS:
        display_name = name
        if name in sec_texts:
            s, note = score_section(sec_texts[name])
        else:
            s, note = 0.0, 'No encontrada'
        section_points = s * weight * 10.0  # 0-10 scaled
        results[display_name] = {
            'peso': weight,
            'score_relativo': s,
            'puntos': round(section_points, 2),
            'comentario': note,
            'words': len(re.findall(r"\w+", sec_texts.get(name, '')))
        }
        total_score += section_points

    total_score = round(total_score, 2)
    return {'total': total_score, 'detalles': results}


def main():
    if len(sys.argv) < 2:
        print('Uso: evaluate_submission.py ruta/al/archivo.md')
        sys.exit(1)
    p = Path(sys.argv[1])
    if not p.exists():
        print('No existe', p)
        sys.exit(1)
    text = p.read_text(encoding='utf-8')
    res = evaluate(text)
    print(json.dumps(res, ensure_ascii=False, indent=2))


if __name__ == '__main__':
    main()
