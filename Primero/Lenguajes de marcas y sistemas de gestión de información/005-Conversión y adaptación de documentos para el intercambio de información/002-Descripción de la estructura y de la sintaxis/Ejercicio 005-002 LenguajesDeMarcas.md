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

Crear APIs REST dinámicas permite exponer múltiples tablas de base de datos en formato JSON. Aplicable en Raspberry Pi para dashboards IoT, paneles de control de impresoras 3D, o sistemas de monitorización de sensores.

### Desarrollo técnico correcto y preciso (25%)

**endpoints.py:**
```python
from flask import Flask, jsonify
import mysql.connector

app = Flask(__name__)

def conectar():
    return mysql.connector.connect(
        host="localhost",
        user="miempresa",
        password="miempresa",
        database="miempresa"
    )

@app.route('/api/tables')
def get_tables():
    conexion = conectar()
    cursor = conexion.cursor()
    cursor.execute("SHOW TABLES")
    tablas = [tabla[0] for tabla in cursor.fetchall()]
    cursor.close()
    conexion.close()
    return jsonify(tablas)

@app.route('/api/data')
def get_data():
    conexion = conectar()
    cursor = conexion.cursor(dictionary=True)
    
    # Obtener todas las tablas
    cursor.execute("SHOW TABLES")
    tablas = [tabla[f'Tables_in_miempresa'] for tabla in cursor.fetchall()]
    
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
    host="localhost",
    user="miempresa",
    password="miempresa",
    database="miempresa"
)

cursor = conexion.cursor(dictionary=True)

# Obtener tablas
cursor.execute("SHOW TABLES")
tablas = [t[f'Tables_in_miempresa'] for t in cursor.fetchall()]

datos = {}
for tabla in tablas:
    cursor.execute(f"SELECT * FROM {tabla}")
    datos[tabla] = cursor.fetchall()

# Formatear JSON legible
print(json.dumps(datos, indent=2, ensure_ascii=False))

cursor.close()
conexion.close()
```

**tengo que convertir a json.py:**
```python
import mysql.connector
import json

conexion = mysql.connector.connect(
    host="localhost",
    user="miempresa",
    password="miempresa",
    database="miempresa"
)

cursor = conexion.cursor(dictionary=True)
cursor.execute("SHOW TABLES")
tablas = [t[f'Tables_in_miempresa'] for t in cursor.fetchall()]

datos = {}
for tabla in tablas:
    cursor.execute(f"SELECT * FROM {tabla}")
    datos[tabla] = cursor.fetchall()

# Guardar en archivo JSON
with open('datos.json', 'w', encoding='utf-8') as f:
    json.dump(datos, f, indent=2, ensure_ascii=False)

print("✓ JSON generado: datos.json")

cursor.close()
conexion.close()
```

**ver las tablas.py:**
```python
import mysql.connector

conexion = mysql.connector.connect(
    host="localhost",
    user="miempresa",
    password="miempresa",
    database="miempresa"
)

cursor = conexion.cursor()
cursor.execute("SHOW TABLES")

print("Tablas en la base de datos:")
for tabla in cursor.fetchall():
    print(f"- {tabla[0]}")

cursor.close()
conexion.close()
```

### Aplicación práctica con ejemplo claro (25%)

**Prueba de endpoints:**

```bash
# Ejecutar Flask
python endpoints.py

# Probar endpoints
curl http://127.0.0.1:5000/api/tables
curl http://127.0.0.1:5000/api/data
```

**Respuesta `/api/tables`:**
```json
["clientes", "pedidos", "productos"]
```

**Respuesta `/api/data`:**
```json
{
  "clientes": [
    {
      "id": 1,
      "nombre": "Dario Lacal",
      "email": "dario@example.com"
    }
  ],
  "pedidos": [
    {
      "id": 1,
      "cliente_id": 1,
      "total": 150.50
    }
  ],
  "productos": [
    {
      "id": 1,
      "nombre": "Producto A",
      "precio": 25.99
    }
  ]
}
```

**Archivo generado (datos.json):**
```json
{
  "clientes": [
    {
      "id": 1,
      "nombre": "Dario Lacal",
      "email": "dario@example.com"
    }
  ]
}
```

### Cierre/Conclusión (25%)

Esta actividad demuestra conversión de estructuras relacionales (MySQL) a JSON para intercambio de datos. Aplicable en Raspberry Pi para APIs de sensores IoT, paneles de control de impresoras 3D (temperatura, estado), y sistemas de monitorización remota. El formato JSON facilita integración con cualquier frontend o dispositivo.