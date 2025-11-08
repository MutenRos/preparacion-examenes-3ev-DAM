"""
Script para crear la base de datos y la tabla necesaria
Ejecutar este script antes de usar insertar.py
"""
import sqlite3

# Conectar a la base de datos (se crea si no existe)
conn = sqlite3.connect("discos.db")
cursor = conn.cursor()

# Leer el script SQL
with open("archivos.sql", "r", encoding="utf-8") as f:
    sql_script = f.read()

# Ejecutar el script
cursor.executescript(sql_script)

print("✓ Base de datos 'discos.db' creada correctamente")
print("✓ Tabla 'archivos' creada correctamente")

# Verificar que la tabla existe
cursor.execute("SELECT name FROM sqlite_master WHERE type='table' AND name='archivos'")
resultado = cursor.fetchone()

if resultado:
    print(f"✓ Verificado: Tabla '{resultado[0]}' existe en la base de datos")
else:
    print("✗ Error: La tabla no fue creada")

conn.close()
