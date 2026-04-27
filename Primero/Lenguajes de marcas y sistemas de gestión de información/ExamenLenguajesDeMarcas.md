Segundo asalto: `Lenguajes De Marcas`. Vamos a usar `HTML`+`CSS` para crear nuestro portfolio web. Se nos pide que cada articulo del portafolio tenga las siguientes caracteristicas:
- titulo
- descripcion
- fecha
- categoria
- imagen
Todo esto lo vamos a hacer en la maquina virtual que hemos creado en el examen de `Sistemas Informaticos`, asi que lo primero sera arrancar la maquina virtual y conectarnos via `ssh` a ella.
 ```bash
sudo ssh dario@192.168.1.41
```
Aunque como no nos hemos salido desde el examen anterior esta parte nos la pode,mos saltar.
Navegamos hasta la carpeta raiz del servidor web:
```bash
cd /var/www/html
```
Una vez aqui creamos una nueva carpeta llamada `portfolio`:
```bash
sudo mkdir portfolio
```
Comprobamos con `ls` que se ha creado correctamente y entramos.
```bash
cd portfolio
```
Como no nos vamos a complicar con mecanismos complicados de paginas web, nuestro portfolio sera la pagina principal, asi que creamos `index.html` y `styles.css`:
```bash
sudo nano index.html | sudo nano styles.css
```
Empezamos por el `index.html`, donde crearemos la estructura basica de la pagina web:
```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Portfolio_Examen</title>
</head>
<body>
    <header>
        <h1>Portfolio_Examen</h1>
    </header>
    <main>
    </main>
    <footer>
        <p>
            (Aqui se supone que van los articles)
        </p>
    </footer>
</body>
</html>
```
Ahora vamos a reciclar la estructura de los articles que hemos hecho en los ejercicios practicos, adaptandolos a lo que se nos pide en el examen. Cada articulo tendra la siguiente estructura:
```html
<article class="card" tabindex="0">
        <img src="{img_src}" alt="{titulo}" class="thumb"
             onerror="this.src='{PLACEHOLDER_IMG}'">
        <div class="content">
          <h3>{titulo}</h3>
          <p>{desc}</p>
          <a href="{url_link}" class="link" target="_blank" rel="noopener">
            Ver proyecto →
          </a>
        </div>
      </article>
```
Y lo adaptamos a nuestros requisitos:
```html
<article class="card" tabindex="0">
        <img src="{imagen}" alt="{titulo}" class="thumb"
             onerror="this.src='{PLACEHOLDER_IMG}'">
        <div class="content">
          <h3>{titulo}</h3>
          <p>{descripcion}</p>
          <p>Fecha: {fecha}</p>
          <p>Categoria: {categoria}</p>
        </div>
      </article>
```
Repetimos este Bloque hasta tener almenos 5 articulos en nuestro portfolio, y guardamos el archivo.
El archivo completo nos quedaria tal que asi:
```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Portfolio_Examen</title>
</head>
<body>
    <header>
        <h1>Portfolio_Examen</h1>
    </header>
    <main>
    </main>
    <footer>
        <article class="card" tabindex="0">
        <img src="{imagen}" alt="{titulo}" class="thumb"
             onerror="this.src='{PLACEHOLDER_IMG}'">
        <div class="content">
          <h3>{titulo}</h3>
          <p>{descripcion}</p>
          <p>Fecha: {fecha}</p>
          <p>Categoria: {categoria}</p>
        </div>
      </article>
      <article class="card" tabindex="0">
        <img src="{imagen}" alt="{titulo}" class="thumb"
             onerror="this.src='{PLACEHOLDER_IMG}'">
        <div class="content">
          <h3>{titulo}</h3>
          <p>{descripcion}</p>
          <p>Fecha: {fecha}</p>
          <p>Categoria: {categoria}</p>
        </div>
      </article>
      <article class="card" tabindex="0">
        <img src="{imagen}" alt="{titulo}" class="thumb"
             onerror="this.src='{PLACEHOLDER_IMG}'">
        <div class="content">
          <h3>{titulo}</h3>
          <p>{descripcion}</p>
          <p>Fecha: {fecha}</p>
          <p>Categoria: {categoria}</p>
        </div>
      </article>
      <article class="card" tabindex="0">
        <img src="{imagen}" alt="{titulo}" class="thumb"
             onerror="this.src='{PLACEHOLDER_IMG}'">
        <div class="content">
          <h3>{titulo}</h3>
          <p>{descripcion}</p>
          <p>Fecha: {fecha}</p>
          <p>Categoria: {categoria}</p>
        </div>
      </article>
      <article class="card" tabindex="0">
        <img src="{imagen}" alt="{titulo}" class="thumb"
             onerror="this.src='{PLACEHOLDER_IMG}'">
        <div class="content">
          <h3>{titulo}</h3>
          <p>{descripcion}</p>
          <p>Fecha: {fecha}</p>
          <p>Categoria: {categoria}</p>
        </div>
      </article>
    </footer>
</body>
</html>

```
Metemos todo esto en `index.html` y guardamos.
Ahora vamos a quitarle las pintas de periodico viejo que tiene esto, y para ello vamos a usar `styles.css`. En este archivo vamos a lavarle la cara a nuestro portfolio, y como nos va el rollo retroviejo, vamos a utilizar una gama de colores y fuentes que recuerden al estilo "*synthwave*", como el rosa neón, azul eléctrico y púrpura oscuro y algun toque en ocre. El archivo `styles.css` quedaria tal que asi:


