# Manual y cuaderno de trabajo de C++

Documento generado automáticamente a partir del temario.

## Introducción general

Este documento combina explicaciones teóricas y ejercicios guiados paso a paso para facilitar el aprendizaje progresivo de C++.

---

# Identificación de los elementos de un programa informático

El objetivo principal de este capítulo es identificar y comprender los elementos básicos de un programa informático en C++. En el desarrollo de aplicaciones, la estructura y organización de código son fundamentales para garantizar su mantenimiento, escalabilidad y eficiencia. Al entender qué componentes forman parte de un programa, se puede mejorar significativamente la calidad del código y facilitar su comprensión tanto para el propio desarrollador como para cualquier otro que lo tenga que revisar o mantener.

Este capítulo es crucial en el aprendizaje de C++ porque proporciona las bases sobre las cuales se construirán los conceptos más avanzados. Al aprender a identificar y trabajar con los elementos fundamentales, se adquiere una comprensión sólida del lenguaje que facilitará la asimilación de temas posteriores.

A lo largo de este capítulo, se explorarán los componentes básicos de un programa en C++, incluyendo las declaraciones y definiciones de funciones, variables y estructuras de datos. Se analizará cómo estos elementos interactúan entre sí para formar la lógica del programa.

---

## Estructura y bloques fundamentales.

### Introducción

El subcapítulo "Estructura y bloques fundamentales" forma parte del capítulo sobre la identificación de los elementos de un programa informático. En este contexto, se refiere a la organización lógica y estructural que sigue un programa para realizar sus tareas.

La estructura de un programa es fundamental para su comprensión y mantenimiento. Los bloques fundamentales son las unidades básicas de código que realizan una tarea específica. Estos bloques pueden ser instrucciones simples, como la asignación de valores a variables, o más complejos, como los bucles o estructuras condicionales.

La identificación de estos bloques y su relación entre sí es crucial para comprender cómo funciona un programa y cómo se puede modificar o extender. En este subcapítulo, se explorará en detalle la estructura y los bloques fundamentales de un programa informático, proporcionando una base sólida para el análisis y la implementación de programas más complejos.

### Desarrollo práctico

Este es un ejemplo de un ejercicio guiado para la sección "Identificación de los elementos de un programa informático" del capítulo "Estructura y bloques fundamentales" en el libro "Programación en C++". El objetivo del ejercicio es ayudar al lector a comprender los conceptos básicos de programación y cómo se relacionan entre sí.

El ejercicio consiste en tres pasos, cada uno más avanzado que el anterior. En cada paso, el lector debe escribir un programa C++ mínimo que muestre una salida específica. El resultado esperado de cada paso debe describir exactamente lo que aparecerá en pantalla o explicar con claridad qué ocurrirá si hay entrada del usuario.

El ejercicio utiliza la herramienta g++ para compilar el código y ejecutarlo. El lector debe copiar el código de cada paso y ejecutarlo en su ordenador para verificar que funciona correctamente.

Es importante destacar que este es solo un ejemplo y que el ejercicio puede ser adaptado a las necesidades específicas del lector. Además, es fundamental respetar las reglas pedagógicas establecidas en el libro para garantizar una enseñanza didáctica y progresiva.

---

## Variables.

### Introducción

Las variables son elementos fundamentales en la programación informática. Su función principal es almacenar valores de datos para ser utilizados posteriormente en el programa. Aunque pueden parecer simples, las variables juegan un papel crucial en la estructura y funcionalidad de cualquier aplicación.

En este subcapítulo se explorará en detalle el concepto de variable, su definición y cómo se utiliza en la programación. Se analizarán sus características básicas y se mostrará cómo pueden ser declaradas y utilizadas para almacenar datos.

### Desarrollo práctico

Ejercicio guiado: Identificación de las variables
=============================================

### Título del ejercicio
Identificación y uso de variables en C++

