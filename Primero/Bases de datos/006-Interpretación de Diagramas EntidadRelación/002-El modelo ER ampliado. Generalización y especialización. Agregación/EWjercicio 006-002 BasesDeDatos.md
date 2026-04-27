# Ejercicio 006-002: Generalización y especialización

**Alumno:** MutenRos  
**Evaluación:** Primera  
**Rúbrica:** 4 secciones × 25% cada una  

---

## ENUNCIADO

La generalización es un concepto clave en el modelado de datos que nos permite representar relaciones jerárquicas entre entidades. En este ejercicio, vamos a practicar la generalización utilizando un ejemplo concreto. Supongamos que tenemos una entidad general llamada "Persona" que tiene atributos comunes como "id", "nombre" y "apellidos". A partir de esta entidad, podemos derivar varias entidades más específicas: "Alumno", "Profesor" y "EmpleadoPAS". Cada una de estas entidades hijas hereda los atributos de la entidad padre "Persona" y añade sus propios atributos específicos.

---

## SECCIÓN 1: INTRODUCCIÓN (25%)

### Objetivo del ejercicio
Comprender y aplicar el concepto de **generalización** en el modelo ER extendido mediante la representación de una jerarquía de entidades que comparten atributos comunes. La generalización nos permite crear abstracciones que simplifican el diseño, reducen la redundancia y mejoran la escalabilidad del modelo.

### Contexto
En una institución educativa trabajamos con diferentes tipos de personas: alumnos, profesores y personal de administración y servicios (PAS). Todas comparten atributos básicos (id, nombre, apellidos), pero cada tipo tiene características específicas propias. La generalización nos permite modelar esta jerarquía de forma eficiente mediante una entidad padre "Persona" y tres entidades hijas especializadas.

### Importancia
La **generalización/especialización** es fundamental porque:
- Elimina redundancia al centralizar atributos comunes en la entidad padre
- Facilita el mantenimiento: los cambios en atributos comunes se aplican en un único lugar
- Permite consultas polimórficas (consultar todas las personas independientemente de su tipo)
- Modela fielmente la realidad: refleja relaciones "es un/a" (un Alumno **es una** Persona)

---

## SECCIÓN 2: DESARROLLO (25%)

### Diagrama ER con generalización

```
                    +-------------------+
                    |     PERSONA       |
                    +-------------------+
                    | PK: id (INT)      |
                    | nombre (VARCHAR)  |
                    | apellidos (VARCHAR)|
                    +-------------------+
                            / | \
                           /  |  \
                          /   |   \
              ES-UN      /    |    \      ES-UN
                        /     |     \
                       /      |      \
                      /       |       \
         +-----------+  +----------+  +-----------------+
         |  ALUMNO   |  | PROFESOR |  |  EMPLEADO_PAS   |
         +-----------+  +----------+  +-----------------+
         | PK: id    |  | PK: id   |  | PK: id          |
         | FK: id    |  | FK: id   |  | FK: id          |
         | NIA (CHAR)|  | despacho |  | departamento    |
         +-----------+  | (VARCHAR)|  | (VARCHAR)       |
                        +----------+  +-----------------+
```

### Tabla de especialización

| Entidad Padre | Atributos comunes | Entidad Hija | Atributos específicos |
|--------------|-------------------|--------------|----------------------|
| Persona | id, nombre, apellidos | Alumno | NIA |
| Persona | id, nombre, apellidos | Profesor | despacho |
| Persona | id, nombre, apellidos | EmpleadoPAS | departamento |

### Tipo de implementación
Usamos **table-per-type** (una tabla por tipo): cada entidad (padre e hijas) tiene su propia tabla. Las entidades hijas tienen una FK que referencia a la entidad padre.

### Código SQL - Creación de tablas

```sql
CREATE DATABASE IF NOT EXISTS institucion_educativa;
USE institucion_educativa;

-- Tabla padre: Persona
CREATE TABLE Persona (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(150) NOT NULL
);

-- Tabla hija: Alumno
CREATE TABLE Alumno (
    id INT PRIMARY KEY,
    NIA CHAR(9) UNIQUE NOT NULL,
    FOREIGN KEY (id) REFERENCES Persona(id) ON DELETE CASCADE
);

-- Tabla hija: Profesor
CREATE TABLE Profesor (
    id INT PRIMARY KEY,
    despacho VARCHAR(50) NOT NULL,
    FOREIGN KEY (id) REFERENCES Persona(id) ON DELETE CASCADE
);

-- Tabla hija: EmpleadoPAS
CREATE TABLE EmpleadoPAS (
    id INT PRIMARY KEY,
    departamento VARCHAR(100) NOT NULL,
    FOREIGN KEY (id) REFERENCES Persona(id) ON DELETE CASCADE
);
```

**Explicación:**
- `Persona` es la tabla padre con atributos comunes
- Cada tabla hija (`Alumno`, `Profesor`, `EmpleadoPAS`) tiene `id` como PK y FK que referencia a `Persona(id)`
- `ON DELETE CASCADE`: si se elimina una persona, se eliminan automáticamente sus registros especializados

---

