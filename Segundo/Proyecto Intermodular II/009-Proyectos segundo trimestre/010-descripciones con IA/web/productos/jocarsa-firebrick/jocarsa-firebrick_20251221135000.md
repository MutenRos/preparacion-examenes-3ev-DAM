# Reporte de proyecto

## Estructura del proyecto

```
/var/www/html/jocarsa-firebrick
├── .gitignore
├── README.md
├── bloques
│   ├── Archivo sin título
│   ├── escritorio.php
│   ├── foldertree.php
│   ├── loginbox.php
│   └── modal.php
├── css
│   └── estilo.css
├── firebrick.png
├── funciones
│   ├── isAdmin.php
│   ├── isCustomer.php
│   ├── isLoggedIn.php
│   ├── login.php
│   └── logout.php
├── inc
│   ├── dbinit.php
│   └── foldunfold.php
├── index.php
├── projects.db
├── router
│   ├── addcomment.php
│   ├── createcustomer.php
│   ├── createfolder.php
│   ├── createiteration.php
│   ├── createproject.php
│   ├── deletecustomer.php
│   ├── deletefolder.php
│   ├── deleteiteration.php
│   ├── deleteproject.php
│   ├── loginform.php
│   ├── signupform.php
│   ├── updatecursomer.php
│   └── updateiteration.php
└── uploads
```

## Código (intercalado)

# jocarsa-firebrick
**README.md**
```markdown
# jocarsa-firebrick

# Manual de Usuario 
**Sistema de gestión de carpetas, proyectos e iteraciones con soporte de comentarios y usuarios (admins y clientes).**

Este documento describe cómo utilizar el software basado en el archivo PHP compartido. El sistema permite a un administrador crear carpetas, proyectos e iteraciones (videos), así como crear y administrar cuentas de clientes. Los clientes pueden iniciar sesión para ver las iteraciones y dejar comentarios.

---

## Tabla de Contenido

1. [Introducción](#introducción)  
2. [Requerimientos](#requerimientos)  
3. [Instalación y Configuración](#instalación-y-configuración)  
4. [Estructura de Datos (Tablas)](#estructura-de-datos-tablas)  
5. [Inicio de Sesión y Registro](#inicio-de-sesión-y-registro)  
6. [Interfaz de Usuario](#interfaz-de-usuario)  
   1. [Panel Lateral (Carpetas y Proyectos)](#panel-lateral-carpetas-y-proyectos)  
   2. [Panel Principal (Contenido)](#panel-principal-contenido)  
7. [Operaciones para Administradores](#operaciones-para-administradores)  
   1. [Crear Carpeta](#crear-carpeta)  
   2. [Crear Proyecto](#crear-proyecto)  
   3. [Crear Iteración](#crear-iteración)  
   4. [Gestión de Clientes](#gestión-de-clientes)  
8. [Operaciones para Clientes](#operaciones-para-clientes)  
   1. [Visualizar Iteraciones](#visualizar-iteraciones)  
   2. [Descargar Archivo (Video)](#descargar-archivo-video)  
   3. [Comentar](#comentar)  
9. [Cerrar Sesión (Logout)](#cerrar-sesión-logout)  
10. [Seguridad y Recomendaciones](#seguridad-y-recomendaciones)  
11. [Contacto y Soporte](#contacto-y-soporte)  

---

## Introducción
Este software es una plataforma que organiza proyectos en diferentes carpetas, permitiendo mantener iteraciones o versiones de videos asociados a cada proyecto. Está pensado para que:

- **Administradores** (rol `admin`)  
  - Creen y administren carpetas, proyectos e iteraciones.  
  - Registren y administren clientes.
  - Cuenten con permisos de edición y borrado en todo el contenido (carpetas, proyectos, iteraciones, clientes).

- **Clientes** (rol `customer`)  
  - Puedan acceder a los proyectos y sus iteraciones para visualizar los videos y dejar comentarios.  
  - No tienen permisos de administración (creación, edición o borrado de carpetas/proyectos).

---

## Requerimientos
1. **Servidor web** con soporte **PHP** (versión 7.4+ recomendada).
2. **Extensión SQLite** habilitada en PHP (para la base de datos).
3. Permisos de escritura en la carpeta donde se almacenan los archivos subidos (`uploads/`).

---

## Instalación y Configuración

1. **Ubicar el archivo PHP**  
   Copia el archivo principal (por ejemplo `index.php`) en el directorio raíz o en una carpeta de tu servidor web.

2. **Configurar el entorno**  
   - Asegúrate de que el servidor web tenga permisos de lectura y ejecución sobre el archivo `index.php`.
   - Asegúrate de que el directorio `uploads/` (se crea automáticamente si no existe) tenga permisos de escritura para poder guardar los videos.

3. **Primer arranque**  
   - Al cargar la página por primera vez (p. ej. `https://tusitio.com/index.php`), el sistema creará automáticamente la base de datos SQLite `projects.db` y las tablas necesarias si no existen.
   - No se requiere ninguna acción adicional para inicializar la base de datos.

---

## Estructura de Datos (Tablas)
El software crea las siguientes tablas en `projects.db`:

- **users**  
  Guarda la información de los administradores (username, password, role).

- **folders**  
  Guarda las carpetas (pueden tener jerarquía a través de `parent_id`).

- **projects**  
  Almacena los proyectos, cada uno asignado a una carpeta (`folder_id`).

- **iterations**  
  Guarda las iteraciones (videos) con título, descripción y URL de archivo (`file_url`).

- **customers**  
  Guarda la información de los clientes (username, password, nombre, email).

- **comments**  
  Guarda los comentarios que hacen los clientes sobre cada iteración.

---

## Inicio de Sesión y Registro

### Página de Login
Cuando accedes a la URL principal (por ejemplo, `index.php`) y **no hay sesión iniciada**, verás un formulario de **Login** y un enlace opcional para el **Registro** de un administrador.

1. **Iniciar Sesión**  
   - Ingresa tus credenciales: **username** y **password**.  
   - Pulsa en **Login**.  
   - Si los datos son correctos, el sistema te redirige al **dashboard**.  
   - Si son incorrectos, mostrará un mensaje de error.

2. **Registro de un Administrador (Sign Up)**  
   - Haz clic en **"Sign Up as Admin"** en la parte inferior del cuadro de Login.  
   - Ingresa un **username** y una **password**.  
   - Pulsa en **Sign Up**.  
   - Si se crea exitosamente, el sistema iniciará sesión automáticamente como administrador.  
   - Nota: Este registro únicamente crea usuarios en la tabla de administradores (`users`).  
   - Solo el primer administrador debería registrarse por este medio. Posteriormente, pueden gestionarse nuevos administradores directamente en la tabla `users` o extendiendo el sistema.

