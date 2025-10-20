Contexto
El alumno disfruta de jugar con Raspberrys y similares, lo que le ha llevado a experimentar con diferentes proyectos electrónicos. En este contexto, se propone desarrollar una calculadora sencilla utilizando HTML, CSS y JavaScript. La actividad también integra el modelado e impresión 3D, ya que los materiales utilizados en el proyecto pueden ser almacenados o presentados de manera visual.

Enunciado paso a paso
HTML:

Crea una estructura básica de HTML con una calculadora.
<!doctype html>
<html>
  <head>
    <style>
      #calculadora{
        background:grey;
        width:300px;
        display:flex;
        flex-direction:column;
        color:white;
        font-family:sans-serif;
        padding:5px;
        border-radius:5px;
      }
      #calculadora>*{
        width:100%;
      }
      #calculadora table td{
        width:20%;
        background:LightGray;
        padding:10px;
        text-align:center;
        border-radius:5px;
      }
    </style>
  </head>
  <body> 
    <div id="calculadora">
      <header>
        <!-- Aquí irá el título de la calculadora -->
      </header>
      <div id="pantalla"></div>
      <table>
        <tr>
          <td><button>1</button></td>
          <td><button>2</button></td>
          <td><button>3</button></td>
          <td><button class="operacion">+</button></td>
        </tr>
        <!-- Agrega más filas con botones para los demás números y operaciones -->
      </table>
    </div>
  </body>
</html>
JavaScript:

Añade el JavaScript necesario para realizar las operaciones matemáticas.
// Selecciona el elemento que tenga la etiqueta P
var pantalla = document.querySelector("#pantalla");

// Agrega un evento click a los botones de números y operaciones
document.querySelectorAll("button").forEach(function(botón){
  botón.addEventListener("click", function(){
    if(this.classList.contains("operacion")){
      pantalla.textContent += " " + this.textContent + " ";
    } else {
      pantalla.textContent += this.textContent;
    }
  });
});

// Agrega un evento click al botón de igual para realizar la operación
document.querySelector("button.igual").addEventListener("click", function(){
  var expresión = pantalla.textContent.split(" ");
  var resultado = eval(expresión.join(""));
  pantalla.textContent = resultado;
});
Restricciones
No usar librerías externas.
Solo estructuras vistas en clase.
Criterios de evaluación
Introducción y contextualización (25%)

El alumno debe mostrar una comprensión del contexto del proyecto y cómo integra los hobbies propuestos.
Desarrollo técnico correcto y preciso (25%)

El código HTML debe tener la estructura correcta de una calculadora.
El JavaScript debe realizar correctamente las operaciones matemáticas.
Aplicación práctica con ejemplo claro (25%)

El alumno debe presentar un ejemplo claro de cómo usar la calculadora y mostrar los resultados obtenidos.
Cierre/Conclusión enlazando con la unidad (25%)

El alumno debe explicar cómo esta actividad se relaciona con el tema actual y cómo puede aplicarse en proyectos futuros.




Todos nuestros programas y/o proyectos, deberian tener una interfaz de usuario si van a estar destinadas a usuarios finales. En este caso, vamos a crear una interfaz sencilla para una calculadora utilizando JavaScript.

Primero montaremos la estructura base de la calculadora en HTML y CSS, y luego añadiremos la funcionalidad con JavaScript.
Estructura HTML y CSS
```html
<!doctype html>
<html>
  <head>
    <style>
      #calculadora{
        background:grey;
        width:300px;
        display:flex;
        flex-direction:column;
        color:white;
        font-family:sans-serif;
        padding:5px;
        border-radius:5px;
      }
      #calculadora>*{
        width:100%;
      }
      #calculadora table td{
        width:20%;
        background:LightGray;
        padding:10px;
        text-align:center;
        border-radius:5px;
      }
    </style>
  </head>
  <body> 
    <div id="calculadora">
      <header>
        <!-- Aquí irá el título de la calculadora -->
      </header>
      <div id="pantalla"></div>
      <table>
        <tr>
          <td><button>1</button></td>
          <td><button>2</button></td>
          <td><button>3</button></td>
          <td><button class="operacion">+</button></td>
        </tr>
        <!-- Agrega más filas con botones para los demás números y operaciones -->
      </table>
    </div>
  </body>
</html>
```

