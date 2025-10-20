Ejercicio práctico: Manipulación de variables y funciones en JavaScript
Contexto
En este ejercicio, vamos a explorar cómo manipular variables y funciones en JavaScript. Imagina que estás trabajando en un proyecto para controlar los motores de tu coche de carreras del siglo pasado utilizando una Raspberry Pi. Necesitas crear funciones para iniciar y detener el motor, así como para ajustar su velocidad.

Enunciado paso a paso
Crear una función para iniciar el motor: Esta función debe imprimir "Motor iniciado" en la consola.
Crear una función para detener el motor: Esta función debe imprimir "Motor detenido" en la consola.
Crear una función para ajustar la velocidad del motor: Esta función recibe un parámetro velocidad y debe imprimir la velocidad actual del motor.
Restricciones
No usar bucles (for, while).
No usar estructuras condicionales complejas (switch, if...else).
Criterios de evaluación
Introducción y contextualización (25%): Explica por qué es importante controlar los motores de un coche de carreras del siglo pasado.
Desarrollo técnico correcto y preciso (25%): Implementa las funciones correctamente sin errores.
Aplicación práctica con ejemplo claro (25%): Prueba las funciones con diferentes velocidades y muestra los resultados en la consola.
Cierre/Conclusión enlazando con la unidad (25%): Reflexiona sobre cómo podrías utilizar estas funciones en un proyecto real.
Ejemplo de código:
  
```javascript
function iniciarMotor() {
  // Inicia el motor
}

function detenerMotor() {
  // Detén el motor
}

function ajustarVelocidad(velocidad) {
  // Ajusta la velocidad del motor
}
```
Desafío: Prueba las funciones con diferentes velocidades y muestra los resultados en la consola.

A veces un coche viejo necesita algo de tecnologia moderna para seguir vivo. Uno de los proyectos mas conocidos es el `speeduino`, que permite controlar los motores de un coche de carreras del siglo pasado utilizando una Raspberry Pi.
Nosotros vamos a intentar controlar nuestro coche con unas funciones en `JavaScript`:
Como estamos en una simulacion, en su lugar haremos que en pantalla se imprima el estado y velocidad del motor.

```javascript
//iniciar el motor
function iniciarMotor() {
  console.log("Motor iniciado");
}
//detener el motor
function detenerMotor() {
  console.log("Motor detenido");
}
//ajustar la velocidad del motor
function ajustarVelocidad(velocidad) {
  console.log("Velocidad actual del motor: " + velocidad + " km/h");
  velocidad = parseInt(velocidad, 10);
}
//Pruebas de las funciones
iniciarMotor();
detenerMotor();
ajustarVelocidad(100);
```
Lo que, al llamar a las funciones, nos mostrará en pantalla:
"Motor iniciado"
"Motor detenido"
"Velocidad actual del motor: 100 km/h"

Y ya tenemos nuestro coche de carreras del siglo pasado controlado por una Raspberry Pi y unas funciones en JavaScript.