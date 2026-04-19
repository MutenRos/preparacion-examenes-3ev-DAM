	-- 1) Crear tabla de días (catálogo)
	CREATE TABLE IF NOT EXISTS dias_semana (
	  id TINYINT UNSIGNED PRIMARY KEY,
	  nombre VARCHAR(20) NOT NULL UNIQUE,
	  orden TINYINT UNSIGNED NOT NULL UNIQUE
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

	-- 2) Poblar lunes-viernes
	INSERT INTO dias_semana (id, nombre, orden) VALUES
	(1,'Lunes',1),
	(2,'Martes',2),
	(3,'Miércoles',3),
	(4,'Jueves',4),
	(5,'Viernes',5)
	ON DUPLICATE KEY UPDATE nombre=VALUES(nombre), orden=VALUES(orden);

	-- 3) Añadir columna FK en asignaturas_slots
	ALTER TABLE asignaturas_slots
	  ADD COLUMN dia_id TINYINT UNSIGNED NOT NULL AFTER slot_id;

	-- 4) Índice + FK
	ALTER TABLE asignaturas_slots
	  ADD INDEX idx_asignaturas_slots_dia_id (dia_id),
	  ADD CONSTRAINT fk_asignaturas_slots_dia
		 FOREIGN KEY (dia_id) REFERENCES dias_semana(id)
		 ON UPDATE CASCADE
		 ON DELETE RESTRICT;
		 
		 
	ALTER TABLE asignaturas_slots
	  ADD UNIQUE KEY uq_asig_slot_dia (asignatura_id, slot_id, dia_id);
