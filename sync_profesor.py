"""
Script para sincronizar contenido del profesor sin perder ejercicios resueltos
Descarga ZIP del repositorio y copia solo archivos nuevos de Primero/
"""
import os
import shutil
import urllib.request
import zipfile
import tempfile

# Configuración
REPO_ZIP_URL = "https://github.com/jocarsa/dam2526/archive/refs/heads/main.zip"
CARPETA_OBJETIVO = "Primero"
REPO_LOCAL = r"c:\Users\freak\Desktop\DAM2527\GIT_DAM_25-27"

def descargar_repo_profesor():
    """Descarga el ZIP del repositorio del profesor"""
    temp_dir = tempfile.mkdtemp()
    zip_path = os.path.join(temp_dir, "repo.zip")
    extract_path = os.path.join(temp_dir, "extracted")
    
    print(f"Descargando repositorio del profesor...")
    print(f"URL: {REPO_ZIP_URL}")
    
    try:
        # Descargar ZIP
        urllib.request.urlretrieve(REPO_ZIP_URL, zip_path)
        print(f"✓ Descarga completada: {os.path.getsize(zip_path) / (1024*1024):.2f} MB")
        
        # Extraer ZIP
        print("Extrayendo archivos...")
        os.makedirs(extract_path, exist_ok=True)
        
        with zipfile.ZipFile(zip_path, 'r') as zip_ref:
            # Extraer solo archivos de Primero para ahorrar tiempo
            members = [m for m in zip_ref.namelist() if '/Primero/' in m or m.endswith('Primero/')]
            zip_ref.extractall(extract_path, members=members)
        
        print(f"✓ Extracción completada")
        
        # Buscar carpeta extraída (suele ser repo-main o repo-master)
        extracted_folders = os.listdir(extract_path)
        if extracted_folders:
            repo_folder = os.path.join(extract_path, extracted_folders[0])
            return repo_folder
        else:
            print("Error: No se encontraron carpetas extraídas")
            return None
            
    except Exception as e:
        print(f"Error en descarga/extracción: {e}")
        if os.path.exists(temp_dir):
            shutil.rmtree(temp_dir, ignore_errors=True)
        return None

def copiar_archivos_nuevos(origen, destino):
    """Copia archivos que no existen en destino"""
    archivos_copiados = []
    archivos_omitidos = []
    
    # Recorrer carpeta Primero del profesor
    carpeta_origen = os.path.join(origen, CARPETA_OBJETIVO)
    carpeta_destino = os.path.join(destino, CARPETA_OBJETIVO)
    
    if not os.path.exists(carpeta_origen):
        print(f"No se encontró carpeta {CARPETA_OBJETIVO} en repo profesor")
        return archivos_copiados, archivos_omitidos
    
    for root, dirs, files in os.walk(carpeta_origen):
        # Calcular ruta relativa
        rel_path = os.path.relpath(root, carpeta_origen)
        dest_path = os.path.join(carpeta_destino, rel_path)
        
        # Crear directorio si no existe
        os.makedirs(dest_path, exist_ok=True)
        
        for file in files:
            origen_file = os.path.join(root, file)
            destino_file = os.path.join(dest_path, file)
            
            # Solo copiar si NO existe en destino
            if not os.path.exists(destino_file):
                try:
                    shutil.copy2(origen_file, destino_file)
                    rel_file = os.path.relpath(destino_file, REPO_LOCAL)
                    archivos_copiados.append(rel_file)
                    print(f"✓ Copiado: {rel_file}")
                except Exception as e:
                    archivos_omitidos.append((file, str(e)))
                    print(f"✗ Error copiando {file}: {e}")
            else:
                # Archivo ya existe (probablemente resuelto por ti)
                pass
    
    return archivos_copiados, archivos_omitidos

def main():
    print("=" * 70)
    print("SINCRONIZACIÓN CON REPOSITORIO DEL PROFESOR")
    print("=" * 70)
    print()
    
    # Descargar repo profesor
    temp_dir = descargar_repo_profesor()
    if not temp_dir:
        print("Error: No se pudo descargar el repositorio")
        return
    
    print(f"\n{'=' * 70}")
    print("COPIANDO ARCHIVOS NUEVOS")
    print("=" * 70)
    print()
    
    try:
        # Copiar archivos nuevos
        archivos_copiados, archivos_omitidos = copiar_archivos_nuevos(temp_dir, REPO_LOCAL)
        
        print(f"\n{'=' * 70}")
        print("RESUMEN")
        print("=" * 70)
        print(f"\n✓ Archivos nuevos copiados: {len(archivos_copiados)}")
        
        if archivos_omitidos:
            print(f"✗ Archivos con errores: {len(archivos_omitidos)}")
            for archivo, error in archivos_omitidos[:10]:  # Mostrar primeros 10
                print(f"  - {archivo}: {error}")
        
        if archivos_copiados:
            print("\nARCHIVOS NUEVOS AÑADIDOS:")
            for archivo in archivos_copiados[:20]:  # Mostrar primeros 20
                print(f"  + {archivo}")
            if len(archivos_copiados) > 20:
                print(f"  ... y {len(archivos_copiados) - 20} más")
        else:
            print("\nNo hay archivos nuevos para copiar.")
            print("(Todos los archivos del profesor ya existen en tu repositorio)")
        
    finally:
        # Limpiar carpeta temporal
        print(f"\nLimpiando carpeta temporal...")
        try:
            shutil.rmtree(temp_dir)
            print("✓ Limpieza completada")
        except Exception as e:
            print(f"✗ Error limpiando: {e}")
    
    print("\n" + "=" * 70)
    print("SINCRONIZACIÓN COMPLETADA")
    print("=" * 70)
    print("\nSiguientes pasos:")
    print("1. Revisa los archivos nuevos en tu carpeta Primero/")
    print("2. Si todo está bien, ejecuta:")
    print("   git add Primero/")
    print("   git commit -m 'Añade contenido nuevo del profesor'")
    print("   git push origin main")

if __name__ == "__main__":
    main()
