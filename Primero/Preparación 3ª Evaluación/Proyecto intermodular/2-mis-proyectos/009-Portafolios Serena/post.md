# Post divulgativo — 009-Portafolios Serena

> Documento de entrega siguiendo la **rúbrica de evaluación** (4 apartados al 25%):
> Introducción · Desarrollo · Aplicación práctica · Conclusión.
>
> Formato divulgativo: gancho inicial, primera persona, párrafos cortos, emojis moderados y hashtags al final.

---

## 📢 Post

**🛠️ Mi generador de proyectos web con IA local (con login y panel propio).**

### 🧭 Introducción y contextualización *(25%)*

El proyecto **Portafolios Serena** acabó siendo una pequeña aplicación PHP+SQLite donde un usuario registrado puede pedirle a una IA local (Ollama) que le genere proyectos web a medida y guardarlos en su panel personal.

### 🛠️ Desarrollo detallado y preciso *(25%)*

Stack: **PHP** para servidor, **SQLite** para usuarios y proyectos, `auth.php`/`login.php`/`signup.php` para sesiones, `dashboard.php` con CRUD de proyectos (`projects` con `title`, `description`, `last_prompt`, `last_code`) y `run_project.php` que llama a **Ollama** (`qwen2.5-coder:7b`) vía `curl` al endpoint `/api/generate`. Antes del proyecto final hay 6 ejercicios incrementales: llamada en local con `ollama run`, llamada desde PHP con `curl`, afinado del prompt, selección por usuario, mejora visual y formulario desplazable.

### 🚀 Aplicación práctica *(25%)*

Probado en local: registro de usuario → login → desde el dashboard escribo "Hazme una web sencilla en verde corporativo, solo código" → Ollama responde el HTML/CSS y se guarda asociado al usuario. Cada alumno puede tener su propio portafolio de proyectos generados.

### 🎯 Conclusión *(25%)*

Lo importante no fue el portafolio en sí, sino aprender a integrar autenticación, persistencia y llamadas a una IA local en una misma app PHP. Es la base para cualquier SaaS pequeño con IA.

---

#PHP #SQLite #Ollama #IA #Auth #DAM

---

### 📋 Checklist de la rúbrica

- [x] Introducción breve y contextualización del problema
- [x] Desarrollo técnico con stack, decisiones y arquitectura
- [x] Aplicación práctica con caso concreto y métricas/resultados
- [x] Conclusión que conecta con otros contenidos del ciclo
- [x] Formato divulgativo (gancho, primera persona, párrafos cortos, hashtags)

> **Ciclo**: 1.º DAM · **Evaluación**: 3.ª · **Módulo**: Proyecto intermodular
