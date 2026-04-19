CREATE DATABASE mitienda;
USE mitienda;

CREATE TABLE clientes (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(150) NOT NULL,
    email VARCHAR(150),
    direccion VARCHAR(255),
    cp VARCHAR(10),
    localidad VARCHAR(100)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO clientes (nombre, apellidos, email, direccion, cp, localidad) VALUES
('Carlos', 'Martínez López', 'carlos.martinez@example.com', 'Calle Mayor 12', '46001', 'Valencia'),
('Ana', 'García Pérez', 'ana.garcia@example.com', 'Avenida del Puerto 45', '46011', 'Valencia'),
('Luis', 'Fernández Torres', 'luis.fernandez@example.com', 'Calle Colón 8', '46004', 'Valencia'),
('María', 'Sánchez Romero', 'maria.sanchez@example.com', 'Calle San Vicente 120', '46007', 'Valencia'),
('Javier', 'Navarro Gil', 'javier.navarro@example.com', 'Calle Xàtiva 33', '46002', 'Valencia'),
('Lucía', 'Ruiz Molina', 'lucia.ruiz@example.com', 'Avenida Blasco Ibáñez 67', '46021', 'Valencia'),
('Pedro', 'Ortega Castillo', 'pedro.ortega@example.com', 'Calle Quart 19', '46008', 'Valencia'),
('Elena', 'Vidal Moreno', 'elena.vidal@example.com', 'Calle Sagunto 55', '46009', 'Valencia'),
('Miguel', 'Herrera León', 'miguel.herrera@example.com', 'Calle Cádiz 14', '46006', 'Valencia'),
('Sara', 'Domínguez Ríos', 'sara.dominguez@example.com', 'Calle Sueca 88', '46006', 'Valencia'),

('David', 'Cano Ferrer', 'david.cano@example.com', 'Avenida Aragón 101', '46010', 'Valencia'),
('Paula', 'Ibáñez Costa', 'paula.ibanez@example.com', 'Calle Alboraya 23', '46010', 'Valencia'),
('Raúl', 'Campos Soto', 'raul.campos@example.com', 'Calle Ángel Guimerá 9', '46008', 'Valencia'),
('Marta', 'Reyes Pastor', 'marta.reyes@example.com', 'Calle Jesús 44', '46007', 'Valencia'),
('Sergio', 'Lorenzo Núñez', 'sergio.lorenzo@example.com', 'Calle Cuba 70', '46006', 'Valencia'),
('Natalia', 'Peña Bravo', 'natalia.pena@example.com', 'Calle Doctor Manuel Candela 31', '46021', 'Valencia'),
('Alberto', 'Soler Pardo', 'alberto.soler@example.com', 'Avenida Francia 15', '46023', 'Valencia'),
('Cristina', 'Méndez Rubio', 'cristina.mendez@example.com', 'Calle Río Tajo 6', '46920', 'Mislata'),
('Fernando', 'Calvo Serra', 'fernando.calvo@example.com', 'Calle Valencia 102', '46900', 'Torrent'),
('Laura', 'Blasco Esteve', 'laura.blasco@example.com', 'Calle Mayor 3', '46100', 'Burjassot');

CREATE TABLE productos (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    stock INT UNSIGNED DEFAULT 0,
    categoria VARCHAR(100),
    marca VARCHAR(100)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO productos (nombre, descripcion, precio, stock, categoria, marca) VALUES
('Balón de fútbol profesional', 'Balón oficial tamaño 5 para competición', 29.95, 50, 'Fútbol', 'Adibas'),
('Botas de fútbol FG', 'Botas para césped natural con tacos firmes', 79.90, 25, 'Fútbol', 'Nikke'),
('Guantes de portero', 'Guantes con agarre antideslizante', 34.50, 30, 'Fútbol', 'Reuschy'),

('Raqueta de tenis carbono', 'Raqueta ligera para jugadores avanzados', 119.99, 15, 'Tenis', 'Wilsonn'),
('Pelotas de tenis (pack 3)', 'Pelotas presurizadas competición', 8.95, 100, 'Tenis', 'Headz'),

('Balón de baloncesto indoor', 'Balón para pista cubierta', 24.99, 40, 'Baloncesto', 'Spaldingx'),
('Zapatillas baloncesto', 'Alta amortiguación y sujeción', 89.95, 20, 'Baloncesto', 'AirJump'),

('Bicicleta MTB 29"', 'Bicicleta de montaña aluminio', 599.00, 8, 'Ciclismo', 'MontyX'),
('Casco ciclismo', 'Casco ligero ventilado', 45.00, 35, 'Ciclismo', 'Girox'),
('Guantes ciclismo', 'Guantes transpirables', 19.95, 60, 'Ciclismo', 'RockPro'),

('Cinta de correr', 'Cinta eléctrica plegable', 699.99, 5, 'Fitness', 'FitRun'),
('Mancuernas ajustables', 'Juego de pesas hasta 20kg', 89.00, 18, 'Fitness', 'PowerGym'),
('Esterilla yoga', 'Esterilla antideslizante', 21.50, 70, 'Fitness', 'ZenFlex'),

('Gafas de natación', 'Antivaho competición', 14.95, 80, 'Natación', 'SpeedWave'),
('Tabla natación', 'Tabla flotación entrenamiento', 18.75, 40, 'Natación', 'AquaPro'),

('Pala pádel carbono', 'Control y potencia equilibrados', 129.00, 12, 'Pádel', 'Bullpad'),
('Pelotas pádel (pack 3)', 'Alta durabilidad', 6.95, 120, 'Pádel', 'DropShoty'),

('Mochila deportiva', 'Mochila multiuso resistente', 39.90, 45, 'Accesorios', 'SportBag'),
('Bidón deportivo', 'Botella 750ml sin BPA', 9.50, 90, 'Accesorios', 'HydroFit'),
('Reloj deportivo', 'Monitor actividad física', 149.99, 10, 'Electrónica deportiva', 'RunTech');

