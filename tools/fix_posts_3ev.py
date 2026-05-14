#!/usr/bin/env python3
"""Correcciones derivadas de la revisión de los 37 proyectos:

- 009: el contenido real no es un portafolio sino una miniapp PHP+SQLite con
  login/signup/dashboard que genera proyectos web con IA (Ollama). Reescribo
  el post para que coincida con el contenido real.
- 010: el contenido real lee un Google Sheet **publicado como CSV** desde PHP
  (no gspread/OAuth). Reescribo el post.
- 029, 036: carpetas sin contenido real (solo README placeholder). Reescribo
  el post como entrega pendiente sincera, sin inventar.
- Limpieza: borro los README.md "Estado: pendiente de revisión/entrega" de los
  proyectos que sí tienen contenido (029 y 036 lo conservan).
"""

from pathlib import Path

ROOT = Path(__file__).resolve().parents[1] / "Primero" / "Preparación 3ª Evaluación" / "Proyecto intermodular" / "2-mis-proyectos"

POST_TEMPLATE = """# Post divulgativo — {nombre}

> Documento de entrega siguiendo la **rúbrica de evaluación** (4 apartados al 25%):
> Introducción · Desarrollo · Aplicación práctica · Conclusión.
>
> Formato divulgativo: gancho inicial, primera persona, párrafos cortos, emojis moderados y hashtags al final.

---

## 📢 Post

**{hook}**

### 🧭 Introducción y contextualización *(25%)*

{intro}

### 🛠️ Desarrollo detallado y preciso *(25%)*

{desarrollo}

### 🚀 Aplicación práctica *(25%)*

{aplicacion}

### 🎯 Conclusión *(25%)*

{conclusion}

---

{hashtags}

---

### 📋 Checklist de la rúbrica

- [x] Introducción breve y contextualización del problema
- [x] Desarrollo técnico con stack, decisiones y arquitectura
- [x] Aplicación práctica con caso concreto y métricas/resultados
- [x] Conclusión que conecta con otros contenidos del ciclo
- [x] Formato divulgativo (gancho, primera persona, párrafos cortos, hashtags)

> **Ciclo**: 1.º DAM · **Evaluación**: 3.ª · **Módulo**: Proyecto intermodular
"""

PENDING_TEMPLATE = """# Post divulgativo — {nombre}

> ⚠️ **Estado: PENDIENTE DE DESARROLLO**
>
> Este proyecto figura en el listado de la 3.ª evaluación pero todavía no
> tiene contenido en `2-mis-proyectos/`. El post se redactará cuando el
> proyecto esté implementado, siguiendo la **rúbrica de evaluación** (4
> apartados al 25%): Introducción · Desarrollo · Aplicación práctica · Conclusión.

---

## 🗂️ Plan previsto

- **Tema**: {tema}
- **Apuntes de partida**: a recopilar desde el material del profesor.
- **Entregable**: ejercicios + miniproyecto + post divulgativo final.

> Cuando se complete el proyecto, este fichero se reemplazará por el post real
> con los 4 apartados de la rúbrica.

> **Ciclo**: 1.º DAM · **Evaluación**: 3.ª · **Módulo**: Proyecto intermodular
"""

