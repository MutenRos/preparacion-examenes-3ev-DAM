# Lenguajes de marcas y sistemas de gestión de información

**Author:** Jose Vicente Carratala Sanchis

## Table of contents

- [Reconocimiento de las características de lenguajes de marcas](#reconocimiento-de-las-caracteristicas-de-lenguajes-de-marcas)
  - [Clasificación](#clasificacion)
  - [Características y ámbitos de aplicación](#caracteristicas-y-ambitos-de-aplicacion)
  - [Estructura y sintaxis](#estructura-y-sintaxis)
  - [Herramientas de edición](#herramientas-de-edicion)
  - [Elaboración de documentos bien formados](#elaboracion-de-documentos-bien-formados)
  - [Utilización de espacios de nombres](#utilizacion-de-espacios-de-nombres)
  - [Ejercicio práctico](#ejercicio-practico)
  - [Curriculum](#curriculum)
  - [Ejercicio de final de unidad](#ejercicio-de-final-de-unidad)
- [Utilización de lenguajes de marcas en entornos web](#utilizacion-de-lenguajes-de-marcas-en-entornos-web)
  - [Estándares web. Versiones. Clasificación](#estandares-web-versiones-clasificacion)
  - [Estructura de un documento HTML](#estructura-de-un-documento-html)
  - [Identificación de etiquetas y atributos de HTML](#identificacion-de-etiquetas-y-atributos-de-html)
  - [Herramientas de diseño web](#herramientas-de-diseno-web)
  - [Hojas de estilo (CSS)](#hojas-de-estilo-css)
  - [Validación de documentos HTML y CSS](#validacion-de-documentos-html-y-css)
  - [Lenguajes de marcas para la sindicación de contenidos](#lenguajes-de-marcas-para-la-sindicacion-de-contenidos)
  - [Ejercicio curriculum](#ejercicio-curriculum)
  - [Simulacro examen 1](#simulacro-examen-1)
  - [Ejercicio de final de unidad](#ejercicio-de-final-de-unidad-1)
- [Manipulación de documentos Web](#manipulacion-de-documentos-web)
  - [Lenguajes de script de cliente. Características y sintaxis básica. Estándares](#lenguajes-de-script-de-cliente-caracteristicas-y-sintaxis-basica-estandares)
  - [Selección y acceso a elementos](#seleccion-y-acceso-a-elementos)
  - [Creación y modificación de elementos](#creacion-y-modificacion-de-elementos)
  - [Eliminación de elementos](#eliminacion-de-elementos)
  - [Manipulación de estilos](#manipulacion-de-estilos)
  - [Curriculum](#curriculum-1)
  - [Portafolio](#portafolio)
  - [Simulacro de examen](#simulacro-de-examen)
  - [Ejercicio de final de unidad](#ejercicio-de-final-de-unidad-2)
  - [Examen final](#examen-final)
- [Definición de esquemas y vocabularios en lenguajes de marcas](#definicion-de-esquemas-y-vocabularios-en-lenguajes-de-marcas)
  - [Tecnologías para la definición de documentos. Estructura y sintaxis](#tecnologias-para-la-definicion-de-documentos-estructura-y-sintaxis)
  - [Creación de descripciones de documentos](#creacion-de-descripciones-de-documentos)
  - [Asociación de descripciones con documentos. Validación](#asociacion-de-descripciones-con-documentos-validacion)
  - [Herramientas de creación y validación](#herramientas-de-creacion-y-validacion)
- [Conversión y adaptación de documentos para el intercambio de información](#conversion-y-adaptacion-de-documentos-para-el-intercambio-de-informacion)
  - [Tecnologías de transformación de documentos](#tecnologias-de-transformacion-de-documentos)
  - [Descripción de la estructura y de la sintaxis](#descripcion-de-la-estructura-y-de-la-sintaxis)
  - [Creación y utilización de plantillas. Herramientas y depuración](#creacion-y-utilizacion-de-plantillas-herramientas-y-depuracion)
  - [Conversión entre diferentes formatos de documentos](#conversion-entre-diferentes-formatos-de-documentos)
- [Almacenamiento de información](#almacenamiento-de-informacion)
  - [Sistemas de almacenamiento de información. Características. Tecnologías](#sistemas-de-almacenamiento-de-informacion-caracteristicas-tecnologias)
  - [Lenguajes de consulta y manipulación en documentos](#lenguajes-de-consulta-y-manipulacion-en-documentos)
  - [Consulta y manipulación de información](#consulta-y-manipulacion-de-informacion)
  - [Importación y exportación de bases de datos relacionales en diferentes formatos](#importacion-y-exportacion-de-bases-de-datos-relacionales-en-diferentes-formatos)
  - [Herramientas de tratamiento y almacenamiento de información en sistemas nativos](#herramientas-de-tratamiento-y-almacenamiento-de-informacion-en-sistemas-nativos)
  - [Almacenamiento y manipulación de información en sistemas nativos](#almacenamiento-y-manipulacion-de-informacion-en-sistemas-nativos)
- [Sistemas de gestión empresarial](#sistemas-de-gestion-empresarial)
  - [Aplicaciones de gestión empresarial. Tipos. Características](#aplicaciones-de-gestion-empresarial-tipos-caracteristicas)
  - [Instalación](#instalacion)
  - [Administración y configuración](#administracion-y-configuracion)
  - [Integración de módulos](#integracion-de-modulos)
  - [Mecanismos de acceso seguro a la información. Roles y privilegios](#mecanismos-de-acceso-seguro-a-la-informacion-roles-y-privilegios)
  - [Elaboración de informes](#elaboracion-de-informes)
  - [Exportación de información](#exportacion-de-informacion)
  - [Elaboración de documentación](#elaboracion-de-documentacion)
- [Envio de emails](#envio-de-emails)
  - [Formateo inicial](#formateo-inicial)
- [Actividad libre de final de evaluación - La milla extra](#actividad-libre-de-final-de-evaluacion-la-milla-extra)
  - [La Milla Extra - Primera evaluación](#la-milla-extra-primera-evaluacion)
- [Carpeta sin título](#carpeta-sin-titulo)

---

<a id="reconocimiento-de-las-caracteristicas-de-lenguajes-de-marcas"></a>
# Reconocimiento de las características de lenguajes de marcas

<a id="clasificacion"></a>
## Clasificación

La clasificación de los lenguajes de marcas es una herramienta fundamental para entender su naturaleza y aplicaciones. Los lenguajes de marcas pueden ser divididos en dos categorías principales: los lenguajes de marcado (markup languages) y los lenguajes de hoja de estilos (style sheets). El lenguaje de marcado se centra en la estructura y el contenido de una página web, mientras que los lenguajes de hoja de estilos se encargan de su presentación visual.

El primer grupo de lenguajes de marcas son los lenguajes de marcado. HTML (HyperText Markup Language) es el más conocido y ampliamente utilizado para crear páginas web. Su estructura básica consta de etiquetas que definen la semántica del contenido, como encabezados, párrafos, listas y enlaces. Otro lenguaje importante es XML (eXtensible Markup Language), que permite definir su propio conjunto de etiquetas para representar datos de manera estructurada.

Los lenguajes de hoja de estilos son utilizados para dar formato visual a los documentos HTML. CSS (Cascading Style Sheets) es el estándar más utilizado en este sentido, permitiendo controlar aspectos como colores, tipografías, márgenes y posiciones de elementos en la página. Otros lenguajes de hoja de estilos incluyen LESS y SASS, que ofrecen funcionalidades adicionales para facilitar el desarrollo de hojas de estilo complejas.

Además de estos dos grupos principales, existen otros tipos de lenguajes de marcas específicos para aplicaciones particulares. Por ejemplo, SVG (Scalable Vector Graphics) es un lenguaje de marcado diseñado para representar gráficos vectoriales y es especialmente útil en aplicaciones web que requieren interactividad visual.

La clasificación de los lenguajes de marcas no solo facilita su aprendizaje y uso, sino que también permite la creación de herramientas y frameworks especializados. Por ejemplo, existen bibliotecas y frameworks para el procesamiento de XML en diferentes lenguajes de programación, lo que amplía las posibilidades de trabajo con este tipo de documentos.

En conclusión, la clasificación de los lenguajes de marcas es una herramienta poderosa que nos permite entender su naturaleza y aplicaciones. Al conocer los tipos principales de lenguajes de marcado y hoja de estilos, así como sus características específicas, podemos desarrollar habilidades valiosas para el diseño y desarrollo web. Esta comprensión también nos prepara para explorar herramientas y frameworks más avanzados que facilitan la creación de aplicaciones web complejas y dinámicas.

### Encabezados

```markdown
# Esto es un encabezado de nivel 1

## Esto es un encabezado de nivel 2

### Esto es un encabezado de nivel 3
### Esto es un encabezado de nivel 3

#### Esto es un encabezado de nivel 4

##### Esto es un encabezado de nivel 5

###### Esto es un encabezado de nivel 6
```

### Parrafos y saltos de linea

```markdown
Esto es un contenido de parrafo.
Pero cuidado porque esto no es otro párrafo.

Esto es otro párrafo.

Esto es una línea.  
Esto es otra linea (he creado dos espacios)
```

### enfasis

```markdown
*Texto en cursiva*

**Texto en negrita**

***Negrita y cursiva***
```

### Listas no ordenadas

```markdown
- Este es un elemento
- Este es otro elemento
- Y este es un elemento más
```

### Listas ordenadas

```markdown
1. Este es un elemento
2. Este es otro elemento
3. Y este es un elemento más
```

### Hiperenlaces

```markdown
[Enlace a la web de JOCARSA](https://jocarsa.com)
```

### Imágenes

```markdown
![Logo de JOCARSA](https://static.jocarsa.com/logos/teal.png)
```

### Citas

```markdown
> Esto es una cita

>> Y esto es una cita anidada
```

### Codigo en linea

```markdown
En HTML existe la etiqueta `html` y sirve para declarar el documento
```

### bloque de codigo

```markdown
A continuación vamos a ver un bloque en Python:

```
  print("Hola mundo en Python")
```
```

### Separadores

```markdown
Esto es un texto

---

Esto es otro texto

---

Y esto es un texto mas
```

### Tablas

```markdown
| Columna 1 | Columna 2 |
|-----------|-----------|
| Dato 1    | Dato 2    |
| Dato 3    | Dato 4    |
| Dato 5    | Dato 6    |
```

### Documentación de un programa

```markdown
# jocarsa | teal

# Introducción

jocarsa | teal es una aplicación que se puede utilizar para crear aplicaciones interactivas de empresa.

Nos permite:
- Crear aplicaciones
- Crear paneles de control
- Controlar nuestros datos

# Requisitos del servidor

Para instalar esta aplicación, debemos:
1. Tener un servidor
2. Usar PHP
3. Usar MySQL

# Ejemplo de uso del programa

A continuación se muestra un ejemplo de uso

```
Este es un código de ejemplo en markdown
```
```

<a id="caracteristicas-y-ambitos-de-aplicacion"></a>
## Características y ámbitos de aplicación

En el vasto universo de la informática, los lenguajes de marcas desempeñan un papel crucial como herramientas para estructurar y presentar información de manera eficiente. Estos lenguajes son fundamentales en la creación de documentos electrónicos que pueden ser visualizados y procesados por computadoras, lo que abre las puertas a una comunicación digital más sofisticada.

La característica distintiva de los lenguajes de marcas radica en su capacidad para definir el contenido y la estructura de un documento sin necesidad de describir cómo debe verse. En lugar de eso, estos lenguajes utilizan etiquetas que indican el propósito del texto o la información que contiene. Esta separación entre contenido y presentación es una innovación fundamental que permite a los desarrolladores centrarse en lo que realmente importa: el mensaje que quieren transmitir.

Los lenguajes de marcas tienen un amplio espectro de aplicaciones, desde la creación de páginas web hasta la documentación técnica y la gestión de información empresarial. Su versatilidad se debe a su capacidad para adaptarse a diferentes contextos y plataformas. Por ejemplo, HTML (Hypertext Markup Language) es el lenguaje de marcas más conocido y ampliamente utilizado para crear páginas web, mientras que XML (eXtensible Markup Language) es ideal para la representación de datos estructurados.

Además de su uso en la creación de contenido digital, los lenguajes de marcas también juegan un papel crucial en el desarrollo de aplicaciones y sistemas informáticos. Por ejemplo, en la programación orientada a objetos, los lenguajes como Java utilizan clases y objetos para encapsular datos y comportamientos, lo que es una forma de estructurar información de manera similar a cómo se hace con los lenguajes de marcas.

La importancia de los lenguajes de marcas no se limita solo a su uso en la creación de contenido digital. También son fundamentales en el desarrollo de sistemas empresariales y de gestión de información, donde la precisión y la estructura de los datos son cruciales para la toma de decisiones informadas.

En resumen, los lenguajes de marcas son herramientas poderosas que permiten a los desarrolladores crear contenido digital de manera eficiente y estructurada. Su capacidad para separar el contenido del formato lo hace una innovación fundamental en la comunicación digital, con aplicaciones versátiles en diversos campos, desde la creación de páginas web hasta el desarrollo de sistemas empresariales.

### Crear webs con HTML

```html
<!doctype html>
<html>
  <head>
  </head>
  <body>
    <p>Esto es una página web</p>
  </body>
</html>
```

### crear documentos con XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<persona>
  <datospersonales>
    <nombre>Jose Vicente</nombre>
    <apellidos>Carratalá Sanchis</apellidos>
  </datospersonales>
  <formacion>
  </formacion>
</persona>
```

### Markdown para crear documentos

```markdown
# Esto es una cabera de nivel 1

## Esto es una cabecera de nivel 2

Esto es un texto plano

- Esto es un elemento de lista
- Y esto también lo es

--- 

```
  Y esto es un bloque de código
```
```

### CSS nos permite añadir estilo a HTML

```html
<!doctype html>
<html>
  <head>
    <style>
      p{color:red;}
    </style>
  </head>
  <body>
    <p>Esta es una página web</p>
  </body>
</html>
```

### JSON para guardar documentos

```json
{
  "nombre":"Jose Vicente",
  "apellidos":"Carratalá Sanchis",
  "correo":"info@jocarsa.com"
}
```

### json anidado

```json
{
  "datos personales":{
    "nombre":"Jose Vicente",
    "apellidos":"Carratalá Sanchis",
    "correo":"info@jocarsa.com"
  },
  "formacion":{
    "formacion1":"Descripcion",
    "formacion2":"Descripcion"
  }
}
```

### SVG para crear gráficos

```html
<svg 
  width="512" 
  height="512" 
  xmlns="http://www.w3.org/2000/svg"
  >
  <circle 
    cx="256" 
    cy="256" 
    r="100" 
    fill="red"
  />
</svg>
```

### Conclusiones que podemos extraer

```markdown
Los lenguajes de marcas contienen información

Existen diferentes lenguajes

Cada uno de ellos tiene unas reglas de sintaxis

No son muy complejos

Dado que los lenguajes de marcas son para documentos
Es común que la información se guarde en documentos

Los lenguajes de marcas nos ayudan a dos cosas:
1.-Guardar documentos
2.-Crear webs / crear interfaces web

Por ejemplo markdown nos sirve para documentos "tipo word"
XML y JSON nos sirven para documentos complejos y anidados
```

<a id="estructura-y-sintaxis"></a>
## Estructura y sintaxis

En el mundo digital de hoy, los lenguajes de marcas desempeñan un papel crucial como herramientas para la creación y manipulación de documentos estructurados. Estos lenguajes son fundamentales en la construcción de páginas web, aplicaciones empresariales y sistemas de gestión de información, proporcionando una forma precisa y eficiente de representar datos y contenido.

La estructura y sintaxis de los lenguajes de marcas son esenciales para su correcto uso. La estructura permite organizar el contenido en elementos jerárquicos que facilitan la lectura y procesamiento por parte de los navegadores web y otros sistemas informáticos. Por ejemplo, en HTML, las etiquetas `<div>`, `<p>` y `<ul>` definen diferentes tipos de secciones y listas, creando una arquitectura lógica para el contenido.

La sintaxis, por otro lado, es la forma en que los elementos del lenguaje son combinados para formar sentencias válidas. En HTML, esto implica cerrar las etiquetas correctamente con `</tag>`, usar atributos apropiadamente dentro de las etiquetas y seguir una estructura jerárquica. La sintaxis precisa es crucial para evitar errores que puedan causar problemas en la visualización o el funcionamiento del documento.

Además, los lenguajes de marcas suelen utilizar un conjunto específico de caracteres y símbolos que tienen significado predefinido dentro del contexto del lenguaje. Por ejemplo, en XML, el uso de `<`, `>`, `&` y otros caracteres especiales requiere la codificación adecuada para evitar conflictos con la sintaxis del propio lenguaje.

La comprensión de la estructura y sintaxis es fundamental para crear documentos bien formados que puedan ser interpretados correctamente por los sistemas informáticos. Un documento mal estructurado o sintácticamente incorrecto puede no renderizarse como se espera, causando problemas en la experiencia del usuario final.

Además, el uso de lenguajes de marcas con una buena estructura y sintaxis facilita la manipulación y procesamiento del contenido por parte de los sistemas informáticos. Por ejemplo, en bases de datos XML, la estructura jerárquica permite realizar consultas complejas y recuperar información de manera eficiente.

La evolución constante de los lenguajes de marcas ha permitido su adaptación a nuevas necesidades tecnológicas y formatos de contenido. Desde HTML hasta XML y más allá, cada versión introduce mejoras en la estructura y sintaxis para facilitar el trabajo con datos y documentos complejos.

En conclusión, la estructura y sintaxis de los lenguajes de marcas son elementos cruciales que determinan su capacidad para representar y procesar información de manera precisa. Una comprensión sólida de estas características es fundamental para crear documentos web y aplicaciones informáticas eficientes y funcionales.

### Que es XML

```markdown
XML es un lenguaje para almacenar documentos
No en el sentido de un documento de Word (para eso tendríamos markdown)
En el sentido de guardar información compleja, anidada, y estructurada
Es un lenguaje en el que podemos guardar y podemos leer documentos
Nos ayuda a almacenar información
```

### declaracion

```xml
<?xml version="1.0" encoding="UTF-8"?>
```

### etiquetas

```xml
<?xml version="1.0" encoding="UTF-8"?>
<persona>
</persona>
```

### etiquetas anidadas

```xml
<?xml version="1.0" encoding="UTF-8"?>
<persona>
  <nombre>Jose Vicente</nombre>
  <edad>47</edad>
  <profesion>Programador</profesion>
</persona>
```

### atributos

```xml
<?xml version="1.0" encoding="UTF-8"?>
<persona>
  <nombre id="propio">Jose Vicente</nombre>
  <nombre id="mote">JV</nombre>
  <edad medida="años">47</edad>
  <profesion>Programador</profesion>
</persona>
```

### comentarios

```xml
<?xml version="1.0" encoding="UTF-8"?>
<!-- En este documento voy a describir a un ser humano -->
<persona>
  <nombre id="propio">Jose Vicente</nombre>
  <nombre id="mote">JV</nombre>
  <edad medida="años">47</edad>
  <profesion>Programador</profesion>
</persona>
```

<a id="herramientas-de-edicion"></a>
## Herramientas de edición

En el mundo digital, los lenguajes de marcas desempeñan un papel crucial como herramientas para la creación y manipulación de documentos estructurados. Estos lenguajes son esenciales en el desarrollo web y la gestión de información, permitiendo a los desarrolladores crear contenido que no solo sea visualmente atractivo sino también funcional y accesible.

La carpeta `004-Herramientas de edición` del módulo `Reconocimiento de las características de lenguajes de marcas` se centra específicamente en las herramientas disponibles para la creación y modificación de documentos basados en lenguajes de marcas. Estas herramientas son fundamentales porque facilitan el trabajo con elementos como HTML, CSS y XML, permitiendo a los profesionales del desarrollo web crear páginas web y aplicaciones que sean eficientes y seguros.

La primera herramienta destacada es la **editorial gráfica**. Esta opción permite a los usuarios diseñar documentos de manera visual, utilizando una interfaz intuitiva donde se pueden arrastrar y soltar elementos como imágenes, texto y enlaces. Herramientas como Adobe Dreamweaver son excelentes ejemplos de este tipo de software, que ofrecen un entorno amigable para la creación de páginas web sin necesidad de conocimientos avanzados de código.

Otra herramienta es el **editor de texto**. Este tipo de software ofrece una mayor flexibilidad y control sobre el código fuente. Herramientas como Visual Studio Code son populares entre los desarrolladores debido a su capacidad para proporcionar autocompletado, resaltado de sintaxis y depuración en tiempo real. La ventaja de los editores de texto radica en la capacidad de personalizar el entorno de trabajo, lo que permite una mayor eficiencia en la codificación.

Además de las herramientas gráficas y de texto, existen **herramientas de edición basadas en lenguaje natural**. Estas herramientas utilizan tecnologías avanzadas para permitir a los usuarios crear contenido web utilizando un lenguaje más cercano al humano. Herramientas como Google Docs o Microsoft Word Online son ejemplos de este tipo de software, que ofrecen una interfaz familiar y facilitan la colaboración en proyectos de equipo.

La carpeta también aborda el uso de **espacios de nombres** en lenguajes de marcas. Los espacios de nombres son un mecanismo que permite evitar conflictos entre elementos con el mismo nombre en diferentes documentos o contextos. Herramientas como XMLSpy o Oxygen XML Editor proporcionan soporte avanzado para la gestión de espacios de nombres, facilitando el trabajo con documentos complejos y estructurados.

En conclusión, las herramientas de edición son esenciales para cualquier profesional que trabaje con lenguajes de marcas. Desde los editores gráficos hasta los basados en texto y tecnologías de lenguaje natural, cada una ofrece ventajas diferentes y se adapta a diversos niveles de experiencia y necesidades específicas. La elección de la herramienta adecuada depende del proyecto en curso, el nivel de conocimiento técnico del usuario y las preferencias personales en cuanto al estilo de trabajo.

### Introducción

```markdown
Las herramientas de edición no importan
Lo que quiero es que os centréis en el código
Porque el código es lo importante

Un programa de edición
IDE = Integrated Development Environment
Entorno de desarrollo

Para prácticamente todo, uso:
Gedit
https://gedit-text-editor.org/

-Ventana de proyecto
-Coloreado de código
-Alguna función como sangría automática

Si estáis en Windows:
Notepad++
https://notepad-plus-plus.org/downloads/

Visual Studio Code
https://code.visualstudio.com/
En mi opinión, tiene muchos "pitos y flautas"

Existen editores específicos del contexto
Python -> lleva el editor IDLE
```

<a id="elaboracion-de-documentos-bien-formados"></a>
## Elaboración de documentos bien formados

En el mundo digital actual, los lenguajes de marcas desempeñan un papel crucial como herramientas para la creación y manipulación de documentos estructurados. Estos lenguajes son fundamentales en el desarrollo web, la gestión de información y la comunicación entre sistemas informáticos.

La elaboración de documentos bien formados es una habilidad esencial que requiere comprensión profunda de las reglas sintácticas y semánticas de los lenguajes de marcas. Un documento bien formado no solo se refiere a su estructura jerárquica, sino también a la coherencia en el uso de etiquetas y atributos.

Para comenzar, es importante entender que los lenguajes de marcas son sistemas de codificación que utilizan etiquetas para definir elementos dentro del documento. Cada etiqueta tiene un propósito específico y debe usarse correctamente para garantizar que el contenido sea interpretado de manera correcta por los navegadores web o los programas que manejen estos documentos.

Un ejemplo claro es la estructura HTML, donde las etiquetas como `<html>`, `<head>` y `<body>` definen diferentes secciones del documento. Cada una de estas etiquetas tiene atributos adicionales que proporcionan información adicional sobre el contenido dentro de ellas. Por ejemplo, en un elemento `<img>`, el atributo `src` especifica la ubicación de la imagen.

La importancia de usar correctamente los lenguajes de marcas radica en su capacidad para transmitir información de manera estructurada y accesible. Un documento bien formado facilita la lectura y comprensión del contenido, tanto para humanos como para máquinas. Además, al seguir las convenciones establecidas por los lenguajes de marcas, se asegura que el contenido sea compatible con una amplia gama de plataformas y dispositivos.

Además de la estructura jerárquica, la coherencia en el uso de etiquetas es fundamental. Cada etiqueta debe abrirse y cerrarse correctamente para evitar errores de sintaxis. Por ejemplo, si se abre una etiqueta `<div>`, es crucial que se cierre con `</div>` para mantener la integridad del documento.

La utilización de espacios en blanco y saltos de línea también es importante para mejorar la legibilidad del código. Aunque los navegadores ignoran estos espacios, su presencia mejora significativamente la comprensión humana del código fuente.

En resumen, la elaboración de documentos bien formados es una práctica esencial en el uso de lenguajes de marcas. Requiere un conocimiento profundo de las reglas sintácticas y semánticas de los lenguajes, así como una atención meticulosa a la estructura jerárquica y la coherencia en el uso de etiquetas. Al seguir estas prácticas, se asegura que el contenido sea transmitido de manera efectiva y accesible, tanto para humanos como para máquinas.

La comprensión de estos conceptos es fundamental para cualquier profesional del campo de la programación o el desarrollo web. Al dominar la elaboración de documentos bien formados, se abre la puerta a una serie de habilidades más avanzadas, como la creación de interfaces de usuario, la manipulación de datos y la comunicación entre sistemas informáticos.

En conclusión, la importancia de la elaboración de documentos bien formados en lenguajes de marcas no puede ser subestimada. Es una práctica esencial que requiere dedicación y atención a los detalles, pero cuyo beneficio es inmenso para el desarrollo de aplicaciones y sistemas informáticos modernos.

### documento bien formado

```xml
<?xml version="1.0" encoding="UTF-8"?>
<!-- En este documento voy a describir a un ser humano -->
<persona>
  <nombre id="propio">Jose Vicente</nombre>
  <nombre id="mote">JV</nombre>
  <edad medida="años">47</edad>
  <profesion>Programador</profesion>
</persona>
```

### elemento que no esta bien formado

```xml
<?xml version="1.0" encoding="UTF-8"?>
<!-- En este documento voy a describir a un ser humano -->
<persona>
  <nombre id="propio">Jose Vicente</nombre>
  <nombre id="mote">JV</nombre>
  <edad medida="años">47</edad>
  <profesion>Programador</profesion>
</persona>

<persona>
  <nombre id="propio">Jose Vicente</nombre>
  <nombre id="mote">JV</nombre>
  <edad medida="años">47</edad>
  <profesion>Programador</profesion>
</persona>
 
```

### url del validador online

```markdown
https://www.liquid-technologies.com/online-xml-validator
```

### solucion con nodo raiz

```xml
<?xml version="1.0" encoding="UTF-8"?>
<!-- En este documento voy a describir a un ser humano -->
<personas>

  <persona>
    <nombre id="propio">Jose Vicente</nombre>
    <nombre id="mote">JV</nombre>
    <edad medida="años">47</edad>
    <profesion>Programador</profesion>
  </persona>
  
  <persona>
    <nombre id="propio">Jose Vicente</nombre>
    <nombre id="mote">JV</nombre>
    <edad medida="años">47</edad>
    <profesion>Programador</profesion>
  </persona>
  
</personas>
```

### persona con xsd

```xml
<?xml version="1.0" encoding="UTF-8"?>
<!-- En este documento voy a describir a un ser humano -->
<personas>

  <persona xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="006-validar xml.xsd">
    <nombre id="propio">Jose Vicente</nombre>
    <nombre id="mote">JV</nombre>
    <edad medida="años">47</edad>
    <profesion>Programador</profesion>
  </persona>
  
  <persona>
    <nombre id="propio">Jose Vicente</nombre>
    <nombre id="mote">JV</nombre>
    <edad medida="años">47</edad>
    <profesion>Programador</profesion>
  </persona>
  
</personas>
```

### validar xml

```
<?xml version="1.0" encoding="UTF-8"?>
<xs:schema xmlns:xs="http://www.w3.org/2001/XMLSchema">

  <xs:element name="persona">
    <xs:complexType>
      <xs:sequence>
        <xs:element name="nombre" type="xs:string"/>
        <xs:element name="edad" type="xs:integer"/>
      </xs:sequence>
    </xs:complexType>
  </xs:element>

</xs:schema>
```

<a id="utilizacion-de-espacios-de-nombres"></a>
## Utilización de espacios de nombres

En el vasto mundo de la informática, los lenguajes de marcas desempeñan un papel crucial como herramientas para estructurar y transmitir información de manera eficiente. Uno de los aspectos más importantes a considerar en estos lenguajes es su capacidad para utilizar espacios de nombres, una característica que añade una capa adicional de organización y evitar conflictos entre elementos.

Los espacios de nombres son un sistema que permite agrupar elementos relacionados bajo un nombre común. En el contexto de los lenguajes de marcas, esto significa que puedes tener múltiples elementos con el mismo nombre sin que se produzcan errores de identificación. Por ejemplo, en HTML, puedes tener varias etiquetas `<div>` dentro del mismo documento, y cada una puede ser referenciada por su espacio de nombres.

La utilización de espacios de nombres es especialmente relevante cuando trabajamos con lenguajes de marcas que son ampliamente utilizados para el desarrollo web. En HTML5, por ejemplo, se han introducido nuevos elementos como `<section>`, `<article>`, y `<header>`. Si no hubiera espacios de nombres, estos elementos podrían entrar en conflicto con otros que puedan tener el mismo nombre pero un significado diferente.

Además de evitar conflictos, los espacios de nombres también facilitan la organización del código. Al agrupar elementos relacionados bajo un espacio de nombres común, puedes mantener tu código más limpio y fácil de entender. Por ejemplo, en XML, puedes organizar tus elementos dentro de un espacio de nombres específico para una aplicación particular, lo que hace que el código sea más legible y manejable.

La implementación de espacios de nombres también es crucial cuando se trabaja con lenguajes de marcas que son utilizados en entornos complejos. En estos casos, los espacios de nombres te permiten mantener una jerarquía clara de elementos, lo que facilita la búsqueda y el acceso a cualquier elemento específico.

En resumen, la utilización de espacios de nombres es un aspecto fundamental de los lenguajes de marcas, ya que proporciona una forma eficiente de organizar y evitar conflictos entre elementos. Esta característica es especialmente relevante en entornos web y complejos, donde el código puede ser más largo y complicado. Al aprender a utilizar espacios de nombres, puedes mejorar la calidad y la mantenibilidad de tu código, lo que te permitirá trabajar con mayor eficiencia y precisión en tus proyectos informáticos.

### espacio de nombre persona

```xml
<?xml version="1.0" encoding="UTF-8"?>
<!-- En este documento voy a describir a un ser humano -->
<personas xmlns:per="https://jocarsa.com/personas">

  <per:persona>
    <per:nombre id="propio">Jose Vicente</per:nombre>
    <per:nombre id="mote">JV</per:nombre>
    <per:edad medida="años">47</per:edad>
    <per:profesion>Programador</per:profesion>
  </per:persona>
  
  <per:persona>
    <per:nombre id="propio">Jose Vicente</per:nombre>
    <per:nombre id="mote">JV</per:nombre>
    <per:edad medida="años">47</per:edad>
    <per:profesion>Programador</per:profesion>
  </per:persona>
  
</personas>
```

<a id="ejercicio-practico"></a>
## Ejercicio práctico

Una cosa muy importante que nos enseña esta asignatura es la separación de estructura, presentación y datos

HTML = Estructura
CSS = Presentación, estilo, apariencia
XML = Datos
Javascript = Comportamiento

### persona

```xml
<?xml version="1.0" encoding="UTF-8"?>
<!-- En este documento voy a describir a un ser humano -->
<persona>
  <nombre>Jose Vicente</nombre>
  <apellido1>Carratalá</apellido1>
  <apellido2>Sanchis</apellido2>
</persona>

  
```

### telefono

```xml
<?xml version="1.0" encoding="UTF-8"?>
<!-- En este documento voy a describir a un ser humano -->
<persona>
  <nombre>Jose Vicente</nombre>
  <apellido1>Carratalá</apellido1>
  <apellido2>Sanchis</apellido2>
  <telefono>620891718</telefono>
  <email>info@jocarsa.com</email>
</persona>

  
```

### varios telefonos

```xml
<?xml version="1.0" encoding="UTF-8"?>
<!-- En este documento voy a describir a un ser humano -->
<persona>
  <nombre>Jose Vicente</nombre>
  <apellido1>Carratalá</apellido1>
  <apellido2>Sanchis</apellido2>
  <telefonos>
    <movil>620891718</movil>
    <fijo>963778757</fijo>
  </telefonos>
  <emails>
    <empresa>info@jocarsa.com</empresa>
    <personal>info@josevicentecarratala.com</personal>
  </emails>
</persona>

  
```

### datos personales

```xml
<?xml version="1.0" encoding="UTF-8"?>
<!-- En este documento voy a describir a un ser humano -->
<persona>
  <datospersonales>
    <nombre>Jose Vicente</nombre>
    <apellido1>Carratalá</apellido1>
    <apellido2>Sanchis</apellido2>
    <telefonos>
      <movil>620891718</movil>
      <fijo>963778757</fijo>
    </telefonos>
    <emails>
      <empresa>info@jocarsa.com</empresa>
      <personal>info@josevicentecarratala.com</personal>
    </emails>
  </datospersonales>
  <experiencialaboral>
  
  </experiencialaboral>
  <formacion>
    
  </formacion>
</persona>

  
```

### experiencias

```xml
<?xml version="1.0" encoding="UTF-8"?>
<!-- En este documento voy a describir a un ser humano -->
<persona>
  <datospersonales>
    <nombre>Jose Vicente</nombre>
    <apellido1>Carratalá</apellido1>
    <apellido2>Sanchis</apellido2>
    <telefonos>
      <movil>620891718</movil>
      <fijo>963778757</fijo>
    </telefonos>
    <emails>
      <empresa>info@jocarsa.com</empresa>
      <personal>info@josevicentecarratala.com</personal>
    </emails>
  </datospersonales>
  <experiencialaboral>
    <experiencia>
      <nombreempresa>
        Empresa 1
      </nombreempresa>
      <fechadeinicio>XXXX-XX-XX</fechadeinicio>
      <fechadefinal>XXXX-XX-XX</fechadefinal>
      <descripcion>
        Aqui pondré una pequeña descripción del puesto de trabajo
      </descripcion>
    </experiencia>
  </experiencialaboral>
  <formacion>
    
  </formacion>
</persona>

  
```

### muchas experiencias

```xml
<?xml version="1.0" encoding="UTF-8"?>
<!-- En este documento voy a describir a un ser humano -->
<persona>
  <datospersonales>
    <nombre>Jose Vicente</nombre>
    <apellido1>Carratalá</apellido1>
    <apellido2>Sanchis</apellido2>
    <telefonos>
      <movil>620891718</movil>
      <fijo>963778757</fijo>
    </telefonos>
    <emails>
      <empresa>info@jocarsa.com</empresa>
      <personal>info@josevicentecarratala.com</personal>
    </emails>
  </datospersonales>
  <experiencialaboral>
    <experiencia>
      <nombreempresa>
        Empresa 1
      </nombreempresa>
      <fechadeinicio>XXXX-XX-XX</fechadeinicio>
      <fechadefinal>XXXX-XX-XX</fechadefinal>
      <descripcion>
        Aqui pondré una pequeña descripción del puesto de trabajo
      </descripcion>
      <logo>logo.jpg</logo>
    </experiencia>
    <experiencia>
      <nombreempresa>
        Empresa 1
      </nombreempresa>
      <fechadeinicio>XXXX-XX-XX</fechadeinicio>
      <fechadefinal>XXXX-XX-XX</fechadefinal>
      <descripcion>
        Aqui pondré una pequeña descripción del puesto de trabajo
      </descripcion>
      <logo>logo.jpg</logo>
    </experiencia>
    <experiencia>
      <nombreempresa>
        Empresa 1
      </nombreempresa>
      <fechadeinicio>XXXX-XX-XX</fechadeinicio>
      <fechadefinal>XXXX-XX-XX</fechadefinal>
      <descripcion>
        Aqui pondré una pequeña descripción del puesto de trabajo
      </descripcion>
      <logo>logo.jpg</logo>
    </experiencia>
  </experiencialaboral>
  <formacion>
    <titulo>
      <nombre>Título en XXXXXX</titulo>
      <fechadeinicio>XXXX-XX-XX</fechadeinicio>
      <fechadefinal>XXXX-XX-XX</fechadefinal>
      <institucion>Nombre de la institución</institucion>
      <descripcion>
        Aqui pondré una pequeña descripción del titulo obtenido
      </descripcion>
      <logo>logo.jpg</logo>
    </titulo>
  </formacion>
</persona>

  
```

### titulos

```xml
<?xml version="1.0" encoding="UTF-8"?>
<!-- En este documento voy a describir a un ser humano -->
<persona>
  <datospersonales>
    <nombre>Jose Vicente</nombre>
    <apellido1>Carratalá</apellido1>
    <apellido2>Sanchis</apellido2>
    <telefonos>
      <movil>620891718</movil>
      <fijo>963778757</fijo>
    </telefonos>
    <emails>
      <empresa>info@jocarsa.com</empresa>
      <personal>info@josevicentecarratala.com</personal>
    </emails>
    <redessociales>
      <red>
        <nombre>Facebook</nombre>
        <logo>facebook.jpg</logo>
        <url>httsp://facebook.com/carratala</url>
      </red>
      <red>
        <nombre>Facebook</nombre>
        <logo>facebook.jpg</logo>
        <url>httsp://facebook.com/carratala</url>
      </red>
      <red>
        <nombre>Facebook</nombre>
        <logo>facebook.jpg</logo>
        <url>httsp://facebook.com/carratala</url>
      </red>
      <red>
        <nombre>Facebook</nombre>
        <logo>facebook.jpg</logo>
        <url>httsp://facebook.com/carratala</url>
      </red>
    </redessociales>
  </datospersonales>
  <experiencialaboral>
    <experiencia>
      <nombreempresa>
        Empresa 1
      </nombreempresa>
      <fechadeinicio>XXXX-XX-XX</fechadeinicio>
      <fechadefinal>XXXX-XX-XX</fechadefinal>
      <descripcion>
        Aqui pondré una pequeña descripción del puesto de trabajo
      </descripcion>
      <logo>logo.jpg</logo>
    </experiencia>
    <experiencia>
      <nombreempresa>
        Empresa 1
      </nombreempresa>
      <fechadeinicio>XXXX-XX-XX</fechadeinicio>
      <fechadefinal>XXXX-XX-XX</fechadefinal>
      <descripcion>
        Aqui pondré una pequeña descripción del puesto de trabajo
      </descripcion>
      <logo>logo.jpg</logo>
    </experiencia>
    <experiencia>
      <nombreempresa>
        Empresa 1
      </nombreempresa>
      <fechadeinicio>XXXX-XX-XX</fechadeinicio>
      <fechadefinal>XXXX-XX-XX</fechadefinal>
      <descripcion>
        Aqui pondré una pequeña descripción del puesto de trabajo
      </descripcion>
      <logo>logo.jpg</logo>
    </experiencia>
  </experiencialaboral>
  <formacion>
    <titulo>
      <nombre>Título en XXXXXX</titulo>
      <fechadeinicio>XXXX-XX-XX</fechadeinicio>
      <fechadefinal>XXXX-XX-XX</fechadefinal>
      <institucion>Nombre de la institución</institucion>
      <descripcion>
        Aqui pondré una pequeña descripción del titulo obtenido
      </descripcion>
      <logo>logo.jpg</logo>
    </titulo>
    <titulo>
      <nombre>Título en XXXXXX</titulo>
      <fechadeinicio>XXXX-XX-XX</fechadeinicio>
      <fechadefinal>XXXX-XX-XX</fechadefinal>
      <institucion>Nombre de la institución</institucion>
      <descripcion>
        Aqui pondré una pequeña descripción del titulo obtenido
      </descripcion>
      <logo>logo.jpg</logo>
    </titulo>
    <titulo>
      <nombre>Título en XXXXXX</titulo>
      <fechadeinicio>XXXX-XX-XX</fechadeinicio>
      <fechadefinal>XXXX-XX-XX</fechadefinal>
      <institucion>Nombre de la institución</institucion>
      <descripcion>
        Aqui pondré una pequeña descripción del titulo obtenido
      </descripcion>
      <logo>logo.jpg</logo>
    </titulo>
  </formacion>
</persona>

  
```

<a id="curriculum"></a>
## Curriculum

### datos

```json
{
  "nombre":"Jose Vicente",
  "apellidos":"Carratalá Sanchis",
  "email":"info@josevicentecarratala.com",
  "teléfono":"620891718",
  "titulacion":"Ingeniero técnico en Diseño Industrial",
  "experiencia":"Profesor en TAME"
}
```

### categorias

```json
{
  "datos personales":{
    "nombre":"Jose Vicente",
    "apellidos":"Carratalá Sanchis",
    "email":"info@josevicentecarratala.com",
    "teléfono":"620891718"
  },
  "formación":{
    
  }
  
}
```

### arrays para conjuntos de información

```json
{
  "datos personales":{
    "nombre":"Jose Vicente",
    "apellidos":"Carratalá Sanchis",
    "email":"info@josevicentecarratala.com",
    "teléfono":"620891718",
    "redes sociales":[
        {
          "nombre":"Facebook",
          "url":"https://www.facebook.com/carratala"
        },
        {
          "nombre":"Instagram",
          "url":"https://www.instagram.com/jvcarratala/"
        },
        {
          "nombre":"Linkedin",
          "url":"https://www.linkedin.com/in/jvcarratala/"
        },
        {
          "nombre":"GitHub",
          "url":"https://github.com/jocarsa"
        }
    ]
  },
  "experiencia laboral":[
    {
      "inicio":"XX",
      "final":"XX",
      "localidad":"XX",
      "empresa":"XX",
      
    }
  ]
  
}
```

### experiencia laboral

```json
{
  "datos personales":{
    "nombre":"Jose Vicente",
    "apellidos":"Carratalá Sanchis",
    "email":"info@josevicentecarratala.com",
    "teléfono":"620891718",
    "redes sociales":[
        {
          "nombre":"Facebook",
          "url":"https://www.facebook.com/carratala"
        },
        {
          "nombre":"Instagram",
          "url":"https://www.instagram.com/jvcarratala/"
        },
        {
          "nombre":"Linkedin",
          "url":"https://www.linkedin.com/in/jvcarratala/"
        },
        {
          "nombre":"GitHub",
          "url":"https://github.com/jocarsa"
        }
    ]
  },
  "experiencia laboral":[
    {
      "inicio":"XX",
      "final":"XX",
      "localidad":"XX",
      "empresa":"XX",
      "cargo":"XX",
      "responsabilidades":[
        "Responsabilidad 1",
        "Responsabilidad 2",
        "Responsabilidad 3
      ]
    },
    {
      "inicio":"XX",
      "final":"XX",
      "localidad":"XX",
      "empresa":"XX",
      "cargo":"XX",
      "responsabilidades":[
        "Responsabilidad 1",
        "Responsabilidad 2",
        "Responsabilidad 3
      ]
    },
    {
      "inicio":"XX",
      "final":"XX",
      "localidad":"XX",
      "empresa":"XX",
      "cargo":"XX",
      "responsabilidades":[
        "Responsabilidad 1",
        "Responsabilidad 2",
        "Responsabilidad 3
      ]
    },
  ],
  "formacion":[
    
  ]
  
}
```

### formacion

```json
{
  "datos personales":{
    "nombre":"Jose Vicente",
    "apellidos":"Carratalá Sanchis",
    "email":"info@josevicentecarratala.com",
    "teléfono":"620891718",
    "redes sociales":[
        {
          "nombre":"Facebook",
          "url":"https://www.facebook.com/carratala"
        },
        {
          "nombre":"Instagram",
          "url":"https://www.instagram.com/jvcarratala/"
        },
        {
          "nombre":"Linkedin",
          "url":"https://www.linkedin.com/in/jvcarratala/"
        },
        {
          "nombre":"GitHub",
          "url":"https://github.com/jocarsa"
        }
    ]
  },
  "experiencia laboral":[
    {
      "inicio":"XX",
      "final":"XX",
      "localidad":"XX",
      "empresa":"XX",
      "cargo":"XX",
      "responsabilidades":[
        "Responsabilidad 1",
        "Responsabilidad 2",
        "Responsabilidad 3"
      ]
    },
    {
      "inicio":"XX",
      "final":"XX",
      "localidad":"XX",
      "empresa":"XX",
      "cargo":"XX",
      "responsabilidades":[
        "Responsabilidad 1",
        "Responsabilidad 2",
        "Responsabilidad 3"
      ]
    },
    {
      "inicio":"XX",
      "final":"XX",
      "localidad":"XX",
      "empresa":"XX",
      "cargo":"XX",
      "responsabilidades":[
        "Responsabilidad 1",
        "Responsabilidad 2",
        "Responsabilidad 3"
      ]
    }
  ],
  "formacion":[
    {
      "inicio":"1997",
      "final":"2000",
      "entidad":"Entidad de la formación",
      "titulo":"Nombre del título obtenido"
    }
  ]
  
}
```

### json limpio

```json
{
  "datos personales":{
    "nombre":"Jose Vicente",
    "apellidos":"Carratalá Sanchis",
    "email":"info@josevicentecarratala.com",
    "teléfono":"620891718",
    "redes sociales":[
        {
          "nombre":"Facebook",
          "url":"https://www.facebook.com/carratala"
        },
        {
          "nombre":"Instagram",
          "url":"https://www.instagram.com/jvcarratala/"
        },
        {
          "nombre":"Linkedin",
          "url":"https://www.linkedin.com/in/jvcarratala/"
        },
        {
          "nombre":"GitHub",
          "url":"https://github.com/jocarsa"
        }
    ]
  },
  "experiencia laboral":[
    {
      "inicio":"XX",
      "final":"XX",
      "localidad":"XX",
      "empresa":"XX",
      "cargo":"XX",
      "responsabilidades":[
        "Responsabilidad 1",
        "Responsabilidad 2",
        "Responsabilidad 3"
      ]
    },
    {
      "inicio":"XX",
      "final":"XX",
      "localidad":"XX",
      "empresa":"XX",
      "cargo":"XX",
      "responsabilidades":[
        "Responsabilidad 1",
        "Responsabilidad 2",
        "Responsabilidad 3"
      ]
    },
    {
      "inicio":"XX",
      "final":"XX",
      "localidad":"XX",
      "empresa":"XX",
      "cargo":"XX",
      "responsabilidades":[
        "Responsabilidad 1",
        "Responsabilidad 2",
        "Responsabilidad 3"
      ]
    }
  ],
  "formacion":[
    {
      "inicio":"1997",
      "final":"2000",
      "entidad":"Entidad de la formación",
      "titulo":"Nombre del título obtenido"
    }
  ],
  "habilidades informáticas":[
    "HTML,CSS,Javascript",
    "MySQL, SQLite, PostgreSQL, MongoDB",
    "Python, Javascript, Java, PHP",
    "..."
  ],
  "idiomas":[
    {
      "idioma":"inglés",
      "nivel":"90"
    },
    {
      "idioma":"francés",
      "nivel":"60"
    },
    {
      "idioma":"alemán",
      "nivel":"30"
    }
  ]
  
}
```

### pongo la foto

```json
{
  "datos personales":{
    "nombre":"Jose Vicente",
    "apellidos":"Carratalá Sanchis",
    "email":"info@josevicentecarratala.com",
    "teléfono":"620891718",
    "fotografia":"josevicentecarratala.jpg",
    "redes sociales":[
        {
          "nombre":"Facebook",
          "url":"https://www.facebook.com/carratala"
        },
        {
          "nombre":"Instagram",
          "url":"https://www.instagram.com/jvcarratala/"
        },
        {
          "nombre":"Linkedin",
          "url":"https://www.linkedin.com/in/jvcarratala/"
        },
        {
          "nombre":"GitHub",
          "url":"https://github.com/jocarsa"
        }
    ]
  },
  "experiencia laboral":[
    {
      "inicio":"XX",
      "final":"XX",
      "localidad":"XX",
      "empresa":"XX",
      "cargo":"XX",
      "responsabilidades":[
        "Responsabilidad 1",
        "Responsabilidad 2",
        "Responsabilidad 3"
      ]
    },
    {
      "inicio":"XX",
      "final":"XX",
      "localidad":"XX",
      "empresa":"XX",
      "cargo":"XX",
      "responsabilidades":[
        "Responsabilidad 1",
        "Responsabilidad 2",
        "Responsabilidad 3"
      ]
    },
    {
      "inicio":"XX",
      "final":"XX",
      "localidad":"XX",
      "empresa":"XX",
      "cargo":"XX",
      "responsabilidades":[
        "Responsabilidad 1",
        "Responsabilidad 2",
        "Responsabilidad 3"
      ]
    }
  ],
  "formacion":[
    {
      "inicio":"1997",
      "final":"2000",
      "entidad":"Entidad de la formación",
      "titulo":"Nombre del título obtenido"
    },
    {
      "inicio":"1997",
      "final":"2000",
      "entidad":"Entidad de la formación",
      "titulo":"Nombre del título obtenido"
    }
  ],
  "habilidades informáticas":[
    "HTML,CSS,Javascript",
    "MySQL, SQLite, PostgreSQL, MongoDB",
    "Python, Javascript, Java, PHP",
    "..."
  ],
  "idiomas":[
    {
      "idioma":"inglés",
      "nivel":"90"
    },
    {
      "idioma":"francés",
      "nivel":"60"
    },
    {
      "idioma":"alemán",
      "nivel":"30"
    }
  ]
  
}
```

### resumen profesional

```json
{
  "datos personales":{
    "nombre":"Jose Vicente",
    "apellidos":"Carratalá Sanchis",
    "email":"info@josevicentecarratala.com",
    "teléfono":"620891718",
    "fotografia":"josevicentecarratala.jpg",
    "resumen profesional":"Lorem ipsum",
    "redes sociales":[
        {
          "nombre":"Facebook",
          "url":"https://www.facebook.com/carratala"
        },
        {
          "nombre":"Instagram",
          "url":"https://www.instagram.com/jvcarratala/"
        },
        {
          "nombre":"Linkedin",
          "url":"https://www.linkedin.com/in/jvcarratala/"
        },
        {
          "nombre":"GitHub",
          "url":"https://github.com/jocarsa"
        }
    ]
  },
  "experiencia laboral":[
    {
      "inicio":"XX",
      "final":"XX",
      "localidad":"XX",
      "empresa":"XX",
      "cargo":"XX",
      "responsabilidades":[
        "Responsabilidad 1",
        "Responsabilidad 2",
        "Responsabilidad 3"
      ]
    },
    {
      "inicio":"XX",
      "final":"XX",
      "localidad":"XX",
      "empresa":"XX",
      "cargo":"XX",
      "responsabilidades":[
        "Responsabilidad 1",
        "Responsabilidad 2",
        "Responsabilidad 3"
      ]
    },
    {
      "inicio":"XX",
      "final":"XX",
      "localidad":"XX",
      "empresa":"XX",
      "cargo":"XX",
      "responsabilidades":[
        "Responsabilidad 1",
        "Responsabilidad 2",
        "Responsabilidad 3"
      ]
    }
  ],
  "formacion":[
    {
      "inicio":"1997",
      "final":"2000",
      "entidad":"Entidad de la formación",
      "titulo":"Nombre del título obtenido"
    },
    {
      "inicio":"1997",
      "final":"2000",
      "entidad":"Entidad de la formación",
      "titulo":"Nombre del título obtenido"
    }
  ],
  "habilidades informáticas":[
    "HTML,CSS,Javascript",
    "MySQL, SQLite, PostgreSQL, MongoDB",
    "Python, Javascript, Java, PHP",
    "..."
  ],
  "idiomas":[
    {
      "idioma":"inglés",
      "nivel":"90"
    },
    {
      "idioma":"francés",
      "nivel":"60"
    },
    {
      "idioma":"alemán",
      "nivel":"30"
    }
  ]
  
}
```

<a id="ejercicio-de-final-de-unidad"></a>
## Ejercicio de final de unidad

### actividad

```markdown
# Actividad (30’): “Planificador de cuadras — versión exprés”

Crea un script llamado `planificador_cuadras.py` que calcule cuántas cuadras necesitas en una fecha dada, según el número de caballos y la capacidad de cada cuadra. Debe redondear **al alza** el número de cuadras, mostrar propiedades de la fecha y presentar un pequeño informe.

## Objetivos de aprendizaje

* Usar **métodos** y **propiedades** de objetos estándar (`datetime.date`, `date.year`, `date.weekday`, etc.). 
* Llamar a **métodos “estáticos”**/de módulo como `math.ceil`. 
* Manejar **entrada → cálculo → salida** con mensajes claros. 

## Requisitos funcionales

1. **Entrada de datos (por `input`)**

   * `caballos` (entero > 0).
   * `capacidad_por_cuadra` (entero > 0).
   * `fecha` en formato `YYYY-MM-DD`.
     (Estos tres inputs siguen el patrón de los ejercicios de entrada/cálculo/salida). 
2. **Cálculos**

   * `cuadras_necesarias = ceil(caballos / capacidad_por_cuadra)` usando `math.ceil`. 
   * Crear un objeto `date` con la fecha indicada y obtener:

     * `year`, `month`, `day`
     * `weekday()` (0–6) y `isoweekday()` (1–7)
       (Como en los ejemplos de propiedades de fecha). 
3. **Salida (informe)**

   * Línea resumen con caballos, capacidad y cuadras **redondeadas al alza**.
   * Bloque “Datos de la fecha” mostrando `YYYY-MM-DD`, `year`, `month`, `day`, `weekday`, `isoweekday`.
4. **Validaciones mínimas**

   * Si algún valor no es entero positivo, mostrar un mensaje y terminar.
   * Si la fecha no cumple el formato, mostrar mensaje y terminar.
5. **(Opcional, si te da tiempo)**

   * Mostrar si la fecha cae **entre semana** o **fin de semana** (usa `isoweekday()`).
```


<a id="utilizacion-de-lenguajes-de-marcas-en-entornos-web"></a>
# Utilización de lenguajes de marcas en entornos web

<a id="estandares-web-versiones-clasificacion"></a>
## Estándares web. Versiones. Clasificación

En el vasto e infinito universo de la programación y la tecnología, un concepto fundamental es el de los lenguajes de marcas y sistemas de gestión de información. En esta sección, nos adentramos en el fascinante mundo de los estándares web, sus versiones y su clasificación, elementos cruciales para entender cómo funcionan las aplicaciones web modernas.

Los estándares web son como las reglas que rigen la construcción de edificios. En este caso, no es una estructura física, sino un conjunto de normas establecidas por organizaciones internacionales como la W3C (World Wide Web Consortium). Estos estándares garantizan que los navegadores web y otros software puedan interpretar correctamente el contenido que se les presenta.

La evolución histórica del internet ha llevado a la creación de múltiples versiones de estos estándares. Cada versión introduce mejoras, correcciones y nuevas funcionalidades. Por ejemplo, HTML 4.01 fue un paso importante en la historia del web, introduciendo características como el uso de tablas para estructurar contenido. Sin embargo, con el tiempo, se dieron cuenta de que esta forma de presentar información no era óptima para dispositivos móviles y accesibilidad.

La clasificación de los estándares web es otro aspecto crucial. Se pueden categorizar en tres tipos principales: HTML (HyperText Markup Language), CSS (Cascading Style Sheets) y JavaScript. Cada uno desempeña un papel fundamental en la construcción de una página web. HTML define el contenido, CSS controla su presentación visual y JavaScript añade interactividad.

HTML es el lenguaje de marcado que usamos para estructurar nuestro contenido. Es como el esqueleto de una casa; sin él, no hay nada más que soportar. Las etiquetas HTML son las instrucciones que le damos al navegador sobre cómo debe interpretar y mostrar el contenido.

CSS, por otro lado, se encarga de dar estilo a nuestro contenido. Es como la pintura en un cuadro; añade color, forma y diseño. Con CSS, podemos controlar aspectos como el tamaño de las fuentes, los colores, los márgenes y los espacios entre elementos.

JavaScript es el lenguaje que hace que nuestras páginas web sean interactivas. Es como la electricidad en una casa; sin ella, no hay vida. Con JavaScript, podemos hacer cosas como responder a clics de los usuarios, validar formularios, cargar contenido dinámicamente y mucho más.

La combinación de estos tres lenguajes crea las páginas web que vemos todos los días. Cada uno tiene su propio conjunto de etiquetas y sintaxis, pero trabajan juntos para crear experiencias únicas y funcionales en línea.

En el mundo digital actual, conocer estos estándares es imprescindible. No solo son fundamentos para desarrollar sitios web, sino que también son esenciales para entender cómo funciona la web como plataforma. Cada día, nuevas versiones de los estándares se lanzan, introduciendo mejoras y correcciones que hacen que nuestras páginas web sean más eficientes, seguras y accesibles.

En resumen, el estudio de los estándares web, sus versiones y su clasificación es una puerta a la comprensión profunda del funcionamiento de las aplicaciones web. Es un campo en constante evolución, lleno de oportunidades para aprender y mejorar nuestras habilidades como desarrolladores.

<a id="estructura-de-un-documento-html"></a>
## Estructura de un documento HTML

HTML
Hyper Text Markup Language

La estructura de un documento HTML es la base sobre la cual se construyen las páginas web, proporcionando una organización lógica y semántica que facilita su lectura y renderizado por los navegadores. Este sistema de etiquetas y atributos permite definir el contenido y su presentación en forma jerárquica, asegurando que cada parte del documento tenga un propósito específico.

La estructura básica de un documento HTML comienza con la declaración del tipo de documento, seguida de las etiquetas `<html>`, `<head>` y `<body>`. La etiqueta `<html>` es el contenedor principal que engloba todo el contenido del documento. Dentro de ella, la etiqueta `<head>` incluye metadatos como el título de la página, enlaces a hojas de estilo externas y scripts, y otros elementos no visibles para el usuario.

El contenido visible se organiza dentro de la etiqueta `<body>`, donde se pueden encontrar varios tipos de elementos. Los encabezados son una parte fundamental, definidos por las etiquetas `<h1>` a `<h6>`, siendo `<h1>` el más importante y `<h6>` el menos. Estos elementos no solo sirven para organizar el contenido sino que también proporcionan información semántica sobre la jerarquía de los títulos.

Los párrafos se crean utilizando la etiqueta `<p>`, lo que permite al navegador identificar y formatear correctamente el texto como un bloque separado. La lista desordenada (`<ul>`) y ordenada (`<ol>`) son útiles para presentar información en forma de elementos individuales, mientras que las listas de definición (`<dl>`) son ideales para mostrar términos y sus descripciones asociadas.

Las imágenes se insertan con la etiqueta `<img>`, donde el atributo `src` especifica la ubicación del archivo de imagen. Además, es importante incluir el atributo `alt` para proporcionar una descripción textual de la imagen, lo que mejora la accesibilidad y el SEO del sitio.

La tabla (`<table>`) es un elemento poderoso para presentar datos tabulares, compuesto por filas (`<tr>`), celdas de encabezado (`<th>`) y celdas de datos (`<td>`). Las tablas pueden ser complejas o simples, dependiendo del nivel de detalle que se requiera.

La estructura de un documento HTML no solo es crucial para su funcionamiento correcto en los navegadores, sino que también es fundamental para la accesibilidad y el SEO. Un buen diseño de estructura facilita la navegación y mejora la comprensión del contenido por parte de los usuarios, mientras que una buena optimización para motores de búsqueda puede aumentar la visibilidad del sitio web.

La comprensión y aplicación adecuada de estas etiquetas y atributos es esencial para cualquier desarrollador web, ya que permite crear páginas web bien organizadas, accesibles y eficientes en términos de rendimiento. A través de la estructura HTML, se puede transmitir no solo el contenido, sino también su significado y propósito, lo cual es fundamental para una buena experiencia de usuario y un buen posicionamiento en los motores de búsqueda.

### documento

```html
<!doctype html>
```

### etiquetas html

```html
<!doctype html>
<html>
  
</html>
```

### lenguage

```html
<!doctype html>
<html lang="es">
  
</html>
```

### cabeza y cuerpo

```html
<!doctype html>
<html lang="es">
  
</html>
```

### titulo

```html
<!doctype html>
<html lang="es">
  <head>
    <title>
      La web de Jose Vicente
    </title>
  </head>
  <body>
  </body>
</html>
```

### codificacion

```html
<!doctype html>
<html lang="es">
  <head>
    <title>
      La web de Jose Vicente
    </title>
    <meta charset="utf-8">
  </head>
  <body>
  </body>
</html>
```

<a id="identificacion-de-etiquetas-y-atributos-de-html"></a>
## Identificación de etiquetas y atributos de HTML

En el vasto mundo digital de hoy en día, los lenguajes de marcas desempeñan un papel crucial en la construcción de interfaces web interactivas y accesibles. Uno de los aspectos fundamentales de su uso es la identificación precisa de etiquetas y atributos HTML, que son las construcciones básicas del código fuente que define el contenido y la estructura de una página web.

Las etiquetas HTML son elementos que marcan el comienzo y fin de ciertos tipos de información en un documento. Cada etiqueta tiene un nombre específico que indica su propósito dentro del contexto de la página, como `<h1>` para títulos principales o `<p>` para párrafos. La sintaxis básica de una etiqueta es simple: se abre con el nombre de la etiqueta entre corchetes angulares (`<`) y se cierra con el mismo nombre pero precedido por un slash (`</>`). Por ejemplo, la etiqueta para un enlace sería `<a href="https://www.ejemplo.com">Enlace a Ejemplo</a>`, donde `href` es un atributo que especifica la dirección URL al que apunta el enlace.

Los atributos son pares de nombre y valor que proporcionan información adicional sobre las etiquetas. Son útiles para personalizar el comportamiento o el estilo de los elementos HTML. Por ejemplo, en el caso del enlace anterior, `href` es el nombre del atributo y `"https://www.ejemplo.com"` es su valor. Otro ejemplo común es el atributo `class`, que se utiliza para aplicar estilos CSS específicos a un elemento.

La identificación precisa de etiquetas y atributos HTML es esencial para cualquier desarrollador web, ya que permite manipular dinámicamente el contenido de una página o interactuar con elementos específicos mediante JavaScript. Por ejemplo, podríamos seleccionar todos los enlaces de una página utilizando la etiqueta `<a>` y luego cambiar su color usando JavaScript.

Además, conocer bien las etiquetas y atributos HTML es fundamental para crear páginas web accesibles a personas con discapacidades visuales. Esto se logra mediante el uso de atributos como `alt` en imágenes o `aria-label` en elementos interactivos, que proporcionan descripciones textuales que pueden ser leídas por lectores de pantalla.

La comprensión profunda de las etiquetas y atributos HTML también facilita la creación de páginas web responsivas. Por ejemplo, podemos utilizar atributos como `media` en las etiquetas `<link>` o `<source>` para especificar diferentes recursos para diferentes dispositivos o tamaños de pantalla.

En resumen, la identificación precisa de etiquetas y atributos HTML es una habilidad esencial para cualquier desarrollador web. No solo permite crear páginas web interactivas y accesibles, sino que también facilita el desarrollo de aplicaciones web dinámicas y responsivas. A través del estudio detallado de estas construcciones básicas del código fuente, los estudiantes pueden adquirir una sólida base para continuar explorando más complejas técnicas de programación web en el futuro.

<a id="herramientas-de-diseno-web"></a>
## Herramientas de diseño web

En el mundo digital actual, la utilización de lenguajes de marcas en entornos web es una habilidad fundamental para cualquier profesional del campo. Estos lenguajes no solo permiten crear páginas web estáticas, sino que también son cruciales para desarrollar aplicaciones interactivas y dinámicas. En esta subunidad didáctica, nos adentramos en el uso de herramientas de diseño web, un aspecto esencial del desarrollo web.

Las herramientas de diseño web ofrecen una serie de ventajas sobre la creación manual de código HTML y CSS. Estas herramientas permiten a los desarrolladores crear interfaces de usuario visualmente atractivas y funcionales sin necesidad de dominar completamente el lenguaje de marcado. Algunas de las principales herramientas incluyen Adobe Dreamweaver, Microsoft Expression Web y Bluefish Editor.

Dreamweaver es una herramienta muy popular en el mundo del diseño web debido a su interfaz gráfica intuitiva y sus capacidades avanzadas para la edición de sitios web. Permite crear páginas web con un solo clic, gracias a su visualización previa en tiempo real. Además, Dreamweaver ofrece una amplia gama de plantillas y diseños predefinidos que pueden personalizarse según las necesidades del proyecto.

Microsoft Expression Web es otra opción popular para el diseño web. Aunque ha sido reemplazado por herramientas más modernas como Visual Studio Code, sigue siendo una opción viable para aquellos que prefieren seguir trabajando con Microsoft Office. Expression Web ofrece características similares a Dreamweaver, incluyendo la posibilidad de crear sitios web interactivos y la capacidad de trabajar en equipo.

Bluefish Editor es una herramienta de código abierto y gratuito que ofrece un entorno de desarrollo web completo. Aunque no tiene la misma interfaz gráfica sofisticada que las herramientas comerciales, Bluefish proporciona todas las funcionalidades necesarias para el diseño web. Su capacidad para autocompletar etiquetas HTML y CSS, junto con su soporte para múltiples idiomas de programación, lo hace una opción atractiva para desarrolladores independientes.

La elección de la herramienta adecuada depende en gran medida del nivel de experiencia del desarrollador y las preferencias personales. Aunque Dreamweaver y Expression Web ofrecen interfaces gráficas más amigables, Bluefish Editor proporciona un entorno de desarrollo web completo y flexible para aquellos que prefieren trabajar con código.

En conclusión, el uso de herramientas de diseño web es una habilidad esencial en el mundo del desarrollo web. Estas herramientas no solo facilitan la creación de interfaces de usuario atractivas y funcionales, sino que también permiten a los desarrolladores centrarse en la funcionalidad y el rendimiento de sus sitios web. En esta subunidad didáctica, hemos explorado algunas de las principales herramientas disponibles para el diseño web, cada una con sus propias ventajas y características únicas.

<a id="hojas-de-estilo-css"></a>
## Hojas de estilo (CSS)

En el vasto mundo digital de hoy en día, las hojas de estilo (CSS) son un elemento esencial para dar forma y estilo a los documentos web. Estas hojas proporcionan una capa adicional de personalización que permite a los diseñadores crear interfaces gráficas atractivas y funcionales.

La estructura básica de una hoja de estilo CSS consta de reglas, cada una compuesta por un selector y un bloque de declaraciones. El selector identifica el elemento o elementos HTML al que se aplicará la regla, mientras que el bloque de declaraciones contiene las propiedades y valores que definen cómo debe verse ese elemento.

La sintaxis de CSS es sencilla pero poderosa. Por ejemplo, si queremos cambiar el color del texto en todos los párrafos de un documento, podríamos escribir:

```css
p {
    color: blue;
}
```

Este código selecciona todos los elementos `<p>` y les aplica una propiedad `color` con el valor `blue`, haciendo que el texto dentro de esos párrafos sea azul.

Además de las propiedades básicas como color, tamaño de fuente y alineación, CSS ofrece una amplia gama de opciones para personalizar la apariencia visual. Podemos controlar el diseño de listas, tablas, enlaces, imágenes y muchos otros elementos del documento. Por ejemplo, para centrar un elemento dentro de su contenedor padre, podríamos usar:

```css
.center {
    text-align: center;
}
```

Y luego aplicarlo a cualquier elemento que queramos centrar:

```html
<div class="center">
    Este texto estará centrado.
</div>
```

La capacidad de CSS para seleccionar elementos específicos y aplicar estilos condicionales es una de sus fortalezas. Podemos crear reglas que se apliquen solo a ciertos elementos bajo ciertas condiciones, lo que permite un control muy preciso sobre la apariencia del documento.

Además de las propiedades estándar, CSS también ofrece técnicas avanzadas como el uso de pseudo-clases y pseudo-elementos para seleccionar y estilizar partes específicas de los elementos. Por ejemplo, podemos cambiar el color del enlace cuando el usuario lo pasa con el cursor:

```css
a:hover {
    color: red;
}
```

Estas capacidades hacen que CSS sea una herramienta versátil y poderosa para crear interfaces web atractivas y funcionales.

La hoja de estilo CSS no solo permite la personalización visual, sino también la separación lógica entre el contenido del documento (HTML) y su presentación. Esto facilita la mantenibilidad del código y mejora la accesibilidad, ya que los diseñadores pueden trabajar en la apariencia sin afectar el contenido.

En resumen, las hojas de estilo CSS son una parte fundamental del desarrollo web, proporcionando la capacidad de dar forma y estilo a los documentos HTML. A través de su sintaxis sencilla pero poderosa, ofrecen una amplia gama de opciones para crear interfaces gráficas atractivas y funcionales, mejorando así la experiencia del usuario en línea.

<a id="validacion-de-documentos-html-y-css"></a>
## Validación de documentos HTML y CSS

En el vasto mundo digital de la web, los lenguajes de marcas desempeñan un papel crucial como herramientas para crear contenido estructurado e interactividad. En esta subunidad didáctica, nos adentramos en el proceso de validación de documentos HTML y CSS, dos fundamentos indispensables para garantizar la calidad y la accesibilidad de nuestras páginas web.

La validación de HTML es un paso esencial que permite verificar si nuestro código cumple con las normas establecidas por los estándares web. Este proceso no solo asegura que nuestra página se muestre correctamente en cualquier navegador, sino que también facilita el mantenimiento y la optimización del sitio. Al identificar errores o omisiones en nuestro código HTML, podemos corregirlos rápidamente, mejorando así la experiencia del usuario.

Por otro lado, la validación de CSS es igualmente importante para mantener la consistencia visual y funcionalidad de nuestra página web. A través de esta validación, podemos comprobar que nuestras hojas de estilo están bien estructuradas y aplican correctamente las reglas de diseño a los elementos del contenido. Esto no solo mejora la apariencia general del sitio, sino que también asegura que el contenido sea accesible para todos los usuarios, incluyendo aquellos con discapacidades visuales.

La validación de documentos HTML y CSS es un proceso iterativo que requiere paciencia y atención a los detalles. A medida que avanzamos en este camino, nos familiarizaremos con las herramientas disponibles para facilitar este trabajo, como el Validador W3C para HTML y la extensión Live Sass Compiler para CSS. Estas herramientas no solo simplifican el proceso de validación, sino que también proporcionan retroalimentación instantánea sobre los errores encontrados.

Es importante recordar que la validación es una práctica recomendada, pero no es un requisito riguroso. A veces, puede ser necesario hacer excepciones para mantener la funcionalidad y la compatibilidad de nuestro sitio web. En tales casos, debemos estar conscientes de las implicaciones y tomar decisiones informadas.

La validación de documentos HTML y CSS es una habilidad valiosa que nos permitirá crear páginas web más robustas, accesibles y eficientes. A medida que profundizamos en este tema, descubriremos cómo aplicar estas técnicas en nuestro trabajo diario como desarrolladores web, mejorando así la calidad de nuestros proyectos y contribuyendo a una web más sólida y funcional.

En resumen, la validación de documentos HTML y CSS es un proceso fundamental para el desarrollo web. A través de este proceso, podemos asegurar que nuestras páginas web sean correctas, funcionales y accesibles para todos los usuarios. Con práctica y dedicación, podremos convertirnos en expertos en esta área, mejorando así la calidad de nuestros proyectos y contribuyendo a una web más sólida y funcional.

### Introduccion

```markdown
Podemos validar en: https://validator.w3.org/

Resultado de mi validación

Warning: This document appears to be Lorem ipsum text but the html start tag has lang="es". Consider using lang="zxx" (or variant) instead.

From line 1, column 16; to line 2, column 16

type html>↩<html lang="es">↩  <he

For further guidance, consult Tagging text with no language, Declaring the overall language of a page and Choosing language tags.

If the HTML checker has misidentified the language of this document, please file an issue report or send e-mail to report the problem.

Error: CSS: family: Property family doesn't exist.

From line 13, column 16; to line 13, column 21

   family:Ubuntu;↩    

Error: CSS: src: "https://static.jocarsa.com/fuuentes/ubuntu-font-family-0.83/Ubuntu-R.ttf" is not a src value.

From line 14, column 87; to line 15, column 6

ntu-R.ttf"↩      }↩    

Error: CSS: family: Property family doesn't exist.

From line 17, column 16; to line 17, column 25

   family:UbuntuBold;↩    

Error: CSS: src: "https://static.jocarsa.com/fuuentes/ubuntu-font-family-0.83/Ubuntu-B.ttf" is not a src value.

From line 18, column 87; to line 19, column 6

ntu-B.ttf"↩      }↩    

Error: An img element must have an alt attribute, except under certain conditions. For details, consult guidance on providing text alternatives for images.

From line 162, column 11; to line 162, column 31

          <img src="port1.jpg">↩     

Error: An img element must have an alt attribute, except under certain conditions. For details, consult guidance on providing text alternatives for images.

From line 169, column 11; to line 169, column 31

          <img src="port1.jpg">↩     

Error: An img element must have an alt attribute, except under certain conditions. For details, consult guidance on providing text alternatives for images.

From line 176, column 11; to line 176, column 31

          <img src="port1.jpg">↩     

Error: An img element must have an alt attribute, except under certain conditions. For details, consult guidance on providing text alternatives for images.

From line 184, column 13; to line 184, column 33

          <img src="port1.jpg">↩     

Error: An img element must have an alt attribute, except under certain conditions. For details, consult guidance on providing text alternatives for images.

From line 190, column 13; to line 190, column 33

          <img src="port1.jpg">↩     

Error: An img element must have an alt attribute, except under certain conditions. For details, consult guidance on providing text alternatives for images.

From line 196, column 13; to line 196, column 33

          <img src="port1.jpg">↩     

Error: An img element must have an alt attribute, except under certain conditions. For details, consult guidance on providing text alternatives for images.

From line 202, column 13; to line 202, column 33

          <img src="port1.jpg">↩     

Error: An img element must have an alt attribute, except under certain conditions. For details, consult guidance on providing text alternatives for images.

From line 208, column 13; to line 208, column 33

          <img src="port1.jpg">↩     

Error: An img element must have an alt attribute, except under certain conditions. For details, consult guidance on providing text alternatives for images.

From line 214, column 13; to line 214, column 33

          <img src="port1.jpg">↩     
```

### correccion sobre la validacion

```html
<!doctype html>
<html lang="es">
  <head>
    <title>
      Jose Vicente Carratalá Sanchis - Profesor, desarrollador, y diseñador
    </title>
    <meta charset="utf-8">
    <meta name="author" content="Jose Vicente Carratala">
    <meta name="description" content="Soy Jose Vicente Carratala, un profesional apasionado por la tecnología, la formación y la creatividad digital. A lo largo de mi trayectoria, he trabajado en diversas áreas relacionadas con el desarrollo de software, la enseñanza de programación y la creación de contenidos visuales en 3D. Mi objetivo es ofrecer soluciones innovadoras y efectivas en el mundo de la tecnología y la formación.">
    <style>
      /* Aquí voy a poner mis estilos */
      @font-face{
        family:Ubuntu;
        src:"https://static.jocarsa.com/fuuentes/ubuntu-font-family-0.83/Ubuntu-R.ttf"
      }
      @font-face{
        family:UbuntuBold;
        src:"https://static.jocarsa.com/fuuentes/ubuntu-font-family-0.83/Ubuntu-B.ttf"
      }
      body{
        background:WhiteSmoke;
        color:DarkSlateBlue;
        font-family:Ubuntu,sans-serif; /*serif, sans-serif,monospace,cursive,fantasy*/
      }
      header,main,footer{       /* La coma es el selector multiple */
        background:white;       /* El fondo es blanco */
        width:800px;            /* Tiene una anchura de 800px */
        margin:auto;            /* Centrar los margenes */
        padding:40px;           /* El padding es el margen interior */
      }
      main{
        text-align:justify;     /* Justificación del texto no forzada */
      }
      header{
        text-align:center;
      }
      header h1{
        margin:0px;
      }
      header h2{                /* El espacio es el selector hijo */
        font-size:12px;         /* Tamaño de la fuente */
        font-weight:normal;     /* Peso de la fuente */
        margin:0px;
      }
      header nav ul{
        list-style-type:none;   /* No quiero ver los elementos como lista */
        padding:0px;            /* Quito los estilos por defecto */
        margin:0px;             /* Quito los estilos por defecto */
      }
      header nav ul li{
        display:inline-block;   /* Quiero mostrar los elementos uno al lado del otro */
        margin:0px;
        background:DarkSlateBlue;
        font-weight:bold;
        color:white;
        padding:4px;
        font-size:8px;
        text-transform:uppercase;
        margin:0px;
        display:inline-block;
        min-width:50px;
      }
      header nav ul li:first-child{
        border-radius:20px 0px 0px 20px;
      }
      header nav ul li:last-child{
        border-radius:0px 20px 20px 0px;
      }
      header nav ul li a{
        color:inherit;          /* Ponle el color que le tocaría */
        text-decoration:none;   /* No me subrayes el texto */
        
      }
      .contenedor{    /* Estiliza todos los elementos que sean de clase contenedor */
        display:flex;
        gap:20px;
      }
      #contacto .contenedor form{
        flex:1;
        display:flex;
        flex-direction:column;
        gap:10px;
      }
      #contacto .contenedor iframe{
        flex:1;
        
      }
      footer{
        display:flex;
        justify-content: center;
        align-items: center;
        gap:2px;
      }
      footer a{
        text-decoration:none;
        color:white;
        background:DarkSlateBlue;
        padding:5px;
        font-size:10px;
        text-transform:uppercase;
      }
      footer a:first-child{
        border-radius:10px 0px 0px 10px;
      }
      footer a:last-child{
        border-radius:0px 10px 10px 0px;
      }
      #portafolio #contenedor{
        display:grid;
        gap:20px;
        grid-template-columns:auto auto auto;
      }
      #portafolio #contenedor article{
        border:1px solid ghostwhite;
        box-shadow:0px 2px 4px grey;
        padding:20px;
      }
      #portafolio #contenedor article img{
        width:100%;
      }
      .contenedordoscolumnas{
        display:flex;
        gap:20px;
      }
      .contenedordoscolumnas img,.contenedordoscolumnas p{
        flex:1;
      }
      #docencia .contenedordoscolumnas{
        flex-direction: row-reverse;
      }
    </style>
  </head>
  <body>
    <header>
      <h1>Jose Vicente Carratalá Sanchis</h1>
      <h2>Profesor, desarrollador, y diseñador</h2>
      <nav>
        <ul>
          <li><a href="#inicio">Inicio</a></li>
          <li><a href="#sobremi">Sobre mi</a></li>
          <li><a href="#programacion">Programación</a></li>
          <li><a href="#docencia">Docencia</a></li>
          <li><a href="#diseno">Diseño</a></li>
          <li><a href="#portafolio">Portafolio</a></li>
          <li><a href="#contacto">Contacto</a></li>
        </ul>
      </nav>
    </header>
    <main>
      <section id="inicio">
        <h3>Inicio</h3>
        <img src="josevicente.jpeg" alt="Jose Vicente Carratala en un acto de graduación">
      </section>
      <section id="sobremi">
        <h3>Sobre mi</h3>
        <p>Soy Jose Vicente Carratala, un profesional apasionado por la tecnología, la formación y la creatividad digital. A lo largo de mi trayectoria, he trabajado en diversas áreas relacionadas con el desarrollo de software, la enseñanza de programación y la creación de contenidos visuales en 3D. Mi objetivo es ofrecer soluciones innovadoras y efectivas en el mundo de la tecnología y la formación.
</p>
      </section>
      <section id="programacion">
        <h3>Programación</h3>
        <div class="contenedordoscolumnas">
          <img src="port1.jpg">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
      </section>
      <section id="docencia">
        <h3>Docencia</h3>
        <div class="contenedordoscolumnas">
          <img src="port1.jpg">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
      </section>
      <section id="diseno">
        <h3>Diseño</h3>
        <div class="contenedordoscolumnas">
          <img src="port1.jpg">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
      </section>
      <section id="portafolio">
        <h3>Portafolio</h3>
        <div id="contenedor">
          <article>
            <img src="port1.jpg">
            <h4>Titulo 1</h4>
            <p>Descripción</p>
            <a href="https://yaveremoquedireccion.com">Enlace</a>
          </article>
          <article>
            <img src="port1.jpg">
            <h4>Titulo 2</h4>
            <p>Descripción</p>
            <a href="https://yaveremoquedireccion.com">Enlace</a>
          </article>
          <article>
            <img src="port1.jpg">
            <h4>Titulo 3</h4>
            <p>Descripción</p>
            <a href="https://yaveremoquedireccion.com">Enlace</a>
          </article>
          <article>
            <img src="port1.jpg">
            <h4>Titulo 4</h4>
            <p>Descripción</p>
            <a href="https://yaveremoquedireccion.com">Enlace</a>
          </article>
          <article>
            <img src="port1.jpg">
            <h4>Titulo 5</h4>
            <p>Descripción</p>
            <a href="https://yaveremoquedireccion.com">Enlace</a>
          </article>
          <article>
            <img src="port1.jpg">
            <h4>Titulo 6</h4>
            <p>Descripción</p>
            <a href="https://yaveremoquedireccion.com">Enlace</a>
          </article>
        </div>
      </section>
      <section id="contacto">
        <h3>Contacto</h3>
        <div class="contenedor">
          <form>
            <p>Para ponerte en contacto conmigo, envía el siguiente formulario</p>
            <label>Introduce tu nombre</label>
            <input type="text" name="nombre">
            <label>Introduce tu correo electrónico</label>
            <input type="email" name="correoelectronico">
            <label>Introduce tu mensaje</label>
            <textarea name="mensaje">
            </textarea>
            <input type="submit">
          </form>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d659.4964169650499!2d-0.4204511102781017!3d39.47433040541895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd604f9ab80223c9%3A0x27dd1527e8b94444!2sAnytime%20Fitness%20Mislata!5e1!3m2!1ses!2ses!4v1758199441538!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </section>
    </main>
    <footer>
      <a href="https://www.facebook.com/carratala">Facebook</a>
      <a href="https://www.linkedin.com/in/jvcarratala/">LinkedIn</a>
      <a href="https://www.instagram.com/jvcarratala/">Instagram</a>
      <a href="https://www.youtube.com/@VicenteCarratala">Youtube</a>
    </footer>
  </body>
</html>
```

### corregimos la familia de la fuente

```html
<!doctype html>
<html lang="es">
  <head>
    <title>
      Jose Vicente Carratalá Sanchis - Profesor, desarrollador, y diseñador
    </title>
    <meta charset="utf-8">
    <meta name="author" content="Jose Vicente Carratala">
    <meta name="description" content="Soy Jose Vicente Carratala, un profesional apasionado por la tecnología, la formación y la creatividad digital. A lo largo de mi trayectoria, he trabajado en diversas áreas relacionadas con el desarrollo de software, la enseñanza de programación y la creación de contenidos visuales en 3D. Mi objetivo es ofrecer soluciones innovadoras y efectivas en el mundo de la tecnología y la formación.">
    <style>
      /* Aquí voy a poner mis estilos */
      @font-face{
        font-family:Ubuntu;
        src:url("https://static.jocarsa.com/fuuentes/ubuntu-font-family-0.83/Ubuntu-R.ttf");
      }
      @font-face{
        font-family:UbuntuBold;
        src:url("https://static.jocarsa.com/fuuentes/ubuntu-font-family-0.83/Ubuntu-B.ttf");
      }
      body{
        background:WhiteSmoke;
        color:DarkSlateBlue;
        font-family:Ubuntu,sans-serif; /*serif, sans-serif,monospace,cursive,fantasy*/
      }
      header,main,footer{       /* La coma es el selector multiple */
        background:white;       /* El fondo es blanco */
        width:800px;            /* Tiene una anchura de 800px */
        margin:auto;            /* Centrar los margenes */
        padding:40px;           /* El padding es el margen interior */
      }
      main{
        text-align:justify;     /* Justificación del texto no forzada */
      }
      header{
        text-align:center;
      }
      header h1{
        margin:0px;
      }
      header h2{                /* El espacio es el selector hijo */
        font-size:12px;         /* Tamaño de la fuente */
        font-weight:normal;     /* Peso de la fuente */
        margin:0px;
      }
      header nav ul{
        list-style-type:none;   /* No quiero ver los elementos como lista */
        padding:0px;            /* Quito los estilos por defecto */
        margin:0px;             /* Quito los estilos por defecto */
      }
      header nav ul li{
        display:inline-block;   /* Quiero mostrar los elementos uno al lado del otro */
        margin:0px;
        background:DarkSlateBlue;
        font-weight:bold;
        color:white;
        padding:4px;
        font-size:8px;
        text-transform:uppercase;
        margin:0px;
        display:inline-block;
        min-width:50px;
      }
      header nav ul li:first-child{
        border-radius:20px 0px 0px 20px;
      }
      header nav ul li:last-child{
        border-radius:0px 20px 20px 0px;
      }
      header nav ul li a{
        color:inherit;          /* Ponle el color que le tocaría */
        text-decoration:none;   /* No me subrayes el texto */
        
      }
      .contenedor{    /* Estiliza todos los elementos que sean de clase contenedor */
        display:flex;
        gap:20px;
      }
      #contacto .contenedor form{
        flex:1;
        display:flex;
        flex-direction:column;
        gap:10px;
      }
      #contacto .contenedor iframe{
        flex:1;
        
      }
      footer{
        display:flex;
        justify-content: center;
        align-items: center;
        gap:2px;
      }
      footer a{
        text-decoration:none;
        color:white;
        background:DarkSlateBlue;
        padding:5px;
        font-size:10px;
        text-transform:uppercase;
      }
      footer a:first-child{
        border-radius:10px 0px 0px 10px;
      }
      footer a:last-child{
        border-radius:0px 10px 10px 0px;
      }
      #portafolio #contenedor{
        display:grid;
        gap:20px;
        grid-template-columns:auto auto auto;
      }
      #portafolio #contenedor article{
        border:1px solid ghostwhite;
        box-shadow:0px 2px 4px grey;
        padding:20px;
      }
      #portafolio #contenedor article img{
        width:100%;
      }
      .contenedordoscolumnas{
        display:flex;
        gap:20px;
      }
      .contenedordoscolumnas img,.contenedordoscolumnas p{
        flex:1;
      }
      #docencia .contenedordoscolumnas{
        flex-direction: row-reverse;
      }
    </style>
  </head>
  <body>
    <header>
      <h1>Jose Vicente Carratalá Sanchis</h1>
      <h2>Profesor, desarrollador, y diseñador</h2>
      <nav>
        <ul>
          <li><a href="#inicio">Inicio</a></li>
          <li><a href="#sobremi">Sobre mi</a></li>
          <li><a href="#programacion">Programación</a></li>
          <li><a href="#docencia">Docencia</a></li>
          <li><a href="#diseno">Diseño</a></li>
          <li><a href="#portafolio">Portafolio</a></li>
          <li><a href="#contacto">Contacto</a></li>
        </ul>
      </nav>
    </header>
    <main>
      <section id="inicio">
        <h3>Inicio</h3>
        <img src="josevicente.jpeg" alt="Jose Vicente Carratala en un acto de graduación">
      </section>
      <section id="sobremi">
        <h3>Sobre mi</h3>
        <p>Soy Jose Vicente Carratala, un profesional apasionado por la tecnología, la formación y la creatividad digital. A lo largo de mi trayectoria, he trabajado en diversas áreas relacionadas con el desarrollo de software, la enseñanza de programación y la creación de contenidos visuales en 3D. Mi objetivo es ofrecer soluciones innovadoras y efectivas en el mundo de la tecnología y la formación.
</p>
      </section>
      <section id="programacion">
        <h3>Programación</h3>
        <div class="contenedordoscolumnas">
          <img src="port1.jpg">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
      </section>
      <section id="docencia">
        <h3>Docencia</h3>
        <div class="contenedordoscolumnas">
          <img src="port1.jpg">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
      </section>
      <section id="diseno">
        <h3>Diseño</h3>
        <div class="contenedordoscolumnas">
          <img src="port1.jpg">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
      </section>
      <section id="portafolio">
        <h3>Portafolio</h3>
        <div id="contenedor">
          <article>
            <img src="port1.jpg">
            <h4>Titulo 1</h4>
            <p>Descripción</p>
            <a href="https://yaveremoquedireccion.com">Enlace</a>
          </article>
          <article>
            <img src="port1.jpg">
            <h4>Titulo 2</h4>
            <p>Descripción</p>
            <a href="https://yaveremoquedireccion.com">Enlace</a>
          </article>
          <article>
            <img src="port1.jpg">
            <h4>Titulo 3</h4>
            <p>Descripción</p>
            <a href="https://yaveremoquedireccion.com">Enlace</a>
          </article>
          <article>
            <img src="port1.jpg">
            <h4>Titulo 4</h4>
            <p>Descripción</p>
            <a href="https://yaveremoquedireccion.com">Enlace</a>
          </article>
          <article>
            <img src="port1.jpg">
            <h4>Titulo 5</h4>
            <p>Descripción</p>
            <a href="https://yaveremoquedireccion.com">Enlace</a>
          </article>
          <article>
            <img src="port1.jpg">
            <h4>Titulo 6</h4>
            <p>Descripción</p>
            <a href="https://yaveremoquedireccion.com">Enlace</a>
          </article>
        </div>
      </section>
      <section id="contacto">
        <h3>Contacto</h3>
        <div class="contenedor">
          <form>
            <p>Para ponerte en contacto conmigo, envía el siguiente formulario</p>
            <label>Introduce tu nombre</label>
            <input type="text" name="nombre">
            <label>Introduce tu correo electrónico</label>
            <input type="email" name="correoelectronico">
            <label>Introduce tu mensaje</label>
            <textarea name="mensaje">
            </textarea>
            <input type="submit">
          </form>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d659.4964169650499!2d-0.4204511102781017!3d39.47433040541895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd604f9ab80223c9%3A0x27dd1527e8b94444!2sAnytime%20Fitness%20Mislata!5e1!3m2!1ses!2ses!4v1758199441538!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </section>
    </main>
    <footer>
      <a href="https://www.facebook.com/carratala">Facebook</a>
      <a href="https://www.linkedin.com/in/jvcarratala/">LinkedIn</a>
      <a href="https://www.instagram.com/jvcarratala/">Instagram</a>
      <a href="https://www.youtube.com/@VicenteCarratala">Youtube</a>
    </footer>
  </body>
</html>
```

### las imagenes tienen que tener alt

```html
<!doctype html>
<html lang="es">
  <head>
    <title>
      Jose Vicente Carratalá Sanchis - Profesor, desarrollador, y diseñador
    </title>
    <meta charset="utf-8">
    <meta name="author" content="Jose Vicente Carratala">
    <meta name="description" content="Soy Jose Vicente Carratala, un profesional apasionado por la tecnología, la formación y la creatividad digital. A lo largo de mi trayectoria, he trabajado en diversas áreas relacionadas con el desarrollo de software, la enseñanza de programación y la creación de contenidos visuales en 3D. Mi objetivo es ofrecer soluciones innovadoras y efectivas en el mundo de la tecnología y la formación.">
    <style>
      /* Aquí voy a poner mis estilos */
      @font-face{
        font-family:Ubuntu;
        src:url("https://static.jocarsa.com/fuuentes/ubuntu-font-family-0.83/Ubuntu-R.ttf");
      }
      @font-face{
        font-family:UbuntuBold;
        src:url("https://static.jocarsa.com/fuuentes/ubuntu-font-family-0.83/Ubuntu-B.ttf");
      }
      body{
        background:WhiteSmoke;
        color:DarkSlateBlue;
        font-family:Ubuntu,sans-serif; /*serif, sans-serif,monospace,cursive,fantasy*/
      }
      header,main,footer{       /* La coma es el selector multiple */
        background:white;       /* El fondo es blanco */
        width:800px;            /* Tiene una anchura de 800px */
        margin:auto;            /* Centrar los margenes */
        padding:40px;           /* El padding es el margen interior */
      }
      main{
        text-align:justify;     /* Justificación del texto no forzada */
      }
      header{
        text-align:center;
      }
      header h1{
        margin:0px;
      }
      header h2{                /* El espacio es el selector hijo */
        font-size:12px;         /* Tamaño de la fuente */
        font-weight:normal;     /* Peso de la fuente */
        margin:0px;
      }
      header nav ul{
        list-style-type:none;   /* No quiero ver los elementos como lista */
        padding:0px;            /* Quito los estilos por defecto */
        margin:0px;             /* Quito los estilos por defecto */
      }
      header nav ul li{
        display:inline-block;   /* Quiero mostrar los elementos uno al lado del otro */
        margin:0px;
        background:DarkSlateBlue;
        font-weight:bold;
        color:white;
        padding:4px;
        font-size:8px;
        text-transform:uppercase;
        margin:0px;
        display:inline-block;
        min-width:50px;
      }
      header nav ul li:first-child{
        border-radius:20px 0px 0px 20px;
      }
      header nav ul li:last-child{
        border-radius:0px 20px 20px 0px;
      }
      header nav ul li a{
        color:inherit;          /* Ponle el color que le tocaría */
        text-decoration:none;   /* No me subrayes el texto */
        
      }
      .contenedor{    /* Estiliza todos los elementos que sean de clase contenedor */
        display:flex;
        gap:20px;
      }
      #contacto .contenedor form{
        flex:1;
        display:flex;
        flex-direction:column;
        gap:10px;
      }
      #contacto .contenedor iframe{
        flex:1;
        
      }
      footer{
        display:flex;
        justify-content: center;
        align-items: center;
        gap:2px;
      }
      footer a{
        text-decoration:none;
        color:white;
        background:DarkSlateBlue;
        padding:5px;
        font-size:10px;
        text-transform:uppercase;
      }
      footer a:first-child{
        border-radius:10px 0px 0px 10px;
      }
      footer a:last-child{
        border-radius:0px 10px 10px 0px;
      }
      #portafolio #contenedor{
        display:grid;
        gap:20px;
        grid-template-columns:auto auto auto;
      }
      #portafolio #contenedor article{
        border:1px solid ghostwhite;
        box-shadow:0px 2px 4px grey;
        padding:20px;
      }
      #portafolio #contenedor article img{
        width:100%;
      }
      .contenedordoscolumnas{
        display:flex;
        gap:20px;
      }
      .contenedordoscolumnas img,.contenedordoscolumnas p{
        flex:1;
      }
      #docencia .contenedordoscolumnas{
        flex-direction: row-reverse;
      }
    </style>
  </head>
  <body>
    <header>
      <h1>Jose Vicente Carratalá Sanchis</h1>
      <h2>Profesor, desarrollador, y diseñador</h2>
      <nav>
        <ul>
          <li><a href="#inicio">Inicio</a></li>
          <li><a href="#sobremi">Sobre mi</a></li>
          <li><a href="#programacion">Programación</a></li>
          <li><a href="#docencia">Docencia</a></li>
          <li><a href="#diseno">Diseño</a></li>
          <li><a href="#portafolio">Portafolio</a></li>
          <li><a href="#contacto">Contacto</a></li>
        </ul>
      </nav>
    </header>
    <main>
      <section id="inicio">
        <h3>Inicio</h3>
        <img src="josevicente.jpeg" alt="Jose Vicente Carratala en un acto de graduación">
      </section>
      <section id="sobremi">
        <h3>Sobre mi</h3>
        <p>Soy Jose Vicente Carratala, un profesional apasionado por la tecnología, la formación y la creatividad digital. A lo largo de mi trayectoria, he trabajado en diversas áreas relacionadas con el desarrollo de software, la enseñanza de programación y la creación de contenidos visuales en 3D. Mi objetivo es ofrecer soluciones innovadoras y efectivas en el mundo de la tecnología y la formación.
</p>
      </section>
      <section id="programacion">
        <h3>Programación</h3>
        <div class="contenedordoscolumnas">
          <img src="port1.jpg" alt="Imagen de ejemplo de programación">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
      </section>
      <section id="docencia">
        <h3>Docencia</h3>
        <div class="contenedordoscolumnas">
          <img src="port1.jpg" alt="Imagen de ejemplo de docencia">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
      </section>
      <section id="diseno">
        <h3>Diseño</h3>
        <div class="contenedordoscolumnas">
          <img src="port1.jpg" alt="Imagen de ejemplo de diseño">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
      </section>
      <section id="portafolio">
        <h3>Portafolio</h3>
        <div id="contenedor">
          <article>
            <img src="port1.jpg" alt="Imagen de ejemplo del portafolio">
            <h4>Titulo 1</h4>
            <p>Descripción</p>
            <a href="https://yaveremoquedireccion.com">Enlace</a>
          </article>
          <article>
            <img src="port1.jpg" alt="Imagen de ejemplo del portafolio">
            <h4>Titulo 2</h4>
            <p>Descripción</p>
            <a href="https://yaveremoquedireccion.com">Enlace</a>
          </article>
          <article>
            <img src="port1.jpg" alt="Imagen de ejemplo del portafolio">
            <h4>Titulo 3</h4>
            <p>Descripción</p>
            <a href="https://yaveremoquedireccion.com">Enlace</a>
          </article>
          <article>
            <img src="port1.jpg" alt="Imagen de ejemplo del portafolio">
            <h4>Titulo 4</h4>
            <p>Descripción</p>
            <a href="https://yaveremoquedireccion.com">Enlace</a>
          </article>
          <article>
            <img src="port1.jpg" alt="Imagen de ejemplo del portafolio">
            <h4>Titulo 5</h4>
            <p>Descripción</p>
            <a href="https://yaveremoquedireccion.com">Enlace</a>
          </article>
          <article>
            <img src="port1.jpg" alt="Imagen de ejemplo del portafolio">
            <h4>Titulo 6</h4>
            <p>Descripción</p>
            <a href="https://yaveremoquedireccion.com">Enlace</a>
          </article>
        </div>
      </section>
      <section id="contacto">
        <h3>Contacto</h3>
        <div class="contenedor">
          <form>
            <p>Para ponerte en contacto conmigo, envía el siguiente formulario</p>
            <label>Introduce tu nombre</label>
            <input type="text" name="nombre">
            <label>Introduce tu correo electrónico</label>
            <input type="email" name="correoelectronico">
            <label>Introduce tu mensaje</label>
            <textarea name="mensaje">
            </textarea>
            <input type="submit">
          </form>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d659.4964169650499!2d-0.4204511102781017!3d39.47433040541895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd604f9ab80223c9%3A0x27dd1527e8b94444!2sAnytime%20Fitness%20Mislata!5e1!3m2!1ses!2ses!4v1758199441538!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </section>
    </main>
    <footer>
      <a href="https://www.facebook.com/carratala">Facebook</a>
      <a href="https://www.linkedin.com/in/jvcarratala/">LinkedIn</a>
      <a href="https://www.instagram.com/jvcarratala/">Instagram</a>
      <a href="https://www.youtube.com/@VicenteCarratala">Youtube</a>
    </footer>
  </body>
</html>
```

### Segunda validación realizada

```markdown
Podemos validar en: https://validator.w3.org/

Document checking completed. No errors or warnings to show.
```

<a id="lenguajes-de-marcas-para-la-sindicacion-de-contenidos"></a>
## Lenguajes de marcas para la sindicación de contenidos

En el vasto mundo digital de hoy, la capacidad de compartir información de manera eficiente y accesible es un elemento fundamental para cualquier organización o individuo que desee mantener una presencia en línea. Es aquí donde entra en juego el concepto de lenguajes de marcas para la sindicación de contenidos, herramientas poderosas que permiten estructurar y presentar datos de manera coherente y accesible a través de Internet.

El primer paso hacia el dominio de estos lenguajes es entender su naturaleza. Los lenguajes de marcas para la sindicación de contenidos son un tipo específico de lenguaje de marcado que están diseñados para describir y organizar información en una forma que sea fácilmente procesada por los navegadores web y otros sistemas informáticos. Estos lenguajes, como RSS (Really Simple Syndication) y Atom, no solo transmiten datos, sino que también proporcionan metadatos valiosos que ayudan a identificar y clasificar la información de manera eficiente.

La estructura de estos lenguajes es fundamental para su comprensión. Al igual que los otros lenguajes de marcado, como HTML o XML, los lenguajes de sindicación de contenidos están basados en etiquetas que definen el tipo y el contenido de la información. Por ejemplo, en RSS, las etiquetas `<title>`, `<link>` y `<description>` son esenciales para identificar el título del artículo, su ubicación web y una breve descripción del mismo, respectivamente.

La importancia de estos lenguajes no se limita a su capacidad de compartir información. También juegan un papel crucial en la optimización para motores de búsqueda (SEO), ya que proporcionan metadatos relevantes que los motores pueden utilizar para indexar y clasificar el contenido de manera más precisa. Esto es especialmente relevante en el contexto de contenidos actualizados frecuentemente, como noticias o blogs.

Además, los lenguajes de sindicación de contenidos facilitan la creación de portales web dinámicos que pueden mostrar información de múltiples fuentes en un solo lugar. Esta capacidad de integración es fundamental para las plataformas de noticias y blogs, donde el contenido se actualiza constantemente y debe estar disponible rápidamente a los usuarios.

La utilización de estos lenguajes también implica la necesidad de herramientas adecuadas para su creación y gestión. Herramientas como WordPress o Joomla ofrecen interfaces gráficas intuitivas que permiten crear y gestionar fuentes RSS fácilmente, mientras que sistemas más avanzados pueden requerir conocimientos técnicos en XML o JavaScript.

En conclusión, los lenguajes de marcas para la sindicación de contenidos son herramientas esenciales en el arsenal digital moderno. Su capacidad para estructurar y compartir información de manera eficiente, su importancia en el SEO y su facilidad de uso hacen que sean una opción valiosa para cualquier organización o individuo que desee mantener una presencia activa en línea. A través del dominio de estos lenguajes, se abren puertas a la creación de portales web dinámicos, plataformas de noticias actualizadas y sistemas de gestión de contenido eficientes.

### RSS

```markdown
Esta es una tecnología obsoleta de agregadores
Está basada en XML
Presenta la información de nuestra web para los agregadores de noticias

Problema: ya casi no existen y/o no se usan agregadores de noticias
```

### sitemap

```markdown
Es un archivo basado en XML
Contiene la información esencial de la web, resumida
Contiene cada uno de los enlaces
Sobre todo está orientado a Google posicione nuestra página mejor

SEO = Seach Engine Optimization
Optimización en motores de búsqueda
Cómo hacer que nuestra página aparezca la primera en Google
```

### sindicacion

```
<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0">
  <channel>
    <title>Jose Vicente Carratalá Sanchis</title>
    <link>https://www.tudominio.com/</link>
    <description>Profesor, desarrollador, y diseñador</description>
    <language>es-es</language>
    <lastBuildDate>Mon, 29 Sep 2025 12:00:00 +0200</lastBuildDate>

    <item>
      <title>Sobre mí</title>
      <link>https://www.tudominio.com/#sobremi</link>
      <description>Soy Jose Vicente Carratala, un profesional apasionado por la tecnología, la formación y la creatividad digital.</description>
      <pubDate>Mon, 29 Sep 2025 09:00:00 +0200</pubDate>
      <guid>https://www.tudominio.com/#sobremi</guid>
    </item>

    <item>
      <title>Programación</title>
      <link>https://www.tudominio.com/#programacion</link>
      <description>Proyectos y trabajos relacionados con desarrollo de software y programación.</description>
      <pubDate>Mon, 29 Sep 2025 09:10:00 +0200</pubDate>
      <guid>https://www.tudominio.com/#programacion</guid>
    </item>

    <item>
      <title>Docencia</title>
      <link>https://www.tudominio.com/#docencia</link>
      <description>Experiencia y proyectos vinculados a la enseñanza de programación y la formación tecnológica.</description>
      <pubDate>Mon, 29 Sep 2025 09:20:00 +0200</pubDate>
      <guid>https://www.tudominio.com/#docencia</guid>
    </item>

    <item>
      <title>Diseño</title>
      <link>https://www.tudominio.com/#diseno</link>
      <description>Trabajos y ejemplos en diseño digital y creatividad visual.</description>
      <pubDate>Mon, 29 Sep 2025 09:30:00 +0200</pubDate>
      <guid>https://www.tudominio.com/#diseno</guid>
    </item>

    <item>
      <title>Portafolio - Título 1</title>
      <link>https://yaveremoquedireccion.com</link>
      <description>Descripción</description>
      <pubDate>Mon, 29 Sep 2025 09:40:00 +0200</pubDate>
      <guid>https://yaveremoquedireccion.com</guid>
    </item>

    <item>
      <title>Portafolio - Título 2</title>
      <link>https://yaveremoquedireccion.com</link>
      <description>Descripción</description>
      <pubDate>Mon, 29 Sep 2025 09:50:00 +0200</pubDate>
      <guid>https://yaveremoquedireccion.com</guid>
    </item>

    <item>
      <title>Portafolio - Título 3</title>
      <link>https://yaveremoquedireccion.com</link>
      <description>Descripción</description>
      <pubDate>Mon, 29 Sep 2025 10:00:00 +0200</pubDate>
      <guid>https://yaveremoquedireccion.com</guid>
    </item>

  </channel>
</rss>
```

### sitemap

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

  <!-- Página principal -->
  <url>
    <loc>https://www.jocarsa.com/</loc>
    <lastmod>2025-09-29</lastmod>
    <changefreq>weekly</changefreq>
    <priority>1.0</priority>
  </url>

  <!-- Secciones -->
  <url>
    <loc>https://www.jocarsa.com/#sobremi</loc>
    <lastmod>2025-09-29</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>https://www.jocarsa.com/#programacion</loc>
    <lastmod>2025-09-29</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>https://www.jocarsa.com/#docencia</loc>
    <lastmod>2025-09-29</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>https://www.jocarsa.com/#diseno</loc>
    <lastmod>2025-09-29</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>https://www.jocarsa.com/#portafolio</loc>
    <lastmod>2025-09-29</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.9</priority>
  </url>
  <url>
    <loc>https://www.jocarsa.com/#contacto</loc>
    <lastmod>2025-09-29</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
  </url>

  <!-- Portafolio -->
  <url>
    <loc>https://jocarsa.com</loc>
    <lastmod>2025-09-29</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.5</priority>
  </url>

</urlset>
```

<a id="ejercicio-curriculum"></a>
## Ejercicio curriculum

### plantilla curriculum

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Curriculum Jose Vicente Carratala</title>
    <meta charset="utf-8">
  </head>
  <body>
    <main>
      <section id="izquierda">
      </section>
      <section id="derecha">
      </section>
    </main>
  </body>
</html>
```

### dos secciones

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Curriculum Jose Vicente Carratala</title>
    <meta charset="utf-8">
  </head>
  <body>
    <main>
      <section id="izquierda">
      </section>
      <section id="derecha">
      </section>
    </main>
  </body>
</html>
```

### articulos en la izquierda

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Curriculum Jose Vicente Carratala</title>
    <meta charset="utf-8">
  </head>
  <body>
    <main>
      <section id="izquierda">
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
      </section>
      <section id="derecha">
      </section>
    </main>
  </body>
</html>
```

### listas con elementos

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Curriculum Jose Vicente Carratala</title>
    <meta charset="utf-8">
  </head>
  <body>
    <main>
      <section id="izquierda">
        <img src="josevicente.jpg" alt="Fotografia">
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
      </section>
      <section id="derecha">
      </section>
    </main>
  </body>
</html>
```

### un poco de estilo

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Curriculum Jose Vicente Carratala</title>
    <meta charset="utf-8">
    <style>
      body,html{background:black;}
      main{width:600px;background:white;margin:auto;padding:20px;}
    </style>
  </head>
  <body>
    <main>
      <section id="izquierda">
        <img src="josevicente.jpg" alt="Fotografia">
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
      </section>
      <section id="derecha">
      </section>
    </main>
  </body>
</html>
```

### un poco de estilo para la foto

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Curriculum Jose Vicente Carratala</title>
    <meta charset="utf-8">
    <style>
      body,html{background:black;}
      main{width:600px;background:white;margin:auto;display:flex;}
      #izquierda img{border-radius:400px;}
      #izquierda{background:indigo;flex:1;padding:20px;color:white;}
      #derecha{flex:3;}
    </style>
  </head>
  <body>
    <main>
      <section id="izquierda">
        <img src="josevicente.jpg" alt="Fotografia">
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
      </section>
      <section id="derecha">
      </section>
    </main>
  </body>
</html>
```

### familia de fuentes

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Curriculum Jose Vicente Carratala</title>
    <meta charset="utf-8">
    <style>
      body,html{background:black;}
      main{width:600px;background:white;margin:auto;display:flex;font-family:sans-serif;}
      #izquierda img{border-radius:400px;}
      #izquierda{background:indigo;flex:1;padding:20px;color:white;}
      #derecha{flex:3;}
    </style>
  </head>
  <body>
    <main>
      <section id="izquierda">
        <img src="josevicente.jpg" alt="Fotografia">
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
      </section>
      <section id="derecha">
      </section>
    </main>
  </body>
</html>
```

### parte derecha

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Curriculum Jose Vicente Carratala</title>
    <meta charset="utf-8">
    <style>
      body,html{background:black;}
      main{width:600px;background:white;margin:auto;display:flex;font-family:sans-serif;}
      #izquierda img{border-radius:400px;}
      #izquierda{background:indigo;flex:1;padding:20px;color:white;}
      #derecha{flex:3;}
    </style>
  </head>
  <body>
    <main>
      <section id="izquierda">
        <img src="josevicente.jpg" alt="Fotografia">
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
      </section>
      <section id="derecha">
        <h1>Jose Vicente Carratalá Sanchis</h1>
        <section id="datospersonales">
          <ul>
            <li>Dato de contacto</li>
            <li>Dato de contacto</li>
            <li>Dato de contacto</li>
          </ul>
        </section>
        <section id="resumenprofesional">
          <h2>Resumen profesional</h2>
          <p>Lorem ipsum</p>
        </section>
        <section id="historiallaboral">
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
        </section>
        <section id="formacion">
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
        </section>
      </section>
      
    </main>
  </body>
</html>
```

### margen

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Curriculum Jose Vicente Carratala</title>
    <meta charset="utf-8">
    <style>
      body,html{background:black;}
      main{width:600px;background:white;margin:auto;display:flex;font-family:sans-serif;}
      #izquierda img{border-radius:400px;}
      #izquierda{background:indigo;flex:1;padding:20px;color:white;}
      #derecha{flex:3;padding:20px;}
    </style>
  </head>
  <body>
    <main>
      <section id="izquierda">
        <img src="josevicente.jpg" alt="Fotografia">
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
      </section>
      <section id="derecha">
        <h1>Jose Vicente Carratalá Sanchis</h1>
        <section id="datospersonales">
          <ul>
            <li>Dato de contacto</li>
            <li>Dato de contacto</li>
            <li>Dato de contacto</li>
          </ul>
        </section>
        <section id="resumenprofesional">
          <h2>Resumen profesional</h2>
          <p>Lorem ipsum</p>
        </section>
        <section id="historiallaboral">
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
        </section>
        <section id="formacion">
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
        </section>
      </section>
      
    </main>
  </body>
</html>
```

### css reset

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Curriculum Jose Vicente Carratala</title>
    <meta charset="utf-8">
    <style>
      *{margin:0px;padding:0px;}
      body,html{background:black;}
      main{width:600px;background:white;margin:auto;display:flex;font-family:sans-serif;}
      #izquierda img{border-radius:400px;}
      #izquierda{background:indigo;flex:1;padding:20px;color:white;}
      #derecha{flex:3;padding:20px;}
    </style>
  </head>
  <body>
    <main>
      <section id="izquierda">
        <img src="josevicente.jpg" alt="Fotografia">
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
      </section>
      <section id="derecha">
        <h1>Jose Vicente Carratalá Sanchis</h1>
        <section id="datospersonales">
          <ul>
            <li>Dato de contacto</li>
            <li>Dato de contacto</li>
            <li>Dato de contacto</li>
          </ul>
        </section>
        <section id="resumenprofesional">
          <h2>Resumen profesional</h2>
          <p>Lorem ipsum</p>
        </section>
        <section id="historiallaboral">
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
        </section>
        <section id="formacion">
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
        </section>
      </section>
      
    </main>
  </body>
</html>
```

### linea separadora en articulos

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Curriculum Jose Vicente Carratala</title>
    <meta charset="utf-8">
    <style>
      *{margin:0px;padding:0px;}
      body,html{background:black;}
      main{width:600px;background:white;margin:auto;display:flex;font-family:sans-serif;}
      #izquierda img{border-radius:400px;}
      #izquierda{background:indigo;flex:1;padding:20px;color:white;}
      #derecha{flex:3;padding:20px;}
      #derecha article{border-bottom:1px solid indigo;}
      #izquierda article{border-bottom:1px solid white;}
    </style>
  </head>
  <body>
    <main>
      <section id="izquierda">
        <img src="josevicente.jpg" alt="Fotografia">
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
      </section>
      <section id="derecha">
        <h1>Jose Vicente Carratalá Sanchis</h1>
        <section id="datospersonales">
          <ul>
            <li>Dato de contacto</li>
            <li>Dato de contacto</li>
            <li>Dato de contacto</li>
          </ul>
        </section>
        <section id="resumenprofesional">
          <h2>Resumen profesional</h2>
          <p>Lorem ipsum</p>
        </section>
        <section id="historiallaboral">
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
        </section>
        <section id="formacion">
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
        </section>
      </section>
      
    </main>
  </body>
</html>
```

### bajar tamaño de texto

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Curriculum Jose Vicente Carratala</title>
    <meta charset="utf-8">
    <style>
      *{margin:0px;padding:0px;}
      body,html{background:black;font-size:11px;}
      main{width:600px;background:white;margin:auto;display:flex;font-family:sans-serif;}
      #izquierda img{border-radius:400px;}
      #izquierda{background:indigo;flex:1;padding:20px;color:white;}
      #derecha{flex:3;padding:20px;}
      #derecha article{border-bottom:1px solid indigo;}
      #izquierda article{border-bottom:1px solid white;}
    </style>
  </head>
  <body>
    <main>
      <section id="izquierda">
        <img src="josevicente.jpg" alt="Fotografia">
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
      </section>
      <section id="derecha">
        <h1>Jose Vicente Carratalá Sanchis</h1>
        <section id="datospersonales">
          <ul>
            <li>Dato de contacto</li>
            <li>Dato de contacto</li>
            <li>Dato de contacto</li>
          </ul>
        </section>
        <section id="resumenprofesional">
          <h2>Resumen profesional</h2>
          <p>Lorem ipsum</p>
        </section>
        <section id="historiallaboral">
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
        </section>
        <section id="formacion">
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
        </section>
      </section>
      
    </main>
  </body>
</html>
```

### mas margen interior

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Curriculum Jose Vicente Carratala</title>
    <meta charset="utf-8">
    <style>
      *{margin:0px;padding:0px;}
      body,html{background:black;font-size:11px;}
      main{width:600px;background:white;margin:auto;display:flex;font-family:sans-serif;}
      #izquierda img{border-radius:400px;}
      #izquierda{background:indigo;flex:1;padding:40px;color:white;}
      #derecha{flex:3;padding:40px;}
      #derecha article{border-bottom:1px solid indigo;}
      #izquierda article{border-bottom:1px solid white;}
    </style>
  </head>
  <body>
    <main>
      <section id="izquierda">
        <img src="josevicente.jpg" alt="Fotografia">
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
      </section>
      <section id="derecha">
        <h1>Jose Vicente Carratalá Sanchis</h1>
        <section id="datospersonales">
          <ul>
            <li>Dato de contacto</li>
            <li>Dato de contacto</li>
            <li>Dato de contacto</li>
          </ul>
        </section>
        <section id="resumenprofesional">
          <h2>Resumen profesional</h2>
          <p>Lorem ipsum</p>
        </section>
        <section id="historiallaboral">
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
        </section>
        <section id="formacion">
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
        </section>
      </section>
      
    </main>
  </body>
</html>
```

### subtitulo

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Curriculum Jose Vicente Carratala</title>
    <meta charset="utf-8">
    <style>
      *{margin:0px;padding:0px;}
      body,html{background:black;font-size:11px;}
      main{width:600px;background:white;margin:auto;display:flex;font-family:sans-serif;}
      #izquierda img{border-radius:400px;}
      #izquierda{background:indigo;flex:1;padding:40px;color:white;}
      #derecha{flex:3;padding:40px;}
      #derecha article{border-bottom:1px solid indigo;}
      #izquierda article{border-bottom:1px solid white;}
    </style>
  </head>
  <body>
    <main>
      <section id="izquierda">
        <img src="josevicente.jpg" alt="Fotografia">
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
      </section>
      <section id="derecha">
        <h1>Jose Vicente Carratalá Sanchis</h1>
        <h2>Desarrollador, profesor y diseñador</h2>
        <section id="datospersonales">
          <ul>
            <li>Dato de contacto</li>
            <li>Dato de contacto</li>
            <li>Dato de contacto</li>
          </ul>
        </section>
        <section id="resumenprofesional">
          <h2>Resumen profesional</h2>
          <p>Lorem ipsum</p>
        </section>
        <section id="historiallaboral">
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
        </section>
        <section id="formacion">
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
        </section>
      </section>
      
    </main>
  </body>
</html>
```

### flexbos

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Curriculum Jose Vicente Carratala</title>
    <meta charset="utf-8">
    <style>
      *{margin:0px;padding:0px;}
      body,html{background:black;font-size:11px;}
      main{width:600px;background:white;margin:auto;display:flex;font-family:sans-serif;}
      #izquierda img{border-radius:400px;}
      #izquierda{background:indigo;flex:1;padding:40px;color:white;}
      #derecha{flex:3;padding:40px;}
      #derecha article{border-bottom:1px solid indigo;}
      #izquierda article{border-bottom:1px solid white;}
    </style>
  </head>
  <body>
    <main>
      <section id="izquierda">
        <img src="josevicente.jpg" alt="Fotografia">
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
      </section>
      <section id="derecha">
        <h1>Jose Vicente Carratalá Sanchis</h1>
        <h2>Desarrollador, profesor y diseñador</h2>
        <section id="datospersonales">
          <ul>
            <li>Dato de contacto</li>
            <li>Dato de contacto</li>
            <li>Dato de contacto</li>
          </ul>
        </section>
        <section id="resumenprofesional">
          <h2>Resumen profesional</h2>
          <p>Lorem ipsum</p>
        </section>
        <section id="historiallaboral">
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
        </section>
        <section id="formacion">
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
        </section>
      </section>
      
    </main>
  </body>
</html>
```

### flexbox

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Curriculum Jose Vicente Carratala</title>
    <meta charset="utf-8">
    <style>
      *{margin:0px;padding:0px;}
      body,html{background:black;font-size:11px;}
      main{width:600px;background:white;margin:auto;display:flex;font-family:sans-serif;}
      #izquierda img{border-radius:400px;}
      #izquierda{background:indigo;flex:1;padding:40px;color:white;}
      #derecha{flex:3;padding:40px;}
      #derecha article{border-bottom:1px solid indigo;}
      #izquierda article{border-bottom:1px solid white;}
      #izquierda,#derecha,#historiallaboral,#formacion{display:flex;flex-direction:column;gap:20px;}
    </style>
  </head>
  <body>
    <main>
      <section id="izquierda">
        <img src="josevicente.jpg" alt="Fotografia">
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
        <article>
          <h3>Titulo</h3>
          <ul>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
            <li>Elemento</li>
          </ul>
        </article>
      </section>
      <section id="derecha">
        <h1>Jose Vicente Carratalá Sanchis</h1>
        <h2>Desarrollador, profesor y diseñador</h2>
        <section id="datospersonales">
          <ul>
            <li>Dato de contacto</li>
            <li>Dato de contacto</li>
            <li>Dato de contacto</li>
          </ul>
        </section>
        <section id="resumenprofesional">
          <h2>Resumen profesional</h2>
          <p>Lorem ipsum</p>
        </section>
        <section id="historiallaboral">
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Empresa</h4>
            <p>Localidad</p>
            <p>Cargo</p>
            <ul>
              <li>Responsabilidad 1</li>
              <li>Responsabilidad 2</li>
              <li>Responsabilidad 3</li>
              <li>Responsabilidad 4</li>
            </ul>
          </article>
        </section>
        <section id="formacion">
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
          <article>
            <p>Inicio - final</p>
            <h4>Titulo</h4>
            <p>Entidad</p>
          </article>
        </section>
      </section>
      
    </main>
  </body>
</html>
```

<a id="simulacro-examen-1"></a>
## Simulacro examen 1

### cv

```html
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Currículum Vitae</title>
    </head>
    <body>
        <div id="izquierda">
            <img src="foto.jpg" alt="Foto de perfil" width="150">

        </div>
        <div id="derecha">
        <h1>Jose Vicente Carratalá Sanchis</h1>
        <h2>Profesor, desarrollador y diseñador</h2>
        </div>
    </body>
    
</html>
```

### un poco de css

```html
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Currículum Vitae</title>
        <style>
            body{
                width:210mm;
                height:297mm;
            }
            /* Quiero maquetar con flexbox */
            body{
                display:flex;
                flex-direction:row;
                align-items:top;
                justify-content:center;
            }  
            #izquierda{
                flex:1;
                text-align:center;
            }
            #derecha{
                flex:2;
                padding-left:20px;
            }
        </style>
    </head>
    <body>
        <div id="izquierda">
            <img src="foto.jpg" alt="Foto de perfil" width="150">

        </div>
        <div id="derecha">
        <h1>Jose Vicente Carratalá Sanchis</h1>
        <h2>Profesor, desarrollador y diseñador</h2>
        </div>
    </body>
    
</html>
```

### imagen de fondo

```html
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Currículum Vitae</title>
        <style>
            main{
                width:210mm;
                height:297mm;
                margin:auto;
            }
            /* Quiero maquetar con flexbox */
            main{
                display:flex;
                flex-direction:row;
                align-items:top;
                justify-content:center;
                background: url(fondocv.jpg) no-repeat center center;
            }  
            #izquierda{
                flex:1;
                text-align:center;
            }
            #derecha{
                flex:2;
                padding-left:20px;
            }
        </style>
    </head>
    <body>
        <main>
            <div id="izquierda">
                <img src="foto.jpg" alt="Foto de perfil" width="150">

            </div>
            <div id="derecha">
                <h1>Jose Vicente Carratalá Sanchis</h1>
                <h2>Profesor, desarrollador y diseñador</h2>
            </div>
        </main>
    </body>
    
</html>
```

### tamaño del fono

```html
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Currículum Vitae</title>
        <style>
            main{
                width:210mm;
                height:297mm;
                margin:auto;
            }
            /* Quiero maquetar con flexbox */
            main{
                display:flex;
                flex-direction:row;
                align-items:top;
                justify-content:center;
                background: url(fondocv.jpg) no-repeat center center;
                background-size: 100% 100%;
            }  
            #izquierda{
                flex:1;
                text-align:center;
            }
            #derecha{
                flex:2;
                padding-left:20px;
            }
        </style>
    </head>
    <body>
        <main>
            <div id="izquierda">
                <img src="foto.jpg" alt="Foto de perfil" width="150">

            </div>
            <div id="derecha">
                <h1>Jose Vicente Carratalá Sanchis</h1>
                <h2>Profesor, desarrollador y diseñador</h2>
            </div>
        </main>
    </body>
    
</html>
```

### imagen en el sitio correcto

```html
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Currículum Vitae</title>
        <style>
            main{
                width:210mm;
                height:297mm;
                margin:auto;
            }
            /* Quiero maquetar con flexbox */
            main{
                display:flex;
                flex-direction:row;
                align-items:top;
                justify-content:center;
                background: url(fondocv.jpg) no-repeat center center;
                background-size: 100% 100%;
            }  
            #izquierda{
                flex:1;
                text-align:center;
            }
            #derecha{
                flex:2;
                padding-left:20px;
            }
            #izquierda img{
                border-radius:50%;
                border:5px solid white;
                transform: translate(55px, 95px);
                width: 189px;
            }
        </style>
    </head>
    <body>
        <main>
            <div id="izquierda">
                <img src="josevicente.jpg" alt="Foto de perfil" width="150">

            </div>
            <div id="derecha">
                <h1>Jose Vicente Carratalá Sanchis</h1>
                <h2>Profesor, desarrollador y diseñador</h2>
            </div>
        </main>
    </body>
    
</html>
```

### titulos

```html
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Currículum Vitae</title>
        <style>
            main{
                width:210mm;
                height:297mm;
                margin:auto;
            }
            /* Quiero maquetar con flexbox */
            main{
                display:flex;
                flex-direction:row;
                align-items:top;
                justify-content:center;
                background: url(fondocv.jpg) no-repeat center center;
                background-size: 100% 100%;
                font-family:sans-serif;
            }  
            #izquierda{
                flex:1;
                text-align:center;
            }
            #derecha{
                flex:2;
                padding-left:20px;
            }
            #izquierda img{
                border-radius:50%;
                border:5px solid white;
                transform: translate(55px, 95px);
                width: 189px;
            }
            h1,h2{
                text-align:center;
                text-transform:uppercase;
                color:#5c105a;
            }
            h2{
                font-size:12px;
            }
            h1{
                margin-top:50px;
            }
        </style>
    </head>
    <body>
        <main>
            <div id="izquierda">
                <img src="josevicente.jpg" alt="Foto de perfil" width="150">

            </div>
            <div id="derecha">
                <h1>Jose Vicente <br>Carratalá Sanchis</h1>
                <h2>Profesor, desarrollador y diseñador</h2>
            </div>
        </main>
    </body>
    
</html>
```

### parte izquierda

```html
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Currículum Vitae</title>
        <style>
            main{
                width:210mm;
                height:297mm;
                margin:auto;
            }
            /* Quiero maquetar con flexbox */
            main{
                display:flex;
                flex-direction:row;
                align-items:top;
                justify-content:center;
                background: url(fondocv.jpg) no-repeat center center;
                background-size: 100% 100%;
                font-family:sans-serif;
            }  
            #izquierda{
                flex:1;
                text-align:center;
            }
            #derecha{
                flex:2;
                padding-left:20px;
            }
            #izquierda img{
                border-radius:50%;
                border:5px solid white;
                transform: translate(55px, 95px);
                width: 189px;
            }
            h1,h2{
                text-align:center;
                text-transform:uppercase;
                color:#5c105a;
            }
            h2{
                font-size:12px;
            }
            h1{
                margin-top:50px;
            }
        </style>
    </head>
    <body>
        <main>
            <div id="izquierda">
                <img src="josevicente.jpg" alt="Foto de perfil" width="150">
                <ul>
                    <li>Fecha de nacimiento: 14/04/1978</li>
                    <li>Edad: 47</li>
                    <li>Nacionalidad: Española</li>
                </ul>
                <article>
                    <h2>Contacto</h2>
                    <p>Dirección: Calle Falsa 123, Ciudad, País</p>
                    <p>Teléfono: +34 123 456 789</p>
                    <p>Email:
                </article>
                <article>
                    <h2>Habilidades</h2>
                    <ul>
                        <li>HTML5, CSS3, JavaScript</li>
                        <li>Diseño responsivo</li>
                        <li>Gestión de proyectos</li>
                    </ul>
                </article>
                <article>
                    <h2>Idiomas</h2>
                    <ul>
                        <li>Español: Nativo</li>
                        <li>Inglés: Avanzado</li>
                        <li>Francés: Intermedio</li>
                    </ul>
                </article>
            </div>
            <div id="derecha">
                <h1>Jose Vicente <br>Carratalá Sanchis</h1>
                <h2>Profesor, desarrollador y diseñador</h2>
            </div>
        </main>
    </body>
    
</html>
```

### parte derecha

```html
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Currículum Vitae</title>
        <style>
            main{
                width:210mm;
                height:297mm;
                margin:auto;
            }
            /* Quiero maquetar con flexbox */
            main{
                display:flex;
                flex-direction:row;
                align-items:top;
                justify-content:center;
                background: url(fondocv.jpg) no-repeat center center;
                background-size: 100% 100%;
                font-family:sans-serif;
            }  
            #izquierda{
                flex:1;
                text-align:center;
            }
            #derecha{
                flex:2;
                padding-left:20px;
            }
            #izquierda img{
                border-radius:50%;
                border:5px solid white;
                transform: translate(55px, 95px);
                width: 189px;
            }
            h1,h2{
                text-align:center;
                text-transform:uppercase;
                color:#5c105a;
            }
            h2{
                font-size:12px;
            }
            h1{
                margin-top:50px;
            }
        </style>
    </head>
    <body>
        <main>
            <div id="izquierda">
                <img src="josevicente.jpg" alt="Foto de perfil" width="150">
                <ul>
                    <li>Fecha de nacimiento: 14/04/1978</li>
                    <li>Edad: 47</li>
                    <li>Nacionalidad: Española</li>
                </ul>
                <article>
                    <h2>Contacto</h2>
                    <p>Dirección: Calle Falsa 123, Ciudad, País</p>
                    <p>Teléfono: +34 123 456 789</p>
                    <p>Email:
                </article>
                <article>
                    <h2>Habilidades</h2>
                    <ul>
                        <li>HTML5, CSS3, JavaScript</li>
                        <li>Diseño responsivo</li>
                        <li>Gestión de proyectos</li>
                    </ul>
                </article>
                <article>
                    <h2>Idiomas</h2>
                    <ul>
                        <li>Español: Nativo</li>
                        <li>Inglés: Avanzado</li>
                        <li>Francés: Intermedio</li>
                    </ul>
                </article>
            </div>
            <div id="derecha">
                <h1>Jose Vicente <br>Carratalá Sanchis</h1>
                <h2>Profesor, desarrollador y diseñador</h2>
                <h3>Sobre mi</h3>
                <p>Soy un profesional con más de 20 años de experiencia en el desarrollo web y la enseñanza. Me apasiona crear soluciones innovadoras y compartir mis conocimientos con otros.</p>
                <h3>Formación Académica</h3>
                <ul>
                    <li>Grado en Ingeniería Informática - Universidad de Valencia (2000-2004)</li>
                    <li>Máster en Desarrollo Web - Universidad Politécnica de Madrid (2005-2006)</li>
                </ul>
                <h3>Experiencia Profesional</h3>
                <ul>
                    <li>Profesor de Desarrollo Web - Instituto Tecnológico de Valencia (2010-presente)</li>
                    <li>Desarrollador Web Freelance (2006-2010)</li>
                </ul>
                <h3>Proyectos Destacados</h3>
                <ul>
                    <li>Desarrollo de una plataforma de e-learning para una universidad local.</li>
                    <li>Diseño y desarrollo de sitios web para pequeñas y medianas empresas.</li>
                </ul>
                <h3>Referencias</h3>
                <p>Disponibles a solicitud.</p> 
            </div>
        </main>
    </body>
    
</html>
```

### distancia con gap

```html
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Currículum Vitae</title>
        <style>
            main{
                width:210mm;
                height:297mm;
                margin:auto;
            }
            /* Quiero maquetar con flexbox */
            main{
                display:flex;
                flex-direction:row;
                align-items:top;
                justify-content:center;
                background: url(fondocv.jpg) no-repeat center center;
                background-size: 100% 100%;
                font-family:sans-serif;
                gap:100px;
            }  
            #izquierda{
                flex:1;
                text-align:center;
            }
            #derecha{
                flex:2;
                padding-left:20px;
            }
            #izquierda img{
                border-radius:50%;
                border:5px solid white;
                transform: translate(55px, 95px);
                width: 189px;
            }
            h1,h2{
                text-align:center;
                text-transform:uppercase;
                color:#5c105a;
            }
            h2{
                font-size:12px;
                margin-bottom:120px;
            }
            h1{
                margin-top:50px;
            }
        </style>
    </head>
    <body>
        <main>
            <div id="izquierda">
                <img src="josevicente.jpg" alt="Foto de perfil" width="150">
                <ul>
                    <li>Fecha de nacimiento: 14/04/1978</li>
                    <li>Edad: 47</li>
                    <li>Nacionalidad: Española</li>
                </ul>
                <article>
                    <h2>Contacto</h2>
                    <p>Dirección: Calle Falsa 123, Ciudad, País</p>
                    <p>Teléfono: +34 123 456 789</p>
                    <p>Email:
                </article>
                <article>
                    <h2>Habilidades</h2>
                    <ul>
                        <li>HTML5, CSS3, JavaScript</li>
                        <li>Diseño responsivo</li>
                        <li>Gestión de proyectos</li>
                    </ul>
                </article>
                <article>
                    <h2>Idiomas</h2>
                    <ul>
                        <li>Español: Nativo</li>
                        <li>Inglés: Avanzado</li>
                        <li>Francés: Intermedio</li>
                    </ul>
                </article>
            </div>
            <div id="derecha">
                <h1>Jose Vicente <br>Carratalá Sanchis</h1>
                <h2>Profesor, desarrollador y diseñador</h2>
                <h3>Sobre mi</h3>
                <p>Soy un profesional con más de 20 años de experiencia en el desarrollo web y la enseñanza. Me apasiona crear soluciones innovadoras y compartir mis conocimientos con otros.</p>
                <h3>Formación Académica</h3>
                <ul>
                    <li>Grado en Ingeniería Informática - Universidad de Valencia (2000-2004)</li>
                    <li>Máster en Desarrollo Web - Universidad Politécnica de Madrid (2005-2006)</li>
                </ul>
                <h3>Experiencia Profesional</h3>
                <ul>
                    <li>Profesor de Desarrollo Web - Instituto Tecnológico de Valencia (2010-presente)</li>
                    <li>Desarrollador Web Freelance (2006-2010)</li>
                </ul>
                <h3>Proyectos Destacados</h3>
                <ul>
                    <li>Desarrollo de una plataforma de e-learning para una universidad local.</li>
                    <li>Diseño y desarrollo de sitios web para pequeñas y medianas empresas.</li>
                </ul>
                <h3>Referencias</h3>
                <p>Disponibles a solicitud.</p> 
            </div>
        </main>
    </body>
    
</html>
```

### margen interior

```html
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Currículum Vitae</title>
        <style>
            main{
                width:210mm;
                height:297mm;
                margin:auto;
            }
            /* Quiero maquetar con flexbox */
            main{
                display:flex;
                flex-direction:row;
                align-items:top;
                justify-content:center;
                background: url(fondocv.jpg) no-repeat center center;
                background-size: 100% 100%;
                font-family:sans-serif;
                gap:130px;
                padding:50px;
                 color:#5c105a;
            }  
            #izquierda{
                flex:1;
                text-align:left;
            }
            #derecha{
                flex:2;
                padding-left:20px;
            }
            #izquierda img{
                border-radius:50%;
                border:5px solid white;
                transform: translate(55px, 95px);
                width: 189px;
            }
            h1,h2{
                text-align:center;
                text-transform:uppercase;
               
            }
            h2{
                font-size:12px;
                margin-bottom:120px;
            }
            h1{
                margin-top:50px;
            }
            h3{
                /* Quiero el texto en negrita */
                font-weight:bold;
                /* Y ahora quiero todo mayusculas */
                text-transform:uppercase;
                font-size:30px;
            }
        </style>
    </head>
    <body>
        <main>
            <div id="izquierda">
                <img src="josevicente.jpg" alt="Foto de perfil" width="150">
                <ul>
                    <li>Fecha de nacimiento: 14/04/1978</li>
                    <li>Edad: 47</li>
                    <li>Nacionalidad: Española</li>
                </ul>
                <article>
                    <h2>Contacto</h2>
                    <p>Dirección: Calle Falsa 123, Ciudad, País</p>
                    <p>Teléfono: +34 123 456 789</p>
                    <p>Email:
                </article>
                <article>
                    <h2>Habilidades</h2>
                    <ul>
                        <li>HTML5, CSS3, JavaScript</li>
                        <li>Diseño responsivo</li>
                        <li>Gestión de proyectos</li>
                    </ul>
                </article>
                <article>
                    <h2>Idiomas</h2>
                    <ul>
                        <li>Español: Nativo</li>
                        <li>Inglés: Avanzado</li>
                        <li>Francés: Intermedio</li>
                    </ul>
                </article>
            </div>
            <div id="derecha">
                <h1>Jose Vicente <br>Carratalá Sanchis</h1>
                <h2>Profesor, desarrollador y diseñador</h2>
                <h3>Sobre mi</h3>
                <p>Soy un profesional con más de 20 años de experiencia en el desarrollo web y la enseñanza. Me apasiona crear soluciones innovadoras y compartir mis conocimientos con otros.</p>
                <h3>Formación Académica</h3>
                <ul>
                    <li>Grado en Ingeniería Informática - Universidad de Valencia (2000-2004)</li>
                    <li>Máster en Desarrollo Web - Universidad Politécnica de Madrid (2005-2006)</li>
                </ul>
                <h3>Experiencia Profesional</h3>
                <ul>
                    <li>Profesor de Desarrollo Web - Instituto Tecnológico de Valencia (2010-presente)</li>
                    <li>Desarrollador Web Freelance (2006-2010)</li>
                </ul>
                <h3>Proyectos Destacados</h3>
                <ul>
                    <li>Desarrollo de una plataforma de e-learning para una universidad local.</li>
                    <li>Diseño y desarrollo de sitios web para pequeñas y medianas empresas.</li>
                </ul>
                <h3>Referencias</h3>
                <p>Disponibles a solicitud.</p> 
            </div>
        </main>
    </body>
    
</html>
```

### editando la parte izquierda

```html
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Currículum Vitae</title>
        <style>
            main{
                width:210mm;
                height:297mm;
                margin:auto;
            }
            /* Quiero maquetar con flexbox */
            main{
                display:flex;
                flex-direction:row;
                align-items:top;
                justify-content:center;
                background: url(fondocv.jpg) no-repeat center center;
                background-size: 100% 100%;
                font-family:sans-serif;
                gap:130px;
                padding:50px;
                 color:#5c105a;
            }  
            #izquierda{
                flex:1;
                text-align:left;
            }
            #derecha{
                flex:2;
                padding-left:20px;
            }
            #izquierda img{
                border-radius:50%;
                border:5px solid white;
                transform: translate(69px, 63px);
                width: 189px;
            }
            #izquierda>ul{
                list-style:none;
                padding:0;
                margin-top:150px;
                margin-bottom:50px;
            }
            h1,h2{
                text-align:center;
                text-transform:uppercase;
               
            }
            h2{
                font-size:12px;
                margin-bottom:120px;
            }
            h1{
                margin-top:50px;
            }
            h3{
                /* Quiero el texto en negrita */
                font-weight:bold;
                /* Y ahora quiero todo mayusculas */
                text-transform:uppercase;
                font-size:30px;
            }
        </style>
    </head>
    <body>
        <main>
            <div id="izquierda">
                <img src="josevicente.jpg" alt="Foto de perfil" width="150">
                <ul>
                    <li>Fecha de nacimiento: 14/04/1978</li>
                    <li>Edad: 47</li>
                    <li>Nacionalidad: Española</li>
                </ul>
                <article>
                    <h3>Contacto</h3>
                    <p>Dirección: Calle Falsa 123, Ciudad, País</p>
                    <p>Teléfono: +34 123 456 789</p>
                    <p>Email:
                </article>
                <article>
                    <h3>Habilidades</h3>
                    <ul>
                        <li>HTML5, CSS3, JavaScript</li>
                        <li>Diseño responsivo</li>
                        <li>Gestión de proyectos</li>
                    </ul>
                </article>
                <article>
                    <h3>Idiomas</h3>
                    <ul>
                        <li>Español: Nativo</li>
                        <li>Inglés: Avanzado</li>
                        <li>Francés: Intermedio</li>
                    </ul>
                </article>
            </div>
            <div id="derecha">
                <h1>Jose Vicente <br>Carratalá Sanchis</h1>
                <h2>Profesor, desarrollador y diseñador</h2>
                <h3>Sobre mi</h3>
                <p>Soy un profesional con más de 20 años de experiencia en el desarrollo web y la enseñanza. Me apasiona crear soluciones innovadoras y compartir mis conocimientos con otros.</p>
                <h3>Formación Académica</h3>
                <ul>
                    <li>Grado en Ingeniería Informática - Universidad de Valencia (2000-2004)</li>
                    <li>Máster en Desarrollo Web - Universidad Politécnica de Madrid (2005-2006)</li>
                </ul>
                <h3>Experiencia Profesional</h3>
                <ul>
                    <li>Profesor de Desarrollo Web - Instituto Tecnológico de Valencia (2010-presente)</li>
                    <li>Desarrollador Web Freelance (2006-2010)</li>
                </ul>
                <h3>Proyectos Destacados</h3>
                <ul>
                    <li>Desarrollo de una plataforma de e-learning para una universidad local.</li>
                    <li>Diseño y desarrollo de sitios web para pequeñas y medianas empresas.</li>
                </ul>
                <h3>Referencias</h3>
                <p>Disponibles a solicitud.</p> 
            </div>
        </main>
    </body>
    
</html>
```

### fuentes personalizadas

```html
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Currículum Vitae</title>
        <style>
            @font-face {
                font-family: "LemonBold";
                src: url(LEMONMILK-Bold.otf);
            }
            @font-face {
                font-family: "LemonRegular";
                src: url(LEMONMILK-Light.otf);
            }
            main{
                width:210mm;
                height:297mm;
                margin:auto;
                font-family: LemonRegular;
                font-size:10px;
                text-align:justify;
            }
            h1,h2,h3,h4{
                font-family: LemonBold;
            }
            /* Quiero maquetar con flexbox */
            main{
                display:flex;
                flex-direction:row;
                align-items:top;
                justify-content:center;
                background: url(fondocv.jpg) no-repeat center center;
                background-size: 100% 100%;
                gap:130px;
                padding:50px;
                 color:#5c105a;
            }  
            #izquierda{
                flex:1;
                
            }
            #derecha{
                flex:2;
                padding-left:20px;
            }
            #izquierda img{
                border-radius:50%;
                border:5px solid white;
                transform: translate(69px, 63px);
                width: 189px;
            }
            #izquierda>ul{
                list-style:none;
                padding:0;
                margin-top:150px;
                margin-bottom:50px;
            }
            h1,h2{
                text-align:center;
                text-transform:uppercase;
               
            }
            h2{
                font-size:12px;
                margin-bottom:120px;
            }
            h1{
                margin-top:50px;
            }
            h3{
                /* Quiero el texto en negrita */
                font-weight:bold;
                /* Y ahora quiero todo mayusculas */
                text-transform:uppercase;
                font-size:30px;
            }
        </style>
    </head>
    <body>
        <main>
            <div id="izquierda">
                <img src="josevicente.jpg" alt="Foto de perfil" width="150">
                <ul>
                    <li>Fecha de nacimiento: 14/04/1978</li>
                    <li>Edad: 47</li>
                    <li>Nacionalidad: Española</li>
                </ul>
                <article>
                    <h3>Contacto</h3>
                    <p>Dirección: Calle Falsa 123, Ciudad, País</p>
                    <p>Teléfono: +34 123 456 789</p>
                    <p>Email:
                </article>
                <article>
                    <h3>Habilidades</h3>
                    <ul>
                        <li>HTML5, CSS3, JavaScript</li>
                        <li>Diseño responsivo</li>
                        <li>Gestión de proyectos</li>
                    </ul>
                </article>
                <article>
                    <h3>Idiomas</h3>
                    <ul>
                        <li>Español: Nativo</li>
                        <li>Inglés: Avanzado</li>
                        <li>Francés: Intermedio</li>
                    </ul>
                </article>
            </div>
            <div id="derecha">
                <h1>Jose Vicente <br>Carratalá Sanchis</h1>
                <h2>Profesor, desarrollador y diseñador</h2>
                <h3>Sobre mi</h3>
                <p>Soy un profesional con más de 20 años de experiencia en el desarrollo web y la enseñanza. Me apasiona crear soluciones innovadoras y compartir mis conocimientos con otros.</p>
                <h3>Formación Académica</h3>
                <ul>
                    <li>Grado en Ingeniería Informática - Universidad de Valencia (2000-2004)</li>
                    <li>Máster en Desarrollo Web - Universidad Politécnica de Madrid (2005-2006)</li>
                </ul>
                <h3>Experiencia Profesional</h3>
                <ul>
                    <li>Profesor de Desarrollo Web - Instituto Tecnológico de Valencia (2010-presente)</li>
                    <li>Desarrollador Web Freelance (2006-2010)</li>
                </ul>
                <h3>Proyectos Destacados</h3>
                <ul>
                    <li>Desarrollo de una plataforma de e-learning para una universidad local.</li>
                    <li>Diseño y desarrollo de sitios web para pequeñas y medianas empresas.</li>
                </ul>
                <h3>Referencias</h3>
                <p>Disponibles a solicitud.</p> 
            </div>
        </main>
    </body>
    
</html>
```

### retoques

```html
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Currículum Vitae</title>
        <style>
            @font-face {
                font-family: "LemonBold";
                src: url(LEMONMILK-Bold.otf);
            }
            @font-face {
                font-family: "LemonRegular";
                src: url(LEMONMILK-Light.otf);
            }
            main{
                width:210mm;
                height:297mm;
                margin:auto;
                font-family: LemonRegular;
                font-size:10px;
                text-align:justify;
            }
            h1,h2,h3,h4{
                font-family: LemonBold;
            }
            /* Quiero maquetar con flexbox */
            main{
                display:flex;
                flex-direction:row;
                align-items:top;
                justify-content:center;
                background: url(fondocv.jpg) no-repeat center center;
                background-size: 100% 100%;
                gap:130px;
                padding:50px;
                 color:#5c105a;
            }  
            #izquierda{
                flex:1;
                
            }
            #derecha{
                flex:2;
                padding-left:20px;
            }
            #izquierda img{
                border-radius:50%;
                border:5px solid white;
                transform: translate(69px, 63px);
                width: 189px;
            }
            #izquierda>ul{
                list-style:none;
                padding:0;
                margin-top:150px;
                margin-bottom:50px;
            }
            h1{font-size: 35px;;}
            h1,h2{
                text-align:center;
                text-transform:uppercase;
               
            }
            h2{
                font-size:12px;
                margin-bottom:120px;
            }
            h1{
                margin-top:10px;
            }
            h3{
                /* Quiero el texto en negrita */
                font-weight:bold;
                /* Y ahora quiero todo mayusculas */
                text-transform:uppercase;
                font-size:25px;
            }
        </style>
    </head>
    <body>
        <main>
            <div id="izquierda">
                <img src="josevicente.jpg" alt="Foto de perfil" width="150">
                <ul>
                    <li>Fecha de nacimiento: 14/04/1978</li>
                    <li>Edad: 47</li>
                    <li>Nacionalidad: Española</li>
                </ul>
                <article>
                    <h3>Contacto</h3>
                    <p>Dirección: Calle Falsa 123, Ciudad, País</p>
                    <p>Teléfono: +34 123 456 789</p>
                    <p>Email:
                </article>
                <article>
                    <h3>Habilidades</h3>
                    <ul>
                        <li>HTML5, CSS3, JavaScript</li>
                        <li>Diseño responsivo</li>
                        <li>Gestión de proyectos</li>
                    </ul>
                </article>
                <article>
                    <h3>Idiomas</h3>
                    <ul>
                        <li>Español: Nativo</li>
                        <li>Inglés: Avanzado</li>
                        <li>Francés: Intermedio</li>
                    </ul>
                </article>
            </div>
            <div id="derecha">
                <h1>Jose Vicente <br>Carratalá Sanchis</h1>
                <h2>Profesor, desarrollador y diseñador</h2>
                <h3>Sobre mi</h3>
                <p>Soy un profesional con más de 20 años de experiencia en el desarrollo web y la enseñanza. Me apasiona crear soluciones innovadoras y compartir mis conocimientos con otros.</p>
                <h3>Formación Académica</h3>
                <ul>
                    <li>Grado en Ingeniería Informática - Universidad de Valencia (2000-2004)</li>
                    <li>Máster en Desarrollo Web - Universidad Politécnica de Madrid (2005-2006)</li>
                </ul>
                <h3>Experiencia Profesional</h3>
                <ul>
                    <li>Profesor de Desarrollo Web - Instituto Tecnológico de Valencia (2010-presente)</li>
                    <li>Desarrollador Web Freelance (2006-2010)</li>
                </ul>
                <h3>Proyectos Destacados</h3>
                <ul>
                    <li>Desarrollo de una plataforma de e-learning para una universidad local.</li>
                    <li>Diseño y desarrollo de sitios web para pequeñas y medianas empresas.</li>
                </ul>
                <h3>Referencias</h3>
                <p>Disponibles a solicitud.</p> 
            </div>
        </main>
    </body>
    
</html>
```

<a id="ejercicio-de-final-de-unidad-1"></a>
## Ejercicio de final de unidad

### actividad

```markdown
# Actividad (30’): “Planificador de cuadras — versión exprés”

Crea un script llamado `planificador_cuadras.py` que calcule cuántas cuadras necesitas en una fecha dada, según el número de caballos y la capacidad de cada cuadra. Debe redondear **al alza** el número de cuadras, mostrar propiedades de la fecha y presentar un pequeño informe.

## Objetivos de aprendizaje

* Usar **métodos** y **propiedades** de objetos estándar (`datetime.date`, `date.year`, `date.weekday`, etc.). 
* Llamar a **métodos “estáticos”**/de módulo como `math.ceil`. 
* Manejar **entrada → cálculo → salida** con mensajes claros. 

## Requisitos funcionales

1. **Entrada de datos (por `input`)**

   * `caballos` (entero > 0).
   * `capacidad_por_cuadra` (entero > 0).
   * `fecha` en formato `YYYY-MM-DD`.
     (Estos tres inputs siguen el patrón de los ejercicios de entrada/cálculo/salida). 
2. **Cálculos**

   * `cuadras_necesarias = ceil(caballos / capacidad_por_cuadra)` usando `math.ceil`. 
   * Crear un objeto `date` con la fecha indicada y obtener:

     * `year`, `month`, `day`
     * `weekday()` (0–6) y `isoweekday()` (1–7)
       (Como en los ejemplos de propiedades de fecha). 
3. **Salida (informe)**

   * Línea resumen con caballos, capacidad y cuadras **redondeadas al alza**.
   * Bloque “Datos de la fecha” mostrando `YYYY-MM-DD`, `year`, `month`, `day`, `weekday`, `isoweekday`.
4. **Validaciones mínimas**

   * Si algún valor no es entero positivo, mostrar un mensaje y terminar.
   * Si la fecha no cumple el formato, mostrar mensaje y terminar.
5. **(Opcional, si te da tiempo)**

   * Mostrar si la fecha cae **entre semana** o **fin de semana** (usa `isoweekday()`).
```


<a id="manipulacion-de-documentos-web"></a>
# Manipulación de documentos Web

<a id="lenguajes-de-script-de-cliente-caracteristicas-y-sintaxis-basica-estandares"></a>
## Lenguajes de script de cliente. Características y sintaxis básica. Estándares

En el vasto mundo digital de la programación web, los lenguajes de script de cliente desempeñan un papel crucial, ofreciendo a los desarrolladores la capacidad de crear experiencias interactivas y dinámicas en las páginas web. Estos lenguajes no solo permiten interactuar con el contenido del navegador, sino que también facilitan la manipulación de elementos visuales y la ejecución de operaciones complejas sin necesidad de recargar la página.

JavaScript es uno de los lenguajes de script de cliente más populares y versátiles. Su sintaxis es sencilla pero rica en funcionalidades, lo que lo hace ideal para una amplia gama de aplicaciones web. A través de JavaScript, se pueden seleccionar y manipular elementos del DOM (Modelo de Objeto del Documento), cambiar su estilo, agregar eventos interactivos y realizar solicitudes asíncronas al servidor.

La capacidad de interactuar con el DOM es uno de los puntos fuertes de JavaScript. Permite a los desarrolladores acceder y modificar cualquier parte de la estructura HTML de una página web en tiempo real. Esta funcionalidad es fundamental para crear interfaces dinámicas, como menús desplegables, sliders, y formularios interactivos.

Además de manipular el contenido del DOM, JavaScript también proporciona herramientas poderosas para interactuar con los usuarios a través de eventos. Los eventos son acciones que ocurren en la página web, como hacer clic en un botón o escribir texto en un campo de entrada. Al asociar funciones a estos eventos, se pueden crear interacciones fluidas y responsivas.

La sintaxis de JavaScript es relativamente sencilla, lo que facilita su aprendizaje y uso. Sin embargo, su versatilidad y la gran cantidad de bibliotecas disponibles hacen que sea una herramienta extremadamente rica para el desarrollo web. Desde jQuery hasta React y Vue.js, existen numerosos frameworks y librerías que simplifican el trabajo con JavaScript, ofreciendo soluciones predefinidas para problemas comunes.

La comunidad de desarrolladores de JavaScript es extensa y activa, lo que significa que siempre hay recursos disponibles para aprender y resolver dudas. Desde tutoriales en línea hasta foros y comunidades de usuarios, existen múltiples opciones para mejorar tus habilidades en este lenguaje.

En resumen, los lenguajes de script de cliente, especialmente JavaScript, son herramientas esenciales para el desarrollo web moderno. Su capacidad para manipular el contenido del navegador, interactuar con los usuarios y realizar operaciones complejas sin recargar la página, lo convierten en una poderosa herramienta para crear experiencias interactivas y dinámicas en las páginas web. A través de su sintaxis sencilla pero rica en funcionalidades, JavaScript ofrece a los desarrolladores la flexibilidad necesaria para crear aplicaciones web avanzadas y funcionales.

### index

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    
  </body>
</html>
```

### javascript interno

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      
    </script>
  </body>
</html>
```

### comentarios

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      // Esto es un comentario de una linea
      Esto ya no lo es
    </script>
  </body>
</html>
```

### comentarios multilinea

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      // Esto es un comentario de una linea
      /* 
        Esto es una linea de comentario
        Esto es otra linea de comentario
        y esto es otra linea más
      */
    </script>
  </body>
</html>
```

### salidas por consola y por documento

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      // salidas por consola
      console.log("Esto es un mensaje informativo");
      console.warn("Esto es un mensaje de advertencia");
      console.error("Esto es un mensaje de error");
      // salidas por documento
      document.write("Esto es un mensaje en el documento");
    </script>
  </body>
</html>
```

### entradas

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      prompt("Dime tu edad");
    </script>
  </body>
</html>
```

### operadores aritmeticos

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      console.log(4+3);
      console.log(4-3);
      console.log(4*3);
      console.log(4/3);
      console.log(4%3);
    </script>
  </body>
</html>
```

### operadores de comparacion

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      console.log(4 < 3);
      console.log(4 <= 3);
      console.log(4 > 3);
      console.log(4 >= 3);
      console.log(4 == 3);
      console.log(4 != 3);
    </script>
  </body>
</html>
```

### operadores logicos

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      console.log(4 == 4 && 3 == 3 && 2 == 2);
      console.log(4 == 4 && 3 == 3 && 2 == 1);
      
      console.log(4 == 4 || 3 == 3 || 2 == 2); // AltGr + 1
      console.log(4 == 4 || 3 == 3 || 2 == 1);
      console.log(4 == 4 || 3 == 2 || 2 == 1);
      console.log(4 == 3 || 3 == 2 || 2 == 1);
    </script>
  </body>
</html>
```

### declaracion de variables

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      var edad = 47;
    </script>
  </body>
</html>
```

### salidas de variables

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      var edad = 47;
      console.log("Mi edad es de",edad,"años")
    </script>
  </body>
</html>
```

### variar variables

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      var edad = 47;
      console.log("Mi edad es de",edad,"años");
      edad = 48;
      console.log("Mi edad es de",edad,"años");
    </script>
  </body>
</html>
```

### declaracion de constantes

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      const PI = 3.1416;
      console.log("El valor de PI es:",PI);
    </script>
  </body>
</html>
```

### error al reasignar valor

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      const PI = 3.1416;
      console.log("El valor de PI es:",PI);
      PI = 4;
      console.log("El valor de PI es:",PI);
    </script>
  </body>
</html>
```

### operadores de incremento

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      var edad = 47;
      console.log("Mi edad es de:",edad,"años");
      edad++;
      console.log("Mi edad es de:",edad,"años");
      edad--;
      console.log("Mi edad es de:",edad,"años");
    </script>
  </body>
</html>
```

### operadores aritméticos abreviados

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      var edad = 47;
      console.log("Mi edad es de:",edad,"años");
      edad += 5; // es igual a edad = edad + 5
      console.log("Mi edad es de:",edad,"años");
      edad -= 5;
      console.log("Mi edad es de:",edad,"años");
      edad *= 5; 
      console.log("Mi edad es de:",edad,"años");
      edad /= 5;
      console.log("Mi edad es de:",edad,"años");
    </script>
  </body>
</html>
```

### estructura for de bucle

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      for(var dia = 1;dia < 31;dia++){
        document.write("Hoy es el dia "+dia+" del mes<br>");
      }
    </script>
  </body>
</html>
```

### while

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      var dia = 1
      while(dia < 31){
        document.write("Hoy es el dia "+dia+" del mes<br>");
        dia++;
      }
    </script>
  </body>
</html>
```

### if en la edad

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      var edad = 47;
      if(edad < 30){
        console.log("Eres un joven");
      }
    </script>
  </body>
</html>
```

### clausula else

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      var edad = 47;
      if(edad < 30){
        console.log("Eres un joven");
      }else{
        console.log("Ya no eres un joven")
      }
    </script>
  </body>
</html>
```

### if else

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      var edad = 47;
      if(edad < 10){
        console.log("Eres un niño");
      }else if(edad >= 10 && edad < 20){
        console.log("Eres un adolescente");
      }else if(edad >= 20 && edad < 30){
        console.log("Eres un joven");
      }else{
        console.log("Ya no eres un joven")
      }
    </script>
  </body>
</html>
```

### switch

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      var diadelasemana = "jueves";
      
      switch(diadelasemana){
        case "lunes":
          document.write("Hoy es el peor día de la semana");
          break;
        case "martes":
          document.write("Hoy es el segundo peor día de la semana");
          break;
        case "miercoles":
          document.write("Ya estamos a mitad de semana");
          break;
        case "jueves":
          document.write("Ya es casi viernes");
          break;
        case "viernes":
          document.write("Ya es casi fin de semana");
          break;
        case "sabado":
          document.write("Hoy es el mejor día de la semana");
          break;
        case "domingo":
          document.write("Parece mentira que mañana ya sea lunes");
          break;
      }
    </script>
  </body>
</html>
```

### arrays

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      var uncliente = "Jose";
      var muchosclientes = ['Juan','Jorge','Jose','Jaime'];
      console.log(uncliente);
      console.log(muchosclientes);
    </script>
  </body>
</html>
```

### funciones

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      function diHola(){
        console.log("hola");
      }
      
      
      
    </script>
  </body>
</html>
```

### llamada a la funcion

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      function diHola(){
        console.log("hola");
      }
      
      diHola();
      
    </script>
  </body>
</html>
```

### un parametro

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      function diHola(nombre){
        console.log("hola, ",nombre,"¿como estas?");
      }
      
      diHola("Jose Vicente");
      
    </script>
  </body>
</html>
```

### muchos parametros

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      function diHola(nombre,edad){
        console.log("hola, ",nombre,", tienes",edad," años, ¿como estas?");
      }
      
      diHola("Jose Vicente",47);
      
    </script>
  </body>
</html>
```

### las funciones deben hacer return

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      function diHola(nombre,edad){
        return "hola, "+nombre+", tienes"+edad+" años, ¿como estas?");
      }
      
      console.log(diHola("Jose Vicente",47));
      
    </script>
  </body>
</html>
```

### clases

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      class Gato{
        constructor(){
          this.edad = 0;
          this.color = ""
        }
      }
      
    </script>
  </body>
</html>
```

### instanciar un gato

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      class Gato{
        constructor(){
          this.edad = 0;
          this.color = ""
        }
      }
      var gato1 = new Gato()
      console.log(gato1);
    </script>
  </body>
</html>
```

### podemos tener metodos

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      class Gato{
        constructor(){
          this.edad = 0;
          this.color = ""
        }
        maulla(){
          return "miau"
        }
      }
      var gato1 = new Gato();
      console.log(gato1);
      console.log(gato1.maulla());
    </script>
  </body>
</html>
```

### demostracion javascript

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Aprendiendo Javascript</title>
    <meta charset="utf-8">
    <style>
      .dia{
        display:inline-block;
        width:50px;
        height:50px;
        border:1px solid grey;
      }
      body{
        width:400px;
      }
    </style>
  </head>
  <body>
    <script>
      for(var dia = 1;dia < 31;dia++){
        document.write('<div class="dia">'+dia+'</div>')
      }
    </script>
  </body>
</html>
```

<a id="seleccion-y-acceso-a-elementos"></a>
## Selección y acceso a elementos

En el vasto mundo de la manipulación de documentos web, una habilidad esencial es la capacidad para seleccionar y acceder a elementos específicos dentro de un documento HTML. Esta selección no solo permite interactuar con el contenido en tiempo real, sino que también es fundamental para la creación de interfaces dinámicas y interactivas.

La elección de los elementos se realiza mediante selectores CSS, una poderosa herramienta que nos permite identificar elementos basados en su etiqueta, clase, id o atributos. Cada selector tiene un nivel de especificidad que determina cuán preciso es para seleccionar el elemento deseado. Por ejemplo, un selector con un id es más específico que uno con una clase, y este a su vez es más específico que uno basado en la etiqueta.

La selección de elementos es un paso crucial antes de cualquier manipulación del contenido. Una vez seleccionados, podemos modificar sus atributos, cambiar su estilo visual o incluso eliminarlos completamente del documento. Esta capacidad nos permite crear aplicaciones web interactivas donde los usuarios pueden interactuar directamente con el contenido, lo que es fundamental para la experiencia del usuario.

Además de seleccionar elementos individuales, también es posible seleccionar grupos de elementos que comparten características comunes. Esto se realiza mediante selectores combinados, como los selectores hermanos o los selectores descendientes. Estas técnicas nos permiten realizar operaciones en conjuntos de elementos, lo que facilita la gestión masiva de contenido.

La manipulación de elementos también implica el acceso a su contenido y atributos. Podemos leer o modificar el texto dentro de un elemento, cambiar sus clases o estilos dinámicamente, o incluso agregar nuevos atributos según sea necesario. Esta capacidad es esencial para crear aplicaciones que responden en tiempo real a las acciones del usuario.

La selección y manipulación de elementos también se extiende a la creación de eventos. Podemos asociar funciones JavaScript con los elementos seleccionados, de manera que cuando ocurra un evento específico (como hacer clic o mover el mouse), nuestro código pueda responder de manera dinámica. Esta capacidad es fundamental para crear aplicaciones interactivas y responsivas.

La manipulación de elementos también implica la creación de nuevos elementos en tiempo real. Podemos crear elementos HTML desde cero, asignarles atributos y contenido, y luego insertarlos en el documento. Esto nos permite crear interfaces dinámicas donde los elementos se generan según sea necesario, lo que es fundamental para aplicaciones complejas.

La selección y manipulación de elementos también implica la comunicación con servidores. Podemos enviar solicitudes al servidor para obtener o modificar datos, y luego actualizar el contenido del documento en consecuencia. Esta capacidad es fundamental para crear aplicaciones web modernas que ofrecen una experiencia de usuario fluida y dinámica.

La selección y manipulación de elementos también implica la persistencia de los cambios. Podemos guardar los cambios realizados en el cliente, lo que nos permite mantener un estado consistente incluso cuando el usuario navega por diferentes partes de la aplicación. Esta capacidad es fundamental para crear aplicaciones web interactivas y responsivas.

La selección y manipulación de elementos también implica la optimización del rendimiento. Podemos minimizar el uso de recursos al seleccionar solo los elementos necesarios, lo que nos permite mantener una buena velocidad de respuesta incluso en aplicaciones complejas. Esta capacidad es fundamental para crear aplicaciones web modernas que ofrecen una experiencia de usuario fluida y dinámica.

La selección y manipulación de elementos también implica la seguridad. Podemos implementar medidas de seguridad para proteger los datos del usuario, lo que nos permite mantener un alto nivel de confianza en nuestra aplicación. Esta capacidad es fundamental para crear aplicaciones web seguras y confiables.

En resumen, la selección y manipulación de elementos son habilidades fundamentales en el mundo de la manipulación de documentos web. Estas habilidades nos permiten interactuar con el contenido en tiempo real, crear interfaces dinámicas e interactivas, y realizar operaciones masivas de manera eficiente y segura. Con un buen dominio de estos conceptos, podemos crear aplicaciones web modernas que ofrecen una experiencia de usuario fluida y dinámica.

### escribir contenido en el DOM facil

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <p></p>
    <script>
      document.write("Hola mundo desde Javascript")
    </script>
  </body>
</html>
```

### seleccion nueva

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <p></p>
    <script>
      var elemento = document.querySelector("p");
      elemento.textContent = "Hola mundo desde Javascript"
    </script>
  </body>
</html>
```

### seleccion por etiqueta

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <p></p>
    <script>
      // Selecciono el elemento que tenga la etiqueta P
      var elemento = document.querySelector("p");
      elemento.textContent = "Hola mundo desde Javascript"
    </script>
  </body>
</html>
```

### seleccionar por id

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <p id="texto"></p>
    <script>
      // Selecciono el elemento que tenga la etiqueta P
      var elemento = document.querySelector("#texto");
      elemento.textContent = "Hola mundo desde Javascript"
    </script>
  </body>
</html>
```

### seleccionar por clase

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <p class="texto"></p>
    <script>
      // Selecciono el elemento que tenga la etiqueta P
      var elemento = document.querySelector(".texto");
      elemento.textContent = "Hola mundo desde Javascript"
    </script>
  </body>
</html>
```

### multiples elementos

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <p></p>
    <p></p>
    <p></p>
    <script>
      // Selecciono el elemento que tenga la etiqueta P
      var elemento = document.querySelector("p");
      elemento.textContent = "Hola mundo desde Javascript"
    </script>
  </body>
</html>
```

### seleccion de multipes elementos

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <p></p>
    <p></p>
    <p></p>
    <script>
      // Primero seleccionamos varios elementos
      var elementos = document.querySelectorAll("p");
      // Seleccionamos uno a uno
      elementos.forEach(function(elemento){
        // Uno a uno operamos
        elemento.textContent = "Hola mundo desde Javascript"
      })
    </script>
  </body>
</html>
```

### escribir

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <p></p>
    <script>
      // Primero seleccionamos varios elementos
      var elemento = document.querySelector("p");
      elemento.textContent = "hola mundo y escribro"
    </script>
  </body>
</html>
```

### leer

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <p id="primero">Este es un texto que esta en HTML puro</p>
    <p id="segundo"></p>
    <script>
      // Primero seleccionamos el primero
      var elemento = document.querySelector("#primero");
      contenido = elemento.textContent // Aquí estoy leyendo
      // Ahora seleccionamos el segundo
      var elemento2 = document.querySelector("#segundo");
      segundo.textContent = contenido // Aquí estoy escribiendo
    </script>
  </body>
</html>
```

### solo texto puro

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <p id="primero"></p>
    <script>
      var elemento = document.querySelector("#primero")
      primero.textContent = "Hola que tal"
    </script>
  </body>
</html>
```

### textocontent no soporta html

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <p id="primero"></p>
    <script>
      var elemento = document.querySelector("#primero")
      primero.textContent = "<b>Hola que tal</b>"
    </script>
  </body>
</html>
```

### escribir contenido HTML

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <p id="primero"></p>
    <script>
      var elemento = document.querySelector("#primero")
      primero.innerHTML = "<b>Hola que tal</b>"
    </script>
  </body>
</html>
```

### formularios

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <input type="text" id="nombre">
    <button>Pulsame</button>
    <script>
      var boton = document.querySelector("button")
      boton.onclick = function(){
        alert("Has pulsado un boton")
      }
    </script>
  </body>
</html>
```

### cojo el valor del campo

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <input type="text" id="nombre">
    <button>Pulsame</button>
    <script>
      var boton = document.querySelector("button")
      // Puedo establecer acciones sobre los elementos HTML
      boton.onclick = function(){
        // Puedo coger el valor de campos HTML
        let nombre = document.querySelector("#nombre").value
        alert("Tu nombre es: "+nombre)
      }
    </script>
  </body>
</html>
```

### ejercicio calculadora sencilla

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <input type="number" id="operando1">
    <input type="number" id="operando2">
    <button>Calcula</button>
    <div id="resultado"></div>
    <script>
      // Cuando pulse el boton
      var boton = document.querySelector("button")
      boton.onclick = function(){
        // Voy a coger el contenido del operando 1
        let operando1 = document.querySelector("#operando1").value
        // Voy a coger el contenido del operando 2
        let operando2 = document.querySelector("#operando2").value
        // Los voy a sumar
        let resultado = operando1 + operando2
        // Y voy a devolver el resultado en pantalla
        let contieneresultado = document.querySelector("#resultado")
        contieneresultado.textContent = resultado
      }
    </script>
  </body>
</html>
```

### cambio de tipo implicito

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <input type="number" id="operando1">
    <input type="number" id="operando2">
    <button>Calcula</button>
    <div id="resultado"></div>
    <script>
      // Cuando pulse el boton
      var boton = document.querySelector("button")
      boton.onclick = function(){
        // Voy a coger el contenido del operando 1
        let operando1 = document.querySelector("#operando1").value
        operando1 *= 1 // Fuerzo el cambio de tipo a numerico
        // Voy a coger el contenido del operando 2
        let operando2 = document.querySelector("#operando2").value
        operando2 *= 1 // Fuerzo el cambio de tipo a numérico
        // Los voy a sumar
        let resultado = operando1 + operando2
        // Y voy a devolver el resultado en pantalla
        let contieneresultado = document.querySelector("#resultado")
        contieneresultado.textContent = resultado
      }
    </script>
  </body>
</html>
```

### select con tipo de operacion

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <input type="number" id="operando1">
    <input type="number" id="operando2">
    <select id="operacion">
      <option>Selecciona una opción</option>
      <option value="suma">Sumar</option>
      <option value="restar">Restar</option>
      <option value="multiplicar">Multiplicar</option>
      <option value="dividir">Dividir</option>
    </select>
    <button>Calcula</button>
    <div id="resultado"></div>
    <script>
      // Cuando pulse el boton
      var boton = document.querySelector("button")
      boton.onclick = function(){
        // Voy a coger el contenido del operando 1
        let operando1 = document.querySelector("#operando1").value
        operando1 *= 1 // Fuerzo el cambio de tipo a numerico
        // Voy a coger el contenido del operando 2
        let operando2 = document.querySelector("#operando2").value
        operando2 *= 1 // Fuerzo el cambio de tipo a numérico
        // Los voy a sumar
        let resultado = operando1 + operando2
        // Y voy a devolver el resultado en pantalla
        let contieneresultado = document.querySelector("#resultado")
        contieneresultado.textContent = resultado
      }
    </script>
  </body>
</html>
```

### if para seleccion

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <input type="number" id="operando1">
    <input type="number" id="operando2">
    <select id="operacion">
      <option>Selecciona una opción</option>
      <option value="suma">Sumar</option>
      <option value="resta">Restar</option>
      <option value="multiplicacion">Multiplicar</option>
      <option value="division">Dividir</option>
    </select>
    <button>Calcula</button>
    <div id="resultado"></div>
    <script>
      // Cuando pulse el boton
      var boton = document.querySelector("button")
      boton.onclick = function(){
        // Voy a coger el contenido del operando 1
        let operando1 = document.querySelector("#operando1").value
        operando1 *= 1 // Fuerzo el cambio de tipo a numerico
        // Voy a coger el contenido del operando 2
        let operando2 = document.querySelector("#operando2").value
        operando2 *= 1 // Fuerzo el cambio de tipo a numérico
        // Ahora atrapo la operacion
        let operacion = document.querySelector("#operacion").value
        let resultado;
        switch(operacion){
          case "suma":
            resultado = operando1 + operando2
            break;
          case "resta":
            resultado = operando1 - operando2
            break;
          case "multiplicacion":
            resultado = operando1 * operando2
            break;
          case "division":
            resultado = operando1 / operando2
            break;
        }
        // Y voy a devolver el resultado en pantalla
        let contieneresultado = document.querySelector("#resultado")
        contieneresultado.textContent = resultado
      }
    </script>
  </body>
</html>
```

### un poco de estilo

```html
<!doctype html>
<html>
  <head>
    <style>
      html{background:grey;}
      body{background:white;width:200px;margin:auto;padding:30px;display:flex;flex-direction:column;gap:10px;}
      input,select,button{width:100%;box-sizing:border-box;padding:5px;}
    </style>
  </head>
  <body> 
    <input type="number" id="operando1">
    <input type="number" id="operando2">
    <select id="operacion">
      <option>Selecciona una opción</option>
      <option value="suma">Sumar</option>
      <option value="resta">Restar</option>
      <option value="multiplicacion">Multiplicar</option>
      <option value="division">Dividir</option>
    </select>
    <button>Calcula</button>
    <div id="resultado"></div>
    <script>
      // Cuando pulse el boton
      var boton = document.querySelector("button")
      boton.onclick = function(){
        // Voy a coger el contenido del operando 1
        let operando1 = document.querySelector("#operando1").value
        operando1 *= 1 // Fuerzo el cambio de tipo a numerico
        // Voy a coger el contenido del operando 2
        let operando2 = document.querySelector("#operando2").value
        operando2 *= 1 // Fuerzo el cambio de tipo a numérico
        // Ahora atrapo la operacion
        let operacion = document.querySelector("#operacion").value
        let resultado;
        switch(operacion){
          case "suma":
            resultado = operando1 + operando2
            break;
          case "resta":
            resultado = operando1 - operando2
            break;
          case "multiplicacion":
            resultado = operando1 * operando2
            break;
          case "division":
            resultado = operando1 / operando2
            break;
        }
        // Y voy a devolver el resultado en pantalla
        let contieneresultado = document.querySelector("#resultado")
        contieneresultado.textContent = resultado
      }
    </script>
  </body>
</html>
```

### calculadora completa

```html
<!doctype html>
<html>
  <head>
    <style>
      
    </style>
  </head>
  <body> 
    
  </body>
</html>
```

### primero creo la interfaz

```html
<!doctype html>
<html>
  <head>
    <style>
      
    </style>
  </head>
  <body> 
    <div id="calculadora">
      <header>
      </header>
      <div id="pantalla"></div>
      <div id="teclas">
        <table>
          <tbody>
            <tr>
              <td>C</td>
              <td>(</td>
              <td>)</td>
              <td>mod</td>
              <td>PI</td>
            </tr>
            <tr>
              <td>7</td>
              <td>8</td>
              <td>9</td>
              <td>/</td>
              <td>sqrt</td>
            </tr>
            <tr>
              <td>4</td>
              <td>5</td>
              <td>6</td>
              <td>*</td>
              <td>x2</td>
            </tr>
            <tr>
              <td>1</td>
              <td>2</td>
              <td>3</td>
              <td>-</td>
              <td>=</td>
            </tr>
            <tr>
              <td>0</td>
              <td>.</td>
              <td>%</td>
              <td>+</td>
              <td>=</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>
```

### un poco de css

```html
<!doctype html>
<html>
  <head>
    <style>
      #calculadora{
        background:grey;
        width:300px;
        display:flex;
        flex-direction:column;
        color:white;
        font-family:sans-serif;
        padding:5px;
        border-radius:5px;
      }
      #calculadora>*{
        width:100%;
      }
      #calculadora table td{
        width:20%;
        background:LightGray;
        padding:10px;
        text-align:center;
        border-radius:5px;
      }
      #pantalla{
        height:50px;
        background:dimgray;
        border-radius:5px;
      }
      header{
        background:gray;
        height:30px;
      }
    </style>
  </head>
  <body> 
    <div id="calculadora">
      <header>
      </header>
      <div id="pantalla"></div>
      <div id="teclas">
        <table width=100%>
          <tbody>
            <tr>
              <td>C</td>
              <td>(</td>
              <td>)</td>
              <td>mod</td>
              <td>PI</td>
            </tr>
            <tr>
              <td>7</td>
              <td>8</td>
              <td>9</td>
              <td>/</td>
              <td>sqrt</td>
            </tr>
            <tr>
              <td>4</td>
              <td>5</td>
              <td>6</td>
              <td>*</td>
              <td>x2</td>
            </tr>
            <tr>
              <td>1</td>
              <td>2</td>
              <td>3</td>
              <td>-</td>
              <td>=</td>
            </tr>
            <tr>
              <td>0</td>
              <td>.</td>
              <td>%</td>
              <td>+</td>
              <td>=</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>
```

### ahora viene javascript

```html
<!doctype html>
<html>
  <head>
    <style>
      #calculadora{
        background:grey;
        width:300px;
        display:flex;
        flex-direction:column;
        color:white;
        font-family:sans-serif;
        padding:5px;
        border-radius:5px;
      }
      #calculadora>*{
        width:100%;
      }
      #calculadora table td{
        width:20%;
        background:LightGray;
        padding:10px;
        text-align:center;
        border-radius:5px;
      }
      #pantalla{
        height:50px;
        background:dimgray;
        border-radius:5px;
      }
      header{
        background:gray;
        height:30px;
      }
    </style>
  </head>
  <body> 
    <div id="calculadora">
      <header>
      </header>
      <div id="pantalla"></div>
      <div id="teclas">
        <table width=100%>
          <tbody>
            <tr>
              <td>C</td>
              <td>(</td>
              <td>)</td>
              <td>mod</td>
              <td>PI</td>
            </tr>
            <tr>
              <td>7</td>
              <td>8</td>
              <td>9</td>
              <td>/</td>
              <td>sqrt</td>
            </tr>
            <tr>
              <td>4</td>
              <td>5</td>
              <td>6</td>
              <td>*</td>
              <td>x2</td>
            </tr>
            <tr>
              <td>1</td>
              <td>2</td>
              <td>3</td>
              <td>-</td>
              <td>=</td>
            </tr>
            <tr>
              <td>0</td>
              <td>.</td>
              <td>%</td>
              <td>+</td>
              <td>=</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <script>
      var pantalla = document.querySelector("#pantalla")
      // Cojo muchos botones
      var botones = document.querySelectorAll("td");
      // Cuando cojo mucho de algo, lo tengo que recorrer
      botones.forEach(function(boton){
        boton.onclick = function(){
          // Lo que valga, mas lo que voy a añadir
          pantalla.textContent += this.textContent
        }
      })
    </script>
  </body>
</html>
```

### resolver la operacion

```html
<!doctype html>
<html>
  <head>
    <style>
      #calculadora{
        background:grey;
        width:300px;
        display:flex;
        flex-direction:column;
        color:white;
        font-family:sans-serif;
        padding:5px;
        border-radius:5px;
      }
      #calculadora>*{
        width:100%;
      }
      #calculadora table td{
        width:20%;
        background:LightGray;
        padding:10px;
        text-align:center;
        border-radius:5px;
      }
      #pantalla{
        height:50px;
        background:dimgray;
        border-radius:5px;
      }
      header{
        background:gray;
        height:30px;
      }
    </style>
  </head>
  <body> 
    <div id="calculadora">
      <header>
      </header>
      <div id="pantalla"></div>
      <div id="teclas">
        <table width=100%>
          <tbody>
            <tr>
              <td>C</td>
              <td>(</td>
              <td>)</td>
              <td>mod</td>
              <td>PI</td>
            </tr>
            <tr>
              <td>7</td>
              <td>8</td>
              <td>9</td>
              <td>/</td>
              <td>sqrt</td>
            </tr>
            <tr>
              <td>4</td>
              <td>5</td>
              <td>6</td>
              <td>*</td>
              <td>x2</td>
            </tr>
            <tr>
              <td>1</td>
              <td>2</td>
              <td>3</td>
              <td>-</td>
              <td></td>
            </tr>
            <tr>
              <td>0</td>
              <td>.</td>
              <td>%</td>
              <td>+</td>
              <td id="resolver">=</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <script>
      var pantalla = document.querySelector("#pantalla")
      // Cojo muchos botones
      var botones = document.querySelectorAll("td");
      // Cuando cojo mucho de algo, lo tengo que recorrer
      botones.forEach(function(boton){
        boton.onclick = function(){
          // Lo que valga, mas lo que voy a añadir
          pantalla.textContent += this.textContent
        }
      })
      var botonresolver = document.querySelector("#resolver")
      botonresolver.onclick = function(){
        // Aqui la magia la hace eval, que evalúa
        let expresion = eval(pantalla.textContent)
        pantalla.textContent = expresion
      }
    </script>
  </body>
</html>
```

### que funcione el boton borrar

```html
<!doctype html>
<html>
  <head>
    <style>
      #calculadora{
        background:grey;
        width:300px;
        display:flex;
        flex-direction:column;
        color:white;
        font-family:sans-serif;
        padding:5px;
        border-radius:5px;
      }
      #calculadora>*{
        width:100%;
      }
      #calculadora table td{
        width:20%;
        background:LightGray;
        padding:10px;
        text-align:center;
        border-radius:5px;
      }
      #pantalla{
        height:50px;
        background:dimgray;
        border-radius:5px;
      }
      header{
        background:gray;
        height:30px;
      }
    </style>
  </head>
  <body> 
    <div id="calculadora">
      <header>
      </header>
      <div id="pantalla"></div>
      <div id="teclas">
        <table width=100%>
          <tbody>
            <tr>
              <td id="borrar">C</td>
              <td>(</td>
              <td>)</td>
              <td>mod</td>
              <td>PI</td>
            </tr>
            <tr>
              <td>7</td>
              <td>8</td>
              <td>9</td>
              <td>/</td>
              <td>sqrt</td>
            </tr>
            <tr>
              <td>4</td>
              <td>5</td>
              <td>6</td>
              <td>*</td>
              <td>x2</td>
            </tr>
            <tr>
              <td>1</td>
              <td>2</td>
              <td>3</td>
              <td>-</td>
              <td></td>
            </tr>
            <tr>
              <td>0</td>
              <td>.</td>
              <td>%</td>
              <td>+</td>
              <td id="resolver">=</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <script>
      var pantalla = document.querySelector("#pantalla")
      // Cojo muchos botones
      var botones = document.querySelectorAll("td");
      // Cuando cojo mucho de algo, lo tengo que recorrer
      botones.forEach(function(boton){
        boton.onclick = function(){
          // Lo que valga, mas lo que voy a añadir
          pantalla.textContent += this.textContent
        }
      })
      var botonresolver = document.querySelector("#resolver")
      botonresolver.onclick = function(){
        // Aqui la magia la hace eval, que evalúa
        let expresion = eval(pantalla.textContent)
        pantalla.textContent = expresion
      }
      var botonborrar = document.querySelector("#borrar")
      botonborrar.onclick = function(){
        pantalla.textContent = ""
      }
    </script>
  </body>
</html>
```

### estilizar pantalla

```html
<!doctype html>
<html>
  <head>
    <style>
      #calculadora{
        background:grey;
        width:300px;
        display:flex;
        flex-direction:column;
        color:white;
        font-family:sans-serif;
        padding:5px;
        border-radius:5px;
      }
      #calculadora>*{
        width:100%;
      }
      #calculadora table td{
        width:20%;
        background:LightGray;
        padding:10px;
        text-align:center;
        border-radius:5px;
      }
      #pantalla{
        height:50px;
        background:dimgray;
        border-radius:5px;
        text-align:right;
        line-height:50px;
        font-family:monospace;
        text-shadow:0px 1px 2px black;
        font-size:30px;
      }
      header{
        background:gray;
        height:30px;
      }
    </style>
  </head>
  <body> 
    <div id="calculadora">
      <header>
      </header>
      <div id="pantalla"></div>
      <div id="teclas">
        <table width=100%>
          <tbody>
            <tr>
              <td id="borrar">C</td>
              <td>(</td>
              <td>)</td>
              <td>mod</td>
              <td>PI</td>
            </tr>
            <tr>
              <td>7</td>
              <td>8</td>
              <td>9</td>
              <td>/</td>
              <td>sqrt</td>
            </tr>
            <tr>
              <td>4</td>
              <td>5</td>
              <td>6</td>
              <td>*</td>
              <td>x2</td>
            </tr>
            <tr>
              <td>1</td>
              <td>2</td>
              <td>3</td>
              <td>-</td>
              <td></td>
            </tr>
            <tr>
              <td>0</td>
              <td>.</td>
              <td>%</td>
              <td>+</td>
              <td id="resolver">=</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <script>
      var pantalla = document.querySelector("#pantalla")
      // Cojo muchos botones
      var botones = document.querySelectorAll("td");
      // Cuando cojo mucho de algo, lo tengo que recorrer
      botones.forEach(function(boton){
        boton.onclick = function(){
          // Lo que valga, mas lo que voy a añadir
          pantalla.textContent += this.textContent
        }
      })
      var botonresolver = document.querySelector("#resolver")
      botonresolver.onclick = function(){
        // Aqui la magia la hace eval, que evalúa
        let expresion = eval(pantalla.textContent)
        pantalla.textContent = expresion
      }
      var botonborrar = document.querySelector("#borrar")
      botonborrar.onclick = function(){
        pantalla.textContent = ""
      }
    </script>
  </body>
</html>
```

<a id="creacion-y-modificacion-de-elementos"></a>
## Creación y modificación de elementos

En el mundo digital actual, la capacidad de crear y modificar elementos dentro de documentos web es una habilidad fundamental para cualquier desarrollador o diseñador web. Esta subunidad se centra específicamente en cómo interactuar con los elementos HTML y CSS utilizando JavaScript, un lenguaje de programación que permite a los usuarios añadir interactividad y dinamismo a las páginas web.

La manipulación de elementos es una técnica poderosa que nos permite cambiar el contenido, la estructura y el estilo de una página web en tiempo real. A través del uso de JavaScript, podemos seleccionar elementos específicos de una página HTML y modificarlos fácilmente. Por ejemplo, podríamos cambiar el texto de un elemento `<p>`, añadir o eliminar clases CSS, o incluso cambiar las propiedades de estilo directamente desde el código.

Para comenzar a manipular elementos en JavaScript, primero necesitamos seleccionar los elementos que queremos modificar. Esto se puede hacer utilizando selectores como `getElementById`, `getElementsByClassName` o `querySelector`. Una vez seleccionados los elementos, podemos aplicar cambios utilizando propiedades y métodos específicos de JavaScript.

La creación y modificación de elementos es un proceso que implica varios pasos. Primero, debemos crear el nuevo elemento utilizando la función `document.createElement()`, luego establecer sus atributos y contenido utilizando las propiedades correspondientes, y finalmente insertarlo en el documento utilizando métodos como `appendChild()` o `insertBefore()`.

Además de la creación y modificación de elementos individuales, también es común trabajar con colecciones de elementos. JavaScript proporciona varias formas de recorrer y manipular estas colecciones, como bucles `for` tradicionales o el método `forEach()`. Estas técnicas nos permiten realizar operaciones en múltiples elementos simultáneamente, lo que puede ahorrar tiempo y hacer que nuestro código sea más eficiente.

La manipulación de elementos es una habilidad versátil que se aplica en muchos contextos diferentes. Desde la creación de interfaces interactivas hasta la actualización dinámica de contenido sin necesidad de recargar la página, esta técnica es fundamental para el desarrollo web moderno. Al dominarla, los desarrolladores pueden crear experiencias web más ricas y dinámicas, mejorando significativamente la interacción del usuario con su sitio.

En resumen, la manipulación de elementos en documentos web es una poderosa herramienta que permite a los desarrolladores crear contenido interactivo y dinámico. A través de JavaScript, podemos seleccionar, modificar y crear elementos HTML y CSS, lo que nos da el control necesario para construir interfaces web avanzadas y eficientes. Esta habilidad es esencial en cualquier proyecto de desarrollo web y es un paso crucial hacia la creación de aplicaciones web modernas y funcionales.

### crear elementos

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <div id="contenedor"></div>
    <script>
      var titulo = document.createElement("h1");
      titulo.textContent = "Hola mundo";
    </script>
  </body>
</html>
```

### añado a otro elemento

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <div id="contenedor"></div>
    <script>
      var titulo = document.createElement("h1");   // createElement crea un elemento en memoria
      titulo.textContent = "Hola mundo";
      var contenedor = document.querySelector("#contenedor");
      contenedor.appendChild(titulo)               // appendChild añade un elemento dentro de otro
    </script>
  </body>
</html>
```

### mover un elemento

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <div id="origen">
      
    </div>
    <div id="destino"></div>
    <script>
      var titulo = document.createElement("h1");
      titulo.textContent = "Me van a mover";
      
      var origen = document.querySelector("#origen")
      var destino = document.querySelector("#destino")
      
      origen.appendChild(titulo)
    </script>
  </body>
</html>
```

### eliminar y mover

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <div id="origen">
      
    </div>
    <div id="destino"></div>
    <script>
      var titulo = document.createElement("h1");
      titulo.textContent = "Me van a mover";
      
      var origen = document.querySelector("#origen")
      var destino = document.querySelector("#destino")
      // Primero pongo el elemento en origen
      origen.appendChild(titulo)
      // Pero ahora quito el elemento
      titulo.remove()
      // Y luego lo pongo en el destino
      destino.appendChild(titulo)
    </script>
  </body>
</html>
```

### voy a crear un articulo

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <article>
    </article>
    <script>
      var articulo = document.querySelector("article");
      
      var titulo = document.createElement("h3");    // Creo un elemento
      titulo.textContent = "Título del artículo"    // Le pongo contenido
      articulo.appendChild(titulo)                  // Lo añado al contenedor
      
      var fecha = document.createElement("time");
      fecha.textContent = "2025-10-13"
      articulo.appendChild(fecha)
      
      var texto = document.createElement("p");
      texto.textContent = "Este es un documento de prueba"
      articulo.appendChild(texto)
      
      var imagen = document.createElement("img")
      imagen.setAttribute("src","josevicente.jpg")
      articulo.appendChild(imagen)
    </script>
  </body>
</html>
```

### plantilla articulo

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <section>
    </section>
    
    <template>
      <article>
        <h1>Hola mundo</h1>
        <time></time>
        <p></p>
        <img src="">
      </article>
    </template>
    
    <script>
      
    </script>
  </body>
</html>
```

### uso de la plantilla

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <section>
    </section>
    
    <template id="plantilla1">
      <article>
        <h1>Titulo de prueba</h1>
        <time>Fecha de prueba</time>
        <p>Texto de prueba</p>
        <img src="">
      </article>
    </template>
    
    <script>
      var plantilla = document.querySelector("#plantilla1");
      var clon1 = plantilla.content.cloneNode(true);  // Nuevo en este ejercicio
      var seccion = document.querySelector("section")
      seccion.appendChild(clon1)
      
      var clon2 = plantilla.content.cloneNode(true);
      seccion.appendChild(clon2)
      
      var clon3 = plantilla.content.cloneNode(true);
      seccion.appendChild(clon3)
      
    </script>
  </body>
</html>
```

### plantilla personalizada

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <section>
    </section>
    
    <template id="plantilla1">
      <article>
        <h1>Titulo de prueba</h1>
        <time>Fecha de prueba</time>
        <p>Texto de prueba</p>
        <img src="">
      </article>
    </template>
    
    <script>
      var plantilla = document.querySelector("#plantilla1");
      
      var seccion = document.querySelector("section")
      
      var clon1 = plantilla.content.cloneNode(true);  // Nuevo en este ejercicio
      clon1.querySelector("h1").textContent = "Titulo del articulo 1"
      clon1.querySelector("time").textContent = "2025-10-13"
      clon1.querySelector("p").textContent = "Texto de prueba"
      seccion.appendChild(clon1)
      
      var clon2 = plantilla.content.cloneNode(true);  // Nuevo en este ejercicio
      clon2.querySelector("h1").textContent = "Titulo del articulo 2"
      clon2.querySelector("time").textContent = "2025-10-14"
      clon2.querySelector("p").textContent = "Texto de prueba"
      seccion.appendChild(clon2)
      
    </script>
  </body>
</html>
```

### blog html

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <header>
      <h1>El blog de Jose Vicente</h1>
      <h2>Mis últimas noticias</h2>
    </header>
    <main>
      
    </main>
    <footer>
      (c) 2025 Jose Vicente Carratala
    </footer>
    
    <template id="articulo">
      <article>
        <h1>Titulo de prueba</h1>
        <time>Fecha de prueba</time>
        <p>Texto de prueba</p>
        <img src="">
      </article>
    </template>
    
    <script>
      
      
    </script>
  </body>
</html>
```

### vamos a leer el json

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <header>
      <h1>El blog de Jose Vicente</h1>
      <h2>Mis últimas noticias</h2>
    </header>
    <main>
      
    </main>
    <footer>
      (c) 2025 Jose Vicente Carratala
    </footer>
    
    <template id="articulo">
      <article>
        <h1>Titulo de prueba</h1>
        <time>Fecha de prueba</time>
        <p>Texto de prueba</p>
        <img src="">
      </article>
    </template>
    
    <script>
      fetch("blog.json")              // Ves y busca un archivo
      .then(function(resultado){      // Y cuando lo encuentres
        return resultado.json()       // Interpretalo como json
      })
      .then(function(datos){          // Y cuando esto se haya cumplido
        console.log(datos)            // Vamos a ver los datos en la consola
      })
      
    </script>
  </body>
</html>
```

### ahora clono la plantilla

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <header>
      <h1>El blog de Jose Vicente</h1>
      <h2>Mis últimas noticias</h2>
    </header>
    <main>
      
    </main>
    <footer>
      (c) 2025 Jose Vicente Carratala
    </footer>
    
    <template id="articulo">
      <article>
        <h1>Titulo de prueba</h1>
        <time>Fecha de prueba</time>
        <p>Texto de prueba</p>
        <img src="">
      </article>
    </template>
    
    <script>
      fetch("blog.json")              // Ves y busca un archivo
      .then(function(resultado){      // Y cuando lo encuentres
        return resultado.json()       // Interpretalo como json
      })
      .then(function(datos){          // Y cuando esto se haya cumplido
        console.log(datos)            // Vamos a ver los datos en la consola
        var contenedor = document.querySelector("main")
        var plantilla = document.querySelector("#articulo")
        
        datos.forEach(function(articulo){  // Para cada uno de los articulos del json:
          let clon = plantilla.content.cloneNode(true) // Creo un clon de la plantilla
          contenedor.appendChild(clon)                  // Y añado el clon al contenedor
        })
        
      })
      
    </script>
  </body>
</html>
```

### personalizo el contenido del clon

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <header>
      <h1>El blog de Jose Vicente</h1>
      <h2>Mis últimas noticias</h2>
    </header>
    <main>
      
    </main>
    <footer>
      (c) 2025 Jose Vicente Carratala
    </footer>
    
    <template id="articulo">
      <article>
        <h3>Titulo de prueba</h3>
        <time>Fecha de prueba</time>
        <p>Texto de prueba</p>
        <img src="">
      </article>
    </template>
    
    <script>
      fetch("blog.json")              // Ves y busca un archivo
      .then(function(resultado){      // Y cuando lo encuentres
        return resultado.json()       // Interpretalo como json
      })
      .then(function(datos){          // Y cuando esto se haya cumplido
        console.log(datos)            // Vamos a ver los datos en la consola
        var contenedor = document.querySelector("main")
        var plantilla = document.querySelector("#articulo")
        
        datos.forEach(function(articulo){  // Para cada uno de los articulos del json:
          let clon = plantilla.content.cloneNode(true) // Creo un clon de la plantilla
          clon.querySelector("h3").textContent = articulo.titulo
          contenedor.appendChild(clon)                  // Y añado el clon al contenedor
        })
        
      })
      
    </script>
  </body>
</html>
```

### personalizo mas propiedades

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <header>
      <h1>El blog de Jose Vicente</h1>
      <h2>Mis últimas noticias</h2>
    </header>
    <main>
      
    </main>
    <footer>
      (c) 2025 Jose Vicente Carratala
    </footer>
    
    <template id="articulo">
      <article>
        <h3>Titulo de prueba</h3>
        <time>Fecha de prueba</time>
        <p>Texto de prueba</p>
        <img src="">
      </article>
    </template>
    
    <script>
      fetch("blog.json")              // Ves y busca un archivo
      .then(function(resultado){      // Y cuando lo encuentres
        return resultado.json()       // Interpretalo como json
      })
      .then(function(datos){          // Y cuando esto se haya cumplido
        console.log(datos)            // Vamos a ver los datos en la consola
        var contenedor = document.querySelector("main")
        var plantilla = document.querySelector("#articulo")
        
        datos.forEach(function(articulo){  // Para cada uno de los articulos del json:
          let clon = plantilla.content.cloneNode(true) // Creo un clon de la plantilla
          clon.querySelector("h3").textContent = articulo.titulo
          clon.querySelector("time").textContent = articulo.fecha
          clon.querySelector("p").textContent = articulo.texto
          clon.querySelector("img").setAttribute("src",articulo.imagen)
          contenedor.appendChild(clon)                  // Y añado el clon al contenedor
        })
        
      })
      
    </script>
  </body>
</html>
```

### un poco de css para acabar

```html
<!doctype html>
<html>
  <head>
    <title>Blog</title>
    <meta charset="utf-8">
    <style>
      body{background:lightgray;font-family:sans-serif;}
      header,footer,main{background:white;padding:20px;margin:auto;width:600px;}
      header,footer{text-align:center;}
      main{display:grid;grid-template-columns:auto auto auto;gap:20px;}
      article img{width:100%;border-radius:5px;}
    </style>
  </head>
  <body> 
    <header>
      <h1>El blog de Jose Vicente</h1>
      <h2>Mis últimas noticias</h2>
    </header>
    <main>
      
    </main>
    <footer>
      (c) 2025 Jose Vicente Carratala
    </footer>
    
    <template id="articulo">
      <article>
        <h3>Titulo de prueba</h3>
        <time>Fecha de prueba</time>
        <p>Texto de prueba</p>
        <img src="">
      </article>
    </template>
    
    <script>
      fetch("blog.json")              // Ves y busca un archivo
      .then(function(resultado){      // Y cuando lo encuentres
        return resultado.json()       // Interpretalo como json
      })
      .then(function(datos){          // Y cuando esto se haya cumplido
        console.log(datos)            // Vamos a ver los datos en la consola
        var contenedor = document.querySelector("main")
        var plantilla = document.querySelector("#articulo")
        
        datos.forEach(function(articulo){  // Para cada uno de los articulos del json:
          let clon = plantilla.content.cloneNode(true) // Creo un clon de la plantilla
          clon.querySelector("h3").textContent = articulo.titulo
          clon.querySelector("time").textContent = articulo.fecha
          clon.querySelector("p").textContent = articulo.texto
          clon.querySelector("img").setAttribute("src",articulo.imagen)
          contenedor.appendChild(clon)                  // Y añado el clon al contenedor
        })
        
      })
      
    </script>
  </body>
</html>
```

### blog

```json
[
  {
    "titulo":"Articulo 1",
    "fecha":"2025-10-13",
    "texto":"Este es un texto 1",
    "imagen":"josevicente.jpg"
  },
  {
    "titulo":"Articulo 2",
    "fecha":"2025-10-14",
    "texto":"Este es un texto 2",
    "imagen":"josevicente.jpg"
  },
  {
    "titulo":"Articulo 3",
    "fecha":"2025-10-15",
    "texto":"Este es un texto 3",
    "imagen":"josevicente.jpg"
  },
  {
    "titulo":"Articulo 4",
    "fecha":"2025-10-16",
    "texto":"Este es un texto 4",
    "imagen":"josevicente.jpg"
  },
  {
    "titulo":"Articulo 2",
    "fecha":"2025-10-14",
    "texto":"Este es un texto 2",
    "imagen":"josevicente.jpg"
  },
  {
    "titulo":"Articulo 3",
    "fecha":"2025-10-15",
    "texto":"Este es un texto 3",
    "imagen":"josevicente.jpg"
  },
  {
    "titulo":"Articulo 4",
    "fecha":"2025-10-16",
    "texto":"Este es un texto 4",
    "imagen":"josevicente.jpg"
  }
]
```

<a id="eliminacion-de-elementos"></a>
## Eliminación de elementos

En el mundo digital, la capacidad de manipular documentos web es una habilidad fundamental para cualquier desarrollador o profesional que trabaje con interfaces de usuario. La eliminación de elementos es un aspecto crucial de esta competencia, ya que permite a los programadores modificar dinámicamente las páginas web en respuesta a acciones del usuario o cambios en el estado de la aplicación.

La eliminación de elementos en documentos web se realiza mediante JavaScript, un lenguaje de script que permite interactuar con el contenido y la estructura de una página. Al eliminar elementos, los desarrolladores pueden ajustar la interfaz de usuario en tiempo real, mostrando o ocultando información según sea necesario. Por ejemplo, cuando un usuario hace clic en un botón para cerrar una ventana emergente, es posible que desees eliminar esa ventana del DOM (Modelo de Objeto del Documento) para evitar que continue ocupando espacio y recursos.

La eliminación de elementos se realiza mediante el método `remove()` o `removeChild()`. El método `remove()` elimina directamente el elemento seleccionado del DOM, mientras que `removeChild()` lo hace eliminando un hijo específico de un elemento padre. Ambos métodos son muy útiles para actualizar la interfaz de usuario en respuesta a eventos.

Es importante tener cuidado al eliminar elementos, ya que esto puede causar problemas si no se maneja correctamente. Por ejemplo, si intentas eliminar un elemento que aún tiene referencias en el código JavaScript, es posible que obtengas errores cuando trates de acceder a ese elemento más adelante. Para evitar este problema, es recomendable eliminar los elementos solo cuando ya no sean necesarios o cuando hayan sido completamente reemplazados.

La eliminación de elementos también puede ser utilizada para optimizar el rendimiento de la página web. Al eliminar elementos que ya no son relevantes, se libera espacio en memoria y se reduce la carga del navegador, lo que puede mejorar significativamente la velocidad de respuesta de la aplicación.

En resumen, la eliminación de elementos es una habilidad esencial para cualquier desarrollador web. A través de JavaScript, los programadores pueden modificar dinámicamente las páginas web en respuesta a eventos y acciones del usuario, mostrando o ocultando información según sea necesario. Con el método `remove()` o `removeChild()`, los desarrolladores pueden eliminar elementos del DOM con facilidad, pero es importante tener cuidado al hacerlo para evitar problemas de rendimiento y errores en el código.

### estatico

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <div id="contenedor1">Yo soy el contenedor 1</div>
    <div id="contenedor2">Yo soy el contenedor 2</div>
    <div id="contenedor3">Yo soy el contenedor 3</div>
    <script>
      
    </script>
  </body>
</html>
```

### elimino un elemento

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <div id="contenedor1">Yo soy el contenedor 1</div>
    <div id="contenedor2">Yo soy el contenedor 2</div>
    <div id="contenedor3">Yo soy el contenedor 3</div>
    <script>
      let eliminar = document.querySelector("#contenedor1");
      eliminar.remove()
    </script>
  </body>
</html>
```

### sigue en la memoria

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <div id="contenedor1">Yo soy el contenedor 1</div>
    <div id="contenedor2">Yo soy el contenedor 2</div>
    <div id="contenedor3">Yo soy el contenedor 3</div>
    <script>
      let eliminar = document.querySelector("#contenedor1");
      eliminar.remove()
      console.log(eliminar)
    </script>
  </body>
</html>
```

### lo pongo en otra parte

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <div id="contenedor1">Yo soy el contenedor 1</div>
    <div id="contenedor2">Yo soy el contenedor 2</div>
    <div id="contenedor3">Yo soy el contenedor 3</div>
    <div id="papelera"></div>
    <script>
      let eliminar = document.querySelector("#contenedor1");
      eliminar.remove()
      console.log(eliminar)
      let papelera = document.querySelector("#papelera")
      papelera.appendChild(eliminar)
    </script>
  </body>
</html>
```

### lo elimino pero de verdad

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <div id="contenedor1">Yo soy el contenedor 1</div>
    <div id="contenedor2">Yo soy el contenedor 2</div>
    <div id="contenedor3">Yo soy el contenedor 3</div>
    <div id="papelera"></div>
    <script>
      let eliminar = document.querySelector("#contenedor1");
      eliminar.remove()
      console.log(eliminar)
      eliminar = null;
      console.log(eliminar)
      let papelera = document.querySelector("#papelera")
      papelera.appendChild(eliminar)
    </script>
  </body>
</html>
```

<a id="manipulacion-de-estilos"></a>
## Manipulación de estilos

La manipulación de estilos es una habilidad fundamental en el desarrollo web que permite a los desarrolladores personalizar la apariencia visual de las páginas web. Esta técnica es esencial para crear interfaces de usuario atractivas y funcionales, adaptándose así a las necesidades específicas del proyecto o del público objetivo.

En este contexto, aprender a manipular estilos implica dominar el uso de hojas de estilo en cascada (CSS), un lenguaje que permite definir la apariencia y el formato de los elementos HTML. A través de CSS, se pueden controlar aspectos como colores, fuentes, tamaños de texto, márgenes, bordes, posiciones y muchas otras propiedades visuales.

La manipulación de estilos no es solo sobre cambiar la apariencia superficial; también implica entender cómo estructurar el código CSS para mantenerlo limpio, eficiente y fácilmente mantenible. Esto incluye la utilización de selectores específicos, la organización en clases y IDs, y la aplicación de técnicas como el uso de preprocesadores (como Sass o Less) para facilitar la gestión del código.

Además, la manipulación de estilos es un proceso iterativo que requiere práctica y experimentación. Los desarrolladores deben estar dispuestos a probar diferentes combinaciones de propiedades y valores hasta lograr el efecto deseado. Esta capacidad creativa y experimental es crucial para crear interfaces web únicas y personalizadas.

La manipulación de estilos también implica conocer cómo interactuar con JavaScript, otro lenguaje fundamental en el desarrollo web. A través de eventos y métodos de JavaScript, se pueden modificar dinámicamente los estilos de los elementos HTML, permitiendo una interactividad más rica y fluida.

En resumen, la manipulación de estilos es un aspecto integral del desarrollo web que requiere conocimientos técnicos, creatividad y práctica. A través de esta habilidad, se pueden crear interfaces de usuario atractivas, funcionales y personalizadas, adaptándose así a las necesidades específicas del proyecto o del público objetivo.

### ejercicio

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <div id="contenedor">Este es el contenido</div>
    <script>
      let contenedor = document.querySelector("#contenedor")
      contenedor.style.color = "red";
    </script>
  </body>
</html>
```

### color de fondo

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <div id="contenedor">Este es el contenido</div>
    <script>
      let contenedor = document.querySelector("#contenedor")
      contenedor.style.color = "red";
      contenedor.style.background = "blue";
    </script>
  </body>
</html>
```

### ahora pongo padding

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <div id="contenedor">Este es el contenido</div>
    <script>
      let contenedor = document.querySelector("#contenedor")
      contenedor.style.color = "red";
      contenedor.style.background = "blue";
      contenedor.style.padding = "10px"
    </script>
  </body>
</html>
```

### estilo en campo

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <input type="text">
    <script>
      let entrada = document.querySelector("input")
      entrada.style.background = "grey";
    </script>
  </body>
</html>
```

### estilo con evento

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <input type="text">
    <script>
      let entrada = document.querySelector("input")
      entrada.style.background = "grey";
      entrada.onfocus = function(){
        entrada.style.background = "lightgreen";
      }
    </script>
  </body>
</html>
```

### varios eventos

```html
<!doctype html>
<html>
  <head>
  </head>
  <body> 
    <input type="text">
    <script>
      let entrada = document.querySelector("input")
      entrada.style.background = "lightgrey";
      entrada.onfocus = function(){
        entrada.style.background = "lightgreen";
      }
      entrada.onblur =  function(){
        entrada.style.background = "lightgrey"
      }
    </script>
  </body>
</html>
```

### clases css

```html
<!doctype html>
<html>
  <head>
    <style>
      input{
        border:1px solid lightgrey;
        background:lightgray;
        padding:5px;
        transition: all 1s;
      }
      .activado{
        background:lightgreen;
      }
    </style>
  </head>
  <body> 
    <input type="text">
    <script>
      let entrada = document.querySelector("input")
      entrada.onfocus = function(){
        entrada.classList.add("activado")
      }
      
    </script>
  </body>
</html>
```

### quitar clase css

```html
<!doctype html>
<html>
  <head>
    <style>
      input{
        border:1px solid lightgrey;
        background:lightgray;
        padding:5px;
        transition: all 1s;
      }
      .activado{
        background:lightgreen;
      }
    </style>
  </head>
  <body> 
    <input type="text">
    <script>
      let entrada = document.querySelector("input")
      entrada.onfocus = function(){
        entrada.classList.add("activado")
      }
      entrada.onblur = function(){
        entrada.classList.remove("activado")
      }
      
    </script>
  </body>
</html>
```

### validador de dni

```html
<!doctype html>
<html>
  <head>
    <style>
      
    </style>
  </head>
  <body> 
    <header><h1>jocarsa | dni</h1></header>
    <main>
      <input type="text">
    </main>
    <footer>(c) 2025 Jose Vicente Carratalá</footer>
    <script>
      // DNI = 8 números una letra
      let cadena = "TRWAGMYFPDXBNJZSQVHLCKE";
      let numero = 12345678;
      let resto = numero % 23;
      let letra = cadena[resto]
      console.log(letra)
    </script>
  </body>
</html>
```

### numero dinámico

```html
<!doctype html>
<html>
  <head>
    <style>
      
    </style>
  </head>
  <body> 
    <header><h1>jocarsa | dni</h1></header>
    <main>
      <input type="text"><div id="letra">
    </main>
    <footer>(c) 2025 Jose Vicente Carratalá</footer>
    <script>
      function calculaLetra(numero){
        let cadena = "TRWAGMYFPDXBNJZSQVHLCKE";
        return cadena[numero % 23];
      }
 
      let entrada = document.querySelector("input");
      let salida = document.querySelector("#letra")
      entrada.onkeyup = function(){
        let contenido = this.value;
        salida.textContent = calculaLetra(contenido)
      }
    </script>
  </body>
</html>
```

### clases de estilo

```html
<!doctype html>
<html>
  <head>
    <style>
      input{background:lightsteelblue;border:none;padding:5px;}
      .error{background:lightcoral;}
      .correcto{background:lightgreen;}
    </style>
  </head>
  <body> 
    <header><h1>jocarsa | dni</h1></header>
    <main>
      <input type="number"><div id="letra">
    </main>
    <footer>(c) 2025 Jose Vicente Carratalá</footer>
    <script>
      function calculaLetra(numero){
        let cadena = "TRWAGMYFPDXBNJZSQVHLCKE";
        return cadena[numero % 23];
      }
 
      let entrada = document.querySelector("input");
      let salida = document.querySelector("#letra")
      entrada.onkeyup = function(){
        let contenido = this.value;
        // Compruebo la longitud del campo
        if(contenido.length == 8){
          entrada.classList.add("correcto")
        }else{
          entrada.classList = ""
          entrada.classList.add("error")
        }
        salida.textContent = calculaLetra(contenido)
      }
    </script>
  </body>
</html>
```

### supedito el calculo a solo cuando es correcto

```html
<!doctype html>
<html>
  <head>
    <style>
      input{background:lightsteelblue;border:none;padding:5px;}
      .error{background:lightcoral;}
      .correcto{background:lightgreen;}
    </style>
  </head>
  <body> 
    <header><h1>jocarsa | dni</h1></header>
    <main>
      <input type="number"><div id="letra">
    </main>
    <footer>(c) 2025 Jose Vicente Carratalá</footer>
    <script>
      function calculaLetra(numero){
        let cadena = "TRWAGMYFPDXBNJZSQVHLCKE";
        return cadena[numero % 23];
      }
 
      let entrada = document.querySelector("input");
      let salida = document.querySelector("#letra")
      entrada.onkeyup = function(){
        let contenido = this.value;
        // Compruebo la longitud del campo
        if(contenido.length == 8){
          entrada.classList.add("correcto")
          salida.textContent = calculaLetra(contenido)
        }else{
          entrada.classList = ""
          entrada.classList.add("error")
        }
        
      }
    </script>
  </body>
</html>
```

### estilo

```html
<!doctype html>
<html>
  <head>
    <title>jocarsa | dni</title>
    <meta charset="utf-8">
    <style>
      body{background:lightsteelblue;font-family:sans-serif;text-align:center;}
      input{background:lightsteelblue;border:none;padding:5px;outline:none;height:30px;}
      .error{background:lightcoral;}
      .correcto{background:lightgreen;}
      header,main,footer{background:white;padding:20px;margin:auto;width:250px;}
      main{display:flex;justify-content:center;}
      #letra{border:3px solid lightsteelblue;width:30px;text-align:center;line-height:30px;height:34px;}
      footer p{font-size:10px;}
    </style>
  </head>
  <body> 
    <header>
      <h1>jocarsa | dni</h1>
      <p>Introduce los números de un DNI para calcular la letra</p>
    </header>
    <main>
      <input type="number"><div id="letra">
    </main>
    <footer>
    <p>Retroalimentación:</p>
    (c) 2025 Jose Vicente Carratalá
    
    </footer>
    <script>
      function calculaLetra(numero){
        let cadena = "TRWAGMYFPDXBNJZSQVHLCKE";
        return cadena[numero % 23];
      }
 
      let entrada = document.querySelector("input");
      let salida = document.querySelector("#letra")
      let retroalimentacion = document.querySelector("footer p")
      entrada.onkeyup = function(){
        let contenido = this.value;
        // Compruebo la longitud del campo
        if(contenido.length == 8){
          entrada.classList.add("correcto")
          salida.textContent = calculaLetra(contenido)
          retroalimentacion.textContent = "Ahora es correcto."
          retroalimentacion.style.color = "green"
        }else{
          entrada.classList = ""
          entrada.classList.add("error")
          retroalimentacion.innerHTML = "El valor que has introducido tiene  "+this.value.length+" caracteres. <br>Debe tener 8 caracteres."
          retroalimentacion.style.color = "red"
        }
        
      }
    </script>
  </body>
</html>
```

### mejoramos mas el estilo

```html
<!doctype html>
<html>
  <head>
    <title>jocarsa | dni</title>
    <meta charset="utf-8">
    <style>
      body{background:lightsteelblue;font-family:sans-serif;text-align:center;}
      input{background:lightsteelblue;border:none;padding:5px;outline:none;height:30px;}
      .error{background:lightcoral;}
      .correcto{background:lightgreen;}
      header,main,footer{background:white;padding:20px;margin:auto;width:250px;font-size:11px;}
      main{display:flex;justify-content:center;}
      #letra{border:3px solid lightsteelblue;width:30px;text-align:center;line-height:30px;height:34.0px;font-size:20px;font-weight:bold;}
      footer p{font-size:10px;}
      header{border-radius:10px 10px 0px 0px;}
      footer{border-radius:0px 0px 10px 10px;}
      input{border-radius:5px 0px 0px 5px;}
      #letra{border-radius:0px 5px 5px 0px;}
    </style>
  </head>
  <body> 
    <header>
      <h1>jocarsa | dni</h1>
      <p>Introduce los números de un DNI para calcular la letra</p>
    </header>
    <main>
      <input type="number"><div id="letra">
    </main>
    <footer>
    <p>Retroalimentación:</p>
    (c) 2025 Jose Vicente Carratalá
    
    </footer>
    <script>
      function calculaLetra(numero){
        let cadena = "TRWAGMYFPDXBNJZSQVHLCKE";
        return cadena[numero % 23];
      }
 
      let entrada = document.querySelector("input");
      let salida = document.querySelector("#letra")
      let retroalimentacion = document.querySelector("footer p")
      entrada.onkeyup = function(){
        let contenido = this.value;
        // Compruebo la longitud del campo
        if(contenido.length == 8){
          entrada.classList.add("correcto")
          salida.textContent = calculaLetra(contenido)
          retroalimentacion.textContent = "Ahora es correcto."
          retroalimentacion.style.color = "green"
          salida.style.border = "3px solid lightgreen";
        }else{
          entrada.classList = ""
          entrada.classList.add("error")
          retroalimentacion.innerHTML = "El valor que has introducido tiene  "+this.value.length+" caracteres. <br>Debe tener 8 caracteres."
          retroalimentacion.style.color = "red"
          salida.style.border = "3px solid lightcoral";
        }
        
      }
    </script>
  </body>
</html>
```

<a id="curriculum-1"></a>
## Curriculum

<a id="portafolio"></a>
## Portafolio

### inicio portafolio

```html
<!docytpe html>
<html>
  <head>
  </head>
  <body>
    <header>
      <h1>Jose Vicente Carratala</h1>
      <h2>Portafolio</h2>
    </header>
    <main>
    </main>
    <footer>
    </footer>
  </body>
</html>
```

### fondo negro

```html
<!docytpe html>
<html>
  <head>
    <style>
      body{
        background:DarkSlateGray;
        color:LightGray;
        font-family:sans-serif;
      }
    </style>
  </head>
  <body>
    <header>
      <h1>Jose Vicente Carratala</h1>
      <h2>Portafolio</h2>
    </header>
    <main>
    </main>
    <footer>
    </footer>
  </body>
</html>
```

### bloques principales

```html
<!docytpe html>
<html>
  <head>
    <style>
      body{
        background:DarkSlateGray;
        color:LightGray;
        font-family:sans-serif;
      }
      header,footer,main{
        width:600px;
        margin:auto;
        text-align:center;
        padding:20px;
      }
    </style>
  </head>
  <body>
    <header>
      <h1>Jose Vicente Carratala</h1>
      <h2>Portafolio</h2>
    </header>
    <main>
    </main>
    <footer>
    </footer>
  </body>
</html>
```

### creo un elemento de portafolio

```html
<!docytpe html>
<html>
  <head>
    <style>
      body{
        background:DarkSlateGray;
        color:LightGray;
        font-family:sans-serif;
      }
      header,footer,main{
        width:600px;
        margin:auto;
        text-align:center;
        padding:20px;
      }
    </style>
  </head>
  <body>
    <header>
      <h1>Jose Vicente Carratala</h1>
      <h2>Portafolio</h2>
    </header>
    <main>
      <article>
        <img src="images.jpeg">
      </article>
    </main>
    <footer>
    </footer>
  </body>
</html>
```

### muchos articulos

```html
<!docytpe html>
<html>
  <head>
    <style>
      body{
        background:DarkSlateGray;
        color:LightGray;
        font-family:sans-serif;
      }
      header,footer,main{
        width:600px;
        margin:auto;
        text-align:center;
        padding:20px;
      }
    </style>
  </head>
  <body>
    <header>
      <h1>Jose Vicente Carratala</h1>
      <h2>Portafolio</h2>
    </header>
    <main>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      
    </main>
    <footer>
    </footer>
  </body>
</html>
```

### uso grid

```html
<!docytpe html>
<html>
  <head>
    <style>
      body{
        background:DarkSlateGray;
        color:LightGray;
        font-family:sans-serif;
      }
      header,footer,main{
        width:800px;
        margin:auto;
        text-align:center;
        padding:20px;
      }
      main{
        display:grid;
        grid-template-columns:auto auto auto auto;
        gap:20px;
      }
      main img{
        width:100%;
        border:2px solid white;
        box-shadow:0px 10px 20px rgba(0,0,0,0.3);
      }
    </style>
  </head>
  <body>
    <header>
      <h1>Jose Vicente Carratala</h1>
      <h2>Portafolio</h2>
    </header>
    <main>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      
    </main>
    <footer>
    </footer>
  </body>
</html>
```

### modal

```html
<!docytpe html>
<html>
  <head>
    <style>
      body{
        background:DarkSlateGray;
        color:LightGray;
        font-family:sans-serif;
      }
      header,footer,main{
        width:800px;
        margin:auto;
        text-align:center;
        padding:20px;
      }
      main{
        display:grid;
        grid-template-columns:auto auto auto auto;
        gap:20px;
      }
      main img{
        width:100%;
        border:2px solid white;
        box-shadow:0px 10px 20px rgba(0,0,0,0.3);
      }
    </style>
  </head>
  <body>
    <header>
      <h1>Jose Vicente Carratala</h1>
      <h2>Portafolio</h2>
    </header>
    <main>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      
    </main>
    <footer>
    </footer>
    <style>
      #contienemodal{
        position:fixed;
        top:0px;
        left:0px;
        width:100%;
        height:100%;
        background:rgba(0,0,0,0.6);
        display:flex;
        justify-content:center;
        align-items:center;
      }
    </style>
    <div id="contienemodal">
      <div id="modal">
        <img src="images.jpeg">
      </div>
    </div>
  </body>
</html>
```

### Ahora el modal

```html
<!docytpe html>
<html>
  <head>
    <style>
      body{
        background:DarkSlateGray;
        color:LightGray;
        font-family:sans-serif;
      }
      header,footer,main{
        width:800px;
        margin:auto;
        text-align:center;
        padding:20px;
      }
      main{
        display:grid;
        grid-template-columns:auto auto auto auto;
        gap:20px;
      }
      main img{
        width:100%;
        border:2px solid white;
        box-shadow:0px 10px 20px rgba(0,0,0,0.3);
      }
    </style>
  </head>
  <body>
    <header>
      <h1>Jose Vicente Carratala</h1>
      <h2>Portafolio</h2>
    </header>
    <main>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      
    </main>
    <footer>
    </footer>
    <style>
      #contienemodal{
        position:fixed;
        top:0px;
        left:0px;
        width:100%;
        height:100%;
        background:rgba(0,0,0,0.6);
        display:none;
        justify-content:center;
        align-items:center;
        
      }
      #modal{
        width:400px;
        height:300px;
        text-align:center;
        padding:20px;
        background:white;
      }
    </style>
    <div id="contienemodal">
      <div id="modal">
        <img src="images.jpeg">
      </div>
    </div>
  </body>
</html>
```

### javascipt ventana modal

```html
<!docytpe html>
<html>
  <head>
    <style>
      body{
        background:DarkSlateGray;
        color:LightGray;
        font-family:sans-serif;
      }
      header,footer,main{
        width:800px;
        margin:auto;
        text-align:center;
        padding:20px;
      }
      main{
        display:grid;
        grid-template-columns:auto auto auto auto;
        gap:20px;
      }
      main img{
        width:100%;
        border:2px solid white;
        box-shadow:0px 10px 20px rgba(0,0,0,0.3);
      }
    </style>
  </head>
  <body>
    <header>
      <h1>Jose Vicente Carratala</h1>
      <h2>Portafolio</h2>
    </header>
    <main>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      
    </main>
    <footer>
    </footer>
    <style>
      #contienemodal{
        position:fixed;
        top:0px;
        left:0px;
        width:100%;
        height:100%;
        background:rgba(0,0,0,0.6);
        display:none;
        justify-content:center;
        align-items:center;
        
      }
      #modal{
        width:400px;
        height:300px;
        text-align:center;
        padding:20px;
        background:white;
      }
    </style>
    <div id="contienemodal">
      <div id="modal">
        <img src="images.jpeg">
      </div>
    </div>
    <script>
      let imagenes = document.querySelectorAll("img")
      imagenes.forEach(function(imagen){
        imagen.onclick = function(){
          document.querySelector("#contienemodal").style.display = "flex"
        }
      })
    </script>
  </body>
</html>
```

### mejoras en el estilo

```html
<!docytpe html>
<html>
  <head>
    <style>
      body{
        background:DarkSlateGray;
        color:LightGray;
        font-family:sans-serif;
      }
      header,footer,main{
        width:800px;
        margin:auto;
        text-align:center;
        padding:20px;
      }
      main{
        display:grid;
        grid-template-columns:auto auto auto auto;
        gap:20px;
      }
      main img{
        width:100%;
        border:2px solid white;
        box-shadow:0px 10px 20px rgba(0,0,0,0.3);
      }
    </style>
  </head>
  <body>
    <header>
      <h1>Jose Vicente Carratala</h1>
      <h2>Portafolio</h2>
    </header>
    <main>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      <article>
        <img src="images.jpeg">
      </article>
      
    </main>
    <footer>
    </footer>
    <style>
      #contienemodal{
        position:fixed;
        top:0px;
        left:0px;
        width:100%;
        height:100%;
        background:rgba(0,0,0,0.6);
        display:none;
        justify-content:center;
        align-items:center;
        
      }
      #modal{
        width:400px;
        height:300px;
        text-align:center;
        padding:20px;
        background:white;
        display:flex;
        justify-content:center;
        align-items:center;
        border-radius:10px;
        box-shadow:0px 10px 20px black;
      }
    </style>
    <div id="contienemodal">
      <div id="modal">
        <img src="images.jpeg">
      </div>
    </div>
    <script>
      let imagenes = document.querySelectorAll("img")
      imagenes.forEach(function(imagen){
        imagen.onclick = function(){
          document.querySelector("#contienemodal").style.display = "flex"
        }
      })
    </script>
  </body>
</html>
```

<a id="simulacro-de-examen"></a>
## Simulacro de examen

### Enunciado

```markdown
Haz una web en HTML, CSS, y JS, que sea tu portafolio de proyectos

Debe tener header, main y footer
En el main deben haber articles con tus piezas de portafolio

En el header debe aparecer tu nombre y tu contacto

En el footer debe aparecer un aviso de copyright y tu email

Crea un estilo CSS adecuado para un portafolio

Primero crealo estático - y luego consume datos con JSON a partir de Javascript

Importante: Tenéis que desarrollar en estilo iterativo incremental (como yo)

JS - clon de plantillas/template en HTML/CSS/JS - clase 13 de octubre, a primera hora
```

### estructura inicial

```html
<!doctype html>
<html lang="es">
  <head>
    <title>El portafolio de Jose Vicente</title>
    <meta charset="utf-8">
  </head>
  <body>
    <header>
      
    </header>
    <main>
    </main>
    <footer>
    </footer>
  </body>
</html>
```

### estructura inicial

```markdown
<!doctype html>
<html lang="es">
  <head>
    <title>El portafolio de Jose Vicente</title>
    <meta charset="utf-8">
  </head>
  <body>
    <header>
      
    </header>
    <main>
    </main>
    <footer>
    </footer>
  </body>
</html>
```

### titulos y contacto

```html
<!doctype html>
<html lang="es">
  <head>
    <title>El portafolio de Jose Vicente</title>
    <meta charset="utf-8">
  </head>
  <body>
    <header>
      <h1>Jose Vicente Carratala</h1>
      <h2>info@jocarsa.com</h2>
    </header>
    <main>
    </main>
    <footer>
    </footer>
  </body>
</html>
```

### articulos

```html
<!doctype html>
<html lang="es">
  <head>
    <title>El portafolio de Jose Vicente</title>
    <meta charset="utf-8">
  </head>
  <body>
    <header>
      <h1>Jose Vicente Carratala</h1>
      <h2>info@jocarsa.com</h2>
    </header>
    <main>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
    </main>
    <footer>
    </footer>
  </body>
</html>
```

### pie de pagina

```html
<!doctype html>
<html lang="es">
  <head>
    <title>El portafolio de Jose Vicente</title>
    <meta charset="utf-8">
  </head>
  <body>
    <header>
      <h1>Jose Vicente Carratala</h1>
      <h2>info@jocarsa.com</h2>
    </header>
    <main>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
    </main>
    <footer>
      (c) 2025 Jose Vicente Carratala
    </footer>
  </body>
</html>
```

### un poco de estilo

```html
<!doctype html>
<html lang="es">
  <head>
    <title>El portafolio de Jose Vicente</title>
    <meta charset="utf-8">
    <style>
      body,html{background:grey;font-family:sans-serif;}
      header,main,footer{background:white;padding:20px;text-align:center;margin:auto;width:600px;}
    </style>
  </head>
  <body>
    <header>
      <h1>Jose Vicente Carratala</h1>
      <h2>info@jocarsa.com</h2>
    </header>
    <main>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
    </main>
    <footer>
      (c) 2025 Jose Vicente Carratala
    </footer>
  </body>
</html>
```

### estilo de los articulos

```html
<!doctype html>
<html lang="es">
  <head>
    <title>El portafolio de Jose Vicente</title>
    <meta charset="utf-8">
    <style>
      body,html{background:grey;font-family:sans-serif;}
      header,main,footer{background:white;padding:20px;text-align:center;margin:auto;width:600px;}
      main{display:grid;grid-template-columns:auto auto auto;gap:20px;}
    </style>
  </head>
  <body>
    <header>
      <h1>Jose Vicente Carratala</h1>
      <h2>info@jocarsa.com</h2>
    </header>
    <main>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
    </main>
    <footer>
      (c) 2025 Jose Vicente Carratala
    </footer>
  </body>
</html>
```

### tocamos el estilo de las imagenes

```html
<!doctype html>
<html lang="es">
  <head>
    <title>El portafolio de Jose Vicente</title>
    <meta charset="utf-8">
    <style>
      body,html{background:grey;font-family:sans-serif;}
      header,main,footer{background:white;padding:20px;text-align:center;margin:auto;width:600px;}
      main{display:grid;grid-template-columns:auto auto auto;gap:20px;}
      article img{width:100%;}
    </style>
  </head>
  <body>
    <header>
      <h1>Jose Vicente Carratala</h1>
      <h2>info@jocarsa.com</h2>
    </header>
    <main>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
    </main>
    <footer>
      (c) 2025 Jose Vicente Carratala
    </footer>
  </body>
</html>
```

### cargamos json

```html
<!doctype html>
<html lang="es">
  <head>
    <title>El portafolio de Jose Vicente</title>
    <meta charset="utf-8">
    <style>
      body,html{background:grey;font-family:sans-serif;}
      header,main,footer{background:white;padding:20px;text-align:center;margin:auto;width:600px;}
      main{display:grid;grid-template-columns:auto auto auto;gap:20px;}
      article img{width:100%;}
    </style>
  </head>
  <body>
    <header>
      <h1>Jose Vicente Carratala</h1>
      <h2>info@jocarsa.com</h2>
    </header>
    <main>
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
      
    </main>
    <footer>
      (c) 2025 Jose Vicente Carratala
    </footer>
    <script>
      fetch("portafolio.json")
      .then(function(respuesta){return respuesta.json()})
      .then(function(datos){
        console.log(datos)
      })
    </script>
  </body>
</html>
```

### vamos a crear un template

```html
<!doctype html>
<html lang="es">
  <head>
    <title>El portafolio de Jose Vicente</title>
    <meta charset="utf-8">
    <style>
      body,html{background:grey;font-family:sans-serif;}
      header,main,footer{background:white;padding:20px;text-align:center;margin:auto;width:600px;}
      main{display:grid;grid-template-columns:auto auto auto;gap:20px;}
      article img{width:100%;}
    </style>
  </head>
  <body>
    <header>
      <h1>Jose Vicente Carratala</h1>
      <h2>info@jocarsa.com</h2>
    </header>
    <main>
      
      
    </main>
    <footer>
      (c) 2025 Jose Vicente Carratala
    </footer>
    <template id="plantilla_entrada">
      <article>
        <h3>Nombre de la pieza</h3>
        <p>Explicación de la pieza</p>
        <img src="josevicente.jpg">
      </article>
    </template>
    <script>
      fetch("portafolio.json")
      .then(function(respuesta){return respuesta.json()})
      .then(function(datos){
        console.log(datos)
      })
    </script>
  </body>
</html>
```

### definimos origen y destino

```html
<!doctype html>
<html lang="es">
  <head>
    <title>El portafolio de Jose Vicente</title>
    <meta charset="utf-8">
    <style>
      body,html{background:grey;font-family:sans-serif;}
      header,main,footer{background:white;padding:20px;text-align:center;margin:auto;width:600px;}
      main{display:grid;grid-template-columns:auto auto auto;gap:20px;}
      article img{width:100%;}
    </style>
  </head>
  <body>
    <header>
      <h1>Jose Vicente Carratala</h1>
      <h2>info@jocarsa.com</h2>
    </header>
    <main>
      
      
    </main>
    <footer>
      (c) 2025 Jose Vicente Carratala
    </footer>
    <template id="plantilla_entrada">
      <article>
        <h3></h3>
        <p></p>
        <img src="">
      </article>
    </template>
    <script>
      let origen = document.querySelector("#plantilla_entrada")
      let destino = document.querySelector("main")
      fetch("portafolio.json")
      .then(function(respuesta){return respuesta.json()})
      .then(function(datos){
        console.log(datos)
      })
    </script>
  </body>
</html>
```

### clon ciego

```html
<!doctype html>
<html lang="es">
  <head>
    <title>El portafolio de Jose Vicente</title>
    <meta charset="utf-8">
    <style>
      body,html{background:grey;font-family:sans-serif;}
      header,main,footer{background:white;padding:20px;text-align:center;margin:auto;width:600px;}
      main{display:grid;grid-template-columns:auto auto auto;gap:20px;}
      article img{width:100%;}
    </style>
  </head>
  <body>
    <header>
      <h1>Jose Vicente Carratala</h1>
      <h2>info@jocarsa.com</h2>
    </header>
    <main>
      
      
    </main>
    <footer>
      (c) 2025 Jose Vicente Carratala
    </footer>
    <template id="plantilla_entrada">
      <article>
        <h3></h3>
        <p></p>
        <img src="">
      </article>
    </template>
    <script>
      let origen = document.querySelector("#plantilla_entrada")
      let destino = document.querySelector("main")
      fetch("portafolio.json")
      .then(function(respuesta){return respuesta.json()})
      .then(function(datos){
        datos.forEach(function(dato){
          let clon = origen.content.cloneNode("true")
          destino.appendChild(clon)
        })
      })
    </script>
  </body>
</html>
```

### clon con datos

```html
<!doctype html>
<html lang="es">
  <head>
    <title>El portafolio de Jose Vicente</title>
    <meta charset="utf-8">
    <style>
      body,html{background:grey;font-family:sans-serif;}
      header,main,footer{background:white;padding:20px;text-align:center;margin:auto;width:600px;}
      main{display:grid;grid-template-columns:auto auto auto;gap:20px;}
      article img{width:100%;}
    </style>
  </head>
  <body>
    <header>
      <h1>Jose Vicente Carratala</h1>
      <h2>info@jocarsa.com</h2>
    </header>
    <main>
      
      
    </main>
    <footer>
      (c) 2025 Jose Vicente Carratala
    </footer>
    <template id="plantilla_entrada">
      <article>
        <h3></h3>
        <p></p>
        <img src="">
      </article>
    </template>
    <script>
      let origen = document.querySelector("#plantilla_entrada")
      let destino = document.querySelector("main")
      fetch("portafolio.json")
      .then(function(respuesta){return respuesta.json()})
      .then(function(datos){
        datos.forEach(function(dato){
          let clon = origen.content.cloneNode("true")
          clon.querySelector("h3").textContent = dato.titulo
          clon.querySelector("p").textContent = dato.descripcion
          clon.querySelector("img").setAttribute("src",dato.imagen)
          destino.appendChild(clon)
        })
      })
    </script>
  </body>
</html>
```

### portafolio

```json
[
  {
    "titulo":"Pieza de portafolio 1",
    "descripcion":"Descripción de la pieza 1",
    "imagen":"josevicente.jpg"
  },
  {
    "titulo":"Pieza de portafolio 2",
    "descripcion":"Descripción de la pieza 2",
    "imagen":"josevicente.jpg"
  },
  {
    "titulo":"Pieza de portafolio 3",
    "descripcion":"Descripción de la pieza 3",
    "imagen":"josevicente.jpg"
  },
  {
    "titulo":"Pieza de portafolio 4",
    "descripcion":"Descripción de la pieza 4",
    "imagen":"josevicente.jpg"
  },
  {
    "titulo":"Pieza de portafolio 5",
    "descripcion":"Descripción de la pieza 5",
    "imagen":"josevicente.jpg"
  },
  {
    "titulo":"Pieza de portafolio 6",
    "descripcion":"Descripción de la pieza 6",
    "imagen":"josevicente.jpg"
  },
  {
    "titulo":"Pieza de portafolio 7",
    "descripcion":"Descripción de la pieza 7",
    "imagen":"josevicente.jpg"
  }
]
```

<a id="ejercicio-de-final-de-unidad-2"></a>
## Ejercicio de final de unidad

### actividad

```markdown
# Actividad (30’): “Planificador de cuadras — versión exprés”

Crea un script llamado `planificador_cuadras.py` que calcule cuántas cuadras necesitas en una fecha dada, según el número de caballos y la capacidad de cada cuadra. Debe redondear **al alza** el número de cuadras, mostrar propiedades de la fecha y presentar un pequeño informe.

## Objetivos de aprendizaje

* Usar **métodos** y **propiedades** de objetos estándar (`datetime.date`, `date.year`, `date.weekday`, etc.). 
* Llamar a **métodos “estáticos”**/de módulo como `math.ceil`. 
* Manejar **entrada → cálculo → salida** con mensajes claros. 

## Requisitos funcionales

1. **Entrada de datos (por `input`)**

   * `caballos` (entero > 0).
   * `capacidad_por_cuadra` (entero > 0).
   * `fecha` en formato `YYYY-MM-DD`.
     (Estos tres inputs siguen el patrón de los ejercicios de entrada/cálculo/salida). 
2. **Cálculos**

   * `cuadras_necesarias = ceil(caballos / capacidad_por_cuadra)` usando `math.ceil`. 
   * Crear un objeto `date` con la fecha indicada y obtener:

     * `year`, `month`, `day`
     * `weekday()` (0–6) y `isoweekday()` (1–7)
       (Como en los ejemplos de propiedades de fecha). 
3. **Salida (informe)**

   * Línea resumen con caballos, capacidad y cuadras **redondeadas al alza**.
   * Bloque “Datos de la fecha” mostrando `YYYY-MM-DD`, `year`, `month`, `day`, `weekday`, `isoweekday`.
4. **Validaciones mínimas**

   * Si algún valor no es entero positivo, mostrar un mensaje y terminar.
   * Si la fecha no cumple el formato, mostrar mensaje y terminar.
5. **(Opcional, si te da tiempo)**

   * Mostrar si la fecha cae **entre semana** o **fin de semana** (usa `isoweekday()`).
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


<a id="definicion-de-esquemas-y-vocabularios-en-lenguajes-de-marcas"></a>
# Definición de esquemas y vocabularios en lenguajes de marcas

<a id="tecnologias-para-la-definicion-de-documentos-estructura-y-sintaxis"></a>
## Tecnologías para la definición de documentos. Estructura y sintaxis

En el vasto mundo de la informática, los lenguajes de marcas desempeñan un papel crucial como herramientas para definir y estructurar documentos electrónicos. Estos lenguajes, que van desde HTML hasta XML, no solo permiten crear contenido visualmente atractivo sino también facilitan su procesamiento y manipulación por parte de sistemas informáticos.

La definición de esquemas y vocabularios en lenguajes de marcas es un aspecto fundamental para asegurar la coherencia y el intercambio de información entre diferentes aplicaciones y sistemas. Un esquema, en este contexto, puede ser considerado como una descripción formal del formato y estructura que debe seguir un documento o conjunto de documentos. Este esquema actúa como una especie de contrato, asegurando que todos los elementos necesarios estén presentes y estén organizados de manera consistente.

Los vocabularios, por otro lado, son conjuntos de términos y atributos que se utilizan para enriquecer el contenido de un documento. Al definir un vocabulario, se establecen las reglas y semánticas que los elementos del vocabulario deben seguir, lo que facilita la comprensión y procesamiento del contenido por parte de sistemas informáticos.

La combinación de esquemas y vocabularios en lenguajes de marcas permite crear documentos que no solo sean legibles para humanos, sino también fáciles de procesar y manipular por software. Esto se logra mediante la definición de reglas sintácticas y semánticas que guían el uso de los elementos del vocabulario dentro del esquema.

Para implementar esquemas y vocabularios en lenguajes de marcas, existen varias tecnologías disponibles. XML Schema (XSD) es una tecnología popular para definir esquemas en documentos XML. XSD permite especificar la estructura y el contenido de un documento XML, asegurando que todos los elementos estén presentes y estén organizados de manera consistente.

Otro ejemplo importante es el uso de vocabularios definidos por el World Wide Web Consortium (W3C). Estos vocabularios, como RDF (Resource Description Framework) o OWL (Web Ontology Language), proporcionan una forma estándar de representar conocimientos y relaciones en la web. Al utilizar estos vocabularios, se facilita la interoperabilidad entre diferentes sistemas y aplicaciones.

La definición de esquemas y vocabularios en lenguajes de marcas no solo mejora la calidad del contenido digital, sino que también facilita su procesamiento y análisis por parte de sistemas informáticos. Esto es especialmente relevante en el contexto de aplicaciones web, donde los documentos electrónicos son una parte fundamental de la interacción con los usuarios.

En resumen, la definición de esquemas y vocabularios en lenguajes de marcas es un aspecto crucial para asegurar la coherencia y el intercambio de información entre diferentes aplicaciones y sistemas. Al utilizar tecnologías como XML Schema o vocabularios W3C, se facilita la creación de documentos que no solo sean legibles para humanos, sino también fáciles de procesar y manipular por software. Esta práctica es fundamental en el mundo digital actual, donde la interoperabilidad y la eficiencia son elementos clave para el desarrollo y explotación de aplicaciones informáticas.

### archivo

```html
<!doctype html>
<html>
  <head>
  </head>
  <body>
    <p>Aquí escribo mi contenido</p>
  </body>
</html>
```

### documento json

```json
{
  "nombre":"Jose Vicente",
  "apellidos":"Carratalá Sanchis"
}
```

### documento

```xml
<?xml version="1.0" encoding="UTF-8"?>
<persona>
  <nombre>Jose Vicente</nombre>
  <apellidos>Carratalá Sanchis</apellidos>
</persona>
```

### otro documento

```xml
<?xml version="1.0" encoding="UTF-8"?>
<persona>
  <nombrepropio>Jose Vicente</nombrepropio>
  <apellidos>Carratalá Sanchis</apellidos>
</persona>
```

<a id="creacion-de-descripciones-de-documentos"></a>
## Creación de descripciones de documentos

En el vasto mundo de la informática, los lenguajes de marcas desempeñan un papel crucial como herramientas para estructurar y presentar información. En esta subunidad didáctica, nos adentramos en el proceso de definición de esquemas y vocabularios en estos lenguajes, una habilidad fundamental para crear documentos bien formados y comprensibles.

El primer paso en este camino es la creación de descripciones de documentos. Este proceso implica definir cómo se estructurará el contenido dentro del documento, estableciendo reglas claras sobre qué información puede incluirse y cómo debe ser organizada. Es como crear un mapa detallado que guiará a los usuarios en cómo navegar y entender el contenido.

Para lograr esto, utilizamos tecnologías específicas diseñadas para la definición de documentos. Estas tecnologías ofrecen una sintaxis precisa que permite describir la estructura y el contenido del documento, asegurando que sea fácilmente procesado por sistemas informáticos. Algunos ejemplos incluyen XML (eXtensible Markup Language) y JSON (JavaScript Object Notation), que son lenguajes de marcado versátiles y ampliamente utilizados.

La creación de descripciones de documentos es un proceso iterativo. Inicialmente, se define una estructura básica del documento, luego se refina para mejorar la claridad y precisión. Es importante considerar el público objetivo y las necesidades específicas del contenido al diseñar la estructura del documento. Por ejemplo, si estamos creando un manual técnico, es probable que queramos incluir secciones detalladas sobre los procedimientos y configuraciones.

Además de definir la estructura, también es crucial establecer reglas para el uso de vocabularios dentro del documento. Los vocabularios son conjuntos de términos y conceptos que tienen un significado específico en el contexto del documento. Al definir un vocabulario, se asegura que todos los usuarios comprendan las mismas palabras y frases, lo que facilita la comprensión y el uso del contenido.

La creación de descripciones de documentos también implica considerar la accesibilidad. Es importante diseñar los documentos de manera que sean fáciles de leer y entender para personas con diferentes niveles de habilidad y conocimiento. Esto puede implicar utilizar un lenguaje simple, proporcionar ejemplos claros y utilizar estructuras de contenido coherentes.

En el mundo digital actual, la creación de descripciones de documentos es una habilidad cada vez más valorada. Los sistemas informáticos modernos requieren que los documentos estén bien estructurados y fácilmente procesables. Al dominar este proceso, podemos crear información que sea no solo precisa y comprensible, sino también accesible y útil para un amplio rango de usuarios.

En conclusión, la creación de descripciones de documentos es un paso fundamental en el uso de lenguajes de marcas. Este proceso implica definir una estructura clara del contenido, establecer reglas precisas para el uso de vocabularios y considerar la accesibilidad del documento. Al dominar este proceso, podemos crear información que sea fácilmente procesada y comprensible por sistemas informáticos, lo que es crucial en un mundo cada vez más digitalizado.

### documento

```xml
<?xml version="1.0" encoding="UTF-8"?>
<persona>
  <nombre>Jose Vicente</nombre>
  <apellidos>Carratalá Sanchis</apellidos>
  <profesion>Profesor de FP en desarrollo de software</profesion>

  <roles>
    <rol>Autor de libros técnicos (Python, SQL, etc.)</rol>
    <rol>Creador de contenidos educativos en YouTube</rol>
    <rol>Desarrollador de software y soluciones empresariales</rol>
  </roles>

  <proyectosDestacados>
    <proyecto>Jocarsa (ecosistema de soluciones SaaS)</proyecto>
    <proyecto>comoprogramar.es</proyecto>
    <proyecto>Simulaciones 3D y gráficos en C++/CUDA</proyecto>
    <proyecto>Modelos educativos fine-tuned con LLMs</proyecto>
    <proyecto>Aplicaciones web en Flask, PHP, React y Next.js</proyecto>
  </proyectosDestacados>

  <interesesTecnicos>
    <interes>Inteligencia Artificial y modelos LLM</interes>
    <interes>Desarrollo web full stack</interes>
    <interes>Gráficos 3D y simulaciones</interes>
    <interes>Educación y automatización docente</interes>
  </interesesTecnicos>

  <ubicacion>Valencia (España)</ubicacion>
</persona>
```

### plantilla

```
<?xml version="1.0" encoding="UTF-8"?>
<xs:schema xmlns:xs="http://www.w3.org/2001/XMLSchema"
           elementFormDefault="qualified"
           attributeFormDefault="unqualified">

  <!-- Elemento raíz -->
  <xs:element name="persona">
    <xs:complexType>
      <xs:sequence>
        <xs:element name="nombre" type="xs:string"/>
        <xs:element name="apellidos" type="xs:string"/>
        <xs:element name="profesion" type="xs:string"/>

        <!-- roles -->
        <xs:element name="roles">
          <xs:complexType>
            <xs:sequence>
              <xs:element name="rol" type="xs:string" minOccurs="1" maxOccurs="unbounded"/>
            </xs:sequence>
          </xs:complexType>
        </xs:element>

        <!-- proyectosDestacados -->
        <xs:element name="proyectosDestacados">
          <xs:complexType>
            <xs:sequence>
              <xs:element name="proyecto" type="xs:string" minOccurs="1" maxOccurs="unbounded"/>
            </xs:sequence>
          </xs:complexType>
        </xs:element>

        <!-- interesesTecnicos -->
        <xs:element name="interesesTecnicos">
          <xs:complexType>
            <xs:sequence>
              <xs:element name="interes" type="xs:string" minOccurs="1" maxOccurs="unbounded"/>
            </xs:sequence>
          </xs:complexType>
        </xs:element>

        <!-- ubicacion -->
        <xs:element name="ubicacion" type="xs:string"/>
      </xs:sequence>
    </xs:complexType>
  </xs:element>

</xs:schema>
```

### validador

```python
import xmlschema

esquema = xmlschema.XMLSchema("002-plantilla.xsd")

try:
    esquema.validate("001-documento.xml")
    print("✔️ XML válido")
except xmlschema.exceptions.XMLSchemaValidationError as e:
    print("❌ XML NO válido")
    print(e)
```

### documento no valido

```xml
<?xml version="1.0" encoding="UTF-8"?>
<persona>
  <minombre>Jose Vicente</minombre>
  <apellidos>Carratalá Sanchis</apellidos>
  <profesion>Profesor de FP en desarrollo de software</profesion>

  <roles>
    <rol>Autor de libros técnicos (Python, SQL, etc.)</rol>
    <rol>Creador de contenidos educativos en YouTube</rol>
    <rol>Desarrollador de software y soluciones empresariales</rol>
  </roles>

  <proyectosDestacados>
    <proyecto>Jocarsa (ecosistema de soluciones SaaS)</proyecto>
    <proyecto>comoprogramar.es</proyecto>
    <proyecto>Simulaciones 3D y gráficos en C++/CUDA</proyecto>
    <proyecto>Modelos educativos fine-tuned con LLMs</proyecto>
    <proyecto>Aplicaciones web en Flask, PHP, React y Next.js</proyecto>
  </proyectosDestacados>

  <interesesTecnicos>
    <interes>Inteligencia Artificial y modelos LLM</interes>
    <interes>Desarrollo web full stack</interes>
    <interes>Gráficos 3D y simulaciones</interes>
    <interes>Educación y automatización docente</interes>
  </interesesTecnicos>

  <ubicacion>Valencia (España)</ubicacion>
</persona>
```

### validar de nuevo

```python
import xmlschema

esquema = xmlschema.XMLSchema("002-plantilla.xsd")

try:
    esquema.validate("004-documento no valido.xml")
    print("✔️ XML válido")
except xmlschema.exceptions.XMLSchemaValueError as e:
    print("❌ XML NO válido")
    print(e)
```

<a id="asociacion-de-descripciones-con-documentos-validacion"></a>
## Asociación de descripciones con documentos. Validación

En el mundo digital actual, la definición de esquemas y vocabularios en lenguajes de marcas desempeña un papel crucial para la organización, almacenamiento y manipulación eficiente de información. Este proceso permite a los desarrolladores crear estructuras claras y coherentes que faciliten la comunicación entre diferentes sistemas y aplicaciones.

La asociación de descripciones con documentos es una técnica fundamental en este contexto. Las descripciones, también conocidas como esquemas o vocabularios, proporcionan un conjunto de reglas y definiciones que guían cómo se estructuran y representan los datos dentro de un documento. Al asociar estas descripciones con los documentos, se establece un marco común que asegura la consistencia y coherencia en la forma en que se manejan los datos.

Es importante destacar que el proceso de asociación no es tan sencillo como parece. Requiere una comprensión profunda de las necesidades del sistema y los requisitos específicos de los usuarios finales. Los desarrolladores deben considerar factores como la complejidad de los datos, la eficiencia en el almacenamiento y la facilidad de acceso para los usuarios.

La validación es otro aspecto crucial que complementa la asociación de descripciones con documentos. La validación implica comprobar si un documento cumple con las reglas definidas por su esquema o vocabulario. Este proceso puede ser automatizado mediante herramientas especializadas, lo que asegura que todos los documentos estén bien formados y sigan el formato correcto.

La importancia de la validación radica en su capacidad para prevenir errores y garantizar la calidad del dato. Un documento no válido puede llevar a problemas significativos en sistemas interconectados, como inconsistencias de datos o fallos en la comunicación entre aplicaciones.

Además, la asociación y validación de descripciones con documentos facilitan el intercambio de información entre diferentes organizaciones y plataformas. Al utilizar un esquema común, los sistemas pueden compartir datos sin necesidad de convertirlos a un formato diferente, lo que mejora la eficiencia y reduce errores.

En resumen, la definición de esquemas y vocabularios en lenguajes de marcas, junto con su asociación y validación, constituyen una base sólida para el manejo eficiente de información digital. Estos procesos no solo optimizan la estructura y organización de los datos, sino que también aseguran su integridad y facilitan su intercambio entre diferentes sistemas y aplicaciones.

### plantilla

```
<?xml version="1.0" encoding="UTF-8"?>
<xs:schema xmlns:xs="http://www.w3.org/2001/XMLSchema"
           elementFormDefault="qualified"
           attributeFormDefault="unqualified">

  <!-- Elemento raíz -->
  <xs:element name="persona">
    <xs:complexType>
      <xs:sequence>
        <xs:element name="nombre" type="xs:string"/>
        <xs:element name="apellidos" type="xs:string"/>
        <xs:element name="profesion" type="xs:string"/>

        <!-- roles -->
        <xs:element name="roles">
          <xs:complexType>
            <xs:sequence>
              <xs:element name="rol" type="xs:string" minOccurs="1" maxOccurs="unbounded"/>
            </xs:sequence>
          </xs:complexType>
        </xs:element>

        <!-- proyectosDestacados -->
        <xs:element name="proyectosDestacados">
          <xs:complexType>
            <xs:sequence>
              <xs:element name="proyecto" type="xs:string" minOccurs="1" maxOccurs="unbounded"/>
            </xs:sequence>
          </xs:complexType>
        </xs:element>

        <!-- interesesTecnicos -->
        <xs:element name="interesesTecnicos">
          <xs:complexType>
            <xs:sequence>
              <xs:element name="interes" type="xs:string" minOccurs="1" maxOccurs="unbounded"/>
            </xs:sequence>
          </xs:complexType>
        </xs:element>

        <!-- ubicacion -->
        <xs:element name="ubicacion" type="xs:string"/>
      </xs:sequence>
    </xs:complexType>
  </xs:element>

</xs:schema>
```

### documento no valido

```xml
<?xml version="1.0" encoding="UTF-8"?>
<persona>
  <minombre>Jose Vicente</minombre>
  <apellidos>Carratalá Sanchis</apellidos>
  <profesion>Profesor de FP en desarrollo de software</profesion>

  <roles>
    <rol>Autor de libros técnicos (Python, SQL, etc.)</rol>
    <rol>Creador de contenidos educativos en YouTube</rol>
    <rol>Desarrollador de software y soluciones empresariales</rol>
  </roles>

  <proyectosDestacados>
    <proyecto>Jocarsa (ecosistema de soluciones SaaS)</proyecto>
    <proyecto>comoprogramar.es</proyecto>
    <proyecto>Simulaciones 3D y gráficos en C++/CUDA</proyecto>
    <proyecto>Modelos educativos fine-tuned con LLMs</proyecto>
    <proyecto>Aplicaciones web en Flask, PHP, React y Next.js</proyecto>
  </proyectosDestacados>

  <interesesTecnicos>
    <interes>Inteligencia Artificial y modelos LLM</interes>
    <interes>Desarrollo web full stack</interes>
    <interes>Gráficos 3D y simulaciones</interes>
    <interes>Educación y automatización docente</interes>
  </interesesTecnicos>

  <ubicacion>Valencia (España)</ubicacion>
</persona>
```

### validar de nuevo

```python
import xmlschema

esquema = xmlschema.XMLSchema("002-plantilla.xsd")

try:
    esquema.validate("004-documento no valido.xml")
    print("✔️ XML válido")
except xmlschema.exceptions.XMLSchemaValueError as e:
    print("❌ XML NO válido")
    print(e)
```

<a id="herramientas-de-creacion-y-validacion"></a>
## Herramientas de creación y validación

En el mundo digital actual, la creación y validación de esquemas y vocabularios en lenguajes de marcas son fundamentales para garantizar la estructura y coherencia de los documentos informáticos. Estos procesos permiten definir cómo se organizarán los datos dentro de un documento XML o HTML, asegurando que sean comprensibles y accesibles tanto por humanos como por máquinas.

La herramientas de creación y validación desempeñan un papel crucial en este proceso. Estas herramientas proporcionan interfaces gráficas intuitivas que facilitan la definición de esquemas XML o DTD (Document Type Definition), permitiendo a los usuarios especificar las reglas de estructura, tipos de datos y relaciones entre elementos del documento.

Además, estas herramientas ofrecen funciones avanzadas para validar documentos contra el esquema definido. Esto implica comprobar que todos los elementos estén correctamente posicionados, que los tipos de datos sean apropiados y que las relaciones entre elementos cumplan con las reglas establecidas. La validación automática no solo ahorra tiempo y reduce errores humanos, sino que también asegura la consistencia y precisión de los datos.

La creación y validación de esquemas y vocabularios en lenguajes de marcas son herramientas poderosas para el desarrollo de aplicaciones web y sistemas informáticos. Al definir claramente cómo se estructuran los datos, estas herramientas facilitan la implementación de interfaces de usuario y la creación de servicios web que pueden intercambiar información de manera eficiente y segura.

Además, las herramientas de creación y validación permiten la documentación automática del esquema. Esto significa que se generan documentos que describen en detalle cómo se estructuran los datos dentro del documento, lo que facilita el mantenimiento y actualización del sistema a largo plazo.

En resumen, la creación y validación de esquemas y vocabularios en lenguajes de marcas son procesos cruciales para garantizar la calidad y coherencia de los documentos informáticos. Las herramientas disponibles hoy en día facilitan este proceso, haciendo que sea más sencillo definir estructuras de datos complejas y validar documentos contra ellas con alta precisión.

### generador esquema

```python
import xml.etree.ElementTree as ET

xsd_file = "schema/esquema.xsd"   

tree = ET.parse(xsd_file)
root = tree.getroot()

XS = "{http://www.w3.org/2001/XMLSchema}"

fields = []

for element in root.findall(f"{XS}element"):
    if element.get("name") == "persona":
        complex_type = element.find(f"{XS}complexType")
        sequence = complex_type.find(f"{XS}sequence")

        for child in sequence.findall(f"{XS}element"):
            fields.append(child.get("name"))

print("Campos de <persona>:", fields)
```

### preguntas dinamicas

```python
import xml.etree.ElementTree as ET

xsd_file = "schema/esquema.xsd"   

tree = ET.parse(xsd_file)
root = tree.getroot()

XS = "{http://www.w3.org/2001/XMLSchema}"

fields = []

for element in root.findall(f"{XS}element"):
    if element.get("name") == "persona":
        complex_type = element.find(f"{XS}complexType")
        sequence = complex_type.find(f"{XS}sequence")

        for child in sequence.findall(f"{XS}element"):
            fields.append(child.get("name"))
entradas = []
for campo in fields:
  entradas.append(input("Introduce el valor para "+campo+": "))
  
```

### guardar xml

```python
import xml.etree.ElementTree as ET

# Fichero XSD
xsd_file = "schema/esquema.xsd"
# Fichero de salida XML
output_file = "persona.xml"

# Namespace de XML Schema
XS = "{http://www.w3.org/2001/XMLSchema}"

# Cargar XSD
tree = ET.parse(xsd_file)
root = tree.getroot()

fields = []

# Buscar el elemento <xs:element name="persona">
for element in root.findall(f"{XS}element"):
    if element.get("name") == "persona":
        complex_type = element.find(f"{XS}complexType")
        if complex_type is None:
            continue

        sequence = complex_type.find(f"{XS}sequence")
        if sequence is None:
            continue

        # Obtener los nombres de los hijos de persona
        for child in sequence.findall(f"{XS}element"):
            fields.append(child.get("name"))

# Pedir los valores por consola
entradas = []
for campo in fields:
    valor = input(f"Introduce el valor para {campo}: ")
    entradas.append(valor)

# Construir el XML de instancia
persona = ET.Element("persona")

for campo, valor in zip(fields, entradas):
    hijo = ET.SubElement(persona, campo)
    hijo.text = valor

# Crear el árbol XML y guardarlo en fichero
instance_tree = ET.ElementTree(persona)
instance_tree.write(output_file, encoding="utf-8", xml_declaration=True)

print(f"XML guardado en {output_file}")
```

### pretty print

```python
import xml.etree.ElementTree as ET
from xml.dom import minidom

# Fichero XSD
xsd_file = "schema/esquema.xsd"
# Fichero de salida XML
output_file = "persona.xml"

# Namespace de XML Schema
XS = "{http://www.w3.org/2001/XMLSchema}"

# Cargar XSD
tree = ET.parse(xsd_file)
root = tree.getroot()

fields = []

# Buscar el elemento <xs:element name="persona">
for element in root.findall(f"{XS}element"):
    if element.get("name") == "persona":
        complex_type = element.find(f"{XS}complexType")
        if complex_type is None:
            continue

        sequence = complex_type.find(f"{XS}sequence")
        if sequence is None:
            continue

        # Obtener los nombres de los hijos de persona
        for child in sequence.findall(f"{XS}element"):
            fields.append(child.get("name"))

# Pedir los valores por consola
entradas = []
for campo in fields:
    valor = input(f"Introduce el valor para {campo}: ")
    entradas.append(valor)

# Construir el XML de instancia
persona = ET.Element("persona")

for campo, valor in zip(fields, entradas):
    hijo = ET.SubElement(persona, campo)
    hijo.text = valor

# Pretty print con minidom
rough_string = ET.tostring(persona, 'utf-8')
reparsed = minidom.parseString(rough_string)
pretty_xml = reparsed.toprettyxml(indent="  ", encoding="utf-8")

# Guardar archivo
with open(output_file, "wb") as f:
    f.write(pretty_xml)

print(f"XML formateado guardado en {output_file}")
```

### persona

```xml
<?xml version="1.0" encoding="utf-8"?>
<persona>
  <nombre>Jose Vicente</nombre>
  <apellidos>Carratala</apellidos>
  <email>info@jocarsa.com</email>
  <fechaNacimiento>4323</fechaNacimiento>
  <direccion>Mi calle</direccion>
  <codigopostal>46920</codigopostal>
</persona>
```


<a id="conversion-y-adaptacion-de-documentos-para-el-intercambio-de-informacion"></a>
# Conversión y adaptación de documentos para el intercambio de información

<a id="tecnologias-de-transformacion-de-documentos"></a>
## Tecnologías de transformación de documentos

En el mundo digital actual, la capacidad de convertir y adaptar documentos para su intercambio entre diferentes sistemas es una habilidad crucial. Esta carpeta del curso nos introduce a las tecnologías que facilitan este proceso, abordando desde los fundamentos hasta las aplicaciones prácticas.

La conversión y adaptación de documentos son procesos que permiten la transmisión de información entre plataformas distintas, asegurando su comprensión y uso en el contexto del sistema receptor. Esta tarea es vital en entornos empresariales y académicos, donde la colaboración y la integración de sistemas son comunes.

Las tecnologías para la transformación de documentos incluyen herramientas que pueden convertir formatos entre sí, como PDF a Word o viceversa. Estas herramientas suelen basarse en bibliotecas de software que proporcionan funciones para leer, escribir y manipular diferentes tipos de archivos. Por ejemplo, la biblioteca `Apache POI` es una poderosa herramienta para trabajar con documentos Microsoft Office en Java.

Además de las conversiones entre formatos, también existen tecnologías que permiten adaptar el contenido de los documentos a diferentes plataformas o dispositivos. Esto puede implicar la creación de versiones simplificadas de un documento para su visualización en pantallas pequeñas, o la generación de documentos personalizados basados en datos dinámicos.

La importancia de estas tecnologías radica en su capacidad para facilitar el intercambio de información entre sistemas, mejorar la colaboración y reducir errores humanos. Al convertir y adaptar documentos, se asegura que la información esté disponible en el formato adecuado y accesible para todas las partes interesadas.

En el contexto del desarrollo de software, las herramientas de transformación de documentos son esenciales para crear interfaces de usuario nativas, donde los usuarios pueden interactuar con aplicaciones sin necesidad de conocer el formato interno de los datos. Por ejemplo, una aplicación que muestra un informe en formato PDF puede adaptarlo a la interfaz gráfica de usuario del sistema operativo, permitiendo una visualización más amigable y accesible.

La conversión y adaptación de documentos también son fundamentales para el almacenamiento y recuperación de información. Al convertir los datos a formatos estándar o nativos de sistemas, se facilita su acceso y manipulación, lo que mejora la eficiencia operativa.

En resumen, las tecnologías de transformación de documentos son herramientas poderosas que permiten el intercambio y adaptación de información entre diferentes sistemas. Su uso es crucial en entornos empresariales y académicos para mejorar la colaboración, reducir errores y facilitar la visualización y manipulación de datos. A través del estudio de estas tecnologías, los estudiantes adquieren habilidades valiosas que les permitirán trabajar eficazmente con información en diversos formatos y plataformas.

### me conecto a la base de datos

```python
import mysql.connector

conexion = mysql.connector.connect(
  host="localhost",
  user="blog2526",
  password="blog2526",
  database="blog2526"
)

cursor = conexion.cursor() 
cursor.execute("SELECT * FROM entradas;")

lineas = cursor.fetchall()
print(lineas)
```

### quiero un diccionario

```python
import mysql.connector

conexion = mysql.connector.connect(
  host="localhost",
  user="blog2526",
  password="blog2526",
  database="blog2526"
)

cursor = conexion.cursor(dictionary = True) 
cursor.execute("SELECT * FROM entradas;")

lineas = cursor.fetchall()
print(lineas)
```

### convierto diccionario a json

```python
import mysql.connector
import json

conexion = mysql.connector.connect(
  host="localhost",
  user="blog2526",
  password="blog2526",
  database="blog2526"
)

cursor = conexion.cursor(dictionary = True) 
cursor.execute("SELECT * FROM entradas;")

lineas = cursor.fetchall()
lineas_json = json.dumps(lineas)

print(lineas_json)
```

### le pongo un poco de flask

```python
import mysql.connector
import json
from flask import Flask

aplicacion = Flask(__name__)

conexion = mysql.connector.connect(
  host="localhost",
  user="blog2526",
  password="blog2526",
  database="blog2526"
)

@aplicacion.route("/")
def raiz():
  cursor = conexion.cursor(dictionary = True) 
  cursor.execute("SELECT * FROM entradas;")

  lineas = cursor.fetchall()
  lineas_json = json.dumps(lineas)

  return lineas_json
  
if __name__ == "__main__":
  aplicacion.run()
```

### trabajo con templates

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

@aplicacion.route("/")
def raiz():
  return render_template("index.html")
  
  
@aplicacion.route("/api")
def api():
  cursor = conexion.cursor(dictionary = True) 
  cursor.execute("SELECT * FROM entradas;")

  lineas = cursor.fetchall()
  lineas_json = json.dumps(lineas)

  return lineas_json
  
if __name__ == "__main__":
  aplicacion.run()
```

<a id="descripcion-de-la-estructura-y-de-la-sintaxis"></a>
## Descripción de la estructura y de la sintaxis

En el vasto mundo de la informática, la conversión y adaptación de documentos para su intercambio son procesos cruciales que permiten la comunicación eficiente entre diferentes sistemas y plataformas. Esta subunidad didáctica nos guía a través del proceso detallado de cómo transformar documentos en formatos compatibles y legibles por diversos sistemas, asegurando así una transmisión fluida de información.

El primer paso en este proceso es entender la estructura y sintaxis de los diferentes tipos de documentos que se manejan. Cada formato tiene sus propias reglas y convenciones que deben ser respetadas para garantizar su correcto procesamiento. Por ejemplo, un documento HTML sigue una estructura específica con etiquetas y atributos que definen el contenido y la presentación.

La sintaxis de estos documentos es fundamental porque determina cómo se interpreta la información. Un error en la sintaxis puede llevar a problemas significativos en la visualización o el procesamiento del contenido, por lo que es crucial tener una comprensión profunda de las reglas aplicables.

Además de conocer la estructura y sintaxis, también es necesario entender los diferentes formatos de documentos que existen. Desde los simples archivos de texto hasta los complejos sistemas de bases de datos, cada uno tiene sus propias características y métodos de manejo. Por ejemplo, un archivo JSON es ideal para representar datos estructurados en una forma fácilmente legible y accesible.

La adaptación de documentos también implica la conversión entre diferentes formatos. Esto puede ser necesario cuando se necesita compartir información entre sistemas que utilizan distintas tecnologías o cuando se desea migrar datos a un nuevo sistema. Herramientas especializadas como los convertidores de archivos pueden facilitar este proceso, pero es importante entender cómo funcionan para poder utilizarlas eficazmente.

Un aspecto crucial en la conversión y adaptación de documentos es la gestión de las relaciones entre diferentes partes del contenido. Por ejemplo, en un documento XML, las relaciones entre elementos pueden ser expresadas mediante atributos o etiquetas específicas, lo que permite una representación jerárquica y estructurada.

La documentación también juega un papel importante en el proceso de conversión y adaptación. Es fundamental tener acceso a la documentación oficial de los formatos utilizados para entender completamente cómo funcionan y cómo se pueden manipular. Además, la documentación puede proporcionar información sobre las mejores prácticas y recomendaciones específicas para cada formato.

La automatización es otro aspecto clave en el proceso de conversión y adaptación de documentos. Herramientas y bibliotecas especializadas pueden ser utilizadas para crear scripts que automaten ciertas tareas, como la conversión entre formatos o la manipulación de datos. Esta automatización no solo ahorra tiempo y esfuerzo, sino que también reduce el riesgo de errores humanos.

Finalmente, la seguridad es un aspecto importante en la conversión y adaptación de documentos, especialmente cuando se trata de compartir información sensible entre sistemas. Es crucial implementar medidas de seguridad adecuadas para proteger los datos durante el proceso de conversión y asegurar su integridad y confidencialidad.

En resumen, la conversión y adaptación de documentos es un proceso complejo pero fundamental en la informática moderna. A través de una comprensión profunda de la estructura y sintaxis de diferentes formatos, así como el uso de herramientas especializadas y técnicas de automatización, podemos asegurar que la información se comunique eficientemente entre sistemas y plataformas, facilitando así la colaboración y la toma de decisiones basada en datos.

### Definición de la estructura

```markdown
JSON: 
  -Tabla 1: {}
  -Tabla 2: {}
  -Tabla 3: {}
  
[
  "tabla":{},
  "tabla":{},
  "tabla":{}
]
```

### quiero ver las tablas

```python
import mysql.connector

conexion = mysql.connector.connect(
  host="localhost",
  user="blog2526",
  password="blog2526",
  database="blog2526"
)

cursor = conexion.cursor() 
cursor.execute("SHOW TABLES;")

lineas = cursor.fetchall()
print(lineas)
```

### formateo el documento

```python
import mysql.connector

conexion = mysql.connector.connect(
  host="localhost",
  user="blog2526",
  password="blog2526",
  database="blog2526"
)

cursor = conexion.cursor() 
cursor.execute("SHOW TABLES;")

lineas = cursor.fetchall()
documento = []
for linea in lineas:
  documento.append(linea[0])
print(documento)
```

### ahora quiero cada una de las tablas

```python
import mysql.connector

conexion = mysql.connector.connect(
  host="localhost",
  user="blog2526",
  password="blog2526",
  database="blog2526"
)

cursor = conexion.cursor() 
cursor.execute("SHOW TABLES;")

tablas = cursor.fetchall()
documento = {}
for tabla in tablas:
  
  # Select * FROM cada una de las tablas
  cursor.execute("SELECT * FROM "+tabla[0]+";")
  registros = cursor.fetchall()
  documento[tabla[0]] = registros

print(documento)
```

### tengo que convertir a json

```python
import mysql.connector
import json

conexion = mysql.connector.connect(
  host="localhost",
  user="blog2526",
  password="blog2526",
  database="blog2526"
)

cursor = conexion.cursor() 
cursor.execute("SHOW TABLES;")

tablas = cursor.fetchall()
documento = {}
for tabla in tablas:
  
  # Select * FROM cada una de las tablas
  cursor.execute("SELECT * FROM "+tabla[0]+";")
  registros = cursor.fetchall()
  documento[tabla[0]] = registros

documento_json = json.dumps(documento)
print(documento_json)
```

### pretty

```python
import mysql.connector
import json

conexion = mysql.connector.connect(
  host="localhost",
  user="blog2526",
  password="blog2526",
  database="blog2526"
)

cursor = conexion.cursor(dictionary=True) 
cursor.execute("SHOW TABLES;")

tablas = cursor.fetchall()
documento = {}
for tabla in tablas:
  
  # Select * FROM cada una de las tablas
  cursor.execute("SELECT * FROM "+tabla['Tables_in_blog2526']+";")
  registros = cursor.fetchall()
  documento[tabla['Tables_in_blog2526']] = registros

documento_json = json.dumps(documento, indent=4, ensure_ascii=False)
print(documento_json)
```

### ahora lo saco con flask

```python
import mysql.connector
import json
from flask import Flask

aplicacion = Flask(__name__)

conexion = mysql.connector.connect(
  host="localhost",
  user="blog2526",
  password="blog2526",
  database="blog2526"
)

cursor = conexion.cursor(dictionary=True) 

@aplicacion.route("/")
def raiz():
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
  
if __name__ == "__main__":
  aplicacion.run()
```

### creo dos endpoints

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

<a id="creacion-y-utilizacion-de-plantillas-herramientas-y-depuracion"></a>
## Creación y utilización de plantillas. Herramientas y depuración

En el mundo digital actual, la conversión y adaptación de documentos para el intercambio de información es una tarea fundamental que requiere habilidades técnicas y creativas. Esta subunidad didáctica nos guía a través del proceso de creación y utilización de plantillas, herramientas y técnicas avanzadas para manejar eficazmente la información en diferentes formatos.

La creación de plantillas es un paso crucial en este proceso. Una buena plantilla debe ser flexible, fácil de usar y adaptarse a diversos tipos de documentos. Las herramientas modernas ofrecen una amplia gama de opciones para diseñar plantillas que pueden ser personalizadas según las necesidades específicas del proyecto.

Una vez creada la plantilla, su utilización se convierte en un proceso repetitivo pero esencial. Herramientas como Microsoft Word o Google Docs facilitan esta tarea al permitir la inserción de variables y marcadores que se reemplazan automáticamente cuando se genera el documento final. Esta automatización no solo ahorra tiempo sino que también reduce errores humanos.

La depuración es otro aspecto crucial en este proceso. A pesar de las herramientas avanzadas, siempre hay posibilidades de errores o inconsistencias en los documentos generados. Es por eso que la depuración es una habilidad indispensable para asegurar la calidad del trabajo final. Esto implica revisar y corregir cualquier error que pueda surgir durante el proceso de conversión.

La adaptación de documentos también requiere un conocimiento profundo de diferentes formatos y estandares. Por ejemplo, si se trabaja con documentos XML o JSON, es necesario entender su estructura y sintaxis para poder manipularlos correctamente. Herramientas como XSLT (Extensible Stylesheet Language Transformations) son útiles en este sentido, permitiendo la transformación de datos entre diferentes formatos.

Además, el uso de plantillas y herramientas avanzadas permite la creación de documentos personalizados que se ajustan a las necesidades específicas del usuario. Esto es especialmente relevante en contextos empresariales donde los documentos deben cumplir con requisitos específicos y variar según el contexto.

La conversión y adaptación de documentos también implica un proceso de aprendizaje continuo. Las herramientas y tecnologías cambian rápidamente, por lo que es importante estar al tanto de las últimas novedades y tendencias en este campo. Esto puede implicar la adquisición de nuevas habilidades técnicas o el uso de herramientas más avanzadas.

En conclusión, la conversión y adaptación de documentos para el intercambio de información es un proceso complejo pero fundamental en el mundo digital actual. La creación y utilización de plantillas, junto con las herramientas y técnicas adecuadas, son herramientas clave para manejar eficazmente esta tarea. A través del aprendizaje continuo y la adaptabilidad, podemos superar los desafíos y aprovechar al máximo las oportunidades que ofrece este campo.

### panel

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Panel de administración</title>
    <meta charset="utf-8">
  </head>
  <body>
    <header> 
      Panel de administración jocarsa
    </header>
    <main>
      <nav>Menu</nav>
      <section>Contenido</section>
    </main>
  </body>
</html>
```

### un poco de css

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Panel de administración</title>
    <meta charset="utf-8">
    <style>
      html,body{width:100%;height:100%;padding:0px;margin:0px;}
      body{display:flex;flex-direction:column;}
      header{background:DarkCyan;padding:20px;color:white;}
      main{display:flex;height:100%;}
      nav{flex:1;padding:20px;background:DarkCyan;color:white;}
      section{flex:6;padding:20px;}
    </style>
  </head>
  <body>
    <header> 
      Panel de administración jocarsa
    </header>
    <main>
      <nav>Menu</nav>
      <section>Contenido</section>
    </main>
  </body>
</html>
```

<a id="conversion-entre-diferentes-formatos-de-documentos"></a>
## Conversión entre diferentes formatos de documentos

En el mundo digital actual, la conversión y adaptación de documentos para el intercambio de información es una tarea fundamental que requiere habilidades técnicas y un conocimiento profundo de los diferentes formatos utilizados. Este proceso permite que los datos sean compartidos eficientemente entre sistemas, plataformas y aplicaciones distintas, asegurando la interoperabilidad y la accesibilidad.

La conversión entre diferentes formatos de documentos es un aspecto crucial en el manejo de información digital. Cada formato tiene sus propias ventajas y desventajas, dependiendo del propósito para el que se utilice. Por ejemplo, los formatos basados en texto como HTML o XML son versátiles y pueden ser utilizados tanto para la presentación web como para la intercambio de datos estructurados. En contraste, los formatos binarios como PDF o DOCX ofrecen una mayor calidad visual pero requieren software específico para su edición.

Para realizar esta conversión, se utilizan herramientas especializadas que pueden transformar documentos de un formato a otro con alta precisión y eficiencia. Estas herramientas pueden ser software de escritorio, bibliotecas de programación o servicios en la nube. Cada una tiene sus propias ventajas y desventajas, dependiendo del nivel de control que se requiera sobre el proceso de conversión.

La adaptación de documentos también implica no solo su conversión entre formatos, sino también su ajuste a diferentes plataformas o dispositivos. Por ejemplo, un documento HTML puede ser adaptado para su visualización en dispositivos móviles, lo que puede requerir la eliminación de elementos gráficos complejos o la simplificación del diseño. Esta adaptación es especialmente importante en el contexto de la experiencia del usuario (UX) y la accesibilidad digital.

La conversión y adaptación de documentos también implican la gestión de los datos asociados con estos documentos. Esto puede incluir la extracción de información relevante, su organización y su almacenamiento en formatos adecuados para su posterior análisis o uso. La eficiencia en este proceso es crucial para garantizar que los datos sean utilizados de manera óptima y que se minimice el tiempo y recursos necesarios.

En resumen, la conversión y adaptación de documentos para el intercambio de información es un proceso complejo pero fundamental en el manejo digital. Requiere una comprensión profunda de los diferentes formatos utilizados y la utilización de herramientas especializadas para realizar la conversión con alta precisión y eficiencia. Además, implica la gestión de los datos asociados con estos documentos, asegurando que sean utilizados de manera óptima y que se minimice el tiempo y recursos necesarios.

### Formatos

```markdown
Puedo convertir un archivo de Word en un archivo de Excel?

Formatos de transporte de datos
XML
JSON
```

### json a xml

```python
import json
import xml.etree.ElementTree as ET

def dict_to_xml(tag, d):
    elem = ET.Element(tag)
    for key, val in d.items():
        child = ET.SubElement(elem, key)
        child.text = str(val)
    return elem

# Load JSON
with open("persona.json") as f:
    data = json.load(f)

# Convert: assume root key has 1 element
root_key = next(iter(data))
root_element = dict_to_xml(root_key, data[root_key])

# Save XML
tree = ET.ElementTree(root_element)
tree.write("persona.xml", encoding="utf-8", xml_declaration=True)
```

### conversor avanzado de json a xml

```python
import json
import xml.etree.ElementTree as ET

# -------------------------
# Recursive converter
# -------------------------
def build_xml(key, value):
    element = ET.Element(key)

    if isinstance(value, dict):
        for k, v in value.items():
            element.append(build_xml(k, v))

    elif isinstance(value, list):
        # each item gets the singular tag (simple heuristic)
        item_tag = key[:-1] if key.endswith('s') else "item"
        for item in value:
            element.append(build_xml(item_tag, item))

    else:
        # simple value
        element.text = str(value)

    return element


# -------------------------
# Pretty printing helper
# -------------------------
def indent(elem, level=0):
    spacing = "  "
    i = "\n" + level * spacing
    if len(elem):
        if not elem.text or not elem.text.strip():
            elem.text = i + spacing
        for child in elem:
            indent(child, level + 1)
        if not elem.tail or not elem.tail.strip():
            elem.tail = i
    else:
        if not elem.tail or not elem.tail.strip():
            elem.tail = i


# -------------------------
# Load JSON and convert
# -------------------------
with open("persona.json") as f:
    data = json.load(f)

root_key = next(iter(data))
root = build_xml(root_key, data[root_key])

indent(root)  # pretty print

tree = ET.ElementTree(root)
tree.write("persona.xml", encoding="utf-8", xml_declaration=True)
```

### conversor de xml a json

```python
import json
import xmltodict

# Input / output filenames (change as needed)
INPUT_XML = "persona.xml"
OUTPUT_JSON = "persona2.json"

# Elements that should always be treated as arrays (lists)
# Add tag names here if necessary: "item", "book", "producto", etc.
FORCE_LIST_TAGS = ("item", "book")

def xml_to_json(input_xml: str, output_json: str) -> None:
    # 1. Read XML file
    with open(input_xml, "r", encoding="utf-8") as f:
        xml_content = f.read()

    # 2. Parse XML to Python dict
    #    force_list: ensures certain tags are *always* lists
    data = xmltodict.parse(xml_content, force_list=FORCE_LIST_TAGS)

    # 3. Save as pretty-printed JSON
    with open(output_json, "w", encoding="utf-8") as f:
        json.dump(data, f, indent=2, ensure_ascii=False)

    print(f"Saved JSON to: {output_json}")

if __name__ == "__main__":
    xml_to_json(INPUT_XML, OUTPUT_JSON)
```

### leer excel

```python
import pandas as pd

df = pd.read_excel("empresa.xlsx", engine="openpyxl")
print(df.head())
```

### leemos ods

```python
import pandas as pd

df = pd.read_excel("empresa.ods", engine="odf")
print(df.head())
```

### conversor bidireccional xlsx a ods

```python
import pandas as pd

def convert(file_in, file_out):
    if file_in.endswith(".ods"):
        df = pd.read_excel(file_in, engine="odf")
    else:
        df = pd.read_excel(file_in)

    if file_out.endswith(".ods"):
        from odf.opendocument import OpenDocumentSpreadsheet
        from odf.table import Table, TableRow, TableCell
        from odf.text import P

        ods = OpenDocumentSpreadsheet()
        table = Table(name="Sheet1")

        for row in df.itertuples(index=False):
            tr = TableRow()
            for value in row:
                cell = TableCell()
                cell.addElement(P(text=str(value)))
                tr.addElement(cell)
            table.addElement(tr)

        ods.spreadsheet.addElement(table)
        ods.save(file_out)

    else:
        df.to_excel(file_out, index=False)

# Example:
convert("empresa.xlsx", "empresaconvertida.ods")
convert("empresa.ods", "empresaconvertida.xlsx")
```

### unir dos pdf

```python
from PyPDF2 import PdfMerger

merger = PdfMerger()

merger.append("uno.pdf")
merger.append("dos.pdf")

merger.write("unido.pdf")
merger.close()
```

### unir array de pdf

```python
from PyPDF2 import PdfMerger

pdfs = ["uno.pdf", "dos.pdf"]

merger = PdfMerger()

for pdf in pdfs:
    merger.append(pdf)

merger.write("unido.pdf")
merger.close()
```

### separar pdf

```python
from PyPDF2 import PdfReader, PdfWriter

input_pdf = "uno.pdf"
reader = PdfReader(input_pdf)

for i, page in enumerate(reader.pages):
    writer = PdfWriter()
    writer.add_page(page)

    output_filename = f"page_{i+1}.pdf"
    with open(output_filename, "wb") as output:
        writer.write(output)

    print(f"Created: {output_filename}")
```

### separar pdf a jpg

```python
from pdf2image import convert_from_path

input_pdf = "uno.pdf"

# Convertir todas las páginas
pages = convert_from_path(input_pdf, dpi=300)

for i, page in enumerate(pages):
    output_filename = f"page_{i+1}.jpg"
    page.save(output_filename, "JPEG")
    print(f"Created: {output_filename}")
```

### separar pdf a png

```python
from pdf2image import convert_from_path

input_pdf = "uno.pdf"

# Convertir todas las páginas a imágenes PIL
pages = convert_from_path(input_pdf, dpi=300)

for i, page in enumerate(pages):
    output_filename = f"page_{i+1}.png"
    page.save(output_filename, "PNG")
    print(f"Created: {output_filename}")
```

### comprimir pdf

```python
import subprocess

input_pdf = "uno.pdf"
output_pdf = "unocomprimido.pdf"

cmd = [
    "gs",
    "-sDEVICE=pdfwrite",
    "-dCompatibilityLevel=1.4",
    "-dPDFSETTINGS=/screen",  # /screen, /ebook, /printer, /prepress, /default
    "-dNOPAUSE",
    "-dQUIET",
    "-dBATCH",
    f"-sOutputFile={output_pdf}",
    input_pdf
]

subprocess.run(cmd)
print("Compressed:", output_pdf)
```

### grid en HTML

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Me encanta PDF</title>
    <meta charset="utf-8">
  </head>
  <body>
    <header>
      <h1>Me encanta PDF</h1>
    </header>
    <main>
      <article id="unirpdf">
        <h3>Unir PDF</h3>
        <p>Selecciona esta opción para unir PDF</p>
      </article>
      <article id="separarpdf">
        <h3>Separar PDF</h3>
        <p>Selecciona esta opción para separar PDF</p>
      </article>
    </main>
  </body>
</html>
```

### miniservidor flask

```python
from flask import Flask, render_template

app = Flask(__name__)

@app.route("/")
def index():
    return render_template("index.html")

if __name__ == "__main__":
    app.run(debug=True)
```

### superservidor

```python
from flask import Flask, render_template, request, send_file
from PyPDF2 import PdfMerger, PdfReader, PdfWriter
import os
import zipfile
from uuid import uuid4
from werkzeug.utils import secure_filename

app = Flask(__name__)

# Carpetas para ficheros temporales
BASE_DIR = os.path.dirname(os.path.abspath(__file__))
UPLOAD_FOLDER = os.path.join(BASE_DIR, "uploads")
OUTPUT_FOLDER = os.path.join(BASE_DIR, "outputs")

os.makedirs(UPLOAD_FOLDER, exist_ok=True)
os.makedirs(OUTPUT_FOLDER, exist_ok=True)

ALLOWED_EXTENSIONS = {"pdf"}


def allowed_file(filename: str) -> bool:
    return "." in filename and filename.rsplit(".", 1)[1].lower() in ALLOWED_EXTENSIONS


@app.route("/")
def index():
    return render_template("index.html")


@app.route("/unir", methods=["POST"])
def unir_pdf():
    """
    Une varios archivos PDF enviados desde el formulario
    y devuelve un único PDF descargable.
    """
    files = request.files.getlist("pdfs")

    # Filtramos solo los PDF válidos
    pdf_files = [f for f in files if f and allowed_file(f.filename)]

    if not pdf_files:
        return "No se han enviado PDFs válidos", 400

    merger = PdfMerger()
    temp_paths = []

    try:
        # Guardamos y añadimos cada PDF al merger
        for f in pdf_files:
            filename = secure_filename(f.filename)
            temp_path = os.path.join(UPLOAD_FOLDER, f"{uuid4()}_{filename}")
            f.save(temp_path)
            temp_paths.append(temp_path)
            merger.append(temp_path)

        # Guardamos el resultado
        output_filename = f"unido_{uuid4()}.pdf"
        output_path = os.path.join(OUTPUT_FOLDER, output_filename)
        merger.write(output_path)
        merger.close()

        return send_file(
            output_path,
            as_attachment=True,
            download_name="unido.pdf",
            mimetype="application/pdf",
        )

    finally:
        # Limpieza básica de archivos temporales de entrada
        for path in temp_paths:
            if os.path.exists(path):
                os.remove(path)


@app.route("/separar", methods=["POST"])
def separar_pdf():
    """
    Separa un PDF en páginas individuales y devuelve un ZIP
    con un PDF por cada página.
    """
    file = request.files.get("pdf")

    if not file or not allowed_file(file.filename):
        return "Debes enviar un archivo PDF válido", 400

    # Guardamos el PDF original
    filename = secure_filename(file.filename)
    input_path = os.path.join(UPLOAD_FOLDER, f"{uuid4()}_{filename}")
    file.save(input_path)

    temp_outputs = []
    zip_path = None

    try:
        reader = PdfReader(input_path)

        # Carpeta temporal específica para este trabajo
        job_id = uuid4()
        job_folder = os.path.join(OUTPUT_FOLDER, f"split_{job_id}")
        os.makedirs(job_folder, exist_ok=True)

        # Creamos un PDF por página
        for i, page in enumerate(reader.pages):
            writer = PdfWriter()
            writer.add_page(page)
            page_filename = f"page_{i+1}.pdf"
            page_path = os.path.join(job_folder, page_filename)
            with open(page_path, "wb") as out_f:
                writer.write(out_f)
            temp_outputs.append(page_path)

        # Empaquetamos todo en un ZIP
        zip_filename = f"paginas_{job_id}.zip"
        zip_path = os.path.join(OUTPUT_FOLDER, zip_filename)

        with zipfile.ZipFile(zip_path, "w", zipfile.ZIP_DEFLATED) as zipf:
            for path in temp_outputs:
                arcname = os.path.basename(path)
                zipf.write(path, arcname=arcname)

        return send_file(
            zip_path,
            as_attachment=True,
            download_name="paginas_separadas.zip",
            mimetype="application/zip",
        )

    finally:
        # Limpieza: borramos el PDF original
        if os.path.exists(input_path):
            os.remove(input_path)
        # Podrías borrar también job_folder si no quieres conservarlo


if __name__ == "__main__":
    # Para desarrollo; en producción usar WSGI (gunicorn, etc.)
    app.run(debug=True)
```

### empresa

```
nombre,descripcion,precio
Cuaderno A5,Cuaderno rayado de tapa blanda con 80 hojas,4.50
Bolígrafo Azul,Bolígrafo de tinta azul con punta fina,1.20
Mochila Urbana,Mochila ligera con compartimento para portátil,29.90
Ratón Inalámbrico,Ratón óptico con conexión Bluetooth,12.99
Teclado Mecánico,Teclado con retroiluminación LED,44.90
Altavoz Portátil,Altavoz Bluetooth resistente al agua,22.50
Termo de Acero,Termo de 500 ml que mantiene temperatura 12h,15.00
Taza Cerámica,Taza blanca de cerámica de 350 ml,3.75
Auriculares Intraurales,Auriculares con cancelación pasiva de ruido,9.80
Lámpara de Escritorio,Lámpara LED con brazo articulado,18.50
"Monitor 24""",Monitor Full HD con panel IPS,129.00
Silla Ergonómica,Silla ajustable con soporte lumbar,89.99
Alfombrilla de Ratón,Alfombrilla antideslizante de 25x20 cm,2.95
Pendrive 32GB,Memoria USB 3.0 de alta velocidad,7.49
Disco SSD 512GB,SSD interno de lectura rápida,45.00
Cargador USB-C,Cargador rápido de 25W,11.95
Cable HDMI 2m,Cable HDMI de alta calidad 4K,6.50
Hub USB 4 puertos,Concentrador USB con 4 entradas 3.0,14.20
Carpeta A4,Carpeta con anillas metálicas,2.10
Lápiz HB,Lápiz de grafito con goma incorporada,0.50
Sobres DL,Paquete de 50 sobres blancos autoadhesivos,2.90
Archivador,Archivador de palanca con etiqueta lateral,3.60
Botella Deportiva,Botella reutilizable de 750 ml,8.40
Post-it Amarillos,Bloque de 100 notas adhesivas,1.80
Regleta 5 tomas,Regleta con interruptor general,9.70
Martillo de Carpintero,Martillo de acero de 300 g mango ergonómico,6.80
Destornillador Plano,Destornillador punta plana 5 mm,3.20
Juego de Llaves Allen,Set de 10 llaves métricas,7.00
Caja de Herramientas,Caja de plástico de 40 cm con bandeja,12.90
Pintura Acrílica Blanca,Bote de pintura acrílica de 250 ml,4.20
Rodillo de Pintura,Rodillo de espuma 18 cm con mango,3.95
Cinta Métrica 5m,Cinta profesional recubierta de nylon,5.60
Taladro Eléctrico,Taladro de 500W con percutor,39.90
Linterna LED,Linterna metálica recargable,14.99
Cargador Solar,Panel solar portátil para móviles,24.50
Casco de Obra,Casco de seguridad regulable,11.00
Guantes de Trabajo,Guantes resistentes antideslizantes,4.30
Gafas de Protección,Gafas transparentes antiimpacto,2.80
Caja de Tornillos,Set surtido de 300 tornillos,6.40
Spray Lubricante,Spray multiusos 400 ml,5.10
Barra de Siliconas,Paquete de 10 barritas para pistola termofusible,3.70
Pistola de Silicona,Pistola eléctrica termofusible,9.90
Escuadra Metálica,Escuadra de acero de 30 cm,4.10
Nivel Láser,Nivel de línea horizontal y vertical,27.90
Cepillo Metálico,Cepillo para limpieza de óxido,2.60
Esponja Multiuso,Esponja suave para limpieza general,0.90
Ambientador de Oficina,Aromatizante en spray 250 ml,2.75
Caja Organizadora,Caja de plástico transparente con separadores,8.00
Rotulador Permanente,Rotulador negro resistente al agua,1.50
```

### persona

```json
{ 
  "persona":{
    "nombre":"Jose Vicente",
    "apellidos":"Carratala Sanchis",
    "emails":[
      "info@jocarsa.com",
      "info@josevicentecarratala.com"
    ]
  }
}
```

### persona

```xml
<?xml version='1.0' encoding='utf-8'?>
<persona>
  <nombre>Jose Vicente</nombre>
  <apellidos>Carratala Sanchis</apellidos>
  <emails>
    <email>info@jocarsa.com</email>
    <email>info@josevicentecarratala.com</email>
  </emails>
</persona>
```

### persona2

```json
{
  "persona": {
    "nombre": "Jose Vicente",
    "apellidos": "Carratala Sanchis",
    "emails": {
      "email": [
        "info@jocarsa.com",
        "info@josevicentecarratala.com"
      ]
    }
  }
}
```

### pip

```

```


<a id="almacenamiento-de-informacion"></a>
# Almacenamiento de información

<a id="sistemas-de-almacenamiento-de-informacion-caracteristicas-tecnologias"></a>
## Sistemas de almacenamiento de información. Características. Tecnologías

En el vasto universo digital, los sistemas de almacenamiento de información desempeñan un papel fundamental, constituyendo la infraestructura sobre la que se construyen las aplicaciones y servicios modernos. Estos sistemas no son solo contenedores para datos; son la base de la eficiencia operativa y el acceso rápido a la información en cualquier organización o proyecto informático.

La diversidad de tecnologías disponibles ofrece una gama infinita de opciones para almacenar, recuperar y gestionar los datos. Desde las bases de datos relacionales hasta las bases de datos no relacionales, cada sistema tiene sus propias fortalezas y debilidades, adaptándose a diferentes tipos de aplicaciones y requisitos funcionales.

Los sistemas de almacenamiento de información modernos están diseñados para manejar volúmenes crecientes de datos con alta velocidad y eficiencia. Desde la gestión de bases de datos en tiempo real hasta el almacenamiento de grandes cantidades de datos históricos, estos sistemas ofrecen soluciones robustas que pueden escalar según las necesidades del proyecto.

La importancia de los sistemas de almacenamiento no se limita solo a su capacidad para almacenar datos. También es crucial su capacidad para garantizar la integridad y seguridad de la información. Los sistemas modernos incorporan mecanismos avanzados de control de acceso, encriptación y recuperación ante desastres, asegurando que los datos sean accesibles y seguros incluso en condiciones adversas.

Además de las tecnologías de almacenamiento tradicionales, también existen soluciones innovadoras como la nube. Los sistemas basados en la nube ofrecen una flexibilidad increíble, permitiendo a los usuarios acceder a sus datos desde cualquier lugar y a cualquier momento. A pesar de su costo inicial, estas soluciones a menudo resultan más económicas a largo plazo debido a las economías de escala y la escalabilidad.

La gestión eficiente de los sistemas de almacenamiento es un aspecto crucial del desarrollo de aplicaciones informáticas. Los ingenieros y desarrolladores deben tener en cuenta no solo el rendimiento y la capacidad de almacenamiento, sino también la facilidad de mantenimiento y la escalabilidad del sistema. Una buena estrategia de gestión de almacenamiento puede hacer una gran diferencia en la eficiencia operativa y la sostenibilidad a largo plazo de cualquier proyecto informático.

En conclusión, los sistemas de almacenamiento de información son el corazón de cualquier aplicación moderna. Desde las bases de datos relacionales hasta las soluciones basadas en la nube, cada tecnología tiene sus propias ventajas y desventajas, adaptándose a diferentes tipos de aplicaciones y requisitos funcionales. La elección del sistema de almacenamiento adecuado es un paso crucial en el desarrollo de cualquier proyecto informático, y requiere una comprensión profunda de las necesidades específicas del proyecto y la capacidad para elegir la tecnología que mejor se adapte a ellas.

### discos

```html
<!doctype html>
<html>
  <head>
  </head>
  <body>
    
  </body>
</html>
```

### crear base de datos

```sql
sudo mysql -u root -p

-- 1. Crear base de datos
CREATE DATABASE discos
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

-- 2. Crear usuario (si no existe)
CREATE USER IF NOT EXISTS 'discos'@'%' IDENTIFIED BY 'discos';

-- 3. Conceder permisos totales sobre la base de datos
GRANT ALL PRIVILEGES ON discos.* TO 'discos'@'%';

FLUSH PRIVILEGES;

-- 4. Usar la base de datos
USE discos;

-- 5. Crear tabla discos (álbumes musicales)
CREATE TABLE discos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    artista VARCHAR(255) NOT NULL,
    anio INT,
    genero VARCHAR(100),
    duracion_minutos INT,
    fecha_compra DATE,
    precio DECIMAL(6,2)
);

-- 6. Insertar datos de ejemplo
INSERT INTO discos (titulo, artista, anio, genero, duracion_minutos, fecha_compra, precio)
VALUES 
('The Dark Side of the Moon', 'Pink Floyd', 1973, 'Rock Progresivo', 43, '2024-01-15', 12.95),
('Thriller', 'Michael Jackson', 1982, 'Pop', 42, '2023-11-01', 9.99),
('Back in Black', 'AC/DC', 1980, 'Rock', 41, '2024-02-10', 11.50),
('Nevermind', 'Nirvana', 1991, 'Grunge', 49, '2024-03-05', 10.00),
('Rumours', 'Fleetwood Mac', 1977, 'Soft Rock', 39, '2024-01-20', 8.75);
```

### pequeño formulario

```html
<!doctype html>
<html>
  <head>
  </head>
  <body>
    <form action="004-insertadisco.php" method="POST">
      <input type="text" name="titulo" placeholder="titulo">
      <input type="text" name="artista" placeholder="artista">
      <input type="text" name="anio" placeholder="anio">
      <input type="text" name="genero" placeholder="genero">
      <input type="number" name="duracion_minutos" placeholder="duracion_minutos">
      <input type="date" name="fecha_compra" placeholder="fecha_compra">
      <input type="number" name="precio" placeholder="precio">
      <input type="submit">
    </form>
  </body>
</html>
```

### insertadisco

```
<?php
// Me conecto a la base de datos
$mysqli = new mysqli("localhost", "discos", "discos", "discos");

// Ahora le pido algo a las entradas
$sql = "
  INSERT INTO discos
  VALUES(
    NULL,
    '".$_POST['titulo']."',
    '".$_POST['artista']."',
    '".$_POST['anio']."',
    '".$_POST['genero']."',
    '".$_POST['duracion_minutos']."',
    '".$_POST['fecha_compra']."',
    '".$_POST['precio']."'
  );
";
$result = $mysqli->query($sql);

?>
```

### todo en un mismo archivo

```
<?php
  if(isset($_GET['operacion']) && $_GET['operacion'] == "insertar"){
    $mysqli = new mysqli("localhost", "discos", "discos", "discos");
    $sql = "
      INSERT INTO discos
      VALUES(
        NULL,
        '".$_POST['titulo']."',
        '".$_POST['artista']."',
        '".$_POST['anio']."',
        '".$_POST['genero']."',
        '".$_POST['duracion_minutos']."',
        '".$_POST['fecha_compra']."',
        '".$_POST['precio']."'
      );
    ";
    $result = $mysqli->query($sql);
  }
?>
<!doctype html>
<html>
  <head>
  </head>
  <body>
    <form action="?operacion=insertar" method="POST">
      <input type="text" name="titulo" placeholder="titulo">
      <input type="text" name="artista" placeholder="artista">
      <input type="text" name="anio" placeholder="anio">
      <input type="text" name="genero" placeholder="genero">
      <input type="number" name="duracion_minutos" placeholder="duracion_minutos">
      <input type="date" name="fecha_compra" placeholder="fecha_compra">
      <input type="number" name="precio" placeholder="precio">
      <input type="submit">
    </form>
  </body>
</html>
```

### ahora quiero leer

```
<?php
  if(isset($_GET['operacion']) && $_GET['operacion'] == "insertar"){
    $mysqli = new mysqli("localhost", "discos", "discos", "discos");
    $sql = "
      INSERT INTO discos
      VALUES(
        NULL,
        '".$_POST['titulo']."',
        '".$_POST['artista']."',
        '".$_POST['anio']."',
        '".$_POST['genero']."',
        '".$_POST['duracion_minutos']."',
        '".$_POST['fecha_compra']."',
        '".$_POST['precio']."'
      );
    ";
    $result = $mysqli->query($sql);
  }
?>
<!doctype html>
<html>
  <head>
  </head>
  <body>
    <form action="?operacion=insertar" method="POST">
      <input type="text" name="titulo" placeholder="titulo">
      <input type="text" name="artista" placeholder="artista">
      <input type="text" name="anio" placeholder="anio">
      <input type="text" name="genero" placeholder="genero">
      <input type="number" name="duracion_minutos" placeholder="duracion_minutos">
      <input type="date" name="fecha_compra" placeholder="fecha_compra">
      <input type="number" name="precio" placeholder="precio">
      <input type="submit">
    </form>
    <table>
      <?php
        $mysqli = new mysqli("localhost", "discos", "discos", "discos");
        $sql = "SELECT * FROM discos";
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
  </body>
</html>
```

### un poco de estilo

```
<?php
  if(isset($_GET['operacion']) && $_GET['operacion'] == "insertar"){
    $mysqli = new mysqli("localhost", "discos", "discos", "discos");
    $sql = "
      INSERT INTO discos
      VALUES(
        NULL,
        '".$_POST['titulo']."',
        '".$_POST['artista']."',
        '".$_POST['anio']."',
        '".$_POST['genero']."',
        '".$_POST['duracion_minutos']."',
        '".$_POST['fecha_compra']."',
        '".$_POST['precio']."'
      );
    ";
    $result = $mysqli->query($sql);
  }
?>
<!doctype html>
<html>
  <head>
    <style>
      html,body{width:100%;height:100%;background:grey;padding:0px;margin:0px;}
      body{display:flex;justify-content:center;align-items:center;font-family:sans-serif;}
      section{width:1200px;height:600px;background:white;padding:20px;display:flex;gap:20px;}
      #insertar{flex:1;}
      #insertar form{display:flex;flex-direction:column;gap:20px;}
      #listar{flex:6;}
      table{width:100%;border:1px solid indigo;}
    </style>
  </head>
  <body>
    <section>
    <article id="insertar">
      <h3>Insertar un disco</h3>
      <form action="?operacion=insertar" method="POST">
        
        <input type="text" name="titulo" placeholder="titulo">
        <input type="text" name="artista" placeholder="artista">
        <input type="text" name="anio" placeholder="anio">
        <input type="text" name="genero" placeholder="genero">
        <input type="number" name="duracion_minutos" placeholder="duracion_minutos">
        <input type="date" name="fecha_compra" placeholder="fecha_compra">
        <input type="number" name="precio" placeholder="precio">
        <input type="submit">
      </form>
    </article>
    <article id="listar">
      <h3>Listado de discos</h3>
      <table>
        
        <?php
          $mysqli = new mysqli("localhost", "discos", "discos", "discos");
          $sql = "SELECT * FROM discos";
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
    </article>
    </section>
  </body>
</html>
```

### boton de eliminar

```
<?php
  if(isset($_GET['operacion']) && $_GET['operacion'] == "insertar"){
    $mysqli = new mysqli("localhost", "discos", "discos", "discos");
    $sql = "
      INSERT INTO discos
      VALUES(
        NULL,
        '".$_POST['titulo']."',
        '".$_POST['artista']."',
        '".$_POST['anio']."',
        '".$_POST['genero']."',
        '".$_POST['duracion_minutos']."',
        '".$_POST['fecha_compra']."',
        '".$_POST['precio']."'
      );
    ";
    $result = $mysqli->query($sql);
  }
?>
<!doctype html>
<html>
  <head>
    <style>
      html,body{width:100%;height:100%;background:grey;padding:0px;margin:0px;}
      body{display:flex;justify-content:center;align-items:center;font-family:sans-serif;}
      section{width:1200px;height:600px;background:white;padding:20px;display:flex;gap:20px;}
      #insertar{flex:1;}
      #insertar form{display:flex;flex-direction:column;gap:20px;}
      #listar{flex:6;}
      table{width:100%;border:1px solid indigo;}
    </style>
  </head>
  <body>
    <section>
    <article id="insertar">
      <h3>Insertar un disco</h3>
      <form action="?operacion=insertar" method="POST">
        <input type="text" name="titulo" placeholder="titulo">
        <input type="text" name="artista" placeholder="artista">
        <input type="text" name="anio" placeholder="anio">
        <input type="text" name="genero" placeholder="genero">
        <input type="number" name="duracion_minutos" placeholder="duracion_minutos">
        <input type="date" name="fecha_compra" placeholder="fecha_compra">
        <input type="number" name="precio" placeholder="precio">
        <input type="submit">
      </form>
    </article>
    <article id="listar">
      <h3>Listado de discos</h3>
      <table>
        
        <?php
          $mysqli = new mysqli("localhost", "discos", "discos", "discos");
          $sql = "SELECT * FROM discos";
          $resultado = $mysqli->query($sql);
          while ($fila = $resultado->fetch_assoc()) {
              echo "<tr>";
              foreach($fila as $clave=>$valor){
                echo "<td>".$valor."</td>";
              }
              echo "<td><a href='?operacion=eliminar&id=".$fila['id']."'>❌</a></td>";
              echo "</tr>";
          }
        ?>
      </table>
    </article>
    </section>
  </body>
</html>
```

### procesar eliminar

```
<?php
  if(isset($_GET['operacion']) && $_GET['operacion'] == "insertar"){
    $mysqli = new mysqli("localhost", "discos", "discos", "discos");
    $sql = "
      INSERT INTO discos
      VALUES(
        NULL,
        '".$_POST['titulo']."',
        '".$_POST['artista']."',
        '".$_POST['anio']."',
        '".$_POST['genero']."',
        '".$_POST['duracion_minutos']."',
        '".$_POST['fecha_compra']."',
        '".$_POST['precio']."'
      );
    ";
    $result = $mysqli->query($sql);
  }
?>
<?php
  if(isset($_GET['operacion']) && $_GET['operacion'] == "eliminar"){
    $mysqli = new mysqli("localhost", "discos", "discos", "discos");
    $sql = "
      DELETE FROM discos
      WHERE id = ".$_GET['id'].";
    ";
    $result = $mysqli->query($sql);
  }
?>
<!doctype html>
<html>
  <head>
    <style>
      html,body{width:100%;height:100%;background:grey;padding:0px;margin:0px;}
      body{display:flex;justify-content:center;align-items:center;font-family:sans-serif;}
      main{width:1200px;height:600px;background:white;padding:20px;}
      main section{display:flex;gap:20px;}
      #insertar{flex:1;}
      #insertar form{display:flex;flex-direction:column;gap:20px;}
      #listar{flex:6;}
      table{width:100%;border:1px solid indigo;padding:10px;}
      form input{padding:10px;}
    </style>
  </head>
  <body>
    <main>
    <h1>💿 Aplicación de gestión de discos</h1>
    <section>
      <article id="insertar">
        <h3>Insertar un disco</h3>
        <form action="?operacion=insertar" method="POST">
          <input type="text" name="titulo" placeholder="titulo">
          <input type="text" name="artista" placeholder="artista">
          <input type="text" name="anio" placeholder="anio">
          <input type="text" name="genero" placeholder="genero">
          <input type="number" name="duracion_minutos" placeholder="duracion_minutos">
          <input type="date" name="fecha_compra" placeholder="fecha_compra">
          <input type="number" name="precio" placeholder="precio">
          <input type="submit">
        </form>
      </article>
      <article id="listar">
        <h3>Listado de discos</h3>
        <table>
          
          <?php
            $mysqli = new mysqli("localhost", "discos", "discos", "discos");
            $sql = "SELECT * FROM discos";
            $resultado = $mysqli->query($sql);
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                foreach($fila as $clave=>$valor){
                  echo "<td>".$valor."</td>";
                }
                echo "<td><a href='?operacion=eliminar&id=".$fila['id']."'>❌</a></td>";
                echo "</tr>";
            }
          ?>
        </table>
      </article>
      </section>
    </main>
  </body>
</html>
```

### cabeceras de la tabla

```
<?php
  if(isset($_GET['operacion']) && $_GET['operacion'] == "insertar"){
    $mysqli = new mysqli("localhost", "discos", "discos", "discos");
    $sql = "
      INSERT INTO discos
      VALUES(
        NULL,
        '".$_POST['titulo']."',
        '".$_POST['artista']."',
        '".$_POST['anio']."',
        '".$_POST['genero']."',
        '".$_POST['duracion_minutos']."',
        '".$_POST['fecha_compra']."',
        '".$_POST['precio']."'
      );
    ";
    $result = $mysqli->query($sql);
  }
?>
<?php
  if(isset($_GET['operacion']) && $_GET['operacion'] == "eliminar"){
    $mysqli = new mysqli("localhost", "discos", "discos", "discos");
    $sql = "
      DELETE FROM discos
      WHERE id = ".$_GET['id'].";
    ";
    $result = $mysqli->query($sql);
  }
?>
<!doctype html>
<html>
  <head>
    <style>
      html,body{width:100%;height:100%;background:indigo;padding:0px;margin:0px;}
      body{display:flex;justify-content:center;align-items:center;font-family:sans-serif;}
      main{width:1200px;height:600px;background:white;padding:20px;border-radius:10px;}
      main section{display:flex;gap:20px;}
      #insertar{flex:1;}
      #insertar form{display:flex;flex-direction:column;gap:20px;}
      #listar{flex:4;}
      table{width:100%;border:1px solid indigo;padding:10px;border-radius:10px;}
      form input{padding:10px;border-radius:5px;border:1px solid indigo;}
      h1{text-align:center;}
      table thead{background:indigo;color:white;}
      form input[type="submit"]{background:indigo;color:white;}
      table td,table th{padding:5px;}
    </style>
  </head>
  <body>
    <main>
    <h1>💿 Aplicación de gestión de discos</h1>
    <section>
      <article id="insertar">
        <h3>Insertar un disco</h3>
        <form action="?operacion=insertar" method="POST">
          <input type="text" name="titulo" placeholder="titulo">
          <input type="text" name="artista" placeholder="artista">
          <input type="text" name="anio" placeholder="anio">
          <input type="text" name="genero" placeholder="genero">
          <input type="number" name="duracion_minutos" placeholder="duracion_minutos">
          <input type="date" name="fecha_compra" placeholder="fecha_compra">
          <input type="number" name="precio" placeholder="precio">
          <input type="submit">
        </form>
      </article>
      <article id="listar">
        <h3>Listado de discos</h3>
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
            $mysqli = new mysqli("localhost", "discos", "discos", "discos");
            $sql = "SELECT * FROM discos";
            $resultado = $mysqli->query($sql);
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                foreach($fila as $clave=>$valor){
                  echo "<td>".$valor."</td>";
                }
                echo "<td><a href='?operacion=eliminar&id=".$fila['id']."'>❌</a></td>";
                echo "</tr>";
            }
          ?>
          </tbody>
        </table>
      </article>
      </section>
    </main>
  </body>
</html>
```

<a id="lenguajes-de-consulta-y-manipulacion-en-documentos"></a>
## Lenguajes de consulta y manipulación en documentos

En el vasto mundo de la informática, los lenguajes de consulta y manipulación en documentos desempeñan un papel crucial. Estos idiomas proporcionan las herramientas necesarias para interactuar con los datos almacenados en diferentes formatos, permitiendo su acceso, modificación y análisis. Comenzamos por entender qué son estos lenguajes y cómo se utilizan.

El primer paso es conocer la estructura básica de un documento que puede ser consultado o manipulado mediante estos lenguajes. Un documento puede estar compuesto por elementos como etiquetas, atributos y contenido. Los lenguajes de consulta y manipulación permiten seleccionar y acceder a estos elementos de manera eficiente.

Una vez comprendida la estructura básica, es importante aprender los comandos y sintaxis específicos del lenguaje que se está utilizando. Por ejemplo, en HTML, el comando `<p>` se utiliza para definir un párrafo, mientras que en XML, las etiquetas pueden contener atributos adicionales que proporcionan información adicional sobre el contenido.

La manipulación de documentos implica no solo la lectura, sino también la creación y modificación. Los lenguajes de consulta y manipulación permiten agregar, eliminar o modificar elementos dentro de un documento. Por ejemplo, en SQL, se pueden utilizar comandos como `INSERT`, `UPDATE` y `DELETE` para realizar estas operaciones.

Además de la manipulación directa de los documentos, los lenguajes de consulta y manipulación también permiten realizar consultas complejas que extraen información específica basada en criterios definidos. Por ejemplo, en SQL, se pueden utilizar cláusulas como `WHERE`, `ORDER BY` y `GROUP BY` para filtrar y ordenar los resultados.

La importancia de entender los lenguajes de consulta y manipulación radica en su capacidad para optimizar el acceso a la información. Al conocer cómo seleccionar y manipular datos de manera eficiente, se pueden reducir significativamente tiempos de respuesta y mejorar la eficiencia general del sistema.

Además, estos lenguajes son esenciales para la integración de diferentes sistemas informáticos. Al permitir la consulta y manipulación de datos en formatos estándar, facilitan el intercambio de información entre aplicaciones y sistemas distintos.

La práctica es clave para dominar los lenguajes de consulta y manipulación. Es importante experimentar con diferentes comandos y sintaxis hasta lograr un nivel de fluidez y eficiencia en la manipulación de documentos.

En conclusión, los lenguajes de consulta y manipulación en documentos son herramientas poderosas que permiten interactuar con la información de manera eficiente y precisa. A través del conocimiento de sus comandos y sintaxis, se pueden optimizar procesos, mejorar la eficiencia general del sistema y facilitar el intercambio de información entre diferentes aplicaciones y sistemas informáticos.

### formulario

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Formulario</title>
    <meta charset="utf-8">
  </head>
  <body>
    <form>
      <fieldset>
        <legend>Formulario de recogida de datos</legend>
        <label for="nombre">Introduce tu nombre</label>
        <input type="text" name="nombre" id="nombre">
        <label for="nombre">Introduce tus apellidos</label>
        <input type="text" name="apellidos">
        <input type="submit">
      </fieldset>
    </form>
  </body>
</html>
```

### un poco de estilo

```html
<!doctype html>
<html lang="es">
  <head>
    <title>Formulario</title>
    <meta charset="utf-8">
    <style>
      body,html{background:lightgray;display:flex;
        width:100%;justify-content:center;font-family:sans-serif;}
      form{background:white;padding:20px;width:600px;}
      form fieldset{display:flex;flex-direction:column;gap:20px;border:none;}
      form fieldset input{padding:10px;border:1px solid lightgray;}
      .control_formulario{display:flex;}
      .control_formulario label,.control_formulario input{flex:1;}
    </style>
  </head>
  <body>
    <form>
      <fieldset>
        <legend>Formulario de recogida de datos</legend>
        <div class="control_formulario">
          <label for="nombre">Introduce tu nombre</label>
          <input type="text" name="nombre" id="nombre">
        </div>
        <div class="control_formulario">
          <label for="nombre">Introduce tus apellidos</label>
          <input type="text" name="apellidos">
        </div>
        <input type="submit">
      </fieldset>
    </form>
  </body>
</html>
```

### vamos a crear muchos elementos

```
<!doctype html>
<html lang="es">
  <head>
    <title>Formulario</title>
    <meta charset="utf-8">
    <style>
      body,html{background:lightgray;display:flex;
        width:100%;justify-content:center;font-family:sans-serif;}
      form{background:white;padding:20px;width:600px;}
      form fieldset{display:flex;flex-direction:column;gap:20px;border:none;}
      form fieldset input{padding:10px;border:1px solid lightgray;}
      .control_formulario{display:flex;}
      .control_formulario label,.control_formulario input{flex:1;}
    </style>
  </head>
  <body>
    <form>
      <fieldset>
        <legend>Formulario de recogida de datos</legend>
        <?php for($i = 0;$i<20;$i++){ ?>
          <div class="control_formulario">
            <label for="nombre">Introduce tu nombre</label>
            <input type="text" name="nombre" id="nombre">
          </div>
        <?php } ?>
        <input type="submit">
      </fieldset>
    </form>
  </body>
</html>
```

### panel de administracion

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

### acordar un modelo de datos

```sql
-- 1. CREATE DATABASE
CREATE DATABASE IF NOT EXISTS training_center
    DEFAULT CHARACTER SET utf8mb4
    DEFAULT COLLATE utf8mb4_unicode_ci;

USE training_center;

-- 2. CREATE TABLE WITH MANY FIELD TYPES
CREATE TABLE inscripciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(150) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    telefono VARCHAR(20),

    curso VARCHAR(200) NOT NULL,                 -- Example of VARCHAR
    fecha_inscripcion DATE NOT NULL,             -- DATE type
    edad INT,                                    -- INT type
    precio DECIMAL(10,2),                        -- DECIMAL type
    pagado BOOLEAN DEFAULT 0,                    -- BOOLEAN
    modalidad ENUM('presencial','online','mixto'),   -- ENUM type

    notas TEXT,                                  -- TEXT type
    documento BLOB,                              -- BLOB (left empty in inserts)

    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. INSERT SAMPLE DATA (BLOB field left empty)
INSERT INTO inscripciones (
    nombre, apellidos, email, telefono, curso,
    fecha_inscripcion, edad, precio, pagado, modalidad, notas, documento
) VALUES
(
    'Laura', 'Martínez López', 'laura.martinez@example.com', '600123123',
    'Curso de Python Básico',
    '2025-02-01', 28, 199.99, 1, 'online',
    'Interesada en horario de tarde.',
    NULL
),
(
    'Carlos', 'Gómez Ruiz', 'carlos.gomez@example.com', '611456789',
    'Introducción a Linux',
    '2025-02-12', 34, 149.00, 0, 'presencial',
    'Solicita factura para empresa.',
    NULL
),
(
    'Ana', 'Serrano Torres', 'ana.serrano@example.com', '699222333',
    'Desarrollo Web Full Stack',
    '2025-02-15', 22, 499.50, 1, 'mixto',
    'Tiene conocimientos previos de HTML.',
    NULL
);
```

### crear_usuario

```sql
CREATE USER 
'training_center'@'localhost' 
IDENTIFIED  BY 'training_center';

GRANT USAGE ON *.* TO 'training_center'@'localhost';

ALTER USER 'training_center'@'localhost' 
REQUIRE NONE 
WITH MAX_QUERIES_PER_HOUR 0 
MAX_CONNECTIONS_PER_HOUR 0 
MAX_UPDATES_PER_HOUR 0 
MAX_USER_CONNECTIONS 0;

GRANT ALL PRIVILEGES ON `training_center`.* 
TO 'training_center'@'localhost';

FLUSH PRIVILEGES;
```

### saco el modelo de datos de la base de datos

```
<!doctype html>
<html lang="es">
  <head>
    <title>Formulario</title>
    <meta charset="utf-8">
    <style>
      body,html{background:lightgray;display:flex;
        width:100%;justify-content:center;font-family:sans-serif;}
      form{background:white;padding:20px;width:600px;}
      form fieldset{display:flex;flex-direction:column;gap:20px;border:none;}
      form fieldset input{padding:10px;border:1px solid lightgray;}
      .control_formulario{display:flex;}
      .control_formulario label,.control_formulario input{flex:1;}
    </style>
  </head>
  <body>
    <form>
      <fieldset>
        <legend>Formulario de recogida de datos</legend>
        <?php
          $c = new mysqli("localhost","training_center","training_center","training_center");
          $r = $c->query("SHOW COLUMNS FROM inscripciones;");
          while($f = $r->fetch_assoc()){
              echo '
                <div class="control_formulario">
                  <label for="nombre">Introduce '.$f['Field'].'</label>
                  <input type="text" name="'.$f['Field'].'" id="'.$f['Field'].'">
                </div>
              ';
          }
          ?>
        <input type="submit">
      </fieldset>
    </form>
  </body>
</html>
```

### quitar el id

```
<!doctype html>
<html lang="es">
  <head>
    <title>Formulario</title>
    <meta charset="utf-8">
    <style>
      body,html{background:lightgray;display:flex;
        width:100%;justify-content:center;font-family:sans-serif;}
      form{background:white;padding:20px;width:600px;}
      form fieldset{display:flex;flex-direction:column;gap:20px;border:none;}
      form fieldset input{padding:10px;border:1px solid lightgray;}
      .control_formulario{display:flex;}
      .control_formulario label,.control_formulario input{flex:1;}
    </style>
  </head>
  <body>
    <form>
      <fieldset>
        <legend>Formulario de recogida de datos</legend>
        <?php
          $c = new mysqli("localhost","training_center","training_center","training_center");
          $r = $c->query("SHOW COLUMNS FROM inscripciones;");
          while($f = $r->fetch_assoc()){
            if($f['Key'] != "PRI" || $f['Extra'] == "DEFAULT_GENERATED"){
              echo '<div class="control_formulario"><label for="nombre">Introduce '.$f['Field'].'</label>'; 
              if (str_contains($f['Type'], "varchar")) {
                 echo '<input type="text" name="'.$f['Field'].'" id="'.$f['Field'].'">';
              }else if($f['Type'] == "date"){
                  echo '<input type="date" name="'.$f['Field'].'" id="'.$f['Field'].'">';
              }
              echo'</div>';
             }
          }
          ?>
        <input type="submit">
      </fieldset>
    </form>
  </body>
</html>
```

### personalizar campos

```
<!doctype html>
<html lang="es">
  <head>
    <title>Formulario</title>
    <meta charset="utf-8">
    <style>
      body,html{background:lightgray;display:flex;
        width:100%;justify-content:center;font-family:sans-serif;}
      form{background:white;padding:20px;width:600px;}
      form fieldset{display:flex;flex-direction:column;gap:20px;border:none;}
      form fieldset input{padding:10px;border:1px solid lightgray;}
      .control_formulario{display:flex;}
      .control_formulario label,.control_formulario input{flex:1;}
    </style>
  </head>
  <body>
    <form>
      <fieldset>
        <legend>Formulario de recogida de datos</legend>
        <?php
          $c = new mysqli("localhost","training_center","training_center","training_center");
          $r = $c->query("SHOW COLUMNS FROM inscripciones;");
          while($f = $r->fetch_assoc()){
            if($f['Key'] != "PRI" || $f['Extra'] == "DEFAULT_GENERATED"){
              echo '<div class="control_formulario"><label for="nombre">Introduce '.$f['Field'].'</label>'; 
              if (str_contains($f['Type'], "varchar")) {
                 echo '<input type="text" name="'.$f['Field'].'" id="'.$f['Field'].'">';
              }else if($f['Type'] == "date"){
                  echo '<input type="date" name="'.$f['Field'].'" id="'.$f['Field'].'">';
              }else if($f['Type'] == "int"){
                  echo '<input type="number" name="'.$f['Field'].'" id="'.$f['Field'].'">';
              }else if (str_contains($f['Type'], "decimal")) {
                 echo '<input type="number" name="'.$f['Field'].'" id="'.$f['Field'].'" step="0.01">';
              }else if (str_contains($f['Type'], "tinyint")) {
                 echo '<input type="checkbox" name="'.$f['Field'].'" id="'.$f['Field'].'" step="0.01">';
              }
              echo'</div>';
             }
          }
          ?>
        <input type="submit">
      </fieldset>
    </form>
  </body>
</html>
```

### mas tipos de campo

```
<!doctype html>
<html lang="es">
  <head>
    <title>Formulario</title>
    <meta charset="utf-8">
    <style>
      body,html{background:lightgray;display:flex;
        width:100%;justify-content:center;font-family:sans-serif;}
      form{background:white;padding:20px;width:600px;}
      form fieldset{display:flex;flex-direction:column;gap:20px;border:none;}
      form fieldset input,form fieldset select{padding:10px;border:1px solid lightgray;}
      .control_formulario{display:flex;}
      .control_formulario label,.control_formulario input{flex:1;}
    </style>
  </head>
  <body>
    <form>
      <fieldset>
        <legend>Formulario de recogida de datos</legend>
        <?php
          $c = new mysqli("localhost","training_center","training_center","training_center");
          $r = $c->query("SHOW COLUMNS FROM inscripciones;");
          while($f = $r->fetch_assoc()){
            if($f['Key'] != "PRI" || $f['Extra'] == "DEFAULT_GENERATED"){
              echo '<div class="control_formulario"><label for="nombre">Introduce '.$f['Field'].'</label>'; 
              if (str_contains($f['Type'], "varchar")) {
                 echo '<input type="text" name="'.$f['Field'].'" id="'.$f['Field'].'">';
              }else if($f['Type'] == "date"){
                  echo '<input type="date" name="'.$f['Field'].'" id="'.$f['Field'].'">';
              }else if($f['Type'] == "int"){
                  echo '<input type="number" name="'.$f['Field'].'" id="'.$f['Field'].'">';
              }else if (str_contains($f['Type'], "decimal")) {
                 echo '<input type="number" name="'.$f['Field'].'" id="'.$f['Field'].'" step="0.01">';
              }else if (str_contains($f['Type'], "tinyint")) {
                 echo '<input type="checkbox" name="'.$f['Field'].'" id="'.$f['Field'].'" step="0.01">';
              }else if (str_contains($f['Type'], "enum")) {
                 echo '<select name="'.$f['Field'].'" id="'.$f['Field'].'" >';
                 preg_match_all("/'([^']+)'/", $f['Type'], $matches);
                 $enumValues = $matches[1];
                 var_dump($enumValues);
                 foreach($enumValues as $clave=>$valor){
                  echo '<option value="'.$valor.'">'.$valor.'</option>';
                 }
                 echo '</select>';
              }
              echo'</div>';
             }
          }
          ?>
        <input type="submit">
      </fieldset>
    </form>
  </body>
</html>
```

### textarea

```
<!doctype html>
<html lang="es">
  <head>
    <title>Formulario</title>
    <meta charset="utf-8">
    <style>
      body,html{background:lightgray;display:flex;
        width:100%;justify-content:center;font-family:sans-serif;}
      form{background:white;padding:20px;width:600px;}
      form fieldset{display:flex;flex-direction:column;gap:20px;border:none;}
      form fieldset input,
      form fieldset select,
      form fieldset textarea{padding:10px;border:1px solid lightgray;width:50%;}
      .control_formulario{display:flex;}
      .control_formulario label,.control_formulario input{flex:1;}
    </style>
  </head>
  <body>
    <form>
      <fieldset>
        <legend>Formulario de recogida de datos</legend>
        <?php
          $c = new mysqli("localhost","training_center","training_center","training_center");
          $r = $c->query("SHOW COLUMNS FROM inscripciones;");
          while($f = $r->fetch_assoc()){
            if($f['Key'] != "PRI" || $f['Extra'] == "DEFAULT_GENERATED"){
              echo '<div class="control_formulario"><label for="nombre">Introduce '.$f['Field'].'</label>'; 
              if (str_contains($f['Type'], "varchar")) {
                 echo '<input type="text" name="'.$f['Field'].'" id="'.$f['Field'].'">';
              }else if($f['Type'] == "date"){
                  echo '<input type="date" name="'.$f['Field'].'" id="'.$f['Field'].'">';
              }else if($f['Type'] == "int"){
                  echo '<input type="number" name="'.$f['Field'].'" id="'.$f['Field'].'">';
              }else if (str_contains($f['Type'], "decimal")) {
                 echo '<input type="number" name="'.$f['Field'].'" id="'.$f['Field'].'" step="0.01">';
              }else if (str_contains($f['Type'], "tinyint")) {
                 echo '<input type="checkbox" name="'.$f['Field'].'" id="'.$f['Field'].'" step="0.01">';
              }else if (str_contains($f['Type'], "enum")) {
                 echo '<select name="'.$f['Field'].'" id="'.$f['Field'].'" >';
                 preg_match_all("/'([^']+)'/", $f['Type'], $matches);
                 $enumValues = $matches[1];
                 var_dump($enumValues);
                 foreach($enumValues as $clave=>$valor){
                  echo '<option value="'.$valor.'">'.$valor.'</option>';
                 }
                 echo '</select>';
              }else if($f['Type'] == "text"){
                  echo '<textarea name="'.$f['Field'].'" id="'.$f['Field'].'"></textarea>';
              }
              echo'</div>';
             }
          }
          ?>
        <input type="submit">
      </fieldset>
    </form>
  </body>
</html>
```

### campos de tipo documento

```
<!doctype html>
<html lang="es">
  <head>
    <title>Formulario</title>
    <meta charset="utf-8">
    <style>
      body,html{background:lightgray;display:flex;
        width:100%;justify-content:center;font-family:sans-serif;}
      form{background:white;padding:20px;width:600px;}
      form fieldset{display:flex;flex-direction:column;gap:20px;border:none;}
      form fieldset input,
      form fieldset select,
      form fieldset textarea{padding:10px;border:1px solid lightgray;width:50%;}
      .control_formulario{display:flex;}
      .control_formulario label,.control_formulario input{flex:1;}
    </style>
  </head>
  <body>
    <form action="" method="POST" encoding="multipart/form-data">
      <fieldset>
        <legend>Formulario de recogida de datos</legend>
        <?php
          $c = new mysqli("localhost","training_center","training_center","training_center");
          $r = $c->query("SHOW COLUMNS FROM inscripciones;");
          while($f = $r->fetch_assoc()){
            if($f['Key'] != "PRI" && $f['Default'] != "CURRENT_TIMESTAMP"){
              echo '<div class="control_formulario"><label for="nombre">Introduce '.$f['Field'].'</label>'; 
              if (str_contains($f['Type'], "varchar")) {
                 echo '<input type="text" name="'.$f['Field'].'" id="'.$f['Field'].'">';
              }else if($f['Type'] == "date"){
                  echo '<input type="date" name="'.$f['Field'].'" id="'.$f['Field'].'">';
              }else if($f['Type'] == "int"){
                  echo '<input type="number" name="'.$f['Field'].'" id="'.$f['Field'].'">';
              }else if (str_contains($f['Type'], "decimal")) {
                 echo '<input type="number" name="'.$f['Field'].'" id="'.$f['Field'].'" step="0.01">';
              }else if (str_contains($f['Type'], "tinyint")) {
                 echo '<input type="checkbox" name="'.$f['Field'].'" id="'.$f['Field'].'" step="0.01">';
              }else if (str_contains($f['Type'], "enum")) {
                 echo '<select name="'.$f['Field'].'" id="'.$f['Field'].'" >';
                 preg_match_all("/'([^']+)'/", $f['Type'], $matches);
                 $enumValues = $matches[1];
                 var_dump($enumValues);
                 foreach($enumValues as $clave=>$valor){
                  echo '<option value="'.$valor.'">'.$valor.'</option>';
                 }
                 echo '</select>';
              }else if($f['Type'] == "text"){
                  echo '<textarea name="'.$f['Field'].'" id="'.$f['Field'].'"></textarea>';
              }else if (str_contains($f['Type'], "blob")) {
                 echo '<input type="file" name="'.$f['Field'].'" id="'.$f['Field'].'" step="0.01">';
              }
              echo'</div>';
             }
          }
          ?>
        <input type="submit">
      </fieldset>
    </form>
  </body>
</html>
```

### estilo

```
<!doctype html>
<html lang="es">
  <head>
    <title>Formulario</title>
    <meta charset="utf-8">
    <style>
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

  /* Campos de texto, selects, textarea (excluimos checkbox) */
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

  form fieldset input:not([type="checkbox"]):focus,
  form fieldset select:focus,
  form fieldset textarea:focus{
    border-color: var(--primary);
    box-shadow: 0 0 0 3px var(--primary-light);
    outline: none;
  }

  /* ---------- INTERRUPTOR ANIMADO PARA CHECKBOX ---------- */

  /* Contenedor del checkbox: alineamos horizontalmente label + switch */
  .control_formulario_checkbox{
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
  }
  .control_formulario_checkbox label{
    margin: 0;
  }

  /* Estilo base del checkbox como switch */
  .control_formulario_checkbox input[type="checkbox"]{
    appearance: none;
    -webkit-appearance: none;
    width: 52px;
    height: 28px;
    border-radius: 999px;
    background: #ccc;
    position: relative;
    cursor: pointer;
    outline: none;
    border: 1px solid #bbb;
    transition: background 0.25s ease-in-out, border-color 0.25s ease-in-out;
    flex-shrink: 0;
  }

  /* “Botón” circular del switch */
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
    box-shadow: 0 2px 6px rgba(0,0,0,0.25);
    transition: transform 0.25s ease-in-out;
  }

  /* Estado activado: color crimson y botón a la derecha */
  .control_formulario_checkbox input[type="checkbox"]:checked{
    background: var(--primary);
    border-color: var(--primary);
  }

  .control_formulario_checkbox input[type="checkbox"]:checked::before{
    transform: translate(22px, -50%);
  }

  /* Pequeño efecto al hacer focus vía teclado */
  .control_formulario_checkbox input[type="checkbox"]:focus-visible{
    box-shadow: 0 0 0 3px var(--primary-light);
  }

  /* ------------------------------------------------------ */

  input[type="submit"]{
    background: var(--primary);
    color: white;
    padding: 14px;
    border: none;
    border-radius: 6px;
    font-size: 1.1em;
    cursor: pointer;
    margin-top: 10px;
    transition: background 0.3s;
  }

  input[type="submit"]:hover{
    background: #b30021;
  }
</style>

  </head>
  <body>
    <form action="" method="POST" encoding="multipart/form-data">
      <fieldset>
        <legend>Formulario de recogida de datos</legend>
        <?php
          $c = new mysqli("localhost","training_center","training_center","training_center");
          $r = $c->query("SHOW COLUMNS FROM inscripciones;");
          while($f = $r->fetch_assoc()){
            if($f['Key'] != "PRI" && $f['Default'] != "CURRENT_TIMESTAMP"){
              echo '<div class="control_formulario"><label for="nombre">Introduce '.$f['Field'].'</label>'; 
              if (str_contains($f['Type'], "varchar")) {
                 echo '<input type="text" name="'.$f['Field'].'" id="'.$f['Field'].'">';
              }else if($f['Type'] == "date"){
                  echo '<input type="date" name="'.$f['Field'].'" id="'.$f['Field'].'">';
              }else if($f['Type'] == "int"){
                  echo '<input type="number" name="'.$f['Field'].'" id="'.$f['Field'].'">';
              }else if (str_contains($f['Type'], "decimal")) {
                 echo '<input type="number" name="'.$f['Field'].'" id="'.$f['Field'].'" step="0.01">';
              } else if (str_contains($f['Type'], "tinyint")) {
                    echo '<div class="control_formulario control_formulario_checkbox">';
                    echo '<label for="'.$f['Field'].'">Introduce '.$f['Field'].'</label>'; 
                    echo '<input type="checkbox" name="'.$f['Field'].'" id="'.$f['Field'].'">';
                    echo '</div>';

              }else if (str_contains($f['Type'], "enum")) {
                 echo '<select name="'.$f['Field'].'" id="'.$f['Field'].'" >';
                 preg_match_all("/'([^']+)'/", $f['Type'], $matches);
                 $enumValues = $matches[1];
                 var_dump($enumValues);
                 foreach($enumValues as $clave=>$valor){
                  echo '<option value="'.$valor.'">'.$valor.'</option>';
                 }
                 echo '</select>';
              }else if($f['Type'] == "text"){
                  echo '<textarea name="'.$f['Field'].'" id="'.$f['Field'].'"></textarea>';
              }else if (str_contains($f['Type'], "blob")) {
                 echo '<input type="file" name="'.$f['Field'].'" id="'.$f['Field'].'" step="0.01">';
              }
              echo'</div>';
             }
          }
          ?>
        <input type="submit">
      </fieldset>
    </form>
  </body>
</html>
```

### comentarios

```sql
ALTER TABLE inscripciones
    MODIFY id INT AUTO_INCREMENT PRIMARY KEY
        COMMENT 'Identificador único y autoincrementado de cada inscripción registrada en el sistema';

ALTER TABLE inscripciones
    MODIFY nombre VARCHAR(100) NOT NULL
        COMMENT 'Nombre propio del alumno tal como debe aparecer en los documentos oficiales del centro';

ALTER TABLE inscripciones
    MODIFY apellidos VARCHAR(150) NOT NULL
        COMMENT 'Apellidos del alumno, utilizados para certificados, facturación y listados administrativos';

ALTER TABLE inscripciones
    MODIFY email VARCHAR(150) UNIQUE NOT NULL
        COMMENT 'Correo electrónico del alumno; se utiliza como identificador de contacto y debe ser único';

ALTER TABLE inscripciones
    MODIFY telefono VARCHAR(20)
        COMMENT 'Número de teléfono del alumno para comunicación directa sobre el curso';

ALTER TABLE inscripciones
    MODIFY curso VARCHAR(200) NOT NULL
        COMMENT 'Nombre del curso al que el alumno se inscribe (título comercial o académico)';

ALTER TABLE inscripciones
    MODIFY fecha_inscripcion DATE NOT NULL
        COMMENT 'Fecha exacta en la que se registró la inscripción en el sistema';

ALTER TABLE inscripciones
    MODIFY edad INT
        COMMENT 'Edad del alumno en el momento de realizar la inscripción';

ALTER TABLE inscripciones
    MODIFY precio DECIMAL(10,2)
        COMMENT 'Coste total del curso en euros, incluyendo descuentos si los hubiera';

ALTER TABLE inscripciones
    MODIFY pagado BOOLEAN DEFAULT 0
        COMMENT 'Indica si el alumno ha completado el pago del curso (0 = no pagado, 1 = pagado)';

ALTER TABLE inscripciones
    MODIFY modalidad ENUM('presencial','online','mixto')
        COMMENT 'Tipo de impartición: presencial en aula, online en plataforma, o modalidad mixta';

ALTER TABLE inscripciones
    MODIFY notas TEXT
        COMMENT 'Campo de texto libre para observaciones internas: peticiones, incidencias, nivel previo, etc.';

ALTER TABLE inscripciones
    MODIFY documento BLOB
        COMMENT 'Archivo adjunto opcional (DNI escaneado, justificante de pago, documentos administrativos, etc.)';

ALTER TABLE inscripciones
    MODIFY creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        COMMENT 'Marca de tiempo que registra automáticamente cuándo se creó la inscripción';

ALTER TABLE inscripciones
    COMMENT = 'Registra todas las inscripciones de alumnos con sus datos personales, curso, modalidad y estado de pago.';
```

### usar comentarios

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
  width: 397.66253303079037px;
  height: 302.9499996409696px;
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

<div class="shape rectangle" style="left:40.02498851102939px;top:79.42498599781706px;width:119.99999999999996px;height:45.60001148897057px;">Formulario HTML</div>
<div class="shape rectangle" style="left:40px;top:40px;width:119.99999999999996px;height:39.99998653636258px;">CSS</div>
<div class="shape rectangle" style="left:40.01247630399814px;top:125.29999676872697px;width:119.99999999999996px;height:39.999999999999986px;">PHP</div>
<div class="shape rectangle" style="left:147.66253303079043px;top:222.9499996409696px;width:119.99999999999996px;height:39.999999999999986px;">MySQL</div>
<div class="shape rectangle" style="left:237.07501579733452px;top:122.94999964096965px;width:119.99999999999996px;height:39.999999999999986px;">PHP</div>
<div class="shape rectangle" style="left:237.66253303079037px;top:81.77500107709096px;width:119.99999999999996px;height:39.999999999999986px;">HTML</div>
<div class="shape rectangle" style="left:237.07501579733452px;top:41.77500107709099px;width:119.99999999999996px;height:39.999999999999986px;">CSS</div>
<div class="arrow" style="left:122.06061835426163px;top:165.29999676872697px;width:85.80562246263705px;transform:rotate(0.7367271772908089rad);"></div>
<div class="arrow arrow-double" style="left:225.5450295840992px;top:222.9499996409696px;width:80.48635379250275px;transform:rotate(-0.8412366754385971rad);"></div>
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

### diagrama

```
<svg xmlns="http://www.w3.org/2000/svg" width="397.66253303079037" height="302.9499996409696" viewBox="0 0 397.66253303079037 302.9499996409696">

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
        
<rect class="shape-rect" x="40.02498851102939" y="79.42498599781706" width="119.99999999999996" height="45.60001148897057" rx="4" ry="4" />
<text x="100.02498851102936" y="106.22499174230235" text-anchor="middle">Formulario HTML</text>
<rect class="shape-rect" x="40" y="40" width="119.99999999999996" height="39.99998653636258" rx="4" ry="4" />
<text x="99.99999999999997" y="63.999993268181285" text-anchor="middle">CSS</text>
<rect class="shape-rect" x="40.01247630399814" y="125.29999676872697" width="119.99999999999996" height="39.999999999999986" rx="4" ry="4" />
<text x="100.01247630399811" y="149.29999676872697" text-anchor="middle">PHP</text>
<rect class="shape-rect" x="147.66253303079043" y="222.9499996409696" width="119.99999999999996" height="39.999999999999986" rx="4" ry="4" />
<text x="207.6625330307904" y="246.9499996409696" text-anchor="middle">MySQL</text>
<rect class="shape-rect" x="237.07501579733452" y="122.94999964096965" width="119.99999999999996" height="39.999999999999986" rx="4" ry="4" />
<text x="297.0750157973345" y="146.94999964096965" text-anchor="middle">PHP</text>
<rect class="shape-rect" x="237.66253303079037" y="81.77500107709096" width="119.99999999999996" height="39.999999999999986" rx="4" ry="4" />
<text x="297.66253303079037" y="105.77500107709096" text-anchor="middle">HTML</text>
<rect class="shape-rect" x="237.07501579733452" y="41.77500107709099" width="119.99999999999996" height="39.999999999999986" rx="4" ry="4" />
<text x="297.0750157973345" y="65.77500107709099" text-anchor="middle">CSS</text>
<path class="conn" d="M 122.06061835426163 165.29999676872697 L 185.61439098052688 222.9499996409696" marker-end="url(#arrow-end)" />
<path class="conn" d="M 225.5450295840992 222.9499996409696 L 279.19251924402573 162.9499996409696" marker-start="url(#arrow-start)" marker-end="url(#arrow-end)" />
</svg>
```

<a id="consulta-y-manipulacion-de-informacion"></a>
## Consulta y manipulación de información

En el vasto mundo de la informática, el almacenamiento de información es un concepto fundamental que abarca desde el simple guardado de datos hasta la manipulación compleja de grandes volúmenes de datos. En esta subunidad didáctica, nos adentramos en los aspectos más importantes del almacenamiento y consulta de información, explorando cómo se gestionan los datos para su posterior recuperación y análisis.

El primer paso hacia el almacenamiento de información es entender cómo se organizan y estructuran los datos. Los sistemas utilizan una variedad de métodos para organizar la información, desde bases de datos relacionales hasta bases de datos no relacionales. Cada tipo de base de datos tiene sus propias ventajas y desventajas, dependiendo del tipo de datos que se manejen y las necesidades específicas del sistema.

La consulta de información es otro aspecto crucial en el almacenamiento de datos. Los sistemas permiten a los usuarios buscar y recuperar información de manera eficiente, utilizando lenguajes específicos como SQL para bases de datos relacionales o consultas orientadas a documentos para bases no relacionales. Estos lenguajes proporcionan una forma poderosa de filtrar y organizar la información según las necesidades del usuario.

Además de la consulta, el almacenamiento también implica la manipulación de los datos. Esto puede implicar la inserción, modificación o eliminación de registros en la base de datos. La manipulación de datos es un proceso delicado que requiere cuidado y precisión para evitar errores y garantizar la integridad de la información.

La importancia del almacenamiento y consulta de información no se limita a los sistemas tradicionales de bases de datos. En el mundo digital actual, la gestión de grandes volúmenes de datos en formatos como JSON o XML es cada vez más común. Estos formatos ofrecen flexibilidad y escalabilidad, permitiendo almacentar y consultar información de manera eficiente.

El almacenamiento y consulta de información también tienen un papel crucial en el desarrollo de interfaces de usuario. Los sistemas modernos utilizan la información almacenada para generar gráficos, informes y visualizaciones que facilitan la comprensión y análisis de los datos. Esta capacidad de presentar la información de manera visual es fundamental para la toma de decisiones basadas en datos.

En conclusión, el almacenamiento y consulta de información son procesos fundamentales en cualquier sistema informático. A través de la organización eficiente de los datos, su recuperación rápida y su manipulación precisa, se pueden crear sistemas que facilitan la toma de decisiones, mejorar la productividad y proporcionar una mejor experiencia al usuario. En esta subunidad didáctica, hemos explorado los aspectos más importantes de estos procesos, ofreciendo una comprensión sólida del almacenamiento y consulta de información en el contexto digital actual.

<a id="importacion-y-exportacion-de-bases-de-datos-relacionales-en-diferentes-formatos"></a>
## Importación y exportación de bases de datos relacionales en diferentes formatos

En el vasto mundo de la informática, la importación y exportación de bases de datos relacionales son procesos cruciales que permiten la transferencia de información entre diferentes sistemas o formatos. Esta subunidad didáctica nos guía a través del proceso detallado de cómo realizar estas operaciones, desde el formato de archivo hasta las herramientas disponibles para facilitar el trabajo.

La importación y exportación de bases de datos relacionales es un tema que abarca diversos aspectos técnicos y prácticos. Comenzamos por entender los diferentes formatos en los que se pueden almacenar las bases de datos, como CSV (Comma-Separated Values), XML (eXtensible Markup Language) o JSON (JavaScript Object Notation). Cada uno de estos formatos tiene sus ventajas y desventajas, dependiendo del tipo de información que se maneje y el sistema al que se desea transferir los datos.

El proceso de importación implica la lectura de un archivo en formato específico y su conversión en una estructura de datos que pueda ser utilizada por una base de datos relacional. Este proceso puede implicar la creación de nuevas tablas o la actualización de las existentes, dependiendo del contenido del archivo y las necesidades del sistema receptor.

Por otro lado, la exportación es el proceso inverso, donde los datos almacenados en una base de datos relacional se convierten en un formato de archivo que puede ser fácilmente compartido o migrado a otro sistema. Este proceso es crucial para la seguridad de los datos y la capacidad de replicar información entre diferentes entornos.

Las herramientas disponibles para facilitar estos procesos pueden variar ampliamente, desde interfaces gráficas intuitivas hasta comandos en línea y bibliotecas específicas para lenguajes de programación. Cada una de estas herramientas ofrece características distintas, como la capacidad de manejar grandes volúmenes de datos, la opción de seleccionar campos específicos o incluso la posibilidad de realizar transformaciones durante el proceso.

Es importante destacar que la importación y exportación de bases de datos relacionales no es un proceso trivial. Requiere una comprensión profunda del formato de archivo, las estructuras de la base de datos y las necesidades específicas del sistema receptor. Además, debe considerarse la seguridad de los datos durante todo el proceso, lo que puede implicar la implementación de medidas adicionales como encriptación o autenticación.

En conclusión, la importación y exportación de bases de datos relacionales es un aspecto fundamental de la gestión de información en sistemas informáticos. A través de una comprensión profunda de los formatos disponibles, las herramientas adecuadas y las mejores prácticas de seguridad, podemos realizar estos procesos con eficiencia y precisión, garantizando así la integridad y la transferencia correcta de datos entre diferentes sistemas o formatos.

<a id="herramientas-de-tratamiento-y-almacenamiento-de-informacion-en-sistemas-nativos"></a>
## Herramientas de tratamiento y almacenamiento de información en sistemas nativos

En el mundo digital actual, la gestión de información es una tarea fundamental que requiere herramientas eficientes y potentes. La carpeta `Primero/Lenguajes de marcas y sistemas de gestión de información/006-Almacenamiento de información/005-Herramientas de tratamiento y almacenamiento de información en sistemas nativos` aborda un aspecto crucial de esta tarea: cómo los sistemas operativos y bases de datos nativos pueden ser utilizados para almacenar, recuperar y gestionar la información de manera eficiente.

Los sistemas operativos nativos ofrecen una serie de herramientas que facilitan el acceso y manipulación de archivos y directorios. Desde la línea de comandos hasta interfaces gráficas, estas herramientas permiten a los usuarios realizar tareas como la creación, eliminación y copia de archivos, así como la búsqueda y organización de información en discos duros y unidades de almacenamiento externas. La familiaridad con estos comandos es esencial para cualquier profesional que trabaje con sistemas informáticos, ya que proporcionan un control directo sobre los recursos disponibles.

Además de las herramientas del sistema operativo, las bases de datos nativas ofrecen una forma robusta y eficiente de almacenar y recuperar grandes volúmenes de información. Las bases de datos relacionales, por ejemplo, permiten organizar la información en tablas con columnas y filas, lo que facilita su consulta y análisis. La capacidad de crear índices y utilizar consultas SQL permite a los usuarios extraer rápidamente los datos necesarios, incluso cuando se trata de conjuntos de datos muy grandes.

Las bases de datos no relacionales también son una opción valiosa para el almacenamiento de información en sistemas nativos. Estos sistemas están diseñados para manejar tipos de datos complejos y estructuras de datos que pueden no seguir un esquema riguroso. Las bases de datos orientadas a documentos, por ejemplo, almacenan los datos en formato JSON o BSON, lo que les permite representar información jerárquica y anidada de manera natural.

La gestión de la persistencia de objetos también es una herramienta importante para el almacenamiento de información en sistemas nativos. Las bases de datos orientadas a objetos permiten almacenar directamente los objetos de un programa informático, lo que facilita su acceso y manipulación. Esta capacidad es especialmente útil en aplicaciones empresariales donde la persistencia de objetos es una parte fundamental del funcionamiento del sistema.

En conclusión, las herramientas de tratamiento y almacenamiento de información en sistemas nativos son fundamentales para cualquier profesionista que trabaje con sistemas informáticos. Desde los comandos básicos del sistema operativo hasta las bases de datos avanzadas, estas herramientas proporcionan una forma eficiente y segura de almacenar, recuperar y gestionar la información. Con un conocimiento sólido de estas herramientas, los profesionales pueden optimizar el rendimiento de sus sistemas informáticos y mejorar la eficiencia en la gestión de la información.

<a id="almacenamiento-y-manipulacion-de-informacion-en-sistemas-nativos"></a>
## Almacenamiento y manipulación de información en sistemas nativos

En la rica e infinita biblioteca de conocimientos que constituye el mundo digital, una sección dedicada a la comprensión y gestión de la información ocupa un lugar privilegiado. Esta sección, titulada "Almacenamiento y manipulación de información en sistemas nativos", es un tesoro de conocimientos prácticos y teóricos que ilustra cómo los sistemas operativos y las aplicaciones modernas almacenan y recuperan datos con eficiencia y precisión.

La primera caja de esta sección nos presenta el concepto fundamental del almacenamiento en sistemas nativos. Aquí, aprendemos que el almacenamiento nativo no es solo la capacidad de guardar información en un dispositivo, sino también cómo esa información se organiza y recupera de manera eficiente. Esta organización se basa en estructuras de datos complejas como los archivos y las carpetas, que permiten una navegación intuitiva y rápida a través del contenido.

Siguiendo esta línea, el segundo párrafo nos introduce al concepto de bases de datos nativas. A diferencia de las bases de datos relacionales o no relacionales, estas son específicas del sistema operativo en cuestión y están diseñadas para funcionar eficientemente con los tipos de datos y estructuras que este soporta. Este conocimiento es crucial para entender cómo se almacenan y recuperan grandes volúmenes de información en entornos empresariales o científicos.

El tercer párrafo nos lleva a explorar la manipulación de información en sistemas nativos. Aquí, aprendemos que no solo se trata del almacenamiento inicial, sino también del acceso, modificación y eliminación de datos. Esta capacidad es fundamental para mantener los sistemas operativos funcionando correctamente y para permitir la interacción continua con el usuario.

El cuarto párrafo nos introduce a las herramientas y bibliotecas nativas que facilitan la manipulación de información. Estos recursos proporcionan una interfaz amigable y segura para interactuar con los sistemas operativos, permitiendo a los usuarios realizar tareas complejas con solo unas pocas líneas de código.

El quinto párrafo nos muestra cómo el almacenamiento y la manipulación de información en sistemas nativos están estrechamente relacionados con la seguridad. Aprenderemos que es crucial proteger la información almacena, tanto en términos de acceso no autorizado como de pérdida o daño accidental.

El sexto párrafo nos introduce a los conceptos avanzados de almacenamiento y manipulación de información en sistemas nativos. Aquí, exploramos cómo se pueden optimizar estos procesos para mejorar el rendimiento del sistema y la eficiencia operativa.

El séptimo párrafo nos lleva a considerar las implicaciones éticas y legales del almacenamiento y manipulación de información en sistemas nativos. Aprenderemos que es importante no solo técnicamente, sino también moralmente, garantizar la privacidad y el derecho a la información de los usuarios.

El octavo párrafo nos muestra cómo el almacenamiento y la manipulación de información en sistemas nativos están integrados en las aplicaciones modernas. Aquí, exploramos cómo estas habilidades son esenciales para desarrollar software eficiente y funcional.

El noveno párrafo nos introduce a los desafíos actuales y futuros del almacenamiento y la manipulación de información en sistemas nativos. Aprenderemos que aunque hemos avanzado significativamente, aún hay mucho por explorar y mejorar en términos de eficiencia, seguridad y accesibilidad.

El decimoprimero párrafo nos lleva a considerar el futuro del almacenamiento y la manipulación de información en sistemas nativos. Aquí, exploramos cómo las tecnologías emergentes como la inteligencia artificial y la nube están transformando estos procesos y cómo podemos aprovechar estas innovaciones para mejorar aún más la gestión de la información.

En conclusión, esta sección dedicada a "Almacenamiento y manipulación de información en sistemas nativos" es un valioso recurso para entender cómo los sistemas operativos modernos almacenan y recuperan datos con eficiencia y precisión. A través de una exploración detallada de estos procesos, podemos aprender a desarrollar software más robusto y seguro, y a aprovechar la potencialidad del mundo digital en su conjunto.


<a id="sistemas-de-gestion-empresarial"></a>
# Sistemas de gestión empresarial

<a id="aplicaciones-de-gestion-empresarial-tipos-caracteristicas"></a>
## Aplicaciones de gestión empresarial. Tipos. Características

En el vasto mundo de la informática, los sistemas de gestión empresarial (ERP-CRM) desempeñan un papel crucial como pilares sobre los cuales se edifica la eficiencia operativa y la toma de decisiones estratégicas. Estos sistemas integran diversos procesos clave dentro de una organización, desde el manejo de inventario hasta la gestión de relaciones con clientes.

La primer unidad didáctica que exploramos en esta sección del curso nos introduce a los fundamentos de las aplicaciones de gestión empresarial (ERP-CRM). Comenzamos por definir qué son estos sistemas y cómo han evolucionado para adaptarse a las necesidades cambiantes de las empresas. Aprenderemos sobre los tipos principales de ERP-CRM disponibles en el mercado, cada uno con sus fortalezas y debilidades específicas.

Continuando nuestro viaje, nos sumergimos en la configuración y instalación de estos sistemas. Descubriremos cómo seleccionar los módulos adecuados para una organización específica, así como los procesos detallados que implican para llevar a cabo una instalación exitosa. Este conocimiento es fundamental para garantizar que el sistema ERP-CRM funcione eficazmente desde su primera ejecución.

La unidad también nos guía en la organización y consulta de la información dentro del ERP-CRM. Aprenderemos cómo definir campos relevantes, realizar consultas de acceso a datos y generar informes personalizados. Estos habilidades son esenciales para que los usuarios puedan extraer la máxima información valiosa de su sistema de gestión empresarial.

Además, exploramos el proceso de implantación de sistemas ERP-CRM en una empresa real. Aprenderemos cómo adaptar las tablas y vistas del sistema a las necesidades específicas de la organización, así como cómo crear formularios y informes personalizados para satisfacer los requisitos particulares de cada negocio.

Finalmente, nos dedicamos al desarrollo de componentes dentro del ERP-CRM. Aprenderemos sobre la arquitectura del sistema, el lenguaje proporcionado y las herramientas disponibles para desarrollar e integrar nuevas funcionalidades. Este conocimiento es crucial para aquellos que desean personalizar su sistema ERP-CRM o crear soluciones adicionales basadas en él.

En resumen, esta unidad didáctica nos ofrece una visión integral de los sistemas de gestión empresarial (ERP-CRM), desde la comprensión básica hasta la implementación y desarrollo avanzado. A través de un enfoque práctico y detallado, nos prepara para enfrentar los desafíos reales que enfrentan las empresas al adoptar estos sistemas poderosos y versátiles.

<a id="instalacion"></a>
## Instalación

La instalación de sistemas ERP-CRM es un proceso fundamental que requiere una comprensión profunda de los requisitos específicos de la empresa, así como habilidades técnicas sólidas. En esta carpeta didáctica, se aborda el tema desde su análisis inicial hasta la configuración final del sistema, pasando por las etapas intermedias cruciales.

El primer paso es identificar el tipo de instalación que será necesario para la empresa. Dependiendo de su tamaño y necesidades particulares, puede optar por una instalación local o en la nube. Esta decisión tiene un impacto significativo en los recursos disponibles y en la escalabilidad del sistema a largo plazo.

Una vez determinado el tipo de instalación, se procede al análisis de los módulos que serán necesarios para el ERP-CRM. Cada empresa tiene requisitos específicos, por lo que es crucial seleccionar los módulos que mejor atenderán sus necesidades operativas. Esto puede incluir gestión financiera, recursos humanos, ventas y marketing, entre otros.

La configuración del sistema ERP-CRM es un proceso meticuloso que requiere una comprensión profunda de la estructura interna de la empresa. Se deben definir campos específicos para almacenar información relevante, como clientes, productos, proveedores y empleados. Además, se deben establecer las relaciones entre estos campos para garantizar la integridad de los datos.

Durante el proceso de instalación, es fundamental realizar consultas necesarias para obtener información relevante sobre la empresa. Esto puede incluir consultas de acceso a datos, informes y listados que ayudarán a validar la configuración del sistema y asegurar su correcto funcionamiento.

La creación de formularios personalizados es otro aspecto crucial en la instalación de sistemas ERP-CRM. Estos formularios permiten a los usuarios interactuar con el sistema de una manera más intuitiva y eficiente, adaptándose a las necesidades específicas de la empresa.

La creación de informes personalizados también es un paso importante en la instalación del ERP-CRM. Los informes proporcionan una visión detallada de la operación de la empresa y son esenciales para la toma de decisiones estratégicas. La capacidad de crear informes personalizados permite a los usuarios obtener información relevante y contextualizada.

Los paneles de control (dashboards) son herramientas valiosas en el sistema ERP-CRM, ya que proporcionan una visión general rápida y accesible de las principales métricas de la empresa. La creación de paneles de control personalizados permite a los usuarios visualizar información clave de manera eficiente y facilita la toma de decisiones basada en datos.

La integración con otros sistemas de gestión es otro aspecto importante en la instalación del ERP-CRM. El sistema debe ser capaz de interoperar con otras herramientas utilizadas por la empresa, como sistemas de facturación, inventario o contabilidad. La capacidad de integrarse con estos sistemas asegura una fluidez operativa y minimiza el esfuerzo necesario para mantener los datos actualizados.

En conclusión, la instalación de sistemas ERP-CRM es un proceso complejo pero fundamental para la gestión empresarial moderna. Requiere una comprensión profunda de las necesidades específicas de la empresa, habilidades técnicas sólidas y una atención meticulosa a los detalles. A través del análisis inicial, selección de módulos, configuración del sistema, consultas necesarias, creación de formularios y informes personalizados, paneles de control y integración con otros sistemas, se puede garantizar la correcta instalación y funcionamiento del ERP-CRM, lo que facilitará la gestión operativa y la toma de decisiones estratégicas.

<a id="administracion-y-configuracion"></a>
## Administración y configuración

En el mundo digital actual, la administración y configuración de sistemas empresariales son fundamentales para mantener la eficiencia operativa y la competitividad. En esta carpeta del árbol didáctico, nos sumergimos en los aspectos cruciales de este proceso.

La administración de sistemas empresariales implica el control y gestión de todos los recursos disponibles dentro de una organización, desde hardware hasta software. Este proceso es esencial para asegurar que la tecnología esté al servicio del negocio, facilitando la toma de decisiones informadas y optimizando los procesos internos.

La configuración de sistemas empresariales, por otro lado, se refiere a la personalización y ajuste de las aplicaciones y herramientas utilizadas en el entorno corporativo. Este paso es crucial para adaptar la tecnología al contexto específico de la empresa, asegurando que funcione de manera óptima y satisfactoria.

En esta carpeta, encontramos una serie de lecciones detalladas sobre cómo llevar a cabo estos procesos. Comenzamos con el análisis de los sistemas ERP-CRM actuales, explorando tanto los conceptos básicos como las mejores prácticas en uso. Este conocimiento es fundamental para entender la complejidad y la importancia de estas herramientas en la gestión empresarial moderna.

Continuamos con una explicación profunda sobre cómo instalar y configurar sistemas ERP-CRM, pasando por los diferentes tipos de instalación y los módulos disponibles. Esta información es esencial para aquellos que desean implementar estos sistemas en su organización, proporcionándoles las herramientas necesarias para llevar a cabo el proceso con éxito.

La carpeta también aborda la organización y consulta de la información dentro de estos sistemas. Aprender cómo definir campos adecuados, realizar consultas eficientes y generar informes relevantes es crucial para aprovechar al máximo los beneficios que ofrecen los ERP-CRM. Esta habilidad permite a las empresas tomar decisiones basadas en datos precisos y actualizados.

Además, se explora el proceso de implantación de sistemas ERP-CRM en una empresa. Este tema incluye la selección de módulos adecuados, la adaptación de tablas y vistas existentes, y la creación de formularios e informes personalizados. La capacidad para llevar a cabo este proceso con eficiencia es fundamental para el éxito de cualquier implementación empresarial.

Finalmente, la carpeta aborda el desarrollo de componentes dentro de los sistemas ERP-CRM. Aprender cómo insertar, modificar y eliminar datos en los objetos, así como realizar operaciones de consulta avanzadas, es crucial para mantener la integridad y actualidad de la información. Esta habilidad permite a las empresas mantenerse al día con los cambios rápidos del mercado y adaptarse de manera eficiente.

En resumen, esta carpeta del árbol didáctico proporciona una visión completa y detallada de cómo administrar y configurar sistemas empresariales. Desde la comprensión básica hasta las habilidades avanzadas necesarias para llevar a cabo estos procesos con éxito, ofrece un enfoque práctico y sistemático que es valioso tanto para profesionales experimentados como para aquellos que están comenzando su camino en el mundo de la gestión empresarial digital.

<a id="integracion-de-modulos"></a>
## Integración de módulos

La integración de módulos es una técnica fundamental en la gestión empresarial moderna, permitiendo a las organizaciones combinar diferentes sistemas y herramientas para crear soluciones más completas y eficientes. Este proceso implica la configuración y sincronización de componentes individuales, cada uno con sus propias funcionalidades específicas, para formar un sistema integral que respalde los procesos comerciales.

El primer paso en la integración de módulos es la selección adecuada de los sistemas a utilizar. Cada organización tiene necesidades distintas y requisitos específicos, por lo que es crucial identificar cuáles módulos son necesarios para cubrir todas las áreas clave del negocio. Esto puede implicar el análisis de procesos existentes, la evaluación de requerimientos funcionales y la búsqueda de soluciones que ofrezcan una buena relación calidad-precio.

Una vez seleccionados los módulos, se procede a su instalación. Esta fase puede variar según el tipo de sistema y las herramientas utilizadas, pero generalmente implica la configuración de parámetros, la creación de tablas y vistas, y la definición de roles y privilegios para los usuarios. Es importante tener en cuenta que cada módulo puede requerir una configuración específica para funcionar correctamente dentro del sistema global.

La integración de módulos no se limita a la instalación inicial; también es crucial considerar el proceso de actualización y mantenimiento. Los sistemas empresariales evolucionan con el tiempo, y por lo tanto, los módulos deben ser actualizados para mantener su relevancia y eficiencia. Además, es necesario realizar pruebas periódicas para asegurar que todos los componentes funcionen correctamente juntos.

La integración de módulos también requiere la creación de interfaces de comunicación entre ellos. Estas interfaces permiten que los sistemas se interconecten y compartan información de manera eficiente. La elección del tipo de interfaz dependerá del sistema utilizado, pero generalmente puede ser a través de APIs (Interfaces de Programación de Aplicaciones), protocolos específicos o incluso bases de datos comunes.

Es importante también considerar la seguridad en el proceso de integración de módulos. Cada sistema tiene sus propias medidas de seguridad, y es crucial asegurarse de que estas se integren adecuadamente para proteger los datos sensibles de la organización. Esto puede implicar la implementación de políticas de acceso controlados, la configuración de firewalls y la realización de pruebas de penetración.

La integración de módulos no es un proceso lineal; a menudo implica iteraciones y ajustes. Es común que los sistemas iniciales presenten problemas o limitaciones que requieran correcciones y mejoras. Por lo tanto, es importante tener un enfoque flexible y adaptativo durante este proceso.

Finalmente, la integración de módulos debe ser documentada adecuadamente. La documentación no solo incluye instrucciones sobre cómo instalar y configurar los sistemas, sino también detalles técnicos sobre las interfaces de comunicación y las políticas de seguridad implementadas. Esta documentación es crucial para el mantenimiento futuro del sistema y para la formación de nuevos usuarios.

En resumen, la integración de módulos es un proceso complejo pero fundamental en la gestión empresarial moderna. Requiere una planificación cuidadosa, una instalación correcta, un mantenimiento activo y una documentación precisa. Al seguir estos pasos, las organizaciones pueden crear sistemas empresariales más eficientes y adaptados a sus necesidades específicas.

<a id="mecanismos-de-acceso-seguro-a-la-informacion-roles-y-privilegios"></a>
## Mecanismos de acceso seguro a la información. Roles y privilegios

En el mundo digital actual, la seguridad de la información es una prioridad absoluta. Los sistemas de gestión empresarial (ERP-CRM) son herramientas cruciales que almacenan y procesan datos confidenciales, por lo que garantizar su acceso seguro es fundamental. En esta subunidad didáctica, exploraremos los mecanismos de acceso seguro a la información en estos sistemas, así como el concepto de roles y privilegios.

El primer aspecto crucial es entender cómo se implementan los mecanismos de acceso seguro en un sistema ERP-CRM. Estos sistemas utilizan una combinación de autenticación y autorización para controlar quién puede acceder a qué información y qué acciones pueden realizar. La autenticación verifica la identidad del usuario, mientras que la autorización determina los permisos específicos que ese usuario tiene dentro del sistema.

Los roles son conjuntos predefinidos de privilegios que se asignan a grupos de usuarios según su rol en la organización. Por ejemplo, un administrador general tendrá acceso completo y control sobre todo el sistema, mientras que un vendedor solo podrá acceder a información relacionada con las ventas. Este enfoque basado en roles facilita la gestión de privilegios y minimiza los riesgos asociados con el acceso no autorizado.

La implementación de estos mecanismos requiere una buena planificación y configuración. Es crucial establecer políticas claras sobre quién puede acceder a qué información y cuáles son las acciones permitidas. Además, es importante realizar pruebas de penetración periódicas para identificar vulnerabilidades y asegurarse de que los sistemas están protegidos contra amenazas externas.

La gestión de privilegios también implica el monitoreo constante del acceso a la información. Los sistemas ERP-CRM deben estar equipados con herramientas de auditoría que registren todas las acciones realizadas por los usuarios, lo que facilita el seguimiento y la detección de actividades sospechosas.

Además de los roles y privilegios, es fundamental considerar la seguridad física del sistema. El acceso a los servidores y dispositivos donde se almacenan los datos debe estar controlado mediante protocolos de seguridad adecuados, como el uso de contraseñas fuertes, autenticación multifactor y políticas de acceso limitadas.

La educación continua es otra clave para mantener la seguridad en sistemas ERP-CRM. Los usuarios deben recibir formación regular sobre mejores prácticas de seguridad y cómo identificar amenazas potenciales. Esto incluye el conocimiento de cómo crear contraseñas seguras, cómo manejar correctamente los datos sensibles y cómo reportar cualquier sospecha de actividad inusual.

En conclusión, garantizar el acceso seguro a la información en sistemas ERP-CRM es una tarea compleja que requiere un enfoque integral. Desde la planificación inicial hasta la gestión continua del acceso y la formación de los usuarios, cada paso debe ser cuidadosamente considerado para proteger contra amenazas potenciales y garantizar la confidencialidad y integridad de los datos empresariales.

<a id="elaboracion-de-informes"></a>
## Elaboración de informes

La elaboración de informes es una habilidad fundamental en el ámbito empresarial, permitiendo a las organizaciones comunicar eficazmente sus procesos, resultados y decisiones estratégicas. En esta subunidad didáctica, nos adentramos en los aspectos técnicos y prácticos de la creación de informes dentro de sistemas de gestión empresarial.

Comenzamos por entender el concepto de informe incrustado y no incrustado en la aplicación. Los informes incrustados son aquellos que se generan directamente dentro del software, mientras que los no incrustados requieren una herramienta gráfica externa para su creación. Cada uno tiene sus ventajas: los informes incrustados ofrecen un acceso rápido y directo a la información necesaria, mientras que los no incrustados permiten una mayor flexibilidad en el diseño y presentación.

Herramientas gráficas integradas en el IDE y externas al mismo son fundamentales para la creación de informes. Estas herramientas proporcionan un entorno visual intuitivo donde se pueden diseñar, editar y previsualizar los informes. El uso de estas herramientas facilita la creación de estructuras complejas y gráficos atractivos, adaptados a las necesidades específicas del negocio.

La estructura general de un informe incluye varias secciones esenciales: encabezado, cuerpo y pie de página. Cada sección desempeña un papel crucial en la presentación de los datos de manera coherente y profesional. El filtrado de datos es otro aspecto importante, permitiendo a los usuarios seleccionar información específica según criterios definidos, lo que hace que los informes sean más relevantes y útiles.

La numeración de líneas, recuentos y totales es una técnica valiosa para resaltar patrones y tendencias en los datos. Gráficos son otro elemento clave, proporcionando una representación visual de la información que puede ser mucho más efectiva que los números brutos. Librerías para generación de informes ofrecen clases, métodos y atributos específicos para crear gráficos de diversos tipos, desde simples barras hasta complejos diagramas de flujo.

La conexión con las fuentes de datos es esencial para alimentar los informes con información actualizada y precisa. Ejecutar consultas en la base de datos permite obtener los datos necesarios de manera eficiente. La integración de estos procesos en el ciclo de vida del desarrollo de software asegura que los informes sean siempre relevantes y precisos.

La documentación de aplicaciones es un aspecto no menos importante, ya que facilita el mantenimiento y la comprensión del sistema por parte de otros profesionales. Ficheros de ayuda en formatos como PDF o HTML ofrecen una guía detallada sobre cómo utilizar los informes y las funcionalidades asociadas.

La distribución de aplicaciones es otro desafío, pero también una oportunidad para mejorar la accesibilidad y eficiencia del sistema. Herramientas para crear paquetes de instalación facilitan el proceso de distribución, permitiendo a las organizaciones compartir sus sistemas con otros departamentos o clientes sin complicaciones.

La realización de pruebas es un paso crucial en el ciclo de vida del desarrollo de software, asegurando que los informes cumplan con los requisitos y funcionen correctamente. Pruebas manuales y automáticas permiten identificar errores y mejorar la calidad final del sistema.

En conclusión, la elaboración de informes es una tarea compleja pero fundamental en sistemas de gestión empresarial. A través de esta subunidad didáctica, hemos explorado los diversos aspectos técnicos y prácticos que intervienen en el proceso de creación de informes, desde su diseño hasta su distribución y mantenimiento. Cada concepto y técnica abordada es crucial para garantizar la eficacia y utilidad de los informes en el contexto empresarial.

<a id="exportacion-de-informacion"></a>
## Exportación de información

La exportación de información es una tarea fundamental en los sistemas de gestión empresarial (ERP-CRM), ya que permite la comunicación eficiente entre diferentes partes del negocio y con terceros. Este proceso implica el traslado de datos desde el sistema ERP-CRM a otros formatos o sistemas, lo cual puede ser necesario para diversas razones como la integración con otras aplicaciones, la generación de informes personalizados o la exportación de datos para análisis externos.

La exportación de información en un ERP-CRM se realiza mediante diversos métodos y herramientas. Algunos de los más comunes incluyen el uso de interfaces gráficas de usuario (GUI) que permiten seleccionar y exportar datos directamente desde el sistema, la creación de informes personalizados utilizando lenguajes de consulta como SQL o el uso de APIs para automatizar el proceso.

El proceso de exportación generalmente comienza con la selección de los datos que se desean exportar. Esto puede implicar la definición de criterios de búsqueda específicos, como fechas, tipos de documentos o estados de procesos. Una vez seleccionados los datos, estos son exportados a un formato específico, como CSV, Excel, PDF o XML, dependiendo de las necesidades del destinatario y el sistema que recibe la información.

Es importante destacar que durante el proceso de exportación, se deben considerar aspectos como la integridad de los datos, la seguridad y la privacidad. Por lo tanto, es necesario implementar medidas para garantizar que los datos exportados no contengan información sensible y que su transmisión sea segura.

Además, en muchos casos, el ERP-CRM proporciona herramientas adicionales para facilitar la exportación de información. Estas pueden incluir la posibilidad de generar informes predefinidos, la exportación automática periódica de datos o la creación de plantillas de documentos personalizados.

La exportación de información también puede implicar la transformación de los datos en un formato compatible con el sistema receptor. Esto puede requerir la realización de ajustes en la estructura y contenido de los datos, lo cual debe ser realizado con cuidado para mantener la precisión y la integridad de la información.

En conclusión, la exportación de información es una tarea compleja pero crucial en los sistemas de gestión empresarial. A través del uso adecuado de herramientas y técnicas, se puede facilitar el traslado de datos entre diferentes partes del negocio y con terceros, lo cual mejora la eficiencia operativa y permite la toma de decisiones basada en información actualizada y precisa.

<a id="elaboracion-de-documentacion"></a>
## Elaboración de documentación

La elaboración de documentación es una fase crucial en el desarrollo de sistemas empresariales, ya que proporciona la base para su explotación y mantenimiento. Este proceso implica la creación de materiales que faciliten la comprensión y uso del sistema por parte de los usuarios finales y los equipos técnicos.

En primer lugar, es fundamental entender que la documentación no se trata solo de describir cómo funciona el sistema, sino también de proporcionar instrucciones detalladas sobre su instalación, configuración y operación. Esto incluye guías paso a paso, tutoriales y manuales de usuario, todos los cuales deben ser accesibles y fáciles de seguir.

La documentación debe abordar diversos aspectos del sistema, desde la arquitectura general hasta las funcionalidades específicas. Es importante destacar que una buena documentación no solo informa sobre lo qué hace el sistema, sino también cómo se relacionan diferentes componentes entre sí y cómo interactúan con los usuarios.

Además de la documentación técnica, es crucial incluir información sobre la seguridad del sistema. Esto implica explicar las políticas de acceso, los roles y privilegios asignados a los usuarios, así como las medidas preventivas contra el robo o daño de la información. La documentación debe ser actualizada regularmente para reflejar cualquier cambio en las políticas o procedimientos.

La elaboración de documentación también debe considerar aspectos prácticos como la localización y organización del contenido. Es importante que los documentos estén bien estructurados y accesibles, facilitando su búsqueda y consulta por parte de los usuarios. La utilización de un sistema de gestión de versiones puede ser útil para mantener una historial de cambios en la documentación.

En el contexto empresarial, la documentación no solo es una herramienta interna, sino también una forma de comunicación con clientes y proveedores. Por lo tanto, es importante que sea clara, precisa y profesional, adaptándose a las necesidades específicas del público al que se dirige.

La documentación debe ser un recurso continuamente actualizado y revisado. Esto implica no solo la corrección de errores o omisiones, sino también el incorporación de nuevas funcionalidades y cambios en los procesos operativos. La colaboración entre equipos técnicos y de soporte es clave para mantener la documentación relevante y útil.

En conclusión, la elaboración de documentación es un proceso integral en el desarrollo de sistemas empresariales. Es una herramienta fundamental que facilita la explotación del sistema, mejora la eficiencia operativa y asegura la seguridad de la información. Una buena documentación no solo informa sobre cómo funciona el sistema, sino también proporciona las herramientas necesarias para su correcto uso y mantenimiento, contribuyendo así al éxito continuo del proyecto empresarial.


<a id="envio-de-emails"></a>
# Envio de emails

<a id="formateo-inicial"></a>
## Formateo inicial

### Introduccion

```markdown
Los clientes de correo electrónico soportan HTML y CSS
Pero - no soportan la mayor parte de las características modernas

Por ejemplo, todo se tiene que hacer con tablas

Nada ni de grid, ni de flexbox, ni nada similar

La maquetación de email, tiene que hacerse "a la antigua"
Hace décadas los emails se maquetaban con tablas, creando tablas y subtablas
```

### tabla de inicio

```html
<!doctype html>
<html>
  <head>
  </head>
  <body>
    <table border=1>
      <tr>
        <td>Izquierda</td>
        <td>Centro</td>
        <td>Derecha</td>
      </tr>
    </table>
  </body>
</html>
```

### anchura de las celdas

```html
<!doctype html>
<html>
  <head>
  </head>
  <body>
    <table border=1 width=100%>
      <tr>
        <td>Izquierda</td>
        <td width=400px>Centro</td>
        <td>Derecha</td>
      </tr>
    </table>
  </body>
</html>
```

### subtabla

```html
<!doctype html>
<html>
  <head>
  </head>
  <body>
    <table border=1 width=100%>
      <tr>
        <td>Izquierda</td>
        <td width=400px>
          <table border=1 width=100%>
            <tr>
              <td>Logo</td>
            </tr>
            <tr>
              <td>Destacado</td>
            </tr>
            <tr>
              <td>Banner</td>
            </tr>
            <tr>
              <td>Razones</td>
            </tr>
            <tr>
              <td>Pie de pagina</td>
            </tr>
          </table>
        </td>
        <td>Derecha</td>
      </tr>
    </table>
  </body>
</html>
```

### imagen corporativa

```html
<!doctype html>
<html>
  <head>
  </head>
  <body>
    <table border=1 width=100% style="font-family:sans-serif;">
      <tr>
        <td>Izquierda</td>
        <td width=400px>
          <table border=1 width=100%>
            <tr style="background:indigo;color:white;">
              <td>
                <table width=100% border=1>
                  <tr>
                    <td style="text-align:right;">
                      <img src="
              https://static.jocarsa.com/logos/jocarsa%20%7C%20White.svg" style="width:100px;">
                    </td>
                    <td>
                      <h1 style="margin:0px;">JOCARSA</h1>
                      <h2 style="font-size:12px;margin:0px;">Soluciones de software empresarial</h2>
                    </td>
                  </tr>
                </table>
              
              </td>
            </tr>
            <tr>
              <td>Destacado</td>
            </tr>
            <tr>
              <td>Banner</td>
            </tr>
            <tr>
              <td>Razones</td>
            </tr>
            <tr>
              <td>Pie de pagina</td>
            </tr>
          </table>
        </td>
        <td>Derecha</td>
      </tr>
    </table>
  </body>
</html>
```

### creamos el destacado

```html
<!doctype html>
<html>
  <head>
  </head>
  <body>
    <table border=1 width=100% style="font-family:sans-serif;">
      <tr>
        <td>Izquierda</td>
        <td width=400px>
          <table border=1 width=100%>
            <tr style="background:indigo;color:white;">
              <td>
                <table width=100% border=1>
                  <tr>
                    <td style="text-align:right;">
                      <img src="
              https://static.jocarsa.com/logos/jocarsa%20%7C%20White.svg" style="width:100px;">
                    </td>
                    <td>
                      <h1 style="margin:0px;">JOCARSA</h1>
                      <h2 style="font-size:12px;margin:0px;">Soluciones de software empresarial</h2>
                    </td>
                  </tr>
                </table>
              
              </td>
            </tr>
            <tr>
              <td style="text-align:center;">
                <br>
                <br>
                <h4 style="text-align:center;margin:0px;">Slogan del destacado</h4>
                <h3 style="text-align:center;margin:0px;">Mensaje principal</h3>
                <p style="text-align:justify;margin:10px;font-size:10px;">Texto atractivo y que sea comercial. Texto atractivo y que sea comercial. Texto atractivo y que sea comercial. Texto atractivo y que sea comercial. </p>
                <button  style="text-align:center;margin:0px;margin:auto;">Saber más</button>
                <br>
                <br>
                <br>
              </td>
            </tr>
            <tr>
              <td>Banner</td>
            </tr>
            <tr>
              <td>Razones</td>
            </tr>
            <tr>
              <td>Pie de pagina</td>
            </tr>
          </table>
        </td>
        <td>Derecha</td>
      </tr>
    </table>
  </body>
</html>
```

### insercion de imagen

```html
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <table border=0 width=100% style="font-family:sans-serif;">
      <tr>
        <td></td>
        <td width=400px>
          <table border=0 width=100%>
            <tr style="background:indigo;color:white;">
              <td>
                <table width=100% border=0>
                  <tr>
                    <td style="text-align:right;">
                      <img src="
              https://static.jocarsa.com/logos/jocarsa%20%7C%20White.svg" style="width:100px;">
                    </td>
                    <td>
                      <h1 style="margin:0px;">JOCARSA</h1>
                      <h2 style="font-size:12px;margin:0px;">Soluciones de software empresarial</h2>
                    </td>
                  </tr>
                </table>
              
              </td>
            </tr>
            <tr>
              <td style="text-align:center;">
                <br>
                <br>
                <h4 style="text-align:center;margin:0px;">Slogan del destacado</h4>
                <h3 style="text-align:center;margin:0px;">Mensaje principal</h3>
                <p style="text-align:justify;margin:10px;font-size:10px;">Texto atractivo y que sea comercial. Texto atractivo y que sea comercial. Texto atractivo y que sea comercial. Texto atractivo y que sea comercial. </p>
                <button  style="text-align:center;margin:0px;margin:auto;">Saber más</button>
                <br>
                <br>
                <br>
              </td>
            </tr>
            <tr>
              <td>
                <img src="josevicente.jpg">
              </td>
            </tr>
            <tr>
              <td>Razones</td>
            </tr>
            <tr>
              <td>Pie de pagina</td>
            </tr>
          </table>
        </td>
        <td></td>
      </tr>
    </table>
  </body>
</html>
```

### destacados

```html
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <table border=0 width=100% style="font-family:sans-serif;">
      <tr>
        <td></td>
        <td width=400px>
          <table border=0 width=100%>
            <tr style="background:indigo;color:white;">
              <td>
                <table width=100% border=0>
                  <tr>
                    <td style="text-align:right;">
                      <img width=100px src="data:image/png;base64,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" alt="Uploaded Image" />
                    </td>
                    <td>
                      <h1 style="margin:0px;">JOCARSA</h1>
                      <h2 style="font-size:12px;margin:0px;">Soluciones de software empresarial</h2>
                    </td>
                  </tr>
                </table>
              
              </td>
            </tr>
            <tr>
              <td style="text-align:center;">
                <br>
                <br>
                <h4 style="text-align:center;margin:0px;">Slogan del destacado</h4>
                <h3 style="text-align:center;margin:0px;">Mensaje principal</h3>
                <p style="text-align:justify;margin:10px;font-size:10px;">Texto atractivo y que sea comercial. Texto atractivo y que sea comercial. Texto atractivo y que sea comercial. Texto atractivo y que sea comercial. </p>
                <button  style="text-align:center;margin:0px;margin:auto;">Saber más</button>
                <br>
                <br>
                <br>
              </td>
            </tr>
            <tr>
              <td>
                <img width=100% src="data:image/jpeg;base64,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" alt="Uploaded Image" />
              </td>
            </tr>
            <tr>
              <td>
                <table width=100%>
                  <tr>
                    <td width=50%>
                      <img src="destacado.jpg" width=100%>
                    </td>
                    <td width=50% style="font-size:10px;text-align:justify;padding-left:10px;">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </td>
                  </tr>
                  <tr>
                    <td width=50%>
                      <img src="destacado.jpg" width=100%>
                    </td>
                    <td width=50% style="font-size:10px;text-align:justify;padding-left:10px;">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </td>
                  </tr>
                  <tr>
                    <td width=50%>
                      <img src="destacado.jpg" width=100%>
                    </td>
                    <td width=50% style="font-size:10px;text-align:justify;padding-left:10px;">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>Pie de pagina</td>
            </tr>
          </table>
        </td>
        <td></td>
      </tr>
    </table>
  </body>
</html>
```

### ampliamos un poco

```html
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <table border=0 width=100% style="font-family:sans-serif;">
      <tr>
        <td></td>
        <td width=600px>
          <table border=0 width=100%>
            <tr style="background:indigo;color:white;">
              <td>
                <table width=100% border=0>
                  <tr>
                    <td style="text-align:right;">
                      <img width=100px src="data:image/png;base64,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" alt="Uploaded Image" />
                    </td>
                    <td>
                      <h1 style="margin:0px;">JOCARSA</h1>
                      <h2 style="font-size:12px;margin:0px;">Soluciones de software empresarial</h2>
                    </td>
                  </tr>
                </table>
              
              </td>
            </tr>
            <tr>
              <td style="text-align:center;">
                <br>
                <br>
                <h4 style="text-align:center;margin:0px;">Slogan del destacado</h4>
                <h3 style="text-align:center;margin:0px;">Mensaje principal</h3>
                <p style="text-align:justify;margin:10px;font-size:10px;">Texto atractivo y que sea comercial. Texto atractivo y que sea comercial. Texto atractivo y que sea comercial. Texto atractivo y que sea comercial. </p>
                <button  style="text-align:center;margin:0px;margin:auto;">Saber más</button>
                <br>
                <br>
                <br>
              </td>
            </tr>
            <tr>
              <td>
                <img width=100% src="data:image/jpeg;base64,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" alt="Uploaded Image" />
              </td>
            </tr>
            <tr>
              <td>
                <table width=100%>
                  <tr>
                    <td width=50%>
                      <img src="destacado.jpg" width=100%>
                    </td>
                    <td width=50% style="font-size:10px;text-align:justify;padding-left:10px;">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </td>
                  </tr>
                  <tr>
                    <td width=50%>
                      <img src="destacado.jpg" width=100%>
                    </td>
                    <td width=50% style="font-size:10px;text-align:justify;padding-left:10px;">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </td>
                  </tr>
                  <tr>
                    <td width=50%>
                      <img src="destacado.jpg" width=100%>
                    </td>
                    <td width=50% style="font-size:10px;text-align:justify;padding-left:10px;">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>Pie de pagina</td>
            </tr>
          </table>
        </td>
        <td></td>
      </tr>
    </table>
  </body>
</html>
```

### pie de pagina normativo

```html
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <table border=0 width=100% style="font-family:sans-serif;">
      <tr>
        <td></td>
        <td width=600px>
          <table border=0 width=100%>
            <tr style="background:indigo;color:white;">
              <td>
                <table width=100% border=0>
                  <tr>
                    <td style="text-align:right;">
                      <img width=100px src="data:image/png;base64,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" alt="Uploaded Image" />
                    </td>
                    <td>
                      <h1 style="margin:0px;">JOCARSA</h1>
                      <h2 style="font-size:12px;margin:0px;">Soluciones de software empresarial</h2>
                    </td>
                  </tr>
                </table>
              
              </td>
            </tr>
            <tr>
              <td style="text-align:center;">
                <br>
                <br>
                <h4 style="text-align:center;margin:0px;">Slogan del destacado</h4>
                <h3 style="text-align:center;margin:0px;">Mensaje principal</h3>
                <p style="text-align:justify;margin:10px;font-size:10px;">Texto atractivo y que sea comercial. Texto atractivo y que sea comercial. Texto atractivo y que sea comercial. Texto atractivo y que sea comercial. </p>
                <button  style="text-align:center;margin:0px;margin:auto;">Saber más</button>
                <br>
                <br>
                <br>
              </td>
            </tr>
            <tr>
              <td>
                <img width=100% src="data:image/jpeg;base64,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" alt="Uploaded Image" />
              </td>
            </tr>
            <tr>
              <td>
                <table width=100%>
                  <tr>
                    <td width=50%>
                      <img src="destacado.jpg" width=100%>
                    </td>
                    <td width=50% style="font-size:10px;text-align:justify;padding-left:10px;">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </td>
                  </tr>
                  <tr>
                    <td width=50%>
                      <img src="destacado.jpg" width=100%>
                    </td>
                    <td width=50% style="font-size:10px;text-align:justify;padding-left:10px;">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </td>
                  </tr>
                  <tr>
                    <td width=50%>
                      <img src="destacado.jpg" width=100%>
                    </td>
                    <td width=50% style="font-size:10px;text-align:justify;padding-left:10px;">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td style="text-align:center;font-size:10px;color:grey;">
                Protección de datos:<br>
Recibe esta comunicación porque forma parte de nuestra base de datos de contactos comerciales. El responsable del tratamiento es [Nombre de la empresa], con domicilio en [Dirección]. Tratamos sus datos con la finalidad de enviarle información comercial relacionada con nuestros productos y servicios, amparados en su consentimiento o en el interés legítimo aplicable.<br>
<br>
Usted puede ejercer en cualquier momento sus derechos de acceso, rectificación, supresión, oposición, limitación del tratamiento y portabilidad enviando una solicitud a [correo de contacto / DPO]. Si no desea seguir recibiendo comunicaciones comerciales, puede solicitar la baja respondiendo a este mismo correo o escribiendo a [correo de bajas].<br>
<br>
Sus datos no se cederán a terceros salvo obligación legal. Para más información consulte nuestra política de privacidad en [URL].<br>
              </td>
            </tr>
          </table>
        </td>
        <td></td>
      </tr>
    </table>
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


<a id="carpeta-sin-titulo"></a>
# Carpeta sin título
