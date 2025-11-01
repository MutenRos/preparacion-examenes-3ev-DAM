En el mundo digital actual, la tecnología juega un papel cada vez más importante en nuestras vidas diarias. Los Raspberrys y similares son dispositivos muy versátiles que pueden ser utilizados para una variedad de proyectos, desde la automatización doméstica hasta el desarrollo de sistemas informáticos personalizados. Además, el modelado e impresión 3D ha revolucionado la forma en que diseñamos y creamos objetos físicos, permitiendo crear prototipos rápidamente y con precisión.

Enunciado paso a paso
Creación de una Base de Datos para un Proyecto de Raspberrys

Diseña una base de datos para almacenar información sobre los proyectos que estás realizando con tu Raspberry Pi.
Incluye las siguientes tablas:
Proyectos: Almacena detalles sobre cada proyecto, como el nombre del proyecto y la fecha de inicio.
Componentes: Detalla los componentes utilizados en cada proyecto.
Conexiones: Mantiene un registro de todas las conexiones entre los componentes.
Inserción de Datos

Inserta al menos tres proyectos que estés trabajando actualmente en la tabla Proyectos.
Para cada proyecto, añade los componentes utilizados y sus respectivas conexiones en las tablas Componentes e Conexiones.
Consulta de Información

Realiza una consulta para obtener todos los proyectos que utilicen un componente específico (por ejemplo, un sensor ultrasonico).
Muestra el nombre del proyecto, la fecha de inicio y los componentes asociados.
Restricciones
No puedes utilizar librerías externas.
Solo puedes usar estructuras vistas en clase.
Criterios de evaluación
Introducción y contextualización (25%): El estudiante debe entender el contexto del tema y cómo los Raspberrys y el modelado e impresión 3D se relacionan con la base de datos.

Desarrollo técnico correcto y preciso (25%): El estudiante debe diseñar correctamente las tablas y realizar operaciones de inserción y consulta sin errores técnicos.

Aplicación práctica con ejemplo claro (25%): El estudiante debe aplicar los conceptos aprendidos en un ejercicio práctico, mostrando cómo se pueden utilizar las bases de datos para gestionar proyectos de Raspberrys.

Cierre/Conclusión enlazando con la unidad (25%): El estudiante debe concluir el ejercicio haciendo referencia a cómo los conceptos aprendidos se relacionan con el tema actual y cómo podrían aplicarse en proyectos futuros.





La idea inicial era vender un unico proyecto, Pero al final, habiendo intentado ya tantos y conseguido tantos otros, nuestra nuestro cajon de piezas se ha convertido en caja, asi que al final nuestra tienda online va a ser de piezas y proyectos basados en Raspberrys otras placas de desarrollo similares. Para ello, vamos a crear una base de datos sqlite que nos permita almacenar informacion sobre los proyectos, las piezas y las conexiones entre ellas.

Primero, creamos la base de datos y las tablas, luego inventariaremos el cajon de piezas y proyectos y relacionaremos que proyecto lleva que piezas y materiales.

Crearemos las tablas proyectos, piezas, y consumibles, siendo esta ultima para las piezas no computacionales, como tornillos, cables, tarjetas SD, etc.

Proyectos
- id_proyecto (INTEGER PRIMARY KEY)
- nombre (TEXT)
- Descripcion (TEXT)
- Nivel_dificultad (TEXT)
- Tiempo estimado (INTEGER)
- Cantidad_en_stock (INTEGER)

Piezas
- id_pieza (INTEGER PRIMARY KEY)
- nombre (TEXT)
- Descripcion (TEXT)
- Proyectos_compatibles (TEXT)
- Cantidad_en_stock (INTEGER)

Consumibles
id_consumible (INTEGER PRIMARY KEY)
- nombre (TEXT)
- Descripcion (TEXT)
- Unidad_de_medida (TEXT)
- Cantidad_en_stock (INTEGER)

