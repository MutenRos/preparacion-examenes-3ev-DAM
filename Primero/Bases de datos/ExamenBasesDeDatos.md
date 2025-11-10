Esta genial haberle podido pedir a la IA que nos diera el `.JSON` ya hecho para rellenar el portafolio, pero como programadores deberiamos tener nuestra base de datos bien estructurada y rellena con nuestros proyectos. Asi que vamos a ello.
Necesitaremos crear la base de datos `Examen`, para esta ocasion y dentro de ella dos tablas: `Proyectos` y `Categorias`.
La tabla de `proyectos` tendra los siguientes campos:
- ID (Primary Key, Auto Incremental)
- Nombre
- Descripcion
- Fecha
- Categoria (foreign key a la tabla categorias)

La tabla de `categorias` tendra los siguientes campos:
- ID (Primary Key, Auto Incremental)
- Nombre
- Nivel de peligrosidad (1/5)

Para crear nuestra base de datos iremos a:
```
http://localhost/phpmyadmin
```
A partir de este punto, podemos empezar a crear las tablas manualmente.
Vamos a la izquierda, y donde pone `new`, le damos click. Ponemos el nombre `Examen` y le damos a crear.
Ahora, con la base de datos creada, vamos a crear las tablas. Empezamos por `Proyectos`:
- Nombre: Proyectos
- Numero de columnas: 5
Le damos a continuar, y rellenamos los campos como sigue:
- ID: INT, longitud 9, marcar la casilla de `A_I` (esto hara que sea auto incremental y no tengamos que preocuparnos de ponerle un ID a cada proyecto)
- ID: PRIMARY KEY (para que sea la clave primaria)
- Nombre: VARCHAR, longitud 50
- Descripcion: TEXT, longitud 200
- Fecha: DATE
- Categoria: INT, longitud 9
Le damos a guardar, y ya tenemos la tabla de proyectos creada.
Ahora vamos a crear la tabla de `Categorias`, esta la haremos mediante codigo SQL, que es breve y rapido:
```sql
CREATE TABLE Categorias (
    ID INT(9) AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50),
    Nivel_de_peligrosidad INT(1)
);
```
Pegamos este codigo en la pestaña de SQL y le damos a ejecutar. Y ya tenemos las tablas creadas, a falta de relacionarlas entre si.
Para hacer que la tabla de `Proyectos` tenga una foreign key a la tabla de `Categorias`, vamos a la pestaña de `Estructura` de la tabla `Proyectos`, y le damos a `Relaciones`.

Primero vamos a rellenar la tabla de categorias, ya que no depende de nada mas:
```sql
INSERT INTO Categorias (Nombre, Nivel_de_peligrosidad) VALUES
('Educación', 1),
('Web', 2),
('Portfolio', 1),
('IA', 3),
('CiberGuerra', 5);

```

