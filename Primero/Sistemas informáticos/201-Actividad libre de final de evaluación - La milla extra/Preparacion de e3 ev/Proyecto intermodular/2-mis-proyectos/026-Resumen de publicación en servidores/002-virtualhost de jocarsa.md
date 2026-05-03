<VirtualHost *:443>
    ServerAdmin info@jocarsa.com
    ServerName jocarsa.com
    ServerAlias www.jocarsa.com

    DocumentRoot /var/www/html/jocarsa

    # --- SMTP env for PHP (contact form) ---
    SetEnv SMTP_USER 
    SetEnv 
    SetEnv SMTP_HOST
    SetEnv SMTP_PORT 

    SSLEngine on
    SSLCertificateFile /etc/apache2/ssl/jocarsa_combined.cer
    SSLCertificateKeyFile /etc/apache2/ssl/jocarsa.key 

    <Directory /var/www/html/jocarsa>
        Options FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ProxyPass        /socket  ws://127.0.0.1:8765/
    ProxyPassReverse /socket  ws://127.0.0.1:8765/
    ProxyTimeout 120
    RequestHeader unset Sec-WebSocket-Extensions early

    <IfModule mod_headers.c>
        Header always set Content-Security-Policy "\
      default-src 'self'; \
      style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://jocarsa.github.io https://static.jocarsa.com; \
      font-src 'self' https://fonts.gstatic.com; \
      script-src 'self' 'unsafe-inline' 'unsafe-eval' https://jocarsa.github.io; \
      connect-src 'self' wss://jocarsa.com https://ghostwhite.jocarsa.com; \
      img-src 'self' https://static.jocarsa.com https://capitolempresa.com;"
      </IfModule>

    ScriptAlias /cgi-bin/ /var/www/html/cgi-bin/
    <Directory "/var/www/html/cgi-bin">
        AllowOverride None
        Options +ExecCGI -MultiViews +SymLinksIfOwnerMatch
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/jocarsa-error.log
    CustomLog ${APACHE_LOG_DIR}/jocarsa-access.log combined
</VirtualHost>
