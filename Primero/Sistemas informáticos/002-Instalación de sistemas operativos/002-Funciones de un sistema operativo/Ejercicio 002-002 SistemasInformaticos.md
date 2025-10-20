Contexto

En un mundo donde la tecnología juega un papel cada vez más importante en nuestra vida diaria, los sistemas operativos son herramientas fundamentales para gestionar y optimizar el funcionamiento de nuestros dispositivos. Ya sea que estés trabajando con una Raspberry Pi o cualquier otro dispositivo similar, entender las funciones básicas de un sistema operativo es crucial. Además, si te gusta el modelado e impresión 3D, puedes aplicar estos conocimientos para crear modelos y luego imprimirlos en una impresora 3D.

Enunciado paso a paso

Definición de funciones de un sistema operativo: Explora las principales funciones que realiza un sistema operativo, como gestionar hardware, interpretar entradas humanas y administrar procesos y programas.
Ejemplo práctico con Raspberry Pi: Imagina que estás trabajando en una Raspberry Pi para un proyecto de modelado e impresión 3D. Crea un script Python que genere un modelo simple (por ejemplo, un cubo) y lo guarde como archivo STL. Utiliza la función de administración de archivos del sistema operativo para guardar el modelo.
Aplicación en un entorno real: Si tienes acceso a una impresora 3D, puedes imprimir el modelo que has creado. Asegúrate de tener los permisos necesarios y de seguir las reglas de seguridad al usar la impresora.
Restricciones

Solo puedes utilizar funciones básicas del sistema operativo descritas en el material de clase.
No uses librerías externas o estructuras no vistas en la asignatura.
Asegúrate de tener los permisos necesarios para realizar las acciones descritas (por ejemplo, crear archivos y usar impresoras).
Criterios de evaluación

Introducción y contextualización: Explica cómo las funciones de un sistema operativo son fundamentales en la gestión del hardware y la eficiencia del dispositivo.
Desarrollo técnico correcto y preciso: Escribe el script Python que genere y guarde un modelo 3D, utilizando las funciones básicas del sistema operativo.
Aplicación práctica con ejemplo claro: Describe cómo has aplicado los conocimientos adquiridos en un entorno real, como imprimir un modelo 3D en una impresora 3D.
Cierre/Conclusión enlazando con la unidad: Concluye el ejercicio explicando cómo estas funciones son esenciales para cualquier proyecto de modelado e impresión 3D y cómo aplicarán estos conocimientos en futuras actividades del curso.

Python, uno de los idiomas mas versatiles, nos puede ayudar a automatizar nuestro impresora 3D, o a crear modelos 3D basicos para despues imprimirlos. Para ello, usaremos las funciones basicas de un sistema operativo, que son las encargadas de gestionar el hardware y los recursos del sistema. El ejercicio nos pide un `script` en PYTHON que cree un modelo 3D basico y lo guarde en un archivo STL.
Yo esto no se si es posible, lo que si que se es que la impresora puede traducir un archivo .svg a gcode, que es el lenguaje que entiende la impresora 3D. Asi que lo que haremos sera crear un archivo .svg con un cubo basico, y luego lo convertiremos a gcode con un programa externo.
El script primero pedira un input (nombre del usuario) para imprimir en la medalla, y despues creara el archivo .svg de las letras del nombre. El codigo es el siguiente:
```python
import os

# Pedir el nombre del usuario
nombre = input("Introduce tu nombre: ")

# Crear el contenido SVG
svg_content = f'''<svg height="100" width="500">
  <text x="10" y="40" font-family="Verdana" font-size="35" fill="blue">{nombre}</text>
</svg>'''

# Definir la ruta del archivo
file_path = os.path.join(os.path.expanduser("~"), "Desktop", "medalla.svg")
# Guardar el archivo SVG
with open(file_path, "w") as file:
    file.write(svg_content)
print(f"Archivo SVG guardado en: {file_path}")
```
Despues de ejecutar el script, tendremos un archivo `medalla.svg` en el escritorio con nuestro nombre. Ahora, para convertirlo a gcode, podemos usar un programa como `Inkscape` o `Cura`, que tienen opciones para exportar a gcode.