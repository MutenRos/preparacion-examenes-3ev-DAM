# 📚 CHEATSHEET - DAM PRIMERO
*Chuleta rápida con conceptos esenciales y ejemplos prácticos*

---

## 🖥️ SISTEMAS INFORMÁTICOS

### 001 - Explotación de sistemas microinformáticos

**¿Qué es?** Entender el hardware de un ordenador para elegir componentes, diagnosticar problemas y mantener equipos funcionando correctamente.

**Conceptos clave:**

**CPU (Procesador) - El cerebro:**
- Ejecuta instrucciones (cálculos, comparaciones, operaciones)
- **Núcleos**: Más núcleos = más tareas simultáneas. Un núcleo para cada programa intensivo
- **Frecuencia (GHz)**: Velocidad de cada núcleo. 3.5 GHz = 3.500 millones de operaciones por segundo
- Ejemplos: Intel i5 (4-6 núcleos), AMD Ryzen (8-16 núcleos), ARM Cortex (Raspberry Pi, bajo consumo)

**RAM (Memoria) - El escritorio:**
- Almacena datos que está usando ahora mismo (programas abiertos, pestañas del navegador)
- Es temporal: se borra al apagar (por eso "guarda tu trabajo")
- Más RAM = más cosas abiertas sin que vaya lento
- 8GB mínimo hoy día, 16GB para desarrollo, 32GB para edición de vídeo/3D

**Almacenamiento - El archivo:**
- **HDD (disco duro)**: Mecánico, lento (100 MB/s), barato, mucha capacidad (2TB por 50€)
- **SSD (disco sólido)**: Electrónico, rápido (500 MB/s), más caro, menos capacidad pero suficiente (500GB por 50€)
- Regla de oro: SSD para el sistema operativo y programas, HDD para archivos grandes (películas, backups)

**Buses - Las autopistas de datos:**
- Conectan componentes para que se comuniquen
- **PCIe**: Para tarjeta gráfica, M.2 SSD (muy rápido)
- **USB**: Periféricos externos (teclado, ratón, disco externo)
- **SATA**: Discos duros internos (más lento que PCIe)

**Raspberry Pi - Mini ordenador completo:**
- Tamaño de una tarjeta de crédito, consume 5W
- **GPIO (pines)**: Puedes conectar LEDs, sensores, motores, relés
- Ideal para: servidor web, NAS casero, controlador de impresora 3D, domótica

**En la práctica:**
- **PC para impresión 3D**: CPU 4 núcleos (para hacer laminado rápido), 8GB RAM, SSD 250GB (Windows + programas), HDD 1TB (modelos STL)
- **Raspberry Pi 4 como OctoPrint**: Conectar impresora 3D vía USB, controlar desde móvil/PC, cámara para time-lapse, sensor de temperatura ambiente

### 002 - Instalación de sistemas operativos

**¿Qué es?** Instalar y configurar Linux, el sistema operativo más usado en servidores, Raspberry Pi y desarrollo. Es gratis, estable y potente.

**¿Por qué Linux?**
- **Servidores**: 96% de los servidores web usan Linux
- **Raspberry Pi**: El sistema oficial es Linux (Raspberry Pi OS = Debian)
- **Desarrollo**: Herramientas de programación funcionan mejor en Linux
- **Gratis**: No pagas licencias como Windows

**Comandos esenciales:**

```bash
# ACTUALIZAR SISTEMA (hazlo SIEMPRE antes de instalar algo)
sudo apt update              # Descargar lista actualizada de programas disponibles
sudo apt upgrade             # Actualizar programas instalados a última versión
sudo apt upgrade -y          # El -y dice "sí" a todo automáticamente

# INSTALAR PROGRAMAS
sudo apt install apache2     # Instalar servidor web Apache
sudo apt install python3     # Instalar Python 3
sudo apt install git         # Instalar Git

# GESTIONAR SERVICIOS (programas que se ejecutan en segundo plano)
sudo systemctl start apache2    # Iniciar servicio ahora
sudo systemctl stop apache2     # Parar servicio
sudo systemctl restart apache2  # Reiniciar (si cambias configuración)
sudo systemctl enable apache2   # Que arranque automáticamente al encender el ordenador
sudo systemctl disable apache2  # Que NO arranque automáticamente
sudo systemctl status apache2   # Ver si está funcionando (running = bien, failed = error)

# ¿Qué es sudo?
# = "Super User DO" = ejecutar como administrador
# Sin sudo muchos comandos dan error de permisos
```

**Servicios importantes:**

**Apache2 - Servidor web:**
- Aloja páginas web (HTML, CSS, JavaScript)
- Accedes desde navegador: `http://192.168.1.100`
- Archivos en: `/var/www/html/`
- Uso: Mostrar panel de control de impresora 3D, dashboard de sensores IoT

**SSH - Terminal remoto:**
- Controlar Linux desde otro ordenador (sin monitor ni teclado)
- Seguro (todo cifrado)
- Esencial para Raspberry Pi (no quieres tener monitor conectado todo el tiempo)
- Activar en Raspberry Pi: `sudo systemctl enable ssh`
- Conectar desde Windows: `ssh pi@192.168.1.100` (usuario: pi, IP: 192.168.1.100)

**SAMBA - Compartir archivos Windows ↔ Linux:**
- Crear carpeta en Raspberry Pi que se vea en "Red" de Windows
- Copiar archivos STL desde Windows al Raspberry Pi arrastrando
- Útil para: compartir modelos 3D, backups automáticos, carpeta de proyectos

**En la práctica:**

**Caso 1: Raspberry Pi como servidor web**
```bash
# 1. Instalar Raspberry Pi OS (desde Raspberry Pi Imager en Windows)
# 2. Primera configuración
sudo apt update && sudo apt upgrade -y  # Actualizar todo
sudo raspi-config                       # Configurar: activar SSH, cambiar password

# 3. Instalar Apache
sudo apt install apache2 -y
sudo systemctl enable apache2           # Arranque automático

# 4. Crear página web
sudo nano /var/www/html/index.html      # Editar página principal

# 5. Acceder desde tu PC
# En navegador: http://192.168.1.100 (IP de tu Raspberry Pi)
```

**Caso 2: Control remoto de Raspberry Pi (SSH)**
```bash
# En Raspberry Pi (una sola vez):
sudo systemctl enable ssh
sudo systemctl start ssh

# Desde tu PC Windows (PowerShell):
ssh pi@192.168.1.100
# Te pide contraseña (default: raspberry)
# ¡Ya estás dentro! Todo lo que escribas se ejecuta en el Raspberry Pi
```

**Caso 3: Servidor web mostrando temperatura de impresora 3D**
```python
# Script Python que corre en Raspberry Pi
# Lee temperatura de sensor y actualiza archivo HTML
import time

while True:
    temperatura = leer_sensor()  # Tu función de lectura
    with open('/var/www/html/temp.html', 'w') as f:
        f.write(f'<h1>Temperatura: {temperatura}°C</h1>')
    time.sleep(5)  # Actualizar cada 5 segundos
    
# Accedes desde móvil: http://192.168.1.100/temp.html
```

### 003 - Gestión de la información

**¿Qué es?** Organizar archivos, controlar quién puede verlos/modificarlos y hacer copias de seguridad para no perder datos.

**Permisos en Linux - Sistema de seguridad:**

En Linux cada archivo tiene permisos para 3 tipos de usuarios:
1. **Dueño (owner)**: Quien creó el archivo
2. **Grupo (group)**: Usuarios del mismo equipo
3. **Otros (others)**: Todo el mundo

Cada uno puede tener 3 permisos:
- **r (read = 4)**: Leer el archivo
- **w (write = 2)**: Modificar el archivo
- **x (execute = 1)**: Ejecutar si es programa/script

**Ver permisos:**
```bash
ls -l archivo.txt
# Salida: -rw-r--r-- 1 pi pi 1024 Oct 25 10:30 archivo.txt
#         ↑↑↑↑↑↑↑↑↑↑
#         |||└─────────────── Otros: r-- (solo leer)
#         ||└──────────────── Grupo: r-- (solo leer)
#         |└───────────────── Dueño: rw- (leer y escribir)
#         └────────────────── - = archivo regular, d = directorio
```

**Cambiar permisos:**
```bash
# Método numérico (más rápido)
chmod 755 script.sh     # rwxr-xr-x
# 7 = 4+2+1 = rwx (dueño: todo)
# 5 = 4+1   = r-x (grupo: leer y ejecutar)
# 5 = 4+1   = r-x (otros: leer y ejecutar)

chmod 644 documento.txt # rw-r--r--
# 6 = 4+2   = rw- (dueño: leer y escribir)
# 4 = 4     = r-- (grupo: solo leer)
# 4 = 4     = r-- (otros: solo leer)

chmod 600 password.txt  # rw-------
# 6 = 4+2   = rw- (dueño: leer y escribir)
# 0 = 0     = --- (grupo: nada)
# 0 = 0     = --- (otros: nada)
# ¡Nadie más puede ver tus contraseñas!

# Método simbólico (más legible)
chmod u+x script.sh     # Dar permiso de ejecución al usuario (u=user, +x=add execute)
chmod g-w archivo.txt   # Quitar permiso de escritura al grupo (g=group, -w=remove write)
chmod o-r secreto.txt   # Quitar permiso de lectura a otros (o=others, -r=remove read)
chmod a+r publico.txt   # Dar permiso de lectura a todos (a=all)

# Cambiar dueño (necesitas sudo)
chown pi:pi archivo.txt      # Usuario pi, grupo pi
chown www-data:www-data index.html  # Para Apache (servidor web)
```

**¿Qué permisos usar?**
```bash
# Scripts que ejecutas
chmod 755 script.sh
# Puedes ejecutarlo tú, otros solo verlo

# Archivos de configuración
chmod 644 config.txt
# Tú editas, otros solo leen

# Contraseñas o datos sensibles
chmod 600 passwords.txt
# Solo tú puedes ver

# Directorio compartido
chmod 775 /compartido
# Tú y tu grupo podéis crear archivos dentro
```

**Backups (copias de seguridad):**

**Método 1: tar (comprimir y empaquetar)**
```bash
# Crear backup comprimido
tar -czvf backup_modelos.tar.gz /home/pi/modelos_3d
# c = crear archivo
# z = comprimir con gzip
# v = verbose (mostrar progreso)
# f = file (nombre del archivo)

# Descomprimir
tar -xzvf backup_modelos.tar.gz
# x = extraer

# Ver contenido sin extraer
tar -tzvf backup_modelos.tar.gz

# Backup con fecha en el nombre
tar -czvf backup_$(date +%Y%m%d).tar.gz /home/pi/datos
# Resultado: backup_20251025.tar.gz
```

**Método 2: rsync (sincronización inteligente)**
```bash
# Copiar solo lo que cambió (¡mucho más rápido!)
rsync -av /origen/ /destino/
# a = archive (preserva permisos, fechas, enlaces)
# v = verbose (mostrar qué copia)

# Backup a disco externo
rsync -av --delete /home/pi/proyectos/ /media/usb/backup/
# --delete = borrar en destino lo que no existe en origen

# Backup a otro Raspberry Pi en red
rsync -av /home/pi/modelos/ pi@192.168.1.200:/backup/

# Excluir archivos grandes
rsync -av --exclude='*.iso' --exclude='*.zip' /origen/ /destino/

# Simular (ver qué haría sin hacerlo)
rsync -avn /origen/ /destino/
# n = dry-run (prueba)
```

**Método 3: Backup automático con cron**
```bash
# Editar tareas programadas
crontab -e

# Añadir línea: backup diario a las 2 AM
0 2 * * * tar -czf /backup/diario_$(date +\%Y\%m\%d).tar.gz /home/pi/importantes

# Backup cada hora
0 * * * * rsync -a /home/pi/modelos/ /backup/modelos/

# Formato cron: minuto hora día mes día_semana comando
# 0 2 * * * = minuto 0, hora 2, todos los días
# */15 * * * * = cada 15 minutos
```

**En la práctica:**

**Caso 1: Organizar modelos 3D**
```bash
# Crear estructura
mkdir -p ~/modelos_3d/{funcionales,decorativos,respuestos}
chmod 755 ~/modelos_3d/*

# Backup semanal automático
crontab -e
0 3 * * 0 tar -czf ~/backups/modelos_$(date +\%Y\%m\%d).tar.gz ~/modelos_3d
# Cada domingo a las 3 AM
```

**Caso 2: Script que lee sensor de temperatura**
```bash
# Crear script
nano ~/temperatura.py
chmod 755 ~/temperatura.py  # Permiso de ejecución

# Ejecutar cada 5 minutos y guardar log
crontab -e
*/5 * * * * /usr/bin/python3 ~/temperatura.py >> ~/temperatura.log
```

**Caso 3: Backup incremental (solo cambios)**
```bash
# Primer backup completo
rsync -av /home/pi/proyectos/ /backup/proyectos/

# Siguientes backups: solo copia archivos nuevos o modificados
# ¡Ahorra tiempo y espacio!
rsync -av --delete /home/pi/proyectos/ /backup/proyectos/
```

### 004 - Configuración de sistemas operativos

**¿Qué es?** Configurar red, firewall y monitorizar rendimiento.

**Configuración de red:**
```bash
# Ver tu IP
ip addr show
ifconfig  # Método antiguo

# IP estática (Raspberry Pi)
# Editar: /etc/dhcpcd.conf
interface eth0
static ip_address=192.168.1.100/24
static routers=192.168.1.1
static domain_name_servers=8.8.8.8

# Firewall básico
sudo ufw allow 22      # Permitir SSH
sudo ufw allow 80      # Permitir HTTP
sudo ufw enable        # Activar firewall
```

**Monitorización:**
```bash
top     # Ver procesos en tiempo real (CPU, RAM)
htop    # Versión mejorada con colores
df -h   # Espacio en disco
free -h # Memoria RAM disponible
```

**En la práctica:**
- IP estática para tu Raspberry Pi para siempre conectarte a la misma dirección
- Cron job para ejecutar script Python cada hora: `0 * * * * python3 /home/pi/sensor.py`

### 005 - Conexión de sistemas en red

**¿Qué es?** Conectar dispositivos y acceder remotamente.

**SSH (Secure Shell):**
```bash
# Conectar a Raspberry Pi
ssh pi@192.168.1.100

# Copiar archivo a Raspberry Pi
scp archivo.py pi@192.168.1.100:/home/pi/

# Copiar desde Raspberry Pi a tu PC
scp pi@192.168.1.100:/home/pi/datos.csv .

# Túnel SSH (acceder a servicio remoto como si fuera local)
ssh -L 8080:localhost:80 pi@192.168.1.100
# Ahora localhost:8080 en tu PC = puerto 80 en Raspberry Pi
```

**Protocolos básicos:**
- **TCP**: Garantiza entrega (HTTP, SSH, FTP)
- **UDP**: Rápido pero puede perder paquetes (streaming, videojuegos)
- **HTTP**: Puerto 80, web
- **HTTPS**: Puerto 443, web segura
- **SSH**: Puerto 22, terminal remoto

**En la práctica:**
- Acceder a OctoPrint en Raspberry Pi desde tu móvil vía SSH tunnel
- Transferir archivos STL con `scp` para imprimir

### 006 - Gestión de recursos en una red

**¿Qué es?** Compartir carpetas e impresoras entre dispositivos.

**SAMBA (compartir carpetas Windows ↔ Linux):**
```bash
sudo apt install samba
sudo nano /etc/samba/smb.conf

# Añadir al final:
[Modelos3D]
path = /home/pi/modelos
browseable = yes
writable = yes
guest ok = no

sudo systemctl restart smbd
```

**En la práctica:**
- Carpeta compartida en Raspberry Pi donde guardas STL desde tu PC Windows
- Accedes como `\\192.168.1.100\Modelos3D`

### 007 - Explotación de aplicaciones informáticas

**¿Qué es?** Usar software de productividad y herramientas de desarrollo.

**Herramientas esenciales:**
- **VS Code**: Editor de código con extensiones Python, Git
- **Git**: Control de versiones (guardar historial de cambios)
- **MySQL Workbench**: Diseñar bases de datos visualmente
- **Wireshark**: Analizar tráfico de red (debugging)
- **Postman**: Probar APIs REST

**En la práctica:**
- VS Code con extensión Remote-SSH para editar código directamente en Raspberry Pi
- Git para versionar tu proyecto de control de impresora 3D

---

## 💾 BASES DE DATOS

### 001 - Almacenamiento de la información

**¿Qué es?** Organizar datos de forma estructurada para consultar eficientemente.

**Conceptos clave:**
- **Tabla**: Como una hoja Excel con filas (registros) y columnas (campos)
- **Registro**: Una fila (un cliente, un producto)
- **Campo**: Una columna (nombre, precio, fecha)
- **Clave primaria (PK)**: Identificador único de cada fila (ID)
- **Clave foránea (FK)**: Referencia a otra tabla (cliente_id en tabla pedidos)

**Modelo Entidad-Relación:**
```
CLIENTE ─── hace ─── PEDIDO ─── contiene ─── PRODUCTO
   │                    │                       │
   ├─ id_cliente       ├─ id_pedido           ├─ id_producto
   ├─ nombre           ├─ fecha               ├─ nombre
   ├─ email            ├─ cliente_id (FK)     ├─ precio
   └─ telefono         └─ total               └─ stock
```

**Normalización (evitar redundancia):**
- **1NF**: Cada celda un solo valor (no listas)
- **2NF**: Todos los campos dependen de la PK completa
- **3NF**: No hay dependencias transitivas (A→B→C, eliminar A→C directa)

**En la práctica:**
- Base de datos de piezas 3D: tabla `modelos` (id, nombre, archivo_stl, fecha_creacion)
- Relacionar con tabla `impresiones` (id, modelo_id, fecha, material, tiempo_minutos)

