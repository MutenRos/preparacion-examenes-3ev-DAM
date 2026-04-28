import requests

url = "http://localhost:11434/api/generate"

data = {
    "model": "qwen2.5:3b-instruct",
    "prompt": "Explica qué es Python en una frase.",
    "stream": False
}

response = requests.post(url, json=data)

print(response.json()["response"])
