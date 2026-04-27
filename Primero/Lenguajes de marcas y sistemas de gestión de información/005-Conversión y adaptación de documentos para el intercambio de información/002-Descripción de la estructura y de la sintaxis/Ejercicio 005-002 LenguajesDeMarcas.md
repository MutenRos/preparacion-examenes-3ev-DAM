Enunciado paso a paso
Configura tu entorno: Asegúrate de tener instaladas las librerías necesarias para trabajar con MySQL y Flask. Puedes usar Raspberrys y similares para ejecutar este proyecto.

Crea los endpoints: Abre el archivo endpoints.py. Este archivo ya tiene una función que muestra todas las tablas en la base de datos. Tu tarea es crear un segundo endpoint que devuelva los registros de cada tabla en formato JSON.

Añade una nueva ruta /api/data que seleccione todos los registros de cada tabla y los devuelva como un objeto JSON.
Formatea el documento: Abre el archivo formateo el documento.py. Este archivo ya muestra cómo seleccionar todas las tablas y formatear la salida en una lista. Tu tarea es adaptar este código para que funcione con tus endpoints.

Asegúrate de que el formato JSON sea legible y fácil de leer.
Convierte a JSON: Abre el archivo tengo que convertir a json.py. Este archivo ya muestra cómo seleccionar todas las tablas y convertirlas en un objeto JSON. Tu tarea es adaptar este código para que funcione con tus endpoints.

Asegúrate de que el formato JSON sea correcto y no contenga errores.
Verifica tu trabajo: Abre el archivo ver las tablas.py. Ejecuta tu aplicación Flask y verifica que los endpoints estén funcionando correctamente. Puedes usar herramientas como Postman o curl para probar tus endpoints.

Restricciones
No uses librerías externas.
No cambies la estructura de los archivos existentes.
Solo puedes usar los conceptos y tecnologías que se han enseñado en clase.
Criterios de evaluación
Introducción y contextualización (25%): Explica claramente el propósito del ejercicio y cómo los hobbies como jugar con Raspberrys y modelado e impresión 3D pueden aplicarse en esta actividad.

Desarrollo técnico correcto y preciso (25%): Asegúrate de que tus endpoints estén correctamente implementados y que el formato JSON sea legible y correcto.

Aplicación práctica con ejemplo claro (25%): Proporciona ejemplos claros de cómo probar tus endpoints y verifica que el formato JSON es correcto.

Cierre/Conclusión enlazando con la unidad (25%): Responde a las preguntas sobre los hobbies y explique cómo esta actividad ha aplicado conceptos aprendidos en clase.

## SOLUCIÓN

### Introducción y contextualización (25%)

APIs dinámicas exponen tablas MySQL en JSON. Útil en Raspberry Pi para dashboards IoT o paneles de impresoras 3D.

### Desarrollo técnico correcto y preciso (25%)

**endpoints.py:**
```python
from flask import Flask, jsonify
import mysql.connector

app = Flask(__name__)

@app.route('/api/tables')
def get_tables():
    conexion = mysql.connector.connect(
        host="localhost", user="miempresa", 
        password="miempresa", database="miempresa"
    )
    cursor = conexion.cursor()
    cursor.execute("SHOW TABLES")
    tablas = [tabla[0] for tabla in cursor.fetchall()]
    cursor.close()
    conexion.close()
    return jsonify(tablas)

@app.route('/api/data')
def get_data():
    conexion = mysql.connector.connect(
        host="localhost", user="miempresa",
        password="miempresa", database="miempresa"
    )
    cursor = conexion.cursor(dictionary=True)
    cursor.execute("SHOW TABLES")
    tablas = [t[f'Tables_in_miempresa'] for t in cursor.fetchall()]
    
    datos = {}
    for tabla in tablas:
        cursor.execute(f"SELECT * FROM {tabla}")
        datos[tabla] = cursor.fetchall()
    
    cursor.close()
    conexion.close()
    return jsonify(datos)

if __name__ == '__main__':
    app.run(debug=True)
```

**formateo el documento.py:**
```python
import mysql.connector
import json

conexion = mysql.connector.connect(
    host="localhost", user="miempresa",
    password="miempresa", database="miempresa"
)
cursor = conexion.cursor(dictionary=True)
cursor.execute("SHOW TABLES")
tablas = [t[f'Tables_in_miempresa'] for t in cursor.fetchall()]

datos = {}
for tabla in tablas:
    cursor.execute(f"SELECT * FROM {tabla}")
    datos[tabla] = cursor.fetchall()

print(json.dumps(datos, indent=2, ensure_ascii=False))

cursor.close()
conexion.close()
```

**tengo que convertir a json.py:**
```python
import mysql.connector
import json

conexion = mysql.connector.connect(
    host="localhost", user="miempresa",
    password="miempresa", database="miempresa"
)
cursor = conexion.cursor(dictionary=True)
cursor.execute("SHOW TABLES")
tablas = [t[f'Tables_in_miempresa'] for t in cursor.fetchall()]

datos = {}
for tabla in tablas:
    cursor.execute(f"SELECT * FROM {tabla}")
    datos[tabla] = cursor.fetchall()

with open('datos.json', 'w', encoding='utf-8') as f:
    json.dump(datos, f, indent=2, ensure_ascii=False)

print("✓ JSON generado: datos.json")
```

**ver las tablas.py:**
```python
import mysql.connector

conexion = mysql.connector.connect(
    host="localhost", user="miempresa",
    password="miempresa", database="miempresa"
)
cursor = conexion.cursor()
cursor.execute("SHOW TABLES")

for tabla in cursor.fetchall():
    print(f"- {tabla[0]}")

cursor.close()
conexion.close()
```

### Aplicación práctica con ejemplo claro (25%)

**Ejecutar:**
```bash
python endpoints.py
curl http://127.0.0.1:5000/api/data
```

**Respuesta JSON:**
```json
{
  "clientes": [{"id": 1, "nombre": "Dario Lacal"}],
  "pedidos": [{"id": 1, "total": 150.50}]
}
```

### Cierre/Conclusión (25%)

Conversión MySQL → JSON para intercambio de datos. Aplicable en APIs IoT (Raspberry) y sistemas de monitorización remota.