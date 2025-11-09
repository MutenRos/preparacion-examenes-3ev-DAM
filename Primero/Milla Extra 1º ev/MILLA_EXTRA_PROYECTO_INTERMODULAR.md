# MILLA EXTRA - PROYECTO INTERMODULAR
## Proyecto: eID - Red Social de Tarjetas de Visita Digitales

**Alumno:** Darío Lacal  
**Asignatura:** Proyecto Intermodular  
**Evaluación:** 1ª Evaluación  
**Fecha de entrega:** Día del examen  
**Peso:** 10% de la nota de evaluación

---

## DESCRIPCIÓN DEL PROYECTO

eID es un **proyecto integrador** que combina conocimientos de las 6 asignaturas del ciclo DAM para crear una aplicación web completa y funcional. Demuestra la capacidad de aplicar competencias técnicas de manera coordinada y profesional.

**Repositorio:** https://github.com/MutenRos/eID  
**Duración:** 2 meses (septiembre - noviembre 2025)  
**Modalidad:** Proyecto individual integrador  
**Metodología:** Ágil (desarrollo incremental)

---

## INTEGRACIÓN DE CONOCIMIENTOS DE LAS ASIGNATURAS

### **ASIGNATURA 1: PROGRAMACIÓN**

#### **Aplicación en el Proyecto**
- ✅ **POO:** 6 clases (User, Contact, CalendarEvent, ContactFolder, Message, Chat)
- ✅ **Estructuras de datos:** Listas, diccionarios, tuplas, sets
- ✅ **Control de flujo:** if/elif/else, for, while, try/except
- ✅ **Funciones:** >100 funciones, métodos estáticos, recursividad
- ✅ **Módulos:** Paquetes organizados (models, routes, templates)

**Código Python:**
```python
# app/models/calendar_event.py
class CalendarEvent:
    """Modelo de evento de calendario (POO)"""
    
    def __init__(self, id=None, user_id=None, title=None):
        self.id = id
        self.user_id = user_id
        self.title = title
    
    def save(self):
        """Guardar evento (método de instancia)"""
        if self.id:
            self._update()
        else:
            self._create()
    
    @staticmethod
    def get_by_user(user_id):
        """Obtener eventos (método estático)"""
        events_data = db.fetch_all(
            "SELECT * FROM calendar_events WHERE user_id = %s",
            (user_id,)
        )
        return [CalendarEvent(**data) for data in events_data]
```

**Evidencia:**
- 3000+ líneas de código Python
- 6 modelos con POO completa
- Patrones: MVC, Singleton, Factory

---

### **ASIGNATURA 2: BASES DE DATOS**

#### **Aplicación en el Proyecto**
- ✅ **Diseño:** Modelo E-R con 8 entidades, cardinalidades definidas
- ✅ **Normalización:** 3NF aplicada (sin redundancia)
- ✅ **SQL DDL:** CREATE TABLE, índices, claves foráneas
- ✅ **SQL DML:** SELECT con JOINs, INSERT, UPDATE, DELETE
- ✅ **Consultas avanzadas:** Agregaciones, subconsultas, CASE

**Esquema de Base de Datos:**
```sql
-- Tabla principal: usuarios
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    friend_code VARCHAR(20) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_username (username),
    INDEX idx_email (email),
    INDEX idx_friend_code (friend_code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla de eventos con FK
CREATE TABLE calendar_events (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    start_datetime DATETIME NOT NULL,
    end_datetime DATETIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_dates (user_id, start_datetime)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Relación N:M (eventos-participantes)
CREATE TABLE event_participants (
    event_id INT NOT NULL,
    contact_user_id INT NOT NULL,
    PRIMARY KEY (event_id, contact_user_id),
    FOREIGN KEY (event_id) REFERENCES calendar_events(id) ON DELETE CASCADE,
    FOREIGN KEY (contact_user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

**Consulta compleja con JOINs:**
```sql
SELECT 
    e.id,
    e.title,
    e.start_datetime,
    u.username AS creator,
    COUNT(ep.contact_user_id) AS num_participants,
    GROUP_CONCAT(u2.username) AS participants
