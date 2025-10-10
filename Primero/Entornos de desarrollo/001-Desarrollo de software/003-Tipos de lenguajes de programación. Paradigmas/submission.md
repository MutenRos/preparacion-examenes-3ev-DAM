


En nuestro entorno digital actual, los lenguajes de programación desempeñan un papel crucial en la creación de software y aplicaciones. Aunque hay una amplia variedad de lenguajes disponibles, es importante entender sus clasificaciones y paradigmas para elegir el más adecuado según las necesidades del proyecto.

1) Identificación de lenguajes

- Dos ejemplos de lenguajes de bajo nivel:
  1. Ensamblador (Assembly) — lenguaje de muy bajo nivel, con instrucciones mapeadas a operaciones de la CPU; programación muy cercana al hardware.
  2. Lenguaje máquina (binario) — instrucciones codificadas directamente para la CPU; el paradigma es de control total y baja abstracción.
  
  Estos lenguajes permiten control directo del hardware y requieren del programador gestionar detalles de memoria y registros, por lo que encajan en la categoría de bajo nivel.

- Dos ejemplos de lenguajes de alto nivel:
  1. Python — alto nivel, tipado dinámico, gestión automática de memoria y abstracciones de alto nivel para estructuras de datos y librerías.
  2. JavaScript — alto nivel, diseñado para productividad y abstracciones en entornos web.

  Estos lenguajes ofrecen abstracciones que alejan al desarrollador de la arquitectura física de la máquina (memoria, registros), y permiten desarrollar con menos código y mayor portabilidad.

2) Elección de paradigma

- Elegimos un Paradigma Orientado a Objetos (OOP)
  OOP organiza el software en objetos que combinan estado y comportamiento. Facilita la modularidad, reutilización y modelado conceptual de dominios reales.
- En proyectos modernos (interfaces, sistemas embebidos, web), OOP se usa para encapsular dispositivos, recursos y comportamientos (p. ej.   clase `Sensor`, `Actuator`, `Controller`).

Una aplicacion practica podria ser algo como hacer parpadear un led conectado a una raspberry via GPIO, aunque en nuestro caso solo lo vamos a simular:

 ```python
 # led_app.py
 # Ejemplo procedural simple que simula el parpadeo de un LED usando prints y time.sleep
 import time

 def blink_led(times=3, interval=0.5):
     for i in range(times):
         print(f"[SIM] LED ON ({i+1}/{times})")
         time.sleep(interval)
         print(f"[SIM] LED OFF ({i+1}/{times})")
         time.sleep(interval)

 if __name__ == '__main__':
     print("Demo: parpadeo de LED (simulado)")
     blink_led(3, 0.4)
     print("Fin")
 ```

 Ejecución (cualquier equipo con Python 3):

 ```bash
 python3 led_app.py
 ```

 El script imprimirá en consola los estados ON/OFF simulando el LED.


Conclusión: elegir el paradigma adecuado facilita el diseño y mantiene el código modular y reutilizable. OOP permite modelar dispositivos y comportamientos del mundo real, lo que es especialmente útil en proyectos con hardware como Raspberry Pi.


