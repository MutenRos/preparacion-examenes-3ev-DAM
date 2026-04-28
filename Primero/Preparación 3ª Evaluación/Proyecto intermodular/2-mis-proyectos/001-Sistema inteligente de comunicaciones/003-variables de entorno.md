Cuando creamos variables de entorno lo que hacemos es proteger la información
sacándola de nuestro código y metiéndola en el sistema

Editamos el bashrc
nano ~/.bashrc

export MI_CORREO_JOCARSA="info@jocarsa.com"
export MI_CONTRASENA_CORREO_JOCARSA="XXXXXX"

Fijamos de forma persistentes
source ~/.bashrc

Preguntamos por esas variables:
echo $MI_VARIABLE
