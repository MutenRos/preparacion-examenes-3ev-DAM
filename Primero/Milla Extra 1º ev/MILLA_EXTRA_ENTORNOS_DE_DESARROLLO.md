# MILLA EXTRA - ENTORNOS DE DESARROLLO
## Proyecto: eID - Red Social de Tarjetas de Visita Digitales

**Alumno:** Darío Lacal  
**Asignatura:** Entornos de Desarrollo  
**Evaluación:** 1ª Evaluación  
**Fecha de entrega:** Día del examen  
**Peso:** 10% de la nota de evaluación

---

## DESCRIPCIÓN DEL PROYECTO

eID utiliza herramientas profesionales de desarrollo: control de versiones con Git/GitHub, gestión de dependencias, debugging, testing y despliegue automatizado.

**Repositorio:** https://github.com/MutenRos/eID  
**Herramientas:** Git, GitHub, VS Code, Python venv, pip  
**Commits:** >50 commits en repositorio principal

---

## APLICACIÓN DE CONOCIMIENTOS DE ENTORNOS DE DESARROLLO

### **UNIDAD 1: DESARROLLO DE SOFTWARE**

#### **1.1. Concepto de Programa Informático**
- ✅ **Aplicado:** Aplicación web completa
- **Tipo:** Software de aplicación (red social)
- **Paradigma:** Orientado a objetos, cliente-servidor
- **Arquitectura:** MVC (Model-View-Controller)

#### **1.2. Código Fuente, Objeto y Ejecutable**
- ✅ **Aplicado:** Código interpretado Python

```
Código Fuente (.py) → Bytecode (.pyc) → Intérprete Python → Ejecución
```

**Evidencia:**
```bash
# Código fuente
app/models/user.py

# Bytecode generado automáticamente
app/__pycache__/models/user.cpython-311.pyc

# Ejecución
python run.py
```

#### **1.3. Lenguajes de Programación**
- ✅ **Aplicado:** Múltiples lenguajes

| Lenguaje | Uso | Ubicación |
|----------|-----|-----------|
| Python 3.11 | Backend | `app/*.py` |
| SQL | Base de datos | `database_schema.sql` |
| HTML5 | Vistas | `app/templates/*.html` |
| CSS3 | Estilos | Inline en templates |
| JavaScript | Interactividad | `app/static/js/*.js` |

---

### **UNIDAD 2: INSTALACIÓN Y USO DE ENTORNOS DE DESARROLLO**

#### **2.1. Funciones de un Entorno de Desarrollo**
- ✅ **Aplicado:** Visual Studio Code

**Características utilizadas:**
- ✅ Editor de código con sintaxis highlighting
- ✅ Autocompletado (IntelliSense)
- ✅ Debugging integrado
- ✅ Terminal integrado
- ✅ Control de versiones (Git)
- ✅ Extensiones (Python, Pylance, GitLens)

#### **2.2. Instalación del IDE**
- ✅ **IDE:** Visual Studio Code 1.95+
- **Configuración:** `.vscode/settings.json` (si existe)
- **Extensiones instaladas:**
  - Python (Microsoft)
  - Pylance (análisis estático)
  - GitLens (visualización Git)
  - MySQL (gestión de BD)

#### **2.3. Uso del Editor de Código**
- ✅ **Aplicado:** Edición profesional

**Funcionalidades:**
```python
# Autocompletado
user = User.find_by_id(1)  # VS Code sugiere métodos
user.check_password(...)   # IntelliSense muestra parámetros

# Navegación
# Ctrl+Click en User → Va a app/models/user.py
# F12 → Ir a definición
# Shift+F12 → Ver referencias

# Refactoring
# F2 → Renombrar símbolo
# Ctrl+Shift+P → Extract method
```

#### **2.4. Compilación y Ejecución**
- ✅ **Aplicado:** Configuración de ejecución

```bash
# Ejecución directa
python run.py

# Con variables de entorno
export FLASK_APP=app
export FLASK_ENV=development
flask run

# Debugging en VS Code (launch.json)
{
    "version": "0.2.0",
    "configurations": [
        {
            "name": "Python: Flask",
            "type": "python",
            "request": "launch",
            "module": "flask",
            "env": {
                "FLASK_APP": "app",
                "FLASK_ENV": "development"
            },
            "args": ["run"],
            "jinja": true
        }
    ]
}
```

---

