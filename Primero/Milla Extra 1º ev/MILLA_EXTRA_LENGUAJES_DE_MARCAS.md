# MILLA EXTRA - LENGUAJES DE MARCAS Y SISTEMAS DE GESTIÓN DE INFORMACIÓN
## Proyecto: eID - Red Social de Tarjetas de Visita Digitales

**Alumno:** Darío Lacal  
**Asignatura:** Lenguajes de Marcas y Sistemas de Gestión de Información  
**Evaluación:** 1ª Evaluación  
**Fecha de entrega:** Día del examen  
**Peso:** 10% de la nota de evaluación

---

## DESCRIPCIÓN DEL PROYECTO

eID utiliza HTML5, CSS3 y JSON para la presentación y el intercambio de datos. Implementa formularios web, estructuras semánticas, estilos responsive y APIs REST con JSON.

**Repositorio:** https://github.com/MutenRos/eID  
**Tecnologías:** HTML5, CSS3, JavaScript, JSON, Jinja2  
**Archivos de marcado:** >30 archivos `.html`

---

## APLICACIÓN DE CONOCIMIENTOS DE LENGUAJES DE MARCAS

### **UNIDAD 1: RECONOCIMIENTO DE LAS CARACTERÍSTICAS DE LENGUAJES DE MARCAS**

#### **1.1. Concepto de Lenguaje de Marcas**
- ✅ **Aplicado:** HTML5 para estructura, CSS para presentación
- **Definición:** Lenguaje que utiliza etiquetas para definir estructura y presentación
- **Tipos usados:**
  - HTML: Estructura de páginas web
  - CSS: Estilos y diseño
  - JSON: Intercambio de datos

#### **1.2. Clasificación de Lenguajes de Marcas**
- ✅ **Aplicado:** Múltiples tipos

| Tipo | Ejemplo en eID | Uso |
|------|----------------|-----|
| Presentación | HTML5 | Estructura páginas |
| Descriptivo | JSON | API responses |
| Híbrido | Jinja2 | Templates dinámicos |

---

### **UNIDAD 2: UTILIZACIÓN DE LENGUAJES DE MARCAS EN ENTORNOS WEB**

#### **2.1. HTML5 - Estructura Semántica**
- ✅ **Aplicado:** Uso extensivo de HTML5 semántico

**Ejemplo: app/templates/base.html (Layout base)**
```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{% block title %}eID - Tarjeta de Visita Digital{% endblock %}</title>
    
    <!-- Meta tags para SEO -->
    <meta name="description" content="Red social profesional de tarjetas digitales">
    <meta name="keywords" content="tarjeta digital, networking, contactos">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/static/favicon.ico">
    
    <!-- Estilos -->
    <style>
        /* CSS inline para rendimiento */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    </style>
    
    {% block extra_head %}{% endblock %}
</head>
<body>
    <!-- Navegación semántica -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="/" class="nav-brand">eID</a>
            <ul class="nav-menu">
                <li><a href="/profile/">👤 Perfil</a></li>
                <li><a href="/contacts/">📇 Contactos</a></li>
                <li><a href="/chat/">💬 Chat</a></li>
                <li><a href="/calendar/">📅 Calendario</a></li>
            </ul>
        </div>
    </nav>
    
    <!-- Contenido principal -->
    <main class="container">
        {% block content %}{% endblock %}
    </main>
    
    <!-- Pie de página -->
    <footer>
        <p>&copy; 2025 eID - Todos los derechos reservados</p>
    </footer>
    
    {% block extra_scripts %}{% endblock %}
</body>
</html>
```

**Elementos HTML5 semánticos utilizados:**
- `<header>`, `<nav>`, `<main>`, `<footer>` - Estructura de página
- `<section>`, `<article>`, `<aside>` - Organización de contenido
- `<form>`, `<input>`, `<button>` - Formularios
- `<dialog>` - Modales modernos

#### **2.2. Formularios HTML5**
- ✅ **Aplicado:** Formularios con validación

