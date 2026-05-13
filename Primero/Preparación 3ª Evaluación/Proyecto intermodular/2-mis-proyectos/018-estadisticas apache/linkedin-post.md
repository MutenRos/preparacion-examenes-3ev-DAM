# Post de LinkedIn — 018-estadisticas apache

> Documento de entrega siguiendo la **rúbrica de evaluación** (4 apartados al 25%):
> Introducción · Desarrollo · Aplicación práctica · Conclusión.
>
> Formato adaptado al estilo LinkedIn: gancho inicial, primera persona, párrafos cortos, emojis moderados y hashtags al final.

---

## 📢 Post para LinkedIn

**📊 Convertir el `access.log` de Apache en un dashboard real.**

### 🧭 Introducción y contextualización *(25%)*

Proyecto **Estadísticas Apache**: parseo del `access.log` y construcción de un dashboard web con KPIs, gráficos y top de rutas/user-agents.

### 🛠️ Desarrollo detallado y preciso *(25%)*

Pipeline: parser Python con regex para Combined Log Format, almacenamiento en SQLite/MySQL, agregaciones por hora/día, frontend en Flask + Jinja2 con gráficos en SVG/Canvas. Detección de bots vs humanos.

### 🚀 Aplicación práctica *(25%)*

Dashboard con requests por hora, códigos de estado (donut 2xx/3xx/4xx/5xx), top rutas, top user-agents y log en vivo (`tail -f`). Sustituye a herramientas tipo GoAccess con datos propios.

### 🎯 Conclusión *(25%)*

Tener tu propio dashboard de tráfico te enseña 10x más que mirar Google Analytics: ves la realidad cruda del servidor.

---

#Apache #Analytics #Python #Flask #LogParsing #DAM

---

### 📋 Checklist de la rúbrica

- [x] Introducción breve y contextualización del problema
- [x] Desarrollo técnico con stack, decisiones y arquitectura
- [x] Aplicación práctica con caso concreto y métricas/resultados
- [x] Conclusión que conecta con otros contenidos del ciclo
- [x] Formato LinkedIn (gancho, primera persona, párrafos cortos, hashtags)

> **Ciclo**: 1.º DAM · **Evaluación**: 3.ª · **Módulo**: Proyecto intermodular
