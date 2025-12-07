# EJERCICIO 004-004: BASES DE DATOS Y TRANSACCIONES

**Alumno:** Darío Lacal | **Evaluación:** 1ª | **Rúbrica:** 4 secciones × 25%  
**Criterios de Evaluación:** 4.a, 4.b, 4.e, 4.f, 4.h

---

## ENUNCIADO ORIGINAL

Para practicar el concepto impartido en clase sobre bases de datos y relaciones entre tablas, sigue estos pasos:

### Creación de la Base de Datos:
- Abre tu terminal o línea de comandos
- Ejecuta el comando `sudo mysql -u root -p` para iniciar sesión como usuario root en MySQL
- Crea una nueva base de datos llamada tiendaonline2526 utilizando `CREATE DATABASE tiendaonline2526;`
- Cambia al contexto con `USE tiendaonline2526;`

### Creación de Tablas:
- Utiliza los scripts en 02-crear-tablas.sql para crear las tablas necesarias (categorias, clientes, productos, gestion_stock, pedidos, y lineas_pedido)
- Asegúrate de que cada tabla esté correctamente relacionada con las demás

### Inserción de Datos:
- Ejecuta el script 07-insertar-datos.sql para cargar los datos iniciales
- Verifica que los datos se hayan insertado correctamente con comandos como `SELECT * FROM categorias;`

### Pruebas y Consultas:
- Realiza consultas para verificar la integridad y relaciones entre tablas
- Consulta los pedidos realizados por un cliente específico
- Verifica el stock disponible de un producto
- Asegúrate de que las relaciones foráneas estén funcionando correctamente

### Aplicación Práctica:
- Realiza una aplicación simple que muestre la información de los pedidos
- Incluye el nombre del cliente, detalles del producto y el estado del pedido
- Puedes usar PHP o Python para interactuar con la base de datos

---

## 1. INTRODUCCIÓN BREVE Y CONTEXTUALIZACIÓN (25%)

### Objetivo y Contexto

Este ejercicio responde al **Criterio de Evaluación 4: "Modifica la información almacenada en la base de datos"**, abordando específicamente:
- **4.a)** Identificar herramientas y sentencias para modificar el contenido de la BD
- **4.b)** Insertar, borrar y actualizar datos en las tablas
- **4.e)** Reconocer el funcionamiento de las transacciones
- **4.f)** Anular parcial o totalmente los cambios por transacciones
- **4.h)** Adoptar medidas para mantener integridad y consistencia

### Justificación del Proyecto

Se ha diseñado un **Sistema de Gestión de Tienda Online (tiendaonline2526)** como contexto realista para demostrar:

1. **Normalización 3NF:** Eliminación de redundancias mediante descomposición de tablas
2. **Relaciones complejas:** 
   - 1:N (cliente → múltiples pedidos)
   - N:M (pedidos ↔ productos via tabla junción)
   - 1:1 (producto → gestión de stock)
3. **Manipulación de datos:** INSERT, UPDATE, DELETE con integridad referencial
4. **Transacciones ACID:** Garantizar operaciones atómicas y consistentes
5. **Integridad de datos:** Claves foráneas, constraints, y triggers

### Conexión con la Teoría

Las **transacciones** son cruciales en sistemas de producción porque garantizan que operaciones complejas (ej: registrar un pedido, decrementar stock, guardar estado) **ocurren todas o ninguna**. Sin transacciones, un fallo a mitad de la operación dejaría datos inconsistentes.

Ejemplo: Si un cliente confirma compra pero fallan por stock insuficiente:
- SIN transacción: Pedido creado + stock NO decrementado = inconsistencia
- CON transacción: Todo se revierte (ROLLBACK) si hay error

---

## 2. DESARROLLO DETALLADO Y PRECISO (25%)

### A. Estructura de la Base de Datos (Criterio 4.a)

#### Base de Datos Principal
```sql
CREATE DATABASE tiendaonline2526 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;
```

#### Tablas Diseñadas (6 tablas con 59 registros totales)