---

## Interfaz de Usuario

Una vez iniciada la sesión, se muestra un layout con dos paneles principales:

### Panel Lateral (Carpetas y Proyectos)
- **Ubicado a la izquierda**, con fondo oscuro.  
- Contiene la **estructura de carpetas** en forma de árbol.  
- Bajo cada carpeta se listan los **proyectos**.  
- Si eres **administrador**, verás un **botón de eliminar** (`X`) junto a cada carpeta o proyecto.  
- Al hacer clic en un **título de proyecto**, se mostrará su detalle en el **panel principal**.

En la parte inferior hay **botones** para:
- **Crear nueva carpeta** (si eres administrador).  
- **Crear nuevo proyecto** (si eres administrador).  
- **Gestionar clientes** (si eres administrador).

### Panel Principal (Contenido)
- **Ocupa el espacio principal a la derecha**, sobre fondo blanco.  
- Dependiendo de la selección, mostrará:
  - El listado de iteraciones de un proyecto.
  - La sección de administración de clientes.
  - Un mensaje de bienvenida si no se ha seleccionado un proyecto.

---

## Operaciones para Administradores

### Crear Carpeta
1. Haz clic en el botón **"+ Nueva carpeta"** en el panel lateral.  
2. Se abrirá un **modal**:
   - Ingresa el **nombre** de la carpeta.  
   - Selecciona la carpeta superior (opcional) para anidar la nueva carpeta.  
   - Pulsa **"Create Folder"**.  
3. La carpeta aparecerá en el árbol del panel lateral.

### Crear Proyecto
1. Haz clic en **"+ New Project"** en el panel lateral.  
2. En el **modal**:
   - Selecciona la **carpeta** a la que pertenecerá el proyecto.  
   - Indica el **título** del proyecto.  
   - Proporciona una **descripción**.  
   - Pulsa **"Crear proyecto"**.  
3. El proyecto aparecerá dentro de la carpeta seleccionada en el panel lateral.

### Crear Iteración
1. Accede a un proyecto haciendo clic en su nombre en el panel lateral.  
2. En el panel principal, se mostrará la sección “**Crear nueva iteración**”.  
   - Ingresa **Título**, **Descripción** y **selecciona un archivo** (preferiblemente .mp4).  
   - Pulsa **"Crear iteración"**.  
3. Se creará una nueva iteración que se listará en la parte superior de la página.

#### Editar / Eliminar Iteración
- Dentro de cada iteración, el administrador puede **editar** o **borrar**:
  - **Editar**: se abre un modal que permite cambiar título, descripción o subir un nuevo archivo.  
  - **Borrar**: el sistema elimina la iteración y todos los comentarios asociados.

### Gestión de Clientes
Para administrar clientes, haz clic en el botón **"Clientes"** en el panel lateral:
1. **Listado de clientes**: aparece una tabla con todos los clientes (username, nombre, email).
2. **Editar cliente**: pulsa en **"Editar"** (se abrirá un modal para cambiar username, nombre, email).
3. **Borrar cliente**: pulsa en **"Borrar"** (confirmar en la ventana emergente).
4. **Crear nuevo cliente**: en la parte inferior hay un formulario para ingresar un nuevo cliente con:
   - **username**, **contraseña**, **nombre** y **email**.

---

## Operaciones para Clientes

### Visualizar Iteraciones
1. Iniciar sesión como cliente (username y password registrados por el administrador).  
2. En el **panel lateral**, selecciona la carpeta y luego el **proyecto** deseado.  
3. En el **panel principal**, verás:
   - Título y descripción del proyecto.  
   - La **lista de iteraciones** disponibles.  
   - Cada iteración muestra:
     - Un **video** reproducible dentro del navegador.  
     - El botón **"Descargar video"** (opcional).  
     - Un formulario para **dejar un comentario**.

### Descargar Archivo (Video)
- Cada iteración incluye un enlace “**Descargar video**”.  
- Al hacer clic, el navegador iniciará la descarga del archivo.

### Comentar
- Debajo del video, hay un **formulario de comentario** con un campo de texto.  
- Ingresa tu comentario y pulsa en **"Enviar"**.  
- El comentario aparecerá abajo, junto con la fecha y la identificación del cliente.

---

## Cerrar Sesión (Logout)
Para **cerrar sesión**, haz clic en **"Logout"** en la esquina superior derecha (en la barra de navegación).  
- El sistema destruirá la sesión y te redirigirá a la página de inicio (login).

---

## Seguridad y Recomendaciones
1. **Contraseñas seguras**: se recomienda que administradores y clientes usen contraseñas robustas.  
2. **Permisos de escritura**: limitar permisos de escritura únicamente a la carpeta `uploads/` y al archivo de base de datos `projects.db`.  
3. **Copias de seguridad**: mantener backups periódicos de `projects.db` para no perder datos.  
4. **Validación de datos**: este ejemplo realiza la validación básica de formularios. Para entornos de producción, agregar controles adicionales de seguridad (tamaño de archivo, tipo MIME, etc.).  

---

## Contacto y Soporte
Para dudas, reportes de fallos o solicitar mejoras, puedes contactar a:

- **Nombre**: [Tu Nombre / Organización]  
- **Correo**: [Tu Email de Soporte]  
- **Sitio Web**: [URL del sitio si aplica]  

---

¡Eso es todo! Con esta guía, deberías poder instalar, configurar y utilizar el sistema de carpetas, proyectos e iteraciones de manera óptima.  

```
**index.php**
```php
<?php
/*******************************
 * projects.db + table creation
 *******************************/
$db = new SQLite3('../databases/firebrick.db');

include "inc/dbinit.php";

session_start();

/********************************
 * AUTH FUNCTIONS
 ********************************/
include "funciones/login.php";
include "funciones/isLoggedIn.php";
include "funciones/isAdmin.php";
include "funciones/isCustomer.php";
include "funciones/logout.php";

include "inc/foldunfold.php";

