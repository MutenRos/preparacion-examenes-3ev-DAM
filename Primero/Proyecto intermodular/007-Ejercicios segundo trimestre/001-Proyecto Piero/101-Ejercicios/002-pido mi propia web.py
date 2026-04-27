import requests

url = "https://jocarsa.com"

response = requests.get(url)

# si quieres ver el código de estado
print("Status:", response.status_code)

# y aquí tienes el HTML completito
html = response.text
print(html)