**Ejemplo: Registro de usuario (app/templates/auth/register.html)**
```html
<form method="POST" action="/auth/register" class="form-card">
    <!-- Campo de texto con validación -->
    <div class="form-group">
        <label for="username">Nombre de usuario</label>
        <input 
            type="text" 
            id="username" 
            name="username" 
            required 
            minlength="3" 
            maxlength="20"
            pattern="[a-zA-Z0-9_]+"
            placeholder="usuario123"
            autocomplete="username"
        >
        <small>Solo letras, números y guiones bajos</small>
    </div>
    
    <!-- Campo de email con validación nativa -->
    <div class="form-group">
        <label for="email">Email</label>
        <input 
            type="email" 
            id="email" 
            name="email" 
            required
            placeholder="usuario@ejemplo.com"
            autocomplete="email"
        >
    </div>
    
    <!-- Campo de contraseña -->
    <div class="form-group">
        <label for="password">Contraseña</label>
        <input 
            type="password" 
            id="password" 
            name="password" 
            required
            minlength="8"
            autocomplete="new-password"
        >
    </div>
    
    <!-- Campo de fecha (HTML5) -->
    <div class="form-group">
        <label for="birth_date">Fecha de nacimiento</label>
        <input 
            type="date" 
            id="birth_date" 
            name="birth_date"
            max="2010-01-01"
        >
    </div>
    
    <!-- Botón de envío -->
    <button type="submit" class="btn btn-primary">Registrarse</button>
</form>
```

**Tipos de input HTML5 utilizados:**
- `text` - Texto simple
- `email` - Validación de email
- `password` - Contraseñas ocultas
- `date` - Selector de fechas
- `time` - Selector de horas
- `color` - Selector de colores
- `checkbox` - Casillas de verificación
- `radio` - Opciones excluyentes

#### **2.3. Calendario con HTML5 + JavaScript**
- ✅ **Aplicado:** Integración de FullCalendar.js

**Ejemplo: app/templates/calendar/index.html**
```html
{% extends "base.html" %}

{% block extra_head %}
<!-- FullCalendar CSS -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css' rel='stylesheet' />
<style>
    .calendar-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .fc-event {
        cursor: pointer;
        border-radius: 4px;
    }
</style>
{% endblock %}

{% block content %}
<div class="calendar-container">
    <h1>📅 Mi Calendario</h1>
    
    <!-- Botón para crear evento -->
    <button onclick="openEventModal()" class="btn btn-primary">
        ➕ Crear Evento
    </button>
    
    <!-- Contenedor del calendario -->
    <div id="calendar"></div>
</div>

<!-- Modal para crear/editar eventos -->
<dialog id="eventModal" class="modal">
    <form id="eventForm">
        <h2 id="modalTitle">Nuevo Evento</h2>
        
        <!-- Campo título -->
        <input 
            type="text" 
            name="title" 
            placeholder="Título del evento" 
            required
        >
        
        <!-- Selector de tipo de evento -->
        <div class="event-types">
            <button type="button" data-type="meeting">👥 Reunión</button>
            <button type="button" data-type="birthday">🎂 Cumpleaños</button>
            <button type="button" data-type="task">✅ Tarea</button>
            <button type="button" data-type="reminder">⏰ Recordatorio</button>
            <button type="button" data-type="other">📌 Otro</button>
        </div>
        
        <!-- Fechas -->
        <input type="datetime-local" name="start" required>
        <input type="datetime-local" name="end" required>
        
        <!-- Checkbox de día completo -->
        <label>
            <input type="checkbox" name="all_day">
            Día completo
        </label>
        
        <!-- Textarea para descripción -->
        <textarea 
            name="description" 
            placeholder="Descripción (opcional)" 
            rows="3"
        ></textarea>
        
        <!-- Selector de color -->
        <div class="color-picker">
            <input type="radio" name="color" value="#3b82f6" checked>
            <input type="radio" name="color" value="#ef4444">
            <input type="radio" name="color" value="#10b981">
            <input type="radio" name="color" value="#f59e0b">
            <input type="radio" name="color" value="#8b5cf6">
            <input type="radio" name="color" value="#ec4899">
        </div>
        
        <!-- Participantes -->
        <select name="participants" multiple size="5">
            {% for contact in contacts %}
            <option value="{{ contact.id }}">
                {{ contact.full_name or contact.username }}
            </option>
            {% endfor %}
        </select>
        
        <!-- Botones -->
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="button" onclick="closeEventModal()" class="btn btn-secondary">
            Cancelar
        </button>
    </form>
</dialog>
{% endblock %}

{% block extra_scripts %}
<!-- FullCalendar JS -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.10/locales/es.global.min.js'></script>

<script>
    // Inicializar calendario
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: '/calendar/events/json',
            eventClick: function(info) {
                editEvent(info.event.id);
            },
            editable: true,
            eventDrop: function(info) {
                updateEventDates(info.event);
            }
        });
        
        calendar.render();
    });
</script>
{% endblock %}
```

