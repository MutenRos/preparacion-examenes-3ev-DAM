# MILLA EXTRA - SISTEMAS INFORMÁTICOS
## Proyecto: eID - Red Social de Tarjetas de Visita Digitales

**Alumno:** Darío Lacal  
**Asignatura:** Sistemas Informáticos  
**Evaluación:** 1ª Evaluación  
**Fecha de entrega:** Día del examen  
**Peso:** 10% de la nota de evaluación

---

## DESCRIPCIÓN DEL PROYECTO

eID es una aplicación web que requiere configuración de servidor, gestión de base de datos, seguridad de red y administración de servicios. Se ejecuta en arquitectura cliente-servidor con MySQL/MariaDB y Flask.

**Repositorio:** https://github.com/MutenRos/eID  
**Stack:** Windows 11 + XAMPP + Python 3.11 + MySQL  
**Servicios:** Apache, MySQL, Flask development server

---

## APLICACIÓN DE CONOCIMIENTOS DE SISTEMAS INFORMÁTICOS

### **UNIDAD 1: EXPLOTACIÓN DE SISTEMAS MICROINFORMÁTICOS**

#### **1.1. Arquitectura de Computadores**
- ✅ **Aplicado:** Sistema operativo Windows 11

**Componentes utilizados:**
- **CPU:** Procesamiento de peticiones HTTP, consultas SQL
- **RAM:** Almacenamiento de sesiones de usuario, caché de datos
- **Disco:** Base de datos MySQL, archivos estáticos (imágenes, CSS)
- **Red:** Comunicación cliente-servidor en localhost

**Evidencia:**
```powershell
# Verificar recursos del sistema
Get-Process python | Select-Object CPU, WorkingSet
Get-Process mysqld | Select-Object CPU, WorkingSet

# Espacio en disco usado por BD
Get-ChildItem "C:\xampp\mysql\data\eid" | Measure-Object -Property Length -Sum
```

#### **1.2. Sistema Operativo Windows**
- ✅ **Aplicado:** Administración de Windows 11

**Tareas realizadas:**
```powershell
# Ver servicios en ejecución
Get-Service | Where-Object {$_.DisplayName -like "*MySQL*"}
Get-Service | Where-Object {$_.DisplayName -like "*Apache*"}

# Verificar puertos abiertos
Get-NetTCPConnection -LocalPort 3306  # MySQL
Get-NetTCPConnection -LocalPort 5000  # Flask
Get-NetTCPConnection -LocalPort 80    # Apache (si se usa)

# Variables de entorno
$env:FLASK_APP="app"
$env:FLASK_ENV="development"

# Procesos en ejecución
Get-Process python
Get-Process mysqld

# Matar proceso en puerto específico
Get-NetTCPConnection -LocalPort 5000 | 
    ForEach-Object { Stop-Process -Id $_.OwningProcess -Force }
```

#### **1.3. Gestión de Archivos**
- ✅ **Aplicado:** Estructura de directorios del proyecto

```
C:\Users\freak\Desktop\DAM2527\GIT_DAM_25-27\Primero\Milla Extra 1º ev\eID\
├── app/
│   ├── __init__.py
│   ├── database.py
│   ├── models/
│   ├── routes/
│   ├── templates/
│   └── static/
├── migrations/
│   ├── database_schema.sql
│   ├── add_contact_folders.sql
│   └── add_calendar_events.sql
├── venv/
├── .env
├── .gitignore
├── requirements.txt
├── run.py
└── README.md
```

**Comandos de gestión:**
```powershell
# Crear estructura de directorios
New-Item -ItemType Directory -Path "app\models", "app\routes", "app\templates"

# Copiar archivos
Copy-Item database_schema.sql migrations\

# Eliminar archivos temporales
Remove-Item __pycache__ -Recurse -Force
Remove-Item *.pyc -Recurse -Force

# Permisos (si es necesario)
icacls "C:\xampp\mysql\data" /grant Users:F
```

---

### **UNIDAD 2: INSTALACIÓN DE SISTEMAS OPERATIVOS**

#### **2.1. Arranque del Sistema**
- ✅ **Aplicado:** Configuración de servicios al inicio

**XAMPP Control Panel:**
- MySQL: Arranque automático
- Apache: Manual (solo cuando se necesita)

