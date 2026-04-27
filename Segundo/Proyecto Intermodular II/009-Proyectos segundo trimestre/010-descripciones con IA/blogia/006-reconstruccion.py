#!/usr/bin/env python3
# -*- coding: utf-8 -*-

"""
posts_md_comercial_es_fixed.py

Versión simplificada que genera posts comerciales sin validaciones estrictas.
Enfoque: generar contenido útil y guardarlo directamente.
"""

from __future__ import annotations

import datetime as dt
import re
import subprocess
import sys
from pathlib import Path
from typing import List

import requests
import urllib3

urllib3.disable_warnings(urllib3.exceptions.InsecureRequestWarning)

# =====================================================
# CONFIGURACIÓN
# =====================================================
PROJECT_FOLDERS: List[str] = [
    "/var/www/html/jocarsa-teal/",
    "/var/www/html/jocarsa-rosybrown/",
    "/var/www/html/jocarsa-salmon/",
    "/var/www/html/jocarsa-darksalmon/",
    "/var/www/html/jocarsa-aliceblue/",
    "/var/www/html/jocarsa-mediumseagreen/",
]

OUTPUT_ROOT: str = (
    "/var/www/html/dam2526/Segundo/Proyecto Intermodular II/"
    "009-Proyectos segundo trimestre/010-descripciones con IA/web/posts"
)

LIGHTGOLDENRODYELLOW: str = "/var/www/html/jocarsa-lightgoldenrodyellow/lightgoldenrodyellow.py"

# API Configuration
API_URL: str = "https://covalently-untasked-d****.ngrok-free.dev/api.php"
API_KEY: str = "TEST_API_KEY_JOCARSA_123"
VERIFY_SSL: bool = False
REMOTE_MODEL: str = "qwen2.5:7b-instruct-q4_0"
API_TIMEOUT: int = 1200

# Límites básicos
MAX_REPORT_CHARS: int = 50000
MAX_API_ATTEMPTS: int = 2

# Metadatos
DEFAULT_CATEGORIES: List[str] = ["Producto", "Gestión", "Procesos"]
DEFAULT_TAGS: List[str] = ["software", "gestión", "empresa", "productividad", "operaciones"]

# =====================================================
# UTILIDADES
# =====================================================
def eprint(*args, **kwargs):
    print(*args, file=sys.stderr, **kwargs)

def read_text(p: Path) -> str:
    return p.read_text(encoding="utf-8", errors="replace")

def save_text(p: Path, s: str) -> None:
    p.parent.mkdir(parents=True, exist_ok=True)
    p.write_text(s, encoding="utf-8", errors="replace")

def normalize_space(s: str) -> str:
    s = (s or "").replace("\r\n", "\n")
    s = re.sub(r"[ \t]+", " ", s)
    s = re.sub(r"\n{3,}", "\n\n", s)
    return s.strip()

def slugify(s: str) -> str:
    s = (s or "").strip().lower()
    s = re.sub(r"[^\w\s-]", "", s, flags=re.UNICODE)
    s = re.sub(r"[\s_-]+", "-", s)
    return s.strip("-") or "producto"

def project_slug_from_path(project_path: Path) -> str:
    name = project_path.name or project_path.parts[-1]
    return slugify(name)

def brand_from_slug(project_slug: str) -> str:
    tail = project_slug.replace("jocarsa-", "").strip()
    return f"jocarsa | {tail}" if tail else "jocarsa"

# =====================================================
# LIGHTGOLDENRODYELLOW
# =====================================================
def run_lightgoldenrodyellow(project_path: Path, out_dir: Path, light_path: str) -> Path:
    lp = Path(light_path)
    if not lp.exists():
        raise FileNotFoundError(f"No existe lightgoldenrodyellow.py en: {lp}")

    out_dir.mkdir(parents=True, exist_ok=True)

    cmd = ["python3", str(lp), str(project_path), str(out_dir)]
    proc = subprocess.run(cmd, capture_output=True, text=True)

    if proc.returncode != 0:
        raise RuntimeError(
            "lightgoldenrodyellow falló.\n"
            f"STDOUT:\n{proc.stdout}\n\nSTDERR:\n{proc.stderr}"
        )

    # Buscar el archivo .md generado
    m = re.search(r"^\[OK\]\s+Reporte generado:\s+(.*\.md)\s*$", proc.stdout, flags=re.MULTILINE)
    if m:
        rp = Path(m.group(1).strip()).expanduser()
        if rp.exists():
            return rp

    mm = re.search(r"(/[^ \n\r\t]+\.md)\b", proc.stdout)
    if mm:
        rp = Path(mm.group(1).strip()).expanduser()
        if rp.exists():
            return rp

    raise RuntimeError(f"No se pudo detectar la ruta del reporte en STDOUT:\n{proc.stdout}")