### 002 - Bases de datos relacionales

**¿Qué es?** SQL es el lenguaje para hablar con bases de datos relacionales.

**Crear tabla:**
```sql
CREATE TABLE modelos_3d (
    id INT PRIMARY KEY AUTO_INCREMENT,  -- Se incrementa solo
    nombre VARCHAR(100) NOT NULL,       -- Obligatorio
    material VARCHAR(50) DEFAULT 'PLA', -- Valor por defecto
    precio DECIMAL(10,2) CHECK (precio >= 0), -- Solo positivos
    stock INT DEFAULT 0,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE impresiones (
    id INT PRIMARY KEY AUTO_INCREMENT,
    modelo_id INT,
    fecha_impresion DATE,
    tiempo_minutos INT,
    FOREIGN KEY (modelo_id) REFERENCES modelos_3d(id)
        ON DELETE CASCADE  -- Si borras modelo, borras sus impresiones
);
```

**Tipos de datos:**
- **INT**: Números enteros (-2147483648 a 2147483647)
- **VARCHAR(n)**: Texto variable hasta n caracteres
- **TEXT**: Texto largo (descripciones)
- **DECIMAL(10,2)**: Números con decimales (10 dígitos, 2 decimales)
- **DATE**: Fecha (2025-01-15)
- **DATETIME**: Fecha y hora (2025-01-15 14:30:00)
- **BOOLEAN**: TRUE/FALSE (se guarda como 0 o 1)

**Usuarios y permisos:**
```sql
CREATE USER 'app_user'@'localhost' IDENTIFIED BY 'password123';
GRANT SELECT, INSERT, UPDATE ON taller_3d.* TO 'app_user'@'localhost';
GRANT ALL PRIVILEGES ON taller_3d.* TO 'admin'@'localhost';
FLUSH PRIVILEGES;  -- Aplicar cambios
```

**En la práctica:**
- Usuario `octoprint` solo con permisos SELECT/INSERT en tabla `impresiones`
- Usuario `admin` con todos los permisos para mantenimiento

### 003 - Realización de consultas

**¿Qué es?** SELECT es el comando más usado: extraer datos filtrados y ordenados.

**SELECT básico:**
```sql
-- Todas las columnas
SELECT * FROM modelos_3d;

-- Columnas específicas
SELECT nombre, precio FROM modelos_3d;

-- Filtrar
SELECT * FROM modelos_3d 
WHERE material = 'PLA' AND precio < 20;

-- Ordenar
SELECT * FROM modelos_3d 
ORDER BY precio DESC;  -- Mayor a menor

-- Limitar resultados
SELECT * FROM modelos_3d 
LIMIT 10;  -- Solo 10 primeros
```

**Operadores útiles:**
```sql
-- Comparación
WHERE precio >= 10 AND precio <= 50
WHERE precio BETWEEN 10 AND 50  -- Equivalente

-- Texto
WHERE nombre LIKE 'Soporte%'   -- Empieza con "Soporte"
WHERE nombre LIKE '%Arduino%'  -- Contiene "Arduino"

-- Listas
WHERE material IN ('PLA', 'PETG', 'ABS')

-- Nulos
WHERE descripcion IS NULL
WHERE descripcion IS NOT NULL
```

**Funciones de agregación:**
```sql
-- Contar
SELECT COUNT(*) FROM modelos_3d WHERE stock > 0;

-- Promedios y sumas
SELECT AVG(precio) FROM modelos_3d;
SELECT SUM(tiempo_minutos) FROM impresiones;
SELECT MAX(precio), MIN(precio) FROM modelos_3d;

-- Agrupar
SELECT material, COUNT(*) as cantidad, AVG(precio) as precio_medio
FROM modelos_3d
GROUP BY material
HAVING COUNT(*) > 5;  -- HAVING filtra grupos, WHERE filtra filas
```

**JOINS (unir tablas):**
```sql
-- INNER JOIN: Solo registros que coinciden en ambas tablas
SELECT m.nombre, i.fecha_impresion, i.tiempo_minutos
FROM modelos_3d m
INNER JOIN impresiones i ON m.id = i.modelo_id;

-- LEFT JOIN: Todos los modelos, aunque no tengan impresiones
SELECT m.nombre, COUNT(i.id) as veces_impreso
FROM modelos_3d m
LEFT JOIN impresiones i ON m.id = i.modelo_id
GROUP BY m.id, m.nombre;

-- Resultado: Modelos con 0 impresiones también aparecen
```

**En la práctica:**
- Buscar piezas PLA con stock bajo: `WHERE material='PLA' AND stock < 5`
- Listar los 10 modelos más impresos con JOIN + GROUP BY + ORDER BY

### 004 - Tratamiento de datos

**¿Qué es?** Insertar, actualizar y borrar datos (CRUD: Create, Read, Update, Delete).

**INSERT (crear):**
```sql
-- Insertar uno
INSERT INTO modelos_3d (nombre, material, precio, stock)
VALUES ('Soporte RPi4', 'PETG', 3.50, 10);

-- Insertar varios
INSERT INTO modelos_3d (nombre, material, precio) VALUES
    ('Caja Arduino', 'PLA', 2.00),
    ('Soporte cámara', 'ABS', 5.50),
    ('Tapa cable', 'PLA', 0.80);
```

**UPDATE (modificar):**
```sql
-- Actualizar un registro
UPDATE modelos_3d 
SET stock = stock - 1 
WHERE id = 5;

-- Actualizar varios
UPDATE modelos_3d 
SET precio = precio * 1.10  -- Subir 10%
WHERE material = 'PETG';

-- ¡CUIDADO! Sin WHERE actualizas TODOS los registros
UPDATE modelos_3d SET precio = 0;  -- ¡Todos a 0!
```

**DELETE (borrar):**
```sql
-- Borrar registro específico
DELETE FROM modelos_3d WHERE id = 10;

-- Borrar con condición
DELETE FROM modelos_3d WHERE stock = 0 AND fecha_creacion < '2024-01-01';

-- ¡CUIDADO! Sin WHERE borras TODA la tabla
DELETE FROM modelos_3d;  -- ¡Tabla vacía!

-- Borrar TODO rápido (resetea AUTO_INCREMENT)
TRUNCATE TABLE modelos_3d;
```

**Transacciones (todo o nada):**
```sql
START TRANSACTION;

UPDATE modelos_3d SET stock = stock - 1 WHERE id = 5;
INSERT INTO impresiones (modelo_id, fecha_impresion) VALUES (5, NOW());

-- Si todo bien:
COMMIT;

-- Si algo falla:
ROLLBACK;  -- Deshace todos los cambios desde START TRANSACTION
```

**En la práctica:**
- Al imprimir: restar stock del material + insertar registro en impresiones, dentro de transacción
- Si falla la impresión, ROLLBACK para no perder material del inventario

### 005 - Programación de bases de datos

**¿Qué es?** Crear funciones, procedimientos y triggers (código que se ejecuta automáticamente).

**Procedimiento almacenado:**
```sql
DELIMITER //
CREATE PROCEDURE registrar_impresion(
    IN p_modelo_id INT,
    IN p_tiempo INT
)
BEGIN
    -- Insertar impresión
    INSERT INTO impresiones (modelo_id, fecha_impresion, tiempo_minutos)
    VALUES (p_modelo_id, NOW(), p_tiempo);
    
    -- Actualizar contador de usos
    UPDATE modelos_3d 
    SET veces_usado = veces_usado + 1 
    WHERE id = p_modelo_id;
END //
DELIMITER ;

-- Usar
CALL registrar_impresion(5, 120);  -- Modelo 5, 120 minutos
```

**Función (retorna valor):**
```sql
DELIMITER //
CREATE FUNCTION calcular_coste(p_tiempo INT, p_material VARCHAR(50))
RETURNS DECIMAL(10,2)
BEGIN
    DECLARE coste_hora DECIMAL(10,2);
    
    IF p_material = 'PLA' THEN
        SET coste_hora = 0.50;
    ELSEIF p_material = 'PETG' THEN
        SET coste_hora = 0.80;
    ELSE
        SET coste_hora = 1.00;
    END IF;
    
    RETURN (p_tiempo / 60.0) * coste_hora;
END //
DELIMITER ;

-- Usar
SELECT nombre, calcular_coste(tiempo_minutos, material) as coste
FROM impresiones i
JOIN modelos_3d m ON i.modelo_id = m.id;
```

**Trigger (acción automática):**
```sql
DELIMITER //
CREATE TRIGGER antes_borrar_modelo
BEFORE DELETE ON modelos_3d
FOR EACH ROW
BEGIN
    -- Guardar en tabla histórico antes de borrar
    INSERT INTO modelos_eliminados (nombre, material, fecha_eliminacion)
    VALUES (OLD.nombre, OLD.material, NOW());
END //
DELIMITER ;

-- Ahora cada vez que borras un modelo, se guarda copia en modelos_eliminados
```

**En la práctica:**
- Procedimiento para "realizar_pedido" que valida stock, crea pedido y actualiza inventario
- Trigger que envía notificación cuando stock < 5

### 006 - Diagramas Entidad-Relación

**¿Qué es?** Diseño visual de la base de datos antes de crearla.

**Notación:**
```
┌──────────────┐
│  CLIENTE     │  ← Entidad (tabla)
├──────────────┤
│ PK id        │  ← PK = Primary Key (clave primaria)
│    nombre    │  ← Atributos (columnas)
│    email     │
│    telefono  │
└──────────────┘
       │
       │ 1:N (un cliente, muchos pedidos)
       ▼
┌──────────────┐
│  PEDIDO      │
├──────────────┤
│ PK id        │
│ FK cliente_id│  ← FK = Foreign Key (clave foránea)
│    fecha     │
│    total     │
└──────────────┘
```

**Cardinalidades:**
- **1:1** → Un modelo tiene una ficha técnica única
- **1:N** → Un cliente hace muchos pedidos
- **N:M** → Muchos pedidos contienen muchos productos (necesita tabla intermedia)

```
PEDIDO ←──────→ PEDIDO_PRODUCTO ←──────→ PRODUCTO
 (N)                                         (M)
               ┌──────────────────┐
               │ PEDIDO_PRODUCTO  │  ← Tabla intermedia
               ├──────────────────┤
               │ FK pedido_id     │
               │ FK producto_id   │
               │    cantidad      │
               │    precio_unidad │
               └──────────────────┘
```

**En la práctica:**
- Diseñar ER antes de programar: evitas tablas mal diseñadas
- Ejemplo: Sistema de cola de impresión 3D con usuarios, modelos, materiales, impresiones

### 007 - Bases de datos NoSQL

**¿Qué es?** Bases de datos sin tablas fijas, más flexibles para ciertos casos.

**MongoDB (documentos JSON):**
```javascript
// Insertar
db.modelos.insertOne({
    nombre: "Soporte RPi4",
    material: "PETG",
    dimensiones: {ancho: 85, largo: 56, alto: 20},
    tags: ["raspberry", "soporte", "funcional"],
    stock: 10,
    impresiones: []
});

// Buscar
db.modelos.find({material: "PLA", stock: {$gt: 0}});

// Actualizar (añadir impresión al array)
db.modelos.updateOne(
    {nombre: "Soporte RPi4"},
    {$push: {impresiones: {fecha: new Date(), tiempo: 120}}}
);

// Ventaja: estructura flexible, puedes añadir campos sin ALTER TABLE
```

**Redis (clave-valor, muy rápido):**
```bash
# Guardar
SET contador_impresiones 150
SET modelo:5:nombre "Soporte RPi4"

# Leer
GET contador_impresiones  # Devuelve "150"

# Incrementar (atómico, útil para contadores)
INCR contador_impresiones  # Ahora es 151

# Listas (cola de impresión)
LPUSH cola_impresion "modelo:5"
LPUSH cola_impresion "modelo:12"
RPOP cola_impresion  # Saca "modelo:5" (primero en entrar)
```

---

## 💻 PROGRAMACIÓN (Python)

### 001 - Elementos de un programa

**¿Qué es?** Los bloques básicos con los que construyes programas: variables, tipos de datos, operadores.

**Variables - Cajitas con etiqueta:**
```python
# Una variable es un nombre que guarda un valor
nombre = "Python"      # Guarda texto
edad = 25             # Guarda número entero
precio = 19.99        # Guarda número con decimales

# Python detecta automáticamente el tipo
# No necesitas escribir: String nombre = "Python" (como en Java)
```

**Tipos de datos básicos:**

```python
# str (string) - Texto
nombre = "Juan"
apellido = 'García'  # Comillas simples o dobles, da igual
mensaje = """Texto
en varias
líneas"""            # Triple comilla para textos largos

# int (integer) - Números enteros
cantidad = 10
negativo = -5
grande = 1_000_000   # Puedes usar _ para legibilidad (un millón)

# float - Números con decimales
precio = 19.99
pi = 3.14159
cientifico = 1.5e3   # 1.5 × 10³ = 1500

# bool (boolean) - Verdadero/Falso
activo = True
terminado = False
# IMPORTANTE: Primera letra mayúscula (True, no true)

# list - Lista ordenada, se puede modificar
numeros = [1, 2, 3, 4, 5]
mixta = [1, "dos", 3.0, True]  # Puede mezclar tipos
vacia = []

# tuple - Lista ordenada, NO se puede modificar (inmutable)
coordenadas = (10, 20)
fecha = (2025, 10, 25)
# Útil para datos que no deben cambiar

# dict (dictionary) - Pares clave: valor
persona = {
    "nombre": "Juan",
    "edad": 25,
    "ciudad": "Madrid"
}
# Como un directorio: buscas por clave, obtienes valor

# set - Conjunto sin duplicados, sin orden
numeros_unicos = {1, 2, 3, 3, 2}  # Resultado: {1, 2, 3}
# Útil para eliminar duplicados
```

**Constantes - Variables que "no deberían" cambiar:**
```python
# Python no tiene constantes reales, pero por convención
# Usamos MAYÚSCULAS para indicar "no cambies esto"
PI = 3.14159
MAX_INTENTOS = 3
VELOCIDAD_LUZ = 299_792_458  # m/s

# Nadie te impide hacer PI = 5, pero no deberías
```

**Operadores - Símbolos para operar:**

**Aritméticos (matemáticas):**
```python
suma = 5 + 3        # 8
resta = 10 - 4      # 6
multiplicacion = 4 * 3  # 12
division = 10 / 3   # 3.333... (siempre devuelve float)
division_entera = 10 // 3  # 3 (sin decimales)
modulo = 10 % 3     # 1 (resto de la división)
potencia = 2 ** 3   # 8 (2 elevado a 3)

# Casos prácticos:
# Saber si número es par: numero % 2 == 0
# Convertir segundos a minutos: segundos // 60
```

**Comparación (devuelven True o False):**
```python
5 == 5      # True (igual que)
5 != 3      # True (distinto de)
5 > 3       # True (mayor que)
5 < 3       # False (menor que)
5 >= 5      # True (mayor o igual)
5 <= 3      # False (menor o igual)

# Comparar textos
"Python" == "python"  # False (distingue mayúsculas)
"Python".lower() == "python"  # True

# Comparar varios
18 <= edad < 65  # Edad entre 18 y 65 (exclusivo)
```

**Lógicos (combinar condiciones):**
```python
# and - Ambas deben ser True
edad > 18 and tiene_permiso  # True solo si las dos son True

# or - Al menos una debe ser True  
es_admin or es_moderador  # True si cualquiera es True

# not - Invierte (True → False, False → True)
not esta_bloqueado  # True si NO está bloqueado

# Ejemplos prácticos:
if edad >= 18 and tiene_dni:
    print("Puede votar")

if temperatura < 15 or temperatura > 30:
    print("Temperatura fuera de rango")

if not archivo_existe:
    crear_archivo()
```

**Pertenencia e identidad:**
```python
# in - Comprobar si está dentro
3 in [1, 2, 3, 4]        # True
"Python" in "Curso de Python"  # True
"a" in diccionario       # True (comprueba claves)

# not in - Comprobar si NO está
5 not in [1, 2, 3]       # True

# is - Comprobar si son EL MISMO objeto en memoria
a = [1, 2, 3]
b = a        # b apunta al mismo objeto que a
b is a       # True (mismo objeto)

c = [1, 2, 3]  # c es otro objeto con mismo contenido
c == a       # True (mismo contenido)
c is a       # False (objetos diferentes)

# is not - Negación de is
c is not a   # True

# Uso típico: comprobar None
variable is None     # Forma correcta
variable == None     # Funciona pero no es idiomático
```

**En la práctica:**
```python
# Calcular precio con IVA
precio_sin_iva = 100
IVA = 0.21
precio_final = precio_sin_iva * (1 + IVA)  # 121.0

# Validar edad para entrada
edad = 16
entrada_permitida = edad >= 18 or edad >= 14 and con_adulto
# Paréntesis para claridad:
entrada_permitida = (edad >= 18) or (edad >= 14 and con_adulto)

# Comprobar si número es múltiplo de 5
numero = 25
es_multiplo = numero % 5 == 0  # True
```

### 002 - Utilización de objetos

**¿Qué es?** Usar objetos ya creados por Python (librería estándar) sin tener que crearlos tú.

**Concepto de objeto:**
```python
# Un objeto es una "cosa" que tiene:
# - Datos (atributos/propiedades)
# - Acciones (métodos)

texto = "Hola mundo"
# texto es un objeto de tipo str (string)
# Tiene métodos que puedes usar:

texto.upper()      # Método: convertir a mayúsculas
texto.lower()      # Método: convertir a minúsculas
len(texto)         # Función: longitud (10 caracteres)
```

