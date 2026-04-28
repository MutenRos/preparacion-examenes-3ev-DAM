import requests

url = "http://localhost:11434/api/generate"

data = {
    "model": "qwen2.5-coder:7b",
    "prompt": "Ponme un ejemplo de Python",
    "stream": False
}

response = requests.post(url, json=data)

print(response.json()["response"])