# =====================================================
# API REMOTA
# =====================================================
def call_remote_api(question: str) -> str:
    try:
        resp = requests.post(
            API_URL,
            headers={"X-API-Key": API_KEY},
            data={"question": question, "model": REMOTE_MODEL},
            timeout=API_TIMEOUT,
            verify=VERIFY_SSL,
        )

        if resp.status_code != 200:
            raise RuntimeError(f"API HTTP {resp.status_code}: {resp.text[:2000]}")

        ctype = (resp.headers.get("Content-Type") or "").lower()

        if "application/json" in ctype:
            try:
                data = resp.json()
                ans = data.get("answer")
                if isinstance(ans, str) and ans.strip():
                    return ans.strip()
                
                for k in ("response", "text", "content", "output"):
                    v = data.get(k)
                    if isinstance(v, str) and v.strip():
                        return v.strip()
            except Exception:
                pass

        return resp.text.strip()
    
    except Exception as e:
        eprint(f"Error en API: {e}")
        raise

# =====================================================
# PROMPT MEJORADO - ENFOQUE COMERCIAL
# =====================================================
def create_commercial_prompt(project_slug: str, date_iso: str, report_md: str) -> str:
    brand = brand_from_slug(project_slug)
    return f"""
Eres un copywriter experto en contenido comercial para blogs B2B de software empresarial.

IMPORTANTE: Este NO es un artículo técnico. Es un artículo COMERCIAL dirigido a dueños de empresas, gerentes y emprendedores que necesitan soluciones para sus problemas del día a día.

PRODUCTO: "{brand}"
AUDIENCIA: Empresarios, autónomos, gerentes que NO son técnicos
OBJETIVO: Que identifiquen SUS problemas reales y vean cómo este software les ayuda en su DÍA A DÍA

ESCRIBE UN ARTÍCULO COMERCIAL QUE:

1. EMPIECE CON UN ESCENARIO REAL Y COMÚN:
   - "Son las 8 de la noche del viernes y sigues buscando aquella factura de marzo..."
   - "Tu cliente pregunta por el estado de su presupuesto y tardas 20 minutos en encontrarlo..."
   - "Final de mes: hora de cuadrar gastos y te das cuenta de que faltan comprobantes..."
   
2. IDENTIFIQUE EL DOLOR COTIDIANO:
   - Pérdida de tiempo buscando documentos
   - Errores en facturación que cuestan dinero
   - Clientes que esperan respuestas rápidas
   - Desorden que genera estrés
   - Falta de control sobre el negocio

3. MUESTRE LAS CONSECUENCIAS REALES:
   - Horas perdidas cada semana
   - Clientes insatisfechos que se van
   - Dinero que se pierde por errores
   - Estrés innecesario
   - Imposibilidad de crecer

4. PRESENTE LA SOLUCIÓN DE FORMA PRÁCTICA:
   - Cómo sería tu día con esta herramienta
   - Situaciones concretas resueltas
   - Tiempo que ahorras
   - Tranquilidad que ganas

5. USA UN LENGUAJE CERCANO Y EMPRESARIAL:
   - Habla de "tu negocio", "tu tiempo", "tus clientes"
   - Usa ejemplos del mundo real
   - Evita jerga técnica
   - Sé directo y honesto

PROHIBIDO ABSOLUTAMENTE:
- NO menciones código, PHP, MySQL, JavaScript, tablas, campos, bases de datos
- NO uses términos como "backend", "frontend", "API", "script"
- NO expliques cómo funciona técnicamente
- NO hagas listas de características técnicas
- NO uses bloques de código con ```
- NO escribas "The script initializes..." o similar
- NO menciones "Primary Key", "Foreign Key", "SQL"

EN SU LUGAR, HABLA DE:
- Beneficios prácticos: "encuentra cualquier factura en segundos"
- Ahorro de tiempo: "lo que antes tomaba 30 minutos ahora toma 2"
- Reducción de errores: "nunca más envíes una factura con el precio equivocado"
- Paz mental: "sabes exactamente dónde está todo"
- Control: "visualiza tu negocio de un vistazo"

ESTRUCTURA:
- Título atractivo y práctico (# al inicio)
- Introducción: escenario problemático (3-4 párrafos)
- ¿Te suena familiar? (señales de alerta en lista)
- El costo real de la desorganización
- Cómo debería ser tu día (solución práctica)
- Lo que ganas (beneficios concretos)
- Conclusión con invitación suave

EXTENSIÓN: 900-1300 palabras
IDIOMA: Español
TONO: Profesional pero cercano, como hablarías con un colega empresario

INFORMACIÓN TÉCNICA DEL PRODUCTO (tradúcela a beneficios prácticos):
\"\"\"
{report_md}
\"\"\"

Recuerda: Tu lector es un empresario ocupado, no un programador. Háblale de SUS problemas y cómo esta herramienta hace su VIDA más fácil.

RESPONDE SOLO CON EL ARTÍCULO EN MARKDOWN. Sin explicaciones adicionales. Sin bloques de código. Solo el contenido del blog.
""".strip()

