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
  - [html como pug](#html-como-pug)
  - [creacion de panel de administracion](#creacion-de-panel-de-administracion)
- [Actividad libre de final de evaluación - La milla extra](#actividad-libre-de-final-de-evaluacion-la-milla-extra)
  - [La Milla Extra - Primera evaluación](#la-milla-extra-primera-evaluacion)
  - [La Milla Extra - Segunda evaluación](#la-milla-extra-segunda-evaluacion)
- [Actividades de final de unidad segundo trimestre](#actividades-de-final-de-unidad-segundo-trimestre)
  - [Panel de administración para proyecto juguetes](#panel-de-administracion-para-proyecto-juguetes)
  - [HTML como pug](#html-como-pug-1)
  - [Recuperación de emails con IMAP](#recuperacion-de-emails-con-imap-1)
  - [Panel de control con GET y POST](#panel-de-control-con-get-y-post)

---

<a id="desarrollo-de-software"></a>
# Desarrollo de software

<a id="concepto-de-programa-informatico"></a>
## Concepto de programa informático

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/001-Desarrollo%20de%20software/001-Concepto%20de%20programa%20inform%C3%A1tico)

### Introducción a los ejercicios

En esta carpeta de ejercicios, los estudiantes encontrarán una introducción teórica a lo que es un programa informático y cómo funciona en relación con el procesador. El archivo markdown explica de manera sencilla la diferencia entre un proceso y un programa, enfatizando cómo estos elementos interactúan para ejecutar tareas computacionales. Como complemento práctico a esta teoría, se incluye un sencillo script en Python que imprime "Hola mundo", lo cual sirve como ejemplo de lo básico de la interacción entre un programa y el sistema operativo al generar y ejecutar un proceso. Esta actividad permite a los estudiantes comprender y aplicar conceptos fundamentales sobre programas informáticos, su funcionamiento y cómo estos generan acciones en la computadora.

### holamundo
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es muy simple y básico en programación. La función `print()` se utiliza para mostrar texto o información en la pantalla. En este caso, el programa está configurado para imprimir la frase "Hola mundo" cuando se ejecuta. Este ejemplo clásico, conocido como "Hola Mundo", sirve para demostrar cómo funciona una aplicación mínima y es comúnmente utilizado por los principiantes para familiarizarse con un nuevo lenguaje de programación o entorno de desarrollo.

El texto entre comillas ("Hola mundo") es lo que se va a mostrar en la pantalla. Cuando ejecutas este programa, simplemente verás "Hola mundo" impreso en la consola o terminal donde estés corriendo el código. Es importante porque nos ayuda a entender cómo interactuar con los programas utilizando funciones predefinidas como `print()`.

`002-holamundo.py`

```python
print("Hola mundo")
```

### Actividades propuestas

1. **Actividad: Comprender la estructura básica de un programa**
   - **Descripción:** Los estudiantes deben analizar y explicar qué hace un programa simple como "Hola Mundo" en Python. Se espera que identifiquen cómo se ejecuta el código y lo relacionen con el concepto del procesador y los procesos mencionados en la introducción.

2. **Actividad: Explicación de conceptos**
   - **Descripción:** Los estudiantes deben redactar un breve texto explicando qué es un programa informático basándose en su propia interpretación y usando la analogía de procesador, proceso y ejecución presentada en el material proporcionado.

3. **Actividad: Conversión Markdown a código**
   - **Descripción:** Los estudiantes tendrán que escribir un script simple (por ejemplo, una introducción similar al contenido de 001-Introduccion.md) utilizando Python, para comprender la diferencia entre un texto explicativo y el código ejecutable.

4. **Actividad: Identificación de componentes**
   - **Descripción:** Los estudiantes deben identificar los diferentes componentes (procesador, proceso, programa) en una descripción simplificada del ciclo de vida de un programa desde su creación hasta la ejecución.

5. **Actividad: Diagrama de flujo**
   - **Descripción:** Se pide a los alumnos que dibujen un diagrama de flujo básico mostrando cómo un programa informático se convierte en un proceso y luego es ejecutado por el procesador.

6. **Actividad: Expresión matemática**
   - **Descripción:** Los estudiantes deben escribir una expresión matemática simple (como `print(2+2)`) en Python y explicar cómo se relaciona con la estructura de un programa informático.

7. **Actividad: Prueba de errores**
   - **Descripción:** Los alumnos deben crear varias versiones del código "Hola mundo" con errores intencionados y probar cuál es el resultado cuando estos errores son ejecutados en Python, para entender los conceptos de error y excepción.

8. **Actividad: Descripción de la ejecución**
   - **Descripción:** Los estudiantes escribirán una explicación detallada sobre qué sucede desde que un programa se abre hasta que el procesador lo ejecuta, incluyendo todos los pasos intermedios.

9. **Actividad: Comparativa Markdown vs Python**
   - **Descripción:** Los alumnos deben comparar y contrastar cómo la misma información o mensaje puede ser representada en Markdown (como en 001-Introduccion.md) y como un programa ejecutable en Python, usando ejemplos sencillos.

10. **Actividad: Ejercicio de reflexión**
    - **Descripción:** Los estudiantes deben escribir una breve reflexión sobre cómo los conceptos presentados (procesador, proceso, programa) están relacionados entre sí y cómo cada uno contribuye al funcionamiento de un sistema informático en su conjunto.


<a id="codigo-fuente-codigo-objeto-y-codigo-ejecutable-tecnologias-de-virtualizacion"></a>
## Código fuente, código objeto y código ejecutable; tecnologías de virtualización

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/001-Desarrollo%20de%20software/002-C%C3%B3digo%20fuente%2C%20c%C3%B3digo%20objeto%20y%20c%C3%B3digo%20ejecutable%3B%20tecnolog%C3%ADas%20de%20virtualizaci%C3%B3n)

### Introducción a los ejercicios

En esta carpeta se encuentran ejercicios relacionados con los conceptos fundamentales del desarrollo de software, específicamente sobre cómo funcionan los diferentes tipos de lenguajes: interpretados, compilados y aquellos que utilizan máquinas virtuales. Los archivos proporcionan un marco teórico para entender las diferencias clave entre estos enfoques, como la forma en que se generan sus ejecutables y cómo interactúan con el sistema operativo. A través de ejemplos en Python y C++, los estudiantes podrán observar directamente estas distinciones prácticas. La idea es familiarizarse con las ventajas y desventajas de cada método para tomar decisiones informadas sobre la elección del lenguaje adecuado según las necesidades del proyecto.

### Lenguaje interpretado
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es muy simple pero fundamental en la programación. La línea `print("Hola mundo")` se encarga de mostrar el texto "Hola mundo" en la pantalla o consola donde se ejecuta el programa. Cuando un programador incluye esta línea en su código, lo que hace es enviar una cadena de caracteres ("Hola mundo", entre comillas) al dispositivo de salida estándar, lo cual suele ser la pantalla del computador o la terminal donde estás trabajando.

El uso de `print()` es muy común cuando se empieza a aprender programación porque permite visualizar rápidamente los resultados y asegurarse de que el código funciona correctamente. En este caso particular, te ayuda a confirmar que tu entorno de desarrollo está configurado adecuadamente para ejecutar scripts en Python.

Es importante destacar que aunque esta línea parece simple, entender cómo funcionan las funciones como `print()` es crucial para aprender a usar bibliotecas y frameworks más avanzados en el futuro.

`001-Lenguaje interpretado.py`

```python
print("Hola mundo")
```

### lenguaje compilado
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código es un programa sencillo en el lenguaje de programación C++. Lo que hace este fragmento es imprimir en la pantalla una frase, específicamente "Hola mundo desde C++", utilizando uno de los comandos más básicos del lenguaje. 

El programa empieza con `#include <iostream>`, lo cual incluye un archivo especial llamado biblioteca estándar iostream que contiene funciones para realizar operaciones de entrada y salida, como mostrar texto en la pantalla.

Luego se usa la instrucción `using namespace std;` para evitar tener que escribir "std::" antes del nombre de las funciones. Esta línea hace que el código sea más conciso y fácil de leer.

La función principal `main()` es donde comienza la ejecución del programa. Dentro de esta, `std::cout << "Hola mundo desde C++";` es lo que imprime en pantalla el texto deseado. Finalmente, `return 0;` indica que el programa ha terminado sin errores.

Este tipo de código es fundamental para entender los conceptos básicos de programación con C++, ya que muestra cómo interactuar con el sistema y mostrar información al usuario.

`002-lenguaje compilado.cpp`

```
#include <iostream>
using namespace std;
 
int main(){
  std::cout << "Hola mundo desde C++";
  return 0;
}
```

### Actividades propuestas

### Actividades Propuestas para Estudiantes de Formación Profesional

1. **Comparativa entre Lenguajes Interpretados y Compilados**
   - **Descripción:** Elabora una tabla comparativa que destaque las principales diferencias entre los lenguajes interpretados y compilados, incluyendo ventajas y desventajas para cada tipo de lenguaje.

2. **Ejemplo Práctico de Programación en C++**
   - **Descripción:** Escribe un programa en C++ que imprima “Hola Mundo” y explique los pasos necesarios para compilarlo utilizando g++, incluyendo la generación del archivo objeto y el ejecutable.

3. **Creación de Documentación Markdown**
   - **Descripción:** Utiliza markdown para crear una guía simple sobre cómo escribir un programa en Java, destacando cómo se maneja el bytecode y qué es la máquina virtual.

4. **Explicación de Virtualización**
   - **Descripción:** Escriba una breve explicación sobre qué es la virtualización con ejemplos basados en lenguajes como Java y .NET. Explique los conceptos clave como el bytecode y la máquina virtual.

5. **Comparativa entre C++ y Python**
   - **Descripción:** Elabora un ensayo corto comparando las ventajas y desventajas de utilizar C++ frente a Python para un proyecto específico, basándote en criterios de velocidad de ejecución y facilidad de desarrollo.

6. **Introducción a la Máquina Virtual de Java (JVM)**
   - **Descripción:** Prepara una presentación corta que explique qué es la máquina virtual de Java, cómo funciona y por qué es importante para el desarrollo en lenguajes como Java y Kotlin.

7. **Análisis del Código Fuente vs Código Ejecutable**
   - **Descripción:** Analiza los archivos proporcionados (Ejercicio 001-Lenguaje interpretado.py y Ejercicio 002-lenguaje compilado.cpp) para explicar las diferencias entre el código fuente y el código ejecutable.

8. **Explicación de Lenguajes Interpretados**
   - **Descripción:** Escribe un breve texto que explique qué son los lenguajes interpretados, cómo funcionan y cuáles son algunos ejemplos comunes. Incluye un ejemplo con Python.

9. **Diseño de Entorno Virtual para Programación en Java**
   - **Descripción:** Diseña una guía paso a paso sobre cómo configurar un entorno virtual para programación en Java, incluyendo la instalación del JDK y el uso de herramientas como Eclipse o IntelliJ IDEA.

10. **Resumen Comparativo (Lenguajes Interpretados vs Compilados)**
    - **Descripción:** Realiza un resumen comparativo de los lenguajes interpretados y compilados basado en los conceptos presentados en los ejercicios proporcionados, incluyendo las ventajas y desventajas para diferentes tipos de proyectos.


<a id="tipos-de-lenguajes-de-programacion-paradigmas"></a>
## Tipos de lenguajes de programación. Paradigmas

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/001-Desarrollo%20de%20software/003-Tipos%20de%20lenguajes%20de%20programaci%C3%B3n.%20Paradigmas)

### Introducción a los ejercicios

Esta carpeta contiene ejercicios destinados a introducir a los estudiantes del DAM a la clasificación y comprensión de diferentes tipos de lenguajes de programación, así como a los paradigmas fundamentales que influyen en el desarrollo de software. Los archivos proporcionan una visión general desde los lenguajes de muy bajo nivel hasta los de alto nivel, destacando sus ventajas y desventajas en términos de control del programa, facilidad de uso y velocidad de ejecución. Además, se introduce la noción de paradigmas de programación como estructurado, orientado a objetos y multiparadigma, con énfasis en cómo cada uno afecta el diseño y la implementación de aplicaciones más grandes y complejas. Estos ejercicios ayudan a los estudiantes a desarrollar una comprensión crítica sobre las elecciones lingüísticas y paradigmas que se deben hacer al diseñar software.

### Actividades propuestas

### Actividad 1: Clasificación de Lenguajes de Programación

**Descripción:** Los estudiantes deben clasificar una lista proporcionada de lenguajes de programación en categorías como "muy bajo nivel", "bajo nivel", "intermedio" y "alto nivel". Se espera que identifiquen las características clave de cada tipo de lenguaje.

### Actividad 2: Descripción del Ensamblador

**Descripción:** Los alumnos deben escribir una breve descripción de qué es el ensamblador, cómo funciona y por qué los programadores pueden encontrarlo útil. Se espera que comprendan sus ventajas y limitaciones.

### Actividad 3: Ejemplo en C++

**Descripción:** Proporcionar un ejercicio práctico donde se utilice C++ para realizar una tarea simple (como el cálculo de la suma de dos números). Los estudiantes deben aprender a utilizar los conceptos básicos del lenguaje y cómo es más potente que un lenguaje de alto nivel.

### Actividad 4: Ventajas y Desventajas de Java

**Descripción:** Los alumnos escribirán una lista de ventajas y desventajas al usar Java en comparación con C++. Se espera que comprendan los conceptos de abstracción y simplificación del lenguaje intermedio.

### Actividad 5: Explicar Python a un Novato

**Descripción:** Los estudiantes deben preparar una explicación para alguien nuevo a la programación sobre qué es Python, cómo funciona y por qué es popular. Se espera que identifiquen las abstracciones fuertes del lenguaje.

### Actividad 6: Paradigma Estructurado vs Orientado a Objetos

**Descripción:** Los alumnos deben comparar y contrastar los paradigmas estructurados y orientados a objetos, describiendo situaciones en las que uno sería preferible al otro. Se espera que comprendan la reutilización de código y su importancia.

### Actividad 7: Multiparadigma con C++

**Descripción:** Los estudiantes deben investigar cómo el lenguaje multiparadigma como C++ permite combinar diferentes estilos de programación (estructurada, orientada a objetos). Se espera que puedan dar ejemplos del uso mixto en un mismo proyecto.

### Actividad 8: Ejercicio Práctico con Paradigmas

**Descripción:** Los alumnos tendrán que escribir una pequeña aplicación utilizando Python o JavaScript mostrando al menos dos paradigmas diferentes. Esto ayudará a entender cómo los lenguajes multiparadigma proporcionan flexibilidad y versatilidad en la programación.

### Actividad 9: Historia de Paradigmas

**Descripción:** Los estudiantes deben crear una línea del tiempo que muestre el desarrollo histórico desde paradigmas estructurados hasta multiparadigma. Se espera que comprendan los cambios evolutivos y las motivaciones detrás de cada paradigma.

### Actividad 10: Presentación en Grupo

**Descripción:** En grupos, los estudiantes prepararán una presentación sobre la evolución y características de diferentes lenguajes de programación desde el ensamblador hasta Python. Se espera que compartan sus hallazgos con la clase y puedan explicar las diferencias entre ellos.


<a id="caracteristicas-de-los-lenguajes-mas-difundidos"></a>
## Características de los lenguajes más difundidos

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/001-Desarrollo%20de%20software/004-Caracter%C3%ADsticas%20de%20los%20lenguajes%20m%C3%A1s%20difundidos)

### Introducción a los ejercicios

Este archivo introduce una visión general sobre los lenguajes de programación más utilizados en el año 2025 según un índice conocido. El objetivo principal es proporcionar contexto sobre cómo evolucionan estos lenguajes y sus respectivas cuotas de mercado, destacando especialmente a Python por su crecimiento rápido. Los estudiantes aprenderán a analizar datos estadísticos relacionados con la industria del desarrollo de software y entenderán las dinámicas que influyen en el uso de diferentes lenguajes. Este ejercicio se enfoca en comprender la relevancia actual y futura de los lenguajes más comunes, así como sus aplicaciones específicas en diversos ámbitos tecnológicos.

### Actividades propuestas

1. **Análisis y Presentación del Informe sobre Lenguajes**
   - **Descripción:** Los estudiantes deben analizar los datos proporcionados en el archivo Markdown acerca del uso y evolución de lenguajes de programación. A continuación, deberán crear una presentación breve que resalte las tendencias actuales y futuras basadas en la información dada.
   - **Objetivo:** Que los estudiantes entiendan cómo se mide el éxito y la popularidad de un lenguaje de programación en contextos industriales y académicos.

2. **Evolución Temporal**
   - **Descripción:** Los alumnos deben investigar las estadísticas del año anterior para comparar con las actuales presentadas en el archivo. Con estos datos, elaborarán una tabla o gráfico que muestre la evolución temporal de los lenguajes mencionados.
   - **Objetivo:** Que comprendan la importancia de mantenerse actualizados y analizar tendencias a largo plazo.

3. **Resumen Comparativo**
   - **Descripción:** Se requiere crear un resumen comparativo entre Python, C++, Java, y otros lenguajes mencionados, destacando sus fortalezas y debilidades según la información proporcionada.
   - **Objetivo:** Que desarrollen habilidades de análisis crítico al contrastar características de diferentes tecnologías.

4. **Redacción de Artículo**
   - **Descripción:** Los estudiantes escribirán un artículo corto (500 palabras) sobre el crecimiento del lenguaje Python y su impacto en la industria tecnológica.
   - **Objetivo:** Que mejoren sus habilidades de comunicación escrita técnica e incrementen su conocimiento acerca de uno de los lenguajes más actuales.

5. **Cuestionario Sobre Tendencias**
   - **Descripción:** Se les pedirá que formulen un cuestionario sobre las tendencias presentadas en el archivo Markdown, incluyendo preguntas sobre por qué crees que Python ha experimentado un crecimiento tan fuerte.
   - **Objetivo:** Que identifiquen y expliquen los factores que influyen en la adopción de ciertas tecnologías.

6. **Diseño Propio del Cuestionario**
   - **Descripción:** Los estudiantes deben crear su propio cuestionario sobre tendencias actuales, incluyendo preguntas abiertas y cerradas para evaluar el conocimiento de los compañeros.
   - **Objetivo:** Que aprendan a diseñar evaluaciones basadas en datos técnicos y analíticos.

7. **Debate Virtual: Lenguajes del Futuro**
   - **Descripción:** Organizarán un debate virtual en el que discutan sobre qué lenguaje tiene más potencial para ser dominante en los próximos años.
   - **Objetivo:** Que practiquen la argumentación y defensa de posiciones basadas en datos.

8. **Investigación Adicional: Lenguajes Emergentes**
   - **Descripción:** Los estudiantes deben investigar otros lenguajes emergentes (fuera del archivo proporcionado) e informar sobre su potencial impacto en el futuro.
   - **Objetivo:** Que amplíen sus horizontes y estén al tanto de nuevas tecnologías que aún no son dominantes pero tienen un gran potencial.


<a id="fases-del-desarrollo-de-una-aplicacion-analisis-diseno-codificacion-pruebas-documentacion-explotacion-y-mantenimiento-entre-otras"></a>
## Fases del desarrollo de una aplicación análisis, diseño, codificación, pruebas, documentación, explotación y mantenimiento, entre otras

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/001-Desarrollo%20de%20software/005-Fases%20del%20desarrollo%20de%20una%20aplicaci%C3%B3n%20an%C3%A1lisis%2C%20dise%C3%B1o%2C%20codificaci%C3%B3n%2C%20pruebas%2C%20documentaci%C3%B3n%2C%20explotaci%C3%B3n%20y%20mantenimiento%2C%20entre%20otras)

### Introducción a los ejercicios

Este conjunto de ejercicios aborda el ciclo completo del desarrollo de software, desde la fase inicial de análisis hasta las etapas posteriores como pruebas y mantenimiento. Los estudiantes aprenderán a identificar necesidades del mercado y diseñar soluciones informáticas adecuadas, además de codificar programas simples en Python para resolver problemas concretos, como un programa básico de lista de la compra. También se practicará la importancia de las pruebas y la refactorización del código para mejorar su calidad y legibilidad. Además, se introducirá la documentación del software y cómo mantenerlo una vez que está en uso por los usuarios finales.

### programa lista de la compra
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es un programa simple que permite al usuario gestionar una lista de la compra. El programa entra en un bucle infinito (`while True`) donde muestra un menú con dos opciones: insertar un elemento nuevo o listar todos los elementos existentes en el archivo `listadelacompra.txt`. 

Cuando el usuario selecciona la opción 1, se le pide que introduzca el nombre de un elemento y este se escribe en el archivo `listadelacompra.txt` en modo de añadir (`"a"`), lo cual permite agregar nuevas líneas sin borrar las existentes. Si el usuario elige la opción 2, el programa abre el mismo archivo pero esta vez en modo lectura (`"r"`), lee todas sus líneas e imprime cada una en pantalla.

Este código es importante porque demuestra cómo interactuar con archivos para almacenar y recuperar información de forma persistente entre diferentes ejecuciones del programa.

`003-programa lista de la compra.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código es un ejemplo simple de cómo interactuar con el usuario y manipular archivos en Python. Primero, muestra al usuario una interfaz sencilla donde puede elegir entre dos opciones: insertar un nuevo elemento en la lista de la compra o listar todos los elementos que ya están ahí.

Cuando el usuario selecciona "1", se le pide que introduzca el nombre del elemento que quiere añadir. Luego, el código abre el archivo `listadelacompra.txt` en modo de escritura adicional (`"a"`), lo que significa que cualquier texto nuevo se agregará al final del archivo sin borrar nada previo. Se escribe el nombre del elemento introducido por el usuario, seguido de una nueva línea para mantener cada entrada separada.

Si el usuario selecciona "2", el programa abre el mismo archivo en modo lectura (`"r"`). Luego lee todas las líneas del archivo y las imprime en la consola. Esto permite que el usuario vea lo que ya ha añadido a su lista de la compra hasta ahora.

Este tipo de estructura es útil para aprender cómo gestionar interacciones básicas con archivos, lo cual es una habilidad fundamental cuando se desarrollan aplicaciones más complejas.

`004-pruebas.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código es un programa simple en Python que permite al usuario interactuar con una lista de la compra almacenada en un archivo de texto llamado `listadelacompra.txt`. El programa entra en un bucle infinito (`while True`), lo que significa que seguirá ejecutándose hasta que se interrumpa manualmente. En cada iteración del bucle, muestra al usuario dos opciones: insertar un nuevo elemento en la lista o listar todos los elementos existentes.

El programa intenta obtener una opción válida (1 para insertar y 2 para listar) utilizando `int(input(...))`. Si el usuario ingresa algo que no se puede convertir a un número entero, el bloque `except` captura este error y establece la opción en 2 automáticamente, asumiendo que el usuario quiso listar los elementos.

Dependiendo de la opción elegida por el usuario:

- Si es 1, abre el archivo `listadelacompra.txt` en modo de añadido (`"a"`), solicita al usuario ingresar un nuevo elemento y lo agrega al final del archivo.
  
- Si es 2, abre el archivo en modo lectura (`"r"`), lee todas las líneas del archivo e imprime cada una para mostrar la lista completa.

Este tipo de código es importante porque enseña conceptos básicos como manejo de excepciones y manipulación de archivos, lo que son fundamentales para cualquier programa que interactúe con almacenamiento persistente de datos.

`005-modificacion tras prueba fallida.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código es un programa sencillo que te permite gestionar una lista de la compra. Se ejecuta en bucle infinito, ofreciéndote siempre dos opciones: insertar un nuevo elemento en la lista o listar todos los elementos existentes.

El programa comienza mostrándote un menú con dos opciones y pidiéndote que elijas una introduciendo un número. Si introduces un valor no numérico, el programa asume automáticamente que deseas ver la lista de compras (opción 2). Si eliges añadir un nuevo elemento a la lista (opción 1), se te pedirá que indiques el nombre del artículo y este será guardado en un archivo llamado `listadelacompra.txt`. Si seleccionas listar los elementos (opción 2), el programa leerá todos los elementos almacenados en ese mismo archivo y los mostrará por pantalla, línea a línea.

Este tipo de estructura es común en la codificación de software para permitir al usuario interactuar repetidamente con una aplicación hasta que decida finalizarla. Es importante notar cómo se maneja el posible error si el usuario introduce un valor no numérico para elegir la opción del menú, asegurando así que el programa sigue funcionando correctamente en todas las circunstancias posibles.

`006-vamos a comentar el software.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

El código que se está intentando analizar parece estar vacío o no ha sido proporcionado correctamente. No hay ningún fragmento de código para explicar en este caso, así que si tienes un bloque de código específico que te gustaría entender, por favor compártelo y con gusto lo explicaré.

`Archivo sin título`

```

```

### listadelacompra
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código no es realmente un código programático, sino que se trata de un archivo de texto simple llamado `listadelacompra.txt`. En este archivo, simplemente se listan dos tipos de frutas: "manzanas" y "peras". Cada elemento está en una línea separada. Este tipo de archivo puede ser utilizado por programas para leer la información y manipularla según sea necesario, como agregar artículos a una lista de compras o contar el número de ítems que contiene. Es importante entender cómo manejar archivos de texto en programación ya que son fundamentales para almacenar y recuperar datos en muchas aplicaciones.

`listadelacompra.txt`

```
manzanas
peras
```

### Actividades propuestas

### Actividad 1: Análisis de Necesidades del Mercado
**Descripción:** 
Los estudiantes deben identificar una necesidad del mercado que podría resolverse mediante un programa informático. La actividad busca que comprendan cómo se origina la idea de desarrollo de software.

---

### Actividad 2: Diseño Básico del Proyecto
**Descripción:** 
Se pide a los estudiantes diseñar el esquema general y las tecnologías necesarias para desarrollar una aplicación simple, similar al programa de lista de la compra. Esta actividad tiene como objetivo que planifiquen recursos antes de programar.

---

### Actividad 3: Codificación del Programa
**Descripción:** 
Los estudiantes deben crear un programa sencillo en Python que permita a los usuarios agregar elementos a una lista y listar dichos elementos, utilizando archivos de texto para almacenar la información. Esta actividad se centra en el desarrollo básico de software.

---

### Actividad 4: Mejorando el Código Tras Pruebas
**Descripción:** 
Los estudiantes recibirán un programa existente (similar al de la lista de la compra) y deben identificar problemas, realizar pruebas para detectar errores y luego corregirlos. Se busca mejorar habilidades en depuración.

---

### Actividad 5: Refactorización del Código
**Descripción:** 
Tras las correcciones necesarias basadas en pruebas fallidas, los estudiantes deberán refactorizar el código de su programa para hacerlo más eficiente y legible. La actividad persigue la mejora continua del código.

---

### Actividad 6: Documentación Básica
**Descripción:** 
Los estudiantes deben documentar sus programas con comentarios en Python explicando las funciones y procesos clave, así como proporcionar instrucciones básicas de uso para los usuarios finales. Se busca mejorar habilidades en la escritura de documentos técnicos.

---

### Actividad 7: Pruebas Automáticas
**Descripción:** 
Los estudiantes deben implementar pruebas unitarias o automáticas para verificar que el programa funciona correctamente bajo diferentes escenarios, incluyendo casos borde y errores esperados. Se busca mejorar habilidades en automatización de pruebas.

---

### Actividad 8: Mantenimiento del Software
**Descripción:** 
Se pide a los estudiantes analizar cómo mantendrían su aplicación una vez lanzada al mercado, considerando actualizaciones basadas en las necesidades cambiantes del usuario y las mejoras tecnológicas. Se busca entender el ciclo completo de vida de un software.

---

Estas actividades están diseñadas para cubrir desde la conceptualización hasta la implementación final y mantenimiento del desarrollo de software básico utilizando Python, adaptándose al nivel de los estudiantes de Formación Profesional.


<a id="proceso-de-obtencion-de-codigo-ejecutable-a-partir-del-codigo-fuente-herramientas-implicadas"></a>
## Proceso de obtención de código ejecutable a partir del código fuente; herramientas implicadas

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/001-Desarrollo%20de%20software/006-Proceso%20de%20obtenci%C3%B3n%20de%20c%C3%B3digo%20ejecutable%20a%20partir%20del%20c%C3%B3digo%20fuente%3B%20herramientas%20implicadas)

### Introducción a los ejercicios

En esta carpeta, encontrarás ejercicios que te introducirán al proceso de obtención del código ejecutable a partir del código fuente en diferentes entornos y lenguajes. Se analizará cómo Python, un lenguaje interpretado, no genera archivos ejecutables binarios al lanzarse directamente contra el intérprete, contrastándolo con C o C++, que requieren ser compilados para generar archivos ejecutables. Estos ejercicios te ayudarán a comprender las diferencias en la implementación y ejecución de programas en diferentes lenguajes de programación.

### Ejemplo en python
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es muy sencillo y básico. La línea `print("Hola mundo")` muestra en la pantalla el texto "Hola mundo". Esta función, `print`, se utiliza para imprimir información en la consola o terminal donde estás ejecutando el programa. Es una forma rápida de verificar que tu programa está funcionando correctamente y de ver los resultados intermedios mientras estás programando. En este caso particular, simplemente imprime un saludo en pantalla para demostrar cómo usar esta función básica en Python.

`001-Ejemplo en python.py`

```python
print("Hola mundo")
```

### hola mundo en C
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es un programa sencillo escrito en el lenguaje de programación C que imprime "Hola mundo" en la consola. Comienza incluyendo la biblioteca `stdio.h`, que contiene las funciones necesarias para realizar operaciones básicas como la entrada y salida de datos.

La función principal del programa se define con `int main()`. Dentro de esta función, el código utiliza la función `printf()` para imprimir "Hola mundo en C" en la pantalla. Finalmente, al usar `return 0;`, el programa indica que ha terminado su ejecución sin errores. 

Este tipo de programa es comúnmente utilizado como un primer ejemplo porque demuestra cómo estructurar un archivo `.c` básico y cómo compilarlo usando el compilador gcc (como se indica en la línea comentada al final del código), generando un ejecutable llamado `ejecutable.out`.

`003-hola mundo en C.c`

```
#include <stdio.h>            // Esto incluye la libreria de entrada y salida

int main(){                   // Esto es la funcion principal
  printf("Hola mundo en C");  // Esto es la salida por consola
  return 0;                   // Esto es la salida de la funcion
}

// gcc 003-hola\ mundo\ en\ C.c -o ejecutable.out
```

### Actividades propuestas

### Actividad 1: Comparar Ejecución Directa vs Compilación

**Descripción:** Los estudiantes deberán analizar y explicar la diferencia entre cómo se ejecutan los scripts en Python (interpretados directamente) y cómo se procesan los programas escritos en C o C++ (necesitan un paso de compilación). Se espera que identifiquen las diferencias clave entre estos dos tipos de lenguajes.

### Actividad 2: Crear una Aplicación Simple en Python

**Descripción:** Los estudiantes deben escribir un programa simple en Python que realice una operación básica (por ejemplo, suma de números). Se espera que comprendan cómo ejecutar este código directamente desde la terminal o un entorno IDE.

### Actividad 3: Entender el Proceso de Compilación

**Descripción:** Los estudiantes deben estudiar el archivo en C y entender las partes clave del mismo (inclusión de bibliotecas, función main). A continuación, deberán describir cómo se compila y ejecuta este código utilizando GCC. Se espera que comprendan los comandos necesarios para este proceso.

### Actividad 4: Comparativa Markdown

**Descripción:** Los estudiantes deben analizar los archivos .md en la carpeta y resumir las diferencias entre el funcionamiento de Python y C/C++ desde una perspectiva de obtención del código ejecutable. Se espera que realicen un breve resumen.

### Actividad 5: Estructura Básica de un Programa en C

**Descripción:** Los estudiantes deben crear su propio programa simple en C, siguiendo la estructura básica presentada en el ejemplo (inclusión de bibliotecas y definición de main). Se espera que comprendan cómo organizar un archivo .c.

### Actividad 6: Ejecutar Programa C

**Descripción:** Los estudiantes deben compilar e implementar el programa C proporcionado y verificar que se ejecuta correctamente. Deben documentar los comandos empleados para la compilación y la ejecución del código. Se espera que comprendan cómo interactuar con GCC.

### Actividad 7: Explicación del Flujo de Trabajo

**Descripción:** Los estudiantes deben describir, en sus propias palabras, el flujo de trabajo desde escribir un programa hasta su ejecución para ambos lenguajes (Python y C). Se espera que comprendan los pasos necesarios en cada caso.

### Actividad 8: Crear Documentación Markdown

**Descripción:** Los estudiantes deben crear una breve descripción del proceso de compilación y ejecución de un archivo .c, utilizando markdown. Se espera que incluyan ejemplos de comandos y explicaciones claras sobre el uso de herramientas como GCC.

### Actividad 9: Comparación Detallada

**Descripción:** Los estudiantes deben realizar una comparativa detallada entre Python e C en términos de creación y ejecución del código. Se espera que identifiquen ventajas y desventajas de cada método, basándose en los ejemplos proporcionados.

### Actividad 10: Mejora Propia del Código

**Descripción:** Los estudiantes deben tomar el programa C existente e implementar mejoras o añadir funcionalidades propias. Se espera que comprendan cómo integrar y utilizar nuevas características dentro de un código compilado en C, usando GCC para la compilación.

Estas actividades están diseñadas para ayudar a los estudiantes a comprender las diferencias fundamentales entre lenguajes interpretados y compilados, así como proporcionarles una base sólida sobre el proceso de obtención del código ejecutable.


<a id="metodologias-agiles-tecnicas-caracteristicas"></a>
## Metodologías ágiles. Técnicas. Características

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/001-Desarrollo%20de%20software/007-Metodolog%C3%ADas%20%C3%A1giles.%20T%C3%A9cnicas.%20Caracter%C3%ADsticas)

### Introducción a los ejercicios

Este conjunto de ejercicios se centra en introducir y aplicar conceptos básicos de las metodologías ágiles en el desarrollo de software. El objetivo principal es enseñarte cómo facilitar la colaboración en equipos y cómo implementar un proceso de desarrollo iterativo, lo que mejora significativamente la eficiencia y la adaptabilidad del trabajo en proyectos de programación. A través de estos ejercicios, aprenderás a gestionar proyectos más efectivamente tanto individualmente como en equipo, reduciendo así las dificultades típicas asociadas con el desarrollo software colaborativo.

### Actividades propuestas

1. **Introducción a Metodologías Ágiles**
   - **Descripción**: Los estudiantes deben investigar y presentar las metodologías ágiles más comunes, como Scrum y Kanban, para entender cómo facilitan el trabajo en equipo y el desarrollo iterativo.
   - **Objetivo**: Familiarizarse con los principios básicos de las metodologías ágiles y su aplicación en proyectos de programación.

2. **Juego del Entorno Ágil**
   - **Descripción**: Organizar un juego simulado donde los estudiantes participen como equipo en una iteración Scrum, asignando tareas y haciendo revisión final.
   - **Objetivo**: Aprender a trabajar colaborativamente usando técnicas ágiles para mejorar la eficiencia del desarrollo de software.

3. **Creación de un Tablero Kanban**
   - **Descripción**: Los estudiantes deben crear un tablero Kanban digital o físico, asignando tareas y monitoreándolas durante varias iteraciones.
   - **Objetivo**: Entender cómo visualizar el progreso del trabajo y mejorar la gestión del proyecto.

4. **Análisis de Casos de Uso Ágiles**
   - **Descripción**: Analizar casos prácticos donde las metodologías ágiles han sido exitosas o no en diferentes proyectos.
   - **Objetivo**: Identificar ventajas e inconvenientes de la implementación de métodos ágiles y aprender a adaptarlos según las necesidades del proyecto.

5. **Desafío del Sprint**
   - **Descripción**: Los estudiantes trabajan en grupos para planificar un sprint, establecer metas y evaluar su progreso.
   - **Objetivo**: Aprender cómo definir objetivos claros y alcanzables, así como gestionar el tiempo durante los sprints.

6. **Reflexión sobre Trabajo Individual vs. Colaborativo**
   - **Descripción**: Escribir un ensayo comparando la gestión de proyectos cuando se trabaja en solitario versus en equipo.
   - **Objetivo**: Reflexionar sobre las diferencias y ventajas entre trabajar individualmente y en equipo, basado en experiencias prácticas.

7. **Juego de Rol: Scrum Master vs. Desarrollador**
   - **Descripción**: Los estudiantes representan el papel de Scrum Masters o desarrolladores en una situación realista del desarrollo de software.
   - **Objetivo**: Mejorar habilidades de comunicación y resolución de problemas en un entorno ágil.

8. **Desafío Iterativo: Mejora Continua**
   - **Descripción**: A lo largo de varias semanas, los estudiantes deben mejorar continuamente un proyecto, utilizando retroalimentación del equipo.
   - **Objetivo**: Practicar la mejora continua y adaptarse a cambios rápidos en el desarrollo de software.


<a id="ejercicio-de-final-de-unidad"></a>
## Ejercicio de final de unidad

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/001-Desarrollo%20de%20software/101-Ejercicio%20de%20final%20de%20unidad)

### Introducción a los ejercicios

El conjunto de ejercicios en esta carperta está diseñado para ayudarte a consolidar tus conocimientos sobre el desarrollo de software, enfocándose especialmente en la estructuración y organización del trabajo en entornos de desarrollo. El único archivo proporcionado, "001-actividad.md", es un documento markdown que contiene una serie de tareas relacionadas con la creación de código limpio, la gestión efectiva de archivos y directorios, así como el uso de herramientas y prácticas recomendadas en el ámbito del desarrollo de software. A través de esta actividad, practicarás habilidades cruciales como la resolución de problemas, la organización y la documentación clara de tu trabajo.

### Actividades propuestas

Basándome en los contenidos y contextos que has proporcionado, aquí tienes una lista de propuestas de actividades para estudiantes de Formación Profesional, adecuadas al nivel de dificultad y tipo de ejercicios del archivo proporcionado. Como no se ha incluido el contenido específico de `001-actividad.md`, he inferido actividades generales que podrían ser apropiadas para un entorno de desarrollo en programación orientada a estudiantes de primer curso.

1. **Análisis de Requisitos**
   - **Descripción:** Los alumnos deben analizar y documentar los requisitos funcionales y no funcionales de una aplicación propuesta. Se espera que identifiquen las necesidades del usuario, restricciones técnicas y objetivos de la aplicación.

2. **Diseño Estructural**
   - **Descripción:** En esta actividad, se pide a los estudiantes diseñar la estructura básica (clases, métodos, etc.) de una pequeña aplicación utilizando un lenguaje específico. Se espera que comprendan cómo organizar el código para mejorar su legibilidad y mantenibilidad.

3. **Programación Orientada a Objetos**
   - **Descripción:** Los estudiantes implementarán clases y objetos en un proyecto simple, aplicando conceptos de encapsulamiento, herencia y polimorfismo. La actividad busca consolidar la comprensión de los principios básicos del paradigma orientado a objetos.

4. **Manejo de Errores**
   - **Descripción:** Los alumnos deben incorporar mecanismos para manejar excepciones en sus programas, asegurando que el programa pueda continuar funcionando correctamente incluso ante fallos inesperados. Se enfatiza la importancia del control y tratamiento adecuado de errores.

5. **Testing Unitario**
   - **Descripción:** Los estudiantes escribirán pruebas unitarias para las clases y métodos desarrollados en actividades anteriores, utilizando frameworks como JUnit o PyTest. La actividad busca introducir los principios básicos del testing TDD (Test-Driven Development).

6. **Documentación de Código**
   - **Descripción:** En esta tarea, se pide a los alumnos documentar sus clases y métodos con comentarios claros y coherentes, así como escribir una guía rápida para el uso correcto del código generado. Se busca mejorar la habilidad de comunicación técnica.

7. **Optimización del Código**
   - **Descripción:** Los estudiantes deben revisar y optimizar su código para reducir complejidad y aumentar eficiencia, manteniendo en todo momento la legibilidad y el mantenimiento del mismo. La actividad busca fomentar prácticas de codificación limpias.

8. **Revisión Colaborativa**
   - **Descripción:** En grupos, los alumnos revisarán el código de sus compañeros buscando errores, mejoras de estilo y sugerencias para la implementación de nuevas características. Esta actividad promueve la retroalimentación constructiva en un ambiente colaborativo.

Cada una de estas actividades está diseñada para complementar las habilidades aprendidas a lo largo del curso, asegurando que los estudiantes no solo comprendan teóricamente sino también apliquen prácticamente los conceptos clave del desarrollo software.



<a id="instalacion-y-uso-de-entornos-de-desarrollo"></a>
# Instalación y uso de entornos de desarrollo

<a id="funciones-de-un-entorno-de-desarrollo"></a>
## Funciones de un entorno de desarrollo

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/002-Instalaci%C3%B3n%20y%20uso%20de%20entornos%20de%20desarrollo/001-Funciones%20de%20un%20entorno%20de%20desarrollo)

### Introducción a los ejercicios

Este conjunto de ejercicios se centra en la comprensión y configuración de entornos de desarrollo adecuados para programar. Los estudiantes aprenderán a identificar los componentes clave de un sistema informático, como el hardware y el Sistema Operativo (SSOO), y cómo estos influyen en la eficiencia del proceso de desarrollo de software. Además, se exploran las diferentes aplicaciones o editores que pueden utilizarse para escribir código y sus características más importantes, tales como la coloración del código, la funcionalidad de compilación e interpretación, así como la integración con ayudas y extensiones. Estos ejercicios ayudarán a los estudiantes a desarrollar competencias en la elección y configuración óptima de entornos de desarrollo para proyectos de programación.

### Actividades propuestas

### Actividad 1: Configuración del Entorno de Desarrollo Personal

**Descripción:** Los estudiantes deben configurar su entorno de desarrollo preferido en sus sistemas operativos (Windows, macOS o Linux). La actividad consiste en instalar un editor de código y configurarlo para que sea funcional. Se pretende que aprendan a entender las necesidades básicas de hardware y software para desarrollar software eficientemente.

### Actividad 2: Comparación de Sistemas Operativos

**Descripción:** Los estudiantes deben investigar y comparar ventajas e inconvenientes del desarrollo de software en Windows, macOS y Linux. Se pretende que aprendan las características específicas de cada sistema operativo que faciliten o dificulten el trabajo de programación.

### Actividad 3: Selección de Un Editor de Código

**Descripción:** Los estudiantes deben elegir un editor de código basándose en las funcionalidades descritas (colorado del código, capacidad para compilar y ejecutar, entre otras) y justificar por qué es el más adecuado para su tipo de trabajo. Se pretende que aprendan a seleccionar herramientas que les ayuden eficientemente.

### Actividad 4: Análisis de Requisitos Mínimos

**Descripción:** Los estudiantes deben investigar y comparar los requisitos mínimos recomendados (hardware y software) para el desarrollo en cada sistema operativo. Se pretende que comprendan cómo estos requisitos afectan la eficiencia del proceso de programación.

### Actividad 5: Creación de Documentación

**Descripción:** Los estudiantes deben crear una guía rápida para configurar su entorno de desarrollo, incluyendo pasos detallados sobre la instalación y configuración del editor de código elegido. Se pretende que aprendan a documentar los procesos técnicos de manera clara y útil.

### Actividad 6: Evaluación de Herramientas Complementarias

**Descripción:** Los estudiantes deben investigar y probar diferentes complementos o plugins para su editor de código preferido, evaluando cómo mejoran la eficiencia en tareas como la detección de errores, el control de versiones, etc. Se pretende que descubran las ventajas de utilizar herramientas adicionales.

### Actividad 7: Resolución de Problemas Técnicos

**Descripción:** Los estudiantes deben buscar y resolver al menos dos problemas comunes en la configuración del entorno de desarrollo (por ejemplo, errores de instalación o conflictos entre diferentes aplicaciones). Se pretende que aprendan a manejar y solucionar situaciones técnicas de manera autónoma.

### Actividad 8: Optimización del Entorno

**Descripción:** Los estudiantes deben proponer mejoras para optimizar su entorno de desarrollo, considerando aspectos como la velocidad de compilación o la gestión eficiente de proyectos. Se pretende que aprendan a adaptar y mejorar continuamente sus herramientas según sus necesidades.

### Actividad 9: Documentación Colectiva

**Descripción:** Los estudiantes trabajan en grupo para crear una guía colectiva sobre cómo configurar un entorno de desarrollo óptimo, compartiendo consejos y recomendaciones. Se pretende que aprendan a colaborar en la creación de documentación técnica y a intercambiar ideas entre compañeros.

### Actividad 10: Presentación del Entorno de Desarrollo

**Descripción:** Los estudiantes deben preparar una presentación corta sobre su entorno de desarrollo personal, incluyendo detalles técnicos y experiencias personales. Se pretende que aprendan a comunicar eficazmente conceptos técnicos a un público no especializado en informática.


<a id="instalacion-de-un-entorno-de-desarrollo"></a>
## Instalación de un entorno de desarrollo

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/002-Instalaci%C3%B3n%20y%20uso%20de%20entornos%20de%20desarrollo/002-Instalaci%C3%B3n%20de%20un%20entorno%20de%20desarrollo)

