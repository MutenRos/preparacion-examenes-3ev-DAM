# EJERCICIO 004-004: BASES DE DATOS Y TRANSACCIONES

**Alumno:** Darío Lacal | **Evaluación:** 1ª | **Rúbrica:** 4 secciones × 25%

---

## ENUNCIADO ORIGINAL

Para practicar el concepto impartido en clase sobre bases de datos y relaciones entre tablas, sigue estos pasos:

**Creación de la Base de Datos:**
- Abre tu terminal: `sudo mysql -u root -p`
- Crea: `CREATE DATABASE tiendaonline2526;`
- Usa: `USE tiendaonline2526;`

**Creación de Tablas:**
- Utiliza 02-crear-tablas.sql para crear: categorias, clientes, productos, gestion_stock, pedidos, lineas_pedido
- Cada tabla debe estar correctamente relacionada

**Inserción de Datos:**
- Ejecuta 07-insertar-datos.sql
- Verifica con: `SELECT * FROM categorias;`

**Pruebas y Consultas:**
- Consulta los pedidos de un cliente específico
- Verifica el stock disponible
- Asegúrate de que las relaciones foráneas funcionan

**Aplicación Práctica:**
- Crea una aplicación que muestre información de pedidos
- Incluye cliente, producto, estado del pedido
- Usa PHP o Python

---

## 1. INTRODUCCIÓN (25%)

### Objetivo
Implementar un **Sistema de Tienda Online (tiendaonline2526)** para practicar:
- Criterios 4.a) Herramientas y sentencias para modificar BD
- Criterios 4.b) Insertar, borrar, actualizar datos
- Criterios 4.e) Funcionamiento de transacciones
- Criterios 4.f) Anular cambios con ROLLBACK
- Criterios 4.h) Medidas de integridad y consistencia

### Justificación
Las **transacciones** son cruciales en BD reales: garantizan que operaciones complejas (confirmar pedido, decrementar stock) ocurren **todo o nada**, evitando inconsistencias en caso de fallos.

---

## 2. DESARROLLO (25%)

### Estructura de la Base de Datos

**6 Tablas normalizadas (3NF):**
1. **categorias** (5 registros): Electrónica, Ropa, Hogar, Deportes, Libros
2. **clientes** (5 registros): Juan García, María Rodríguez, Carlos López, Ana Martínez, Pedro Sánchez
3. **productos** (15 registros): Laptop (1299.99€), iPhone (999.99€), Sudaderas, etc.
4. **gestion_stock** (15 registros): Control de inventario (1:1 con productos)
5. **pedidos** (6 registros): Estados (pendiente, procesando, enviado, entregado)
6. **lineas_pedido** (13 registros): N:M entre pedidos y productos

**Relaciones:**
- 1:N: cliente → múltiples pedidos
- N:M: pedidos ↔ productos (via lineas_pedido)
- 1:1: producto ↔ gestion_stock

### Operaciones SQL (Criterios 4.a, 4.b)

**Inserción (INSERT):**
```sql
INSERT INTO clientes (nombre, email, telefono, ciudad) VALUES
('Juan García López', 'juan@example.com', '600123456', 'Madrid');

INSERT INTO productos (id_categoria, nombre, precio) VALUES
(1, 'Laptop Dell 15"', 1299.99);
```

**Actualización (UPDATE):**
```sql
-- Cambiar estado de pedido
UPDATE pedidos SET estado = 'enviado' WHERE id_pedido = 3;

-- Decrementar stock
UPDATE gestion_stock SET cantidad_disponible = cantidad_disponible - 1 WHERE id_producto = 2;
```

**Borrado (DELETE):**
```sql
-- Borrar una línea de pedido
DELETE FROM lineas_pedido WHERE id_pedido = 6 AND id_producto = 3;

-- Borrar un pedido completo (líneas se borran automáticamente con CASCADE)
DELETE FROM pedidos WHERE id_pedido = 6;
```

### Consultas de Verificación (Criterio 4.h)

```sql
-- 1. Pedidos de un cliente
SELECT p.id_pedido, c.nombre, p.total, p.estado
FROM pedidos p
JOIN clientes c ON p.id_cliente = c.id_cliente
WHERE c.nombre = 'Juan García López';

-- 2. Detalles de un pedido (5 tablas)
SELECT c.nombre, pr.nombre AS producto, lp.cantidad, lp.subtotal
FROM pedidos p
JOIN clientes c ON p.id_cliente = c.id_cliente
JOIN lineas_pedido lp ON p.id_pedido = lp.id_pedido
JOIN productos pr ON lp.id_producto = pr.id_producto
WHERE p.id_pedido = 1;

-- 3. Stock con alertas
SELECT pr.nombre, gs.cantidad_disponible,
  CASE WHEN gs.cantidad_disponible <= gs.cantidad_minima THEN 'REORDEN'
       ELSE 'OK' END AS estado
FROM productos pr
JOIN gestion_stock gs ON pr.id_producto = gs.id_producto;
```

---

## 3. APLICACIÓN PRÁCTICA (25%)

### Dashboard PHP + AJAX

