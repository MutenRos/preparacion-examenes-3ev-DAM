# SOLUCIÓN EJERCICIO 004-004: BASES DE DATOS Y TRANSACCIONES

## Alumno: Darío Lacal
## Asignatura: Bases de Datos
## Evaluación: 1ª Evaluación

---

## 1. CREACIÓN DE LA BASE DE DATOS

### Paso 1: Crear la BD tiendaonline2526

```sql
-- Conectar a MySQL como root
-- mysql -u root -p

-- Crear la base de datos
CREATE DATABASE tiendaonline2526;

-- Cambiar al contexto de la base de datos
USE tiendaonline2526;
```

---

## 2. CREACIÓN DE TABLAS CON RELACIONES

### Tabla: categorias

```sql
CREATE TABLE categorias (
    id_categoria INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    CONSTRAINT uk_nombre_categoria UNIQUE (nombre)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### Tabla: clientes

```sql
CREATE TABLE clientes (
    id_cliente INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefono VARCHAR(20),
    direccion VARCHAR(255),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_nombre (nombre)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### Tabla: productos

```sql
CREATE TABLE productos (
    id_producto INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT,
    precio_unitario DECIMAL(10, 2) NOT NULL,
    id_categoria INT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria) ON DELETE RESTRICT,
    INDEX idx_nombre_producto (nombre),
    INDEX idx_categoria (id_categoria)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### Tabla: gestion_stock

```sql
CREATE TABLE gestion_stock (
    id_stock INT PRIMARY KEY AUTO_INCREMENT,
    id_producto INT NOT NULL UNIQUE,
    cantidad_disponible INT DEFAULT 0,
    cantidad_minima INT DEFAULT 10,
    cantidad_maxima INT DEFAULT 1000,
    ultima_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto) ON DELETE CASCADE,
    INDEX idx_disponibilidad (cantidad_disponible)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### Tabla: pedidos

```sql
CREATE TABLE pedidos (
    id_pedido INT PRIMARY KEY AUTO_INCREMENT,
    id_cliente INT NOT NULL,
    fecha_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('pendiente', 'procesando', 'enviado', 'entregado', 'cancelado') DEFAULT 'pendiente',
    total DECIMAL(12, 2) DEFAULT 0,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente) ON DELETE RESTRICT,
    INDEX idx_cliente (id_cliente),
    INDEX idx_estado (estado),
    INDEX idx_fecha (fecha_pedido)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### Tabla: lineas_pedido (Relación N:M)

```sql
CREATE TABLE lineas_pedido (
    id_linea INT PRIMARY KEY AUTO_INCREMENT,
    id_pedido INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL DEFAULT 1,
    precio_unitario DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(12, 2) GENERATED ALWAYS AS (cantidad * precio_unitario) STORED,
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido) ON DELETE CASCADE,
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto) ON DELETE RESTRICT,
    INDEX idx_pedido (id_pedido),
    INDEX idx_producto (id_producto),
    UNIQUE KEY uk_pedido_producto (id_pedido, id_producto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

---

## 3. INSERCIÓN DE DATOS

### 3.1 Insertar Categorías

```sql
INSERT INTO categorias (nombre, descripcion) VALUES
('Electrónica', 'Productos electrónicos y tecnología'),
('Ropa', 'Prendas de vestir para hombre, mujer y niños'),
('Hogar', 'Artículos para el hogar y decoración'),
('Deportes', 'Equipamiento y ropa deportiva'),
('Libros', 'Libros físicos y audiobooks');
```

### 3.2 Insertar Clientes

```sql
INSERT INTO clientes (nombre, email, telefono, direccion) VALUES
('Juan García López', 'juan.garcia@email.com', '634512345', 'Calle Principal 123, Madrid'),
('María Rodríguez Martín', 'maria.rodriguez@email.com', '645678901', 'Avenida Central 456, Barcelona'),
('Carlos López Pérez', 'carlos.lopez@email.com', '698765432', 'Plaza Mayor 789, Valencia'),
('Ana Martínez González', 'ana.martinez@email.com', '612345678', 'Calle Secundaria 321, Sevilla'),
('Pedro Sánchez Ruiz', 'pedro.sanchez@email.com', '623456789', 'Paseo de los Ángeles 654, Bilbao');
```

### 3.3 Insertar Productos

```sql
INSERT INTO productos (nombre, descripcion, precio_unitario, id_categoria) VALUES
-- Electrónica
('Laptop Dell XPS 13', 'Laptop ultraligera con procesador Intel i7', 1299.99, 1),
('iPhone 15 Pro', 'Smartphone Apple con cámara triple', 999.99, 1),
('AirPods Pro', 'Auriculares inalámbricos con cancelación de ruido', 249.99, 1),

-- Ropa
('Camiseta Básica Azul', 'Camiseta de algodón 100% azul marino', 19.99, 2),
('Pantalón Vaquero Premium', 'Pantalón vaquero ajustado color azul oscuro', 59.99, 2),
('Sudadera Gris Oscuro', 'Sudadera de algodón cómoda y cálida', 39.99, 2),

-- Hogar
('Almohada Memoria', 'Almohada con espuma viscoelástica', 49.99, 3),
('Sábanas de Algodón', 'Juego de sábanas blancas 100% algodón', 34.99, 3),
('Lámpara LED Moderna', 'Lámpara de pie LED con control remoto', 89.99, 3),

-- Deportes
('Zapatillas Running Nike', 'Zapatillas deportivas para correr', 129.99, 4),
('Mochila Deportiva', 'Mochila de 30L para deporte y viajes', 49.99, 4),
('Banda de Resistencia', 'Set de bandas elásticas para ejercicio', 24.99, 4),

-- Libros
('El Quijote', 'Novela clásica de Miguel de Cervantes', 14.99, 5),
('Clean Code', 'Guía de código limpio para desarrolladores', 39.99, 5),
('Sapiens', 'Historia breve de la humanidad', 19.99, 5);
```

### 3.4 Insertar Stock (Gestión de inventario)

```sql
INSERT INTO gestion_stock (id_producto, cantidad_disponible, cantidad_minima, cantidad_maxima) VALUES
(1, 15, 3, 50),      -- Laptop
(2, 25, 5, 100),     -- iPhone
(3, 40, 10, 150),    -- AirPods
(4, 200, 20, 500),   -- Camiseta
(5, 120, 15, 400),   -- Pantalón
(6, 85, 15, 300),    -- Sudadera
(7, 60, 10, 200),    -- Almohada
(8, 95, 20, 300),    -- Sábanas
(9, 30, 5, 100),     -- Lámpara
(10, 50, 10, 200),   -- Zapatillas
(11, 75, 10, 250),   -- Mochila
(12, 120, 15, 400),  -- Banda resistencia
(13, 180, 30, 500),  -- El Quijote
(14, 45, 10, 150),   -- Clean Code
(15, 70, 15, 200);   -- Sapiens
```

### 3.5 Insertar Pedidos

```sql
INSERT INTO pedidos (id_cliente, estado) VALUES
(1, 'procesando'),      -- Pedido 1: Juan
(2, 'entregado'),       -- Pedido 2: María
(3, 'pendiente'),       -- Pedido 3: Carlos
(1, 'enviado'),         -- Pedido 4: Juan (segundo pedido)
(4, 'entregado'),       -- Pedido 5: Ana
(5, 'pendiente');       -- Pedido 6: Pedro
```

### 3.6 Insertar Líneas de Pedido (Detalles de productos en pedidos)

```sql
INSERT INTO lineas_pedido (id_pedido, id_producto, cantidad, precio_unitario) VALUES
-- Pedido 1: Juan (Laptop, Camiseta, AirPods)
(1, 1, 1, 1299.99),    -- 1x Laptop
(1, 4, 2, 19.99),      -- 2x Camiseta

-- Pedido 2: María (iPhone, Zapatillas, Libros)
(2, 2, 1, 999.99),     -- 1x iPhone
(2, 10, 1, 129.99),    -- 1x Zapatillas
(2, 15, 1, 19.99),     -- 1x Sapiens

-- Pedido 3: Carlos (Pantalón, Almohada, Mochila)
(3, 5, 2, 59.99),      -- 2x Pantalón
(3, 7, 1, 49.99),      -- 1x Almohada

-- Pedido 4: Juan (Sudadera, Banda resistencia)
(4, 6, 1, 39.99),      -- 1x Sudadera
(4, 12, 2, 24.99),     -- 2x Banda resistencia

-- Pedido 5: Ana (Sábanas, Lámpara, Clean Code)
(5, 8, 1, 34.99),      -- 1x Sábanas
(5, 9, 1, 89.99),      -- 1x Lámpara
(5, 14, 1, 39.99),     -- 1x Clean Code

-- Pedido 6: Pedro (El Quijote, Mochila, AirPods)
(6, 13, 1, 14.99),     -- 1x El Quijote
(6, 11, 1, 49.99),     -- 1x Mochila
(6, 3, 1, 249.99);     -- 1x AirPods
```

### 3.7 Actualizar totales de pedidos (Con transacción)

```sql
-- Actualizar el total de cada pedido sumando sus líneas
START TRANSACTION;

UPDATE pedidos SET total = (
    SELECT SUM(subtotal) FROM lineas_pedido WHERE id_pedido = pedidos.id_pedido
);

COMMIT;
```

---

## 4. VERIFICACIÓN DE DATOS E INTEGRIDAD

### 4.1 Verificar que se insertaron correctamente las tablas

```sql
-- Ver todas las categorías
SELECT * FROM categorias;

-- Ver todos los clientes
SELECT * FROM clientes;

-- Ver todos los productos
SELECT * FROM productos;

-- Ver gestión de stock
SELECT * FROM gestion_stock;

-- Ver pedidos
SELECT * FROM pedidos;

-- Ver líneas de pedido
SELECT * FROM lineas_pedido;
```

**Resultado esperado:**
- 5 categorías insertadas
- 5 clientes registrados
- 15 productos en catálogo
- 15 registros de stock
- 6 pedidos
- 13 líneas de pedido

### 4.2 Verificar relaciones foráneas

```sql
-- Consulta: Mostrar un pedido completo con cliente y detalles
SELECT 
    p.id_pedido,
    c.nombre AS cliente,
    c.email,
    p.fecha_pedido,
    p.estado,
    p.total,
    COUNT(lp.id_linea) AS cantidad_productos
FROM pedidos p
JOIN clientes c ON p.id_cliente = c.id_cliente
LEFT JOIN lineas_pedido lp ON p.id_pedido = lp.id_pedido
GROUP BY p.id_pedido, c.id_cliente, c.nombre, c.email, p.fecha_pedido, p.estado, p.total
ORDER BY p.fecha_pedido DESC;
```

### 4.3 Consulta: Pedidos de un cliente específico

```sql
-- Todos los pedidos del cliente Juan García López
SELECT 
    p.id_pedido,
    p.fecha_pedido,
    p.estado,
    p.total,
    COUNT(lp.id_linea) AS cantidad_articulos
FROM pedidos p
LEFT JOIN lineas_pedido lp ON p.id_pedido = lp.id_pedido
WHERE p.id_cliente = (SELECT id_cliente FROM clientes WHERE nombre = 'Juan García López')
GROUP BY p.id_pedido, p.fecha_pedido, p.estado, p.total;
```

### 4.4 Consulta: Stock disponible de un producto

```sql
-- Stock disponible para el producto iPhone 15 Pro
SELECT 
    pr.nombre,
    pr.precio_unitario,
    gs.cantidad_disponible,
    gs.cantidad_minima,
    gs.cantidad_maxima,
    CASE 
        WHEN gs.cantidad_disponible <= gs.cantidad_minima THEN 'Stock bajo - REORDEN'
        WHEN gs.cantidad_disponible >= gs.cantidad_maxima THEN 'Stock alto'
        ELSE 'Stock normal'
    END AS estado_stock
FROM productos pr
JOIN gestion_stock gs ON pr.id_producto = gs.id_producto
WHERE pr.nombre LIKE '%iPhone%';
```

### 4.5 Consulta: Resumen de ventas por categoría

```sql
-- Ventas totales por categoría
SELECT 
    c.nombre AS categoria,
    COUNT(DISTINCT p.id_pedido) AS numero_pedidos,
    COUNT(lp.id_linea) AS cantidad_articulos,
    SUM(lp.subtotal) AS ventas_totales,
    AVG(lp.subtotal) AS venta_promedio
FROM categorias c
LEFT JOIN productos pr ON c.id_categoria = pr.id_categoria
LEFT JOIN lineas_pedido lp ON pr.id_producto = lp.id_producto
LEFT JOIN pedidos p ON lp.id_pedido = p.id_pedido
GROUP BY c.id_categoria, c.nombre
ORDER BY ventas_totales DESC;
```

### 4.6 Consulta: Detalle completo de un pedido

```sql
-- Pedido 1 con todos los detalles
SELECT 
    p.id_pedido,
    c.nombre AS cliente,
    c.email,
    c.telefono,
    pr.nombre AS producto,
    cat.nombre AS categoria,
    lp.cantidad,
    lp.precio_unitario,
    lp.subtotal,
    p.estado,
    p.total
FROM pedidos p
JOIN clientes c ON p.id_cliente = c.id_cliente
JOIN lineas_pedido lp ON p.id_pedido = lp.id_pedido
JOIN productos pr ON lp.id_producto = pr.id_producto
JOIN categorias cat ON pr.id_categoria = cat.id_categoria
WHERE p.id_pedido = 1
ORDER BY lp.id_linea;
```

---

## 5. APLICACIÓN PHP PARA MOSTRAR PEDIDOS

### archivo: index.php

```php
<?php
// Configuración de conexión a la base de datos
$host = 'localhost';
$usuario = 'root';
$contrasena = '';
$base_datos = 'tiendaonline2526';

// Crear conexión
$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Configurar charset a UTF-8
$conexion->set_charset("utf8mb4");

// Obtener lista de pedidos
$sql_pedidos = "
    SELECT 
        p.id_pedido,
        c.nombre AS cliente,
        p.fecha_pedido,
        p.estado,
        p.total,
        COUNT(lp.id_linea) AS cantidad_articulos
    FROM pedidos p
    JOIN clientes c ON p.id_cliente = c.id_cliente
    LEFT JOIN lineas_pedido lp ON p.id_pedido = lp.id_pedido
    GROUP BY p.id_pedido, c.id_cliente, c.nombre, p.fecha_pedido, p.estado, p.total
    ORDER BY p.fecha_pedido DESC
";

$resultado = $conexion->query($sql_pedidos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tienda Online - Pedidos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 1.1em;
            opacity: 0.9;
        }

        .content {
            padding: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table thead {
            background-color: #f8f9fa;
            border-bottom: 2px solid #667eea;
        }

        table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #333;
        }

        table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e9ecef;
        }

        table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .estado {
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: 600;
            display: inline-block;
        }

        .estado.pendiente {
            background-color: #ffeaa7;
            color: #d63031;
        }

        .estado.procesando {
            background-color: #74b9ff;
            color: #0984e3;
        }

        .estado.enviado {
            background-color: #a29bfe;
            color: #6c5ce7;
        }

        .estado.entregado {
            background-color: #55efc4;
            color: #00b894;
        }

        .estado.cancelado {
            background-color: #fab1a0;
            color: #e17055;
        }

        .precio {
            font-weight: 600;
            color: #667eea;
        }

        .btn-detalles {
            padding: 8px 15px;
            background-color: #667eea;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9em;
            transition: background-color 0.3s;
        }

        .btn-detalles:hover {
            background-color: #764ba2;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 10px;
            max-width: 700px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 15px;
        }

        .modal-header h2 {
            color: #667eea;
        }

        .btn-cerrar {
            background: none;
            border: none;
            font-size: 1.5em;
            cursor: pointer;
            color: #666;
        }

        .btn-cerrar:hover {
            color: #000;
        }

        .detalle-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .detalle-label {
            font-weight: 600;
            color: #333;
        }

        .detalle-valor {
            color: #667eea;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #666;
            border-top: 1px solid #e9ecef;
        }

        .estadisticas {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .estadistica-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .estadistica-card h3 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .estadistica-card p {
            font-size: 0.9em;
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🛒 Tienda Online 25-26</h1>
            <p>Sistema de Gestión de Pedidos</p>
        </div>

        <div class="content">
            <!-- Estadísticas -->
            <div class="estadisticas">
                <div class="estadistica-card">
                    <h3><?php echo $resultado->num_rows; ?></h3>
                    <p>Pedidos Totales</p>
                </div>
                <div class="estadistica-card">
                    <h3><?php 
                        $resultado->data_seek(0);
                        $pedidos_entregados = 0;
                        while($row = $resultado->fetch_assoc()) {
                            if($row['estado'] == 'entregado') $pedidos_entregados++;
                        }
                        echo $pedidos_entregados;
                    ?></h3>
                    <p>Pedidos Entregados</p>
                </div>
                <div class="estadistica-card">
                    <h3><?php 
                        $sql_total = "SELECT SUM(total) as total_ventas FROM pedidos";
                        $res_total = $conexion->query($sql_total);
                        $row_total = $res_total->fetch_assoc();
                        echo number_format($row_total['total_ventas'], 2);
                    ?>€</h3>
                    <p>Ventas Totales</p>
                </div>
            </div>

            <!-- Tabla de Pedidos -->
            <h2>Pedidos Registrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID Pedido</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Artículos</th>
                        <th>Total</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $resultado->data_seek(0);
                    while($row = $resultado->fetch_assoc()) {
                        $fecha = date('d/m/Y H:i', strtotime($row['fecha_pedido']));
                        $estado = $row['estado'];
                        ?>
                        <tr>
                            <td>#<?php echo $row['id_pedido']; ?></td>
                            <td><?php echo $row['cliente']; ?></td>
                            <td><?php echo $fecha; ?></td>
                            <td>
                                <span class="estado <?php echo $estado; ?>">
                                    <?php echo ucfirst($estado); ?>
                                </span>
                            </td>
                            <td><?php echo $row['cantidad_articulos']; ?></td>
                            <td class="precio"><?php echo number_format($row['total'], 2); ?>€</td>
                            <td>
                                <button class="btn-detalles" onclick="mostrarDetalles(<?php echo $row['id_pedido']; ?>)">
                                    Ver Detalles
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="footer">
            <p>© 2025 Tienda Online - Proyecto Bases de Datos DAM 25-26 | Darío Lacal</p>
        </div>
    </div>

    <!-- Modal para detalles del pedido -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Detalles del Pedido</h2>
                <button class="btn-cerrar" onclick="cerrarModal()">×</button>
            </div>
            <div id="detalles-contenido"></div>
        </div>
    </div>

    <script>
        function mostrarDetalles(idPedido) {
            // AJAX para obtener detalles del pedido
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'detalles_pedido.php?id=' + idPedido, true);
            xhr.onload = function() {
                if(xhr.status === 200) {
                    document.getElementById('detalles-contenido').innerHTML = xhr.responseText;
                    document.getElementById('modal').classList.add('active');
                }
            };
            xhr.send();
        }

        function cerrarModal() {
            document.getElementById('modal').classList.remove('active');
        }

        // Cerrar modal al hacer clic fuera
        document.getElementById('modal').addEventListener('click', function(event) {
            if(event.target === this) {
                cerrarModal();
            }
        });
    </script>
</body>
</html>
```

### archivo: detalles_pedido.php

```php
<?php
// Configuración de conexión
$host = 'localhost';
$usuario = 'root';
$contrasena = '';
$base_datos = 'tiendaonline2526';

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);
$conexion->set_charset("utf8mb4");

if($_GET['id']) {
    $id_pedido = (int)$_GET['id'];
    
    $sql = "
        SELECT 
            p.id_pedido,
            c.nombre AS cliente,
            c.email,
            c.telefono,
            c.direccion,
            p.fecha_pedido,
            p.estado,
            p.total,
            pr.nombre AS producto,
            cat.nombre AS categoria,
            lp.cantidad,
            lp.precio_unitario,
            lp.subtotal
        FROM pedidos p
        JOIN clientes c ON p.id_cliente = c.id_cliente
        JOIN lineas_pedido lp ON p.id_pedido = lp.id_pedido
        JOIN productos pr ON lp.id_producto = pr.id_producto
        JOIN categorias cat ON pr.id_categoria = cat.id_categoria
        WHERE p.id_pedido = $id_pedido
        ORDER BY lp.id_linea
    ";
    
    $resultado = $conexion->query($sql);
    
    if($resultado->num_rows > 0) {
        $primer_row = $resultado->fetch_assoc();
        $resultado->data_seek(0);
        
        echo "<div class='detalle-item'>";
        echo "<span class='detalle-label'>ID Pedido:</span>";
        echo "<span class='detalle-valor'>#" . $primer_row['id_pedido'] . "</span>";
        echo "</div>";
        
        echo "<div class='detalle-item'>";
        echo "<span class='detalle-label'>Cliente:</span>";
        echo "<span class='detalle-valor'>" . $primer_row['cliente'] . "</span>";
        echo "</div>";
        
        echo "<div class='detalle-item'>";
        echo "<span class='detalle-label'>Email:</span>";
        echo "<span class='detalle-valor'>" . $primer_row['email'] . "</span>";
        echo "</div>";
        
        echo "<div class='detalle-item'>";
        echo "<span class='detalle-label'>Teléfono:</span>";
        echo "<span class='detalle-valor'>" . $primer_row['telefono'] . "</span>";
        echo "</div>";
        
        echo "<div class='detalle-item'>";
        echo "<span class='detalle-label'>Dirección:</span>";
        echo "<span class='detalle-valor'>" . $primer_row['direccion'] . "</span>";
        echo "</div>";
        
        echo "<div class='detalle-item'>";
        echo "<span class='detalle-label'>Fecha:</span>";
        echo "<span class='detalle-valor'>" . date('d/m/Y H:i', strtotime($primer_row['fecha_pedido'])) . "</span>";
        echo "</div>";
        
        echo "<div class='detalle-item'>";
        echo "<span class='detalle-label'>Estado:</span>";
        echo "<span class='detalle-valor'>" . ucfirst($primer_row['estado']) . "</span>";
        echo "</div>";
        
        echo "<hr style='margin: 20px 0; border: 1px solid #e9ecef;'>";
        
        echo "<h3 style='color: #667eea; margin-bottom: 15px;'>Productos en el Pedido</h3>";
        
        $resultado->data_seek(0);
        while($row = $resultado->fetch_assoc()) {
            echo "<div style='background: #f8f9fa; padding: 10px; margin-bottom: 10px; border-radius: 5px;'>";
            echo "<div class='detalle-item'>";
            echo "<strong>" . $row['producto'] . "</strong>";
            echo "</div>";
            echo "<div class='detalle-item'>";
            echo "<span>Categoría:</span>";
            echo "<span>" . $row['categoria'] . "</span>";
            echo "</div>";
            echo "<div class='detalle-item'>";
            echo "<span>Cantidad:</span>";
            echo "<span>" . $row['cantidad'] . " x " . number_format($row['precio_unitario'], 2) . "€</span>";
            echo "</div>";
            echo "<div class='detalle-item'>";
            echo "<strong>Subtotal:</strong>";
            echo "<strong>" . number_format($row['subtotal'], 2) . "€</strong>";
            echo "</div>";
            echo "</div>";
        }
        
        echo "<hr style='margin: 20px 0; border: 2px solid #667eea;'>";
        
        echo "<div class='detalle-item' style='font-size: 1.2em;'>";
        echo "<strong>TOTAL PEDIDO:</strong>";
        echo "<strong style='color: #667eea;'>" . number_format($primer_row['total'], 2) . "€</strong>";
        echo "</div>";
    }
}
?>
```

---

## 6. REFLEXIÓN Y CONCLUSIONES

### 6.1 Importancia de las Relaciones entre Tablas

Las relaciones foráneas permiten:
- ✅ **Integridad referencial:** No se pueden eliminar clientes con pedidos activos
- ✅ **Evitar redundancia:** Almacenar nombre del cliente solo una vez
- ✅ **Consultas eficientes:** JOINs para obtener información completa
- ✅ **Actualización centralizada:** Cambiar precio de un producto una sola vez

### 6.2 Aplicación en Proyectos Complejos

Este modelo puede escalarse para:
- Agregar usuarios administrativos
- Implementar carrito de compras
- Añadir facturación y pagos
- Incluir historial de cambios
- Crear reportes de ventas

### 6.3 Transacciones ACID

- **Atomicidad:** Actualizar el total del pedido como unidad
- **Consistencia:** Mantener integridad de datos
- **Aislamiento:** Prevenir condiciones de carrera
- **Durabilidad:** Persistencia de datos en disco

---

**Fin de la solución - Ejercicio 004-004 Completado ✓**