### Introducción a los ejercicios

En esta carpeta, encontrarás ejercicios destinados a guiar a los estudiantes a través del proceso de instalación y configuración de dos importantes entornos de desarrollo: Visual Studio Code y NetBeans. Estos ejercicios buscan familiarizarte con la descarga e instalación de software esencial para el desarrollo de aplicaciones en diferentes lenguajes, enfatizando la importancia de tener un ambiente de trabajo adecuado desde el principio. Al completar estos ejercicios, mejorarás tus habilidades en la gestión del entorno de desarrollo y comprenderás mejor los requisitos técnicos necesarios para comenzar a programar eficazmente.

### Actividades propuestas

### Actividad 1: Instalar y Configurar Visual Studio Code

**Descripción:** El estudiante debe instalar Visual Studio Code desde la página oficial, ejecutar el instalador y configurar algunas extensiones básicas como ESLint para JavaScript. Se espera que los estudiantes comprendan cómo descargar e instalar software de desarrollo.

### Actividad 2: Instalar y Configurar NetBeans

**Descripción:** Los estudiantes deben descargarse e instalar NetBeans desde la página oficial, además de configurar su entorno básico para el desarrollo en Java. Esta actividad permitirá a los alumnos familiarizarse con un IDE especializado en Java.

### Actividad 3: Comparación entre Visual Studio Code y NetBeans

**Descripción:** Los estudiantes deben comparar las características básicas de Visual Studio Code y NetBeans, considerando aspectos como la facilidad de instalación, configuración inicial, soporte para distintos lenguajes de programación y funcionalidades específicas. Se espera que adquieran una comprensión crítica sobre los diferentes IDEs.

### Actividad 4: Crear un Proyecto en Visual Studio Code

**Descripción:** Los estudiantes deben crear y estructurar un proyecto básico utilizando Visual Studio Code, incluyendo la configuración de rutas para el código fuente y archivos de salida. Esto ayudará a entender cómo funciona la gestión de proyectos con este IDE.

### Actividad 5: Crear una Aplicación Básica en NetBeans

**Descripción:** Los alumnos deben crear e implementar un programa sencillo utilizando NetBeans, como por ejemplo un formulario básico o un juego simple. Esto les permitirá familiarizarse con la creación de proyectos y el uso de funcionalidades básicas del IDE.

### Actividad 6: Creación de Extensiones en Visual Studio Code

**Descripción:** Los estudiantes deben investigar e instalar extensiones útiles en Visual Studio Code para mejorar su productividad, como Live Server o ESLint. Se espera que comprendan la importancia y utilidad de las extensiones en un IDE.

### Actividad 7: Manejo de Proyectos Java con NetBeans

**Descripción:** Los estudiantes deben aprender a manejar proyectos completos en NetBeans, incluyendo la creación de clases, paquetes y la ejecución de pruebas unitarias. Esto les permitirá comprender cómo se organiza el trabajo en un IDE orientado a Java.

### Actividad 8: Resolución de Problemas Técnicos

**Descripción:** Los estudiantes deben resolver problemas comunes que surgen durante la instalación o configuración de Visual Studio Code y NetBeans, utilizando recursos como foros de ayuda, documentación oficial y tutoriales en línea. Se espera que desarrollen habilidades para autodiagnóstico y resolución de problemas.

### Actividad 9: Configuración Avanzada

**Descripción:** Los estudiantes deben configurar características avanzadas en ambos IDEs, tales como la integración con controladores de versiones (Git), sistemas de construcción (Maven o Gradle para NetBeans) y otras herramientas que mejoren su flujo de trabajo. Esto les permitirá optimizar sus entornos de desarrollo.

### Actividad 10: Crear Documentación del Entorno de Desarrollo

**Descripción:** Los estudiantes deben documentar el proceso de instalación, configuración e inicialización de Visual Studio Code y NetBeans, incluyendo la resolución de problemas encontrados y las extensiones o características que utilizan. Esto les permitirá consolidar sus conocimientos en un formato accesible para otros alumnos o compañeros de trabajo.


<a id="uso-basico-de-un-entorno-de-desarrollo"></a>
## Uso básico de un entorno de desarrollo

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/002-Instalaci%C3%B3n%20y%20uso%20de%20entornos%20de%20desarrollo/003-Uso%20b%C3%A1sico%20de%20un%20entorno%20de%20desarrollo)

### Introducción a los ejercicios

Este conjunto de ejercicios está diseñado para que los estudiantes inicien su experiencia en el uso de entornos de desarrollo integrados (IDE) específicamente en Visual Studio Code. El ejercicio se centra en aprender cómo configurar y utilizar las herramientas básicas del IDE, como la instalación de intérpretes de lenguaje, la creación de archivos de código y la incorporación de extensiones para mejorar la funcionalidad. Los estudiantes practicarán competencias fundamentales como la gestión del entorno de desarrollo, la detección y corrección de errores básicos en sintaxis y el uso de asistentes de codificación avanzada.

### Actividades propuestas

### Actividad 1: Configuración del Entorno de Desarrollo Integrado (IDE)
**Descripción:** Configurar un entorno de desarrollo integrado para Python, incluyendo la instalación del intérprete y las extensiones necesarias. Se pretende que los alumnos comprendan cómo configurar correctamente su IDE para optimizar el proceso de programación.

### Actividad 2: Creación de Proyectos
**Descripción:** Los estudiantes deben crear un proyecto nuevo en Visual Studio Code, incluyendo la creación de un archivo `.py`. Se busca que aprendan a organizar y estructurar sus proyectos correctamente desde el inicio.

### Actividad 3: Uso del Asistente Copilot
**Descripción:** Configurar y usar Copilot dentro de Visual Studio Code para generar código automático. Los estudiantes deben aprender a integrar herramientas de inteligencia artificial en su flujo de trabajo de desarrollo.

### Actividad 4: Ejecución Básica de Código
**Descripción:** Ejecutar el primer programa Python en el IDE, observando cómo se muestra la estructura del proyecto y cómo funciona el botón de ejecución. Los alumnos deben entender los pasos básicos para correr código directamente desde su entorno de desarrollo.

### Actividad 5: Herramientas de Detección de Errores
**Descripción:** Utilizar las herramientas incorporadas en el IDE para identificar y corregir errores de sintaxis. Se busca mejorar la habilidad de los estudiantes en la depuración temprana del código.

### Actividad 6: Integración con Control de Versiones (GitHub)
**Descripción:** Configurar y usar GitHub dentro de Visual Studio Code para controlar las versiones de su proyecto Python. Los alumnos deben aprender a integrar el control de versiones en sus proyectos desde el inicio.

### Actividad 7: Documentación Automática
**Descripción:** Usar extensiones que generen automáticamente la documentación del código, lo cual ayuda a mejorar la legibilidad y mantenibilidad del mismo. Se pretende fomentar buenas prácticas de documentación temprana en los estudiantes.

### Actividad 8: Resolución de Problemas con Copilot
**Descripción:** Resolver un problema común de programación utilizando la función Copilot para obtener sugerencias o soluciones, mostrando cómo esta herramienta puede ayudar a acelerar el proceso de desarrollo y resolución de problemas.


<a id="personalizacion-del-entorno-de-desarrollo-temas-estilos-de-codificacion-modulos-y-extensiones-entre-otras"></a>
## Personalización del entorno de desarrollo temas, estilos de codificación, módulos y extensiones, entre otras

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/002-Instalaci%C3%B3n%20y%20uso%20de%20entornos%20de%20desarrollo/004-Personalizaci%C3%B3n%20del%20entorno%20de%20desarrollo%20temas%2C%20estilos%20de%20codificaci%C3%B3n%2C%20m%C3%B3dulos%20y%20extensiones%2C%20entre%20otras)

### Introducción a los ejercicios

El conjunto de ejercicios en esta carpeta se enfoca en la personalización del entorno de desarrollo, específicamente utilizando Visual Studio Code. Los estudiantes aprenderán a ajustar aspectos visuales como los temas de color y el tamaño del texto para mejorar la comodidad y eficiencia al programar. Este trabajo implica habilidades de navegación por el IDE y configuración básica, enfatizando la importancia de mantenerse concentrado en adquirir conocimientos sobre programación mientras se personalizan las herramientas.

### Actividades propuestas

### Actividades Propuestas:

1. **Configuración Básica del Entorno**
   - Los estudiantes deben configurar el entorno de desarrollo para cambiar el tema por defecto a uno con un color de fondo más claro o oscuro, según su preferencia.
   - Objetivo: Aprender a personalizar y mejorar la ergonomía del entorno de desarrollo.

2. **Ajuste de Zoom**
   - Los estudiantes deben aprender cómo aumentar o disminuir el tamaño del texto en Visual Studio Code utilizando las combinaciones de teclas dadas.
   - Objetivo: Mejorar la visibilidad y comodidad al trabajar con códigos largos.

3. **Personalización Avanzada**
   - Los estudiantes deben explorar cómo cambiar la fuente y el tamaño del texto dentro del editor, no solo en la interfaz general.
   - Objetivo: Aprender a adaptar el entorno de desarrollo para un mayor confort y eficiencia al programar.

4. **Guía Rápida**
   - Los estudiantes deben crear una guía rápida que incluya los pasos básicos para personalizar Visual Studio Code con ajustes recomendados.
   - Objetivo: Fomentar la documentación de procedimientos y compartir conocimiento entre compañeros.

5. **Comparativa Temáticas**
   - Los estudiantes deben probar diferentes temas disponibles en el marketplace de VSCode y elegir su preferido, explicando por qué lo prefieren.
   - Objetivo: Familiarizarse con las diversas opciones estéticas y cómo impactan la productividad del programador.

6. **Extensiones Útiles**
   - Los estudiantes deben investigar y probar al menos una extensión de VSCode que ayude a mejorar su eficiencia, como Live Server para HTML o Prettier.
   - Objetivo: Aprender sobre las utilidades adicionales proporcionadas por la comunidad.

7. **Mejores Prácticas**
   - Los estudiantes deben redactar un breve informe (2-3 párrafos) describiendo las mejores prácticas para personalizar el entorno de desarrollo sin perderse en configuraciones innecesarias.
   - Objetivo: Desarrollar habilidades de análisis y documentación, evitando distracciones no relacionadas con la programación.

8. **Configuración Compartida**
   - Los estudiantes deben compartir sus archivos `.vscode` personalizados para que otros puedan copiar su configuración.
   - Objetivo: Aprender a colaborar y mejorar mutuamente en el uso del entorno de desarrollo.

9. **Resolución Problemas**
   - Los estudiantes deben presentar una solución a un problema común de Visual Studio Code, como problemas con la sincronización de archivos o errores al instalar extensiones.
   - Objetivo: Mejorar las habilidades de resolución de problemas y comunicación técnica.

10. **Evaluación Personal**
    - Los estudiantes deben evaluar en una escala del 1-5 (donde 5 es el más alto) cómo les ha mejorado la productividad después de personalizar VSCode.
    - Objetivo: Reflexionar sobre las ventajas y desventajas de personalizar un entorno de desarrollo.


<a id="edicion-de-programas"></a>
## Edición de programas

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/002-Instalaci%C3%B3n%20y%20uso%20de%20entornos%20de%20desarrollo/005-Edici%C3%B3n%20de%20programas)

### Introducción a los ejercicios

Esta carpeta contiene ejercicios diseñados para introducir a los estudiantes al uso y configuración de entornos de desarrollo, específicamente enfocándose en la edición de programas utilizando herramientas como Visual Studio Code. Se destacan las capacidades auxiliares proporcionadas por tecnologías de inteligencia artificial (IA) integradas en estos entornos, aunque se subraya la importancia del aprendizaje autónomo y práctico sobre el mero uso de estas herramientas. Los ejercicios incluyen tanto conceptos básicos de programación con Python como reflexiones sobre las implicaciones éticas y pedagógicas del empleo de IA en desarrollo.

### construyo un programa
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código en Python tiene dos partes principales: la iteración por los días del mes y una verificación para determinar si alguien es mayor de edad.

Primero, el código itera a través de todos los días desde el 1 hasta el 31 (aunque incluye hasta el día 32, lo cual no se cumplirá nunca). En cada iteración del bucle `for`, la variable `dia` toma un valor que va desde 1 hasta 31. Dentro del ciclo, imprime una frase que indica qué día es.

Luego, el código verifica si una persona es mayor de edad basándose en su edad. Se establece la variable `edad` con el valor 18 y se utiliza una estructura condicional `if-else`. Si la edad es igual o superior a 18 años, imprime "Eres mayor de edad". De lo contrario, imprime "Eres menor de edad".

Este tipo de código es fundamental para entender cómo iterar sobre secuencias y realizar comprobaciones condicionales en Python, dos conceptos básicos que son cruciales para programar cualquier aplicación.

`001-construyo un programa.py`

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

### Actividades propuestas

### Actividad 1: Instalación y Configuración del Entorno de Desarrollo
**Descripción:** Los estudiantes deben instalar Visual Studio Code en sus computadoras e importar un proyecto existente para familiarizarse con la interfaz. Se espera que aprendan a configurar su entorno de desarrollo para trabajar eficientemente.

### Actividad 2: Creación y Ejecución de Scripts Básicos
**Descripción:** Los estudiantes deben crear archivos .py simples en Visual Studio Code y ejecutarlos para entender el flujo básico del programa. El objetivo es que aprendan a escribir e implementar código Python básico.

### Actividad 3: Uso del Editor de Código Para Edición Simple
**Descripción:** En esta actividad, los estudiantes deben abrir un archivo .py existente en Visual Studio Code y realizar cambios simples (como cambiar mensajes de texto). Se espera que aprendan a navegar y editar código utilizando la interfaz de VSCode.

### Actividad 4: Iteración en Bucle For
**Descripción:** Los estudiantes deben escribir un bucle for similar al mostrado en el ejemplo, pero para iterar sobre una lista personalizada (por ejemplo, nombres de meses del año). El objetivo es que comprendan cómo usar bucles for en Python.

### Actividad 5: Condiciones If y Operadores Lógicos
**Descripción:** Los estudiantes deben escribir un programa que determine si un número ingresado por el usuario es par o impar utilizando una estructura condicional. Se espera que aprendan a utilizar condiciones if-else y operadores lógicos en Python.

### Actividad 6: Integración de Copilot en Proyectos
**Descripción:** Los estudiantes deben aprender a usar la función de asistente de IA (Copilot) en Visual Studio Code para sugerir código o ayudar en la resolución de problemas. El objetivo es que entiendan cómo utilizar herramientas de IA como apoyo, pero no como reemplazo del aprendizaje.

### Actividad 7: Edición y Mejora de Ejemplos Proporcionados
**Descripción:** Los estudiantes deben tomar el código proporcionado en "001-construyo un programa.py" y mejorar o extender sus funcionalidades (por ejemplo, añadir una estructura condicional dentro del bucle for). Se espera que aprendan a modificar y expandir programas existentes.

### Actividad 8: Documentación de Código con Markdown
**Descripción:** Los estudiantes deben escribir un archivo .md explicando en detalle cómo funciona el código proporcionado, incluyendo comentarios y descripciones de cada sección. El objetivo es que comprendan la importancia de documentar el código para mejorar su legibilidad.

### Actividad 9: Creación de Proyectos Simples con Control de Versiones
**Descripción:** Los estudiantes deben aprender a utilizar Git para gestionar un proyecto simple (por ejemplo, el código proporcionado) y entender cómo usar control de versiones. El objetivo es que aprendan la importancia del control de versiones en proyectos de programación.

### Actividad 10: Análisis Crítico de Herramientas de IA
**Descripción:** Los estudiantes deben redactar un breve análisis sobre el uso y las implicaciones éticas del uso de herramientas como Copilot en el desarrollo de software. Se espera que comprendan la importancia de usar estas tecnologías sabiamente y no depender demasiado de ellas para su aprendizaje personal.


<a id="generacion-de-ejecutables-en-distintos-entornos"></a>
## Generación de ejecutables en distintos entornos

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/002-Instalaci%C3%B3n%20y%20uso%20de%20entornos%20de%20desarrollo/006-Generaci%C3%B3n%20de%20ejecutables%20en%20distintos%20entornos)

### Introducción a los ejercicios

En esta carpeta se encuentran ejercicios orientados a la instalación y uso de entornos de desarrollo para crear y ejecutar programas simples, específicamente en lenguaje C. El objetivo principal es familiarizarte con el proceso completo desde la creación del proyecto hasta la generación del ejecutable en un entorno como Visual Studio. Además, se practica cómo configurar herramientas adicionales como Copilot y los compiladores necesarios para garantizar que puedas compilar y ejecutar tu código sin problemas. Estos ejercicios te ayudarán a adquirir competencias esenciales para el desarrollo de software en entornos profesionales.

### ejemplo en C
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es un programa básico escrito en el lenguaje de programación C. La función principal del código es imprimir en la pantalla el mensaje "Hola, mundo!". 

El código comienza con la línea `#include <stdio.h>`, que incluye una biblioteca estándar necesaria para utilizar la función `printf()`. Esta biblioteca proporciona funciones para realizar operaciones de entrada y salida estándar.

La función principal del programa es `main()`, donde se encuentra todo el código ejecutable. Dentro de esta función, la línea `printf("Hola, mundo!\n");` imprime el texto "Hola, mundo!" en la consola o terminal donde esté siendo ejecutado el programa. El símbolo `\n` al final del mensaje indica un salto de línea después de mostrar el mensaje.

Al devolver 0 con `return 0;`, se indica que el programa ha terminado sin errores. Este valor es comúnmente utilizado en programas C para indicar éxito o completitud de la ejecución.

`001-ejemplo en C.c`

```
// Quiero crear un hola mundo en C
#include <stdio.h>

int main() {
    printf("Hola, mundo!\n");
    return 0;
}
```

### Actividades propuestas

1. **Compilación y Ejecución del Código**
   - **Descripción:** Los alumnos deben compilar y ejecutar un programa "Hola, mundo!" en C utilizando Visual Studio. Se espera que comprendan cómo configurar el entorno de desarrollo para la compilación y ejecución de código.

2. **Generación de Archivos Executables**
   - **Descripción:** A partir del ejemplo proporcionado, los estudiantes deben generar un archivo ejecutable (.exe) desde su código en C utilizando Visual Studio. El objetivo es que comprendan el proceso completo de generación de archivos ejecutables en entornos de desarrollo.

3. **Integración con Copilot**
   - **Descripción:** Los alumnos deberán activar y utilizar la función de ayuda de Copilot en Visual Studio durante la creación de un programa sencillo. La idea es familiarizarse con las herramientas que proporcionan asistencia en tiempo real para el desarrollo del código.

4. **Configuración del Complemento Compilador**
   - **Descripción:** Los estudiantes deben configurar manualmente el complemento compilador C/C++ en Visual Studio, tal como se describe en la documentación proporcionada. Este ejercicio ayudará a entender cómo instalar y usar eficazmente los plugins necesarios para el desarrollo.

5. **Primer Ejercicio de Compilación Automática**
   - **Descripción:** Los alumnos deberán realizar un ejercicio que involucre la pulsación del botón "play" en Visual Studio para compilar, ejecutar e inspeccionar el código C automáticamente. El objetivo es entender cómo aprovechar las funcionalidades integradas de los IDEs modernos.

6. **Generación de Documentación Automática**
   - **Descripción:** A partir de un archivo .c proporcionado, se les pedirá a los estudiantes que generen documentación automática (usando herramientas como Doxygen) para comprender cómo funciona el código en C y su estructura.

7. **Trabajo Práctico en Equipos**
   - **Descripción:** Los alumnos trabajarán en equipos para crear varios programas básicos en C, incluyendo la implementación de bucles y condicionales simples, usando Visual Studio como IDE principal. Se fomentará la colaboración y el aprendizaje cooperativo.

8. **Comparativa de Entornos**
   - **Descripción:** Los estudiantes deben comparar y contrastar las características de compilación y ejecución entre dos entornos diferentes (Visual Studio vs. GCC en línea). Este ejercicio ayudará a entender las diferencias funcionales y ventajas de cada uno.

9. **Optimización del Código C**
   - **Descripción:** Los alumnos deberán tomar un programa básico en C, optimizarlo para mejorar su rendimiento o reducir el uso de recursos, utilizando Visual Studio como herramienta principal. Se enfatizará la importancia de la eficiencia en el código.

10. **Documentación y Autoevaluación**
    - **Descripción:** Los estudiantes deben escribir una breve documentación sobre los ejercicios realizados durante esta unidad, incluyendo los desafíos encontrados y cómo los superaron. Este ejercicio es para la reflexión personal y el autoaprendizaje continuo.

Estas actividades buscan cubrir diferentes aspectos del aprendizaje de programación en C utilizando Visual Studio como entorno principal, desde la configuración inicial hasta la optimización y documentación del código.


<a id="herramientas-y-automatizacion"></a>
## Herramientas y automatización

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/002-Instalaci%C3%B3n%20y%20uso%20de%20entornos%20de%20desarrollo/007-Herramientas%20y%20automatizaci%C3%B3n)

### Introducción a los ejercicios

El conjunto de ejercicios en esta carpeta se centra en la comprensión y uso de entornos de desarrollo integrados (IDE) como Visual Studio Code. El objetivo principal es familiarizarse con las herramientas y complementos que estos entornos ofrecen para mejorar la eficiencia del desarrollo de software. Los estudiantes practicarán cómo identificar, buscar y configurar diferentes extensiones dentro del IDE, así como entender su importancia en el proceso de programación.

A través de este ejercicio, se busca desarrollar las competencias en automatización y personalización del entorno de trabajo, habilidades fundamentales para cualquier desarrollador.

### Actividades propuestas

### Actividad 1: Exploración y Configuración de Complementos en Visual Studio Code

**Descripción:** Los estudiantes explorarán la herramienta de complementos en Visual Studio Code para identificar y configurar al menos tres diferentes complementos que mejoren su productividad. Esta actividad busca familiarizar a los alumnos con cómo ampliar las capacidades del IDE (Entorno Integrado de Desarrollo) a través de componentes externos.

---

### Actividad 2: Análisis Comparativo de Complementos

**Descripción:** Los estudiantes compararán al menos tres complementos diferentes en Visual Studio Code, documentando sus funciones y beneficios para la programación. Esta actividad pretende que los alumnos comprendan las diferencias entre distintas herramientas y selecciones basadas en sus necesidades.

---

### Actividad 3: Integración de Herramienta de Control de Versiones

**Descripción:** Los estudiantes instalarán y configurarán un complemento para integrar control de versiones (como Git) en Visual Studio Code. La actividad tiene como objetivo que los alumnos comprendan cómo facilitar la gestión del código fuente a través de herramientas especializadas.

---

### Actividad 4: Configuración Personalizada con JSON

**Descripción:** Los estudiantes personalizarán el entorno de trabajo en Visual Studio Code creando o modificando archivos `settings.json`. La actividad busca que los alumnos aprendan a manejar y personalizar configuraciones complejas para mejorar su eficiencia.

---

### Actividad 5: Creación de Scripts de Tareas Automatizadas

**Descripción:** Los estudiantes crearán scripts en formato `.json` dentro del entorno Visual Studio Code para automatizar tareas comunes, como la ejecución y compilación de proyectos. Esta actividad busca que los alumnos se familiaricen con la automatización de procesos en un IDE.

---

### Actividad 6: Documentación Personalizada

**Descripción:** Los estudiantes crearán una guía personalizada sobre cómo configurar y usar al menos dos complementos en Visual Studio Code, incluyendo instrucciones paso a paso. La actividad tiene como objetivo mejorar las habilidades de documentación y comunicación de los alumnos.

---

### Actividad 7: Resolución de Problemas con Complementos

**Descripción:** Los estudiantes resolverán problemas comunes asociados al uso de complementos en Visual Studio Code, documentando sus soluciones. Esta actividad busca que los alumnos afronten situaciones reales y aprendan métodos para la resolución eficaz de problemas.

---

### Actividad 8: Comparativa con Otros IDEs

**Descripción:** Los estudiantes compararán las herramientas y complementos disponibles en Visual Studio Code con otros entornos de desarrollo, como Eclipse o IntelliJ IDEA. La actividad pretende que los alumnos comprendan la diversidad y especificidades de diferentes IDEs.

---

### Actividad 9: Integración con Servicios Cloud

**Descripción:** Los estudiantes integrarán Visual Studio Code con servicios cloud para el control y gestión del código fuente, documentando el proceso y las ventajas. Esta actividad busca que los alumnos se familiaricen con la interacción entre herramientas de desarrollo y servicios en la nube.

---

### Actividad 10: Presentación de Herramientas Favoritas

**Descripción:** Los estudiantes prepararán una presentación sobre sus complementos favoritos en Visual Studio Code, explicando cómo estos han mejorado su flujo de trabajo. La actividad tiene como objetivo que los alumnos compartan y aprendan de las experiencias de sus compañeros.

---

Estas actividades están diseñadas para proporcionar a los estudiantes una comprensión práctica y profunda del uso de complementos en Visual Studio Code, alineada con el contenido y nivel de dificultad presentes en la carpeta de ejercicios.


<a id="ejercicio-de-final-de-unidad-1"></a>
## Ejercicio de final de unidad

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/002-Instalaci%C3%B3n%20y%20uso%20de%20entornos%20de%20desarrollo/101-Ejercicio%20de%20final%20de%20unidad)

### Introducción a los ejercicios

Esta carpeta contiene un conjunto de ejercicios diseñados para estudiantes del curso DAM (Desarrollo de Aplicaciones Multiplataforma) en el primer año, específicamente enfocados en la instalación y uso de entornos de desarrollo. El ejercicio principal se encuentra en el archivo "001-actividad.md" y está estructurado para que los estudiantes comprendan y apliquen los conocimientos adquiridos durante esta unidad sobre cómo configurar y utilizar herramientas de desarrollo eficientemente. Los problemas trabajados buscan mejorar las competencias en la instalación y configuración de entornos de desarrollo, así como en la gestión del código fuente mediante herramientas como controladores de versiones básicas.

### Actividades propuestas

### Actividades Propuestas:

1. **Análisis de la Documentación**
   - Los estudiantes deben analizar el archivo markdown proporcionado y extraer las principales características del entorno de desarrollo descrito. Se espera que identifiquen los pasos clave para configurar y utilizar este entorno eficazmente.

2. **Guía Práctica de Instalación**
   - Basándose en la información del archivo, cada estudiante debe crear una guía práctica detallada sobre cómo instalar y configurar el entorno de desarrollo correctamente. Se espera que incluyan capturas de pantalla y pasos claros.

3. **Corrección de Errores**
   - Los estudiantes deben identificar posibles errores en la documentación existente (como faltas ortográficas, redundancias o falta de información) y corregirlos para mejorar la guía de instalación.

4. **Comparación de Entornos**
   - Se requiere que los alumnos realicen una comparativa entre el entorno de desarrollo descrito en el archivo y otro similar conocido por ellos. Deben listar las similitudes y diferencias, destacando ventajas e inconvenientes de cada uno.

5. **Tutorial Aprendizaje Basado en Proyectos**
   - Los estudiantes deben crear un tutorial basado en proyectos para enseñar a otros cómo configurar el entorno desde cero hasta ser capaces de desarrollar un pequeño proyecto simple.

6. **Manual de Usuario Interactivo**
   - Se les pide que diseñen una versión interactiva del manual (usando lenguaje HTML y CSS) donde los usuarios puedan interactuar con la documentación, realizar clics para acceder a secciones específicas, etc.

7. **Sesión de Retroalimentación**
   - Cada estudiante presentará su análisis o guía creada al resto del grupo, recibiendo comentarios sobre mejoras potenciales y áreas a mejorar.

8. **Desarrollo de un Modulo Tutorial**
   - Los alumnos deberán seleccionar una parte específica del proceso descrito en el archivo (por ejemplo, configuración avanzada) y desarrollar una sección tutorial más detallada para esta área con ejemplos prácticos.

9. **Sesión de Práctica Independiente**
   - Se propone que los estudiantes dediquen tiempo a configurar el entorno de desarrollo por sí mismos, siguiendo la documentación proporcionada y buscando recursos adicionales online si es necesario.

10. **Reflexión Final sobre Herramientas**
    - Cada estudiante escribirá una reflexión final sobre su experiencia con el entorno de desarrollo y las herramientas aprendidas, incluyendo sus puntos fuertes y áreas para mejorar en términos de habilidades técnicas.



<a id="diseno-y-realizacion-de-pruebas"></a>
# Diseño y realización de pruebas

<a id="planificacion-de-pruebas"></a>
## Planificación de Pruebas

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/003-Dise%C3%B1o%20y%20realizaci%C3%B3n%20de%20pruebas/001-Planificaci%C3%B3n%20de%20Pruebas)

### Introducción a los ejercicios

Esta carpeta contiene ejercicios orientados a la planificación y realización de pruebas en entornos de desarrollo para DAM (Desarrollo de Aplicaciones Multiplataforma). Los archivos incluyen una introducción teórica sobre la importancia de aislar bloques de código para su prueba individual, así como dos ejemplos prácticos que muestran cómo realizar operaciones básicas y cómo encapsular esas operaciones en funciones. A través de estos ejercicios, se practica la comprensión del diseño modular de software y las técnicas básicas de pruebas unitarias.

### operaciones
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código realiza una operación de división entre dos números. En primer lugar, se definen dos variables llamadas `operando1` y `operando2`, que almacenan los valores numéricos 4 y 3 respectivamente. Luego, el programa calcula la división de `operando1` entre `operando2` y guarda el resultado en otra variable llamada `division`. Finalmente, se imprime en pantalla el valor de `division`, que en este caso sería 1.3333333333333333. Este tipo de código es fundamental para entender cómo realizar operaciones matemáticas básicas en Python y cómo manipular datos numéricos dentro de un programa.

`002-operaciones.py`

```python
operando1 = 4 
operando2 = 3
division = operando1/operando2

print(division)
```

### encapsulacion a funcion
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código está diseñado para introducir el concepto de encapsulación en la programación utilizando Python. La idea principal es tomar un pedazo de lógica, en este caso una operación matemática simple como la división, y colocarlo dentro de una función llamada `division`. Sin embargo, hay algunos errores y malas prácticas que debes notar:

1. La función está declarando dos variables locales: `operando1` y `operando2`, pero en realidad solo se espera un parámetro de entrada (`operando`). Esto significa que el segundo argumento nunca se usa realmente.

2. En la línea donde recalibra el valor de `operando1` a 4, está ignorando completamente el primer parámetro de entrada que teóricamente debería usar para realizar la división.

3. La función finalmente realiza una operación matemática simple dividiendo `operando1` entre `operando2`, y devuelve el resultado de esta operación.

4. Al final, hay un `print(division)`. Esto está intentando imprimir la definición de la función en lugar de llamar a la función y mostrar el resultado que devolvería al realizar una división con valores específicos pasados como argumentos.

El propósito correcto de este ejercicio sería pasar dos operandos a la función, permitir que haga la división y luego usar esa función para calcular divisiones diferentes fácilmente. Sin embargo, en su estado actual, no está utilizando correctamente los parámetros proporcionados ni mostrando el resultado esperado al llamar a la función con valores específicos.

`003-encapsulacion a funcion.py`

```python
# encapsular el software en funciones

def division(operando1,operando):
  operando1 = 4 
  operando2 = 3
  division = operando1/operando2
  return division

print(division)
```

### Actividades propuestas

### Actividades Propuestas:

1. **Título:** Comprender la División en Python
   - Descripción: Los estudiantes deben analizar el código proporcionado y explicar cómo se realiza una división entre dos números. Se espera que identifiquen cuál es el operando1, el operando2 y qué salida produce.

2. **Título:** Convertir Código a Markdown
   - Descripción: A partir del código en Python de la carpeta, los estudiantes deben escribir una breve explicación en formato markdown sobre cómo se realiza una división entre dos números enteros.

3. **Título:** Identificar Errores en el Código
   - Descripción: Los alumnos deben revisar el archivo `002-operaciones.py` y identificar cualquier error que puedan encontrar, corrigiéndolo si es necesario y explicando por qué era un problema originalmente.

4. **Título:** Creación de Funciones en Python
   - Descripción: Basándose en el código del archivo `003-encapsulacion a funcion.py`, los estudiantes deben crear una función que tome dos parámetros de entrada y realice la operación de división, devolviendo el resultado.

5. **Título:** Documentar Códigos en Python
   - Descripción: Los estudiantes deben agregar comentarios al código existente (en ambos archivos python) para explicar paso a paso qué hace cada línea del programa.

6. **Título:** Mejora de la Función de División
   - Descripción: A partir del archivo `003-encapsulacion a funcion.py`, los alumnos deben mejorar la función añadiendo validación para evitar divisiones por cero y manejar posibles errores o excepciones.

7. **Título:** Planificación de Pruebas Básicas
   - Descripción: Basándose en el contenido del archivo `001-Introduccion.md`, los estudiantes deben elaborar una breve planificación sobre cómo probarían la función de división creada en la actividad anterior, incluyendo diferentes casos de prueba.

