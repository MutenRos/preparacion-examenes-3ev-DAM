import os

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

for i in range(min(len(proyectos), len(materiales))):
    tarea = {
        'proyecto': proyectos[i],
        'material': materiales[i]
    }
    enviar_a_impresora(tarea)   
print("Elegir un proyecto para imprimir:")
for i, proyecto in enumerate(proyectos):
    print(f"{i + 1}. {proyecto['nombre']}")
opcion_proyecto = int(input("Selecciona un proyecto: ")) - 1
print("Elegir un material para imprimir:")
for i, material in enumerate(materiales):
    print(f"{i + 1}. {material['material']}")
opcion_material = int(input("Selecciona un material: ")) - 1
tarea = {
    'proyecto': proyectos[opcion_proyecto],
    'material': materiales[opcion_material]
}
print("Presiona Enter para enviar a la impresora...")
input()
enviar_a_impresora(tarea)