**1. Tabla `categorias`** (5 registros)
```sql
CREATE TABLE categorias (
    id_categoria INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) UNIQUE NOT NULL,
    descripcion TEXT,
    activa BOOLEAN DEFAULT TRUE,
    COMMENT='Categorización de productos disponibles'
);
```
Registros:
- Electrónica, Ropa, Hogar, Deportes, Libros

**2. Tabla `clientes`** (5 registros)
```sql
CREATE TABLE clientes (
    id_cliente INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(150) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telefono VARCHAR(20),
    ciudad VARCHAR(50),
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
    COMMENT='Clientes registrados en el sistema'
);
```
Registros:
- Juan García López (juan@example.com) - 600123456
- María Rodríguez Pérez (maria@example.com) - 610234567
- Carlos López Martínez (carlos@example.com) - 620345678
- Ana Martínez García (ana@example.com) - 630456789
- Pedro Sánchez López (pedro@example.com) - 640567890

**3. Tabla `productos`** (15 registros con FK a categorias)
```sql
CREATE TABLE productos (
    id_producto INT PRIMARY KEY AUTO_INCREMENT,
    id_categoria INT NOT NULL,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria) 
        ON DELETE RESTRICT,
    INDEX idx_categoria (id_categoria),
    COMMENT='Catálogo de productos con relación a categorías'
);
```
Ejemplos de productos:
- Laptop Dell 15" (1299.99€) - Electrónica
- iPhone 14 Pro (999.99€) - Electrónica
- Sudadera Deportiva (39.99€) - Ropa
- Monitor LG 27" (349.99€) - Electrónica
- Python para Dummies (34.99€) - Libros

**4. Tabla `gestion_stock`** (15 registros, 1:1 con productos)
```sql
CREATE TABLE gestion_stock (
    id_gestion INT PRIMARY KEY AUTO_INCREMENT,
    id_producto INT UNIQUE NOT NULL,
    cantidad_disponible INT DEFAULT 0,
    cantidad_minima INT DEFAULT 10,
    cantidad_maxima INT DEFAULT 1000,
    ubicacion VARCHAR(50),
    ultima_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto) 
        ON DELETE CASCADE,
    COMMENT='Control de inventario, 1:1 con productos'
);
```
Características:
- Cantidad disponible para cada producto
- Umbrales mínimo/máximo para alertas
- Ubicación física en almacén
- Timestamp de última actualización

**5. Tabla `pedidos`** (6 registros con FK a clientes)
```sql
CREATE TABLE pedidos (
    id_pedido INT PRIMARY KEY AUTO_INCREMENT,
    id_cliente INT NOT NULL,
    fecha_pedido DATETIME DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(12, 2),
    estado ENUM('pendiente', 'procesando', 'enviado', 'entregado', 'cancelado') 
        DEFAULT 'pendiente',
    fecha_entrega DATE,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente) 
        ON DELETE RESTRICT,
    INDEX idx_cliente (id_cliente),
    INDEX idx_fecha (fecha_pedido),
    COMMENT='Pedidos de clientes con relación 1:N'
);
```
Estados de pedidos incluidos:
- Pendiente (sin procesar)
- Procesando (en preparación)
- Enviado (en tránsito)
- Entregado (completado)
- Cancelado (rechazado)

**6. Tabla `lineas_pedido`** (13 registros, N:M entre pedidos y productos)
```sql
CREATE TABLE lineas_pedido (
    id_linea INT PRIMARY KEY AUTO_INCREMENT,
    id_pedido INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL CHECK (cantidad > 0),
    precio_unitario DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(12, 2) GENERATED ALWAYS AS 
        (cantidad * precio_unitario) STORED,
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido) 
        ON DELETE CASCADE,
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto) 
        ON DELETE RESTRICT,
    UNIQUE KEY uk_pedido_producto (id_pedido, id_producto),
    COMMENT='Detalles de cada producto en cada pedido (N:M)'
);
```
Características:
- Campo `subtotal` generado automáticamente
- Constraint para cantidad > 0
- Índice UNIQUE para evitar duplicados
- ON DELETE CASCADE permite borrar pedidos con sus líneas

