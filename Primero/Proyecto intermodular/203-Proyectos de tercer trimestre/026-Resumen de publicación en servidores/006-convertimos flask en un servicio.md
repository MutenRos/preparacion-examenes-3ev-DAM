pip install gunicorn

nuevo archivo flask:
from flask import Flask
from werkzeug.middleware.proxy_fix import ProxyFix

app = Flask(__name__)
app.wsgi_app = ProxyFix(app.wsgi_app, x_for=1, x_proto=1, x_host=1)

@app.route("/")
def home():
    return "Hello from Flask with SSL"
    
creamos un servicio:
sudo nano /etc/systemd/system/flask-jocarsa.service

rellenamos el servicio:
[Unit]
Description=Flask app for flask.jocarsa.com
After=network.target

[Service]
User=www-data
Group=www-data
WorkingDirectory=/home/miniservidor/
Environment="PATH=/home/miniservidor/venv/bin"
ExecStart=/home/miniservidor/venv/bin/gunicorn --workers 2 --bind 127.0.0.1:5000 app:app
Restart=always
RestartSec=3

[Install]
WantedBy=multi-user.target

Y activamos el servicio:
sudo systemctl daemon-reload
sudo systemctl enable flask-jocarsa
sudo systemctl start flask-jocarsa
