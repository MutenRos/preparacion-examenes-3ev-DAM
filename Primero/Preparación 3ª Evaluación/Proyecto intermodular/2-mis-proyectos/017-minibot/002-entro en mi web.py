import requests

url = "https://jocarsa.com"

response = requests.get(url)

# Check status
print("Status code:", response.status_code)

# Print raw HTML content
print(response.text)
