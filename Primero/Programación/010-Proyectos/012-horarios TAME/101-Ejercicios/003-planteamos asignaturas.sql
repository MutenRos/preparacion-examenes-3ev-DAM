-- =========================================================
-- 1) CICLOS
-- =========================================================
CREATE TABLE ciclos (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  codigo VARCHAR(10) NOT NULL UNIQUE,          -- SMR, DAM, ASIR
  nombre VARCHAR(200) NOT NULL,
  grado ENUM('Medio','Superior') NOT NULL,
  familia VARCHAR(120) DEFAULT 'Informática y Comunicaciones'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================
-- 2) CURSOS (1º / 2º) POR CICLO
-- =========================================================
CREATE TABLE cursos (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  ciclo_id INT UNSIGNED NOT NULL,
  numero TINYINT UNSIGNED NOT NULL,            -- 1 o 2
  nombre VARCHAR(50) NOT NULL,                 -- "Primer curso", "Segundo curso"
  UNIQUE KEY uk_curso (ciclo_id, numero),
  CONSTRAINT fk_cursos_ciclo
    FOREIGN KEY (ciclo_id) REFERENCES ciclos(id)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================
-- 3) ASIGNATURAS (MÓDULOS) VINCULADAS A CURSO
-- =========================================================
CREATE TABLE asignaturas (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  curso_id INT UNSIGNED NOT NULL,
  nombre VARCHAR(200) NOT NULL,
  orden TINYINT UNSIGNED NOT NULL,
  UNIQUE KEY uk_asig (curso_id, nombre),
  CONSTRAINT fk_asig_curso
    FOREIGN KEY (curso_id) REFERENCES cursos(id)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================
-- INSERTS
-- =========================================================

-- CICLOS (solo SMR, DAM, ASIR; NO DAW)
INSERT INTO ciclos (codigo, nombre, grado, familia) VALUES
('SMR',  'Sistemas Microinformáticos y Redes',                 'Medio',   'Informática y Comunicaciones'),
('DAM',  'Desarrollo de Aplicaciones Multiplataforma',         'Superior','Informática y Comunicaciones'),
('ASIR', 'Administración de Sistemas Informáticos en Red',     'Superior','Informática y Comunicaciones');

-- CURSOS (1º y 2º por cada ciclo)
INSERT INTO cursos (ciclo_id, numero, nombre)
SELECT id, 1, 'Primer curso'  FROM ciclos WHERE codigo IN ('SMR','DAM','ASIR')
UNION ALL
SELECT id, 2, 'Segundo curso' FROM ciclos WHERE codigo IN ('SMR','DAM','ASIR');

-- =========================================================
-- ASIGNATURAS / MÓDULOS (según el índice del PDF)
-- =========================================================

-- ---------- SMR 1º ----------
INSERT INTO asignaturas (curso_id, nombre, orden)
SELECT c.id, x.nombre, x.orden
FROM cursos c
JOIN ciclos ci ON ci.id = c.ciclo_id AND ci.codigo='SMR' AND c.numero=1
JOIN (
  SELECT 1 AS orden, 'Redes locales' AS nombre
  UNION ALL SELECT 2, 'Aplicaciones ofimáticas'
  UNION ALL SELECT 3, 'Sistemas operativos monopuesto'
  UNION ALL SELECT 4, 'Montaje y mantenimiento de equipos'
) x;

-- ---------- SMR 2º ----------
INSERT INTO asignaturas (curso_id, nombre, orden)
SELECT c.id, x.nombre, x.orden
FROM cursos c
JOIN ciclos ci ON ci.id = c.ciclo_id AND ci.codigo='SMR' AND c.numero=2
JOIN (
  SELECT 1 AS orden, 'Servicios en red' AS nombre
  UNION ALL SELECT 2, 'Aplicaciones web'
  UNION ALL SELECT 3, 'Seguridad informática'
  UNION ALL SELECT 4, 'Sistemas operativos en red'
) x;

-- ---------- DAM 1º ----------
INSERT INTO asignaturas (curso_id, nombre, orden)
SELECT c.id, x.nombre, x.orden
FROM cursos c
JOIN ciclos ci ON ci.id = c.ciclo_id AND ci.codigo='DAM' AND c.numero=1
JOIN (
  SELECT 1 AS orden, 'Programación' AS nombre
  UNION ALL SELECT 2, 'Sistemas informáticos'
  UNION ALL SELECT 3, 'Entornos de desarrollo'
  UNION ALL SELECT 4, 'Bases de datos'
  UNION ALL SELECT 5, 'Lenguajes de marcas y sistemas de gestión de información'  -- (DAM1 en el índice)
) x;

-- ---------- DAM 2º ----------
INSERT INTO asignaturas (curso_id, nombre, orden)
SELECT c.id, x.nombre, x.orden
FROM cursos c
JOIN ciclos ci ON ci.id = c.ciclo_id AND ci.codigo='DAM' AND c.numero=2
JOIN (
  SELECT 1 AS orden, 'Acceso a datos' AS nombre
  UNION ALL SELECT 2, 'Programación de servicios y procesos'
  UNION ALL SELECT 3, 'Desarrollo de interfaces'
  UNION ALL SELECT 4, 'Programación multimedia y dispositivos móviles'
  UNION ALL SELECT 5, 'Sistemas de gestión empresarial'
) x;

-- ---------- ASIR 1º ----------
INSERT INTO asignaturas (curso_id, nombre, orden)
SELECT c.id, x.nombre, x.orden
FROM cursos c
JOIN ciclos ci ON ci.id = c.ciclo_id AND ci.codigo='ASIR' AND c.numero=1
JOIN (
  SELECT 1 AS orden, 'Implantación de sistemas operativos' AS nombre
  UNION ALL SELECT 2, 'Planificación y administración de redes'
  UNION ALL SELECT 3, 'Fundamentos de hardware'
  UNION ALL SELECT 4, 'Gestión de bases de datos'
  UNION ALL SELECT 5, 'Lenguajes de marcas y sistemas de gestión de información'
  UNION ALL SELECT 6, 'Administración de sistemas operativos'
  UNION ALL SELECT 7, 'Servicios de red e Internet'
) x;

-- ---------- ASIR 2º ----------
INSERT INTO asignaturas (curso_id, nombre, orden)
SELECT c.id, x.nombre, x.orden
FROM cursos c
JOIN ciclos ci ON ci.id = c.ciclo_id AND ci.codigo='ASIR' AND c.numero=2
JOIN (
  SELECT 1 AS orden, 'Implantación de aplicaciones web' AS nombre
  UNION ALL SELECT 2, 'Administración de sistemas gestores de bases de datos'
  UNION ALL SELECT 3, 'Seguridad y alta disponibilidad'
) x;