# =====================================================
# PROCESAMIENTO DE MARKDOWN
# =====================================================
def clean_markdown(raw: str) -> str:
    """Limpia el markdown de la respuesta de la API"""
    md = (raw or "").strip()
    
    # Remover bloques de código markdown si existen
    if md.startswith("```"):
        md = re.sub(r"^```[a-zA-Z0-9_-]*\n?", "", md)
        md = re.sub(r"\n?```$", "", md)
    
    # Remover cualquier ``` interno
    md = md.replace("```markdown", "").replace("```", "")
    
    # Remover términos técnicos problemáticos comunes
    technical_phrases = [
        r"The script (initializes|creates|handles)",
        r"This file (manages|processes)",
        r"Backend development",
        r"Frontend configuration",
        r"Primary Key",
        r"Foreign Key",
        r"SQL queries",
    ]
    
    for phrase in technical_phrases:
        md = re.sub(phrase, "", md, flags=re.IGNORECASE)
    
    return md.strip()

def ensure_h1_title(md: str, fallback_title: str) -> str:
    """Asegura que el markdown comience con un H1"""
    s = md.lstrip()
    if s.startswith("# "):
        return md
    return f"# {fallback_title}\n\n{md}".strip()

def extract_title(md: str, fallback: str) -> str:
    """Extrae el título del markdown"""
    for ln in (md or "").splitlines():
        t = ln.strip()
        if t.startswith("# "):
            v = normalize_space(t[2:])
            return (v[:140] if v else fallback)
    return fallback[:140]

def extract_excerpt(md: str, max_len: int = 220) -> str:
    """Extrae un excerpt del contenido"""
    lines = [l.strip() for l in (md or "").splitlines()]
    buf: List[str] = []
    for l in lines:
        if not l or l.startswith("#"):
            continue
        if l.startswith(("-", "* ")):
            buf.append(l.lstrip("-* ").strip())
        else:
            buf.append(l)
        if len(" ".join(buf)) >= max_len:
            break
    ex = normalize_space(" ".join(buf))
    return ex[:max_len] or "Descubre cómo hacer más fácil la gestión diaria de tu empresa."

def yaml_list(items: List[str]) -> str:
    """Genera lista YAML para front matter"""
    esc = []
    for it in items:
        it = normalize_space(it).replace('"', '\\"')
        esc.append(f'"{it}"')
    return "[" + ", ".join(esc) + "]"

def build_front_matter(title: str, date_iso: str, categories: List[str], tags: List[str], excerpt: str) -> str:
    """Construye el front matter YAML"""
    title = normalize_space(title).replace('"', '\\"')
    excerpt = normalize_space(excerpt).replace('"', '\\"')
    return (
        "---\n"
        f'title: "{title}"\n'
        f'date: "{date_iso}"\n'
        f"categories: {yaml_list(categories)}\n"
        f"tags: {yaml_list(tags)}\n"
        f'excerpt: "{excerpt}"\n'
        "---\n\n"
    )

