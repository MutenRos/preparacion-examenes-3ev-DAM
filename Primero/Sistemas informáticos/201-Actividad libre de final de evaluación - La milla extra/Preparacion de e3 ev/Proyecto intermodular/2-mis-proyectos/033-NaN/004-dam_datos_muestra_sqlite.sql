PRAGMA foreign_keys = ON;

-- ============================================================
-- DATOS DE MUESTRA PARA CENTRO DE FORMACIÓN - DAM
-- Ciclo: Desarrollo de Aplicaciones Multiplataforma
-- Curso académico: 2025-2026
-- Base pensada para el esquema SQLite propuesto anteriormente
-- ============================================================


-- ------------------------------------------------------------
-- Usuarios
-- password_hash es ficticio para entorno de pruebas
-- ------------------------------------------------------------
INSERT INTO usuarios (id, nombre, apellidos, email, password_hash, perfil_id, activo) VALUES
(1, 'Jose Vicente', 'Carratalá Sanchis', 'josevicente@centro.local', 'hash_demo_admin', 1, 1),
(2, 'Marta', 'Soler Ferrando', 'marta.soler@centro.local', 'hash_demo_gestor', 2, 1),
(3, 'Laura', 'Navarro Ruiz', 'laura.navarro@centro.local', 'hash_demo_profesor', 3, 1),
(4, 'Carlos', 'Gimeno Vidal', 'carlos.gimeno@centro.local', 'hash_demo_profesor', 3, 1),
(5, 'Ana', 'Beltrán Martí', 'ana.beltran@centro.local', 'hash_demo_profesor', 3, 1),
(6, 'Sergio', 'Molina Torres', 'sergio.molina@centro.local', 'hash_demo_profesor', 3, 1),
(7, 'Andrea', 'Benet Gironés', 'andrea.benet@alumnos.local', 'hash_demo_alumno', 4, 1),
(8, 'Pablo', 'Martínez López', 'pablo.martinez@alumnos.local', 'hash_demo_alumno', 4, 1),
(9, 'Lucía', 'García Ferrer', 'lucia.garcia@alumnos.local', 'hash_demo_alumno', 4, 1),
(10, 'Hugo', 'Sánchez Mora', 'hugo.sanchez@alumnos.local', 'hash_demo_alumno', 4, 1),
(11, 'Marina', 'Torres Ribes', 'marina.torres@alumnos.local', 'hash_demo_alumno', 4, 1),
(12, 'Álvaro', 'Campos Ortega', 'alvaro.campos@alumnos.local', 'hash_demo_alumno', 4, 1);

-- ------------------------------------------------------------
-- Profesores
-- ------------------------------------------------------------
INSERT INTO profesores (id, usuario_id, especialidad, telefono) VALUES
(1, 1, 'Programación, bases de datos, inteligencia artificial y desarrollo web', '600000001'),
(2, 3, 'Lenguajes de marcas e interfaces', '600000002'),
(3, 4, 'Sistemas informáticos y redes', '600000003'),
(4, 5, 'Entornos de desarrollo y proyecto intermodular', '600000004'),
(5, 6, 'Empresa, digitalización y empleabilidad', '600000005');

-- ------------------------------------------------------------
-- Alumnos
-- ------------------------------------------------------------
INSERT INTO alumnos (id, usuario_id, fecha_nacimiento, telefono, direccion) VALUES
(1, 7, '2006-02-14', '611000001', 'Calle Mayor 1, Valencia'),
(2, 8, '2005-11-20', '611000002', 'Avenida del Puerto 23, Valencia'),
(3, 9, '2006-07-08', '611000003', 'Calle Colón 12, Valencia'),
(4, 10, '2005-04-30', '611000004', 'Calle San Vicente 45, Valencia'),
(5, 11, '2006-09-17', '611000005', 'Calle Quart 9, Valencia'),
(6, 12, '2005-12-03', '611000006', 'Avenida Blasco Ibáñez 88, Valencia');

