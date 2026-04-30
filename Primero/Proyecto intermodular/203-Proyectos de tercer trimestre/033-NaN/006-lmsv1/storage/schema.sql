PRAGMA foreign_keys = ON;

CREATE TABLE IF NOT EXISTS perfiles (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL UNIQUE
);
CREATE TABLE IF NOT EXISTS usuarios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    apellidos TEXT,
    email TEXT NOT NULL UNIQUE,
    password_hash TEXT NOT NULL,
    perfil_id INTEGER NOT NULL,
    activo INTEGER NOT NULL DEFAULT 1,
    creado_en TEXT DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (perfil_id) REFERENCES perfiles(id)
);
CREATE TABLE IF NOT EXISTS alumnos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    usuario_id INTEGER NOT NULL UNIQUE,
    fecha_nacimiento TEXT,
    telefono TEXT,
    direccion TEXT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);
CREATE TABLE IF NOT EXISTS profesores (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    usuario_id INTEGER NOT NULL UNIQUE,
    especialidad TEXT,
    telefono TEXT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);
CREATE TABLE IF NOT EXISTS cursos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    descripcion TEXT,
    activo INTEGER NOT NULL DEFAULT 1
);
CREATE TABLE IF NOT EXISTS asignaturas (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    curso_id INTEGER NOT NULL,
    nombre TEXT NOT NULL,
    descripcion TEXT,
    orden INTEGER DEFAULT 0,
    activo INTEGER NOT NULL DEFAULT 1,
    FOREIGN KEY (curso_id) REFERENCES cursos(id)
);
CREATE TABLE IF NOT EXISTS curso_ediciones (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    curso_id INTEGER NOT NULL,
    nombre TEXT NOT NULL,
    fecha_inicio TEXT,
    fecha_fin TEXT,
    activo INTEGER NOT NULL DEFAULT 1,
    FOREIGN KEY (curso_id) REFERENCES cursos(id)
);
CREATE TABLE IF NOT EXISTS asignatura_ediciones (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    asignatura_id INTEGER NOT NULL,
    curso_edicion_id INTEGER NOT NULL,
    profesor_id INTEGER,
    fecha_inicio TEXT,
    fecha_fin TEXT,
    activo INTEGER NOT NULL DEFAULT 1,
    FOREIGN KEY (asignatura_id) REFERENCES asignaturas(id),
    FOREIGN KEY (curso_edicion_id) REFERENCES curso_ediciones(id),
    FOREIGN KEY (profesor_id) REFERENCES profesores(id)
);
CREATE TABLE IF NOT EXISTS matriculas (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    usuario_id INTEGER NOT NULL,
    asignatura_edicion_id INTEGER NOT NULL,
    tipo TEXT NOT NULL CHECK (tipo IN ('alumno', 'profesor')),
    fecha_matricula TEXT DEFAULT CURRENT_TIMESTAMP,
    activo INTEGER NOT NULL DEFAULT 1,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (asignatura_edicion_id) REFERENCES asignatura_ediciones(id),
    UNIQUE (usuario_id, asignatura_edicion_id, tipo)
);
CREATE TABLE IF NOT EXISTS unidades (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    asignatura_id INTEGER NOT NULL,
    titulo TEXT NOT NULL,
    descripcion TEXT,
    orden INTEGER DEFAULT 0,
    FOREIGN KEY (asignatura_id) REFERENCES asignaturas(id)
);
CREATE TABLE IF NOT EXISTS subunidades (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    unidad_id INTEGER NOT NULL,
    titulo TEXT NOT NULL,
    descripcion TEXT,
    orden INTEGER DEFAULT 0,
    FOREIGN KEY (unidad_id) REFERENCES unidades(id)
);
CREATE TABLE IF NOT EXISTS lecciones (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    subunidad_id INTEGER NOT NULL,
    titulo TEXT NOT NULL,
    descripcion TEXT,
    orden INTEGER DEFAULT 0,
    FOREIGN KEY (subunidad_id) REFERENCES subunidades(id)
);
CREATE TABLE IF NOT EXISTS sesiones (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    leccion_id INTEGER NOT NULL,
    titulo TEXT NOT NULL,
    fecha TEXT NOT NULL,
    hora_inicio TEXT,
    hora_fin TEXT,
    descripcion TEXT,
    FOREIGN KEY (leccion_id) REFERENCES lecciones(id)
);
CREATE TABLE IF NOT EXISTS recursos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    leccion_id INTEGER NOT NULL,
    titulo TEXT NOT NULL,
    descripcion TEXT,
    tipo TEXT,
    url TEXT,
    archivo TEXT,
    orden INTEGER DEFAULT 0,
    FOREIGN KEY (leccion_id) REFERENCES lecciones(id)
);
CREATE TABLE IF NOT EXISTS actividades (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    leccion_id INTEGER NOT NULL,
    titulo TEXT NOT NULL,
    descripcion TEXT,
    fecha_entrega TEXT,
    puntuacion_maxima REAL DEFAULT 10,
    orden INTEGER DEFAULT 0,
    FOREIGN KEY (leccion_id) REFERENCES lecciones(id)
);