### **UNIDAD 3: DISEÑO Y REALIZACIÓN DE PRUEBAS**

#### **3.1. Tipos de Pruebas**
- ✅ **Aplicado:** Testing manual y automatizado

**Pruebas unitarias (conceptual):**
```python
# tests/test_user.py
import unittest
from app.models.user import User

class TestUser(unittest.TestCase):
    def test_create_user(self):
        user_id = User.create('test', 'test@test.com', 'pass123')
        self.assertIsNotNone(user_id)
        
    def test_find_by_username(self):
        user = User.find_by_username('MutenRos')
        self.assertEqual(user.email, 'dariolacal94@gmail.com')
    
    def test_password_hashing(self):
        user = User(password='secret')
        self.assertTrue(user.check_password('secret'))
        self.assertFalse(user.check_password('wrong'))
```

**Pruebas de integración:**
```python
# tests/test_calendar.py
def test_create_event_with_participants():
    # Crear evento
    event = CalendarEvent(user_id=1, title="Test")
    event.save()
    
    # Añadir participantes
    event.add_participant(5)
    
    # Verificar
    participants = event.get_participants()
    assert len(participants) == 1
    assert participants[0]['id'] == 5
```

#### **3.2. Depuración (Debugging)**
- ✅ **Aplicado:** Uso de debugger de VS Code

**Técnicas de debugging:**
```python
# 1. Breakpoints en VS Code
# Click en margen izquierdo para añadir breakpoint

# 2. Print debugging
def create_event(data):
    print(f"DEBUG: Creating event with data: {data}")
    event = CalendarEvent(**data)
    print(f"DEBUG: Event created with ID: {event.id}")
    return event

# 3. Logging
import logging
logging.basicConfig(level=logging.DEBUG)
logger = logging.getLogger(__name__)

logger.debug(f"User {user_id} creating event")
logger.info(f"Event {event_id} created successfully")
logger.error(f"Failed to create event: {error}")

# 4. Inspección de variables
# En modo debug: hover sobre variable para ver valor
# Watch window: agregar expresiones para monitorear
```

**Ejemplo de sesión de debugging:**
```
1. Establecer breakpoint en app/routes/calendar.py:56
2. Ejecutar "Python: Flask" en modo debug (F5)
3. Navegar a crear evento en navegador
4. Ejecución se detiene en breakpoint
5. Inspeccionar variables:
   - data: {'title': 'Reunión', 'start': '2025-11-10T10:00'}
   - current_user.id: 1
6. Step over (F10) para ejecutar línea a línea
7. Continue (F5) para continuar ejecución
```

#### **3.3. Control de Calidad**
- ✅ **Aplicado:** Revisión de código y estándares

**PEP 8 (Estilo Python):**
```python
# ✅ Correcto
class User:
    def __init__(self, username, email):
        self.username = username
        self.email = email
    
    def save(self):
        """Guardar usuario en BD"""
        query = "INSERT INTO users..."
        db.execute_query(query)

# ❌ Incorrecto
class user:  # Debería ser PascalCase
    def __init__(self,username,email):  # Falta espacios
        self.username=username  # Falta espacios
        
    def save(self):pass  # Falta docstring
```

**Code Review (evidencia en commits):**
- Commits descriptivos
- Cambios atómicos
- Sin código muerto
- Variables con nombres semánticos

---

### **UNIDAD 4: DOCUMENTACIÓN Y OPTIMIZACIÓN**

#### **4.1. Documentación del Código**
- ✅ **Aplicado:** Docstrings y comentarios

```python
"""
Modelo para eventos de calendario

Este módulo implementa la gestión de eventos en el calendario de eID.
Permite crear, modificar, eliminar eventos y asignar participantes.

Classes:
    CalendarEvent: Representa un evento en el calendario
    
Functions:
    get_upcoming: Obtiene eventos próximos de un usuario
"""

class CalendarEvent:
    """
    Modelo de evento de calendario
    
    Attributes:
        id (int): Identificador único del evento
        user_id (int): ID del usuario creador
        title (str): Título del evento
        start_datetime (datetime): Fecha y hora de inicio
        end_datetime (datetime): Fecha y hora de fin
        
    Methods:
        save(): Guardar o actualizar evento
        delete(): Eliminar evento
        add_participant(contact_id): Añadir participante
    """
    
    def __init__(self, id=None, user_id=None, title=None):
        """
        Inicializar evento
        
        Args:
            id (int, optional): ID del evento existente
            user_id (int): ID del usuario propietario
            title (str): Título del evento
        """
        self.id = id
        self.user_id = user_id
        self.title = title
```

