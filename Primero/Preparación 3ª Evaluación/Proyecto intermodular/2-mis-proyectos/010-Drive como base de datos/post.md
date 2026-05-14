# Post divulgativo — 010-Drive como base de datos

> Documento de entrega siguiendo la **rúbrica de evaluación** (4 apartados al 25%):
> Introducción · Desarrollo · Aplicación práctica · Conclusión.
>
> Formato divulgativo: gancho inicial, primera persona, párrafos cortos, emojis moderados y hashtags al final.

---

## 📢 Post

**📊 Usar un Google Sheet publicado como CSV como base de datos de una tienda.**

### 🧭 Introducción y contextualización *(25%)*

El proyecto **Drive como base de datos** consiste en tratar una hoja de Google Sheets publicada en la web como si fuera una BD: PHP la descarga como CSV y construye con ella una tienda online.

### 🛠️ Desarrollo detallado y preciso *(25%)*

Pipeline incremental (13 ejercicios): leer CSV con `fopen`+`fgetcsv`, convertirlo a array indexado, luego a array nombrado con `array_combine` y cabeceras, formatear como tienda online, aplicar CSS, añadir lógica JS para el carrito, repaso de envío de correo electrónico desde PHP, uso de variables de entorno con `.env`, lectura de imágenes desde carpeta y, finalmente, tienda completa con imágenes. La URL de origen es `docs.google.com/spreadsheets/.../pub?output=csv` (Google Sheet publicado).

### 🚀 Aplicación práctica *(25%)*

El cliente edita su catálogo directamente en Google Sheets (productos, precios, stock) y la tienda PHP refleja los cambios en tiempo real. Ideal para pymes que ya viven en Sheets y no quieren panel de admin propio.

### 🎯 Conclusión *(25%)*

Aprendí que para muchos catálogos pequeños no hace falta MySQL ni gspread con OAuth: un Sheet público + `fgetcsv` resuelve el caso con cero infraestructura. Y enlaza directamente con los módulos de bases de datos y de tratamiento de datos.

---

#PHP #GoogleSheets #CSV #Ecommerce #DAM

---

### 📋 Checklist de la rúbrica

- [x] Introducción breve y contextualización del problema
- [x] Desarrollo técnico con stack, decisiones y arquitectura
- [x] Aplicación práctica con caso concreto y métricas/resultados
- [x] Conclusión que conecta con otros contenidos del ciclo
- [x] Formato divulgativo (gancho, primera persona, párrafos cortos, hashtags)

> **Ciclo**: 1.º DAM · **Evaluación**: 3.ª · **Módulo**: Proyecto intermodular