-- ------------------------------------------------------------
-- Curso
-- ------------------------------------------------------------
INSERT INTO cursos (id, nombre, descripcion, activo) VALUES
(1, 'Desarrollo de Aplicaciones Multiplataforma', 'Ciclo formativo de grado superior orientado al desarrollo de software, bases de datos, interfaces, sistemas y proyectos de aplicaciones multiplataforma.', 1);

-- ------------------------------------------------------------
-- Asignaturas / módulos del ciclo DAM
-- ------------------------------------------------------------
INSERT INTO asignaturas (id, curso_id, nombre, descripcion, orden, activo) VALUES
(1, 1, 'Programación', 'Fundamentos de programación, estructuras de control, funciones, objetos, colecciones y desarrollo de aplicaciones.', 1, 1),
(2, 1, 'Bases de Datos', 'Diseño, creación, consulta y administración de bases de datos relacionales.', 2, 1),
(3, 1, 'Lenguajes de Marcas y Sistemas de Gestión de Información', 'HTML, CSS, XML, JSON, validación, transformación y representación de información.', 3, 1),
(4, 1, 'Entornos de Desarrollo', 'Herramientas de desarrollo, control de versiones, depuración, pruebas y documentación.', 4, 1),
(5, 1, 'Sistemas Informáticos', 'Sistemas operativos, redes, servidores, virtualización y administración básica.', 5, 1),
(6, 1, 'Acceso a Datos', 'Persistencia, ficheros, bases de datos, ORM, servicios y tratamiento de información.', 6, 1),
(7, 1, 'Desarrollo de Interfaces', 'Diseño y programación de interfaces gráficas y experiencia de usuario.', 7, 1),
(8, 1, 'Programación Multimedia y Dispositivos Móviles', 'Aplicaciones móviles, multimedia, sensores, almacenamiento y despliegue.', 8, 1),
(9, 1, 'Programación de Servicios y Procesos', 'Concurrencia, sockets, servicios, procesos e integración de sistemas.', 9, 1),
(10, 1, 'Sistemas de Gestión Empresarial', 'ERP, CRM, gestión empresarial, parametrización e integración.', 10, 1),
(11, 1, 'Proyecto Intermodular DAM', 'Proyecto integrador de desarrollo de software con análisis, diseño, implementación y presentación.', 11, 1),
(12, 1, 'Empresa e Iniciativa Emprendedora', 'Empresa, emprendimiento, modelos de negocio y empleabilidad.', 12, 1);

-- ------------------------------------------------------------
-- Edición del curso
-- ------------------------------------------------------------
INSERT INTO curso_ediciones (id, curso_id, nombre, fecha_inicio, fecha_fin, activo) VALUES
(1, 1, 'DAM 2025-2026', '2025-09-15', '2026-06-30', 1);

-- ------------------------------------------------------------
-- Ediciones de asignatura
-- ------------------------------------------------------------
INSERT INTO asignatura_ediciones (id, asignatura_id, curso_edicion_id, profesor_id, fecha_inicio, fecha_fin, activo) VALUES
(1, 1, 1, 1, '2025-09-15', '2026-06-30', 1),
(2, 2, 1, 1, '2025-09-15', '2026-06-30', 1),
(3, 3, 1, 2, '2025-09-15', '2026-06-30', 1),
(4, 4, 1, 4, '2025-09-15', '2026-06-30', 1),
(5, 5, 1, 3, '2025-09-15', '2026-06-30', 1),
(6, 6, 1, 1, '2025-09-15', '2026-06-30', 1),
(7, 7, 1, 2, '2025-09-15', '2026-06-30', 1),
(8, 8, 1, 1, '2025-09-15', '2026-06-30', 1),
(9, 9, 1, 3, '2025-09-15', '2026-06-30', 1),
(10, 10, 1, 5, '2025-09-15', '2026-06-30', 1),
(11, 11, 1, 4, '2025-09-15', '2026-06-30', 1),
(12, 12, 1, 5, '2025-09-15', '2026-06-30', 1);

