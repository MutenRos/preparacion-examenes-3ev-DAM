En nuestra clase de Bases de Datos Relacionales, hemos estado explorando cómo organizar y relacionar los datos mediante el modelo de datos. Este concepto es fundamental para entender cómo almacenar, recuperar y gestionar información de manera eficiente.

Para poner en práctica lo que hemos aprendido, vamos a trabajar con una base de datos que incluye clientes, productos y pedidos. Imagina que eres un empresario que necesita mantener un registro de sus ventas y clientes.

Enunciado paso a paso
Crear la tabla de Clientes:

Nombre: Clientes
Campos: nombre, apellidos, teléfono, email
Crear la tabla de Productos:

Nombre: Productos
Campos: nombre, descripcion, precio, tamaño, peso
Crear la tabla de Pedidos:

Nombre: Pedidos
Campos: fecha, numero_pedido, Cliente_id (llave foránea), Productos_id (llave foránea), impuestos, total
Insertar algunos datos en las tablas:

En la tabla Clientes: Añade al menos 3 clientes con sus respectivos datos.
En la tabla Productos: Añade al menos 5 productos con sus detalles.
Realizar consultas para obtener información:

Consulta que muestre el nombre, apellidos y email de todos los clientes.
Consulta que devuelva el nombre del producto y su precio.
Consulta que liste todos los pedidos realizados en un determinado mes.
Restricciones
No usar librerías externas ni input()/lectura de teclado.
Solo utilizar estructuras vistas en clase (por ejemplo, variables, funciones básicas).
Criterios de evaluación
Introducción y contextualización: El estudiante debe demostrar comprensión del contexto y la importancia del modelo de datos en las bases de datos relacionales.
Desarrollo técnico correcto y preciso: El estudiante debe crear correctamente las tablas con los campos adecuados y insertar datos precisos.
Aplicación práctica con ejemplo claro: El estudiante debe realizar consultas que muestren la capacidad para manipular y recuperar información de las tablas.
Cierre/Conclusión enlazando con la unidad: El estudiante debe explicar cómo esta actividad se relaciona con los conceptos aprendidos en clase y cómo podría aplicarse en un entorno empresarial real.


Para abrir nuestro negocio, lo primero que tenemos qe hacer es crear las tablas que contendran la informacion de nuestros clientes, productos y pedidos. 

Una buena forma de organizarlos es mediante tablas creadas con `SQL`
Crearemos nuiestras talas de Clientes, Productos y Pedidos:

```sql
CREATE TABLE Clientes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50),
    apellidos VARCHAR(50),
    telefono VARCHAR(15),
    email VARCHAR(100)
);
CREATE TABLE Productos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    descripcion TEXT,
    precio DECIMAL(10, 2),
    tamaño VARCHAR(20),
    peso DECIMAL(10, 2)
);
CREATE TABLE Pedidos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    fecha DATE,
    numero_pedido VARCHAR(20),
    Cliente_id INT,
    Productos_id INT,
    impuestos DECIMAL(10, 2),
    total DECIMAL(10, 2),
    FOREIGN KEY (Cliente_id) REFERENCES Clientes(id),
    FOREIGN KEY (Productos_id) REFERENCES Productos(id)
);
```
Una vez creadas las tablas, insertaremos algunos datos de ejemplo:

```sql
INSERT INTO Clientes (nombre, apellidos, telefono, email) VALUES
('Juan', 'Pérez', '123456789', 'juan.perez@example.com'),
('María', 'Gómez', '987654321', 'maria.gomez@example.com'),
('Carlos', 'López', '555666777', 'carlos.lopez@example.com');
INSERT INTO Productos (nombre, descripcion, precio, tamaño, peso) VALUES
('Producto A', 'Descripción del Producto A', 19.99, 'M', 1.5),
('Producto B', 'Descripción del Producto B', 29.99, 'L', 2.0),
('Producto C', 'Descripción del Producto C', 9.99, 'S', 0.5),
('Producto D', 'Descripción del Producto D', 49.99, 'XL', 3.0),
('Producto E', 'Descripción del Producto E', 15.99, 'M', 1.0);
```
Finalmente, realizaremos algunas consultas para obtener información relevante:

```sql
-- Consulta 1: Mostrar el nombre, apellidos y email de todos los clientes
SELECT nombre, apellidos, email FROM Clientes;

-- Consulta 2: Devolver el nombre del producto y su precio
SELECT nombre, precio FROM Productos;

-- Consulta 3: Listar todos los pedidos realizados en un determinado mes
SELECT * FROM Pedidos WHERE MONTH(fecha) = 1; -- Cambiar 1 por el mes deseado
```

De esta manera ya lo tenemos todo organizado para empezar a trabajar con nuestra base de datos y gestionar la informacion de nuestros clientes, productos y pedidos de manera eficiente.