# =====================================================
# GENERACIÓN DEL POST
# =====================================================
def generate_post_for_project(project_slug: str, report_md: str) -> str:
    """Genera el post comercial para un proyecto"""
    report_md = normalize_space(report_md)
    if len(report_md) > MAX_REPORT_CHARS:
        report_md = report_md[:MAX_REPORT_CHARS]

    date_iso = dt.date.today().isoformat()
    fallback_title = f"Cómo {brand_from_slug(project_slug)} Simplifica tu Día a Día Empresarial"

    # Intentar generar el contenido
    for attempt in range(1, MAX_API_ATTEMPTS + 1):
        try:
            eprint(f"   >> Intento {attempt}/{MAX_API_ATTEMPTS} generando contenido...")
            
            prompt = create_commercial_prompt(project_slug, date_iso, report_md)
            raw = call_remote_api(prompt)
            
            # Limpiar y procesar
            md = clean_markdown(raw)
            md = ensure_h1_title(md, fallback_title)
            
            # Verificación mínima: que tenga algo de contenido
            if len(md) < 300:
                eprint(f"   !! Contenido muy corto ({len(md)} chars), reintentando...")
                continue
            
            # Extraer metadatos
            title = extract_title(md, fallback_title)
            excerpt = extract_excerpt(md, 220)
            
            # Construir documento final
            front = build_front_matter(title, date_iso, DEFAULT_CATEGORIES, DEFAULT_TAGS, excerpt)
            final = front + md.strip() + "\n"
            
            eprint(f"   >> ✓ Contenido generado: {len(final)} chars, título: {title[:60]}...")
            return final
            
        except Exception as e:
            eprint(f"   !! Error en intento {attempt}: {e}")
            if attempt == MAX_API_ATTEMPTS:
                raise

    # Fallback si todo falla
    eprint("   !! Usando contenido fallback...")
    title = fallback_title
    excerpt = "Descubre cómo simplificar la gestión diaria de tu negocio."
    front = build_front_matter(title, date_iso, DEFAULT_CATEGORIES, DEFAULT_TAGS, excerpt)
    content = f"""# {title}

## Cuando el Desorden Cuesta Tiempo y Dinero

Son las 19:30 de un miércoles cualquiera. Tu cliente te llama preguntando por el estado de su factura de hace dos meses. Abres el ordenador, revisas carpetas, buscas en el email, preguntas a tu compañero... Veinte minutos después, encuentras el documento. Tu cliente ha esperado, tú has perdido tiempo valioso, y esa sensación de descontrol te acompaña el resto del día.

Esta escena se repite en miles de empresas cada día. No porque los empresarios sean desorganizados, sino porque las herramientas tradicionales (hojas de cálculo, carpetas dispersas, notas en papel) no están diseñadas para el ritmo actual de los negocios.

## Las Señales de Alerta

¿Te identificas con alguna de estas situaciones?

- Tardas más de 5 minutos en encontrar una factura específica
- Has enviado alguna vez un presupuesto con datos incorrectos
- No sabes con certeza qué clientes tienen pagos pendientes
- Pierdes tiempo rehaciendo cálculos que ya hiciste antes
- Te resulta difícil obtener una visión clara de tus ingresos y gastos
- Dependes de tu memoria para recordar detalles importantes

Si has asentido aunque sea una vez, estás perdiendo más de lo que crees.

## El Costo Real

Cada minuto buscando un documento es un minuto que no dedicas a hacer crecer tu negocio. Cada error en una factura puede significar la pérdida de un cliente. Cada presupuesto que tardas en enviar es una oportunidad para que tu competencia llegue antes.

Pero el mayor costo es invisible: el estrés constante de no tener control total sobre tu negocio. Esa sensación de que algo se te escapa, de que no puedes confiar plenamente en tus datos, de que necesitas "acordarte" de todo en lugar de tener un sistema que lo registre por ti.

## Una Forma Mejor de Trabajar

Imagina comenzar tu día sabiendo exactamente dónde está cada documento. Tu cliente llama preguntando por su factura, y en menos de 10 segundos la tienes frente a ti. Necesitas enviar un presupuesto y toda la información del cliente, los productos y los precios están a un clic de distancia. Al final del mes, no pierdes un día entero organizando papeles: toda la información está ya ordenada y lista para consultar.

Esta es la diferencia entre trabajar con herramientas del pasado y contar con un sistema diseñado para las necesidades reales de tu empresa.

## Lo Que Ganas es Más Que Tiempo

Cuando tienes un sistema que funciona, ganas tres cosas fundamentales:

**Control**: Sabes en todo momento qué facturas están pendientes, qué presupuestos has enviado, qué gastos has tenido. No dependes de tu memoria ni de carpetas desordenadas.

**Profesionalidad**: Respondes a tus clientes en segundos, no en minutos u horas. Tus documentos son consistentes y están siempre actualizados. Transmites confianza.

**Tranquilidad**: Acabas tu jornada laboral sabiendo que todo está en su sitio, que nada se ha perdido, que mañana podrás empezar donde lo dejaste sin perder tiempo buscando o recordando.

## Da el Siguiente Paso

La gestión eficiente de tu negocio no debería ser un dolor de cabeza. Herramientas como {brand_from_slug(project_slug)} están diseñadas precisamente para eso: para que dediques tu energía a lo que realmente importa, mientras el sistema se encarga del orden y el control.

No se trata de tecnología por tecnología. Se trata de recuperar tu tiempo, reducir el estrés y trabajar con la confianza de que todo está bajo control.
"""
    return front + content

