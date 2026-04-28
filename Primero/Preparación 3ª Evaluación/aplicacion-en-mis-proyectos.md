# Aplicación de los conocimientos del intermodular a mis proyectos personales

Este documento mapea cada proyecto de mi GitHub personal con los proyectos del intermodular cuyas técnicas he aplicado en él. Sirve como evidencia de transferencia de conocimiento del aula a proyectos reales.

> Los números se refieren a las carpetas dentro de [`Proyecto intermodular/2-mis-proyectos/`](./Proyecto%20intermodular/2-mis-proyectos/).

---

## 🎮 [doppelganger](https://github.com/MutenRos/doppelganger)
**Habbo-style isometric browser game con agentes IA · JavaScript**

| Proyecto aplicado                              | Cómo                                                                                |
| ---------------------------------------------- | ----------------------------------------------------------------------------------- |
| **004 · Entrenamiento IA**                     | Agentes con base de conocimiento + sistema de prompts (KB style refusal).           |
| **008 · Asistente de IA**                      | Diálogos de NPCs con respuestas por *keywords*, igual que el chatbot del aula.      |
| **012 · Informática gráfica**                  | Render isométrico 2.5D, sprites, manejo de capas en canvas.                         |
| **023 · Varias IA en un mismo proyecto**       | Múltiples agentes coexistiendo con personalidades diferentes (rol+memoria).         |
| **028 · Geolocalización**                      | Posicionamiento de jugadores en grid (coordenadas tile + interpolación).            |

---

## 🏖️ [casa-felix](https://github.com/MutenRos/casa-felix)
**Web estática (HTML/CSS/JS)**

| Proyecto aplicado                              | Cómo                                                                                |
| ---------------------------------------------- | ----------------------------------------------------------------------------------- |
| **002 · Nueva web jocarsa**                    | Estructura semántica + secciones tipo landing.                                      |
| **003 · Repaso deploy**                        | Publicación en hosting estático (workflow dev → prod).                              |
| **005 · RGPD y similares**                     | Aviso legal, política de cookies, banner de consentimiento.                         |
| **006 · Añado enlaces sociales a la web**      | Footer con iconos sociales y enlaces externos.                                      |

---

## 🤖 [silver-agent](https://github.com/MutenRos/silver-agent)
**Agente IA con memoria persistente · YAML/MD config**

| Proyecto aplicado                              | Cómo                                                                                |
| ---------------------------------------------- | ----------------------------------------------------------------------------------- |
| **004 · Entrenamiento IA**                     | Definición de personalidad y "alma" del agente (`SOUL.md`, `USER.md`).              |
| **008 · Asistente de IA**                      | Conversación contextual con base de conocimiento.                                   |
| **017 · Minibot**                              | Arquitectura de bot conversacional con memoria.                                     |
| **023 · Varias IA en un mismo proyecto**       | Orquestación de varios LLMs con roles distintos (`AGENTS.md`).                      |
| **031 · Modelos multimodales**                 | Soporte para entradas variadas en la configuración.                                 |

---

## 🏗️ [grupo-bonilla-web](https://github.com/MutenRos/grupo-bonilla-web)
**Web corporativa "AAA Quality" (HTML)**

| Proyecto aplicado                              | Cómo                                                                                |
| ---------------------------------------------- | ----------------------------------------------------------------------------------- |
| **002 · Nueva web jocarsa**                    | Web pulida con identidad visual fuerte.                                             |
| **003 · Repaso deploy**                        | Deploy a producción con dominio propio.                                             |
| **005 · RGPD y similares**                     | Páginas legales, formulario de contacto LOPD-compliant.                             |
| **006 · Añado enlaces sociales a la web**      | Integración de redes sociales corporativas.                                         |
| **026 · Resumen de publicación en servidores** | VirtualHost + subdominio + certificado.                                             |

---

## 🔧 [ITCBackup](https://github.com/MutenRos/ITCBackup)
**Suite ERP + agentes · backend Python + frontend + orchestrator**

| Proyecto aplicado                              | Cómo                                                                                |
| ---------------------------------------------- | ----------------------------------------------------------------------------------- |
| **001 · Sistema inteligente de comunicaciones**| Clasificación + priorización de emails entrantes.                                   |
| **004 · Entrenamiento IA**                     | LLM custom para tareas internas.                                                    |
| **007 · Documentos a bases de datos**          | Pipeline ingest documentos → BD estructurada.                                       |
| **022 · Me gustan los PDF**                    | Procesado masivo de PDFs.                                                           |
| **023 · Varias IA en un mismo proyecto**       | Orchestrator coordinando varios agentes especializados.                             |
| **027 · Panel de control de ventas**           | Dashboard ERP con gestión de clientes/productos/pedidos.                            |
| **030 · Scrapear web con IA**                  | Scraping interno + resumen IA para informes.                                        |

---

## 🇷🇺 [rusovalencia](https://github.com/MutenRos/rusovalencia)
**Web informativa (HTML/CSS/JS)**

| Proyecto aplicado                              | Cómo                                                                                |
| ---------------------------------------------- | ----------------------------------------------------------------------------------- |
| **002 · Nueva web jocarsa**                    | Plantilla de landing.                                                               |
| **003 · Repaso deploy**                        | Subida a hosting + dominio.                                                         |
| **005 · RGPD y similares**                     | Privacidad y cookies.                                                               |
| **019 · Cuestionario online inglés** *(parcial)*| Formularios con validación por niveles.                                            |

