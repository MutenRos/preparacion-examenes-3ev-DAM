CREATE TABLE slots (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    tipo ENUM('clase','descanso') DEFAULT 'clase',
    orden INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO slots (nombre, hora_inicio, hora_fin, tipo, orden) VALUES
('Clase 1', '08:30:00', '09:20:00', 'clase', 1),
('Clase 2', '09:20:00', '10:10:00', 'clase', 2),
('Clase 3', '10:10:00', '11:00:00', 'clase', 3),
('Descanso', '11:00:00', '11:30:00', 'descanso', 4),
('Clase 4', '11:30:00', '12:20:00', 'clase', 5),
('Clase 5', '12:20:00', '13:10:00', 'clase', 6),
('Clase 6', '13:10:00', '14:00:00', 'clase', 7);