8. **Título:** Comparación de Estilos de Código
   - Descripción: Los alumnos deben comparar y discutir las diferencias entre los estilos de codificación mostrados en `002-operaciones.py` vs `003-encapsulacion a funcion.py`, argumentando cuál consideran más adecuado según el contenido del archivo markdown.

9. **Título:** Explicación de Encapsulamiento
   - Descripción: Los estudiantes deben escribir un breve texto explicativo en markdown sobre qué es el encapsulamiento en programación y cómo se aplica en la función creada, basándose en lo aprendido desde `001-Introduccion.md`.

10. **Título:** Diseño de Pruebas Unitarias
    - Descripción: A partir del contenido de introducción a las pruebas, los alumnos deben diseñar pruebas unitarias utilizando un framework de pruebas (como pytest) para asegurar que la función de división funcione correctamente en diferentes situaciones.


<a id="tipos-de-pruebas-funcionales-estructurales-y-regresion-entre-otras"></a>
## Tipos de pruebas Funcionales, estructurales y regresión, entre otras

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/003-Dise%C3%B1o%20y%20realizaci%C3%B3n%20de%20pruebas/002-Tipos%20de%20pruebas%20Funcionales%2C%20estructurales%20y%20regresi%C3%B3n%2C%20entre%20otras)

### Introducción a los ejercicios

Esta carpeta contiene una serie de ejercicios en Python que buscan familiarizarte con diferentes tipos de pruebas funcionales y estructurales. Los ejercicios inician presentando una función básica para realizar operaciones matemáticas simples y progresan hasta incluir múltiples casos y manejo de errores. A través de estos ejemplos, practicarás cómo ampliar la funcionalidad existente, gestionar parámetros adicionales y asegurar que tu código sea robusto ante diversas situaciones. Esto te permitirá entender mejor cómo realizar pruebas regresivas para mantener la compatibilidad con versiones anteriores del software mientras introduces nuevas características o correcciones de errores.

### regresion
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código define una función llamada `operacionMatematica` que toma dos argumentos numéricos, `operando1` y `operando2`. Dentro de la función, se suman estos dos operandos y el resultado es almacenado en una variable llamada `suma`. La función luego devuelve el valor de esta suma.

Después de definir la función, hay una línea que llama a la función `operacionMatematica` con los valores 1 y 2 como argumentos. El resultado devuelto por la función (que es 3 en este caso) se imprime en la consola usando la función `print`.

Este código simple demuestra cómo definir funciones, sumar números y llamar a funciones para obtener un resultado específico, lo cual son conceptos fundamentales en la programación con Python.

`001-regresion.py`

```python
def operacionMatematica(operando1,operando2):
  suma = operando1 + operando2;
  return suma
  
print(operacionMatematica(1,2))
```

### aumento la capacidad
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

El código que has proporcionado define una función llamada `operacionMatematica` en Python. Esta función toma tres argumentos: dos operandos (`operando1` y `operando2`) y un tipo de operación (`operacion`). La función se encarga de realizar operaciones matemáticas básicas como la suma o la resta según el valor que reciba en el parámetro `operacion`. Si el parámetro es "suma", la función suma los dos operandos y devuelve el resultado. Si es "resta", realiza la resta entre ellos y retorna también este resultado.

En el código, después de definir la función, hay dos llamadas a esta función con diferentes argumentos para ilustrar cómo se usan. La primera llamada `operacionMatematica(1,2,"suma")` debería imprimir el número 3 en la consola porque suma los números 1 y 2. Sin embargo, la segunda llamada solo proporciona dos operandos sin especificar una operación (es decir, falta un argumento). Esto provocaría un error al ejecutar el programa debido a que se esperan tres parámetros pero se proporcionan solo dos.

Es importante tener en cuenta que para evitar errores como este durante las pruebas del código, es crucial asegurarse de que todas las funciones reciban los argumentos correctos y adecuados.

`002-aumento la capacidad.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código define una función llamada `operacionMatematica` que realiza operaciones matemáticas básicas como suma y resta entre dos números. La función acepta tres parámetros: dos operandos (`operando1`, `operando2`) y un tercer parámetro opcional (`operacion`) que indica qué tipo de operación se va a realizar.

Si el valor del tercer parámetro es "suma", la función suma los dos primeros parámetros y devuelve el resultado. Si en cambio, el valor del tercer parámetro es "resta", resta el segundo parámetro del primero y devuelve este resultado.

Además de definir la función, se ejecutan tres llamadas a esta misma función con diferentes valores para probar su funcionamiento. La primera ejecución realiza una suma (1 + 2) y la segunda hace una resta (1 - 2). En la tercera ejecución, no se especifica ninguna operación, lo que podría causar un problema si la función no maneja adecuadamente este caso de uso.

Es importante notar que el código actual falta en proporcionar un manejo para cuando no se especifique ningún tipo de operación, lo cual sería útil para evitar errores y mejorar la robustez del programa.

`003-arreglo para version anterior.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código define una función llamada `operacionMatematica` que realiza operaciones matemáticas básicas como suma, resta, multiplicación y división. La función recibe tres parámetros: dos operandos (`operando1` y `operando2`) y un tipo de operación (`operacion`). El tercer parámetro tiene un valor por defecto (`None`), lo que significa que si no se proporciona una operación, la función asume que el usuario quiere realizar alguna acción predeterminada o devolver un resultado específico.

La función contiene condicionales (if, elif y else) para determinar qué tipo de operación matemática debe realizar. Por ejemplo, si `operacion` es "suma", se suman los dos operandos; si es "resta", se restan; si es "multiplicacion", se multiplican; y si es "division", se dividen. Sin embargo, hay un error en la función: cuando debería realizar una división, resta incorrectamente los operando2 a operando1 en lugar de dividirlos.

Al final del código, se ejecutan tres llamadas a esta función para demostrar diferentes casos: dos llamados con especificar tipo de operación (suma y resta) y un llamado sin especificar ninguna operación. Esto demuestra cómo la función maneja diferentes situaciones según los parámetros que recibe.

Es importante notar que el caso de división tiene un error en la implementación, ya que debería ser una operación de tipo "division" pero está usando el signo de resta (`-`) en lugar del de división (`/`).

`004-controlo todos los casos posibles.py`

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

### Actividades propuestas

### Actividad 1: Implementación Básica de Operaciones Matemáticas

**Descripción:** Los estudiantes deben crear una función que realice la suma de dos números. La actividad se centra en introducir los conceptos básicos de definir funciones y operaciones matemáticas simples.

---

### Actividad 2: Ampliación de Capacidad con Parámetros adicionales

**Descripción:** Se requiere que los estudiantes añadan una nueva funcionalidad a la función existente, permitiendo especificar si se desea realizar suma o resta. Esta actividad reforzará el uso de parámetros y estructuras condicionales en Python.

---

### Actividad 3: Mejora de Retrocompatibilidad

**Descripción:** Los estudiantes deben modificar la función para que funcione tanto con un nuevo tipo de llamada (especificando una operación) como con llamadas antiguas sin especificar el tipo de operación. Esto ayudará a entender cómo mejorar la retrocompatibilidad en el código.

---

### Actividad 4: Pruebas Unitarias Básicas

**Descripción:** Los estudiantes deben escribir pruebas unitarias simples para verificar que las funciones de suma y resta funcionan correctamente, utilizando herramientas como `unittest` o `pytest`. Esta actividad es fundamental para entender la importancia de realizar pruebas en el desarrollo.

---

### Actividad 5: Añadir Nuevas Funciones

**Descripción:** Los estudiantes deben añadir nuevas funcionalidades a la función existente, permitiendo multiplicar y dividir dos números. Esto reforzará los conceptos de condicionales complejos y operaciones matemáticas adicionales.

---

### Actividad 6: Manejo de Casos Especiales

**Descripción:** Los estudiantes deben manejar casos especiales en la función, como divisiones por cero o entradas no numéricas. Esta actividad ayudará a entender cómo tratar situaciones excepcionales y mejorar la robustez del código.

---

### Actividad 7: Documentación y Comentarios

**Descripción:** Los estudiantes deben agregar documentación a las funciones existentes, incluyendo comentarios que expliquen cada sección del código. Esta actividad es importante para promover buenas prácticas de programación y comunicación en equipo.

---

### Actividad 8: Pruebas Regresivas

**Descripción:** Se les pide a los estudiantes que realicen pruebas regresivas para verificar que las modificaciones no han afectado la funcionalidad previa. Esto permitirá entender cómo proteger el código existente frente a nuevas adiciones.

---

### Actividad 9: Mejora de Eficiencia

**Descripción:** Los estudiantes deben optimizar las funciones ya implementadas, reduciendo duplicación y mejorando la eficiencia del código. Esta actividad incentiva el pensamiento crítico y el análisis de algoritmos para mejorar rendimiento.

---

### Actividad 10: Documentación de Pruebas

**Descripción:** Los estudiantes deben documentar las pruebas que han realizado, incluyendo casos de éxito y fracaso, así como procedimientos para replicar las pruebas. Esto reforzará la importancia de mantener registros detallados en el desarrollo de software.

---

Estas actividades están diseñadas para permitir a los estudiantes aprender de forma práctica sobre programación estructurada y buenas prácticas en Python, ajustándose al nivel y competencias típicas del ciclo formativo DAM (Desarrollo de Aplicaciones Multiplataforma).


<a id="procedimientos-y-casos-de-prueba"></a>
## Procedimientos y casos de prueba

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/003-Dise%C3%B1o%20y%20realizaci%C3%B3n%20de%20pruebas/003-Procedimientos%20y%20casos%20de%20prueba)


<a id="pruebas-de-codigo-cubrimiento-valores-limite-y-clases-de-equivalencia-entre-otras"></a>
## Pruebas de Código Cubrimiento, valores límite y clases de equivalencia, entre otras

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/003-Dise%C3%B1o%20y%20realizaci%C3%B3n%20de%20pruebas/004-Pruebas%20de%20C%C3%B3digo%20Cubrimiento%2C%20valores%20l%C3%ADmite%20y%20clases%20de%20equivalencia%2C%20entre%20otras)


<a id="pruebas-unitarias-herramientas-de-automatizacion"></a>
## Pruebas unitarias; herramientas de automatización

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/003-Dise%C3%B1o%20y%20realizaci%C3%B3n%20de%20pruebas/005-Pruebas%20unitarias%3B%20herramientas%20de%20automatizaci%C3%B3n)


<a id="documentacion-de-las-incidencias"></a>
## Documentación de las incidencias

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/003-Dise%C3%B1o%20y%20realizaci%C3%B3n%20de%20pruebas/006-Documentaci%C3%B3n%20de%20las%20incidencias)


<a id="dobles-de-prueba-tipos-caracteristicas"></a>
## Dobles de prueba. Tipos. Características

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/003-Dise%C3%B1o%20y%20realizaci%C3%B3n%20de%20pruebas/007-Dobles%20de%20prueba.%20Tipos.%20Caracter%C3%ADsticas)


<a id="ejercicio-de-final-de-unidad-2"></a>
## Ejercicio de final de unidad

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/003-Dise%C3%B1o%20y%20realizaci%C3%B3n%20de%20pruebas/101-Ejercicio%20de%20final%20de%20unidad)

### Introducción a los ejercicios

En esta unidad, te enfocarás en la realización y diseño efectivo de pruebas para programas de software utilizando entornos de desarrollo. El ejercicio proporcionado se centra en aplicar tus conocimientos sobre cómo estructurar tests que aseguren la calidad y el funcionamiento correcto del código. A través de este trabajo, practicarás habilidades clave como la identificación de casos de prueba críticos, la implementación efectiva de pruebas unitarias y la documentación clara de los resultados de las pruebas. Esto es fundamental para garantizar que tus programas sean robustos y confiables.

### Actividades propuestas

### Actividades Propuestas:

1. **Análisis y Comprensión del Código**
   - Los estudiantes deben leer el archivo de la carpeta y realizar un análisis detallado de su contenido.
   - Se pretende que comprendan los conceptos básicos de Markdown y cómo se utiliza para documentar código.

2. **Corrección de Errores**
   - Identificar y corregir cualquier error gramatical, ortográfico o de formato en el documento proporcionado.
   - Los estudiantes deben aprender a mejorar la calidad y claridad del texto técnico.

3. **Explicación de Código**
   - Redactar una descripción clara de lo que hace cada sección del código en un nuevo archivo Markdown.
   - Se espera que los alumnos desarrollen habilidades para comunicarse eficazmente sobre sus proyectos técnicos.

4. **Documentación Mejorada**
   - Agregar comentarios adicionales y mejorar la estructura del documento original para facilitar su comprensión futura a otros estudiantes o desarrolladores.
   - Los estudiantes aprenderán la importancia de una buena documentación en el desarrollo de software.

5. **Ejemplos Prácticos**
   - Crear ejemplos prácticos dentro del archivo Markdown que ilustren cómo utilizar las funciones y estructuras presentadas.
   - Se buscan mejorar habilidades de enseñanza a través de la creación de recursos educativos útiles.

6. **Comparativa Markdown vs Otro Lenguaje**
   - Redactar una comparación entre Markdown y otro lenguaje o herramienta utilizada en el curso (por ejemplo, HTML).
   - Se pretende que los alumnos comprendan las ventajas y desventajas de diferentes tecnologías.

7. **Traducción de Ejemplo a Otro Lenguaje**
   - Escribir un equivalente en otro lenguaje de programación del contenido proporcionado originalmente en Markdown.
   - Se espera mejorar habilidades de traducción entre diferentes formatos y lenguajes.

8. **Optimización del Código**
   - Proponer mejoras para el código existente, explicando cómo podrían optimizarse o simplificarse ciertas secciones.
   - Los estudiantes deben aprender a pensar críticamente sobre la eficiencia de sus soluciones técnicas.



<a id="optimizacion-y-documentacion"></a>
# Optimización y documentación

<a id="refactorizacion"></a>
## Refactorización

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/004-Optimizaci%C3%B3n%20y%20documentaci%C3%B3n/001-Refactorizaci%C3%B3n)

### Introducción a los ejercicios

Este conjunto de ejercicios se centra en la refactorización y optimización de código en Python. Comienza con un programa básico de agenda sin funciones, pasando gradualmente a estructuras más organizadas mediante la extracción de bloques de código en funciones separadas y finalizando con la división del código en múltiples archivos para mejorar su mantenibilidad y modularidad.

Los ejercicios practican competencias clave como la creación y uso efectivo de funciones, manejo de variables globales, bucles infinitos y organización del código en módulos externos. A través de estos problemas, los estudiantes aprenderán a refactorizar un código inicialmente monolítico en una estructura modular y fácil de mantener, mejorando su capacidad para escribir programas limpios y escalables.

### creo un programa sin funciones
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es el inicio de un programa sencillo en Python que simula una agenda para gestionar clientes. Al ejecutar este código, se muestra al usuario un menú con cuatro opciones: insertar clientes, listar clientes, actualizar clientes y eliminar clientes. El programa imprime primero un mensaje de bienvenida junto con la versión del programa y luego presenta el menú interactivo.

Después de mostrar las opciones disponibles, el programa solicita que el usuario ingrese su elección. La entrada proporcionada por el usuario se guarda en la variable `opcion` como una cadena de texto (str). Luego, inmediatamente después, se convierte esta entrada a un número entero utilizando la función `int()`, lo que permite al programa realizar operaciones numéricas con ella.

Es importante destacar que este código sirve como punto de partida para una interfaz básica del usuario y establece las bases para el manejo de entradas y menús en programas más grandes. Sin embargo, es recomendable refactorizar este bloque utilizando funciones para mejorar la legibilidad y mantenimiento del código.

`001-creo un programa sin funciones.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es el comienzo de un programa sencillo que simula una agenda para gestionar clientes. El objetivo principal es permitir al usuario realizar varias acciones como insertar, listar, actualizar y eliminar clientes.

Cuando se ejecuta el programa, primero muestra en pantalla el título del programa y luego presenta al usuario un menú con cuatro opciones: Insertar cliente, Listar clientes, Actualizar cliente y Eliminar cliente. El usuario debe ingresar una opción numérica para indicar qué acción desea realizar.

El código lee la opción seleccionada por el usuario a través de la función `input()` y luego la convierte en un número entero usando `int()`. A continuación, utiliza un conjunto de condicionales (`if`, `elif`) para determinar qué acción ejecutar según la opción elegida. Si el usuario elige "1", se le pedirá que introduzca el nombre del nuevo cliente y este será añadido a una lista de clientes que está almacenada en la variable `clientes`. Si el usuario selecciona "2", el programa imprimirá los nombres de todos los clientes que han sido agregados anteriormente. Para las opciones 3 y 4, que son actualizar y eliminar clientes respectivamente, el código solo tiene declaraciones `pass`, lo que significa que aún no se ha implementado la funcionalidad para estas operaciones.

Este tipo de estructura es útil para programas interactivos donde el usuario puede elegir entre diferentes acciones a través de un menú.

`002-codigo para cada una de las acciones.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es una versión inicial de un programa llamado "Agenda" que permite gestionar clientes. El programa presenta al usuario un menú con cuatro opciones: insertar, listar, actualizar y eliminar clientes.

Cuando el usuario selecciona una opción ingresando un número (1, 2, 3 o 4), el código verifica cuál de estas opciones ha sido elegida utilizando estructuras condicionales (`if`, `elif`). La opción "Insertar" permite al usuario añadir nuevos nombres de clientes a la lista concatenándolos con una coma y guardándolos en la variable `clientes`. Para las opciones "Listar", "Actualizar" y "Eliminar", el código aún no tiene implementación, ya que se utiliza la palabra clave `pass` para indicar que esa parte del código todavía está pendiente de desarrollo.

Este programa es importante porque muestra cómo estructurar una aplicación básica con menús en Python y cómo manejar entradas del usuario. Sin embargo, hay áreas para mejorar, como refactorizar el código para ser más modular (usando funciones) y agregar funcionalidades a las opciones no implementadas.

`003-bucle infinito.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es una simple agenda donde se pueden gestionar clientes. El programa presenta un menú sencillo con cuatro opciones: insertar, listar, actualizar y eliminar clientes. Aquí te explico cómo funciona cada parte:

1. **Menú Principal**: Se muestra un menú en pantalla que pide al usuario seleccionar una opción (insertar, listar, actualizar o eliminar). El programa entra en un bucle infinito (`while True`) para permitir múltiples operaciones sin tener que reiniciar el programa.

2. **Procesamiento de la Opción**: Dependiendo del número que introduzca el usuario, el programa ejecuta diferentes acciones:
   - Si se selecciona "1", se solicita al usuario ingresar un nuevo nombre de cliente y este nombre se agrega a una cadena llamada `clientes`.
   - Si se selecciona "2", imprime todos los clientes actuales separados por comas que están almacenados en la variable `clientes`.
   - Si se selecciona "3", muestra la lista actual de clientes y luego pide al usuario introducir nuevos clientes, reemplazando así la lista antigua.
   - Si se selecciona "4", limpia la lista de clientes eliminándolos todos (la cadena `clientes` se convierte en una cadena vacía).

Este tipo de programa es fundamental para entender cómo interactuar con datos almacenados en variables simples y gestionar entradas del usuario. Además, muestra conceptos básicos como bucles infinitos y estructuras condicionales que son fundamentales en la programación.

`004-funcion de eliminnar.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código es una versión inicial de un programa de agenda simple en Python, desarrollado por Jose Vicente Carratala. El objetivo principal del programa es permitir al usuario gestionar una lista básica de clientes a través de cuatro opciones: insertar nuevos clientes, listar los existentes, actualizar la lista y eliminar todos los clientes.

El código comienza con una función llamada `imprimeBienvenida()`, que simplemente imprime un mensaje en pantalla para dar la bienvenida al programa. Sin embargo, esta función no se utiliza en el flujo principal del programa actualmente, lo que sugiere posibles mejoras futuras para organizar el código y hacerlo más modular.

El programa principal consta de un bucle `while True`, lo cual significa que el menú se repetirá indefinidamente hasta que se interrumpa manualmente. Dentro del bucle, el usuario es solicitado a elegir una opción entre las cuatro disponibles: insertar clientes, listar clientes, actualizar la lista o eliminar todos los clientes.

- Si elige la opción 1 (insertar), se solicita al usuario que introduzca un nuevo nombre de cliente y lo añade a la cadena `clientes`.
- Para la opción 2 (listar), simplemente imprime en pantalla la lista actual de clientes.
- La opción 3 (actualizar) muestra primero los clientes actuales, luego pide al usuario que introduzca una nueva lista completa para reemplazar la existente.
- Finalmente, si elige la opción 4 (eliminar), se vacía la cadena `clientes`, eliminando así todos los registros de clientes.

Este código sirve como base para entender cómo estructurar un programa en Python con menús y opciones interactivas. Sin embargo, hay varias áreas donde podría mejorarse, como utilizando funciones para separar tareas específicas (como ya se ha hecho con la función `imprimeBienvenida()`) o implementando control de errores para asegurar que el usuario solo introduzca valores válidos en cada opción del menú.

`005-extraccion a funcion.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código es una pequeña aplicación de agenda en Python que permite gestionar un listado básico de clientes. El programa comienza mostrando un mensaje de bienvenida y luego entra en un bucle infinito (`while True:`) donde muestra un menú al usuario para que pueda seleccionar diferentes opciones: insertar, listar, actualizar o eliminar clientes.

Cada opción está asociada a una acción específica:
- Si el usuario elige la opción 1 (insertar), se pide el nombre de un nuevo cliente y este es añadido a la cadena `clientes`.
- La opción 2 (listar) muestra los nombres de todos los clientes registrados hasta ese momento.
- La opción 3 (actualizar) permite al usuario reemplazar toda la lista de clientes existente por una nueva introducida desde el teclado.
- Finalmente, si se selecciona la opción 4 (eliminar), se borra la lista completa de clientes.

Este tipo de estructura es útil para aprender cómo manejar opciones en un programa interactivo y también cómo trabajar con cadenas de texto como contenedores de información. Es importante notar que el código maneja errores básicos, como asegurarse de que las entradas del usuario sean del tipo correcto (convertir a `int`), aunque podría mejorar la validación para hacerlo más robusto y seguro.

`006-extraigo menu.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código es un programa sencillo de una agenda que permite gestionar clientes. Se organiza principalmente en funciones y variables globales para mantener el código claro y modular.

El programa comienza definiendo varias funciones que se encargan de tareas específicas:
- `imprimeBienvenida()` imprime la bienvenida al usuario.
- `muestraMenu()` muestra las opciones disponibles al usuario.
- `insertarCliente()` permite agregar un nuevo cliente ingresando su nombre.
- `listadoClientes()` lista los clientes actuales que se han añadido a la agenda.
- `actualizaClientes()` permite al usuario actualizar toda la lista de clientes con una nueva entrada.
- `borraClientes()` borra todos los clientes existentes en la agenda.

Las variables globales, como `clientes`, son utilizadas para almacenar la información actualizada entre las diferentes funciones. En este caso, `clientes` es una cadena que almacena el nombre de los clientes separados por comas.

El bucle principal del programa (`while True:`) imprime el menú y solicita al usuario que ingrese una opción. Dependiendo de la opción seleccionada, se llama a la función correspondiente para realizar la acción deseada. Esto permite que el programa funcione continuamente hasta que sea interrumpido manualmente.

Este tipo de estructura es importante porque hace que el código sea más fácil de entender y mantener, ya que cada función tiene un objetivo específico y claramente definido. Además, facilita la adición o modificación de características sin afectar al resto del programa.

`007-extraigo los bloques.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código es una implementación básica de un programa agenda en Python, diseñado para gestionar clientes de manera sencilla. El programa define varias funciones que se encargan de diferentes tareas: mostrar la bienvenida al usuario (`imprimeBienvenida`), presentar el menú de opciones (`muestraMenu`), insertar nuevos clientes (`insertarCliente`), listar los clientes existentes (`listadoClientes`), actualizar los datos de los clientes (`actualizaClientes`) y borrar todos los clientes registrados (`borraClientes`). 

El programa utiliza una variable global llamada `clientes`, que se inicializa como un string vacío en la parte superior del código. Esta variable es modificada por las funciones que añaden, muestran o borran clientes.

El bucle principal del programa muestra el menú al usuario y solicita su elección hasta que se ingresa una opción válida (1, 2, 3 o 4). Dependiendo de la opción elegida, se llama a la función correspondiente para realizar la acción deseada. Este diseño facilita la lectura y mantenimiento del código, ya que cada función tiene un propósito claro y específico.

Es importante destacar que este enfoque divide el programa en partes más pequeñas y manejables, lo cual es beneficioso tanto para la comprensión inicial como para futuras mejoras o modificaciones del software.

`008-solucion global.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es una parte del programa de agenda que utiliza funciones definidas en otro archivo llamado `funciones.py`. El código principal se encarga de mostrar un menú y permitir al usuario interactuar con él para realizar diferentes operaciones relacionadas con la gestión de clientes.

El programa comienza mostrando un mensaje de bienvenida mediante la función `imprimeBienvenida()`. Luego, entra en un bucle infinito (`while True:`) que muestra el menú usando la función `muestraMenu()` y solicita al usuario que ingrese una opción. Dependiendo del número ingresado por el usuario (1 para insertar un cliente, 2 para listar clientes, 3 para actualizar clientes y 4 para borrar clientes), se llama a las funciones correspondientes: `insertarCliente()`, `listadoClientes()`, `actualizaClientes()` o `borraClientes()`.

Este enfoque permite organizar el código en partes más pequeñas y manejables, lo que facilita la comprensión y modificación del programa. La separación de las funcionalidades en un archivo externo (`funciones.py`) también ayuda a mantener el código principal limpio y enfocado en la lógica general del flujo del programa.

`009-extraer a archivo externo.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código define una función en Python llamada `totalFactura` que recibe como parámetro la base imponible (es decir, el importe inicial antes de aplicar impuestos). La función se encarga de calcular y devolver el total de una factura considerando un IRPF del 15% y un IVA del 21%.

Primero, la función convierte la base imponible a un número decimal para asegurar que los cálculos sean correctos. Luego redondea este valor a dos decimales. Después, calcula el importe retenido por IRPF (15% de la base imponible) y el IVA (21% de la base imponible), también redondeando estos valores a dos decimales. Finalmente, suma la base imponible más el IVA y resta el IRPF para obtener el total de la factura.

El último paso del código es imprimir en pantalla el resultado obtenido al llamar a la función `totalFactura` con un valor inicial de 1000 como base imponible.

Esta implementación ayuda a organizar claramente las responsabilidades dentro del programa, facilitando su mantenimiento y entendimiento.

`010-partir en funciones.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es una función en Python que calcula el total de una factura, teniendo en cuenta la base imponible (el precio antes de impuestos), un porcentaje del Impuesto sobre Renta para los Contribuyentes Pasivos (IRPF) y el Impuesto al Valor Agregado (IVA). La función se llama `totalFactura` y toma como entrada la base imponible, que debe ser proporcionada como un número.

El código incluye una subfunción llamada `redondeoa2`, que redondea cualquier número a dos decimales para asegurar precisión al trabajar con moneda. Esto es común en aplicaciones financieras donde los montos deben mostrarse de manera clara y fácilmente legibles.

En la función principal, primero se verifica que el valor proporcionado sea un número flotante (decimal). Luego, calcula tanto el IRPF como el IVA basándose en porcentajes del 15% y 21%, respectivamente. Ambos cálculos son redondeados a dos decimales para consistencia con la base imponible.

Finalmente, se calcula el total de la factura restando el IRPF del importe bruto y sumando el IVA. El resultado final también es redondeado a dos decimales antes de ser devuelto por la función.

Esta forma de estructurar el código en funciones separadas ayuda a mantener el programa ordenado, facilita su depuración y mejora la reutilización del código para cálculos similares en otras partes del sistema.

`011-divido funciones.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código está diseñado para calcular el total de una factura, teniendo en cuenta impuestos como IVA e IRPF. La función principal es `totalFactura`, que toma un parámetro llamado `baseimponible` (la base imponible de la factura) y devuelve el total después de aplicar los descuentos e impuestos.

El código comienza convirtiendo el valor de `baseimponible` a tipo float para asegurarse de que se trate correctamente como número. Luego, redondea este valor a dos decimales utilizando una función llamada `redondeoa2`.

Luego calcula el IRPF (15% del total) y lo guarda en la variable `irpf`, también redondeado a dos decimales. Aunque en el código se llama a la función `calculaIVA` para calcular el IVA, no se utiliza realmente en la suma final. El cálculo correcto del total debería incluir sumar al valor de la base imponible tanto el IVA como restar el IRPF.

Finalmente, el código redondea el total resultante a dos decimales y lo devuelve. La línea `print(totalFactura(1000))` muestra cómo se podría invocar esta función para calcular el total de una factura con base imponible de 1000 euros.

Es importante notar que hay un error en la lógica del código, ya que el IVA calculado no se utiliza en la operación final. Para corregirlo, sería necesario asegurarse de utilizar adecuadamente los valores devueltos por las funciones `calculaIVA` y mantener una referencia correcta al total a calcular.

Este tipo de refactorización ayuda a organizar el código, mejorando su legibilidad y facilitando futuras modificaciones.

`012-sigo dividiendo.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es una parte del proceso de refactorización en Python, donde se dividen tareas complejas en funciones más pequeñas y manejables. La función principal es `totalFactura`, que calcula el total de una factura basándose en la base imponible (el monto original antes de impuestos).

El código comienza definiendo tres funciones auxiliares: `redondeoa2`, `calculaIVA` y `calculaIRPF`. 

- `redondeoa2` redondea un número a dos decimales.
- `calculaIVA` calcula el IVA (Impuesto sobre el Valor Agregado) del monto dado multiplicándolo por 0.21 (que es el 21%) y luego lo redondea a dos decimales usando la función `redondeoa2`.
- `calculaIRPF` calcula el IRPF (Impuesto de Renta de las Personas Físicas) del monto dado multiplicándolo por 0.15 (que es el 15%) y luego también lo redondea a dos decimales usando la misma función.

En la función `totalFactura`, se toma un valor como argumento, que representa la base imponible de una factura, y se convierte en tipo float para permitir cálculos con decimales. Luego, este valor pasa por la función `redondeoa2` para asegurar precisión en los decimales.

El total final de la factura se calcula sumando la base imponible al IVA y restando el IRPF. Este resultado también es redondeado a dos decimales antes de ser devuelto. Finalmente, `totalFactura(1000)` imprime el cálculo del total para una base imponible de 1000 unidades.

Esta división en funciones ayuda a hacer el código más legible y fácil de mantener, ya que cada función se ocupa de una tarea específica dentro del proceso global de cálculo de facturas.

