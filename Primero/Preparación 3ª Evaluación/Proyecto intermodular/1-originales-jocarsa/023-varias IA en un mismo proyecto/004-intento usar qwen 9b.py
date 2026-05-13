import requests

url = "http://localhost:11434/api/generate"

data = {
    "model": "qwen3.5:9b",
    "prompt": "Explicame qué es Python",
    "stream": False
}

response = requests.post(url, json=data)

print(response.json()["response"])
