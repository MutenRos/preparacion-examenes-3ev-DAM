

---

**Strict reassigned:** Lección dam2526PrimeroBases de datos001-Almacenamiento de la información001-Ficheros (planos, indexados, acceso directo, entre otros).txt — Sun Oct  5 13:46:30 2025

1.
El formato .JSON se utiliza para almacenar datos manteniendo una estructura clara, definida y ordenada, como por ejemplo, una tienda podría utilizar un archivo .JSON para almacenar los datos de sus clientes y sus compras.

2.
Para este ejercicio, crearemos un archivo .JSON para almacenar los datos de contacto de nuestros clientes, para nuestro negocio de impresiones 3D. Para ello, nos regiremos de una serie de normas como:
- Cadenas y claves con "comillas dobles",
- Listas entre `[ ]`, objetos entre `{ }`,
- SIN coma final tras el último elemento
3.
'''
{
	"nombre": "Juan",
	"apellidos": "Garcia",
	"telefono": ["987654321", "912345678"]
},
{
	"nombre": "Ana",
	"apellidos": "Lopez",
	"telefono": ["999888777", "987987987", "980980980"]
}
'''
4. Ahora hemos creado una agenda para nuestro negocio de impresiones de manera manual, pero en un futuro podremos crear algún programa que gestione esta misma base de datos rudimentaria de manera automática gracias al formato .JSON


---

**Strict reassigned:** Lección dam2526PrimeroBases de datos001-Almacenamiento de la información006-Big Data introducción, análisis de datos, inteligencia de negocios.txt — Sun Oct  5 13:46:30 2025


**Big Data** es el conjunto de datos `tan grande y complejo` que exige técnicas y herramientas específicas para **capturar, almacenar, procesar y analizar** la información de forma eficiente. Se entiende muy bien con las **3V**:
- **Volumen**: cantidades masivas de datos.
- **Velocidad**: ritmo al que se generan y deben procesarse.
- **Variedad**: múltiples formatos (sensores, logs, texto, etc.).

Con una `Raspberry Pi` puedo recoger muestras (por ejemplo, tráfico en mi pueblo) y luego agregarlas para detectar patrones.
---
A continuación creo la tabla **`datos_tráfico`** e inserto registros de ejemplo:

```sql
-- Esquema (SQLite)
CREATE TABLE "datos_tráfico" (
  id               INTEGER PRIMARY KEY,
  hora             TEXT,
  velocidad_media  REAL,
  numero_vehiculos INTEGER
);

-- Inserciones (≥ 5 registros)
INSERT INTO "datos_tráfico" (id, hora, velocidad_media, numero_vehiculos) VALUES
  (1, '08:00', 30.5, 200),
  (2, '08:00', 28.0, 180),
  (3, '09:00', 35.2, 220),
  (4, '09:00', 33.8, 210),
  (5, '10:00', 40.0, 150);
```
Para el resumen por hora, calculo el promedio de `velocidad_media` y `numero_vehiculos` y guardo el resultado en una variable `resultado_promedio`. 

```python

# Solución mínima (SQLite en memoria, sin librerías externas y sin input)
import sqlite3

# Crear BD en memoria y cursor
conn = sqlite3.connect(":memory:")
cur = conn.cursor()

# Crear tabla
cur.execute("""
CREATE TABLE "datos_tráfico" (
  id               INTEGER PRIMARY KEY,
  hora             TEXT,
  velocidad_media  REAL,
  numero_vehiculos INTEGER
);
""")

# Insertar datos
cur.executescript("""
INSERT INTO "datos_tráfico" (id, hora, velocidad_media, numero_vehiculos) VALUES
  (1, '08:00', 30.5, 200),
  (2, '08:00', 28.0, 180),
  (3, '09:00', 35.2, 220),
  (4, '09:00', 33.8, 210),
  (5, '10:00', 40.0, 150);
""")

# Consulta de resumen: promedio por hora
cur.execute("""
SELECT
  hora,
  AVG(velocidad_media)  AS velocidad_media_promedio,
  AVG(numero_vehiculos) AS numero_vehiculos_promedio
FROM "datos_tráfico"
GROUP BY hora
ORDER BY hora;
""")

# Guardar resultados en variable
resultado_promedio = cur.fetchall()

# (Opcional) mostrar en pantalla para verificar
for fila in resultado_promedio:
    print(fila)

conn.close()

```

