Actividad
Descargar y preparar un medio de instalación para Ubuntu

El proceso de instalación de sistemas operativos es una etapa fundamental en la configuración de cualquier sistema informático. Este procedimiento requiere un conocimiento riguroso de los componentes del sistema y las herramientas disponibles para su instalación.

En primer lugar lo que tenemos que hacer es descargar un medio de instalación. El medio por defecto es una imagen ISO, el antiguo DVD de instalación, que se puede descargar de la web. En el caso de Ubuntu, puedes visitar https://ubuntu.com/download/desktop para descargarte la imagen ISO más reciente.

Una vez que lo hayas descargado, tienes dos opciones:

Quemar la imagen en un DVD: Utiliza una aplicación como Brasero o K3b (disponibles en los sistemas operativos Linux) para "quemar" la imagen ISO en un DVD de instalación.
Generar un medio de instalación extraíble: Puedes usar herramientas como Rufus (disponible tanto para Windows como para Linux) para crear un medio de instalación USB extraíble.
Desafío adicional: Intenta utilizar el software que te guste más para preparar el medio de instalación. ¿Te apetece probar tu habilidad con Raspberrys o a ver si puedes dominar el modelado e impresión 3D creando un modelo del medio de instalación?

Cierre: Una vez hayas preparado el medio de instalación, podrás proceder a instalar Ubuntu en tu dispositivo. Este proceso te permitirá experimentar con un sistema operativo libre y abiertos, lo que es una excelente oportunidad para aprender más sobre la configuración y gestión de sistemas informáticos.


Un fallo en el proceso de instalacion de un SO puede dejar inutilizable un equipo, por lo que es importante seguir los pasos correctos y asegurarse de que se dispone de un medio de instalacion adecuado. En este caso y aprovechando la ocasion, os contare como instale la semana pasada Kali linux en mi portatil, que es un sistema operativo libre basado en Debian, orientado a pruebas de penetracion y auditorias de seguridad. Kali linux es un sistema operativo libre, por lo que no hay que preocuparse por licencias.
En una lista de pasos, el proceso de instalacion es el siguiente:
1. Descargar la imagen ISO desde la pagina oficial de Kali linux: https://www.kali.org/get-kali/
2. Verificar la integridad de la imagen descargada, para asegurarse de que no esta corrupta. Esto se puede hacer comprobando el hash SHA256 proporcionado en la pagina oficial.
3. Crear un medio de instalacion, en este caso, una memoria USB booteable. Para ello, se puede usar una herramienta como Rufus (disponible tanto para Windows como para Linux) para crear un medio de instalacion USB extraible.
4. Configurar la BIOS/UEFI del portatil para arrancar desde el medio de instalacion. Esto generalmente implica reiniciar el equipo y presionar una tecla especifica (como F2, F12, DEL, ESC) para acceder a la configuracion de la BIOS/UEFI.
5. Iniciar el proceso de instalacion de Kali linux desde el medio de instalacion. Seguir las instrucciones en pantalla para seleccionar el idioma, la zona horaria, la configuracion del teclado, etc.
6. Configurar el particionado del disco. En este caso, opte por usar todo el disco, ya que no tenia datos importantes en el portatil.
7. Configurar el usuario y la contrasena. Kali linux recomienda usar un usuario no root para mayor seguridad.
8. Completar la instalacion y reiniciar el equipo.

El primer problema que encontre fue que daba error al instalar ciertos paquetes, entre ellos, la parte grafica del OS. Despues de investigar un poco, descubri que era un problema con los repositorios, ya que Kali linux es un sistema operativo orientado a pruebas de penetracion y auditorias de seguridad, y algunos de sus repositorios estan bloqueados por defecto. Para solucionarlo, edite el archivo `/etc/apt/sources.list` y añadi las siguientes lineas:
```deb http://http.kali.org/kali kali-rolling main non-free contrib
```
Despues de esto, actualice la lista de paquetes con `sudo apt update` y volvi a intentar instalar los paquetes que daban error. Esta vez, la instalacion se completo sin problemas.
Finalmente, una vez instalado Kali linux, es importante configurar y monitorizar la red local. Para ello, podemos usar herramientas como `ifconfig` o `ip` para ver la configuracion de la red, y `ping` para comprobar la conectividad con otros dispositivos en la red. Ademas, podemos usar herramientas como `nmap` para escanear la red y descubrir otros dispositivos conectados.

No tenia experiencia con Kali linux, pero si con otros sistemas operativos basados en Linux, por lo que el proceso de instalacion no fue muy complicado. Sin embargo, es importante seguir los pasos correctos y asegurarse de que se dispone de un medio de instalacion adecuado para evitar problemas durante la instalacion.
Ademas, es importante tener en cuenta que Kali linux es un sistema operativo orientado a pruebas de penetracion y auditorias de seguridad, por lo que es recomendable usarlo con precaucion y solo en entornos controlados.