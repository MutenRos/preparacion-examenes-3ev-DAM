-- Script de inicialización para el ejercicio 005-009
-- Base de datos de blog para proyectos de impresión 3D

-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS blogexamen;
USE blogexamen;

-- Crear tabla de autores
CREATE TABLE IF NOT EXISTS autores (
    Identificador INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(150) NOT NULL
);

-- Crear tabla de posts
CREATE TABLE IF NOT EXISTS posts (
    Identificador INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    fecha DATE NOT NULL,
    contenido TEXT NOT NULL,
    autor INT NOT NULL,
    FOREIGN KEY (autor) REFERENCES autores(Identificador)
);

-- Crear vista para posts completos (con nombre del autor)
CREATE OR REPLACE VIEW posts_completos AS
SELECT 
    p.titulo,
    DATE_FORMAT(p.fecha, '%d/%m/%Y') as fecha,
    p.contenido,
    a.nombre,
    a.apellidos
FROM posts p
INNER JOIN autores a ON p.autor = a.Identificador;

-- Insertar autor de ejemplo
INSERT INTO autores (nombre, apellidos) VALUES 
('Jose Vicente', 'Carratalá');

-- Insertar posts de ejemplo relacionados con impresión 3D
INSERT INTO posts (titulo, fecha, contenido, autor) VALUES
('Diseño de carcasa para Raspberry Pi 4', '2025-10-15', 
 'Hoy terminé de diseñar una carcasa personalizada para mi Raspberry Pi 4 en OpenSCAD. La carcasa incluye ventilación activa y soporte para pantalla táctil de 3.5 pulgadas. Los archivos STL están listos para imprimir.', 
 1),

('Control de LEDs mediante GPIO', '2025-10-28', 
 'Implementé un sistema de control de LEDs RGB usando Python y la librería RPi.GPIO. El script permite crear efectos de iluminación y responder a eventos del sensor de temperatura. Perfecto para indicar el estado de la impresora.', 
 1),

('Configuración de Octoprint en Raspberry Pi', '2025-11-01', 
 'Guía completa para instalar y configurar Octoprint en una Raspberry Pi 3B+. Incluye configuración de cámara web, plugins recomendados (BedLevelVisualizer, DisplayLayerProgress) y optimización del sistema para impresión remota.', 
 1),

('Soporte ajustable para cámara de monitorización', '2025-11-02', 
 'Diseñé e imprimí un soporte universal para cámara web que se acopla al eje Z de cualquier impresora tipo Prusa. El diseño incluye articulación en dos ejes y anclaje magnético. Material: PETG a 240°C con 30% de relleno.', 
 1);

-- Verificar datos insertados
SELECT '=== AUTORES ===' as Info;
SELECT * FROM autores;

SELECT '=== POSTS (ordenados por fecha DESC) ===' as Info;
SELECT Identificador, titulo, fecha FROM posts ORDER BY fecha DESC;

SELECT '=== VISTA POSTS_COMPLETOS ===' as Info;
SELECT * FROM posts_completos ORDER BY fecha DESC;
