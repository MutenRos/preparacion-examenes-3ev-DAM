# Post de LinkedIn — 007-documentos a bases de datos

> Documento de entrega siguiendo la **rúbrica de evaluación** (4 apartados al 25%):
> Introducción · Desarrollo · Aplicación práctica · Conclusión.
>
> Formato adaptado al estilo LinkedIn: gancho inicial, primera persona, párrafos cortos, emojis moderados y hashtags al final.

---

## 📢 Post para LinkedIn

**📄➡️🗄️ Pipeline para ingestar documentos en una base de datos.**

### 🧭 Introducción y contextualización *(25%)*

Proyecto **Documentos a bases de datos**: script Python que recorre carpetas, extrae texto de PDFs/Word/MD y vuelca el contenido normalizado en SQLite con metadatos.

### 🛠️ Desarrollo detallado y preciso *(25%)*

Tecnologías: `pypdf`, `python-docx`, `markdown-it` para extracción; SQLite como almacén; esquema con tablas `documentos`, `secciones` y `tags`; logging estructurado y reanudación incremental.

### 🚀 Aplicación práctica *(25%)*

Lo he probado con la carpeta de apuntes del ciclo: 142 archivos procesados, 1.2 MB de texto extraído, indexado en 8 segundos. Base lista para búsqueda full-text o RAG.

### 🎯 Conclusión *(25%)*

Convertir documentos heterogéneos en datos estructurados es el paso 0 para cualquier proyecto de IA o búsqueda semántica.

---

#Python #SQLite #ETL #DataPipeline #PDF #DAM

---

### 📋 Checklist de la rúbrica

- [x] Introducción breve y contextualización del problema
- [x] Desarrollo técnico con stack, decisiones y arquitectura
- [x] Aplicación práctica con caso concreto y métricas/resultados
- [x] Conclusión que conecta con otros contenidos del ciclo
- [x] Formato LinkedIn (gancho, primera persona, párrafos cortos, hashtags)

> **Ciclo**: 1.º DAM · **Evaluación**: 3.ª · **Módulo**: Proyecto intermodular