**Instanciación - Crear objetos:**
```python
# Importar clase de una librería
from datetime import datetime

# Crear instancia (objeto) de esa clase
ahora = datetime.now()  # Fecha y hora actual
print(ahora)  # 2025-10-25 14:30:15.123456

# Crear con parámetros
cumple = datetime(1995, 5, 15)  # 15 mayo 1995
print(cumple)  # 1995-05-15 00:00:00

# Acceder a propiedades
print(ahora.year)   # 2025
print(ahora.month)  # 10
print(ahora.day)    # 25
print(ahora.hour)   # 14
```

**Métodos de strings - Operaciones con texto:**
```python
texto = "hola mundo"

# MAYÚSCULAS/minúsculas
texto.upper()       # "HOLA MUNDO"
texto.lower()       # "hola mundo"
texto.capitalize()  # "Hola mundo" (primera mayúscula)
texto.title()       # "Hola Mundo" (cada palabra mayúscula)

# Buscar y reemplazar
texto.find("mundo")      # 5 (posición donde empieza)
texto.find("adios")      # -1 (no encontrado)
texto.replace("mundo", "Python")  # "hola Python"

# Dividir y unir
palabras = texto.split()       # ["hola", "mundo"]
"Hola-mundo".split("-")       # ["Hola", "mundo"]
"-".join(["a", "b", "c"])     # "a-b-c"

# Limpiar espacios
"  hola  ".strip()    # "hola" (quita espacios inicio/fin)
"  hola  ".lstrip()   # "hola  " (solo inicio)
"  hola  ".rstrip()   # "  hola" (solo final)

# Comprobar contenido
texto.startswith("hola")  # True
texto.endswith("mundo")   # True
"123".isdigit()          # True (solo números)
"abc".isalpha()          # True (solo letras)

# Formatear
nombre = "Juan"
edad = 25
mensaje = f"Hola {nombre}, tienes {edad} años"  # f-string (Python 3.6+)
mensaje = "Hola {}, tienes {} años".format(nombre, edad)  # Antiguo
```

**Métodos de listas - Manipular colecciones:**
```python
lista = [1, 2, 3]

# Añadir elementos
lista.append(4)        # [1, 2, 3, 4] (al final)
lista.insert(0, 0)     # [0, 1, 2, 3, 4] (en posición 0)
lista.extend([5, 6])   # [0, 1, 2, 3, 4, 5, 6] (varios)

# Quitar elementos
lista.remove(3)        # Quita el primer 3 que encuentra
ultimo = lista.pop()   # Quita y devuelve el último (6)
segundo = lista.pop(1) # Quita y devuelve posición 1
lista.clear()          # Vacía la lista []

# Buscar
lista = [1, 2, 3, 2, 1]
lista.count(2)         # 2 (cuántas veces aparece)
lista.index(3)         # 2 (posición del primer 3)

# Ordenar
lista = [3, 1, 4, 1, 5, 9]
lista.sort()           # [1, 1, 3, 4, 5, 9] (modifica original)
lista.sort(reverse=True)  # [9, 5, 4, 3, 1, 1] (descendente)
lista.reverse()        # Invierte orden

# Copiar (¡IMPORTANTE!)
lista2 = lista         # NO copia, apunta al mismo
lista2 = lista.copy()  # Copia real
lista2 = lista[:]      # Otra forma de copiar
```

**Métodos de diccionarios:**
```python
persona = {"nombre": "Juan", "edad": 25}

# Acceder
persona["nombre"]           # "Juan"
persona.get("ciudad", "Madrid")  # Madrid (default si no existe)

# Modificar
persona["edad"] = 26        # Cambiar existente
persona["ciudad"] = "Madrid"  # Añadir nuevo

# Obtener partes
persona.keys()    # dict_keys(['nombre', 'edad', 'ciudad'])
persona.values()  # dict_values(['Juan', 26, 'Madrid'])
persona.items()   # dict_items([('nombre', 'Juan'), ('edad', 26), ...])

# Iterar
for clave, valor in persona.items():
    print(f"{clave}: {valor}")

# Quitar
del persona["ciudad"]      # Borra clave
edad = persona.pop("edad") # Borra y devuelve valor
```

**Funciones incorporadas útiles:**
```python
# len() - Longitud
len("Hola")        # 4
len([1, 2, 3])     # 3
len({"a": 1})      # 1

# type() - Tipo de dato
type(5)            # <class 'int'>
type("hola")       # <class 'str'>

# max(), min(), sum() - Operaciones en colecciones
max([1, 5, 3])     # 5
min([1, 5, 3])     # 1
sum([1, 2, 3])     # 6

# abs() - Valor absoluto
abs(-5)            # 5

# round() - Redondear
round(3.14159, 2)  # 3.14 (2 decimales)

# sorted() - Ordenar (no modifica original)
sorted([3, 1, 2])  # [1, 2, 3]

# reversed() - Invertir
list(reversed([1, 2, 3]))  # [3, 2, 1]

# any(), all() - Lógica en listas
any([False, False, True])   # True (al menos uno True)
all([True, True, False])    # False (no todos True)
```

**Librerías útiles:**

**math - Matemáticas:**
```python
import math

math.sqrt(16)      # 4.0 (raíz cuadrada)
math.pow(2, 3)     # 8.0 (potencia)
math.pi            # 3.141592... (constante)
math.e             # 2.718281... (constante)
math.floor(3.7)    # 3 (redondear hacia abajo)
math.ceil(3.2)     # 4 (redondear hacia arriba)
math.sin(math.pi/2)  # 1.0 (seno)
math.cos(0)        # 1.0 (coseno)
```

**random - Números aleatorios:**
```python
import random

random.randint(1, 10)     # Entero aleatorio entre 1 y 10
random.random()           # Float aleatorio entre 0.0 y 1.0
random.choice([1,2,3])    # Elegir elemento aleatorio
random.shuffle(lista)     # Mezclar lista (modifica original)
random.sample(lista, 3)   # 3 elementos aleatorios sin repetir
```

**os - Sistema operativo:**
```python
import os

os.getcwd()           # Directorio actual
os.listdir('.')       # Listar archivos del directorio
os.mkdir('carpeta')   # Crear carpeta
os.path.exists('archivo.txt')  # Comprobar si existe
os.path.join('carpeta', 'archivo.txt')  # Unir rutas (funciona en Windows/Linux)
os.remove('archivo.txt')  # Borrar archivo
```

**En la práctica:**
```python
# Limpiar y procesar entrada de usuario
nombre = input("Nombre: ").strip().title()  # "  juan  " → "Juan"

# Generar código aleatorio
import random
codigo = ''.join([str(random.randint(0, 9)) for _ in range(6)])  # "472891"

# Listar archivos STL en carpeta
import os
stl_files = [f for f in os.listdir('.') if f.endswith('.stl')]

# Calcular ángulo para motor
import math
angulo_grados = 45
angulo_radianes = math.radians(angulo_grados)
seno = math.sin(angulo_radianes)
```

### 003 - Estructuras de control
```python
# Condicionales
if condicion:
    # código
elif otra_condicion:
    # código
else:
    # código

# Operador ternario
valor = x if condicion else y

# Bucles
for i in range(10):
    print(i)

for item in lista:
    print(item)

while condicion:
    # código

# Control de flujo
break       # Salir del bucle
continue    # Siguiente iteración
pass        # No hacer nada

# Excepciones
try:
    # código que puede fallar
except ValueError as e:
    # manejar error
except Exception as e:
    # cualquier error
finally:
    # siempre se ejecuta

# Aserciones
assert x > 0, "x debe ser positivo"
```

### 004 - Desarrollo de clases
```python
# Clase básica
class Modelo3D:
    def __init__(self, nombre, material):
        self.nombre = nombre           # Atributo público
        self._material = material      # Atributo protegido
        self.__precio = 0              # Atributo privado
    
    def imprimir(self):
        """Método de instancia"""
        print(f"Imprimiendo {self.nombre}")
    
    @staticmethod
    def info():
        """Método estático"""
        return "Sistema de impresión 3D"
    
    @classmethod
    def desde_archivo(cls, archivo):
        """Método de clase"""
        # Leer archivo y crear instancia
        return cls(nombre, material)
    
    @property
    def precio(self):
        """Getter"""
        return self.__precio
    
    @precio.setter
    def precio(self, valor):
        """Setter"""
        if valor >= 0:
            self.__precio = valor

# Herencia
class ModeloAvanzado(Modelo3D):
    def __init__(self, nombre, material, resolucion):
        super().__init__(nombre, material)
        self.resolucion = resolucion
    
    def imprimir(self):
        # Sobrescribir método
        print(f"Imprimiendo {self.nombre} en alta resolución")

# Uso
modelo = Modelo3D("Pieza", "PLA")
modelo.imprimir()
```

### 005 - Lectura y escritura
```python
# Archivos de texto
with open('archivo.txt', 'r') as f:
    contenido = f.read()
    # lineas = f.readlines()

with open('archivo.txt', 'w') as f:
    f.write("texto")

with open('archivo.txt', 'a') as f:  # append
    f.write("más texto\n")

# CSV
import csv
with open('datos.csv', 'w', newline='') as f:
    escritor = csv.writer(f)
    escritor.writerow(['col1', 'col2'])
    escritor.writerows(datos)

with open('datos.csv', 'r') as f:
    lector = csv.reader(f)
    for fila in lector:
        print(fila)

# JSON
import json
with open('datos.json', 'w') as f:
    json.dump(datos, f, indent=4)

with open('datos.json', 'r') as f:
    datos = json.load(f)

# Sistema de archivos
import os
os.makedirs('carpeta/subcarpeta', exist_ok=True)
os.remove('archivo.txt')
os.path.exists('ruta')
os.path.join('carpeta', 'archivo.txt')
os.listdir('.')

# Entrada/Salida
nombre = input("Nombre: ")
print(f"Hola {nombre}")
print(texto.center(50))
print(f"{numero:10.2f}")  # Formato

# Interfaz gráfica (tkinter)
import tkinter as tk
ventana = tk.Tk()
ventana.title("Mi App")

etiqueta = tk.Label(ventana, text="Hola")
etiqueta.pack()

entrada = tk.Entry(ventana)
entrada.pack()

def accion():
    valor = entrada.get()
    print(valor)

boton = tk.Button(ventana, text="Guardar", command=accion)
boton.pack()

ventana.mainloop()
```

### 006 - Estructuras de almacenamiento

**¿Qué es?** Diferentes formas de organizar colecciones de datos, cada una con sus ventajas.

**Listas - Colección ordenada y modificable:**

```python
# Crear listas
modelos = ["Raspberry Pi", "Arduino", "ESP32"]
numeros = [1, 2, 3, 4, 5]
vacia = []
mixta = [1, "dos", 3.0, True]  # Puede mezclar tipos

# Acceder por índice (empieza en 0)
primer_modelo = modelos[0]   # "Raspberry Pi"
ultimo = modelos[-1]         # "ESP32" (índice negativo = desde el final)
segundo_al_ultimo = modelos[-2]  # "Arduino"

# Slicing (rebanadas)
primeros_dos = modelos[0:2]  # ["Raspberry Pi", "Arduino"]
desde_segundo = modelos[1:]  # ["Arduino", "ESP32"]
hasta_segundo = modelos[:2]  # ["Raspberry Pi", "Arduino"]
ultimos_dos = modelos[-2:]   # ["Arduino", "ESP32"]

# Modificar
modelos[1] = "Arduino Mega"  # Cambiar elemento
modelos[0:2] = ["RPi4", "Arduino Uno"]  # Cambiar varios

# Añadir elementos
modelos.append("BeagleBone")       # Añadir al final
modelos.insert(1, "Banana Pi")     # Insertar en posición
modelos.extend(["Jetson", "Odroid"])  # Añadir varios al final
modelos += ["Rock Pi"]             # Equivalente a extend

# Quitar elementos
modelos.remove("ESP32")     # Quitar por valor (primer match)
ultimo = modelos.pop()      # Quitar y devolver último
segundo = modelos.pop(1)    # Quitar y devolver posición 1
del modelos[0]              # Borrar posición
del modelos[0:2]            # Borrar rango
modelos.clear()             # Vaciar lista

# Buscar
if "Arduino" in modelos:
    print("Tengo Arduino")

posicion = modelos.index("RPi4")  # Posición del primer match
cantidad = modelos.count("Arduino")  # Cuántas veces aparece

# Ordenar
numeros = [3, 1, 4, 1, 5]
numeros.sort()                # [1, 1, 3, 4, 5] (modifica original)
numeros.sort(reverse=True)    # [5, 4, 3, 1, 1] (descendente)
ordenados = sorted(numeros)   # Nueva lista ordenada (no modifica)

# Ordenar por criterio personalizado
modelos.sort(key=len)         # Ordenar por longitud del nombre
modelos.sort(key=str.lower)   # Ignorar mayúsculas al ordenar

# Invertir
numeros.reverse()             # Invierte orden (modifica)
invertidos = list(reversed(numeros))  # Nueva lista invertida

# Copiar (¡IMPORTANTE!)
lista2 = lista1        # NO copia, ambas apuntan a lo mismo
lista2 = lista1.copy()  # Copia real
lista2 = lista1[:]     # Otra forma de copiar
lista2 = list(lista1)  # Otra más
```

**List comprehension - Crear listas de forma concisa:**

```python
# Forma tradicional
cuadrados = []
for x in range(10):
    cuadrados.append(x**2)
# Resultado: [0, 1, 4, 9, 16, 25, 36, 49, 64, 81]

# List comprehension (más corto)
cuadrados = [x**2 for x in range(10)]

# Con condición
pares = [x for x in range(10) if x % 2 == 0]
# [0, 2, 4, 6, 8]

# Más ejemplos
# Nombres en mayúsculas
nombres = ["juan", "ana", "pedro"]
mayusculas = [n.upper() for n in nombres]  # ["JUAN", "ANA", "PEDRO"]

# Longitudes de palabras
palabras = ["hola", "mundo", "python"]
longitudes = [len(p) for p in palabras]  # [4, 5, 6]

# Filtrar archivos STL
archivos = ["modelo.stl", "imagen.jpg", "pieza.stl", "doc.pdf"]
stl_files = [f for f in archivos if f.endswith('.stl')]
# ["modelo.stl", "pieza.stl"]

# Con if-else
numeros = [1, 2, 3, 4, 5]
etiquetas = ["par" if x % 2 == 0 else "impar" for x in numeros]
# ["impar", "par", "impar", "par", "impar"]
```

**Diccionarios - Pares clave:valor:**

```python
# Crear diccionarios
placas = {
    "rpi4": {"ram": 4, "precio": 55},
    "arduino": {"ram": 0.002, "precio": 20}
}

persona = dict(nombre="Juan", edad=25)  # Otra forma

# Acceder
precio_rpi = placas["rpi4"]["precio"]  # 55
# Si la clave no existe, da KeyError

# Acceso seguro (con default)
precio = placas.get("jetson", {"precio": 0})["precio"]  # 0 (no existe)
edad = persona.get("edad", 18)  # 25 (existe)
ciudad = persona.get("ciudad", "Madrid")  # Madrid (no existe)

# Añadir/modificar
persona["email"] = "juan@email.com"  # Añadir
persona["edad"] = 26  # Modificar

# Múltiples valores a la vez
persona.update({"telefono": "123456", "ciudad": "Madrid"})

# Quitar
del persona["email"]           # Borrar clave
edad = persona.pop("edad")     # Borrar y devolver valor
ciudad = persona.pop("ciudad", "Desconocida")  # Con default si no existe

# Iterar
for clave in placas:
    print(clave)  # "rpi4", "arduino"

for placa, specs in placas.items():
    print(f"{placa}: {specs['ram']}GB RAM")

for precio in placas.values():
    print(precio)

# Comprobar existencia
if "rpi4" in placas:
    print("Tengo Raspberry Pi 4")

# Claves, valores, pares
claves = list(placas.keys())      # ["rpi4", "arduino"]
valores = list(placas.values())   # [{...}, {...}]
pares = list(placas.items())      # [("rpi4", {...}), ...]

# Dict comprehension
cuadrados = {x: x**2 for x in range(5)}
# {0: 0, 1: 1, 2: 4, 3: 9, 4: 16}

# Invertir diccionario (swap clave-valor)
inverso = {v: k for k, v in {"a": 1, "b": 2}.items()}
# {1: "a", 2: "b"}

# Filtrar
caros = {k: v for k, v in placas.items() if v["precio"] > 30}
```

**Sets (conjuntos) - Sin duplicados, sin orden:**

```python
# Crear sets
numeros = {1, 2, 3, 3, 2, 1}  # Resultado: {1, 2, 3} (sin duplicados)
vacio = set()  # {} crea dict vacío, no set

# Desde lista (eliminar duplicados)
lista = [1, 2, 2, 3, 3, 3]
unicos = set(lista)  # {1, 2, 3}

# Añadir/quitar
colores = {"rojo", "verde"}
colores.add("azul")         # {"rojo", "verde", "azul"}
colores.remove("rojo")      # KeyError si no existe
colores.discard("amarillo") # No da error si no existe
colores.pop()               # Quita uno aleatorio
colores.clear()             # Vaciar set

# Operaciones de conjuntos
a = {1, 2, 3, 4}
b = {3, 4, 5, 6}

union = a | b              # {1, 2, 3, 4, 5, 6} (todos)
union = a.union(b)         # Equivalente

interseccion = a & b       # {3, 4} (comunes)
interseccion = a.intersection(b)

diferencia = a - b         # {1, 2} (en a pero no en b)
diferencia = a.difference(b)

simetrica = a ^ b          # {1, 2, 5, 6} (en uno pero no ambos)
simetrica = a.symmetric_difference(b)

# Subconjuntos y superconjuntos
a = {1, 2}
b = {1, 2, 3, 4}
a.issubset(b)     # True (a está dentro de b)
b.issuperset(a)   # True (b contiene a a)
a.isdisjoint(b)   # False (tienen elementos comunes)

# Casos prácticos
# Eliminar duplicados de lista manteniendo orden
def unique(lista):
    seen = set()
    return [x for x in lista if not (x in seen or seen.add(x))]

# Encontrar elementos comunes entre listas
lista1 = [1, 2, 3, 4]
lista2 = [3, 4, 5, 6]
comunes = list(set(lista1) & set(lista2))  # [3, 4]
```