O como se diria en SQL:
```SQL
CREATE TABLE Proyectos (
    id_proyecto INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255),
    descripcion TEXT,
    nivel_dificultad VARCHAR(50),
    tiempo_estimado INT,
    cantidad_en_stock INT
);

CREATE TABLE Piezas (
    id_pieza INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255),
    descripcion TEXT,
    cantidad_en_stock INT
);

CREATE TABLE Consumibles (
    id_consumible INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255),
    descripcion TEXT,
    unidad_de_medida VARCHAR(50),
    cantidad_en_stock INT
);

-- Tabla intermedia: Proyectos - Piezas
CREATE TABLE Proyecto_Piezas (
    id_proyecto_pieza INT PRIMARY KEY AUTO_INCREMENT,
    id_proyecto INT,
    id_pieza INT,
    cantidad_necesaria INT DEFAULT 1,
    FOREIGN KEY (id_proyecto) REFERENCES Proyectos(id_proyecto) ON DELETE CASCADE,
    FOREIGN KEY (id_pieza) REFERENCES Piezas(id_pieza) ON DELETE CASCADE
);

-- Tabla intermedia: Proyectos - Consumibles
CREATE TABLE Proyecto_Consumibles (
    id_proyecto_consumible INT PRIMARY KEY AUTO_INCREMENT,
    id_proyecto INT,
    id_consumible INT,
    cantidad_necesaria INT DEFAULT 1,
    FOREIGN KEY (id_proyecto) REFERENCES Proyectos(id_proyecto) ON DELETE CASCADE,
    FOREIGN KEY (id_consumible) REFERENCES Consumibles(id_consumible) ON DELETE CASCADE
);
```
Y ahora vamos a listar lo que tenemos en el cajon de piezas y proyectos, para luego insertarlo en la base de datos.

- R-PI zero 2w - x1
- R-PI 4b gb - x2
- R-PI 5 16gb - x1
- O-PI zero3 4gb - x1
- O-PI zero3 1gb - x1
- R-PI pico - x2
- WM8960 Audio HAT - x3
- 3.7" ePaper HAT - x2
- Camara R-PI HQ - x1
- ESP32-CAM - x2
- ESP32 C1 - x1
- ESP32 S1 - x1
- PciE splitter - x1
- Hailo-8 - x1

- M2 NVMe 512gb - x1
- MicroSD 32gb - x5
- MM Jumper wire - x20
- MF Jumper wire - x15
- FF Jumper wire - x10
- Fuente alimentacion 5v 3a - x2
- Separador hexagonal M2.5 5mm - x50
- Separador hexagonal M2.5 10mm - x50
- Tornillo M2.5x5mm - x100
- Tuerca M2.5 - x100
- Protector Metacrilato R-PI 4b - x4
- Ventilador 30x30mm - x6

Y ahora algunos de los proyectos construibles con estas piezas:

- Mini servidor NAS con R-PI 4b y M2 NVMe
- Camara de seguridad con ESP32-CAM y ePaper HAT
- Reproductor de musica con R-PI zero 2w y WM8960 Audio HAT
- Estacion meteorologica con R-PI pico y sensores varios

Con esto ya tenemos la base de datos creada y el inventario inicial. Ahora podemos insertar los datos en las tablas correspondientes y realizar consultas para gestionar nuestro stock y proyectos futuros.