---

## 💼 [IntegraTechConsulting](https://github.com/MutenRos/IntegraTechConsulting)
**App Flask completa · backend + frontend + db**

| Proyecto aplicado                              | Cómo                                                                                |
| ---------------------------------------------- | ----------------------------------------------------------------------------------- |
| **003 · Repaso deploy**                        | Deploy de Flask en servidor + Apache reverse proxy.                                 |
| **026 · Resumen de publicación en servidores** | Sistemd service + VirtualHost + subdominio.                                         |
| **027 · Panel de control de ventas**           | CRUD + KPIs en panel de administración.                                             |
| **025 · Multiformularios condicionales**       | Formularios dinámicos con lógica condicional.                                       |
| **007 · Documentos a bases de datos**          | Carga de documentos a BD relacional.                                                |
| **EXAMEN INTERMODULAR** (Flask + MySQL + HTML) | Stack idéntico al examen final (`app_flask.py` + plantillas).                       |

---

## 🤖 [clawdbot-install-tutorial](https://github.com/MutenRos/clawdbot-install-tutorial)
**Guía instalación bot · documentación**

| Proyecto aplicado                              | Cómo                                                                                |
| ---------------------------------------------- | ----------------------------------------------------------------------------------- |
| **003 · Repaso deploy**                        | Pasos `apt install` + servicio + arranque.                                          |
| **017 · Minibot**                              | Bot del aula como referencia para esta guía.                                        |
| **021 · Proyecto agente WhatsApp**             | Conexión a sistemas de mensajería.                                                  |

---

## 🔒 [PrivateTenacitas](https://github.com/MutenRos/PrivateTenacitas)
**Proyecto privado · TypeScript con tooling completo**

| Proyecto aplicado                              | Cómo                                                                                |
| ---------------------------------------------- | ----------------------------------------------------------------------------------- |
| **003 · Repaso deploy**                        | Pipeline CI/CD (`.github/workflows`).                                               |
| **005 · RGPD y similares**                     | Pre-commit hooks que detectan secretos (`.detect-secrets.cfg`).                     |
| **026 · Resumen de publicación en servidores** | Docker + servicios sistemáticos.                                                    |

---

## 💪 [personal-trainer](https://github.com/MutenRos/personal-trainer)
**App fitness · backend Python + frontend Streamlit**

| Proyecto aplicado                              | Cómo                                                                                |
| ---------------------------------------------- | ----------------------------------------------------------------------------------- |
| **004 · Entrenamiento IA**                     | LLM que genera planes de entrenamiento personalizados.                              |
| **008 · Asistente de IA**                      | Asistente conversacional fitness.                                                   |
| **011 · Consumo energético**                   | Cálculo y gráficas de calorías/macros (similar al panel de consumo).                |
| **020 · Correos de cumpleaños**                | Recordatorios automáticos por email.                                                |
| **027 · Panel de control de ventas**           | Dashboard con KPIs (peso, rutinas, progreso).                                       |
| **EXAMEN INTERMODULAR**                        | Stack: Python + DB + frontend + API.                                                |

---

## 📊 Resumen de cobertura

| Proyecto del aula                              | Aplicado en…                                                                |
| ---------------------------------------------- | --------------------------------------------------------------------------- |
| 001 · Sistema inteligente comunicaciones       | ITCBackup                                                                   |
| 002 · Nueva web jocarsa                        | casa-felix, grupo-bonilla, rusovalencia                                     |
| 003 · Repaso deploy                            | casa-felix, grupo-bonilla, rusovalencia, ITC, IntegraTech, clawdbot, PrivateTenacitas |
| 004 · Entrenamiento IA                         | doppelganger, silver-agent, ITCBackup, personal-trainer                     |
| 005 · RGPD                                     | casa-felix, grupo-bonilla, rusovalencia, PrivateTenacitas                   |
| 006 · Enlaces sociales                         | casa-felix, grupo-bonilla                                                   |
| 007 · Documentos a BD                          | ITCBackup, IntegraTech                                                      |
| 008 · Asistente IA                             | doppelganger, silver-agent, personal-trainer                                |
| 011 · Consumo energético                       | personal-trainer                                                            |
| 012 · Informática gráfica                      | doppelganger                                                                |
| 017 · Minibot                                  | silver-agent, clawdbot                                                      |
| 019 · Cuestionario inglés                      | rusovalencia                                                                |
| 020 · Correos cumpleaños                       | personal-trainer                                                            |
| 021 · Agente WhatsApp                          | clawdbot                                                                    |
| 022 · PDFs                                     | ITCBackup                                                                   |
| 023 · Varias IAs                               | doppelganger, silver-agent, ITCBackup                                       |
| 025 · Multiformularios condicionales           | IntegraTech                                                                 |
| 026 · Publicación en servidores                | grupo-bonilla, IntegraTech, PrivateTenacitas                                |
| 027 · Panel de ventas                          | ITCBackup, IntegraTech, personal-trainer                                    |
| 028 · Geolocalización                          | doppelganger                                                                |
| 030 · Scrapear con IA                          | ITCBackup                                                                   |
| 031 · Modelos multimodales                     | silver-agent                                                                |
| **EXAMEN INTERMODULAR (Flask+MySQL)**          | IntegraTech, personal-trainer                                               |
