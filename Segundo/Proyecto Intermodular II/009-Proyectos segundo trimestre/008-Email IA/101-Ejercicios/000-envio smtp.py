import smtplib
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart

# Configuración del servidor SMTP
SMTP_SERVER = "smtp.ionos.es"
SMTP_PORT = 587  # 465 si usas SSL directo
SMTP_USER = "python@jocarsa.com"
SMTP_PASSWORD = "TAME123$"

# Mensaje
remitente = "python@jocarsa.com"
destinatario = "jocarsa2@gmail.com"
asunto = "Correo enviado desde Python"
cuerpo = "Hola,\n\nEste correo lo he enviado con Python 😄\n\nSaludos!"

# Crear mensaje MIME
mensaje = MIMEMultipart()
mensaje["From"] = remitente
mensaje["To"] = destinatario
mensaje["Subject"] = asunto
mensaje.attach(MIMEText(cuerpo, "plain"))

# Enviar
try:
    server = smtplib.SMTP(SMTP_SERVER, SMTP_PORT)
    server.starttls()  # Si el servidor requiere TLS
    server.login(SMTP_USER, SMTP_PASSWORD)
    server.sendmail(remitente, destinatario, mensaje.as_string())
    server.quit()
    print("Correo enviado con éxito ✨")
except Exception as e:
    print("Error enviando el correo:", e)