/********************************
 * HANDLE FORM SUBMISSIONS
 ********************************/
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ---- LOGIN ----
    if (isset($_POST['login_form'])) {
        include "router/loginform.php";
    }
    // ---- SIGNUP (ADMIN ONLY) ----
    elseif (isset($_POST['signup_form'])) {
        include "router/signupform.php";
    }
    // ---- CREATE FOLDER (ADMIN) ----
    elseif (isset($_POST['create_folder']) && isAdmin()) {
        include "router/createfolder.php";
    }
    // ---- DELETE FOLDER (ADMIN) ----
    elseif (isset($_POST['delete_folder']) && isAdmin()) {
        include "router/deletefolder.php";
    }
    // ---- CREATE PROJECT (ADMIN) ----
    elseif (isset($_POST['create_project']) && isAdmin()) {
        include "router/createproject.php";
    }
    // ---- DELETE PROJECT (ADMIN) ----
    elseif (isset($_POST['delete_project']) && isAdmin()) {
        include "router/deleteproject.php";
    }
    // ---- CREATE ITERATION (ADMIN) ----
    elseif (isset($_POST['create_iteration']) && isAdmin()) {
        include "router/createiteration.php";
    }
    // ---- DELETE ITERATION (ADMIN) ----
    elseif (isset($_POST['delete_iteration']) && isAdmin()) {
        include "router/deleteiteration.php";
    }
    // ---- UPDATE ITERATION (ADMIN) ----
    elseif (isset($_POST['update_iteration']) && isAdmin()) {
       include "router/updateiteration.php";
    }
    // ---- CREATE / UPDATE / DELETE CUSTOMER (ADMIN) ----
    elseif (isset($_POST['create_customer']) && isAdmin()) {
        include "router/createcustomer.php";
    }
    elseif (isset($_POST['update_customer']) && isAdmin()) {
        include "router/updatecustomer.php";
    }
    elseif (isset($_POST['delete_customer']) && isAdmin()) {
        include "router/deletecustomer.php";
    }
    // ---- ADD COMMENT (CUSTOMER) ----
    elseif (isset($_POST['comment']) && isCustomer()) {
        include "router/addcomment.php";
    }
}