**index.php - Mostrar pedidos:**
```php
<?php
$mysqli = new mysqli("localhost", "root", "", "tiendaonline2526");
$resultado = $mysqli->query("
    SELECT p.id_pedido, c.nombre, p.fecha_pedido, p.total, p.estado
    FROM pedidos p
    JOIN clientes c ON p.id_cliente = c.id_cliente
    ORDER BY p.fecha_pedido DESC
");
?>
<table>
    <thead><tr><th>ID</th><th>Cliente</th><th>Fecha</th><th>Total</th><th>Estado</th><th>Acción</th></tr></thead>
    <tbody>
        <?php while($p = $resultado->fetch_assoc()): ?>
        <tr>
            <td><?php echo $p['id_pedido']; ?></td>
            <td><?php echo $p['nombre']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($p['fecha_pedido'])); ?></td>
            <td><?php echo number_format($p['total'], 2); ?>€</td>
            <td><span class="badge <?php echo strtolower($p['estado']); ?>"><?php echo ucfirst($p['estado']); ?></span></td>
            <td><button onclick="verDetalles(<?php echo $p['id_pedido']; ?>)">Detalles</button></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<script>
function verDetalles(idPedido) {
    fetch('detalles_pedido.php?id=' + idPedido)
        .then(r => r.json())
        .then(data => {
            alert('Cliente: ' + data.cliente + '\nTotal: ' + data.total + '€');
        });
}
</script>
```

**detalles_pedido.php - Backend AJAX:**
```php
<?php
header('Content-Type: application/json');
$mysqli = new mysqli("localhost", "root", "", "tiendaonline2526");
$id = intval($_GET['id']);

$pedido = $mysqli->query("
    SELECT p.id_pedido, c.nombre, p.total
    FROM pedidos p
    JOIN clientes c ON p.id_cliente = c.id_cliente
    WHERE p.id_pedido = $id
")->fetch_assoc();

echo json_encode([
    'id' => $pedido['id_pedido'],
    'cliente' => $pedido['nombre'],
    'total' => number_format($pedido['total'], 2)
]);
?>
```

**Ejecución:**
```bash
php -S localhost:8000
# Acceder a http://localhost:8000/index.php
```

---

## 4. TRANSACCIONES Y CONCLUSIÓN (25%)

### Transacciones ACID (Criterios 4.e, 4.f)

**Ejemplo 1: Procesar pedido con transacción**
```sql
START TRANSACTION;

-- Decrementar stock
UPDATE gestion_stock SET cantidad_disponible = cantidad_disponible - 1
WHERE id_producto = 2;

-- Cambiar estado del pedido
UPDATE pedidos SET estado = 'procesando'
WHERE id_pedido = 3;

-- Si todo va bien, confirmar
COMMIT;

-- Si algo falla, deshacer TODO
-- ROLLBACK;
```

**Ejemplo 2: PHP con transacciones**
```php
<?php
$mysqli = new mysqli("localhost", "root", "", "tiendaonline2526");
try {
    $mysqli->begin_transaction();
    
    // Restar stock
    $mysqli->query("UPDATE gestion_stock SET cantidad_disponible = cantidad_disponible - 1 WHERE id_producto = 2");
    
    // Crear línea de pedido
    $mysqli->query("INSERT INTO lineas_pedido (id_pedido, id_producto, cantidad, precio_unitario) VALUES (3, 2, 1, 999.99)");
    
    // Confirmar si todo va bien
    $mysqli->commit();
    echo "✓ Pedido procesado";
    
} catch (Exception $e) {
    // Deshacer si hay error
    $mysqli->rollback();
    echo "✗ Error: " . $e->getMessage();
}
?>
```

### Logros Alcanzados

✅ **Criterio 4.a)** - Herramientas: CREATE TABLE, INSERT, UPDATE, DELETE, START TRANSACTION  
✅ **Criterio 4.b)** - Operaciones: 59 registros insertados + ejemplos UPDATE/DELETE  
✅ **Criterio 4.e)** - Transacciones: 2 ejemplos en SQL y PHP  
✅ **Criterio 4.f)** - ROLLBACK: Reversión de cambios documentada  
✅ **Criterio 4.h)** - Integridad: FKs, constraints, índices, timestamps  

### Conceptos Clave

1. **Normalización 3NF** - Elimina redundancia mediante descomposición de tablas
2. **Integridad referencial** - FKs previenen datos inconsistentes
3. **Transacciones ACID** - Garantizan operaciones atómicas (todo o nada)
4. **Índices** - Aceleran búsquedas en columnas frecuentes
5. **Control de concurrencia** - Evita race conditions con locks

### Aplicabilidad Real

Este proyecto replica sistemas reales de e-commerce:
- Gestión de clientes, productos, pedidos
- Operaciones críticas con transacciones
- Auditoría con timestamps
- Escalabilidad mediante índices

### Archivos Disponibles

1. `01-crear-base-datos.sql` - Crear BD
2. `02-crear-tablas.sql` - Definir tablas (6 tablas, 59 registros)
3. `07-insertar-datos.sql` - Cargar datos
4. `08-consultas-verificacion.sql` - Consultas de análisis
5. `index.php` - Dashboard
6. `detalles_pedido.php` - Backend AJAX

---

**Estado:** ✅ COMPLETADO | **Evaluación:** 1ª | **Fecha:** Diciembre 2024