#### Paso 1
En este primer paso, crearemos un programa que muestra el valor de una variable.
```cpp
#include <iostream>

int main() {
    int edad = 25;
    std::cout << "Mi edad es: " << edad << "\n";
    return 0;
}
```
#### Compilación y ejecución
Para compilar este programa, debemos usar el siguiente comando en la terminal:
```bash
g++ programa.cpp -o programa
```
Y para ejecutarlo, escribimos:
```bash
./programa
```
El resultado esperado es:
```
Mi edad es: 25
```
#### Paso 2
En este segundo paso, vamos a cambiar el valor de la variable y mostrarlo en pantalla.
```cpp
#include <iostream>

int main() {
    int edad = 25;
    std::cout << "Mi edad es: " << edad << "\n";
    edad = 30;
    std::cout << "Ahora mi edad es: " << edad << "\n";
    return 0;
}
```
#### Compilación y ejecución
Para compilar este programa, debemos usar el siguiente comando en la terminal:
```bash
g++ programa.cpp -o programa
```
Y para ejecutarlo, escribimos:
```bash
./programa
```
El resultado esperado es:
```
Mi edad es: 25
Ahora mi edad es: 30
```
#### Paso 3
En este tercer paso, vamos a crear una variable de tipo flotante y mostrarla en pantalla.
```cpp
#include <iostream>

int main() {
    int edad = 25;
    std::cout << "Mi edad es: " << edad << "\n";
    float altura = 1.70;
    std::cout << "Mi altura es: " << altura << "\n";
    return 0;
}
```
#### Compilación y ejecución
Para compilar este programa, debemos usar el siguiente comando en la terminal:
```bash
g++ programa.cpp -o programa
```
Y para ejecutarlo, escribimos:
```bash
./programa
```
El resultado esperado es:
```
Mi edad es: 25
Mi altura es: 1.70
```
Conclusión
==========
En este ejercicio guiado hemos identificado y utilizado variables en C++, creando un programa que muestra el valor de una variable y lo cambia en pantalla. También hemos visto cómo crear variables de tipo flotante y mostrarlas en pantalla.

---

## Tipos de datos.

### Introducción

**Tipos de datos**

En un programa informático, los tipos de datos son fundamentales para almacenar y manipular la información. Un tipo de dato determina el conjunto de valores que puede tomar una variable o expresión, así como las operaciones que se pueden realizar sobre ella.

Los tipos de datos permiten clasificar la información en categorías específicas, lo que facilita su manejo y comprensión. Por ejemplo, un número entero es diferente a un número real, ya que tienen diferentes características y propiedades. Los tipos de datos también influyen en el tamaño del espacio de memoria necesario para almacenarlos.

En este subcapítulo se explorará la clasificación y características de los tipos de datos en C++, su importancia en la programación y cómo se utilizan en un programa informático.

### Desarrollo práctico

Ejercicio guiado: Identificación de los elementos de un programa informático - Tipos de datos

### Título del ejercicio
Identificar y utilizar tipos de datos en C++

#### Paso 1
Creamos un programa que muestre el tipo de dato de una variable.

```cpp
#include <iostream>

int main() {
    int edad = 25;
    std::cout << "La edad es: " << edad << "\n";
    return 0;
}
```

#### Compilación y ejecución
```bash
g++ programa.cpp -o programa
./programa
```

#### Resultado esperado
La edad es: 25

#### Paso 2
Ahora creamos una variable de tipo float para almacenar una nota.

```cpp
#include <iostream>

int main() {
    int edad = 25;
    float nota = 9.5;
    std::cout << "La edad es: " << edad << "\n";
    std::cout << "La nota es: " << nota << "\n";
    return 0;
}
```

#### Compilación y ejecución
```bash
g++ programa.cpp -o programa
./programa
```

#### Resultado esperado
La edad es: 25
La nota es: 9.5

#### Paso 3
Ahora creamos una variable de tipo char para almacenar un carácter.