# =====================================================
# PROCESAMIENTO POR PROYECTO
# =====================================================
def process_one_project(project_path: Path, output_root: Path) -> None:
    """Procesa un proyecto completo"""
    ts = dt.datetime.now().strftime("%Y%m%d%H%M%S")
    slug = project_slug_from_path(project_path)
    out_dir = output_root / slug
    out_dir.mkdir(parents=True, exist_ok=True)

    eprint(f"\n{'='*60}")
    eprint(f"PROYECTO: {slug}")
    eprint(f"{'='*60}")
    eprint(f"Ruta: {project_path}")
    eprint(f"Output: {out_dir}")

    # Generar reporte técnico
    eprint(f"\n>> Paso 1: Generando reporte técnico...")
    report_path = run_lightgoldenrodyellow(project_path, out_dir, LIGHTGOLDENRODYELLOW)
    report_text = read_text(report_path)
    eprint(f"   ✓ Reporte: {report_path.name} ({len(report_text):,} caracteres)")

    # Generar post comercial
    eprint(f"\n>> Paso 2: Generando post comercial...")
    final_md = generate_post_for_project(slug, report_text)

    # Guardar resultado
    out_md = out_dir / f"{slug}_{ts}.md"
    save_text(out_md, final_md)

    eprint(f"\n{'='*60}")
    eprint(f"✓ POST GENERADO EXITOSAMENTE")
    eprint(f"{'='*60}")
    eprint(f"Archivo: {out_md}")
    eprint(f"Tamaño: {len(final_md):,} caracteres")
    print(f"[OK] {slug}: {out_md}")

# =====================================================
# MAIN
# =====================================================
def main():
    eprint("\n" + "="*60)
    eprint("GENERADOR DE POSTS COMERCIALES")
    eprint("="*60)
    
    output_root = Path(OUTPUT_ROOT).expanduser().resolve()
    output_root.mkdir(parents=True, exist_ok=True)
    
    eprint(f"\nDirectorio de salida: {output_root}")
    eprint(f"API: {API_URL}")
    eprint(f"Modelo: {REMOTE_MODEL}")

    ok = skip = err = 0
    
    for p in PROJECT_FOLDERS:
        project_path = Path(p).expanduser().resolve()
        try:
            if not project_path.exists() or not project_path.is_dir():
                eprint(f"\n[SKIP] No existe: {project_path}")
                skip += 1
                continue
            
            process_one_project(project_path, output_root)
            ok += 1
            
        except Exception as ex:
            err += 1
            eprint(f"\n[ERROR] {project_path.name}: {ex}")
            import traceback
            traceback.print_exc()

    # Resumen final
    eprint("\n" + "="*60)
    eprint("RESUMEN DE EJECUCIÓN")
    eprint("="*60)
    eprint(f"✓ Exitosos: {ok}")
    eprint(f"⊘ Omitidos: {skip}")
    eprint(f"✗ Errores:  {err}")
    eprint("="*60 + "\n")
    
    if err > 0:
        sys.exit(1)

if __name__ == "__main__":
    main()