---

### **UNIDAD 3: CSS3 - HOJAS DE ESTILO EN CASCADA**

#### **3.1. Selectores CSS**
- ✅ **Aplicado:** Uso extensivo de selectores

```css
/* Selector de elemento */
body {
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

/* Selector de clase */
.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.btn-primary {
    background-color: #3b82f6;
    color: white;
}

/* Selector de ID */
#calendar {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

/* Selector descendente */
.form-group input {
    width: 100%;
    padding: 8px;
}

/* Selector de hijo directo */
nav > ul > li {
    display: inline-block;
}

/* Selector de pseudo-clase */
.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.input:focus {
    outline: 2px solid #3b82f6;
    outline-offset: 2px;
}

/* Selector de pseudo-elemento */
.contact-card::before {
    content: "👤";
    margin-right: 8px;
}

/* Selector de atributo */
input[type="email"] {
    background-image: url('email-icon.svg');
}

input[required] {
    border-left: 3px solid #ef4444;
}

/* Combinaciones */
.btn.btn-primary:hover:not(:disabled) {
    background-color: #2563eb;
}
```

#### **3.2. Box Model**
- ✅ **Aplicado:** Control de espaciado y dimensiones

```css
.card {
    /* Box model completo */
    width: 300px;
    height: auto;
    
    /* Padding interno */
    padding: 20px;
    
    /* Borde */
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    
    /* Margin externo */
    margin: 16px;
    
    /* Box-sizing */
    box-sizing: border-box;
}

.container {
    /* Centrar horizontalmente */
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}
```

#### **3.3. Flexbox**
- ✅ **Aplicado:** Layouts flexibles

```css
/* Navbar con Flexbox */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 2rem;
    background: white;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.nav-menu {
    display: flex;
    gap: 2rem;
    list-style: none;
}

/* Tarjetas de contactos */
.contacts-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    padding: 1rem;
}

.contact-card {
    flex: 1 1 300px;
    min-width: 250px;
    max-width: 350px;
}

/* Centrar contenido */
.center-content {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}
```

#### **3.4. Grid Layout**
- ✅ **Aplicado:** Diseño de cuadrícula

```css
/* Layout de perfil con Grid */
.profile-layout {
    display: grid;
    grid-template-columns: 300px 1fr;
    grid-template-rows: auto 1fr auto;
    gap: 20px;
    min-height: 100vh;
}

.profile-sidebar {
    grid-column: 1;
    grid-row: 1 / -1;
}

.profile-header {
    grid-column: 2;
    grid-row: 1;
}

.profile-content {
    grid-column: 2;
    grid-row: 2;
}

/* Grid responsive */
.calendar-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}
```

#### **3.5. Responsive Design**
- ✅ **Aplicado:** Media queries para adaptabilidad

```css
/* Mobile first approach */
.container {
    padding: 1rem;
}

/* Tablet (768px+) */
@media (min-width: 768px) {
    .container {
        padding: 2rem;
    }
    
    .contacts-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Desktop (1024px+) */
@media (min-width: 1024px) {
    .container {
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .contacts-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

/* Large screens (1440px+) */
@media (min-width: 1440px) {
    .contacts-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

/* Dark mode */
@media (prefers-color-scheme: dark) {
    body {
        background: #1f2937;
        color: #f3f4f6;
    }
    
    .card {
        background: #374151;
        border-color: #4b5563;
    }
}
```

#### **3.6. Animaciones CSS**
- ✅ **Aplicado:** Transiciones y keyframes

```css
/* Transiciones suaves */
.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.modal {
    opacity: 0;
    transform: scale(0.9);
    transition: opacity 0.3s, transform 0.3s;
}

.modal.show {
    opacity: 1;
    transform: scale(1);
}

/* Animaciones con keyframes */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.contact-card {
    animation: fadeIn 0.5s ease;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.loading-spinner {
    animation: spin 1s linear infinite;
}

/* Pulse effect */
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

.notification-badge {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
```

---

### **UNIDAD 4: JSON - INTERCAMBIO DE DATOS**

#### **4.1. Estructura JSON**
- ✅ **Aplicado:** API REST con JSON

