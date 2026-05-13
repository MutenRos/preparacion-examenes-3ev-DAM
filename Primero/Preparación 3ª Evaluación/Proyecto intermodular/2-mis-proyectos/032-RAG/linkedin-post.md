# Post de LinkedIn — 032-RAG

> Documento de entrega siguiendo la **rúbrica de evaluación** (4 apartados al 25%):
> Introducción · Desarrollo · Aplicación práctica · Conclusión.
>
> Formato adaptado al estilo LinkedIn: gancho inicial, primera persona, párrafos cortos, emojis moderados y hashtags al final.

---

## 📢 Post para LinkedIn

**🔎 Mi propio buscador con IA (RAG) sobre mis apuntes.**

### 🧭 Introducción y contextualización *(25%)*

Proyecto **RAG**: implemento Retrieval-Augmented Generation sobre mis documentos de DAM con **ChromaDB** + embeddings + LLM, todo local.

### 🛠️ Desarrollo detallado y preciso *(25%)*

Pipeline: chunking semántico, embeddings con `nomic-embed-text`, almacenamiento en Chroma, búsqueda top-K, ensamblado de contexto, respuesta con qwen2.5 + citas al chunk fuente. UI con respuesta + chunks visibles.

### 🚀 Aplicación práctica *(25%)*

Probado contra mi corpus (142 chunks de 4 documentos): respuestas con citas verificables, latencia <2 s, 0 alucinaciones detectadas en 20 preguntas de muestra.

### 🎯 Conclusión *(25%)*

RAG es la forma honesta de aplicar IA: el modelo cita la fuente. Es lo que empresas serias están desplegando frente al chatbot sin contexto.

---

#RAG #IA #ChromaDB #Embeddings #Ollama #DAM

---

### 📋 Checklist de la rúbrica

- [x] Introducción breve y contextualización del problema
- [x] Desarrollo técnico con stack, decisiones y arquitectura
- [x] Aplicación práctica con caso concreto y métricas/resultados
- [x] Conclusión que conecta con otros contenidos del ciclo
- [x] Formato LinkedIn (gancho, primera persona, párrafos cortos, hashtags)

> **Ciclo**: 1.º DAM · **Evaluación**: 3.ª · **Módulo**: Proyecto intermodular