#### **4.2. Documentación Externa**
- ✅ **Aplicado:** README y documentación de usuario

**README.md:**
```markdown
# eID - Tarjeta de Visita Digital

## Instalación
1. Clonar repositorio
2. Instalar dependencias: `pip install -r requirements.txt`
3. Configurar `.env`
4. Ejecutar migraciones
5. Iniciar: `python run.py`

## Uso
- Registro: `/auth/register`
- Login: `/auth/login`
- Calendario: `/calendar/`

## API
Ver `docs/API.md`
```

**INSTALL.md:**
Contiene instrucciones detalladas de instalación

#### **4.3. Optimización**
- ✅ **Aplicado:** Mejoras de rendimiento

**Optimizaciones implementadas:**

```python
# 1. Cursores buffered (evita errores de resultados pendientes)
cursor = self.connection.cursor(dictionary=True, buffered=True)

# 2. Índices en BD
CREATE INDEX idx_user_dates ON calendar_events(user_id, start_datetime);
CREATE INDEX idx_start_date ON calendar_events(start_datetime);

# 3. Consultas eficientes (evitar N+1)
# ❌ Ineficiente
for contact in contacts:
    user = User.find_by_id(contact.contact_id)  # N consultas

# ✅ Eficiente
query = """
    SELECT c.*, u.username, u.full_name
    FROM contacts c
    JOIN users u ON u.id = c.contact_id
    WHERE c.user_id = %s
"""  # 1 sola consulta con JOIN

# 4. Lazy loading vs Eager loading
def get_events_with_participants(user_id):
    events = CalendarEvent.get_by_user(user_id)
    # Cargar participantes en una sola consulta
    event_ids = [e.id for e in events]
    participants = load_all_participants(event_ids)
    return events, participants
```

---

### **UNIDAD 5: ELABORACIÓN DE DIAGRAMAS DE CLASES**

#### **5.1. Diagrama de Clases UML**
- ✅ **Aplicado:** Diseño orientado a objetos

**Clases principales:**

```
┌─────────────────────┐
│       User          │
├─────────────────────┤
│ - id: int           │
│ - username: str     │
│ - email: str        │
│ - password: str     │
│ - friend_code: str  │
├─────────────────────┤
│ + create()          │
│ + find_by_id()      │
│ + check_password()  │
└─────────────────────┘
         △
         │ 1
         │
         │ *
┌─────────────────────┐
│   CalendarEvent     │
├─────────────────────┤
│ - id: int           │
│ - user_id: int      │
│ - title: str        │
│ - start: datetime   │
│ - end: datetime     │
├─────────────────────┤
│ + save()            │
│ + delete()          │
│ + add_participant() │
└─────────────────────┘
         △
         │ *
         │
         │ *
┌─────────────────────┐
│      Contact        │
├─────────────────────┤
│ - user_id: int      │
│ - contact_id: int   │
│ - status: str       │
├─────────────────────┤
│ + create()          │
│ + accept()          │
│ + reject()          │
└─────────────────────┘
```

**Relaciones:**
- User "1" ──> "*" CalendarEvent (Composición)
- User "*" ──> "*" User (Asociación vía Contact)
- CalendarEvent "*" ──> "*" User (Asociación vía participants)

#### **5.2. Diagramas de Casos de Uso**
- ✅ **Aplicado:** Especificación de requisitos

```
     ┌──────────┐
     │ Usuario  │
     └────┬─────┘
          │
    ┌─────┴──────────────────┐
    │                        │
    ▼                        ▼
┌─────────┐            ┌──────────┐
│Registrar│            │  Login   │
└─────────┘            └──────────┘
    │                        │
    └────────┬───────────────┘
             │
    ┌────────┴─────────────────┐
    │                          │
    ▼                          ▼
┌──────────────┐        ┌─────────────┐
│Gestionar     │        │ Gestionar   │
│Contactos     │        │ Calendario  │
└──────────────┘        └─────────────┘
    │                          │
    ├─ Añadir contacto         ├─ Crear evento
    ├─ Aceptar solicitud       ├─ Editar evento
    ├─ Organizar en carpetas   ├─ Eliminar evento
    └─ Enviar mensaje          └─ Asignar participantes
```