Y la completaremos con los mismos botones que la calculadora por defecto de windows, para lo que tambien usaremos `CSS`:

```html
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>Calculadora (sin JavaScript)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
      #calculadora{
        background:#666;
        width:300px;
        display:flex;
        flex-direction:column;
        color:white;
        font-family:sans-serif;
        padding:8px;
        border-radius:8px;
        gap:8px;
        box-sizing:border-box;
      }
      #calculadora>*{ width:100%; }
      #pantalla{
        min-height:48px;
        background:#222;
        border-radius:6px;
        padding:10px;
        font-size:20px;
        text-align:right;
        overflow-x:auto;
        box-sizing:border-box;
      }
      table{ border-collapse:separate; border-spacing:6px; }
      #calculadora table td{ width:25%; }
      #calculadora button, #calculadora input[type="submit"]{
        width:100%;
        background:#d3d3d3;
        color:#111;
        padding:10px;
        text-align:center;
        border-radius:6px;
        border:none;
        font-size:18px;
        cursor:pointer;
      }
      #calculadora .igual{ background:#4caf50; color:#fff; }
      #calculadora .clear{ background:#e53935; color:#fff; }
      #expr{
        width:100%;
        padding:10px;
        font-size:18px;
        border-radius:6px;
        border:none;
        box-sizing:border-box;
        background:#111; color:#0f0;
      }
      iframe#resultado{
        width:100%;
        height:60px;
        background:#111;
        color:#0f0;
        border:0;
        border-radius:6px;
      }
      small{ color:#ddd; }
    </style>
  </head>
  <body>
    <div id="calculadora">
      <header><h1 style="margin:0;font-size:18px;">Calculadora</h1></header>

      <!-- “Pantalla”: aquí escribes la expresión a mano con el teclado -->
      <form action="https://api.mathjs.org/v4/" method="get" target="resultado">
        <input id="expr" name="expr" inputmode="decimal" placeholder="Ej: (7+5)*3/2" aria-label="Expresión a calcular" />
        <div style="margin-top:8px;">
          <input type="submit" class="igual" value="=" />
          <a class="clear" href="#" onclick="return false;" style="display:inline-block;text-align:center;padding:10px;border-radius:6px;text-decoration:none;">C</a>
        </div>
        <small>Escribe la expresión completa y pulsa “=”. Resultado debajo.</small>
      </form>

      <!-- Teclado “decorativo” para mantener el mismo layout (sin JS no inserta números) -->
      <table aria-hidden="true">
        <tr>
          <td><button type="button" disabled>7</button></td>
          <td><button type="button" disabled>8</button></td>
          <td><button type="button" disabled>9</button></td>
          <td><button type="button" disabled>/</button></td>
        </tr>
        <tr>
          <td><button type="button" disabled>4</button></td>
          <td><button type="button" disabled>5</button></td>
          <td><button type="button" disabled>6</button></td>
          <td><button type="button" disabled>*</button></td>
        </tr>
        <tr>
          <td><button type="button" disabled>1</button></td>
          <td><button type="button" disabled>2</button></td>
          <td><button type="button" disabled>3</button></td>
          <td><button type="button" disabled>-</button></td>
        </tr>
        <tr>
          <td><button type="button" disabled>0</button></td>
          <td><button type="button" disabled>.</button></td>
          <td><button type="button" disabled>=</button></td>
          <td><button type="button" disabled>+</button></td>
        </tr>
      </table>

      <!-- Resultado de la API -->
      <iframe id="resultado" name="resultado" title="Resultado"></iframe>
    </div>
  </body>
</html>

```
Y ahora añadimos la funcionalidad con JavaScript:

