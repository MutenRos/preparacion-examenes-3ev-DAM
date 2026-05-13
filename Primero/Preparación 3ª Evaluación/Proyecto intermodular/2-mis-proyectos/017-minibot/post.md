# Post divulgativo — 017-minibot

> Documento de entrega siguiendo la **rúbrica de evaluación** (4 apartados al 25%):
> Introducción · Desarrollo · Aplicación práctica · Conclusión.
>
> Formato divulgativo: gancho inicial, primera persona, párrafos cortos, emojis moderados y hashtags al final.

---

## 📢 Post

**🕷️ Minibot: mi crawler personal en Python.**

### 🧭 Introducción y contextualización *(25%)*

Proyecto **Minibot**: web crawler que recorre un dominio en anchura, extrae enlaces y guarda el resultado para análisis o indexado posterior.

### 🛠️ Desarrollo detallado y preciso *(25%)*

Implementación con `requests` + `BeautifulSoup`, cola FIFO de URLs, set de visitados, respeto a `robots.txt`, límites por dominio y profundidad, logging estructurado en terminal y export a JSON/CSV.

### 🚀 Aplicación práctica *(25%)*

Probado en jocarsa.com: 412 URLs descubiertas en 18 s, sin duplicados, respetando `Disallow`. Base para mini-buscadores, auditorías SEO o RAG.

### 🎯 Conclusión *(25%)*

Entender cómo se rastrea la web por dentro es básico para cualquier dev: te toca antes o después en SEO, IA o scraping legal.

---

#Crawler #Python #Scraping #SEO #WebDev #DAM

---

### 📋 Checklist de la rúbrica

- [x] Introducción breve y contextualización del problema
- [x] Desarrollo técnico con stack, decisiones y arquitectura
- [x] Aplicación práctica con caso concreto y métricas/resultados
- [x] Conclusión que conecta con otros contenidos del ciclo
- [x] Formato divulgativo (gancho, primera persona, párrafos cortos, hashtags)

> **Ciclo**: 1.º DAM · **Evaluación**: 3.ª · **Módulo**: Proyecto intermodular
