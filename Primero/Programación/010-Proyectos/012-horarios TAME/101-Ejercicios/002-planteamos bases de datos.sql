CREATE DATABASE horariostame;
USE horariostame;

CREATE TABLE profesores (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(150) NOT NULL,
    email VARCHAR(150) UNIQUE,
    telefono VARCHAR(20),
    direccion VARCHAR(255),
    cp VARCHAR(10),
    localidad VARCHAR(100),
    especialidad VARCHAR(100),
    fecha_alta DATE,
    activo TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO profesores 
(nombre, apellidos, email, telefono, direccion, cp, localidad, especialidad, fecha_alta, activo)
VALUES
('Laura', 'Gómez Navarro', 'laura.gomez@centro.edu', '600123456', 'Calle Colón 15', '46004', 'Valencia', 'Programación', '2021-09-01', 1),

('Miguel', 'Serrano Pérez', 'miguel.serrano@centro.edu', '600234567', 'Avenida del Puerto 82', '46011', 'Valencia', 'Bases de Datos', '2020-09-01', 1),

('Ana', 'Martínez Ruiz', 'ana.martinez@centro.edu', '600345678', 'Calle San Vicente 210', '46007', 'Valencia', 'Lenguajes de Marcas', '2022-09-01', 1),

('Carlos', 'Domínguez Ortega', 'carlos.dominguez@centro.edu', '600456789', 'Calle Xàtiva 9', '46002', 'Valencia', 'Entornos de Desarrollo', '2019-09-01', 1),

('Elena', 'Vidal Romero', 'elena.vidal@centro.edu', '600567890', 'Gran Vía Ramón y Cajal 44', '46005', 'Valencia', 'Sistemas Informáticos', '2018-09-01', 1),

('Javier', 'Torres Molina', 'javier.torres@centro.edu', '600678901', 'Calle Aragón 63', '46021', 'Valencia', 'Acceso a Datos', '2023-09-01', 1);