```cpp
#include <iostream>

int main() {
    int edad = 25;
    float nota = 9.5;
    char letra = 'a';
    std::cout << "La edad es: " << edad << "\n";
    std::cout << "La nota es: " << nota << "\n";
    std::cout << "La letra es: " << letra << "\n";
    return 0;
}
```

#### Compilación y ejecución
```bash
g++ programa.cpp -o programa
./programa
```

#### Resultado esperado
La edad es: 25
La nota es: 9.5
La letra es: a

Conclusión
En este ejercicio hemos practicado la identificación y utilización de tipos de datos en C++, como int, float, char y otros tipos más avanzados.

---

## Literales.

### Introducción

El subcapítulo "Literales" se centra en la explicación de los valores constantes utilizados en un programa informático. Los literales son elementos fundamentales en cualquier lenguaje de programación, ya que permiten representar valores numéricos, cadenas de caracteres y otros tipos de datos de manera directa.

En el contexto del capítulo actual, la identificación de los elementos de un programa informático, los literales juegan un papel crucial al proporcionar una forma clara y concisa para expresar constantes en el código. Esto facilita la lectura, escritura y mantenimiento del programa, ya que se evita la necesidad de declarar variables o utilizar operaciones complejas para representar valores fijos.

A lo largo de este subcapítulo, se explorará en detalle los diferentes tipos de literales disponibles en C++, incluyendo números enteros, decimales y literales de texto. Se analizarán sus características y cómo se utilizan en el código para mejorar la claridad y eficiencia del programa.

### Desarrollo práctico

Ejercicio guiado: Identificación de los elementos de un programa informático - Literales

### Título del ejercicio
Identificar y utilizar literales en C++

#### Paso 1
En este primer paso, crearemos un programa que muestra el valor de un literal entero.

```cpp
#include <iostream>

int main() {
    int edad = 25;
    std::cout << "La edad es: " << edad << std::endl;
    return 0;
}
```

#### Compilación y ejecución
Para compilar el programa, escribe en la terminal:
```bash
g++ literales.cpp -o literales
```
Y para ejecutarlo, escribe:
```bash
./literales
```

#### Resultado esperado
El resultado debe ser "La edad es: 25".

#### Paso 2
Ahora vamos a utilizar un literal de punto flotante. En este paso, crearemos un programa que muestra el valor de un literal de punto flotante.

```cpp
#include <iostream>

int main() {
    float pi = 3.14;
    std::cout << "El valor de PI es: " << pi << std::endl;
    return 0;
}
```

#### Compilación y ejecución
Para compilar el programa, escribe en la terminal:
```bash
g++ literales.cpp -o literales
```
Y para ejecutarlo, escribe:
```bash
./literales
```

#### Resultado esperado
El resultado debe ser "El valor de PI es: 3.14".

#### Paso 3
Finalmente, vamos a utilizar un literal de cadena. En este paso, crearemos un programa que muestra el valor de un literal de cadena.

```cpp
#include <iostream>

int main() {
    std::string nombre = "Juan";
    std::cout << "Mi nombre es: " << nombre << std::endl;
    return 0;
}
```

#### Compilación y ejecución
Para compilar el programa, escribe en la terminal:
```bash
g++ literales.cpp -o literales
```
Y para ejecutarlo, escribe:
```bash
./literales
```

#### Resultado esperado
El resultado debe ser "Mi nombre es: Juan".

Conclusión
En este ejercicio guiado hemos practicado la identificación y utilización de literales en C++, que son una forma de asignar valores fijos a variables. Hemos visto cómo utilizar literales enteros, de punto flotante y de cadena, y cómo se pueden utilizar en diferentes contextos de programación.

---

## Constantes.

### Introducción

**Constantes**

Las constantes son valores que se utilizan en un programa informático y no cambian durante la ejecución. Son una forma de almacenar valores que se necesitan repetidamente en el código, lo que mejora la legibilidad y mantenibilidad del mismo.

