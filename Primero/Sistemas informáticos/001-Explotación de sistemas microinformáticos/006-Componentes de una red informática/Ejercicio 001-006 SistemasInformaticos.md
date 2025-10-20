Título
Configuración y pruebas en una red local con Raspberry Pi

Contexto
Como aficionado a jugar con Raspberrys y similares, has decidido configurar tu propio servidor de impresión 3D en casa. Para ello, necesitas entender cómo funcionan las redes locales y cómo conectar dispositivos como el Raspi al resto de la red. Este ejercicio te ayudará a familiarizarte con los componentes básicos de una red local y a realizar pruebas prácticas.

Enunciado paso a paso
Configuración del adaptador de red:

Conecta tu Raspberry Pi al router mediante un cable Ethernet.
Configura el adaptador de red en el Raspi para que utilice la dirección IP estática correspondiente a tu red local (por ejemplo, 192.168.1.50).
Pruebas de conectividad:

Utiliza el comando ping para verificar la conexión con otros dispositivos en la red.
Por ejemplo, prueba la conexión con el servidor de impresión 3D (192.168.1.51) y con tu ordenador principal (192.168.1.100).
Configuración del protocolo Ethernet:

Asegúrate de que el adaptador de red esté configurado para usar el protocolo Ethernet.
Comprueba la velocidad de conexión utilizando el comando ethtool eth0.
Pruebas de rendimiento:

Transmite datos a través de una conexión Cat6 entre tu ordenador y el Raspi.
Mide la velocidad de transmisión para asegurarte de que es compatible con tu configuración.
Restricciones
No utilizar librerías externas ni estructuras no vistas en clase.
Solo usar los tipos de redes y protocolos mencionados en la clase (redes cableadas, Ethernet).
Criterios de evaluación
Introducción y contextualización (25%): Explica cómo has configurado el adaptador de red del Raspi y qué pruebas has realizado para verificar su funcionamiento.
Desarrollo técnico correcto y preciso (25%): Muestra los resultados de tus pruebas (ping, ethtool) y explica cuáles son las implicaciones técnicas de tu configuración.
Aplicación práctica con ejemplo claro (25%): Proporciona ejemplos claros de cómo has utilizado los comandos mencionados en la clase para verificar la conectividad y rendimiento de la red.
Cierre/Conclusión enlazando con la unidad (25%): Reflexiona sobre cómo esta configuración te ayudará a jugar con Raspberrys y similares, y cómo puedes aplicar los conceptos aprendidos a otros proyectos futuros de redes y sistemas informáticos.

Pata poder controlar mi humilder ende3 con el pc, es necesario conectarlo a la red local, para lo que usaremos una raspberry pi 4b con 4gb de ram, que es mas que suficiente para este proposito. La raspberry pi 4b cuenta con un adaptador de red gigabit ethernet, que es perfecto para conectar a la red local y al router.
Primero vamos a instalar el sistema operativo a la raspberry, que en este caso sera `OCTOPI`, que es una version de Raspbian optimizada para impresoras 3D. Una vez instalado, conectamos la raspberry al router mediante un cable ethernet cat6, y configuramos la IP estatica en el archivo `/etc/dhcpcd.conf`, añadiendo las siguientes lineas al final del archivo:
```bash
interface eth0
static ip_address=192.168.1.50/24
static routers=192.168.1.1
static domain_name_servers=192.168.1.1
```
Reiniciamos y comprobamos que la IP se ha asignado correctamente con el comando `ifconfig eth0`, y hacemos PING a otros dispositivos de la red para comprobar la conectividad:
```bash
ping -c 4 192.168.1.51
ping -c 4 192.168.1.100
```
Tambien comprobamos la velocidad de conexion con el comando `ethtool eth0`, que deberia mostrar una velocidad de 1000Mb/s, que es la maxima soportada por el adaptador de red de la raspberry pi 4b.
```bash
ethtool eth0
```
Finalmente, para comprobar el rendimiento de la conexion, podemos transferir un archivo grande entre el pc y la raspberry pi mediante `scp` o `rsync`, y medir la velocidad de transferencia. Con esto, hemos configurado y probado una red local con Raspberry Pi, lo que nos permite controlar nuestra impresora 3D Ender 3 desde el ordenador de manera eficiente.