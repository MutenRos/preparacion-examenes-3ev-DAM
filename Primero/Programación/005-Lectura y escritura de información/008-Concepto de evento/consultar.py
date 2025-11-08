"""
Script para consultar los archivos indexados en la base de datos
Útil para verificar que el indexador funcionó correctamente
"""
import sqlite3
from datetime import datetime

# Conectar a la base de datos
conn = sqlite3.connect("discos.db")
cursor = conn.cursor()

# Consultar todos los archivos
cursor.execute("SELECT * FROM archivos ORDER BY disco, ruta, archivo")
archivos = cursor.fetchall()

if not archivos:
    print("No hay archivos indexados en la base de datos")
else:
    print(f"\n{'='*100}")
    print(f"ARCHIVOS INDEXADOS - Total: {len(archivos)}")
    print(f"{'='*100}\n")
    
    disco_actual = None
    
    for archivo in archivos:
        id_archivo, disco, ruta, nombre, tamanio, creacion, modificacion = archivo
        
        # Imprimir encabezado de disco si cambia
        if disco != disco_actual:
            print(f"\n📀 DISCO: {disco}")
            print("-" * 100)
            disco_actual = disco
        
        # Convertir timestamps a fechas legibles
        fecha_creacion = datetime.fromtimestamp(creacion).strftime('%d/%m/%Y %H:%M:%S')
        fecha_modificacion = datetime.fromtimestamp(modificacion).strftime('%d/%m/%Y %H:%M:%S')
        
        # Convertir tamaño a formato legible
        if tamanio < 1024:
            tamanio_str = f"{tamanio} B"
        elif tamanio < 1024**2:
            tamanio_str = f"{tamanio/1024:.2f} KB"
        elif tamanio < 1024**3:
            tamanio_str = f"{tamanio/(1024**2):.2f} MB"
        else:
            tamanio_str = f"{tamanio/(1024**3):.2f} GB"
        
        print(f"  [{id_archivo:3d}] {nombre}")
        print(f"        Ruta: {ruta}")
        print(f"        Tamaño: {tamanio_str:>10} | Creado: {fecha_creacion} | Modificado: {fecha_modificacion}")
        print()

# Estadísticas por disco
print(f"\n{'='*100}")
print("ESTADÍSTICAS POR DISCO")
print(f"{'='*100}\n")

cursor.execute("""
    SELECT 
        disco,
        COUNT(*) as total_archivos,
        SUM(tamanio) as espacio_total
    FROM archivos
    GROUP BY disco
    ORDER BY disco
""")

estadisticas = cursor.fetchall()

for stat in estadisticas:
    disco, total, espacio = stat
    
    # Convertir espacio a formato legible
    if espacio < 1024**2:
        espacio_str = f"{espacio/1024:.2f} KB"
    elif espacio < 1024**3:
        espacio_str = f"{espacio/(1024**2):.2f} MB"
    else:
        espacio_str = f"{espacio/(1024**3):.2f} GB"
    
    print(f"  📀 {disco}: {total} archivos, {espacio_str}")

conn.close()