**Tuplas - Inmutables (no se pueden modificar):**

```python
# Crear tuplas
coordenadas = (10, 20)
fecha = (2025, 10, 25)
una_elemento = (5,)  # Coma necesaria para tupla de 1 elemento
sin_parentesis = 1, 2, 3  # También es tupla

# Acceder (igual que listas)
x = coordenadas[0]  # 10
y = coordenadas[1]  # 20

# NO se pueden modificar
# coordenadas[0] = 15  # TypeError!

# Desempaquetado
x, y = coordenadas  # x=10, y=20
año, mes, dia = fecha  # año=2025, mes=10, dia=25

# Intercambiar variables (gracias a desempaquetado)
a, b = 5, 10
a, b = b, a  # Ahora a=10, b=5

# Tupla con nombre (más legible)
from collections import namedtuple
Punto = namedtuple('Punto', ['x', 'y', 'z'])
p = Punto(10, 20, 30)
print(p.x)  # 10 (más claro que p[0])

# ¿Cuándo usar tuplas vs listas?
# Tuplas: Datos que no cambian (coordenadas, fechas, retorno de funciones)
# Listas: Datos que se modifican (inventario, usuarios, cola de trabajos)

# Retornar múltiples valores de función
def min_max(numeros):
    return min(numeros), max(numeros)  # Retorna tupla

minimo, maximo = min_max([1, 2, 3, 4, 5])  # minimo=1, maximo=5
```

**Comparación de estructuras:**

| Estructura | Ordenada | Modificable | Duplicados | Sintaxis |
|------------|----------|-------------|------------|----------|
| Lista      | ✅ Sí    | ✅ Sí       | ✅ Sí      | `[1,2,3]` |
| Tupla      | ✅ Sí    | ❌ No       | ✅ Sí      | `(1,2,3)` |
| Set        | ❌ No    | ✅ Sí       | ❌ No      | `{1,2,3}` |
| Dict       | ✅ Sí*   | ✅ Sí       | ❌ No**    | `{"a":1}` |

*Python 3.7+: diccionarios mantienen orden de inserción  
**Claves únicas, valores pueden repetirse

**En la práctica:**

```python
# Gestión de cola de impresión 3D
cola_impresion = ["modelo1.stl", "modelo2.stl"]
cola_impresion.append("modelo3.stl")  # Añadir a cola
siguiente = cola_impresion.pop(0)     # Sacar primero de la cola

# Inventario de materiales
materiales = {
    "PLA": {"kg": 2.5, "color": "negro"},
    "PETG": {"kg": 1.0, "color": "transparente"}
}
if materiales["PLA"]["kg"] < 0.5:
    print("Comprar más PLA")

# Tags únicos para modelos
tags_modelo1 = {"funcional", "raspberry", "soporte"}
tags_modelo2 = {"decorativo", "raspberry", "caja"}
tags_comunes = tags_modelo1 & tags_modelo2  # {"raspberry"}

# Coordenadas 3D inmutables
posicion_extrusor = (120.5, 85.3, 10.0)  # (x, y, z)
x, y, z = posicion_extrusor
```

### 007 - Uso avanzado de clases
```python
# Polimorfismo
def procesar(objeto):
    objeto.metodo()  # Funciona con cualquier clase que tenga metodo()

# Interfaces (ABC)
from abc import ABC, abstractmethod
class Imprimible(ABC):
    @abstractmethod
    def imprimir(self):
        pass

# Métodos especiales
class Punto:
    def __init__(self, x, y):
        self.x = x
        self.y = y
    
    def __str__(self):
        return f"Punto({self.x}, {self.y})"
    
    def __repr__(self):
        return f"Punto({self.x}, {self.y})"
    
    def __add__(self, otro):
        return Punto(self.x + otro.x, self.y + otro.y)
    
    def __eq__(self, otro):
        return self.x == otro.x and self.y == otro.y

# Decoradores
def log(func):
    def wrapper(*args, **kwargs):
        print(f"Llamando a {func.__name__}")
        return func(*args, **kwargs)
    return wrapper

@log
def funcion():
    pass
```

### 008 - Persistencia de objetos
```python
# Pickle (serialización Python)
import pickle
with open('objeto.pkl', 'wb') as f:
    pickle.dump(objeto, f)

with open('objeto.pkl', 'rb') as f:
    objeto = pickle.load(f)

# Shelve (diccionario persistente)
import shelve
with shelve.open('datos') as db:
    db['clave'] = objeto
    objeto = db['clave']
```

### 009 - Gestión de bases de datos
```python
# MySQL con Python
import mysql.connector

conexion = mysql.connector.connect(
    host="localhost",
    user="usuario",
    password="contraseña",
    database="basedatos"
)

cursor = conexion.cursor()
cursor.execute("SELECT * FROM tabla")
resultados = cursor.fetchall()

cursor.execute("INSERT INTO tabla (col) VALUES (%s)", (valor,))
conexion.commit()

cursor.close()
conexion.close()

# SQLite
import sqlite3
conn = sqlite3.connect('base.db')
cursor = conn.cursor()
cursor.execute("CREATE TABLE IF NOT EXISTS tabla (id INTEGER, nombre TEXT)")
cursor.execute("INSERT INTO tabla VALUES (?, ?)", (1, "dato"))
conn.commit()
conn.close()
```

---

## 🔧 ENTORNOS DE DESARROLLO

### 001 - Desarrollo de software
- **SDLC**: Análisis → Diseño → Desarrollo → Pruebas → Despliegue → Mantenimiento
- **Metodologías ágiles**: Scrum, Kanban, XP
- **Sprints**: Iteraciones cortas (1-4 semanas)
- **User Stories**: Como [usuario] quiero [funcionalidad] para [beneficio]

### 002 - Entornos de desarrollo (IDE)
```bash
# VS Code
- Extensions: Python, Pylance, GitLens
- Shortcuts: Ctrl+P (buscar), Ctrl+Shift+P (comandos)
- Debugging: F5 (run), F9 (breakpoint)

# Git básico
git init
git add .
git commit -m "mensaje"
git push origin main
git pull
git status
git log

# Terminal
ls, cd, mkdir, rm, cp, mv
cat, grep, find, chmod
```

### 003 - Pruebas
```python
# Unit testing
import unittest

class TestModelo(unittest.TestCase):
    def setUp(self):
        self.modelo = Modelo3D("Pieza", "PLA")
    
    def test_nombre(self):
        self.assertEqual(self.modelo.nombre, "Pieza")
    
    def test_imprimir(self):
        resultado = self.modelo.imprimir()
        self.assertIsNotNone(resultado)

if __name__ == '__main__':
    unittest.main()

# Tipos de pruebas
- Unitarias: Funciones/métodos individuales
- Integración: Módulos juntos
- Sistema: Aplicación completa
- Regresión: Después de cambios
```

### 004 - Optimización y documentación
```python
# Docstrings
def funcion(param):
    """
    Descripción breve.
    
    Args:
        param (int): Descripción del parámetro
    
    Returns:
        str: Descripción del retorno
    
    Raises:
        ValueError: Si param es negativo
    """
    pass

# Refactorización
- Nombres descriptivos
- Funciones pequeñas (una responsabilidad)
- DRY (Don't Repeat Yourself)
- Eliminar código muerto

# Control de versiones
- Branches: main, develop, feature/nombre
- Commits: Mensajes claros y concisos
- Pull Requests: Revisión de código
- Tags: Versiones (v1.0.0)
```

### 005 - Diagramas de clases (UML)
```
┌─────────────────┐
│   Modelo3D      │
├─────────────────┤
│ - nombre: str   │
│ - material: str │
├─────────────────┤
│ + imprimir()    │
│ + calcular()    │
└─────────────────┘
        △
        │
        │ (herencia)
        │
┌─────────────────┐
│ ModeloAvanzado  │
└─────────────────┘

Relaciones:
→  Asociación
◇→ Agregación
◆→ Composición
```

### 006 - Diagramas de comportamiento
- **Casos de uso**: Actores → Sistema
- **Secuencia**: Interacciones entre objetos
- **Actividad**: Flujo de trabajo
- **Estado**: Transiciones de estado

---

## 🌐 LENGUAJES DE MARCAS

### 001 - Características de lenguajes de marcas
- **XML**: Extensible, jerárquico, etiquetas personalizadas
- **JSON**: Ligero, pares clave-valor
- **YAML**: Indentación, legible
- **Markdown**: Documentación simple

### 002 - Lenguajes en entornos web
```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <a href="#">Inicio</a>
        </nav>
    </header>
    
    <main>
        <section>
            <h1>Título</h1>
            <p>Párrafo</p>
            <img src="imagen.jpg" alt="descripción">
        </section>
    </main>
    
    <footer>
        <p>&copy; 2025</p>
    </footer>
    
    <script src="script.js"></script>
</body>
</html>
```

```css
/* CSS básico */
selector {
    color: #333;
    font-size: 16px;
    margin: 10px;
    padding: 20px;
    display: flex;
    background-color: blue;
}

.clase { }
#id { }
elemento { }
elemento.clase { }
```

### 003 - Manipulación de documentos Web
```javascript
// Selección
document.getElementById('id')
document.querySelector('.clase')
document.querySelectorAll('elemento')

// Modificación
elemento.innerHTML = 'contenido'
elemento.textContent = 'texto'
elemento.style.color = 'red'
elemento.classList.add('clase')
elemento.classList.remove('clase')

// Creación
const div = document.createElement('div')
div.textContent = 'Nuevo'
padre.appendChild(div)

// Eventos
elemento.addEventListener('click', function() {
    // acción
})

// DOM común
button.onclick = () => { }
form.onsubmit = (e) => { e.preventDefault() }
```

### 004 - Esquemas y vocabularios
```xml
<!-- XML -->
<?xml version="1.0" encoding="UTF-8"?>
<catalogo>
    <producto id="1">
        <nombre>Pieza 3D</nombre>
        <precio>15.50</precio>
    </producto>
</catalogo>

<!-- DTD -->
<!ELEMENT catalogo (producto+)>
<!ELEMENT producto (nombre, precio)>
<!ATTLIST producto id CDATA #REQUIRED>

<!-- XSD (XML Schema) -->
<xs:schema>
    <xs:element name="nombre" type="xs:string"/>
    <xs:element name="precio" type="xs:decimal"/>
</xs:schema>
```

### 005 - Conversión y adaptación
```javascript
// JSON
{
    "nombre": "Producto",
    "precio": 15.50,
    "stock": 100
}

// XML ↔ JSON
const obj = JSON.parse(jsonString)
const json = JSON.stringify(objeto)

// XSLT (transformaciones XML)
<xsl:template match="/">
    <html>
        <xsl:apply-templates/>
    </html>
</xsl:template>
```

### 006 - Almacenamiento de información
```javascript
// LocalStorage
localStorage.setItem('clave', 'valor')
localStorage.getItem('clave')
localStorage.removeItem('clave')

// SessionStorage
sessionStorage.setItem('clave', 'valor')

// Cookies
document.cookie = "nombre=valor; expires=fecha; path=/"
```

### 007 - Sistemas de gestión empresarial
- **ERP**: Enterprise Resource Planning
- **CRM**: Customer Relationship Management
- **XML/JSON**: Intercambio de datos
- **APIs REST**: Comunicación sistemas

---

## 🎯 COMANDOS ÚTILES RASPBERRY PI / LINUX

```bash
# Sistema
sudo apt update
sudo apt upgrade
sudo apt install paquete
sudo systemctl start servicio
sudo systemctl enable servicio
sudo systemctl status servicio

# Archivos
ls -la
cd /ruta
mkdir carpeta
rm -rf carpeta
cp origen destino
mv origen destino
chmod 755 archivo
chown usuario:grupo archivo

# Red
ifconfig
ip addr
ping google.com
ssh usuario@ip
scp archivo usuario@ip:/ruta

# Procesos
ps aux
top
htop
kill PID
killall nombre

# GPIO (Raspberry Pi)
gpio readall
python3 script.py

# Python
python3 -m venv venv
source venv/bin/activate
pip install paquete
pip freeze > requirements.txt
python3 script.py
```

---

## 📊 PATRONES Y BUENAS PRÁCTICAS

### Python
- **PEP 8**: Estilo de código Python
- **Snake_case**: variables_y_funciones
- **PascalCase**: NombresDeClases
- **UPPER_CASE**: CONSTANTES
- **Comprehensions**: `[x**2 for x in range(10)]`
- **Context managers**: `with open() as f:`
- **Decoradores**: `@property`, `@staticmethod`

### SQL
- **UPPER**: SELECT, FROM, WHERE
- **Índices**: Mejorar rendimiento
- **Transacciones**: ACID
- **Normalización**: Evitar redundancia

### Git
- **Commits frecuentes**: Cambios pequeños
- **Branches**: feature/nombre
- **Mensajes**: "Add", "Fix", "Update", "Remove"
- **.gitignore**: Excluir archivos

### General
- **DRY**: Don't Repeat Yourself
- **KISS**: Keep It Simple, Stupid
- **YAGNI**: You Aren't Gonna Need It
- **Single Responsibility**: Una función, una tarea
- **Comentarios**: Explican el "por qué", no el "qué"

---

## 🚀 PROYECTO INTEGRADOR - IDEAS

### Sistema de Impresión 3D completo
1. **Backend (Python)**: Gestión de modelos, materiales, clientes
2. **Base de datos (MySQL)**: Almacenar proyectos, usuarios
3. **Frontend (HTML/CSS/JS)**: Interfaz web
4. **Raspberry Pi**: Control de impresora (OctoPrint)
5. **Git**: Control de versiones
6. **Documentación**: README, diagramas UML

### Home Automation con Raspberry Pi
1. **Python**: Scripts control GPIO
2. **Base de datos**: Logs de sensores
3. **Web**: Panel de control
4. **Linux**: Servicios systemd
5. **Red**: Acceso remoto SSH

### Gestión de Inventario 3D
1. **CRUD completo**: Crear, leer, actualizar, eliminar
2. **API REST**: Flask/FastAPI
3. **Frontend**: React/Vue o simple HTML
4. **Base de datos**: Relacional + archivos
5. **Tests**: Unitarios e integración

---

## 🎯 SIMULACROS DE EXAMEN

### Bases de Datos - Blog con Autores y Entradas

**Escenario completo**: Crear un sistema de blog profesional con autores, entradas, categorías y comentarios.

#### Paso 1: Crear base de datos con codificación correcta

```sql
-- UTF-8 para acentos y emojis 😊
CREATE DATABASE blog2526 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE blog2526;
```

**¿Por qué UTF-8?** Para guardar tildes (á, é, í), ñ, emojis y caracteres especiales sin problemas.

#### Paso 2: Crear tablas sin restricciones

```sql
-- Primero creamos estructura básica
CREATE TABLE autores (
    id_autor INT,
    nombre VARCHAR(100),
    email VARCHAR(100),
    fecha_registro DATE,
    biografia TEXT
);

CREATE TABLE categorias (
    id_categoria INT,
    nombre VARCHAR(50),
    descripcion VARCHAR(200)
);

CREATE TABLE entradas (
    id_entrada INT,
    id_autor INT,
    id_categoria INT,
    titulo VARCHAR(200),
    contenido TEXT,
    fecha_publicacion DATE,
    visitas INT DEFAULT 0,
    estado ENUM('borrador', 'publicado', 'archivado') DEFAULT 'borrador'
);

CREATE TABLE comentarios (
    id_comentario INT,
    id_entrada INT,
    nombre_usuario VARCHAR(100),
    comentario TEXT,
    fecha_comentario DATETIME
);
```

#### Paso 3: Añadir claves primarias con ALTER TABLE

```sql
-- Añadimos restricciones después
ALTER TABLE autores 
ADD PRIMARY KEY (id_autor);

ALTER TABLE categorias 
ADD PRIMARY KEY (id_categoria);

ALTER TABLE entradas 
ADD PRIMARY KEY (id_entrada);

ALTER TABLE comentarios 
ADD PRIMARY KEY (id_comentario);
```

**¿Por qué ALTER TABLE?** En examen suelen dar tablas ya creadas y hay que modificarlas.

#### Paso 4: Añadir AUTO_INCREMENT (importante para MySQL)

```sql
-- Modificamos las claves primarias para que sean auto-incrementales
ALTER TABLE autores 
MODIFY id_autor INT AUTO_INCREMENT;

ALTER TABLE categorias 
MODIFY id_categoria INT AUTO_INCREMENT;

ALTER TABLE entradas 
MODIFY id_entrada INT AUTO_INCREMENT;

ALTER TABLE comentarios 
MODIFY id_comentario INT AUTO_INCREMENT;
```

#### Paso 5: Crear claves foráneas con restricciones

```sql
-- Entrada → Autor (si borras autor, ¿qué pasa con sus entradas?)
ALTER TABLE entradas
ADD CONSTRAINT fk_entrada_autor
FOREIGN KEY (id_autor) 
REFERENCES autores(id_autor)
ON DELETE CASCADE          -- Borrar entradas del autor
ON UPDATE CASCADE;         -- Actualizar si cambia id

-- Entrada → Categoría
ALTER TABLE entradas
ADD CONSTRAINT fk_entrada_categoria
FOREIGN KEY (id_categoria) 
REFERENCES categorias(id_categoria)
ON DELETE SET NULL         -- Si borras categoría, poner NULL
ON UPDATE CASCADE;

-- Comentario → Entrada
ALTER TABLE comentarios
ADD CONSTRAINT fk_comentario_entrada
FOREIGN KEY (id_entrada) 
REFERENCES entradas(id_entrada)
ON DELETE CASCADE          -- Si borras entrada, borrar sus comentarios
ON UPDATE CASCADE;
```

