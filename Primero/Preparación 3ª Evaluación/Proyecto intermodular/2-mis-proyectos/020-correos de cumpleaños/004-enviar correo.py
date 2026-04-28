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
    msg["Subject"] = f"Happy Birthday, {name}!"

    body = f"""Hello {name} {surnames},

Happy birthday!

Today you turn {age} years old.
We hope you have a wonderful day.

Best regards
"""
    msg.set_content(body)
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
