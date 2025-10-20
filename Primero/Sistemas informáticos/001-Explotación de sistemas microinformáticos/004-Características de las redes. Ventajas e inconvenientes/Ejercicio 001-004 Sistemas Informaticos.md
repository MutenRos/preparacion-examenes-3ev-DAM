Título
Configuración y monitorización de una red informática

Contexto
Después del lanzamiento de las bombas nucleares en la Segunda Guerra Mundial, el mundo se vio obligado a modernizar sus sistemas para evitar futuras amenazas. En respuesta, los Estados Unidos desarrollaron un sistema de comunicación segura y descentralizado conocido como ARPANET, que formó el núcleo de Internet actual. Este proyecto fue impulsado por la necesidad de mantener la continuidad operativa en caso de una guerra nuclear.

En nuestra sociedad moderna, las redes informáticas son indispensables para la colaboración y el intercambio de información. En este ejercicio, aprenderás cómo configurar y monitorizar una red utilizando herramientas básicas disponibles en sistemas operativos libres como Linux.

Enunciado paso a paso
Configuración del protocolo TCP/IP:

Crea un archivo llamado red_config.txt que incluya la configuración IP de los equipos en tu red.
# red_config.txt
192.168.1.100 eth0
192.168.1.101 eth1
Utiliza el comando ifconfig para aplicar la configuración IP a los adaptadores de red.
Creación de un script para monitorizar la conectividad:

Crea un script llamado monitor_red.sh que use el comando ping para verificar la conectividad con otros equipos en la red.
#!/bin/bash
echo "Comprobando conectividad..."
ping -c 4 192.168.1.101
Asegúrate de que el script tenga permisos de ejecución.
Configuración de un servidor web:

Instala Apache en tu sistema y configura un directorio virtual para alojar una página web sencilla.
sudo apt-get update
sudo apt-get install apache2
Crea un archivo HTML en /var/www/html/index.html con el siguiente contenido:
<!DOCTYPE html>
<html>
<head>
    <title>Configuración de Redes</title>
</head>
<body>
    <h1>Bienvenido a la configuración de redes</h1>
</body>
</html>
Restricciones
No usar librerías externas.
No utilizar input() ni lectura de teclado para obtener datos.
Mantén el alcance dentro del tema de configuración y monitorización de redes.
Criterios de evaluación
Introducción y contextualización (25%): El estudiante debe mostrar comprensión sobre la importancia de las redes informáticas en la seguridad nacional post-guerra fría.
Desarrollo técnico correcto y preciso (25%): El estudiante debe configurar correctamente el protocolo TCP/IP, crear un script para monitorizar la conectividad y configurar un servidor web.
Aplicación práctica con ejemplo claro (25%): El estudiante debe mostrar habilidad en la aplicación práctica de los conceptos aprendidos mediante ejemplos claros.
Cierre/Conclusión enlazando con la unidad (25%): El estudiante debe enlazar el ejercicio con la unidad, mostrando cómo estas configuraciones son fundamentales para mantener la continuidad operativa en redes informáticas.


El mayor paso dado en la historia de internet, fue la creacion de `redes descentralizadas`, que permitieran la comunicacion entre ordenadores, sin necesidad de un servidor central, que pudiera ser destruido en caso de guerra. Asi nacio ARPANET, que mas tarde se convirtio en internet, alla en tiempos de la guerra fria.

Aunque a mayor escala, estoy seguro que todos nosotros tenemos en casa una red domestica, que nos permite compartir archivos, impresoras, y sobre todo, conexion a internet. En este ejercicio vamos a ver como configurar una red basica, y como monitorizarla.

lo primero va a ser localizar todos los dispositivos de la red, y asignarles una IP fija, para que no cambie cada vez que se reinicie el router. Para ello, crearemos un archivo llamado `red_config.txt` con las IPs y los adaptadores de red correspondientes.