**Opciones ON DELETE:**
- `CASCADE`: Borra en cascada (si borras autor, borra sus entradas)
- `SET NULL`: Pone NULL (si borras categoría, entrada queda sin categoría)
- `RESTRICT`: No permite borrar si tiene datos relacionados
- `NO ACTION`: Igual que RESTRICT

#### Paso 6: Insertar datos de prueba

```sql
-- Autores
INSERT INTO autores (nombre, email, fecha_registro, biografia) VALUES
('Ana García', 'ana@blog.com', '2024-01-10', 'Desarrolladora web apasionada por Python y bases de datos'),
('Carlos Ruiz', 'carlos@blog.com', '2024-02-15', 'Experto en impresión 3D y Arduino'),
('María López', 'maria@blog.com', '2024-03-20', 'Estudiante de DAM, entusiasta de Raspberry Pi'),
('Pedro Sánchez', 'pedro@blog.com', '2024-04-05', 'Maker y desarrollador full-stack');

-- Categorías
INSERT INTO categorias (nombre, descripcion) VALUES
('Programación', 'Tutoriales de Python, Java, JavaScript'),
('Hardware', 'Raspberry Pi, Arduino, IoT'),
('Impresión 3D', 'Diseños, filamentos, tutoriales'),
('Bases de datos', 'MySQL, PostgreSQL, MongoDB'),
('Proyectos', 'Proyectos integradores y prácticos');

-- Entradas (nota: id_autor y id_categoria se autogeneran)
INSERT INTO entradas (id_autor, id_categoria, titulo, contenido, fecha_publicacion, visitas, estado) VALUES
(1, 1, 'Introducción a Python', 'Python es un lenguaje versátil...', '2025-01-15', 150, 'publicado'),
(2, 2, 'Controlar LED con Raspberry Pi', 'Tutorial para encender LEDs con GPIO...', '2025-01-20', 230, 'publicado'),
(1, 4, 'Bases de datos relacionales', 'Conceptos fundamentales de MySQL...', '2025-01-25', 180, 'publicado'),
(3, 3, 'Mi primera impresión 3D', 'Configuración de Cura para PLA...', '2025-02-01', 95, 'publicado'),
(2, 5, 'Sistema domótico con ESP32', 'Controla luces desde tu móvil...', '2025-02-10', 320, 'publicado'),
(4, 1, 'Flask: web en Python', 'Crear APIs REST con Flask...', '2025-02-15', 275, 'publicado'),
(1, 1, 'Tutorial de decoradores', 'Borrador en progreso...', NULL, 0, 'borrador');

-- Comentarios
INSERT INTO comentarios (id_entrada, nombre_usuario, comentario, fecha_comentario) VALUES
(1, 'Usuario123', 'Excelente tutorial para principiantes', '2025-01-16 10:30:00'),
(1, 'DevJunior', 'Me ayudó mucho, gracias!', '2025-01-17 14:20:00'),
(2, 'MakerPro', '¿Funciona con Raspberry Pi 3?', '2025-01-21 09:15:00'),
(2, 'Carlos Ruiz', 'Sí, funciona con Pi 3 y Pi 4', '2025-01-21 10:00:00'),
(3, 'Estudiante', 'Muy clara la explicación de JOINs', '2025-01-26 16:45:00'),
(5, 'HomeUser', 'Implementé esto en casa, funciona perfecto', '2025-02-11 20:30:00');
```

#### Paso 7: Consultas avanzadas con JOINs

```sql
-- LEFT JOIN: Todos los autores, aunque no tengan entradas publicadas
SELECT 
    a.nombre AS autor,
    a.email,
    COUNT(e.id_entrada) AS num_entradas,
    COALESCE(SUM(e.visitas), 0) AS total_visitas
FROM autores a
LEFT JOIN entradas e ON a.id_autor = e.id_autor 
    AND e.estado = 'publicado'
GROUP BY a.id_autor, a.nombre, a.email
ORDER BY total_visitas DESC;

-- INNER JOIN múltiple: Entradas con toda su información
SELECT 
    e.titulo,
    a.nombre AS autor,
    c.nombre AS categoria,
    e.fecha_publicacion,
    e.visitas,
    COUNT(com.id_comentario) AS num_comentarios
FROM entradas e
INNER JOIN autores a ON e.id_autor = a.id_autor
INNER JOIN categorias c ON e.id_categoria = c.id_categoria
LEFT JOIN comentarios com ON e.id_entrada = com.id_entrada
WHERE e.estado = 'publicado'
GROUP BY e.id_entrada, e.titulo, a.nombre, c.nombre, 
         e.fecha_publicacion, e.visitas
ORDER BY e.fecha_publicacion DESC;

-- Subconsulta: Entradas más populares que la media
SELECT titulo, visitas
FROM entradas
WHERE visitas > (SELECT AVG(visitas) FROM entradas)
ORDER BY visitas DESC;

-- HAVING: Categorías con más de 2 entradas
SELECT 
    c.nombre AS categoria,
    COUNT(e.id_entrada) AS num_entradas,
    AVG(e.visitas) AS visitas_promedio
FROM categorias c
LEFT JOIN entradas e ON c.id_categoria = e.id_categoria
GROUP BY c.id_categoria, c.nombre
HAVING COUNT(e.id_entrada) > 1
ORDER BY num_entradas DESC;
```

#### Paso 8: Crear vistas para consultas frecuentes

```sql
-- Vista: Resumen de entradas publicadas
CREATE VIEW vista_entradas_publicadas AS
SELECT 
    e.id_entrada,
    e.titulo,
    a.nombre AS autor,
    a.email AS email_autor,
    c.nombre AS categoria,
    DATE_FORMAT(e.fecha_publicacion, '%d/%m/%Y') AS fecha,
    e.visitas,
    (SELECT COUNT(*) 
     FROM comentarios com 
     WHERE com.id_entrada = e.id_entrada) AS comentarios
FROM entradas e
INNER JOIN autores a ON e.id_autor = a.id_autor
INNER JOIN categorias c ON e.id_categoria = c.id_categoria
WHERE e.estado = 'publicado'
ORDER BY e.fecha_publicacion DESC;

-- Usar la vista
SELECT * FROM vista_entradas_publicadas WHERE categoria = 'Hardware';

-- Vista: Ranking de autores
CREATE VIEW vista_ranking_autores AS
SELECT 
    a.nombre,
    COUNT(e.id_entrada) AS entradas_publicadas,
    SUM(e.visitas) AS total_visitas,
    AVG(e.visitas) AS visitas_promedio
FROM autores a
LEFT JOIN entradas e ON a.id_autor = e.id_autor 
    AND e.estado = 'publicado'
GROUP BY a.id_autor, a.nombre
ORDER BY total_visitas DESC;
```

#### Paso 9: Crear usuarios con permisos específicos

```sql
-- Usuario para la aplicación web (lectura y escritura)
CREATE USER 'blog_app'@'localhost' IDENTIFIED BY 'App_2025!';
GRANT SELECT, INSERT, UPDATE ON blog2526.* TO 'blog_app'@'localhost';

-- Usuario para los autores (solo sus propias entradas)
CREATE USER 'autor'@'localhost' IDENTIFIED BY 'Autor_2025!';
GRANT SELECT ON blog2526.vista_entradas_publicadas TO 'autor'@'localhost';
GRANT INSERT, UPDATE ON blog2526.entradas TO 'autor'@'localhost';

-- Usuario administrador (todos los permisos)
CREATE USER 'blog_admin'@'localhost' IDENTIFIED BY 'Admin_2025!';
GRANT ALL PRIVILEGES ON blog2526.* TO 'blog_admin'@'localhost';

-- Usuario solo lectura (estadísticas)
CREATE USER 'blog_stats'@'localhost' IDENTIFIED BY 'Stats_2025!';
GRANT SELECT ON blog2526.vista_ranking_autores TO 'blog_stats'@'localhost';
GRANT SELECT ON blog2526.vista_entradas_publicadas TO 'blog_stats'@'localhost';

-- Aplicar cambios
FLUSH PRIVILEGES;

-- Ver permisos de un usuario
SHOW GRANTS FOR 'blog_app'@'localhost';
```

#### Paso 10: Operaciones avanzadas

```sql
-- UPDATE: Incrementar visitas
UPDATE entradas 
SET visitas = visitas + 1 
WHERE id_entrada = 5;

-- UPDATE con JOIN: Cambiar categoría de todas las entradas de un autor
UPDATE entradas e
INNER JOIN autores a ON e.id_autor = a.id_autor
SET e.id_categoria = 5
WHERE a.nombre = 'Carlos Ruiz' AND e.estado = 'borrador';

-- DELETE con subconsulta: Borrar comentarios spam (menos de 5 caracteres)
DELETE FROM comentarios 
WHERE LENGTH(comentario) < 5;

-- Transacciones: Publicar entrada y notificar
START TRANSACTION;

UPDATE entradas 
SET estado = 'publicado', 
    fecha_publicacion = CURDATE() 
WHERE id_entrada = 7;

INSERT INTO comentarios (id_entrada, nombre_usuario, comentario, fecha_comentario)
VALUES (7, 'Sistema', 'Entrada publicada automáticamente', NOW());

COMMIT;  -- Si todo OK, confirmar cambios
-- ROLLBACK;  -- Si hay error, deshacer
```

**Conceptos clave del simulacro completo:**
- ✅ CREATE DATABASE con charset UTF-8 (acentos y emojis)
- ✅ ALTER TABLE para modificar estructura existente
- ✅ AUTO_INCREMENT para claves primarias
- ✅ FOREIGN KEY con ON DELETE CASCADE/SET NULL
- ✅ INNER JOIN vs LEFT JOIN (diferencia crucial)
- ✅ Subconsultas en SELECT y WHERE
- ✅ GROUP BY + HAVING para filtrar grupos
- ✅ CREATE VIEW para consultas reutilizables
- ✅ Gestión de usuarios con GRANT específicos
- ✅ Transacciones con START TRANSACTION/COMMIT
- ✅ Funciones: COUNT(), AVG(), SUM(), DATE_FORMAT(), COALESCE()

**Aplicación práctica con Raspberry Pi:**
- Blog de proyectos maker guardado en MySQL
- Raspberry Pi como servidor web + base de datos
- Consultas desde app móvil para ver entradas
- Sistema de comentarios en tiempo real

### Programación - CRUD Completo de Blog con Python

**Escenario completo**: Aplicación de consola profesional para gestionar el blog con todas las operaciones CRUD, validaciones, exportación y menú interactivo.

#### Arquitectura del proyecto

```
blog_manager/
│
├── main.py              # Programa principal con menú
├── database.py          # Conexión y operaciones BD
├── modelos.py           # Clases Entrada, Autor, Comentario
├── exportador.py        # Exportar a JSON/CSV
└── config.py            # Configuración (credenciales BD)
```

#### 1. Configuración y conexión (config.py + database.py)

```python
# config.py - Credenciales centralizadas
DB_CONFIG = {
    'host': 'localhost',
    'user': 'blog_app',
    'password': 'App_2025!',
    'database': 'blog2526'
}

# database.py - Gestión de conexión
import mysql.connector
from mysql.connector import Error
from config import DB_CONFIG

class Database:
    def __init__(self):
        """Inicializar conexión a la base de datos"""
        try:
            self.conexion = mysql.connector.connect(**DB_CONFIG)
            self.cursor = self.conexion.cursor(dictionary=True)  # Resultados como dict
            print("✓ Conectado a la base de datos")
        except Error as e:
            print(f"✗ Error de conexión: {e}")
            self.conexion = None
    
    def ejecutar_query(self, query, parametros=None):
        """Ejecutar SELECT y devolver resultados"""
        try:
            self.cursor.execute(query, parametros or ())
            return self.cursor.fetchall()
        except Error as e:
            print(f"✗ Error en consulta: {e}")
            return []
    
    def ejecutar_modificacion(self, query, parametros=None):
        """Ejecutar INSERT/UPDATE/DELETE"""
        try:
            self.cursor.execute(query, parametros or ())
            self.conexion.commit()
            return True
        except Error as e:
            print(f"✗ Error: {e}")
            self.conexion.rollback()
            return False
    
    def obtener_ultimo_id(self):
        """Obtener ID del último INSERT"""
        return self.cursor.lastrowid
    
    def cerrar(self):
        """Cerrar conexión"""
        if self.conexion and self.conexion.is_connected():
            self.cursor.close()
            self.conexion.close()
            print("✓ Conexión cerrada")
```

#### 2. Modelos - POO con clases (modelos.py)

```python
# modelos.py - Clases para representar entidades
from datetime import datetime

class Autor:
    def __init__(self, id_autor=None, nombre="", email="", fecha_registro=None, biografia=""):
        self.id_autor = id_autor
        self.nombre = nombre
        self.email = email
        self.fecha_registro = fecha_registro or datetime.now().date()
        self.biografia = biografia
    
    def validar(self):
        """Validar datos antes de guardar"""
        errores = []
        if not self.nombre or len(self.nombre) < 3:
            errores.append("Nombre debe tener al menos 3 caracteres")
        if "@" not in self.email or "." not in self.email:
            errores.append("Email inválido")
        return errores
    
    def __str__(self):
        return f"{self.nombre} ({self.email})"

class Entrada:
    def __init__(self, id_entrada=None, id_autor=None, id_categoria=None,
                 titulo="", contenido="", fecha_publicacion=None, 
                 visitas=0, estado="borrador"):
        self.id_entrada = id_entrada
        self.id_autor = id_autor
        self.id_categoria = id_categoria
        self.titulo = titulo
        self.contenido = contenido
        self.fecha_publicacion = fecha_publicacion
        self.visitas = visitas
        self.estado = estado
    
    def validar(self):
        """Validar entrada"""
        errores = []
        if not self.titulo or len(self.titulo) < 5:
            errores.append("Título debe tener al menos 5 caracteres")
        if not self.contenido or len(self.contenido) < 20:
            errores.append("Contenido debe tener al menos 20 caracteres")
        if not self.id_autor:
            errores.append("Debe especificar un autor")
        if not self.id_categoria:
            errores.append("Debe especificar una categoría")
        if self.estado not in ['borrador', 'publicado', 'archivado']:
            errores.append("Estado inválido")
        return errores
    
    def __str__(self):
        return f"[{self.estado.upper()}] {self.titulo} ({self.visitas} visitas)"

class Comentario:
    def __init__(self, id_comentario=None, id_entrada=None, 
                 nombre_usuario="", comentario="", fecha_comentario=None):
        self.id_comentario = id_comentario
        self.id_entrada = id_entrada
        self.nombre_usuario = nombre_usuario
        self.comentario = comentario
        self.fecha_comentario = fecha_comentario or datetime.now()
    
    def validar(self):
        errores = []
        if not self.nombre_usuario or len(self.nombre_usuario) < 2:
            errores.append("Nombre de usuario debe tener al menos 2 caracteres")
        if not self.comentario or len(self.comentario) < 5:
            errores.append("Comentario debe tener al menos 5 caracteres")
        return errores
```

#### 3. Sistema CRUD completo

