Ver las variables de entorno:
printenv

echo 'export MI_SERVIDORSMTP_CORREO_JOCARSA="smtp.ionos.es"' >> ~/.bashrc
source ~/.bashrc

pero para PHP son:

sudo nano /etc/apache2/envvars

export MI_SERVIDORSMTP_CORREO_JOCARSA="smtp.jocarsa.com"
export MI_CORREO_JOCARSA="tu_correo@jocarsa.com"
export MI_CONTRASENA_CORREO_JOCARSA="tu_password"

sudo systemctl restart apache2
