# Entornos de desarrollo

**Author:** Jose Vicente Carratala Sanchis

## Table of contents

- [Desarrollo de software](#desarrollo-de-software)
  - [Concepto de programa informático](#concepto-de-programa-informatico)
  - [Código fuente, código objeto y código ejecutable; tecnologías de virtualización](#codigo-fuente-codigo-objeto-y-codigo-ejecutable-tecnologias-de-virtualizacion)
  - [Tipos de lenguajes de programación. Paradigmas](#tipos-de-lenguajes-de-programacion-paradigmas)
  - [Características de los lenguajes más difundidos](#caracteristicas-de-los-lenguajes-mas-difundidos)
  - [Fases del desarrollo de una aplicación análisis, diseño, codificación, pruebas, documentación, explotación y mantenimiento, entre otras](#fases-del-desarrollo-de-una-aplicacion-analisis-diseno-codificacion-pruebas-documentacion-explotacion-y-mantenimiento-entre-otras)
  - [Proceso de obtención de código ejecutable a partir del código fuente; herramientas implicadas](#proceso-de-obtencion-de-codigo-ejecutable-a-partir-del-codigo-fuente-herramientas-implicadas)
  - [Metodologías ágiles. Técnicas. Características](#metodologias-agiles-tecnicas-caracteristicas)
  - [Ejercicio de final de unidad](#ejercicio-de-final-de-unidad)
- [Instalación y uso de entornos de desarrollo](#instalacion-y-uso-de-entornos-de-desarrollo)
  - [Funciones de un entorno de desarrollo](#funciones-de-un-entorno-de-desarrollo)
  - [Instalación de un entorno de desarrollo](#instalacion-de-un-entorno-de-desarrollo)
  - [Uso básico de un entorno de desarrollo](#uso-basico-de-un-entorno-de-desarrollo)
  - [Personalización del entorno de desarrollo temas, estilos de codificación, módulos y extensiones, entre otras](#personalizacion-del-entorno-de-desarrollo-temas-estilos-de-codificacion-modulos-y-extensiones-entre-otras)
  - [Edición de programas](#edicion-de-programas)
  - [Generación de ejecutables en distintos entornos](#generacion-de-ejecutables-en-distintos-entornos)
  - [Herramientas y automatización](#herramientas-y-automatizacion)
  - [Ejercicio de final de unidad](#ejercicio-de-final-de-unidad-1)
- [Diseño y realización de pruebas](#diseno-y-realizacion-de-pruebas)
  - [Planificación de Pruebas](#planificacion-de-pruebas)
  - [Tipos de pruebas Funcionales, estructurales y regresión, entre otras](#tipos-de-pruebas-funcionales-estructurales-y-regresion-entre-otras)
  - [Procedimientos y casos de prueba](#procedimientos-y-casos-de-prueba)
  - [Pruebas de Código Cubrimiento, valores límite y clases de equivalencia, entre otras](#pruebas-de-codigo-cubrimiento-valores-limite-y-clases-de-equivalencia-entre-otras)
  - [Pruebas unitarias; herramientas de automatización](#pruebas-unitarias-herramientas-de-automatizacion)
  - [Documentación de las incidencias](#documentacion-de-las-incidencias)
  - [Dobles de prueba. Tipos. Características](#dobles-de-prueba-tipos-caracteristicas)
  - [Ejercicio de final de unidad](#ejercicio-de-final-de-unidad-2)
- [Optimización y documentación](#optimizacion-y-documentacion)
  - [Refactorización](#refactorizacion)
  - [Analizadores de código](#analizadores-de-codigo)
  - [Control de versiones. Estructura de las herramientas de control de versiones](#control-de-versiones-estructura-de-las-herramientas-de-control-de-versiones)
  - [Ejercicio de final de unidad](#ejercicio-de-final-de-unidad-3)
  - [Examen final](#examen-final)
- [Repositorio. Herramientas de control de versiones. Uso integrado en el entorno de desarrollo](#repositorio-herramientas-de-control-de-versiones-uso-integrado-en-el-entorno-de-desarrollo)
  - [Repositorios remotos](#repositorios-remotos)
  - [Documentación. Uso de comentarios. Alternativas](#documentacion-uso-de-comentarios-alternativas)
  - [Integración continua. Herramientas](#integracion-continua-herramientas)
  - [Simulacro examen](#simulacro-examen)
  - [Ejercicio de final de unidad](#ejercicio-de-final-de-unidad-4)
- [Elaboración de diagramas de clases](#elaboracion-de-diagramas-de-clases)
  - [Clases. Atributos, métodos y visibilidad](#clases-atributos-metodos-y-visibilidad)
  - [Objetos. Instanciación](#objetos-instanciacion)
  - [Relaciones. Asociación, navegabilidad y multiplicidad. Herencia, composición, agregación. Realización y dependencia](#relaciones-asociacion-navegabilidad-y-multiplicidad-herencia-composicion-agregacion-realizacion-y-dependencia)
  - [Notación de los diagramas de clases](#notacion-de-los-diagramas-de-clases)
  - [Herramientas](#herramientas)
  - [Generación automática de código. Ingeniería inversa](#generacion-automatica-de-codigo-ingenieria-inversa)
- [Elaboración de diagramas de comportamiento](#elaboracion-de-diagramas-de-comportamiento)
  - [Clases. Atributos, métodos y visibilidad](#clases-atributos-metodos-y-visibilidad-1)
  - [Objetos. Instanciación](#objetos-instanciacion-1)
  - [Relaciones. Asociación, navegabilidad y multiplicidad. Herencia, composición, agregación. Realización y dependencia](#relaciones-asociacion-navegabilidad-y-multiplicidad-herencia-composicion-agregacion-realizacion-y-dependencia-1)
  - [Notación de los diagramas de clases](#notacion-de-los-diagramas-de-clases-1)
  - [Herramientas](#herramientas-1)
  - [Generación automática de código. Ingeniería inversa](#generacion-automatica-de-codigo-ingenieria-inversa-1)
- [Programacion en entorno servidor](#programacion-en-entorno-servidor)
  - [PHP](#php)
  - [Conexion a MySQL desde PHP](#conexion-a-mysql-desde-php)
  - [get y post en PHP](#get-y-post-en-php)
  - [recuperacion de emails con imap](#recuperacion-de-emails-con-imap)
- [Actividad libre de final de evaluación - La milla extra](#actividad-libre-de-final-de-evaluacion-la-milla-extra)
  - [La Milla Extra - Primera evaluación](#la-milla-extra-primera-evaluacion)

---

<a id="desarrollo-de-software"></a>
# Desarrollo de software

<a id="concepto-de-programa-informatico"></a>
## Concepto de programa informático

El concepto de programa informático es una estructura fundamental que abarca desde el primer pensamiento hasta la ejecución final del software. Un programa informático es un conjunto de instrucciones que se diseñan para resolver un problema o realizar una tarea específica en un ordenador. Estas instrucciones pueden ser escritas en lenguajes de programación, como Java, Python o C++, y son interpretadas por el sistema operativo del computador.

La creación de un programa informático implica varios pasos. Primero, se identifica el problema que se desea resolver. Luego, se diseña una solución al problema en forma de algoritmo, que es una secuencia lógica de instrucciones para resolver el problema. Este diseño puede ser representado mediante diagramas de flujo o pseudocódigo.

Una vez diseñado el algoritmo, se traduce a un lenguaje de programación específico. Este proceso implica la definición de variables, la creación de funciones y la implementación de estructuras de control como bucles y condicionales. Es importante que cada instrucción sea precisa y clara para evitar errores en el programa.

El siguiente paso es probar el programa. Esto se realiza mediante pruebas unitarias, donde se verifica que cada parte del programa funcione correctamente, así como pruebas integrales, donde se evalúa la interacción entre diferentes partes del sistema. La depuración es un proceso crucial para identificar y corregir errores en el código.

Una vez que el programa ha sido probado y depurado, se documenta. Esta documentación incluye explicaciones de cómo funciona el programa, los algoritmos utilizados y las funciones principales. Es importante que la documentación sea clara y accesible para facilitar su mantenimiento y futuras modificaciones.

El proceso de desarrollo de un programa informático no termina con su implementación. Es esencial realizar pruebas adicionales en entornos de producción para asegurar que el software funciona como se espera en condiciones reales. Además, es común que los sistemas necesiten actualizaciones periódicas para incorporar nuevas funcionalidades o solucionar problemas.

La evolución del desarrollo de software ha llevado a la creación de metodologías ágiles, que enfatizan la colaboración entre equipos y el adaptabilidad frente al cambio. Estas metodologías promueven un enfoque iterativo y incremental en el desarrollo de software, permitiendo una mayor flexibilidad y eficiencia.

En resumen, el concepto de programa informático abarca desde la identificación del problema hasta su implementación y mantenimiento. Involucra el diseño de algoritmos, la traducción a lenguaje de programación, pruebas y depuración, documentación y actualizaciones periódicas. Es un proceso complejo pero esencial para crear software eficiente y funcional que cumpla con las necesidades de los usuarios.

### Introduccion

```markdown
El procesador procesa procesos

Procesador es un componente físico
Procesa es un verbo, es decir, toma procesos y los ejecuta

Y un proceso es cada una de las tareas que se le encomiendan a un procesador para que las compute

Un programa informático, genera un proceso

Y el proceso se ejecuta contra el procesador
```

### holamundo

```python
print("Hola mundo")
```

<a id="codigo-fuente-codigo-objeto-y-codigo-ejecutable-tecnologias-de-virtualizacion"></a>
## Código fuente, código objeto y código ejecutable; tecnologías de virtualización

El desarrollo de software es una actividad compleja que requiere una comprensión profunda del ciclo de vida completo de un programa informático. En este proceso, el código fuente, el código objeto y el código ejecutable desempeñan papeles cruciales, cada uno con características distintas y funciones específicas.

El código fuente es la versión original y legible del programa que los programadores escriben en lenguajes de alto nivel. Este texto plano contiene las instrucciones necesarias para que un compilador o intérprete genere el código objeto. El código fuente es fundamental porque refleja la idea inicial del software, su funcionalidad y su estructura.

El código objeto, por otro lado, es una versión intermedia del programa que ha sido traducida desde el lenguaje de alto nivel al lenguaje de máquina o a un lenguaje más cercano. Este archivo binario contiene instrucciones que pueden ser ejecutadas directamente por la computadora. El código objeto es crucial para el proceso de compilación y enlazado, que prepara el programa para su ejecución.

El código ejecutable es el resultado final del proceso de compilación y enlazado. Este archivo contiene todo lo necesario para que la computadora pueda interpretar e implementar las instrucciones del programa. El código ejecutable es el programa listo para ser corrido, y es lo que los usuarios finales interactúan.

La virtualización es una tecnología que permite crear entornos de ejecución aislados dentro de un sistema operativo host. Esta técnica es especialmente útil en el desarrollo de software, ya que permite probar diferentes configuraciones y versiones del sistema sin afectar la estabilidad del sistema principal. La virtualización facilita la creación de entornos de desarrollo consistentes y replicables, lo que mejora la calidad y la eficiencia del proceso de desarrollo.

En el contexto del desarrollo de software, la comprensión de estos conceptos es esencial para los programadores. El código fuente es su herramienta principal para expresar ideas, mientras que el código objeto y el código ejecutable son los productos finales de su trabajo. La virtualización ofrece una herramienta poderosa para mejorar la eficiencia y la calidad del desarrollo. Comprender estos conceptos y cómo interactúan entre sí es fundamental para cualquier profesional en el campo de la programación.

### Lenguaje interpretado

```python
print("Hola mundo")
```

### lenguaje compilado

```
#include <iostream>
using namespace std;
 
int main(){
  std::cout << "Hola mundo desde C++";
  return 0;
}
```

### virtualizacion

```markdown
# Lenguajes compilados

A partir del codigo fuente, generan un archivo aparte
Ese archivo esta compilado, es binario, y es ejecutable

Desventaja: lo de compilar es un rollo
Ventaja: seguridad (el codigo esta dentro del archivo binario), y velocidad - los archivos compilados son mas rapidos que cualquier otro tipo de archivo

Ejemplos: ensamblador, C++, C, etc

# Lenguajes de máquina virtual

No se ejecutan directamente contra el ordenador
Se instala una máquina virtual intermedia
-Máquina virtual de Java - Java
-Máquina virtual .NET - C#

El código no se convierte a codigo binario
Sino a un bytecode (un codigo intermedio)

Ejemplos: Java, C#

# Lenguajes interpretados:

Requieren de un intérprete
El lenguaje se interpreta y se ejecuta en tiempo real
Es mucho más cómodo
Elrendimiento de los programas es menor (la ejecución es más lenta)
```

### Resumen

```markdown
El código fuente es el contenido textual de mi programa
Pero el texto no se puede ejecutar directamente.

En los lenguajes compilados (C, C++), el código se "compila", y eso quiere decir que, mediante un programa (el compilador) se convierte a otro archivo, que es binario, y que es ejecutable

Ese archivo archivo binario se ejecuta directamente contra el sistema operativo

En los lenguajes interpretados, el código se lanza contra el intérprete, y el intérprete ya se encarga de compilarlo, y ejecutarlo

Más fácil para el usuario, más rápido desde el punto del desarrollador (humano)
Más lento desde el punto de vista de la ejecución

Quieres desarollar rapido y fácil? Python - tu programa será lento
Quieres que tu programa sea rapido y potente? C++ - pero no va a ser fácil
```

<a id="tipos-de-lenguajes-de-programacion-paradigmas"></a>
## Tipos de lenguajes de programación. Paradigmas

En el vasto e interminable universo de la programación, los lenguajes de programación son como las herramientas que un carpintero utiliza para construir una casa. Cada uno tiene sus propias características únicas, su propio conjunto de reglas y técnicas específicas, y es capaz de crear obras maestras en su campo. En esta sección, nos adentramos en el fascinante mundo de los lenguajes de programación, explorando sus tipos y paradigmas.

El primer tipo que debemos conocer son los lenguajes imperativos. Estos son como las instrucciones claras que un maestro le da a un estudiante para resolver un problema matemático. En el ámbito de la programación, los lenguajes imperativos siguen este enfoque, proporcionando una serie de comandos específicos y secuenciales que el programa debe seguir para lograr su objetivo. Ejemplos populares incluyen C, Java y Python.

A diferencia de los lenguajes imperativos, los lenguajes funcionales son como un jardín bien organizado. En lugar de dar instrucciones paso a paso sobre cómo hacer algo, estos lenguajes nos permiten describir qué queremos lograr y dejar que el compilador o intérprete se encargue del resto. Lenguajes como Haskell y Lisp son excelentes ejemplos de este paradigma.

Los lenguajes orientados a objetos son como una biblioteca bien catalogada. En lugar de tratar todo como un conjunto de instrucciones, estos lenguajes nos permiten crear "objetos" que contienen tanto datos (propiedades) como comportamientos (métodos). Cada objeto puede interactuar con otros objetos, creando una red compleja y flexible de relaciones. Lenguajes populares en este paradigma incluyen Java, Python y Ruby.

Los lenguajes declarativos son como un chef que describe qué plato quiere preparar, pero no cómo hacerlo paso a paso. En el ámbito de la programación, esto significa describir lo que queremos lograr sin preocuparnos por los detalles del proceso. Lenguajes como SQL y HTML son ejemplos de este paradigma.

Además de estos cuatro paradigmas principales, existen otros lenguajes que combinan diferentes enfoques. Por ejemplo, los lenguajes multi-paradigma permiten a los programadores usar cualquier enfoque que deseen para resolver un problema, lo que les da la flexibilidad de elegir el mejor enfoque para cada situación.

El paradigma orientado a aspectos es como una biblioteca que no solo organiza libros por género, sino también por temas comunes. En este paradigma, los programadores pueden dividir su código en "aspectos" que abordan problemas específicos, como la gestión de errores o el manejo de transacciones. Esto permite una mejor organización del código y facilita su mantenimiento.

Finalmente, los lenguajes basados en prototipos son como un taller donde se crean nuevos objetos a partir de otros existentes, modificándolos según sea necesario. En lugar de definir clases con métodos y propiedades, estos lenguajes usan objetos como plantillas para crear nuevos objetos. JavaScript es un ejemplo destacado de este paradigma.

Cada uno de estos tipos de lenguajes y paradigmas tiene sus fortalezas y debilidades, y la elección del adecuado depende del problema que se quiera resolver y las preferencias personales del programador. Al explorar estos diferentes enfoques, los estudiantes de programación adquieren una comprensión más profunda de cómo funcionan los sistemas informáticos y desarrollan habilidades cruciales para abordar cualquier desafío que les pueda surgir en su camino.

En resumen, el estudio de los tipos de lenguajes de programación y sus paradigmas es un viaje fascinante a través del mundo digital. Cada uno ofrece una perspectiva única sobre cómo resolver problemas y crear software, y al dominarlos, los programadores adquieren las herramientas necesarias para construir sistemas complejos y eficientes.

### Intoduccion

```markdown
# Clasificación de lenguajes:

Lenguajes de muy bajo nivel:

Lenguajes máquina:
Código máquina / código binario
11100110100101001001010101

Ensamblador:
Recurre a mnemónicos
Permite al usuario programar con mayor facilidad

Lenguajes de bajo nivel:
C - C++
Lenguajes escritos en un lenguaje cercano al humano
Pero todavía requieren muchos conocimientos
Son propensos a fallos
Pero son muy potentes

Lenguajes de nivel intermedio
Java
Suponen abstracciones y simplificaciones que nos ayudan a programar mejor
No nos dan tanto control
No son tan rapidos como los lenguajes de bajo nivel
Pero son más fáciles

Lenguajes de alto nivel:
Python y Javascript
Muy sencillos
Tienen abstracciones fuertes
Nos quitan el control
Y son lenguajes comparativamente muy lentos
```

### Paradigmas

```markdown
Paradigma estructurado

Lenguajes que van "desde arriba hasta abajo"
Muy sencillos, para tareas básicos
Pero hacer software complicado, es complejo
Tipicos de los años 50, 60, y 70

Paradigma orientado a objetos

Los objetos nos permiten aprovechar mejor de la reutilización de código
Nos permiten abordar proyectos de software más grandes

Multiparadigma:

Lenguajes de programación (C++, Python, JS), que soportan multiples paradigmas al mismo tiempo
El programador puede elegir entre los paradigmas
```

<a id="caracteristicas-de-los-lenguajes-mas-difundidos"></a>
## Características de los lenguajes más difundidos

En el campo del desarrollo de software, los lenguajes de programación desempeñan un papel fundamental como las herramientas con las que los desarrolladores expresan sus ideas y soluciones. Cada uno de estos lenguajes tiene características distintivas que lo hacen más adecuado para ciertos tipos de proyectos o paradigmas de desarrollo.

Uno de los lenguajes más populares y versátiles es Java, conocido por su robustez y portabilidad. Su sintaxis limpia y estructurada facilita la lectura y mantenimiento del código, lo que lo hace ideal para aplicaciones empresariales y sistemas complejos. Además, Java cuenta con una extensa biblioteca estándar (JDK) y un ecosistema de herramientas robusto, como el JDK Development Kit (JDK), que facilita la creación y gestión de proyectos.

Python es otro lenguaje de programación de gran popularidad, especialmente en el ámbito del análisis de datos y aprendizaje automático. Su sintaxis intuitiva y legible lo hace perfecto para principiantes y expertos alike. Python cuenta con una gran cantidad de bibliotecas y frameworks que facilitan tareas como la manipulación de datos, visualización y aprendizaje automático, lo que lo convierte en una opción popular para proyectos de ciencia de datos y análisis.

C#, por otro lado, es el lenguaje de programación principal de Microsoft. Su sintaxis similar a Java lo hace familiar para desarrolladores con experiencia en este lenguaje. C# se utiliza principalmente para la creación de aplicaciones de escritorio, web y móviles, así como para el desarrollo de juegos utilizando motores como Unity. Además, su soporte para programación orientada a objetos y paradigmas funcionales lo hace una opción sólida para proyectos empresariales.

JavaScript es un lenguaje de programación interpretado que se ejecuta en los navegadores web. Su capacidad para interactuar con el contenido del navegador lo convierte en esencial para el desarrollo front-end, permitiendo la creación de interfaces interactivas y dinámicas. Además, JavaScript puede ser utilizado en el back-end a través de frameworks como Node.js, lo que lo hace una opción versátil para proyectos web completos.

Ruby es un lenguaje de programación interpretado conocido por su simplicidad y legibilidad. Su filosofía enfatiza la productividad y la felicidad del desarrollador, lo que lo hace ideal para proyectos pequeños a mediana escala. Ruby on Rails es un popular framework web que facilita el desarrollo rápido de aplicaciones web, lo que lo convierte en una opción popular entre los desarrolladores.

Swift es el lenguaje de programación utilizado por Apple para el desarrollo de aplicaciones iOS y macOS. Su sintaxis moderna y segura lo hace ideal para crear aplicaciones robustas y eficientes. Además, Swift cuenta con un ecosistema de herramientas sólido que facilita la creación y depuración de proyectos.

Go es un lenguaje de programación compilado conocido por su simplicidad y eficiencia. Su diseño enfatiza la concurrencia y la productividad, lo que lo hace ideal para aplicaciones distribuidas y sistemas intensivos en I/O. Go cuenta con una biblioteca estándar rica y herramientas de desarrollo robustas, lo que facilita su uso en proyectos empresariales.

Kotlin es un lenguaje de programación multiparadigma desarrollado por JetBrains. Su sintaxis similar a Java lo hace familiar para desarrolladores con experiencia en este lenguaje. Kotlin se utiliza principalmente para el desarrollo de aplicaciones Android y backend, lo que lo convierte en una opción popular entre los desarrolladores de Android.

C++, aunque no es tan popular como algunos de sus hermanos modernos, sigue siendo un lenguaje de programación poderoso y eficiente. Su capacidad para controlar directamente la memoria y su sintaxis similar a C lo hacen ideal para aplicaciones que requieren alto rendimiento y acceso al hardware. C++ se utiliza principalmente en el desarrollo de sistemas operativos, videojuegos y software especializado.

Cada uno de estos lenguajes tiene sus propias fortalezas y debilidades, y la elección del lenguaje adecuado depende del proyecto específico, las necesidades del cliente y las preferencias personales del desarrollador. Aunque cada lenguaje tiene su propio conjunto de características, todos comparten el objetivo común de facilitar la creación de software eficiente, robusto y funcional.

### Lenguajes más comunes hoy

```markdown
September 2025

Python 25.98%
C++ 8.8%
C 8.65%
Java 8.35%
C# 6.38%
Javascript 3.22%

https://www.tiobe.com/tiobe-index/

Evolución de los lenguajes de programación

Python: Crecimiento brutal
C++ se mantiene
C se  mantiene un poco a la baja
Java está a la baja
C# lenguaje propietario, minoritario, cuota afianzada
Tiene su cuota de mercado gracias a la web
```

<a id="fases-del-desarrollo-de-una-aplicacion-analisis-diseno-codificacion-pruebas-documentacion-explotacion-y-mantenimiento-entre-otras"></a>
## Fases del desarrollo de una aplicación análisis, diseño, codificación, pruebas, documentación, explotación y mantenimiento, entre otras

El desarrollo de software es una etapa compleja que requiere una organización meticulosa y un enfoque sistemático. Este proceso se divide en varias fases interconectadas, cada una con su propio conjunto de actividades y responsabilidades. Comenzamos por el análisis, donde se comprende completamente las necesidades del proyecto y se definen los requisitos funcionales y no funcionales.

El análisis es la base sobre la cual se construirá todo el resto del desarrollo. Aquí, se lleva a cabo una investigación exhaustiva para identificar los problemas que el software debe resolver y cómo debe interactuar con otros sistemas o usuarios. Se crean diagramas de casos de uso y se documentan las funcionalidades esperadas, asegurando que todos los interesados estén alineados en lo que se pretende lograr.

El siguiente paso es el diseño, donde se crea una representación visual del software. Este proceso implica la definición de arquitecturas, interfaces y componentes que serán utilizados para construir el sistema. Se crean diagramas de clases, secuencia y colaboración para ilustrar cómo los diferentes elementos interactuarán entre sí.

La codificación es donde se transforma el diseño en código ejecutable. Este paso requiere un alto nivel de atención a los detalles y una comprensión profunda del lenguaje de programación utilizado. Se escriben funciones, métodos y clases que implementen las funcionalidades definidas en el diseño.

La codificación es seguida por pruebas, donde se verifica que el software cumpla con los requisitos establecidos. Se realizan pruebas unitarias para asegurar que cada componente funcione correctamente, pruebas de integración para comprobar cómo los diferentes componentes interactúan entre sí y pruebas de sistema para evaluar la funcionalidad global del software.

La documentación es un aspecto crucial del desarrollo de software. Se crean manuales de usuario, guías técnicas y documentos de diseño que describen el funcionamiento del software y cómo se debe utilizar. Esta documentación facilita tanto el mantenimiento como la escalabilidad del proyecto.

El explotación es la fase en la que el software se lanza al mercado o a un entorno de producción real. Durante esta etapa, se realiza una supervisión continua para detectar y corregir problemas emergentes. Se llevan a cabo pruebas de rendimiento y seguridad para asegurar que el software funcione eficientemente y esté protegido contra amenazas.

El mantenimiento es un proceso continuo que se realiza después del explotación. Incluye la corrección de errores, la adición de nuevas características y la actualización del software para adaptarse a cambios en las necesidades del usuario o en el entorno tecnológico. El mantenimiento también implica la documentación de los cambios realizados y la preparación de nuevos lanzamientos.

Cada una de estas fases es crucial para el éxito del proyecto de desarrollo de software. No existe un camino directo hacia el final; cada paso depende del resultado del anterior. Es importante mantener una comunicación clara y continua entre todos los miembros del equipo, así como mantenerse actualizado con las mejores prácticas y tecnologías disponibles.

El desarrollo de software es un viaje complejo que requiere paciencia, dedicación y una visión crítica. Cada fase contribuye al logro final del producto, pero juntas forman un proceso integral que asegura la calidad y el éxito del proyecto.

### Introduccion

```markdown
Antes de pensar en desarrollar deberías:

# Análisis de las necesidades del mercado
Analiza el mercado y lo que el mercado necesita y en definitva las oportunidades de desarrollo

# Diseño

Antes de ponerte a programar, planifica como será la aplicación, en qué tecnologías estará hecha, que archivos tendrá que estrategias utilizarás

# Codificación:
Escribir el código propiamente del programa informático

# Pruebas
Una vez que el código está hecho, pruebalo
Haz pruebas, refactoriza, mejora el código

# Documentación
El codigo ya funciona
Haz un manual
Di como lo has hecho

# Explotación

Lanza el software a producción
Instalalo sobre un servidor
Los usuarios empiezan a utilizarlo
Habrá actualizaciones que hacer (correctivo)

# Mantenimiento

Actualizar?
Como se adapta a las nuevas necesidades de los usuarios?
Que ocurre cuando acaba el ciclo de vida de una aplicación
```

### repaso

```markdown
Mejorar la vida de las personas

Detectar necesidades que tienen las personas

-Analisis 
Analizamos la naturaleza del problema, pensamos si la informática puede aportar solucion, analizamos el entorno, el mercado, la competencia, si encontramos que no existe solución, y nosotros la podemos crear, resolvemos crear una aplicación informática.
"Se necesita realizar un programa de la lista de la compra"

-Diseño (design):
Planificación de los recursos necesarios para poder acometer el proyecto y solucionar el problema dado. Eleccion de tenologias, elección de metodologías, selección de recursos, planficación temporal.
"Quiero hacer un programa en python que guarde una lista de la compra en txt. Ese necesario una base de datos para esto? NO"
"Voy a hacer un programa en consola que tenga dos funciones, que tenga por una parte poder meter nuevos elementos de la lista de la compra, y que pueda listar cosas de la lista"

-Codificación:
```

### programa lista de la compra

```python
while True:
  print("Escoge una opcion")
  print("1.-insertar un elemento")
  print("2.-Listar elementos")
  opcion = int(input("Escoge tu opcion: "))

  if opcion == 1:
    archivo = open("listadelacompra.txt","a")
    elemento = input("Introduce el nombre del elemento: ")
    archivo.write(elemento+"\n")
    archivo.close()
  elif opcion == 2:
    archivo = open("listadelacompra.txt","r")
    lineas = archivo.readlines()
    for linea in lineas:
      print(linea)
    archivo.close()
```

### pruebas

```python
while True:
  print("Escoge una opcion")
  print("1.-insertar un elemento")
  print("2.-Listar elementos")
  opcion = int(input("Escoge tu opcion: "))

  if opcion == 1:
    archivo = open("listadelacompra.txt","a")
    elemento = input("Introduce el nombre del elemento: ")
    archivo.write(elemento+"\n")
    archivo.close()
  elif opcion == 2:
    archivo = open("listadelacompra.txt","r")
    lineas = archivo.readlines()
    for linea in lineas:
      print(linea)
    archivo.close()
```

### modificacion tras prueba fallida

```python
while True:
  print("Escoge una opcion")
  print("1.-insertar un elemento")
  print("2.-Listar elementos")
  try:
    opcion = int(input("Escoge tu opcion: "))
  except:
    print("No valido, asumo 2")
    opcion = 2
  if opcion == 1:
    archivo = open("listadelacompra.txt","a")
    elemento = input("Introduce el nombre del elemento: ")
    archivo.write(elemento+"\n")
    archivo.close()
  elif opcion == 2:
    archivo = open("listadelacompra.txt","r")
    lineas = archivo.readlines()
    for linea in lineas:
      print(linea)
    archivo.close()
```

### vamos a comentar el software

```python
'''
  Micro lista de la compra v0.1
  Escoge entre dos opciones
  Puedes insertar tantos elementos como quieras
  (c) 2025 Jose Vicente Carratala
'''

while True:
  print("Escoge una opcion")
  print("1.-insertar un elemento")
  print("2.-Listar elementos")
  # Bloque para intentar convertir la opcion a entero
  try:
    opcion = int(input("Escoge tu opcion: "))
  except:
    print("No valido, asumo 2")
    opcion = 2
  if opcion == 1:
    archivo = open("listadelacompra.txt","a")
    elemento = input("Introduce el nombre del elemento: ")
    archivo.write(elemento+"\n")
    archivo.close()
  elif opcion == 2:
    archivo = open("listadelacompra.txt","r")
    lineas = archivo.readlines()
    for linea in lineas:
      print(linea)
    archivo.close()
```

### Archivo sin título

```

```

### listadelacompra

```
manzanas
peras
```

<a id="proceso-de-obtencion-de-codigo-ejecutable-a-partir-del-codigo-fuente-herramientas-implicadas"></a>
## Proceso de obtención de código ejecutable a partir del código fuente; herramientas implicadas

El proceso de obtención de código ejecutable a partir del código fuente es un paso fundamental en el desarrollo de software, que implica una serie de transformaciones y conversiones necesarias para convertir el código escrito por los desarrolladores en programas funcionales. Este proceso se descompone en varias etapas clave, cada una con sus propias herramientas y técnicas.

La primera etapa del proceso es la compilación, donde el compilador traduce el código fuente de alto nivel (como Java o C++) a código intermedio que puede ser ejecutado por un intérprete. Este código intermedio suele estar en una forma que sea más eficiente para la máquina virtual, como bytecode en el caso de Java.

La siguiente etapa es la interpretación, donde el intérprete ejecuta directamente el código intermedio. Esta fase es útil durante el desarrollo porque permite una rápida corrección y depuración del código. Sin embargo, su velocidad puede ser inferior a la de los programas compilados directamente a código máquina.

La optimización es un paso crucial que se realiza después de la compilación pero antes de la generación del código ejecutable final. Durante esta etapa, el compilador realiza diversas transformaciones en el código intermedio para mejorar su eficiencia y rendimiento. Esto puede implicar la eliminación de partes innecesarias del código, la optimización de bucles y estructuras de datos, entre otros.

La siguiente herramienta es el enlazador, que une los diferentes archivos objeto generados por el compilador en un solo archivo ejecutable. Este proceso incluye la asignación de direcciones de memoria a las funciones y variables, la eliminación de referencias redundantes y la inserción de código necesario para la inicialización de variables globales.

La virtualización es una técnica avanzada que permite ejecutar programas en diferentes entornos sin necesidad de instalarlos directamente en el sistema operativo. Herramientas como Docker o VirtualBox utilizan esta tecnología para crear contenedores o máquinas virtuales donde se ejecutan los programas, lo que facilita la portabilidad y la replicación del entorno de desarrollo.

La empaquetado es un paso final importante que prepara el software para su distribución. Herramientas como Maven o Gradle en Java, o npm o yarn en JavaScript, automatizan este proceso, creando paquetes que contienen todo lo necesario para ejecutar el programa, incluyendo dependencias y configuraciones.

La instalación del software es la fase final donde los usuarios pueden instalar el programa en su sistema operativo. Herramientas como InstallShield o WiX Toolset facilitan este proceso, creando instaladores que manejan la configuración de permisos, la creación de shortcuts y la gestión de actualizaciones.

Cada una de estas herramientas juega un papel crucial en el flujo completo del desarrollo de software, desde la escritura del código hasta su distribución final. Su correcta utilización es esencial para asegurar que los programas sean eficientes, seguros y fáciles de usar. A través de este proceso, los desarrolladores pueden crear aplicaciones robustas y funcionales que satisfagan las necesidades de sus usuarios finales.

### Ejemplo en python

```python
print("Hola mundo")
```

### explicacion

```markdown
Python es un lenguaje de programacion que no genera ejecutables
El codigo de Python se lanza directamente contra el intérprete, y no genera ejecutables binarios

PERO, hay otros lenguajes que si que necesitan ser compilados

Por ejemplo, C y C++
```

### hola mundo en C

```
#include <stdio.h>            // Esto incluye la libreria de entrada y salida

int main(){                   // Esto es la funcion principal
  printf("Hola mundo en C");  // Esto es la salida por consola
  return 0;                   // Esto es la salida de la funcion
}

// gcc 003-hola\ mundo\ en\ C.c -o ejecutable.out
```

### Explicacion

```markdown
Existen lenguajes como C o C++ que SI que requieren un proceso de compilación para ejecutar el software
```

<a id="metodologias-agiles-tecnicas-caracteristicas"></a>
## Metodologías ágiles. Técnicas. Características

La exploración del desarrollo de software nos lleva a una rica variedad de metodologías que han surgido para abordar los desafíos complejos de la creación de aplicaciones. En esta carpeta, nos centramos en las metodologías ágiles, un enfoque revolucionario que ha ganado popularidad en los últimos años debido a su capacidad para adaptarse rápidamente a cambios y mejorar la calidad del producto final.

Las metodologías ágiles se caracterizan por sus principios de colaboración, flexibilidad y entrega temprana de valor. En lugar de seguir un enfoque lineal y riguroso, estas metodologias promueven una iterativa y incremental construcción del software, permitiendo a los equipos responder rápidamente a la retroalimentación y adaptarse a las necesidades cambiantes.

Una de las técnicas más conocidas dentro de las metodologías ágiles es el Scrum. Este enfoque divide el desarrollo en sprints cortos, generalmente de dos a cuatro semanas, durante los cuales se realiza trabajo definido, revisado y ajustado. El Scrum se basa en reuniones regulares llamadas sprint planning, daily stand-up y review, que aseguran una comunicación continua y un control constante del progreso.

Otra técnica importante es el Kanban, que utiliza un tablero visual para gestionar el flujo de trabajo. Este método enfatiza la visibilidad del proceso y permite identificar rápidamente las barreras o problemas en el camino hacia la entrega del producto. El Kanban se basa en principios de Lean Manufacturing, promoviendo una optimización continua y eliminación de desperdicios.

Además, existen metodologías ágiles como Lean Software Development, que se centra en eliminar todo lo que no aporte valor al cliente final, enfocándose en la eficiencia y la simplicidad. Esta metodología promueve una cultura de continuidad del aprendizaje y mejora continua, asegurando que el software sea siempre lo más simple y eficiente posible.

El Extreme Programming (XP) es otra técnica ágil que destaca por su enfoque en prácticas individuales y colaborativas. XP promueve la escritura de pruebas automatizadas, refactoring continuo, revisión continua del código y retroalimentación constante. Estas prácticas ayudan a garantizar la calidad del software mientras se desarrolla.

Las metodologías ágiles no solo ofrecen técnicas específicas para el desarrollo de software, sino que también promueven un enfoque centrado en el cliente y la entrega de valor. En lugar de esperar hasta el final del proyecto para presentar todo el producto, las metodologías ágiles permiten a los equipos demostrar progresos y recibir feedback temprano, lo que facilita la adaptación y mejora continua.

Además, estas metodologias fomentan un ambiente de trabajo colaborativo y empático. Los equipos trabajan juntos en sprints cortos, lo que promueve la comunicación fluida, el aprendizaje continuo y la creación de una cultura de innovación. El enfoque ágil valoriza las habilidades individuales y colectivas, fomentando un sentido de pertenencia y compromiso entre los miembros del equipo.

En conclusión, las metodologías ágiles representan una revolución en el desarrollo de software, ofreciendo técnicas innovadoras y prácticas centradas en la entrega temprana de valor. Al adoptar estas metodologias, los equipos pueden adaptarse rápidamente a cambios, mejorar la calidad del producto final y crear un ambiente de trabajo colaborativo y empático. En esta carpeta, hemos explorado algunas de las técnicas más populares dentro de las metodologías ágiles, pero hay muchas más para descubrir y experimentar en el camino hacia una entrega continua y satisfactoria del software.

### Metodologías ágiles

```markdown
# Agile

Facilitar el trabajo en equipo
Facilitar el desarrollo iterativo

No voy a ser demasiado estricto con las metodologías ágiles

Es normal que los proyectos de programación son difíciles de gestionar en equipos
Son difíciles de gestionar por una sola persona
```

<a id="ejercicio-de-final-de-unidad"></a>
## Ejercicio de final de unidad

### actividad

```markdown

```


<a id="instalacion-y-uso-de-entornos-de-desarrollo"></a>
# Instalación y uso de entornos de desarrollo

<a id="funciones-de-un-entorno-de-desarrollo"></a>
## Funciones de un entorno de desarrollo

El entorno de desarrollo es el escenario donde se llevan a cabo todas las actividades necesarias para crear, probar y mantener un programa informático. Este espacio virtual proporciona herramientas y recursos que facilitan la codificación, depuración y ejecución del software.

En primer lugar, los entornos de desarrollo ofrecen una interfaz gráfica intuitiva que permite a los programadores visualizar y editar el código fuente con facilidad. Esta interfaz suele incluir áreas para escribir y ver el código en tiempo real, así como paneles adicionales para mostrar la estructura del proyecto, las variables locales y los errores de compilación.

Además, los entornos de desarrollo incorporan herramientas de autocompletado y sugerencias de código que aceleran el proceso de codificación. Estas características inteligentes pueden identificar automáticamente posibles errores o ineficiencias en el código y ofrecer soluciones propuestas, lo que mejora la calidad del software y reduce el tiempo de desarrollo.

La capacidad de ejecutar el código directamente desde el entorno de desarrollo es otra ventaja importante. Esto permite a los programadores probar rápidamente sus modificaciones sin necesidad de compilar o instalar el programa en un sistema operativo completo, lo que facilita la iteración y la depuración del software.

Además, los entornos de desarrollo suelen proporcionar herramientas para gestionar versiones del código. Esta funcionalidad permite a los programadores mantener múltiples versiones del mismo proyecto, comparar cambios entre ellas y revertir a versiones anteriores si es necesario. Esto es especialmente útil en proyectos colaborativos donde varias personas pueden trabajar simultáneamente en el mismo código.

La integración de herramientas para la documentación también es una característica comunes en los entornos de desarrollo modernos. Estas herramientas permiten a los programadores generar automáticamente documentación del código, lo que facilita su mantenimiento y comprensión por parte de otros miembros del equipo o usuarios finales.

Los entornos de desarrollo también ofrecen funcionalidades para la depuración del código. Esto incluye el uso de puntos de interrupción, inspección de variables y seguimiento del flujo de ejecución, lo que es crucial para identificar y solucionar problemas en el software.

Además, los entornos de desarrollo suelen proporcionar herramientas para la gestión de proyectos. Estas características pueden incluir el control de versiones, la planificación de tareas y la colaboración en tiempo real, facilitando la organización del trabajo en equipos.

La personalización es otra característica importante de los entornos de desarrollo. Los usuarios pueden ajustar las preferencias del entorno para adaptarlo a sus necesidades específicas, desde temas visuales hasta el tamaño de la fuente y los atajos de teclado.

En conclusión, el entorno de desarrollo es una herramienta fundamental en el proceso de desarrollo de software. Ofrece un conjunto completo de recursos que facilitan la codificación, depuración y ejecución del código, lo que mejora la eficiencia y calidad del producto final.

### entornos de desarrollo

```markdown
# Es el sistema informático en el cual vamos a desarrollar nuestro software

Sistema informático es la suma de:

- Hardware (qué tiene tu ordenador, en el que vas a desarrollar código)
- SSOO (Windows, Mac, Linux)
- Aplicación con la que vas a editar código

Cuanto mejor ordenador tengas, más rápido vas a compilar, más memoria tendrás para tus programas, más rápido se ejecutarán
Para programar no se requiere un ordenador especialmente potente
2025 - mínimo, 8 nucleos, 8 gigas de RAM, disco duro de 250GB

En cuanto a SSOO:
Se puede desarrollar con comodidad en Windows, macOS, o Linux
No se puede desarrollar en Android o iOS

Aplicación para hacer código:

Hay infinidad de aplicaciones

# Características de los editores:

1. Colorean el código - hacerte más fácil programar y encontrar errores
2. Compilan/interpretan/ejecutan el código 
3. Tienen ayudas y complementos
4. Tienen vista de proyecto
```

<a id="instalacion-de-un-entorno-de-desarrollo"></a>
## Instalación de un entorno de desarrollo

La instalación de un entorno de desarrollo es una etapa crucial en el proceso de creación de software, ya que proporciona las herramientas necesarias para escribir, depurar y ejecutar programas. Un entorno de desarrollo integrado (IDE) no solo facilita la codificación sino que también ofrece funcionalidades adicionales como autocompletado, depuración y visualización de variables, lo que puede acelerar significativamente el proceso de desarrollo.

El primer paso en la instalación de un entorno de desarrollo es seleccionar una herramienta adecuada. Existen varias opciones disponibles, cada una con sus propias ventajas y desventajas. Algunas populares incluyen Visual Studio Code, IntelliJ IDEA, Eclipse y NetBeans. Cada uno de estos IDEs tiene características distintivas que pueden ser más o menos útiles dependiendo del tipo de proyecto y las preferencias personales del desarrollador.

Una vez seleccionado el entorno de desarrollo, la siguiente etapa es la instalación propiamente dicha. La mayoría de los IDEs ofrecen paquetes de instalación fáciles de usar que pueden ser ejecutados desde un archivo ejecutable o desde una interfaz gráfica. Es importante seguir las instrucciones proporcionadas durante el proceso de instalación para asegurar que todas las dependencias necesarias sean correctamente configuradas.

Durante la instalación, es posible que se solicite la selección de componentes adicionales a instalar. Estos pueden incluir herramientas de control de versiones como Git, bibliotecas de terceros o plugins útiles para el lenguaje de programación utilizado. Es recomendable seleccionar solo los componentes necesarios para evitar un uso innecesario de recursos.

Después de la instalación, es importante configurar el entorno de desarrollo según las necesidades del proyecto. Esto puede incluir la configuración de variables de entorno, la selección de un intérprete o compilador específico, y la configuración de plugins adicionales si se requieren. La configuración correcta es crucial para que el IDE funcione correctamente y pueda proporcionar todas las características esperadas.

Una vez configurado, el entorno de desarrollo está listo para su uso. Es importante familiarizarse con las herramientas disponibles y aprender a utilizarlas eficientemente. Algunos aspectos clave incluyen la creación de proyectos, la edición de código fuente, la depuración de programas y la ejecución de pruebas unitarias.

La instalación y configuración del entorno de desarrollo es un proceso que requiere atención y dedicación, pero su resultado es una herramienta poderosa que puede mejorar significativamente la eficiencia y calidad del trabajo de programación. Con el tiempo y la práctica, se convertirá en una parte natural del flujo de trabajo del desarrollador, facilitando el desarrollo de software y permitiendo un mayor nivel de productividad.

### Instalacion de visual studio

```markdown
# Instalación de Visual Studio Code:

Entramos en la web: 
https://code.visualstudio.com/

Una vez que está descargado, ejecutamos el instalador:

Una vez que está instalado, a continuación lo abrimos
```

### Instalacion de netbeans

```markdown
Netbeans es un entorno de desarrollo especializado en el mundo Java (y tangenciales)

https://netbeans.apache.org/
```

<a id="uso-basico-de-un-entorno-de-desarrollo"></a>
## Uso básico de un entorno de desarrollo

En el mundo digital del desarrollo de software, los entornos de desarrollo desempeñan un papel crucial como la base sobre la cual se construyen las aplicaciones. Un entorno de desarrollo es una colección de herramientas y recursos que facilitan la creación, depuración, pruebas y documentación de programas informáticos.

El uso básico de un entorno de desarrollo es el primer paso en este proceso transformador. Este submódulo nos guía a través de las operaciones fundamentales que uno debe conocer para comenzar a trabajar eficazmente con cualquier sistema de codificación. Comenzamos por entender qué funciones desempeña un entorno de desarrollo, y luego exploramos cómo instalarlo en nuestro sistema operativo.

La instalación es el primer paso crucial, ya que sin ella no podemos utilizar ninguna de las herramientas disponibles dentro del entorno. El proceso puede variar dependiendo del sistema operativo y la plataforma utilizada, pero generalmente implica descargar un paquete, ejecutar un instalador y seguir una serie de pasos para configurar el entorno.

Una vez instalado, es esencial conocer cómo utilizarlo de manera eficiente. Esto incluye aprender a abrir y cerrar proyectos, navegar por la interfaz gráfica del entorno, y entender cómo se organizan los archivos y carpetas dentro del mismo. El uso básico también implica saber cómo escribir y ejecutar código, así como cómo depurar errores que puedan surgir durante el proceso.

Además de las operaciones básicas, es importante aprender a personalizar el entorno para adaptarlo a nuestras necesidades específicas. Esto puede implicar cambiar temas, configurar estilos de codificación, instalar módulos y extensiones adicionales, o incluso modificar la estructura del entorno para mejorar su eficiencia.

El uso básico también aborda cómo editar programas. Esto implica aprender a escribir código en diferentes lenguajes de programación, entender las sintaxis específicas de cada uno, y conocer las mejores prácticas para el desarrollo de software. Además, es crucial saber cómo guardar cambios y versionar nuestro código, lo que nos permite mantener un historial de nuestras modificaciones y revertir a versiones anteriores si es necesario.

La importancia del uso básico de un entorno de desarrollo no puede subestimarse. Es la base sobre la cual se construyen habilidades más avanzadas en el desarrollo de software. A través de este proceso, aprendemos a trabajar eficientemente con herramientas complejas, a gestionar proyectos de manera organizada y a depurar problemas que pueden surgir durante el desarrollo.

En resumen, el uso básico de un entorno de desarrollo es una etapa fundamental en el camino hacia la creación de aplicaciones informáticas. A través de este proceso, adquirimos las habilidades básicas necesarias para trabajar con herramientas avanzadas y desarrollar software eficazmente. Este submódulo nos guía a través de los pasos iniciales que son esenciales para comenzar cualquier proyecto de desarrollo de software, preparándonos para el mundo más complejo y desafiante del desarrollo de aplicaciones informáticas.

### Uso basico

```markdown
# Primer arranque

Ejecutamos asistente de Copilot

Arranco sesion o con GitHub o con Google

# creamos un nuevo archivo - de python

Creo un archivo llamado priemraprueba.py

Instalar el interprete de Python para visual studio

Las extensiones son ampliaciones de la funcionalidad del entorno de desarrollo
Son complementos, plugins, añadidos

# Aparece boton de play

El entorno de desarrollo te facilita tareas tales como por ejemplo la escritura y la ejecución de código

Herramientas de detección de erores de sintaxis

Te permite arreglar el código incluso con inteligencia artificial

Permite tener una vista a la izquierda con una estructura de proyecto
```

<a id="personalizacion-del-entorno-de-desarrollo-temas-estilos-de-codificacion-modulos-y-extensiones-entre-otras"></a>
## Personalización del entorno de desarrollo temas, estilos de codificación, módulos y extensiones, entre otras

El entorno de desarrollo es el escenario donde los programadores crean, prueban y depuran sus programas informáticos. Su personalización juega un papel crucial en la eficiencia y productividad del trabajo, permitiendo a los desarrolladores adaptar su espacio de trabajo para optimizar su flujo de trabajo.

La personalización del entorno de desarrollo se centra en varios aspectos fundamentales: temas, estilos de codificación, módulos y extensiones. Cada uno de estos elementos contribuye al crecimiento y evolución del entorno, adaptándolo a las preferencias individuales y necesidades específicas del desarrollador.

El tema del entorno es una característica visual que puede variar desde colores oscuros hasta tonos suaves, dependiendo de la preferencia personal. Un buen tema debe facilitar la lectura del código al minimizar el contraste entre los elementos visuales y permitir un alto nivel de contrastancia entre texto y fondo.

Los estilos de codificación son conjuntos predefinidos de reglas que determinan cómo se formatea el código fuente. Estos estilos pueden incluir espacios en blanco, indentación, nombres de variables y funciones, entre otros. La elección del estilo de codificación debe ser consistente y seguir las convenciones establecidas por la comunidad o el proyecto al que pertenece.

Los módulos son componentes reutilizables que pueden ser incluidos en el entorno de desarrollo para facilitar ciertas tareas comunes. Por ejemplo, un módulo podría proporcionar funciones para manejar la manipulación de archivos o para realizar operaciones matemáticas complejas. Los módulos permiten una organización modular del código y su reutilización en diferentes proyectos.

Las extensiones son complementos adicionales que amplían las funcionalidades del entorno de desarrollo. Estas pueden incluir herramientas para la depuración, plugins para el análisis de rendimiento, o incluso interfaces gráficas personalizadas. Las extensiones permiten a los desarrolladores añadir funcionalidades específicas según sus necesidades.

La personalización del entorno de desarrollo no es solo una cuestión estética; también tiene un impacto significativo en la productividad y el bienestar del programador. Un entorno adecuadamente configurado puede reducir el tiempo necesario para realizar tareas repetitivas, mejorar la legibilidad del código y facilitar la colaboración con otros desarrolladores.

Además de estos elementos visuales y funcionales, la personalización del entorno también incluye la organización del espacio de trabajo. Esto puede implicar la disposición de los paneles de edición, el uso de separadores verticales o horizontales, y la configuración de vistas específicas para diferentes tipos de proyectos.

En conclusión, la personalización del entorno de desarrollo es un proceso activo que requiere reflexión y adaptabilidad. Al dedicarle tiempo a configurar su espacio de trabajo de manera eficiente, los desarrolladores pueden aumentar significativamente su productividad y disfrutar de una experiencia más placentera mientras crean software.

### Personalizacion

```markdown
# Personalización

## Cambio de color del tema

Podemos cambiar el patron de colores de fondo

## Aumentar el tamaño del texto

Control + + aumentar el zoom de la interfaz completa
Control + - disminuir el zoom de la interfaz completa

No solo puedo cambiar el tamaño de la interfaz completa
Sino que también puedo cambiar fuente y tamaño de la fuente del editor concreto

# Atencion

No os recomiendo meteros demasiado dentro de visual studio porque os podéis perder
Os podéis distraer de lo imporante: y lo importante es aprender el código
```

<a id="edicion-de-programas"></a>
## Edición de programas

En el mundo digital de la programación, los entornos de desarrollo son como las herramientas que nos permiten crear y gestionar nuestros proyectos. En esta subunidad didáctica, nos centramos específicamente en cómo editar programas, un aspecto esencial del flujo de trabajo de cualquier desarrollador.

La edición de programas implica la modificación directa del código fuente con el fin de añadir nuevas funcionalidades, corregir errores o optimizar el rendimiento. Este proceso requiere una comprensión profunda del lenguaje de programación y las estructuras de datos que se utilizan en el proyecto.

Para comenzar a editar un programa, es fundamental conocer la sintaxis correcta del lenguaje utilizado. Cada lenguaje tiene sus propias reglas gramaticales y convenciones estilísticas, por lo que aprender estas puede facilitar enormemente el proceso de edición. Además, es crucial entender los conceptos básicos de programación como variables, funciones, estructuras de control (como bucles y condicionales) y objetos.

La práctica constante es la clave para mejorar en la edición de programas. Cada error que se corrige y cada mejora que se realiza en el código nos lleva un paso más cerca del objetivo final. Es importante no temer a cometer errores, ya que son una parte natural del aprendizaje y contribuyen significativamente al desarrollo de habilidades críticas.

Además de la edición directa del código, es común utilizar herramientas gráficas para diseñar interfaces de usuario o diagramas de clases. Estas herramientas pueden facilitar el trabajo en equipo y asegurar que todos los miembros del proyecto estén alineados con las mismas expectativas sobre cómo debe verse y funcionar la aplicación final.

La edición de programas también implica la depuración, un proceso crucial para identificar y corregir errores. Las herramientas de depuración permiten ejecutar el código paso a paso, observando los valores de las variables y el flujo de control en tiempo real. Esta habilidad es fundamental para mantener el código limpio, eficiente y fácil de entender.

En la era digital actual, la edición de programas no se limita solo al desarrollo local. Muchas veces, es necesario trabajar en entornos remotos o colaborar con otros desarrolladores a través de plataformas de control de versiones como Git. Estas herramientas facilitan el trabajo en equipo y aseguran que todos los miembros del proyecto estén trabajando con la misma versión del código.

La edición de programas es un proceso continuo, siempre hay algo nuevo que aprender y mejorar. Cada proyecto es único, lo que significa que cada desafío también es diferente. Pero con práctica constante y una actitud abierta a nuevas tecnologías y métodos, cualquier desarrollador puede mejorar sus habilidades en la edición de programas.

En resumen, la edición de programas es un aspecto fundamental del desarrollo de software. Requiere conocimientos profundos del lenguaje de programación, habilidades prácticas y una actitud constante de aprendizaje. A través de la práctica y la experiencia, cualquier desarrollador puede mejorar sus habilidades en esta área crítica del trabajo en el campo de la informática.

### introduccion

```markdown
Herramientas como Visual Studio tienen ayudantes de IA
En el caso de Visual Studio es Copilot
Y nos permiten ser más productivos en el desarrollo

PEro cuidado porque la IA está para ayudarnos
Pero no para que la IA haga las cosas y nosotros no aprendamos a hacerlas
```

### construyo un programa

```python
# Quiero iterar uno a uno en todos los dias del mes

for dia in range(1, 32):
    print("Hoy es dia", dia)

# Quiero hacer una estructura if para saber si una persona es mayor de edad
edad = 18
if edad >= 18:
    print("Eres mayor de edad")
else:
    print("Eres menor de edad")
```

<a id="generacion-de-ejecutables-en-distintos-entornos"></a>
## Generación de ejecutables en distintos entornos

En el mundo de la programación, los entornos de desarrollo son como las herramientas que nos permiten crear, depurar y ejecutar nuestro código. A lo largo de este camino, una tarea fundamental es generar ejecutables en distintos entornos, un proceso que puede parecer complicado pero que es esencial para asegurar la portabilidad y la funcionalidad de nuestros programas.

La generación de ejecutables en diferentes entornos implica comprender cómo se traduce el código fuente a código ejecutable que pueda ser interpretado o compilado por un sistema operativo. Este proceso puede variar significativamente dependiendo del lenguaje de programación y del tipo de entorno en el que estamos trabajando.

En primer lugar, es importante destacar la importancia de tener conocimiento sobre las diferencias entre los diferentes tipos de ejecutables. Por ejemplo, mientras algunos lenguajes como Java generan bytecode que se ejecuta en una Máquina Virtual (JVM), otros como C++ producen código binario directamente para el procesador del sistema operativo. Esta diversidad plantea desafíos y oportunidades en la generación de ejecutables.

El proceso de generación de ejecutables comienza con la compilación del código fuente, una fase donde el compilador traduce el código escrito por el programador a un lenguaje intermedio o directamente a código objeto. Este paso es crucial porque permite que el código sea más eficiente y reduzca la dependencia de los detalles específicos del entorno en el que se está trabajando.

Una vez obtenido el código objeto, este puede ser enlazado con bibliotecas y otros archivos necesarios para formar un ejecutable completo. Este proceso de enlace es particularmente importante en lenguajes como C++, donde las funciones pueden definirse en diferentes archivos y necesitan ser vinculadas correctamente para que el programa funcione.

Además, la generación de ejecutables puede implicar la creación de instaladores o paquetes autoinstalables. Estos son archivos especiales que contienen todo lo necesario para instalar un programa en un sistema operativo, incluyendo los archivos binarios, configuraciones y recursos necesarios. La creación de estos paquetes es una tarea importante porque facilita la distribución y el uso del software.

En entornos de desarrollo modernos, herramientas automatizadas pueden simplificar significativamente el proceso de generación de ejecutables. Estas herramientas pueden compilar el código fuente, enlazar los archivos necesarios y crear instaladores o paquetes autoinstalables con solo unos pocos clics. Aunque estas herramientas pueden ahorrar tiempo y esfuerzo, es importante entender cómo funcionan internamente para poder resolver problemas que puedan surgir.

La generación de ejecutables en distintos entornos también implica considerar la compatibilidad entre diferentes sistemas operativos. Por ejemplo, un programa escrito en C++ puede ser compilado y ejecutado tanto en Windows como en Linux o macOS, pero es importante asegurarse de que todas las dependencias necesarias estén disponibles en cada uno de estos entornos.

En conclusión, la generación de ejecutables en distintos entornos es un paso fundamental en el desarrollo de software. Aunque puede parecer complejo al principio, con una comprensión adecuada del proceso y la utilización de herramientas modernas, se convierte en una tarea relativamente sencilla. Este conocimiento es esencial para asegurar que nuestros programas sean portables, funcionen correctamente en diferentes entornos y puedan ser distribuidos eficientemente a los usuarios finales.

### ejemplo en C

```
// Quiero crear un hola mundo en C
#include <stdio.h>

int main() {
    printf("Hola, mundo!\n");
    return 0;
}
```

### Explicacion

```markdown
Creamos un proyecto en Visual Studio

Activamos la ayuda con Copilot

Instalamos el complemento compilador de C/C++

Aparece el boton de play en el editor

Pulsando el boton de play, compila, ejecuta y yo ni me entero
```

<a id="herramientas-y-automatizacion"></a>
## Herramientas y automatización

En el mundo de la programación, los entornos de desarrollo son como el escenario donde se realizan las obras maestras digitales. En esta carpeta, nos adentramos en un aspecto crucial de este escenario: las herramientas y la automatización.

Las herramientas son como las armas del artista digital. Desde los IDEs (Integrated Development Environments) hasta los compiladores y los simuladores, cada una tiene su propio conjunto de características únicas que facilitan el trabajo del programador. Un IDE, por ejemplo, es un entorno integrado que combina editor de código fuente, compilador, depurador y otros herramientas en una sola interfaz. Esto permite a los desarrolladores escribir, compilar y depurar su código en un solo lugar, lo que aumenta la eficiencia y reduce errores.

La automatización es el otro elemento fundamental de este capítulo. En el mundo digital, la repetición es una tarea tediosa y propensa a errores. Por eso, las herramientas de automatización son como los asistentes virtuales del programador. Automatizan tareas repetitivas, como la compilación del código, la ejecución de pruebas o la generación de documentación, liberando tiempo para el pensamiento creativo y la solución de problemas más complejos.

La combinación de estas herramientas y automatización es como tener un equipo completo a su disposición. Los IDEs ofrecen una interfaz amigable y funcionalidades avanzadas que facilitan el trabajo diario del programador, mientras que las herramientas de automatización se encargan de los aspectos repetitivos y tediosos, permitiendo así al desarrollador centrarse en lo que verdaderamente importa: la creación de soluciones innovadoras.

En esta carpeta, exploraremos cómo instalar y configurar estos entornos, cómo utilizarlos eficazmente para mejorar la productividad, y cómo integrar herramientas de automatización en el flujo de trabajo diario. Aprenderemos a optimizar nuestros procesos de desarrollo, reducir errores y aumentar la calidad del código final.

Es importante recordar que las herramientas y la automatización son útiles no solo para los programadores experimentados, sino también para aquellos que están empezando su viaje en el mundo digital. Con el tiempo y la práctica, se pueden aprender a utilizar estas herramientas de manera eficiente, lo que puede marcar una diferencia significativa en la calidad del trabajo y la velocidad con la que se desarrollan proyectos.

En resumen, esta carpeta es un viaje emocionante por el mundo de las herramientas y automatización en los entornos de desarrollo. Aprender a utilizarlas adecuadamente puede transformar el proceso de programación, haciendo que sea más eficiente, menos tedioso y mucho más gratificante. Así que, si quieres mejorar tus habilidades como programador, es hora de explorar estas herramientas y automatización en profundidad.

### Herramientas

```markdown
Los entornos de desarrollo, como visual studio, contienen herramientas para ampliar la funcionalidad del software

Y contienen complementos para ampliar las capacidades

Tenemos la ventana de complementos
Podemos buscar entre un catálogo impresionante de complementos
Y podemos hacer que visual studio haga lo que nosotros queremos

PERO lo hará visual studio, no nosotros
```

<a id="ejercicio-de-final-de-unidad-1"></a>
## Ejercicio de final de unidad

### actividad

```markdown

```


<a id="diseno-y-realizacion-de-pruebas"></a>
# Diseño y realización de pruebas

<a id="planificacion-de-pruebas"></a>
## Planificación de Pruebas

La planificación de pruebas es un proceso fundamental en el desarrollo de software que garantiza la calidad y confiabilidad del producto final. Este proceso implica una serie de actividades meticulosas diseñadas para identificar y corregir errores antes de que lleguen al usuario final.

El primer paso en la planificación de pruebas consiste en definir los objetivos específicos. Estos objetivos deben ser claros, medibles y alcanzables, asegurando que se aborden todas las áreas críticas del sistema. Por ejemplo, si el objetivo es garantizar que una aplicación web funcione correctamente en diferentes navegadores y dispositivos, entonces la planificación debe incluir pruebas exhaustivas para cada uno de estos escenarios.

Una vez definidos los objetivos, es crucial identificar las técnicas y métodos de prueba más adecuados. Esto puede implicar el uso de pruebas funcionales para verificar que todas las funcionalidades del sistema cumplen con los requisitos establecidos, o pruebas de rendimiento para evaluar la capacidad del sistema bajo carga. La elección del método depende del tipo de software y las necesidades específicas del proyecto.

La planificación también implica el diseño de casos de prueba. Cada caso de prueba debe ser independiente y completo, cubriendo todas las posibles entradas y salidas del sistema. Es importante que los casos de prueba sean realistas y reflejen las interacciones reales con el software, lo que aumenta la probabilidad de encontrar errores críticos.

Además de los casos de prueba individuales, es necesario planificar pruebas de integración para asegurar que todos los componentes del sistema funcionen juntos sin problemas. Esto puede implicar la creación de escenarios complejos donde varios módulos interactúan entre sí, lo que requiere una planificación cuidadosa y una ejecución meticulosa.

La planificación de pruebas también debe incluir el establecimiento de un cronograma detallado. Este cronograma debe considerar no solo la duración de cada fase de prueba, sino también los recursos necesarios para su realización. Es importante tener en cuenta que las pruebas pueden ser complejas y demandantes, por lo que es crucial planificar adecuadamente el tiempo necesario.

Además, la planificación de pruebas debe considerar la documentación. Es fundamental mantener un registro detallado de todos los pasos realizados durante el proceso de prueba, incluyendo los resultados obtenidos y las correcciones aplicadas. Esta documentación es invaluable para identificar tendencias, mejorar procesos futuros y demostrar la calidad del producto.

La planificación de pruebas también debe considerar la retroalimentación y revisión. Es importante que haya un mecanismo en place para recoger comentarios de los usuarios durante el proceso de prueba y utilizar esta información para mejorar el sistema. La revisión regular de los resultados de las pruebas puede ayudar a identificar áreas que requieren atención adicional y a asegurar que se cumplen todos los requisitos.

La planificación de pruebas es un proceso continuo y adaptativo, que debe evolucionar a lo largo del ciclo de desarrollo. Es importante mantenerse flexible y estar dispuesto a ajustar las estrategias de prueba según sea necesario para garantizar la calidad del producto final.

En conclusión, la planificación de pruebas es una etapa crucial en el desarrollo de software que requiere un enfoque sistemático y meticuloso. Al seguir los pasos adecuados y mantenerse al tanto de las mejores prácticas, se puede asegurar que el sistema final cumpla con todas las expectativas del usuario y sea robusto y confiable.

### Introduccion

```markdown
Cada software que construyamos debe soportar o debe ser sometido a una serie de pruebas para comprobar su estabilidad en cualquier supuesto

Es muy importante aislar el software en bloques (funciones, estamos empezando a ver clases) con el objetivo de que esos bloques se puedan probar individualmente
```

### operaciones

```python
operando1 = 4 
operando2 = 3
division = operando1/operando2

print(division)
```

### encapsulacion a funcion

```python
# encapsular el software en funciones

def division(operando1,operando):
  operando1 = 4 
  operando2 = 3
  division = operando1/operando2
  return division

print(division)
```

<a id="tipos-de-pruebas-funcionales-estructurales-y-regresion-entre-otras"></a>
## Tipos de pruebas Funcionales, estructurales y regresión, entre otras

La fase de diseño y realización de pruebas es una etapa crucial en el desarrollo de software, ya que asegura la calidad y confiabilidad del producto final. En esta subunidad didáctica, nos centraremos en los diversos tipos de pruebas que son fundamentales para garantizar que las aplicaciones cumplan con sus requisitos y funcionen correctamente.

Primero, es importante entender que existen varios tipos de pruebas, cada uno con su propio enfoque y objetivo. Las pruebas funcionales se centran en verificar que el software cumpla con los requerimientos especificados por el cliente o usuario final. Estas pruebas pueden ser realizadas a través de diversos métodos, como pruebas manuales, donde un humano interactúa directamente con la aplicación, o pruebas automáticas, donde scripts ejecutan automáticamente las acciones necesarias para verificar la funcionalidad.

Las pruebas estructurales, por otro lado, se enfocan en el análisis interno del código fuente y su estructura. Estas pruebas buscan identificar fallos en la lógica del programa, como errores de sintaxis o problemas de flujo de control. A través de técnicas como la cobertura de código, es posible medir qué porcentaje del código ha sido ejecutado durante las pruebas, lo que proporciona una medida de cuánto se ha probado.

Además, las pruebas de regresión son cruciales cuando se realizan cambios en el software. Estas pruebas buscan verificar que los cambios no hayan afectado a otras partes del sistema que funcionaban correctamente antes. Es una práctica esencial para mantener la estabilidad y funcionalidad del software a medida que evoluciona.

Otra categoría importante son las pruebas de integración, que se centran en el proceso de unir diferentes componentes o módulos del sistema y verificar que funcionen juntos como esperado. Estas pruebas pueden ser realizadas de manera manual o automática, dependiendo de la complejidad del sistema y los recursos disponibles.

Las pruebas de rendimiento son específicas para evaluar el desempeño del software bajo condiciones simuladas de carga. Son esenciales para identificar problemas de eficiencia que podrían afectar la experiencia del usuario final. Estas pruebas pueden incluir la medición del tiempo de respuesta, la capacidad de manejar un gran volumen de usuarios simultáneos y otros indicadores clave.

Las pruebas de seguridad son una parte integral del proceso de prueba, ya que aseguran que el software esté libre de vulnerabilidades potenciales. Estas pruebas pueden incluir la identificación de fallos en la autenticación, la protección contra inyecciones SQL y otras amenazas comunes.

Las pruebas de usabilidad son específicas para evaluar cómo los usuarios interactúan con el software y si éste cumple con las expectativas del usuario. Estas pruebas pueden incluir la realización de sesiones de prueba, la recolección de comentarios y la medición de métricas como el tiempo de respuesta y la satisfacción del usuario.

Finalmente, las pruebas de compatibilidad son esenciales para verificar que el software funcione correctamente en diferentes entornos y plataformas. Esto puede incluir pruebas en sistemas operativos alternativos, navegadores web distintos o dispositivos móviles.

Cada uno de estos tipos de pruebas desempeña un papel crucial en el proceso de desarrollo de software, proporcionando una visión completa del estado de la aplicación y ayudando a identificar áreas que requieren mejora. La elección y combinación adecuada de estas pruebas es fundamental para garantizar que las aplicaciones sean seguras, eficientes y satisfactorias para los usuarios finales.

La práctica regular y sistemática de estas pruebas no solo ayuda a mejorar la calidad del software, sino que también contribuye a un desarrollo más ágil y flexible. Al identificar problemas temprano en el ciclo de vida del proyecto, se pueden solucionar con menor costo y esfuerzo, lo que resulta en productos finalmente más robustos y satisfactorios.

En conclusión, la fase de diseño y realización de pruebas es una etapa integral del desarrollo de software que requiere un enfoque sistemático y diversificado. Al comprender y aplicar los diversos tipos de pruebas disponibles, se puede asegurar que las aplicaciones sean de alta calidad y cumplan con las expectativas tanto del cliente como del usuario final.

### regresion

```python
def operacionMatematica(operando1,operando2):
  suma = operando1 + operando2;
  return suma
  
print(operacionMatematica(1,2))
```

### aumento la capacidad

```python
def operacionMatematica(operando1,operando2,operacion):
  if operacion == "suma":
    suma = operando1 + operando2;
    return suma
  elif operacion == "resta":
    resta = operando1 - operando2
    return resta
  

print(operacionMatematica(1,2,"suma"))

print(operacionMatematica(1,2))
```

### arreglo para version anterior

```python
def operacionMatematica(operando1,operando2,operacion = None):
  if operacion == "suma":
    suma = operando1 + operando2;
    return suma
  elif operacion == "resta":
    resta = operando1 - operando2
    return resta
  
print("ejecucion 1")
print(operacionMatematica(1,2,"suma"))
print("ejecucion 2")
print(operacionMatematica(1,2,"resta"))
print("ejecucion 3")
print(operacionMatematica(1,2))
```

### controlo todos los casos posibles

```python
def operacionMatematica(operando1,operando2,operacion = None):
  if operacion == "suma":
    suma = operando1 + operando2;
    return suma
  elif operacion == "resta":
    resta = operando1 - operando2
    return resta
  elif operacion == "multiplicacion":
    multiplicacion = operando1 * operando2
    return multiplicacion
  elif operacion == "division":
    division = operando1 - operando2
    return division
  else:
    return 0
  
print("ejecucion 1")
print(operacionMatematica(1,2,"suma"))
print("ejecucion 2")
print(operacionMatematica(1,2,"resta"))
print("ejecucion 3")
print(operacionMatematica(1,2))
```

<a id="procedimientos-y-casos-de-prueba"></a>
## Procedimientos y casos de prueba

En el mundo de la programación, el diseño y realización de pruebas son pilares fundamentales que garantizan la calidad y la confiabilidad del software. A través de este proceso, los desarrolladores identifican errores y fallos en el código fuente antes de su implementación final, lo que permite una corrección temprana y eficiente.

El diseño de pruebas implica la planificación exhaustiva de escenarios posibles y las estrategias necesarias para verificar que el software cumpla con los requisitos establecidos. Este proceso requiere una comprensión profunda del funcionamiento del sistema, así como habilidades analíticas y creativas para anticipar problemas potenciales.

Los casos de prueba son documentos detallados que describen las condiciones bajo las cuales se ejecutarán pruebas específicas. Cada caso de prueba incluye entradas, acciones a realizar y resultados esperados, lo que permite una evaluación objetiva del comportamiento del software en diferentes situaciones.

La realización de pruebas es un proceso iterativo que implica la ejecución de los casos de prueba diseñados, el análisis de los resultados obtenidos y la corrección de cualquier fallo identificado. Este ciclo se repite hasta que todos los casos de prueba pasen satisfactoriamente, lo que indica que el software ha sido probado exhaustivamente.

Es importante destacar que el diseño y realización de pruebas no es una tarea aislada, sino un proceso integral que debe integrarse en todas las etapas del desarrollo del software. Esto implica la colaboración entre desarrolladores, testers y otros miembros del equipo para asegurar que se cubran todos los aspectos relevantes del sistema.

Además, el diseño de pruebas debe ser flexible y adaptable a cambios en el código fuente o en los requisitos del proyecto. Los casos de prueba deben actualizarse regularmente para reflejar cualquier modificación importante, lo que garantiza su relevancia y eficacia.

La realización de pruebas también implica la documentación exhaustiva de todos los pasos realizados, los resultados obtenidos y las correcciones aplicadas. Esta documentación es crucial para el mantenimiento del software a largo plazo, ya que proporciona una referencia valiosa para futuras modificaciones o actualizaciones.

En resumen, el diseño y realización de pruebas son procesos cruciales en la programación que garantizan la calidad y confiabilidad del software. A través de un enfoque sistemático y colaborativo, los desarrolladores pueden identificar y corregir errores temprano, lo que permite una entrega final más sólida y funcional del producto.

<a id="pruebas-de-codigo-cubrimiento-valores-limite-y-clases-de-equivalencia-entre-otras"></a>
## Pruebas de Código Cubrimiento, valores límite y clases de equivalencia, entre otras

La fase de diseño y realización de pruebas es una etapa fundamental del desarrollo de software que garantiza la calidad y la confiabilidad del producto final. En esta carpeta, se aborda un aspecto crucial de este proceso: las pruebas de Código Cubrimiento, valores límite y clases de equivalencia.

Las pruebas de Código Cubrimiento son una técnica utilizada para evaluar cuánto código fuente ha sido ejecutado durante el proceso de prueba. Este método busca asegurar que todas las ramas del código sean ejecutadas al menos una vez, lo que ayuda a identificar posibles fallos o errores que podrían no haberse detectado en pruebas anteriores. El objetivo es alcanzar un porcentaje de cubrimiento adecuado, generalmente el 80% o más, para garantizar la cobertura suficiente del código.

Los valores límite son una estrategia de prueba que se centra en los extremos de los rangos y conjuntos de datos. Al probar con valores límite, se verifica cómo el sistema maneja situaciones extremas, como el valor máximo o mínimo permitido. Esta técnica es especialmente importante para detectar errores relacionados con la validación de entrada y la gestión de excepciones.

Las clases de equivalencia son una metodología que agrupa conjuntos de datos en categorías más pequeñas basadas en su comportamiento esperado. Al realizar pruebas utilizando clases de equivalencia, se seleccionan representantes de cada clase para probar el sistema, lo que permite reducir la cantidad de pruebas necesarias mientras asegura que todas las posibles situaciones sean cubiertas.

Juntos, estos métodos proporcionan una visión integral del comportamiento del software bajo diferentes condiciones. La combinación de pruebas de Código Cubrimiento, valores límite y clases de equivalencia permite a los desarrolladores identificar problemas potenciales en el código y mejorar la robustez del sistema. Esta fase es esencial para garantizar que el software cumpla con las expectativas del usuario y sea confiable en su uso.

La realización efectiva de estas pruebas requiere una comprensión profunda del funcionamiento del sistema y habilidades técnicas sólidas. Los desarrolladores deben ser capaces de diseñar casos de prueba adecuados, ejecutarlas con precisión y analizar los resultados para identificar fallos o defectos. Además, es crucial mantener un enfoque sistemático y organizado en el proceso de pruebas, asegurando que todas las áreas del código sean cubiertas y evaluadas.

En conclusión, la fase de diseño y realización de pruebas es una etapa crítica en el desarrollo de software que requiere habilidades técnicas sólidas y un enfoque meticuloso. Al utilizar métodos como las pruebas de Código Cubrimiento, valores límite y clases de equivalencia, los desarrolladores pueden asegurar la calidad del producto final y garantizar su confiabilidad en el uso real. Esta fase es esencial para crear software que cumpla con las expectativas del usuario y sea robusto frente a diferentes situaciones.

<a id="pruebas-unitarias-herramientas-de-automatizacion"></a>
## Pruebas unitarias; herramientas de automatización

La realización de pruebas unitarias es una práctica fundamental en el desarrollo de software que permite verificar la funcionalidad correcta de los componentes más pequeños del sistema. Estas pruebas son cruciales para identificar errores temprano en el ciclo de vida del proyecto, lo que facilita su corrección y mejora la calidad final del producto.

Las herramientas de automatización de pruebas unitarias son instrumentos poderosos que permiten ejecutar automáticamente estas pruebas repetidamente, asegurando así una mayor confianza en el código. Estas herramientas pueden ser integradas en los flujos de trabajo de desarrollo continuo (CI), lo que permite realizar pruebas automáticas cada vez que se realiza un cambio en el código fuente.

La automatización de pruebas unitarias no solo ahorra tiempo, sino que también reduce la probabilidad de errores humanos. Al ejecutar las mismas pruebas repetidamente, es menos probable que se cometa un error debido a una falta de atención o a una confusión en el proceso manual.

Además, las herramientas de automatización de pruebas unitarias proporcionan informes detallados sobre los resultados de las pruebas. Estos informes pueden incluir la cobertura del código (cuánto porcentaje del código ha sido probado), los errores encontrados y las fallas en las pruebas. Esta información es invaluable para el equipo de desarrollo, ya que les permite identificar áreas que requieren atención adicional.

La automatización de pruebas unitarias también facilita la colaboración entre los miembros del equipo. Al tener un conjunto estándar de pruebas que se ejecutan automáticamente, todos los desarrolladores pueden estar seguros de que su código no rompe las funcionalidades existentes cuando realizan cambios en el sistema.

En resumen, la automatización de pruebas unitarias es una práctica esencial en el desarrollo de software moderno. No solo mejora la calidad del producto final, sino que también aumenta la eficiencia y la confianza del equipo de desarrollo. Al integrar estas herramientas en los flujos de trabajo diarios, se pueden detectar y corregir errores temprano, lo que reduce el tiempo y los costos asociados con las correcciones posteriores.

<a id="documentacion-de-las-incidencias"></a>
## Documentación de las incidencias

La documentación de las incidencias es una práctica fundamental en el desarrollo de software, ya que proporciona un registro detallado de problemas encontrados durante la fase de pruebas. Este proceso no solo ayuda a identificar los errores más comunes y su ubicación exacta, sino que también facilita la comunicación entre diferentes equipos involucrados en el proyecto.

En primer lugar, es crucial entender que cada incidencia debe ser registrada con un número único para su fácil seguimiento y referencia. Este número suele incluir información sobre el tipo de problema (por ejemplo, error de sintaxis, fallo de rendimiento) y la fecha de ocurrencia. Además, se debe especificar claramente los pasos que se siguieron antes del error, lo que permitirá a otros desarrolladores reproducir el problema.

La documentación de las incidencias no se limita solo a describir el problema; también es importante incluir información sobre su impacto en la funcionalidad del sistema. Esto puede implicar indicar si el error afecta a una única función o toda la aplicación, así como cuántos usuarios podrían estar experimentando el problema.

Además de los detalles técnicos, es fundamental capturar cualquier observación adicional que pueda ayudar a entender el contexto en el que ocurrió el error. Esto puede incluir información sobre el entorno de ejecución (como la versión del sistema operativo o del navegador), las condiciones bajo las cuales se produjo el problema, y cualquier otra circunstancia relevante.

La documentación debe ser accesible para todos los miembros del equipo, lo que facilita la colaboración en la resolución de problemas. Además, es importante mantener un historial actualizado de todas las incidencias abiertas, cerradas y pendientes, lo que permite realizar análisis posteriores sobre el rendimiento del sistema y identificar tendencias o patrones.

La documentación de las incidencias también desempeña un papel crucial en la revisión y mejora continua del proceso de pruebas. Al analizar los errores recurrentes, se pueden identificar áreas específicas que requieren atención adicional o mejoras en el diseño del sistema o en las estrategias de prueba.

En conclusión, la documentación de las incidencias es una herramienta poderosa y necesaria en cualquier proyecto de desarrollo de software. No solo ayuda a resolver problemas de manera eficiente, sino que también contribuye al crecimiento continuo y mejora del producto final, asegurando así su éxito en el mercado.

<a id="dobles-de-prueba-tipos-caracteristicas"></a>
## Dobles de prueba. Tipos. Características

En el mundo de la programación, las pruebas son una parte esencial del proceso de desarrollo de software. A pesar de que los primeros pasos pueden parecer intuitivos, como escribir código y ejecutarlo para ver si funciona, las pruebas avanzadas requieren un enfoque más sistemático y riguroso.

El concepto de "dobles de prueba" es uno de estos aspectos avanzados. Los dobles de prueba son herramientas que nos permiten simular objetos o componentes en nuestro código durante las pruebas unitarias, lo que nos ayuda a aislar el comportamiento del componente bajo prueba y verificar su funcionalidad sin depender de otros elementos.

Existen varios tipos de dobles de prueba, cada uno con sus propias características y usos. Los más comunes son los "dobles simulados" (mocks), los "dobles espías" (spies) y los "dobles estafadores" (stubs). Cada uno de estos tipos se utiliza en diferentes situaciones para lograr el objetivo de aislar y verificar el componente bajo prueba.

Los dobles simulados son objetos que imitan la interfaz de un objeto real, pero con comportamientos predefinidos. Son útiles cuando necesitamos probar cómo reacciona nuestro código a ciertos eventos o acciones sin tener que ejecutar el código del objeto real.

Los dobles espías, por otro lado, nos permiten verificar qué métodos se han llamado en un objeto durante una prueba. Esto es especialmente útil para comprobar si nuestros componentes están interactuando correctamente entre sí y cumpliendo con las expectativas de los usuarios.

Por último, los dobles estafadores son objetos que devuelven valores predefinidos cuando se les invoca. Son útiles cuando necesitamos probar el comportamiento de nuestro código en situaciones donde no es posible o deseable ejecutar el código real del objeto.

La utilización de dobles de prueba es una práctica recomendada en la industria de la programación, ya que nos ayuda a mejorar la calidad y la confiabilidad de nuestros programas. Al aislar los componentes bajo prueba, podemos identificar problemas más fácilmente y solucionarlos antes de que lleguen al usuario final.

Además, el uso de dobles de prueba también puede ayudarnos a acelerar el proceso de desarrollo. En lugar de ejecutar todo el código del sistema durante las pruebas, podemos utilizar dobles de prueba para simular el comportamiento de los componentes que no estamos probando en ese momento. Esto nos permite realizar más pruebas en un período de tiempo menor.

En resumen, los dobles de prueba son una herramienta poderosa y esencial en la programación moderna. Al aprender a utilizarlos correctamente, podemos mejorar significativamente la calidad y confiabilidad de nuestros programas, así como acelerar el proceso de desarrollo.

<a id="ejercicio-de-final-de-unidad-2"></a>
## Ejercicio de final de unidad

### actividad

```markdown

```


<a id="optimizacion-y-documentacion"></a>
# Optimización y documentación

<a id="refactorizacion"></a>
## Refactorización

La carpeta `Primero/Entornos de desarrollo/004-Optimización y documentación/001-Refactorización` abarca un tema fundamental para el desarrollo de software: la refatorización. Esta práctica es esencial para mantener el código limpio, eficiente y fácilmente mantenible a lo largo del tiempo.

La refactorización implica realizar cambios en el código fuente sin alterar su comportamiento externo. Su objetivo principal es mejorar la estructura interna del código, simplificarlo y hacerlo más legible. Este proceso puede parecer innecesario en momentos de presión por plazos o urgencias, pero su impacto a largo plazo es inmenso.

El primer paso hacia la refactorización es identificar áreas del código que puedan ser optimizadas. Esto puede implicar la eliminación de redundancias, la simplificación de algoritmos complejos y la mejora de la organización del código. La práctica de la refactorización requiere una comprensión profunda del problema y del código en cuestión, lo que implica un alto nivel de conocimiento técnico.

Una vez identificadas las áreas para mejorar, se procede a realizar los cambios necesarios. Es crucial mantener el código funcional durante este proceso, por lo que la refactorización debe realizarse con pruebas unitarias y de integración continuas. Las herramientas modernas de desarrollo ofrecen asistentes y plugins que pueden facilitar esta tarea, pero es fundamental entender cómo funcionan estos elementos para utilizarlos eficazmente.

La documentación juega un papel crucial en el proceso de refactorización. Es importante mantener una descripción clara del código y sus modificaciones, tanto en comentarios internos como en documentación externa. Esta práctica facilita la comprensión del código por parte de otros desarrolladores y asegura que los cambios realizados sean seguros y efectivos.

La refactorización no es un proceso lineal; a menudo se produce iterativamente durante el ciclo de desarrollo. Cada cambio puede revelar nuevas áreas para mejorar, lo que implica una revisión continua del código. Esta dinámica permite adaptarse a los cambios en las necesidades del proyecto y mantener el software al día con las mejores prácticas.

La refactorización también contribuye a la seguridad del código. Al simplificar y mejorar la estructura del código, se reduce el riesgo de errores y fallos. Además, un código más limpio es más fácil de depurar cuando ocurren problemas.

En conclusión, la refactorización es una habilidad esencial para cualquier desarrollador que quiera mantener su código en óptimas condiciones a lo largo del tiempo. A través de este proceso, se mejora la calidad del software, facilita su mantenimiento y asegura su escalabilidad. La documentación adecuada es fundamental para el éxito de esta práctica, ya que permite a los demás desarrolladores entender y seguir los cambios realizados.

### creo un programa sin funciones

```python
'''
  Programa agenda v0.1
  Jose Vicente Carratala
'''

print("Programa agenda v0.1 por Jose Vicente Carratala")

print("Selecciona una opcion:")
print("1.-Insertar clientes")
print("2.-Listar clientes")
print("3.-Actualizar clientes")
print("4.-Eliminar clientes")

opcion = input("Elige tu opcion: ")
opcion = int(opcion)
```

### codigo para cada una de las acciones

```python
'''
  Programa agenda v0.1
  Jose Vicente Carratala
'''

print("Programa agenda v0.1 por Jose Vicente Carratala")

print("Selecciona una opcion:")
print("1.-Insertar clientes")
print("2.-Listar clientes")
print("3.-Actualizar clientes")
print("4.-Eliminar clientes")

opcion = input("Elige tu opcion: ")
opcion = int(opcion)

clientes = ""

if opcion == 1:
  nombre = input("Dime el nuevo nombre del cliente")
  clientes += nombre+","
elif opcion == 2:
  print("Tus clientes son: ")
  print(clientes)
elif opcion == 3:
  pass
elif opcion == 4:
  pass
  
  
```

### bucle infinito

```python
'''
  Programa agenda v0.1
  Jose Vicente Carratala
'''

print("Programa agenda v0.1 por Jose Vicente Carratala")

print("Selecciona una opcion:")
print("1.-Insertar clientes")
print("2.-Listar clientes")
print("3.-Actualizar clientes")
print("4.-Eliminar clientes")

clientes = ""

while True:
  opcion = input("Elige tu opcion: ")
  opcion = int(opcion)
  
  if opcion == 1:
    nombre = input("Dime el nuevo nombre del cliente: ")
    clientes += nombre+","
  elif opcion == 2:
    print("Tus clientes son: ")
    print(clientes)
  elif opcion == 3:
    pass
  elif opcion == 4:
    pass
  
  
```

### funcion de eliminnar

```python
'''
  Programa agenda v0.1
  Jose Vicente Carratala
'''

print("Programa agenda v0.1 por Jose Vicente Carratala")

print("Selecciona una opcion:")
print("1.-Insertar clientes")
print("2.-Listar clientes")
print("3.-Actualizar clientes")
print("4.-Eliminar clientes")

clientes = ""

while True:
  opcion = input("Elige tu opcion: ")
  opcion = int(opcion)
  
  if opcion == 1:
    nombre = input("Dime el nuevo nombre del cliente: ")
    clientes += nombre+","
  elif opcion == 2:
    print("Tus clientes son: ")
    print(clientes)
  elif opcion == 3:
    print("Tus clientes son:")
    print(clientes)
    print("Quienes quieres que sean?")
    clientes = input("Introduce los nuevos clientes")
  elif opcion == 4:
    clientes = ""
    print("Tus clientes han sido borrados")
  
  
```

### extraccion a funcion

```python
'''
  Programa agenda v0.1
  Jose Vicente Carratala
'''
def imprimeBienvenida():
  print("Programa agenda v0.1 por Jose Vicente Carratala")

print("Selecciona una opcion:")
print("1.-Insertar clientes")
print("2.-Listar clientes")
print("3.-Actualizar clientes")
print("4.-Eliminar clientes")

clientes = ""

while True:
  opcion = input("Elige tu opcion: ")
  opcion = int(opcion)
  
  if opcion == 1:
    nombre = input("Dime el nuevo nombre del cliente: ")
    clientes += nombre+","
  elif opcion == 2:
    print("Tus clientes son: ")
    print(clientes)
  elif opcion == 3:
    print("Tus clientes son:")
    print(clientes)
    print("Quienes quieres que sean?")
    clientes = input("Introduce los nuevos clientes")
  elif opcion == 4:
    clientes = ""
    print("Tus clientes han sido borrados")
  
  
```

### extraigo menu

```python
'''
  Programa agenda v0.1
  Jose Vicente Carratala
'''
def imprimeBienvenida():
  print("Programa agenda v0.1 por Jose Vicente Carratala")
  
def muestraMenu():
  print("Selecciona una opcion:")
  print("1.-Insertar clientes")
  print("2.-Listar clientes")
  print("3.-Actualizar clientes")
  print("4.-Eliminar clientes")

clientes = ""

while True:
  opcion = input("Elige tu opcion: ")
  opcion = int(opcion)
  
  if opcion == 1:
    nombre = input("Dime el nuevo nombre del cliente: ")
    clientes += nombre+","
  elif opcion == 2:
    print("Tus clientes son: ")
    print(clientes)
  elif opcion == 3:
    print("Tus clientes son:")
    print(clientes)
    print("Quienes quieres que sean?")
    clientes = input("Introduce los nuevos clientes")
  elif opcion == 4:
    clientes = ""
    print("Tus clientes han sido borrados")
  
  
```

### extraigo los bloques

```python
'''
  Programa agenda v0.1
  Jose Vicente Carratala
'''

################## DEFINICION DE FUNCIONES #######################################3

def imprimeBienvenida():
  print("Programa agenda v0.1 por Jose Vicente Carratala")
  
def muestraMenu():
  print("Selecciona una opcion:")
  print("1.-Insertar clientes")
  print("2.-Listar clientes")
  print("3.-Actualizar clientes")
  print("4.-Eliminar clientes")

def insertarCliente():
  nombre = input("Dime el nuevo nombre del cliente: ")
  clientes += nombre+","
  
def listadoClientes():
  print("Tus clientes son: ")
  print(clientes)
  
def actualizaClientes():
  print("Tus clientes son:")
  print(clientes)
  print("Quienes quieres que sean?")
  clientes = input("Introduce los nuevos clientes")
  
def borraClientes():
  clientes = ""
  print("Tus clientes han sido borrados")
  
################## DEFINICION DE VARIABLES GLOBALES #######################################3

clientes = ""

################## BUCLE PRINCIPAL #######################################3

imprimeBienvenida()

while True:
  muestraMenu()
  opcion = input("Elige tu opcion: ")
  opcion = int(opcion)
  
  if opcion == 1:
    insertarCliente()
  elif opcion == 2:
    listadoClientes()
  elif opcion == 3:
    actualizaClientes()
  elif opcion == 4:
    borraClientes()
  
  
```

### solucion global

```python
'''
  Programa agenda v0.1
  Jose Vicente Carratala
'''

################## DEFINICION DE FUNCIONES #######################################3

def imprimeBienvenida():
  print("Programa agenda v0.1 por Jose Vicente Carratala")
  
def muestraMenu():
  print("Selecciona una opcion:")
  print("1.-Insertar clientes")
  print("2.-Listar clientes")
  print("3.-Actualizar clientes")
  print("4.-Eliminar clientes")

def insertarCliente():
  global clientes
  nombre = input("Dime el nuevo nombre del cliente: ")
  clientes += nombre+","
  
def listadoClientes():
  global clientes
  print("Tus clientes son: ")
  print(clientes)
  
def actualizaClientes():
  global clientes
  print("Tus clientes son:")
  print(clientes)
  print("Quienes quieres que sean?")
  clientes = input("Introduce los nuevos clientes")
  
def borraClientes():
  global clientes
  clientes = ""
  print("Tus clientes han sido borrados")
  
################## DEFINICION DE VARIABLES GLOBALES #######################################3

clientes = ""

################## BUCLE PRINCIPAL #######################################3

imprimeBienvenida()

while True:
  muestraMenu()
  opcion = input("Elige tu opcion: ")
  opcion = int(opcion)
  
  if opcion == 1:
    insertarCliente()
  elif opcion == 2:
    listadoClientes()
  elif opcion == 3:
    actualizaClientes()
  elif opcion == 4:
    borraClientes()
  
  
```

### extraer a archivo externo

```python
'''
  Programa agenda v0.1
  Jose Vicente Carratala
'''

from funciones import imprimeBienvenida, muestraMenu, insertarCliente, listadoClientes, actualizaClientes, borraClientes
  
################## DEFINICION DE VARIABLES GLOBALES #######################################3

clientes = ""

################## BUCLE PRINCIPAL #######################################3

imprimeBienvenida()

while True:
  muestraMenu()
  opcion = input("Elige tu opcion: ")
  opcion = int(opcion)
  
  if opcion == 1:
    insertarCliente()
  elif opcion == 2:
    listadoClientes()
  elif opcion == 3:
    actualizaClientes()
  elif opcion == 4:
    borraClientes()
  
  
```

### partir en funciones

```python
'''
  Calcular el total de una factura
'''

def totalFactura(baseimponible):
  # Primero me aseguro de que la base imponible sea un número
  baseimponible = float(baseimponible)
  # Ahora quiero redondear a dos digitos
  baseimponible = round(baseimponible,2)
  total = baseimponible
  # Calculamos el IRPF que es el 15%
  irpf = baseimponible*0.15
  irpf = round(irpf,2)
  # ahora calculamos un iva del 21%
  iva = baseimponible*0.21
  iva = round(iva,2)
  # Y ahora el calculo final
  total = baseimponible + iva - irpf
  total = round(total,2)
  return total
  
print(totalFactura(1000))
  
```

### divido funciones

```python
'''
  Calcular el total de una factura
'''

def redondeoa2(entrada):
  return round(entrada,2)

def totalFactura(baseimponible):
  # Primero me aseguro de que la base imponible sea un número
  baseimponible = float(baseimponible)
  # Ahora quiero redondear a dos digitos
  baseimponible = redondeoa2(baseimponible)
  total = baseimponible
  # Calculamos el IRPF que es el 15%
  irpf = baseimponible*0.15
  irpf = redondeoa2(irpf)
  # ahora calculamos un iva del 21%
  iva = baseimponible*0.21
  iva = redondeoa2(irpf)
  # Y ahora el calculo final
  total = baseimponible + iva - irpf
  total = redondeoa2(total)
  return total
  
print(totalFactura(1000))
  
```

### sigo dividiendo

```python
'''
  Calcular el total de una factura
'''

def redondeoa2(entrada):
  return round(entrada,2)
  
def calculaIVA(entrada):
  iva = entrada*0.21
  return redondeoa2(iva)

def totalFactura(baseimponible):
  # Primero me aseguro de que la base imponible sea un número
  baseimponible = float(baseimponible)
  # Ahora quiero redondear a dos digitos
  baseimponible = redondeoa2(baseimponible)
  total = baseimponible
  # Calculamos el IRPF que es el 15%
  irpf = baseimponible*0.15
  irpf = redondeoa2(irpf)
  calculaIVA(baseimponible)
  # Y ahora el calculo final
  total = baseimponible + iva - irpf
  total = redondeoa2(total)
  return total
  
print(totalFactura(1000))
  
```

### sigo dividiendo mas

```python
'''
  Calcular el total de una factura
'''

def redondeoa2(entrada):
  return round(entrada,2)
  
def calculaIVA(entrada):
  iva = entrada*0.21
  return redondeoa2(iva)
  
def calculaIRPF(entrada):
  irpf = entrada*0.15
  return redondeoa2(irpf)

def totalFactura(baseimponible):
  baseimponible = float(baseimponible)
  baseimponible = redondeoa2(baseimponible)
  
  
  total = baseimponible + calculaIVA(baseimponible) - calculaIRPF(baseimponible)
  total = redondeoa2(total)
  return total
  
print(totalFactura(1000))
  
```

### funciones

```python
################## DEFINICION DE FUNCIONES #######################################3

def imprimeBienvenida():
  print("Programa agenda v0.1 por Jose Vicente Carratala")
  
def muestraMenu():
  print("Selecciona una opcion:")
  print("1.-Insertar clientes")
  print("2.-Listar clientes")
  print("3.-Actualizar clientes")
  print("4.-Eliminar clientes")

def insertarCliente():
  global clientes
  nombre = input("Dime el nuevo nombre del cliente: ")
  clientes += nombre+","
  
def listadoClientes():
  global clientes
  print("Tus clientes son: ")
  print(clientes)
  
def actualizaClientes():
  global clientes
  print("Tus clientes son:")
  print(clientes)
  print("Quienes quieres que sean?")
  clientes = input("Introduce los nuevos clientes")
  
def borraClientes():
  global clientes
  clientes = ""
  print("Tus clientes han sido borrados")
```

<a id="analizadores-de-codigo"></a>
## Analizadores de código

En el mundo de la programación, la optimización y la documentación son dos pilares fundamentales que respaldan la calidad y eficiencia del software. La carpeta `002-Analizadores de código` se centra en una herramienta esencial para estos procesos: los analizadores de código.

Los analizadores de código son programas informáticos diseñados para examinar el código fuente de un programa y proporcionar información valiosa sobre su estructura, calidad y potenciales problemas. Estas herramientas pueden variar en complejidad y funcionalidades, pero todos comparten una meta común: mejorar la calidad del software a través del análisis automático.

La primera función de los analizadores de código es identificar errores y advertencias en el código fuente. Al detectar estos problemas temprano en el ciclo de desarrollo, se facilita su corrección, lo que reduce significativamente el tiempo y costos asociados con la depuración posterior. Además, los analizadores pueden sugerir mejoras en el estilo de codificación y las prácticas recomendadas, ayudando a mantener un código limpio y coherente.

Además de la detección de errores, los analizadores de código también desempeñan un papel crucial en la documentación del software. Al examinar el código, estos herramientas pueden extraer información relevante sobre las funcionalidades implementadas, los métodos utilizados y las relaciones entre diferentes partes del programa. Esta información puede ser utilizada para generar automáticamente documentación detallada, lo que facilita la comprensión y mantenimiento del software.

La importancia de los analizadores de código se ve aún más destacada en proyectos colaborativos o de gran escala. En estos contextos, el trabajo conjunto sobre un mismo código puede llevar a malentendidos y errores. Los analizadores de código actúan como una línea de defensa, asegurando que todos los miembros del equipo sigan las mismas convenciones y mejores prácticas, lo que promueve la coherencia en el desarrollo.

Además, los analizadores de código pueden ayudar a identificar oportunidades de optimización. Al examinar el flujo de ejecución del programa, estas herramientas pueden detectar patrones o secciones de código que podrían ser mejoradas para mejorar su rendimiento. Esto puede implicar la simplificación de algoritmos complejos, la reducción de bucles innecesarios o la optimización de estructuras de datos.

La documentación generada por los analizadores de código no solo facilita el mantenimiento del software, sino que también es invaluable para futuros desarrolladores que puedan trabajar en el proyecto. Una buena documentación automática puede incluir descripciones detalladas de las clases y métodos, ejemplos de uso y posibles excepciones, lo que permite a los nuevos miembros del equipo entender rápidamente cómo funciona el código.

Sin embargo, es importante recordar que los analizadores de código no son una solución única. Cada proyecto tiene sus propias necesidades y requisitos específicos, por lo que puede ser necesario ajustar la configuración o incluso seleccionar diferentes herramientas según las circunstancias. Además, aunque los analizadores pueden ayudar a mejorar la calidad del software, es fundamental mantener un enfoque equilibrado entre automatización y revisión manual.

En conclusión, los analizadores de código son una herramienta poderosa y valiosa para el desarrollo de software. Al facilitar la detección de errores, la generación de documentación y la identificación de oportunidades de optimización, estos programas informáticos desempeñan un papel crucial en mejorar la calidad y eficiencia del software a lo largo de su ciclo de vida.

### Analizadores web

```markdown
1.-Validador HTML/CSS oficial:
https://validator.w3.org/
```

### Analizadores json

```markdown
Validador JSON para archivos de datos
https://jsonlint.com/
```

### Herramientas de Inteligencia Artificial

```markdown
https://chatgpt.com/

https://chat.mistral.ai/chat

https://copilot.microsoft.com/

https://gemini.google.com/app?hl=es-ES

https://claude.ai/new

https://www.deepseek.com/
```

### publicacion de webs en GitHub Pages

```markdown
1.-Entrar a Github

2.- Crear un repositorio - el que tu quieras

3.-Subiremos las paginas correspondientes (la principal se tiene que llamar index.html) - Commit+Push

4.-Iremos a settings

5.-En la barra izquierda, accederemos a GitHub Pages

6.-Elegiremos publicar desde la rama Main

7.-Esperaremos cinco minutos a que se ejecuten los cambios

Accederemos desde:
https://[usuario].github.io/[repo]
```

<a id="control-de-versiones-estructura-de-las-herramientas-de-control-de-versiones"></a>
## Control de versiones. Estructura de las herramientas de control de versiones

La optimización y documentación son pilares fundamentales del desarrollo de software, proporcionando estructura y claridad a proyectos complejos. En esta subunidad didáctica, nos adentramos en el control de versiones, una herramienta esencial para gestionar cambios en el código fuente de manera eficiente y segura.

El control de versiones permite registrar todas las modificaciones realizadas en un proyecto, facilitando la colaboración entre desarrolladores y permitiendo revertir a versiones anteriores si es necesario. Esta práctica es crucial para mantener el historial del desarrollo y prevenir la pérdida de trabajo.

Las herramientas de control de versiones más populares incluyen Git, Subversion (SVN) y Mercurial. Cada una tiene sus propias características y ventajas, pero todos comparten un objetivo común: facilitar el seguimiento y gestión de cambios en el código fuente.

Git es la herramienta más utilizada actualmente debido a su eficiencia y versatilidad. Permite trabajar con ramas (branches) para desarrollar nuevas funcionalidades sin afectar el código principal, facilitando la colaboración y la integración continua.

La estructura de las herramientas de control de versiones se centra en los conceptos básicos como repositorios (repositories), commits, branches y merges. El repositorio es donde se almacena todo el historial del proyecto, mientras que los commits registran cambios específicos realizados por un desarrollador.

Las ramas son una característica poderosa de Git, permitiendo trabajar en paralelo en diferentes versiones del código sin interferir entre sí. Esto facilita la implementación de nuevas características o soluciones a problemas sin afectar el estado estable del proyecto.

Los merges son operaciones que combinan cambios realizados en diferentes ramas, consolidando todo en una versión única y coherente del código. Esta práctica es crucial para mantener el flujo de trabajo colaborativo y asegurar la integridad del proyecto.

La documentación es otro aspecto fundamental del control de versiones. Es imprescindible para que los desarrolladores comprendan el historial del proyecto, las razones detrás de ciertas decisiones y cómo se han realizado cambios importantes. La documentación debe ser detallada pero concisa, facilitando la comprensión y el mantenimiento del código.

Además, las herramientas de control de versiones ofrecen funcionalidades avanzadas como ramificaciones temporales (stash), etiquetado (tags) y comparaciones visualizadas (diffs). Estas características permiten a los desarrolladores gestionar eficientemente sus proyectos y colaborar de manera más efectiva.

En resumen, el control de versiones es una herramienta poderosa que proporciona estructura y claridad al desarrollo de software. Su uso adecuado facilita la colaboración entre desarrolladores, permite revertir a versiones anteriores si es necesario y asegura la integridad del proyecto. La documentación es un complemento crucial para entender el historial del proyecto y cómo se han realizado cambios importantes.

La comprensión de estos conceptos es fundamental para cualquier desarrollador que quiera trabajar en proyectos colaborativos o de gran escala. A través de esta subunidad didáctica, hemos explorado los fundamentos del control de versiones y su estructura, proporcionando una base sólida para el manejo eficiente del código fuente en proyectos complejos.

La práctica constante es la clave para dominar estas herramientas. Es recomendable experimentar con diferentes ramas, realizar commits frecuentes y documentar cambios importantes para familiarizarse completamente con el control de versiones. Con el tiempo, esta habilidad se convertirá en una parte natural del flujo de trabajo diario del desarrollador.

En conclusión, el control de versiones es un aspecto crucial del desarrollo de software que requiere atención y práctica constante. Su dominio proporcionará a los desarrolladores las herramientas necesarias para gestionar eficientemente proyectos complejos y colaborar de manera efectiva con sus compañeros.

### primera version

```python
print("Hola mundo desde Python")
```

### segund version

```python
print("Hola que tal como estais")
```

### GIT

```markdown
GIT es un proyecto creado por Linus Torvalds que es el mismo que ha creado Linux

Consiste en un sistema informático que almacena diferentes versiones de tu software, de forma que recuerda todas las versiones y en un momento dado te puede ayudar a volver a ellas.

GIT es una herramienta (como apache y MySQL) que te puedes instalar en tu ordenador

O bien tu puedes montar un servidor de GIT para una empresa

Es mucho más fácil empezar con GitHub
GitHub en un GIT en la nube de tal forma que solo te tienes que preocupar por subir tu código  - ellos te lo alojan

url: https://github.com

1.-Entrais en GitHub
2.-Sign in - create an account

Página principal:
-A la izquierda - tus repositorios
-En el centro - interacción social
-A la derecha - noticias

Dentro de Github hay repositorios

Un repositorio es un almacén de código (podríamos decir que es un proyecto)

Boton new -> nuevo repositorio

Nombre:
pruebaenclase

Descripción:
Este es un repositorio que estamos haciendo en entornos de desarrollo para probar GitHub

Visibilidad:
Publico - todo el mundo ve tu código
Privado - solo tu y las personas que tu quieras pueden ver tu codigo

Añadir readme.md - le decimos que si - se crea un vacío - más adelante podemos ponerle código

Licencia - revisar de entre las licencias que existe en el sistema

Yo puedo:
-O bien gestionar el repositorio online
-O bien utilizar GitHub Desktop

Se recomienda usar GitHub Desktop - opción más fácil y más sencilla para empezar

https://desktop.github.com/download/
```

### Clono el repositorio

```markdown
Ahora mismo el repositorio existe en github.com
Pero no en mi equipo

Pasos:
1.-Abro GitHub Desktop
2.-Archivo - Clonar repositorio
3.-Introduzco el nombre del repositorio
4-Lo clono
5.-Ahora el repositorio esta en mi ordenador

Hay un archivo readme
Y una carpeta .git
NO BORREIS NADA

Creamos un primer archivo

Commit + Push
Commit = crear/cerrar una versión
Push es subir esa versión al servidor

Segunda versión
commit + push

De momento github nos va a servir para TRES cosas:
1.-Guardar copia de seguridad de nuestros proyectos en la nube
2.-Guardar HISTÓRICO de nuestros proyectos en la nube
En cuanto tengamos una versión que funcione, hacemos commit y push - siempre podremos recuperar una versión en funcionamiento más adelante
3.-Sirve para ganar visibilidad - a un programador se le presupone que tiene un GitHub como a un modelo se le presupone que tiene Instagram


Cuando hay cambios en remoto 
Podéis hacer un Pull para recuperar esos cambios en vuestro ordenador

Fetch + Pull
```

### fetch y pull

```markdown
Fetch = Ves y busca
Ves al servidor y comprueba si hay alguna novedad

Pull = Me traigo los cambios desde el servidor hasta mi equipo

Cuando yo hago cambios en mi máquina de desarrollo, y los quiero subir al servidor (es lo normal) = Commit y push

Cuando sé que hay cambios remotos en el servidor, y me los quiero traer a mi ordenador = Fetch y pull
```

### Importante actividad IA

```markdown
IMPORTANTE PARA LA REALIZACIÓN DE LA ACTIVIDAD (IA)
Cada alumno debe crear su propio GitHub, y cada alumno debe subir (y mantener actualizado) TODO el código que haya realizado durante el curso, y el que realice de aquí en adelante, al GitHub

En los días de examen, os pediré que abráis cada uno vuestro GitHub, y solo podréis coger código que esté en vuestro GitHub

En ningún caso el alumno puede utilizar el código del profesor para alimentar su propio GitHub - solo se admite código realizado por el propio alumno
```

### Ajustes deGitHub

```markdown
También es importante que:

1.-Subis vuestra foto / imagen que os identifique
2.-Realizáis commits periódicos que serán revisados el día del examen
3.-Opcional pero muy recomendable: Abrios perfil en LinkedIn (red social profesional) y comenzad a publicar contenido de forma periódica
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


<a id="repositorio-herramientas-de-control-de-versiones-uso-integrado-en-el-entorno-de-desarrollo"></a>
# Repositorio. Herramientas de control de versiones. Uso integrado en el entorno de desarrollo

<a id="repositorios-remotos"></a>
## Repositorios remotos

En el vasto mundo de la programación, los diagramas de clases son una herramienta fundamental para visualizar y organizar las relaciones entre diferentes componentes de un sistema. Estos gráficos proporcionan una representación clara y detallada de cómo interactúan las entidades dentro del software, facilitando tanto el diseño como la comprensión del código.

La carpeta `001-Repositorios remotos` en nuestro recorrido por los Entornos de Desarrollo nos lleva a un aspecto crucial de este proceso: la gestión y colaboración de nuestros proyectos. Los repositorios remotos son lugares donde se almacenan copias digitales de nuestro código fuente, permitiendo que múltiples desarrolladores trabajen en el mismo proyecto simultáneamente sin conflictos.

La importancia de los repositorios remotos radica en su capacidad para mantener una versión histórica del código. Cada cambio realizado en el proyecto se registra como un nuevo commit, lo que permite a los desarrolladores revertir cambios si es necesario o explorar diferentes ramas del código. Esta funcionalidad es esencial para la colaboración, ya que permite trabajar en paralelo y fusionar los cambios de manera segura.

Además, los repositorios remotos facilitan el seguimiento de las modificaciones realizadas por cada miembro del equipo. Cada commit se asocia con un autor y una fecha, lo que proporciona un registro detallado de quién hizo qué cambio cuando. Esta información es invaluable para la depuración y la comprensión del flujo de trabajo.

La integración de los repositorios remotos en el ciclo de vida del desarrollo también facilita la implementación de prácticas ágiles como el Scrum o Kanban. Estas metodologías requieren un alto grado de colaboración y comunicación, y los repositorios remotos son una herramienta clave para mantener el flujo de trabajo fluido y eficiente.

En términos prácticos, trabajar con repositorios remotos implica conocer y dominar comandos como `git clone`, `git pull`, `git push` y `git merge`. Estos comandos permiten clonar un proyecto desde el repositorio remoto, sincronizar los cambios locales con la versión remota, enviar nuestros propios cambios y fusionar las modificaciones de otros miembros del equipo.

La gestión de los repositorios remotos también implica la configuración de permisos y roles. Es crucial determinar quién tiene acceso a qué partes del proyecto y cuáles son sus responsabilidades. Esto se logra mediante el uso de herramientas como GitHub, GitLab o Bitbucket, que ofrecen interfaces gráficas para administrar los permisos y las colaboraciones.

En conclusión, la carpeta `001-Repositorios remotos` nos muestra cómo la gestión eficiente de nuestros proyectos a través de repositorios remotos es un aspecto fundamental del desarrollo moderno. Esta práctica no solo facilita la colaboración entre desarrolladores sino que también mejora la calidad y el mantenimiento del código, proporcionando una base sólida para proyectos complejos y dinámicos.

### inicio sesion en el servidor

```markdown
josevicente@josevicenteportatil:~$ ssh josevicente@192.168.1.78
hostkeys_find_by_key_hostfile: hostkeys_foreach failed for /home/josevicente/.ssh/known_hosts: Permission denied
The authenticity of host '192.168.1.78 (192.168.1.78)' can't be established.
ED25519 key fingerprint is SHA256:01yUhdMdtJMuT0isDFihz6YGycA3tWKbt52qNN3P/3g.
This key is not known by any other names.
Are you sure you want to continue connecting (yes/no/[fingerprint])? yes
Failed to add the host to the list of known hosts (/home/josevicente/.ssh/known_hosts).
josevicente@192.168.1.78's password: 
client_input_hostkeys: hostkeys_foreach failed for /home/josevicente/.ssh/known_hosts: Permission denied
Welcome to Ubuntu 24.04.3 LTS (GNU/Linux 6.8.0-84-generic x86_64)

 * Documentation:  https://help.ubuntu.com
 * Management:     https://landscape.canonical.com
 * Support:        https://ubuntu.com/pro

 System information as of lun 13 oct 2025 13:01:35 UTC

  System load:  0.2               Processes:               147
  Usage of /:   9.5% of 60.23GB   Users logged in:         1
  Memory usage: 35%               IPv4 address for enp0s3: 192.168.1.78
  Swap usage:   0%

 * Strictly confined Kubernetes makes edge and IoT secure. Learn how MicroK8s
   just raised the bar for easy, resilient and secure K8s cluster deployment.

   https://ubuntu.com/engage/secure-kubernetes-at-the-edge

El mantenimiento de seguridad expandido para Applications está desactivado

Se pueden aplicar 0 actualizaciones de forma inmediata.

Active ESM Apps para recibir futuras actualizaciones de seguridad adicionales.
Vea https://ubuntu.com/esm o ejecute «sudo pro status»


*** Es necesario reiniciar el sistema ***
Last login: Mon Oct 13 12:00:34 2025 from 192.168.1.235
josevicente@ubuntuserver:~$ 
```

### tenemos git

```markdown
sudo apt update
sudo apt install git

josevicente@ubuntuserver:~$ sudo apt install git
Leyendo lista de paquetes... Hecho
Creando árbol de dependencias... Hecho
Leyendo la información de estado... Hecho
git ya está en su versión más reciente (1:2.43.0-1ubuntu7.3).
fijado git como instalado manualmente.
0 actualizados, 0 nuevos se instalarán, 0 para eliminar y 0 no actualizados.
josevicente@ubuntuserver:~$ 
```

### averiguar la version

```markdown
git --version

josevicente@ubuntuserver:~$ git --version
git version 2.43.0
```

### me conecto a git desde el servidor

```markdown
git config --global user.name = "jocarsa"

git config --global user.email = "info@josevicentecarratala.com"
```

### configuracion

```markdown
git config --global color.ui auto

git config --global core.editor nano
```

### clonar repositorio

```markdown
# Clonar un repositorio en local

git clone https://github.com/jocarsa/dam2526.git

josevicente@ubuntuserver:~$ cd dam2526
```

### pull desde el servidor

```markdown
josevicente@ubuntuserver:~/dam2526$ git pull origin main
remote: Enumerating objects: 44, done.
remote: Counting objects: 100% (44/44), done.
remote: Compressing objects: 100% (31/31), done.
remote: Total 38 (delta 7), reused 38 (delta 7), pack-reused 0 (from 0)
Unpacking objects: 100% (38/38), 11.61 KiB | 125.00 KiB/s, done.
From https://github.com/jocarsa/dam2526
 * branch            main       -> FETCH_HEAD
   b9e511b..cc19c26  main       -> origin/main
Updating b9e511b..cc19c26
Fast-forward
 .../Contenidos b\303\241sicos.md"          |  0
 .../001-inicio sesion en el servidor.md    | 38 +++++++++++++++++
 .../101-Ejercicios/002-tenemos git.md      | 11 +++++
 .../003-averiguar la version.md            |  5 +++
 ...4-me conecto a git desde el servidor.md |  5 +++
 .../101-Ejercicios/005-configuracion.md    |  5 +++
 .../006-clonar repositorio.md              |  3 ++
 .../Criterios de evaluaci\303\263n.md"     |  0
 .../Contenidos b\303\241sicos.md"          |  0
 .../Criterios de evaluaci\303\263n.md"     |  0
 .../Contenidos b\303\241sicos.md"          |  0
 .../Criterios de evaluaci\303\263n.md"     |  0
 .../000-Resumen.md"                        |  0
 .../Contenidos b\303\241sicos.md"          |  0
 .../Criterios de evaluaci\303\263n.md"     |  0
 .../Contenidos b\303\241sicos.md"          | 17 ++++++++
 .../Criterios de evaluaci\303\263n.md"     |  0
 .../Contenidos b\303\241sicos.md"          | 17 ++++++++
 .../Criterios de evaluaci\303\263n.md"     |  0
 .../Contenidos b\303\241sicos.md"          | 17 ++++++++
 .../Criterios de evaluaci\303\263n.md"     |  0
 .../Contenidos b\303\241sicos.md"          | 17 ++++++++
 .../Criterios de evaluaci\303\263n.md"     |  0
 .../Contenidos b\303\241sicos.md"          | 17 ++++++++
 .../Criterios de evaluaci\303\263n.md"     |  0
 .../Criterios de evaluacion.md"            |  0
 .../000-Resumen.md"                        |  0
 .../Contenidos b\303\241sicos.md"          | 17 ++++++++
 .../Criterios de evaluaci\303\263n.md"     |  0
 .../Contenidos b\303\241sicos.md"          |  0
 .../Criterios de evaluaci\303\263n.md"     |  0
 .../Contenidos b\303\241sicos.md"          |  0
 .../Criterios de evaluaci\303\263n.md"     |  0
 .../Contenidos b\303\241sicos.md"          |  0
 .../Criterios de evaluaci\303\263n.md"     |  0
 .../Contenidos b\303\241sicos.md"          |  0
 .../Criterios de evaluaci\303\263n.md"     |  0
 .../Contenidos b\303\241sicos.md"          |  0
 .../Criterios de evaluaci\303\263n.md"     |  0
 .../Criterios de evaluacion.md"            |  0
 .../101-Ejercicios/003-dist upgrade.md"    | 10 +++++
 .../004-instalar paquete.md"               |  9 ++++
 .../005-actualizar apache.md"              |  3 ++
 ...crear carpeta de copia de seguridad.md" |  6 +++
 .../007-creo un archivo sh.md"             | 15 +++++++
 .../008-especificar ejecutable.md"         |  3 ++
 .../009-Introduccion a cron.md"            | 23 ++++++++++
 47 files changed, 238 insertions(+)
 rename "Primero/Entornos de desarrollo/005-Elaboraci\303\263n de diagramas de clases/001-Repositorios remotos/001-Contenidos b\303\241sicos/Contenidos b\303\241sicos.md" => "Primero/Entornos de desarrollo/005-Repositorio. Herramientas de control de versiones. Uso integrado en el entorno de desarrollo/001-Repositorios remotos/001-Contenidos b\303\241sicos/Contenidos b\303\241sicos.md" (100%)
 create mode 100644 Primero/Entornos de desarrollo/005-Repositorio. Herramientas de control de versiones. Uso integrado en el entorno de desarrollo/001-Repositorios remotos/101-Ejercicios/001-inicio sesion en el servidor.md
 create mode 100644 Primero/Entornos de desarrollo/005-Repositorio. Herramientas de control de versiones. Uso integrado en el entorno de desarrollo/001-Repositorios remotos/101-Ejercicios/002-tenemos git.md
 create mode 100644 Primero/Entornos de desarrollo/005-Repositorio. Herramientas de control de versiones. Uso integrado en el entorno de desarrollo/001-Repositorios remotos/101-Ejercicios/003-averiguar la version.md
 create mode 100644 Primero/Entornos de desarrollo/005-Repositorio. Herramientas de control de versiones. Uso integrado en el entorno de desarrollo/001-Repositorios remotos/101-Ejercicios/004-me conecto a git desde el servidor.md
 create mode 100644 Primero/Entornos de desarrollo/005-Repositorio. Herramientas de control de versiones. Uso integrado en el entorno de desarrollo/001-Repositorios remotos/101-Ejercicios/005-configuracion.md
 create mode 100644 Primero/Entornos de desarrollo/005-Repositorio. Herramientas de control de versiones. Uso integrado en el entorno de desarrollo/001-Repositorios remotos/101-Ejercicios/006-clonar repositorio.md
 rename "Primero/Entornos de desarrollo/005-Elaboraci\303\263n de diagramas de clases/001-Repositorios remotos/201-Criterios de evaluaci\303\263n/Criterios de evaluaci\303\263n.md" => "Primero/Entornos de desarrollo/005-Repositorio. Herramientas de control de versiones. Uso integrado en el entorno de desarrollo/001-Repositorios remotos/201-Criterios de evaluaci\303\263n/Criterios de evaluaci\303\263n.md" (100%)
 rename "Primero/Entornos de desarrollo/005-Elaboraci\303\263n de diagramas de clases/002-Documentaci\303\263n. Uso de comentarios. Alternativas/001-Contenidos b\303\241sicos/Contenidos b\303\241sicos.md" => "Primero/Entornos de desarrollo/005-Repositorio. Herramientas de control de versiones. Uso integrado en el entorno de desarrollo/002-Documentaci\303\263n. Uso de comentarios. Alternativas/001-Contenidos b\303\241sicos/Contenidos b\303\241sicos.md" (100%)
 rename "Primero/Entornos de desarrollo/005-Elaboraci\303\263n de diagramas de clases/002-Documentaci\303\263n. Uso de comentarios. Alternativas/201-Criterios de evaluaci\303\263n/Criterios de evaluaci\303\263n.md" => "Primero/Entornos de desarrollo/005-Repositorio. Herramientas de control de versiones. Uso integrado en el entorno de desarrollo/002-Documentaci\303\263n. Uso de comentarios. Alternativas/201-Criterios de evaluaci\303\263n/Criterios de evaluaci\303\263n.md" (100%)
 rename "Primero/Entornos de desarrollo/005-Elaboraci\303\263n de diagramas de clases/003-Integraci\303\263n continua. Herramientas/001-Contenidos b\303\241sicos/Contenidos b\303\241sicos.md" => "Primero/Entornos de desarrollo/005-Repositorio. Herramientas de control de versiones. Uso integrado en el entorno de desarrollo/003-Integraci\303\263n continua. Herramientas/001-Contenidos b\303\241sicos/Contenidos b\303\241sicos.md" (100%)
 rename "Primero/Entornos de desarrollo/005-Elaboraci\303\263n de diagramas de clases/003-Integraci\303\263n continua. Herramientas/201-Criterios de evaluaci\303\263n/Criterios de evaluaci\303\263n.md" => "Primero/Entornos de desarrollo/005-Repositorio. Herramientas de control de versiones. Uso integrado en el entorno de desarrollo/003-Integraci\303\263n continua. Herramientas/201-Criterios de evaluaci\303\263n/Criterios de evaluaci\303\263n.md" (100%)
 rename "Primero/Entornos de desarrollo/005-Elaboraci\303\263n de diagramas de clases/000-Resumen.md" => "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de clases/000-Resumen.md" (100%)
 rename "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de comportamiento/001-Clases. Atributos, m\303\251todos y visibilidad/001-Contenidos b\303\241sicos/Contenidos b\303\241sicos.md" => "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de clases/001-Clases. Atributos, m\303\251todos y visibilidad/001-Contenidos b\303\241sicos/Contenidos b\303\241sicos.md" (100%)
 rename "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de comportamiento/001-Clases. Atributos, m\303\251todos y visibilidad/201-Criterios de evaluaci\303\263n/Criterios de evaluaci\303\263n.md" => "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de clases/001-Clases. Atributos, m\303\251todos y visibilidad/201-Criterios de evaluaci\303\263n/Criterios de evaluaci\303\263n.md" (100%)
 create mode 100755 "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de clases/002-Objetos. Instanciaci\303\263n/001-Contenidos b\303\241sicos/Contenidos b\303\241sicos.md"
 rename "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de comportamiento/002-Objetos. Instanciaci\303\263n/201-Criterios de evaluaci\303\263n/Criterios de evaluaci\303\263n.md" => "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de clases/002-Objetos. Instanciaci\303\263n/201-Criterios de evaluaci\303\263n/Criterios de evaluaci\303\263n.md" (100%)
 create mode 100755 "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de clases/003-Relaciones. Asociaci\303\263n, navegabilidad y multiplicidad. Herencia, composici\303\263n, agregaci\303\263n. Realizaci\303\263n y dependencia/001-Contenidos b\303\241sicos/Contenidos b\303\241sicos.md"
 rename "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de comportamiento/003-Relaciones. Asociaci\303\263n, navegabilidad y multiplicidad. Herencia, composici\303\263n, agregaci\303\263n. Realizaci\303\263n y dependencia/201-Criterios de evaluaci\303\263n/Criterios de evaluaci\303\263n.md" => "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de clases/003-Relaciones. Asociaci\303\263n, navegabilidad y multiplicidad. Herencia, composici\303\263n, agregaci\303\263n. Realizaci\303\263n y dependencia/201-Criterios de evaluaci\303\263n/Criterios de evaluaci\303\263n.md" (100%)
 create mode 100755 "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de clases/004-Notaci\303\263n de los diagramas de clases/001-Contenidos b\303\241sicos/Contenidos b\303\241sicos.md"
 rename "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de comportamiento/004-Notaci\303\263n de los diagramas de clases/201-Criterios de evaluaci\303\263n/Criterios de evaluaci\303\263n.md" => "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de clases/004-Notaci\303\263n de los diagramas de clases/201-Criterios de evaluaci\303\263n/Criterios de evaluaci\303\263n.md" (100%)
 create mode 100755 "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de clases/005-Herramientas/001-Contenidos b\303\241sicos/Contenidos b\303\241sicos.md"
 rename "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de comportamiento/005-Herramientas/201-Criterios de evaluaci\303\263n/Criterios de evaluaci\303\263n.md" => "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de clases/005-Herramientas/201-Criterios de evaluaci\303\263n/Criterios de evaluaci\303\263n.md" (100%)
 create mode 100755 "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de clases/006-Generaci\303\263n autom\303\241tica de c\303\263digo. Ingenier\303\255a inversa/001-Contenidos b\303\241sicos/Contenidos b\303\241sicos.md"
 rename "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de comportamiento/006-Generaci\303\263n autom\303\241tica de c\303\263digo. Ingenier\303\255a inversa/201-Criterios de evaluaci\303\263n/Criterios de evaluaci\303\263n.md" => "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de clases/006-Generaci\303\263n autom\303\241tica de c\303\263digo. Ingenier\303\255a inversa/201-Criterios de evaluaci\303\263n/Criterios de evaluaci\303\263n.md" (100%)
 rename "Primero/Entornos de desarrollo/005-Elaboraci\303\263n de diagramas de clases/Criterios de evaluacion.md" => "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de clases/Criterios de evaluacion.md" (100%)
 rename "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de comportamiento/000-Resumen.md" => "Primero/Entornos de desarrollo/007-Elaboraci\303\263n de diagramas de comportamiento/000-Resumen.md" (100%)
 create mode 100755 "Primero/Entornos de desarrollo/007-Elaboraci\303\263n de diagramas de comportamiento/001-Clases. Atributos, m\303\251todos y visibilidad/001-Contenidos b\303\241sicos/Contenidos b\303\241sicos.md"
 create mode 100755 "Primero/Entornos de desarrollo/007-Elaboraci\303\263n de diagramas de comportamiento/001-Clases. Atributos, m\303\251todos y visibilidad/201-Criterios de evaluaci\303\263n/Criterios de evaluaci\303\263n.md"
 rename "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de comportamiento/002-Objetos. Instanciaci\303\263n/001-Contenidos b\303\241sicos/Contenidos b\303\241sicos.md" => "Primero/Entornos de desarrollo/007-Elaboraci\303\263n de diagramas de comportamiento/002-Objetos. Instanciaci\303\263n/001-Contenidos b\303\241sicos/Contenidos b\303\241sicos.md" (100%)
 create mode 100755 "Primero/Entornos de desarrollo/007-Elaboraci\303\263n de diagramas de comportamiento/002-Objetos. Instanciaci\303\263n/201-Criterios de evaluaci\303\263n/Criterios de evaluaci\303\263n.md"
 rename "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de comportamiento/003-Relaciones. Asociaci\303\263n, navegabilidad y multiplicidad. Herencia, composici\303\263n, agregaci\303\263n. Realizaci\303\263n y dependencia/001-Contenidos b\303\241sicos/Contenidos b\303\241sicos.md" => "Primero/Entornos de desarrollo/007-Elaboraci\303\263n de diagramas de comportamiento/003-Relaciones. Asociaci\303\263n, navegabilidad y multiplicidad. Herencia, composici\303\263n, agregaci\303\263n. Realizaci\303\263n y dependencia/001-Contenidos b\303\241sicos/Contenidos b\303\241sicos.md" (100%)
 create mode 100755 "Primero/Entornos de desarrollo/007-Elaboraci\303\263n de diagramas de comportamiento/003-Relaciones. Asociaci\303\263n, navegabilidad y multiplicidad. Herencia, composici\303\263n, agregaci\303\263n. Realizaci\303\263n y dependencia/201-Criterios de evaluaci\303\263n/Criterios de evaluaci\303\263n.md"
 rename "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de comportamiento/004-Notaci\303\263n de los diagramas de clases/001-Contenidos b\303\241sicos/Contenidos b\303\241sicos.md" => "Primero/Entornos de desarrollo/007-Elaboraci\303\263n de diagramas de comportamiento/004-Notaci\303\263n de los diagramas de clases/001-Contenidos b\303\241sicos/Contenidos b\303\241sicos.md" (100%)
 create mode 100755 "Primero/Entornos de desarrollo/007-Elaboraci\303\263n de diagramas de comportamiento/004-Notaci\303\263n de los diagramas de clases/201-Criterios de evaluaci\303\263n/Criterios de evaluaci\303\263n.md"
 rename "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de comportamiento/005-Herramientas/001-Contenidos b\303\241sicos/Contenidos b\303\241sicos.md" => "Primero/Entornos de desarrollo/007-Elaboraci\303\263n de diagramas de comportamiento/005-Herramientas/001-Contenidos b\303\241sicos/Contenidos b\303\241sicos.md" (100%)
 create mode 100755 "Primero/Entornos de desarrollo/007-Elaboraci\303\263n de diagramas de comportamiento/005-Herramientas/201-Criterios de evaluaci\303\263n/Criterios de evaluaci\303\263n.md"
 rename "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de comportamiento/006-Generaci\303\263n autom\303\241tica de c\303\263digo. Ingenier\303\255a inversa/001-Contenidos b\303\241sicos/Contenidos b\303\241sicos.md" => "Primero/Entornos de desarrollo/007-Elaboraci\303\263n de diagramas de comportamiento/006-Generaci\303\263n autom\303\241tica de c\303\263digo. Ingenier\303\255a inversa/001-Contenidos b\303\241sicos/Contenidos b\303\241sicos.md" (100%)
 create mode 100755 "Primero/Entornos de desarrollo/007-Elaboraci\303\263n de diagramas de comportamiento/006-Generaci\303\263n autom\303\241tica de c\303\263digo. Ingenier\303\255a inversa/201-Criterios de evaluaci\303\263n/Criterios de evaluaci\303\263n.md"
 rename "Primero/Entornos de desarrollo/006-Elaboraci\303\263n de diagramas de comportamiento/Criterios de evaluacion.md" => "Primero/Entornos de desarrollo/007-Elaboraci\303\263n de diagramas de comportamiento/Criterios de evaluacion.md" (100%)
 create mode 100644 "Primero/Sistemas inform\303\241ticos/002-Instalaci\303\263n de sistemas operativos/012-Actualizaci\303\263n y recuperaci\303\263n de sistemas operativos y aplicaciones/101-Ejercicios/003-dist upgrade.md"
 create mode 100644 "Primero/Sistemas inform\303\241ticos/002-Instalaci\303\263n de sistemas operativos/012-Actualizaci\303\263n y recuperaci\303\263n de sistemas operativos y aplicaciones/101-Ejercicios/004-instalar paquete.md"
 create mode 100644 "Primero/Sistemas inform\303\241ticos/002-Instalaci\303\263n de sistemas operativos/012-Actualizaci\303\263n y recuperaci\303\263n de sistemas operativos y aplicaciones/101-Ejercicios/005-actualizar apache.md"
 create mode 100644 "Primero/Sistemas inform\303\241ticos/002-Instalaci\303\263n de sistemas operativos/012-Actualizaci\303\263n y recuperaci\303\263n de sistemas operativos y aplicaciones/101-Ejercicios/006-crear carpeta de copia de seguridad.md"
 create mode 100644 "Primero/Sistemas inform\303\241ticos/002-Instalaci\303\263n de sistemas operativos/012-Actualizaci\303\263n y recuperaci\303\263n de sistemas operativos y aplicaciones/101-Ejercicios/007-creo un archivo sh.md"
 create mode 100644 "Primero/Sistemas inform\303\241ticos/002-Instalaci\303\263n de sistemas operativos/012-Actualizaci\303\263n y recuperaci\303\263n de sistemas operativos y aplicaciones/101-Ejercicios/008-especificar ejecutable.md"
 create mode 100644 "Primero/Sistemas inform\303\241ticos/002-Instalaci\303\263n de sistemas operativos/012-Actualizaci\303\263n y recuperaci\303\263n de sistemas operativos y aplicaciones/101-Ejercicios/009-Introduccion a cron.md"
```

### esquema hasta el momento

```markdown
1.-Desarrollado en local
2.-Subimos el código a un repositorio remoto (en la nube)
3.-Nos conectamos al servidor
4.-Desde el servidor traemos el código

De nuevo:

Tenemos un equipo de desarrollo 
Y tenemos un servidor de producción

1.-Primero creo un repositorio
2.-Me clono el repositorio en mi máquina de desarrollo (por ejemplo con GitHub Desktop para hacerlo fácil) - File->Clone repository
3.-Con mi editor/entorno favorito accedo a la carpeta
4.-Ahora creo lo que sea necesario
5.-Ahora realizo un commit + push (Desde GitHub Desktop)
6.-Ahora me conecto al servidor

josevicente@josevicenteportatil:~$ ssh josevicente@192.168.1.78

josevicente@ubuntuserver:~$ cd /var/www/html


7.-Ahora traigo la carpeta desde github.com (la nube) hasta mi servidor

josevicente@ubuntuserver:/var/www/html$ sudo git clone https://github.com/jocarsa/miweb.git
```

### Actualización del despliegue

```markdown
1.-Primero realizo un cambio en local

2.-Hago commit y push

Primera ventaja: tengo versiones
Tengo una memoria de todo lo que ha ocurrido, y eso quiere decir que podría volver atrás

3.-Pero ahora accedo al servidor y traigo esa nueva versión

josevicente@ubuntuserver:/var/www/html/miweb$ sudo git fetch
remote: Enumerating objects: 5, done.
remote: Counting objects: 100% (5/5), done.
remote: Compressing objects: 100% (2/2), done.
remote: Total 3 (delta 0), reused 3 (delta 0), pack-reused 0 (from 0)
Unpacking objects: 100% (3/3), 363 bytes | 181.00 KiB/s, done.
From https://github.com/jocarsa/miweb
   68acb5f..92eefe7  main       -> origin/main
josevicente@ubuntuserver:/var/www/html/miweb$ 
josevicente@ubuntuserver:/var/www/html/miweb$ sudo git pull origin main

josevicente@ubuntuserver:/var/www/html/miweb$ sudo git pull origin main
From https://github.com/jocarsa/miweb
 * branch            main       -> FETCH_HEAD
Updating 68acb5f..92eefe7
Fast-forward
 index.html | 1 +
 1 file changed, 1 insertion(+)
josevicente@ubuntuserver:/var/www/html/miweb$ 
```

### averiguar versiones

```markdown
git fetch --tags

git config --global --add safe.directory /var/www/html/miweb

curl -s https://api.github.com/repos/jocarsa/miweb/tags

# Ver todas las versiones

sudo git log --oneline --graph --decorate --all

#Revertir a una versión anterior
git revert 68acb5f

# Si hay conflictos, forzar reversión

git add index.html
git revert --continue
```

### asignar permisos

```markdown
josevicente@ubuntuserver:/var/www/html/miweb$ sudo git revert --continue
Author identity unknown

*** Please tell me who you are.

Run

  git config --global user.email "you@example.com"
  git config --global user.name "Your Name"

to set your account's default identity.
Omit --global to set the identity only in this repository.

fatal: unable to auto-detect email address (got 'root@ubuntuserver.(none)')
josevicente@ubuntuserver:/var/www/html/miweb$ git config --global user.email "info@josevicentecarratala.com"
josevicente@ubuntuserver:/var/www/html/miweb$ git config --global user.name "jocarsa"
warning: user.name has multiple values
error: cannot overwrite multiple values with a single value
       Use a regexp, --add or --replace-all to change user.name.
josevicente@ubuntuserver:/var/www/html/miweb$ git config --global --replace-all user.name "jocarsa"
josevicente@ubuntuserver:/var/www/html/miweb$ git config --global user.name
jocarsa
josevicente@ubuntuserver:/var/www/html/miweb$ git config --global user.email
info@josevicentecarratala.com
josevicente@ubuntuserver:/var/www/html/miweb$ sudo git revert --continue
Author identity unknown

*** Please tell me who you are.

Run

  git config --global user.email "you@example.com"
  git config --global user.name "Your Name"

to set your account's default identity.
Omit --global to set the identity only in this repository.

fatal: unable to auto-detect email address (got 'root@ubuntuserver.(none)')
josevicente@ubuntuserver:/var/www/html/miweb$ 
```

<a id="documentacion-uso-de-comentarios-alternativas"></a>
## Documentación. Uso de comentarios. Alternativas

La elaboración de diagramas de clases es una técnica fundamental en el diseño orientado a objetos (OOP), permitiendo visualizar la estructura y relaciones entre las clases de un sistema. Este proceso es esencial para entender cómo se organizan los datos y los comportamientos dentro del software, facilitando tanto su desarrollo como su mantenimiento.

La documentación asociada a estos diagramas es igualmente crucial. Es una práctica recomendada que incluya descripciones detalladas de las clases, sus atributos y métodos, así como la relación entre ellas. Esta documentación no solo sirve para orientar a los desarrolladores en el entendimiento del sistema, sino también para facilitar su comunicación entre sí.

El uso de comentarios es otro aspecto fundamental en la elaboración de diagramas de clases. Los comentarios explicativos pueden añadir contexto adicional sobre las intenciones detrás de ciertas decisiones de diseño o sobre comportamientos complejos que no sean evidentes a simple vista. Esto es especialmente útil para mantener el código legible y comprensible, incluso años después de su creación.

Las alternativas en la elaboración de diagramas de clases son numerosas y cada una tiene sus ventajas y desventajas dependiendo del contexto específico. Algunas opciones populares incluyen UML (Unified Modeling Language), Mermaid, y Lucidchart. Cada uno de estos herramientas ofrece diferentes funcionalidades y niveles de personalización, lo que permite adaptar el proceso de creación a las necesidades particulares del proyecto.

La documentación y los comentarios en los diagramas de clases deben ser actualizados constantemente para reflejar cualquier cambio en la arquitectura del sistema. Esto asegura que siempre estén alineados con la realidad del código, minimizando el riesgo de errores y facilitando la colaboración entre equipos.

La elaboración de diagramas de clases no es solo una actividad técnica, sino también un proceso creativo. Requiere habilidades analíticas y pensamiento crítico para identificar las entidades relevantes y sus relaciones. Además, requiere una buena comunicación visual para transmitir eficazmente la información.

En conclusión, la elaboración de diagramas de clases, acompañada de documentación adecuada y el uso judicioso de comentarios, es un proceso integral en el desarrollo orientado a objetos. Aporta claridad, coherencia y facilidad de comprensión al sistema, facilitando tanto su creación como su mantenimiento a lo largo del tiempo.

### ejemplo

```python
'''
    Vamos a crear un programa en Python
    Que muestre el arbol de carpetas y archivos de un directorio
    Para ello usaremos la libreria os
    Y la funcion os.walk para recorrer el arbol de directorios
    El programa pedira al usuario la ruta del directorio a mostrar
    Y mostrara el arbol de carpetas y archivos en la consola
    Y para ello usará caracteres ASCII para el arbol de directorios
    Y emojis para las carpetas y archivos
'''

import os

def mostrar_arbol_directorio(ruta_directorio):
    for raiz, carpetas, archivos in os.walk(ruta_directorio):
        nivel = raiz.replace(ruta_directorio, '').count(os.sep)
        indentacion = ' ' * 4 * nivel
        print(f"{indentacion}📁 {os.path.basename(raiz)}/")
        sub_indentacion = ' ' * 4 * (nivel + 1)
        for archivo in archivos:
            print(f"{sub_indentacion}📄 {archivo}")
    
    
      

# Ruta del directorio que queremos mostrar
ruta = input("Introduce la ruta: ")  # Puedes cambiar esto a cualquier ruta que desees
mostrar_arbol_directorio(ruta)
```

### docstring en las funciones

```python
'''
    Vamos a crear un programa en Python
    Que muestre el arbol de carpetas y archivos de un directorio
    Para ello usaremos la libreria os
    Y la funcion os.walk para recorrer el arbol de directorios
    El programa pedira al usuario la ruta del directorio a mostrar
    Y mostrara el arbol de carpetas y archivos en la consola
    Y para ello usará caracteres ASCII para el arbol de directorios
    Y emojis para las carpetas y archivos
'''

import os

def mostrar_arbol_directorio(ruta_directorio):
    '''
    Muestra el árbol de directorios y archivos de la ruta especificada.
    Parámetros:
    ruta_directorio (str): La ruta del directorio a mostrar.
    Retorna:    
    None (porque solo imprime en consola)
    '''
    for raiz, carpetas, archivos in os.walk(ruta_directorio):
        nivel = raiz.replace(ruta_directorio, '').count(os.sep)
        indentacion = ' ' * 4 * nivel
        print(f"{indentacion}📁 {os.path.basename(raiz)}/")
        sub_indentacion = ' ' * 4 * (nivel + 1)
        for archivo in archivos:
            print(f"{sub_indentacion}📄 {archivo}")
    
    
      

# Ruta del directorio que queremos mostrar
ruta = input("Introduce la ruta: ")  # Puedes cambiar esto a cualquier ruta que desees
mostrar_arbol_directorio(ruta)
```

### comentarios en linea

```python
'''
    Vamos a crear un programa en Python
    Que muestre el arbol de carpetas y archivos de un directorio
    Para ello usaremos la libreria os
    Y la funcion os.walk para recorrer el arbol de directorios
    El programa pedira al usuario la ruta del directorio a mostrar
    Y mostrara el arbol de carpetas y archivos en la consola
    Y para ello usará caracteres ASCII para el arbol de directorios
    Y emojis para las carpetas y archivos
'''

import os

def mostrar_arbol_directorio(ruta_directorio):
    '''
    Muestra el árbol de directorios y archivos de la ruta especificada.
    Parámetros:
    ruta_directorio (str): La ruta del directorio a mostrar.
    Retorna:    
    None (porque solo imprime en consola)
    '''
    for raiz, carpetas, archivos in os.walk(ruta_directorio):   # Recorre el árbol de directorios
        nivel = raiz.replace(ruta_directorio, '').count(os.sep) # Calcula el nivel de profundidad
        indentacion = ' ' * 4 * nivel                           # Crea la indentación según el nivel
        print(f"{indentacion}📁 {os.path.basename(raiz)}/")     # Muestra la carpeta actual    
        sub_indentacion = ' ' * 4 * (nivel + 1)                 # Indentación para los archivos dentro de la carpeta
        for archivo in archivos:                                # Recorre los archivos en la carpeta actual
            print(f"{sub_indentacion}📄 {archivo}")             # Muestra el archivo
    
    
      

# Ruta del directorio que queremos mostrar
ruta = input("Introduce la ruta: ")  # Puedes cambiar esto a cualquier ruta que desees
mostrar_arbol_directorio(ruta)
```

### cambio la peticion

```python
'''
    Vamos a crear un programa en Python
    Que muestre el arbol de carpetas y archivos de un directorio
    Para ello usaremos la libreria os
    Y la funcion os.walk para recorrer el arbol de directorios
    El programa pedira al usuario la ruta del directorio a mostrar
    Y mostrara el arbol de carpetas y archivos en la consola
    Y para ello usará caracteres ASCII para el arbol de directorios
    Y emojis para las carpetas y archivos
'''

import os

def mostrar_arbol_directorio(ruta_directorio):
    '''
    Muestra el árbol de directorios y archivos de la ruta especificada.
    Parámetros:
    ruta_directorio (str): La ruta del directorio a mostrar.
    Retorna:    
    una cadena de texto con el árbol de directorios y archivos (no con print sino con return    )
    '''
    for raiz, carpetas, archivos in os.walk(ruta_directorio):   # Recorre el árbol de directorios
        nivel = raiz.replace(ruta_directorio, '').count(os.sep)  # Calcula el nivel de profundidad
        indentacion = ' ' * 4 * nivel  # Crea la indentación según el nivel
        print(f"{indentacion}📁 {os.path.basename(raiz)}/")  # Muestra la carpeta actual
        sub_indentacion = ' ' * 4 * (nivel + 1)  # Indentación para los archivos
        for archivo in archivos:  # Recorre los archivos en la carpeta actual
            print(f"{sub_indentacion}📄 {archivo}")  # Muestra cada archivo
      
        
    
    
      

# Ruta del directorio que queremos mostrar
ruta = input("Introduce la ruta: ")  # Puedes cambiar esto a cualquier ruta que desees
mostrar_arbol_directorio(ruta)
```

### readme.nd en githug

```markdown
Utilizamos IA para crear la documentación de los repostitorios.

Por ejemplo:

# carpetaspython

Programa en **Python** que muestra el **árbol de carpetas y archivos** de un directorio usando `os.walk`, dibujando ramas con ASCII y añadiendo **emojis** para carpetas y archivos.

> 📁 Carpetas → `📁`
>
> 📄 Archivos → `📄`

---

## ✨ Características

* Recorre recursivamente cualquier ruta local.
* Dibuja la jerarquía con indentación ASCII.
* Emojis para distinguir carpetas y archivos.
* Función principal que **devuelve** el árbol como cadena (útil para tests / logging) y script que lo **imprime** en consola.

---

## 🚀 Requisitos

* Python **3.8+**
* No necesita dependencias externas.

---

## 📦 Instalación

Clona el repositorio:

```bash
git clone https://github.com/jocarsa/carpetaspython.git
cd carpetaspython
```

---

## 🧰 Uso rápido

Ejecuta el script y escribe la ruta cuando te la pida:

```bash
python carpetas.py
```

Salida esperada (ejemplo):

```
Introduce la ruta: /home/usuario/proyecto
📁 proyecto/
    📁 datos/
        📄 ventas.csv
    📁 src/
        📄 main.py
        📄 utils.py
    📄 README.md
```

> 💡 En Windows, si no ves emojis, asegúrate de usar una consola que los soporte (Windows Terminal / PowerShell moderno).

---

## 🧩 Código principal

Si quieres usar la función en otro módulo, puedes importarla. La función **devuelve** una cadena con el árbol:

```python
import os

def mostrar_arbol_directorio(ruta_directorio: str) -> str:
    """
    Muestra el árbol de directorios y archivos de la ruta especificada.
    Parámetros:
        ruta_directorio (str): La ruta del directorio a mostrar.
    Retorna:
        str: Cadena de texto con el árbol de directorios y archivos.
    """
    lineas = []
    for raiz, carpetas, archivos in os.walk(ruta_directorio):
        nivel = raiz.replace(ruta_directorio, "").count(os.sep)
        indentacion = " " * 4 * nivel
        lineas.append(f"{indentacion}📁 {os.path.basename(raiz) or os.path.basename(ruta_directorio)}/")
        sub_indentacion = " " * 4 * (nivel + 1)
        for archivo in archivos:
            lineas.append(f"{sub_indentacion}📄 {archivo}")
    return "\n".join(lineas)

if __name__ == "__main__":
    ruta = input("Introduce la ruta: ").strip()
    if not ruta:
        print("⚠️ Debes introducir una ruta.")
    elif not os.path.isdir(ruta):
        print(f"❌ La ruta no existe o no es un directorio: {ruta}")
    else:
        print(mostrar_arbol_directorio(ruta))
```

---

## 🧪 Ejemplo programático

```python
from carpetas import mostrar_arbol_directorio
print(mostrar_arbol_directorio("/ruta/a/inspeccionar"))
```

---

## 🛠️ Detalles de implementación

* `os.walk(ruta)` recorre la estructura de carpetas.
* El **nivel** de profundidad se calcula contando separadores (`os.sep`).
* La **indentación** se hace con 4 espacios por nivel.
* El **nombre base** de la carpeta se obtiene con `os.path.basename`.

---

## 🗺️ Roadmap (ideas)

* Opción CLI con `argparse` (`python carpetas.py --path . --no-emoji`).
* Parámetro para **ordenar** carpetas/archivos alfabéticamente.
* Alternar símbolos ASCII puros (`+--` / `|  `) para compatibilidad 100% sin emojis.
* Exclusiones por patrón (`--ignore ".git,__pycache__"`).
* Test unitarios simples con `pytest`.

---

## 🤝 Contribuir

¡Se aceptan PRs! Abre un *issue* con propuestas o errores detectados.

---

## 📄 Licencia

MIT © Jose Vicente Carratalá

---

## 👤 Autor

**Jose Vicente Carratalá** — [@jocarsa](https://github.com/jocarsa)
```

### programa python de programacion

```python
import sqlite3

basededatos = sqlite3.connect('clientes.db')
cursor = basededatos.cursor()
cursor.execute('''
CREATE TABLE IF NOT EXISTS clientes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    edad INTEGER NOT NULL,
    email TEXT NOT NULL UNIQUE
)
''')    
basededatos.commit()

print("Bienvenido al sistema de gestión de clientes.")

while True:
    print("Seleccione una opción:")
    print("1. Añadir cliente")
    print("2. Ver clientes")
    opcion = input("Opción (1/2): ")

    if opcion == '1':
        nombre = input("Nombre: ")
        edad = int(input("Edad: "))
        email = input("Email: ")

        cursor.execute('''
        INSERT INTO clientes (nombre, edad, email)
        VALUES (?, ?, ?)
        ''', (nombre, edad, email))
        basededatos.commit()
        print("Cliente añadido exitosamente.")
    elif opcion == '2':
        cursor.execute('SELECT * FROM clientes')
        clientes = cursor.fetchall()
        print("Lista de clientes:")
        for cliente in clientes:
            print(f"ID: {cliente[0]}, Nombre: {cliente[1]}, Edad: {cliente[2]}, Email: {cliente[3]}")
    else:
        print("Opción no válida. Por favor, seleccione 1 o 2.")
    continuar = input("¿Desea realizar otra operación? (s/n): ")
    if continuar.lower() != 's':
        break   

basededatos.close()
```

### aplicamos refactorizacion

```python
import sqlite3

def imprimeMenu():
    print("Seleccione una opción:")
    print("1. Añadir cliente")
    print("2. Ver clientes")

def insertar_cliente():
    nombre = input("Nombre: ")
    edad = int(input("Edad: "))
    email = input("Email: ")
    
    cursor.execute('''
    INSERT INTO clientes (nombre, edad, email)
    VALUES (?, ?, ?)
    ''', (nombre, edad, email))
    basededatos.commit()
    print("Cliente añadido exitosamente.")

basededatos = sqlite3.connect('clientes.db')
cursor = basededatos.cursor()
cursor.execute('''
CREATE TABLE IF NOT EXISTS clientes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    edad INTEGER NOT NULL,
    email TEXT NOT NULL UNIQUE
)
''')    
basededatos.commit()

print("Bienvenido al sistema de gestión de clientes.")

while True:
    imprimeMenu()
    opcion = input("Opción (1/2): ")

    if opcion == '1':
        insertar_cliente()
        
    elif opcion == '2':
        cursor.execute('SELECT * FROM clientes')
        clientes = cursor.fetchall()
        print("Lista de clientes:")
        for cliente in clientes:
            print(f"ID: {cliente[0]}, Nombre: {cliente[1]}, Edad: {cliente[2]}, Email: {cliente[3]}")
    else:
        print("Opción no válida. Por favor, seleccione 1 o 2.")
    continuar = input("¿Desea realizar otra operación? (s/n): ")
    if continuar.lower() != 's':
        break   

basededatos.close()
```

### seguimos refactorizando

```python
import sqlite3

basededatos = sqlite3.connect('clientes.db')
cursor = basededatos.cursor()

def imprimeMenu():
    print("Seleccione una opción:")
    print("1. Añadir cliente")
    print("2. Ver clientes")

def insertar_cliente():
    nombre = input("Nombre: ")
    edad = int(input("Edad: "))
    email = input("Email: ")
    
    cursor.execute('''
    INSERT INTO clientes (nombre, edad, email)
    VALUES (?, ?, ?)
    ''', (nombre, edad, email))
    basededatos.commit()
    print("Cliente añadido exitosamente.")

def seleccionarClientes():
    cursor.execute('SELECT * FROM clientes')
    clientes = cursor.fetchall()
    print("Lista de clientes:")
    for cliente in clientes:
        print(f"ID: {cliente[0]}, Nombre: {cliente[1]}, Edad: {cliente[2]}, Email: {cliente[3]}")

def crear_tabla():
    cursor.execute('''
    CREATE TABLE IF NOT EXISTS clientes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nombre TEXT NOT NULL,
        edad INTEGER NOT NULL,
        email TEXT NOT NULL UNIQUE
    )
    ''')    
    basededatos.commit()

print("Bienvenido al sistema de gestión de clientes.")

while True:
    imprimeMenu()
    opcion = input("Opción (1/2): ")
    if opcion == '1':
        insertar_cliente()
    elif opcion == '2':
        seleccionarClientes()
    else:
        print("Opción no válida. Por favor, seleccione 1 o 2.")
    continuar = input("¿Desea realizar otra operación? (s/n): ")
    if continuar.lower() != 's':
        break   

basededatos.close()
```

### documentamos dostring

```python
'''
Programa para gestionar una base de datos de clientes utilizando SQLite.
Permite insertar nuevos clientes y ver la lista de clientes existentes.
Utiliza una tabla llamada 'clientes' con los campos: id, nombre, edad y email.  
'''
import sqlite3

basededatos = sqlite3.connect('clientes.db')
cursor = basededatos.cursor()

def imprimeMenu():
    print("Seleccione una opción:")
    print("1. Añadir cliente")
    print("2. Ver clientes")

def insertar_cliente():
    nombre = input("Nombre: ")
    edad = int(input("Edad: "))
    email = input("Email: ")
    
    cursor.execute('''
    INSERT INTO clientes (nombre, edad, email)
    VALUES (?, ?, ?)
    ''', (nombre, edad, email))
    basededatos.commit()
    print("Cliente añadido exitosamente.")

def seleccionarClientes():
    cursor.execute('SELECT * FROM clientes')
    clientes = cursor.fetchall()
    print("Lista de clientes:")
    for cliente in clientes:
        print(f"ID: {cliente[0]}, Nombre: {cliente[1]}, Edad: {cliente[2]}, Email: {cliente[3]}")

def crear_tabla():
    cursor.execute('''
    CREATE TABLE IF NOT EXISTS clientes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nombre TEXT NOT NULL,
        edad INTEGER NOT NULL,
        email TEXT NOT NULL UNIQUE
    )
    ''')    
    basededatos.commit()

print("Bienvenido al sistema de gestión de clientes.")

while True:
    imprimeMenu()
    opcion = input("Opción (1/2): ")
    if opcion == '1':
        insertar_cliente()
    elif opcion == '2':
        seleccionarClientes()
    else:
        print("Opción no válida. Por favor, seleccione 1 o 2.")
    continuar = input("¿Desea realizar otra operación? (s/n): ")
    if continuar.lower() != 's':
        break   

basededatos.close()
```

### documentamos las funciones

```python
'''
Programa para gestionar una base de datos de clientes utilizando SQLite.
Permite insertar nuevos clientes y ver la lista de clientes existentes.
Utiliza una tabla llamada 'clientes' con los campos: id, nombre, edad y email.  
'''
import sqlite3

basededatos = sqlite3.connect('clientes.db')
cursor = basededatos.cursor()

def imprimeMenu():
    '''
    Muestra el menú de opciones al usuario.
    No tiene parámetros ni retorna valores.
    '''
    print("Seleccione una opción:")
    print("1. Añadir cliente")
    print("2. Ver clientes")

def insertar_cliente():
    '''
    Inserta un nuevo cliente en la base de datos.
    Solicita al usuario el nombre, edad y email del cliente.
    No retorna valores.
    '''
    nombre = input("Nombre: ")
    edad = int(input("Edad: "))
    email = input("Email: ")
    
    cursor.execute('''
    INSERT INTO clientes (nombre, edad, email)
    VALUES (?, ?, ?)
    ''', (nombre, edad, email))
    basededatos.commit()
    print("Cliente añadido exitosamente.")

def seleccionarClientes():
    '''
    Selecciona y muestra todos los clientes de la base de datos.
    No tiene parámetros ni retorna valores.'''
    cursor.execute('SELECT * FROM clientes')
    clientes = cursor.fetchall()
    print("Lista de clientes:")
    for cliente in clientes:
        print(f"ID: {cliente[0]}, Nombre: {cliente[1]}, Edad: {cliente[2]}, Email: {cliente[3]}")

def crear_tabla():
    '''
    Crea la tabla 'clientes' en la base de datos si no existe.
    No tiene parámetros ni retorna valores.
    '''
    cursor.execute('''
    CREATE TABLE IF NOT EXISTS clientes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nombre TEXT NOT NULL,
        edad INTEGER NOT NULL,
        email TEXT NOT NULL UNIQUE
    )
    ''')    
    basededatos.commit()

print("Bienvenido al sistema de gestión de clientes.")

while True:                                     # Bucle principal del programa  
    imprimeMenu()                               # Muestra el menú de opciones
    opcion = input("Opción (1/2): ")            # Solicita la opción al usuario
    if opcion == '1':                           # Si la opcion seleccionada es la 1
        insertar_cliente()                      # Llama a la función para ver los clientes
    elif opcion == '2':                         # Si la opcion seleccionada es la 2 
        seleccionarClientes()                   # Llama a la función para insertar un cliente
    else:                                       # Si la opcion no es válida
        print("Opción no válida. Por favor, seleccione 1 o 2.") #   Mensaje de error
    continuar = input("¿Desea realizar otra operación? (s/n): ")# Pregunta si desea continuar
    if continuar.lower() != 's':                # Si la respuesta no es S 
        break                                   # Sale del bucle principal

basededatos.close()
```

### ambito de la informacion

```python
operando1 = 10
operando2 = 5

def sumar():
    resultado = operando1 + operando2
    return resultado

print(sumar())  # Imprime 15
```

### ahora externalizo

```python
from sumar import sumar

operando1 = 10
operando2 = 5

print(sumar())  # Imprime 15
```

### llamada buena a sumar

```python
from sumarbueno import sumar

operando1 = 10
operando2 = 5

print(sumar(operando1,operando2))  # Imprime 15
```

### refactorizamos mas alla

```python
'''
Programa para gestionar una base de datos de clientes utilizando SQLite.
Permite insertar nuevos clientes y ver la lista de clientes existentes.
Utiliza una tabla llamada 'clientes' con los campos: id, nombre, edad y email.  
'''
from funcionesbasededatos import imprimeMenu, insertar_cliente, seleccionarClientes, crear_tabla

print("Bienvenido al sistema de gestión de clientes.")

while True:                                     # Bucle principal del programa  
    imprimeMenu()                               # Muestra el menú de opciones
    opcion = input("Opción (1/2): ")            # Solicita la opción al usuario
    if opcion == '1':                           # Si la opcion seleccionada es la 1
        insertar_cliente()                      # Llama a la función para ver los clientes
    elif opcion == '2':                         # Si la opcion seleccionada es la 2 
        seleccionarClientes()                   # Llama a la función para insertar un cliente
    else:                                       # Si la opcion no es válida
        print("Opción no válida. Por favor, seleccione 1 o 2.") #   Mensaje de error
    continuar = input("¿Desea realizar otra operación? (s/n): ")# Pregunta si desea continuar
    if continuar.lower() != 's':                # Si la respuesta no es S 
        break                                   # Sale del bucle principal
```

### refactorizacion en archivos individuales

```python
'''
Programa para gestionar una base de datos de clientes utilizando SQLite.
Permite insertar nuevos clientes y ver la lista de clientes existentes.
Utiliza una tabla llamada 'clientes' con los campos: id, nombre, edad y email.  
'''
from fcreartabla import crear_tabla
from finsertarcliente import insertar_cliente
from fseleccionaclientes import seleccionarClientes
from fimprimemenu import imprimeMenu

print("Bienvenido al sistema de gestión de clientes.")

while True:                                     # Bucle principal del programa  
    imprimeMenu()                               # Muestra el menú de opciones
    opcion = input("Opción (1/2): ")            # Solicita la opción al usuario
    if opcion == '1':                           # Si la opcion seleccionada es la 1
        insertar_cliente()                      # Llama a la función para ver los clientes
    elif opcion == '2':                         # Si la opcion seleccionada es la 2 
        seleccionarClientes()                   # Llama a la función para insertar un cliente
    else:                                       # Si la opcion no es válida
        print("Opción no válida. Por favor, seleccione 1 o 2.") #   Mensaje de error
    continuar = input("¿Desea realizar otra operación? (s/n): ")# Pregunta si desea continuar
    if continuar.lower() != 's':                # Si la respuesta no es S 
        break                                   # Sale del bucle principal
```

### fcreartabla

```python
import sqlite3
def crear_tabla():
    '''
    Crea la tabla 'clientes' en la base de datos si no existe.
    No tiene parámetros ni retorna valores.
    '''
    basededatos = sqlite3.connect('clientes.db')
    cursor = basededatos.cursor()
    cursor.execute('''
    CREATE TABLE IF NOT EXISTS clientes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nombre TEXT NOT NULL,
        edad INTEGER NOT NULL,
        email TEXT NOT NULL UNIQUE
    )
    ''')    
    basededatos.commit()
```

### fimprimemenu

```python
def imprimeMenu():
    '''
    Muestra el menú de opciones al usuario.
    No tiene parámetros ni retorna valores.
    '''
    print("Seleccione una opción:")
    print("1. Añadir cliente")
    print("2. Ver clientes")
```

### finsertarcliente

```python
import sqlite3
def insertar_cliente():
    '''
    Inserta un nuevo cliente en la base de datos.
    Solicita al usuario el nombre, edad y email del cliente.
    No retorna valores.
    '''
    basededatos = sqlite3.connect('clientes.db')
    cursor = basededatos.cursor()
    nombre = input("Nombre: ")
    edad = int(input("Edad: "))
    email = input("Email: ")
    
    cursor.execute('''
    INSERT INTO clientes (nombre, edad, email)
    VALUES (?, ?, ?)
    ''', (nombre, edad, email))
    basededatos.commit()
    print("Cliente añadido exitosamente.")
```

### fseleccionaclientes

```python
import sqlite3
def seleccionarClientes():
    '''
    Selecciona y muestra todos los clientes de la base de datos.
    No tiene parámetros ni retorna valores.
    '''
    basededatos = sqlite3.connect('clientes.db')
    cursor = basededatos.cursor()
    cursor.execute('SELECT * FROM clientes')
    clientes = cursor.fetchall()
    print("Lista de clientes:")
    for cliente in clientes:
        print(f"ID: {cliente[0]}, Nombre: {cliente[1]}, Edad: {cliente[2]}, Email: {cliente[3]}")
```

### funcionesbasededatos

```python
import sqlite3

def imprimeMenu():
    '''
    Muestra el menú de opciones al usuario.
    No tiene parámetros ni retorna valores.
    '''
    print("Seleccione una opción:")
    print("1. Añadir cliente")
    print("2. Ver clientes")

def insertar_cliente():
    '''
    Inserta un nuevo cliente en la base de datos.
    Solicita al usuario el nombre, edad y email del cliente.
    No retorna valores.
    '''
    basededatos = sqlite3.connect('clientes.db')
    cursor = basededatos.cursor()
    nombre = input("Nombre: ")
    edad = int(input("Edad: "))
    email = input("Email: ")
    
    cursor.execute('''
    INSERT INTO clientes (nombre, edad, email)
    VALUES (?, ?, ?)
    ''', (nombre, edad, email))
    basededatos.commit()
    print("Cliente añadido exitosamente.")

def seleccionarClientes():
    '''
    Selecciona y muestra todos los clientes de la base de datos.
    No tiene parámetros ni retorna valores.
    '''
    basededatos = sqlite3.connect('clientes.db')
    cursor = basededatos.cursor()
    cursor.execute('SELECT * FROM clientes')
    clientes = cursor.fetchall()
    print("Lista de clientes:")
    for cliente in clientes:
        print(f"ID: {cliente[0]}, Nombre: {cliente[1]}, Edad: {cliente[2]}, Email: {cliente[3]}")

def crear_tabla():
    '''
    Crea la tabla 'clientes' en la base de datos si no existe.
    No tiene parámetros ni retorna valores.
    '''
    basededatos = sqlite3.connect('clientes.db')
    cursor = basededatos.cursor()
    cursor.execute('''
    CREATE TABLE IF NOT EXISTS clientes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nombre TEXT NOT NULL,
        edad INTEGER NOT NULL,
        email TEXT NOT NULL UNIQUE
    )
    ''')    
    basededatos.commit()
```

### sumar

```python
def sumar():
    resultado = operando1 + operando2
    return resultado
```

### sumarbueno

```python
def sumar(operando1, operando2):
    resultado = operando1 + operando2
    return resultado
```

<a id="integracion-continua-herramientas"></a>
## Integración continua. Herramientas

La integración continua es una práctica fundamental en el desarrollo de software que busca mejorar la calidad del producto final mediante un flujo constante de cambios y pruebas. En esta subunidad didáctica, nos centraremos en cómo implementar y utilizar herramientas para facilitar este proceso.

En primer lugar, comprendamos qué es la integración continua. Es una metodología que permite automatizar el proceso de integración de código fuente desde diferentes fuentes a un repositorio centralizado, seguido por pruebas automáticas para asegurar que las modificaciones no rompan el sistema existente. Esta práctica es crucial en proyectos complejos donde los cambios frecuentes pueden llevar a conflictos y errores.

Para implementar la integración continua, se utilizan herramientas especializadas como Jenkins, GitLab CI, o Travis CI. Estas herramientas ofrecen una serie de ventajas significativas. Primero, permiten un flujo constante de código desde diferentes fuentes al repositorio principal, lo que facilita el seguimiento y la colaboración entre los miembros del equipo. Segundo, automatizan las pruebas para asegurar que el sistema funcione correctamente después de cada integración, reduciendo significativamente el tiempo dedicado a pruebas manuales.

La configuración de estas herramientas es relativamente sencilla pero requiere un entendimiento básico de cómo funcionan los sistemas de control de versiones y las prácticas de desarrollo ágil. Una vez configuradas, las herramientas pueden ser personalizadas para adaptarse a las necesidades específicas del proyecto, lo que puede incluir la ejecución de pruebas unitarias, integración con sistemas de gestión de bases de datos, o incluso el despliegue automático en entornos de producción.

Es importante destacar que la integración continua no solo mejora la calidad del software, sino que también aumenta la productividad del equipo. Al eliminar los tiempos de espera entre las etapas de desarrollo y pruebas, se puede reducir el tiempo total necesario para lanzar nuevas versiones del producto. Además, facilita la identificación temprana de errores, lo que permite una corrección rápida y eficiente.

En esta subunidad, exploraremos en profundidad cómo configurar y utilizar herramientas de integración continua. Aprenderemos a definir flujos de trabajo personalizados, cómo gestionar los entornos de prueba y producción, y cómo monitorear el estado del proyecto en tiempo real. Además, discutiremos las mejores prácticas para mantener la seguridad y la calidad durante el proceso de integración continua.

La integración continua es una herramienta poderosa que puede transformar la forma en que se desarrollan los sistemas informáticos. Al automatizar el flujo de trabajo y asegurar la calidad del código, permite a los equipos concentrarse en lo que realmente importa: resolver problemas y mejorar la experiencia del usuario.

En resumen, la integración continua es una práctica esencial en el desarrollo moderno de software que mejora significativamente la eficiencia y la calidad del producto final. A través de herramientas especializadas y un proceso bien definido, los equipos pueden implementar esta metodología con éxito, lo que resulta en productos más robustos y satisfactorios para los usuarios finales.

<a id="simulacro-examen"></a>
## Simulacro examen

### Enunciado

```markdown
Actividad final de trimestre:

Toma un programa - el examen de programación que estamos haciendo en el ciclo
Aplica refactorización basada en extracción de funciones
Luego aplica extracción a archivos (libreria de Python)
Documenta, tanto en docstring de programa, como en docstring de funcion, como en comentarios de lineas, cdonde corresponda

Crea una cuenta en GitHub
Crea un repositorio para este proyecto
Clona el repositorio en tu equipo con GitHub Desktop
Pon el código del proyecto en la carpeta clonada
Realiza un commit y push
Comprueba que el código se ha subido correctamente a GitHub

Realiza una modificación en el código
Realiza un nuevo commit y push
Comprueba el histórico de versiones en GitHub
```

### base del examen

```python
import mysql.connector

conexion = mysql.connector.connect(
  host="localhost",
  user="portafolio",
  password="portafolio",
  database="portafolio"
)
cursor = conexion.cursor() 

def presentaMenu():
  print("Escoge una opcion")
  print("1.-Insertar")
  print("2.-Listar")
  print("3.-Actualizar")
  print("4.-Eliminar")
  


print("Gestion de portafolio v0.1")
while True:
  presentaMenu()
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

### extraccion a funciones

```python
import mysql.connector

conexion = mysql.connector.connect(
  host="localhost",
  user="portafolio",
  password="portafolio",
  database="portafolio"
)
cursor = conexion.cursor() 

def presentaMenu():
  print("Escoge una opcion")
  print("1.-Insertar")
  print("2.-Listar")
  print("3.-Actualizar")
  print("4.-Eliminar")
  
def insertar():
  titulo = input("Introduce el titulo de la nueva pieza: ")
  descripcion = input("Introduce la descripcion de la nueva pieza: ")
  fecha = input("Introduce la fecha de la nueva pieza: ")
  imagen = input("Introduce el nombre de la imagen de la nueva pieza: ")
  cursor.execute("INSERT INTO piezas VALUES (NULL,'"+titulo+"','"+descripcion+"','"+fecha+"',1,'"+imagen+"');")
  conexion.commit()
def seleccionar():
  cursor.execute("SELECT * FROM piezas;")
  lineas = cursor.fetchall()
  for linea in lineas:
    print(linea)
def actualizar():
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
def eliminar():
  identificador = input("Introduce el Identificador a eliminar: ")
  cursor.execute("DELETE FROM piezas WHERE Identificador = "+identificador+";")
  conexion.commit()


print("Gestion de portafolio v0.1")
while True:
  presentaMenu()
  opcion = int(input("Escoge una opcion: "))
  print("La opción que has escogido es: ",opcion)
  if opcion == 1:
    insertar()
  elif opcion == 2:
    seleccionar()
  elif opcion == 3:
    actualizar()
  elif opcion == 4:
    eliminar()
```

### importacion de archivo

```python
from funcionesbasededatos import presentaMenu,insertar,seleccionar, actualizar,eliminar

print("Gestion de portafolio v0.1")
while True:
  presentaMenu()
  opcion = int(input("Escoge una opcion: "))
  print("La opción que has escogido es: ",opcion)
  if opcion == 1:
    insertar()
  elif opcion == 2:
    seleccionar()
  elif opcion == 3:
    actualizar()
  elif opcion == 4:
    eliminar()
```

### documentacion

```python
'''
  Programa de examen
  Este es un crud de piezas de portafolio
  (c) 2025 Jose Vicente Carratala
'''

# Las funciones de tratamiento de bases de datos se encuentran en libreria externa
from funcionesbasededatos import presentaMenu,insertar,seleccionar, actualizar,eliminar

print("Gestion de portafolio v0.1")
while True:                                       # Usamos while para entrar en un bucle infinito
  presentaMenu()
  opcion = int(input("Escoge una opcion: "))
  print("La opción que has escogido es: ",opcion)
  if opcion == 1:                                 # if-elif para atrapar las opciones
    insertar()
  elif opcion == 2:
    seleccionar()
  elif opcion == 3:
    actualizar()
  elif opcion == 4:
    eliminar()
```

### github

```markdown
Primero creamos una cuenta en GitHub (se supone que la tenéis)

Segundo, creamos un repositorio nuevo

Clono el repositorio en mi propio equipo con GitHub Desktop

Copio el ejercicio dentro del repositorio clonado en mi ordenador

Ahora en GitHub Desktop, commit y push

Me voy a github y compruebo que los archivos han llegado

Ahora hago una modificación en un archivo (aunque sea minima)

Abro GitHub Desktop y compruebo que sale la modificacion

Vuelvo a hacer commit y push

Y por ultimo en github desktop compruebo el history
```

### funcionesbasededatos

```python
import mysql.connector

conexion = mysql.connector.connect(
  host="localhost",
  user="portafolio",
  password="portafolio",
  database="portafolio"
)
cursor = conexion.cursor() 

def presentaMenu():
  # Esta función simplemente pinta un menu en pantalla con prints
  print("Escoge una opcion")
  print("1.-Insertar")
  print("2.-Listar")
  print("3.-Actualizar")
  print("4.-Eliminar")
  
def insertar():
  # Esta funcion le pide una serie de inputs al usuario y los inserta en la base de datos
  titulo = input("Introduce el titulo de la nueva pieza: ")
  descripcion = input("Introduce la descripcion de la nueva pieza: ")
  fecha = input("Introduce la fecha de la nueva pieza: ")
  imagen = input("Introduce el nombre de la imagen de la nueva pieza: ")
  cursor.execute("INSERT INTO piezas VALUES (NULL,'"+titulo+"','"+descripcion+"','"+fecha+"',1,'"+imagen+"');")
  conexion.commit()
def seleccionar():
  #Esta función selecciona todo de la tabla y lo presenta en pantalla
  cursor.execute("SELECT * FROM piezas;")
  lineas = cursor.fetchall()
  for linea in lineas:
    print(linea)
def actualizar():
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
def eliminar():
  identificador = input("Introduce el Identificador a eliminar: ")
  cursor.execute("DELETE FROM piezas WHERE Identificador = "+identificador+";")
  conexion.commit()
```

<a id="ejercicio-de-final-de-unidad-4"></a>
## Ejercicio de final de unidad

### actividad

```markdown

```


<a id="elaboracion-de-diagramas-de-clases"></a>
# Elaboración de diagramas de clases

<a id="clases-atributos-metodos-y-visibilidad"></a>
## Clases. Atributos, métodos y visibilidad

En el mundo digital de la programación, los diagramas de comportamiento son una herramienta esencial para visualizar cómo interactúan las clases dentro de un sistema. Estos gráficos nos permiten entender no solo las relaciones entre objetos, sino también cómo estos interactúan entre sí y cambian su estado a lo largo del tiempo.

Las clases son los bloques fundamentales en la programación orientada a objetos (POO). Cada clase define una entidad con sus propias características (atributos) y acciones posibles (métodos). La visibilidad de estos elementos es crucial, ya que determina quién puede acceder o modificarlos. Los atributos pueden ser públicos, privados o protegidos, mientras que los métodos también pueden tener modificadores de acceso para controlar su uso.

El primer paso en la elaboración de diagramas de comportamiento es identificar las clases relevantes y sus relaciones con otras clases. Cada clase se representa como un rectángulo dividido en tres partes: el nombre de la clase, los atributos y los métodos. Los atributos son listados en la parte superior del rectángulo, mientras que los métodos ocupan la parte inferior.

Los métodos pueden ser estáticos o no estáticos. Los métodos estáticos pertenecen a la clase en sí misma y se pueden llamar sin necesidad de crear una instancia de la clase. Por otro lado, los métodos no estáticos requieren una instancia de la clase para su ejecución.

La visibilidad de los atributos y métodos es controlada por modificadores como `public`, `private` y `protected`. Los atributos y métodos públicos son accesibles desde cualquier parte del programa. Los privados solo pueden ser accedidos dentro de la misma clase, mientras que los protegidos están disponibles tanto dentro de la clase como en las clases derivadas.

La interacción entre clases se representa mediante líneas que conectan los rectángulos correspondientes a las clases. Estas líneas pueden tener diferentes estilos y direcciones para indicar el tipo de relación y la dirección del flujo de datos o control.

Los diagramas de comportamiento no solo ayudan a visualizar cómo interactúan las clases, sino también a identificar posibles problemas de diseño y arquitectura. Por ejemplo, si una clase tiene demasiados métodos públicos, puede indicar que la clase está haciendo demasiado trabajo y podría ser mejor dividida en varias clases más pequeñas.

La elaboración de diagramas de comportamiento es un proceso iterativo. A medida que se desarrolla el sistema, se pueden identificar nuevas relaciones entre clases o necesidades adicionales para métodos y atributos. Es importante mantener los diagramas actualizados para reflejar la realidad del sistema en desarrollo.

En conclusión, los diagramas de comportamiento son una herramienta poderosa en el arsenal del programador orientado a objetos. Al proporcionar una visión clara y detallada de cómo interactúan las clases dentro de un sistema, estos gráficos facilitan la comprensión del diseño y ayudan a identificar problemas potenciales antes de que se conviertan en problemas reales durante el desarrollo.

<a id="objetos-instanciacion"></a>
## Objetos. Instanciación

En el mundo digital de la programación, los diagramas de comportamiento son una herramienta esencial para visualizar cómo interactúan las clases dentro de un sistema. Estos gráficos nos permiten entender no solo las relaciones entre objetos, sino también cómo estos interactúan entre sí y cambian su estado a lo largo del tiempo.

Las clases son los bloques fundamentales en la programación orientada a objetos (POO). Cada clase define una entidad con sus propias características (atributos) y acciones posibles (métodos). La visibilidad de estos elementos es crucial, ya que determina quién puede acceder o modificarlos. Los atributos pueden ser públicos, privados o protegidos, mientras que los métodos también pueden tener modificadores de acceso para controlar su uso.

El primer paso en la elaboración de diagramas de comportamiento es identificar las clases relevantes y sus relaciones con otras clases. Cada clase se representa como un rectángulo dividido en tres partes: el nombre de la clase, los atributos y los métodos. Los atributos son listados en la parte superior del rectángulo, mientras que los métodos ocupan la parte inferior.

Los métodos pueden ser estáticos o no estáticos. Los métodos estáticos pertenecen a la clase en sí misma y se pueden llamar sin necesidad de crear una instancia de la clase. Por otro lado, los métodos no estáticos requieren una instancia de la clase para su ejecución.

La visibilidad de los atributos y métodos es controlada por modificadores como `public`, `private` y `protected`. Los atributos y métodos públicos son accesibles desde cualquier parte del programa. Los privados solo pueden ser accedidos dentro de la misma clase, mientras que los protegidos están disponibles tanto dentro de la clase como en las clases derivadas.

La interacción entre clases se representa mediante líneas que conectan los rectángulos correspondientes a las clases. Estas líneas pueden tener diferentes estilos y direcciones para indicar el tipo de relación y la dirección del flujo de datos o control.

Los diagramas de comportamiento no solo ayudan a visualizar cómo interactúan las clases, sino también a identificar posibles problemas de diseño y arquitectura. Por ejemplo, si una clase tiene demasiados métodos públicos, puede indicar que la clase está haciendo demasiado trabajo y podría ser mejor dividida en varias clases más pequeñas.

La elaboración de diagramas de comportamiento es un proceso iterativo. A medida que se desarrolla el sistema, se pueden identificar nuevas relaciones entre clases o necesidades adicionales para métodos y atributos. Es importante mantener los diagramas actualizados para reflejar la realidad del sistema en desarrollo.

En conclusión, los diagramas de comportamiento son una herramienta poderosa en el arsenal del programador orientado a objetos. Al proporcionar una visión clara y detallada de cómo interactúan las clases dentro de un sistema, estos gráficos facilitan la comprensión del diseño y ayudan a identificar problemas potenciales antes de que se conviertan en problemas reales durante el desarrollo.

<a id="relaciones-asociacion-navegabilidad-y-multiplicidad-herencia-composicion-agregacion-realizacion-y-dependencia"></a>
## Relaciones. Asociación, navegabilidad y multiplicidad. Herencia, composición, agregación. Realización y dependencia

En el mundo digital de la programación, los diagramas de comportamiento son una herramienta esencial para visualizar cómo interactúan las clases dentro de un sistema. Estos gráficos nos permiten entender no solo las relaciones entre objetos, sino también cómo estos interactúan entre sí y cambian su estado a lo largo del tiempo.

Las clases son los bloques fundamentales en la programación orientada a objetos (POO). Cada clase define una entidad con sus propias características (atributos) y acciones posibles (métodos). La visibilidad de estos elementos es crucial, ya que determina quién puede acceder o modificarlos. Los atributos pueden ser públicos, privados o protegidos, mientras que los métodos también pueden tener modificadores de acceso para controlar su uso.

El primer paso en la elaboración de diagramas de comportamiento es identificar las clases relevantes y sus relaciones con otras clases. Cada clase se representa como un rectángulo dividido en tres partes: el nombre de la clase, los atributos y los métodos. Los atributos son listados en la parte superior del rectángulo, mientras que los métodos ocupan la parte inferior.

Los métodos pueden ser estáticos o no estáticos. Los métodos estáticos pertenecen a la clase en sí misma y se pueden llamar sin necesidad de crear una instancia de la clase. Por otro lado, los métodos no estáticos requieren una instancia de la clase para su ejecución.

La visibilidad de los atributos y métodos es controlada por modificadores como `public`, `private` y `protected`. Los atributos y métodos públicos son accesibles desde cualquier parte del programa. Los privados solo pueden ser accedidos dentro de la misma clase, mientras que los protegidos están disponibles tanto dentro de la clase como en las clases derivadas.

La interacción entre clases se representa mediante líneas que conectan los rectángulos correspondientes a las clases. Estas líneas pueden tener diferentes estilos y direcciones para indicar el tipo de relación y la dirección del flujo de datos o control.

Los diagramas de comportamiento no solo ayudan a visualizar cómo interactúan las clases, sino también a identificar posibles problemas de diseño y arquitectura. Por ejemplo, si una clase tiene demasiados métodos públicos, puede indicar que la clase está haciendo demasiado trabajo y podría ser mejor dividida en varias clases más pequeñas.

La elaboración de diagramas de comportamiento es un proceso iterativo. A medida que se desarrolla el sistema, se pueden identificar nuevas relaciones entre clases o necesidades adicionales para métodos y atributos. Es importante mantener los diagramas actualizados para reflejar la realidad del sistema en desarrollo.

En conclusión, los diagramas de comportamiento son una herramienta poderosa en el arsenal del programador orientado a objetos. Al proporcionar una visión clara y detallada de cómo interactúan las clases dentro de un sistema, estos gráficos facilitan la comprensión del diseño y ayudan a identificar problemas potenciales antes de que se conviertan en problemas reales durante el desarrollo.

<a id="notacion-de-los-diagramas-de-clases"></a>
## Notación de los diagramas de clases

En el mundo digital de la programación, los diagramas de comportamiento son una herramienta esencial para visualizar cómo interactúan las clases dentro de un sistema. Estos gráficos nos permiten entender no solo las relaciones entre objetos, sino también cómo estos interactúan entre sí y cambian su estado a lo largo del tiempo.

Las clases son los bloques fundamentales en la programación orientada a objetos (POO). Cada clase define una entidad con sus propias características (atributos) y acciones posibles (métodos). La visibilidad de estos elementos es crucial, ya que determina quién puede acceder o modificarlos. Los atributos pueden ser públicos, privados o protegidos, mientras que los métodos también pueden tener modificadores de acceso para controlar su uso.

El primer paso en la elaboración de diagramas de comportamiento es identificar las clases relevantes y sus relaciones con otras clases. Cada clase se representa como un rectángulo dividido en tres partes: el nombre de la clase, los atributos y los métodos. Los atributos son listados en la parte superior del rectángulo, mientras que los métodos ocupan la parte inferior.

Los métodos pueden ser estáticos o no estáticos. Los métodos estáticos pertenecen a la clase en sí misma y se pueden llamar sin necesidad de crear una instancia de la clase. Por otro lado, los métodos no estáticos requieren una instancia de la clase para su ejecución.

La visibilidad de los atributos y métodos es controlada por modificadores como `public`, `private` y `protected`. Los atributos y métodos públicos son accesibles desde cualquier parte del programa. Los privados solo pueden ser accedidos dentro de la misma clase, mientras que los protegidos están disponibles tanto dentro de la clase como en las clases derivadas.

La interacción entre clases se representa mediante líneas que conectan los rectángulos correspondientes a las clases. Estas líneas pueden tener diferentes estilos y direcciones para indicar el tipo de relación y la dirección del flujo de datos o control.

Los diagramas de comportamiento no solo ayudan a visualizar cómo interactúan las clases, sino también a identificar posibles problemas de diseño y arquitectura. Por ejemplo, si una clase tiene demasiados métodos públicos, puede indicar que la clase está haciendo demasiado trabajo y podría ser mejor dividida en varias clases más pequeñas.

La elaboración de diagramas de comportamiento es un proceso iterativo. A medida que se desarrolla el sistema, se pueden identificar nuevas relaciones entre clases o necesidades adicionales para métodos y atributos. Es importante mantener los diagramas actualizados para reflejar la realidad del sistema en desarrollo.

En conclusión, los diagramas de comportamiento son una herramienta poderosa en el arsenal del programador orientado a objetos. Al proporcionar una visión clara y detallada de cómo interactúan las clases dentro de un sistema, estos gráficos facilitan la comprensión del diseño y ayudan a identificar problemas potenciales antes de que se conviertan en problemas reales durante el desarrollo.

<a id="herramientas"></a>
## Herramientas

En el mundo digital de la programación, los diagramas de comportamiento son una herramienta esencial para visualizar cómo interactúan las clases dentro de un sistema. Estos gráficos nos permiten entender no solo las relaciones entre objetos, sino también cómo estos interactúan entre sí y cambian su estado a lo largo del tiempo.

Las clases son los bloques fundamentales en la programación orientada a objetos (POO). Cada clase define una entidad con sus propias características (atributos) y acciones posibles (métodos). La visibilidad de estos elementos es crucial, ya que determina quién puede acceder o modificarlos. Los atributos pueden ser públicos, privados o protegidos, mientras que los métodos también pueden tener modificadores de acceso para controlar su uso.

El primer paso en la elaboración de diagramas de comportamiento es identificar las clases relevantes y sus relaciones con otras clases. Cada clase se representa como un rectángulo dividido en tres partes: el nombre de la clase, los atributos y los métodos. Los atributos son listados en la parte superior del rectángulo, mientras que los métodos ocupan la parte inferior.

Los métodos pueden ser estáticos o no estáticos. Los métodos estáticos pertenecen a la clase en sí misma y se pueden llamar sin necesidad de crear una instancia de la clase. Por otro lado, los métodos no estáticos requieren una instancia de la clase para su ejecución.

La visibilidad de los atributos y métodos es controlada por modificadores como `public`, `private` y `protected`. Los atributos y métodos públicos son accesibles desde cualquier parte del programa. Los privados solo pueden ser accedidos dentro de la misma clase, mientras que los protegidos están disponibles tanto dentro de la clase como en las clases derivadas.

La interacción entre clases se representa mediante líneas que conectan los rectángulos correspondientes a las clases. Estas líneas pueden tener diferentes estilos y direcciones para indicar el tipo de relación y la dirección del flujo de datos o control.

Los diagramas de comportamiento no solo ayudan a visualizar cómo interactúan las clases, sino también a identificar posibles problemas de diseño y arquitectura. Por ejemplo, si una clase tiene demasiados métodos públicos, puede indicar que la clase está haciendo demasiado trabajo y podría ser mejor dividida en varias clases más pequeñas.

La elaboración de diagramas de comportamiento es un proceso iterativo. A medida que se desarrolla el sistema, se pueden identificar nuevas relaciones entre clases o necesidades adicionales para métodos y atributos. Es importante mantener los diagramas actualizados para reflejar la realidad del sistema en desarrollo.

En conclusión, los diagramas de comportamiento son una herramienta poderosa en el arsenal del programador orientado a objetos. Al proporcionar una visión clara y detallada de cómo interactúan las clases dentro de un sistema, estos gráficos facilitan la comprensión del diseño y ayudan a identificar problemas potenciales antes de que se conviertan en problemas reales durante el desarrollo.

<a id="generacion-automatica-de-codigo-ingenieria-inversa"></a>
## Generación automática de código. Ingeniería inversa

En el mundo digital de la programación, los diagramas de comportamiento son una herramienta esencial para visualizar cómo interactúan las clases dentro de un sistema. Estos gráficos nos permiten entender no solo las relaciones entre objetos, sino también cómo estos interactúan entre sí y cambian su estado a lo largo del tiempo.

Las clases son los bloques fundamentales en la programación orientada a objetos (POO). Cada clase define una entidad con sus propias características (atributos) y acciones posibles (métodos). La visibilidad de estos elementos es crucial, ya que determina quién puede acceder o modificarlos. Los atributos pueden ser públicos, privados o protegidos, mientras que los métodos también pueden tener modificadores de acceso para controlar su uso.

El primer paso en la elaboración de diagramas de comportamiento es identificar las clases relevantes y sus relaciones con otras clases. Cada clase se representa como un rectángulo dividido en tres partes: el nombre de la clase, los atributos y los métodos. Los atributos son listados en la parte superior del rectángulo, mientras que los métodos ocupan la parte inferior.

Los métodos pueden ser estáticos o no estáticos. Los métodos estáticos pertenecen a la clase en sí misma y se pueden llamar sin necesidad de crear una instancia de la clase. Por otro lado, los métodos no estáticos requieren una instancia de la clase para su ejecución.

La visibilidad de los atributos y métodos es controlada por modificadores como `public`, `private` y `protected`. Los atributos y métodos públicos son accesibles desde cualquier parte del programa. Los privados solo pueden ser accedidos dentro de la misma clase, mientras que los protegidos están disponibles tanto dentro de la clase como en las clases derivadas.

La interacción entre clases se representa mediante líneas que conectan los rectángulos correspondientes a las clases. Estas líneas pueden tener diferentes estilos y direcciones para indicar el tipo de relación y la dirección del flujo de datos o control.

Los diagramas de comportamiento no solo ayudan a visualizar cómo interactúan las clases, sino también a identificar posibles problemas de diseño y arquitectura. Por ejemplo, si una clase tiene demasiados métodos públicos, puede indicar que la clase está haciendo demasiado trabajo y podría ser mejor dividida en varias clases más pequeñas.

La elaboración de diagramas de comportamiento es un proceso iterativo. A medida que se desarrolla el sistema, se pueden identificar nuevas relaciones entre clases o necesidades adicionales para métodos y atributos. Es importante mantener los diagramas actualizados para reflejar la realidad del sistema en desarrollo.

En conclusión, los diagramas de comportamiento son una herramienta poderosa en el arsenal del programador orientado a objetos. Al proporcionar una visión clara y detallada de cómo interactúan las clases dentro de un sistema, estos gráficos facilitan la comprensión del diseño y ayudan a identificar problemas potenciales antes de que se conviertan en problemas reales durante el desarrollo.


<a id="elaboracion-de-diagramas-de-comportamiento"></a>
# Elaboración de diagramas de comportamiento

<a id="clases-atributos-metodos-y-visibilidad-1"></a>
## Clases. Atributos, métodos y visibilidad

En el mundo digital de la programación, los diagramas de comportamiento son una herramienta esencial para visualizar cómo interactúan las clases dentro de un sistema. Estos gráficos nos permiten entender no solo las relaciones entre objetos, sino también cómo estos interactúan entre sí y cambian su estado a lo largo del tiempo.

Las clases son los bloques fundamentales en la programación orientada a objetos (POO). Cada clase define una entidad con sus propias características (atributos) y acciones posibles (métodos). La visibilidad de estos elementos es crucial, ya que determina quién puede acceder o modificarlos. Los atributos pueden ser públicos, privados o protegidos, mientras que los métodos también pueden tener modificadores de acceso para controlar su uso.

El primer paso en la elaboración de diagramas de comportamiento es identificar las clases relevantes y sus relaciones con otras clases. Cada clase se representa como un rectángulo dividido en tres partes: el nombre de la clase, los atributos y los métodos. Los atributos son listados en la parte superior del rectángulo, mientras que los métodos ocupan la parte inferior.

Los métodos pueden ser estáticos o no estáticos. Los métodos estáticos pertenecen a la clase en sí misma y se pueden llamar sin necesidad de crear una instancia de la clase. Por otro lado, los métodos no estáticos requieren una instancia de la clase para su ejecución.

La visibilidad de los atributos y métodos es controlada por modificadores como `public`, `private` y `protected`. Los atributos y métodos públicos son accesibles desde cualquier parte del programa. Los privados solo pueden ser accedidos dentro de la misma clase, mientras que los protegidos están disponibles tanto dentro de la clase como en las clases derivadas.

La interacción entre clases se representa mediante líneas que conectan los rectángulos correspondientes a las clases. Estas líneas pueden tener diferentes estilos y direcciones para indicar el tipo de relación y la dirección del flujo de datos o control.

Los diagramas de comportamiento no solo ayudan a visualizar cómo interactúan las clases, sino también a identificar posibles problemas de diseño y arquitectura. Por ejemplo, si una clase tiene demasiados métodos públicos, puede indicar que la clase está haciendo demasiado trabajo y podría ser mejor dividida en varias clases más pequeñas.

La elaboración de diagramas de comportamiento es un proceso iterativo. A medida que se desarrolla el sistema, se pueden identificar nuevas relaciones entre clases o necesidades adicionales para métodos y atributos. Es importante mantener los diagramas actualizados para reflejar la realidad del sistema en desarrollo.

En conclusión, los diagramas de comportamiento son una herramienta poderosa en el arsenal del programador orientado a objetos. Al proporcionar una visión clara y detallada de cómo interactúan las clases dentro de un sistema, estos gráficos facilitan la comprensión del diseño y ayudan a identificar problemas potenciales antes de que se conviertan en problemas reales durante el desarrollo.

<a id="objetos-instanciacion-1"></a>
## Objetos. Instanciación

En el mundo digital de la programación, los objetos son una construcción fundamental que nos permiten modelar y representar entidades del mundo real dentro de nuestros programas. Cada objeto es una instancia concreta de una clase, que define su estructura y comportamiento. La instanciación es el proceso mediante el cual creamos un objeto a partir de una clase, asignándole valores específicos a sus atributos y preparándolo para interactuar con otros objetos.

La creación de objetos implica la definición de propiedades y métodos que los caracterizan. Las propiedades son las características del objeto, como su nombre o edad, mientras que los métodos son las acciones que puede realizar, como caminar o comer. Al instanciar un objeto, asignamos valores a estas propiedades y podemos llamar a sus métodos para ejecutar acciones específicas.

La importancia de la instanciación radica en que nos permite trabajar con entidades individuales dentro de nuestro programa. Cada objeto es una entidad única con su propio estado y comportamiento, lo que nos permite modelar situaciones complejas y realistas. Por ejemplo, si estamos desarrollando un juego, podríamos tener objetos para representar a los personajes, las armas y los enemigos.

La instanciación también es crucial para la programación orientada a objetos (POO), que es una de las paradigmas más utilizados en el desarrollo moderno. En POO, todo lo que interactúa con nuestro programa son objetos, y cada objeto tiene su propio comportamiento definido por su clase. La instanciación nos permite crear múltiples copias de un mismo objeto, cada una con sus propios valores, lo que facilita la creación de aplicaciones escalables y modulares.

Además, la instanciación es fundamental para el concepto de herencia en POO. Al instanciar objetos de clases derivadas, estamos aprovechando las características comunes definidas en su clase base, pero también podemos agregar nuevas propiedades y métodos específicos a cada objeto. Esto nos permite crear jerarquías de objetos complejas que se relacionan entre sí de formas únicas.

La instanciación también es esencial para el manejo de eventos en aplicaciones gráficas. Cada componente visual, como un botón o una caja de texto, es un objeto que puede responder a diferentes eventos, como hacer clic o cambiar su contenido. Al instanciar estos objetos y asociarles métodos específicos a los eventos, podemos crear interfaces interactivas y dinámicas.

La instanciación también juega un papel crucial en la gestión de recursos en aplicaciones móviles. Cada componente visual, como una imagen o un mapa, es un objeto que requiere memoria y procesamiento. Al instanciar estos objetos y gestionar adecuadamente sus ciclos de vida, podemos optimizar el uso de los recursos del dispositivo y mejorar la experiencia del usuario.

En resumen, la instanciación es un concepto fundamental en la programación orientada a objetos que nos permite crear entidades individuales con su propio estado y comportamiento. Este proceso es esencial para modelar situaciones complejas, manejar eventos interactivos y optimizar el uso de recursos en aplicaciones modernas. Al dominar la instanciación, podemos crear programas más eficientes, escalables y capaces de representar entidades del mundo real de manera precisa y detallada.

<a id="relaciones-asociacion-navegabilidad-y-multiplicidad-herencia-composicion-agregacion-realizacion-y-dependencia-1"></a>
## Relaciones. Asociación, navegabilidad y multiplicidad. Herencia, composición, agregación. Realización y dependencia

En el vasto y complejo mundo de la programación, los diagramas de comportamiento desempeñan un papel crucial para modelar las interacciones entre objetos en una aplicación. Estos gráficos visuales nos permiten entender cómo se comunican los diferentes componentes del sistema, lo que es fundamental para el diseño y la implementación exitosa de programas informáticos.

La carpeta `003-Relaciones. Asociación, navegabilidad y multiplicidad. Herencia, composición, agregación. Realización y dependencia` nos lleva a explorar en profundidad los diversos tipos de relaciones que pueden existir entre objetos en un sistema. Comenzamos por la asociación, una relación fundamental donde dos o más objetos están relacionados entre sí mediante atributos que hacen referencia a otros objetos.

La navegabilidad es otro concepto importante que se asocia con las relaciones. Indica si podemos seguir el flujo de información desde un objeto hacia otro en ambas direcciones. Por ejemplo, en una relación de "libro" y "autor", la navegabilidad nos permite movernos tanto del libro al autor como del autor al libro.

La multiplicidad es otra característica crucial que define cuántos objetos pueden estar involucrados en una relación. Puede ser uno a uno, uno a muchos o muchos a muchos, lo que influye significativamente en cómo se manejan los datos y las operaciones entre los objetos.

Además de la asociación, la carpeta también aborda otros tipos de relaciones más complejas como la herencia, composición, agregación y realización. La herencia permite crear una jerarquía de clases donde una clase puede derivarse de otra, reutilizando código y añadiendo nuevas funcionalidades.

La composición es un tipo de relación en la que un objeto contiene otros objetos como parte integral de su estructura. Por ejemplo, un coche está compuesto por varios componentes como el motor, las ruedas y los faros. La eliminación del objeto principal (el coche) también elimina automáticamente sus componentes.

La agregación es similar a la composición pero permite una mayor flexibilidad. En una relación de agregación, un objeto puede contener otros objetos que pueden existir independientemente del objeto principal. Por ejemplo, un proyecto puede estar compuesto por varias tareas, pero las tareas pueden existir incluso si el proyecto no existe.

La realización y la dependencia son relaciones más abstractas que se utilizan para modelar la interacción entre clases en sistemas orientados a objetos. La realización indica que una clase es una implementación de una interfaz o contrato, mientras que la dependencia representa una relación temporal donde un objeto necesita otro para funcionar.

Estos conceptos forman el lenguaje básico para describir cómo los objetos interactúan entre sí en un sistema. Al dominarlos, podemos crear diagramas de comportamiento precisos y detallados que nos ayuden a diseñar sistemas complejos y eficientes. Estos gráficos no solo facilitan la comunicación entre desarrolladores sino que también son esenciales para el mantenimiento y evolución del código en el futuro.

La comprensión profunda de las relaciones entre objetos es un paso crucial hacia la creación de aplicaciones robustas y escalables. Al aprender a modelar estas interacciones con precisión, podemos construir sistemas que sean fáciles de entender, mantener y mejorar.

<a id="notacion-de-los-diagramas-de-clases-1"></a>
## Notación de los diagramas de clases

La notación de los diagramas de clases es un elemento fundamental para representar la estructura y el comportamiento de los sistemas orientados a objetos. Este sistema visual permite codificar información sobre las clases, sus atributos y métodos en una forma gráfica que es fácil de entender y comunicar entre desarrolladores. En esta subunidad, exploraremos en profundidad cómo se representa la notación UML (Unified Modeling Language) para diagramas de clases, destacando su utilidad y aplicabilidad en el diseño de software.

La notación UML para los diagramas de clases utiliza símbolos estándar para representar las clases, sus atributos y métodos. Una clase se representa como un rectángulo dividido en tres partes: la parte superior contiene el nombre de la clase, la parte central lista los atributos y la parte inferior muestra los métodos. Los atributos y métodos pueden ser públicos, privados o protegidos, lo que se indica mediante símbolos específicos.

Los atributos son variables que representan las características de una instancia de la clase, mientras que los métodos son funciones que definen el comportamiento de dichas instancias. La notación UML permite especificar el tipo de dato del atributo y el tipo de retorno del método, así como su visibilidad.

Además de las clases, los diagramas de clases pueden incluir relaciones entre ellas, que representan la interacción y la dependencia entre diferentes objetos. Las relaciones más comunes son asociaciones, generalizaciones y dependencias. Una asociación indica una relación bidireccional entre dos clases, mientras que una generalización representa una herencia entre una superclase y sus subclases. Las dependencias muestran una relación de uso entre dos clases, donde una clase necesita la otra para funcionar.

La notación UML también permite representar detalles adicionales sobre las clases y relaciones, como la multiplicidad (el número de instancias que pueden existir en cada lado de la relación), los roles de los elementos involucrados y las condiciones bajo las cuales se establecen las relaciones. Estos detalles proporcionan una visión más precisa del comportamiento del sistema y facilitan el análisis y la documentación.

La utilización de diagramas de clases no solo mejora la comprensión del diseño del software, sino que también facilita la comunicación entre los miembros del equipo y sirve como base para la implementación del código. Al permitir una representación visual del sistema, estos diagramas ayudan a identificar problemas potenciales en el diseño temprano en el ciclo de desarrollo, lo que puede ahorrar tiempo y recursos en etapas posteriores.

En resumen, la notación de los diagramas de clases es un poderoso herramienta para el diseño y documentación del software orientado a objetos. Su uso adecuado permite representar de manera clara y concisa la estructura y comportamiento de los sistemas, facilitando tanto su comprensión como su implementación. A través de esta subunidad, hemos explorado cómo se codifica esta notación en el sistema UML y cómo puede ser aplicada en prácticas de desarrollo para mejorar la eficiencia y calidad del software.

<a id="herramientas-1"></a>
## Herramientas

En el mundo de la programación, los diagramas de comportamiento son una herramienta poderosa para visualizar cómo interactúan los objetos dentro de un sistema. Estos gráficos proporcionan una visión detallada del flujo de control y las acciones que realizan los componentes del software a lo largo del tiempo. En esta subunidad, exploraremos las principales herramientas disponibles para el desarrollo de diagramas de comportamiento, cada una con sus propias características y ventajas.

La primera herramienta que merece mencionar es UML (Unified Modeling Language), un estándar ampliamente reconocido en la industria. UML ofrece una serie de tipos de diagramas de comportamiento, incluyendo secuencias, colaboraciones, estados y actividades. Estos diagramas permiten representar el flujo de mensajes entre los objetos, mostrando cómo interactúan entre sí y qué acciones realizan durante este proceso.

Otra herramienta destacada es Lucidchart, una plataforma en línea que facilita la creación y edición de diagramas de comportamiento. Lucidchart cuenta con una interfaz intuitiva y una amplia gama de plantillas predefinidas, lo que permite a los desarrolladores crear diagramas profesionales rápidamente. Además, su capacidad para compartir y colaborar en tiempo real hace que sea una opción ideal para equipos de desarrollo distribuidos.

Para aquellos que prefieren herramientas más específicas para el análisis de sistemas empresariales, existen opciones como ArchiMate. Este lenguaje de modelado visual permite crear diagramas de comportamiento que reflejan la arquitectura general del sistema, incluyendo componentes, relaciones y flujos de trabajo. La ventaja de ArchiMate radica en su capacidad para representar no solo el comportamiento actual del sistema, sino también sus futuras evoluciones.

No podemos olvidar las herramientas gráficas propias de los IDEs (Integrated Development Environments), como Visual Studio o IntelliJ IDEA. Estos entornos integrales ofrecen funcionalidades avanzadas para la creación y edición de diagramas de comportamiento, incluyendo soporte para UML y otras especificaciones de modelado. La ventaja de usar herramientas integradas radica en su capacidad para mantener el código fuente y los diagramas de comportamiento en sincronía, facilitando así el mantenimiento del proyecto.

Además de las herramientas gráficas, existen opciones basadas en texto que permiten la creación de diagramas de comportamiento mediante lenguajes específicos. Por ejemplo, PlantUML es una herramienta popular que permite generar diagramas UML a partir de código fuente escrito en un lenguaje específico. La ventaja de esta opción radica en su capacidad para automatizar el proceso de generación de diagramas y facilitar la colaboración entre equipos.

La elección de la herramienta adecuada depende del contexto específico del proyecto, las preferencias personales del equipo y los requisitos técnicos del sistema. Cada herramienta tiene sus fortalezas y debilidades, por lo que es importante realizar una evaluación cuidadosa antes de decidir cuál utilizar.

En conclusión, el desarrollo de diagramas de comportamiento es un proceso fundamental en la ingeniería de software, permitiendo a los desarrolladores visualizar y comprender el funcionamiento del sistema. Las herramientas disponibles ofrecen diferentes niveles de complejidad y funcionalidades, cada una con sus propias ventajas. Al seleccionar la herramienta adecuada, se puede mejorar significativamente la eficiencia y calidad del proceso de desarrollo, facilitando así la creación de sistemas robustos y funcionales.

<a id="generacion-automatica-de-codigo-ingenieria-inversa-1"></a>
## Generación automática de código. Ingeniería inversa

En el mundo digital de la programación, los diagramas de comportamiento son una herramienta esencial para visualizar y documentar las interacciones entre componentes de un sistema. En esta subunidad didáctica, nos adentramos en el fascinante proceso de generación automática de código a partir de estos diagramas, una técnica que revoluciona la forma en que desarrollamos software.

El concepto de ingeniería inversa es uno de los pilares fundamentales para esta práctica. Consiste en crear un programa informático a partir de su descripción en términos de comportamiento, lo cual puede ser especialmente útil cuando se dispone de código fuente existente pero no se tiene acceso al código fuente original o cuando se desea mejorar la calidad del código existente.

La generación automática de código es una técnica que permite convertir diagramas de comportamiento en código ejecutable. Esta herramienta es particularmente valiosa para desarrolladores que trabajan con lenguajes de programación orientados a objetos, ya que facilita la creación y mantenimiento de clases y métodos.

En esta subunidad, exploraremos cómo los diagramas de comportamiento pueden ser utilizados no solo como una forma de comunicación entre desarrolladores, sino también como un medio para automatizar el proceso de desarrollo. A través del uso de herramientas especializadas, es posible convertir diagramas de comportamiento en código fuente funcional, lo que puede ahorrar tiempo y reducir errores humanos.

Además, aprender a utilizar la ingeniería inversa nos permite entender mejor cómo funcionan los sistemas existentes, lo cual es crucial para el desarrollo de nuevas funcionalidades o la mejora de sistemas preexistentes. Esta técnica no solo facilita la adaptación de software a nuevas necesidades, sino que también puede mejorar la eficiencia y la calidad del código.

La generación automática de código a partir de diagramas de comportamiento es una práctica que requiere un buen entendimiento tanto de los lenguajes de programación como de las técnicas de diseño orientado a objetos. A través de este proceso, los desarrolladores pueden crear sistemas más robustos y eficientes, reduciendo el tiempo necesario para la implementación y aumentando la calidad final del producto.

En conclusión, la generación automática de código a partir de diagramas de comportamiento es una técnica poderosa que revoluciona la forma en que desarrollamos software. A través de la ingeniería inversa, podemos convertir descripciones abstractas de sistemas en código funcional, lo cual puede ahorrar tiempo y mejorar la calidad del producto final. Esta práctica es especialmente valiosa para desarrolladores que trabajan con lenguajes orientados a objetos y que buscan mejorar la eficiencia y robustez de sus proyectos.


<a id="programacion-en-entorno-servidor"></a>
# Programacion en entorno servidor

<a id="php"></a>
## PHP

### Entorno de ejecucion

```markdown
Si estáis en Windows, la forma más fácil es instalar XAMPP
Una vez instalado, TODOS los script PHP tienen que ir dentro de:
C:/XAMPP/htdocs (y podéis crear subcarpetas)

Si estáis en Linux:

sudo apt install apache2
sudo apt install php

La carpeta de publicación es /var/www/html

Y LUEGO:
La ruta de acceso es:

Si vuestro archivo está en:C:/xampp/htdocs/hola/1.php
En el navegador http://localhost/hola/1.php

Si vuestro archivo está en:C:/xampp/htdocs/otro/hola.php
En el navegador http://localhost/otro/hola.php
```

### hola mundo

```
hola mundo desde PHP
```

### abrimos bloque

```
Esto es HTML
<?php
  // Pero esto es PHP
?>
Esto es HTML
```

### comentarios de una linea

```
<?php
  // Esto es un comentario de una linea
  // Y esto es otro comentario
?>
```

### comentarios multilinea

```
<?php
  /*
    Esto es un comentario
    Y esto es otro comentario
    Y esto es otro comentario más
  */
?>
```

### salidas con echo

```
<?php
  echo "Esto es HTML desde PHP";
?>
```

### print

```
<?php
  print "Esto es HTML desde PHP";
?>
```

### variable

```
<?php
  $nombre = "Jose Vicente";
  echo $nombre;
?>
```

### operadores aritmeticos

```
<?php
  echo 4+3;
  echo "<br>";
  echo 4-3;
  echo "<br>";
  echo 4*3;
  echo "<br>";
  echo 4/3;
  echo "<br>";
  echo 4%3; 
?>
```

### operadores de comparacion

```
<?php
  echo 4 < 3;
  echo "<br>";
  echo 4 <= 3;
  echo "<br>";
  echo 4 > 3;
  echo "<br>";
  echo 4 >= 3;
  echo "<br>";
  echo 4 == 3;
  echo "<br>";
  echo 4 != 3;
  echo "<br>";
?>
```

### operadores booleanos

```
<?php
  echo 4 == 4 && 3 == 3 && 2 == 2; 
  echo "<br>";
  echo 4 == 4 && 3 == 3 && 2 == 1; 
  echo "<br>";
  
  echo 4 == 4 || 3 == 3 || 2 == 2; 
  echo "<br>";
  echo 4 == 4 || 3 == 3 || 2 == 1; 
  echo "<br>";
  echo 4 == 4 || 3 == 2 || 2 == 1; 
  echo "<br>";
  echo 4 == 3 || 3 == 2 || 2 == 1; 
  echo "<br>";
?>
```

### operadores aritmeticos abreviados

```
<?php
  $edad = 47;
  echo $edad."<br>";
  $edad = $edad + 5; // No abreviado
  echo $edad."<br>";
  $edad += 5; // Si abreviado
  echo $edad."<br>";
  $edad -= 5; // Si abreviado
  echo $edad."<br>";
  $edad *= 5; // Si abreviado
  echo $edad."<br>";
  $edad /= 5; // Si abreviado
  echo $edad."<br>";
?>
```

### operadores de incremento

```
<?php
  $edad = 47;
  echo $edad."<br>";
  $edad++;
  echo $edad."<br>";
  $edad--;
  echo $edad."<br>";
?>
```

### estructura for

```
<?php
  for($dia = 1;$dia<31;$dia++){
    echo "Hoy es el dia ".$dia." del mes<br>";
  }
?>
```

### for con estructura y estilo

```
<!doctype html>
<html>
  <head>
  </head>
  <body>
    <?php
      for($dia = 1;$dia<31;$dia++){
        echo "<div>".$dia."</div>
        ";
      }
    ?>
  </body>
</html>
```

### ahora le pongo estilo

```
<!doctype html>
<html>
  <head>
    <style>
      body{
        display:grid;
        grid-template-columns:repeat(7,50px);
      }
      div{
        width:40px;
        height:40px;
        border:1px solid grey;
        padding:5px;
      }
    </style>
  </head>
  <body>
    <?php
      for($dia = 1;$dia<31;$dia++){
        echo "<div>".$dia."</div>
        ";
      }
    ?>
  </body>
</html>
```

### while

```
<?php
  while($dia < 31){
    echo "Hoy es el dia ".$dia." del mes <br>";
  }
?>
```

### declarar la variable antes de entrar en el while

```
<?php
  $dia = 1;
  while($dia < 31){
    echo "Hoy es el dia ".$dia." del mes <br>";
  }
?>
```

### incremento dentro del bucle

```
<?php
  $dia = 1;
  while($dia < 31){
    echo "Hoy es el dia ".$dia." del mes <br>";
    $dia++;
  }
?>
```

### if

```
<?php
  $edad = 47;
  if($edad < 30){
    echo "Eres un joven";
  }
?>
```

### else

```
<?php
  $edad = 47;
  if($edad < 30){
    echo "Eres un joven";
  }else{
    echo "Ya no eres un joven";
  }
?>
```

### case else if

```
<?php
  $edad = 47;
  if($edad < 10){
    echo "Eres un niño";
  }else if($edad >= 10 && $edad < 20){
    echo "Eres un adolescente";
  }else if($edad >= 20 && $edad < 30){
    echo "Eres un joven";
  }else{
    echo "Ya no eres un joven";
  }
?>
```

### switch

```
<?php
  $dia = "lunes";
  switch($dia){
    case "lunes":
      echo "Hoy es el peor día de la semana";
      break;
    case "martes":
      echo "Hoy es el segundo peor día de la semana";
      break;
    case "miercoles":
      echo "Ya estamos a mitad de semana";
      break;
    case "jueves":
      echo "Ya casi es fin de semana";
      break;
    case "viernes":
      echo "Ya es viernes";
      break;
    case "sabado":
      echo "Hoy es el mejor día de la semana";
      break;
    case "domingo":
      echo "Hoy es el segundo mejor día de la semana";
      break;
    
  }
?>
```

### funcion

```
<?php
  function diHola(){
    echo "Hola";
  }
?>
```

### llamada a la funcion

```
<?php
  function diHola(){
    echo "Hola";
  }
  diHola();
?>
```

### personalizacion con parametros

```
<?php
  function diHola($nombre){
    echo "Hola, ".$nombre;
  }
  diHola("Jose Vicente");
  diHola("Juan");
?>
```

### tantos parametros como sea necesario

```
<?php
  function diHola($nombre,$edad){
    echo "Hola, ".$nombre." y tienes ".$edad." años";
  }
  diHola("Jose Vicente",47);
  echo "<br>";
  diHola("Juan",56);
?>
```

### salida con return

```
<?php
  function diHola($nombre,$edad){
    return "Hola, ".$nombre." y tienes ".$edad." años";
  }
  echo diHola("Jose Vicente",47);
  echo "<br>"; // Punto y aparte bar return
  echo diHola("Juan",56);
?>
```

### arrays

```
<?php
  $agenda = [];
  $agenda[0] = "Juan";
  $agenda[1] = "Jorge";
  echo $agenda;
?>
```

### vomitamos arrays

```
<?php
  $agenda = [];
  $agenda[0] = "Juan";
  $agenda[1] = "Jorge";
  var_dump($agenda);
?>
```

### creacion de una clase

```
<?php
  class Gato{
    
  }
?>
```

### creamos propiedades

```
<?php
  class Gato{
    $this->color;
  }
?>
```

### creamos un constructor

```
<?php
  class Gato{
    function constructor(){
      $this->color;
      $this->edad;
    }
  }
?>
```

### creamos dos gatos

```
<?php
  class Gato{
    function constructor(){
      $this->color;
      $this->edad;
    }
  }
  
  $gato1 = new Gato();
  $gato2 = new Gato();
  
  var_dump($gato1);
?>
```

### lectura y escritura

```
<?php
  class Gato{
    function constructor(){
      $this->color;
      $this->edad;
    }
  }
  
  $gato1 = new Gato();
  $gato2 = new Gato();
  
  var_dump($gato1);
  
  $gato1->color = "blanco";
  $gato1->edad = 0;
  
  echo $gato1->color;
  echo $gato1->edad;
?>
```

### propiedades privadas

```
<?php
  class Gato{
    private $color;
    private $edad;
    
    public function constructor(){
      $this->color;
      $this->edad;
    }
  }
  
  $gato1 = new Gato();
  $gato2 = new Gato();
  
  var_dump($gato1);
  
  $gato1->color = "blanco";
  $gato1->edad = 0;
  
  echo $gato1->color;
  echo $gato1->edad;
?>
```

### metodos set y get

```
<?php
  class Gato{
    private $color;
    private $edad;
    
    public function constructor(){
      $this->color;
      $this->edad;
    }
    public function setEdad($nuevaedad){
      $this->edad = $nuevaedad;
    }
    public function setColor($nuevocolor){
      $this->color = $nuevocolor;
    }
    public function getEdad(){
      return $this->edad;
    }
    public function getColor(){
      return $this->color;
    }
  }
  
  $gato1 = new Gato();
  $gato2 = new Gato();
  
  
  $gato1->setColor("blanco");
  $gato1->setEdad(0);
  
  echo $gato1->getColor();
  echo $gato1->getEdad();
?>
```

### constructor con parametros

```
<?php
  class Gato{
    private $color;
    private $edad;
    
    public function __construct($color,$edad){
      $this->color = $color;
      $this->edad = $edad;
    }
    public function setEdad($nuevaedad){
      $this->edad = $nuevaedad;
    }
    public function setColor($nuevocolor){
      $this->color = $nuevocolor;
    }
    public function getEdad(){
      return $this->edad;
    }
    public function getColor(){
      return $this->color;
    }
  }
  
  $gato1 = new Gato("blanco",0);
  
  
  echo $gato1->getColor();
  echo $gato1->getEdad();
?>
```

<a id="conexion-a-mysql-desde-php"></a>
## Conexion a MySQL desde PHP

### conecto a la base de datos

```
<?php
// Me conecto a la base de datos
$mysqli = new mysqli("localhost", "blog2526", "blog2526", "blog2526");

// Ahora le pido algo a las entradas
$sql = "SELECT * FROM entradas";
$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc()) {
    var_dump($row);
    echo "<br>";
}
```

### formateo algo mejor

```
<?php
// Me conecto a la base de datos
$mysqli = new mysqli("localhost", "blog2526", "blog2526", "blog2526");

// Ahora le pido algo a las entradas
$sql = "SELECT * FROM entradas";
$resultado = $mysqli->query($sql);

while ($fila = $resultado->fetch_assoc()) {
    echo '
      <article>
        <h3>'.$fila['titulo'].'</h3>
        <time>'.$fila['fecha'].'</time>
        <p>'.$fila['autor'].'</p>
        <p>'.$fila['contenido'].'</p>
      </article>
    ';
}
```

### rodeo al blog de html

```
<!doctype html>
  <html>
  <head>
  </head>
  <body>
    <header>
      <h1>El blog de Jose Vicente</h1>
    </header>
    <main>
      <?php
      // Me conecto a la base de datos
      $mysqli = new mysqli("localhost", "blog2526", "blog2526", "blog2526");

      // Ahora le pido algo a las entradas
      $sql = "SELECT * FROM entradas";
      $resultado = $mysqli->query($sql);

      while ($fila = $resultado->fetch_assoc()) {
          echo '
            <article>
              <h3>'.$fila['titulo'].'</h3>
              <time>'.$fila['fecha'].'</time>
              <p>'.$fila['autor'].'</p>
              <p>'.$fila['contenido'].'</p>
            </article>
          ';
      }
      ?>
    </main>
    <footer>
      (c) 2025 Jose Vicente Carratala
    </footer>
  </body>
</html>
```

### un poco de estilo

```
<!doctype html>
  <html>
  <head>
    <style>
      body{background:indigo;font-family:sans-serif;}
      header,main,footer{background:white;padding:20px;margin:auto;width:600px;}
      header,footer{text-align:center;}
      article{border-bottom:1px solid indigo;}
    </style>
  </head>
  <body>
    <header>
      <h1>El blog de Jose Vicente</h1>
    </header>
    <main>
      <?php
        // Me conecto a la base de datos
        $mysqli = new mysqli("localhost", "blog2526", "blog2526", "blog2526");

        // Ahora le pido algo a las entradas
        $sql = "SELECT * FROM entradas";
        $resultado = $mysqli->query($sql);

        while ($fila = $resultado->fetch_assoc()) {
            echo '
              <article>
                <h3>'.$fila['titulo'].'</h3>
                <time>'.$fila['fecha'].'</time>
                <p>'.$fila['autor'].'</p>
                <p>'.$fila['contenido'].'</p>
              </article>
            ';
        }
      ?>
    </main>
    <footer>
      (c) 2025 Jose Vicente Carratala
    </footer>
  </body>
</html>
```

### panel de control con PHP

```
<!doctype html>
  <html>
  <head>
    <style>
      html,body{width:100%;height:100%;padding:0px;margin:0px;}
     body{display:flex;}
      nav{flex:1;background:indigo;color:white;padding:20px;}
      main{flex:5;background:aliceblue;padding:20px;}
    </style>
  </head>
  <body>
    <nav>
      menu
    </nav>
    <main>
      contenido
    </main>
  </body>
</html>
```

### pongo los botones

```
<!doctype html>
  <html>
  <head>
    <style>
      html,body{width:100%;height:100%;padding:0px;margin:0px;}
     body{display:flex;}
      nav{flex:1;background:indigo;color:white;padding:20px;}
      main{flex:5;background:aliceblue;padding:20px;}
    </style>
  </head>
  <body>
    <nav>
      <?php
        $mysqli = new mysqli("localhost", "miempresa", "miempresa", "miempresa");
        $sql = "SHOW TABLES";
        $resultado = $mysqli->query($sql);
        while ($fila = $resultado->fetch_assoc()) {
            echo '<button> '.$fila['Tables_in_miempresa'].'</button>';
        }
      ?>
    </nav>
    <main>
      contenido
    </main>
  </body>
</html>
```

### un poco de estilo para el menu

```
<!doctype html>
  <html>
  <head>
    <style>
      html,body{width:100%;height:100%;padding:0px;margin:0px;}
     body{display:flex;}
      nav{flex:1;background:indigo;color:white;padding:20px;display:flex;flex-direction:column;gap:20px;}
      main{flex:5;background:aliceblue;padding:20px;}
      nav button{border:none;background:white;padding:20px;}
    </style>
  </head>
  <body>
    <nav>
      <?php
        $mysqli = new mysqli("localhost", "miempresa", "miempresa", "miempresa");
        $sql = "SHOW TABLES";
        $resultado = $mysqli->query($sql);
        while ($fila = $resultado->fetch_assoc()) {
            echo '<button> '.$fila['Tables_in_miempresa'].'</button>';
        }
      ?>
    </nav>
    <main>
      contenido
    </main>
  </body>
</html>
```

### creo una tabla

```
<!doctype html>
  <html>
  <head>
    <style>
      html,body{width:100%;height:100%;padding:0px;margin:0px;}
     body{display:flex;}
      nav{flex:1;background:indigo;color:white;padding:20px;display:flex;flex-direction:column;gap:20px;}
      main{flex:5;background:aliceblue;padding:20px;}
      nav button{border:none;background:white;padding:20px;}
    </style>
  </head>
  <body>
    <nav>
      <?php
        $mysqli = new mysqli("localhost", "miempresa", "miempresa", "miempresa");
        $sql = "SHOW TABLES";
        $resultado = $mysqli->query($sql);
        while ($fila = $resultado->fetch_assoc()) {
            echo '<button> '.$fila['Tables_in_miempresa'].'</button>';
        }
      ?>
    </nav>
    <main>
      <table>
        <?php
          $mysqli = new mysqli("localhost", "miempresa", "miempresa", "miempresa");
          $sql = "SELECT * FROM clientes;";
          $resultado = $mysqli->query($sql);
          while ($fila = $resultado->fetch_assoc()) {
              echo "<tr>";
              foreach($fila as $clave=>$valor){
                echo "<td>".$valor."</td>";
              }
              echo "</tr>";
          }
        ?>
      </table>
    </main>
  </body>
</html>
```

### estilo de la tabla

```
<!doctype html>
  <html>
  <head>
    <style>
      html,body{width:100%;height:100%;padding:0px;margin:0px;font-family:sans-serif;}
     body{display:flex;}
      nav{flex:1;background:indigo;color:white;padding:20px;display:flex;flex-direction:column;gap:20px;}
      main{flex:5;background:aliceblue;padding:20px;}
      nav button{border:none;background:white;padding:20px;}
      table{width:100%;border:3px solid indigo;}
      table tr td{padding:10px;}
    </style>
  </head>
  <body>
    <nav>
      <?php
        $mysqli = new mysqli("localhost", "miempresa", "miempresa", "miempresa");
        $sql = "SHOW TABLES";
        $resultado = $mysqli->query($sql);
        while ($fila = $resultado->fetch_assoc()) {
            echo '<button> '.$fila['Tables_in_miempresa'].'</button>';
        }
      ?>
    </nav>
    <main>
      <table>
        <?php
          $mysqli = new mysqli("localhost", "miempresa", "miempresa", "miempresa");
          $sql = "SELECT * FROM clientes;";
          $resultado = $mysqli->query($sql);
          while ($fila = $resultado->fetch_assoc()) {
              echo "<tr>";
              foreach($fila as $clave=>$valor){
                echo "<td>".$valor."</td>";
              }
              echo "</tr>";
          }
        ?>
      </table>
    </main>
  </body>
</html>
```

### muestro las cabeceras de las tablas

```
<!doctype html>
  <html>
  <head>
    <style>
      html,body{width:100%;height:100%;padding:0px;margin:0px;font-family:sans-serif;}
     body{display:flex;}
      nav{flex:1;background:indigo;color:white;padding:20px;display:flex;flex-direction:column;gap:20px;}
      main{flex:5;background:aliceblue;padding:20px;}
      nav button{border:none;background:white;padding:20px;}
      table{width:100%;border:3px solid indigo;border-collapse:collapse;}
      table tr td{padding:10px;}
      table tr th{background:indigo;color:white;padding:10px;}
    </style>
  </head>
  <body>
    <nav>
      <?php
        $mysqli = new mysqli("localhost", "miempresa", "miempresa", "miempresa");
        $sql = "SHOW TABLES";
        $resultado = $mysqli->query($sql);
        while ($fila = $resultado->fetch_assoc()) {
            echo '<button> '.$fila['Tables_in_miempresa'].'</button>';
        }
      ?>
    </nav>
    <main>
      <table>
        <thead>
          <?php
            ///////////////////////// ESTO MUESTRA LAS CABECERAS
            $mysqli = new mysqli("localhost", "miempresa", "miempresa", "miempresa");
            $sql = "SELECT * FROM clientes LIMIT 1;";
            $resultado = $mysqli->query($sql);
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                foreach($fila as $clave=>$valor){
                  echo "<th>".$clave."</th>";
                }
                echo "</tr>";
            }
          ?>
          </thead>
          <tbody>
          <?php
            ///////////////////////// ESTO MUESTRA LOS DATOS
            $mysqli = new mysqli("localhost", "miempresa", "miempresa", "miempresa");
            $sql = "SELECT * FROM clientes;";
            $resultado = $mysqli->query($sql);
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                foreach($fila as $clave=>$valor){
                  echo "<td>".$valor."</td>";
                }
                echo "</tr>";
            }
          ?>
        </tbody>
      </table>
    </main>
  </body>
</html>
```

<a id="get-y-post-en-php"></a>
## get y post en PHP

### get

```
<?php

  // GET es una variable de URL
  echo $_GET['nombre'];

?>
```

### pasar varios parametros

```
<?php

  // GET es una variable de URL
  echo $_GET['nombre'];
  echo "<br>";
  echo $_GET['apellidos'];

?>
```

### metodo post

```
<form action="004-procesa.php" method="POST">
  <input type="text" name="nombre" placeholder="Introduce tu nombre">
  <input type="text" name="apellidos" placeholder="Introduce tus apellidos">
  <input type="submit">
</form>
```

### procesa

```
<?php
  echo "Tu nombre es: ".$_POST['nombre'];
  echo "<br>";
  echo "Tus apellidos son: ".$_POST['apellidos'];
?>
```

### continuamos con el panel de control

```
<!doctype html>
  <html>
  <head>
    <style>
      html,body{width:100%;height:100%;padding:0px;margin:0px;font-family:sans-serif;}
     body{display:flex;}
      nav{flex:1;background:indigo;color:white;padding:20px;display:flex;flex-direction:column;gap:20px;}
      main{flex:5;background:aliceblue;padding:20px;}
      nav a{border:none;background:white;padding:20px;}
      table{width:100%;border:3px solid indigo;border-collapse:collapse;}
      table tr td{padding:10px;}
      table tr th{background:indigo;color:white;padding:10px;}
    </style>
  </head>
  <body>
    <nav>
      <?php
        $mysqli = new mysqli("localhost", "miempresa", "miempresa", "miempresa");
        $sql = "SHOW TABLES";
        $resultado = $mysqli->query($sql);
        while ($fila = $resultado->fetch_assoc()) {
            // Fuerzo (truco) un parametro GET de url
            echo '<a href="?tabla='.$fila['Tables_in_miempresa'].'"> '.$fila['Tables_in_miempresa'].'</a>';
        }
      ?>
    </nav>
    <main>
      <table>
        <thead>
          <?php
            ///////////////////////// ESTO MUESTRA LAS CABECERAS
            $mysqli = new mysqli("localhost", "miempresa", "miempresa", "miempresa");
            $sql = "SELECT * FROM ".$_GET['tabla']." LIMIT 1;";
            $resultado = $mysqli->query($sql);
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                foreach($fila as $clave=>$valor){
                  echo "<th>".$clave."</th>";
                }
                echo "</tr>";
            }
          ?>
          </thead>
          <tbody>
          <?php
            ///////////////////////// ESTO MUESTRA LOS DATOS
            $mysqli = new mysqli("localhost", "miempresa", "miempresa", "miempresa");
            $sql = "SELECT * FROM ".$_GET['tabla'].";";
            $resultado = $mysqli->query($sql);
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                foreach($fila as $clave=>$valor){
                  echo "<td>".$valor."</td>";
                }
                echo "</tr>";
            }
          ?>
        </tbody>
      </table>
    </main>
  </body>
</html>
```

### ajustes esteticos

```
<!doctype html>
  <html>
  <head>
    <style>
      html,body{width:100%;height:100%;padding:0px;margin:0px;font-family:sans-serif;}
     body{display:flex;}
      nav{flex:1;background:indigo;color:white;padding:20px;display:flex;flex-direction:column;gap:20px;}
      main{flex:5;background:aliceblue;padding:20px;}
      nav a{border:none;background:white;padding:20px;text-decoration:none;color:indigo;text-transform:uppercase;font-weight:bold;border-radius:5px;}
      table{width:100%;border:3px solid indigo;border-collapse:collapse;border-radius:5px;}
      table tr td{padding:10px;}
      table tr th{background:indigo;color:white;padding:10px;}
      .redondeado {
            border: 3px solid indigo;
            border-radius: 5px;
            border-collapse: separate; /* important */
            overflow: hidden;          /* keeps corners clean */
        }
        table tr:nth-child(even){
          background:white;
        }

    </style>
  </head>
  <body>
    <nav>
      <?php
        $mysqli = new mysqli("localhost", "miempresa", "miempresa", "miempresa");
        $sql = "SHOW TABLES";
        $resultado = $mysqli->query($sql);
        while ($fila = $resultado->fetch_assoc()) {
            // Fuerzo (truco) un parametro GET de url
            echo '<a href="?tabla='.$fila['Tables_in_miempresa'].'"> '.$fila['Tables_in_miempresa'].'</a>';
        }
      ?>
    </nav>
    <main>
      <table class="redondeado">
        <thead>
          <?php
            ///////////////////////// ESTO MUESTRA LAS CABECERAS
            $mysqli = new mysqli("localhost", "miempresa", "miempresa", "miempresa");
            $sql = "SELECT * FROM ".$_GET['tabla']." LIMIT 1;";
            $resultado = $mysqli->query($sql);
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                foreach($fila as $clave=>$valor){
                  echo "<th>".$clave."</th>";
                }
                echo "</tr>";
            }
          ?>
          </thead>
          <tbody>
          <?php
            ///////////////////////// ESTO MUESTRA LOS DATOS
            $mysqli = new mysqli("localhost", "miempresa", "miempresa", "miempresa");
            $sql = "SELECT * FROM ".$_GET['tabla'].";";
            $resultado = $mysqli->query($sql);
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                foreach($fila as $clave=>$valor){
                  echo "<td>".$valor."</td>";
                }
                echo "</tr>";
            }
          ?>
        </tbody>
      </table>
    </main>
  </body>
</html>
```

### mas ajustes esteticos

```
<!doctype html>
  <html>
  <head>
    <style>
      html,body{width:100%;height:100%;padding:0px;margin:0px;font-family:sans-serif;}
     body{display:flex;}
      nav{flex:1;background:indigo;color:white;padding:20px;display:flex;flex-direction:column;gap:20px;}
      main{flex:5;background:aliceblue;padding:20px;}
      nav a{border:none;background:white;padding:20px;text-decoration:none;color:indigo;text-transform:uppercase;font-weight:bold;border-radius:5px;display:flex;align-items:center;gap:20px;}
      table{width:100%;border:3px solid indigo;border-collapse:collapse;border-radius:5px;}
      table tr td{padding:10px;}
      table tr th{background:indigo;color:white;padding:10px;}
      .redondeado {
            border: 3px solid indigo;
            border-radius: 5px;
            border-collapse: separate; /* important */
            overflow: hidden;          /* keeps corners clean */
        }
        table tr:nth-child(even){
          background:white;
        }
        .inicial{
          display:block;
          width:20px;
          height:20px;
          background:indigo;
          color:white;
          text-align:center;
          padding:10px;
          border-radius:5px;
          line-height:20px;
        }
        

    </style>
  </head>
  <body>
    <nav>
      <?php
        $mysqli = new mysqli("localhost", "miempresa", "miempresa", "miempresa");
        $sql = "SHOW TABLES";
        $resultado = $mysqli->query($sql);
        while ($fila = $resultado->fetch_assoc()) {
            // Fuerzo (truco) un parametro GET de url
            echo '<a href="?tabla='.$fila['Tables_in_miempresa'].'">
              <span class="inicial">'.$fila['Tables_in_miempresa'][0].'</span>
             '.$fila['Tables_in_miempresa'].'
             </a>';
        }
      ?>
    </nav>
    <main>
      <table class="redondeado">
        <thead>
          <?php
            ///////////////////////// ESTO MUESTRA LAS CABECERAS
            $mysqli = new mysqli("localhost", "miempresa", "miempresa", "miempresa");
            $sql = "SELECT * FROM ".$_GET['tabla']." LIMIT 1;";
            $resultado = $mysqli->query($sql);
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                foreach($fila as $clave=>$valor){
                  echo "<th>".$clave."</th>";
                }
                echo "</tr>";
            }
          ?>
          </thead>
          <tbody>
          <?php
            ///////////////////////// ESTO MUESTRA LOS DATOS
            $mysqli = new mysqli("localhost", "miempresa", "miempresa", "miempresa");
            $sql = "SELECT * FROM ".$_GET['tabla'].";";
            $resultado = $mysqli->query($sql);
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                foreach($fila as $clave=>$valor){
                  echo "<td>".$valor."</td>";
                }
                echo "</tr>";
            }
          ?>
        </tbody>
      </table>
    </main>
  </body>
</html>
```

<a id="recuperacion-de-emails-con-imap"></a>
## recuperacion de emails con imap

### Introduccion

```markdown
2 protocolos principales en lectura de correo electrónico

POP - POP3 - descarga de correos y borrado del servidor
IMAP - Lectura de correos y mantener en el servidor
```

### leercorreos

```
<?php
// ----------------------------------------------------
// CONFIGURACIÓN IMAP
// ----------------------------------------------------
$hostname = '{imap.ionos.es:993/imap/ssl}INBOX'; // Cambia esto si no usas Gmail
$username = 'python@jocarsa.com';
$password = 'TAME123$';

// ----------------------------------------------------
// FUNCIÓN: decodificar contenido según encoding IMAP
// ----------------------------------------------------
function decodePart($content, $encoding)
{
    switch ($encoding) {
        case 3: // BASE64
            return base64_decode($content);
        case 4: // QUOTED-PRINTABLE
            return quoted_printable_decode($content);
        default:
            return $content;
    }
}

// ----------------------------------------------------
// FUNCIÓN RECURSIVA: obtener la parte HTML (o texto)
// ----------------------------------------------------
function getHtmlBody($imap, $msgno)
{
    $structure = imap_fetchstructure($imap, $msgno);

    // Correo simple (sin multipart)
    if (!isset($structure->parts)) {
        $body = imap_body($imap, $msgno);
        $body = decodePart($body, $structure->encoding ?? 0);

        // Si el subtipo es HTML lo devolvemos tal cual
        if (isset($structure->subtype) && strtoupper($structure->subtype) === 'HTML') {
            return $body;
        }

        // Si es texto plano, lo convertimos a HTML básico
        return nl2br(htmlspecialchars($body, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
    }

    // Correo multipart: buscamos parte HTML
    $htmlBody = null;
    $textBody = null;

    foreach ($structure->parts as $index => $part) {
        $partNumber = $index + 1;

        // Si la parte tiene subpartes (multipart anidado)
        if (isset($part->parts)) {
            // Llamada recursiva: tratamos este subárbol como mensaje
            $subBody = getMultipartBody($imap, $msgno, $part, $partNumber);
            if ($subBody['html'] !== null && $htmlBody === null) {
                $htmlBody = $subBody['html'];
            }
            if ($subBody['text'] !== null && $textBody === null) {
                $textBody = $subBody['text'];
            }
            continue;
        }

        // Solo partes de tipo texto (type 0)
        if ($part->type == 0) {
            $content = imap_fetchbody($imap, $msgno, $partNumber);
            $content = decodePart($content, $part->encoding ?? 0);

            $subtype = isset($part->subtype) ? strtoupper($part->subtype) : '';

            if ($subtype === 'HTML') {
                if ($htmlBody === null) {
                    $htmlBody = $content;
                }
            } elseif ($subtype === 'PLAIN') {
                if ($textBody === null) {
                    $textBody = nl2br(htmlspecialchars($content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
                }
            }
        }
    }

    // Preferimos HTML; si no, texto plano
    if ($htmlBody !== null) {
        return $htmlBody;
    }
    if ($textBody !== null) {
        return $textBody;
    }

    return '<em>Sin contenido legible.</em>';
}

/**
 * Función auxiliar para recorrer partes multipart anidadas.
 */
function getMultipartBody($imap, $msgno, $structure, $prefix)
{
    $htmlBody = null;
    $textBody = null;

    foreach ($structure->parts as $index => $part) {
        $partNumber = $prefix . '.' . ($index + 1);

        if (isset($part->parts)) {
            $sub = getMultipartBody($imap, $msgno, $part, $partNumber);
            if ($sub['html'] !== null && $htmlBody === null) {
                $htmlBody = $sub['html'];
            }
            if ($sub['text'] !== null && $textBody === null) {
                $textBody = $sub['text'];
            }
            continue;
        }

        if ($part->type == 0) {
            $content = imap_fetchbody($imap, $msgno, $partNumber);
            $content = decodePart($content, $part->encoding ?? 0);
            $subtype = isset($part->subtype) ? strtoupper($part->subtype) : '';

            if ($subtype === 'HTML') {
                if ($htmlBody === null) {
                    $htmlBody = $content;
                }
            } elseif ($subtype === 'PLAIN') {
                if ($textBody === null) {
                    $textBody = nl2br(htmlspecialchars($content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
                }
            }
        }
    }

    return [
        'html' => $htmlBody,
        'text' => $textBody
    ];
}

// ----------------------------------------------------
// CONEXIÓN IMAP Y LECTURA DE CORREOS
// ----------------------------------------------------
$inbox = @imap_open($hostname, $username, $password);

if (!$inbox) {
    die('Error IMAP: ' . imap_last_error());
}

// Aquí puedes cambiar el criterio, por ejemplo: 'UNSEEN', 'FROM "alguien"', etc.
$emails = imap_search($inbox, 'ALL');

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de correos</title>
    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 1.5rem;
        }
        h1 {
            margin-bottom: 1rem;
        }
        article {
            background: #ffffff;
            border-radius: 8px;
            padding: 1rem 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        }
        article header {
            border-bottom: 1px solid #e0e0e0;
            margin-bottom: 0.75rem;
            padding-bottom: 0.5rem;
        }
        article h2 {
            margin: 0;
            font-size: 1rem;
        }
        .meta {
            font-size: 0.85rem;
            color: #666;
        }
        .email-body {
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <h1>Correos de la bandeja de entrada</h1>

    <?php
    if ($emails) {
        // Ordenar: más recientes primero
        rsort($emails);

        // Por ejemplo, mostrar solo los 20 primeros
        $emails = array_slice($emails, 0, 20);

        foreach ($emails as $email_number) {
            $overview = imap_fetch_overview($inbox, $email_number, 0)[0] ?? null;

            if (!$overview) {
                continue;
            }

            $subject = isset($overview->subject) ? imap_utf8($overview->subject) : '(Sin asunto)';
            $from    = isset($overview->from)    ? imap_utf8($overview->from)    : '(Desconocido)';
            $date    = isset($overview->date)    ? $overview->date                : '';

            // Sanitizar para HTML en cabeceras
            $subject_safe = htmlspecialchars($subject, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
            $from_safe    = htmlspecialchars($from,    ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
            $date_safe    = htmlspecialchars($date,    ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

            // Obtener cuerpo (HTML preferente)
            $bodyHtml = getHtmlBody($inbox, $email_number);
            ?>
            <article>
                <header>
                    <h2><?php echo $subject_safe; ?></h2>
                    <div class="meta">
                        De: <?php echo $from_safe; ?><br>
                        Fecha: <?php echo $date_safe; ?>
                    </div>
                </header>
                <div class="email-body">
                    <?php echo $bodyHtml; ?>
                </div>
            </article>
            <?php
        }
    } else {
        echo '<p>No se han encontrado correos.</p>';
    }

    imap_close($inbox);
    ?>
</body>
</html>
```

### correos como blog

```
<?php
// ----------------------------------------------------
// CONFIGURACIÓN IMAP
// ----------------------------------------------------
$hostname = '{imap.ionos.es:993/imap/ssl}INBOX'; // Cambia si no usas Gmail
$username = 'python@jocarsa.com';
$password = 'TAME123$';

// ----------------------------------------------------
// FUNCIÓN: decodificar contenido según encoding IMAP
// ----------------------------------------------------
function decodePart($content, $encoding)
{
    switch ($encoding) {
        case 3: // BASE64
            return base64_decode($content);
        case 4: // QUOTED-PRINTABLE
            return quoted_printable_decode($content);
        default:
            return $content;
    }
}

// ----------------------------------------------------
// FUNCIONES PARA EXTRAER CUERPO E IMAGEN DESTACADA
// ----------------------------------------------------

/**
 * Extrae cuerpo HTML / texto y primera imagen encontrada.
 * Devuelve:
 * [
 *   'html'  => string|null,
 *   'text'  => string|null (HTML-safe),
 *   'image' => ['dataUri' => string, 'filename' => string]|null
 * ]
 */
function extractEmailParts($imap, $msgno)
{
    $structure = imap_fetchstructure($imap, $msgno);

    // Resultado acumulado
    $result = [
        'html'  => null,
        'text'  => null,
        'image' => null,
    ];

    // Mensaje simple (sin multipart)
    if (!isset($structure->parts)) {
        $content = imap_body($imap, $msgno);
        $content = decodePart($content, $structure->encoding ?? 0);

        // Si es texto
        if ($structure->type == 0) {
            $subtype = isset($structure->subtype) ? strtoupper($structure->subtype) : '';
            if ($subtype === 'HTML') {
                $result['html'] = $content;
            } else {
                $result['text'] = nl2br(htmlspecialchars($content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
            }
        }

        // Si fuese una única imagen (no es lo habitual)
        if ($structure->type == 5) {
            $subtype = isset($structure->subtype) ? strtolower($structure->subtype) : 'jpeg';
            $mime = 'image/' . $subtype;
            $dataUri = 'data:' . $mime . ';base64,' . base64_encode($content);
            $result['image'] = [
                'dataUri'  => $dataUri,
                'filename' => 'image.' . $subtype,
            ];
        }

        return $result;
    }

    // Si es multipart, recorremos recursivamente
    traverseParts($imap, $msgno, $structure, '', $result);

    return $result;
}

/**
 * Recorre recursivamente las partes MIME.
 * Rellena $result por referencia.
 */
function traverseParts($imap, $msgno, $structure, $prefix, &$result)
{
    if (!isset($structure->parts)) {
        return;
    }

    foreach ($structure->parts as $index => $part) {
        $partNumber = $prefix === '' ? (string)($index + 1) : $prefix . '.' . ($index + 1);

        // Si tiene subpartes, recursión
        if (isset($part->parts) && count($part->parts) > 0) {
            traverseParts($imap, $msgno, $part, $partNumber, $result);
            continue;
        }

        $type    = $part->type ?? null;   // 0 = text, 5 = image
        $subtype = isset($part->subtype) ? strtoupper($part->subtype) : '';
        $content = imap_fetchbody($imap, $msgno, $partNumber);
        $content = decodePart($content, $part->encoding ?? 0);

        // TEXTO
        if ($type === 0) {
            if ($subtype === 'HTML' && $result['html'] === null) {
                $result['html'] = $content;
            } elseif ($subtype === 'PLAIN' && $result['text'] === null) {
                $result['text'] = nl2br(htmlspecialchars($content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
            }
        }

        // IMAGEN (adjunto o inline)
        if ($type === 5 && $result['image'] === null) {
            // Intentar obtener nombre de archivo
            $filename = null;

            if (!empty($part->dparameters)) {
                foreach ($part->dparameters as $param) {
                    if (isset($param->attribute) && in_array(strtoupper($param->attribute), ['NAME', 'FILENAME'])) {
                        $filename = $param->value;
                        break;
                    }
                }
            }

            if (!$filename && !empty($part->parameters)) {
                foreach ($part->parameters as $param) {
                    if (isset($param->attribute) && in_array(strtoupper($param->attribute), ['NAME', 'FILENAME'])) {
                        $filename = $param->value;
                        break;
                    }
                }
            }

            if (!$filename) {
                $filename = 'imagen_' . $partNumber . '.jpg';
            }

            $mimeSubtype = strtolower($subtype ?: 'jpeg');
            $mime        = 'image/' . $mimeSubtype;
            $dataUri     = 'data:' . $mime . ';base64,' . base64_encode($content);

            $result['image'] = [
                'dataUri'  => $dataUri,
                'filename' => $filename,
            ];
        }
    }
}

// ----------------------------------------------------
// CONEXIÓN IMAP Y LECTURA DE CORREOS
// ----------------------------------------------------
$inbox = @imap_open($hostname, $username, $password);

if (!$inbox) {
    die('Error IMAP: ' . imap_last_error());
}

// Puedes cambiar el criterio a 'UNSEEN', 'FROM "alguien"', etc.
$emails = imap_search($inbox, 'ALL');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Blog de correos</title>
    <style>
        :root {
            --bg: #f4f4f5;
            --bg-card: #ffffff;
            --border: #e4e4e7;
            --text: #18181b;
            --muted: #71717a;
            --accent: #2563eb;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        .layout {
            max-width: 960px;
            margin: 0 auto;
            padding: 2rem 1.5rem 3rem;
        }

        header.site-header {
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--border);
            padding-bottom: 1rem;
        }

        .site-title {
            font-size: 2rem;
            margin: 0 0 0.25rem;
        }

        .site-subtitle {
            margin: 0;
            color: var(--muted);
            font-size: 0.95rem;
        }

        .posts {
            display: grid;
            gap: 1.5rem;
        }

        article.post {
            background: var(--bg-card);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--border);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
            display: flex;
            flex-direction: column;
        }

        .post-hero {
            position: relative;
            max-height: 260px;
            overflow: hidden;
        }

        .post-hero img {
            width: 100%;
            display: block;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        article.post:hover .post-hero img {
            transform: scale(1.03);
        }

        .post-content {
            padding: 1.25rem 1.5rem 1.5rem;
        }

        .post-header {
            margin-bottom: 0.75rem;
        }

        .post-title {
            margin: 0 0 0.25rem;
            font-size: 1.25rem;
            line-height: 1.25;
        }

        .post-title a {
            color: var(--text);
            text-decoration: none;
        }

        .post-title a:hover {
            color: var(--accent);
        }

        .post-meta {
            font-size: 0.85rem;
            color: var(--muted);
        }

        .post-meta span + span::before {
            content: "•";
            margin: 0 0.4rem;
        }

        .post-body {
            margin-top: 0.75rem;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .post-body img {
            max-width: 100%;
            height: auto;
        }

        .empty {
            margin-top: 2rem;
            text-align: center;
            color: var(--muted);
        }

        @media (max-width: 640px) {
            .layout {
                padding-inline: 1rem;
            }
        }
    </style>
</head>
<body>
<div class="layout">
    <header class="site-header">
        <h1 class="site-title">Blog desde la bandeja de entrada</h1>
        <p class="site-subtitle">
            Cada correo se muestra como si fuera una entrada de blog.
        </p>
    </header>

    <section class="posts">
        <?php
        if ($emails) {
            // Ordenar: más recientes primero
            rsort($emails);

            // Por ejemplo, mostrar solo los 15 primeros
            $emails = array_slice($emails, 0, 15);

            foreach ($emails as $email_number) {
                $overviewList = imap_fetch_overview($inbox, $email_number, 0);
                $overview     = $overviewList[0] ?? null;

                if (!$overview) {
                    continue;
                }

                $subject = isset($overview->subject) ? imap_utf8($overview->subject) : '(Sin asunto)';
                $from    = isset($overview->from)    ? imap_utf8($overview->from)    : '(Desconocido)';
                $date    = isset($overview->date)    ? $overview->date               : '';

                // Sanitizar cabeceras
                $subject_safe = htmlspecialchars($subject, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                $from_safe    = htmlspecialchars($from,    ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                $date_safe    = htmlspecialchars($date,    ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

                // Extraer cuerpo (HTML / texto) e imagen destacada
                $parts   = extractEmailParts($inbox, $email_number);
                $body    = $parts['html'] ?? $parts['text'] ?? '<em>Sin contenido legible.</em>';
                $image   = $parts['image']; // null o array

                ?>
                <article class="post">
                    <?php if ($image): ?>
                        <div class="post-hero">
                            <img src="<?php echo $image['dataUri']; ?>"
                                 alt="<?php echo htmlspecialchars($image['filename'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>">
                        </div>
                    <?php endif; ?>

                    <div class="post-content">
                        <header class="post-header">
                            <h2 class="post-title">
                                <!-- Podrías enlazar a una vista detallada si creas una página por email -->
                                <a href="#email-<?php echo (int)$email_number; ?>">
                                    <?php echo $subject_safe; ?>
                                </a>
                            </h2>
                            <div class="post-meta">
                                <span>De: <?php echo $from_safe; ?></span>
                                <?php if ($date_safe): ?>
                                    <span><?php echo $date_safe; ?></span>
                                <?php endif; ?>
                            </div>
                        </header>

                        <div class="post-body" id="email-<?php echo (int)$email_number; ?>">
                            <?php echo $body; ?>
                        </div>
                    </div>
                </article>
                <?php
            }
        } else {
            ?>
            <p class="empty">No se han encontrado correos para mostrar.</p>
            <?php
        }

        imap_close($inbox);
        ?>
    </section>
</div>
</body>
</html>
```

### leer correos con mejoras

```
<?php
// ----------------------------------------------------
// CONFIGURACIÓN IMAP
// ----------------------------------------------------
$hostname = '{imap.ionos.es:993/imap/ssl}INBOX'; // Cambiar si no se usa Gmail
$username = 'python@jocarsa.com';
$password = 'TAME123$';

// Longitud del resumen (portada)
define('EXCERPT_LENGTH', 400);

// ----------------------------------------------------
// FUNCIÓN: decodificar contenido según encoding IMAP
// ----------------------------------------------------
function decodePart($content, $encoding)
{
    switch ($encoding) {
        case 3: // BASE64
            return base64_decode($content);
        case 4: // QUOTED-PRINTABLE
            return quoted_printable_decode($content);
        default:
            return $content;
    }
}

// ----------------------------------------------------
// FUNCIONES PARA EXTRAER CUERPO E IMAGEN DESTACADA
// ----------------------------------------------------

/**
 * Extrae cuerpo HTML / texto y primera imagen encontrada.
 * Devuelve:
 * [
 *   'html'  => string|null,
 *   'text'  => string|null (HTML-safe),
 *   'image' => ['dataUri' => string, 'filename' => string]|null
 * ]
 */
function extractEmailParts($imap, $msgno)
{
    $structure = imap_fetchstructure($imap, $msgno);

    $result = [
        'html'  => null,
        'text'  => null,
        'image' => null,
    ];

    // Mensaje simple (sin multipart)
    if (!isset($structure->parts)) {
        $content = imap_body($imap, $msgno);
        $content = decodePart($content, $structure->encoding ?? 0);

        if ($structure->type == 0) { // texto
            $subtype = isset($structure->subtype) ? strtoupper($structure->subtype) : '';
            if ($subtype === 'HTML') {
                $result['html'] = $content;
            } else {
                $result['text'] = nl2br(htmlspecialchars($content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
            }
        }

        // Caso raro: único contenido es una imagen
        if ($structure->type == 5) {
            $subtype = isset($structure->subtype) ? strtolower($structure->subtype) : 'jpeg';
            $mime = 'image/' . $subtype;
            $dataUri = 'data:' . $mime . ';base64,' . base64_encode($content);
            $result['image'] = [
                'dataUri'  => $dataUri,
                'filename' => 'image.' . $subtype,
            ];
        }

        return $result;
    }

    // Multipart: recorrer recursivamente
    traverseParts($imap, $msgno, $structure, '', $result);

    return $result;
}

/**
 * Recorre recursivamente las partes MIME.
 * Rellena $result por referencia.
 */
function traverseParts($imap, $msgno, $structure, $prefix, &$result)
{
    if (!isset($structure->parts)) {
        return;
    }

    foreach ($structure->parts as $index => $part) {
        $partNumber = $prefix === '' ? (string)($index + 1) : $prefix . '.' . ($index + 1);

        if (isset($part->parts) && count($part->parts) > 0) {
            traverseParts($imap, $msgno, $part, $partNumber, $result);
            continue;
        }

        $type    = $part->type ?? null;   // 0 = text, 5 = image
        $subtype = isset($part->subtype) ? strtoupper($part->subtype) : '';
        $content = imap_fetchbody($imap, $msgno, $partNumber);
        $content = decodePart($content, $part->encoding ?? 0);

        // Texto
        if ($type === 0) {
            if ($subtype === 'HTML' && $result['html'] === null) {
                $result['html'] = $content;
            } elseif ($subtype === 'PLAIN' && $result['text'] === null) {
                $result['text'] = nl2br(htmlspecialchars($content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
            }
        }

        // Imagen (adjunto o inline)
        if ($type === 5 && $result['image'] === null) {
            $filename = null;

            if (!empty($part->dparameters)) {
                foreach ($part->dparameters as $param) {
                    if (isset($param->attribute) && in_array(strtoupper($param->attribute), ['NAME', 'FILENAME'])) {
                        $filename = $param->value;
                        break;
                    }
                }
            }

            if (!$filename && !empty($part->parameters)) {
                foreach ($part->parameters as $param) {
                    if (isset($param->attribute) && in_array(strtoupper($param->attribute), ['NAME', 'FILENAME'])) {
                        $filename = $param->value;
                        break;
                    }
                }
            }

            if (!$filename) {
                $filename = 'imagen_' . $partNumber . '.jpg';
            }

            $mimeSubtype = strtolower($subtype ?: 'jpeg');
            $mime        = 'image/' . $mimeSubtype;
            $dataUri     = 'data:' . $mime . ';base64,' . base64_encode($content);

            $result['image'] = [
                'dataUri'  => $dataUri,
                'filename' => $filename,
            ];
        }
    }
}

// ----------------------------------------------------
// FUNCIÓN PARA GENERAR EXCERPT DEL CUERPO
// ----------------------------------------------------
function makeExcerpt($html, $length = EXCERPT_LENGTH)
{
    // Quitar etiquetas y normalizar espacios
    $text = trim(strip_tags($html));
    $text = preg_replace('/\s+/', ' ', $text);

    if (function_exists('mb_strlen') && function_exists('mb_substr')) {
        if (mb_strlen($text, 'UTF-8') <= $length) {
            return $text;
        }
        return mb_substr($text, 0, $length, 'UTF-8') . '…';
    } else {
        if (strlen($text) <= $length) {
            return $text;
        }
        return substr($text, 0, $length) . '…';
    }
}

// ----------------------------------------------------
// CONEXIÓN IMAP
// ----------------------------------------------------
$inbox = @imap_open($hostname, $username, $password);

if (!$inbox) {
    die('Error IMAP: ' . imap_last_error());
}

// Si hay parámetro ?id=NNN, se muestra vista detallada
$selectedId = isset($_GET['id']) ? (int)$_GET['id'] : null;

// En vista detalle, no necesitamos buscar todos
if ($selectedId) {
    $emails = [$selectedId];
    $isDetail = true;
} else {
    // Portada: listar varios correos
    $emails = imap_search($inbox, 'ALL');
    $isDetail = false;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>
        <?php echo $isDetail ? 'Entrada del blog' : 'Blog de correos'; ?>
    </title>
    <style>
        :root {
            --bg: #f4f4f5;
            --bg-card: #ffffff;
            --border: #e4e4e7;
            --text: #18181b;
            --muted: #71717a;
            --accent: #2563eb;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        .layout {
            max-width: 960px;
            margin: 0 auto;
            padding: 2rem 1.5rem 3rem;
        }

        header.site-header {
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--border);
            padding-bottom: 1rem;
        }

        .site-title {
            font-size: 2rem;
            margin: 0 0 0.25rem;
        }

        .site-subtitle {
            margin: 0;
            color: var(--muted);
            font-size: 0.95rem;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            color: var(--accent);
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .posts {
            display: grid;
            gap: 1.5rem;
        }

        article.post {
            background: var(--bg-card);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--border);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
            display: flex;
            flex-direction: column;
        }

        .post-hero {
            position: relative;
            max-height: 260px;
            overflow: hidden;
        }

        .post-hero img {
            width: 100%;
            display: block;
            object-fit: cover;
            object-position: center center; /* centrar en overflow */
            transition: transform 0.4s ease;
        }

        article.post:hover .post-hero img {
            transform: scale(1.03);
        }

        .post-content {
            padding: 1.25rem 1.5rem 1.5rem;
        }

        .post-header {
            margin-bottom: 0.75rem;
        }

        .post-title {
            margin: 0 0 0.25rem;
            font-size: 1.25rem;
            line-height: 1.25;
        }

        .post-title a {
            color: var(--text);
            text-decoration: none;
        }

        .post-title a:hover {
            color: var(--accent);
        }

        .post-meta {
            font-size: 0.85rem;
            color: var(--muted);
        }

        .post-meta span + span::before {
            content: "•";
            margin: 0 0.4rem;
        }

        .post-body {
            margin-top: 0.75rem;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .post-body img {
            max-width: 100%;
            height: auto;
        }

        .read-more {
            margin-top: 0.75rem;
            font-size: 0.9rem;
        }

        .read-more a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
        }

        .read-more a:hover {
            text-decoration: underline;
        }

        .empty {
            margin-top: 2rem;
            text-align: center;
            color: var(--muted);
        }

        @media (max-width: 640px) {
            .layout {
                padding-inline: 1rem;
            }
        }
    </style>
</head>
<body>
<div class="layout">
    <header class="site-header">
        <h1 class="site-title">
            <?php echo $isDetail ? 'Entrada del blog desde la bandeja de entrada' : 'Blog desde la bandeja de entrada'; ?>
        </h1>
        <p class="site-subtitle">
            Cada correo se muestra como si fuera una entrada de blog.
        </p>
    </header>

    <?php if ($isDetail): ?>
        <a href="<?php echo strtok($_SERVER['REQUEST_URI'], '?'); ?>" class="back-link">← Volver al listado</a>
    <?php endif; ?>

    <section class="posts">
        <?php
        if ($emails) {
            if (!$isDetail) {
                // Portada: ordenamos y limitamos
                rsort($emails);
                $emails = array_slice($emails, 0, 15);
            }

            foreach ($emails as $email_number) {
                $overviewList = imap_fetch_overview($inbox, $email_number, 0);
                $overview     = $overviewList[0] ?? null;

                if (!$overview) {
                    continue;
                }

                $subject = isset($overview->subject) ? imap_utf8($overview->subject) : '(Sin asunto)';
                $from    = isset($overview->from)    ? imap_utf8($overview->from)    : '(Desconocido)';
                $date    = isset($overview->date)    ? $overview->date               : '';

                $subject_safe = htmlspecialchars($subject, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                $from_safe    = htmlspecialchars($from,    ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                $date_safe    = htmlspecialchars($date,    ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

                $parts = extractEmailParts($inbox, $email_number);
                $bodyFullHtml = $parts['html'] ?? $parts['text'] ?? '<em>Sin contenido legible.</em>';
                $image        = $parts['image'];

                // En portada mostramos excerpt, en detalle el cuerpo completo
                if ($isDetail) {
                    $bodyToShow = $bodyFullHtml;
                } else {
                    $excerptText = makeExcerpt($bodyFullHtml, EXCERPT_LENGTH);
                    // El excerpt es texto plano; se escapa para HTML
                    $bodyToShow  = '<p>' . htmlspecialchars($excerptText, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</p>';
                }

                $detailUrl = strtok($_SERVER['REQUEST_URI'], '?') . '?id=' . (int)$email_number;
                ?>
                <article class="post">
                    <?php if ($image): ?>
                        <div class="post-hero">
                            <img src="<?php echo $image['dataUri']; ?>"
                                 alt="<?php echo htmlspecialchars($image['filename'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>">
                        </div>
                    <?php endif; ?>

                    <div class="post-content">
                        <header class="post-header">
                            <h2 class="post-title">
                                <a href="<?php echo $detailUrl; ?>">
                                    <?php echo $subject_safe; ?>
                                </a>
                            </h2>
                            <div class="post-meta">
                                <span>De: <?php echo $from_safe; ?></span>
                                <?php if ($date_safe): ?>
                                    <span><?php echo $date_safe; ?></span>
                                <?php endif; ?>
                            </div>
                        </header>

                        <div class="post-body">
                            <?php echo $bodyToShow; ?>
                        </div>

                        <?php if (!$isDetail): ?>
                            <div class="read-more">
                                <a href="<?php echo $detailUrl; ?>">Leer más →</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </article>
                <?php
                // En vista detalle solo se muestra una entrada
                if ($isDetail) {
                    break;
                }
            }
        } else {
            ?>
            <p class="empty">No se han encontrado correos para mostrar.</p>
            <?php
        }

        imap_close($inbox);
        ?>
    </section>
</div>
</body>
</html>
```

### personalizar

```
<?php
// ----------------------------------------------------
// CONFIGURACIÓN IMAP
// ----------------------------------------------------
$hostname = '{imap.ionos.es:993/imap/ssl}INBOX'; // Cambiar si no se usa Gmail
$username = 'python@jocarsa.com';
$password = 'TAME123$';

// Longitud del resumen (portada)
define('EXCERPT_LENGTH', 400);

// ----------------------------------------------------
// FUNCIÓN: decodificar contenido según encoding IMAP
// ----------------------------------------------------
function decodePart($content, $encoding)
{
    switch ($encoding) {
        case 3: // BASE64
            return base64_decode($content);
        case 4: // QUOTED-PRINTABLE
            return quoted_printable_decode($content);
        default:
            return $content;
    }
}

// ----------------------------------------------------
// FUNCIONES PARA EXTRAER CUERPO E IMAGEN DESTACADA
// ----------------------------------------------------

/**
 * Extrae cuerpo HTML / texto y primera imagen encontrada.
 * Devuelve:
 * [
 *   'html'  => string|null,
 *   'text'  => string|null (HTML-safe),
 *   'image' => ['dataUri' => string, 'filename' => string]|null
 * ]
 */
function extractEmailParts($imap, $msgno)
{
    $structure = imap_fetchstructure($imap, $msgno);

    $result = [
        'html'  => null,
        'text'  => null,
        'image' => null,
    ];

    // Mensaje simple (sin multipart)
    if (!isset($structure->parts)) {
        $content = imap_body($imap, $msgno);
        $content = decodePart($content, $structure->encoding ?? 0);

        if ($structure->type == 0) { // texto
            $subtype = isset($structure->subtype) ? strtoupper($structure->subtype) : '';
            if ($subtype === 'HTML') {
                $result['html'] = $content;
            } else {
                $result['text'] = nl2br(htmlspecialchars($content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
            }
        }

        // Caso raro: único contenido es una imagen
        if ($structure->type == 5) {
            $subtype = isset($structure->subtype) ? strtolower($structure->subtype) : 'jpeg';
            $mime = 'image/' . $subtype;
            $dataUri = 'data:' . $mime . ';base64,' . base64_encode($content);
            $result['image'] = [
                'dataUri'  => $dataUri,
                'filename' => 'image.' . $subtype,
            ];
        }

        return $result;
    }

    // Multipart: recorrer recursivamente
    traverseParts($imap, $msgno, $structure, '', $result);

    return $result;
}

/**
 * Recorre recursivamente las partes MIME.
 * Rellena $result por referencia.
 */
function traverseParts($imap, $msgno, $structure, $prefix, &$result)
{
    if (!isset($structure->parts)) {
        return;
    }

    foreach ($structure->parts as $index => $part) {
        $partNumber = $prefix === '' ? (string)($index + 1) : $prefix . '.' . ($index + 1);

        if (isset($part->parts) && count($part->parts) > 0) {
            traverseParts($imap, $msgno, $part, $partNumber, $result);
            continue;
        }

        $type    = $part->type ?? null;   // 0 = text, 5 = image
        $subtype = isset($part->subtype) ? strtoupper($part->subtype) : '';
        $content = imap_fetchbody($imap, $msgno, $partNumber);
        $content = decodePart($content, $part->encoding ?? 0);

        // Texto
        if ($type === 0) {
            if ($subtype === 'HTML' && $result['html'] === null) {
                $result['html'] = $content;
            } elseif ($subtype === 'PLAIN' && $result['text'] === null) {
                $result['text'] = nl2br(htmlspecialchars($content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
            }
        }

        // Imagen (adjunto o inline)
        if ($type === 5 && $result['image'] === null) {
            $filename = null;

            if (!empty($part->dparameters)) {
                foreach ($part->dparameters as $param) {
                    if (isset($param->attribute) && in_array(strtoupper($param->attribute), ['NAME', 'FILENAME'])) {
                        $filename = $param->value;
                        break;
                    }
                }
            }

            if (!$filename && !empty($part->parameters)) {
                foreach ($part->parameters as $param) {
                    if (isset($param->attribute) && in_array(strtoupper($param->attribute), ['NAME', 'FILENAME'])) {
                        $filename = $param->value;
                        break;
                    }
                }
            }

            if (!$filename) {
                $filename = 'imagen_' . $partNumber . '.jpg';
            }

            $mimeSubtype = strtolower($subtype ?: 'jpeg');
            $mime        = 'image/' . $mimeSubtype;
            $dataUri     = 'data:' . $mime . ';base64,' . base64_encode($content);

            $result['image'] = [
                'dataUri'  => $dataUri,
                'filename' => $filename,
            ];
        }
    }
}

// ----------------------------------------------------
// FUNCIÓN PARA GENERAR EXCERPT DEL CUERPO
// ----------------------------------------------------
function makeExcerpt($html, $length = EXCERPT_LENGTH)
{
    // Quitar etiquetas y normalizar espacios
    $text = trim(strip_tags($html));
    $text = preg_replace('/\s+/', ' ', $text);

    if (function_exists('mb_strlen') && function_exists('mb_substr')) {
        if (mb_strlen($text, 'UTF-8') <= $length) {
            return $text;
        }
        return mb_substr($text, 0, $length, 'UTF-8') . '…';
    } else {
        if (strlen($text) <= $length) {
            return $text;
        }
        return substr($text, 0, $length) . '…';
    }
}

// ----------------------------------------------------
// CONEXIÓN IMAP
// ----------------------------------------------------
$inbox = @imap_open($hostname, $username, $password);

if (!$inbox) {
    die('Error IMAP: ' . imap_last_error());
}

// Si hay parámetro ?id=NNN, se muestra vista detallada
$selectedId = isset($_GET['id']) ? (int)$_GET['id'] : null;

// En vista detalle, no necesitamos buscar todos
if ($selectedId) {
    $emails = [$selectedId];
    $isDetail = true;
} else {
    // Portada: listar varios correos
    $emails = imap_search($inbox, 'ALL');
    $isDetail = false;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>
        <?php echo $isDetail ? 'Entrada del blog' : 'Blog de correos'; ?>
    </title>
    <style>
        :root {
            --bg: #f4f4f5;
            --bg-card: #ffffff;
            --border: #e4e4e7;
            --text: #18181b;
            --muted: #71717a;
            --accent: #2563eb;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        .layout {
            max-width: 960px;
            margin: 0 auto;
            padding: 2rem 1.5rem 3rem;
        }

        header.site-header {
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--border);
            padding-bottom: 1rem;
        }

        .site-title {
            font-size: 2rem;
            margin: 0 0 0.25rem;
        }

        .site-subtitle {
            margin: 0;
            color: var(--muted);
            font-size: 0.95rem;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            color: var(--accent);
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .posts {
            display: grid;
            gap: 1.5rem;
        }

        article.post {
            background: var(--bg-card);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--border);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
            display: flex;
            flex-direction: column;
        }

        .post-hero {
            position: relative;
            max-height: 260px;
            overflow: hidden;
        }

        .post-hero img {
            width: 100%;
            display: block;
            object-fit: cover;
            object-position: center center; /* centrar en overflow */
            transition: transform 0.4s ease;
        }

        article.post:hover .post-hero img {
            transform: scale(1.03);
        }

        .post-content {
            padding: 1.25rem 1.5rem 1.5rem;
        }

        .post-header {
            margin-bottom: 0.75rem;
        }

        .post-title {
            margin: 0 0 0.25rem;
            font-size: 1.25rem;
            line-height: 1.25;
        }

        .post-title a {
            color: var(--text);
            text-decoration: none;
        }

        .post-title a:hover {
            color: var(--accent);
        }

        .post-meta {
            font-size: 0.85rem;
            color: var(--muted);
        }

        .post-meta span + span::before {
            content: "•";
            margin: 0 0.4rem;
        }

        .post-body {
            margin-top: 0.75rem;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .post-body img {
            max-width: 100%;
            height: auto;
        }

        .read-more {
            margin-top: 0.75rem;
            font-size: 0.9rem;
        }

        .read-more a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
        }

        .read-more a:hover {
            text-decoration: underline;
        }

        .empty {
            margin-top: 2rem;
            text-align: center;
            color: var(--muted);
        }

        @media (max-width: 640px) {
            .layout {
                padding-inline: 1rem;
            }
        }
    </style>
</head>
<body>
<div class="layout">
    <header class="site-header">
        <h1 class="site-title">
            Jose Vicente Carratala Sanchis
        </h1>
        <p class="site-subtitle">
            Programador, profesor y diseñador en Valencia, España.
        </p>
    </header>

    <?php if ($isDetail): ?>
        <a href="<?php echo strtok($_SERVER['REQUEST_URI'], '?'); ?>" class="back-link">← Volver al listado</a>
    <?php endif; ?>

    <section class="posts">
        <?php
        if ($emails) {
            if (!$isDetail) {
                // Portada: ordenamos y limitamos
                rsort($emails);
                $emails = array_slice($emails, 0, 15);
            }

            foreach ($emails as $email_number) {
                $overviewList = imap_fetch_overview($inbox, $email_number, 0);
                $overview     = $overviewList[0] ?? null;

                if (!$overview) {
                    continue;
                }

                $subject = isset($overview->subject) ? imap_utf8($overview->subject) : '(Sin asunto)';
                $from    = isset($overview->from)    ? imap_utf8($overview->from)    : '(Desconocido)';
                $date    = isset($overview->date)    ? $overview->date               : '';

                $subject_safe = htmlspecialchars($subject, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                $from_safe    = htmlspecialchars($from,    ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                $date_safe    = htmlspecialchars($date,    ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

                $parts = extractEmailParts($inbox, $email_number);
                $bodyFullHtml = $parts['html'] ?? $parts['text'] ?? '<em>Sin contenido legible.</em>';
                $image        = $parts['image'];

                // En portada mostramos excerpt, en detalle el cuerpo completo
                if ($isDetail) {
                    $bodyToShow = $bodyFullHtml;
                } else {
                    $excerptText = makeExcerpt($bodyFullHtml, EXCERPT_LENGTH);
                    // El excerpt es texto plano; se escapa para HTML
                    $bodyToShow  = '<p>' . htmlspecialchars($excerptText, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</p>';
                }

                $detailUrl = strtok($_SERVER['REQUEST_URI'], '?') . '?id=' . (int)$email_number;
                ?>
                <article class="post">
                    <?php if ($image): ?>
                        <div class="post-hero">
                            <img src="<?php echo $image['dataUri']; ?>"
                                 alt="<?php echo htmlspecialchars($image['filename'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>">
                        </div>
                    <?php endif; ?>

                    <div class="post-content">
                        <header class="post-header">
                            <h2 class="post-title">
                                <a href="<?php echo $detailUrl; ?>">
                                    <?php echo $subject_safe; ?>
                                </a>
                            </h2>
                            <div class="post-meta">
                                <span>De: <?php echo $from_safe; ?></span>
                                <?php if ($date_safe): ?>
                                    <span><?php echo $date_safe; ?></span>
                                <?php endif; ?>
                            </div>
                        </header>

                        <div class="post-body">
                            <?php echo $bodyToShow; ?>
                        </div>

                        <?php if (!$isDetail): ?>
                            <div class="read-more">
                                <a href="<?php echo $detailUrl; ?>">Leer más →</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </article>
                <?php
                // En vista detalle solo se muestra una entrada
                if ($isDetail) {
                    break;
                }
            }
        } else {
            ?>
            <p class="empty">No se han encontrado correos para mostrar.</p>
            <?php
        }

        imap_close($inbox);
        ?>
    </section>
</div>
</body>
</html>
```

### version movil

```
<?php
// ----------------------------------------------------
// CONFIGURACIÓN IMAP
// ----------------------------------------------------
$hostname = '{imap.ionos.es:993/imap/ssl}INBOX'; // Cambiar si no se usa Gmail
$username = 'python@jocarsa.com';
$password = 'TAME123$';

// Longitud del resumen (portada)
define('EXCERPT_LENGTH', 400);

// ----------------------------------------------------
// FUNCIÓN: decodificar contenido según encoding IMAP
// ----------------------------------------------------
function decodePart($content, $encoding)
{
    switch ($encoding) {
        case 3: // BASE64
            return base64_decode($content);
        case 4: // QUOTED-PRINTABLE
            return quoted_printable_decode($content);
        default:
            return $content;
    }
}

// ----------------------------------------------------
// FUNCIONES PARA EXTRAER CUERPO E IMAGEN DESTACADA
// ----------------------------------------------------

/**
 * Extrae cuerpo HTML / texto y primera imagen encontrada.
 * Devuelve:
 * [
 *   'html'  => string|null,
 *   'text'  => string|null (HTML-safe),
 *   'image' => ['dataUri' => string, 'filename' => string]|null
 * ]
 */
function extractEmailParts($imap, $msgno)
{
    $structure = imap_fetchstructure($imap, $msgno);

    $result = [
        'html'  => null,
        'text'  => null,
        'image' => null,
    ];

    // Mensaje simple (sin multipart)
    if (!isset($structure->parts)) {
        $content = imap_body($imap, $msgno);
        $content = decodePart($content, $structure->encoding ?? 0);

        if ($structure->type == 0) { // texto
            $subtype = isset($structure->subtype) ? strtoupper($structure->subtype) : '';
            if ($subtype === 'HTML') {
                $result['html'] = $content;
            } else {
                $result['text'] = nl2br(htmlspecialchars($content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
            }
        }

        // Caso raro: único contenido es una imagen
        if ($structure->type == 5) {
            $subtype = isset($structure->subtype) ? strtolower($structure->subtype) : 'jpeg';
            $mime = 'image/' . $subtype;
            $dataUri = 'data:' . $mime . ';base64,' . base64_encode($content);
            $result['image'] = [
                'dataUri'  => $dataUri,
                'filename' => 'image.' . $subtype,
            ];
        }

        return $result;
    }

    // Multipart: recorrer recursivamente
    traverseParts($imap, $msgno, $structure, '', $result);

    return $result;
}

/**
 * Recorre recursivamente las partes MIME.
 * Rellena $result por referencia.
 */
function traverseParts($imap, $msgno, $structure, $prefix, &$result)
{
    if (!isset($structure->parts)) {
        return;
    }

    foreach ($structure->parts as $index => $part) {
        $partNumber = $prefix === '' ? (string)($index + 1) : $prefix . '.' . ($index + 1);

        if (isset($part->parts) && count($part->parts) > 0) {
            traverseParts($imap, $msgno, $part, $partNumber, $result);
            continue;
        }

        $type    = $part->type ?? null;   // 0 = text, 5 = image
        $subtype = isset($part->subtype) ? strtoupper($part->subtype) : '';
        $content = imap_fetchbody($imap, $msgno, $partNumber);
        $content = decodePart($content, $part->encoding ?? 0);

        // Texto
        if ($type === 0) {
            if ($subtype === 'HTML' && $result['html'] === null) {
                $result['html'] = $content;
            } elseif ($subtype === 'PLAIN' && $result['text'] === null) {
                $result['text'] = nl2br(htmlspecialchars($content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
            }
        }

        // Imagen (adjunto o inline)
        if ($type === 5 && $result['image'] === null) {
            $filename = null;

            if (!empty($part->dparameters)) {
                foreach ($part->dparameters as $param) {
                    if (isset($param->attribute) && in_array(strtoupper($param->attribute), ['NAME', 'FILENAME'])) {
                        $filename = $param->value;
                        break;
                    }
                }
            }

            if (!$filename && !empty($part->parameters)) {
                foreach ($part->parameters as $param) {
                    if (isset($param->attribute) && in_array(strtoupper($param->attribute), ['NAME', 'FILENAME'])) {
                        $filename = $param->value;
                        break;
                    }
                }
            }

            if (!$filename) {
                $filename = 'imagen_' . $partNumber . '.jpg';
            }

            $mimeSubtype = strtolower($subtype ?: 'jpeg');
            $mime        = 'image/' . $mimeSubtype;
            $dataUri     = 'data:' . $mime . ';base64,' . base64_encode($content);

            $result['image'] = [
                'dataUri'  => $dataUri,
                'filename' => $filename,
            ];
        }
    }
}

// ----------------------------------------------------
// FUNCIÓN PARA GENERAR EXCERPT DEL CUERPO
// ----------------------------------------------------
function makeExcerpt($html, $length = EXCERPT_LENGTH)
{
    // Quitar etiquetas y normalizar espacios
    $text = trim(strip_tags($html));
    $text = preg_replace('/\s+/', ' ', $text);

    if (function_exists('mb_strlen') && function_exists('mb_substr')) {
        if (mb_strlen($text, 'UTF-8') <= $length) {
            return $text;
        }
        return mb_substr($text, 0, $length, 'UTF-8') . '…';
    } else {
        if (strlen($text) <= $length) {
            return $text;
        }
        return substr($text, 0, $length) . '…';
    }
}

// ----------------------------------------------------
// CONEXIÓN IMAP
// ----------------------------------------------------
$inbox = @imap_open($hostname, $username, $password);

if (!$inbox) {
    die('Error IMAP: ' . imap_last_error());
}

// Si hay parámetro ?id=NNN, se muestra vista detallada
$selectedId = isset($_GET['id']) ? (int)$_GET['id'] : null;

// En vista detalle, no necesitamos buscar todos
if ($selectedId) {
    $emails = [$selectedId];
    $isDetail = true;
} else {
    // Portada: listar varios correos
    $emails = imap_search($inbox, 'ALL');
    $isDetail = false;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>
        <?php echo $isDetail ? 'Entrada del blog' : 'Blog de correos'; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">


    <style>
        :root {
            --bg: #f4f4f5;
            --bg-card: #ffffff;
            --border: #e4e4e7;
            --text: #18181b;
            --muted: #71717a;
            --accent: #2563eb;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        .layout {
            max-width: 960px;
            margin: 0 auto;
            padding: 2rem 1.5rem 3rem;
        }

        header.site-header {
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--border);
            padding-bottom: 1rem;
        }

        .site-title {
            font-size: 2rem;
            margin: 0 0 0.25rem;
        }

        .site-subtitle {
            margin: 0;
            color: var(--muted);
            font-size: 0.95rem;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            color: var(--accent);
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .posts {
            display: grid;
            gap: 1.5rem;
        }

        article.post {
            background: var(--bg-card);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--border);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
            display: flex;
            flex-direction: column;
        }

        .post-hero {
            position: relative;
            max-height: 260px;
            overflow: hidden;
        }

        .post-hero img {
            width: 100%;
            display: block;
            object-fit: cover;
            object-position: center center; /* centrar en overflow */
            transition: transform 0.4s ease;
        }

        article.post:hover .post-hero img {
            transform: scale(1.03);
        }

        .post-content {
            padding: 1.25rem 1.5rem 1.5rem;
        }

        .post-header {
            margin-bottom: 0.75rem;
        }

        .post-title {
            margin: 0 0 0.25rem;
            font-size: 1.25rem;
            line-height: 1.25;
        }

        .post-title a {
            color: var(--text);
            text-decoration: none;
        }

        .post-title a:hover {
            color: var(--accent);
        }

        .post-meta {
            font-size: 0.85rem;
            color: var(--muted);
        }

        .post-meta span + span::before {
            content: "•";
            margin: 0 0.4rem;
        }

        .post-body {
            margin-top: 0.75rem;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .post-body img {
            max-width: 100%;
            height: auto;
        }

        .read-more {
            margin-top: 0.75rem;
            font-size: 0.9rem;
        }

        .read-more a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
        }

        .read-more a:hover {
            text-decoration: underline;
        }

        .empty {
            margin-top: 2rem;
            text-align: center;
            color: var(--muted);
        }

        @media (max-width: 640px) {
            .layout {
                padding-inline: 1rem;
            }
        }
    </style>
</head>
<body>
<div class="layout">
    <header class="site-header">
        <h1 class="site-title">
            Jose Vicente Carratala Sanchis
        </h1>
        <p class="site-subtitle">
            Programador, profesor y diseñador en Valencia, España.
        </p>
    </header>

    <?php if ($isDetail): ?>
        <a href="<?php echo strtok($_SERVER['REQUEST_URI'], '?'); ?>" class="back-link">← Volver al listado</a>
    <?php endif; ?>

    <section class="posts">
        <?php
        if ($emails) {
            if (!$isDetail) {
                // Portada: ordenamos y limitamos
                rsort($emails);
                $emails = array_slice($emails, 0, 15);
            }

            foreach ($emails as $email_number) {
                $overviewList = imap_fetch_overview($inbox, $email_number, 0);
                $overview     = $overviewList[0] ?? null;

                if (!$overview) {
                    continue;
                }

                $subject = isset($overview->subject) ? imap_utf8($overview->subject) : '(Sin asunto)';
                $from    = isset($overview->from)    ? imap_utf8($overview->from)    : '(Desconocido)';
                $date    = isset($overview->date)    ? $overview->date               : '';

                $subject_safe = htmlspecialchars($subject, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                $from_safe    = htmlspecialchars($from,    ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                $date_safe    = htmlspecialchars($date,    ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

                $parts = extractEmailParts($inbox, $email_number);
                $bodyFullHtml = $parts['html'] ?? $parts['text'] ?? '<em>Sin contenido legible.</em>';
                $image        = $parts['image'];

                // En portada mostramos excerpt, en detalle el cuerpo completo
                if ($isDetail) {
                    $bodyToShow = $bodyFullHtml;
                } else {
                    $excerptText = makeExcerpt($bodyFullHtml, EXCERPT_LENGTH);
                    // El excerpt es texto plano; se escapa para HTML
                    $bodyToShow  = '<p>' . htmlspecialchars($excerptText, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</p>';
                }

                $detailUrl = strtok($_SERVER['REQUEST_URI'], '?') . '?id=' . (int)$email_number;
                ?>
                <article class="post">
                    <?php if ($image): ?>
                        <div class="post-hero">
                            <img src="<?php echo $image['dataUri']; ?>"
                                 alt="<?php echo htmlspecialchars($image['filename'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>">
                        </div>
                    <?php endif; ?>

                    <div class="post-content">
                        <header class="post-header">
                            <h2 class="post-title">
                                <a href="<?php echo $detailUrl; ?>">
                                    <?php echo $subject_safe; ?>
                                </a>
                            </h2>
                            <div class="post-meta">
                                <span>De: <?php echo $from_safe; ?></span>
                                <?php if ($date_safe): ?>
                                    <span><?php echo $date_safe; ?></span>
                                <?php endif; ?>
                            </div>
                        </header>

                        <div class="post-body">
                            <?php echo $bodyToShow; ?>
                        </div>

                        <?php if (!$isDetail): ?>
                            <div class="read-more">
                                <a href="<?php echo $detailUrl; ?>">Leer más →</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </article>
                <?php
                // En vista detalle solo se muestra una entrada
                if ($isDetail) {
                    break;
                }
            }
        } else {
            ?>
            <p class="empty">No se han encontrado correos para mostrar.</p>
            <?php
        }

        imap_close($inbox);
        ?>
    </section>
</div>
</body>
</html>
```

### vinculos

```
<?php
// ----------------------------------------------------
// CONFIGURACIÓN IMAP
// ----------------------------------------------------
$hostname = '{imap.ionos.es:993/imap/ssl}INBOX'; // Cambiar si no se usa Gmail
$username = 'python@jocarsa.com';
$password = 'TAME123$';

// Longitud del resumen (portada)
define('EXCERPT_LENGTH', 400);

// ----------------------------------------------------
// FUNCIÓN: decodificar contenido según encoding IMAP
// ----------------------------------------------------
function decodePart($content, $encoding)
{
    switch ($encoding) {
        case 3: // BASE64
            return base64_decode($content);
        case 4: // QUOTED-PRINTABLE
            return quoted_printable_decode($content);
        default:
            return $content;
    }
}

// ----------------------------------------------------
// FUNCIONES PARA EXTRAER CUERPO E IMAGEN DESTACADA
// ----------------------------------------------------

/**
 * Extrae cuerpo HTML / texto y primera imagen encontrada.
 * Devuelve:
 * [
 *   'html'  => string|null,
 *   'text'  => string|null (HTML-safe),
 *   'image' => ['dataUri' => string, 'filename' => string]|null
 * ]
 */
function extractEmailParts($imap, $msgno)
{
    $structure = imap_fetchstructure($imap, $msgno);

    $result = [
        'html'  => null,
        'text'  => null,
        'image' => null,
    ];

    // Mensaje simple (sin multipart)
    if (!isset($structure->parts)) {
        $content = imap_body($imap, $msgno);
        $content = decodePart($content, $structure->encoding ?? 0);

        if ($structure->type == 0) { // texto
            $subtype = isset($structure->subtype) ? strtoupper($structure->subtype) : '';
            if ($subtype === 'HTML') {
                $result['html'] = $content;
            } else {
                $result['text'] = nl2br(htmlspecialchars($content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
            }
        }

        // Caso raro: único contenido es una imagen
        if ($structure->type == 5) {
            $subtype = isset($structure->subtype) ? strtolower($structure->subtype) : 'jpeg';
            $mime = 'image/' . $subtype;
            $dataUri = 'data:' . $mime . ';base64,' . base64_encode($content);
            $result['image'] = [
                'dataUri'  => $dataUri,
                'filename' => 'image.' . $subtype,
            ];
        }

        return $result;
    }

    // Multipart: recorrer recursivamente
    traverseParts($imap, $msgno, $structure, '', $result);

    return $result;
}

/**
 * Recorre recursivamente las partes MIME.
 * Rellena $result por referencia.
 */
function traverseParts($imap, $msgno, $structure, $prefix, &$result)
{
    if (!isset($structure->parts)) {
        return;
    }

    foreach ($structure->parts as $index => $part) {
        $partNumber = $prefix === '' ? (string)($index + 1) : $prefix . '.' . ($index + 1);

        if (isset($part->parts) && count($part->parts) > 0) {
            traverseParts($imap, $msgno, $part, $partNumber, $result);
            continue;
        }

        $type    = $part->type ?? null;   // 0 = text, 5 = image
        $subtype = isset($part->subtype) ? strtoupper($part->subtype) : '';
        $content = imap_fetchbody($imap, $msgno, $partNumber);
        $content = decodePart($content, $part->encoding ?? 0);

        // Texto
        if ($type === 0) {
            if ($subtype === 'HTML' && $result['html'] === null) {
                $result['html'] = $content;
            } elseif ($subtype === 'PLAIN' && $result['text'] === null) {
                $result['text'] = nl2br(htmlspecialchars($content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
            }
        }

        // Imagen (adjunto o inline)
        if ($type === 5 && $result['image'] === null) {
            $filename = null;

            if (!empty($part->dparameters)) {
                foreach ($part->dparameters as $param) {
                    if (isset($param->attribute) && in_array(strtoupper($param->attribute), ['NAME', 'FILENAME'])) {
                        $filename = $param->value;
                        break;
                    }
                }
            }

            if (!$filename && !empty($part->parameters)) {
                foreach ($part->parameters as $param) {
                    if (isset($param->attribute) && in_array(strtoupper($param->attribute), ['NAME', 'FILENAME'])) {
                        $filename = $param->value;
                        break;
                    }
                }
            }

            if (!$filename) {
                $filename = 'imagen_' . $partNumber . '.jpg';
            }

            $mimeSubtype = strtolower($subtype ?: 'jpeg');
            $mime        = 'image/' . $mimeSubtype;
            $dataUri     = 'data:' . $mime . ';base64,' . base64_encode($content);

            $result['image'] = [
                'dataUri'  => $dataUri,
                'filename' => $filename,
            ];
        }
    }
}

// ----------------------------------------------------
// FUNCIÓN PARA GENERAR EXCERPT DEL CUERPO
// ----------------------------------------------------
function makeExcerpt($html, $length = EXCERPT_LENGTH)
{
    // Quitar etiquetas y normalizar espacios
    $text = trim(strip_tags($html));
    $text = preg_replace('/\s+/', ' ', $text);

    if (function_exists('mb_strlen') && function_exists('mb_substr')) {
        if (mb_strlen($text, 'UTF-8') <= $length) {
            return $text;
        }
        return mb_substr($text, 0, $length, 'UTF-8') . '…';
    } else {
        if (strlen($text) <= $length) {
            return $text;
        }
        return substr($text, 0, $length) . '…';
    }
}

// ----------------------------------------------------
// CONEXIÓN IMAP
// ----------------------------------------------------
$inbox = @imap_open($hostname, $username, $password);

if (!$inbox) {
    die('Error IMAP: ' . imap_last_error());
}

// Si hay parámetro ?id=NNN, se muestra vista detallada
$selectedId = isset($_GET['id']) ? (int)$_GET['id'] : null;

// En vista detalle, no necesitamos buscar todos
if ($selectedId) {
    $emails = [$selectedId];
    $isDetail = true;
} else {
    // Portada: listar varios correos
    $emails = imap_search($inbox, 'ALL');
    $isDetail = false;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>
        <?php echo $isDetail ? 'Entrada del blog' : 'Blog de correos'; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">


    <style>
        :root {
            --bg: #f4f4f5;
            --bg-card: #ffffff;
            --border: #e4e4e7;
            --text: #18181b;
            --muted: #71717a;
            --accent: #2563eb;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        .layout {
            max-width: 960px;
            margin: 0 auto;
            padding: 2rem 1.5rem 3rem;
        }

        header.site-header {
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--border);
            padding-bottom: 1rem;
            display:flex;
            align-items:center;
            justify-content:space-between;
        }
        .social img{
          width: 35px;
    margin-left: 5px;
        }

        .site-title {
            font-size: 2rem;
            margin: 0 0 0.25rem;
        }

        .site-subtitle {
            margin: 0;
            color: var(--muted);
            font-size: 0.95rem;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            color: var(--accent);
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .posts {
            display: grid;
            gap: 1.5rem;
        }

        article.post {
            background: var(--bg-card);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--border);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
            display: flex;
            flex-direction: column;
        }

        .post-hero {
            position: relative;
            max-height: 260px;
            overflow: hidden;
        }

        .post-hero img {
            width: 100%;
            display: block;
            object-fit: cover;
            object-position: center center; /* centrar en overflow */
            transition: transform 0.4s ease;
        }

        article.post:hover .post-hero img {
            transform: scale(1.03);
        }

        .post-content {
            padding: 1.25rem 1.5rem 1.5rem;
        }

        .post-header {
            margin-bottom: 0.75rem;
        }

        .post-title {
            margin: 0 0 0.25rem;
            font-size: 1.25rem;
            line-height: 1.25;
        }

        .post-title a {
            color: var(--text);
            text-decoration: none;
        }

        .post-title a:hover {
            color: var(--accent);
        }

        .post-meta {
            font-size: 0.85rem;
            color: var(--muted);
        }

        .post-meta span + span::before {
            content: "•";
            margin: 0 0.4rem;
        }

        .post-body {
            margin-top: 0.75rem;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .post-body img {
            max-width: 100%;
            height: auto;
        }

        .read-more {
            margin-top: 0.75rem;
            font-size: 0.9rem;
        }

        .read-more a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
        }

        .read-more a:hover {
            text-decoration: underline;
        }

        .empty {
            margin-top: 2rem;
            text-align: center;
            color: var(--muted);
        }

        @media (max-width: 640px) {
            .layout {
                padding-inline: 1rem;
            }
        }
    </style>
</head>
<body>
<div class="layout">
    <header class="site-header">
      <div class="corporativo">
        <h1 class="site-title">
            Jose Vicente Carratala Sanchis
        </h1>
        <p class="site-subtitle">
            Programador, profesor y diseñador en Valencia, España.
        </p>
       </div>
       <div class="social">
          <a href="https://facebook.com/carratala"><img src="logos/facebook.png"></a>
          <a href="https://www.instagram.com/jvcarratala/"><img src="logos/instagram.png"></a>
          <a href="mailto:info@josevicentecarratala.com"><img src="logos/email.png"></a>
          <a href="https://github.com/jocarsa"><img src="logos/github.png"></a>
          <a href="https://jocarsa.com"><img src="logos/home.png"></a>
          <a href="https://www.linkedin.com/in/jvcarratala/"><img src="logos/linkedin.png"></a>
          <a href="https://wa.me/34620891718"><img src="logos/whatsapp.png"></a>
          <a href="https://www.youtube.com/@VicenteCarratala"><img src="logos/youtube.png"></a>
          
       </div>
    </header>

    <?php if ($isDetail): ?>
        <a href="<?php echo strtok($_SERVER['REQUEST_URI'], '?'); ?>" class="back-link">← Volver al listado</a>
    <?php endif; ?>

    <section class="posts">
        <?php
        if ($emails) {
            if (!$isDetail) {
                // Portada: ordenamos y limitamos
                rsort($emails);
                $emails = array_slice($emails, 0, 15);
            }

            foreach ($emails as $email_number) {
                $overviewList = imap_fetch_overview($inbox, $email_number, 0);
                $overview     = $overviewList[0] ?? null;

                if (!$overview) {
                    continue;
                }

                $subject = isset($overview->subject) ? imap_utf8($overview->subject) : '(Sin asunto)';
                $from    = isset($overview->from)    ? imap_utf8($overview->from)    : '(Desconocido)';
                $date    = isset($overview->date)    ? $overview->date               : '';

                $subject_safe = htmlspecialchars($subject, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                $from_safe    = htmlspecialchars($from,    ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                $date_safe    = htmlspecialchars($date,    ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

                $parts = extractEmailParts($inbox, $email_number);
                $bodyFullHtml = $parts['html'] ?? $parts['text'] ?? '<em>Sin contenido legible.</em>';
                $image        = $parts['image'];

                // En portada mostramos excerpt, en detalle el cuerpo completo
                if ($isDetail) {
                    $bodyToShow = $bodyFullHtml;
                } else {
                    $excerptText = makeExcerpt($bodyFullHtml, EXCERPT_LENGTH);
                    // El excerpt es texto plano; se escapa para HTML
                    $bodyToShow  = '<p>' . htmlspecialchars($excerptText, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</p>';
                }

                $detailUrl = strtok($_SERVER['REQUEST_URI'], '?') . '?id=' . (int)$email_number;
                ?>
                <article class="post">
                    <?php if ($image): ?>
                        <div class="post-hero">
                            <img src="<?php echo $image['dataUri']; ?>"
                                 alt="<?php echo htmlspecialchars($image['filename'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>">
                        </div>
                    <?php endif; ?>

                    <div class="post-content">
                        <header class="post-header">
                            <h2 class="post-title">
                                <a href="<?php echo $detailUrl; ?>">
                                    <?php echo $subject_safe; ?>
                                </a>
                            </h2>
                            <div class="post-meta">
                                <span>De: <?php echo $from_safe; ?></span>
                                <?php if ($date_safe): ?>
                                    <span><?php echo $date_safe; ?></span>
                                <?php endif; ?>
                            </div>
                        </header>

                        <div class="post-body">
                            <?php echo $bodyToShow; ?>
                        </div>

                        <?php if (!$isDetail): ?>
                            <div class="read-more">
                                <a href="<?php echo $detailUrl; ?>">Leer más →</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </article>
                <?php
                // En vista detalle solo se muestra una entrada
                if ($isDetail) {
                    break;
                }
            }
        } else {
            ?>
            <p class="empty">No se han encontrado correos para mostrar.</p>
            <?php
        }

        imap_close($inbox);
        ?>
    </section>
</div>
</body>
</html>
```


<a id="actividad-libre-de-final-de-evaluacion-la-milla-extra"></a>
# Actividad libre de final de evaluación - La milla extra

<a id="la-milla-extra-primera-evaluacion"></a>
## La Milla Extra - Primera evaluación

### ejercicio

```markdown

```