## SECCIÓN 3: APLICACIÓN PRÁCTICA (25%)

### Inserción de datos

```sql
-- Insertar personas primero (entidad padre)
INSERT INTO Persona (nombre, apellidos) VALUES
('Carlos', 'García López'),
('María', 'Fernández Ruiz'),
('Juan', 'Martínez Sánchez'),
('Ana', 'Pérez Torres'),
('Luis', 'Rodríguez Gómez');

-- Insertar alumnos (especialización)
INSERT INTO Alumno (id, NIA) VALUES
(1, '202312345'),
(2, '202312346');

-- Insertar profesores (especialización)
INSERT INTO Profesor (id, despacho) VALUES
(3, 'A-205'),
(4, 'B-310');

-- Insertar empleados PAS (especialización)
INSERT INTO EmpleadoPAS (id, departamento) VALUES
(5, 'Administración');
```

### Consultas de verificación

**1. Listar todos los alumnos con sus datos completos:**
```sql
SELECT p.id, p.nombre, p.apellidos, a.NIA
FROM Persona p
INNER JOIN Alumno a ON p.id = a.id;
```

**Resultado esperado:**
```
+----+--------+---------------+-----------+
| id | nombre | apellidos     | NIA       |
+----+--------+---------------+-----------+
|  1 | Carlos | García López  | 202312345 |
|  2 | María  | Fernández Ruiz| 202312346 |
+----+--------+---------------+-----------+
```

**2. Listar todos los profesores con su despacho:**
```sql
SELECT p.id, p.nombre, p.apellidos, pr.despacho
FROM Persona p
INNER JOIN Profesor pr ON p.id = pr.id;
```

**3. Listar todas las personas indicando su tipo:**
```sql
SELECT p.id, p.nombre, p.apellidos,
    CASE
        WHEN a.id IS NOT NULL THEN 'Alumno'
        WHEN pr.id IS NOT NULL THEN 'Profesor'
        WHEN e.id IS NOT NULL THEN 'Empleado PAS'
        ELSE 'Sin tipo'
    END AS tipo
FROM Persona p
LEFT JOIN Alumno a ON p.id = a.id
LEFT JOIN Profesor pr ON p.id = pr.id
LEFT JOIN EmpleadoPAS e ON p.id = e.id;
```

**Resultado esperado:**
```
+----+--------+----------------+--------------+
| id | nombre | apellidos      | tipo         |
+----+--------+----------------+--------------+
|  1 | Carlos | García López   | Alumno       |
|  2 | María  | Fernández Ruiz | Alumno       |
|  3 | Juan   | Martínez S.    | Profesor     |
|  4 | Ana    | Pérez Torres   | Profesor     |
|  5 | Luis   | Rodríguez G.   | Empleado PAS |
+----+--------+----------------+--------------+
```

**4. Contar personas por tipo:**
```sql
SELECT 
    COUNT(DISTINCT a.id) AS total_alumnos,
    COUNT(DISTINCT pr.id) AS total_profesores,
    COUNT(DISTINCT e.id) AS total_empleados_PAS
FROM Persona p
LEFT JOIN Alumno a ON p.id = a.id
LEFT JOIN Profesor pr ON p.id = pr.id
LEFT JOIN EmpleadoPAS e ON p.id = e.id;
```

---

## SECCIÓN 4: CONCLUSIÓN (25%)

### Conceptos clave aprendidos

**1. Generalización/Especialización:**
- La generalización agrupa entidades con características comunes en una entidad padre
- La especialización divide la entidad padre en subtipos con atributos específicos
- Relación "ES-UN": un Alumno ES-UNA Persona

**2. Ventajas del modelo:**
- **Reducción de redundancia**: atributos comunes (nombre, apellidos) se almacenan una sola vez
- **Mantenimiento simplificado**: cambios en atributos comunes solo requieren modificar la tabla padre
- **Integridad referencial**: `ON DELETE CASCADE` garantiza consistencia automática
- **Consultas polimórficas**: podemos consultar todas las personas sin importar su tipo

**3. Implementación table-per-type:**
- Cada entidad (padre e hijas) tiene su propia tabla
- Las tablas hijas usan la PK como FK hacia la tabla padre
- Requiere JOINs para obtener datos completos, pero mantiene la normalización

### Relación con la unidad

Este ejercicio aplica directamente el **modelo ER ampliado** visto en la unidad 006:
- **Generalización**: mecanismo de abstracción que permite modelar jerarquías de tipos
- **Especialización**: proceso inverso que define subtipos específicos
- **Herencia de atributos**: las entidades hijas heredan todos los atributos del padre
- **Transformación a modelo relacional**: conversión de jerarquías ER a tablas SQL mediante FK

El diseño implementado cumple con la **3FN** (tercera forma normal):
- Cada tabla tiene una PK clara
- No hay dependencias transitivas
- No hay redundancia de atributos comunes
- Las relaciones se gestionan mediante FK

Este modelo es escalable: podemos añadir fácilmente nuevos tipos de persona (ej: "Investigador", "Becario") sin modificar la estructura existente, solo creando nuevas tablas especializadas.