Y en `resultado_promedio` nos queda una lista de tuplas (una por hora)

---

Con este script podemos empezar a monitorizar el trafico de nuestro pueblo o ciudad, con la ayuda de los aparatos de medicion necesarios claro. Pero lo mas importante, empezaremos a construir nuestro Big Data.


---

**Strict reassigned:** Lección dam2526PrimeroBases de datos001-Almacenamiento de la información005-Legislación sobre protección de datos.txt — Sun Oct  5 13:46:30 2025




**Strict reassigned:** Lección dam2526PrimeroBases de datos001-Almacenamiento de la información004-Bases de datos centralizadas y bases de datos distribuidas. Técnicas de fragmentación.txt — Sun Oct  5 13:46:30 2025
Cuándo el volumen de datos supera lo que un solo sistema informático puede manejar (por 'CPU', 'RAM' o tamaño de 'disco'), una solución muy empleada es la distribución. Fragmentar y/o replicar datos en varios nodos, ganando estabilidad y evitando cuellos de botella. Pero antes de fragmentar, tenemos que ver si nuestro sistema esta al límite.
---

### Ingested backup: Lección dam2526PrimeroBases de datos001-Almacenamiento de la información003-Sistemas gestores de base de datos Funciones, componentes y tipos.txt

Contenido añadido desde `ingested_backups_1759665015`.

> (Original backup preserved en `entregas/Primero/Bases de datos/001-Almacenamiento de la información/003-Sistemas gestores de base de datos Funciones, componentes y tipos/entregas/ingested_backups_1759665015/Lección dam2526PrimeroBases de datos001-Almacenamiento de la información003-Sistemas gestores de base de datos Funciones, componentes y tipos.txt`)


Para ello podemos usar scripts escritos en 'PYTHON' que defina nuestro limite, calcule los porcentajes usados y determine si es necesario o no fragmentar de una manera clara para el usuario. 
Con cifras ficticias, este podría ser un ejemplo de script;

'''
#Definimos las variables
cpu_limit =100.0
ram_limit =32.0
disk_space =512.0

#Definimos el uso actual
cpu_now =76.0
ram_now =28.5
disk_now =490.0

#Calculamos el porcentaje de uso
cpu_usage = (cpu_now / cpu_limit) * 100
ram_usage = (ram_now / ram_limit) * 100 if ram_limit > 0 else 0
disk_usage = (disk_now / disk_space) * 100 if disk_space > 0 else 0

#Verificacion de limites
is_overloaded = (cpu_now >= cpu_limit) or \
    (ram_now >= ram_limit) or \
    (disk_now >= disk_space)

#Evaluacion del sistema
if is_overloaded:
    print("El sistema esta sobrecargado")
else:
    print("El sistema funciona correctamente")

'''

Ahora si que tenemos una manera sencilla de saber cuando tendremos que fragmentar nuestros datos o distribuirlos antes del colapso. Esta técnica es ***clave*** para grandes volúmenes de datos.

---

**Strict reassigned:** Lección dam2526PrimeroBases de datos001-Almacenamiento de la información003-Sistemas gestores de base de datos Funciones, componentes y tipos.txt — Sun Oct  5 13:46:30 2025

Si mas de una persona va a trabajar en una misma base de datos, se hace imprescindible un sistema gestor de bases de datos o 'SGBD', que nos permita consultar, modificar y relacionar las tablas existentes asi como crearlas o eliminarlas.


###  Entidades y relaciones

**Producto**: `producto_id` (PK), `nombre`, `descripcion`, `precio`, `stock`, `activo`.

**Cliente**: `cliente_id` (PK), `nombre`, `apellidos`, `email`, `telefono`.

**Usuario**: `usuario_id` (PK), `username`, `nombre`, `rol`.

**Orden**: `orden_id` (PK), `cliente_id` (FK→**Cliente**), `usuario_id` (FK→**Usuario**), `fecha`, `total`.

#### Relaciones
- **Cliente 1–N Orden**: una orden pertenece a un cliente.
- **Usuario 1–N Orden**: una orden la registra un usuario.
- **Orden N–N Producto** → se resuelve con tabla puente **OrdenItem**.

**OrdenItem**: *(PK compuesta)* `orden_id` (FK→**Orden**), `producto_id` (FK→**Producto**), `cantidad`, `precio_unit`.