### B. Inserción de Datos (Criterio 4.b - INSERT)

Datos de prueba insertados en orden respetando dependencias:

```sql
-- 1. Categorías (no tiene dependencias)
INSERT INTO categorias (nombre, descripcion) VALUES
('Electrónica', 'Dispositivos y accesorios electrónicos'),
('Ropa', 'Prendas de vestir y accesorios'),
('Hogar', 'Artículos para el hogar'),
('Deportes', 'Equipamiento deportivo'),
('Libros', 'Material editorial y publicaciones');

-- 2. Clientes (no tiene dependencias)
INSERT INTO clientes (nombre, email, telefono, ciudad) VALUES
('Juan García López', 'juan@example.com', '600123456', 'Madrid'),
('María Rodríguez Pérez', 'maria@example.com', '610234567', 'Barcelona'),
('Carlos López Martínez', 'carlos@example.com', '620345678', 'Valencia'),
('Ana Martínez García', 'ana@example.com', '630456789', 'Sevilla'),
('Pedro Sánchez López', 'pedro@example.com', '640567890', 'Bilbao');

-- 3. Productos (depende de categorías)
INSERT INTO productos (id_categoria, nombre, precio) VALUES
(1, 'Laptop Dell 15"', 1299.99),
(1, 'iPhone 14 Pro', 999.99),
(1, 'AirPods Pro', 279.99),
(1, 'Monitor LG 27"', 349.99),
(1, 'Teclado Mecánico', 129.99),
(2, 'Sudadera Deportiva', 39.99),
(2, 'Pantalón Vaquero', 59.99),
(2, 'Camiseta Casual', 24.99),
(4, 'Zapatos Deportivos', 89.99),
(3, 'Almohada Ergonómica', 34.99),
(3, 'Mantas Térmicas', 44.99),
(3, 'Lámpara LED', 29.99),
(5, 'Python para Dummies', 34.99),
(5, 'SQL Avanzado', 39.99),
(5, 'Gestión Empresarial', 44.99);

-- 4. Gestión de Stock (depende de productos)
INSERT INTO gestion_stock (id_producto, cantidad_disponible, cantidad_minima) VALUES
(1, 8, 2), (2, 5, 2), (3, 15, 5), (4, 12, 3), (5, 20, 5),
(6, 50, 10), (7, 35, 10), (8, 45, 15), (9, 18, 5), (10, 22, 5),
(11, 16, 5), (12, 30, 10), (13, 25, 10), (14, 18, 8), (15, 12, 5);

-- 5. Pedidos (depende de clientes)
INSERT INTO pedidos (id_cliente, estado, total) VALUES
(1, 'entregado', 2890.95),
(2, 'entregado', 149.97),
(3, 'procesando', 494.95),
(4, 'pendiente', 1299.99),
(5, 'enviado', 229.96),
(1, 'entregado', 279.99);

-- 6. Líneas de Pedido (depende de pedidos y productos)
INSERT INTO lineas_pedido (id_pedido, id_producto, cantidad, precio_unitario) VALUES
-- Pedido 1
(1, 1, 1, 1299.99), (1, 6, 2, 39.99), (1, 13, 1, 34.99), (1, 15, 1, 44.99),
-- Pedido 2
(2, 8, 3, 24.99), (2, 10, 2, 34.99),
-- Pedido 3
(3, 2, 1, 999.99), (3, 9, 1, 89.99), (3, 12, 1, 29.99),
-- Pedido 4
(4, 1, 1, 1299.99),
-- Pedido 5
(5, 3, 1, 279.99), (5, 14, 1, 39.99),
-- Pedido 6
(6, 3, 1, 279.99);
```

**Total de registros insertados:** 59 (5+5+15+15+6+13)

### C. Actualización de Datos (Criterio 4.b - UPDATE)

Actualizaciones frecuentes en operaciones:

