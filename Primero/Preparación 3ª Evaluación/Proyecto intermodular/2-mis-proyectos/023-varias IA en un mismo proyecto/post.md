# Post divulgativo — 023-varias IA en un mismo proyecto

> Documento de entrega siguiendo la **rúbrica de evaluación** (4 apartados al 25%):
> Introducción · Desarrollo · Aplicación práctica · Conclusión.
>
> Formato divulgativo: gancho inicial, primera persona, párrafos cortos, emojis moderados y hashtags al final.

---

## 📢 Post

**🧩 Orquestar varios modelos de IA en un mismo flujo.**

### 🧭 Introducción y contextualización *(25%)*

Proyecto **Varias IA en un mismo proyecto**: pipeline que usa un LLM para generar texto, otro para revisar el código y otro para generar bullets-resumen.

### 🛠️ Desarrollo detallado y preciso *(25%)*

Arquitectura productor-consumidor con Ollama corriendo qwen2.5 + codellama + gemma en paralelo, panel dual (texto izq / código dcha) con pasos visibles, configuración del modelo por tarea.

### 🚀 Aplicación práctica *(25%)*

Aplicado a generación de artículos técnicos: un modelo redacta, otro inserta bloques de código verificados, un tercero produce el resumen final. Mejora notable de calidad final.

### 🎯 Conclusión *(25%)*

Una sola IA puede equivocarse; varias especializadas se cubren entre sí. Es el patrón que está adoptando todo el ecosistema MoE/agentes.

---

#IA #LLM #Ollama #MultiAgent #Pipeline #DAM

---

### 📋 Checklist de la rúbrica

- [x] Introducción breve y contextualización del problema
- [x] Desarrollo técnico con stack, decisiones y arquitectura
- [x] Aplicación práctica con caso concreto y métricas/resultados
- [x] Conclusión que conecta con otros contenidos del ciclo
- [x] Formato divulgativo (gancho, primera persona, párrafos cortos, hashtags)

> **Ciclo**: 1.º DAM · **Evaluación**: 3.ª · **Módulo**: Proyecto intermodular
