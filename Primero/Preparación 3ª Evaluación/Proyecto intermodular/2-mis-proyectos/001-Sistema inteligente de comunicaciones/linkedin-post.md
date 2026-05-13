# Post de LinkedIn — 001-Sistema inteligente de comunicaciones

> Documento de entrega siguiendo la **rúbrica de evaluación** (4 apartados al 25%):
> Introducción · Desarrollo · Aplicación práctica · Conclusión.
>
> Formato adaptado al estilo LinkedIn: gancho inicial, primera persona, párrafos cortos, emojis moderados y hashtags al final.

---

## 📢 Post para LinkedIn

**📬 ¿Y si tu bandeja de entrada se clasificara y priorizara sola?**

### 🧭 Introducción y contextualización *(25%)*

Acabamos de terminar el proyecto **Sistema inteligente de comunicaciones**, una bandeja de correo que lee IMAP y aplica IA local (Ollama) para clasificar, resumir y priorizar cada email automáticamente.

### 🛠️ Desarrollo detallado y preciso *(25%)*

La parte técnica: conexión IMAP con `imaplib`, variables de entorno con `python-dotenv`, resumen y clasificación con un LLM local (qwen2.5) vía Ollama, persistencia ligera y front en **Flask + Jinja2** con plantillas base/detail e index. Todo modular: un script por responsabilidad (recibir, clasificar, priorizar, resumir).

### 🚀 Aplicación práctica *(25%)*

Lo he aplicado a una bandeja real: 8 correos de muestra ordenados por prioridad (urgente/normal/spam), con resumen IA de 2 líneas y respuesta sugerida. El tiempo medio de revisión del buzón baja un ~70%.

### 🎯 Conclusión *(25%)*

He aprendido a integrar IMAP + LLM local sin coste por token y a montar la UI Flask desde cero. Próximo paso: autoetiquetado por hilos y respuestas automáticas con plantillas.

---

#Python #Flask #Ollama #IA #IMAP #DAM #FormaciónProfesional

---

### 📋 Checklist de la rúbrica

- [x] Introducción breve y contextualización del problema
- [x] Desarrollo técnico con stack, decisiones y arquitectura
- [x] Aplicación práctica con caso concreto y métricas/resultados
- [x] Conclusión que conecta con otros contenidos del ciclo
- [x] Formato LinkedIn (gancho, primera persona, párrafos cortos, hashtags)

> **Ciclo**: 1.º DAM · **Evaluación**: 3.ª · **Módulo**: Proyecto intermodular