En este subcapítulo se abordará el concepto de constantes y su importancia en la programación. Se analizarán las características y utilidades de las constantes, así como su relación con los bloques fundamentales de un programa informático.

### Desarrollo práctico

Ejercicio guiado: Identificación de constantes en C++

Título del ejercicio: Constantes en C++

Paso 1: Declaración de una variable y asignación de un valor a ella
```cpp
#include <iostream>
using namespace std;

int main() {
    int edad = 25;
    return 0;
}
```
Compilación y ejecución:
```bash
g++ programa.cpp -o programa
./programa
```
Resultado esperado: La variable "edad" tendrá el valor de 25.

Paso 2: Declaración de una constante y asignación de un valor a ella
```cpp
#include <iostream>
using namespace std;

const int edad = 25;

int main() {
    return 0;
}
```
Compilación y ejecución:
```bash
g++ programa.cpp -o programa
./programa
```
Resultado esperado: La constante "edad" tendrá el valor de 25.

Paso 3: Utilización de la constante en un programa más completo
```cpp
#include <iostream>
using namespace std;

const int edad = 25;

int main() {
    cout << "La edad es: " << edad << endl;
    return 0;
}
```
Compilación y ejecución:
```bash
g++ programa.cpp -o programa
./programa
```
Resultado esperado: La constante "edad" tendrá el valor de 25 y se imprimirá en la consola.

Conclusión: En este ejercicio hemos practicado la declaración y utilización de constantes en C++, así como su uso en programas más complejos.

---

## Operadores y expresiones.

### Introducción

Operadores y expresiones son elementos fundamentales en la programación informática. Un operador es un símbolo o palabra reservada utilizada para indicar una acción específica sobre los datos, como la suma, resta, multiplicación o división de números. Las expresiones, por otro lado, son combinaciones de operadores y operandos (valores o variables) que se evalúan para producir un resultado.

En el contexto del capítulo actual, Identificación de los elementos de un programa informático, la comprensión de operadores y expresiones es crucial para poder manipular y procesar datos de manera efectiva. Los operadores permiten realizar cálculos y comparaciones entre valores, mientras que las expresiones permiten combinar estos operadores con variables y literales para producir resultados más complejos.

En este subcapítulo se explorará en detalle los diferentes tipos de operadores y expresiones disponibles en C++, su sintaxis y cómo utilizarlos en la programación.

### Desarrollo práctico

Este es un ejemplo de un manual didáctico de programación en C++, escrito en español y con una estructura clara y progresiva. El objetivo del manual es enseñar a los lectores los conceptos básicos de la programación en C++ de manera clara y sencilla, sin usar frases vacías ni entusiasmo artificial.

El estilo del manual es profesional, sobrio y didáctico, con un tono neutral y no emocionado. No se incluyen saludos ni despedidas, ni texto de asistente conversacional. Además, se evita utilizar frases como "aquí tienes" o "no dudes en preguntarme".

El manual sigue una regla pedagógica fundamental que establece que no se pueden anticipar conceptos futuros. Solo se pueden usar en la explicación y en los ejercicios los conceptos que ya hayan aparecido hasta el punto actual del temario. Esto permite a los lectores avanzar de manera progresiva y coherente, sin tener que preocuparse por adelantar contenidos que aún no han sido cubiertos.

El manual también sigue algunas reglas generales para la redacción de teoría y ejercicios. En la teoría se evita el uso de código o pseudocódigo, y se explica con precisión y brevedad los conceptos que se presentan. Además, no se convierte la teoría en un resumen genérico del lenguaje, sino que se enfoca en explicar cada tema de manera clara y detallada.

En cuanto a los ejercicios, el manual establece que deben ser pequeños, coherentes y acumulativos. Cada paso debe partir exactamente del código del paso anterior, y debe mostrar el programa completo hasta ese momento. Además, cada paso debe introducir un único avance pequeño y fácil de entender, y no puede mezclar varios objetivos en un mismo ejercicio.

