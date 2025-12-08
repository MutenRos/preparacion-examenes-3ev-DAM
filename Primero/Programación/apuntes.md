# Programación

**Author:** Jose Vicente Carratala Sanchis

## Table of contents

- [Identificación de los elementos de un programa informático](#identificacion-de-los-elementos-de-un-programa-informatico)
  - [Estructura y bloques fundamentales](#estructura-y-bloques-fundamentales)
  - [Variables](#variables)
  - [Tipos de datos](#tipos-de-datos)
  - [Literales](#literales)
  - [Constantes](#constantes)
  - [Operadores y expresiones](#operadores-y-expresiones)
  - [Ejercicio de final de unidad](#ejercicio-de-final-de-unidad)
- [Utilización de objetos](#utilizacion-de-objetos)
  - [Características de los objetos](#caracteristicas-de-los-objetos)
  - [Instanciación de objetos](#instanciacion-de-objetos)
  - [Utilización de métodos. Parámetros](#utilizacion-de-metodos-parametros)
  - [Utilización de propiedades](#utilizacion-de-propiedades)
  - [Utilización de métodos estáticos](#utilizacion-de-metodos-estaticos)
  - [Constructores](#constructores)
  - [Destrucción de objetos y liberación de memoria](#destruccion-de-objetos-y-liberacion-de-memoria)
  - [Ejercicio de final de unidad](#ejercicio-de-final-de-unidad-1)
- [Uso de estructuras de control](#uso-de-estructuras-de-control)
  - [Estructuras de selección](#estructuras-de-seleccion)
  - [Estructuras de repetición](#estructuras-de-repeticion)
  - [Estructuras de salto](#estructuras-de-salto)
  - [Control de excepciones](#control-de-excepciones)
  - [Aserciones](#aserciones)
  - [Prueba, depuración y documentación de la aplicación](#prueba-depuracion-y-documentacion-de-la-aplicacion)
  - [Ejercicio](#ejercicio)
  - [Ejercicio de final de unidad](#ejercicio-de-final-de-unidad-2)
- [Desarrollo de clases](#desarrollo-de-clases)
  - [Concepto de clase](#concepto-de-clase)
  - [Estructura y miembros de una clase. Visibilidad](#estructura-y-miembros-de-una-clase-visibilidad)
  - [Creación de propiedades](#creacion-de-propiedades)
  - [Creación de métodos](#creacion-de-metodos)
  - [Creación de constructores](#creacion-de-constructores)
  - [Utilización de clases y objetos](#utilizacion-de-clases-y-objetos)
  - [Utilización de clases heredadas](#utilizacion-de-clases-heredadas)
- [Lectura y escritura de información](#lectura-y-escritura-de-informacion)
  - [Flujos. Tipos bytes y caracteres. Clases relacionadas](#flujos-tipos-bytes-y-caracteres-clases-relacionadas)
  - [Ficheros de datos. Registros](#ficheros-de-datos-registros)
  - [Apertura y cierre de ficheros. Modos de acceso. Escritura y lectura de información en ficheros](#apertura-y-cierre-de-ficheros-modos-de-acceso-escritura-y-lectura-de-informacion-en-ficheros)
  - [Utilización de los sistemas de ficheros](#utilizacion-de-los-sistemas-de-ficheros)
  - [Creación y eliminación de ficheros y directorios](#creacion-y-eliminacion-de-ficheros-y-directorios)
  - [Entrada desde teclado. Salida a pantalla. Formatos de visualización](#entrada-desde-teclado-salida-a-pantalla-formatos-de-visualizacion)
  - [Interfaces gráficas](#interfaces-graficas)
  - [Concepto de evento](#concepto-de-evento)
  - [Creación de controladores de eventos](#creacion-de-controladores-de-eventos)
  - [Simulacro examen programacion](#simulacro-examen-programacion)
  - [Simulacro de examen 2](#simulacro-de-examen-2)
  - [Ejercicio de final de unidad](#ejercicio-de-final-de-unidad-3)
  - [Examen final](#examen-final)
  - [Carpeta sin título](#carpeta-sin-titulo)
- [Aplicación de las estructuras de almacenamiento](#aplicacion-de-las-estructuras-de-almacenamiento)
  - [Estructuras estáticas y dinámicas](#estructuras-estaticas-y-dinamicas)
  - [Creación de matrices (arrays)](#creacion-de-matrices-arrays)
  - [Matrices (arrays) multidimensionales](#matrices-arrays-multidimensionales)
  - [Genericidad](#genericidad)
  - [Cadenas de caracteres. Expresiones regulares](#cadenas-de-caracteres-expresiones-regulares)
  - [Colecciones Listas, Conjuntos y Diccionarios](#colecciones-listas-conjuntos-y-diccionarios)
  - [Operaciones agregadas filtrado, reducción y recolección](#operaciones-agregadas-filtrado-reduccion-y-recoleccion)
- [Utilización avanzada de clases](#utilizacion-avanzada-de-clases)
  - [Composición de clases](#composicion-de-clases)
  - [Herencia y polimorfismo](#herencia-y-polimorfismo)
  - [Jerarquía de clases Superclases y subclases](#jerarquia-de-clases-superclases-y-subclases)
  - [Clases y métodos abstractos y finales](#clases-y-metodos-abstractos-y-finales)
  - [Interfaces](#interfaces)
  - [Sobreescritura de métodos](#sobreescritura-de-metodos)
  - [Constructores y herencia](#constructores-y-herencia)
- [Mantenimiento de la persistencia de los objetos](#mantenimiento-de-la-persistencia-de-los-objetos)
  - [Bases de datos orientadas a objetos](#bases-de-datos-orientadas-a-objetos)
  - [Características de las bases de datos orientadas a objetos](#caracteristicas-de-las-bases-de-datos-orientadas-a-objetos)
  - [Instalación del gestor de bases de datos](#instalacion-del-gestor-de-bases-de-datos)
  - [Creación de bases de datos](#creacion-de-bases-de-datos)
  - [Mecanismos de consulta](#mecanismos-de-consulta)
  - [El lenguaje de consultas sintaxis, expresiones, operadores](#el-lenguaje-de-consultas-sintaxis-expresiones-operadores)
  - [Recuperación, modificación y borrado de información](#recuperacion-modificacion-y-borrado-de-informacion)
  - [Tipos de datos objeto; atributos y métodos](#tipos-de-datos-objeto-atributos-y-metodos)
  - [Tipos de datos colección](#tipos-de-datos-coleccion)
- [Gestión de bases de datos](#gestion-de-bases-de-datos)
  - [Acceso a bases de datos. Estándares. Características](#acceso-a-bases-de-datos-estandares-caracteristicas)
  - [Establecimiento de conexiones](#establecimiento-de-conexiones)
  - [Almacenamiento, recuperación, actualización y eliminación de información en bases de datos](#almacenamiento-recuperacion-actualizacion-y-eliminacion-de-informacion-en-bases-de-datos)
- [Proyectos](#proyectos)
  - [Proyecto formulario](#proyecto-formulario)
- [Milla Extra Evaluacion 1](#milla-extra-evaluacion-1)
- [Actividad libre de final de evaluación - La milla extra](#actividad-libre-de-final-de-evaluacion-la-milla-extra)
  - [La Milla Extra - Primera evaluación](#la-milla-extra-primera-evaluacion)

---

<a id="identificacion-de-los-elementos-de-un-programa-informatico"></a>
# Identificación de los elementos de un programa informático

<a id="estructura-y-bloques-fundamentales"></a>
## Estructura y bloques fundamentales

En el vasto universo de la programación, cada programa informático es como una obra maestra compuesta por diversos elementos que trabajan juntos para crear algo funcional y eficiente. La carpeta `Primero/Programación/001-Identificación de los elementos de un programa informático/001-Estructura y bloques fundamentales` nos invita a explorar la esencia de estas obras maestras, desentrañando sus secretos y revelando las estructuras que sostienen su funcionamiento.

El primer elemento fundamental que encontramos en cualquier programa es la **estructura**. Es como el esqueleto de una casa: define cómo están organizados los diferentes componentes. En un programa, esta estructura se compone de bloques fundamentales que son las unidades más pequeñas y autónomas del código. Cada bloque puede ser una declaración simple o una secuencia de instrucciones complejas.

Siguiendo este esquema, cada uno de estos bloques es como una pieza en un rompecabezas. Al juntarlas adecuadamente, formamos la estructura general del programa. Esta estructura no solo determina cómo se ejecutan las instrucciones, sino también cómo interactúan entre sí.

La **variables** son otro elemento crucial que juegan un papel fundamental en el funcionamiento de los programas. Son como contenedores donde almacenamos datos que pueden cambiar durante la ejecución del programa. Cada variable tiene un nombre y un tipo específico, lo que le da una identidad única y permite realizar operaciones específicas con ella.

Las **operadores** son las herramientas que nos permiten manipular los valores de las variables. Son símbolos o palabras clave que realizan funciones como la suma, resta, multiplicación, comparación, entre otras. Los operadores son esenciales para construir expresiones y realizar cálculos complejos.

La **literales** son constantes que se utilizan directamente en el código. Pueden ser números, cadenas de texto o valores booleanos. Son los elementos concretos que forman parte del programa y que no cambian durante su ejecución.

Las **constantes**, por otro lado, son valores fijos que no pueden cambiar durante la ejecución del programa. A diferencia de las literales, las constantes tienen un nombre específico y se declaran una vez para toda la duración del programa.

La **programación orientada a objetos** introduce nuevos conceptos como las **clases**, los **objetos** y los **métodos**. Las clases son plantillas que definen las características comunes de un conjunto de objetos, mientras que los objetos son instancias concretas de esas clases. Los métodos son funciones asociadas a los objetos que realizan operaciones específicas.

La **programación estructurada**, por otro lado, se centra en la organización del código mediante estructuras como las **estructuras de control de flujo**. Estas estructuras permiten controlar el orden en que se ejecutan las instrucciones, determinando qué partes del programa se ejecutan y cuándo.

La **programación funcional**, por otro lado, enfatiza la idea de funciones puras y sin efectos secundarios. Las funciones funcionales toman entradas y producen salidas, pero no modifican el estado del programa ni interactúan con él fuera de su ámbito.

En conclusión, cada programa informático es una obra maestra compuesta por diversos elementos que trabajan juntos para crear algo funcional y eficiente. La estructura y los bloques fundamentales son los pilares sobre los cuales se construye todo el edificio. Desde las variables hasta las constantes, desde los operadores hasta los métodos, cada elemento tiene un papel específico y contribuye a la funcionalidad del programa. Al entender estos elementos y cómo interactúan entre sí, podemos desarrollar programas más complejos y eficientes.

### Descarga de Python

#### Explicación

Este fragmento de texto proporciona instrucciones claras sobre cómo descargar e instalar Python, un lenguaje de programación muy popular. El enlace principal que se debe visitar es la página oficial de descarga de Python en `https://python.org`. Allí, los estudiantes deben buscar la opción "Downloads" para obtener la última versión disponible compatible con su sistema operativo (Windows, Mac o Linux).

Cuando estén instalando Python en Windows, hay dos opciones importantes a considerar. La primera es marcar la casilla que dice "agregar al PATH de Windows", lo cual permite ejecutar comandos de Python desde cualquier lugar del sistema sin necesidad de especificar el directorio completo donde se encuentra Python. La segunda opción es seleccionar "instalar para todos los usuarios" si quieren que Python esté disponible para todas las cuentas en el ordenador, no solo la cuenta actual.

Estas instrucciones son fundamentales porque aseguran que todos los estudiantes tengan acceso a una versión reciente y funcional de Python, lo cual es crucial para seguir adelante con cualquier curso o proyecto de programación.

```markdown
La web de descarga es
https://python.org

- Downloads

Descargáis la última versión que haya en ese momento
Para vuestro sistema operativo

Cuando iniciéis la instalación en Windows:
- Marcad la casilla de "agregar al PATH de Windows"
- Marcad "instalar para todos los usuarios"
```

### Salida

#### Explicación

Este código es muy simple pero fundamental para entender los conceptos básicos de programación. La función `print()` se utiliza en Python para mostrar información en la pantalla, como un mensaje o datos que el programa genera. En este caso, el programa imprime en la pantalla el texto "Hola mundo desde Python". Esta frase es comúnmente utilizada en la primera lección de programación y sirve para verificar que todo está configurado correctamente en tu entorno de desarrollo. Es importante porque te ayuda a comprender cómo interactuar con el sistema para mostrar información al usuario, lo cual es un paso clave en el proceso de aprender cualquier lenguaje de programación.

```python
print("Hola mundo desde Python")
```

### entrada

#### Explicación

Este código es una pequeña secuencia en Python que interactúa con el usuario para recoger información. Primero, muestra un mensaje en pantalla diciendo "Ahora te voy a preguntar el nombre". Luego, espera que el usuario escriba su nombre y pulse Enter utilizando la función `input()`. Finalmente, imprime otro mensaje indicando que ya sabe el nombre del usuario.

Este código es importante porque demuestra cómo hacer que un programa interactúe con un usuario para recoger información, lo cual es una habilidad básica en programación. Ayuda a entender cómo usar las funciones `print()` y `input()`, y muestra cómo almacenar la entrada del usuario en el programa.

```python
print("Ahora te voy a preguntar el nombre")
input("Introduce tu nombre: ")
print("Ahora ya sé tu nombre")
```

### comentarios de tipo docstring

#### Explicación

Este fragmento de código muestra cómo crear un bloque de comentarios en Python conocido como "docstring". Un docstring es una cadena de texto que aparece inmediatamente después del inicio de una definición de función, clase u otro objeto. En este caso específico, no estamos dentro de ninguna estructura (como una función o una clase), pero el formato es el mismo. Los docstrings se utilizan para documentar lo que hace un programa, función o módulo, explicando su propósito y cómo debe usarse. Son muy útiles porque permiten a otros programadores entender rápidamente qué hace cada parte del código sin tener que leer todo el código fuente. Además, este tipo de comentarios quedan disponibles para ser leídos automáticamente por herramientas como la función `help()` en Python o generadores de documentación.

```python
'''
    Esto es un comentario
    de tipo docstring
    Y se pueden poner tantas líneas como se quiera
'''
```

### Comentarios de una linea

#### Explicación

Este fragmento de código en Python es simplemente un ejemplo de cómo se usa un comentario de una línea. En programación, los comentarios son bloques de texto que el programa ignora al ejecutarse y que están destinados únicamente a proporcionar información para los humanos que leen o escriben el código. Los comentarios ayudan a explicar qué hace un trozo específico del código, por qué se hizo de una cierta manera o proporcionan cualquier otra nota relevante.

En Python, puedes añadir un comentario simplemente colocando el símbolo `#` al principio de la línea donde deseas escribir el comentario. Todo lo que está después del `#` hasta el final de esa línea es ignorado por el intérprete de Python y no afecta en absoluto a cómo funciona tu programa.

Es importante incluir comentarios en tus programas porque ayudan a mantener el código limpio, fácil de entender para otras personas (o para ti mismo, después de un tiempo) y facilitan la colaboración entre desarrolladores.

```python
# Esto es un comentario de una linea
```

### Estructura recomendada de los programas

#### Explicación

Este fragmento de código en formato Markdown describe la estructura recomendada para escribir un programa en lenguajes como Python. La guía proporciona una serie de pasos que deben seguirse al crear y organizar tu código:

1. **Docstring**: Al principio del archivo, se debe incluir una docstring que describa brevemente qué hace el programa, quién lo creó y cualquier otra información relevante. Esto es crucial para la documentación interna del código y facilita su comprensión a otros desarrolladores.

2. **Importaciones**: Luego de la docstring, se realizan las importaciones necesarias. Aquí incluimos tanto librerías externas como módulos propios que el programa necesita para funcionar correctamente.

3. **Variables globales**: A continuación, se declaran las variables y parámetros globales del programa. Estas variables pueden ser accedidas desde cualquier parte del código durante la ejecución del programa.

4. **Clases y funciones**: En esta sección, se definen todas las clases y funciones que son necesarias para el funcionamiento del programa. Cada una de ellas puede contener bloques de código más pequeños y específicos que realizan tareas concretas.

5. **Función principal**: Finalmente, se incluye la función o método principal donde el flujo de ejecución del programa comienza. Desde aquí, el programa llamará a las clases y funciones definidas anteriormente para realizar sus operaciones.

Esta estructura ayuda a mantener el código organizado, legible y fácil de mantener, lo cual es fundamental en proyectos grandes y colaborativos.

```markdown
# Partes imprescindibles de un programa

## docstring
- En primer lugar, arriba del todo, debemos crear un docstring
- Es una descripción del título del programa, el autor, y un breve resumen de lo que hace

## Importaciones
- Importamos librerías necesarias
- Importamos el código que exista en otros archivos

## Variables  globales
- Declaración de variables/parámetros globales
- Crea variables
- Su ámbito será global dentro de todo el programa

## Clases / funciones
- Creamos las clases y las funciones que sean necesarias

## Método o función principal
- Punto de ejecución desde el cual se inicia el programa
```

<a id="variables"></a>
## Variables

En el vasto universo de la programación, las variables son como los ingredientes que forman una receta culinaria. Cada variable es un contenedor que almacena un valor específico, que puede ser modificado a lo largo del tiempo. En este capítulo, nos adentramos en el mundo de las variables, explorando sus características y su papel fundamental en la construcción de programas informáticos.

Las variables son declaradas con un nombre único que actúa como una etiqueta para identificar el contenido almacenado. Al igual que los ingredientes en una receta, cada variable tiene un tipo específico, que determina qué tipo de datos puede contener. Por ejemplo, puedes tener una variable llamada `edad` que almacene un número entero, o una variable llamada `nombre` que almacene una cadena de texto.

La declaración de variables es como preparar los ingredientes antes de comenzar a cocinar. En la programación, esto se hace utilizando palabras clave específicas para cada tipo de dato. Por ejemplo, en muchos lenguajes de programación, puedes declarar una variable entera con el nombre `edad` y asignarle un valor inicial de 25 así: `int edad = 25;`. Esta línea de código es como decir "prepara un contenedor llamado `edad`, que puede almacenar números enteros, y coloca en él el número 25".

Una vez declaradas, las variables pueden ser utilizadas en cualquier parte del programa. Es como tener una receta que menciona los ingredientes necesarios para preparar una ensalada. En la programación, puedes utilizar la variable `edad` en diferentes partes de tu código para realizar operaciones o mostrar información al usuario.

Es importante recordar que las variables son mutables, lo que significa que su valor puede cambiar a lo largo del tiempo. Por ejemplo, si tienes un programa que calcula el descuento de un producto, puedes declarar una variable `precio` y otra `descuento`. Inicialmente, la variable `precio` podría tener el valor 100, pero luego podrías modificarla para reflejar el precio final después del descuento.

Además de almacenar valores simples como números o texto, las variables también pueden contener estructuras más complejas. Por ejemplo, puedes tener una variable que almacene un nombre completo, que sería una cadena compuesta por varias palabras. Otra variable podría almacenar una lista de productos en un carrito de compras.

La gestión eficiente de variables es crucial para la legibilidad y el mantenimiento del código. Es como organizar los ingredientes de una receta de manera clara y sistemática, para que sea fácil encontrar lo que se necesita cuando se necesite. Por eso es importante dar nombres descriptivos a las variables, que reflejen su contenido o propósito.

En resumen, las variables son el corazón de cualquier programa informático. Son los contenedores que almacenan los datos y permiten que el programa interactúe con ellos. Al entender cómo declarar, utilizar y gestionar variables, se abre la puerta a la creación de programas complejos y eficientes. Es un concepto fundamental que todos los programadores deben dominar para poder expresar sus ideas en código.

### Contenedor de informacion

#### Explicación

Este fragmento de código en Python se utiliza para mostrar cómo trabajar con variables. En la primera línea, `edad = 47`, estamos creando una variable llamada `edad` y le asignamos el valor numérico 47. Esto es como decir: "La edad que estamos considerando en este momento es 47 años". 

Luego, en la segunda línea, `print(edad)`, se utiliza la función `print()` para mostrar el contenido de la variable `edad` en pantalla. En este caso, lo que sale por consola será simplemente el número 47.

Este código es importante porque demuestra cómo almacenar información en una variable y luego recuperar esa misma información para su uso o visualización. Es un paso fundamental al aprender a programar ya que las variables permiten almacenar datos que pueden ser modificados y accedidos durante la ejecución del programa.

```python
edad = 47

print(edad)
```

### varias variables

#### Explicación

Este código en Python muestra cómo se declaran y utilizan variables para almacenar información como números y textos, y luego imprime esa información en la pantalla. En primer lugar, se crean dos variables llamadas `edad` y `nombre`. La variable `edad` almacena el número 47, que probablemente representa los años de edad de una persona. Por otro lado, `nombre` guarda el texto "Jose Vicente", que es un nombre propio.

Después, el código utiliza la función `print()` para mostrar en pantalla mensajes y el contenido de las variables. Primero imprime "Mi edad es de:", seguido del valor almacenado en `edad`, y luego "Mi nombre es:" junto con el texto que contiene la variable `nombre`. Esto permite a cualquier persona ejecutar el programa entender fácilmente cuál es la edad y el nombre que se han especificado en el código.

```python
edad = 47
nombre = "Jose Vicente"

print("Mi edad es de:")
print(edad)
print("Mi nombre es:")
print(nombre)
```

### reglas de declaracion

#### Explicación

Este fragmento de código está mostrando diferentes formas correctas e incorrectas de declarar variables en Python, que son elementos fundamentales para almacenar datos. Las líneas válidas como `edad`, `miedad` y `mi_edad` muestran cómo se pueden asignar valores a variables utilizando nombres válidos: deben comenzar con una letra o un guion bajo (_) y pueden contener letras, números y guiones bajos. Sin embargo, las líneas que están comentadas (con el símbolo `#`) como `# mi edad = 47` y `# mi-edad = 47` no son válidas porque los espacios no están permitidos en medio de un nombre de variable, ni tampoco los guiones medios (-). La línea que dice `e2dad = 47` es correcta pero la línea `#2edad = 47` está incorrecta ya que los nombres de las variables no pueden comenzar con un número. Este código sirve para aprender y entender cuáles son las reglas para declarar variables en Python, lo cual es crucial para escribir programas sin errores.

```python
edad = 47
miedad = 47
mi_edad = 47
# mi edad = 47
# mi-edad = 47
edad2 = 47
e2dad = 47
#2edad = 47
```

<a id="tipos-de-datos"></a>
## Tipos de datos

En el vasto mundo de la programación, los tipos de datos son como las piezas fundamentales que construyen la estructura de cualquier programa informático. Estos elementos esenciales determinan cómo se almacenan y manipulan los datos dentro del sistema, influyendo en su eficiencia y precisión.

Los tipos de datos pueden clasificarse en varias categorías principales, cada una con sus propias características y usos específicos. Por ejemplo, los tipos numéricos incluyen enteros, flotantes y complejos, cada uno diseñado para representar diferentes rangos y precisiones de valores numéricos. Los tipos de texto, por otro lado, permiten almacenar cadenas de caracteres que pueden formar palabras, frases o incluso párrafos.

Además de los tipos numéricos y de texto, existen otros tipos de datos que son cruciales para la programación moderna. Los booleanos, por ejemplo, solo pueden tomar dos valores: verdadero o falso, lo que es fundamental para el control de flujo en programas. Las fechas y horas también son un tipo de dato común, permitiendo al programa manejar información temporal con precisión.

La elección del tipo de datos adecuado es crucial para la eficiencia del programa. Un tipo de dato incorrecto puede llevar a errores de ejecución o incluso a problemas de rendimiento significativos. Por lo tanto, comprender y utilizar correctamente los tipos de datos es una habilidad esencial en cualquier lenguaje de programación.

Además de estos tipos básicos, muchos lenguajes de programación ofrecen tipos de datos más complejos que permiten representar estructuras de datos más sofisticadas. Las matrices o arrays, por ejemplo, son tipos de datos que pueden almacenar colecciones de elementos del mismo tipo. Los diccionarios o hashes, en cambio, permiten asociar claves con valores, lo que es útil para almacenar y recuperar información de manera eficiente.

La comprensión de los tipos de datos también facilita la depuración y el mantenimiento del código. Al conocer cómo se manejan diferentes tipos de datos, los programadores pueden identificar rápidamente errores y optimizar el rendimiento del programa.

En resumen, los tipos de datos son una parte esencial de cualquier sistema informático. Desde los simples hasta los complejos, cada uno desempeña un papel crucial en la estructura y funcionamiento del programa. Comprender y utilizar correctamente estos tipos es fundamental para desarrollar software eficiente y robusto.

La programación no es solo sobre escribir código; es también sobre entender cómo se organiza y manipula la información dentro de ese código. Los tipos de datos son el lenguaje con el que los programadores comunican esta información al ordenador, y su correcta utilización es una habilidad clave en cualquier proyecto informático.

Al explorar los diferentes tipos de datos disponibles en un lenguaje de programación, los estudiantes pueden adquirir una comprensión profunda de cómo se construyen y funcionan los programas. Esta conocimiento les permitirá crear aplicaciones más complejas y eficientes, capaces de manejar una amplia gama de tareas y procesos.

En conclusión, los tipos de datos son el esqueleto sobre el cual se construye cualquier programa informático. Comprenderlos completamente es un paso crucial en el viaje hacia la programación experta, permitiendo a los desarrolladores crear software que sea no solo funcional, sino también eficiente y escalable.

### diferentes tipos de datos

#### Explicación

Este fragmento de código es una introducción a los diferentes tipos de datos que puedes utilizar en Python. En este caso, se crean cuatro variables: `nombre`, `edad`, `altura` y `guapo`. Cada variable almacena un valor distinto tipo de dato:

- La variable `nombre` contiene el nombre "Jose Vicente", lo cual es una cadena o string en programación (representado entre comillas).
- `edad` almacena el número 47, que es un entero (un número sin decimales).
- `altura` tiene asignado el valor decimal 1.78, lo que indica la altura de alguien en metros.
- Finalmente, `guapo` contiene un valor booleano `True`, que significa "verdadero" y se usa para representar estados o condiciones verdaderas/false.

Este código es importante porque muestra cómo Python maneja diferentes tipos de datos, lo cual es fundamental al programar ya que cada tipo de dato tiene usos específicos y características particulares. Por ejemplo, operaciones matemáticas requieren valores numéricos (enteros o decimales), mientras que texto se maneja con cadenas. El tipo booleano `True` o `False` es crucial para la lógica del programa, permitiendo tomar decisiones basadas en condiciones específicas.

```python
nombre = "Jose Vicente" # cadena
edad = 47 # entero
altura = 1.78 # decimal
guapo = True # booleana
```

### conversion de tipo de dato implicita

#### Explicación

Este fragmento de código en Python muestra cómo se manejan y transforman los tipos de datos. Inicialmente, la variable `edad` es asignada con el valor "47", pero este valor está entre comillas, lo que significa que `edad` es un string (una cadena de caracteres) en lugar de un número entero. Cuando imprimimos el tipo de dato de `edad` usando `print(type(edad))`, vemos que Python indica que `edad` es de tipo `str`.

Luego, se imprime `edad*2`. En este contexto, al ser `edad` un string, la operación `*2` no suma dos veces el número 47 sino que concatena o "encadena" la cadena "47" con ella misma, resultando en "4747". Luego, cuando se realiza la operación `edad*1`, aunque no se imprime su resultado directamente, Python realiza una conversión implícita de tipo de dato para realizar esta operación. Sin embargo, debido a que `edad` es un string y no un número, realmente esto no cambia el valor de `edad`; simplemente Python permite la multiplicación por 1 sin error pero sigue siendo un string.

Finalmente, al imprimir nuevamente `edad*2`, obtendremos "4747" porque el valor de `edad` no ha cambiado a lo largo del código y sigue siendo una cadena. Es importante entender cómo Python maneja estas conversiones implícitas para evitar errores comunes en la programación, especialmente cuando trabajamos con operaciones matemáticas que implican cadenas de texto.

```python
edad = "47"
print(type(edad))

print(edad*2) # encadena

edad*1 # Conversión implícita de los datos

print(edad*2)
```

### conversión explicita de los datos

#### Explicación

Este fragmento de código en Python muestra cómo trabajar con diferentes tipos de datos, específicamente un cambio de una cadena a un número entero. Al principio, la variable `edad` contiene el texto "47", que es un tipo de dato string (cadena). Cuando usas `print(type(edad))`, se imprime `<class 'str'>`, lo cual indica que `edad` está almacenando datos como texto.

Luego, cuando intentamos multiplicar `edad` por 2 con `print(edad*2)`, en lugar de hacer una operación matemática, Python concatena (une) el texto dos veces, mostrando "4747". Esto demuestra cómo las cadenas se tratan diferente a los números.

Finalmente, al convertir explícitamente la cadena `edad` en un número entero usando `int(edad)`, ahora podemos hacer operaciones matemáticas con ella. Al imprimir `edad*2` por segunda vez, obtendrás el resultado 94, que es el doble del número original.

Este código es importante para entender cómo los tipos de datos afectan la forma en que Python interpreta y ejecuta las instrucciones, y cómo podemos cambiar entre diferentes tipos de datos según sea necesario.

```python
edad = "47"
print(type(edad))

print(edad*2) # encadena

edad = int(edad)

print(edad*2) # se trata como multiplicación
```

<a id="literales"></a>
## Literales

En el vasto mundo de la programación, los literales son como las joyas que adornan la estructura fundamental de un programa informático. Estos elementos representan valores inmutables que se utilizan directamente en el código fuente, proporcionando una forma sencilla y eficiente de incorporar datos específicos dentro del programa. Los literales pueden ser de diversos tipos, cada uno con su propia semántica y uso específico.

Los literales numéricos son un ejemplo claro de este concepto. Incluyen enteros (como 42 o -7), reales (como 3.14 o -0.001) y complejos (como 2+3i). Cada uno de estos tipos permite representar diferentes magnitudes y precisiones, adaptándose a las necesidades del programa.

Los literales de texto son otro tipo importante de literal. En la programación, los textos se representan generalmente como cadenas de caracteres encerradas entre comillas simples ('') o dobles (""). Estas cadenas pueden contener cualquier carácter imprimible y suelen ser utilizadas para almacenar nombres de variables, mensajes de error, instrucciones del usuario, etc.

Los literales booleanos son un tipo especial que solo puede tomar dos valores: verdadero (true) o falso (false). Son fundamentales en la toma de decisiones dentro del programa, permitiendo controlar el flujo de ejecución según ciertas condiciones.

Además de estos tipos básicos, existen literales más complejos como los literales nulos (null), que representan la ausencia de valor. También hay literales de fecha y hora, que permiten trabajar con momentos específicos del tiempo dentro del programa.

La utilización de literales en el código es crucial porque proporciona una forma directa y rápida de incorporar datos sin necesidad de variables o funciones adicionales. Esto facilita la lectura y comprensión del código, ya que los valores se pueden ver inmediatamente en su contexto.

Sin embargo, es importante recordar que los literales tienen un alcance limitado dentro del programa. Una vez definidos, no pueden cambiar su valor durante la ejecución, lo que las hace ideales para representar constantes o datos fijos.

En resumen, los literales son una herramienta fundamental en el lenguaje de programación, permitiendo incorporar valores directamente en el código fuente. Cada tipo de literal tiene sus propias características y usos específicos, contribuyendo así a la estructura y funcionalidad del programa informático.

### literales de cadena

#### Explicación

Este fragmento de código simplemente define una cadena de texto en Python. En programación, este tipo de elementos se conocen como literales; específicamente aquí estamos hablando de un literal de cadena porque el valor entre comillas ("esto es un literal") es una secuencia de caracteres. Estos literales de cadena son importantes porque nos permiten almacenar y manipular texto en nuestros programas, lo que es fundamental para muchas aplicaciones, como mostrar mensajes al usuario o guardar datos en formato textual. En resumen, este código no realiza ninguna acción particular, pero sirve para ilustrar cómo se declaran las cadenas de texto en Python.

```python
"esto es un literal"
```

### literales numericos

#### Explicación

Este código es muy simple, consiste en una sola línea que contiene un número entero, específicamente el número 47. En programación, cuando vemos un número sin ninguna operación o función asociada, este se considera un literal numérico. Un literal numérico es simplemente la representación directa de un valor numérico en el código fuente del programa. Es importante entender que aunque aquí solo aparece un número, los literales numéricos pueden ser utilizados para realizar cálculos, establecer valores iniciales de variables, entre otros usos dentro de programas más complejos.

```python
47
```

<a id="constantes"></a>
## Constantes

En el vasto mundo de la programación, las constantes desempeñan un papel fundamental, como pilares esenciales que sostienen la estructura del edificio. Estos son valores inmutables, una vez establecidos, permanecen firmes y no pueden ser modificados durante la ejecución del programa. Las constantes son declaradas con el fin de proporcionar nombres significativos a ciertos valores, facilitando así su uso y comprensión en el código.

La declaración de constantes es un acto de claridad y organización. Al nombrar un valor como una constante, se le da un nombre que refleja su propósito o contenido, lo que hace que sea más fácil entender su uso en el programa. Por ejemplo, si tienes un valor que representa la cantidad máxima de usuarios permitidos en un sistema, declararlo como una constante con el nombre `MAX_USUARIOS` facilita su identificación y modificación si es necesario.

Las constantes también contribuyen a la seguridad del código. Al establecer valores importantes como constantes, se reduce el riesgo de errores al modificar directamente los valores en el código fuente. Esto es especialmente útil cuando estos valores son utilizados en múltiples lugares dentro del programa, ya que cualquier cambio realizado en una sola ubicación garantiza que todos los demás lugares reflejen la nueva configuración.

Además, las constantes pueden mejorar la eficiencia del programa. Algunos compiladores y intérpretes de código optimizan automáticamente el uso de constantes, lo que puede llevar a un rendimiento más rápido. Esto es especialmente beneficioso cuando se utilizan valores fijos en bucles o operaciones repetitivas.

La gestión adecuada de las constantes también facilita la mantenibilidad del código. Si necesitas cambiar un valor importante, simplemente debes modificar la declaración de la constante y no tienes que buscar y reemplazar el valor en todo el programa. Esto reduce significativamente el riesgo de errores y asegura que todos los lugares donde se use el valor reflejen la nueva configuración.

Las constantes son una herramienta poderosa en la programación, proporcionando un medio para nombrar y utilizar valores importantes de manera segura y eficiente. Al declarar y utilizar constantes con inteligencia, puedes mejorar la calidad del código, su legibilidad y su mantenimiento a largo plazo.

### Las constantes no deberian cambiar

#### Explicación

Este código te muestra la diferencia entre variables y constantes en programación, aunque Python no tiene una forma directa de declarar constantes. Al principio, el programa asigna un número entero a la variable `edad` e imprime su valor. Luego cambia ese valor y vuelve a imprimirlo para demostrar que las variables pueden cambiar. En cambio, se establece que `PI`, generalmente considerado una constante matemática, tiene un valor inicial de aproximadamente 3.1416. Aunque el código permite cambiar este valor después, lo imprime nuevamente para ilustrar que en la práctica y según las buenas prácticas, deberías evitar cambiar los valores de las constantes porque podrían alterarse accidentalmente o confundir a otros programadores al leer tu código.

Es importante entender esta distinción porque mantiene el código limpio, predecible y fácil de mantener. Aunque Python no tiene un mecanismo específico para definir constantes como lo hacen algunos otros lenguajes (como Java con `final` o C++ con `const`), la convención es usar nombres en mayúsculas para variables que deberían permanecer inmutables durante la ejecución del programa.

```python
edad = 47
print("tengo",edad,"años")
edad = 48 # se puede variar el valor de una variable
print("tengo",edad,"años")

# variables en minúscula, constantes en mayúscula
PI = 3.1416
print("El valor de PI es:",PI)
PI = 4
print("El valor de PI es:",PI) # Funciona, pero no debe ocurrir
```

<a id="operadores-y-expresiones"></a>
## Operadores y expresiones

En el vasto mundo de la programación, los operadores y las expresiones son como los bloques con los que se construyen las estructuras fundamentales de cualquier programa informático. Estos elementos permiten a los desarrolladores manipular datos, realizar cálculos y tomar decisiones en función de ciertas condiciones.

Los operadores son símbolos o palabras clave que indican una acción específica sobre uno o más operandos (valores o variables). Por ejemplo, el operador `+` indica la adición de dos números. Los operadores pueden ser aritméticos, relacionales, lógicos y de asignación, cada uno con su propio conjunto de funciones específicas.

Las expresiones son combinaciones de operandos y operadores que se evalúan para producir un valor. Por ejemplo, la expresión `a + b` es una suma de dos variables `a` y `b`. Las expresiones pueden ser simples o complejas, dependiendo del número de operadores y operandos involucrados.

La importancia de los operadores y las expresiones radica en su capacidad para realizar cálculos y tomar decisiones. Por ejemplo, una expresión como `if (x > 0)` evalúa si la variable `x` es mayor que cero, lo que determina el flujo del programa. Los operadores de asignación, como `=`, permiten almacenar valores en variables, mientras que los operadores relacionales, como `==` o `!=`, comparan dos valores y devuelven un resultado booleano.

La comprensión de los operadores y las expresiones es fundamental para cualquier programador. No solo son la base de todas las operaciones matemáticas y lógicas en el código, sino que también permiten a los desarrolladores crear algoritmos complejos y resolver problemas de forma eficiente. A través del uso de operadores y expresiones, se pueden manipular datos, realizar cálculos y tomar decisiones en función de ciertas condiciones.

Los operadores y las expresiones son herramientas poderosas que permiten a los programadores crear programas complejos y eficientes. Al dominar estos elementos, se abre la puerta a una amplia gama de posibilidades en el mundo de la programación, desde aplicaciones simples hasta sistemas empresariales complejos.

En resumen, los operadores y las expresiones son los pilares sobre los cuales se construyen los programas informáticos. Su comprensión es fundamental para cualquier programador y permite a los desarrolladores crear algoritmos complejos y resolver problemas de forma eficiente. A través del uso de operadores y expresiones, se pueden manipular datos, realizar cálculos y tomar decisiones en función de ciertas condiciones, lo que abre la puerta a una amplia gama de posibilidades en el mundo de la programación.

### operadores aritmeticos

#### Explicación

Este código es un ejemplo básico de cómo se utilizan los operadores aritméticos en Python. Cada línea del código realiza una operación matemática diferente y la imprime en pantalla. La primera línea suma dos números (4 + 3) e imprime el resultado, que es 7. Luego resta estos mismos números (4 - 3), multiplicándolos después (4 * 3) y dividiendo finalmente (4 / 3). El último print utiliza un operador llamado módulo (%), que te da el resto de la división entre los dos números, en este caso 1. Estas líneas son importantes porque muestran cómo Python maneja diferentes tipos de cálculos básicos y ayudan a entender los fundamentos matemáticos en programación.

```python
print(4+3)
print(4-3)
print(4*3)
print(4/3)
print(4%3)
```

### operadores de comparacion

#### Explicación

Este código en Python muestra cómo se utilizan los operadores de comparación, que son herramientas importantes para evaluar si una afirmación es verdadera o falsa. Cada línea del código compara dos números y luego imprime el resultado: `True` (verdadero) si la afirmación es correcta, y `False` (falso) en caso contrario.

La primera línea pregunta si 4 es menor que 3 (`print(4 < 3)`), lo cual no es cierto. Por eso imprime `False`. Las líneas siguientes hacen comparaciones similares usando los operadores "menor o igual", "mayor", "mayor o igual" y "igual". Cada una evalúa si la primera expresión matemática es verdadera en relación a la segunda, y muestra el resultado.

Estos operadores de comparación son fundamentales para controlar flujos en programas más grandes (como condicionales `if`), permitiendo que los programas tomen decisiones basadas en las condiciones actuales. Entender cómo funcionan estos operadores es crucial para aprender a escribir código lógico y eficiente.

```python
print(4 < 3)
print(4 <= 3)
print(4 > 3)
print(4 >= 3)
print(4 == 3)
print(4 != 3)
```

### Operadores aritmeticos abreviados

#### Explicación

Este código es una secuencia de operaciones básicas en Python que muestran cómo actualizar una variable utilizando operadores aritméticos abreviados. En primer lugar, se inicializa la variable `edad` con el valor 47 y luego se imprime ese valor. Luego, en lugar de escribir expresiones largas como `edad = edad + 5`, utiliza un operador abreviado `+=`, que añade 5 a la variable `edad` y actualiza su valor inmediatamente. Esto se hace para cada operación aritmética básica (suma, resta, multiplicación, división) utilizando los operadores correspondientes (`-=`, `*=`, `/=`). Después de cada cambio en el valor de `edad`, se imprime el nuevo valor. Estos operadores abreviados no solo hacen que tu código sea más corto y fácil de leer, sino también menos propenso a errores por duplicar expresiones. Son herramientas muy útiles para manipular valores numéricos directamente en las variables.

```python
edad = 47
print(edad)

# edad = edad + 5
edad += 5
print(edad)

# edad = edad - 5
edad -= 5
print(edad)

# edad = edad * 5
edad *= 5
print(edad)

# edad = edad / 5
edad /= 5
print(edad)
```

### booleanos

#### Explicación

Este código muestra cómo usar operadores lógicos en Python para combinar múltiples expresiones booleanas. Los operadores principales aquí son "and" y "or". La primera línea evalúa tres comparaciones con el operador "and", lo que significa que todas las comparaciones deben ser verdaderas para que toda la expresión sea verdadera. Como 4 es igual a 4, 3 es igual a 3, y 2 es igual a 2, la salida será "True". En la segunda línea, el último valor de comparación cambia a 2 siendo igual a 1, lo cual es falso; por tanto, todo el resultado con "and" será "False".

Luego, se utilizan operadores "or" para combinar tres expresiones booleanas. El operador "or" devuelve verdadero si al menos una de las comparaciones es verdadera. Por ejemplo, en la tercera línea, aunque dos comparaciones son falsas (4 es igual a 3 y 3 es igual a 2), el hecho de que 4 sea igual a 4 hace que toda la expresión sea "True". En la última línea, todas las comparaciones son falsas, por lo que todo el resultado con "or" será "False".

Este tipo de operadores lógicos es crucial en programación para tomar decisiones basadas en múltiples condiciones.

```python
print(4 == 4 and 3 == 3 and 2 == 2)
print(4 == 4 and 3 == 3 and 2 == 1)


print(4 == 4 or 3 == 3 or 2 == 1)
print(4 == 4 or 3 == 2 or 2 == 1)
print(4 == 3 or 3 == 2 or 2 == 1)
```

<a id="ejercicio-de-final-de-unidad"></a>
## Ejercicio de final de unidad

### actividad

#### Explicación

Parece que no has proporcionado ningún fragmento de código para analizar. ¿Podrías por favor compartir el bloque específico de código en formato Markdown del archivo que mencionaste? Una vez que tenga ese código, podré darte una explicación clara y concisa sobre cómo funciona y su importancia.

```markdown

```


<a id="utilizacion-de-objetos"></a>
# Utilización de objetos

<a id="caracteristicas-de-los-objetos"></a>
## Características de los objetos

Los objetos son los bloques fundamentales de la programación orientada a objetos (POO), representando entidades del mundo real con sus propiedades y comportamientos. En este contexto, los objetos se caracterizan por su estado, comportamiento y identidad.

El estado de un objeto refleja su situación actual en el programa, definido por sus atributos o variables miembro que almacenan datos relevantes. Por ejemplo, un objeto de tipo "Coche" podría tener atributos como color, marca y modelo, cada uno con un valor específico que describe su estado.

El comportamiento de los objetos se expresa a través de métodos o funciones asociados a ellos. Estos métodos definen las acciones que el objeto puede realizar. Siguiendo el ejemplo del coche, podrían existir métodos como arrancar(), frenar() y acelerar(). Cada método realiza una tarea específica relacionada con el estado del objeto.

La identidad de un objeto es única en su contexto, lo que se refleja en la referencia a él. En Python, por ejemplo, cada objeto tiene una dirección de memoria única que lo distingue de otros objetos. Esta identidad es crucial para acceder y manipular los objetos dentro del programa.

Además de estos tres aspectos fundamentales, los objetos pueden interactuar entre sí mediante mensajes o invocaciones a métodos. Cuando un objeto recibe un mensaje, ejecuta el método correspondiente, lo que puede modificar su estado o generar algún efecto secundario visible en el sistema.

La programación orientada a objetos permite organizar y estructurar el código de manera lógica y coherente, facilitando la reutilización y mantenimiento del software. Al tratar los datos y las operaciones sobre ellos como entidades interconectadas, se pueden crear sistemas complejos pero manejables.

La herencia es otro concepto clave en la POO que permite crear nuevas clases a partir de clases existentes, heredando sus atributos y métodos. Esto facilita el reutilización del código y la creación de jerarquías lógicas de objetos. Por ejemplo, una clase "Automóvil" podría ser una superclase para las clases "Coche", "Motocicleta" y "Truck".

La encapsulación es un principio que oculta los detalles internos de un objeto y expone solo lo necesario a través de métodos públicos. Esto protege el estado del objeto y permite modificarlo de manera controlada, evitando cambios no deseados o inconsistencias.

En resumen, los objetos son la base de la programación orientada a objetos, representando entidades con estado, comportamiento y identidad únicas. Su uso permitirá crear sistemas complejos pero manejables, facilitando la reutilización del código y la creación de jerarquías lógicas de objetos.

### Nota importante

#### Explicación

Este fragmento de código es un archivo Markdown que sirve como nota importante para guiar a los creadores de ejercicios. En él se indica que esta subunidad del curso no se centra en crear nuevas clases personalizadas, sino en utilizar objetos que ya existen en el lenguaje de programación elegido. Esto significa que cuando se crean ejercicios para esta parte del programa, deben basarse únicamente en la manipulación y uso de los objetos predeterminados del lenguaje, sin necesidad de crear nuevos objetos desde cero. La importancia radica en enfocar a los estudiantes en comprender y aplicar correctamente los objetos predefinidos antes de avanzar hacia la creación de sus propias clases más adelante en el curso.

```markdown
Nota importante para la generación de ejercicios de esta subunidad:
Esta subunidad trata, no la creación de clases personalizadas, sino la utilización de objetos predeterminados existentes en el propio lenguaje de programación.
Para crear actividades, ajustate al alcance concreto de los ejercicios desarrollados en la carpeta 101-Ejercicios.
```

### Características

#### Explicación

Este fragmento de texto explica los fundamentos básicos de lo que son los objetos en la programación orientada a objetos. Los objetos tienen dos elementos clave: propiedades y métodos. Las propiedades son como las características o datos asociados al objeto, mientras que los métodos son acciones que el objeto puede realizar. Además, menciona los constructores, funciones especiales que se utilizan para inicializar un nuevo objeto cuando se crea.

Los objetos también proporcionan beneficios importantes en la programación al modularizar y facilitar la reutilización del código, lo cual es fundamental para manejar programas más grandes y complejos. Esto significa que puedes crear bloques de código reutilizables que cumplen con funciones específicas, lo que hace el desarrollo de software más eficiente y menos propenso a errores.

Este enfoque orientado a objetos es crucial porque ayuda a organizar mejor el código, facilita la colaboración en proyectos grandes, y permite aprovechar características avanzadas como herencia (permitiendo a un objeto "heredar" las propiedades y métodos de otro), polimorfismo (capacidad para que diferentes tipos de objetos respondan a los mismos mensajes o llamadas) y interfaces (contratos para definir qué funciones debe tener cualquier objeto que cumpla con esa interfaz).

```markdown
Los objetos:

- Tienen propiedades, que son atributos estáticos
- Tienen métodos, que son funciones dinámicas
- Pueden tener constructores, que es una función que se ejecuta al inicio
- Tendrán operaciones avanzadas, tales como la herencia, el polimorfismo, o las interfaces

Los objetos:

- Representan bloques de código
- intentan modularizar, y reutilizar
- Son importantes para crar programas grandes
```

<a id="instanciacion-de-objetos"></a>
## Instanciación de objetos

La instanciación de objetos es una etapa fundamental en la programación orientada a objetos (POO), representando el proceso mediante el cual se crean objetos a partir de clases. Este concepto es como la "fabricación" de instancias concretas basadas en un modelo general, conocido como clase.

En este contexto, cada objeto creado a partir de una clase es una instancia única que posee los atributos y métodos definidos por dicha clase, pero también puede tener valores específicos para sus propiedades. La instanciación es el punto de partida para interactuar con los objetos en un programa POO, permitiendo manipular su estado y comportamiento.

La creación de una instancia implica la asignación de memoria para almacenar sus datos y la ejecución del constructor de la clase, que inicializa los atributos del objeto. Este proceso es crucial porque determina cómo el objeto será utilizado en el programa, definiendo su identidad y su comportamiento inicial.

La instanciación también permite la creación de múltiples objetos a partir de una misma clase, lo cual es útil para representar entidades distintas pero similares dentro del mismo contexto. Cada uno de estos objetos puede tener valores diferentes para sus atributos, permitiendo así una gran flexibilidad en el manejo de datos y operaciones.

Además, la instanciación facilita la reutilización de código, ya que permite crear múltiples objetos con comportamientos similares sin necesidad de escribir nuevamente las mismas líneas de código. Esto mejora la eficiencia del programa y reduce el riesgo de errores al mantener una única definición de comportamiento.

La instanciación es un concepto básico pero poderoso en POO, ya que permite crear objetos con estados y comportamientos específicos, lo cual es fundamental para representar entidades del mundo real dentro de un programa. Esta capacidad es esencial para la creación de aplicaciones complejas y dinámicas, donde los objetos interactúan entre sí para lograr funcionalidades avanzadas.

La instanciación también implica el manejo de recursos como memoria, lo cual es una consideración importante en la programación moderna. La asignación y liberación de memoria adecuada son cruciales para evitar problemas de rendimiento y evitar fugas de memoria, que pueden llevar a problemas graves en aplicaciones largas o intensivas.

En resumen, la instanciación de objetos es un proceso fundamental en la programación orientada a objetos, permitiendo crear entidades concretas a partir de clases. Este concepto es esencial para representar el mundo real dentro de un programa y facilita la reutilización de código, lo cual es crucial para la creación de aplicaciones complejas y eficientes. La comprensión y correcta implementación de la instanciación son habilidades fundamentales en cualquier desarrollo de software basado en POO.

### Nota importante

#### Explicación

Este fragmento de código es un archivo Markdown que sirve como nota importante para estudiantes y profesores sobre cómo generar ejercicios relacionados con la instanciación de objetos. El texto explica que esta sección no requiere crear nuevas clases personalizadas, sino utilizar los objetos ya existentes en el lenguaje de programación estudiado. Específicamente, se indica que para desarrollar actividades y ejercicios, deben seguir las directrices específicas establecidas en la carpeta "101-Ejercicios". Esto es importante porque ayuda a mantener un enfoque claro sobre el tema y asegura que los estudiantes practiquen habilidades relevantes dentro del contexto de estudio.

```markdown
Nota importante para la generación de ejercicios de esta subunidad:
Esta subunidad trata, no la creación de clases personalizadas, sino la utilización de objetos predeterminados existentes en el propio lenguaje de programación.
Para crear actividades, ajustate al alcance concreto de los ejercicios desarrollados en la carpeta 101-Ejercicios.
```

### importamos math

#### Explicación

El código que has proporcionado importa el módulo `math` en Python. Este módulo contiene una serie de funciones matemáticas y constantes adicionales, como la función seno (`sin()`), coseno (`cos()`), raíz cuadrada (`sqrt()`), entre otras. Al escribir `import math`, estás incluyendo todas estas funciones en tu programa para que puedas utilizarlas fácilmente añadiendo el prefijo `math.` antes de cada función o constante, por ejemplo: `math.sin(x)`.

Es importante porque sin importar este módulo, no tendrías acceso a todas las operaciones matemáticas avanzadas proporcionadas por Python. Esto facilita la realización de cálculos complejos en tus programas y evita que tengas que escribir tú mismo el código para funciones matemáticas como el logaritmo o la exponencial.

```python
import math
```

<a id="utilizacion-de-metodos-parametros"></a>
## Utilización de métodos. Parámetros

En el vasto mundo de la programación, los objetos son como las piezas fundamentales que conforman una construcción sólida. Cada objeto es un contenedor de datos y métodos que trabajan juntos para realizar tareas específicas. En esta subunidad didáctica, nos adentramos en el fascinante mundo de cómo utilizar métodos y parámetros dentro de estos objetos.

Los métodos son como las acciones que los objetos pueden realizar. Son funciones asociadas a un objeto que definen su comportamiento. Al igual que una persona puede caminar, correr o saltar, un objeto puede tener métodos para realizar ciertas operaciones. Por ejemplo, si tenemos un objeto de tipo "Coche", podemos definir métodos como "acelerar", "frenar" y "girar".

Los parámetros son los valores que se pasan a estos métodos cuando se invocan. Son como las instrucciones adicionales que proporcionamos para que el método haga algo específico. Por ejemplo, si queremos acelerar nuestro coche, podemos pasar un valor como la velocidad deseada al método "acelerar". De esta manera, el objeto sabe exactamente qué hacer.

La utilización de métodos y parámetros es fundamental en la programación orientada a objetos (POO). Permite una mayor modularidad y reutilización del código. Cada método puede ser invocado por diferentes partes del programa, lo que facilita su mantenimiento y escalabilidad. Además, los parámetros permiten personalizar el comportamiento de los métodos según las necesidades específicas de cada llamada.

En la práctica, trabajar con métodos y parámetros implica una buena planificación y organización. Es importante definir métodos que sean claros, descriptivos y que cumplan con un solo propósito. Además, el uso adecuado de parámetros permite hacer que los métodos sean más flexibles y reutilizables.

La comprensión de cómo utilizar métodos y parámetros es crucial para desarrollar programas eficientes y mantenibles. Al trabajar con objetos, estos elementos nos permiten encapsular funcionalidades relacionadas en una sola unidad, lo que facilita su uso y evita la redundancia del código. Además, el uso de parámetros nos permite adaptar el comportamiento de los métodos según las necesidades específicas de cada situación.

En resumen, la utilización de métodos y parámetros es un concepto fundamental en la programación orientada a objetos. Permite una mayor modularidad, reutilización del código y flexibilidad en el diseño de programas. Al trabajar con estos elementos, podemos crear objetos que sean más potentes y versátiles, lo que facilita su uso y mantenimiento en proyectos de cualquier tamaño.

Esta subunidad didáctica nos introduce en la práctica de cómo utilizar métodos y parámetros dentro de los objetos. A través de ejemplos y explicaciones detalladas, aprenderemos a definir y usar estos elementos para crear programas más eficientes y organizados. Con el tiempo y la práctica, dominaremos esta habilidad esencial que es fundamental en cualquier proyecto de programación orientada a objetos.

### Nota importante

#### Explicación

Este bloque de texto es una nota importante dirigida a aquellos que están creando ejercicios para estudiantes. En esta subunidad, el foco está puesto en cómo utilizar objetos ya existentes dentro del lenguaje de programación elegido, no en crear clases personalizadas desde cero. Los creadores de ejercicios deben asegurarse de que los problemas planteados estén alineados con las habilidades y conocimientos específicos que se están desarrollando según lo indicado en la carpeta de ejercicios 101-Ejercicios. Esta guía es crucial para mantener coherencia y relevancia en el aprendizaje del uso de métodos y parámetros en objetos predefinidos.

```markdown
Nota importante para la generación de ejercicios de esta subunidad:
Esta subunidad trata, no la creación de clases personalizadas, sino la utilización de objetos predeterminados existentes en el propio lenguaje de programación.
Para crear actividades, ajustate al alcance concreto de los ejercicios desarrollados en la carpeta 101-Ejercicios.
```

### Metodos de un objeto

#### Explicación

Este código está importando una biblioteca llamada `math` y le da el alias `matematicas`. Esto significa que puedes usar la función de esta biblioteca sin escribir el nombre largo. En este caso, se utiliza la función `sqrt`, que calcula la raíz cuadrada del número 16 y lo imprime en pantalla. Es importante porque permite realizar cálculos matemáticos avanzados con funciones predefinidas, ahorrando tiempo y evitando errores al implementarlas manualmente.

```python
import math as matematicas

print(matematicas.sqrt(16))
```

### ejemplo más esparcido

#### Explicación

Este código importa el módulo `math` de Python y lo renombra como `matematicas`. Luego, asigna el valor 16 a la variable `numero`. El siguiente paso es calcular la raíz cuadrada del número usando la función `sqrt()` que está dentro del módulo `matematicas`, y almacena este resultado en la variable `raiz`. Finalmente, imprime el valor de `raiz` en pantalla. Este código ilustra cómo usar una función matemática para realizar cálculos más complejos con números, lo cual es muy útil cuando necesitas hacer operaciones como calcular raíces cuadradas o trabajar con valores matemáticos avanzados en tus programas.

```python
import math as matematicas

numero = 16
raiz = matematicas.sqrt(numero)
print(raiz)
```

<a id="utilizacion-de-propiedades"></a>
## Utilización de propiedades

En el mundo de la programación, los objetos son una construcción fundamental que nos permite modelar y representar entidades del mundo real dentro de nuestros programas. Cada objeto es una instancia de una clase, que define su estructura y comportamiento. Los objetos tienen propiedades, que son atributos que almacenan datos sobre el estado del objeto, y métodos, que definen las acciones que puede realizar.

La utilización de propiedades en los objetos es un paso crucial para dar forma a estos entidades dentro de nuestro código. Las propiedades nos permiten almacenar información relevante y manipularla fácilmente. Por ejemplo, si estamos creando una clase `Persona`, podemos definir propiedades como `nombre`, `edad` o `email`. Cada uno de estos atributos almacena un valor específico que describe el estado del objeto.

La manipulación de las propiedades es tan sencilla como acceder a ellas y cambiar su valor. Por ejemplo, si queremos cambiar el nombre de una persona, simplemente asignamos un nuevo valor a la propiedad `nombre`. Esta flexibilidad nos permite interactuar con los objetos de manera intuitiva y natural.

Además de almacenar datos, las propiedades también pueden tener métodos asociados que permiten modificar su estado. Por ejemplo, en nuestra clase `Persona`, podríamos tener un método `cumplirAnios` que aumente el valor de la propiedad `edad`. Esta capacidad nos permite no solo leer los valores actuales de las propiedades, sino también cambiarlos y mantener el objeto en un estado coherente.

La utilización de propiedades es una práctica común en la programación orientada a objetos, ya que facilita la representación y manipulación de datos complejos. Al definir propiedades, estamos creando una forma clara y estructurada de almacenar información dentro de nuestros objetos, lo que hace que nuestro código sea más fácil de entender y mantener.

Además, las propiedades pueden tener modificadores de acceso que controlan quién puede leer o modificar su valor. Por ejemplo, podemos definir una propiedad como `privada`, lo que significa que solo el objeto mismo puede acceder a ella. Esto nos permite ocultar detalles internos del objeto y exponer solo la información relevante al resto del programa.

La utilización de propiedades también facilita la implementación de patrones de diseño, como los getters y setters. Los getters son métodos que devuelven el valor actual de una propiedad, mientras que los setters son métodos que permiten modificar su valor. Esta práctica nos permite agregar lógica adicional al acceso a las propiedades, lo que puede ser útil para validar los valores asignados o realizar acciones adicionales cuando se cambia el estado del objeto.

En resumen, la utilización de propiedades en los objetos es una herramienta poderosa y versátil en la programación orientada a objetos. Nos permite representar y manipular datos complejos de manera intuitiva y estructurada, facilitando la creación de programas robustos y mantenibles. Al dominar el uso de propiedades, podemos mejorar significativamente la calidad y eficiencia de nuestro código, permitiéndonos crear aplicaciones más sofisticadas y funcionales.

### Nota importante

#### Explicación

Este fragmento de texto en Markdown es una nota importante para quienes crean ejercicios relacionados con el tema actual. La nota indica que esta subunidad se centra en cómo utilizar objetos ya existentes dentro del lenguaje de programación, no en la creación de nuevas clases personalizadas. Esto significa que los ejercicios deben enfocarse específicamente en cómo manipular y usar estos objetos predeterminados.

La importancia de este enfoque radica en ayudar a los estudiantes a familiarizarse con las capacidades integradas del lenguaje, lo cual es fundamental antes de avanzar hacia la creación de clases propias. Esta nota también sugiere que cualquier actividad creada debe estar alineada con el contenido y los ejemplos presentados en la carpeta "101-Ejercicios", garantizando así una coherencia entre las tareas y lo aprendido previamente.

```markdown
Nota importante para la generación de ejercicios de esta subunidad:
Esta subunidad trata, no la creación de clases personalizadas, sino la utilización de objetos predeterminados existentes en el propio lenguaje de programación.
Para crear actividades, ajustate al alcance concreto de los ejercicios desarrollados en la carpeta 101-Ejercicios.
```

### tiene propiedades

#### Explicación

Este código importa la parte de Python que se ocupa de las operaciones matemáticas y la renombra como `matematicas`. Luego, el código crea una variable llamada `PI` que contiene el valor del número pi, obtenido de la biblioteca `matematicas`. Finalmente, imprime este valor en pantalla. Es importante porque el número pi es fundamental en muchas áreas de matemáticas y programación, como calcular el área o la circunferencia de un círculo.

```python
import math as matematicas

PI = matematicas.pi

print(PI)
```

<a id="utilizacion-de-metodos-estaticos"></a>
## Utilización de métodos estáticos

En el mundo de la programación, los objetos son una construcción fundamental que nos permite modelar entidades del mundo real dentro de nuestros programas. Cada objeto tiene propiedades (datos) y métodos (funciones), lo que le confiere un comportamiento específico.

Los métodos estáticos son un tipo especial de método que pertenecen a la clase en sí misma, no a una instancia específica del objeto. Esto significa que puedes llamar a estos métodos sin necesidad de crear un objeto de la clase. Son útiles para operaciones que no dependen del estado interno del objeto, como utilidades generales o funciones de conversión.

La principal ventaja de los métodos estáticos es su independencia del contexto del objeto. No requieren acceso a variables de instancia ni a otros métodos de la clase, lo que las hace más fáciles de probar y mantener. Además, pueden ser llamados directamente desde la clase, lo que puede hacer que el código sea más limpio y organizado.

La implementación de un método estático en un lenguaje como Java sería algo así:

```java
public class Matematicas {
    public static int sumar(int a, int b) {
        return a + b;
    }
}
```

Aquí, el método `sumar` es estático y puede ser llamado directamente desde la clase `Matematicas`, sin necesidad de crear una instancia del objeto:

```java
int resultado = Matematicas.sumar(5, 3);
System.out.println("El resultado es: " + resultado);
```

Esta capacidad de llamar a métodos estáticos sin instanciar objetos puede ser muy útil en situaciones donde no necesitas el estado interno del objeto para realizar una tarea. Sin embargo, también es importante recordar que los métodos estáticos no pueden acceder directamente a las variables de instancia ni a otros métodos no estáticos de la misma clase.

La utilización de métodos estáticos puede llevar a un código más limpio y organizado, especialmente cuando se realizan operaciones que son independientes del estado interno del objeto. Sin embargo, es importante mantener una buena separación entre lo que es estático y lo que no lo es para evitar problemas de mantenimiento y confusión en el código.

En resumen, los métodos estáticos son una herramienta poderosa en la programación orientada a objetos, permitiendo realizar operaciones útiles sin necesidad de instanciar objetos. Sin embargo, su uso debe ser cuidadoso para mantener un diseño limpio y coherente en nuestros programas.

### Nota importante

#### Explicación

Este fragmento de código es una nota importante escrita en Markdown que sirve como guía para aquellos que están creando ejercicios relacionados con esta subunidad del curso. La nota indica que, en lugar de enfocarse en la creación de clases personalizadas o nuevas estructuras de datos, el objetivo aquí es aprender a usar los objetos y métodos ya existentes en el lenguaje de programación que se esté utilizando. Esto es importante porque permite a los estudiantes centrarse en comprender cómo funcionan las características integradas del lenguaje antes de avanzar a la creación de sus propias clases y objetos más complejos. La nota también sugiere referirse específicamente a la carpeta 101-Ejercicios para desarrollar ejercicios dentro del alcance correcto y educativo para esta sección específica del curso.

```markdown
Nota importante para la generación de ejercicios de esta subunidad:
Esta subunidad trata, no la creación de clases personalizadas, sino la utilización de objetos predeterminados existentes en el propio lenguaje de programación.
Para crear actividades, ajustate al alcance concreto de los ejercicios desarrollados en la carpeta 101-Ejercicios.
```

### instanciacion

#### Explicación

Este código Python muestra cómo trabajar con listas, que son una estructura de datos que almacena colecciones de elementos. En este caso, la lista se llama `frutas` y contiene tres nombres de frutas: 'platano', 'fresa' y 'naranja'. El primer `print(frutas)` sirve para mostrar en pantalla el contenido original de la lista antes de realizar cualquier cambio.

Luego, el código utiliza el método `sort()` que ordena los elementos de la lista alfabéticamente. Este método modifica directamente la lista existente sin necesidad de crear una nueva. Después de llamar a este método, se imprime nuevamente la lista con `print(frutas)`, lo que muestra ahora las frutas en el orden 'fresa', 'naranja' y 'platano'.

Este ejemplo es importante porque demuestra cómo manipular datos almacenados en listas y cómo usar métodos incorporados para cambiar o analizar esa información, lo cual es fundamental en la programación cuando trabajamos con conjuntos de datos.

```python
frutas = ['platano','fresa','naranja']
print(frutas)
frutas.sort()
print(frutas)
```

### no instancio estatico

#### Explicación

Este fragmento de código crea un diccionario en Python llamado `frutas`. En la primera línea, se utiliza el método estático `dict.fromkeys()` para generar rápidamente este diccionario. Este método toma dos argumentos: una lista (en este caso, ["manzana", "pera", "platano"]) que actúa como conjunto de claves, y un valor por defecto (5 en este ejemplo) que se asignará a todas las claves del nuevo diccionario.

El resultado es un diccionario donde cada fruta ('manzana', 'pera' y 'platano') tiene asociado el número 5 como su valor. Por último, el código imprime este diccionario en la consola para visualizarlo.

Esta técnica es útil cuando necesitas crear rápidamente un diccionario con múltiples claves inicializadas a un mismo valor sin tener que especificar cada par clave-valor manualmente.

```python
frutas = dict.fromkeys(["manzana","pera","platano"],5)
print(frutas)
```

<a id="constructores"></a>
## Constructores

En el mundo de la programación, los constructores son una pieza fundamental que nos permite dar forma a nuestros objetos. Son como las fábricas que crean los productos finales, pero en este caso, los "productos" son instancias de clases. Un constructor es un método especial dentro de una clase que se ejecuta automáticamente cuando se crea una nueva instancia del objeto.

Imagina que tienes una receta para hacer un pastel. La receta es como la clase, y cada vez que quieres preparar un pastel, sigues los pasos descritos en la receta. El constructor sería el primer paso de esta receta, donde especificas todos los ingredientes necesarios y las condiciones iniciales del pastel.

En programación, cuando creamos una instancia de una clase, estamos creando un objeto con todas sus propiedades y métodos definidos. Pero antes de que podamos usar este objeto, es necesario inicializarlo con valores específicos. Es aquí donde entra en juego el constructor. Nos permite establecer los valores iniciales de las variables miembro del objeto.

Por ejemplo, si tienes una clase `Persona` con dos atributos: `nombre` y `edad`, puedes definir un constructor que acepte estos parámetros para inicializarlos cuando se crea una nueva instancia de la clase. De esta manera, cada persona tendrá su propio nombre y edad, configurados según los valores proporcionados al crearla.

Los constructores también pueden tener parámetros por defecto, lo que significa que si no se proporcionan valores al momento de crear el objeto, se utilizarán estos valores predeterminados. Esto nos brinda la flexibilidad de crear objetos con diferentes configuraciones iniciales sin necesidad de sobrecargar nuestro código.

Además, los constructores pueden ser sobrecargados, lo que significa que puedes tener varios métodos constructor dentro de una misma clase, cada uno con un conjunto diferente de parámetros. Esto nos permite crear objetos de la misma clase de diferentes maneras según nuestras necesidades.

Es importante destacar que el constructor es el primer método que se ejecuta cuando creamos una instancia de una clase. Por lo tanto, cualquier inicialización o configuración que necesitemos hacer antes de usar el objeto debe ser realizada en este método.

En resumen, los constructores son un elemento esencial en la programación orientada a objetos. Nos permiten crear y configurar objetos con valores iniciales específicos, facilitando así su uso y manipulación en nuestro código. Al entender cómo funcionan y cómo utilizarlos de manera efectiva, podemos mejorar significativamente la calidad y eficiencia de nuestras aplicaciones.

### Nota importante

#### Explicación

Este fragmento de código es un archivo Markdown que sirve como nota importante para profesores o diseñadores de contenidos. En él se indica que esta subunidad del curso no requiere la creación de clases personalizadas, sino que los estudiantes deben utilizar objetos ya existentes en el lenguaje de programación específico que estén aprendiendo. La recomendación es que al crear ejercicios prácticos para los estudiantes, estos deberían centrarse en el uso y comprensión de esos objetos predeterminados y seguir las guías proporcionadas en la carpeta "101-Ejercicios". Esto ayuda a mantener una coherencia con el alcance del programa educativo y asegura que los ejercicios sean relevantes para lo que se está enseñando específicamente en esta subunidad.

```markdown
Nota importante para la generación de ejercicios de esta subunidad:
Esta subunidad trata, no la creación de clases personalizadas, sino la utilización de objetos predeterminados existentes en el propio lenguaje de programación.
Para crear actividades, ajustate al alcance concreto de los ejercicios desarrollados en la carpeta 101-Ejercicios.
```

<a id="destruccion-de-objetos-y-liberacion-de-memoria"></a>
## Destrucción de objetos y liberación de memoria

En el vasto universo de la programación, los objetos son como personajes vivos que interactúan entre sí en un escenario digital. Cada objeto tiene su propia identidad, características y comportamientos, pero también es parte del sistema más amplio conocido como la memoria del programa.

La destrucción de objetos y la liberación de memoria es una tarea crucial que los programadores deben entender y manejar con cuidado. Es como cuando un personaje muere en una historia: su vida se termina, pero su impacto puede seguir siendo sentido por el resto del mundo. En la programación, cuando un objeto deja de ser necesario o no es accesible desde ninguna parte del programa, debe ser eliminado para liberar los recursos que ocupaba.

La destrucción de objetos ocurre automáticamente en muchos lenguajes de programación modernos, gracias a lo que se conoce como recolección de basura. Este proceso automático busca y elimina los objetos que ya no son utilizados, asegurando que el programa no se quede sin espacio para nuevos objetos o variables.

Sin embargo, en algunos lenguajes, como Java o C++, la destrucción de objetos debe ser gestionada manualmente. Es como si tuviéramos que controlar cada muerte en una historia: cuando un personaje muere, debemos asegurarnos de que su vida se termina y no deje rastro.

La liberación de memoria es el siguiente paso crucial después de la destrucción del objeto. Es como recoger los objetos eliminados y colocarlos en un cesto para reciclaje. En la programación, esto implica limpiar la memoria ocupada por los objetos que ya no son necesarios, asegurando que el programa no se quede sin espacio.

La gestión de la destrucción de objetos y la liberación de memoria es importante porque puede afectar significativamente el rendimiento del programa. Si no se maneja correctamente, puede llevar a problemas como fugas de memoria, donde el programa consume más memoria de la necesaria, o incluso a errores graves que pueden hacer que el programa se detenga.

Para evitar estos problemas, los programadores deben entender cómo funciona la recolección de basura y aprender a gestionar manualmente la destrucción de objetos en lenguajes como Java o C++. También es crucial realizar pruebas exhaustivas para asegurar que no hay fugas de memoria ni errores relacionados con la gestión de memoria.

En resumen, la destrucción de objetos y la liberación de memoria son procesos fundamentales en la programación. Aunque pueden parecer complicados al principio, una comprensión profunda de estos conceptos puede ayudar a los programadores a crear programas más eficientes y seguros. Es como saber cómo manejar bien las muertes en una historia: es una parte importante del proceso, pero también es necesario para que la historia continúe sin problemas.

### Nota importante

#### Explicación

Este fragmento de código es una nota importante escrita en Markdown que se encuentra en un archivo de texto dentro de una estructura de carpetas. La nota indica que esta subunidad del curso no se centra en la creación de clases personalizadas, sino más bien en el uso de objetos ya existentes proporcionados por el lenguaje de programación utilizado (por ejemplo, Python, JavaScript, etc.). Además, sugiere a los creadores de ejercicios que deben ajustarse al alcance específico establecido para cada ejercicio, lo cual puede encontrarse en la carpeta 101-Ejercicios. Es importante seguir esta guía para mantener coherencia y relevancia en el desarrollo de actividades educativas para los estudiantes.

```markdown
Nota importante para la generación de ejercicios de esta subunidad:
Esta subunidad trata, no la creación de clases personalizadas, sino la utilización de objetos predeterminados existentes en el propio lenguaje de programación.
Para crear actividades, ajustate al alcance concreto de los ejercicios desarrollados en la carpeta 101-Ejercicios.
```

<a id="ejercicio-de-final-de-unidad-1"></a>
## Ejercicio de final de unidad

### actividad

#### Explicación

Lo siento, pero no has proporcionado ningún fragmento de código en el formato Markdown para analizar. Si deseas que explique un trozo específico de código o contenido dentro del archivo .md, por favor compártelo y estaré encantado de ayudarte a entenderlo.

```markdown

```


<a id="uso-de-estructuras-de-control"></a>
# Uso de estructuras de control

<a id="estructuras-de-seleccion"></a>
## Estructuras de selección

En el vasto mundo de la programación, las estructuras de control son como los pilares que sostienen la construcción de nuestros programas. Esenciales para organizar y dirigir el flujo de ejecución, estas estructuras nos permiten tomar decisiones basadas en condiciones específicas, lo que es fundamental para crear software inteligente y adaptable.

La carpeta `001-Estructuras de selección` del módulo `Programación/003-Uso de estructuras de control` se centra precisamente en este concepto crucial. Aquí, los estudiantes encontrarán una introducción a las decisiones que el programa debe tomar según ciertas condiciones. Es como un jardín de preguntas y respuestas, donde cada pregunta (condición) determina la rama por la que seguirá nuestro código.

La primera lección del submódulo nos introduce al concepto básico de estructuras de selección, destacando cómo estas permiten que el programa ejecute diferentes bloques de código dependiendo de si una condición es verdadera o falsa. Es como un camino bifurcado en la selva digital, donde cada sendero representa una posible ruta para seguir.

La siguiente lección profundiza en las estructuras `if`, `else` y `elif`, enseñándonos cómo estas herramientas nos permiten expresar decisiones complejas. Aprenderemos a construir sentencias que evalúan múltiples condiciones, creando un laberinto de posibilidades dentro de nuestro programa.

La carpeta también incluye ejemplos prácticos y problemas resueltos, ilustrando cómo aplicar estas estructuras en situaciones reales. A través de estos ejercicios, los estudiantes pueden experimentar la magia de las decisiones programáticas, comprobando cómo un simple cambio en una condición puede alterar completamente el comportamiento del programa.

Además, se aborda el tema de la optimización y la eficiencia en la selección de estructuras. Aprenderemos que no todas las estructuras son iguales, y que elegir la adecuada depende del contexto y de los requisitos específicos del problema a resolver. Es como seleccionar el mejor camino para llegar a un destino, considerando factores como la distancia, el tiempo y las condiciones meteorológicas.

La carpeta también destaca la importancia de la legibilidad y la mantenibilidad en la programación. Aprenderemos que una buena estructura de selección no solo debe funcionar correctamente, sino que también debe ser fácil de entender y modificar por otros desarrolladores. Es como construir un castillo de bloques de construcción: cada pieza debe tener su lugar y significado para que todo funcione armoniosamente.

Finalmente, se exploran los conceptos avanzados de las estructuras de selección, incluyendo el uso de operadores lógicos y la creación de estructuras anidadas. Aprenderemos cómo combinar múltiples condiciones en una sola sentencia, creando un jardín de posibilidades infinitas dentro de nuestro programa.

En resumen, la carpeta `001-Estructuras de selección` es un viaje emocionante por el mundo de las decisiones programáticas. Desde los conceptos básicos hasta las técnicas avanzadas, ofrece una comprensión profunda y práctica del poder de las estructuras de control en la programación. Es como descubrir cómo crear un laberinto digital que nos lleve a cualquier lugar que desee, siempre y cuando sepamos cómo tomar las decisiones correctas en cada paso del camino.

### programacion paso a paso

#### Explicación

Este código es muy sencillo y directo. En él, se utilizan tres líneas de código para imprimir mensajes en la pantalla. Cada línea utiliza la función `print()` para mostrar un texto específico. El primer mensaje que aparece es "este es el paso 1", seguido del segundo mensaje, "este es el paso 2" y finalmente el tercer mensaje, "este es el paso 3". Este tipo de código es fundamental para entender cómo se muestran datos en la consola cuando estás programando. Es importante porque te permite verificar que tu programa está funcionando correctamente a medida que avanzas en su desarrollo.

```python
print("este es el paso 1")
print("este es el paso 2")
print("este es el paso 3")
```

### estructura if

#### Explicación

Este fragmento de código en Python muestra cómo usar la estructura `if` para realizar una acción condicional. Primero, se imprime el mensaje "Mi nombre es Jose Vicente" utilizando la función `print()`. Luego, se establece una variable llamada `edad` con un valor de 47. A continuación, se utiliza la estructura `if` para comprobar si la edad es menor que 30. Si la condición es verdadera (es decir, si la edad es efectivamente menor a 30), entonces el código imprime "Eres un joven!". En este caso, ya que la edad es 47 y no cumple con la condición de ser menor a 30, el mensaje dentro del `if` no se imprimirá. Esta estructura `if` permite al programa tomar decisiones basadas en condiciones específicas, lo cual es fundamental para controlar el flujo de ejecución en la programación.

```python
print("Mi nombre es Jose Vicente")
edad = 47

if edad < 30:
  print("Eres un joven!")
```

### else

#### Explicación

Este fragmento de código está diseñado para mostrar cómo funcionan las estructuras condicionales en Python, específicamente el uso del bloque `if-else`. El programa comienza imprimiendo el nombre "Mi nombre es Jose Vicente" en la pantalla. Luego, se define una variable llamada `edad` y se le asigna el valor 47.

A continuación, el código verifica si la edad almacenada en la variable `edad` es menor que 30 años. Si esta condición es verdadera (es decir, si la persona tiene menos de 30 años), el programa imprime "Eres un joven!". Sin embargo, si la condición no se cumple (la persona tiene 30 o más años), el programa ejecuta lo que está dentro del bloque `else` y muestra en pantalla "Ya no eres un joven". Este tipo de estructura es útil para tomar decisiones basadas en diferentes condiciones y permite que los programas respondan de manera diferente según la información proporcionada.

```python
print("Mi nombre es Jose Vicente")
edad = 47

if edad < 30:
  print("Eres un joven!")
else:
  print("Ya no eres un joven")
```

### else if

#### Explicación

Este código es una secuencia que utiliza estructuras de control para imprimir diferentes mensajes dependiendo de la edad del usuario. Primero, el programa imprime en pantalla "Mi nombre es Jose Vicente". Luego, establece la variable `edad` con valor 47.

El corazón del código está en las estructuras `if`, `elif` (que significa "else if") y `else`. Estas se utilizan para evaluar diferentes rangos de edad y determinar cuál mensaje imprimir. Si la edad es menor que 10, imprime "Eres un niño!". Si no, comprueba si la edad está entre 10 y 20 años (incluyendo el 10 pero excluyendo el 20) e imprime "Eres un adolescente". Luego, verifica si la edad es de al menos 20 hasta menos de 30 años para imprimir "Eres un joven".

Si ninguna de las condiciones anteriores se cumple (es decir, la edad es 30 o mayor), el código ejecuta la cláusula `else` y muestra en pantalla "Ya no eres un joven". Esta estructura permite al programa tomar decisiones basadas en rangos específicos de valores.

Este tipo de estructuras son muy útiles en programación para permitir que nuestros programas tomen distintas ramificaciones dependiendo de las condiciones, lo cual es clave para crear software interactivo y adaptable.

```python
print("Mi nombre es Jose Vicente")
edad = 47

if edad < 10:
  print("Eres un niño!")
elif edad >= 10 and edad < 20:
  print("Eres un adolescente")
elif edad >= 20 and edad < 30:
  print("Eres un joven")
else:
  print("Ya no eres un joven")
```

### entrada

#### Explicación

Este código es una pequeña aplicación que te ayuda a determinar en qué categoría de edad te encuentras según el número que ingreses. Primero, muestra un mensaje amigable que invita al usuario a introducir su edad. Luego, captura lo que el usuario teclea y lo guarda en la variable `edad`, pero inicialmente esta es un texto (string). A continuación, convierte esa entrada de texto a un número entero para poder realizar comparaciones numéricas.

El programa utiliza una estructura de control llamada "if-elif-else" que revisa condiciones específicas y decide qué mensaje imprimir dependiendo de la edad ingresada. Si tu edad es menor a 10, te dirá que eres un niño; si estás entre 10 y 20 años, serás catalogado como adolescente; y si tienes entre 20 y 30 años, serás considerado joven. Si no corresponde a ninguna de estas categorías (por ejemplo, si tienes más de 30 años), el programa simplemente te informará que ya no eres un joven.

Este tipo de estructuras esenciales permiten al software tomar decisiones basadas en la información ingresada por los usuarios, lo cual es muy útil para crear programas interactivos y personalizados.

```python
print("Clasificador incómodo por edades")
edad = input("Introduce tu edad: ")         # Por defecto devuelve string
edad = int(edad)

if edad < 10:
  print("Eres un niño!")
elif edad >= 10 and edad < 20:
  print("Eres un adolescente")
elif edad >= 20 and edad < 30:
  print("Eres un joven")
else:
  print("Ya no eres un joven")
```

### simulacro de actividad

#### Explicación

Este programa es una herramienta sencilla que ayuda a clasificar a los pilotos en función de la posición en la que han quedado tras una carrera. El usuario debe ingresar su posición final como un número, y el programa mostrará un mensaje específico dependiendo del puesto ocupado.

El programa comienza pidiéndote que introduzcas tu posición final en la carrera. Luego, convierte esa entrada de texto a un número entero para poder hacer comparaciones numéricas con ella. A continuación, utiliza una serie de condiciones (if, elif y else) para determinar el mensaje apropiado basado en el valor que has introducido:

- Si tu posición es 1, recibirás la felicitación por ser campeón.
- Si obtienes el segundo o tercer lugar, te felicitarán por subir al podio.
- Si clasificas entre el cuarto y el décimo puesto, se informará que has conseguido puntos en el campeonato.
- Finalmente, si no consigues un puesto dentro del top 10, recibes una motivación para seguir trabajando duro.

Este tipo de programa es útil porque proporciona retroalimentación inmediata y personalizada basada en los resultados, lo que puede ser muy motivador o desafiante según la posición obtenida.

```python
'''
  Programa clasificador de pilotos
  (c) 2025 Jose Vicente Carratala
  Este programa clasifica a los pilotos de carreras
'''

# Importaciones: Este programa no necesita importaciones


# Variables  globales
posicion_final = ""
mensaje = ""

# Clases / funciones: este programa no necesita clases o funciones

## Método o función principal
# Introducción de datos
posicion_final = input("Introduce la posición en la que has quedado: ")
posicion_final = int(posicion_final) # Tengo que convertir la cadena a numero entero
# Realización de cálculos
if posicion_final == 1:
  mensaje = "¡Eres el campeón de la carrera!"
elif posicion_final == 2 or posicion_final == 3:
  mensaje = "Subes al podio, gran trabajo."
elif posicion_final >=4 and posicion_final <=10:
  mensaje = "Has puntuado en el campeonato."
elif posicion_final >=11:
  mensaje = "No conseguiste puntos esta vez, sigue entrenando."
  
# Impresión de respuestas
print(mensaje)
```

<a id="estructuras-de-repeticion"></a>
## Estructuras de repetición

En el vasto mundo de la programación, las estructuras de control son como los pilares que sostienen una construcción. Una de estas estructuras es la repetición, un concepto fundamental que permite a los programas realizar acciones múltiples veces bajo ciertas condiciones. En esta subunidad didáctica, nos adentramos en el estudio de las estructuras de repetición, que son herramientas poderosas para automatizar tareas y optimizar procesos.

La primera estructura de repetición que exploramos es la **sentencia `for`**. Esta estructura se utiliza cuando sabemos exactamente cuántas veces queremos que un bloque de código se ejecute. Es como decirle a tu robot: "Repite esto 10 veces". La sintaxis de una sentencia `for` suele ser sencilla y directa, permitiendo definir el número de repeticiones con precisión.

Después de la sentencia `for`, nos encontramos con la **sentencia `while`**. Esta estructura es más flexible que la anterior, ya que se ejecuta mientras una condición específica sea verdadera. Es como decirle a tu robot: "Haz esto mientras no llegues al final del camino". La ventaja de esta estructura radica en su capacidad para manejar situaciones donde el número exacto de repeticiones es incierto o depende de ciertos eventos.

La subunidad también aborda la importancia de **la optimización de bucles**. Aunque las estructuras de repetición son útiles, su uso excesivo puede llevar a problemas de rendimiento. Es como cuando intentas recoger una cesta de juguetes con un solo brazo: es posible, pero no eficiente. La optimización implica encontrar el equilibrio perfecto entre la cantidad de repeticiones y la eficiencia del código.

Además, se introduce el concepto de **la sentencia `break`** y la **sentencia `continue`**. Estas sentencias son como los comandos especiales en un juego: `break` es como decirle a tu robot: "Detente todo ahora", mientras que `continue` es como decirle: "Pasa al siguiente turno, pero no hagas nada más". Son herramientas valiosas para controlar el flujo de ejecución dentro de los bucles.

La subunidad también explora la **programación funcional** y cómo las estructuras de repetición pueden ser utilizadas en este paradigma. En programación funcional, las funciones son ciudadanos de primera clase, lo que significa que se pueden tratar como cualquier otro tipo de dato. Las estructuras de repetición pueden ser implementadas mediante funciones recursivas o utilizando bibliotecas específicas.

Finalmente, la subunidad concluye con ejercicios prácticos diseñados para aplicar los conocimientos adquiridos sobre las estructuras de repetición. Estos ejercicios son como el desafío final en un juego: requieren práctica y paciencia para resolverlos correctamente. A través de estos ejercicios, los estudiantes pueden experimentar la eficacia de las estructuras de repetición en diferentes contextos y aprender a optimizar su uso.

En resumen, esta subunidad didáctica es una introducción profunda a las estructuras de repetición en programación. Desde el concepto básico hasta técnicas avanzadas y aplicaciones prácticas, cada capítulo proporciona un paso más hacia la comprensión completa de cómo controlar el flujo de ejecución en los programas.

### for

#### Explicación

Este código utiliza un bucle `for` en Python para imprimir una frase que indica el día del mes durante todo el mes. La función `range(1, 31)` genera una secuencia de números desde 1 hasta 30, lo que significa que el bucle se ejecutará 30 veces. En cada iteración, la variable `dia` toma un valor diferente según la secuencia generada por `range`. El comando `print("Hoy es el dia", dia, "del mes")` muestra en pantalla una frase con el número del día que cambia en cada vuelta del bucle.

Este tipo de estructura es muy útil cuando necesitas realizar una tarea repetitiva durante un período definido, como recorrer todos los días de un mes o contar desde un inicio hasta un final específico. Ayuda a automatizar tareas y evita la escritura manual tediosa de instrucciones similares para cada día del mes.

```python
for dia in range(1,31):
  print("Hoy es el dia",dia,"del mes")
```

### primera anidacion

#### Explicación

Este código utiliza estructuras de repetición anidadas para imprimir una frase que indica la fecha en formato "día del mes" para cada combinación posible de días y meses dentro de un año. La parte externa del bucle `for` recorre los números de 1 a 12, representando los meses del año. Dentro de este bucle, hay otro bucle `for` que itera sobre los números de 1 a 30, simbolizando los días de cada mes (aunque algunos meses tienen menos de 30 días, este código asume que todos tienen hasta 30). En cada iteración del bucle interno, se imprime la frase con el día y el mes actuales. Este tipo de estructura es útil para generar fechas sistemáticas o realizar tareas repetitivas basadas en un calendario simplificado.

```python
for mes in range(1,13):
  for dia in range(1,31):
    print("Hoy es el dia",dia,"del mes",mes)
```

### segunda anidacion

#### Explicación

Este fragmento de código Python muestra un ejemplo práctico del uso de estructuras de repetición anidadas. El objetivo principal es imprimir una frase que indica la fecha en formato "día, mes y año" para cada combinación posible dentro de ciertos límites: desde el día 1 hasta el día 30 (aunque no considera febrero ni años bisiestos), del mes 1 al mes 12, y del año 1978 hasta el año 2025.

El código utiliza tres bucles "for" anidados: uno para los años que comienza en 1978 y termina en 2025 (el rango no incluye al final 2026), otro para los meses de enero a diciembre, y el último para los días desde el primero hasta el trigésimo. Para cada combinación única de año, mes y día, la función `print` muestra un mensaje que indica la fecha actual.

Es importante notar que este código imprime fechas con un día que va hasta el 30, lo cual es inexacto ya que algunos meses tienen menos días (por ejemplo, febrero en años no bisiestos). Sin embargo, como ejercicio para estudiantes de programación, ayuda a entender cómo funcionan las estructuras anidadas y la manipulación básica de datos.

```python
for anio in range(1978,2026):
  for mes in range(1,13):
    for dia in range(1,31):
      print("Hoy es el dia",dia,"del mes",mes,"del año",anio)
```

### while

#### Explicación

Este código en Python muestra cómo utilizar un bucle `while` para repetir una acción varias veces. En este caso, la acción es imprimir en pantalla "hoy es el día [número] del mes". La variable `dia`, inicializada con el valor 1, se utiliza como condición de paro: mientras `dia` sea menor que 31, el bucle seguirá ejecutándose y mostrando el número actual del día. Después de imprimir cada mensaje, la variable `dia` aumenta en uno mediante una instrucción implícita (generalmente después del bloque print habría un incremento como `dia = dia + 1`, aunque aquí se asume que es parte integrante del flujo lógico del bucle). Este tipo de estructura es importante porque permite automatizar tareas repetitivas, como en este caso contar o marcar los días sucesivos de un mes.

```python
dia = 1
while dia < 31:
  print("hoy es el dia",dia,"del mes")
```

### le tenemos que decir cual es el final

#### Explicación

Este fragmento de código utiliza un bucle `while` para imprimir una frase que indica cuál día del mes es, desde el primer día hasta el trigésimo. La variable `dia`, inicializada con el valor 1 al comienzo, se incrementa en uno cada vez que se ejecuta el bucle, gracias a la línea `dia += 1`. El bucle continúa mientras `dia` sea menor que 31 (`while dia < 31:`), lo que significa que imprimirá una frase para los primeros 30 días del mes. Este tipo de estructura es útil cuando necesitas repetir acciones durante un número específico de veces, como contar o marcar eventos diarios en un calendario.

```python
dia = 1
while dia < 31:
  print("hoy es el dia",dia,"del mes")
  dia += 1
```

<a id="estructuras-de-salto"></a>
## Estructuras de salto

En el vasto universo de la programación, las estructuras de control son como los pilares que sostienen la construcción de algoritmos. Estas estructuras permiten a los programadores dirigir el flujo de ejecución del programa según ciertas condiciones o patrones específicos. En esta subunidad didáctica, nos adentramos en el fascinante mundo de las estructuras de salto, que son un elemento fundamental para controlar la dirección y velocidad de la ejecución de nuestro código.

La primera estructura de salto que exploramos es el `if-else`, una construcción que permite tomar decisiones basadas en condiciones booleanas. Este esencialmente dice: "Si esta condición se cumple, realiza esto; si no, realiza algo diferente". Es como un interruptor que decide qué camino seguir según las circunstancias.

El siguiente paso en nuestro viaje por las estructuras de salto es el `switch-case`, una alternativa más eficiente para múltiples condiciones. Este tipo de estructura permite evaluar una expresión y ejecutar diferentes bloques de código dependiendo del valor de esa expresión. Es como tener varias puertas que conducen a diferentes habitaciones, pero solo una se abre según el valor de la llave.

La importancia de las estructuras de salto no puede ser subestimada. Nos permiten crear programas que respondan dinámicamente a los cambios en el entorno y que tomen decisiones basadas en datos variables. Estas estructuras son esenciales para implementar algoritmos complejos, manejar errores y excepciones, y optimizar la eficiencia del código.

Además de las estructuras básicas `if-else` y `switch-case`, también exploramos el uso de bucles, que son una forma poderosa de repetir un bloque de código hasta que se cumpla una condición específica. Los bucles `for` e `while` nos permiten automatizar tareas repetitivas y procesar listas o conjuntos de datos de manera eficiente.

La comprensión y uso adecuado de las estructuras de salto es crucial para cualquier programador, ya que son la base sobre la cual se construyen algoritmos complejos y programas robustos. Cada estructura tiene sus propias características y ventajas, y aprender a elegir la más apropiada en cada situación es una habilidad valiosa.

A medida que avanzamos en nuestra exploración de las estructuras de control, nos encontraremos con técnicas más sofisticadas como el `break` y el `continue`, que nos permiten alterar el flujo de ejecución dentro de bucles. El `break` nos ayuda a salir prematuramente de un bucle cuando se cumple una condición específica, mientras que el `continue` nos permite saltar a la siguiente iteración sin ejecutar el resto del código dentro del bucle.

Finalmente, es importante destacar que las estructuras de salto no son solo herramientas técnicas; también son fundamentos para la lógica y la pensamiento computacional. Aprender a controlar el flujo de ejecución con precisión nos prepara para abordar problemas complejos en programación y crear soluciones eficientes y efectivas.

En conclusión, las estructuras de salto son una parte esencial del lenguaje de la programación, permitiendo a los desarrolladores controlar el flujo de ejecución de manera precisa y eficiente. A través de esta subunidad didáctica, hemos explorado sus fundamentos y aplicaciones, preparándonos para enfrentar desafíos más complejos en el mundo del desarrollo de software.

### break

#### Explicación

Este código muestra cómo utilizar un bucle `while` infinito junto con la instrucción `break` en Python. La variable `dia` se inicializa en 1, y luego comienza un bucle que se repite indefinidamente (`while True:`). En cada iteración del ciclo, el programa imprime cuál es el día actual (desde el primer hasta el trigésimo primer día) y aumenta el valor de `dia` en uno. Cuando la variable `dia` supera el número 31, se ejecuta la instrucción `break`, lo que rompe el bucle e interrumpe la repetición del código.

Esta estructura es importante porque permite controlar precisamente cuándo debe terminar un bucle infinito, evitando que se ejecute de manera indefinida y consuma recursos innecesariamente. En este caso específico, aseguramos que el programa solo imprima los días hasta 31, simulando la duración típica de un mes en muchos países, aunque el bucle podría continuar si no hubiera una condición `if dia > 31:` para detenerlo con `break`.

```python
dia = 1
while True:
  print("hoy es el dia",dia,"del mes")
  dia += 1
  if dia > 31:
    break
```

### mi primera funcion

#### Explicación

Este código es una función básica en Python que se llama `dihola`. Una función en programación es un bloque de código reutilizable diseñado para realizar una tarea específica. En este caso, cuando llamas a la función `dihola()`, lo que hace es imprimir el mensaje "Hola, yo te saludo" en la pantalla. Es importante porque permite organizar y simplificar tu programa al encapsular acciones específicas dentro de bloques reutilizables de código, facilitando así su mantenimiento y lectura.

```python
def dihola():
  print("Hola, yo te saludo")
  
```

### ejecuto la funcion

#### Explicación

Este fragmento de código en Python muestra cómo se define y ejecuta una función simple. La función se llama `diHola` y su tarea es imprimir el mensaje "Hola, yo te saludo" cuando sea llamada. Cuando defines una función, estás creando un bloque de código que puedes reutilizar varias veces durante la ejecución del programa sin tener que volver a escribirlo desde cero. En este caso, después de definir `diHola()`, el programa llama a esta función con la línea `diHola()` lo que hace que se imprima el saludo en pantalla. Este es un ejemplo básico pero fundamental de cómo organizar y reutilizar código en Python, lo cual es una habilidad clave en programación ya que ayuda a mantener el código limpio y fácil de entender.

```python
def diHola():
  print("Hola, yo te saludo")
  
diHola()
```

### parametros

#### Explicación

Este fragmento de código muestra cómo se define y utiliza una función en Python. La función se llama `diHola` y su propósito es imprimir un saludo que incluye el nombre que le pasas como argumento. Dentro de la definición de la función, hay una línea `print("Hola,",nombre," yo te saludo")`, lo cual significa que cuando llamas a esta función con un nombre entre paréntesis (como `"Jose Vicente"` o `"Juan"`), el programa mostrará en pantalla un mensaje que dice "Hola, [nombre] yo te saludo". Es importante entender cómo definir y usar funciones porque permiten reutilizar código de manera eficiente y hacer que el programa sea más organizado y fácil de mantener.

```python
def diHola(nombre):
  print("Hola,",nombre," yo te saludo")
  
diHola("Jose Vicente")
diHola("Juan")
```

### varios parametros

#### Explicación

Este fragmento de código es una función simple en Python que muestra cómo definir y utilizar funciones con parámetros. La función se llama `diHola` y toma dos argumentos: `nombre` y `edad`. Dentro de la función, el programa imprime un saludo personalizado que incluye el nombre y la edad proporcionados como argumento.

Cuando llamas a esta función con diferentes valores, en este caso "Jose Vicente" y 47 para la primera llamada, y "Juan" y 48 para la segunda, se ejecuta lo que está dentro de la función utilizando esos datos específicos. Esto significa que cada vez que llames a `diHola` con distintos nombres y edades, obtendrás saludos personalizados en la salida del programa.

Esta técnica es muy útil porque permite reutilizar bloques de código complejos sin tener que escribir el mismo código varias veces, simplemente cambiando los datos (parámetros) que se pasan a la función.

```python
def diHola(nombre,edad):
  print("Hola,",nombre,"tienes",edad,"años y yo te saludo")
  
diHola("Jose Vicente",47)
diHola("Juan",48)
```

### las funciones deben retornar

#### Explicación

Este código muestra cómo funciona una función en Python llamada `diHola`. La función toma dos parámetros: un nombre (que es una cadena de texto) y una edad (un número entero). Dentro de la función, se utiliza el comando `return` para enviar una frase completa como resultado. Esta frase incluye el nombre que se le pasó a la función, junto con su edad convertida en una cadena de texto usando la función `str()`, lo cual es necesario porque las operaciones de concatenación solo funcionan entre cadenas.

Después de definir la función, se llaman dos veces. En cada llamada, se pasa un nombre y una edad diferente a la función `diHola`. Lo que hace la función es devolver una saludo personalizado que luego se imprime en pantalla usando el comando `print()`. Esta estructura ayuda a los programadores a reutilizar código de manera eficiente, ya que no necesitan escribir nuevamente el mismo bloque de código cada vez que quieren saludar a alguien con su edad; simplemente llaman a la función y le proporcionan los datos necesarios.

```python
def diHola(nombre,edad):
  return "Hola, "+nombre+" tienes "+str(edad)+" años y yo te saludo"
  
print(diHola("Jose Vicente",47))
print((diHola("Juan",48)))
```

<a id="control-de-excepciones"></a>
## Control de excepciones

En el mundo de la programación, las excepciones son como los obstáculos inesperados que aparecen mientras nuestro programa intenta ejecutar sus instrucciones. Estos obstáculos pueden surgir por muchas razones: un error en una operación matemática, la lectura de un archivo que no existe o incluso la interrupción del usuario. El control de excepciones es una técnica fundamental que nos permite manejar estos problemas de manera eficiente y prevenir que el programa se bloquee.

La gestión de excepciones comienza con la identificación de los posibles errores en nuestro código. Cada error tiene un tipo específico, como `ValueError` para errores relacionados con valores inapropiados o `FileNotFoundError` cuando intentamos acceder a un archivo que no existe. Una vez identificados estos tipos de errores, podemos programar respuestas específicas para cada uno.

El bloque `try-except` es la herramienta principal para manejar excepciones en Python. En este bloque, colocamos el código que podría generar una excepción dentro del bloque `try`, y luego definimos cómo responder a esa excepción en el bloque `except`. Si ocurre una excepción durante la ejecución del código en `try`, el flujo de control inmediatamente salta al bloque `except` correspondiente.

Además de manejar excepciones, también es importante saber cómo crear nuestras propias excepciones personalizadas. Esto nos permite expresar con precisión los errores específicos que ocurren en nuestro programa y proporcionar mensajes útiles para el usuario o el desarrollador. Para crear una excepción personalizada, simplemente definimos una nueva clase que herede de la clase base `Exception`.

El control de excepciones también implica la gestión de recursos. A menudo, cuando abrimos un archivo o establecemos una conexión a una base de datos, es crucial asegurarnos de que estos recursos se liberen correctamente incluso si ocurren errores. Para hacer esto, usamos el bloque `finally`, que siempre se ejecuta después del bloque `try-except`, independientemente de si ocurrió una excepción o no.

La importancia del control de excepciones en la programación es inmensa. No solo ayuda a prevenir que nuestro programa se bloquee debido a errores, sino que también mejora su robustez y fiabilidad. Al manejar adecuadamente las excepciones, podemos proporcionar experiencias más seguras y fáciles para los usuarios finales.

Además de la gestión de excepciones, es crucial entender cómo usar el registro de errores. El registro nos permite capturar información sobre los errores que ocurren en nuestro programa, lo que facilita su diagnóstico y solución. Python ofrece varias bibliotecas para el registro de errores, como `logging`, que nos permiten configurar diferentes niveles de detalle y formatos de salida.

El control de excepciones también es fundamental para la implementación de políticas de seguridad en nuestros programas. Al capturar y manejar adecuadamente las excepciones, podemos prevenir accesos no autorizados o operaciones peligrosas que podrían comprometer la integridad del sistema.

En resumen, el control de excepciones es una habilidad esencial en la programación. Nos permite manejar errores inesperados de manera eficiente y prevenir que nuestro programa se bloquee. Al aprender a identificar, capturar y gestionar excepciones, podemos crear programas más seguros, robustos y fáciles de mantener.

### dvision legal

#### Explicación

Este código es muy sencillo y directo. Solo realiza una operación matemática básica: divide el número 4 por el número 3 y luego muestra el resultado en la pantalla mediante la función `print()`. Lo que hace este programa es tomar dos números enteros, en este caso 4 y 3, y calcular su división. El resultado de esta división es un número decimal (1.3333333333333333), que luego se imprime en la consola o terminal donde esté ejecutando el programa.

Este tipo de código ilustra cómo hacer cálculos aritméticos simples en Python y cómo mostrar los resultados utilizando funciones como `print()`. Es importante entender estos conceptos básicos para poder avanzar a operaciones más complejas y al manejo de errores que puedan surgir, por ejemplo, si se intenta dividir entre cero.

```python
print(4/3)
```

### division por cero

#### Explicación

Este fragmento de código intenta realizar una división por cero, que es matemáticamente indefinida y en la programación causa un error. Cuando se ejecuta `print(4/0)`, Python generará un error llamado "ZeroDivisionError", deteniendo abruptamente la ejecución del programa porque no puede continuar si no resolvemos este problema inmediatamente.

A pesar de que el código muestra que el programa continúa después del mensaje, en realidad esto nunca sucederá debido al error anterior. En un entorno real de desarrollo, es fundamental manejar estos errores para asegurar que las partes restantes del programa puedan ejecutarse sin problemas. Manejar excepciones permite a los programas ser más robustos y capaces de lidiar con situaciones inesperadas como esta división por cero.

```python
print(4/0)

print("Bueno pero por lo menos el programa continua")
```

### try

#### Explicación

Este fragmento de código muestra cómo manejar errores en Python utilizando bloques `try` y `except`. La función principal del bloque `try` es ejecutar una sección específica del código que podría generar un error, mientras que el bloque `except` captura ese error y permite al programa seguir funcionando. En este caso, la línea dentro de `try` intenta dividir el número 4 entre cero, lo cual no es posible en matemáticas y genera un error en Python. El bloque `except`, por su parte, atrapa este error sin detener el programa, simplemente imprimiendo un mensaje que indica la presencia del error pero asegura que el programa continúa ejecutándose.

Es importante entender esta estructura porque ayuda a crear programas más robustos y capaces de manejar situaciones inesperadas de manera elegante, mejorando así la experiencia del usuario al evitar interrupciones bruscas en la ejecución del código.

```python
try:
  print(4/0)
except:
  print("Hay un error pero por lo menos continuo con el programa")

print("Bueno pero por lo menos el programa continua")
```

<a id="aserciones"></a>
## Aserciones

En el mundo de la programación, las aserciones son una herramienta poderosa que nos permite verificar la integridad del programa durante su ejecución. Estas declaraciones condicionales permiten comprobar si ciertas condiciones son verdaderas o no, y en caso de que no lo sean, detienen la ejecución del programa para evitar errores inesperados.

Las aserciones se utilizan principalmente para asegurar que el estado interno de un programa sea correcto antes de continuar con las operaciones. Son especialmente útiles durante el desarrollo y la depuración, ya que nos permiten identificar rápidamente dónde algo sale mal en nuestro código. En su forma más básica, una aserción se compone de una expresión booleana que debe evaluarse como verdadera para que el programa continúe ejecutándose.

La implementación de aserciones en la programación es relativamente sencilla. Se utiliza un comando específico dependiendo del lenguaje de programación utilizado, pero generalmente sigue el patrón: "si la expresión es falsa, detén la ejecución". Esta estructura permite que los desarrolladores se aseguren de que ciertos invariants o precondiciones sean cumplidos antes de avanzar.

Es importante destacar que las aserciones no deben usarse como un mecanismo principal para el control del flujo normal del programa. Su uso debe estar limitado a situaciones excepcionales, donde la violación de una condición implica un error grave o una inconsistencia interna que no puede ser manejada de otra manera. En su lugar, las aserciones deben complementar otras técnicas como el manejo de errores y excepciones para proporcionar una mayor robustez al programa.

La práctica del uso de aserciones en la programación es un aspecto fundamental de la metodología ágil y la ingeniería de software moderna. Algunas prácticas recomendadas incluyen la activación de las aserciones durante el desarrollo, pero su desactivación o supresión durante la fase de producción para evitar interrupciones inesperadas del programa.

En resumen, las aserciones son una herramienta valiosa en el arsenal del programador que nos permite asegurar la integridad y consistencia de nuestro código. Aunque deben usarse con precaución y no como un reemplazo del manejo de errores, su uso judicioso puede mejorar significativamente la calidad y confiabilidad de nuestros programas.

### asercion

#### Explicación

Este fragmento de código utiliza la palabra clave `assert` en Python. La función `assert` se usa para verificar si una condición es verdadera y, si no lo es, lanza una excepción con el mensaje que le sigues (en este caso, "hay un error"). En este ejemplo específico, se está comprobando si el número 3 es igual a 3. Como esta afirmación siempre será cierta, el programa no lanzará ninguna excepción y continuará ejecutándose normalmente. Sin embargo, si cambiamos la condición para que sea falsa (por ejemplo, `assert 3 == 2`), entonces se activaría la declaración de error con el mensaje proporcionado. Este tipo de verificación es útil durante la fase de desarrollo para asegurar que ciertas condiciones críticas sean siempre verdaderas y ayudar en la depuración del código.

```python
assert 3 == 3, "hay un error"
```

### si que hay un error

#### Explicación

Este fragmento de código utiliza una estructura llamada `assert`, que se usa para verificar si una condición es verdadera durante la ejecución del programa. En este caso, la condición que se verifica es `3 == 2`. Si esta condición no es cierta (y en efecto, 3 no es igual a 2), el programa generará un error y mostrará el mensaje "hay un error". El propósito de usar `assert` es ayudar a los programadores a identificar fácilmente las condiciones que deben cumplirse para que el código funcione correctamente. En situaciones de desarrollo y prueba, esta estructura es muy útil para asegurarse de que ciertas suposiciones sobre cómo debería funcionar el programa se cumplan en realidad.

```python
assert 3 == 2, "hay un error"
```

<a id="prueba-depuracion-y-documentacion-de-la-aplicacion"></a>
## Prueba, depuración y documentación de la aplicación

En el mundo digital, la programación es una habilidad fundamental que requiere no solo conocimiento técnico, sino también una mentalidad crítica y creativa. La carpeta `Primero/Programación/003-Uso de estructuras de control/006-Prueba, depuración y documentación de la aplicación` nos guía a través de un proceso esencial en el desarrollo de software: la prueba, la depuración y la documentación.

La prueba es una etapa crucial que permite verificar si nuestro programa cumple con los requisitos establecidos. Es como hacer un examen exhaustivo para asegurarnos de que todo funciona correctamente. En este proceso, se realizan pruebas unitarias individuales para cada función o método, así como pruebas integrales que evalúan cómo estas partes interactúan entre sí.

La depuración es el proceso de identificar y corregir errores en nuestro código. Es como buscar una pequeña falla en un edificio para asegurar su estabilidad. Utilizamos herramientas especializadas y técnicas de programación para localizar los problemas, ya sean faltas lógicas o errores de sintaxis.

La documentación es la parte que nos permite compartir nuestro trabajo con otros desarrolladores y recordar nuestros propios pensamientos en el futuro. Es como dejar un mapa detallado de cómo se construyó un edificio para que otros puedan seguir las mismas instrucciones. La documentación incluye comentarios dentro del código, explicaciones de los algoritmos utilizados y descripciones de las funciones.

Juntos, estos tres procesos forman una base sólida para el desarrollo de software. Prueba nos asegura que nuestro programa funcione como se espera, depuración nos permite corregir errores y documentación nos facilita la colaboración y el mantenimiento a largo plazo. Es un ciclo continuo que implica revisión, corrección y mejora constante.

La prueba es el ojo del juez en nuestro código, la depuración es su mano que corrige los defectos y la documentación es su voz que explica las intenciones detrás de cada línea. Juntos, forman una trifecta incesante de mejora y optimización.

Es importante recordar que el desarrollo de software no es solo sobre escribir código, sino también sobre entender cómo funciona nuestro programa y cómo podemos mejorarlo continuamente. Prueba, depuración y documentación son las herramientas que nos permiten lograr este objetivo, asegurando que nuestro trabajo sea robusto, confiable y fácil de mantener.

En resumen, la carpeta `Primero/Programación/003-Uso de estructuras de control/006-Prueba, depuración y documentación de la aplicación` nos enseña cómo llevar a cabo estos procesos esenciales en el desarrollo de software. Es un camino que requiere atención, paciencia y dedicación, pero que resulta en programas más sólidos y eficientes.

### division

#### Explicación

Este código define una función llamada `creaDivision` que toma dos parámetros: `dividendo` y `divisor`. La función realiza la operación matemática de división entre estos dos valores y devuelve el resultado. En otras palabras, si le das a esta función un dividendo de 4 y un divisor de 3, devolverá el valor de la división de 4 por 3.

Después de definir la función, se llama a `creaDivision` con los argumentos 4 y 3, y luego se imprime el resultado de esa llamada. Esto significa que el programa mostrará en pantalla el resultado de dividir 4 entre 3, que es aproximadamente 1.33.

Este tipo de código es importante porque te enseña a encapsular operaciones matemáticas complejas (en este caso, simplemente una división) dentro de funciones para reutilizarlas fácilmente y mantener tu código organizado. Esto también facilita la prueba y depuración del programa al poder llamar a la función con diferentes valores sin tener que escribir toda la lógica cada vez.

```python
def creaDivision(dividendo,divisor):
  return dividendo/divisor;
  
print(creaDivision(4,3))
```

### prueba de carga

#### Explicación

Este código es una pequeña aplicación en Python que demuestra el uso de estructuras de control y manejo de excepciones. La función `creaDivision` recibe dos parámetros: un dividendo y un divisor, y devuelve el resultado de la división entre ellos.

El bloque principal del programa utiliza dos bucles anidados (un for dentro de otro) que recorren números desde -100 hasta 99 para ambos valores: dividendo (`divid`) y divisor (`divis`). En cada iteración, se llama a la función `creaDivision` pasándole estos dos valores. Esto significa que el programa intentará calcular todas las posibles combinaciones de división entre los números en ese rango.

Importante es cómo maneja errores el código: si durante alguna operación aparece una excepción (por ejemplo, si se intenta dividir por cero), la parte `except` del bloque `try-except` imprimirá "No ha aguantado". Este tipo de manejo de errores ayuda a identificar y localizar problemas en programas más complejos.

```python
def creaDivision(dividendo,divisor):
  return dividendo/divisor;
  
try:
  for divid in range(-100,100):
    for divis in range(-100,100):
      print(creaDivision(divid,divis))
except:
  print("No ha aguantado")
```

### correccion

#### Explicación

Este código es una función en Python llamada `creaDivision` que realiza una división entre dos números dados. La función se asegura de que el divisor no sea cero, ya que dividir por cero no está definido y causaría un error. Si el divisor es diferente de cero, la función devuelve el resultado de la división; si el divisor es cero, devuelve una cadena "infinidad", indicando que el resultado sería infinito matemáticamente.

El código también incluye un bloque `try` y `except`. Dentro del bloque `try`, se crean dos bucles anidados para probar la función `creaDivision` con todas las posibles combinaciones de números entre -100 y 100 como dividendo y divisor. Si alguna parte del código dentro del bloque `try` genera una excepción (por ejemplo, un error que no se maneja dentro de la propia función), el programa imprimirá "No ha aguantado" en lugar de interrumpirse abruptamente. En caso contrario, si todo funciona correctamente sin generar ninguna excepción, se imprime "Ha pasado la prueba".

Este tipo de pruebas automáticas son muy útiles para asegurar que una aplicación o un algoritmo pueda manejar todas las situaciones posibles sin colapsar y proporciona confianza en el correcto funcionamiento del código.

```python
def creaDivision(dividendo,divisor):
  if divisor != 0:
    return dividendo/divisor;
  else:
    return "infinidad"
  
try:
  for divid in range(-100,100):
    for divis in range(-100,100):
      print(creaDivision(divid,divis))
  print("Ha pasado la prueba")
except:
  print("No ha aguantado")
```

### mas pruebas

#### Explicación

Este código define una función llamada `creaDivision` que toma dos parámetros: `dividendo` y `divisor`. La función intenta convertir ambos parámetros a números de punto flotante (números con decimales) usando la instrucción `try`. Si la conversión es exitosa, comprueba si el divisor es diferente de cero. Si el divisor no es cero, realiza la división y devuelve el resultado. Sin embargo, si el divisor es cero, en lugar de generar un error, la función retorna la cadena "infinidad", lo cual indica que matemáticamente la división por cero implica infinito.

Además, si ocurre algún error durante la conversión a float (por ejemplo, si se intenta convertir una letra como 'a' en un número), la función captura este error con `except` y retorna 0. Esto ayuda a evitar que el programa se interrumpa bruscamente debido a errores inesperados.

Esta forma de programar es importante porque permite al código manejar situaciones no deseadas o imprevistas de una manera amigable y segura, garantizando así la estabilidad del programa y facilitando su depuración.

```python
def creaDivision(dividendo,divisor):
  try:
    dividendo = float(dividendo)
    divisor = float(divisor)
    if divisor != 0:
      return dividendo/divisor;
    else:
      return "infinidad"
  except:
    return 0
  
  
print(creaDivision(4,"a"))
```

### documentacion

#### Explicación

Este código define una función llamada `creaDivision` que toma dos parámetros: `dividendo` y `divisor`. La función tiene como objetivo realizar la operación matemática de división entre estos dos valores. Antes de hacer la división, el código intenta convertir ambos parámetros a números decimales (float) para asegurarse de que se puedan manipular numéricamente.

La parte crucial es el manejo de posibles errores: si alguno de los parámetros no puede ser convertido en un número decimal o si el divisor es cero, la función maneja estos casos de manera específica. Si hay una excepción (es decir, el código falla), se devuelve 0. Si el divisor es cero, la función retorna la cadena "infinidad" porque matemáticamente no puede dividir por cero.

Este tipo de control y validación es importante en programación para evitar errores que podrían interrumpir el funcionamiento del programa (como una división por cero) y proporcionar un comportamiento esperado cuando se presentan condiciones inesperadas o incorrectas.

```python
def creaDivision(dividendo,divisor):
  '''
    Esta función realiza una división
    Entradas: el divisor y el dividendo
    Salidas: El resultado como número
    Notas: La función realiza validación de número e infinidad
  '''
  try:
    dividendo = float(dividendo)
    divisor = float(divisor)
    if divisor != 0:
      return dividendo/divisor;
    else:
      return "infinidad"
  except:
    return 0
  
  
print(creaDivision(4,"a"))
```

### llamada a la funcion

#### Explicación

Este fragmento de código está utilizando una función llamada `creaDivision` que ha sido definida en otro archivo de Python llamado `funciondividir`. La línea `from funciondividir import creaDivision` sirve para traer esa función específica al script actual, permitiéndote usarla sin tener que escribir todo el código nuevamente.

La siguiente línea, `print(creaDivision(4,3))`, llama a la función `creaDivision` y le pasa dos argumentos: 4 y 3. Esta función probablemente realiza una operación relacionada con la división matemática o crea algún tipo de estructura basada en estos dos números. Al colocar el resultado entre paréntesis de `print()`, lo que hace es mostrar el resultado de esta operación en la pantalla.

Este código es importante porque muestra cómo se pueden organizar y reutilizar piezas de código complejo mediante la importación de funciones desde otros archivos, lo cual es una práctica común cuando trabajas con proyectos más grandes en Python.

```python
from funciondividir import creaDivision

print(creaDivision(4,3))
```

### funciondividir

#### Explicación

Este código es una función en Python llamada `creaDivision` que toma dos parámetros: un dividendo y un divisor. La función intenta convertir ambos valores a números decimales usando la función `float()` para asegurarse de que se puedan realizar operaciones matemáticas con ellos. Luego, verifica si el divisor es diferente de cero porque no puede haber una división entre cero en matemáticas (lo cual causaría un error). Si el divisor no es cero, la función devuelve el resultado de dividir el dividendo por el divisor. Sin embargo, si el divisor es cero, la función devolverá simplemente la palabra "infinidad" porque matemáticamente, cuando divides un número por cero, el resultado es infinito. Si ocurre algún error durante este proceso (por ejemplo, si los parámetros no pueden convertirse a números), la función regresa 0 para indicar que hubo un problema con las entradas.

Esta función es importante porque ayuda a manejar situaciones donde los datos de entrada pueden ser incorrectos o incompletos y permite al programa seguir funcionando sin romperse debido a errores inesperados.

```python
def creaDivision(dividendo,divisor):
  '''
    Esta función realiza una división
    Entradas: el divisor y el dividendo
    Salidas: El resultado como número
    Notas: La función realiza validación de número e infinidad
  '''
  try:
    dividendo = float(dividendo)
    divisor = float(divisor)
    if divisor != 0:
      return dividendo/divisor;
    else:
      return "infinidad"
  except:
    return 0
```

<a id="ejercicio"></a>
## Ejercicio

En el mundo de la programación, las estructuras de control son como los pilares que sostienen una construcción. Son fundamentales para organizar y controlar el flujo de ejecución del programa, permitiendo decisiones condicionales y repeticiones precisas. En esta carpeta, nos sumergimos en el ejercicio práctico de cómo aplicar estas estructuras en nuestro código.

Comenzamos con la estructura de selección, que es como una bifurcación en un camino. Dependiendo del valor de una expresión booleana, el programa tomará diferentes caminos. Esta es una herramienta poderosa para manejar decisiones complejas y tomar acciones basadas en condiciones específicas.

La siguiente estructura es la repetición, que nos permite realizar una tarea varias veces hasta que se cumpla una condición determinada. Este tipo de control es esencial para tareas como recorrer listas, procesar archivos o ejecutar algoritmos iterativos. Aprender a controlar el número de repeticiones y la condición de terminación es crucial para optimizar el rendimiento del programa.

Además, existen estructuras de control que nos permiten manejar excepciones, situaciones inesperadas durante la ejecución del programa. Estas estructuras son como una red de seguridad que previene caídas y permite recuperarse de errores sin interrumpir completamente la operación del programa.

La programación también implica el uso de bucles anidados, donde un bucle está dentro de otro. Este tipo de estructura es útil cuando necesitamos realizar una tarea repetitiva en múltiples niveles o dimensiones. Es como construir con bloques de construcción, donde cada nivel depende del anterior.

La programación orientada a objetos introduce la estructura de las clases y los métodos. Las clases son como plantillas para crear objetos, mientras que los métodos definen las acciones que pueden realizar estos objetos. Esta estructura permite organizar el código en bloques lógicos y reutilizables, facilitando su mantenimiento y escalabilidad.

Además, la programación también implica el uso de bucles controlados por contador, donde se especifica explícitamente cuántas veces se ejecutará un bloque de código. Este tipo de estructura es útil cuando sabemos con certeza el número exacto de repeticiones necesarias.

La programación también requiere el manejo de eventos y callbacks, que son funciones que se ejecutan en respuesta a ciertas acciones o cambios en el programa. Estas estructuras permiten crear programas interactivos y responder dinámicamente a las entradas del usuario.

Finalmente, la programación implica el uso de bucles controlados por sentinela, donde el número de repeticiones depende de una entrada externa o un cambio en el estado del programa. Este tipo de estructura es útil cuando no sabemos con certeza cuántas veces se ejecutará un bloque de código.

En resumen, las estructuras de control son herramientas fundamentales para organizar y controlar el flujo de ejecución del programa. Aprender a usar estas estructuras correctamente es esencial para escribir programas eficientes, seguros y fáciles de mantener.

<a id="ejercicio-de-final-de-unidad-2"></a>
## Ejercicio de final de unidad

### actividad

#### Explicación

Parece que no has incluido el fragmento de código en formato Markdown para que pueda explicarlo. Por favor, proporciona el bloque de código dentro del formato indicado y estaré encantado de ayudarte a entenderlo.

```markdown

```


<a id="desarrollo-de-clases"></a>
# Desarrollo de clases

<a id="concepto-de-clase"></a>
## Concepto de clase

En el vasto universo de la programación, las clases son como los bloques fundamentales que construyen edificios impresionantes. Un concepto tan esencial como este merece una exploración profunda y detallada, para entender su importancia y cómo se aplican en la creación de programas informáticos.

La clase es un molde abstracto que define las características y comportamientos comunes de un conjunto de objetos. Es el plano o la plantilla a partir del cual se crean instancias concretas de ese tipo. En términos simples, una clase es como un modelo para crear coches; cada coche que se fabrica a partir de este modelo tendrá las mismas características básicas (llantas, puertas, motor) pero puede variar en detalles específicos (color, marca).

La definición de una clase comienza con la palabra clave `class`, seguida del nombre de la clase. Este nombre debe ser descriptivo y seguir las convenciones de nomenclatura utilizadas en el lenguaje de programación que estés utilizando. Por ejemplo:

```python
class Coche:
    pass
```

En este ejemplo, `Coche` es el nombre de la clase. El bloque `pass` es simplemente un marcador de posición que indica que aquí se definirá el contenido de la clase.

Una vez creada una clase, puedes añadir atributos y métodos a ella. Los atributos son variables que almacenan datos específicos del objeto, mientras que los métodos son funciones que definen las acciones que puede realizar el objeto. Por ejemplo:

```python
class Coche:
    marca = "Toyota"
    
    def arrancar(self):
        print("El coche está arrancando")
```

En este caso, `marca` es un atributo de la clase `Coche`, y `arrancar` es un método que define una acción que puede realizar un objeto de esta clase.

La creación de instancias a partir de una clase se realiza mediante el uso del operador `new` (o simplemente el nombre de la clase seguido de paréntesis en algunos lenguajes). Por ejemplo:

```python
mi_coche = Coche()
```

Esta línea de código crea un nuevo objeto de la clase `Coche`, y lo asigna a la variable `mi_coche`. Ahora, puedes acceder a los atributos y métodos de este objeto mediante el punto (`.`):

```python
print(mi_coche.marca)  # Imprime: Toyota
mi_coche.arrancar()   # Imprime: El coche está arrancando
```

La programación orientada a objetos, que es la base del desarrollo de clases, permite organizar y estructurar el código de una manera más lógica y fácil de mantener. Al definir clases, puedes encapsular datos y comportamientos relacionados en un solo lugar, lo que facilita su reutilización y modificación.

Además, las clases permiten la herencia, que es un mecanismo que permite crear nuevas clases a partir de otras existentes. La clase hija puede heredar atributos y métodos de la clase padre, y además añadir nuevos o modificar los existentes. Esta característica es fundamental para crear jerarquías de objetos complejas y reutilizar código.

En resumen, las clases son una herramienta poderosa en el arsenal del programador. Son la base de la programación orientada a objetos y permiten organizar y estructurar el código de manera más lógica y eficiente. Al comprender completamente el concepto de clase, se abre un mundo de posibilidades para crear programas complejos y robustos que puedan adaptarse a las necesidades cambiantes del usuario.

### codigo sin reutilizacion

#### Explicación

Este código Python es un ejemplo simple de cómo imprimir mensajes en la pantalla. El programa utiliza varias líneas `print()` para mostrar información sobre tres personas diferentes: Pepe, Juan y Jorge. Cada persona tiene su propio saludo, una pregunta sobre cómo está y un mensaje con su edad.

Lo que hace este código es muy básico; simplemente muestra texto predefinido en la consola del programa. Sin embargo, si observas cuidadosamente, puedes notar que hay mucho código repetitivo: para cada persona se imprime exactamente lo mismo, cambiando solo el nombre y la edad.

Esta falta de reutilización del código puede hacerlo difícil de mantener y modificar. Por ejemplo, si quisieras añadir a otra persona al listado o cambiar un detalle en los saludos, tendrías que editar varias líneas repetidas manualmente. Esto no es eficiente ni recomendable para programas más grandes. Es importante aprender cómo organizar el código para evitar este tipo de problemas y hacerlo más limpio y manejable.

```python
print("hola, pepe")
print("como estás")
print("que sepas que tienes 45 años")

print("hola, juan")
print("como estás")
print("que sepas que tienes 34 años")

print("hola, jorge")
print("como estás")
print("que sepas que tienes 56 años")
```

### funciones para encapsular

#### Explicación

Este fragmento de código en Python muestra cómo se define y utiliza una función simple llamada `saluda()`. La función no necesita recibir ningún dato (no tiene parámetros) y simplemente imprime tres mensajes en la pantalla que salúdan a Pepe, le preguntan por su estado y hacen un comentario sobre su edad. Al final del código, se llama a esta función tres veces seguidas usando `saluda()`. Esto significa que los tres mensajes dentro de la función aparecerán tres veces en el resultado (output) cuando se ejecute este código.

Es importante entender cómo crear funciones como esta porque te permiten reutilizar bloques de código específicos y también facilitan organizar tu programa. En lugar de escribir lo mismo varias veces, simplemente llamas a la función cada vez que necesitas que esos mensajes aparezcan en el programa.

```python
def saluda():
  print("hola, pepe")
  print("como estás")
  print("que sepas que tienes 45 años")

saluda()
saluda()
saluda()
```

### parametros de la funcion

#### Explicación

Este código define una función en Python llamada `saluda` que recibe dos parámetros: `nombre` y `edad`. La función imprime un saludo personalizado para cada persona, mostrando su nombre y edad. Primero se imprime "hola" seguido del nombre proporcionado, luego se pregunta cómo está la persona, y finalmente se indica cuántos años tiene basándose en el valor de `edad` que se pasa a la función.

Después de definir la función, se llaman tres veces con diferentes nombres y edades para demostrar cómo funciona. Esto es útil porque permite personalizar mensajes de saludo según los datos específicos de cada persona sin tener que escribir código repetitivo.

El uso de funciones ayuda a organizar el programa en bloques más pequeños y manejables, facilitando su mantenimiento y reutilización en diferentes partes del programa o incluso en otros programas.

```python
def saluda(nombre,edad):
  print("hola, ",nombre)
  print("como estás")
  print("que sepas que tienes ",edad," años")

saluda("juan",54)
saluda("jorge",45)
saluda("jaime",67)
```

### clases

#### Explicación

Este fragmento de código define una clase en Python llamada `Gato`. Una clase es como un plano o plantilla para crear objetos. En este caso, el objeto será un gato y la clase proporciona las características básicas que todos los gatos tendrán.

El método especial `__init__` se utiliza para inicializar cada instancia de la clase cuando se crea un nuevo objeto Gato. Sin embargo, en el código dado, dentro del método `__init__`, solo estás mencionando variables (`self.color`, `self.edad`, `self.raza`) pero no las estás asignando a ningún valor específico. Esto significa que al crear una instancia de la clase `Gato` ahora mismo, tendrías un error porque intentas acceder a propiedades que no han sido inicializadas correctamente.

Es importante definir y asignar valores iniciales (o permitir que sean opcionales) para estas variables cuando se crea el objeto Gato, ya que esto permite almacenar información específica sobre cada gato individual creado desde esta clase.

```python
class Gato:
  def __init__(self):
    self.color
    self.edad
    self.raza
    
```

### creo un primer gato

#### Explicación

Este fragmento de código crea una clase llamada `Gato` en Python. La clase es como un molde que define las características y comportamientos que tendrán los objetos del tipo "Gato". Dentro de la clase, se encuentra el método especial `__init__`, que se llama automáticamente cuando creamos un nuevo objeto gato. Este método inicializa tres atributos: `color` (el color del pelaje del gato), `edad` (la edad del gato) y `raza` (la raza o tipo de gato). 

Después, el código crea una instancia de la clase `Gato`, es decir, un objeto llamado `gato1`. Finalmente, se imprime este objeto utilizando la función `print()`. Sin embargo, lo que verás en pantalla será una representación por defecto del objeto, ya que no hemos definido cómo debe imprimirse el gato en particular. Este código es importante porque introduce los conceptos básicos de las clases y objetos en programación orientada a objetos (POO).

```python
class Gato:
  def __init__(self):
    self.color = ""
    self.edad = ""
    self.raza = ""
    
gato1 = Gato()
print(gato1)
```

### puedo crear los gatos que quiera

#### Explicación

Este código crea una clase llamada `Gato` en Python. Una clase es como un modelo o plantilla que describe las características y comportamientos de los objetos relacionados con ella, en este caso, gatos. Dentro de la clase `Gato`, se define el método especial `__init__`, que actúa como constructor cuando creamos nuevas instancias (objetos) de esta clase. En este método, inicializamos tres atributos: `color`, `edad` y `raza`, todos establecidos en cadena vacía (`""`). Estos atributos son como las características individuales que cada gato podría tener.

Después de definir la clase, creamos dos instancias de esta clase (objetos) llamados `gato1` e `gato2`. Esto es equivalente a decir "aquí hay un gato", y el código crea estos objetos sin asignarles valores específicos para sus atributos por ahora. Finalmente, intentamos imprimir cada objeto con la función `print()`, lo cual en este caso mostrará una representación no muy informativa del objeto debido a que aún no hemos definido cómo se debe mostrar un objeto de tipo Gato.

Es importante entender esto porque las clases y los objetos son fundamentales para organizar y estructurar nuestro código, permitiéndonos trabajar con conceptos complejos como atributos y métodos de una manera más clara y manejable.

```python
class Gato:
  def __init__(self):
    self.color = ""
    self.edad = ""
    self.raza = ""
    
gato1 = Gato()
print(gato1)
    
gato2 = Gato()
print(gato2)
```

<a id="estructura-y-miembros-de-una-clase-visibilidad"></a>
## Estructura y miembros de una clase. Visibilidad

En el vasto terreno de la programación orientada a objetos, las clases son una construcción fundamental que nos permite modelar entidades del mundo real. Una clase es un molde o plantilla que define las características y comportamientos comunes de un conjunto de objetos. Cada objeto creado a partir de una clase se denomina instancia de esa clase.

La estructura y los miembros de una clase son elementos cruciales para definir su comportamiento y funcionalidad. Los miembros de una clase pueden ser atributos (también conocidos como variables) o métodos (funciones). Estos miembros definen las propiedades y capacidades que tendrán todas las instancias de la clase.

La visibilidad es un aspecto importante en el diseño de clases, ya que determina quién puede acceder a los atributos y métodos. En programación orientada a objetos, existen tres niveles de visibilidad: público (public), protegido (protected) y privado (private). Cada nivel tiene sus propias reglas sobre el acceso:

- **Público (public)**: Los miembros públicos son accesibles desde cualquier parte del programa. Son los que más a menudo se utilizan para exponer la funcionalidad de una clase.

- **Protegido (protected)**: Los miembros protegidos son accesibles dentro de la misma clase y en las clases derivadas. Esta visibilidad es útil cuando deseamos permitir el acceso a ciertos miembros solo dentro del paquete, pero no fuera de él.

- **Privado (private)**: Los miembros privados son accesibles solo dentro de la propia clase. Son los que se utilizan para ocultar detalles internos y proteger la integridad de los datos.

La estructura de una clase en programación orientada a objetos suele seguir un patrón común, aunque puede variar según el lenguaje de programación utilizado. Generalmente, comienza con la declaración de la clase seguida del nombre de la clase y las llaves que encierran su contenido.

Dentro de una clase, los miembros se declaran en orden: primero los atributos, luego los métodos. Cada miembro tiene un tipo de dato asociado y puede tener modificadores de acceso como public, protected o private.

La declaración de un método dentro de una clase es similar a la declaración de una función, pero está encapsulada dentro del contexto de la clase. Los métodos definen las acciones que los objetos pueden realizar y cómo interactúan entre sí.

La visibilidad juega un papel crucial en el diseño seguro y eficiente de clases. Al ocultar detalles internos y exponer solo lo necesario, podemos proteger contra modificaciones no deseadas y mantener la coherencia del estado de los objetos.

En resumen, las clases son la base de la programación orientada a objetos, y su estructura y miembros definen su comportamiento. La visibilidad es un mecanismo poderoso que nos permite controlar el acceso a estos miembros, lo que es fundamental para crear sistemas robustos y seguros. A través del uso adecuado de atributos y métodos con diferentes niveles de visibilidad, podemos modelar entidades del mundo real de manera precisa y eficiente.

### miembros

#### Explicación

Este código Python define una clase llamada `Gato`, la cual se utiliza para crear objetos que representan gatos. En el interior de esta clase, hay un método especial denominado `__init__` que actúa como constructor; este es el primer bloque de código que se ejecuta cuando creamos (instanciamos) un objeto del tipo `Gato`. El constructor inicializa tres propiedades del gato: color, edad y raza, todas ellas vacías en este caso.

Además del constructor, la clase incluye otro método llamado `maulla`, el cual imprime por pantalla el sonido que hace el gato (en este caso "miau"). Este es un ejemplo de cómo los objetos pueden realizar acciones definidas dentro de métodos de su propia clase. Al final del código, se crea una instancia específica del objeto `Gato` llamada `gato1`, y luego se llama al método `maulla()` para que el gato haga ruido.

Este tipo de estructura es fundamental en la programación orientada a objetos porque permite encapsular datos (propiedades) y funciones relacionadas con esos datos (métodos) dentro de una misma entidad, facilitando así su manejo y organización.

```python
class Gato:
  def __init__(self): # El constructor se llama cuando se instancia el objeto
    self.color = ""   # Una clase tiene propiedades (estáticas)
    self.edad = ""
    self.raza = ""
  def maulla(self):   # Un método es una acción que realiza el objeto
    print("miau")
    
gato1 = Gato()
print(gato1)
gato1.maulla()
```

### visibilidad de los miembros

#### Explicación

Este código define una clase llamada `Gato` en Python. La clase tiene un constructor (`__init__`) que inicializa tres propiedades: `color`, `edad` y `raza`. Estas propiedades son públicas, lo que significa que puedes acceder a ellas desde fuera de la clase sin restricciones. Por ejemplo, después de crear una instancia del objeto `gato1`, puedes cambiar el valor de su propiedad `color` a "naranja" y luego imprimir ese color utilizando las líneas `gato1.color = "naranja"` y `print("El gato es de color", gato1.color)`. Además, la clase tiene un método llamado `maulla()` que hace que el objeto imprima el sonido `"miau"`, simbolizando el maullido del gato. Este código ilustra cómo se crean objetos en Python y cómo acceder a sus propiedades, lo cual es fundamental para entender la programación orientada a objetos.

```python
class Gato:
  def __init__(self): # El constructor se llama cuando se instancia el objeto
    self.color = ""   # Una clase tiene propiedades (estáticas)
    self.edad = ""    # La visibilidad por defecto es pública
    self.raza = ""
  def maulla(self):   # Un método es una acción que realiza el objeto
    print("miau")
    
gato1 = Gato()
gato1.color = "naranja"          # Desde fuera puedo escribir la propiedad
print("El gato es de color",gato1.color)  # Desde fuera puedo leer la propiedad
```

### propiedad privada

#### Explicación

Este código define una clase llamada `Gato` en Python, que representa a un objeto gato con algunas propiedades y comportamientos. La clase tiene tres propiedades: `__color`, `edad` y `raza`. El guion bajo duplicado (`__`) antes del nombre de la propiedad `__color` indica que esta es una propiedad privada, lo que significa que no se puede acceder a ella directamente desde fuera de la clase. Sin embargo, en el código proporcionado, hay un intento fallido de modificar y leer la propiedad `__color` desde fuera de la clase, lo cual debería generar un error porque Python considera esta variable como encapsulada.

Las propiedades `edad` y `raza`, que no tienen guiones bajos duplicados al principio del nombre, son públicas. Esto significa que pueden ser modificadas o leídas desde cualquier parte del código que tenga acceso a una instancia de la clase `Gato`.

El método `maulla()` es una acción que puede realizar un objeto gato; en este caso, simplemente imprime "miau". Este tipo de método simula el comportamiento típico de un gato cuando maúlla.

Es importante destacar que aunque intentas cambiar y leer la propiedad `__color` desde fuera de la clase, Python no permite esto debido a su encapsulación. Esto ayuda a proteger ciertos aspectos del objeto para evitar cambios accidentales o maliciosos en esos atributos.

```python
class Gato:
  def __init__(self): # El constructor se llama cuando se instancia el objeto
    self.__color = ""   # Una clase tiene propiedades (estáticas)
    self.edad = ""    # La visibilidad por defecto es pública
    self.raza = ""
  def maulla(self):   # Un método es una acción que realiza el objeto
    print("miau")
    
gato1 = Gato()
gato1.__color = "naranja"          # Desde fuera puedo escribir la propiedad
print("El gato es de color",gato1.__color)  # Desde fuera puedo leer la propiedad
```

<a id="creacion-de-propiedades"></a>
## Creación de propiedades

En el vasto mundo de la programación, las clases son como moldeadores de objetos, creando estructuras que encapsulan datos y comportamientos. En esta subunidad didáctica, nos adentramos en la creación de propiedades dentro de estas clases, un paso esencial para dar forma a nuestros programas.

Las propiedades son atributos que definen las características de los objetos. Al igual que las variables, las propiedades almacenan datos, pero tienen una estructura más compleja y funcional. Cada propiedad tiene un nombre, un tipo de dato y puede tener métodos asociados para su acceso y modificación.

La creación de propiedades en una clase es fundamental porque permite encapsular los datos de manera segura y controlada. Esto significa que podemos definir cómo se accede a estos datos (lectura o escritura) y qué acciones se realizan cuando se intenta modificarlos, lo que ayuda a prevenir errores y mantener la integridad del objeto.

Además, las propiedades facilitan el acceso a los datos de manera más intuitiva y segura. En lugar de acceder directamente a una variable interna, podemos utilizar métodos getter y setter para controlar cómo se obtienen y modifican los valores de las propiedades. Esto no solo mejora la seguridad del objeto, sino que también facilita el mantenimiento y evolución del código.

La creación de propiedades también es clave para implementar la programación orientada a objetos (POO), una técnica poderosa que permite organizar y reutilizar el código de manera eficiente. Al definir las propiedades en una clase, podemos crear instancias de esa clase con diferentes valores para sus propiedades, lo que nos permite representar diversos estados del objeto.

En esta subunidad, aprenderemos a declarar propiedades en una clase, cómo definir métodos getter y setter para acceder y modificar sus valores, y cómo utilizar estas propiedades para encapsular los datos de nuestros objetos. A través de ejemplos prácticos, exploraremos cómo implementar las propiedades en diferentes contextos y cómo usarlas para mejorar la estructura y funcionalidad de nuestros programas.

La comprensión de cómo crear y utilizar propiedades es un paso crucial en el aprendizaje de la programación orientada a objetos. Al dominar este concepto, podremos construir clases más robustas y seguras, lo que nos permitirá desarrollar aplicaciones más complejas y eficientes.

### propiedades

#### Explicación

Este código define una clase en Python llamada `Gato`. Una clase es como un modelo o plantilla para crear objetos. En este caso, la clase `Gato` tiene varias propiedades, que son características específicas de los gatos que puedes definir, como el color del pelaje, la edad, la raza, el nombre y el color de los ojos. Estas propiedades se inicializan en el método especial llamado `__init__`, que Python llama automáticamente cada vez que creas un nuevo objeto basado en esta clase.

Además de las propiedades, hay un método llamado `maulla` que hace que la instancia del gato (un objeto específico creado desde esta clase) imprima "miau", lo cual simula el ronroneo o maullido del gato. Este método muestra cómo puedes definir acciones que los objetos pueden realizar basándose en la lógica que programas dentro de la clase.

Este tipo de estructura es importante porque permite crear múltiples instancias de un mismo tipo (en este caso, diferentes gatos) con sus propias características únicas mientras comparten el mismo conjunto básico de comportamientos y datos.

```python
class Gato:
  def __init__(self): # El constructor se llama cuando se instancia el objeto
    self.color = ""   # Una clase tiene propiedades (estáticas)
    self.edad = ""    # La visibilidad por defecto es pública
    self.raza = ""
    self.nombre = ""
    self.color_ojos = ""
  def maulla(self):   # Un método es una acción que realiza el objeto
    print("miau")
    
```

<a id="creacion-de-metodos"></a>
## Creación de métodos

En el vasto universo de la programación, los métodos son como las herramientas que nos permiten dar forma a nuestros objetos. Al igual que un carpintero necesita diferentes tipos de martillos para completar su trabajo, un programador necesita diversos métodos para manipular y gestionar los datos de sus clases.

El primer paso en el desarrollo de métodos es entender qué acción queremos que realice nuestro objeto. Un método puede ser tan simple como una función que imprime un mensaje o tan complejo como una operación matemática que procesa múltiples variables. Cada método tiene su propósito específico, y su definición se realiza dentro del cuerpo de la clase.

El nombre de cada método es crucial, ya que actúa como el identificador único que nos permite invocarlo cuando lo necesitemos. Es una buena práctica elegir nombres descriptivos que reflejen claramente la funcionalidad del método. Por ejemplo, si estamos trabajando con un objeto `Persona`, podríamos tener métodos como `cumplirAnios()` o `caminar(int pasos)`.

Además de su nombre, cada método tiene parámetros, que son los valores que necesita para realizar su tarea. Estos parámetros pueden ser de cualquier tipo y número, permitiendo una gran flexibilidad en cómo se utilizan los métodos. Por ejemplo, un método `calcularDescuento(double precioOriginal)` podría recibir el precio original de un producto como parámetro y devolver el precio con descuento aplicado.

El cuerpo del método es donde se define la lógica que ejecutará cuando el método sea invocado. Aquí es donde se realizan las operaciones necesarias para lograr el objetivo del método. Cada línea de código dentro del método debe ser clara y concisa, facilitando su lectura y depuración.

Es importante recordar que los métodos deben seguir un principio fundamental: la responsabilidad única. Un método debería tener una sola tarea y hacerla bien. Esto no solo hace que el código sea más fácil de mantener y entender, sino que también facilita la reutilización del código en diferentes partes del programa.

Además de definir métodos dentro de las clases, es común crear métodos estáticos. Los métodos estáticos son aquellos que pueden ser invocados sin necesidad de instanciar una clase. Son útiles para funciones utilitarias o operaciones que no dependen del estado de un objeto en particular.

La gestión adecuada de los métodos es esencial para mantener el orden y la claridad en nuestros proyectos de programación. Al seguir las mejores prácticas en la creación y uso de métodos, podemos construir sistemas más robustos y fáciles de mantener a lo largo del tiempo.

En resumen, los métodos son el corazón de cualquier programa orientado a objetos. Son herramientas poderosas que nos permiten dar forma a nuestros objetos y realizar tareas específicas. Al aprender a crear y utilizar métodos eficazmente, podemos desarrollar programas más complejos y funcionales, facilitando así la tarea del programador y mejorando la calidad de nuestro trabajo.

### metodo miau

#### Explicación

Este código muestra cómo crear y utilizar una clase en Python para representar un gato. La clase `Gato` tiene un constructor (`__init__`) que se ejecuta cuando creamos un nuevo objeto de tipo `Gato`. En este constructor, inicializamos varias propiedades del gato como su color, edad, raza, nombre y color de ojos, todas ellas vacías al principio. Luego, definimos un método llamado `maulla`, que simplemente imprime el sonido "miau" en la pantalla cuando se llama.

Es importante entender este concepto porque las clases nos permiten encapsular datos (propiedades) y funciones relacionadas con esas propiedades (métodos) dentro de una estructura única. Esto hace más fácil manejar objetos complejos, ya que cada objeto tiene sus propias características y acciones específicas. Al final del código, creamos un objeto `gato1` a partir de nuestra clase `Gato` e inmediatamente llamamos al método `maulla()` para hacerlo maullar, lo cual demuestra cómo interactuar con los objetos que hemos creado.

```python
class Gato:
  def __init__(self): # El constructor se llama cuando se instancia el objeto
    self.color = ""   # Una clase tiene propiedades (estáticas)
    self.edad = ""    # La visibilidad por defecto es pública
    self.raza = ""
    self.nombre = ""
    self.color_ojos = ""
  def maulla(self):   # Un método es una acción que realiza el objeto
    print("miau")
    
gato1 = Gato()
gato1.maulla()
```

### funcion con return

#### Explicación

Este fragmento de código Python muestra cómo se define y utiliza una clase llamada `Gato`. La clase tiene un constructor (`__init__`) que inicializa las propiedades del gato, como el color, la edad, la raza, el nombre y el color de ojos. Estas propiedades son atributos del objeto `Gato` que almacenarán información específica para cada instancia (cada gato individual). Además, se define un método llamado `maulla()`, que no necesita recibir ningún parámetro adicional pero devuelve una cadena "miau" cuando es llamado. Este método simula la acción de maullar de un gato.

Luego del bloque de definición de la clase, se crea una instancia (un objeto) de `Gato` denominada `gato1`, y se llama al método `maulla()` utilizando el objeto recién creado. La función `print()` imprime en pantalla lo que devuelve el método `maulla()`, es decir, "miau". Este código ilustra cómo una clase puede contener tanto propiedades (datos) como métodos (funciones), y cómo estos se pueden utilizar para simular comportamientos reales o representar entidades del mundo real de manera simplificada en un programa.

```python
class Gato:
  def __init__(self): # El constructor se llama cuando se instancia el objeto
    self.color = ""   # Una clase tiene propiedades (estáticas)
    self.edad = ""    # La visibilidad por defecto es pública
    self.raza = ""
    self.nombre = ""
    self.color_ojos = ""
  def maulla(self):   # Un método es una acción que realiza el objeto
    return "miau"
    
gato1 = Gato()
print(gato1.maulla())
```

### setter

#### Explicación

Este código crea una clase llamada `Gato` que simula las propiedades y comportamientos de un gato en Python. En la clase, se definen varias propiedades como `color`, `edad`, `raza`, `nombre` y `color_ojos`. Estas propiedades son variables que guardan información sobre cada instancia del objeto `Gato`.

Además, hay dos métodos definidos: `maulla()` y `setEdad()`. El método `maulla()` simplemente devuelve la palabra "miau", imitando el sonido que hace un gato. Por otro lado, el método `setEdad(nuevaedad)` establece la edad del gato utilizando un argumento que recibe.

El código también muestra cómo instanciar una clase y acceder a sus métodos y propiedades. Se crea una instancia de `Gato` llamada `gato1`. Luego, se imprime el sonido que hace (`miau`) mediante la invocación del método `maulla()`. A continuación, se muestra cómo establecer y modificar la edad del gato tanto directamente como utilizando el método `setEdad()`.

El uso de métodos para cambiar las propiedades, como en `gato1.setEdad(1)`, es mucho más seguro que hacerlo directamente (`gato1.edad = 1`), ya que los métodos pueden implementar validaciones adicionales y controlar mejor cómo se manipulan los datos.

```python
class Gato:
  def __init__(self): # El constructor se llama cuando se instancia el objeto
    self.color = ""   # Una clase tiene propiedades (estáticas)
    self.edad = 0    # La visibilidad por defecto es pública
    self.raza = ""
    self.nombre = ""
    self.color_ojos = ""
  def maulla(self):   # Un método es una acción que realiza el objeto
    return "miau"
  def setEdad(self,nuevaedad):
    self.edad = nuevaedad
    
gato1 = Gato()
print(gato1.maulla())
print("ahora mismo el gato tiene",gato1.edad,"años")
gato1.edad = 1    # Esto no se recomienda
gato1.setEdad(1)  # Esto es mucho más seguro
print("ahora mismo el gato tiene",gato1.edad,"años")
```

### seteando sin control

#### Explicación

Este código crea una clase llamada `Gato` que simula las propiedades y comportamientos de un gato en la programación. La clase incluye una serie de atributos como color, edad, raza, nombre y color de ojos. También tiene dos métodos: `maulla`, que simplemente retorna el sonido "miau", representando cómo maúlla el gato; y `setEdad`, que permite establecer la edad del gato pero con una restricción especial.

El método `setEdad` solo aumenta la edad en uno cuando se llama, lo cual significa que si intentas cambiar la edad a un valor diferente al actual más uno, el programa imprime "operación no permitida". Esto es importante porque ayuda a mantener la consistencia y seguridad de los datos; evita que alguien cambie arbitrariamente la edad del gato sin seguir una secuencia lógica.

En resumen, este código muestra cómo definir atributos y métodos en Python para simular un objeto real con características y acciones específicas.

```python
class Gato:
  def __init__(self): # El constructor se llama cuando se instancia el objeto
    self.color = ""   # Una clase tiene propiedades (estáticas)
    self.edad = 0    # La visibilidad por defecto es pública
    self.raza = ""
    self.nombre = ""
    self.color_ojos = ""
  def maulla(self):   # Un método es una acción que realiza el objeto
    return "miau"
  def setEdad(self,nuevaedad):
    if self.edad == nuevaedad - 1:
      self.edad = nuevaedad
    else:
      print("operación no permitida")
    
gato1 = Gato()
print(gato1.maulla())
print("ahora mismo el gato tiene",gato1.edad,"años")
gato1.setEdad(5)  # Esto es mucho más seguro
print("ahora mismo el gato tiene",gato1.edad,"años")
```

### control en el set

#### Explicación

Este código crea una clase llamada `Gato` que modela las características y comportamientos de un gato en Python. La clase incluye un constructor (`__init__`) donde se inicializan las propiedades del gato como su color, edad, raza, nombre y color de ojos. Además, la clase tiene dos métodos: `maulla`, que simplemente devuelve el sonido "miau", y `setEdad`, que permite establecer la edad del gato pero solo si la nueva edad es exactamente un año mayor que la edad actual. Esto asegura que no se pueda manipular la edad de forma arbitraria, lo cual es importante para mantener los datos del objeto consistentes y seguros.

El código también muestra cómo crear una instancia de `Gato`, llamada `gato1`, e invocar sus métodos. Primero imprime el sonido que hace el gato y luego su edad actual, que inicialmente es 0 porque no se ha establecido un valor en particular durante la creación del objeto. A continuación, se utiliza el método `setEdad` para intentar cambiar la edad a 5 años (lo cual es válido ya que es solo un año mayor), y vuelve a imprimir la edad actualizada del gato.

Esta estructura de clase y métodos permite organizar el código en una forma modular y fácilmente mantenible, lo que es fundamental cuando se trabaja con objetos complejos en programación orientada a objetos.

```python
class Gato:
  def __init__(self): # El constructor se llama cuando se instancia el objeto
    self.color = ""   # Una clase tiene propiedades (estáticas)
    self.edad = 0    # La visibilidad por defecto es pública
    self.raza = ""
    self.nombre = ""
    self.color_ojos = ""
  def maulla(self):   # Un método es una acción que realiza el objeto
    return "miau"
  def setEdad(self,nuevaedad):
    if self.edad == nuevaedad - 1:
      self.edad = nuevaedad
    else:
      print("operación no permitida")
    
gato1 = Gato()
print(gato1.maulla())
print("ahora mismo el gato tiene",gato1.edad,"años")
gato1.setEdad(5)  # Esto es mucho más seguro
print("ahora mismo el gato tiene",gato1.edad,"años")
```

### getter edad

#### Explicación

Este código crea una clase llamada `Gato` en Python, que representa las propiedades y comportamientos de un gato. La clase tiene un constructor (`__init__`) donde se inicializan varias propiedades como el color del pelaje, la edad, la raza, el nombre y el color de los ojos. También incluye métodos específicos para acciones como maullar (`maulla()`) y gestionar la propiedad `edad` a través de dos métodos: `setEdad()` y `getEdad()`. El método `setEdad()` permite cambiar la edad del gato, pero solo si la nueva edad es exactamente un año mayor que la actual para evitar errores. Por otro lado, el método `getEdad()` simplemente devuelve la edad actual del gato.

Esta estructura de código es importante porque encapsula los datos y las operaciones relacionadas con un objeto (en este caso, un gato) en una clase, lo que facilita su manejo y uso en programas más grandes. Además, el uso de `setEdad()` y `getEdad()` proporciona control sobre cómo se modifican ciertos atributos del gato, asegurando que los cambios sean lógicos y seguros.

```python
class Gato:
  def __init__(self): # El constructor se llama cuando se instancia el objeto
    self.color = ""   # Una clase tiene propiedades (estáticas)
    self.edad = 0    # La visibilidad por defecto es pública
    self.raza = ""
    self.nombre = ""
    self.color_ojos = ""
  def maulla(self):   # Un método es una acción que realiza el objeto
    return "miau"
  def setEdad(self,nuevaedad):
    if self.edad == nuevaedad - 1:
      self.edad = nuevaedad
    else:
      print("operación no permitida")
  def getEdad(self):
    return self.edad
    
gato1 = Gato()
print(gato1.maulla())
print("ahora mismo el gato tiene",gato1.getEdad(),"años")
gato1.setEdad(5)  # Esto es mucho más seguro
print("ahora mismo el gato tiene",gato1.getEdad(),"años")
```

<a id="creacion-de-constructores"></a>
## Creación de constructores

En el vasto y complejo mundo de la programación, los constructores son como las plantillas que nos permiten dar forma a nuestros objetos. Son métodos especiales dentro de una clase que se ejecutan automáticamente cuando un objeto es creado. Su principal objetivo es inicializar los atributos del objeto con valores específicos, preparándolo para su uso inmediato.

La creación de constructores es una práctica fundamental en la programación orientada a objetos (POO), ya que nos permite controlar cómo se instancian nuestros objetos y garantizar que estén en un estado válido desde el principio. Cada clase puede tener uno o más constructores, lo que proporciona flexibilidad para adaptarse a diferentes situaciones.

Los constructores son especialmente útiles cuando necesitamos asegurar que ciertos atributos no puedan estar nulos o vacíos al momento de la creación del objeto. Algunas clases pueden requerir que se especifiquen ciertos parámetros durante la instancia, lo que los constructores manejan con facilidad.

Además de los constructores predeterminados (que no requieren ningún parámetro), podemos definir constructores parametrizados, que permiten pasar valores específicos a los atributos del objeto al momento de su creación. Esta flexibilidad es crucial para crear objetos en estados deseados y evitar errores posteriores.

La creación de constructores también facilita la documentación y la comprensión del código. Al ver un constructor, podemos entender qué valores se esperan para inicializar los atributos del objeto, lo que nos ayuda a mantener el código limpio y fácil de mantener.

En resumen, la creación de constructores es una práctica esencial en la programación orientada a objetos. Nos permite controlar cómo se instancian nuestros objetos, garantizar su estado inicial válido y facilitar la documentación del código. A través de este proceso, podemos asegurar que nuestros programas sean más robustos, fáciles de mantener y menos propensos a errores.

### constructor

#### Explicación

Este código crea una clase llamada `Gato` en Python, que representa las características y comportamientos de un gato. La función `__init__()` dentro de la clase es un constructor especial que se ejecuta automáticamente cada vez que creamos (o instanciamos) un nuevo objeto del tipo `Gato`. En este constructor, inicializamos algunas propiedades como el color, edad, raza, nombre y color de ojos del gato. Estas propiedades permiten almacenar información específica para cada gato creado.

Además del constructor, la clase incluye métodos que son acciones que pueden realizar los objetos `Gato`. Por ejemplo, el método `maulla()` siempre devuelve el sonido "miau", simbolizando cómo un gato maulla. El método `setEdad(nuevaedad)` permite cambiar la edad del gato solo si la nueva edad es exactamente uno más que la edad actual. Esto proporciona una forma segura de actualizar la información, evitando errores potenciales. Por otro lado, el método `getEdad()` devuelve simplemente la edad actual del gato.

En resumen, este código muestra cómo utilizar clases y objetos en Python para modelar entidades como un gato con propiedades específicas y métodos que representan acciones o comportamientos relacionados con estos objetos.

```python
class Gato:

  def __init__(self): # El constructor se llama cuando se instancia el objeto
    self.color = ""   # Una clase tiene propiedades (estáticas)
    self.edad = 0    # La visibilidad por defecto es pública
    self.raza = ""
    self.nombre = ""
    self.color_ojos = ""
    
  def maulla(self):   # Un método es una acción que realiza el objeto
    return "miau"
    
  def setEdad(self,nuevaedad):
    if self.edad == nuevaedad - 1:
      self.edad = nuevaedad
    else:
      print("operación no permitida")
      
  def getEdad(self):
    return self.edad
    
gato1 = Gato()
print(gato1.maulla())
print("ahora mismo el gato tiene",gato1.getEdad(),"años")
gato1.setEdad(5)  # Esto es mucho más seguro
print("ahora mismo el gato tiene",gato1.getEdad(),"años")
```

### constructor con parameteros

#### Explicación

Este fragmento de código está creado para enseñar cómo se define una clase en Python y cómo trabajar con sus propiedades y métodos. En este caso, la clase se llama `Gato` y representa a un gato con características como color y edad. El constructor de la clase (`__init__`) recibe dos parámetros: `nuevocolor` para el color del gato y `nuevaedad` para su edad. Estos valores iniciales se asignan a las propiedades `color` y `edad` del objeto recién creado.

Además, la clase incluye métodos como `maulla()`, que simplemente devuelve un sonido de "miau", simbolizando cómo el gato reacciona en ciertas situaciones. También hay métodos llamados `setEdad()` y `getEdad()` para gestionar el valor de la edad del gato, permitiendo cambiar su edad solo si la nueva es exactamente una unidad mayor que la actual (por ejemplo, si un gato tiene 3 años, solo se puede establecer como 4 años directamente). Esto ayuda a mantener la consistencia en los datos y prevenir errores.

El último renglón de código crea una instancia del objeto `Gato` con el color "naranja" y edad inicial 0. Este ejemplo muestra cómo usar un constructor para definir las características iniciales de un objeto cuando se crea, lo cual es fundamental en programación orientada a objetos.

```python
class Gato:

  def __init__(self,nuevocolor,nuevaedad): # El constructor se llama cuando se instancia el objeto
    self.color = nuevocolor   # Una clase tiene propiedades (estáticas)
    self.edad = nuevaedad    # La visibilidad por defecto es pública
    
  def maulla(self):   # Un método es una acción que realiza el objeto
    return "miau"
    
  def setEdad(self,nuevaedad):
    if self.edad == nuevaedad - 1:
      self.edad = nuevaedad
    else:
      print("operación no permitida")
      
  def getEdad(self):
    return self.edad
    
gato1 = Gato("naranja",0)       # La edad no tiene sentido si cubrimos el nacimiento de un gato
```

### no todos los parametros en el constructor

#### Explicación

Este código Python muestra cómo crear una clase llamada `Gato` que modela las características y comportamientos de un gato. En la parte central del código, se define un constructor (`__init__`) que inicializa la propiedad `color` con el valor proporcionado cuando se crea un nuevo objeto de tipo `Gato`. El atributo `edad` se inicializa en 0 para todos los objetos `Gato`, sin necesidad de especificar una edad al momento de crearlos.

El código también incluye métodos como `maulla()` que simplemente devuelve la cadena "miau", representando el sonido que hace un gato. Además, hay dos métodos más: `setEdad(nuevaedad)` y `getEdad()`. El método `setEdad` permite actualizar la edad del gato solo si la nueva edad es exactamente uno mayor que la edad actual (representando así un año de diferencia). Si no se cumple esta condición, imprime "operación no permitida". Por otro lado, el método `getEdad()` simplemente devuelve la edad actual del gato.

La línea final `gato1 = Gato("naranja")` crea una instancia concreta de un objeto `Gato`, especificando que su color es naranja. Sin embargo, como no se proporciona ningún valor para la edad en el constructor, esta sigue siendo 0 por defecto. Esto ilustra cómo puedes inicializar algunas propiedades al crear un objeto y permitir que otras sean modificadas o no en función de las reglas que definas dentro de tus métodos.

Este tipo de diseño es importante porque permite controlar la forma en que se crea e interactúa con objetos, asegurando que los datos estén siempre en el estado correcto.

```python
class Gato:

  def __init__(self,nuevocolor): # El constructor se llama cuando se instancia el objeto
    self.color = nuevocolor   # Una clase tiene propiedades (estáticas)
    self.edad = 0    # La visibilidad por defecto es pública
    
  def maulla(self):   # Un método es una acción que realiza el objeto
    return "miau"
    
  def setEdad(self,nuevaedad):
    if self.edad == nuevaedad - 1:
      self.edad = nuevaedad
    else:
      print("operación no permitida")
      
  def getEdad(self):
    return self.edad
    
gato1 = Gato("naranja")       # La edad no tiene sentido si cubrimos el nacimiento de un gato
```

<a id="utilizacion-de-clases-y-objetos"></a>
## Utilización de clases y objetos

En el vasto terreno de la programación, las clases y los objetos son como las piezas fundamentales que conforman una estructura sólida. Comenzamos por entender qué son estas entidades esenciales antes de explorar cómo interactúan entre sí.

Las clases en programación son plantillas o modelos que definen las características comunes de un grupo de objetos. Son como moldeadores de cerámica, donde cada molde puede producir múltiples piezas idénticas pero con distintos atributos individuales. Cada clase tiene propiedades (variables) y métodos (funciones) que describen su comportamiento.

Los objetos, por otro lado, son instancias específicas de una clase. Al crear un objeto a partir de una clase, estamos creando una entidad concretas que posee las características definidas en la plantilla. Es como tomar un molde y hacerle una pieza de cerámica; cada pieza es única pero sigue el diseño del molde.

La relación entre clases y objetos es fundamental para la programación orientada a objetos (POO). Las clases actúan como contenedores que encapsulan datos y comportamientos, mientras que los objetos son las instancias concretas de estas clases. Esta distinción permite una organización jerárquica y modular del código, facilitando su mantenimiento y escalabilidad.

La creación de clases y objetos es un proceso iterativo. Primero se define la clase con sus propiedades y métodos, luego se crean los objetos basándose en esta definición. Cada objeto puede tener valores diferentes para las mismas propiedades, lo que permite representar múltiples entidades similares pero distintas.

La utilización de clases y objetos también facilita el reutilizar código. Una vez creada una clase, se pueden crear tantos objetos como sea necesario, cada uno con sus propias características específicas. Esto promueve la eficiencia y la consistencia en el desarrollo del software.

Además, las clases y los objetos permiten la abstracción, que es el proceso de simplificar complejidades reales del mundo real en conceptos más simples y manejables para el programa. Al definir una clase, se ocultan los detalles innecesarios y solo se expone lo necesario para su uso.

La programación orientada a objetos también fomenta la herencia, que es un mecanismo que permite crear nuevas clases basadas en clases existentes. Esta característica facilita el reutilizar código y organizar jerárquicamente las entidades del programa.

En resumen, las clases y los objetos son pilares fundamentales de la programación orientada a objetos. Permiten una organización eficiente, la reutilización de código y la abstracción, lo que resulta en software más robusto y fácil de mantener. Comprender cómo crear y utilizar clases y objetos es crucial para dominar el desarrollo de aplicaciones complejas y escalables.

### Multiples instancias

#### Explicación

Este código muestra cómo crear una clase en Python llamada `Gato` que representa a los gatos y sus propiedades. La función principal de esta clase es definir las características básicas de un gato, como su color y edad, además de incluir comportamientos específicos como maullar o cambiar la edad del gato. Cuando se crea una instancia de `Gato`, como en el caso de `gato1` y `gato2`, cada uno tiene sus propios atributos definidos, por ejemplo, `gato1` es naranja mientras que `gato2` es negro.

El método especial `__init__()` se encarga de inicializar las instancias de la clase con un color específico proporcionado cuando estas son creadas. También hay métodos como `maulla()`, que simplemente devuelve el sonido "miau", y otros métodos para gestionar la edad del gato, tales como `setEdad()` y `getEdad()`. Estos últimos permiten establecer la edad de un gato bajo ciertas condiciones y obtener su edad respectivamente.

Esta estructura es importante porque permite organizar el código en una forma modular y reutilizable. Por ejemplo, puedes crear tantas instancias de `Gato` como desees, cada una con sus propios atributos y comportamientos personalizados, lo que facilita la creación de programas más complejos y flexibles.

```python
class Gato:

  def __init__(self,nuevocolor): # El constructor se llama cuando se instancia el objeto
    self.color = nuevocolor   # Una clase tiene propiedades (estáticas)
    self.edad = 0    # La visibilidad por defecto es pública
    
  def maulla(self):   # Un método es una acción que realiza el objeto
    return "miau"
    
  def setEdad(self,nuevaedad):
    if self.edad == nuevaedad - 1:
      self.edad = nuevaedad
    else:
      print("operación no permitida")
      
  def getEdad(self):
    return self.edad
    
gato1 = Gato("naranja")       # La edad no tiene sentido si cubrimos el nacimiento de un gato
gato2 = Gato("negro")       # La edad no tiene sentido si cubrimos el nacimiento de un gato
```

### ejercicio practico clientes

#### Explicación

Este código define una clase llamada `Cliente` en Python. Una clase es como un plano o molde que se utiliza para crear objetos, que son entidades individuales con características y comportamientos específicos. En este caso, la clase `Cliente` tiene un método especial llamado `__init__`, el cual se ejecuta automáticamente cada vez que creamos un nuevo objeto de tipo `Cliente`. 

El método `__init__` recibe tres parámetros: `nuevonombre`, `nuevoemail` y `nuevadireccion`. Estos parámetros son utilizados para establecer los valores iniciales de las propiedades del cliente, que en este caso se llaman `nombre`, `email` y `direccion`. Estas propiedades permiten almacenar información específica sobre cada cliente que creamos. Por ejemplo, si creas un objeto `Cliente` con el nombre "Juan", su email "juan@example.com" y su dirección "Calle Falsa 123", el método `__init__` asignará estos valores a las propiedades del objeto correspondiente.

Esta estructura es importante porque permite organizar y encapsular la información de los clientes, haciendo que sea más fácil gestionar datos relacionados con cada cliente en un programa de programación.

```python
class Cliente:
  def __init__(self,nuevonombre,nuevoemail,nuevadireccion):
    self.nombre = nuevonombre
    self.email = nuevoemail
    self.direccion = nuevadireccion
    
```

### ahora introduccion por el usuario

#### Explicación

Este código es una pequeña parte de un programa en Python que enseña cómo trabajar con clases y objetos. En primer lugar, se define una clase llamada `Cliente` que tiene un método especial llamado `__init__`. Este método sirve para inicializar los atributos (o características) del objeto cuando este se crea. Aquí, el método toma tres parámetros: `nuevonombre`, `nuevoemail`, y `nuevadireccion`, luego asigna estos valores a las propiedades de la clase `self.nombre`, `self.email` e `self.dirección`.

Después del bloque de código que define la clase, el programa muestra un mensaje en pantalla indicando quién ha creado el programa. Luego, utiliza la función `input()` para pedir al usuario que introduzca el nombre, email y dirección de un cliente. Estos datos son almacenados en tres variables: `nombrecliente`, `emailcliente` e `direccioncliente`.

Finalmente, se crea una instancia (o objeto) de la clase `Cliente` usando los valores introducidos por el usuario. Esto significa que la información proporcionada se usa para crear un nuevo cliente con nombre, email y dirección específicos.

Este código es importante porque muestra cómo utilizar clases para organizar datos relacionados en objetos, lo cual es una técnica fundamental en programación orientada a objetos (POO).

```python
class Cliente:
  def __init__(self,nuevonombre,nuevoemail,nuevadireccion):
    self.nombre = nuevonombre
    self.email = nuevoemail
    self.direccion = nuevadireccion
    
print("Programa clientes por Jose Vicente Carratala")

nombrecliente = input("Introduce el nombre de un cliente: ")
emailcliente = input("Introduce el email de un cliente: ")
direccioncliente = input("Introduce la dirección de un cliente: ")

cliente1 = Cliente(nombrecliente,emailcliente,direccioncliente)
```

### print cliente

#### Explicación

Este código es una sencilla introducción a cómo crear y usar clases en Python, específicamente para gestionar información sobre clientes. En primer lugar, se define una clase llamada `Cliente` que tiene un método especial llamado `__init__`. Este método se ejecuta automáticamente cuando creamos un nuevo objeto de la clase `Cliente`, y sus tres parámetros (`nuevonombre`, `nuevoemail` y `nuevadireccion`) permiten inicializar las propiedades del cliente, como su nombre, email y dirección.

Después de definir la clase, el programa imprime una simple bienvenida o descripción sobre quién creó el código. Luego, pide al usuario que introduzca los datos de un nuevo cliente (nombre, email y dirección) utilizando funciones `input()`. Estos valores se usan para crear un objeto llamado `cliente1` a partir de la clase `Cliente`.

Finalmente, simplemente imprime en pantalla el objeto `cliente1`. Cuando imprimimos un objeto en Python, por defecto veremos una representación textual del objeto que incluye su tipo y ubicación en memoria. Este ejemplo es importante porque muestra cómo utilizar clases para organizar datos y comportamientos relacionados de manera estructurada.

```python
class Cliente:
  def __init__(self,nuevonombre,nuevoemail,nuevadireccion):
    self.nombre = nuevonombre
    self.email = nuevoemail
    self.direccion = nuevadireccion
    
print("Programa clientes por Jose Vicente Carratala")

nombrecliente = input("Introduce el nombre de un cliente: ")
emailcliente = input("Introduce el email de un cliente: ")
direccioncliente = input("Introduce la dirección de un cliente: ")

cliente1 = Cliente(nombrecliente,emailcliente,direccioncliente)

print(cliente1)
```

### recorrer claves

#### Explicación

Este código crea una clase llamada `Cliente` que nos permite almacenar la información de un cliente, como su nombre, email y dirección. Cuando se crea un objeto de esta clase a partir del constructor (el método `__init__`), se le pasa la información del cliente en forma de parámetros. Estos parámetros se utilizan para inicializar las propiedades del objeto, que son `nombre`, `email` y `direccion`.

El programa luego pide al usuario que introduzca el nombre, email y dirección de un cliente. Esta información es capturada por el código y utilizada para crear un nuevo objeto `Cliente`. Finalmente, se recorre este objeto utilizando un bucle `for` para mostrar en pantalla todas las propiedades (o atributos) del objeto `cliente1`, mostrando tanto la clave (nombre de la propiedad) como su valor.

Esta técnica es útil porque nos permite visualizar y verificar fácilmente los datos almacenados dentro de un objeto, lo que puede ser importante durante el desarrollo y depuración de programas más grandes.

```python
class Cliente:
  def __init__(self,nuevonombre,nuevoemail,nuevadireccion):
    self.nombre = nuevonombre
    self.email = nuevoemail
    self.direccion = nuevadireccion
    
print("Programa clientes por Jose Vicente Carratala")

nombrecliente = input("Introduce el nombre de un cliente: ")
emailcliente = input("Introduce el email de un cliente: ")
direccioncliente = input("Introduce la dirección de un cliente: ")

cliente1 = Cliente(nombrecliente,emailcliente,direccioncliente)

for clave in cliente1.__dict__:
  print("La pieza de información ",clave,"vale: ",cliente1.__dict__[clave])
```

<a id="utilizacion-de-clases-heredadas"></a>
## Utilización de clases heredadas

En la etapa de desarrollo de clases, el concepto de herencia es un pilar fundamental que nos permite crear jerarquías de clases relacionadas. Esta técnica permite a una clase derivada (también conocida como subclase) heredar atributos y métodos de una clase base (superclase), lo que facilita la reutilización del código y la organización lógica.

La herencia nos permite definir relaciones "es un" entre clases. Por ejemplo, si tenemos una clase `Animal` con propiedades como `nombre` y `edad`, podemos crear subclases como `Perro` y `Gato` que hereden de `Animal`. De esta manera, las subclases pueden agregar o modificar atributos y métodos específicos, mientras mantienen los atributos y métodos comunes definidos en la superclase.

La utilización de clases heredadas no solo simplifica el código al evitar la duplicidad, sino que también promueve la cohesión del diseño. Cada subclase puede tener su propio comportamiento específico, pero compartirá funcionalidades básicas con otras clases relacionadas. Esta organización lógica facilita la comprensión y mantenimiento del código.

Además de la reutilización del código, la herencia también permite una mejor escalabilidad. Al crear nuevas clases que heredan de una superclase existente, podemos aprovechar el trabajo ya realizado en la superclase sin necesidad de reinventar la rueda. Esto es especialmente útil cuando se necesita agregar funcionalidades adicionales a un conjunto de objetos similares.

La herencia también facilita la gestión de cambios en el código. Si una funcionalidad común debe modificarse, solo es necesario hacerlo en la superclase, y esta modificación se reflejará automáticamente en todas las subclases que la hereden. Esto reduce significativamente el riesgo de errores y asegura un mantenimiento más eficiente.

En resumen, la utilización de clases heredadas es una práctica esencial en la programación orientada a objetos. Permite crear jerarquías lógicas, reutilizar código, mejorar la escalabilidad y facilitar la gestión de cambios. Esta técnica es fundamental para el diseño de sistemas complejos y eficientes, permitiendo una organización coherente y una estructura clara del código.

### clase gato

#### Explicación

Este código define una clase en Python llamada `Gato`. Una clase es como un plano o modelo para crear objetos, en este caso, gatos. Dentro de la clase, se encuentra el método especial `__init__`, que actúa como constructor y se ejecuta automáticamente cuando se crea un nuevo objeto de tipo `Gato`. En este método, se inicializan dos atributos: `color` y `edad`, ambos establecidos en valores vacíos (`""`) o cero (0) respectivamente. Estos atributos representarán las características del gato que creemos con esta clase. Es importante porque nos permite crear objetos de tipo `Gato` que tendrán estas dos propiedades predefinidas, permitiéndonos luego asignarles valores específicos a cada animal individual que creamos en nuestro programa.

```python
class Gato:
  def __init__(self):
    self.color = ""
    self.edad = 0
```

### clase perro

#### Explicación

Este código define dos clases, `Gato` y `Perro`, ambas con un método especial llamado `__init__`. Este método se ejecuta automáticamente cuando se crea una nueva instancia de la clase (como si estuvieras creando nuevos gatos o perros en un programa). Dentro del método `__init__`, cada clase tiene dos atributos: `color` y `edad`. Estos atributos permiten almacenar información sobre el color y la edad del animal correspondiente. Es importante porque nos permite crear objetos que representan a gatos y perros con detalles específicos como su color y edad, lo cual es útil para simular comportamientos o guardar datos en un programa.

```python
class Gato:
  def __init__(self):
    self.color = ""
    self.edad = 0
    
class Perro:
  def __init__(self):
    self.color = ""
    self.edad = 0
```

### clase madre

#### Explicación

Este código está mostrando cómo crear clases en Python y utilizar la herencia, un concepto muy importante en programación orientada a objetos. Primero, se define una clase llamada `Animal`, que es como un modelo básico para cualquier animal. Dentro de esta clase, hay un método especial llamado `__init__` (que se ejecuta cada vez que creamos un nuevo objeto del tipo `Animal`). En este método inicializador, establecemos dos atributos: `color` y `edad`, pero no les damos ningún valor concreto al principio.

Luego, definimos dos nuevas clases llamadas `Gato` y `Perro`. Estas clases heredan de la clase `Animal`, lo que significa que `Gato` y `Perro` son tipos especiales de animales y heredan todas las características generales de un animal (como tener un color y una edad). Sin embargo, en este código específico, no se añaden nuevos atributos ni métodos a estas clases hijas.

Es importante notar que cuando creamos objetos de tipo `Gato` o `Perro`, aunque heredan del constructor (`__init__`) de la clase `Animal`, en el código actual no estamos inicializando explícitamente los atributos `color` y `edad`. Para hacer esto, deberíamos llamar al constructor de la clase padre con `super().__init__()`, pero aquí solo se llama a `super()`, lo que por sí solo no inicializa los atributos heredados.

Este código sirve como ejemplo básico para entender cómo funciona la herencia en Python y cómo las clases hijas pueden iniciar el proceso de construcción desde su clase padre.

```python
class Animal():
  def __init__(self):
    self.color = ""
    self.edad = 0

class Gato(Animal):
  def __init__(self):
    super()
    
class Perro(Animal):
  def __init__(self):
    super()
```

### usando la clase madre

#### Explicación

Este código crea una jerarquía de clases en Python que representa animales y dos tipos específicos de animales: gatos y perros. Comenzamos con la clase `Animal`, que es la clase base o madre, y tiene un constructor (`__init__`) donde se inicializan atributos comunes a todos los animales como el color y la edad.

Luego definimos dos clases derivadas de `Animal`: `Gato` y `Perro`. Estas clases también tienen sus propios constructores, pero utilizan `super().__init__()` para llamar al constructor de la clase base `Animal`, lo que asegura que los atributos heredados se inicialicen correctamente. 

Finalmente, creamos una instancia de la clase `Gato` llamada `gato1`. Aunque no se especifica explícitamente en el código, esta instancia tiene acceso a todos los atributos y métodos definidos tanto para la clase `Gato` como para su superclase `Animal`, aunque por ahora solo hemos inicializado dos variables pero sin darles valores específicos. Al imprimir `gato1.edad`, se muestra que `edad` es 0, el valor predeterminado que se estableció en la clase base `Animal`. Esto demuestra cómo las clases hijas pueden heredar atributos y métodos de sus clases padres.

```python
class Animal():
  def __init__(self):
    self.color = ""
    self.edad = 0

class Gato(Animal):
  def __init__(self):
    super().__init__()
    
class Perro(Animal):
  def __init__(self):
    super().__init__()
    
gato1 = Gato()
print(gato1.edad)
```

### Roca

#### Explicación

Este código está creando una estructura básica para trabajar con clases y herencia en Python. Comenzamos declarando una clase llamada `Animal` que tiene un constructor (`__init__`) donde se definen dos propiedades: `color` y `edad`, ambas inicializadas como cadenas vacías y cero, respectivamente.

Luego, creamos dos nuevas clases, `Gato` e `Perro`, que heredan de la clase `Animal`. Esto significa que tanto el gato como el perro tendrán automáticamente las propiedades y métodos (aunque no haya ninguno mostrado en este fragmento) definidos en la clase `Animal`.

En el constructor de cada una de estas subclases (`Gato` e `Perro`), utilizamos `super().__init__()` para llamar al constructor de la clase padre (`Animal`). Esto asegura que las propiedades heredadas (como `color` y `edad`) se inicialicen correctamente.

Finalmente, creamos una instancia de `Gato` llamada `gato1` e imprimimos su propiedad `edad`. Aunque no se ha especificado un valor para la edad del gato al crearlo, debido a cómo está definida en la clase `Animal`, `edad` tiene el valor predeterminado de 0.

Este ejemplo es fundamental porque muestra cómo organizar y reutilizar código mediante la herencia entre clases.

```python
class Animal():
  def __init__(self):
    self.color = ""
    self.edad = 0

class Gato(Animal):
  def __init__(self):
    super().__init__()
    
class Perro(Animal):
  def __init__(self):
    super().__init__()
    
gato1 = Gato()
print(gato1.edad)
```

### nivel superior de herencia

#### Explicación

Este código define una estructura de clases en Python que representa diferentes tipos de objetos, rocas y animales. Comenzamos con una clase base llamada `Objeto` que establece tres atributos: `x`, `y` y `z`. Estos pueden ser interpretados como coordenadas en un espacio tridimensional.

Luego, creamos dos clases derivadas directas de la clase `Objeto`: `Roca` y `Animal`. La clase `Roca` no añade nada nuevo a lo que hereda de `Objeto`, mientras que `Animal` agrega dos atributos adicionales: `color` y `edad`.

Finalmente, definimos dos clases más que derivan de la clase `Animal`: `Gato` e `Perro`. Estas clases también no añaden nuevos atributos o métodos, simplemente heredan todo lo que tienen las clases base. Al final del código, creamos una instancia de la clase `Gato` llamada `gato1`, y luego imprimimos el valor de su edad, que por defecto es 0 ya que no se ha inicializado con un valor específico.

Este ejemplo ilustra cómo usar la herencia en Python para crear jerarquías de clases y compartir comportamiento común entre diferentes tipos de objetos. Es importante porque permite organizar el código de manera eficiente y evitar duplicar código innecesariamente.

```python
class Objeto():
  def __init__(self):
    self.x = 0
    self.y = 0
    self.z = 0  

class Roca(Objeto):
  def __init__(self):
    super().__init__()

class Animal(Objeto):
  def __init__(self):
    super().__init__()
    self.color = ""
    self.edad = 0
    
class Gato(Animal):
  def __init__(self):
    super().__init__()
    
class Perro(Animal):
  def __init__(self):
    super().__init__()
    
gato1 = Gato()
print(gato1.edad)
```

### Ejercicio acumulativo

#### Explicación

Este código crea una clase llamada `Animal` en Python. La función `__init__` es el constructor de la clase, que se ejecuta automáticamente cuando se crea un nuevo objeto del tipo `Animal`. En este caso, el constructor inicializa tres atributos: `color`, `edad` y `__raza`.

- `self.color` y `self.edad` son dos propiedades públicas que permiten establecer y acceder fácilmente al color y la edad del animal.
- `self.__raza` es una propiedad privada, indicada por el doble guion bajo (`__`) antes de su nombre. Esto significa que está oculta para otras partes del código fuera de esta clase y no se puede modificar directamente desde afuera.

La importancia de este fragmento radica en cómo define las características básicas que tendrá cualquier objeto `Animal` creado a partir de ella, estableciendo una estructura común que luego podría ser personalizada por clases derivadas (heredadas) para crear animales más específicos con comportamientos y atributos únicos.

```python
class Animal():
  def __init__(self):
    self.color = ""
    self.edad = 0
    self.__raza = 0
```

### Enunciado

#### Explicación

Este código es una guía para crear un programa sencillo en Python que gestiona dos animales, un Gato y un Perro, mediante la herencia de clases. El objetivo principal es aprender cómo usar clases base y sus derivadas para encapsular información y comportamiento específicos.

El código comienza definiendo una clase base llamada `Animal`, que tiene propiedades como el color, la edad y la raza del animal (la última es privada). La clase también incluye métodos para establecer y obtener los valores de estas propiedades, así como un método `descripcion()` que devuelve una cadena con información básica sobre el animal. Además, se deben implementar validaciones en el método `setEdad()`, asegurando que solo se pueda incrementar la edad en uno.

A continuación, se crean dos clases derivadas: `Gato` y `Perro`. Estas clases heredan de la clase base `Animal` y añaden métodos propios para simular comportamientos específicos como maullar o ladrar. También incluyen validaciones adicionales en función del tipo de animal, por ejemplo, limitando su edad máxima.

El programa debe interactuar con el usuario para obtener información sobre los animales, realizar validaciones y clasificarlos según su edad. Utiliza bucles `while` para simular el paso del tiempo solo para el gato, incrementando su edad hasta alcanzar la edad que se ha establecido inicialmente. Finalmente, presenta una ficha detallada de cada animal y realiza comprobaciones booleanas sobre sus características, como determinar si al menos uno es "adulto" o ambos son "cachorros".

Este ejercicio es importante para entender cómo organizar el código en clases y objetos, así como para practicar la herencia y los métodos propios de cada clase derivada.

```markdown
Objetivo

Crear un pequeño programa de consola que gestione dos animales (un Gato y un Perro) heredando de una clase base Animal. El programa pedirá datos al usuario, aplicará validaciones, clasificará a los animales por edad y mostrará una “ficha” de cada uno.

Requisitos funcionales

Clase base Animal

Propiedades públicas: color (cadena), edad (entero, empieza en 0).

Propiedad privada: __raza (cadena).

Constructor sin parámetros que inicialice valores por defecto.

Métodos:

setEdad(nuevaedad): solo permite incrementar la edad exactamente de uno en uno (si self.edad == nuevaedad - 1, entonces asigna; si no, imprime “operación no permitida”).

getEdad(): devuelve la edad.

setRaza(raza) y getRaza().

descripcion(): devuelve (no imprime) una cadena corta con color, edad y raza.

Añade un docstring a la clase o a algún método explicando qué hace.

Clases hijas Gato y Perro

Heredan de Animal.

Sus constructores llaman a super().__init__().

Cada una tiene un método propio:

Gato.maulla() → imprime "miau".

Perro.ladra() → imprime "guau".

Constantes y validaciones

Define constantes en MAYÚSCULAS (por ejemplo EDAD_MAX_GATO = 25, EDAD_MAX_PERRO = 30).

Aserción: al finalizar la entrada de datos, asegura con assert que ninguna edad es negativa.

Excepción: cuando leas la edad desde input(), conviértela a int dentro de un try/except. Si hay error, muestra un mensaje y pon la edad a 0.

Interacción por consola

Muestra un mensaje inicial con tu nombre (print).

Pide al usuario:

Color del gato y del perro.

Raza del gato y del perro.

Edad inicial del gato y del perro (entero).

Clasificación por edad (usar if/elif/else):

< 1 → “cachorro”

>= 1 y < 7 → “adulto joven”

>= 7 → “adulto”

Imprime la categoría para cada animal.

Bucle y operadores abreviados

Simula el paso del tiempo para el gato: usando un while, incrementa su edad con += 1 hasta alcanzar la edad que indique el usuario (p. ej., “¿hasta qué edad quieres simular?”).

Cada intento de cambio de edad debe hacerse únicamente a través de setEdad() para respetar la regla.

Funciones auxiliares

Crea una función libre formatea_ficha(animal, titulo) que devuelva una cadena multilínea con la ficha (usa el descripcion() del animal).

Crea otra función clasifica_edad(edad) que devuelva la categoría (“cachorro”, “adulto joven”, “adulto”) y reutilízala para gato y perro.

Uso básico de booleanos

Imprime si al menos uno de los dos animales es “adulto” (usa or con la clasificación).

Imprime si ambos son “cachorro” (usa and).

Recorrido de propiedades

Muestra por pantalla todas las propiedades públicas del perro recorriendo perro.__dict__ con un for y formatea clave: valor.

Salida final requerida

Fichas de Gato y Perro (devueltas por formatea_ficha(...) y luego impresas).

Categorías por edad.

Mensajes del bucle de simulación (cómo va creciendo el gato).

Resultados de las comprobaciones booleanas.

Nota: no uses listas/arrays ni ficheros.
```

### metodos

#### Explicación

Este código define una clase llamada `Animal` que representa las características básicas de un animal, como su edad, color y raza. La clase incluye métodos para establecer (`set`) y obtener (`get`) valores para la edad y la raza del animal.

El método `__init__()` es el constructor de la clase, donde se inicializan los atributos: `color`, `edad` (con valor 0) y `raza`. La raza está definida con dos guiones bajos al principio (`self.__raza`) lo que indica que es un atributo privado, visible solo dentro de esta clase.

Los métodos `setEdad()` y `getEdad()` permiten cambiar y obtener el valor de la edad del animal. Sin embargo, hay un error en el método `setEdad()`, ya que falta el dos puntos al final de la condición if. Además, la lógica para incrementar la edad solo se ejecuta si la nueva edad es exactamente 1 más que la edad actual, lo cual puede no ser el comportamiento deseado.

El método `setRaza()` establece el valor de raza y debería incluir un dos puntos al final de su definición para ser correcto. El método `getRaza()`, por otro lado, devuelve la raza del animal pero intenta acceder a `self.raza` en lugar de `self.__raza`, lo que provocará un error debido a que `__raza` es privado.

Por último, el método `descripcion()` tiene un error sintáctico y una lógica inadecuada. Debería devolver una cadena con la edad, color y raza del animal en lugar de sumar estos valores como si fueran números. Además, debido a que `__raza` es privado, no se puede acceder directamente desde este método.

Es importante corregir estos errores para que los métodos funcionen correctamente y respeten el uso de atributos privados.

```python
class Animal():
  '''
    Clase Animal, define edad, color y raza
  '''
  def __init__(self):
    self.color = ""
    self.edad = 0
    self.__raza = 0
  def setEdad(self,nuevaedad):
    if self.edad == nuevaedad - 1
      self.edad += 1
  def getEdad(self):
    return self.edad
  def setRaza(self,nuevaraza)
    self.raza = nuevaraza
  def getRaza(self):
    return self.raza
  def descripcion():
    return str(self.edad)+self.color+self.__raza
    
```

### clases hijas

#### Explicación

Este código es una parte de un programa llamado "Refugio", que está diseñado para gestionar animales en un refugio. El programa define una clase base llamada `Animal` y dos clases derivadas, `Gato` y `Perro`. La clase `Animal` tiene atributos como color, edad y raza (privado), y métodos para establecer y obtener estos valores. Además, hay un método `descripcion()` que intenta devolver una cadena combinando la edad del animal, su color y su raza privada.

Sin embargo, el código presenta algunas inconsistencias:

- El método `setEdad` debería tener dos puntos al final de su definición (`:`) para indicar que es un bloque de código dentro de la clase.
- En el método `descripcion()`, hay un error ya que se está intentando devolver una cadena combinada con `__raza`, que es un atributo privado no inicializado correctamente (debería ser un string, pero está declarado como número).
- La sintaxis para definir las clases derivadas (`Gato` y `Perro`) tiene errores. Estas deben heredar de la clase `Animal`. Por ejemplo: `class Gato(Animal):`.
- Los métodos `__init__()` en las subclases deberían tomar el parámetro `self` al igual que cualquier otro método en Python.

A pesar de estos errores, el código intenta modelar comportamientos específicos para cada tipo de animal (un gato maulla y un perro ladra) a través del uso de herencia. La idea es crear instancias de estas clases subclase para representar diferentes animales en el refugio con características propias.

Es importante corregir los errores mencionados para que el código funcione correctamente y se pueda utilizar eficazmente en un sistema de gestión de refugios para animales.

```python
'''
  Programa refugio
  (c) 2025 Jose Vicente Carratala
  Este programa gestiona un refugio
'''

class Animal():
  '''
    Clase Animal, define edad, color y raza
  '''
  def __init__(self):
    self.color = ""
    self.edad = 0
    self.__raza = 0
  def setEdad(self,nuevaedad):
    if self.edad == nuevaedad - 1
      self.edad += 1
  def getEdad(self):
    return self.edad
  def setRaza(self,nuevaraza)
    self.raza = nuevaraza
  def getRaza(self):
    return self.raza
  def descripcion():
    return str(self.edad)+self.color+self.__raza

def Gato(Animal):
  def __init__():
    super().__init__()
  def maulla(self):
    print("miau")

def Perro(Animal):
  def __init__():
    super().__init__()
  def ladra(self):
    print("guau")
    
    
    
    
```

### continuamos con el ejercicio

#### Explicación

Este programa es una simulación de un refugio para animales que gestiona a dos tipos específicos: gatos y perros. Se define una clase base llamada `Animal` con atributos como color, edad y raza (esta última es privada). La clase `Gato` hereda de `Animal` e incluye un método `maulla()`, mientras que la clase `Perro` también hereda de `Animal` pero tiene su propio método `ladra()`.

El programa permite al usuario ingresar información sobre el color y raza del gato y del perro, así como su edad. También se verifica que las edades ingresadas sean válidas (números enteros) y no negativas mediante la función `assert`. Además, incluye una función llamada `clasifica_edad()` que clasifica a los animales en categorías basadas en sus edades: cachorros, adultos jóvenes o adultos.

Una parte interesante es cómo simula el crecimiento del gato incrementando su edad de manera controlada mediante el método `setEdad()`. Este método permite aumentar la edad solo en un año a la vez y limita la simulación hasta cierta edad máxima para gatos (EDAD_MAX_GATO).

Finalmente, muestra una ficha descriptiva con los datos del gato y del perro, incluyendo sus propiedades públicas. Este programa ayuda a entender cómo las clases heredadas pueden ser utilizadas para extender la funcionalidad de clases base, proporcionando comportamientos específicos para cada tipo de animal mientras comparten características generales como color y raza.

```python
'''
  Programa refugio
  (c) 2025 Jose Vicente Carratala
  Este programa gestiona un refugio
'''

class Animal:
  '''
    Clase Animal: define color (str), edad (int) y raza (privada)
  '''
  def __init__(self):
    self.color = ""
    self.edad = 0
    self.__raza = ""

  def setEdad(self, nuevaedad):
    # Solo permite incrementos de 1 en 1
    if self.edad == nuevaedad - 1:
      self.edad += 1
    else:
      print("operación no permitida")

  def getEdad(self):
    return self.edad

  def setRaza(self, nuevaraza):
    self.__raza = str(nuevaraza)

  def getRaza(self):
    return self.__raza

  def descripcion(self):
    return "Edad: " + str(self.edad) + ", Color: " + self.color + ", Raza: " + self.__raza


class Gato(Animal):
  def __init__(self):
    super().__init__()
  def maulla(self):
    print("miau")


class Perro(Animal):
  def __init__(self):
    super().__init__()
  def ladra(self):
    print("guau")


EDAD_MAX_GATO = 25
EDAD_MAX_PERRO = 30

print("Hoy soy Jose Vicente y bienvenido a mi refugio")

perro = Perro()
gato = Gato()

# --- Entrada de datos con validación básica ---
gato.color = input("Introduce el color del gato: ")
perro.color = input("Introduce el color del perro: ")

gato.setRaza(input("Introduce la raza del gato: "))
perro.setRaza(input("Introduce la raza del perro: "))

try:
  gato.edad = int(input("Introduce la edad del gato (entero): "))
except:
  print("Edad del gato inválida, se establece a 0")
  gato.edad = 0

try:
  perro.edad = int(input("Introduce la edad del perro (entero): "))
except:
  print("Edad del perro inválida, se establece a 0")
  perro.edad = 0

# Aserciones: no negativas
assert gato.edad >= 0 and perro.edad >= 0, "hay un error: edad negativa"

# --- Clasificación por edad ---
def clasifica_edad(edad):
  if edad < 1:
    return "cachorro"
  elif edad < 7:
    return "adulto joven"
  else:
    return "adulto"

print("El gato es:", clasifica_edad(gato.edad))
print("El perro es:", clasifica_edad(perro.edad))

# --- Simulación de crecimiento del gato respetando setEdad ---
try:
  edad_maxima = int(input("¿Hasta qué edad quieres simular para el gato? "))
except:
  print("Edad de simulación inválida, se usará la edad actual del gato")
  edad_maxima = gato.edad

if edad_maxima > EDAD_MAX_GATO:
  print("Aviso: superaría EDAD_MAX_GATO, se limitará a", EDAD_MAX_GATO)
  edad_maxima = EDAD_MAX_GATO

edad_actual = gato.getEdad()
# Avanza de uno en uno usando setEdad (desde la siguiente edad)
objetivo = edad_maxima
siguiente = edad_actual + 1
while siguiente <= objetivo:
  gato.setEdad(siguiente)
  print("Gato ahora tiene:", gato.getEdad())
  siguiente += 1

# --- Mostrar descripciones finales ---
print("Ficha del gato:", gato.descripcion())
print("Ficha del perro:", perro.descripcion())

# --- Recorrer propiedades públicas del perro ---
print("Propiedades públicas del perro:")
for clave in perro.__dict__:
  # __raza está name-mangled y no aparecerá como clave simple, mostramos lo visible
  print(clave, ":", perro.__dict__[clave])
```


<a id="lectura-y-escritura-de-informacion"></a>
# Lectura y escritura de información

<a id="flujos-tipos-bytes-y-caracteres-clases-relacionadas"></a>
## Flujos. Tipos bytes y caracteres. Clases relacionadas

En el vasto mundo de la programación, los flujos de datos desempeñan un papel fundamental, ya que son la vía por la cual se transfieren información entre diferentes partes del programa. Los flujos pueden ser de dos tipos principales: bytes y caracteres, cada uno con sus propias características y clases relacionadas.

Los flujos de bytes representan los datos en su forma más básica, como una secuencia de ceros y unos. En la programación, estos flujos se manejan a través de las clases `InputStream` y `OutputStream`, que proporcionan métodos para leer y escribir datos en formatos binarios. Estas clases son fundamentales para operaciones como la lectura de archivos binarios o la transmisión de datos a través de sockets.

Por otro lado, los flujos de caracteres manejan los datos en su forma más legible, como texto. En este contexto, las clases `Reader` y `Writer` son esenciales. Estas clases proporcionan métodos para leer y escribir cadenas de texto, convirtiéndolas automáticamente entre bytes y caracteres según la codificación especificada. El uso de flujos de caracteres facilita el manejo de información textual en programas, ya que no requiere preocuparse por los detalles del formato binario.

La relación entre estos flujos es estrecha, ya que ambos pueden ser adaptados para funcionar juntos. Por ejemplo, la clase `BufferedReader` puede leer datos de un flujo de caracteres y proporcionar una interfaz más eficiente para la lectura de texto. De manera similar, la clase `BufferedWriter` puede escribir datos a un flujo de caracteres, optimizando el rendimiento al reducir el número de operaciones de escritura.

Además de las clases básicas, existen varias subclases que proporcionan funcionalidades adicionales y especializadas. Por ejemplo, la clase `FileInputStream` permite leer datos directamente desde un archivo en formato binario, mientras que la clase `FileWriter` permite escribir datos a un archivo en formato texto. Estas clases son útiles cuando se necesita trabajar con archivos específicos sin tener que preocuparse por los detalles del flujo de datos.

La gestión adecuada de flujos es crucial para el rendimiento y la eficiencia de cualquier programa. Al manejar correctamente los flujos, se puede evitar la pérdida de información o la corrupción de datos durante la lectura y escritura. Además, la optimización del uso de flujos puede mejorar significativamente el tiempo de ejecución de un programa.

En resumen, los flujos de bytes y caracteres son elementos esenciales en la programación, proporcionando las herramientas necesarias para manejar información textual y binaria de manera eficiente. A través de clases como `InputStream`, `OutputStream`, `Reader` y `Writer`, se puede realizar una amplia gama de operaciones de entrada y salida, desde la lectura de archivos hasta la transmisión de datos a través de redes.

La comprensión y el uso adecuado de flujos son fundamentales para cualquier programador que quiera crear aplicaciones robustas y eficientes. Al dominar estas técnicas, se puede asegurar que los programas funcionen correctamente y sean capaces de manejar grandes volúmenes de datos con eficiencia.

### flujo de caracteres

#### Explicación

Este código muestra cómo abrir y escribir información en un archivo utilizando Python. Primero, se abre el archivo llamado "clientes.txt" en modo escritura ('w'). Si el archivo ya existe, lo sobrescribirá; si no existe, creará uno nuevo con ese nombre.

Luego, la línea `archivo.write("Esto es un contenido desde python")` inserta texto en el archivo que acabamos de abrir. En este caso, estamos escribiendo una frase específica: "Esto es un contenido desde python".

Finalmente, al llamar a `archivo.close()`, cerramos el archivo para asegurarnos de que toda la información se guarda correctamente y que los recursos del sistema no quedan bloqueados.

Este proceso es crucial en programación ya que permite almacenar datos permanentemente en archivos, lo cual es útil para mantener registros, bases de datos simples o cualquier otro tipo de información que necesites guardar fuera del programa.

```python
archivo = open("clientes.txt",'w')
archivo.write("Esto es un contenido desde python")
archivo.close()
```

### leer

#### Explicación

Este código Python te enseña cómo leer el primer renglón de un archivo de texto llamado "clientes.txt". Primero, se abre el archivo en modo lectura ('r'), lo que significa solo vas a leer su contenido sin modificarlo. La función `open()` crea una conexión con el archivo y asigna esta conexión al objeto llamado "archivo".

Luego, la línea `linea = archivo.readline()` lee el primer renglón del archivo abierto y guarda esa información en la variable llamada "linea". Después de esto, se imprime ese contenido de texto utilizando la función `print(linea)`, lo que te muestra en la pantalla el primer renglón del archivo.

Finalmente, es crucial cerrar el archivo con `archivo.close()` para liberar los recursos del sistema ocupados por este proceso. Esto asegura que no hay errores ni problemas de rendimiento relacionados con tener archivos abiertos innecesariamente.

```python
archivo = open("clientes.txt",'r')
linea = archivo.readline()
print(linea)
archivo.close()
```

### uso de pickle para binario

#### Explicación

Este código utiliza la biblioteca `pickle` en Python para guardar datos de manera binaria en un archivo. La línea `mensaje = "esto es un mensaje"` crea una variable llamada `mensaje` que almacena una cadena de texto simple.

Luego, se abre un archivo llamado `"cliente.bin"` en modo escritura binaria (`'wb'`). Esto significa que el archivo va a ser creado o sobrescrito con datos binarios, no texto. La función `pickle.dump(mensaje, archivo)` toma la variable `mensaje` y la guarda dentro del archivo abierto de forma binaria. Finalmente, se cierra el archivo con `archivo.close()` para asegurar que todos los cambios se hayan guardado correctamente.

Este proceso es importante porque permite almacenar datos complejos en formatos no legibles por humanos pero eficientes para el programa y su uso posterior. Utilizar `pickle` para guardar información binaria puede ser útil cuando necesitas preservar la estructura exacta de los objetos en Python, como listas, diccionarios, etc., más allá de simplemente almacenar texto plano.

```python
import pickle

mensaje = "esto es un mensaje"
archivo = open("cliente.bin",'wb')

pickle.dump(mensaje, archivo)
archivo.close()
```

### pickle para leer

#### Explicación

Este código Python se utiliza para leer información de un archivo binario utilizando el módulo `pickle`. Primero, se importa la biblioteca `pickle`, que es útil para guardar y cargar datos complejos en archivos. Luego, se abre un archivo llamado "cliente.bin" en modo de lectura binaria (`'rb'`). Con la función `pickle.load()`, el programa lee los datos serializados desde este archivo y los almacena en la variable `mensaje`. Finalmente, imprime estos datos deserializados y cierra el archivo para asegurar que todos los cambios se han guardado correctamente. Esta técnica es importante cuando necesitas almacenar estructuras de datos complejas, como listas o diccionarios, en un archivo y luego recuperarlas exactamente igual a cómo fueron guardadas.

```python
import pickle

archivo = open("cliente.bin",'rb')

mensaje = pickle.load(archivo)
print(mensaje)
archivo.close()
```

### clientes

#### Explicación

Este fragmento de código parece ser simplemente una línea de texto que podría estar almacenada en un archivo o impresa por un programa escrito en Python. No se trata de instrucciones de programación propiamente dichas, sino más bien de información textual que el programa maneja. En este caso, "Esto es un contenido desde python" sería una cadena de texto que un programa podría leer desde un archivo o escribir en él.

Si estuviéramos trabajando con Python y tratáramos de manipular o procesar archivos de texto, este tipo de línea puede aparecer dentro del propio código como parte de la lógica para leer o escribir información. Por ejemplo, podría ser el contenido que un programa lee desde un archivo llamado `clientes.txt` y luego muestra en pantalla.

Es importante entender cómo manejar cadenas de texto cuando se trabaja con archivos ya que permite a los programas interactuar con datos almacenados en ficheros del sistema, lo cual es fundamental para muchas aplicaciones prácticas.

```
Esto es un contenido desde python
```

<a id="ficheros-de-datos-registros"></a>
## Ficheros de datos. Registros

En el vasto mundo de la programación, los ficheros de datos desempeñan un papel fundamental como almacenadores de información persistente. Al explorar esta subunidad didáctica, nos sumergimos en la comprensión del manejo de estos archivos, una habilidad esencial para cualquier desarrollador.

El primer paso hacia el dominio de los ficheros es entender su estructura básica: un fichero puede ser visto como una colección ordenada de registros. Cada registro, a su vez, está formado por campos individuales que contienen datos específicos. Esta organización permite una representación eficiente y accesible de la información.

La lectura y escritura de ficheros es un proceso bidireccional que implica el acceso y modificación de estos registros. La lectura nos permite recuperar los datos almacenados, mientras que la escritura nos brinda la capacidad de actualizar o agregar nueva información. Este flujo continuo entre el programa y el fichero es crucial para mantener la integridad y coherencia de los datos.

La manipulación de ficheros implica también la gestión de flujos de datos. Los flujos son canales que permiten la transmisión de información desde el programa hacia el fichero o viceversa. La comprensión de estos flujos es fundamental para optimizar el rendimiento del proceso de lectura y escritura.

Además, los ficheros pueden almacenar diferentes tipos de datos: bytes, caracteres, registros completos, entre otros. Cada tipo requiere un enfoque específico en la manipulación, desde la codificación hasta la deserialización. Esta diversidad añade complejidad pero también riqueza al manejo de información.

La seguridad es otro aspecto crucial a considerar cuando se trabaja con ficheros. La protección contra accesos no autorizados y la prevención de corrupciones son tareas que deben ser abordadas desde el diseño hasta la implementación del código. Herramientas y técnicas específicas pueden ayudar en esta tarea, pero es fundamental mantener un enfoque proactivo.

La eficiencia en la lectura y escritura de ficheros también es un objetivo importante. Algoritmos optimizados y estructuras de datos adecuadas pueden reducir significativamente el tiempo y recursos necesarios para manipular grandes volúmenes de información. Esta optimización no solo mejora el rendimiento del programa, sino que también lo hace más escalable.

En la práctica, los ficheros son utilizados en una amplia gama de aplicaciones. Desde bases de datos hasta sistemas operativos y aplicaciones web, su manejo es un componente fundamental. Comprender cómo trabajar con ellos nos proporciona las herramientas necesarias para desarrollar software robusto y eficiente.

La lectura y escritura de ficheros también implica la gestión de excepciones. Situaciones como errores de acceso o problemas de formato pueden surgir durante el proceso, y es crucial tener en cuenta estas posibilidades para mantener la estabilidad del programa.

Finalmente, la documentación es un aspecto no menos importante que el código mismo. Comentar adecuadamente las operaciones realizadas sobre los ficheros nos ayuda a entender su funcionamiento y facilita futuras modificaciones o mantenimiento.

En resumen, la lectura y escritura de ficheros es una habilidad multifacética y fundamental en la programación. Desde la comprensión de sus estructuras hasta la implementación de soluciones eficientes y seguras, cada paso requiere un enfoque cuidadoso y una comprensión profunda del contexto en el que se está trabajando.

### escribir un txt

#### Explicación

Este código Python se utiliza para escribir información en un archivo de texto llamado "clientes.txt". En primer lugar, el programa abre el archivo en modo escritura ('w'), lo que significa que cualquier dato nuevo escrito en él sobrescribirá cualquier contenido existente. A continuación, la función `write()` es utilizada para insertar una cadena específica ("Esto es un contenido desde python") dentro del archivo recién abierto. Finalmente, el método `close()` cierra el archivo después de completar las operaciones para evitar problemas relacionados con la gestión de recursos.

Este fragmento es importante porque demuestra cómo interactuar con archivos en Python, una habilidad fundamental para realizar tareas como guardar datos persistentes o generar informes automáticos.

```python
archivo = open("clientes.txt",'w')
archivo.write("Esto es un contenido desde python")
archivo.close()
```

### escribir un csv

#### Explicación

Este código Python se utiliza para agregar información a un archivo llamado `clientes.csv`. Primero, el programa abre el archivo en modo append (`'a'`), lo que significa que cualquier dato que escribas será añadido al final del archivo sin sobrescribir nada existente. Luego, utiliza la función `write()` para introducir dos líneas de texto en formato CSV (Valores Separados por Comas). Cada línea representa a un cliente y contiene sus datos como nombre, dirección y número de teléfono. Finalmente, cierra el archivo con `close()`. Este método es importante porque permite mantener registros de clientes de manera organizada y fácil de leer tanto para humanos como para programas informáticos que procesan datos en formato CSV.

```python
archivo = open("clientes.csv",'a')
archivo.write("Juan,Calle de Juan,5325434\n")
archivo.write("Jorge,Calle de Jorge,5234535\n")
archivo.close()
```

### creo un diccionario y lo guardo como json

#### Explicación

Este fragmento de código se utiliza para guardar una lista de diccionarios que contienen información sobre clientes en un archivo JSON. En primer lugar, el programa importa la biblioteca `json`, que proporciona funciones para trabajar con datos estructurados como objetos JSON.

Luego, se crea una lista llamada `clientes` que contiene dos diccionarios. Cada diccionario representa a un cliente y almacena sus detalles personales como nombre, apellidos y dirección de correo electrónico. Esta estructura es útil porque permite organizar información compleja en una forma fácil de manejar.

El siguiente paso es abrir un archivo llamado `clientes.json` en modo de escritura (`"w"`), lo que significa que cualquier contenido existente en el archivo será reemplazado por la nueva información. Se utiliza la función `json.dump()` para escribir los datos de la lista `clientes` en este archivo. La opción `indent=4` asegura que el JSON se formatee con sangrías para mejor legibilidad, y `ensure_ascii=False` garantiza que caracteres especiales o no ASCII (como acentos) sean escritos correctamente sin codificación extra.

Esta operación es importante porque permite guardar datos estructurados de manera eficiente en un formato fácilmente accesible tanto por humanos como por otros programas.

```python
import json

clientes = [
  {
    "nombre":"jose Vicente",
    "apellidos":"Carratala Sanchis",
    "email":"info@jocarsa.com"
  },
  {
    "nombre":"Juan",
    "apellidos":"Garcia Lopez",
    "email":"juan@jocarsa.com"
  }
]

archivo = open("clientes.json","w")

json.dump(clientes, archivo, indent=4, ensure_ascii=False)
```

### agenda de clientes

#### Explicación

Este fragmento de código es el comienzo de un programa sencillo en Python que permite gestionar una agenda de clientes. El programa muestra al usuario varias opciones para interactuar con la lista de clientes, como insertar, listar, actualizar o eliminar registros.

Cuando se ejecuta, el programa imprime un menú con las diferentes acciones disponibles (insertar, listar, actualizar y eliminar). Luego solicita que el usuario seleccione una opción ingresándola a través del teclado. El valor introducido por el usuario es almacenado en la variable `opcion` como una cadena de texto (`str`). Sin embargo, para poder trabajar con esa entrada como un número entero (por ejemplo, para compararla o utilizarla en condicionales), se convierte dicha cadena a un entero utilizando la función `int()`. Esto es crucial porque las operaciones matemáticas y lógicas no pueden realizarse directamente sobre cadenas de texto.

Este código forma parte de una aplicación que permitirá mantener una base de datos simple de clientes, donde el usuario puede realizar diversas acciones para gestionar dicha información.

```python
'''
  Agenda de clientes v.0.1 por Jose Vicente Carratala
  Este programa gestiona y mantiene una base de datos de clientes
'''

print("Agenda de clientes")

print("Selecciona una opcion:")
print("1.-Insertar un cliente")
print("2.-Listar clientes")
print("3.-Actualizar clientes")
print("4.-Eliminar clientes")
opcion = input("Selecciona una opcion")
opcion = int(opcion)
```

### actuar en cada caso

#### Explicación

Este código es una pequeña interfaz de usuario en Python para gestionar una agenda de clientes. En primer lugar, muestra un menú interactivo donde el usuario puede seleccionar entre cuatro acciones: insertar un cliente, listar todos los clientes, actualizar información de un cliente existente o eliminar a un cliente.

El programa comienza mostrando un mensaje de bienvenida y luego presenta un menú con opciones numeradas. El usuario debe ingresar una opción, que es capturada como entrada de texto (con `input()`) y después se convierte en un número entero (`int()`). Esta conversión es importante porque permite a Python comparar la selección del usuario con los números 1, 2, 3 y 4.

Dependiendo de la opción seleccionada por el usuario, el programa imprime una frase que indica qué acción se va a realizar. En un contexto más amplio, aquí sería donde el código ejecutaría las operaciones correspondientes para cada caso, como añadir datos nuevos en una base de datos (en el caso del insertar cliente), recuperar y mostrar información existente (listar clientes), cambiar la información de un cliente (actualizar) o eliminar registros de un cliente.

Esta estructura permite a los usuarios interactuar fácilmente con la aplicación para realizar diversas tareas relacionadas con la gestión de clientes, facilitando el mantenimiento y actualización de una base de datos de clientes.

```python
'''
  Agenda de clientes v.0.1 por Jose Vicente Carratala
  Este programa gestiona y mantiene una base de datos de clientes
'''

print("Agenda de clientes")

print("Selecciona una opcion:")
print("1.-Insertar un cliente")
print("2.-Listar clientes")
print("3.-Actualizar clientes")
print("4.-Eliminar clientes")
opcion = input("Selecciona una opcion")
opcion = int(opcion)

if opcion == 1:
  print("Vamos a insertar un cliente")
elif opcion == 2:
  print("Vamos a listar los clientes")
elif opcion == 3:
  print("Vamos a actualizar los clientes")
elif opcion == 4:
  print("Vamos a eliminar clientes")
  
```

### para definir un cliente creo una clase

#### Explicación

Este fragmento de código es una parte del programa "Agenda de clientes v.0.1", diseñado para gestionar y mantener la información sobre clientes en un sistema de gestión empresarial. En este código, se define una clase llamada `Cliente`, que contiene tres propiedades: nombre, apellidos y email. Estas propiedades serán usadas posteriormente para almacenar la información de los clientes que interactúan con el programa.

Después de definir la clase, el código muestra un menú sencillo donde se presenta al usuario cuatro opciones: insertar un cliente, listar todos los clientes, actualizar datos del cliente y eliminar a un cliente. La opción elegida por el usuario se guarda en la variable `opcion`, que luego es usada para decidir qué acción realizar a continuación. Según la elección del usuario, el programa imprimirá una frase indicando qué proceso va a iniciar.

Este código es importante porque establece las bases de interacción entre el usuario y el sistema, permitiendo al usuario gestionar fácilmente los registros de clientes mediante opciones claras y directas en un menú.

```python
'''
  Agenda de clientes v.0.1 por Jose Vicente Carratala
  Este programa gestiona y mantiene una base de datos de clientes
'''

class Cliente():
  def __init__(self):
    self.nombre = ""
    self.apellidos = ""
    self.email = ""

print("Agenda de clientes")

print("Selecciona una opcion:")
print("1.-Insertar un cliente")
print("2.-Listar clientes")
print("3.-Actualizar clientes")
print("4.-Eliminar clientes")
opcion = input("Selecciona una opcion")
opcion = int(opcion)

if opcion == 1:
  print("Vamos a insertar un cliente")
elif opcion == 2:
  print("Vamos a listar los clientes")
elif opcion == 3:
  print("Vamos a actualizar los clientes")
elif opcion == 4:
  print("Vamos a eliminar clientes")
```

### y creo una lista de clientes

#### Explicación

Este código es el comienzo de una pequeña aplicación en Python que permite gestionar una lista de clientes. La primera parte del código define una clase llamada `Cliente`, la cual se utiliza para crear objetos que representan individuos con información básica como nombre, apellidos y correo electrónico. Estos objetos estarán almacenados dentro de una lista llamada `clientes`.

A continuación, el programa muestra al usuario un menú interactivo donde puede elegir entre diferentes acciones: insertar un nuevo cliente en la base de datos, listar todos los clientes existentes, actualizar información de un cliente o eliminar a un cliente. Para hacer esto, primero se imprime un mensaje que invita al usuario a seleccionar una opción y luego muestra las opciones disponibles.

El programa lee la entrada del usuario con `input()` y convierte esa entrada a un número entero para poder compararlo con los números asociados a cada opción en el menú. Dependiendo de qué número elija el usuario, se ejecuta uno de los bloques de código que indican qué acción va a realizar el programa. Este tipo de estructura es fundamental para crear aplicaciones interactivas y permitir al usuario controlar la lógica del programa según sus necesidades.

```python
'''
  Agenda de clientes v.0.1 por Jose Vicente Carratala
  Este programa gestiona y mantiene una base de datos de clientes
'''

class Cliente():
  def __init__(self):
    self.nombre = ""
    self.apellidos = ""
    self.email = ""
    
clientes = []

print("Agenda de clientes")

print("Selecciona una opcion:")
print("1.-Insertar un cliente")
print("2.-Listar clientes")
print("3.-Actualizar clientes")
print("4.-Eliminar clientes")
opcion = input("Selecciona una opcion")
opcion = int(opcion)

if opcion == 1:
  print("Vamos a insertar un cliente")
elif opcion == 2:
  print("Vamos a listar los clientes")
elif opcion == 3:
  print("Vamos a actualizar los clientes")
elif opcion == 4:
  print("Vamos a eliminar clientes")
```

### añado un elemento a la lista

#### Explicación

Este fragmento de código es una pequeña aplicación en Python que gestiona una agenda de clientes. La aplicación permite realizar varias operaciones básicas como insertar, listar, actualizar y eliminar registros de clientes. Comienza definiendo una clase llamada `Cliente` que contiene tres atributos: nombre, apellidos y email. Posteriormente, se crea una lista vacía llamada `clientes` donde se almacenarán los objetos de tipo `Cliente`.

El programa muestra un menú interactivo al usuario para seleccionar la acción que desea realizar. Si el usuario elige "Insertar un cliente", el código solicita por pantalla el nombre, apellidos y email del nuevo cliente, crea una instancia de la clase `Cliente` con estos datos y finalmente agrega esta nueva instancia a la lista `clientes`. Este proceso es crucial porque permite almacenar fácilmente nuevos clientes en la agenda.

Es importante destacar que este código proporciona una estructura básica para gestionar registros de clientes, pero aún falta implementar las funcionalidades de listar, actualizar y eliminar clientes.

```python
'''
  Agenda de clientes v.0.1 por Jose Vicente Carratala
  Este programa gestiona y mantiene una base de datos de clientes
'''

class Cliente():
  def __init__(self):
    self.nombre = ""
    self.apellidos = ""
    self.email = ""
    
clientes = []

print("Agenda de clientes")

print("Selecciona una opcion:")
print("1.-Insertar un cliente")
print("2.-Listar clientes")
print("3.-Actualizar clientes")
print("4.-Eliminar clientes")
opcion = input("Selecciona una opcion")
opcion = int(opcion)

if opcion == 1:
  print("Vamos a insertar un cliente")
  nuevocliente = Cliente()
  nuevocliente.nombre = input("Indica el nombre del cliente: ")
  nuevocliente.apellidos = input("Indica los apellidos del cliente: ")
  nuevocliente.email = input("Indica el email del cliente: ")
  clientes.append(nuevocliente) # a la lista de clientes le ponemos el nuevo cliente
elif opcion == 2:
  print("Vamos a listar los clientes")
elif opcion == 3:
  print("Vamos a actualizar los clientes")
elif opcion == 4:
  print("Vamos a eliminar clientes")
```

### Meto al usuario en un bucle infinito

#### Explicación

Este código es una pequeña aplicación de Python que permite gestionar una agenda de clientes con cuatro opciones principales: insertar un cliente, listar todos los clientes, actualizar la información de un cliente y eliminar un cliente. La aplicación está diseñada en forma de menú interactivo que se mantiene ejecutándose hasta que el usuario decida cerrarla manualmente.

La clase `Cliente` define una estructura básica para almacenar datos de un cliente como su nombre, apellidos y email. Cuando se selecciona la opción 1 (insertar un cliente), se crea un nuevo objeto de tipo `Cliente`, se le piden al usuario los detalles del cliente (nombre, apellidos y email) y luego este nuevo cliente se añade a una lista llamada `clientes`. Este enfoque permite almacenar múltiples clientes dentro de la aplicación.

El bucle `while True` es lo que hace que el menú sea infinito, permitiendo al usuario seleccionar una opción hasta que decida cerrarla. Es importante destacar que aunque las opciones 2, 3 y 4 tienen texto asociado para describir qué harían en un programa completo (listar clientes, actualizarlos o eliminarlos), esta versión solo imprime mensajes sin completar la funcionalidad real para estas acciones.

Este tipo de estructura es útil cuando se desea crear una interfaz interactiva simple para manejar datos de forma organizada y permitir al usuario interactuar con ellos según sea necesario.

```python
'''
  Agenda de clientes v.0.1 por Jose Vicente Carratala
  Este programa gestiona y mantiene una base de datos de clientes
'''

class Cliente():
  def __init__(self):
    self.nombre = ""
    self.apellidos = ""
    self.email = ""
    
clientes = []

print("Agenda de clientes")
while True:
  print("Selecciona una opcion:")
  print("1.-Insertar un cliente")
  print("2.-Listar clientes")
  print("3.-Actualizar clientes")
  print("4.-Eliminar clientes")
  opcion = input("Selecciona una opcion")
  opcion = int(opcion)

  if opcion == 1:
    print("Vamos a insertar un cliente")
    nuevocliente = Cliente()
    nuevocliente.nombre = input("Indica el nombre del cliente: ")
    nuevocliente.apellidos = input("Indica los apellidos del cliente: ")
    nuevocliente.email = input("Indica el email del cliente: ")
    clientes.append(nuevocliente) # a la lista de clientes le ponemos el nuevo cliente
  elif opcion == 2:
    print("Vamos a listar los clientes")
  elif opcion == 3:
    print("Vamos a actualizar los clientes")
  elif opcion == 4:
    print("Vamos a eliminar clientes")
```

### listamos clientes

#### Explicación

Este código es una pequeña aplicación de consola en Python que gestiona un listado de clientes. La aplicación permite al usuario insertar nuevos clientes, listar todos los clientes existentes y realizar actualizaciones o eliminaciones (aunque estas últimas no están implementadas en este fragmento). El programa comienza creando una clase llamada `Cliente` con tres atributos: nombre, apellidos y email. Luego, inicializa una lista vacía llamada `clientes`, que servirá para almacenar objetos de la clase `Cliente`.

El código principal es un bucle `while True` que presenta al usuario un menú interactivo donde puede seleccionar entre diferentes opciones como insertar un nuevo cliente, listar todos los clientes actuales o realizar actualizaciones (cualquier opción diferente a estas no está implementada en este fragmento). Cuando el usuario selecciona la opción de insertar un cliente, se crea una nueva instancia de `Cliente`, se le solicitan al usuario que introduzca el nombre, apellidos y email del nuevo cliente, y finalmente se añade esta información a la lista de clientes. Si el usuario selecciona listar los clientes, el programa itera sobre todos los objetos en la lista `clientes` e imprime sus atributos correspondientes.

Esta aplicación es importante porque demuestra cómo manejar datos estructurados (como registros de clientes) utilizando clases y listas en Python, proporcionando una base para aplicaciones más complejas que podrían interactuar con bases de datos o archivos de texto.

```python
'''
  Agenda de clientes v.0.1 por Jose Vicente Carratala
  Este programa gestiona y mantiene una base de datos de clientes
'''

class Cliente():
  def __init__(self):
    self.nombre = ""
    self.apellidos = ""
    self.email = ""
    
clientes = []

print("Agenda de clientes")
while True:
  print("Selecciona una opcion:")
  print("1.-Insertar un cliente")
  print("2.-Listar clientes")
  print("3.-Actualizar clientes")
  print("4.-Eliminar clientes")
  opcion = input("Selecciona una opcion")
  opcion = int(opcion)

  if opcion == 1:
    print("Vamos a insertar un cliente")
    nuevocliente = Cliente()
    nuevocliente.nombre = input("Indica el nombre del cliente: ")
    nuevocliente.apellidos = input("Indica los apellidos del cliente: ")
    nuevocliente.email = input("Indica el email del cliente: ")
    clientes.append(nuevocliente) # a la lista de clientes le ponemos el nuevo cliente
  elif opcion == 2:
    print("Vamos a listar los clientes")
    for cliente in clientes:
      print("Nombre: ",cliente.nombre)
      print("Apellidos: ",cliente.apellidos)
      print("Email: ",cliente.email)
      print("##############################")
  elif opcion == 3:
    print("Vamos a actualizar los clientes")
  elif opcion == 4:
    print("Vamos a eliminar clientes")
```

### limpiar la pantalla

#### Explicación

Este código es el inicio de un programa en Python que gestiona una agenda de clientes. El programa define una clase llamada `Cliente` con atributos como nombre, apellidos y email para almacenar la información de cada cliente individualmente.

El programa principal crea una lista vacía llamada `clientes`, donde se añadirán objetos del tipo `Cliente`. La función principal es un bucle infinito (`while True`) que muestra un menú al usuario con opciones para insertar, listar, actualizar y eliminar clientes. Cada vez que el usuario selecciona una opción, el programa limpia la pantalla (mediante `\033[2J\033[H`, que son comandos de escape para limpiar la consola) antes de mostrar la información o las opciones correspondientes.

El código permite al usuario insertar un nuevo cliente en la lista después de pedirle los datos del mismo, listar todos los clientes existentes mostrando sus detalles y prepara el escenario para futuras implementaciones que permitan actualizar y eliminar registros. Esta estructura es importante porque facilita la gestión de una base de datos simple de clientes desde la interfaz de línea de comandos, proporcionando un flujo claro y ordenado en cómo interactuar con los datos.

```python
'''
  Agenda de clientes v.0.1 por Jose Vicente Carratala
  Este programa gestiona y mantiene una base de datos de clientes
'''

class Cliente():
  def __init__(self):
    self.nombre = ""
    self.apellidos = ""
    self.email = ""
    
clientes = []
print("\033[2J\033[H", end="")
print("Agenda de clientes")
while True:
  print("\033[2J\033[H", end="")
  print("Selecciona una opcion:")
  print("1.-Insertar un cliente")
  print("2.-Listar clientes")
  print("3.-Actualizar clientes")
  print("4.-Eliminar clientes")
  opcion = input("Selecciona una opcion: ")
  opcion = int(opcion)

  if opcion == 1:
    print("\033[2J\033[H", end="")
    print("Vamos a insertar un cliente")
    nuevocliente = Cliente()
    nuevocliente.nombre = input("Indica el nombre del cliente: ")
    nuevocliente.apellidos = input("Indica los apellidos del cliente: ")
    nuevocliente.email = input("Indica el email del cliente: ")
    clientes.append(nuevocliente) # a la lista de clientes le ponemos el nuevo cliente
  elif opcion == 2:
    print("\033[2J\033[H", end="")
    print("Vamos a listar los clientes")
    print("Listado de clientes:")
    print("##############################")
    for cliente in clientes:
      print("Nombre: ",cliente.nombre)
      print("Apellidos: ",cliente.apellidos)
      print("Email: ",cliente.email)
      print("##############################")
    input("Pulsa una tecla para continuar....")
  elif opcion == 3:
    print("Vamos a actualizar los clientes")
  elif opcion == 4:
    print("Vamos a eliminar clientes")
```

### guardar clientes

#### Explicación

Este código es un programa sencillo que permite gestionar una base de datos de clientes. El programa utiliza la biblioteca `pickle` de Python para guardar y cargar información en archivos binarios, lo cual es muy útil cuando se trabaja con objetos complejos como listas de instancias de clase.

El código define una clase llamada `Cliente`, que representa a un cliente individual con tres atributos: nombre, apellidos y email. Luego, se crea una lista vacía llamada `clientes` para almacenar los clientes registrados. El programa ofrece al usuario varias opciones: insertar un nuevo cliente, listar todos los clientes existentes, actualizar información de clientes (todavía no implementado), eliminar clientes (tampoco implementado) y guardar la lista actualizada de clientes en un archivo binario.

La opción más relevante para el contexto del código es la número 5, donde se guarda la lista de clientes. Para hacer esto, el programa abre un archivo llamado `clientes.bin` en modo escritura binaria (`'wb'`) y utiliza `pickle.dump()` para serializar (convertir en una cadena de bytes) toda la información de los clientes a este archivo. Una vez guardada la información, el archivo se cierra para asegurar que todos los datos han sido escritos correctamente.

Esta funcionalidad es importante porque permite persistir la base de datos de clientes entre diferentes sesiones del programa, garantizando que los datos no se pierdan cuando se cierra el programa y se vuelve a abrir en una futura sesión.

```python
'''
  Agenda de clientes v.0.1 por Jose Vicente Carratala
  Este programa gestiona y mantiene una base de datos de clientes
'''

import pickle

class Cliente():
  def __init__(self):
    self.nombre = ""
    self.apellidos = ""
    self.email = ""
    
clientes = []
print("\033[2J\033[H", end="")
print("Agenda de clientes")
while True:
  print("\033[2J\033[H", end="")
  print("Selecciona una opcion:")
  print("1.-Insertar un cliente")
  print("2.-Listar clientes")
  print("3.-Actualizar clientes")
  print("4.-Eliminar clientes")
  print("5.-Guardar clientes")
  opcion = input("Selecciona una opcion: ")
  opcion = int(opcion)

  if opcion == 1:
    print("\033[2J\033[H", end="")
    print("Vamos a insertar un cliente")
    nuevocliente = Cliente()
    nuevocliente.nombre = input("Indica el nombre del cliente: ")
    nuevocliente.apellidos = input("Indica los apellidos del cliente: ")
    nuevocliente.email = input("Indica el email del cliente: ")
    clientes.append(nuevocliente) # a la lista de clientes le ponemos el nuevo cliente
  elif opcion == 2:
    print("\033[2J\033[H", end="")
    print("Vamos a listar los clientes")
    print("Listado de clientes:")
    print("##############################")
    for cliente in clientes:
      print("Nombre: ",cliente.nombre)
      print("Apellidos: ",cliente.apellidos)
      print("Email: ",cliente.email)
      print("##############################")
    input("Pulsa una tecla para continuar....")
  elif opcion == 3:
    print("Vamos a actualizar los clientes")
  elif opcion == 4:
    print("Vamos a eliminar clientes")
  elif opcion == 5:
    print("Vamos a guardar los clientes")
    archivo = open("clientes.bin",'wb')
    pickle.dump(clientes, archivo)
    archivo.close()
    input("Pulsa una tecla para continuar...")
```

### cuando abro el programa carga la lista de clientes

#### Explicación

Este código Python es un programa simple que permite gestionar una lista de clientes. Al abrir el programa, se carga automáticamente la información previamente guardada en un archivo llamado "clientes.bin" usando el módulo `pickle`. Este módulo facilita la serialización y deserialización de objetos de Python a ficheros binarios.

El programa define una clase llamada `Cliente` que contiene tres atributos: nombre, apellidos y email. Crea también una lista vacía llamada `clientes` donde almacenará los objetos Cliente creados por el usuario.

La parte central del código es un bucle infinito (`while True:`) que muestra un menú al usuario para permitir acciones como insertar, listar, actualizar o eliminar clientes de la lista. Cada opción lleva a funciones específicas: agregar nuevos clientes solicitando los datos del usuario, mostrar todos los clientes almacenados en la lista, y guardar la lista actualizada en el archivo binario cuando se selecciona esta opción.

El código utiliza comandos adicionales como `\033[2J\033[H` para limpiar la pantalla antes de mostrar cualquier menú o información al usuario. Esto mejora la experiencia del usuario al visualizar solo los datos pertinentes en cada momento y no un montón de texto viejo.

Este programa es importante porque demuestra cómo manejar datos persistentes (datos que se guardan incluso después de cerrar el programa) utilizando archivos binarios en Python, lo cual es una habilidad clave para desarrolladores que trabajen con bases de datos o sistemas de gestión de información.

```python
'''
  Agenda de clientes v.0.1 por Jose Vicente Carratala
  Este programa gestiona y mantiene una base de datos de clientes
'''

import pickle

class Cliente():
  def __init__(self):
    self.nombre = ""
    self.apellidos = ""
    self.email = ""

clientes = []

archivo = open("clientes.bin",'rb')
clientes = pickle.load(archivo)
archivo.close()

print("\033[2J\033[H", end="")

while True:
  print("\033[2J\033[H", end="")
  print("\u001b[1mBold")
  print("Agenda de clientes")
  print("\u001b[0m")
  print("Selecciona una opcion:")
  print("1.-Insertar un cliente")
  print("2.-Listar clientes")
  print("3.-Actualizar clientes")
  print("4.-Eliminar clientes")
  print("5.-Guardar clientes")
  opcion = input("Selecciona una opcion: ")
  opcion = int(opcion)

  if opcion == 1:
    print("\033[2J\033[H", end="")
    print("Vamos a insertar un cliente")
    nuevocliente = Cliente()
    nuevocliente.nombre = input("Indica el nombre del cliente: ")
    nuevocliente.apellidos = input("Indica los apellidos del cliente: ")
    nuevocliente.email = input("Indica el email del cliente: ")
    clientes.append(nuevocliente) # a la lista de clientes le ponemos el nuevo cliente
  elif opcion == 2:
    print("\033[2J\033[H", end="")
    print("Vamos a listar los clientes")
    print("Listado de clientes:")
    print("##############################")
    for cliente in clientes:
      print("Nombre: ",cliente.nombre)
      print("Apellidos: ",cliente.apellidos)
      print("Email: ",cliente.email)
      print("##############################")
    input("Pulsa una tecla para continuar....")
  elif opcion == 3:
    print("Vamos a actualizar los clientes")
  elif opcion == 4:
    print("Vamos a eliminar clientes")
  elif opcion == 5:
    print("Vamos a guardar los clientes")
    archivo = open("clientes.bin",'wb')
    pickle.dump(clientes, archivo)
    archivo.close()
    input("Pulsa una tecla para continuar...")
```

### estetica de la consola

#### Explicación

Este código es un programa en Python que gestiona una agenda de clientes. Primero, importa la librería `pickle` y define una clase llamada `Cliente`, donde se almacenan los datos básicos del cliente como nombre, apellidos y email.

El programa carga una lista de objetos `Cliente` desde un archivo binario llamado "clientes.bin" utilizando el módulo `pickle`. Esta operación permite mantener persistencia en la información almacenada entre sesiones del programa. La lista de clientes se almacena en la variable `clientes`.

Una vez que se han cargado los datos, el código presenta un menú interactivo para permitir al usuario gestionar estos datos. El menú ofrece opciones como insertar un nuevo cliente, listar todos los clientes existentes, actualizar o eliminar clientes. Para mejorar la experiencia del usuario, cada vez que se selecciona una opción, el programa limpia la pantalla antes de mostrar el siguiente paso.

Es importante destacar cómo este código utiliza técnicas de formateo de texto ANSI para limpiar la pantalla y cambiar el estilo del texto (negrita), lo cual hace que la interfaz sea más agradable visualmente. Además, al seleccionar la opción para guardar los clientes, se vuelve a abrir el archivo "clientes.bin" en modo binario para escribir la lista actualizada de objetos `Cliente` utilizando `pickle.dump()`, asegurando así que los cambios realizados durante la ejecución del programa sean guardados permanentemente.

Este tipo de código es útil en aplicaciones donde es necesario mantener datos estructurados y permitir a los usuarios interactuar con esos datos fácilmente, proporcionando un buen balance entre simplicidad y funcionalidad.

```python
'''
  Agenda de clientes v.0.1 por Jose Vicente Carratala
  Este programa gestiona y mantiene una base de datos de clientes
'''

import pickle

class Cliente():
  def __init__(self):
    self.nombre = ""
    self.apellidos = ""
    self.email = ""

clientes = []

archivo = open("clientes.bin",'rb')
clientes = pickle.load(archivo)
archivo.close()

print("\033[2J\033[H", end="")

while True:
  print("\033[2J\033[H", end="")  # Limpiar pantalla
  print("\u001b[1m")  # Negrita
  print("Agenda de clientes")
  print("\u001b[0m")  # Reiniciamos estilo
  print("Selecciona una opcion:")
  print("1.-Insertar un cliente")
  print("2.-Listar clientes")
  print("3.-Actualizar clientes")
  print("4.-Eliminar clientes")
  print("5.-Guardar clientes")
  opcion = input("Selecciona una opcion: ")
  opcion = int(opcion)

  if opcion == 1:
    print("\033[2J\033[H", end="")
    print("Vamos a insertar un cliente")
    nuevocliente = Cliente()
    nuevocliente.nombre = input("Indica el nombre del cliente: ")
    nuevocliente.apellidos = input("Indica los apellidos del cliente: ")
    nuevocliente.email = input("Indica el email del cliente: ")
    clientes.append(nuevocliente) # a la lista de clientes le ponemos el nuevo cliente
  elif opcion == 2:
    print("\033[2J\033[H", end="")
    print("Vamos a listar los clientes")
    print("Listado de clientes:")
    print("##############################")
    for cliente in clientes:
      print("Nombre: ",cliente.nombre)
      print("Apellidos: ",cliente.apellidos)
      print("Email: ",cliente.email)
      print("##############################")
    input("Pulsa una tecla para continuar....")
  elif opcion == 3:
    print("Vamos a actualizar los clientes")
  elif opcion == 4:
    print("Vamos a eliminar clientes")
  elif opcion == 5:
    print("Vamos a guardar los clientes")
    archivo = open("clientes.bin",'wb')
    pickle.dump(clientes, archivo)
    archivo.close()
    input("Pulsa una tecla para continuar...")
```

### funciones

#### Explicación

Este código es un programa en Python que gestiona una agenda de clientes. El objetivo principal del programa es permitir a los usuarios agregar, listar, actualizar y eliminar registros de clientes almacenados en un archivo binario usando la biblioteca `pickle`. 

El programa comienza definiendo una clase llamada `Cliente` que contiene tres atributos: nombre, apellidos y email. Luego, se crean funciones para limpiar la pantalla, cambiar el estilo del texto (negrita) y establecer colores en la salida de texto, lo cual mejora la presentación visual en la terminal.

El código principal se ejecuta dentro de un bucle `while True`, ofreciendo al usuario varias opciones como insertar un cliente nuevo, listar todos los clientes existentes, actualizar información o eliminar registros. Si el usuario selecciona '1', se añade un nuevo cliente introduciendo sus datos por teclado y se guarda en una lista. La opción '2' muestra la lista de clientes registrados con detalles como nombre, apellidos y email.

Es importante destacar que cuando se selecciona la opción '5', todos los registros actualizados o nuevos son guardados en un archivo llamado `clientes.bin` usando el módulo `pickle`, lo cual es fundamental para mantener la información persistente entre diferentes sesiones del programa. Esto asegura que no perderemos datos cada vez que cerramos y volvemos a abrir el programa.

Este tipo de estructura (con funciones, clases y un bucle principal) es común en aplicaciones interactivas basadas en consola y ayuda a mantener el código organizado y fácil de entender y modificar.

```python
'''
  Agenda de clientes v.0.1 por Jose Vicente Carratala
  Este programa gestiona y mantiene una base de datos de clientes
'''

import pickle

class Cliente():
  def __init__(self):
    self.nombre = ""
    self.apellidos = ""
    self.email = ""

def limpiaPantalla():
  print("\033[2J\033[H", end="")  # Limpiar pantalla

def ponNegrita():
  print("\u001b[1m")  # Negrita
  
def reiniciaEstilo():
  print("\u001b[0m")  # Reiniciamos estilo

def ponColor(r,b,g):
  print("\u001b[38;2;"+str(r)+";"+str(g)+";"+str(b)+"m", end="")

clientes = []

archivo = open("clientes.bin",'rb')
clientes = pickle.load(archivo)
archivo.close()

limpiaPantalla()

while True:
  limpiaPantalla()
  ponNegrita()
  ponColor(255,0,0)
  print("Agenda de clientes")
  reiniciaEstilo()
  print("Selecciona una opcion:")
  ponColor(255,0,0)
  print("1.-Insertar un cliente")
  ponColor(0,255,0)
  print("2.-Listar clientes")
  ponColor(0,0,255)
  print("3.-Actualizar clientes")
  ponColor(255,255,0)
  print("4.-Eliminar clientes")
  ponColor(0,255,255)
  print("5.-Guardar clientes")
  opcion = input("Selecciona una opcion: ")
  opcion = int(opcion)

  if opcion == 1:
    limpiaPantalla()
    print("Vamos a insertar un cliente")
    nuevocliente = Cliente()
    nuevocliente.nombre = input("Indica el nombre del cliente: ")
    nuevocliente.apellidos = input("Indica los apellidos del cliente: ")
    nuevocliente.email = input("Indica el email del cliente: ")
    clientes.append(nuevocliente) # a la lista de clientes le ponemos el nuevo cliente
  elif opcion == 2:
    limpiaPantalla()
    print("Vamos a listar los clientes")
    print("Listado de clientes:")
    print("##############################")
    for cliente in clientes:
      print("Nombre: ",cliente.nombre)
      print("Apellidos: ",cliente.apellidos)
      print("Email: ",cliente.email)
      print("##############################")
    input("Pulsa una tecla para continuar....")
  elif opcion == 3:
    print("Vamos a actualizar los clientes")
  elif opcion == 4:
    print("Vamos a eliminar clientes")
  elif opcion == 5:
    print("Vamos a guardar los clientes")
    archivo = open("clientes.bin",'wb')
    pickle.dump(clientes, archivo)
    archivo.close()
    input("Pulsa una tecla para continuar...")
```

### clientes

#### Explicación

Este fragmento de código no es un código real en ningún lenguaje de programación conocido, sino que parece ser el contenido directo de un archivo CSV (comma-separated values), que es un tipo de archivo de texto plano utilizado para almacenar datos. Este archivo específico contiene información sobre clientes y está estructurado de tal manera que cada cliente ocupa una línea separada en el archivo.

Cada línea tiene tres partes: el nombre del cliente, la dirección y un número, posiblemente representando algo como un código postal o una referencia única para ese cliente. Estas líneas están separadas por comas (virgulillas), lo que es típico en archivos CSV. El contenido muestra dos clientes repetidos: Juan con su respectiva información de contacto y Jorge con la suya.

Este formato CSV es importante porque facilita el intercambio de datos entre diferentes programas o sistemas, ya que es un estándar muy utilizado para transferir datos tabulares como listas de clientes, ventas, registros académicos, etc.

```
Juan,Calle de Juan,5325434Jorge,Calle de Jorge,5234535Juan,Calle de Juan,5325434
Jorge,Calle de Jorge,5234535
```

### clientes

#### Explicación

Este fragmento de código es un archivo JSON que contiene información sobre varios clientes. En este caso, hay dos registros o entradas para diferentes personas. Cada cliente se representa como un objeto en una lista (también conocida como array), y cada objeto tiene tres propiedades: "nombre", "apellidos" y "email". Estas propiedades almacenan datos específicos sobre el cliente, como su nombre completo y correo electrónico.

JSON es importante porque permite almacenar y transmitir datos de manera estructurada y legible. En este contexto, este archivo podría ser utilizado por un programa para leer información sobre clientes que luego se usaría en diversas operaciones, como enviar correos electrónicos o mostrar detalles en una página web.

Este tipo de estructura de datos es común en la programación moderna ya que facilita el intercambio de información entre sistemas y aplicaciones.

```json
[
    {
        "nombre": "jose Vicente",
        "apellidos": "Carratala Sanchis",
        "email": "info@jocarsa.com"
    },
    {
        "nombre": "Juan",
        "apellidos": "Garcia Lopez",
        "email": "juan@jocarsa.com"
    }
]
```

<a id="apertura-y-cierre-de-ficheros-modos-de-acceso-escritura-y-lectura-de-informacion-en-ficheros"></a>
## Apertura y cierre de ficheros. Modos de acceso. Escritura y lectura de información en ficheros

En el vasto mundo de la programación, la lectura y escritura de información son fundamentales para cualquier aplicación informática. En esta subunidad didáctica, nos adentramos en los aspectos cruciales de cómo interactuar con archivos en un programa, abordando desde la apertura y cierre de ficheros hasta las técnicas avanzadas de acceso y manipulación de datos.

La apertura y el cierre de ficheros son operaciones esenciales que permiten a nuestros programas acceder y modificar información persistente. Cada archivo se abre en un modo específico, determinado por la naturaleza de los datos que se quieren leer o escribir. Los modos más comunes incluyen lectura (`r`), escritura (`w`), anexión (`a`) y lectura-escritura (`rw`). Cada uno de estos modos tiene sus propias características y restricciones, lo que es crucial entender para evitar errores en la manipulación de archivos.

La apertura de un archivo implica establecer una conexión entre el programa y el dispositivo de almacenamiento. Este proceso puede implicar la asignación de recursos como memoria y espacio en disco, dependiendo del tamaño del archivo y las necesidades del programa. Es importante recordar que cada vez que se abre un archivo, debe cerrarse adecuadamente para liberar estos recursos y garantizar la integridad del sistema.

La escritura de información en ficheros es otro aspecto fundamental de la programación. Los programas pueden escribir datos en archivos de texto o binarios, dependiendo de las necesidades específicas del proyecto. La escritura puede ser sincrónica (el programa espera a que el dato sea escrito antes de continuar) o asíncrona (el programa continúa ejecutándose mientras se realiza la escritura). Cada método tiene sus ventajas y desventajas, y es importante elegir el más adecuado según las circunstancias.

Además de la apertura y cierre de ficheros, también es crucial manejar los errores que pueden surgir durante estas operaciones. Los archivos pueden no existir, puede faltar espacio en disco o puede haber problemas de permisos. Es por eso que los programas suelen implementar mecanismos para detectar y gestionar estos errores, asegurando la continuidad del proceso.

La lectura de información desde ficheros es otro aspecto fundamental de la programación. Los archivos pueden contener datos estructurados o no estructurados, y el programa debe ser capaz de leerlos correctamente. La lectura puede ser realizada línea por línea o en bloques más grandes, dependiendo del tamaño del archivo y las necesidades del programa.

La manipulación de información en ficheros es un aspecto avanzado que permite a los programas realizar operaciones complejas sobre datos persistentes. Esto puede incluir la búsqueda y reemplazo de texto, el ordenamiento de registros o la creación de copias de seguridad. La manipulación de ficheros requiere una comprensión profunda del formato y estructura de los datos almacenados.

La importancia de la lectura y escritura de información en programación no puede subestimarse. Estas operaciones son esenciales para el funcionamiento de aplicaciones que interactúan con el mundo exterior, desde sistemas empresariales hasta aplicaciones web y móviles. La capacidad de leer y escribir datos de manera eficiente y segura es un requisito fundamental para cualquier programador.

En conclusión, la lectura y escritura de información son operaciones fundamentales en la programación que permiten a los programas interactuar con el mundo exterior. A través de la apertura y cierre de ficheros, la escritura de datos y la manipulación avanzada de información, los programas pueden realizar tareas complejas y almacenar resultados persistentes. Comprender estos aspectos es crucial para cualquier programador que quiera crear aplicaciones robustas y eficientes.

### apertura de escritura

#### Explicación

Este código Python muestra cómo abrir un archivo para escribir en él y luego cerrarlo. Primero, la línea `archivo = open("clientes.txt", "w")` abre el archivo llamado `clientes.txt` en modo de escritura (`"w"`). Si el archivo no existe, se creará uno nuevo; si ya existe, su contenido previo será borrado antes de escribir cualquier cosa nueva. Luego, la línea `archivo.write("Información de cliente")` escribe dentro del archivo la frase "Información de cliente". Finalmente, `archivo.close()` cierra el archivo para asegurar que todos los cambios se guarden correctamente y liberar recursos del sistema. Este código es importante porque te enseña cómo manipular archivos en Python, una habilidad crucial para trabajar con datos y guardar información a largo plazo en programas más complejos.

```python
archivo = open("clientes.txt","w")
archivo.write("Información de cliente")
archivo.close()
```

### apertura de apendizaje

#### Explicación

Este código Python se utiliza para trabajar con archivos en el sistema. En primer lugar, la línea `archivo = open("clientes.txt", "a")` abre un archivo llamado "clientes.txt" en modo de apendizaje ("a"). Esto significa que cualquier texto que añadas al archivo se agregará al final del mismo sin sobrescribir lo que ya está allí. Luego, la línea `archivo.write("Información de cliente")` escribe el texto "Información de cliente" en el archivo que has abierto. Finalmente, `archivo.close()` cierra el archivo después de haber terminado de escribir en él para asegurar que todos los cambios se guardan correctamente y que no hay problemas con la memoria del sistema. Es importante cerrar archivos una vez que hemos terminado de trabajar con ellos para mantener el orden en nuestros programas y evitar posibles errores.

```python
archivo = open("clientes.txt","a")
archivo.write("Información de cliente")
archivo.close()
```

### bajada de linea

#### Explicación

Este código Python abre un archivo llamado "clientes.txt" en modo de escritura adicional ("a"), lo que significa que si el archivo ya existe, el nuevo texto se añadirá al final del mismo sin borrar nada previo. Si el archivo no existe, se creará uno nuevo con ese nombre. A continuación, escribe la frase "Información de cliente" en una nueva línea dentro del archivo usando la función `write()`. Finalmente, cierra el archivo para asegurar que toda la información escrita se guarda correctamente y los recursos del sistema quedan disponibles para otros programas.

Es importante destacar que al añadir un "\n" al final de la frase "Información de cliente", estás creando una nueva línea después del texto escrito. Esto es útil porque permite escribir múltiples entradas en el archivo, cada una en su propia línea, facilitando así la lectura y organización de datos dentro del fichero.

```python
archivo = open("clientes.txt","a")
archivo.write("Información de cliente \n")
archivo.close()
```

### abrir archivo para leer UNA linea

#### Explicación

Este fragmento de código te enseña cómo abrir un archivo y leer su primera línea en Python. Primero, la función `open()` se utiliza para abrir el archivo llamado "clientes.txt" en modo lectura ("r"). Esto crea un objeto de archivo que permite acceder al contenido del documento. Luego, `archivo.readline()` lee la primera línea del archivo recién abierto y esa línea es almacenada en la variable `linea`. Finalmente, `print(linea)` muestra la línea leída por pantalla. Al finalizar estas operaciones, el código cierra el archivo con `archivo.close()`, lo cual es crucial para liberar los recursos del sistema que el programa estaba utilizando.

Este proceso es fundamental porque permite a tu programa interactuar con archivos de texto, leyendo sus contenidos y procesándolos según sea necesario. Es una habilidad básica en programación, ya que muchos programas necesitan leer datos desde archivos externos para funcionar correctamente.

```python
archivo = open("clientes.txt","r")
linea = archivo.readline()
print(linea)
archivo.close()
```

### ahora quiero leer todas las lineas

#### Explicación

Este fragmento de código Python te enseña cómo abrir un archivo, leer todas sus líneas y luego cerrarlo para asegurar que los recursos del sistema no se bloqueen. Primero, el código abre el archivo llamado "clientes.txt" en modo lectura ("r"), lo que significa que solo puedes ver o leer la información pero no modificarla ni crearlo si no existe. Luego, usa la función `readlines()` para leer todas las líneas del archivo y guardarlas como una lista de cadenas dentro de la variable `linea`. Cada elemento en esta lista representa una línea del archivo original. Finalmente, el código imprime toda la lista con `print(linea)` mostrándote cómo se ven las líneas leídas desde el archivo. Es crucial cerrar el archivo después de terminar de trabajar con él para liberar cualquier recurso que esté usando tu programa.

```python
archivo = open("clientes.txt","r")
linea = archivo.readlines()
print(linea)
archivo.close()
```

### recorro la lista

#### Explicación

Este código Python se utiliza para leer el contenido de un archivo llamado "clientes.txt". Primero, abre el archivo en modo lectura ("r"). Luego, lee todas las líneas del archivo y las almacena en una lista llamada `lineas`. A continuación, recorre cada línea de la lista e imprime el contenido de cada línea por pantalla. Finalmente, cierra el archivo para liberar los recursos del sistema que estaba usando. Este tipo de código es importante porque permite automatizar tareas como procesar registros en archivos de texto, lo cual sería muy tedioso y susceptible a errores si se hace manualmente.

```python
archivo = open("clientes.txt","r")
lineas = archivo.readlines()
for linea in lineas:
  print(linea)
archivo.close()
```

### escribo en modo binario

#### Explicación

Este código se utiliza para escribir información en un archivo de texto denominado "clientes.txt" en modo binario. El programa abre el archivo con la opción "wb", donde "w" significa que estamos configurando al archivo para escritura y cualquier contenido existente será borrado, mientras que "b" indica que el archivo se manejará en formato binario. Luego, usa el método `encode()` para convertir una cadena de texto ("Información de cliente") a su representación en bytes utilizando el encoding UTF-8 antes de escribir estos datos codificados en el archivo recién abierto con la función `write()`. Finalmente, se cierra el archivo con `close()` para asegurar que toda la información haya sido escrita correctamente y liberar los recursos asociados al archivo. Es importante usar este modo binario cuando queremos guardar datos que no son solo texto plano o cuando necesitamos garantizar una compatibilidad máxima entre sistemas operativos diferentes.

```python
archivo = open("clientes.txt","wb")
archivo.write("Información de cliente".encode("utf-8"))
archivo.close()
```

### leo de un archivo binario

#### Explicación

Este código Python se utiliza para leer y mostrar el contenido de un archivo binario llamado "clientes.txt". Primero, abre el archivo en modo lectura binaria ("rb"), lo que significa que va a tratar los datos del archivo como una secuencia de bytes sin hacer ninguna suposición sobre su formato. Luego lee la primera línea (o el primer bloque) del archivo y la guarda en la variable `linea`. Como los datos son binarios, no están codificados para ser leídos directamente como texto; por eso se usa el método `.decode("utf-8")` para convertir esos bytes a una cadena de texto legible usando el conjunto de caracteres UTF-8. Finalmente, imprime la línea decodificada y cierra el archivo para asegurar que todos los recursos asociados estén liberados correctamente.

Este proceso es importante porque permite leer archivos binarios que contienen datos no estructurados como texto plano, lo cual puede ser útil cuando trabajas con tipos de archivos específicos o cuando necesitas garantizar la compatibilidad entre diferentes sistemas y plataformas.

```python
archivo = open("clientes.txt","rb")
linea = archivo.readline()
print(linea.decode("utf-8"))
archivo.close()
```

### guardar en formato xml

#### Explicación

Este código crea un archivo XML que contiene información sobre clientes. Primero, importa el módulo `xml.etree.ElementTree` (conocido como ET), que es una biblioteca en Python para manejar estructuras de datos XML. Luego, se define una lista llamada `clientes`, donde cada elemento es un diccionario con los datos personales de un cliente, como su nombre, apellidos y email.

El código crea un elemento raíz llamado "clientes" usando la clase `ET.Element`. A continuación, itera sobre la lista de clientes para agregar elementos XML hijos a este nodo raíz. Para cada cliente en la lista, se añade un subelemento "cliente", y dentro de él, otros tres subelementos: "nombre", "apellidos" y "email". Estos subelementos contienen los datos del diccionario correspondiente.

Finalmente, el código crea un árbol XML a partir del nodo raíz con `ET.ElementTree(root)`, luego indentado para mejorar la legibilidad del archivo XML generado. Se utiliza la función `tree.write()` para guardar este árbol en un archivo llamado "clientes.xml", asegurándose de que se incluya una declaración XML (`xml_declaration=True`) y que el encoding sea UTF-8, lo cual es importante porque permite representar cualquier carácter posible en varios idiomas.

Este tipo de código es útil cuando necesitas almacenar o transmitir datos estructurados en un formato estándar como XML.

```python
import xml.etree.ElementTree as ET

clientes = [
    {
        "nombre": "jose Vicente",
        "apellidos": "Carratala Sanchis",
        "email": "info@jocarsa.com"
    },
    {
        "nombre": "Juan",
        "apellidos": "Garcia Lopez",
        "email": "juan@jocarsa.com"
    }
]

root = ET.Element("clientes")

for c in clientes:
    cliente = ET.SubElement(root, "cliente")
    ET.SubElement(cliente, "nombre").text = c["nombre"]
    ET.SubElement(cliente, "apellidos").text = c["apellidos"]
    ET.SubElement(cliente, "email").text = c["email"]

tree = ET.ElementTree(root)
ET.indent(tree, space="  ")
tree.write("clientes.xml", encoding="utf-8", xml_declaration=True)
```

### conexion rapida con bases de datos

#### Explicación

Este código te enseña cómo conectarte a una base de datos MySQL y recuperar información de ella usando Python. Primero, importamos un conector especial llamado `mysql.connector`, que es como un puente entre Python y la base de datos MySQL.

Luego, establecemos una conexión a la base de datos especificando el servidor (en este caso, localhost), las credenciales del usuario (nombre de usuario y contraseña) y el nombre de la base de datos. Una vez conectados, creamos un objeto llamado `cursor`, que es como una herramienta para ejecutar comandos SQL en nuestra base de datos.

El siguiente paso es ejecutar una consulta SQL simple (`SELECT * FROM clientes`), que busca todos los registros de la tabla "clientes". Los resultados se guardan en una variable llamada `resultados`. Como el resultado puede ser un conjunto grande de filas, usamos un bucle para recorrer cada fila y mostrarla por pantalla.

Finalmente, es importante cerrar tanto el cursor como la conexión con la base de datos cuando hemos terminado. Esto asegura que no se estén utilizando recursos innecesariamente y ayuda a evitar problemas en aplicaciones más grandes.

Este proceso te permite interactuar con bases de datos desde Python, lo cual es crucial para muchos proyectos de desarrollo web y sistemas informáticos donde necesitas manejar información almacenada en una base de datos.

```python
# pip install mysql-connector-python - Si estoy en Windows
# pip3 install mysql-connector-python - Si estoy en Linux o macOS

# Primero importo el conector
import mysql.connector
# Ahora establezco una conexión con un usuario con permisos
conexion = mysql.connector.connect(
    host="localhost",       # or IP of your MySQL server
    user="usuarioempresarial",      # replace with your MySQL user
    password="usuarioempresarial",  # replace with your MySQL password
    database="empresarial"       # replace with your database name
)
# Creo un cursor para pedir cosas
cursor = conexion.cursor()
# En el el cursor, ejecuto una petición
cursor.execute("SELECT * FROM clientes")
# Obtengo los resultados de la petición
resultados = cursor.fetchall()
# Como hay muchos resultados, voy uno a uno
for fila in resultados:
    print(fila)
# Cierro el cursor
cursor.close() 
# Cierro la conexion
conexion.close()
```

### Recojo información y la llevo a MySQL

#### Explicación

Este fragmento de código es una breve aplicación en Python que se encarga de conectar a una base de datos MySQL, recoger información del usuario y almacenarla en la tabla `clientes`. En primer lugar, el programa solicita al usuario que introduzca varios detalles del cliente como nombre, apellidos, teléfono, correo electrónico y localidad. Luego, establece una conexión con la base de datos utilizando los parámetros proporcionados (host, usuario, contraseña y nombre de la base de datos).

Una vez establecida la conexión, se crea un objeto cursor para ejecutar comandos SQL en la base de datos. El comando `INSERT INTO clientes` añade un nuevo registro a la tabla `clientes`, usando los valores ingresados por el usuario. Es importante señalar que cada valor introducido por el usuario está incrustado directamente dentro del comando SQL, lo cual puede ser vulnerable a inyecciones SQL si no se valida adecuadamente la entrada del usuario.

Finalmente, el código confirma las modificaciones en la base de datos con `commit()` y cierra tanto el cursor como la conexión para liberar los recursos. Es crucial cerrar siempre las conexiones y los objetos cursor después de su uso para evitar fugas de memoria y mantener la eficiencia del programa.

```python
# pip install mysql-connector-python - Si estoy en Windows
# pip3 install mysql-connector-python - Si estoy en Linux o macOS


import mysql.connector

nombre = input("Introduce el nombre del cliente")
apellidos = input("Introduce los apellidos del cliente")
telefono = input("Introduce el telefono del cliente")
email = input("Introduce el email del cliente")
localidad = input("Introduce la localidad del cliente")

conexion = mysql.connector.connect(
    host="localhost",      
    user="usuarioempresarial",    
    password="usuarioempresarial",  
    database="empresarial"      
)

cursor = conexion.cursor()

cursor.execute('''
  INSERT INTO clientes
  VALUES (
    NULL,
    "'''+nombre+'''",
    "'''+apellidos+'''",
    "'''+telefono+'''",
    "'''+email+'''",
    "'''+localidad+'''"
  )
''')
conexion.commit()

cursor.close() 

conexion.close()
```

### clientes

#### Explicación

El fragmento "Información de cliente" por sí solo no es código, sino una descripción o comentario que indica el tipo de contenido que se maneja en ese contexto. En este caso, parece ser el título o la etiqueta de un archivo llamado `clientes.txt` donde se almacena información relacionada con clientes. Es importante porque ayuda a identificar rápidamente el propósito del archivo y su contenido. Este texto podría estar seguido de una lista de datos de clientes, como nombres, direcciones e información de contacto.

En términos de programación, este tipo de texto es útil para guiar a otros desarrolladores o usuarios sobre qué esperar dentro del archivo o cómo interactuar con él. En el contexto del código que rodea a este fragmento, sería crucial entender cuál es la estructura exacta y formato de los datos de clientes que se manejan para poder abrir, leer y escribir en el archivo `clientes.txt` correctamente.

```
Información de cliente
```

### clientes

#### Explicación

Este fragmento de código es un ejemplo simple de un archivo XML que almacena información sobre clientes. En la parte superior, se especifica la versión del lenguaje XML y el encoding utilizado (utf-8), lo cual es importante para asegurar la correcta interpretación de caracteres especiales en cualquier idioma.

El contenido principal está estructurado dentro de una etiqueta raíz llamada `<clientes>`, que contiene información sobre varios clientes. Cada cliente se representa mediante una etiqueta `<cliente>`, y dentro de cada uno de estos, se incluyen tres datos importantes: el nombre del cliente (`<nombre>`), sus apellidos (`<apellidos>`), y su dirección de correo electrónico (`<email>`). Este formato permite organizar claramente la información en un archivo, facilitando así su lectura tanto para humanos como para programas informáticos que procesen este tipo de datos.

Este código es crucial porque proporciona una forma estructurada y estándar de almacenar datos que pueden ser fácilmente manipulados por diferentes aplicaciones o sistemas, permitiendo la interconexión entre diversas partes del software.

```xml
<?xml version='1.0' encoding='utf-8'?>
<clientes>
  <cliente>
    <nombre>jose Vicente</nombre>
    <apellidos>Carratala Sanchis</apellidos>
    <email>info@jocarsa.com</email>
  </cliente>
  <cliente>
    <nombre>Juan</nombre>
    <apellidos>Garcia Lopez</apellidos>
    <email>juan@jocarsa.com</email>
  </cliente>
</clientes>
```

<a id="utilizacion-de-los-sistemas-de-ficheros"></a>
## Utilización de los sistemas de ficheros

En el mundo digital, la lectura y escritura de información son habilidades fundamentales que permiten a los programadores interactuar con los sistemas operativos y almacenar datos de manera eficiente. En esta subunidad didáctica, nos adentramos en el uso avanzado de los sistemas de ficheros, un aspecto crucial del manejo de la información en cualquier aplicación informática.

Comenzamos por entender los conceptos básicos de los sistemas de ficheros. Un sistema de ficheros es una estructura organizada que permite almacenar y recuperar datos en un orden lógico. Cada fichero contiene información relevante, mientras que el sistema de ficheros se encarga de gestionar cómo estos ficheros están distribuidos en el almacenamiento físico del dispositivo.

El primer paso para interactuar con los sistemas de ficheros es conocer las clases asociadas a las operaciones de gestión de ficheros. Estas clases proporcionan una interfaz uniforme para realizar diversas tareas, desde la creación y eliminación de ficheros hasta la lectura y escritura de datos. Familiarizarse con estas clases es esencial para cualquier programador que quiera manipular archivos en su aplicación.

La forma de acceso a un fichero es otro aspecto importante a considerar. Hay dos tipos principales: acceso secuencial y acceso aleatorio. El acceso secuencial implica leer o escribir los datos en el orden en que están almacenados, mientras que el acceso aleatorio permite acceder directamente a cualquier parte del fichero sin necesidad de recorrer todo su contenido. Cada tipo tiene sus ventajas dependiendo del contexto y las necesidades específicas de la aplicación.

Las clases para gestión de flujos de datos desdehacia ficheros son herramientas poderosas que facilitan el trabajo con los sistemas de ficheros. Estas clases permiten realizar operaciones como la lectura, escritura y manipulación de datos en un flujo continuo, lo que es especialmente útil cuando se trata de grandes cantidades de información.

Operaciones sobre ficheros secuenciales y aleatorios son fundamentales para cualquier aplicación que requiera almacenar o recuperar datos. El acceso secuencial es ideal para aplicaciones que manejan archivos pequeños o donde la lectura y escritura ocurren en orden lógico. Por otro lado, el acceso aleatorio es perfecto cuando se necesita acceder a partes específicas del fichero sin importar su posición.

La serialización y deserialización de objetos son técnicas avanzadas que permiten convertir los objetos en un formato que puede ser almacenado o transmitido y luego recuperarlo. Esta capacidad es crucial para aplicaciones que requieren persistencia de datos, ya que permite guardar el estado actual del programa y restaurarlo más tarde.

Trabajar con ficheros implica manejar excepciones detección y tratamiento. Es importante entender cómo capturar y gestionar errores durante la lectura o escritura de archivos, ya que pueden surgir situaciones inesperadas como fallos en el almacenamiento o problemas de permisos.

Desarrollar aplicaciones que utilizan ficheros es una habilidad valiosa para cualquier programador. Al dominar los sistemas de ficheros y las operaciones asociadas, se puede crear software eficiente y robusto que maneje datos con gran capacidad y precisión.

En resumen, el uso avanzado de los sistemas de ficheros es un aspecto crucial del manejo de la información en cualquier aplicación informática. Comprender cómo interactuar con estos sistemas, conocer las clases asociadas a las operaciones de gestión de ficheros y aprender a manejar excepciones son habilidades fundamentales que permiten crear software eficiente y seguro.

### crear archivo

```python
archivo = open("archivo.txt",'w')
archivo.close()
```

### eliminar archivo

```python
import os

archivo = "archivo.txt"
os.remove(archivo)
```

### crear carpetas

```python
import os

os.mkdir("documentos")
```

### crear una carpeta try except

```python
import os

try:
  os.mkdir("documentos")
except:
  print("La carpeta ya existe pero no doy error fatal")
  
print("Y ahora continuamos el programa")
```

### ahora creo documentos dentro de esa carpeta

```python
import os

try:
  os.mkdir("documentos")
except:
  print("La carpeta ya existe pero no doy error fatal")
  
print("Y ahora continuamos el programa")

archivo = open("documentos/cliente.txt",'w')
archivo.close()
```

### parametrizar

#### Explicación

Este código en Python está diseñado para trabajar con archivos y directorios en un sistema de ficheros. En primer lugar, importa la biblioteca `os`, que proporciona funciones para interactuar con el sistema operativo.

El fragmento de código intenta crear una carpeta llamada "documentos". Para hacer esto, utiliza la función `os.mkdir()`. Si esta función no puede crear la carpeta porque ya existe (por ejemplo, si un usuario ejecutó este script antes), se captura y maneja la excepción sin parar el programa. Simplemente imprime en pantalla que la carpeta ya está presente.

Después de intentar crear o verificar la existencia de la carpeta "documentos", el código continúa su ejecución abriendo un archivo llamado `cliente.txt` dentro de esa carpeta y lo crea si no existe, usando el modo `'w'`, que significa escribir. Este modo sobre escribe cualquier contenido previo del archivo o lo crea si no está presente.

Este tipo de manipulación de archivos y carpetas es muy importante en la programación ya que permite a los programas interactuar con el sistema de ficheros del ordenador, permitiendo almacenar, leer y modificar datos fuera de la memoria del programa.

```python
import os

carpeta = "documentos"

try:
  os.mkdir(carpeta)
except:
  print("La carpeta ya existe pero no doy error fatal")
  
print("Y ahora continuamos el programa")

archivo = open(carpeta+"/cliente.txt",'w')
archivo.close()
```

### revisar carpeta

```python
import os

carpeta = "/home/josevicente/Imágenes/Capturas de pantalla"

for directorio,carpetas,archivo in os.walk(carpeta):
  print(directorio)
  print(carpetas)
  print(archivo)
  
```

### recorremos la lista

#### Explicación

Este código es una herramienta útil para explorar el contenido de un directorio en tu sistema, específicamente en la carpeta "/home/josevicente/Imágenes/Capturas de pantalla". Utiliza la biblioteca `os` que proporciona funciones para interactuar con el sistema operativo. La función `os.walk()` es muy poderosa porque permite recorrer todos los directorios y subdirectorios dentro del directorio especificado, generando una lista que contiene información sobre cada nivel del árbol de directorios.

En el bucle for, la variable `directorio` almacena la ruta completa a un directorio en particular. Luego, la variable `carpetas` es una lista que contiene los nombres de todas las subcarpetas dentro del directorio actual. La variable `archivos` también es una lista, pero esta vez con el nombre de todos los archivos presentes en ese mismo directorio.

El código imprime primero el directorio actual, luego la lista de carpetas y finalmente recorre cada archivo individual para imprimir sus nombres. Esto te permite obtener un resumen claro del contenido de cada carpeta que se visita durante el recorrido por el árbol de directorios. Es importante porque te ayuda a entender mejor cómo están organizados tus archivos y carpetas en tu sistema, lo cual es fundamental para la gestión eficiente de recursos en proyectos de programación.

```python
import os

carpeta = "/home/josevicente/Imágenes/Capturas de pantalla"

for directorio,carpetas,archivos in os.walk(carpeta):
  print(directorio)
  print(carpetas)
  for archivo in archivos:
    print(archivo)
  
```

### tamanio y fecha

```python
import os

carpeta = "/home/josevicente/Imágenes/Capturas de pantalla"

total = 0

for directorio,carpetas,archivos in os.walk(carpeta):
  print(directorio)
  print(carpetas)
  for archivo in archivos:
    ruta = os.path.join(directorio,archivo)
    try:
      estadisticas = os.stat(ruta)
      tamanio = estadisticas.st_size
      total = total + tamanio
    except:
      print("No he podido acceder al archivo")

print("el total de la carpeta en bytes es: ",total,"bytes")
print("el total de la carpeta en KB es: ",total/1024,"KB")
print("el total de la carpeta en MB es: ",total/(1024*1024),"MB")
```

### miramos cada uno de los archivos

```python
import os
import time

carpeta = "/home/josevicente/Imágenes/Capturas de pantalla"

total = 0

for directorio,carpetas,archivos in os.walk(carpeta):
  print(directorio)
  print(carpetas)
  for archivo in archivos:
    ruta = os.path.join(directorio,archivo)
    try:
      estadisticas = os.stat(ruta)
      tamanio = estadisticas.st_size
      total = total + tamanio
      fecha = time.strftime('%y-%m-%d-%H:%m:%s',time.localtime(estadisticas.st_mtime))
      print(" ",archivo)
      print("   tamaño",tamanio/(1024*1024))
      print("   fecha",fecha)
      
    except:
      print("No he podido acceder al archivo")

print("el total de la carpeta en bytes es: ",total,"bytes")
print("el total de la carpeta en KB es: ",total/1024,"KB")
print("el total de la carpeta en MB es: ",total/(1024*1024),"MB")
```

### carpeta del repositorio

#### Explicación

Este código en Python está diseñado para recorrer una carpeta específica en el sistema de archivos y obtener información detallada sobre los archivos que contiene. La carpeta principal que se va a explorar es "/var/www/html/dam2526". 

El programa comienza utilizando dos módulos, `os` y `time`, para interactuar con el sistema operativo y manejar fechas y tiempos respectivamente. Luego, mediante un bucle `for` que itera sobre los elementos generados por la función `os.walk()`, recorre todos los directorios y archivos dentro de la carpeta dada.

Para cada archivo encontrado en este proceso, el código intenta obtener sus estadísticas (tamaño, fecha de modificación) utilizando `os.stat()` y luego imprime estos datos: el nombre del archivo, su tamaño en MB y la fecha en que fue modificado por última vez. Si no puede acceder a un archivo debido a permisos o otro error, simplemente imprime un mensaje indicando que no ha podido hacerlo.

Finalmente, después de recorrer todos los archivos, el programa calcula e imprime el tamaño total del contenido de la carpeta en bytes, kilobytes (KB) y megabytes (MB). Esta operación es importante para tener una idea global sobre cuánto espacio ocupa este conjunto de archivos.

Este tipo de script es útil cuando necesitas analizar la estructura y las dimensiones de un directorio específico en tu sistema.

```python
import os
import time

carpeta = "/var/www/html/dam2526"

total = 0

for directorio,carpetas,archivos in os.walk(carpeta):
  print(directorio)
  print(carpetas)
  for archivo in archivos:
    ruta = os.path.join(directorio,archivo)
    try:
      estadisticas = os.stat(ruta)
      tamanio = estadisticas.st_size
      total = total + tamanio
      fecha = time.strftime('%y-%m-%d-%H:%m:%s',time.localtime(estadisticas.st_mtime))
      print(" ",archivo)
      print("   tamaño",tamanio/(1024*1024))
      print("   fecha",fecha)
      
    except:
      print("No he podido acceder al archivo")

print("el total de la carpeta en bytes es: ",total,"bytes")
print("el total de la carpeta en KB es: ",total/1024,"KB")
print("el total de la carpeta en MB es: ",total/(1024*1024),"MB")
```

### jugar con emojis

```python
import os
import time

carpeta = "/var/www/html/dam2526"
# 📂
total = 0

for directorio,carpetas,archivos in os.walk(carpeta):
  for archivo in archivos:
    ruta = os.path.join(directorio,archivo)
    try:
      estadisticas = os.stat(ruta)
      tamanio = estadisticas.st_size
      total = total + tamanio
      fecha = time.strftime('%y-%m-%d-%H:%m:%s',time.localtime(estadisticas.st_mtime))
      print(" 📃",archivo)
      
    except:
      print("No he podido acceder al archivo")

print("el total de la carpeta en bytes es: ",total,"bytes")
print("el total de la carpeta en KB es: ",total/1024,"KB")
print("el total de la carpeta en MB es: ",total/(1024*1024),"MB")
```

### ahora quiero los directoris

#### Explicación

Este código está diseñado para calcular el tamaño total de una carpeta específica y mostrar información sobre cada archivo dentro de ella. La función `os.walk()` se utiliza para recorrer recursivamente todos los directorios y archivos en la ruta proporcionada, que es `/var/www/html/dam2526` en este caso.

El código itera a través de cada directorio encontrado por `os.walk()`, e imprime el nombre del directorio. Luego, dentro de cada directorio, se recorren todos los archivos y se intenta obtener información sobre ellos usando la función `os.stat()`. Esta función devuelve un objeto con detalles como el tamaño y la fecha de modificación del archivo.

Si es posible acceder al archivo (es decir, no hay errores), se imprime el nombre del archivo junto con su tamaño en bytes. Además, calcula el total acumulado de todos los tamaños de archivos encontrados para obtener el tamaño total de la carpeta. Si ocurre algún problema al intentar acceder a un archivo, simplemente se muestra un mensaje indicando que no ha podido acceder a él.

Finalmente, después del recorrido por todos los directorios y archivos, se imprime el tamaño total calculado en bytes, kilobytes (KB) y megabytes (MB). Esto es útil para entender cuánto espacio ocupa la carpeta completa en términos más manejables que simplemente en bytes.

```python
import os
import time

carpeta = "/var/www/html/dam2526"
# 📂
total = 0

for directorio,carpetas,archivos in os.walk(carpeta):
  print("📂",directorio)
  for archivo in archivos:
    ruta = os.path.join(directorio,archivo)
    try:
      estadisticas = os.stat(ruta)
      tamanio = estadisticas.st_size
      total = total + tamanio
      fecha = time.strftime('%y-%m-%d-%H:%m:%s',time.localtime(estadisticas.st_mtime))
      print(" 📃",archivo)
      
    except:
      print("No he podido acceder al archivo")

print("el total de la carpeta en bytes es: ",total,"bytes")
print("el total de la carpeta en KB es: ",total/1024,"KB")
print("el total de la carpeta en MB es: ",total/(1024*1024),"MB")
```

### profunidad

```python
import os
import time

carpeta = "/var/www/html/dam2526"
# 📂
total = 0

for directorio,carpetas,archivos in os.walk(carpeta):

  profundidad = directorio.replace(carpeta, "").count(os.sep)
  sangria = "│   " * profundidad
  print(sangria,"📂",directorio)
  for archivo in archivos:
    ruta = os.path.join(directorio,archivo)
    try:
      estadisticas = os.stat(ruta)
      tamanio = estadisticas.st_size
      total = total + tamanio
      fecha = time.strftime('%y-%m-%d-%H:%m:%s',time.localtime(estadisticas.st_mtime))
      print(sangria," 📃",archivo)
      
    except:
      print("No he podido acceder al archivo")

print("el total de la carpeta en bytes es: ",total,"bytes")
print("el total de la carpeta en KB es: ",total/1024,"KB")
print("el total de la carpeta en MB es: ",total/(1024*1024),"MB")
```

### no me hace falta la ruta completa

#### Explicación

Este código Python tiene como objetivo recorrer una carpeta específica del sistema de archivos y calcular el tamaño total de todos los archivos que contiene, mostrando también la estructura jerárquica de las subcarpetas. Primero, importa dos bibliotecas importantes: `os` para interactuar con el sistema operativo y manejar rutas de archivos, y `time` para trabajar con fechas y horas.

El código comienza definiendo una variable llamada `carpeta`, que almacena la ruta del directorio que se va a analizar (`/var/www/html/dam2526`). Luego utiliza un bucle `for` junto con la función `os.walk()`, que recorre recursivamente todos los archivos y subdirectorios dentro de esa carpeta. 

Para cada archivo o subdirectorio, el código calcula su nivel de profundidad en la estructura jerárquica (es decir, cuántas carpetas abajo está del directorio inicial) y añade un cierto número de caracteres "│   " para mostrar visualmente esta profundidad. Esto ayuda a los usuarios a entender cómo están organizados los archivos y las subcarpetas.

Finalmente, el código calcula el tamaño total en bytes de todos los archivos encontrados y muestra este tamaño tanto en bytes como convertido a kilobytes (KB) e megabytes (MB). Esta funcionalidad es útil para comprender cuánto espacio ocupan los archivos dentro del directorio elegido.

```python
import os
import time

carpeta = "/var/www/html/dam2526"
# 📂
total = 0

for directorio,carpetas,archivos in os.walk(carpeta):

  profundidad = directorio.replace(carpeta, "").count(os.sep)
  sangria = "│   " * profundidad
  print(sangria,"📂",directorio.split("/")[-1])
  for archivo in archivos:
    ruta = os.path.join(directorio,archivo)
    try:
      estadisticas = os.stat(ruta)
      tamanio = estadisticas.st_size
      total = total + tamanio
      fecha = time.strftime('%y-%m-%d-%H:%m:%s',time.localtime(estadisticas.st_mtime))
      print(sangria," 📃",archivo.split("/")[-1])
      
    except:
      print("No he podido acceder al archivo")

print("el total de la carpeta en bytes es: ",total,"bytes")
print("el total de la carpeta en KB es: ",total/1024,"KB")
print("el total de la carpeta en MB es: ",total/(1024*1024),"MB")
```

### python dentro del proyecto intermodular

```markdown
Cliente
CSS (presentacion)
HTML (estructura)
Javascript (Programación en el cliente)

Servidor:
Python (Programación en el lado del servidor)
MySQL (Base de datos)
```

### esquema

```markdown
```mermaid
graph TD
  A[Aplicación Web] --> B[Cliente]
  A --> C[Servidor]

  B --> B1[HTML (Estructura)]
  B --> B2[CSS (Presentación)]
  B --> B3[JavaScript (Programación en el cliente)]

  C --> C1[Python (Programación en el lado del servidor)]
  C --> C2[MySQL (Base de datos)]
```

<a id="creacion-y-eliminacion-de-ficheros-y-directorios"></a>
## Creación y eliminación de ficheros y directorios

En el mundo digital actual, la lectura y escritura de información son operaciones fundamentales que cualquier programa informático debe ser capaz de realizar con eficiencia. En esta subunidad didáctica, nos centramos en las técnicas específicas para crear y eliminar ficheros y directorios, dos aspectos cruciales del manejo de archivos en sistemas informáticos.

La creación de ficheros es un proceso que implica la generación de nuevos archivos con datos o información. En muchos lenguajes de programación, esta tarea se realiza mediante funciones o métodos específicos que permiten especificar el nombre y el contenido del archivo a crear. Por ejemplo, en Java, se puede utilizar la clase `FileWriter` para escribir texto en un nuevo fichero, mientras que en Python, la función incorporada `open()` con el modo 'w' permite crear un nuevo fichero y escribir en él.

Por otro lado, la eliminación de ficheros es una operación que requiere cuidado. Al eliminar un archivo, se pierde permanentemente su contenido a menos que se realice una copia previa. En Java, la clase `File` proporciona el método `delete()` para eliminar un fichero, mientras que en Python, la función `os.remove()` permite realizar esta tarea de manera sencilla.

La gestión de directorios es otro aspecto importante del manejo de archivos. Los directorios son contenedores que pueden almacenar otros directorios y ficheros, formando una estructura jerárquica. En Java, se puede utilizar la clase `File` para crear nuevos directorios con el método `mkdir()`, mientras que en Python, la función `os.mkdir()` cumple un papel similar.

Además de la creación y eliminación de archivos individuales, también es común trabajar con directorios enteros. En Java, la clase `File` ofrece métodos como `listFiles()` para obtener una lista de los ficheros y subdirectorios contenidos en un directorio, mientras que en Python, la función `os.listdir()` proporciona una funcionalidad similar.

La manipulación de directorios también implica la creación y eliminación de estructuras complejas. En Java, se puede utilizar la clase `File` para crear directorios anidados utilizando el método `mkdirs()`, mientras que en Python, la función `os.makedirs()` cumple un papel similar.

Es importante recordar que al trabajar con archivos y directorios, siempre es necesario manejar posibles excepciones. En Java, se pueden utilizar bloques try-catch para capturar y gestionar errores como la falta de permisos o el no existir del fichero o directorio. En Python, también se utilizan bloques try-except para manejar excepciones como `FileNotFoundError` o `PermissionError`.

La creación y eliminación de ficheros y directorios son operaciones esenciales que permiten la organización y gestión de información en sistemas informáticos. A través de estas técnicas, los programadores pueden crear estructuras de datos complejas, almacenar y recuperar información de manera eficiente, y mantener el orden en sus proyectos.

En resumen, la creación y eliminación de ficheros y directorios son habilidades fundamentales que cualquier programa informático debe dominar. A través de las funciones y métodos proporcionados por los lenguajes de programación, podemos realizar estas operaciones con facilidad y precisión, lo que nos permite organizar y gestionar información de manera eficiente en nuestros sistemas.

### crear archivo

```python
archivo = open("archivo.txt",'w')
```

### quitar archivo

```python
import os

os.remove("archivo.txt")
```

### crear un directorio

```python
import os

os.mkdir("midirectorio")
```

### eliminar un directorio

```python
import os

os.rmdir("midirectorio")
```

<a id="entrada-desde-teclado-salida-a-pantalla-formatos-de-visualizacion"></a>
## Entrada desde teclado. Salida a pantalla. Formatos de visualización

En el mundo digital, la capacidad de interactuar con los usuarios es fundamental para cualquier programa informático. La lectura desde teclado y la salida a pantalla son dos operaciones fundamentales que permiten esta comunicación. Comenzamos por entender cómo capturar información directamente del usuario, un proceso conocido como entrada.

La entrada desde teclado es una de las formas más comunes de interactuar con los usuarios en aplicaciones informáticas. Este proceso implica la recopilación de datos introducidos por el usuario a través del teclado y su posterior procesamiento por parte del programa. La lectura de datos desde el teclado puede ser realizada utilizando funciones específicas proporcionadas por diferentes lenguajes de programación, como `input()` en Python o `Scanner` en Java.

Es importante destacar que la entrada desde teclado no es solo una operación técnica; también implica un aspecto ético y legal. Los programas deben respetar la privacidad del usuario y garantizar que los datos introducidos sean seguros y confidenciales. Por lo tanto, es crucial implementar medidas de seguridad adecuadas para proteger la información proporcionada por el usuario.

La salida a pantalla, por otro lado, es el proceso inverso a la entrada. Consiste en mostrar información al usuario de manera visual, facilitando su comprensión y toma de decisiones. En Python, esta operación se realiza con la función `print()`, mientras que en Java se utiliza `System.out.println()`.

La forma en que se presenta la información en pantalla es crucial para la experiencia del usuario. Los formatos de visualización juegan un papel fundamental en cómo los datos son presentados y comprensibles. Por ejemplo, el uso de tablas, listas o gráficos puede facilitar la interpretación de grandes cantidades de información.

Además de mostrar información de manera clara y ordenada, es importante considerar la accesibilidad en la salida a pantalla. Esto significa asegurarse de que los usuarios con discapacidades visuales puedan interactuar con el programa sin dificultades. La utilización de colores contrastantes, leyendas legibles y elementos gráficos intuitivos son aspectos clave para garantizar una experiencia inclusiva.

La lectura desde teclado y la salida a pantalla no son solo operaciones técnicas; también son fundamentales para construir relaciones con los usuarios. Un programa que puede comunicarse eficazmente con el usuario es más probable de ser utilizado y satisfactorio. Por lo tanto, es crucial dedicar tiempo y esfuerzo a diseñar interfaces de usuario intuitivas y amigables.

En conclusión, la lectura desde teclado y la salida a pantalla son operaciones esenciales en cualquier programa informático. No solo permiten la interacción con los usuarios, sino que también contribuyen significativamente a su experiencia y satisfacción. Al entender estos conceptos y aplicarlos de manera efectiva, se puede crear software más robusto y accesible para todos los usuarios.

### programa puro

```python
operando1 = 4
operando2 = 3
operacion = operando1 + operando2
```

### salida

```python
operando1 = 4
operando2 = 3
operacion = operando1 + operando2

print(operacion)
```

### entrada desde teclado

```python
operando1 = int(input("Introduce el primer operando: "))
operando2 = int(input("Introduce el segundo operando: "))
operacion = operando1 + operando2

print(operacion)
```

### colores

```python
print("\033[31m")
print("Esto es un color rojo")
print("\033[32m")
print("Esto es un color verde")
print("\033[33m")
print("Esto es un color amarillo")
print("\033[34m")
print("Esto es un color azul")
```

### estilo de texto

```python
print("\033[0m")
print("Reinicio el texto")
print("\033[1m")
print("Esto es texto negrita")
print("\033[2m")
print("Esto es un texto cursiva")
print("\033[4m")
print("Esto es un texto subrayado")
```

### emojis

```python
print("😁")
```

### barra de progreso

```python
print("⬜⬜⬜⬜⬜⬜◽◽◽◽◽◽◽")
```

### bucle

```python
import time

contador = 0

while True:
  print("⬜"*(contador)+"◽"*(10-contador))
  contador += 1
  if contador > 10:
    exit()
  time.sleep(1)
  
```

### ansi borrar pantalla

```python
import time

contador = 0

while True:
  print("\033[2J")  # Borrar pantalla
  print("⬜"*(contador)+"◽"*(10-contador))
  contador += 1
  if contador > 10:
    exit()
  time.sleep(1)
  
```

### averiguar caracteres de consola

```python
import os

columnas, filas = os.get_terminal_size()
print(columnas)
print(filas)
  
```

### pintar en una posicion concreta

```python
import os

columnas, filas = os.get_terminal_size()
print(columnas)
print(filas)
  
print("\033[16;18H", end="")
print("Hola mundo", end="")
```

### escribir texto centrado

```python
import os

columnas, filas = os.get_terminal_size()
print("\033[2J") # Borrar pantalla
texto = "jocarsa | green"
print("\033[32m") # Texto verde

centrox = round(columnas/2)
centroy = round(filas/2)
iniciox = round(centrox - len(texto)/2)
print(iniciox)
print(f"\033[{centroy};{iniciox}H", end="")
print(texto)
```

### detengo la  ejecucion

```python
import os

columnas, filas = os.get_terminal_size()
print("\033[2J") # Borrar pantalla
texto = "jocarsa | green"
print("\033[32m") # Texto verde

centrox = round(columnas/2)
centroy = round(filas/2)
iniciox = round(centrox - len(texto)/2)
print(f"\033[{centroy};{iniciox}H", end="")
print(texto)
input()


print("\033[2J") # Borrar pantalla
print("1.-Listar clientes")
print("2.-Listado de clientes")
print("3.-Editar un cliente")
print("4.-Eliminar un cliente")
```

### emojis

```python
import os

columnas, filas = os.get_terminal_size()
print("\033[2J") # Borrar pantalla
texto = "jocarsa | green"
print("\033[32m") # Texto verde

centrox = round(columnas/2)
centroy = round(filas/2)
iniciox = round(centrox - len(texto)/2)
print(f"\033[{centroy};{iniciox}H", end="")
print(texto)
input()

print("\033[2J") # Borrar pantalla
print(f"\033[4;4H","➕ 1.-Listar clientes")
print(f"\033[5;4H","👁️‍🗨️ 2.-Listado de clientes")
print(f"\033[6;4H","🖋 3.-Editar un cliente")
print(f"\033[7;4H","❌ 4.-Eliminar un cliente")
```

<a id="interfaces-graficas"></a>
## Interfaces gráficas

En el mundo digital actual, las interfaces gráficas desempeñan un papel crucial en la interacción entre los usuarios y los sistemas informáticos. Estas interfaces no solo facilitan la navegación y la manipulación de datos, sino que también contribuyen a mejorar significativamente la experiencia del usuario final.

La creación de interfaces gráficas es una habilidad fundamental para cualquier programador o desarrollador de software. Esta carpeta del contenido aborda los aspectos teóricos y prácticos necesarios para diseñar e implementar interfaces gráficas efectivas. Comenzamos por explorar los conceptos básicos, como las clases y propiedades que definen la estructura y el comportamiento de los componentes visuales.

A medida que avanzamos en esta sección, nos sumergimos en la creación de eventos y asociaciones de acciones a estos mismos. Los eventos son acciones específicas que ocurren dentro de la interfaz gráfica, como hacer clic en un botón o seleccionar un elemento del menú. Asociar acciones a estos eventos permite al programador responder de manera dinámica a las interacciones del usuario.

La persistencia es otro aspecto crucial en el desarrollo de interfaces gráficas. Es importante que los cambios realizados por el usuario se reflejen adecuadamente en la interfaz, y que esta pueda ser recuperada en caso de un reinicio o pérdida de datos. La carpeta también aborda técnicas avanzadas para gestionar la persistencia de componentes, asegurando que la información no se pierda.

Además, el contenido explora la creación de interfaces naturales de usuario (NUI), una área emergente que busca hacer que las interfaces sean más intuitivas y accesibles. Esto implica el uso de tecnologías como la voz y el movimiento del cuerpo para interactuar con los sistemas, así como la realidad aumentada.

La carpeta también incluye información sobre la documentación de aplicaciones, un aspecto fundamental para mantener el código legible y mantenible a largo plazo. Se abordan herramientas gráficas integradas en el IDE y externas al mismo, proporcionando una visión completa del proceso de creación de documentación.

Finalmente, se trata de la distribución de aplicaciones, un tema que aborda desde la empaquetación hasta la firma digital y las canales de distribución. La carpeta ofrece una guía práctica sobre cómo crear instaladores y paquetes autoinstalables, asegurando que los usuarios puedan instalar y usar la aplicación con facilidad.

En resumen, esta carpeta del contenido proporciona un enfoque integral al desarrollo de interfaces gráficas, desde sus fundamentos hasta técnicas avanzadas y prácticas recomendadas. Cada párrafo se desarrolla continuamente, ofreciendo una visión coherente y detallada del proceso de creación e implementación de interfaces gráficas en aplicaciones informáticas.

### importar libreria

```python
import tkinter
```

### crear ventana

```python
import tkinter as tk

ventana = tk.Tk()

ventana.mainloop()
```

### texto

```python
import tkinter as tk

ventana = tk.Tk()
tk.Label(text="Hola en Python").pack(padx=40,pady=40)

ventana.mainloop()
```

### boton

```python
import tkinter as tk

ventana = tk.Tk()
tk.Label(text="Hola en Python").pack(padx=40,pady=40)
tk.Button(text="Pulsame").pack(padx=40,pady=40)

ventana.mainloop()
```

### entradas

```python
import tkinter as tk

ventana = tk.Tk()
tk.Entry(ventana).pack(padx = 40,pady = 40)

ventana.mainloop()
```

### texto

```python
import tkinter as tk

ventana = tk.Tk()
tk.Text(ventana,height=5,width=30).pack(padx = 40,pady = 40)

ventana.mainloop()
```

### checkbuttons

```python
import tkinter as tk

ventana = tk.Tk()
tk.Checkbutton(ventana,text="Acepto lo que me digas").pack(padx = 40,pady = 40)

ventana.mainloop()
```

### Radiobutton

```python
import tkinter as tk

ventana = tk.Tk()
tk.Radiobutton(ventana,text="Acepto lo que me digas").pack(padx = 40,pady = 40)

ventana.mainloop()
```

### Lista de opciones

```python
import tkinter as tk

ventana = tk.Tk()
frutas = ["manzana","pera","platano","limon"]
lista = tk.Listbox(ventana)
for fruta in frutas:
  lista.insert(tk.END,fruta)
  
lista.pack()

ventana.mainloop()
```

### combo

```python
import tkinter as tk
from tkinter.ttk import Combobox

ventana = tk.Tk()
desplegable = Combobox(ventana,values = ["manzana","pera","platano"])
desplegable.pack(padx=40,pady=40)

ventana.mainloop()
```

### calculadora muy basica

```python
import tkinter as tk


ventana = tk.Tk()
operando1 = tk.Entry(ventana)
operando1.pack(padx = 10, pady = 10)

operando2 = tk.Entry(ventana)
operando2.pack(padx = 10, pady = 10)

ventana.mainloop()
```

### pongo un boton

```python
import tkinter as tk


ventana = tk.Tk()
operando1 = tk.Entry(ventana)
operando1.pack(padx = 10, pady = 10)

operando2 = tk.Entry(ventana)
operando2.pack(padx = 10, pady = 10)

boton = tk.Button(text="Resolver")
boton.pack(padx = 10, pady = 10)

resultado = tk.Entry(ventana)
resultado.pack(padx = 10, pady = 10) 

ventana.mainloop()
```

### accion del boton

```python
import tkinter as tk


ventana = tk.Tk()
operando1 = tk.Entry(ventana)
operando1.pack(padx = 10, pady = 10)

operando2 = tk.Entry(ventana)
operando2.pack(padx = 10, pady = 10)

boton = tk.Button(text="Resolver",command=resuelve)
boton.pack(padx = 10, pady = 10)

resultado = tk.Entry(ventana)
resultado.pack(padx = 10, pady = 10) 

ventana.mainloop()
```

### definicion de la funcion

```python
import tkinter as tk

def resuelve():
  print("Vamos a resolver")

ventana = tk.Tk()
operando1 = tk.Entry(ventana)
operando1.pack(padx = 10, pady = 10)

operando2 = tk.Entry(ventana)
operando2.pack(padx = 10, pady = 10)

boton = tk.Button(text="Resolver",command=resuelve)
boton.pack(padx = 10, pady = 10)

resultado = tk.Entry(ventana)
resultado.pack(padx = 10, pady = 10) 

ventana.mainloop()
```

### atrapamos los datos

```python
import tkinter as tk

def resuelve():
  o1 = float(operando1.get())
  o2 = float(operando2.get())
  print(o1+o2)

ventana = tk.Tk()
operando1 = tk.Entry(ventana)
operando1.pack(padx = 10, pady = 10)

operando2 = tk.Entry(ventana)
operando2.pack(padx = 10, pady = 10)

boton = tk.Button(text="Resolver",command=resuelve)
boton.pack(padx = 10, pady = 10)

resultado = tk.Entry(ventana)
resultado.pack(padx = 10, pady = 10) 

ventana.mainloop()
```

### resultado en la interfaz

```python
import tkinter as tk

def resuelve():
  o1 = int(operando1.get())
  o2 = int(operando2.get())
  r = o1+o2
  resultado.delete(0,tk.END)
  resultado.insert(0,r)
  

ventana = tk.Tk()
operando1 = tk.Entry(ventana)
operando1.pack(padx = 10, pady = 10)

operando2 = tk.Entry(ventana)
operando2.pack(padx = 10, pady = 10)

boton = tk.Button(text="Resolver",command=resuelve)
boton.pack(padx = 10, pady = 10)

resultado = tk.Entry(ventana)
resultado.pack(padx = 10, pady = 10) 

ventana.mainloop()
```

### ventana con clientes

```python
import tkinter as tk

ventana = tk.Tk()

tk.Label(ventana,text="Introduce el nombre del cliente").pack(padx=10,pady=2)
nombre = tk.Entry(ventana)
nombre.pack(padx=10,pady=2)

tk.Label(ventana,text="Introduce los apellidos del cliente").pack(padx=10,pady=2)
apellidos = tk.Entry(ventana)
apellidos.pack(padx=10,pady=2)

tk.Label(ventana,text="Introduce el email del cliente").pack(padx=10,pady=2)
email = tk.Entry(ventana)
email.pack(padx=10,pady=2)

tk.Button(ventana,text="Insertar un cliente").pack(padx=10,pady=2)

ventana.mainloop()
```

### comando de ejecucion

```python
import tkinter as tk

def insertaCliente():
  print("Voy a insertar un cliente")

ventana = tk.Tk()

tk.Label(ventana,text="Introduce el nombre del cliente").pack(padx=10,pady=2)
nombre = tk.Entry(ventana)
nombre.pack(padx=10,pady=2)

tk.Label(ventana,text="Introduce los apellidos del cliente").pack(padx=10,pady=2)
apellidos = tk.Entry(ventana)
apellidos.pack(padx=10,pady=2)

tk.Label(ventana,text="Introduce el email del cliente").pack(padx=10,pady=2)
email = tk.Entry(ventana)
email.pack(padx=10,pady=2)

tk.Button(ventana,text="Insertar un cliente",command=insertaCliente).pack(padx=10,pady=2)

ventana.mainloop()
```

### Ahora guardo los datos

```python
import tkinter as tk

def insertaCliente():
  archivo = open("clientes.csv","a")
  archivo.write(nombre.get()+","+apellidos.get()+","+email.get()+"\n")
  archivo.close()
  

ventana = tk.Tk()

tk.Label(ventana,text="Introduce el nombre del cliente").pack(padx=10,pady=2)
nombre = tk.Entry(ventana)
nombre.pack(padx=10,pady=2)

tk.Label(ventana,text="Introduce los apellidos del cliente").pack(padx=10,pady=2)
apellidos = tk.Entry(ventana)
apellidos.pack(padx=10,pady=2)

tk.Label(ventana,text="Introduce el email del cliente").pack(padx=10,pady=2)
email = tk.Entry(ventana)
email.pack(padx=10,pady=2)

tk.Button(ventana,text="Insertar un cliente",command=insertaCliente).pack(padx=10,pady=2)

ventana.mainloop()
```

### Creo un componente text

```python
import tkinter as tk

def insertaCliente():
  archivo = open("clientes.csv","a")
  archivo.write(nombre.get()+","+apellidos.get()+","+email.get()+"\n")
  archivo.close()
  

ventana = tk.Tk()

tk.Label(ventana,text="Introduce el nombre del cliente").pack(padx=10,pady=2)
nombre = tk.Entry(ventana)
nombre.pack(padx=10,pady=2)

tk.Label(ventana,text="Introduce los apellidos del cliente").pack(padx=10,pady=2)
apellidos = tk.Entry(ventana)
apellidos.pack(padx=10,pady=2)

tk.Label(ventana,text="Introduce el email del cliente").pack(padx=10,pady=2)
email = tk.Entry(ventana)
email.pack(padx=10,pady=2)

tk.Button(ventana,text="Insertar un cliente",command=insertaCliente).pack(padx=10,pady=2)

texto = tk.Text(ventana,height=5,width=30)
texto.pack(padx=10,pady=2)

ventana.mainloop()
```

### listar clientes

```python
import tkinter as tk

def insertaCliente():
  archivo = open("clientes.csv","a")
  archivo.write(nombre.get()+","+apellidos.get()+","+email.get()+"\n")
  archivo.close()
  listaClientes()
  
def listaClientes():
  texto.delete(1.0,tk.END)
  archivo = open("clientes.csv","r")
  lineas = archivo.readlines()
  for linea in lineas:
    texto.insert(tk.END,linea)
  archivo.close()
  
ventana = tk.Tk()

tk.Label(ventana,text="Introduce el nombre del cliente").pack(padx=10,pady=2)
nombre = tk.Entry(ventana)
nombre.pack(padx=10,pady=2)

tk.Label(ventana,text="Introduce los apellidos del cliente").pack(padx=10,pady=2)
apellidos = tk.Entry(ventana)
apellidos.pack(padx=10,pady=2)

tk.Label(ventana,text="Introduce el email del cliente").pack(padx=10,pady=2)
email = tk.Entry(ventana)
email.pack(padx=10,pady=2)

tk.Button(ventana,text="Insertar un cliente",command=insertaCliente).pack(padx=10,pady=2)

texto = tk.Text(ventana,height=5,width=30)
texto.pack(padx=10,pady=2)

listaClientes()

ventana.mainloop()
```

### rejilla

```python
import tkinter as tk
  
ventana = tk.Tk()

boton1 = tk.Button(text="Pulsame1")
boton1.pack(padx=10,pady=10)

boton2 = tk.Button(text="Pulsame2")
boton2.pack(padx=10,pady=10)

boton3 = tk.Button(text="Pulsame3")
boton3.pack(padx=10,pady=10)

boton4 = tk.Button(text="Pulsame4")
boton4.pack(padx=10,pady=10)

ventana.mainloop()
```

### rejilla en lugar de pack

```python
import tkinter as tk
  
ventana = tk.Tk()

boton1 = tk.Button(text="Pulsame1")
boton1.grid(row=0,column=0)

boton2 = tk.Button(text="Pulsame2")
boton2.grid(row=0,column=1)

boton3 = tk.Button(text="Pulsame3")
boton3.grid(row=1,column=0)

boton4 = tk.Button(text="Pulsame4")
boton4.grid(row=1,column=1)

ventana.mainloop()
```

### replanteo la interfaz

```python
import tkinter as tk

def insertaCliente():
  archivo = open("clientes.csv","a")
  archivo.write(nombre.get()+","+apellidos.get()+","+email.get()+"\n")
  archivo.close()
  listaClientes()
  
def listaClientes():
  texto.delete(1.0,tk.END)
  archivo = open("clientes.csv","r")
  lineas = archivo.readlines()
  for linea in lineas:
    texto.insert(tk.END,linea)
  archivo.close()
  
ventana = tk.Tk()

tk.Label(ventana,text="Introduce el nombre del cliente").pack(padx=10,pady=2)
nombre = tk.Entry(ventana)
nombre.pack(padx=10,pady=2)

tk.Label(ventana,text="Introduce los apellidos del cliente").pack(padx=10,pady=2)
apellidos = tk.Entry(ventana)
apellidos.pack(padx=10,pady=2)

tk.Label(ventana,text="Introduce el email del cliente").pack(padx=10,pady=2)
email = tk.Entry(ventana)
email.pack(padx=10,pady=2)

tk.Button(ventana,text="Insertar un cliente",command=insertaCliente).pack(padx=10,pady=2)

texto = tk.Text(ventana,height=5,width=30)
texto.pack(padx=10,pady=2)

listaClientes()

ventana.mainloop()
```

### contenedores

```python
import tkinter as tk

def insertaCliente():
  archivo = open("clientes.csv","a")
  archivo.write(nombre.get()+","+apellidos.get()+","+email.get()+"\n")
  archivo.close()
  listaClientes()
  
def listaClientes():
  texto.delete(1.0,tk.END)
  archivo = open("clientes.csv","r")
  lineas = archivo.readlines()
  for linea in lineas:
    texto.insert(tk.END,linea)
  archivo.close()
  
ventana = tk.Tk()

marco1 = tk.Frame()

tk.Label(marco1,text="Introduce el nombre del cliente").pack(padx=10,pady=2)
nombre = tk.Entry(marco1)
nombre.pack(padx=10,pady=2)

tk.Label(marco1,text="Introduce los apellidos del cliente").pack(padx=10,pady=2)
apellidos = tk.Entry(marco1)
apellidos.pack(padx=10,pady=2)

tk.Label(marco1,text="Introduce el email del cliente").pack(padx=10,pady=2)
email = tk.Entry(marco1)
email.pack(padx=10,pady=2)

tk.Button(marco1,text="Insertar un cliente",command=insertaCliente).pack(padx=10,pady=2)

marco1.grid(row=0,column=0)

texto = tk.Text(ventana,height=5,width=30)
texto.grid(row=0,column=1)

listaClientes()

ventana.mainloop()
```

### frame con label

```python
import tkinter as tk

def insertaCliente():
  archivo = open("clientes.csv","a")
  archivo.write(nombre.get()+","+apellidos.get()+","+email.get()+"\n")
  archivo.close()
  listaClientes()
  
def listaClientes():
  texto.delete(1.0,tk.END)
  archivo = open("clientes.csv","r")
  lineas = archivo.readlines()
  for linea in lineas:
    texto.insert(tk.END,linea)
  archivo.close()
  
ventana = tk.Tk()

marco1 = tk.LabelFrame(text="Insertar un cliente")

tk.Label(marco1,text="Introduce el nombre del cliente").pack(padx=10,pady=2)
nombre = tk.Entry(marco1)
nombre.pack(padx=10,pady=2)

tk.Label(marco1,text="Introduce los apellidos del cliente").pack(padx=10,pady=2)
apellidos = tk.Entry(marco1)
apellidos.pack(padx=10,pady=2)

tk.Label(marco1,text="Introduce el email del cliente").pack(padx=10,pady=2)
email = tk.Entry(marco1)
email.pack(padx=10,pady=2)

tk.Button(marco1,text="Insertar un cliente",command=insertaCliente).pack(padx=10,pady=2)

marco1.grid(row=0,column=0,padx=10,pady=10)

texto = tk.Text(ventana,height=5,width=30)
texto.grid(row=0,column=1)

listaClientes()

ventana.mainloop()
```

### creamos un segundo marco

```python
import tkinter as tk

def insertaCliente():
  archivo = open("clientes.csv","a")
  archivo.write(nombre.get()+","+apellidos.get()+","+email.get()+"\n")
  archivo.close()
  listaClientes()
  
def listaClientes():
  texto.delete(1.0,tk.END)
  archivo = open("clientes.csv","r")
  lineas = archivo.readlines()
  for linea in lineas:
    texto.insert(tk.END,linea)
  archivo.close()
  
ventana = tk.Tk()

marco1 = tk.LabelFrame(text="Insertar un cliente")

tk.Label(marco1,text="Introduce el nombre del cliente").pack(padx=10,pady=2)
nombre = tk.Entry(marco1)
nombre.pack(padx=10,pady=2)

tk.Label(marco1,text="Introduce los apellidos del cliente").pack(padx=10,pady=2)
apellidos = tk.Entry(marco1)
apellidos.pack(padx=10,pady=2)

tk.Label(marco1,text="Introduce el email del cliente").pack(padx=10,pady=2)
email = tk.Entry(marco1)
email.pack(padx=10,pady=2)

tk.Button(marco1,text="Insertar un cliente",command=insertaCliente).pack(padx=10,pady=2)

marco1.grid(row=0,column=0)

marco2 = tk.LabelFrame(text="Listar clientes")

texto = tk.Text(marco2,height=5,width=30)
texto.pack(padx=10,pady=10)

marco2.grid(row=0,column=1,padx=10,pady=10)

listaClientes()

ventana.mainloop()
```

### ttkbootstrap

```python
import tkinter as tk
import ttkbootstrap as tb
from ttkbootstrap.constants import *

def insertaCliente():
  archivo = open("clientes.csv","a")
  archivo.write(nombre.get()+","+apellidos.get()+","+email.get()+"\n")
  archivo.close()
  listaClientes()
  
def listaClientes():
  texto.delete(1.0,tk.END)
  archivo = open("clientes.csv","r")
  lineas = archivo.readlines()
  for linea in lineas:
    texto.insert(tk.END,linea)
  archivo.close()
  
#ventana = tk.Tk()
ventana = tb.Window(themename = "vapor")

marco1 = tk.LabelFrame(text="Insertar un cliente")

tk.Label(marco1,text="Introduce el nombre del cliente").pack(padx=10,pady=2)
nombre = tk.Entry(marco1)
nombre.pack(padx=10,pady=2)

tk.Label(marco1,text="Introduce los apellidos del cliente").pack(padx=10,pady=2)
apellidos = tk.Entry(marco1)
apellidos.pack(padx=10,pady=2)

tk.Label(marco1,text="Introduce el email del cliente").pack(padx=10,pady=2)
email = tk.Entry(marco1)
email.pack(padx=10,pady=2)

tk.Button(marco1,text="Insertar un cliente",command=insertaCliente).pack(padx=10,pady=2)

marco1.grid(row=0,column=0)

marco2 = tk.LabelFrame(text="Listar clientes")

texto = tk.Text(marco2,height=5,width=30)
texto.pack(padx=10,pady=10)

marco2.grid(row=0,column=1,padx=10,pady=10)

listaClientes()

ventana.mainloop()
```

### flask

```python
from flask import Flask  

aplicacion = Flask(__name__)

@aplicacion.route("/")
def raiz():
  cadena = '''
    <style>
      input{
        border:2px solid blue;
        padding:5px;
        box-shadow:0px 2px 4px rgba(0,0,0,0.3) inset;
        border-radius:100px;
        text-align:center;
        text-shadow:0px 2px 2px rgba(0,0,0,0.3);
      }
    </style>
    <input type="text">
  '''
  return cadena
  
if __name__ == "__main__":
  aplicacion.run(host="127.0.0.1", port=5000,debug=True)
```

### clientes

```
aaa,aaa,aaa
bbb,bbb,bbb
ccc,ccc,ccc
ddd,ddd,ddd
```

### clientes

```
aaa,aaa,aaa
```

<a id="concepto-de-evento"></a>
## Concepto de evento

En el vasto universo de la programación, los eventos son una parte fundamental que permite a las aplicaciones interactuar con el usuario y su entorno. Un evento es cualquier cosa que ocurre en un programa o en el sistema operativo que puede ser detectada por el software para realizar alguna acción. Estos pueden ser acciones del usuario como hacer clic en un botón, escribir texto en una caja de entrada o incluso cambios en la red.

La comprensión y manejo de eventos es crucial para desarrollar interfaces gráficas de usuario (GUI) interactivas y responsivas. Cada evento tiene asociado un manejador que define qué debe hacerse cuando el evento ocurre. Por ejemplo, si se hace clic en un botón, el manejador del evento puede ejecutar una función que cambia la interfaz o realiza alguna operación.

Los eventos pueden ser de diferentes tipos, como eventos de entrada (como teclas presionadas), eventos de salida (como el cierre de una ventana) y eventos de red (como la llegada de datos). Cada tipo de evento tiene sus propias características y manejadores específicos que permiten al programador controlar su comportamiento.

La gestión eficiente de los eventos es esencial para mantener la fluidez y la responsividad de las aplicaciones. Algunos lenguajes de programación, como Java o C#, tienen mecanismos incorporados para manejar eventos de manera sencilla y segura. Estas herramientas proporcionan clases y métodos que facilitan el registro de manejadores de eventos y la propagación de los mismos.

Además de los eventos generados por el usuario, también existen eventos internos del sistema operativo que pueden ser relevantes para una aplicación. Por ejemplo, un evento puede ocurrir cuando se cambia el tamaño de la ventana principal de una aplicación, lo cual puede requerir ajustes en la disposición de los elementos gráficos.

La programación orientada a objetos (OOP) es especialmente útil para manejar eventos, ya que permite encapsular el comportamiento relacionado con un evento dentro de una clase. Esto facilita la organización del código y hace más fácil mantener y escalar las aplicaciones.

En resumen, los eventos son un componente esencial en la programación moderna, permitiendo a las aplicaciones interactuar dinámicamente con el usuario y su entorno. La comprensión de cómo crear, manejar y propagar eventos es fundamental para desarrollar interfaces gráficas interactivas y responsivas. A través del uso adecuado de manejadores de eventos y técnicas orientadas a objetos, los programadores pueden crear aplicaciones que respondan eficazmente a las acciones del usuario y proporcionen una experiencia óptima.

### repasamos tkinter

```python
import tkinter as tk

ventana = tk.Tk()

ventana.mainloop()
```

### creamos tabla

```sql
CREATE TABLE "clientes" (
	"Identificador"	INTEGER,
	"nombre"	TEXT,
	"apellidos"	TEXT,
	"email"	TEXT,
	PRIMARY KEY("Identificador" AUTOINCREMENT)
);
```

### formulario

```python
import tkinter as tk

ventana = tk.Tk()

nombre = tk.Entry(ventana)
nombre.pack(padx = 20,pady = 20)

apellidos = tk.Entry(ventana)
apellidos.pack(padx = 20,pady = 20)

email = tk.Entry(ventana)
email.pack(padx = 20,pady = 20)

boton = tk.Button(ventana,text="Insertar cliente")
boton.pack(padx = 20,pady = 20)

ventana.mainloop()
```

### comando del boton

```python
import tkinter as tk

ventana = tk.Tk()

nombre = tk.Entry(ventana)
nombre.pack(padx = 20,pady = 20)

apellidos = tk.Entry(ventana)
apellidos.pack(padx = 20,pady = 20)

email = tk.Entry(ventana)
email.pack(padx = 20,pady = 20)

boton = tk.Button(ventana,text="Insertar cliente",command=insertaCliente)
boton.pack(padx = 20,pady = 20)

ventana.mainloop()
```

### defino la funcion de insercion

```python
import tkinter as tk

ventana = tk.Tk()

def insertaCliente():
  print("Voy a insertar un cliente")

nombre = tk.Entry(ventana)
nombre.pack(padx = 20,pady = 20)

apellidos = tk.Entry(ventana)
apellidos.pack(padx = 20,pady = 20)

email = tk.Entry(ventana)
email.pack(padx = 20,pady = 20)

boton = tk.Button(ventana,text="Insertar cliente",command=insertaCliente)
boton.pack(padx = 20,pady = 20)

ventana.mainloop()
```

### abro base de datos e inserto

```python
import tkinter as tk
import sqlite3

conexion = sqlite3.connect("clientes.db")
cursor = conexion.cursor()

ventana = tk.Tk()

def insertaCliente():
  cursor.execute('INSERT INTO clientes VALUES(NULL,"","","")')
  conexion.commit()

nombre = tk.Entry(ventana)
nombre.pack(padx = 20,pady = 20)

apellidos = tk.Entry(ventana)
apellidos.pack(padx = 20,pady = 20)

email = tk.Entry(ventana)
email.pack(padx = 20,pady = 20)

boton = tk.Button(ventana,text="Insertar cliente",command=insertaCliente)
boton.pack(padx = 20,pady = 20)

ventana.mainloop()
```

### inserto de verdad

```python
import tkinter as tk
import sqlite3

conexion = sqlite3.connect("clientes.db")
cursor = conexion.cursor()

ventana = tk.Tk()

def insertaCliente():
  cursor.execute('INSERT INTO clientes VALUES(NULL,"'+nombre.get()+'","'+apellidos.get()+'","'+email.get()+'")')
  conexion.commit()

nombre = tk.Entry(ventana)
nombre.pack(padx = 20,pady = 20)

apellidos = tk.Entry(ventana)
apellidos.pack(padx = 20,pady = 20)

email = tk.Entry(ventana)
email.pack(padx = 20,pady = 20)

boton = tk.Button(ventana,text="Insertar cliente",command=insertaCliente)
boton.pack(padx = 20,pady = 20)

ventana.mainloop()
```

### ttkbootstrap

```python
import tkinter as tk
import sqlite3
import ttkbootstrap as tb
from ttkbootstrap import ttk

conexion = sqlite3.connect("clientes.db")
cursor = conexion.cursor()

#ventana = tk.Tk()
ventana = tb.Window(themename="darkly")

def insertaCliente():
  cursor.execute('INSERT INTO clientes VALUES(NULL,"'+nombre.get()+'","'+apellidos.get()+'","'+email.get()+'")')
  conexion.commit()

nombre = tk.Entry(ventana)
nombre.pack(padx = 20,pady = 20)

apellidos = tk.Entry(ventana)
apellidos.pack(padx = 20,pady = 20)

email = tk.Entry(ventana)
email.pack(padx = 20,pady = 20)

boton = tk.Button(ventana,text="Insertar cliente",command=insertaCliente)
boton.pack(padx = 20,pady = 20)

ventana.mainloop()
```

### indexador parte 1

```python
import tkinter as tk

ventana = tk.Tk()


ventana.mainloop()
```

### insertar carpeta

```python
import tkinter as tk

ventana = tk.Tk()

tk.Label("Indica el nombre de la carpeta a indexar").pack(padx = 20,pady = 20)
carpeta = tk.Entry()
carpeta.pack(padx = 20,pady = 20)

tk.Label("Indica el nombre del disco").pack(padx = 20,pady = 20)
disco = tk.Entry()
disco.pack(padx = 20,pady = 20)

tk.Button(text="Procesar",command = procesar)

ventana.mainloop()
```

### ejecuto comando

```python
import tkinter as tk

ventana = tk.Tk()

def procesar():
  print("Voy a procesar")

tk.Label(text="Indica el nombre de la carpeta a indexar").pack(padx = 20,pady = 20)
carpeta = tk.Entry()
carpeta.pack(padx = 20,pady = 20)

tk.Label(text="Indica el nombre del disco").pack(padx = 20,pady = 20)
disco = tk.Entry()
disco.pack(padx = 20,pady = 20)

tk.Button(text="Procesar",command = procesar).pack(padx = 20,pady = 20)

ventana.mainloop()
```

### sql crear discos

```sql
CREATE TABLE "archivos" (
	"identificador"	INTEGER,
	"disco"	TEXT,
	"ruta"	TEXT,
	"archivo"	TEXT,
	"tamanio"	TEXT,
	"creacion"	TEXT,
	"modificacion"	TEXT,
	PRIMARY KEY("identificador" AUTOINCREMENT)
);
```

### insertar

```python
import tkinter as tk
import os
import sqlite3
from datetime import datetime

ventana = tk.Tk()

def procesar():
    carpeta_inicial = carpeta.get().strip()
    nombre_disco = disco.get().strip()

    if not carpeta_inicial or not os.path.isdir(carpeta_inicial) or not nombre_disco:
        print("Carpeta o disco no válidos")
        return

    conn = sqlite3.connect("discos.db")
    cur = conn.cursor()

    for raiz, subdirs, archivos in os.walk(carpeta_inicial):
        for arch in archivos:
            ruta_completa = os.path.join(raiz, arch)
            try:
                tamanio = os.path.getsize(ruta_completa)
                creacion = datetime.fromtimestamp(os.path.getctime(ruta_completa)).isoformat(timespec="seconds")
                modificacion = datetime.fromtimestamp(os.path.getmtime(ruta_completa)).isoformat(timespec="seconds")

                cur.execute(
                    "INSERT INTO archivos (disco, ruta, archivo, tamanio, creacion, modificacion) VALUES (?,?,?,?,?,?)",
                    (nombre_disco, raiz, arch, str(tamanio), creacion, modificacion)
                )
            except Exception as e:
                # si algún archivo no se puede leer, lo saltamos
                continue

    conn.commit()
    conn.close()
    print("Proceso completado")


tk.Label(text="Indica el nombre de la carpeta a indexar").pack(padx = 20,pady = 20)
carpeta = tk.Entry()
carpeta.pack(padx = 20,pady = 20)

tk.Label(text="Indica el nombre del disco").pack(padx = 20,pady = 20)
disco = tk.Entry()
disco.pack(padx = 20,pady = 20)

tk.Button(text="Procesar",command = procesar).pack(padx = 20,pady = 20)

ventana.mainloop()
```

### tree

```python
#!/usr/bin/env python3
import tkinter as tk
from tkinter import ttk

DATA = [
    (1, "Manzana", 0.99),
    (2, "Banana", 0.59),
    (3, "Cereza", 2.49),
    (4, "Durazno", 1.49),
    (5, "Uva", 2.99),
    (6, "Kiwi", 1.09),
    (7, "Mango", 1.89),
    (8, "Naranja", 0.79),
    (9, "Pera", 1.19),
    (10, "Sandía", 3.99),
]

def make_table(root):
    root.title("Minimal Treeview Table (Tkinter)")

    # --- container frame
    frm = ttk.Frame(root, padding=8)
    frm.grid(sticky="nsew")
    root.rowconfigure(0, weight=1)
    root.columnconfigure(0, weight=1)

    # --- treeview (table)
    columns = ("id", "producto", "precio")
    tree = ttk.Treeview(frm, columns=columns, show="headings", height=12)
    tree.grid(row=0, column=0, sticky="nsew")

    # --- scrollbar
    vsb = ttk.Scrollbar(frm, orient="vertical", command=tree.yview)
    vsb.grid(row=0, column=1, sticky="ns")
    tree.configure(yscrollcommand=vsb.set)

    # --- table sizing behavior
    frm.rowconfigure(0, weight=1)
    frm.columnconfigure(0, weight=1)

    # --- headings & columns
    tree.heading("id", text="ID", command=lambda c="id": sort_by(tree, c))
    tree.heading("producto", text="Producto", command=lambda c="producto": sort_by(tree, c))
    tree.heading("precio", text="Precio (€)", command=lambda c="precio": sort_by(tree, c))

    tree.column("id", width=60, anchor="e")
    tree.column("producto", width=200, anchor="w")
    tree.column("precio", width=100, anchor="e")

    # --- striped rows
    tree.tag_configure("odd", background="#f7f7f7")
    tree.tag_configure("even", background="#ffffff")

    # --- populate
    for i, row in enumerate(DATA):
        tags = ("even",) if i % 2 == 0 else ("odd",)
        tree.insert("", "end", values=row, tags=tags)

    # --- double click handler
    def on_open(event):
        item_id = tree.focus()
        if not item_id:
            return
        print("Selected row:", tree.item(item_id, "values"))

    tree.bind("<Double-1>", on_open)

    return tree

# --- sorting helper
_sort_state = {}  # column -> bool (True asc, False desc)
def sort_by(tree: ttk.Treeview, column: str):
    # Extract column values
    rows = [(tree.set(k, column), k) for k in tree.get_children("")]
    # Try numeric sort if possible, else lexical (casefold for nicer results)
    def cast(x):
        try:
            return float(x.replace(",", "."))
        except Exception:
            return x.casefold()
    rows.sort(key=lambda t: cast(t[0]), reverse=_sort_state.get(column, False))
    _sort_state[column] = not _sort_state.get(column, False)

    # Reinsert in new order
    for index, (_, iid) in enumerate(rows):
        tree.move(iid, "", index)

if __name__ == "__main__":
    root = tk.Tk()
    make_table(root)
    root.mainloop()
```

### arbol sencillo

```python
#!/usr/bin/env python3
import tkinter as tk
from tkinter import ttk

# Datos de muestra
datos = [
    (1, "Manzana", 0.99),
    (2, "Banana", 0.59),
    (3, "Cereza", 2.49),
    (4, "Durazno", 1.49),
]

ventana = tk.Tk()

# Creo una vista de arbol que me sirve para jerarquias y para tablas
columnas = ("id", "producto", "precio")
arbol = ttk.Treeview(ventana, columns=columnas)

# --- Defino las cabeceras
arbol.heading("id", text="ID")
arbol.heading("producto", text="Producto")
arbol.heading("precio", text="Precio (€)")


for fila in datos:
    arbol.insert("", "end", values=fila)

arbol.pack(padx=10, pady=10)

ventana.mainloop()
```

### recuperamos aplicacion discos

```python
import tkinter as tk
import os
import sqlite3
from datetime import datetime

ventana = tk.Tk()

def procesar():
    carpeta_inicial = carpeta.get().strip()
    nombre_disco = disco.get().strip()

    if not carpeta_inicial or not os.path.isdir(carpeta_inicial) or not nombre_disco:
        print("Carpeta o disco no válidos")
        return

    conn = sqlite3.connect("discos.db")
    cur = conn.cursor()

    for raiz, subdirs, archivos in os.walk(carpeta_inicial):
        for arch in archivos:
            ruta_completa = os.path.join(raiz, arch)
            try:
                tamanio = os.path.getsize(ruta_completa)
                creacion = datetime.fromtimestamp(os.path.getctime(ruta_completa)).isoformat(timespec="seconds")
                modificacion = datetime.fromtimestamp(os.path.getmtime(ruta_completa)).isoformat(timespec="seconds")

                cur.execute(
                    "INSERT INTO archivos (disco, ruta, archivo, tamanio, creacion, modificacion) VALUES (?,?,?,?,?,?)",
                    (nombre_disco, raiz, arch, str(tamanio), creacion, modificacion)
                )
            except Exception as e:
                # si algún archivo no se puede leer, lo saltamos
                continue

    conn.commit()
    conn.close()
    print("Proceso completado")


tk.Label(text="Indica el nombre de la carpeta a indexar").pack(padx = 20,pady = 20)
carpeta = tk.Entry()
carpeta.pack(padx = 20,pady = 20)

tk.Label(text="Indica el nombre del disco").pack(padx = 20,pady = 20)
disco = tk.Entry()
disco.pack(padx = 20,pady = 20)

tk.Button(text="Procesar",command = procesar).pack(padx = 20,pady = 20)

ventana.mainloop()
```

### aplicacion completa indexacion

```python
#!/usr/bin/env python3
import os
import sqlite3
from datetime import datetime
import tkinter as tk

# ttkbootstrap para mejorar el aspecto
import ttkbootstrap as tb
from ttkbootstrap.constants import *
from tkinter import ttk, messagebox, filedialog

DB_NAME = "discos.db"

# -------------------- utilidades --------------------
def asegurar_bd():
    conn = sqlite3.connect(DB_NAME)
    cur = conn.cursor()
    cur.execute("""
        CREATE TABLE IF NOT EXISTS archivos(
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            disco TEXT,
            ruta  TEXT,
            archivo TEXT,
            tamanio INTEGER,
            creacion TEXT,
            modificacion TEXT
        )
    """)
    # Índices útiles para acelerar búsquedas
    cur.execute("CREATE INDEX IF NOT EXISTS idx_archivos_archivo ON archivos(archivo)")
    cur.execute("CREATE INDEX IF NOT EXISTS idx_archivos_ruta ON archivos(ruta)")
    cur.execute("CREATE INDEX IF NOT EXISTS idx_archivos_disco ON archivos(disco)")
    conn.commit()
    conn.close()

def formato_tam(bytes_):
    try:
        bytes_ = int(bytes_)
    except:
        return str(bytes_)
    for unidad in ("B","KB","MB","GB","TB"):
        if bytes_ < 1024:
            return f"{bytes_:.0f} {unidad}" if unidad=="B" else f"{bytes_:.2f} {unidad}"
        bytes_ /= 1024
    return f"{bytes_:.2f} PB"

# -------------------- app --------------------
def main():
    asegurar_bd()

    # Ventana con tema (elige: flatly, darkly, lumen, vapor, etc.)
    root = tb.Window(themename="flatly")
    root.title("Indexador y Buscador de Archivos (SQLite + ttkbootstrap)")
    root.geometry("1100x650")

    # PanedWindow para dividir 50/50
    paned = ttk.PanedWindow(root, orient=HORIZONTAL)
    paned.pack(fill=BOTH, expand=True, padx=8, pady=8)

    # Frames izquierdo y derecho
    left = ttk.Frame(paned, padding=16)
    right = ttk.Frame(paned, padding=16)
    paned.add(left, weight=1)
    paned.add(right, weight=1)

    # -------------------- LADO IZQUIERDO (indexación) --------------------
    ttk.Label(left, text="Indica la carpeta a indexar", font=("Ubuntu", 11, "bold")).pack(anchor="w")

    carpeta_frame = ttk.Frame(left)
    carpeta_frame.pack(fill=X, pady=6)
    carpeta_var = tk.StringVar()
    carpeta_entry = ttk.Entry(carpeta_frame, textvariable=carpeta_var)
    carpeta_entry.pack(side=LEFT, fill=X, expand=True)
    def elegir_carpeta():
        path = filedialog.askdirectory()
        if path:
            carpeta_var.set(path)
    ttk.Button(carpeta_frame, text="Elegir…", command=elegir_carpeta, bootstyle=SECONDARY).pack(side=LEFT, padx=6)

    ttk.Label(left, text="Indica el nombre del disco", font=("Ubuntu", 11, "bold")).pack(anchor="w", pady=(10,0))
    disco_var = tk.StringVar()
    ttk.Entry(left, textvariable=disco_var).pack(fill=X, pady=6)

    estado_var = tk.StringVar(value="Listo.")
    barra = ttk.Label(left, textvariable=estado_var, bootstyle=INFO)
    barra.pack(fill=X, pady=(8,0))

    def procesar():
        carpeta_inicial = carpeta_var.get().strip()
        nombre_disco = disco_var.get().strip()

        if not carpeta_inicial or not os.path.isdir(carpeta_inicial) or not nombre_disco:
            messagebox.showwarning("Datos inválidos", "Carpeta o disco no válidos")
            return

        conn = sqlite3.connect(DB_NAME)
        cur = conn.cursor()

        total = 0
        saltados = 0
        estado_var.set("Indexando… esto puede tardar según la cantidad de archivos.")
        root.update_idletasks()

        for raiz, subdirs, archivos in os.walk(carpeta_inicial):
            for arch in archivos:
                ruta_completa = os.path.join(raiz, arch)
                try:
                    tamanio = os.path.getsize(ruta_completa)
                    creacion = datetime.fromtimestamp(os.path.getctime(ruta_completa)).isoformat(timespec="seconds")
                    modificacion = datetime.fromtimestamp(os.path.getmtime(ruta_completa)).isoformat(timespec="seconds")
                    cur.execute(
                        "INSERT INTO archivos (disco, ruta, archivo, tamanio, creacion, modificacion) VALUES (?,?,?,?,?,?)",
                        (nombre_disco, raiz, arch, int(tamanio), creacion, modificacion)
                    )
                    total += 1
                    if total % 1000 == 0:
                        conn.commit()
                        estado_var.set(f"Indexados {total:,}…")
                        root.update_idletasks()
                except Exception:
                    saltados += 1
                    continue

        conn.commit()
        conn.close()
        estado_var.set(f"Proceso completado. Indexados: {total:,}. Saltados: {saltados:,}.")
        messagebox.showinfo("Completado", f"Indexación finalizada.\nIndexados: {total:,}\nSaltados: {saltados:,}")

    ttk.Button(left, text="Procesar", command=procesar, bootstyle=SUCCESS).pack(pady=16, fill=X)

    # Separador estético
    ttk.Separator(left, orient=HORIZONTAL).pack(fill=X, pady=8)
    ttk.Label(left, text="Consejo: puedes indexar varios discos; luego búscalos por su nombre.",
              wraplength=420, bootstyle=SECONDARY).pack(anchor="w")

    # -------------------- LADO DERECHO (búsqueda + Treeview) --------------------
    top_right = ttk.Frame(right)
    top_right.pack(fill=X)

    ttk.Label(top_right, text="Buscar en SQLite", font=("Ubuntu", 11, "bold")).pack(anchor="w")

    search_row = ttk.Frame(top_right)
    search_row.pack(fill=X, pady=6)

    query_var = tk.StringVar()
    entry_buscar = ttk.Entry(search_row, textvariable=query_var)
    entry_buscar.pack(side=LEFT, fill=X, expand=True)

    def ejecutar_busqueda(event=None):
        q = query_var.get().strip()
        llenar_tree(q)

    ttk.Button(search_row, text="Buscar", command=ejecutar_busqueda, bootstyle=PRIMARY).pack(side=LEFT, padx=6)
    entry_buscar.bind("<Return>", ejecutar_busqueda)

    # Tree + Scrollbar
    cols = ("disco", "ruta", "archivo", "tamanio", "creacion", "modificacion")
    tree_frame = ttk.Frame(right)
    tree_frame.pack(fill=BOTH, expand=True, pady=(8,0))

    tree = ttk.Treeview(tree_frame, columns=cols, show="headings", height=18)
    vsb = ttk.Scrollbar(tree_frame, orient=VERTICAL, command=tree.yview)
    hsb = ttk.Scrollbar(tree_frame, orient=HORIZONTAL, command=tree.xview)
    tree.configure(yscrollcommand=vsb.set, xscrollcommand=hsb.set)

    tree.grid(row=0, column=0, sticky="nsew")
    vsb.grid(row=0, column=1, sticky="ns")
    hsb.grid(row=1, column=0, sticky="ew")
    tree_frame.rowconfigure(0, weight=1)
    tree_frame.columnconfigure(0, weight=1)

    # Encabezados y anchos
    tree.heading("disco", text="Disco")
    tree.heading("ruta", text="Ruta")
    tree.heading("archivo", text="Archivo")
    tree.heading("tamanio", text="Tamaño")
    tree.heading("creacion", text="Creación")
    tree.heading("modificacion", text="Modificación")

    tree.column("disco", width=100, anchor=W)
    tree.column("ruta", width=280, anchor=W)
    tree.column("archivo", width=220, anchor=W)
    tree.column("tamanio", width=100, anchor=E)
    tree.column("creacion", width=150, anchor=W)
    tree.column("modificacion", width=150, anchor=W)

    # estado derecha
    estado_busq = tk.StringVar(value="Sin resultados aún.")
    ttk.Label(right, textvariable=estado_busq, bootstyle=INFO).pack(fill=X, pady=(6,0))

    def limpiar_tree():
        for i in tree.get_children():
            tree.delete(i)

    def llenar_tree(q):
        limpiar_tree()
        conn = sqlite3.connect(DB_NAME)
        cur = conn.cursor()

        if q:
            like = f"%{q}%"
            cur.execute(
                """
                SELECT disco, ruta, archivo, CAST(tamanio AS INTEGER) AS tamanio, creacion, modificacion
                FROM archivos
                WHERE archivo LIKE ? OR ruta LIKE ? OR disco LIKE ?
                ORDER BY rowid DESC
                LIMIT 1000
                """,
                (like, like, like)
            )
        else:
            cur.execute(
                """
                SELECT disco, ruta, archivo, CAST(tamanio AS INTEGER) AS tamanio, creacion, modificacion
                FROM archivos
                ORDER BY rowid DESC
                LIMIT 1000
                """
            )

        filas = cur.fetchall()
        conn.close()

        for d, r, a, t, c, m in filas:
            tree.insert("", "end", values=(d, r, a, formato_tam(t), c, m))

        if q:
            estado_busq.set(f"{len(filas)} resultados para «{q}» (máx 1000).")
        else:
            estado_busq.set(f"Mostrando {len(filas)} últimos registros (máx 1000).")


    # Doble clic: copiar ruta completa al portapapeles (útil)
    def on_double_click(event):
        item = tree.selection()
        if not item:
            return
        vals = tree.item(item[0], "values")
        # vals: (disco, ruta, archivo, tamanio, creacion, modificacion)
        ruta_completa = os.path.join(vals[1], vals[2])
        root.clipboard_clear()
        root.clipboard_append(ruta_completa)
        messagebox.showinfo("Ruta copiada", ruta_completa)

    tree.bind("<Double-1>", on_double_click)

    # Carga inicial
    llenar_tree("")

    root.mainloop()

if __name__ == "__main__":
    main()
```

### mejoras ia

```python
#!/usr/bin/env python3
import os
import sqlite3
from datetime import datetime
import tkinter as tk

import ttkbootstrap as tb
from ttkbootstrap.constants import *
from tkinter import ttk, messagebox, filedialog

DB_NAME = "discos.db"

# -------------------- utilidades --------------------
def asegurar_bd():
    conn = sqlite3.connect(DB_NAME)
    cur = conn.cursor()
    cur.execute("""
        CREATE TABLE IF NOT EXISTS archivos(
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            disco TEXT,
            ruta  TEXT,
            archivo TEXT,
            tamanio INTEGER,
            creacion TEXT,
            modificacion TEXT
        )
    """)
    cur.execute("CREATE INDEX IF NOT EXISTS idx_archivos_archivo ON archivos(archivo)")
    cur.execute("CREATE INDEX IF NOT EXISTS idx_archivos_ruta ON archivos(ruta)")
    cur.execute("CREATE INDEX IF NOT EXISTS idx_archivos_disco ON archivos(disco)")
    conn.commit()
    conn.close()

def formato_tam(bytes_):
    try:
        bytes_ = int(bytes_)
    except:
        return str(bytes_)
    for unidad in ("B","KB","MB","GB","TB"):
        if bytes_ < 1024:
            return f"{bytes_:.0f} {unidad}" if unidad=="B" else f"{bytes_:.2f} {unidad}"
        bytes_ /= 1024
    return f"{bytes_:.2f} PB"

# -------------------- app --------------------
def main():
    asegurar_bd()

    root = tb.Window(themename="flatly")
    root.title("Indexador y Buscador de Archivos (SQLite + ttkbootstrap)")
    root.geometry("1250x700")

    paned = ttk.PanedWindow(root, orient=HORIZONTAL)
    paned.pack(fill=BOTH, expand=True, padx=8, pady=8)

    left = ttk.Frame(paned, padding=16)
    right = ttk.Frame(paned, padding=16)
    paned.add(left, weight=1)
    paned.add(right, weight=2)

    # -------------------- LADO IZQUIERDO (indexación) --------------------
    ttk.Label(left, text="Indica la carpeta a indexar", font=("Ubuntu", 11, "bold")).pack(anchor="w")

    carpeta_frame = ttk.Frame(left)
    carpeta_frame.pack(fill=X, pady=6)
    carpeta_var = tk.StringVar()
    carpeta_entry = ttk.Entry(carpeta_frame, textvariable=carpeta_var)
    carpeta_entry.pack(side=LEFT, fill=X, expand=True)
    def elegir_carpeta():
        path = filedialog.askdirectory()
        if path:
            carpeta_var.set(path)
    ttk.Button(carpeta_frame, text="Elegir…", command=elegir_carpeta, bootstyle=SECONDARY).pack(side=LEFT, padx=6)

    ttk.Label(left, text="Indica el nombre del disco", font=("Ubuntu", 11, "bold")).pack(anchor="w", pady=(10,0))
    disco_var = tk.StringVar()
    ttk.Entry(left, textvariable=disco_var).pack(fill=X, pady=6)

    estado_var = tk.StringVar(value="Listo.")
    barra = ttk.Label(left, textvariable=estado_var, bootstyle=INFO)
    barra.pack(fill=X, pady=(8,0))

    def procesar():
        carpeta_inicial = carpeta_var.get().strip()
        nombre_disco = disco_var.get().strip()

        if not carpeta_inicial or not os.path.isdir(carpeta_inicial) or not nombre_disco:
            messagebox.showwarning("Datos inválidos", "Carpeta o disco no válidos")
            return

        conn = sqlite3.connect(DB_NAME)
        cur = conn.cursor()

        total = 0
        saltados = 0
        estado_var.set("Indexando… esto puede tardar según la cantidad de archivos.")
        root.update_idletasks()

        for raiz, subdirs, archivos in os.walk(carpeta_inicial):
            for arch in archivos:
                ruta_completa = os.path.join(raiz, arch)
                try:
                    tamanio = os.path.getsize(ruta_completa)
                    creacion = datetime.fromtimestamp(os.path.getctime(ruta_completa)).isoformat(timespec="seconds")
                    modificacion = datetime.fromtimestamp(os.path.getmtime(ruta_completa)).isoformat(timespec="seconds")
                    cur.execute(
                        "INSERT INTO archivos (disco, ruta, archivo, tamanio, creacion, modificacion) VALUES (?,?,?,?,?,?)",
                        (nombre_disco, raiz, arch, int(tamanio), creacion, modificacion)
                    )
                    total += 1
                    if total % 1000 == 0:
                        conn.commit()
                        estado_var.set(f"Indexados {total:,}…")
                        root.update_idletasks()
                except Exception:
                    saltados += 1
                    continue

        conn.commit()
        conn.close()
        estado_var.set(f"Proceso completado. Indexados: {total:,}. Saltados: {saltados:,}.")
        messagebox.showinfo("Completado", f"Indexación finalizada.\nIndexados: {total:,}\nSaltados: {saltados:,}")

    ttk.Button(left, text="Procesar", command=procesar, bootstyle=SUCCESS).pack(pady=16, fill=X)
    ttk.Separator(left, orient=HORIZONTAL).pack(fill=X, pady=8)
    ttk.Label(left, text="Consejo: puedes indexar varios discos; luego búscalos por su nombre.",
              wraplength=420, bootstyle=SECONDARY).pack(anchor="w")

    # -------------------- LADO DERECHO (búsqueda + Treeview) --------------------
    ttk.Label(right, text="Buscar en SQLite", font=("Ubuntu", 11, "bold")).pack(anchor="w")

    # Estado búsqueda
    estado_busq = tk.StringVar(value="Sin resultados aún.")

    # --- Barra de filtros por columna (alineadas con el orden de columnas)
    filter_frame = ttk.Frame(right)
    filter_frame.pack(fill=X, pady=(8,4))

    # Definimos columnas (mismo orden en Treeview y filtros)
    cols = ("disco", "ruta", "archivo", "tamanio", "creacion", "modificacion")

    # Variables de filtro
    filtro_vars = {c: tk.StringVar() for c in cols}

    # grid headers (pequeño label sobre cada entry)
    labels = {
        "disco": "Disco",
        "ruta": "Ruta",
        "archivo": "Archivo",
        "tamanio": "Tamaño",
        "creacion": "Creación",
        "modificacion": "Modificación",
    }
    # creamos una cuadrícula con 6 columnas iguales
    for i, c in enumerate(cols):
        ttk.Label(filter_frame, text=labels[c]).grid(row=0, column=i, sticky="w", padx=4)
        ttk.Entry(filter_frame, textvariable=filtro_vars[c]).grid(row=1, column=i, sticky="ew", padx=4)
        filter_frame.columnconfigure(i, weight=1)

    # Botones Buscar/Limpiar a la derecha
    btns_frame = ttk.Frame(right)
    btns_frame.pack(fill=X, pady=(4,8))
    def limpiar_filtros():
        for v in filtro_vars.values():
            v.set("")
        llenar_tree()  # sin filtros

    def ejecutar_busqueda(event=None):
        llenar_tree()

    ttk.Button(btns_frame, text="Buscar", command=ejecutar_busqueda, bootstyle=PRIMARY).pack(side=RIGHT, padx=6)
    ttk.Button(btns_frame, text="Limpiar", command=limpiar_filtros, bootstyle=SECONDARY).pack(side=RIGHT)

    # --- Tree + Scrollbars
    tree_frame = ttk.Frame(right)
    tree_frame.pack(fill=BOTH, expand=True)

    tree = ttk.Treeview(tree_frame, columns=cols, show="headings", height=20)
    vsb = ttk.Scrollbar(tree_frame, orient=VERTICAL, command=tree.yview)
    hsb = ttk.Scrollbar(tree_frame, orient=HORIZONTAL, command=tree.xview)
    tree.configure(yscrollcommand=vsb.set, xscrollcommand=hsb.set)

    tree.grid(row=0, column=0, sticky="nsew")
    vsb.grid(row=0, column=1, sticky="ns")
    hsb.grid(row=1, column=0, sticky="ew")
    tree_frame.rowconfigure(0, weight=1)
    tree_frame.columnconfigure(0, weight=1)

    # Encabezados y anchos
    tree.heading("disco", text="Disco")
    tree.heading("ruta", text="Ruta")
    tree.heading("archivo", text="Archivo")
    tree.heading("tamanio", text="Tamaño")
    tree.heading("creacion", text="Creación")
    tree.heading("modificacion", text="Modificación")

    tree.column("disco", width=120, anchor=W)
    tree.column("ruta", width=360, anchor=W)
    tree.column("archivo", width=260, anchor=W)
    tree.column("tamanio", width=120, anchor=E)
    tree.column("creacion", width=160, anchor=W)
    tree.column("modificacion", width=160, anchor=W)

    # --- Estado visual
    ttk.Label(right, textvariable=estado_busq, bootstyle=INFO).pack(fill=X, pady=(6,0))

    # --- Ordenación por columnas (estado global)
    sort_col = tk.StringVar(value="rowid")   # por defecto
    sort_dir = tk.StringVar(value="DESC")    # DESC/ASC

    # Mapa de columnas Tree -> expresión SQL de ORDER BY
    # Para tamanio conviene cast numérico; fechas ISO ordenan bien lexicográficamente
    order_expr = {
        "disco": "disco",
        "ruta": "ruta",
        "archivo": "archivo",
        "tamanio": "CAST(tamanio AS INTEGER)",
        "creacion": "creacion",
        "modificacion": "modificacion",
        "rowid": "rowid"
    }

    # Asignar comando a cada encabezado
    def on_sort(col_clicked):
        current_col = sort_col.get()
        current_dir = sort_dir.get()
        if current_col == col_clicked:
            sort_dir.set("ASC" if current_dir == "DESC" else "DESC")
        else:
            sort_col.set(col_clicked)
            sort_dir.set("ASC")  # primera vez ascendente
        llenar_tree()

    for c in cols:
        tree.heading(c, text=labels[c], command=lambda cc=c: on_sort(cc))

    # --- utilidades tree
    def limpiar_tree():
        for i in tree.get_children():
            tree.delete(i)

    # Construye WHERE dinámico con LIKE para todos los filtros
    def construir_where_y_params():
        where = []
        params = []
        for c in cols:
            val = filtro_vars[c].get().strip()
            if val != "":
                where.append(f"{c} LIKE ?")
                params.append(f"%{val}%")
        where_clause = ("WHERE " + " AND ".join(where)) if where else ""
        return where_clause, params

    def llenar_tree():
        limpiar_tree()
        conn = sqlite3.connect(DB_NAME)
        cur = conn.cursor()

        where_clause, params = construir_where_y_params()
        order = order_expr.get(sort_col.get(), "rowid")
        direction = "ASC" if sort_dir.get() == "ASC" else "DESC"

        sql = f"""
            SELECT disco, ruta, archivo, tamanio, creacion, modificacion
            FROM archivos
            {where_clause}
            ORDER BY {order} {direction}
            LIMIT 1000
        """
        cur.execute(sql, params)
        filas = cur.fetchall()
        conn.close()

        for d, r, a, t, c, m in filas:
            tree.insert("", "end", values=(d, r, a, formato_tam(t), c, m))

        # Texto de estado
        filtros_activos = [f"{labels[c]}='{filtro_vars[c].get().strip()}'"
                           for c in cols if filtro_vars[c].get().strip() != ""]
        filtros_txt = " | ".join(filtros_activos) if filtros_activos else "sin filtros"
        estado_busq.set(
            f"{len(filas)} resultados ({filtros_txt}). Orden: {order} {direction}. Máx 1000."
        )

    # Doble clic: copiar ruta completa al portapapeles
    def on_double_click(event):
        item = tree.selection()
        if not item:
            return
        vals = tree.item(item[0], "values")
        ruta_completa = os.path.join(vals[1], vals[2])
        root.clipboard_clear()
        root.clipboard_append(ruta_completa)
        messagebox.showinfo("Ruta copiada", ruta_completa)

    tree.bind("<Double-1>", on_double_click)

    # Enter en cualquier filtro = buscar
    for c in cols:
        entry = filter_frame.grid_slaves(row=1, column=cols.index(c))[0]
        entry.bind("<Return>", lambda e: ejecutar_busqueda())

    # Carga inicial
    llenar_tree()

    root.mainloop()

if __name__ == "__main__":
    main()
```

<a id="creacion-de-controladores-de-eventos"></a>
## Creación de controladores de eventos

En el mundo digital, la interacción con los usuarios es fundamental para cualquier aplicación o sistema informático. La creación de controladores de eventos representa un paso crucial en este proceso, permitiendo que las aplicaciones respondan a acciones específicas realizadas por los usuarios, como clics de ratón, pulsaciones de teclado o cambios en el estado de una interfaz gráfica.

El concepto de controlador de eventos es sencillo pero poderoso. Es un mecanismo que permite asociar funciones o métodos con ciertas acciones dentro de la aplicación. Cada vez que ocurre un evento, como hacer clic en un botón, el sistema identifica cuál es el controlador asociado y ejecuta la función correspondiente.

La creación de controladores de eventos implica varios pasos. Primero, se debe definir la acción que desencadenará el evento. Esto puede ser algo tan simple como hacer clic en un botón o tan complejo como mover el cursor sobre una imagen. Luego, se necesita escribir la función que será ejecutada cuando ocurra este evento. Esta función puede realizar cualquier operación necesaria, desde actualizar los datos de una interfaz hasta enviar información a otro sistema.

La importancia de esta práctica radica en su capacidad para hacer que las aplicaciones sean interactivas y dinámicas. Sin controladores de eventos, las aplicaciones serían estáticas e ininteractivas, limitando significativamente su utilidad y experiencia del usuario. Por ejemplo, en una aplicación de gestión de tareas, el controlador de eventos asociado a un botón "Marcar como completada" permitiría que los usuarios cambien el estado de una tarea sin necesidad de recargar la página o navegar a otra sección.

Además, la creación de controladores de eventos es una práctica fundamental para el desarrollo orientado a objetos. En este paradigma, las clases pueden definir métodos que actúan como controladores de eventos, lo que permite una organización lógica y modular del código. Cada clase puede tener sus propios métodos que responden a eventos específicos, facilitando la mantenibilidad y escalabilidad del proyecto.

Es importante destacar que el proceso de creación de controladores de eventos no es siempre inmediato o intuitivo. Requiere una comprensión profunda de cómo funcionan los eventos en el contexto específico de la aplicación y las herramientas utilizadas para desarrollarla. Además, puede ser necesario manejar situaciones complejas, como eventos anidados o múltiples eventos asociados a un solo controlador.

En resumen, la creación de controladores de eventos es una habilidad esencial en el desarrollo de aplicaciones informáticas. Permite hacer que las interfaces sean interactivas y dinámicas, mejorando significativamente la experiencia del usuario. A través de este proceso, los desarrolladores pueden asociar acciones específicas con eventos, permitiendo que las aplicaciones respondan de manera eficiente a las interacciones del usuario, lo que es crucial para el éxito de cualquier proyecto informático.

### repaso mysql

```sql
sudo mysql -u root -p

SHOW DATABASES;

USE empresarial;

SHOW TABLES;
```

### conecto a mysql

```python
import mysql.connector

# Me conecto a la base de datos
conexion = mysql.connector.connect(
    host="localhost",
    user="usuarioempresarial",
    password="usuarioempresarial",
    database="empresarial"
)

# Creo un cursor
cursor = conexion.cursor()

# Ejecuto un select
cursor.execute("SELECT * FROM productos")

# Pinto el resultado en pantalla
for fila in cursor.fetchall():
    print(fila)

# Cierro la conexion
cursor.close()
conexion.close()
```

### examen de bases de datos

```sql
mysql -u root -p

SHOW DATABASES;

CREATE DATABASE blogexamen;

USE blogexamen;

CREATE TABLE `posts` (
  `Identificador` INT NOT NULL , 
  `titulo` VARCHAR(50) NOT NULL , 
  `fecha` VARCHAR(100) NOT NULL , 
  `contenido` VARCHAR(50) NOT NULL , 
  `autor` INT(255) NOT NULL 
) ENGINE = InnoDB;

SHOW TABLES;

DESCRIBE posts;

ALTER TABLE posts
  ADD PRIMARY KEY (`Identificador`);
  
ALTER TABLE posts
MODIFY COLUMN Identificador INT NOT NULL AUTO_INCREMENT;

DESCRIBE posts;
```

### tabla de autores

```sql
mysql -u root -p

SHOW DATABASES;

CREATE DATABASE blogexamen;

USE blogexamen;

CREATE TABLE `autores` (
  `Identificador` INT NOT NULL , 
  `nombre` VARCHAR(50) NOT NULL , 
  `apellidos` VARCHAR(100) NOT NULL , 
  `email` VARCHAR(50) NOT NULL 
) ENGINE = InnoDB;

SHOW TABLES;

DESCRIBE autores;

ALTER TABLE autores
  ADD PRIMARY KEY (`Identificador`);
  
ALTER TABLE autores
MODIFY COLUMN Identificador INT NOT NULL AUTO_INCREMENT;

DESCRIBE autores;
```

### autores

```sql
mysql -u root -p

SHOW DATABASES;

CREATE DATABASE blogexamen;

USE blogexamen;

CREATE TABLE `autores` (
  `Identificador` INT NOT NULL , 
  `nombre` VARCHAR(50) NOT NULL , 
  `apellidos` VARCHAR(100) NOT NULL , 
  `email` VARCHAR(50) NOT NULL 
) ENGINE = InnoDB;

SHOW TABLES;

DESCRIBE autores;

ALTER TABLE autores
  ADD PRIMARY KEY (`Identificador`);
  
ALTER TABLE autores
MODIFY COLUMN Identificador INT NOT NULL AUTO_INCREMENT;

DESCRIBE autores;
```

### enlazo las tablas

```sql
ALTER TABLE `posts` 
ADD CONSTRAINT `postsaautores` 
FOREIGN KEY (`autor`) 
REFERENCES `autores`(`Identificador`) 
ON DELETE RESTRICT ON UPDATE RESTRICT;
```

### inserto registros

```sql
INSERT INTO autores (Identificador, nombre, apellidos, email) VALUES
(1, 'Lucía', 'Fernández Lirio', 'lucia.fernandez@example.com'),
(2, 'Mateo', 'Ramos Villalba', 'mateo.ramos@example.com'),
(3, 'Sofía', 'Navarro Duque', 'sofia.navarro@example.com'),
(4, 'Daniel', 'Ibáñez Campos', 'daniel.ibanez@example.com'),
(5, 'Clara', 'Morales Requena', 'clara.morales@example.com'),
(6, 'Andrés', 'Serrano Vélez', 'andres.serrano@example.com'),
(7, 'Nora', 'Galindo Sáez', 'nora.galindo@example.com'),
(8, 'Diego', 'Lozano Ferrer', 'diego.lozano@example.com'),
(9, 'Irene', 'Hidalgo Cortés', 'irene.hidalgo@example.com'),
(10, 'Lucas', 'Pérez Caballero', 'lucas.perez@example.com'),
(11, 'Valeria', 'Ruiz Castelló', 'valeria.ruiz@example.com'),
(12, 'Hugo', 'Delgado Riera', 'hugo.delgado@example.com'),
(13, 'Emma', 'Vidal Soler', 'emma.vidal@example.com'),
(14, 'Leo', 'Torres Alcázar', 'leo.torres@example.com'),
(15, 'Marina', 'Ortega Pons', 'marina.ortega@example.com'),
(16, 'Bruno', 'Crespo Martí', 'bruno.crespo@example.com'),
(17, 'Aitana', 'Santos Aranda', 'aitana.santos@example.com'),
(18, 'Pablo', 'Navas Romero', 'pablo.navas@example.com'),
(19, 'Julia', 'Giménez Blasco', 'julia.gimenez@example.com'),
(20, 'Sergio', 'Beltrán Mora', 'sergio.beltran@example.com');

SELECT * FROM autores;
```

### inserto posts

```sql
INSERT INTO posts (Identificador, titulo, fecha, contenido, autor) VALUES
(1, 'El futuro de la inteligencia artificial', '2025-01-05', 'Una mirada al futuro de la IA.', 1),
(2, 'Redes neuronales explicadas', '2025-01-08', 'Cómo funcionan las redes neuronales.', 2),
(3, 'IA y creatividad artística', '2025-01-12', 'El papel de la IA en el arte moderno.', 3),
(4, 'Aprendizaje profundo simplificado', '2025-01-14', 'Conceptos básicos de deep learning.', 4),
(5, 'Chatbots y atención al cliente', '2025-01-16', 'Cómo los chatbots transforman empresas.', 5),
(6, 'Visión artificial en la medicina', '2025-01-20', 'Diagnósticos automáticos por IA.', 6),
(7, 'Modelos de lenguaje gigantes', '2025-01-23', 'Cómo funcionan los LLM como GPT.', 7),
(8, 'Ética en la inteligencia artificial', '2025-01-25', 'Los dilemas morales de la IA.', 8),
(9, 'Automatización del trabajo', '2025-01-27', 'Impacto de la IA en el empleo.', 9),
(10, 'IA y educación personalizada', '2025-01-30', 'Aprendizaje adaptativo con IA.', 10),
(11, 'Reconocimiento de voz avanzado', '2025-02-02', 'Sistemas de voz y su evolución.', 11),
(12, 'Generación de texto automática', '2025-02-04', 'El auge de los modelos generativos.', 12),
(13, 'Vehículos autónomos', '2025-02-06', 'Cómo la IA conduce sin humanos.', 13),
(14, 'Robótica emocional', '2025-02-08', 'Máquinas que entienden sentimientos.', 14),
(15, 'Machine learning en agricultura', '2025-02-10', 'Optimización de cultivos con IA.', 15),
(16, 'Procesamiento del lenguaje natural', '2025-02-12', 'Cómo las máquinas entienden texto.', 16),
(17, 'IA en ciberseguridad', '2025-02-15', 'Detección inteligente de amenazas.', 17),
(18, 'Algoritmos de recomendación', '2025-02-17', 'Cómo Netflix sabe qué quieres ver.', 18),
(19, 'Simulaciones con IA', '2025-02-19', 'Mundos virtuales impulsados por IA.', 19),
(20, 'IA y sostenibilidad', '2025-02-22', 'Tecnología verde con inteligencia.', 20),
(21, 'Modelos generativos visuales', '2025-02-25', 'Creación de imágenes por IA.', 1),
(22, 'El impacto social de la IA', '2025-02-27', 'Cómo cambia nuestras relaciones.', 2),
(23, 'IA en videojuegos', '2025-03-01', 'NPCs más realistas con IA.', 3),
(24, 'Automatización industrial', '2025-03-03', 'Robots inteligentes en fábricas.', 4),
(25, 'La IA en el mundo financiero', '2025-03-05', 'Predicciones económicas automáticas.', 5),
(26, 'Sistemas expertos modernos', '2025-03-07', 'De la lógica a la inteligencia.', 6),
(27, 'IA para análisis de datos', '2025-03-09', 'Descubriendo patrones ocultos.', 7),
(28, 'Redes neuronales convolucionales', '2025-03-11', 'Cómo ven las máquinas.', 8),
(29, 'Modelos híbridos IA-humanos', '2025-03-13', 'Colaboración entre mente y máquina.', 9),
(30, 'El papel del sesgo algorítmico', '2025-03-15', 'Cómo evitar prejuicios en la IA.', 10),
(31, 'IA aplicada al arte digital', '2025-03-17', 'Pinturas generadas por código.', 11),
(32, 'Modelos preentrenados', '2025-03-19', 'Por qué son tan poderosos.', 12),
(33, 'Aprendizaje no supervisado', '2025-03-21', 'Descubriendo patrones sin etiquetas.', 13),
(34, 'Optimización de hiperparámetros', '2025-03-23', 'Mejorando el rendimiento del modelo.', 14),
(35, 'IA en la salud mental', '2025-03-25', 'Asistentes empáticos digitales.', 15),
(36, 'Interfaces cerebro-máquina', '2025-03-27', 'Comunicación directa con IA.', 16),
(37, 'IA y realidad aumentada', '2025-03-29', 'Fusión del mundo físico y digital.', 17),
(38, 'Data labeling automático', '2025-03-31', 'Cómo entrenar sin etiquetar.', 18),
(39, 'Sistemas de IA explicables', '2025-04-02', 'Haciendo la IA comprensible.', 19),
(40, 'El auge del razonamiento simbólico', '2025-04-04', 'IA que entiende conceptos.', 20),
(41, 'IA distribuida en la nube', '2025-04-06', 'Escalabilidad y potencia.', 1),
(42, 'Reducción del consumo energético', '2025-04-08', 'IA más ecológica y eficiente.', 2),
(43, 'IA en marketing digital', '2025-04-10', 'Personalización extrema de campañas.', 3),
(44, 'Modelos multimodales', '2025-04-12', 'Texto, imagen y sonido unidos.', 4),
(45, 'Simulación del lenguaje humano', '2025-04-14', 'Hacia conversaciones naturales.', 5),
(46, 'IA en logística global', '2025-04-16', 'Rutas y entregas más inteligentes.', 6),
(47, 'Metaaprendizaje', '2025-04-18', 'Modelos que aprenden a aprender.', 7),
(48, 'IA para detección de fraudes', '2025-04-20', 'Protección de transacciones digitales.', 8),
(49, 'Redes generativas adversarias', '2025-04-22', 'La magia detrás de las GANs.', 9),
(50, 'El papel del humano en la era IA', '2025-04-24', 'Colaborar en vez de competir.', 10);

SELECT * FROM  posts;
```

### peticion cruzada entre tablas

```sql
SELECT
posts.titulo,
posts.fecha,
posts.contenido,
autores.nombre,
autores.apellidos 
FROM posts
LEFT JOIN autores
ON posts.autor = autores.Identificador;
```

### creacion de una vista

```sql
CREATE VIEW posts_completos AS 
SELECT
posts.titulo,
posts.fecha,
posts.contenido,
autores.nombre,
autores.apellidos 
FROM posts
LEFT JOIN autores
ON posts.autor = autores.Identificador;

SELECT * FROM posts_completos;
```

### simulacro examen programacion

```python
print("Gestión de posts")
print("v0.1 Jose Vicente Carratalá")
```

### bucle infinito

```python
print("Gestión de posts")
print("v0.1 Jose Vicente Carratalá")

while True:
  print("Escoge una opción:")
  print("1.-Crear entrada nueva")
  print("2.-Listar entradas")
  print("3.-Actualizar entrada")
  print("4.-Eliminar entradas")
  opcion = int(input("Escoge una opcion: "))
```

### controlar las opciones

```python
print("Gestión de posts")
print("v0.1 Jose Vicente Carratalá")

while True:
  print("Escoge una opción:")
  print("1.-Crear entrada nueva")
  print("2.-Listar entradas")
  print("3.-Actualizar entrada")
  print("4.-Eliminar entradas")
  opcion = int(input("Escoge una opcion: "))
  
  if opcion == 1:
    pass
  elif opcion == 2:
    pass
  elif opcion == 3:
    pass
  elif opcion == 4:
    pass
```

### insertamos elementos

```python
print("Gestión de posts")
print("v0.1 Jose Vicente Carratalá")

while True:
  print("Escoge una opción:")
  print("1.-Crear entrada nueva")
  print("2.-Listar entradas")
  print("3.-Actualizar entrada")
  print("4.-Eliminar entradas")
  opcion = int(input("Escoge una opcion: "))
  
  if opcion == 1:
    pass
  elif opcion == 2:
    pass
  elif opcion == 3:
    pass
  elif opcion == 4:
    pass
```

### insertamos en la base de datos

```python
import mysql.connector

# Me conecto a la base de datos
conexion = mysql.connector.connect(
    host="localhost",
    user="usuarioempresarial",
    password="usuarioempresarial",
    database="blogexamen"
)

cursor = conexion.cursor()

print("Gestión de posts")
print("v0.1 Jose Vicente Carratalá")

while True:
  print("Escoge una opción:")
  print("1.-Crear entrada nueva")
  print("2.-Listar entradas")
  print("3.-Actualizar entrada")
  print("4.-Eliminar entradas")
  opcion = int(input("Escoge una opcion: "))
  
  if opcion == 1:
    titulo = input("Introduce el titulo: ")
    fecha = input("Introduce la fecha: ")
    contenido = input("Introduce el contenido: ")
    autor = input("Introduce el id del autor: ")
    cursor.execute("INSERT INTO posts VALUES (NULL,'"+titulo+"','"+fecha+"','"+contenido+"',"+autor+");")
    conexion.commit()
  elif opcion == 2:
    pass
  elif opcion == 3:
    pass
  elif opcion == 4:
    pass
    
    
cursor.close()
conexion.close()
```

### usuario con permisos

```sql
CREATE USER 
'blogexamen'@'localhost' 
IDENTIFIED BY 'Blogexamen123$';

GRANT USAGE ON *.* TO 'blogexamen'@'localhost';

ALTER USER 'blogexamen'@'localhost' 
REQUIRE NONE 
WITH MAX_QUERIES_PER_HOUR 0 
MAX_CONNECTIONS_PER_HOUR 0 
MAX_UPDATES_PER_HOUR 0 
MAX_USER_CONNECTIONS 0;

GRANT ALL PRIVILEGES ON `blogexamen`.* 
TO 'blogexamen'@'localhost';
```

### insertamos de vuelta

```python
import mysql.connector

# Me conecto a la base de datos
conexion = mysql.connector.connect(
    host="localhost",
    user="blogexamen",
    password="Blogexamen123$",
    database="blogexamen"
)

cursor = conexion.cursor()

print("Gestión de posts")
print("v0.1 Jose Vicente Carratalá")

while True:
  print("Escoge una opción:")
  print("1.-Crear entrada nueva")
  print("2.-Listar entradas")
  print("3.-Actualizar entrada")
  print("4.-Eliminar entradas")
  opcion = int(input("Escoge una opcion: "))
  
  if opcion == 1:
    titulo = input("Introduce el titulo: ")
    fecha = input("Introduce la fecha: ")
    contenido = input("Introduce el contenido: ")
    autor = input("Introduce el id del autor: ")
    cursor.execute("INSERT INTO posts VALUES (NULL,'"+titulo+"','"+fecha+"','"+contenido+"',"+autor+");")
    conexion.commit()
  elif opcion == 2:
    pass
  elif opcion == 3:
    pass
  elif opcion == 4:
    pass
    
    
cursor.close()
conexion.close()
```

### listado de entradas

```python
import mysql.connector

# Me conecto a la base de datos
conexion = mysql.connector.connect(
    host="localhost",
    user="blogexamen",
    password="Blogexamen123$",
    database="blogexamen"
)

cursor = conexion.cursor()

print("Gestión de posts")
print("v0.1 Jose Vicente Carratalá")

while True:
  print("Escoge una opción:")
  print("1.-Crear entrada nueva")
  print("2.-Listar entradas")
  print("3.-Actualizar entrada")
  print("4.-Eliminar entradas")
  opcion = int(input("Escoge una opcion: "))
  
  if opcion == 1:
    titulo = input("Introduce el titulo: ")
    fecha = input("Introduce la fecha: ")
    contenido = input("Introduce el contenido: ")
    autor = input("Introduce el id del autor: ")
    cursor.execute("INSERT INTO posts VALUES (NULL,'"+titulo+"','"+fecha+"','"+contenido+"',"+autor+");")
    conexion.commit()
  elif opcion == 2:
    cursor.execute("SELECT * FROM posts;")
    filas = cursor.fetchall()
    for fila in filas:
      print(fila)
    pass
  elif opcion == 3:
    pass
  elif opcion == 4:
    pass
    
    
cursor.close()
conexion.close()
```

### actualizar

```python
import mysql.connector

# Me conecto a la base de datos
conexion = mysql.connector.connect(
    host="localhost",
    user="blogexamen",
    password="Blogexamen123$",
    database="blogexamen"
)

cursor = conexion.cursor()

print("Gestión de posts")
print("v0.1 Jose Vicente Carratalá")

while True:
  print("Escoge una opción:")
  print("1.-Crear entrada nueva")
  print("2.-Listar entradas")
  print("3.-Actualizar entrada")
  print("4.-Eliminar entradas")
  opcion = int(input("Escoge una opcion: "))
  
  if opcion == 1:
    titulo = input("Introduce el titulo: ")
    fecha = input("Introduce la fecha: ")
    contenido = input("Introduce el contenido: ")
    autor = input("Introduce el id del autor: ")
    cursor.execute("INSERT INTO posts VALUES (NULL,'"+titulo+"','"+fecha+"','"+contenido+"',"+autor+");")
    conexion.commit()
  elif opcion == 2:
    cursor.execute("SELECT * FROM posts;")
    filas = cursor.fetchall()
    for fila in filas:
      print(fila)
    pass
  elif opcion == 3:
    identificador = input("Introduce el id de la entrada a actualizar: ")
    titulo = input("Introduce el titulo: ")
    fecha = input("Introduce la fecha: ")
    contenido = input("Introduce el contenido: ")
    autor = input("Introduce el id del autor: ")
    cursor.execute("UPDATE posts SET titulo = '"+titulo+"', fecha = '"+fecha+"', contenido = '"+contenido+"', autor = "+autor+" WHERE Identificador = "+identificador+";")
    conexion.commit()
    pass
  elif opcion == 4:
    pass
    
    
cursor.close()
conexion.close()
```

### recuperar una tabla destrozada

```sql
TRUNCATE posts;

SELECT * FROM posts;

INSERT INTO posts (Identificador, titulo, fecha, contenido, autor) VALUES
(1, 'El futuro de la inteligencia artificial', '2025-01-05', 'Una mirada al futuro de la IA.', 1),
(2, 'Redes neuronales explicadas', '2025-01-08', 'Cómo funcionan las redes neuronales.', 2),
(3, 'IA y creatividad artística', '2025-01-12', 'El papel de la IA en el arte moderno.', 3),
(4, 'Aprendizaje profundo simplificado', '2025-01-14', 'Conceptos básicos de deep learning.', 4),
(5, 'Chatbots y atención al cliente', '2025-01-16', 'Cómo los chatbots transforman empresas.', 5),
(6, 'Visión artificial en la medicina', '2025-01-20', 'Diagnósticos automáticos por IA.', 6),
(7, 'Modelos de lenguaje gigantes', '2025-01-23', 'Cómo funcionan los LLM como GPT.', 7),
(8, 'Ética en la inteligencia artificial', '2025-01-25', 'Los dilemas morales de la IA.', 8),
(9, 'Automatización del trabajo', '2025-01-27', 'Impacto de la IA en el empleo.', 9),
(10, 'IA y educación personalizada', '2025-01-30', 'Aprendizaje adaptativo con IA.', 10),
(11, 'Reconocimiento de voz avanzado', '2025-02-02', 'Sistemas de voz y su evolución.', 11),
(12, 'Generación de texto automática', '2025-02-04', 'El auge de los modelos generativos.', 12),
(13, 'Vehículos autónomos', '2025-02-06', 'Cómo la IA conduce sin humanos.', 13),
(14, 'Robótica emocional', '2025-02-08', 'Máquinas que entienden sentimientos.', 14),
(15, 'Machine learning en agricultura', '2025-02-10', 'Optimización de cultivos con IA.', 15),
(16, 'Procesamiento del lenguaje natural', '2025-02-12', 'Cómo las máquinas entienden texto.', 16),
(17, 'IA en ciberseguridad', '2025-02-15', 'Detección inteligente de amenazas.', 17),
(18, 'Algoritmos de recomendación', '2025-02-17', 'Cómo Netflix sabe qué quieres ver.', 18),
(19, 'Simulaciones con IA', '2025-02-19', 'Mundos virtuales impulsados por IA.', 19),
(20, 'IA y sostenibilidad', '2025-02-22', 'Tecnología verde con inteligencia.', 20),
(21, 'Modelos generativos visuales', '2025-02-25', 'Creación de imágenes por IA.', 1),
(22, 'El impacto social de la IA', '2025-02-27', 'Cómo cambia nuestras relaciones.', 2),
(23, 'IA en videojuegos', '2025-03-01', 'NPCs más realistas con IA.', 3),
(24, 'Automatización industrial', '2025-03-03', 'Robots inteligentes en fábricas.', 4),
(25, 'La IA en el mundo financiero', '2025-03-05', 'Predicciones económicas automáticas.', 5),
(26, 'Sistemas expertos modernos', '2025-03-07', 'De la lógica a la inteligencia.', 6),
(27, 'IA para análisis de datos', '2025-03-09', 'Descubriendo patrones ocultos.', 7),
(28, 'Redes neuronales convolucionales', '2025-03-11', 'Cómo ven las máquinas.', 8),
(29, 'Modelos híbridos IA-humanos', '2025-03-13', 'Colaboración entre mente y máquina.', 9),
(30, 'El papel del sesgo algorítmico', '2025-03-15', 'Cómo evitar prejuicios en la IA.', 10),
(31, 'IA aplicada al arte digital', '2025-03-17', 'Pinturas generadas por código.', 11),
(32, 'Modelos preentrenados', '2025-03-19', 'Por qué son tan poderosos.', 12),
(33, 'Aprendizaje no supervisado', '2025-03-21', 'Descubriendo patrones sin etiquetas.', 13),
(34, 'Optimización de hiperparámetros', '2025-03-23', 'Mejorando el rendimiento del modelo.', 14),
(35, 'IA en la salud mental', '2025-03-25', 'Asistentes empáticos digitales.', 15),
(36, 'Interfaces cerebro-máquina', '2025-03-27', 'Comunicación directa con IA.', 16),
(37, 'IA y realidad aumentada', '2025-03-29', 'Fusión del mundo físico y digital.', 17),
(38, 'Data labeling automático', '2025-03-31', 'Cómo entrenar sin etiquetar.', 18),
(39, 'Sistemas de IA explicables', '2025-04-02', 'Haciendo la IA comprensible.', 19),
(40, 'El auge del razonamiento simbólico', '2025-04-04', 'IA que entiende conceptos.', 20),
(41, 'IA distribuida en la nube', '2025-04-06', 'Escalabilidad y potencia.', 1),
(42, 'Reducción del consumo energético', '2025-04-08', 'IA más ecológica y eficiente.', 2),
(43, 'IA en marketing digital', '2025-04-10', 'Personalización extrema de campañas.', 3),
(44, 'Modelos multimodales', '2025-04-12', 'Texto, imagen y sonido unidos.', 4),
(45, 'Simulación del lenguaje humano', '2025-04-14', 'Hacia conversaciones naturales.', 5),
(46, 'IA en logística global', '2025-04-16', 'Rutas y entregas más inteligentes.', 6),
(47, 'Metaaprendizaje', '2025-04-18', 'Modelos que aprenden a aprender.', 7),
(48, 'IA para detección de fraudes', '2025-04-20', 'Protección de transacciones digitales.', 8),
(49, 'Redes generativas adversarias', '2025-04-22', 'La magia detrás de las GANs.', 9),
(50, 'El papel del humano en la era IA', '2025-04-24', 'Colaborar en vez de competir.', 10);

SELECT * FROM  posts;
```

### opcion eliminar

```python
import mysql.connector

# Me conecto a la base de datos
conexion = mysql.connector.connect(
    host="localhost",
    user="blogexamen",
    password="Blogexamen123$",
    database="blogexamen"
)

cursor = conexion.cursor()

print("Gestión de posts")
print("v0.1 Jose Vicente Carratalá")

while True:
  print("Escoge una opción:")
  print("1.-Crear entrada nueva")
  print("2.-Listar entradas")
  print("3.-Actualizar entrada")
  print("4.-Eliminar entradas")
  opcion = int(input("Escoge una opcion: "))
  
  if opcion == 1:
    titulo = input("Introduce el titulo: ")
    fecha = input("Introduce la fecha: ")
    contenido = input("Introduce el contenido: ")
    autor = input("Introduce el id del autor: ")
    cursor.execute("INSERT INTO posts VALUES (NULL,'"+titulo+"','"+fecha+"','"+contenido+"',"+autor+");")
    conexion.commit()
  elif opcion == 2:
    cursor.execute("SELECT * FROM posts;")
    filas = cursor.fetchall()
    for fila in filas:
      print(fila)
    pass
  elif opcion == 3:
    identificador = input("Introduce el id de la entrada a actualizar: ")
    titulo = input("Introduce el titulo: ")
    fecha = input("Introduce la fecha: ")
    contenido = input("Introduce el contenido: ")
    autor = input("Introduce el id del autor: ")
    cursor.execute("UPDATE posts SET titulo = '"+titulo+"', fecha = '"+fecha+"', contenido = '"+contenido+"', autor = "+autor+" WHERE Identificador = "+identificador+";")
    conexion.commit()
    pass
  elif opcion == 4:
    identificador = input("Introduce el id de la entrada a eliminar: ")
    cursor.execute("DELETE FROM posts WHERE Identificador = "+identificador+";")
    conexion.commit()
    pass
    
    
cursor.close()
conexion.close()
```

### extraccion a funcion parte 1

```python
import mysql.connector

# Me conecto a la base de datos
conexion = mysql.connector.connect(
    host="localhost",
    user="blogexamen",
    password="Blogexamen123$",
    database="blogexamen"
)

cursor = conexion.cursor()

def bienvenida():
  print("Gestión de posts")
  print("v0.1 Jose Vicente Carratalá")

def menu():
  print("Escoge una opción:")
  print("1.-Crear entrada nueva")
  print("2.-Listar entradas")
  print("3.-Actualizar entrada")
  print("4.-Eliminar entradas")
  opcion = int(input("Escoge una opcion: "))

while True:
  
  
  if opcion == 1:
    titulo = input("Introduce el titulo: ")
    fecha = input("Introduce la fecha: ")
    contenido = input("Introduce el contenido: ")
    autor = input("Introduce el id del autor: ")
    cursor.execute("INSERT INTO posts VALUES (NULL,'"+titulo+"','"+fecha+"','"+contenido+"',"+autor+");")
    conexion.commit()
  elif opcion == 2:
    cursor.execute("SELECT * FROM posts;")
    filas = cursor.fetchall()
    for fila in filas:
      print(fila)
    pass
  elif opcion == 3:
    identificador = input("Introduce el id de la entrada a actualizar: ")
    titulo = input("Introduce el titulo: ")
    fecha = input("Introduce la fecha: ")
    contenido = input("Introduce el contenido: ")
    autor = input("Introduce el id del autor: ")
    cursor.execute("UPDATE posts SET titulo = '"+titulo+"', fecha = '"+fecha+"', contenido = '"+contenido+"', autor = "+autor+" WHERE Identificador = "+identificador+";")
    conexion.commit()
    pass
  elif opcion == 4:
    identificador = input("Introduce el id de la entrada a eliminar: ")
    cursor.execute("DELETE FROM posts WHERE Identificador = "+identificador+";")
    conexion.commit()
    pass
    
    
cursor.close()
conexion.close()
```

### no solo creo funciones sino que las uso

```python
import mysql.connector

# Me conecto a la base de datos
conexion = mysql.connector.connect(
    host="localhost",
    user="blogexamen",
    password="Blogexamen123$",
    database="blogexamen"
)

cursor = conexion.cursor()
######################################## FUNCIONES

def bienvenida():
  print("Gestión de posts")
  print("v0.1 Jose Vicente Carratalá")

def menu():
  print("Escoge una opción:")
  print("1.-Crear entrada nueva")
  print("2.-Listar entradas")
  print("3.-Actualizar entrada")
  print("4.-Eliminar entradas")
  opcion = int(input("Escoge una opcion: "))
  
######################################## FUNCIONES  

bienvenida()
while True:
  menu()
  
  if opcion == 1:
    titulo = input("Introduce el titulo: ")
    fecha = input("Introduce la fecha: ")
    contenido = input("Introduce el contenido: ")
    autor = input("Introduce el id del autor: ")
    cursor.execute("INSERT INTO posts VALUES (NULL,'"+titulo+"','"+fecha+"','"+contenido+"',"+autor+");")
    conexion.commit()
  elif opcion == 2:
    cursor.execute("SELECT * FROM posts;")
    filas = cursor.fetchall()
    for fila in filas:
      print(fila)
    pass
  elif opcion == 3:
    identificador = input("Introduce el id de la entrada a actualizar: ")
    titulo = input("Introduce el titulo: ")
    fecha = input("Introduce la fecha: ")
    contenido = input("Introduce el contenido: ")
    autor = input("Introduce el id del autor: ")
    cursor.execute("UPDATE posts SET titulo = '"+titulo+"', fecha = '"+fecha+"', contenido = '"+contenido+"', autor = "+autor+" WHERE Identificador = "+identificador+";")
    conexion.commit()
    pass
  elif opcion == 4:
    identificador = input("Introduce el id de la entrada a eliminar: ")
    cursor.execute("DELETE FROM posts WHERE Identificador = "+identificador+";")
    conexion.commit()
    pass
    
    
cursor.close()
conexion.close()
```

### funciones para las operaciones

```python
import mysql.connector

# Me conecto a la base de datos
conexion = mysql.connector.connect(
    host="localhost",
    user="blogexamen",
    password="Blogexamen123$",
    database="blogexamen"
)

cursor = conexion.cursor()
######################################## FUNCIONES

def bienvenida():
  print("Gestión de posts")
  print("v0.1 Jose Vicente Carratalá")

def menu():
  print("Escoge una opción:")
  print("1.-Crear entrada nueva")
  print("2.-Listar entradas")
  print("3.-Actualizar entrada")
  print("4.-Eliminar entradas")
  opcion = int(input("Escoge una opcion: "))

def insertar():
  titulo = input("Introduce el titulo: ")
  fecha = input("Introduce la fecha: ")
  contenido = input("Introduce el contenido: ")
  autor = input("Introduce el id del autor: ")
  cursor.execute("INSERT INTO posts VALUES (NULL,'"+titulo+"','"+fecha+"','"+contenido+"',"+autor+");")
  conexion.commit() 
  
def listar():
  cursor.execute("SELECT * FROM posts;")
  filas = cursor.fetchall()
  for fila in filas:
    print(fila)

def actualizar():
  identificador = input("Introduce el id de la entrada a actualizar: ")
  titulo = input("Introduce el titulo: ")
  fecha = input("Introduce la fecha: ")
  contenido = input("Introduce el contenido: ")
  autor = input("Introduce el id del autor: ")
  cursor.execute("UPDATE posts SET titulo = '"+titulo+"', fecha = '"+fecha+"', contenido = '"+contenido+"', autor = "+autor+" WHERE Identificador = "+identificador+";")
  conexion.commit()
  
def eliminar():
  identificador = input("Introduce el id de la entrada a eliminar: ")
  cursor.execute("DELETE FROM posts WHERE Identificador = "+identificador+";")
  conexion.commit()
######################################## FUNCIONES  

bienvenida()
while True:
  menu()
  
  if opcion == 1:
    
  elif opcion == 2:
    

  elif opcion == 3:
    
  elif opcion == 4:

    
    
cursor.close()
conexion.close()
```

### uso las funciones

```python
import mysql.connector

# Me conecto a la base de datos
conexion = mysql.connector.connect(
    host="localhost",
    user="blogexamen",
    password="Blogexamen123$",
    database="blogexamen"
)

cursor = conexion.cursor()
######################################## FUNCIONES

def bienvenida():
  print("Gestión de posts")
  print("v0.1 Jose Vicente Carratalá")

def menu():
  print("Escoge una opción:")
  print("1.-Crear entrada nueva")
  print("2.-Listar entradas")
  print("3.-Actualizar entrada")
  print("4.-Eliminar entradas")
  opcion = int(input("Escoge una opcion: "))

def insertar():
  titulo = input("Introduce el titulo: ")
  fecha = input("Introduce la fecha: ")
  contenido = input("Introduce el contenido: ")
  autor = input("Introduce el id del autor: ")
  cursor.execute("INSERT INTO posts VALUES (NULL,'"+titulo+"','"+fecha+"','"+contenido+"',"+autor+");")
  conexion.commit() 
  
def listar():
  cursor.execute("SELECT * FROM posts;")
  filas = cursor.fetchall()
  for fila in filas:
    print(fila)

def actualizar():
  identificador = input("Introduce el id de la entrada a actualizar: ")
  titulo = input("Introduce el titulo: ")
  fecha = input("Introduce la fecha: ")
  contenido = input("Introduce el contenido: ")
  autor = input("Introduce el id del autor: ")
  cursor.execute("UPDATE posts SET titulo = '"+titulo+"', fecha = '"+fecha+"', contenido = '"+contenido+"', autor = "+autor+" WHERE Identificador = "+identificador+";")
  conexion.commit()
  
def eliminar():
  identificador = input("Introduce el id de la entrada a eliminar: ")
  cursor.execute("DELETE FROM posts WHERE Identificador = "+identificador+";")
  conexion.commit()
######################################## FUNCIONES  

bienvenida()
while True:
  menu()
  
  if opcion == 1:
    insertar()
  elif opcion == 2:
    listar()
  elif opcion == 3:
    actualizar()
  elif opcion == 4:
    eliminar()
    
    
cursor.close()
conexion.close()
```

### vamos a documentar un poco

```python
'''
  Programa gestor de posts de blog
  v 0.1 por Jose Vicente Carratala
  Programa que hace CRUD sobre una base de datos de posts en MySQL
'''

import mysql.connector

# Me conecto a la base de datos
conexion = mysql.connector.connect(
    host="localhost",
    user="blogexamen",
    password="Blogexamen123$",
    database="blogexamen"
)

cursor = conexion.cursor()
######################################## FUNCIONES

def bienvenida():
  print("Gestión de posts")
  print("v0.1 Jose Vicente Carratalá")

def menu():
  print("Escoge una opción:")
  print("1.-Crear entrada nueva")
  print("2.-Listar entradas")
  print("3.-Actualizar entrada")
  print("4.-Eliminar entradas")
  opcion = int(input("Escoge una opcion: "))

def insertar():
  titulo = input("Introduce el titulo: ")
  fecha = input("Introduce la fecha: ")
  contenido = input("Introduce el contenido: ")
  autor = input("Introduce el id del autor: ")
  cursor.execute("INSERT INTO posts VALUES (NULL,'"+titulo+"','"+fecha+"','"+contenido+"',"+autor+");")
  conexion.commit() 
  
def listar():
  cursor.execute("SELECT * FROM posts;")
  filas = cursor.fetchall()
  for fila in filas:
    print(fila)

def actualizar():
  identificador = input("Introduce el id de la entrada a actualizar: ")
  titulo = input("Introduce el titulo: ")
  fecha = input("Introduce la fecha: ")
  contenido = input("Introduce el contenido: ")
  autor = input("Introduce el id del autor: ")
  cursor.execute("UPDATE posts SET titulo = '"+titulo+"', fecha = '"+fecha+"', contenido = '"+contenido+"', autor = "+autor+" WHERE Identificador = "+identificador+";")
  conexion.commit()
  
def eliminar():
  identificador = input("Introduce el id de la entrada a eliminar: ")
  cursor.execute("DELETE FROM posts WHERE Identificador = "+identificador+";")
  conexion.commit()
######################################## FUNCIONES  

bienvenida()
while True:
  menu()
  if opcion == 1:
    insertar()
  elif opcion == 2:
    listar()
  elif opcion == 3:
    actualizar()
  elif opcion == 4:
    eliminar()
    
    
cursor.close()
conexion.close()
```

### documento las funciones

```python
'''
  Programa gestor de posts de blog
  v 0.1 por Jose Vicente Carratala
  Programa que hace CRUD sobre una base de datos de posts en MySQL
'''

import mysql.connector

# Me conecto a la base de datos
conexion = mysql.connector.connect(
    host="localhost",
    user="blogexamen",
    password="Blogexamen123$",
    database="blogexamen"
)

cursor = conexion.cursor()
######################################## FUNCIONES

def bienvenida():
  # Imprime un mensaje de bienvenida una sola vez
  print("Gestión de posts")
  print("v0.1 Jose Vicente Carratalá")

def menu():
  # Ofrece una serie de opciones al usuario
  print("Escoge una opción:")
  print("1.-Crear entrada nueva")
  print("2.-Listar entradas")
  print("3.-Actualizar entrada")
  print("4.-Eliminar entradas")
  opcion = int(input("Escoge una opcion: "))

def insertar():
  # Inserta un registro en la base de datos
  titulo = input("Introduce el titulo: ")
  fecha = input("Introduce la fecha: ")
  contenido = input("Introduce el contenido: ")
  autor = input("Introduce el id del autor: ")
  cursor.execute("INSERT INTO posts VALUES (NULL,'"+titulo+"','"+fecha+"','"+contenido+"',"+autor+");")
  conexion.commit() 
  
def listar():
  # Lista los registros
  cursor.execute("SELECT * FROM posts;")
  filas = cursor.fetchall()
  for fila in filas:
    print(fila)

def actualizar():
  # actualiza un registro de la base de datos
  identificador = input("Introduce el id de la entrada a actualizar: ")
  titulo = input("Introduce el titulo: ")
  fecha = input("Introduce la fecha: ")
  contenido = input("Introduce el contenido: ")
  autor = input("Introduce el id del autor: ")
  cursor.execute("UPDATE posts SET titulo = '"+titulo+"', fecha = '"+fecha+"', contenido = '"+contenido+"', autor = "+autor+" WHERE Identificador = "+identificador+";")
  conexion.commit()
  
def eliminar():
  # Elimina un registro de la base de datos
  identificador = input("Introduce el id de la entrada a eliminar: ")
  cursor.execute("DELETE FROM posts WHERE Identificador = "+identificador+";")
  conexion.commit()
######################################## FUNCIONES  

bienvenida()
while True:
  menu()
  if opcion == 1:
    insertar()
  elif opcion == 2:
    listar()
  elif opcion == 3:
    actualizar()
  elif opcion == 4:
    eliminar()
    
    
cursor.close()
conexion.close()
```

### solucion al problema

```python
'''
  Programa gestor de posts de blog
  v 0.1 por Jose Vicente Carratala
  Programa que hace CRUD sobre una base de datos de posts en MySQL
'''

import mysql.connector

# Me conecto a la base de datos
conexion = mysql.connector.connect(
    host="localhost",
    user="blogexamen",
    password="Blogexamen123$",
    database="blogexamen"
)

cursor = conexion.cursor()
######################################## FUNCIONES

opcion = 0

def bienvenida():
  # Imprime un mensaje de bienvenida una sola vez
  print("Gestión de posts")
  print("v0.1 Jose Vicente Carratalá")

def menu():
  # Ofrece una serie de opciones al usuario
  global opcion
  print("Escoge una opción:")
  print("1.-Crear entrada nueva")
  print("2.-Listar entradas")
  print("3.-Actualizar entrada")
  print("4.-Eliminar entradas")
  opcion = int(input("Escoge una opcion: "))

def insertar():
  # Inserta un registro en la base de datos
  titulo = input("Introduce el titulo: ")
  fecha = input("Introduce la fecha: ")
  contenido = input("Introduce el contenido: ")
  autor = input("Introduce el id del autor: ")
  cursor.execute("INSERT INTO posts VALUES (NULL,'"+titulo+"','"+fecha+"','"+contenido+"',"+autor+");")
  conexion.commit() 
  
def listar():
  # Lista los registros
  cursor.execute("SELECT * FROM posts;")
  filas = cursor.fetchall()
  for fila in filas:
    print(fila)

def actualizar():
  # actualiza un registro de la base de datos
  identificador = input("Introduce el id de la entrada a actualizar: ")
  titulo = input("Introduce el titulo: ")
  fecha = input("Introduce la fecha: ")
  contenido = input("Introduce el contenido: ")
  autor = input("Introduce el id del autor: ")
  cursor.execute("UPDATE posts SET titulo = '"+titulo+"', fecha = '"+fecha+"', contenido = '"+contenido+"', autor = "+autor+" WHERE Identificador = "+identificador+";")
  conexion.commit()
  
def eliminar():
  # Elimina un registro de la base de datos
  identificador = input("Introduce el id de la entrada a eliminar: ")
  cursor.execute("DELETE FROM posts WHERE Identificador = "+identificador+";")
  conexion.commit()
######################################## FUNCIONES  

bienvenida()
while True:
  menu()
  if opcion == 1:
    insertar()
  elif opcion == 2:
    listar()
  elif opcion == 3:
    actualizar()
  elif opcion == 4:
    eliminar()
    
    
cursor.close()
conexion.close()
```

### simulacro blog

```html
<!doctype html>
<html>
  <head>
    <title>El blog de Jose Vicente</title>
    <style>
      body,html{background:grey;font-family:sans-serif;}
      header,main,footer{background:white;padding:50px;width:600px;margin:auto;}
    </style>  
  </head>
  <body>
    <header>
      <h1>El blog de Jose Vicente</h1>
    </header>
    <main>
      <article>
        <h3>Titulo</h3>
        <time>Fecha</time>
        <p>Autor</p>
        <p>Contenido</p>
      </article>
    </main>
    <footer>
      (c) 2025 Jose Vicente Carratala
    </footer>
  </body>
</html>
```

### arrancamos flask

```python
from flask import Flask  

aplicacion = Flask(__name__)

@aplicacion.route("/")
def raiz():

  return "Hola mundo"
  
if __name__ == "__main__":
  aplicacion.run()
```

### en flask ponemos nuestra web

```python
from flask import Flask  

aplicacion = Flask(__name__)

@aplicacion.route("/")
def raiz():
  cadena = '''
    <!doctype html>
    <html>
      <head>
        <title>El blog de Jose Vicente</title>
        <style>
          body,html{background:grey;font-family:sans-serif;}
          header,main,footer{background:white;padding:50px;width:600px;margin:auto;}
        </style>  
      </head>
      <body>
        <header>
          <h1>El blog de Jose Vicente</h1>
        </header>
        <main>
          <article>
            <h3>Titulo</h3>
            <time>Fecha</time>
            <p>Autor</p>
            <p>Contenido</p>
          </article>
        </main>
        <footer>
          (c) 2025 Jose Vicente Carratala
        </footer>
      </body>
    </html>
  '''
  return cadena
  
if __name__ == "__main__":
  aplicacion.run()
```

### me conecto con mysql

```python
from flask import Flask 
import mysql.connector

conexion = mysql.connector.connect(
    host="localhost",
    user="blogexamen",
    password="Blogexamen123$",
    database="blogexamen"
)

cursor = conexion.cursor() 

aplicacion = Flask(__name__)

@aplicacion.route("/")
def raiz():
  cadena = '''
    <!doctype html>
    <html>
      <head>
        <title>El blog de Jose Vicente</title>
        <style>
          body,html{background:grey;font-family:sans-serif;}
          header,main,footer{background:white;padding:50px;width:600px;margin:auto;}
        </style>  
      </head>
      <body>
        <header>
          <h1>El blog de Jose Vicente</h1>
        </header>
        <main>'''
  cursor.execute("SELECT * FROM posts_completos;")
  filas = cursor.fetchall()
  for fila in filas:
    cadena += '''
          <article>
            <h3>'''+fila[0]+'''</h3>
            <time>'''+fila[1]+'''</time>
            <p>'''+fila[3]+''' '''+fila[4]+'''</p>
            <p>'''+fila[2]+'''</p>
          </article>
    '''
  cadena += '''
        </main>
        <footer>
          (c) 2025 Jose Vicente Carratala
        </footer>
      </body>
    </html>
  '''
  return cadena
  
if __name__ == "__main__":
  aplicacion.run()
```

### mejoramos el estilo

```python
from flask import Flask 
import mysql.connector

conexion = mysql.connector.connect(
    host="localhost",
    user="blogexamen",
    password="Blogexamen123$",
    database="blogexamen"
)

cursor = conexion.cursor() 

aplicacion = Flask(__name__)

@aplicacion.route("/")
def raiz():
  cadena = '''
    <!doctype html>
    <html>
      <head>
        <title>El blog de Jose Vicente</title>
        <style>
          *{padding:0px;margin:0px;}
          body,html{background:grey;font-family:sans-serif;}
          header,main,footer{background:white;padding:50px;width:600px;margin:auto;}
          main{display:flex;flex-direction:column;gap:50px;}
        </style>  
      </head>
      <body>
        <header>
          <h1>El blog de Jose Vicente</h1>
        </header>
        <main>'''
  cursor.execute("SELECT * FROM posts_completos;")
  filas = cursor.fetchall()
  for fila in filas:
    cadena += '''
          <article>
            <h3>'''+fila[0]+'''</h3>
            <time>'''+fila[1]+'''</time>
            <p>'''+fila[3]+''' '''+fila[4]+'''</p>
            <p>'''+fila[2]+'''</p>
          </article>
    '''
  cadena += '''
        </main>
        <footer>
          (c) 2025 Jose Vicente Carratala
        </footer>
      </body>
    </html>
  '''
  return cadena
  
if __name__ == "__main__":
  aplicacion.run()
```

### articulos por fecha inversa

```python
from flask import Flask 
import mysql.connector

conexion = mysql.connector.connect(
    host="localhost",
    user="blogexamen",
    password="Blogexamen123$",
    database="blogexamen"
)

cursor = conexion.cursor() 

aplicacion = Flask(__name__)

@aplicacion.route("/")
def raiz():
  cadena = '''
    <!doctype html>
    <html>
      <head>
        <title>El blog de Jose Vicente</title>
        <style>
          *{padding:0px;margin:0px;}
          body,html{background:grey;font-family:sans-serif;}
          header,main,footer{background:white;padding:50px;width:600px;margin:auto;}
          main{display:flex;flex-direction:column;gap:50px;}
        </style>  
      </head>
      <body>
        <header>
          <h1>El blog de Jose Vicente</h1>
        </header>
        <main>'''
  cursor.execute("SELECT * FROM posts_completos ORDER BY fecha DESC;")
  filas = cursor.fetchall()
  for fila in filas:
    cadena += '''
          <article>
            <h3>'''+fila[0]+'''</h3>
            <time>'''+fila[1]+'''</time>
            <p>'''+fila[3]+''' '''+fila[4]+'''</p>
            <p>'''+fila[2]+'''</p>
          </article>
    '''
  cadena += '''
        </main>
        <footer>
          (c) 2025 Jose Vicente Carratala
        </footer>
      </body>
    </html>
  '''
  return cadena
  
if __name__ == "__main__":
  aplicacion.run()
```

<a id="simulacro-examen-programacion"></a>
## Simulacro examen programacion

<a id="simulacro-de-examen-2"></a>
## Simulacro de examen 2

### Enunciado

```markdown

Tal y como hemos comentado en clase, haz un programa en Python sobre la base de datos realizada en el examen de programación que:
1.-Imprima un mensaje de bienvenida
2.-Imprima una serie de opciones en pantalla (un menu CRUD)
3.-Acoja una opción por parte del usuario con input
4.-Saque la opción del usuario escogida por pantalla

-Utiliza la libreria MySQL para crear un nuevo objeto y conectarte a bases de datos
-Haz un select sobre una base de datos existente
-Saca los resultados por pantalla
-Haz este ejercicio como continuación del ejercicio de final de unidad de la unidad 1


Toma el resultado del ejercicio de final de unidad de la unidad 2
Toma el input que se ha creado al final del ejercicio de final de la unidad de unidad 1
Crea un bucle infinito mediante while True
Captura la opcion del usuario con if-elif
Atrapa los casos crear, listar, actualizar, eliminar

Toma el resultado del ejercicio final de unidad de la unidad 3
Para cada una de las 4 acciones posibles del menu, 
utiilza el lenguaje SQL para persistir los datos en la base de datos previamente creada, según el ejercicio de clase
```

### bienvenida

```python
print("Gestion de portafolio v0.1")
print("Escoge una opcion")
print("1.-Insertar")
print("2.-Listar")
print("3.-Actualizar")
print("4.-Eliminar")
opcion = int(input("Escoge una opcion: "))
print("La opción que has escogido es: ",opcion)
```

### me conecto a la base de datos

```python
import mysql.connector

conexion = mysql.connector.connect(
  host="localhost",
  user="portafolio",
  password="portafolio",
  database="portafolio"
)

print("Gestion de portafolio v0.1")
print("Escoge una opcion")
print("1.-Insertar")
print("2.-Listar")
print("3.-Actualizar")
print("4.-Eliminar")
opcion = int(input("Escoge una opcion: "))
print("La opción que has escogido es: ",opcion)

cursor = conexion.cursor() 
cursor.execute("SELECT * FROM piezas;")

lineas = cursor.fetchall()
for linea in lineas:
  print(linea)
```

### estructuras de control

```python
import mysql.connector

conexion = mysql.connector.connect(
  host="localhost",
  user="portafolio",
  password="portafolio",
  database="portafolio"
)

print("Gestion de portafolio v0.1")
while True:
  print("Escoge una opcion")
  print("1.-Insertar")
  print("2.-Listar")
  print("3.-Actualizar")
  print("4.-Eliminar")
  opcion = int(input("Escoge una opcion: "))
  print("La opción que has escogido es: ",opcion)

  cursor = conexion.cursor() 
  cursor.execute("SELECT * FROM piezas;")

  lineas = cursor.fetchall()
  for linea in lineas:
    print(linea)
```

### atrapo la opcion del usuario

```python
import mysql.connector

conexion = mysql.connector.connect(
  host="localhost",
  user="portafolio",
  password="portafolio",
  database="portafolio"
)

print("Gestion de portafolio v0.1")
while True:
  print("Escoge una opcion")
  print("1.-Insertar")
  print("2.-Listar")
  print("3.-Actualizar")
  print("4.-Eliminar")
  opcion = int(input("Escoge una opcion: "))
  print("La opción que has escogido es: ",opcion)
  if opcion == 1:
    pass
  elif opcion == 2:
    cursor = conexion.cursor() 
    cursor.execute("SELECT * FROM piezas;")
    lineas = cursor.fetchall()
    for linea in lineas:
      print(linea)
  elif opcion == 3:
    pass
  elif opcion == 4:
    pass
```

### desarrollo insertar

```python
import mysql.connector

conexion = mysql.connector.connect(
  host="localhost",
  user="portafolio",
  password="portafolio",
  database="portafolio"
)
cursor = conexion.cursor() 

print("Gestion de portafolio v0.1")
while True:
  print("Escoge una opcion")
  print("1.-Insertar")
  print("2.-Listar")
  print("3.-Actualizar")
  print("4.-Eliminar")
  opcion = int(input("Escoge una opcion: "))
  print("La opción que has escogido es: ",opcion)
  if opcion == 1:
    titulo = input("Introduce el titulo de la nueva pieza")
    descripcion = input("Introduce la descripcion de la nueva pieza")
    fecha = input("Introduce la fecha de la nueva pieza")
    imagen = input("Introduce el nombre de la imagen de la nueva pieza")
    cursor.execute("INSERT INTO piezas VALUES (NULL,'"+titulo+"','"+descripcion+"','"+fecha+"',1,'"+imagen+"');")
    conexion.commit()
  elif opcion == 2:
    cursor.execute("SELECT * FROM piezas;")
    lineas = cursor.fetchall()
    for linea in lineas:
      print(linea)
  elif opcion == 3:
    pass
  elif opcion == 4:
    pass
```

### desarrollamos eliminacion

```python
import mysql.connector

conexion = mysql.connector.connect(
  host="localhost",
  user="portafolio",
  password="portafolio",
  database="portafolio"
)
cursor = conexion.cursor() 

print("Gestion de portafolio v0.1")
while True:
  print("Escoge una opcion")
  print("1.-Insertar")
  print("2.-Listar")
  print("3.-Actualizar")
  print("4.-Eliminar")
  opcion = int(input("Escoge una opcion: "))
  print("La opción que has escogido es: ",opcion)
  if opcion == 1:
    titulo = input("Introduce el titulo de la nueva pieza: ")
    descripcion = input("Introduce la descripcion de la nueva pieza: ")
    fecha = input("Introduce la fecha de la nueva pieza: ")
    imagen = input("Introduce el nombre de la imagen de la nueva pieza: ")
    cursor.execute("INSERT INTO piezas VALUES (NULL,'"+titulo+"','"+descripcion+"','"+fecha+"',1,'"+imagen+"');")
    conexion.commit()
  elif opcion == 2:
    cursor.execute("SELECT * FROM piezas;")
    lineas = cursor.fetchall()
    for linea in lineas:
      print(linea)
  elif opcion == 3:
    pass
  elif opcion == 4:
    identificador = input("Introduce el Identificador a eliminar: ")
    cursor.execute("DELETE FROM piezas WHERE Identificador = "+identificador+";")
    conexion.commit()
```

### por ultimo actualizacion

```python
import mysql.connector

conexion = mysql.connector.connect(
  host="localhost",
  user="portafolio",
  password="portafolio",
  database="portafolio"
)
cursor = conexion.cursor() 

print("Gestion de portafolio v0.1")
while True:
  print("Escoge una opcion")
  print("1.-Insertar")
  print("2.-Listar")
  print("3.-Actualizar")
  print("4.-Eliminar")
  opcion = int(input("Escoge una opcion: "))
  print("La opción que has escogido es: ",opcion)
  if opcion == 1:
    titulo = input("Introduce el titulo de la nueva pieza: ")
    descripcion = input("Introduce la descripcion de la nueva pieza: ")
    fecha = input("Introduce la fecha de la nueva pieza: ")
    imagen = input("Introduce el nombre de la imagen de la nueva pieza: ")
    cursor.execute("INSERT INTO piezas VALUES (NULL,'"+titulo+"','"+descripcion+"','"+fecha+"',1,'"+imagen+"');")
    conexion.commit()
  elif opcion == 2:
    cursor.execute("SELECT * FROM piezas;")
    lineas = cursor.fetchall()
    for linea in lineas:
      print(linea)
  elif opcion == 3:
    identificador = input("Introduce el Identificador a actualizar: ")
    titulo = input("Introduce el titulo de la nueva pieza: ")
    descripcion = input("Introduce la descripcion de la nueva pieza: ")
    fecha = input("Introduce la fecha de la nueva pieza: ")
    imagen = input("Introduce el nombre de la imagen de la nueva pieza: ")
    cursor.execute('''
      UPDATE piezas 
      SET
      titulo = "'''+titulo+'''",
      descripcion = "'''+descripcion+'''",
      fecha = "'''+fecha+'''",
      imagen = "'''+imagen+'''"
      WHERE Identificador = '''+identificador+'''
    ''')
    conexion.commit()
  elif opcion == 4:
    identificador = input("Introduce el Identificador a eliminar: ")
    cursor.execute("DELETE FROM piezas WHERE Identificador = "+identificador+";")
    conexion.commit()
```

<a id="ejercicio-de-final-de-unidad-3"></a>
## Ejercicio de final de unidad

### actividad

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

<a id="carpeta-sin-titulo"></a>
## Carpeta sin título

En el vasto universo de la programación, una parte fundamental es la lectura y escritura de información, un proceso que permite a los programas interactuar con el mundo exterior. Esta carpeta del contenido nos guía a través de las técnicas y herramientas necesarias para manejar eficazmente estos flujos de datos.

Empezamos por entender los conceptos básicos de flujos de datos. En programación, un flujo es una secuencia de bytes que se mueven entre diferentes partes del sistema. Los flujos pueden ser de entrada (lectura) o salida (escritura), y son fundamentales para la interacción con dispositivos como archivos, dispositivos de red y dispositivos de entrada/salida.

La lectura de información es un proceso que implica abrir un flujo de entrada, leer los datos disponibles y luego cerrar el flujo. En programación, esto se realiza a través de clases y métodos específicos para manejar diferentes tipos de flujos. Por ejemplo, en Java, la clase `FileInputStream` se utiliza para leer bytes desde un archivo.

Por otro lado, la escritura de información es igualmente importante. Implica abrir un flujo de salida, escribir los datos deseados y luego cerrar el flujo. En Python, por ejemplo, la función `open()` con el modo 'w' (write) permite crear un nuevo archivo o truncar uno existente para escritura.

La manipulación de ficheros es una técnica poderosa que permite guardar y recuperar datos persistentemente. Los ficheros pueden ser de diferentes tipos: texto plano, binarios, XML, JSON, etc. Cada tipo tiene sus propias características y métodos de lectura y escritura específicos.

Además de los ficheros, las bases de datos también son un medio común para almacenar información persistente. La programación orientada a objetos permite interactuar con bases de datos mediante clases y objetos que representan tablas y registros. Herramientas como Hibernate en Java o Entity Framework en C# facilitan esta tarea, proporcionando métodos para insertar, actualizar y eliminar datos.

La lectura y escritura de información también se extiende a la manipulación de estructuras de datos complejas como matrices, listas y diccionarios. Estas estructuras permiten almacenar y recuperar grandes cantidades de datos de manera eficiente, utilizando métodos específicos para cada tipo.

La importancia de la lectura y escritura de información no se limita a los ficheros y las bases de datos. También es crucial en la comunicación entre aplicaciones, donde los datos se transmiten a través de sockets o interfaces web. En estos casos, el proceso de lectura y escritura se realiza a nivel de bytes, utilizando protocolos específicos para garantizar la integridad de los datos.

La optimización de la lectura y escritura es otro aspecto importante. Algunas técnicas incluyen el uso de buffers para reducir el número de operaciones de entrada/salida, la selección de algoritmos eficientes para la búsqueda y el ordenamiento de datos, y la gestión adecuada de los recursos.

Finalmente, la seguridad en la lectura y escritura de información es un tema crucial. Los programas deben implementar medidas para proteger los datos contra accesos no autorizados, modificaciones o pérdidas. Esto implica utilizar técnicas como el cifrado de datos, la autenticación de usuarios y la gestión adecuada de permisos.

En resumen, la lectura y escritura de información es una habilidad esencial en cualquier programa informático. Desde la manipulación de ficheros hasta la comunicación entre aplicaciones, este proceso permite a los programas interactuar con el mundo exterior y almacenar datos persistentemente. A través de técnicas eficientes y seguras, los programadores pueden crear sistemas que manejen grandes cantidades de información de manera efectiva y confiable.


<a id="aplicacion-de-las-estructuras-de-almacenamiento"></a>
# Aplicación de las estructuras de almacenamiento

<a id="estructuras-estaticas-y-dinamicas"></a>
## Estructuras estáticas y dinámicas

En el vasto y complejo mundo de la programación, las estructuras de almacenamiento desempeñan un papel fundamental como los pilares que sostienen una construcción. En esta subunidad didáctica, nos adentramos en el fascinante mundo de las estructuras estáticas y dinámicas, dos conceptos esenciales que permiten a los programadores organizar y manipular datos con eficiencia.

Las estructuras estáticas son como una casa construida con materiales fijos. Una vez que se ha definido su tamaño y forma, no puede cambiar. En la programación, esto significa que las estructuras estáticas tienen un tamaño fijo en memoria durante toda su vida útil. Son ideales para almacenar datos de tipos conocidos y fijos, como una lista de números enteros o una matriz de caracteres.

Por otro lado, las estructuras dinámicas son como una casa de Lego. Se pueden construir, modificar y cambiar a lo largo del tiempo. En la programación, esto significa que las estructuras dinámicas pueden crecer o disminuir en tamaño según sea necesario. Son ideales para almacenar datos de tipos variables o desconocidos, como una lista de cadenas de texto o un conjunto de objetos.

La elección entre usar estructuras estáticas y dinámicas depende del contexto específico del problema que se esté resolviendo. Las estructuras estáticas son más eficientes en términos de memoria y tiempo de ejecución, pero limitan la flexibilidad. Por otro lado, las estructuras dinámicas ofrecen mayor flexibilidad, pero pueden ser menos eficientes.

El concepto de estructura estática es fundamental para entender cómo se organizan los datos en la memoria del ordenador. Cada elemento de una estructura estática ocupa un espacio fijo y conocido en la memoria, lo que facilita el acceso y la manipulación de estos datos. Además, las estructuras estáticas pueden ser fácilmente iteradas y recorridas, lo que es útil para realizar operaciones como la búsqueda o la ordenación.

Por otro lado, las estructuras dinámicas son más complejas pero también más poderosas. Permiten el crecimiento y la disminución en tamaño durante la ejecución del programa, lo que significa que pueden adaptarse a situaciones cambiantes. Además, las estructuras dinámicas suelen ser más flexibles en cuanto al tipo de datos que pueden almacenar, ya que no están limitadas por un tamaño fijo.

La comprensión de estas diferencias es crucial para el diseño eficiente de programas. Al elegir la estructura adecuada, los programadores pueden optimizar el uso de memoria y mejorar el rendimiento del programa. Además, entender cómo funcionan las estructuras estáticas y dinámicas nos permite abordar problemas más complejos en el futuro.

En resumen, las estructuras estáticas y dinámicas son dos herramientas esenciales en la programación que permiten organizar y manipular datos de manera eficiente. Cada una tiene sus propias ventajas y desventajas, y su elección depende del contexto específico del problema que se esté resolviendo. A través de este estudio, hemos adquirido un nuevo nivel de comprensión sobre cómo funcionan estas estructuras fundamentales en la programación, lo que nos prepara para abordar problemas más complejos en el futuro.

### estructura dinamica lista

```python
agenda = [
  "Jaime",
  "Jorge",
  "Juan"
]

print(agenda)

agenda.append("Julia") # Le añado un elemento

print(agenda)
```

### eliminar elementos

```python
agenda = [
  "Jaime",
  "Jorge",
  "Juan"
]

print(agenda)

agenda.append("Julia") # Le añado un elemento

print(agenda)

agenda.pop() # Elimino un elemento del final

print(agenda)
```

### eliminar un elemento de donde quiera

```python
agenda = [
  "Jaime",
  "Jorge",
  "Juan"
]

print(agenda)

agenda.append("Julia") # Le añado un elemento

print(agenda)

agenda.pop() # Elimino un elemento del final

print(agenda)

agenda.pop(1)

print(agenda)
```

### tuplas

```python
coordenadas = (1,2,3)

print(coordenadas)
```

### intento añadir elemento

```python
coordenadas = (1,2,3)

print(coordenadas)

coordenadas.append(5)

print(coordenadas)
```

<a id="creacion-de-matrices-arrays"></a>
## Creación de matrices (arrays)

En el vasto y complejo mundo de la programación, las estructuras de almacenamiento desempeñan un papel fundamental como los pilares que sostienen una construcción. En esta subunidad didáctica, nos adentramos en el fascinante mundo de las matrices (arrays), una herramienta esencial para organizar y manipular datos de manera eficiente.

Las matrices son estructuras de datos bidimensionales que permiten almacenar un conjunto ordenado de elementos del mismo tipo. Imagina una tabla rectangular, donde cada celda contiene un valor específico. Esta organización permite acceder a cualquier elemento mediante dos índices: uno para la fila y otro para la columna. Este sistema de referencia es fundamental para realizar operaciones complejas sobre conjuntos de datos.

La creación de matrices es un concepto básico pero poderoso en programación. Para comenzar, debemos entender cómo declarar una matriz en nuestro código. En muchos lenguajes de programación, esto se realiza mediante la especificación del tipo de dato, el nombre de la matriz y su tamaño. Por ejemplo, en pseudocódigo, podríamos escribir algo como `int[][] miMatriz = new int[3][4];`, lo que crea una matriz de enteros con 3 filas y 4 columnas.

Una vez declarada, podemos inicializar los valores de la matriz utilizando bucles anidados. Cada iteración del bucle exterior corresponde a una fila, mientras que el bucle interior maneja las columnas. Este proceso es crucial para llenar la matriz con los datos deseados y prepararla para su uso en operaciones posteriores.

Las matrices también pueden ser utilizadas para representar tableros de juegos, gráficos bidimensionales o incluso sistemas de coordenadas. Su capacidad para almacenar múltiples valores en una sola estructura hace que sean ideales para resolver problemas que implican la manipulación de conjuntos de datos relacionados.

Además de su uso directo en el código, las matrices también son fundamentales en algoritmos y estructuras de datos más complejas. Por ejemplo, muchas operaciones matemáticas y científicas requieren la manipulación de matrices para realizar cálculos eficientes. En estos casos, las matrices se convierten en herramientas esenciales para el análisis y procesamiento de información.

La creación de matrices también implica comprender los conceptos de índices y dimensiones. Los índices son fundamentales para acceder a elementos específicos dentro de la matriz, mientras que las dimensiones indican cuántas filas y columnas contiene. Estos conceptos deben ser bien dominados para evitar errores comunes como el acceso fuera de rango o la confusión entre los índices.

En resumen, la creación de matrices es un tema fundamental en programación que nos permite organizar y manipular datos de manera eficiente. A través de esta estructura, podemos resolver problemas complejos y realizar operaciones matemáticas y científicas con mayor facilidad. Su dominio es esencial para cualquier desarrollador que quiera trabajar con conjuntos de datos relacionados o realizar cálculos avanzados en su código.

### arrays

```html
<script>
  var agenda = [
    "Juan",
    "Jorge",
    "Julia"
  ];
  console.log(agenda);
</script>
```

### empujar un elemento en un array

```html
<script>
  var agenda = [
    "Juan",
    "Jorge",
    "Julia"
  ];
  console.log(agenda);
  agenda.push("Jaime");
  console.log(agenda);
</script>
```

### quitar un elemento del array

```html
<script>
  var agenda = [
    "Juan",
    "Jorge",
    "Julia"
  ];
  console.log(agenda);
  agenda.push("Jaime");
  console.log(agenda);
  agenda.splice(3)
  console.log(agenda);
</script>
```

### recorrer lista en python

```python
personas = [
  "Jaime",
  "Julia",
  "Jorge",
  "Juan"
]

for persona in personas:
  print(persona)
  
```

### recorrer array en Javascript

```html
<script>
  var personas = [
    "Juan",
    "Jorge",
    "Julia"
  ];
  personas.forEach(function(persona){
    console.log(persona)
  })
</script>
```

### recorrer propiedades de objeto

```python
mis_datos = {
  "nombre":"Jose Vicente",
  "apellidos":"Carratala Sanchis",
  "email":"info@jocarsa.com"
}

for clave in mis_datos:
  print(clave)
  print(mis_datos[clave])
```

### recorrer objeto en javascript

```html
<script>
  var mis_datos = {
    "nombre":"Jose Vicente",
    "apellidos":"Carratala Sanchis",
    "email":"info@jocarsa.com"
  }
  Object.entries(mis_datos).forEach(function([clave, valor]){
    console.log(clave + ": " + valor)
  })
</script>
```

<a id="matrices-arrays-multidimensionales"></a>
## Matrices (arrays) multidimensionales

Continuando con nuestra exploración del mundo de la programación, nos dirijimos a una subunidad crucial: la aplicación de las estructuras de almacenamiento. En esta sección, nos centraremos específicamente en las matrices (arrays) multidimensionales, un concepto fundamental que permite organizar y manejar datos de manera eficiente.

Las matrices multidimensionales son una extensión natural de los arrays unidimensionales, permitiendo almacenar datos en múltiples dimensiones. En lugar de tener solo filas o columnas, las matrices multidimensionales nos ofrecen la posibilidad de crear estructuras más complejas y ricas en información.

Para ilustrar su uso, consideremos una matriz bidimensional que representa una tabla de ventas. Cada fila podría representar un producto, mientras que cada columna podría representar diferentes meses del año. De esta manera, podemos almacenar fácilmente la cantidad vendida de cada producto durante cada mes, facilitando el análisis y la visualización de los datos.

La manipulación de matrices multidimensionales implica acceso a sus elementos mediante índices. En Python, por ejemplo, si tenemos una matriz bidimensional `ventas`, podemos acceder al valor de ventas del producto 3 en el mes 2 con la siguiente sintaxis: `ventas[2][1]`. Es importante recordar que los índices comienzan desde cero, lo que significa que el primer elemento está en la posición 0.

Además de las matrices bidimensionales, existen estructuras multidimensionales más complejas. Por ejemplo, una matriz tridimensional podría representar datos spaciales o temporales, donde cada dimensión representa un eje diferente. En este caso, podríamos tener una matriz que almacene temperaturas en diferentes ciudades a lo largo de los años.

La programación multidimensional no se limita a la manipulación de datos estáticos. También es común trabajar con matrices dinámicas, donde el tamaño puede cambiar durante la ejecución del programa. En estos casos, es crucial tener cuidado al manejar los índices y asegurarse de que siempre estén dentro del rango válido.

La eficiencia en la manipulación de matrices multidimensionales es un aspecto importante a considerar. Algunas operaciones pueden ser computacionalmente intensivas, lo que requiere una optimización cuidadosa para evitar problemas de rendimiento. Herramientas como NumPy en Python proporcionan funciones y métodos eficientes para trabajar con grandes conjuntos de datos multidimensionales.

En conclusión, las matrices multidimensionales son una herramienta poderosa en el arsenal del programador. Permiten organizar y manipular datos de manera estructurada, facilitando la realización de análisis complejos y la visualización de información. A medida que avanzamos en nuestro estudio de la programación, es crucial familiarizarnos con estas estructuras y aprender a utilizarlas eficazmente en nuestros proyectos.

### agenda multidimensional

```python
agenda = []

agenda.append(["Jose Vicente","Carratala","info@jocarsa.com"])

agenda.append(["Ana","García","ana.garcia@example.com"]);
agenda.append(["Luis","Martínez","luis.martinez@example.com"]);
agenda.append(["María","López","maria.lopez@example.com"]);
agenda.append(["Carlos","Sánchez","carlos.sanchez@example.com"]);
agenda.append(["Elena","Ruiz","elena.ruiz@example.com"]);
agenda.append(["Javier","Pérez","javier.perez@example.com"]);
agenda.append(["Laura","Gómez","laura.gomez@example.com"]);
agenda.append(["Sergio","Navarro","sergio.navarro@example.com"]);
agenda.append(["Patricia","Ramírez","patricia.ramirez@example.com"]);
agenda.append(["David","Moreno","david.moreno@example.com"]);

print(agenda)
```

<a id="genericidad"></a>
## Genericidad

En el vasto mundo de la programación, una estructura de almacenamiento es como el esqueleto de un edificio; proporciona la base sobre la cual se construyen las aplicaciones. En esta subunidad didáctica, nos adentramos en el concepto fundamental de genericidad, que es una herramienta poderosa para mejorar la flexibilidad y reutilización del código.

La genericidad permite definir clases y métodos que pueden trabajar con diferentes tipos de datos sin necesidad de especificar estos tipos de antemano. Esta característica es especialmente valiosa en el desarrollo de bibliotecas y frameworks, donde se requiere una amplia gama de operaciones que puedan aplicarse a diversos tipos de objetos.

Comenzamos por entender cómo funciona la genericidad en Java, un lenguaje conocido por su soporte robusto para este concepto. A través del uso de parámetros de tipo genéricos, podemos crear clases y métodos que son independientes del tipo específico de datos con los que operan. Por ejemplo, una lista genérica puede almacenar cualquier tipo de objeto, desde cadenas hasta números enteros.

La ventaja de la genericidad radica en su capacidad para reducir el código repetitivo y mejorar la seguridad tipológica. Al definir clases y métodos genéricos, evitamos errores comunes como la conversión de tipos (ClassCastException) que pueden surgir cuando se trabaja con objetos de diferentes tipos.

Además, la genericidad facilita la creación de interfaces y clases más abstractas, permitiendo una mayor modularidad en el diseño de aplicaciones. Esto no solo hace que el código sea más fácil de mantener y escalar, sino que también promueve un mejor entendimiento del funcionamiento interno de las bibliotecas y frameworks.

En este contexto, es crucial entender cómo implementar la genericidad en diferentes situaciones. Por ejemplo, cuando se trabaja con colecciones como listas o conjuntos, el uso de tipos genéricos puede evitar problemas comunes relacionados con la pérdida de tipo (type erasure) que ocurre en Java.

La aplicabilidad de la genericidad no se limita a estructuras de datos; también es fundamental para la creación de métodos y funciones que pueden operar sobre cualquier tipo de dato. Esto incluye operaciones como comparaciones, filtrado y reducción, que son fundamentales en el procesamiento de grandes conjuntos de datos.

En resumen, la genericidad es una herramienta esencial en la programación moderna. Permite crear código más flexible, seguro y reusable, lo que a su vez facilita el desarrollo de aplicaciones complejas y escalables. A través de este concepto, los desarrolladores pueden abordar problemas de manera más eficiente, aprovechando al máximo las capacidades del lenguaje y las bibliotecas disponibles.

La comprensión y aplicación correcta de la genericidad son habilidades cruciales para cualquier programador que quiera escribir código limpio, mantenible y escalable. En esta subunidad didáctica, hemos explorado los fundamentos de este concepto y su importancia en el desarrollo de aplicaciones modernas. A medida que avanzamos en nuestro estudio de la programación, es importante mantenerse al tanto de estas técnicas avanzadas para mantenernos al día con las mejores prácticas del campo.

### servidor

```python
import mysql.connector
import json
from flask import Flask,render_template

aplicacion = Flask(__name__)

conexion = mysql.connector.connect(
  host="localhost",
  user="blog2526",
  password="blog2526",
  database="blog2526"
)

cursor = conexion.cursor(dictionary=True) 

@aplicacion.route("/api")
def api():
  cursor.execute("SHOW TABLES;")

  tablas = cursor.fetchall()
  documento = {}
  for tabla in tablas:
    
    # Select * FROM cada una de las tablas
    cursor.execute("SELECT * FROM "+tabla['Tables_in_blog2526']+";")
    registros = cursor.fetchall()
    documento[tabla['Tables_in_blog2526']] = registros

  documento_json = json.dumps(documento, indent=4, ensure_ascii=False)
  return documento_json
  
@aplicacion.route("/")
def raiz():
  return render_template("index.html")
  
if __name__ == "__main__":
  aplicacion.run()
```

<a id="cadenas-de-caracteres-expresiones-regulares"></a>
## Cadenas de caracteres. Expresiones regulares

En el vasto mundo de la programación, las cadenas de caracteres son una construcción fundamental que nos permite almacenar y manipular texto. Son como los bloques con los que construimos nuestras aplicaciones, ya sea para mostrar información al usuario o para procesar datos internos.

Las expresiones regulares, por otro lado, son un poderoso lenguaje que nos permite definir patrones complejos de búsqueda dentro de estas cadenas. Es como tener una llave mágica que puede abrir puertas a cualquier texto que cumpla con ciertas características específicas.

La combinación de cadenas y expresiones regulares es como tener un jardín de flores, donde cada flor tiene su propio color y forma. Cada cadena es una flor única, mientras que las expresiones regulares son los jardineros que saben cómo identificar y agrupar estas flores según sus características.

En esta subunidad didáctica, nos adentramos en el fascinante mundo de las cadenas de caracteres y las expresiones regulares. Aprenderemos a crear y manipular cadenas con eficacia, así como a usar expresiones regulares para buscar y extraer información de ellas. Es un viaje lleno de descubrimientos y aplicaciones prácticas.

Comenzaremos por entender los conceptos básicos de las cadenas de caracteres, desde cómo se declaran hasta cómo se manipulan. Aprenderemos sobre diferentes tipos de cadenas y cómo realizar operaciones comunes como concatenación, búsqueda y reemplazo.

Luego, nos sumergiremos en el poderoso mundo de las expresiones regulares. Aprenderemos a definir patrones complejos que pueden coincidir con cualquier texto que cumpla ciertas condiciones. Estudiarémos cómo usar operadores y funciones para crear expresiones regulares versátiles y eficientes.

A lo largo del camino, veremos ejemplos prácticos de cómo aplicar estas técnicas en situaciones reales. Desde la validación de entradas de usuario hasta el procesamiento de datos complejos, aprenderemos a utilizar cadenas y expresiones regulares para resolver problemas con ingenio y eficiencia.

Finalmente, reflexionaremos sobre las mejores prácticas al trabajar con cadenas y expresiones regulares. Aprenderemos cómo optimizar nuestras soluciones, cómo manejar posibles errores y cómo mantener nuestro código limpio y legible.

Este viaje a través del mundo de las cadenas de caracteres y las expresiones regulares nos prepara para enfrentar desafíos más complejos en el campo de la programación. Es una habilidad fundamental que nos permitirá crear aplicaciones robustas, seguras y eficientes.

### cadena

```python
cadena = "Jose Vicente"
print(cadena)
```

### imprimo un caracter

```python
cadena = "Jose Vicente"
print(cadena)

print(cadena[0])

longitud = len(cadena)
print(longitud)
```

### recorrer

```python
cadena = "Jose Vicente"
print(cadena)

print(cadena[0])

longitud = len(cadena)
print(longitud)

for letra in cadena:
  print(letra)
```

### de cadena a ascii

```python
letra = "a"
ascii = ord(letra)
print(letra,ascii)
```

### paso de ascii a caracter

```python
ascii = 97

letra = chr(ascii)

print(ascii,letra)
```

### codificar

```python
cadena = input("Introduce algo de texto: ")

# Recorro la cadena
nuevacadena = ""
for letra in cadena:
  ascii = ord(letra)
  ascii += 5
  nuevaletra = chr(ascii)
  nuevacadena += nuevaletra
  
print(nuevacadena)
```

### descodificar

```python
cadena = input("Introduce algo de texto: ")

# Recorro la cadena
nuevacadena = ""
for letra in cadena:
  ascii = ord(letra)
  ascii -= 5
  nuevaletra = chr(ascii)
  nuevacadena += nuevaletra
  
print(nuevacadena)
```

### clase codificar

```python
class Codificador():
  def codifica(self,cadena):
    nuevacadena = ""
    for letra in cadena:
      ascii = ord(letra)
      ascii += 5
      nuevaletra = chr(ascii)
      nuevacadena += nuevaletra
    return nuevacadena
  def descodifica(self,cadena):
    nuevacadena = ""
    for letra in cadena:
      ascii = ord(letra)
      ascii -= 5
      nuevaletra = chr(ascii)
      nuevacadena += nuevaletra
    return nuevacadena
    
original = "Jose Vicente"
codificador = Codificador()
codificado = codificador.codifica(original)
descodificado = codificador.descodifica(codificado)

print(original)
print(codificado)
print(descodificado)
```

<a id="colecciones-listas-conjuntos-y-diccionarios"></a>
## Colecciones Listas, Conjuntos y Diccionarios

En el vasto mundo de la programación, las estructuras de almacenamiento desempeñan un papel fundamental como los pilares que sostienen una construcción. En esta subunidad didáctica, nos adentramos en el fascinante universo de las colecciones, específicamente en las listas, conjuntos y diccionarios, elementos esenciales para organizar y manipular datos de manera eficiente.

Las listas son como cajas mágicas que pueden contener cualquier tipo de dato, desde números hasta cadenas de texto. Cada elemento dentro de una lista tiene un índice único, lo que facilita su acceso y modificación. Imagina una lista como una fila de personas en una fila de comidas; puedes agregar o eliminar personas fácilmente, y cada persona tiene un lugar específico.

Los conjuntos, por otro lado, son colecciones desordenadas de elementos únicos. Es como tener un grupo de amigos donde nadie se repite. Los conjuntos son ideales para operaciones que requieren la eliminación de duplicados o la verificación de la pertenencia a un conjunto específico.

Los diccionarios son estructuras aún más poderosas, ya que asocian claves con valores. Piensa en ellos como una librería donde cada libro tiene un título único y puedes acceder directamente a él sin necesidad de buscarlo por toda la biblioteca. Los diccionarios son excelentes para almacenar información compleja y recuperarla rápidamente.

La comprensión y uso eficiente de estas estructuras es crucial en cualquier proyecto de programación. No solo facilitan el manejo de grandes cantidades de datos, sino que también optimizan el rendimiento al permitir operaciones como la búsqueda, inserción y eliminación de elementos con una eficiencia notable.

Además, las colecciones ofrecen métodos útiles para manipular los datos almacenados. Por ejemplo, puedes ordenar una lista, combinar dos conjuntos o buscar un valor específico en un diccionario. Estos métodos son como herramientas mágicas que transforman tus datos de manera inteligente.

Es importante recordar que cada estructura tiene sus propias ventajas y desventajas dependiendo del contexto en el que se utilice. Por ejemplo, si necesitas mantener la ordenación de los elementos, una lista podría ser la mejor opción. Sin embargo, si solo necesitas verificar la pertenencia a un conjunto sin importar su orden, un conjunto sería más eficiente.

En resumen, las listas, conjuntos y diccionarios son herramientas poderosas en el arsenal del programador. Cada una tiene su propio propósito y es esencial dominarlas para abordar problemas complejos de manera efectiva. Al aprender a utilizar estas estructuras con inteligencia, podemos crear programas más eficientes, escalables y fáciles de mantener.

La comprensión profunda de las colecciones nos abre el camino hacia la creación de aplicaciones sofisticadas que puedan manejar grandes volúmenes de datos con gracia. Es una habilidad fundamental en cualquier campo relacionado con la programación, y su dominio es un paso crucial hacia la maestría del arte digital.

Así, al explorar las listas, conjuntos y diccionarios, nos encontramos con una puerta que nos lleva a un mundo de posibilidades infinitas. Cada estructura es como una llave que abre una caja mágica, permitiéndonos almacenar, recuperar y manipular datos de manera inteligente y eficiente. Y así, en el vasto universo de la programación, continuamos aprendiendo y creciendo con cada paso que damos.

### repaso

```python
lista = ['platano','manzana','fresa'] # mutable

tupla = ('platano','manzana','fresa') # inmutable
```

### agenda

```python
contacto = ["Jose Vicente","Carratala Sanchis","info@jocarsa.com",47]
```

### el dicionario es mejor

```python
contacto = ["Jose Vicente","Carratala Sanchis","info@jocarsa.com",47]

contacto_diccionario = {
  "nombre":"Jose Vicente",
  "apellidos":"Carratala Sanchis",
  "email":"info@jocarsa.com",
  "edad":47
}
```

### diferencias en el acceso

```python
contacto = ["Jose Vicente","Carratala Sanchis","info@jocarsa.com",47]

contacto_diccionario = {
  "nombre":"Jose Vicente",
  "apellidos":"Carratala Sanchis",
  "email":"info@jocarsa.com",
  "edad":47
}

nombre = contacto[0]
nombre = contacto_diccionario['nombre']
```

<a id="operaciones-agregadas-filtrado-reduccion-y-recoleccion"></a>
## Operaciones agregadas filtrado, reducción y recolección

En el vasto terreno de la programación, las estructuras de almacenamiento desempeñan un papel fundamental como los pilares que sostienen una construcción. En esta subunidad didáctica, nos adentramos en el fascinante mundo de las operaciones agregadas, filtrado, reducción y recolección, explorando cómo estas técnicas pueden transformar nuestros datos con eficiencia y precisión.

La primera de estas técnicas es la **operación agregada**, que permite realizar cálculos sobre un conjunto de datos para obtener un valor único. Imagina una gran pileta de números; las operaciones agregadas son como los luchadores de sumas, multiplicaciones, promedios y conteos que nos permiten reducir esta multitud a un solo número, revelando patrones y tendencias ocultos.

El **filtrado** es otro poderoso aliado en este viaje. Este proceso selecciona elementos del conjunto original basándose en ciertas condiciones, como si estuviéramos recogiendo las flores de un jardín que cumplen con determinados criterios. El filtrado nos permite concentrarnos en lo relevante y descartar el resto, simplificando así la información a nuestro alcance.

La **reducción** es una técnica que lleva aún más lejos la idea del filtrado. No solo selecciona elementos, sino que también combina o reduce estos elementos hasta obtener un único resultado. Es como si estuviéramos juntando cientos de libros en una sola caja, reduciendo así su volumen y facilitando su manejo.

Finalmente, la **recolección** es el proceso inverso a la creación de estructuras de almacenamiento. Nos permite organizar y recuperar los datos que hemos procesado, asegurándonos de que estén disponibles cuando las necesitemos. Es como recoger los juguetes después del juego para poder jugar nuevamente.

Estas técnicas son esenciales en la programación moderna, ya que nos permiten manejar grandes volúmenes de datos con eficiencia y precisión. Al combinarlas, podemos realizar tareas complejas como análisis de datos, inteligencia artificial y aprendizaje automático, transformando información raw en conocimiento valioso.

En esta subunidad, hemos explorado cómo estas operaciones pueden ser aplicadas en diferentes contextos, desde la manipulación de listas simples hasta el procesamiento de grandes conjuntos de datos. Cada una de ellas es un puente que nos lleva a nuevas posibilidades y descubrimientos, demostrando que con las estructuras de almacenamiento y las operaciones adecuadas, podemos hacer de los datos una herramienta poderosa para resolver problemas complejos.

Así, al adentrarnos en el mundo de las operaciones agregadas, filtrado, reducción y recolección, nos encontramos con un conjunto de habilidades que nos permiten transformar nuestros datos con eficiencia y precisión. Cada una de estas técnicas es un paso importante en nuestro viaje por la programación, demostrando que con el conocimiento adecuado, podemos hacer de los datos una herramienta poderosa para resolver problemas complejos y descubrir patrones ocultos en la información.

### lista de frutas

```python
frutas = ['manzana','pera','platano','manzana']
print(frutas)
```

### conjunto de frutas

```python
# Los conjuntos no tienen orden concreto (no tienen indices)
# Los conjuntos no admiten duplicados (los duplicados se eliminan automaticamente)

frutas = {'manzana','pera','platano','manzana'}
print(frutas)
```

### conjunto inicial

```python
import random
muestra = {1,2,3,4,5,6,7,8,9}

serie = []

for i in range(0,9):
  numero = random.randint(1,9)
  serie.append(numero)

filtrado = set(serie)
print(muestra)
print(filtrado)
print(serie)

if filtrado == muestra:
  print("Es igual")
else:
  print("No es igual")
```

### fuerza bruta

```python
import random
muestra = {1,2,3,4,5,6,7,8,9}

while True:
  serie = []

  for i in range(0,9):
    numero = random.randint(1,9)
    serie.append(numero)

  filtrado = set(serie)
  if filtrado == muestra:
    print("Es igual")
    break;
    
print(muestra)
print(filtrado)
print(serie)
```

### repetimos 9 veces

```python
import random
muestra = {1,2,3,4,5,6,7,8,9}

sudoku = []

for bloque in range(1,10):
  while True:
    serie = []
    for i in range(0,9):
      numero = random.randint(1,9)
      serie.append(numero)
    filtrado = set(serie)
    if filtrado == muestra:
      break;    
  sudoku.append(serie)
  
print(sudoku)
```

### lanzo esto con flask

```python
import random
from flask import Flask  

aplicacion = Flask(__name__)


@aplicacion.route("/api")
def api():
  muestra = {1,2,3,4,5,6,7,8,9}
  sudoku = []
  for bloque in range(1,10):
    while True:
      serie = []
      for i in range(0,9):
        numero = random.randint(1,9)
        serie.append(numero)
      filtrado = set(serie)
      if filtrado == muestra:
        break;    
    sudoku.append(serie)
    
  return str(sudoku)

if __name__ == "__main__":
  aplicacion.run()
```

### uso plantilla html

```python
import random
from flask import Flask,render_template

aplicacion = Flask(__name__)

@aplicacion.route("/")
def raiz():
  return render_template("index.html")

@aplicacion.route("/api")
def api():
  muestra = {1,2,3,4,5,6,7,8,9}
  sudoku = []
  for bloque in range(1,10):
    while True:
      serie = []
      for i in range(0,9):
        numero = random.randint(1,9)
        serie.append(numero)
      filtrado = set(serie)
      if filtrado == muestra:
        break;    
    sudoku.append(serie)
    
  return str(sudoku)

if __name__ == "__main__":
  aplicacion.run()
```

### me aseguro de que no se repita

```python
import random
from flask import Flask, render_template, jsonify

aplicacion = Flask(__name__)


def generar_sudoku():
    # grid[row][col]
    grid = [[0 for _ in range(9)] for _ in range(9)]

    def es_valido(fila, columna, numero):
        # Comprobar fila
        if numero in grid[fila]:
            return False

        # Comprobar columna
        for f in range(9):
            if grid[f][columna] == numero:
                return False

        # Comprobar subcuadrante 3x3
        inicio_fila = (fila // 3) * 3
        inicio_columna = (columna // 3) * 3
        for f in range(inicio_fila, inicio_fila + 3):
            for c in range(inicio_columna, inicio_columna + 3):
                if grid[f][c] == numero:
                    return False

        return True

    def resolver(celda=0):
        # Si hemos rellenado las 81 celdas, ya está completo
        if celda == 81:
            return True

        fila = celda // 9
        columna = celda % 9

        numeros = list(range(1, 10))
        random.shuffle(numeros)

        for n in numeros:
            if es_valido(fila, columna, n):
                grid[fila][columna] = n
                if resolver(celda + 1):
                    return True
                # backtracking
                grid[fila][columna] = 0

        return False

    resolver()
    return grid


@aplicacion.route("/")
def raiz():
    return render_template("index2.html")


@aplicacion.route("/api")
def api():
    # sudoku es una matriz 9x9 con números del 1 al 9
    sudoku = generar_sudoku()
    # devolvemos JSON para que respuesta.json() funcione
    return jsonify(sudoku)


if __name__ == "__main__":
    aplicacion.run(debug=True)
```

### diagrama

```html
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Diagrama exportado</title>
<style>
body {
  margin: 0;
  padding: 20px;
  background: #f3f3f7;
  font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
}
.page {
  position: relative;
  background: #ffffff;
  border: 1px solid #d1d5db;
  box-shadow: 0 2px 4px rgba(0,0,0,.1);
  width: 391.17897620567896px;
  height: 256.2215599646934px;
  overflow: visible;
}

/* formas básicas */
.shape {
  position: absolute;
  min-width: 120px;
  min-height: 40px;
  padding: 6px 10px;
  background: #ffffff;
  border-radius: 4px;
  border: 1px solid #9ca3af;
  box-shadow: 0 1px 2px rgba(0,0,0,0.15);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 13px;
}

.shape.rectangle {
  border-radius: 4px;
}

.shape.pill {
  border-radius: 999px;
}

.shape.circle {
  border-radius: 999px;
  width: 80px;
  height: 80px;
  padding: 0;
  justify-content: center;
}

/* base de datos */
.shape.db {
  min-width: 120px;
  min-height: 60px;
  padding-top: 20px;
  border-radius: 60px / 16px;
  background: linear-gradient(180deg, #e5e7eb 0%, #ffffff 40%, #e5e7eb 100%);
  position: absolute;
  overflow: hidden;
  text-align: center;
}
.shape.db::before {
  content: "";
  position: absolute;
  top: 0;
  left: 8px;
  right: 8px;
  height: 18px;
  border-radius: 999px;
  border: 1px solid #9ca3af;
  background: radial-gradient(circle at 50% 30%, #ffffff 0%, #e5e7eb 70%);
}
.shape.db::after {
  content: "";
  position: absolute;
  bottom: 0;
  left: 8px;
  right: 8px;
  height: 18px;
  border-radius: 999px;
  border: 1px solid rgba(156, 163, 175, 0.6);
  border-top: none;
  background: radial-gradient(circle at 50% 70%, #e5e7eb 0%, #d1d5db 70%);
}

/* entidades ER */
.shape.entity {
  width: 220px;
  min-height: 80px;
  background: #ffffff;
  border: 2px solid #111827;
  border-radius: 4px;
  box-shadow: 0 2px 4px rgba(0,0,0,.15);
  display: flex;
  flex-direction: column;
  font-size: 13px;
  overflow: hidden;
  padding: 0;
}
.entity-header {
  background: #f3f4f6;
  padding: 4px 8px;
  font-weight: 600;
  text-align: center;
  border-bottom: 1px solid #e5e7eb;
}
.entity-properties {
  flex: 1;
  padding: 4px 4px 0 4px;
}
.entity-property {
  display: grid;
  grid-template-columns: 14px 1fr 14px;
  align-items: center;
  column-gap: 4px;
  padding: 2px 0;
}
.entity-property .property-name {
  padding: 2px 4px;
  border-radius: 3px;
}

/* puertos */
.port {
  width: 9px;
  height: 9px;
  border-radius: 50%;
  border: 1px solid #111827;
  background: #ffffff;
}
.port-left { justify-self: start; }
.port-right { justify-self: end; }

/* flechas rectas */
.arrow {
  position: absolute;
  height: 2px;
  background: #111827;
  transform-origin: 0 50%;
}
.arrow::after {
  content: "";
  position: absolute;
  right: 0;
  top: 50%;
  transform: translateY(-50%);
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent;
  border-left: 8px solid #111827;
}
.arrow-double::before {
  content: "";
  position: absolute;
  left: 0;
  top: 50%;
  transform: translateY(-50%) rotate(180deg);
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent;
  border-left: 8px solid #111827;
}

/* flechas ortogonales */
.ortho-arrow {
  position: absolute;
  left: 0;
  top: 0;
}
.ortho-arrow .ortho-seg {
  position: absolute;
  background: #111827;
}
.ortho-seg.seg-horizontal { height: 2px; }
.ortho-seg.seg-vertical { width: 2px; }
.ortho-arrowhead {
  position: absolute;
  width: 0;
  height: 0;
}
.ortho-arrowhead.dir-right {
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent;
  border-left: 8px solid #111827;
}
.ortho-arrowhead.dir-left {
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent;
  border-right: 8px solid #111827;
}
.ortho-arrowhead.dir-down {
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-top: 8px solid #111827;
}
.ortho-arrowhead.dir-up {
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-bottom: 8px solid #111827;
}
</style>
</head>
<body>
<div class="page">

<div class="shape rectangle" style="left:140.07102379432092px;top:176.22159517728358px;width:119.99997652493984px;height:39.99996478740984px;">python</div>
<div class="shape rectangle" style="left:139.6874647874098px;top:136.10794067382807px;width:120.00002347506003px;height:39.99998532808742px;">flask</div>
<div class="shape rectangle" style="left:40px;top:40px;width:119.99997652493984px;height:39.99998532808742px;">index.html</div>
<div class="shape rectangle" style="left:231.1789527306189px;top:41.761357234074524px;width:120.00002347506003px;height:39.99998532808742px;">json(api)</div>
<div class="arrow" style="left:178.94258260704032px;top:136.10794067382807px;width:80.83981066301529px;transform:rotate(-2.374474533221754rad);"></div>
<div class="arrow" style="left:219.08223382269705px;top:136.10794067382807px;width:75.70370348306662px;transform:rotate(-0.8007603056930624rad);"></div>
<div class="arrow" style="left:231.1789527306189px;top:61.20856184152376px;width:71.18199704174366px;transform:rotate(-3.132379781778054rad);"></div>
</div>
</body>
</html>
```

### diagrama

```json
{
  "formas": [
    {
      "id": "forma-1",
      "tipo": "rectangle",
      "left": "520px",
      "top": "388.355px",
      "width": "",
      "height": "",
      "texto": "python"
    },
    {
      "id": "forma-2",
      "tipo": "rectangle",
      "left": "519.616px",
      "top": "348.253px",
      "width": "",
      "height": "",
      "texto": "flask"
    },
    {
      "id": "forma-3",
      "tipo": "rectangle",
      "left": "419.94px",
      "top": "252.144px",
      "width": "",
      "height": "",
      "texto": "index.html"
    },
    {
      "id": "forma-4",
      "tipo": "rectangle",
      "left": "611.11px",
      "top": "253.905px",
      "width": "",
      "height": "",
      "texto": "json(api)"
    }
  ],
  "flechas": [
    {
      "desde": {
        "shapeId": "forma-2",
        "propId": null,
        "side": null
      },
      "hasta": {
        "shapeId": "forma-3",
        "propId": null,
        "side": null
      },
      "tipo": "simple",
      "estilo": "straight"
    },
    {
      "desde": {
        "shapeId": "forma-2",
        "propId": null,
        "side": null
      },
      "hasta": {
        "shapeId": "forma-4",
        "propId": null,
        "side": null
      },
      "tipo": "simple",
      "estilo": "straight"
    },
    {
      "desde": {
        "shapeId": "forma-4",
        "propId": null,
        "side": null
      },
      "hasta": {
        "shapeId": "forma-3",
        "propId": null,
        "side": null
      },
      "tipo": "simple",
      "estilo": "straight"
    }
  ]
}
```

### diagrama

```
<svg xmlns="http://www.w3.org/2000/svg" width="391.17897620567896" height="256.2215599646934" viewBox="0 0 391.17897620567896 256.2215599646934">

  <defs>
    <style>
      text { font-family: system-ui, -apple-system, "Segoe UI", sans-serif; font-size: 12px; fill: #111827; }
      .shape-rect { fill: #ffffff; stroke: #9ca3af; stroke-width: 1; }
      .shape-entity { fill: #ffffff; stroke: #111827; stroke-width: 2; }
      .shape-circle { fill: #ffffff; stroke: #9ca3af; stroke-width: 1; }
      .shape-pill { fill: #ffffff; stroke: #9ca3af; stroke-width: 1; }
      .shape-db { fill: #ffffff; stroke: #9ca3af; stroke-width: 1; }
      .conn { stroke: #111827; stroke-width: 2; fill: none; }
    </style>
    <marker id="arrow-end" markerWidth="10" markerHeight="7" refX="10" refY="3.5"
            orient="auto" markerUnits="strokeWidth">
      <polygon points="0 0, 10 3.5, 0 7" fill="#111827"/>
    </marker>
    <marker id="arrow-start" markerWidth="10" markerHeight="7" refX="0" refY="3.5"
            orient="auto" markerUnits="strokeWidth">
      <polygon points="10 0, 0 3.5, 10 7" fill="#111827"/>
    </marker>
  </defs>
        
<rect class="shape-rect" x="140.07102379432092" y="176.22159517728358" width="119.99997652493984" height="39.99996478740984" rx="4" ry="4" />
<text x="200.07101205679083" y="200.2215775709885" text-anchor="middle">python</text>
<rect class="shape-rect" x="139.6874647874098" y="136.10794067382807" width="120.00002347506003" height="39.99998532808742" rx="4" ry="4" />
<text x="199.68747652493983" y="160.10793333787177" text-anchor="middle">flask</text>
<rect class="shape-rect" x="40" y="40" width="119.99997652493984" height="39.99998532808742" rx="4" ry="4" />
<text x="99.99998826246991" y="63.99999266404371" text-anchor="middle">index.html</text>
<rect class="shape-rect" x="231.1789527306189" y="41.761357234074524" width="120.00002347506003" height="39.99998532808742" rx="4" ry="4" />
<text x="291.17896446814893" y="65.76134989811823" text-anchor="middle">json(api)</text>
<path class="conn" d="M 178.94258260704032 136.10794067382807 L 120.74488218036942 79.9999853280874" marker-end="url(#arrow-end)" />
<path class="conn" d="M 219.08223382269705 136.10794067382807 L 271.7842071703917 81.76134256216193" marker-end="url(#arrow-end)" />
<path class="conn" d="M 231.1789527306189 61.20856184152376 L 159.99997652493983 60.552780504359305" marker-end="url(#arrow-end)" />
</svg>
```


<a id="utilizacion-avanzada-de-clases"></a>
# Utilización avanzada de clases

<a id="composicion-de-clases"></a>
## Composición de clases

La composición de clases es una técnica poderosa que permite modelar relaciones complejas entre objetos, creando estructuras más ricas y realistas. En este submódulo, profundizaremos en cómo esta práctica puede ser aplicada para mejorar la modularidad y el reutilización del código.

Comenzamos por entender qué es la composición de clases. Esta relación se caracteriza por un objeto que contiene otros objetos como partes de sí mismo. Por ejemplo, podríamos tener una clase `Coche` que compone varios objetos internos como `Motor`, `Ruedas`, `Chofer` y `Pasajeros`. Cada uno de estos componentes es una instancia de otra clase, y juntos forman un objeto más complejo.

La composición nos permite crear jerarquías de clases más elaboradas. Por ejemplo, podríamos tener una clase `Empresa` que compone varias clases internas como `Departamento`, `Equipo`, `Proyecto` y `Colaborador`. Cada uno de estos componentes puede a su vez contener otros objetos, creando una estructura anidada y detallada.

La composición también nos permite implementar la responsabilidad única. En lugar de que un objeto haga todo el trabajo por sí mismo, lo delegamos a sus componentes internos. Esto hace que nuestro código sea más limpio, más fácil de mantener y más fácil de probar.

Además, la composición nos permite crear objetos más flexibles y adaptados a las necesidades cambiantes. Si necesitamos cambiar el comportamiento de un componente interno, podemos hacerlo sin afectar el objeto que lo contiene. Esto es especialmente útil en aplicaciones empresariales donde los requisitos pueden variar rápidamente.

La composición también nos permite implementar la inyección de dependencias. En lugar de crear objetos internos dentro del constructor de un objeto, podemos inyectarlos desde fuera. Esto hace que nuestro código sea más testable y más fácil de mantener.

En resumen, la composición de clases es una técnica poderosa que nos permite modelar relaciones complejas entre objetos, creando estructuras más ricas y realistas. Permite implementar la responsabilidad única, crear objetos más flexibles y adaptados a las necesidades cambiantes, e implementar la inyección de dependencias. Es una práctica fundamental en el diseño de software orientado a objetos y es esencial para crear aplicaciones empresariales robustas y escalables.

<a id="herencia-y-polimorfismo"></a>
## Herencia y polimorfismo

La herencia y el polimorfismo son pilares fundamentales de la programación orientada a objetos (POO), ofreciendo soluciones elegantes para organizar y reutilizar código. En esta subunidad didáctica, nos adentramos en estos conceptos con profundidad, explorando cómo permiten crear jerarquías de clases y cómo facilitan el desarrollo de aplicaciones más complejas.

La herencia es un principio que permite a una clase derivada (o subclase) heredar atributos y métodos de una clase base (o superclase). Esta relación natural entre clases, similar a la existente en la vida real, nos permite crear estructuras de datos más sofisticadas. Por ejemplo, si tenemos una clase `Animal` con propiedades comunes como `nombre` y `edad`, podemos derivar clases específicas como `Perro` y `Gato`, que heredan estas características pero también pueden añadir propiedades únicas.

El polimorfismo, por otro lado, se refiere a la capacidad de un objeto para responder a una misma llamada en diferentes formas. En el contexto de la POO, esto significa que podemos usar objetos de clases derivadas donde se espera un objeto de una clase base, siempre y cuando las clases derivadas implementen los métodos necesarios. Este concepto es crucial para crear código flexible y escalable, ya que nos permite tratar diferentes tipos de objetos de manera uniforme.

En esta subunidad, exploraremos cómo definir clases base y derivadas, cómo utilizar el operador `extends` para establecer relaciones de herencia, y cómo sobrescribir métodos en las clases derivadas. También aprenderemos sobre la visibilidad de los miembros de una clase (públicos, privados, protegidos) y cómo manejar la herencia múltiple, aunque con ciertas limitaciones.

Además, profundizaremos en el polimorfismo, aprendiendo a utilizar interfaces para definir contratos comunes entre clases, así como a implementar métodos abstractos en las clases base. También exploraremos cómo usar el operador `instanceof` para verificar la instancia de un objeto y cómo aplicar el polimorfismo en situaciones prácticas.

A lo largo de esta subunidad, trabajaremos con ejemplos prácticos que demuestran cómo aplicar la herencia y el polimorfismo en diferentes escenarios. Estos ejemplos nos ayudarán a entender cómo estos conceptos pueden ser utilizados para crear código más limpio, modular y fácil de mantener.

Finalmente, reflexionaremos sobre las ventajas y desventajas de utilizar la herencia y el polimorfismo en nuestro código. Aprenderemos cómo identificar situaciones en las que estos principios son especialmente útiles y cómo evitar abusar de ellos para mantener un diseño limpio y coherente.

En resumen, esta subunidad didáctica es una exploración profunda de la herencia y el polimorfismo en la programación orientada a objetos. A través de conceptos teóricos, ejemplos prácticos y reflexiones sobre su aplicación, nos prepararemos para abordar problemas más complejos y desarrollar aplicaciones más robustas y escalables.

<a id="jerarquia-de-clases-superclases-y-subclases"></a>
## Jerarquía de clases Superclases y subclases

La jerarquía de clases es un concepto fundamental en la programación orientada a objetos (POO), que permite organizar y reutilizar el código de manera eficiente. En esta subunidad, exploraremos cómo definir superclases y subclases, así como cómo utilizarlas para crear una estructura lógica y coherente en nuestros programas.

En primer lugar, es importante entender qué son las superclases y las subclases. Una superclase, también conocida como clase base o clase padre, es aquella que define un conjunto de atributos y métodos comunes para varias clases relacionadas. Por otro lado, una subclase, también llamada clase derivada o clase hija, hereda los atributos y métodos de la superclase y puede añadir nuevos o modificar los existentes.

La creación de una jerarquía de clases empieza con la definición de la superclase. Esta clase actúa como un molde que proporciona las características básicas que serán compartidas por todas las subclases. Por ejemplo, si estamos desarrollando un sistema para gestionar diferentes tipos de vehículos, podríamos crear una superclase llamada "Vehículo" con atributos como marca, modelo y año de fabricación.

Una vez definida la superclase, podemos crear subclases que hereden sus características. Por ejemplo, podríamos crear una subclase llamada "Coche" que herede de "Vehículo". La clase "Coche" podría añadir atributos específicos como número de puertas y color, o incluso sobrescribir métodos de la superclase para adaptarlos a las necesidades particulares del coche.

La jerarquía de clases no se limita a una sola nivel. Es posible tener subclases que hereden de otras subclases, creando así una estructura jerárquica. Por ejemplo, si tenemos una superclase "Automóvil" y dos subclases "Coche" y "Motocicleta", podríamos crear una subclase adicional llamada "SUV" que herede de "Coche". De esta manera, la clase "SUV" tendría todos los atributos y métodos de la superclase "Coche", además de los específicos de un SUV.

La utilización de jerarquías de clases ofrece varias ventajas. En primer lugar, permite una mayor reutilización del código, ya que las subclases pueden heredar los atributos y métodos comunes definidos en la superclase. Esto reduce la redundancia y facilita el mantenimiento del código.

Además, la jerarquía de clases mejora la organización lógica del programa. Al agrupar clases relacionadas bajo una superclase común, se facilita su comprensión y uso. Las subclases pueden ser vistas como extensiones o variaciones de la superclase, lo que hace que el código sea más intuitivo y fácil de navegar.

La herencia también permite la sobrescritura de métodos en las subclases. Esto significa que una subclase puede modificar el comportamiento de un método definido en su superclase para adaptarlo a sus necesidades específicas. Por ejemplo, si tenemos un método "arrancar" en la superclase "Vehículo", podemos sobrescribirlo en la subclase "Coche" para añadir funcionalidades adicionales como encender el aire acondicionado.

La utilización de jerarquías de clases también facilita la implementación de polimorfismo. El polimorfismo es un concepto que permite tratar objetos de diferentes clases de manera uniforme, siempre y cuando compartan una interfaz común definida en su superclase. Esto significa que podemos escribir código que funcione con cualquier objeto que herede de la superclase, independientemente del tipo específico de subclase.

En resumen, la jerarquía de clases es un poderoso mecanismo en la programación orientada a objetos que permite organizar y reutilizar el código de manera eficiente. Al definir superclases y subclases, podemos crear una estructura lógica y coherente que facilita la comprensión y uso del programa. La utilización de jerarquías de clases ofrece ventajas como la reutilización del código, la organización lógica del programa y el soporte para el polimorfismo, lo que hace que nuestro código sea más robusto, escalable y fácil de mantener.

<a id="clases-y-metodos-abstractos-y-finales"></a>
## Clases y métodos abstractos y finales

En la subunidad "Clases y métodos abstractos y finales", nos adentramos en conceptos avanzados de programación orientada a objetos que son fundamentales para el diseño robusto y escalable de aplicaciones. Comenzamos por entender los métodos abstractos, que son declaraciones de métodos sin implementación en la clase abstracta. Estos métodos deben ser implementados por cualquier subclase concreta, lo que asegura una interfaz común mientras permite la diversidad en las implementaciones específicas.

Continuando, exploramos los métodos finales, que son métodos declarados como finales dentro de una clase y no pueden ser sobrescritos por ninguna subclase. Esta característica es útil para proteger el comportamiento predefinido de un método, garantizando que ciertos aspectos del diseño sean inmutables y consistentes a lo largo de la jerarquía de clases.

La combinación de métodos abstractos y finales permite crear una estructura de clases donde se definen las interfaces necesarias para el comportamiento esperado, mientras se protegen ciertas implementaciones específicas. Este enfoque es especialmente útil en patrones de diseño como los Singleton o los Factory Methods, donde se requiere un control preciso sobre la creación y modificación de objetos.

Además, aprendemos que las clases abstractas pueden contener tanto métodos abstractos como finales, lo que permite una flexibilidad completa en el diseño. Las clases abstractas actúan como plantillas para sus subclases, proporcionando un esqueleto común mientras permiten la personalización necesaria.

Es importante destacar que los métodos abstractos y finales trabajan juntos para crear una jerarquía de clases coherente y segura. Los métodos abstractos aseguran que ciertos comportamientos sean implementados, mientras que los métodos finales protegen esos comportamientos contra modificaciones no deseadas.

En el contexto práctico, estos conceptos se aplican en la creación de frameworks y bibliotecas donde se requiere una estructura definida pero con la posibilidad de extensión. Por ejemplo, un framework puede proporcionar métodos abstractos para operaciones esenciales mientras permite a los desarrolladores sobrescribir solo las partes específicas que necesitan ser personalizadas.

Finalmente, reflexionamos sobre cómo estos conceptos pueden facilitar el mantenimiento y la evolución de software. Al definir interfaces claras con métodos abstractos y proteger comportamientos críticos con métodos finales, se reduce la complejidad del código y aumenta su resistencia a cambios.

En resumen, "Clases y métodos abstractos y finales" es una subunidad crucial en el aprendizaje de la programación orientada a objetos. A través de estos conceptos avanzados, los desarrolladores pueden crear sistemas más robustos, seguros y fácilmente mantenibles, lo que es fundamental para el éxito del desarrollo de software moderno.

<a id="interfaces"></a>
## Interfaces

Las interfaces en programación son una herramienta poderosa que permite definir un contrato común entre diferentes clases o componentes de software. En esta subunidad didáctica, exploraremos cómo las interfaces funcionan, cuándo deberíamos utilizarlas y cómo implementarlas de manera efectiva.

La primera parte del contenido se centra en la comprensión básica de qué es una interfaz. Se explica que una interfaz define un conjunto de métodos y propiedades que deben ser implementados por cualquier clase que quiera adoptar ese contrato. Esta definición abstracta permite a diferentes clases compartir comportamientos comunes sin necesidad de conocer su estructura interna.

A continuación, se aborda la importancia práctica de las interfaces en el diseño de software. Se destaca cómo permiten una mayor flexibilidad y reutilización del código, ya que cualquier clase puede implementar varias interfaces, lo que facilita la creación de sistemas modulares y escalables.

El contenido también incluye explicaciones sobre cómo declarar e implementar interfaces en diferentes lenguajes de programación. Se proporcionan ejemplos prácticos para mostrar cómo se pueden definir métodos abstractos y cómo las clases concretas deben proporcionar la implementación de estos métodos.

Además, se discute el concepto de polimorfismo a través de interfaces. Se explica que una interfaz puede ser utilizada como tipo de dato, lo que permite tratar diferentes objetos de manera uniforme en función del contrato definido por la interfaz, independientemente de su clase concreta.

El texto también aborda el uso de interfaces para crear sistemas decoupled (desacoplados), lo que facilita la mantenibilidad y la evolución del código. Se explican cómo las interfaces actúan como una barrera entre diferentes partes del sistema, reduciendo así la dependencia directa entre ellas.

Se proporcionan ejemplos de aplicaciones prácticas donde el uso de interfaces ha sido beneficioso, como en sistemas de plugins o en arquitecturas basadas en eventos. Se destaca cómo las interfaces permiten una mayor extensibilidad y personalización del software sin modificar su código base.

El contenido también incluye explicaciones sobre cómo manejar la implementación de interfaces en proyectos de equipo. Se discute el uso de herramientas como las interfaces gráficas para diseñar contratos de interfaz, así como prácticas recomendadas para la documentación y la revisión del código que implementa estas interfaces.

Finalmente, se aborda el tema de la evolución de interfaces a lo largo del tiempo. Se explica cómo las interfaces pueden ser modificadas o actualizadas sin afectar los componentes que las utilizan, siempre y cuando sigan cumpliendo con su contrato original.

En resumen, esta subunidad didáctica proporciona una visión completa y práctica de las interfaces en programación, desde su definición básica hasta sus aplicaciones en proyectos reales. Se enfoca en la comprensión profunda de cómo funcionan las interfaces y cómo pueden ser utilizadas para mejorar la estructura y el mantenimiento del código.

<a id="sobreescritura-de-metodos"></a>
## Sobreescritura de métodos

La sobreescritura de métodos es una técnica fundamental en la programación orientada a objetos que permite redefinir el comportamiento de un método heredado en una subclase. Este proceso es esencial para mantener la cohesión del diseño, permitiendo adaptar las funcionalidades específicas de cada clase sin alterar su estructura básica.

En el contexto de la programación orientada a objetos, cada objeto pertenece a una clase, que define sus atributos y métodos. Cuando una subclase hereda de una superclase, puede optar por redefinir los métodos de la superclase para adaptarlos a sus necesidades específicas. Esta práctica es conocida como sobreescritura o polimorfismo.

La sobreescritura se realiza mediante el uso del mismo nombre y firma (parámetros) que el método en la superclase, pero con un comportamiento diferente. Al llamar al método desde una instancia de la subclase, se ejecuta el método redefinido en lugar del original de la superclase.

Este mecanismo es poderoso porque permite mantener la jerarquía de clases y la cohesión del diseño, mientras que proporciona flexibilidad para adaptar las funcionalidades específicas de cada subclase. La sobreescritura es una herramienta fundamental en la programación orientada a objetos, permitiendo crear sistemas más modulares y escalables.

La sobreescritura también facilita la extensión del comportamiento de los métodos heredados. Al redefinir un método, se puede añadir nueva funcionalidad sin modificar el código original de la superclase. Esto es especialmente útil cuando se desea personalizar el comportamiento de una clase sin alterar su estructura básica.

Además, la sobreescritura permite la creación de métodos virtuales o abstractos en las superclases. Los métodos virtuales son aquellos que pueden ser redefinidos en subclases, mientras que los métodos abstractos no tienen implementación y deben ser redefinidos por todas las subclases. La sobreescritura es esencial para el correcto funcionamiento de estos métodos.

La sobreescritura también facilita la creación de interfaces gráficas y aplicaciones interactivas. Al redefinir métodos como `paint` o `actionPerformed`, se puede personalizar el comportamiento de componentes visuales, permitiendo crear interfaces más atractivas y funcionales.

En resumen, la sobreescritura es una técnica fundamental en la programación orientada a objetos que permite adaptar el comportamiento de los métodos heredados en subclases. Este mecanismo es esencial para mantener la cohesión del diseño, proporcionar flexibilidad y facilitar la extensión del comportamiento de las clases. La sobreescritura es una herramienta poderosa que permite crear sistemas más modulares, escalables y personalizables.

<a id="constructores-y-herencia"></a>
## Constructores y herencia

En el vasto terreno de la programación orientada a objetos, los constructores y la herencia son pilares fundamentales que permiten crear estructuras de datos complejas y reutilizables. Los constructores son métodos especiales que se ejecutan automáticamente cuando se crea un objeto, inicializando sus atributos en valores específicos o predeterminados. Esta fase es crucial para establecer el estado inicial del objeto, asegurando que esté listo para interactuar con el resto de la aplicación.

La herencia, por otro lado, es una característica poderosa que permite a las clases derivar propiedades y comportamientos de otras clases existentes. Al crear una clase hija, se puede aprovechar todo lo definido en la clase padre, extendiéndolo o modificándolo según sea necesario para adaptarse a nuevas necesidades. Esta práctica promueve la reutilización del código y facilita el mantenimiento al permitir cambios en un solo lugar.

La combinación de constructores y herencia permite crear jerarquías de clases que son más organizadas y fácilmente manejables. Cada nivel de la jerarquía puede añadir o modificar comportamientos específicos, mientras que los atributos y métodos comunes se mantienen en las clases superiores. Esta estructura facilita el diseño de sistemas complejos, donde diferentes partes pueden interactuar de manera coherente y eficiente.

El uso de constructores y herencia también implica la consideración de la encapsulación, una práctica que oculta los detalles internos de un objeto y expone solo lo necesario. Esto no solo protege el estado del objeto sino que también facilita su modificación y evolución en el futuro sin afectar a las partes que lo utilizan.

En la práctica, la creación de constructores y la implementación de herencia requieren una comprensión profunda de los conceptos básicos de programación orientada a objetos. Es importante entender cómo funcionan los métodos, cómo se manejan los tipos de datos y cómo se establecen las relaciones entre diferentes clases.

La utilización avanzada de constructores y herencia permite desarrollar aplicaciones más robustas y escalables. Al permitir la creación de clases genéricas que pueden adaptarse a múltiples contextos, estas características facilitan el desarrollo de software modular y reutilizable.

En resumen, los constructores y la herencia son herramientas esenciales en la programación orientada a objetos, proporcionando estructuras sólidas para organizar y gestionar el código. Su comprensión y uso adecuado son fundamentales para crear aplicaciones eficientes y mantenibles que puedan adaptarse a las necesidades cambiantes del usuario.


<a id="mantenimiento-de-la-persistencia-de-los-objetos"></a>
# Mantenimiento de la persistencia de los objetos

<a id="bases-de-datos-orientadas-a-objetos"></a>
## Bases de datos orientadas a objetos

En el vasto universo de la programación, una rama llamada "Mantenimiento de la persistencia de los objetos" destaca como un pilar fundamental. Esta sección explora cómo almacenar y recuperar datos en sistemas orientados a objetos, abordando conceptos cruciales que son esenciales para el desarrollo robusto y eficiente de aplicaciones.

La base de esta rama es la comprensión de las bases de datos orientadas a objetos (ODBs), sistemas que almacenan y gestionan los datos como objetos en lugar de registros. Este enfoque ofrece una representación natural de los datos dentro del contexto de un programa, facilitando su manipulación y acceso.

El primer paso hacia el mantenimiento de la persistencia de los objetos es entender cómo instalar y configurar un gestor de bases de datos orientadas a objetos. Esto implica familiarizarse con las herramientas disponibles y realizar una instalación segura y eficiente, asegurando que todos los requisitos técnicos sean cumplidos.

Una vez establecida la conexión con el gestor de base de datos, se procede a la creación de bases de datos. Este proceso requiere un diseño cuidadoso para garantizar la integridad y consistencia de los datos. La definición de tablas y relaciones adecuadas es crucial para optimizar el rendimiento y facilitar las consultas posteriores.

El mantenimiento de la persistencia de los objetos implica no solo la creación inicial, sino también la gestión continua de la información almacenada. Esto incluye la inserción de nuevos datos, la modificación existente y la eliminación de registros obsoletos o redundantes. Cada operación debe ser realizada con cuidado para mantener la coherencia de los datos.

La consulta de datos es otro aspecto fundamental del mantenimiento de la persistencia de los objetos. Los sistemas orientados a objetos proporcionan mecanismos eficientes para realizar búsquedas y recuperar información específica, lo que es esencial para el funcionamiento correcto de aplicaciones complejas.

Además de las operaciones básicas, el mantenimiento de la persistencia de los objetos implica la gestión de transacciones. Las transacciones son conjuntos de operaciones que deben ser ejecutadas como una unidad, asegurando que todas las modificaciones sean consistentes y completas o ninguna se aplique en caso de error.

El manejo de excepciones es otro aspecto crucial del mantenimiento de la persistencia de los objetos. Las bases de datos orientadas a objetos suelen presentar situaciones inesperadas durante el proceso de almacenamiento y recuperación de datos, por lo que es necesario implementar mecanismos robustos para capturar y manejar estas excepciones.

La optimización del rendimiento también es un aspecto importante en la persistencia de los objetos. Esto implica no solo mejorar la velocidad de acceso a los datos, sino también reducir el uso de recursos como memoria y espacio en disco.

Finalmente, el mantenimiento de la persistencia de los objetos debe incluir la documentación adecuada. La creación de documentación detallada sobre las estructuras de datos, las operaciones disponibles y los procedimientos recomendados es crucial para que otros desarrolladores puedan entender y trabajar con el sistema de manera eficiente.

En resumen, la persistencia de los objetos en sistemas orientados a objetos es un proceso complejo pero fundamental. Desde la instalación y configuración del gestor de base de datos hasta la optimización del rendimiento y la documentación, cada paso requiere una comprensión profunda y una atención meticulosa para garantizar el éxito del proyecto.

<a id="caracteristicas-de-las-bases-de-datos-orientadas-a-objetos"></a>
## Características de las bases de datos orientadas a objetos

La programación orientada a objetos (OOP) es una filosofía de diseño que busca representar los conceptos del mundo real mediante clases y objetos. En este contexto, el mantenimiento de la persistencia de los objetos es un aspecto crucial que permite almacenar y recuperar información de manera eficiente y segura.

Las bases de datos orientadas a objetos (ODB) son sistemas que almacenan y gestionan datos en forma de objetos, lo que facilita su acceso y manipulación. Estas bases de datos ofrecen una visión natural del mundo real, donde los datos se organizan en entidades relacionadas entre sí.

La característica más destacada de las ODB es su capacidad para almacenar directamente objetos como estructuras de datos complejas, sin necesidad de convertirlos a un formato plano. Esto permite una representación más precisa y natural de la realidad en el sistema de gestión de información.

Además, las ODB ofrecen funcionalidades avanzadas que facilitan el acceso y manipulación de los datos. Por ejemplo, permiten realizar consultas complejas sobre los objetos almacenados, lo que es especialmente útil para aplicaciones empresariales donde se requiere un análisis detallado de la información.

El mantenimiento de la persistencia en ODB implica la creación, actualización y eliminación de objetos en el sistema. Esta operación debe ser segura y eficiente, asegurando que los datos estén siempre disponibles y consistentes.

Las ODB también ofrecen mecanismos para gestionar las relaciones entre los objetos, lo que facilita la integración de diferentes partes del sistema. Por ejemplo, se pueden establecer relaciones entre clientes y pedidos, permitiendo una fácil consulta de todos los pedidos realizados por un cliente específico.

En resumen, el mantenimiento de la persistencia de los objetos en bases de datos orientadas a objetos es un aspecto fundamental que permite representar y gestionar información de manera natural y eficiente. Esta característica hace que las ODB sean una herramienta poderosa para aplicaciones empresariales y otras que requieren un alto nivel de integridad y accesibilidad de los datos.

<a id="instalacion-del-gestor-de-bases-de-datos"></a>
## Instalación del gestor de bases de datos

La instalación del gestor de bases de datos es un paso crucial en el desarrollo de aplicaciones que requieren almacenamiento persistente de información. Este proceso implica la configuración adecuada del software necesario para gestionar los datos de manera eficiente y segura, permitiendo a las aplicaciones acceder, modificar y recuperar información de forma rápida y precisa.

El primer paso en esta instalación es seleccionar el gestor de bases de datos que mejor se adapte a las necesidades específicas del proyecto. Algunos de los más populares incluyen MySQL, PostgreSQL, Oracle Database y Microsoft SQL Server. Cada uno tiene sus propias características y ventajas, por lo que es importante realizar una evaluación cuidadosa para elegir el más adecuado.

Una vez seleccionado el gestor de bases de datos, se procede a la instalación del software. Este proceso puede variar dependiendo del sistema operativo utilizado, pero generalmente implica descargar el instalador desde el sitio web oficial del gestor de bases de datos y seguir las instrucciones paso a paso proporcionadas por el mismo.

Durante la instalación, es crucial configurar correctamente los parámetros iniciales. Esto incluye establecer el nombre del servidor, la contraseña del administrador (root), y otros detalles específicos del sistema operativo. Además, se debe decidir si se desea instalar el gestor de bases de datos en modo seguro o no.

La instalación también puede implicar la configuración de opciones adicionales como el tamaño inicial de los archivos de datos, la configuración de seguridad avanzada y la selección de características específicas del software. Es importante realizar esta configuración con cuidado para evitar problemas posteriores.

Una vez completada la instalación, es necesario verificar que todo esté funcionando correctamente. Esto implica iniciar el servicio del gestor de bases de datos y comprobar que se puede acceder a él desde el sistema operativo. Además, se debe realizar una prueba básica para asegurarse de que los datos pueden ser insertados, recuperados y modificados sin problemas.

La instalación del gestor de bases de datos es un proceso fundamental en la creación de aplicaciones que requieren almacenamiento persistente de información. Aunque puede parecer complejo al principio, con una buena comprensión de los pasos involucrados y el uso de herramientas adecuadas, este proceso se vuelve relativamente sencillo y eficiente.

Es importante recordar que la instalación del gestor de bases de datos es solo el primer paso en el proceso de gestión de información. A lo largo del ciclo de vida de una aplicación, será necesario realizar actualizaciones periódicas, optimizar el rendimiento y asegurar la seguridad de los datos almacenados.

En conclusión, la instalación del gestor de bases de datos es un proceso crucial pero fundamental en el desarrollo de aplicaciones que requieren almacenamiento persistente. Con una buena comprensión de los pasos involucrados y el uso de herramientas adecuadas, este proceso se vuelve relativamente sencillo y eficiente.

<a id="creacion-de-bases-de-datos"></a>
## Creación de bases de datos

La creación de bases de datos es una etapa fundamental en el desarrollo de aplicaciones informáticas, ya que proporciona la estructura necesaria para almacenar, recuperar y gestionar los datos de manera eficiente. En esta subunidad didáctica, nos adentramos en los aspectos técnicos y prácticos de este proceso.

Comenzamos por entender las bases del concepto de base de datos. Una base de datos es una colección organizada de datos que se almacenan en un sistema informático para su acceso y gestión. Su principal objetivo es facilitar el almacenamiento, recuperación y manipulación de información de manera estructurada y eficiente.

Continuamos con la exploración de las herramientas y tecnologías utilizadas para crear bases de datos. En este contexto, destacan los gestores de bases de datos (DBMS), que son programas especializados en la creación, gestión y operación de las bases de datos. Algunos ejemplos populares incluyen MySQL, PostgreSQL y Microsoft SQL Server.

A medida que avanzamos, nos familiarizamos con el proceso de diseño de una base de datos. Este proceso implica definir la estructura de los datos a almacenar, determinar las relaciones entre ellos y seleccionar los tipos de datos adecuados para cada campo. El objetivo es crear un modelo de datos que sea funcional, eficiente y fácil de mantener.

El siguiente paso en el proceso de creación de bases de datos es la implementación del diseño. Esto implica la creación de las tablas físicas en el sistema de gestión de base de datos, definiendo las columnas, tipos de datos y restricciones necesarias para almacenar los datos de manera correcta.

Una vez creada la estructura física de la base de datos, es crucial definir las relaciones entre las tablas. Las relaciones permiten establecer conexiones entre diferentes conjuntos de datos, facilitando la recuperación de información relacionada y la creación de consultas complejas.

La optimización de una base de datos es otro aspecto importante a considerar en el proceso de su creación. Esto implica la selección de índices adecuados para mejorar el rendimiento de las consultas, así como la implementación de estrategias de almacenamiento y recuperación eficientes.

El diseño y creación de bases de datos también implican la consideración de aspectos de seguridad. Es fundamental establecer políticas de acceso controladas para proteger los datos sensibles y evitar accesos no autorizados.

Finalmente, en esta subunidad didáctica, exploramos técnicas avanzadas para la creación de bases de datos. Estas pueden incluir el uso de lenguajes de definición de datos (DDL) para crear esquemas complejos, la implementación de transacciones para garantizar la integridad de los datos y la utilización de herramientas de gestión de base de datos para facilitar el proceso.

En resumen, la creación de bases de datos es un proceso integral en el desarrollo de aplicaciones informáticas. A través de este proceso, podemos organizar y gestionar eficientemente grandes volúmenes de información, lo que permite a las empresas tomar decisiones basadas en datos precisos y actualizados. Este conocimiento es fundamental para cualquier profesional del campo de la programación y gestión de sistemas informáticos.

<a id="mecanismos-de-consulta"></a>
## Mecanismos de consulta

En el mundo digital de la programación, mantener la persistencia de los objetos es una tarea fundamental que permite a las aplicaciones almacenar y recuperar información con eficiencia. Este proceso implica la creación y gestión de mecanismos que permitan la manipulación de datos en un entorno persistente, como bases de datos o sistemas de archivos.

La carpeta `005-Mecanismos de consulta` del curso de programación se centra específicamente en cómo realizar estas operaciones. Aquí, los estudiantes aprenderán a formular y ejecutar consultas que permitan recuperar información almacenada de manera eficiente y segura. El contenido aborda desde la sintaxis básica hasta técnicas avanzadas, proporcionando una comprensión profunda del manejo de datos en aplicaciones.

La primera lección introduce los conceptos básicos de consulta, explicando cómo estructurar sentencias que permitan seleccionar, filtrar y ordenar información. Los estudiantes aprenderán a utilizar operadores lógicos y comparativos para crear consultas precisas y eficientes. Además, se discute la importancia de la optimización de consultas para mejorar el rendimiento de las aplicaciones.

La siguiente lección profundiza en los tipos de consultas más comunes, como las proyecciones y agrupamientos. Se explica cómo utilizar estas técnicas para obtener información resumida y estructurada, facilitando la toma de decisiones basadas en datos. Los estudiantes también aprenderán a combinar múltiples consultas para realizar tareas complejas.

La carpeta continúa con lecciones sobre el manejo de subconsultas, que son consultas anidadas dentro de otras. Esta técnica es crucial para resolver problemas complejos y obtener información detallada en aplicaciones empresariales y científicas. Los estudiantes aprenderán cómo utilizar subconsultas para realizar operaciones avanzadas y cómo optimizarlas para mejorar el rendimiento.

La lección sobre la combinación de múltiples selecciones es una extensión natural del tema anterior, enseñando a los estudiantes cómo combinar diferentes consultas para obtener información completa y precisa. Se discute la importancia de la coherencia en las consultas y cómo utilizar operadores lógicos para unir resultados de manera efectiva.

La carpeta también aborda el tema de la optimización de consultas, una cuestión crítica en cualquier sistema persistente. Los estudiantes aprenderán técnicas avanzadas para mejorar el rendimiento de las consultas, como el uso de índices y la minimización del uso de recursos. Se discute cómo analizar y optimizar consultas complejas para asegurar un rendimiento óptimo.

La lección final en esta carpeta se centra en el manejo de excepciones durante las consultas. Aprender a gestionar errores y excepciones es fundamental para la robustez de cualquier aplicación. Los estudiantes aprenderán cómo detectar, capturar y manejar excepciones que puedan surgir durante el proceso de consulta, asegurando una experiencia de usuario fluida y segura.

En resumen, la carpeta `005-Mecanismos de consulta` del curso de programación ofrece una visión completa y detallada del manejo de datos en aplicaciones. Desde los conceptos básicos hasta técnicas avanzadas, proporciona a los estudiantes las herramientas necesarias para realizar consultas eficientes y seguras. Este conocimiento es esencial para desarrollar aplicaciones robustas y escalables que puedan manejar grandes volúmenes de datos con facilidad y precisión.

<a id="el-lenguaje-de-consultas-sintaxis-expresiones-operadores"></a>
## El lenguaje de consultas sintaxis, expresiones, operadores

En el mundo de la programación, mantener la persistencia de los objetos es una tarea fundamental que requiere un lenguaje de consultas poderoso y flexible. Este lenguaje nos permite interactuar con las bases de datos de manera eficiente, recuperando, modificando y eliminando información de manera segura y precisa.

El primer paso para entender el mantenimiento de la persistencia es familiarizarse con el lenguaje de consultas que se utiliza en la base de datos. Este lenguaje, conocido como SQL (Structured Query Language), es un estándar internacional que permite a los programadores realizar operaciones complejas sobre las bases de datos.

La sintaxis de SQL es rica y detallada, permitiendo a los usuarios definir consultas precisas para acceder a la información necesaria. Desde la sencilla consulta SELECT hasta las complejas sentencias UPDATE y DELETE, cada una con su propia estructura y reglas específicas, SQL nos proporciona las herramientas necesarias para interactuar con los datos de manera eficiente.

Las expresiones en SQL son otro aspecto crucial del lenguaje. Las expresiones permiten realizar cálculos y manipulaciones sobre los datos antes de que sean recuperados o almacenados. Desde la suma de valores hasta el filtrado de resultados, las expresiones en SQL ofrecen una gran flexibilidad para procesar los datos según nuestras necesidades.

Los operadores son el núcleo del lenguaje de consultas. Son símbolos y palabras clave que nos permiten definir las condiciones y acciones a realizar en nuestras consultas. Desde los operadores relacionales (como =, >, <) hasta los operadores lógicos (AND, OR, NOT), cada uno con su propia funcionalidad y reglas de precedencia, los operadores son esenciales para construir consultas complejas.

La importancia de conocer bien el lenguaje de consultas no se limita a la recuperación de datos. También es fundamental para la modificación y eliminación de información en las bases de datos. Las sentencias UPDATE y DELETE, junto con los operadores y expresiones adecuados, nos permiten realizar cambios precisos en nuestros datos.

Además, el lenguaje de consultas también incluye funciones que pueden ser utilizadas dentro de nuestras consultas para realizar cálculos o manipulaciones adicionales. Desde las funciones agregadas (como SUM, AVG, COUNT) hasta las funciones de texto (como UPPER, LOWER, SUBSTRING), estas funciones ofrecen una gran potencia en el procesamiento de datos.

La comprensión del lenguaje de consultas es crucial para cualquier programador que trabaje con bases de datos. No solo nos permite interactuar eficientemente con los datos, sino que también nos proporciona la capacidad de realizar operaciones complejas y precisas sobre ellos. Con el conocimiento adecuado del lenguaje de consultas, podemos mantener la persistencia de los objetos de manera segura y efectiva, lo que es fundamental para el desarrollo de aplicaciones robustas y eficientes.

En resumen, el mantenimiento de la persistencia de los objetos en una base de datos requiere un lenguaje de consultas poderoso y flexible. Conocer bien el lenguaje de consultas nos permite interactuar con las bases de datos de manera eficiente, recuperando, modificando y eliminando información de manera segura y precisa. Desde la sencilla consulta SELECT hasta las complejas sentencias UPDATE y DELETE, cada una con su propia estructura y reglas específicas, el lenguaje de consultas nos proporciona las herramientas necesarias para interactuar con los datos de manera eficiente.

<a id="recuperacion-modificacion-y-borrado-de-informacion"></a>
## Recuperación, modificación y borrado de información

En el mundo digital, la persistencia de los objetos es una cuestión fundamental que abarca tanto la recuperación como la modificación y borrado de información. Este proceso es esencial para mantener la integridad y coherencia de los datos en aplicaciones informáticas.

La recuperación de información es un aspecto crucial del mantenimiento de la persistencia de los objetos. Consiste en el acceso a los datos almacenados previamente, lo que permite realizar consultas y operaciones sobre ellos. Este proceso requiere una comprensión profunda de las estructuras de datos utilizadas y las técnicas de acceso eficiente a estos datos.

La modificación de la información es otro elemento fundamental del mantenimiento de la persistencia de los objetos. Implica el cambio en los valores de los atributos de los objetos, lo que puede ser necesario para actualizar la información basada en nuevas entradas o cambios en las condiciones del sistema.

El borrado de información también forma parte integral del proceso de mantenimiento de la persistencia de los objetos. Es una operación delicada que debe realizarse con cuidado para evitar pérdidas de datos importantes y garantizar la integridad de la base de datos.

La recuperación, modificación y borrado de información son interrelacionados y deben manejarse de manera coherente para mantener el sistema informático funcional. Cada una de estas operaciones requiere un enfoque específico y técnicas adecuadas para garantizar su correcto funcionamiento.

El mantenimiento de la persistencia de los objetos es un proceso continuo que implica no solo la recuperación, modificación y borrado de información, sino también la gestión eficiente del almacenamiento y la optimización del rendimiento. Este proceso requiere una comprensión profunda de las bases de datos y las técnicas de programación adecuadas.

La persistencia de los objetos es un concepto fundamental en el desarrollo de aplicaciones informáticas. Su correcto manejo es esencial para garantizar la integridad, coherencia y eficiencia del sistema. A través del proceso de recuperación, modificación y borrado de información, se puede mantener la base de datos actualizada y relevante, lo que es crucial para el funcionamiento óptimo del sistema.

La persistencia de los objetos es un tema complejo pero fundamental en el desarrollo de aplicaciones informáticas. Su correcto manejo requiere una comprensión profunda de las bases de datos y las técnicas de programación adecuadas. A través del proceso de recuperación, modificación y borrado de información, se puede mantener la base de datos actualizada y relevante, lo que es crucial para el funcionamiento óptimo del sistema.

La persistencia de los objetos es un concepto fundamental en el desarrollo de aplicaciones informáticas. Su correcto manejo es esencial para garantizar la integridad, coherencia y eficiencia del sistema. A través del proceso de recuperación, modificación y borrado de información, se puede mantener la base de datos actualizada y relevante, lo que es crucial para el funcionamiento óptimo del sistema.

La persistencia de los objetos es un tema complejo pero fundamental en el desarrollo de aplicaciones informáticas. Su correcto manejo requiere una comprensión profunda de las bases de datos y las técnicas de programación adecuadas. A través del proceso de recuperación, modificación y borrado de información, se puede mantener la base de datos actualizada y relevante, lo que es crucial para el funcionamiento óptimo del sistema.

La persistencia de los objetos es un concepto fundamental en el desarrollo de aplicaciones informáticas. Su correcto manejo es esencial para garantizar la integridad, coherencia y eficiencia del sistema. A través del proceso de recuperación, modificación y borrado de información, se puede mantener la base de datos actualizada y relevante, lo que es crucial para el funcionamiento óptimo del sistema.

La persistencia de los objetos es un tema complejo pero fundamental en el desarrollo de aplicaciones informáticas. Su correcto manejo requiere una comprensión profunda de las bases de datos y las técnicas de programación adecuadas. A través del proceso de recuperación, modificación y borrado de información, se puede mantener la base de datos actualizada y relevante, lo que es crucial para el funcionamiento óptimo del sistema.

La persistencia de los objetos es un concepto fundamental en el desarrollo de aplicaciones informáticas. Su correcto manejo es esencial para garantizar la integridad, coherencia y eficiencia del sistema. A través del proceso de recuperación, modificación y borrado de información, se puede mantener la base de datos actualizada y relevante, lo que es crucial para el funcionamiento óptimo del sistema.

La persistencia de los objetos es un tema complejo pero fundamental en el desarrollo de aplicaciones informáticas. Su correcto manejo requiere una comprensión profunda de las bases de datos y las técnicas de programación adecuadas. A través del proceso de recuperación, modificación y borrado de información, se puede mantener la base de datos actualizada y relevante, lo que es crucial para el funcionamiento óptimo del sistema.

La persistencia de los objetos es un concepto fundamental en el desarrollo de aplicaciones informáticas. Su correcto manejo es esencial para garantizar la integridad, coherencia y eficiencia del sistema. A través del proceso de recuperación, modificación y borrado de información, se puede mantener la base de datos actualizada y relevante, lo que es crucial para el funcionamiento óptimo del sistema.

<a id="tipos-de-datos-objeto-atributos-y-metodos"></a>
## Tipos de datos objeto; atributos y métodos

En el vasto mundo de la programación, el concepto de persistencia de los objetos es una piedra angular que sostiene las estructuras de datos más complejas. Este proceso, que permite a los datos almacenados en memoria ser guardados permanentemente en un medio de almacenamiento externo como discos duros o bases de datos, es fundamental para mantener la integridad y consistencia de los sistemas informáticos.

La persistencia de los objetos implica no solo el almacenamiento de los datos, sino también su recuperación y manipulación. Este proceso se realiza a través de métodos específicamente diseñados para interactuar con el medio de almacenamiento. Estos métodos pueden ser directamente invocados por el programador o pueden ser utilizados automáticamente por frameworks y bibliotecas que facilitan la gestión del estado de los objetos.

Los tipos de datos objeto son una extensión natural del concepto de objetos en la programación orientada a objetos. Algunos ejemplos incluyen clases, estructuras y registros. Cada tipo de dato objeto tiene atributos, que representan las características o propiedades del objeto, y métodos, que definen las acciones que el objeto puede realizar.

Los atributos son variables asociadas con un objeto que almacenan su estado actual. Por ejemplo, en una clase `Persona`, los atributos podrían ser `nombre`, `edad` y `dirección`. Los métodos, por otro lado, son funciones definidas dentro de la clase que realizan operaciones sobre el objeto o manipulan sus atributos.

La persistencia de los objetos a través de tipos de datos objeto es un proceso que requiere cuidado. Es importante garantizar que los datos se almacenen y recuperen correctamente para evitar errores y mantener la coherencia del sistema. Además, la gestión adecuada de la memoria es crucial para evitar fugas de memoria y problemas de rendimiento.

En el contexto de bases de datos, la persistencia de los objetos a través de tipos de datos objeto puede realizarse mediante mapeo objeto-relacional (ORM). ORM es una técnica que permite a los desarrolladores interactuar con las bases de datos utilizando objetos en lugar de sentencias SQL. Esto facilita la programación y reduce el riesgo de errores.

La persistencia de los objetos también implica la gestión de transacciones. Una transacción es un conjunto de operaciones que se realizan como una unidad lógica. Si todas las operaciones dentro de una transacción son exitosas, entonces toda la transacción se considera exitosa y los cambios se aplican permanentemente al sistema. Si alguna operación falla, la transacción se cancela y no se aplican ningún cambio.

En resumen, la persistencia de los objetos es un concepto fundamental en la programación que permite a los datos ser almacenados, recuperados y manipulados de manera segura y eficiente. A través de tipos de datos objeto, métodos y técnicas como ORM y gestión de transacciones, los desarrolladores pueden crear sistemas informáticos robustos y confiables que puedan mantener su estado a lo largo del tiempo.

<a id="tipos-de-datos-coleccion"></a>
## Tipos de datos colección

En el vasto mundo de la programación, los objetos son las piezas fundamentales que conforman nuestra realidad digital. Sin embargo, para que estos objetos puedan interactuar eficazmente entre sí y con otros elementos del sistema, es necesario almacenarlos de manera persistente. Es aquí donde entra en juego el concepto de tipos de datos colección.

Los tipos de datos colección son estructuras de datos que nos permiten agrupar y organizar múltiples objetos bajo un solo nombre. Estas estructuras son esenciales para la programación orientada a objetos, ya que nos proporcionan una forma eficiente de almacenar, recuperar y manipular grandes cantidades de información.

La colección más básica y común en la programación es el array. Un array es una estructura de datos que permite almacenar un conjunto ordenado de elementos del mismo tipo. Cada elemento dentro del array se identifica por su índice, lo que facilita su acceso y manipulación. Los arrays son ideales para situaciones donde necesitamos trabajar con conjuntos homogéneos de datos.

Otro tipo de colección importante es el diccionario o mapa. A diferencia de los arrays, los diccionarios no están ordenados y cada elemento está asociado a una clave única. Este tipo de estructura es especialmente útil cuando necesitamos acceder a los elementos por su nombre o identificador en lugar de su posición.

Además de estos tipos básicos, existen colecciones más complejas como las listas enlazadas, las pilas y las colas. Cada una de estas estructuras tiene sus propias características y ventajas, lo que las hace útiles para diferentes situaciones dependiendo del problema que estemos tratando de resolver.

La elección del tipo de colección adecuado es crucial para el rendimiento y la eficiencia de nuestro código. Algunas colecciones ofrecen operaciones más rápidas en ciertas situaciones, mientras que otras son mejores para otros tipos de acceso o manipulación de datos.

Para trabajar con colecciones en programación, necesitamos conocer las operaciones básicas que se pueden realizar sobre ellas. Estas operaciones incluyen la inserción y eliminación de elementos, la búsqueda de un elemento específico y la recorrido de todos los elementos de la colección. Cada tipo de colección tiene sus propias implementaciones de estas operaciones, lo que puede afectar su rendimiento.

Además de las operaciones básicas, también es importante entender cómo manejar excepciones cuando se trabaja con colecciones. Por ejemplo, si intentamos acceder a un elemento fuera del rango válido de un array o diccionario, nuestro programa podría fallar. Es por eso que es crucial aprender a manejar estas situaciones de manera segura y eficiente.

La persistencia de los objetos en colecciones también implica la gestión de la memoria. Cuando insertamos objetos en una colección, debemos considerar cómo liberar la memoria cuando estos objetos ya no sean necesarios. Esto puede implicar el uso de técnicas como la recolección de basura o la gestión manual del ciclo de vida de los objetos.

En resumen, los tipos de datos colección son herramientas poderosas y versátiles en la programación orientada a objetos. Al comprender cómo funcionan y cuándo usar cada uno, podemos escribir programas más eficientes y robustos. Cada colección tiene sus propias ventajas y desventajas, lo que nos obliga a pensar cuidadosamente en nuestras necesidades específicas antes de elegir la estructura adecuada para nuestro problema.

La comprensión profunda de los tipos de datos colección es un paso crucial hacia el dominio del desarrollo de software. Al aprender a utilizar estas estructuras eficazmente, podemos crear aplicaciones que manejen grandes cantidades de información con facilidad y eficiencia. Este conocimiento nos permitirá construir sistemas complejos y escalables que respondan a las necesidades cambiantes de nuestros usuarios.

En el mundo de la programación, los objetos son como los bloques con los que construimos nuestras edificios digitales. Y las colecciones son las herramientas que nos permiten organizar y almacenar estos bloques de manera eficiente. Con un buen dominio de los tipos de datos colección, podemos crear estructuras de datos complejas y poderosas que nos ayuden a resolver problemas reales y significativos en el mundo digital.

La programación es una disciplina que requiere tanto conocimiento teórico como habilidad práctica. Y la comprensión de los tipos de datos colección es un aspecto fundamental del segundo, ya que nos permite trabajar con grandes cantidades de información de manera eficiente y segura. Con el tiempo y la práctica, podemos convertirnos en expertos en el uso de estas estructuras y aplicarlas en una variedad de situaciones.

En conclusión, los tipos de datos colección son herramientas esenciales en la programación orientada a objetos. Al aprender a utilizarlas eficazmente, podemos crear aplicaciones que manejen grandes cantidades de información con facilidad y eficiencia. Con un buen dominio de estos conceptos, podemos construir sistemas complejos y escalables que respondan a las necesidades cambiantes de nuestros usuarios. Y en el mundo digital, donde la cantidad de información es cada vez mayor, esta habilidad será más valiosa que nunca.


<a id="gestion-de-bases-de-datos"></a>
# Gestión de bases de datos

<a id="acceso-a-bases-de-datos-estandares-caracteristicas"></a>
## Acceso a bases de datos. Estándares. Características

En el vasto mundo de la programación, una base de datos es como un gran armario donde se almacenan los secretos digitales de nuestras aplicaciones. Este armario tiene reglas estrictas para mantener sus objetos en orden y garantizar su seguridad y eficiencia.

El acceso a bases de datos es el primer paso hacia la manipulación de estos secretos. Es como abrir una puerta que nos permite ver, modificar o eliminar lo que está dentro del armario. Para hacer esto, necesitamos seguir un conjunto de reglas establecidas por los estándares de la industria.

Estos estándares son como las normas de juego que todos deben seguir para que todo funcione sin problemas. Algunos de los más conocidos incluyen SQL (Structured Query Language), que es el idioma utilizado para comunicarse con las bases de datos, y JDBC (Java Database Connectivity), que es una API que permite a los programas Java interactuar con diferentes tipos de bases de datos.

Además de estos estándares, cada base de datos tiene sus propias características únicas. Algunas son más eficientes para almacenar grandes cantidades de información, mientras que otras son excelentes para manejar relaciones complejas entre los datos. Es importante conocer estas diferencias para elegir la herramienta adecuada para el trabajo.

El acceso a bases de datos no es solo una cuestión técnica; también implica seguridad y privacidad. Los sistemas deben estar diseñados para proteger la información sensible contra accesos no autorizados, lo que significa entender cómo funcionan los mecanismos de autenticación y autorización.

Además del acceso básico, las bases de datos modernas ofrecen una gama de funciones avanzadas. Desde el almacenamiento en caché hasta la replicación de datos para aumentar la disponibilidad, cada característica contribuye a hacer que nuestro armario digital sea más robusto y eficiente.

La gestión de transacciones es otro aspecto crucial del acceso a bases de datos. Una transacción es una serie de operaciones que se realizan juntas como un todo. Si alguna parte falla, todo debe revertirse para mantener la integridad de los datos. Es como asegurarse de que no se pierdan los juguetes cuando se está jugando con ellos.

El acceso a bases de datos también implica la optimización. Esto significa encontrar el camino más corto y eficiente para llegar al objetivo, ya sea consultando una base de datos grande o actualizando un registro específico. La optimización es como aprender a buscar en un armario lleno de juguetes sin perder el tiempo.

En resumen, el acceso a bases de datos es la puerta que nos permite interactuar con los secretos digitales almacenados en nuestros sistemas. Al seguir los estándares adecuados y conocer las características específicas de cada base de datos, podemos asegurarnos de que nuestra aplicación funcione eficientemente y seguramente. Y, como cualquier buen juego, el acceso a bases de datos requiere práctica y paciencia para dominarlo plenamente.

<a id="establecimiento-de-conexiones"></a>
## Establecimiento de conexiones

La gestión de bases de datos es una habilidad fundamental en el desarrollo de software moderno, ya que permite a los programadores almacenar, recuperar y gestionar grandes volúmenes de información de manera eficiente. En esta subunidad didáctica, nos centramos específicamente en el establecimiento de conexiones con bases de datos, un paso crucial antes de cualquier interacción con la información almacenada.

El primer concepto que abordamos es el concepto de conexión a una base de datos. Una conexión se establece entre el programa informático y la base de datos para permitir la comunicación bidireccional. Este proceso implica la especificación de detalles como el nombre del servidor, el puerto, el nombre de la base de datos, el usuario y la contraseña. La importancia de estos detalles no puede ser subestimada, ya que cualquier error en ellos puede llevar a fallas graves en la aplicación.

Continuamos con una explicación detallada sobre cómo establecer conexiones utilizando diferentes lenguajes de programación. Por ejemplo, en Java, se utiliza el objeto `Connection` del paquete `java.sql`, mientras que en Python, existen bibliotecas como `sqlite3` para bases de datos SQLite o `psycopg2` para PostgreSQL. Cada uno de estos métodos requiere un conjunto específico de parámetros y puede presentar desafíos propios dependiendo del tipo de base de datos utilizado.

El establecimiento de conexiones también implica la gestión de excepciones, ya que es posible que ocurran errores inesperados durante el proceso. Por ejemplo, si el servidor no está disponible o las credenciales son incorrectas, se producirá una excepción. Es crucial manejar estas situaciones adecuadamente para evitar que la aplicación falle y proporcionar un feedback útil al usuario.

Además de establecer conexiones, también es importante entender cómo cerrarlas correctamente. Una conexión abierta puede consumir recursos del servidor y limitar su capacidad para atender a otras solicitudes. Por lo tanto, es una buena práctica cerrar la conexión tan pronto como no sea necesaria, utilizando métodos específicos proporcionados por cada lenguaje o biblioteca.

El proceso de establecimiento de conexiones también implica la configuración del entorno de desarrollo. Esto puede incluir la instalación y configuración de drivers o controladores para el tipo específico de base de datos utilizado. Por ejemplo, si se está utilizando una base de datos MySQL, es necesario instalar el driver JDBC correspondiente.

En este contexto, también es útil conocer las mejores prácticas en cuanto a la seguridad de las conexiones. Esto incluye el uso de contraseñas seguras y la implementación de políticas de acceso controlados para evitar accesos no autorizados. Además, es recomendable utilizar métodos como la autenticación dual-factor o la autenticación basada en tokens para mejorar la seguridad.

Finalmente, esta subunidad también aborda el tema de la gestión de transacciones. Una transacción es una serie de operaciones que se realizan juntas y deben completarse completamente o no realizarse en absoluto. Si alguna operación falla, toda la transacción debe revertirse para mantener la integridad de los datos.

En resumen, el establecimiento de conexiones con bases de datos es un paso fundamental en cualquier aplicación que interactúe con información persistente. A través de este proceso, se permite la comunicación entre el programa y la base de datos, lo que facilita la almacenamiento, recuperación y gestión de grandes volúmenes de información. Es crucial entender los detalles del establecimiento de conexiones, manejar excepciones adecuadamente, cerrar las conexiones correctamente y seguir mejores prácticas en cuanto a seguridad y transacciones para asegurar el funcionamiento eficiente y seguro de la aplicación.

<a id="almacenamiento-recuperacion-actualizacion-y-eliminacion-de-informacion-en-bases-de-datos"></a>
## Almacenamiento, recuperación, actualización y eliminación de información en bases de datos

En la vastedad del océano digital, donde los datos son las rocas fundamentales de nuestra era, se encuentra el concepto de gestión de bases de datos. Este es un dominio que abarca desde la creación hasta la eliminación de información en sistemas de almacenamiento persistente. Comenzamos nuestro viaje por esta temática con una visión general del proceso de almacenamiento y recuperación de datos.

El primer paso en el manejo de bases de datos es su almacenamiento, un acto que requiere inteligencia y precisión para garantizar la integridad y seguridad de los datos. Este proceso implica la creación de tablas o colecciones donde se organizarán los datos según ciertas reglas definidas por el modelo de datos utilizado. La elección del modelo de datos adecuado es crucial, ya que determinará cómo se estructuran y relacionan los datos dentro de la base.

La recuperación de información es otro aspecto fundamental de la gestión de bases de datos. Este proceso implica la búsqueda y acceso a los datos almacenados en la base de datos. La eficiencia de esta operación depende del diseño de índices y la optimización de las consultas SQL, que son herramientas clave para extraer información de manera rápida y precisa.

La actualización de información es un proceso que permite modificar los datos existentes en la base de datos. Este acto es esencial para mantener los datos actualizados y reflejar los cambios en el mundo real. La gestión adecuada de las transacciones durante este proceso es crucial, ya que garantiza la consistencia y coherencia de los datos.

Por último, pero no menos importante, está el proceso de eliminación de información. Este acto implica la borrado de registros o datos específicos de la base de datos. La seguridad y la privacidad son factores clave en este proceso, ya que debe garantizar que solo se eliminen los datos autorizados y necesarios.

A lo largo de este recorrido por el mundo de la gestión de bases de datos, hemos explorado desde la creación hasta la eliminación de información. Cada paso requiere una comprensión profunda del modelo de datos, las consultas SQL y las transacciones para garantizar que los datos sean manejados de manera eficiente y segura.

Este proceso no es solo técnico; también implica habilidades de planificación y organización. Es necesario tener en cuenta el rendimiento de la base de datos, la seguridad de los datos y la facilidad con la que se pueden realizar operaciones de recuperación y actualización.

En conclusión, la gestión de bases de datos es un campo complejo pero fundamental para cualquier sistema informático moderno. Desde su creación hasta su eliminación, cada paso requiere una comprensión profunda y habilidades técnicas avanzadas. A través del estudio y práctica constante, podemos mejorar nuestra capacidad para manejar eficazmente los datos en nuestro mundo digital.


<a id="proyectos"></a>
# Proyectos

<a id="proyecto-formulario"></a>
## Proyecto formulario

### Introduccion

```markdown
Sistema de gestión empresarial
Cualquier software que gestiona cualquier aspecto de cualquie empresa

ERP = Enterprise Resource Planning

CRM = Customer Relationship Management

SIS = Student Information System

CRM = Sistema de gestión de la relación con el cliente
```

### formulario

```
<!doctype html>
<html lang="es">
  <head>
    <title>Formulario</title>
    <meta charset="utf-8">

    <style>
      /* Tus estilos originales tal cual */
      :root{
        --primary: crimson;
        --primary-light: #ff8fa0;
        --bg: #f2f2f2;
        --text: #333;
        --border: #ddd;
      }
      body, html{
        background: var(--bg);
        display: flex;
        justify-content: center;
        padding: 40px;
        font-family: "Segoe UI", sans-serif;
        color: var(--text);
      }
      form{
        background: white;
        padding: 30px 40px;
        width: 650px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border-top: 8px solid var(--primary);
      }
      legend{
        font-size: 1.4em;
        font-weight: bold;
        color: var(--primary);
        margin-bottom: 10px;
      }
      form fieldset{
        display: flex;
        flex-direction: column;
        gap: 20px;
        border: none;
        padding: 0;
      }
      .control_formulario{
        display: flex;
        flex-direction: column;
        gap: 6px;
      }
      .control_formulario label{
        font-size: 0.95em;
        font-weight: 600;
        color: var(--primary);
      }
      form fieldset input:not([type="checkbox"]),
      form fieldset select,
      form fieldset textarea{
        padding: 12px 14px;
        border: 1px solid var(--border);
        border-radius: 6px;
        width: 100%;
        font-size: 1em;
        transition: border 0.3s, box-shadow 0.3s;
        box-sizing:border-box;
      }
      .control_formulario_checkbox{
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
      }
      .control_formulario_checkbox input[type="checkbox"]{
        appearance: none;
        width: 52px;
        height: 28px;
        border-radius: 999px;
        background: #ccc;
        cursor: pointer;
        border: 1px solid #bbb;
        transition: background .25s;
        position: relative;
      }
      .control_formulario_checkbox input[type="checkbox"]::before{
        content: "";
        position: absolute;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: white;
        top: 50%;
        left: 3px;
        transform: translateY(-50%);
        transition: transform 0.25s;
      }
      .control_formulario_checkbox input[type="checkbox"]:checked{
        background: var(--primary);
        border-color: var(--primary);
      }
      .control_formulario_checkbox input[type="checkbox"]:checked::before{
        transform: translate(22px, -50%);
      }

      input[type="submit"]{
        background: var(--primary);
        color: white;
        padding: 14px;
        border: none;
        border-radius: 6px;
        font-size: 1.1em;
        cursor: pointer;
        margin-top: 10px;
      }
    </style>

  </head>
  <body>
    <form action="" method="POST" enctype="multipart/form-data">
      <fieldset>
        <legend>Formulario de recogida de datos</legend>

        <?php
          $c = new mysqli("localhost","training_center","training_center","training_center");

          /* COMENTARIO DE LA TABLA */
          $tableComment = $c->query("
            SELECT TABLE_COMMENT
            FROM information_schema.tables
            WHERE table_schema='training_center'
              AND table_name='inscripciones'
          ")->fetch_assoc()['TABLE_COMMENT'];

          if ($tableComment != "") {
              echo "<p style='color:#555; margin-top:-5px; margin-bottom:20px;'>$tableComment</p>";
          }

          /* COLUMNAS CON SUS COMENTARIOS */
          $r = $c->query("
            SELECT COLUMN_NAME, COLUMN_TYPE, COLUMN_KEY, COLUMN_DEFAULT, COLUMN_COMMENT
            FROM information_schema.columns
            WHERE table_schema='training_center'
              AND table_name='inscripciones'
          ");

          while($f = $r->fetch_assoc()) {

            $campo = $f['COLUMN_NAME'];
            $tipo  = $f['COLUMN_TYPE'];
            $comentario = $f['COLUMN_COMMENT'];

            /* NO tocar esta lógica: respetar exclusiones */
            if($f['COLUMN_KEY'] == "PRI" || $f['COLUMN_DEFAULT'] == "CURRENT_TIMESTAMP") continue;

            echo '<div class="control_formulario">';

            // LABEL = nombre técnico de la columna (como pediste)
            echo '<label for="'.$campo.'">Introduce '.$campo.'</label>';

            // PÁRRAFO = comentario explicativo
            if ($comentario != "") {
              echo '<p style="margin:0; font-size:0.85em; color:#666;">'.$comentario.'</p>';
            }

            /* ---------- Mantener tus tipos de campo exactamente ---------- */

            if (str_contains($tipo, "varchar")) {
               echo '<input type="text" name="'.$campo.'" id="'.$campo.'">';
            }
            else if ($tipo == "date") {
               echo '<input type="date" name="'.$campo.'" id="'.$campo.'">';
            }
            else if ($tipo == "int") {
               echo '<input type="number" name="'.$campo.'" id="'.$campo.'">';
            }
            else if (str_contains($tipo, "decimal")) {
               echo '<input type="number" name="'.$campo.'" id="'.$campo.'" step="0.01">';
            }
            else if (str_contains($tipo, "tinyint")) {
               echo '<div class="control_formulario_checkbox">';
               echo '<label for="'.$campo.'">Introduce '.$campo.'</label>';
               echo '<input type="checkbox" name="'.$campo.'" id="'.$campo.'">';
               echo '</div>';
            }
            else if (str_contains($tipo, "enum")) {
               echo '<select name="'.$campo.'" id="'.$campo.'">';
               preg_match_all("/'([^']+)'/", $tipo, $matches);
               foreach($matches[1] as $valor){
                 echo '<option value="'.$valor.'">'.$valor.'</option>';
               }
               echo '</select>';
            }
            else if ($tipo == "text") {
               echo '<textarea name="'.$campo.'" id="'.$campo.'"></textarea>';
            }
            else if (str_contains($tipo, "blob")) {
               echo '<input type="file" name="'.$campo.'" id="'.$campo.'">';
            }

            echo '</div>';
          }
        ?>

        <input type="submit">
      </fieldset>
    </form>
  </body>
</html>
```

### guardamos los datos

```
<?php
// Conexión a la base de datos (una sola vez, al inicio del archivo)
$c = new mysqli("localhost","training_center","training_center","training_center");
if ($c->connect_error) {
  die("Error de conexión: " . $c->connect_error);
}

$mensaje = "";

// Procesar envío del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Recuperar metadatos de columnas de la tabla
  $meta = $c->query("
    SELECT COLUMN_NAME, COLUMN_TYPE, COLUMN_KEY, COLUMN_DEFAULT
    FROM information_schema.columns
    WHERE table_schema='training_center'
      AND table_name='inscripciones'
  ");

  $columnas      = [];
  $placeholders  = [];
  $valores       = [];
  $tiposBind     = "";

  while ($f = $meta->fetch_assoc()) {

    $campo     = $f['COLUMN_NAME'];
    $tipo      = $f['COLUMN_TYPE'];
    $colKey    = $f['COLUMN_KEY'];
    $colDef    = $f['COLUMN_DEFAULT'];

    // Misma exclusión que en el formulario
    if ($colKey == "PRI" || $colDef == "CURRENT_TIMESTAMP") {
      continue;
    }

    // Determinar el valor recibido según el tipo
    $valor = null;

    if (str_contains($tipo, "varchar")) {
      $valor = $_POST[$campo] ?? null;
      $tiposBind .= "s";
    }
    else if ($tipo == "date") {
      $valor = $_POST[$campo] ?? null;
      $tiposBind .= "s";
    }
    else if ($tipo == "int") {
      // Número entero
      $valor = isset($_POST[$campo]) && $_POST[$campo] !== "" ? (int)$_POST[$campo] : null;
      $tiposBind .= "i";
    }
    else if (str_contains($tipo, "decimal")) {
      // Número decimal
      $valor = isset($_POST[$campo]) && $_POST[$campo] !== "" ? (float)$_POST[$campo] : null;
      $tiposBind .= "d";
    }
    else if (str_contains($tipo, "tinyint")) {
      // Checkbox: si no viene en POST, se considera 0
      $valor = isset($_POST[$campo]) ? 1 : 0;
      $tiposBind .= "i";
    }
    else if (str_contains($tipo, "enum")) {
      // Enum: valor de la lista
      $valor = $_POST[$campo] ?? null;
      $tiposBind .= "s";
    }
    else if ($tipo == "text") {
      $valor = $_POST[$campo] ?? null;
      $tiposBind .= "s";
    }
    else if (str_contains($tipo, "blob")) {
      // Archivo subido: se guarda el contenido binario
      if (isset($_FILES[$campo]) && $_FILES[$campo]['error'] === UPLOAD_ERR_OK) {
        $valor = file_get_contents($_FILES[$campo]['tmp_name']);
      } else {
        $valor = null;
      }
      $tiposBind .= "s"; // Se envía como string; MySQL lo almacenará en el BLOB
    } else {
      // Cualquier otro tipo no contemplado explícitamente
      $valor = $_POST[$campo] ?? null;
      $tiposBind .= "s";
    }

    $columnas[]     = $campo;
    $placeholders[] = "?";
    $valores[]      = $valor;
  }

  if (!empty($columnas)) {

    $sql = "INSERT INTO inscripciones (" . implode(",", $columnas) . ")
            VALUES (" . implode(",", $placeholders) . ")";

    $stmt = $c->prepare($sql);

    if ($stmt) {
      // Construir array de parámetros por referencia para bind_param
      $params = [];
      $params[] = &$tiposBind;
      foreach ($valores as $k => $v) {
        $params[] = &$valores[$k];
      }

      // bind_param dinámico
      call_user_func_array([$stmt, 'bind_param'], $params);

      if ($stmt->execute()) {
        $mensaje = "Datos guardados correctamente.";
      } else {
        $mensaje = "Error al guardar los datos: " . $stmt->error;
      }

      $stmt->close();
    } else {
      $mensaje = "Error al preparar la consulta: " . $c->error;
    }
  } else {
    $mensaje = "No hay columnas que insertar (revisa la definición de la tabla).";
  }
}
?>
<!doctype html>
<html lang="es">
  <head>
    <title>Formulario</title>
    <meta charset="utf-8">

    <style>
      /* Tus estilos originales tal cual */
      :root{
        --primary: crimson;
        --primary-light: #ff8fa0;
        --bg: #f2f2f2;
        --text: #333;
        --border: #ddd;
      }
      body, html{
        background: var(--bg);
        display: flex;
        justify-content: center;
        padding: 40px;
        font-family: "Segoe UI", sans-serif;
        color: var(--text);
      }
      form{
        background: white;
        padding: 30px 40px;
        width: 650px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border-top: 8px solid var(--primary);
      }
      legend{
        font-size: 1.4em;
        font-weight: bold;
        color: var(--primary);
        margin-bottom: 10px;
      }
      form fieldset{
        display: flex;
        flex-direction: column;
        gap: 20px;
        border: none;
        padding: 0;
      }
      .control_formulario{
        display: flex;
        flex-direction: column;
        gap: 6px;
      }
      .control_formulario label{
        font-size: 0.95em;
        font-weight: 600;
        color: var(--primary);
      }
      form fieldset input:not([type="checkbox"]),
      form fieldset select,
      form fieldset textarea{
        padding: 12px 14px;
        border: 1px solid var(--border);
        border-radius: 6px;
        width: 100%;
        font-size: 1em;
        transition: border 0.3s, box-shadow 0.3s;
        box-sizing:border-box;
      }
      .control_formulario_checkbox{
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
      }
      .control_formulario_checkbox input[type="checkbox"]{
        appearance: none;
        width: 52px;
        height: 28px;
        border-radius: 999px;
        background: #ccc;
        cursor: pointer;
        border: 1px solid #bbb;
        transition: background .25s;
        position: relative;
      }
      .control_formulario_checkbox input[type="checkbox"]::before{
        content: "";
        position: absolute;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: white;
        top: 50%;
        left: 3px;
        transform: translateY(-50%);
        transition: transform 0.25s;
      }
      .control_formulario_checkbox input[type="checkbox"]:checked{
        background: var(--primary);
        border-color: var(--primary);
      }
      .control_formulario_checkbox input[type="checkbox"]:checked::before{
        transform: translate(22px, -50%);
      }

      input[type="submit"]{
        background: var(--primary);
        color: white;
        padding: 14px;
        border: none;
        border-radius: 6px;
        font-size: 1.1em;
        cursor: pointer;
        margin-top: 10px;
      }
    </style>

  </head>
  <body>
    <form action="" method="POST" enctype="multipart/form-data">
      <fieldset>
        <legend>Formulario de recogida de datos</legend>

        <?php if ($mensaje != ""): ?>
          <p style="padding:10px 12px; border-radius:6px;
                    background:#f8f8f8; border:1px solid #ddd;
                    font-size:0.9em; color:#444;">
            <?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8'); ?>
          </p>
        <?php endif; ?>

        <?php
          /* COMENTARIO DE LA TABLA */
          $tableComment = $c->query("
            SELECT TABLE_COMMENT
            FROM information_schema.tables
            WHERE table_schema='training_center'
              AND table_name='inscripciones'
          ")->fetch_assoc()['TABLE_COMMENT'];

          if ($tableComment != "") {
              echo "<p style='color:#555; margin-top:-5px; margin-bottom:20px;'>$tableComment</p>";
          }

          /* COLUMNAS CON SUS COMENTARIOS */
          $r = $c->query("
            SELECT COLUMN_NAME, COLUMN_TYPE, COLUMN_KEY, COLUMN_DEFAULT, COLUMN_COMMENT
            FROM information_schema.columns
            WHERE table_schema='training_center'
              AND table_name='inscripciones'
          ");

          while($f = $r->fetch_assoc()) {

            $campo = $f['COLUMN_NAME'];
            $tipo  = $f['COLUMN_TYPE'];
            $comentario = $f['COLUMN_COMMENT'];

            /* NO tocar esta lógica: respetar exclusiones */
            if($f['COLUMN_KEY'] == "PRI" || $f['COLUMN_DEFAULT'] == "CURRENT_TIMESTAMP") continue;

            echo '<div class="control_formulario">';

            // LABEL = nombre técnico de la columna (como pediste)
            echo '<label for="'.$campo.'">Introduce '.$campo.'</label>';

            // PÁRRAFO = comentario explicativo
            if ($comentario != "") {
              echo '<p style="margin:0; font-size:0.85em; color:#666;">'.$comentario.'</p>';
            }

            /* ---------- Mantener tus tipos de campo exactamente ---------- */

            if (str_contains($tipo, "varchar")) {
               echo '<input type="text" name="'.$campo.'" id="'.$campo.'">';
            }
            else if ($tipo == "date") {
               echo '<input type="date" name="'.$campo.'" id="'.$campo.'">';
            }
            else if ($tipo == "int") {
               echo '<input type="number" name="'.$campo.'" id="'.$campo.'">';
            }
            else if (str_contains($tipo, "decimal")) {
               echo '<input type="number" name="'.$campo.'" id="'.$campo.'" step="0.01">';
            }
            else if (str_contains($tipo, "tinyint")) {
               echo '<div class="control_formulario_checkbox">';
               echo '<label for="'.$campo.'">Introduce '.$campo.'</label>';
               echo '<input type="checkbox" name="'.$campo.'" id="'.$campo.'">';
               echo '</div>';
            }
            else if (str_contains($tipo, "enum")) {
               echo '<select name="'.$campo.'" id="'.$campo.'">';
               preg_match_all("/'([^']+)'/", $tipo, $matches);
               foreach($matches[1] as $valor){
                 echo '<option value="'.$valor.'">'.$valor.'</option>';
               }
               echo '</select>';
            }
            else if ($tipo == "text") {
               echo '<textarea name="'.$campo.'" id="'.$campo.'"></textarea>';
            }
            else if (str_contains($tipo, "blob")) {
               echo '<input type="file" name="'.$campo.'" id="'.$campo.'">';
            }

            echo '</div>';
          }
        ?>

        <input type="submit">
      </fieldset>
    </form>
  </body>
</html>
```

### panel admin

```


<!doctype html>
<html lang="es">
  <head>
    <title>Formulario</title>
    <meta charset="utf-8">
    <style>
      body,html{width:100%;height:100%;padding:0px;margin:0px;}
      body{display:flex;}
      nav{flex:1;background:crimson;padding:10px;display:flex;flex-direction:column;gap:10px;}
      main{flex:5;padding:10px;}
      table{border:1px solid crimson;padding:10px;width:100%;border-collapse:collapse;}
      nav button{background:white;border:none;padding:10px;border-radius:20px;}
      table tr:nth-child(odd){background:rgb(255,220,220);}
      table td{padding:10px;}
    </style>
  </head>
  <body>
    <nav>
      <button>Enlace 1</button>
      <button>Enlace 2</button>
      <button>Enlace 3</button>
    </nav>
    <main>
      <table>
        <?php for($i = 0;$i<30;$i++){ ?>
          <tr>
            <td>Nombre</td><td>Apellidos</td><td>Email</td><td>Direccion</td><td>Codigo</td>
          </tr>
        <?php } ?>
      </table>
    </main>
  </body>
</html>
```

### panel admin real

```
<?php
// Conexión a la base de datos (una sola vez, al inicio del archivo)
$c = new mysqli("localhost","training_center","training_center","training_center");
if ($c->connect_error) {
  die("Error de conexión: " . $c->connect_error);
}
?>
<!doctype html>
<html lang="es">
  <head>
    <title>Formulario</title>
    <meta charset="utf-8">
    <style>
      body,html{width:100%;height:100%;padding:0px;margin:0px;}
      body{display:flex;}
      nav{flex:1;background:crimson;padding:10px;display:flex;flex-direction:column;gap:10px;}
      main{flex:5;padding:10px;}
      table{border:1px solid crimson;padding:10px;width:100%;border-collapse:collapse;}
      nav button{background:white;border:none;padding:10px;border-radius:20px;}
      table tr:nth-child(odd){background:rgb(255,220,220);}
      table td{padding:10px;}
    </style>
  </head>
  <body>
    <nav>
      <button>Enlace 1</button>
      <button>Enlace 2</button>
      <button>Enlace 3</button>
    </nav>
    <main>
      <table>
        <thead>
          <tr>
            <?php
            /* COLUMNAS CON SUS COMENTARIOS */
              $r = $c->query("
                SELECT COLUMN_NAME, COLUMN_TYPE, COLUMN_KEY, COLUMN_DEFAULT, COLUMN_COMMENT
                FROM information_schema.columns
                WHERE table_schema='training_center'
                  AND table_name='inscripciones'
              ");

              while($f = $r->fetch_assoc()) {
                echo '<th>'.$f['COLUMN_NAME'].'</th>';
              
              }
            ?>
          </tr>
        </thead>
        <tbody>
          <?php
            $r = $c->query("SELECT * FROM inscripciones;");

              while($f = $r->fetch_assoc()) {
              echo '<tr>';
              foreach($f as $clave=>$valor){
                echo '<td>'.$valor.'</td>';
              }
              echo  '</tr>';
              
              }
          ?>
        </tbody>
      </table>
    </main>
  </body>
</html>
```

### estilo panel

```
<?php
// Conexión a la base de datos (una sola vez, al inicio del archivo)
$c = new mysqli("localhost","training_center","training_center","training_center");
if ($c->connect_error) {
  die("Error de conexión: " . $c->connect_error);
}
?>
<!doctype html>
<html lang="es">
  <head>
    <title>Panel de administración</title>
    <meta charset="utf-8">
    <style>
      :root{
        --primary: crimson;
        --primary-light: #ff8fa0;
        --bg: #f2f2f2;
        --text: #333;
        --border: #ddd;
      }

      *{
        box-sizing:border-box;
        margin:0;
        padding:0;
      }

      html, body{
        height:100%;
        font-family: "Segoe UI", sans-serif;
        color: var(--text);
        background: var(--bg);
      }

      body{
        display:flex;
        align-items:stretch;
      }

      nav{
        width:240px;
        background: var(--primary);
        padding:20px;
        display:flex;
        flex-direction:column;
        gap:10px;
        box-shadow: 4px 0 12px rgba(0,0,0,0.1);
      }

      nav h2{
        color:white;
        margin-bottom:15px;
        font-size:1.1em;
        font-weight:700;
      }

      nav button{
        background:white;
        border:none;
        padding:10px 14px;
        border-radius:999px;
        cursor:pointer;
        font-size:0.95em;
        text-align:left;
        transition: transform 0.15s, box-shadow 0.15s, background 0.15s;
      }

      nav button:hover{
        transform: translateY(-1px);
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        background:#fff5f7;
      }

      main{
        flex:1;
        padding:30px 40px;
        display:flex;
        flex-direction:column;
        gap:15px;
      }

      header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:10px;
      }

      header h1{
        font-size:1.4em;
        color:var(--primary);
      }

      .table-card{
        background:white;
        border-radius:10px;
        padding:20px 24px;
        box-shadow:0 4px 15px rgba(0,0,0,0.08);
        border-top:8px solid var(--primary);
      }

      .table-card h3{
        margin-bottom:10px;
        font-size:1.1em;
        color:var(--primary);
      }

      .table-card p.description{
        margin-bottom:10px;
        font-size:0.9em;
        color:#666;
      }

      table{
        width:100%;
        border-collapse:collapse;
        font-size:0.9em;
      }

      thead th{
        text-align:left;
        padding:10px 8px;
        border-bottom:2px solid var(--primary-light);
        color:var(--primary);
        font-weight:600;
      }

      tbody td{
        padding:8px 8px;
        border-bottom:1px solid var(--border);
      }

      tbody tr:nth-child(even){
        background:#fafafa;
      }

      tbody tr:hover{
        background:#ffeef2;
      }

      @media (max-width: 900px){
        body{
          flex-direction:column;
        }
        nav{
          width:100%;
          flex-direction:row;
          flex-wrap:wrap;
          box-shadow:none;
        }
        nav h2{
          width:100%;
        }
        main{
          padding:20px;
        }
      }
    </style>
  </head>
  <body>
    <nav>
      <h2>Menú</h2>
      <button>Enlace 1</button>
      <button>Enlace 2</button>
      <button>Enlace 3</button>
    </nav>
    <main>
      <header>
        <h1>Listado de inscripciones</h1>
      </header>

      <section class="table-card">
        <h3>Tabla: inscripciones</h3>
        <p class="description">Registros actuales en la tabla <strong>inscripciones</strong> de la base de datos <strong>training_center</strong>.</p>

        <table>
          <thead>
            <tr>
              <?php
              /* COLUMNAS CON SUS COMENTARIOS */
              $r = $c->query("
                SELECT COLUMN_NAME, COLUMN_TYPE, COLUMN_KEY, COLUMN_DEFAULT, COLUMN_COMMENT
                FROM information_schema.columns
                WHERE table_schema='training_center'
                  AND table_name='inscripciones'
              ");

              while($f = $r->fetch_assoc()) {
                echo '<th>'.$f['COLUMN_NAME'].'</th>';
              }
              ?>
            </tr>
          </thead>
          <tbody>
            <?php
              $r = $c->query("SELECT * FROM inscripciones;");

              while($f = $r->fetch_assoc()) {
                echo '<tr>';
                foreach($f as $clave=>$valor){
                  echo '<td>'.htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8').'</td>';
                }
                echo '</tr>';
              }
            ?>
          </tbody>
        </table>
      </section>
    </main>
  </body>
</html>
```

### funciones

```
<?php
session_start();

// Conexión a la base de datos (una sola vez, al inicio del archivo)
$c = new mysqli("localhost","training_center","training_center","training_center");
if ($c->connect_error) {
  die("Error de conexión: " . $c->connect_error);
}

/*-----------------------------------------------------------
  1) Tabla auxiliar para estados CRM (NO toca inscripciones)
-----------------------------------------------------------*/
$c->query("
  CREATE TABLE IF NOT EXISTS crm_estados_inscripciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_registro VARCHAR(255) NOT NULL UNIQUE,
    estado VARCHAR(50) NOT NULL,
    color VARCHAR(20) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
");

/*-----------------------------------------------------------
  2) Estados típicos de CRM (en español) + colores
-----------------------------------------------------------*/
$estadosCRM = [
  'Nuevo'             => '#3498db', // azul
  'Contactado'        => '#9b59b6', // violeta
  'En seguimiento'    => '#f1c40f', // amarillo
  'Cualificado'       => '#2ecc71', // verde
  'No interesado'     => '#95a5a6', // gris
  'Ganado'            => '#27ae60', // verde fuerte
  'Perdido'           => '#e74c3c', // rojo
];

/*-----------------------------------------------------------
  3) Detectar columna PRIMARY KEY de inscripciones
-----------------------------------------------------------*/
$primaryKeyColumn = null;
$pkResult = $c->query("
  SELECT COLUMN_NAME 
  FROM information_schema.columns
  WHERE table_schema = 'training_center'
    AND table_name   = 'inscripciones'
    AND COLUMN_KEY   = 'PRI'
  LIMIT 1;
");
if ($pkResult && $pkResult->num_rows > 0) {
  $primaryKeyColumn = $pkResult->fetch_assoc()['COLUMN_NAME'];
}

/*-----------------------------------------------------------
  4) Lógica de login / logout
-----------------------------------------------------------*/
$login_error = "";

if (isset($_GET['logout'])) {
  session_destroy();
  header("Location: " . $_SERVER['PHP_SELF']);
  exit;
}

if (isset($_POST['action']) && $_POST['action'] === 'login') {
  $usuario = $_POST['usuario'] ?? '';
  $password = $_POST['password'] ?? '';

  if ($usuario === 'jocarsa' && $password === 'jocarsa') {
    $_SESSION['admin_logged'] = true;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
  } else {
    $login_error = "Usuario o contraseña incorrectos.";
  }
}

$loggedIn = isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] === true;

/*-----------------------------------------------------------
  5) Actualización de estado CRM (solo si logueado)
-----------------------------------------------------------*/
if (
  $loggedIn &&
  isset($_POST['action']) &&
  $_POST['action'] === 'update_estado'
) {
  $id_registro = $_POST['id_registro'] ?? null;
  $estado      = $_POST['estado']      ?? null;

  if ($id_registro !== null && isset($estadosCRM[$estado])) {
    $color = $estadosCRM[$estado];

    $stmt = $c->prepare("
      INSERT INTO crm_estados_inscripciones (id_registro, estado, color)
      VALUES (?, ?, ?)
      ON DUPLICATE KEY UPDATE
        estado = VALUES(estado),
        color  = VALUES(color)
    ");
    if ($stmt) {
      $stmt->bind_param("sss", $id_registro, $estado, $color);
      $stmt->execute();
      $stmt->close();
    }
  }
}

/*-----------------------------------------------------------
  6) Estados actuales por registro (para pintar la tabla)
-----------------------------------------------------------*/
$estadosActuales = [];
if ($loggedIn) {
  $resEstados = $c->query("SELECT id_registro, estado, color FROM crm_estados_inscripciones");
  if ($resEstados) {
    while ($row = $resEstados->fetch_assoc()) {
      $estadosActuales[$row['id_registro']] = $row;
    }
  }
}

?>
<!doctype html>
<html lang="es">
  <head>
    <title>Panel de administración</title>
    <meta charset="utf-8">
    <style>
      :root{
        --primary: crimson;
        --primary-light: #ff8fa0;
        --bg: #f2f2f2;
        --text: #333;
        --border: #ddd;
      }

      *{
        box-sizing:border-box;
        margin:0;
        padding:0;
      }

      html, body{
        height:100%;
        font-family: "Segoe UI", sans-serif;
        color: var(--text);
        background: var(--bg);
      }

      body{
        display:flex;
        align-items:stretch;
      }

      /*---------------- LOGIN ----------------*/
      .login-wrapper{
        width:100%;
        display:flex;
        justify-content:center;
        align-items:center;
        padding:40px;
      }
      .login-card{
        background:white;
        padding:30px 40px;
        width:360px;
        border-radius:10px;
        box-shadow:0 4px 15px rgba(0,0,0,0.1);
        border-top:8px solid var(--primary);
      }
      .login-card h2{
        margin-bottom:20px;
        color:var(--primary);
        font-size:1.4em;
      }
      .login-card .form-group{
        margin-bottom:15px;
        display:flex;
        flex-direction:column;
        gap:6px;
      }
      .login-card label{
        font-size:0.95em;
        font-weight:600;
        color:var(--primary);
      }
      .login-card input[type="text"],
      .login-card input[type="password"]{
        padding:10px 12px;
        border-radius:6px;
        border:1px solid var(--border);
        font-size:1em;
      }
      .login-card input[type="submit"]{
        margin-top:10px;
        width:100%;
        padding:12px;
        border:none;
        border-radius:6px;
        background:var(--primary);
        color:white;
        font-size:1em;
        cursor:pointer;
      }
      .login-error{
        margin-bottom:10px;
        padding:8px 10px;
        border-radius:6px;
        background:#ffe6e6;
        border:1px solid #ffb3b3;
        font-size:0.9em;
        color:#b30000;
      }

      /*---------------- LAYOUT ADMIN ----------------*/
      nav{
        width:240px;
        background: var(--primary);
        padding:20px;
        display:flex;
        flex-direction:column;
        gap:10px;
        box-shadow: 4px 0 12px rgba(0,0,0,0.1);
      }

      nav h2{
        color:white;
        margin-bottom:15px;
        font-size:1.1em;
        font-weight:700;
      }

      nav button{
        background:white;
        border:none;
        padding:10px 14px;
        border-radius:999px;
        cursor:pointer;
        font-size:0.95em;
        text-align:left;
        transition: transform 0.15s, box-shadow 0.15s, background 0.15s;
      }

      nav button:hover{
        transform: translateY(-1px);
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        background:#fff5f7;
      }

      main{
        flex:1;
        padding:30px 40px;
        display:flex;
        flex-direction:column;
        gap:15px;
      }

      header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:10px;
      }

      header h1{
        font-size:1.4em;
        color:var(--primary);
      }

      .user-actions{
        display:flex;
        gap:10px;
        align-items:center;
        font-size:0.9em;
      }
      .logout-link{
        padding:6px 10px;
        border-radius:999px;
        border:1px solid var(--primary-light);
        color:var(--primary);
        text-decoration:none;
        font-size:0.85em;
        background:white;
      }

      .table-card{
        background:white;
        border-radius:10px;
        padding:20px 24px;
        box-shadow:0 4px 15px rgba(0,0,0,0.08);
        border-top:8px solid var(--primary);
      }

      .table-card h3{
        margin-bottom:10px;
        font-size:1.1em;
        color:var(--primary);
      }

      .table-card p.description{
        margin-bottom:10px;
        font-size:0.9em;
        color:#666;
      }

      table{
        width:100%;
        border-collapse:collapse;
        font-size:0.9em;
      }

      thead th{
        text-align:left;
        padding:10px 8px;
        border-bottom:2px solid var(--primary-light);
        color:var(--primary);
        font-weight:600;
      }

      tbody td{
        padding:8px 8px;
        border-bottom:1px solid var(--border);
        vertical-align:middle;
      }

      tbody tr:nth-child(even){
        background:#fafafa;
      }

      tbody tr:hover{
        background:#ffeef2;
      }

      .estado-pill{
        display:inline-block;
        padding:4px 10px;
        border-radius:999px;
        border:1px solid var(--border);
        font-size:0.8em;
        background:#f9f9f9;
      }
      .estado-pill--vacio{
        color:#999;
        border-style:dashed;
      }

      .form-estado{
        display:flex;
        gap:6px;
        align-items:center;
      }
      .form-estado select{
        padding:4px 6px;
        border-radius:4px;
        border:1px solid var(--border);
        font-size:0.85em;
      }
      .btn-estado{
        padding:4px 8px;
        border-radius:4px;
        border:none;
        background:var(--primary);
        color:white;
        font-size:0.8em;
        cursor:pointer;
      }

      @media (max-width: 900px){
        body{
          flex-direction:column;
        }
        nav{
          width:100%;
          flex-direction:row;
          flex-wrap:wrap;
          box-shadow:none;
        }
        nav h2{
          width:100%;
        }
        main{
          padding:20px;
        }
      }
    </style>
  </head>
  <body>

  <?php if (!$loggedIn): ?>

    <!-- ------------------ VISTA LOGIN ------------------ -->
    <div class="login-wrapper">
      <form method="post" class="login-card">
        <h2>Acceso al panel</h2>

        <?php if ($login_error !== ""): ?>
          <div class="login-error">
            <?= htmlspecialchars($login_error, ENT_QUOTES, 'UTF-8'); ?>
          </div>
        <?php endif; ?>

        <div class="form-group">
          <label for="usuario">Usuario</label>
          <input type="text" name="usuario" id="usuario" autocomplete="username">
        </div>

        <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="password" name="password" id="password" autocomplete="current-password">
        </div>

        <input type="hidden" name="action" value="login">
        <input type="submit" value="Entrar">
      </form>
    </div>

  <?php else: ?>

    <!-- ------------------ PANEL ADMIN ------------------ -->
    <nav>
      <h2>Menú</h2>
      <button>Enlace 1</button>
      <button>Enlace 2</button>
      <button>Enlace 3</button>
    </nav>
    <main>
      <header>
        <h1>Listado de inscripciones</h1>
        <div class="user-actions">
          <span>Conectado como <strong>jocarsa</strong></span>
          <a class="logout-link" href="?logout=1">Cerrar sesión</a>
        </div>
      </header>

      <section class="table-card">
        <h3>Tabla: inscripciones</h3>
        <p class="description">
          Registros actuales en la tabla <strong>inscripciones</strong> de la base de datos
          <strong>training_center</strong>. Puede asignar un estado CRM a cada registro.
        </p>

        <table>
          <thead>
            <tr>
              <?php
              /* COLUMNAS CON SUS COMENTARIOS */
              $r = $c->query("
                SELECT COLUMN_NAME, COLUMN_TYPE, COLUMN_KEY, COLUMN_DEFAULT, COLUMN_COMMENT
                FROM information_schema.columns
                WHERE table_schema='training_center'
                  AND table_name='inscripciones'
              ");

              while($f = $r->fetch_assoc()) {
                echo '<th>'.htmlspecialchars($f['COLUMN_NAME'], ENT_QUOTES, 'UTF-8').'</th>';
              }

              // Columnas extra para estado CRM
              echo '<th>Estado CRM</th>';
              echo '<th>Acciones</th>';
              ?>
            </tr>
          </thead>
          <tbody>
            <?php
              $r = $c->query("SELECT * FROM inscripciones;");

              while($f = $r->fetch_assoc()) {
                // ID del registro basado en la columna PK detectada (si existe)
                $idRegistro = null;
                if ($primaryKeyColumn !== null && isset($f[$primaryKeyColumn])) {
                  $idRegistro = (string)$f[$primaryKeyColumn];
                }

                echo '<tr>';

                // Mostrar todas las columnas originales
                foreach($f as $clave=>$valor){
                  echo '<td>'.htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8').'</td>';
                }

                // Columna "Estado CRM" (pastilla de color)
                echo '<td>';
                if ($idRegistro !== null && isset($estadosActuales[$idRegistro])) {
                  $estadoRow = $estadosActuales[$idRegistro];
                  $estadoTxt = htmlspecialchars($estadoRow['estado'], ENT_QUOTES, 'UTF-8');
                  $colorTxt  = htmlspecialchars($estadoRow['color'],  ENT_QUOTES, 'UTF-8');

                  echo '<span class="estado-pill" style="background:'.$colorTxt.'20; border-color:'.$colorTxt.'; color:'.$colorTxt.';">';
                  echo $estadoTxt;
                  echo '</span>';
                } else {
                  echo '<span class="estado-pill estado-pill--vacio">Sin estado</span>';
                }
                echo '</td>';

                // Columna "Acciones" (selector y botón)
                echo '<td>';
                if ($idRegistro !== null) {
                  echo '<form method="post" class="form-estado">';
                  echo '<input type="hidden" name="action" value="update_estado">';
                  echo '<input type="hidden" name="id_registro" value="'.htmlspecialchars($idRegistro, ENT_QUOTES, 'UTF-8').'">';
                  echo '<select name="estado">';
                  foreach ($estadosCRM as $nombreEstado => $colorEstado) {
                    $selected = (
                      $idRegistro !== null &&
                      isset($estadosActuales[$idRegistro]) &&
                      $estadosActuales[$idRegistro]['estado'] === $nombreEstado
                    ) ? ' selected' : '';
                    echo '<option value="'.htmlspecialchars($nombreEstado, ENT_QUOTES, 'UTF-8').'"'.$selected.'>';
                    echo htmlspecialchars($nombreEstado, ENT_QUOTES, 'UTF-8');
                    echo '</option>';
                  }
                  echo '</select>';
                  echo '<button type="submit" class="btn-estado">Guardar</button>';
                  echo '</form>';
                }
                echo '</td>';

                echo '</tr>';
              }
            ?>
          </tbody>
        </table>
      </section>
    </main>

  <?php endif; ?>

  </body>
</html>
```

### informes y correo

```
<?php
session_start();

// Conexión a la base de datos (una sola vez, al inicio del archivo)
$c = new mysqli("localhost","training_center","training_center","training_center");
if ($c->connect_error) {
  die("Error de conexión: " . $c->connect_error);
}

/*-----------------------------------------------------------
  1) Tabla auxiliar para estados CRM (NO toca inscripciones)
-----------------------------------------------------------*/
$c->query("
  CREATE TABLE IF NOT EXISTS crm_estados_inscripciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_registro VARCHAR(255) NOT NULL UNIQUE,
    estado VARCHAR(50) NOT NULL,
    color VARCHAR(20) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
");

/*-----------------------------------------------------------
  2) Estados típicos de CRM (en español) + colores
-----------------------------------------------------------*/
$estadosCRM = [
  'Nuevo'             => '#3498db', // azul
  'Contactado'        => '#9b59b6', // violeta
  'En seguimiento'    => '#f1c40f', // amarillo
  'Cualificado'       => '#2ecc71', // verde
  'No interesado'     => '#95a5a6', // gris
  'Ganado'            => '#27ae60', // verde fuerte
  'Perdido'           => '#e74c3c', // rojo
];

/*-----------------------------------------------------------
  3) Detectar columna PRIMARY KEY de inscripciones
-----------------------------------------------------------*/
$primaryKeyColumn = null;
$pkResult = $c->query("
  SELECT COLUMN_NAME 
  FROM information_schema.columns
  WHERE table_schema = 'training_center'
    AND table_name   = 'inscripciones'
    AND COLUMN_KEY   = 'PRI'
  LIMIT 1;
");
if ($pkResult && $pkResult->num_rows > 0) {
  $primaryKeyColumn = $pkResult->fetch_assoc()['COLUMN_NAME'];
}

/*-----------------------------------------------------------
  4) Detectar columna de email de inscripciones
-----------------------------------------------------------*/
$emailColumn = null;
$emailColResult = $c->query("
  SELECT COLUMN_NAME
  FROM information_schema.columns
  WHERE table_schema='training_center'
    AND table_name='inscripciones'
    AND (
      COLUMN_NAME LIKE '%mail%' OR
      COLUMN_NAME LIKE '%email%' OR
      COLUMN_NAME LIKE '%correo%'
    )
  LIMIT 1;
");
if ($emailColResult && $emailColResult->num_rows > 0) {
  $emailColumn = $emailColResult->fetch_assoc()['COLUMN_NAME'];
}

/*-----------------------------------------------------------
  5) Configuración de correo (SMTP + IMAP)
-----------------------------------------------------------*/
define('CRM_MAIL_USER', 'python@jocarsa.com');
define('CRM_MAIL_PASS', 'TAME123$');
define('CRM_SMTP_HOST', 'smtp.ionos.es');
define('CRM_SMTP_PORT', 587); // normalmente 587 (STARTTLS) en IONOS
define('CRM_IMAP_MAILBOX', '{imap.ionos.es:993/imap/ssl}INBOX');

/*-----------------------------------------------------------
  6) Función: enviar correo via SMTP (sin librerías externas)
-----------------------------------------------------------*/
function crm_send_email_smtp($to, $subject, $body, &$errorMsg) {
  $errorMsg = '';
  $smtpHost = CRM_SMTP_HOST;
  $smtpPort = CRM_SMTP_PORT;
  $username = CRM_MAIL_USER;
  $password = CRM_MAIL_PASS;
  $from     = CRM_MAIL_USER;
  $fromName = 'CRM Training Center';

  $socket = @fsockopen($smtpHost, $smtpPort, $errno, $errstr, 30);
  if (!$socket) {
    $errorMsg = "No se pudo conectar al servidor SMTP: $errstr ($errno)";
    return false;
  }

  // Leer banner inicial (220 ...)
  $resp = fgets($socket, 515);
  if (substr($resp, 0, 3) != '220') {
    $errorMsg = "Respuesta inesperada del servidor SMTP: $resp";
    fclose($socket);
    return false;
  }

  // lector de respuestas multilínea tipo 250-... / 250 ...
  $readMultiline = function($expectedCode) use ($socket, &$errorMsg) {
    $response = '';
    while (($line = fgets($socket, 515)) !== false) {
      $response .= $line;
      // si el código no coincide con el esperado, error
      if (substr($line, 0, 3) != $expectedCode) {
        $errorMsg = "Respuesta inesperada del servidor SMTP: $line";
        return false;
      }
      // si el cuarto carácter no es '-', esta es la última línea
      if (strlen($line) < 4 || $line[3] != '-') {
        break;
      }
    }
    return $response;
  };

  // comandos de una sola línea (334, 235, 250, 354 ...)
  $sendCmdOneLine = function($cmd, $expectedCode) use ($socket, &$errorMsg) {
    fputs($socket, $cmd);
    $resp = fgets($socket, 515);
    if (substr($resp, 0, 3) != $expectedCode) {
      $errorMsg = "Error SMTP al enviar '$cmd': $resp";
      return false;
    }
    return true;
  };

  // 1) EHLO inicial (sin TLS)
  fputs($socket, "EHLO localhost\r\n");
  $ehloResp = $readMultiline("250");
  if ($ehloResp === false) {
    fclose($socket);
    return false;
  }

  // 2) STARTTLS
  fputs($socket, "STARTTLS\r\n");
  $resp = fgets($socket, 515);
  if (substr($resp, 0, 3) != '220') {
    $errorMsg = "Fallo al iniciar STARTTLS: $resp";
    fclose($socket);
    return false;
  }

  // 3) Activar cifrado TLS en el socket
  // (requiere extensión openssl habilitada en PHP)
  $cryptoOk = @stream_socket_enable_crypto(
    $socket,
    true,
    STREAM_CRYPTO_METHOD_TLS_CLIENT
  );
  if (!$cryptoOk) {
    $errorMsg = "No se pudo activar el cifrado TLS en el socket SMTP.";
    fclose($socket);
    return false;
  }

  // 4) EHLO de nuevo, ahora ya bajo TLS
  fputs($socket, "EHLO localhost\r\n");
  $ehloResp2 = $readMultiline("250");
  if ($ehloResp2 === false) {
    fclose($socket);
    return false;
  }

  // 5) Autenticación AUTH LOGIN
  if (!$sendCmdOneLine("AUTH LOGIN\r\n", "334")) {
    fclose($socket);
    return false;
  }

  if (!$sendCmdOneLine(base64_encode($username) . "\r\n", "334")) {
    fclose($socket);
    return false;
  }

  if (!$sendCmdOneLine(base64_encode($password) . "\r\n", "235")) {
    fclose($socket);
    return false;
  }

  // 6) MAIL FROM
  if (!$sendCmdOneLine("MAIL FROM:<$from>\r\n", "250")) {
    fclose($socket);
    return false;
  }

  // 7) RCPT TO
  if (!$sendCmdOneLine("RCPT TO:<$to>\r\n", "250")) {
    fclose($socket);
    return false;
  }

  // 8) DATA
  if (!$sendCmdOneLine("DATA\r\n", "354")) {
    fclose($socket);
    return false;
  }

  // Cabeceras + cuerpo
  $headers  = "From: " . $fromName . " <" . $from . ">\r\n";
  $headers .= "To: <$to>\r\n";
  $headers .= "Subject: " . $subject . "\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
  $headers .= "Content-Transfer-Encoding: 8bit\r\n";
  $headers .= "\r\n";

  $data = $headers . $body . "\r\n.\r\n";

  fputs($socket, $data);
  $resp = fgets($socket, 515);
  if (substr($resp, 0, 3) != '250') {
    $errorMsg = "Error al completar el envío: $resp";
    fclose($socket);
    return false;
  }

  fputs($socket, "QUIT\r\n");
  fclose($socket);
  return true;
}



/*-----------------------------------------------------------
  7) Función: obtener comunicaciones por IMAP para un contacto
-----------------------------------------------------------*/
function crm_fetch_emails_for_contact($contactEmail, $limit = 20) {
  $result = [
    'sent'     => [],
    'received' => [],
    'error'    => null
  ];

  if (!function_exists('imap_open')) {
    $result['error'] = "La extensión IMAP de PHP no está habilitada.";
    return $result;
  }

  $mailbox  = CRM_IMAP_MAILBOX;   // p.ej. '{imap.ionos.es:993/imap/ssl}INBOX'
  $user     = CRM_MAIL_USER;
  $password = CRM_MAIL_PASS;

  $inbox = @imap_open($mailbox, $user, $password);
  if (!$inbox) {
    $result['error'] = imap_last_error();
    return $result;
  }

  // --- Búsqueda separada FROM y TO, sin usar OR ---
  // (asumiendo que el email solo tiene ASCII, no hace falta charset extra)
  $safeEmail = str_replace('"', '\"', $contactEmail);

  $emailsIds = [];

  // Mensajes donde el contacto es REMITENTE
  $fromIds = imap_search($inbox, 'FROM "' . $safeEmail . '"');
  if ($fromIds !== false) {
    $emailsIds = array_merge($emailsIds, $fromIds);
  }

  // Mensajes donde el contacto es DESTINATARIO
  $toIds = imap_search($inbox, 'TO "' . $safeEmail . '"');
  if ($toIds !== false) {
    $emailsIds = array_merge($emailsIds, $toIds);
  }

  if (empty($emailsIds)) {
    // Nada encontrado: devolvemos vacío sin error
    imap_close($inbox);
    return $result;
  }

  // Eliminar duplicados, ordenar por más recientes
  $emailsIds = array_values(array_unique($emailsIds));
  rsort($emailsIds);
  $emailsIds = array_slice($emailsIds, 0, $limit);

  $ourAddress = strtolower(CRM_MAIL_USER);

  foreach ($emailsIds as $num) {

    $overview = imap_fetch_overview($inbox, $num, 0);
    if (!$overview) continue;
    $ov = $overview[0];

    $header = imap_headerinfo($inbox, $num);

    $from = isset($header->fromaddress) ? $header->fromaddress : ($ov->from ?? '');
    $to   = isset($header->toaddress)   ? $header->toaddress   : ($ov->to   ?? '');

    $subject = isset($ov->subject) ? imap_utf8($ov->subject) : '';
    $date    = isset($ov->date)    ? $ov->date : '';

    // Cuerpo (intentamos la parte 1, texto)
    $body = imap_fetchbody($inbox, $num, 1);
    if (!$body) $body = '';
    $body = imap_qprint($body);
    $snippet = trim($body);
    if (function_exists('mb_substr')) {
      $snippet = mb_substr($snippet, 0, 200);
    } else {
      $snippet = substr($snippet, 0, 200);
    }

    $entry = [
      'subject' => $subject,
      'date'    => $date,
      'from'    => $from,
      'to'      => $to,
      'snippet' => $snippet
    ];

    $fromLower = strtolower($from);

    // Si el remitente somos nosotros, lo marcamos como ENVIADO; si no, RECIBIDO
    if (strpos($fromLower, $ourAddress) !== false) {
      $result['sent'][] = $entry;
    } else {
      $result['received'][] = $entry;
    }
  }

  imap_close($inbox);
  return $result;
}


/*-----------------------------------------------------------
  8) Lógica de login / logout
-----------------------------------------------------------*/
$login_error = "";

if (isset($_GET['logout'])) {
  session_destroy();
  header("Location: " . $_SERVER['PHP_SELF']);
  exit;
}

if (isset($_POST['action']) && $_POST['action'] === 'login') {
  $usuario  = $_POST['usuario']  ?? '';
  $password = $_POST['password'] ?? '';

  if ($usuario === 'jocarsa' && $password === 'jocarsa') {
    $_SESSION['admin_logged'] = true;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
  } else {
    $login_error = "Usuario o contraseña incorrectos.";
  }
}

$loggedIn = isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] === true;

/*-----------------------------------------------------------
  9) Actualización de estado CRM (solo si logueado)
-----------------------------------------------------------*/
if (
  $loggedIn &&
  isset($_POST['action']) &&
  $_POST['action'] === 'update_estado'
) {
  $id_registro = $_POST['id_registro'] ?? null;
  $estado      = $_POST['estado']      ?? null;

  if ($id_registro !== null && isset($estadosCRM[$estado])) {
    $color = $estadosCRM[$estado];

    $stmt = $c->prepare("
      INSERT INTO crm_estados_inscripciones (id_registro, estado, color)
      VALUES (?, ?, ?)
      ON DUPLICATE KEY UPDATE
        estado = VALUES(estado),
        color  = VALUES(color)
    ");
    if ($stmt) {
      $stmt->bind_param("sss", $id_registro, $estado, $color);
      $stmt->execute();
      $stmt->close();
    }
  }
}

/*-----------------------------------------------------------
  10) Envío de email desde el informe
-----------------------------------------------------------*/
$emailSendMessage = "";

if (
  $loggedIn &&
  isset($_POST['action']) &&
  $_POST['action'] === 'send_email'
) {
  $to      = $_POST['to']      ?? '';
  $subject = $_POST['subject'] ?? '';
  $body    = $_POST['body']    ?? '';

  if ($to && $subject && $body) {
    $errorMsg = '';
    $ok = crm_send_email_smtp($to, $subject, $body, $errorMsg);
    if ($ok) {
      $emailSendMessage = "Mensaje enviado correctamente.";
    } else {
      $emailSendMessage = "Error al enviar el mensaje: " . htmlspecialchars($errorMsg, ENT_QUOTES, 'UTF-8');
    }
  } else {
    $emailSendMessage = "Por favor, rellena todos los campos del mensaje.";
  }
}

/*-----------------------------------------------------------
  11) Estados actuales por registro (para pintar la tabla)
-----------------------------------------------------------*/
$estadosActuales = [];
if ($loggedIn) {
  $resEstados = $c->query("SELECT id_registro, estado, color FROM crm_estados_inscripciones");
  if ($resEstados) {
    while ($row = $resEstados->fetch_assoc()) {
      $estadosActuales[$row['id_registro']] = $row;
    }
  }
}

/*-----------------------------------------------------------
  12) ID de informe (vista detalle de inscripción)
-----------------------------------------------------------*/
$viewId = null;
if ($loggedIn && isset($_GET['view'])) {
  $viewId = $_GET['view'];
}

?>
<!doctype html>
<html lang="es">
  <head>
    <title>Panel de administración</title>
    <meta charset="utf-8">
    <style>
      :root{
        --primary: crimson;
        --primary-light: #ff8fa0;
        --bg: #f2f2f2;
        --text: #333;
        --border: #ddd;
      }

      *{
        box-sizing:border-box;
        margin:0;
        padding:0;
      }

      html, body{
        height:100%;
        font-family: "Segoe UI", sans-serif;
        color: var(--text);
        background: var(--bg);
      }

      body{
        display:flex;
        align-items:stretch;
      }

      /*---------------- LOGIN ----------------*/
      .login-wrapper{
        width:100%;
        display:flex;
        justify-content:center;
        align-items:center;
        padding:40px;
      }
      .login-card{
        background:white;
        padding:30px 40px;
        width:360px;
        border-radius:10px;
        box-shadow:0 4px 15px rgba(0,0,0,0.1);
        border-top:8px solid var(--primary);
      }
      .login-card h2{
        margin-bottom:20px;
        color:var(--primary);
        font-size:1.4em;
      }
      .login-card .form-group{
        margin-bottom:15px;
        display:flex;
        flex-direction:column;
        gap:6px;
      }
      .login-card label{
        font-size:0.95em;
        font-weight:600;
        color:var(--primary);
      }
      .login-card input[type="text"],
      .login-card input[type="password"]{
        padding:10px 12px;
        border-radius:6px;
        border:1px solid var(--border);
        font-size:1em;
      }
      .login-card input[type="submit"]{
        margin-top:10px;
        width:100%;
        padding:12px;
        border:none;
        border-radius:6px;
        background:var(--primary);
        color:white;
        font-size:1em;
        cursor:pointer;
      }
      .login-error{
        margin-bottom:10px;
        padding:8px 10px;
        border-radius:6px;
        background:#ffe6e6;
        border:1px solid #ffb3b3;
        font-size:0.9em;
        color:#b30000;
      }

      /*---------------- LAYOUT ADMIN ----------------*/
      nav{
        width:240px;
        background: var(--primary);
        padding:20px;
        display:flex;
        flex-direction:column;
        gap:10px;
        box-shadow: 4px 0 12px rgba(0,0,0,0.1);
      }

      nav h2{
        color:white;
        margin-bottom:15px;
        font-size:1.1em;
        font-weight:700;
      }

      nav button{
        background:white;
        border:none;
        padding:10px 14px;
        border-radius:999px;
        cursor:pointer;
        font-size:0.95em;
        text-align:left;
        transition: transform 0.15s, box-shadow 0.15s, background 0.15s;
      }

      nav button:hover{
        transform: translateY(-1px);
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        background:#fff5f7;
      }

      main{
        flex:1;
        padding:30px 40px;
        display:flex;
        flex-direction:column;
        gap:15px;
      }

      header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:10px;
      }

      header h1{
        font-size:1.4em;
        color:var(--primary);
      }

      .user-actions{
        display:flex;
        gap:10px;
        align-items:center;
        font-size:0.9em;
      }
      .logout-link{
        padding:6px 10px;
        border-radius:999px;
        border:1px solid var(--primary-light);
        color:var(--primary);
        text-decoration:none;
        font-size:0.85em;
        background:white;
      }
      .back-link{
        padding:6px 10px;
        border-radius:999px;
        border:1px solid var(--border);
        color:#555;
        text-decoration:none;
        font-size:0.8em;
        background:white;
        margin-right:10px;
      }

      .table-card,
      .detail-card{
        background:white;
        border-radius:10px;
        padding:20px 24px;
        box-shadow:0 4px 15px rgba(0,0,0,0.08);
        border-top:8px solid var(--primary);
      }

      .table-card h3,
      .detail-card h3{
        margin-bottom:10px;
        font-size:1.1em;
        color:var(--primary);
      }

      .table-card p.description,
      .detail-card p.description{
        margin-bottom:10px;
        font-size:0.9em;
        color:#666;
      }

      table{
        width:100%;
        border-collapse:collapse;
        font-size:0.9em;
      }

      thead th{
        text-align:left;
        padding:10px 8px;
        border-bottom:2px solid var(--primary-light);
        color:var(--primary);
        font-weight:600;
      }

      tbody td{
        padding:8px 8px;
        border-bottom:1px solid var(--border);
        vertical-align:middle;
      }

      tbody tr:nth-child(even){
        background:#fafafa;
      }

      tbody tr:hover{
        background:#ffeef2;
      }

      .estado-pill{
        display:inline-block;
        padding:4px 10px;
        border-radius:999px;
        border:1px solid var(--border);
        font-size:0.8em;
        background:#f9f9f9;
      }
      .estado-pill--vacio{
        color:#999;
        border-style:dashed;
      }

      .form-estado{
        display:flex;
        gap:6px;
        align-items:center;
      }
      .form-estado select{
        padding:4px 6px;
        border-radius:4px;
        border:1px solid var(--border);
        font-size:0.85em;
      }
      .btn-estado{
        padding:4px 8px;
        border-radius:4px;
        border:none;
        background:var(--primary);
        color:white;
        font-size:0.8em;
        cursor:pointer;
      }

      .btn-informe{
        padding:4px 8px;
        border-radius:4px;
        border:none;
        background:#34495e;
        color:white;
        font-size:0.8em;
        cursor:pointer;
        text-decoration:none;
        display:inline-block;
      }

      /* Detalle */
      .detail-row-table{
        width:100%;
        border-collapse:collapse;
        margin-bottom:20px;
      }
      .detail-row-table th,
      .detail-row-table td{
        padding:6px 8px;
        border-bottom:1px solid var(--border);
        text-align:left;
      }
      .detail-row-table th{
        width:30%;
        color:var(--primary);
      }

      .email-section{
        margin-top:20px;
        display:grid;
        grid-template-columns:1.2fr 1.8fr;
        gap:20px;
      }
      .email-form-card,
      .email-log-card{
        background:#fafafa;
        border-radius:8px;
        padding:15px 18px;
        border:1px solid #e5e5e5;
      }
      .email-form-card h4,
      .email-log-card h4{
        margin-bottom:8px;
        color:#444;
      }
      .email-form-card .form-group{
        margin-bottom:10px;
        display:flex;
        flex-direction:column;
        gap:4px;
      }
      .email-form-card label{
        font-size:0.85em;
        font-weight:600;
      }
      .email-form-card input[type="text"],
      .email-form-card textarea{
        padding:8px 10px;
        border-radius:4px;
        border:1px solid var(--border);
        font-size:0.9em;
        resize:vertical;
      }
      .email-form-card textarea{
        min-height:120px;
      }
      .email-form-card input[type="submit"]{
        margin-top:8px;
        padding:8px 12px;
        border:none;
        border-radius:4px;
        background:var(--primary);
        color:white;
        font-size:0.9em;
        cursor:pointer;
      }
      .email-status-msg{
        margin-bottom:10px;
        padding:6px 8px;
        border-radius:6px;
        font-size:0.85em;
      }
      .email-status-ok{
        background:#e7f7ec;
        border:1px solid #9dd7b1;
        color:#217346;
      }
      .email-status-error{
        background:#ffe6e6;
        border:1px solid #ffb3b3;
        color:#b30000;
      }

      .mail-list{
        max-height:280px;
        overflow:auto;
        font-size:0.86em;
      }
      .mail-item{
        padding:8px 0;
        border-bottom:1px solid #e3e3e3;
      }
      .mail-item:last-child{
        border-bottom:none;
      }
      .mail-item strong{
        color:#333;
      }
      .mail-meta{
        font-size:0.8em;
        color:#777;
        margin-bottom:2px;
      }
      .mail-snippet{
        font-size:0.85em;
        color:#555;
      }

      @media (max-width: 900px){
        body{
          flex-direction:column;
        }
        nav{
          width:100%;
          flex-direction:row;
          flex-wrap:wrap;
          box-shadow:none;
        }
        nav h2{
          width:100%;
        }
        main{
          padding:20px;
        }
        .email-section{
          grid-template-columns:1fr;
        }
      }
    </style>
  </head>
  <body>

  <?php if (!$loggedIn): ?>

    <!-- ------------------ VISTA LOGIN ------------------ -->
    <div class="login-wrapper">
      <form method="post" class="login-card">
        <h2>Acceso al panel</h2>

        <?php if ($login_error !== ""): ?>
          <div class="login-error">
            <?= htmlspecialchars($login_error, ENT_QUOTES, 'UTF-8'); ?>
          </div>
        <?php endif; ?>

        <div class="form-group">
          <label for="usuario">Usuario</label>
          <input type="text" name="usuario" id="usuario" autocomplete="username">
        </div>

        <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="password" name="password" id="password" autocomplete="current-password">
        </div>

        <input type="hidden" name="action" value="login">
        <input type="submit" value="Entrar">
      </form>
    </div>

  <?php else: ?>

    <!-- ------------------ PANEL ADMIN ------------------ -->
    <nav>
      <h2>Menú</h2>
      <button>Enlace 1</button>
      <button>Enlace 2</button>
      <button>Enlace 3</button>
    </nav>
    <main>
      <?php
        $title = $viewId ? "Informe de inscripción" : "Listado de inscripciones";
      ?>
      <header>
        <div style="display:flex; align-items:center; gap:8px;">
          <?php if ($viewId): ?>
            <a href="<?= htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8'); ?>" class="back-link">← Volver al listado</a>
          <?php endif; ?>
          <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h1>
        </div>
        <div class="user-actions">
          <span>Conectado como <strong>jocarsa</strong></span>
          <a class="logout-link" href="?logout=1">Cerrar sesión</a>
        </div>
      </header>

      <?php if ($viewId && $primaryKeyColumn !== null): ?>

        <?php
          // Cargar la fila concreta
          $filaDetalle = null;
          $stmt = $c->prepare("SELECT * FROM inscripciones WHERE $primaryKeyColumn = ? LIMIT 1");
          if ($stmt) {
            $stmt->bind_param("s", $viewId);
            $stmt->execute();
            $result = $stmt->get_result();
            $filaDetalle = $result->fetch_assoc();
            $stmt->close();
          }
        ?>

        <?php if ($filaDetalle): ?>
          <?php
            // Determinar email de contacto (si existe columna de email)
            $contactEmail = null;
            if ($emailColumn !== null && isset($filaDetalle[$emailColumn])) {
              $contactEmail = $filaDetalle[$emailColumn];
            }

            // Obtener comunicaciones por email si tenemos correo
            $commReport = null;
            if ($contactEmail) {
              $commReport = crm_fetch_emails_for_contact($contactEmail, 20);
            }
          ?>

          <section class="detail-card">
            <h3>Datos de la inscripción (ID: <?= htmlspecialchars($viewId, ENT_QUOTES, 'UTF-8'); ?>)</h3>
            <p class="description">
              Detalle completo del registro seleccionado en la tabla
              <strong>inscripciones</strong>, junto con el historial de comunicaciones
              por correo electrónico asociado al contacto.
            </p>

            <table class="detail-row-table">
              <tbody>
                <?php foreach ($filaDetalle as $campo => $valor): ?>
                  <tr>
                    <th><?= htmlspecialchars($campo, ENT_QUOTES, 'UTF-8'); ?></th>
                    <td><?= htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8'); ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

            <div class="email-section">
              <div class="email-form-card">
                <h4>Enviar mensaje al contacto</h4>

                <?php if ($emailSendMessage): ?>
                  <div class="email-status-msg <?= (strpos($emailSendMessage, 'correctamente') !== false) ? 'email-status-ok' : 'email-status-error'; ?>">
                    <?= $emailSendMessage; ?>
                  </div>
                <?php endif; ?>

                <?php if ($contactEmail): ?>
                  <p style="font-size:0.85em; margin-bottom:8px;">
                    Correo del contacto:
                    <strong><?= htmlspecialchars($contactEmail, ENT_QUOTES, 'UTF-8'); ?></strong><br>
                    Remitente usado: <code><?= htmlspecialchars(CRM_MAIL_USER, ENT_QUOTES, 'UTF-8'); ?></code>
                  </p>

                  <form method="post" action="?view=<?= urlencode($viewId); ?>">
                    <div class="form-group">
                      <label for="subject">Asunto</label>
                      <input type="text" id="subject" name="subject">
                    </div>
                    <div class="form-group">
                      <label for="body">Mensaje</label>
                      <textarea id="body" name="body"></textarea>
                    </div>
                    <input type="hidden" name="to" value="<?= htmlspecialchars($contactEmail, ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="action" value="send_email">
                    <input type="submit" value="Enviar mensaje">
                  </form>
                <?php else: ?>
                  <p style="font-size:0.85em; color:#b30000;">
                    No se ha detectado ninguna columna de email para este registro.  
                    El envío de correos no está disponible.
                  </p>
                <?php endif; ?>
              </div>

              <div class="email-log-card">
                <h4>Comunicaciones por correo</h4>

                <?php if (!$contactEmail): ?>
                  <p style="font-size:0.85em; color:#555;">
                    No hay correo electrónico asociado a este registro.<br>
                    Por tanto, no se puede generar el informe de comunicaciones.
                  </p>
                <?php else: ?>
                  <?php if ($commReport && $commReport['error']): ?>
                    <p style="font-size:0.85em; color:#b30000;">
                      Error al acceder al buzón IMAP:
                      <?= htmlspecialchars($commReport['error'], ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                  <?php else: ?>
                    <div class="mail-list">
                      <?php
                        $sent     = $commReport ? $commReport['sent']     : [];
                        $received = $commReport ? $commReport['received'] : [];
                      ?>

                      <p class="mail-meta">
                        Mensajes enviados: <?= count($sent); ?> |
                        Mensajes recibidos: <?= count($received); ?>
                      </p>

                      <?php if (empty($sent) && empty($received)): ?>
                        <p style="font-size:0.85em; color:#555;">
                          No se han encontrado mensajes relacionados con
                          <strong><?= htmlspecialchars($contactEmail, ENT_QUOTES, 'UTF-8'); ?></strong>.
                        </p>
                      <?php else: ?>

                        <?php if (!empty($sent)): ?>
                          <p style="margin-top:8px; font-weight:bold; font-size:0.9em;">Enviados (<?= count($sent); ?>)</p>
                          <?php foreach ($sent as $mail): ?>
                            <div class="mail-item">
                              <div class="mail-meta">
                                <strong>Asunto:</strong> <?= htmlspecialchars($mail['subject'], ENT_QUOTES, 'UTF-8'); ?><br>
                                <strong>Fecha:</strong> <?= htmlspecialchars($mail['date'], ENT_QUOTES, 'UTF-8'); ?><br>
                                <strong>De:</strong> <?= htmlspecialchars($mail['from'], ENT_QUOTES, 'UTF-8'); ?><br>
                                <strong>Para:</strong> <?= htmlspecialchars($mail['to'], ENT_QUOTES, 'UTF-8'); ?>
                              </div>
                              <div class="mail-snippet">
                                <?= nl2br(htmlspecialchars($mail['snippet'], ENT_QUOTES, 'UTF-8')); ?>
                              </div>
                            </div>
                          <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if (!empty($received)): ?>
                          <p style="margin-top:10px; font-weight:bold; font-size:0.9em;">Recibidos (<?= count($received); ?>)</p>
                          <?php foreach ($received as $mail): ?>
                            <div class="mail-item">
                              <div class="mail-meta">
                                <strong>Asunto:</strong> <?= htmlspecialchars($mail['subject'], ENT_QUOTES, 'UTF-8'); ?><br>
                                <strong>Fecha:</strong> <?= htmlspecialchars($mail['date'], ENT_QUOTES, 'UTF-8'); ?><br>
                                <strong>De:</strong> <?= htmlspecialchars($mail['from'], ENT_QUOTES, 'UTF-8'); ?><br>
                                <strong>Para:</strong> <?= htmlspecialchars($mail['to'], ENT_QUOTES, 'UTF-8'); ?>
                              </div>
                              <div class="mail-snippet">
                                <?= nl2br(htmlspecialchars($mail['snippet'], ENT_QUOTES, 'UTF-8')); ?>
                              </div>
                            </div>
                          <?php endforeach; ?>
                        <?php endif; ?>

                      <?php endif; ?>
                    </div>
                  <?php endif; ?>
                <?php endif; ?>
              </div>
            </div>
          </section>
        <?php else: ?>
          <section class="detail-card">
            <h3>Registro no encontrado</h3>
            <p class="description">
              No se ha podido localizar la inscripción con identificador
              <strong><?= htmlspecialchars($viewId, ENT_QUOTES, 'UTF-8'); ?></strong>.
            </p>
          </section>
        <?php endif; ?>

      <?php else: ?>

        <!-- -------- LISTADO GENERAL DE INSCRIPCIONES -------- -->
        <section class="table-card">
          <h3>Tabla: inscripciones</h3>
          <p class="description">
            Registros actuales en la tabla <strong>inscripciones</strong> de la base de datos
            <strong>training_center</strong>. Puede asignar un estado CRM a cada registro
            y acceder a un informe detallado por inscripción.
          </p>

          <table>
            <thead>
              <tr>
                <?php
                /* COLUMNAS CON SUS COMENTARIOS */
                $r = $c->query("
                  SELECT COLUMN_NAME, COLUMN_TYPE, COLUMN_KEY, COLUMN_DEFAULT, COLUMN_COMMENT
                  FROM information_schema.columns
                  WHERE table_schema='training_center'
                    AND table_name='inscripciones'
                ");

                $columnNames = [];
                while($f = $r->fetch_assoc()) {
                  $columnNames[] = $f['COLUMN_NAME'];
                  echo '<th>'.htmlspecialchars($f['COLUMN_NAME'], ENT_QUOTES, 'UTF-8').'</th>';
                }

                // Columnas extra para estado CRM y acciones
                echo '<th>Estado CRM</th>';
                echo '<th>Acciones</th>';
                ?>
              </tr>
            </thead>
            <tbody>
              <?php
                $r = $c->query("SELECT * FROM inscripciones;");

                while($f = $r->fetch_assoc()) {
                  // ID del registro basado en la columna PK detectada (si existe)
                  $idRegistro = null;
                  if ($primaryKeyColumn !== null && isset($f[$primaryKeyColumn])) {
                    $idRegistro = (string)$f[$primaryKeyColumn];
                  }

                  echo '<tr>';

                  // Mostrar todas las columnas originales
                  foreach($f as $clave=>$valor){
                    echo '<td>'.htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8').'</td>';
                  }

                  // Columna "Estado CRM" (pastilla de color)
                  echo '<td>';
                  if ($idRegistro !== null && isset($estadosActuales[$idRegistro])) {
                    $estadoRow = $estadosActuales[$idRegistro];
                    $estadoTxt = htmlspecialchars($estadoRow['estado'], ENT_QUOTES, 'UTF-8');
                    $colorTxt  = htmlspecialchars($estadoRow['color'],  ENT_QUOTES, 'UTF-8');

                    echo '<span class="estado-pill" style="background:'.$colorTxt.'20; border-color:'.$colorTxt.'; color:'.$colorTxt.';">';
                    echo $estadoTxt;
                    echo '</span>';
                  } else {
                    echo '<span class="estado-pill estado-pill--vacio">Sin estado</span>';
                  }
                  echo '</td>';

                  // Columna "Acciones" (selector estado + botón + informe)
                  echo '<td>';
                  if ($idRegistro !== null) {
                    // Formulario de estado
                    echo '<form method="post" class="form-estado" style="margin-bottom:4px;">';
                    echo '<input type="hidden" name="action" value="update_estado">';
                    echo '<input type="hidden" name="id_registro" value="'.htmlspecialchars($idRegistro, ENT_QUOTES, 'UTF-8').'">';
                    echo '<select name="estado">';
                    foreach ($estadosCRM as $nombreEstado => $colorEstado) {
                      $selected = (
                        $idRegistro !== null &&
                        isset($estadosActuales[$idRegistro]) &&
                        $estadosActuales[$idRegistro]['estado'] === $nombreEstado
                      ) ? ' selected' : '';
                      echo '<option value="'.htmlspecialchars($nombreEstado, ENT_QUOTES, 'UTF-8').'"'.$selected.'>';
                      echo htmlspecialchars($nombreEstado, ENT_QUOTES, 'UTF-8');
                      echo '</option>';
                    }
                    echo '</select>';
                    echo '<button type="submit" class="btn-estado">Guardar</button>';
                    echo '</form>';

                    // Enlace a informe
                    $urlInforme = htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8') . '?view=' . urlencode($idRegistro);
                    echo '<a class="btn-informe" href="'.$urlInforme.'">Informe</a>';
                  }
                  echo '</td>';

                  echo '</tr>';
                }
              ?>
            </tbody>
          </table>
        </section>

      <?php endif; ?>

    </main>

  <?php endif; ?>

  </body>
</html>
```

### arreglos correo

```
<?php
session_start();

// Conexión a la base de datos (una sola vez, al inicio del archivo)
$c = new mysqli("localhost","training_center","training_center","training_center");
if ($c->connect_error) {
  die("Error de conexión: " . $c->connect_error);
}

/*-----------------------------------------------------------
  1) Tabla auxiliar para estados CRM (NO toca inscripciones)
-----------------------------------------------------------*/
$c->query("
  CREATE TABLE IF NOT EXISTS crm_estados_inscripciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_registro VARCHAR(255) NOT NULL UNIQUE,
    estado VARCHAR(50) NOT NULL,
    color VARCHAR(20) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
");

/*-----------------------------------------------------------
  2) Estados típicos de CRM (en español) + colores
-----------------------------------------------------------*/
$estadosCRM = [
  'Nuevo'             => '#3498db', // azul
  'Contactado'        => '#9b59b6', // violeta
  'En seguimiento'    => '#f1c40f', // amarillo
  'Cualificado'       => '#2ecc71', // verde
  'No interesado'     => '#95a5a6', // gris
  'Ganado'            => '#27ae60', // verde fuerte
  'Perdido'           => '#e74c3c', // rojo
];

/*-----------------------------------------------------------
  3) Detectar columna PRIMARY KEY de inscripciones
-----------------------------------------------------------*/
$primaryKeyColumn = null;
$pkResult = $c->query("
  SELECT COLUMN_NAME 
  FROM information_schema.columns
  WHERE table_schema = 'training_center'
    AND table_name   = 'inscripciones'
    AND COLUMN_KEY   = 'PRI'
  LIMIT 1;
");
if ($pkResult && $pkResult->num_rows > 0) {
  $primaryKeyColumn = $pkResult->fetch_assoc()['COLUMN_NAME'];
}

/*-----------------------------------------------------------
  4) Detectar columna de email de inscripciones
-----------------------------------------------------------*/
$emailColumn = null;
$emailColResult = $c->query("
  SELECT COLUMN_NAME
  FROM information_schema.columns
  WHERE table_schema='training_center'
    AND table_name='inscripciones'
    AND (
      COLUMN_NAME LIKE '%mail%' OR
      COLUMN_NAME LIKE '%email%' OR
      COLUMN_NAME LIKE '%correo%'
    )
  LIMIT 1;
");
if ($emailColResult && $emailColResult->num_rows > 0) {
  $emailColumn = $emailColResult->fetch_assoc()['COLUMN_NAME'];
}

/*-----------------------------------------------------------
  5) Configuración de correo (SMTP + IMAP)
-----------------------------------------------------------*/
define('CRM_MAIL_USER', 'python@jocarsa.com');
define('CRM_MAIL_PASS', 'TAME123$');
define('CRM_SMTP_HOST', 'smtp.ionos.es');
define('CRM_SMTP_PORT', 587); // STARTTLS
define('CRM_IMAP_MAILBOX', '{imap.ionos.es:993/imap/ssl}INBOX');

// *** carpeta de ENVIADOS (ajústala si IONOS usa otro nombre) ***
define('CRM_IMAP_SENT_MAILBOX', '{imap.ionos.es:993/imap/ssl}Elementos enviados');

/*-----------------------------------------------------------
  6) Función: guardar un mensaje en la carpeta "Sent" por IMAP
-----------------------------------------------------------*/
function crm_append_to_sent($rawMessage) {
  if (!function_exists('imap_open')) {
    return;
  }

  $mailbox  = CRM_IMAP_SENT_MAILBOX;
  $user     = CRM_MAIL_USER;
  $password = CRM_MAIL_PASS;

  $imap = @imap_open($mailbox, $user, $password);
  if (!$imap) {
    // si falla, simplemente no se guarda; no rompemos nada
    return;
  }

  // Fecha formato IMAP
  $date = date('d-M-Y H:i:s O'); // ej. 02-Mar-2025 12:34:56 +0100

  // Marcar como \Seen para que no cuente como no leído
  @imap_append($imap, $mailbox, $rawMessage, "\\Seen", $date);

  imap_close($imap);
}

/*-----------------------------------------------------------
  7) Función: enviar correo via SMTP (con STARTTLS + guardar en Sent)
-----------------------------------------------------------*/
function crm_send_email_smtp($to, $subject, $body, &$errorMsg) {
  $errorMsg = '';
  $smtpHost = CRM_SMTP_HOST;
  $smtpPort = CRM_SMTP_PORT;
  $username = CRM_MAIL_USER;
  $password = CRM_MAIL_PASS;
  $from     = CRM_MAIL_USER;
  $fromName = 'CRM Training Center';

  $socket = @fsockopen($smtpHost, $smtpPort, $errno, $errstr, 30);
  if (!$socket) {
    $errorMsg = "No se pudo conectar al servidor SMTP: $errstr ($errno)";
    return false;
  }

  // Banner inicial
  $resp = fgets($socket, 515);
  if (substr($resp, 0, 3) != '220') {
    $errorMsg = "Respuesta inesperada del servidor SMTP: $resp";
    fclose($socket);
    return false;
  }

  // lector de respuestas multilínea tipo 250-... / 250 ...
  $readMultiline = function($expectedCode) use ($socket, &$errorMsg) {
    $response = '';
    while (($line = fgets($socket, 515)) !== false) {
      $response .= $line;
      if (substr($line, 0, 3) != $expectedCode) {
        $errorMsg = "Respuesta inesperada del servidor SMTP: $line";
        return false;
      }
      if (strlen($line) < 4 || $line[3] != '-') {
        break;
      }
    }
    return $response;
  };

  // comandos de una sola línea
  $sendCmdOneLine = function($cmd, $expectedCode) use ($socket, &$errorMsg) {
    fputs($socket, $cmd);
    $resp = fgets($socket, 515);
    if (substr($resp, 0, 3) != $expectedCode) {
      $errorMsg = "Error SMTP al enviar '$cmd': $resp";
      return false;
    }
    return true;
  };

  // 1) EHLO inicial (sin TLS)
  fputs($socket, "EHLO localhost\r\n");
  $ehloResp = $readMultiline("250");
  if ($ehloResp === false) {
    fclose($socket);
    return false;
  }

  // 2) STARTTLS
  fputs($socket, "STARTTLS\r\n");
  $resp = fgets($socket, 515);
  if (substr($resp, 0, 3) != '220') {
    $errorMsg = "Fallo al iniciar STARTTLS: $resp";
    fclose($socket);
    return false;
  }

  // 3) Activar cifrado TLS
  $cryptoOk = @stream_socket_enable_crypto(
    $socket,
    true,
    STREAM_CRYPTO_METHOD_TLS_CLIENT
  );
  if (!$cryptoOk) {
    $errorMsg = "No se pudo activar el cifrado TLS en el socket SMTP.";
    fclose($socket);
    return false;
  }

  // 4) EHLO otra vez, ya cifrado
  fputs($socket, "EHLO localhost\r\n");
  $ehloResp2 = $readMultiline("250");
  if ($ehloResp2 === false) {
    fclose($socket);
    return false;
  }

  // 5) AUTH LOGIN
  if (!$sendCmdOneLine("AUTH LOGIN\r\n", "334")) {
    fclose($socket);
    return false;
  }

  if (!$sendCmdOneLine(base64_encode($username) . "\r\n", "334")) {
    fclose($socket);
    return false;
  }

  if (!$sendCmdOneLine(base64_encode($password) . "\r\n", "235")) {
    fclose($socket);
    return false;
  }

  // 6) MAIL FROM
  if (!$sendCmdOneLine("MAIL FROM:<$from>\r\n", "250")) {
    fclose($socket);
    return false;
  }

  // 7) RCPT TO
  if (!$sendCmdOneLine("RCPT TO:<$to>\r\n", "250")) {
    fclose($socket);
    return false;
  }

  // 8) DATA
  if (!$sendCmdOneLine("DATA\r\n", "354")) {
    fclose($socket);
    return false;
  }

  // Cabeceras + cuerpo (mensaje completo RFC822)
  $headers  = "From: " . $fromName . " <" . $from . ">\r\n";
  $headers .= "To: <$to>\r\n";
  $headers .= "Subject: " . $subject . "\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
  $headers .= "Content-Transfer-Encoding: 8bit\r\n";
  $headers .= "\r\n";

  $rawMessage = $headers . $body;

  $data = $rawMessage . "\r\n.\r\n";

  fputs($socket, $data);
  $resp = fgets($socket, 515);
  if (substr($resp, 0, 3) != '250') {
    $errorMsg = "Error al completar el envío: $resp";
    fclose($socket);
    return false;
  }

  fputs($socket, "QUIT\r\n");
  fclose($socket);

  // *** Guardar una copia en la carpeta "Sent" ***
  crm_append_to_sent($rawMessage);

  return true;
}

/*-----------------------------------------------------------
  8) Función: obtener comunicaciones (INBOX + Sent) para un contacto
-----------------------------------------------------------*/
function crm_fetch_emails_for_contact($contactEmail, $limit = 20) {
  $result = [
    'sent'     => [],
    'received' => [],
    'error'    => null
  ];

  if (!function_exists('imap_open')) {
    $result['error'] = "La extensión IMAP de PHP no está habilitada.";
    return $result;
  }

  $user     = CRM_MAIL_USER;
  $password = CRM_MAIL_PASS;
  $ourAddress = strtolower(CRM_MAIL_USER);
  $safeEmail  = str_replace('"', '\"', $contactEmail);

  // helper para escanear una carpeta (INBOX o Sent)
  $scanMailbox = function($mailbox) use (&$result, $user, $password, $safeEmail, $ourAddress, $limit) {
    $inbox = @imap_open($mailbox, $user, $password);
    if (!$inbox) {
      if ($result['error'] === null) {
        $result['error'] = imap_last_error();
      }
      return;
    }

    $emailsIds = [];

    // FROM contacto
    $fromIds = imap_search($inbox, 'FROM "' . $safeEmail . '"');
    if ($fromIds !== false) {
      $emailsIds = array_merge($emailsIds, $fromIds);
    }

    // TO contacto
    $toIds = imap_search($inbox, 'TO "' . $safeEmail . '"');
    if ($toIds !== false) {
      $emailsIds = array_merge($emailsIds, $toIds);
    }

    if (!empty($emailsIds)) {
      $emailsIds = array_values(array_unique($emailsIds));
      rsort($emailsIds);
      // opcional: podríamos limitar aquí por carpeta; lo dejamos completo
    } else {
      imap_close($inbox);
      return;
    }

    foreach ($emailsIds as $num) {
      $overview = imap_fetch_overview($inbox, $num, 0);
      if (!$overview) continue;
      $ov = $overview[0];

      $header = imap_headerinfo($inbox, $num);

      $from = isset($header->fromaddress) ? $header->fromaddress : ($ov->from ?? '');
      $to   = isset($header->toaddress)   ? $header->toaddress   : ($ov->to   ?? '');

      $subject = isset($ov->subject) ? imap_utf8($ov->subject) : '';
      $date    = isset($ov->date)    ? $ov->date : '';

      $body = imap_fetchbody($inbox, $num, 1);
      if (!$body) $body = '';
      $body = imap_qprint($body);
      $snippet = trim($body);
      if (function_exists('mb_substr')) {
        $snippet = mb_substr($snippet, 0, 200);
      } else {
        $snippet = substr($snippet, 0, 200);
      }

      $entry = [
        'subject' => $subject,
        'date'    => $date,
        'from'    => $from,
        'to'      => $to,
        'snippet' => $snippet
      ];

      $fromLower = strtolower($from);
      if (strpos($fromLower, $ourAddress) !== false) {
        $result['sent'][] = $entry;
      } else {
        $result['received'][] = $entry;
      }
    }

    imap_close($inbox);
  };

  // Escanear INBOX y Sent
  $scanMailbox(CRM_IMAP_MAILBOX);
  $scanMailbox(CRM_IMAP_SENT_MAILBOX);

  // Ordenar por fecha dentro de enviados y recibidos (descendente)
  $sortByDateDesc = function(&$arr) {
    usort($arr, function($a, $b) {
      $da = strtotime($a['date'] ?? '1970-01-01');
      $db = strtotime($b['date'] ?? '1970-01-01');
      return $db <=> $da;
    });
  };

  $sortByDateDesc($result['sent']);
  $sortByDateDesc($result['received']);

  // Aplicar límite por tipo
  if ($limit > 0) {
    $result['sent']     = array_slice($result['sent'], 0, $limit);
    $result['received'] = array_slice($result['received'], 0, $limit);
  }

  return $result;
}

/*-----------------------------------------------------------
  9) LOGIN / LOGOUT
-----------------------------------------------------------*/
$login_error = "";

if (isset($_GET['logout'])) {
  session_destroy();
  header("Location: " . $_SERVER['PHP_SELF']);
  exit;
}

if (isset($_POST['action']) && $_POST['action'] === 'login') {
  $usuario  = $_POST['usuario']  ?? '';
  $password = $_POST['password'] ?? '';

  if ($usuario === 'jocarsa' && $password === 'jocarsa') {
    $_SESSION['admin_logged'] = true;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
  } else {
    $login_error = "Usuario o contraseña incorrectos.";
  }
}

$loggedIn = isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] === true;

/*-----------------------------------------------------------
  10) Actualización de estado CRM
-----------------------------------------------------------*/
if (
  $loggedIn &&
  isset($_POST['action']) &&
  $_POST['action'] === 'update_estado'
) {
  $id_registro = $_POST['id_registro'] ?? null;
  $estado      = $_POST['estado']      ?? null;

  if ($id_registro !== null && isset($estadosCRM[$estado])) {
    $color = $estadosCRM[$estado];

    $stmt = $c->prepare("
      INSERT INTO crm_estados_inscripciones (id_registro, estado, color)
      VALUES (?, ?, ?)
      ON DUPLICATE KEY UPDATE
        estado = VALUES(estado),
        color  = VALUES(color)
    ");
    if ($stmt) {
      $stmt->bind_param("sss", $id_registro, $estado, $color);
      $stmt->execute();
      $stmt->close();
    }
  }
}

/*-----------------------------------------------------------
  11) Envío de email desde el informe
-----------------------------------------------------------*/
$emailSendMessage = "";

if (
  $loggedIn &&
  isset($_POST['action']) &&
  $_POST['action'] === 'send_email'
) {
  $to      = $_POST['to']      ?? '';
  $subject = $_POST['subject'] ?? '';
  $body    = $_POST['body']    ?? '';

  if ($to && $subject && $body) {
    $errorMsg = '';
    $ok = crm_send_email_smtp($to, $subject, $body, $errorMsg);
    if ($ok) {
      $emailSendMessage = "Mensaje enviado correctamente.";
    } else {
      $emailSendMessage = "Error al enviar el mensaje: " . htmlspecialchars($errorMsg, ENT_QUOTES, 'UTF-8');
    }
  } else {
    $emailSendMessage = "Por favor, rellena todos los campos del mensaje.";
  }
}

/*-----------------------------------------------------------
  12) Estados actuales (para la tabla)
-----------------------------------------------------------*/
$estadosActuales = [];
if ($loggedIn) {
  $resEstados = $c->query("SELECT id_registro, estado, color FROM crm_estados_inscripciones");
  if ($resEstados) {
    while ($row = $resEstados->fetch_assoc()) {
      $estadosActuales[$row['id_registro']] = $row;
    }
  }
}

/*-----------------------------------------------------------
  13) Mapa de correos NO LEÍDOS por contacto (para la tabla)
-----------------------------------------------------------*/
// *** nueva funcionalidad: marcar si hay emails sin leer de cada contacto ***
$unreadByEmail = [];
if ($loggedIn && $emailColumn !== null && function_exists('imap_open')) {
  $mailbox  = CRM_IMAP_MAILBOX; // INBOX
  $user     = CRM_MAIL_USER;
  $password = CRM_MAIL_PASS;

  $inbox = @imap_open($mailbox, $user, $password);
  if ($inbox) {
    $unseenIds = imap_search($inbox, 'UNSEEN');
    if ($unseenIds !== false) {
      foreach ($unseenIds as $num) {
        $header = imap_headerinfo($inbox, $num);
        if (!empty($header->from)) {
          // from es un array de objetos (mailbox + host)
          foreach ($header->from as $fromObj) {
            $fromEmail = strtolower(trim($fromObj->mailbox . '@' . $fromObj->host));
            if ($fromEmail !== '' && $fromEmail !== strtolower(CRM_MAIL_USER)) {
              $unreadByEmail[$fromEmail] = true;
            }
          }
        }
      }
    }
    imap_close($inbox);
  }
}

/*-----------------------------------------------------------
  14) ID de informe (vista detalle)
-----------------------------------------------------------*/
$viewId = null;
if ($loggedIn && isset($_GET['view'])) {
  $viewId = $_GET['view'];
}

?>
<!doctype html>
<html lang="es">
  <head>
    <title>Panel de administración</title>
    <meta charset="utf-8">
    <style>
      :root{
        --primary: crimson;
        --primary-light: #ff8fa0;
        --bg: #f2f2f2;
        --text: #333;
        --border: #ddd;
      }

      *{
        box-sizing:border-box;
        margin:0;
        padding:0;
      }

      html, body{
        height:100%;
        font-family: "Segoe UI", sans-serif;
        color: var(--text);
        background: var(--bg);
      }

      body{
        display:flex;
        align-items:stretch;
      }

      /*---------------- LOGIN ----------------*/
      .login-wrapper{
        width:100%;
        display:flex;
        justify-content:center;
        align-items:center;
        padding:40px;
      }
      .login-card{
        background:white;
        padding:30px 40px;
        width:360px;
        border-radius:10px;
        box-shadow:0 4px 15px rgba(0,0,0,0.1);
        border-top:8px solid var(--primary);
      }
      .login-card h2{
        margin-bottom:20px;
        color:var(--primary);
        font-size:1.4em;
      }
      .login-card .form-group{
        margin-bottom:15px;
        display:flex;
        flex-direction:column;
        gap:6px;
      }
      .login-card label{
        font-size:0.95em;
        font-weight:600;
        color:var(--primary);
      }
      .login-card input[type="text"],
      .login-card input[type="password"]{
        padding:10px 12px;
        border-radius:6px;
        border:1px solid var(--border);
        font-size:1em;
      }
      .login-card input[type="submit"]{
        margin-top:10px;
        width:100%;
        padding:12px;
        border:none;
        border-radius:6px;
        background:var(--primary);
        color:white;
        font-size:1em;
        cursor:pointer;
      }
      .login-error{
        margin-bottom:10px;
        padding:8px 10px;
        border-radius:6px;
        background:#ffe6e6;
        border:1px solid #ffb3b3;
        font-size:0.9em;
        color:#b30000;
      }

      /*---------------- LAYOUT ADMIN ----------------*/
      nav{
        width:240px;
        background: var(--primary);
        padding:20px;
        display:flex;
        flex-direction:column;
        gap:10px;
        box-shadow: 4px 0 12px rgba(0,0,0,0.1);
      }

      nav h2{
        color:white;
        margin-bottom:15px;
        font-size:1.1em;
        font-weight:700;
      }

      nav button{
        background:white;
        border:none;
        padding:10px 14px;
        border-radius:999px;
        cursor:pointer;
        font-size:0.95em;
        text-align:left;
        transition: transform 0.15s, box-shadow 0.15s, background 0.15s;
      }

      nav button:hover{
        transform: translateY(-1px);
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        background:#fff5f7;
      }

      main{
        flex:1;
        padding:30px 40px;
        display:flex;
        flex-direction:column;
        gap:15px;
      }

      header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:10px;
      }

      header h1{
        font-size:1.4em;
        color:var(--primary);
      }

      .user-actions{
        display:flex;
        gap:10px;
        align-items:center;
        font-size:0.9em;
      }
      .logout-link{
        padding:6px 10px;
        border-radius:999px;
        border:1px solid var(--primary-light);
        color:var(--primary);
        text-decoration:none;
        font-size:0.85em;
        background:white;
      }
      .back-link{
        padding:6px 10px;
        border-radius:999px;
        border:1px solid var(--border);
        color:#555;
        text-decoration:none;
        font-size:0.8em;
        background:white;
        margin-right:10px;
      }

      .table-card,
      .detail-card{
        background:white;
        border-radius:10px;
        padding:20px 24px;
        box-shadow:0 4px 15px rgba(0,0,0,0.08);
        border-top:8px solid var(--primary);
      }

      .table-card h3,
      .detail-card h3{
        margin-bottom:10px;
        font-size:1.1em;
        color:var(--primary);
      }

      .table-card p.description,
      .detail-card p.description{
        margin-bottom:10px;
        font-size:0.9em;
        color:#666;
      }

      table{
        width:100%;
        border-collapse:collapse;
        font-size:0.9em;
      }

      thead th{
        text-align:left;
        padding:10px 8px;
        border-bottom:2px solid var(--primary-light);
        color:var(--primary);
        font-weight:600;
      }

      tbody td{
        padding:8px 8px;
        border-bottom:1px solid var(--border);
        vertical-align:middle;
      }

      tbody tr:nth-child(even){
        background:#fafafa;
      }

      tbody tr:hover{
        background:#ffeef2;
      }

      .estado-pill{
        display:inline-block;
        padding:4px 10px;
        border-radius:999px;
        border:1px solid var(--border);
        font-size:0.8em;
        background:#f9f9f9;
      }
      .estado-pill--vacio{
        color:#999;
        border-style:dashed;
      }

      .form-estado{
        display:flex;
        gap:6px;
        align-items:center;
      }
      .form-estado select{
        padding:4px 6px;
        border-radius:4px;
        border:1px solid var(--border);
        font-size:0.85em;
      }
      .btn-estado{
        padding:4px 8px;
        border-radius:4px;
        border:none;
        background:var(--primary);
        color:white;
        font-size:0.8em;
        cursor:pointer;
      }

      .btn-informe{
        padding:4px 8px;
        border-radius:4px;
        border:none;
        background:#34495e;
        color:white;
        font-size:0.8em;
        cursor:pointer;
        text-decoration:none;
        display:inline-block;
      }

      .badge-unread{
        display:inline-flex;
        align-items:center;
        justify-content:center;
        min-width:22px;
        height:22px;
        border-radius:999px;
        background:#2ecc71;
        color:white;
        font-size:0.75em;
        font-weight:bold;
      }
      .badge-unread::before{
        content:"✉";
        margin-right:3px;
      }
      .badge-none{
        font-size:0.75em;
        color:#aaa;
      }

      /* Detalle */
      .detail-row-table{
        width:100%;
        border-collapse:collapse;
        margin-bottom:20px;
      }
      .detail-row-table th,
      .detail-row-table td{
        padding:6px 8px;
        border-bottom:1px solid var(--border);
        text-align:left;
      }
      .detail-row-table th{
        width:30%;
        color:var(--primary);
      }

      .email-section{
        margin-top:20px;
        display:grid;
        grid-template-columns:1.2fr 1.8fr;
        gap:20px;
      }
      .email-form-card,
      .email-log-card{
        background:#fafafa;
        border-radius:8px;
        padding:15px 18px;
        border:1px solid #e5e5e5;
      }
      .email-form-card h4,
      .email-log-card h4{
        margin-bottom:8px;
        color:#444;
      }
      .email-form-card .form-group{
        margin-bottom:10px;
        display:flex;
        flex-direction:column;
        gap:4px;
      }
      .email-form-card label{
        font-size:0.85em;
        font-weight:600;
      }
      .email-form-card input[type="text"],
      .email-form-card textarea{
        padding:8px 10px;
        border-radius:4px;
        border:1px solid var(--border);
        font-size:0.9em;
        resize:vertical;
      }
      .email-form-card textarea{
        min-height:120px;
      }
      .email-form-card input[type="submit"]{
        margin-top:8px;
        padding:8px 12px;
        border:none;
        border-radius:4px;
        background:var(--primary);
        color:white;
        font-size:0.9em;
        cursor:pointer;
      }
      .email-status-msg{
        margin-bottom:10px;
        padding:6px 8px;
        border-radius:6px;
        font-size:0.85em;
      }
      .email-status-ok{
        background:#e7f7ec;
        border:1px solid #9dd7b1;
        color:#217346;
      }
      .email-status-error{
        background:#ffe6e6;
        border:1px solid #ffb3b3;
        color:#b30000;
      }

      .mail-list{
        max-height:280px;
        overflow:auto;
        font-size:0.86em;
      }
      .mail-item{
        padding:8px 0;
        border-bottom:1px solid #e3e3e3;
      }
      .mail-item:last-child{
        border-bottom:none;
      }
      .mail-item strong{
        color:#333;
      }
      .mail-meta{
        font-size:0.8em;
        color:#777;
        margin-bottom:2px;
      }
      .mail-snippet{
        font-size:0.85em;
        color:#555;
      }

      @media (max-width: 900px){
        body{
          flex-direction:column;
        }
        nav{
          width:100%;
          flex-direction:row;
          flex-wrap:wrap;
          box-shadow:none;
        }
        nav h2{
          width:100%;
        }
        main{
          padding:20px;
        }
        .email-section{
          grid-template-columns:1fr;
        }
      }
    </style>
  </head>
  <body>

  <?php if (!$loggedIn): ?>

    <!-- ------------------ VISTA LOGIN ------------------ -->
    <div class="login-wrapper">
      <form method="post" class="login-card">
        <h2>Acceso al panel</h2>

        <?php if ($login_error !== ""): ?>
          <div class="login-error">
            <?= htmlspecialchars($login_error, ENT_QUOTES, 'UTF-8'); ?>
          </div>
        <?php endif; ?>

        <div class="form-group">
          <label for="usuario">Usuario</label>
          <input type="text" name="usuario" id="usuario" autocomplete="username">
        </div>

        <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="password" name="password" id="password" autocomplete="current-password">
        </div>

        <input type="hidden" name="action" value="login">
        <input type="submit" value="Entrar">
      </form>
    </div>

  <?php else: ?>

    <!-- ------------------ PANEL ADMIN ------------------ -->
    <nav>
      <h2>Menú</h2>
      <button>Enlace 1</button>
      <button>Enlace 2</button>
      <button>Enlace 3</button>
    </nav>
    <main>
      <?php
        $title = $viewId ? "Informe de inscripción" : "Listado de inscripciones";
      ?>
      <header>
        <div style="display:flex; align-items:center; gap:8px;">
          <?php if ($viewId): ?>
            <a href="<?= htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8'); ?>" class="back-link">← Volver al listado</a>
          <?php endif; ?>
          <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h1>
        </div>
        <div class="user-actions">
          <span>Conectado como <strong>jocarsa</strong></span>
          <a class="logout-link" href="?logout=1">Cerrar sesión</a>
        </div>
      </header>

      <?php if ($viewId && $primaryKeyColumn !== null): ?>

        <?php
          // Cargar la fila concreta
          $filaDetalle = null;
          $stmt = $c->prepare("SELECT * FROM inscripciones WHERE $primaryKeyColumn = ? LIMIT 1");
          if ($stmt) {
            $stmt->bind_param("s", $viewId);
            $stmt->execute();
            $result = $stmt->get_result();
            $filaDetalle = $result->fetch_assoc();
            $stmt->close();
          }
        ?>

        <?php if ($filaDetalle): ?>
          <?php
            // Determinar email de contacto (si existe columna de email)
            $contactEmail = null;
            if ($emailColumn !== null && isset($filaDetalle[$emailColumn])) {
              $contactEmail = $filaDetalle[$emailColumn];
            }

            // Obtener comunicaciones por email si tenemos correo
            $commReport = null;
            if ($contactEmail) {
              $commReport = crm_fetch_emails_for_contact($contactEmail, 20);
            }
          ?>

          <section class="detail-card">
            <h3>Datos de la inscripción (ID: <?= htmlspecialchars($viewId, ENT_QUOTES, 'UTF-8'); ?>)</h3>
            <p class="description">
              Detalle completo del registro seleccionado en la tabla
              <strong>inscripciones</strong>, junto con el historial de comunicaciones
              por correo electrónico asociado al contacto.
            </p>

            <table class="detail-row-table">
              <tbody>
                <?php foreach ($filaDetalle as $campo => $valor): ?>
                  <tr>
                    <th><?= htmlspecialchars($campo, ENT_QUOTES, 'UTF-8'); ?></th>
                    <td><?= htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8'); ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

            <div class="email-section">
              <div class="email-form-card">
                <h4>Enviar mensaje al contacto</h4>

                <?php if ($emailSendMessage): ?>
                  <div class="email-status-msg <?= (strpos($emailSendMessage, 'correctamente') !== false) ? 'email-status-ok' : 'email-status-error'; ?>">
                    <?= $emailSendMessage; ?>
                  </div>
                <?php endif; ?>

                <?php if ($contactEmail): ?>
                  <p style="font-size:0.85em; margin-bottom:8px;">
                    Correo del contacto:
                    <strong><?= htmlspecialchars($contactEmail, ENT_QUOTES, 'UTF-8'); ?></strong><br>
                    Remitente usado: <code><?= htmlspecialchars(CRM_MAIL_USER, ENT_QUOTES, 'UTF-8'); ?></code>
                  </p>

                  <form method="post" action="?view=<?= urlencode($viewId); ?>">
                    <div class="form-group">
                      <label for="subject">Asunto</label>
                      <input type="text" id="subject" name="subject">
                    </div>
                    <div class="form-group">
                      <label for="body">Mensaje</label>
                      <textarea id="body" name="body"></textarea>
                    </div>
                    <input type="hidden" name="to" value="<?= htmlspecialchars($contactEmail, ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="action" value="send_email">
                    <input type="submit" value="Enviar mensaje">
                  </form>
                <?php else: ?>
                  <p style="font-size:0.85em; color:#b30000;">
                    No se ha detectado ninguna columna de email para este registro.  
                    El envío de correos no está disponible.
                  </p>
                <?php endif; ?>
              </div>

              <div class="email-log-card">
                <h4>Comunicaciones por correo</h4>

                <?php if (!$contactEmail): ?>
                  <p style="font-size:0.85em; color:#555;">
                    No hay correo electrónico asociado a este registro.<br>
                    Por tanto, no se puede generar el informe de comunicaciones.
                  </p>
                <?php else: ?>
                  <?php if ($commReport && $commReport['error']): ?>
                    <p style="font-size:0.85em; color:#b30000;">
                      Error al acceder al buzón IMAP:
                      <?= htmlspecialchars($commReport['error'], ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                  <?php else: ?>
                    <div class="mail-list">
                      <?php
                        $sent     = $commReport ? $commReport['sent']     : [];
                        $received = $commReport ? $commReport['received'] : [];
                      ?>

                      <p class="mail-meta">
                        Mensajes enviados: <?= count($sent); ?> |
                        Mensajes recibidos: <?= count($received); ?>
                      </p>

                      <?php if (empty($sent) && empty($received)): ?>
                        <p style="font-size:0.85em; color:#555;">
                          No se han encontrado mensajes relacionados con
                          <strong><?= htmlspecialchars($contactEmail, ENT_QUOTES, 'UTF-8'); ?></strong>.
                        </p>
                      <?php else: ?>

                        <?php if (!empty($sent)): ?>
                          <p style="margin-top:8px; font-weight:bold; font-size:0.9em;">Enviados (<?= count($sent); ?>)</p>
                          <?php foreach ($sent as $mail): ?>
                            <div class="mail-item">
                              <div class="mail-meta">
                                <strong>Asunto:</strong> <?= htmlspecialchars($mail['subject'], ENT_QUOTES, 'UTF-8'); ?><br>
                                <strong>Fecha:</strong> <?= htmlspecialchars($mail['date'], ENT_QUOTES, 'UTF-8'); ?><br>
                                <strong>De:</strong> <?= htmlspecialchars($mail['from'], ENT_QUOTES, 'UTF-8'); ?><br>
                                <strong>Para:</strong> <?= htmlspecialchars($mail['to'], ENT_QUOTES, 'UTF-8'); ?>
                              </div>
                              <div class="mail-snippet">
                                <?= nl2br(htmlspecialchars($mail['snippet'], ENT_QUOTES, 'UTF-8')); ?>
                              </div>
                            </div>
                          <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if (!empty($received)): ?>
                          <p style="margin-top:10px; font-weight:bold; font-size:0.9em;">Recibidos (<?= count($received); ?>)</p>
                          <?php foreach ($received as $mail): ?>
                            <div class="mail-item">
                              <div class="mail-meta">
                                <strong>Asunto:</strong> <?= htmlspecialchars($mail['subject'], ENT_QUOTES, 'UTF-8'); ?><br>
                                <strong>Fecha:</strong> <?= htmlspecialchars($mail['date'], ENT_QUOTES, 'UTF-8'); ?><br>
                                <strong>De:</strong> <?= htmlspecialchars($mail['from'], ENT_QUOTES, 'UTF-8'); ?><br>
                                <strong>Para:</strong> <?= htmlspecialchars($mail['to'], ENT_QUOTES, 'UTF-8'); ?>
                              </div>
                              <div class="mail-snippet">
                                <?= nl2br(htmlspecialchars($mail['snippet'], ENT_QUOTES, 'UTF-8')); ?>
                              </div>
                            </div>
                          <?php endforeach; ?>
                        <?php endif; ?>

                      <?php endif; ?>
                    </div>
                  <?php endif; ?>
                <?php endif; ?>
              </div>
            </div>
          </section>
        <?php else: ?>
          <section class="detail-card">
            <h3>Registro no encontrado</h3>
            <p class="description">
              No se ha podido localizar la inscripción con identificador
              <strong><?= htmlspecialchars($viewId, ENT_QUOTES, 'UTF-8'); ?></strong>.
            </p>
          </section>
        <?php endif; ?>

      <?php else: ?>

        <!-- -------- LISTADO GENERAL DE INSCRIPCIONES -------- -->
        <section class="table-card">
          <h3>Tabla: inscripciones</h3>
          <p class="description">
            Registros actuales en la tabla <strong>inscripciones</strong> de la base de datos
            <strong>training_center</strong>. Puede asignar un estado CRM a cada registro,
            ver si hay correos nuevos sin leer y acceder a un informe detallado.
          </p>

          <table>
            <thead>
              <tr>
                <?php
                /* COLUMNAS CON SUS COMENTARIOS */
                $r = $c->query("
                  SELECT COLUMN_NAME, COLUMN_TYPE, COLUMN_KEY, COLUMN_DEFAULT, COLUMN_COMMENT
                  FROM information_schema.columns
                  WHERE table_schema='training_center'
                    AND table_name='inscripciones'
                ");

                $columnNames = [];
                while($f = $r->fetch_assoc()) {
                  $columnNames[] = $f['COLUMN_NAME'];
                  echo '<th>'.htmlspecialchars($f['COLUMN_NAME'], ENT_QUOTES, 'UTF-8').'</th>';
                }

                // *** Nueva columna: correos no leídos ***
                echo '<th>Emails nuevos</th>';

                // Columnas extra para estado CRM y acciones
                echo '<th>Estado CRM</th>';
                echo '<th>Acciones</th>';
                ?>
              </tr>
            </thead>
            <tbody>
              <?php
                $r = $c->query("SELECT * FROM inscripciones;");

                while($f = $r->fetch_assoc()) {
                  // ID del registro basado en la columna PK detectada (si existe)
                  $idRegistro = null;
                  if ($primaryKeyColumn !== null && isset($f[$primaryKeyColumn])) {
                    $idRegistro = (string)$f[$primaryKeyColumn];
                  }

                  // Normalizar email de este registro, si existe
                  $rowEmailNorm = null;
                  if ($emailColumn !== null && isset($f[$emailColumn]) && $f[$emailColumn] !== '') {
                    $rowEmailNorm = strtolower(trim($f[$emailColumn]));
                  }

                  echo '<tr>';

                  // Mostrar todas las columnas originales
                  foreach($f as $clave=>$valor){
                    echo '<td>'.htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8').'</td>';
                  }

                  // *** Columna Emails nuevos ***
                  echo '<td>';
                  if ($rowEmailNorm && isset($unreadByEmail[$rowEmailNorm])) {
                    echo '<span class="badge-unread" title="Nuevo(s) email(s) sin leer de este contacto.">!</span>';
                  } else {
                    echo '<span class="badge-none">—</span>';
                  }
                  echo '</td>';

                  // Columna "Estado CRM" (pastilla de color)
                  echo '<td>';
                  if ($idRegistro !== null && isset($estadosActuales[$idRegistro])) {
                    $estadoRow = $estadosActuales[$idRegistro];
                    $estadoTxt = htmlspecialchars($estadoRow['estado'], ENT_QUOTES, 'UTF-8');
                    $colorTxt  = htmlspecialchars($estadoRow['color'],  ENT_QUOTES, 'UTF-8');

                    echo '<span class="estado-pill" style="background:'.$colorTxt.'20; border-color:'.$colorTxt.'; color:'.$colorTxt.';">';
                    echo $estadoTxt;
                    echo '</span>';
                  } else {
                    echo '<span class="estado-pill estado-pill--vacio">Sin estado</span>';
                  }
                  echo '</td>';

                  // Columna "Acciones" (selector estado + botón + informe)
                  echo '<td>';
                  if ($idRegistro !== null) {
                    // Formulario de estado
                    echo '<form method="post" class="form-estado" style="margin-bottom:4px;">';
                    echo '<input type="hidden" name="action" value="update_estado">';
                    echo '<input type="hidden" name="id_registro" value="'.htmlspecialchars($idRegistro, ENT_QUOTES, 'UTF-8').'">';
                    echo '<select name="estado">';
                    foreach ($estadosCRM as $nombreEstado => $colorEstado) {
                      $selected = (
                        $idRegistro !== null &&
                        isset($estadosActuales[$idRegistro]) &&
                        $estadosActuales[$idRegistro]['estado'] === $nombreEstado
                      ) ? ' selected' : '';
                      echo '<option value="'.htmlspecialchars($nombreEstado, ENT_QUOTES, 'UTF-8').'"'.$selected.'>';
                      echo htmlspecialchars($nombreEstado, ENT_QUOTES, 'UTF-8');
                      echo '</option>';
                    }
                    echo '</select>';
                    echo '<button type="submit" class="btn-estado">Guardar</button>';
                    echo '</form>';

                    // Enlace a informe
                    $urlInforme = htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8') . '?view=' . urlencode($idRegistro);
                    echo '<a class="btn-informe" href="'.$urlInforme.'">Informe</a>';
                  }
                  echo '</td>';

                  echo '</tr>';
                }
              ?>
            </tbody>
          </table>
        </section>

      <?php endif; ?>

    </main>

  <?php endif; ?>

  </body>
</html>
```

### diagrama

```json
{
  "formas": [
    {
      "id": "forma-1",
      "tipo": "rectangle",
      "left": "301.128px",
      "top": "244.632px",
      "width": "",
      "height": "",
      "texto": "Formulario HTML"
    },
    {
      "id": "forma-2",
      "tipo": "rectangle",
      "left": "301.111px",
      "top": "205.211px",
      "width": "",
      "height": "",
      "texto": "CSS"
    },
    {
      "id": "forma-3",
      "tipo": "rectangle",
      "left": "301.124px",
      "top": "290.505px",
      "width": "",
      "height": "",
      "texto": "PHP"
    },
    {
      "id": "forma-4",
      "tipo": "rectangle",
      "left": "408.771px",
      "top": "388.153px",
      "width": "",
      "height": "",
      "texto": "MySQL"
    },
    {
      "id": "forma-5",
      "tipo": "rectangle",
      "left": "498.184px",
      "top": "288.161px",
      "width": "",
      "height": "",
      "texto": "PHP"
    },
    {
      "id": "forma-6",
      "tipo": "rectangle",
      "left": "498.774px",
      "top": "246.976px",
      "width": "",
      "height": "",
      "texto": "HTML"
    },
    {
      "id": "forma-7",
      "tipo": "rectangle",
      "left": "498.185px",
      "top": "206.979px",
      "width": "",
      "height": "",
      "texto": "CSS"
    }
  ],
  "flechas": [
    {
      "desde": {
        "shapeId": "forma-3",
        "propId": null,
        "side": null
      },
      "hasta": {
        "shapeId": "forma-4",
        "propId": null,
        "side": null
      },
      "tipo": "simple",
      "estilo": "straight"
    },
    {
      "desde": {
        "shapeId": "forma-4",
        "propId": null,
        "side": null
      },
      "hasta": {
        "shapeId": "forma-5",
        "propId": null,
        "side": null
      },
      "tipo": "doble",
      "estilo": "straight"
    }
  ]
}
```

### listar_carpetas

```
<?php
$host = '{imap.ionos.es:993/imap/ssl}';
$user = 'python@jocarsa.com';
$pass = 'TAME123$';

$mbox = imap_open($host . 'INBOX', $user, $pass);

if (!$mbox) {
    die('Error IMAP: ' . imap_last_error());
}

$folders = imap_getmailboxes($mbox, $host, '*');

if ($folders === false) {
    echo "Error al obtener carpetas: " . imap_last_error();
} else {
    echo "<pre>";
    foreach ($folders as $folder) {
        // Nombre completo que debes usar en PHP (incluyendo el prefijo)
        echo $folder->name . "\n";
    }
    echo "</pre>";
}

imap_close($mbox);
```


<a id="milla-extra-evaluacion-1"></a>
# Milla Extra Evaluacion 1


<a id="actividad-libre-de-final-de-evaluacion-la-milla-extra"></a>
# Actividad libre de final de evaluación - La milla extra

<a id="la-milla-extra-primera-evaluacion"></a>
## La Milla Extra - Primera evaluación

### ejercicio

```markdown

```