```css
body {
    font-family: 'Arial', sans-serif;
    background-color: #1a1a2e;
    color: #e0e0e0;
    margin: 0;
    padding: 0;
}
header {
    background-color: #16213e;
    padding: 20px;
    text-align: center;
}
h1 {
    color: #e94560;
}
main {
    padding: 20px;
}
footer {
    background-color: #0f3460;
    padding: 20px;
    text-align: center;
}
.card {
    background-color: #53354a;
    border-radius: 8px;
    margin: 20px auto;
    padding: 20px;
    max-width: 600px;
}
.thumb {
    max-width: 100%;
    border-radius: 8px;
}
.content {
    margin-top: 15px;
}
h3 {
    color: #e94560;
}
.link {
    color: #0f3460;
    text-decoration: none;
}
.link:hover {
    text-decoration: underline;
}
```
Ahora deberiamos poder verlo en el navegador introduciendo:
```
http://localhost/index.html
```
Cruzamos los dedos, comprobamos, y si todo ha ido bien, ya tenemos nuestro portfolio web listo, pero como nos hemos olvidado la linea de `styles` en el `head`, volvemos a editar `index.html` y añadimos la linea:
```html
<style>@import url('styles.css');</style>
```
Ahora tenemos la estructura basica, pero esta vacio, asi que vamos apedirle a juestra amiga la IA que nos de un Json para rellenat los articulos en base a mi GitHub (https://github.com/MutenRos?tab=repositories):

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
Y añadiremos el javascript a index.htm para que coja los datos del json y los meta en los articulos. Par variar, reciclaremos codigo de los ejercicios practicos, para acoplarlo a nuestro examen:

```html
<script>
        fetch('datos.json')
            .then(response => response.json())
            .then(data => {
                // Obtener el footer donde están los artículos
                const footer = document.querySelector('footer');
                
                // Limpiar el contenido actual del footer
                footer.innerHTML = '';
                
                // Crear los artículos dinámicamente
                data.proyectos.forEach(proyecto => {
                    const article = document.createElement('article');
                    article.className = 'card';
                    article.tabIndex = 0;
                    
                    article.innerHTML = `
                        <img src="${proyecto.imagen}" alt="${proyecto.titulo}" class="thumb"
                             onerror="this.src='https://via.placeholder.com/400x200/53354a/ffffff?text=No+Image'">
                        <div class="content">
                            <h3>${proyecto.titulo}</h3>
                            <p>${proyecto.descripcion}</p>
                            <p>Fecha: ${proyecto.fecha}</p>
                            <p>Categoria: ${proyecto.categoria}</p>
                        </div>
                    `;
                    
                    footer.appendChild(article);
                });
            })
            .catch(error => console.error('Error cargando los proyectos:', error));
    </script>
```
Y lo añadiremos al final del body, justo antes de la etiqueta de cierre `</body>`. Ahora al entrar a la pagina se deberia ver bien, asi que comprobamos.
Claro, hemos creado `datos.json` localmente, falta crearlo en la maquina virtual:
```bash
sudo nano datos.json
```
Comprobamos y genial, funciona, ya tenemos nuestro portfolio web listo para el siguiente examen.
Los archivos completos quedarian tal que asi:

```index.html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>@import url('Styles.css');</style>
    <title>Portfolio_Examen</title>
</head>
<body>
    <header>
        <h1>Portfolio_Examen</h1>
    </header>
    <main>
    </main>
    <footer>
        <article class="card" tabindex="0">
        <img src="{imagen}" alt="{titulo}" class="thumb"
             onerror="this.src='{PLACEHOLDER_IMG}'">
        <div class="content">
          <h3>{titulo}</h3>
          <p>{descripcion}</p>
          <p>Fecha: {fecha}</p>
          <p>Categoria: {categoria}</p>
        </div>
      </article>
      <article class="card" tabindex="0">
        <img src="{imagen}" alt="{titulo}" class="thumb"
             onerror="this.src='{PLACEHOLDER_IMG}'">
        <div class="content">
          <h3>{titulo}</h3>
          <p>{descripcion}</p>
          <p>Fecha: {fecha}</p>
          <p>Categoria: {categoria}</p>
        </div>
      </article>
      <article class="card" tabindex="0">
        <img src="{imagen}" alt="{titulo}" class="thumb"
             onerror="this.src='{PLACEHOLDER_IMG}'">
        <div class="content">
          <h3>{titulo}</h3>
          <p>{descripcion}</p>
          <p>Fecha: {fecha}</p>
          <p>Categoria: {categoria}</p>
        </div>
      </article>
      <article class="card" tabindex="0">
        <img src="{imagen}" alt="{titulo}" class="thumb"
             onerror="this.src='{PLACEHOLDER_IMG}'">
        <div class="content">
          <h3>{titulo}</h3>
          <p>{descripcion}</p>
          <p>Fecha: {fecha}</p>
          <p>Categoria: {categoria}</p>
        </div>
      </article>
      <article class="card" tabindex="0">
        <img src="{imagen}" alt="{titulo}" class="thumb"
             onerror="this.src='{PLACEHOLDER_IMG}'">
        <div class="content">
          <h3>{titulo}</h3>
          <p>{descripcion}</p>
          <p>Fecha: {fecha}</p>
          <p>Categoria: {categoria}</p>
        </div>
      </article>
    </footer>
</body>
</html>
```

```styles.css
body {
    font-family: 'Arial', sans-serif;
    background-color: #13136e;
    color: #e0e0e0;
    margin: 0;
    padding: 0;
}
header {
    background-color: #371657;
    padding: 20px;
    text-align: center;
}
h1 {
    color: #e945db;
}
main {
    padding: 20px;
}
footer {
    background-color: #13136e;
    padding: 20px;
    text-align: center;
}
.card {
    background-color: #371657;
    border-radius: 8px;
    margin: 20px auto;
    padding: 20px;
    max-width: 600px;
}
.thumb {
    max-width: 100%;
    border-radius: 8px;
}
.content {
    margin-top: 15px;
}
h3 {
    color: #e945db;
}
.link {
    color: #d4b00f;
    text-decoration: none;
}
.link:hover {
    text-decoration: underline;
}
```

```datos.json
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
Por ultimo, vamos a hacer que los articulos aparezcan en 2 columnas en la pantalla, para ello usaremos `CSS Grid`. Modificamos el `main` en `styles.css` para que quede asi:
```css
main {
    padding: 20px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}
```

Ahora si que ya podemos entrar, comprobar que todo esta en su sitio, rudimentariamente pero en su sitio, y nos queda un portfolio ampliable que tener en nuestra pagina personal de desarrollador.
Y con esto hemos terminado el examen de `Lenguajes De Marcas`. Nos vemos en el siguiente examen. Habiendo utilizado elementos externos al html para extraer informacion. Pero lo mas importante es que nos acabamos de conseguir otro 10! :D