**Script de arranque (start_eid.ps1):**
```powershell
# Arrancar servicios necesarios
Write-Host "Iniciando servicios eID..." -ForegroundColor Green

# Verificar MySQL
$mysql = Get-Service | Where-Object {$_.DisplayName -like "*MySQL*"}
if ($mysql.Status -ne "Running") {
    Write-Host "Iniciando MySQL..." -ForegroundColor Yellow
    Start-Service $mysql.Name
}

# Activar entorno virtual
Set-Location "C:\Users\freak\Desktop\DAM2527\GIT_DAM_25-27\Primero\Milla Extra 1º ev\eID"
.\venv\Scripts\Activate.ps1

# Variables de entorno
$env:FLASK_APP="app"
$env:FLASK_ENV="development"

# Arrancar Flask
Write-Host "Iniciando servidor Flask en http://127.0.0.1:5000" -ForegroundColor Green
python run.py
```

#### **2.2. Instalación de Software**
- ✅ **Aplicado:** Instalación de stack completo

**Software instalado:**

1. **Python 3.11**
```powershell
# Verificar instalación
python --version
# Python 3.11.5

# Ubicación
where.exe python
# C:\Users\freak\AppData\Local\Programs\Python\Python311\python.exe
```

2. **XAMPP (MySQL + phpMyAdmin)**
```powershell
# Ubicación de XAMPP
C:\xampp\

# MySQL
C:\xampp\mysql\bin\mysql.exe --version
# mysql  Ver 8.2.0 for Win64

# Iniciar servicios
C:\xampp\xampp-control.exe
```

3. **Git**
```powershell
git --version
# git version 2.42.0.windows.1
```

4. **Visual Studio Code**
```powershell
code --version
# 1.95.0
```

---

### **UNIDAD 3: GESTIÓN DE LA INFORMACIÓN**

#### **3.1. Sistemas de Archivos**
- ✅ **Aplicado:** NTFS en Windows

**Características utilizadas:**
- **Permisos:** Protección de archivos `.env` (contraseñas)
- **Rutas absolutas:** Acceso a archivos del sistema
- **Extensiones:** `.py`, `.sql`, `.html`, `.css`, `.json`

```powershell
# Ver sistema de archivos
Get-Volume C

# Propiedades de archivo
Get-ItemProperty run.py

# Permisos de .env
Get-Acl .env | Format-List
```

#### **3.2. Base de Datos MySQL**
- ✅ **Aplicado:** Almacenamiento persistente

**Ubicación de datos:**
```
C:\xampp\mysql\data\eid\
├── users.ibd              # Tabla de usuarios
├── contacts.ibd           # Tabla de contactos
├── calendar_events.ibd    # Tabla de eventos
├── event_participants.ibd # Tabla de participantes
├── contact_folders.ibd    # Tabla de carpetas
├── messages.ibd           # Tabla de mensajes
├── chats.ibd             # Tabla de chats
└── chat_messages.ibd     # Tabla de mensajes de chat
```

**Tamaño de base de datos:**
```powershell
Get-ChildItem "C:\xampp\mysql\data\eid" -Filter "*.ibd" | 
    Measure-Object -Property Length -Sum | 
    Select-Object Count, @{Name="SizeMB";Expression={[math]::Round($_.Sum/1MB,2)}}

# Resultado: ~15 MB (con datos de ejemplo)
```

#### **3.3. Copias de Seguridad**
- ✅ **Aplicado:** Backups de base de datos

**Script de backup (backup_db.ps1):**
```powershell
$timestamp = Get-Date -Format "yyyy-MM-dd_HHmmss"
$backupFile = "backups\eid_backup_$timestamp.sql"

# Crear directorio si no existe
if (!(Test-Path "backups")) {
    New-Item -ItemType Directory -Path "backups"
}

# Exportar base de datos
C:\xampp\mysql\bin\mysqldump.exe `
    -u root `
    --databases eid `
    --result-file=$backupFile

Write-Host "Backup creado: $backupFile" -ForegroundColor Green
```

**Restauración:**
```powershell
# Restaurar desde backup
C:\xampp\mysql\bin\mysql.exe -u root < backups\eid_backup_2025-11-09_143022.sql
```

---

### **UNIDAD 4: CONEXIÓN DE SISTEMAS EN RED**

#### **4.1. Modelo TCP/IP**
- ✅ **Aplicado:** Comunicación cliente-servidor

**Capas utilizadas:**

| Capa | Protocolo | Uso en eID |
|------|-----------|------------|
| Aplicación | HTTP/HTTPS | Peticiones web |
| Transporte | TCP | Conexiones fiables |
| Red | IP | Direccionamiento (127.0.0.1) |
| Enlace | Ethernet/WiFi | Acceso físico |

**Verificación de conexiones:**
```powershell
# Ver conexiones TCP activas
Get-NetTCPConnection | 
    Where-Object {$_.LocalPort -in @(3306, 5000)} | 
    Format-Table LocalAddress, LocalPort, RemoteAddress, RemotePort, State

