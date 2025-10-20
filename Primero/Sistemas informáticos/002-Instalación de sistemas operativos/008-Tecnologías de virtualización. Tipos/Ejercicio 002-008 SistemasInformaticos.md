Instalación de Ubuntu Linux en una Máquina Virtual
Contexto: En este ejercicio práctico, aprenderás cómo instalar Ubuntu Linux en una máquina virtual usando Oracle VirtualBox. Esta experiencia te permitirá entender mejor el concepto de virtualización y cómo se pueden crear entornos aislados dentro de una única máquina física. Además, podrás experimentar con un sistema operativo Linux sin afectar tu equipo físico.

Enunciado paso a paso:

Instalación de Oracle VirtualBox

Descarga e instala Oracle VirtualBox desde su sitio web oficial.
Asegúrate de tener acceso a Internet para descargar la imagen ISO de Ubuntu Linux.
Creación de una Nueva Máquina Virtual

Abre Oracle VirtualBox y selecciona "Nueva".
Asigna un nombre a tu máquina virtual (por ejemplo, "Ubuntu").
Elige el tipo de sistema operativo como Linux y la versión como Ubuntu.
Ajusta el tamaño del disco duro según tus necesidades. Por ejemplo, si tienes 16 GB de RAM, asigna 4 GB al sistema virtual.
Configuración del Hardware

Asigna la cantidad de memoria RAM a tu máquina virtual (4 GB en este caso).
Configura el controlador de red como NAT para permitir el acceso a Internet.
Añade un disco duro virtuales con una capacidad de 125 GB.
Instalación de Ubuntu Linux

Arranca la máquina virtual y sigue las instrucciones del instalador de Ubuntu.
Elige idioma, zona horaria y configuraciones básicas.
Selecciona el método de instalación (por ejemplo, "Install Ubuntu alongside other operating systems").
Comienza la instalación y espera hasta que termine.
Configuración Post-Instalación

Una vez instalado, inicia sesión en tu cuenta de usuario.
Instala cualquier software adicional que desees (por ejemplo, herramientas de desarrollo o aplicaciones ofimáticas).
Restricciones:

No utilices métodos alternativos para la instalación de Ubuntu Linux.
Asegúrate de seguir los pasos en el orden indicado.
Criterios de evaluación:

Introducción y contextualización (25%): Muestra comprensión del concepto de virtualización y su importancia en la configuración de sistemas informáticos.
Desarrollo técnico correcto y preciso (25%): Demuestra habilidad técnica para crear una máquina virtual y instalar un sistema operativo Linux dentro de ella.
Aplicación práctica con ejemplo claro (25%): Proporciona un ejemplo detallado de la instalación y configuración del sistema.
Cierre/Conclusión enlazando con la unidad (25%): Explora cómo esta experiencia se relaciona con el tema de virtualización y su relevancia en el entorno informático.




Saber instalar cualquier sistema operativo es crucial para cualquier profesional de la informatica. Todos tienen un proceso de instalacion similar, pero cada uno tiene sus particularidades. 

En este caso, vamos a instalar Ubuntu Linux en una maquina virtual usando Oracle VirtualBox. Para ello, primero descargamos e instalamos Oracle VirtualBox desde su pagina oficial. Una vez instalado, y con la `ISO` del sistema operativo descargada, creamos una nueva maquina virtual y comenzamos el proceso de instalacion:
1. Abrimos Oracle VirtualBox y seleccionamos "Nueva".
2. Asignamos un nombre a nuestra maquina virtual (por ejemplo, "Ubuntu").
3. Elegimos el tipo de sistema operativo como Linux y la version como Ubuntu.
4. Ajustamos el tamaño del disco duro segun nuestras necesidades. Por ejemplo, si tenemos 16 GB de RAM, asignamos 4 GB al sistema virtual.
5. Asignamos la cantidad de memoria RAM a nuestra maquina virtual (4 GB en este caso).
6. Configuramos el controlador de red como NAT para permitir el acceso a Internet.
7. Añadimos un disco duro virtual con una capacidad de 125 GB.
8. Arrancamos la maquina virtual y seguimos las instrucciones del instalador de Ubuntu:
    - Elegimos idioma, zona horaria y configuraciones basicas.
    - Seleccionamos el metodo de instalacion (por ejemplo, "Install Ubuntu alongside other operating systems").
    - Comenzamos la instalacion y esperamos hasta que termine
9. Una vez instalado, iniciamos sesion en nuestra cuenta de usuario.

Y con esto ya tenemos nuestro sistema operativo instalado en una maquina virtual, y podemos empezar a usarlo y a instalar cualquier software adicional que necesitemos (por ejemplo, herramientas de desarrollo o aplicaciones ofimaticas). Asi que vamos a descargar los paquetes de openOffice, y de python3, que vienen en los repositorios oficiales de Ubuntu, y los instalamos con el gestor de paquetes `apt`:

```bash
sudo apt update
sudo apt install openoffice python3
```
Y ahora si que tenemos una maquina virtual con ubuntu completamente funcional para nuestros trabajos de ofimatica.
