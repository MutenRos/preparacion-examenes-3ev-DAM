Introducción y contextualización

La topología de red estrella / copo de nieve es una configuración utilizada en redes de área grande para representar sistemas muy complejos. Este tipo de topología es especialmente útil gracias a las capacidades del sistema TCP/IP, que le asigna una dirección única (algo así como un número de teléfono) a cada dispositivo conectado a internet.

Enunciado paso a paso

Identificación de la red: Imagina que tienes un equipo de desarrollo que trabaja en un proyecto con múltiples dispositivos y servidores. Para organizar estos equipos eficientemente, necesitas configurar una red estrella / copo de nieve.

Asignación de direcciones IP: Cada dispositivo en la red debe tener una dirección IP única. Para este ejercicio, asigna direcciones IPv4 a los siguientes dispositivos:

Servidor principal: 192.168.1.1
Computadora del jefe de proyecto (Jorge): 192.168.1.2
Computadora de María (miembro del equipo de desarrollo): 192.168.1.3
Servidor de impresión: 192.168.1.4
Configuración del concentrador: El concentrador es el dispositivo central que conecta todos los demás dispositivos a la red. En este ejercicio, asume que el concentrador tiene una dirección IP de 192.168.1.0.

Creación de diagrama: Utiliza un software como Blender o Tinkercad (hobbies: Modelado e impresión 3D) para crear un modelo 3D del copo de nieve, donde cada dispositivo esté conectado al concentrador.

Diagrama de red: Dibuja el esquema de la topología en un papel o software como Microsoft Visio (hobbies: Jugar con Raspberrys y similares). Asegúrate de incluir todas las direcciones IP asignadas y el rol de cada dispositivo.

Restricciones

No usar librerías externas ni estructuras no vistas.
Solo utilizar los conceptos y herramientas presentados en la clase actual.
Criterios de evaluación

Introducción y contextualización (25%): El estudiante debe entender completamente el contexto del ejercicio y cómo se aplica a las redes de área grande.

Desarrollo técnico correcto y preciso (25%): El estudiante debe asignar correctamente las direcciones IP y configurar la topología estrella / copo de nieve.

Aplicación práctica con ejemplo claro (25%): El estudiante debe crear un diagrama 3D del copo de nieve y un esquema de red detallado, mostrando el rol de cada dispositivo y las direcciones IP asignadas.

Cierre/Conclusión enlazando con la unidad (25%): El estudiante debe explicar cómo esta configuración beneficia a su equipo de desarrollo y cómo se relaciona con los conceptos aprendidos en clase.


Una de las topologias de red mas comunes es la topologia estrella / copo de nieve, que es una configuracion utilizada en redes de area grande para representar sistemas muy complejos. Este tipo de topologia es especialmente util gracias a las capacidades del sistema TCP/IP, que le asigna una direccion unica (algo asi como un numero de telefono) a cada dispositivo conectado a internet.
Seguramentre es la que haya en la mayoria de redes domesticas y de oficina, ya que es facil de configurar y mantener. En esta topologia, todos los dispositivos estan conectados a un concentrador central (hub o switch), que se encarga de gestionar el trafico de datos entre ellos.

Para este ejercicio, vamos a imaginar que tenemos un equipo de desarrollo que trabaja en un proyecto con multiples dispositivos y servidores. Para organizar estos equipos eficientemente, necesitamos configurar una red estrella / copo de nieve.

Listamos los dispositivos y sus direcciones IP asignadas:

| IP                | Nombre de red detectado    | Nombre asignado (propuesto)            |
| ----------------- | -------------------------- | -------------------------------------- |
| **192.168.1.1**   | Router                      | Servidor principal                     |
| **192.168.1.2**   | Computadora de Jorge        | Jefe de proyecto                       |
| **192.168.1.3**   | Computadora de María        | Miembro del equipo de desarrollo       |
| **192.168.1.4**   | Servidor de impresión       | Servidor de impresión                  |
| **192.168.1.5**   | Computadora de Luis          | Miembro del equipo de desarrollo       |

El concentrador es el dispositivo central que conecta todos los demas dispositivos a la red. En este ejercicio, asumimos que el concentrador tiene una direccion IP de 192.168.1.0.

Y ahora vamos a intentar una representacion visual con caracteres ascii de la topologia estrella / copo de nieve:

```
[Servidor de impresión]  [Computadora de Luis]
               \           /
                \         /
              [Concentrador]
                /     |      \
               /      |       \
[Computadora de Jorge]|[Computadora de María] 
                      |
                      |
          [Servidor principal]
```
En este diagrama, cada dispositivo esta conectado al concentrador central, que se encarga de gestionar el trafico de datos entre ellos. Esta configuracion permite una comunicacion eficiente y organizada dentro del equipo de desarrollo, facilitando la colaboracion y el intercambio de informacion.