```sql
-- 1. Decrementar stock al procesar pedido
UPDATE gestion_stock 
SET cantidad_disponible = cantidad_disponible - 2
WHERE id_producto = 6;  -- Sudadera

-- 2. Cambiar estado de pedido a "enviado"
UPDATE pedidos 
SET estado = 'enviado', fecha_entrega = DATE_ADD(NOW(), INTERVAL 5 DAY)
WHERE id_pedido = 3;

-- 3. Actualizar total del pedido basado en líneas
UPDATE pedidos p
SET total = (SELECT SUM(subtotal) FROM lineas_pedido WHERE id_pedido = p.id_pedido)
WHERE id_pedido = 1;

-- 4. Cambiar email de cliente
UPDATE clientes 
SET email = 'juan.garcia@newemail.com'
WHERE id_cliente = 1;
```

### D. Borrado de Datos (Criterio 4.b - DELETE)

Con integridad referencial (cascada):

```sql
-- Borrar una línea de pedido
DELETE FROM lineas_pedido 
WHERE id_pedido = 6 AND id_producto = 3;

-- Borrar un pedido completo (líneas se borran automáticamente)
DELETE FROM pedidos 
WHERE id_pedido = 6;

-- NO se puede borrar cliente con pedidos (RESTRICT)
-- DELETE FROM clientes WHERE id_cliente = 1;  -- ERROR!

-- Primero hay que borrar pedidos
DELETE FROM pedidos WHERE id_cliente = 1;
DELETE FROM clientes WHERE id_cliente = 1;  -- Ahora OK
```

### E. Consultas de Verificación

**Consulta 1: Cliente con sus pedidos (Criterio 4.h - integridad)**
```sql
SELECT 
    p.id_pedido,
    c.nombre AS cliente,
    p.fecha_pedido,
    p.total,
    p.estado
FROM pedidos p
INNER JOIN clientes c ON p.id_cliente = c.id_cliente
WHERE c.nombre = 'Juan García López'
ORDER BY p.fecha_pedido DESC;
```
Resultado esperado: 2 pedidos (2890.95€, 279.99€) entregados

**Consulta 2: Detalles completos de un pedido (5 tablas)**
```sql
SELECT 
    p.id_pedido,
    c.nombre AS cliente,
    pr.nombre AS producto,
    cat.nombre AS categoria,
    lp.cantidad,
    lp.precio_unitario,
    lp.subtotal,
    p.estado
FROM pedidos p
INNER JOIN clientes c ON p.id_cliente = c.id_cliente
INNER JOIN lineas_pedido lp ON p.id_pedido = lp.id_pedido
INNER JOIN productos pr ON lp.id_producto = pr.id_producto
INNER JOIN categorias cat ON pr.id_categoria = cat.id_categoria
WHERE p.id_pedido = 1
ORDER BY pr.nombre;
```
Resultado: 4 productos del Pedido #1 con cálculo automático de subtotal

**Consulta 3: Stock con alertas de reorden**
```sql
SELECT 
    pr.nombre,
    cat.nombre AS categoria,
    gs.cantidad_disponible,
    gs.cantidad_minima,
    CASE 
        WHEN gs.cantidad_disponible <= gs.cantidad_minima 
            THEN 'REORDEN URGENTE'
        WHEN gs.cantidad_disponible < gs.cantidad_minima * 1.5 
            THEN 'STOCK BAJO'
        ELSE 'OK'
    END AS estado
FROM productos pr
INNER JOIN gestion_stock gs ON pr.id_producto = gs.id_producto
INNER JOIN categorias cat ON pr.id_categoria = cat.id_categoria
ORDER BY gs.cantidad_disponible ASC;
```

**Consulta 4: Análisis de ventas por categoría**
```sql
SELECT 
    cat.nombre AS categoria,
    COUNT(DISTINCT p.id_pedido) AS pedidos,
    SUM(lp.cantidad) AS articulos_vendidos,
    ROUND(SUM(lp.subtotal), 2) AS ingresos
FROM categorias cat
INNER JOIN productos pr ON cat.id_categoria = pr.id_categoria
INNER JOIN lineas_pedido lp ON pr.id_producto = lp.id_producto
GROUP BY cat.id_categoria
ORDER BY ingresos DESC;
```
Resultado: Electrónica lidera con 2900€+

---

## 3. APLICACIÓN PRÁCTICA (25%)

