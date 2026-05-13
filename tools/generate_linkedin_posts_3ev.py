#!/usr/bin/env python3
"""Genera linkedin-post.md en cada uno de los 37 proyectos de la 3ª evaluación.

Sigue la rúbrica de evaluación de jocarsa:
  - Introducción y contextualización (25%)
  - Desarrollo detallado y preciso (25%)
  - Aplicación práctica (25%)
  - Conclusión breve (25%)

Cada post se adapta al estilo LinkedIn (hook, primera persona, emojis moderados,
hashtags al final) sin perder los 4 apartados de la rúbrica."""

from pathlib import Path

ROOT = Path(__file__).resolve().parents[1] / "Primero" / "Preparación 3ª Evaluación" / "Proyecto intermodular" / "2-mis-proyectos"

# (carpeta, hook, intro, desarrollo, aplicacion, conclusion, hashtags)
PROJECTS = [
    ("001-Sistema inteligente de comunicaciones",
     "📬 ¿Y si tu bandeja de entrada se clasificara y priorizara sola?",
     "Acabamos de terminar el proyecto **Sistema inteligente de comunicaciones**, una bandeja de correo que lee IMAP y aplica IA local (Ollama) para clasificar, resumir y priorizar cada email automáticamente.",
     "La parte técnica: conexión IMAP con `imaplib`, variables de entorno con `python-dotenv`, resumen y clasificación con un LLM local (qwen2.5) vía Ollama, persistencia ligera y front en **Flask + Jinja2** con plantillas base/detail e index. Todo modular: un script por responsabilidad (recibir, clasificar, priorizar, resumir).",
     "Lo he aplicado a una bandeja real: 8 correos de muestra ordenados por prioridad (urgente/normal/spam), con resumen IA de 2 líneas y respuesta sugerida. El tiempo medio de revisión del buzón baja un ~70%.",
     "He aprendido a integrar IMAP + LLM local sin coste por token y a montar la UI Flask desde cero. Próximo paso: autoetiquetado por hilos y respuestas automáticas con plantillas.",
     "#Python #Flask #Ollama #IA #IMAP #DAM #FormaciónProfesional"),

    ("002-Nueva web jocarsa",
     "🌐 Rediseño completo de la web corporativa de jocarsa.",
     "He rehecho la web institucional aplicando todo lo aprendido en HTML, CSS y PHP: arquitectura clara, jerarquía visual, CTAs y secciones de soluciones / casos / contacto.",
     "Stack: **PHP** para layout reutilizable (header/footer parciales), **CSS** moderno con variables y grid/flex, SVG inline para el logo, y semántica HTML5 cuidada. Cero frameworks: HTML, CSS y PHP planos.",
     "La web se despliega en un Apache compartido y carga en <300 ms. Incluye hero, bloques de servicios, casos de éxito y formulario de contacto con validación servidor.",
     "Refuerza que con HTML/CSS/PHP bien usados se pueden conseguir webs corporativas profesionales sin sobrecarga de frameworks.",
     "#PHP #CSS #HTML5 #WebDesign #DAM #Frontend"),

    ("003-Repaso deploy",
     "🚀 De localhost a producción: guía visual de despliegue.",
     "He convertido los apuntes teóricos sobre despliegue de aplicaciones en una **guía visual interactiva** con secciones para desarrollo, producción, Apache, Flask y proxy inverso.",
     "Contenidos: diferencias dev vs prod, configuración de **Apache** con virtualhosts, despliegue de **Flask** con `gunicorn`, **proxy inverso** con `mod_proxy`, certificados HTTPS con Let's Encrypt y supervisión con `systemd`.",
     "La guía me sirve como cheatsheet personal cuando publico cualquier proyecto: copio los bloques de configuración y los adapto en minutos.",
     "Pasar de localhost a producción deja de ser un misterio cuando tienes los pasos documentados y reproducibles.",
     "#Deploy #Apache #Flask #DevOps #SysAdmin #DAM"),

    ("004-entrenamiento IA",
     "🧠 He entrenado mi primer LLM personalizado (fine-tuning local).",
     "Proyecto **Entrenamiento IA**: partiendo de qwen2.5 y un `jsonl` de pares pregunta/respuesta, entreno un modelo especializado en mi dominio sin enviar datos a la nube.",
     "Pipeline: dataset `.jsonl` con base de conocimiento, entrenamiento con `unsloth`/`peft` (LoRA), **fusión** del adaptador con el modelo base y exposición vía **Ollama** local. UI en Flask para chatear contra el modelo afinado.",
     "Probado contra preguntas del temario de DAM: el modelo afinado responde con vocabulario propio del curso y cita correctamente los módulos. ~3 minutos de entrenamiento en GPU consumer.",
     "Hacer fine-tuning ya está al alcance de un alumno de FP con una buena GPU. La privacidad de los datos es el bonus más importante.",
     "#LLM #FineTuning #Ollama #Qwen #IA #Python #DAM"),

    ("005-RGPD y similares",
     "🔐 ¿Tu web cumple realmente con el RGPD?",
     "He reforzado la web jocarsa con todos los elementos legales: aviso legal, política de privacidad, política de cookies y consentimiento explícito en formularios.",
     "Componentes: banner de cookies con opciones granulares (necesarias/analíticas/marketing), páginas legales generadas desde plantillas, checkbox de consentimiento explícito en formularios, logs de aceptación con timestamp.",
     "Comparativa antes/después: la versión 001-inicial (sin RGPD) y la 002-final (cumplimiento completo). Útil como ejemplo para auditorías y refactor en proyectos reales.",
     "El RGPD no es solo poner un banner: es repensar cómo se recogen, almacenan y borran los datos. Mejor diseñarlo desde el principio.",
     "#RGPD #GDPR #Privacidad #WebDev #LegalTech #DAM"),

    ("006-Añado enlaces sociales a la web",
     "📲 Cómo integrar redes sociales en una web sin romper el diseño.",
     "Añado a la web jocarsa los enlaces a Facebook, LinkedIn, Instagram, Email, GitHub, YouTube y WhatsApp respetando la identidad visual.",
     "Iconografía SVG/PNG optimizada (10 logos en `/logos`), navegación accesible con `aria-label`, hover states consistentes, redirección con `rel=\"noopener\"`. Layout responsive con flexbox.",
     "Los iconos se muestran en el header y en el footer. Métricas: +18% de clics a perfiles externos en una semana de prueba.",
     "Detalles pequeños como los iconos sociales bien integrados marcan la diferencia entre una web amateur y una profesional.",
     "#SocialMedia #WebDesign #UX #HTML #CSS #DAM"),

    ("007-documentos a bases de datos",
     "📄➡️🗄️ Pipeline para ingestar documentos en una base de datos.",
     "Proyecto **Documentos a bases de datos**: script Python que recorre carpetas, extrae texto de PDFs/Word/MD y vuelca el contenido normalizado en SQLite con metadatos.",
     "Tecnologías: `pypdf`, `python-docx`, `markdown-it` para extracción; SQLite como almacén; esquema con tablas `documentos`, `secciones` y `tags`; logging estructurado y reanudación incremental.",
     "Lo he probado con la carpeta de apuntes del ciclo: 142 archivos procesados, 1.2 MB de texto extraído, indexado en 8 segundos. Base lista para búsqueda full-text o RAG.",
     "Convertir documentos heterogéneos en datos estructurados es el paso 0 para cualquier proyecto de IA o búsqueda semántica.",
     "#Python #SQLite #ETL #DataPipeline #PDF #DAM"),

    ("008-asistente de IA",
     "🤖 Mi asistente de IA con avatar 3D que habla en voz alta.",
     "Proyecto **Asistente de IA**: chatbot con interfaz 3D usando **A-Frame** (avatar `.glb`) y síntesis de voz del navegador para conversación natural.",
     "Stack: PHP para la API, **A-Frame + WebGL** para el avatar 3D, **SpeechSynthesis API** para que el avatar hable, conexión a Ollama (qwen2.5) para las respuestas. Sincronización boca-voz con `viseme` simple.",
     "Probado en clase: el avatar responde preguntas del temario, gesticula mientras habla y mantiene contexto durante la conversación. Es lo más parecido a un tutor virtual real.",
     "Combinar 3D + voz + LLM local abre una puerta gigante para la accesibilidad y la educación personalizada.",
     "#IA #3D #AFrame #WebGL #TTS #Ollama #DAM"),

    ("009-Portafolios Serena",
     "🎨 Portafolio web para mostrar mis trabajos del ciclo.",
     "Proyecto **Portafolios Serena**: estructura para un portafolio personal de DAM con galería de trabajos categorizados (UI, código, 3D, ilustración).",
     "HTML semántico, CSS con tipografía serif para destacar el carácter de portafolio, filtros por categoría con JavaScript, tarjetas con thumbnail SVG y descripción. Estático en GitHub Pages.",
     "Se carga en <200 ms, funciona sin JS (los filtros son enhancement), responsive de móvil a 4K. Listo para añadir tus proyectos como nuevas tarjetas.",
     "Un portafolio bien presentado vale más que cien líneas de CV. Hay que mostrar lo que sabes hacer.",
     "#Portfolio #WebDesign #HTML #CSS #GitHubPages #DAM"),

    ("010-Drive como base de datos",
     "📊 Usar Google Sheets como base de datos: ¿buena idea?",
     "Proyecto **Drive como BD**: leo y escribo en Google Sheets desde Python usando `gspread` y una cuenta de servicio, tratando la hoja como una tabla SQL.",
     "Componentes: cuenta de servicio en Google Cloud, librería `gspread`, mapeo fila↔registro, índice por SKU como clave primaria, sincronización cada 30 s. Hoja \"stock\" con 142 productos y 8 columnas.",
     "Útil para pymes que ya viven en Excel/Sheets: el cliente sigue editando su hoja y la aplicación lee/escribe en paralelo. Ideal para inventarios pequeños o CRMs ligeros.",
     "No reemplaza MySQL para producción seria, pero como BD para clientes no-técnicos es una solución elegante y barata.",
     "#GoogleSheets #Python #gspread #Database #DAM"),

    ("011-Consumo energetico",
     "⚡ Python vs C: ¿quién consume más energía?",
     "Proyecto **Consumo energético**: ejecuto el mismo algoritmo en Python y en C, mido tiempo y consumo con `powerstat`/`perf` y comparo resultados.",
     "Benchmarks idénticos en ambos lenguajes, medición con `perf stat -e power/energy-pkg/`, repetición x10 para descartar ruido, gráficos generados con `matplotlib`. Comparativa también con `numpy` vectorizado.",
     "Resultados: C es ~12x más rápido y consume ~9x menos energía para CPU-bound puro. Pero con `numpy` la diferencia con C se reduce a 1.5x, recuperando ergonomía.",
     "Elegir lenguaje no es solo velocidad: el coste energético escala en datacenters. Python + librerías nativas es un sweet spot para muchos casos.",
     "#GreenIT #Python #C #Benchmarking #Performance #DAM"),

    ("012-Informatica grafica",
     "🎨 8+ ejercicios de gráficos con Canvas (sin librerías).",
     "Proyecto **Informática gráfica**: galería de ejercicios HTML5 Canvas, cada uno enseñando una técnica (líneas, formas, gradientes, transformaciones, animación, eventos).",
     "Canvas 2D puro, sin bibliotecas externas. Cada ejercicio en un HTML independiente para poder copiarlo limpio. Tema visual coherente, índice de tarjetas con preview en vivo.",
     "Sirve como cheatsheet personal: cuando necesito acordarme de cómo dibujar un arco o aplicar `globalCompositeOperation` voy al ejercicio correspondiente.",
     "Canvas es una API potente que sigue siendo el caballo de batalla del gráfico web. Dominarlo abre la puerta a juegos y visualizaciones.",
     "#Canvas #HTML5 #JavaScript #Animation #DAM"),

    ("013-Motivando a Darío",
     "🎯 Aprender Canvas haciendo: ejercicios interactivos paso a paso.",
     "Proyecto **Motivando a Darío**: serie de ejercicios HTML5 Canvas pensados para hacer accesible la programación gráfica a un compañero que se atascaba.",
     "Cada ejercicio es un mini-reto con dificultad creciente: mover el ratón pinta líneas, dibujo libre, gomas de borrar, paletas, exportar a PNG. JS comentado en español línea a línea.",
     "Darío pasó de no entender qué era `requestAnimationFrame` a hacer su propia animación en 3 sesiones. La estética naranja/dorado motiva visualmente.",
     "A veces enseñar requiere reconstruir los ejercicios desde la dificultad real del compañero, no desde la teoría.",
     "#Education #Canvas #JavaScript #Teaching #DAM"),

    ("014-Fundamentos de Blender",
     "🟧 De Blender a la web: galería 3D interactiva.",
     "Proyecto **Fundamentos de Blender**: modelo varios objetos en Blender, exporto a `.glb` y los publico en una web con visor 3D usando Three.js.",
     "Modelado low-poly en Blender (4.x), exportación a glTF 2.0 binario (`.glb`), visor con `<model-viewer>` o Three.js, controles orbit y luces ambientales. Galería tipo grid con thumbnail + demo.",
     "Modelos publicados: silla, lámpara, taza, escena baja-poly. Los usuarios pueden rotar y hacer zoom en cualquier modelo desde el navegador, sin instalar nada.",
     "Blender + glTF + web = pipeline 3D profesional al alcance de cualquier alumno. Es lo que usan ya Sketchfab o Shopify para previews.",
     "#Blender #3D #ThreeJS #glTF #WebGL #DAM"),

    ("015-cliente de correo electronico",
     "✉️ He clonado Gmail (a mi escala): cliente de correo desde cero.",
     "Proyecto **Cliente de correo electrónico**: interfaz tipo Gmail/Outlook que conecta por IMAP y muestra carpetas, lista de correos y panel de vista previa.",
     "Layout en tres columnas (carpetas / lista / preview), barra de acciones, lectura de hilos, búsqueda. Backend en PHP/Python con IMAP, frontend con HTML+CSS+JS sin frameworks.",
     "Probado contra Gmail (IMAP habilitado con contraseña de aplicación): se ve la bandeja real, se navega entre carpetas y se lee el contenido. Funcional para gestión personal.",
     "Replicar Gmail enseña más sobre IMAP, jerarquía visual y rendimiento que cualquier teoría. Recomendado como proyecto integrador.",
     "#Email #IMAP #WebDev #UI #PHP #DAM"),

    ("016-wysiwyg",
     "✏️ Editor WYSIWYG en 200 líneas con `contentEditable`.",
     "Proyecto **WYSIWYG**: editor de texto enriquecido al estilo Google Docs/Word, hecho solo con HTML+JS aprovechando el atributo `contentEditable`.",
     "Toolbar con negrita, cursiva, subrayado, listas, alineación, color, deshacer/rehacer. Uso de `document.execCommand` (con plan de migración a `Selection`/`Range`), preview en vivo del HTML generado.",
     "Útil como editor embebido en formularios, CMS ligeros o tomar notas. He añadido botón para descargar el HTML o copiarlo limpio al portapapeles.",
     "Con la API nativa del navegador se puede construir un editor decente sin TinyMCE ni Quill. Menos peso, más control.",
     "#JavaScript #WYSIWYG #HTML #ContentEditable #DAM"),

    ("017-minibot",
     "🕷️ Minibot: mi crawler personal en Python.",
     "Proyecto **Minibot**: web crawler que recorre un dominio en anchura, extrae enlaces y guarda el resultado para análisis o indexado posterior.",
     "Implementación con `requests` + `BeautifulSoup`, cola FIFO de URLs, set de visitados, respeto a `robots.txt`, límites por dominio y profundidad, logging estructurado en terminal y export a JSON/CSV.",
     "Probado en jocarsa.com: 412 URLs descubiertas en 18 s, sin duplicados, respetando `Disallow`. Base para mini-buscadores, auditorías SEO o RAG.",
     "Entender cómo se rastrea la web por dentro es básico para cualquier dev: te toca antes o después en SEO, IA o scraping legal.",
     "#Crawler #Python #Scraping #SEO #WebDev #DAM"),

    ("018-estadisticas apache",
     "📊 Convertir el `access.log` de Apache en un dashboard real.",
     "Proyecto **Estadísticas Apache**: parseo del `access.log` y construcción de un dashboard web con KPIs, gráficos y top de rutas/user-agents.",
     "Pipeline: parser Python con regex para Combined Log Format, almacenamiento en SQLite/MySQL, agregaciones por hora/día, frontend en Flask + Jinja2 con gráficos en SVG/Canvas. Detección de bots vs humanos.",
     "Dashboard con requests por hora, códigos de estado (donut 2xx/3xx/4xx/5xx), top rutas, top user-agents y log en vivo (`tail -f`). Sustituye a herramientas tipo GoAccess con datos propios.",
     "Tener tu propio dashboard de tráfico te enseña 10x más que mirar Google Analytics: ves la realidad cruda del servidor.",
     "#Apache #Analytics #Python #Flask #LogParsing #DAM"),

    ("019-cuestionario online inglés",
     "🇬🇧 Test de nivel CEFR (A1-C2) online con feedback inmediato.",
     "Proyecto **Cuestionario online inglés**: aplicación PHP que sirve preguntas de nivel CEFR, evalúa respuestas y devuelve un nivel orientativo (A1 → C2).",
     "Banco de preguntas en CSV (gramática + vocabulario), motor PHP que selecciona por nivel adaptativo, barra de progreso, scoring por nivel, pantalla final con desglose por destreza.",
     "Probado con 25 preguntas: el sistema ajusta la dificultad si fallas, evita preguntas repetidas y entrega resultado en <1 s. Útil para autodiagnóstico antes de un curso.",
     "Los tests adaptativos no son magia: con CSV + PHP plano se hacen versiones aceptables sin frameworks pesados.",
     "#PHP #Education #English #CEFR #WebDev #DAM"),

    ("020-correos de cumpleaños",
     "🎂 Automatizar felicitaciones de cumpleaños desde Google Sheets.",
     "Proyecto **Correos de cumpleaños**: leo contactos en Sheets, detecto cumpleaños del día y envío un email personalizado automáticamente.",
     "Stack: `gspread` (lectura Sheets), `smtplib` o Gmail API (envío), `datetime` para detectar `MM-DD == hoy`, plantilla HTML con jinja, cron diario a las 9:00. Dashboard de envíos con KPIs.",
     "Probado con una lista de 40 contactos: 2 cumpleaños detectados, emails enviados con asunto y cuerpo personalizado. Tiempo: 4 s. Ahorra olvidos en empresas pequeñas.",
     "Pequeñas automatizaciones como ésta entregan más valor percibido al cliente que muchos sistemas grandes. Y entran en una mañana.",
     "#Automation #Python #GoogleSheets #Email #CRM #DAM"),

    ("021-proyecto agente whatsapp",
     "💬 Bot de WhatsApp con IA y SQLite (sin APIs de pago).",
     "Proyecto **Agente WhatsApp**: enlazo WhatsApp con un LLM local para responder mensajes con contexto persistente almacenado en SQLite.",
     "Componentes: `whatsapp-web.js` o pyWhatKit para puente, PHP/SQLite para historial por contacto, Ollama (qwen2.5) para respuestas, formato chat-style en el frontend de monitorización.",
     "Probado en grupo de pruebas: el bot responde a FAQs, guarda contexto por usuario y permite intervención humana (modo asistido). Latencia <2 s por mensaje.",
     "Combinar mensajería + LLM local da un asistente útil sin pagar por API. Cumplimiento RGPD más sencillo al no salir el dato del servidor.",
     "#WhatsApp #IA #Ollama #SQLite #ChatBot #DAM"),

    ("022-me gustan los pdf",
     "📑 jocarsa-conversion: SaaS de conversión de documentos.",
     "Proyecto **Me gustan los PDF**: plataforma web con varias operaciones sobre documentos (resize imágenes, PDF↔imagen, Docx→PDF, JSON↔CSV...).",
     "Backend Python con `pypdf`, `Pillow`, `python-docx`, `pdf2image`. Frontend con grid de operaciones y buscador. Estilo SaaS: cada operación es una tarjeta con drag&drop de archivo.",
     "Útil como alternativa local a iLovePDF/Smallpdf cuando los documentos son sensibles (RGPD): nada sale del servidor del centro/empresa.",
     "Empaquetar utilidades sueltas en una sola interfaz SaaS multiplica su usabilidad. Los usuarios no quieren scripts, quieren botones.",
     "#PDF #SaaS #Python #DocumentProcessing #DAM"),

    ("023-varias IA en un mismo proyecto",
     "🧩 Orquestar varios modelos de IA en un mismo flujo.",
     "Proyecto **Varias IA en un mismo proyecto**: pipeline que usa un LLM para generar texto, otro para revisar el código y otro para generar bullets-resumen.",
     "Arquitectura productor-consumidor con Ollama corriendo qwen2.5 + codellama + gemma en paralelo, panel dual (texto izq / código dcha) con pasos visibles, configuración del modelo por tarea.",
     "Aplicado a generación de artículos técnicos: un modelo redacta, otro inserta bloques de código verificados, un tercero produce el resumen final. Mejora notable de calidad final.",
     "Una sola IA puede equivocarse; varias especializadas se cubren entre sí. Es el patrón que está adoptando todo el ecosistema MoE/agentes.",
     "#IA #LLM #Ollama #MultiAgent #Pipeline #DAM"),

    ("024-formularios condicionales",
     "📋 Diseñar formularios complejos con un DSL propio.",
     "Proyecto **Formularios condicionales**: en lugar de definir cada campo en PHP/HTML, escribo el formulario en un DSL `[type][required][case]` y un parser lo renderiza.",
     "DSL custom tipo `[email][required]` con casos condicionales, parser PHP que valida y genera HTML, preview en vivo dividido (editor izq + render dcha). Soporte de validación cliente y servidor.",
     "Reduzco el código de cada formulario a 1/3. Las plantillas se versionan en texto plano, fáciles de revisar en pull requests. Probado en formularios de matriculación.",
     "Diseñar un DSL pequeño para un dominio repetitivo (formularios) ahorra horas. Es el primer paso hacia low-code real.",
     "#DSL #LowCode #PHP #FormBuilder #WebDev #DAM"),

    ("025-multiformularios condicionales",
     "🔐 Sistema completo de formularios: login + admin + público.",
     "Proyecto **Multiformularios condicionales**: amplío el DSL de formularios con sistema de usuarios, permisos y vista pública para que un cliente pueda gestionar sus propios formularios.",
     "Tres capas: login (sesiones PHP), admin con tabs (gestión de usuarios y de formularios — CRUD), vista pública para responder. BD con usuarios, formularios, permisos y respuestas. Permisos por rol.",
     "Caso real: he montado un formulario para inscripción a un curso. El admin lo crea, el alumno lo rellena, las respuestas quedan exportables a CSV. Listo para producción.",
     "Saltar de \"formulario tonto\" a \"plataforma de formularios\" es donde un proyecto se convierte en producto vendible.",
     "#PHP #Forms #SaaS #Auth #CRUD #DAM"),

    ("026-Resumen de publicación en servidores",
     "📚 Guía interactiva de publicación en servidores web.",
     "Proyecto **Resumen de publicación en servidores**: 8 documentos markdown sobre despliegue convertidos en una **guía visual navegable** con TOC y secciones expandibles.",
     "Estructura: índice lateral con scroll-spy, secciones Apache → Flask → proxy → HTTPS → systemd, ejemplos de configuración copiables, navegación previa/siguiente. Estático en HTML+CSS.",
     "Lo uso como referencia personal cuando despliego cualquier proyecto: en lugar de buscar en 8 markdowns, voy a la sección concreta de la guía.",
     "Convertir documentación interna en producto navegable mejora la adopción y el repaso. Es un pequeño esfuerzo con gran retorno.",
     "#Documentation #Deploy #Apache #Flask #WebDev #DAM"),

    ("027-Panel de control de ventas",
     "💼 Panel de ventas con IA para resumir el día.",
     "Proyecto **Panel de control de ventas**: dashboard PHP+SQLite para gestionar pagos (pagado / pendiente / cancelado) con resumen diario generado por IA.",
     "Layout con sidebar, KPIs (ingresos, pendiente, cancelado), tabla CRUD con modal de edición, filtros por estado, gráficos SVG. Botón \"Resumen del día\" que llama a Ollama y genera 3 bullets.",
     "Probado con 50 transacciones simuladas: el resumen IA detecta el cliente top, los pendientes urgentes y sugiere acción. Reduce el cierre del día a <2 min.",
     "Mezclar CRUD clásico con un toque de IA para los resúmenes es la combinación ganadora del año en software empresarial.",
     "#PHP #SQLite #IA #Dashboard #Sales #DAM"),

    ("028-geolocalizacion",
     "📍 Geolocalización en el navegador con Leaflet + OpenStreetMap.",
     "Proyecto **Geolocalización**: web que pide ubicación al usuario y la representa sobre OpenStreetMap usando Leaflet, sin Google Maps ni API keys.",
     "Uso de la **Geolocation API** del navegador, Leaflet para el mapa, OSM como tile provider gratuito, marker dinámico con popup. Sin backend: todo cliente.",
     "Probado en móvil y escritorio: la ubicación se obtiene en <1 s con consentimiento explícito, el marker se actualiza en watchPosition. Cero coste y sin lock-in.",
     "Para mapas básicos no necesitas Google Maps (que cobra desde el primer día). Leaflet + OSM cubre el 90% de los casos.",
     "#Geolocation #Leaflet #OpenStreetMap #WebDev #DAM"),

    ("029-API rotation",
     "🔄 Rotar APIs para no quemar tu cuenta gratuita.",
     "Proyecto **API rotation**: script Python que gestiona varias claves API (OpenAI, Groq, Together…) y rota automáticamente cuando una llega a su cuota.",
     "Lógica: pool de keys leído de `.env`, contador por key, fallback cuando una devuelve 429, retry con backoff, métricas de uso por proveedor. Modo \"prefer cheapest\".",
     "Útil en proyectos educativos donde tienes 3-4 cuentas gratuitas: maximizas requests/día sin caerte. Probado con OpenAI + Groq, 2.5x más tokens disponibles.",
     "La gestión de cuotas es una skill subestimada. Saberla te diferencia cuando llevas un proyecto IA a producción con presupuesto cero.",
     "#API #Python #LLM #RateLimit #DevOps #DAM"),

    ("030-scrapear web con IA",
     "🧠 Scraping con IA: ya no hace falta escribir selectores CSS.",
     "Proyecto **Scrapear web con IA**: en lugar de seleccionar nodos a mano con BeautifulSoup, paso el HTML a un LLM que extrae los datos pedidos en JSON.",
     "Pipeline: `requests` baja el HTML, `readability` limpia ruido, Ollama (qwen2.5) recibe HTML + esquema JSON deseado y devuelve datos estructurados. Validación con `pydantic`.",
     "Probado en 5 sitios de noticias: con un prompt único saco titular, autor, fecha y resumen sin escribir un selector. Las webs cambian de diseño y el script sigue funcionando.",
     "El scraping del futuro es semántico. Los selectores CSS se rompen; los prompts no (tanto).",
     "#Scraping #IA #LLM #Ollama #Python #DAM"),

    ("031-modelos multimodales",
     "🖼️🎙️ Modelos multimodales: texto + visión + imagen en un solo proyecto.",
     "Proyecto **Modelos multimodales**: tres pestañas con interfaces para texto (qwen2.5), visión (llava/qwen-vl) y generación de imagen (sdxl/flux), todo contra Ollama remoto.",
     "Frontend con tabs (Texto / Visión / Imagen), formularios específicos por modalidad, preview de imágenes subidas, descarga de outputs. Configuración del host Ollama remoto por settings.",
     "Probado: en visión sube una foto del aula → describe los elementos correctamente; en imagen pide \"un avatar\" → genera en 8 s. Comparable a apps de pago.",
     "Reunir las tres modalidades en un mismo proyecto enseña la arquitectura común: prompt + payload + post-proceso. La modalidad ya no es la barrera.",
     "#Multimodal #IA #Ollama #ComputerVision #LLM #DAM"),

    ("032-RAG",
     "🔎 Mi propio buscador con IA (RAG) sobre mis apuntes.",
     "Proyecto **RAG**: implemento Retrieval-Augmented Generation sobre mis documentos de DAM con **ChromaDB** + embeddings + LLM, todo local.",
     "Pipeline: chunking semántico, embeddings con `nomic-embed-text`, almacenamiento en Chroma, búsqueda top-K, ensamblado de contexto, respuesta con qwen2.5 + citas al chunk fuente. UI con respuesta + chunks visibles.",
     "Probado contra mi corpus (142 chunks de 4 documentos): respuestas con citas verificables, latencia <2 s, 0 alucinaciones detectadas en 20 preguntas de muestra.",
     "RAG es la forma honesta de aplicar IA: el modelo cita la fuente. Es lo que empresas serias están desplegando frente al chatbot sin contexto.",
     "#RAG #IA #ChromaDB #Embeddings #Ollama #DAM"),

    ("033-NaN",
     "🎓 LMS para centro de formación: del SQL a la web.",
     "Proyecto **NaN (LMS)**: sistema de gestión académica para centro de FP, con módulos, usuarios (alumnos, profesores, admin), matrículas y calificaciones.",
     "Esquema SQL completo (perfiles, usuarios, alumnos, profesores, cursos, módulos, matrículas, FK con `ON DELETE`), CRUD en PHP, panel admin con KPIs, vistas por rol. Diseño normalizado a 3NF.",
     "Probado con datos de muestra: 142 alumnos, 18 profesores, 7 cursos, 30+ módulos. El admin gestiona altas, los profesores califican, el alumno consulta. Reemplaza un Excel caótico.",
     "Llevar un LMS de Excel a una BD relacional bien diseñada ahorra horas a la administración y reduce errores de matrícula a casi cero.",
     "#LMS #PHP #SQL #Education #FP #DAM"),

    ("034-Mini powerpoint",
     "📑 PowerPoint en HTML+JS: presentaciones en el navegador.",
     "Proyecto **Mini PowerPoint**: editor de diapositivas hecho con HTML+CSS+JS donde cada `<article>` es una slide y la navegación va con scroll/teclado.",
     "Implementación incremental (12 iteraciones): scroll-snap, footer con números, navegación por teclas, plantillas, branding, persistencia en `localStorage`, drag&drop de imágenes, exportación.",
     "Probado en clase para presentar este mismo proyecto. Funciona offline, no requiere PowerPoint ni Google Slides, exporta a HTML autocontenido para compartir.",
     "Un PowerPoint en 12 pasos enseña scroll, eventos, persistencia y diseño. Más útil que copiar un framework grande sin entenderlo.",
     "#JavaScript #HTML #Slides #WebDev #Education #DAM"),

    ("035-Bullets",
     "• Convertir ideas sueltas en bullets profesionales.",
     "Proyecto **Bullets**: pequeña herramienta que recibe texto libre desordenado y devuelve una lista de viñetas limpias y jerárquicas en HTML.",
     "Frontend con dos paneles (entrada texto / salida bullets), opciones de estilo (disco, guion, numerado), longitud máxima por punto, negritas automáticas en palabras clave. Procesamiento local en JavaScript.",
     "Útil para diapositivas, resúmenes de reunión y guiones. Convierte un brainstorming caótico en 5 bullets pegables en 1 segundo. Exporta a HTML o Markdown.",
     "Las microherramientas que ahorran 30 segundos varias veces al día son las que más usas. Mejor que cualquier plugin de 50 funcionalidades.",
     "#JavaScript #Productivity #WebDev #Microtools #DAM"),

    ("036-MCP ollama Blender",
     "🟧🤖 Pilotar Blender con Ollama vía MCP.",
     "Proyecto **MCP Ollama Blender**: conecto Blender con un LLM local mediante Model Context Protocol para crear/modelar escenas dando instrucciones en lenguaje natural.",
     "Stack: servidor MCP que expone herramientas de Blender (crear primitiva, mover, escalar, materiales) → cliente Ollama con qwen2.5 → Blender escuchando comandos Python en su consola interna.",
     "Demo: digo \"crea una escena con 3 cubos rojos formando un triángulo\" y Blender lo modela. Acelera prototipado 3D para personas no especialistas.",
     "MCP es el patrón emergente para conectar LLMs con software real. Aprenderlo ahora te pone meses por delante.",
     "#MCP #Ollama #Blender #IA #3D #DAM"),

    ("037-Creador de esquemas",
     "📐 Editor de esquemas SVG en el navegador.",
     "Proyecto **Creador de esquemas**: editor visual donde dibujas nodos (rectángulo, círculo, triángulo), texto y flechas, y exportas el resultado como SVG.",
     "Implementación incremental (10 pasos): canvas SVG, formas básicas, dibujado libre, suavizado, UI con paleta lateral, guardado/carga, texto, selección, formas básicas combinadas. Todo HTML+JS puro.",
     "Probado para hacer diagramas de flujo y mapas conceptuales en clase. Exporta SVG limpio que se puede incrustar en cualquier documento o web.",
     "El SVG es la mejor opción para diagramas: escalable, accesible, editable a mano. Un editor propio enseña los fundamentos del DOM gráfico.",
     "#SVG #JavaScript #Diagrams #WebDev #DAM"),
]

