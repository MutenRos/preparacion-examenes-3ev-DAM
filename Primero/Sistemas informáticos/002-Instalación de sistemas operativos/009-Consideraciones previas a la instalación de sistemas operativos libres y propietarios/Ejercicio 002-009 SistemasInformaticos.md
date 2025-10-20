Título
Configuración y selección de sistemas operativos para dispositivos limitados

Contexto
En nuestro hobby de jugar con Raspberrys y similares, es común encontrar equipos con recursos limitados. Para optimizar el rendimiento y asegurar la seguridad de nuestro proyecto, debemos seleccionar cuidadosamente el sistema operativo adecuado. Los sistemas operativos antiguos son más rápidos pero tienen menos soporte para dispositivos nuevos y funciones de seguridad desactualizadas.

Enunciado paso a paso
Identificación del hardware: Antes de elegir un sistema operativo, es fundamental conocer las características técnicas de nuestro Raspberry Pi o dispositivo similar.

(El alumnado debe completar este apartado)
Selección del sistema operativo: Basándonos en los recursos disponibles y las necesidades del proyecto, debemos seleccionar el sistema operativo más adecuado.

(El alumnado debe completar este apartado)
Configuración inicial: Una vez instalado el sistema operativo, realizaremos una configuración básica para optimizar su rendimiento y seguridad.

(El alumnado debe completar este apartado)
Restricciones
El alumnado no puede utilizar sistemas operativos propietarios o versiones actualizadas.
Debe utilizar solo sistemas operativos libres que sean compatibles con los dispositivos limitados.
Criterios de evaluación
Introducción y contextualización (25%): El alumnado debe explicar el contexto del problema, destacando la importancia de seleccionar un sistema operativo adecuado para dispositivos limitados.
Desarrollo técnico correcto y preciso (25%): El alumnado debe identificar correctamente las características técnicas del dispositivo y seleccionar el sistema operativo más apropiado.
Aplicación práctica con ejemplo claro (25%): El alumnado debe describir la configuración inicial del sistema operativo seleccionado, justificando sus decisiones.
Cierre/Conclusión enlazando con la unidad (25%): El alumnado debe explicar cómo esta actividad se relaciona con el tema de instalación de sistemas operativos y cómo puede aplicarse en su hobby de jugar con Raspberrys y similares.





Aunque "Linux es Linux", cada una de sus versiones esta pensada para untipo de tareas y dispositivos en concreto. Por ejemplo, para ordenadores "normales" usamos Ubuntu, para servidores, tiene su version UbuntuServer, para placas de desarollo estan los sistemas Raspian, optimizados para RPI's, y no dejan de ser todos linux, y visualmente a nivel de usuario no apreciaremos muucha diferencia, pero funcionalmente, cada OS es un mundo.
Tenemos una RPI 4B conn 4gb de RAM, y una tarjeta SD de 16gb,y queremos instalarle un OS basado en linux, ya que en el mortatil lo tenemos puesto y va muy bien, pero ni tenemos la misma capacidad de memoria que en el portatil, ni tenemos el tamaño de disco, asu que no podemos instalarle un ubuntu normal y corriente por que:
1.- No nos va a funcionar bien, ya que el sistema operativo va a consumir muchos recursos y la RPI se va a quedar sin memoria.
2.- Aunque tengamos espacio en la SD, no nos va a quedar espacio para instalar programas y aplicaciones.
3.- No es un sistema operativo pensado para placas de desarrollo, y no va a estar optimizado para el hardware que tenemos.

Asi que tenemos que buscar un sistema operativo basado en linux, pero que este optimizado para placas de desarrollo y que consuma pocos recursos.
Afortunadamente, existen muchas distribuciones de linux pensadas para placas de desarrollo, y algunas de ellas son:
- Raspbian: Es la distribución oficial de linux para RPI's, y esta optimizada para el hardware de la RPI. Es una distribución ligera y fácil de usar, y tiene una gran comunidad de usuarios.
- DietPi: Es una distribución ligera y optimizada para placas de desarrollo, y esta pensada para consumir pocos recursos. Es una distribución muy ligera, y tiene una gran cantidad de aplicaciones preinstaladas.
- Armbian: Es una distribución ligera y optimizada para placas de desarrollo, y esta pensada para usuarios avanzados. Es una distribución muy ligera, y tiene una gran cantidad de aplicaciones preinstaladas. Esta pensada para placas con procesadores ARM, como las Orange Pi, Banana Pi, etc.
Vamos a ir a lo facil ay no a complicarnos la vida y perder pelo con Armbian, y vamos a instalar Raspbian en la RPI:
1.- Descargamos el Raspberry Pi Imager desde la web oficial: https://www.raspberrypi.com/software/
2.- Instalamos el Raspberry Pi Imager en nuestro ordenador. (lo hacemos asi por que lo usaremos mas de una vez en mas de una RPI
3.- Insertamos la tarjeta SD en el lector de tarjetas del ordenador, o en su defecto, un adaptador usb.
4.- Abrimos el Raspberry Pi Imager, y seleccionamos una de las opciones de Raspbian, en nuestro caso, la version "Raspberry Pi OS (32-bit)".
5.- Seleccionamos la tarjeta SD en la que queremos instalar el sistema operativo.
6.- Hacemos clic en "Escribir" y esperamos a que se complete el proceso.
7.- Una vez finalizado, retiramos la tarjeta SD del ordenador e insertamos en la Raspberry Pi.
8.- Conectamos la Raspberry Pi a la corriente y a un monitor, y esperamos a que arranque.

A partir de aqui el proceso es exactamente igual que instalar el ubuntu de la actividad anterior, pero con la diferencia de que el sistema operativo es mucho mas ligero y esta optimizado para el hardware de la RPI.
Pero lo importante es que tenemos el sistema adecuado para el tipo de dispositivo y sus prestaciones poara que funcione de la manera mas eficiente posible.