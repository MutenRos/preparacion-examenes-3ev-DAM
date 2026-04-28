import csv
import requests
from io import StringIO
from datetime import date, datetime

URL = "https://docs.google.com/spreadsheets/d/e/2PACX-1vSpa0iay6LTbzksUx8qel9uPSrfg0UPGDyKfu6k6CI_JlTEPWxR4lgoN9C4I3NmLU5P53GifGRkSorf/pub?output=csv"

def get_csv_as_dict(url):
    response = requests.get(url)
    response.raise_for_status()

    # Force correct decoding for accented characters
    response.encoding = "utf-8"

    f = StringIO(response.text)
    reader = csv.DictReader(f)
    return list(reader)

def parse_birth_date(text):
    return datetime.strptime(text, "%Y-%m-%d").date()

def is_birthday_today(birth_date, today):
    return birth_date.day == today.day and birth_date.month == today.month

def years_old_today(birth_date, today):
    return today.year - birth_date.year

if __name__ == "__main__":
    data = get_csv_as_dict(URL)
    today = date.today()

    found_any = False

    for row in data:
        name = row["Name"]
        surnames = row["Surnames"]
        birth_date = parse_birth_date(row["Birth Date"])
        email = row["Email"]

        if is_birthday_today(birth_date, today):
            age = years_old_today(birth_date, today)
            found_any = True
            print(f"Today is the birthday of {name} {surnames}")
            print(f"Email: {email}")
            print(f"Turns: {age} years old")
            print("-" * 40)

    if not found_any:
        print("Today nobody has a birthday.")