```python
# main.py - Programa principal
from database import Database
from modelos import Entrada, Autor, Comentario
import json
import csv
from datetime import datetime

class BlogManager:
    def __init__(self):
        self.db = Database()
    
    # ========== CREATE (Insertar) ==========
    
    def crear_entrada(self):
        """Crear nueva entrada interactivamente"""
        print("\n" + "="*60)
        print("CREAR NUEVA ENTRADA")
        print("="*60)
        
        # Mostrar autores disponibles
        self.listar_autores_simple()
        id_autor = self.pedir_numero("\nID del autor: ")
        
        # Mostrar categorías
        self.listar_categorias_simple()
        id_categoria = self.pedir_numero("ID de la categoría: ")
        
        # Pedir datos
        titulo = input("Título: ").strip()
        contenido = input("Contenido: ").strip()
        estado = input("Estado (borrador/publicado) [borrador]: ").strip() or "borrador"
        
        # Crear objeto y validar
        entrada = Entrada(
            id_autor=id_autor,
            id_categoria=id_categoria,
            titulo=titulo,
            contenido=contenido,
            estado=estado
        )
        
        errores = entrada.validar()
        if errores:
            print("\n✗ Errores de validación:")
            for error in errores:
                print(f"  • {error}")
            return
        
        # Insertar en BD
        query = """
            INSERT INTO entradas (id_autor, id_categoria, titulo, contenido, 
                                 fecha_publicacion, estado, visitas)
            VALUES (%s, %s, %s, %s, %s, %s, 0)
        """
        fecha = datetime.now().date() if estado == 'publicado' else None
        parametros = (id_autor, id_categoria, titulo, contenido, fecha, estado)
        
        if self.db.ejecutar_modificacion(query, parametros):
            id_nueva = self.db.obtener_ultimo_id()
            print(f"\n✓ Entrada creada con ID: {id_nueva}")
        else:
            print("\n✗ Error al crear entrada")
    
    # ========== READ (Listar/Buscar) ==========
    
    def listar_entradas(self, filtro_estado=None):
        """Listar entradas con formato de tabla"""
        print("\n" + "="*120)
        print("LISTADO DE ENTRADAS")
        print("="*120)
        
        query = """
            SELECT 
                e.id_entrada,
                e.titulo,
                a.nombre AS autor,
                c.nombre AS categoria,
                e.fecha_publicacion,
                e.visitas,
                e.estado,
                (SELECT COUNT(*) FROM comentarios 
                 WHERE id_entrada = e.id_entrada) AS num_comentarios
            FROM entradas e
            INNER JOIN autores a ON e.id_autor = a.id_autor
            INNER JOIN categorias c ON e.id_categoria = c.id_categoria
        """
        
        if filtro_estado:
            query += " WHERE e.estado = %s"
            resultados = self.db.ejecutar_query(query, (filtro_estado,))
        else:
            resultados = self.db.ejecutar_query(query)
        
        if not resultados:
            print("No hay entradas")
            return
        
        # Encabezado
        print(f"{'ID':<5} {'TÍTULO':<35} {'AUTOR':<20} {'CATEGORÍA':<15} "
              f"{'FECHA':<12} {'VISITAS':<8} {'COMENT.':<8} {'ESTADO':<10}")
        print("-" * 120)
        
        # Filas
        for entrada in resultados:
            fecha = entrada['fecha_publicacion'].strftime('%d/%m/%Y') if entrada['fecha_publicacion'] else 'Sin fecha'
            estado_color = {
                'publicado': '🟢',
                'borrador': '🟡',
                'archivado': '⚪'
            }.get(entrada['estado'], '')
            
            print(f"{entrada['id_entrada']:<5} "
                  f"{entrada['titulo'][:33]:<35} "
                  f"{entrada['autor'][:18]:<20} "
                  f"{entrada['categoria'][:13]:<15} "
                  f"{fecha:<12} "
                  f"{entrada['visitas']:<8} "
                  f"{entrada['num_comentarios']:<8} "
                  f"{estado_color} {entrada['estado']:<9}")
        
        print("-" * 120)
        print(f"Total: {len(resultados)} entradas")
    
    def buscar_entradas(self):
        """Buscar entradas por palabra clave"""
        keyword = input("\nPalabra clave (busca en título y contenido): ").strip()
        
        query = """
            SELECT e.id_entrada, e.titulo, a.nombre AS autor, e.visitas
            FROM entradas e
            INNER JOIN autores a ON e.id_autor = a.id_autor
            WHERE e.titulo LIKE %s OR e.contenido LIKE %s
            ORDER BY e.visitas DESC
        """
        
        patron = f"%{keyword}%"
        resultados = self.db.ejecutar_query(query, (patron, patron))
        
        if not resultados:
            print("No se encontraron resultados")
            return
        
        print(f"\nEncontradas {len(resultados)} entradas:")
        for r in resultados:
            print(f"  [{r['id_entrada']}] {r['titulo']} - {r['autor']} ({r['visitas']} visitas)")
    
    # ========== UPDATE (Actualizar) ==========
    
    def actualizar_entrada(self):
        """Actualizar entrada existente"""
        self.listar_entradas()
        id_entrada = self.pedir_numero("\nID de la entrada a actualizar: ")
        
        # Cargar datos actuales
        query = "SELECT * FROM entradas WHERE id_entrada = %s"
        resultado = self.db.ejecutar_query(query, (id_entrada,))
        
        if not resultado:
            print("✗ Entrada no encontrada")
            return
        
        entrada_actual = resultado[0]
        
        print("\nDeja en blanco para mantener el valor actual")
        nuevo_titulo = input(f"Título [{entrada_actual['titulo']}]: ").strip()
        nuevo_contenido = input(f"Contenido [{entrada_actual['contenido'][:30]}...]: ").strip()
        nuevo_estado = input(f"Estado [{entrada_actual['estado']}]: ").strip()
        
        # Usar valores actuales si no se ingresó nada
        titulo_final = nuevo_titulo or entrada_actual['titulo']
        contenido_final = nuevo_contenido or entrada_actual['contenido']
        estado_final = nuevo_estado or entrada_actual['estado']
        
        # Actualizar fecha si se publica
        fecha_pub = datetime.now().date() if estado_final == 'publicado' and entrada_actual['estado'] != 'publicado' else entrada_actual['fecha_publicacion']
        
        query = """
            UPDATE entradas 
            SET titulo = %s, contenido = %s, estado = %s, fecha_publicacion = %s
            WHERE id_entrada = %s
        """
        
        if self.db.ejecutar_modificacion(query, (titulo_final, contenido_final, 
                                                   estado_final, fecha_pub, id_entrada)):
            print("\n✓ Entrada actualizada")
        else:
            print("\n✗ Error al actualizar")
    
    def incrementar_visitas(self, id_entrada):
        """Incrementar contador de visitas"""
        query = "UPDATE entradas SET visitas = visitas + 1 WHERE id_entrada = %s"
        self.db.ejecutar_modificacion(query, (id_entrada,))
    
    # ========== DELETE (Eliminar) ==========
    
    def eliminar_entrada(self):
        """Eliminar entrada con confirmación"""
        self.listar_entradas()
        id_entrada = self.pedir_numero("\nID de la entrada a eliminar: ")
        
        # Mostrar detalles antes de borrar
        query = """
            SELECT e.titulo, a.nombre AS autor,
                   (SELECT COUNT(*) FROM comentarios WHERE id_entrada = e.id_entrada) AS comentarios
            FROM entradas e
            INNER JOIN autores a ON e.id_autor = a.id_autor
            WHERE e.id_entrada = %s
        """
        resultado = self.db.ejecutar_query(query, (id_entrada,))
        
        if not resultado:
            print("✗ Entrada no encontrada")
            return
        
        entrada = resultado[0]
        print(f"\n⚠️  ¿Eliminar '{entrada['titulo']}' de {entrada['autor']}?")
        print(f"    Esto también eliminará {entrada['comentarios']} comentarios")
        
        confirmacion = input("    Escribe 'CONFIRMAR' para eliminar: ").strip()
        
        if confirmacion == 'CONFIRMAR':
            query = "DELETE FROM entradas WHERE id_entrada = %s"
            if self.db.ejecutar_modificacion(query, (id_entrada,)):
                print("\n✓ Entrada eliminada")
            else:
                print("\n✗ Error al eliminar")
        else:
            print("\n✗ Eliminación cancelada")
    
    # ========== EXPORTACIÓN ==========
    
    def exportar_json(self):
        """Exportar todas las entradas a JSON"""
        query = """
            SELECT 
                e.id_entrada, e.titulo, e.contenido,
                a.nombre AS autor, a.email AS email_autor,
                c.nombre AS categoria,
                e.fecha_publicacion, e.visitas, e.estado
            FROM entradas e
            INNER JOIN autores a ON e.id_autor = a.id_autor
            INNER JOIN categorias c ON e.id_categoria = c.id_categoria
            WHERE e.estado = 'publicado'
            ORDER BY e.fecha_publicacion DESC
        """
        
        resultados = self.db.ejecutar_query(query)
        
        # Convertir date a string para JSON
        for r in resultados:
            if r['fecha_publicacion']:
                r['fecha_publicacion'] = r['fecha_publicacion'].strftime('%Y-%m-%d')
        
        filename = f"blog_export_{datetime.now().strftime('%Y%m%d_%H%M%S')}.json"
        with open(filename, 'w', encoding='utf-8') as f:
            json.dump(resultados, f, indent=4, ensure_ascii=False)
        
        print(f"\n✓ {len(resultados)} entradas exportadas a {filename}")
    
    def exportar_csv(self):
        """Exportar a CSV para Excel"""
        query = """
            SELECT 
                e.titulo, a.nombre AS autor, c.nombre AS categoria,
                e.fecha_publicacion, e.visitas, e.estado
            FROM entradas e
            INNER JOIN autores a ON e.id_autor = a.id_autor
            INNER JOIN categorias c ON e.id_categoria = c.id_categoria
        """
        
        resultados = self.db.ejecutar_query(query)
        
        filename = f"blog_export_{datetime.now().strftime('%Y%m%d_%H%M%S')}.csv"
        with open(filename, 'w', newline='', encoding='utf-8-sig') as f:  # BOM para Excel
            if resultados:
                writer = csv.DictWriter(f, fieldnames=resultados[0].keys())
                writer.writeheader()
                for row in resultados:
                    if row['fecha_publicacion']:
                        row['fecha_publicacion'] = row['fecha_publicacion'].strftime('%d/%m/%Y')
                    writer.writerow(row)
        
        print(f"\n✓ {len(resultados)} entradas exportadas a {filename}")
    
    # ========== ESTADÍSTICAS ==========
    
    def mostrar_estadisticas(self):
        """Dashboard de estadísticas"""
        print("\n" + "="*70)
        print("📊 ESTADÍSTICAS DEL BLOG")
        print("="*70)
        
        # Total entradas por estado
        query = """
            SELECT estado, COUNT(*) as total, SUM(visitas) as visitas_total
            FROM entradas
            GROUP BY estado
        """
        estados = self.db.ejecutar_query(query)
        
        print("\n📝 Entradas por estado:")
        for e in estados:
            print(f"  {e['estado'].capitalize()}: {e['total']} entradas, {e['visitas_total'] or 0} visitas")
        
        # Top 5 entradas más visitadas
        query = """
            SELECT e.titulo, a.nombre AS autor, e.visitas
            FROM entradas e
            INNER JOIN autores a ON e.id_autor = a.id_autor
            WHERE e.estado = 'publicado'
            ORDER BY e.visitas DESC
            LIMIT 5
        """
        top_entradas = self.db.ejecutar_query(query)
        
        print("\n🏆 Top 5 entradas más visitadas:")
        for i, e in enumerate(top_entradas, 1):
            print(f"  {i}. {e['titulo']} - {e['autor']} ({e['visitas']} visitas)")
        
        # Autores más activos
        query = """
            SELECT a.nombre, COUNT(e.id_entrada) as entradas, SUM(e.visitas) as visitas_total
            FROM autores a
            LEFT JOIN entradas e ON a.id_autor = e.id_autor AND e.estado = 'publicado'
            GROUP BY a.id_autor, a.nombre
            ORDER BY entradas DESC
        """
        autores = self.db.ejecutar_query(query)
        
        print("\n✍️ Ranking de autores:")
        for i, a in enumerate(autores, 1):
            print(f"  {i}. {a['nombre']}: {a['entradas'] or 0} entradas, {a['visitas_total'] or 0} visitas")
    
    # ========== UTILIDADES ==========
    
    def listar_autores_simple(self):
        """Listar autores para selección"""
        query = "SELECT id_autor, nombre, email FROM autores"
        autores = self.db.ejecutar_query(query)
        print("\nAutores disponibles:")
        for a in autores:
            print(f"  [{a['id_autor']}] {a['nombre']} ({a['email']})")
    
    def listar_categorias_simple(self):
        """Listar categorías para selección"""
        query = "SELECT id_categoria, nombre FROM categorias"
        categorias = self.db.ejecutar_query(query)
        print("\nCategorías disponibles:")
        for c in categorias:
            print(f"  [{c['id_categoria']}] {c['nombre']}")
    
    def pedir_numero(self, mensaje):
        """Pedir input numérico con validación"""
        while True:
            try:
                return int(input(mensaje))
            except ValueError:
                print("✗ Debe ingresar un número")
    
    # ========== MENÚ PRINCIPAL ==========
    
    def menu_principal(self):
        """Menú interactivo"""
        while True:
            print("\n" + "="*70)
            print("🗂️  SISTEMA DE GESTIÓN DE BLOG - MENÚ PRINCIPAL")
            print("="*70)
            print("1. 📋 Listar todas las entradas")
            print("2. 🔍 Buscar entradas")
            print("3. ➕ Crear nueva entrada")
            print("4. ✏️  Actualizar entrada")
            print("5. 🗑️  Eliminar entrada")
            print("6. 📊 Ver estadísticas")
            print("7. 💾 Exportar a JSON")
            print("8. 📄 Exportar a CSV")
            print("9. 🟢 Listar solo publicadas")
            print("0. 🚪 Salir")
            print("="*70)
            
            opcion = input("\nSelecciona una opción: ").strip()
            
            try:
                if opcion == "1":
                    self.listar_entradas()
                elif opcion == "2":
                    self.buscar_entradas()
                elif opcion == "3":
                    self.crear_entrada()
                elif opcion == "4":
                    self.actualizar_entrada()
                elif opcion == "5":
                    self.eliminar_entrada()
                elif opcion == "6":
                    self.mostrar_estadisticas()
                elif opcion == "7":
                    self.exportar_json()
                elif opcion == "8":
                    self.exportar_csv()
                elif opcion == "9":
                    self.listar_entradas(filtro_estado='publicado')
                elif opcion == "0":
                    print("\n👋 ¡Hasta luego!")
                    self.db.cerrar()
                    break
                else:
                    print("\n✗ Opción no válida")
            except Exception as e:
                print(f"\n✗ Error: {e}")
            
            input("\nPresiona ENTER para continuar...")

# Ejecutar aplicación
if __name__ == "__main__":
    app = BlogManager()
    app.menu_principal()
```

**Conceptos clave del simulacro completo:**
- ✅ **POO**: Clases Database, BlogManager, Entrada, Autor con métodos
- ✅ **Validación**: Método validar() en cada clase antes de insertar
- ✅ **CRUD completo**: Create, Read, Update, Delete con confirmaciones
- ✅ **SQL parametrizado**: %s para evitar SQL injection
- ✅ **Transacciones**: commit() y rollback() para integridad
- ✅ **Formateo**: Tablas alineadas con f-strings y padding
- ✅ **Exportación**: JSON con ensure_ascii=False, CSV con encoding BOM para Excel
- ✅ **Manejo de fechas**: datetime, strftime para formatear
- ✅ **Cursor dictionary**: Resultados como diccionarios en lugar de tuplas
- ✅ **Try/except**: Captura de errores de conexión y SQL
- ✅ **Funciones helper**: pedir_numero(), listar_simple() para reutilizar código
- ✅ **Menú interactivo**: while True con opciones numeradas
- ✅ **Estadísticas**: Agregaciones con COUNT(), SUM(), GROUP BY

**Aplicación práctica:**
- Sistema de inventario para piezas 3D
- CRUD de proyectos Raspberry Pi
- Gestión de filamentos y consumibles
- Dashboard de impresiones con estadísticas

### Proyecto Intermodular - Aplicación Web Blog con Flask

**Escenario completo**: Crear una aplicación web completa con Flask integrando bases de datos, formularios, autenticación y diseño moderno.

#### Estructura del proyecto web

```
blog_web/
│
├── app.py                    # Aplicación Flask principal
├── config.py                 # Configuración
├── requirements.txt          # Dependencias
│
├── templates/                # Plantillas HTML
│   ├── base.html            # Layout base
│   ├── index.html           # Página principal
│   ├── entrada.html         # Detalle de entrada
│   ├── crear.html           # Formulario nueva entrada
│   └── estadisticas.html    # Dashboard
│
├── static/                   # Archivos estáticos
│   ├── css/
│   │   └── style.css        # Estilos CSS
│   └── js/
│       └── main.js          # JavaScript
│
└── database.py              # Conexión BD
```

#### 1. Aplicación Flask principal (app.py)