**Ejemplo: Respuesta de eventos del calendario**
```json
{
    "success": true,
    "events": [
        {
            "id": 1,
            "title": "Reunión con cliente",
            "start": "2025-11-10T10:00:00",
            "end": "2025-11-10T11:30:00",
            "allDay": false,
            "backgroundColor": "#3b82f6",
            "borderColor": "#2563eb",
            "extendedProps": {
                "type": "meeting",
                "description": "Presentación de proyecto eID",
                "location": "Oficina central",
                "reminder": 15,
                "participants": [
                    {
                        "id": 5,
                        "username": "ana.garcia",
                        "full_name": "Ana García"
                    },
                    {
                        "id": 3,
                        "username": "juan.perez",
                        "full_name": "Juan Pérez"
                    }
                ]
            }
        },
        {
            "id": 2,
            "title": "Cumpleaños de María",
            "start": "2025-11-15",
            "allDay": true,
            "backgroundColor": "#ec4899",
            "extendedProps": {
                "type": "birthday",
                "description": "🎂",
                "participants": []
            }
        }
    ]
}
```

#### **4.2. Generación de JSON desde Python**
- ✅ **Aplicado:** Serialización de objetos

**app/routes/calendar.py:**
```python
from flask import jsonify

@bp.route('/events/json')
@login_required
def get_events_json():
    """API endpoint para FullCalendar"""
    start = request.args.get('start')
    end = request.args.get('end')
    
    # Obtener eventos del usuario
    events = CalendarEvent.get_by_date_range(
        current_user.id, 
        start, 
        end
    )
    
    # Convertir a formato JSON
    events_data = []
    for event in events:
        event_dict = {
            'id': event.id,
            'title': event.title,
            'start': event.start_datetime.isoformat(),
            'end': event.end_datetime.isoformat(),
            'allDay': event.all_day,
            'backgroundColor': event.color,
            'extendedProps': {
                'type': event.event_type,
                'location': event.location,
                'description': event.description,
                'participants': event.get_participants()
            }
        }
        events_data.append(event_dict)
    
    # Retornar JSON
    return jsonify(events_data)
```

#### **4.3. Consumo de JSON desde JavaScript**
- ✅ **Aplicado:** Fetch API

**app/templates/calendar/index.html:**
```javascript
// Cargar eventos desde API
async function loadEvents() {
    try {
        const response = await fetch('/calendar/events/json');
        const events = await response.json();
        
        calendar.removeAllEvents();
        calendar.addEventSource(events);
    } catch (error) {
        console.error('Error cargando eventos:', error);
        showToast('Error al cargar eventos', 'error');
    }
}

// Crear evento
async function createEvent(eventData) {
    try {
        const response = await fetch('/calendar/events/create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(eventData)
        });
        
        const result = await response.json();
        
        if (result.success) {
            showToast('Evento creado correctamente', 'success');
            loadEvents();
        } else {
            showToast('Error: ' + result.error, 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('Error al crear evento', 'error');
    }
}
```

#### **4.4. Validación de JSON**
- ✅ **Aplicado:** Esquemas de validación

```python
def validate_event_data(data):
    """Validar datos de evento"""
    required_fields = ['title', 'start', 'end', 'user_id']
    
    # Verificar campos requeridos
    for field in required_fields:
        if field not in data:
            return False, f"Campo {field} es obligatorio"
    
    # Validar tipos
    if not isinstance(data['title'], str):
        return False, "El título debe ser texto"
    
    # Validar fechas
    try:
        start = datetime.fromisoformat(data['start'])
        end = datetime.fromisoformat(data['end'])
        if end < start:
            return False, "La fecha de fin debe ser posterior al inicio"
    except ValueError:
        return False, "Formato de fecha inválido"
    
    return True, "OK"
```

---

### **UNIDAD 5: JINJA2 - PLANTILLAS DINÁMICAS**

#### **5.1. Sintaxis de Jinja2**
- ✅ **Aplicado:** Generación dinámica de HTML

