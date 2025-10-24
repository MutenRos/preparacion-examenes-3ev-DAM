import os
import sys

# Función para leer una tecla sin esperar Enter
def leer_tecla():
    if os.name == 'nt':  # Windows
        import msvcrt
        tecla = msvcrt.getch()
        if tecla == b'\xe0':  # Tecla especial (flechas)
            tecla = msvcrt.getch()
            if tecla == b'H':  # Flecha arriba
                return 'arriba'
            elif tecla == b'P':  # Flecha abajo
                return 'abajo'
        elif tecla == b'\r':  # Enter
            return 'enter'
    else:  # Linux/Mac
        import tty
        import termios
        fd = sys.stdin.fileno()
        old_settings = termios.tcgetattr(fd)
        try:
            tty.setraw(sys.stdin.fileno())
            tecla = sys.stdin.read(1)
            if tecla == '\x1b':  # ESC (inicio de secuencia)
                tecla += sys.stdin.read(2)
                if tecla == '\x1b[A':
                    return 'arriba'
                elif tecla == '\x1b[B':
                    return 'abajo'
            elif tecla == '\r':
                return 'enter'
        finally:
            termios.tcsetattr(fd, termios.TCSADRAIN, old_settings)
    return None

# Obtener el tamaño del terminal
ancho_terminal = os.get_terminal_size().columns

# Función para centrar texto
def centrar_texto(texto):
    return texto.center(ancho_terminal)
# Obtener el directorio donde está este script
directorio_actual = os.path.dirname(os.path.abspath(__file__))
def enviar_a_impresora(tarea):
    print(f"Enviando a la impresora el proyecto '{tarea['proyecto']['nombre']}' usando material '{tarea['material']['material']}'")
def leer_proyectos(ruta):
    proyectos = []
    with open(ruta, 'r') as archivo:
        contenido = archivo.read().strip().split('\n\n')
        for proyecto in contenido:
            lineas = proyecto.split('\n')
            info = {
                'nombre': lineas[0].split(': ')[1],
                'fecha': lineas[1].split(': ')[1],
                'descripcion': lineas[2].split(': ')[1],
                'ID': lineas[3].split(': ')[1]
            }
            proyectos.append(info)
    return proyectos
def leer_materiales(ruta):
    materiales = []
    with open(ruta, 'r') as archivo:
        contenido = archivo.read().strip().split('\n\n')
        for material in contenido:
            lineas = material.split('\n')
            info = {
                'material': lineas[0].split(': ')[1],
                'cantidad': lineas[1].split(': ')[1],
                'notas': lineas[2].split(': ')[1],
                'ID': lineas[3].split(': ')[1]
            }
            materiales.append(info)
    return materiales
proyectos = leer_proyectos(os.path.join(directorio_actual, 'proyectos_3d', 'resumen_proyectos.txt'))
materiales = leer_materiales(os.path.join(directorio_actual, 'proyectos_3d', 'materiales.txt'))

print(centrar_texto("Bienvenido al sistema de impresión 3D"))
print()

# Función para mostrar menú con selección por flechas
def menu_interactivo(titulo, opciones):
    seleccion = 0
    while True:
        # Limpiar pantalla
        os.system('cls' if os.name == 'nt' else 'clear')
        
        print(centrar_texto("=== " + titulo + " ==="))
        print()
        print(centrar_texto("Usa las flechas ↑↓ para navegar y Enter para seleccionar"))
        print()
        
        # Mostrar opciones
        for i, opcion in enumerate(opciones):
            if i == seleccion:
                print(centrar_texto(f">>> {opcion} <<<"))
            else:
                print(centrar_texto(f"    {opcion}    "))
        
        # Leer tecla
        tecla = leer_tecla()
        
        if tecla == 'arriba':
            seleccion = (seleccion - 1) % len(opciones)
        elif tecla == 'abajo':
            seleccion = (seleccion + 1) % len(opciones)
        elif tecla == 'enter':
            return seleccion

# Seleccionar proyecto con menú interactivo
opciones_proyectos = [proyecto['nombre'] for proyecto in proyectos]
opcion_proyecto = menu_interactivo("SELECCIONA UN PROYECTO", opciones_proyectos)

# Seleccionar material con menú interactivo
opciones_materiales = [material['material'] for material in materiales]
opcion_material = menu_interactivo("SELECCIONA UN MATERIAL", opciones_materiales)
# Limpiar pantalla y mostrar resumen
os.system('cls' if os.name == 'nt' else 'clear')
print()
print(centrar_texto("=== RESUMEN DE IMPRESIÓN ==="))
print()
print(centrar_texto(f"Proyecto: {proyectos[opcion_proyecto]['nombre']}"))
print(centrar_texto(f"Material: {materiales[opcion_material]['material']}"))
print(centrar_texto(f"Cantidad disponible: {materiales[opcion_material]['cantidad']}"))
print()
print(centrar_texto("Presiona Enter para enviar a la impresora..."))
input()

tarea = { 
    'proyecto': proyectos[opcion_proyecto],
    'material': materiales[opcion_material]
}
enviar_a_impresora(tarea)
print()
print(centrar_texto("¡Impresión iniciada con éxito!"))
print()