// Logout
if (isset($_GET['logout'])) {
    logout();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

/********************************
 * FETCH DATA FOR DISPLAY
 ********************************/
$customersResult = $db->query("SELECT * FROM customers ORDER BY username ASC");

$selected_project = null;
$iterations = null;
if (isset($_GET['project_id'])) {
    $pid = (int)$_GET['project_id'];
    $selected_project = $db->querySingle("SELECT * FROM projects WHERE id=$pid", true);
    if ($selected_project) {
        $iterations = $db->query("
            SELECT iterations.*, iteration_dates.created_at 
            FROM iterations 
            LEFT JOIN iteration_dates ON iterations.id = iteration_dates.iteration_id 
            WHERE project_id = $pid
            ORDER BY iterations.id DESC
        ");
    }
}

include "bloques/foldertree.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>jocarsa | firebrick</title>
    <link rel="icon" type="image/svg+xml" href="https://static.jocarsa.com/logos/firebrick.png" />
    <link rel="stylesheet" href="css/estilo.css">
    <script>
    // Toggle between login & signup forms on the landing page
    function showSignup() {
        document.getElementById('login-box').style.display = 'none';
        document.getElementById('signup-box').style.display = 'block';
    }
    function showLogin() {
        document.getElementById('login-box').style.display = 'block';
        document.getElementById('signup-box').style.display = 'none';
    }
    // Show a modal by ID
    function openModal(modalId) {
        document.getElementById(modalId).style.display = 'flex';
    }
    // Hide a modal by ID
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }
    </script>
</head>
<body>
<header>
    <a href="?"><h1><img src="https://static.jocarsa.com/logos/firebrick.png">jocarsa | firebrick</h1></a>
    <nav>
        <?php if (isLoggedIn()): ?>
            <a href="?logout">Logout</a>
        <?php endif; ?>
    </nav>
</header>

<!-- If not logged in, show landing page with login (and optional signup link) -->
<?php if (!isLoggedIn()): ?>
    <?php include "bloques/loginbox.php";?>

<!-- If logged in, show the dashboard -->
<?php else: ?>
    <?php include "bloques/escritorio.php";?>

    <!-- CREATE FOLDER MODAL (ADMIN) -->
    <?php if (isAdmin()): ?>
    <?php include "bloques/modal.php";?>
    <?php endif; ?>
<?php endif; ?>

<div class="footer">
    <p>&copy; <?php echo date('Y'); ?> jocarsa | firebrick</p>
</div>
</body>
</html>


```
## bloques
**escritorio.php**
```php
<div class="container">
    <!-- LEFT PANE: Folder Tree & Buttons -->
    <div class="left-pane">
        <h3>Carpetas y proyectos</h3>
        <ul><?php renderFolderTree(); ?></ul>
        <?php if (isAdmin()): ?>
        <div class="buttons">
            <button onclick="openModal('create-folder-modal')">+ Nueva carpeta</button>
            <button onclick="openModal('create-project-modal')">+ New Project</button>
            <button onclick="window.location='?customers'">Clientes</button>
        </div>
        <?php endif; ?>
    </div>
    <!-- MAIN PANE -->
    <div class="main-pane">
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if (isset($_GET['customers']) && isAdmin()): ?>
            <h2>Gestionar clientes</h2>
            <table>
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th width="200">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php while($cust = $customersResult->fetchArray(SQLITE3_ASSOC)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($cust['username']); ?></td>
                        <td><?php echo htmlspecialchars($cust['name']); ?></td>
                        <td><?php echo htmlspecialchars($cust['email']); ?></td>
                        <td>
                            <button onclick="openModal('edit-customer-<?php echo $cust['id']; ?>')">Editar</button>
                            <form method="post" style="display:inline-block" onsubmit="return confirm('Delete this customer?');">
                                <input type="hidden" name="delete_customer" value="1">
                                <input type="hidden" name="id" value="<?php echo $cust['id']; ?>">
                                <button type="submit">Borrar</button>
                            </form>
                        </td>
                    </tr>
                    <!-- EDIT CUSTOMER MODAL -->
                    <div class="modal" id="edit-customer-<?php echo $cust['id']; ?>">
                        <div class="modal-content">
                            <button class="close-btn" onclick="closeModal('edit-customer-<?php echo $cust['id']; ?>')">&times;</button>
                            <h2>Editar cliente</h2>
                            <form method="post">
                                <input type="hidden" name="update_customer" value="1">
                                <input type="hidden" name="id" value="<?php echo $cust['id']; ?>">
                                <label>Usuario:</label>
                                <input type="text" name="username" value="<?php echo htmlspecialchars($cust['username']); ?>" required>
                                <label>Nombre:</label>
                                <input type="text" name="name" value="<?php echo htmlspecialchars($cust['name']); ?>" required>
                                <label>Email:</label>
                                <input type="email" name="email" value="<?php echo htmlspecialchars($cust['email']); ?>" required>
                                <button type="submit">Actualizar</button>
                            </form>
                        </div>
                    </div>
                <?php endwhile; ?>
                </tbody>
            </table>

            <!-- CREATE CUSTOMER (ADMIN) -->
            <div style="margin-top: 30px;">
                <h3>Crear nuevo cliente</h3>
                <form method="post">
                    <input type="hidden" name="create_customer" value="1">
                    <label>Usuario:</label>
                    <input type="text" name="username" required>
                    <label>Contraseña:</label>
                    <input type="password" name="password" required>
                    <label>Nombre:</label>
                    <input type="text" name="name" required>
                    <label>Email:</label>
                    <input type="email" name="email" required>
                    <button type="submit">Create</button>
                </form>
            </div>
        <?php elseif ($selected_project): ?>
            <!-- SHOW SELECTED PROJECT -->
            <h2><?php echo htmlspecialchars($selected_project['title']); ?></h2>
            <p><?php echo nl2br(htmlspecialchars($selected_project['description'])); ?></p>
            <h3>Iteraciones</h3>
            <?php if ($iterations): ?>
                <ul style="list-style:none;padding:0;">
                <?php while ($iteration = $iterations->fetchArray(SQLITE3_ASSOC)): ?>
                    <li style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
                        <video controls>
                            <source src="<?php echo htmlspecialchars($iteration['file_url']); ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <div class="texto">
                            <h4><?php echo htmlspecialchars($iteration['title']); ?></h4>
                            <p class="creation-date">Created on: <?php echo htmlspecialchars($iteration['created_at']); ?></p>
                            <p><?php echo nl2br(htmlspecialchars($iteration['description'])); ?></p>
                            <?php if ($iteration['file_url']): ?>
                            <!-- Direct Download Link -->
                            <p>
                                <a href="<?php echo htmlspecialchars($iteration['file_url']); ?>"
                                   download
                                   class="botondescarga">
                                   Descargar video
                                </a>
                            </p>
                            <?php endif; ?>

                            <!-- If customer, allow comment -->
                            <?php if (isCustomer()): ?>
                            <form method="post">
                                <input type="hidden" name="comment" value="1">
                                <input type="hidden" name="iteration_id" value="<?php echo $iteration['id']; ?>">
                                <label>Comentario:</label>
                                <textarea name="comment" required></textarea>
                                <button type="submit">Enviar</button>
                            </form>
                            <?php endif; ?>

                            <!-- Comments -->
                            <ul>
                            <?php
                            $commentQ = $db->query("SELECT * FROM comments WHERE iteration_id=" . (int)$iteration['id'] . " ORDER BY created_at ASC");
                            while ($com = $commentQ->fetchArray(SQLITE3_ASSOC)):
                            ?>
                                <li>
                                    <p><?php echo nl2br(htmlspecialchars($com['comment'])); ?></p>
                                    <small>
                                        Comentario del cliente: #<?php echo $com['customer_id']; ?>
                                        en <?php echo $com['created_at']; ?>
                                    </small>
                                </li>
                            <?php endwhile; ?>
                            </ul>

                            <!-- If Admin, can Edit or Delete iteration -->
                            <?php if (isAdmin()): ?>
                                <div style="margin-top:10px;">
                                    <button onclick="openModal('edit-iteration-<?php echo $iteration['id']; ?>')">Edit</button>
                                    <form method="post" style="display:inline-block" onsubmit="return confirm('Delete this iteration?');">
                                        <input type="hidden" name="delete_iteration" value="1">
                                        <input type="hidden" name="iteration_id" value="<?php echo $iteration['id']; ?>">
                                        <input type="hidden" name="parent_project_id" value="<?php echo $selected_project['id']; ?>">
                                        <button type="submit">Delete</button>
                                    </form>
                                </div>

                                <!-- EDIT ITERATION MODAL -->
                                <div class="modal" id="edit-iteration-<?php echo $iteration['id']; ?>">
                                    <div class="modal-content">
                                        <button class="close-btn" onclick="closeModal('edit-iteration-<?php echo $iteration['id']; ?>')">&times;</button>
                                        <h2>Edit Iteration</h2>
                                        <form method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="update_iteration" value="1">
                                            <input type="hidden" name="iteration_id" value="<?php echo $iteration['id']; ?>">
                                            <input type="hidden" name="parent_project_id" value="<?php echo $selected_project['id']; ?>">
                                            <label>Title:</label>
                                            <input type="text" name="title" value="<?php echo htmlspecialchars($iteration['title']); ?>" required>
                                            <label>Description:</label>
                                            <textarea name="description" required><?php echo htmlspecialchars($iteration['description']); ?></textarea>
                                            <label>Replace file (optional):</label>
                                            <input type="file" name="file">
                                            <button type="submit">Update Iteration</button>
                                        </form>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>Todavía no hay iteraciones.</p>
            <?php endif; ?>

            <!-- Admin can create iteration -->
            <?php if (isAdmin()): ?>
                <hr>
                <h3>Crear nueva iteración</h3>
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="create_iteration" value="1">
                    <input type="hidden" name="project_id" value="<?php echo $selected_project['id']; ?>">
                    <label>Título:</label>
                    <input type="text" name="title" required>
                    <label>Descripción:</label>
                    <textarea name="description" required></textarea>
                    <label>Archivo:</label>
                    <input type="file" name="file" required>
                    <button type="submit">Crear iteración</button>
                </form>
            <?php endif; ?>
        <?php else: ?>
            <!-- If no specific project or customers requested, show a default message -->
            <h2>Últimas adiciones al proyecto</h2>
            <?php
            // Fetch the last 20 iterations
            $lastIterations = $db->query("
                SELECT iterations.*, iteration_dates.created_at, projects.title AS project_title, folders.name AS folder_name
                FROM iterations
                LEFT JOIN iteration_dates ON iterations.id = iteration_dates.iteration_id
                LEFT JOIN projects ON iterations.project_id = projects.id
                LEFT JOIN folders ON projects.folder_id = folders.id
                ORDER BY iteration_dates.created_at DESC
                LIMIT 20
            ");
            ?>
            <ul style="list-style:none;padding:0;">
            <?php while ($iteration = $lastIterations->fetchArray(SQLITE3_ASSOC)): ?>
                <li style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
                    <h4><?php echo htmlspecialchars($iteration['title']); ?></h4>
                    <p class="creation-date">Created on: <?php echo htmlspecialchars($iteration['created_at']); ?></p>
                    <p><strong>Project:</strong> <a href="?project_id=<?php echo $iteration['project_id']; ?>"><?php echo htmlspecialchars($iteration['project_title']); ?></a></p>
                    <p><strong>Folder:</strong> <?php echo htmlspecialchars($iteration['folder_name']); ?></p>
                    <p><?php echo nl2br(htmlspecialchars($iteration['description'])); ?></p>
                    <?php if ($iteration['file_url']): ?>
                    <!-- Direct Download Link -->
                    <p>
                        <a href="<?php echo htmlspecialchars($iteration['file_url']); ?>"
                           download
                           class="botondescarga">
                           Descargar video
                        </a>
                    </p>
                    <?php endif; ?>
                </li>
            <?php endwhile; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>


```
**foldertree.php**
```php
<?php
/********************************
 * FOLDER TREE RENDERING
 ********************************/
function renderFolderTree($parent_id = null) {
    global $db;
    $parent_condition = ($parent_id === null) ? "IS NULL" : "= $parent_id";
    $folderQ = $db->query("SELECT * FROM folders WHERE parent_id $parent_condition ORDER BY name ASC");

    while ($folder = $folderQ->fetchArray(SQLITE3_ASSOC)) {
        // Determine folder fold state for the current user (default is unfolded, i.e. 0)
        $is_folded = 0;
        if (isLoggedIn()) {
            $stmt = $db->prepare("SELECT is_folded FROM user_folder_states WHERE user_id = :user_id AND folder_id = :folder_id");
            $stmt->bindValue(':user_id', $_SESSION['user_id'], SQLITE3_INTEGER);
            $stmt->bindValue(':folder_id', $folder['id'], SQLITE3_INTEGER);
            $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);
            if ($result) {
                $is_folded = $result['is_folded'];
            }
        }

        echo "<li><span style='font-weight:bold;'>";
        // Render toggle icon if user is logged in
        if (isLoggedIn()) {
            if ($is_folded == 0) {
                // Unfolded: show minus icon to allow folding
                echo "<a href='?toggle_folder={$folder['id']}&state=1' title='Fold'>➖</a> ";
            } else {
                // Folded: show plus icon to allow unfolding
                echo "<a href='?toggle_folder={$folder['id']}&state=0' title='Unfold'>➕</a> ";
            }
        }
        echo "📁 " . htmlspecialchars($folder['name']) . "</span>";

        // Render children only if folder is unfolded
        if ($is_folded == 0) {
            // Get projects inside this folder
            $projQ = $db->query("SELECT * FROM projects WHERE folder_id=" . $folder['id'] . " ORDER BY title ASC");
            $projectsArr = [];
            while ($p = $projQ->fetchArray(SQLITE3_ASSOC)) {
                $projectsArr[] = $p;
            }

            // Check for subfolders
            $subFolderQ = $db->query("SELECT id FROM folders WHERE parent_id=" . (int)$folder['id']);
            $subfoldersArr = [];
            while ($sf = $subFolderQ->fetchArray(SQLITE3_ASSOC)) {
                $subfoldersArr[] = $sf;
            }

            if (count($projectsArr) || count($subfoldersArr)) {
                echo "<ul>";
                // Render projects
                foreach ($projectsArr as $proj) {
                    echo "<li>";
                    echo "<a href='?project_id=" . $proj['id'] . "'>🗎 " . htmlspecialchars($proj['title']) . "</a>";
                    // Only admins see delete button for project:
                    if (isAdmin()) {
                        echo "<form method='post' style='display:inline;' onsubmit='return confirm(\"Delete this project?\");'>
                                <input type='hidden' name='delete_project' value='1'>
                                <input type='hidden' name='project_id' value='{$proj['id']}'>
                                <button type='submit' style='margin-left:10px;background:red;'>X</button>
                              </form>";
                    }
                    echo "</li>";
                }
                // Recurse to render subfolders
                renderFolderTree($folder['id']);
                echo "</ul>";
            }
        }
        echo "</li>";
    }
}
?>

```
**loginbox.php**
```php
<div class="landing-container">
        <!-- LOGIN BOX -->
        <div id="login-box">
            <h2>Login</h2>
            <form method="post">
                <input type="hidden" name="login_form" value="1">
                <label>Username:</label>
                <input type="text" name="username" required>
                <label>Password:</label>
                <input type="password" name="password" required>
                <button type="submit">Login</button>
            </form>
            <?php if ($error && isset($_POST['login_form'])): ?>
                <div class="error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <a class="toggle-link" onclick="showSignup()">Sign Up as Admin</a>
        </div>

        <!-- SIGNUP BOX (admins only) -->
        <div id="signup-box" style="display:none;">
            <h2>Sign Up (Admin)</h2>
            <form method="post">
                <input type="hidden" name="signup_form" value="1">
                <label>Username:</label>
                <input type="text" name="username" required>
                <label>Password:</label>
                <input type="password" name="password" required>
                <button type="submit">Sign Up</button>
            </form>
            <?php if ($error && isset($_POST['signup_form'])): ?>
                <div class="error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <a class="toggle-link" onclick="showLogin()">Back to Login</a>
        </div>
    </div>

```
**modal.php**
```php
<div class="modal" id="create-folder-modal">
        <div class="modal-content">
            <button class="close-btn" onclick="closeModal('create-folder-modal')">&times;</button>
            <h2>Crear carpeta</h2>
            <form method="post">
                <input type="hidden" name="create_folder" value="1">
                <label>Nombre de la carpeta:</label>
                <input type="text" name="name" required>
                <label>Carpeta superior:</label>
                <select name="parent_id">
                    <option value="">(Sin superior)</option>
                    <?php
                    // For the dropdown
                    $allFolders = $db->query("SELECT * FROM folders ORDER BY name ASC");
                    while ($fo = $allFolders->fetchArray(SQLITE3_ASSOC)) {
                        echo "<option value='{$fo['id']}'>" . htmlspecialchars($fo['name']) . "</option>";
                    }
                    ?>
                </select>
                <button type="submit">Create Folder</button>
            </form>
        </div>
    </div>

    <!-- CREATE PROJECT MODAL (ADMIN) -->
    <div class="modal" id="create-project-modal">
        <div class="modal-content">
            <button class="close-btn" onclick="closeModal('create-project-modal')">&times;</button>
            <h2>Crear proyecto</h2>
            <form method="post">
                <input type="hidden" name="create_project" value="1">
                <label>Carpeta:</label>
                <select name="folder_id" required>
                    <option value="">-- Selecciona una carpeta --</option>
                    <?php
                    $allFolders2 = $db->query("SELECT * FROM folders ORDER BY name ASC");
                    while ($fo2 = $allFolders2->fetchArray(SQLITE3_ASSOC)) {
                        echo "<option value='{$fo2['id']}'>" . htmlspecialchars($fo2['name']) . "</option>";
                    }
                    ?>
                </select>
                <label>Título del proyecto:</label>
                <input type="text" name="title" required>
                <label>Descripción:</label>
                <textarea name="description" required></textarea>
                <button type="submit">Crear proyecto</button>
            </form>
        </div>
    </div>

```
## css
**estilo.css**
```css
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');
@import url('https://static.jocarsa.com/fuentes/ubuntu-font-family-0.83/ubuntu.css');


body {
    margin: 0;
    padding: 0;
    font-family: 'Ubuntu', Arial, sans-serif;
    background-color: #f7f7f7;
    color: #333;
}

/* Header */
header {
    background-color: #b22222;
    color: #fff;
    padding: 15px 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

header h1 {
    margin: 0;
    font-size: 24px;
    display: flex;
    align-items: center;
}

header h1 img {
    width: 50px;
    margin-right: 15px;
}

nav a {
    color: #fff;
    text-decoration: none;
    margin-left: 20px;
    font-weight: 500;
}

nav a:hover {
    text-decoration: underline;
}

/* Footer */
.footer {
    background-color: #b22222;
    color: #fff;
    text-align: center;
    padding: 10px;
    position: fixed;
    bottom: 0;
    width: 100%;
    font-size: 14px;
}

/* Landing Page Login Container */
.landing-container {
    max-width: 500px;
    margin: 60px auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.landing-container h2 {
    margin-top: 0;
    font-weight: 500;
    font-size: 22px;
}

.error {
    color: #d8000c;
    background-color: #ffbaba;
    padding: 10px;
    border-radius: 4px;
    margin-top: 10px;
}

/* Form Elements */
label {
    display: block;
    margin: 10px 0 5px;
    font-weight: 500;
}

input[type="text"],
input[type="password"],
input[type="email"],
textarea,
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 14px;
}

button {
    background-color: #b22222;
    color: #fff;
    border: none;
    border-radius: 4px;
    /*padding: 10px 15px;*/
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #8b1a1a;
}

a.toggle-link {
    color: #b22222;
    cursor: pointer;
    text-decoration: none;
    margin-top: 10px;
    display: inline-block;
}

/* Dashboard Layout */
.container {
    display: flex;
    height: calc(100vh - 60px);
    margin-top: 20px;
}

.left-pane {
    width: 500px;
    background-color: #2c3e50;
    color: #ecf0f1;
    padding: 20px;
    overflow-y: auto;
}

.left-pane h3 {
    margin-top: 0;
    font-size: 20px;
    font-weight: 500;
    border-bottom: 1px solid rgba(236, 240, 241, 0.3);
    padding-bottom: 10px;
    margin-bottom: 15px;
}

.left-pane ul {
    list-style: none;
    padding-left: 0;
    margin: 0;
}

.left-pane li {
    margin-bottom: 10px;
    position: relative;
    padding-left: 20px;
}

.left-pane a {
    color: #ecf0f1;
    text-decoration: none;
    font-size: 14px;
}

.left-pane a:hover {
    text-decoration: underline;
}

.buttons {
    margin-top: 20px;
}

.buttons button {
    width: 100%;
    margin: 10px 0;
    padding: 10px;
    text-align: left;
}

/* Main Pane */
.main-pane {
    flex-grow: 1;
    background: #fff;
    padding: 20px;
    padding-bottom: 60px; /* Added to ensure content doesn't fall behind the footer */
    overflow-y: auto;
    box-shadow: 0 0 10px rgba(0,0,0,0.05);
    margin: 20px;
    border-radius: 8px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th,
table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
    font-size: 14px;
}

table th {
    background-color: #f4f4f4;
    font-weight: 500;
}

/* Video and Iteration Styles */
video {
    display: block;
    margin: 10px 0;
    max-width: 100%;
    border-radius: 4px;
}

.main-pane ul li {
    background: #f9f9f9;
    padding: 15px;
    border: 1px solid #ddd;
    margin-bottom: 15px;
    border-radius: 6px;
}

.main-pane ul li h4 {
    margin: 0 0 5px;
    font-size: 18px;
    font-weight: 500;
}

.creation-date {
    font-size: 12px;
    color: #888;
    margin-bottom: 10px;
}

.botondescarga {
    background: #27ae60;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 14px;
}

.botondescarga:hover {
    background: #1e8449;
}

/* Modals */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    align-items: center;
    justify-content: center;
    z-index: 1000;
}

.modal-content {
    background: #fff;
    padding: 30px;
    border-radius: 8px;
    width: 500px;
    max-width: 90%;
    position: relative;
    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
}

.modal-content h2 {
    margin-top: 0;
    font-size: 20px;
    font-weight: 500;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #ccc;
    color: #fff;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    cursor: pointer;
    font-size: 16px;
    line-height: 30px;
    text-align: center;
}

.close-btn:hover {
    background: #bbb;
}
.footer{
display:none;
}
header a{
	text-decoration:none;
	color:inherit;
}


```
## funciones
**isAdmin.php**
```php
<?php
function isAdmin() {
    return (isset($_SESSION['role']) && $_SESSION['role'] === 'admin');
}
?>

```
**isCustomer.php**
```php
<?php
function isCustomer() {
    return (isset($_SESSION['role']) && $_SESSION['role'] === 'customer');
}
?>

```
**isLoggedIn.php**
```php
<?php
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}
?>

```
**login.php**
```php
<?php
function login($username, $password) {
    global $db;

    // First check the 'users' table (admin)
    $stmt = $db->prepare("SELECT id, password, role FROM users WHERE username = :u");
    $stmt->bindValue(':u', $username, SQLITE3_TEXT);
    $res = $stmt->execute();
    $admin = $res->fetchArray(SQLITE3_ASSOC);

    if ($admin) {
        if (password_verify($password, $admin['password'])) {
            $_SESSION['user_id'] = $admin['id'];
            $_SESSION['role'] = $admin['role']; // 'admin'
            $_SESSION['user_table'] = 'users';
            return true;
        }
        return false;
    }

    // If not found in 'users', check 'customers'
    $stmt = $db->prepare("SELECT id, password FROM customers WHERE username = :u");
    $stmt->bindValue(':u', $username, SQLITE3_TEXT);
    $res = $stmt->execute();
    $customer = $res->fetchArray(SQLITE3_ASSOC);

    if ($customer && password_verify($password, $customer['password'])) {
        $_SESSION['user_id'] = $customer['id'];
        $_SESSION['role'] = 'customer';
        $_SESSION['user_table'] = 'customers';
        return true;
    }

    return false;
}
?>

```
**logout.php**
```php
<?php
function logout() {
    session_destroy();
}
?>

```
## inc
**dbinit.php**
```php
<?php
// Create tables if they don't exist
$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE,
    password TEXT,
    role TEXT  -- Usually 'admin'
)");

