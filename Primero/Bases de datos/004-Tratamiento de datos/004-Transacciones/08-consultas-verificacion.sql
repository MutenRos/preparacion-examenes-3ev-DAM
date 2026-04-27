-- Script: 08-consultas-verificacion.sql
-- Descripción: Consultas para verificar integridad y relaciones
-- Autor: Darío Lacal
-- Fecha: 2025-12-07

USE tiendaonline2526;

-- =============================================================================
-- 1. VERIFICACIÓN DE DATOS BÁSICA
-- =============================================================================

SELECT '===== 1. CATEGORÍAS =====' AS seccion;
SELECT * FROM categorias;

SELECT '===== 2. CLIENTES =====' AS seccion;
SELECT * FROM clientes;

SELECT '===== 3. PRODUCTOS (PRIMEROS 5) =====' AS seccion;
SELECT id_producto, nombre, precio_unitario, id_categoria FROM productos LIMIT 5;

SELECT '===== 4. GESTIÓN DE STOCK =====' AS seccion;
SELECT gs.id_stock, p.nombre, gs.cantidad_disponible, gs.cantidad_minima, gs.cantidad_maxima 
FROM gestion_stock gs
JOIN productos p ON gs.id_producto = p.id_producto;

SELECT '===== 5. PEDIDOS =====' AS seccion;
SELECT * FROM pedidos;

SELECT '===== 6. LÍNEAS DE PEDIDO =====' AS seccion;
SELECT * FROM lineas_pedido;

-- =============================================================================
-- 2. CONSULTAS CON RELACIONES FORÁNEAS
-- =============================================================================

SELECT CHAR(10), '===== RELACIONES FORÁNEAS =====' AS seccion;

-- Mostrar un pedido completo con todos los detalles
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

-- =============================================================================
-- 3. PEDIDOS DE UN CLIENTE ESPECÍFICO
-- =============================================================================

SELECT CHAR(10), '===== PEDIDOS DE JUAN GARCÍA LÓPEZ =====' AS seccion;

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

-- =============================================================================
-- 4. STOCK DISPONIBLE
-- =============================================================================

SELECT CHAR(10), '===== ESTADO DE STOCK =====' AS seccion;

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
ORDER BY gs.cantidad_disponible ASC;

-- =============================================================================
-- 5. VENTAS POR CATEGORÍA
-- =============================================================================

SELECT CHAR(10), '===== VENTAS POR CATEGORÍA =====' AS seccion;

SELECT 
    c.nombre AS categoria,
    COUNT(DISTINCT p.id_pedido) AS numero_pedidos,
    COUNT(lp.id_linea) AS cantidad_articulos,
    SUM(lp.subtotal) AS ventas_totales,
    ROUND(AVG(lp.subtotal), 2) AS venta_promedio
FROM categorias c
LEFT JOIN productos pr ON c.id_categoria = pr.id_categoria
LEFT JOIN lineas_pedido lp ON pr.id_producto = lp.id_producto
LEFT JOIN pedidos p ON lp.id_pedido = p.id_pedido
GROUP BY c.id_categoria, c.nombre
ORDER BY ventas_totales DESC;

-- =============================================================================
-- 6. DETALLE COMPLETO DE UN PEDIDO ESPECÍFICO
-- =============================================================================

SELECT CHAR(10), '===== DETALLE DEL PEDIDO #1 =====' AS seccion;

SELECT 
    p.id_pedido,
    c.nombre AS cliente,
    c.email,
    c.telefono,
    c.direccion,
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

-- =============================================================================
-- 7. CLIENTE CON MÁS PEDIDOS
-- =============================================================================

SELECT CHAR(10), '===== CLIENTE CON MÁS PEDIDOS =====' AS seccion;

SELECT 
    c.nombre AS cliente,
    c.email,
    COUNT(p.id_pedido) AS numero_pedidos,
    SUM(p.total) AS total_gastado,
    ROUND(AVG(p.total), 2) AS gasto_promedio
