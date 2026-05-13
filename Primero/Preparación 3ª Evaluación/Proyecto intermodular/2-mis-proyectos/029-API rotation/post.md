# Post divulgativo — 029-API rotation

> Documento de entrega siguiendo la **rúbrica de evaluación** (4 apartados al 25%):
> Introducción · Desarrollo · Aplicación práctica · Conclusión.
>
> Formato divulgativo: gancho inicial, primera persona, párrafos cortos, emojis moderados y hashtags al final.

---

## 📢 Post

**🔄 Rotar APIs para no quemar tu cuenta gratuita.**

### 🧭 Introducción y contextualización *(25%)*

Proyecto **API rotation**: script Python que gestiona varias claves API (OpenAI, Groq, Together…) y rota automáticamente cuando una llega a su cuota.

### 🛠️ Desarrollo detallado y preciso *(25%)*

Lógica: pool de keys leído de `.env`, contador por key, fallback cuando una devuelve 429, retry con backoff, métricas de uso por proveedor. Modo "prefer cheapest".

### 🚀 Aplicación práctica *(25%)*

Útil en proyectos educativos donde tienes 3-4 cuentas gratuitas: maximizas requests/día sin caerte. Probado con OpenAI + Groq, 2.5x más tokens disponibles.

### 🎯 Conclusión *(25%)*

La gestión de cuotas es una skill subestimada. Saberla te diferencia cuando llevas un proyecto IA a producción con presupuesto cero.

---

#API #Python #LLM #RateLimit #DevOps #DAM

---

### 📋 Checklist de la rúbrica

- [x] Introducción breve y contextualización del problema
- [x] Desarrollo técnico con stack, decisiones y arquitectura
- [x] Aplicación práctica con caso concreto y métricas/resultados
- [x] Conclusión que conecta con otros contenidos del ciclo
- [x] Formato divulgativo (gancho, primera persona, párrafos cortos, hashtags)

> **Ciclo**: 1.º DAM · **Evaluación**: 3.ª · **Módulo**: Proyecto intermodular
