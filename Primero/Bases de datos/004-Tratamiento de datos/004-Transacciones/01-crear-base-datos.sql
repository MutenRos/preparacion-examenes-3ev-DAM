-- Script: 01-crear-base-datos.sql
-- Descripción: Crear la base de datos tiendaonline2526
-- Autor: Darío Lacal
-- Fecha: 2025-12-07

-- Eliminar la base de datos si existe (para limpiar)
-- DROP DATABASE IF EXISTS tiendaonline2526;

-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS tiendaonline2526 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

-- Cambiar al contexto de la base de datos
USE tiendaonline2526;

-- Mostrar confirmación
SELECT 'Base de datos tiendaonline2526 creada exitosamente' AS resultado;