### Aplicación Web en PHP

#### A. Dashboard Principal (index.php)

```php
<?php
// Conexión a la base de datos
$mysqli = new mysqli("localhost", "root", "", "tiendaonline2526");
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}
$mysqli->set_charset("utf8mb4");

// Obtener estadísticas
$stats = $mysqli->query("
    SELECT 
        COUNT(*) as total_pedidos,
        SUM(CASE WHEN estado='entregado' THEN 1 ELSE 0 END) as entregados,
        ROUND(SUM(total), 2) as ventas_totales
    FROM pedidos
")->fetch_assoc();

// Obtener lista de pedidos
$pedidos = $mysqli->query("
    SELECT p.id_pedido, c.nombre, p.fecha_pedido, p.total, p.estado
    FROM pedidos p
    INNER JOIN clientes c ON p.id_cliente = c.id_cliente
    ORDER BY p.fecha_pedido DESC
");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - tiendaonline2526</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
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
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
        }
        .header h1 { font-size: 28px; margin-bottom: 5px; }
        .header p { font-size: 14px; opacity: 0.9; }
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 30px;
            background: #f8f9fa;
        }
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #667eea;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .stat-card h3 { color: #666; font-size: 12px; text-transform: uppercase; margin-bottom: 10px; }
        .stat-card .value { font-size: 28px; font-weight: bold; color: #667eea; }
        .content { padding: 30px; }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        th {
            background: #f8f9fa;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #333;
            border-bottom: 2px solid #e0e0e0;
        }
        td {
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
        }
        tr:hover { background: #f8f9fa; }
        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .badge.entregado { background: #d4edda; color: #155724; }
        .badge.procesando { background: #fff3cd; color: #856404; }
        .badge.enviado { background: #d1ecf1; color: #0c5460; }
        .badge.pendiente { background: #f8d7da; color: #721c24; }
        button {
            background: #667eea;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: background 0.2s;
        }
        button:hover { background: #764ba2; }
        .modal {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        .modal.active { display: flex; }
        .modal-content {
            background: white;
            border-radius: 8px;
            padding: 30px;
            max-width: 600px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e0e0e0;
        }
        .modal-header h2 { color: #333; }
        .close-btn {
            background: none;
            color: #999;
            font-size: 24px;
            cursor: pointer;
            padding: 0;
        }
        .close-btn:hover { color: #333; }
        .modal-body table {
            margin-top: 20px;
        }
        .modal-body td { padding: 10px 0; border: none; }
        .modal-body td:first-child { font-weight: 600; color: #667eea; width: 30%; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📊 Dashboard - tiendaonline2526</h1>
            <p>Sistema de Gestión de Pedidos | Ejercicio 004-004 Bases de Datos</p>
        </div>

        <div class="stats">
            <div class="stat-card">
                <h3>Total Pedidos</h3>
                <div class="value"><?php echo $stats['total_pedidos']; ?></div>
            </div>
            <div class="stat-card">
                <h3>Entregados</h3>
                <div class="value"><?php echo $stats['entregados']; ?></div>
            </div>
            <div class="stat-card">
                <h3>Ventas Totales</h3>
                <div class="value"><?php echo number_format($stats['ventas_totales'], 2); ?>€</div>
            </div>
        </div>

        <div class="content">
            <h2 style="margin-bottom: 20px;">Listado de Pedidos</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($p = $pedidos->fetch_assoc()): ?>
                    <tr>
                        <td><strong>#<?php echo $p['id_pedido']; ?></strong></td>
                        <td><?php echo htmlspecialchars($p['nombre']); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($p['fecha_pedido'])); ?></td>
                        <td><strong><?php echo number_format($p['total'], 2); ?>€</strong></td>
                        <td>
                            <span class="badge <?php echo strtolower($p['estado']); ?>">
                                <?php echo ucfirst($p['estado']); ?>
                            </span>
                        </td>
                        <td>
                            <button onclick="verDetalles(<?php echo $p['id_pedido']; ?>)">
                                Ver Detalles
                            </button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modal-title">Detalles del Pedido</h2>
                <button class="close-btn" onclick="cerrarModal()">&times;</button>
            </div>
            <div id="modal-body" class="modal-body"></div>
        </div>
    </div>

    <script>
        function verDetalles(idPedido) {
            fetch(`detalles_pedido.php?id=${idPedido}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('modal-title').textContent = 
                        `Detalles del Pedido #${data.id}`;
                    
                    let html = `
                        <table>
                            <tr><td>Cliente:</td><td><strong>${data.cliente}</strong></td></tr>
                            <tr><td>Fecha:</td><td>${data.fecha}</td></tr>
                            <tr><td>Estado:</td><td><span class="badge ${data.estado.toLowerCase()}">${data.estado}</span></td></tr>
                        </table>
                        <table style="margin-top: 20px;">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                    `;
                    
                    data.lineas.forEach(linea => {
                        html += `
                            <tr>
                                <td>${linea.producto}</td>
                                <td style="text-align:center;">${linea.cantidad}</td>
                                <td style="text-align:right;">${linea.precio}€</td>
                                <td style="text-align:right;"><strong>${linea.subtotal}€</strong></td>
                            </tr>
                        `;
                    });
                    
                    html += `
                            </tbody>
                        </table>
                        <div style="margin-top: 20px; text-align: right; border-top: 2px solid #e0e0e0; padding-top: 15px;">
                            <h3 style="color: #667eea;">Total: ${data.total}€</h3>
                        </div>
                    `;
                    
                    document.getElementById('modal-body').innerHTML = html;
                    document.getElementById('modal').classList.add('active');
                });
        }

        function cerrarModal() {
            document.getElementById('modal').classList.remove('active');
        }

        window.onclick = function(event) {
            const modal = document.getElementById('modal');
            if (event.target === modal) {
                modal.classList.remove('active');
            }
        }
    </script>
