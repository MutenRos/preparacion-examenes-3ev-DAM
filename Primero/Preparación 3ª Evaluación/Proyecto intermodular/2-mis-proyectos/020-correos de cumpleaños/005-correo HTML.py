#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import csv
import os
import smtplib
import ssl
from io import StringIO
from email.message import EmailMessage
from datetime import date, datetime

import requests

URL = "https://docs.google.com/spreadsheets/d/e/2PACX-1vSpa0iay6LTbzksUx8qel9uPSrfg0UPGDyKfu6k6CI_JlTEPWxR4lgoN9C4I3NmLU5P53GifGRkSorf/pub?output=csv"


def get_csv_as_dict(url):
    response = requests.get(url, timeout=30)
    response.raise_for_status()
    response.encoding = "utf-8"
    f = StringIO(response.text)
    reader = csv.DictReader(f)
    return list(reader)


def parse_birth_date(text):
    return datetime.strptime(text.strip(), "%Y-%m-%d").date()


def is_birthday_today(birth_date, today):
    return birth_date.day == today.day and birth_date.month == today.month


def years_old_today(birth_date, today):
    age = today.year - birth_date.year
    if (today.month, today.day) < (birth_date.month, birth_date.day):
        age -= 1
    return age


def get_env(name, required=True, default=None):
    value = os.environ.get(name, default)
    if required and not value:
        raise RuntimeError(f"Missing required environment variable: {name}")
    return value


def build_birthday_message(from_email, to_email, name, surnames, age):
    msg = EmailMessage()
    msg["From"] = from_email
    msg["To"] = to_email
    msg["Subject"] = f"¡Feliz cumpleaños, {name}!"

    texto_plano = f"""Hola {name} {surnames},

¡Feliz cumpleaños!

Hoy cumples {age} años y queremos desearte un día maravilloso, lleno de alegría, tranquilidad y buenos momentos.

Esperamos que disfrutes mucho de tu día y que este nuevo año de vida venga acompañado de salud, ilusión y muchos éxitos.

Un cordial saludo.
"""

    html = f"""\
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Feliz cumpleaños</title>
</head>
<body style="margin:0;padding:0;background-color:#f4f6fb;font-family:Arial,Helvetica,sans-serif;color:#1f2937;">
  <table role="presentation" style="width:100%;border-collapse:collapse;background-color:#f4f6fb;" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center" style="padding:40px 20px;">
        <table role="presentation" style="width:100%;max-width:640px;border-collapse:collapse;background-color:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 8px 30px rgba(0,0,0,0.08);" cellpadding="0" cellspacing="0">
          
          <tr>
            <td style="background:linear-gradient(135deg,#4f46e5,#7c3aed);padding:40px 30px;text-align:center;">
              <div style="font-size:48px;line-height:1;margin-bottom:10px;">🎉</div>
              <h1 style="margin:0;color:#ffffff;font-size:32px;line-height:1.2;font-weight:bold;">
                ¡Feliz cumpleaños!
              </h1>
            </td>
          </tr>

          <tr>
            <td style="padding:40px 30px 20px 30px;">
              <p style="margin:0 0 20px 0;font-size:18px;line-height:1.6;">
                Hola <strong>{name} {surnames}</strong>,
              </p>

              <p style="margin:0 0 20px 0;font-size:16px;line-height:1.8;color:#374151;">
                Hoy es un día especial, porque cumples <strong>{age} años</strong>.
              </p>

              <p style="margin:0 0 20px 0;font-size:16px;line-height:1.8;color:#374151;">
                Queremos enviarte nuestra felicitación y desearte una jornada llena de alegría, buenos momentos y personas importantes a tu alrededor.
              </p>

              <p style="margin:0 0 30px 0;font-size:16px;line-height:1.8;color:#374151;">
                Esperamos que este nuevo año de vida llegue cargado de salud, ilusión, energía y muchos éxitos.
              </p>

              <table role="presentation" style="width:100%;border-collapse:collapse;margin:0 0 30px 0;" cellpadding="0" cellspacing="0">
                <tr>
                  <td style="background-color:#eef2ff;border:1px solid #c7d2fe;border-radius:12px;padding:20px;text-align:center;">
                    <div style="font-size:14px;color:#6366f1;letter-spacing:1px;text-transform:uppercase;margin-bottom:8px;">
                      Hoy celebramos
                    </div>
                    <div style="font-size:28px;font-weight:bold;color:#312e81;">
                      {name}
                    </div>
                    <div style="font-size:18px;color:#4338ca;margin-top:6px;">
                      {age} años
                    </div>
                  </td>
                </tr>
              </table>

              <p style="margin:0;font-size:16px;line-height:1.8;color:#374151;">
                Recibe un cordial saludo y nuestros mejores deseos.
              </p>
            </td>
          </tr>

          <tr>
            <td style="padding:20px 30px 40px 30px;">
              <p style="margin:0;font-size:14px;line-height:1.6;color:#6b7280;text-align:center;">
                Este mensaje ha sido enviado con motivo de tu cumpleaños.
              </p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>
"""

    msg.set_content(texto_plano)
    msg.add_alternative(html, subtype="html")
    return msg


def send_email_smtp(message):
    smtp_host = get_env("SMTP_HOST")
    smtp_port = int(get_env("SMTP_PORT"))
    smtp_user = get_env("SMTP_USER")
    smtp_password = get_env("SMTP_PASSWORD")
    smtp_security = get_env("SMTP_SECURITY", required=False, default="starttls").lower()

    if smtp_security == "ssl":
        context = ssl.create_default_context()
        with smtplib.SMTP_SSL(smtp_host, smtp_port, context=context, timeout=30) as server:
            server.login(smtp_user, smtp_password)
            server.send_message(message)
    else:
        with smtplib.SMTP(smtp_host, smtp_port, timeout=30) as server:
            server.set_debuglevel(1)  # útil para ver el diálogo SMTP
            server.ehlo()

            if smtp_security == "starttls":
                context = ssl.create_default_context()
                server.starttls(context=context)
                server.ehlo()

            server.login(smtp_user, smtp_password)
            server.send_message(message)


if __name__ == "__main__":
    data = get_csv_as_dict(URL)
    today = date.today()

    smtp_from = get_env("SMTP_FROM", required=False, default=os.environ.get("SMTP_USER"))
    found_any = False

    for row in data:
        try:
            name = row["Name"].strip()
            surnames = row["Surnames"].strip()
            birth_date = parse_birth_date(row["Birth Date"])
            email = row["Email"].strip()

            if is_birthday_today(birth_date, today):
                age = years_old_today(birth_date, today)
                found_any = True

                print(f"Today is the birthday of {name} {surnames}")
                print(f"Email: {email}")
                print(f"Turns: {age} years old")

                msg = build_birthday_message(
                    from_email=smtp_from,
                    to_email=email,
                    name=name,
                    surnames=surnames,
                    age=age
                )

                send_email_smtp(msg)

                print("Email sent successfully.")
                print("-" * 40)

        except Exception as e:
            print(f"Error processing row {row}: {e}")
            print("-" * 40)

    if not found_any:
        print("Today nobody has a birthday.")
