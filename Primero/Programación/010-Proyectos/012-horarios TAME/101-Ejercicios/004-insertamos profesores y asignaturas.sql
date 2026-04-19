-- =========================================================
-- 1) (Solo si no existe) Añadir IPE 1 a SMR1 (curso_id = 3)
--    En tu dump actual, IPE 1 solo está en ASIR1 y DAM1.
-- =========================================================
INSERT INTO `asignaturas` (`id`, `curso_id`, `nombre`, `orden`)
SELECT 61, 3, 'IPE 1', 5
WHERE NOT EXISTS (
  SELECT 1 FROM `asignaturas`
  WHERE `curso_id` = 3 AND `nombre` = 'IPE 1'
);

-- =========================================================
-- 2) Crear tabla puente profesores_asignaturas
-- =========================================================
CREATE TABLE IF NOT EXISTS `profesores_asignaturas` (
  `profesor_id`   int UNSIGNED NOT NULL,
  `asignatura_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`profesor_id`, `asignatura_id`),
  KEY `idx_pa_asignatura` (`asignatura_id`),
  CONSTRAINT `fk_pa_profesor`
    FOREIGN KEY (`profesor_id`) REFERENCES `profesores` (`id`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pa_asignatura`
    FOREIGN KEY (`asignatura_id`) REFERENCES `asignaturas` (`id`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- =========================================================
-- 3) Insertar relaciones (según tus listas)
--    Nota: uso los IDs reales de tu tabla asignaturas.
-- =========================================================

-- Profesor 1
INSERT IGNORE INTO `profesores_asignaturas` (`profesor_id`, `asignatura_id`) VALUES
(1, 4),   -- Montaje y mantenimiento de equipos
(1, 8),   -- Servicios en red
(1, 9),   -- Aplicaciones web
(1, 60),  -- Proyecto intermodular II (SMR2)
(1, 16);  -- Sistemas informáticos

-- Profesor 2
INSERT IGNORE INTO `profesores_asignaturas` (`profesor_id`, `asignatura_id`) VALUES
(2, 1),   -- Redes locales
(2, 15),  -- Programación
(2, 26),  -- Sistemas de gestión empresarial
(2, 45),  -- Proyecto intermodular 1 (DAM1)
(2, 59),  -- Proyecto intermodular II (DAM2)
(2, 23);  -- Programación de servicios y procesos

-- Profesor 3
INSERT IGNORE INTO `profesores_asignaturas` (`profesor_id`, `asignatura_id`) VALUES
(3, 17),  -- Entornos de desarrollo
(3, 19),  -- Lenguajes de marcas y sistemas de gestión de información (DAM1)
(3, 18),  -- Bases de datos
(3, 22),  -- Acceso a datos
(3, 24),  -- Desarrollo de interfaces
(3, 25);  -- Programación multimedia y dispositivos móviles

-- Profesor 4
INSERT IGNORE INTO `profesores_asignaturas` (`profesor_id`, `asignatura_id`) VALUES
(4, 2),   -- Aplicaciones ofimáticas
(4, 3),   -- Sistemas operativos monopuesto
(4, 10),  -- Seguridad informática
(4, 54),  -- Digitalización (SMR2)
(4, 53);  -- Digitalización (DAM2)

-- Profesor 5
INSERT IGNORE INTO `profesores_asignaturas` (`profesor_id`, `asignatura_id`) VALUES
(5, 51),  -- Sostenibilidad (SMR2)
(5, 50),  -- Sostenibilidad (DAM2)
(5, 61),  -- IPE 1 (SMR1)  <-- añadida arriba si no existía
(5, 48),  -- IPE II (SMR2)
(5, 39),  -- IPE 1 (DAM1)
(5, 47);  -- IPE II (DAM2)

-- Profesor 6 (Inglés SMR1 y SMR2)
INSERT IGNORE INTO `profesores_asignaturas` (`profesor_id`, `asignatura_id`) VALUES
(6, 43),  -- Inglés 1 (SMR1)
(6, 57);  -- Inglés II (SMR2)

-- Profesor 7 (Inglés DAM1 y DAM2)
INSERT IGNORE INTO `profesores_asignaturas` (`profesor_id`, `asignatura_id`) VALUES
(7, 42),  -- Inglés 1 (DAM1)
(7, 56);  -- Inglés II (DAM2);