# Resultado:
# LocalAddress LocalPort RemoteAddress RemotePort State
# 127.0.0.1   5000      127.0.0.1     52341      Established
# 127.0.0.1   3306      127.0.0.1     52342      Established
```

#### **4.2. Direccionamiento IP**
- ✅ **Aplicado:** Localhost y networking

**Configuración de red:**
```powershell
# Ver configuración IP
ipconfig /all

# Interfaz de red
Get-NetIPAddress | Where-Object {$_.AddressFamily -eq "IPv4"}

# Loopback (localhost)
# IPv4: 127.0.0.1
# IPv6: ::1

# Ping a servidor local
ping 127.0.0.1
Test-NetConnection -ComputerName 127.0.0.1 -Port 5000
```

**app/__init__.py - Configuración de servidor:**
```python
if __name__ == '__main__':
    app.run(
        host='127.0.0.1',  # Solo accesible localmente
        port=5000,          # Puerto TCP
        debug=True          # Modo desarrollo
    )

# Para acceso desde red local:
# host='0.0.0.0'  # Escuchar en todas las interfaces
```

#### **4.3. Puertos y Servicios**
- ✅ **Aplicado:** Gestión de puertos TCP

**Puertos utilizados:**

| Puerto | Servicio | Descripción |
|--------|----------|-------------|
| 5000 | Flask | Servidor web Python |
| 3306 | MySQL | Base de datos |
| 80 | Apache | Servidor web (opcional) |
| 443 | HTTPS | Conexiones seguras (producción) |

**Verificación de puertos:**
```powershell
# Comprobar puerto en uso
Test-NetConnection -ComputerName 127.0.0.1 -Port 5000

# Ver proceso que usa puerto
Get-NetTCPConnection -LocalPort 5000 | 
    Select-Object -Property LocalPort, OwningProcess, @{
        Name="ProcessName"
        Expression={(Get-Process -Id $_.OwningProcess).ProcessName}
    }

# Abrir puerto en firewall (si es necesario)
New-NetFirewallRule -DisplayName "Flask eID" `
    -Direction Inbound `
    -Protocol TCP `
    -LocalPort 5000 `
    -Action Allow
```

#### **4.4. DNS y Resolución de Nombres**
- ✅ **Aplicado:** Localhost y hosts file

**Configuración de hosts (opcional):**
```powershell
# Ubicación: C:\Windows\System32\drivers\etc\hosts

# Añadir entrada personalizada
Add-Content C:\Windows\System32\drivers\etc\hosts "127.0.0.1  eid.local"

# Ahora se puede acceder con:
# http://eid.local:5000
```

---

### **UNIDAD 5: GESTIÓN DE RECURSOS EN UNA RED**

#### **5.1. Servidor Web**
- ✅ **Aplicado:** Flask development server

**Configuración del servidor:**
```python
# run.py
from app import create_app

app = create_app()

if __name__ == '__main__':
    # Servidor de desarrollo
    app.run(
        host='127.0.0.1',
        port=5000,
        debug=True,
        threaded=True  # Múltiples conexiones simultáneas
    )
```

**Logs del servidor:**
```
 * Serving Flask app 'app'
 * Debug mode: on
WARNING: This is a development server. Do not use it in production.
 * Running on http://127.0.0.1:5000
 * Restarting with stat
 * Debugger is active!
127.0.0.1 - - [09/Nov/2025 14:30:22] "GET /calendar/ HTTP/1.1" 200 -
127.0.0.1 - - [09/Nov/2025 14:30:23] "GET /calendar/events/json HTTP/1.1" 200 -
```

#### **5.2. Servidor de Base de Datos**
- ✅ **Aplicado:** MySQL Server

**Configuración MySQL (my.ini):**
```ini
[mysqld]
port=3306
bind-address=127.0.0.1
max_connections=151
character-set-server=utf8mb4
collation-server=utf8mb4_unicode_ci
```

**Conexión desde Python:**
```python
# app/database.py
import mysql.connector

