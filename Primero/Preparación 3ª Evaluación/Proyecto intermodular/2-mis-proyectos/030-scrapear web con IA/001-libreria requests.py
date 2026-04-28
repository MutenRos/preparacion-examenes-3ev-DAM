import requests

url = "https://jocarsa.com"

response = requests.get(url)

print(response.status_code)  # HTTP status (e.g., 200)
print(response.text)         # Raw response content