`013-sigo dividiendo mas.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código en Python contiene varias funciones que se utilizan para gestionar una simple agenda de clientes. Cada función tiene un propósito específico y ayuda a organizar el programa, haciéndolo más fácil de leer y mantener.

La función `imprimeBienvenida()` muestra un mensaje de bienvenida con información sobre el autor del programa. La función `muestraMenu()` imprime en pantalla las opciones disponibles para el usuario (insertar, listar, actualizar o eliminar clientes).

Las funciones `insertarCliente()`, `listadoClientes()`, `actualizaClientes()` y `borraClientes()` manejan operaciones específicas con la lista de clientes. Por ejemplo, `insertarCliente()` permite al usuario añadir un nuevo cliente a la lista existente, mientras que `listadoClientes()` muestra todos los clientes actuales en la agenda.

El uso de estas funciones separa claramente las responsabilidades y mejora la legibilidad del código, facilitando su futura modificación o expansión.

`funciones.py`

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

### Actividades propuestas

### Actividad 1: Refactorización de Menú y Bienvenida

**Descripción**: Refactoriza el código del menú y la bienvenida en una función separada. Asegúrate de que estas partes estén completamente encapsuladas para mejorar la legibilidad.

---

### Actividad 2: Extraer Funciones de Procesamiento

**Descripción**: Divide las operaciones CRUD (Crear, Leer, Actualizar, Borrar) del programa agenda en funciones independientes y prueba cada una de ellas. Esto ayudará a modularizar el código.

---

### Actividad 3: Manejo de Variables Globales

**Descripción**: Modifica tu código para que todas las referencias globales (como la variable `clientes`) sean correctamente gestionadas desde dentro de tus funciones, usando argumentos y retorno de valores donde sea necesario.

---

### Actividad 4: Implementar Bucle Infinito con Condicionales

**Descripción**: Mejora el programa agenda para manejar un bucle infinito que permita al usuario interactuar con el sistema hasta que decida salir. Asegúrate de incluir las condiciones necesarias para finalizar el bucle.

---

### Actividad 5: Refactorización del Proceso Insertar Cliente

**Descripción**: Extrae la lógica del proceso de inserción de cliente en una función separada y asegúrate de que esta función interactúa correctamente con el resto del programa.

---

### Actividad 6: Documentación Mejorada

**Descripción**: Refuerza la documentación interna (docstrings) para cada función y clase, incluyendo ejemplos de uso. Esto ayudará a otros desarrolladores a entender rápidamente cómo utilizar tu código.

---

### Actividad 7: Descomposición del Cálculo Total Factura

**Descripción**: Toma la lógica del cálculo total de una factura y descompórtala en múltiples funciones más pequeñas. Asegúrate de que cada función tenga un propósito claro y específico.

---

### Actividad 8: Implementación Modular del Cálculo Factura

**Descripción**: Refactoriza el código del cálculo del total de la factura para incluir funciones separadas para redondeo, cálculo de IVA e IRPF. Asegúrate de que cada función sea reutilizable y testeable.

---

### Actividad 9: Pruebas Funcionales

**Descripción**: Escribe pruebas unitarias básicas para las funciones principales del programa agenda. Utiliza `assert` o frameworks como `unittest` en Python para verificar el correcto funcionamiento de tus funciones.

---

### Actividad 10: Integración con Archivos Externos (Funciones)

**Descripción**: Asegúrate de que todas las funciones del módulo 'funciones.py' estén correctamente importadas y utilizadas dentro de tu programa principal. Verifica también que el código funcione sin errores al hacer referencia a estas funciones.

---

Estas actividades te ayudarán a mejorar la modularidad, legibilidad y mantenibilidad del código en tus proyectos futuros.


<a id="analizadores-de-codigo"></a>
## Analizadores de código

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/004-Optimizaci%C3%B3n%20y%20documentaci%C3%B3n/002-Analizadores%20de%20c%C3%B3digo)

### Introducción a los ejercicios

Esta carpeta contiene una serie de ejercicios diseñados para familiarizarte con diversas herramientas y prácticas útiles en el desarrollo web y la publicación de proyectos. Los ejercicios abarcan desde la validación de código HTML y JSON hasta la utilización de plataformas de inteligencia artificial y la publicación de páginas web en GitHub Pages. A través de estos problemas, mejorarás tus habilidades en la optimización y documentación del código, aprenderás a utilizar analizadores para verificar la calidad del código que escribes y comprenderás cómo desplegar tu trabajo en un entorno real accesible por internet.

### Actividades propuestas

### Actividad 1: Validación de Contenido Web
**Descripción:** Los estudiantes deben utilizar el validador HTML/CSS oficial para verificar la estructura y estilo de un sitio web proporcionado. El objetivo es garantizar que los documentos sean estándar y accesibles.

### Actividad 2: Optimización de JSON
**Descripción:** Con el validador JSON, los alumnos deberán analizar y corregir archivos JSON con errores. Se busca mejorar la estructura de datos para un uso más eficiente en aplicaciones web.

### Actividad 3: Uso de Herramientas de Inteligencia Artificial (IA)
**Descripción:** Los estudiantes explorarán varias herramientas basadas en IA como ChatGPT y Mistral AI, describiendo sus características principales y posibles aplicaciones para proyectos de desarrollo web. El objetivo es entender cómo estas tecnologías pueden apoyar el proceso creativo.

### Actividad 4: Introducción a GitHub Pages
**Descripción:** Los alumnos crearán una página web utilizando GitHub Pages siguiendo los pasos proporcionados en el documento. Se pretende que aprendan la importancia de control de versiones y publicación de sitios web estáticos.

### Actividad 5: Comparativa de Herramientas de IA
**Descripción:** Los estudiantes analizarán las características y funcionalidades de varias herramientas basadas en inteligencia artificial, comparándolas entre sí. Se espera que identifiquen ventajas e inconvenientes para diferentes tipos de proyectos.

### Actividad 6: Mejora de Código Web con Analizadores
**Descripción:** Utilizando los analizadores web y JSON mencionados, los alumnos revisarán y mejorarán el código existente de un sitio web proporcionado. El objetivo es optimizar la eficiencia y legibilidad del código.

### Actividad 7: Integración GitHub Pages con Proyectos
**Descripción:** Los estudiantes implementarán lo aprendido en GitHub Pages para publicar sus propios proyectos web. Se pretende que comprendan cómo integrarlo dentro de su flujo de trabajo habitual.

### Actividad 8: Documentación y Optimización del Código JSON
**Descripción:** A través del uso de herramientas como JSONLint, los alumnos revisarán un conjunto de archivos JSON para mejorar su estructura y documentación. Se espera que aprendan a mantener la integridad y claridad en sus datos.

### Actividad 9: Práctica con GitHub Pages
**Descripción:** En esta actividad práctica, los estudiantes publicarán múltiples páginas web utilizando GitHub Pages. El objetivo es familiarizarse con el proceso de creación, modificación y despliegue en un entorno real.

### Actividad 10: Revisión Final del Proceso de Publicación
**Descripción:** Los alumnos realizarán una revisión final sobre cómo se publican los sitios web a través de GitHub Pages. Se espera que puedan explicar cada paso involucrado y las razones detrás de él, asegurando un entendimiento completo del proceso.


<a id="control-de-versiones-estructura-de-las-herramientas-de-control-de-versiones"></a>
## Control de versiones. Estructura de las herramientas de control de versiones

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/004-Optimizaci%C3%B3n%20y%20documentaci%C3%B3n/003-Control%20de%20versiones.%20Estructura%20de%20las%20herramientas%20de%20control%20de%20versiones)

### Introducción a los ejercicios

Esta carpeta contiene una serie de ejercicios diseñados para introducirte al uso de herramientas de control de versiones, con un énfasis especial en Git y GitHub. Los ejercicios te guiarán por los pasos básicos de cómo configurar un repositorio en GitHub, clonarlo en tu equipo local, realizar commits (grabar cambios), hacer push (subir cambios al servidor remoto) y pull (recuperar cambios desde el servidor). A través de estos problemas, aprenderás a gestionar versiones de tus proyectos de manera eficiente y a mantener un historial claro de las modificaciones que realizas en tu código. Además, te familiarizarás con la importancia de tener un perfil público y actualizado en GitHub como parte integral del desarrollo profesional.

### primera version
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es una línea simple que utiliza la función `print()` en Python para mostrar el texto "Hola mundo desde Python" en la pantalla. La función `print()` se usa para imprimir o mostrar información en la consola del sistema, lo cual es muy útil para verificar que tu programa está funcionando correctamente o simplemente para informar al usuario sobre algún aspecto de su ejecución.

En este caso específico, el código no hace nada más que demostrar cómo utilizar una función básica y es comúnmente utilizado como un ejemplo introductorio en la programación con Python. Es importante porque ayuda a entender los fundamentos antes de pasar a conceptos más complejos.

`001-primera version.py`

```python
print("Hola mundo desde Python")
```

### segund version
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código en Python es muy sencillo. La línea `print("Hola que tal como estais")` muestra un mensaje en la consola o terminal. Este comando imprime el texto "Hola que tal como estais" directamente donde se está ejecutando el programa, normalmente una ventana de comandos o una interfaz de desarrollo integrada (IDE). Es importante porque sirve para verificar rápidamente si tu código Python puede imprimir mensajes en la consola, lo cual es útil durante el proceso de depuración y pruebas.

`002-segund version.py`

```python
print("Hola que tal como estais")
```

### Actividades propuestas

### Actividades Propuestas para Estudiantes de Formación Profesional

1. **Creación y Configuración de Cuenta GitHub**
   - **Descripción**: Los estudiantes deben crear una cuenta en GitHub e iniciar sesión. La actividad busca familiarizar a los alumnos con el entorno inicial de GitHub, como la creación de un perfil y configuraciones básicas.

2. **Creación del Primer Repositorio**
   - **Descripción**: Los alumnos tendrán que crear su primer repositorio en GitHub siguiendo las instrucciones proporcionadas para nombrarlo y describirlo correctamente. Se espera que los estudiantes aprendan a gestionar sus proyectos de manera organizada desde el inicio.

3. **Clonación del Repositorio Local**
   - **Descripción**: Los alumnos deben clonar su repositorio creado en GitHub en su equipo local usando GitHub Desktop. Esta actividad se centra en la integración entre la nube y los sistemas locales para mantener una versión sincronizada de sus proyectos.

4. **Manejo Básico del Git: Commit y Push**
   - **Descripción**: Los estudiantes tendrán que crear un archivo simple (como README.md o cualquier otro), hacer commit de los cambios en su repositorio local, y luego subir esos cambios a GitHub usando el comando push. Esta actividad enseña las operaciones básicas de control de versiones.

5. **Implementación de Control de Versiones**
   - **Descripción**: Los alumnos deben realizar cambios incrementales (como añadir un archivo nuevo o modificar uno existente) y repetir los procesos de commit y push varias veces. Se espera que comprendan cómo mantener su código actualizado y versionado correctamente.

6. **Uso del Fetch y Pull**
   - **Descripción**: Los estudiantes deben simular una situación donde sus compañeros han hecho cambios en un repositorio compartido (emulando la colaboración). A continuación, deberán utilizar fetch y pull para traer esos cambios a su copia local. Esta actividad enseña cómo mantenerse al día con los cambios realizados por otros.

7. **Documentación del Repositorio**
   - **Descripción**: Los alumnos deben actualizar el archivo README.md en sus repositorios explicando detalladamente la estructura de su proyecto, tecnologías utilizadas y cómo contribuir a él. Se espera que adquieran habilidades para documentar proyectos software de manera efectiva.

8. **Mantenimiento Periódico del Repositorio**
   - **Descripción**: Durante un período determinado (por ejemplo, una semana), los alumnos deben realizar commits regulares en sus repositorios con comentarios explicativos sobre las modificaciones hechas. Esta actividad busca reforzar la práctica regular de control de versiones como parte integral del desarrollo de software.

Estas actividades están diseñadas para proporcionar a los estudiantes experiencias prácticas y realistas que refuercen su comprensión de cómo manejar herramientas de control de versiones, especialmente GitHub.


<a id="ejercicio-de-final-de-unidad-3"></a>
## Ejercicio de final de unidad

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/004-Optimizaci%C3%B3n%20y%20documentaci%C3%B3n/101-Ejercicio%20de%20final%20de%20unidad)

### Introducción a los ejercicios

El conjunto de ejercicios que encontrarás en esta carpeta está diseñado para ayudarte a consolidar tus conocimientos sobre la optimización y documentación del código. Trabajaremos con conceptos clave como cómo mejorar la eficiencia de tu programa, reducir su complejidad y asegurarte de que esté bien documentado para otros desarrolladores. Este ejercicio te permitirá aplicar los principios aprendidos a lo largo del curso, reforzando tus habilidades en análisis de código, refactorización y creación de comentarios claros y precisos.

### Actividades propuestas

### Actividad 1: Análisis y Optimización del Código

**Descripción:** Los estudiantes deben revisar un archivo de código proporcionado en Markdown que contiene una serie de funciones y procedimientos. La tarea consiste en identificar áreas del código que pueden optimizarse para mejorar su eficiencia y legibilidad. Se espera que los alumnos sugieran cambios concretos y documenten sus razones.

### Actividad 2: Creación de Documentación

**Descripción:** Basándose en el código analizado, los estudiantes deben crear una guía completa en Markdown que explique paso a paso cómo funciona cada función o procedimiento. La documentación debe incluir ejemplos de uso y explicaciones claras sobre la lógica detrás del código.

### Actividad 3: Mejora de la Clarity

**Descripción:** Los estudiantes deben revisar el archivo Markdown en busca de posibles ambigüedades o malas prácticas en la escritura de código. Se espera que identifiquen problemas y propongan soluciones para mejorar la claridad del código.

### Actividad 4: Revisión de Pruebas

**Descripción:** Los estudiantes deben crear pruebas unitarias para las funciones revisadas, basándose en el archivo Markdown proporcionado. La tarea incluye escribir casos de prueba que cubran diferentes escenarios posibles y verificar que todas las condiciones se cumplen.

### Actividad 5: Diseño de Casos de Uso

**Descripción:** Los estudiantes deben diseñar una serie de casos de uso para el código revisado, describiendo cómo podría usarlo un usuario real en situaciones específicas. Se espera que identifiquen las necesidades del usuario y cómo el código puede satisfacer esas necesidades.

### Actividad 6: Optimización de Rendimiento

**Descripción:** Basándose en el análisis realizado anteriormente, los estudiantes deben implementar mejoras concretas en el código para optimizar su rendimiento. Se espera que documenten las modificaciones realizadas y expliquen cómo estas mejoran la eficiencia del programa.

### Actividad 7: Refactorización del Código

**Descripción:** Los alumnos deberán refactorizar partes del código original, simplificando estructuras complejas y eliminando redundancias. Se espera que el nuevo código sea más legible y fácil de mantener sin cambiar su funcionalidad.

### Actividad 8: Introducción a Herramientas de Análisis

**Descripción:** Los estudiantes deben investigar e incorporar una herramienta de análisis estático al proyecto, usando esta para encontrar posibles errores o áreas de mejora en el código. Se espera que generen un informe sobre los hallazgos y recomendaciones derivadas del uso de la herramienta.

Estas actividades están diseñadas para mejorar las habilidades técnicas y profesionales de los estudiantes, preparándolos para trabajar con proyectos reales en entornos de desarrollo complejos.


<a id="examen-final"></a>
## Examen final

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/004-Optimizaci%C3%B3n%20y%20documentaci%C3%B3n/104-Examen%20final)

### Introducción a los ejercicios

En esta carpeta encontrarás una serie de ejercicios diseñados para ayudarte a familiarizarte con la creación y manipulación de bases de datos utilizando SQL. Los problemas abarcan desde la creación de tablas y inserción de datos hasta la configuración de relaciones entre esas tablas mediante claves foráneas, así como la realización de consultas que involucran joins para combinar información de múltiples tablas. También aprenderás a crear vistas para facilitar el acceso a resultados de consultas complejas y gestionar usuarios con diferentes niveles de permisos en tu base de datos.

A través de estos ejercicios, adquirirás competencias esenciales como la administración de estructuras de datos relacionales, gestión de relaciones entre tablas, optimización de consultas y control del acceso a las bases de datos.

### crear tablas
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código SQL sirve para crear una base de datos llamada `portafolioceac` y dos tablas dentro de ella: `Piezas` y `Categorias`. Primero, el comando `CREATE DATABASE portafolioceac;` establece la creación de la base de datos. Luego, se utiliza el comando `USE portafolioceac;` para especificar que todas las operaciones subsecuentes se realizarán dentro de esta base de datos.

La tabla `Piezas` tiene varias columnas: un identificador único (`Identificador`) que es autoincremental y sirve como clave primaria, un título (`titulo`), una descripción (`descripcion`), una ruta a la imagen asociada (`imagen`), una URL (`url`) y el id de categoría (`id_categoria`). Esta tabla permite almacenar información sobre diferentes piezas o elementos del portafolio.

Por otro lado, la tabla `Categorias` contiene también un identificador único (`Identificador`) que es autoincremental y clave primaria, junto con campos para título (`titulo`) y descripción (`descripcion`). Esta tabla se utiliza para clasificar las piezas en diferentes categorías. La relación entre estas dos tablas puede ser aprovechada para organizar el contenido de manera más estructurada e intuitiva.

Este tipo de diseño es común en sistemas que requieren la organización y presentación de elementos dentro de distintas categorías, como portafolios o sitios web con múltiples secciones.

`001-crear tablas.sql`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código SQL se utiliza para insertar datos en dos tablas diferentes: `Categorias` y `Piezas`. La función `INSERT INTO` es muy útil cuando queremos añadir nuevos registros a una tabla en la base de datos.

En el primer bloque, estamos insertando un nuevo registro en la tabla `Categorias`. El valor `NULL` indica que el campo ID (que probablemente es clave primaria) debe generar automáticamente un nuevo identificador único. Luego se especifican los valores para los campos `'General'` y `'Esta es la categoria general'`, que son muy posiblemente el nombre de la categoría y una descripción adicional, respectivamente.

En el segundo bloque, hacemos algo similar pero en la tabla `Piezas`. Insertamos un registro con varios datos: el título `'Primera pieza'` para el nombre de la pieza, su descripción, una imagen asociada llamada `'josevicente.jpg'`, una URL y finalmente un número `1`. Este último valor es importante porque parece que está relacionado con alguna otra tabla a través de una llave foránea (FK), lo cual nos indica que cada pieza pertenece a una categoría específica, en este caso la primera del listado.

Estos comandos son fundamentales para poblar nuestra base de datos con información inicial antes de empezar a trabajar con ella.

`002-insertar.sql`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código SQL se utiliza para modificar una tabla existente llamada `Piezas`. Específicamente, agrega una restricción de tipo `FOREIGN KEY` que vincula la columna `id_categoria` en la tabla `Piezas` con la columna `identificador` en la tabla `Categorias`.

Lo que hace esta instrucción es garantizar que cada valor en la columna `id_categoria` de la tabla `Piezas` debe ser un valor válido y existente en la columna `identificador` de la tabla `Categorias`. Esto ayuda a mantener la integridad referencial entre estas dos tablas.

Además, las cláusulas `ON DELETE CASCADE` y `ON UPDATE CASCADE` indican que cuando se borra o actualiza un registro en la tabla `Categorias`, la base de datos también debe borrar o actualizar automáticamente los registros relacionados en la tabla `Piezas`. Esto es útil para mantener la consistencia entre las dos tablas y evitar referencias a categorías inexistentes.

`003-fk.sql`

```sql
ALTER TABLE Piezas
ADD CONSTRAINT fk_piezas_categorias
FOREIGN KEY (id_categoria) REFERENCES Categorias(identificador)
ON DELETE CASCADE
ON UPDATE CASCADE;
```

### selecciones
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código SQL consta de dos consultas simples. La primera consulta, `SELECT * FROM Categorias;`, selecciona todos los datos de la tabla llamada "Categorias". Esto significa que el sistema mostrará toda la información almacenada en esa tabla sin ningún tipo de filtro o condición adicional.

La segunda consulta, `SELECT * FROM Piezas;`, hace lo mismo pero con una tabla diferente llamada "Piezas". Ambas consultas son útiles para revisar rápidamente todos los registros y datos que contienen estas dos tablas específicas en la base de datos. Esta es una manera fácil y rápida de obtener un panorama general del contenido de las tablas sin tener que escribir condiciones más complejas o seleccionar campos individuales.

Estas consultas son comunes durante el desarrollo y pruebas, ya que permiten a los desarrolladores asegurarse de que la información está siendo insertada correctamente en las bases de datos.

`004-selecciones.sql`

```sql
SELECT * FROM Categorias;

SELECT * FROM Piezas;
```

### left join
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código SQL realiza una operación llamada `LEFT JOIN` entre dos tablas, que son "Piezas" y "Categorias". El objetivo es combinar registros de ambas tablas basándose en la relación existente entre ellas. En este caso, se utiliza la columna "id_categoria" de la tabla "Piezas" para unir los datos con el identificador correspondiente en la tabla "Categorias".

Lo que hace esta consulta es traer toda la información disponible de la tabla "Piezas", y agregar información adicional de la tabla "Categorias" donde exista una relación entre ambas tablas. Si no hay coincidencia en "Categorias" para un determinado registro en "Piezas", los campos resultantes que corresponden a la tabla "Categorias" simplemente aparecerán como valores nulos.

Esta consulta es útil cuando se desea obtener todos los detalles de las piezas, incluyendo información sobre sus categorías, pero también mantener registros de piezas que no tienen una categoría asignada en la base de datos.

`005-left join.sql`

```sql
SELECT 
* 
FROM Piezas
LEFT JOIN Categorias
ON Piezas.id_categoria = Categorias.Identificador;
```

### ahora creo la vista
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código SQL está diseñado para crear una vista llamada `piezas_y_categorias` en la base de datos. Una vista es como un alias o una tabla virtual que contiene los resultados del conjunto de consultas subyacentes. En este caso, se une la tabla `Piezas` con la tabla `Categorias` utilizando un JOIN izquierdo (LEFT JOIN) para incluir todas las piezas, incluso aquellas sin categoría asociada.

El código selecciona específicamente varias columnas desde ambas tablas: el título y descripción de cada categoría (`categoriaturio`, `categoriadescripcion`) y el título, descripción, imagen y URL de cada pieza. Al hacer esto, se crea una tabla virtual llamada `piezas_y_categorias` que tiene todas estas columnas juntas.

Después de crear la vista, se ejecuta una consulta simple (`SELECT * FROM piezas_y_categorias;`) para visualizar el contenido completo de esta nueva vista recién creada. Esto te permite ver fácilmente cómo están relacionadas las piezas con sus respectivas categorías en un solo lugar, lo que facilita mucho la consulta y análisis de datos.

`006-ahora creo la vista.sql`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código SQL está diseñado para crear un nuevo usuario en tu base de datos y otorgarle los permisos necesarios. Primero, se crea el usuario 'portafolioceac' con una contraseña específica ('portafolioceac'). Luego, se le permite acceso al servidor con el comando `GRANT USAGE`, lo que significa que el usuario puede conectarse sin tener privilegios en ninguna base de datos específica.

A continuación, mediante la sentencia `ALTER USER`, se eliminan todos los límites y restricciones aplicables al usuario 'portafolioceac', como el número máximo de consultas por hora o conexiones simultáneas. Esto asegura que el usuario pueda realizar cualquier acción sin restricciones.

Finalmente, se otorgan todos los privilegios disponibles en la base de datos llamada `portafolioceac` a este nuevo usuario con el comando `GRANT ALL PRIVILEGES`. Al final del script, se recargan los privilegios para que todos estos cambios tengan efecto inmediato con `FLUSH PRIVILEGES`.

Este tipo de configuración es importante cuando necesitas establecer un entorno de prueba o desarrollo donde diferentes usuarios pueden acceder y manipular datos sin restricciones, asegurando así una gestión segura pero flexible de los permisos en la base de datos.

`007-usuario.sql`

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

### Actividades propuestas

### Actividades Propuestas

#### 1. Creación de Tablas en SQL
**Descripción:** Los estudiantes deben crear una base de datos y dos tablas (una para categorías y otra para piezas) con las columnas proporcionadas en el ejercicio inicial. Se espera que comprendan cómo definir relaciones entre tablas.

#### 2. Inserción de Datos en Tablas SQL
**Descripción:** Los alumnos deben insertar un nuevo registro en cada tabla utilizando los ejemplos dados. Esto ayudará a entender cómo ingresar datos específicos en una base de datos relacional.

#### 3. Creación de Clave Foránea (FK)
**Descripción:** Se les pide que añadan una clave foránea entre las tablas de categorías y piezas, como se muestra en el ejercicio, para comprender la importancia del manejo de referencias entre registros relacionados.

#### 4. Consultas Básicas SQL
**Descripción:** Los estudiantes deben escribir consultas que seleccionen todos los datos de ambas tablas. Esto les permitirá familiarizarse con la selección de datos desde bases de datos relacionales.

#### 5. Join Izquierdo (LEFT JOIN) en SQL
**Descripción:** Se espera que realicen un LEFT JOIN entre las tablas `Piezas` y `Categorias`, similar al ejercicio, para aprender a combinar datos de múltiples tablas con relaciones complejas.

#### 6. Creación y Uso de Vista (VIEW)
**Descripción:** Los alumnos deben crear una vista que combine información de ambas tablas como se hizo en el ejemplo dado, y luego ejecutar consultas sobre esta vista para comprender cómo simplificar la visualización de datos relacionados.

#### 7. Crear Usuario con Privilegios SQL
**Descripción:** Se les pide que creen un nuevo usuario en MySQL y le asignen privilegios específicos para una base de datos específica, similar a lo mostrado en el ejercicio final.

#### 8. Optimización de Consultas SQL
**Descripción:** A partir de las consultas proporcionadas en los ejercicios, los estudiantes deben identificar áreas donde pueden optimizar la eficiencia de estas consultas sin alterar su propósito principal (por ejemplo, reduciendo operaciones innecesarias).

#### 9. Documentación de Código SQL
**Descripción:** Los alumnos deben documentar cada uno de los ejercicios proporcionados, describiendo qué hace cada bloque de código y por qué es importante en el contexto del manejo de bases de datos.

#### 10. Creación Automática de Bases de Datos e Inserción de Datos
**Descripción:** Se les pide que creen un script SQL completo que permita crear automáticamente una base de datos, sus tablas y la inserción de datos iniciales para establecer un entorno de trabajo funcional.

Estas actividades están diseñadas para reforzar los conceptos aprendidos a través del estudio detallado de los ejercicios proporcionados, adaptándolos al nivel de Formación Profesional.



<a id="repositorio-herramientas-de-control-de-versiones-uso-integrado-en-el-entorno-de-desarrollo"></a>
# Repositorio. Herramientas de control de versiones. Uso integrado en el entorno de desarrollo

<a id="repositorios-remotos"></a>
## Repositorios remotos

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/005-Repositorio.%20Herramientas%20de%20control%20de%20versiones.%20Uso%20integrado%20en%20el%20entorno%20de%20desarrollo/001-Repositorios%20remotos)

### Introducción a los ejercicios

It appears you are documenting a series of steps and commands related to version control using Git for deploying code from your local machine to a remote server. Here's an organized summary and some clarifications based on the provided files:

### 1. **Setting Up a Development Environment**
   - Create a repository (e.g., on GitHub).
   - Clone the repository locally using `git clone`.
   - Develop code in your preferred editor/IDE.
   - Commit changes with `git commit` and push them to the remote repository using `git push`.

### 2. **Deploying Code to Production**
   - Connect to the production server via SSH:
     ```bash
     ssh user@server_ip
     ```
   - Navigate to your project directory on the server.
   - Clone or pull the latest changes from the Git repository:
     ```bash
     sudo git clone https://github.com/username/repository.git
     # Or if already cloned:
     sudo git fetch origin main
     sudo git pull origin main
     ```

### 3. **Updating Deployed Code**
   - Make changes locally, commit them, and push to the remote repository.
   - On the server, update your project directory with `git pull` or `git fetch && git merge`.

### 4. **Managing Version History**
   - Fetch tags for version management:
     ```bash
     sudo git fetch --tags
     ```
   - View all commits and branches graphically:
     ```bash
     sudo git log --oneline --graph --decorate --all
     ```
   - Revert to a previous commit (careful with this, it can cause conflicts):
     ```bash
     git revert <commit_hash>
     ```

### 5. **Setting Up Git for Automatic Detection of User Information**
   - You encountered an issue where `git` was unable to detect the user information on the server:
     ```bash
     git config --global user.email "info@example.com"
     git config --global user.name "Your Name"
     ```
   - If there are multiple values set, use `--replace-all` to overwrite them:
     ```bash
     git config --global --replace-all user.name "jocarsa"
     ```

### Summary of Commands and Steps

#### **Setting Up Git for the First Time on a Server**
1. Set up global Git configurations:
   ```bash
   git config --global user.email "info@example.com"
   git config --global user.name "Your Name"
   ```
2. Clone your repository to the server:
   ```bash
   sudo git clone https://github.com/username/repository.git /path/to/project
   ```

#### **Updating Code on the Server**
1. Fetch changes from GitHub:
   ```bash
   cd /path/to/project
   sudo git fetch origin main
   ```
2. Merge or pull the latest changes:
   ```bash
   sudo git merge origin/main
   # Or to fast-forward directly:
   sudo git pull origin main
   ```

#### **Managing Version History**
1. List all versions and branches:
   ```bash
   sudo git log --oneline --graph --decorate --all
   ```
2. Revert to a previous commit (be cautious with this):
   ```bash
   git revert <commit_hash>
   ```

### Tips

- Ensure your server has the necessary permissions set correctly for Git operations.
- Use `sudo` sparingly and understand its implications, especially when dealing with system directories like `/var/www/html`.
  
This setup ensures that you maintain a clean development environment locally while keeping production up to date seamlessly.

### Actividades propuestas

Se ve que estás trabajando en un flujo de trabajo para desplegar cambios desde tu repositorio local a un servidor remoto usando Git. Aquí hay una lista de los pasos y comandos que has descrito, junto con algunas mejoras y recomendaciones:

### Pasos del Flujo de Trabajo

1. **Crear el Repositorio**
   - Crea un nuevo repositorio en GitHub.

2. **Clonar el Repositorio Localmente**
   - Usa `git clone` para obtener una copia local del repositorio.
     ```bash
     git clone https://github.com/tu-usuario/miweb.git
     ```

3. **Desarrollar y Hacer Cambios Locales**
   - Abre el proyecto en tu editor favorito y realiza los cambios necesarios.

4. **Hacer Commit y Push del Código Local**
   - Realiza commit de los cambios locales.
     ```bash
     git add .
     git commit -m "Mensaje descriptivo"
     ```
   - Haz un push al repositorio remoto.
     ```bash
     git push origin main
     ```

5. **Acceder y Actualizar el Servidor**
   - Conéctate a tu servidor usando SSH.
     ```bash
     ssh usuario@direccion-ip-servidor
     ```
   - Cambia de directorio al sitio web en el servidor (por ejemplo, `/var/www/html`).
   - Trae los cambios del repositorio remoto hasta el servidor.
     ```bash
     git fetch origin main
     git pull origin main
     ```

6. **Verificar Versiones y Hacer Revert**
   - Verifica las versiones disponibles en la historia de commits.
     ```bash
     git log --oneline --graph --decorate --all
     ```
   - Si es necesario, puedes revertir a una versión anterior.
     ```bash
     git revert <commit-hash>
     ```

### Problemas y Soluciones

1. **Problema con Permisos**
   Se detectó que los permisos de usuario no estaban configurados en el servidor. Esto se soluciona configurando:
   
   ```bash
   git config --global user.email "info@josevicentecarratala.com"
   git config --global user.name "jocarsa"
   ```
   Luego, para forzar la actualización del usuario global:
   ```bash
   git config --global --replace-all user.name "jocarsa"
   ```

2. **Aviso de Seguridad en Directorio**
   Para solucionar el aviso `git config --global --add safe.directory /var/www/html/miweb`, puedes agregar esa configuración:
   
   ```bash
   git config --local core.safedirectory true
   git config --local core.eol lf
   ```

### Mejoras y Recomendaciones

1. **Autenticación SSH**
   - Configura una clave SSH para evitar la entrada de contraseñas cada vez que te conectas al servidor.
   
2. **Automatización con Scripts**
   - Crea scripts en tu servidor para simplificar los pasos de actualización y despliegue.

3. **Integración Continua (CI)**
   - Considera usar una plataforma como GitHub Actions, Travis CI o GitLab CI para automatizar el proceso de construcción, pruebas y despliegue cuando se hacen cambios en tu repositorio.

4. **Seguridad**
   - Asegúrate de que solo los usuarios autorizados puedan acceder a tus archivos del servidor.
   
5. **Uso de Branches**
   - Considera el uso de diferentes branches para desarrollo, pruebas y producción.

Con estos pasos, podrás mejorar tu flujo de trabajo de despliegue desde local hasta la nube de manera más eficiente y segura.


<a id="documentacion-uso-de-comentarios-alternativas"></a>
## Documentación. Uso de comentarios. Alternativas

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/005-Repositorio.%20Herramientas%20de%20control%20de%20versiones.%20Uso%20integrado%20en%20el%20entorno%20de%20desarrollo/002-Documentaci%C3%B3n.%20Uso%20de%20comentarios.%20Alternativas)

### Introducción a los ejercicios

### Summary of the Refactorization Process and Files

The initial code was refactored to improve its structure by separating concerns into different files. Here's a summary of each file and what it does:

1. **Main Program:**
   - `015-refactorizacion en archivos individuales.py`: The main program that uses functions from various modules.
   
2. **Database Functions:**
   - `fcreartabla.py`:
     ```python
     import sqlite3

     def crear_tabla():
         basededatos = sqlite3.connect('clientes.db')
         cursor = basededatos.cursor()
         cursor.execute('''CREATE TABLE IF NOT EXISTS clientes (
                             id INTEGER PRIMARY KEY AUTOINCREMENT,
                             nombre TEXT NOT NULL,
                             edad INTEGER NOT NULL,
                             email TEXT NOT NULL UNIQUE
                         )''')    
         basededatos.commit()
         basededatos.close()
     ```
   - `fimprimemenu.py`:
     ```python
     def imprimeMenu():
         print("Seleccione una opción:")
         print("1. Añadir cliente")
         print("2. Ver clientes")
     ```
   - `finsertarcliente.py`:
     ```python
     import sqlite3

     def insertar_cliente():
         basededatos = sqlite3.connect('clientes.db')
         cursor = basededatos.cursor()
         nombre = input("Nombre: ")
         edad = int(input("Edad: "))
         email = input("Email: ")

         cursor.execute('''INSERT INTO clientes (nombre, edad, email)
                           VALUES (?, ?, ?)''', (nombre, edad, email))
         basededatos.commit()
         print("Cliente añadido exitosamente.")
         basededatos.close()
     ```
   - `fseleccionaclientes.py`:
     ```python
     import sqlite3

     def seleccionarClientes():
         basededatos = sqlite3.connect('clientes.db')
         cursor = basededatos.cursor()
         cursor.execute('SELECT * FROM clientes')
         clientes = cursor.fetchall()
         print("Lista de clientes:")
         for cliente in clientes:
             print(f"ID: {cliente[0]}, Nombre: {cliente[1]}, Edad: {cliente[2]}, Email: {cliente[3]}")
         basededatos.close()
     ```

   - `funcionesbasededatos.py`: 
     This file was the initial source of functions that were later split into individual files.
   
3. **Math Operations:**
   - `sumar.py`:
     ```python
     def sumar():
         resultado = operando1 + operando2
         return resultado
     ```
   - `sumarbueno.py`:
     ```python
     def sumar(operando1, operando2):
         resultado = operando1 + operando2
         return resultado
     ```

### Detailed Explanation of Refactoring Steps

#### Step 1: Create Individual Functions for Database Operations
- **fcreartabla.py**: This file contains the function to create a table in SQLite database.
- **fimprimemenu.py**: Contains the function that prints menu options.
- **finsertarcliente.py**: Handles inserting new customers into the database.
- **fseleccionaclientes.py**: Retrieves and displays all records from the customer table.

#### Step 2: Reorganize Functions in `funcionesbasededatos.py`
Each function was moved to their respective files (e.g., creating a table, menu printing, etc.). This approach enhances readability and maintainability of the code by separating concerns into different modules.

### Final Code in Main Program

The main program uses these functions as follows:
```python
from fcreartabla import crear_tabla
from finsertarcliente import insertar_cliente
from fseleccionaclientes import seleccionarClientes
from fimprimemenu import imprimeMenu

print("Bienvenido al sistema de gestión de clientes.")

while True:  # Bucle principal del programa  
    imprimeMenu()  # Muestra el menú de opciones
    opcion = input("Opción (1/2): ")  # Solicita la opción al usuario
    if opcion == '1':  # Si la opcion seleccionada es la 1
        insertar_cliente()  # Llama a la función para ver los clientes
    elif opcion == '2':  # Si la opcion seleccionada es la 2 
        seleccionarClientes()  # Llama a la función para insertar un cliente
    else:  # Si la opcion no es válida
        print("Opción no válida. Por favor, seleccione 1 o 2.")  #   Mensaje de error
    continuar = input("¿Desea realizar otra operación? (s/n): ")  # Pregunta si desea continuar
    if continuar.lower() != 's':  # Si la respuesta no es S 
        break  # Sale del bucle principal

# Close the database connection when exiting.
crear_tabla()
```

### Summary of Improvements:

- **Separation of Concerns**: Functions are grouped by their responsibilities, making it easier to understand and maintain the codebase.
- **Modularity**: The functions can be tested independently or used in other parts of an application without affecting each other.
- **Readability**: Each file has a clear purpose and contains only relevant functions.

### Recommendations:

1. **Database Connections**:
   - Close database connections explicitly to avoid resource leaks.
   
2. **Error Handling**:
   - Add try-except blocks for better error management when performing database operations or handling user input.
   
3. **Documentation**:
   - Provide clear docstrings and comments where necessary.

By refactoring the code in this manner, you can significantly improve its maintainability, testability, and overall structure.

### ejemplo
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es un programa en Python diseñado para listar el contenido de una carpeta específica, mostrando tanto las carpetas como los archivos que contiene. Utiliza la biblioteca `os` para interactuar con el sistema operativo y acceder a la estructura de directorios.

El programa comienza importando la librería `os`, necesaria para usar funciones como `os.walk()`. Esta función permite recorrer todos los subdirectorios y archivos desde un punto de inicio dado, mostrándolos en una estructura jerárquica. La función `mostrar_arbol_directorio` es donde se realiza el trabajo principal: toma la ruta del directorio que se desea visualizar como argumento.

Dentro de esta función, `os.walk(ruta_directorio)` itera sobre cada nivel del árbol de directorios proporcionado por el usuario. Para cada directorio recorrido, se calcula su nivel (haciendo una cuenta basada en la cantidad de separadores de ruta) y se usa para formatear la salida con un número apropiado de espacios, creando así la apariencia visual de una estructura jerárquica. Se imprime el nombre del directorio actual seguido por una lista de archivos que contiene, usando emojis (`📁` para carpetas y `📄` para archivos) para mejorar su legibilidad.

Finalmente, el programa solicita al usuario que ingrese la ruta del directorio a visualizar mediante un input simple. Luego llama a la función `mostrar_arbol_directorio` con esta ruta como argumento, efectivamente ejecutando todo el proceso de visualización del árbol de directorios.

Este tipo de programa es útil para entender y visualizar fácilmente cómo están organizados los archivos en tu sistema o cuando necesitas revisar el contenido de una carpeta específica de manera rápida y visual.

`001-ejemplo.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código en Python tiene como objetivo crear un programa sencillo que muestra el árbol de directorios y archivos desde una ruta específica proporcionada por el usuario. El programa utiliza la librería `os` para interactuar con el sistema de archivos del ordenador.

El funcionamiento principal está concentrado en la función `mostrar_arbol_directorio()`. Esta función recibe como parámetro la ruta de un directorio (por ejemplo, "C:/Usuarios/Ejemplo") y utiliza el método `os.walk()` para recorrer todos los subdirectorios y archivos desde ese punto. Para cada nivel del árbol que se recorre, el programa añade espacios en blanco para formar una estructura visual jerárquica. Además, usa caracteres ASCII y emojis para representar las carpetas (`📁`) y los archivos (`📄`), lo cual hace la salida más atractiva.

Finalmente, el código solicita al usuario que ingrese la ruta del directorio que quiere explorar mediante `input()`, y luego llama a la función `mostrar_arbol_directorio()` con esta ruta para imprimir en pantalla todo el árbol de carpetas y archivos.

`002-docstring en las funciones.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código Python crea un programa sencillo para visualizar el árbol de carpetas y archivos de un directorio específico. Primero, se importa la librería `os`, que proporciona una interfaz para interactuar con el sistema operativo. Luego, se define una función llamada `mostrar_arbol_directorio` que recibe como parámetro la ruta del directorio que queremos visualizar.

La función utiliza `os.walk()` para recorrer todos los archivos y carpetas dentro de la ruta especificada. Para cada nivel en el árbol, calcula cuántos niveles de profundidad hay a través de la cuenta de separadores (`/` o `\`) en la cadena del directorio actual. A partir de esta información, crea una indentación apropiada para que se visualice claramente cómo están anidados los directorios y archivos.

Finalmente, el código solicita al usuario que ingrese la ruta del directorio que desea mostrar. Luego, llama a la función `mostrar_arbol_directorio` con esta ruta como argumento, lo que genera en la consola una representación visual del árbol de directorios utilizando caracteres ASCII y emojis para diferenciar carpetas y archivos.

Este tipo de programa es útil para entender la estructura de un proyecto o sistema de archivos sin necesidad de navegar manualmente por cada carpeta.

`003-comentarios en linea.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código en Python es un programa sencillo que permite al usuario visualizar el árbol de archivos y carpetas de una ubicación específica del sistema. La función principal se llama `mostrar_arbol_directorio` y utiliza la librería estándar `os`, específicamente su método `os.walk()`. 

El código comienza solicitando al usuario que ingrese la ruta del directorio que desea visualizar. Luego, para cada carpeta en el árbol de directorios, imprime un símbolo "📁" seguido del nombre de la carpeta y después enumera todos los archivos dentro de esa carpeta usando un símbolo "📄". La indentación se ajusta automáticamente según la profundidad del subdirectorio actual para dar una representación visual clara de las relaciones jerárquicas entre carpetas.

Esta técnica es útil no solo para entender fácilmente la estructura del sistema de archivos, sino también como ejercicio práctico para aprender cómo manipular directorios y archivos en Python utilizando la biblioteca `os`.

`004-cambio la peticion.py`

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

### programa python de programacion
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código es un programa en Python que gestiona una base de datos SQLite para almacenar información sobre clientes. Primero, el programa importa la librería `sqlite3` y conecta a una base de datos llamada `clientes.db`. Luego crea una tabla llamada `clientes` si no existe ya, con campos para ID (automáticamente incrementado), nombre, edad e email (que debe ser único).

El código luego muestra un menú interactivo en el que el usuario puede elegir entre dos opciones: añadir un nuevo cliente o ver la lista de clientes existentes. Si el usuario selecciona "añadir cliente", se le pedirá que introduzca el nombre, edad y email del nuevo cliente. Estos datos se insertarán en la base de datos.

Si el usuario selecciona "ver clientes", el programa consulta todos los registros en la tabla `clientes` y muestra cada uno con su ID, nombre, edad y email. Después de realizar cualquier operación, el programa pregunta al usuario si desea hacer otra acción o terminar el programa.

Este tipo de aplicación es importante porque permite gestionar datos de manera estructurada y fácilmente accesible, lo que ayuda a mantener la información organizada y simplifica tareas como añadir nuevos registros o consultar los existentes.

`006-programa python de programacion.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código es un programa sencillo en Python que gestiona clientes a través de una base de datos SQLite. El programa permite al usuario añadir nuevos clientes y ver la lista completa de clientes registrados.

El código comienza importando el módulo `sqlite3`, necesario para trabajar con bases de datos SQLite. Luego, define dos funciones principales: `imprimeMenu()`, que imprime un menú sencillo en pantalla, y `insertar_cliente()`, que permite al usuario ingresar los detalles de un nuevo cliente (nombre, edad y email) y añadirlos a la base de datos.

La función principal del programa se encarga de crear una conexión con la base de datos SQLite (`clientes.db`), y crea una tabla llamada `clientes` si no existe ya. Esta tabla tiene columnas para el ID del cliente (autoincremental), nombre, edad y email (que debe ser único para cada cliente).

El bucle principal muestra al usuario un menú que ofrece dos opciones: añadir un nuevo cliente o ver la lista de todos los clientes registrados en la base de datos. Dependiendo de lo que escoja el usuario, el programa ejecuta las funciones correspondientes y luego pregunta si desea realizar otra operación.

Este tipo de código es útil para entender cómo interactuar con bases de datos desde Python, manejar interfaces básicas de usuario y aplicar buenas prácticas en la programación como encapsular la lógica del programa en funciones.

`007-aplicamos refactorizacion.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es un programa en Python que interactúa con una base de datos SQLite para gestionar clientes. El programa permite al usuario añadir nuevos clientes y ver la lista completa de clientes registrados. Aquí te explico cómo funciona:

1. **Conexión a la Base de Datos**: Al principio del código, se conecta a una base de datos SQLite llamada `clientes.db`. Si esta no existe, será creada automáticamente.

2. **Funciones**: El programa define varias funciones que realizan diferentes tareas:
   - `imprimeMenu()`: Muestra un menú al usuario con las opciones disponibles.
   - `insertar_cliente()`: Pide al usuario que ingrese el nombre, edad y correo electrónico de un nuevo cliente y lo añade a la base de datos.
   - `seleccionarClientes()`: Consulta todos los registros en la tabla `clientes` y muestra una lista con los detalles de cada cliente.

3. **Ciclo Principal**: El programa entra en un bucle infinito donde muestra el menú al usuario, pide que seleccione una opción (añadir o ver clientes), ejecuta la función correspondiente y luego pregunta si desea realizar otra operación. Si el usuario no quiere continuar, se cierra el ciclo y también la conexión a la base de datos.

Este tipo de programa es importante porque enseña cómo interactuar con bases de datos desde Python, gestionar entradas del usuario y manejar diferentes funciones para tareas específicas en un entorno controlado como una aplicación de gestión de clientes.

