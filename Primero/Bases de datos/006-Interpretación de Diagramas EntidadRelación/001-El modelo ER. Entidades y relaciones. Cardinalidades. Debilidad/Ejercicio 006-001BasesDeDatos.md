# EJERCICIO 006-001: MODELO ENTIDAD-RELACIÓN (ER)

**Alumno:** Darío Lacal | **Evaluación:** 1ª | **Rúbrica:** 4 secciones × 25%

---

## ENUNCIADO ORIGINAL

**Contexto:**
En esta unidad, estamos trabajando con el modelado de entidades y relaciones en bases de datos. Este concepto es fundamental para entender cómo estructurar y organizar los datos en una base de datos relacional. Vamos a trabajar en un caso práctico de una **tienda en línea**.

**Entidades a definir:**
1. **Cliente:** id, nombre, apellidos, email, direccion
2. **Producto:** id, nombre, precio, categoria_id
3. **Pedido:** id, fecha, cliente_id
4. **LineasPedido:** id, fecha, pedido_id, producto_id, cantidad
5. **Categoria:** id, nombre

**Tareas:**
1. Definir las entidades con sus atributos
2. Dibujar el diagrama ER con cardinalidades
3. Escribir el código SQL para crear las tablas
4. Insertar registros de ejemplo

---

## 1. INTRODUCCIÓN (25%)

### Objetivo
Diseñar un **modelo Entidad-Relación (ER)** completo para una tienda online, identificando:
- Entidades principales y sus atributos
- Relaciones entre entidades
- Cardinalidades (1:1, 1:N, N:M)
- Entidades débiles y fuertes
- Claves primarias y foráneas

### Contexto
El **modelo ER** es la base del diseño de bases de datos relacionales. Permite visualizar:
- Cómo se estructuran los datos
- Qué información necesita cada entidad
- Cómo se relacionan las diferentes partes del sistema

En este ejercicio modelamos una tienda online con clientes, productos, pedidos y categorías.

### Importancia
Un buen diagrama ER:
- ✅ Previene redundancia de datos
- ✅ Facilita la normalización
- ✅ Documenta el sistema visualmente
- ✅ Guía la implementación SQL

---

## 2. DESARROLLO (25%)

### A. Definición de Entidades y Atributos

**1. CLIENTE** (Entidad fuerte)
- **id** (PK, INT, AUTO_INCREMENT)
- nombre (VARCHAR(100), NOT NULL)
- apellidos (VARCHAR(100), NOT NULL)
- email (VARCHAR(100), UNIQUE, NOT NULL)
- direccion (TEXT)

**2. CATEGORIA** (Entidad fuerte)
- **id** (PK, INT, AUTO_INCREMENT)
- nombre (VARCHAR(50), UNIQUE, NOT NULL)

**3. PRODUCTO** (Entidad fuerte con FK)
- **id** (PK, INT, AUTO_INCREMENT)
- nombre (VARCHAR(100), NOT NULL)
- precio (DECIMAL(10,2), NOT NULL)
- categoria_id (FK → CATEGORIA, INT, NOT NULL)

**4. PEDIDO** (Entidad fuerte con FK)
- **id** (PK, INT, AUTO_INCREMENT)
- fecha (DATETIME, DEFAULT CURRENT_TIMESTAMP)
- cliente_id (FK → CLIENTE, INT, NOT NULL)

**5. LINEASPEDIDO** (Entidad débil - N:M)
- **id** (PK, INT, AUTO_INCREMENT)
- pedido_id (FK → PEDIDO, INT, NOT NULL)
- producto_id (FK → PRODUCTO, INT, NOT NULL)
- cantidad (INT, NOT NULL, CHECK > 0)

### B. Diagrama Entidad-Relación