config = {
    'host': '127.0.0.1',
    'port': 3306,
    'user': 'root',
    'password': '',
    'database': 'eid',
    'charset': 'utf8mb4'
}

connection = mysql.connector.connect(**config)
```

**Verificar servicio:**
```powershell
# Estado del servicio
Get-Service MySQL

# Conectar con cliente
C:\xampp\mysql\bin\mysql.exe -u root -p

# Dentro de MySQL
mysql> SHOW DATABASES;
mysql> USE eid;
mysql> SHOW TABLES;
mysql> SELECT COUNT(*) FROM users;
```

#### **5.3. Monitorización de Recursos**
- ✅ **Aplicado:** Task Manager y comandos PowerShell

```powershell
# CPU y RAM de Python
Get-Process python | Select-Object Name, CPU, @{
    Name="MemoryMB"
    Expression={[math]::Round($_.WorkingSet/1MB,2)}
}

# CPU y RAM de MySQL
Get-Process mysqld | Select-Object Name, CPU, @{
    Name="MemoryMB"
    Expression={[math]::Round($_.WorkingSet/1MB,2)}
}

# Uso de disco
Get-PSDrive C | Select-Object Used, Free

# Tráfico de red (aproximado)
Get-NetAdapterStatistics
```

---

### **UNIDAD 6: SEGURIDAD INFORMÁTICA**

#### **6.1. Seguridad de Contraseñas**
- ✅ **Aplicado:** Hash de contraseñas con Werkzeug

```python
from werkzeug.security import generate_password_hash, check_password_hash

# Almacenar contraseña (nunca en texto plano)
password_hash = generate_password_hash('secreto123')
# 'pbkdf2:sha256:600000$...'

# Verificar contraseña
is_valid = check_password_hash(password_hash, 'secreto123')  # True
is_valid = check_password_hash(password_hash, 'incorrecto')  # False
```

**Tabla users con hash:**
```sql
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,  -- Hash, NO texto plano
    ...
);
```

#### **6.2. Seguridad de Sesiones**
- ✅ **Aplicado:** Flask-Login y SECRET_KEY

```python
# app/__init__.py
app.config['SECRET_KEY'] = os.environ.get('SECRET_KEY', 'dev-key')
app.config['SESSION_COOKIE_SECURE'] = True  # Solo HTTPS (producción)
app.config['SESSION_COOKIE_HTTPONLY'] = True  # No accesible desde JS
app.config['PERMANENT_SESSION_LIFETIME'] = timedelta(days=7)
```

#### **6.3. Protección contra Inyección SQL**
- ✅ **Aplicado:** Consultas preparadas

```python
# ❌ VULNERABLE
query = f"SELECT * FROM users WHERE username = '{username}'"
cursor.execute(query)  # Inyección SQL posible

# ✅ SEGURO
query = "SELECT * FROM users WHERE username = %s"
cursor.execute(query, (username,))  # Parametrizado
```

#### **6.4. Firewall de Windows**
- ✅ **Aplicado:** Reglas de firewall

```powershell
# Ver reglas activas
Get-NetFirewallRule | Where-Object {$_.DisplayName -like "*Python*"}

# Crear regla para Flask
New-NetFirewallRule -DisplayName "Flask eID Dev" `
    -Direction Inbound `
    -Program "C:\Users\freak\AppData\Local\Programs\Python\Python311\python.exe" `
    -Action Allow

# Bloquear puerto externo (solo localhost)
New-NetFirewallRule -DisplayName "Block Flask External" `
    -Direction Inbound `
    -Protocol TCP `
    -LocalPort 5000 `
    -RemoteAddress "!127.0.0.1" `
    -Action Block
```

#### **6.5. Archivos Sensibles**
- ✅ **Aplicado:** .env y .gitignore

**.env (nunca en Git):**
```env
SECRET_KEY=produccion-super-secreta-clave-aleatoria-2025
DB_PASSWORD=password_mysql_seguro
```

**.gitignore:**
```gitignore
.env
*.log
*.sqlite3
__pycache__/
```

---

### **UNIDAD 7: CONFIGURACIÓN DE SISTEMAS OPERATIVOS**

#### **7.1. Variables de Entorno**
- ✅ **Aplicado:** Configuración de Flask

```powershell
# Temporal (sesión actual)
$env:FLASK_APP="app"
$env:FLASK_ENV="development"
$env:SECRET_KEY="dev-key"

