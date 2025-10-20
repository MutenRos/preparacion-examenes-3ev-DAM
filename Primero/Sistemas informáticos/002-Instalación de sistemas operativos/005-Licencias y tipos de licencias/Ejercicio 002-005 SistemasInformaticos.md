Título
Configuración y licencias en sistemas operativos

Contexto
En nuestra actualidad digital, la configuración correcta y la elección adecuada de los sistemas operativos son fundamentales para mantener un equipo eficiente y seguro. Además, aprender sobre las diferentes licencias disponibles nos permite entender mejor cómo manejar nuestros dispositivos desde un punto de vista legal y económico. Como aficionados a jugar con Raspberrys y similares, hemos experimentado la flexibilidad que ofrecen sistemas operativos libres y propietarios en estos dispositivos.

Enunciado paso a paso
Identificar el tipo de licencia:

Elige un sistema operativo que te gustaría instalar en tu Raspberry Pi (por ejemplo, Raspbian o Ubuntu).
Determina si es una licencia propietaria o libre.
Explorar los términos y condiciones:

Si has elegido un sistema operativo con licencia propietaria, visita el sitio web oficial del fabricante para leer los términos de licencia (por ejemplo, Windows).
Para sistemas operativos libres, consulta las licencias de software libre como GPL (por ejemplo, GNU General Public License v3.0).
Configurar el sistema operativo:

Descarga la imagen del sistema operativo que has elegido.
Utiliza un programa de escritura de imágenes como Balena Etcher para escribir la imagen en una tarjeta SD.
Inserta la tarjeta SD en tu Raspberry Pi y enciéndelo.
Explorar las funcionalidades:

Explora algunas características básicas del sistema operativo que has instalado (por ejemplo, el escritorio, aplicaciones preinstaladas).
Prueba a instalar una aplicación adicional si es posible.
Documentación y registro:

Documenta las configuraciones realizadas y cualquier problema que encuentres.
Registra tus descubrimientos en un archivo de texto llamado configuraciones.txt.
Restricciones
No utilizar herramientas o librerías externas para la instalación del sistema operativo.
Solo usar sistemas operativos disponibles para Raspberry Pi.
Criterios de evaluación
Introducción y contextualización (25%):

El estudiante debe identificar correctamente el tipo de licencia del sistema operativo elegido.
Desarrollo técnico correcto y preciso (25%):

El estudiante debe explorar los términos y condiciones de la licencia elegida, mostrando una comprensión adecuada.
Aplicación práctica con ejemplo claro (25%):

El estudiante debe documentar las configuraciones realizadas y cualquier problema encontrado durante el proceso.
Cierre/Conclusión enlazando con la unidad (25%):

El estudiante debe registrar sus descubrimientos en un archivo de texto y explicar cómo estos conocimientos se relacionan con los conceptos aprendidos sobre licencias y sistemas operativos.



Por culpa de mi aficion a las raspberrys y similares, he tenido que instalar gran variedad de OS, voy a decir el 99% por si me equivocara, tenian base linux, y eran sistemas operativos libres, como Raspbian, Ubuntu, Octopi, etc. Pero sobretodo he aprendido mas o menos a buscar el OS adecuado para cada proposito, y a instalarlo y configurarlo.
Lo primero que hay que hacer es elegir el sistema operativo adecuado para nuestro proposito, y asegurarnos de que la licencia es compatible con nuestro uso. Por ejemplo, si queremos un sistema operativo para una raspberry pi que controle una impresora 3D, lo mas logico es usar Octopi, que es un sistema operativo libre basado en Raspbian, optimizado para este proposito.
Despues, tenemos que descargar la imagen del sistema operativo desde la pagina oficial, y escribirla en una tarjeta SD con un programa como Balena Etcher. Una vez escrita, insertamos la tarjeta SD en la raspberry pi y la encendemos. 
Si no la tenemos enchufada al router con cable de red, podemos preconfigurarlo para que se conecte a nuestra red wifi, editando el archivo `wpa_supplicant.conf` en la tarjeta SD antes de insertarla en la raspberry.
Una vez arrancado el sistema operativo, podemos explorar sus funcionalidades basicas, como el escritorio, las aplicaciones preinstaladas, etc. En el caso de Octopi, podemos acceder a la interfaz web desde cualquier navegador en la misma red local, y controlar la impresora 3D desde alli.
Finalmente, documentamos las configuraciones realizadas y cualquier problema encontrado durante el proceso en un archivo de texto llamado `configuraciones.txt`, para futuras referencias. Octopi no tiene aplucaciones, sino plugins, que se pueden instalar desde la interfaz web, como el plugin de control de camara, que permite ver la impresora en tiempo real. Hay boton de instalar, pero en pantalla se muestra el comando que se ejecuta en segundo plano, que es `pip install nombre_del_plugin`, asi que podemos instalarlo desde la terminal si queremos.
Documentando el proceso en un archivo de texto deberia quedar algo asi:
```
Sistema operativo: Octopi
Tipo de licencia: Libre (GPLv3)
Tareas realizadas:
- Descargada la imagen desde https://octoprint.org/download/
- Escrito en tarjeta SD con Balena Etcher
- Configurado wifi editando wpa_supplicant.conf
- Arrancado en Raspberry Pi 4B
- Accedido a la interfaz web desde http://
- Instalado plugin de control de camara con pip install octoprint-webcam
Problemas encontrados:
- Ninguno
```

Con este ejercicio, he aprendido a identificar y entender las licencias de los sistemas operativos, y a instalar y configurar un sistema operativo en una Raspberry Pi. Estos conocimientos son fundamentales para cualquier proyecto que involucre hardware y software, y me seran utiles en futuros proyectos de modelado e impresion 3D.
Ademas, he aprendido a documentar el proceso de instalacion y configuracion, lo que me ayudara a recordar los pasos realizados y a solucionar problemas en el futuro.