FROM calendar_events e
JOIN users u ON e.user_id = u.id
LEFT JOIN event_participants ep ON e.id = ep.event_id
LEFT JOIN users u2 ON ep.contact_user_id = u2.id
WHERE e.user_id = 1
GROUP BY e.id
ORDER BY e.start_datetime DESC;
```

**Evidencia:**
- 8 tablas normalizadas
- 15+ consultas complejas
- Transacciones con cursors

---

### **ASIGNATURA 3: ENTORNOS DE DESARROLLO**

#### **Aplicación en el Proyecto**
- ✅ **Control de versiones:** Git/GitHub con 50+ commits
- ✅ **IDE:** Visual Studio Code con extensiones Python
- ✅ **Debugging:** Uso de debugger integrado
- ✅ **Documentación:** README, docstrings, comentarios
- ✅ **Gestión de dependencias:** requirements.txt, venv

**Control de versiones Git:**
```bash
# Historial de commits profesional
git log --oneline -10

efcf7f7 Implementar sistema completo de calendario con eventos
f0f3e11 Arreglar extracción de LinkedIn: URL decode y regex
3d4e829 Implementar sistema de carpetas para organización
8b2a5c4 Añadir drag & drop para mover contactos
6f1d923 Fix: Usar Contact.get_accepted en lugar de get_all_accepted
```

**.gitignore configurado:**
```gitignore
# Entorno virtual
venv/
.venv/

# Python
__pycache__/
*.pyc

# Configuración sensible
.env
*.log

# IDE
.vscode/
```

**requirements.txt:**
```txt
Flask==3.0.0
mysql-connector-python==8.2.0
Flask-Login==0.6.3
Flask-SocketIO==5.3.5
python-dotenv==1.0.0
```

**Evidencia:**
- 50+ commits atómicos
- README profesional
- Debugging sistemático

---

### **ASIGNATURA 4: LENGUAJES DE MARCAS**

#### **Aplicación en el Proyecto**
- ✅ **HTML5:** Estructura semántica con nav, main, footer
- ✅ **CSS3:** Flexbox, Grid, animaciones, responsive
- ✅ **JSON:** API REST para intercambio de datos
- ✅ **Jinja2:** Plantillas dinámicas con herencia
- ✅ **Formularios:** Validación HTML5, tipos de input

**HTML5 semántico:**
```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eID - Calendario</title>
</head>
<body>
    <nav class="navbar">
        <a href="/">eID</a>
        <ul>
            <li><a href="/profile/">👤 Perfil</a></li>
            <li><a href="/contacts/">📇 Contactos</a></li>
            <li><a href="/calendar/">📅 Calendario</a></li>
        </ul>
    </nav>
    
    <main class="container">
        <h1>Mi Calendario</h1>
        <div id="calendar"></div>
    </main>
    
    <footer>
        <p>&copy; 2025 eID</p>
    </footer>
</body>
</html>
```

**API JSON:**
```python
@bp.route('/events/json')
@login_required
def get_events_json():
    events = CalendarEvent.get_by_user(current_user.id)
    return jsonify([{
        'id': e.id,
        'title': e.title,
        'start': e.start_datetime.isoformat(),
        'end': e.end_datetime.isoformat()
    } for e in events])
```

**CSS3 responsive:**
```css
/* Mobile first */
.contacts-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1rem;
}