A la tabla de proyectos le vamos a injectar el json del examen anterior:
```json
{
  "proyectos": [
    {
      "titulo": "GIT_DAM_25-27",
      "descripcion": "Repositorio completo del curso DAM 25-27. Incluye materiales, ejercicios y proyectos de todos los módulos del ciclo formativo.",
      "fecha": "2025",
      "categoria": "Educación",
      "imagen": "https://via.placeholder.com/400x200/e94560/ffffff?text=DAM+25-27",
      "url": "https://github.com/MutenRos/GIT_DAM_25-27"
    },
    {
      "titulo": "eID",
      "descripcion": "Proyecto de identificación electrónica desarrollado con HTML. Sistema de gestión de identidades digitales.",
      "fecha": "2025",
      "categoria": "Web",
      "imagen": "https://via.placeholder.com/400x200/0f3460/ffffff?text=eID",
      "url": "https://github.com/MutenRos/eID"
    },
    {
      "titulo": "elece-barber",
      "descripcion": "Sitio web para barbería desarrollado con HTML. Diseño moderno y funcional para servicios de peluquería profesional.",
      "fecha": "2025",
      "categoria": "Web",
      "imagen": "https://via.placeholder.com/400x200/53354a/ffffff?text=Elece+Barber",
      "url": "https://github.com/MutenRos/elece-barber"
    },
    {
      "titulo": "Works",
      "descripcion": "Portafolio de trabajos y proyectos personales. Showcase de diferentes desarrollos y experimentos con HTML.",
      "fecha": "2024",
      "categoria": "Portfolio",
      "imagen": "https://via.placeholder.com/400x200/16213e/e94560?text=Works",
      "url": "https://github.com/MutenRos/Works"
    },
    {
      "titulo": "GPTARS_Interstellar",
      "descripcion": "Fork de TARS de Interstellar integrado con ChatGPT. Proyecto Python bajo licencia MIT para asistente conversacional.",
      "fecha": "2024",
      "categoria": "IA",
      "imagen": "https://via.placeholder.com/400x200/1a1a2e/0f3460?text=GPTARS",
      "url": "https://github.com/MutenRos/GPTARS_Interstellar"
    }
  ]
}
```
Y lo traducimos a sql para insertarlo en la tabla de proyectos:
```sql
INSERT INTO Proyectos (Nombre, Descripcion, Fecha, Categoria) VALUES
('GIT_DAM_25-27', 'Repositorio completo del curso DAM 25-27. Incluye materiales, ejercicios y proyectos de todos los módulos del ciclo formativo.', '2025-01-01', 1),
('eID', 'Proyecto de identificación electrónica desarrollado con HTML. Sistema de gestión de identidades digitales.', '2025-01-01', 2),
('elece-barber', 'Sitio web para barbería desarrollado con HTML. Diseño moderno y funcional para servicios de peluquería profesional.', '2025-01-01', 2),
('Works', 'Portafolio de trabajos y proyectos personales. Showcase de diferentes desarrollos y experimentos con HTML.', '2024-01-01', 3),
('GPTARS_Interstellar', 'Fork de TARS de Interstellar integrado con ChatGPT. Proyecto Python bajo licencia MIT para asistente conversacional.', '2024-01-01', 4);
```
Pegamos este codigo en la pestaña de SQL y le damos a ejecutar. Y ya tenemos nuestras tablas creadas, rellenas y relacionadas.

Ahora podemos realizar las operaciones de CRUD (Crear, Leer, Actualizar, Borrar) sobre nuestras tablas para gestionar nuestros proyectos y categorias y evitar las mas peligrosas si hay mucha gente alrededor.

Por ejemplo, para ver los proyectos mas peligrosos, podriamos hacer una consulta SQL como esta:
```sql
SELECT P.Nombre, P.Descripcion, C.Nivel_de_peligrosidad
FROM Proyectos P
JOIN Categorias C ON P.Categoria = C.ID
WHERE C.Nivel_de_peligrosidad >= 4;
```
Esto nos mostraria todos los proyectos cuya categoria tiene un nivel de peligrosidad de 4 o mas.

Si viendolo nos parece demasiado peligroso, podemos eliminar esos proyectos con:
```sql
DELETE P
FROM Proyectos P
JOIN Categorias C ON P.Categoria = C.ID
WHERE C.Nivel_de_peligrosidad >= 4;
```
Y si le hemos cogido algo de practica, podemos actualizar su nivel de peligrosidad con:
```sql
UPDATE Categorias
SET Nivel_de_peligrosidad = Nivel_de_peligrosidad - 1
WHERE Nivel_de_peligrosidad > 1;
```
Y si se nos ocurre otra de nuestras geniales ideas por que tenemos una mente brillante:
```sql
INSERT INTO Categorias (Nombre, Nivel_de_peligrosidad) VALUES ('Proyectos secretos', 5);
```
Si queremos filtrar por mas de una tabla, podemos usar LEFT JOIN, RIGHT JOIN o FULL JOIN segun lo que necesitemos., por ejemplo, si queremos ver todos los proyectos y sus categorias, incluso si no tienen categoria asignada:
```sql
SELECT P.Nombre, C.Nombre AS Categoria
FROM Proyectos P
LEFT JOIN Categorias C ON P.Categoria = C.ID;
```

Ahora ya podemos ver todos los proyectos que tenemos en nuestra base de datos actualizarlos eliminarlos etc, pero es posible que juzgaramos mal un nivel de peligrosidad y no podamos ser nosotros personalmente quien lo actualicem asi que vamos a crear un usuario de repuesto cob todos los permisos para que pueda eliminar las pruebas por nosotros:
```sql
CREATE USER
'admin_examen'@'localhost' IDENTIFIED BY 'Examen2024!';
GRANT ALL PRIVILEGES ON Examen.* TO 'admin_examen'@'localhost;
FLUSH PRIVILEGES;
```
Y con esto ya tenemos nuestra base de datos lista para el examen y para cualquier otro uso que queramos darle. Consultable, escalable, y con un usuario de repuesto para emergencias
