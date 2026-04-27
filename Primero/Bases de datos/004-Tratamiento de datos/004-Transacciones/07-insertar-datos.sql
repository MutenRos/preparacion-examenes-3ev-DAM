-- Script: 07-insertar-datos.sql
-- Descripción: Insertar datos de prueba en todas las tablas
-- Autor: Darío Lacal
-- Fecha: 2025-12-07

USE tiendaonline2526;

-- =============================================================================
-- INSERTAR CATEGORÍAS
-- =============================================================================

INSERT INTO categorias (nombre, descripcion) VALUES
('Electrónica', 'Productos electrónicos y tecnología'),
('Ropa', 'Prendas de vestir para hombre, mujer y niños'),
('Hogar', 'Artículos para el hogar y decoración'),
('Deportes', 'Equipamiento y ropa deportiva'),
('Libros', 'Libros físicos y audiobooks');

SELECT 'Categorías insertadas: ' AS operacion, COUNT(*) AS cantidad FROM categorias;

-- =============================================================================
-- INSERTAR CLIENTES
-- =============================================================================

INSERT INTO clientes (nombre, email, telefono, direccion) VALUES
('Juan García López', 'juan.garcia@email.com', '634512345', 'Calle Principal 123, Madrid'),
('María Rodríguez Martín', 'maria.rodriguez@email.com', '645678901', 'Avenida Central 456, Barcelona'),
('Carlos López Pérez', 'carlos.lopez@email.com', '698765432', 'Plaza Mayor 789, Valencia'),
('Ana Martínez González', 'ana.martinez@email.com', '612345678', 'Calle Secundaria 321, Sevilla'),
('Pedro Sánchez Ruiz', 'pedro.sanchez@email.com', '623456789', 'Paseo de los Ángeles 654, Bilbao');

SELECT 'Clientes insertados: ' AS operacion, COUNT(*) AS cantidad FROM clientes;

-- =============================================================================
-- INSERTAR PRODUCTOS
-- =============================================================================

INSERT INTO productos (nombre, descripcion, precio_unitario, id_categoria) VALUES
-- Electrónica (id_categoria = 1)
('Laptop Dell XPS 13', 'Laptop ultraligera con procesador Intel i7, 16GB RAM, 512GB SSD', 1299.99, 1),
('iPhone 15 Pro', 'Smartphone Apple con cámara triple, A17 Pro, pantalla OLED 6.1", 256GB', 999.99, 1),
('AirPods Pro', 'Auriculares inalámbricos con cancelación de ruido, audio espacial', 249.99, 1),

-- Ropa (id_categoria = 2)
('Camiseta Básica Azul', 'Camiseta de algodón 100% azul marino, talla única', 19.99, 2),
('Pantalón Vaquero Premium', 'Pantalón vaquero ajustado color azul oscuro, talle 32-40', 59.99, 2),
('Sudadera Gris Oscuro', 'Sudadera de algodón cómoda y cálida, ideal para invierno', 39.99, 2),

-- Hogar (id_categoria = 3)
('Almohada Memoria', 'Almohada con espuma viscoelástica, altura regulable, funda extraíble', 49.99, 3),
('Sábanas de Algodón', 'Juego de sábanas blancas 100% algodón, 200 hilos, 135x200cm', 34.99, 3),
('Lámpara LED Moderna', 'Lámpara de pie LED con control remoto, 3 temperaturas de color', 89.99, 3),

-- Deportes (id_categoria = 4)
('Zapatillas Running Nike', 'Zapatillas deportivas para correr, amortiguación máxima, talla 35-47', 129.99, 4),
('Mochila Deportiva', 'Mochila de 30L para deporte y viajes, impermeable, compartimentos', 49.99, 4),
('Banda de Resistencia', 'Set de bandas elásticas para ejercicio, 5 niveles de resistencia', 24.99, 4),

-- Libros (id_categoria = 5)
('El Quijote', 'Novela clásica de Miguel de Cervantes, edición bolsillo, 784 páginas', 14.99, 5),
('Clean Code', 'Guía de código limpio para desarrolladores, Robert C. Martin', 39.99, 5),
('Sapiens', 'Historia breve de la humanidad, Yuval Noah Harari', 19.99, 5);

SELECT 'Productos insertados: ' AS operacion, COUNT(*) AS cantidad FROM productos;

-- =============================================================================
-- INSERTAR GESTIÓN DE STOCK
-- =============================================================================

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