-- ------------------------------------------------------------
-- Matrículas de alumnos en varias asignaturas
-- ------------------------------------------------------------
INSERT INTO matriculas (usuario_id, asignatura_edicion_id, tipo, activo) VALUES
(7, 1, 'alumno', 1), (7, 2, 'alumno', 1), (7, 3, 'alumno', 1), (7, 4, 'alumno', 1), (7, 5, 'alumno', 1),
(8, 1, 'alumno', 1), (8, 2, 'alumno', 1), (8, 3, 'alumno', 1), (8, 4, 'alumno', 1), (8, 5, 'alumno', 1),
(9, 1, 'alumno', 1), (9, 2, 'alumno', 1), (9, 3, 'alumno', 1), (9, 4, 'alumno', 1), (9, 5, 'alumno', 1),
(10, 6, 'alumno', 1), (10, 7, 'alumno', 1), (10, 8, 'alumno', 1), (10, 9, 'alumno', 1), (10, 10, 'alumno', 1), (10, 11, 'alumno', 1),
(11, 6, 'alumno', 1), (11, 7, 'alumno', 1), (11, 8, 'alumno', 1), (11, 9, 'alumno', 1), (11, 10, 'alumno', 1), (11, 11, 'alumno', 1),
(12, 6, 'alumno', 1), (12, 7, 'alumno', 1), (12, 8, 'alumno', 1), (12, 9, 'alumno', 1), (12, 10, 'alumno', 1), (12, 11, 'alumno', 1);

-- Matrículas de profesores en sus asignaturas
INSERT INTO matriculas (usuario_id, asignatura_edicion_id, tipo, activo) VALUES
(1, 1, 'profesor', 1),
(1, 2, 'profesor', 1),
(1, 6, 'profesor', 1),
(1, 8, 'profesor', 1),
(3, 3, 'profesor', 1),
(3, 7, 'profesor', 1),
(4, 5, 'profesor', 1),
(4, 9, 'profesor', 1),
(5, 4, 'profesor', 1),
(5, 11, 'profesor', 1),
(6, 10, 'profesor', 1),
(6, 12, 'profesor', 1);

-- ------------------------------------------------------------
-- Estructura didáctica de varias asignaturas
-- ------------------------------------------------------------
INSERT INTO unidades (id, asignatura_id, titulo, descripcion, orden) VALUES
(1, 1, 'Fundamentos de programación', 'Primer contacto con algoritmos, variables, operadores y estructuras de control.', 1),
(2, 1, 'Programación orientada a objetos', 'Clases, objetos, encapsulación, herencia y polimorfismo.', 2),
(3, 2, 'Modelo relacional y SQL', 'Tablas, claves, relaciones, consultas y manipulación de datos.', 1),
(4, 2, 'Diseño de bases de datos', 'Modelo entidad-relación, normalización y diseño lógico.', 2),
(5, 3, 'HTML, CSS y documentos estructurados', 'Lenguajes de marcas para representar información.', 1),
(6, 5, 'Sistemas operativos y redes', 'Administración básica de sistemas y conceptos esenciales de red.', 1),
(7, 11, 'Proyecto de software', 'Planificación y desarrollo de un proyecto intermodular completo.', 1);

INSERT INTO subunidades (id, unidad_id, titulo, descripcion, orden) VALUES
(1, 1, 'Variables y tipos de datos', 'Uso de datos simples y expresiones.', 1),
(2, 1, 'Condicionales y bucles', 'Control del flujo de ejecución.', 2),
(3, 2, 'Clases y objetos', 'Definición de clases e instanciación de objetos.', 1),
(4, 3, 'Consultas SELECT', 'Consulta de información mediante SQL.', 1),
(5, 3, 'DDL y DML', 'Creación y modificación de estructuras y datos.', 2),
(6, 4, 'Modelo entidad-relación', 'Identificación de entidades, atributos y relaciones.', 1),
(7, 5, 'HTML semántico', 'Estructura de páginas web con etiquetas semánticas.', 1),
(8, 5, 'CSS básico', 'Selectores, caja, colores, tipografías y layout inicial.', 2),
(9, 6, 'Linux y terminal', 'Comandos básicos, rutas, permisos y procesos.', 1),
(10, 7, 'Análisis del proyecto', 'Requisitos, entidades y casos de uso.', 1),
(11, 7, 'Implementación del proyecto', 'Construcción incremental de una aplicación funcional.', 2);

