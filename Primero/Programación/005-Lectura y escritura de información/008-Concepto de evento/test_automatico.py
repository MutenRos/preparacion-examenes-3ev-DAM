"""
Script de prueba automática para el indexador de archivos
Simula la indexación sin usar la interfaz gráfica
"""
import sqlite3
import os

# Datos de prueba
carpeta_prueba = r"c:\Users\freak\Desktop\DAM2527\GIT_DAM_25-27\Primero\Programación\005-Lectura y escritura de información\008-Concepto de evento\carpeta_prueba"
nombre_disco = "Disco_Prueba_3D"

print("="*80)
print("PRUEBA AUTOMÁTICA DEL INDEXADOR")
print("="*80)

# Verificar que la carpeta existe
if not os.path.exists(carpeta_prueba):
    print(f"\n✗ Error: La carpeta '{carpeta_prueba}' no existe")
    exit(1)

print(f"\n✓ Carpeta de prueba encontrada: {carpeta_prueba}")

# Conectar a la base de datos
try:
    conn = sqlite3.connect("discos.db")
    cursor = conn.cursor()
    print("✓ Conectado a la base de datos")
except Exception as e:
    print(f"✗ Error al conectar: {e}")
    exit(1)

# Contar archivos antes
cursor.execute("SELECT COUNT(*) FROM archivos WHERE disco = ?", (nombre_disco,))
antes = cursor.fetchone()[0]
print(f"\n📊 Archivos en '{nombre_disco}' antes de indexar: {antes}")

# Indexar archivos
archivos_indexados = 0
errores = 0

print(f"\n🔄 Indexando archivos...")

for root, dirs, files in os.walk(carpeta_prueba):
    for file in files:
        try:
            ruta_completa = os.path.join(root, file)
            tamanio = os.path.getsize(ruta_completa)
            creacion = int(os.path.getctime(ruta_completa))
            modificacion = int(os.path.getmtime(ruta_completa))
            
            cursor.execute("""
                INSERT INTO archivos (disco, ruta, archivo, tamanio, creacion, modificacion)
                VALUES (?, ?, ?, ?, ?, ?)
            """, (nombre_disco, root, file, tamanio, creacion, modificacion))
            
            archivos_indexados += 1
            print(f"  ✓ {file} ({tamanio} bytes)")
            
        except Exception as e:
            errores += 1
            print(f"  ✗ Error con {file}: {e}")

# Guardar cambios
conn.commit()

# Contar archivos después
cursor.execute("SELECT COUNT(*) FROM archivos WHERE disco = ?", (nombre_disco,))
despues = cursor.fetchone()[0]

print(f"\n{'='*80}")
print("RESULTADOS")
print(f"{'='*80}")
print(f"✓ Archivos indexados: {archivos_indexados}")
print(f"✗ Errores: {errores}")
print(f"📊 Total en BD ahora: {despues}")
print(f"📈 Nuevos registros añadidos: {despues - antes}")

# Mostrar estadísticas
cursor.execute("""
    SELECT 
        COUNT(*) as total,
        SUM(tamanio) as espacio,
        MIN(creacion) as mas_antiguo,
        MAX(modificacion) as mas_reciente
    FROM archivos 
    WHERE disco = ?
""", (nombre_disco,))

stats = cursor.fetchone()
total, espacio, antiguo, reciente = stats

print(f"\n{'='*80}")
print(f"ESTADÍSTICAS DE '{nombre_disco}'")
print(f"{'='*80}")
print(f"Total archivos: {total}")
print(f"Espacio total: {espacio:,} bytes ({espacio/1024:.2f} KB)")

from datetime import datetime
print(f"Archivo más antiguo: {datetime.fromtimestamp(antiguo).strftime('%d/%m/%Y %H:%M:%S')}")
print(f"Última modificación: {datetime.fromtimestamp(reciente).strftime('%d/%m/%Y %H:%M:%S')}")

# Mostrar algunos archivos indexados
print(f"\n{'='*80}")
print("MUESTRA DE ARCHIVOS INDEXADOS")
print(f"{'='*80}")

cursor.execute("""
    SELECT archivo, tamanio, ruta
    FROM archivos
    WHERE disco = ?
    LIMIT 5
""", (nombre_disco,))

for archivo, tam, ruta in cursor.fetchall():
    print(f"  📄 {archivo}")
    print(f"     Tamaño: {tam:,} bytes")
    print(f"     Ruta: {ruta}")
    print()

conn.close()
print("\n✓ Prueba completada exitosamente!")