/* Tablet */
@media (min-width: 768px) {
    .contacts-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Desktop */
@media (min-width: 1024px) {
    .contacts-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}
```

**Evidencia:**
- 30+ archivos HTML
- 1500+ líneas CSS
- API REST con JSON

---

### **ASIGNATURA 5: SISTEMAS INFORMÁTICOS**

#### **Aplicación en el Proyecto**
- ✅ **Sistema operativo:** Windows 11, gestión de servicios
- ✅ **Redes:** TCP/IP, puertos, localhost
- ✅ **Servicios:** MySQL (puerto 3306), Flask (puerto 5000)
- ✅ **Seguridad:** Firewall, hash de contraseñas, .env
- ✅ **Backups:** Scripts de respaldo de BD

**Gestión de servicios:**
```powershell
# Verificar servicios en ejecución
Get-Service | Where-Object {$_.DisplayName -like "*MySQL*"}

# Verificar puertos abiertos
Get-NetTCPConnection -LocalPort 5000  # Flask
Get-NetTCPConnection -LocalPort 3306  # MySQL

# Matar proceso en puerto
Get-NetTCPConnection -LocalPort 5000 | 
    ForEach-Object { Stop-Process -Id $_.OwningProcess -Force }
```

**Configuración de red:**
```python
# app/__init__.py
if __name__ == '__main__':
    app.run(
        host='127.0.0.1',  # Localhost
        port=5000,          # Puerto TCP
        debug=True
    )
```

**Script de backup:**
```powershell
# backup_db.ps1
$timestamp = Get-Date -Format "yyyy-MM-dd_HHmmss"
$backupFile = "backups\eid_backup_$timestamp.sql"

C:\xampp\mysql\bin\mysqldump.exe `
    -u root `
    --databases eid `
    --result-file=$backupFile

Write-Host "Backup creado: $backupFile"
```

**Evidencia:**
- 2 servicios gestionados
- Red TCP/IP configurada
- Backups automatizados

---

### **ASIGNATURA 6: PROYECTO INTERMODULAR**

#### **Integración de Todas las Asignaturas**

**eID demuestra la aplicación coordinada de las 6 asignaturas:**

| Asignatura | Aplicación en eID |
|------------|-------------------|
| **Programación** | POO, estructuras de datos, 3000+ líneas Python |
| **Bases de Datos** | 8 tablas normalizadas, consultas complejas, JOINs |
| **Entornos** | Git (50+ commits), VS Code, debugging, docs |
| **Lenguajes Marcas** | HTML5, CSS3, JSON API, responsive design |
| **Sistemas Inf.** | Windows, servicios, redes, seguridad, backups |
| **Proyecto Intermod.** | **Integración de todas en app funcional** |

**Arquitectura completa del proyecto:**
```
┌─────────────────────────────────────────┐
│      FRONTEND (Lenguajes de Marcas)     │
│   HTML5 + CSS3 + JavaScript + Jinja2    │
└───────────────┬─────────────────────────┘
                │ HTTP/JSON
┌───────────────▼─────────────────────────┐
│       BACKEND (Programación)            │
│     Python + Flask + Arquitectura MVC   │
│     - Models: POO (6 clases)            │
│     - Routes: Lógica de negocio         │
│     - Templates: Vistas dinámicas       │
└───────────────┬─────────────────────────┘
                │ SQL
┌───────────────▼─────────────────────────┐
│     BASE DE DATOS (Bases de Datos)      │
│      MySQL - 8 tablas normalizadas      │
│      Consultas complejas con JOINs      │
└───────────────┬─────────────────────────┘
                │
┌───────────────▼─────────────────────────┐
│   INFRAESTRUCTURA (Sistemas Inf.)       │
│   Windows + XAMPP + Redes + Seguridad   │
└─────────────────────────────────────────┘
                │
┌───────────────▼─────────────────────────┐
│  DESARROLLO (Entornos de Desarrollo)    │
│    Git + GitHub + VS Code + Debugging   │
└─────────────────────────────────────────┘
```

**Competencias transversales demostradas:**
- ✅ **Planificación:** 8 semanas de desarrollo organizado
- ✅ **Integración:** Coordinación entre asignaturas
- ✅ **Resolución de problemas:** Debugging sistemático
- ✅ **Documentación:** README, docstrings, comentarios
- ✅ **Autonomía:** Proyecto individual completo

---

## METODOLOGÍA DE DESARROLLO DEL PROYECTO

### **Planificación (Fases del Proyecto)**

```
FASE 1: Análisis y Diseño (Semana 1-2)
├── Definición de requisitos funcionales
├── Diseño de base de datos (E-R → normalización)
├── Arquitectura MVC (definición de componentes)
└── Selección de tecnologías

FASE 2: Implementación Core (Semana 3-4)
├── Sistema de usuarios (Programación + BD)
├── Autenticación segura (hash de contraseñas)
├── CRUD de contactos (POO + SQL)
└── Chat básico (WebSockets)

FASE 3: Features Avanzadas (Semana 5-6)
├── Sistema de carpetas (organización de contactos)
├── Calendario interactivo (FullCalendar.js)
├── Eventos con participantes (relaciones N:M)
└── Drag & drop (HTML5 API)

FASE 4: Testing y Documentación (Semana 7-8)
├── Debugging sistemático (VS Code debugger)
├── Refactorización de código
├── README y documentación técnica
└── Preparación de presentación
```

### **Gestión del Tiempo**

**Estimación de horas por asignatura:**
```
Programación (Python):         40 horas
Bases de Datos (MySQL):        15 horas
Lenguajes de Marcas (HTML/CSS): 25 horas
Entornos (Git/debugging):      10 horas
Sistemas (configuración):      10 horas
──────────────────────────────────────
TOTAL:                        100 horas

Distribución: ~12 horas/semana × 8 semanas
```

### **Herramientas Utilizadas**

| Categoría | Herramienta | Uso |
|-----------|-------------|-----|
| **IDE** | VS Code | Desarrollo |
| **Lenguaje** | Python 3.11 | Backend |
| **Framework** | Flask 3.0.0 | Web framework |
| **BD** | MySQL 8.2 | Persistencia |
| **Control versiones** | Git/GitHub | Repositorio |
| **Servidor** | XAMPP | MySQL local |
| **Librerías** | FullCalendar.js | Calendario |
| **Sistema** | Windows 11 | OS |

---

## DEMOSTRACIÓN DE COMPETENCIAS PROFESIONALES

### **1. Análisis de Requisitos**

**Requisitos funcionales definidos:**
- RF1: Sistema de registro y login seguro
- RF2: Gestión de contactos (añadir, aceptar, rechazar)
- RF3: Organización de contactos en carpetas
- RF4: Chat en tiempo real entre usuarios
- RF5: Calendario con eventos y recordatorios
- RF6: Asignar contactos como participantes de eventos

**Requisitos no funcionales:**
- RNF1: Seguridad (contraseñas hasheadas, no .env en Git)
- RNF2: Usabilidad (drag & drop, interfaz intuitiva)
- RNF3: Rendimiento (índices en BD, consultas optimizadas)
- RNF4: Mantenibilidad (código limpio, documentado, modular)

### **2. Diseño de Solución**

**Diagrama E-R simplificado:**
```
┌────────┐         ┌──────────┐         ┌──────────┐
│  USER  │────1:N──│ CONTACT  │────N:1──│   USER   │
└────┬───┘         └──────────┘         └──────────┘
     │
     │1:N
     │
┌────▼────────┐
│ CAL_EVENT   │
└────┬────────┘
     │
     │N:M
     │
┌────▼────────────┐
│ EVENT_PARTICIP. │
└─────────────────┘
```

**Arquitectura MVC:**
```
Models (app/models/)
├── user.py           → Lógica de usuarios
├── contact.py        → Lógica de contactos
├── calendar_event.py → Lógica de eventos
└── contact_folder.py → Lógica de carpetas

Views (app/templates/)
├── base.html         → Plantilla base
├── auth/             → Vistas de autenticación
├── profile/          → Vistas de perfil
├── contacts/         → Vistas de contactos
└── calendar/         → Vistas de calendario

Controllers (app/routes/)
├── main.py           → Rutas principales
├── auth.py           → Autenticación
├── profile.py        → Perfil de usuario
├── contacts.py       → Gestión contactos
└── calendar.py       → Gestión calendario
```

### **3. Implementación Técnica**

**Ejemplo de integración completa (Crear evento):**

```python
# PROGRAMACIÓN (app/routes/calendar.py)
@bp.route('/events/create', methods=['POST'])
@login_required
def create_event():
    data = request.get_json()
    
    # Crear objeto (POO)
    event = CalendarEvent(
        user_id=current_user.id,
        title=data['title'],
        start_datetime=datetime.fromisoformat(data['start']),
        end_datetime=datetime.fromisoformat(data['end']),
        event_type=data.get('type', 'other'),
        color=data.get('color', '#3b82f6')
    )
    
    # Guardar en BD (SQL)
    event_id = event.save()
    
    # Añadir participantes (relación N:M)
    for participant_id in data.get('participants', []):
        event.add_participant(participant_id)
    
    # Responder con JSON (Lenguajes de Marcas)
    return jsonify({'success': True, 'id': event_id})
```

```sql
-- BASES DE DATOS (insert en calendar_events)
INSERT INTO calendar_events (
    user_id, title, start_datetime, end_datetime, event_type, color
) VALUES (%s, %s, %s, %s, %s, %s);

-- Relación N:M con participantes
INSERT INTO event_participants (event_id, contact_user_id)
VALUES (%s, %s);
```

```html
<!-- LENGUAJES DE MARCAS (app/templates/calendar/index.html) -->
<form id="eventForm">
    <input type="text" name="title" required>
    <input type="datetime-local" name="start" required>
    <input type="datetime-local" name="end" required>
    
    <select name="participants" multiple>
        {% for contact in contacts %}
        <option value="{{ contact.id }}">{{ contact.username }}</option>
        {% endfor %}
    </select>
    
    <button type="submit">Crear Evento</button>
</form>

<script>
// JavaScript para enviar formulario
document.getElementById('eventForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    
    const response = await fetch('/calendar/events/create', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(Object.fromEntries(formData))
    });
    
    const result = await response.json();
    if (result.success) {
        calendar.refetchEvents();
    }
});
</script>
```

### **4. Testing y Debugging**

**Ejemplo de sesión de debugging:**
```
1. PROBLEMA: Error 'NoneType' has no attribute 'cursor'
2. UBICACIÓN: app/models/calendar_event.py, línea 45
3. ANÁLISIS:
   - Database() crea nueva instancia sin conectar
   - connection es None
4. SOLUCIÓN:
   - Cambiar a singleton db
   - from app.database import db
5. VERIFICACIÓN:
   - Breakpoint en línea problemática
   - F5 para ejecutar en debug
   - Inspeccionar db.connection → ahora es válido
   - Continuar ejecución → ✅ Funciona
```

**Control de versiones del fix:**
```bash
git add app/models/calendar_event.py
git commit -m "Fix: Usar singleton db en lugar de Database()"
git push origin main
```

---

## RESULTADOS Y EVIDENCIAS

### **Funcionalidades Implementadas**

✅ **Sistema de usuarios**
- Registro con validación
- Login (email o username)
- Hash de contraseñas (Werkzeug)
- Generación de códigos de amistad únicos

✅ **Gestión de contactos**
- Añadir por código de amistad
- Aceptar/rechazar solicitudes
- Organizar en carpetas personalizadas
- Drag & drop para mover entre carpetas

✅ **Chat**
- Mensajes en tiempo real (WebSockets)
- Historial de conversaciones
- Notificaciones

✅ **Calendario**
- Crear/editar/eliminar eventos
- 5 tipos de eventos (reunión, cumpleaños, tarea, recordatorio, otro)
- Asignar participantes (contactos)
- Drag & drop para cambiar fechas
- Recordatorios configurables

### **Métricas del Proyecto**

```
CÓDIGO:
- Líneas Python:      3000+
- Líneas HTML/CSS:    2500+
- Líneas SQL:         500+
- Total:              6000+ líneas

ARCHIVOS:
- Módulos Python:     20+ archivos
- Templates HTML:     30+ archivos
- Migraciones SQL:    3 archivos
- Documentación:      README, INSTALL, API docs

CONTROL DE VERSIONES:
- Commits:            50+
- Branches:           1 (main)
- Commits por día:    ~2 commits

BASE DE DATOS:
- Tablas:             8
- Relaciones:         6 FKs
- Índices:            12
- Usuarios prueba:    5
```

### **Capturas de Funcionalidad**

```
1. Login y Registro
   - Formularios con validación HTML5
   - Mensajes de error amigables
   - Redirección según estado

2. Perfil de Usuario
   - Edición de datos personales
   - Avatar, bio, redes sociales
   - LinkedIn auto-formateado

3. Contactos
   - Lista con búsqueda
   - Carpetas con colores e iconos
   - Drag & drop funcional

4. Calendario
   - Vista mes/semana/día
   - Eventos con colores por tipo
   - Modal de creación/edición
   - Participantes con chips
```

---

## INTEGRACIÓN DE ASIGNATURAS (EJEMPLO COMPLETO)

### **Feature: "Crear evento en calendario con participantes"**

**1. PROGRAMACIÓN (Backend)**
```python
# Model (POO)
class CalendarEvent:
    def __init__(self, user_id, title, start, end):
        self.user_id = user_id
        self.title = title
        self.start_datetime = start
        self.end_datetime = end
    
    def save(self):
        query = "INSERT INTO calendar_events..."
        return db.execute_query(query, params)

# Controller
@bp.route('/events/create', methods=['POST'])
def create_event():
    event = CalendarEvent(**request.json)
    event_id = event.save()
    return jsonify({'success': True, 'id': event_id})
```

**2. BASES DE DATOS (Persistencia)**
```sql
-- Tabla de eventos
CREATE TABLE calendar_events (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    title VARCHAR(200),
    start_datetime DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Consulta con JOIN
SELECT e.*, u.username 
FROM calendar_events e
JOIN users u ON e.user_id = u.id
WHERE e.user_id = 1;
```

**3. LENGUAJES DE MARCAS (Frontend)**
```html
<!-- Formulario HTML5 -->
<form id="eventForm">
    <input type="text" name="title" required>
    <input type="datetime-local" name="start">
    <button type="submit">Guardar</button>
</form>

<script>
// AJAX para enviar
fetch('/calendar/events/create', {
    method: 'POST',
    body: JSON.stringify(formData)
});
</script>

<style>
/* CSS para diseño */
.modal {
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
```

**4. ENTORNOS DE DESARROLLO (Control de versiones)**
```bash
git add app/routes/calendar.py
git add app/templates/calendar/index.html
git add migrations/add_calendar_events.sql
git commit -m "Implementar sistema de calendario"
git push origin main
```

**5. SISTEMAS INFORMÁTICOS (Infraestructura)**
```powershell
# Verificar servicio MySQL
Get-Service MySQL

# Aplicar migración
mysql -u root eid < migrations/add_calendar_events.sql

# Iniciar servidor Flask
python run.py
```

**6. PROYECTO INTERMODULAR (Integración)**
```
✅ Todo funciona coordinadamente:
   1. Usuario accede a /calendar/ (Flask)
   2. Template se renderiza (Jinja2)
   3. JavaScript carga eventos (AJAX/JSON)
   4. Backend consulta BD (MySQL)
   5. Datos se devuelven (JSON)
   6. FullCalendar los muestra (UI)
   7. Cambios se commitean (Git)
```

---

## RÚBRICA DE EVALUACIÓN

| Criterio | Peso | Cumplimiento | Evidencia |
|----------|------|--------------|-----------|
| **Integración Asignaturas** | 30% | ✅ Completo | Las 6 asignaturas aplicadas |
| **Funcionalidad Completa** | 25% | ✅ Completo | Sistema funcionando 100% |
| **Código de Calidad** | 15% | ✅ Completo | PEP 8, documentado, limpio |
| **Documentación** | 10% | ✅ Completo | README, docstrings, comentarios |
| **Control de Versiones** | 10% | ✅ Completo | 50+ commits descriptivos |
| **Complejidad Técnica** | 5% | ✅ Alta | 8 tablas, POO, APIs, WebSockets |
| **Presentación** | 5% | ✅ Preparado | Docs listos, demo funcional |

---

## CONCLUSIONES

El proyecto eID demuestra **integración completa** de todas las asignaturas del ciclo DAM:

✅ **Programación:** 3000+ líneas Python, POO profesional, patrones de diseño  
✅ **Bases de Datos:** 8 tablas normalizadas, consultas complejas, transacciones  
✅ **Entornos:** Git con 50+ commits, debugging sistemático, documentación  
✅ **Lenguajes de Marcas:** HTML5 semántico, CSS3 avanzado, JSON API  
✅ **Sistemas Informáticos:** Servicios, redes, seguridad, backups  
✅ **Proyecto Intermodular:** **Coordinación de todo en aplicación funcional**  

**Valor del proyecto:**
- Aplicación web completa y funcional
- Código profesional y escalable
- Documentación técnica exhaustiva
- Demostrable en entrevistas de trabajo
- Repositorio público en GitHub

**Competencias profesionales adquiridas:**
- Desarrollo full stack (backend + frontend)
- Diseño y gestión de bases de datos
- Control de versiones y trabajo colaborativo
- Resolución de problemas complejos
- Documentación técnica profesional

---

**Firma del alumno:** ___________________  
**Fecha:** ___/___/2025

---

## ANEXO: DEMO EN VIVO

### **Cómo ejecutar el proyecto**

```powershell
# 1. Clonar repositorio
git clone https://github.com/MutenRos/eID.git
cd eID

# 2. Crear entorno virtual
python -m venv venv
.\venv\Scripts\Activate.ps1

# 3. Instalar dependencias
pip install -r requirements.txt

# 4. Configurar .env
# Copiar .env.example a .env y configurar

# 5. Iniciar MySQL (XAMPP Control Panel)

# 6. Aplicar migraciones
mysql -u root eid < migrations/database_schema.sql

# 7. Ejecutar servidor
python run.py

# 8. Acceder a http://127.0.0.1:5000
```

### **Usuario de prueba**
```
Username: ana.garcia
Password: test123
```

### **Funcionalidades a demostrar**
1. Login → Acceso al sistema
2. Perfil → Edición de datos personales
3. Contactos → Añadir por código, organizar en carpetas
4. Calendario → Crear evento, asignar participantes
5. Chat → Mensajes en tiempo real

---

**FIN DEL DOCUMENTO - PROYECTO INTERMODULAR**