# Permanente (usuario)
[System.Environment]::SetEnvironmentVariable("FLASK_APP", "app", "User")

# Verificar
Get-ChildItem Env: | Where-Object {$_.Name -like "FLASK*"}
```

#### **7.2. PATH del Sistema**
- ✅ **Aplicado:** Acceso a Python y MySQL

```powershell
# Ver PATH
$env:PATH -split ';'

# Añadir al PATH (temporal)
$env:PATH += ";C:\xampp\mysql\bin"

# Verificar comandos accesibles
where.exe python
where.exe mysql
```

#### **7.3. Tareas Programadas**
- ✅ **Aplicado:** Backup automático

```powershell
# Crear tarea programada para backup diario
$action = New-ScheduledTaskAction -Execute "PowerShell.exe" `
    -Argument "-File C:\...\backup_db.ps1"

$trigger = New-ScheduledTaskTrigger -Daily -At 2am

Register-ScheduledTask -TaskName "eID Backup" `
    -Action $action `
    -Trigger $trigger `
    -Description "Backup automático de base de datos eID"
```

---

## ARQUITECTURA DEL SISTEMA

```
┌─────────────────────────────────────────┐
│          NAVEGADOR WEB (Cliente)        │
│         http://127.0.0.1:5000          │
└─────────────────┬───────────────────────┘
                  │ HTTP/TCP
                  ▼
┌─────────────────────────────────────────┐
│      Flask Development Server          │
│         Python 3.11 (Puerto 5000)       │
│         Procesa peticiones HTTP         │
└─────────────────┬───────────────────────┘
                  │ SQL/TCP
                  ▼
┌─────────────────────────────────────────┐
│       MySQL Server (XAMPP)              │
│         Puerto 3306                     │
│         Base de datos 'eid'             │
│         8 tablas, índices               │
└─────────────────┬───────────────────────┘
                  │
                  ▼
┌─────────────────────────────────────────┐
│       Sistema de Archivos NTFS          │
│    C:\xampp\mysql\data\eid\*.ibd       │
│    Almacenamiento persistente           │
└─────────────────────────────────────────┘
```

---

## DEMOSTRACIÓN DE FUNCIONALIDAD

### **1. Iniciar todos los servicios**
```powershell
# Ejecutar script de arranque
.\start_eid.ps1

# O manualmente:
# 1. Iniciar MySQL en XAMPP Control Panel
# 2. Activar venv
.\venv\Scripts\Activate.ps1
# 3. Ejecutar Flask
python run.py
```

### **2. Verificar servicios**
```powershell
# MySQL activo
Get-Service | Where-Object {$_.DisplayName -like "*MySQL*"}

# Flask escuchando
Test-NetConnection -ComputerName 127.0.0.1 -Port 5000

# Acceder desde navegador
Start-Process "http://127.0.0.1:5000"
```

### **3. Backup de datos**
```powershell
.\backup_db.ps1
```

---

## RÚBRICA DE EVALUACIÓN

| Criterio | Peso | Cumplimiento | Evidencia |
|----------|------|--------------|-----------|
| **Gestión de Servicios** | 25% | ✅ Completo | MySQL, Flask, scripts de arranque |
| **Redes TCP/IP** | 20% | ✅ Completo | Localhost, puertos, protocolos |
| **Sistemas de Archivos** | 15% | ✅ Completo | NTFS, estructura de directorios |
| **Seguridad** | 15% | ✅ Completo | Hash passwords, firewall, .gitignore |
| **Copias de Seguridad** | 10% | ✅ Completo | Script de backup, mysqldump |
| **Monitorización** | 10% | ✅ Completo | Task Manager, PowerShell |
| **Configuración** | 5% | ✅ Completo | Variables entorno, PATH |

---

## CONCLUSIONES

El proyecto eID demuestra dominio de Sistemas Informáticos:

✅ **Servicios** gestionados (MySQL + Flask)  
✅ **Redes** configuradas (TCP/IP, puertos, localhost)  
✅ **Seguridad** aplicada (hash, firewall, .env)  
✅ **Backups** automatizados  
✅ **Monitorización** de recursos  

**Complejidad:** Alta  
**Servicios:** 2 (MySQL, Flask)  
**Protocolos:** HTTP, TCP, SQL  

---

**Firma del alumno:** ___________________  
**Fecha:** ___/___/2025