INSERT INTO lecciones (id, subunidad_id, titulo, descripcion, orden) VALUES
(1, 1, 'Primer programa y variables', 'Creación de un primer programa y declaración de variables.', 1),
(2, 2, 'Estructuras condicionales', 'Uso de if, else y condiciones compuestas.', 1),
(3, 2, 'Bucles', 'Uso de while, for y repetición controlada.', 2),
(4, 3, 'Diseño de una clase', 'Atributos, métodos y constructores.', 1),
(5, 4, 'Consulta básica SELECT', 'SELECT, FROM, WHERE y ORDER BY.', 1),
(6, 5, 'Creación de tablas', 'CREATE TABLE, claves primarias y tipos de datos.', 1),
(7, 6, 'Diseño de entidades', 'Del enunciado al modelo de datos.', 1),
(8, 7, 'Estructura HTML de una página', 'Uso de header, nav, main, section, article y footer.', 1),
(9, 8, 'Maquetación sencilla con CSS', 'Caja, márgenes, padding y estilos base.', 1),
(10, 9, 'Comandos básicos de Linux', 'ls, cd, pwd, cp, mv, rm, mkdir y permisos.', 1),
(11, 10, 'Definición del alcance del proyecto', 'Objetivos, usuarios y funcionalidades principales.', 1),
(12, 11, 'Primera versión funcional', 'Desarrollo de una versión mínima viable.', 1);

INSERT INTO sesiones (id, leccion_id, titulo, fecha, hora_inicio, hora_fin, descripcion) VALUES
(1, 1, 'Sesión 1 - Variables', '2025-09-16', '09:00', '10:50', 'Introducción práctica a variables y tipos.'),
(2, 2, 'Sesión 2 - Condicionales', '2025-09-18', '09:00', '10:50', 'Ejercicios con estructuras if/else.'),
(3, 3, 'Sesión 3 - Bucles', '2025-09-23', '09:00', '10:50', 'Resolución de problemas repetitivos.'),
(4, 4, 'Sesión 4 - Clases', '2025-10-02', '09:00', '10:50', 'Primera clase con atributos y métodos.'),
(5, 5, 'Sesión 5 - SELECT', '2025-09-17', '11:10', '13:00', 'Consultas SQL básicas.'),
(6, 6, 'Sesión 6 - CREATE TABLE', '2025-09-24', '11:10', '13:00', 'Creación de tablas en SQLite/MySQL.'),
(7, 7, 'Sesión 7 - Entidades', '2025-10-01', '11:10', '13:00', 'Diseño entidad-relación.'),
(8, 8, 'Sesión 8 - HTML semántico', '2025-09-19', '08:00', '09:50', 'Creación de estructura HTML.'),
(9, 9, 'Sesión 9 - CSS base', '2025-09-26', '08:00', '09:50', 'Aplicación de estilos profesionales.'),
(10, 10, 'Sesión 10 - Terminal Linux', '2025-09-22', '10:00', '11:50', 'Primeros comandos en terminal.'),
(11, 11, 'Sesión 11 - Alcance del proyecto', '2025-10-06', '12:00', '13:50', 'Definición del proyecto intermodular.'),
(12, 12, 'Sesión 12 - MVP', '2025-10-20', '12:00', '13:50', 'Construcción de una primera versión funcional.');