```
┌──────────────┐
│  CATEGORIA   │
│──────────────│
│ PK id        │
│    nombre    │
└──────┬───────┘
       │
       │ 1
       │
       │ N
┌──────▼───────┐       N     ┌──────────────┐     N
│  PRODUCTO    │◄─────────────┤ LINEASPEDIDO │◄──────┐
│──────────────│              │──────────────│       │
│ PK id        │              │ PK id        │       │
│    nombre    │              │ FK pedido_id │       │
│    precio    │              │ FK producto_id│      │
│ FK categoria_id│            │    cantidad  │       │
└──────────────┘              └──────────────┘       │
                                     ▲               │
                                     │               │
                                     │ N             │ 1
                                     │               │
                              ┌──────┴───────┐       │
                              │   PEDIDO     │───────┘
                              │──────────────│
                              │ PK id        │
                              │    fecha     │
                              │ FK cliente_id│
                              └──────┬───────┘
                                     │
                                     │ N
                                     │
                                     │ 1
                              ┌──────▼───────┐
                              │   CLIENTE    │
                              │──────────────│
                              │ PK id        │
                              │    nombre    │
                              │    apellidos │
                              │    email     │
                              │    direccion │
                              └──────────────┘
```

### C. Relaciones y Cardinalidades

| Relación | Tipo | Cardinalidad | Descripción |
|----------|------|--------------|-------------|
| CATEGORIA → PRODUCTO | 1:N | Una categoría tiene muchos productos | ON DELETE RESTRICT |
| CLIENTE → PEDIDO | 1:N | Un cliente hace muchos pedidos | ON DELETE RESTRICT |
| PEDIDO → LINEASPEDIDO | 1:N | Un pedido tiene muchas líneas | ON DELETE CASCADE |
| PRODUCTO → LINEASPEDIDO | 1:N | Un producto aparece en muchas líneas | ON DELETE RESTRICT |
| PEDIDO ↔ PRODUCTO | N:M | Relación muchos a muchos via LINEASPEDIDO | Tabla intermedia |

### D. Código SQL - Crear Tablas

```sql
-- 1. Crear base de datos
CREATE DATABASE IF NOT EXISTS tienda_online;
USE tienda_online;

-- 2. Tabla CATEGORIA (sin dependencias)
CREATE TABLE Categoria (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) UNIQUE NOT NULL
);

-- 3. Tabla CLIENTE (sin dependencias)
CREATE TABLE Cliente (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    direccion TEXT
);

-- 4. Tabla PRODUCTO (depende de CATEGORIA)
CREATE TABLE Producto (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL CHECK (precio >= 0),
    categoria_id INT NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES Categoria(id)
        ON DELETE RESTRICT
);

-- 5. Tabla PEDIDO (depende de CLIENTE)
CREATE TABLE Pedido (
    id INT PRIMARY KEY AUTO_INCREMENT,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    cliente_id INT NOT NULL,
    FOREIGN KEY (cliente_id) REFERENCES Cliente(id)
        ON DELETE RESTRICT
);

-- 6. Tabla LINEASPEDIDO (depende de PEDIDO y PRODUCTO)
CREATE TABLE LineasPedido (
    id INT PRIMARY KEY AUTO_INCREMENT,
    pedido_id INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL CHECK (cantidad > 0),
    FOREIGN KEY (pedido_id) REFERENCES Pedido(id)
        ON DELETE CASCADE,
    FOREIGN KEY (producto_id) REFERENCES Producto(id)
        ON DELETE RESTRICT,
    UNIQUE KEY (pedido_id, producto_id)
);
```

---

## 3. APLICACIÓN PRÁCTICA (25%)

### Insertar Datos de Ejemplo

```sql
-- 1. Insertar categorías
INSERT INTO Categoria (nombre) VALUES
('Electrónica'),
('Ropa'),
('Hogar');

-- 2. Insertar clientes
INSERT INTO Cliente (nombre, apellidos, email, direccion) VALUES
('Juan', 'García López', 'juan@example.com', 'Calle Mayor 123, Madrid'),
('María', 'Rodríguez Pérez', 'maria@example.com', 'Avenida Diagonal 456, Barcelona'),
('Carlos', 'López Martínez', 'carlos@example.com', 'Plaza España 789, Valencia');

-- 3. Insertar productos
INSERT INTO Producto (nombre, precio, categoria_id) VALUES
('Laptop Dell', 899.99, 1),
('iPhone 14', 999.99, 1),
('Camiseta Nike', 29.99, 2),
('Pantalón Vaquero', 49.99, 2),
('Lámpara LED', 34.99, 3);

-- 4. Insertar pedidos
INSERT INTO Pedido (cliente_id, fecha) VALUES
(1, '2024-12-01 10:30:00'),
(2, '2024-12-02 14:15:00'),
(1, '2024-12-05 09:45:00');

-- 5. Insertar líneas de pedido
INSERT INTO LineasPedido (pedido_id, producto_id, cantidad) VALUES
-- Pedido 1 de Juan
(1, 1, 1),  -- 1 Laptop
(1, 3, 2),  -- 2 Camisetas
-- Pedido 2 de María
(2, 2, 1),  -- 1 iPhone
(2, 5, 1),  -- 1 Lámpara
-- Pedido 3 de Juan
(3, 4, 1);  -- 1 Pantalón
```