`008-seguimos refactorizando.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este programa en Python es una aplicación sencilla que gestiona una base de datos de clientes utilizando la biblioteca SQLite. El objetivo principal del código es permitir al usuario insertar nuevos clientes y ver la lista completa de clientes registrados.

El código comienza creando una conexión a una base de datos llamada `clientes.db` e inicializa un cursor para ejecutar consultas SQL. Luego, define varias funciones que realizan tareas específicas:

1. **imprimeMenu**: Muestra las opciones disponibles al usuario.
2. **insertar_cliente**: Permite al usuario ingresar los detalles (nombre, edad y email) de un nuevo cliente y añade este registro a la base de datos.
3. **seleccionarClientes**: Recupera todos los clientes registrados en la tabla `clientes` y muestra sus detalles por pantalla.
4. **crear_tabla**: Crea una tabla llamada `clientes` si no existe ya, con campos para almacenar el id (automáticamente generado), nombre, edad y email del cliente.

El programa entra en un bucle `while True`, donde se presenta al usuario un menú interactivo. Dependiendo de la opción elegida por el usuario ('1' o '2'), el programa llama a las funciones correspondientes para insertar un nuevo cliente o mostrar todos los clientes existentes. Si el usuario desea terminar, puede responder con 'n' cuando se le pregunta si quiere realizar otra operación.

Este tipo de código es importante porque enseña cómo interactuar con bases de datos utilizando Python y cómo estructurar una aplicación interactiva en la que el usuario puede elegir entre varias opciones para manipular los datos.

`009-documentamos dostring.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código Python se encarga de gestionar una base de datos simple para clientes utilizando el sistema SQLite. El programa permite al usuario insertar nuevos clientes y ver la lista de todos los clientes existentes en la base de datos.

El script comienza creando una conexión a una base de datos SQLite llamada `clientes.db`. Luego, define varias funciones que realizan diferentes tareas: `imprimeMenu()` muestra un menú interactivo al usuario, `insertar_cliente()` añade nuevos registros de clientes solicitando el nombre, edad y correo electrónico del cliente, y `seleccionarClientes()` obtiene todos los datos de la tabla 'clientes' e imprime cada registro.

Además, hay una función llamada `crear_tabla()` que asegura la existencia de la tabla 'clientes' en la base de datos. Esta función crea la tabla si no existe ya, con columnas para el ID (clave primaria autoincremental), nombre del cliente, edad y correo electrónico único.

El flujo principal del programa es un bucle infinito (`while True:`) que muestra siempre el menú al usuario hasta que este decide salir. Según la opción elegida por el usuario, se llama a las funciones correspondientes para insertar clientes o seleccionar clientes de la base de datos. Si el usuario no introduce una opción válida, se le informa con un mensaje de error y se vuelve a mostrar el menú.

Esta estructura permite una interacción fácil con la base de datos, permitiendo al usuario realizar operaciones básicas como añadir nuevos registros o ver los existentes de manera simple y eficiente.

`010-documentamos las funciones.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código en Python muestra cómo definir y utilizar una función para realizar una operación matemática básica, en este caso, la suma. Primero, se definen dos variables llamadas `operando1` e `operando2`, que contienen los valores numéricos 10 y 5 respectivamente. Luego, se crea una función llamada `sumar()` que toma estos dos operandos (pero no los especifica explícitamente como parámetros), suma sus valores globales e imprime el resultado de la suma.

El problema con esta implementación es que la función `sumar()` está accediendo a las variables globales (`operando1` y `operando2`) sin pasarlas como argumentos. Esto puede ser confuso y no es una práctica recomendada porque hace que la función dependa del contexto global en lugar de recibir directamente los valores necesarios para realizar su tarea. En un escenario ideal, deberíamos pasar estos operandos como parámetros a la función.

Al final, se llama a `sumar()` e imprime el resultado (15), demostrando que la suma entre 10 y 5 fue exitosa.

`011-ambito de la informacion.py`

```python
operando1 = 10
operando2 = 5

def sumar():
    resultado = operando1 + operando2
    return resultado

print(sumar())  # Imprime 15
```

### ahora externalizo
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es una parte importante de un programa en Python que utiliza funciones definidas en otros archivos. En este caso, el archivo `ahora externalizo.py` está importando la función `sumar()` del archivo `sumar.py`. Esta línea `from sumar import sumar` indica al intérprete de Python que debe buscar la función llamada `sumar` en el archivo `sumar.py` y cargarla para su uso.

Luego, se definen dos variables: `operando1` con un valor de 10 y `operando2` con un valor de 5. Sin embargo, estas variables no están siendo utilizadas directamente en la función `sumar()`. Esto sugiere que puede haber algo mal en cómo las funciones han sido diseñadas o implementadas.

Finalmente, el código llama a la función `sumar()` y utiliza `print` para mostrar su resultado, que se supone debe ser 15. Sin embargo, dado que los operandos no están siendo pasados como argumentos a la función `sumar()`, parece haber un error en cómo se espera que funcione esta función o cómo está implementada.

Es importante revisar el archivo `sumar.py` para entender por qué la función `sumar()` devuelve 15 sin recibir los operandos como parámetros. Esto podría implicar una mala práctica de programación ya que las funciones deberían generalmente utilizar los argumentos proporcionados para realizar sus cálculos en lugar de depender de variables globales definidas fuera del alcance de la función.

`012-ahora externalizo.py`

```python
from sumar import sumar

operando1 = 10
operando2 = 5

print(sumar())  # Imprime 15
```

### llamada buena a sumar
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código Python está haciendo uso de una función llamada `sumar` que se encuentra en otro archivo denominado `sumarbueno.py`. Primero, el programa define dos variables: `operando1`, cuyo valor es 10, y `operando2`, cuyo valor es 5. Luego, llama a la función `sumar()` pasándole estas dos variables como argumentos. La función `sumar()` suma los valores de estos operandos y devuelve el resultado.

El código final imprime en pantalla el resultado obtenido de llamar a esta función, que debería ser 15 si todo está configurado correctamente. Esta práctica es útil para demostrar cómo modularizar un programa puede hacerlo más fácil de entender y mantener, ya que la operación de suma se encuentra en otro archivo separado.

Es importante destacar el uso del comentario `# Imprime 15` al final, el cual sirve como una forma rápida de indicar a otros desarrolladores qué resultado esperar ver cuando ejecutan este código. Esto es especialmente útil durante la fase de desarrollo y depuración para asegurar que cada parte del programa está funcionando correctamente según lo planeado.

`013-llamada buena a sumar.py`

```python
from sumarbueno import sumar

operando1 = 10
operando2 = 5

print(sumar(operando1,operando2))  # Imprime 15
```

### refactorizamos mas alla
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es un programa simple en Python que gestiona una base de datos de clientes usando SQLite. El objetivo principal es permitir a los usuarios insertar nuevos registros de clientes y listar todos los clientes existentes.

El programa comienza importando varias funciones desde otro archivo llamado `funcionesbasededatos.py`, incluyendo `imprimeMenu()` para mostrar un menú al usuario, `insertar_cliente()` para agregar un nuevo cliente, `seleccionarClientes()` para ver la lista de clientes y `crear_tabla()` para crear la tabla en SQLite si no existe.

El código se ejecuta dentro de un bucle infinito (`while True:`) que mantiene el programa activo hasta que el usuario decide salir. Dentro del bucle, se muestra el menú de opciones al usuario, quien debe elegir entre insertar un nuevo cliente (opción 1) o ver la lista de clientes existentes (opción 2). Si el usuario introduce una opción no válida, se le informa con un mensaje y se le pide que elija nuevamente. Al final de cada operación, se pregunta al usuario si desea realizar otra acción. Si responde "n" o cualquier otra cosa distinta a "s", el programa sale del bucle y termina.

Este tipo de estructura es común en aplicaciones interactivas donde se proporcionan opciones al usuario para que realice diferentes acciones hasta que decida finalizar la ejecución.

`014-refactorizamos mas alla.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es una interfaz básica para gestionar una base de datos de clientes utilizando SQLite. El programa permite al usuario insertar nuevos clientes y ver una lista de los clientes existentes en la base de datos.

El código comienza importando varias funciones definidas en otros archivos: `crear_tabla`, `insertar_cliente`, `seleccionarClientes` e `imprimeMenu`. Estas funciones se encargan de las tareas específicas como crear la tabla en la base de datos, insertar un nuevo cliente y seleccionar clientes existentes. La función `imprimeMenu` muestra al usuario un menú con opciones disponibles.

El programa entra en un bucle infinito (`while True`) que presenta continuamente el menú al usuario hasta que deciden salir del mismo. Dentro del bucle, se solicita al usuario que seleccione una opción (1 para insertar cliente o 2 para ver los clientes). Si la opción seleccionada es válida, se llama a la función correspondiente; si no lo es, se muestra un mensaje de error.

Después de cada operación, el programa pregunta al usuario si desea realizar otra acción. Si la respuesta es negativa (se introduce cualquier cosa excepto 's' o 'S'), el bucle termina y el programa finaliza su ejecución.

Este tipo de estructura es muy común en aplicaciones interactivas que necesitan un flujo constante de entrada del usuario para realizar varias operaciones según las decisiones tomadas por éste.

`015-refactorizacion en archivos individuales.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es una función llamada `crear_tabla()` que se encarga de crear una tabla llamada 'clientes' en una base de datos SQLite si esta no existe ya. La función utiliza el módulo `sqlite3` para conectarse a la base de datos y ejecutar comandos SQL.

Lo primero que hace es conectar con la base de datos 'clientes.db'. Luego, crea un objeto cursor que permite ejecutar comandos SQL en la base de datos. El comando SQL dentro de `cursor.execute()` define cómo debe ser la estructura de la tabla 'clientes', especificando los campos como 'id' (un número entero que será clave primaria y autoincremental), 'nombre' (texto requerido para almacenar el nombre del cliente), 'edad' (número entero requerido para almacenar la edad) y 'email' (texto único requerido para asegurar que cada email sea exclusivo en la base de datos).

Finalmente, `basededatos.commit()` se utiliza para guardar los cambios realizados en la base de datos.

Esta función es importante porque permite inicializar o configurar correctamente la estructura de una base de datos antes de comenzar a trabajar con ella, asegurando que todos los campos necesarios estén disponibles desde el principio.

`fcreartabla.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código define una función en Python llamada `imprimeMenu` que se utiliza para mostrar un menú sencillo al usuario, permitiéndole elegir entre diferentes opciones relacionadas con la gestión de clientes. La función no recibe ningún parámetro y tampoco retorna ningún valor; simplemente imprime varias líneas de texto en la consola.

La función comienza imprimiendo el mensaje "Seleccione una opción:", lo que indica al usuario que debe hacer una elección. Luego, presenta dos opciones: "1. Añadir cliente" e "2. Ver clientes". Estas opciones son ejemplos de cómo podría interactuar un usuario con un sistema básico para gestionar información sobre clientes.

La documentación dentro de la función (`docstring`), que aparece entre triples comillas al principio, describe claramente su propósito y comportamiento, lo cual es útil tanto para otros programadores que leerán el código como para recordarte a ti mismo qué hace esta función en el futuro.

`fimprimemenu.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es una función en Python que se encarga de insertar un nuevo cliente en una base de datos SQLite. La función `insertar_cliente` conecta a la base de datos llamada 'clientes.db' y utiliza el módulo sqlite3 para interactuar con ella.

Dentro de la función, se piden al usuario que ingrese el nombre, edad y email del nuevo cliente mediante las funciones `input()`. Estos datos son luego insertados en una tabla de la base de datos llamada 'clientes', utilizando una consulta SQL (`INSERT INTO`) que añade los valores proporcionados por el usuario en los campos correspondientes.

Finalmente, se confirma la operación con `basededatos.commit()` para guardar los cambios y se imprime un mensaje indicando que el cliente ha sido añadido exitosamente. Esta función es importante porque facilita la gestión de datos en una base de datos, permitiendo a los usuarios agregar nuevos registros fácilmente sin necesidad de manipular directamente las consultas SQL.

Este tipo de funcionalidades son comunes en aplicaciones que manejan información de clientes o usuarios, y ayuda a mantener el código limpio y organizado al encapsular la lógica de inserción dentro de una función.

`finsertarcliente.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código es una función en Python llamada `seleccionarClientes` que se encarga de seleccionar y mostrar todos los registros de la tabla "clientes" desde una base de datos SQLite. La función no requiere ningún parámetro ni retorna valores, pero imprime directamente a la consola la información de los clientes.

Primero, la función conecta con la base de datos `clientes.db` usando el módulo `sqlite3`. Luego, crea un objeto cursor que permite ejecutar comandos SQL y obtener resultados. Selecciona todos los registros de la tabla "clientes" utilizando una consulta SQL simple (`SELECT * FROM clientes`). Los resultados se almacenan en la variable `clientes`, después recorre este conjunto de datos con un bucle for e imprime cada cliente, mostrando su ID, nombre, edad y email.

Esta función es útil para ver el contenido actual de tu tabla de clientes sin tener que abrir una interfaz gráfica o utilizar otra herramienta externa.

`fseleccionaclientes.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este archivo de Python contiene funciones que interactúan con una base de datos SQLite para gestionar clientes. Cada función tiene un propósito específico:

1. **`imprimeMenu()`**: Muestra al usuario un menú con dos opciones: añadir cliente y ver clientes. Esta función no recibe parámetros ni devuelve ningún valor, simplemente imprime en pantalla las opciones disponibles.

2. **`insertar_cliente()`**: Permite a los usuarios insertar nuevos registros de clientes en la base de datos. La función solicita al usuario que ingrese el nombre, edad y email del cliente nuevo. Luego, utiliza estas entradas para ejecutar una consulta SQL que inserta un nuevo registro en la tabla `clientes`. Finalmente, muestra un mensaje indicando que el cliente ha sido añadido con éxito.

3. **`seleccionarClientes()`**: Se encarga de seleccionar y mostrar todos los clientes registrados en la base de datos. Ejecuta una consulta SQL para obtener toda la información almacenada en la tabla `clientes`, luego recorre cada registro obtenido e imprime sus detalles en pantalla, incluyendo el ID único generado automáticamente por SQLite.

4. **`crear_tabla()`**: Verifica si existe una tabla llamada `clientes` en la base de datos y, en caso de que no exista, crea dicha tabla con columnas para almacenar el nombre, edad, email (único) y un campo ID como clave primaria automática.

Estas funciones son fundamentales para desarrollar aplicaciones que necesitan gestionar información de clientes de manera eficiente. Utilizar una base de datos permite mantener la integridad de los datos y facilita operaciones complejas, como recuperar registros específicos o realizar búsquedas avanzadas.

`funcionesbasededatos.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es una función en Python llamada `sumar` que está diseñada para calcular la suma de dos números. Sin embargo, hay un problema importante: no se especifican ni inicializan las variables `operando1` y `operando2`, lo cual hace que el código tenga errores al intentar ejecutarse porque estas variables no existen en este contexto. Para que esta función funcione correctamente, deberías pasar estos valores como parámetros cuando la llames o declararlas dentro de la función con un valor inicial.

Lo importante aquí es entender que una función debe recibir los datos necesarios para realizar su tarea a través de sus argumentos. En el caso correcto, `sumar` debería verse así:

```python
def sumar(operando1, operando2):
    resultado = operando1 + operando2
    return resultado
```

De esta manera, cuando llames a la función `sumar`, podrás proporcionar los números que deseas sumar como argumentos. Esto es crucial para garantizar que tu código sea reutilizable y funcional en diferentes situaciones.

`sumar.py`

```python
def sumar():
    resultado = operando1 + operando2
    return resultado
```

### sumarbueno
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código define una función en Python llamada `sumar` que toma dos parámetros: `operando1` y `operando2`. La función suma estos dos operandos utilizando el operador `+`, almacena el resultado en la variable `resultado`, y finalmente devuelve este valor usando la instrucción `return`.

Esta función es importante porque encapsula una operación matemática simple (la suma) dentro de un bloque reutilizable de código. Esto facilita su uso en diferentes partes del programa sin tener que escribir nuevamente el código para sumar dos números, lo cual mejora la claridad y mantenibilidad del programa.

`sumarbueno.py`

```python
def sumar(operando1, operando2):
    resultado = operando1 + operando2
    return resultado
```

### Actividades propuestas

He revisado los archivos proporcionados y he identificado algunos problemas y sugerencias para mejorar la estructura del código. Aquí te presento mis observaciones:

### Problemas Detectados

1. **Ambito de Variables en `fcreartabla.py`, `finsertarcliente.py`, etc.:**
   En estos archivos, las variables `basededatos` y `cursor` están definidas dentro de cada función pero no se cierran correctamente después del uso.

2. **Repetición de Código:**
   El código para conectarse a la base de datos está repetido en múltiples archivos (`finsertarcliente.py`, `fseleccionaclientes.py`, etc.).

3. **Dependencia Excesiva entre Módulos:**
   En algunos módulos, como `sumarbueno.py` y `funcionesbasededatos.py`, las funciones dependen de variables globales que pueden no estar definidas en el contexto correcto.

4. **Uso Inadecuado del Bucle Principal en Programa Principal (`015-refactorizacion en archivos individuales.py`):**
   En este archivo, todas las operaciones se realizan dentro del bucle principal, pero los módulos utilizados no manejan correctamente la conexión a la base de datos y su cierre.

### Sugerencias para Mejorar

#### 1. Manejo de Conexión a Base de Datos
Podemos definir una clase en un archivo separado (por ejemplo, `database.py`) que se encargue de la conexión y manejo de la base de datos:

```python
# database.py
import sqlite3

class Database:
    def __init__(self):
        self.conn = None
        
    def connect(self):
        if not self.conn:
            self.conn = sqlite3.connect('clientes.db')
            return self.conn.cursor()
        
    def close(self):
        if self.conn:
            self.conn.close()
```

#### 2. Refactorizar Funciones
Refactorizar las funciones para que no dependan de variables globales y manejen correctamente la conexión a la base de datos:

```python
# finsertarcliente.py
from database import Database

def insertar_cliente():
    '''
    Inserta un nuevo cliente en la base de datos.
    Solicita al usuario el nombre, edad y email del cliente.
    No retorna valores.
    '''
    db = Database()
    cursor = db.connect()
    
    nombre = input("Nombre: ")
    edad = int(input("Edad: "))
    email = input("Email: ")

    cursor.execute('''
        INSERT INTO clientes (nombre, edad, email)
        VALUES (?, ?, ?)''', 
                    (nombre, edad, email))
    
    db.close()
```

#### 3. Refactorizar el Menú y Flujo del Programa
Refactorizar la lógica principal para manejar adecuadamente la conexión a la base de datos:

```python
# main.py
from database import Database
import finsertarcliente as insertar_cliente_module
import fseleccionaclientes as selecciona_clientes_module

def main():
    db = Database()
    
    while True:
        imprimeMenu()  # Muestra el menú de opciones
        opcion = input("Opción (1/2): ")
        
        if opcion == '1':
            insertar_cliente_module.insertar_cliente(db)
        elif opcion == '2': 
            selecciona_clientes_module.seleccionarClientes(db)
        else:
            print("Opción no válida. Por favor, seleccione 1 o 2.")
            
        continuar = input("¿Desea realizar otra operación? (s/n): ")
        
        if continuar.lower() != 's':
            break
        
    db.close()

def imprimeMenu():
    '''
    Muestra el menú de opciones al usuario.
    No tiene parámetros ni retorna valores.
    '''
    print("Seleccione una opción:")
    print("1. Añadir cliente")
    print("2. Ver clientes")

if __name__ == "__main__":
    main()
```

### Conclusión
Estos cambios permitirán un manejo más limpio y eficiente de la base de datos, eliminando la repetición del código y asegurando que las conexiones se cierren adecuadamente. Además, mejora el flujo principal del programa para que sea más modular y fácil de mantener.

Espero que estas sugerencias te sean útiles para mejorar tu estructura de código.


<a id="integracion-continua-herramientas"></a>
## Integración continua. Herramientas

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/005-Repositorio.%20Herramientas%20de%20control%20de%20versiones.%20Uso%20integrado%20en%20el%20entorno%20de%20desarrollo/003-Integraci%C3%B3n%20continua.%20Herramientas)


<a id="simulacro-examen"></a>
## Simulacro examen

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/005-Repositorio.%20Herramientas%20de%20control%20de%20versiones.%20Uso%20integrado%20en%20el%20entorno%20de%20desarrollo/004-Simulacro%20examen)

### Introducción a los ejercicios

Este conjunto de ejercicios está diseñado para familiarizarte con la refactorización y modularización del código, así como con las herramientas de control de versiones y el uso integrado en un entorno de desarrollo. Comenzarás por tomar una aplicación básica que gestiona un portafolio en una base de datos MySQL y refactorizarla extrayendo funciones para mejorar su estructura y legibilidad. Luego, estas funciones se separan en archivos independientes y documentas adecuadamente tanto el código como las funciones específicas. Finalmente, aprenderás a crear un repositorio en GitHub, clonarlo localmente y gestionar cambios con commits y pushes, así como verificar la historia de versiones en línea.

Estos ejercicios te permitirán practicar competencias clave como refactorización de código, modularización, uso eficiente de bases de datos, documentación detallada y manejo avanzado de control de versiones.

### base del examen
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código es un programa en Python que gestiona una base de datos llamada "portafolio" utilizando la biblioteca `mysql.connector`. El objetivo principal del programa es permitir al usuario realizar operaciones básicas sobre registros en una tabla denominada "piezas". Estas operaciones incluyen insertar, listar, actualizar y eliminar registros.

El código comienza por establecer una conexión con la base de datos MySQL utilizando las credenciales proporcionadas (host, user, password y database). Luego define una función llamada `presentaMenu()` que muestra un menú al usuario permitiéndole seleccionar entre varias acciones: insertar nueva información en la base de datos, listar todos los registros existentes, actualizar registros o eliminarlos.

En el bucle `while True`, se llama continuamente a la función `presentaMenu()` y el programa espera una entrada del usuario para saber qué acción realizar. Dependiendo del número que ingrese el usuario, el programa ejecutará diferentes instrucciones SQL para interactuar con la base de datos. Por ejemplo, si el usuario selecciona "1", se solicitan los detalles necesarios (título, descripción, fecha y nombre de imagen) y luego se insertan en la tabla "piezas". Si elige "2", se ejecuta una consulta SELECT que recupera todos los registros de la tabla y los imprime en pantalla. Las opciones 3 y 4 permiten actualizar o eliminar registros específicos basándose en un identificador proporcionado por el usuario.

Este tipo de programa es útil para aprender cómo interactuar con bases de datos desde Python, gestionar diferentes tipos de consultas SQL y manejar entradas del usuario para realizar operaciones CRUD (Crear, Leer, Actualizar, Borrar) en una base de datos.

`002-base del examen.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código Python crea una aplicación sencilla que gestiona un portafolio almacenado en una base de datos MySQL. La aplicación comienza conectándose a la base de datos con los detalles proporcionados, como el host y las credenciales del usuario. Luego define cuatro funciones principales: `presentaMenu`, `insertar`, `seleccionar` y `actualizar`. 

La función `presentaMenu` muestra un menú en pantalla que permite al usuario elegir entre insertar una nueva pieza, listar todas las piezas existentes, actualizar una pieza específica o eliminar una pieza. Las funciones `insertar`, `seleccionar`, `actualizar` y `eliminar` realizan operaciones específicas en la base de datos según lo seleccionado por el usuario.

El programa se ejecuta en un bucle infinito que muestra siempre el menú y solicita al usuario que seleccione una opción. Dependiendo de la opción elegida, llama a la función correspondiente para realizar las acciones necesarias sobre los registros en la tabla `piezas` de la base de datos.

Esta estructura es útil porque permite organizar el código en funciones pequeñas y manejables, facilitando su mantenimiento y expansión. Además, separar la lógica del menú de las operaciones en la base de datos hace que el programa sea más modular y fácil de entender para otros desarrolladores o usuarios técnicos.

`003-extraccion a funciones.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código es una pequeña aplicación en Python que permite al usuario gestionar un portafolio, como podría ser una base de datos de proyectos o ítems valiosos. La aplicación importa varias funciones desde otro archivo llamado `funcionesbasededatos.py`, donde se definen las acciones específicas para cada operación (insertar, seleccionar, actualizar y eliminar).

La estructura principal del código es un bucle `while True` que mantiene la aplicación en ejecución indefinidamente hasta que el usuario decida finalizarla manualmente. Dentro de este bucle, primero se llama a la función `presentaMenu()`, que probablemente muestra al usuario las opciones disponibles para interactuar con el portafolio.

Después del menú, el programa solicita al usuario que ingrese una opción numérica. Dependiendo de esta entrada, el código ejecuta diferentes funciones importadas: si se selecciona '1', la función `insertar()` es llamada; si se selecciona '2', entonces `seleccionar()`, y así sucesivamente hasta completar todas las opciones disponibles.

Esta estructura es común en aplicaciones de línea de comandos que requieren interacción continua con el usuario, permitiendo realizar operaciones básicas sobre datos almacenados. Es importante porque ayuda a organizar la lógica del programa y facilita su mantenimiento y expansión.

`004-importacion de archivo.py`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código es una pequeña aplicación en Python que gestiona un portafolio de piezas utilizando operaciones básicas de gestión (CRUD: Crear, Leer, Actualizar y Eliminar). El programa se inicia mostrando un menú interactivo para el usuario donde pueden seleccionar diferentes acciones. 

El bucle `while True` asegura que el menú se presente continuamente hasta que decidan interrumpir la ejecución del programa manualmente. Cada vez que el usuario ingresa una opción (1 para insertar, 2 para seleccionar, 3 para actualizar y 4 para eliminar), el código llama a las funciones correspondientes desde un módulo externo llamado `funcionesbasededatos`. Estas funciones se encargan de realizar las operaciones específicas en la base de datos.

Este tipo de estructura es útil en aplicaciones interactivas que requieren acciones repetitivas basadas en la elección del usuario, permitiendo una gestión sencilla y clara de portafolios o cualquier otro conjunto de datos.

`005-documentacion.py`

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

### funcionesbasededatos
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código Python interactúa con una base de datos MySQL llamada "portafolio" para gestionar una tabla denominada "piezas". La conexión a la base de datos se establece al inicio del script utilizando las credenciales proporcionadas y crea un cursor que permite ejecutar consultas SQL.

El código contiene cuatro funciones principales: `presentaMenu()`, `insertar()`, `seleccionar()` y `actualizar()`. La función `presentaMenu()` muestra un menú en pantalla con opciones para insertar, listar, actualizar o eliminar registros. Cada opción llama a una función específica que realiza la acción correspondiente.

La función `insertar()` solicita al usuario los detalles de una nueva pieza (título, descripción, fecha y nombre del archivo) e insértala en la base de datos mediante un comando SQL INSERT. La función `seleccionar()` consulta todos los registros de la tabla "piezas" y muestra cada fila por pantalla. Por último, la función `actualizar()` permite cambiar los detalles de una pieza existente basándose en su identificador único y, similarmente a insertar(), solicita al usuario los nuevos valores para actualizar.

Además, se define la función `eliminar()`, que toma un identificador como entrada del usuario y elimina el registro correspondiente de la tabla "piezas". Todas estas funciones garantizan que las modificaciones realizadas en la base de datos sean permanentes mediante la llamada a `conexion.commit()` después de cada operación SQL.

Este código es importante para aprender cómo interactuar con una base de datos desde Python, gestionar transacciones y manejar diferentes tipos de consultas SQL.

`funcionesbasededatos.py`

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

### Actividades propuestas

### Actividad 1: Refactorización y Extracción de Funciones

**Descripción:** Los alumnos deben tomar el código del archivo `002-base del examen.py` y refactorizarlo extrayendo las funciones existentes. Se espera que creen una nueva estructura funcional más clara y legible.

### Actividad 2: Documentación y Mejora de Código

**Descripción:** Los estudiantes deben documentar adecuadamente el código generado en la actividad anterior, utilizando docstrings para cada función y comentarios donde sea necesario.

### Actividad 3: Descomposición del Proyecto a Módulos

**Descripción:** Se requiere que los alumnos separen las funciones descomponiendo el código en diferentes archivos (modularización), creando un módulo de funciones que pueda ser importado desde otro archivo principal. Esto debe hacerse basándose en `003-extraccion a funciones.py`.

### Actividad 4: Integración con Módulos Externos

**Descripción:** Los estudiantes deben importar las funciones de los archivos separados (modularizados) y utilizarlos dentro del archivo principal para crear una estructura claramente modular.

### Actividad 5: Manejo de Errores y Excepciones en Python

**Descripción:** Se pide a los alumnos que introduzcan manejo de excepciones básicas alrededor de las operaciones con la base de datos, asegurándose de capturar errores comunes como problemas de conexión.

### Actividad 6: Mejora Interactiva del Menú

**Descripción:** Los estudiantes deben mejorar el menú interactivo proporcionado en los ejercicios existentes, permitiendo a los usuarios elegir entre múltiples opciones y proporcionando retroalimentación instantánea sobre sus acciones.

### Actividad 7: Creación de Repositorio GitHub

**Descripción:** Los alumnos deben crear un nuevo repositorio en GitHub para el proyecto actual. Luego, clonar este repositorio localmente utilizando GitHub Desktop y realizar su primera subida (commit y push).

### Actividad 8: Trabajando con Versiones

**Descripción:** Después de establecer el entorno de desarrollo inicial, los estudiantes deben realizar cambios en sus archivos locales, hacer un nuevo commit y subir estos cambios al repositorio remoto. Finalmente, deben revisar la historia de versiones del proyecto.

Estas actividades buscan mejorar las habilidades técnicas y metodológicas de los alumnos, desde el manejo básico de Python hasta prácticas modernas de control de código fuente como Git y GitHub.


<a id="ejercicio-de-final-de-unidad-4"></a>
## Ejercicio de final de unidad

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/005-Repositorio.%20Herramientas%20de%20control%20de%20versiones.%20Uso%20integrado%20en%20el%20entorno%20de%20desarrollo/101-Ejercicio%20de%20final%20de%20unidad)

### Introducción a los ejercicios

El conjunto de ejercicios en esta carpeta está diseñado para ayudarte a comprender y aplicar las herramientas de control de versiones, especialmente Git, dentro del entorno de desarrollo. Este ejercicio se enfoca en la integración y uso efectivo de estas herramientas durante el proceso de desarrollo de software, lo que incluye tareas como clonar repositorios, crear ramas, realizar commits y gestionar fusiones. A través de esta práctica, mejorarás tus habilidades en gestión de proyectos, colaboración con otros desarrolladores y mantenimiento de un historial limpio y estructurado de tu código.

Este tipo de actividades son fundamentales para los estudiantes de Formación Profesional, ya que te preparan para entornos reales de trabajo donde el control de versiones es una herramienta crucial.

### Actividades propuestas

### Actividades Propuestas:

1. **Introducción a Git y GitHub**
   - Los estudiantes deben crear una cuenta en GitHub (si aún no la tienen) y configurar Git localmente en su máquina de desarrollo.
   - Se pretende que comprendan los conceptos básicos de control de versiones y cómo integrarse con plataformas como GitHub.

2. **Clonación y Navegación en Repositorios**
   - Los estudiantes deben clonar un repositorio existente desde GitHub e interactuar con él utilizando comandos básicos de Git (como `git status`, `git add`, `git commit`).
   - Se espera que aprendan a gestionar sus proyectos y entender el flujo básico de trabajo con Git.

3. **Creación de Ramas**
   - Los estudiantes deben crear nuevas ramas para trabajar en cambios específicos sin afectar la rama principal del proyecto.
   - Este ejercicio pretende enseñarles cómo organizar su desarrollo y colaborar eficazmente con otros desarrolladores.

4. **Merge y Resolución de Conflictos**
   - Los estudiantes deben practicar el proceso de fusionar ramas, identificar y resolver conflictos en Git.
   - Se busca que adquieran habilidades para integrar cambios sin problemas y mantener la integridad del código base.

5. **Historial de Comités**
   - Los alumnos deberán examinar el historial de un proyecto usando comandos como `git log` e identificar los commits más recientes.
   - El objetivo es que se familiaricen con cómo revisar y rastrear cambios históricos en un repositorio.

6. **Revisión Pull Request**
   - Los estudiantes deben enviar sus propios códigos modificados a una rama específica del proyecto mediante pull requests (PR) y aprender a revisar los PR de otros compañeros.
   - Se espera que comprendan cómo el flujo colaborativo funciona en entornos de desarrollo modernos.

7. **Documentación Markdown**
   - Los alumnos deben escribir documentación básica usando Markdown, similar al estilo del archivo proporcionado.
   - Se pretende enseñarles a crear y mantener la documentación de los proyectos de una manera clara y eficiente.

8. **Automatización con Scripts Git**
   - Los estudiantes deben crear un script simple que automatice ciertas tareas repetitivas en el flujo de trabajo de desarrollo.
   - Se busca que aprendan sobre scripting básico y cómo mejorar la productividad mediante automatización.

9. **Integración Continua (CI) Básica**
   - Implementar una configuración básica para integración continua utilizando servicios como GitHub Actions o Travis CI.
   - El objetivo es familiarizar a los estudiantes con conceptos clave de integración continua y entrega continua en desarrollo moderno.

10. **Seguridad y Mantenimiento del Repositorio**
    - Los alumnos deben identificar y corregir vulnerabilidades comunes, gestionar secretos y configuraciones seguras para el repositorio.
    - Se pretende que aprendan a mantener un entorno de desarrollo seguro y profesional.



<a id="elaboracion-de-diagramas-de-clases"></a>
# Elaboración de diagramas de clases

<a id="clases-atributos-metodos-y-visibilidad"></a>
## Clases. Atributos, métodos y visibilidad

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/006-Elaboraci%C3%B3n%20de%20diagramas%20de%20clases/001-Clases.%20Atributos%2C%20m%C3%A9todos%20y%20visibilidad)

### diagrama inicial cliente
<small>Creado: 2026-04-20 18:32</small>

`diagrama inicial cliente.html`

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
  width: 240.00002774325282px;
  height: 261.9999833540482px;
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

/* texto libre */
.shape.text {
  background: transparent;
  border: none;
  box-shadow: none;
  padding: 0;
  min-width: 20px;
  min-height: 20px;
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

<div class="shape entity" style="left:40px;top:40px;width:160.00002774325276px;height:181.9999833540482px;">
  <div class="entity-header">Cliente</div>
  <div class="entity-properties">
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">id</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">nombre</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">apellidos</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">email</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">direccion</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
</div>
</body>
</html>
```

### diagrama inicial cliente
<small>Creado: 2026-04-20 18:32</small>

`diagrama inicial cliente.json`

```json
{
  "formas": [
    {
      "id": "forma-1",
      "tipo": "entity",
      "left": "379.462px",
      "top": "381px",
      "width": "",
      "height": "",
      "entityName": "Cliente",
      "properties": [
        {
          "id": "prop-1",
          "name": "id"
        },
        {
          "id": "prop-2",
          "name": "nombre"
        },
        {
          "id": "prop-3",
          "name": "apellidos"
        },
        {
          "id": "prop-4",
          "name": "email"
        },
        {
          "id": "prop-5",
          "name": "direccion"
        }
      ]
    }
  ],
  "flechas": []
}
```

### diagrama inicial cliente
<small>Creado: 2026-04-20 18:32</small>

`diagrama inicial cliente.py`

```python
from typing import Optional

class Cliente:
    def __init__(self, id: Optional[int] = None, nombre: Optional[str] = None, apellidos: Optional[str] = None, email: Optional[str] = None, direccion: Optional[str] = None):
        self.id = id
        self.nombre = nombre
        self.apellidos = apellidos
        self.email = email
        self.direccion = direccion

    def __repr__(self):
        return f"Cliente(id={self.id!r}, nombre={self.nombre!r}, apellidos={self.apellidos!r}, email={self.email!r}, direccion={self.direccion!r})"
```

### diagrama inicial cliente
<small>Creado: 2026-04-20 18:32</small>

`diagrama inicial cliente.sql`

```sql
CREATE TABLE cliente (
  id INT,
  nombre VARCHAR(255),
  apellidos VARCHAR(255),
  email VARCHAR(255),
  direccion VARCHAR(255),
  PRIMARY KEY (id)
);
```

### diagrama inicial cliente
<small>Creado: 2026-04-20 18:32</small>

`diagrama inicial cliente.svg`

```
<svg xmlns="http://www.w3.org/2000/svg" width="240.00002774325282" height="261.9999833540482" viewBox="0 0 240.00002774325282 261.9999833540482">

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
        
<rect class="shape-entity" x="40" y="40" width="160.00002774325276" height="181.9999833540482" />
<line x1="40" y1="69.99999999999999" x2="200.00002774325276" y2="69.99999999999999" stroke="#e5e7eb" stroke-width="1"/>
<text x="120.00001387162638" y="59.500002774325274" text-anchor="middle">Cliente</text>
<text x="93.76562499999994" y="90.00000554865056">id</text>
<text x="93.76562499999994" y="114">nombre</text>
<text x="93.76562499999994" y="137.99999445134938">apellidos</text>
<text x="93.76562499999994" y="162.0000166459517">email</text>
<text x="93.76562499999994" y="185.9999833540482">direccion</text>
</svg>
```


<a id="objetos-instanciacion"></a>
## Objetos. Instanciación

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/006-Elaboraci%C3%B3n%20de%20diagramas%20de%20clases/002-Objetos.%20Instanciaci%C3%B3n)


<a id="relaciones-asociacion-navegabilidad-y-multiplicidad-herencia-composicion-agregacion-realizacion-y-dependencia"></a>
## Relaciones. Asociación, navegabilidad y multiplicidad. Herencia, composición, agregación. Realización y dependencia

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/006-Elaboraci%C3%B3n%20de%20diagramas%20de%20clases/003-Relaciones.%20Asociaci%C3%B3n%2C%20navegabilidad%20y%20multiplicidad.%20Herencia%2C%20composici%C3%B3n%2C%20agregaci%C3%B3n.%20Realizaci%C3%B3n%20y%20dependencia)

### diagrama relaciones
<small>Creado: 2026-04-20 18:32</small>

`diagrama relaciones.html`

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
  width: 739.0000343322752px;
  height: 443.28128814697254px;
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