eL SQL DE TODOS LOS PRODUCTOS NECESARIOS SERA EL SIGUIENTE:
```SQL  
-- Insertar proyectos
INSERT INTO Proyectos (nombre, descripcion, nivel_dificultad, tiempo_estimado, cantidad_en_stock) VALUES
('Mini servidor NAS', 'Servidor NAS con R-PI 4b y M2 NVMe', 'Medio', 120, 2),
('Camara de seguridad', 'Camara de seguridad con ESP32-CAM y ePaper HAT', 'Facil', 90, 2),
('Reproductor de musica', 'Reproductor de musica con R-PI zero 2w y WM8960 Audio HAT', 'Facil', 60, 3),
('Estacion meteorologica', 'Estacion meteorologica con R-PI pico y sensores varios', 'Medio', 150, 1);

-- Insertar piezas
INSERT INTO Piezas (nombre, descripcion, cantidad_en_stock) VALUES
('R-PI zero 2w', 'Placa Raspberry Pi Zero 2 W', 1),
('R-PI 4b 4gb', 'Placa Raspberry Pi 4 Modelo B con 4GB RAM', 2),
('R-PI 5 16gb', 'Placa Raspberry Pi 5 con 16GB RAM', 1),
('O-PI zero3 4gb', 'Placa Orange Pi Zero3 con 4GB RAM', 1),
('O-PI zero3 1gb', 'Placa Orange Pi Zero3 con 1GB RAM', 1),
('R-PI pico', 'Microcontrolador Raspberry Pi Pico', 2),
('WM8960 Audio HAT', 'Tarjeta de sonido WM8960 para Raspberry Pi', 3),
('3.7" ePaper HAT', 'Pantalla ePaper de 3.7 pulgadas para Raspberry Pi', 2),
('Camara R-PI HQ', 'Camara de alta calidad para Raspberry Pi', 1),
('ESP32-CAM', 'Modulo ESP32 con camara integrada', 2),
('ESP32 C1', 'Placa ESP32 C1 para proyectos IoT', 1),
('ESP32 S1', 'Placa ESP32 S1 para proyectos IoT', 1),
('PciE splitter', 'Divisor PCIe para expandir conexiones', 1),
('Hailo-8', 'Acelerador de IA Hailo-8 para Raspberry Pi', 1);

-- Insertar consumibles
INSERT INTO Consumibles (nombre, descripcion, unidad_de_medida, cantidad_en_stock) VALUES
('M2 NVMe 512gb', 'Disco M.2 NVMe de 512GB', 'Unidad', 1),
('MicroSD 32gb', 'Tarjeta MicroSD de 32GB', 'Unidad', 5),
('MM Jumper wire', 'Cable jumper macho-macho', 'Unidad', 20),
('MF Jumper wire', 'Cable jumper macho-hembra', 'Unidad', 15),
('FF Jumper wire', 'Cable jumper hembra-hembra', 'Unidad', 10),
('Fuente alimentacion 5v 3a', 'Fuente de alimentacion de 5V y 3A', 'Unidad', 2),
('Separador hexagonal M2.5 5mm', 'Separador hexagonal M2.5 de 5mm', 'Unidad', 50),
('Separador hexagonal M2.5 10mm', 'Separador hexagonal M2.5 de 10mm', 'Unidad', 50),
('Tornillo M2.5x5mm', 'Tornillo M2.5x5mm', 'Unidad', 100),
('Tuerca M2.5', 'Tuerca para tornillo M2.5', 'Unidad', 100),
('Protector Metacrilato R-PI 4b', 'Protector de metacrilato para Raspberry Pi 4b', 'Unidad', 4),
('Ventilador 30x30mm', 'Ventilador de refrigeracion de 30x30mm', 'Unidad', 6);

-- Relaciones Proyecto 1: Mini servidor NAS (R-PI 4b + M2 NVMe)
INSERT INTO Proyecto_Piezas (id_proyecto, id_pieza, cantidad_necesaria) VALUES
(1, 2, 1),  -- R-PI 4b 4gb
(1, 13, 1); -- PciE splitter

INSERT INTO Proyecto_Consumibles (id_proyecto, id_consumible, cantidad_necesaria) VALUES
(1, 1, 1),   -- M2 NVMe 512gb
(1, 2, 1),   -- MicroSD 32gb
(1, 6, 1),   -- Fuente alimentacion 5v 3a
(1, 11, 1),  -- Protector Metacrilato R-PI 4b
(1, 12, 1),  -- Ventilador 30x30mm
(1, 7, 4),   -- Separador hexagonal M2.5 5mm
(1, 9, 8);   -- Tornillo M2.5x5mm

-- Relaciones Proyecto 2: Camara de seguridad (ESP32-CAM + ePaper HAT)
INSERT INTO Proyecto_Piezas (id_proyecto, id_pieza, cantidad_necesaria) VALUES
(2, 10, 1), -- ESP32-CAM
(2, 8, 1);  -- 3.7" ePaper HAT

INSERT INTO Proyecto_Consumibles (id_proyecto, id_consumible, cantidad_necesaria) VALUES
(2, 2, 1),  -- MicroSD 32gb
(2, 5, 10), -- FF Jumper wire
(2, 6, 1);  -- Fuente alimentacion 5v 3a

-- Relaciones Proyecto 3: Reproductor de musica (R-PI zero 2w + WM8960 Audio HAT)
INSERT INTO Proyecto_Piezas (id_proyecto, id_pieza, cantidad_necesaria) VALUES
(3, 1, 1),  -- R-PI zero 2w
(3, 7, 1);  -- WM8960 Audio HAT

INSERT INTO Proyecto_Consumibles (id_proyecto, id_consumible, cantidad_necesaria) VALUES
(3, 2, 1),  -- MicroSD 32gb
(3, 6, 1),  -- Fuente alimentacion 5v 3a
(3, 7, 4),  -- Separador hexagonal M2.5 5mm
(3, 9, 4);  -- Tornillo M2.5x5mm

-- Relaciones Proyecto 4: Estacion meteorologica (R-PI pico + sensores)
INSERT INTO Proyecto_Piezas (id_proyecto, id_pieza, cantidad_necesaria) VALUES
(4, 6, 1);  -- R-PI pico

INSERT INTO Proyecto_Consumibles (id_proyecto, id_consumible, cantidad_necesaria) VALUES
(4, 3, 10), -- MM Jumper wire
(4, 4, 5),  -- MF Jumper wire
(4, 6, 1);  -- Fuente alimentacion 5v 3a
```

