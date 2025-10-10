**Big Data** es el conjunto de datos `tan grande y complejo` que exige técnicas y herramientas específicas para **capturar, almacenar, procesar y analizar** la información de forma eficiente. Se entiende muy bien con las **3V**:
- **Volumen**: cantidades masivas de datos.
- **Velocidad**: ritmo al que se generan y deben procesarse.
- **Variedad**: múltiples formatos (sensores, logs, texto, etc.).

Con una `Raspberry Pi` puedo recoger muestras (por ejemplo, tráfico en mi pueblo) y luego agregarlas para detectar patrones.
---
A continuación creo la tabla **`datos_tráfico`** e inserto registros de ejemplo:

```sql
-- Esquema (SQLite)
CREATE TABLE "datos_tráfico" (
  id               INTEGER PRIMARY KEY,
  hora             TEXT,
  velocidad_media  REAL,
  numero_vehiculos INTEGER
);

````plaintext
**Big Data** es el conjunto de datos tan voluminoso y complejo que exige técnicas y herramientas específicas para capturar, almacenar, procesar y analizar la información de forma eficiente. En el contexto del curso conviene relacionarlo con la **inteligencia de negocio (BI)** y con el uso de algoritmos de análisis e IA para extraer conocimiento.

Conceptos clave:
- 3V: **Volumen**, **Velocidad** y **Variedad**.
- También se consideran a veces 4V/5V: Veracidad, Valor (y otras características relacionadas con la calidad y gobernanza de los datos).

Relación con IA y BI:
- Big Data proporciona los conjuntos de datos necesarios para entrenar modelos de IA y para alimentar cuadros de mando de BI.
- La inteligencia de negocio usa los resultados del análisis (KPIs, tendencias, segmentaciones) para la toma de decisiones.

Ejemplo práctico con dispositivos locales:
- Con una `Raspberry Pi` podemos recoger registros (sensores, contadores, logs) y luego agregar esa información en un almacén local o en la nube para su análisis posterior.

Casos de uso comunes:
- Monitorización de tráfico (sensores en carreteras), análisis de logs web, análisis de ventas por tienda, detección de anomalías en datos de sensores.

Herramientas del ecosistema (visión general):
- Sistemas distribuidos: Hadoop (HDFS, MapReduce), Spark (procesamiento en memoria), Flink.
- Almacenes: Data Lakes (S3, HDFS), almacenes columnar (Parquet), bases de datos NoSQL (Cassandra, MongoDB) para ciertos casos.

A continuación se muestra un ejemplo didáctico — esquema y datos de tráfico — y un código Python mínimo para calcular resúmenes por hora.

-- Esquema y datos de ejemplo (SQLite)

```sql
CREATE TABLE datos_trafico (
  id               INTEGER PRIMARY KEY,
  hora             TEXT,
  velocidad_media  REAL,
  numero_vehiculos INTEGER
);

INSERT INTO datos_trafico (id, hora, velocidad_media, numero_vehiculos) VALUES
  (1, '08:00', 30.5, 200),
  (2, '08:00', 28.0, 180),
  (3, '09:00', 35.2, 220),
  (4, '09:00', 33.8, 210),
  (5, '10:00', 40.0, 150),
  (6, '09:00', 36.0, 230),
  (7, '08:00', 29.5, 190);
```

```python
# Ejemplo de análisis mínimo en Python (SQLite en memoria)
import sqlite3

def main():
    conn = sqlite3.connect(':memory:')
    cur = conn.cursor()

    # Crear tabla y cargar datos
    cur.executescript('''
    CREATE TABLE datos_trafico (
      id               INTEGER PRIMARY KEY,
      hora             TEXT,
      velocidad_media  REAL,
      numero_vehiculos INTEGER
    );

    INSERT INTO datos_trafico (id, hora, velocidad_media, numero_vehiculos) VALUES
      (1, '08:00', 30.5, 200),
      (2, '08:00', 28.0, 180),
      (3, '09:00', 35.2, 220),
      (4, '09:00', 33.8, 210),
      (5, '10:00', 40.0, 150),
      (6, '09:00', 36.0, 230),
      (7, '08:00', 29.5, 190);
    ''')

    # Resumen por hora: media de velocidad y suma de vehículos
    cur.execute('''
    SELECT
      hora,
      ROUND(AVG(velocidad_media),2) AS velocidad_media_promedio,
      SUM(numero_vehiculos) AS total_vehiculos
    FROM datos_trafico
    GROUP BY hora
    ORDER BY hora;
    ''')

    resumen = cur.fetchall()
    print('Resumen por hora: (hora, velocidad_media_promedio, total_vehiculos)')
    for fila in resumen:
        print(fila)

    # Hora punta (la que tiene más vehículos)
    cur.execute('''
    SELECT hora, SUM(numero_vehiculos) AS total_vehiculos
    FROM datos_trafico
    GROUP BY hora
    ORDER BY total_vehiculos DESC
    LIMIT 1;
    ''')
    hora_punta = cur.fetchone()
    print('\nHora punta:', hora_punta)

    conn.close()

if __name__ == '__main__':
    main()
```

Notas pedagógicas:
- El ejemplo anterior es didáctico: en Big Data real no se usa SQLite en memoria, sino almacenes distribuidos y frameworks de procesamiento paralelo (Spark, Flink).
- Antes de ejecutar análisis sobre datos reales, hay que considerar privacidad, anonimización y cumplimiento de la normativa (p. ej. RGPD cuando corresponda).


````
