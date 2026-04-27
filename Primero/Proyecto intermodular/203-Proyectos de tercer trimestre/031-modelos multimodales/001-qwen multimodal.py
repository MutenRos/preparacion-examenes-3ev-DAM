import os
from ollama import chat

# Ruta al directorio del script
base_dir = os.path.dirname(os.path.abspath(__file__))

# Construir ruta completa
ruta_imagen = os.path.join(base_dir, 'foto.jpg')

respuesta = chat(
    model='qwen3.5:4b',
    messages=[
        {
            'role': 'user',
            'content': '¿Qué ves en esta imagen? Responde en español.',
            'images': [ruta_imagen]
        }
    ]
)

print(respuesta['message']['content'])