```python
from flask import Flask, render_template, request, redirect, url_for, flash, jsonify
import mysql.connector
from datetime import datetime

app = Flask(__name__)
app.secret_key = 'tu_clave_secreta_aqui_2025'  # Para flash messages

# Configuración base de datos
DB_CONFIG = {
    'host': 'localhost',
    'user': 'blog_app',
    'password': 'App_2025!',
    'database': 'blog2526'
}

def get_db():
    """Obtener conexión a BD"""
    return mysql.connector.connect(**DB_CONFIG)

# ========== RUTAS PRINCIPALES ==========

@app.route('/')
def index():
    """Página principal - Listado de entradas"""
    db = get_db()
    cursor = db.cursor(dictionary=True)
    
    cursor.execute("""
        SELECT 
            e.id_entrada,
            e.titulo,
            e.contenido,
            a.nombre AS autor,
            c.nombre AS categoria,
            DATE_FORMAT(e.fecha_publicacion, '%d/%m/%Y') as fecha,
            e.visitas,
            (SELECT COUNT(*) FROM comentarios 
             WHERE id_entrada = e.id_entrada) as comentarios
        FROM entradas e
        INNER JOIN autores a ON e.id_autor = a.id_autor
        INNER JOIN categorias c ON e.id_categoria = c.id_categoria
        WHERE e.estado = 'publicado'
        ORDER BY e.fecha_publicacion DESC
        LIMIT 10
    """)
    
    entradas = cursor.fetchall()
    
    # Estadísticas generales
    cursor.execute("""
        SELECT 
            COUNT(*) as total_entradas,
            SUM(visitas) as total_visitas,
            (SELECT COUNT(*) FROM autores) as total_autores
        FROM entradas WHERE estado = 'publicado'
    """)
    stats = cursor.fetchone()
    
    db.close()
    
    return render_template('index.html', 
                          entradas=entradas, 
                          stats=stats)

@app.route('/entrada/<int:id>')
def ver_entrada(id):
    """Ver detalle de entrada"""
    db = get_db()
    cursor = db.cursor(dictionary=True)
    
    # Incrementar visitas
    cursor.execute("UPDATE entradas SET visitas = visitas + 1 WHERE id_entrada = %s", (id,))
    db.commit()
    
    # Obtener entrada
    cursor.execute("""
        SELECT 
            e.id_entrada,
            e.titulo,
            e.contenido,
            a.nombre AS autor,
            a.biografia AS autor_bio,
            c.nombre AS categoria,
            DATE_FORMAT(e.fecha_publicacion, '%d/%m/%Y a las %H:%i') as fecha,
            e.visitas
        FROM entradas e
        INNER JOIN autores a ON e.id_autor = a.id_autor
        INNER JOIN categorias c ON e.id_categoria = c.id_categoria
        WHERE e.id_entrada = %s AND e.estado = 'publicado'
    """, (id,))
    
    entrada = cursor.fetchone()
    
    if not entrada:
        flash('Entrada no encontrada', 'error')
        return redirect(url_for('index'))
    
    # Obtener comentarios
    cursor.execute("""
        SELECT 
            nombre_usuario,
            comentario,
            DATE_FORMAT(fecha_comentario, '%d/%m/%Y %H:%i') as fecha
        FROM comentarios
        WHERE id_entrada = %s
        ORDER BY fecha_comentario DESC
    """, (id,))
    
    comentarios = cursor.fetchall()
    
    # Entradas relacionadas (misma categoría)
    cursor.execute("""
        SELECT id_entrada, titulo, visitas
        FROM entradas
        WHERE id_categoria = (SELECT id_categoria FROM entradas WHERE id_entrada = %s)
          AND id_entrada != %s
          AND estado = 'publicado'
        ORDER BY visitas DESC
        LIMIT 3
    """, (id, id))
    
    relacionadas = cursor.fetchall()
    
    db.close()
    
    return render_template('entrada.html', 
                          entrada=entrada, 
                          comentarios=comentarios,
                          relacionadas=relacionadas)

@app.route('/categoria/<nombre>')
def por_categoria(nombre):
    """Filtrar entradas por categoría"""
    db = get_db()
    cursor = db.cursor(dictionary=True)
    
    cursor.execute("""
        SELECT 
            e.id_entrada,
            e.titulo,
            e.contenido,
            a.nombre AS autor,
            DATE_FORMAT(e.fecha_publicacion, '%d/%m/%Y') as fecha,
            e.visitas
        FROM entradas e
        INNER JOIN autores a ON e.id_autor = a.id_autor
        INNER JOIN categorias c ON e.id_categoria = c.id_categoria
        WHERE c.nombre = %s AND e.estado = 'publicado'
        ORDER BY e.fecha_publicacion DESC
    """, (nombre,))
    
    entradas = cursor.fetchall()
    db.close()
    
    return render_template('categoria.html', 
                          categoria=nombre, 
                          entradas=entradas)

# ========== CREAR/EDITAR ENTRADAS ==========

@app.route('/crear', methods=['GET', 'POST'])
def crear_entrada():
    """Formulario para crear entrada"""
    db = get_db()
    cursor = db.cursor(dictionary=True)
    
    if request.method == 'POST':
        # Obtener datos del formulario
        titulo = request.form.get('titulo')
        contenido = request.form.get('contenido')
        id_autor = request.form.get('id_autor')
        id_categoria = request.form.get('id_categoria')
        estado = request.form.get('estado', 'borrador')
        
        # Validaciones
        errores = []
        if not titulo or len(titulo) < 5:
            errores.append('El título debe tener al menos 5 caracteres')
        if not contenido or len(contenido) < 20:
            errores.append('El contenido debe tener al menos 20 caracteres')
        if not id_autor:
            errores.append('Debe seleccionar un autor')
        if not id_categoria:
            errores.append('Debe seleccionar una categoría')
        
        if errores:
            for error in errores:
                flash(error, 'error')
        else:
            # Insertar en BD
            fecha = datetime.now().date() if estado == 'publicado' else None
            
            cursor.execute("""
                INSERT INTO entradas 
                (id_autor, id_categoria, titulo, contenido, 
                 fecha_publicacion, estado, visitas)
                VALUES (%s, %s, %s, %s, %s, %s, 0)
            """, (id_autor, id_categoria, titulo, contenido, fecha, estado))
            
            db.commit()
            flash('Entrada creada correctamente', 'success')
            
            nuevo_id = cursor.lastrowid
            db.close()
            return redirect(url_for('ver_entrada', id=nuevo_id))
    
    # GET: Mostrar formulario
    cursor.execute("SELECT id_autor, nombre FROM autores")
    autores = cursor.fetchall()
    
    cursor.execute("SELECT id_categoria, nombre FROM categorias")
    categorias = cursor.fetchall()
    
    db.close()
    
    return render_template('crear.html', 
                          autores=autores, 
                          categorias=categorias)

# ========== COMENTARIOS ==========

@app.route('/comentar/<int:id_entrada>', methods=['POST'])
def agregar_comentario(id_entrada):
    """Añadir comentario a entrada"""
    nombre = request.form.get('nombre')
    comentario = request.form.get('comentario')
    
    if not nombre or not comentario:
        flash('Todos los campos son obligatorios', 'error')
        return redirect(url_for('ver_entrada', id=id_entrada))
    
    if len(comentario) < 5:
        flash('El comentario debe tener al menos 5 caracteres', 'error')
        return redirect(url_for('ver_entrada', id=id_entrada))
    
    db = get_db()
    cursor = db.cursor()
    
    cursor.execute("""
        INSERT INTO comentarios 
        (id_entrada, nombre_usuario, comentario, fecha_comentario)
        VALUES (%s, %s, %s, NOW())
    """, (id_entrada, nombre, comentario))
    
    db.commit()
    db.close()
    
    flash('Comentario añadido', 'success')
    return redirect(url_for('ver_entrada', id=id_entrada))

# ========== BÚSQUEDA ==========

@app.route('/buscar')
def buscar():
    """Buscar entradas"""
    query = request.args.get('q', '')
    
    if not query:
        return redirect(url_for('index'))
    
    db = get_db()
    cursor = db.cursor(dictionary=True)
    
    cursor.execute("""
        SELECT 
            e.id_entrada,
            e.titulo,
            a.nombre AS autor,
            DATE_FORMAT(e.fecha_publicacion, '%d/%m/%Y') as fecha,
            e.visitas
        FROM entradas e
        INNER JOIN autores a ON e.id_autor = a.id_autor
        WHERE (e.titulo LIKE %s OR e.contenido LIKE %s)
          AND e.estado = 'publicado'
        ORDER BY e.visitas DESC
    """, (f'%{query}%', f'%{query}%'))
    
    resultados = cursor.fetchall()
    db.close()
    
    return render_template('buscar.html', 
                          query=query, 
                          resultados=resultados)

# ========== API JSON ==========

@app.route('/api/entradas')
def api_entradas():
    """API JSON de entradas"""
    db = get_db()
    cursor = db.cursor(dictionary=True)
    
    cursor.execute("""
        SELECT 
            e.id_entrada,
            e.titulo,
            a.nombre AS autor,
            c.nombre AS categoria,
            e.fecha_publicacion,
            e.visitas
        FROM entradas e
        INNER JOIN autores a ON e.id_autor = a.id_autor
        INNER JOIN categorias c ON e.id_categoria = c.id_categoria
        WHERE e.estado = 'publicado'
        ORDER BY e.fecha_publicacion DESC
    """)
    
    entradas = cursor.fetchall()
    db.close()
    
    # Convertir fechas a string
    for e in entradas:
        if e['fecha_publicacion']:
            e['fecha_publicacion'] = e['fecha_publicacion'].strftime('%Y-%m-%d')
    
    return jsonify(entradas)

@app.route('/api/estadisticas')
def api_estadisticas():
    """API de estadísticas para gráficos"""
    db = get_db()
    cursor = db.cursor(dictionary=True)
    
    # Entradas por categoría
    cursor.execute("""
        SELECT c.nombre, COUNT(e.id_entrada) as total
        FROM categorias c
        LEFT JOIN entradas e ON c.id_categoria = e.id_categoria 
            AND e.estado = 'publicado'
        GROUP BY c.id_categoria, c.nombre
    """)
    por_categoria = cursor.fetchall()
    
    # Entradas por mes
    cursor.execute("""
        SELECT 
            DATE_FORMAT(fecha_publicacion, '%Y-%m') as mes,
            COUNT(*) as total
        FROM entradas
        WHERE estado = 'publicado' 
          AND fecha_publicacion >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
        GROUP BY mes
        ORDER BY mes
    """)
    por_mes = cursor.fetchall()
    
    db.close()
    
    return jsonify({
        'por_categoria': por_categoria,
        'por_mes': por_mes
    })

# ========== MANEJO DE ERRORES ==========

@app.errorhandler(404)
def not_found(error):
    return render_template('404.html'), 404

@app.errorhandler(500)
def server_error(error):
    return render_template('500.html'), 500

# ========== FILTROS JINJA PERSONALIZADOS ==========

@app.template_filter('truncar')
def truncar_texto(texto, longitud=100):
    """Truncar texto con elipsis"""
    if len(texto) <= longitud:
        return texto
    return texto[:longitud] + '...'

@app.template_filter('fecha_relativa')
def fecha_relativa(fecha):
    """Mostrar 'hace X días'"""
    if isinstance(fecha, str):
        return fecha
    
    ahora = datetime.now().date()
    diferencia = (ahora - fecha).days
    
    if diferencia == 0:
        return 'Hoy'
    elif diferencia == 1:
        return 'Ayer'
    elif diferencia < 7:
        return f'Hace {diferencia} días'
    elif diferencia < 30:
        return f'Hace {diferencia // 7} semanas'
    else:
        return fecha.strftime('%d/%m/%Y')

# Ejecutar servidor
if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=5000)
```

#### 2. Template base (templates/base.html)

```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{% block title %}Blog DAM 2526{% endblock %}</title>
    <link rel="stylesheet" href="{{ url_for('static', filename='css/style.css') }}">
</head>
<body>
    <!-- Navegación -->
    <nav class="navbar">
        <div class="container">
            <a href="{{ url_for('index') }}" class="logo">
                📝 Blog DAM
            </a>
            
            <form action="{{ url_for('buscar') }}" method="get" class="search-form">
                <input type="text" name="q" placeholder="Buscar..." required>
                <button type="submit">🔍</button>
            </form>
            
            <ul class="nav-links">
                <li><a href="{{ url_for('index') }}">Inicio</a></li>
                <li><a href="{{ url_for('crear_entrada') }}">Crear entrada</a></li>
                <li><a href="/estadisticas">Estadísticas</a></li>
            </ul>
        </div>
    </nav>
    
    <!-- Mensajes flash -->
    {% with messages = get_flashed_messages(with_categories=true) %}
        {% if messages %}
            <div class="container">
                {% for category, message in messages %}
                    <div class="alert alert-{{ category }}">
                        {{ message }}
                        <button onclick="this.parentElement.remove()">✕</button>
                    </div>
                {% endfor %}
            </div>
        {% endif %}
    {% endwith %}
    
    <!-- Contenido principal -->
    <main>
        {% block content %}{% endblock %}
    </main>
    
    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 Blog DAM 2526 - Proyecto Intermodular</p>
            <p>
                <a href="/api/entradas">API JSON</a> | 
                <a href="/api/estadisticas">Estadísticas API</a>
            </p>
        </div>
    </footer>
    
    <script src="{{ url_for('static', filename='js/main.js') }}"></script>
    {% block scripts %}{% endblock %}
</body>
</html>
```

#### 3. Página principal (templates/index.html)

```html
{% extends "base.html" %}

{% block content %}
<div class="hero">
    <div class="container">
        <h1>📚 Blog de Desarrollo y Maker</h1>
        <p class="subtitle">Tutoriales, proyectos y experiencias con Python, Raspberry Pi e impresión 3D</p>
        
        <div class="stats-cards">
            <div class="stat-card">
                <span class="stat-number">{{ stats.total_entradas }}</span>
                <span class="stat-label">Entradas</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ stats.total_visitas }}</span>
                <span class="stat-label">Visitas</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ stats.total_autores }}</span>
                <span class="stat-label">Autores</span>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="entradas-grid">
        {% for entrada in entradas %}
        <article class="entrada-card">
            <div class="entrada-header">
                <span class="categoria-badge">{{ entrada.categoria }}</span>
                <span class="fecha">{{ entrada.fecha }}</span>
            </div>
            
            <h2>
                <a href="{{ url_for('ver_entrada', id=entrada.id_entrada) }}">
                    {{ entrada.titulo }}
                </a>
            </h2>
            
            <p class="excerpt">
                {{ entrada.contenido | truncar(150) }}
            </p>
            
            <div class="entrada-footer">
                <span class="autor">✍️ {{ entrada.autor }}</span>
                <span class="stats">
                    👁️ {{ entrada.visitas }} | 
                    💬 {{ entrada.comentarios }}
                </span>
            </div>
            
            <a href="{{ url_for('ver_entrada', id=entrada.id_entrada) }}" 
               class="btn btn-primary">
                Leer más →
            </a>
        </article>
        {% endfor %}
    </div>
    
    {% if entradas|length == 0 %}
    <div class="empty-state">
        <p>No hay entradas publicadas todavía</p>
        <a href="{{ url_for('crear_entrada') }}" class="btn btn-primary">
            Crear la primera entrada
        </a>
    </div>
    {% endif %}
</div>
{% endblock %}
```

#### 4. CSS moderno (static/css/style.css) - Fragmento clave

```css
/* Variables CSS */
:root {
    --primary: #667eea;
    --primary-dark: #5568d3;
    --secondary: #764ba2;
    --success: #48bb78;
    --error: #f56565;
    --bg: #f7fafc;
    --text: #2d3748;
    --text-light: #718096;
    --border: #e2e8f0;
    --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Navbar */
.navbar {
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    color: white;
    padding: 1rem 0;
    box-shadow: var(--shadow);
}

.navbar .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

/* Hero section */
.hero {
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    color: white;
    padding: 4rem 0;
    text-align: center;
}

.stats-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1.5rem;
    margin-top: 2rem;
}

.stat-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    padding: 1.5rem;
    border-radius: 10px;
    display: flex;
    flex-direction: column;
}

/* Grid de entradas */
.entradas-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2rem;
    margin: 2rem 0;
}

.entrada-card {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: var(--shadow);
    transition: transform 0.3s, box-shadow 0.3s;
}

.entrada-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}

/* Responsive */
@media (max-width: 768px) {
    .entradas-grid {
        grid-template-columns: 1fr;
    }
    
    .navbar .container {
        flex-direction: column;
    }
}
```

**Conceptos clave del simulacro completo:**
- ✅ **Flask**: @app.route, render_template, request, redirect, url_for
- ✅ **Jinja2**: {% extends %}, {% block %}, {% for %}, {{ variable }}
- ✅ **Flash messages**: Mensajes temporales con categorías
- ✅ **Formularios**: POST con validación, CSRF protection
- ✅ **API REST**: Endpoints JSON con jsonify()
- ✅ **Filtros custom**: @app.template_filter para funciones en templates
- ✅ **Manejo de errores**: @app.errorhandler(404), (500)
- ✅ **CSS Grid**: Layout responsive de cards
- ✅ **Gradient backgrounds**: linear-gradient() para diseño moderno
- ✅ **Box-shadow**: Profundidad y hover effects
- ✅ **Backdrop-filter**: Efecto glassmorphism
- ✅ **Variables CSS**: :root para colores centralizados

**Aplicación práctica con Raspberry Pi:**
- Blog alojado en Raspberry Pi como servidor
- Dashboard de proyectos 3D con fotos
- API para app móvil de control
- Sistema de documentación técnica

### Lenguajes de Marcas - Curriculum y Portafolio Profesional

**Escenario completo**: Crear un curriculum vitae y portafolio web responsive con tecnologías modernas.

#### Proyecto 1: Curriculum Vitae con CSS Grid

**Características:**
- Layout de dos columnas con CSS Grid
- Sidebar oscuro con información de contacto
- Barra de progreso para habilidades
- Responsive (móvil → una columna)
- Gradientes y sombras para diseño moderno