</body>
</html>
```

#### B. Backend AJAX (detalles_pedido.php)

```php
<?php
header('Content-Type: application/json');

$mysqli = new mysqli("localhost", "root", "", "tiendaonline2526");
if ($mysqli->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Error de conexión']);
    exit;
}
$mysqli->set_charset("utf8mb4");

// Obtener ID del pedido
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'ID inválido']);
    exit;
}

// Obtener info del pedido
$pedido_query = $mysqli->prepare("
    SELECT p.id_pedido, c.nombre, p.fecha_pedido, p.estado, p.total
    FROM pedidos p
    INNER JOIN clientes c ON p.id_cliente = c.id_cliente
    WHERE p.id_pedido = ?
");
$pedido_query->bind_param("i", $id);
$pedido_query->execute();
$pedido = $pedido_query->get_result()->fetch_assoc();

if (!$pedido) {
    http_response_code(404);
    echo json_encode(['error' => 'Pedido no encontrado']);
    exit;
}

// Obtener líneas del pedido
$lineas_query = $mysqli->prepare("
    SELECT 
        pr.nombre,
        lp.cantidad,
        lp.precio_unitario,
        lp.subtotal
    FROM lineas_pedido lp
    INNER JOIN productos pr ON lp.id_producto = pr.id_producto
    WHERE lp.id_pedido = ?
    ORDER BY pr.nombre
");
$lineas_query->bind_param("i", $id);
$lineas_query->execute();
$lineas_result = $lineas_query->get_result();

$lineas = [];
while ($linea = $lineas_result->fetch_assoc()) {
    $lineas[] = [
        'producto' => $linea['nombre'],
        'cantidad' => $linea['cantidad'],
        'precio' => number_format($linea['precio_unitario'], 2),
        'subtotal' => number_format($linea['subtotal'], 2)
    ];
}

// Respuesta JSON
echo json_encode([
    'id' => $pedido['id_pedido'],
    'cliente' => $pedido['nombre'],
    'fecha' => date('d/m/Y', strtotime($pedido['fecha_pedido'])),
    'estado' => ucfirst($pedido['estado']),
    'lineas' => $lineas,
    'total' => number_format($pedido['total'], 2)
]);

$mysqli->close();
?>
```

### Características de la Aplicación

✅ **Dashboard interactivo** con estadísticas en tiempo real  
✅ **Tabla de pedidos** con estados coloreados (código visual)  
✅ **Modal AJAX** para detalles sin recargar página  
✅ **Backend PHP** con consultas preparadas (prevención SQL injection)  
✅ **Responsive design** compatible con móviles  
✅ **Cálculo automático** de totales desde la BD  

### Ejecución de la Aplicación

```bash
# 1. Navegar a la carpeta del proyecto
cd /ruta/al/proyecto

# 2. Iniciar servidor PHP local
php -S localhost:8000

# 3. Abrir navegador
# http://localhost:8000/index.php

# Deberías ver:
# - 6 pedidos listados
# - Total de ventas: 5345.81€
# - Estados coloreados por tipo
# - Modal con detalles al hacer clic en "Ver Detalles"
```

---

## 4. TRANSACCIONES Y CONSISTENCIA (Criterio 4.e, 4.f, 4.h)

### A. ¿Qué son las Transacciones? (Criterio 4.e)

Una **transacción** es un conjunto de operaciones SQL que se ejecutan **todo o nada** (atomicidad). Garantiza que:
- Todas las operaciones se completan
- O se revierten todas si algo falla
- Sin estados intermedios inconsistentes

### B. Ejemplo Práctico 1: Procesar Pedido con Transacción

```sql
START TRANSACTION;

-- Paso 1: Verificar que hay stock
SELECT @stock := cantidad_disponible 
FROM gestion_stock 
WHERE id_producto = 2 
FOR UPDATE;  -- Lock para evitar race condition

-- Paso 2: Decrementar stock
IF @stock >= 1 THEN
    UPDATE gestion_stock 
    SET cantidad_disponible = cantidad_disponible - 1
    WHERE id_producto = 2;
    
    -- Paso 3: Cambiar estado del pedido
    UPDATE pedidos 
    SET estado = 'procesando'
    WHERE id_pedido = 3;
    
    COMMIT;
    SELECT 'Pedido procesado exitosamente' AS resultado;
ELSE
    ROLLBACK;
    SELECT 'ERROR: Stock insuficiente' AS error;
END IF;
```

**Sin transacción:** Si falla después de decrementar stock, quedamos con inconsistencia.  
**Con transacción:** O todo ocurre o nada.

### C. Ejemplo Práctico 2: Anular Cambios (Criterio 4.f - ROLLBACK)

```sql
START TRANSACTION;

-- Realizar cambios
UPDATE pedidos SET estado = 'cancelado' WHERE id_pedido = 5;
UPDATE gestion_stock SET cantidad_disponible = cantidad_disponible + 2 WHERE id_producto = 1;
INSERT INTO lineas_pedido (id_pedido, id_producto, cantidad, precio_unitario) 
VALUES (5, 3, 1, 279.99);

-- Si detectamos error, revertir TODO
ROLLBACK;

-- Resultado: Los cambios nunca se aplicaron
SELECT * FROM pedidos WHERE id_pedido = 5;  -- Estado sigue siendo original
```

### D. Ejemplo Práctico 3: Aplicación en PHP con Transacciones

```php
<?php
$mysqli = new mysqli("localhost", "root", "", "tiendaonline2526");

try {
    // Iniciar transacción
    $mysqli->begin_transaction();
    
    // 1. Restar cantidad de línea
    $stmt = $mysqli->prepare("
        UPDATE gestion_stock 
        SET cantidad_disponible = cantidad_disponible - ?
        WHERE id_producto = ?
    ");
    $stmt->bind_param("ii", $cantidad, $id_producto);
    $cantidad = 1;
    $id_producto = 2;
    $stmt->execute();
    
    // 2. Crear nueva línea de pedido
    $stmt = $mysqli->prepare("
        INSERT INTO lineas_pedido (id_pedido, id_producto, cantidad, precio_unitario)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->bind_param("iiid", $id_pedido, $id_producto, $cantidad, $precio);
    $id_pedido = 3;
    $precio = 999.99;
    $stmt->execute();
    
    // 3. Actualizar total del pedido
    $mysqli->query("
        UPDATE pedidos p
        SET total = (SELECT SUM(subtotal) FROM lineas_pedido WHERE id_pedido = p.id_pedido)
        WHERE id_pedido = 3
    ");
    
    // Si todo va bien, confirmar
    $mysqli->commit();
    echo "✓ Pedido actualizado correctamente";
    
} catch (Exception $e) {
    // Si algo falla, deshacer TODO
    $mysqli->rollback();
    echo "✗ Error: " . $e->getMessage() . " - Cambios revertidos";
}

$mysqli->close();
?>
```

### E. Propiedades ACID Implementadas

| Propiedad | Garantía | Implementación en tiendaonline2526 |
|-----------|----------|-------------------------------------|
| **Atomicidad** | Todo o nada | START TRANSACTION + COMMIT/ROLLBACK |
| **Consistencia** | Datos válidos siempre | FK constraints, CHECK, triggers |
| **Aislamiento** | Sin interferencias | InnoDB isolation levels, locks |
| **Durabilidad** | Persiste en disco | Log de transacciones, sync |

---

## 5. CONCLUSIÓN BREVE (25%)

### Logros Alcanzados

✅ **Criterio 4.a)** Identificadas todas las herramientas: CREATE TABLE, INSERT, UPDATE, DELETE, START TRANSACTION  

✅ **Criterio 4.b)** Implementadas operaciones completas:
- INSERT: 59 registros en 6 tablas
- UPDATE: Cambios de estado, decrementación de stock
- DELETE: Borrado con cascadas

✅ **Criterio 4.e)** Transacciones entendidas y documentadas:
- Garantía de atomicidad
- Ejemplos SQL y PHP

✅ **Criterio 4.f)** ROLLBACK practicado:
- Reversión de cambios fallidos
- Consistencia garantizada

✅ **Criterio 4.h)** Medidas de integridad implementadas:
- Foreign keys con ON DELETE CASCADE/RESTRICT
- Constraints (UNIQUE, NOT NULL, CHECK)
- Índices para optimización
- Timestamp de auditoría

### Conceptos Clave Aprendidos

1. **Normalización 3NF** elimina redundancia mediante descomposición
2. **Relaciones complejas** (1:N, N:M, 1:1) estructuran datos realistas
3. **Integridad referencial** previene datos inconsistentes
4. **Transacciones** garantizan operaciones críticas atómicas
5. **Control de concurrencia** evita race conditions
6. **Índices estratégicos** aceleran búsquedas

### Aplicabilidad Real

Este proyecto replica un sistema real:
- **E-commerce:** Gestión de pedidos, clientes, productos
- **Operaciones críticas:** Confirmación de compra = transacción
- **Auditoría:** Timestamps rastrean cambios
- **Escalabilidad:** Índices permiten millones de registros

### Mejoras Posibles

Para un sistema de producción:
- Encriptación de datos sensibles (contraseñas, tarjetas)
- Logs de auditoría detallados (quién cambió qué y cuándo)
- Backups automáticos y replicación
- Cache (Redis) para consultas frecuentes
- Particionamiento de tablas grandes
- API REST con autenticación JWT

---

## 📋 ARCHIVOS DISPONIBLES

**Scripts SQL:**
1. `01-crear-base-datos.sql` - Creación de BD
2. `02-crear-tablas.sql` - Estructura completa (6 tablas)
3. `07-insertar-datos.sql` - 59 registros de prueba
4. `08-consultas-verificacion.sql` - 11+ consultas de análisis

**Código PHP:**
5. `index.php` - Dashboard interactivo
6. `detalles_pedido.php` - Backend AJAX

**Documentación:**
7. `SOLUCION_004-004.md` - Documentación técnica completa
8. `RESUMEN_SOLUCION.md` - Resumen ejecutivo

---

**Estudiante:** Darío Lacal  
**Asignatura:** Bases de Datos (UD004 - Tratamiento de datos)  
**Evaluación:** 1ª Evaluación  
**Fecha:** Diciembre 2024  
**Estado:** ✅ COMPLETO - Rúbrica 4×25% cubierta
