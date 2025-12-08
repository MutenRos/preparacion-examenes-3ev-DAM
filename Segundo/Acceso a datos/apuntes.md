# Acceso a datos

**Author:** Jose Vicente Carratala Sanchis

## Table of contents

- [Manejo de ficheros](#manejo-de-ficheros)
  - [Clases asociadas a las operaciones de gestión de ficheros](#clases-asociadas-a-las-operaciones-de-gestion-de-ficheros)
  - [Formas de acceso a un fichero. Ventajas](#formas-de-acceso-a-un-fichero-ventajas)
  - [Clases para gestión de flujos de datos desdehacia ficheros](#clases-para-gestion-de-flujos-de-datos-desdehacia-ficheros)
  - [Operaciones sobre ficheros secuenciales y aleatorios](#operaciones-sobre-ficheros-secuenciales-y-aleatorios)
  - [Serializacióndeserialización de objetos](#serializaciondeserializacion-de-objetos)
  - [Trabajo con ficheros](#trabajo-con-ficheros)
  - [Excepciones detección y tratamiento](#excepciones-deteccion-y-tratamiento)
  - [Desarrollo de aplicaciones que utilizan ficheros](#desarrollo-de-aplicaciones-que-utilizan-ficheros)
  - [Ejercicio de final de unidad](#ejercicio-de-final-de-unidad)
- [Manejo de conectores](#manejo-de-conectores)
  - [El desfase objeto-relacional](#el-desfase-objeto-relacional)
  - [Protocolos de acceso a bases de datos](#protocolos-de-acceso-a-bases-de-datos)
  - [Establecimiento de conexiones](#establecimiento-de-conexiones)
  - [Ejecución de sentencias de descripción de datos](#ejecucion-de-sentencias-de-descripcion-de-datos)
  - [Ejecución de sentencias de modificación de datos](#ejecucion-de-sentencias-de-modificacion-de-datos)
  - [Ejecución de consultas. Manipulación del resultado](#ejecucion-de-consultas-manipulacion-del-resultado)
  - [Ejecución de procedimientos almacenados en la base de datos](#ejecucion-de-procedimientos-almacenados-en-la-base-de-datos)
  - [Gestión de transacciones](#gestion-de-transacciones)
  - [Desarrollo de programas que utilizan bases de datos](#desarrollo-de-programas-que-utilizan-bases-de-datos)
  - [Ejercicio de final de unidad](#ejercicio-de-final-de-unidad-1)
  - [Examen final](#examen-final)
- [Herramientas de mapeo objeto relacional (ORM)](#herramientas-de-mapeo-objeto-relacional-orm)
  - [Concepto de mapeo objeto relacional](#concepto-de-mapeo-objeto-relacional)
  - [Características de las herramientas ORM](#caracteristicas-de-las-herramientas-orm)
  - [Instalación de una herramienta ORM. Configuración](#instalacion-de-una-herramienta-orm-configuracion)
  - [Estructura de un fichero de mapeo](#estructura-de-un-fichero-de-mapeo)
  - [Mapeo basado en anotaciones](#mapeo-basado-en-anotaciones)
  - [Clases persistentes](#clases-persistentes)
  - [Sesiones; estados de un objeto](#sesiones-estados-de-un-objeto)
  - [Carga, almacenamiento y modificación de objetos](#carga-almacenamiento-y-modificacion-de-objetos)
  - [Consultas SQL](#consultas-sql)
  - [Gestión de transacciones](#gestion-de-transacciones-1)
  - [Desarrollo de programas que utilizan bases de datos a través de herramientas ORM](#desarrollo-de-programas-que-utilizan-bases-de-datos-a-traves-de-herramientas-orm)
- [Bases de datos objeto relacionales y orientadas a objetos](#bases-de-datos-objeto-relacionales-y-orientadas-a-objetos)
  - [Gestores de bases de datos objeto relacionales](#gestores-de-bases-de-datos-objeto-relacionales)
  - [Gestión de objetos con SQL; ANSI SQL](#gestion-de-objetos-con-sql-ansi-sql)
  - [Acceso a las funciones del gestor de base de datos objeto-relacional](#acceso-a-las-funciones-del-gestor-de-base-de-datos-objeto-relacional)
  - [Gestores de bases de datos orientadas a objetos](#gestores-de-bases-de-datos-orientadas-a-objetos)
  - [Gestión de la persistencia de objetos](#gestion-de-la-persistencia-de-objetos)
  - [El interfaz de programación de aplicaciones de la base de datos orientada a objetos](#el-interfaz-de-programacion-de-aplicaciones-de-la-base-de-datos-orientada-a-objetos)
  - [Gestión de transacciones](#gestion-de-transacciones-2)
  - [Desarrollo de programas que gestionan objetos en bases de datos](#desarrollo-de-programas-que-gestionan-objetos-en-bases-de-datos)
- [Bases de datos documentales](#bases-de-datos-documentales)
  - [Bases de datos documentales nativas](#bases-de-datos-documentales-nativas)
  - [Establecimiento y cierre de conexiones](#establecimiento-y-cierre-de-conexiones)
  - [Colecciones y documentos](#colecciones-y-documentos)
  - [Creación y borrado de colecciones](#creacion-y-borrado-de-colecciones)
  - [Añadir, modificar y eliminar documentos](#anadir-modificar-y-eliminar-documentos)
  - [Lenguajes de consulta. Realización de consultas](#lenguajes-de-consulta-realizacion-de-consultas)
  - [Desarrollo de programas que utilizan bases de datos documentales](#desarrollo-de-programas-que-utilizan-bases-de-datos-documentales)
- [Programación de componentes de acceso a datos](#programacion-de-componentes-de-acceso-a-datos)
  - [Concepto de componente](#concepto-de-componente)
  - [Propiedades y atributos](#propiedades-y-atributos)
  - [Eventos; asociación de acciones a eventos](#eventos-asociacion-de-acciones-a-eventos)
  - [Persistencia del componente](#persistencia-del-componente)
  - [Herramientas para desarrollo de componentes](#herramientas-para-desarrollo-de-componentes)
  - [Desarrollo, empaquetado y utilización de componentes](#desarrollo-empaquetado-y-utilizacion-de-componentes)
- [Actividad libre de final de evaluación - La milla extra](#actividad-libre-de-final-de-evaluacion-la-milla-extra)
  - [La Milla Extra - Primera evaluación](#la-milla-extra-primera-evaluacion)

---

<a id="manejo-de-ficheros"></a>
# Manejo de ficheros

<a id="clases-asociadas-a-las-operaciones-de-gestion-de-ficheros"></a>
## Clases asociadas a las operaciones de gestión de ficheros

En el mundo digital actual, la gestión eficiente de ficheros es una habilidad fundamental para cualquier programador o desarrollador. Los ficheros son los bloques básicos de almacenamiento de información en computadoras, y su manejo adecuado es crucial para mantener sistemas informáticos funcionando correctamente.

La gestión de ficheros implica una serie de operaciones que permiten crear, leer, escribir y eliminar datos. En la programación orientada a objetos, estas operaciones se encapsulan dentro de clases específicas, lo que facilita su uso y reutilización en diferentes partes del código. Algunas de las clases más importantes para el manejo de ficheros son `FileInputStream`, `FileOutputStream`, `BufferedReader` y `BufferedWriter`.

La clase `FileInputStream` es utilizada para leer datos binarios desde un fichero. Su constructor toma como parámetro la ruta del fichero que se desea leer, y proporciona métodos para leer bytes individuales o bloques de bytes. Esta clase es especialmente útil cuando se necesita trabajar con archivos que contienen información no textual, como imágenes o videos.

Por otro lado, `FileOutputStream` es su contraparte para escribir datos binarios en un fichero. Similarmente a `FileInputStream`, requiere la ruta del fichero como parámetro y ofrece métodos para escribir bytes individuales o bloques de bytes. Es una herramienta fundamental para guardar información persistente en el disco.

La clase `BufferedReader` se utiliza para leer datos de texto desde un flujo de entrada, proporcionando una forma más eficiente de leer líneas completas del fichero. Su constructor toma como parámetro un objeto que implemente la interfaz `Reader`, y ofrece métodos para leer líneas individuales o todo el contenido del fichero en una sola operación.

Por otro lado, `BufferedWriter` es su contraparte para escribir datos de texto en un flujo de salida. Similarmente a `BufferedReader`, requiere un objeto que implemente la interfaz `Writer` como parámetro y ofrece métodos para escribir líneas individuales o todo el contenido del fichero en una sola operación.

Estas clases proporcionan una capa de abstracción sobre los flujos de entrada y salida, simplificando significativamente el manejo de ficheros. Al utilizar estas clases, se pueden realizar operaciones como la lectura y escritura de texto o binario, la creación y eliminación de ficheros, y la gestión de excepciones que puedan surgir durante las operaciones de fichero.

Además de estas clases básicas, existen otras herramientas y bibliotecas que facilitan aún más el manejo de ficheros. Por ejemplo, en Java, la clase `Files` proporciona métodos estáticos para realizar operaciones comunes sobre ficheros, como leer o escribir todo el contenido de un fichero en una sola operación.

En resumen, el manejo de ficheros es una habilidad esencial en cualquier entorno de desarrollo informático. Las clases `FileInputStream`, `FileOutputStream`, `BufferedReader` y `BufferedWriter` son herramientas poderosas que facilitan la lectura y escritura de datos en ficheros, proporcionando una capa de abstracción sobre los flujos de entrada y salida. Al utilizar estas clases, se pueden realizar operaciones complejas sobre ficheros con solo unas pocas líneas de código, lo que mejora significativamente la eficiencia y legibilidad del código.

### grabar y leer de txt

```python
# Primero escribimos un archivo

archivo = open("clientes.txt",'w')
archivo.write("Esto es un texto")
archivo.close()

# Ahora vamos a leer archivos

archivo = open("clientes.txt",'r')
lineas = archivo.readlines()
for linea in lineas:
    print(linea)

# Ahora apendizamos en archivos

archivo = open("clientes.txt",'a')
archivo.write("Esto es otro texto")
archivo.close()

# Ahora vamos a leer archivos

archivo = open("clientes.txt",'r')
lineas = archivo.readlines()
for linea in lineas:
    print(linea)
```

### trabajar con archivos csv

```python
import csv

# Primero escribo datos

datos = [
    ['nombre','apellidos','telefono'],
    ['Juan','Lopez','5325345'],
    ['Jorge','Garcia','5124535'],
    ['Jaime','Martinez','52345435'],
    ['Jose','Sancho','52345345'],
]

archivo = open("datos.csv",'w')
escritor = csv.writer(archivo)
escritor.writerows(datos)
archivo.close()

# Ahora leo los datos

archivo = open("datos.csv",'r')
lector = csv.reader(archivo)
for linea in lector:
    print(linea)
```

### escribir y leer json

```python
import json

agenda = [
        {
            "nombre":"Jose Vicente",
            "telefono":["543534","543534","543534"],
            "email":"info@jocarsa.com",
            },
        {
            "nombre":"Juan",
            "telefono":["543534","543534","543534"],
            "email":"info@jocarsa.com",
            },
    ]

archivo = open("agenda.json",'w')
json.dump(agenda,archivo,indent=4)
archivo.close()
```

### agenda

```json
[
    {
        "nombre": "Jose Vicente",
        "telefono": [
            "543534",
            "543534",
            "543534"
        ],
        "email": "info@jocarsa.com"
    },
    {
        "nombre": "Juan",
        "telefono": [
            "543534",
            "543534",
            "543534"
        ],
        "email": "info@jocarsa.com"
    }
]
```

### clientes

```
Esto es un textoEsto es otro texto
```

### datos

```
nombre,apellidos,telefono
Juan,Lopez,5325345
Jorge,Garcia,5124535
Jaime,Martinez,52345435
Jose,Sancho,52345345
```

<a id="formas-de-acceso-a-un-fichero-ventajas"></a>
## Formas de acceso a un fichero. Ventajas

En el mundo digital actual, el acceso a ficheros es una operación fundamental que permite la manipulación de datos de manera eficiente y segura. Los ficheros pueden almacenar información estructurada o no estructurada, y su manejo adecuado es esencial para cualquier sistema informático.

La forma en que se accede a un fichero puede variar significativamente dependiendo del tipo de acceso requerido y las necesidades específicas del programa. Existen dos formas principales de acceso a los ficheros: el acceso secuencial y el acceso aleatorio.

El acceso secuencial es el método más sencillo, donde los datos se leen o escriben en orden lineal, desde el principio hasta el final del fichero. Este tipo de acceso es útil cuando solo necesitamos leer o escribir una porción pequeña del fichero, ya que no requiere un conocimiento previo de la ubicación exacta de los datos dentro del archivo.

Por otro lado, el acceso aleatorio permite acceder directamente a cualquier parte del fichero sin necesidad de recorrer los datos anteriores. Este método es ideal cuando se necesita leer o escribir en múltiples posiciones diferentes del fichero simultáneamente, como ocurre con bases de datos y archivos grandes.

Cada forma de acceso tiene sus ventajas y desventajas. El acceso secuencial es más eficiente en términos de tiempo de ejecución cuando solo se necesita acceder a una pequeña porción del fichero, mientras que el acceso aleatorio ofrece la flexibilidad de acceder a cualquier parte del archivo en cualquier momento.

Además, el acceso aleatorio permite un mayor control sobre los datos almacenados, ya que es posible reorganizar y modificar los datos sin afectar las posiciones relativas de los demás datos. Sin embargo, este tipo de acceso puede ser más costoso en términos de tiempo de ejecución debido a la necesidad de buscar y posicionarse correctamente dentro del fichero.

En resumen, el manejo de ficheros es una operación fundamental en cualquier sistema informático, y su forma de acceso depende de las necesidades específicas del programa. El acceso secuencial ofrece simplicidad y eficiencia para accesos limitados, mientras que el acceso aleatorio proporciona la flexibilidad necesaria para manipular grandes conjuntos de datos de manera eficiente.

### leer y escribir modo texto

```python
# Primero escribimos un archivo

archivo = open("clientes.txt",'w')
archivo.write("Esto es un texto")
archivo.close()

# Ahora vamos a leer archivos

archivo = open("clientes.txt",'r')
lineas = archivo.readlines()
for linea in lineas:
    print(linea)

# Ahora apendizamos en archivos

archivo = open("clientes.txt",'a')
archivo.write("Esto es otro texto")
archivo.close()

# Ahora vamos a leer archivos

archivo = open("clientes.txt",'r')
lineas = archivo.readlines()
for linea in lineas:
    print(linea)

# Quiero obtener un error si intento sobreescribir algo que ya existe

# Primero escribimos un archivo

archivo = open("clientes.txt",'x')
archivo.write("Esto es un texto")
archivo.close()
```

### clientes

```
Esto es un textoEsto es otro texto
```

<a id="clases-para-gestion-de-flujos-de-datos-desdehacia-ficheros"></a>
## Clases para gestión de flujos de datos desdehacia ficheros

En el mundo digital actual, el manejo eficiente de ficheros es una habilidad fundamental para cualquier programador. Los ficheros son la forma en que los datos se almacenan y recuperan en nuestros sistemas informáticos. En esta subunidad, nos centraremos en las clases que facilitan la gestión de flujos de datos desde y hacia ficheros.

La gestión de flujos es un concepto clave en el acceso a ficheros. Un flujo puede ser visto como una secuencia de bytes que se mueven entre diferentes partes del sistema. Cuando hablamos de flujos de entrada, estamos referiéndonos a la lectura de datos desde un origen (como un fichero) hacia nuestro programa. Por otro lado, los flujos de salida son el proceso inverso, donde los datos se escriben en un destino (también un fichero).

Para facilitar esta gestión, las clases que manejan flujos de datos suelen proporcionar métodos para abrir y cerrar el flujo, así como para leer o escribir datos. Estas clases generalmente ofrecen una interfaz uniforme que permite trabajar con diferentes tipos de ficheros sin necesidad de preocuparse por los detalles específicos del formato.

Un ejemplo común de clase para gestionar flujos de datos es la `Stream` en muchos lenguajes de programación. Esta clase proporciona métodos como `Read`, `Write`, `Seek` y `Close`. La `Stream` es una base abstracta que puede ser extendida por clases más específicas, como `FileStream` para ficheros locales o `NetworkStream` para flujos de red.

La gestión de flujos también implica el manejo de excepciones. Es importante comprobar y tratar adecuadamente las posibles situaciones de error, como la ausencia del fichero o problemas de permisos de acceso. Las clases de flujo suelen proporcionar métodos para detectar y gestionar estas excepciones, lo que ayuda a hacer el código más robusto y seguro.

Además de los flujos de entrada y salida estándar, muchas aplicaciones requieren la manipulación de ficheros binarios. Para estos casos, las clases de flujo suelen ofrecer métodos específicos para leer y escribir datos en formato binario. Esto es especialmente útil cuando se trabaja con datos complejos o grandes volúmenes de información.

La gestión de flujos también puede implicar la manipulación de los punteros de lectura y escritura. Los punteros permiten controlar exactamente dónde se encuentra el flujo en el momento, lo que es crucial para operaciones como la búsqueda o la inserción de datos en un fichero.

En resumen, las clases para gestión de flujos de datos son herramientas poderosas y versátiles que facilitan la interacción con los ficheros. Al comprender cómo utilizar estas clases, podemos desarrollar aplicaciones más eficientes y seguras que puedan manejar grandes volúmenes de información de manera efectiva.

### flujo con la libreria

```python
archivo = open("clientes.bin",'wb')

archivo.write(b"soy un cliente")

archivo.close()
```

### flujo mejor con libreria

```python
import pickle

datos = "soy un texto"

# Primero voy a guardar

archivo = open("datos.bin",'wb')
pickle.dump(datos,archivo)
archivo.close()

# Ahora voy a leer

archivo = open("datos.bin",'rb')
contenido = pickle.load(archivo)
print(contenido)
```

### Usar pickle para guardar objetos

```python
import pickle

class Contacto:
    def __init__(self,minombre,mitelefono):
        self.nombre = minombre
        self.telefono = mitelefono

agenda = []

for i in range(0,10):
    agenda.append(Contacto("Jose Vicente",543534))

# Primero voy a guardar

archivo = open("datos.bin",'wb')
pickle.dump(agenda,archivo)
archivo.close()

# Ahora voy a leer

archivo = open("datos.bin",'rb')
contenido = pickle.load(archivo)
for elemento in contenido:
    print(elemento)
```

### pixel

```python
from PIL import Image

img = Image.open("josevicente.jpeg")

pixel = img.getpixel((0, 0))

print(pixel) 
```

### todos los pixeles de la imagen

```python
from PIL import Image

img = Image.open("josevicente.jpeg")
tamanio = img.size
print(tamanio)
pixel = img.getpixel((0, 0))

print(pixel) 
```

### recorro

```python
from PIL import Image

img = Image.open("josevicente.jpeg")
tamanio = img.size
for x in range(0,tamanio[0]):
  for y in range(0,tamanio[1]):
    pixel = img.getpixel((x, y))
    print(pixel) 
```

### escribir

```python
from PIL import Image

img = Image.open("josevicente.jpeg")

pixels = img.load()
pixels[0, 0] = (0, 0, 0)

img.save("josevicente2.jpeg")
```

### guardar como png

```python
from PIL import Image

img = Image.open("josevicente.jpeg")

pixels = img.load()
pixels[0, 0] = (0, 0, 0)

img.save("josevicente2.png")
```

### nueva imagen

```python
from PIL import Image

img = Image.new("RGB", size=(200, 200), color="white")

texto = open("texto.txt",'r')
print(texto.readlines())

img.save("mensaje.png")
```

### recorro los caracteres

```python
from PIL import Image

img = Image.new("RGB", size=(200, 200), color="white")

texto = open("texto.txt",'r')
lineas = texto.readlines()
letras = []
for linea in lineas:
  for letra in linea:
    letras.append(letra)

contador = 0    
for letra in letras:
  print(letra)
  contador += 1
  if contador > 3:
    contador = 0
    print("Vamos con el siguiente pixel")

img.save("mensaje.png")
```

### agrupamos en grupos de 3

```python
from PIL import Image

img = Image.new("RGB", size=(200, 200), color="white")

texto = open("texto.txt",'r')
lineas = texto.readlines()
letras = []
for linea in lineas:
  for letra in linea:
    letras.append(letra)

contador = 0    
for i in range(0,len(letras),3):
  try:
    print("r:",letras[i])
    print("g:",letras[i+1])
    print("b:",letras[i+2])
    print("siguiente pixel")
  except:
    pass

img.save("mensaje.png")
```

### agrupamos en grupos de e

```python
from PIL import Image

img = Image.new("RGB", size=(200, 200), color="white")

texto = open("texto.txt",'r')
lineas = texto.readlines()
letras = []
for linea in lineas:
  for letra in linea:
    letras.append(letra)

contador = 0    
for letra in letras:
  print(letra)
  contador += 1
  if contador > 3:
    contador = 0
    print("Vamos con el siguiente pixel")

img.save("mensaje.png")
```

### letras a ascii

```python
from PIL import Image

img = Image.new("RGB", size=(200, 200), color="white")

texto = open("texto.txt",'r')
lineas = texto.readlines()
letras = []
for linea in lineas:
  for letra in linea:
    letras.append(letra)

contador = 0    
for i in range(0,len(letras),3):
  try:
    print("r:",letras[i],ord(letras[i]))
    print("g:",letras[i+1],ord(letras[i+1]))
    print("b:",letras[i+2],ord(letras[i+2]))
    print("siguiente pixel")
  except:
    pass

img.save("mensaje.png")
```

### letras a ascoo

```python
from PIL import Image

img = Image.new("RGB", size=(200, 200), color="white")

texto = open("texto.txt",'r')
lineas = texto.readlines()
letras = []
for linea in lineas:
  for letra in linea:
    letras.append(letra)

contador = 0    
for i in range(0,len(letras),3):
  try:
    print("r:",letras[i])
    print("g:",letras[i+1])
    print("b:",letras[i+2])
    print("siguiente pixel")
  except:
    pass

img.save("mensaje.png")
```

### guardo los pixeles

```python
from PIL import Image

img = Image.new("RGB", size=(200, 200), color="white")
pixels = img.load()



texto = open("texto.txt",'r')
lineas = texto.readlines()
letras = []
for linea in lineas:
  for letra in linea:
    letras.append(letra)

contador = 0    
for i in range(0,len(letras),3):
  try:
    print("r:",letras[i],ord(letras[i]))
    print("g:",letras[i+1],ord(letras[i+1]))
    print("b:",letras[i+2],ord(letras[i+2]))
    pixels[i/3, 0] = (ord(letras[i]), ord(letras[i+1]), ord(letras[i+2]))
    print("siguiente pixel")
  except:
    pass
    
img.save("mensaje.png")
```

### anchura de la imagen

```python
from PIL import Image
import math

img = Image.new("RGB", size=(200, 200), color="white")
pixels = img.load()



texto = open("texto.txt",'r')
lineas = texto.readlines()
letras = []
for linea in lineas:
  for letra in linea:
    letras.append(letra)

contador = 0    
for i in range(0,len(letras),3):
  try:
    print("r:",letras[i],ord(letras[i]))
    print("g:",letras[i+1],ord(letras[i+1]))
    print("b:",letras[i+2],ord(letras[i+2]))
    pixels[(i/3)%200, math.floor((i/3)/200)] = (ord(letras[i]), ord(letras[i+1]), ord(letras[i+2]))
    print("siguiente pixel")
  except:
    pass
    
img.save("mensaje.png")
```

### tamanio dinamico de la imagen

```python
from PIL import Image
import math

# Cargo el texto
texto = open("texto.txt",'r')
lineas = texto.readlines()
letras = []
for linea in lineas:
  for letra in linea:
    letras.append(letra)
    
longitudtexto = len(letras)/3
print("La longitud del texto es de:",longitudtexto)
raizcuadrada = math.sqrt(longitudtexto)
print("La raiz cuadrada es de:",raizcuadrada)
techo = math.ceil(raizcuadrada)
print("Redondeo al alza: ",techo)

img = Image.new("RGB", size=(techo, techo), color="white")
pixels = img.load()

contador = 0    
for i in range(0,len(letras),3):
  try:
    pixels[(i/3)%techo, math.floor((i/3)/techo)] = (ord(letras[i]), ord(letras[i+1]), ord(letras[i+2]))
  except:
    pass
    
img.save("mensaje.png")
```

### argumentos de consola

```python
from PIL import Image
import math
import sys

# Cargo el texto
texto = sys.argv[1]
letras = []
for letra in texto:
  letras.append(letra)

longitudtexto = len(letras)/3
print("La longitud del texto es de:",longitudtexto)
raizcuadrada = math.sqrt(longitudtexto)
print("La raiz cuadrada es de:",raizcuadrada)
techo = math.ceil(raizcuadrada)
print("Redondeo al alza: ",techo)

img = Image.new("RGB", size=(techo, techo), color="white")
pixels = img.load()

contador = 0    
for i in range(0,len(letras),3):
  try:
    pixels[(i/3)%techo, math.floor((i/3)/techo)] = (ord(letras[i]), ord(letras[i+1]), ord(letras[i+2]))
  except:
    pass
    
img.save(sys.argv[2])
```

### argumentos limpios

```python
from PIL import Image
import math
import sys
import argparse


parser = argparse.ArgumentParser(description="Convierte un texto en una imagen RGB")
parser.add_argument("-i", "--entrada", required=True, help="Texto de entrada")
parser.add_argument("-o", "--salida", required=True, help="Archivo de salida (ej: salida.png)")
args = parser.parse_args()

# Cargo el texto
texto = args.entrada
letras = []
for letra in texto:
  letras.append(letra)

longitudtexto = len(letras)/3
print("La longitud del texto es de:",longitudtexto)
raizcuadrada = math.sqrt(longitudtexto)
print("La raiz cuadrada es de:",raizcuadrada)
techo = math.ceil(raizcuadrada)
print("Redondeo al alza: ",techo)

img = Image.new("RGB", size=(techo, techo), color="white")
pixels = img.load()

contador = 0    
for i in range(0,len(letras),3):
  try:
    pixels[(i/3)%techo, math.floor((i/3)/techo)] = (ord(letras[i]), ord(letras[i+1]), ord(letras[i+2]))
  except:
    pass
    
img.save(args.salida)
```

### leer

```python
from PIL import Image
import math
import sys
import argparse


#parser = argparse.ArgumentParser(description="Convierte un texto en una imagen RGB")
#parser.add_argument("-i", "--entrada", required=True, help="Texto de entrada")
#args = parser.parse_args()

img = Image.open("prueba1.png")
pixels = img.load()
tamanio = img.size
for x in range(0,tamanio[0]):
  for y in range(0,tamanio[1]):
    print(pixels[x,y])

print(pixels)
    
```

### leer letras una a una

```python
from PIL import Image
import math
import sys
import argparse


#parser = argparse.ArgumentParser(description="Convierte un texto en una imagen RGB")
#parser.add_argument("-i", "--entrada", required=True, help="Texto de entrada")
#args = parser.parse_args()

img = Image.open("prueba1.png")
pixels = img.load()
tamanio = img.size
for x in range(0,tamanio[0]):
  for y in range(0,tamanio[1]):
    for dato in pixels[x,y]:
      print(dato,chr(dato))

print(pixels)
    
```

### encadeno a cadena

```python
from PIL import Image
import math
import sys
import argparse


parser = argparse.ArgumentParser(description="Convierte un texto en una imagen RGB")
parser.add_argument("-i", "--entrada", required=True, help="Texto de entrada")
args = parser.parse_args()

img = Image.open(args.entrada)
pixels = img.load()
tamanio = img.size
cadena = ""
for x in range(0,tamanio[0]):
  for y in range(0,tamanio[1]):
    for dato in pixels[x,y]:
      cadena += chr(dato)

print(cadena)
    
```

### encoder

```python
from PIL import Image
import math
import argparse

parser = argparse.ArgumentParser(description="Convierte un texto en una imagen RGB")
parser.add_argument("-i", "--entrada", required=True, help="Texto de entrada (string)")
parser.add_argument("-o", "--salida", required=True, help="Archivo de salida (ej: salida.png)")
args = parser.parse_args()

# 1) Texto a bytes UTF-8
data = args.entrada.encode("utf-8")
length = len(data)

# 2) Cabecera de 4 bytes (longitud) en big-endian
header = length.to_bytes(4, byteorder="big")
payload = header + data

# 3) Relleno a múltiplo de 3
pad_len = (3 - (len(payload) % 3)) % 3
payload += b"\x00" * pad_len

# 4) Calcular tamaño de imagen (cuadrada)
num_pixels = len(payload) // 3
side = math.ceil(math.sqrt(num_pixels))

# 5) Crear imagen negra y volcar bytes
img = Image.new("RGB", size=(side, side), color=(0, 0, 0))
pixels = img.load()

for i in range(0, len(payload), 3):
    p = i // 3
    x = p % side
    y = p // side
    r = payload[i]
    g = payload[i + 1]
    b = payload[i + 2]
    pixels[x, y] = (r, g, b)

img.save(args.salida)
```

### decoder

```python
from PIL import Image
import argparse

parser = argparse.ArgumentParser(description="Decodifica una imagen RGB a texto")
parser.add_argument("-i", "--entrada", required=True, help="Archivo de imagen de entrada (png/jpg)")
args = parser.parse_args()

# 1) Leer todos los bytes (R,G,B) en el mismo orden de escritura
img = Image.open(args.entrada).convert("RGB")
pixels = img.load()
w, h = img.size

byte_array = bytearray()
for y in range(h):
    for x in range(w):
        r, g, b = pixels[x, y]
        byte_array.extend((r, g, b))

# 2) Extraer longitud (4 bytes big-endian) y recuperar exactamente esos bytes
if len(byte_array) < 4:
    raise ValueError("Imagen demasiado pequeña: no contiene cabecera de longitud.")

length = int.from_bytes(byte_array[0:4], byteorder="big")
data = bytes(byte_array[4:4 + length])

# 3) Decodificar UTF-8 y mostrar
texto = data.decode("utf-8")
print(texto)
```

### supercodificador

```python
#!/usr/bin/env python3
"""
coder.py — Codificador/decodificador de texto en imágenes RGB.

Este script permite convertir un texto (UTF-8) en una imagen cuadrada de píxeles RGB,
y posteriormente recuperar exactamente el texto original desde la imagen.

Formato de almacenamiento dentro de la imagen:
    [ MAGIC (4 bytes = "MSG1") ]
    [ LENGTH (4 bytes, entero big-endian) ]
    [ CRC32 (4 bytes, entero big-endian) ]
    [ PAYLOAD (bytes del texto en UTF-8) ]
    [ Relleno hasta múltiplo de 3 ]

Cada píxel almacena exactamente 3 bytes (R,G,B).
El relleno asegura que todos los píxeles estén completos.
El CRC32 permite detectar corrupción de datos.

Uso:
    # Codificar texto directo
    python coder.py encode -t "¡Hola mundo!" -o mensaje.png

    # Codificar desde archivo de texto
    python coder.py encode -f entrada.txt -o mensaje.png

    # Decodificar y mostrar texto
    python coder.py decode -i mensaje.png

    # Decodificar y guardar en archivo
    python coder.py decode -i mensaje.png -o salida.txt

    # Decodificar como bytes crudos
    python coder.py decode -i mensaje.png --raw-bytes -o datos.bin
"""

from PIL import Image
import math
import argparse
import zlib
import sys
from pathlib import Path

# Constante de identificación de nuestras imágenes
MAGIC = b"MSG1"  # 4 bytes


def bytes_to_pixels(payload: bytes):
    """
    Convierte un flujo de bytes en una cuadrícula de píxeles RGB.

    Args:
        payload (bytes): Secuencia de bytes a codificar.

    Returns:
        tuple:
            - payload_padded (bytes): Bytes con relleno para múltiplo de 3.
            - side (int): Dimensión del lado de la imagen cuadrada.
    """
    # Relleno a múltiplos de 3 (RGB)
    pad_len = (3 - (len(payload) % 3)) % 3
    payload_padded = payload + b"\x00" * pad_len

    # Calcular tamaño de imagen cuadrada
    num_pixels = len(payload_padded) // 3
    side = math.ceil(math.sqrt(num_pixels))
    return payload_padded, side


def encode_to_image(text_bytes: bytes, out_path: str, img_format: str = "PNG"):
    """
    Codifica bytes de texto en una imagen RGB cuadrada.

    Args:
        text_bytes (bytes): Contenido a codificar (en UTF-8).
        out_path (str): Ruta de salida para la imagen.
        img_format (str): Formato de imagen (PNG, BMP, etc.).
    """
    length = len(text_bytes)
    crc = zlib.crc32(text_bytes) & 0xFFFFFFFF

    # Cabecera: magic + longitud + CRC
    header = MAGIC + length.to_bytes(4, "big") + crc.to_bytes(4, "big")
    payload = header + text_bytes

    payload_padded, side = bytes_to_pixels(payload)

    img = Image.new("RGB", size=(side, side), color=(0, 0, 0))
    pixels = img.load()

    # Escribir secuencialmente bytes en los píxeles
    idx = 0
    total = len(payload_padded)
    for y in range(side):
        for x in range(side):
            if idx + 3 <= total:
                r = payload_padded[idx]
                g = payload_padded[idx + 1]
                b = payload_padded[idx + 2]
                pixels[x, y] = (r, g, b)
                idx += 3
            else:
                break

    img.save(out_path, format=img_format.upper())


def decode_from_image(in_path: str) -> bytes:
    """
    Decodifica bytes desde una imagen RGB con formato definido.

    Args:
        in_path (str): Ruta de la imagen de entrada.

    Returns:
        bytes: Texto original en bytes UTF-8.

    Raises:
        ValueError: Si la imagen no contiene cabecera válida o los datos están corruptos.
    """
    img = Image.open(in_path).convert("RGB")
    w, h = img.size
    pixels = img.load()

    # Recuperar todos los bytes en el mismo orden de escritura
    data = bytearray()
    for y in range(h):
        for x in range(w):
            r, g, b = pixels[x, y]
            data.extend((r, g, b))

    if len(data) < 12:
        raise ValueError("Imagen demasiado pequeña para contener cabecera.")

    if bytes(data[0:4]) != MAGIC:
        raise ValueError("Magic inválido: la imagen no contiene un mensaje válido (MSG1).")

    length = int.from_bytes(data[4:8], "big")
    crc_expected = int.from_bytes(data[8:12], "big")

    start = 12
    end = start + length
    if end > len(data):
        raise ValueError("La imagen no contiene todos los bytes anunciados por la longitud.")

    payload = bytes(data[start:end])
    crc_actual = zlib.crc32(payload) & 0xFFFFFFFF

    if crc_actual != crc_expected:
        raise ValueError(
            f"CRC no coincide: esperado {crc_expected:#010x}, obtenido {crc_actual:#010x}. Datos corruptos."
        )

    return payload


def main():
    """Punto de entrada principal: parsea argumentos y ejecuta encode/decode."""
    parser = argparse.ArgumentParser(
        description="Codifica/decodifica texto en una imagen RGB con cabecera y CRC."
    )
    sub = parser.add_subparsers(dest="mode", required=True)

    # Subcomando: encode
    p_enc = sub.add_parser("encode", help="Codifica texto en imagen")
    src = p_enc.add_mutually_exclusive_group(required=True)
    src.add_argument("-t", "--text", help="Texto directo a codificar (UTF-8)")
    src.add_argument("-f", "--text-file", help="Archivo de texto a codificar (se lee como UTF-8)")
    p_enc.add_argument("-o", "--output", required=True, help="Ruta de salida de la imagen (ej: salida.png)")
    p_enc.add_argument("--format", default=None, help="Formato de imagen (PNG por defecto si no se deduce por extensión)")

    # Subcomando: decode
    p_dec = sub.add_parser("decode", help="Decodifica imagen a texto")
    p_dec.add_argument("-i", "--input", required=True, help="Imagen de entrada")
    p_dec.add_argument("-o", "--output", help="Archivo de salida para el texto (si se omite, imprime por stdout)")
    p_dec.add_argument("--raw-bytes", action="store_true", help="Guardar bytes tal cual (sin decodificar UTF-8)")

    args = parser.parse_args()

    if args.mode == "encode":
        # Obtener texto
        if args.text is not None:
            text_bytes = args.text.encode("utf-8")
        else:
            text_bytes = Path(args.text_file).read_text(encoding="utf-8").encode("utf-8")

        # Detectar formato de imagen si no se especifica
        img_format = args.format
        if img_format is None:
            suffix = Path(args.output).suffix.lower()
            img_format = "PNG" if suffix == "" else suffix.lstrip(".").upper()

        encode_to_image(text_bytes, args.output, img_format=img_format)

    elif args.mode == "decode":
        payload = decode_from_image(args.input)
        if args.raw_bytes:
            # Guardar bytes en bruto
            if args.output:
                Path(args.output).write_bytes(payload)
            else:
                sys.stderr.write("Advertencia: mostrando bytes en bruto por stdout.\n")
                sys.stdout.buffer.write(payload)
        else:
            # Decodificar como UTF-8
            try:
                text = payload.decode("utf-8")
            except UnicodeDecodeError:
                raise ValueError("Los datos no son UTF-8 válidos. Use --raw-bytes para extraerlos sin decodificar.")
            if args.output:
                Path(args.output).write_text(text, encoding="utf-8")
            else:
                print(text)


if __name__ == "__main__":
    main()
```

### clientes

```
soy un cliente
```

### texto

```
Desocupado lector, sin juramento me podrás creer que quisiera que este libro, como hijo del entendimiento, fuera el más hermoso, el más gallardo y más discreto que pudiera imaginarse. Pero no he podido yo contravenir al orden de naturaleza; que en ella cada cosa engendra su semejante. Y así, ¿qué podrá engendrar el estéril y mal cultivado ingenio mío, sino la historia de un hijo seco, avellanado, antojadizo y lleno de pensamientos varios y nunca imaginados de otro alguno, bien como quien se engendró en una cárcel, donde toda incomodidad tiene su asiento y donde todo triste ruido hace su habitación? El sosiego, el lugar apacible, la amenidad de los campos, la serenidad de los cielos, el murmurar de las fuentes, la quietud del espíritu son grande parte para que las musas más estériles se muestren fecundas y ofrezcan partos al mundo que le colmen de maravilla y de contento. Acontece tener un padre un hijo feo y sin gracia alguna, y el amor que le tiene le pone una venda en los ojos para que no vea sus faltas, antes las juzga por discreciones y lindezas y las cuenta a sus amigos por agudezas y donaires. Pero yo, que, aunque parezco padre, soy padrastro de Don Quijote, no quiero irme con la corriente del uso, ni suplicarte, casi con las lágrimas en los ojos, como otros hacen, lector carísimo, que perdones o disimules las faltas que en este mi hijo vieres, pues ni eres su pariente ni su amigo, y tienes tu alma en tu cuerpo y tu libre albedrío como el más pintado, y estás en tu casa, donde eres señor della, como el rey de sus alcabalas, y sabes lo que comúnmente se dice, que debajo de mi manto, al rey mato. Todo lo cual te exenta y hace libre de todo respecto y obligación, y así, puedes decir de la historia todo aquello que te pareciere, sin temor que te calunien por el mal ni te premien por el bien que dijeres della.

Sólo quisiera dártela monda y desnuda, sin el ornato de prólogo, ni de la inumerabilidad y catálogo de los acostumbrados sonetos, epigramas y elogios que al principio de los libros suelen ponerse. Porque te sé decir que, aunque me costó algún trabajo componerla, ninguno tuve por mayor que hacer esta prefación que vas leyendo. Muchas veces tomé la pluma para escribille, y muchas la dejé, por no saber lo que escribiría; y estando una suspenso, con el papel delante, la pluma en la oreja, el codo en el bufete y la mano en la mejilla, pensando lo que diría, entró a deshora un amigo mío, gracioso y bien entendido, el cual, viéndome tan imaginativo, me preguntó la causa, y, no encubriéndosela yo, le dije que pensaba en el prólogo que había de hacer a la historia de don Quijote, y que me tenía de suerte que ni quería hacerle, ni menos sacar a luz las hazañas de tan noble caballero. «Porque, ¿cómo queréis vos que no me tenga confuso el qué dirá el antiguo legislador que llaman vulgo cuando vea que, al cabo de tantos años como ha que duermo en el silencio del olvido, salgo ahora, con todos mis años a cuestas, con una leyenda seca como un esparto, ajena de invención, menguada de estilo, pobre de concetos y falta de toda erudición y doctrina; sin acotaciones en las márgenes y sin anotaciones en el fin del libro, como veo que están otros libros, aunque sean fabulosos y profanos, tan llenos de sentencias de Aristóteles, de Platón y de toda la caterva de filósofos, que admiran a los leyentes, y tienen a sus autores por hombres leídos, eruditos y elocuentes? ¡Pues qué, cuando citan la Divina Escritura! No dirán sino que son unos santos Tomases y otros doctores de la Iglesia; guardando en esto un decoro tan ingenioso que en un renglón han pintado un enamorado distraído y en otro hacen un sermoncico cristiano, que es un contento y un regalo oílle o leelle. De todo esto ha de carecer mi libro, porque ni tengo qué acotar en el margen, ni qué anotar en el fin, ni menos sé qué autores sigo en él, para ponerlos al principio, como hacen todos, por las letras del A B C, comenzando en Aristóteles y acabando en Xenofonte y en Zoilo o Zeuxis, aunque fue maldiciente el uno y pintor el otro. También ha de carecer mi libro de sonetos al principio, a lo menos de sonetos cuyos autores sean duques, marqueses, condes, obispos, damas o poetas celebérrimos; aunque, si yo los pidiese a dos o tres oficiales amigos, yo sé que me los darían, y tales, que no les igualasen los de aquéllos que tienen más nombre en nuestra España. En fin, señor y amigo mío -proseguí-, yo determino que el señor don Quijote se quede sepultado en sus archivos en la Mancha, hasta que el cielo depare quien le adorne de tantas cosas como le faltan; porque yo me hallo incapaz de remediarlas, por mi insuficiencia y pocas letras, y porque naturalmente soy poltrón y perezoso de andarme buscando autores que digan lo que yo me sé decir sin ellos.

De aquí nace la suspensión y elevamiento en que me hallastes: bastante causa para ponerme en ella la que de mí habéis oído.»

Oyendo lo cual mi amigo, dándose una palmada en la frente y disparando en una larga risa, me dijo:

-Por Dios, hermano, que ahora me acabo de desengañar de un engaño en que he estado todo el mucho tiempo que ha que os conozco, en el cual siempre os he tenido por discreto y prudente en todas vuestras acciones. Pero agora veo que estáis tan lejos de serlo como lo está el cielo de la tierra. ¿Cómo que es posible que cosas de tan poco momento y tan fáciles de remediar puedan tener fuerzas de suspender y absortar un ingenio tan maduro como el vuestro, y tan hecho a romper y atropellar por otras dificultades mayores? A la fe, esto no nace de falta de habilidad, sino de sobra de pereza y penuria de discurso. ¿Queréis ver si es verdad lo que digo? Pues estadme atento y veréis cómo en un abrir y cerrar de ojos confundo todas vuestras dificultades, y remedio todas las faltas que decís que os suspenden y acobardan para dejar de sacar a la luz del mundo la historia de vuestro famoso don Quijote, luz y espejo de toda la caballería andante.

-Decid -le repliqué yo, oyendo lo que me decía-: ¿de qué modo pensáis llenar el vacío de mi temor y reducir a claridad el caos de mi confusión?

A lo cual él dijo:

-Lo primero en que reparáis de los sonetos, epigramas o elogios que os faltan para el principio, y que sean de personajes graves y de título, se puede remediar en que vos mesmo toméis algún trabajo en hacerlos, y después los podéis bautizar y poner el nombre que quisiéredes, ahijándolos al Preste Juan de las Indias o al Emperador de Trapisonda, de quien yo sé que hay noticia que fueron famosos poetas; y cuando no lo hayan sido y hubiere algunos pedantes y bachilleres que por detrás os muerdan y murmuren desta verdad, no se os dé dos maravedís; porque ya que os averigüen la mentira, no os han de cortar la mano con que lo escribistes.

En lo de citar en las márgenes los libros y autores de donde sacáredes las sentencias y dichos que pusiéredes en vuestra historia, no hay más sino hacer, de manera que venga a pelo, algunas sentencias o latines que vos sepáis de memoria, o, a lo menos, que os cuesten poco trabajo el buscallos, como será poner, tratando de libertad y cautiverio:

Non bene pro toto libertas venditur auro.

Y luego, en el margen, citar a Horacio, o a quien lo dijo. Si tratáredes del poder de la muerte, acudir luego con:

Pallida mors aequo pulsat pede pauperum tabernas,
Regumque turres.

Si de la amistad y amor que Dios manda que se tenga al enemigo, entraros luego al punto por la Escritura Divina, que lo podéis hacer con tantico de curiosidad, y decir las palabras, por lo menos, del mismo Dios: Ego autem dico vobis: diligite inimicos vestros. Si tratáredes de malos pensamientos, acudid con el Evangelio: De corde exeunt cogitationes malae. Si de la instabilidad de los amigos, ahí está Catón, que os dará su dístico:

Donec eris felix, multos numerabis amicos,
Tempora si fuerint nubila, solus eris.

Y con estos latinicos y otros tales os tendrán siquiera por gramático, que el serlo no es de poca honra y provecho el día de hoy.

En lo que toca al poner anotaciones al fin del libro, seguramente lo podéis hacer, desta manera: si nombráis algún gigante en vuestro libro, hacelde que sea el gigante Golías, y con sólo esto, que os costará casi nada, tenéis una grande anotación, pues podéis poner: El gigante Golías, o Goliat, fue un filisteo a quien el pastor David mató de una gran pedrada, en el valle de Terebinto, según se cuenta en el libro de los Reyes, en el capítulo que vos halláredes que se escribe.

Tras esto, para mostraros hombre erudito en letras humanas y cosmógrafo, haced de modo como en vuestra historia se nombre el río Tajo, y veréisos luego con otra famosa anotación, poniendo: El río Tajo fue así dicho por un rey de las Españas; tiene su nacimiento en tal lugar y muere en el mar Océano, besando los muros de la famosa ciudad de Lisboa, y es opinión que tiene las arenas de oro, etc. Si tratáredes de ladrones, yo os daré la historia de Caco, que la sé de coro; si de mujeres rameras, ahí está el obispo de Mondoñedo, que os prestará a Lamia, Laida y Flora, cuya anotación os dará gran crédito; si de crueles, Ovidio os entregará a Medea; si de encantadores y hechiceras, Homero tiene a Calipso, y Virgilio a Circe; si de capitanes valerosos, el mismo Julio César os prestará a sí mismo en sus Comentarios, y Plutarco os dará mil Alejandros. Si tratáredes de amores, con dos onzas que sepáis de la lengua toscana, toparéis con León Hebreo, que os hincha las medidas. Y si no queréis andaros por tierras extrañas, en vuestra casa tenéis a Fonseca, Del amor de Dios, donde se cifra todo lo que vos y el más ingenioso acertare a desearle en tal materia. En resolución, no hay más sino que vos procuréis nombrar estos nombres, o tocar en la vuestra estas historias que aquí he dicho, y dejadme a mí el cargo de poner las anotaciones y acotaciones; que yo os voto a tal de llenaros las márgenes y de gastar cuatro pliegos en el fin del libro.

Vengamos ahora a la citación de los autores que los otros libros tienen, que en el vuestro os faltan. El remedio que esto tiene es muy fácil, porque no habéis de hacer otra cosa que buscar un libro que los acote todos, desde la A hasta la Z, como vos decís. Pues ese mismo abecedario pondréis vos en vuestro libro; que, puesto que a la clara se vea la mentira, por la poca necesidad que vos teníades de aprovecharos dellos, no importa nada; y quizá alguno habrá tan simple que crea que de todos os habéis aprovechado en la simple y sencilla historia vuestra; y cuando no sirva de otra cosa, por lo menos servirá aquel largo catálogo de autores a dar de improviso autoridad al libro. Y más, que no habrá quien se ponga a averiguar si los seguistes o no los seguistes, no yéndole nada en ello. Cuanto más que, si bien caigo en la cuenta, este vuestro libro no tiene necesidad de ninguna cosa de aquéllas que vos decís que le faltan, porque todo él es una invectiva contra los libros de caballerías, de quien nunca se acordó Aristóteles, ni dijo nada San Basilio, ni alcanzó Cicerón; ni caen debajo de la cuenta de sus fabulosos disparates las puntualidades de la verdad, ni las observaciones de la Astrología; ni le son de importancia las medidas geométricas, ni la confutación de los argumentos de quien se sirve la retórica; ni tiene para qué predicar a ninguno, mezclando lo humano con lo divino, que es un género de mezcla de quien no se ha de vestir ningún cristiano entendimiento. Sólo tiene que aprovecharse de la imitación en lo que fuere escribiendo; que cuanto ella fuere más perfecta, tanto mejor será lo que se escribiere. Y, pues esta vuestra escritura no mira a más que a deshacer la autoridad y cabida que en el mundo y en el vulgo tienen los libros de caballerías, no hay para qué andéis mendigando sentencias de filósofos, consejos de la Divina Escritura, fábulas de poetas, oraciones de retóricos, milagros de santos, sino procurar que a la llana, con palabras significantes, honestas y bien colocadas, salga vuestra oración y período sonoro y festivo; pintando, en todo lo que alcanzáredes y fuere posible, vuestra intención; dando a entender vuestros conceptos sin intricarlos y escurecerlos. Procurad también que, leyendo vuestra historia el melancólico se mueva a risa, el risueño la acreciente, el simple no se enfade, el discreto se admire de la invención, el grave no la desprecie, ni el prudente deje de alabarla. En efecto, llevad la mira puesta a derribar la máquina mal fundada destos caballerescos libros, aborrecidos de tantos y alabados de muchos más; que si esto alcanzásedes, no habríades alcanzado poco.

Con silencio grande estuve escuchando lo que mi amigo me decía, y de tal manera se imprimieron en mí sus razones que, sin ponerlas en disputa, las aprobé por buenas y de ellas mismas quise hacer este prólogo, en el cual verás, lector suave, la discreción de mi amigo, la buena ventura mía en hallar en tiempo tan necesitado tal consejero, y el alivio tuyo en hallar tan sincera y tan sin revueltas la historia del famoso don Quijote de la Mancha, de quien hay opinión por todos los habitadores del distrito del campo de Montiel, que fue el más casto enamorado y el más valiente caballero que de muchos años a esta parte se vio en aquellos contornos. Yo no quiero encarecerte el servicio que te hago en darte a conocer tan noble y tan honrado caballero; pero quiero que me agradezcas el conocimiento que tendrás del famoso Sancho Panza, su escudero, en quien, a mi parecer, te doy cifradas todas las gracias escuderiles que en la caterva de los libros vanos de caballerías están esparcidas. Y con esto, Dios te dé salud, y a mí no olvide. Vale.
```

<a id="operaciones-sobre-ficheros-secuenciales-y-aleatorios"></a>
## Operaciones sobre ficheros secuenciales y aleatorios

En este capítulo, nos adentramos en las operaciones sobre ficheros secuenciales y aleatorios, dos tipos fundamentales de acceso a los datos almacenados en archivos. Comenzamos por entender la diferencia entre estos dos tipos de acceso.

Los ficheros secuenciales son aquellos en los que los datos se almacenan en orden lineal, y el acceso a ellos es secuencial, es decir, se leen o escriben desde el principio hasta el final del archivo. Este tipo de acceso es sencillo pero limitado, ya que no permite saltar directamente a cualquier posición dentro del fichero.

Por otro lado, los ficheros aleatorios permiten un acceso directo a cualquier registro dentro del archivo, lo que significa que se puede leer o escribir en cualquier lugar sin necesidad de recorrer el archivo desde el principio. Este tipo de acceso es más eficiente para operaciones que requieren acceso rápido a datos específicos.

Para trabajar con ficheros secuenciales en Python, utilizamos la clase `open()` junto con los métodos `read()`, `write()`, `readline()` y `writeline()`. Estos métodos nos permiten leer o escribir todo el contenido del archivo de una sola vez, lo que es adecuado para ficheros pequeños. Sin embargo, si intentamos usar estos métodos con archivos grandes, podríamos encontrarnos con problemas de rendimiento debido a la carga completa del contenido en memoria.

En contraste, los ficheros aleatorios requieren un acceso más complejo y se manejan mediante el uso de clases como `randomaccessfile` o bibliotecas específicas para este tipo de operaciones. En Python, no existe una clase nativa para trabajar con ficheros aleatorios, pero podemos simular su comportamiento utilizando la clase `open()` junto con los métodos `seek()`, `tell()` y `readline()`.

La función `seek()` nos permite mover el puntero del archivo a cualquier posición específica dentro del mismo, mientras que `tell()` devuelve la posición actual del puntero. Estas funciones son esenciales para realizar operaciones aleatorias en ficheros, ya que nos permiten saltar directamente a la posición donde se encuentra el dato que queremos leer o escribir.

Es importante tener en cuenta que trabajar con ficheros aleatorios puede ser más complejo y requiere un manejo cuidadoso de los punteros y las posiciones dentro del archivo. Además, es necesario tener en cuenta que no todos los tipos de datos pueden almacenarse directamente en un fichero aleatorio, ya que algunos tipos de datos requieren una estructura específica para su almacenamiento.

En resumen, tanto los ficheros secuenciales como los aleatorios tienen sus ventajas y desventajas. Los ficheros secuenciales son sencillos pero limitados, mientras que los ficheros aleatorios permiten un acceso directo a cualquier registro dentro del archivo, lo que es más eficiente para operaciones que requieren acceso rápido a datos específicos. En Python, podemos trabajar con ambos tipos de ficheros utilizando las clases `open()` y sus métodos correspondientes, aunque el manejo de ficheros aleatorios puede requerir un enfoque más complejo y cuidadoso.

Para profundizar en este tema, es recomendable experimentar con diferentes operaciones sobre ficheros secuenciales y aleatorios utilizando Python. Puedes crear archivos temporales para probar estas operaciones y observar cómo funcionan en la práctica. También puedes investigar bibliotecas específicas para trabajar con ficheros aleatorios si necesitas un acceso más avanzado a estos tipos de datos.

Al finalizar esta subunidad, deberías tener una comprensión sólida del manejo de ficheros secuenciales y aleatorios en Python, así como las ventajas y desventajas de cada tipo de acceso. Esta conocimiento es fundamental para trabajar con archivos grandes y complejos en aplicaciones prácticas.

### archivos secuenciales

```python
import os

try:
    os.mkdir("secuenciales")
except:
    pass

for i in range(0,100):
    archivo = open("secuenciales/cliente"+str(i)+".json",'w')
    archivo.write("texto del cliente")
    archivo.close()
```

### archivos hash table

```python
import os
import hashlib
import json

try:
    os.mkdir("hash")
except:
    pass

# Lista de personas ficticias
personas = [
    {
        "nombre": "Carlos",
        "apellido": "Martínez",
        "edad": 28,
        "ciudad": "Madrid",
        "profesion": "Ingeniero"
    },
    {
        "nombre": "Lucía",
        "apellido": "Fernández",
        "edad": 34,
        "ciudad": "Barcelona",
        "profesion": "Doctora"
    },
    {
        "nombre": "Andrés",
        "apellido": "García",
        "edad": 22,
        "ciudad": "Valencia",
        "profesion": "Estudiante"
    },
    {
        "nombre": "María",
        "apellido": "López",
        "edad": 41,
        "ciudad": "Sevilla",
        "profesion": "Arquitecta"
    },
    {
        "nombre": "Javier",
        "apellido": "Sánchez",
        "edad": 30,
        "ciudad": "Bilbao",
        "profesion": "Profesor"
    }
]

for persona in personas:
    cadena = persona['nombre']+persona['apellido']+str(persona['edad'])
    picadillo = hashlib.md5(cadena.encode()).hexdigest()
    print(picadillo)
    archivo = open("hash/"+picadillo+".json",'w')
    json.dump(persona,archivo,indent=4)
    archivo.close()

# Ahora busco entre esos hashes

cadena = "Lucía"+"Fernández"+"34"
picadillo = hashlib.md5(cadena.encode()).hexdigest()
archivo = open("hash/"+picadillo+".json",'r')
contenido = json.load(archivo)
print(contenido)

    
```

<a id="serializaciondeserializacion-de-objetos"></a>
## Serializacióndeserialización de objetos

La serialización y deserialización de objetos son procesos fundamentales en la programación orientada a objetos, permitiendo convertir los estados de un objeto en una forma que pueda ser almacenada o transmitida y luego recuperar ese estado para restaurar el objeto. En este contexto, se refiere a la transformación de un objeto en una secuencia de bytes (serialización) y viceversa (deserialización).

La serialización es el proceso de convertir un objeto en una representación persistente que puede ser almacenada en un archivo o transmitida a través de una red. Este proceso es crucial cuando se necesita mantener el estado de un objeto entre diferentes ejecuciones del programa, o cuando se desea compartir objetos entre diferentes componentes de una aplicación.

Deserialización, por otro lado, es el proceso inverso de la serialización. Consiste en tomar una secuencia de bytes que representan un objeto y reconstruir el objeto original a partir de esa secuencia. Este proceso es necesario para recuperar los objetos almacenados o transmitidos y utilizarlos nuevamente en el programa.

En Python, la biblioteca `pickle` proporciona métodos para serializar y deserializar objetos. El método `pickle.dumps()` se utiliza para serializar un objeto y convertirlo en una secuencia de bytes, mientras que el método `pickle.loads()` se utiliza para deserializar esa secuencia de bytes y restaurar el objeto original.

Es importante tener en cuenta que la serialización y deserialización pueden ser complejas si los objetos contienen referencias a otros objetos o recursos externos. En tales casos, es necesario implementar métodos personalizados para manejar estas situaciones correctamente.

Además, la seguridad de la serialización es un aspecto crucial, ya que puede permitir el acceso no autorizado a partes sensibles del programa si no se maneja adecuadamente. Por lo tanto, es recomendable utilizar técnicas seguras y verificar siempre los objetos deserializados para evitar posibles amenazas.

La serialización y deserialización de objetos son herramientas poderosas que permiten la persistencia y el intercambio de datos en aplicaciones orientadas a objetos. Al entender estos conceptos y cómo implementarlos correctamente, se puede mejorar significativamente la funcionalidad y la eficiencia de las aplicaciones desarrolladas.

En resumen, la serialización y deserialización de objetos son procesos esenciales en el manejo de datos en programación orientada a objetos. A través de métodos como `pickle.dumps()` y `pickle.loads()`, se pueden convertir los estados de los objetos en secuencias de bytes y viceversa, lo que facilita la persistencia y el intercambio de datos entre diferentes componentes de una aplicación. Es crucial entender estos conceptos y cómo implementarlos correctamente para mejorar la funcionalidad y la seguridad de las aplicaciones desarrolladas.

### serializacion

```python
import json

personas = [
    {
        "nombre": "Carlos",
        "apellido": "Martínez",
        "edad": 28,
        "ciudad": "Madrid",
        "profesion": "Ingeniero"
    },
    {
        "nombre": "Lucía",
        "apellido": "Fernández",
        "edad": 34,
        "ciudad": "Barcelona",
        "profesion": "Doctora"
    },
    {
        "nombre": "Andrés",
        "apellido": "García",
        "edad": 22,
        "ciudad": "Valencia",
        "profesion": "Estudiante"
    },
    {
        "nombre": "María",
        "apellido": "López",
        "edad": 41,
        "ciudad": "Sevilla",
        "profesion": "Arquitecta"
    },
    {
        "nombre": "Javier",
        "apellido": "Sánchez",
        "edad": 30,
        "ciudad": "Bilbao",
        "profesion": "Profesor"
    }
]

print(personas)
print(type(personas))
cadena = json.dumps(personas)
print(cadena)
print(type(cadena))

archivo = open("basededatos.dat",'w')
archivo.write(cadena)
archivo.close()




    
```

### desserializar

```python
import json

archivo = open("basededatos.dat",'r')
linea = archivo.readlines()[0]
print(linea)
print(type(linea))
archivo.close()

devuelta = json.loads(linea)
print(devuelta)
print(type(devuelta))




    
```

### basededatos

```
[{"nombre": "Carlos", "apellido": "Mart\u00ednez", "edad": 28, "ciudad": "Madrid", "profesion": "Ingeniero"}, {"nombre": "Luc\u00eda", "apellido": "Fern\u00e1ndez", "edad": 34, "ciudad": "Barcelona", "profesion": "Doctora"}, {"nombre": "Andr\u00e9s", "apellido": "Garc\u00eda", "edad": 22, "ciudad": "Valencia", "profesion": "Estudiante"}, {"nombre": "Mar\u00eda", "apellido": "L\u00f3pez", "edad": 41, "ciudad": "Sevilla", "profesion": "Arquitecta"}, {"nombre": "Javier", "apellido": "S\u00e1nchez", "edad": 30, "ciudad": "Bilbao", "profesion": "Profesor"}]
```

<a id="trabajo-con-ficheros"></a>
## Trabajo con ficheros

En este capítulo, nos adentramos en los fundamentos del manejo de ficheros, una habilidad esencial para cualquier programador que quiera interactuar con el sistema de archivos. Comenzamos por explorar las clases asociadas a las operaciones de gestión de ficheros, descubriendo cómo estas proporcionan una interfaz para crear, leer, escribir y eliminar archivos.

A medida que avanzamos, nos familiarizamos con los diferentes tipos de acceso a un fichero, cada uno con sus propias ventajas y limitaciones. Aprenderemos sobre las clases para gestión de flujos de datos desdehacia ficheros, lo que nos permitirá trabajar eficientemente con grandes cantidades de información.

El siguiente paso es aprender cómo realizar operaciones sobre ficheros secuenciales y aleatorios. Este conocimiento es crucial para optimizar el acceso a los datos, ya sea para leer o escribir información en un orden específico o directamente a una ubicación específica dentro del archivo.

La serialización y deserialización de objetos son técnicas avanzadas que nos permiten almacenar y recuperar objetos complejos en ficheros. Aprenderemos cómo convertir objetos en una forma que pueda ser guardada en el disco y luego reconstruirlos cuando sea necesario, lo que es fundamental para aplicaciones que manejan datos persistentes.

Trabajamos con ficheros esencialmente a través de excepciones, aprendiendo a detectar y tratar errores comunes durante la operación de lectura y escritura. Esto nos asegura que nuestras aplicaciones sean robustas y puedan manejar situaciones inesperadas sin caer en fallos.

Finalmente, desarrollamos habilidades para crear aplicaciones que utilizan ficheros. Aprenderemos a combinar todas las técnicas adquiridas hasta ahora para construir programas que pueden leer, escribir y gestionar información de manera eficiente y segura.

Este capítulo es una introducción integral al manejo de ficheros, proporcionando un sólido fundamento en el que se basarán futuras aplicaciones que requieran interactuar con el sistema de archivos.

### Introduccion

```python
Vamos a hacer un simulacro de conector a csv

clientes
nombre,apellidos,email,direccion
Jose Vicente,Carratala,info@jocarsa.com,La calle de Jose Vicente
```

### guardar datos en formato csv

```python
tupla = ("Jose Vicente","Carratala","info@jocarsa.com")

archivo = open("clientes.csv",'a')
cadena = ""
for campo in tupla:
  cadena += campo+","
archivo.write(tupla)
archivo.close()
```

### serializamos

```python
tupla = ("Jose Vicente","Carratala","info@jocarsa.com")

archivo = open("clientes.csv",'a')
cadena = ""
for campo in tupla:
  cadena += campo+","
archivo.write(cadena)
archivo.close()
```

### des serializar

```python
archivo = open("clientes.csv",'r')

linea = archivo.readline()
tupla = linea.split(",")
print(tupla)
print(type(tupla))
archivo.close()
```

### lo convierto en tupla

```python
archivo = open("clientes.csv",'r')

linea = archivo.readline()
tupla = linea.split(",")
print(tupla)
print(type(tupla))
tupla = tuple(tupla)
print(tupla)
print(type(tupla))
archivo.close()
```

### clase con dos metodos

```python
class GestorCSV:
    def __init__(self, archivo="clientes.csv"):
        self.archivo = archivo

    def escribir(self, tupla):
        """Escribe una tupla en el archivo CSV"""
        with open(self.archivo, 'a') as f:
            cadena = ",".join(tupla) + "\n"
            f.write(cadena)

    def leer(self):
        """Lee la primera línea del archivo CSV y la devuelve como tupla"""
        with open(self.archivo, 'r') as f:
            linea = f.readline().strip()
            if linea:  # para evitar errores si el archivo está vacío
                campos = linea.split(",")
                return tuple(campos)
            return ()

# Crear instancia
gestor = GestorCSV()

# Escribir una tupla
gestor.escribir(("Jose Vicente", "Carratala", "info@jocarsa.com"))

# Leer la primera línea como tupla
resultado = gestor.leer()
print(resultado)        # ('Jose Vicente', 'Carratala', 'info@jocarsa.com')
print(type(resultado))  # <class 'tuple'>
```

### repasar arbol de directorios recursivo

```python
import os

ruta = "/var/www/html/dam2526"

for directorio, subdirectorios, archivos in os.walk(ruta):
    print(f"Directorio: {directorio}")
    for sub in subdirectorios:
        print(f"  Subdirectorio: {sub}")
    for archivo in archivos:
        print(f"  Archivo: {archivo}")
```

### arbol de archivos y directorios

```python
import os

ruta = "/var/www/html/dam2526"

for directorio, subdirectorios, archivos in os.walk(ruta):
    # Calculate the level by counting separators relative to the root
    nivel = directorio.replace(ruta, "").count(os.sep)
    print(f"Directorio: {directorio} (nivel {nivel})")

    for sub in subdirectorios:
        print(f"{'  ' * (nivel+1)}Subdirectorio: {sub} (nivel {nivel+1})")

    for archivo in archivos:
        print(f"{'  ' * (nivel+1)}Archivo: {archivo} (nivel {nivel+1})")
```

### no quiero el subdirectorio

```python
import os

ruta = "/var/www/html/dam2526"

for directorio, subdirectorios, archivos in os.walk(ruta):
    # Calculate the level by counting separators relative to the root
    nivel = directorio.replace(ruta, "").count(os.sep)
    
    print(" "*nivel,directorio+" nivel "+str(nivel))


    for archivo in archivos:
        print(f"{'  ' * (nivel+1)}Archivo: {archivo} (nivel {nivel+1})")
```

### formateo

```python
import os

ruta = "/var/www/html/dam2526"

for directorio, subdirectorios, archivos in os.walk(ruta):
    # Calculate the level by counting separators relative to the root
    nivel = directorio.replace(ruta, "").count(os.sep)
    
    print("  "*nivel,directorio+" nivel "+str(nivel))


    for archivo in archivos:
        print((nivel+1)*"  "+archivo)
```

### archivo

```python
import os

ruta = "/var/www/html/dam2526"

for directorio, subdirectorios, archivos in os.walk(ruta):
    # Calculate the level by counting separators relative to the root
    nivel = directorio.replace(ruta, "").count(os.sep)
    
    print("  "*nivel,directorio.split("/")[-1])


    for archivo in archivos:
        print((nivel+1)*"  "+archivo)
```

### emojis

```python
import os

ruta = "/var/www/html/dam2526"

for directorio, subdirectorios, archivos in os.walk(ruta):
    # Calculate the level by counting separators relative to the root
    nivel = directorio.replace(ruta, "").count(os.sep)
    
    print("  "*nivel+"📁"+directorio.split("/")[-1])


    for archivo in archivos:
        print((nivel+1)*"  "+"📄"+archivo)
```

### metemos ascii

```python
import os

ruta = "/var/www/html/dam2526"

for directorio, subdirectorios, archivos in os.walk(ruta):
    # Calculate the level by counting separators relative to the root
    nivel = directorio.replace(ruta, "").count(os.sep)
    
    print("  "*nivel+"└📁"+directorio.split("/")[-1])


    for archivo in archivos:
        print((nivel+1)*"  "+"├📄"+archivo)
```

### metemos ascii vertical

```python
import os

ruta = "/var/www/html/dam2526"

for directorio, subdirectorios, archivos in os.walk(ruta):
    nivel = directorio.replace(ruta, "").count(os.sep)
    
    print("│ "*nivel+"├📁"+directorio.split("/")[-1])

    for archivo in archivos:
        print((nivel)*"│ "+"│  ├📄"+archivo)
```

### extendiendo

```python
import os
from typing import Iterable, Optional

def list_entries(path: str, show_hidden: bool = False) -> Iterable[os.DirEntry]:
    with os.scandir(path) as it:
        entries = [e for e in it if show_hidden or not e.name.startswith(".")]
    # Directories first, then files; case-insensitive
    entries.sort(key=lambda e: (e.is_file(), e.name.casefold()))
    return entries

def draw_tree(
    path: str,
    prefix: str = "",
    show_hidden: bool = False,
    max_depth: Optional[int] = None,
    _is_last: bool = True,
    _is_root: bool = True,
):
    name = os.path.basename(os.path.normpath(path)) or path
    elbow = "└─" if _is_last else "├─"
    icon = "📁"

    # Root line (no elbow for the very first line)
    if _is_root:
        print(f"{icon}{name}")
    else:
        print(f"{prefix}{elbow} {icon}{name}")

    # Stop if depth limit reached
    if max_depth is not None and max_depth <= 0:
        return

    # Child prefix: continues the vertical line if not the last sibling
    child_prefix = prefix + ("   " if _is_last else "│  ")

    try:
        entries = list_entries(path, show_hidden=show_hidden)
    except PermissionError:
        print(f"{child_prefix}└─ ⛔ (permiso denegado)")
        return
    except FileNotFoundError:
        print(f"{child_prefix}└─ ⚠️  (no encontrado)")
        return

    # Split dirs/files to print directories first (each will recurse)
    dirs = [e for e in entries if e.is_dir(follow_symlinks=False)]
    files = [e for e in entries if e.is_file(follow_symlinks=False)]
    others = [e for e in entries if not e.is_dir(follow_symlinks=False) and not e.is_file(follow_symlinks=False)]

    # Helper to print a flat node (file or "other")
    def print_leaf(entry: os.DirEntry, last: bool):
        leaf_elbow = "└─" if last else "├─"
        icon = "📄" if entry.is_file(follow_symlinks=False) else "🔗"  # symlink/other
        print(f"{child_prefix}{leaf_elbow} {icon}{entry.name}")

    # Recurse directories
    for i, d in enumerate(dirs):
        last = (i == len(dirs) - 1) and not files and not others
        draw_tree(
            d.path,
            prefix=child_prefix,
            show_hidden=show_hidden,
            max_depth=None if max_depth is None else max_depth - 1,
            _is_last=last,
            _is_root=False,
        )

    # Print files and others
    all_leaves = files + others
    for i, f in enumerate(all_leaves):
        last = (i == len(all_leaves) - 1)
        print_leaf(f, last)

# === Usage ===
ruta = "/var/www/html/dam2526"
draw_tree(ruta, show_hidden=False, max_depth=None)
```

### return en lugar de print

```python
import os
from typing import Iterable, Optional, List

def list_entries(path: str, show_hidden: bool = False) -> Iterable[os.DirEntry]:
    with os.scandir(path) as it:
        entries = [e for e in it if show_hidden or not e.name.startswith(".")]
    # Directories first, then files; case-insensitive
    entries.sort(key=lambda e: (e.is_file(), e.name.casefold()))
    return entries

def draw_tree(
    path: str,
    prefix: str = "",
    show_hidden: bool = False,
    max_depth: Optional[int] = None,
    _is_last: bool = True,
    _is_root: bool = True,
) -> List[str]:
    """
    Returns a list of strings that represent the tree of `path`.
    """
    lines = []

    name = os.path.basename(os.path.normpath(path)) or path
    elbow = "└─" if _is_last else "├─"
    icon = "📁"

    # Root line (no elbow for the very first line)
    if _is_root:
        lines.append(f"{icon}{name}")
    else:
        lines.append(f"{prefix}{elbow} {icon}{name}")

    # Stop if depth limit reached
    if max_depth is not None and max_depth <= 0:
        return lines

    child_prefix = prefix + ("   " if _is_last else "│  ")

    try:
        entries = list_entries(path, show_hidden=show_hidden)
    except PermissionError:
        lines.append(f"{child_prefix}└─ ⛔ (permiso denegado)")
        return lines
    except FileNotFoundError:
        lines.append(f"{child_prefix}└─ ⚠️  (no encontrado)")
        return lines

    dirs = [e for e in entries if e.is_dir(follow_symlinks=False)]
    files = [e for e in entries if e.is_file(follow_symlinks=False)]
    others = [e for e in entries if not e.is_dir(follow_symlinks=False) and not e.is_file(follow_symlinks=False)]

    # Recurse directories
    for i, d in enumerate(dirs):
        last = (i == len(dirs) - 1) and not files and not others
        lines.extend(
            draw_tree(
                d.path,
                prefix=child_prefix,
                show_hidden=show_hidden,
                max_depth=None if max_depth is None else max_depth - 1,
                _is_last=last,
                _is_root=False,
            )
        )

    # Print files and others
    all_leaves = files + others
    for i, f in enumerate(all_leaves):
        last = (i == len(all_leaves) - 1)
        leaf_elbow = "└─" if last else "├─"
        icon = "📄" if f.is_file(follow_symlinks=False) else "🔗"
        lines.append(f"{child_prefix}{leaf_elbow} {icon}{f.name}")

    return lines


# === Usage ===
ruta = "/var/www/html/dam2526"
tree_lines = draw_tree(ruta, show_hidden=False, max_depth=None)

# Print to screen
print("\n".join(tree_lines))

# Or save to file
with open("tree.txt", "w", encoding="utf-8") as f:
    f.write("\n".join(tree_lines))
```

### clientes

```
Jose Vicente,Carratala,info@jocarsa.com,Jose Vicente,Carratala,info@jocarsa.com
```

### tree

```
📁dam2526
   ├─ 📁Primero
   │  ├─ 📁Bases de datos
   │  │  ├─ 📁001-Almacenamiento de la información
   │  │  │  ├─ 📁001-Ficheros (planos, indexados, acceso directo, entre otros)
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-tipos de archivos.md
   │  │  │  │  │  ├─ 📄002-archivos de texto plano.txt
   │  │  │  │  │  ├─ 📄003-clientes.csv
   │  │  │  │  │  ├─ 📄004-clientes.json
   │  │  │  │  │  ├─ 📄005-clientes anidades.json
   │  │  │  │  │  ├─ 📄005-clientes anidados.json
   │  │  │  │  │  ├─ 📄006-clientes.xml
   │  │  │  │  │  ├─ 📄007-opendocument.odt
   │  │  │  │  │  └─ 📄008-clientes.ods
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Bases de datos. Conceptos, usos y tipos según el modelo de datos, la ubicación de la información
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📁001-Ejemplo empresa 1
   │  │  │  │  │     ├─ 📄clientes.csv
   │  │  │  │  │     ├─ 📄pedidos.csv
   │  │  │  │  │     └─ 📄productos.csv
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Sistemas gestores de base de datos Funciones, componentes y tipos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  ├─ 📄Contenidos básicos.md
   │  │  │  │  │  └─ 📄Introduccion.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄empresa.sqlite
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Bases de datos centralizadas y bases de datos distribuidas. Técnicas de fragmentación
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-Resumen.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Legislación sobre protección de datos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-Referencias de legislacion.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Big Data introducción, análisis de datos, inteligencia de negocios
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-Conceptos iniciales.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  ├─ 📄001-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁002-Bases de datos relacionales
   │  │  │  ├─ 📁001-Modelo de datos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-introduccion.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Terminología del modelo relacional
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-Introduccion.md
   │  │  │  │  │  ├─ 📄002-crear base de datos.sql
   │  │  │  │  │  ├─ 📄003-crear tabla de clientes.sql
   │  │  │  │  │  └─ 📄004-productos.sql
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Tipos de datos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-tipos de datos.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Claves primarias
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-definicion.md
   │  │  │  │  │  ├─ 📄002-altero tabla.sql
   │  │  │  │  │  └─ 📄003-altero tabla de productos.sql
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Restricciones de validación
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-restriccion de telefono.sql
   │  │  │  │  │  └─ 📄002-email.sql
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Índices. Características
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-El valor NULL
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-apellido null.sql
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁008-Claves ajenas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-Introduccion.md
   │  │  │  │  │  ├─ 📄002-crear pedidos.sql
   │  │  │  │  │  ├─ 📄003-clave foranea de pedidos a clientes.sql
   │  │  │  │  │  ├─ 📄004-clave foranea de pedidos a productos.sql
   │  │  │  │  │  └─ 📄005-insercion.sql
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁009-Vistas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-peticion inicial.sql
   │  │  │  │  │  ├─ 📄002-creo una vista.sql
   │  │  │  │  │  └─ 📄003-Comentarios.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁010-Usuarios. Privilegios
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-crear nuevo usuario con todos los permisos.sql
   │  │  │  │  │  └─ 📄002-crear un usuario limitado.sql
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁011-Lenguaje de descripción de datos (DDL)
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁012-Lenguaje de control de datos (DCL)
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  ├─ 📄001-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁003-Realización de consultas
   │  │  │  ├─ 📁001-Proyección, selección y ordenación de registros
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-Datos de ejemplo.sql
   │  │  │  │  │  ├─ 📄002-seleccion.sql
   │  │  │  │  │  ├─ 📄003-solo quiero ver los nombres.sql
   │  │  │  │  │  ├─ 📄004-selecciono colu,nas.sql
   │  │  │  │  │  ├─ 📄004-selecciono columnas.sql
   │  │  │  │  │  ├─ 📄005-alias.sql
   │  │  │  │  │  ├─ 📄006-volvemos a todo.sql
   │  │  │  │  │  ├─ 📄007-ordenamos por columna.sql
   │  │  │  │  │  ├─ 📄008-ascendiente.sql
   │  │  │  │  │  ├─ 📄009-descendiente.sql
   │  │  │  │  │  ├─ 📄010-varios criterios.sql
   │  │  │  │  │  ├─ 📄011-clausula where.sql
   │  │  │  │  │  ├─ 📄012-comodin de inicio.sql
   │  │  │  │  │  └─ 📄013-dos comodines.sql
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Operadores. Operadores de comparación. Operadores lógicos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-aritmeticos.sql
   │  │  │  │  │  ├─ 📄002-datos de ejemplo.sql
   │  │  │  │  │  ├─ 📄003-calculo del iva.sql
   │  │  │  │  │  ├─ 📄004-alias de columna.sql
   │  │  │  │  │  ├─ 📄005-sumo el total.sql
   │  │  │  │  │  ├─ 📄006-operadores de comparacion.sql
   │  │  │  │  │  ├─ 📄007-comparacion falsa.sql
   │  │  │  │  │  ├─ 📄008-condicion.sql
   │  │  │  │  │  ├─ 📄009-alias de columna.sql
   │  │  │  │  │  └─ 📄010-total con transporte.sql
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Consultas de resumen
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-resumen de suma.sql
   │  │  │  │  │  ├─ 📄002-resumen de total de pedidos.sql
   │  │  │  │  │  ├─ 📄003-promedio de lo que se gasta la gente en mi tienda.sql
   │  │  │  │  │  ├─ 📄004-pedido mas barato.sql
   │  │  │  │  │  ├─ 📄005-pedido mas caro.sql
   │  │  │  │  │  └─ 📄006-cuantos pedidos se han realizado.sql
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Agrupamiento de registros
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-seleccion de productos.sql
   │  │  │  │  │  ├─ 📄002-altero los clientes.sql
   │  │  │  │  │  ├─ 📄003-seleccion con agrupacion.sql
   │  │  │  │  │  └─ 📄004-seleccion con agrupacion ahora si.sql
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Composiciones internas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-seleccion basica de pedidos.sql
   │  │  │  │  │  ├─ 📄002-primer join con clientes.sql
   │  │  │  │  │  ├─ 📄003-vista de pedidos.sql
   │  │  │  │  │  ├─ 📄004-Descripcion del problema.md
   │  │  │  │  │  ├─ 📄005-Pedidos con lineas.sql
   │  │  │  │  │  ├─ 📄006-claves foraneas.sql
   │  │  │  │  │  ├─ 📄007-creamos pedido.sql
   │  │  │  │  │  ├─ 📄008-cruzamos tablas.sql
   │  │  │  │  │  ├─ 📄009-cruzamos con tabla clientes.sql
   │  │  │  │  │  ├─ 📄010-cruzamos con la tabla de lineas de pedido.sql
   │  │  │  │  │  ├─ 📄011-ajustamos la proyeccion.sql
   │  │  │  │  │  ├─ 📄012-cruzamos con productos.sql
   │  │  │  │  │  ├─ 📄013-calculos.sql
   │  │  │  │  │  └─ 📄014-sumatorio.sql
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Composiciones externas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Subconsultas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁008-Combinación de múltiples selecciones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁009-Optimización de consultas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  ├─ 📄001-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁004-Tratamiento de datos
   │  │  │  ├─ 📁001-Inserción, borrado y modificación de registros
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-Modelo CRUD.md
   │  │  │  │  │  ├─ 📄002-insercion.sql
   │  │  │  │  │  ├─ 📄003-que pasa si ponemos un campo de menos.sql
   │  │  │  │  │  ├─ 📄004-que pasa si pongo un campo de mas.sql
   │  │  │  │  │  ├─ 📄005-columnas nombradas.sql
   │  │  │  │  │  ├─ 📄006-modificacion de registros.sql
   │  │  │  │  │  ├─ 📄007-modificacion con un where.sql
   │  │  │  │  │  ├─ 📄008-eliminar registros.sql
   │  │  │  │  │  ├─ 📄009-eliminacion con condiciones.sql
   │  │  │  │  │  └─ 📄010-copia de seguridad de base de datos.sql
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Integridad referencial
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-intento de eliminar cliente 12.md
   │  │  │  │  │  ├─ 📄002-Opciones de integridad referencial.md
   │  │  │  │  │  ├─ 📄003-copia de seguridad.md
   │  │  │  │  │  ├─ 📄004-copia de seguridad pero con contraseña.md
   │  │  │  │  │  ├─ 📄005-copia de seguridad con python.py
   │  │  │  │  │  ├─ 📄006-copia con fecha.py
   │  │  │  │  │  ├─ 📄007-zerofill.py
   │  │  │  │  │  ├─ 📄008-cron.md
   │  │  │  │  │  ├─ 📄009-Caso ZIP.md
   │  │  │  │  │  ├─ 📄010-ahora comprimir.py
   │  │  │  │  │  ├─ 📄011-y borrar el sql.py
   │  │  │  │  │  ├─ 📄012-Motores de MySQL instalados.md
   │  │  │  │  │  ├─ 📄013-Instalacion de MySQL.md
   │  │  │  │  │  ├─ 📄014-creo cron.md
   │  │  │  │  │  ├─ 📄015-aplicacion mysql.py
   │  │  │  │  │  ├─ 📄016-tratamos las opciones.py
   │  │  │  │  │  ├─ 📄017-nos conectamos a MySQL.py
   │  │  │  │  │  ├─ 📄018-Desarrollo la parte de insercion de cliente.py
   │  │  │  │  │  ├─ 📄019-me aseguro.py
   │  │  │  │  │  ├─ 📄020-arranco un bucle infinito.py
   │  │  │  │  │  ├─ 📄021-Listado de clientes.py
   │  │  │  │  │  ├─ 📄022-Desarrollamos la parte de la eliminacion.py
   │  │  │  │  │  ├─ 📄backup.log
   │  │  │  │  │  ├─ 📄backup.py
   │  │  │  │  │  └─ 📄copia_de_seguridad.sql
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Subconsultas y composiciones en órdenes de edición
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Transacciones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Políticas de bloqueo. Concurrencia
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  ├─ 📄001-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁005-Programación de bases de datos
   │  │  │  ├─ 📁001-Introducción. Lenguaje de programación
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Variables del sistema y variables de usuario
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Funciones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Estructuras de control de flujo
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Procedimientos almacenados. Funciones de usuario
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Eventos y disparadores
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Excepciones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁008-Cursores
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  ├─ 📄001-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁006-Interpretación de Diagramas EntidadRelación
   │  │  │  ├─ 📁001-El modelo ER. Entidades y relaciones. Cardinalidades. Debilidad
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-El modelo ER ampliado. Generalización y especialización. Agregación
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Paso del diagrama ER al modelo relacional
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Restricciones semánticas del modelo relacional
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Normalización de modelos relacionales
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁101-Ejercicios
   │  │  │  ├─ 📁201-Criterios de evaluación
   │  │  │  │  └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  ├─ 📄001-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁007-Uso de bases de datos no relacionales
   │  │  │  ├─ 📁001-Características de las bases de datos no relacionales
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Tipos de bases de datos no relacionales
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Elementos de las bases de datos no relacionales
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Sistemas gestores de bases de datos no relacionales
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Herramientas de los sistemas gestores de bases de datos no relacionales para la gestión de la información almacenada
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  ├─ 📄001-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📄000-Resumen.md
   │  │  └─ 📄001-Resumen.md
   │  ├─ 📁Entornos de desarrollo
   │  │  ├─ 📁001-Desarrollo de software
   │  │  │  ├─ 📁001-Concepto de programa informático
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-Introduccion.md
   │  │  │  │  │  └─ 📄002-holamundo.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Código fuente, código objeto y código ejecutable; tecnologías de virtualización
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-Lenguaje interpretado.py
   │  │  │  │  │  ├─ 📄002-lenguaje compilado.cpp
   │  │  │  │  │  ├─ 📄003-virtualizacion.md
   │  │  │  │  │  ├─ 📄004-Resumen.md
   │  │  │  │  │  └─ 📄a.out
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Tipos de lenguajes de programación. Paradigmas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-Intoduccion.md
   │  │  │  │  │  └─ 📄002-Paradigmas.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Características de los lenguajes más difundidos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-Lenguajes más comunes hoy.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Fases del desarrollo de una aplicación análisis, diseño, codificación, pruebas, documentación, explotación y mantenimiento, entre otras
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-Introduccion.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Proceso de obtención de código ejecutable a partir del código fuente; herramientas implicadas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-Ejemplo en python.py
   │  │  │  │  │  ├─ 📄002-explicacion.md
   │  │  │  │  │  ├─ 📄003-hola mundo en C.c
   │  │  │  │  │  ├─ 📄004-Explicacion.md
   │  │  │  │  │  └─ 📄ejecutable.out
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Metodologías ágiles. Técnicas. Características
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-Metodologías ágiles.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁002-Instalación y uso de entornos de desarrollo
   │  │  │  ├─ 📁001-Funciones de un entorno de desarrollo
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-entornos de desarrollo.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Instalación de un entorno de desarrollo
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-Instalacion de visual studio.md
   │  │  │  │  │  └─ 📄002-Instalacion de netbeans.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Uso básico de un entorno de desarrollo
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-Uso basico.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Personalización del entorno de desarrollo temas, estilos de codificación, módulos y extensiones, entre otras
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-Personalizacion.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Edición de programas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄000-introduccion.md
   │  │  │  │  │  └─ 📄001-construyo un programa.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Generación de ejecutables en distintos entornos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-ejemplo en C
   │  │  │  │  │  ├─ 📄001-ejemplo en C.c
   │  │  │  │  │  └─ 📄002-Explicacion.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Herramientas y automatización
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-Herramientas.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁003-Diseño y realización de pruebas
   │  │  │  ├─ 📁001-Planificación de Pruebas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-Introduccion.md
   │  │  │  │  │  ├─ 📄002-operaciones.py
   │  │  │  │  │  └─ 📄003-encapsulacion a funcion.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Tipos de pruebas Funcionales, estructurales y regresión, entre otras
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-regresion.py
   │  │  │  │  │  ├─ 📄002-aumento la capacidad.py
   │  │  │  │  │  ├─ 📄003-arreglo para version anterior.py
   │  │  │  │  │  └─ 📄004-controlo todos los casos posibles.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Procedimientos y casos de prueba
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Pruebas de Código Cubrimiento, valores límite y clases de equivalencia, entre otras
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Pruebas unitarias; herramientas de automatización
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Documentación de las incidencias
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Dobles de prueba. Tipos. Características
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁004-Optimización y documentación
   │  │  │  ├─ 📁001-Refactorización
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📁__pycache__
   │  │  │  │  │  │  └─ 📄funciones.cpython-312.pyc
   │  │  │  │  │  ├─ 📄001-creo un programa sin funciones.py
   │  │  │  │  │  ├─ 📄002-codigo para cada una de las acciones.py
   │  │  │  │  │  ├─ 📄003-bucle infinito.py
   │  │  │  │  │  ├─ 📄004-funcion de eliminnar.py
   │  │  │  │  │  ├─ 📄005-extraccion a funcion.py
   │  │  │  │  │  ├─ 📄006-extraigo menu.py
   │  │  │  │  │  ├─ 📄007-extraigo los bloques.py
   │  │  │  │  │  ├─ 📄008-solucion global.py
   │  │  │  │  │  ├─ 📄009-extraer a archivo externo.py
   │  │  │  │  │  ├─ 📄010-partir en funciones.py
   │  │  │  │  │  ├─ 📄011-divido funciones.py
   │  │  │  │  │  ├─ 📄012-sigo dividiendo.py
   │  │  │  │  │  ├─ 📄013-sigo dividiendo mas.py
   │  │  │  │  │  └─ 📄funciones.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Analizadores de código
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Control de versiones. Estructura de las herramientas de control de versiones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁005-Elaboración de diagramas de clases
   │  │  │  ├─ 📁001-Repositorios remotos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Documentación. Uso de comentarios. Alternativas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Integración continua. Herramientas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁006-Elaboración de diagramas de comportamiento
   │  │  │  ├─ 📁001-Clases. Atributos, métodos y visibilidad
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Objetos. Instanciación
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Relaciones. Asociación, navegabilidad y multiplicidad. Herencia, composición, agregación. Realización y dependencia
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Notación de los diagramas de clases
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Herramientas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Generación automática de código. Ingeniería inversa
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📄000-Resumen.md
   │  │  └─ 📄001-Resumen.md
   │  ├─ 📁Lenguajes de marcas y sistemas de gestión de información
   │  │  ├─ 📁001-Reconocimiento de las características de lenguajes de marcas
   │  │  │  ├─ 📁001-Clasificación
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-Encabezados.md
   │  │  │  │  │  ├─ 📄002-Parrafos y saltos de linea.md
   │  │  │  │  │  ├─ 📄003-enfasis.md
   │  │  │  │  │  ├─ 📄004-Listas no ordenadas.md
   │  │  │  │  │  ├─ 📄005-Listas ordenadas.md
   │  │  │  │  │  ├─ 📄006-Hiperenlaces.md
   │  │  │  │  │  ├─ 📄007-Imágenes.md
   │  │  │  │  │  ├─ 📄008-Citas.md
   │  │  │  │  │  ├─ 📄009-Codigo en linea.md
   │  │  │  │  │  ├─ 📄010-bloque de codigo.md
   │  │  │  │  │  ├─ 📄011-Separadores.md
   │  │  │  │  │  ├─ 📄012-Tablas.md
   │  │  │  │  │  └─ 📄013-Documentación de un programa.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Características y ámbitos de aplicación
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-Crear webs con HTML.html
   │  │  │  │  │  ├─ 📄002-crear documentos con XML.xml
   │  │  │  │  │  ├─ 📄003-Markdown para crear documentos.md
   │  │  │  │  │  ├─ 📄004-CSS nos permite añadir estilo a HTML.html
   │  │  │  │  │  ├─ 📄005-JSON para guardar documentos.json
   │  │  │  │  │  ├─ 📄006-json anidado.json
   │  │  │  │  │  ├─ 📄007-SVG para crear gráficos.html
   │  │  │  │  │  └─ 📄009-Conclusiones que podemos extraer.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Estructura y sintaxis
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-Que es XML.md
   │  │  │  │  │  ├─ 📄002-declaracion.xml
   │  │  │  │  │  ├─ 📄003-etiquetas.xml
   │  │  │  │  │  ├─ 📄004-etiquetas anidadas.xml
   │  │  │  │  │  ├─ 📄005-atributos.xml
   │  │  │  │  │  └─ 📄006-comentarios.xml
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Herramientas de edición
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-Introducción.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Elaboración de documentos bien formados
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-documento bien formado.xml
   │  │  │  │  │  ├─ 📄002-elemento que no esta bien formado.xml
   │  │  │  │  │  ├─ 📄003-url del validador online.md
   │  │  │  │  │  ├─ 📄004-solucion con nodo raiz.xml
   │  │  │  │  │  ├─ 📄005-persona con xsd.xml
   │  │  │  │  │  └─ 📄006-validar xml.xsd
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Utilización de espacios de nombres
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-espacio de nombre persona.xml
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Ejercicio práctico
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Introduccion.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-persona.xml
   │  │  │  │  │  ├─ 📄002-telefono.xml
   │  │  │  │  │  ├─ 📄003-varios telefonos.xml
   │  │  │  │  │  ├─ 📄004-datos personales.xml
   │  │  │  │  │  ├─ 📄005-experiencias.xml
   │  │  │  │  │  ├─ 📄006-muchas experiencias.xml
   │  │  │  │  │  └─ 📄007-titulos.xml
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  ├─ 📄001-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁002-Utilización de lenguajes de marcas en entornos web
   │  │  │  ├─ 📁001-Estándares web. Versiones. Clasificación
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Estructura de un documento HTML
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  ├─ 📄001-Introduccion.md
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-documento.html
   │  │  │  │  │  ├─ 📄002-etiquetas html.html
   │  │  │  │  │  ├─ 📄003-lenguage.html
   │  │  │  │  │  ├─ 📄004-cabeza y cuerpo.html
   │  │  │  │  │  ├─ 📄005-titulo.html
   │  │  │  │  │  └─ 📄006-codificacion.html
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Identificación de etiquetas y atributos de HTML
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📁001-Ejercicio 1
   │  │  │  │  │  │  ├─ 📄001-titulos.html
   │  │  │  │  │  │  ├─ 📄002-documento con varios titulo.html
   │  │  │  │  │  │  ├─ 📄003-parrafos.html
   │  │  │  │  │  │  ├─ 📄004-estructura inicial de la web.html
   │  │  │  │  │  │  ├─ 📄005-cabecera.html
   │  │  │  │  │  │  ├─ 📄006-etiqueta principal.html
   │  │  │  │  │  │  ├─ 📄007-pie de pagina.html
   │  │  │  │  │  │  ├─ 📄008-titulo de la web.html
   │  │  │  │  │  │  ├─ 📄009-subtitulo de la web.html
   │  │  │  │  │  │  ├─ 📄010-etiqueta de navegacion.html
   │  │  │  │  │  │  ├─ 📄011-lista no ordenada.html
   │  │  │  │  │  │  ├─ 📄012-anchor.html
   │  │  │  │  │  │  ├─ 📄013-secciones.html
   │  │  │  │  │  │  ├─ 📄014-identificadores.html
   │  │  │  │  │  │  ├─ 📄015-parrafo.html
   │  │  │  │  │  │  ├─ 📄016-imagenes.html
   │  │  │  │  │  │  ├─ 📄017-creamos un formulario.html
   │  │  │  │  │  │  ├─ 📄018-etiqueta.html
   │  │  │  │  │  │  ├─ 📄019-campo de texto.html
   │  │  │  │  │  │  ├─ 📄020-campo de texto de area.html
   │  │  │  │  │  │  ├─ 📄021-marco.html
   │  │  │  │  │  │  ├─ 📄022-div como contenedor generico.html
   │  │  │  │  │  │  ├─ 📄023-article.html
   │  │  │  │  │  │  ├─ 📄024-un poco de contenido al pie de pagina.html
   │  │  │  │  │  │  ├─ 📄025-meta autor.html
   │  │  │  │  │  │  ├─ 📄026-meta descripcion.html
   │  │  │  │  │  │  └─ 📄josevicente.jpeg
   │  │  │  │  │  └─ 📁002-Ejercicio 2
   │  │  │  │  │     ├─ 📄001-tablas.html
   │  │  │  │  │     ├─ 📄002-etiqueta tabla.html
   │  │  │  │  │     ├─ 📄003-cabeza y cuerpo de la tabla.html
   │  │  │  │  │     ├─ 📄004-fila de tabla.html
   │  │  │  │  │     ├─ 📄005-cabecera de columna.html
   │  │  │  │  │     ├─ 📄006-fila de tabla.html
   │  │  │  │  │     └─ 📄007-tantas filas como quiera.html
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Herramientas de diseño web
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Hojas de estilo (CSS)
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📁001-Ejercicio 1
   │  │  │  │  │  │  ├─ 📄001-tipos de estilo.html
   │  │  │  │  │  │  ├─ 📄002-estilo en linea.html
   │  │  │  │  │  │  ├─ 📄002-estilo interno.html
   │  │  │  │  │  │  ├─ 📄003-estilo interno.html
   │  │  │  │  │  │  ├─ 📄004-estilo externo.html
   │  │  │  │  │  │  ├─ 📄005-estilo de la web.html
   │  │  │  │  │  │  ├─ 📄006-cambiar el color de fondo.html
   │  │  │  │  │  │  ├─ 📄007-Cambiar el color del frente.html
   │  │  │  │  │  │  ├─ 📄008-familias de fuentes predeterminadas.html
   │  │  │  │  │  │  ├─ 📄009-fuente personalizada.html
   │  │  │  │  │  │  ├─ 📄010-segunda fuente personalizada.html
   │  │  │  │  │  │  ├─ 📄011-color blanco en los contenedores.html
   │  │  │  │  │  │  ├─ 📄012-geometrica-anchura.html
   │  │  │  │  │  │  ├─ 📄013-centrar con margin auto.html
   │  │  │  │  │  │  ├─ 📄014-margen interior.html
   │  │  │  │  │  │  ├─ 📄015-alineacion del texto.html
   │  │  │  │  │  │  ├─ 📄016-tamaño del texto.html
   │  │  │  │  │  │  ├─ 📄017-peso de la fuente.html
   │  │  │  │  │  │  ├─ 📄018-anulo estilos por defecto.html
   │  │  │  │  │  │  ├─ 📄019-tipo de lista.html
   │  │  │  │  │  │  ├─ 📄020-estilo de los hipervinculos.html
   │  │  │  │  │  │  ├─ 📄021-los hipervinculos como botones.html
   │  │  │  │  │  │  ├─ 📄022-clases y estilos de clases.html
   │  │  │  │  │  │  ├─ 📄023-anchura de los contenedores.html
   │  │  │  │  │  │  ├─ 📄024-gap.html
   │  │  │  │  │  │  ├─ 📄025-flex columna.html
   │  │  │  │  │  │  ├─ 📄026-maqueto los enlaces.html
   │  │  │  │  │  │  ├─ 📄026-maqueto pie de pagina.html
   │  │  │  │  │  │  ├─ 📄027-centro los elementos.html
   │  │  │  │  │  │  ├─ 📄028-maqueto los enlaces.html
   │  │  │  │  │  │  ├─ 📄029-framework grid.html
   │  │  │  │  │  │  ├─ 📄030-estilo de los articulos.html
   │  │  │  │  │  │  ├─ 📄031-grid tambien acepta gap.html
   │  │  │  │  │  │  ├─ 📄032-contenido de las secciones.html
   │  │  │  │  │  │  ├─ 📄033-flex para las secciones.html
   │  │  │  │  │  │  ├─ 📄estilo.css
   │  │  │  │  │  │  ├─ 📄josevicente.jpeg
   │  │  │  │  │  │  └─ 📄port1.jpg
   │  │  │  │  │  └─ 📁002-Ejercicio 2
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Validación de documentos HTML y CSS
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-Introduccion.md
   │  │  │  │  │  ├─ 📄034-correccion sobre la validacion.html
   │  │  │  │  │  ├─ 📄035-corregimos la familia de la fuente.html
   │  │  │  │  │  ├─ 📄036-las imagenes tienen que tener alt.html
   │  │  │  │  │  └─ 📄037-Segunda validación realizada.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Lenguajes de marcas para la sindicación de contenidos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-RSS.md
   │  │  │  │  │  ├─ 📄002-sitemap.md
   │  │  │  │  │  ├─ 📄sindicacion.rss
   │  │  │  │  │  └─ 📄sitemap.xml
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  ├─ 📄001-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁003-Manipulación de documentos Web
   │  │  │  ├─ 📁001-Lenguajes de script de cliente. Características y sintaxis básica. Estándares
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-index.html
   │  │  │  │  │  ├─ 📄002-javascript interno.html
   │  │  │  │  │  ├─ 📄003-comentarios.html
   │  │  │  │  │  ├─ 📄004-comentarios multilinea.html
   │  │  │  │  │  ├─ 📄005-salidas por consola y por documento.html
   │  │  │  │  │  ├─ 📄006-entradas.html
   │  │  │  │  │  ├─ 📄007-operadores aritmeticos.html
   │  │  │  │  │  ├─ 📄008-operadores de comparacion.html
   │  │  │  │  │  ├─ 📄009-operadores logicos.html
   │  │  │  │  │  ├─ 📄010-declaracion de variables.html
   │  │  │  │  │  ├─ 📄011-salidas de variables.html
   │  │  │  │  │  ├─ 📄012-variar variables.html
   │  │  │  │  │  ├─ 📄013-declaracion de constantes.html
   │  │  │  │  │  ├─ 📄014-error al reasignar valor.html
   │  │  │  │  │  ├─ 📄015-operadores de incremento.html
   │  │  │  │  │  ├─ 📄016-operadores aritméticos abreviados.html
   │  │  │  │  │  ├─ 📄017-estructura for de bucle.html
   │  │  │  │  │  ├─ 📄018-while.html
   │  │  │  │  │  ├─ 📄019-if en la edad.html
   │  │  │  │  │  ├─ 📄020-clausula else.html
   │  │  │  │  │  ├─ 📄021-if else.html
   │  │  │  │  │  ├─ 📄022-switch.html
   │  │  │  │  │  ├─ 📄023-arrays.html
   │  │  │  │  │  ├─ 📄024-funciones.html
   │  │  │  │  │  ├─ 📄025-llamada a la funcion.html
   │  │  │  │  │  ├─ 📄026-un parametro.html
   │  │  │  │  │  ├─ 📄027-muchos parametros.html
   │  │  │  │  │  ├─ 📄028-las funciones deben hacer return.html
   │  │  │  │  │  ├─ 📄029-clases.html
   │  │  │  │  │  ├─ 📄030-instanciar un gato.html
   │  │  │  │  │  ├─ 📄031-podemos tener metodos.html
   │  │  │  │  │  └─ 📄032-demostracion javascript.html
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Selección y acceso a elementos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Creación y modificación de elementos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Eliminación de elementos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Manipulación de estilos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  ├─ 📄001-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁004-Definición de esquemas y vocabularios en lenguajes de marcas
   │  │  │  ├─ 📁001-Tecnologías para la definición de documentos. Estructura y sintaxis
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Creación de descripciones de documentos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Asociación de descripciones con documentos. Validación
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Herramientas de creación y validación
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  ├─ 📄001-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁005-Conversión y adaptación de documentos para el intercambio de información
   │  │  │  ├─ 📁001-Tecnologías de transformación de documentos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Descripción de la estructura y de la sintaxis
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Creación y utilización de plantillas. Herramientas y depuración
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Conversión entre diferentes formatos de documentos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  ├─ 📄001-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁006-Almacenamiento de información
   │  │  │  ├─ 📁001-Sistemas de almacenamiento de información. Características. Tecnologías
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Lenguajes de consulta y manipulación en documentos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Consulta y manipulación de información
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Importación y exportación de bases de datos relacionales en diferentes formatos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Herramientas de tratamiento y almacenamiento de información en sistemas nativos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Almacenamiento y manipulación de información en sistemas nativos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  ├─ 📄001-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁007-Sistemas de gestión empresarial
   │  │  │  ├─ 📁001-Aplicaciones de gestión empresarial. Tipos. Características
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Instalación
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Administración y configuración
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Integración de módulos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Mecanismos de acceso seguro a la información. Roles y privilegios
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Elaboración de informes
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Exportación de información
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁008-Elaboración de documentación
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  ├─ 📄001-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📄000-Resumen.md
   │  │  └─ 📄001-Resumen.md
   │  ├─ 📁Programación
   │  │  ├─ 📁001-Identificación de los elementos de un programa informático
   │  │  │  ├─ 📁001-Estructura y bloques fundamentales
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-Descarga de Python.md
   │  │  │  │  │  ├─ 📄001-Salida.py
   │  │  │  │  │  ├─ 📄002-entrada.py
   │  │  │  │  │  ├─ 📄003-comentarios de tipo docstring.py
   │  │  │  │  │  ├─ 📄004-Comentarios de una linea.py
   │  │  │  │  │  └─ 📄005-Estructura recomendada de los programas.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Variables
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-Contenedor de informacion.py
   │  │  │  │  │  ├─ 📄002-varias variables.py
   │  │  │  │  │  └─ 📄003-reglas de declaracion.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Tipos de datos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-diferentes tipos de datos.py
   │  │  │  │  │  ├─ 📄002-conversion de tipo de dato implicita.py
   │  │  │  │  │  └─ 📄003-conversión explicita de los datos.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Literales
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-literales de cadena.py
   │  │  │  │  │  └─ 📄002-literales numericos.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Constantes
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-Las constantes no deberian cambiar.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Operadores y expresiones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-operadores aritmeticos.py
   │  │  │  │  │  ├─ 📄002-operadores de comparacion.py
   │  │  │  │  │  ├─ 📄003-Operadores aritmeticos abreviados.py
   │  │  │  │  │  └─ 📄004-booleanos.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁002-Utilización de objetos
   │  │  │  ├─ 📁001-Características de los objetos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄000-Nota importante.md
   │  │  │  │  │  └─ 📄001-Características.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Instanciación de objetos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄000-Nota importante.md
   │  │  │  │  │  └─ 📄001-importamos math.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Utilización de métodos. Parámetros
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄000-Nota importante.md
   │  │  │  │  │  ├─ 📄001-Metodos de un objeto.py
   │  │  │  │  │  └─ 📄002-ejemplo más esparcido.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Utilización de propiedades
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄000-Nota importante.md
   │  │  │  │  │  └─ 📄001-tiene propiedades.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Utilización de métodos estáticos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄000-Nota importante.md
   │  │  │  │  │  ├─ 📄001-instanciacion.py
   │  │  │  │  │  └─ 📄002-no instancio estatico.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Constructores
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄000-Nota importante.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Destrucción de objetos y liberación de memoria
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄000-Nota importante.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁003-Uso de estructuras de control
   │  │  │  ├─ 📁001-Estructuras de selección
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-programacion paso a paso.py
   │  │  │  │  │  ├─ 📄002-estructura if.py
   │  │  │  │  │  ├─ 📄003-else.py
   │  │  │  │  │  ├─ 📄004-else if.py
   │  │  │  │  │  ├─ 📄005-entrada.py
   │  │  │  │  │  └─ 📄006-simulacro de actividad.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Estructuras de repetición
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-for.py
   │  │  │  │  │  ├─ 📄002-primera anidacion.py
   │  │  │  │  │  ├─ 📄003-segunda anidacion.py
   │  │  │  │  │  ├─ 📄004-while.py
   │  │  │  │  │  └─ 📄005-le tenemos que decir cual es el final.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Estructuras de salto
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-break.py
   │  │  │  │  │  ├─ 📄002-mi primera funcion.py
   │  │  │  │  │  ├─ 📄003-ejecuto la funcion.py
   │  │  │  │  │  ├─ 📄004-parametros.py
   │  │  │  │  │  ├─ 📄005-varios parametros.py
   │  │  │  │  │  └─ 📄006-las funciones deben retornar.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Control de excepciones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-dvision legal.py
   │  │  │  │  │  ├─ 📄002-division por cero.py
   │  │  │  │  │  └─ 📄003-try.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Aserciones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-asercion.py
   │  │  │  │  │  └─ 📄002-si que hay un error.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Prueba, depuración y documentación de la aplicación
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📁__pycache__
   │  │  │  │  │  │  └─ 📄funciondividir.cpython-312.pyc
   │  │  │  │  │  ├─ 📄001-division.py
   │  │  │  │  │  ├─ 📄002-prueba de carga.py
   │  │  │  │  │  ├─ 📄003-correccion.py
   │  │  │  │  │  ├─ 📄004-mas pruebas.py
   │  │  │  │  │  ├─ 📄005-documentacion.py
   │  │  │  │  │  ├─ 📄006-llamada a la funcion.py
   │  │  │  │  │  └─ 📄funciondividir.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Ejercicio
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁004-Desarrollo de clases
   │  │  │  ├─ 📁001-Concepto de clase
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-codigo sin reutilizacion.py
   │  │  │  │  │  ├─ 📄002-funciones para encapsular.py
   │  │  │  │  │  ├─ 📄003-parametros de la funcion.py
   │  │  │  │  │  ├─ 📄004-clases.py
   │  │  │  │  │  ├─ 📄005-creo un primer gato.py
   │  │  │  │  │  └─ 📄006-puedo crear los gatos que quiera.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Estructura y miembros de una clase. Visibilidad
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-miembros.py
   │  │  │  │  │  ├─ 📄002-visibilidad de los miembros.py
   │  │  │  │  │  └─ 📄003-propiedad privada.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Creación de propiedades
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-propiedades.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Creación de métodos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-metodo miau.py
   │  │  │  │  │  ├─ 📄002-funcion con return.py
   │  │  │  │  │  ├─ 📄003-setter.py
   │  │  │  │  │  ├─ 📄004-seteando sin control.py
   │  │  │  │  │  ├─ 📄005-control en el set.py
   │  │  │  │  │  └─ 📄006-getter edad.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Creación de constructores
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-constructor.py
   │  │  │  │  │  ├─ 📄002-constructor con parameteros.py
   │  │  │  │  │  └─ 📄003-no todos los parametros en el constructor.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Utilización de clases y objetos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-Multiples instancias.py
   │  │  │  │  │  ├─ 📄002-ejercicio practico clientes.py
   │  │  │  │  │  ├─ 📄003-ahora introduccion por el usuario.py
   │  │  │  │  │  ├─ 📄004-print cliente.py
   │  │  │  │  │  └─ 📄005-recorrer claves.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Utilización de clases heredadas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-clase gato.py
   │  │  │  │  │  ├─ 📄002-clase perro.py
   │  │  │  │  │  ├─ 📄003-clase madre.py
   │  │  │  │  │  ├─ 📄004-usando la clase madre.py
   │  │  │  │  │  ├─ 📄005-Roca.py
   │  │  │  │  │  ├─ 📄006-nivel superior de herencia.py
   │  │  │  │  │  ├─ 📄007-Ejercicio acumulativo.py
   │  │  │  │  │  ├─ 📄007-Enunciado.md
   │  │  │  │  │  ├─ 📄008-metodos.py
   │  │  │  │  │  ├─ 📄009-clases hijas.py
   │  │  │  │  │  └─ 📄010-continuamos con el ejercicio.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁005-Lectura y escritura de información
   │  │  │  ├─ 📁001-Flujos. Tipos bytes y caracteres. Clases relacionadas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-flujo de caracteres.py
   │  │  │  │  │  ├─ 📄002-leer.py
   │  │  │  │  │  ├─ 📄003-uso de pickle para binario.py
   │  │  │  │  │  ├─ 📄004-pickle para leer.py
   │  │  │  │  │  ├─ 📄cliente.bin
   │  │  │  │  │  └─ 📄clientes.txt
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Ficheros de datos. Registros
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-escribir un txt.py
   │  │  │  │  │  ├─ 📄002-escribir un csv.py
   │  │  │  │  │  ├─ 📄003-creo un diccionario y lo guardo como json.py
   │  │  │  │  │  ├─ 📄004-agenda de clientes.py
   │  │  │  │  │  ├─ 📄005-actuar en cada caso.py
   │  │  │  │  │  ├─ 📄006-para definir un cliente creo una clase.py
   │  │  │  │  │  ├─ 📄007-y creo una lista de clientes.py
   │  │  │  │  │  ├─ 📄008-añado un elemento a la lista.py
   │  │  │  │  │  ├─ 📄009-Meto al usuario en un bucle infinito.py
   │  │  │  │  │  ├─ 📄010-listamos clientes.py
   │  │  │  │  │  ├─ 📄011-limpiar la pantalla.py
   │  │  │  │  │  ├─ 📄012-guardar clientes.py
   │  │  │  │  │  ├─ 📄013-cuando abro el programa carga la lista de clientes.py
   │  │  │  │  │  ├─ 📄014-estetica de la consola.py
   │  │  │  │  │  ├─ 📄015-funciones.py
   │  │  │  │  │  ├─ 📄clientes.bin
   │  │  │  │  │  ├─ 📄clientes.csv
   │  │  │  │  │  └─ 📄clientes.json
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Apertura y cierre de ficheros. Modos de acceso. Escritura y lectura de información en ficheros
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-apertura de escritura.py
   │  │  │  │  │  ├─ 📄002-apertura de apendizaje.py
   │  │  │  │  │  ├─ 📄003-bajada de linea.py
   │  │  │  │  │  ├─ 📄004-abrir archivo para leer UNA linea.py
   │  │  │  │  │  ├─ 📄005-ahora quiero leer todas las lineas.py
   │  │  │  │  │  ├─ 📄006-recorro la lista.py
   │  │  │  │  │  ├─ 📄007-escribo en modo binario.py
   │  │  │  │  │  ├─ 📄008-leo de un archivo binario.py
   │  │  │  │  │  ├─ 📄009-guardar en formato xml.py
   │  │  │  │  │  ├─ 📄010-conexion rapida con bases de datos.py
   │  │  │  │  │  ├─ 📄011-Recojo información y la llevo a MySQL.py
   │  │  │  │  │  ├─ 📄clientes.txt
   │  │  │  │  │  └─ 📄clientes.xml
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Utilización de los sistemas de ficheros
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  ├─ 📁201-Criterios de evaluación
   │  │  │  │  │  └─ 📄Criterios de evaluación.md
   │  │  │  │  └─ 📄000-Resumen.md
   │  │  │  ├─ 📁005-Creación y eliminación de ficheros y directorios
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Entrada desde teclado. Salida a pantalla. Formatos de visualización
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Interfaces gráficas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁008-Concepto de evento
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁009-Creación de controladores de eventos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁Carpeta sin título
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁006-Aplicación de las estructuras de almacenamiento
   │  │  │  ├─ 📁001-Estructuras estáticas y dinámicas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Creación de matrices (arrays)
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Matrices (arrays) multidimensionales
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Genericidad
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Cadenas de caracteres. Expresiones regulares
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Colecciones Listas, Conjuntos y Diccionarios
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Operaciones agregadas filtrado, reducción y recolección
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁007-Utilización avanzada de clases
   │  │  │  ├─ 📁001-Composición de clases
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Herencia y polimorfismo
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Jerarquía de clases Superclases y subclases
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Clases y métodos abstractos y finales
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Interfaces
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Sobreescritura de métodos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Constructores y herencia
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁008-Mantenimiento de la persistencia de los objetos
   │  │  │  ├─ 📁001-Bases de datos orientadas a objetos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Características de las bases de datos orientadas a objetos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Instalación del gestor de bases de datos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Creación de bases de datos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Mecanismos de consulta
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-El lenguaje de consultas sintaxis, expresiones, operadores
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Recuperación, modificación y borrado de información
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁008-Tipos de datos objeto; atributos y métodos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁009-Tipos de datos colección
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁009-Gestión de bases de datos
   │  │  │  ├─ 📁001-Acceso a bases de datos. Estándares. Características
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Establecimiento de conexiones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Almacenamiento, recuperación, actualización y eliminación de información en bases de datos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📄000-Resumen.md
   │  │  ├─ 📄001-Identificación de los elementos de un programa informático.zip
   │  │  └─ 📄001-Resumen.md
   │  ├─ 📁Proyecto intermodular
   │  │  ├─ 📁001-Búsqueda de información
   │  │  │  ├─ 📁001-Identificar empresas representativas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-Empresas representativas.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁002-Estructura de las empresas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-Las empresas que hay en el sector.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁003-Caracteristicas de los departamentos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-caracteristicas de los departamentos.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁004-Funciones de cada departamento
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-funciones de los departamentos.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁005-Evaluacion del volumen de negocio
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-Volumen de negocio a futuro.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁006-Estrategia para dar respuesta a las demandas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-Que necesitan las empresas.md
   │  │  │  │  │  └─ 📄002-Sector educativo.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁007-Valoracion de recursos humanos y materiales
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-Necesidades de recursos.md
   │  │  │  │  │  └─ 📄002-arranque minimo.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁008-Realización de seguimiento
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁009-Desarrollo sostenible
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  └─ 📁010-Conexion intermodular
   │  │  │     ├─ 📁001-Contenidos básicos
   │  │  │     │  └─ 📄001-Introduccion.md
   │  │  │     ├─ 📁101-Ejercicios
   │  │  │     │  ├─ 📄001-flask.py
   │  │  │     │  ├─ 📄002-arrancar flask.py
   │  │  │     │  ├─ 📄003-ahora arranco el servidor.py
   │  │  │     │  ├─ 📄004-ahora imprimo html real.py
   │  │  │     │  ├─ 📄005-html completo.py
   │  │  │     │  ├─ 📄006-ademas puedo poner css.py
   │  │  │     │  ├─ 📄007-contenido dinamico.py
   │  │  │     │  ├─ 📄008-calendario con python y html.py
   │  │  │     │  ├─ 📄009-ahora hago un for de dias.py
   │  │  │     │  ├─ 📄010-el poder del css.py
   │  │  │     │  ├─ 📄011-usamos grid.py
   │  │  │     │  ├─ 📄012-ahora quiero todo el año.py
   │  │  │     │  ├─ 📄013-creo un tablero de ajedrez.py
   │  │  │     │  ├─ 📄014-celdas declaracion.py
   │  │  │     │  ├─ 📄015-un poco de css aunque poco legal.py
   │  │  │     │  ├─ 📄016-grid en el body.py
   │  │  │     │  ├─ 📄017-condicional.py
   │  │  │     │  ├─ 📄018-regla diferente en cada fila.py
   │  │  │     │  └─ 📄019-comentarios en el ejercicio.py
   │  │  │     └─ 📄Archivo sin título
   │  │  ├─ 📁002-Selección de un servicio o producto
   │  │  │  ├─ 📁001-Identificar las necesidades
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁002-Plantear posibles soluciones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁003-Información relativa a las soluciones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁004-Aspectos innovadores
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁005-Estudio de viabilidad técnica
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁006-Partes del proyecto
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁007-Recursos materiales y humanos necesarios
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁008-Realización de presupuestos económicos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁009-Documentación para el diseño
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁010-Aspectos sobre la calidad del proyecto
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  └─ 📁011-Presentación en público de las ideas más relevantes
   │  │  │     ├─ 📁001-Contenidos básicos
   │  │  │     │  └─ 📄001-Contenidos básicos.md
   │  │  │     ├─ 📁101-Ejercicios
   │  │  │     └─ 📁201-Criterios de evaluación
   │  │  │        └─ 📄001-Criterios de evaluación.md
   │  │  ├─ 📁003-Propuesta de empresa spin off
   │  │  │  ├─ 📁001-Temporalización de las secuencias de las actividades
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁002-Determinacion de recursos y logistica de cada actividad
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁003-Permisos y autorizaciones necesarios
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁004-Actividades que implican riesgos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁005-PRL
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁006-Recursos materiales y humanos de cada actividad
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁007-Posibles imprevistos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  └─ 📁008-Documentación necesaria
   │  │  │     ├─ 📁001-Contenidos básicos
   │  │  │     │  └─ 📄001-Contenidos básicos.md
   │  │  │     ├─ 📁101-Ejercicios
   │  │  │     └─ 📁201-Criterios de evaluación
   │  │  │        └─ 📄001-Criterios de evaluación.md
   │  │  ├─ 📁004-Relacion de unidad de empresa
   │  │  │  ├─ 📁001-Procedimiento de seguimiento de las actividades
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁002-Verificación de la calidad de los resultados de las actividades
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁003-Identificación de posibles desviaciones en planificación
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁004-Información de posibles desviaciones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁005-Solución y documentación de las desviaciones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  └─ 📁006-Definición y elaboración de documentación
   │  │  │     ├─ 📁001-Contenidos básicos
   │  │  │     │  └─ 📄001-Contenidos básicos.md
   │  │  │     ├─ 📁101-Ejercicios
   │  │  │     └─ 📁201-Criterios de evaluación
   │  │  │        └─ 📄001-Criterios de evaluación.md
   │  │  ├─ 📁005-Transmision de informacion
   │  │  │  ├─ 📁001-Actitud ordenada y metódica
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁002-Transmisión de información horizontal y vertical
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  ├─ 📁003-Uso de medios informáticos para transmitijr información
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄001-Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄001-Criterios de evaluación.md
   │  │  │  └─ 📁004-Términos técnicos en otras lenguajes estándares del sector
   │  │  │     ├─ 📁001-Contenidos básicos
   │  │  │     │  └─ 📄001-Contenidos básicos.md
   │  │  │     ├─ 📁101-Ejercicios
   │  │  │     └─ 📁201-Criterios de evaluación
   │  │  │        └─ 📄001-Criterios de evaluación.md
   │  │  ├─ 📄000-Resumen.md
   │  │  └─ 📄001-Resumen.md
   │  ├─ 📁Sistemas informáticos
   │  │  ├─ 📁001-Explotación de sistemas microinformáticos
   │  │  │  ├─ 📁001-Placas base. Formatos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-Introduccion.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Estructura y componentes procesador
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-Introduccion.md
   │  │  │  │  │  ├─ 📄equipo.blend
   │  │  │  │  │  └─ 📄equipo.blend1
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Normas de seguridad y prevención de riesgos laborales
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-Introduccion.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Características de las redes. Ventajas e inconvenientes
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-Introduccion.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Tipos de redes
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-Introduccion.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Componentes de una red informática
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-Intoduccion.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Topologías de red
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📁Carpeta sin título
   │  │  │  │  │  ├─ 📄001-Introduccion.md
   │  │  │  │  │  ├─ 📄002-perspectiva general de ciclos formativos.md
   │  │  │  │  │  └─ 📄ejemplo de topologia de red de edificio.svg
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁008-Tipos de cableado. Conectores
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-Tipos de cableado.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁009-Mapa físico y lógico de una red local
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  ├─ 📄001-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁002-Instalación de sistemas operativos
   │  │  │  ├─ 📁001-Evolución histórica y clasificación
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-Breve historia de la informatica.md
   │  │  │  │  │  ├─ 📄002-informacion de mi ordenador.py
   │  │  │  │  │  ├─ 📄system_report.json
   │  │  │  │  │  └─ 📄system_report.txt
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Funciones de un sistema operativo
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-funciones.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Tipos de sistemas operativos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-Principales SSOO actuales.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Tipos de aplicaciones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Licencias y tipos de licencias
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-Tipos de licencias.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Procedimiento de instalación
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-Instalacion de sistemas operativos.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Gestores de arranque. Configuración y reparación
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁008-Tecnologías de virtualización. Tipos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-Introduccion.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁009-Consideraciones previas a la instalación de sistemas operativos libres y propietarios
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  └─ 📄001-Introduccion.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁010-Instalación de sistemas operativos libres y propietarios. Requisitos, versiones y licencias
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-Introduccion.md
   │  │  │  │  │  ├─ 📄002-Proceso de instalacion.md
   │  │  │  │  │  ├─ 📄003-inicio de sesion.md
   │  │  │  │  │  ├─ 📄004-inicio de sesion remoto.md
   │  │  │  │  │  └─ 📄005-Instalar un servidor web en el servidor.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁011-Instalación  desinstalación de aplicaciones. Requisitos, versiones y licencias
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁012-Actualización y recuperación de sistemas operativos y aplicaciones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁013-Documentación de la instalación y de las incidencias detectadas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  ├─ 📄001-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁003-Gestión de la información
   │  │  │  ├─ 📁001-Gestión de sistemas de archivos mediante comandos y entornos gráficos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Estructura de directorios de sistemas operativos libres y propietarios
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Búsqueda de información del sistema mediante comandos y herramientas gráficas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Identificación del software instalado mediante comandos y herramientas gráficas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Realización y restauración de copias de seguridad
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Herramientas de administración de discos. Particiones y volúmenes. Desfragmentación y chequeo. Cifrado
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Tareas automáticas. Planificación
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  ├─ 📄001-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁004-Configuración de sistemas operativos
   │  │  │  ├─ 📁001-Configuración de usuarios y grupos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Seguridad de cuentas de usuario
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Seguridad de contraseñas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Acceso a recursos. Permisos locales. Listas de control de acceso
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Servicios y procesos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Comandos de sistemas operativos libres y propietarios
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Herramientas de monitorización del sistema. Registros y logs
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  ├─ 📄001-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁005-Conexión de sistemas en red
   │  │  │  ├─ 📁001-Configuración del protocolo TCPIP en un cliente de red. Direcciones IP
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Ficheros de configuración de red
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Gestión de puertos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Resolución de problemas de conectividad en sistemas operativos en red. Herramientas de diagnóstico
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Monitorización de redes
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Protocolos TCPIP
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁008-Configuración de los adaptadores de red en sistemas operativos libres y propietarios
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁009-Interconexión de redes adaptadores de red y dispositivos de interconexión. Enrutamiento
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁010-Redes cableadas. Tipos y características. Adaptadores de red. Conmutadores, enrutadores, entre otros. Seguridad
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁011-Redes inalámbricas. Tipos y características. Adaptadores. Dispositivos de interconexión. Seguridad
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁012-Seguridad de comunicaciones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁013-Tecnologías de acceso a redes de área extensa
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  ├─ 📄001-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁006-Gestión de recursos en una red
   │  │  │  ├─ 📁001-Permisos y derechos. Permisos de red. Permisos locales. Herencia. Listas de control de acceso
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Configuración de recursos compartidos. Permisos de acceso y directivas de seguridad
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Requisitos de seguridad del sistema y de los datos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Servidores de ficheros
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Servidores de impresión
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Servidores de aplicaciones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Técnicas de conexión remota
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁008-Cortafuegos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁009-Implantación y explotación de dominios
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  ├─ 📄001-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁007-Explotación de aplicaciones informáticas de propósito general
   │  │  │  ├─ 📁001-Software tipos, requisitos, licencias
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Herramientas ofimáticas y de trabajo colaborativo
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Utilidades de propósito general antimalware
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  ├─ 📄001-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📄000-Resumen.md
   │  │  └─ 📄001-Resumen.md
   │  ├─ 📄000-Resumen.md
   │  ├─ 📄001-Resumen.md
   │  └─ 📄Contenidos básicos.md
   ├─ 📁Segundo
   │  ├─ 📁Acceso a datos
   │  │  ├─ 📁001-Manejo de ficheros
   │  │  │  ├─ 📁001-Clases asociadas a las operaciones de gestión de ficheros
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-grabar y leer de txt.py
   │  │  │  │  │  ├─ 📄002-trabajar con archivos csv.py
   │  │  │  │  │  ├─ 📄003-escribir y leer json.py
   │  │  │  │  │  ├─ 📄agenda.json
   │  │  │  │  │  ├─ 📄clientes.txt
   │  │  │  │  │  └─ 📄datos.csv
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Formas de acceso a un fichero. Ventajas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-leer y escribir modo texto.py
   │  │  │  │  │  └─ 📄clientes.txt
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Clases para gestión de flujos de datos desdehacia ficheros
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📁aplicacionweb
   │  │  │  │  │  │  ├─ 📁__pycache__
   │  │  │  │  │  │  │  └─ 📄coder.cpython-312.pyc
   │  │  │  │  │  │  ├─ 📁static
   │  │  │  │  │  │  │  ├─ 📄app.js
   │  │  │  │  │  │  │  └─ 📄style.css
   │  │  │  │  │  │  ├─ 📁templates
   │  │  │  │  │  │  │  └─ 📄index.html
   │  │  │  │  │  │  ├─ 📄app.py
   │  │  │  │  │  │  └─ 📄coder.py
   │  │  │  │  │  ├─ 📄001-flujo con la libreria.py
   │  │  │  │  │  ├─ 📄002-flujo mejor con libreria.py
   │  │  │  │  │  ├─ 📄003-Usar pickle para guardar objetos.py
   │  │  │  │  │  ├─ 📄004-pixel.py
   │  │  │  │  │  ├─ 📄005-todos los pixeles de la imagen.py
   │  │  │  │  │  ├─ 📄006-recorro.py
   │  │  │  │  │  ├─ 📄007-escribir.py
   │  │  │  │  │  ├─ 📄008-guardar como png.py
   │  │  │  │  │  ├─ 📄009-nueva imagen.py
   │  │  │  │  │  ├─ 📄010-recorro los caracteres.py
   │  │  │  │  │  ├─ 📄011-agrupamos en grupos de 3.py
   │  │  │  │  │  ├─ 📄011-agrupamos en grupos de e.py
   │  │  │  │  │  ├─ 📄012-letras a ascii.py
   │  │  │  │  │  ├─ 📄012-letras a ascoo.py
   │  │  │  │  │  ├─ 📄013-guardo los pixeles.py
   │  │  │  │  │  ├─ 📄014-anchura de la imagen.py
   │  │  │  │  │  ├─ 📄015-tamanio dinamico de la imagen.py
   │  │  │  │  │  ├─ 📄016-argumentos de consola.py
   │  │  │  │  │  ├─ 📄017-argumentos limpios.py
   │  │  │  │  │  ├─ 📄018-leer.py
   │  │  │  │  │  ├─ 📄019-leer letras una a una.py
   │  │  │  │  │  ├─ 📄020-encadeno a cadena.py
   │  │  │  │  │  ├─ 📄021-encoder.py
   │  │  │  │  │  ├─ 📄022-decoder.py
   │  │  │  │  │  ├─ 📄023-supercodificador.py
   │  │  │  │  │  ├─ 📄clientes.bin
   │  │  │  │  │  ├─ 📄datos.bin
   │  │  │  │  │  ├─ 📄josevicente.jpeg
   │  │  │  │  │  ├─ 📄josevicente2.jpeg
   │  │  │  │  │  ├─ 📄josevicente2.png
   │  │  │  │  │  ├─ 📄mensaje.png
   │  │  │  │  │  ├─ 📄mensajeholamundo.png
   │  │  │  │  │  ├─ 📄prueba1.png
   │  │  │  │  │  ├─ 📄prueba2.png
   │  │  │  │  │  ├─ 📄prueba3.png
   │  │  │  │  │  └─ 📄texto.txt
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Operaciones sobre ficheros secuenciales y aleatorios
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📁hash
   │  │  │  │  │  │  ├─ 📄0687b03de690e567ef79ee62dc716954.json
   │  │  │  │  │  │  ├─ 📄66b2568e38fa4d19a0322e44d48c1817.json
   │  │  │  │  │  │  ├─ 📄9aefb0820c44ab901f40a66dec7c7547.json
   │  │  │  │  │  │  ├─ 📄e0d64a874001dc12be899f84f5648377.json
   │  │  │  │  │  │  └─ 📄ec074aae5526a3080be7eb6d5643ee2b.json
   │  │  │  │  │  ├─ 📁secuenciales
   │  │  │  │  │  │  ├─ 📄cliente0.json
   │  │  │  │  │  │  ├─ 📄cliente1.json
   │  │  │  │  │  │  ├─ 📄cliente10.json
   │  │  │  │  │  │  ├─ 📄cliente11.json
   │  │  │  │  │  │  ├─ 📄cliente12.json
   │  │  │  │  │  │  ├─ 📄cliente13.json
   │  │  │  │  │  │  ├─ 📄cliente14.json
   │  │  │  │  │  │  ├─ 📄cliente15.json
   │  │  │  │  │  │  ├─ 📄cliente16.json
   │  │  │  │  │  │  ├─ 📄cliente17.json
   │  │  │  │  │  │  ├─ 📄cliente18.json
   │  │  │  │  │  │  ├─ 📄cliente19.json
   │  │  │  │  │  │  ├─ 📄cliente2.json
   │  │  │  │  │  │  ├─ 📄cliente20.json
   │  │  │  │  │  │  ├─ 📄cliente21.json
   │  │  │  │  │  │  ├─ 📄cliente22.json
   │  │  │  │  │  │  ├─ 📄cliente23.json
   │  │  │  │  │  │  ├─ 📄cliente24.json
   │  │  │  │  │  │  ├─ 📄cliente25.json
   │  │  │  │  │  │  ├─ 📄cliente26.json
   │  │  │  │  │  │  ├─ 📄cliente27.json
   │  │  │  │  │  │  ├─ 📄cliente28.json
   │  │  │  │  │  │  ├─ 📄cliente29.json
   │  │  │  │  │  │  ├─ 📄cliente3.json
   │  │  │  │  │  │  ├─ 📄cliente30.json
   │  │  │  │  │  │  ├─ 📄cliente31.json
   │  │  │  │  │  │  ├─ 📄cliente32.json
   │  │  │  │  │  │  ├─ 📄cliente33.json
   │  │  │  │  │  │  ├─ 📄cliente34.json
   │  │  │  │  │  │  ├─ 📄cliente35.json
   │  │  │  │  │  │  ├─ 📄cliente36.json
   │  │  │  │  │  │  ├─ 📄cliente37.json
   │  │  │  │  │  │  ├─ 📄cliente38.json
   │  │  │  │  │  │  ├─ 📄cliente39.json
   │  │  │  │  │  │  ├─ 📄cliente4.json
   │  │  │  │  │  │  ├─ 📄cliente40.json
   │  │  │  │  │  │  ├─ 📄cliente41.json
   │  │  │  │  │  │  ├─ 📄cliente42.json
   │  │  │  │  │  │  ├─ 📄cliente43.json
   │  │  │  │  │  │  ├─ 📄cliente44.json
   │  │  │  │  │  │  ├─ 📄cliente45.json
   │  │  │  │  │  │  ├─ 📄cliente46.json
   │  │  │  │  │  │  ├─ 📄cliente47.json
   │  │  │  │  │  │  ├─ 📄cliente48.json
   │  │  │  │  │  │  ├─ 📄cliente49.json
   │  │  │  │  │  │  ├─ 📄cliente5.json
   │  │  │  │  │  │  ├─ 📄cliente50.json
   │  │  │  │  │  │  ├─ 📄cliente51.json
   │  │  │  │  │  │  ├─ 📄cliente52.json
   │  │  │  │  │  │  ├─ 📄cliente53.json
   │  │  │  │  │  │  ├─ 📄cliente54.json
   │  │  │  │  │  │  ├─ 📄cliente55.json
   │  │  │  │  │  │  ├─ 📄cliente56.json
   │  │  │  │  │  │  ├─ 📄cliente57.json
   │  │  │  │  │  │  ├─ 📄cliente58.json
   │  │  │  │  │  │  ├─ 📄cliente59.json
   │  │  │  │  │  │  ├─ 📄cliente6.json
   │  │  │  │  │  │  ├─ 📄cliente60.json
   │  │  │  │  │  │  ├─ 📄cliente61.json
   │  │  │  │  │  │  ├─ 📄cliente62.json
   │  │  │  │  │  │  ├─ 📄cliente63.json
   │  │  │  │  │  │  ├─ 📄cliente64.json
   │  │  │  │  │  │  ├─ 📄cliente65.json
   │  │  │  │  │  │  ├─ 📄cliente66.json
   │  │  │  │  │  │  ├─ 📄cliente67.json
   │  │  │  │  │  │  ├─ 📄cliente68.json
   │  │  │  │  │  │  ├─ 📄cliente69.json
   │  │  │  │  │  │  ├─ 📄cliente7.json
   │  │  │  │  │  │  ├─ 📄cliente70.json
   │  │  │  │  │  │  ├─ 📄cliente71.json
   │  │  │  │  │  │  ├─ 📄cliente72.json
   │  │  │  │  │  │  ├─ 📄cliente73.json
   │  │  │  │  │  │  ├─ 📄cliente74.json
   │  │  │  │  │  │  ├─ 📄cliente75.json
   │  │  │  │  │  │  ├─ 📄cliente76.json
   │  │  │  │  │  │  ├─ 📄cliente77.json
   │  │  │  │  │  │  ├─ 📄cliente78.json
   │  │  │  │  │  │  ├─ 📄cliente79.json
   │  │  │  │  │  │  ├─ 📄cliente8.json
   │  │  │  │  │  │  ├─ 📄cliente80.json
   │  │  │  │  │  │  ├─ 📄cliente81.json
   │  │  │  │  │  │  ├─ 📄cliente82.json
   │  │  │  │  │  │  ├─ 📄cliente83.json
   │  │  │  │  │  │  ├─ 📄cliente84.json
   │  │  │  │  │  │  ├─ 📄cliente85.json
   │  │  │  │  │  │  ├─ 📄cliente86.json
   │  │  │  │  │  │  ├─ 📄cliente87.json
   │  │  │  │  │  │  ├─ 📄cliente88.json
   │  │  │  │  │  │  ├─ 📄cliente89.json
   │  │  │  │  │  │  ├─ 📄cliente9.json
   │  │  │  │  │  │  ├─ 📄cliente90.json
   │  │  │  │  │  │  ├─ 📄cliente91.json
   │  │  │  │  │  │  ├─ 📄cliente92.json
   │  │  │  │  │  │  ├─ 📄cliente93.json
   │  │  │  │  │  │  ├─ 📄cliente94.json
   │  │  │  │  │  │  ├─ 📄cliente95.json
   │  │  │  │  │  │  ├─ 📄cliente96.json
   │  │  │  │  │  │  ├─ 📄cliente97.json
   │  │  │  │  │  │  ├─ 📄cliente98.json
   │  │  │  │  │  │  └─ 📄cliente99.json
   │  │  │  │  │  ├─ 📄001-archivos secuenciales.py
   │  │  │  │  │  └─ 📄002-archivos hash table.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Serializacióndeserialización de objetos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-serializacion.py
   │  │  │  │  │  ├─ 📄002-desserializar.py
   │  │  │  │  │  └─ 📄basededatos.dat
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Trabajo con ficheros
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-Introduccion.py
   │  │  │  │  │  ├─ 📄002-guardar datos en formato csv.py
   │  │  │  │  │  ├─ 📄003-serializamos.py
   │  │  │  │  │  ├─ 📄004-des serializar.py
   │  │  │  │  │  ├─ 📄005-lo convierto en tupla.py
   │  │  │  │  │  ├─ 📄006-clase con dos metodos.py
   │  │  │  │  │  ├─ 📄007-repasar arbol de directorios recursivo.py
   │  │  │  │  │  ├─ 📄008-arbol de archivos y directorios.py
   │  │  │  │  │  ├─ 📄009-no quiero el subdirectorio.py
   │  │  │  │  │  ├─ 📄010-formateo.py
   │  │  │  │  │  ├─ 📄011-archivo.py
   │  │  │  │  │  ├─ 📄012-emojis.py
   │  │  │  │  │  ├─ 📄013-metemos ascii.py
   │  │  │  │  │  ├─ 📄014-metemos ascii vertical.py
   │  │  │  │  │  ├─ 📄015-extendiendo.py
   │  │  │  │  │  ├─ 📄016-return en lugar de print.py
   │  │  │  │  │  └─ 📄clientes.csv
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Excepciones detección y tratamiento
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁008-Desarrollo de aplicaciones que utilizan ficheros
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁002-Manejo de conectores
   │  │  │  ├─ 📁001-El desfase objeto-relacional
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📁__pycache__
   │  │  │  │  │  │  └─ 📄jvorm.cpython-312.pyc
   │  │  │  │  │  ├─ 📄001-Introduccion.md
   │  │  │  │  │  ├─ 📄002-clientes.py
   │  │  │  │  │  ├─ 📄003-sacamos la estructura del objeto.py
   │  │  │  │  │  ├─ 📄004-recorremos el objeto.py
   │  │  │  │  │  ├─ 📄005-importamos mysql.py
   │  │  │  │  │  ├─ 📄006-creo un listado de campos.py
   │  │  │  │  │  ├─ 📄007-lanzo la consulta a la base de datos.py
   │  │  │  │  │  ├─ 📄008-tabla referenciada.py
   │  │  │  │  │  ├─ 📄009-y ahora tambien metemos los datos.py
   │  │  │  │  │  ├─ 📄010-recursivo.py
   │  │  │  │  │  ├─ 📄011-lector.py
   │  │  │  │  │  ├─ 📄012-demostracion clase.py
   │  │  │  │  │  ├─ 📄013-uso de la clase.py
   │  │  │  │  │  ├─ 📄datos.json
   │  │  │  │  │  ├─ 📄dump_recuperado.json
   │  │  │  │  │  └─ 📄jvorm.py
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Protocolos de acceso a bases de datos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Establecimiento de conexiones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Ejecución de sentencias de descripción de datos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Ejecución de sentencias de modificación de datos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Ejecución de consultas. Manipulación del resultado
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Ejecución de procedimientos almacenados en la base de datos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁008-Gestión de transacciones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁009-Desarrollo de programas que utilizan bases de datos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁003-Herramientas de mapeo objeto relacional (ORM)
   │  │  │  ├─ 📁001-Concepto de mapeo objeto relacional
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Características de las herramientas ORM
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Instalación de una herramienta ORM. Configuración
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Estructura de un fichero de mapeo
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Mapeo basado en anotaciones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Clases persistentes
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Sesiones; estados de un objeto
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁008-Carga, almacenamiento y modificación de objetos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁009-Consultas SQL
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁010-Gestión de transacciones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁011-Desarrollo de programas que utilizan bases de datos a través de herramientas ORM
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁004-Bases de datos objeto relacionales y orientadas a objetos
   │  │  │  ├─ 📁001-Gestores de bases de datos objeto relacionales
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Gestión de objetos con SQL; ANSI SQL
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Acceso a las funciones del gestor de base de datos objeto-relacional
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Gestores de bases de datos orientadas a objetos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Gestión de la persistencia de objetos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-El interfaz de programación de aplicaciones de la base de datos orientada a objetos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Gestión de transacciones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁008-Desarrollo de programas que gestionan objetos en bases de datos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁005-Bases de datos documentales
   │  │  │  ├─ 📁001-Bases de datos documentales nativas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Establecimiento y cierre de conexiones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Colecciones y documentos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Creación y borrado de colecciones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Añadir, modificar y eliminar documentos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Lenguajes de consulta. Realización de consultas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Desarrollo de programas que utilizan bases de datos documentales
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁006-Programación de componentes de acceso a datos
   │  │  │  ├─ 📁001-Concepto de componente
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Propiedades y atributos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Eventos; asociación de acciones a eventos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Persistencia del componente
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Herramientas para desarrollo de componentes
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Desarrollo, empaquetado y utilización de componentes
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  └─ 📄000-Resumen.md
   │  ├─ 📁Desarrollo de interfaces
   │  │  ├─ 📁001-Generación de interfaces de usuario
   │  │  │  ├─ 📁001-Patrones de arquitectura de las aplicaciones gráficas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Librerías de componentes nativas y multiplataforma
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-revision de componentes.html
   │  │  │  │  │  ├─ 📄002-componentes de formulario.html
   │  │  │  │  │  ├─ 📄003-meters.html
   │  │  │  │  │  ├─ 📄004-sugerencias para un input.html
   │  │  │  │  │  ├─ 📄005-Resultados calculados.html
   │  │  │  │  │  ├─ 📄006-detalles y sumario.html
   │  │  │  │  │  ├─ 📄007-agrupar campos.html
   │  │  │  │  │  ├─ 📄008-campo select.html
   │  │  │  │  │  ├─ 📄009-textarea.html
   │  │  │  │  │  ├─ 📄010-range.html
   │  │  │  │  │  ├─ 📄011-boton con input.html
   │  │  │  │  │  ├─ 📄012-boton de verdad.html
   │  │  │  │  │  └─ 📄013-Form como contenedor.html
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Herramientas propietarias y libres de edición de interfaces
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-interfaz inicial.html
   │  │  │  │  │  ├─ 📄002-maquetar.html
   │  │  │  │  │  ├─ 📄003-comportamiento.html
   │  │  │  │  │  ├─ 📄004-recorro el for.html
   │  │  │  │  │  ├─ 📄005-boton de generar html.html
   │  │  │  │  │  ├─ 📄006-nombre id y clase.html
   │  │  │  │  │  ├─ 📄007-mejora de los estilos.html
   │  │  │  │  │  └─ 📄008-mejora de funcionalidades.html
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Lenguajes descriptivos para la definición de interfaces
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-componente basico.html
   │  │  │  │  │  ├─ 📄002-aplico estilo.html
   │  │  │  │  │  ├─ 📄003-animar control.html
   │  │  │  │  │  ├─ 📄004-propiedades y sombras.html
   │  │  │  │  │  ├─ 📄006-centrar siempre.html
   │  │  │  │  │  └─ 📄007-js para componentes.html
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Componentes características y campo de aplicación
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Enlace de componentes a orígenes de datos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-json inicial.html
   │  │  │  │  │  ├─ 📄002-tomo el primer elemento del json.html
   │  │  │  │  │  └─ 📄003-poblar los datos.html
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Asociación de acciones a eventos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁008-Edición del código generado por la herramienta de diseño
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-grafica.html
   │  │  │  │  │  ├─ 📄002-primera grafica.html
   │  │  │  │  │  ├─ 📄003-estilo de la barra.html
   │  │  │  │  │  ├─ 📄004-empiezo a encapsular.html
   │  │  │  │  │  ├─ 📄005-creo un objeto de datos.html
   │  │  │  │  │  ├─ 📄006-encapsulo en funcion.html
   │  │  │  │  │  ├─ 📄007-mas origenes de datos.html
   │  │  │  │  │  ├─ 📄008-y si le pongo color.html
   │  │  │  │  │  ├─ 📄009-en cierta forma un espacio de nombrs.html
   │  │  │  │  │  ├─ 📄010-externalizo a archivos.html
   │  │  │  │  │  ├─ 📄011-lo cargo como libreria externa.html
   │  │  │  │  │  ├─ 📄012-grafica de tarta.html
   │  │  │  │  │  ├─ 📄013-a javascript.html
   │  │  │  │  │  ├─ 📄014-averiguamos el total.html
   │  │  │  │  │  ├─ 📄015-construyo una cadena.html
   │  │  │  │  │  ├─ 📄016-encapsulo.html
   │  │  │  │  │  ├─ 📄017-probamos multiple.html
   │  │  │  │  │  ├─ 📄018-estilizar mejor las gráficas.html
   │  │  │  │  │  ├─ 📄019-svg sobreimpreso.html
   │  │  │  │  │  ├─ 📄020-leyendas en las partes.html
   │  │  │  │  │  ├─ 📄021-titulo de la grafica.html
   │  │  │  │  │  ├─ 📄022-titulo de la grafica.html
   │  │  │  │  │  ├─ 📄jvgraficabarras.css
   │  │  │  │  │  └─ 📄jvgraficabarras.js
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁009-Clases, propiedades, métodos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁010-Eventos; escuchadores
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁002-Generación de interfaces naturales de usuario
   │  │  │  ├─ 📁001-Herramientas para el aprendizaje automático
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📁microchatgpt
   │  │  │  │  │  │  ├─ 📁backend
   │  │  │  │  │  │  │  └─ 📄app.py
   │  │  │  │  │  │  └─ 📁frontend
   │  │  │  │  │  │     ├─ 📄app.js
   │  │  │  │  │  │     ├─ 📄index.html
   │  │  │  │  │  │     └─ 📄styles.css
   │  │  │  │  │  └─ 📄001-comprobacion de ollama.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Interfaces naturales
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Voz y Habla
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-sintesis de voz.html
   │  │  │  │  │  ├─ 📄002-microfono.html
   │  │  │  │  │  ├─ 📄003-fusiono proyectos.html
   │  │  │  │  │  ├─ 📄004-pinto tabla.html
   │  │  │  │  │  └─ 📄005-reacciono a la voz.html
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Partes y movimientos del cuerpo
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-reconocimiento manos.html
   │  │  │  │  │  ├─ 📄002-acceso a los datos.html
   │  │  │  │  │  ├─ 📄003-cara.html
   │  │  │  │  │  └─ 📄004-cuerpo.html
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Realidad aumentada
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁003-Creación de componentes visuales
   │  │  │  ├─ 📁001-Concepto de componente
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Propiedades, atributos y métodos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁033-Comprobamos el estado
   │  │  │  │  │  └─ 📄000-Resumen.md
   │  │  │  │  ├─ 📁034-reemplazar componente
   │  │  │  │  │  └─ 📄000-Resumen.md
   │  │  │  │  ├─ 📁035-Lo ponemos a prueba
   │  │  │  │  │  └─ 📄000-Resumen.md
   │  │  │  │  ├─ 📁036-Los resultados tienen que aparecer correctamente
   │  │  │  │  │  └─ 📄000-Resumen.md
   │  │  │  │  ├─ 📁037-busqueda parecida
   │  │  │  │  │  └─ 📄000-Resumen.md
   │  │  │  │  ├─ 📁038-Detener la propagacion
   │  │  │  │  │  └─ 📄000-Resumen.md
   │  │  │  │  ├─ 📁039-estilizar
   │  │  │  │  │  └─ 📄000-Resumen.md
   │  │  │  │  ├─ 📁040-limpiar seleccionados
   │  │  │  │  │  └─ 📄000-Resumen.md
   │  │  │  │  ├─ 📁041-diferenciar valor y contenido
   │  │  │  │  │  └─ 📄000-Resumen.md
   │  │  │  │  ├─ 📁042-lo hacemos funcionar de forma dinamica
   │  │  │  │  │  └─ 📄000-Resumen.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Eventos; asociación de acciones a eventos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Persistencia del componente
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Herramientas para desarrollo de componentes visuales
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Prueba de los componentes
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Empaquetado de componentes
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁004-Diseño de interfaces gráficas
   │  │  │  ├─ 📁001-Usabilidad y accesibilidad
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Medidas de usabilidad y accesibilidad de las aplicaciones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Esquemas (Wireframes) y Maquetas (Mockups)
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Pautas de diseño de la estructura de la interfaz de usuario
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Pautas de diseño del aspecto de la interfaz de usuario
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Pautas de diseño
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Pautas de diseño de la secuencia de control de la aplicación
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁005-Creación de informes
   │  │  │  ├─ 📁001-Informes incrustados y no incrustados en la aplicación
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Herramientas gráficas integradas en el IDE y externas al mismo
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Estructura general. Secciones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Filtrado de datos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Numeración de líneas, recuentos y totales
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Gráficos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Librerías para generación de informes. Clases, métodos y atributos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁008-Conexión con las fuentes de datos. Ejecución de consultas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁006-Documentación de aplicaciones
   │  │  │  ├─ 📁001-Ficheros de ayuda. Formatos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Herramientas de generación de ayudas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Tablas de contenidos, índices, sistemas de búsqueda, entre otros
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Tipos de manuales
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Elaboración de tutoriales
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁007-Distribución de aplicaciones
   │  │  │  ├─ 📁001-Componentes de una aplicación. Empaquetado
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Instaladores
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Paquetes autoinstalables
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Firma digital de aplicaciones
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Herramientas para crear paquetes de instalación
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Personalización de la instalación
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁007-Asistentes de instalación y desinstalación
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁008-Canales de distribución repositorios 
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁008-Realización de pruebas
   │  │  │  ├─ 📁001-Objetivo, importancia y limitaciones del proceso de prueba
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Pruebas de integración ascendentes y descendentes
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁003-Pruebas de sistema configuración, recuperación, entre otras
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁004-Pruebas de uso de recursos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁005-Pruebas de seguridad
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁006-Pruebas manuales y automáticas
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  └─ 📄000-Resumen.md
   │  ├─ 📁Programación de servicios y procesos
   │  │  ├─ 📁001-Programación multiproceso
   │  │  │  ├─ 📁001-Ejecutables. Procesos. Servicios
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  └─ 📁101-Ejercicios
   │  │  │  │     └─ 📄001-proceso.py
   │  │  │  ├─ 📁002-Estados de un proceso. Planificación de procesos
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁003-Hilos
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  └─ 📁002-Ejercicios
   │  │  │  │     ├─ 📄001-no es multihilo.py
   │  │  │  │     ├─ 📄002-16 veces el mismo proceso.py
   │  │  │  │     ├─ 📄003-quiero usar multihilo.py
   │  │  │  │     ├─ 📄004-mutiproceso.cpp
   │  │  │  │     ├─ 📄005-recorro.py
   │  │  │  │     ├─ 📄006-recorro y modifico.py
   │  │  │  │     ├─ 📄007-inicio y final.py
   │  │  │  │     ├─ 📄008-partir la imagen.py
   │  │  │  │     ├─ 📄009-multinucleo.py
   │  │  │  │     ├─ 📄010-multi.py
   │  │  │  │     ├─ 📄josevicente.jpg
   │  │  │  │     ├─ 📄josevicente2.jpg
   │  │  │  │     ├─ 📄josevicente3.jpg
   │  │  │  │     ├─ 📄josevicente_blur_serial.jpg
   │  │  │  │     ├─ 📄josevicente_blur_threads.jpg
   │  │  │  │     └─ 📄salida.out
   │  │  │  ├─ 📁004-Programación concurrente
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁005-Programación paralela y distribuida
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  └─ 📁002-Ejercicios
   │  │  │  │     ├─ 📄001-socketclient.py
   │  │  │  │     ├─ 📄001-socketserver.py
   │  │  │  │     ├─ 📄003-workers.html
   │  │  │  │     ├─ 📄003worker.js
   │  │  │  │     ├─ 📄004-calculo fuerte.html
   │  │  │  │     ├─ 📄004worker.js
   │  │  │  │     ├─ 📄005-array de workers.html
   │  │  │  │     ├─ 📄005worker.js
   │  │  │  │     ├─ 📄006-numero de nucleos de mi maquina.html
   │  │  │  │     ├─ 📄006worker.js
   │  │  │  │     ├─ 📄007-paquete de datos.html
   │  │  │  │     ├─ 📄007worker.js
   │  │  │  │     ├─ 📄008-recomponer los datos.html
   │  │  │  │     └─ 📄008worker.js
   │  │  │  ├─ 📁006-Comunicación entre procesos
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁007-Gestión de procesos. Herramientas de monitorización
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁008-Sincronización entre procesos
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁009-Programación de aplicaciones multiproceso
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁002-Programación multihilo
   │  │  │  ├─ 📁001-Contexto de ejecución de los hilos
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  ├─ 📁002-Estados de un hilo. Cambios de estado
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁003-Librerías y clases
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁004-Gestión de hilos. Prioridades
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁005-Sincronización de hilos
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁006-Compartición de información entre hilos
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁007-Programación de aplicaciones multihilo
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁003-Programación de comunicaciones en red
   │  │  │  ├─ 📁001-Comunicación entre aplicaciones
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁002-Roles cliente y servidor
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁003-Librerías y clases
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁004-Sockets. Tipos. Características
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁005-Creación de sockets
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁006-Enlazado y establecimiento de conexiones
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁007-Utilización de sockets para la transmisión y recepción de información
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁008-Programación de aplicaciones cliente y servidor
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁009-Utilización de hilos para la implementación de comunicaciones simultáneas con el servidor
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁004-Generación de servicios en red
   │  │  │  ├─ 📁001-Protocolos estándar de comunicación en red a nivel de aplicación
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁002-Servicios web
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁003-Librerías de clases y componentes
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁004-Programación de servidores
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁005-Establecimiento y finalización de conexiones
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁006-Transmisión de información
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁007-Implementación de comunicaciones simultáneas
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁008-Utilización de aplicaciones clientes
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁009-Monitorización del servicio. Herramientas
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁005-Utilización de técnicas de programación segura
   │  │  │  ├─ 📁001-Prácticas de programación segura
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁002-Criptografía de clave pública y clave privada
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁003-Principales aplicaciones de la criptografía
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁004-Protocolos criptográficos
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁005-Política de seguridad. Roles
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁006-Programación de mecanismos de control de acceso
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁007-Encriptación de información
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁008-Protocolos seguros de comunicaciones
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁009-Programación de aplicaciones con comunicaciones seguras
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  └─ 📄000-Resumen.md
   │  ├─ 📁Programación multimedia y dispositivos móviles
   │  │  ├─ 📁001-Análisis de motores de juegos
   │  │  │  ├─ 📁001-Animación 2D y 3D
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  └─ 📁101-Ejercicios
   │  │  │  │     ├─ 📁001-Cementerio viviente
   │  │  │  │     │  ├─ 📄001-Canvas.html
   │  │  │  │     │  ├─ 📄002-puedo darle color a la forma.html
   │  │  │  │     │  ├─ 📄003-dibujo un circulo.html
   │  │  │  │     │  ├─ 📄004-control de teclado.html
   │  │  │  │     │  ├─ 📄005-borrar pantalla.html
   │  │  │  │     │  ├─ 📄006-cargo imagen.html
   │  │  │  │     │  ├─ 📄007-recorte.html
   │  │  │  │     │  ├─ 📄008-fotogramas de la animacion.html
   │  │  │  │     │  ├─ 📄009-parametrizacion.html
   │  │  │  │     │  ├─ 📄010-le pongo un fondo.html
   │  │  │  │     │  ├─ 📄fondo.png
   │  │  │  │     │  └─ 📄spritesheet.png
   │  │  │  │     ├─ 📁002-comecocos
   │  │  │  │     │  ├─ 📄001-Terreno.html
   │  │  │  │     │  ├─ 📄002-dibujo personaje.html
   │  │  │  │     │  ├─ 📄003-lo estoy recorriendo al reves.html
   │  │  │  │     │  ├─ 📄004-teclas.html
   │  │  │  │     │  ├─ 📄005-dibujar mejor.html
   │  │  │  │     │  ├─ 📄006-colision pacman.html
   │  │  │  │     │  ├─ 📄007-limpiamos el escenario.html
   │  │  │  │     │  ├─ 📄008-pintar escenario es una funcion.html
   │  │  │  │     │  └─ 📄009-reestructuramos el programa.html
   │  │  │  │     ├─ 📁003-Unificar
   │  │  │  │     │  ├─ 📄001-Original.html
   │  │  │  │     │  ├─ 📄002-tramos el personaje.html
   │  │  │  │     │  ├─ 📄003-ahora si que lo traemos.html
   │  │  │  │     │  └─ 📄spritesheet.png
   │  │  │  │     ├─ 📁004-particulas
   │  │  │  │     │  ├─ 📄001-particula.html
   │  │  │  │     │  ├─ 📄002-variables de posicion.html
   │  │  │  │     │  ├─ 📄003-bucle.html
   │  │  │  │     │  ├─ 📄004-borrar canvas.html
   │  │  │  │     │  ├─ 📄005-movimiento mas aleatorio.html
   │  │  │  │     │  ├─ 📄006-le pongo direccion.html
   │  │  │  │     │  ├─ 📄007-colisiones.html
   │  │  │  │     │  ├─ 📄008-poo.html
   │  │  │  │     │  ├─ 📄009-metodo mueve.html
   │  │  │  │     │  ├─ 📄010-colision.html
   │  │  │  │     │  ├─ 📄011-metodo get.html
   │  │  │  │     │  ├─ 📄012-lineas entre particulas.html
   │  │  │  │     │  ├─ 📄013-simulamos motion blur.html
   │  │  │  │     │  ├─ 📄014-nuevas propiedades.html
   │  │  │  │     │  ├─ 📄015-propiedades html.html
   │  │  │  │     │  ├─ 📄016-evento interaccion.html
   │  │  │  │     │  ├─ 📄017-movimiento de raton.html
   │  │  │  │     │  └─ 📄018-tamanio y velocidad.html
   │  │  │  │     ├─ 📄fondo.png
   │  │  │  │     └─ 📄spritesheet.png
   │  │  │  ├─ 📁002-Arquitectura del juego. Componentes
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  └─ 📁101-Ejercicios
   │  │  │  │     ├─ 📄001-empezamos.html
   │  │  │  │     ├─ 📄002-entramos en el bucle.html
   │  │  │  │     ├─ 📄003-condiciones de inicio.html
   │  │  │  │     ├─ 📄004-clases.html
   │  │  │  │     ├─ 📄005-vamos con las rocas.html
   │  │  │  │     ├─ 📄006-aleatoriedad rocas.html
   │  │  │  │     ├─ 📄007-las rocas se mueven.html
   │  │  │  │     ├─ 📄008-comentarios.html
   │  │  │  │     ├─ 📄009-pantalla completa.html
   │  │  │  │     ├─ 📄010-personaje dibujo y se mueve.html
   │  │  │  │     ├─ 📄011-controles de teclado.html
   │  │  │  │     ├─ 📄012-ahora me desplazo.html
   │  │  │  │     ├─ 📄013-balas como objetos.html
   │  │  │  │     ├─ 📄014-espaciadora crea balas.html
   │  │  │  │     ├─ 📄015-tengo que tambien dibujar las balas.html
   │  │  │  │     ├─ 📄016-les digo a las balas que se mueven.html
   │  │  │  │     ├─ 📄017-mas velocidad para las balas.html
   │  │  │  │     ├─ 📄018-detectamos colision de la bala con la roca.html
   │  │  │  │     ├─ 📄019-ahora borramos la roca.html
   │  │  │  │     ├─ 📄020-la bala tambien se rompe con la roca.html
   │  │  │  │     ├─ 📄021-balas se eliminan al salir de la pantalla.html
   │  │  │  │     ├─ 📄022-mejoramos controles de teclado.html
   │  │  │  │     ├─ 📄023-simulamos la inercia.html
   │  │  │  │     ├─ 📄024-mejores gráficos.html
   │  │  │  │     ├─ 📄025-dibujamos estrellas.html
   │  │  │  │     ├─ 📄026-inercia.html
   │  │  │  │     └─ 📄027-niveles.html
   │  │  │  ├─ 📁003-Motores de juegos Tipos y utilización
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁004-Áreas de especialización, librerías utilizadas y lenguajes de programación
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁005-Componentes de un motor de juegos
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁006-Librerías que proporcionan las funciones básicas de un Motor 2D3D
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁007-Estudio de juegos existentes
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁008-Aplicación de modificaciones sobre juegos existentes
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁002-Desarrollo de juegos 2D y 3D
   │  │  │  ├─ 📁001-Técnicas de programación 2D3D
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁002-Fases de desarrollo
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁003-Componentes de los objetos
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁004-Fuentes de audio. Propiedades
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁005-Cámaras e iluminación
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁006-Creación de escenas.
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁007-Análisis de ejecución
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁003-Utilización de librerías multimedia integradas
   │  │  │  ├─ 📁001-Conceptos sobre aplicaciones multimedia
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁002-Arquitectura del API utilizado
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁003-Fuentes de datos multimedia. Clases
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁004-Procesamiento de objetos multimedia
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁005-Reproducción de objetos multimedia
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁006-Animación de objetos
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁004-Análisis de tecnologías para aplicaciones en dispositivos móviles
   │  │  │  ├─ 📁001-Dispositivos móviles
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁002-Hardware para dispositivos móviles
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁003-Tecnologías de desarrollo
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁004-Emuladores. Configuraciones
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁005-Aplicaciones móviles
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁006-Modelo de estados de una aplicación móvil activo, pausa y destruido
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁007-Ciclo de vida de una aplicación
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁008-Modificación de aplicaciones existentes
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁009-Utilización del entorno de ejecución del administrador de aplicaciones
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁005-Desarrollo de aplicaciones para dispositivos móviles
   │  │  │  ├─ 📁001-Herramientas. Flujo de trabajo
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁002-Componentes de una aplicación. Recursos
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁003-Interfaces de usuario. Clases asociadas
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁004-Contexto gráfico. Imágenes
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁005-Métodos de entrada. Eventos
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁006-Gestión de las preferencias de la aplicación
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁007-Bases de datos y almacenamiento
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁008-Persistencia
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁009-Tareas en segundo plano. Servicios
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁010-Seguridad y permisos
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁011-Conectividad. Tipos. 
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁012-Manejo de conexiones HTTP y HTTPS
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁013-Sensores
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁014-Posicionamiento. Localización. Mapas
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  └─ 📄000-Resumen.md
   │  ├─ 📁Proyecto Intermodular II
   │  │  ├─ 📁001-Introduccion
   │  │  │  └─ 📄001-Introduccion.md
   │  │  ├─ 📁002-Análisis
   │  │  │  ├─ 📁001-Recopilación de información
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-Búsqueda de empresas.md
   │  │  │  │  │  └─ 📄002-Empresas tipo indicando la estructura organizativa y las funciones de cada departamento.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  ├─ 📁002-Identificación y priorización de necesidades.
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  ├─ 📁101-Ejercicios
   │  │  │  │  │  ├─ 📄001-Necesidades más demandadas a las empresas.md
   │  │  │  │  │  ├─ 📄002-Oportunidades de negocio previsibles en el sector
   │  │  │  │  │  ├─ 📄003.Tipo de proyecto requerido para dar respuesta a las demandas previstas.md
   │  │  │  │  │  └─ 📄004-Características específicas del proyecto según los requerimientos.md
   │  │  │  │  └─ 📁201-Criterios de evaluación
   │  │  │  │     └─ 📄Criterios de evaluación.md
   │  │  │  └─ 📁003-Identificación de los aspectos que facilitan o dificultan el desarrollo de la posible intervención
   │  │  │     ├─ 📁001-Contenidos básicos
   │  │  │     │  └─ 📄Contenidos básicos.md
   │  │  │     ├─ 📁101-Ejercicios
   │  │  │     │  ├─ 📄001-Obligaciones fiscales, laborales y de prevención de riesgos y sus condiciones de aplicación.md
   │  │  │     │  ├─ 📄002-Posibles ayudas o subvenciones para la incorporación de las nuevas tecnologías de producción o de servicio propuestas.md
   │  │  │     │  └─ 📄003-Guión de trabajo que se va a seguir para la elaboración del proyecto.md
   │  │  │     └─ 📁201-Criterios de evaluación
   │  │  │        └─ 📄Criterios de evaluación.md
   │  │  ├─ 📁003-Diseño
   │  │  │  ├─ 📁001-Definición o adaptación de la intervención
   │  │  │  │  └─ 📄001-Introduccion.md
   │  │  │  ├─ 📁002-Priorización y secuenciación de las acciones.
   │  │  │  │  └─ 📄001-Introduccion.md
   │  │  │  ├─ 📁003-La planificación de la intervención
   │  │  │  ├─ 📁004-Determinación de recursos.
   │  │  │  ├─ 📁005-Planificación de la evaluación
   │  │  │  ├─ 📁006-Diseño de documentación
   │  │  │  └─ 📁007-Plan de atención al cliente
   │  │  ├─ 📁004-Organizacion
   │  │  │  ├─ 📁001-Detección de demandas y necesidades
   │  │  │  ├─ 📁002-Programación
   │  │  │  ├─ 📁003-Gestión
   │  │  │  ├─ 📁004-Coordinación y supervisión de la intervención
   │  │  │  ├─ 📁005-Elaboración de informes
   │  │  │  └─ 📁006-Seguimiento y control
   │  │  ├─ 📁005-Actividades profesionales
   │  │  │  ├─ 📁001-Áreas de sistemas y departamentos de informática en cualquier sector de actividad
   │  │  │  ├─ 📁002-Sector de servicios tecnológicos y comunicaciones
   │  │  │  └─ 📁003-Área comercial con gestión de transacciones por Internet
   │  │  ├─ 📁006-Lineas de actuación
   │  │  │  ├─ 📁001- La ejecución de trabajos en equipo
   │  │  │  ├─ 📁002-La autoevaluación del trabajo realizado
   │  │  │  ├─ 📁003-La autonomía y la iniciativa
   │  │  │  └─ 📁004-El uso de las TIC
   │  │  └─ 📁007-Bibliografía
   │  ├─ 📁Sistemas de gestión empresarial
   │  │  ├─ 📁001-Identificación de sistemas ERP-CRM
   │  │  │  ├─ 📁001-Concepto de ERP
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  └─ 📁002-Ejercicios
   │  │  │  │     └─ 📄001-Definiciones.md
   │  │  │  ├─ 📁002-Revisión de los ERP actuales
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  └─ 📁002-Ejercicios
   │  │  │  │     └─ 📄001-Busqueda en Google.md
   │  │  │  ├─ 📁003-Concepto de CRM
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  └─ 📁002-Ejercicios
   │  │  │  │     └─ 📄001-Definiciones.md
   │  │  │  ├─ 📁004-Revisión de los CRM actuales
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  └─ 📁002-Ejercicios
   │  │  │  │     └─ 📄001-Revision CRM.md
   │  │  │  ├─ 📁005-Tipos de licencias de los ERP-CRM
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  └─ 📁002-Ejercicios
   │  │  │  │     └─ 📄001-Licencias.md
   │  │  │  ├─ 📁006-Sistemas gestores de bases de datos compatibles con el software
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  └─ 📁002-Ejercicios
   │  │  │  │     └─ 📄001-Analisis.md
   │  │  │  ├─ 📁007-Instalación y configuración del sistema informático
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  └─ 📁002-Ejercicios
   │  │  │  │     ├─ 📁001-Login
   │  │  │  │     │  ├─ 📁anterior
   │  │  │  │     │  │  ├─ 📁comun
   │  │  │  │     │  │  │  └─ 📄estilo.css
   │  │  │  │     │  │  ├─ 📁escritorio
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.html
   │  │  │  │     │  │  └─ 📁iniciarsesion
   │  │  │  │     │  │     ├─ 📄comportamiento.js
   │  │  │  │     │  │     ├─ 📄estilo.css
   │  │  │  │     │  │     └─ 📄index.html
   │  │  │  │     │  ├─ 📁basededatos
   │  │  │  │     │  │  └─ 📄instalacion.sql
   │  │  │  │     │  ├─ 📁instalador
   │  │  │  │     │  │  └─ 📄index.php
   │  │  │  │     │  └─ 📁posterior
   │  │  │  │     │     ├─ 📄config.php
   │  │  │  │     │     ├─ 📄data_1757686436.json
   │  │  │  │     │     └─ 📄iniciarsesion.php
   │  │  │  │     ├─ 📄001-Elección de tecnologías.md
   │  │  │  │     ├─ 📄002-Abstracción.md
   │  │  │  │     └─ 📄003-Tecnologías que deberá soportar el SI.md
   │  │  │  ├─ 📁008-Verificación de la instalación y configuración
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁009-Documentación de las operaciones realizadas
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁002-Instalación y configuración de sistemas ERP-CRM
   │  │  │  ├─ 📁001-Tipos de instalación.
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  └─ 📁002-Ejercicios
   │  │  │  │     └─ 📄001-Plantillas.md
   │  │  │  ├─ 📁002-Módulos de un sistema ERP-CRM 
   │  │  │  │  ├─ 📁001-Contenidos básicos
   │  │  │  │  │  └─ 📄Contenidos básicos.md
   │  │  │  │  └─ 📁101-Ejercicios
   │  │  │  │     ├─ 📁002-Vistas
   │  │  │  │     │  ├─ 📁anterior
   │  │  │  │     │  │  ├─ 📁cabecera
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.php
   │  │  │  │     │  │  ├─ 📁comun
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  ├─ 📄Ubuntu-B.ttf
   │  │  │  │     │  │  │  └─ 📄Ubuntu-R.ttf
   │  │  │  │     │  │  ├─ 📁escritorio
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.html
   │  │  │  │     │  │  ├─ 📁iniciarsesion
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.html
   │  │  │  │     │  │  └─ 📄index.php
   │  │  │  │     │  ├─ 📁basededatos
   │  │  │  │     │  │  └─ 📄instalacion.sql
   │  │  │  │     │  ├─ 📁instalador
   │  │  │  │     │  │  └─ 📄index.php
   │  │  │  │     │  └─ 📁posterior
   │  │  │  │     │     ├─ 📄config.php
   │  │  │  │     │     ├─ 📄data_1757686436.json
   │  │  │  │     │     └─ 📄iniciarsesion.php
   │  │  │  │     ├─ 📁003-listado de modulos
   │  │  │  │     │  ├─ 📁anterior
   │  │  │  │     │  │  ├─ 📁cabecera
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.php
   │  │  │  │     │  │  ├─ 📁comun
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  ├─ 📄Ubuntu-B.ttf
   │  │  │  │     │  │  │  └─ 📄Ubuntu-R.ttf
   │  │  │  │     │  │  ├─ 📁escritorio
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.html
   │  │  │  │     │  │  ├─ 📁iniciarsesion
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.html
   │  │  │  │     │  │  ├─ 📁listadodemodulos
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.php
   │  │  │  │     │  │  └─ 📄index.php
   │  │  │  │     │  ├─ 📁basededatos
   │  │  │  │     │  │  └─ 📄instalacion.sql
   │  │  │  │     │  ├─ 📁instalador
   │  │  │  │     │  │  └─ 📄index.php
   │  │  │  │     │  └─ 📁posterior
   │  │  │  │     │     ├─ 📄config.php
   │  │  │  │     │     ├─ 📄data_1757686436.json
   │  │  │  │     │     ├─ 📄iniciarsesion.php
   │  │  │  │     │     └─ 📄listadodemodulos.php
   │  │  │  │     ├─ 📁004-listado modulos backend
   │  │  │  │     │  ├─ 📁anterior
   │  │  │  │     │  │  ├─ 📁cabecera
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.php
   │  │  │  │     │  │  ├─ 📁comun
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  ├─ 📄Ubuntu-B.ttf
   │  │  │  │     │  │  │  └─ 📄Ubuntu-R.ttf
   │  │  │  │     │  │  ├─ 📁escritorio
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.html
   │  │  │  │     │  │  ├─ 📁iniciarsesion
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.html
   │  │  │  │     │  │  ├─ 📁listadodemodulos
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.php
   │  │  │  │     │  │  └─ 📄index.php
   │  │  │  │     │  ├─ 📁basededatos
   │  │  │  │     │  │  └─ 📄instalacion.sql
   │  │  │  │     │  ├─ 📁instalador
   │  │  │  │     │  │  └─ 📄index.php
   │  │  │  │     │  └─ 📁posterior
   │  │  │  │     │     ├─ 📄config.php
   │  │  │  │     │     ├─ 📄data_1757686436.json
   │  │  │  │     │     ├─ 📄iniciarsesion.php
   │  │  │  │     │     └─ 📄listadodemodulos.php
   │  │  │  │     ├─ 📁005-Templates
   │  │  │  │     │  ├─ 📁anterior
   │  │  │  │     │  │  ├─ 📁cabecera
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.php
   │  │  │  │     │  │  ├─ 📁comun
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  ├─ 📄Ubuntu-B.ttf
   │  │  │  │     │  │  │  └─ 📄Ubuntu-R.ttf
   │  │  │  │     │  │  ├─ 📁escritorio
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.html
   │  │  │  │     │  │  ├─ 📁iniciarsesion
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.html
   │  │  │  │     │  │  ├─ 📁listadodemodulos
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.php
   │  │  │  │     │  │  ├─ 📁plantillas
   │  │  │  │     │  │  │  ├─ 📁calendario
   │  │  │  │     │  │  │  ├─ 📁fichas
   │  │  │  │     │  │  │  ├─ 📁formulario
   │  │  │  │     │  │  │  ├─ 📁grafica
   │  │  │  │     │  │  │  ├─ 📁kanban
   │  │  │  │     │  │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  │  └─ 📄index.php
   │  │  │  │     │  │  │  └─ 📁lista
   │  │  │  │     │  │  └─ 📄index.php
   │  │  │  │     │  ├─ 📁basededatos
   │  │  │  │     │  │  └─ 📄instalacion.sql
   │  │  │  │     │  ├─ 📁instalador
   │  │  │  │     │  │  └─ 📄index.php
   │  │  │  │     │  └─ 📁posterior
   │  │  │  │     │     ├─ 📄config.php
   │  │  │  │     │     ├─ 📄data_1757686436.json
   │  │  │  │     │     ├─ 📄iniciarsesion.php
   │  │  │  │     │     └─ 📄listadodemodulos.php
   │  │  │  │     ├─ 📁006-kanban segunda parte
   │  │  │  │     │  ├─ 📁anterior
   │  │  │  │     │  │  ├─ 📁cabecera
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.php
   │  │  │  │     │  │  ├─ 📁comun
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  ├─ 📄Ubuntu-B.ttf
   │  │  │  │     │  │  │  └─ 📄Ubuntu-R.ttf
   │  │  │  │     │  │  ├─ 📁escritorio
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.html
   │  │  │  │     │  │  ├─ 📁iniciarsesion
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.html
   │  │  │  │     │  │  ├─ 📁listadodemodulos
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.php
   │  │  │  │     │  │  ├─ 📁plantillas
   │  │  │  │     │  │  │  ├─ 📁calendario
   │  │  │  │     │  │  │  ├─ 📁fichas
   │  │  │  │     │  │  │  ├─ 📁formulario
   │  │  │  │     │  │  │  ├─ 📁grafica
   │  │  │  │     │  │  │  ├─ 📁kanban
   │  │  │  │     │  │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  │  ├─ 📄index.php
   │  │  │  │     │  │  │  │  └─ 📄kanban.json
   │  │  │  │     │  │  │  └─ 📁lista
   │  │  │  │     │  │  └─ 📄index.php
   │  │  │  │     │  ├─ 📁basededatos
   │  │  │  │     │  │  └─ 📄instalacion.sql
   │  │  │  │     │  ├─ 📁instalador
   │  │  │  │     │  │  └─ 📄index.php
   │  │  │  │     │  └─ 📁posterior
   │  │  │  │     │     ├─ 📄config.php
   │  │  │  │     │     ├─ 📄data_1757686436.json
   │  │  │  │     │     ├─ 📄iniciarsesion.php
   │  │  │  │     │     └─ 📄listadodemodulos.php
   │  │  │  │     ├─ 📁007-kanban tercera parte
   │  │  │  │     │  ├─ 📁anterior
   │  │  │  │     │  │  ├─ 📁cabecera
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.php
   │  │  │  │     │  │  ├─ 📁comun
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  ├─ 📄Ubuntu-B.ttf
   │  │  │  │     │  │  │  └─ 📄Ubuntu-R.ttf
   │  │  │  │     │  │  ├─ 📁escritorio
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.html
   │  │  │  │     │  │  ├─ 📁iniciarsesion
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.html
   │  │  │  │     │  │  ├─ 📁listadodemodulos
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.php
   │  │  │  │     │  │  ├─ 📁plantillas
   │  │  │  │     │  │  │  ├─ 📁calendario
   │  │  │  │     │  │  │  ├─ 📁fichas
   │  │  │  │     │  │  │  ├─ 📁formulario
   │  │  │  │     │  │  │  ├─ 📁grafica
   │  │  │  │     │  │  │  ├─ 📁kanban
   │  │  │  │     │  │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  │  ├─ 📄index.php
   │  │  │  │     │  │  │  │  └─ 📄kanban.json
   │  │  │  │     │  │  │  └─ 📁lista
   │  │  │  │     │  │  └─ 📄index.php
   │  │  │  │     │  ├─ 📁basededatos
   │  │  │  │     │  │  └─ 📄instalacion.sql
   │  │  │  │     │  ├─ 📁instalador
   │  │  │  │     │  │  └─ 📄index.php
   │  │  │  │     │  └─ 📁posterior
   │  │  │  │     │     ├─ 📁data
   │  │  │  │     │     │  └─ 📄kanban.sqlite
   │  │  │  │     │     ├─ 📄config.php
   │  │  │  │     │     ├─ 📄data_1757686436.json
   │  │  │  │     │     ├─ 📄iniciarsesion.php
   │  │  │  │     │     ├─ 📄kanban.php
   │  │  │  │     │     ├─ 📄listadodemodulos.php
   │  │  │  │     │     └─ 📄savekanban.php
   │  │  │  │     ├─ 📁008-kanban ampliaciones
   │  │  │  │     │  ├─ 📁anterior
   │  │  │  │     │  │  ├─ 📁cabecera
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.php
   │  │  │  │     │  │  ├─ 📁comun
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  ├─ 📄Ubuntu-B.ttf
   │  │  │  │     │  │  │  └─ 📄Ubuntu-R.ttf
   │  │  │  │     │  │  ├─ 📁crm
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.php
   │  │  │  │     │  │  ├─ 📁escritorio
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.html
   │  │  │  │     │  │  ├─ 📁iniciarsesion
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.html
   │  │  │  │     │  │  ├─ 📁listadodemodulos
   │  │  │  │     │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  └─ 📄index.php
   │  │  │  │     │  │  ├─ 📁plantillas
   │  │  │  │     │  │  │  ├─ 📁calendario
   │  │  │  │     │  │  │  ├─ 📁fichas
   │  │  │  │     │  │  │  ├─ 📁formulario
   │  │  │  │     │  │  │  ├─ 📁grafica
   │  │  │  │     │  │  │  ├─ 📁kanban
   │  │  │  │     │  │  │  │  ├─ 📄comportamiento.js
   │  │  │  │     │  │  │  │  ├─ 📄estilo.css
   │  │  │  │     │  │  │  │  ├─ 📄index.php
   │  │  │  │     │  │  │  │  └─ 📄kanban.json
   │  │  │  │     │  │  │  └─ 📁lista
   │  │  │  │     │  │  └─ 📄index.php
   │  │  │  │     │  ├─ 📁basededatos
   │  │  │  │     │  │  └─ 📄instalacion.sql
   │  │  │  │     │  ├─ 📁instalador
   │  │  │  │     │  │  └─ 📄index.php
   │  │  │  │     │  └─ 📁posterior
   │  │  │  │     │     ├─ 📁data
   │  │  │  │     │     │  └─ 📄kanban.sqlite
   │  │  │  │     │     ├─ 📄config.php
   │  │  │  │     │     ├─ 📄data_1757686436.json
   │  │  │  │     │     ├─ 📄iniciarsesion.php
   │  │  │  │     │     ├─ 📄kanban.php
   │  │  │  │     │     ├─ 📄listadodemodulos.php
   │  │  │  │     │     └─ 📄savekanban.php
   │  │  │  │     └─ 📄001-Listado de pantallas a desarrollar.md
   │  │  │  ├─ 📁003-Procesos de instalación del sistema ERP-CRM
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁004-Parámetros de configuración del sistema ERP-CRM 
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁005-Actualización del sistema ERP-CRM y aplicación de actualizaciones
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁006-Servicios de acceso al sistema ERP-CRM 
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁007-Entornos de desarrollo, pruebas y explotación
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁003-Organización y consulta de la información
   │  │  │  ├─ 📁001-Definición de campos
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁002-Consultas de acceso a datos
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁003-Interfaces de entrada de datos y de procesos. 
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁004-Informes y listados de la aplicación
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁005-Gestión de pedidos
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁006-Gráficos
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁007-Herramientas de monitorización y de evaluación del rendimiento
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁008-Incidencias identificación y resolución
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁009-Procesos de extracción de datos en sistemas de ERP-CRM y almacenes de datos
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁010-Inteligencia de negocio (Business Intelligence)
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁004-Implantación de sistemas ERP-CRM en una empresa
   │  │  │  ├─ 📁001-Tipos de empresa. Necesidades de la empresa
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁002-Selección de los módulos del sistema ERP-CRM
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁003-Tablas y vistas que es preciso adaptar
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁004-Consultas necesarias para obtener información
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁005-Creación de formularios personalizados
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁006-Creación de informes personalizados
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁007-Paneles de control (Dashboards)
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁008-Integración con otros sistemas de gestión
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  ├─ 📁005-Desarrollo de componentes
   │  │  │  ├─ 📁001-Arquitectura del ERP-CRM
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁002-Lenguaje proporcionado
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁003-Entornos de desarrollo y herramientas del sistema ERP y CRM
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁004-Inserción, modificación y eliminación de datos en los objetos
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁005-Operaciones de consulta. Herramientas
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁006-Formularios e informes
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁007-Procesamiento de datos y obtención de la información
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁008-Llamadas a funciones, librerías de funciones (APIs)
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📁009-Depuración y tratamiento de errores
   │  │  │  │  └─ 📁001-Contenidos básicos
   │  │  │  │     └─ 📄Contenidos básicos.md
   │  │  │  ├─ 📄000-Resumen.md
   │  │  │  └─ 📄Criterios de evaluacion.md
   │  │  └─ 📄000-Resumen.md
   │  ├─ 📄000-Resumen.md
   │  └─ 📄001-Resumen.md
   ├─ 📄Contenidos.py
   ├─ 📄Conversor.py
   ├─ 📄Criterios.py
   ├─ 📄Criterios2.py
   ├─ 📄esquema general.svg
   └─ 📄README.md
```

<a id="excepciones-deteccion-y-tratamiento"></a>
## Excepciones detección y tratamiento

En el mundo digital actual, la gestión eficiente de ficheros es una habilidad fundamental para cualquier desarrollador o programador. Al trabajar con archivos, se encuentran constantemente con situaciones que requieren un manejo adecuado de errores y excepciones, ya que no siempre ocurren según lo esperado. En esta subunidad, exploraremos cómo detectar y tratar las excepciones que pueden surgir durante el acceso a ficheros, asegurándonos de que nuestro programa sea robusto y capaz de manejar situaciones inesperadas con gracia.

La detección de excepciones es un proceso fundamental en la programación. Cuando se produce un error durante la ejecución de una operación, como intentar leer o escribir en un fichero, el sistema generará una excepción. Es importante identificar estas excepciones para poder tomar medidas adecuadas y evitar que el programa crashee. En Python, por ejemplo, podemos utilizar bloques `try` y `except` para detectar y tratar excepciones.

El tratamiento de excepciones es otro aspecto crucial del manejo de ficheros. Una vez identificada una excepción, nuestro programa debe saber cómo reaccionar. Esto puede implicar mostrar un mensaje de error amigable al usuario, intentar recuperarse de la situación o incluso cerrar el programa de manera segura. En Python, podemos utilizar bloques `try` y `except` para tratar excepciones, pero también podemos usar bloques `finally` para ejecutar código que debe ejecutarse independientemente de si se produjo una excepción o no.

El manejo adecuado de excepciones en el acceso a ficheros es crucial para la seguridad y la confiabilidad del programa. Al detectar y tratar excepciones, podemos evitar situaciones peligrosas como la pérdida de datos o la corrupción del sistema. Además, al proporcionar mensajes de error claros y amigables, podemos mejorar la experiencia del usuario y facilitar el diagnóstico de problemas.

En Python, hay varios tipos de excepciones comunes que pueden surgir durante el acceso a ficheros. Algunas de las más frecuentes son `FileNotFoundError`, `PermissionError` y `IOError`. Cada una de estas excepciones tiene un propósito específico y puede ocurrir en diferentes situaciones. Por ejemplo, `FileNotFoundError` se produce cuando intentamos acceder a un fichero que no existe, mientras que `PermissionError` ocurre cuando no tenemos los permisos necesarios para leer o escribir en el fichero.

Al trabajar con excepciones en Python, es importante recordar que no debemos ignorarlas. Ignorar una excepción puede llevar a situaciones peligrosas y difíciles de diagnosticar. En su lugar, debemos tratar las excepciones adecuadamente y proporcionar un manejo eficaz para evitar problemas mayores.

En conclusión, el manejo de excepciones en el acceso a ficheros es una habilidad fundamental que todos los desarrolladores deben dominar. Al detectar y tratar excepciones de manera adecuada, podemos asegurar la seguridad y confiabilidad de nuestros programas, mejorar la experiencia del usuario y facilitar el diagnóstico de problemas. En Python, utilizamos bloques `try` y `except` para detectar y tratar excepciones, pero también podemos usar bloques `finally` para ejecutar código que debe ejecutarse independientemente de si se produjo una excepción o no. Al trabajar con excepciones en el acceso a ficheros, debemos recordar que no debemos ignorarlas y proporcionar un manejo eficaz para evitar problemas mayores.

<a id="desarrollo-de-aplicaciones-que-utilizan-ficheros"></a>
## Desarrollo de aplicaciones que utilizan ficheros

En este capítulo del curso, nos adentramos en la práctica real de aplicaciones que utilizan ficheros para almacenar y recuperar datos. Comenzamos con una revisión de las clases asociadas a las operaciones de gestión de ficheros, destacando cómo estas proporcionan una interfaz uniforme para interactuar con diferentes tipos de archivos.

A medida que avanzamos, exploramos las formas de acceso a un fichero, comprendiendo sus ventajas y desventajas. Esta comprensión es crucial para diseñar sistemas eficientes y seguros que manejen grandes volúmenes de información.

Continuamos con el estudio de las clases para gestión de flujos de datos desdehacia ficheros, aprendiendo cómo estos flujos permiten la lectura y escritura de datos en un formato binario o texto. Este conocimiento es fundamental para desarrollar aplicaciones que requieren manejo sofisticado de archivos.

A medida que nos acercamos al final del capítulo, nos centramos en las operaciones sobre ficheros secuenciales y aleatorios. Aprenderemos cómo trabajar con diferentes tipos de acceso a los datos, lo que nos permitirá optimizar el rendimiento de nuestras aplicaciones cuando se requiere acceso rápido a cualquier parte del archivo.

Finalmente, concluimos este capítulo con una exploración detallada de la serialización y deserialización de objetos. Este tema es crucial para entender cómo almacenar en ficheros complejos de datos estructurados y recuperarlos de manera eficiente.

A lo largo de esta subunidad, hemos desarrollado una comprensión profunda de cómo aplicaciones pueden interactuar con ficheros, desde la gestión básica hasta el manejo avanzado de objetos serializados. Este conocimiento es fundamental para cualquier programador que desee crear aplicaciones robustas y eficientes que requieran almacenamiento persistente de datos.

<a id="ejercicio-de-final-de-unidad"></a>
## Ejercicio de final de unidad

### ejercicio

```markdown

```


<a id="manejo-de-conectores"></a>
# Manejo de conectores

<a id="el-desfase-objeto-relacional"></a>
## El desfase objeto-relacional

El desfase objeto-relacional es un concepto fundamental en la programación orientada a objetos (POO) cuando se trabaja con bases de datos relacionales. Este fenómeno ocurre porque los lenguajes de programación orientados a objetos, como Java o C#, representan los datos y las operaciones sobre ellos mediante clases y objetos, mientras que las bases de datos relacionales almacenan sus datos en tablas y filas.

Este desfase plantea un problema importante: cómo convertir los objetos del mundo real (representados en el código) en registros de una base de datos y viceversa. La solución a este desfase se logra mediante la utilización de conectores, que son bibliotecas o frameworks específicos diseñados para facilitar esta conversión.

Un conector típicamente proporciona clases y métodos que permiten establecer conexiones con una base de datos relacional, ejecutar consultas SQL, insertar, actualizar y eliminar registros, y manejar transacciones. Estos conectores abstrae el acceso a la base de datos, simplificando la programación y reduciendo los errores comunes.

Por ejemplo, en Java, un conector popular para bases de datos relacionales es JDBC (Java Database Connectivity). JDBC proporciona una API que permite interactuar con cualquier base de datos que soporte SQL. Con JDBC, se pueden realizar operaciones como:

- Establecer una conexión a la base de datos utilizando las credenciales del usuario.
- Crear sentencias SQL para insertar, actualizar y eliminar registros.
- Ejecutar consultas y procesar los resultados devueltos por la base de datos.

Además de JDBC, existen otros conectores populares como Hibernate (para bases de datos relacionales) o MyBatis (para bases de datos orientadas a objetos). Estos conectores ofrecen funcionalidades adicionales que facilitan el acceso y manipulación de los datos en la base de datos.

El uso de conectores para manejar el desfase objeto-relacional no solo simplifica la programación, sino que también mejora la eficiencia y la seguridad del acceso a los datos. Al ocultar los detalles específicos de la base de datos, los desarrolladores pueden centrarse en la lógica de negocio de su aplicación, sin preocuparse por las complejidades internas de cómo se almacenan y recuperan los datos.

En resumen, el desfase objeto-relacional es un concepto crucial que surgió con la implementación del acceso a bases de datos relacionales en entornos orientados a objetos. Los conectores son herramientas esenciales para abordar este desfase, facilitando la conversión entre los objetos del mundo real y los registros de una base de datos, y simplificando el desarrollo de aplicaciones que interactúan con bases de datos.

### Introduccion

```markdown
Muchas aplicaciones funcionan con colecciones de objetos
Esos objetos pueden tener una jerarquia compleja de propiedades

Que ocurre cuando guardamos esos datos?

1.-Solucion1: Pickle
2.-Solucion2: Mapeo objeto-relacional
```

### clientes

```python
clientes = [{
  "nombre":"Jose Vicente",
  "apellidos":"Carratala Sanchis",
  "emails":[
    {
      "tipo":"personal",
      "direcciones":[
        "info@josevicentecarratala.com",
        "jocarsa2@gmail.com"
       ]
    },
    {
      "tipo":"empresa",
      "direcciones":["info@jocarsa.com"]
    }
   ]
},{
  "nombre":"Jose Vicente",
  "apellidos":"Carratala Sanchis",
  "emails":[
    {
      "tipo":"personal",
      "direcciones":[
        "info@josevicentecarratala.com",
        "jocarsa2@gmail.com"
       ]
    },
    {
      "tipo":"empresa",
      "direcciones":["info@jocarsa.com"]
    }
   ]
}
]
```

### sacamos la estructura del objeto

```python
clientes = [{
  "nombre":"Jose Vicente",
  "apellidos":"Carratala Sanchis",
  "emails":[
    {
      "tipo":"personal",
      "direcciones":[
        "info@josevicentecarratala.com",
        "jocarsa2@gmail.com"
       ]
    },
    {
      "tipo":"empresa",
      "direcciones":["info@jocarsa.com"]
    }
   ]
},{
  "nombre":"Jose Vicente",
  "apellidos":"Carratala Sanchis",
  "emails":[
    {
      "tipo":"personal",
      "direcciones":[
        "info@josevicentecarratala.com",
        "jocarsa2@gmail.com"
       ]
    },
    {
      "tipo":"empresa",
      "direcciones":["info@jocarsa.com"]
    }
   ]
}
]

muestra = clientes[0]
print(muestra)
```

### recorremos el objeto

```python
clientes = [{
  "nombre":"Jose Vicente",
  "apellidos":"Carratala Sanchis",
  "emails":[
    {
      "tipo":"personal",
      "direcciones":[
        "info@josevicentecarratala.com",
        "jocarsa2@gmail.com"
       ]
    },
    {
      "tipo":"empresa",
      "direcciones":["info@jocarsa.com"]
    }
   ]
},{
  "nombre":"Jose Vicente",
  "apellidos":"Carratala Sanchis",
  "emails":[
    {
      "tipo":"personal",
      "direcciones":[
        "info@josevicentecarratala.com",
        "jocarsa2@gmail.com"
       ]
    },
    {
      "tipo":"empresa",
      "direcciones":["info@jocarsa.com"]
    }
   ]
}
]

muestra = clientes[0]
print(muestra)

for clave in muestra.keys():
  print(clave)
  print(type(muestra[clave]))
  if type(muestra[clave]) == str:
    print("Lo voy a convertir en una columna de SQL que sera de tipo varchar")
  elif type(muestra[clave]) == list:
    print("Lo voy a convertir en una tabla externa de SQL")
  elif type(muestra[clave]) == int:
    print("Lo voy a convertir en una columna de SQL que sera de tipo int ")
  elif:
    print("No me han programado para ese tipo de campo")
```

### importamos mysql

```python
import mysql.connector

clientes = [{
  "nombre":"Jose Vicente",
  "apellidos":"Carratala Sanchis",
  "emails":[
    {
      "tipo":"personal",
      "direcciones":[
        "info@josevicentecarratala.com",
        "jocarsa2@gmail.com"
       ]
    },
    {
      "tipo":"empresa",
      "direcciones":["info@jocarsa.com"]
    }
   ]
},{
  "nombre":"Jose Vicente",
  "apellidos":"Carratala Sanchis",
  "emails":[
    {
      "tipo":"personal",
      "direcciones":[
        "info@josevicentecarratala.com",
        "jocarsa2@gmail.com"
       ]
    },
    {
      "tipo":"empresa",
      "direcciones":["info@jocarsa.com"]
    }
   ]
}
]

muestra = clientes[0]
print(muestra)

for clave in muestra.keys():
  print(clave)
  print(type(muestra[clave]))
  if type(muestra[clave]) == str:
    print("Lo voy a convertir en una columna de SQL que sera de tipo varchar")
  elif type(muestra[clave]) == list:
    print("Lo voy a convertir en una tabla externa de SQL")
  elif type(muestra[clave]) == int:
    print("Lo voy a convertir en una columna de SQL que sera de tipo int ")
  else:
    print("No me han programado para ese tipo de campo")

conn = mysql.connector.connect(
    host="localhost",
    user="desfase",
    password="desfase",
    database="desfase"
)
cursor = conn.cursor()
cursor.execute('''
CREATE TABLE `desfase`.`clientes` (`Identificador` INT NOT NULL AUTO_INCREMENT , `nombre` VARCHAR(255) NOT NULL , `apellidos` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , PRIMARY KEY (`Identificador`)) ENGINE = InnoDB;
''')  
```

### creo un listado de campos

```python
import mysql.connector

clientes = [{
  "nombre":"Jose Vicente",
  "apellidos":"Carratala Sanchis",
  "dni":"45325345G",
  "emails":[
    {
      "tipo":"personal",
      "direcciones":[
        "info@josevicentecarratala.com",
        "jocarsa2@gmail.com"
       ]
    },
    {
      "tipo":"empresa",
      "direcciones":["info@jocarsa.com"]
    }
   ]
},{
  "nombre":"Jose Vicente",
  "apellidos":"Carratala Sanchis",
  "dni":"45325345G",
  "emails":[
    {
      "tipo":"personal",
      "direcciones":[
        "info@josevicentecarratala.com",
        "jocarsa2@gmail.com"
       ]
    },
    {
      "tipo":"empresa",
      "direcciones":["info@jocarsa.com"]
    }
   ]
}
]

muestra = clientes[0]
print(muestra)

campos = []

for clave in muestra.keys():
  print(clave)
  print(type(muestra[clave]))
  if type(muestra[clave]) == str:
    print("Lo voy a convertir en una columna de SQL que sera de tipo varchar")
    campos.append(clave)
  elif type(muestra[clave]) == list:
    print("Lo voy a convertir en una tabla externa de SQL")
  elif type(muestra[clave]) == int:
    print("Lo voy a convertir en una columna de SQL que sera de tipo int ")
  else:
    print("No me han programado para ese tipo de campo")

conn = mysql.connector.connect(
    host="localhost",
    user="desfase",
    password="desfase",
    database="desfase"
)

cadena = '''
CREATE TABLE `desfase`.`clientes` (
  `Identificador` INT NOT NULL AUTO_INCREMENT ,
  '''
for campo in campos:
  cadena += ''' 
  `'''+campo+'''` VARCHAR(255) NOT NULL , 
  '''
cadena += '''
  
  PRIMARY KEY (`Identificador`)
) ENGINE = InnoDB;
'''

print(cadena)
#cursor = conn.cursor()
#cursor.execute("DROP TABLE clientes;")  
```

### lanzo la consulta a la base de datos

```python
import mysql.connector

clientes = [{
  "nombre":"Jose Vicente",
  "apellidos":"Carratala Sanchis",
  "dni":"45325345G",
  "edad":47,
  "emails":[
    {
      "tipo":"personal",
      "direccion":
        "info@josevicentecarratala.com",
        
    },
    {
      "tipo":"empresa",
      "direcciones":["info@jocarsa.com"]
    }
   ]
},{
  "nombre":"Jose Vicente",
  "apellidos":"Carratala Sanchis",
  "dni":"45325345G",
  "edad":45,
  "emails":[
    {
      "tipo":"personal",
      "direccion":
        "info@josevicentecarratala.com",
       ]
    },
    {
      "tipo":"empresa",
      "direcciones":["info@jocarsa.com"]
    }
   ]
}
]

muestra = clientes[0]
print(muestra)

campos = []

for clave in muestra.keys():
  print(clave)
  print(type(muestra[clave]))
  if type(muestra[clave]) == str:
    print("Lo voy a convertir en una columna de SQL que sera de tipo varchar")
    campos.append(clave)
  elif type(muestra[clave]) == list:
    print("Lo voy a convertir en una tabla externa de SQL")
  elif type(muestra[clave]) == int:
    print("Lo voy a convertir en una columna de SQL que sera de tipo int ")
    campos.append(clave)
  else:
    print("No me han programado para ese tipo de campo")

conn = mysql.connector.connect(
    host="localhost",
    user="desfase",
    password="desfase",
    database="desfase"
)

cadena = '''
CREATE TABLE `desfase`.`clientes` (
  `Identificador` INT NOT NULL AUTO_INCREMENT ,
  '''
for campo in campos:
  if type(campo) is str:
    cadena += ''' 
    `'''+campo+'''` VARCHAR(255) NOT NULL , 
    '''
  elif type(campo) is int:
    cadena += ''' 
    `'''+campo+'''` INT(255) NOT NULL , 
    '''
    
cadena += '''
  
  PRIMARY KEY (`Identificador`)
) ENGINE = InnoDB;
'''

print(cadena)
cursor = conn.cursor()
cursor.execute("DROP TABLE clientes;")  
cursor.execute(cadena)
```

### tabla referenciada

```python
import re
import mysql.connector

# ===================== DATOS (ejemplo corregido) =====================
clientes = [{
  "nombre":"Jose Vicente",
  "apellidos":"Carratala Sanchis",
  "dni":"45325345G",
  "edad":47,
  "emails":[
    {"tipo":"personal","direccion":"info@josevicentecarratala.com"},
    {"tipo":"empresa","direcciones":["info@jocarsa.com"]}
  ]
},{
  "nombre":"Jose Vicente",
  "apellidos":"Carratala Sanchis",
  "dni":"45325345G",
  "edad":45,
  "emails":[
    {"tipo":"personal","direccion":"info@josevicentecarratala.com"},
    {"tipo":"empresa","direcciones":["info@jocarsa.com"]}
  ]
}]

# ===================== HELPERS =====================
def ident(name: str) -> str:
    """Sanitiza identificadores SQL."""
    name = (name or "").strip().lower()
    name = re.sub(r'[^a-z0-9_]+', '_', name)
    name = re.sub(r'_+', '_', name).strip('_')
    if not name:
        name = 'col'
    if name[0].isdigit():
        name = 'n_' + name
    return name

def sql_scalar_type(value):
    if isinstance(value, bool):
        return "TINYINT(1)"
    if isinstance(value, int):
        return "INT"
    if isinstance(value, float):
        return "DOUBLE"
    return "VARCHAR(255)"  # por defecto texto

def merge_type(a, b):
    if a == b:
        return a
    # Promociones simples
    pair = {a, b}
    if pair == {"INT", "DOUBLE"}:
        return "DOUBLE"
    if pair == {"TINYINT(1)", "INT"}:
        return "INT"
    # fallback
    return "TEXT"

# ===================== INFERENCIA DE ESQUEMA =====================
root_table = "clientes"

# Columnas escalares de la tabla principal
root_scalar_cols = {}  # nombre_col -> tipo_sql

# Para campos lista a nivel raíz: definiciones hijas
# child_defs[campo] = {"kind": "scalar_list"|"object_list",
#                      "cols": {k: tipo},   # solo si object_list
#                      "sub_scalar_lists": set(subcampos)}
child_defs = {}

for row in clientes:
    for k, v in row.items():
        if isinstance(v, list):
            # Analizar lista
            if len(v) == 0:
                # Lista vacía → asumimos lista de escalares (valor VARCHAR)
                child = child_defs.setdefault(k, {"kind":"scalar_list"})
            else:
                first = v[0]
                if isinstance(first, dict):
                    child = child_defs.setdefault(k, {"kind":"object_list","cols":{}, "sub_scalar_lists": set()})
                    # Unimos todas las claves posibles y tipos
                    for item in v:
                        if not isinstance(item, dict):
                            continue
                        for k2, v2 in item.items():
                            if isinstance(v2, list):
                                # Sublista (si es de escalares)
                                if len(v2) == 0 or not isinstance(v2[0], dict):
                                    child["sub_scalar_lists"].add(k2)
                                # (si fuese lista de dicts, aquí podrías añadir otra rama nieta de objetos)
                            elif isinstance(v2, dict):
                                # Nieto objeto: podrías extender aquí si lo necesitas
                                pass
                            else:
                                # Escalar en hijo
                                t = sql_scalar_type(v2)
                                if k2 in child["cols"]:
                                    child["cols"][k2] = merge_type(child["cols"][k2], t)
                                else:
                                    child["cols"][k2] = t
                else:
                    # Lista de escalares
                    child = child_defs.setdefault(k, {"kind":"scalar_list"})
        elif isinstance(v, dict):
            # Si quieres soportar dicts a nivel raíz como tabla hija 1-1, amplía aquí
            pass
        else:
            # Escalar en raíz
            t = sql_scalar_type(v)
            if k in root_scalar_cols:
                root_scalar_cols[k] = merge_type(root_scalar_cols[k], t)
            else:
                root_scalar_cols[k] = t

# ===================== SQL: CREACIÓN DE TABLAS =====================
conn = mysql.connector.connect(
    host="localhost",
    user="desfase",
    password="desfase",
    database="desfase"
)
cursor = conn.cursor()

def exec_safe(sql):
    # print(sql)  # descomenta para depurar
    cursor.execute(sql)

root_table_i = ident(root_table)
# Drop en orden seguro: nietas → hijas → raíz
# (Primero recopilamos nombres)
drop_order = []

child_table_names = {}
grandchild_table_names = []  # lista de (tabla_nieta)

for field, info in child_defs.items():
    child_name = f"{root_table_i}_{ident(field)}"
    child_table_names[field] = child_name
    if info.get("kind") == "object_list":
        for sub in info.get("sub_scalar_lists", []):
            grandchild_table_names.append(f"{child_name}_{ident(sub)}")

# 1) DROP nietas
for t in grandchild_table_names:
    exec_safe(f"DROP TABLE IF EXISTS `{t}`;")
# 2) DROP hijas
for t in child_table_names.values():
    exec_safe(f"DROP TABLE IF EXISTS `{t}`;")
# 3) DROP raíz
exec_safe(f"DROP TABLE IF EXISTS `{root_table_i}`;")

# === Crear raíz
cols_sql = ["`Identificador` INT NOT NULL AUTO_INCREMENT"]
for col, t in root_scalar_cols.items():
    cols_sql.append(f"`{ident(col)}` {t} DEFAULT NULL")
cols_sql.append("PRIMARY KEY (`Identificador`)")
create_root = f"""
CREATE TABLE `{root_table_i}` (
  {", ".join(cols_sql)}
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
"""
exec_safe(create_root)

# === Crear hijas
for field, info in child_defs.items():
    child_name = child_table_names[field]
    lines = [
        "`Identificador` INT NOT NULL AUTO_INCREMENT",
        f"`{root_table_i}_id` INT NOT NULL"
    ]
    if info["kind"] == "scalar_list":
        lines.append("`valor` VARCHAR(255) DEFAULT NULL")
    else:  # object_list
        for k2, t2 in info.get("cols", {}).items():
            lines.append(f"`{ident(k2)}` {t2} DEFAULT NULL")
    lines.append("PRIMARY KEY (`Identificador`)")
    lines.append(f"KEY `fk_{child_name}_{root_table_i}` (`{root_table_i}_id`)")
    create_child = f"""
    CREATE TABLE `{child_name}` (
      {", ".join(lines)},
      CONSTRAINT `fk_{child_name}_{root_table_i}`
        FOREIGN KEY (`{root_table_i}_id`)
        REFERENCES `{root_table_i}` (`Identificador`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    """
    exec_safe(create_child)

# === Crear nietas (sublistas escalares dentro de objetos)
for field, info in child_defs.items():
    if info.get("kind") != "object_list":
        continue
    child_name = child_table_names[field]
    for sub in info.get("sub_scalar_lists", []):
        grand = f"{child_name}_{ident(sub)}"
        create_grand = f"""
        CREATE TABLE `{grand}` (
          `Identificador` INT NOT NULL AUTO_INCREMENT,
          `{child_name}_id` INT NOT NULL,
          `valor` VARCHAR(255) DEFAULT NULL,
          PRIMARY KEY (`Identificador`),
          KEY `fk_{grand}_{child_name}` (`{child_name}_id`),
          CONSTRAINT `fk_{grand}_{child_name}`
            FOREIGN KEY (`{child_name}_id`)
            REFERENCES `{child_name}` (`Identificador`)
            ON DELETE CASCADE
            ON UPDATE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        """
        exec_safe(create_grand)

conn.commit()

print("Esquema generado:")
print(f"- Tabla raíz: {root_table_i} columnas escalares: {list(root_scalar_cols.keys())}")
for field, info in child_defs.items():
    print(f"- Hija: {child_table_names[field]} ({info['kind']})")
    if info["kind"] == "object_list":
        print(f"    columnas: {list(info.get('cols', {}).keys())}")
        if info.get("sub_scalar_lists"):
            for sub in info["sub_scalar_lists"]:
                print(f"    Nieta: {child_table_names[field]}_{ident(sub)} (valor)")
```

### y ahora tambien metemos los datos

```python
import re
import mysql.connector

# ===================== DATOS (ejemplo) =====================
clientes = [{
  "nombre":"Jose Vicente",
  "apellidos":"Carratala Sanchis",
  "dni":"45325345G",
  "edad":47,
  "emails":[
    {"tipo":"personal","direccion":"info@josevicentecarratala.com"},
    {"tipo":"empresa","direcciones":["info@jocarsa.com"]}
  ]
},{
  "nombre":"Jose Vicente",
  "apellidos":"Carratala Sanchis",
  "dni":"45325345G",
  "edad":45,
  "emails":[
    {"tipo":"personal","direccion":"info@josevicentecarratala.com"},
    {"tipo":"empresa","direcciones":["info@jocarsa.com"]}
  ]
}]

# ===================== HELPERS =====================
def ident(name: str) -> str:
    """Sanitiza identificadores SQL."""
    name = (name or "").strip().lower()
    name = re.sub(r'[^a-z0-9_]+', '_', name)
    name = re.sub(r'_+', '_', name).strip('_')
    if not name:
        name = 'col'
    if name[0].isdigit():
        name = 'n_' + name
    return name

def sql_scalar_type(value):
    if isinstance(value, bool):
        return "TINYINT(1)"
    if isinstance(value, int):
        return "INT"
    if isinstance(value, float):
        return "DOUBLE"
    return "VARCHAR(255)"  # por defecto texto

def merge_type(a, b):
    if a == b:
        return a
    pair = {a, b}
    if pair == {"INT", "DOUBLE"}:
        return "DOUBLE"
    if pair == {"TINYINT(1)", "INT"}:
        return "INT"
    return "TEXT"

# ===================== INFERENCIA DE ESQUEMA =====================
root_table = "clientes"
root_table_i = ident(root_table)

root_scalar_cols = {}  # nombre_col -> tipo_sql
child_defs = {}        # campo -> {"kind": "scalar_list"/"object_list", "cols":{}, "sub_scalar_lists": set()}

for row in clientes:
    for k, v in row.items():
        if isinstance(v, list):
            if len(v) == 0:
                child_defs.setdefault(k, {"kind":"scalar_list"})
            else:
                first = v[0]
                if isinstance(first, dict):
                    child = child_defs.setdefault(k, {"kind":"object_list","cols":{}, "sub_scalar_lists": set()})
                    for item in v:
                        if not isinstance(item, dict):
                            continue
                        for k2, v2 in item.items():
                            if isinstance(v2, list):
                                # sublista escalar
                                if len(v2) == 0 or not isinstance(v2[0], dict):
                                    child["sub_scalar_lists"].add(k2)
                                # si fuese lista de dicts, se podría extender a bisnieta aquí
                            elif isinstance(v2, dict):
                                # nieto objeto (no implementado en este ejemplo)
                                pass
                            else:
                                t = sql_scalar_type(v2)
                                if k2 in child["cols"]:
                                    child["cols"][k2] = merge_type(child["cols"][k2], t)
                                else:
                                    child["cols"][k2] = t
                else:
                    child_defs.setdefault(k, {"kind":"scalar_list"})
        elif isinstance(v, dict):
            # dict a nivel raíz (1:1) — no implementado en este ejemplo
            pass
        else:
            t = sql_scalar_type(v)
            if k in root_scalar_cols:
                root_scalar_cols[k] = merge_type(root_scalar_cols[k], t)
            else:
                root_scalar_cols[k] = t

# ===================== CONEXIÓN & CREACIÓN DE TABLAS =====================
conn = mysql.connector.connect(
    host="localhost",
    user="desfase",
    password="desfase",
    database="desfase"
)
cursor = conn.cursor()

def exec_safe(sql):
    cursor.execute(sql)

child_table_names = {}
grandchild_table_names = []  # solo nombres para dropear/crear

for field, info in child_defs.items():
    child_name = f"{root_table_i}_{ident(field)}"
    child_table_names[field] = child_name
    if info.get("kind") == "object_list":
        for sub in info.get("sub_scalar_lists", []):
            grandchild_table_names.append(f"{child_name}_{ident(sub)}")

# Dropear en orden: nietas -> hijas -> raíz
for t in grandchild_table_names:
    exec_safe(f"DROP TABLE IF EXISTS `{t}`;")
for t in child_table_names.values():
    exec_safe(f"DROP TABLE IF EXISTS `{t}`;")
exec_safe(f"DROP TABLE IF EXISTS `{root_table_i}`;")

# Crear raíz
cols_sql = ["`Identificador` INT NOT NULL AUTO_INCREMENT"]
for col, t in root_scalar_cols.items():
    cols_sql.append(f"`{ident(col)}` {t} DEFAULT NULL")
cols_sql.append("PRIMARY KEY (`Identificador`)")
create_root = f"""
CREATE TABLE `{root_table_i}` (
  {", ".join(cols_sql)}
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
"""
exec_safe(create_root)

# Crear hijas
for field, info in child_defs.items():
    child_name = child_table_names[field]
    lines = [
        "`Identificador` INT NOT NULL AUTO_INCREMENT",
        f"`{root_table_i}_id` INT NOT NULL"
    ]
    if info["kind"] == "scalar_list":
        lines.append("`valor` VARCHAR(255) DEFAULT NULL")
    else:  # object_list
        for k2, t2 in info.get("cols", {}).items():
            lines.append(f"`{ident(k2)}` {t2} DEFAULT NULL")
    lines.append("PRIMARY KEY (`Identificador`)")
    lines.append(f"KEY `fk_{child_name}_{root_table_i}` (`{root_table_i}_id`)")
    create_child = f"""
    CREATE TABLE `{child_name}` (
      {", ".join(lines)},
      CONSTRAINT `fk_{child_name}_{root_table_i}`
        FOREIGN KEY (`{root_table_i}_id`)
        REFERENCES `{root_table_i}` (`Identificador`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    """
    exec_safe(create_child)

# Crear nietas (sublistas escalares)
for field, info in child_defs.items():
    if info.get("kind") != "object_list":
        continue
    child_name = child_table_names[field]
    for sub in info.get("sub_scalar_lists", []):
        grand = f"{child_name}_{ident(sub)}"
        create_grand = f"""
        CREATE TABLE `{grand}` (
          `Identificador` INT NOT NULL AUTO_INCREMENT,
          `{child_name}_id` INT NOT NULL,
          `valor` VARCHAR(255) DEFAULT NULL,
          PRIMARY KEY (`Identificador`),
          KEY `fk_{grand}_{child_name}` (`{child_name}_id`),
          CONSTRAINT `fk_{grand}_{child_name}`
            FOREIGN KEY (`{child_name}_id`)
            REFERENCES `{child_name}` (`Identificador`)
            ON DELETE CASCADE
            ON UPDATE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        """
        exec_safe(create_grand)

conn.commit()

# ===================== INSERCIÓN DE DATOS =====================
def insert_root_row(row: dict) -> int:
    """Inserta un registro en la tabla raíz y devuelve su ID."""
    cols = []
    vals = []
    ph = []
    for col in root_scalar_cols.keys():
        cols.append(f"`{ident(col)}`")
        vals.append(row.get(col, None))
        ph.append("%s")
    sql = f"INSERT INTO `{root_table_i}` ({', '.join(cols)}) VALUES ({', '.join(ph)})"
    cursor.execute(sql, vals)
    return cursor.lastrowid

def insert_child_scalar_list(child_table: str, parent_id: int, values):
    """Inserta lista de escalares como filas hija."""
    if not isinstance(values, list):
        return
    sql = f"INSERT INTO `{child_table}` (`{root_table_i}_id`, `valor`) VALUES (%s, %s)"
    for v in values:
        cursor.execute(sql, (parent_id, None if isinstance(v, (dict,list)) else v))

def insert_child_object_list(field: str, child_table: str, parent_id: int, items, info):
    """Inserta lista de objetos + sus sublistas escalares (nietas)."""
    if not isinstance(items, list):
        return
    # Preparar columnas del hijo
    child_cols = list(info.get("cols", {}).keys())
    col_id = f"`{root_table_i}_id`"
    cols_sql = [col_id] + [f"`{ident(c)}`" for c in child_cols]
    ph = ["%s"] * (1 + len(child_cols))
    sql = f"INSERT INTO `{child_table}` ({', '.join(cols_sql)}) VALUES ({', '.join(ph)})"

    # Para sublistas (nietas)
    sublists = list(info.get("sub_scalar_lists", []))
    grand_tables = { sub: f"{child_table}_{ident(sub)}" for sub in sublists }
    grand_sql = { sub: f"INSERT INTO `{grand_tables[sub]}` (`{child_table}_id`, `valor`) VALUES (%s, %s)" for sub in sublists }

    for obj in items:
        if not isinstance(obj, dict):
            continue
        row_vals = [parent_id]
        for c in child_cols:
            v = obj.get(c, None)
            if isinstance(v, (list, dict)):
                # columnas del hijo solo guardan escalares
                row_vals.append(None)
            else:
                row_vals.append(v)
        cursor.execute(sql, row_vals)
        child_id = cursor.lastrowid

        # Sublistas escalares → nietas
        for sub in sublists:
            arr = obj.get(sub, None)
            if isinstance(arr, list):
                for el in arr:
                    cursor.execute(grand_sql[sub], (child_id, el if not isinstance(el, (dict,list)) else None))

def insert_data(data_rows):
    for row in data_rows:
        rid = insert_root_row(row)
        # recorrer campos para hijas
        for field, info in child_defs.items():
            values = row.get(field, None)
            if values is None:
                continue
            child_table = child_table_names[field]
            if info["kind"] == "scalar_list":
                insert_child_scalar_list(child_table, rid, values)
            else:
                insert_child_object_list(field, child_table, rid, values, info)

insert_data(clientes)
conn.commit()

print("Inserción completada.")
print(f"Registros insertados en `{root_table_i}`: {cursor.rowcount} (último batch puede no reflejar total)")
```

### recursivo

```python
#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import json
import re
import hashlib
import mysql.connector
from collections import defaultdict, deque

# =============== CONFIG ===============
JSON_PATH = "./datos.json"   # <-- ruta del JSON externo
DB = {
    "host": "localhost",
    "user": "desfase",
    "password": "desfase",
    "database": "desfase",
}

# =============== IDENT & TYPES ===============
def ident(name: str) -> str:
    """Sanitiza identificadores MySQL (tabla/col)."""
    name = (name or "").strip().lower()
    name = re.sub(r'[^a-z0-9_]+', '_', name)
    name = re.sub(r'_+', '_', name).strip('_')
    if not name:
        name = "col"
    if name[0].isdigit():
        name = "n_" + name
    if name in {"index", "key", "primary", "value"}:
        name = "_" + name
    return name

def cap_name(name: str, maxlen: int = 64) -> str:
    """
    Corta y añade hash si excede maxlen. Úsalo para nombres de constraints/índices.
    """
    if len(name) <= maxlen:
        return name
    h = hashlib.sha1(name.encode("utf-8")).hexdigest()[:8]
    keep = maxlen - 1 - len(h)  # espacio para '_' + hash
    if keep < 1:
        keep = maxlen - len(h)   # por si acaso
    return f"{name[:keep]}_{h}"

def fk_name(child: str, parent: str) -> str:
    return cap_name(f"fk_{child}_{parent}", 64)

def idx_name(child: str, parent: str) -> str:
    # podemos usar el mismo patrón
    return cap_name(f"fk_{child}_{parent}", 64)

def sql_scalar_type(v):
    """Mapeo conservador a tipos MySQL."""
    if isinstance(v, bool):  return "TINYINT(1)"
    if isinstance(v, int):   return "INT"
    if isinstance(v, float): return "DOUBLE"
    return "TEXT"  # robusto para cadenas largas

def merge_type(a, b):
    if a == b: return a
    pair = {a, b}
    if "TEXT" in pair: return "TEXT"
    if pair == {"INT", "DOUBLE"}: return "DOUBLE"
    if pair == {"TINYINT(1)", "INT"}: return "INT"
    return "TEXT"

def join_path(*parts) -> str:
    return ident("_".join([ident(p) for p in parts if p]))

# =============== TABLE DEF ===============
class TableDef:
    """kind: 'dict' | 'list_scalar'"""
    def __init__(self, name, parent=None, relname=None, kind='dict'):
        self.name = ident(name)
        self.parent = parent       # nombre tabla padre o None
        self.relname = relname     # nombre del campo en el padre
        self.kind = kind
        self.columns = {}          # solo para dict: col -> tipo SQL
        self.children = set()      # nombres de tablas hijas

tables: dict[str, TableDef] = {}
edges = set()  # (parent, child)

def ensure_table(name, parent=None, relname=None, kind='dict') -> TableDef:
    tname = ident(name)
    if tname not in tables:
        tables[tname] = TableDef(tname, parent, relname, kind)
    else:
        # subir de list_scalar a dict si hace falta
        if tables[tname].kind == 'list_scalar' and kind == 'dict':
            tables[tname].kind = 'dict'
    if parent:
        p = ident(parent)
        edges.add((p, tname))
        tables[p].children.add(tname)
    return tables[tname]

# =============== SCHEMA INFERENCE (RECURSIVE) ===============
def infer_value(path_table: str, value, parent_table: str | None, relname: str | None):
    if isinstance(value, dict):
        t = ensure_table(path_table, parent_table, relname, kind='dict')
        for k, v in value.items():
            if isinstance(v, (dict, list)):
                infer_value(join_path(path_table, k), v, t.name, k)
            else:
                col = ident(k)
                ttype = sql_scalar_type(v)
                t.columns[col] = merge_type(t.columns.get(col, ttype), ttype)

    elif isinstance(value, list):
        # decide por primer elemento; lista vacía => escalar
        elem_kind = "scalar"
        for el in value:
            elem_kind = "dict" if isinstance(el, dict) else "scalar"
            break
        if elem_kind == "dict":
            t = ensure_table(path_table, parent_table, relname, kind='dict')
            for el in value:
                if not isinstance(el, dict):
                    continue
                for k, v in el.items():
                    if isinstance(v, (dict, list)):
                        infer_value(join_path(path_table, k), v, t.name, k)
                    else:
                        col = ident(k)
                        ttype = sql_scalar_type(v)
                        t.columns[col] = merge_type(t.columns.get(col, ttype), ttype)
        else:
            ensure_table(path_table, parent_table, relname, kind='list_scalar')

    else:
        # escalar en raíz (poco frecuente), lo modelamos como dict con 'valor'
        if parent_table is None:
            t = ensure_table(path_table, None, relname, kind='dict')
            t.columns['valor'] = merge_type(t.columns.get('valor', sql_scalar_type(value)),
                                            sql_scalar_type(value))

# =============== TOPO SORT & DDL ===============
def topo_tables():
    indeg = defaultdict(int)
    graph = defaultdict(list)
    for p, c in edges:
        graph[p].append(c)
        indeg[c] += 1
        if p not in indeg:
            indeg[p] = indeg[p]
    roots = [t for t in tables if indeg[t] == 0]
    q = deque(roots); out = []; seen = set()
    while q:
        u = q.popleft()
        if u in seen: continue
        seen.add(u); out.append(u)
        for v in graph[u]:
            indeg[v] -= 1
            if indeg[v] == 0:
                q.append(v)
    for t in tables:
        if t not in seen: out.append(t)
    return out

def drop_entire_schema(cursor, dbname: str):
    """Elimina TODAS las tablas de la BD ignorando FKs."""
    cursor.execute("SET FOREIGN_KEY_CHECKS=0;")
    try:
        cursor.execute("""
            SELECT TABLE_NAME FROM information_schema.tables
            WHERE table_schema = %s
        """, (dbname,))
        for (tname,) in cursor.fetchall():
            cursor.execute(f"DROP TABLE IF EXISTS `{tname}`;")
    finally:
        cursor.execute("SET FOREIGN_KEY_CHECKS=1;")

def create_all(cursor):
    order = topo_tables()
    # Desactivar FKs para DROP/CREATE
    cursor.execute("SET FOREIGN_KEY_CHECKS=0;")
    try:
        # DROP hijos→padres (por si hubiera residuos)
        for t in reversed(order):
            cursor.execute(f"DROP TABLE IF EXISTS `{t}`;")
        # CREATE padres→hijos
        for tname in order:
            t = tables[tname]
            cols = ["`Identificador` INT NOT NULL AUTO_INCREMENT"]
            if t.parent:
                cols.append(f"`{t.parent}_id` INT NOT NULL")
            if t.kind == 'dict':
                for c, typ in t.columns.items():
                    cols.append(f"`{ident(c)}` {typ} DEFAULT NULL")
            else:
                cols += ["`idx` INT NOT NULL", "`valor` TEXT DEFAULT NULL"]
            cols.append("PRIMARY KEY (`Identificador`)")

            # nombres de índice y constraint acotados a 64 chars
            fk_idx_sql = ""
            fk_sql = ""
            if t.parent:
                keyn = idx_name(t.name, t.parent)
                fkn = fk_name(t.name, t.parent)
                fk_idx_sql = f", KEY `{keyn}` (`{t.parent}_id`)"
                fk_sql = (f", CONSTRAINT `{fkn}` FOREIGN KEY (`{t.parent}_id`)"
                          f" REFERENCES `{t.parent}` (`Identificador`)"
                          f" ON DELETE CASCADE ON UPDATE CASCADE")

            ddl = f"""CREATE TABLE `{t.name}` (
              {", ".join(cols)}
              {fk_idx_sql}
              {fk_sql}
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"""
            cursor.execute(ddl)
    finally:
        cursor.execute("SET FOREIGN_KEY_CHECKS=1;")

# =============== INSERT (RECURSIVE) ===============
def insert_dict_row(cursor, tdef: TableDef, data: dict, parent_id: int | None):
    # columnas escalares
    cols = []
    vals = []
    for c in tdef.columns:
        cols.append(f"`{ident(c)}`")
        v = data.get(c, None)
        if isinstance(v, (dict, list)): v = None
        vals.append(v)
    # FK
    if tdef.parent:
        cols.insert(0, f"`{tdef.parent}_id`")
        vals.insert(0, parent_id)
    # INSERT
    if cols:
        sql = f"INSERT INTO `{tdef.name}` ({', '.join(cols)}) VALUES ({', '.join(['%s']*len(cols))})"
        cursor.execute(sql, vals)
    else:
        if tdef.parent:
            cursor.execute(f"INSERT INTO `{tdef.name}` (`{tdef.parent}_id`) VALUES (%s)", (parent_id,))
        else:
            cursor.execute(f"INSERT INTO `{tdef.name}` () VALUES ()")
    new_id = cursor.lastrowid

    # hijos
    for k, v in data.items():
        if not isinstance(v, (dict, list)): 
            continue
        child_name = join_path(tdef.name, k)
        child = tables.get(child_name)
        if child is None:
            if isinstance(v, dict):
                child = ensure_table(child_name, tdef.name, k, kind='dict')
                insert_dict_row(cursor, child, {}, new_id)
            continue
        if child.kind == 'dict':
            if isinstance(v, dict):
                insert_dict_row(cursor, child, v, new_id)
            else:
                for el in v:
                    if isinstance(el, dict):
                        insert_dict_row(cursor, child, el, new_id)
        else:
            insert_list_scalar(cursor, child, v, new_id)
    return new_id

def insert_list_scalar(cursor, tdef: TableDef, value, parent_id: int | None):
    if not isinstance(value, list): value = [value]
    sql = f"INSERT INTO `{tdef.name}` (`{tdef.parent}_id`, `idx`, `valor`) VALUES (%s, %s, %s)"
    for i, el in enumerate(value):
        if isinstance(el, (dict, list)):
            try:
                val = json.dumps(el, ensure_ascii=False)
            except Exception:
                val = None
        else:
            val = el
        cursor.execute(sql, (parent_id, i, val))

# =============== RUN (NO CLI) ===============
def run():
    # 1) Cargar JSON
    with open(JSON_PATH, "r", encoding="utf-8") as f:
        root = json.load(f)
    if not isinstance(root, dict):
        raise ValueError("El JSON raíz debe ser un objeto: cada clave es una tabla padre top-level.")

    # 2) Inferencia de esquema
    tables.clear(); edges.clear()
    for top_key, top_val in root.items():
        top_table = ident(top_key)  # p.ej., 'clientes'
        if isinstance(top_val, list):
            for el in top_val:
                infer_value(top_table, el, parent_table=None, relname=None)
        else:
            infer_value(top_table, top_val, parent_table=None, relname=None)

    # 3) Conectar y reset total de BD
    conn = mysql.connector.connect(**DB)
    cur = conn.cursor()
    drop_entire_schema(cur, DB["database"])
    conn.commit()

    # 4) Crear esquema nuevo
    create_all(cur)
    conn.commit()

    # 5) Insertar datos
    for top_key, top_val in root.items():
        top_table = tables[ident(top_key)]
        if isinstance(top_val, list):
            for el in top_val:
                row = el if isinstance(el, dict) else {"valor": el}
                insert_dict_row(cur, top_table, row, parent_id=None)
        elif isinstance(top_val, dict):
            insert_dict_row(cur, top_table, top_val, parent_id=None)
        else:
            insert_dict_row(cur, top_table, {"valor": top_val}, parent_id=None)

    conn.commit()
    cur.close()
    conn.close()
    print("✅ Reset completado, esquema creado e inserción realizada con éxito.")

if __name__ == "__main__":
    run()
```

### lector

```python
#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import json
import mysql.connector
from collections import defaultdict

# ================== CONFIG ==================
DB = {
    "host": "localhost",
    "user": "desfase",
    "password": "desfase",
    "database": "desfase",
}
OUTPUT_JSON = "./dump_recuperado.json"

# ================== UTILS ==================
def fetchall_dict(cur, sql, params=None):
    cur.execute(sql, params or ())
    cols = [d[0] for d in cur.description]
    return [dict(zip(cols, row)) for row in cur.fetchall()]

def is_list_scalar_table(columns: set[str]) -> bool:
    # Heurística: tabla con columnas idx y valor (además de Identificador y FK)
    return "idx" in columns and "valor" in columns

def child_field_name(parent: str, child: str) -> str:
    # Ej: parent='clientes', child='clientes_informacion_contacto_telefonos'
    # -> field = 'informacion_contacto_telefonos'
    prefix = parent + "_"
    if child.startswith(prefix):
        return child[len(prefix):]
    # Si por alguna razón no cumple, devolvemos el nombre tal cual
    return child

# ================== CONEXIÓN ==================
conn = mysql.connector.connect(**DB)
cur = conn.cursor()

# ================== DESCUBRIR ESQUEMA ==================
db = DB["database"]

# 1) Tablas existentes
tables = [r["TABLE_NAME"] for r in fetchall_dict(
    cur,
    """
    SELECT TABLE_NAME
    FROM information_schema.tables
    WHERE table_schema=%s AND TABLE_TYPE='BASE TABLE'
    """,
    (db,)
)]

if not tables:
    raise RuntimeError("No hay tablas en la base de datos.")

# 2) Columnas de cada tabla
table_columns: dict[str, list[str]] = {}
for t in tables:
    rows = fetchall_dict(cur, """
        SELECT COLUMN_NAME
        FROM information_schema.columns
        WHERE table_schema=%s AND table_name=%s
        ORDER BY ORDINAL_POSITION
    """, (db, t))
    table_columns[t] = [r["COLUMN_NAME"] for r in rows]

# 3) Relaciones FK (child -> parent)
#    Asumimos la convención del generador: FK desde child(`{parent}_id`) → parent(`Identificador`)
rels = fetchall_dict(cur, """
    SELECT
      kcu.TABLE_NAME AS child_table,
      kcu.COLUMN_NAME AS child_column,
      kcu.REFERENCED_TABLE_NAME AS parent_table,
      kcu.REFERENCED_COLUMN_NAME AS parent_column
    FROM information_schema.KEY_COLUMN_USAGE kcu
    WHERE kcu.TABLE_SCHEMA=%s
      AND kcu.REFERENCED_TABLE_NAME IS NOT NULL
""", (db,))

parent_of: dict[str, str] = {}               # child_table -> parent_table
fk_col_of_child: dict[str, str] = {}         # child_table -> fk col (e.g., clientes_id)
children_of: dict[str, list[str]] = defaultdict(list)  # parent_table -> [child_table]

for r in rels:
    child = r["child_table"]
    parent = r["parent_table"]
    parent_of[child] = parent
    fk_col_of_child[child] = r["child_column"]
    children_of[parent].append(child)

# 4) Tablas raíz (sin padre)
root_tables = [t for t in tables if t not in parent_of]

# ================== CARGA DE DATOS (CACHE) ==================
# Para eficiencia, cacheamos todas las filas por tabla
all_rows: dict[str, list[dict]] = {}
for t in tables:
    all_rows[t] = fetchall_dict(cur, f"SELECT * FROM `{t}`")

# Índices por PK (Identificador) por tabla (útil para mirar rápido una fila concreta si se necesita)
by_id: dict[str, dict[int, dict]] = {}
for t in tables:
    pk_idx = {}
    for row in all_rows[t]:
        pk_idx[row["Identificador"]] = row
    by_id[t] = pk_idx

# Índices por FK: child_rows_by_parent[(child_table, parent_id)] -> [rows]
child_rows_by_parent: dict[tuple[str, int], list[dict]] = defaultdict(list)
for child in parent_of:
    fk = fk_col_of_child[child]
    for row in all_rows[child]:
        pid = row.get(fk)
        if pid is not None:
            child_rows_by_parent[(child, pid)].append(row)

# ================== RECONSTRUCCIÓN RECURSIVA ==================
def build_node(table: str, row: dict) -> dict:
    """
    Reconstruye un nodo (dict) para una fila de la tabla dada:
    - Incluye columnas escalares propias (excepto Identificador y FK).
    - Recorre hijos: decide si son objeto (1 fila) o lista (2+ filas).
      - Si el hijo es list-scalar (idx, valor) → lista de valores ordenada por idx.
      - Si es dict → objeto (1) o lista (n).
    """
    cols = table_columns[table]
    fk_col = fk_col_of_child.get(table)  # None para tablas raíz
    # columnas que queremos volcar como escalares (excluimos Identificador y FK)
    scalar_cols = [c for c in cols if c not in {"Identificador", "idx", "valor"} and c != fk_col]

    node = {}
    for c in scalar_cols:
        node[c] = row.get(c)

    # Procesar hijos
    for child in children_of.get(table, []):
        rel_field = child_field_name(table, child)
        child_cols = set(table_columns[child])

        # Filas del hijo para este padre
        rows_child = child_rows_by_parent.get((child, row["Identificador"]), [])

        if not rows_child:
            continue

        if is_list_scalar_table(child_cols):
            # Lista de escalares: ordenar por idx y devolver [valor,...]
            seq = sorted(
                [(rc.get("idx"), rc.get("valor")) for rc in rows_child],
                key=lambda x: (x[0] if x[0] is not None else 0)
            )
            node[rel_field] = [val for _, val in seq]
        else:
            # Hijo dict: decidir si objeto o lista
            if len(rows_child) == 1:
                # objeto único
                child_row = rows_child[0]
                node[rel_field] = build_node(child, child_row)
            else:
                # varias filas → lista de objetos
                node[rel_field] = [build_node(child, r) for r in rows_child]

    return node

# ================== RECONSTRUIR RAÍZ ==================
# Por diseño de tu generador, los root tables suelen corresponder a listas en JSON.
# Así que devolvemos SIEMPRE una lista por cada raíz (aunque tenga 1 fila).
result = {}
for rt in root_tables:
    # filas de la raíz ordenadas por Identificador
    rows = sorted(all_rows[rt], key=lambda r: r["Identificador"])
    result[rt] = [build_node(rt, r) for r in rows]

# ================== SALIDA ==================
# 1) Como diccionario de Python:
python_dict_result = result

# 2) Guardar a JSON:
with open(OUTPUT_JSON, "w", encoding="utf-8") as f:
    json.dump(python_dict_result, f, ensure_ascii=False, indent=2)

print("✅ Recuperación completada.")
print(f"Tablas raíz detectadas: {', '.join(root_tables)}")
print(f"JSON guardado en: {OUTPUT_JSON}")

# (Opcional) imprimir una vista muy resumida
for k, v in python_dict_result.items():
    print(f"- {k}: {len(v)} elemento(s)")
```

### demostracion clase

```python
#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import json
import re
import hashlib
import mysql.connector
from collections import defaultdict, deque

class JsonMySQLBridge:
    """
    Convierte JSON<->MySQL de forma recursiva.
    Regla base: cada CLAVE del objeto raíz del JSON es una TABLA TOP-LEVEL.
    Las subestructuras (dict/list) se materializan como tablas hijas con FK al padre.
    Las listas de escalares se almacenan como (parent_id, idx, valor).
    """

    # ===================== CONSTRUCCIÓN =====================
    def __init__(self, host, user, password, database, json_path_default="./datos.json"):
        self.DB = dict(host=host, user=user, password=password, database=database)
        self.JSON_PATH = json_path_default

        # estado temporal para el ciclo "escritura" (json->mysql)
        self.tables = {}      # name -> TableDef
        self.edges = set()    # (parent, child)
        self._conn = None
        self._cur = None

    # ===================== IDENT & TYPES =====================
    @staticmethod
    def _ident(name: str) -> str:
        """Sanitiza identificadores MySQL (tabla/col)."""
        name = (name or "").strip().lower()
        name = re.sub(r'[^a-z0-9_]+', '_', name)
        name = re.sub(r'_+', '_', name).strip('_')
        if not name:
            name = "col"
        if name[0].isdigit():
            name = "n_" + name
        if name in {"index", "key", "primary", "value"}:
            name = "_" + name
        return name

    @staticmethod
    def _cap_name(name: str, maxlen: int = 64) -> str:
        """Corta y añade hash si excede maxlen (para constraints/índices)."""
        if len(name) <= maxlen:
            return name
        h = hashlib.sha1(name.encode("utf-8")).hexdigest()[:8]
        keep = maxlen - 1 - len(h)
        if keep < 1:
            keep = maxlen - len(h)
        return f"{name[:keep]}_{h}"

    def _fk_name(self, child: str, parent: str) -> str:
        return self._cap_name(f"fk_{child}_{parent}", 64)

    def _idx_name(self, child: str, parent: str) -> str:
        return self._cap_name(f"fk_{child}_{parent}", 64)

    @staticmethod
    def _sql_scalar_type(v):
        if isinstance(v, bool):  return "TINYINT(1)"
        if isinstance(v, int):   return "INT"
        if isinstance(v, float): return "DOUBLE"
        return "TEXT"

    @staticmethod
    def _merge_type(a, b):
        if a == b: return a
        pair = {a, b}
        if "TEXT" in pair: return "TEXT"
        if pair == {"INT","DOUBLE"}: return "DOUBLE"
        if pair == {"TINYINT(1)","INT"}: return "INT"
        return "TEXT"

    def _join_path(self, *parts) -> str:
        return self._ident("_".join([self._ident(p) for p in parts if p]))

    # ===================== MODELO DE TABLA =====================
    class TableDef:
        """kind: 'dict' | 'list_scalar'"""
        def __init__(self, name, parent=None, relname=None, kind='dict', ident_fn=None):
            self.name = ident_fn(name) if ident_fn else name
            self.parent = parent       # nombre tabla padre o None
            self.relname = relname     # nombre del campo en el padre
            self.kind = kind
            self.columns = {}          # solo para dict: col -> tipo SQL
            self.children = set()      # nombres de tablas hijas

    def _ensure_table(self, name, parent=None, relname=None, kind='dict'):
        tname = self._ident(name)
        if tname not in self.tables:
            self.tables[tname] = self.TableDef(tname, parent, relname, kind, self._ident)
        else:
            # subir de list_scalar a dict si hace falta
            if self.tables[tname].kind == 'list_scalar' and kind == 'dict':
                self.tables[tname].kind = 'dict'
        if parent:
            p = self._ident(parent)
            self.edges.add((p, tname))
            self.tables[p].children.add(tname)
        return self.tables[tname]

    # ===================== INFERENCIA (RECURSIVA) =====================
    def _infer_value(self, path_table: str, value, parent_table: str | None, relname: str | None):
        if isinstance(value, dict):
            t = self._ensure_table(path_table, parent_table, relname, kind='dict')
            for k, v in value.items():
                if isinstance(v, (dict, list)):
                    self._infer_value(self._join_path(path_table, k), v, t.name, k)
                else:
                    col = self._ident(k)
                    ttype = self._sql_scalar_type(v)
                    t.columns[col] = self._merge_type(t.columns.get(col, ttype), ttype)

        elif isinstance(value, list):
            elem_kind = "scalar"
            for el in value:
                elem_kind = "dict" if isinstance(el, dict) else "scalar"
                break
            if elem_kind == "dict":
                t = self._ensure_table(path_table, parent_table, relname, kind='dict')
                for el in value:
                    if not isinstance(el, dict):
                        continue
                    for k, v in el.items():
                        if isinstance(v, (dict, list)):
                            self._infer_value(self._join_path(path_table, k), v, t.name, k)
                        else:
                            col = self._ident(k)
                            ttype = self._sql_scalar_type(v)
                            t.columns[col] = self._merge_type(t.columns.get(col, ttype), ttype)
            else:
                self._ensure_table(path_table, parent_table, relname, kind='list_scalar')

        else:
            if parent_table is None:
                t = self._ensure_table(path_table, None, relname, kind='dict')
                t.columns['valor'] = self._merge_type(t.columns.get('valor', self._sql_scalar_type(value)),
                                                      self._sql_scalar_type(value))

    # ===================== TOPOLOGÍA & DDL =====================
    def _topo_tables(self):
        indeg = defaultdict(int)
        graph = defaultdict(list)
        for p, c in self.edges:
            graph[p].append(c)
            indeg[c] += 1
            if p not in indeg:
                indeg[p] = indeg[p]
        roots = [t for t in self.tables if indeg[t] == 0]
        q = deque(roots); out = []; seen = set()
        while q:
            u = q.popleft()
            if u in seen: continue
            seen.add(u); out.append(u)
            for v in graph[u]:
                indeg[v] -= 1
                if indeg[v] == 0:
                    q.append(v)
        for t in self.tables:
            if t not in seen: out.append(t)
        return out

    def _drop_entire_schema(self, cursor, dbname: str):
        cursor.execute("SET FOREIGN_KEY_CHECKS=0;")
        try:
            cursor.execute("""
                SELECT TABLE_NAME FROM information_schema.tables
                WHERE table_schema = %s
            """, (dbname,))
            for (tname,) in cursor.fetchall():
                cursor.execute(f"DROP TABLE IF EXISTS `{tname}`;")
        finally:
            cursor.execute("SET FOREIGN_KEY_CHECKS=1;")

    def _create_all(self, cursor):
        order = self._topo_tables()
        cursor.execute("SET FOREIGN_KEY_CHECKS=0;")
        try:
            for t in reversed(order):
                cursor.execute(f"DROP TABLE IF EXISTS `{t}`;")

            for tname in order:
                t = self.tables[tname]
                cols = ["`Identificador` INT NOT NULL AUTO_INCREMENT"]
                if t.parent:
                    cols.append(f"`{t.parent}_id` INT NOT NULL")
                if t.kind == 'dict':
                    for c, typ in t.columns.items():
                        cols.append(f"`{self._ident(c)}` {typ} DEFAULT NULL")
                else:
                    cols += ["`idx` INT NOT NULL", "`valor` TEXT DEFAULT NULL"]
                cols.append("PRIMARY KEY (`Identificador`)")

                fk_idx_sql = ""
                fk_sql = ""
                if t.parent:
                    keyn = self._idx_name(t.name, t.parent)
                    fkn = self._fk_name(t.name, t.parent)
                    fk_idx_sql = f", KEY `{keyn}` (`{t.parent}_id`)"
                    fk_sql = (f", CONSTRAINT `{fkn}` FOREIGN KEY (`{t.parent}_id`)"
                              f" REFERENCES `{t.parent}` (`Identificador`)"
                              f" ON DELETE CASCADE ON UPDATE CASCADE")

                ddl = f"""CREATE TABLE `{t.name}` (
                  {", ".join(cols)}
                  {fk_idx_sql}
                  {fk_sql}
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"""
                cursor.execute(ddl)
        finally:
            cursor.execute("SET FOREIGN_KEY_CHECKS=1;")

    # ===================== INSERT (RECURSIVA) =====================
    def _insert_list_scalar(self, cursor, tdef, value, parent_id: int | None):
        if not isinstance(value, list): value = [value]
        sql = f"INSERT INTO `{tdef.name}` (`{tdef.parent}_id`, `idx`, `valor`) VALUES (%s, %s, %s)"
        for i, el in enumerate(value):
            if isinstance(el, (dict, list)):
                try:
                    val = json.dumps(el, ensure_ascii=False)
                except Exception:
                    val = None
            else:
                val = el
            cursor.execute(sql, (parent_id, i, val))

    def _insert_dict_row(self, cursor, tdef, data: dict, parent_id: int | None):
        cols = []
        vals = []
        for c in tdef.columns:
            cols.append(f"`{self._ident(c)}`")
            v = data.get(c, None)
            if isinstance(v, (dict, list)): v = None
            vals.append(v)
        if tdef.parent:
            cols.insert(0, f"`{tdef.parent}_id`")
            vals.insert(0, parent_id)

        if cols:
            sql = f"INSERT INTO `{tdef.name}` ({', '.join(cols)}) VALUES ({', '.join(['%s']*len(cols))})"
            cursor.execute(sql, vals)
        else:
            if tdef.parent:
                cursor.execute(f"INSERT INTO `{tdef.name}` (`{tdef.parent}_id`) VALUES (%s)", (parent_id,))
            else:
                cursor.execute(f"INSERT INTO `{tdef.name}` () VALUES ()")

        new_id = cursor.lastrowid

        # hijos
        for k, v in data.items():
            if not isinstance(v, (dict, list)):
                continue
            child_name = self._join_path(tdef.name, k)
            child = self.tables.get(child_name)
            if child is None:
                if isinstance(v, dict):
                    child = self._ensure_table(child_name, tdef.name, k, kind='dict')
                    self._insert_dict_row(cursor, child, {}, new_id)
                continue
            if child.kind == 'dict':
                if isinstance(v, dict):
                    self._insert_dict_row(cursor, child, v, new_id)
                else:
                    for el in v:
                        if isinstance(el, dict):
                            self._insert_dict_row(cursor, child, el, new_id)
            else:
                self._insert_list_scalar(cursor, child, v, new_id)
        return new_id

    # ===================== API (WRITE) =====================
    def load_from_json(self, json_path: str | None = None):
        """Borra todas las tablas y carga el JSON a MySQL."""
        jp = json_path or self.JSON_PATH
        with open(jp, "r", encoding="utf-8") as f:
            root = json.load(f)
        return self.load_from_dict(root)

    def load_from_dict(self, root: dict):
        if not isinstance(root, dict):
            raise ValueError("El JSON raíz debe ser un objeto: cada clave es una tabla padre top-level.")

        # Inferencia de esquema
        self.tables.clear(); self.edges.clear()
        for top_key, top_val in root.items():
            top_table = self._ident(top_key)
            if isinstance(top_val, list):
                for el in top_val:
                    self._infer_value(top_table, el, parent_table=None, relname=None)
            else:
                self._infer_value(top_table, top_val, parent_table=None, relname=None)

        # Conectar, reset y crear
        self._conn = mysql.connector.connect(**self.DB)
        self._cur = self._conn.cursor()
        self._drop_entire_schema(self._cur, self.DB["database"])
        self._conn.commit()
        self._create_all(self._cur)
        self._conn.commit()

        # Insertar datos
        for top_key, top_val in root.items():
            top_table = self.tables[self._ident(top_key)]
            if isinstance(top_val, list):
                for el in top_val:
                    row = el if isinstance(el, dict) else {"valor": el}
                    self._insert_dict_row(self._cur, top_table, row, parent_id=None)
            elif isinstance(top_val, dict):
                self._insert_dict_row(self._cur, top_table, top_val, parent_id=None)
            else:
                self._insert_dict_row(self._cur, top_table, {"valor": top_val}, parent_id=None)

        self._conn.commit()
        self._cur.close()
        self._conn.close()
        self._cur = None; self._conn = None
        return True

    # ===================== API (READ) =====================
    @staticmethod
    def _fetchall_dict(cur, sql, params=None):
        cur.execute(sql, params or ())
        cols = [d[0] for d in cur.description]
        return [dict(zip(cols, row)) for row in cur.fetchall()]

    @staticmethod
    def _is_list_scalar_table(columns: set[str]) -> bool:
        return "idx" in columns and "valor" in columns

    def _child_field_name(self, parent: str, child: str) -> str:
        prefix = parent + "_"
        if child.startswith(prefix):
            return child[len(prefix):]
        return child

    def dump_to_json(self, output_path: str = "./dump_recuperado.json") -> dict:
        """Lee toda la BD y reconstruye el dict raíz; además, guarda el JSON."""
        conn = mysql.connector.connect(**self.DB)
        cur = conn.cursor()
        db = self.DB["database"]

        # Tablas
        tables = [r["TABLE_NAME"] for r in self._fetchall_dict(
            cur,
            "SELECT TABLE_NAME FROM information_schema.tables WHERE table_schema=%s AND TABLE_TYPE='BASE TABLE'",
            (db,)
        )]
        if not tables:
            raise RuntimeError("No hay tablas en la base de datos.")

        # Columnas
        table_columns = {}
        for t in tables:
            rows = self._fetchall_dict(cur, """
                SELECT COLUMN_NAME
                FROM information_schema.columns
                WHERE table_schema=%s AND table_name=%s
                ORDER BY ORDINAL_POSITION
            """, (db, t))
            table_columns[t] = [r["COLUMN_NAME"] for r in rows]

        # FKs
        rels = self._fetchall_dict(cur, """
            SELECT
              kcu.TABLE_NAME AS child_table,
              kcu.COLUMN_NAME AS child_column,
              kcu.REFERENCED_TABLE_NAME AS parent_table,
              kcu.REFERENCED_COLUMN_NAME AS parent_column
            FROM information_schema.KEY_COLUMN_USAGE kcu
            WHERE kcu.TABLE_SCHEMA=%s
              AND kcu.REFERENCED_TABLE_NAME IS NOT NULL
        """, (db,))

        parent_of = {}
        fk_col_of_child = {}
        children_of = defaultdict(list)
        for r in rels:
            child = r["child_table"]
            parent = r["parent_table"]
            parent_of[child] = parent
            fk_col_of_child[child] = r["child_column"]
            children_of[parent].append(child)

        root_tables = [t for t in tables if t not in parent_of]

        # Cache de filas
        all_rows = {}
        for t in tables:
            all_rows[t] = self._fetchall_dict(cur, f"SELECT * FROM `{t}`")

        # Indexados por padre
        child_rows_by_parent = defaultdict(list)
        for child in parent_of:
            fk = fk_col_of_child[child]
            for row in all_rows[child]:
                pid = row.get(fk)
                if pid is not None:
                    child_rows_by_parent[(child, pid)].append(row)

        def build_node(table: str, row: dict) -> dict:
            cols = table_columns[table]
            fk_col = fk_col_of_child.get(table)
            scalar_cols = [c for c in cols if c not in {"Identificador", "idx", "valor"} and c != fk_col]

            node = {}
            for c in scalar_cols:
                node[c] = row.get(c)

            for child in children_of.get(table, []):
                rel_field = self._child_field_name(table, child)
                child_cols = set(table_columns[child])
                rows_child = child_rows_by_parent.get((child, row["Identificador"]), [])
                if not rows_child:
                    continue

                if self._is_list_scalar_table(child_cols):
                    seq = sorted(
                        [(rc.get("idx"), rc.get("valor")) for rc in rows_child],
                        key=lambda x: (x[0] if x[0] is not None else 0)
                    )
                    node[rel_field] = [val for _, val in seq]
                else:
                    if len(rows_child) == 1:
                        node[rel_field] = build_node(child, rows_child[0])
                    else:
                        node[rel_field] = [build_node(child, r) for r in rows_child]
            return node

        result = {}
        for rt in root_tables:
            rows = sorted(all_rows[rt], key=lambda r: r["Identificador"])
            result[rt] = [build_node(rt, r) for r in rows]

        with open(output_path, "w", encoding="utf-8") as f:
            json.dump(result, f, ensure_ascii=False, indent=2)

        cur.close(); conn.close()
        return result


# ===================== DEMO =====================
if __name__ == "__main__":
    # Configura tus credenciales y el path del JSON
    bridge = JsonMySQLBridge(
        host="localhost",
        user="desfase",
        password="desfase",
        database="desfase",
        json_path_default="./datos.json"  # JSON de entrada
    )

    # ---- 1) ESCRIBIR: JSON -> MySQL ----
    # Carga el JSON y crea toda la estructura + inserta datos
    bridge.load_from_json()  # usa ./datos.json por defecto

    # ---- 2) LEER: MySQL -> JSON ----
    recovered = bridge.dump_to_json("./dump_recuperado.json")

    print("✅ Hecho. Resumen (primer nivel):")
    for k, v in recovered.items():
        print(f"- {k}: {len(v)} elemento(s)")
```

### uso de la clase

```python
from jvorm import JsonMySQLBridge

bridge = JsonMySQLBridge(
    host="localhost",
    user="desfase",
    password="desfase",
    database="desfase",
    json_path_default="./datos.json"  # JSON de entrada
)

bridge.load_from_json()  # usa ./datos.json por defecto

recovered = bridge.dump_to_json("./dump_recuperado.json")

print("✅ Hecho. Resumen (primer nivel):")
for k, v in recovered.items():
    print(f"- {k}: {len(v)} elemento(s)")
```

### datos

```json
{
  "clientes": [
    {
      "id": 1,
      "nombre": "Vicente Carratala",
      "informacion_contacto": {
        "email": "vicente.carratala@example.com",
        "telefonos": [
          {
            "tipo": "móvil",
            "numero": "+34 600 123 456"
          },
          {
            "tipo": "fijo",
            "numero": "+34 965 789 012"
          }
        ],
        "direccion": {
          "calle": "Calle Mayor",
          "numero": 45,
          "piso": "3º B",
          "ciudad": "Alicante",
          "codigo_postal": "03001",
          "pais": "España"
        }
      },
      "historial_compras": [
        {
          "id_compra": "CMP-2025-001",
          "fecha": "2025-01-15",
          "productos": [
            {
              "id_producto": 101,
              "nombre": "Portátil Gamer",
              "cantidad": 1,
              "precio_unitario": 1299.99
            },
            {
              "id_producto": 205,
              "nombre": "Ratón Inalámbrico",
              "cantidad": 2,
              "precio_unitario": 49.99
            }
          ],
          "total": 1399.97
        },
        {
          "id_compra": "CMP-2025-002",
          "fecha": "2025-05-20",
          "productos": [
            {
              "id_producto": 307,
              "nombre": "Monitor 27\"",
              "cantidad": 1,
              "precio_unitario": 299.99
            }
          ],
          "total": 299.99
        }
      ],
      "preferencias": {
        "notificaciones": {
          "email": true,
          "sms": false,
          "push": true
        },
        "idioma": "español",
        "categorias_interes": ["tecnología", "deportes"]
      }
    },
    {
      "id": 2,
      "nombre": "Ana López",
      "informacion_contacto": {
        "email": "ana.lopez@example.com",
        "telefonos": [
          {
            "tipo": "móvil",
            "numero": "+34 678 901 234"
          }
        ],
        "direccion": {
          "calle": "Avenida Diagonal",
          "numero": 123,
          "piso": "1º A",
          "ciudad": "Barcelona",
          "codigo_postal": "08018",
          "pais": "España"
        }
      },
      "historial_compras": [
        {
          "id_compra": "CMP-2025-003",
          "fecha": "2025-03-10",
          "productos": [
            {
              "id_producto": 402,
              "nombre": "Tablet 10\"",
              "cantidad": 1,
              "precio_unitario": 349.99
            }
          ],
          "total": 349.99
        }
      ],
      "preferencias": {
        "notificaciones": {
          "email": true,
          "sms": true,
          "push": false
        },
        "idioma": "catalán",
        "categorias_interes": ["libros", "moda"]
      }
    }
  ]
}
```

### dump_recuperado

```json
{
  "clientes": [
    {
      "id": 1,
      "nombre": "Vicente Carratala",
      "historial_compras": [
        {
          "id_compra": "CMP-2025-001",
          "fecha": "2025-01-15",
          "total": 1399.97,
          "productos": [
            {
              "id_producto": 101,
              "nombre": "Portátil Gamer",
              "cantidad": 1,
              "precio_unitario": 1299.99
            },
            {
              "id_producto": 205,
              "nombre": "Ratón Inalámbrico",
              "cantidad": 2,
              "precio_unitario": 49.99
            }
          ]
        },
        {
          "id_compra": "CMP-2025-002",
          "fecha": "2025-05-20",
          "total": 299.99,
          "productos": {
            "id_producto": 307,
            "nombre": "Monitor 27\"",
            "cantidad": 1,
            "precio_unitario": 299.99
          }
        }
      ],
      "informacion_contacto": {
        "email": "vicente.carratala@example.com",
        "direccion": {
          "calle": "Calle Mayor",
          "numero": 45,
          "piso": "3º B",
          "ciudad": "Alicante",
          "codigo_postal": "03001",
          "pais": "España"
        },
        "telefonos": [
          {
            "tipo": "móvil",
            "numero": "+34 600 123 456"
          },
          {
            "tipo": "fijo",
            "numero": "+34 965 789 012"
          }
        ]
      },
      "preferencias": {
        "idioma": "español",
        "categorias_interes": [
          "tecnología",
          "deportes"
        ],
        "notificaciones": {
          "email": 1,
          "sms": 0,
          "push": 1
        }
      }
    },
    {
      "id": 2,
      "nombre": "Ana López",
      "historial_compras": {
        "id_compra": "CMP-2025-003",
        "fecha": "2025-03-10",
        "total": 349.99,
        "productos": {
          "id_producto": 402,
          "nombre": "Tablet 10\"",
          "cantidad": 1,
          "precio_unitario": 349.99
        }
      },
      "informacion_contacto": {
        "email": "ana.lopez@example.com",
        "direccion": {
          "calle": "Avenida Diagonal",
          "numero": 123,
          "piso": "1º A",
          "ciudad": "Barcelona",
          "codigo_postal": "08018",
          "pais": "España"
        },
        "telefonos": {
          "tipo": "móvil",
          "numero": "+34 678 901 234"
        }
      },
      "preferencias": {
        "idioma": "catalán",
        "categorias_interes": [
          "libros",
          "moda"
        ],
        "notificaciones": {
          "email": 1,
          "sms": 1,
          "push": 0
        }
      }
    }
  ]
}
```

### jvorm

```python
#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import json
import re
import hashlib
import mysql.connector
from collections import defaultdict, deque

class JsonMySQLBridge:
    """
    Convierte JSON<->MySQL de forma recursiva.
    Regla base: cada CLAVE del objeto raíz del JSON es una TABLA TOP-LEVEL.
    Las subestructuras (dict/list) se materializan como tablas hijas con FK al padre.
    Las listas de escalares se almacenan como (parent_id, idx, valor).
    """

    # ===================== CONSTRUCCIÓN =====================
    def __init__(self, host, user, password, database, json_path_default="./datos.json"):
        self.DB = dict(host=host, user=user, password=password, database=database)
        self.JSON_PATH = json_path_default

        # estado temporal para el ciclo "escritura" (json->mysql)
        self.tables = {}      # name -> TableDef
        self.edges = set()    # (parent, child)
        self._conn = None
        self._cur = None

    # ===================== IDENT & TYPES =====================
    @staticmethod
    def _ident(name: str) -> str:
        """Sanitiza identificadores MySQL (tabla/col)."""
        name = (name or "").strip().lower()
        name = re.sub(r'[^a-z0-9_]+', '_', name)
        name = re.sub(r'_+', '_', name).strip('_')
        if not name:
            name = "col"
        if name[0].isdigit():
            name = "n_" + name
        if name in {"index", "key", "primary", "value"}:
            name = "_" + name
        return name

    @staticmethod
    def _cap_name(name: str, maxlen: int = 64) -> str:
        """Corta y añade hash si excede maxlen (para constraints/índices)."""
        if len(name) <= maxlen:
            return name
        h = hashlib.sha1(name.encode("utf-8")).hexdigest()[:8]
        keep = maxlen - 1 - len(h)
        if keep < 1:
            keep = maxlen - len(h)
        return f"{name[:keep]}_{h}"

    def _fk_name(self, child: str, parent: str) -> str:
        return self._cap_name(f"fk_{child}_{parent}", 64)

    def _idx_name(self, child: str, parent: str) -> str:
        return self._cap_name(f"fk_{child}_{parent}", 64)

    @staticmethod
    def _sql_scalar_type(v):
        if isinstance(v, bool):  return "TINYINT(1)"
        if isinstance(v, int):   return "INT"
        if isinstance(v, float): return "DOUBLE"
        return "TEXT"

    @staticmethod
    def _merge_type(a, b):
        if a == b: return a
        pair = {a, b}
        if "TEXT" in pair: return "TEXT"
        if pair == {"INT","DOUBLE"}: return "DOUBLE"
        if pair == {"TINYINT(1)","INT"}: return "INT"
        return "TEXT"

    def _join_path(self, *parts) -> str:
        return self._ident("_".join([self._ident(p) for p in parts if p]))

    # ===================== MODELO DE TABLA =====================
    class TableDef:
        """kind: 'dict' | 'list_scalar'"""
        def __init__(self, name, parent=None, relname=None, kind='dict', ident_fn=None):
            self.name = ident_fn(name) if ident_fn else name
            self.parent = parent       # nombre tabla padre o None
            self.relname = relname     # nombre del campo en el padre
            self.kind = kind
            self.columns = {}          # solo para dict: col -> tipo SQL
            self.children = set()      # nombres de tablas hijas

    def _ensure_table(self, name, parent=None, relname=None, kind='dict'):
        tname = self._ident(name)
        if tname not in self.tables:
            self.tables[tname] = self.TableDef(tname, parent, relname, kind, self._ident)
        else:
            # subir de list_scalar a dict si hace falta
            if self.tables[tname].kind == 'list_scalar' and kind == 'dict':
                self.tables[tname].kind = 'dict'
        if parent:
            p = self._ident(parent)
            self.edges.add((p, tname))
            self.tables[p].children.add(tname)
        return self.tables[tname]

    # ===================== INFERENCIA (RECURSIVA) =====================
    def _infer_value(self, path_table: str, value, parent_table: str | None, relname: str | None):
        if isinstance(value, dict):
            t = self._ensure_table(path_table, parent_table, relname, kind='dict')
            for k, v in value.items():
                if isinstance(v, (dict, list)):
                    self._infer_value(self._join_path(path_table, k), v, t.name, k)
                else:
                    col = self._ident(k)
                    ttype = self._sql_scalar_type(v)
                    t.columns[col] = self._merge_type(t.columns.get(col, ttype), ttype)

        elif isinstance(value, list):
            elem_kind = "scalar"
            for el in value:
                elem_kind = "dict" if isinstance(el, dict) else "scalar"
                break
            if elem_kind == "dict":
                t = self._ensure_table(path_table, parent_table, relname, kind='dict')
                for el in value:
                    if not isinstance(el, dict):
                        continue
                    for k, v in el.items():
                        if isinstance(v, (dict, list)):
                            self._infer_value(self._join_path(path_table, k), v, t.name, k)
                        else:
                            col = self._ident(k)
                            ttype = self._sql_scalar_type(v)
                            t.columns[col] = self._merge_type(t.columns.get(col, ttype), ttype)
            else:
                self._ensure_table(path_table, parent_table, relname, kind='list_scalar')

        else:
            if parent_table is None:
                t = self._ensure_table(path_table, None, relname, kind='dict')
                t.columns['valor'] = self._merge_type(t.columns.get('valor', self._sql_scalar_type(value)),
                                                      self._sql_scalar_type(value))

    # ===================== TOPOLOGÍA & DDL =====================
    def _topo_tables(self):
        indeg = defaultdict(int)
        graph = defaultdict(list)
        for p, c in self.edges:
            graph[p].append(c)
            indeg[c] += 1
            if p not in indeg:
                indeg[p] = indeg[p]
        roots = [t for t in self.tables if indeg[t] == 0]
        q = deque(roots); out = []; seen = set()
        while q:
            u = q.popleft()
            if u in seen: continue
            seen.add(u); out.append(u)
            for v in graph[u]:
                indeg[v] -= 1
                if indeg[v] == 0:
                    q.append(v)
        for t in self.tables:
            if t not in seen: out.append(t)
        return out

    def _drop_entire_schema(self, cursor, dbname: str):
        cursor.execute("SET FOREIGN_KEY_CHECKS=0;")
        try:
            cursor.execute("""
                SELECT TABLE_NAME FROM information_schema.tables
                WHERE table_schema = %s
            """, (dbname,))
            for (tname,) in cursor.fetchall():
                cursor.execute(f"DROP TABLE IF EXISTS `{tname}`;")
        finally:
            cursor.execute("SET FOREIGN_KEY_CHECKS=1;")

    def _create_all(self, cursor):
        order = self._topo_tables()
        cursor.execute("SET FOREIGN_KEY_CHECKS=0;")
        try:
            for t in reversed(order):
                cursor.execute(f"DROP TABLE IF EXISTS `{t}`;")

            for tname in order:
                t = self.tables[tname]
                cols = ["`Identificador` INT NOT NULL AUTO_INCREMENT"]
                if t.parent:
                    cols.append(f"`{t.parent}_id` INT NOT NULL")
                if t.kind == 'dict':
                    for c, typ in t.columns.items():
                        cols.append(f"`{self._ident(c)}` {typ} DEFAULT NULL")
                else:
                    cols += ["`idx` INT NOT NULL", "`valor` TEXT DEFAULT NULL"]
                cols.append("PRIMARY KEY (`Identificador`)")

                fk_idx_sql = ""
                fk_sql = ""
                if t.parent:
                    keyn = self._idx_name(t.name, t.parent)
                    fkn = self._fk_name(t.name, t.parent)
                    fk_idx_sql = f", KEY `{keyn}` (`{t.parent}_id`)"
                    fk_sql = (f", CONSTRAINT `{fkn}` FOREIGN KEY (`{t.parent}_id`)"
                              f" REFERENCES `{t.parent}` (`Identificador`)"
                              f" ON DELETE CASCADE ON UPDATE CASCADE")

                ddl = f"""CREATE TABLE `{t.name}` (
                  {", ".join(cols)}
                  {fk_idx_sql}
                  {fk_sql}
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"""
                cursor.execute(ddl)
        finally:
            cursor.execute("SET FOREIGN_KEY_CHECKS=1;")

    # ===================== INSERT (RECURSIVA) =====================
    def _insert_list_scalar(self, cursor, tdef, value, parent_id: int | None):
        if not isinstance(value, list): value = [value]
        sql = f"INSERT INTO `{tdef.name}` (`{tdef.parent}_id`, `idx`, `valor`) VALUES (%s, %s, %s)"
        for i, el in enumerate(value):
            if isinstance(el, (dict, list)):
                try:
                    val = json.dumps(el, ensure_ascii=False)
                except Exception:
                    val = None
            else:
                val = el
            cursor.execute(sql, (parent_id, i, val))

    def _insert_dict_row(self, cursor, tdef, data: dict, parent_id: int | None):
        cols = []
        vals = []
        for c in tdef.columns:
            cols.append(f"`{self._ident(c)}`")
            v = data.get(c, None)
            if isinstance(v, (dict, list)): v = None
            vals.append(v)
        if tdef.parent:
            cols.insert(0, f"`{tdef.parent}_id`")
            vals.insert(0, parent_id)

        if cols:
            sql = f"INSERT INTO `{tdef.name}` ({', '.join(cols)}) VALUES ({', '.join(['%s']*len(cols))})"
            cursor.execute(sql, vals)
        else:
            if tdef.parent:
                cursor.execute(f"INSERT INTO `{tdef.name}` (`{tdef.parent}_id`) VALUES (%s)", (parent_id,))
            else:
                cursor.execute(f"INSERT INTO `{tdef.name}` () VALUES ()")

        new_id = cursor.lastrowid

        # hijos
        for k, v in data.items():
            if not isinstance(v, (dict, list)):
                continue
            child_name = self._join_path(tdef.name, k)
            child = self.tables.get(child_name)
            if child is None:
                if isinstance(v, dict):
                    child = self._ensure_table(child_name, tdef.name, k, kind='dict')
                    self._insert_dict_row(cursor, child, {}, new_id)
                continue
            if child.kind == 'dict':
                if isinstance(v, dict):
                    self._insert_dict_row(cursor, child, v, new_id)
                else:
                    for el in v:
                        if isinstance(el, dict):
                            self._insert_dict_row(cursor, child, el, new_id)
            else:
                self._insert_list_scalar(cursor, child, v, new_id)
        return new_id

    # ===================== API (WRITE) =====================
    def load_from_json(self, json_path: str | None = None):
        """Borra todas las tablas y carga el JSON a MySQL."""
        jp = json_path or self.JSON_PATH
        with open(jp, "r", encoding="utf-8") as f:
            root = json.load(f)
        return self.load_from_dict(root)

    def load_from_dict(self, root: dict):
        if not isinstance(root, dict):
            raise ValueError("El JSON raíz debe ser un objeto: cada clave es una tabla padre top-level.")

        # Inferencia de esquema
        self.tables.clear(); self.edges.clear()
        for top_key, top_val in root.items():
            top_table = self._ident(top_key)
            if isinstance(top_val, list):
                for el in top_val:
                    self._infer_value(top_table, el, parent_table=None, relname=None)
            else:
                self._infer_value(top_table, top_val, parent_table=None, relname=None)

        # Conectar, reset y crear
        self._conn = mysql.connector.connect(**self.DB)
        self._cur = self._conn.cursor()
        self._drop_entire_schema(self._cur, self.DB["database"])
        self._conn.commit()
        self._create_all(self._cur)
        self._conn.commit()

        # Insertar datos
        for top_key, top_val in root.items():
            top_table = self.tables[self._ident(top_key)]
            if isinstance(top_val, list):
                for el in top_val:
                    row = el if isinstance(el, dict) else {"valor": el}
                    self._insert_dict_row(self._cur, top_table, row, parent_id=None)
            elif isinstance(top_val, dict):
                self._insert_dict_row(self._cur, top_table, top_val, parent_id=None)
            else:
                self._insert_dict_row(self._cur, top_table, {"valor": top_val}, parent_id=None)

        self._conn.commit()
        self._cur.close()
        self._conn.close()
        self._cur = None; self._conn = None
        return True

    # ===================== API (READ) =====================
    @staticmethod
    def _fetchall_dict(cur, sql, params=None):
        cur.execute(sql, params or ())
        cols = [d[0] for d in cur.description]
        return [dict(zip(cols, row)) for row in cur.fetchall()]

    @staticmethod
    def _is_list_scalar_table(columns: set[str]) -> bool:
        return "idx" in columns and "valor" in columns

    def _child_field_name(self, parent: str, child: str) -> str:
        prefix = parent + "_"
        if child.startswith(prefix):
            return child[len(prefix):]
        return child

    def dump_to_json(self, output_path: str = "./dump_recuperado.json") -> dict:
        """Lee toda la BD y reconstruye el dict raíz; además, guarda el JSON."""
        conn = mysql.connector.connect(**self.DB)
        cur = conn.cursor()
        db = self.DB["database"]

        # Tablas
        tables = [r["TABLE_NAME"] for r in self._fetchall_dict(
            cur,
            "SELECT TABLE_NAME FROM information_schema.tables WHERE table_schema=%s AND TABLE_TYPE='BASE TABLE'",
            (db,)
        )]
        if not tables:
            raise RuntimeError("No hay tablas en la base de datos.")

        # Columnas
        table_columns = {}
        for t in tables:
            rows = self._fetchall_dict(cur, """
                SELECT COLUMN_NAME
                FROM information_schema.columns
                WHERE table_schema=%s AND table_name=%s
                ORDER BY ORDINAL_POSITION
            """, (db, t))
            table_columns[t] = [r["COLUMN_NAME"] for r in rows]

        # FKs
        rels = self._fetchall_dict(cur, """
            SELECT
              kcu.TABLE_NAME AS child_table,
              kcu.COLUMN_NAME AS child_column,
              kcu.REFERENCED_TABLE_NAME AS parent_table,
              kcu.REFERENCED_COLUMN_NAME AS parent_column
            FROM information_schema.KEY_COLUMN_USAGE kcu
            WHERE kcu.TABLE_SCHEMA=%s
              AND kcu.REFERENCED_TABLE_NAME IS NOT NULL
        """, (db,))

        parent_of = {}
        fk_col_of_child = {}
        children_of = defaultdict(list)
        for r in rels:
            child = r["child_table"]
            parent = r["parent_table"]
            parent_of[child] = parent
            fk_col_of_child[child] = r["child_column"]
            children_of[parent].append(child)

        root_tables = [t for t in tables if t not in parent_of]

        # Cache de filas
        all_rows = {}
        for t in tables:
            all_rows[t] = self._fetchall_dict(cur, f"SELECT * FROM `{t}`")

        # Indexados por padre
        child_rows_by_parent = defaultdict(list)
        for child in parent_of:
            fk = fk_col_of_child[child]
            for row in all_rows[child]:
                pid = row.get(fk)
                if pid is not None:
                    child_rows_by_parent[(child, pid)].append(row)

        def build_node(table: str, row: dict) -> dict:
            cols = table_columns[table]
            fk_col = fk_col_of_child.get(table)
            scalar_cols = [c for c in cols if c not in {"Identificador", "idx", "valor"} and c != fk_col]

            node = {}
            for c in scalar_cols:
                node[c] = row.get(c)

            for child in children_of.get(table, []):
                rel_field = self._child_field_name(table, child)
                child_cols = set(table_columns[child])
                rows_child = child_rows_by_parent.get((child, row["Identificador"]), [])
                if not rows_child:
                    continue

                if self._is_list_scalar_table(child_cols):
                    seq = sorted(
                        [(rc.get("idx"), rc.get("valor")) for rc in rows_child],
                        key=lambda x: (x[0] if x[0] is not None else 0)
                    )
                    node[rel_field] = [val for _, val in seq]
                else:
                    if len(rows_child) == 1:
                        node[rel_field] = build_node(child, rows_child[0])
                    else:
                        node[rel_field] = [build_node(child, r) for r in rows_child]
            return node

        result = {}
        for rt in root_tables:
            rows = sorted(all_rows[rt], key=lambda r: r["Identificador"])
            result[rt] = [build_node(rt, r) for r in rows]

        with open(output_path, "w", encoding="utf-8") as f:
            json.dump(result, f, ensure_ascii=False, indent=2)

        cur.close(); conn.close()
        return result
```

<a id="protocolos-de-acceso-a-bases-de-datos"></a>
## Protocolos de acceso a bases de datos

En este capítulo, exploramos los protocolos de acceso a bases de datos, un aspecto fundamental para el desarrollo de aplicaciones que interactúan con sistemas de almacenamiento persistente. Comenzamos por entender qué son los protocolos de acceso a bases de datos y cómo funcionan en la comunicación entre una aplicación y una base de datos.

Los protocolos de acceso a bases de datos definen las reglas y formatos utilizados para establecer conexiones, enviar comandos y recibir respuestas entre el cliente (la aplicación) y el servidor (el gestor de la base de datos). Estos protocolos son esenciales porque aseguran que tanto el cliente como el servidor puedan entender y procesar las solicitudes y respuestas de manera correcta.

Un ejemplo común de protocolo de acceso a bases de datos es SQL (Structured Query Language), utilizado principalmente con sistemas de gestión de bases de datos relacionales. SQL permite a los usuarios crear, modificar y gestionar la información almacenada en una base de datos mediante comandos estructurados. Otro protocolo importante es el Protocolo de Control de Transmisión (TCP/IP), que se utiliza para establecer conexiones entre diferentes sistemas en una red.

La elección del protocolo adecuado depende de varios factores, como la complejidad de las operaciones a realizar, la seguridad necesaria y la eficiencia requerida. Por ejemplo, si se necesita una comunicación rápida y segura, el protocolo SSL/TLS puede ser preferido sobre HTTP/HTTPS. En cambio, para aplicaciones que requieren un alto nivel de control y personalización, SQL podría ser más adecuado.

Además de los protocolos de acceso a bases de datos, también es importante entender cómo se establecen y gestionan las conexiones entre el cliente y el servidor. Esto implica conocer conceptos como la autenticación, la autorización y la gestión de sesiones. La autenticación verifica la identidad del usuario o aplicación que intenta acceder a la base de datos, mientras que la autorización determina qué acciones puede realizar una vez autenticado. La gestión de sesiones permite mantener el estado de la conexión entre las solicitudes realizadas por un cliente.

En esta subunidad, hemos explorado los protocolos de acceso a bases de datos y cómo se utilizan para establecer conexiones seguras y eficientes entre aplicaciones y sistemas de almacenamiento persistente. Comprendiendo estos conceptos es crucial para el desarrollo de software que requiere interactuar con bases de datos, ya que permite crear aplicaciones robustas y seguras capaces de manejar grandes volúmenes de información de manera eficiente.

### prerrequisitos

```sql
sudo mysql -u root -p

CREATE DATABASE accesoadatos2526;

CREATE USER 
'accesoadatos2526'@'localhost' 
IDENTIFIED BY 'Accesoadatos2526$';

GRANT USAGE ON *.* TO 'accesoadatos2526'@'localhost';

ALTER USER 'accesoadatos2526'@'localhost' 
REQUIRE NONE 
WITH MAX_QUERIES_PER_HOUR 0 
MAX_CONNECTIONS_PER_HOUR 0 
MAX_UPDATES_PER_HOUR 0 
MAX_USER_CONNECTIONS 0;

GRANT ALL PRIVILEGES ON `accesoadatos2526`.* 
TO 'accesoadatos2526'@'localhost';
```

### conectar con base de datos

```python
import mysql.connector

conexion = mysql.connector.connect(
    host="localhost",
    user="accesoadatos2526",
    password="Accesoadatos2526$",
    database="accesoadatos2526"
)

cursor = conexion.cursor()

cursor.execute('''
  CREATE TABLE `clientes` (
  `Identificador` INT NOT NULL , 
  `nombre` VARCHAR(50) NOT NULL , 
  `apellidos` VARCHAR(100) NOT NULL , 
  `email` VARCHAR(50) NOT NULL  
) ENGINE = InnoDB;
''')

conexion.commit()

cursor.close()
conexion.close()
```

### comprobacion

```sql
SHOW TABLES;

DESCRIBE clientes;
```

<a id="establecimiento-de-conexiones"></a>
## Establecimiento de conexiones

En la subunidad "Establecimiento de conexiones" del manejo de conectores, se aborda el proceso fundamental para establecer una comunicación efectiva entre un programa y una base de datos. Este paso es crucial para cualquier aplicación que requiera acceso a información persistente.

El primer aspecto a considerar es la elección del protocolo adecuado para la conexión. Los protocolos como TCP/IP son fundamentales en el mundo de las redes, proporcionando una comunicación bidireccional y confiable entre dos puntos finales. En el contexto de bases de datos, los protocolos específicos como SQL (Structured Query Language) o NoSQL se utilizan para interactuar con diferentes tipos de sistemas gestores de base de datos.

El establecimiento de una conexión implica la configuración correcta de parámetros que identifican al servidor y especifican el tipo de comunicación. Esto incluye la dirección IP del servidor, el número de puerto en el que escucha el servicio, las credenciales de acceso (usuario y contraseña) y, en algunos casos, detalles adicionales como el nombre de la base de datos a la que se desea conectarse.

Es importante destacar que el proceso de establecimiento de conexión debe ser seguro. Para esto, se utilizan técnicas como SSL/TLS para cifrar los datos transmitidos entre el cliente y el servidor, protegiendo así la información sensible durante su transmisión.

Una vez establecida la conexión, el programa puede comenzar a realizar operaciones básicas como la ejecución de consultas SQL o la manipulación de datos. La gestión adecuada de las conexiones es esencial para evitar problemas de rendimiento y mantener la integridad de los datos.

Es común que los programas manejen múltiples conexiones simultáneamente, lo que requiere una gestión cuidadosa de los recursos y la coordinación entre diferentes hilos o procesos. Herramientas y bibliotecas específicas para el manejo de bases de datos proporcionan funcionalidades avanzadas para facilitar este proceso.

En resumen, establecer conexiones es un paso fundamental en el acceso a datos, permitiendo que los programas interactúen con sistemas gestores de base de datos de manera segura y eficiente. Este proceso implica la elección del protocolo adecuado, la configuración correcta de parámetros de conexión, y la implementación de medidas de seguridad para proteger la información durante su transmisión.

### insertar un cliente de prueba

```python
import mysql.connector

conexion = mysql.connector.connect(
    host="localhost",
    user="accesoadatos2526",
    password="Accesoadatos2526$",
    database="accesoadatos2526"
)

cursor = conexion.cursor()

cursor.execute('''
  INSERT INTO clientes
  VALUES(
    1,
    "Jose Vicente",
    "Carratala Sanchis",
    "info@jocarsa.com"
  );
''')

conexion.commit()

cursor.close()
conexion.close()
```

### ejecutar consulta de alteracion

```python
import mysql.connector

conexion = mysql.connector.connect(
    host="localhost",
    user="accesoadatos2526",
    password="Accesoadatos2526$",
    database="accesoadatos2526"
)

cursor = conexion.cursor()


  


cursor.execute('''
  ALTER TABLE clientes
  ADD PRIMARY KEY (`Identificador`);
''')

cursor.execute('''
  ALTER TABLE clientes
MODIFY COLUMN Identificador INT NOT NULL AUTO_INCREMENT;
''')

conexion.commit()

cursor.close()
conexion.close()
```

### inserto cliente con null

```python
import mysql.connector

conexion = mysql.connector.connect(
    host="localhost",
    user="accesoadatos2526",
    password="Accesoadatos2526$",
    database="accesoadatos2526"
)

cursor = conexion.cursor()

cursor.execute('''
  INSERT INTO clientes
  VALUES(
    NULL,
    "Jose Vicente",
    "Carratala Sanchis",
    "info@jocarsa.com"
  );
''')

conexion.commit()

cursor.close()
conexion.close()
```

<a id="ejecucion-de-sentencias-de-descripcion-de-datos"></a>
## Ejecución de sentencias de descripción de datos

En esta subunidad del curso, nos adentramos en la ejecución de sentencias de descripción de datos, un aspecto crucial para el manejo de conectores en sistemas de acceso a bases de datos. Comenzamos por entender que las sentencias de descripción de datos son aquellas que permiten obtener información sobre la estructura y organización de los objetos dentro de una base de datos. Estas incluyen consultas que devuelven metadatos, como el nombre de las tablas, campos, tipos de datos y relaciones entre ellas.

A continuación, exploramos cómo establecer conexiones con bases de datos utilizando protocolos estándar de comunicación en red a nivel de aplicación. Esto implica conocer los diferentes roles que pueden desempeñar tanto el cliente como el servidor en la transmisión de información. Además, aprendemos sobre las librerías y clases disponibles para facilitar este proceso, lo cual es fundamental para desarrolladores que quieran interactuar con bases de datos sin necesidad de escribir desde cero los protocolos de comunicación.

Una vez establecida la conexión, el siguiente paso es ejecutar sentencias de descripción de datos. Estas pueden ser consultas SQL que devuelven información sobre las tablas y campos disponibles en la base de datos. Por ejemplo, una consulta podría devolver todos los nombres de las tablas o todas las columnas de una tabla específica. Es importante entender cómo formular estas consultas correctamente para obtener los resultados deseados.

Además de las consultas básicas, también es necesario aprender a manejar excepciones que pueden surgir durante la ejecución de estas sentencias. Las excepciones son eventos inesperados que ocurren durante el proceso de ejecución y que pueden interrumpir el flujo normal del programa. Es crucial conocer cómo detectar y tratar estas excepciones para mantener la robustez del sistema.

Continuando, nos centramos en la ejecución de sentencias de modificación de datos, aunque este tema se aborda más a fondo en una subunidad posterior. Sin embargo, es importante recordar que las consultas de descripción de datos son un paso previo crucial para entender cómo interactuar con los datos almacenados.

A medida que avanzamos, nos familiarizamos con la ejecución de consultas y el manejo del resultado. Aprenderemos a realizar operaciones como filtrado de datos, numeración de líneas, recuentos y totales, así como la generación de gráficos basados en los resultados obtenidos. Estas habilidades son esenciales para crear informes útiles y visualmente atractivos que puedan facilitar el análisis de la información.

Finalmente, nos dedicamos a la ejecución de procedimientos almacenados en la base de datos. Los procedimientos almacenados son bloques de código predefinidos que se almacenan en la base de datos y pueden ser invocados desde aplicaciones cliente. Aprender a ejecutar estos procedimientos es crucial para optimizar el rendimiento del sistema y reducir la carga sobre el servidor.

En esta subunidad, hemos cubierto los fundamentos necesarios para interactuar con bases de datos utilizando conectores. Desde la establecimiento de conexiones hasta la ejecución de consultas y la gestión de excepciones, hemos aprendido las habilidades esenciales que permitirán a los desarrolladores acceder y manipular información de manera eficiente y segura en sistemas de acceso a datos.

### select todo

```python
import mysql.connector

conexion = mysql.connector.connect(
    host="localhost",
    user="accesoadatos2526",
    password="Accesoadatos2526$",
    database="accesoadatos2526"
)

cursor = conexion.cursor()

cursor.execute('''
  SELECT * FROM clientes;
''')

filas = cursor.fetchall()

for fila in filas:
  print(fila)

cursor.close()
conexion.close()
```

### proyecciones

```python
import mysql.connector

conexion = mysql.connector.connect(
    host="localhost",
    user="accesoadatos2526",
    password="Accesoadatos2526$",
    database="accesoadatos2526"
)

cursor = conexion.cursor()

cursor.execute('''
  SELECT 
  nombre,
  apellidos,
  email
   FROM clientes;
''')

filas = cursor.fetchall()

for fila in filas:
  print(fila)

cursor.close()
conexion.close()
```

### alias de campo

```python
import mysql.connector

conexion = mysql.connector.connect(
    host="localhost",
    user="accesoadatos2526",
    password="Accesoadatos2526$",
    database="accesoadatos2526"
)

cursor = conexion.cursor()

cursor.execute('''
  SELECT 
  nombre AS "Nombre del cliente",
  apellidos AS "Apellidos del cliente",
  email AS "Email del cliente"
   FROM clientes;
''')

filas = cursor.fetchall()

for fila in filas:
  print(fila)

cursor.close()
conexion.close()
```

### devuelvo como diccionario

```python
import mysql.connector

conexion = mysql.connector.connect(
    host="localhost",
    user="accesoadatos2526",
    password="Accesoadatos2526$",
    database="accesoadatos2526"
)

cursor = conexion.cursor(dictionary=True)

cursor.execute('''
  SELECT 
  nombre AS "Nombre del cliente",
  apellidos AS "Apellidos del cliente",
  email AS "Email del cliente"
   FROM clientes;
''')

filas = cursor.fetchall()

for fila in filas:
  print(fila)

cursor.close()
conexion.close()
```

<a id="ejecucion-de-sentencias-de-modificacion-de-datos"></a>
## Ejecución de sentencias de modificación de datos

En la subunidad "Ejecución de sentencias de modificación de datos", nos centramos en las operaciones que permiten alterar el contenido de una base de datos. Estas operaciones son fundamentales para mantener actualizado los datos almacenados, ya que incluyen la inserción, eliminación y modificación de registros.

La inserción de nuevos registros es un proceso sencillo pero crucial. Consiste en agregar información a una tabla específica, utilizando sentencias SQL como `INSERT INTO`. Este método nos permite expandir el conjunto de datos con nuevos elementos, lo que es esencial para mantener la relevancia y actualidad del contenido almacenado.

La eliminación de registros es otro aspecto importante del manejo de conectores. A través de la sentencia SQL `DELETE`, podemos eliminar uno o varios registros de una tabla según ciertos criterios definidos por el usuario. Esta operación es útil para mantener la integridad y precisión de los datos, permitiendo su actualización periódica.

La modificación de registros es un proceso que permite cambiar los valores de uno o más campos en un registro existente. Utilizando la sentencia SQL `UPDATE`, podemos ajustar información específica dentro de una tabla, lo que es fundamental para mantener los datos actualizados y precisos.

Además de estas operaciones básicas, el manejo de conectores también implica la ejecución de sentencias de modificación de datos complejas. Estas pueden incluir la combinación de varias operaciones en una sola consulta, utilizando subconsultas o transacciones. La capacidad de realizar estas operaciones es crucial para realizar tareas avanzadas de gestión de datos.

La ejecución de sentencias de modificación de datos requiere un cuidadoso manejo de errores y excepciones. Es importante implementar mecanismos que detecten y manejen situaciones como intentos de inserción de duplicados, eliminación de registros inexistentes o actualización de campos con valores no válidos. Esto garantiza la integridad y consistencia de los datos.

Además del manejo de sentencias de modificación de datos, es fundamental entender cómo afectan estas operaciones a la concurrencia en una base de datos. La simultaneidad puede llevar a problemas como la pérdida de datos o inconsistencias si no se implementan mecanismos adecuados para controlar el acceso concurrente.

La ejecución de sentencias de modificación de datos también implica la optimización de las consultas. Aunque estas operaciones pueden ser intensivas en términos de recursos, su eficiencia es crucial para mantener un rendimiento óptimo del sistema. Esto puede implicar la utilización de índices adecuados, la minimización de los cambios a realizar y la planificación de las transacciones.

En conclusión, el manejo de conectores en la subunidad "Ejecución de sentencias de modificación de datos" es un aspecto fundamental del acceso a bases de datos. Incluye operaciones básicas como inserción, eliminación y modificación de registros, así como operaciones más complejas que requieren un cuidadoso manejo de errores y optimización para garantizar la integridad, consistencia y rendimiento del sistema.

### insertar

```python
import mysql.connector

conexion = mysql.connector.connect(
    host="localhost",
    user="accesoadatos2526",
    password="Accesoadatos2526$",
    database="accesoadatos2526"
)

cursor = conexion.cursor(dictionary=True)

cursor.execute('''
  INSERT INTO clientes VALUES(
    NULL,
    "Juan",
    "Garcia Lopez",
    "juan@garcialopez.com"
  );
''')

conexion.commit()

cursor.close()
conexion.close()
```

### actualizar

```python
import mysql.connector

conexion = mysql.connector.connect(
    host="localhost",
    user="accesoadatos2526",
    password="Accesoadatos2526$",
    database="accesoadatos2526"
)

cursor = conexion.cursor(dictionary=True)

cursor.execute('''
  UPDATE clientes SET nombre = "Juan Diego" WHERE Identificador = 3;
''')

conexion.commit()

cursor.close()
conexion.close()
```

### eliminar

```python
import mysql.connector

conexion = mysql.connector.connect(
    host="localhost",
    user="accesoadatos2526",
    password="Accesoadatos2526$",
    database="accesoadatos2526"
)

cursor = conexion.cursor(dictionary=True)

cursor.execute('''
  DELETE FROM clientes WHERE Identificador = 3;
''')

conexion.commit()

cursor.close()
conexion.close()
```

<a id="ejecucion-de-consultas-manipulacion-del-resultado"></a>
## Ejecución de consultas. Manipulación del resultado

En esta subunidad, nos centraremos en la ejecución de consultas en bases de datos utilizando conectores, así como en el manejo del resultado obtenido. Comenzamos por entender que las consultas son una parte esencial de cualquier interacción con una base de datos, ya que permiten recuperar y manipular los datos almacenados.

La ejecución de consultas implica establecer una conexión a la base de datos utilizando un conector específico para el tipo de base de datos en uso. Este proceso puede variar ligeramente dependiendo del conector y del sistema operativo, pero generalmente implica proporcionar credenciales de acceso y detalles sobre la ubicación de la base de datos.

Una vez establecida la conexión, se pueden ejecutar consultas SQL (Structured Query Language) para recuperar información. Estas consultas pueden ser simples o complejas, dependiendo del nivel de detalle que se requiera en los resultados. Por ejemplo, una consulta simple podría seleccionar todos los registros de una tabla, mientras que una consulta más compleja podría filtrar y ordenar los datos según ciertos criterios.

El resultado de la ejecución de una consulta es un conjunto de filas y columnas, conocido como un "conjunto de resultados". Este conjunto puede ser recorrido y procesado uno a uno para realizar operaciones específicas. Por ejemplo, se pueden iterar sobre los registros para actualizar ciertos campos o filtrar los datos según condiciones particulares.

Es importante destacar que el manejo del resultado es una parte crítica de cualquier aplicación que interactúe con bases de datos. No solo permite recuperar la información necesaria, sino también manipularla y presentarla de manera útil para el usuario final. Por lo tanto, es necesario tener en cuenta aspectos como la eficiencia del procesamiento, la seguridad de los datos y la consistencia de los resultados.

Además, al trabajar con conjuntos de resultados, es común utilizar métodos específicos proporcionados por el conector para navegar y manipular estos datos. Por ejemplo, se pueden obtener el número total de filas, acceder a un registro específico o iterar sobre todos los registros del conjunto.

En resumen, la ejecución de consultas y el manejo del resultado son habilidades fundamentales en cualquier aplicación que interactúe con bases de datos. A través de estos procesos, se pueden recuperar y manipular los datos almacenados, lo que permite a las aplicaciones realizar una amplia gama de funciones y operaciones.

### yoursql

```python
import os

carpeta_bd = "db"

carpetas = os.listdir(carpeta_bd)

for carpeta in carpetas:
  print(carpeta)
```

### mi propio lenguaje

```python
import os

carpeta_bd = "db"

carpetas = os.listdir(carpeta_bd)

for carpeta in carpetas:
  print(carpeta)
```

### lo convierto en una clase

```python
import os

class YourSQL():
  def __init__(self):
    self.carpeta_bd = "db"
  def peticion(self,peticion):
    if peticion == "SHOW DATABASES;"
      carpetas = os.listdir(carpeta_bd)
      for carpeta in carpetas:
        print(carpeta)
```

### metodo estatico en python

```python
import os

class YourSQL:
    carpeta_bd = "db"

    @staticmethod
    def peticion(peticion):
        if peticion == "SHOW DATABASES;":
            carpetas = os.listdir(YourSQL.carpeta_bd)
            for carpeta in carpetas:
                print(carpeta)

YourSQL.peticion("SHOW DATABASES;")
```

### ver tablas

```python
import os

class YourSQL:
  carpeta_bd = "db"

  @staticmethod
  def peticion(peticion):
    if peticion == "SHOW DATABASES;":
      carpetas = os.listdir(YourSQL.carpeta_bd)
      for carpeta in carpetas:
        print(carpeta)
    elif peticion == "SHOW TABLES;":
      tablas = os.listdir(YourSQL.carpeta_bd+"/accesoadatos")
      for tabla in tablas:
        print(tabla)
            

YourSQL.peticion("SHOW TABLES;")
```

### usar base de datos

```python
import os

class YourSQL:
  carpeta_bd = "db"
  base_actual = ""

  @staticmethod
  def peticion(peticion):
    if peticion == "SHOW DATABASES;":
      carpetas = os.listdir(YourSQL.carpeta_bd)
      for carpeta in carpetas:
        print(carpeta)
    elif "USE" in peticion:
      YourSQL.base_actual = peticion.split(" ")[1].split(";")[0]
    elif peticion == "SHOW TABLES;":
      tablas = os.listdir(YourSQL.carpeta_bd+"/"+YourSQL.base_actual)
      for tabla in tablas:
        print(tabla)
            
YourSQL.peticion("USE accesoadatos;")
YourSQL.peticion("SHOW TABLES;")
```

### insertar

```python
import os

class YourSQL:
  carpeta_bd = "db"
  base_actual = ""

  @staticmethod
  def peticion(peticion):
    if peticion == "SHOW DATABASES;":
      carpetas = os.listdir(YourSQL.carpeta_bd)
      for carpeta in carpetas:
        print(carpeta)
    elif "USE" in peticion:
      YourSQL.base_actual = peticion.split(" ")[1].split(";")[0]
    elif peticion == "SHOW TABLES;":
      tablas = os.listdir(YourSQL.carpeta_bd+"/"+YourSQL.base_actual)
      for tabla in tablas:
        print(tabla)
    elif "INSERT" in peticion:
      import re, csv, io

      # 1) Regex para capturar tabla, columnas (opcionales) y bloque VALUES
      patron = re.compile(
          r"^\s*INSERT\s+INTO\s+([A-Za-z_][\w$]*)\s*"
          r"(?:\(([^)]+)\))?\s*"
          r"VALUES\s*(.+?)\s*;?\s*$",
          re.IGNORECASE | re.DOTALL
      )
      m = patron.match(peticion)
      if not m:
          raise ValueError("INSERT no reconocido.")

      tabla, columnas_str, values_blob = m.groups()

      # 2) Ruta CSV
      ruta_base = os.path.join(YourSQL.carpeta_bd, YourSQL.base_actual)
      os.makedirs(ruta_base, exist_ok=True)
      path_csv = os.path.join(ruta_base, f"{tabla}.csv")

      # 3) Columnas (si vienen explícitas)
      columnas = None
      if columnas_str:
          columnas = [c.strip().strip("`") for c in columnas_str.split(",")]

      # 4) Separar tuplas de VALUES respetando comillas simples
      def split_tuplas(s: str):
          res, buf = [], []
          en_cadena = False
          nivel = 0
          prev = ''
          for ch in s.strip():
              if ch == "'" and prev != '\\':
                  en_cadena = not en_cadena
                  buf.append(ch)
              elif not en_cadena and ch == '(':
                  if nivel > 0:
                      buf.append(ch)
                  nivel += 1
              elif not en_cadena and ch == ')':
                  nivel -= 1
                  if nivel == 0:
                      res.append(''.join(buf).strip())
                      buf = []
                  else:
                      buf.append(ch)
              elif not en_cadena and nivel == 0 and ch == ',':
                  # separador entre tuplas
                  pass
              else:
                  buf.append(ch)
              prev = ch
          return res

      tuplas = split_tuplas(values_blob)

      # 5) Parsear cada tupla en lista de valores usando csv.reader (quote="'", escape="\\")
      filas = []
      for t in tuplas:
          reader = csv.reader(
              io.StringIO(t),
              delimiter=',',
              quotechar="'",
              escapechar='\\',
              skipinitialspace=True
          )
          vals = next(reader)
          filas.append([None if v.strip().upper() == "NULL" else v.strip() for v in vals])

      # 6) Si no hay columnas: usar cabecera existente o generar c1..cn
      if columnas is None:
          if os.path.exists(path_csv):
              with open(path_csv, newline='', encoding='utf-8') as f:
                  r = csv.reader(f)
                  columnas = next(r, None)
          if not columnas:
              columnas = [f"c{i}" for i in range(1, len(filas[0]) + 1)]

      # 7) Escribir/añadir CSV
      existe = os.path.exists(path_csv)
      with open(path_csv, 'a', newline='', encoding='utf-8') as f:
          writer = csv.DictWriter(f, fieldnames=list(columnas))
          if not existe:
              writer.writeheader()
          for vals in filas:
              writer.writerow({col: (vals[i] if i < len(vals) else "") for i, col in enumerate(columnas)})

      print(f"{len(filas)} fila(s) insertadas en {tabla}")

            
YourSQL.peticion("USE accesoadatos;")
YourSQL.peticion("SHOW TABLES;")
YourSQL.peticion("INSERT INTO clientes (id, nombre, email, activo) VALUES (1, 'Ana', 'ana@example.com', TRUE), (2, 'Luis O\\'Connor', NULL, FALSE);")
```

### seleccionar

```python
import os

class YourSQL:
  carpeta_bd = "db"
  base_actual = ""

  @staticmethod
  def peticion(peticion):
    if peticion == "SHOW DATABASES;":
      carpetas = os.listdir(YourSQL.carpeta_bd)
      for carpeta in carpetas:
        print(carpeta)
    elif "USE" in peticion:
      YourSQL.base_actual = peticion.split(" ")[1].split(";")[0]
    elif peticion == "SHOW TABLES;":
      tablas = os.listdir(YourSQL.carpeta_bd+"/"+YourSQL.base_actual)
      for tabla in tablas:
        print(tabla)
    elif "INSERT" in peticion:
      import re, csv, io

      # 1) Regex para capturar tabla, columnas (opcionales) y bloque VALUES
      patron = re.compile(
          r"^\s*INSERT\s+INTO\s+([A-Za-z_][\w$]*)\s*"
          r"(?:\(([^)]+)\))?\s*"
          r"VALUES\s*(.+?)\s*;?\s*$",
          re.IGNORECASE | re.DOTALL
      )
      m = patron.match(peticion)
      if not m:
          raise ValueError("INSERT no reconocido.")

      tabla, columnas_str, values_blob = m.groups()

      # 2) Ruta CSV
      ruta_base = os.path.join(YourSQL.carpeta_bd, YourSQL.base_actual)
      os.makedirs(ruta_base, exist_ok=True)
      path_csv = os.path.join(ruta_base, f"{tabla}.csv")

      # 3) Columnas (si vienen explícitas)
      columnas = None
      if columnas_str:
          columnas = [c.strip().strip("`") for c in columnas_str.split(",")]

      # 4) Separar tuplas de VALUES respetando comillas simples
      def split_tuplas(s: str):
          res, buf = [], []
          en_cadena = False
          nivel = 0
          prev = ''
          for ch in s.strip():
              if ch == "'" and prev != '\\':
                  en_cadena = not en_cadena
                  buf.append(ch)
              elif not en_cadena and ch == '(':
                  if nivel > 0:
                      buf.append(ch)
                  nivel += 1
              elif not en_cadena and ch == ')':
                  nivel -= 1
                  if nivel == 0:
                      res.append(''.join(buf).strip())
                      buf = []
                  else:
                      buf.append(ch)
              elif not en_cadena and nivel == 0 and ch == ',':
                  # separador entre tuplas
                  pass
              else:
                  buf.append(ch)
              prev = ch
          return res

      tuplas = split_tuplas(values_blob)

      # 5) Parsear cada tupla en lista de valores usando csv.reader (quote="'", escape="\\")
      filas = []
      for t in tuplas:
          reader = csv.reader(
              io.StringIO(t),
              delimiter=',',
              quotechar="'",
              escapechar='\\',
              skipinitialspace=True
          )
          vals = next(reader)
          filas.append([None if v.strip().upper() == "NULL" else v.strip() for v in vals])

      # 6) Si no hay columnas: usar cabecera existente o generar c1..cn
      if columnas is None:
          if os.path.exists(path_csv):
              with open(path_csv, newline='', encoding='utf-8') as f:
                  r = csv.reader(f)
                  columnas = next(r, None)
          if not columnas:
              columnas = [f"c{i}" for i in range(1, len(filas[0]) + 1)]

      # 7) Escribir/añadir CSV
      existe = os.path.exists(path_csv)
      with open(path_csv, 'a', newline='', encoding='utf-8') as f:
          writer = csv.DictWriter(f, fieldnames=list(columnas))
          if not existe:
              writer.writeheader()
          for vals in filas:
              writer.writerow({col: (vals[i] if i < len(vals) else "") for i, col in enumerate(columnas)})

      print(f"{len(filas)} fila(s) insertadas en {tabla}")
    elif peticion.strip().upper().startswith("SELECT"):
      import re, csv

      # 1) Regex para capturar la tabla
      patron = re.compile(
          r"^\s*SELECT\s+\*\s+FROM\s+([A-Za-z_][\w$]*)\s*;?\s*$",
          re.IGNORECASE
      )
      m = patron.match(peticion)
      if not m:
          raise ValueError("Solo se admite: SELECT * FROM <tabla>;")

      tabla = m.group(1)
      path_csv = os.path.join(YourSQL.carpeta_bd, YourSQL.base_actual, f"{tabla}.csv")

      # 2) Verificamos existencia del archivo
      if not os.path.exists(path_csv):
          print(f"La tabla '{tabla}' no existe en la base '{YourSQL.base_actual}'.")
      else:
          # 3) Mostrar contenido CSV
          with open(path_csv, newline='', encoding='utf-8') as f:
              reader = csv.reader(f)
              filas = list(reader)

          if not filas:
              print("(sin filas)")
          else:
              columnas = filas[0]
              print(" | ".join(columnas))
              print("-" * (len(" | ".join(columnas))))
              for fila in filas[1:]:
                  print(" | ".join(fila))

            
YourSQL.peticion("USE accesoadatos;")
YourSQL.peticion("SHOW TABLES;")
YourSQL.peticion("INSERT INTO clientes (id, nombre, email, activo) VALUES (1, 'Ana', 'ana@example.com', TRUE), (2, 'Luis O\\'Connor', NULL, FALSE);")
YourSQL.peticion("SELECT * FROM clientes;")
```

### externalizar

```python
from yoursql import YourSQL

YourSQL.peticion("USE accesoadatos;")
YourSQL.peticion("SHOW TABLES;")
YourSQL.peticion("INSERT INTO clientes (id, nombre, email, activo) VALUES (1, 'Ana', 'ana@example.com', TRUE), (2, 'Luis O\\'Connor', NULL, FALSE);")
YourSQL.peticion("SELECT * FROM clientes;")
```

### sistema formativo

```markdown
Grado FP básico - tareas de muy escasa cualificación
Grado Medio - SMR - Ejecuta órdenes, y tiene una cierta cualificación
Grado Superior DAM/DAW/ASIR - Solucionar problemas
Grado Universitario - Ingeniero Informático - Crear soluciones desde cero
Doctorado - Docencia/Investigación

Ingenieros informáticos:
Se dedican a arreglar código
Mucho código speguetti/legacy
Fallos de código
Cosas que quieren hacer y no saben como

Nosotros: Todos los profesores de FP
Recomendamos a nuestros alumnos
PAsar de FP a universidad

Todos los profesores 
Trabajamos por la dignificación de la FP
Mejorar en la medida de lo posible la reputación de la FP
```

### yoursql

```python
class YourSQL:
  carpeta_bd = "db"
  base_actual = ""

  @staticmethod
  def peticion(peticion):
    
    if peticion == "SHOW DATABASES;":
      import os
      carpetas = os.listdir(YourSQL.carpeta_bd)
      for carpeta in carpetas:
        print(carpeta)
    elif "USE" in peticion:
      YourSQL.base_actual = peticion.split(" ")[1].split(";")[0]
    elif peticion == "SHOW TABLES;":
      import os
      tablas = os.listdir(YourSQL.carpeta_bd+"/"+YourSQL.base_actual)
      for tabla in tablas:
        print(tabla)
    elif "INSERT" in peticion:
      import os
      import re, csv, io

      # 1) Regex para capturar tabla, columnas (opcionales) y bloque VALUES
      patron = re.compile(
          r"^\s*INSERT\s+INTO\s+([A-Za-z_][\w$]*)\s*"
          r"(?:\(([^)]+)\))?\s*"
          r"VALUES\s*(.+?)\s*;?\s*$",
          re.IGNORECASE | re.DOTALL
      )
      m = patron.match(peticion)
      if not m:
          raise ValueError("INSERT no reconocido.")

      tabla, columnas_str, values_blob = m.groups()

      # 2) Ruta CSV
      ruta_base = os.path.join(YourSQL.carpeta_bd, YourSQL.base_actual)
      os.makedirs(ruta_base, exist_ok=True)
      path_csv = os.path.join(ruta_base, f"{tabla}.csv")

      # 3) Columnas (si vienen explícitas)
      columnas = None
      if columnas_str:
          columnas = [c.strip().strip("`") for c in columnas_str.split(",")]

      # 4) Separar tuplas de VALUES respetando comillas simples
      def split_tuplas(s: str):
          res, buf = [], []
          en_cadena = False
          nivel = 0
          prev = ''
          for ch in s.strip():
              if ch == "'" and prev != '\\':
                  en_cadena = not en_cadena
                  buf.append(ch)
              elif not en_cadena and ch == '(':
                  if nivel > 0:
                      buf.append(ch)
                  nivel += 1
              elif not en_cadena and ch == ')':
                  nivel -= 1
                  if nivel == 0:
                      res.append(''.join(buf).strip())
                      buf = []
                  else:
                      buf.append(ch)
              elif not en_cadena and nivel == 0 and ch == ',':
                  # separador entre tuplas
                  pass
              else:
                  buf.append(ch)
              prev = ch
          return res

      tuplas = split_tuplas(values_blob)

      # 5) Parsear cada tupla en lista de valores usando csv.reader (quote="'", escape="\\")
      filas = []
      for t in tuplas:
          reader = csv.reader(
              io.StringIO(t),
              delimiter=',',
              quotechar="'",
              escapechar='\\',
              skipinitialspace=True
          )
          vals = next(reader)
          filas.append([None if v.strip().upper() == "NULL" else v.strip() for v in vals])

      # 6) Si no hay columnas: usar cabecera existente o generar c1..cn
      if columnas is None:
          if os.path.exists(path_csv):
              with open(path_csv, newline='', encoding='utf-8') as f:
                  r = csv.reader(f)
                  columnas = next(r, None)
          if not columnas:
              columnas = [f"c{i}" for i in range(1, len(filas[0]) + 1)]

      # 7) Escribir/añadir CSV
      existe = os.path.exists(path_csv)
      with open(path_csv, 'a', newline='', encoding='utf-8') as f:
          writer = csv.DictWriter(f, fieldnames=list(columnas))
          if not existe:
              writer.writeheader()
          for vals in filas:
              writer.writerow({col: (vals[i] if i < len(vals) else "") for i, col in enumerate(columnas)})

      print(f"{len(filas)} fila(s) insertadas en {tabla}")
    elif peticion.strip().upper().startswith("SELECT"):
      import re, csv
      import os
      # 1) Regex para capturar la tabla
      patron = re.compile(
          r"^\s*SELECT\s+\*\s+FROM\s+([A-Za-z_][\w$]*)\s*;?\s*$",
          re.IGNORECASE
      )
      m = patron.match(peticion)
      if not m:
          raise ValueError("Solo se admite: SELECT * FROM <tabla>;")

      tabla = m.group(1)
      path_csv = os.path.join(YourSQL.carpeta_bd, YourSQL.base_actual, f"{tabla}.csv")

      # 2) Verificamos existencia del archivo
      if not os.path.exists(path_csv):
          print(f"La tabla '{tabla}' no existe en la base '{YourSQL.base_actual}'.")
      else:
          # 3) Mostrar contenido CSV
          with open(path_csv, newline='', encoding='utf-8') as f:
              reader = csv.reader(f)
              filas = list(reader)

          if not filas:
              print("(sin filas)")
          else:
              columnas = filas[0]
              print(" | ".join(columnas))
              print("-" * (len(" | ".join(columnas))))
              for fila in filas[1:]:
                  print(" | ".join(fila))
```

<a id="ejecucion-de-procedimientos-almacenados-en-la-base-de-datos"></a>
## Ejecución de procedimientos almacenados en la base de datos

En esta subunidad del curso, nos centramos en la ejecución de procedimientos almacenados en la base de datos. Los procedimientos almacenados son bloques de código predefinidos que se almacenan en la base de datos y pueden ser invocados por los programas para realizar tareas específicas. Estos procedimientos optimizan el rendimiento al reducir las comunicaciones entre el cliente y el servidor, ya que el código se ejecuta directamente en el servidor.

Para interactuar con los procedimientos almacenados, utilizamos conectores específicos de la base de datos que proporcionan una interfaz para establecer conexiones, enviar comandos y recibir resultados. Estos conectores manejan automáticamente las transacciones y los errores, lo que facilita su uso en aplicaciones.

La ejecución de un procedimiento almacenado implica varios pasos: primero, se establece la conexión con la base de datos utilizando el conector adecuado. Luego, se prepara el comando para invocar el procedimiento, especificando los parámetros necesarios si es necesario. A continuación, se ejecuta el comando y se procesan los resultados devueltos por el procedimiento.

Es importante tener en cuenta que los procedimientos almacenados pueden aceptar parámetros de entrada y salida, lo que permite una comunicación bidireccional con la base de datos. Los parámetros de entrada son valores que se pasan al procedimiento para su procesamiento, mientras que los parámetros de salida devuelven resultados del mismo.

La gestión de transacciones es crucial cuando se ejecutan procedimientos almacenados, ya que pueden afectar varios registros en la base de datos. Es recomendable utilizar transacciones para asegurar que todas las operaciones dentro del procedimiento sean completadas exitosamente o deshacerse de ellas si ocurre un error.

Al desarrollar aplicaciones que utilizan procedimientos almacenados, es fundamental considerar el rendimiento y la seguridad. El rendimiento se puede optimizar mediante el uso de índices adecuados y la minimización del número de llamadas al servidor. La seguridad debe garantizarse mediante el control de privilegios y la implementación de medidas de autenticación y autorización.

En resumen, la ejecución de procedimientos almacenados en la base de datos es una técnica poderosa que permite mejorar el rendimiento y la eficiencia de las aplicaciones. Al utilizar conectores adecuados y seguir buenas prácticas de gestión de transacciones y seguridad, se pueden crear sistemas robustos y eficientes que aprovechen al máximo los recursos disponibles en la base de datos.

<a id="gestion-de-transacciones"></a>
## Gestión de transacciones

En la subunidad "Gestión de transacciones" del módulo "Manejo de conectores", nos centramos en una de las operaciones fundamentales que cualquier sistema de bases de datos debe manejar con eficiencia y precisión. Las transacciones son conjuntos de comandos SQL que se ejecutan como una unidad, asegurando que todas las operaciones dentro de ellas sean realizadas correctamente o ninguna si ocurre un error.

La gestión de transacciones es crucial porque permite mantener la integridad de los datos en el sistema. Cada transacción debe cumplir con cuatro principios fundamentales conocidos como ACID: Atomicidad, Coherencia, Isolación y Durabilidad. La atomicidad asegura que una transacción sea un todo o nada; si falla, todas las operaciones dentro de ella deben deshacerse para mantener la consistencia del sistema. La coherencia garantiza que una transacción cambie el estado del sistema de manera correcta según las reglas de negocio establecidas. La isolación evita que dos transacciones concurrentes interfieran entre sí, asegurando que cada una se ejecute como si no hubiera otras en curso. Finalmente, la durabilidad implica que una vez que una transacción ha sido confirmada, sus efectos son permanentes y no pueden ser revertidos.

Para gestionar las transacciones en un sistema de bases de datos, es necesario utilizar comandos específicos SQL como `BEGIN`, `COMMIT` y `ROLLBACK`. El comando `BEGIN` inicia una nueva transacción. A partir de ese momento, todas las operaciones realizadas hasta que se ejecute el siguiente comando son parte de la misma transacción. Si todo funciona correctamente, se utiliza el comando `COMMIT` para confirmar la transacción y hacer efectivos los cambios en la base de datos. En caso de un error o una situación inesperada, el comando `ROLLBACK` es utilizado para deshacer todos los cambios realizados durante la transacción, restaurando así el estado del sistema a su punto inicial.

Es importante destacar que la gestión de transacciones no solo se limita a las operaciones CRUD (Crear, Leer, Actualizar, Eliminar). También incluye la gestión de errores y excepciones, asegurándose de que cualquier error durante una transacción cause un deshacer completo para mantener la integridad del sistema. Además, en entornos de alta concurrencia, la gestión de transacciones debe ser eficiente y evitar problemas como el bloqueo y la incoherencia.

La gestión de transacciones también puede implicar la utilización de mecanismos avanzados como los puntos de control (checkpoints) y las réplicas secundarias. Los puntos de control son instantáneas del estado actual de la base de datos que se toman periódicamente para permitir el recupero en caso de fallo. Las réplicas secundarias son copias de la base de datos principal que se mantienen sincronizadas y pueden utilizarse para aumentar la disponibilidad y la capacidad de procesamiento del sistema.

En resumen, la gestión de transacciones es un componente esencial de cualquier sistema de bases de datos. Permite mantener la integridad de los datos, asegurar la coherencia del estado del sistema y proporcionar una respuesta consistente ante errores o situaciones inesperadas. A través de comandos específicos SQL y técnicas avanzadas como los puntos de control y las réplicas secundarias, es posible gestionar eficientemente las transacciones y mantener el funcionamiento correcto del sistema.

### conexion base

```python
import mysql.connector

conexion = mysql.connector.connect(
    host="localhost",
    user="blog2526",
    password="blog2526",
    database="blog2526"
)

cursor = conexion.cursor()

cursor.execute("SELECT * FROM entradas")

filas = cursor.fetchall()
for fila in filas:
  print(fila)

cursor.close()
conexion.close()
```

### creo una clase

```python
import mysql.connector

class JVDB():
  def __init__(self,host,usuario,contrasena,basedatos):
    self.host = host
    self.usuario = usuario
    self.contrasena = contrasena
    self.basedatos = basedatos

    self.conexion = mysql.connector.connect(
        host=self.host,
        user=self.usuario,
        password=self.contrasena,
        database=self.basedatos
    )

    self.cursor = self.conexion.cursor()

  def seleccionar(self,tabla):
    cursor.execute("SELECT * FROM "+tabla)
    filas = cursor.fetchall()
    for fila in filas:
      print(fila)
    cursor.close()
    conexion.close()
    
    
```

### llamo a la clase

```python
import mysql.connector

class JVDB():
  def __init__(self,host,usuario,contrasena,basedatos):
    self.host = host
    self.usuario = usuario
    self.contrasena = contrasena
    self.basedatos = basedatos

    self.conexion = mysql.connector.connect(
        host=self.host,
        user=self.usuario,
        password=self.contrasena,
        database=self.basedatos
    )

    self.cursor = self.conexion.cursor()

  def seleccionar(self,tabla):
    self.cursor.execute("SELECT * FROM "+tabla)
    filas = self.cursor.fetchall()
    for fila in filas:
      print(fila)
    
conexion = JVDB("localhost","blog2526","blog2526","blog2526")
conexion.seleccionar("entradas")
   
```

### return

```python
import mysql.connector

class JVDB():
  def __init__(self,host,usuario,contrasena,basedatos):
    self.host = host
    self.usuario = usuario
    self.contrasena = contrasena
    self.basedatos = basedatos

    self.conexion = mysql.connector.connect(
        host=self.host,
        user=self.usuario,
        password=self.contrasena,
        database=self.basedatos
    )

    self.cursor = self.conexion.cursor()

  def seleccionar(self,tabla):
    self.cursor.execute("SELECT * FROM "+tabla)
    filas = self.cursor.fetchall()
    return filas
    
conexion = JVDB("localhost","blog2526","blog2526","blog2526")
print(conexion.seleccionar("entradas"))
   
```

### return como json

```python
import mysql.connector
import json

class JVDB():
  def __init__(self,host,usuario,contrasena,basedatos):
    self.host = host
    self.usuario = usuario
    self.contrasena = contrasena
    self.basedatos = basedatos

    self.conexion = mysql.connector.connect(
        host=self.host,
        user=self.usuario,
        password=self.contrasena,
        database=self.basedatos
    )

    self.cursor = self.conexion.cursor()

  def seleccionar(self,tabla):
    self.cursor.execute("SELECT * FROM "+tabla)
    filas = self.cursor.fetchall()
    return json.dumps(filas, ensure_ascii=False, indent=2)
    
conexion = JVDB("localhost","blog2526","blog2526","blog2526")
print(conexion.seleccionar("entradas"))
   
```

### empiezo demostracion

```python
from jvdb006 import JVDB
    
conexion = JVDB("localhost","blog2526","blog2526","blog2526")
print(conexion.seleccionar("entradas"))
   
```

### vuelvo al original

```python
import mysql.connector
import json

class JVDB():
  def __init__(self,host,usuario,contrasena,basedatos):
    self.host = host
    self.usuario = usuario
    self.contrasena = contrasena
    self.basedatos = basedatos

    self.conexion = mysql.connector.connect(
        host=self.host,
        user=self.usuario,
        password=self.contrasena,
        database=self.basedatos
    )

    self.cursor = self.conexion.cursor()

  def seleccionar(self,tabla):
    self.cursor.execute("SELECT * FROM "+tabla)
    filas = self.cursor.fetchall()
    return json.dumps(filas, ensure_ascii=False, indent=2)
    
conexion = JVDB("localhost","blog2526","blog2526","blog2526")
print(conexion.seleccionar("entradas"))
   
```

### vuelvo al original

```python
import mysql.connector
import json

class JVDB():
  def __init__(self,host,usuario,contrasena,basedatos):
    self.host = host
    self.usuario = usuario
    self.contrasena = contrasena
    self.basedatos = basedatos

    self.conexion = mysql.connector.connect(
        host=self.host,
        user=self.usuario,
        password=self.contrasena,
        database=self.basedatos
    )

    self.cursor = self.conexion.cursor()

  def seleccionar(self,tabla):
    self.cursor.execute("SELECT * FROM "+tabla)
    filas = self.cursor.fetchall()
    return json.dumps(filas, ensure_ascii=False, indent=2)
  def buscar(self,tabla,columna,valor):
    self.cursor.execute("SELECT * FROM "+tabla+" WHERE "+columna+" LIKE '%"+valor+"%'")
    filas = self.cursor.fetchall()
    return json.dumps(filas, ensure_ascii=False, indent=2)
    
conexion = JVDB("localhost","blog2526","blog2526","blog2526")
print(conexion.buscar("entradas","titulo","responsivo"))
   
```

### clave valor

```python
import mysql.connector
import json

class JVDB():
  def __init__(self, host, usuario, contrasena, basedatos):
    self.host = host
    self.usuario = usuario
    self.contrasena = contrasena
    self.basedatos = basedatos

    self.conexion = mysql.connector.connect(
        host=self.host,
        user=self.usuario,
        password=self.contrasena,
        database=self.basedatos
    )
    self.cursor = self.conexion.cursor()

  def seleccionar(self, tabla):
    self.cursor.execute(f"SELECT * FROM {tabla}")
    columnas = self.cursor.column_names
    filas = self.cursor.fetchall()
    datos = [dict(zip(columnas, fila)) for fila in filas]
    return json.dumps(datos, ensure_ascii=False, indent=2)

  def buscar(self, tabla, columna, valor):
    sql = f"SELECT * FROM {tabla} WHERE {columna} LIKE %s"
    self.cursor.execute(sql, (f"%{valor}%",))
    columnas = self.cursor.column_names
    filas = self.cursor.fetchall()
    datos = [dict(zip(columnas, fila)) for fila in filas]
    return json.dumps(datos, ensure_ascii=False, indent=2)

# Ejemplo de uso
conexion = JVDB("localhost", "blog2526", "blog2526", "blog2526")
print(conexion.buscar("entradas", "titulo", "responsivo"))
```

### jvdb006

```python
import mysql.connector
import json

class JVDB():
  def __init__(self,host,usuario,contrasena,basedatos):
    self.host = host
    self.usuario = usuario
    self.contrasena = contrasena
    self.basedatos = basedatos

    self.conexion = mysql.connector.connect(
        host=self.host,
        user=self.usuario,
        password=self.contrasena,
        database=self.basedatos
    )

    self.cursor = self.conexion.cursor()

  def seleccionar(self,tabla):
    self.cursor.execute("SELECT * FROM "+tabla)
    filas = self.cursor.fetchall()
    return json.dumps(filas, ensure_ascii=False, indent=2)
```

<a id="desarrollo-de-programas-que-utilizan-bases-de-datos"></a>
## Desarrollo de programas que utilizan bases de datos

Continuando con nuestra exploración del acceso a datos, nos encontramos en la subunidad "Desarrollo de programas que utilizan bases de datos". En esta sección, profundizaremos en cómo integrar las bases de datos en nuestras aplicaciones para realizar operaciones CRUD (Crear, Leer, Actualizar y Borrar) eficientemente.

La creación de una conexión a una base de datos es el primer paso crucial. Utilizando los protocolos adecuados como SQL o NoSQL, podemos establecer una comunicación segura y efectiva entre nuestra aplicación y la base de datos. Los conectores son herramientas que facilitan esta tarea, proporcionando métodos para abrir y cerrar conexiones, así como ejecutar consultas.

Una vez establecida la conexión, el siguiente paso es realizar operaciones CRUD en la base de datos. La creación de registros se realiza mediante sentencias INSERT, mientras que la lectura de datos se logra con SELECT. Las actualizaciones se efectúan con UPDATE y las eliminaciones con DELETE. Cada una de estas operaciones requiere un manejo adecuado de excepciones para asegurar la integridad de los datos.

Además de las operaciones CRUD básicas, también es importante considerar la seguridad en el acceso a las bases de datos. Esto incluye la implementación de políticas de control de acceso y la utilización de métodos seguros para almacenar y recuperar información sensible.

La eficiencia en el acceso a las bases de datos no solo depende del código, sino también de la estructura de la base de sí misma. La normalización de los datos y la creación de índices adecuados son técnicas clave para mejorar el rendimiento de las consultas.

En este contexto, es fundamental utilizar herramientas de gestión de bases de datos que ofrezcan funcionalidades avanzadas como la transacción y la replicación. Las transacciones aseguran que una serie de operaciones se realicen juntas o no en absoluto, mientras que la replicación distribuye los datos para mejorar el acceso y la disponibilidad.

Finalmente, es importante documentar todo el proceso de desarrollo, desde la configuración inicial hasta las modificaciones posteriores. La documentación detalla cómo funciona cada componente del sistema y cómo se deben realizar cambios futuros, lo que facilita el mantenimiento y la escalabilidad de la aplicación.

En resumen, desarrollar programas que utilizan bases de datos implica una comprensión profunda de los protocolos de comunicación, las operaciones CRUD básicas, la seguridad en el acceso a los datos, la optimización del rendimiento y la documentación exhaustiva. Cada uno de estos aspectos es crucial para crear aplicaciones robustas y eficientes que puedan manejar grandes volúmenes de información con confianza.

<a id="ejercicio-de-final-de-unidad-1"></a>
## Ejercicio de final de unidad

### ejercicio

```markdown

```

<a id="examen-final"></a>
## Examen final

### crear tablas

```sql
CREATE DATABASE portafolioceac;

USE portafolioceac;


CREATE TABLE Piezas(
  Identificador INT auto_increment PRIMARY KEY,
  titulo VARCHAR(255),
  descripcion VARCHAR(255),
  imagen VARCHAR(255),
  url VARCHAR(255),
  id_categoria INT
);

CREATE TABLE Categorias(
  Identificador INT auto_increment PRIMARY KEY,
  titulo VARCHAR(255),
  descripcion VARCHAR(255)
);
```

### insertar

```sql
INSERT INTO Categorias VALUES(
  NULL,
  'General',
  'Esta es la categoria general'
);

INSERT INTO Piezas VALUES(
  NULL,
  'Primera pieza',
  'Esta es la descripcion de la primera pieza',
  'josevicente.jpg',
  'https://jocarsa.com',
  1
);
```

### fk

```sql
ALTER TABLE Piezas
ADD CONSTRAINT fk_piezas_categorias
FOREIGN KEY (id_categoria) REFERENCES Categorias(identificador)
ON DELETE CASCADE
ON UPDATE CASCADE;
```

### selecciones

```sql
SELECT * FROM Categorias;

SELECT * FROM Piezas;
```

### left join

```sql
SELECT 
* 
FROM Piezas
LEFT JOIN Categorias
ON Piezas.id_categoria = Categorias.Identificador;
```

### ahora creo la vista

```sql
CREATE VIEW piezas_y_categorias AS 
SELECT 
Categorias.titulo AS categoriatitulo,
Categorias.descripcion AS categoriadescripcion,
Piezas.titulo AS piezatitulo,
Piezas.descripcion AS piezadescripcion,
imagen,
url
FROM Piezas
LEFT JOIN Categorias
ON Piezas.id_categoria = Categorias.Identificador;

SELECT * FROM piezas_y_categorias;
```

### usuario

```sql
-- crea usuario nuevo con contraseña
-- creamos el nombre de usuario que queramos
CREATE USER 
'portafolioceac'@'localhost' 
IDENTIFIED  BY 'portafolioceac';

-- permite acceso a ese usuario
GRANT USAGE ON *.* TO 'portafolioceac'@'localhost';
--[tuservidor] == localhost
-- La contraseña puede requerir Mayus, minus, numeros, caracteres, min len

-- quitale todos los limites que tenga
ALTER USER 'portafolioceac'@'localhost' 
REQUIRE NONE 
WITH MAX_QUERIES_PER_HOUR 0 
MAX_CONNECTIONS_PER_HOUR 0 
MAX_UPDATES_PER_HOUR 0 
MAX_USER_CONNECTIONS 0;

-- dale acceso a la base de datos empresadam
GRANT ALL PRIVILEGES ON portafolioceac.* 
TO 'portafolioceac'@'localhost';

-- recarga la tabla de privilegios
FLUSH PRIVILEGES;
```


<a id="herramientas-de-mapeo-objeto-relacional-orm"></a>
# Herramientas de mapeo objeto relacional (ORM)

<a id="concepto-de-mapeo-objeto-relacional"></a>
## Concepto de mapeo objeto relacional

El concepto de mapeo objeto-relacional (ORM) es una técnica que permite a los desarrolladores interactuar con bases de datos relacionales utilizando objetos orientados. Este enfoque facilita la programación al permitir el acceso y manipulación de datos mediante clases y objetos, en lugar de escribir consultas SQL directamente.

En un sistema ORM, cada tabla de la base de datos se representa como una clase en el código fuente del programa. Cada fila de la tabla es un objeto de esa clase, y las columnas corresponden a los atributos de los objetos. Este mapeo automático simplifica la creación y gestión de consultas complejas, ya que se pueden manipular directamente los objetos sin necesidad de escribir SQL.

La ventaja principal del ORM radica en su capacidad para abstraer el acceso a la base de datos, lo que reduce significativamente el riesgo de errores comunes asociados con la escritura manual de consultas SQL. Además, facilita la actualización y mantenimiento del código, ya que cualquier cambio en la estructura de la base de datos solo requiere modificaciones en las clases correspondientes.

Un ORM también proporciona herramientas para realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) sobre los objetos, lo que permite una programación más orientada a objetos. Por ejemplo, se pueden crear nuevos objetos y guardarlos en la base de datos con solo instanciar la clase correspondiente y asignar valores a sus atributos.

Además, muchos ORMs ofrecen características adicionales como el soporte para transacciones, validaciones de datos y relaciones entre tablas. Estas funcionalidades añaden una capa adicional de seguridad y eficiencia al acceso a los datos.

En resumen, el mapeo objeto-relacional es una herramienta poderosa que facilita la interacción entre aplicaciones orientadas a objetos y bases de datos relacionales. Al permitir un enfoque más natural y intuitivo para el acceso a los datos, ORM mejora significativamente la productividad y mantenibilidad del código, reduciendo al mismo tiempo el riesgo de errores comunes en consultas SQL directas.

### Concepto previo

```markdown
En informática se me anima a trabajar con objetos
Complejidad infinita

La norma es la persistencia en bases de datos relacionales
SQL
Formadas por tablas
```

### la libreria pickle

```python
class Cliente():
  def __init__(self,nombre,apellidos,emails):
    self.nombre = nombre
    self.apellidos = apellidos
    self.emails = emails
    
clientes = []
for _ in range(0,10):
  clientes.append(
    Cliente(
      "Jose Vicente",
      "Carratala",
      ["info@jocarsa.com","info@josevicentecarratala.com"]
      )
  )

print(clientes)
```

### guardar a lo bestia

```python
import pickle

class Cliente():
  def __init__(self,nombre,apellidos,emails):
    self.nombre = nombre
    self.apellidos = apellidos
    self.emails = emails
    
clientes = []
for _ in range(0,10):
  clientes.append(
    Cliente(
      "Jose Vicente",
      "Carratala",
      ["info@jocarsa.com","info@josevicentecarratala.com"]
      )
  )

archivo = open("clientes.bin",'wb')
pickle.dump(clientes,archivo)
```

### cargo de vuelta

```python
import pickle

class Cliente():
  def __init__(self,nombre,apellidos,emails):
    self.nombre = nombre
    self.apellidos = apellidos
    self.emails = emails
    

archivo = open("clientes.bin",'rb')
clientes = pickle.load(archivo)


print(clientes)
```

<a id="caracteristicas-de-las-herramientas-orm"></a>
## Características de las herramientas ORM

Las herramientas de mapeo objeto-relacional (ORM) son una poderosa tecnología que facilitan la comunicación entre aplicaciones informáticas y bases de datos relacionales. Estas herramientas permiten a los desarrolladores trabajar con objetos en su lenguaje de programación preferido, mientras que ORM se encarga automáticamente del proceso de traducción entre estos objetos y las tablas y registros de la base de datos.

Una de las principales ventajas de las ORM es su capacidad para abstraer el acceso a la base de datos. En lugar de escribir consultas SQL directamente en el código, los desarrolladores pueden utilizar métodos y clases proporcionados por la herramienta ORM para interactuar con la base de datos. Esta abstracción no solo simplifica significativamente el código, sino que también reduce el riesgo de errores comunes asociados con la escritura manual de consultas SQL.

Además, las ORM ofrecen una serie de características adicionales que hacen que el desarrollo sea más eficiente y seguro. Por ejemplo, muchas herramientas ORM proporcionan funcionalidades para realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) en la base de datos con solo unas pocas líneas de código. Esto no solo ahorra tiempo y esfuerzo, sino que también reduce el riesgo de errores humanos.

Otra ventaja importante de las ORM es su capacidad para manejar automáticamente la persistencia de los objetos. Cuando se crean o modifican objetos en la aplicación, la herramienta ORM se encarga de actualizar automáticamente la base de datos con los cambios correspondientes. Esto facilita el mantenimiento del código y reduce la probabilidad de inconsistencias entre la memoria de la aplicación y la base de datos.

Las ORM también suelen proporcionar funcionalidades avanzadas como el mapeo bidireccional, lo que permite a los desarrolladores trabajar tanto con objetos en la memoria como con registros en la base de datos. Esto facilita la implementación de relaciones complejas entre tablas y mejora la flexibilidad del diseño de aplicaciones.

Además, muchas ORM ofrecen soporte para transacciones, lo que significa que se pueden realizar operaciones complejas en la base de datos de manera segura y coherente. Si ocurre un error durante una transacción, la herramienta ORM puede revertir automáticamente todos los cambios realizados, garantizando la integridad de la base de datos.

En términos de seguridad, las ORM suelen proporcionar mecanismos para evitar ataques comunes como inyecciones SQL. Al utilizar métodos y clases proporcionados por la herramienta en lugar de escribir consultas SQL directamente, se minimiza el riesgo de que los desarrolladores cometan errores que puedan permitir a terceros acceder o modificar datos de forma no autorizada.

En resumen, las herramientas de mapeo objeto-relacional son una tecnología valiosa para cualquier desarrollador que trabaje con bases de datos relacionales. Ofrecen una serie de ventajas significativas en términos de simplicidad, eficiencia y seguridad, lo que facilita el desarrollo de aplicaciones informáticas complejas y escalables. Aunque pueden requerir un poco más de tiempo para aprender a utilizarlas correctamente, las ORM son generalmente consideradas una inversión valiosa en el largo plazo del proyecto.

### inicio en python

```python
import mysql.connector
import json

class JVDB():
  def __init__(self, host, usuario, contrasena, basedatos):
    self.host = host
    self.usuario = usuario
    self.contrasena = contrasena
    self.basedatos = basedatos

    self.conexion = mysql.connector.connect(
        host=self.host,
        user=self.usuario,
        password=self.contrasena,
        database=self.basedatos
    )
    self.cursor = self.conexion.cursor()

  def seleccionar(self, tabla):
    self.cursor.execute(f"SELECT * FROM {tabla}")
    columnas = self.cursor.column_names
    filas = self.cursor.fetchall()
    datos = [dict(zip(columnas, fila)) for fila in filas]
    return json.dumps(datos, ensure_ascii=False, indent=2)

  def buscar(self, tabla, columna, valor):
    sql = f"SELECT * FROM {tabla} WHERE {columna} LIKE %s"
    self.cursor.execute(sql, (f"%{valor}%",))
    columnas = self.cursor.column_names
    filas = self.cursor.fetchall()
    datos = [dict(zip(columnas, fila)) for fila in filas]
    return json.dumps(datos, ensure_ascii=False, indent=2)

# Ejemplo de uso
conexion = JVDB("localhost", "blog2526", "blog2526", "blog2526")
print(conexion.buscar("entradas", "titulo", "responsivo"))
```

### convierto a php

```
<?php

class JVDB {
    private $host;
    private $usuario;
    private $contrasena;
    private $basedatos;
    private $conexion;

    public function __construct($host, $usuario, $contrasena, $basedatos) {
        $this->host = $host;
        $this->usuario = $usuario;
        $this->contrasena = $contrasena;
        $this->basedatos = $basedatos;

        $this->conexion = new mysqli($this->host, $this->usuario, $this->contrasena, $this->basedatos);
        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    public function seleccionar($tabla) {
        $sql = "SELECT * FROM $tabla";
        $resultado = $this->conexion->query($sql);

        $datos = [];
        while ($fila = $resultado->fetch_assoc()) {
            $datos[] = $fila;
        }

        return json_encode($datos, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public function buscar($tabla, $columna, $valor) {
        $sql = "SELECT * FROM $tabla WHERE $columna LIKE ?";
        $stmt = $this->conexion->prepare($sql);
        $like = "%" . $valor . "%";
        $stmt->bind_param("s", $like);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $datos = [];
        while ($fila = $resultado->fetch_assoc()) {
            $datos[] = $fila;
        }

        return json_encode($datos, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}

// Ejemplo de uso
$conexion = new JVDB("localhost", "blog2526", "blog2526", "blog2526");
echo $conexion->buscar("entradas", "titulo", "responsivo");
```

### listado de tablas

```
<?php

class JVDB {
    private $host;
    private $usuario;
    private $contrasena;
    private $basedatos;
    private $conexion;

    public function __construct($host, $usuario, $contrasena, $basedatos) {
        $this->host = $host;
        $this->usuario = $usuario;
        $this->contrasena = $contrasena;
        $this->basedatos = $basedatos;

        $this->conexion = new mysqli($this->host, $this->usuario, $this->contrasena, $this->basedatos);
        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    public function seleccionar($tabla) {
        $sql = "SELECT * FROM $tabla";
        $resultado = $this->conexion->query($sql);

        $datos = [];
        while ($fila = $resultado->fetch_assoc()) {
            $datos[] = $fila;
        }

        return json_encode($datos, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public function buscar($tabla, $columna, $valor) {
        $sql = "SELECT * FROM $tabla WHERE $columna LIKE ?";
        $stmt = $this->conexion->prepare($sql);
        $like = "%" . $valor . "%";
        $stmt->bind_param("s", $like);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $datos = [];
        while ($fila = $resultado->fetch_assoc()) {
            $datos[] = $fila;
        }

        return json_encode($datos, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    // 🔥 Nuevo método
    public function tablas() {
        $sql = "SHOW TABLES";
        $resultado = $this->conexion->query($sql);

        $datos = [];
        while ($fila = $resultado->fetch_array()) {
            $datos[] = $fila[0];
        }

        return json_encode($datos, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}

// Ejemplo de uso
$conexion = new JVDB("localhost", "blog2526", "blog2526", "blog2526");
echo $conexion->tablas();
```

<a id="instalacion-de-una-herramienta-orm-configuracion"></a>
## Instalación de una herramienta ORM. Configuración

La instalación y configuración de herramientas ORM son pasos cruciales para desarrolladores que desean optimizar su trabajo con bases de datos relacionales. En esta subunidad, exploraremos cómo instalar una herramienta ORM popular y cómo configurarla adecuadamente en un proyecto.

Primero, es importante entender qué es el mapeo objeto-relacional (ORM). Este concepto permite a los desarrolladores trabajar con objetos en su lenguaje de programación preferido, mientras que la base de datos se gestiona automáticamente. ORM facilita la interacción entre aplicaciones y bases de datos, reduciendo así el código necesario para realizar operaciones CRUD.

Para esta subunidad, vamos a utilizar SQLAlchemy, una de las herramientas ORM más populares en Python. La instalación de SQLAlchemy es relativamente sencilla. A través del gestor de paquetes pip, simplemente ejecutamos el siguiente comando:

```bash
pip install sqlalchemy
```

Esta línea de código instala SQLAlchemy junto con todas sus dependencias necesarias.

Después de la instalación, la configuración inicial implica la definición de una conexión a la base de datos. Esto se realiza mediante la creación de un objeto `Engine` que representa la conexión al servidor de bases de datos. Por ejemplo:

```python
from sqlalchemy import create_engine

engine = create_engine('sqlite:///mi_base_de_datos.db')
```

En este ejemplo, estamos utilizando SQLite como el sistema de gestión de bases de datos, pero SQLAlchemy también soporta otras bases de datos populares como PostgreSQL y MySQL.

La configuración avanzada puede implicar la definición de tipos de datos personalizados, relaciones entre tablas y funciones de mapeo complejas. Sin embargo, para un proyecto básico, estos pasos son suficientes.

Es importante recordar que SQLAlchemy es una herramienta muy flexible y extensible. A medida que el proyecto avanza, se pueden realizar ajustes y mejoras en la configuración según las necesidades específicas del desarrollo.

En resumen, la instalación de una herramienta ORM como SQLAlchemy es un paso fundamental para cualquier desarrollador que trabaje con bases de datos relacionales. Con su configuración adecuada, los desarrolladores pueden disfrutar de una mayor productividad y eficiencia en sus proyectos, ya que el mapeo objeto-relacional se gestiona automáticamente.

La próxima subunidad explorará cómo definir clases ORM y realizar operaciones CRUD utilizando SQLAlchemy, aprofundando así la comprensión del uso práctico de esta herramienta.

### tipos de datos

```markdown
Datos en tablas
Datos en documentos

Imagen - Formato de imagen
Video - Formatos de video

Imagen (pixels, video = fotogramas con pixels)
x - y - r,g,b

Audio
Samples = muestra = presión acústica en un micrófono, en un momento dado
Bits = Calidad de la onda de audio = escalera de pasos que soporta cada sample
8bits = telefono = 256pasos
16bits = CD 16.XXX pasos
24bits = DVD 16,7 millones de pasos
48bits Blu-Ray 
96bits = DVD-Audio
Frecuencia - samples por segundo - Hz
8KHz = Teléfono
11KHz - Radio AM
22KHz = Cassete
44.1KHz = CDAudio
48KHz = DVDVideo
192KHz - DVDAudio
```

### leer archivo

```python
from pydub import AudioSegment
import numpy as np

# Cargar MP3
audio = AudioSegment.from_mp3("0802.mp3")

# Convertir a array de muestras
samples = np.array(audio.get_array_of_samples())

print("Total samples:", len(samples))
for sample in samples:
  print(sample)
```

### linea

```python
from PIL import Image, ImageDraw

# Crear imagen en blanco
img = Image.new("RGB", (800, 200), "white")

# Crear objeto de dibujo
draw = ImageDraw.Draw(img)

# Dibujar una línea (x1, y1, x2, y2)
draw.line((50, 100, 750, 100), fill="black", width=3)

# Guardar archivo
img.save("linea.png")

print("Imagen generada: linea.png")
```

### mezclar archivos

```python
from PIL import Image, ImageDraw
from pydub import AudioSegment
import numpy as np

audio = AudioSegment.from_mp3("0802.mp3")
samples = np.array(audio.get_array_of_samples())

anchura = 800
altura = 200

img = Image.new("RGB", (anchura, altura), "white")
draw = ImageDraw.Draw(img)

numerosamples = len(samples)

paso = anchura / numerosamples

max_val = np.max(np.abs(samples))
if max_val == 0:
    max_val = 1  

centro_y = altura // 2

for i in range(0, numerosamples, 100000):  # cada 100 muestras para aligerar
    x = int(i * paso)
    amp_norm = samples[i] / max_val
    y = int(centro_y + amp_norm * (altura // 2 - 1))
    draw.line((x, centro_y, x, y), fill="black", width=1)

img.save("linea.png")
img.show()
```

### masbonito

```python
from PIL import Image, ImageDraw
from pydub import AudioSegment
import numpy as np

audio = AudioSegment.from_mp3("0802.mp3")
samples = np.array(audio.get_array_of_samples())

anchura = 800
altura = 200

img = Image.new("RGB", (anchura, altura), "white")
draw = ImageDraw.Draw(img)

numerosamples = len(samples)

paso = anchura / numerosamples

max_val = np.max(np.abs(samples))
if max_val == 0:
    max_val = 1  

centro_y = altura // 2

for i in range(0, numerosamples, 100000):  # cada 100 muestras para aligerar
    x = int(i * paso)
    amp_norm = samples[i] / max_val
    y = int(centro_y + amp_norm * (altura // 2 - 1))
    y2 = int(centro_y - amp_norm * (altura // 2 - 1))
    draw.line((x, y2, x, y), fill="black", width=3)

img.save("linea.png")
img.show()
```

### redondeo al final

```python
from PIL import Image, ImageDraw
from pydub import AudioSegment
import numpy as np

# --- Parámetros de la imagen ---
anchura = 800
altura = 200
color_fondo = "white"
color_trazo = "black"
grosor = 6              # grosor de cada "barra" (cápsula)
radio = grosor // 2     # radio de las puntas redondeadas

# --- Carga del audio ---
audio = AudioSegment.from_mp3("0802.mp3")

# Aseguramos mono para que no se mezclen canales L/R intercalados
if audio.channels > 1:
    muestras = np.array(audio.get_array_of_samples()).reshape((-1, audio.channels))
    muestras = muestras.mean(axis=1)
else:
    muestras = np.array(audio.get_array_of_samples())

numerosamples = len(muestras)

# --- Creación de la imagen ---
img = Image.new("RGB", (anchura, altura), color_fondo)
draw = ImageDraw.Draw(img)

# Relación índice de muestra → X en la imagen
paso_x = anchura / numerosamples

# Normalización de la amplitud
max_val = np.max(np.abs(muestras))
if max_val == 0:
    max_val = 1

centro_y = altura // 2
amplitud_max_pix = altura // 2 - 1

# Saltamos muestras para aligerar
salto_muestras = 100000  # ajusta a tu gusto

for i in range(0, numerosamples, salto_muestras):
    x_centro = int(i * paso_x)

    amp_norm = muestras[i] / max_val  # entre -1 y 1
    y_top = int(centro_y - amp_norm * amplitud_max_pix)
    y_bottom = int(centro_y + amp_norm * amplitud_max_pix)

    # Aseguramos que top < bottom
    if y_top > y_bottom:
        y_top, y_bottom = y_bottom, y_top

    # Dibujamos una cápsula vertical (rectángulo con esquinas redondeadas)
    draw.rounded_rectangle(
        (
            x_centro - radio,  # left
            y_top,             # top
            x_centro + radio,  # right
            y_bottom           # bottom
        ),
        radius=radio,
        fill=color_trazo,
        outline=color_trazo
    )

img.save("linea_capsula.png")
img.show()
```

### aplicacion de terminal

```python
#!/usr/bin/env python3
"""
wavecaps.py

Pequeña utilidad de consola para generar una “waveform” en forma de cápsulas
redondeadas a partir de un archivo MP3.

Uso básico (ejemplo):

    python wavecaps.py \
        --input 0802.mp3 \
        --output linea_capsula.png \
        --width 800 \
        --height 200 \
        --samples 300 \
        --thickness 6

Parámetros
----------
--input / -i
    Ruta del archivo MP3 de entrada.

--output / -o
    Ruta del archivo de imagen de salida (PNG, JPG, etc. según la extensión).

--width / -W
    Anchura de la imagen en píxeles.

--height / -H
    Altura de la imagen en píxeles.

--samples / -n
    Número de “barras” visuales (cápsulas) que se dibujarán a lo largo de la
    anchura de la imagen. A partir de este valor se calcula el salto de muestras
    del audio para representar toda la forma de onda de manera comprimida.

--thickness / -t
    Grosor de cada cápsula (en píxeles). Internamente se usa para calcular el
    radio de las puntas redondeadas.

Notas
-----
- El audio se convierte a mono si tiene más de un canal (promedio L/R) para que
  la onda no quede intercalada.
- La amplitud se normaliza para usar todo el rango vertical disponible.
- Si el archivo de audio es muy largo, un número de muestras visuales muy alto
  puede ralentizar el proceso o producir una imagen muy “densa”.
"""

import argparse
from pathlib import Path

from PIL import Image, ImageDraw
from pydub import AudioSegment
import numpy as np


def generar_waveform_capsulas(
    input_mp3: str,
    output_img: str,
    anchura: int,
    altura: int,
    num_visual_samples: int,
    grosor: int,
    color_fondo: str = "white",
    color_trazo: str = "black",
) -> None:
    """
    Genera una imagen de waveform en forma de cápsulas redondeadas.

    Parameters
    ----------
    input_mp3 : str
        Ruta al archivo MP3 de entrada.
    output_img : str
        Ruta al archivo de imagen que se generará.
    anchura : int
        Anchura de la imagen en píxeles.
    altura : int
        Altura de la imagen en píxeles.
    num_visual_samples : int
        Número de muestras “visuales” (barras/cápsulas) a dibujar.
    grosor : int
        Grosor de cada cápsula en píxeles.
    color_fondo : str, opcional
        Color de fondo de la imagen (por defecto "white").
    color_trazo : str, opconal
        Color del trazo/cápsulas (por defecto "black").
    """

    # --- Carga del audio ---
    audio = AudioSegment.from_mp3(input_mp3)

    # Aseguramos mono para que no se mezclen canales L/R intercalados
    if audio.channels > 1:
        muestras = np.array(audio.get_array_of_samples()).reshape((-1, audio.channels))
        muestras = muestras.mean(axis=1)
    else:
        muestras = np.array(audio.get_array_of_samples())

    numerosamples = len(muestras)
    if numerosamples == 0:
        raise ValueError("El archivo de audio no contiene muestras.")

    # --- Cálculo del salto de muestras a partir del número de muestras visuales ---
    # Queremos cubrir todo el audio con 'num_visual_samples' posiciones en X.
    # Aseguramos que el salto sea al menos 1 para evitar divisiones por cero.
    salto_muestras = max(1, numerosamples // max(1, num_visual_samples))

    # --- Creación de la imagen ---
    img = Image.new("RGB", (anchura, altura), color_fondo)
    draw = ImageDraw.Draw(img)

    # Relación índice de muestra → X en la imagen
    paso_x = anchura / numerosamples

    # Normalización de la amplitud
    max_val = np.max(np.abs(muestras))
    if max_val == 0:
        max_val = 1  # evitamos división por cero si el audio es completamente silencioso

    centro_y = altura // 2
    amplitud_max_pix = altura // 2 - 1

    radio = max(1, grosor // 2)  # radio para las puntas redondeadas

    # --- Dibujamos las cápsulas ---
    for i in range(0, numerosamples, salto_muestras):
        x_centro = int(i * paso_x)

        amp_norm = muestras[i] / max_val  # entre -1 y 1
        y_top = int(centro_y - amp_norm * amplitud_max_pix)
        y_bottom = int(centro_y + amp_norm * amplitud_max_pix)

        # Aseguramos que top < bottom
        if y_top > y_bottom:
            y_top, y_bottom = y_bottom, y_top

        # Dibujamos una cápsula vertical (rectángulo con esquinas redondeadas)
        draw.rounded_rectangle(
            (
                x_centro - radio,  # left
                y_top,             # top
                x_centro + radio,  # right
                y_bottom           # bottom
            ),
            radius=radio,
            fill=color_trazo,
            outline=color_trazo
        )

    # Guardamos la imagen en disco
    img.save(output_img)


def parse_args() -> argparse.Namespace:
    """Parsea los argumentos de línea de comandos."""
    parser = argparse.ArgumentParser(
        description="Genera una imagen de waveform con cápsulas redondeadas a partir de un MP3."
    )

    parser.add_argument(
        "-i", "--input",
        required=True,
        help="Archivo MP3 de entrada."
    )
    parser.add_argument(
        "-o", "--output",
        required=True,
        help="Archivo de imagen de salida (por ejemplo, output.png)."
    )
    parser.add_argument(
        "-W", "--width",
        type=int,
        default=800,
        help="Anchura de la imagen en píxeles (por defecto: 800)."
    )
    parser.add_argument(
        "-H", "--height",
        type=int,
        default=200,
        help="Altura de la imagen en píxeles (por defecto: 200)."
    )
    parser.add_argument(
        "-n", "--samples",
        type=int,
        default=300,
        help="Número de muestras visuales/barras (por defecto: 300)."
    )
    parser.add_argument(
        "-t", "--thickness",
        type=int,
        default=6,
        help="Grosor de cada cápsula en píxeles (por defecto: 6)."
    )

    return parser.parse_args()


def main() -> None:
    """Punto de entrada principal del script."""
    args = parse_args()

    input_path = Path(args.input)
    if not input_path.is_file():
        raise FileNotFoundError(f"No se encontró el archivo de entrada: {input_path}")

    generar_waveform_capsulas(
        input_mp3=str(input_path),
        output_img=args.output,
        anchura=args.width,
        altura=args.height,
        num_visual_samples=args.samples,
        grosor=args.thickness,
    )


if __name__ == "__main__":
    main()
```

### javascript

```html
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Waveform desde micrófono</title>
<style>
  body {
    font-family: system-ui, sans-serif;
    background: #f5f5f5;
    margin: 0;
    padding: 1rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
    align-items: center;
  }
  #controles {
    display: flex;
    gap: 0.5rem;
  }
  button {
    padding: 0.4rem 0.8rem;
    border-radius: 4px;
    border: 1px solid #333;
    background: #fff;
    cursor: pointer;
  }
  button:disabled {
    opacity: 0.5;
    cursor: default;
  }
  #waveform {
    background: #ffffff;
    border: 1px solid #ccc;
  }
  #estado {
    font-size: 0.9rem;
    color: #555;
  }
</style>
</head>
<body>

<h1>Waveform en Canvas desde micrófono</h1>

<div id="controles">
  <button id="btnStart">Iniciar captura</button>
  <button id="btnStop" disabled>Detener</button>
</div>

<canvas id="waveform" width="1600" height="400"></canvas>

<div id="estado">Pulsa "Iniciar captura" para usar el micrófono.</div>

<script>
/*
  Demo de visualización de waveform en canvas usando el micrófono.

  - Pide permiso de acceso al micrófono (navigator.mediaDevices.getUserMedia).
  - Crea un AudioContext + AnalyserNode.
  - En cada frame (requestAnimationFrame) obtiene muestras de dominio temporal
    y dibuja "barras" verticales con extremos redondeados (lineCap = 'round').
*/

// --- Configuración de la visualización ---
const CONFIG = {
  visualSamples: 300,     // número de barras visibles
  thickness: 6,           // grosor de la barra
  bgColor: '#ffffff',
  waveColor: '#000000'
};

// --- Referencias al DOM ---
const canvas = document.getElementById('waveform');
const ctx = canvas.getContext('2d');
const btnStart = document.getElementById('btnStart');
const btnStop = document.getElementById('btnStop');
const estado = document.getElementById('estado');

// --- Variables de audio ---
let audioContext = null;
let analyser = null;
let dataArray = null;
let mediaStream = null;
let animationId = null;

// --- Función principal de dibujo ---
function draw() {
  if (!analyser) return;

  const ancho = canvas.width;
  const alto = canvas.height;
  const centerY = alto / 2;
  const ampMax = (alto / 2) - 1;

  // Rellenar fondo
  ctx.fillStyle = CONFIG.bgColor;
  ctx.fillRect(0, 0, ancho, alto);

  // Obtener datos de waveform
  analyser.getByteTimeDomainData(dataArray);

  const bufferLength = dataArray.length;
  const visualSamples = CONFIG.visualSamples;
  const step = bufferLength / visualSamples;
  const pasoX = ancho / visualSamples;

  ctx.lineWidth = CONFIG.thickness;
  ctx.lineCap = 'round';
  ctx.strokeStyle = CONFIG.waveColor;

  // Dibujar barras verticales con extremos redondeados
  for (let i = 0; i < visualSamples; i++) {
    const index = Math.floor(i * step);
    const v = (dataArray[index] - 128) / 128; // rango -1..1

    const yTop = centerY - v * ampMax;
    const yBottom = centerY + v * ampMax;

    const x = i * pasoX + pasoX / 2;

    // Línea con extremos redondos: una sola primitiva, sin “truco” de círculos
    ctx.beginPath();
    ctx.moveTo(x, yTop);
    ctx.lineTo(x, yBottom);
    ctx.stroke();
  }

  animationId = requestAnimationFrame(draw);
}

// --- Iniciar captura desde el micrófono ---
async function startCapture() {
  if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
    estado.textContent = 'Tu navegador no soporta getUserMedia.';
    return;
  }

  try {
    mediaStream = await navigator.mediaDevices.getUserMedia({ audio: true });
    audioContext = new (window.AudioContext || window.webkitAudioContext)();
    const source = audioContext.createMediaStreamSource(mediaStream);

    analyser = audioContext.createAnalyser();
    analyser.fftSize = 2048;
    const bufferLength = analyser.fftSize;
    dataArray = new Uint8Array(bufferLength);

    source.connect(analyser);

    btnStart.disabled = true;
    btnStop.disabled = false;
    estado.textContent = 'Capturando audio...';

    draw();
  } catch (err) {
    console.error(err);
    estado.textContent = 'Error al acceder al micrófono: ' + err.message;
  }
}

// --- Detener captura ---
function stopCapture() {
  if (animationId !== null) {
    cancelAnimationFrame(animationId);
    animationId = null;
  }
  if (mediaStream) {
    mediaStream.getTracks().forEach(track => track.stop());
    mediaStream = null;
  }
  if (audioContext) {
    audioContext.close();
    audioContext = null;
  }
  analyser = null;
  dataArray = null;

  btnStart.disabled = false;
  btnStop.disabled = true;
  estado.textContent = 'Captura detenida.';
}

// --- Eventos de los botones ---
btnStart.addEventListener('click', startCapture);
btnStop.addEventListener('click', stopCapture);
</script>

</body>
</html>
```

### jarvis

```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Radial Audio Waveform</title>
    <style>
        body{
            margin:0;
            height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            background:#111;
            color:#eee;
            font-family:sans-serif;
            flex-direction:column;
            gap:1rem;
        }
        canvas{
            background:#111;
            border-radius:50%;
        }
        button{
            padding:0.5rem 1rem;
            border-radius:999px;
            border:none;
            cursor:pointer;
            font-size:1rem;
        }
    </style>
</head>
<body>
    <canvas id="lienzo" width="400" height="400"></canvas>
    <button id="startBtn">Start microphone</button>

    <script>
        const canvas = document.getElementById("lienzo");
        const ctx = canvas.getContext("2d");
        const W = canvas.width;
        const H = canvas.height;

        // ------------ CONFIG -------------
        const numRings       = 24;
        const ringWidth      = 6;
        const innerRadius    = 30;
        const maxOpacity     = 0.9;
        const minOpacity     = 0.15;
        const minSpanFactor  = 0.3;  // span base * this when no sound
        const maxSpanFactor  = 2.0;  // span base * this with loud sound
        const audioAngleBoost = 0.02; // how much audio pushes angle
        const baseBgAlpha    = 0.18;  // trail

        // ------------ RINGS -------------
        class Ring {
            constructor(i) {
                this.type = Math.floor(Math.random() * 4); // 0..3 como en tu ejemplo
                this.r = innerRadius + i * ringWidth * 1.3;
                this.baseSpan = Math.random() * Math.PI * 1.5 + Math.PI * 0.3;
                this.phase = Math.random() * Math.PI * 2;
                this.speed = (Math.random() - 0.5) * 0.01; // velocidad base permanente
            }
        }

        const rings = [];
        for (let i = 0; i < numRings; i++) {
            rings.push(new Ring(i));
        }

        // ------------ AUDIO -------------
        let audioCtx = null;
        let analyser = null;
        let dataArray = null;

        async function initAudio() {
            if (audioCtx) return; // ya inicializado

            audioCtx = new (window.AudioContext || window.webkitAudioContext)();
            const stream = await navigator.mediaDevices.getUserMedia({ audio: true, video: false });
            const source = audioCtx.createMediaStreamSource(stream);

            analyser = audioCtx.createAnalyser();
            analyser.fftSize = 1024;
            const bufferLength = analyser.frequencyBinCount;
            dataArray = new Uint8Array(bufferLength);

            source.connect(analyser);
        }

        document.getElementById("startBtn").addEventListener("click", async () => {
            try {
                await initAudio();
                document.getElementById("startBtn").style.display = "none";
                animate();
            } catch (e) {
                console.error(e);
                alert("Error accessing microphone.");
            }
        });

        // ------------ ANIMACIÓN -------------
        function getBandEnergyForRing(ringIndex) {
            if (!analyser || !dataArray) return 0;

            analyser.getByteFrequencyData(dataArray);
            const len = dataArray.length;

            // Mapeamos cada anillo a una "banda" aproximada
            const bandSize = Math.floor(len / numRings) || 1;
            const start = ringIndex * bandSize;
            const end = Math.min(start + bandSize, len);

            let sum = 0;
            for (let i = start; i < end; i++) {
                sum += dataArray[i];
            }

            const avg = sum / (end - start || 1);
            return avg / 255; // 0..1
        }

        function animate() {
            // fondo con un poco de alpha para crear "trail"
            ctx.fillStyle = `rgba(0,0,0,${baseBgAlpha})`;
            ctx.fillRect(0, 0, W, H);

            ctx.save();
            ctx.translate(W / 2, H / 2);

            for (let i = 0; i < numRings; i++) {
                const ring = rings[i];

                // energía del anillo (0..1)
                const energy = getBandEnergyForRing(i);

                // spans: siempre hay un span base, modulado por audio
                const spanFactor = minSpanFactor + (maxSpanFactor - minSpanFactor) * energy;
                const span = ring.baseSpan * spanFactor;

                // movimiento: velocidad base + un poquito según audio
                ring.phase += ring.speed + energy * audioAngleBoost;

                const a1 = ring.phase;
                const a2 = ring.phase + span;

                // grosor y opacidad modulados por audio (pero nunca 0)
                const lw = ringWidth + energy * 4;
                ctx.lineWidth = lw;
                const opacity = minOpacity + (maxOpacity - minOpacity) * energy;

                switch (ring.type) {
                    case 0: // arco simple
                        ctx.strokeStyle = `rgba(255,255,255,${opacity})`;
                        ctx.beginPath();
                        ctx.arc(0, 0, ring.r, a1, a2, false);
                        ctx.stroke();
                        ctx.closePath();
                        break;

                    case 1: // área tipo "quesito"
                        ctx.fillStyle = `rgba(255,255,255,${opacity * 0.7})`;
                        ctx.beginPath();
                        ctx.moveTo(0, 0);
                        ctx.arc(0, 0, ring.r, a1, a2, false);
                        ctx.closePath();
                        ctx.fill();
                        break;

                    case 2: // muchos trocitos + puntas marcadas
                        ctx.strokeStyle = `rgba(255,255,255,${opacity})`;
                        const step = 0.08;
                        for (let a = a1; a < a2; a += step) {
                            ctx.beginPath();
                            ctx.arc(0, 0, ring.r, a, a + step * 0.5, false);
                            ctx.stroke();
                            ctx.closePath();
                        }

                        // remarcar puntas
                        ctx.lineWidth = lw + 6;
                        ctx.beginPath();
                        ctx.arc(0, 0, ring.r, a1, a1 + 0.03, false);
                        ctx.stroke();
                        ctx.closePath();
                        ctx.beginPath();
                        ctx.arc(0, 0, ring.r, a2 - 0.03, a2, false);
                        ctx.stroke();
                        ctx.closePath();
                        break;

                    case 3: // arco fino + puntos en extremos
                        ctx.strokeStyle = `rgba(255,255,255,${opacity})`;
                        ctx.lineWidth = 1 + energy * 2;
                        ctx.beginPath();
                        ctx.arc(0, 0, ring.r, a1, a2, false);
                        ctx.stroke();
                        ctx.closePath();

                        const x1 = Math.cos(a1) * ring.r;
                        const y1 = Math.sin(a1) * ring.r;
                        const x2 = Math.cos(a2) * ring.r;
                        const y2 = Math.sin(a2) * ring.r;

                        const puntoR = 3 + energy * 4;
                        ctx.beginPath();
                        ctx.arc(x1, y1, puntoR, 0, Math.PI * 2, true);
                        ctx.fillStyle = `rgba(255,255,255,${opacity})`;
                        ctx.fill();
                        ctx.closePath();

                        ctx.beginPath();
                        ctx.arc(x2, y2, puntoR, 0, Math.PI * 2, true);
                        ctx.fill();
                        ctx.closePath();
                        break;
                }
            }

            ctx.restore();
            requestAnimationFrame(animate);
        }
    </script>
</body>
</html>
```

### rebote ia

```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bounce AI Radial Visualizer</title>
    <style>
        body{
            margin:0;
            height:100vh;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            gap:1rem;
            background:#111;
            color:#eee;
            font-family:sans-serif;
        }
        .layout{
            display:flex;
            gap:2rem;
            align-items:center;
            justify-content:center;
        }
        canvas{
            background:#111;
            border-radius:50%;
        }
        .panel{
            display:flex;
            flex-direction:column;
            align-items:center;
            gap:0.5rem;
        }
        button{
            padding:0.5rem 1rem;
            border-radius:999px;
            border:none;
            cursor:pointer;
            font-size:1rem;
        }
        #textoHumano, #textoIA{
            min-height:1.5em;
            font-size:0.9rem;
            max-width:250px;
            text-align:center;
            color:#ccc;
        }
    </style>
</head>
<body>
    <div class="layout">
        <div class="panel">
            <canvas id="canvasHumano" width="350" height="350"></canvas>
            <button id="btnMicro">Iniciar micrófono</button>
            <div id="textoHumano"></div>
        </div>
        <div class="panel">
            <canvas id="canvasIA" width="350" height="350"></canvas>
            <button id="btnHablar">Hablar &rarr; IA repite</button>
            <div id="textoIA"></div>
        </div>
    </div>

    <script>
        // ----------------------------------------------------
        //  CONFIGURACIÓN VISUAL COMÚN (tomado del original)
        // ----------------------------------------------------
        const numRings       = 24;
        const ringWidth      = 6;
        const innerRadius    = 30;
        const maxOpacity     = 0.9;
        const minOpacity     = 0.15;
        const minSpanFactor  = 0.3;   // span base * esto con poco sonido
        const maxSpanFactor  = 2.0;   // span base * esto con mucho sonido
        const audioAngleBoost = 0.02; // cuánto desplaza el ángulo la energía
        const baseBgAlpha    = 0.18;  // estela

        // Limitamos el span para que JAMÁS llegue a círculo completo
        const maxSpanAngular = Math.PI * 1.8; // < 2π

        // ----------------------------------------------------
        //  CLASE VISUALIZADOR RADIAL
        // ----------------------------------------------------
        class RadialVisualizer {
            constructor(canvas) {
                this.canvas = canvas;
                this.ctx = canvas.getContext("2d");
                this.W = canvas.width;
                this.H = canvas.height;

                this.rings = [];
                for (let i = 0; i < numRings; i++) {
                    this.rings.push(this._crearAnillo(i));
                }
            }

            _crearAnillo(i) {
                const ring = {};
                ring.type = Math.floor(Math.random() * 4); // 0..3
                ring.r = innerRadius + i * ringWidth * 1.3;
                ring.baseSpan = Math.random() * Math.PI * 1.5 + Math.PI * 0.3; // 0.3π..1.8π
                ring.phase = Math.random() * Math.PI * 2;
                ring.speed = (Math.random() - 0.5) * 0.01; // velocidad base permanente
                return ring;
            }

            /**
             * Dibuja un frame de la animación.
             * @param {function(number):number} getEnergyForRing función que devuelve [0..1]
             *        dado el índice de anillo.
             */
            draw(getEnergyForRing) {
                const ctx = this.ctx;
                const W = this.W;
                const H = this.H;

                // Fondo con alpha para la estela
                ctx.fillStyle = `rgba(0,0,0,${baseBgAlpha})`;
                ctx.fillRect(0, 0, W, H);

                ctx.save();
                ctx.translate(W / 2, H / 2);

                for (let i = 0; i < this.rings.length; i++) {
                    const ring = this.rings[i];
                    const energy = Math.max(0, Math.min(1, getEnergyForRing(i) || 0));

                    // Span base modulado por audio
                    const spanFactor = minSpanFactor + (maxSpanFactor - minSpanFactor) * energy;
                    let span = ring.baseSpan * spanFactor;

                    // EVITAR CÍRCULOS COMPLETOS
                    if (span > maxSpanAngular) {
                        span = maxSpanAngular;
                    }

                    ring.phase += ring.speed + energy * audioAngleBoost;

                    const a1 = ring.phase;
                    const a2 = ring.phase + span;

                    const lwBase = ringWidth + energy * 4;
                    const opacity = minOpacity + (maxOpacity - minOpacity) * energy;

                    switch (ring.type) {
                        case 0: // arco simple
                            ctx.lineWidth = lwBase;
                            ctx.strokeStyle = `rgba(255,255,255,${opacity})`;
                            ctx.beginPath();
                            ctx.arc(0, 0, ring.r, a1, a2, false);
                            ctx.stroke();
                            ctx.closePath();
                            break;

                        case 1: // área tipo "quesito"
                            ctx.fillStyle = `rgba(255,255,255,${opacity * 0.7})`;
                            ctx.beginPath();
                            ctx.moveTo(0, 0);
                            ctx.arc(0, 0, ring.r, a1, a2, false);
                            ctx.closePath();
                            ctx.fill();
                            break;

                        case 2: // muchos trocitos + puntas marcadas
                            ctx.strokeStyle = `rgba(255,255,255,${opacity})`;
                            ctx.lineWidth = lwBase;
                            const step = 0.08;
                            for (let a = a1; a < a2; a += step) {
                                ctx.beginPath();
                                ctx.arc(0, 0, ring.r, a, a + step * 0.5, false);
                                ctx.stroke();
                                ctx.closePath();
                            }

                            // remarcar puntas
                            ctx.lineWidth = lwBase + 6;
                            ctx.beginPath();
                            ctx.arc(0, 0, ring.r, a1, a1 + 0.03, false);
                            ctx.stroke();
                            ctx.closePath();
                            ctx.beginPath();
                            ctx.arc(0, 0, ring.r, a2 - 0.03, a2, false);
                            ctx.stroke();
                            ctx.closePath();
                            break;

                        case 3: // arco fino + puntos en extremos
                            ctx.strokeStyle = `rgba(255,255,255,${opacity})`;
                            ctx.lineWidth = 1 + energy * 2;
                            ctx.beginPath();
                            ctx.arc(0, 0, ring.r, a1, a2, false);
                            ctx.stroke();
                            ctx.closePath();

                            const x1 = Math.cos(a1) * ring.r;
                            const y1 = Math.sin(a1) * ring.r;
                            const x2 = Math.cos(a2) * ring.r;
                            const y2 = Math.sin(a2) * ring.r;

                            const puntoR = 3 + energy * 4;
                            ctx.beginPath();
                            ctx.arc(x1, y1, puntoR, 0, Math.PI * 2, true);
                            ctx.fillStyle = `rgba(255,255,255,${opacity})`;
                            ctx.fill();
                            ctx.closePath();

                            ctx.beginPath();
                            ctx.arc(x2, y2, puntoR, 0, Math.PI * 2, true);
                            ctx.fill();
                            ctx.closePath();
                            break;
                    }
                }

                ctx.restore();
            }
        }

        // ----------------------------------------------------
        //  VISUALIZADOR HUMANO (MICRÓFONO)
        // ----------------------------------------------------
        const canvasHumano = document.getElementById("canvasHumano");
        const visHumano = new RadialVisualizer(canvasHumano);

        let audioCtxHumano = null;
        let analyserHumano = null;
        let dataHumano = null;

        async function initMicrofono() {
            if (audioCtxHumano) return;

            const AudioContext = window.AudioContext || window.webkitAudioContext;
            audioCtxHumano = new AudioContext();

            const stream = await navigator.mediaDevices.getUserMedia({
                audio: true,
                video: false
            });

            const source = audioCtxHumano.createMediaStreamSource(stream);

            analyserHumano = audioCtxHumano.createAnalyser();
            analyserHumano.fftSize = 1024;
            const bufferLength = analyserHumano.frequencyBinCount;
            dataHumano = new Uint8Array(bufferLength);

            source.connect(analyserHumano);
        }

        function getEnergyHumanoForRing(ringIndex) {
            if (!analyserHumano || !dataHumano) return 0;
            analyserHumano.getByteFrequencyData(dataHumano);
            const len = dataHumano.length;

            const bandSize = Math.floor(len / numRings) || 1;
            const start = ringIndex * bandSize;
            const end = Math.min(start + bandSize, len);

            let sum = 0;
            for (let i = start; i < end; i++) {
                sum += dataHumano[i];
            }
            const avg = sum / (end - start || 1);
            return avg / 255; // 0..1
        }

        // ----------------------------------------------------
        //  VISUALIZADOR IA (SPEECH SYNTHESIS APROXIMADO)
        // ----------------------------------------------------
        const canvasIA = document.getElementById("canvasIA");
        const visIA = new RadialVisualizer(canvasIA);

        let iaHablando = false;
        let iaEnergyGlobal = 0;   // energía aproximada en [0..1]
        let tiempoIA = 0;         // para pequeños patrones

        function getEnergyIAForRing(ringIndex) {
            // Sin API de waveform de speechSynthesis,
            // generamos una energía "bonita" cuando la IA está hablando.
            const baseSilencio = 0.03;

            if (!iaHablando) {
                // pequeña respiración cuando está callada
                return baseSilencio + 0.02 * Math.abs(Math.sin(ringIndex + tiempoIA * 0.005));
            }

            // Energía global decae lentamente
            iaEnergyGlobal *= 0.98;
            // Y la reinyectamos un poco mientras "habla"
            iaEnergyGlobal = Math.min(1, iaEnergyGlobal + 0.02);

            // Diferenciamos por anillo con funciones senoidales
            const bandNoise = 0.5 + 0.5 * Math.sin(tiempoIA * 0.01 + ringIndex * 0.6);
            const energy = baseSilencio + iaEnergyGlobal * bandNoise;

            return Math.max(0, Math.min(1, energy));
        }

        // ----------------------------------------------------
        //  SPEECH RECOGNITION + SPEECH SYNTHESIS
        // ----------------------------------------------------
        const btnMicro = document.getElementById("btnMicro");
        const btnHablar = document.getElementById("btnHablar");
        const divTextoHumano = document.getElementById("textoHumano");
        const divTextoIA = document.getElementById("textoIA");

        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        let recognition = null;

        if (SpeechRecognition) {
            recognition = new SpeechRecognition();
            recognition.lang = "es-ES";
            recognition.interimResults = false;
            recognition.maxAlternatives = 1;
        }

        btnMicro.addEventListener("click", async () => {
            try {
                await initMicrofono();
                btnMicro.disabled = true;
                btnMicro.textContent = "Micrófono funcionando";
            } catch (e) {
                console.error(e);
                alert("Error al acceder al micrófono");
            }
        });

        btnHablar.addEventListener("click", () => {
            if (!recognition) {
                alert("Esta API de reconocimiento no está disponible en este navegador.");
                return;
            }

            divTextoHumano.textContent = "Escuchando...";
            recognition.start();
        });

        if (recognition) {
            recognition.addEventListener("result", (event) => {
                const texto = event.results[0][0].transcript;
                divTextoHumano.textContent = "Tú dijiste: " + texto;
                // Ahora la IA repite
                hablarIA(texto);
            });

            recognition.addEventListener("end", () => {
                // Nada especial; podríamos reiniciar si quisiéramos.
            });
        }

        function hablarIA(texto) {
            if (!window.speechSynthesis) {
                alert("speechSynthesis no disponible en este navegador.");
                return;
            }

            const utt = new SpeechSynthesisUtterance(texto);
            utt.lang = "es-ES";
            divTextoIA.textContent = "IA dice: " + texto;

            iaHablando = true;
            iaEnergyGlobal = 0.4; // arranque de energía

            utt.onend = () => {
                iaHablando = false;
            };

            window.speechSynthesis.speak(utt);
        }

        // ----------------------------------------------------
        //  BUCLE GLOBAL DE ANIMACIÓN (AMBOS VISUALIZADORES)
        // ----------------------------------------------------
        function loop() {
            // Humano: usa FFT real del micrófono (si está activo)
            visHumano.draw(getEnergyHumanoForRing);

            // IA: patrón sintético atado al estado de iaHablando
            tiempoIA++;
            visIA.draw(getEnergyIAForRing);

            requestAnimationFrame(loop);
        }
        loop();
    </script>
</body>
</html>
```

### mas rebote IA

```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bounce AI – Dual Radial Visualizer</title>
    <style>
        body{
            margin:0;
            height:100vh;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            background:#111;
            color:#eee;
            font-family:sans-serif;
            gap:1rem;
        }
        .row{
            display:flex;
            gap:2rem;
            align-items:center;
            justify-content:center;
        }
        canvas{
            background:#111;
            border-radius:50%;
        }
        button{
            padding:0.5rem 1rem;
            border-radius:999px;
            border:none;
            cursor:pointer;
            font-size:1rem;
        }
        .labels{
            display:flex;
            justify-content:space-between;
            width:100%;
            max-width:900px;
            font-size:0.9rem;
            opacity:0.8;
        }
        .labels span{
            flex:1;
            text-align:center;
        }
        .text-row{
            max-width:900px;
            width:100%;
            display:flex;
            flex-direction:column;
            gap:0.35rem;
            font-size:0.9rem;
        }
        .bubble{
            background:#222;
            padding:0.5rem 0.75rem;
            border-radius:0.5rem;
            min-height:1.4rem;
            word-break:break-word;
        }
        .bubble span.label{
            opacity:0.6;
            font-size:0.8rem;
            display:block;
            margin-bottom:0.2rem;
            text-transform:uppercase;
            letter-spacing:0.06em;
        }
        .labels,.text-row{
          display:none;
        }
        #startBtn{
          opacity:0.1;
        }
    </style>
</head>
<body>
    <button id="startBtn">Start bounce AI (mic + speech)</button>

    <div class="row">
        <canvas id="humanCanvas" width="400" height="400"></canvas>
        <canvas id="aiCanvas" width="400" height="400"></canvas>
    </div>

    <div class="labels">
        <span>👤 Humano (micrófono)</span>
        <span>🤖 “IA” (speech synthesis)</span>
    </div>

    <div class="text-row">
        <div class="bubble">
            <span class="label">Tú dices</span>
            <span id="humanText"></span>
        </div>
        <div class="bubble">
            <span class="label">La “IA” repite</span>
            <span id="aiText"></span>
        </div>
    </div>

    <script>
        // -------------------- CONFIG VISUAL --------------------
        const numRings       = 24;
        const ringWidth      = 6;
        const innerRadius    = 30;
        const maxOpacity     = 0.9;
        const minOpacity     = 0.15;
        const minSpanFactor  = 0.3;   // span base * this when no sound
        const maxSpanFactor  = 2.0;   // span base * this with loud sound
        const audioAngleBoost = 0.02; // how much audio pushes angle
        const baseBgAlpha    = 0.18;  // trail

        // -------------------- CANVASES --------------------
        const humanCanvas = document.getElementById("humanCanvas");
        const aiCanvas    = document.getElementById("aiCanvas");
        const hctx = humanCanvas.getContext("2d");
        const actx = aiCanvas.getContext("2d");
        const HW = humanCanvas.width;
        const HH = humanCanvas.height;
        const AW = aiCanvas.width;
        const AH = aiCanvas.height;

        // -------------------- RING CLASS --------------------
        class Ring {
            constructor(i, innerRadiusLocal, ringWidthLocal) {
                this.type = Math.floor(Math.random() * 4); // 0..3
                this.r = innerRadiusLocal + i * ringWidthLocal * 1.3;
                this.baseSpan = Math.random() * Math.PI * 1.5 + Math.PI * 0.3;
                this.phase = Math.random() * Math.PI * 2;
                this.speed = (Math.random() - 0.5) * 0.01; // base angular speed

                // extra per-ring noise phase for AI visualizer
                this.noisePhase = Math.random() * Math.PI * 2;
                this.noiseSpeed = 0.01 + Math.random() * 0.02;
            }
        }

        const humanRings = [];
        const aiRings    = [];
        for (let i = 0; i < numRings; i++) {
            humanRings.push(new Ring(i, innerRadius, ringWidth));
            aiRings.push(new Ring(i, innerRadius, ringWidth));
        }

        // -------------------- AUDIO – HUMAN (MIC) --------------------
        let audioCtx = null;
        let analyserHuman = null;
        let dataArrayHuman = null;

        async function initHumanAudio() {
            if (audioCtx) return; // already initialized

            audioCtx = new (window.AudioContext || window.webkitAudioContext)();
            const stream = await navigator.mediaDevices.getUserMedia({ audio: true, video: false });
            const source = audioCtx.createMediaStreamSource(stream);

            analyserHuman = audioCtx.createAnalyser();
            analyserHuman.fftSize = 1024;
            const bufferLength = analyserHuman.frequencyBinCount;
            dataArrayHuman = new Uint8Array(bufferLength);

            source.connect(analyserHuman);
        }

        function getBandEnergyForRing(ringIndex) {
            if (!analyserHuman || !dataArrayHuman) return 0;

            analyserHuman.getByteFrequencyData(dataArrayHuman);
            const len = dataArrayHuman.length;

            const bandSize = Math.floor(len / numRings) || 1;
            const start = ringIndex * bandSize;
            const end = Math.min(start + bandSize, len);

            let sum = 0;
            for (let i = start; i < end; i++) {
                sum += dataArrayHuman[i];
            }

            const avg = sum / (end - start || 1);
            return avg / 255; // 0..1
        }

        // -------------------- "AI" AUDIO ENVELOPE (FAKE ANALYSER) --------------------
        // We can't access speechSynthesis raw PCM, so we approximate with a smooth,
        // noisy envelope that behaves similar to the mic visualizer.
        let aiSpeaking = false;
        let aiLevel = 0;     // global energy 0..1
        let aiPhase = 0;     // global noise phase

        function updateAiEnvelope() {
            // Smooth approach to a "target" level when speaking / silence
            const target = aiSpeaking ? 0.7 : 0.0;
            const speed  = aiSpeaking ? 0.05 : 0.03; // approach speed

            aiLevel += (target - aiLevel) * speed;
            aiPhase += 0.03;
        }

        function getAiEnergyForRing(ringIndex) {
            // energy ~ aiLevel with per-ring variation
            const ring = aiRings[ringIndex];
            ring.noisePhase += ring.noiseSpeed * 0.5;

            // base noise between 0.7 and 1.0 when level is high, but scaled by aiLevel
            const n = 0.5 + 0.5 * Math.sin(aiPhase + ringIndex * 0.7 + ring.noisePhase);
            // mix with aiLevel to avoid all-or-nothing
            const energy = aiLevel * (0.4 + 0.6 * n); // 0 .. ~ aiLevel

            return energy; // 0..~1
        }

        // -------------------- SPEECH: RECOGNITION + SYNTHESIS --------------------
        const humanTextEl = document.getElementById("humanText");
        const aiTextEl    = document.getElementById("aiText");

        let recognition = null;
        let listening = false;

        function initRecognition() {
            const SpeechRec =
                window.SpeechRecognition ||
                window.webkitSpeechRecognition;

            if (!SpeechRec) {
                alert("webkitSpeechRecognition no está disponible en este navegador.");
                return;
            }

            recognition = new SpeechRec();
            recognition.lang = "es-ES";
            recognition.continuous = false;
            recognition.interimResults = false;

            recognition.onresult = (event) => {
                const transcript = event.results[0][0].transcript.trim();
                humanTextEl.textContent = transcript;

                // Bounce: IA repeats the same text in Spanish
                speakAI(transcript);
            };

            recognition.onerror = (e) => {
                console.error("Recognition error:", e);
            };

            recognition.onend = () => {
                if (listening) {
                    // Restart recognition to keep bounce AI going
                    try {
                        recognition.start();
                    } catch (e) {
                        console.warn("Restart recognition error:", e);
                    }
                }
            };
        }

        function speakAI(text) {
            if (!("speechSynthesis" in window)) {
                alert("Speech Synthesis no está disponible en este navegador.");
                return;
            }

            const utter = new SpeechSynthesisUtterance(text);
            utter.lang = "es-ES";

            utter.onstart = () => {
                aiSpeaking = true;
                aiTextEl.textContent = text;
            };

            utter.onend = () => {
                aiSpeaking = false;
            };

            // stop any current speech
            window.speechSynthesis.cancel();
            window.speechSynthesis.speak(utter);
        }

        // -------------------- ANIMATION DRAW --------------------
        function drawVisualizer(ctx, rings, W, H, energyFn) {
            // background with alpha trail
            ctx.fillStyle = `rgba(0,0,0,${baseBgAlpha})`;
            ctx.fillRect(0, 0, W, H);

            ctx.save();
            ctx.translate(W / 2, H / 2);

            for (let i = 0; i < rings.length; i++) {
                const ring = rings[i];

                const energy = energyFn(i); // 0..1

                const spanFactor = minSpanFactor + (maxSpanFactor - minSpanFactor) * energy;
                const span = ring.baseSpan * spanFactor;

                ring.phase += ring.speed + energy * audioAngleBoost;

                const a1 = ring.phase;
                const a2 = ring.phase + span;

                const lw = ringWidth + energy * 4;
                const opacity = minOpacity + (maxOpacity - minOpacity) * energy;

                switch (ring.type) {
                    case 0: // arco simple
                        ctx.strokeStyle = `rgba(255,255,255,${opacity})`;
                        ctx.lineWidth = lw;
                        ctx.beginPath();
                        ctx.arc(0, 0, ring.r, a1, a2, false);
                        ctx.stroke();
                        ctx.closePath();
                        break;

                    case 1: // área tipo "quesito"
                        ctx.fillStyle = `rgba(255,255,255,${opacity * 0.7})`;
                        ctx.beginPath();
                        ctx.moveTo(0, 0);
                        ctx.arc(0, 0, ring.r, a1, a2, false);
                        ctx.closePath();
                        ctx.fill();
                        break;

                    case 2: // trocitos + puntas marcadas
                        ctx.strokeStyle = `rgba(255,255,255,${opacity})`;
                        ctx.lineWidth = lw;
                        const step = 0.08;
                        for (let a = a1; a < a2; a += step) {
                            ctx.beginPath();
                            ctx.arc(0, 0, ring.r, a, a + step * 0.5, false);
                            ctx.stroke();
                            ctx.closePath();
                        }

                        // remarcar puntas
                        ctx.lineWidth = lw + 6;
                        ctx.beginPath();
                        ctx.arc(0, 0, ring.r, a1, a1 + 0.03, false);
                        ctx.stroke();
                        ctx.closePath();
                        ctx.beginPath();
                        ctx.arc(0, 0, ring.r, a2 - 0.03, a2, false);
                        ctx.stroke();
                        ctx.closePath();
                        break;

                    case 3: // arco fino + puntos en extremos
                        ctx.strokeStyle = `rgba(255,255,255,${opacity})`;
                        ctx.lineWidth = 1 + energy * 2;
                        ctx.beginPath();
                        ctx.arc(0, 0, ring.r, a1, a2, false);
                        ctx.stroke();
                        ctx.closePath();

                        const x1 = Math.cos(a1) * ring.r;
                        const y1 = Math.sin(a1) * ring.r;
                        const x2 = Math.cos(a2) * ring.r;
                        const y2 = Math.sin(a2) * ring.r;

                        const puntoR = 3 + energy * 4;
                        ctx.beginPath();
                        ctx.arc(x1, y1, puntoR, 0, Math.PI * 2, true);
                        ctx.fillStyle = `rgba(255,255,255,${opacity})`;
                        ctx.fill();
                        ctx.closePath();

                        ctx.beginPath();
                        ctx.arc(x2, y2, puntoR, 0, Math.PI * 2, true);
                        ctx.fill();
                        ctx.closePath();
                        break;
                }
            }

            ctx.restore();
        }

        function animate() {
            // update fake AI envelope before drawing
            updateAiEnvelope();

            // human visualizer (real mic analyser)
            drawVisualizer(hctx, humanRings, HW, HH, getBandEnergyForRing);

            // AI visualizer (smooth/noisy envelope, similar thresholds)
            drawVisualizer(actx, aiRings, AW, AH, getAiEnergyForRing);

            requestAnimationFrame(animate);
        }

        // -------------------- START BUTTON --------------------
        document.getElementById("startBtn").addEventListener("click", async () => {
            try {
                await initHumanAudio();
                initRecognition();
                listening = true;
                if (recognition) {
                    recognition.start();
                }
                document.getElementById("startBtn").style.display = "none";
                animate();
            } catch (e) {
                console.error(e);
                alert("Error inicializando audio o reconocimiento.");
            }
        });
    </script>
</body>
</html>
```

### reproductor audio

```html
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <title>Bounce AI – Doble visualizador radial</title>
  </head>
  <body>
    <audio src="0802.mp3" controls>
  </body>
</html>
```

### contenedor

```html
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <title>Audio</title>
  </head>
  <body>
    <div id="contieneaudio">
      <audio src="0802.mp3"></audio>
      <img src="0802.png">
      <input type="range" min=0 max=1 step=0.001>
    </div>
  </body>
</html>
```

### un poco de estilo

```html
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <title>Audio</title>
    <style>
      
    </style>
  </head>
  <body>
    <div id="contieneaudio">
      <audio src="0802.mp3"></audio>
      <img src="0802.png">
      <input type="range" min=0 max=1 step=0.001>
    </div>
  </body>
</html>
```

<a id="estructura-de-un-fichero-de-mapeo"></a>
## Estructura de un fichero de mapeo

En la subunidad "Estructura de un fichero de mapeo" del módulo de Herramientas de Mapeo Objeto Relacional (ORM), se profundiza en el formato específico que sigue un archivo de configuración para definir cómo se relacionan los objetos de una aplicación con las tablas y columnas de una base de datos. Este fichero es fundamental para automatizar el proceso de acceso a la información, minimizando así la redundancia y aumentando la eficiencia en la gestión de datos.

El contenido del fichero de mapeo se organiza en bloques que corresponden a cada clase o entidad de la aplicación. Cada bloque comienza con una declaración que indica el nombre de la clase y los detalles sobre su estructura, como las propiedades y sus tipos de datos asociados. A continuación, se especifican las relaciones entre las clases, definiendo cómo un objeto pertenece a otro o cómo varios objetos están relacionados entre sí.

Además del mapeo básico de las entidades, el fichero puede incluir configuraciones adicionales que controlan el comportamiento de la persistencia de los datos. Esto puede implicar especificar estrategias para la actualización y sincronización de los objetos con la base de datos, así como definir políticas de seguridad que limiten el acceso a ciertos campos o métodos.

El uso de un fichero de mapeo ORM permite una mayor flexibilidad en el diseño de aplicaciones, ya que permite cambiar fácilmente la estructura interna del código sin necesidad de modificar las consultas SQL directamente. Esto facilita el mantenimiento y evolución del software a lo largo del tiempo.

Además, los ficheros de mapeo ORM suelen soportar la definición de métodos personalizados que pueden ser ejecutados en el contexto de un objeto persistido. Estos métodos pueden incluir lógica de negocio compleja o operaciones específicas que requieren acceso a múltiples tablas.

La estructura del fichero de mapeo ORM también puede incluir configuraciones para la gestión de relaciones bidireccionales, lo que permite que los objetos puedan referirse entre sí sin necesidad de realizar consultas adicionales. Esto mejora significativamente el rendimiento y la simplicidad en la manipulación de datos relacionados.

En resumen, la estructura de un fichero de mapeo ORM es una herramienta poderosa que facilita la integración entre aplicaciones y bases de datos, permitiendo un acceso eficiente y seguro a los datos mientras se mantiene el código limpio y organizado. Este enfoque no solo simplifica el desarrollo de software, sino que también mejora su mantenibilidad y escalabilidad a largo plazo.

<a id="mapeo-basado-en-anotaciones"></a>
## Mapeo basado en anotaciones

En la subunidad "Mapeo basado en anotaciones" del módulo de Herramientas de Mapeo Objeto Relacional (ORM), nos centramos en una técnica que facilita la integración entre el mundo orientado a objetos y la base de datos relacional. Esta metodología permite definir las relaciones entre clases y tablas directamente dentro del código fuente, utilizando anotaciones específicas.

La ventaja principal del mapeo basado en anotaciones es su simplicidad y eficiencia. Al no requerir la creación de archivos XML separados para el mapeo, se reduce significativamente la complejidad del proyecto. Además, esta técnica permite una mayor flexibilidad y adaptabilidad, ya que los cambios en las clases pueden reflejarse automáticamente en la base de datos sin necesidad de modificar archivos adicionales.

Para implementar el mapeo basado en anotaciones, es necesario seleccionar una herramienta ORM compatible con este método. Algunas opciones populares incluyen Hibernate para Java y Entity Framework para .NET. Estas herramientas proporcionan un conjunto completo de funcionalidades que facilitan la creación, consulta y actualización de objetos a través de la base de datos.

Una de las anotaciones más comunes utilizadas en este contexto es `@Entity`, que se aplica a las clases que representan tablas en la base de datos. Esta anotación marca la clase como una entidad y proporciona información sobre su nombre en la base de datos, si es necesario.

Además de `@Entity`, existen otras anotaciones importantes como `@Table` para especificar el nombre de la tabla correspondiente, `@Id` para definir la clave primaria de la entidad, y `@Column` para mapear las propiedades de la clase a los campos de la tabla. Estas anotaciones permiten una gran personalización y control sobre cómo se relacionan los objetos con las tablas en la base de datos.

El uso del mapeo basado en anotaciones también facilita el desarrollo de aplicaciones que utilizan ORM, ya que permite un flujo más natural entre el código orientado a objetos y la lógica de acceso a datos. Esto puede resultar en menos errores y una mayor productividad durante el desarrollo.

En resumen, el mapeo basado en anotaciones es una técnica poderosa y eficiente para integrar ORM en proyectos de programación. Su simplicidad y flexibilidad hacen que sea una opción popular entre los desarrolladores, permitiendo una mejor organización del código y facilitando la gestión de relaciones entre objetos y tablas en la base de datos.

<a id="clases-persistentes"></a>
## Clases persistentes

En este capítulo, nos adentramos en la comprensión y aplicación de las clases persistentes en el contexto del mapeo objeto-relacional (ORM). Las clases persistentes son una parte fundamental del ORM, ya que representan los objetos que interactúan con la base de datos. Estas clases definen cómo se estructuran los datos y cómo se manipulan dentro del sistema.

Las clases persistentes deben ser diseñadas cuidadosamente para reflejar las entidades y relaciones de la base de datos. Cada propiedad de la clase corresponde a un campo en la tabla de la base de datos, mientras que los métodos definen las operaciones que pueden realizarse sobre estos objetos. Por ejemplo, si tenemos una entidad "Cliente", nuestra clase persistente podría incluir propiedades como `nombre`, `email` y `id`, así como métodos para actualizar o eliminar un cliente.

La implementación de clases persistentes en ORM facilita la manipulación de datos complejos, ya que permite trabajar con objetos en lugar de sentencias SQL. Esto no solo mejora la legibilidad del código, sino que también reduce el riesgo de errores tipográficos y aumenta la eficiencia al utilizar las capacidades de optimización internas del ORM.

Además, las clases persistentes permiten una mayor abstracción sobre los detalles de la base de datos. Esto significa que podemos cambiar el esquema de la base de datos sin necesidad de modificar el código fuente de nuestras clases persistentes, siempre y cuando sigamos un enfoque consistente en cómo se representan las entidades.

En el mundo real, trabajar con ORM implica no solo diseñar y implementar clases persistentes, sino también gestionar sesiones de conexión a la base de datos. Las sesiones son contenedores que mantienen el estado del sistema durante una operación de acceso a la base de datos. Es importante asegurarse de manejar adecuadamente las transacciones dentro de estas sesiones para mantener la integridad y consistencia de los datos.

La persistencia de objetos es un concepto clave en el mapeo objeto-relacional, y las clases persistentes son la implementación concreta de este concepto. Al diseñar y utilizar clases persistentes correctamente, podemos aprovechar al máximo las ventajas del ORM, como la simplificación del acceso a datos y la reducción de errores comunes.

En resumen, las clases persistentes son una herramienta poderosa en el mapeo objeto-relacional, que nos permiten trabajar con objetos en lugar de sentencias SQL. Su diseño cuidadoso y correcta implementación son fundamentales para aprovechar al máximo las capacidades del ORM y mantener la eficiencia y consistencia de nuestro sistema.

<a id="sesiones-estados-de-un-objeto"></a>
## Sesiones; estados de un objeto

En el mundo del desarrollo de software moderno, la utilización de herramientas ORM (Object-Relational Mapping) ha ganado popularidad debido a su capacidad para simplificar significativamente la interacción entre aplicaciones y bases de datos relacionales. Una sesión en un contexto ORM se refiere al estado actual de una entidad o colección de entidades que están siendo gestionadas por el framework ORM. Esta sesión es crucial porque permite realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) sobre los objetos de la aplicación sin necesidad de escribir directamente consultas SQL.

Cuando se inicia una sesión en un ORM, este establece una conexión con la base de datos y prepara el entorno para que las operaciones posteriores puedan ser realizadas. Durante la vida útil de la sesión, el ORM mantiene un registro de los cambios realizados en las entidades gestionadas. Esto es fundamental porque permite realizar transacciones atómicas, asegurando que todos los cambios se apliquen o ninguno si ocurre algún error.

La gestión de estados de objetos es otro aspecto crucial del uso de ORM. Cada objeto mapeado a una tabla de la base de datos tiene un estado asociado con él. Este estado puede ser uno de varios, como "nuevo", "modificado" o "eliminado". El ORM utiliza este estado para determinar cuándo y cómo se deben sincronizar los cambios en la base de datos.

Una vez que se han realizado las operaciones deseadas, es importante cerrar la sesión. Esto implica que el ORM envíe todos los cambios pendientes a la base de datos y libera los recursos asociados con la conexión. La finalización de una sesión asegura que todas las transacciones sean completadas correctamente y que no queden residuos en la memoria.

Además, durante la vida de una sesión, es común realizar consultas para recuperar información de la base de datos. El ORM facilita este proceso proporcionando métodos para ejecutar consultas y mapear los resultados a objetos de aplicación. Esta funcionalidad simplifica significativamente el acceso a los datos, permitiendo que los desarrolladores se centren en la lógica de negocio sin preocuparse por detalles técnicos.

La gestión de sesiones en ORM también implica la detección y manejo de excepciones. Si ocurre algún error durante las operaciones realizadas dentro de una sesión, el ORM debe ser capaz de revertir los cambios parciales y propagar la excepción para que pueda ser manejada adecuadamente por el código de la aplicación.

En resumen, las sesiones en un ORM son entidades vitales que gestionan el estado de los objetos mapeados a la base de datos. Su correcta utilización es fundamental para mantener la integridad de los datos y facilitar el desarrollo de aplicaciones eficientes y robustas. A través del manejo adecuado de sesiones, se pueden realizar operaciones CRUD de manera sencilla y segura, lo que permite a los desarrolladores centrarse en la implementación de la lógica de negocio sin preocuparse por detalles técnicos de acceso a datos.

<a id="carga-almacenamiento-y-modificacion-de-objetos"></a>
## Carga, almacenamiento y modificación de objetos

En el mundo de la programación orientada a objetos, el mapeo objeto-relacional (ORM) es una técnica que facilita la interacción entre aplicaciones basadas en objetos y bases de datos relacionales. Esta herramienta permite a los desarrolladores trabajar con objetos en su lenguaje de programación preferido mientras ORM se encarga del proceso de traducción automática entre estos objetos y las tablas y registros de la base de datos.

La carga de objetos desde la base de datos es un paso fundamental en el uso de ORM. Este proceso implica leer los datos almacenados en una tabla específica y convertirlos en instancias de clases definidas por el desarrollador. Por ejemplo, si tenemos una tabla llamada "Clientes" con campos como nombre, dirección y teléfono, ORM nos permite cargar estos datos en objetos de la clase Cliente.

Almacenar objetos en la base de datos es otro aspecto crucial del mapeo objeto-relacional. Cuando se crea o modifica un objeto en el código, ORM se encarga de actualizar la base de datos con los cambios correspondientes. Esto puede implicar insertar nuevos registros, modificar existentes o eliminar registros según las operaciones realizadas en los objetos.

La modificación de objetos es una extensión natural del almacenamiento. Al igual que al cargar objetos, cuando se realiza algún cambio en un objeto (como actualizar el nombre de un cliente), ORM se encarga de reflejar estos cambios en la base de datos. Esta capacidad permite a los desarrolladores trabajar directamente con objetos y no tener que preocuparse por las consultas SQL complejas necesarias para realizar estas operaciones.

El mapeo objeto-relacional también facilita el manejo de relaciones entre objetos. Por ejemplo, si un cliente tiene varios pedidos asociados, ORM puede gestionar automáticamente estos relacionamientos, permitiendo a los desarrolladores acceder fácilmente a todos los pedidos de un cliente simplemente consultando su objeto Cliente.

Además de la carga y almacenamiento de objetos, ORM también proporciona herramientas para realizar consultas complejas sobre la base de datos. A través de métodos y funciones específicas del ORM, se pueden ejecutar consultas que devuelven conjuntos de objetos en lugar de conjuntos de filas y columnas. Esto simplifica el trabajo con los datos y permite una programación más orientada a objetos.

La gestión de transacciones es otro aspecto importante del mapeo objeto-relacional. ORM permite agrupar varias operaciones en una sola transacción, asegurando que todas las modificaciones se realicen juntas o ninguna se aplique si ocurre un error. Esto ayuda a mantener la integridad de los datos y prevenir situaciones como el "parcial commit", donde solo parte de una operación se realiza correctamente.

En resumen, el mapeo objeto-relacional es una herramienta poderosa que facilita la interacción entre aplicaciones orientadas a objetos y bases de datos relacionales. A través del ORM, los desarrolladores pueden trabajar con objetos en su lenguaje preferido mientras ORM se encarga del proceso de traducción automática entre estos objetos y las tablas y registros de la base de datos. Esta técnica no solo simplifica el acceso y modificación de los datos, sino que también facilita el manejo de relaciones complejas y consultas avanzadas, permitiendo una programación más orientada a objetos y eficiente.

<a id="consultas-sql"></a>
## Consultas SQL

En el mundo de la programación orientada a objetos, el mapeo objeto-relacional (ORM) es una técnica que permite interactuar con bases de datos relacionales utilizando un lenguaje de programación orientado a objetos. Esta herramienta facilita la creación y gestión de consultas SQL complejas, reduciendo así el riesgo de errores humanos en la escritura directa de estas consultas.

La utilización de ORM no solo simplifica la interacción con las bases de datos, sino que también mejora la legibilidad del código. Al escribir consultas en un lenguaje orientado a objetos, los desarrolladores pueden aprovechar las ventajas de la programación orientada a objetos, como la encapsulación y el polimorfismo, lo que hace que el código sea más mantenible y escalable.

Una de las principales ventajas del ORM es su capacidad para gestionar automáticamente la conversión entre los tipos de datos de la base de datos y los tipos de datos del lenguaje de programación. Esto significa que los desarrolladores pueden trabajar con objetos en lugar de con filas y columnas, lo que facilita el trabajo con relaciones complejas y las consultas que implican múltiples tablas.

Además, ORM proporciona herramientas para realizar operaciones avanzadas como la paginación, la ordenación y el filtrado de resultados. Estas funcionalidades pueden ser implementadas en una sola línea de código, lo que hace que los programas sean más eficientes y fáciles de entender.

Sin embargo, es importante recordar que aunque ORM simplifica muchas tareas, no elimina completamente la necesidad de conocer SQL. Algunos aspectos complejos de las consultas pueden ser más fáciles de expresar directamente en SQL, especialmente cuando se requiere un alto nivel de rendimiento o optimización.

En resumen, el mapeo objeto-relacional es una herramienta poderosa y eficiente para interactuar con bases de datos relacionales desde lenguajes orientados a objetos. Aunque tiene sus limitaciones, su capacidad para simplificar la programación y mejorar la legibilidad del código lo hace un recurso valioso en cualquier proyecto que involucre el acceso a datos estructurados.

<a id="gestion-de-transacciones-1"></a>
## Gestión de transacciones

En el mundo del desarrollo de software, la gestión eficiente de transacciones es un aspecto crucial para mantener la integridad y coherencia de los datos. Las herramientas de mapeo objeto-relacional (ORM) ofrecen una forma conveniente y segura de gestionar estas transacciones, simplificando el código y reduciendo errores comunes.

Las transacciones en ORM se definen como bloques de código que contienen operaciones que deben ser ejecutadas juntas. Si todas las operaciones dentro del bloque son exitosas, la transacción se considera completada con éxito. En caso contrario, si ocurre un error, toda la transacción debe deshacerse para mantener la consistencia de los datos.

Para gestionar transacciones en ORM, es común utilizar métodos específicos proporcionados por las bibliotecas ORM que estás utilizando. Por ejemplo, en Entity Framework (una popular ORM para .NET), puedes usar el método `BeginTransaction` para iniciar una nueva transacción y luego llamar a `Commit` para finalizarla si todas las operaciones son correctas, o `Rollback` si ocurre un error.

Es importante recordar que la gestión de transacciones debe ser manejada con cuidado. Cualquier excepción no controlada dentro del bloque de transacción puede llevar a un desastre, ya que el sistema podría quedar en un estado inconsistente. Por lo tanto, es recomendable utilizar bloques `try-catch` para capturar y manejar posibles errores.

Además de la gestión manual de transacciones, muchas ORM proporcionan funcionalidades adicionales como el soporte para transacciones distribuidas y la capacidad de configurar los niveles de aislamiento de las transacciones. El nivel de aislamiento determina cómo se ven afectados los datos por otras transacciones mientras una transacción está en curso.

La gestión eficiente de transacciones no solo mejora la confiabilidad del sistema, sino que también puede mejorar el rendimiento al permitir operaciones paralelas y reduciendo el tiempo de bloqueo. Por ejemplo, si tienes varias transacciones que pueden ejecutarse simultáneamente sin interferirse entre sí, puedes utilizar transacciones aisladas para optimizar el uso de los recursos.

En resumen, la gestión de transacciones es una habilidad fundamental en el desarrollo de software utilizando ORM. A través del manejo adecuado de las transacciones, puedes asegurar que tus aplicaciones sean seguras, consistentes y eficientes. Comprender cómo utilizar las funcionalidades proporcionadas por las ORM para gestionar transacciones te permitirá escribir código más robusto y menos propenso a errores.

<a id="desarrollo-de-programas-que-utilizan-bases-de-datos-a-traves-de-herramientas-orm"></a>
## Desarrollo de programas que utilizan bases de datos a través de herramientas ORM

Continuando con nuestra exploración del mundo del acceso a datos mediante herramientas de mapeo objeto-relacional (ORM), nos encontramos en la última subunidad dedicada al desarrollo práctico de aplicaciones que utilizan bases de datos a través de estas herramientas. 

En esta sección, profundizaremos en cómo implementar y utilizar ORM para interactuar con las bases de datos, enfocándonos en los aspectos técnicos y prácticos necesarios para crear soluciones eficientes y escalables. Comenzaremos por revisar la estructura básica de un proyecto que utiliza ORM, identificando los componentes clave como clases persistentes, sesiones y consultas SQL.

A continuación, nos adentraremos en el proceso de mapeo basado en anotaciones, una técnica popular para definir cómo se relacionan las clases del modelo de objetos con las tablas de la base de datos. A través de este método, podemos simplificar significativamente el código y mejorar su legibilidad, ya que los detalles de mapeo se especifican directamente dentro de las clases.

Una vez familiarizados con el concepto básico de mapeo basado en anotaciones, pasaremos a explorar la carga, almacenamiento y modificación de objetos. Aprenderemos cómo crear nuevas instancias de objetos, persistirlos en la base de datos y recuperarlos cuando sea necesario, así como cómo gestionar las relaciones entre diferentes entidades.

Además, dedicaremos tiempo a la realización de consultas SQL mediante ORM. Aunque ORM nos permite interactuar con la base de datos utilizando un lenguaje orientado a objetos, es útil conocer cómo realizar consultas directamente en SQL para obtener información específica o realizar operaciones complejas que no pueden ser expresadas fácilmente con el lenguaje del ORM.

Finalmente, terminaremos nuestra exploración con una sección sobre gestión de transacciones. Aprenderemos cómo manejar las transacciones en un entorno de base de datos utilizando ORM, asegurándonos de que nuestras operaciones sean consistentes y seguras frente a posibles errores o problemas de concurrencia.

A lo largo de esta subunidad, hemos cubierto los aspectos fundamentales del desarrollo de aplicaciones que utilizan bases de datos a través de herramientas ORM. Desde la estructura básica del proyecto hasta la realización de consultas SQL y la gestión de transacciones, hemos proporcionado una visión completa y práctica de cómo implementar estas técnicas en un entorno real.

Esta experiencia te permitirá desarrollar habilidades valiosas para trabajar con bases de datos utilizando ORM, lo que facilitará el desarrollo de aplicaciones eficientes y escalables. Recuerda que la práctica es clave para dominar estos conceptos, así que asegúrate de experimentar con diferentes escenarios y problemas reales para fortalecer tus conocimientos.

En resumen, hemos explorado cómo utilizar herramientas de mapeo objeto-relacional (ORM) para interactuar con bases de datos en aplicaciones. A través del desarrollo práctico de proyectos que utilizan ORM, hemos aprendido a definir clases persistentes, realizar consultas SQL y gestionar transacciones, lo que nos ha proporcionado una sólida base para trabajar con bases de datos en un entorno orientado a objetos.


<a id="bases-de-datos-objeto-relacionales-y-orientadas-a-objetos"></a>
# Bases de datos objeto relacionales y orientadas a objetos

<a id="gestores-de-bases-de-datos-objeto-relacionales"></a>
## Gestores de bases de datos objeto relacionales

En este capítulo, nos adentramos en la comprensión de los gestores de bases de datos objeto-relacionales (ODBMs), una evolución importante dentro del campo de las bases de datos. Los ODBMs son sistemas que permiten almacenar y gestionar objetos de programación orientados a objetos directamente como elementos de la base de datos, lo que facilita su uso en aplicaciones empresariales complejas.

Los gestores de bases de datos objeto-relacionales ofrecen una forma más intuitiva y natural de trabajar con los datos, ya que permiten representar los objetos de la aplicación como entidades dentro de la base de datos. Esto a diferencia de las bases de datos relacionales tradicionales, donde los datos se almacenan en tablas y relaciones entre ellas.

Un gestor de ODBM puede manejar tanto objetos simples como complejos, incluyendo relaciones entre ellos, lo que facilita el modelado de aplicaciones empresariales. Además, estos sistemas suelen proporcionar funcionalidades avanzadas como la persistencia automática de los cambios en los objetos, la gestión de transacciones y la capacidad para realizar consultas complejas sobre los datos.

La elección del gestor de ODBM adecuado depende de varios factores, incluyendo el lenguaje de programación utilizado, las necesidades específicas de la aplicación y la infraestructura disponible. Algunos ejemplos populares de ODBMs son Hibernate para Java, Entity Framework para .NET y Doctrine para PHP.

En este capítulo, exploraremos en profundidad los conceptos básicos de los gestores de bases de datos objeto-relacionales, desde su funcionamiento interno hasta sus ventajas y desventajas. Aprenderemos cómo configurar un ODBM, cómo mapear objetos a tablas y cómo realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) sobre estos objetos en la base de datos.

Además, discutiremos las mejores prácticas para el uso de los gestores de ODBMs, como la gestión adecuada de transacciones, la optimización de consultas y la seguridad de los datos. También exploraremos cómo integrar los ODBMs con otras tecnologías, como las bases de datos relacionales, para aprovechar las ventajas de ambos en una misma aplicación.

Al finalizar este capítulo, deberás tener una comprensión sólida de los gestores de bases de datos objeto-relacionales y cómo pueden mejorar significativamente la eficiencia y escalabilidad de tus aplicaciones empresariales.

<a id="gestion-de-objetos-con-sql-ansi-sql"></a>
## Gestión de objetos con SQL; ANSI SQL

En este capítulo, nos adentramos en la gestión de objetos con SQL, una técnica fundamental para interactuar con bases de datos orientadas a objetos (ODBMS) utilizando el estándar ANSI SQL. A diferencia de las bases de datos relacionales tradicionales, que almacenan y gestionan los datos en tablas, las ODBMS representan los datos como objetos, lo que permite una mayor flexibilidad y coherencia.

La gestión de objetos con SQL implica la creación, modificación y eliminación de objetos dentro de la base de datos. A través del lenguaje SQL, podemos definir clases de objetos, instanciar objetos, modificar sus atributos y eliminarlos cuando ya no sean necesarios. Este proceso se realiza a través de sentencias SQL específicas que interactúan con el motor de la base de datos.

Una de las ventajas principales de gestionar objetos con SQL es la capacidad de realizar consultas complejas sobre los datos almacenados en forma de objetos. A diferencia de las bases de datos relacionales, donde las consultas se realizan sobre tablas y columnas, en las ODBMS podemos realizar consultas que recorren relaciones entre objetos, lo que permite obtener información más rica y contextualizada.

Además, la gestión de objetos con SQL facilita el mantenimiento y actualización del esquema de la base de datos. Al definir clases de objetos y sus relaciones en el lenguaje SQL, podemos modificar fácilmente el modelo de datos sin afectar los datos existentes, siempre que sigamos las reglas de integridad referencial establecidas.

Es importante destacar que, aunque ANSI SQL es un estándar universal para la gestión de bases de datos relacionales, su uso en ODBMS puede presentar algunas limitaciones. Por ejemplo, algunos operadores y funciones específicas de SQL pueden no estar disponibles o podrían funcionar de manera diferente en las ODBMS. Por lo tanto, es crucial conocer las características y restricciones del sistema específico que estemos utilizando.

En este capítulo, exploraremos cómo definir clases de objetos, instanciar objetos, modificar sus atributos y eliminarlos utilizando sentencias SQL estándar. También aprenderemos a realizar consultas complejas sobre los datos almacenados en forma de objetos y cómo gestionar el esquema de la base de datos de manera eficiente.

A lo largo del capítulo, trabajaremos con ejemplos prácticos que ilustran cómo aplicar estos conceptos en situaciones reales. A través de estas ejercicios, desarrollaremos una comprensión profunda de cómo gestionar objetos con SQL y cómo aprovechar al máximo las capacidades de las bases de datos orientadas a objetos para almacenar y recuperar información de manera eficiente y coherente.

Al final del capítulo, reflexionaremos sobre los desafíos y limitaciones asociados con la gestión de objetos con SQL en ODBMS. Aprenderemos cómo superar estas dificultades y cómo utilizar las herramientas disponibles para optimizar el rendimiento y la seguridad de nuestras aplicaciones que interactúan con bases de datos orientadas a objetos.

En resumen, gestionar objetos con SQL es una habilidad crucial para trabajar con bases de datos orientadas a objetos. A través del lenguaje estándar ANSI SQL, podemos definir clases de objetos, instanciar objetos, modificar sus atributos y eliminarlos de manera eficiente. Este proceso nos permite realizar consultas complejas sobre los datos almacenados en forma de objetos y gestionar el esquema de la base de datos de manera eficiente. A lo largo del capítulo, trabajaremos con ejemplos prácticos que ilustran cómo aplicar estos conceptos en situaciones reales y reflexionaremos sobre los desafíos y limitaciones asociados con esta técnica.

<a id="acceso-a-las-funciones-del-gestor-de-base-de-datos-objeto-relacional"></a>
## Acceso a las funciones del gestor de base de datos objeto-relacional

En esta subunidad del curso, nos adentramos en la exploración de cómo acceder a las funciones del gestor de base de datos objeto-relacional (ODB). El acceso a estas funciones es fundamental para interactuar con los objetos persistidos en una base de datos orientada a objetos. Comenzamos por entender el concepto básico de mapeo objeto-relacional, que permite representar los objetos de la aplicación como entidades y relaciones en una base de datos relacional.

A medida que avanzamos, nos familiarizamos con las características específicas de las herramientas ORM disponibles, aprendiendo cómo instalarlas y configurarlas para nuestro proyecto. La estructura de un fichero de mapeo es crucial, ya que define cómo se relacionan los objetos de la aplicación con las tablas y columnas de la base de datos.

Además, exploramos el uso de anotaciones para simplificar el proceso de mapeo, lo que facilita la gestión del código. Las clases persistentes son el núcleo de nuestra aplicación en este contexto, representando los objetos que deseamos almacenar y recuperar desde la base de datos. La gestión de sesiones es otro aspecto importante, ya que permite controlar el ciclo de vida de los objetos persistidos.

La carga, almacenamiento y modificación de objetos son operaciones fundamentales en cualquier sistema ORM. Aprenderemos cómo realizar estas acciones eficientemente, utilizando métodos específicos proporcionados por la herramienta ORM. Consultas SQL también desempeñan un papel crucial, permitiendo realizar búsquedas complejas sobre los datos almacenados.

Finalmente, el manejo de transacciones es una cuestión crítica en cualquier sistema que interactúe con bases de datos. Aprenderemos cómo gestionar las transacciones para garantizar la integridad y consistencia de los datos. Desarrollaremos programas que utilizan bases de datos a través de herramientas ORM, aplicando todo lo aprendido hasta ahora.

A lo largo de esta subunidad, hemos cubierto desde el concepto básico del mapeo objeto-relacional hasta las operaciones avanzadas en un sistema ORM. Cada paso ha sido diseñado para proporcionar una comprensión profunda y práctica del acceso a las funciones del gestor de base de datos objeto-relacional, preparándonos para aplicar estos conocimientos en proyectos futuros que involucren el uso de bases de datos orientadas a objetos.

<a id="gestores-de-bases-de-datos-orientadas-a-objetos"></a>
## Gestores de bases de datos orientadas a objetos

En este capítulo, nos adentramos en la comprensión y gestión de las bases de datos orientadas a objetos (ODBMs), una evolución importante dentro del campo de los sistemas de gestión de bases de datos. A diferencia de las bases de datos relacionales tradicionales que utilizan tablas para almacenar datos, las ODBMs permiten un enfoque más natural y intuitivo al trabajar con objetos orientados a la programación.

Las ODBMs son sistemas que proporcionan una forma directa de persistir los objetos del lenguaje de programación en una base de datos. Esta abstracción facilita el trabajo con objetos, ya que permite interactuar con ellos como si estuvieran almacenados en memoria, mientras que la ODBM se encarga de gestionar su persistencia en el disco.

Un gestor de bases de datos orientadas a objetos (ODB) es un software que proporciona una interfaz para crear, leer, actualizar y eliminar objetos persistentes. Este gestor oculta los detalles técnicos de cómo estos objetos son almacenados físicamente en la base de datos, permitiendo al programador interactuar con ellos utilizando métodos y atributos del lenguaje de programación.

La principal ventaja de las ODBMs es que facilitan el trabajo con objetos complejos y relaciones entre ellos. Al trabajar directamente con objetos, los desarrolladores pueden expresar la lógica de su aplicación en términos naturales, lo que resulta en código más legible y fácil de mantener.

Sin embargo, también existen desafíos asociados a las ODBMs. La persistencia de objetos puede ser más compleja que la de tablas relacionales, especialmente cuando se consideran relaciones bidireccionales o herencias múltiples. Además, el rendimiento puede verse afectado en comparación con las bases de datos relacionales optimizadas para consultas y transacciones intensivas.

En este capítulo, exploraremos los fundamentos de las ODBMs, incluyendo cómo funcionan los gestores de estas bases de datos y cuáles son sus principales características. Aprenderemos también sobre la sintaxis específica utilizada por cada gestor de ODBM para interactuar con objetos persistentes, así como técnicas avanzadas para optimizar el rendimiento y gestionar las relaciones entre objetos.

Además, discutiremos cómo migrar datos existentes desde bases de datos relacionales a ODBMs, lo que puede ser un proceso crucial cuando se decide adoptar este tipo de sistema. También exploraremos la seguridad en ODBMs, incluyendo cómo proteger los datos persistentes y gestionar los permisos de acceso.

Finalmente, ilustraremos con ejemplos prácticos cómo implementar y utilizar gestores de bases de datos orientadas a objetos en proyectos reales, demostrando cómo estas herramientas pueden mejorar significativamente la eficiencia y escalabilidad de las aplicaciones basadas en objetos.

<a id="gestion-de-la-persistencia-de-objetos"></a>
## Gestión de la persistencia de objetos

La gestión de la persistencia de objetos es un aspecto crucial en el desarrollo de aplicaciones que utilizan bases de datos objeto-relacional (OR) o orientadas a objetos. Este proceso implica cómo se almacenan y recuperan los objetos en una base de datos, asegurando que la información esté disponible para su uso en el sistema.

En un entorno OR, cada objeto es mapeado a una entidad en la base de datos, lo que facilita la manipulación de datos estructurados. La persistencia de objetos se realiza mediante operaciones CRUD (Crear, Leer, Actualizar y Borrar), que corresponden directamente a las operaciones de base de datos.

La gestión de transacciones es otro elemento fundamental en la persistencia de objetos. Las transacciones son conjuntos de operaciones que deben ejecutarse como una unidad para mantener la integridad de los datos. En un sistema OR, estas transacciones pueden implicar el acceso a múltiples entidades y relaciones, lo que requiere mecanismos robustos para garantizar que todas las operaciones se realicen correctamente o no se produzca ningún cambio.

Además de la persistencia de objetos en una base de datos OR, también es importante considerar la persistencia de los estados de un objeto a lo largo del tiempo. Esto implica cómo se manejan los cambios en el estado de los objetos y cómo se recuperan estos estados cuando se necesita acceder a ellos nuevamente.

La gestión de la persistencia de objetos también incluye la serialización y deserialización de objetos, que es el proceso de convertir un objeto en una forma que pueda ser almacenada o transmitida y luego reconstruirlo en su estado original. Esta capacidad es esencial para la comunicación entre diferentes partes del sistema y para el almacenamiento de objetos en formatos no relacionales.

En un entorno OR, también se pueden utilizar herramientas ORM (Object-Relational Mapping) para simplificar la gestión de la persistencia de objetos. Estas herramientas proporcionan una capa de abstracción que permite a los desarrolladores trabajar con objetos y no tener que preocuparse por las operaciones de base de datos subyacentes.

La gestión de la persistencia de objetos es un aspecto complejo pero fundamental en el desarrollo de aplicaciones OR. A través del uso de transacciones, serialización, deserialización y herramientas ORM, se puede asegurar que los datos estén disponibles y consistentes en todo momento, lo que es crucial para mantener la confiabilidad y la eficiencia del sistema.

En resumen, la gestión de la persistencia de objetos es un proceso integral en el desarrollo de aplicaciones OR. Involucra la manipulación de datos estructurados, la gestión de transacciones, la persistencia de estados de objetos y la utilización de herramientas ORM para simplificar el proceso. A través de estos mecanismos, se puede garantizar que los datos estén disponibles y consistentes en todo momento, lo que es crucial para mantener la confiabilidad y la eficiencia del sistema.

<a id="el-interfaz-de-programacion-de-aplicaciones-de-la-base-de-datos-orientada-a-objetos"></a>
## El interfaz de programación de aplicaciones de la base de datos orientada a objetos

En la subunidad "El interfaz de programación de aplicaciones de la base de datos orientada a objetos", nos adentramos en el aspecto práctico de cómo interactuar con las bases de datos objeto-relacionales (OR) desde un lenguaje de programación. Este interfaz, también conocido como API o Interfaz de Programación de Aplicaciones, es una herramienta fundamental que permite a los desarrolladores acceder y manipular la información almacenada en estas bases de datos.

El primer paso para interactuar con una base de datos OR es establecer una conexión. Esta conexión se realiza mediante un objeto específico proporcionado por el gestor de la base de datos OR, que actúa como puente entre el código del programa y la base de datos. Este proceso implica especificar los detalles de la conexión, como el nombre del servidor, el nombre de la base de datos, el usuario y la contraseña.

Una vez establecida la conexión, se pueden ejecutar consultas SQL para recuperar o modificar la información almacenada en la base de datos. Sin embargo, las bases de datos OR ofrecen una alternativa más orientada a objetos que permite acceder directamente a los objetos persistidos en la base de datos, sin necesidad de escribir consultas SQL explícitas. Esta característica es especialmente útil para desarrolladores que prefieren trabajar con objetos y no con tablas y registros.

El interfaz de programación de aplicaciones de las bases de datos OR también proporciona métodos para crear, modificar y eliminar objetos en la base de datos. Estos métodos son directamente correspondientes a los operadores CRUD (Crear, Leer, Actualizar, Eliminar) que se utilizan comúnmente en el acceso a bases de datos relacionales.

Además del acceso a objetos individuales, las APIs de las bases de datos OR también permiten realizar consultas complejas y obtener resultados en forma de colecciones de objetos. Esta funcionalidad es especialmente útil para aplicaciones empresariales que requieren procesar grandes volúmenes de datos y generar informes dinámicos.

Es importante destacar que, aunque el interfaz de programación de aplicaciones de las bases de datos OR facilita la manipulación de objetos en lugar de tablas, aún es necesario tener conocimientos básicos de SQL para realizar consultas complejas o optimizar el rendimiento de las operaciones de acceso a la base de datos.

En resumen, el interfaz de programación de aplicaciones de las bases de datos orientadas a objetos proporciona una forma poderosa y eficiente de interactuar con estas bases de datos desde un lenguaje de programación. A través de este interfaz, los desarrolladores pueden acceder, manipular y gestionar la información almacenada en las bases de datos OR de manera intuitiva y orientada a objetos, lo que facilita el desarrollo de aplicaciones empresariales complejas y escalables.

<a id="gestion-de-transacciones-2"></a>
## Gestión de transacciones

En el mundo digital actual, las bases de datos objeto-relacionales (OR) y orientadas a objetos (OO) han ganado una importancia cada vez mayor debido a su capacidad para manejar complejas relaciones entre los datos. Esta subunidad se centra específicamente en la gestión de transacciones dentro de estos sistemas, un aspecto crucial para garantizar la integridad y consistencia de los datos.

La gestión de transacciones en bases de datos OR y OO implica el control de las operaciones que modifican el estado del sistema. Cada transacción se considera una unidad de trabajo que puede ser ejecutada como una sola unidad, asegurando que todos sus componentes sean procesados correctamente o ninguno lo sea. Este proceso es fundamental para evitar inconsistencias y errores en los datos.

Para gestionar las transacciones, los sistemas OR y OO utilizan un conjunto de mecanismos que incluyen la definición de transacciones, su ejecución, confirmación (commit), anulación (rollback) y aislamiento. La definición de una transacción implica especificar qué operaciones deben realizarse en el sistema, mientras que su ejecución es el proceso de procesar estas operaciones en orden.

La confirmación de una transacción se realiza cuando todas las operaciones dentro de ella han sido exitosamente procesadas y los cambios reflejados en la base de datos. En caso de un error durante la ejecución, la anulación (rollback) permite revertir todos los cambios realizados por la transacción, restaurando el estado del sistema a su punto inicial.

El aislamiento es otro concepto crucial en la gestión de transacciones, que se refiere a la capacidad de una transacción para operar sin interferencia con otras transacciones simultáneas. Esto garantiza que los cambios realizados por una transacción no sean visibles hasta que ésta ha sido confirmada, preveniendo así problemas como las lecturas sucias o las perdidas de actualizaciones.

Además de estos mecanismos básicos, los sistemas OR y OO ofrecen herramientas avanzadas para la gestión de transacciones. Por ejemplo, la capacidad de manejar subtransacciones permite dividir una gran operación en varias partes más pequeñas, facilitando su control y mejora el rendimiento del sistema.

La gestión eficiente de las transacciones es esencial no solo para mantener la integridad de los datos, sino también para mejorar el rendimiento general del sistema. Al optimizar las transacciones, se pueden reducir tiempos de respuesta y aumentar la capacidad de procesamiento del sistema.

En conclusión, la gestión de transacciones en bases de datos objeto-relacionales y orientadas a objetos es un tema fundamental que requiere una comprensión profunda para desarrollar sistemas robustos y confiables. A través de la definición, ejecución, confirmación, anulación y aislamiento de las transacciones, se puede asegurar la consistencia y integridad de los datos, lo cual es crucial en un mundo cada vez más digitalizado donde la precisión y la confiabilidad son imperativas.

<a id="desarrollo-de-programas-que-gestionan-objetos-en-bases-de-datos"></a>
## Desarrollo de programas que gestionan objetos en bases de datos

En este capítulo, nos adentramos en la gestión de objetos en bases de datos objeto-relacionales (ORDBMS) y orientadas a objetos (ODBMS). Comenzamos por entender cómo se manejan los objetos dentro de estas bases de datos, explorando el concepto de persistencia del objeto y cómo se almacenan y recuperan los datos.

A medida que avanzamos, nos familiarizamos con las herramientas y métodos específicos para interactuar con ORDBMS y ODBMS. Aprenderemos a crear clases persistentes, mapear atributos y métodos de objetos a tablas y columnas en la base de datos, y cómo gestionar transacciones para mantener la integridad de los datos.

Además, exploramos el uso de sesiones y estados de un objeto, así como técnicas avanzadas como la carga perezosa y el almacenamiento de objetos complejos. Aprenderemos a realizar consultas SQL en ORDBMS y cómo utilizar ORM para simplificar estas operaciones.

El capítulo culmina con ejemplos prácticos de desarrollo de programas que utilizan bases de datos objeto-relacionales y orientadas a objetos, demostrando cómo aplicar los conocimientos adquiridos en situaciones reales. A lo largo del camino, nos enfocamos en la importancia de la seguridad y el manejo adecuado de excepciones para garantizar la robustez y confiabilidad de nuestras aplicaciones.

A medida que avanzamos en este tema, es crucial entender cómo las bases de datos objeto-relacionales y orientadas a objetos ofrecen una forma más natural y eficiente de trabajar con datos complejos, permitiendo un acceso directo y intuitivo a los mismos desde el código. Este conocimiento es fundamental para desarrollar aplicaciones modernas que requieren manejo sofisticado de información estructurada y relacionada.


<a id="bases-de-datos-documentales"></a>
# Bases de datos documentales

<a id="bases-de-datos-documentales-nativas"></a>
## Bases de datos documentales nativas

En el vasto mundo de la programación y la gestión de datos, las bases de datos documentales nativas representan una innovadora forma de almacenar y recuperar información. Estas bases de datos son especialmente útiles para aplicaciones que requieren un alto nivel de flexibilidad y escalabilidad en su estructura de datos.

La naturaleza documental de estas bases de datos significa que cada registro se almacena como un documento completo, generalmente en formato JSON o BSON, lo que permite una representación natural y detallada de los datos. Esta característica es particularmente ventajosa cuando se trabaja con información compleja y heterogénea, ya que no requiere la definición previa de tablas y relaciones como ocurre con las bases de datos relacionales.

Las bases de datos documentales nativas ofrecen una serie de ventajas significativas. Primero, su estructura flexible permite un diseño más intuitivo y adaptable a los cambios en los requisitos del negocio. Segundo, su capacidad para almacenar y recuperar información de manera eficiente es superior a las bases de datos relacionales tradicionales, especialmente cuando se trata de grandes volúmenes de datos complejos.

Para interactuar con estas bases de datos, se utilizan lenguajes específicos como MongoDB Query Language (MQL) o el estándar JSON Query Language. Estos lenguajes permiten realizar consultas y operaciones avanzadas sobre los documentos almacenados, facilitando la manipulación y análisis de los datos.

La gestión de transacciones en las bases de datos documentales nativas es otro aspecto importante a considerar. A diferencia de las bases de datos relacionales, que utilizan un modelo ACID (Atomicidad, Coherencia, Isolación, Durabilidad), estas bases de datos suelen implementar modelos de transacción más simples pero eficientes, adaptados a su naturaleza documental.

La seguridad es otro factor crucial en el uso de bases de datos documentales nativas. Estas bases de datos ofrecen mecanismos avanzados para controlar el acceso y la modificación de los documentos, lo que es fundamental en aplicaciones empresariales donde la confidencialidad y la integridad de los datos son prioridades.

En conclusión, las bases de datos documentales nativas representan una herramienta poderosa y flexible para el almacenamiento y gestión de información compleja. Su naturaleza documental permite un diseño más intuitivo y adaptable a los cambios en los requisitos del negocio, mientras que su eficiencia y seguridad hacen de ellas una opción ideal para aplicaciones empresariales modernas.

### Lenguajes de documentos

```markdown
XML -> JSON
HTML - Interfaces
MD
TXT
DOC (MS) - DOCX DOC+XML - ODT OpenDocumenT
Binario
CSV - tablas con filas y columnas
PDF - PostScriptv2.0 - Adobe

Formato propio?
```

### MongoDB

```markdown
Concepto de base de datos
MongoDB llama a las agrupaciones de datos: "colecciones"

Una colección tiene documentos

Los documentos son JSON

Tenemos todo lo que tiene un json

_id con hash de identificacion
```

### crear base de datos

```javascript
use empresadam;
```

### crear coleccion

```javascript
db.createCollection("clientes");
```

### insertar un cliente

```javascript
db.clientes.insertOne({
    nombre:"Jose Vicente",
    apellidos:"Carratala",
    telefono:"+34 620891718",
    email:"info@josevicentecarratala.com"
})
```

### inserto objeto complejo

```javascript
db.clientes.insertOne({
    nombre:"Juan",
    apellidos:"Garcia",
    telefono:"+34 5325345",
    email:"info@juan.com",
    direcciones:[
        "direccion 1",
        "direccion 2"
    ]
})
```

### inserto muchos

```javascript
db.clientes.insertMany(
    [
        {
            nombre:"Jorge",
            apellidos:"Garcia",
            telefono:"+34 4353254325",
            email:"info@juan.com"
        },
        {
            nombre:"Jose",
            apellidos:"Lopez",
            telefono:"+34 3425325",
            email:"info@jose.com"
        },
        {
            nombre:"Julia",
            apellidos:"Martinez",
            telefono:"+34 234535245",
            email:"info@julia.com"
        }
    ]
)
```

### seleccionamos clientes

```javascript
db.clientes.find()
```

### solo el primer elemento

```javascript
db.clientes.findOne()
```

### where

```javascript
db.clientes.find({email:'info@juan.com'})
```

### actualizar uno

```javascript
db.clientes.updateOne(
    {nombre:'Jose Vicente'},
    {
        $set:
        {email:"info@jocarsa.com"}
    }
)
```

### actualiza muchos

```javascript
db.clientes.updateMany(
    {email:'info@juan.com'},
    {
        $set:
        {telefono:"11111111"}
    }
)
```

### eliminar uno

```javascript
db.clientes.deleteOne(
    {nombre:'Jose Vicente'}
)
```

### delete many

```javascript
db.clientes.deleteMany(
    {email:'info@juan.com'}
)
```

### Que tiene mongodb

```markdown
Esta basado en json para guardar documentos
Tiene un lenguaje de consultas
El lenguaje es Javascript
Sobre ese lenguaje hay una serie de objetos y métodos para ejecutar las consultas

Debe haber
1.-Un formato para guardar datos
2.-Un lenguaje para realizar consultas
```

<a id="establecimiento-y-cierre-de-conexiones"></a>
## Establecimiento y cierre de conexiones

En el vasto mundo de la programación, las bases de datos documentales representan una forma innovadora de almacenar y gestionar información. Estas bases de datos, que incluyen MongoDB, CouchDB o Firebase, se caracterizan por su estructura flexible y su capacidad para manejar datos complejos en formato JSON.

El primer paso en el uso de bases de datos documentales es establecer una conexión con ellas. Este proceso implica la configuración adecuada del entorno de desarrollo y la selección del protocolo de comunicación apropiado. En MongoDB, por ejemplo, se utiliza el protocolo TCP/IP para establecer conexiones entre el cliente y el servidor.

La conexión a una base de datos documental es un objeto que permite realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) sobre los datos almacenados. Este objeto suele proporcionar métodos específicos para cada tipo de operación, lo que facilita la manipulación de los datos de manera segura y eficiente.

Es importante destacar que el establecimiento de una conexión a una base de datos documental implica la autenticación del usuario. Esto asegura que solo aquellos con permisos adecuados puedan acceder y modificar los datos almacenados. En MongoDB, por ejemplo, se utiliza un sistema de roles y privilegios para controlar el acceso a las colecciones y documentos.

Una vez establecida la conexión, es necesario cerrarla cuando ya no sea necesaria. Esto libera los recursos utilizados durante la sesión y asegura que los cambios realizados en la base de datos sean guardados correctamente. En MongoDB, por ejemplo, se utiliza el método `close()` para cerrar una conexión.

La gestión adecuada de las conexiones a bases de datos documentales es crucial para mantener el rendimiento y la seguridad del sistema. Es recomendable utilizar un pool de conexiones para evitar el agotamiento de recursos y optimizar el acceso a los datos.

En resumen, establecer y cerrar conexiones con bases de datos documentales es una tarea fundamental en el desarrollo de aplicaciones que utilizan estas tecnologías. A través del uso adecuado de objetos de conexión y métodos específicos para cada operación, se puede realizar un manejo seguro y eficiente de los datos almacenados.

La comprensión de estos conceptos es esencial para cualquier desarrollador que quiera trabajar con bases de datos documentales en su proyecto. Al dominar la gestión de conexiones, se abre el camino a una mayor flexibilidad y escalabilidad en la creación de aplicaciones informáticas.

### Instalacion de modelo

```markdown
ollama pull llava

ollama pull bakllava

ollama run llava "what is in this image?" -i gato.jpg
```

### detectar imagen

```python
import base64, requests

with open("gato.jpg","rb") as f:
    img = base64.b64encode(f.read()).decode()

r = requests.post(
    "http://localhost:11434/api/generate",
    json={
        "model":"llava",
        "prompt":"what is in this image?",
        "images":[img],
        "stream": False
    }
)

print(r.json()["response"])
```

### perro

```python
import base64, requests

with open("perro.jpg","rb") as f:
    img = base64.b64encode(f.read()).decode()

r = requests.post(
    "http://localhost:11434/api/generate",
    json={
        "model":"llava",
        "prompt":"what is in this image?",
        "images":[img],
        "stream": False
    }
)

print(r.json()["response"])
```

<a id="colecciones-y-documentos"></a>
## Colecciones y documentos

En el mundo digital actual, las bases de datos documentales han ganado un papel cada vez más relevante debido a su capacidad para almacenar y gestionar información compleja y heterogénea. En esta subunidad didáctica, nos adentramos en los fundamentos del acceso a datos mediante bases de datos documentales, centrándonos específicamente en las colecciones y documentos.

Las colecciones son el contenedor principal en una base de datos documental, similar a cómo las tablas funcionan en las bases de datos relacionales. Cada colección puede contener múltiples documentos, que son los elementos individuales de la colección. Los documentos pueden tener estructuras diferentes entre sí, lo que les da la flexibilidad necesaria para almacenar una variedad de tipos de información.

La relación entre colecciones y documentos es fundamental en el diseño de bases de datos documentales. Cada documento puede estar relacionado con uno o varios documentos en otras colecciones a través de claves de referencia, creando así una red compleja de relaciones que permite la consulta y análisis de los datos de manera eficiente.

La gestión de las colecciones y documentos requiere un enfoque diferente al utilizado en bases de datos relacionales. En lugar de definir esquemas rigurosos para los datos, las bases de datos documentales permiten una mayor flexibilidad en la estructura de los documentos. Esto significa que los mismos campos pueden existir o no en diferentes documentos dentro de la misma colección, lo que facilita el almacenamiento y consulta de información heterogénea.

Además, las colecciones y documentos son unidades fundamentales para realizar consultas complejas en bases de datos documentales. A través del uso de lenguajes de consulta específicos como MongoDB Query Language (MQL), es posible realizar búsquedas precisas y eficientes dentro de las colecciones y documentos. Las capacidades de búsqueda avanzada, incluyendo la capacidad de realizar consultas por campos anidados o por expresiones regulares, hacen que las bases de datos documentales sean una herramienta poderosa para el análisis de grandes volúmenes de información.

La gestión de las colecciones y documentos también implica consideraciones sobre la consistencia y la integridad de los datos. En las bases de datos documentales, es común utilizar técnicas como transacciones y validación de datos para garantizar que los documentos dentro de una misma colección estén en un estado coherente. Esto es crucial cuando se realizan operaciones complejas que involucran múltiples documentos o colecciones.

La importancia de las colecciones y documentos no se limita solo a la gestión de información, sino también a la escalabilidad y el rendimiento de las bases de datos documentales. Al permitir una estructura flexible y dinámica, estas bases de datos pueden adaptarse mejor a los cambios en los patrones de uso y en la cantidad de datos almacenados, lo que les hace ideales para aplicaciones con alto volumen de tráfico o requerimientos de escalabilidad.

En conclusión, las colecciones y documentos son elementos esenciales en el acceso a datos mediante bases de datos documentales. Su diseño flexible y su capacidad para representar información compleja hacen que sean una herramienta poderosa y versátil para el almacenamiento y análisis de grandes volúmenes de datos. A través del estudio de estas estructuras, los desarrolladores pueden adquirir las habilidades necesarias para trabajar eficazmente con bases de datos documentales en sus proyectos informáticos.

<a id="creacion-y-borrado-de-colecciones"></a>
## Creación y borrado de colecciones

En el vasto universo de la programación y la gestión de datos, una colección es un concepto fundamental que desempeña un papel crucial. Una colección puede ser entendida como un contenedor que agrupa varios elementos relacionados entre sí, facilitando su acceso, manipulación y almacenamiento. En el contexto específico de las bases de datos documentales, la creación y borrado de colecciones son operaciones esenciales que permiten estructurar y organizar los datos de manera eficiente.

La creación de una colección en una base de datos documental implica la definición de un espacio donde se almacenarán documentos. Cada documento puede tener una estructura diferente, pero todos comparten el mismo contenedor. Esta operación es similar a crear una carpeta en un sistema de archivos tradicional, donde puedes organizar y almacenar diversos tipos de archivos.

El proceso de creación de una colección generalmente implica la especificación de su nombre y, posiblemente, algunas propiedades adicionales que definen cómo se manejarán los documentos dentro de ella. Por ejemplo, se pueden establecer restricciones sobre el formato o el contenido de los documentos permitidos en la colección.

El borrado de una colección es otro aspecto fundamental del manejo de datos en bases de datos documentales. Este proceso implica eliminar completamente un contenedor y todos los documentos que contiene. Es importante tener cuidado con esta operación, ya que no hay deshacer disponible para recuperar los datos eliminados.

La creación y borrado de colecciones son operaciones que se realizan a menudo durante el desarrollo y mantenimiento de aplicaciones basadas en bases de datos documentales. Estas operaciones permiten adaptar la estructura del sistema a las necesidades cambiantes de los usuarios, facilitando la actualización y evolución del software.

Además de estas operaciones básicas, las bases de datos documentales ofrecen una serie de herramientas y métodos para gestionar colecciones. Por ejemplo, es posible crear índices en las colecciones para mejorar el rendimiento de las consultas, o bien utilizar funciones específicas para migrar documentos entre colecciones.

La creación y borrado de colecciones son operaciones que requieren un enfoque cuidadoso y planificado. Es importante considerar la estructura general del sistema, los requisitos de acceso a los datos y las necesidades futuras al momento de definir el diseño inicial de las colecciones.

En resumen, la creación y borrado de colecciones son operaciones fundamentales en el manejo de bases de datos documentales. Estas operaciones permiten estructurar y organizar los datos de manera eficiente, adaptándose a las necesidades cambiantes del sistema y facilitando su evolución a lo largo del tiempo.

<a id="anadir-modificar-y-eliminar-documentos"></a>
## Añadir, modificar y eliminar documentos

En el vasto mundo de la programación y la gestión de datos, las bases de datos documentales representan un paradigma innovador que ha revolucionado cómo almacenamos y recuperamos información. A diferencia de los sistemas tradicionales basados en tablas, estas bases nos permiten organizar y gestionar datos de una manera más flexible y escalable.

En esta subunidad didáctica, nos adentramos en la práctica de añadir, modificar y eliminar documentos en las bases de datos documentales. Este proceso es fundamental para mantener los sistemas informáticos actualizados y eficientes, permitiendo a los usuarios interactuar directamente con la información almacenada.

Para comenzar, debemos entender cómo estructurar nuestros documentos. En una base de datos documental, cada documento puede tener una estructura diferente, lo que significa que podemos representar datos complejos y jerárquicos de manera natural. Este enfoque es especialmente útil para aplicaciones que manejan información semiestructurada o semiunestructurada.

Añadir documentos a una base de datos documental es un proceso sencillo pero poderoso. Utilizando herramientas como MongoDB, podemos insertar nuevos documentos directamente en la colección deseada. Cada documento puede contener cualquier tipo de dato, desde simples valores hasta objetos complejos y arrays anidados.

La modificación de documentos es otro aspecto crucial del manejo de bases de datos documentales. A diferencia de las tablas relacionales, donde los cambios requieren una actualización completa del registro, en las bases documentales podemos modificar solo las partes específicas que necesitamos cambiar. Esto no solo mejora la eficiencia, sino que también facilita el mantenimiento y la evolución de nuestros sistemas.

Por último, pero no menos importante, eliminar documentos es un proceso necesario para mantener la integridad y la eficiencia de nuestro sistema. Al eliminar un documento, eliminamos toda su información asociada, lo que libera espacio en la base de datos y facilita el mantenimiento del sistema.

A lo largo de esta subunidad, exploraremos técnicas avanzadas para gestionar documentos en bases de datos documentales, incluyendo consultas complejas, índices eficientes y estrategias de replicación. Estas herramientas nos permitirán no solo añadir, modificar y eliminar documentos, sino que también optimizar el rendimiento de nuestros sistemas informáticos.

En conclusión, la gestión de documentos en bases de datos documentales es una habilidad esencial para cualquier programador o administrador de sistemas informáticos. A través de esta subunidad, hemos explorado los fundamentos y las técnicas avanzadas necesarias para trabajar eficazmente con estos sistemas innovadores. Con un buen dominio de estas operaciones básicas, podremos construir aplicaciones robustas y escalables que manejen información semiestructurada de manera eficiente y efectiva.

<a id="lenguajes-de-consulta-realizacion-de-consultas"></a>
## Lenguajes de consulta. Realización de consultas

En el vasto campo de la programación y la gestión de datos, las bases de datos documentales representan una innovadora forma de almacenar y recuperar información. Esta carpeta del contenido nos guía a través de los fundamentos y aplicaciones prácticas de estos sistemas de almacenamiento.

Comenzamos por entender qué son las bases de datos documentales. Estas bases almacenan datos en documentos estructurados, donde cada documento puede tener una forma diferente pero todos comparten un formato común. Este enfoque permite una gran flexibilidad y escalabilidad en el manejo de información compleja.

El lenguaje de consulta utilizado en estas bases es crucial para su eficacia. A diferencia de las bases relacionales que utilizan SQL, las bases documentales tienen sus propios lenguajes específicos. Uno de los más conocidos es MongoDB Query Language (MQL), aunque existen otros como JSONiq o XQuery. Estos lenguajes permiten realizar consultas complejas y eficientes sobre los documentos almacenados.

La realización de consultas en bases documentales implica una comprensión profunda del modelo de datos utilizado. Los documentos se organizan en colecciones, y las consultas se construyen para seleccionar documentos que cumplan ciertos criterios. Este proceso puede incluir la proyección de campos específicos, el filtrado por valores, la ordenación de resultados y la agrupación de documentos.

La importancia de la optimización de consultas no debe ser subestimada en bases documentales. Aunque estas bases son altamente escalables, su rendimiento puede verse afectado si las consultas no están bien formuladas. Optimizar consultas implica entender cómo se estructuran los índices y cómo se pueden utilizar para mejorar la velocidad de acceso a los datos.

Además de las consultas básicas, las bases documentales también permiten realizar operaciones avanzadas como el agregado de datos, la actualización de documentos y la eliminación de registros. Estas operaciones son esenciales para mantener la integridad y coherencia de la información almacenada.

La gestión de transacciones en bases documentales es otro aspecto crucial a considerar. Las transacciones permiten realizar múltiples operaciones como una sola unidad, asegurando que todas las modificaciones sean consistentes y completas. En caso de error, se puede revertir toda la transacción, manteniendo el estado del sistema.

La seguridad en bases documentales es otro tema de gran importancia. A diferencia de las bases relacionales, las bases documentales pueden almacenar información sensible que requiere protección adicional. Implementar políticas de acceso y control de usuarios es fundamental para mantener la integridad y confidencialidad de los datos.

La conversión entre diferentes formatos de documentos también es una habilidad valiosa en el manejo de bases documentales. A menudo, se necesita convertir información almacenada en un formato a otro para su uso en otras aplicaciones o sistemas. Herramientas y bibliotecas específicas pueden facilitar este proceso.

En conclusión, las bases de datos documentales representan una poderosa herramienta para el manejo de grandes volúmenes de información compleja. A través del lenguaje de consulta adecuado y la comprensión de los modelos de datos utilizados, es posible realizar consultas eficientes y optimizar el rendimiento del sistema. Además, la gestión de transacciones y la seguridad son aspectos cruciales que no deben ser ignorados en este tipo de bases de datos.

<a id="desarrollo-de-programas-que-utilizan-bases-de-datos-documentales"></a>
## Desarrollo de programas que utilizan bases de datos documentales

En este capítulo, nos adentramos en la creación de programas que interactúan con bases de datos documentales, una tecnología cada vez más utilizada para almacenar y gestionar grandes volúmenes de información. Las bases de datos documentales son sistemas que almacenan datos en forma jerárquica o en formato JSON, lo que les permite representar estructuras complejas de manera natural.

La interacción con estas bases de datos requiere un enfoque diferente al utilizado con las bases de datos relacionales tradicionales. En lugar de definir tablas y relaciones entre ellas, se utilizan colecciones y documentos para organizar los datos. Cada documento puede tener una estructura diferente, lo que ofrece flexibilidad pero también presenta desafíos en términos de consulta y consistencia.

Para interactuar con bases de datos documentales, existen varias herramientas y lenguajes de programación disponibles. En este capítulo, nos centraremos en cómo utilizar Python para acceder a estas bases de datos. Python es una excelente elección debido a su facilidad de uso y la amplia gama de bibliotecas que facilitan el trabajo con diferentes tipos de bases de datos.

La primera etapa del desarrollo implica establecer una conexión con la base de datos. Esto se realiza mediante un cliente específico para cada tipo de base de datos documental, como PyMongo para MongoDB o PyArango para ArangoDB. Una vez establecida la conexión, podemos realizar operaciones básicas como crear colecciones, insertar documentos y consultarlos.

La consulta en bases de datos documentales es particularmente poderosa debido a su capacidad para expresar consultas complejas utilizando un lenguaje específico del motor de base de datos. En Python, esto se logra mediante el uso de métodos proporcionados por las bibliotecas mencionadas anteriormente. Por ejemplo, PyMongo permite realizar consultas utilizando la sintaxis de MongoDB, lo que facilita la creación de criterios de búsqueda sofisticados.

Además de las operaciones básicas, es importante considerar la persistencia y la transacción en nuestras aplicaciones. Las bases de datos documentales suelen soportar transacciones ACID (Atomicidad, Coherencia, Isolamiento, Durabilidad), lo que garantiza que las operaciones complejas sean ejecutadas de manera segura y coherente. En Python, podemos utilizar el manejo de excepciones para asegurar la consistencia de nuestras transacciones.

La gestión de errores es otro aspecto crucial en el desarrollo con bases de datos documentales. A diferencia de las bases de datos relacionales, donde los errores pueden ser más predecibles y manejables, las bases de datos documentales pueden presentar problemas inesperados debido a la naturaleza dinámica de sus estructuras. En Python, podemos utilizar técnicas como el manejo de excepciones para capturar y tratar estos errores de manera efectiva.

La creación de informes es otro desafío en el desarrollo con bases de datos documentales. A diferencia de las bases de datos relacionales, donde los informes suelen basarse en consultas SQL predefinidas, las bases de datos documentales requieren una mayor flexibilidad y creatividad en la generación de informes. En Python, podemos utilizar bibliotecas como pandas para procesar y visualizar los datos obtenidos de las consultas a la base de datos.

La seguridad es un aspecto fundamental en el desarrollo con cualquier tipo de base de datos, pero especialmente importante en las bases de datos documentales. Las bases de datos documentales suelen almacenar información sensible y personal, lo que requiere una implementación robusta de medidas de seguridad. En Python, podemos utilizar técnicas como la autenticación y autorización para proteger nuestros sistemas contra accesos no autorizados.

En conclusión, el desarrollo con bases de datos documentales implica un enfoque diferente al utilizado con las bases de datos relacionales tradicionales. Aunque puede presentar desafíos adicionales, también ofrece una gran flexibilidad y capacidad para representar estructuras complejas de manera natural. Con Python como herramienta principal, podemos crear aplicaciones que interactúan eficazmente con estas bases de datos, aprovechando sus ventajas y superando sus limitaciones.


<a id="programacion-de-componentes-de-acceso-a-datos"></a>
# Programación de componentes de acceso a datos

<a id="concepto-de-componente"></a>
## Concepto de componente

En la subunidad "Concepto de componente" del módulo "Acceso a datos", se introduce el concepto fundamental que forma la base para el desarrollo de interfaces gráficas y aplicaciones interactivas. Un componente es una unidad funcional independiente dentro de un sistema, diseñado para realizar una tarea específica y reutilizable en diferentes partes del software. Este diseño modular facilita la mantenibilidad, la escalabilidad y la colaboración entre desarrolladores.

Los componentes pueden ser físicamente representados como clases o módulos en el código fuente, cada uno con sus propias propiedades, métodos y eventos. Por ejemplo, un componente de botón puede tener propiedades como su texto, color de fondo y tamaño, y métodos para manejar acciones como hacer clic. Los eventos son mecanismos que permiten a los componentes interactuar entre sí y con el usuario final.

La programación de componentes permite una gran flexibilidad en la creación de interfaces de usuario. Un componente puede ser diseñado para funcionar en diferentes contextos, adaptándose automáticamente al espacio disponible y proporcionando una experiencia coherente. Además, gracias a su naturaleza modular, los componentes pueden ser actualizados o reemplazados sin afectar el resto del sistema.

Para desarrollar componentes de manera eficiente, es crucial seguir ciertas prácticas recomendadas. Primero, se debe definir claramente las interfaces y contratos que un componente expone, asegurando que sea fácilmente integrable con otros componentes o sistemas. Segundo, el código interno del componente debe estar bien encapsulado para proteger sus detalles internos y facilitar su mantenimiento.

Además de la programación de componentes, es importante considerar su distribución y empaquetado. Los componentes deben ser diseñados de tal manera que puedan ser fácilmente instalados y desinstalados en diferentes entornos, lo que aumenta la portabilidad del software. Herramientas especializadas pueden ayudar en este proceso, facilitando la creación de paquetes autoinstalables y el manejo de dependencias.

La documentación es otro aspecto crucial al programar componentes. Debe proporcionarse información detallada sobre cómo utilizar los componentes, sus propiedades y métodos, así como ejemplos prácticos de su uso. La buena documentación facilita la comprensión del componente por parte de otros desarrolladores y reduce el tiempo necesario para aprender a usarlo.

En resumen, la programación de componentes es una práctica fundamental en el desarrollo moderno de software, permitiendo la creación de interfaces gráficas interactivas y sistemas modulares. Al seguir buenas prácticas en diseño, implementación y documentación, los desarrolladores pueden crear componentes reutilizables y eficientes que mejoren significativamente la calidad del software final.

<a id="propiedades-y-atributos"></a>
## Propiedades y atributos

En el mundo digital actual, los componentes de acceso a datos desempeñan un papel crucial en la interacción entre aplicaciones y bases de datos. Estos componentes son esenciales para la manipulación eficiente de información, proporcionando una capa abstrata que oculta los detalles complejos del almacenamiento y recuperación de datos.

La programación de componentes de acceso a datos implica el diseño y implementación de clases y objetos que encapsulan las operaciones básicas necesarias para interactuar con la base de datos. Estos componentes pueden ser utilizados en una variedad de aplicaciones, desde sistemas empresariales hasta aplicaciones web interactivas.

Una de las características fundamentales de estos componentes es su capacidad para manejar propiedades y atributos. Las propiedades son variables que representan el estado del objeto y proporcionan un mecanismo para acceder y modificar ese estado de manera segura y controlada. Los atributos, por otro lado, son los datos que almacenan la información relevante sobre el objeto.

La programación de componentes de acceso a datos implica no solo definir las propiedades y atributos, sino también implementar métodos para manipularlos. Estos métodos pueden incluir operaciones como la inserción, modificación y eliminación de registros en la base de datos, así como consultas para recuperar información.

Además de las propiedades y los métodos, los componentes de acceso a datos suelen implementar eventos que permiten asociar acciones específicas con ciertos estados o cambios. Por ejemplo, un evento puede ser desencadenado cuando se inserta un nuevo registro en la base de datos, lo que permite ejecutar código adicional sin necesidad de modificar el flujo principal del programa.

La programación de componentes de acceso a datos también implica considerar la persistencia del componente. Esto significa asegurarse de que los cambios realizados en el objeto se reflejen adecuadamente en la base de datos, y viceversa. La gestión de transacciones es un aspecto crucial de esta persistencia, ya que permite garantizar que las operaciones sean completadas de manera coherente y segura.

En resumen, la programación de componentes de acceso a datos es una práctica fundamental en el desarrollo de aplicaciones que interactúan con bases de datos. Al diseñar y implementar estos componentes, se asegura que la información sea gestionada eficientemente y de manera segura, lo que contribuye al funcionamiento correcto y robusto del sistema.

<a id="eventos-asociacion-de-acciones-a-eventos"></a>
## Eventos; asociación de acciones a eventos

En este capítulo, nos adentramos en la programación de componentes de acceso a datos, un aspecto crucial para el desarrollo eficiente de aplicaciones que interactúan con bases de datos. Los componentes de acceso a datos son entidades que encapsulan las operaciones necesarias para manipular los datos almacenados en una base de datos, proporcionando una interfaz simplificada y segura para su uso.

La programación de eventos es un concepto fundamental en la interacción entre el usuario y los componentes de acceso a datos. Los eventos son acciones o ocurrencias que pueden producirse dentro del sistema, como el clic de un botón, la entrada de texto en una caja de texto o la recepción de un mensaje de red. Al asociar acciones a estos eventos, podemos controlar cómo se responde el componente de acceso a datos a diferentes situaciones.

Para asociar acciones a eventos, los componentes de acceso a datos suelen proporcionar métodos específicos que permiten definir qué debe hacerse cuando ocurre un evento particular. Por ejemplo, en una interfaz gráfica, podríamos asociar el clic de un botón con un método que ejecuta una consulta SQL para actualizar la base de datos.

Es importante destacar que la programación de eventos no solo permite responder a acciones del usuario, sino también a cambios internos dentro del componente de acceso a datos. Por ejemplo, cuando se inserta o actualiza un registro en la base de datos, el componente puede emitir un evento que notifica a otros componentes sobre este cambio.

La gestión adecuada de eventos es esencial para mantener la coherencia y la integridad de los datos. Al asociar acciones a eventos, podemos asegurarnos de que las operaciones en la base de datos se realicen correctamente y que el estado del sistema esté actualizado en tiempo real.

Además, la programación de eventos facilita la creación de interfaces de usuario más interactivas y dinámicas. Al permitir asociar acciones a eventos, podemos crear componentes que respondan de manera inmediata a las acciones del usuario, proporcionando una experiencia de usuario más fluida y satisfactoria.

En resumen, la programación de eventos es un concepto fundamental en el desarrollo de componentes de acceso a datos. Al asociar acciones a eventos, podemos controlar cómo se responde el componente a diferentes situaciones, mantener la coherencia y la integridad de los datos, y crear interfaces de usuario más interactivas y dinámicas. Este conocimiento es esencial para desarrolladores que trabajan con bases de datos y necesitan crear aplicaciones que interactúen eficientemente con ellas.

<a id="persistencia-del-componente"></a>
## Persistencia del componente

En la programación orientada a objetos, la persistencia del componente es un concepto fundamental que permite almacenar y recuperar el estado de los objetos entre diferentes ejecuciones del programa. Este proceso es esencial para mantener la integridad de los datos y proporcionar una experiencia coherente al usuario.

La persistencia se realiza mediante mecanismos específicos que dependen del lenguaje de programación y las herramientas utilizadas. En muchos casos, esto implica el uso de bases de datos o archivos en el sistema de almacenamiento. La idea es serializar los objetos (es decir, convertirlos en una forma que pueda ser almacenada) y luego deserializarlos cuando sea necesario recuperar su estado.

Un componente persistente puede interactuar con diferentes tipos de almacenes de datos. Por ejemplo, si se está utilizando una base de datos relacional, el componente podría utilizar SQL para insertar, actualizar o eliminar registros en la base de datos. Si se prefiere un enfoque más orientado a objetos, el componente podría usar ORM (Object-Relational Mapping) para mapear directamente las clases del programa con tablas y columnas de la base de datos.

La gestión de la persistencia también implica consideraciones sobre la concurrencia. En entornos donde varios componentes pueden intentar acceder simultáneamente a los mismos datos, es crucial implementar mecanismos para evitar conflictos y garantizar la coherencia de los datos.

Además de las bases de datos, el almacenamiento en archivos también es una forma común de persistir objetos. Los archivos pueden ser de texto plano o binarios, dependiendo del tipo de datos que se quieran almacenar. La elección del formato adecuado puede influir en la eficiencia y la facilidad de acceso a los datos.

La persistencia no solo implica guardar el estado actual de los objetos, sino también manejar su ciclo de vida completo. Esto incluye la creación, modificación y eliminación de objetos persistentes, así como la recuperación de objetos previamente almacenados cuando se necesita trabajar con ellos nuevamente.

En resumen, la persistencia del componente es un aspecto crucial de la programación orientada a objetos que permite mantener los datos entre diferentes ejecuciones del programa. A través de mecanismos como bases de datos y archivos, los componentes pueden guardar su estado y recuperarlo cuando sea necesario, lo que es fundamental para mantener la integridad y coherencia de la información en aplicaciones complejas.

<a id="herramientas-para-desarrollo-de-componentes"></a>
## Herramientas para desarrollo de componentes

En este capítulo, nos adentramos en la programación de componentes de acceso a datos, un aspecto crucial para el desarrollo eficiente de aplicaciones que interactúan con bases de datos. Comenzamos por entender qué es un componente en el contexto de la programación y cómo se relaciona con el acceso a datos. Aprenderemos sobre las propiedades y atributos que definen los componentes, así como cómo asociar acciones a eventos para su control.

Continuando, exploraremos cómo persistir el estado del componente, lo que implica guardar y recuperar información de manera segura y eficiente. Además, aprenderemos sobre las herramientas disponibles para desarrollar componentes, tanto propietarias como libres, que facilitan la creación y gestión de estos elementos. Estas herramientas ofrecen una variedad de funcionalidades que permiten a los desarrolladores centrarse en el diseño y el comportamiento del componente, sin preocuparse por detalles técnicos innecesarios.

A medida que avanzamos, nos enfocaremos en cómo pruebas los componentes para asegurar su correcto funcionamiento. Esto incluirá la creación de pruebas unitarias y la documentación de las incidencias detectadas, lo que es fundamental para mantener el código limpio y funcional. También aprenderemos sobre la empaquetado de componentes, un proceso que prepara los archivos necesarios para su distribución y uso en otros proyectos.

Finalmente, reflexionaremos sobre cómo crear interfaces gráficas para interactuar con los componentes de acceso a datos. Esto implica entender cómo vincular eventos a acciones específicas y cómo diseñar componentes visuales que sean intuitivos y fáciles de usar. A lo largo del capítulo, se presentan ejemplos prácticos que ilustran cada concepto, permitiendo al lector aplicar directamente lo aprendido en su propio trabajo.

En resumen, este capítulo proporciona una comprensión profunda de cómo programar componentes de acceso a datos, desde la definición de sus propiedades y atributos hasta su empaquetado y distribución. A través de ejemplos prácticos y herramientas disponibles, se demuestra cómo crear componentes funcionales y eficientes que faciliten el desarrollo de aplicaciones que interactúan con bases de datos.

<a id="desarrollo-empaquetado-y-utilizacion-de-componentes"></a>
## Desarrollo, empaquetado y utilización de componentes

En este capítulo, nos adentramos en la programación de componentes de acceso a datos, un aspecto fundamental para el desarrollo de aplicaciones que interactúan con bases de datos. Comenzamos por entender qué es un componente, sus propiedades y atributos, y cómo se asocian a orígenes de datos. Aprenderemos también cómo asociar acciones a eventos, lo que permite una interacción dinámica entre el usuario y la aplicación.

El desarrollo de componentes implica la creación de clases con métodos y propiedades específicas para interactuar con los datos. Estos componentes pueden ser utilizados en aplicaciones gráficas o interfaces naturales de usuario, permitiendo un acceso intuitivo a la información almacenada. La persistencia del componente es otro aspecto crucial, ya que permite guardar el estado actual del objeto y recuperarlo cuando sea necesario.

Herramientas para desarrollo de componentes son fundamentales para facilitar este proceso. Estas herramientas pueden ser librerías nativas o multiplataforma, proporcionando una interfaz gráfica para la definición y edición de componentes. Además, es importante aprender a pruebas los componentes, asegurándose de que funcionen correctamente en diferentes escenarios.

El empaquetado de componentes es otro paso crucial en el desarrollo completo del componente. Esto implica preparar el componente para su distribución y uso en otros proyectos o aplicaciones. Herramientas especializadas pueden facilitar este proceso, permitiendo la creación de instaladores y paquetes autoinstalables.

Finalmente, la utilización de componentes es el objetivo final del desarrollo y empaquetado. Esto implica cómo los componentes se integran en la aplicación principal, cómo se asocian con orígenes de datos y cómo se gestionan eventos para una interacción fluida y eficiente. Es importante documentar este proceso, asegurándose de que otros desarrolladores puedan entender y utilizar el componente sin problemas.

En resumen, programar componentes de acceso a datos es un proceso integral que implica desde la definición de clases hasta su empaquetado y distribución. Cada paso es crucial para garantizar una aplicación funcional y eficiente que pueda interactuar con bases de datos de manera segura y eficaz.


<a id="actividad-libre-de-final-de-evaluacion-la-milla-extra"></a>
# Actividad libre de final de evaluación - La milla extra

<a id="la-milla-extra-primera-evaluacion"></a>
## La Milla Extra - Primera evaluación

### ejercicio

```markdown

```
