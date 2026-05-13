# Post de LinkedIn — 030-scrapear web con IA

> Documento de entrega siguiendo la **rúbrica de evaluación** (4 apartados al 25%):
> Introducción · Desarrollo · Aplicación práctica · Conclusión.
>
> Formato adaptado al estilo LinkedIn: gancho inicial, primera persona, párrafos cortos, emojis moderados y hashtags al final.

---

## 📢 Post para LinkedIn

**🧠 Scraping con IA: ya no hace falta escribir selectores CSS.**

### 🧭 Introducción y contextualización *(25%)*

Proyecto **Scrapear web con IA**: en lugar de seleccionar nodos a mano con BeautifulSoup, paso el HTML a un LLM que extrae los datos pedidos en JSON.

### 🛠️ Desarrollo detallado y preciso *(25%)*

Pipeline: `requests` baja el HTML, `readability` limpia ruido, Ollama (qwen2.5) recibe HTML + esquema JSON deseado y devuelve datos estructurados. Validación con `pydantic`.

### 🚀 Aplicación práctica *(25%)*

Probado en 5 sitios de noticias: con un prompt único saco titular, autor, fecha y resumen sin escribir un selector. Las webs cambian de diseño y el script sigue funcionando.

### 🎯 Conclusión *(25%)*

El scraping del futuro es semántico. Los selectores CSS se rompen; los prompts no (tanto).

---

#Scraping #IA #LLM #Ollama #Python #DAM

---

### 📋 Checklist de la rúbrica

- [x] Introducción breve y contextualización del problema
- [x] Desarrollo técnico con stack, decisiones y arquitectura
- [x] Aplicación práctica con caso concreto y métricas/resultados
- [x] Conclusión que conecta con otros contenidos del ciclo
- [x] Formato LinkedIn (gancho, primera persona, párrafos cortos, hashtags)

> **Ciclo**: 1.º DAM · **Evaluación**: 3.ª · **Módulo**: Proyecto intermodular