```html
<!-- Variables -->
<h1>Bienvenido, {{ current_user.full_name or current_user.username }}!</h1>

<!-- Condicionales -->
{% if current_user.is_authenticated %}
    <a href="/profile/">Mi Perfil</a>
{% else %}
    <a href="/auth/login">Iniciar Sesión</a>
{% endif %}

<!-- Bucles -->
<ul class="contacts-list">
    {% for contact in contacts %}
        <li class="contact-item">
            <img src="{{ contact.avatar or '/static/default-avatar.png' }}" alt="Avatar">
            <div>
                <strong>{{ contact.full_name or contact.username }}</strong>
                <span>{{ contact.email }}</span>
            </div>
        </li>
    {% else %}
        <li>No tienes contactos aún</li>
    {% endfor %}
</ul>

<!-- Filtros -->
<p>Miembro desde: {{ user.created_at|datetimeformat }}</p>
<p>Nombre: {{ user.username|capitalize }}</p>
<p>Bio: {{ user.bio|truncate(100) }}</p>

<!-- Herencia de plantillas -->
{% extends "base.html" %}

{% block title %}Contactos - eID{% endblock %}

{% block content %}
    <h1>Mis Contactos</h1>
    <!-- Contenido específico -->
{% endblock %}

<!-- Inclusión de plantillas -->
{% include "components/navbar.html" %}
{% include "components/footer.html" %}

<!-- Macros (funciones reutilizables) -->
{% macro render_contact_card(contact) %}
    <div class="contact-card">
        <img src="{{ contact.avatar }}" alt="{{ contact.username }}">
        <h3>{{ contact.full_name }}</h3>
        <p>{{ contact.email }}</p>
    </div>
{% endmacro %}

<!-- Uso del macro -->
{% for contact in contacts %}
    {{ render_contact_card(contact) }}
{% endfor %}
```

---

## ARQUITECTURA DE PLANTILLAS

```
app/templates/
├── base.html                    # Plantilla base
├── components/
│   ├── navbar.html             # Barra de navegación
│   ├── footer.html             # Pie de página
│   └── toast.html              # Notificaciones
├── auth/
│   ├── login.html              # Inicio de sesión
│   └── register.html           # Registro
├── profile/
│   ├── view.html               # Ver perfil
│   └── edit.html               # Editar perfil
├── contacts/
│   └── index.html              # Lista de contactos
├── chat/
│   └── index.html              # Chat
└── calendar/
    └── index.html              # Calendario
```

---

## DEMOSTRACIÓN DE FUNCIONALIDAD

### **1. Formulario HTML5 con Validación**
```html
<form id="contactForm" novalidate>
    <input type="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
    <button type="submit">Enviar</button>
</form>

<script>
document.getElementById('contactForm').addEventListener('submit', (e) => {
    e.preventDefault();
    if (!e.target.checkValidity()) {
        alert('Por favor, complete el formulario correctamente');
    }
});
</script>
```

### **2. API JSON**
```bash
# Obtener eventos
curl http://127.0.0.1:5000/calendar/events/json

# Crear evento
curl -X POST http://127.0.0.1:5000/calendar/events/create \
  -H "Content-Type: application/json" \
  -d '{"title":"Reunión","start":"2025-11-10T10:00"}'
```

### **3. Responsive Design**
```css
/* Funciona en móvil (320px) hasta 4K (2560px+) */
@media (max-width: 640px) {
    .contacts-grid { grid-template-columns: 1fr; }
}
```

---

## RÚBRICA DE EVALUACIÓN

| Criterio | Peso | Cumplimiento | Evidencia |
|----------|------|--------------|-----------|
| **HTML5 Semántico** | 25% | ✅ Completo | 30+ archivos .html, etiquetas semánticas |
| **CSS3 Avanzado** | 20% | ✅ Completo | Flexbox, Grid, animaciones, responsive |
| **Formularios** | 15% | ✅ Completo | Validación HTML5, tipos de input |
| **JSON** | 15% | ✅ Completo | API REST, intercambio de datos |
| **Jinja2** | 15% | ✅ Completo | Plantillas dinámicas, herencia |
| **Accesibilidad** | 5% | ✅ Bueno | Labels, ARIA, alt text |
| **SEO** | 5% | ✅ Bueno | Meta tags, estructura semántica |

---

## CONCLUSIONES

El proyecto eID demuestra dominio de Lenguajes de Marcas:

✅ **HTML5** semántico y accesible  
✅ **CSS3** moderno (Flexbox, Grid, animaciones)  
✅ **JSON** para APIs REST  
✅ **Jinja2** para plantillas dinámicas  
✅ **Responsive** design (móvil → desktop)  

**Complejidad:** Alta  
**Archivos HTML:** 30+  
**Líneas CSS:** >1500 líneas  

---

**Firma del alumno:** ___________________  
**Fecha:** ___/___/2025
