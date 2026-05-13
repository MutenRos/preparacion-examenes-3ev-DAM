# Post divulgativo — 011-Consumo energetico

> Documento de entrega siguiendo la **rúbrica de evaluación** (4 apartados al 25%):
> Introducción · Desarrollo · Aplicación práctica · Conclusión.
>
> Formato divulgativo: gancho inicial, primera persona, párrafos cortos, emojis moderados y hashtags al final.

---

## 📢 Post

**⚡ Python vs C: ¿quién consume más energía?**

### 🧭 Introducción y contextualización *(25%)*

Proyecto **Consumo energético**: ejecuto el mismo algoritmo en Python y en C, mido tiempo y consumo con `powerstat`/`perf` y comparo resultados.

### 🛠️ Desarrollo detallado y preciso *(25%)*

Benchmarks idénticos en ambos lenguajes, medición con `perf stat -e power/energy-pkg/`, repetición x10 para descartar ruido, gráficos generados con `matplotlib`. Comparativa también con `numpy` vectorizado.

### 🚀 Aplicación práctica *(25%)*

Resultados: C es ~12x más rápido y consume ~9x menos energía para CPU-bound puro. Pero con `numpy` la diferencia con C se reduce a 1.5x, recuperando ergonomía.

### 🎯 Conclusión *(25%)*

Elegir lenguaje no es solo velocidad: el coste energético escala en datacenters. Python + librerías nativas es un sweet spot para muchos casos.

---

#GreenIT #Python #C #Benchmarking #Performance #DAM

---

### 📋 Checklist de la rúbrica

- [x] Introducción breve y contextualización del problema
- [x] Desarrollo técnico con stack, decisiones y arquitectura
- [x] Aplicación práctica con caso concreto y métricas/resultados
- [x] Conclusión que conecta con otros contenidos del ciclo
- [x] Formato divulgativo (gancho, primera persona, párrafos cortos, hashtags)

> **Ciclo**: 1.º DAM · **Evaluación**: 3.ª · **Módulo**: Proyecto intermodular