SELECT 'Stock insertado: ' AS operacion, COUNT(*) AS cantidad FROM gestion_stock;

-- =============================================================================
-- INSERTAR PEDIDOS
-- =============================================================================

INSERT INTO pedidos (id_cliente, estado) VALUES
(1, 'procesando'),      -- Pedido 1: Juan García López
(2, 'entregado'),       -- Pedido 2: María Rodríguez Martín
(3, 'pendiente'),       -- Pedido 3: Carlos López Pérez
(1, 'enviado'),         -- Pedido 4: Juan García López (segundo pedido)
(4, 'entregado'),       -- Pedido 5: Ana Martínez González
(5, 'pendiente');       -- Pedido 6: Pedro Sánchez Ruiz

SELECT 'Pedidos insertados: ' AS operacion, COUNT(*) AS cantidad FROM pedidos;

-- =============================================================================
-- INSERTAR LÍNEAS DE PEDIDO (Relación N:M entre pedidos y productos)
-- =============================================================================

INSERT INTO lineas_pedido (id_pedido, id_producto, cantidad, precio_unitario) VALUES
-- Pedido 1: Juan García López (Laptop, Camiseta)
(1, 1, 1, 1299.99),    -- 1x Laptop Dell XPS 13
(1, 4, 2, 19.99),      -- 2x Camiseta Básica Azul

-- Pedido 2: María Rodríguez Martín (iPhone, Zapatillas, Sapiens)
(2, 2, 1, 999.99),     -- 1x iPhone 15 Pro
(2, 10, 1, 129.99),    -- 1x Zapatillas Running Nike
(2, 15, 1, 19.99),     -- 1x Sapiens

-- Pedido 3: Carlos López Pérez (Pantalón, Almohada)
(3, 5, 2, 59.99),      -- 2x Pantalón Vaquero Premium
(3, 7, 1, 49.99),      -- 1x Almohada Memoria

-- Pedido 4: Juan García López (Sudadera, Bandas resistencia)
(4, 6, 1, 39.99),      -- 1x Sudadera Gris Oscuro
(4, 12, 2, 24.99),     -- 2x Banda de Resistencia

-- Pedido 5: Ana Martínez González (Sábanas, Lámpara, Clean Code)
(5, 8, 1, 34.99),      -- 1x Sábanas de Algodón
(5, 9, 1, 89.99),      -- 1x Lámpara LED Moderna
(5, 14, 1, 39.99),     -- 1x Clean Code

-- Pedido 6: Pedro Sánchez Ruiz (El Quijote, Mochila, AirPods)
(6, 13, 1, 14.99),     -- 1x El Quijote
(6, 11, 1, 49.99),     -- 1x Mochila Deportiva
(6, 3, 1, 249.99);     -- 1x AirPods Pro

SELECT 'Líneas de pedido insertadas: ' AS operacion, COUNT(*) AS cantidad FROM lineas_pedido;

-- =============================================================================
-- ACTUALIZAR TOTALES DE PEDIDOS (TRANSACCIÓN)
-- =============================================================================

START TRANSACTION;

-- Actualizar el total de cada pedido sumando sus líneas
UPDATE pedidos 
SET total = (
    SELECT COALESCE(SUM(subtotal), 0) 
    FROM lineas_pedido 
    WHERE id_pedido = pedidos.id_pedido
);

COMMIT;

SELECT 'Totales de pedidos calculados' AS operacion;

-- =============================================================================
-- RESUMEN DE DATOS INSERTADOS
-- =============================================================================

SELECT '========== RESUMEN DE DATOS INSERTADOS ==========' AS resumen;

SELECT CONCAT('Total de Categorías: ', COUNT(*)) AS dato FROM categorias;
SELECT CONCAT('Total de Clientes: ', COUNT(*)) AS dato FROM clientes;
SELECT CONCAT('Total de Productos: ', COUNT(*)) AS dato FROM productos;
SELECT CONCAT('Total de Registros de Stock: ', COUNT(*)) AS dato FROM gestion_stock;
SELECT CONCAT('Total de Pedidos: ', COUNT(*)) AS dato FROM pedidos;
SELECT CONCAT('Total de Líneas de Pedido: ', COUNT(*)) AS dato FROM lineas_pedido;

SELECT CONCAT('Ventas Totales: ', ROUND(SUM(total), 2), '€') AS dato FROM pedidos;

SELECT '============================================' AS fin;
