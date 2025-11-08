# Indexador de Archivos - Guía de Uso

## 📋 Descripción
Aplicación con interfaz gráfica (Tkinter) para indexar archivos de una carpeta y guardar su información en una base de datos SQLite. Ideal para gestionar archivos de modelado 3D, STL, proyectos de impresión, etc.

## 🚀 Pasos para probar el ejercicio

### 1. Crear la base de datos
Primero ejecuta el script para crear la tabla:

```bash
python crear_tabla.py
```

Deberías ver:
```
✓ Base de datos 'discos.db' creada correctamente
✓ Tabla 'archivos' creada correctamente
✓ Verificado: Tabla 'archivos' existe en la base de datos
```

### 2. Ejecutar el indexador
Lanza la aplicación gráfica:

```bash
python insertar.py
```

Se abrirá una ventana con:
- Campo "Carpeta a indexar": Ingresa la ruta de la carpeta (ej: `C:\Users\freak\Desktop\DAM2527\GIT_DAM_25-27\Primero`)
- Campo "Nombre del disco": Ingresa un nombre descriptivo (ej: `Ejercicios_Primero`)
- Botón "Procesar": Click para indexar

### 3. Verificar los resultados
Consulta los archivos indexados:

```bash
python consultar.py
```

Verás un listado detallado con:
- Identificador de cada archivo
- Nombre y ruta completa
- Tamaño (en B, KB, MB o GB)
- Fechas de creación y modificación
- Estadísticas por disco

## 📁 Archivos del proyecto

- `archivos.sql` - Script SQL para crear la tabla
- `crear_tabla.py` - Crea la base de datos y ejecuta el SQL
- `insertar.py` - Aplicación principal con interfaz gráfica
- `consultar.py` - Consulta y muestra los archivos indexados
- `discos.db` - Base de datos SQLite (se genera automáticamente)

## ✅ Validaciones implementadas

- ✓ Campos obligatorios (carpeta y disco)
- ✓ Verificación de que la carpeta existe
- ✓ Manejo de excepciones para archivos que no se pueden leer
- ✓ Manejo de errores de base de datos
- ✓ Contador de archivos indexados
- ✓ Limpieza de campos tras indexación exitosa

## 🔧 Ejemplo de uso práctico

### Para indexar archivos STL de impresión 3D:
1. Carpeta: `D:\Modelos3D\Pokemon`
2. Disco: `Modelos_Pokemon_STL`
3. Procesar

### Para indexar proyectos de Raspberry Pi:
1. Carpeta: `C:\Proyectos\RaspberryPi`
2. Disco: `Proyectos_RPi_2025`
3. Procesar

## 🐛 Solución de problemas

**Error: "La carpeta especificada no existe"**
- Verifica que la ruta sea correcta
- En Windows usa barras invertidas `\` o dobles barras `\\`
- O usa barras normales `/` que funcionan en Windows también

**Error de base de datos**
- Asegúrate de ejecutar primero `crear_tabla.py`
- Verifica que `discos.db` exista en la misma carpeta

**No aparece la ventana**
- Verifica que tkinter esté instalado (viene con Python por defecto)
- En Linux puede necesitar: `sudo apt-get install python3-tk`

## 📊 Mejoras futuras posibles

- Añadir barra de progreso durante la indexación
- Filtrar por extensiones de archivo (solo .stl, .gcode, etc.)
- Búsqueda de archivos por nombre
- Exportar listado a CSV
- Interfaz para ver archivos indexados sin usar script aparte