$db->exec("CREATE TABLE IF NOT EXISTS folders (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    parent_id INTEGER
)");

$db->exec("CREATE TABLE IF NOT EXISTS projects (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    folder_id INTEGER,
    title TEXT,
    description TEXT
)");

$db->exec("CREATE TABLE IF NOT EXISTS iterations (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    project_id INTEGER,
    title TEXT,
    description TEXT,
    file_url TEXT
)");

$db->exec("CREATE TABLE IF NOT EXISTS customers (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE,
    password TEXT,
    name TEXT,
    email TEXT
)");

$db->exec("CREATE TABLE IF NOT EXISTS comments (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    iteration_id INTEGER,
    customer_id INTEGER,
    comment TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)");

// Create table to store per-user folder states (0 = unfolded, 1 = folded)
$db->exec("CREATE TABLE IF NOT EXISTS user_folder_states (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    folder_id INTEGER,
    is_folded INTEGER DEFAULT 0,
    UNIQUE(user_id, folder_id)
)");

// Create separate table for iteration creation dates
$db->exec("CREATE TABLE IF NOT EXISTS iteration_dates (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    iteration_id INTEGER UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(iteration_id) REFERENCES iterations(id)
)");
?>


```
**foldunfold.php**
```php
<?php
/********************************
 * HANDLE FOLDER TOGGLE (FOLD/UNFOLD)
 ********************************/