/* texto libre */
.shape.text {
  background: transparent;
  border: none;
  box-shadow: none;
  padding: 0;
  min-width: 20px;
  min-height: 20px;
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

<div class="shape entity" style="left:40px;top:40px;width:160.00001907348627px;height:182.00000762939447px;">
  <div class="entity-header">Cliente</div>
  <div class="entity-properties">
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">id</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">nombre</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">apellidos</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">email</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">direccion</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="shape entity" style="left:300.8750343322753px;top:245.28125762939442px;width:159.99999999999994px;height:158.00003051757807px;">
  <div class="entity-header">Producto</div>
  <div class="entity-properties">
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">id</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">nombre</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">descripcion</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">precio</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="shape entity" style="left:288.3750343322753px;top:60.28125762939453px;width:159.99999999999994px;height:133.99997711181635px;">
  <div class="entity-header">Pedido</div>
  <div class="entity-properties">
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">id</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">fecha</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">id_cliente</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="shape entity" style="left:539.0000343322752px;top:149.03125762939447px;width:159.99999999999994px;height:157.9999923706054px;">
  <div class="entity-header">LineaPedido</div>
  <div class="entity-properties">
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">id</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">pedido_id</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">producto_id</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">cantidad</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="arrow" style="left:320.4687690734862px;top:152.20246031727913px;width:167.03321881574615px;transform:rotate(-2.747578688209828rad);"></div>
<div class="arrow" style="left:564.1875648498533px;top:215.46145472937053px;width:181.75381348955037px;transform:rotate(-2.521558492334684rad);"></div>
<div class="arrow" style="left:564.1875648498533px;top:244.75003663432597px;width:137.84676319505215px;transform:rotate(2.810487295072487rad);"></div>
</div>
</body>
</html>
```

### diagrama relaciones
<small>Creado: 2026-04-20 18:32</small>

`diagrama relaciones.json`

```json
{
  "formas": [
    {
      "id": "forma-1",
      "tipo": "entity",
      "left": "173.359px",
      "top": "352.078px",
      "width": "",
      "height": "",
      "entityName": "Cliente",
      "properties": [
        {
          "id": "prop-1",
          "name": "id"
        },
        {
          "id": "prop-2",
          "name": "nombre"
        },
        {
          "id": "prop-3",
          "name": "apellidos"
        },
        {
          "id": "prop-4",
          "name": "email"
        },
        {
          "id": "prop-5",
          "name": "direccion"
        }
      ]
    },
    {
      "id": "forma-2",
      "tipo": "entity",
      "left": "434.234px",
      "top": "557.359px",
      "width": "",
      "height": "",
      "entityName": "Producto",
      "properties": [
        {
          "id": "prop-6",
          "name": "id"
        },
        {
          "id": "prop-7",
          "name": "nombre"
        },
        {
          "id": "prop-8",
          "name": "descripcion"
        },
        {
          "id": "prop-9",
          "name": "precio"
        }
      ]
    },
    {
      "id": "forma-3",
      "tipo": "entity",
      "left": "421.734px",
      "top": "372.359px",
      "width": "",
      "height": "",
      "entityName": "Pedido",
      "properties": [
        {
          "id": "prop-10",
          "name": "id"
        },
        {
          "id": "prop-11",
          "name": "fecha"
        },
        {
          "id": "prop-12",
          "name": "id_cliente"
        }
      ]
    },
    {
      "id": "forma-4",
      "tipo": "entity",
      "left": "672.359px",
      "top": "461.109px",
      "width": "",
      "height": "",
      "entityName": "LineaPedido",
      "properties": [
        {
          "id": "prop-13",
          "name": "id"
        },
        {
          "id": "prop-14",
          "name": "pedido_id"
        },
        {
          "id": "prop-15",
          "name": "producto_id"
        },
        {
          "id": "prop-16",
          "name": "cantidad"
        }
      ]
    }
  ],
  "flechas": [
    {
      "desde": {
        "shapeId": "forma-3",
        "propId": "prop-12",
        "side": "left"
      },
      "hasta": {
        "shapeId": "forma-1",
        "propId": "prop-1",
        "side": "right"
      },
      "tipo": "simple",
      "estilo": "straight"
    },
    {
      "desde": {
        "shapeId": "forma-4",
        "propId": "prop-14",
        "side": "left"
      },
      "hasta": {
        "shapeId": "forma-3",
        "propId": "prop-10",
        "side": "right"
      },
      "tipo": "simple",
      "estilo": "straight"
    },
    {
      "desde": {
        "shapeId": "forma-4",
        "propId": "prop-15",
        "side": "left"
      },
      "hasta": {
        "shapeId": "forma-2",
        "propId": "prop-6",
        "side": "right"
      },
      "tipo": "simple",
      "estilo": "straight"
    }
  ]
}
```

### diagrama relaciones
<small>Creado: 2026-04-20 18:32</small>

`diagrama relaciones.py`

```python
from typing import Optional

class Cliente:
    def __init__(self, id: Optional[int] = None, nombre: Optional[str] = None, apellidos: Optional[str] = None, email: Optional[str] = None, direccion: Optional[str] = None):
        self.id = id
        self.nombre = nombre
        self.apellidos = apellidos
        self.email = email
        self.direccion = direccion

    def __repr__(self):
        return f"Cliente(id={self.id!r}, nombre={self.nombre!r}, apellidos={self.apellidos!r}, email={self.email!r}, direccion={self.direccion!r})"

class Producto:
    def __init__(self, id: Optional[int] = None, nombre: Optional[str] = None, descripcion: Optional[str] = None, precio: Optional[str] = None):
        self.id = id
        self.nombre = nombre
        self.descripcion = descripcion
        self.precio = precio

    def __repr__(self):
        return f"Producto(id={self.id!r}, nombre={self.nombre!r}, descripcion={self.descripcion!r}, precio={self.precio!r})"

class Pedido:
    def __init__(self, id: Optional[int] = None, fecha: Optional[str] = None, id_cliente: Optional[str] = None):
        self.id = id
        self.fecha = fecha
        self.id_cliente = id_cliente

    def __repr__(self):
        return f"Pedido(id={self.id!r}, fecha={self.fecha!r}, id_cliente={self.id_cliente!r})"

    # FK1: id_cliente -> cliente.id

class Lineapedido:
    def __init__(self, id: Optional[int] = None, pedido_id: Optional[int] = None, producto_id: Optional[int] = None, cantidad: Optional[str] = None):
        self.id = id
        self.pedido_id = pedido_id
        self.producto_id = producto_id
        self.cantidad = cantidad

    def __repr__(self):
        return f"Lineapedido(id={self.id!r}, pedido_id={self.pedido_id!r}, producto_id={self.producto_id!r}, cantidad={self.cantidad!r})"

    # FK1: pedido_id -> pedido.id
    # FK2: producto_id -> producto.id
```

### diagrama relaciones
<small>Creado: 2026-04-20 18:32</small>

`diagrama relaciones.sql`

```sql
CREATE TABLE cliente (
  id INT,
  nombre VARCHAR(255),
  apellidos VARCHAR(255),
  email VARCHAR(255),
  direccion VARCHAR(255),
  PRIMARY KEY (id)
);

CREATE TABLE producto (
  id INT,
  nombre VARCHAR(255),
  descripcion VARCHAR(255),
  precio VARCHAR(255),
  PRIMARY KEY (id)
);

CREATE TABLE pedido (
  id INT,
  fecha VARCHAR(255),
  id_cliente VARCHAR(255),
  PRIMARY KEY (id),
  CONSTRAINT fk_pedido_1 FOREIGN KEY (id_cliente) REFERENCES cliente(id)
);

CREATE TABLE lineapedido (
  id INT,
  pedido_id INT,
  producto_id INT,
  cantidad VARCHAR(255),
  PRIMARY KEY (id),
  CONSTRAINT fk_lineapedido_1 FOREIGN KEY (pedido_id) REFERENCES pedido(id),
  CONSTRAINT fk_lineapedido_2 FOREIGN KEY (producto_id) REFERENCES producto(id)
);
```

### diagrama relaciones
<small>Creado: 2026-04-20 18:32</small>

`diagrama relaciones.svg`

```
<svg xmlns="http://www.w3.org/2000/svg" width="739.0000343322752" height="443.28128814697254" viewBox="0 0 739.0000343322752 443.28128814697254">

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
        
<rect class="shape-entity" x="40" y="40" width="160.00001907348627" height="182.00000762939447" />
<line x1="40" y1="69.99999999999999" x2="200.00001907348627" y2="69.99999999999999" stroke="#e5e7eb" stroke-width="1"/>
<text x="120.00000953674314" y="59.49999237060546" text-anchor="middle">Cliente</text>
<text x="93.76564407348633" y="89.99998474121094">id</text>
<text x="93.76564407348633" y="114">nombre</text>
<text x="93.76564407348633" y="138.000015258789">apellidos</text>
<text x="93.76564407348633" y="161.9999923706054">email</text>
<text x="93.76564407348633" y="186.00000762939447">direccion</text>
<rect class="shape-entity" x="300.8750343322753" y="245.28125762939442" width="159.99999999999994" height="158.00003051757807" />
<line x1="300.8750343322753" y1="275.2812576293944" x2="460.8750343322752" y2="275.2812576293944" stroke="#e5e7eb" stroke-width="1"/>
<text x="380.8750343322753" y="264.7812499999999" text-anchor="middle">Producto</text>
<text x="347.9062690734862" y="295.28124237060536">id</text>
<text x="347.9062690734862" y="319.2812576293944">nombre</text>
<text x="347.9062690734862" y="343.2812728881835">descripcion</text>
<text x="347.9062690734862" y="367.28128814697254">precio</text>
<rect class="shape-entity" x="288.3750343322753" y="60.28125762939453" width="159.99999999999994" height="133.99997711181635" />
<line x1="288.3750343322753" y1="90.28125762939452" x2="448.3750343322752" y2="90.28125762939452" stroke="#e5e7eb" stroke-width="1"/>
<text x="368.3750343322753" y="79.78125" text-anchor="middle">Pedido</text>
<text x="340.4687919616698" y="110.28124237060547">id</text>
<text x="340.4687919616698" y="134.28125762939447">fecha</text>
<text x="340.4687919616698" y="158.28123474121088">id_cliente</text>
<rect class="shape-entity" x="539.0000343322752" y="149.03125762939447" width="159.99999999999994" height="157.9999923706054" />
<line x1="539.0000343322752" y1="179.03125762939447" x2="699.0000343322752" y2="179.03125762939447" stroke="#e5e7eb" stroke-width="1"/>
<text x="619.0000343322752" y="168.53124999999994" text-anchor="middle">LineaPedido</text>
<text x="584.1875495910642" y="199.0312423706054">id</text>
<text x="584.1875495910642" y="223.03125762939442">pedido_id</text>
<text x="584.1875495910642" y="247.03123474121082">producto_id</text>
<text x="584.1875495910642" y="271.0312499999999">cantidad</text>
<path class="conn" d="M 320.4687690734862 152.20246031727913 L 166.2343788146972 88.07875916514269" marker-end="url(#arrow-end)" />
<path class="conn" d="M 564.1875648498533 215.46145472937053 L 416.2656593322752 109.85104527062936" marker-end="url(#arrow-end)" />
<path class="conn" d="M 564.1875648498533 244.75003663432597 L 433.82814407348616 289.5624404774902" marker-end="url(#arrow-end)" />
</svg>
```


<a id="notacion-de-los-diagramas-de-clases"></a>
## Notación de los diagramas de clases

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/006-Elaboraci%C3%B3n%20de%20diagramas%20de%20clases/004-Notaci%C3%B3n%20de%20los%20diagramas%20de%20clases)


<a id="herramientas"></a>
## Herramientas

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/006-Elaboraci%C3%B3n%20de%20diagramas%20de%20clases/005-Herramientas)


<a id="generacion-automatica-de-codigo-ingenieria-inversa"></a>
## Generación automática de código. Ingeniería inversa

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/006-Elaboraci%C3%B3n%20de%20diagramas%20de%20clases/006-Generaci%C3%B3n%20autom%C3%A1tica%20de%20c%C3%B3digo.%20Ingenier%C3%ADa%20inversa)



<a id="elaboracion-de-diagramas-de-comportamiento"></a>
# Elaboración de diagramas de comportamiento

<a id="clases-atributos-metodos-y-visibilidad-1"></a>
## Clases. Atributos, métodos y visibilidad

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/007-Elaboraci%C3%B3n%20de%20diagramas%20de%20comportamiento/001-Clases.%20Atributos%2C%20m%C3%A9todos%20y%20visibilidad)

### diagrama de flujo
<small>Creado: 2026-04-20 18:32</small>

`diagrama de flujo.html`

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
  width: 386.9843606387867px;
  height: 453.9843929515164px;
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

/* texto libre */
.shape.text {
  background: transparent;
  border: none;
  box-shadow: none;
  padding: 0;
  min-width: 20px;
  min-height: 20px;
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

<div class="shape rectangle" style="left:45px;top:40px;width:119.99999999999996px;height:39.999999999999986px;">Inicio</div>
<div class="shape rectangle" style="left:42.562471277573536px;top:105.39062499999997px;width:120.00003590303304px;height:39.999999999999986px;">Catálogo</div>
<div class="shape rectangle" style="left:42.890625px;top:173.04687499999997px;width:119.99999999999996px;height:39.99998204848344px;">Producto</div>
<div class="shape rectangle" style="left:41.82811063878677px;top:238.98435704848336px;width:119.99999999999996px;height:40.00003590303307px;">Carrito</div>
<div class="shape rectangle" style="left:41.343742819393384px;top:302.15624640969656px;width:121.9843965418198px;height:39.999999999999986px;">Datos personales</div>
<div class="shape rectangle" style="left:40px;top:373.9843929515164px;width:119.99999999999996px;height:39.999999999999986px;">Finalización</div>
<div class="shape text" style="left:247.12499281939333px;top:50.20312140969668px;width:56.49999281939336px;height:19.999999999999993px;">index.php</div>
<div class="shape text" style="left:239.29687499999991px;top:113.6250035903033px;width:75.39062499999997px;height:19.999999999999993px;">catalogo.php</div>
<div class="shape text" style="left:235.89061063878668px;top:183.07812859030324px;width:78.04687499999997px;height:19.999999999999993px;">producto.php</div>
<div class="shape text" style="left:234.3437284581801px;top:246.2187464096966px;width:63.343757180606595px;height:19.999999999999993px;">carrito.php</div>
<div class="shape text" style="left:226.1406034581801px;top:311.1718929515165px;width:120.84375718060657px;height:19.999999999999993px;">datospersonales.php</div>
<div class="shape text" style="left:221.31250718060656px;top:383.8281429515164px;width:90.70308909696688px;height:19.999999999999993px;">finalizacion.php</div>
<div class="arrow" style="left:104.25447699240985px;top:80px;width:25.408259157692445px;transform:rotate(1.608055226342451rad);"></div>
<div class="arrow" style="left:102.6594901165004px;top:145.39062499999997px;width:27.65657527610903px;transform:rotate(1.5659463204529298rad);"></div>
<div class="arrow" style="left:102.56834595098093px;top:213.04685704848336px;width:25.94086724312086px;transform:rotate(1.586908891979556rad);"></div>
<div class="arrow" style="left:101.98888817980318px;top:278.9843929515165px;width:23.172602168388657px;transform:rotate(1.5627576301192991rad);"></div>
<div class="arrow" style="left:101.68551609598904px;top:342.15624640969656px;width:31.844973321959674px;transform:rotate(1.6033061186126485rad);"></div>
<div class="arrow" style="left:164.99999999999997px;top:60.07153212239041px;width:82.12505118337548px;transform:rotate(0.0011922014749970792rad);"></div>
<div class="arrow" style="left:162.56250718060662px;top:124.78328968194623px;width:76.73829882002393px;transform:rotate(-0.010121906585025129rad);"></div>
<div class="arrow" style="left:162.89062499999997px;top:193.05777008561583px;width:72.9999868442857px;transform:rotate(0.00018173435423447847rad);"></div>
<div class="arrow" style="left:161.82811063878668px;top:257.9737151200044px;width:72.52590457221464px;transform:rotate(-0.016842738515290143rad);"></div>
<div class="arrow" style="left:163.3281393612132px;top:321.8303548146109px;width:62.81336072122098px;transform:rotate(-0.005343117694322238rad);"></div>
<div class="arrow" style="left:159.99999999999997px;top:393.92814206896105px;width:61.31253412541905px;transform:rotate(-0.0009375144345826489rad);"></div>
</div>
</body>
</html>
```

### diagrama de flujo
<small>Creado: 2026-04-20 18:32</small>

`diagrama de flujo.json`

```json
{
  "formas": [
    {
      "id": "forma-1",
      "tipo": "rectangle",
      "left": "166.853px",
      "top": "158.378px",
      "width": "",
      "height": "",
      "texto": "Inicio"
    },
    {
      "id": "forma-2",
      "tipo": "rectangle",
      "left": "164.407px",
      "top": "223.776px",
      "width": "",
      "height": "",
      "texto": "Catálogo"
    },
    {
      "id": "forma-3",
      "tipo": "rectangle",
      "left": "164.736px",
      "top": "291.434px",
      "width": "",
      "height": "",
      "texto": "Producto"
    },
    {
      "id": "forma-4",
      "tipo": "rectangle",
      "left": "163.678px",
      "top": "357.359px",
      "width": "",
      "height": "",
      "texto": "Carrito"
    },
    {
      "id": "forma-5",
      "tipo": "rectangle",
      "left": "163.202px",
      "top": "420.537px",
      "width": "",
      "height": "",
      "texto": "Datos personales"
    },
    {
      "id": "forma-6",
      "tipo": "rectangle",
      "left": "161.847px",
      "top": "492.369px",
      "width": "",
      "height": "",
      "texto": "Finalización"
    },
    {
      "id": "forma-7",
      "tipo": "text",
      "left": "368.971px",
      "top": "168.593px",
      "width": "",
      "height": "",
      "texto": "index.php"
    },
    {
      "id": "forma-8",
      "tipo": "text",
      "left": "361.146px",
      "top": "232.012px",
      "width": "",
      "height": "",
      "texto": "catalogo.php"
    },
    {
      "id": "forma-9",
      "tipo": "text",
      "left": "357.743px",
      "top": "301.466px",
      "width": "",
      "height": "",
      "texto": "producto.php"
    },
    {
      "id": "forma-10",
      "tipo": "text",
      "left": "356.193px",
      "top": "364.609px",
      "width": "",
      "height": "",
      "texto": "carrito.php"
    },
    {
      "id": "forma-11",
      "tipo": "text",
      "left": "347.993px",
      "top": "429.561px",
      "width": "",
      "height": "",
      "texto": "datospersonales.php"
    },
    {
      "id": "forma-12",
      "tipo": "text",
      "left": "343.161px",
      "top": "502.212px",
      "width": "",
      "height": "",
      "texto": "finalizacion.php"
    }
  ],
  "flechas": [
    {
      "desde": {
        "shapeId": "forma-1",
        "propId": null,
        "side": null
      },
      "hasta": {
        "shapeId": "forma-2",
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
        "shapeId": "forma-3",
        "propId": null,
        "side": null
      },
      "tipo": "simple",
      "estilo": "straight"
    },
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
      "tipo": "simple",
      "estilo": "straight"
    },
    {
      "desde": {
        "shapeId": "forma-5",
        "propId": null,
        "side": null
      },
      "hasta": {
        "shapeId": "forma-6",
        "propId": null,
        "side": null
      },
      "tipo": "simple",
      "estilo": "straight"
    },
    {
      "desde": {
        "shapeId": "forma-1",
        "propId": null,
        "side": null
      },
      "hasta": {
        "shapeId": "forma-7",
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
        "shapeId": "forma-8",
        "propId": null,
        "side": null
      },
      "tipo": "simple",
      "estilo": "straight"
    },
    {
      "desde": {
        "shapeId": "forma-3",
        "propId": null,
        "side": null
      },
      "hasta": {
        "shapeId": "forma-9",
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
        "shapeId": "forma-10",
        "propId": null,
        "side": null
      },
      "tipo": "simple",
      "estilo": "straight"
    },
    {
      "desde": {
        "shapeId": "forma-5",
        "propId": null,
        "side": null
      },
      "hasta": {
        "shapeId": "forma-11",
        "propId": null,
        "side": null
      },
      "tipo": "simple",
      "estilo": "straight"
    },
    {
      "desde": {
        "shapeId": "forma-6",
        "propId": null,
        "side": null
      },
      "hasta": {
        "shapeId": "forma-12",
        "propId": null,
        "side": null
      },
      "tipo": "simple",
      "estilo": "straight"
    }
  ]
}
```

### diagrama de flujo
<small>Creado: 2026-04-20 18:32</small>

`diagrama de flujo.svg`

```
<svg xmlns="http://www.w3.org/2000/svg" width="386.9843606387867" height="453.9843929515164" viewBox="0 0 386.9843606387867 453.9843929515164">

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
        
<rect class="shape-rect" x="45" y="40" width="119.99999999999996" height="39.999999999999986" rx="4" ry="4" />
<text x="104.99999999999997" y="63.99999999999999" text-anchor="middle">Inicio</text>
<rect class="shape-rect" x="42.562471277573536" y="105.39062499999997" width="120.00003590303304" height="39.999999999999986" rx="4" ry="4" />
<text x="102.56248922909006" y="129.39062499999997" text-anchor="middle">Catálogo</text>
<rect class="shape-rect" x="42.890625" y="173.04687499999997" width="119.99999999999996" height="39.99998204848344" rx="4" ry="4" />
<text x="102.89062499999997" y="197.0468660242417" text-anchor="middle">Producto</text>
<rect class="shape-rect" x="41.82811063878677" y="238.98435704848336" width="119.99999999999996" height="40.00003590303307" rx="4" ry="4" />
<text x="101.82811063878674" y="262.9843749999999" text-anchor="middle">Carrito</text>
<rect class="shape-rect" x="41.343742819393384" y="302.15624640969656" width="121.9843965418198" height="39.999999999999986" rx="4" ry="4" />
<text x="102.3359410903033" y="326.15624640969656" text-anchor="middle">Datos personales</text>
<rect class="shape-rect" x="40" y="373.9843929515164" width="119.99999999999996" height="39.999999999999986" rx="4" ry="4" />
<text x="99.99999999999997" y="397.9843929515164" text-anchor="middle">Finalización</text>
<text x="247.12499281939333" y="64.20312140969668">index.php</text>
<text x="239.29687499999991" y="127.6250035903033">catalogo.php</text>
<text x="235.89061063878668" y="197.07812859030324">producto.php</text>
<text x="234.3437284581801" y="260.21874640969656">carrito.php</text>
<text x="226.1406034581801" y="325.1718929515165">datospersonales.php</text>
<text x="221.31250718060656" y="397.8281429515164">finalizacion.php</text>
<path class="conn" d="M 104.25447699240985 80 L 103.30801223668018 105.39062499999997" marker-end="url(#arrow-end)" />
<path class="conn" d="M 102.6594901165004 145.39062499999997 L 102.79362415612246 173.04687499999997" marker-end="url(#arrow-end)" />
<path class="conn" d="M 102.56834595098093 213.04685704848336 L 102.15039012171081 238.98435704848336" marker-end="url(#arrow-end)" />
<path class="conn" d="M 101.98888817980318 278.9843929515165 L 102.17516369359674 302.15624640969656" marker-end="url(#arrow-end)" />
<path class="conn" d="M 101.68551609598904 342.15624640969656 L 100.65042499431422 373.9843929515164" marker-end="url(#arrow-end)" />
<path class="conn" d="M 164.99999999999997 60.07153212239041 L 247.12499281939333 60.16944170635156" marker-end="url(#arrow-end)" />
<path class="conn" d="M 162.56250718060662 124.78328968194623 L 239.29687499999991 124.00656505291522" marker-end="url(#arrow-end)" />
<path class="conn" d="M 162.89062499999997 193.05777008561583 L 235.89061063878668 193.07103669101107" marker-end="url(#arrow-end)" />
<path class="conn" d="M 161.82811063878668 257.9737151200044 L 234.34372845818004 256.75223802661844" marker-end="url(#arrow-end)" />
<path class="conn" d="M 163.3281393612132 321.8303548146109 L 226.1406034581801 321.494737232426" marker-end="url(#arrow-end)" />
<path class="conn" d="M 159.99999999999997 393.92814206896105 L 221.31250718060656 393.870660691618" marker-end="url(#arrow-end)" />
</svg>
```


<a id="objetos-instanciacion-1"></a>
## Objetos. Instanciación

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/007-Elaboraci%C3%B3n%20de%20diagramas%20de%20comportamiento/002-Objetos.%20Instanciaci%C3%B3n)


<a id="relaciones-asociacion-navegabilidad-y-multiplicidad-herencia-composicion-agregacion-realizacion-y-dependencia-1"></a>
## Relaciones. Asociación, navegabilidad y multiplicidad. Herencia, composición, agregación. Realización y dependencia

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/007-Elaboraci%C3%B3n%20de%20diagramas%20de%20comportamiento/003-Relaciones.%20Asociaci%C3%B3n%2C%20navegabilidad%20y%20multiplicidad.%20Herencia%2C%20composici%C3%B3n%2C%20agregaci%C3%B3n.%20Realizaci%C3%B3n%20y%20dependencia)


<a id="notacion-de-los-diagramas-de-clases-1"></a>
## Notación de los diagramas de clases

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/007-Elaboraci%C3%B3n%20de%20diagramas%20de%20comportamiento/004-Notaci%C3%B3n%20de%20los%20diagramas%20de%20clases)


<a id="herramientas-1"></a>
## Herramientas

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/007-Elaboraci%C3%B3n%20de%20diagramas%20de%20comportamiento/005-Herramientas)


<a id="generacion-automatica-de-codigo-ingenieria-inversa-1"></a>
## Generación automática de código. Ingeniería inversa

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/007-Elaboraci%C3%B3n%20de%20diagramas%20de%20comportamiento/006-Generaci%C3%B3n%20autom%C3%A1tica%20de%20c%C3%B3digo.%20Ingenier%C3%ADa%20inversa)



<a id="programacion-en-entorno-servidor"></a>
# Programacion en entorno servidor

<a id="php"></a>
## PHP

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/008-Programacion%20en%20entorno%20servidor/001-PHP)

### Introducción a los ejercicios

Este conjunto de ejercicios está diseñado para ayudarte a familiarizarte con la programación en PHP, un lenguaje de scripting del lado del servidor muy popular. Los problemas abarcan desde conceptos básicos como declaraciones y variables hasta estructuras más avanzadas como bucles, condicionales y objetos orientados a objetos. A través de estos ejercicios, aprenderás a crear scripts simples, trabajar con funciones, manejar arrays y clases, así como a integrar PHP con HTML para generar contenido dinámico en una página web. Es importante tener configurado tu entorno de desarrollo (se proporcionan instrucciones tanto para Windows como Linux) antes de comenzar estos ejercicios.

### hola mundo
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código parece estar incompleto o mal formateado, ya que no sigue las reglas básicas de la sintaxis PHP. En un script PHP, el texto `hola mundo desde PHP` debería estar dentro de una estructura válida como una función `echo`, `print` o estar rodeado por delimitadores de apertura (`<?php`) y cierre (`?>`). 

En PHP, para imprimir "Hola mundo" en la pantalla, normalmente se usaría algo como esto:

```php
<?php
echo "hola mundo desde PHP";
?>
```

O bien,

```php
<?php
print "hola mundo desde PHP";
?>
```

El objetivo de este tipo de código es mostrar cómo imprimir texto en una página web cuando el archivo .php se ejecuta en un servidor web. Es la primera y más básica tarea que aprenden los estudiantes al empezar a programar en PHP, ya que ayuda a entender cómo funciona la ejecución de scripts PHP y la salida de datos en HTML.

`001-hola mundo.php`

```
hola mundo desde PHP
```

### abrimos bloque
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código combina elementos tanto de HTML como de PHP. Lo que hace este bloque es mostrar cómo se pueden integrar estos dos lenguajes en un solo archivo. La parte que está dentro del bloque `<?php ?>` (también conocido como "bloque PHP") será procesada por el servidor web como código PHP, mientras que las líneas de texto antes y después de este bloque serán enviadas tal cual al navegador.

En resumen, cuando un archivo contiene tanto HTML como PHP, los bloques de código PHP se ejecutan en el servidor para generar contenido dinámico o realizar tareas específicas, mientras que el HTML es simplemente enviado al cliente sin procesamiento adicional. Esto permite a los desarrolladores crear páginas web interactivas y personalizadas utilizando la combinación potente de ambos lenguajes.

`002-abrimos bloque.php`

```
Esto es HTML
<?php
  // Pero esto es PHP
?>
Esto es HTML
```

### comentarios de una linea
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código muestra cómo se utilizan los comentarios en PHP. Los comentarios se usan para añadir notas o descripciones que ayudan a entender el código, pero no son ejecutados por el servidor al procesar la página web. En este caso, cada línea comentada comienza con `//`, lo cual indica un comentario de una sola línea. Estos comentarios son útiles para explicar rápidamente ciertas partes del código o incluso para desactivar temporalmente una línea de código durante la prueba y depuración sin eliminarla completamente. Es importante incluir comentarios claros en el código para que otros programadores (o tú mismo en el futuro) puedan comprender fácilmente qué hace cada parte del programa.

`003-comentarios de una linea.php`

```
<?php
  // Esto es un comentario de una linea
  // Y esto es otro comentario
?>
```

### comentarios multilinea
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código PHP muestra cómo se utilizan los comentarios multilinea. En PHP, puedes usar tres asteriscos diagonales `/*` al inicio del bloque de comentarios y dos asteriscos diagonales `*/` para cerrarlo, lo que te permite escribir varios comentarios en bloques continuos sin necesidad de escribir `//` o `#` antes de cada línea. Los comentarios son esenciales porque ayudan a explicar el código y hacerlo más fácil de entender para otros programadores (o incluso para ti mismo cuando revises el código después de mucho tiempo). En este caso, los comentarios no afectan la ejecución del programa ya que simplemente proporcionan información sobre lo que podría estar sucediendo o planificado en esa sección del código.

`004-comentarios multilinea.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código muestra cómo integrar contenido HTML dentro de un script PHP. Cuando el servidor recibe una solicitud para este archivo, PHP se encarga de interpretarlo y genera la salida indicada en él. En este caso, el comando `echo` es utilizado para imprimir o mostrar directamente en la página web el texto "Esto es HTML desde PHP". Lo que hace especial a esta línea es que aunque estás dentro de un entorno de programación PHP, puedes generar contenido HTML que será visible en el navegador cuando se cargue la página. Es importante porque demuestra cómo PHP puede interactuar directamente con el flujo del sitio web para agregar texto estático o dinámico, lo cual es una habilidad fundamental al trabajar con este lenguaje de programación.

`005-salidas con echo.php`

```
<?php
  echo "Esto es HTML desde PHP";
?>
```

### print
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código muestra cómo se puede incorporar código HTML directamente dentro de un script PHP. En este caso, la función `print` se utiliza para enviar una cadena de texto que contiene etiquetas HTML a la salida del navegador. Cuando el archivo PHP es ejecutado por el servidor web, esta línea imprime en pantalla "Esto es HTML desde PHP", pero técnicamente está enviando "<php? print "Esto es HTML desde PHP"; ?>". Esto demuestra cómo PHP y HTML pueden trabajar juntos para generar páginas web dinámicas. Es importante entender esto porque la mezcla de PHP con HTML es una práctica común en desarrollo web, permitiendo a los programadores incorporar lógica del lado del servidor dentro de las estructuras de página estática.

`006-print.php`

```
<?php
  print "Esto es HTML desde PHP";
?>
```

### variable
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código PHP crea una variable llamada `$nombre` y le asigna el valor de la cadena "Jose Vicente". Luego, utiliza la función `echo` para imprimir en pantalla o enviar al navegador el contenido de esa variable. En resumen, este código muestra por pantalla el nombre almacenado en la variable, lo que es fundamental para entender cómo se manejan las variables y cómo mostrar información en un sitio web utilizando PHP.

`007-variable.php`

```
<?php
  $nombre = "Jose Vicente";
  echo $nombre;
?>
```

### operadores aritmeticos
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código PHP muestra cómo se utilizan diferentes operadores aritméticos básicos en el lenguaje. Cada línea del código realiza una operación matemática específica y luego la imprime en la página web mediante la función `echo`. Aquí está un desglose rápido:

1. La primera línea suma dos números (4 + 3) y muestra el resultado.
2. La segunda línea resta uno de los otros (4 - 3).
3. La tercera línea multiplica dos números (4 * 3).
4. La cuarta línea divide un número por otro (4 / 3).
5. La última línea calcula el residuo de la división entera entre dos números (4 % 3).

Entre cada operación, se usa `echo "<br>";` para agregar una nueva línea en el resultado, lo que hace que los resultados sean más legibles cuando se muestran en un navegador web. Este tipo de código es fundamental para entender cómo PHP maneja las operaciones matemáticas y cómo mostrar datos en una página web.

`008-operadores aritmeticos.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código PHP muestra cómo se utilizan diferentes operadores de comparación para evaluar expresiones y mostrar los resultados en una página web. Cada línea del código compara dos números (el número 4 con el número 3) usando distintos tipos de operadores: menor que (`<`), menor o igual que (`<=`), mayor que (`>`), mayor o igual que (`>=`), igualdad exacta (`==`), y desigualdad (`!=`). 

Los resultados de estas comparaciones se muestran en la página web usando la función `echo`, seguida del operador de salto de línea `<br>`. Esto hace que cada resultado se muestre en una nueva línea, lo cual facilita su lectura. Los valores booleanos (verdadero o falso) resultantes de las comparaciones son los que realmente se ven cuando la página se carga en un navegador.

Este código es importante porque enseña cómo evaluar condiciones y realizar comparaciones simples, que son fundamentales para cualquier programa que necesite tomar decisiones basadas en datos.

`009-operadores de comparacion.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código PHP utiliza operadores booleanos para comparar diferentes valores y mostrar los resultados en el navegador. Los operadores `==` son utilizados para comprobar si dos valores son iguales, mientras que `&&` (AND) y `||` (OR) se usan para combinar múltiples condiciones.

La primera línea del código compara tres igualdades (`4 == 4`, `3 == 3`, `2 == 2`) utilizando el operador `&&`. Como todas estas comparaciones son verdaderas, la salida es "1" (que en PHP significa Verdadero o True).

La segunda línea mantiene dos de las condiciones anteriores pero cambia la última a una comparación falsa (`2 == 1`). Por lo tanto, el resultado es "0" (Falso o False) ya que todas las condiciones `&&` deben ser verdaderas para que el resultado sea True.

Luego, se utilizan varias líneas con operadores `||`, que solo requieren una de las comparaciones dentro del OR para ser verdadera. Como resultado, las salidas variarán desde "1" cuando al menos una condición es cierta hasta "0" cuando todas son falsas.

Este tipo de ejercicios ayuda a entender cómo PHP evalúa y combina diferentes condiciones lógicas en la programación.

`010-operadores booleanos.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código PHP muestra cómo modificar un valor almacenado en una variable usando operadores aritméticos tanto de forma tradicional como abreviada. Primero, se establece el valor inicial de la variable `$edad` en 47 y luego se imprime ese valor. Después, se incrementa esta edad por 5 años utilizando primero un método no abreviado (es decir, reasignando la suma directamente a la variable) y luego usando operadores aritméticos abreviados (`$edad += 5`). El código continúa mostrándote cómo disminuir y multiplicar el valor de `$edad` por 5 usando los operadores `-=`, `*=`, respectivamente, y finalmente divide el valor por 5 con `/=`. Cada vez que se realiza una operación, el nuevo valor de la edad es impreso en pantalla para mostrar cómo cambia después de cada operación. Esto es útil porque ayuda a entender cómo los operadores aritméticos abreviados pueden simplificar y acelerar el código, haciéndolo más legible.

`011-operadores aritmeticos abreviados.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código es un ejemplo básico de cómo usar operadores de incremento y decremento en PHP. Comienza estableciendo una variable llamada `$edad` con el valor 47. Luego, muestra este valor en la página web utilizando `echo`, que es como decir "imprime esto". Después de mostrar el primer número, se utiliza un operador de incremento (`$edad++`) para aumentar el valor de `$edad` en uno. Esto significa que ahora `$edad` vale 48 y luego vuelve a imprimir este nuevo valor con `echo`. Finalmente, decrementa el valor de `$edad` en uno con el operador `--`, volviendo a mostrar el resultado. Este código demuestra cómo cambiar fácilmente los valores numéricos en PHP usando estos operadores y cómo se pueden visualizar esos cambios en la salida del programa.

`012-operadores de incremento.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código PHP utiliza un bucle `for` para imprimir una declaración sobre cada día del mes, desde el día 1 hasta el día 30. El bucle comienza estableciendo la variable `$dia` en 1 y continúa mientras `$dia` sea menor que 31. En cada iteración del bucle, se imprime un mensaje que indica cuál es el día actual del mes seguido de un salto de línea (`<br>`). Luego, después de imprimir este mensaje, la variable `$dia` aumenta en uno para que la próxima vez que se ejecute el bucle sea con el siguiente número de día. Este tipo de estructura `for` es muy útil cuando necesitas realizar una acción un número específico de veces o recorrer una serie numérica como los días de un mes.

Es importante porque te enseña cómo iterar y hacer acciones repetitivas en PHP, que es fundamental para muchas aplicaciones web dinámicas.

`013-estructura for.php`

```
<?php
  for($dia = 1;$dia<31;$dia++){
    echo "Hoy es el dia ".$dia." del mes<br>";
  }
?>
```

### for con estructura y estilo
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es un ejemplo sencillo en PHP que muestra cómo se pueden integrar scripts PHP dentro de una página HTML. La función principal del código es generar una lista numérica que representa los días del mes, desde el día 1 hasta el día 30.

El bucle `for` comienza estableciendo la variable `$dia` a 1 y continúa ejecutándose mientras `$dia` sea menor a 31. En cada iteración del bucle, se imprime un bloque HTML `<div>` que contiene el número actual de `$dia`. Después de imprimir este número, `$dia` se incrementa en uno.

Este tipo de estructura es común cuando deseas generar contenido dinámico con PHP dentro de una página web estática. En este caso específico, podrías usar esta técnica para mostrar los días del mes de manera estilizada en un sitio web, por ejemplo, para permitir la selección de fechas o simplemente para presentar información organizada visualmente.

Es importante destacar que el código se ejecuta entre las etiquetas PHP `<?php` y `?>`, lo cual permite a PHP generar HTML como salida. Esto es una característica clave del lenguaje, ya que permite combinar programación con diseño web de manera muy flexible.

`014-for con estructura y estilo.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código combina HTML y PHP para crear una página web con un diseño específico. En el encabezado (head) del documento, se define un estilo CSS que organiza la visualización en una cuadrícula con siete columnas iguales, cada una con 50 píxeles de ancho. Cada `div` (cuadro) en el cuerpo del documento tiene bordes grises y dimensiones fijas.

En el cuerpo del documento (body), se utiliza un bucle PHP (`for`) para imprimir los números del 1 al 30 dentro de etiquetas `<div>`. Esto significa que cada número será mostrado en su propio cuadro con estilo, siguiendo la estructura de cuadrícula definida previamente. Este código es útil para aprender cómo integrar lógica dinámica (en este caso, PHP) con estilos estáticos (CSS) para crear interfaces web interactivas y bien diseñadas.

`015-ahora le pongo estilo.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código PHP utiliza un bucle `while` para imprimir una frase que indica el día actual del mes, desde el primer día hasta el trigésimo. Sin embargo, hay algo importante que falta en este código: la variable `$dia` no se inicializa antes del bucle, lo cual es necesario para que el bucle funcione correctamente y no entre en un ciclo infinito.

El bucle `while` se ejecuta mientras la condición dentro de sus paréntesis sea verdadera. En este caso, la condición es `$dia < 31`, lo que significa que el código dentro del bucle se repetirá hasta que `$dia` alcance o supere el valor 30. Dentro del bucle, la función `echo` imprime una frase con la información del día actual del mes.

Es crucial inicializar la variable `$dia` antes de este bucle para evitar problemas como un número infinito de días impreso en la pantalla. Sin esa inicialización, el valor de `$dia` no cambia durante el proceso y por lo tanto, la condición siempre sería falsa o verdadera indefinidamente.

