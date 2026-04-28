Instalación de prerrequisitos:
sudo a2enmod proxy
sudo a2enmod proxy_http
sudo a2enmod headers
sudo systemctl restart apache2

http://jocarsa.com/flask/

Creamos un nuevo virtualhost

sudo nano /etc/apache2/sites-available/flask.jocarsa.com.conf:

<VirtualHost *:80>
    ServerName flask.jocarsa.com
    ServerAdmin info@jocarsa.com

    ProxyPreserveHost On
    RequestHeader set X-Forwarded-Proto "http"
    RequestHeader set X-Forwarded-Port "80"

    ProxyPass / http://127.0.0.1:5000/
    ProxyPassReverse / http://127.0.0.1:5000/

    ErrorLog ${APACHE_LOG_DIR}/flask.jocarsa.com_error.log
    CustomLog ${APACHE_LOG_DIR}/flask.jocarsa.com_access.log combined
</VirtualHost>

y activamos:

sudo a2ensite flask.jocarsa.com.conf
sudo apachectl configtest
sudo systemctl reload apache2

Con SSL:

<VirtualHost *:443>
    ServerAdmin admin@jocarsa.com
    ServerName flask.jocarsa.com
    ServerAlias www.flask.jocarsa.com

    SSLEngine on
    SSLCertificateFile /etc/apache2/ssl/jocarsa_combined.cer
    SSLCertificateKeyFile /etc/apache2/ssl/jocarsa.key

    ProxyPreserveHost On
    RequestHeader set X-Forwarded-Proto "https"
    RequestHeader set X-Forwarded-Port "443"

    ProxyPass / http://127.0.0.1:5000/
    ProxyPassReverse / http://127.0.0.1:5000/

    ErrorLog ${APACHE_LOG_DIR}/flask-error.log
    CustomLog ${APACHE_LOG_DIR}/flask-access.log combined
</VirtualHost>
