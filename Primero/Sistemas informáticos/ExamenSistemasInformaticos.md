El dia D ha llegado (D, de examen). Primera parte, `Sistemas Informaticos`, preparar el terreno sobre el que haremos el resto de examenes. Se nos da una `.ISO` de `Ubuntu_Server_20.04.3_LTS_64_bits`, y se nos pide instalarla en virtualbox. Esta mquina sera sobre la que trabajaremos todos los examenes, asi que deberemos atender cuidadosamente a su instalacion.
Para instalarla seguiremos los siguientes pasos:
    - Descargar la ISO desde la pagina oficial de Ubuntu.
    - Descargar e instalar VirtualBox desde su pagina oficial.
    - Abrimos VirtualBox y creamos una nueva maquina virtual:
        - Crear una nueva maquina virtual o Ctrl+N
        - Para no liarnos le vamos a poner de nombre ExamenDAM
        - Tipo: Linux
        - Examinamos en su busqueda y seleccionamos la iso que vamos a utilizar.
        - Desmarcamos la casilla de "Instalacion desatendida" y le damos a siguiente.
    Ahora configuraremos los specs de la maquina virtual. Como es una maquina que unicamente utilizaremos para 5 examenes mas, le asignaremos las siguientes caracteristicas:
        - Memoria RAM: 4098 MB.
        - Disco duro: 32Gbs VDI, dinamicamente asignado.
        - Procesadores: 2
        - Red: Adaptador puente, para que la maquina virtual tenga acceso a internet.
    Ya la tenemos configurada, el siguiente paso es arrancar y seguir las instrucciones que salen en pantalla:
        - Como ya sanbemos lo que estamos instalando, seleccionamos "Instalar Ubuntu Server".
        - Seleccionamos el idioma y la distribución de teclado.
        - Elegimos la instalacion `Default`.
        - Seleccionamos la red (si tenemos mas de una tarjeta de red, seleccionamos la que tenga conexion a internet).
        - Nos saltamos la parte de proxy.
        -Vamos a decirle que utilizaremos el disco entero.
    Ahora nos mostrara una pantalla en la que aparecera un resumen del sistema de archivos, junto a las particiones de disco que acabamos de hacer(si las hacemos). Si estamos de acuerdo, le daremos a `Hecho`y confirmamos.
    La siguiente pantalla es la de creacion de usiusario. Aqui elegiremos el nombre de nuestro usuario, de la maquina y la contraseña.  
    Una vez mas, nos dara a elegir una version de ubuntu a instalar, pero esta vez nos ofrecera `Ubuntu_Pro` (spoiler, no lo queremos).
    Cuando nos pregunte, le diremos que si queremos instalar OpenSSH, vital para el examen, vital para trabajar con maquinas alojadas en una maquina distinta a la que estas usando, y vital para no morir en el intento. 
    El resto de opciones las dejaremos por defecto, y esperaremos a que termine la instalacion.

    Instalando  [||||||......]  25%
    Instalando  [||||||||||..]  85%
    Instalando  [||||||||||||]  100%

    Una vez  termina la instalacion, nos pedira retirar el medio de instalacion y reiniciar el sistema, y nosotros como humanos obedientes haremos caso.

    Reiniciamos, logueamos y ahora vamos a dejar esto preparado para el resto de examenes. Sabemos que vamos a utilizar:
        - OpenSSH (ya instalado)
        - Apache2
        - MySQL
        - PHP
        - phpMyAdmin
    Asi que vamos a instalar todo eso de golpe. Nos logueamos y abrimos una terminal, donde escribiremos:
    ```bash
    sudo apt update && sudo apt upgrade -y
    sudo apt install apache2 mysql-server php libapache2-mod-php php-mysql php-cli php-cgi php-gd php-mbstring php-xml php-pear php-bcmath php-zip php-soap php-intl php-imagick -y
    sudo apt install phpmyadmin -y
   
    ``` 
    Como copiar y pegar a una maquina virtual tiene su aquel, vamos a ir de listos y conectarnos ya directamente via ssh:
        - Abrimos nuestra consola y escrimos:
        ```bash
        ssh dario@192.168.1.41
        ```
        - Nos pedira la contraseña, y una vez dentro ya podemos copiar y pegar sin problemas.

Si hemos seguido todos estos pasos y no nos han salido demasiadas letras rojas indicando un error, significa que nuestro examen esta minimo de 10. Ya solo nos queda estudiar y esperar al siguiente examen. Ademas tenemos una maquina virtual (justita, pero suficiente para nuestros examenes) mas o menos equivalente a una Raspberry pi de las que tanto han aparecido en los ejercicios practicos.