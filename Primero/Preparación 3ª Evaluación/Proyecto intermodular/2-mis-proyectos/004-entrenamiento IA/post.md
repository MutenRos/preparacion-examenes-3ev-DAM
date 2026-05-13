# Post divulgativo — 004-entrenamiento IA

> Documento de entrega siguiendo la **rúbrica de evaluación** (4 apartados al 25%):
> Introducción · Desarrollo · Aplicación práctica · Conclusión.
>
> Formato divulgativo: gancho inicial, primera persona, párrafos cortos, emojis moderados y hashtags al final.

---

## 📢 Post

**🧠 He entrenado mi primer LLM personalizado (fine-tuning local).**

### 🧭 Introducción y contextualización *(25%)*

Proyecto **Entrenamiento IA**: partiendo de qwen2.5 y un `jsonl` de pares pregunta/respuesta, entreno un modelo especializado en mi dominio sin enviar datos a la nube.

### 🛠️ Desarrollo detallado y preciso *(25%)*

Pipeline: dataset `.jsonl` con base de conocimiento, entrenamiento con `unsloth`/`peft` (LoRA), **fusión** del adaptador con el modelo base y exposición vía **Ollama** local. UI en Flask para chatear contra el modelo afinado.

### 🚀 Aplicación práctica *(25%)*

Probado contra preguntas del temario de DAM: el modelo afinado responde con vocabulario propio del curso y cita correctamente los módulos. ~3 minutos de entrenamiento en GPU consumer.

### 🎯 Conclusión *(25%)*

Hacer fine-tuning ya está al alcance de un alumno de FP con una buena GPU. La privacidad de los datos es el bonus más importante.

---

#LLM #FineTuning #Ollama #Qwen #IA #Python #DAM

---

### 📋 Checklist de la rúbrica

- [x] Introducción breve y contextualización del problema
- [x] Desarrollo técnico con stack, decisiones y arquitectura
- [x] Aplicación práctica con caso concreto y métricas/resultados
- [x] Conclusión que conecta con otros contenidos del ciclo
- [x] Formato divulgativo (gancho, primera persona, párrafos cortos, hashtags)

> **Ciclo**: 1.º DAM · **Evaluación**: 3.ª · **Módulo**: Proyecto intermodular