## Añadir relaciones con ALTER TABLE (si ya tienes las tablas creadas)

```SQL
-- Primero, crear las tablas intermedias
CREATE TABLE Proyecto_Piezas (
    id_proyecto_pieza INT PRIMARY KEY AUTO_INCREMENT,
    id_proyecto INT,
    id_pieza INT,
    cantidad_necesaria INT DEFAULT 1
);

CREATE TABLE Proyecto_Consumibles (
    id_proyecto_consumible INT PRIMARY KEY AUTO_INCREMENT,
    id_proyecto INT,
    id_consumible INT,
    cantidad_necesaria INT DEFAULT 1
);

-- Ahora añadir las FOREIGN KEY con ALTER TABLE
ALTER TABLE Proyecto_Piezas
ADD CONSTRAINT fk_proyecto_piezas_proyecto 
    FOREIGN KEY (id_proyecto) REFERENCES Proyectos(id_proyecto) ON DELETE CASCADE;

ALTER TABLE Proyecto_Piezas
ADD CONSTRAINT fk_proyecto_piezas_pieza 
    FOREIGN KEY (id_pieza) REFERENCES Piezas(id_pieza) ON DELETE CASCADE;

ALTER TABLE Proyecto_Consumibles
ADD CONSTRAINT fk_proyecto_consumibles_proyecto 
    FOREIGN KEY (id_proyecto) REFERENCES Proyectos(id_proyecto) ON DELETE CASCADE;

ALTER TABLE Proyecto_Consumibles
ADD CONSTRAINT fk_proyecto_consumibles_consumible 
    FOREIGN KEY (id_consumible) REFERENCES Consumibles(id_consumible) ON DELETE CASCADE;
```

Y ahora supongamos que tenemos una RPI 4b y no sabemos que hacer con ella, podriamos realizar una consulta para ver que proyectos podemos hacer con una RPI 4b:

```SQL
SELECT p.nombre AS proyecto, p.descripcion, p.nivel_dificultad, p.tiempo_estimado
FROM Proyectos p
JOIN Proyecto_Piezas pp ON p.id_proyecto = pp.id_proyecto
JOIN Piezas pi ON pp.id_pieza = pi.id_pieza
WHERE pi.nombre = 'R-PI 4b 4gb';
```