if (isset($_GET['toggle_folder']) && isLoggedIn()) {
    $folder_id = (int) $_GET['toggle_folder'];
    $new_state = (int) $_GET['state']; // 0 = unfolded, 1 = folded
    $user_id = $_SESSION['user_id'];

    $stmt = $db->prepare("INSERT OR REPLACE INTO user_folder_states (user_id, folder_id, is_folded)
                           VALUES (:user_id, :folder_id, :is_folded)");
    $stmt->bindValue(':user_id', $user_id, SQLITE3_INTEGER);
    $stmt->bindValue(':folder_id', $folder_id, SQLITE3_INTEGER);
    $stmt->bindValue(':is_folded', $new_state, SQLITE3_INTEGER);
    $stmt->execute();

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

```
## router
**addcomment.php**
```php
<?php
$iteration_id = (int)($_POST['iteration_id'] ?? 0);
        $commentText = $_POST['comment'] ?? '';
        $customer_id = $_SESSION['user_id'];

        $stmt = $db->prepare("INSERT INTO comments (iteration_id, customer_id, comment)
                              VALUES (:i, :c, :cm)");
        $stmt->bindValue(':i', $iteration_id, SQLITE3_INTEGER);
        $stmt->bindValue(':c', $customer_id, SQLITE3_INTEGER);
        $stmt->bindValue(':cm', $commentText, SQLITE3_TEXT);

        if (!$stmt->execute()) {
            $error = "Error submitting comment.";
        } else {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?project_id=' . ((int)$_GET['project_id']));
            exit;
        }
?>

```
**createcustomer.php**
```php
<?php
$username = $_POST['username'] ?? '';
        $password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';

        $stmt = $db->prepare("INSERT INTO customers (username, password, name, email)
                              VALUES (:u, :p, :n, :e)");
        $stmt->bindValue(':u', $username, SQLITE3_TEXT);
        $stmt->bindValue(':p', $password, SQLITE3_TEXT);
        $stmt->bindValue(':n', $name, SQLITE3_TEXT);
        $stmt->bindValue(':e', $email, SQLITE3_TEXT);
        if (!$stmt->execute()) {
            $error = "Error creating customer (username might already exist).";
        } else {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?customers');
            exit;
        }
?>

```
**createfolder.php**
```php
<?php
$name = $_POST['name'] ?? '';
        $parent_id = ($_POST['parent_id'] !== '') ? (int)$_POST['parent_id'] : null;

        $stmt = $db->prepare("INSERT INTO folders (name, parent_id) VALUES (:n, :p)");
        $stmt->bindValue(':n', $name, SQLITE3_TEXT);
        if ($parent_id !== null) {
            $stmt->bindValue(':p', $parent_id, SQLITE3_INTEGER);
        } else {
            $stmt->bindValue(':p', null, SQLITE3_NULL);
        }
        if (!$stmt->execute()) {
            $error = "Error creating folder.";
        } else {
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }
?>

```
**createiteration.php**
```php
<?php
$project_id = (int)($_POST['project_id'] ?? 0);
$title = $_POST['title'] ?? '';
$description = $_POST['description'] ?? '';
$file = $_FILES['file'] ?? null;

$upload_dir = 'uploads/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

if ($file && $file['tmp_name']) {
    $file_url = $upload_dir . basename($file['name']);
    if (move_uploaded_file($file['tmp_name'], $file_url)) {
        // Insert new iteration record
        $stmt = $db->prepare(
            "INSERT INTO iterations (project_id, title, description, file_url)
             VALUES (:pid, :t, :d, :f)"
        );
        $stmt->bindValue(':pid', $project_id, SQLITE3_INTEGER);
        $stmt->bindValue(':t', $title, SQLITE3_TEXT);
        $stmt->bindValue(':d', $description, SQLITE3_TEXT);
        $stmt->bindValue(':f', $file_url, SQLITE3_TEXT);
        if (!$stmt->execute()) {
            $error = "Error saving iteration in DB.";
        } else {
            // Retrieve the new iteration ID
            $iteration_id = $db->lastInsertRowID();
            // Insert creation date into the separate table (created_at is auto-set)
            $stmt2 = $db->prepare("INSERT INTO iteration_dates (iteration_id) VALUES (:iid)");
            $stmt2->bindValue(':iid', $iteration_id, SQLITE3_INTEGER);
            $stmt2->execute();
            
            header('Location: ' . $_SERVER['PHP_SELF'] . '?project_id=' . $project_id);
            exit;
        }
    } else {
        $error = "Error uploading file.";
    }
} else {
    $error = "No file uploaded.";
}
?>


```
**createproject.php**
```php
<?php
$folder_id = (int)($_POST['folder_id'] ?? 0);
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';

        $stmt = $db->prepare("INSERT INTO projects (folder_id, title, description) VALUES (:f, :t, :d)");
        $stmt->bindValue(':f', $folder_id, SQLITE3_INTEGER);
        $stmt->bindValue(':t', $title, SQLITE3_TEXT);
        $stmt->bindValue(':d', $description, SQLITE3_TEXT);
        if (!$stmt->execute()) {
            $error = "Error creating project.";
        } else {
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }
?>

```
**deletecustomer.php**
```php
<?php
$id = (int)($_POST['id'] ?? 0);

        $stmt = $db->prepare("DELETE FROM customers WHERE id=:id");
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        if (!$stmt->execute()) {
            $error = "Error deleting customer.";
        } else {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?customers');
            exit;
        }
?>

```
**deletefolder.php**
```php
<?php
$folderId = (int)($_POST['folder_id'] ?? 0);

        // (Optional) If you'd like to also delete subfolders/projects/iterations, 
        // you'll need a recursive approach. For simplicity, we do a direct delete:
        $stmt = $db->prepare("DELETE FROM folders WHERE id = :id");
        $stmt->bindValue(':id', $folderId, SQLITE3_INTEGER);
        if (!$stmt->execute()) {
            $error = "Error deleting folder. Make sure it's empty or handle cascade manually.";
        } else {
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }
?>

```
**deleteiteration.php**
```php
<?php
$iterationId = (int)($_POST['iteration_id'] ?? 0);
        // Optionally delete comments for this iteration:
        $db->exec("DELETE FROM comments WHERE iteration_id = $iterationId");
        
        // Now delete iteration
        $stmt = $db->prepare("DELETE FROM iterations WHERE id = :id");
        $stmt->bindValue(':id', $iterationId, SQLITE3_INTEGER);
        if (!$stmt->execute()) {
            $error = "Error deleting iteration.";
        } else {
            // Redirect back to the same project page
            $project_id = (int)$_POST['parent_project_id'];
            header('Location: ' . $_SERVER['PHP_SELF'] . '?project_id=' . $project_id);
            exit;
        }
?>

```
**deleteproject.php**
```php
<?php
$projectId = (int)($_POST['project_id'] ?? 0);

        // Before deleting the project, optionally remove all iterations for that project:
        $db->exec("DELETE FROM iterations WHERE project_id = $projectId");

        // Now delete project
        $stmt = $db->prepare("DELETE FROM projects WHERE id = :id");
        $stmt->bindValue(':id', $projectId, SQLITE3_INTEGER);
        if (!$stmt->execute()) {
            $error = "Error deleting project.";
        } else {
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }
?>

```
**loginform.php**
```php
<?php
$username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        if (login($username, $password)) {
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        } else {
            $error = "Invalid username or password.";
        }
?>

```
**signupform.php**
```php
<?php
// Only creating admins from public signup
        $username = $_POST['username'] ?? '';
        $passwordPlain = $_POST['password'] ?? '';
        $hashed = password_hash($passwordPlain, PASSWORD_DEFAULT);

        // Insert into `users` table with role='admin'
        $stmt = $db->prepare("INSERT INTO users (username, password, role) VALUES (:u, :p, 'admin')");
        $stmt->bindValue(':u', $username, SQLITE3_TEXT);
        $stmt->bindValue(':p', $hashed, SQLITE3_TEXT);
        $res = $stmt->execute();
        if (!$res) {
            $error = "Error creating admin (username might already exist).";
        } else {
            // Optionally auto-login new admin
            login($username, $passwordPlain);
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }
?>

```
**updatecursomer.php**
```php
<?php
$id = (int)($_POST['id'] ?? 0);
        $username = $_POST['username'] ?? '';
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';

        $stmt = $db->prepare(
            "UPDATE customers SET username=:u, name=:n, email=:e WHERE id=:id"
        );
        $stmt->bindValue(':u', $username, SQLITE3_TEXT);
        $stmt->bindValue(':n', $name, SQLITE3_TEXT);
        $stmt->bindValue(':e', $email, SQLITE3_TEXT);
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        if (!$stmt->execute()) {
            $error = "Error updating customer.";
        } else {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?customers');
            exit;
        }
?>

```
**updateiteration.php**
```php
<?php
 $iterationId = (int)($_POST['iteration_id'] ?? 0);
        $projectId   = (int)($_POST['parent_project_id'] ?? 0);
        $title       = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $file        = $_FILES['file'] ?? null;

        // Get old file_url if needed
        $oldFileStmt = $db->prepare("SELECT file_url FROM iterations WHERE id = :iid");
        $oldFileStmt->bindValue(':iid', $iterationId, SQLITE3_INTEGER);
        $oldFileRes = $oldFileStmt->execute();
        $oldFile    = $oldFileRes->fetchArray(SQLITE3_ASSOC);
        $oldFileUrl = $oldFile['file_url'] ?? '';

        $file_url = $oldFileUrl; // Default is the old file
        $upload_dir = 'uploads/';

        // If user uploaded a new file
        if ($file && $file['tmp_name']) {
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $newFileUrl = $upload_dir . basename($file['name']);
            if (move_uploaded_file($file['tmp_name'], $newFileUrl)) {
                $file_url = $newFileUrl;
            } else {
                $error = "Error uploading new file.";
            }
        }

        // Update iteration
        $stmt = $db->prepare("
            UPDATE iterations
            SET title = :t, description = :d, file_url = :f
            WHERE id = :id
        ");
        $stmt->bindValue(':t', $title, SQLITE3_TEXT);
        $stmt->bindValue(':d', $description, SQLITE3_TEXT);
        $stmt->bindValue(':f', $file_url, SQLITE3_TEXT);
        $stmt->bindValue(':id', $iterationId, SQLITE3_INTEGER);

        if (!$stmt->execute()) {
            $error = "Error updating iteration.";
        } else {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?project_id=' . $projectId);
            exit;
        }
?>

```
## uploads