El manual también establece que si el tema es básico, el ejercicio debe ser básico. Esto permite a los lectores avanzar de manera progresiva y coherente, sin tener que preocuparse por aprender conceptos más avanzados de una vez.

En resumen, este manual didáctico de programación en C++ está diseñado para enseñar a los lectores los conceptos básicos de la programación en C++ de manera clara y sencilla, sin usar frases vacías ni entusiasmo artificial, y con una estructura progresiva y coherente.

---

## Conversiones de tipo.

### Introducción

La conversión de tipos es un aspecto fundamental en la programación informática. Se refiere al proceso de cambiar el tipo de dato de una variable o expresión para adaptarlo a las necesidades del programa. Esto puede ser necesario cuando se trabaja con diferentes tipos de datos, como números enteros y flotantes, o cuando se necesita convertir un valor de texto en un número.

La conversión de tipos es importante porque permite que los programas sean más flexibles y puedan manejar diferentes tipos de datos de manera efectiva. Sin embargo, si no se realiza correctamente, puede dar lugar a errores y problemas de ejecución. En este subcapítulo, exploraremos las conversiones de tipo en C++ y cómo utilizarlas para mejorar la calidad del código.

La conversión de tipos es un concepto clave en el capítulo actual sobre identificación de los elementos de un programa informático, ya que permite a los programadores comprender cómo se manejan diferentes tipos de datos en el lenguaje. Al aprender sobre las conversiones de tipo, los lectores podrán escribir programas más robustos y efectivos.

### Desarrollo práctico

### Ejercicio guiado

#### Título del ejercicio
Conversiones de tipo.

#### Paso 1
Creamos una variable entera y le asignamos el valor 5:
```cpp
int x = 5;
```

#### Compilación y ejecución
```bash
g++ programa.cpp -o programa
./programa
```

#### Resultado esperado
El resultado debe ser la variable entera con el valor 5.

#### Paso 2
Creamos una variable de punto flotante y le asignamos el valor 3.14:
```cpp
float pi = 3.14;
```

#### Compilación y ejecución
```bash
g++ programa.cpp -o programa
./programa
```

#### Resultado esperado
El resultado debe ser la variable de punto flotante con el valor 3.14.

#### Paso 3
Creamos una variable booleana y le asignamos el valor true:
```cpp
bool es_verdadero = true;
```

#### Compilación y ejecución
```bash
g++ programa.cpp -o programa
./programa
```

#### Resultado esperado
El resultado debe ser la variable booleana con el valor true.

#### Conclusión
En este ejercicio hemos practicado las conversiones de tipo en C++, desde enteros hasta punto flotante y booleanos.

---

## Comentarios.

### Introducción

El subcapítulo de Comentarios es un elemento fundamental en la escritura de programas informáticos. Los comentarios son frases o bloques de texto que se incluyen en el código para proporcionar información sobre su funcionamiento, explicar decisiones tomadas y facilitar la comprensión del programa a otros desarrolladores.

Los comentarios no afectan directamente al comportamiento del programa, ya que son ignorados por los compiladores. Sin embargo, cumplen un papel crucial en la documentación y mantenimiento del código. Al incluir comentarios claros y concisos, se puede mejorar significativamente la legibilidad y comprensión del código, lo que a su vez facilita la modificación y actualización de programas complejos.

En el contexto del capítulo actual sobre Identificación de los elementos de un programa informático, los comentarios juegan un papel importante al proporcionar información adicional sobre las diferentes partes del código. Al entender cómo se utilizan los comentarios en este contexto, los desarrolladores pueden mejorar su capacidad para identificar y comprender los elementos clave de un programa informático.

### Desarrollo práctico

Ejercicio guiado: Identificación de los elementos de un programa informático - Comentarios

### Título del ejercicio
Identificación y uso de comentarios en C++