| IP                | Nombre de red detectado    | Nombre asignado (propuesto)            | 
| ----------------- | -------------------------- | -------------------------------------- | 
| **192.168.1.200** | ARRIS_VIP5242_A89FECF2AAC3 | 📺 **Decodificador Movistar / TV Box** |  
| **192.168.1.65**  | HUAWEI_P_smart_2019-3ba9d  | 📱 **Móvil de tu madre**               | 
| **192.168.1.153** | kali                       | 💻 **Tu portátil de ciberseguridad**   | 
| **192.168.1.115** | Jarvis                     | 🖥️ **Tu PC principal (Jarvis)**        | 
| **192.168.1.41**  | HUAWEI_Mate_10-ed711d263d  | 📱 **Tu móvil personal**               |
| **192.168.1.58**  | RedmiNote8T-RedmiNot       | 📱 **Móvil de tu pareja o familiar**   | 
| **192.168.1.92**  | Redmi-Note-12              | 📱 **Móvil secundario / pruebas**      | 
| **192.168.1.152** | Redmi10C                   | 📱 **Móvil de tu padre o repuesto**    | 

Despues, usaremos el comando `ifconfig` para asignar las IPs a los adaptadores de red correspondientes. En mi caso, tengo dos adaptadores de red, `eth0` y `eth1`, asi que asignare una IP a cada uno.

```bash
ifconfig eth0 192.168.1.100
ifconfig eth1 192.168.1.101
``` 
Uno es normal, el otro aporta mayor velocidad y capacidad de transferencia, pero no es todos los dispositivos lo soportan.
Despues, crearemos un script llamado `monitor_red.sh` que usara el comando `ping` para verificar la conectividad con todos los equipos en la red. El script sera algo asi:

```bash
#!/bin/bash
echo "Comprobando conectividad..."
for ip in 192.168.1.200 192.168.1.65 192.168.1.153 192.168.1.115 192.168.1.41 192.168.1.58 192.168.1.92 192.168.1.152
do
    ping -c 4 $ip
done
``` 
Lo que nos iria dando salidas como esta:

```
Comprobando conectividad...
PING 192.168.1.200: 64 bytes from 192.168.1.200: icmp_seq=1 ttl=64 time=0.123 ms
PING 192.168.1.65: 64 bytes from 192.168.1.65: icmp_seq=1 ttl=64 time=0.456 ms
PING 192.168.1.153: 64 bytes from 192.168.1.153: icmp_seq=1 ttl=64 time=0.789 ms
PING 192.168.1.115: 64 bytes from 192.168.1.115: icmp_seq=1 ttl=64 time=1.012 ms
PING 192.168.1.41: 64 bytes from 192.168.1.41: icmp_seq=1 ttl=64 time=1.234 ms
PING 192.168.1.58: 64 bytes from 192.168.1.58: icmp_seq=1 ttl=64 time=1.567 ms
PING 192.168.1.92: 64 bytes from 192.168.1.92: icmp_seq=1 ttl=64 time=1.890 ms
PING 192.168.1.152: 64 bytes from 192.168.1.152: icmp_seq=1 ttl=64 time=2.123 ms
```
Finalmente, instalaremos Apache en nuestro sistema y configuraremos un directorio virtual para alojar una pagina web sencilla. Esto nos permitira acceder a una pagina web desde cualquier dispositivo de la red, y comprobar que todo funciona correctamente.

```bash
sudo apt update
sudo apt install apache2
sudo systemctl start apache2
sudo systemctl enable apache2
``` 
Luego, crearemos un archivo HTML en `/var/www/html/index.html` con el siguiente contenido:

```html
<!DOCTYPE html>
<html>
<head>
    <title>Configuracion de Redes</title>
</head>
<body>
    <h1>Bienvenido a la pagina de Configuracion de Redes</h1>
</body>
</html>
```
Y ya podremos acceder a la pagina web desde cualquier dispositivo de la red, simplemente escribiendo la IP del servidor en el navegador web. Ya solo nos faltaria implementar la logica real para configurar y monitorizar la red, pero eso ya es otra historia.De momento, tenemos a todos los dispositivos conectados y comunicandose entre si.