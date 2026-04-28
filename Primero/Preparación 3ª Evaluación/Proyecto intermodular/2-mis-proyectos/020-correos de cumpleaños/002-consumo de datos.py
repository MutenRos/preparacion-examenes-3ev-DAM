import csv
import requests
from io import StringIO

URL = "https://docs.google.com/spreadsheets/d/e/2PACX-1vSpa0iay6LTbzksUx8qel9uPSrfg0UPGDyKfu6k6CI_JlTEPWxR4lgoN9C4I3NmLU5P53GifGRkSorf/pub?output=csv"

def get_csv_as_dict(url):
    response = requests.get(url)
    response.raise_for_status()  # ensure request was successful

    csv_text = response.text
    f = StringIO(csv_text)

    reader = csv.DictReader(f)
    data = list(reader)

    return data

if __name__ == "__main__":
    data = get_csv_as_dict(URL)

    # Print nicely
    for i, row in enumerate(data):
        print(f"\n--- Row {i+1} ---")
        for key, value in row.items():
            print(f"{key}: {value}")