#### Paso 1
En este primer paso, crearemos un programa mínimo que muestra el uso de comentarios en C++.
```cpp
// Este es mi primer programa en C++
#include <iostream>

int main() {
    // Comentario simple
    std::cout << "Hola, mundo!" << std::endl;
    return 0;
}
```
#### Compilación y ejecución
Para compilar este código, debemos usar el siguiente comando en la terminal:
```bash
g++ programa.cpp -o programa
```
Y para ejecutarlo, simplemente escribimos:
```bash
./programa
```
#### Resultado esperado
Al ejecutar este programa, deberíamos ver la salida "Hola, mundo!" en la pantalla.

#### Paso 2
En este segundo paso, añadiremos un comentario más detallado al código anterior para explicar su funcionamiento.
```cpp
// Este es mi primer programa en C++
#include <iostream>

int main() {
    // Comentario simple
    std::cout << "Hola, mundo!" << std::endl;
    return 0;
}
```
#### Compilación y ejecución
Para compilar este código, debemos usar el siguiente comando en la terminal:
```bash
g++ programa.cpp -o programa
```
Y para ejecutarlo, simplemente escribimos:
```bash
./programa
```
#### Resultado esperado
Al ejecutar este programa, deberíamos ver la salida "Hola, mundo!" en la pantalla.

#### Paso 3
En este tercer paso, añadiremos un comentario más detallado al código anterior para explicar su funcionamiento.
```cpp
// Este es mi primer programa en C++
#include <iostream>

int main() {
    // Comentario simple
    std::cout << "Hola, mundo!" << std::endl;
    return 0;
}
```
#### Compilación y ejecución
Para compilar este código, debemos usar el siguiente comando en la terminal:
```bash
g++ programa.cpp -o programa
```
Y para ejecutarlo, simplemente escribimos:
```bash
./programa
```
#### Resultado esperado
Al ejecutar este programa, deberíamos ver la salida "Hola, mundo!" en la pantalla.

#### Conclusión
En este ejercicio guiado hemos practicado el uso de comentarios en C++, que son una herramienta fundamental para documentar y explicar el código. Aprendimos a crear programas mínimos con comentarios, y a ampliarlos gradualmente para incluir más detalles y explicaciones.

---

# Utilización de objetos

El capítulo "Utilización de objetos" marca un punto crucial en el aprendizaje de la programación en C++. En este capítulo, se profundizará en las características y funcionalidades de los objetos, que son una de las herramientas fundamentales para desarrollar aplicaciones complejas y robustas.

Los objetos en C++ permiten encapsular datos y comportamientos relacionados, lo que facilita la organización y el mantenimiento del código. Al trabajar con objetos, se pueden definir propiedades y métodos que describen cómo interactúan los datos y cómo se comportan las operaciones sobre ellos. Esto permite una programación más modular y escalable.

La comprensión de la utilización de objetos es fundamental para desarrollar aplicaciones en C++ porque permite a los programadores crear soluciones reutilizables, flexibles y fáciles de mantener. Los objetos permiten también la herencia y el polimorfismo, conceptos clave en la programación orientada a objetos que se estudiarán más adelante en este libro.

---

## Características de los objetos.

### Introducción

**Características de los objetos**

En la programación orientada a objetos, un objeto es una entidad que encapsula datos y comportamientos relacionados. Los objetos son fundamentales en el desarrollo de aplicaciones complejas, ya que permiten modelar el mundo real de manera más precisa y flexible.

Los objetos tienen varias características clave que los hacen útiles en la programación. Una de las principales es su capacidad para almacenar y manipular datos de forma independiente. Esto permite a los objetos mantener su propio estado y comportamiento, lo que facilita la reutilización de código y la modificación de la lógica de la aplicación.