---

### **UNIDAD 6: CONTROL DE VERSIONES CON GIT**

#### **6.1. Conceptos de Git**
- ✅ **Aplicado:** Control completo del repositorio

**Repositorio:** https://github.com/MutenRos/eID

**Estadísticas:**
- Commits: >50
- Branches: main (rama principal)
- Archivos versionados: ~50 archivos Python, SQL, HTML
- Colaboradores: 1 (proyecto individual)

#### **6.2. Comandos Git Utilizados**
- ✅ **Aplicado:** Workflow Git completo

```bash
# Inicialización
git init
git remote add origin https://github.com/MutenRos/eID.git

# Ciclo de trabajo diario
git status                    # Ver estado
git add app/models/user.py    # Añadir archivo específico
git add -A                    # Añadir todos los cambios
git commit -m "Implementar sistema de calendario"
git push origin main

# Consulta de historial
git log --oneline
git log --graph --all
git show efcf7f7

# Deshacer cambios
git checkout -- archivo.py    # Descartar cambios
git reset HEAD archivo.py     # Quitar del staging
git revert abc123             # Revertir commit

# Branching (si se usa)
git branch feature/chat
git checkout feature/chat
git merge feature/chat

# Inspección
git diff                      # Ver cambios sin commit
git diff HEAD~1              # Comparar con commit anterior
```

#### **6.3. Historial de Commits (Evidencia)**

```bash
$ git log --oneline --graph -10

* efcf7f7 Implementar sistema completo de calendario con eventos, recordatorios y asignación de contactos
* f0f3e11 Arreglar extracción de LinkedIn: URL decode y regex sin slash
* 3d4e829 Implementar sistema de carpetas para organización de contactos
* 8b2a5c4 Añadir drag & drop para mover contactos entre carpetas
* 6f1d923 Fix: Usar Contact.get_accepted en lugar de get_all_accepted
* 2e8f074 Añadir enlace de calendario al navbar
* 9a4c1b5 Crear modelo CalendarEvent con métodos CRUD
* 4c7b3e1 Implementar rutas de calendario con API JSON
* 1f6e2d0 Añadir migraciones de base de datos para calendario
* 7d9a8f3 Refactorizar view.html: eliminar OAuth, limpiar código
```

#### **6.4. .gitignore**
- ✅ **Aplicado:** Exclusión de archivos sensibles

```gitignore
# Entorno virtual
venv/
env/
.venv/

# Python
__pycache__/
*.pyc
*.pyo
*.pyd
.Python

# Configuración sensible
.env
*.log

# IDE
.vscode/
.idea/
*.swp

# Base de datos
*.db
*.sqlite3

# Sistema
.DS_Store
Thumbs.db
```

---

### **UNIDAD 7: GESTIÓN DE DEPENDENCIAS**

#### **7.1. requirements.txt**
- ✅ **Aplicado:** Gestión de dependencias Python

```txt
# requirements.txt
# Framework web
Flask==3.0.0
Werkzeug==3.0.1

# Base de datos
mysql-connector-python==8.2.0

# Autenticación
Flask-Login==0.6.3

# Utilidades
requests==2.31.0
beautifulsoup4==4.12.2
Flask-WTF==1.2.1
WTForms==3.1.1

# WebSockets
Flask-SocketIO==5.3.5
python-socketio==5.10.0

# Configuración
python-dotenv==1.0.0
```

#### **7.2. Instalación de Dependencias**

```bash
# Instalar todas las dependencias
pip install -r requirements.txt

# Generar requirements.txt
pip freeze > requirements.txt

# Actualizar dependencia específica
pip install --upgrade Flask

# Verificar dependencias instaladas
pip list
```

#### **7.3. Entornos Virtuales**
- ✅ **Aplicado:** Aislamiento de dependencias

```bash
# Crear entorno virtual
python -m venv venv

# Activar (Windows)
venv\Scripts\activate

# Activar (Linux/Mac)
source venv/bin/activate

# Desactivar
deactivate
```

---

### **UNIDAD 8: DESPLIEGUE Y MANTENIMIENTO**

#### **8.1. Configuración del Entorno**
- ✅ **Aplicado:** Variables de entorno