-- ------------------------------------------------------------
-- Recursos para lecciones
-- ------------------------------------------------------------
INSERT INTO recursos (id, leccion_id, titulo, descripcion, tipo, url, archivo, orden) VALUES
(1, 1, 'Apuntes de variables', 'Documento introductorio sobre variables, tipos y operadores.', 'pdf', NULL, 'recursos/programacion/variables.pdf', 1),
(2, 1, 'Código de ejemplo: variables', 'Ejemplo inicial de programa con variables.', 'codigo', NULL, 'recursos/programacion/variables.py', 2),
(3, 2, 'Guía de condicionales', 'Resumen visual de estructuras condicionales.', 'pdf', NULL, 'recursos/programacion/condicionales.pdf', 1),
(4, 3, 'Ejercicios de bucles', 'Colección de ejercicios resueltos y propuestos.', 'pdf', NULL, 'recursos/programacion/bucles.pdf', 1),
(5, 5, 'Dataset de ejemplo', 'Base de datos SQLite para practicar SELECT.', 'sqlite', NULL, 'recursos/bases-datos/tienda.sqlite', 1),
(6, 6, 'Chuleta CREATE TABLE', 'Resumen de sintaxis para crear tablas.', 'pdf', NULL, 'recursos/bases-datos/create-table.pdf', 1),
(7, 8, 'Plantilla HTML inicial', 'Archivo HTML base para comenzar una página.', 'codigo', NULL, 'recursos/marcas/plantilla.html', 1),
(8, 9, 'CSS profesional sencillo', 'Hoja de estilos base limpia y reutilizable.', 'codigo', NULL, 'recursos/marcas/estilos.css', 1),
(9, 10, 'Guía rápida de Linux', 'Comandos básicos de terminal.', 'pdf', NULL, 'recursos/sistemas/linux-basico.pdf', 1),
(10, 11, 'Plantilla de análisis', 'Documento para definir requisitos y alcance.', 'docx', NULL, 'recursos/proyecto/plantilla-analisis.docx', 1),
(11, 12, 'Repositorio de ejemplo', 'Repositorio base para iniciar el proyecto.', 'url', 'https://example.local/repos/proyecto-dam', NULL, 1);

-- ------------------------------------------------------------
-- Actividades para lecciones
-- ------------------------------------------------------------
INSERT INTO actividades (id, leccion_id, titulo, descripcion, fecha_entrega, puntuacion_maxima, orden) VALUES
(1, 1, 'Actividad 1 - Calculadora básica', 'Crear un programa que use variables y operadores para calcular importes.', '2025-09-23', 10, 1),
(2, 2, 'Actividad 2 - Validación de edad', 'Crear un programa que indique si una persona es menor o mayor de edad.', '2025-09-25', 10, 1),
(3, 3, 'Actividad 3 - Tabla de multiplicar', 'Crear una tabla de multiplicar usando bucles.', '2025-09-30', 10, 1),
(4, 4, 'Actividad 4 - Clase Alumno', 'Crear una clase Alumno con atributos y métodos básicos.', '2025-10-09', 10, 1),
(5, 5, 'Actividad 5 - Consultas SELECT', 'Resolver consultas sobre una base de datos de tienda.', '2025-09-24', 10, 1),
(6, 6, 'Actividad 6 - Crear base de datos académica', 'Diseñar tablas para alumnos, profesores, cursos y matrículas.', '2025-10-01', 10, 1),
(7, 7, 'Actividad 7 - Modelo ER de centro de formación', 'Diseñar un modelo entidad-relación para un centro educativo.', '2025-10-08', 10, 1),
(8, 8, 'Actividad 8 - Página semántica', 'Crear una página HTML con estructura semántica completa.', '2025-09-26', 10, 1),
(9, 9, 'Actividad 9 - Estilizar la página', 'Aplicar CSS limpio y profesional a la página HTML.', '2025-10-03', 10, 1),
(10, 10, 'Actividad 10 - Práctica de terminal', 'Resolver una práctica de navegación, carpetas y permisos.', '2025-09-29', 10, 1),
(11, 11, 'Actividad 11 - Documento de alcance', 'Redactar el alcance del proyecto intermodular.', '2025-10-13', 10, 1),
(12, 12, 'Actividad 12 - MVP del proyecto', 'Entregar una primera versión funcional con base de datos e interfaz.', '2025-10-27', 10, 1);