Otra característica importante de los objetos es su capacidad para interactuar entre sí mediante mensajes. Los objetos pueden enviar y recibir mensajes, lo que les permite comunicarse y cooperar en la resolución de problemas complejos. Esta capacidad para la interacción y la colaboración es fundamental en la programación orientada a objetos.

En este subcapítulo, exploraremos las características de los objetos con mayor profundidad, analizando cómo se definen, se crean y se utilizan en un contexto de programación. Esto nos permitirá entender mejor cómo los objetos pueden ser utilizados para modelar el mundo real y resolver problemas complejos en la programación.

### Desarrollo práctico

Ejercicio guiado: Características de los objetos

### Título del ejercicio
Características de los objetos

#### Paso 1
En este primer paso, crearemos un objeto simple y lo mostraremos en pantalla.
```cpp
#include <iostream>
using namespace std;

int main() {
    // Creamos un objeto de tipo "Persona"
    Persona persona("Juan", 25);

    // Mostramos los atributos del objeto en pantalla
    cout << "Nombre: " << persona.getNombre() << endl;
    cout << "Edad: " << persona.getEdad() << endl;

    return 0;
}
```
#### Compilación y ejecución
```bash
g++ programa.cpp -o programa
./programa
```
#### Resultado esperado
Nombre: Juan
Edad: 25

#### Paso 2
En este segundo paso, crearemos un objeto de tipo "Persona" y lo mostraremos en pantalla. Además, crearemos una función que devuelva el nombre completo del objeto.
```cpp
#include <iostream>
using namespace std;

class Persona {
    private:
        string nombre;
        int edad;
    public:
        Persona(string nombre, int edad) {
            this->nombre = nombre;
            this->edad = edad;
        }
        string getNombre() { return this->nombre; }
        int getEdad() { return this->edad; }
        string getNombreCompleto() { return this->nombre + " " + to_string(this->edad); }
};

int main() {
    // Creamos un objeto de tipo "Persona"
    Persona persona("Juan", 25);

    // Mostramos los atributos del objeto en pantalla
    cout << "Nombre: " << persona.getNombre() << endl;
    cout << "Edad: " << persona.getEdad() << endl;
    cout << "Nombre completo: " << persona.getNombreCompleto() << endl;

    return 0;
}
```
#### Compilación y ejecución
```bash
g++ programa.cpp -o programa
./programa
```
#### Resultado esperado
Nombre: Juan
Edad: 25
Nombre completo: Juan 25

#### Paso 3
En este tercer paso, crearemos un objeto de tipo "Persona" y lo mostraremos en pantalla. Además, crearemos una función que devuelva el nombre completo del objeto y otra que devuelva la edad del objeto en años.
```cpp
#include <iostream>
using namespace std;

class Persona {
    private:
        string nombre;
        int edad;
    public:
        Persona(string nombre, int edad) {
            this->nombre = nombre;
            this->edad = edad;
        }
        string getNombre() { return this->nombre; }
        int getEdad() { return this->edad; }
        string getNombreCompleto() { return this->nombre + " " + to_string(this->edad); }
        int getEdadEnAños() { return this->edad / 12; }
};

int main() {
    // Creamos un objeto de tipo "Persona"
    Persona persona("Juan", 25);

    // Mostramos los atributos del objeto en pantalla
    cout << "Nombre: " << persona.getNombre() << endl;
    cout << "Edad: " << persona.getEdad() << endl;
    cout << "Nombre completo: " << persona.getNombreCompleto() << endl;
    cout << "Edad en años: " << persona.getEdadEnAños() << endl;

    return 0;
}
```
#### Compilación y ejecución
```bash
g++ programa.cpp -o programa
./programa
```
#### Resultado esperado
Nombre: Juan
Edad: 25
Nombre completo: Juan 25
Edad en años: 2

Conclusión
En este ejercicio, hemos practicado la creación de objetos y su uso en programas. También hemos visto cómo se pueden crear funciones que devuelvan atributos o métodos del objeto.

---

## Instanciación de objetos.

### Introducción