En resumen, esta estructura es útil cuando necesitas realizar una acción repetitiva que depende de un contador (en este caso, los días del mes), pero es importante asegurarse de que esa variable esté correctamente configurada antes de entrar en el bucle para evitar problemas.

`016-while.php`

```
<?php
  while($dia < 31){
    echo "Hoy es el dia ".$dia." del mes <br>";
  }
?>
```

### declarar la variable antes de entrar en el while
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código PHP muestra cómo se utiliza un bucle `while` para imprimir una serie de mensajes en la página web. La variable `$dia`, que comienza con el valor 1, es incrementada dentro del bucle hasta que llega a 31 (aunque no incluye el 31 debido al uso del operador `<`). En cada iteración del bucle, se muestra un mensaje indicando cuál día del mes es actualmente.

El código es importante porque demuestra cómo controlar la ejecución de una parte del programa mediante condiciones y ciclos. En este caso, imprime el número del día desde 1 hasta 30 en línea con el uso de saltos de línea (`<br>`), lo que ayuda a visualizar claramente cada iteración del bucle.

Es crucial declarar la variable `$dia` antes de entrar al bucle `while`, ya que este necesita un valor inicial para poder determinar cuándo debe terminar. Sin esta declaración, el código produciría un error ya que PHP no permitiría usar una variable sin definirla primero.

`017-declarar la variable antes de entrar en el while.php`

```
<?php
  $dia = 1;
  while($dia < 31){
    echo "Hoy es el dia ".$dia." del mes <br>";
  }
?>
```

### incremento dentro del bucle
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código PHP muestra cómo utilizar un bucle `while` para imprimir los días de un mes, desde el día 1 hasta el día 30. La variable `$dia`, que inicialmente se establece en 1, es utilizada como condición del bucle: mientras `$dia` sea menor a 31, se ejecuta el bloque de código dentro del bucle. Dentro del bucle, la función `echo` imprime en pantalla un mensaje indicando qué día es, seguido por un salto de línea para mejorar la legibilidad. Después de imprimir cada día, se incrementa el valor de `$dia` en 1 con la operación `$dia++`. Esto asegura que el bucle continuará hasta que `$dia` alcance el valor 31, momento en el cual la condición del bucle ya no será verdadera y terminará. Este tipo de estructuras son fundamentales para automatizar tareas repetitivas en programación.

`018-incremento dentro del bucle.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código en PHP verifica si la variable `$edad` es menor que 30. En este caso, la variable `$edad` ha sido inicializada con el valor 47. El código utiliza una estructura condicional `if` para comprobar esta condición lógica.

Si la edad fuera menor a 30 (por ejemplo, si `$edad` fuera 25), entonces se imprimiría el texto "Eres un joven" en la página web gracias a la función `echo`. Sin embargo, dado que `$edad` es 47, esta condición no se cumple y por lo tanto, nada se imprime como resultado.

Este tipo de estructura condicional es fundamental en programación ya que permite que el programa tome decisiones basadas en diferentes situaciones o valores, haciendo que la aplicación sea más interactiva y adaptable a las condiciones específicas.

`019-if.php`

```
<?php
  $edad = 47;
  if($edad < 30){
    echo "Eres un joven";
  }
?>
```

### else
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código PHP se utiliza para determinar si una persona es considerada joven basándose en su edad. La variable `$edad` está inicializada con el valor 47, lo que representa la edad de esa persona.

El código contiene una estructura `if-else`, donde se compara el valor de la variable `$edad` con el número 30 mediante la condición `if($edad < 30)`. Si la edad es menor a 30 años, el código dentro del bloque `if` se ejecuta y muestra el mensaje "Eres un joven" en pantalla. Sin embargo, si la edad es mayor o igual a 30 años (como en este caso), se ejecuta el código dentro del bloque `else`, que imprime "Ya no eres un joven".

Esta estructura de control es importante porque permite tomar decisiones basadas en condiciones específicas y mostrar resultados diferentes según dichas condiciones. En este ejemplo, ayuda a categorizar la edad de una persona como joven o adulta mayor que 30 años.

`020-else.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código PHP verifica la edad de una persona y muestra un mensaje diferente dependiendo de su rango de edad. La variable `$edad` es inicializada con el valor 47 en este caso. Luego, se usa una estructura condicional `if-else if-else` para determinar en qué categoría cae esa edad.

Primero, el código comprueba si la edad es menor que 10 años y muestra "Eres un niño" si esta condición es verdadera. Si no lo es, pasa a la siguiente condición `else if`, donde verifica si la edad está entre 10 y menos de 20 años; si esto se cumple, imprime "Eres un adolescente". Otro `else if` comprueba si la edad está entre 20 y menos de 30 años, mostrando "Eres un joven" si es cierto. Si ninguna de las condiciones anteriores se satisface, se ejecuta el bloque final `else`, que imprime "Ya no eres un joven".

Este tipo de estructuras condicionales son útiles para categorizar información y tomar decisiones basadas en diferentes rangos o valores específicos. En este ejemplo, ayuda a clasificar etapas de vida según la edad dada.

`021-case else if.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código PHP utiliza una estructura `switch` para imprimir un mensaje diferente según el valor que tenga la variable `$dia`. La variable `$dia` ha sido inicializada con el valor "lunes". La estructura `switch` compara este valor con cada opción (`case`) dentro de ella. Si el valor coincide con uno de los casos, PHP ejecuta las líneas de código asociadas a ese caso hasta encontrar la declaración `break`, que detiene la ejecución del bloque y evita continuar con otros casos. En este ejemplo, como `$dia` es "lunes", se imprime en pantalla: "Hoy es el peor día de la semana". Si `$dia` fuera otro día de la semana, se imprimiría un mensaje diferente según corresponda.

Esta estructura `switch` es útil para manejar múltiples opciones con una sintaxis más clara y concisa que usar varias estructuras condicionales `if`, especialmente cuando hay varias posibilidades a considerar. Es importante asegurarse de incluir la declaración `break` al final de cada caso para evitar que el código continúe ejecutándose en otros casos no deseados, un comportamiento conocido como "caída por defecto" o fall-through.

`022-switch.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es una introducción al concepto de funciones en PHP. Una función en programación es como un pequeño bloque que realiza una tarea específica y puede ser llamado desde cualquier parte del programa donde sea necesario ejecutar esa tarea. En este caso, la función se llama `diHola` y lo único que hace es imprimir el texto "Hola" cuando se la invoca.

La estructura de definición de la función en PHP comienza con la palabra clave `function`, seguida del nombre de la función (`diHola`) entre paréntesis. Dentro del bloque de código que está indentado, en este caso solo contiene una línea que imprime "Hola" utilizando la función `echo`. 

Es importante porque las funciones ayudan a organizar el código y hacerlo más mantenible al evitar repetir bloques de código grandes en diferentes partes del programa. En este ejemplo simple, aunque no es muy útil en sí mismo, ilustra cómo definir una función básica que puede ser usada para enviar saludos o realizar otras acciones en programas más complejos.

`023-funcion.php`

```
<?php
  function diHola(){
    echo "Hola";
  }
?>
```

### llamada a la funcion
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código PHP está diseñado para demostrar cómo se declara y se llama a una función simple. La función `diHola()` no recibe ningún parámetro y, cuando se ejecuta, utiliza la instrucción `echo` para imprimir el texto "Hola" en la pantalla.

El primer bloque entre llaves `{}` es donde se define la función `diHola()`. Dentro de esta función, solo hay una línea que imprime un saludo sencillo. El segundo paso importante es la llamada a la función `diHola();`, lo cual invoca al código dentro de ella y hace que el mensaje "Hola" sea visible en la página web.

Esta estructura es fundamental para entender cómo organizar funciones más complejas y reutilizables en PHP, permitiendo que partes del código se repitan sin tener que volver a escribirlo desde cero cada vez.

`024-llamada a la funcion.php`

```
<?php
  function diHola(){
    echo "Hola";
  }
  diHola();
?>
```

### personalizacion con parametros
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código PHP muestra cómo se define y utiliza una función simple. La función se llama `diHola` y toma un parámetro que llamamos `$nombre`. Dentro de la función, el programa usa la instrucción `echo` para imprimir en pantalla el texto "Hola," seguido del nombre proporcionado cuando se llama a la función.

El código llama dos veces a esta función: primero con el nombre `"Jose Vicente"` y luego con `"Juan"`. Cada vez que la función es llamada, muestra un saludo personalizado usando el nombre que le has dado como argumento. Esto demuestra cómo las funciones en PHP pueden ser reutilizadas para realizar tareas repetitivas de manera eficiente, en este caso, saludar a diferentes personas sin tener que escribir el mismo código una y otra vez.

Esta práctica es importante porque ayuda a organizar y simplificar el código, permitiendo también la modificación sencilla si se necesita cambiar cómo saluda (por ejemplo, cambiando "Hola," por "¡Buen día!") en todas las ocasiones donde se usa este saludo.

`025-personalizacion con parametros.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código PHP define una función llamada `diHola` que toma dos parámetros: `$nombre` y `$edad`. La función imprime un saludo personalizado con el nombre y la edad proporcionados. Luego, se llama a esta función dos veces con diferentes valores para demostrar cómo funciona.

Primero, la función `diHola()` concatena las cadenas de texto y los parámetros que recibe (`$nombre` y `$edad`) para generar un saludo como "Hola, Jose Vicente y tienes 47 años". Luego se imprime con el comando `echo`.

Después de llamar a la función por primera vez, se añade una línea en blanco usando `<br>` (que es HTML) para separar visualmente los dos mensajes.

Finalmente, la función `diHola()` se llama nuevamente pero esta vez con parámetros "Juan" y 56, lo que imprime un segundo saludo similar. Esto demuestra cómo puedes reutilizar una misma función con diferentes datos cada vez que se llama.

`026-tantos parametros como sea necesario.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código PHP muestra cómo definir una función que recibe dos parámetros y devuelve un mensaje personalizado. La función `diHola()` toma dos argumentos: `$nombre` (el nombre de la persona) y `$edad` (la edad de esa persona). Dentro de la función, se utiliza el operador `.` para concatenar strings y crear un saludo que incluye tanto el nombre como la edad proporcionados. Luego, el código llama a esta función dos veces con diferentes nombres y edades, utilizando la instrucción `echo` para imprimir los resultados en la página web. Entre cada llamada a la función, se inserta una línea de código `<br>` para separar visualmente las salidas en la página HTML resultante.

Esta práctica es importante porque demuestra cómo utilizar funciones con parámetros y devolver valores en PHP, así como cómo imprimir mensajes personalizados basados en datos proporcionados al programa.

`027-salida con return.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código PHP está creando un array vacío llamado `$agenda` y luego agregando dos nombres a este array. La primera línea crea el array en blanco, lo que significa que por ahora no contiene ningún elemento. Luego, se añaden los nombres "Juan" y "Jorge" como elementos del array en las posiciones 0 y 1 respectivamente.

El código finaliza con una llamada a `echo` para intentar imprimir el contenido de `$agenda`. Sin embargo, es importante notar que al usar `echo` directamente sobre un array, PHP no mostrará los valores de manera legible; en su lugar, simplemente mostrará algo como "Array", que no ayuda mucho a entender qué contiene realmente este array. Para visualizar correctamente el contenido del array, sería mejor iterar sobre sus elementos y mostrarlos uno por uno o usar una función específica para imprimir arrays, como `print_r()`.

Este código es útil para introducir los conceptos básicos de cómo se crean y manipulan arrays en PHP, lo cual es fundamental en la programación ya que permite almacenar colecciones de datos relacionados.

`028-arrays.php`

```
<?php
  $agenda = [];
  $agenda[0] = "Juan";
  $agenda[1] = "Jorge";
  echo $agenda;
?>
```

### vomitamos arrays
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código PHP crea un array llamado `$agenda` que almacena nombres de personas. En primer lugar, se inicializa el array con la línea `[]`, lo cual significa que comienza vacío. Luego, se añaden dos elementos al array: "Juan" en la posición 0 y "Jorge" en la posición 1. Finalmente, `var_dump($agenda)` es utilizado para imprimir la información completa del array, incluyendo sus tipos de datos y valores actuales. Esto es útil cuando quieres ver exactamente cómo se estructura el array en memoria después de haber añadido los nombres.

Este fragmento de código ilustra cómo declarar e inicializar arrays en PHP y cómo agregar elementos a ellos usando índices numéricos. La función `var_dump()` es una herramienta valiosa para depurar programas, ya que proporciona detalles técnicos sobre las variables, lo cual ayuda a comprender mejor su estructura interna y el contenido que almacenan.

`029-vomitamos arrays.php`

```
<?php
  $agenda = [];
  $agenda[0] = "Juan";
  $agenda[1] = "Jorge";
  var_dump($agenda);
?>
```

### creacion de una clase
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es el inicio de la creación de una clase en PHP llamada `Gato`. Una clase es como un modelo o plantilla que define los atributos y comportamientos comunes a todos sus objetos. En este caso, estás comenzando con una clase vacía sin ninguna propiedad (variables) ni métodos (funciones). El objetivo de este ejercicio es familiarizarse con la estructura básica de cómo se declara una clase en PHP.

Es importante notar que el código está envuelto entre las etiquetas `<?php` y `?>`, lo cual indica al servidor web que el contenido dentro de ellas debe ser interpretado como código PHP. Esto es crucial para que el script funcione correctamente en un entorno de desarrollo web basado en PHP.

Crear una clase, aunque inicialmente vacía, es fundamental porque permite extender la estructura y agregar más detalles según sea necesario a medida que avances en tu proyecto o ejercicios de programación.

`030-creacion de una clase.php`

```
<?php
  class Gato{
    
  }
?>
```

### creamos propiedades
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código PHP está intentando definir una clase llamada `Gato`. Una clase es como un plano o un molde que se utiliza para crear objetos. En este caso, la intención era incluir una propiedad en la clase `Gato`, específicamente `$this->color`, lo cual sería usado para almacenar el color del gato.

Sin embargo, hay un problema importante: la sintaxis utilizada es incorrecta en PHP. La línea `$this->color;` no está dentro de ningún método (función) de la clase y no se puede declarar una propiedad de esta manera directamente en la definición de la clase sin inicializarla o incluirla dentro de un bloque `public`, `private`, `protected`, etc.

Para corregir esto, deberías declarar `$this->color;` dentro del constructor de la clase (el método `__construct`) o simplemente como una propiedad de la clase, por ejemplo:

```php
class Gato {
    public $color;
}
```

O bien, si prefieres inicializar esta propiedad en el momento en que se crea un objeto de tipo `Gato`:

```php
class Gato {
    private $color;

    public function __construct($color) {
        $this->color = $color;
    }
}
```

Es importante entender cómo declarar propiedades correctamente dentro de una clase para evitar errores y para que el código sea fácilmente mantenible.

`031-creamos propiedades.php`

```
<?php
  class Gato{
    $this->color;
  }
?>
```

### creamos un constructor
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código PHP define una clase llamada `Gato` que contiene un método llamado `constructor`. Sin embargo, hay algunos puntos importantes y errores en este fragmento de código:

1. **Nombre del Método**: En PHP, el constructor de una clase debe llamarse exactamente `__construct()`, no simplemente `constructor()`. El constructor es especial porque se ejecuta automáticamente cuando se crea un nuevo objeto a partir de la clase.

2. **Propiedades**: Dentro del método, `$this->color` y `$this->edad` son menciones a las propiedades (variables) de la clase `Gato`, pero no están inicializadas ni definidas previamente en la clase. Para que estas líneas tengan sentido, primero se deben declarar como propiedades de la clase.

Es importante corregir el nombre del método para hacerlo un constructor válido y asegurarse de que las propiedades existan antes de ser referenciadas dentro del método constructor. Esto permitirá inicializar correctamente estos valores cuando se crea una nueva instancia (objeto) del `Gato`.

`032-creamos un constructor.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código PHP muestra cómo crear una clase simple llamada `Gato` y luego instanciar dos objetos de esta clase. La clase tiene un método llamado `constructor`, aunque en PHP no es necesario declararlo explícitamente ya que la función `__construct()` se usa automáticamente para inicializar las propiedades del objeto cuando se crea.

En el código, se intenta asignar valores a `$this->color` y `$this->edad` dentro de un método llamado `constructor`, pero falta la palabra clave `public`, `private`, o `protected` antes de la declaración del método, así como los signos de igualdad para inicializar las propiedades. Sin embargo, es importante notar que en PHP no se debe declarar explícitamente un constructor con el nombre `constructor`. En su lugar, deberías usar `__construct`.

Finalmente, se crea una instancia de la clase `Gato` llamada `$gato1` y otra llamada `$gato2`, pero después solo se muestra información sobre `$gato1` utilizando la función `var_dump()`. Esto te dará detalles sobre las propiedades del objeto $gato1, mostrando que sus propiedades no están inicializadas correctamente debido a los errores en el método `constructor`.

Este código es un buen punto de partida para aprender cómo crear clases y objetos en PHP, pero necesitarás corregir la declaración del constructor para que funcione correctamente.

`033-creamos dos gatos.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código PHP es una introducción a la programación orientada a objetos, específicamente usando clases y objetos. La clase se llama `Gato` y tiene un método llamado `constructor`, aunque en PHP el constructor debe llamarse exactamente `__construct`. En este ejemplo, el constructor está mal nombrado pero intenta inicializar dos propiedades del objeto: `color` y `edad`.

Después de definir la clase, se crean dos objetos de tipo `Gato`: `$gato1` y `$gato2`. Luego, se utiliza la función `var_dump()` para mostrar el contenido actual del objeto `$gato1`, lo que incluye sus propiedades. A continuación, se asignan valores a las propiedades `color` e `edad` del objeto `$gato1`: "blanco" y 0 respectivamente.

Finalmente, se imprime en la página web los valores de las propiedades recién definidas: el color del gato es "blanco" y su edad es 0. Este código demuestra cómo crear objetos, asignarles atributos y acceder a sus métodos o propiedades para manipularlos.

Es importante notar que este ejemplo tiene un error en la declaración del constructor de la clase, ya que debería ser `__construct` en lugar de simplemente `constructor`.

`034-lectura y escritura.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código PHP crea una clase llamada `Gato` que tiene dos propiedades privadas: `$color` y `$edad`. Las propiedades privadas solo pueden ser accedidas dentro de la misma clase, lo que significa que son protegidas para evitar modificaciones desde el exterior.

El código también incluye un método llamado `constructor`, pero este método no está haciendo nada útil en este momento; simplemente declara las variables `$color` y `$edad` sin inicializarlas ni hacer ninguna operación. En la programación orientada a objetos, los constructores son métodos especiales que se ejecutan automáticamente cuando se crea un nuevo objeto de una clase.

Después del bloque de la clase `Gato`, el código crea dos objetos de esta clase: `$gato1` y `$gato2`. Luego, utiliza la función `var_dump()` para mostrar los valores actuales del objeto `$gato1`.

Finalmente, el código muestra cómo modificar las propiedades privadas `$color` y `$edad` del objeto `$gato1`, aunque en realidad estas propiedades deberían ser modificadas a través de métodos públicos como `setColor()` o `setEdad()`. Sin embargo, en este caso se está accediendo directamente a ellas desde fuera de la clase, lo cual normalmente no sería permitido si las propiedades fueran correctamente privadas. A continuación, imprime el color y la edad del gato utilizando los métodos `echo`.

Es importante entender que, aunque las propiedades están declaradas como privadas en este código, PHP permite acceder a ellas desde fuera de la clase por defecto debido a un nivel bajo de encapsulamiento. En aplicaciones más avanzadas, se implementaría una mayor protección para estas variables utilizando métodos getter y setter.

`035-propiedades privadas.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código define una clase llamada `Gato` en PHP que representa a un gato con propiedades privadas como el color y la edad. Las propiedades son campos internos de la clase que solo pueden ser accedidos dentro del propio objeto o mediante métodos específicos proporcionados por la clase.

El código incluye dos métodos principales para manipular estas propiedades: `setEdad` y `setColor`, que permiten establecer el valor de las propiedades `edad` y `color` respectivamente, y dos métodos `getEdad` y `getColor` para obtener los valores actuales de esas mismas propiedades.

Después de definir la clase, se crean dos instancias del objeto `Gato`: `$gato1` e `$gato2`. Para `$gato1`, el código utiliza los métodos `setColor` y `setEdad` para establecer su color en "blanco" y su edad en 0. Finalmente, muestra por pantalla el color y la edad del gato utilizando los métodos `getColor` y `getEdad`.

Este tipo de diseño, que usa métodos públicos para manipular propiedades privadas (también conocidos como encapsulamiento), es importante porque permite controlar cómo se accede a las partes internas de un objeto, protegiendo así la integridad del estado del objeto y facilitando su mantenimiento y extensión en el futuro.

`036-metodos set y get.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es una parte importante del aprendizaje de la programación orientada a objetos en PHP. Aquí, se define una clase llamada `Gato` que tiene dos propiedades privadas: `$color` y `$edad`. La propiedad privada significa que estas variables solo pueden ser accedidas dentro de la propia clase.

El código incluye un constructor especial denominado `__construct`, que es llamado automáticamente cuando se crea una nueva instancia del objeto Gato. Este constructor acepta dos parámetros: `$color` y `$edad`. Estos valores se utilizan para inicializar las propiedades privadas del gato, lo que permite establecer el color y la edad del gato en el momento de su creación.

Además, la clase tiene métodos públicos llamados `setColor`, `setEdad`, `getColor` y `getEdad`. Estos métodos permiten a otras partes del código cambiar o recuperar los valores de las propiedades privadas `$color` y `$edad`.

En el último bloque del código, se crea una instancia de la clase Gato llamada `$gato1` con un color blanco y una edad inicial de 0. Luego, se imprimen en pantalla los colores y edades actuales del gato utilizando los métodos `getColor()` y `getEdad()`, respectivamente.

Este código es importante porque demuestra cómo utilizar propiedades privadas y cómo encapsular la lógica dentro de una clase para proteger los datos. También muestra cómo se inicializan objetos a través de constructores en PHP, lo que es fundamental para el manejo eficiente de las instancias de clases en programas más grandes.

`037-constructor con parametros.php`

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

### Actividades propuestas

### Actividades Propuestas

#### Actividad 1: Configuración del Entorno de Desarrollo PHP
**Descripción:** Los estudiantes deben configururar su entorno de desarrollo en Windows u Ubuntu usando XAMPP o Apache/PHP, respectivamente. Se les pedirá que verifiquen la instalación ejecutando un archivo "hola mundo" básico y asegurándose de que el servidor web funcione correctamente.

#### Actividad 2: Introducción a PHP y HTML
**Descripción:** Los estudiantes deben crear una página web simple usando PHP para mezclar HTML y PHP, mostrando texto estático con algunos bloques de código PHP.

#### Actividad 3: Uso de Comentarios en PHP
**Descripción:** Los alumnos deben escribir diferentes tipos de comentarios (una línea y multi-línea) dentro del código PHP y comentar por qué es importante usarlos. 

#### Actividad 4: Salidas con `echo` vs `print`
**Descripción:** Este ejercicio consiste en utilizar tanto la función `echo` como `print` para mostrar mensajes y comparar sus diferencias.

#### Actividad 5: Variables en PHP
**Descripción:** Los estudiantes deben declarar variables, asignarles valores y luego usar las funciones `echo` o `print` para mostrar el contenido de esas variables. 

#### Actividad 6: Operadores Aritméticos
**Descripción:** Crear ejercicios que utilicen los operadores aritméticos básicos (suma, resta, multiplicación, división y módulo) con números enteros.

#### Actividad 7: Condicionales If-Else 
**Descripción:** Escribir un programa PHP que use condicionales `if`, `else` e `elseif` para clasificar a los usuarios en diferentes grupos según su edad. 

#### Actividad 8: Estructuras de Bucle
**Descripción:** Implementar bucles `for`, `while` y `do-while` para recorrer arrays, realizar iteraciones y mostrar datos.

#### Actividad 9: Uso de Arrays en PHP
**Descripción:** Los estudiantes deben crear un array asociativo con diferentes elementos (nombres, edades) y luego acceder a los elementos usando sus claves. 

#### Actividad 10: Creación de una Clase Simple 
**Descripción:** Los alumnos crearán una clase básica (`Gato`) con propiedades privadas y métodos `set` y `get` para encapsular la información.

Estas actividades ayudarán a los estudiantes a familiarizarse gradualmente con PHP, desde su configuración inicial hasta el manejo de clases.


<a id="conexion-a-mysql-desde-php"></a>
## Conexion a MySQL desde PHP

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/008-Programacion%20en%20entorno%20servidor/002-Conexion%20a%20MySQL%20desde%20PHP)

### Introducción a los ejercicios

Este conjunto de ejercicios está diseñado para que los estudiantes practiquen la conexión a una base de datos MySQL desde PHP y el manejo de resultados en un entorno web. Los problemas van desde conectarse básicamente a la base de datos y recuperar información, hasta formatearla y mostrarla en una página web con estilos básicos y estructuras HTML más complejas como tablas y navegación. Se trabajan competencias esenciales como el uso del lenguaje PHP para consultas SQL, la integración de código PHP dentro de documentos HTML, y la aplicación de CSS básico para mejorar la presentación visual de los datos.

### conecto a la base de datos
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código PHP se encarga de conectarse a una base de datos MySQL y recuperar información de la tabla llamada `entradas`. Primero, crea una conexión con la base de datos usando el objeto `mysqli`, proporcionando los detalles necesarios como el servidor (localhost), nombre del usuario (blog2526) y contraseña (también blog2526). Luego, construye una consulta SQL que selecciona todos los campos (`*`) de la tabla `entradas`. Esta consulta se ejecuta usando el método `query` del objeto de conexión a la base de datos.

Después, se itera sobre cada fila devuelta por la consulta utilizando un bucle `while`, y para cada fila obtenida, muestra sus datos en pantalla usando la función `var_dump()`. La función `var_dump()` proporciona una representación detallada del array asociativo que representa a cada fila de resultados. Cada salida se separa con una línea en blanco (`<br>`) para mejorar su legibilidad.

Esta práctica es útil para estudiantes que quieren entender cómo interactuar con bases de datos desde PHP y visualizar los datos que están recuperando.

`001-conecto a la base de datos.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código PHP se conecta a una base de datos MySQL y obtiene información sobre las entradas del blog para mostrarla en formato HTML. Primero, crea una conexión a la base de datos usando los detalles proporcionados (servidor, usuario, contraseña y nombre de la base de datos). Luego, ejecuta una consulta SQL que selecciona todos los registros de la tabla llamada `entradas`. Cada registro contiene información como el título, fecha, autor y contenido de cada entrada del blog.

El código utiliza un bucle `while` para recorrer todas las filas devueltas por la consulta. Para cada fila, genera un bloque HTML que representa una entrada del blog. Este bloque incluye los elementos `<h3>`, `<time>` y dos etiquetas `<p>` para mostrar el título, fecha, autor y contenido de cada entrada respectivamente.

Este fragmento es importante porque demuestra cómo integrar PHP con bases de datos MySQL para manejar la información del sitio web dinámicamente, lo que permite a los desarrolladores crear aplicaciones interactivas y actualizables en tiempo real.

`002-formateo algo mejor.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código HTML con un bloque interno de PHP tiene como objetivo mostrar los artículos del blog almacenados en una base de datos MySQL. En primer lugar, el archivo se conecta a la base de datos utilizando la clase `mysqli`, proporcionando los detalles necesarios como host (localhost), usuario y contraseña para la base de datos "blog2526".

Una vez establecida la conexión, el código ejecuta una consulta SQL que selecciona todos los campos de la tabla llamada `entradas`. Los resultados obtenidos se almacenan en la variable `$resultado`.

A continuación, se itera sobre cada fila del resultado utilizando un bucle `while` y la función `fetch_assoc()`, lo cual permite recorrer cada artículo del blog almacenado. Para cada entrada, el código crea una estructura HTML que incluye el título (`$fila['titulo']`), la fecha (`$fila['fecha']`), el autor (`$fila['autor']`) y el contenido (`$fila['contenido']`) de forma que se muestre en un formato legible en la página web.

Esta práctica es crucial para permitir a los usuarios interactuar con datos almacenados en una base de datos directamente desde la interfaz del navegador, proporcionando un flujo dinámico y actualizado de información.

`003-rodeo al blog de html.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es un archivo HTML que también contiene código PHP para mostrar entradas de un blog desde una base de datos MySQL. El objetivo principal es conectar a la base de datos y recuperar información de una tabla llamada `entradas`, luego mostrar esos datos en el formato de un sitio web simple.

El código comienza creando la estructura básica del documento HTML con CSS incorporado para darle estilo, como un fondo azul índigo, texto sin serif, y bloques centrales para la cabecera, el cuerpo principal y el pie de página. En la sección `<main>`, se utiliza PHP para establecer una conexión a la base de datos MySQL usando la clase `mysqli`. Luego, ejecuta una consulta SQL que selecciona todos los registros de la tabla `entradas`.

A continuación, por cada registro recuperado, crea un artículo HTML con detalles como el título, fecha, autor y contenido del blog. Cada entrada está encerrada dentro de una etiqueta `<article>`, lo cual es útil para la estructura semántica del documento.

Esta técnica combina HTML para estructurar y presentar datos, CSS para dar estilo a los elementos y PHP para interactuar con la base de datos y manejar lógica más compleja. Es fundamental en el desarrollo web moderno para crear páginas dinámicas que reflejan información actualizada directamente desde una base de datos.

`004-un poco de estilo.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código HTML crea una página web simple con un diseño de dos columnas usando CSS Flexbox. La estructura principal está compuesta por un elemento `nav` para el menú y un elemento `main` para el contenido principal del sitio.

En la parte superior, se define un estilo básico que ajusta tanto el ancho como la altura del documento a 100% y elimina cualquier margen o relleno innecesario. Luego, se establece que el cuerpo de la página (`body`) debe usar Flexbox para organizar sus elementos hijos.

El `nav` tiene una porción más estrecha en comparación con el `main`, con un fondo azul oscuro y texto en blanco. El `main` ocupa el mayor espacio restante del contenedor padre, tiene un color de fondo claro (azul aliceblue) y también tiene algo de relleno.

Este diseño es útil para crear interfaces web sencillas donde se requiera una barra lateral más estrecha para menús o navegación mientras que el contenido principal ocupa la mayor parte del espacio disponible.

`005-panel de control con PHP.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código es un ejemplo de cómo conectar a una base de datos MySQL desde PHP y mostrar información en la página web. En este caso específico, el fragmento muestra los nombres de las tablas existentes en la base de datos.

Primero, se crea una conexión a la base de datos utilizando `mysqli`, un sistema que permite interactuar con bases de datos MySQL desde PHP. Luego, ejecuta una consulta SQL para listar todos los nombres de las tablas dentro de esa base de datos específica (en este caso, llamada "miempresa"). Por cada tabla encontrada, se genera un botón en la página web que muestra el nombre de la tabla.

Esta práctica es útil cuando deseas dar a los usuarios acceso directo a diferentes partes de tu base de datos a través del diseño de una interfaz web simple. En este ejemplo, el listado de tablas y sus correspondientes botones se colocan dentro de un menú lateral (`nav`), mientras que en la parte principal (`main`) puedes incluir contenido adicional o funcionalidades relacionadas con cada tabla mostrada.

El uso del CSS permite organizar visualmente estos elementos, asegurando que tanto el menú como el área principal estén correctamente distribuidos y visibles en la página web.

`006-pongo los botones.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es un archivo HTML que también incluye algunos elementos de PHP. Su función principal es crear una página web sencilla con un menú lateral y una sección principal, donde el menú está generado dinámicamente a partir de la base de datos MySQL.

En la parte superior del documento (dentro de las etiquetas `<head>`), hay código CSS que establece estilos para toda la página. Estos estilos aseguran que tanto el contenido del navegador como los elementos HTML ocupen todo el espacio disponible y crean una disposición en dos columnas, con un menú vertical a la izquierda y una sección principal a la derecha.

En la parte central del documento (dentro de las etiquetas `<body>`), hay una estructura HTML que incluye una etiqueta `<nav>` para el menú y una etiqueta `<main>` para el contenido principal. Lo interesante aquí es que dentro de la etiqueta `<nav>`, hay un bloque de PHP que realiza varias acciones:

1. Establece una conexión a la base de datos MySQL utilizando la clase `mysqli`. Los detalles de la conexión incluyen el servidor (localhost), nombre del usuario y contraseña, así como el nombre de la base de datos (todos ellos son "miempresa" en este ejemplo).
2. Ejecuta una consulta SQL que muestra todos los nombres de las tablas existentes en esa base de datos.
3. Recorre cada fila del resultado obtenido y genera un botón HTML para cada tabla encontrada, mostrando el nombre de la tabla como texto dentro del botón.

Este código es importante porque demuestra cómo integrar PHP y MySQL para generar dinámicamente el contenido de una página web basado en datos almacenados en una base de datos. Además, muestra cómo combinar diferentes tecnologías (PHP, HTML, CSS) para crear interfaces web interactivas y estéticamente atractivas.

`007-un poco de estilo para el menu.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es un archivo HTML que combina HTML y PHP para crear una página web sencilla con funcionalidades básicas de conexión a una base de datos MySQL. La página se divide en dos partes principales: un menú lateral (nav) y el contenido principal (main).

En la parte superior del código, dentro del `<nav>` tag, hay un bloque PHP que establece una conexión a una base de datos MySQL usando la clase `mysqli`. Luego ejecuta una consulta SQL para mostrar todos los nombres de las tablas en la base de datos y crea un botón HTML para cada tabla encontrada. Esto permite al usuario ver fácilmente qué tablas están presentes en su base de datos.

En el `<main>` tag, hay otro bloque PHP que vuelve a establecer una conexión con la misma base de datos (esto es ineficiente; normalmente se crearía solo una instancia del objeto mysqli y se usaría para todas las consultas). Luego ejecuta una consulta SQL para seleccionar todos los registros de la tabla "clientes". Por cada fila devuelta por la consulta, el código crea una nueva fila `<tr>` en una tabla HTML. Dentro de esa fila, recorre cada columna (campo) del registro y genera celdas `<td>` para mostrar los valores.

Este código es útil para estudiantes que están aprendiendo a interactuar con bases de datos MySQL desde PHP, mostrando cómo conectarse a la base de datos, ejecutar consultas SQL y representar visualmente los resultados en una página web. Sin embargo, en un entorno real, se recomendaría mejorar la eficiencia del código eliminando la duplicación de conexiones a la base de datos y añadiendo medidas para protegerse contra inyecciones SQL.

`008-creo una tabla.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código HTML con inserciones de PHP crea una página web sencilla que muestra un menú navegacional y un contenido principal. En la parte superior, el navegador (nav) contiene botones generados dinámicamente por PHP que representan los nombres de las tablas disponibles en la base de datos MySQL llamada "miempresa". Cada botón está creado a partir del resultado de la consulta SQL `SHOW TABLES`, lo cual recupera todos los nombres de las tablas dentro de esa base de datos.

En el contenido principal (main), hay una tabla HTML que muestra los registros de la tabla 'clientes' también desde la misma base de datos. El PHP establece una conexión a MySQL, ejecuta una consulta SQL para seleccionar todas las filas y columnas de la tabla 'clientes', y luego bucea en cada fila del resultado devuelto por el servidor para imprimir en HTML las celdas correspondientes dentro de filas (tr) y celdas (td) de la tabla.

Este ejemplo es importante porque combina varios conceptos clave: cómo conectar a una base de datos MySQL desde PHP, cómo ejecutar consultas SQL, y cómo integrar resultados de dicha consulta en el diseño web HTML para presentar información estructurada visualmente.

`009-estilo de la tabla.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es una página web simple que utiliza PHP para conectarse a una base de datos MySQL y mostrar información en formato HTML. La página se divide en dos partes principales: un menú lateral (nav) con botones que representan las diferentes tablas disponibles en la base de datos, y el contenido principal (main), donde se muestra una tabla con los datos del conjunto de registros 'clientes'.

En la parte superior del código, antes del cierre del `</head>`, hay definiciones CSS que establecen estilos básicos para toda la página. Estos incluyen la configuración del fondo del navegador lateral y del contenido principal, así como el estilo para las tablas y sus encabezados.

El bloque PHP dentro de `<nav>` se conecta a la base de datos utilizando `mysqli` e invoca una consulta SQL (`SHOW TABLES`) que recupera los nombres de todas las tablas en la base de datos 'miempresa'. Luego, por cada tabla encontrada, genera un botón con el nombre de la tabla.

El bloque PHP dentro del `<thead>` (encabezado de la tabla) realiza una consulta a la tabla `clientes` para obtener solo una fila (`LIMIT 1`) y extrae los nombres de las columnas que se mostrarán como encabezados en la tabla. Cada columna es representada por un elemento HTML `<th>`, que es similar a `<td>` pero se utiliza específicamente para etiquetar las celdas de encabezado.

Finalmente, el bloque PHP dentro del `<tbody>` (cuerpo de la tabla) realiza una consulta más completa a la tabla `clientes` y genera filas HTML (`<tr>`) que contienen datos en celdas (`<td>`). Cada fila corresponde a un registro en la base de datos.

Esta página es útil para visualizar rápidamente cómo se estructuran los datos dentro de una tabla específica y proporciona acceso directo a otras tablas disponibles en la misma base de datos.

`010-muestro las cabeceras de las tablas.php`

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

### Actividades propuestas

### Actividades Propuestas

1. **Conexión a la Base de Datos**
   - **Descripción:** Los estudiantes deben crear un archivo PHP que se conecte correctamente a una base de datos MySQL y muestre los registros de una tabla específica utilizando `var_dump()` para verificar la conexión y el contenido devuelto.

2. **Visualización de Registros en HTML**
   - **Descripción:** Basándose en el primer ejercicio, los estudiantes deben modificar el archivo PHP para presentar visualmente cada registro de la base de datos como un artículo estructurado con etiquetas HTML (h3, time, p).

3. **Integración con HTML**
   - **Descripción:** Los alumnos deben integrar su código PHP dentro de una página web estática HTML, que muestre los registros de las entradas en una estructura coherente y estilizada.

4. **Aplicación de Estilos**
   - **Descripción:** A partir del tercer ejercicio, se solicita a los estudiantes añadir estilo básico CSS para mejorar la presentación visual de los artículos en el blog utilizando colores y fuentes definidas.

5. **Desarrollo de Panel de Control**
   - **Descripción:** Los alumnos deben crear un panel de control con una estructura HTML similar al cuarto ejercicio, pero adaptado a sus propias necesidades o las indicadas por el profesor, incluyendo botones y menús interactivos.

6. **Generación Dinámica de Menú**
   - **Descripción:** Los estudiantes deben implementar un script PHP que genere dinámicamente una lista desplegable en HTML con los nombres de todas las tablas disponibles en la base de datos, usando botones o elementos select.

7. **Creación y Presentación Tabular**
   - **Descripción:** A partir del séptimo ejercicio, los estudiantes deben diseñar un formulario PHP que permita a los usuarios crear una nueva tabla en la base de datos y luego presentarla visualmente en formato HTML tabular.

8. **Estilo Avanzado para Tablas**
   - **Descripción:** Los alumnos deberán aplicar estilos CSS avanzados a las tablas generadas dinámicamente en PHP, incluyendo bordes, tamaños de fuente y colores, mejorando la legibilidad y apariencia del panel.

9. **Integración de Cabeceras Tabulares**
   - **Descripción:** Basándose en el último ejercicio, los estudiantes deben integrar las cabeceras de las tablas en su presentación visual, incluyendo títulos visibles para cada columna, con estilos aplicados.

10. **Optimización y Mejoras Finales**
    - **Descripción:** Finalmente, los alumnos tendrán la oportunidad de realizar mejoras adicionales a sus proyectos web (como optimizar el código PHP o CSS, mejorar accesibilidad, etc.), preparando su trabajo para una presentación final con funcionalidades completas.


<a id="get-y-post-en-php"></a>
## get y post en PHP

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/008-Programacion%20en%20entorno%20servidor/003-get%20y%20post%20en%20PHP)

### Introducción a los ejercicios

Esta carpeta contiene una serie de ejercicios en PHP que se centran en el manejo de formularios y la interacción con bases de datos. Los problemas abordan cómo capturar y procesar datos enviados mediante métodos GET y POST, así como cómo estructurar y mejorar la presentación de información desde una base de datos en páginas web. Estos ejercicios permiten a los estudiantes practicar habilidades fundamentales de programación en PHP, incluyendo el uso de variables superglobales, consultas SQL básicas y técnicas de diseño web para mejorar la estética de las aplicaciones.

### get
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código PHP imprime en la página web el valor que se le envía a través de una URL mediante el método GET. En específico, está buscando un parámetro llamado 'nombre' dentro de la URL y muestra su valor en pantalla.

Funciona así: cuando un usuario visita una URL como `http://ejemplo.com/001-get.php?nombre=Juan`, este código PHP recoge el valor "Juan" que le corresponde al parámetro 'nombre', gracias a la superglobal `$_GET` de PHP, y lo muestra en la página web con la función `echo`.