Hemos craedo la base de datos con DB Browser for SQLite, que es un SGBD sencillo para una base de datos simple. Al crear las atablas nos devuelve el siguiente código SQL

'''
**Cliente** 
CREATE TABLE Cliente (
  cliente_id   INTEGER PRIMARY KEY,
  nombre       TEXT NOT NULL,
  apellidos    TEXT NOT NULL,
  email        TEXT NOT NULL UNIQUE,
  telefono     TEXT
)

**Orden**
CREATE TABLE Orden (
  orden_id     INTEGER PRIMARY KEY,
  cliente_id   INTEGER NOT NULL,
  usuario_id   INTEGER NOT NULL,
  fecha        TEXT NOT NULL,              -- ISO-8601: YYYY-MM-DD
  total        NUMERIC NOT NULL CHECK (total >= 0),
  FOREIGN KEY (cliente_id) REFERENCES Cliente(cliente_id),
  FOREIGN KEY (usuario_id) REFERENCES Usuario(usuario_id)
)

**OrdenItem**
CREATE TABLE OrdenItem (
  orden_id     INTEGER NOT NULL,
  producto_id  INTEGER NOT NULL,
  cantidad     INTEGER NOT NULL CHECK (cantidad > 0),
  precio_unit  NUMERIC NOT NULL CHECK (precio_unit >= 0),
  PRIMARY KEY (orden_id, producto_id),
  FOREIGN KEY (orden_id)    REFERENCES Orden(orden_id),
  FOREIGN KEY (producto_id) REFERENCES Producto(producto_id)
)

**Producto**
CREATE TABLE Producto (
  producto_id  INTEGER PRIMARY KEY,
  nombre       TEXT NOT NULL,
  descripcion  TEXT,
  precio       NUMERIC NOT NULL CHECK (precio >= 0),
  stock        INTEGER NOT NULL CHECK (stock >= 0),
  activo       INTEGER NOT NULL DEFAULT 1  -- 1=true, 0=false
)

**Usuario**
CREATE TABLE Usuario (
  usuario_id   INTEGER PRIMARY KEY,
  username     TEXT NOT NULL UNIQUE,
  nombre       TEXT NOT NULL,
  rol          TEXT NOT NULL CHECK (rol IN ('admin','ventas','soporte'))
)
'''

Lo que nos crea las tablas necesarias para nuestro pequeño negocio de componentes, y las rellenamos gracias a este código prestado de chatGPT laa rellenamos rápidamente con algún ejemplo:

'''
INSERT INTO Usuario (usuario_id, username, nombre, rol) VALUES
  (1,'admin1','Laura Admin','admin'),
  (2,'ventas1','Luis Ventas','ventas');

INSERT INTO Cliente (cliente_id, nombre, apellidos, email, telefono) VALUES
  (100,'Juan','García','juan@example.com','600111222');

INSERT INTO Producto (producto_id, nombre, descripcion, precio, stock, activo) VALUES
  (1000,'Raspberry Pi 5 - 8GB','SBC 8GB RAM', 99.90,12,1),
  (1001,'Fuente 5V 3A USB-C','Alimentador oficial',12.50,30,1),
  (1002,'Tarjeta microSD 64GB','U3 A2',14.95,0,1),     -- sin stock
  (1003,'HAT PoE+','PoE Plus',24.90,10,0);            -- inactivo

INSERT INTO Orden (orden_id, cliente_id, usuario_id, fecha, total) VALUES
  (5000,100,2,'2025-09-30',112.40);

INSERT INTO OrdenItem (orden_id, producto_id, cantidad, precio_unit) VALUES
  (5000,1000,1,99.90),
  (5000,1001,1,12.50);
'''

Y ahora que la tenemos creada y rellena podemos realizar consultas como "Muestra el listado de productos disponibles para la venta", o:

'''
SELECT
  nombre  AS producto,
  precio,
  stock
FROM Producto
WHERE activo = 1 AND stock > 0
ORDER BY nombre;
'''

lo que nos devuelve como respuesta:

'''
Fuente 5V 3A USB-C	12.5	30
Raspberry Pi 5 - 8GB	99.9	12
'''

Asi es como un SGBD puede facilitarnos la vida a la hora de hurgar en tablas y listas por muy pequeño que sea tu negocio a monitorizar.