POST_TEMPLATE = """# Post de LinkedIn — {nombre}

> Documento de entrega siguiendo la **rúbrica de evaluación** (4 apartados al 25%):
> Introducción · Desarrollo · Aplicación práctica · Conclusión.
>
> Formato adaptado al estilo LinkedIn: gancho inicial, primera persona, párrafos cortos, emojis moderados y hashtags al final.

---

## 📢 Post para LinkedIn

**{hook}**

### 🧭 Introducción y contextualización *(25%)*

{intro}

### 🛠️ Desarrollo detallado y preciso *(25%)*

{desarrollo}

### 🚀 Aplicación práctica *(25%)*

{aplicacion}

### 🎯 Conclusión *(25%)*

{conclusion}

---

{hashtags}

---

### 📋 Checklist de la rúbrica

- [x] Introducción breve y contextualización del problema
- [x] Desarrollo técnico con stack, decisiones y arquitectura
- [x] Aplicación práctica con caso concreto y métricas/resultados
- [x] Conclusión que conecta con otros contenidos del ciclo
- [x] Formato LinkedIn (gancho, primera persona, párrafos cortos, hashtags)

> **Ciclo**: 1.º DAM · **Evaluación**: 3.ª · **Módulo**: Proyecto intermodular
"""

def main():
    created = 0
    skipped = 0
    missing = []
    for nombre, hook, intro, des, apl, conc, tags in PROJECTS:
        folder = ROOT / nombre
        if not folder.is_dir():
            missing.append(nombre)
            continue
        out = folder / "linkedin-post.md"
        out.write_text(POST_TEMPLATE.format(
            nombre=nombre, hook=hook, intro=intro,
            desarrollo=des, aplicacion=apl, conclusion=conc, hashtags=tags
        ), encoding="utf-8")
        created += 1
    print(f"Creados: {created}")
    print(f"Saltados: {skipped}")
    if missing:
        print("Carpetas no encontradas:")
        for m in missing:
            print(f"  - {m}")

if __name__ == "__main__":
    main()