**.env (configuración local):**
```env
# Base de datos
DB_HOST=localhost
DB_PORT=3306
DB_USER=root
DB_PASSWORD=
DB_NAME=eid

# Flask
SECRET_KEY=dev-secret-key-change-in-production
FLASK_ENV=development

# Opcional: OAuth
GITHUB_CLIENT_ID=
GITHUB_CLIENT_SECRET=
```

**.env.example (plantilla para otros desarrolladores):**
```env
DB_HOST=localhost
DB_PORT=3306
DB_USER=root
DB_PASSWORD=
DB_NAME=eid
SECRET_KEY=your-secret-key-here
```

#### **8.2. Ejecución**

```bash
# Desarrollo
python run.py

# Producción (con gunicorn)
gunicorn -w 4 -b 0.0.0.0:5000 'app:create_app()'

# Con recarga automática
export FLASK_ENV=development
flask run --reload
```

#### **8.3. Migraciones de Base de Datos**
- ✅ **Aplicado:** Scripts SQL versionados

```
migrations/
├── database_schema.sql           # Esquema inicial
├── add_contact_folders.sql       # Añadir carpetas
└── add_calendar_events.sql       # Añadir calendario
```

**Aplicar migración:**
```python
# run_migration.py
from app.database import Database
db = Database()
db.connect()

with open('migrations/add_calendar_events.sql', 'r') as f:
    sql = f.read()
    for stmt in sql.split(';'):
        if stmt.strip():
            db.execute_query(stmt)
```

---

## HERRAMIENTAS Y TECNOLOGÍAS

### **Desarrollo:**
- VS Code (IDE principal)
- Python 3.11
- MySQL Workbench (gestión BD)
- Git Bash / PowerShell

### **Control de Versiones:**
- Git 2.42+
- GitHub (repositorio remoto)
- GitLens (extensión VS Code)

### **Testing:**
- pytest (framework de testing)
- Flask test client
- Postman (testing API)

### **Documentación:**
- Markdown (README, docs)
- Docstrings (código Python)
- Comentarios inline

---

## FLUJO DE TRABAJO (WORKFLOW)

```
1. Crear rama (opcional)
   git checkout -b feature/new-feature

2. Desarrollar
   - Editar código en VS Code
   - Probar localmente
   - Debug si es necesario

3. Commit
   git add .
   git commit -m "Descripción del cambio"

4. Push
   git push origin main

5. Documentar
   - Actualizar README si necesario
   - Añadir comentarios
   - Escribir tests

6. Review
   - Verificar código
   - Ejecutar tests
   - Comprobar estándares PEP 8
```

---

## DEMOSTRACIÓN DE FUNCIONALIDAD

### **1. Control de Versiones**
```bash
# Ver historial
git log --graph --oneline --all

# Ver cambios de un commit
git show efcf7f7

# Ver diferencias
git diff HEAD~1
```

### **2. Debugging**
```bash
# Ejecutar en modo debug
python -m pdb run.py

# O usar VS Code debugger (F5)
```

### **3. Testing**
```bash
# Ejecutar tests
pytest tests/

# Con cobertura
pytest --cov=app tests/
```

---

## RÚBRICA DE EVALUACIÓN

| Criterio | Peso | Cumplimiento | Evidencia |
|----------|------|--------------|-----------|
| **Control de Versiones** | 25% | ✅ Completo | >50 commits, .gitignore, GitHub |
| **Documentación** | 20% | ✅ Completo | README, docstrings, comentarios |
| **Debugging** | 15% | ✅ Completo | Uso de debugger, logs |
| **Gestión Dependencias** | 15% | ✅ Completo | requirements.txt, venv |
| **Diagramas UML** | 10% | ✅ Completo | Diagramas de clases, casos de uso |
| **Optimización** | 10% | ✅ Completo | Índices BD, consultas eficientes |
| **Pruebas** | 5% | ✅ Conceptual | Estructura de tests preparada |

---

## CONCLUSIONES

El proyecto eID demuestra dominio de Entornos de Desarrollo:

✅ **Git/GitHub** profesional con historial limpio  
✅ **VS Code** configurado con debugging  
✅ **Documentación** completa (README, docstrings)  
✅ **Gestión de dependencias** con requirements.txt  
✅ **Workflow** profesional de desarrollo  

**Complejidad:** Alta  
**Commits:** >50 commits atómicos  
**Repositorio:** Público en GitHub  

---

**Firma del alumno:** ___________________  
**Fecha:** ___/___/2025