```html
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>Calculadora</title>
    <style>
      #calculadora{
        background:#666;
        width:300px;
        display:flex;
        flex-direction:column;
        color:white;
        font-family:sans-serif;
        padding:8px;
        border-radius:8px;
        gap:8px;
      }
      #calculadora>*{ width:100%; }
      #pantalla{
        min-height:48px;
        background:#222;
        border-radius:6px;
        padding:10px;
        font-size:20px;
        text-align:right;
        overflow-x:auto;
        box-sizing:border-box;
      }
      table{ border-collapse:separate; border-spacing:6px; }
      #calculadora table td{
        width:25%;
      }
      #calculadora button{
        width:100%;
        background:#d3d3d3;
        color:#111;
        padding:10px;
        text-align:center;
        border-radius:6px;
        border:none;
        font-size:18px;
        cursor:pointer;
      }
      #calculadora button.operacion{ background:#bbb; }
      #calculadora button.igual{ background:#4caf50; color:#fff; }
      #calculadora button.clear{ background:#e53935; color:#fff; }
    </style>
  </head>
  <body>
    <div id="calculadora">
      <header><h1 style="margin:0;font-size:18px;">Calculadora</h1></header>
      <div id="pantalla"></div>
      <table>
        <tr>
          <td><button>7</button></td>
          <td><button>8</button></td>
          <td><button>9</button></td>
          <td><button class="operacion">/</button></td>
        </tr>
        <tr>
          <td><button>4</button></td>
          <td><button>5</button></td>
          <td><button>6</button></td>
          <td><button class="operacion">*</button></td>
        </tr>
        <tr>
          <td><button>1</button></td>
          <td><button>2</button></td>
          <td><button>3</button></td>
          <td><button class="operacion">-</button></td>
        </tr>
        <tr>
          <td><button>0</button></td>
          <td><button>.</button></td>
          <td><button class="igual">=</button></td>
          <td><button class="operacion">+</button></td>
        </tr>
        <tr>
          <td colspan="4"><button class="clear">C</button></td>
        </tr>
      </table>
    </div>

    <script>
      const pantalla = document.querySelector("#pantalla");

      // Manejador para números y operaciones (EXCLUYE el botón "=")
      document.querySelectorAll("button:not(.igual):not(.clear)").forEach(function(boton){
        boton.addEventListener("click", function(){
          if (this.classList.contains("operacion")) {
            // Evita poner dos operadores seguidos
            const txt = pantalla.textContent.trim();
            if (!txt || /[+\-*/]$/.test(txt)) return;
            pantalla.textContent += " " + this.textContent + " ";
          } else {
            pantalla.textContent += this.textContent;
          }
        });
      });

      // Botón "=": evalúa la expresión visible
      document.querySelector("button.igual").addEventListener("click", function(){
        try {
          // Limpia cualquier carácter no permitido por seguridad básica
          let expr = pantalla.textContent.replace(/[^0-9+\-*/.\s]/g, "").trim();

          // Evita evaluar si acaba en operador
          if (/[+\-*/.]$/.test(expr)) return;

          // Evalúa de forma controlada
          const resultado = Function("return " + expr)();
          if (resultado === undefined || Number.isNaN(resultado)) return;

          pantalla.textContent = String(resultado);
        } catch (e) {
          // Si hay error, no rompas la UI (opcional: muestra "Error")
          // pantalla.textContent = "Error";
        }
      });

      // Botón "C": limpiar pantalla
      document.querySelector("button.clear").addEventListener("click", function(){
        pantalla.textContent = "";
      });
    </script>
  </body>
</html>
```
Con este código, tendrás una calculadora funcional que permite realizar operaciones básicas. La interfaz es sencilla y clara, y el JavaScript maneja la lógica de las operaciones. Puedes probarla en cualquier navegador moderno.
Pero lo mas importante, ya podemos empezar a crear interfaces de usuario para nuestros programas y proyectos.



