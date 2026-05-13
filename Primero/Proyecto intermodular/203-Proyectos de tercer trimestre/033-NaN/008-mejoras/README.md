# Centro LMS v1

Primera versión funcional en **HTML, CSS, JS, PHP y SQLite**.

## Acceso rápido

La aplicación ya incluye una base de datos de muestra en:

```text
storage/database.sqlite
```

Usuarios demo, todos con contraseña `1234`:

- `alumno@demo.local`
- `profesor@demo.local`
- `gestor@demo.local`
- `admin@demo.local`

## Cómo ejecutar

Desde la carpeta del proyecto:

```bash
php -S localhost:8000 -t public
```

Abrir en el navegador:

```text
http://localhost:8000
```

## Requisitos

PHP con soporte para PDO SQLite:

```bash
sudo apt install php-sqlite3
```

## Estructura

```text
app/
  auth.php
  config.php
  db.php
public/
  index.php
  assets/
    style.css
    app.js
storage/
  schema.sql
  seed.sql
  database.sqlite
```

## Perfiles

### Alumno

- Login.
- Grid con asignaturas matriculadas.
- Vista de asignatura con árbol de contenidos a la izquierda y contenido a la derecha.

### Profesor

- Lo mismo que alumno.
- CRUD de unidades, subunidades, lecciones y sesiones.

### Gestor / Administrador

- Lo mismo que profesor.
- Menú lateral tipo WordPress con CRUDs generales.
- CRUD de usuarios, alumnos, profesores, cursos, asignaturas, ediciones, matrículas, contenidos, recursos y actividades.

## Nota

Es una primera versión deliberadamente sencilla. Los CRUDs son genéricos y usan IDs directamente. En una siguiente versión convendría sustituir esos campos por desplegables, mejorar permisos por edición y separar controladores/vistas.
