PRAGMA foreign_keys = ON;

INSERT OR IGNORE INTO perfiles (id, nombre) VALUES
(1,'administrador'),(2,'gestor'),(3,'profesor'),(4,'alumno');

INSERT OR IGNORE INTO usuarios (id,nombre,apellidos,email,password_hash,perfil_id,activo) VALUES
(1,'Admin','Demo','admin@demo.local','$2y$12$J.K6kjQYWqSWfm9odinFDOx.I4buWIqSYspPOrgyTdfqmVwX9Vir.',1,1),
(2,'Gestor','Demo','gestor@demo.local','$2y$12$J.K6kjQYWqSWfm9odinFDOx.I4buWIqSYspPOrgyTdfqmVwX9Vir.',2,1),
(3,'Ana','Profesora','profesor@demo.local','$2y$12$J.K6kjQYWqSWfm9odinFDOx.I4buWIqSYspPOrgyTdfqmVwX9Vir.',3,1),
(4,'Luis','Alumno','alumno@demo.local','$2y$12$J.K6kjQYWqSWfm9odinFDOx.I4buWIqSYspPOrgyTdfqmVwX9Vir.',4,1),
(5,'Marta','Alumno','marta@demo.local','$2y$12$J.K6kjQYWqSWfm9odinFDOx.I4buWIqSYspPOrgyTdfqmVwX9Vir.',4,1);

INSERT OR IGNORE INTO profesores (id,usuario_id,especialidad,telefono) VALUES
(1,3,'Programación y bases de datos','600111222');

INSERT OR IGNORE INTO alumnos (id,usuario_id,fecha_nacimiento,telefono,direccion) VALUES
(1,4,'2007-04-14','600333444','Calle Mayor 1'),
(2,5,'2006-09-12','600555666','Avenida Central 8');

INSERT OR IGNORE INTO cursos (id,nombre,descripcion,activo) VALUES
(1,'Desarrollo de Aplicaciones Multiplataforma','Ciclo formativo DAM con contenidos de programación, bases de datos, entornos y sistemas.',1);

INSERT OR IGNORE INTO asignaturas (id,curso_id,nombre,descripcion,orden,activo) VALUES
(1,1,'Programación','Fundamentos de programación, estructuras de control, funciones, clases y desarrollo de aplicaciones.',1,1),
(2,1,'Bases de datos','Modelo relacional, SQL, diseño de bases de datos y consultas.',2,1),
(3,1,'Lenguajes de marcas','HTML, CSS, XML, JSON y transformación de documentos.',3,1);

INSERT OR IGNORE INTO curso_ediciones (id,curso_id,nombre,fecha_inicio,fecha_fin,activo) VALUES
(1,1,'DAM 2025-2026','2025-09-15','2026-06-30',1);

INSERT OR IGNORE INTO asignatura_ediciones (id,asignatura_id,curso_edicion_id,profesor_id,fecha_inicio,fecha_fin,activo) VALUES
(1,1,1,1,'2025-09-15','2026-06-30',1),
(2,2,1,1,'2025-09-15','2026-06-30',1),
(3,3,1,1,'2025-09-15','2026-06-30',1);

INSERT OR IGNORE INTO matriculas (id,usuario_id,asignatura_edicion_id,tipo,activo) VALUES
(1,4,1,'alumno',1),(2,4,2,'alumno',1),(3,4,3,'alumno',1),
(4,5,1,'alumno',1),(5,5,2,'alumno',1),
(6,3,1,'profesor',1),(7,3,2,'profesor',1),(8,3,3,'profesor',1);

INSERT OR IGNORE INTO unidades (id,asignatura_id,titulo,descripcion,orden) VALUES
(1,1,'Unidad 1. Introducción a la programación','Primeros conceptos: programa, variable, instrucción, algoritmo y ejecución.',1),
(2,1,'Unidad 2. Estructuras de control','Condicionales, bucles y control del flujo del programa.',2),
(3,2,'Unidad 1. Modelo relacional','Tablas, claves primarias, claves foráneas y relaciones.',1),
(4,3,'Unidad 1. HTML y estructura','Estructura básica de una página web.',1);

INSERT OR IGNORE INTO subunidades (id,unidad_id,titulo,descripcion,orden) VALUES
(1,1,'Variables y tipos de datos','Uso de variables, tipos numéricos, cadenas y booleanos.',1),
(2,1,'Entrada y salida','Lectura de datos y presentación de resultados.',2),
(3,2,'Condicionales','Uso de if, else y condiciones compuestas.',1),
(4,3,'Tablas y registros','Organización de datos en tablas.',1),
(5,4,'Documento HTML mínimo','Etiquetas principales de un documento HTML.',1);

INSERT OR IGNORE INTO lecciones (id,subunidad_id,titulo,descripcion,orden) VALUES
(1,1,'Qué es una variable','Una variable permite guardar un dato temporalmente para reutilizarlo durante la ejecución del programa.',1),
(2,1,'Tipos básicos','Números enteros, decimales, cadenas de texto y valores lógicos.',2),
(3,3,'Condicional if','El condicional permite ejecutar una parte del código solo si se cumple una condición.',1),
(4,4,'Crear tablas','Una tabla almacena registros con la misma estructura de campos.',1),
(5,5,'Estructura básica','Uso de html, head, title y body.',1);

INSERT OR IGNORE INTO sesiones (id,leccion_id,titulo,fecha,hora_inicio,hora_fin,descripcion) VALUES
(1,1,'Sesión 1. Presentación de variables','2025-09-16','09:00','10:50','Clase práctica con ejemplos sencillos de variables.'),
(2,2,'Sesión 2. Tipos básicos','2025-09-18','09:00','10:50','Ejercicios con números, textos y booleanos.'),
(3,3,'Sesión 3. Condicionales','2025-09-23','09:00','10:50','Resolución de problemas usando if y else.'),
(4,4,'Sesión 1. Tablas SQL','2025-09-17','11:10','13:00','Creación de tablas y campos.'),
(5,5,'Sesión 1. HTML mínimo','2025-09-19','11:10','13:00','Primera página HTML.' );

INSERT OR IGNORE INTO recursos (id,leccion_id,titulo,descripcion,tipo,url,archivo,orden) VALUES
(1,1,'Apuntes de variables','Documento de apoyo sobre variables.','url','https://example.com/variables',NULL,1);

INSERT OR IGNORE INTO actividades (id,leccion_id,titulo,descripcion,fecha_entrega,puntuacion_maxima,orden) VALUES
(1,1,'Ejercicio de variables','Crear un programa que use variables para calcular un resultado.','2025-09-30',10,1);
