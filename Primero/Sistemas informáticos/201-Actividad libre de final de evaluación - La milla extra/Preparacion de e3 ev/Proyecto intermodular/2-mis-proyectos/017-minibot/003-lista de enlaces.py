import requests
from bs4 import BeautifulSoup
from urllib.parse import urljoin

url = "https://josevicentecarratala.com"

response = requests.get(url)
soup = BeautifulSoup(response.text, "html.parser")

links = []

for a in soup.find_all("a", href=True):
    href = a["href"]
    
    # Convert relative URLs to absolute
    full_url = urljoin(url, href)
    
    links.append(full_url)

# Remove duplicates
links = list(set(links))

# Print results
for link in links:
    print(link)
