Contexto
En nuestro mundo tecnológico actual, las bases de datos son una herramienta fundamental para almacenar y gestionar información de manera eficiente. Imagina que eres un empresario que quiere mantener un registro detallado de todos los productos que vende en su tienda virtual. Para ello, decides utilizar un sistema de gestión de bases de datos relacional.

Además, como un aficionado a la modelación e impresión 3D, siempre estoy interesado en cómo estructurar información de manera óptima para facilitar el acceso y la búsqueda. Este proyecto te permitirá combinar tus habilidades técnicas con tu pasión por la tecnología.

Enunciado paso a paso
Crea una base de datos llamada tienda_virtual.

Nombre de variable: base_de_datos_tienda
Dentro de esta base de datos, crea una tabla llamada productos con las siguientes columnas:

Identificador: Entero no nulo

nombre: Cadena de caracteres de máximo 50 caracteres

descripcion: Texto largo

precio: Doble precisión con dos decimales

peso: Doble precisión con dos decimales

Nombre de variable: TablaProductos

Inserta al menos tres productos en la tabla productos.

Asegúrate de asignar valores a cada columna según el tipo de dato especificado.
Realiza una consulta para seleccionar todos los productos con un precio mayor que 50 euros.

Restricciones
No utilizar librerías externas.
No usar estructuras no vistas en clase (como input() o funciones complejas).
Solo utilizar conceptos y terminología explicados en clase.
Criterios de evaluación
Introducción y contextualización (25%): El estudiante debe mostrar comprensión del contexto y la importancia de las bases de datos.
Desarrollo técnico correcto y preciso (25%): El código debe ser sintácticamente correcto y seguir los conceptos explicados en clase.
Aplicación práctica con ejemplo claro (25%): El estudiante debe mostrar habilidad para aplicar los conocimientos prácticos mediante la creación de una base de datos y tabla, así como la inserción y consulta de datos.
Cierre/Conclusión enlazando con la unidad (25%): El estudiante debe relacionar el ejercicio con el tema actual y mostrar cómo este tipo de estructuras son fundamentales para la gestión de información en sistemas empresariales.

#la tabla de productos deben ser miniaturas reales de warhammer 40k escala 15mm

Bueno, ya parece que tenemos unos conceptos basicos de bases de datos relacionales. Ahora vamos a ver algunos terminos que usaremos en el futuro. y ya de paso, vamo a empezar a montar nuestra tienda online de miniaturas. Empezaremos con 10 packs de miniaturas distintos asi que nuestra nueva tabla de productos seria asi:

```sql
CREATE TABLE Productos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    faccion VARCHAR(50),
    descripcion TEXT,
    cantidad INT,
    precio DECIMAL(10, 2),
    peso DECIMAL(10, 2),
    volumen DECIMAL(10, 2)
);
```
y ahora añadiremos nuestro catalogo de miniaturas:

```sql
INSERT INTO Productos (nombre, faccion, descripcion, cantidad, precio, peso, volumen)
VALUES 
('Pack de 10 Marines Espaciales', 'Imperio', 'Miniaturas de Marines Espaciales en escala 15mm', 10, 45.00, 0.5, 0.1),
('Pack de 10 Orkos', 'Orkos', 'Miniaturas de Orkos en escala 15mm', 10, 40.00, 0.6, 0.1),
('Pack de 10 Eldars', 'Eldars', 'Miniaturas de Eldars en escala 15mm', 10, 50.00, 0.4, 0.1),
('Pack de 10 Necrones', 'Necrones', 'Miniaturas de Necrones en escala 15mm', 10, 55.00, 0.5, 0.1),
('Pack de 10 Tau', 'Tau', 'Miniaturas de Tau en escala 15mm', 10, 60.00, 0.5, 0.1),
('Pack de 10 Demonios del Caos', 'Caos', 'Miniaturas de Demonios del Caos en escala 15mm', 10, 65.00, 0.7, 0.1),
('Pack de 10 Tiránidos', 'Tiránidos', 'Miniaturas de Tiránidos en escala 15mm', 10, 70.00, 0.8, 0.1),
('Pack de 10 Guardia Imperial', 'Imperio', 'Miniaturas de Guardia Imperial en escala 15mm', 10, 35.00, 0.5, 0.1),
('Pack de 10 Caballeros Grises', 'Imperio', 'Miniaturas de Caballeros Grises en escala 15mm', 10, 75.00, 0.6, 0.1),
('Pack de 10 Genestealers', 'Tiránidos', 'Miniaturas de Genestealers en escala 15mm', 10, 80.00, 0.4, 0.1);
```
Lo que nos creara una tabla con este aspecto:
```
| id | nombre                     | faccion   | descripcion                                   | cantidad | precio | peso | volumen |
|----|----------------------------|-----------|-----------------------------------------------|----------|--------|------|---------|
| 1  | Pack de 10 Marines Espaciales | Imperio   | Miniaturas de Marines Espaciales en escala 15mm | 10       | 45.00  | 0.5  | 0.1     |
| 2  | Pack de 10 Orkos           | Orkos     | Miniaturas de Orkos en escala 15mm               | 10       | 40.00  | 0.6  | 0.1     |
| 3  | Pack de 10 Eldars          | Eldars    | Miniaturas de Eldars en escala 15mm                | 10       | 50.00  | 0.4  | 0.1     |
| 4  | Pack de 10 Necrones        | Necrones  | Miniaturas de Necrones en escala 15mm              | 10       | 55.00  | 0.5  | 0.1     |
| 5  | Pack de 10 Tau             | Tau       | Miniaturas de Tau en escala 15mm                   | 10       | 60.00  | 0.5  | 0.1     |
| 6  | Pack de 10 Demonios del Caos | Caos      | Miniaturas de Demonios del Caos en escala 15mm       | 10       | 65.00  | 0.7  | 0.1     |
| 7  | Pack de 10 Tiránidos       | Tiránidos | Miniaturas de Tiránidos en escala 15mm               | 10       | 70.00  | 0.8  | 0.1     |
| 8  | Pack de 10 Guardia Imperial | Imperio   | Miniaturas de Guardia Imperial en escala 15mm         | 10       | 35.00  | 0.5  | 0.1     |
| 9  | Pack de 10 Caballeros Grises | Imperio   | Miniaturas de Caballeros Grises en escala 15mm         | 10       | 75.00  | 0.6  | 0.1     |
| 10 | Pack de 10 Genestealers    | Tiránidos | Miniaturas de Genestealers en escala 15mm              | 10       | 80.00  | 0.4  | 0.1     |
```
Ahora, si queremos ver todos los productos con un precio mayor a 50 euros, haríamos la siguiente consulta:

```sql
SELECT * FROM Productos WHERE precio > 50;
``` 
y el resultado seria:

```
| id | nombre                     | faccion   | descripcion                                   | cantidad | precio | peso | volumen |
|----|----------------------------|-----------|-----------------------------------------------|----------|--------|------|---------|
| 4  | Pack de 10 Necrones        | Necrones  | Miniaturas de Necrones en escala 15mm              | 10       | 55.00  | 0.5  | 0.1     |
| 5  | Pack de 10 Tau             | Tau       | Miniaturas de Tau en escala 15mm                   | 10       | 60.00  | 0.5  | 0.1     |
| 6  | Pack de 10 Demonios del Caos | Caos      | Miniaturas de Demonios del Caos en escala 15mm       | 10       | 65.00  | 0.7  | 0.1     |
| 7  | Pack de 10 Tiránidos       | Tiránidos | Miniaturas de Tiránidos en escala 15mm               | 10       | 70.00  | 0.8  | 0.1     |
| 9  | Pack de 10 Caballeros Grises | Imperio   | Miniaturas de Caballeros Grises en escala 15mm         | 10       | 75.00  | 0.6  | 0.1     |
| 10 | Pack de 10 Genestealers    | Tiránidos | Miniaturas de Genestealers en escala 15mm              | 10       | 80.00  | 0.4  | 0.1     |
```
Y ahora ya podemos empezar a coger pedidos!