```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum - Darío García</title>
    <style>
        /* ========== RESET Y VARIABLES ========== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        :root {
            --primary: #3498db;
            --dark: #2c3e50;
            --dark-light: #34495e;
            --light: #ecf0f1;
            --text: #2c3e50;
            --text-light: #7f8c8d;
            --accent: #e74c3c;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--light);
            padding: 2rem;
            line-height: 1.6;
        }
        
        /* ========== LAYOUT PRINCIPAL CON GRID ========== */
        main {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 320px 1fr;  /* Sidebar fijo + contenido flexible */
            gap: 0;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        
        /* ========== SIDEBAR IZQUIERDO ========== */
        #izquierda {
            background: linear-gradient(180deg, var(--dark), var(--dark-light));
            color: white;
            padding: 2.5rem 2rem;
        }
        
        .foto {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            display: block;
            border: 5px solid white;
            object-fit: cover;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        
        h1 {
            text-align: center;
            margin-bottom: 0.5rem;
            font-size: 1.9rem;
            letter-spacing: 1px;
        }
        
        .subtitulo {
            text-align: center;
            color: #bdc3c7;
            margin-bottom: 2.5rem;
            font-size: 1.1rem;
            font-weight: 300;
        }
        
        #izquierda .seccion {
            margin-bottom: 2.5rem;
        }
        
        #izquierda h2 {
            color: white;
            border-bottom: 2px solid var(--primary);
            padding-bottom: 0.6rem;
            margin-bottom: 1.2rem;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        #izquierda ul {
            list-style: none;
        }
        
        #izquierda li {
            padding: 0.7rem 0;
            padding-left: 1.8rem;
            position: relative;
            font-size: 0.95rem;
        }
        
        #izquierda li:before {
            content: "▸";
            position: absolute;
            left: 0;
            color: var(--primary);
            font-size: 1.2rem;
        }
        
        /* ========== BARRAS DE PROGRESO ========== */
        .habilidad-item {
            margin-bottom: 1.5rem;
        }
        
        .habilidad-nombre {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        
        .progress {
            background: rgba(255, 255, 255, 0.2);
            height: 12px;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }
        
        .progress-bar {
            background: linear-gradient(90deg, var(--primary), #5dade2);
            height: 100%;
            border-radius: 10px;
            transition: width 1s ease-in-out;
            position: relative;
            overflow: hidden;
        }
        
        /* Animación de brillo */
        .progress-bar::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.3),
                transparent
            );
            animation: shine 2s infinite;
        }
        
        @keyframes shine {
            to { left: 100%; }
        }
        
        /* Enlaces de contacto */
        #izquierda a {
            color: var(--primary);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        #izquierda a:hover {
            color: #5dade2;
            text-decoration: underline;
        }
        
        /* ========== CONTENIDO DERECHO ========== */
        #derecha {
            padding: 3rem 2.5rem;
        }
        
        #derecha .seccion {
            margin-bottom: 3rem;
        }
        
        #derecha h2 {
            color: var(--primary);
            border-bottom: 3px solid var(--primary);
            padding-bottom: 0.6rem;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        
        /* ========== EXPERIENCIA/FORMACIÓN ========== */
        .experiencia, .formacion {
            margin-bottom: 2rem;
            padding-left: 1.5rem;
            border-left: 3px solid var(--primary);
            position: relative;
        }
        
        .experiencia::before, .formacion::before {
            content: '●';
            position: absolute;
            left: -0.55rem;
            top: 0;
            color: var(--primary);
            font-size: 1.5rem;
            background: white;
        }
        
        .experiencia h3, .formacion h3 {
            color: var(--text);
            margin-bottom: 0.4rem;
            font-size: 1.3rem;
        }
        
        .fecha {
            color: var(--text-light);
            font-style: italic;
            font-size: 0.9rem;
            margin-bottom: 0.8rem;
            display: inline-block;
        }
        
        .empresa {
            color: var(--primary);
            font-weight: 600;
        }
        
        .experiencia ul, .formacion ul {
            list-style: none;
            margin-top: 0.8rem;
        }
        
        .experiencia li, .formacion li {
            padding: 0.4rem 0 0.4rem 1.5rem;
            position: relative;
        }
        
        .experiencia li:before, .formacion li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: var(--primary);
            font-weight: bold;
        }
        
        /* ========== RESUMEN ========== */
        #derecha .resumen {
            font-size: 1.05rem;
            color: var(--text);
            background: var(--light);
            padding: 1.5rem;
            border-radius: 10px;
            border-left: 4px solid var(--primary);
            line-height: 1.8;
        }
        
        /* ========== PROYECTOS DESTACADOS ========== */
        .proyecto-card {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--accent);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .proyecto-card:hover {
            transform: translateX(10px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .proyecto-card h3 {
            color: var(--text);
            margin-bottom: 0.8rem;
            font-size: 1.2rem;
        }
        
        .tecnologias {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        
        .tech-tag {
            background: var(--primary);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        /* ========== RESPONSIVE ========== */
        @media (max-width: 992px) {
            main {
                grid-template-columns: 1fr;  /* Una columna en móvil */
            }
            
            body {
                padding: 1rem;
            }
            
            #izquierda {
                border-radius: 15px 15px 0 0;
            }
            
            #derecha {
                padding: 2rem 1.5rem;
            }
        }
        
        @media print {
            body {
                padding: 0;
            }
            
            main {
                box-shadow: none;
            }
            
            .progress-bar::before {
                animation: none;
            }
        }
    </style>
</head>
<body>
    <main>
        <!-- ========== SIDEBAR IZQUIERDO ========== -->
        <section id="izquierda">
            <img src="https://via.placeholder.com/160" alt="Foto perfil" class="foto">
            <h1>Darío García</h1>
            <p class="subtitulo">Desarrollador Full Stack</p>
            
            <article class="seccion">
                <h2>📞 Contacto</h2>
                <ul>
                    <li>📧 dario.garcia@email.com</li>
                    <li>📱 +34 612 345 678</li>
                    <li>🌐 <a href="https://github.com/dariodev" target="_blank">github.com/dariodev</a></li>
                    <li>💼 <a href="https://linkedin.com/in/dariodev" target="_blank">LinkedIn</a></li>
                    <li>📍 Madrid, España</li>
                </ul>
            </article>
            
            <article class="seccion">
                <h2>🌍 Idiomas</h2>
                <div class="habilidad-item">
                    <div class="habilidad-nombre">
                        <span>Español</span>
                        <span>Nativo</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                </div>
                
                <div class="habilidad-item">
                    <div class="habilidad-nombre">
                        <span>Inglés</span>
                        <span>B2</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width: 75%"></div>
                    </div>
                </div>
                
                <div class="habilidad-item">
                    <div class="habilidad-nombre">
                        <span>Francés</span>
                        <span>A2</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width: 35%"></div>
                    </div>
                </div>
            </article>
            
            <article class="seccion">
                <h2>💻 Habilidades Técnicas</h2>
                <div class="habilidad-item">
                    <div class="habilidad-nombre">
                        <span>Python</span>
                        <span>90%</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width: 90%"></div>
                    </div>
                </div>
                
                <div class="habilidad-item">
                    <div class="habilidad-nombre">
                        <span>JavaScript</span>
                        <span>80%</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width: 80%"></div>
                    </div>
                </div>
                
                <div class="habilidad-item">
                    <div class="habilidad-nombre">
                        <span>SQL / MySQL</span>
                        <span>85%</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width: 85%"></div>
                    </div>
                </div>
                
                <div class="habilidad-item">
                    <div class="habilidad-nombre">
                        <span>HTML/CSS</span>
                        <span>95%</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width: 95%"></div>
                    </div>
                </div>
                
                <div class="habilidad-item">
                    <div class="habilidad-nombre">
                        <span>Flask / Django</span>
                        <span>75%</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width: 75%"></div>
                    </div>
                </div>
                
                <div class="habilidad-item">
                    <div class="habilidad-nombre">
                        <span>Git / GitHub</span>
                        <span>80%</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width: 80%"></div>
                    </div>
                </div>
            </article>
            
            <article class="seccion">
                <h2>🎯 Intereses</h2>
                <ul>
                    <li>Impresión 3D y diseño</li>
                    <li>Raspberry Pi y IoT</li>
                    <li>Automatización con Python</li>
                    <li>Desarrollo web moderno</li>
                    <li>Open source y comunidad</li>
                </ul>
            </article>
        </section>
        
        <!-- ========== CONTENIDO DERECHO ========== -->
        <section id="derecha">
            <article class="seccion">
                <h2>👤 Resumen Profesional</h2>
                <p class="resumen">
                    Desarrollador full stack apasionado por Python y tecnologías web modernas. 
                    Experiencia creando aplicaciones con Flask, gestión de bases de datos MySQL 
                    y diseño responsive. Maker entusiasta con proyectos de Raspberry Pi, Arduino 
                    e impresión 3D. Busco integrar hardware y software en soluciones innovadoras 
                    y prácticas.
                </p>
            </article>
            
            <article class="seccion">
                <h2>💼 Experiencia Laboral</h2>
                
                <div class="experiencia">
                    <h3>Desarrollador Web Full Stack</h3>
                    <p class="fecha"><span class="empresa">TechSolutions S.L.</span> | Enero 2024 - Actualidad</p>
                    <ul>
                        <li>Desarrollo de aplicaciones web con Flask y React</li>
                        <li>Diseño e implementación de bases de datos MySQL</li>
                        <li>Creación de APIs REST para integración con móviles</li>
                        <li>Optimización de consultas SQL, mejorando rendimiento en 40%</li>
                        <li>Implementación de sistema de autenticación JWT</li>
                    </ul>
                </div>
                
                <div class="experiencia">
                    <h3>Técnico de Soporte IT</h3>
                    <p class="fecha"><span class="empresa">Innovatech</span> | Junio 2022 - Diciembre 2023</p>
                    <ul>
                        <li>Soporte técnico a 100+ usuarios corporativos</li>
                        <li>Administración de servidores Linux (Ubuntu Server)</li>
                        <li>Automatización de tareas repetitivas con scripts Python</li>
                        <li>Mantenimiento de infraestructura de red</li>
                        <li>Documentación técnica de procedimientos</li>
                    </ul>
                </div>
                
                <div class="experiencia">
                    <h3>Desarrollador Junior Python</h3>
                    <p class="fecha"><span class="empresa">Freelance</span> | Enero 2021 - Mayo 2022</p>
                    <ul>
                        <li>Desarrollo de scripts de automatización para clientes</li>
                        <li>Web scraping y procesamiento de datos con Python</li>
                        <li>Creación de dashboards con Plotly y Dash</li>
                        <li>Integración con APIs de terceros (Stripe, SendGrid)</li>
                    </ul>
                </div>
            </article>
            
            <article class="seccion">
                <h2>🎓 Formación Académica</h2>
                
                <div class="formacion">
                    <h3>Técnico Superior en DAM</h3>
                    <p class="fecha"><span class="empresa">IES Politécnico</span> | 2024 - 2026</p>
                    <p>Desarrollo de Aplicaciones Multiplataforma. Especialización en Python, 
                       bases de datos y desarrollo web.</p>
                </div>
                
                <div class="formacion">
                    <h3>Bachillerato Tecnológico</h3>
                    <p class="fecha"><span class="empresa">IES Tecnológico</span> | 2020 - 2022</p>
                    <p>Modalidad de Ciencias y Tecnología. Nota media: 8.5</p>
                </div>
                
                <div class="formacion">
                    <h3>Certificaciones</h3>
                    <ul>
                        <li>Python for Data Science - Coursera (2023)</li>
                        <li>MySQL Database Administration - Udemy (2023)</li>
                        <li>Git & GitHub Masterclass - Udemy (2022)</li>
                    </ul>
                </div>
            </article>
            
            <article class="seccion">
                <h2>🚀 Proyectos Destacados</h2>
                
                <div class="proyecto-card">
                    <h3>🖨️ Sistema de Gestión de Impresión 3D</h3>
                    <p>
                        Aplicación web para gestionar modelos 3D, filamentos y trabajos de impresión. 
                        Backend en Flask con base de datos MySQL. Dashboard para estadísticas de uso 
                        y control de inventario de materiales.
                    </p>
                    <div class="tecnologias">
                        <span class="tech-tag">Python</span>
                        <span class="tech-tag">Flask</span>
                        <span class="tech-tag">MySQL</span>
                        <span class="tech-tag">HTML/CSS</span>
                        <span class="tech-tag">Chart.js</span>
                    </div>
                </div>
                
                <div class="proyecto-card">
                    <h3>🏠 Dashboard IoT con Raspberry Pi</h3>
                    <p>
                        Sistema domótico con sensores DHT22 para temperatura y humedad. 
                        Raspberry Pi 4 como servidor, almacenamiento en MySQL, visualización 
                        web en tiempo real. Control de relés para automatización.
                    </p>
                    <div class="tecnologias">
                        <span class="tech-tag">Raspberry Pi</span>
                        <span class="tech-tag">Python</span>
                        <span class="tech-tag">MySQL</span>
                        <span class="tech-tag">WebSocket</span>
                        <span class="tech-tag">GPIO</span>
                    </div>
                </div>
                
                <div class="proyecto-card">
                    <h3>📊 Analizador de Logs con IA</h3>
                    <p>
                        Herramienta para analizar logs de servidor, detectar patrones anómalos 
                        y generar alertas. Procesamiento con pandas, visualización con Plotly, 
                        exportación de informes PDF.
                    </p>
                    <div class="tecnologias">
                        <span class="tech-tag">Python</span>
                        <span class="tech-tag">Pandas</span>
                        <span class="tech-tag">Regex</span>
                        <span class="tech-tag">Plotly</span>
                        <span class="tech-tag">ReportLab</span>
                    </div>
                </div>
            </article>
        </section>
    </main>
</body>
</html>
```

#### Proyecto 2: Portafolio con CSS Grid y Modales

**Características:**
- Layout de galería con CSS Grid (columnas auto-ajustables)
- Modales para ver proyectos en detalle
- JavaScript para interactividad
- Efectos hover avanzados

```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portafolio - Proyectos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #0f0f0f;
            color: white;
            padding: 2rem;
        }
        
        header {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        h1 {
            font-size: 3rem;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1rem;
        }
        
        /* ========== GRID DE PROYECTOS ========== */
        .proyectos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        
        .proyecto-card {
            background: #1a1a1a;
            border-radius: 15px;
            overflow: hidden;
            position: relative;
            cursor: pointer;
            transition: transform 0.4s, box-shadow 0.4s;
        }
        
        .proyecto-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.4);
        }
        
        .proyecto-imagen {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.4s;
        }
        
        .proyecto-card:hover .proyecto-imagen {
            transform: scale(1.1);
        }
        
        .proyecto-info {
            padding: 1.5rem;
        }
        
        .proyecto-info h3 {
            color: #667eea;
            margin-bottom: 0.5rem;
        }
        
        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        
        .tag {
            background: rgba(102, 126, 234, 0.2);
            color: #667eea;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
        }
        
        /* ========== MODAL ========== */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            animation: fadeIn 0.3s;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .modal-content {
            background: #1a1a1a;
            margin: 5% auto;
            padding: 2rem;
            border-radius: 20px;
            max-width: 800px;
            position: relative;
            animation: slideDown 0.4s;
        }
        
        @keyframes slideDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        .close {
            color: #aaa;
            float: right;
            font-size: 2rem;
            cursor: pointer;
            transition: color 0.3s;
        }
        
        .close:hover {
            color: #667eea;
        }
        
        .modal-content img {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }
        
        .modal-content h2 {
            color: #667eea;
            margin-bottom: 1rem;
        }
        
        .modal-detalles {
            line-height: 1.8;
            color: #ccc;
        }
    </style>
</head>
<body>
    <header>
        <h1>🎨 Mi Portafolio</h1>
        <p>Proyectos de desarrollo web y maker</p>
    </header>
    
    <div class="proyectos-grid">
        <div class="proyecto-card" onclick="abrirModal(1)">
            <img src="https://via.placeholder.com/400x250" class="proyecto-imagen">
            <div class="proyecto-info">
                <h3>Sistema de Blog</h3>
                <p>Aplicación web completa con Flask y MySQL</p>
                <div class="tags">
                    <span class="tag">Python</span>
                    <span class="tag">Flask</span>
                    <span class="tag">MySQL</span>
                </div>
            </div>
        </div>
        
        <div class="proyecto-card" onclick="abrirModal(2)">
            <img src="https://via.placeholder.com/400x250" class="proyecto-imagen">
            <div class="proyecto-info">
                <h3>Dashboard IoT</h3>
                <p>Control de Raspberry Pi con sensores</p>
                <div class="tags">
                    <span class="tag">Raspberry Pi</span>
                    <span class="tag">Python</span>
                    <span class="tag">GPIO</span>
                </div>
            </div>
        </div>
        
        <!-- Más proyectos... -->
    </div>
    
    <!-- MODAL -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal()">&times;</span>
            <img id="modal-img" src="">
            <h2 id="modal-titulo"></h2>
            <div id="modal-descripcion" class="modal-detalles"></div>
        </div>
    </div>
    
    <script>
        function abrirModal(id) {
            const proyectos = {
                1: {
                    img: 'https://via.placeholder.com/800x400',
                    titulo: 'Sistema de Blog Completo',
                    descripcion: `
                        <p>Aplicación web profesional desarrollada con Flask...</p>
                        <ul>
                            <li>Autenticación de usuarios</li>
                            <li>CRUD completo de entradas</li>
                            <li>Sistema de comentarios</li>
                            <li>Exportación a JSON/CSV</li>
                        </ul>
                    `
                },
                2: {
                    img: 'https://via.placeholder.com/800x400',
                    titulo: 'Dashboard IoT con Raspberry Pi',
                    descripcion: `
                        <p>Sistema domótico con monitorización en tiempo real...</p>
                        <ul>
                            <li>Sensores DHT22 temperatura/humedad</li>
                            <li>Control de relés vía web</li>
                            <li>Gráficos históricos con Chart.js</li>
                            <li>Alertas por email</li>
                        </ul>
                    `
                }
            };
            
            const proyecto = proyectos[id];
            document.getElementById('modal-img').src = proyecto.img;
            document.getElementById('modal-titulo').textContent = proyecto.titulo;
            document.getElementById('modal-descripcion').innerHTML = proyecto.descripcion;
            document.getElementById('modal').style.display = 'block';
        }
        
        function cerrarModal() {
            document.getElementById('modal').style.display = 'none';
        }
        
        // Cerrar con ESC
        window.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') cerrarModal();
        });
        
        // Cerrar click fuera
        window.onclick = (e) => {
            const modal = document.getElementById('modal');
            if (e.target === modal) cerrarModal();
        };
    </script>
</body>
</html>
```

**Conceptos clave del simulacro completo:**
- ✅ **CSS Grid avanzado**: grid-template-columns con repeat(auto-fit, minmax())
- ✅ **Gradientes complejos**: linear-gradient() para fondos y texto
- ✅ **Pseudo-elementos**: ::before para bullets y decoración
- ✅ **Animaciones CSS**: @keyframes para fade-in, slide, shine
- ✅ **Transiciones**: transform, box-shadow para hover effects
- ✅ **Barras de progreso**: Implementación custom con animación
- ✅ **Media queries**: @media para responsive design
- ✅ **Modales**: Overlay con JavaScript, eventos onclick
- ✅ **Event listeners**: keydown (ESC), click fuera del modal
- ✅ **DOM manipulation**: getElementById, innerHTML, textContent
- ✅ **Template literals**: `` para HTML dentro de JavaScript
- ✅ **Background-clip**: Para gradientes en texto
- ✅ **Object-fit**: Para imágenes que mantengan proporción
- ✅ **Position**: absolute, relative, fixed para layouts complejos
- ✅ **Z-index**: Capas para modales sobre contenido
- ✅ **Backdrop-filter**: (opcional) Para efecto glassmorphism

**Aplicación práctica:**
- Portafolio personal para mostrar proyectos
- Galería de modelos 3D impresos
- Documentación técnica de proyectos Raspberry Pi
- Curriculum interactivo para postular a empleos

---

**💡 Tip final**: Este cheatsheet es tu referencia rápida. Practica cada concepto con proyectos reales y busca siempre aplicaciones prácticas con tu Raspberry Pi e impresora 3D. ¡La mejor forma de aprender es haciendo! 🔧🖨️