Es importante porque permite que los sitios web interactúen dinámicamente con los usuarios a través de las URL, permitiendo enviar información desde el navegador del usuario hasta el servidor.

`001-get.php`

```
<?php

  // GET es una variable de URL
  echo $_GET['nombre'];

?>
```

### pasar varios parametros
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código PHP muestra cómo obtener y mostrar los valores enviados mediante el método GET en una solicitud web. Cuando un usuario envía información a través de un formulario o directamente en la URL, esa información se almacena en un array asociativo llamado `$_GET`. En este caso, el código está recuperando dos elementos específicos del array `$_GET`: 'nombre' y 'apellidos'. 

Lo que hace es imprimir primero el valor del parámetro 'nombre' y luego el de 'apellidos', cada uno seguido por una línea en blanco (`<br>`), lo cual es comúnmente utilizado para separar visualmente la salida en HTML. Este código es importante porque permite a las páginas web interactuar con los usuarios proporcionando retroalimentación basada en los datos que estos ingresan o seleccionan.

Este tipo de práctica es fundamental cuando se trabaja con formularios y necesitas procesar información enviada por el usuario directamente en tu sitio web.

`002-pasar varios parametros.php`

```
<?php

  // GET es una variable de URL
  echo $_GET['nombre'];
  echo "<br>";
  echo $_GET['apellidos'];

?>
```

### metodo post
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código HTML crea un formulario que permite a los usuarios ingresar su nombre y apellidos. El formulario utiliza el método POST para enviar la información al archivo "004-procesa.php" cuando se hace clic en el botón de envío.

En detalle, el código incluye dos campos de entrada: uno para el nombre y otro para los apellidos. Estos campos tienen atributos `name` que permiten identificarlos en el archivo PHP destino (004-procesa.php). Además, se utiliza la directiva `method="POST"` en la etiqueta `<form>` para indicar que los datos del formulario deben enviarse mediante una solicitud POST, lo cual es más seguro y adecuado cuando se envían datos confidenciales o sensibles.

Esta técnica es importante porque permite a las aplicaciones web recoger información de los usuarios de manera estructurada y procesarla en el servidor para realizar acciones específicas como guardar datos en una base de datos o simplemente mostrar un mensaje personalizado.

`003-metodo post.php`

```
<form action="004-procesa.php" method="POST">
  <input type="text" name="nombre" placeholder="Introduce tu nombre">
  <input type="text" name="apellidos" placeholder="Introduce tus apellidos">
  <input type="submit">
</form>
```

### procesa
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código PHP está diseñado para procesar información enviada por un formulario web usando el método POST. Lo que hace específicamente es tomar los datos del nombre y los apellidos ingresados por el usuario en el formulario, y luego mostrarlos en una página HTML.

El código utiliza variables superglobales `$_POST` para acceder a los valores enviados desde el formulario. En este caso, las variables `$_POST['nombre']` y `$_POST['apellidos']` contienen los datos que el usuario ingresó en campos de entrada con nombres "nombre" y "apellidos", respectivamente.

El uso del método POST es importante porque permite enviar información sensible o larga sin limitaciones, y además mantiene la seguridad al no exponer estos datos en la URL como ocurre con GET.

`004-procesa.php`

```
<?php
  echo "Tu nombre es: ".$_POST['nombre'];
  echo "<br>";
  echo "Tus apellidos son: ".$_POST['apellidos'];
?>
```

### continuamos con el panel de control
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es una página web simple que muestra un panel de control con dos partes principales: un menú en la parte izquierda y un área principal donde se muestran los datos de las tablas de una base de datos MySQL. La página utiliza PHP para interactuar con la base de datos y HTML para estructurar el contenido.

En primer lugar, el código establece una conexión a la base de datos utilizando PHP y muestra un enlace para cada tabla que contiene dicha base de datos en la sección lateral (nav). Cada enlace está configurado para pasar el nombre de la tabla como un parámetro GET en la URL. Esto significa que cuando el usuario hace clic en uno de estos enlaces, cambia la consulta a otra página o al mismo fragmento de PHP que muestra los datos correspondientes a esa tabla.

En la sección principal (main), hay una tabla HTML que utiliza PHP para llenar sus filas y columnas con los nombres de las columnas de la tabla seleccionada (cabeza) y sus respectivos valores. Esto ocurre porque el código PHP en la parte superior del cuerpo del documento ya ha recibido un parámetro GET 'tabla' desde la URL, que indica qué tabla se debe visualizar.

Este tipo de página es útil para administradores o usuarios con permisos adecuados, ya que les permite ver rápidamente los datos almacenados en diferentes tablas sin necesidad de escribir múltiples consultas SQL. Es importante destacar que este código debería ser utilizado únicamente en entornos seguros y controlados, dado que la forma en que se maneja la conexión a la base de datos y el uso directo del parámetro GET para seleccionar las tablas puede ser un riesgo si no se implementan medidas adicionales de seguridad, como verificar los nombres de las tablas antes de ejecutar consultas.

`005-continuamos con el panel de control.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código es una página HTML que muestra información de una base de datos MySQL usando PHP. La estructura principal del documento consiste en un menú lateral (`nav`) y un área central (`main`). El menú lateral genera enlaces a diferentes tablas en la base de datos, mientras que el área principal muestra los detalles de las tablas seleccionadas.

En el menú lateral, el código PHP se conecta a una base de datos MySQL y obtiene una lista de todas las tablas. Para cada tabla encontrada, crea un enlace HTML con el nombre de la tabla como texto del enlace. Al hacer clic en cualquiera de estos enlaces, se genera una URL que incluye el nombre de la tabla como parámetro GET.

En la parte central (`main`), hay una tabla estilizada que muestra los datos de la tabla seleccionada a través del menú lateral. El código PHP primero obtiene las columnas (títulos) de la tabla especificada por el parámetro GET y genera filas con encabezados para estos títulos. Luego, recupera todos los registros en esa tabla y muestra sus valores en una fila correspondiente de celdas.

Este código es útil para explorar fácilmente diferentes tablas de una base de datos sin necesidad de crear páginas individuales para cada tabla. Además, utiliza CSS para darle un diseño moderno con colores y bordes redondeados a la tabla, mejorando así la estética del sitio web.

`011-ajustes esteticos.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código es una página web sencilla que muestra tablas de una base de datos utilizando PHP y HTML. La página se divide en dos partes principales: un menú lateral (nav) y una zona principal (main). El menú lateral lista todas las tablas disponibles en la base de datos, mientras que la zona principal muestra los detalles de la tabla seleccionada.

En el menú lateral, el código PHP conecta a la base de datos y recupera la lista de nombres de las tablas. Para cada nombre de tabla encontrado, se genera un enlace (HTML `<a>`) que permite al usuario acceder a esa tabla específica cuando es clicado. El enlace incluye información sobre qué tabla se está mostrando, utilizando el método GET para pasar el parámetro `tabla` desde la URL.

En la zona principal de la página, hay una tabla HTML que muestra los datos de la tabla seleccionada del menú lateral. La parte superior (thead) de esta tabla contiene las claves o nombres de los campos (columns), y la parte inferior (tbody) muestra los valores reales de esos campos para cada registro en la base de datos.

Este código es importante porque proporciona una interfaz básica pero funcional para explorar y visualizar datos almacenados en una base de datos, especialmente útil durante el desarrollo y pruebas. Sin embargo, se recomienda mejorar la seguridad del código (por ejemplo, validando los parámetros de entrada) antes de usarlo en entornos de producción.

`012-mas ajustes esteticos.php`

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

### Actividades propuestas

### Actividades Propuestas para Estudiantes de Ciclos Formativos

1. **Procesamiento de Datos con GET**
   - Los estudiantes deben crear un formulario que permita enviar datos al servidor usando el método GET y mostrar estos datos en otra página.
   - Se pretende que aprendan a manejar variables superglobales como `$_GET` y la gestión de formularios HTML.

2. **Enviar Varios Parámetros con GET**
   - Los alumnos deben desarrollar un formulario que permita enviar múltiples parámetros al servidor mediante el método GET.
   - El objetivo es que comprendan cómo pasar más de una variable en la URL y su procesamiento.

3. **Procesamiento de Datos con POST**
   - Se les pide a los estudiantes crear un formulario que envíe datos utilizando el método POST y mostrar estos datos en otra página PHP.
   - Esta actividad se enfoca en el uso del método `$_POST` para manejar formularios seguros.

4. **Construcción de una Página de Control**
   - Los alumnos deben diseñar un panel de control que muestre todas las tablas disponibles en una base de datos MySQL y su contenido al hacer clic.
   - Se espera que aprendan a conectar PHP con MySQL, gestionar consultas SQL y manipular parámetros GET.

5. **Ajustes Estéticos en el Panel de Control**
   - Los estudiantes deben mejorar visualmente la página del panel de control desarrollada anteriormente añadiendo estilos CSS.
   - El objetivo es que adquieran habilidades en diseño web básico para mejorar la presentación del contenido generado por PHP.

6. **Refinamiento Visual con Estilo CSS Personalizado**
   - Se les pide a los alumnos agregar más características de estilo CSS, como bordes redondeados y colores contrastantes, a la página del panel de control.
   - Se pretende que consoliden sus conocimientos en CSS para mejorar la interfaz web.

7. **Incorporación de Elementos Gráficos**
   - Los estudiantes deben agregar un pequeño ícono al inicio de cada nombre de tabla mostrada en el nav, utilizando elementos HTML y CSS.
   - Esta actividad busca mejorar las habilidades en combinación de estilos CSS con HTML para crear interfaces más atractivas.

8. **Documentación de Códigos**
   - Los alumnos deben documentar detalladamente la estructura y funcionamiento del código PHP utilizado en el panel de control, incluyendo comentarios explicativos.
   - Se espera que aprendan la importancia de la documentación para mantener el código limpio y fácilmente mantenido.

Estas actividades están diseñadas para proporcionar a los estudiantes una comprensión práctica de cómo usar métodos GET y POST en PHP, así como mejorar sus habilidades en diseño web básico.


<a id="recuperacion-de-emails-con-imap"></a>
## recuperacion de emails con imap

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/008-Programacion%20en%20entorno%20servidor/004-recuperacion%20de%20emails%20con%20imap)

### Introducción a los ejercicios

Tu código PHP y HTML parece estar bien estructurado y funcional, pero hay algunos aspectos que podrían mejorarse para mejorar la legibilidad, el mantenimiento y la eficiencia del código. Aquí te presento algunas sugerencias:

1. **Divide en Funciones**: Separa las partes de tu script en funciones o métodos para mantenerlo limpio y modular.
2. **Variables de Configuración**: Usa variables de configuración para valores que pueden cambiar, como los límites del bucle o el número máximo de correos a mostrar.
3. **Seguridad**: Asegúrate de manejar las excepciones y errores adecuadamente, especialmente cuando se trabaja con bases de datos u otras conexiones externas.
4. **Uso de Variables Estáticas**: Algunas variables como `$_SERVER['REQUEST_URI']` pueden ser usadas de manera más eficiente en contextos estáticos.

Aquí tienes un ejemplo basado en estas recomendaciones:

```php
<?php

function getOverviewList($inbox, $emailNumber) {
    return imap_fetch_overview($inbox, $emailNumber, 0);
}

function extractEmailDetails($overview) {
    $subject = isset($overview->subject) ? imap_utf8($overview->subject) : '(Sin asunto)';
    $from = isset($overview->from) ? imap_utf8($overview->from) : '(Desconocido)';
    $date = isset($overview->date) ? $overview->date : '';
    
    return [
        'subject' => htmlspecialchars($subject, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'),
        'from' => htmlspecialchars($from, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'),
        'date' => htmlspecialchars($date, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')
    ];
}

function extractEmailParts($inbox, $emailNumber) {
    return extractEmailParts($inbox, $email_number);
}

// Configuración
$limit = 15;

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Blog de Jose Vicente Carratala Sanchis</title>
<link rel="stylesheet" href="estilos.css">
</head>

<body>
<div class="layout">
    <header class="site-header">
        <!-- Tu código para el encabezado -->
    </header>

<?php if ($isDetail): ?>
    <a href="<?php echo strtok($_SERVER['REQUEST_URI'], '?'); ?>" class="back-link">← Volver al listado</a>
<?php endif; ?>

<section class="posts">
<?php
$emails = [/* Aquí obtienes los correos */];

if (!empty($emails)) {
    if (!$isDetail) {
        rsort($emails);
        $emails = array_slice($emails, 0, $limit);
    }

    foreach ($emails as $email_number) {
        $overviewList = getOverviewList($inbox, $email_number);
        $overview = $overviewList[0] ?? null;

        if (!$overview) continue;

        $details = extractEmailDetails($overview);
        
        // Obtener partes del correo
        $parts = extractEmailParts($inbox, $email_number);
        $bodyFullHtml = $parts['html'] ?? $parts['text'] ?? '<em>Sin contenido legible.</em>';
        $image = $parts['image'];

        if ($isDetail) {
            $bodyToShow = $bodyFullHtml;
        } else {
            $excerptText = makeExcerpt($bodyFullHtml, EXCERPT_LENGTH);
            $bodyToShow  = '<p>' . htmlspecialchars($excerptText, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</p>';
        }

        $detailUrl = strtok($_SERVER['REQUEST_URI'], '?') . '?id=' . (int)$email_number;
?>

<article class="post">
    <?php if ($image): ?>
        <div class="post-hero">
            <img src="<?php echo $image['dataUri']; ?>" alt="<?php echo htmlspecialchars($image['filename'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>">
        </div>
    <?php endif; ?>

    <div class="post-content">
        <header class="post-header">
            <h2 class="post-title">
                <a href="<?php echo $detailUrl; ?>"><?php echo $details['subject']; ?></a>
            </h2>
            <div class="post-meta">
                <span>De: <?php echo $details['from']; ?></span>
                <?php if ($details['date']): ?>
                    <span><?php echo $details['date']; ?></span>
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

### Notas:
- **Funciones**: Se crearon funciones `getOverviewList`, `extractEmailDetails` y `extractEmailParts`.
- **Configuración**: Los límites y otros valores configurables se definen al principio del script.
- **Seguridad**: Usa siempre funciones como `htmlspecialchars` para prevenir inyecciones de código malicioso.

Estas mejoras harán que tu código sea más modular, mantenible y legible.

### leercorreos
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es una página PHP que recupera y muestra los correos electrónicos del servidor IMAP utilizando la biblioteca `imap` integrada en PHP. El objetivo principal es acceder a la bandeja de entrada, leer el contenido de cada correo y mostrarlo en un formato legible para los usuarios web.

La configuración inicial establece las credenciales necesarias para conectarse al servidor IMAP (en este caso, Ionos) y se proporcionan funciones que ayudan a decodificar y manejar diferentes partes del correo electrónico. La función `decodePart` se encarga de descomprimir el contenido del correo si está codificado en base64 o formato quoted-printable.

La función `getHtmlBody` es crucial ya que recorre la estructura jerárquica de un correo (que puede ser simple o compuesto por varias partes) para encontrar y devolver la parte HTML o, como alternativa, el texto plano convertido a HTML básico. Esta función también maneja correos con contenido multipart que pueden contener múltiples subpartes.

Una vez establecida la conexión IMAP y recuperados los correos electrónicos, el código PHP genera una página web simple con un diseño CSS básico para mostrar cada correo en bloques separados. Cada bloque incluye información sobre el remitente, el asunto del correo y la fecha de recepción, además del cuerpo del mensaje que se muestra en formato HTML si está disponible.

Esta implementación es especialmente útil para desarrolladores web que necesitan integrar funcionalidades de correo electrónico en sus aplicaciones o sitios web. Permite a los usuarios ver fácilmente sus correos desde una interfaz web sin necesidad de usar un cliente de correo tradicional, y proporciona una base sólida para construir características más complejas como la respuesta a correos electrónicos o el manejo de diferentes formatos de email.

`002-leercorreos.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es una página PHP que utiliza el protocolo IMAP para recuperar y mostrar correos electrónicos en un formato similar a las entradas de un blog. Aquí están los puntos clave:

1. **Configuración de la conexión IMAP**: Se especifican detalles como el servidor IMAP, el nombre de usuario y la contraseña para conectarse al correo electrónico.

2. **Decodificación del contenido**: La función `decodePart` se encarga de decodificar las partes del correo electrónico basado en su tipo de codificación (como BASE64 o QUOTED-PRINTABLE).

3. **Extracción de partes del email**: Las funciones `extractEmailParts` y `traverseParts` trabajan juntas para recopilar el cuerpo HTML, texto plano e imágenes destacadas desde un correo electrónico estructurado en MIME multipart.

4. **Conexión a IMAP y lectura de correos**: La página se conecta al servidor IMAP y busca todos los correos electrónicos utilizando la función `imap_search`. Luego, para cada correo encontrado, extrae información básica como el remitente, fecha y asunto, además del contenido HTML o texto y las imágenes destacadas.

5. **Visualización en un formato de blog**: La página genera una salida HTML que muestra los correos electrónicos recuperados en forma de entradas de blog con títulos, metadatos (como la fecha y el remitente) y el cuerpo del correo, incluyendo imágenes destacadas.

Esta implementación es útil para aquellos que desean visualizar su bandeja de entrada como un blog personal o para crear aplicaciones web que permitan revisar correos electrónicos en una interfaz más amigable y estilizada.

`003-correos como blog.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es un ejemplo avanzado de cómo recuperar y presentar correos electrónicos utilizando el protocolo IMAP en PHP. El objetivo principal del código es leer los correos desde una bandeja de entrada (en este caso, Gmail), procesar su contenido y mostrarlos como entradas de blog.

**Configuración e Inicio:**
El código inicia definiendo las credenciales para conectarse al servidor IMAP y establece la longitud máxima del resumen del correo. Luego, se define una función llamada `decodePart` que decodifica el contenido del correo basándose en su tipo de codificación (BASE64 o QUOTED-PRINTABLE). Esto es importante porque los correos electrónicos pueden contener partes codificadas.

**Funciones Principales:**
1. **extractEmailParts:** Esta función extrae las partes principales de un correo, incluyendo el cuerpo HTML o texto y la primera imagen encontrada en el correo. Utiliza recursividad para manejar emails multipartes que tienen varias secciones (por ejemplo, cabecera, cuerpo del mensaje, adjuntos).
   
2. **traverseParts:** Esta función es una subrutina que recorre las partes de un correo multiparte, permitiendo extraer contenido HTML o texto y cualquier imagen destacada.

3. **makeExcerpt:** Genera una breve muestra (excerpt) del cuerpo completo del correo para mostrar en la vista previa de los correos, antes de abrir el correo detalladamente.

**Presentación:**
El código construye un documento HTML dinámico que representa cada correo como una entrada de blog. En esta representación:
- Los correos recientes se muestran primero.
- Cada correo incluye detalles como asunto, remitente y fecha.
- Se muestra la imagen destacada del correo (si existe).
- El contenido del correo es truncado en un resumen para los correos de vista previa. Si el usuario hace clic en "Leer más", se muestra todo el texto o HTML del cuerpo del correo.

El resultado final es una página web interactiva que permite a los usuarios navegar por sus correos electrónicos y leerlos como si fueran entradas de un blog, facilitando la visualización y lectura de mensajes. Este código demuestra cómo integrar servicios IMAP en sitios web para proporcionar funcionalidades avanzadas de correo electrónico.

`004-leer correos con mejoras.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este archivo PHP es un ejemplo de cómo recuperar y visualizar correos electrónicos en un entorno web utilizando la biblioteca IMAP. El código se encarga de conectarse a un servidor IMAP, buscar correos electrónicos y mostrar información relevante como el remitente, asunto y cuerpo del correo.

El archivo comienza definiendo configuraciones para conectar al servidor IMAP, especificando host, nombre de usuario y contraseña. Luego, se declaran algunas funciones auxiliares que son cruciales para extraer y procesar las partes del correo electrónico:

1. **decodePart**: Esta función decodifica el contenido del correo según su tipo de codificación (BASE64 o QUOTED-PRINTABLE).
2. **extractEmailParts**: Recupera el cuerpo HTML o texto plano del correo, así como la primera imagen encontrada en él. Esto es útil para mostrar una vista previa del correo.
3. **makeExcerpt**: Genera un resumen (excerpt) del contenido del correo electrónico basándose en su longitud máxima definida.

Después de establecer la conexión IMAP y verificar que se pueda hacerlo, el código verifica si se ha proporcionado un ID de correo específico a través de la URL. Si no hay un ID especificado, busca todos los correos electrónicos y crea una lista resumida de ellos en la página web. Si se proporciona un ID, muestra el correo completo correspondiente.

La parte del código PHP dentro del bloque HTML genera dinámicamente las etiquetas HTML necesarias para mostrar cada correo electrónico en una vista previa o completa según corresponda. Incluye detalles como el remitente, fecha y asunto del correo, junto con un resumen del contenido (solo en la vista de lista) o el cuerpo completo (en la vista detallada).

Este código es una excelente introducción al uso de IMAP para interactuar con servidores de correo desde aplicaciones web, mostrando cómo extraer datos relevantes y presentarlos visualmente. Específicamente, muestra cómo manejar diferentes partes del contenido del email como HTML, texto plano o imágenes, proporcionando un ejemplo práctico de cómo integrarse con servicios de correo electrónico en aplicaciones web. 

Finalmente, el archivo cierra la conexión IMAP después de procesar los correos electrónicos y genera una página web que muestra información relevante sobre cada correo electrónico en formato HTML. Si no se encuentran correos para mostrar, el script simplemente muestra un mensaje indicando que no hay correos disponibles. Esto asegura una interacción limpia y funcional con el usuario.

`005-personalizar.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este fragmento de código es una página PHP que permite recuperar y visualizar correos electrónicos desde un servidor IMAP utilizando la biblioteca `IMAP` de PHP. La página está diseñada para funcionar en dispositivos móviles y presenta los correos de manera estructurada, mostrando resúmenes (excerpts) en la vista general y el contenido completo en una vista detallada.

### Configuración e Inicio
El código comienza con la configuración del servidor IMAP, incluyendo las credenciales de acceso. Se define también una constante `EXCERPT_LENGTH` que determina la longitud máxima del resumen (excerpt) para cada correo en la vista general. A continuación, se definen varias funciones importantes:
- **decodePart**: Decodifica el contenido del correo según el encoding especificado.
- **extractEmailParts**: Extrae el cuerpo HTML/texto y cualquier imagen destacada del correo.
- **makeExcerpt**: Crea un resumen (excerpt) a partir de una parte del cuerpo del correo.

### Conexión e Interacción
La página se conecta al servidor IMAP con las credenciales proporcionadas. Si la URL incluye el parámetro `id`, muestra la vista detallada del correo correspondiente; en caso contrario, lista los últimos 15 correos disponibles. Para cada correo, extrae el asunto, remitente y fecha. Utiliza la función `extractEmailParts` para obtener el contenido HTML/texto completo y cualquier imagen destacada asociada al correo.

### Visualización
El diseño de la página utiliza CSS in-line para proporcionar una estructura visual atractiva:
- La sección principal del sitio muestra un título y subtítulo.
- En la vista general, cada correo se presenta como un artículo con información del remitente, fecha y un resumen (excerpt) del cuerpo. Si hay imágenes en el correo, estas son mostradas junto al resumen.
- En la vista detallada, se muestran todos los detalles del correo incluyendo contenido completo y cualquier imagen destacada.

### Uso de Funciones
Las funciones clave utilizadas dentro del código facilitan la manipulación de los datos obtenidos desde el servidor IMAP:
- `extractEmailParts`: Extrae las partes relevantes del correo electrónico.
- `makeExcerpt`: Crea un resumen corto a partir del cuerpo completo del correo.

### Finalización
El script cierra la conexión con el servidor IMAP una vez que ha completado todas las operaciones necesarias. Este diseño asegura que los correos electrónicos puedan ser visualizados de manera estilizada y fácilmente accesible en dispositivos móviles, proporcionando tanto resúmenes como vistas detalladas según sea necesario. 

En resumen, este código es una implementación funcional y bien estructurada para la recuperación y visualización de correos electrónicos desde un servidor IMAP en formato móvil. Se asegura de proporcionar una interfaz amigable que facilita a los usuarios navegar entre múltiples mensajes y explorar el contenido detallado de cada uno.

`006-version movil.php`

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
<small>Creado: 2026-04-20 18:32</small>

#### Explicación

Este código PHP es un script que permite recuperar y visualizar correos electrónicos almacenados en un servidor de correo utilizando la biblioteca IMAP. El objetivo principal del script es mostrar una lista de resúmenes de correos o, si se proporciona un ID específico, mostrar el contenido detallado de un correo individual.

### Estructura General
1. **Configuración y Conexión**: 
   - Establece la conexión con el servidor IMAP.
   - Recupera una lista de correos electrónicos utilizando funciones como `imap_fetch_overview()` para obtener detalles básicos del correo (de, asunto, fecha).

2. **Procesamiento de Correos**:
   - Si se proporciona un ID de correo específico en la URL, muestra el contenido detallado del correo.
   - Si no se proporciona un ID, muestra una lista resumida de los últimos correos.

3. **Visualización**:
   - Crea un diseño HTML que presenta los correos en formato de tarjetas (cards).
   - Incluye información como el remitente, asunto y fecha del correo.
   - Muestra una imagen adjunta si existe y un resumen o cuerpo completo del correo.

### Funcionalidades Específicas
- **Recuperación de Información**:
  - Utiliza funciones IMAP para obtener datos básicos sobre los correos (asunto, remitente, fecha).
  - Recupera el contenido HTML del correo y cualquier imagen adjunta utilizando la función `extractEmailParts()`.

- **Resumen vs Detalle**:
  - Si se proporciona un ID de correo en la URL (`?id=<numero>`), muestra todos los detalles del correo.
  - De lo contrario, muestra una lista resumida de correos con un extracto (resumen) del cuerpo del correo.

- **HTML y Estilo**:
  - Utiliza CSS para proporcionar un diseño atractivo y funcional. Incluye estilos para título, subtítulo, tarjetas de correo, etc.
  - Permite navegar entre la lista resumida y los detalles de cada correo mediante enlaces.

### Detalles del Código
- **Conexión IMAP**:
  ```php
  $inbox = imap_open("{imap.example.com:993/imap/ssl}INBOX", 'usuario', 'contraseña');
  ```

- **Obtener Resumen y Contenido**:
  ```php
  $overviewList = imap_fetch_overview($inbox, $email_number, 0);
  $parts = extractEmailParts($inbox, $email_number);
  ```

- **Generación de HTML**:
  ```html
  <article class="post">
    <!-- Imagen -->
    <?php if ($image): ?>
      <div class="post-hero">
        <img src="<?php echo $image['dataUri']; ?>"
             alt="<?php echo htmlspecialchars($image['filename'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>">
      </div>
    <?php endif; ?>

    <!-- Contenido del correo -->
    <div class="post-content">
      <header class="post-header">
        <h2 class="post-title">
          <a href="<?php echo $detailUrl; ?>"><?php echo htmlspecialchars($subject, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></a>
        </h2>
        <!-- Meta información -->
        <div class="post-meta">
          De: <?php echo htmlspecialchars($from, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>
          <?php if ($date): ?><span><?php echo htmlspecialchars($date, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span><?php endif; ?>
        </div>
      </header>

      <div class="post-body">
        <?php echo $bodyToShow; ?>
      </div>
    </div>
  </article>
  ```

### Integración y Extensibilidad
El código es modular, permitiendo fácil integración de nuevas funciones o mejoras en el futuro. Por ejemplo:
- Puedes agregar más campos a la visualización del correo.
- Implementar paginación para manejar grandes listas de correos.

En resumen, este script proporciona una interfaz web simple y funcional para recuperar y visualizar correos electrónicos utilizando IMAP en PHP.

`007-vinculos.php`

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

### Actividades propuestas

El código que proporcionaste es un sitio web dinámico en PHP que utiliza la biblioteca IMAP para conectar a una cuenta de correo electrónico y mostrar los correos electrónicos como publicaciones. Aquí te explico cómo funciona el código:

1. **Conexión al Servidor IMAP**: 
   - La conexión se realiza con `imap_open()`, donde se especifica la dirección del servidor, el nombre de usuario, la contraseña, y las banderas (por ejemplo, `{mail.example.com:993/ssl/novalidate-cert}`).

2. **Obtención de Datos Básicos**:
   - Usa `imap_fetch_overview()` para obtener información básica de los correos electrónicos como el asunto, remitente, fecha, etc.
   
3. **Procesamiento del Contenido del Correo Electrónico**:
   - La función `extractEmailParts()` es crucial aquí. Esta función extrae partes específicas del correo electrónico, incluyendo texto plano y HTML.
   - Se utiliza para obtener el contenido completo del cuerpo del email (`$bodyFullHtml`) y cualquier imagen adjunta (`$image`).

4. **Generación de Contenido HTML**:
   - Dependiendo de si se está en la página principal o en la vista detallada, se genera una representación diferente del correo electrónico.
   - En la página principal, solo se muestra un resumen (excerpt) del contenido y, opcionalmente, imágenes adjuntas.
   - En la vista detallada, se muestran todos los detalles del correo incluyendo el cuerpo completo.

5. **Estilo CSS**:
   - El código CSS define el estilo visual de las publicaciones y otros elementos del sitio web. Esto incluye márgenes, colores, tipografía, entre otros aspectos.
   
6. **Navegación y Lógica de Página Detallada**:
   - Si la URL contiene un parámetro `id`, el sistema muestra una vista detallada para ese correo específico.
   - En la página principal, se muestran las 15 últimas publicaciones ordenadas por fecha.

7. **Integración con Redes Sociales**:
   - La parte superior de la página incluye enlaces a redes sociales del autor/propietario del sitio web.

8. **Manejo de Errores y Datos Vacíos**:
   - El código maneja datos nulos o vacíos (por ejemplo, correos sin asunto o remitente) proporcionando un mensaje por defecto cuando no hay información disponible.
   
### Mejoras Potenciales:

1. **Seguridad**: 
   - Asegúrate de que las contraseñas y credenciales estén almacenadas de manera segura fuera del código fuente, utilizando variables de entorno o archivos .env.

2. **Desempeño**:
   - Considera la implementación de una caché para evitar conectarse a IMAP cada vez que se carga la página principal.
   
3. **Interactividad**:
   - Añade funcionalidades interactivas, como botones de favoritos o respuesta directa desde el sitio web.

4. **SEO y Accesibilidad**:
   - Mejora las etiquetas meta para mejorar los resultados en motores de búsqueda.
   - Asegúrate de que el contenido sea accesible para personas con discapacidad (por ejemplo, añadir texto alternativo para imágenes).

5. **Integración con Autenticación y Autorización**:
   - Si se permite a otros usuarios enviar correos o crear publicaciones en este sitio, considera la implementación de autenticación (OAuth2, JWT) para asegurar que solo los usuarios autorizados puedan interactuar con el sistema.

6. **Mantenimiento y Mejora Continua**: 
   - Mantén las bibliotecas y dependencias actualizadas.
   - Añade pruebas unitarias para detectar posibles errores en nuevas versiones o cambios de código.

Este diseño proporciona una base sólida para un sitio web personalizado que mantiene a los usuarios informados sobre los últimos correos electrónicos.


<a id="html-como-pug"></a>
## html como pug

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/008-Programacion%20en%20entorno%20servidor/005-html%20como%20pug)


<a id="creacion-de-panel-de-administracion"></a>
## creacion de panel de administracion

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/008-Programacion%20en%20entorno%20servidor/006-creacion%20de%20panel%20de%20administracion)



<a id="actividad-libre-de-final-de-evaluacion-la-milla-extra"></a>
# Actividad libre de final de evaluación - La milla extra

<a id="la-milla-extra-primera-evaluacion"></a>
## La Milla Extra - Primera evaluación

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/201-Actividad%20libre%20de%20final%20de%20evaluaci%C3%B3n%20-%20La%20milla%20extra/001-La%20Milla%20Extra%20-%20Primera%20evaluaci%C3%B3n)

### Introducción a los ejercicios

El archivo "ejercicio.md" en esta carpeta contiene una actividad libre diseñada para estudiantes del primer curso del ciclo formativo DAM (Desarrollo de Aplicaciones Multiplataforma). Este ejercicio tiene como objetivo permitirte aplicar tus conocimientos sobre entornos de desarrollo y buenas prácticas de programación que has adquirido durante el trimestre. Se enfoca en reforzar competencias esenciales como la gestión de proyectos, la estructuración del código y la resolución de problemas complejos utilizando los lenguajes y herramientas aprendidas hasta la fecha.

### Actividades propuestas

Basándome en la información proporcionada y suponiendo que los ejercicios dentro del archivo `ejercicio.md` están relacionados con conceptos básicos de programación, diseño de algoritmos y posiblemente manejo básico de estructuras de datos (ya que no se especifica el lenguaje ni contenido exacto), aquí propongo algunas actividades para estudiantes de ciclos formativos:

1. **Actividad: Diseño de un Algoritmo Simple**
   - **Descripción:** Los alumnos deben diseñar y documentar en pseudocódigo un algoritmo sencillo que resuelva un problema específico, como calcular el área de diferentes figuras geométricas o procesar una lista de datos. Se espera que aprendan a estructurar soluciones lógicas y a entender la importancia del flujo de control.

2. **Actividad: Análisis de Algoritmos**
   - **Descripción:** Los estudiantes deben analizar al menos tres ejemplos de algoritmos dados en el ejercicio.md para identificar su complejidad temporal y espacial, explicando cómo podría optimizarse cada uno si fuera necesario. Esto les ayudará a entender la importancia del rendimiento en el diseño de software.

3. **Actividad: Programación Orientada a Objetos**
   - **Descripción:** A partir de un ejemplo de algoritmo dado en ejercicios, los estudiantes deben reescribirlo utilizando conceptos básicos de programación orientada a objetos (POO), como clases y métodos. Esto les permitirá entender cómo organizar el código para proyectos más grandes.

4. **Actividad: Resolución de Problemas**
   - **Descripción:** Los alumnos tendrán que tomar un problema complejo, dividirlo en subproblemas manejables e implementar una solución paso a paso. Se espera que aprendan la importancia de abordar problemas grandes como sumas de pequeñas partes.

5. **Actividad: Pruebas Unitarias**
   - **Descripción:** A partir del código proporcionado, los estudiantes deberán escribir pruebas unitarias para comprobar el correcto funcionamiento del mismo y buscar posibles errores no cubiertos por las pruebas originales. Esto les enseñará la importancia de la codificación segura.

6. **Actividad: Documentación Mejorada**
   - **Descripción:** Los estudiantes deben mejorar la documentación existente en el ejercicio.md, añadiendo comentarios al código y redactando una guía paso a paso para su uso por parte de otros desarrolladores. Esto les enseñará cómo comunicarse efectivamente con otras personas mediante la codificación.

7. **Actividad: Optimización del Código**
   - **Descripción:** Los alumnos tienen que identificar partes del algoritmo proporcionado que puedan ser optimizadas y proponer mejoras que mejoren su rendimiento sin comprometer su legibilidad o correcto funcionamiento.

8. **Actividad: Manejo de Errores (Excepciones)**
   - **Descripción:** Los estudiantes deben identificar posibles fuentes de errores en el código del ejercicio y escribir bloques try-except para manejar estos casos especiales, mejorando así la robustez del programa.

Estas actividades están diseñadas para ayudar a los estudiantes a profundizar en conceptos clave como algoritmos, programación orientada a objetos, pruebas de software y diseño eficiente.


<a id="la-milla-extra-segunda-evaluacion"></a>
## La Milla Extra - Segunda evaluación

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/201-Actividad%20libre%20de%20final%20de%20evaluaci%C3%B3n%20-%20La%20milla%20extra/002-La%20Milla%20Extra%20-%20Segunda%20evaluaci%C3%B3n)



<a id="actividades-de-final-de-unidad-segundo-trimestre"></a>
# Actividades de final de unidad segundo trimestre

<a id="panel-de-administracion-para-proyecto-juguetes"></a>
## Panel de administración para proyecto juguetes

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/202-Actividades%20de%20final%20de%20unidad%20segundo%20trimestre/001-Panel%20de%20administraci%C3%B3n%20para%20proyecto%20juguetes)


<a id="html-como-pug-1"></a>
## HTML como pug

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/202-Actividades%20de%20final%20de%20unidad%20segundo%20trimestre/002-HTML%20como%20pug)


<a id="recuperacion-de-emails-con-imap-1"></a>
## Recuperación de emails con IMAP

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/202-Actividades%20de%20final%20de%20unidad%20segundo%20trimestre/003-Recuperaci%C3%B3n%20de%20emails%20con%20IMAP)


<a id="panel-de-control-con-get-y-post"></a>
## Panel de control con GET y POST

[📁 Ver carpeta en GitHub](https://github.com/jocarsa/dam2526/tree/main/Primero/Entornos%20de%20desarrollo/202-Actividades%20de%20final%20de%20unidad%20segundo%20trimestre/004-Panel%20de%20control%20con%20GET%20y%20POST)
