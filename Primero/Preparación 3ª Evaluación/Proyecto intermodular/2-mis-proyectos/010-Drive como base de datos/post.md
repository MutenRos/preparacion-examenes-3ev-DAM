# Post divulgativo — 010-Drive como base de datos

> Documento de entrega siguiendo la **rúbrica de evaluación** (4 apartados al 25%):
> Introducción · Desarrollo · Aplicación práctica · Conclusión.
>
> Formato divulgativo: gancho inicial, primera persona, párrafos cortos, emojis moderados y hashtags al final.

---

## 📢 Post

**📊 Usar Google Sheets como base de datos: ¿buena idea?**

### 🧭 Introducción y contextualización *(25%)*

Proyecto **Drive como BD**: leo y escribo en Google Sheets desde Python usando `gspread` y una cuenta de servicio, tratando la hoja como una tabla SQL.

### 🛠️ Desarrollo detallado y preciso *(25%)*

Componentes: cuenta de servicio en Google Cloud, librería `gspread`, mapeo fila↔registro, índice por SKU como clave primaria, sincronización cada 30 s. Hoja "stock" con 142 productos y 8 columnas.

### 🚀 Aplicación práctica *(25%)*

Útil para pymes que ya viven en Excel/Sheets: el cliente sigue editando su hoja y la aplicación lee/escribe en paralelo. Ideal para inventarios pequeños o CRMs ligeros.

### 🎯 Conclusión *(25%)*

No reemplaza MySQL para producción seria, pero como BD para clientes no-técnicos es una solución elegante y barata.

---

#GoogleSheets #Python #gspread #Database #DAM

---

### 📋 Checklist de la rúbrica

- [x] Introducción breve y contextualización del problema
- [x] Desarrollo técnico con stack, decisiones y arquitectura
- [x] Aplicación práctica con caso concreto y métricas/resultados
- [x] Conclusión que conecta con otros contenidos del ciclo
- [x] Formato divulgativo (gancho, primera persona, párrafos cortos, hashtags)

> **Ciclo**: 1.º DAM · **Evaluación**: 3.ª · **Módulo**: Proyecto intermodular