POSTS_CORREGIDOS = {
    "009-Portafolios Serena": (
        "🛠️ Mi generador de proyectos web con IA local (con login y panel propio).",
        "El proyecto **Portafolios Serena** acabó siendo una pequeña aplicación PHP+SQLite donde un usuario registrado puede pedirle a una IA local (Ollama) que le genere proyectos web a medida y guardarlos en su panel personal.",
        "Stack: **PHP** para servidor, **SQLite** para usuarios y proyectos, `auth.php`/`login.php`/`signup.php` para sesiones, `dashboard.php` con CRUD de proyectos (`projects` con `title`, `description`, `last_prompt`, `last_code`) y `run_project.php` que llama a **Ollama** (`qwen2.5-coder:7b`) vía `curl` al endpoint `/api/generate`. Antes del proyecto final hay 6 ejercicios incrementales: llamada en local con `ollama run`, llamada desde PHP con `curl`, afinado del prompt, selección por usuario, mejora visual y formulario desplazable.",
        "Probado en local: registro de usuario → login → desde el dashboard escribo \"Hazme una web sencilla en verde corporativo, solo código\" → Ollama responde el HTML/CSS y se guarda asociado al usuario. Cada alumno puede tener su propio portafolio de proyectos generados.",
        "Lo importante no fue el portafolio en sí, sino aprender a integrar autenticación, persistencia y llamadas a una IA local en una misma app PHP. Es la base para cualquier SaaS pequeño con IA.",
        "#PHP #SQLite #Ollama #IA #Auth #DAM",
    ),
    "010-Drive como base de datos": (
        "📊 Usar un Google Sheet publicado como CSV como base de datos de una tienda.",
        "El proyecto **Drive como base de datos** consiste en tratar una hoja de Google Sheets publicada en la web como si fuera una BD: PHP la descarga como CSV y construye con ella una tienda online.",
        "Pipeline incremental (13 ejercicios): leer CSV con `fopen`+`fgetcsv`, convertirlo a array indexado, luego a array nombrado con `array_combine` y cabeceras, formatear como tienda online, aplicar CSS, añadir lógica JS para el carrito, repaso de envío de correo electrónico desde PHP, uso de variables de entorno con `.env`, lectura de imágenes desde carpeta y, finalmente, tienda completa con imágenes. La URL de origen es `docs.google.com/spreadsheets/.../pub?output=csv` (Google Sheet publicado).",
        "El cliente edita su catálogo directamente en Google Sheets (productos, precios, stock) y la tienda PHP refleja los cambios en tiempo real. Ideal para pymes que ya viven en Sheets y no quieren panel de admin propio.",
        "Aprendí que para muchos catálogos pequeños no hace falta MySQL ni gspread con OAuth: un Sheet público + `fgetcsv` resuelve el caso con cero infraestructura. Y enlaza directamente con los módulos de bases de datos y de tratamiento de datos.",
        "#PHP #GoogleSheets #CSV #Ecommerce #DAM",
    ),
}

PENDIENTES = {
    "029-API rotation": "rotación de claves API entre varios proveedores (OpenAI, Groq, Together...) para no agotar cuotas gratuitas.",
    "036-MCP ollama Blender": "integración de Blender con Ollama vía Model Context Protocol (MCP) para pilotar el modelado 3D con lenguaje natural.",
}

# Proyectos con contenido real cuyo README.md es solo placeholder y conviene borrar
LIMPIAR_README = ["032-RAG", "033-NaN", "034-Mini powerpoint", "035-Bullets", "037-Creador de esquemas"]


def main():
    cambios = []

    for nombre, (hook, intro, des, apl, conc, tags) in POSTS_CORREGIDOS.items():
        out = ROOT / nombre / "post.md"
        out.write_text(POST_TEMPLATE.format(
            nombre=nombre, hook=hook, intro=intro,
            desarrollo=des, aplicacion=apl, conclusion=conc, hashtags=tags
        ), encoding="utf-8")
        cambios.append(f"  ✏️  reescrito  {out.relative_to(ROOT)}")

    for nombre, tema in PENDIENTES.items():
        out = ROOT / nombre / "post.md"
        out.write_text(PENDING_TEMPLATE.format(nombre=nombre, tema=tema), encoding="utf-8")
        cambios.append(f"  ⚠️  pendiente  {out.relative_to(ROOT)}")

    for nombre in LIMPIAR_README:
        readme = ROOT / nombre / "README.md"
        if readme.is_file():
            txt = readme.read_text(encoding="utf-8", errors="ignore")
            if "Estado: pendiente" in txt:
                readme.unlink()
                cambios.append(f"  🗑️  borrado   {readme.relative_to(ROOT)}")

    for c in cambios:
        print(c)
    print(f"\nTotal cambios: {len(cambios)}")


if __name__ == "__main__":
    main()
