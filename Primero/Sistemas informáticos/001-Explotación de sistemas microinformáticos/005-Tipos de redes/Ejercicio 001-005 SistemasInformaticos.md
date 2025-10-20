Despliegue de una Red Local Usando Raspberries
Contexto
En nuestra actualidad digitalizada, los sistemas microinformáticos son fundamentales para muchas aplicaciones cotidianas. Algunos de nuestros hobbies, como jugar con Raspberrys y similares, modelado e impresión 3D, requieren una buena comprensión de cómo funcionan las redes locales (LANs). En este ejercicio, aprenderemos a configurar una LAN sencilla usando Raspberry Pi, un dispositivo popular para proyectos electrónicos.

Enunciado paso a paso
Configuración inicial: Antes de comenzar, asegúrate de tener varios Raspberry Pi y conectores Ethernet listos.
Asignación de direcciones IP: Cada Raspberry Pi necesita una dirección IP única en la misma red local para comunicarse entre sí. Utiliza el protocolo TCP/IP para asignar estas direcciones.
Conexión física: Conecta los Raspberry Pi con cables Ethernet entre ellos y a un router o switch.
Configuración de las interfaces de red: En cada Raspberry Pi, configura la interfaz de red para que utilice la dirección IP asignada.
Prueba de conexión: Utiliza herramientas como ping para verificar que los dispositivos pueden comunicarse entre sí.
Restricciones
No utilizar librerías externas ni input()/lectura de teclado.
Limitarte a comandos y herramientas disponibles en el sistema operativo del Raspberry Pi.
Criterios de evaluación
Introducción y contextualización (25%): Explica por qué es importante configurar una LAN y cómo los Raspberrys pueden facilitar este proceso.
Desarrollo técnico correcto y preciso (25%): Describe cada paso del proceso con claridad y precisión.
Aplicación práctica con ejemplo claro (25%): Proporciona un ejemplo práctico de cómo configurar una LAN usando Raspberrys, incluyendo los comandos específicos a utilizar.
Cierre/Conclusión enlazando con la unidad (25%): Concluye el ejercicio explicando cómo esta actividad se relaciona con el tema de tipos de redes y cómo puede aplicarse en proyectos futuros.
Completa este ejercicio para demostrar tu comprensión del despliegue de una LAN utilizando Raspberrys.

Lo bueno y lo malo de las raspberrys, es que al ser ordenadores "completos" tan pequeños, nunca tienes solo una, de lo que si que tengo solo 1 es agujeros para pasar cables de red, asi que en lugar de tirarlo al pc, lo tire a un switch  gigabit que tenia por ahi y conecte mi pc, el servidor, las raspberrys y deje un par de puertos libres para el portatil y futuras adquisiciones.
Lo primero para configurar una red es listar los dispositivos conectados, que en este caso, usaremos los del ejercicio anterior, que añadiendo lo anteriormente dicho quedaria tal que asi:
---
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
| **192.168.1.100** | raspberrypi1               | 🥧 **Raspberry Pi 1**                   | 
| **192.168.1.101** | raspberrypi2               | 🥧 **Raspberry Pi 2**                   |
| **192.168.1.102** | raspberrypi3               | 🥧 **Raspberry Pi 3**                   |
| **192.168.1.103** | orangepi1                  | 🥧 **Orange Pi 1**                      |
---

Y ahora configuraremos las interfaces de red en cada raspberry, para que usen las IPs asignadas. En mi caso, usare `eth0` para todas las raspberrys.

```bash
sudo ifconfig eth0 192.168.1.100 netmask 255.255.255.0 up
sudo ifconfig eth0 192.168.1.101 netmask 255.255.255.0 up
sudo ifconfig eth0 192.168.1.102 netmask 255.255.255.0 up
sudo ifconfig eth0 192.168.1.103 netmask 255.255.255.0 up
```
Y ahora, para comprobar que todo funciona correctamente, usaremos el comando `ping` para verificar la conectividad entre las raspberrys y otros dispositivos en la red.

```bash
ping -c 4 192.168.1.100
ping -c 4 192.168.1.101
ping -c 4 192.168.1.102
ping -c 4 192.168.1.103
```
Si todo esta configurado correctamente, deberiamos ver respuestas de cada dispositivo, indicando que la comunicacion es exitosa. Con esto, hemos desplegado una red local sencilla utilizando Raspberry Pi, lo que nos permite conectar y comunicar varios dispositivos en nuestra red domestica o de trabajo.