FROM clientes c
LEFT JOIN pedidos p ON c.id_cliente = p.id_cliente
GROUP BY c.id_cliente, c.nombre, c.email
ORDER BY numero_pedidos DESC, total_gastado DESC;

-- =============================================================================
-- 8. PRODUCTO MÁS VENDIDO
-- =============================================================================

SELECT CHAR(10), '===== PRODUCTOS MÁS VENDIDOS =====' AS seccion;

SELECT 
    pr.nombre,
    cat.nombre AS categoria,
    SUM(lp.cantidad) AS cantidad_vendida,
    ROUND(SUM(lp.subtotal), 2) AS ingresos_totales,
    ROUND(AVG(lp.precio_unitario), 2) AS precio_promedio
FROM productos pr
LEFT JOIN categorias cat ON pr.id_categoria = cat.id_categoria
LEFT JOIN lineas_pedido lp ON pr.id_producto = lp.id_producto
GROUP BY pr.id_producto, pr.nombre, cat.id_categoria, cat.nombre
ORDER BY cantidad_vendida DESC;

-- =============================================================================
-- 9. ESTADÍSTICAS DE PEDIDOS POR ESTADO
-- =============================================================================

SELECT CHAR(10), '===== ESTADÍSTICAS DE PEDIDOS POR ESTADO =====' AS seccion;

SELECT 
    estado,
    COUNT(*) AS cantidad_pedidos,
    ROUND(AVG(total), 2) AS ticket_promedio,
    ROUND(SUM(total), 2) AS ingresos_totales,
    ROUND(MIN(total), 2) AS minimo,
    ROUND(MAX(total), 2) AS maximo
FROM pedidos
GROUP BY estado
ORDER BY cantidad_pedidos DESC;

-- =============================================================================
-- 10. VERIFICACIÓN DE INTEGRIDAD REFERENCIAL
-- =============================================================================

SELECT CHAR(10), '===== VERIFICACIÓN DE INTEGRIDAD =====' AS seccion;

-- Verificar que no hay productos huérfanos
SELECT COUNT(*) AS productos_sin_categoria
FROM productos 
WHERE id_categoria NOT IN (SELECT id_categoria FROM categorias);

-- Verificar que no hay pedidos huérfanos
SELECT COUNT(*) AS pedidos_sin_cliente
FROM pedidos 
WHERE id_cliente NOT IN (SELECT id_cliente FROM clientes);

-- Verificar que no hay líneas de pedido huérfanas
SELECT COUNT(*) AS lineas_sin_pedido
FROM lineas_pedido 
WHERE id_pedido NOT IN (SELECT id_pedido FROM pedidos);

-- Verificar que todos los productos de líneas de pedido existen
SELECT COUNT(*) AS lineas_con_producto_invalido
FROM lineas_pedido 
WHERE id_producto NOT IN (SELECT id_producto FROM productos);

-- =============================================================================
-- 11. RESUMEN EJECUTIVO
-- =============================================================================

SELECT CHAR(10), '===== RESUMEN EJECUTIVO =====' AS seccion;

SELECT 
    'Total de Categorías' AS metrica,
    COUNT(*) AS valor
FROM categorias

UNION ALL

SELECT 'Total de Clientes', COUNT(*) FROM clientes
UNION ALL
SELECT 'Total de Productos', COUNT(*) FROM productos
UNION ALL
SELECT 'Total de Pedidos', COUNT(*) FROM pedidos
UNION ALL
SELECT 'Total de Artículos Vendidos', SUM(cantidad) FROM lineas_pedido
UNION ALL
SELECT 'Ingresos Totales (€)', ROUND(SUM(total), 2) FROM pedidos
UNION ALL
SELECT 'Ticket Promedio (€)', ROUND(AVG(total), 2) FROM pedidos
UNION ALL
SELECT 'Ticket Máximo (€)', ROUND(MAX(total), 2) FROM pedidos
UNION ALL
SELECT 'Ticket Mínimo (€)', ROUND(MIN(total), 2) FROM pedidos;

SELECT '===== FIN DE CONSULTAS =====' AS fin;