### Consultas de Verificación

**Consulta 1: Ver todos los pedidos con cliente**
```sql
SELECT 
    p.id AS pedido_id,
    c.nombre,
    c.apellidos,
    p.fecha,
    COUNT(lp.id) AS total_productos
FROM Pedido p
INNER JOIN Cliente c ON p.cliente_id = c.id
LEFT JOIN LineasPedido lp ON p.id = lp.pedido_id
GROUP BY p.id
ORDER BY p.fecha DESC;
```

**Consulta 2: Ver productos en un pedido específico**
```sql
SELECT 
    pr.nombre AS producto,
    cat.nombre AS categoria,
    lp.cantidad,
    pr.precio,
    (lp.cantidad * pr.precio) AS subtotal
FROM LineasPedido lp
INNER JOIN Producto pr ON lp.producto_id = pr.id
INNER JOIN Categoria cat ON pr.categoria_id = cat.id
WHERE lp.pedido_id = 1;
```

**Consulta 3: Productos por categoría**
```sql
SELECT 
    cat.nombre AS categoria,
    COUNT(pr.id) AS total_productos,
    AVG(pr.precio) AS precio_promedio
FROM Categoria cat
LEFT JOIN Producto pr ON cat.id = pr.categoria_id
GROUP BY cat.id;
```

**Consulta 4: Total gastado por cliente**
```sql
SELECT 
    c.nombre,
    c.apellidos,
    COUNT(p.id) AS total_pedidos,
    SUM(lp.cantidad * pr.precio) AS total_gastado
FROM Cliente c
LEFT JOIN Pedido p ON c.id = p.cliente_id
LEFT JOIN LineasPedido lp ON p.id = lp.pedido_id
LEFT JOIN Producto pr ON lp.producto_id = pr.id
GROUP BY c.id
ORDER BY total_gastado DESC;
```

---

## 4. CONCLUSIÓN (25%)

### Conceptos Aplicados

✅ **Entidades fuertes:** CLIENTE, CATEGORIA, PRODUCTO, PEDIDO (tienen identidad propia)  
✅ **Entidad débil:** LINEASPEDIDO (depende de PEDIDO y PRODUCTO)  
✅ **Relaciones 1:N:** CLIENTE→PEDIDO, CATEGORIA→PRODUCTO, PEDIDO→LINEASPEDIDO  
✅ **Relación N:M:** PEDIDO↔PRODUCTO (resuelta con tabla intermedia)  
✅ **Claves primarias:** Identificador único en cada tabla  
✅ **Claves foráneas:** Mantienen integridad referencial  

### Cardinalidades Implementadas

| Entidad A | Relación | Entidad B | Cardinalidad |
|-----------|----------|-----------|--------------|
| CATEGORIA | tiene | PRODUCTO | 1:N |
| CLIENTE | realiza | PEDIDO | 1:N |
| PEDIDO | contiene | LINEASPEDIDO | 1:N |
| PRODUCTO | aparece en | LINEASPEDIDO | 1:N |

### Integridad Referencial

- **ON DELETE RESTRICT:** No permite borrar categorías o clientes con datos dependientes
- **ON DELETE CASCADE:** Al borrar un pedido, borra automáticamente sus líneas
- **UNIQUE KEY:** Evita duplicados en (pedido_id, producto_id)
- **CHECK:** Valida cantidad > 0 y precio >= 0

### Normalización

Este diseño está en **3FN (Tercera Forma Normal)**:
1. No hay atributos multivalor
2. No hay dependencias parciales
3. No hay dependencias transitivas

### Aplicabilidad

Este modelo ER es aplicable a:
- Sistemas de comercio electrónico
- Gestión de inventarios
- Sistemas de facturación
- Plataformas de reservas

---

**Estado:** ✅ COMPLETADO | **Evaluación:** 1ª | **Fecha:** Diciembre 2024