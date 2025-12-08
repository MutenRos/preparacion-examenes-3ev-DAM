# Bases de datos

**Author:** Jose Vicente Carratala Sanchis

## Table of contents

- [Almacenamiento de la información](#almacenamiento-de-la-informacion)
  - [Ficheros (planos, indexados, acceso directo, entre otros)](#ficheros-planos-indexados-acceso-directo-entre-otros)
  - [Bases de datos. Conceptos, usos y tipos según el modelo de datos, la ubicación de la información](#bases-de-datos-conceptos-usos-y-tipos-segun-el-modelo-de-datos-la-ubicacion-de-la-informacion)
  - [Sistemas gestores de base de datos Funciones, componentes y tipos](#sistemas-gestores-de-base-de-datos-funciones-componentes-y-tipos)
  - [Bases de datos centralizadas y bases de datos distribuidas. Técnicas de fragmentación](#bases-de-datos-centralizadas-y-bases-de-datos-distribuidas-tecnicas-de-fragmentacion)
  - [Legislación sobre protección de datos](#legislacion-sobre-proteccion-de-datos)
  - [Big Data introducción, análisis de datos, inteligencia de negocios](#big-data-introduccion-analisis-de-datos-inteligencia-de-negocios)
  - [Ejercicio de final de unidad](#ejercicio-de-final-de-unidad)
- [Bases de datos relacionales](#bases-de-datos-relacionales)
  - [Modelo de datos](#modelo-de-datos)
  - [Terminología del modelo relacional](#terminologia-del-modelo-relacional)
  - [Tipos de datos](#tipos-de-datos)
  - [Claves primarias](#claves-primarias)
  - [Restricciones de validación](#restricciones-de-validacion)
  - [Índices. Características](#indices-caracteristicas)
  - [El valor NULL](#el-valor-null)
  - [Claves ajenas](#claves-ajenas)
  - [Vistas](#vistas)
  - [Usuarios. Privilegios](#usuarios-privilegios)
  - [Lenguaje de descripción de datos (DDL)](#lenguaje-de-descripcion-de-datos-ddl)
  - [Lenguaje de control de datos (DCL)](#lenguaje-de-control-de-datos-dcl)
  - [Ejercicio de final de unidad](#ejercicio-de-final-de-unidad-1)
- [Realización de consultas](#realizacion-de-consultas)
  - [Proyección, selección y ordenación de registros](#proyeccion-seleccion-y-ordenacion-de-registros)
  - [Operadores. Operadores de comparación. Operadores lógicos](#operadores-operadores-de-comparacion-operadores-logicos)
  - [Consultas de resumen](#consultas-de-resumen)
  - [Agrupamiento de registros](#agrupamiento-de-registros)
  - [Composiciones internas](#composiciones-internas)
  - [Composiciones externas](#composiciones-externas)
  - [Subconsultas](#subconsultas)
  - [Combinación de múltiples selecciones](#combinacion-de-multiples-selecciones)
  - [Optimización de consultas](#optimizacion-de-consultas)
  - [Ejercicio de final de unidad](#ejercicio-de-final-de-unidad-2)
- [Tratamiento de datos](#tratamiento-de-datos)
  - [Inserción, borrado y modificación de registros](#insercion-borrado-y-modificacion-de-registros)
  - [Integridad referencial](#integridad-referencial)
  - [Subconsultas y composiciones en órdenes de edición](#subconsultas-y-composiciones-en-ordenes-de-edicion)
  - [Transacciones](#transacciones)
  - [Políticas de bloqueo. Concurrencia](#politicas-de-bloqueo-concurrencia)
  - [Simulacro examen](#simulacro-examen)
  - [Simulacro de examen 2](#simulacro-de-examen-2)
  - [Ejercicio de final de unidad](#ejercicio-de-final-de-unidad-3)
  - [Examen final](#examen-final)
- [Programación de bases de datos](#programacion-de-bases-de-datos)
  - [Introducción. Lenguaje de programación](#introduccion-lenguaje-de-programacion)
  - [Variables del sistema y variables de usuario](#variables-del-sistema-y-variables-de-usuario)
  - [Funciones](#funciones)
  - [Estructuras de control de flujo](#estructuras-de-control-de-flujo)
  - [Procedimientos almacenados. Funciones de usuario](#procedimientos-almacenados-funciones-de-usuario)
  - [Eventos y disparadores](#eventos-y-disparadores)
  - [Excepciones](#excepciones)
  - [Cursores](#cursores)
- [Interpretación de Diagramas EntidadRelación](#interpretacion-de-diagramas-entidadrelacion)
  - [El modelo ER. Entidades y relaciones. Cardinalidades. Debilidad](#el-modelo-er-entidades-y-relaciones-cardinalidades-debilidad)
  - [El modelo ER ampliado. Generalización y especialización. Agregación](#el-modelo-er-ampliado-generalizacion-y-especializacion-agregacion)
  - [Paso del diagrama ER al modelo relacional](#paso-del-diagrama-er-al-modelo-relacional)
  - [Restricciones semánticas del modelo relacional](#restricciones-semanticas-del-modelo-relacional)
  - [Normalización de modelos relacionales](#normalizacion-de-modelos-relacionales)
  - [Ejercicios](#ejercicios)
  - [Criterios de evaluación](#criterios-de-evaluacion)
- [Uso de bases de datos no relacionales](#uso-de-bases-de-datos-no-relacionales)
  - [Características de las bases de datos no relacionales](#caracteristicas-de-las-bases-de-datos-no-relacionales)
  - [Tipos de bases de datos no relacionales](#tipos-de-bases-de-datos-no-relacionales)
  - [Elementos de las bases de datos no relacionales](#elementos-de-las-bases-de-datos-no-relacionales)
  - [Sistemas gestores de bases de datos no relacionales](#sistemas-gestores-de-bases-de-datos-no-relacionales)
  - [Herramientas de los sistemas gestores de bases de datos no relacionales para la gestión de la información almacenada](#herramientas-de-los-sistemas-gestores-de-bases-de-datos-no-relacionales-para-la-gestion-de-la-informacion-almacenada)
- [Actividad libre de final de evaluación - La milla extra](#actividad-libre-de-final-de-evaluacion-la-milla-extra)
  - [La Milla Extra - Primera evaluación](#la-milla-extra-primera-evaluacion)

---

<a id="almacenamiento-de-la-informacion"></a>
# Almacenamiento de la información

<a id="ficheros-planos-indexados-acceso-directo-entre-otros"></a>
## Ficheros (planos, indexados, acceso directo, entre otros)

En el vasto y complejo mundo de la informática, los ficheros desempeñan un papel fundamental como contenedores de datos. Desde los simples archivos planos hasta las estructuras indexadas y los sistemas de acceso directo, cada uno ofrece características únicas que adaptan su uso a diferentes necesidades.

Los ficheros planos son los primeros pasos en el almacenamiento digital de información. Son básicamente conjuntos de caracteres organizados en líneas y columnas, ideal para datos estructurados como tablas o listas. Su simplicidad hace que sean fáciles de crear, leer y escribir, lo que las convierte en una opción popular para aplicaciones de escritorio y pequeños proyectos.

Sin embargo, cuando se trata de grandes volúmenes de datos o necesidades de acceso rápido a cualquier parte del archivo, los ficheros planos pueden presentar limitaciones. Es aquí donde entra el concepto de ficheros indexados. Algunos sistemas operativos utilizan índices para mantener una lista ordenada de las posiciones de los registros dentro del archivo, lo que permite un acceso directo y rápido a cualquier dato sin necesidad de leer todo el contenido.

El acceso directo es otro mecanismo avanzado que mejora significativamente la eficiencia en el manejo de grandes conjuntos de datos. Este método permite saltar a cualquier posición específica dentro del archivo, lo que es ideal para aplicaciones que requieren acceso aleatorio a los datos. Sin embargo, este tipo de acceso también puede llevar a problemas como la fragmentación y la necesidad de reorganizar el archivo periódicamente.

Además de estos métodos tradicionales, existen otras estrategias innovadoras para almacenar y acceder a información digital. Por ejemplo, las bases de datos relacionales utilizan un modelo tabular para organizar los datos, lo que facilita la consulta y el análisis. Aunque esto implica una estructura más compleja, permite realizar operaciones sofisticadas como joins, agrupamientos y consultas de resumen.

En conclusión, la elección del método de almacenamiento depende de las necesidades específicas del proyecto. Desde los ficheros planos hasta los sistemas de acceso directo y las bases de datos relacionales, cada una ofrece ventajas y desventajas que deben ser consideradas cuidadosamente. Comprender estos conceptos es fundamental para cualquier profesional en el campo de la informática, ya que determinará cómo se diseñan y optimizan los sistemas que almacenan y manejan grandes cantidades de datos.

### tipos de archivos

```markdown
Archivos de texto plano (txt):
- Muy cómodos de usar
- No tienen estructura
- Se puede guardar información
- Pero las posibilidades de ordenación no son muy grandes

Archivos estructurados/tabulados (csv):
- Tienen una estructura mínima
- Son más fiables (de hecho muy comunes) para guardar datos
- Por ejemplo el csv es un formato muy común para datos en tablas

Archivos de tipo JSON/XML:
- Guardar datos con complejidad ilimitada
- Muy estandarizados a día de hoy

Formatos ODT (OpenDocument)
- ODT - OpenDocumenT - Documentos tipo Word
- Es un formato abierto para formatos ofimáticos
  - Documentos
  - Hojas de cálculo
  - Presentaciones
```

### archivos de texto plano

```
Hola esto es una prueba y este es un documento
```

### clientes

```
nombre,apellidos,telefono
Juan,Garcia Lopez,5432534
Jorge,Martinez,5432534
Jose,Lopez,523534
```

### clientes

```json
[
  {
    "nombre":"Juan",
    "apellidos":"xxx",
    "telefono":"xxx"
  },
  {
    "nombre":"Jorge",
    "apellidos":"xxx",
    "telefono":"xxx"
  },
  {
    "nombre":"Jaime",
    "apellidos":"xxx",
    "telefono":"xxx"
  },
  {
    "nombre":"Jose",
    "apellidos":"xxx",
    "telefono":"xxx"
  },
]
```

### clientes anidades

```json
[
  {
    "nombre":"Juan",
    "apellidos":"xxx",
    "telefono","xxx"
  },
  {
    "nombre":"Jorge",
    "apellidos":"xxx",
    "telefono","xxx"
  },
  {
    "nombre":"Jaime",
    "apellidos":"xxx",
    "telefono","xxx"
  },
  {
    "nombre":"Jose",
    "apellidos":"xxx",
    "telefono","xxx"
  },
]
```

### clientes anidados

```json
[
  {
    "nombre":"Juan",
    "apellidos":"xxx",
    "telefono":["xxx","yyyy","zzzz"]
  },
  {
    "nombre":"Jorge",
    "apellidos":"xxx",
    "telefono":"xxx"
  },
  {
    "nombre":"Jaime",
    "apellidos":"xxx",
    "telefono":"xxx"
  },
  {
    "nombre":"Jose",
    "apellidos":"xxx",
    "telefono":"xxx"
  },
]
```

### clientes

```xml
<personas>
  <persona>
    <nombre>Juan</nombre>
    <apellidos>xxx</apellidos>
    <telefonos>
      <telefono>xxx</telefono>
      <telefono>yyyy</telefono>
      <telefono>zzzz</telefono>
    </telefonos>
  </persona>
  <persona>
    <nombre>Jorge</nombre>
    <apellidos>xxx</apellidos>
    <telefono>xxx</telefono>
  </persona>
  <persona>
    <nombre>Jaime</nombre>
    <apellidos>xxx</apellidos>
    <telefono>xxx</telefono>
  </persona>
  <persona>
    <nombre>Jose</nombre>
    <apellidos>xxx</apellidos>
    <telefono>xxx</telefono>
  </persona>
</personas>
```

<a id="bases-de-datos-conceptos-usos-y-tipos-segun-el-modelo-de-datos-la-ubicacion-de-la-informacion"></a>
## Bases de datos. Conceptos, usos y tipos según el modelo de datos, la ubicación de la información

En el vasto mundo de la informática, el almacenamiento de la información es una tarea fundamental que requiere comprensión profunda y habilidades técnicas. Las bases de datos son estructuras organizadas que almacenan y gestionan grandes cantidades de datos de manera eficiente. Su concepto básico radica en la organización de los datos en tablas, donde cada fila representa un registro y cada columna una característica específica del mismo.

El uso de las bases de datos es omnipresente en nuestra sociedad digital, desde sistemas empresariales hasta aplicaciones web y dispositivos móviles. Son herramientas indispensables para el almacenamiento, recuperación y análisis de información, facilitando la toma de decisiones informadas y optimizando procesos.

Existen varios tipos de bases de datos según su modelo de datos y ubicación. Los modelos de datos son esquemas que definen cómo se organizarán los datos dentro de una base de datos. El más común es el modelo relacional, basado en tablas con columnas y filas, pero también existen otros como el orientado a objetos y los documentales.

La ubicación de la información en las bases de datos puede variar significativamente. Algunas bases de datos son centralizadas, almacenando toda la información en un solo servidor, mientras que otras pueden ser distribuidas, con partes del conjunto de datos replicadas en múltiples servidores para mejorar el rendimiento y la disponibilidad.

La protección de los datos es otro aspecto crucial en el uso de las bases de datos. Las legislaciones sobre protección de datos, como la General Data Protection Regulation (GDPR) en Europa, impiden que las empresas manejen información personal sin consentimiento explícito del usuario. Es fundamental implementar medidas adecuadas para garantizar la seguridad y privacidad de los datos almacenados.

El análisis de datos es otro uso importante de las bases de datos. Las técnicas de inteligencia de negocios permiten extraer conocimientos valiosos de grandes conjuntos de datos, ayudando a las organizaciones a tomar decisiones estratégicas basadas en datos empíricos.

En resumen, las bases de datos son herramientas poderosas y versátiles que desempeñan un papel crucial en la gestión de información digital. Su comprensión y uso adecuado son fundamentales para cualquier profesional del campo de la informática, ya sea en desarrollo de software, análisis de datos o gestión empresarial.

<a id="sistemas-gestores-de-base-de-datos-funciones-componentes-y-tipos"></a>
## Sistemas gestores de base de datos Funciones, componentes y tipos

Los sistemas gestores de base de datos (SGBDs) son fundamentales para la organización, almacenamiento y recuperación de información en entornos informáticos. Estos sistemas desempeñan un papel crucial en la eficiencia operativa y la seguridad de los datos dentro de cualquier organización o sistema digital.

Los SGBDs ofrecen una amplia gama de funciones que facilitan el acceso, modificación y análisis de datos. Una de las principales funcionalidades es la creación de tablas y vistas, lo que permite estructurar la información de manera lógica y coherente. Además, proporcionan mecanismos para definir restricciones de integridad, garantizando que los datos estén consistentes y precisos.

Los componentes de un SGBD son diversos y complejos. Incluyen el motor de almacenamiento, que gestiona la persistencia física de los datos; el motor de recuperación, responsable del mantenimiento de la coherencia de los datos en caso de fallas; y el motor de procesamiento, que ejecuta las consultas y operaciones sobre los datos. Cada uno de estos componentes trabaja en conjunto para ofrecer una plataforma robusta y eficiente.

Los SGBDs se clasifican en varios tipos según su arquitectura y funcionalidades. Los más conocidos son los SGBDs relacionales, que utilizan un modelo de datos basado en tablas y relaciones entre ellas. Otros tipos incluyen los NoSQL, que no siguen el esquema tradicional de las bases de datos relacionales, y los orientados a objetos, que permiten almacenar y gestionar objetos enteros.

La elección del tipo de SGBD adecuado depende de diversos factores, como la naturaleza de los datos, las necesidades de rendimiento, el tamaño de la base de datos y los requisitos específicos de la aplicación. Por ejemplo, si se requiere un alto nivel de integridad y consistencia en los datos, un SGBD relacional puede ser la mejor opción. En cambio, si se necesita escalabilidad horizontal o manejo eficiente de grandes volúmenes de datos heterogéneos, un sistema NoSQL podría ser más adecuado.

Además de las funcionalidades y tipos, los SGBDs también ofrecen una serie de características que contribuyen a su eficiencia y seguridad. Estas incluyen la capacidad para realizar consultas complejas y optimizadas, el soporte para transacciones ACID (Atomicidad, Consistencia, Aislamiento, Durabilidad), y herramientas avanzadas de gestión de seguridad y control de acceso.

En resumen, los sistemas gestores de base de datos son esenciales en cualquier sistema informático moderno. Ofrecen una combinación de funcionalidades avanzadas, componentes robustos y tipos adaptados a diferentes necesidades, lo que les permite almacendar, recuperar y gestionar eficientemente grandes volúmenes de información. Su correcta elección y uso son cruciales para el éxito operativo y la seguridad de cualquier organización digital.

Una base de datos es un conjunto de archivos o recursos que almacenan la información de una forma estructurada y ordenada.

Pero en ocasiones, se necesita controlar mejor el acceso a esa base de datos

Para ellos están los sistema gestores de bases de datos.

- Protegen el acceso, 
- Crean colas de usuarios para asegurar que no se accede a la información de forma simultánea
- Proporcionan medidas de seguridad adicionales, por ejemplo mediante usuarios y contraseñas
- Proporcionar multitud de opciones para el almacenamiento
- Suelen proporcionar un lenguaje unificado de consulta de la información (suele ser el lenguaje SQL)

SQLite es un formato de bases de datos (con gestor) pequeño pero potente.

Proporcionan una cobertura, una protección que aseguran la salud y la integridad de los datos contenidos

<a id="bases-de-datos-centralizadas-y-bases-de-datos-distribuidas-tecnicas-de-fragmentacion"></a>
## Bases de datos centralizadas y bases de datos distribuidas. Técnicas de fragmentación

En el vasto mundo de la informática, los sistemas de almacenamiento de datos desempeñan un papel crucial, ya sea para pequeñas aplicaciones o para las más complejas. En esta subunidad didáctica, nos adentramos en dos tipos fundamentales de bases de datos: las centralizadas y las distribuidas, así como las técnicas de fragmentación que utilizan estas últimas.

Las bases de datos centralizadas son aquellas donde todos los datos se almacenan en un único servidor. Este modelo es ideal para aplicaciones pequeñas o medianas, ya que facilita la gestión y el acceso a los datos. Sin embargo, su principal desventaja radica en la limitación del rendimiento cuando el volumen de datos aumenta, lo que puede llevar a problemas de congestión.

Por otro lado, las bases de datos distribuidas son sistemas donde los datos se almacenan en varios servidores interconectados. Este modelo ofrece una mayor escalabilidad y capacidad para manejar grandes volúmenes de información, pero también introduce complejidades en la gestión y el mantenimiento del sistema.

La fragmentación es una técnica utilizada en bases de datos distribuidas para mejorar el rendimiento y la eficiencia. Consiste en dividir los datos en partes más pequeñas que se almacenan en diferentes servidores o nodos. Esta estrategia permite que cada servidor maneje un conjunto limitado de datos, lo que reduce la carga y aumenta la velocidad de acceso.

La fragmentación puede realizarse de varias maneras, como por rango (donde los datos se distribuyen según un criterio numérico), por hash (donde los datos se asignan a servidores basándose en una función hash) o por lista (donde los datos se distribuyen según una lista predefinida). Cada método tiene sus ventajas y desventajas, dependiendo de la naturaleza de los datos y las necesidades del sistema.

Es importante destacar que la fragmentación no es una solución panacurra. Su implementación requiere un análisis cuidadoso del diseño del sistema y consideraciones sobre el rendimiento, la consistencia y la replicación de datos. Además, debe tenerse en cuenta que la fragmentación puede complicar ciertas operaciones, como las consultas complejas o los reportes.

En resumen, las bases de datos centralizadas y distribuidas son dos modelos fundamentales para almacenar información digital. La fragmentación es una técnica valiosa para optimizar el rendimiento en sistemas distribuidos, pero su implementación debe ser cuidadosa y considerada dentro del contexto general del sistema. Comprender estos conceptos es crucial para diseñar y gestionar eficientemente bases de datos en entornos modernos.

### Resumen

```markdown
Una base de datos puede estar centralizada en un sistema informático (SI = ordenador / servidor)

Ventaja: Control - Desventaja: Escalabilidad

Un SI tiene una serie de límites - CPU (procesador) - RAM (memoria temporal) - Disco duro (almacén de datos)

Clásica = CPU+RAM+Disco
Hay sistemas de inteligencia artificial que SI guardar la información en GPU+RAMGPU

Que ocurre cuando una base de datos tiene tantos datos que desborda las capacidades del SI?

Tienes dos opciones:
1. O bien añades más recursos al sistema
2. Distribuyes la carga de diferentes SSII (multiples servidores que dan servicio a la misma base de datos)

Fragmentación

Guardar un espejo de la base de datos
Ganamos velocidad de acceso
No ganamos en disco duro

Guardar unos datos en un servidor, y otros datos en otro servidor

Otra forma de fragmentar: Primera mitad de una tabla en un servidor, segunda mitad de la tabla en otro servidor
```

<a id="legislacion-sobre-proteccion-de-datos"></a>
## Legislación sobre protección de datos

La legislación sobre protección de datos es una cota de seguridad vital que regula cómo se maneja la información personal en el ámbito digital. Esta regulación busca proteger los derechos fundamentales de las personas en cuanto a su privacidad y control sobre sus datos, garantizando que estos sean tratados con respeto y transparencia.

En este contexto, es crucial entender que la legislación sobre protección de datos no solo se aplica a empresas o organizaciones, sino también a individuos que recopilan, almacenan o utilizan información personal. Esta regulación busca proteger tanto a los titulares de los datos como a las personas que procesan dicha información.

La legislación sobre protección de datos establece un marco claro para el consentimiento informado, la transparencia en el tratamiento de datos y la responsabilidad del responsable del tratamiento. Estos principios son fundamentales para garantizar que los datos sean utilizados de manera ética y legal, protegiendo así la integridad y la privacidad de las personas.

Además, la legislación sobre protección de datos impone sanciones severas por infracciones, lo que incentiva a las organizaciones a adoptar prácticas seguras y legales en el manejo de los datos personales. Esta normativa busca crear un nivel de confianza entre individuos y organizaciones, asegurando que la información personal sea utilizada de manera responsable y ética.

En resumen, la legislación sobre protección de datos es una herramienta fundamental para garantizar la privacidad y el control sobre los datos personales en el mundo digital. Esta regulación busca proteger tanto a las personas como a las organizaciones, fomentando un uso ético y legal del tratamiento de información personal.

### Referencias de legislacion

```markdown
Ley orgánica de protección de datos de carácter personal - LOPD - 1999
https://www.boe.es/buscar/act.php?id=BOE-A-1999-23750

Sustuida por: LOPDGDD
https://www.boe.es/buscar/act.php?id=BOE-A-2018-16673

RGPD - Reglamento General Protección de Datos (Europeo - por encima de ley española)
https://www.boe.es/doue/2016/119/L00001-00088.pdf

Tratan de los derechos de los ciudadanos (los poseedores de la información), y de los deberes de las empresas o instituciones (que tratan esa información)

Los usuarios tienen derechos de:
-Acceso
-Modificación
-Rectificación
-Eliminación de los datos

Las empresas tienen obligaciones
```

<a id="big-data-introduccion-analisis-de-datos-inteligencia-de-negocios"></a>
## Big Data introducción, análisis de datos, inteligencia de negocios

En el vasto universo de la informática, Big Data se ha convertido en un fenómeno transformador, desafiando nuestras habilidades tradicionales para almacenar, procesar y analizar datos. Este subcampo fascinante nos invita a explorar cómo podemos abordar conjuntos de información extremadamente grandes y complejos, revelando patrones y tendencias que antes eran inaccesibles.

El concepto de Big Data se centra en tres principios fundamentales: volumen, velocidad y variedad. El volumen hace referencia al tamaño enorme de los datos, que a menudo supera las capacidades de almacenamiento convencionales. La velocidad implica la necesidad de procesar estos datos a velocidades increíblemente rápidas para mantenerse relevantes. Por último, la variedad aborda el hecho de que los datos vienen en una amplia gama de formatos y fuentes, desde texto hasta imágenes y videos.

La introducción del Big Data ha llevado a la creación de nuevas tecnologías y métodos, como las bases de datos NoSQL y los sistemas distribuidos. Estas soluciones están diseñadas para manejar el volumen y velocidad de los datos, ofreciendo escalabilidad y flexibilidad que las bases de datos tradicionales no pueden proporcionar.

El análisis de Big Data es un proceso complejo que implica la extracción de conocimientos valiosos a partir de grandes conjuntos de datos. Este proceso puede implicar técnicas estadísticas avanzadas, aprendizaje automático y minería de datos. El objetivo final es identificar patrones y tendencias que pueden ayudar en decisiones estratégicas, mejorar procesos y optimizar recursos.

La inteligencia de negocios es un campo emergente que se centra en la aplicación del análisis de Big Data para mejorar el rendimiento empresarial. Esto puede implicar la creación de informes personalizados, la identificación de oportunidades de mercado, la predicción de tendencias y la optimización de operaciones.

El Big Data no solo es una cuestión técnica; también es un desafío ético y legal. La protección de datos personales y la privacidad son preocupaciones cruciales en el contexto del Big Data. Es importante desarrollar políticas y prácticas que garanticen la seguridad y el uso responsable de los datos.

En conclusión, el Big Data representa una revolución tecnológica que está cambiando la forma en que entendemos y gestionamos la información. A través del análisis de grandes conjuntos de datos, podemos descubrir patrones y tendencias que antes eran inaccesibles, lo que nos permite tomar decisiones más informadas y estratégicas. Este campo es un área de investigación activa y prometedor, con aplicaciones en casi todos los sectores de la economía y la sociedad.

La exploración del Big Data requiere una combinación de conocimientos técnicos, habilidades analíticas y comprensión ética. A medida que continuemos avanzando en este campo, es crucial mantener un equilibrio entre el progreso tecnológico y la protección de los datos y la privacidad de las personas.

### Conceptos iniciales

```markdown
Big Data = Grandes cantidades de datos

Cualquier comportamiento digital se ha podido registrar.

Cualquier registro, especialmente si es masivo, luego se puede analizar.

El análisis de datos consiste en el procesamiento de grandes cantidades de datos para extraer patrones o información de valor.

Big data = una oportunidad y un reto

Oportunidad porque cuantos mas datos tengamos, más información podemos sacar

Es un reto, porque cuantos más datos tengamos, más potencia de proceso se requiere para procesar esos datos, mas tiempo y más inversión se necesita, y más consumo energético está involucrado.

Y también se requieren mejores y más potentes algoritmos para procesar toda esa información.

Para Big data es recomendable usar algoritmos de IA, y para entrenar IA se requieren grandes cantidades de datos.

IA y Big Data van de la mano.

Venimos a este ciclo a aprender a programar.
Venimos a este ciclo a aprender a gestionar bases de datos

Para programar, no es suficiente programar - ahora además es muy necesario integrarse con la IA

Para gestionar bases de datos, ahora además tenemos que acostumbrarnos a trabajar con enormes cantidades de datos - nos lleva a retos y oportunidades.

Inteligencia de negocio es el uso de las conclusiones extraidas tras el análisis de grandes cantidades de datos, para tomar mejores decisiones en el ámbito empresarial.

O si quieres tomar mejores decisiones en cualquier tipo de ámbito
```

<a id="ejercicio-de-final-de-unidad"></a>
## Ejercicio de final de unidad

### ejercicio

```markdown

```


<a id="bases-de-datos-relacionales"></a>
# Bases de datos relacionales

<a id="modelo-de-datos"></a>
## Modelo de datos

El modelo de datos es la estructura fundamental que define cómo se organiza y relacionan los datos dentro de una base de datos relacional. Este concepto es esencial para entender cómo almacenar, recuperar y gestionar información de manera eficiente.

En el contexto de las bases de datos relacionales, el modelo de datos se basa en la teoría de conjuntos y relaciones matemáticas. Esta teoría permite representar los datos como entidades (también conocidas como tablas) que están interconectadas mediante relaciones. Cada entidad tiene atributos o columnas que definen las características de los objetos que se almacenan.

El modelo de datos relacional utiliza un esquema formal para definir la estructura de las tablas y cómo estas tablas interactúan entre sí. Este esquema incluye definiciones detalladas de cada columna, como su nombre, tipo de dato y restricciones de integridad. La relación entre las tablas se establece mediante claves primarias y foráneas, que aseguran la consistencia y coherencia de los datos.

La teoría del modelo de datos relacional también impone reglas sobre cómo deben ser estructurados los datos para evitar redundancias y anomalias. Por ejemplo, el principio de normalización sugiere que las tablas deben estar diseñadas de manera que cada columna contenga un valor atómico (no divisible) y que no haya dependencias parciales ni transitivas entre columnas.

El modelo de datos relacional es una herramienta poderosa para la gestión de grandes volúmenes de información. Permite realizar consultas complejas utilizando lenguajes como SQL, lo que facilita el análisis y la extracción de insights valiosos de los datos almacenados. Además, su estructura jerárquica permite organizar los datos en una forma intuitiva y fácil de entender.

En resumen, el modelo de datos es la base sobre la cual se construyen las bases de datos relacionales. Es un concepto fundamental que define cómo se organizan y relacionan los datos para garantizar su integridad y eficiencia. A través del estudio del modelo de datos, los desarrolladores pueden crear sistemas informáticos robustos y escalables capaces de manejar grandes cantidades de información de manera efectiva.

### introduccion

```markdown
Clientes
  - nombre (cadena)
  - apellidos (cadena)
  - teléfono (cadena)
  - email (cadena)
  
Productos
  - nombre (cadena)
  - descripcion (texto)
  - precio (float)
  - tamaño (vector)
  - peso (float)
  - ....
  
Pedidos
  - fecha
  - número de pedido
  - Cliente (FK)
  - Productos (FK)
  - impuestos
  - total
  
```

<a id="terminologia-del-modelo-relacional"></a>
## Terminología del modelo relacional

En el vasto e infinito universo de la programación y la gestión de datos, una rama llamada "Bases de datos relacionales" destaca como un pilar fundamental. Esta disciplina se centra en cómo organizar, almacenar y recuperar información de manera eficiente y coherente. En este contexto, el submódulo "Terminología del modelo relacional" es una etapa cruciales que introduce a los estudiantes al lenguaje específico utilizado para definir y gestionar estos sistemas de datos.

El primer concepto que se aborda es la **Entidad**, un elemento fundamental en cualquier base de datos relacional. Una entidad representa un objeto o concepto del mundo real, como un cliente, un producto o una transacción financiera. Cada entidad tiene atributos, que son las características que definen a esa entidad, como el nombre del cliente, el precio del producto o la fecha de la transacción.

La **Relación**, por otro lado, es la conexión entre dos o más entidades. Por ejemplo, si tenemos una entidad "Cliente" y otra "Orden", la relación podría ser "Realiza". Esta relación permite establecer cómo las entidades están interrelacionadas y cómo se pueden consultar juntas para obtener información relevante.

El **Modelo Relacional** es un conjunto de reglas que define cómo deben organizarse los datos en una base de datos relacional. Este modelo utiliza tablas, filas y columnas para representar la información. Cada tabla tiene un nombre único y está compuesta por filas (registros) y columnas (campos). Las columnas tienen nombres descriptivos que identifican el tipo de dato almacenado en ellas.

La **Clave Primaria** es una columna o conjunto de columnas que identifica de manera única cada fila en una tabla. Es como la "dirección" de cada registro dentro de la tabla, asegurando que no haya duplicados y facilitando la búsqueda de información específica.

Las **Restricciones de Validación** son reglas que se aplican a los datos para garantizar su integridad. Por ejemplo, una restricción podría ser que el campo "Edad" solo acepte valores numéricos positivos menores de 120 años. Estas restricciones ayudan a mantener la consistencia y precisión de los datos almacenados.

El **Índice** es una estructura de datos que permite acelerar las búsquedas en una tabla. Al crear un índice en una columna o conjunto de columnas, se crea una copia ordenada de esos valores, lo que facilita la búsqueda rápida y eficiente de registros.

La **Normalización** es el proceso de diseñar una base de datos relacional para reducir las redundancias y mejorar su estructura. Esto implica dividir la información en tablas más pequeñas y relacionadas, asegurando que cada tabla contenga solo datos relevantes y consistentes.

En conclusión, el estudio del terminología del modelo relacional es una etapa esencial en el aprendizaje de las bases de datos relacionales. A través de este módulo, los estudiantes adquieren un lenguaje específico para definir y gestionar estos sistemas de manera efectiva. Cada concepto introducido, desde la entidad hasta la normalización, contribuye a construir una comprensión sólida de cómo organizar y manipular información en una base de datos relacional, preparando así el camino para desarrollar habilidades avanzadas en este campo tan crucial para la programación y la gestión de datos.

### Introduccion

```markdown
Motor de bases de datos
  Bases de datos
    Tablas
      Columnas
      Registros - filas - tuplas

Claves
Tipos de datos

Base de datos es un conjunto de documentos

Motorrrr de base de datos es un software que gestiona esa base de datos
```

### crear base de datos

```sql
CREATE DATABASE empresarial;

USE empresarial;
```

### crear tabla de clientes

```sql
CREATE TABLE `empresarial`.`clientes` (
  `Identificador` INT NOT NULL , 
  `nombre` VARCHAR(50) NOT NULL , 
  `apellidos` VARCHAR(100) NOT NULL , 
  `telefono` VARCHAR(50) NOT NULL , 
  `email` VARCHAR(100) NOT NULL 
) ENGINE = InnoDB;
```

### productos

```sql
CREATE TABLE `empresarial`.`productos` (
  `Identificador` INT NOT NULL , 
  `nombre` VARCHAR(50) NOT NULL , 
  `descripcion` TEXT NOT NULL , 
  `precio` DOUBLE(10,2) NOT NULL , 
  `peso` DOUBLE(10,2) NOT NULL 
) ENGINE = InnoDB;
```

<a id="tipos-de-datos"></a>
## Tipos de datos

En el vasto e infinito universo de la programación y la gestión de datos, los tipos de datos son como las piedras fundamentales que forman la estructura de cualquier edificio informático. Son los bloques concretos a partir de los cuales se construyen los algoritmos y las aplicaciones que procesan información.

Los tipos de datos en las bases de datos relacionales son esenciales porque definen cómo se almacenarán y manipularán los datos dentro del sistema. Cada tipo de dato tiene sus propias características, restricciones y métodos de uso específicos, lo que permite a los desarrolladores crear modelos de datos precisos y eficientes.

El primer tipo de dato que exploramos es el **número entero**. Este tipo almacena valores sin decimales y puede ser positivo, negativo o cero. Los números enteros son fundamentales para contabilizar elementos, calcular cantidades y realizar operaciones matemáticas básicas.

Siguiendo esta línea de pensamiento, el **número real** es otro tipo de dato crucial. A diferencia de los números enteros, los números reales pueden representar valores con decimales, lo que los hace ideales para medir distancias, pesos, tiempos y cualquier otra cantidad continua.

El **texto o cadena de caracteres** es otro tipo de dato fundamental en las bases de datos relacionales. Permite almacenar información alfanumérica como nombres, direcciones, descripciones y otros tipos de texto. La gestión eficiente de los textos es esencial para la creación de interfaces de usuario amigables y la manipulación de información textual.

El **booleano** es un tipo de dato que solo puede tomar dos valores: verdadero o falso. Es especialmente útil en situaciones donde se necesita una respuesta binaria, como determinar si un registro está activo o inactivo, o si una condición ha sido cumplida.

Además de estos tipos básicos, las bases de datos relacionales también soportan **fechas y horas**, que son esenciales para el seguimiento del tiempo en aplicaciones que requieren registros históricos o temporales. Las fechas y horas permiten almacenar información precisa sobre cuando ocurrieron ciertos eventos.

El **número decimal** es otro tipo de dato que permite representar valores con decimales, pero con una precisión específica definida por el número de dígitos antes y después del punto decimal. Es útil en situaciones donde la precisión financiera o científica es crucial.

Finalmente, los tipos de datos **binarios** son utilizados para almacenar información que no puede representarse como texto o números, como imágenes, videos, archivos ejecutables y otros tipos de datos complejos. Los binarios permiten una gran flexibilidad en el almacenamiento y manipulación de diferentes tipos de contenido.

Cada uno de estos tipos de datos desempeña un papel crucial en la construcción de bases de datos relacionales eficientes y precisas. Comprender y utilizar correctamente los tipos de datos es fundamental para cualquier desarrollador que trabaje con información estructurada, ya que determinará cómo se almacena, manipula y recupera esa información en el sistema.

En resumen, los tipos de datos en las bases de datos relacionales son como los ingredientes de una receta: cada uno tiene su propia función y contribuye a la calidad final del plato. Al seleccionar y utilizar adecuadamente los tipos de datos correctos, se puede crear un modelo de datos robusto y eficiente que permita al sistema procesar información con precisión y eficiencia.

### tipos de datos

```markdown
# 4 tipos básicos

INT - numeros enteros
VARCHAR - cadenas de caracteres
TEXT - textos muy largos
DATE - fechas

# Numéricos

Tinyint - 0-256
Smallint - 0- 64000
MediumInt - 0 - 16.7M
Int - 4 Billones
BigInt - 32bits

Decimal
Float
Double
Real

Bit 0,1
Boolean (True, False)
Serial

# Fechas
Date - fecha
Time - hora
DateTime - Hora y fecha
Timestamp - marca unix
Year - año

Char
Varchar

Tinytext
Text
MediumText
LongText

Blobs - nos permiten guardar archivos en la base de datos

Enumeradores - Listas de elementos

JSON
Nos permite utilizar el poder de JSON en MySQL
```

<a id="claves-primarias"></a>
## Claves primarias

En este capítulo, nos adentramos en la comprensión fundamental de las claves primarias en el contexto de las bases de datos relacionales. Las claves primarias son fundamentales para mantener la integridad y coherencia de los datos almacenados en una base de datos. Un conjunto de columnas que se utiliza para identificar de manera única cada fila en una tabla es conocido como clave primaria.

La elección de las columnas adecuadas para formar una clave primaria es un proceso meticuloso y requiere consideraciones cuidadosas. Por lo general, estas columnas deben ser únicas (no pueden contener valores nulos ni repetirse) y no cambiar a lo largo del tiempo, ya que esto podría afectar la integridad de los datos.

En una base de datos relacional, cada tabla debe tener una clave primaria única para distinguir entre las diferentes filas. Esta clave primaria puede estar compuesta por una sola columna o por varias columnas juntas, siempre y cuando cumplan con las condiciones de unicidad y no nulidad.

La definición de la clave primaria es crucial durante el diseño de una base de datos, ya que afecta directamente a cómo se organizan y relacionan los datos. Una buena elección de claves primarias facilita la creación de relaciones entre tablas, lo que es fundamental para la construcción de bases de datos complejas.

Además, las claves primarias desempeñan un papel importante en el rendimiento de las consultas a la base de datos. El acceso a los datos mediante una clave primaria suele ser muy rápido y eficiente, ya que permite localizar rápidamente cualquier fila específica sin necesidad de realizar búsquedas más complejas.

En este capítulo, profundizaremos en cómo definir, utilizar y gestionar claves primarias en las bases de datos relacionales. Aprenderemos sobre los diferentes tipos de claves primarias y cómo seleccionar las columnas adecuadas para formar una clave primaria efectiva. También exploraremos técnicas avanzadas para optimizar el uso de claves primarias y mejorar el rendimiento general de la base de datos.

A lo largo del camino, ilustraremos con ejemplos prácticos cómo aplicar los conceptos aprendidos en situaciones reales de desarrollo de bases de datos. A través de estos ejemplos, veremos cómo las claves primarias contribuyen a mantener la integridad y coherencia de los datos, así como cómo optimizar el acceso a ellos para mejorar el rendimiento del sistema.

En resumen, entender y aplicar correctamente las claves primarias es un aspecto fundamental del diseño y gestión de bases de datos relacionales. A través de este capítulo, adquiriremos una sólida comprensión de los conceptos básicos y avanzados asociados a las claves primarias, lo que nos permitirá desarrollar habilidades valiosas en el campo de la programación y la gestión de sistemas informáticos.

### definicion

```markdown
Clave primaria (que suele ser numérica y autoincremental) es un numero unico e irrepetible que identifica inequívocamente a un registro
```

### altero tabla

```sql
ALTER TABLE `empresarial`.`clientes`
  ADD PRIMARY KEY (`Identificador`);
  
  ALTER TABLE clientes
  MODIFY COLUMN Identificador INT NOT NULL AUTO_INCREMENT;
```

### altero tabla de productos

```sql
ALTER TABLE `empresarial`.`productos`
  ADD PRIMARY KEY (`Identificador`);
  
  ALTER TABLE productos
  MODIFY COLUMN Identificador INT NOT NULL AUTO_INCREMENT;
```

<a id="restricciones-de-validacion"></a>
## Restricciones de validación

Las restricciones de validación son una herramienta fundamental para garantizar la integridad y consistencia de los datos almacenados en las bases de datos relacionales. Estas reglas se aplican a los valores que pueden ser insertados o actualizados en las tablas, asegurando que solo datos válidos sean aceptados.

Las restricciones de validación pueden ser definidas tanto en el nivel del modelo de datos como en el nivel de la base de datos. En el modelo de datos, se especifican las reglas que los atributos deben cumplir antes de que puedan participar en una relación. Por ejemplo, si un atributo representa una edad, puede haber una restricción que impide que se inserten valores negativos o superiores a 120 años.

En el nivel de la base de datos, las restricciones de validación se implementan mediante sentencias SQL como CHECK. Estas sentencias permiten definir condiciones que deben cumplirse para que una operación de inserción o actualización sea aceptada. Por ejemplo, si se desea asegurar que un campo de correo electrónico tenga un formato válido, se puede crear una restricción CHECK que valide la estructura del correo.

Las restricciones de validación pueden ser muy flexibles y variadas. Algunas de las más comunes incluyen:

1. **Restricciones de nulidad (NOT NULL)**: Impiden que un campo acepte valores nulos.
2. **Restricciones únicas (UNIQUE)**: Aseguran que los valores en un campo sean distintos entre sí.
3. **Restricciones primarias (PRIMARY KEY)**: Combinan la restricción de nulidad y única, identificando claramente el campo o conjunto de campos que forman la clave principal de una tabla.
4. **Restricciones foráneas (FOREIGN KEY)**: Garantizan la integridad referencial entre tablas relacionadas, asegurando que los valores en un campo sean presentes en otro campo de otra tabla.

Además de las restricciones básicas, existen restricciones más complejas como:

- **Restricciones CHECK**: Permiten definir condiciones personalizadas para validar los datos.
- **Restricciones ENUM**: Limitan el valor a un conjunto predefinido de opciones.
- **Restricciones RANGE**: Aseguran que los valores estén dentro de un rango específico.

La implementación de restricciones de validación es crucial para mantener la calidad y confiabilidad de los datos en una base de datos. Algunos beneficios incluyen:

1. **Reducción de errores**: Evita la inserción de datos incorrectos o inconsistentes.
2. **Mejora del rendimiento**: Permite a las bases de datos realizar optimizaciones basadas en las restricciones definidas.
3. **Facilita el mantenimiento**: Simplifica el proceso de actualización y corrección de los datos.

Sin embargo, es importante considerar que las restricciones de validación deben ser utilizadas con cuidado. Excesivas o mal diseñadas pueden limitar la flexibilidad del sistema y hacer que las operaciones sean más complejas. Además, algunas restricciones pueden afectar el rendimiento si no están optimizadas adecuadamente.

En resumen, las restricciones de validación son una herramienta poderosa para garantizar la calidad de los datos en las bases de datos relacionales. Al diseñar y aplicar estas restricciones con inteligencia y consideración, se puede crear un sistema de gestión de datos robusto y confiable que respalde las necesidades operativas del negocio.

### restriccion de telefono

```sql
ALTER TABLE clientes
  ADD CONSTRAINT chk_telefono_length
  CHECK (CHAR_LENGTH(telefono) = 9);
```

### email

```sql
ALTER TABLE clientes
  ADD CONSTRAINT chk_email_format
  CHECK (email REGEXP '^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,}$');
```

<a id="indices-caracteristicas"></a>
## Índices. Características

En el vasto universo de las bases de datos relacionales, los índices desempeñan un papel fundamental como pilares que respaldan la eficiencia operativa. Estos son estructuras de datos que permiten a las consultas acceder rápidamente a los registros que cumplen ciertas condiciones, optimizando así el rendimiento general del sistema.

Los índices se basan en una o más columnas de una tabla y están diseñados para facilitar la búsqueda de datos. Al crear un índice, se crea una estructura adicional que mantiene ordenada la información según los valores de las columnas seleccionadas. Esta organización permite que el motor de base de datos localice rápidamente los registros deseados sin necesidad de recorrer toda la tabla.

La creación de índices es un proceso deliberado, ya que aunque mejoran la velocidad de consulta, también aumentan el tiempo necesario para insertar, actualizar y eliminar registros. Por lo tanto, se debe equilibrar la cantidad de índices con la frecuencia de operaciones CRUD (Crear, Leer, Actualizar, Eliminar) en la tabla.

Existen diferentes tipos de índices, cada uno con sus propias características y ventajas. Los índices simples están formados por una sola columna, mientras que los índices compuestos utilizan varias columnas para su organización. Además, existen índices únicos que aseguran que no haya duplicados en la columna o conjunto de columnas indexadas.

La elección del tipo de índice depende del escenario específico y de las consultas frecuentes realizadas sobre la tabla. Por ejemplo, si una consulta suele filtrar los registros por varias columnas juntas, un índice compuesto sería más eficiente que varios índices simples individuales.

Además de mejorar el rendimiento de las consultas, los índices también pueden ayudar a prevenir la pérdida de datos en caso de fallos del sistema. Algunos sistemas de gestión de bases de datos utilizan índices para realizar copias de seguridad y restauraciones rápidas de los datos.

La gestión de índices es un aspecto crucial en el diseño y optimización de las bases de datos relacionales. Es importante mantener una buena relación entre la cantidad de índices y la frecuencia de operaciones CRUD, así como evaluar regularmente su eficacia para ajustarlos según sea necesario.

En conclusión, los índices son herramientas poderosas que permiten a las bases de datos relacionales responder rápidamente a consultas complejas. Su correcta utilización es fundamental para el rendimiento óptimo del sistema y requiere un equilibrio cuidadoso entre la eficiencia operativa y el costo adicional en términos de tiempo y recursos.

<a id="el-valor-null"></a>
## El valor NULL

El valor NULL es una característica fundamental de los sistemas de bases de datos relacionales que permite representar la ausencia de un valor o información. Este concepto es crucial para entender cómo se maneja la falta de datos en una base de datos, ya que no puede existir un espacio vacío en una columna definida con un tipo de dato específico.

En el contexto de las bases de datos relacionales, cuando un campo está marcado como NULL, significa que no hay ningún valor asignado a ese campo. Es importante distinguir entre un campo vacío y un campo nulo; mientras que un campo vacío puede contener espacios en blanco o cadenas vacías, un campo nulo indica la ausencia total de cualquier dato.

El manejo del valor NULL es una práctica común en el diseño de bases de datos porque permite una representación más precisa y completa de los datos. Por ejemplo, si se registra la edad de una persona, puede haber casos en que no se conoce la edad exacta, lo cual sería un valor nulo.

Sin embargo, el manejo del valor NULL también introduce complejidades en las consultas y operaciones sobre la base de datos. Los lenguajes de consulta como SQL tienen reglas específicas para tratar los valores nulos, lo que puede llevar a resultados inesperados si no se manejan adecuadamente. Por ejemplo, una consulta que busca registros donde el campo edad es igual a NULL no devolverá ningún resultado, ya que la comparación con NULL siempre devuelve falso.

Para evitar estos problemas y facilitar el manejo de los valores nulos, SQL ofrece funciones específicas como IS NULL y IS NOT NULL, que permiten filtrar registros según su valor nulo o no. Además, es común utilizar valores predeterminados para campos que pueden ser nulos, lo que asegura que siempre haya un valor válido en la columna.

El concepto del valor NULL también tiene implicaciones en el diseño de tablas y relaciones. Por ejemplo, si una relación entre dos tablas puede tener registros sin valor en algún campo, es necesario considerar cómo se manejarán estos casos para mantener la integridad de los datos.

En resumen, el valor NULL es un elemento esencial en las bases de datos relacionales que permite representar la ausencia de información. Aunque introduce complejidades en el diseño y consulta de las bases de datos, su uso adecuado es fundamental para una representación precisa y completa de los datos. Comprender cómo se maneja el valor NULL es crucial para cualquier profesional que trabaje con sistemas de gestión de bases de datos relacionales.

### apellido null

```sql
ALTER TABLE clientes
  MODIFY COLUMN apellidos VARCHAR(100) NULL;
```

<a id="claves-ajenas"></a>
## Claves ajenas

En el vasto universo de las bases de datos relacionales, una relación fundamental es la existencia de claves ajenas, que son un mecanismo esencial para establecer conexiones entre diferentes tablas. Estas claves no solo permiten la integridad referencial en los sistemas de información, sino que también facilitan la consulta y la manipulación de datos distribuidos.

Las claves ajenas se definen como columnas o conjuntos de columnas en una tabla que hacen referencia a las claves primarias de otra tabla. Esta relación permite que una fila en una tabla esté vinculada a una fila específica en otra tabla, creando así un puente entre ellas. Este concepto es crucial para mantener la consistencia y coherencia de los datos almacenados.

La importancia de las claves ajenas radica en su capacidad para garantizar que todos los valores referenciados existan en la tabla a la que hacen referencia. Esto impide la inserción de datos incoherentes o inconsistentes, asegurando que cada registro esté relacionado con otro de manera lógica y precisa.

Además, las claves ajenas son fundamentales para el diseño de consultas complejas en bases de datos relacionales. Al permitir la referencia entre tablas, es posible realizar operaciones como unión (JOIN), filtrado y agrupamiento que requieren la combinación de información de múltiples fuentes. Esta capacidad es esencial para la extracción de insights valiosos y la toma de decisiones basada en datos.

La utilización de claves ajenas también facilita el mantenimiento del sistema de información. Al establecer relaciones entre tablas, se pueden realizar operaciones como la eliminación en cascada, que asegura que cuando una fila en una tabla principal es eliminada, las filas relacionadas en otras tablas también sean eliminadas automáticamente, manteniendo la integridad de los datos.

En resumen, las claves ajenas son un elemento fundamental en el diseño y gestión de bases de datos relacionales. Su capacidad para establecer relaciones entre tablas, garantizar la integridad referencial y facilitar consultas complejas hace que sean una herramienta esencial para cualquier sistema de información moderno. A través del uso efectivo de claves ajenas, se pueden crear estructuras de datos coherentes y eficientes, permitiendo así el acceso y manipulación de información de manera precisa y segura.

### Introduccion

```markdown
Bases de datos SQL
Bases de datos RELACIONALES
Se supone que existe algún tipo de relación entre los datos

Hasta el momento tenemos clientes y productos
Son entidades que no tienen absolutamente nada que ver entre si

Ahora vamos a suponer que hacemos pedidos
En un pedido se encuentran un cliente y un producto
```

### crear pedidos

```sql
CREATE TABLE `empresarial`.`pedidos` (`Identificador` INT NOT NULL AUTO_INCREMENT , `fecha` DATE NOT NULL , `id_cliente` INT NOT NULL , `id_producto` INT NOT NULL , PRIMARY KEY (`Identificador`)) ENGINE = InnoDB;
```

### clave foranea de pedidos a clientes

```sql
ALTER TABLE `pedidos` ADD CONSTRAINT `pedidosaclientes` FOREIGN KEY (`id_cliente`) REFERENCES `clientes`(`Identificador`) ON DELETE RESTRICT ON UPDATE RESTRICT;
```

### clave foranea de pedidos a productos

```sql
ALTER TABLE `pedidos` ADD CONSTRAINT `pedidosaproductos` FOREIGN KEY (`id_producto`) REFERENCES `productos`(`Identificador`) ON DELETE RESTRICT ON UPDATE RESTRICT;
```

### insercion

```sql
INSERT INTO `pedidos` 
(
  `Identificador`, 
  `fecha`, 
  `id_cliente`, 
  `id_producto`
) VALUES (
  NULL, 
  '2025-09-25', 
  '12', 
  '19'
);
```

<a id="vistas"></a>
## Vistas

En el vasto mundo de las bases de datos relacionales, una vista es un objeto virtual que proporciona una forma simplificada y personalizada de ver los datos. Esta estructura permite a los usuarios interactuar con subconjuntos específicos de datos, ocultando la complejidad del modelo base y presentándolo de manera más accesible.

La creación de vistas se realiza mediante consultas SQL que seleccionan y combinan datos de una o varias tablas existentes. Estas consultas pueden incluir operadores de selección, proyección, agrupamiento y ordenación, permitiendo a los usuarios definir cómo desean ver los datos sin necesidad de escribir consultas complejas cada vez.

Una de las principales ventajas de las vistas es la seguridad. Al ocultar ciertos detalles del modelo base, se puede limitar el acceso a información sensible o restringir las operaciones que los usuarios pueden realizar sobre los datos. Además, las vistas facilitan la gestión de cambios en el modelo base, ya que cualquier modificación solo afecta a la vista y no a los datos subyacentes.

El uso de vistas también mejora la eficiencia del rendimiento. Al almacenar los resultados de una consulta como una vista, se evita la necesidad de ejecutar la misma consulta cada vez que se necesita acceder a los datos filtrados. Esto puede reducir significativamente el tiempo y recursos requeridos para recuperar información.

En términos prácticos, las vistas son herramientas poderosas que permiten a los desarrolladores y administradores de bases de datos crear interfaces más amigables y seguras para sus aplicaciones. Al definir vistas personalizadas, se pueden ofrecer vistas de los datos que sean relevantes y útiles para diferentes roles dentro de una organización, lo que facilita la colaboración y el análisis.

Además, las vistas son ideales para presentar datos en un formato más legible y estructurado. Por ejemplo, si una base de datos contiene información detallada sobre los clientes, se puede crear una vista que muestre solo los campos relevantes para un informe específico, como nombre, dirección y correo electrónico.

En resumen, las vistas son una característica esencial de las bases de datos relacionales. Permiten a los usuarios interactuar con subconjuntos específicos de datos de manera segura y eficiente, facilitando la gestión del acceso y el rendimiento. Su uso estratégico puede mejorar significativamente la experiencia del usuario y la productividad de los sistemas basados en bases de datos.

### peticion inicial

```sql
SELECT 
pedidos.fecha,
clientes.nombre,
clientes.apellidos,
productos.nombre,
productos.precio,
productos.precio*0.16 as IVA,
productos.precio*1.16 as Total
FROM pedidos

LEFT JOIN clientes
ON pedidos.id_cliente = clientes.Identificador

LEFT JOIN productos
ON pedidos.id_producto = productos.Identificador
;
```

### creo una vista

```sql
CREATE VIEW vista_pedidos AS 
SELECT 
pedidos.fecha,
clientes.nombre as "nombre de cliente",
clientes.apellidos,
productos.nombre as "nombre de producto",
productos.precio,
productos.precio*0.16 as IVA,
productos.precio*1.16 as Total
FROM pedidos

LEFT JOIN clientes
ON pedidos.id_cliente = clientes.Identificador

LEFT JOIN productos
ON pedidos.id_producto = productos.Identificador
;
```

### Comentarios

```markdown
Una vista guarda una consulta previamente generada

Una tabla tiene el poder CRUD (se puede crear, leer, actualizar, eliminar)
En una vista solo se puede leer, no se puede crear, actualizar o eliminar)
```

<a id="usuarios-privilegios"></a>
## Usuarios. Privilegios

En la etapa de exploración del vasto mundo de las bases de datos relacionales, nos encontramos con un concepto fundamental que es el de los usuarios y sus privilegios. Este aspecto es crucial para entender cómo se gestiona la seguridad y la autorización en estos sistemas de almacenamiento de información.

Los usuarios son individuos o aplicaciones que interactúan con las bases de datos. Cada usuario tiene un nombre único y una contraseña, lo que permite a los sistemas identificar quién está realizando operaciones en el sistema. La gestión de usuarios es esencial para mantener la integridad y la confidencialidad de la información almacenada.

Los privilegios, por otro lado, son las capacidades específicas que se le conceden a un usuario dentro del sistema de base de datos. Estos pueden variar desde el acceso básico hasta la capacidad de realizar operaciones complejas como la creación y eliminación de tablas. La asignación de privilegios es una tarea delicada que requiere cuidado, ya que puede tener consecuencias graves si no se maneja adecuadamente.

La importancia de los usuarios y sus privilegios radica en su capacidad para controlar el acceso a la información sensible. Al permitir o denegar ciertas operaciones a diferentes usuarios, se pueden evitar accesos no autorizados y posibles violaciones de datos. Además, esta gestión permite una auditoría más precisa del uso del sistema, lo que facilita la identificación de cualquier actividad sospechosa.

La configuración de privilegios en las bases de datos relacionales es un proceso sistemático que implica definir roles predeterminados y asignarlos a los usuarios según sus necesidades. Los roles son conjuntos de privilegios predefinidos, lo que facilita la administración y el mantenimiento del sistema. Por ejemplo, se pueden crear roles como "Administrador", "Editor" o "Vista".

Es importante destacar que la gestión de usuarios y privilegios no es una tarea estática. A medida que cambia el entorno operativo o las necesidades de los usuarios, puede ser necesario ajustar estos privilegios para mantener la seguridad del sistema. Esto implica un proceso continuo de evaluación y actualización.

La implementación efectiva de la gestión de usuarios y privilegios requiere una comprensión profunda de cómo funcionan las bases de datos relacionales y los sistemas operativos que las albergan. Además, es crucial contar con herramientas adecuadas para facilitar esta tarea, como gestores de roles y permisos específicos.

En conclusión, la gestión de usuarios y privilegios en las bases de datos relacionales es un aspecto fundamental del diseño seguro y eficiente de estos sistemas. Al entender cómo se manejan los usuarios y sus privilegios, podemos asegurar que la información sea accesible solo a aquellos que tienen el derecho de hacerlo, protegiendo así tanto la integridad como la confidencialidad de nuestros datos.

### crear nuevo usuario con todos los permisos

```sql
CREATE USER 
'usuarioempresarial'@'localhost' 
IDENTIFIED WITH 
caching_sha2_password BY '***';

GRANT USAGE ON *.* TO 'usuarioempresarial'@'localhost';

ALTER USER 'usuarioempresarial'@'localhost' 
REQUIRE NONE 
WITH MAX_QUERIES_PER_HOUR 0 
MAX_CONNECTIONS_PER_HOUR 0 
MAX_UPDATES_PER_HOUR 0 
MAX_USER_CONNECTIONS 0;

GRANT ALL PRIVILEGES ON `empresarial`.* 
TO 'usuarioempresarial'@'localhost';

FLUSH PRIVILEGES;
```

### crear un usuario limitado

```sql
CREATE USER 
'usuariosololectura'@'localhost' 
IDENTIFIED WITH 
caching_sha2_password BY '***';

GRANT 
SELECT 
ON *.* 
TO 'usuariosololectura'@'localhost';

ALTER USER 
'usuariosololectura'@'localhost' 
REQUIRE NONE 
WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;

GRANT ALL PRIVILEGES ON 
`empresarial`.* 
TO 'usuariosololectura'@'localhost';
```

<a id="lenguaje-de-descripcion-de-datos-ddl"></a>
## Lenguaje de descripción de datos (DDL)

El lenguaje de descripción de datos (DDL) es una herramienta fundamental para la definición y gestión de estructuras de bases de datos relacionales. Este conjunto de comandos permite crear, modificar y eliminar objetos como tablas, índices y vistas, así como establecer restricciones y políticas de acceso a los mismos.

El primer paso en el uso del DDL es la creación de una tabla, que es la estructura básica de cualquier base de datos relacional. Este proceso implica definir el nombre de la tabla, sus columnas (con su tipo de dato y restricciones), y las relaciones entre ellas. Por ejemplo, para crear una tabla llamada "Clientes" con campos como identificación, nombre y dirección, se utilizaría un comando similar a:

```sql
CREATE TABLE Clientes (
    ID INT PRIMARY KEY,
    Nombre VARCHAR(100),
    Direccion VARCHAR(255)
);
```

Este comando no solo define la estructura de la tabla sino que también establece la columna "ID" como clave primaria, lo que garantiza su unicidad y uso como identificador único para cada registro.

Una vez creada una tabla, el DDL permite modificar su estructura. Esto puede implicar agregar nuevas columnas, eliminar o modificar existentes, o incluso cambiar el tipo de datos de una columna. Por ejemplo, si se desea añadir un campo "Email" a la tabla "Clientes", se utilizaría:

```sql
ALTER TABLE Clientes ADD Email VARCHAR(100);
```

Este comando modifica la estructura de la tabla sin eliminar los datos existentes, lo que es crucial para mantener la integridad de la información.

Además del DDL, también existe el lenguaje de control de datos (DCL), que se encarga de establecer y gestionar las políticas de acceso a los objetos de la base de datos. Aunque no pertenece directamente al DDL, su uso es complementario para asegurar que solo los usuarios autorizados puedan realizar cambios en la estructura o contenido de la base de datos.

El DDL también permite definir restricciones y políticas de integridad referencial entre las tablas. Por ejemplo, si se desea garantizar que cada cliente tenga una dirección válida, se podría establecer una restricción que impida la inserción de registros sin un valor en la columna "Direccion". Este tipo de restricciones son esenciales para mantener la consistencia y coherencia de los datos.

En resumen, el lenguaje de descripción de datos (DDL) es una herramienta poderosa y flexible que permite definir, modificar y gestionar las estructuras fundamentales de bases de datos relacionales. Su uso adecuado es crucial para crear sistemas de información eficientes y seguros, permitiendo a los desarrolladores y administradores de bases de datos controlar y manipular sus datos con precisión y eficiencia.

<a id="lenguaje-de-control-de-datos-dcl"></a>
## Lenguaje de control de datos (DCL)

En el vasto mundo de la programación y la gestión de datos, el lenguaje de control de datos (DCL) desempeña un papel crucial. Este conjunto de comandos permite a los usuarios y administradores gestionar los privilegios y permisos asociados con las bases de datos relacionales. A través del DCL, se pueden definir roles, asignar o revocar acceso a ciertas operaciones y asegurar que solo los usuarios autorizados puedan realizar cambios en la información almacenada.

El primer paso para entender el DCL es conocer los conceptos básicos de privilegios y roles. Un privilegio es una acción específica que se puede realizar sobre una base de datos, como insertar, actualizar o eliminar registros. Los roles son agrupaciones de privilegios que pueden ser asignados a usuarios individuales o grupos. Este enfoque facilita la gestión del acceso, ya que permite establecer políticas de seguridad complejas de manera más eficiente.

El DCL proporciona una serie de comandos para crear y gestionar roles. Por ejemplo, el comando `CREATE ROLE` se utiliza para definir un nuevo rol con un conjunto específico de privilegios. El comando `GRANT` permite asignar privilegios a un usuario o a un rol existente, mientras que el comando `REVOKE` es utilizado para revocar estos privilegios cuando ya no sean necesarios.

La importancia del DCL radica en su capacidad para implementar una seguridad robusta y flexible. Al permitir la creación de roles específicos para diferentes funciones dentro de una organización, se puede asegurar que los usuarios solo tengan acceso a las operaciones que son esenciales para su trabajo. Por ejemplo, un usuario encargado del departamento de ventas no necesitaría privilegios para modificar registros en la tabla de proveedores.

Además del control de privilegios, el DCL también permite gestionar la concurrencia y la integridad de los datos. Comandos como `LOCK TABLES` permiten bloquear ciertas tablas o filas mientras se realiza una operación crítica, evitando así conflictos entre usuarios que intentan modificar la misma información simultáneamente.

El uso del DCL también facilita el mantenimiento y escalabilidad de las bases de datos. Al definir roles y privilegios de manera centralizada, es más sencillo realizar cambios en políticas de seguridad sin afectar a múltiples usuarios o aplicaciones. Esto es especialmente útil cuando una organización crece o cambia sus estructuras organizativas.

En resumen, el lenguaje de control de datos (DCL) es un componente fundamental para la gestión segura y eficiente de las bases de datos relacionales. A través del DCL, se pueden definir roles, asignar privilegios y gestionar la concurrencia, lo que permite crear entornos de trabajo donde solo los usuarios autorizados puedan realizar cambios en la información almacenada. Este enfoque no solo mejora la seguridad, sino que también facilita el mantenimiento y escalabilidad de las bases de datos, asegurando que sean utilizadas de manera óptima para satisfacer las necesidades de cualquier organización.

<a id="ejercicio-de-final-de-unidad-1"></a>
## Ejercicio de final de unidad

### actividad

```markdown

```


<a id="realizacion-de-consultas"></a>
# Realización de consultas

<a id="proyeccion-seleccion-y-ordenacion-de-registros"></a>
## Proyección, selección y ordenación de registros

La realización de consultas es una habilidad fundamental en la gestión de bases de datos, permitiendo a los usuarios extraer información relevante y estructurada. En esta subunidad, exploraremos tres conceptos fundamentales: proyección, selección y ordenación de registros.

La **proyección** se refiere al proceso de seleccionar un subconjunto de columnas (campos) de una o varias tablas para formar una nueva tabla. Este proceso es crucial cuando solo necesitamos ciertos datos específicos, evitando así el procesamiento innecesario de información innecesaria. Por ejemplo, si tenemos una tabla que contiene detalles de clientes y productos, pero solo estamos interesados en los nombres de los clientes y los precios de los productos, podemos proyectar solo esas columnas.

La **selección**, por otro lado, se centra en filtrar filas basadas en ciertas condiciones. Esto significa que solo las filas que cumplen con determinados criterios serán incluidas en el resultado de la consulta. Por ejemplo, si queremos obtener todos los clientes que están ubicados en una ciudad específica, podemos seleccionar solo las filas donde la columna "ciudad" coincida con el valor deseado.

La **ordenación** es un proceso que permite organizar los resultados de una consulta según uno o varios criterios. Esto puede ser crucial para presentar los datos de manera más legible y fácilmente analizable. Por ejemplo, si queremos ver todos los productos ordenados por precio, podemos ordenar el resultado por la columna "precio" en orden ascendente o descendente.

Estos tres conceptos son esenciales para manipular y obtener información de una base de datos eficientemente. La proyección nos permite concentrarnos en lo que necesitamos, la selección nos permite filtrar los datos relevantes y la ordenación nos permite presentarlos de manera coherente y útil.

Al combinar estos conceptos, podemos crear consultas complejas que aborden diversos escenarios de búsqueda y análisis. Por ejemplo, podríamos seleccionar todos los clientes que compraron productos en un rango específico de precios, proyectar solo sus nombres y direcciones, y ordenar el resultado por la fecha de compra.

Es importante recordar que cada uno de estos conceptos puede ser utilizado individualmente o en combinación con otros para crear consultas más sofisticadas. La comprensión y práctica de estos procesos son fundamentales para cualquier profesional que trabaje con bases de datos, ya que permiten interactuar eficazmente con grandes volúmenes de información y extraer insights valiosos.

En resumen, la realización de consultas en bases de datos es una habilidad multifacética que implica proyección, selección y ordenación. Cada uno de estos conceptos desempeña un papel crucial en el análisis y presentación de los datos, permitiendo a los usuarios extraer información relevante y estructurada de manera eficiente y precisa.

### Datos de ejemplo

```sql
INSERT INTO clientes (nombre, apellidos, telefono, email) VALUES
('Carlos', 'García López',      '612345678', 'carlos.garcia@example.com'),
('María', 'Martínez Fernández', '623456789', 'maria.martinez@example.com'),
('José', 'Rodríguez Sánchez',   '634567890', 'jose.rodriguez@example.com'),
('Laura', 'Gómez Díaz',         '645678901', 'laura.gomez@example.com'),
('Antonio', 'Fernández Ruiz',   '656789012', 'antonio.fernandez@example.com'),
('Ana', 'López Jiménez',        '667890123', 'ana.lopez@example.com'),
('Francisco', 'Díaz Moreno',    '678901234', 'francisco.diaz@example.com'),
('Lucía', 'Ruiz Hernández',     '689012345', 'lucia.ruiz@example.com'),
('David', 'Sánchez Torres',     '690123456', 'david.sanchez@example.com'),
('Elena', 'Romero Ramos',       '601234567', 'elena.romero@example.com'),
('Manuel', 'Navarro Ortega',    '602345678', 'manuel.navarro@example.com'),
('Isabel', 'Castro Vargas',     '603456789', 'isabel.castro@example.com'),
('Pedro', 'Rubio Molina',       '604567890', 'pedro.rubio@example.com'),
('Sara', 'Ortega Serrano',      '605678901', 'sara.ortega@example.com'),
('Javier', 'Morales Gil',       '606789012', 'javier.morales@example.com'),
('Beatriz', 'Hernández Cruz',   '607890123', 'beatriz.hernandez@example.com'),
('Miguel', 'Torres León',       '608901234', 'miguel.torres@example.com'),
('Carmen', 'Domínguez Flores',  '609012345', 'carmen.dominguez@example.com'),
('Raúl', 'Vargas Castillo',     '611223344', 'raul.vargas@example.com'),
('Patricia', 'Santos Delgado',  '622334455', 'patricia.santos@example.com');
```

### seleccion

```sql
SELECT * FROM clientes;
```

### solo quiero ver los nombres

```sql
SELECT nombre FROM clientes;
```

### selecciono colu,nas

```sql
SELECT nombre FROM clientes;
```

### selecciono columnas

```sql
SELECT 
nombre,
apellidos 
FROM 
clientes;
```

### alias

```sql
SELECT 
nombre AS 'Nombres de los clientes',
apellidos AS 'Apellidos de los clientes' 
FROM 
clientes;
```

### volvemos a todo

```sql
SELECT 
* 
FROM 
clientes;
```

### ordenamos por columna

```sql
SELECT 
* 
FROM 
clientes
ORDER BY apellidos
;
```

### ascendiente

```sql
SELECT 
* 
FROM 
clientes
ORDER BY apellidos ASC
;
```

### descendiente

```sql
SELECT 
* 
FROM 
clientes
ORDER BY apellidos DESC
;
```

### varios criterios

```sql
SELECT 
* 
FROM 
clientes
ORDER BY apellidos ASC, nombre ASC
;
```

### clausula where

```sql
SELECT 
* 
FROM 
clientes
WHERE apellidos = "Castro Vargas"
;
```

### comodin de inicio

```sql
SELECT 
* 
FROM 
clientes
WHERE apellidos LIKE "Castro%"
;
```

### dos comodines

```sql
SELECT 
* 
FROM 
clientes
WHERE apellidos LIKE "%ez%"
;
```

<a id="operadores-operadores-de-comparacion-operadores-logicos"></a>
## Operadores. Operadores de comparación. Operadores lógicos

En el vasto mundo de la programación, las consultas son una herramienta esencial para interactuar con los datos almacenados en bases de datos. En esta subunidad didáctica, nos adentramos en el fascinante mundo de los operadores, que son la base de cualquier consulta SQL.

Los operadores de comparación son como los conductores del tráfico de información; permiten filtrar y seleccionar registros basándose en criterios específicos. Por ejemplo, si tenemos una tabla de empleados y queremos encontrar a todos aquellos que ganan más de 3000 euros al mes, usamos el operador mayor que (>). Este tipo de operadores nos permite establecer límites y obtener resultados precisos.

Los operadores lógicos, por otro lado, son como los semáforos en una intersección. Permiten combinar múltiples criterios para formar consultas más complejas. El operador AND es como un semáforo verde; solo se permite el paso cuando todos los criterios son verdaderos. Por ejemplo, si queremos encontrar a empleados que ganan más de 3000 euros y tienen más de 5 años de experiencia, usamos AND.

La combinación de operadores de comparación y lógicos nos abre la puerta a consultas muy potentes. El uso del operador OR es como un semáforo amarillo; permite el paso cuando al menos uno de los criterios es verdadero. Por ejemplo, si queremos encontrar empleados que ganan más de 3000 euros o tienen más de 5 años de experiencia, usamos OR.

Es importante entender que estos operadores no solo se utilizan en consultas SQL, sino también en muchos otros lenguajes de programación y herramientas de gestión de datos. Su dominio es fundamental para cualquier desarrollador que quiera interactuar con información estructurada.

Además de los operadores básicos, existen operadores más avanzados como BETWEEN, LIKE y IN. El operador BETWEEN nos permite seleccionar valores dentro de un rango específico, mientras que LIKE nos permite buscar patrones en cadenas de texto. El operador IN nos permite seleccionar registros que coincidan con cualquier valor en una lista específica.

La comprensión de estos operadores es crucial para optimizar las consultas y obtener los resultados deseados de manera eficiente. Cada uno de ellos tiene su propio propósito y uso, y aprender a utilizarlos adecuadamente puede marcar la diferencia entre un programa que funciona bien y uno que funciona muy bien.

En resumen, los operadores de comparación y lógicos son las herramientas fundamentales para realizar consultas en bases de datos. Su dominio es esencial para cualquier desarrollador que quiera interactuar con información estructurada de manera eficiente y precisa. A medida que avanzamos en nuestro estudio de la programación, es importante mantenerse al tanto de estos conceptos básicos y cómo aplicarlos en situaciones prácticas.

### aritmeticos

```sql
SELECT 
(4+3),
 (4-3),
 (4*3),
 (4/3)
FROM 
clientes
;
```

### datos de ejemplo

```sql
INSERT INTO productos (nombre, descripcion, precio, peso) VALUES
('Portátil Lenovo ThinkPad E14', 'Portátil empresarial de 14 pulgadas con procesador Intel i5 y 16GB RAM.', 899.99, 1.50),
('Smartphone Samsung Galaxy S24', 'Teléfono inteligente con pantalla AMOLED de 6.5 pulgadas y 128GB de memoria.', 1099.00, 0.18),
('Auriculares Sony WH-1000XM5', 'Auriculares inalámbricos con cancelación activa de ruido.', 349.99, 0.25),
('Impresora HP LaserJet Pro M404', 'Impresora láser monocromo rápida y compacta.', 229.50, 7.60),
('Monitor LG UltraWide 34"', 'Monitor ultrapanorámico de 34 pulgadas con resolución QHD.', 599.90, 6.80),
('Teclado Logitech MX Keys', 'Teclado inalámbrico retroiluminado con teclas silenciosas.', 119.00, 0.80),
('Ratón Logitech MX Master 3S', 'Ratón inalámbrico ergonómico con precisión avanzada.', 99.99, 0.14),
('Disco SSD Samsung 1TB', 'Unidad de estado sólido NVMe PCIe Gen4 de 1TB.', 139.90, 0.05),
('Servidor Dell PowerEdge T40', 'Servidor torre para pymes con Intel Xeon.', 1150.00, 11.20),
('Tablet Apple iPad 10.2"', 'Tablet de 10.2 pulgadas con 64GB de almacenamiento.', 429.00, 0.49),
('Cámara Canon EOS 250D', 'Cámara réflex digital con lente 18-55mm.', 639.00, 0.90),
('Proyector Epson EB-S41', 'Proyector SVGA de 3300 lúmenes para presentaciones.', 299.00, 2.50),
('Silla ergonómica Hbada', 'Silla de oficina ergonómica con soporte lumbar.', 199.99, 13.00),
('Disco Duro Externo WD 2TB', 'Disco duro externo portátil con conexión USB 3.0.', 79.90, 0.23),
('Router ASUS RT-AX88U', 'Router WiFi 6 de alto rendimiento con 8 puertos LAN.', 289.00, 1.00),
('Smartwatch Garmin Forerunner 255', 'Reloj inteligente multideporte con GPS integrado.', 349.90, 0.12),
('Altavoz JBL Charge 5', 'Altavoz Bluetooth portátil resistente al agua.', 179.00, 0.95),
('Microondas Samsung MG23', 'Microondas con grill de 23 litros.', 145.00, 13.00),
('Cafetera Nespresso Essenza Mini', 'Cafetera de cápsulas compacta y rápida.', 89.00, 2.30),
('Dispositivo NAS Synology DS220+', 'Servidor NAS de 2 bahías para uso doméstico o empresarial.', 329.00, 1.30);
```

### calculo del iva

```sql
SELECT 
nombre,
precio,
precio*0.21
FROM productos;
```

### alias de columna

```sql
SELECT 
nombre AS 'Nombre del producto',
precio AS 'Base Imponible',
precio*0.21 AS 'IVA 21%'
FROM productos;
```

### sumo el total

```sql
SELECT 
nombre AS 'Nombre del producto',
precio AS 'Base Imponible',
precio*0.21 AS 'IVA 21%',
precio + precio*0.21 AS 'Total Precio'
FROM productos;
```

### operadores de comparacion

```sql
SELECT 
4 > 3
FROM productos;
```

### comparacion falsa

```sql
SELECT 
4 < 3
FROM productos;
```

### condicion

```sql
SELECT 
nombre,
precio,
precio < 500 
FROM productos;
```

### alias de columna

```sql
SELECT 
  nombre,
  precio,
  IF(precio < 500, 'Sí', 'No') AS `carga transporte`,
  IF(precio < 500, 200, 0) AS `precio transporte`
FROM productos;
```

### total con transporte

```sql
SELECT 
  nombre,
  precio,
  IF(precio < 500, 'Sí', 'No') AS `carga transporte`,
  IF(precio < 500, 200, 0) AS `precio transporte`,
  IF(precio < 500, (200+precio), precio) AS `Total pedido`
FROM productos;
```

<a id="consultas-de-resumen"></a>
## Consultas de resumen

En el mundo digital de la programación, las consultas de resumen son un elemento esencial que nos permite obtener información relevante y estructurada a partir de grandes volúmenes de datos. Esta técnica es fundamental para el análisis de datos, la toma de decisiones estratégicas y la generación de informes precisos.

La realización de consultas de resumen implica la selección de campos específicos de una base de datos y la agrupación de estos datos según ciertos criterios. Este proceso es esencial para obtener una visión general de los datos, identificar tendencias y patrones que pueden no ser evidentes al examinar los datos en su forma original.

Para realizar consultas de resumen, se utilizan lenguajes como SQL (Structured Query Language), que es el estándar para interactuar con bases de datos relacionales. En esta carpeta, aprenderás a utilizar las funciones agregadas de SQL, como SUM(), AVG(), COUNT() y MAX()/MIN(), para calcular estadísticas descriptivas sobre los datos agrupados.

La importancia de las consultas de resumen no se limita solo al análisis de datos internos. También es crucial en el desarrollo web, donde los desarrolladores utilizan estas técnicas para mostrar información de manera dinámica y actualizada a los usuarios finales. Por ejemplo, en una aplicación de comercio electrónico, las consultas de resumen pueden ser utilizadas para calcular el precio promedio de un producto, la cantidad total vendida o el número de clientes únicos.

Además, las consultas de resumen son esenciales en el desarrollo de sistemas empresariales. En estos entornos complejos, los administradores y analistas necesitan acceso rápido a información clave para tomar decisiones estratégicas. Las consultas de resumen les permiten obtener esta información en un formato fácilmente interpretable, lo que facilita la toma de decisiones basadas en datos.

En el contexto del desarrollo de aplicaciones móviles y web, las consultas de resumen también desempeñan un papel crucial. Los desarrolladores utilizan estas técnicas para mostrar información relevante a los usuarios, como estadísticas de uso, tendencias de ventas o informes personalizados. Esta capacidad de presentar datos de manera eficiente es fundamental para mantener la interactividad y la utilidad de las aplicaciones.

La realización de consultas de resumen requiere una comprensión sólida de los conceptos básicos de SQL y un buen conocimiento de cómo estructurar las consultas para obtener los resultados deseados. A medida que avanzamos en este tema, aprenderás a utilizar subconsultas, combinaciones de múltiples selecciones y técnicas de optimización para mejorar el rendimiento de tus consultas.

En resumen, las consultas de resumen son una herramienta poderosa en la programación que nos permite extraer información relevante y estructurada a partir de grandes volúmenes de datos. Su importancia se extiende desde el análisis de datos internos hasta el desarrollo web y los sistemas empresariales complejos, haciendo de ellas un elemento esencial para cualquier desarrollador o analista de datos. A través de esta carpeta, aprenderás las técnicas básicas y avanzadas para realizar consultas de resumen eficientes y precisas, preparándote para enfrentar desafíos más complejos en el mundo digital.

### resumen de suma

```sql
SELECT * FROM vista_pedidos;
```

### resumen de total de pedidos

```sql
SELECT 
SUM(Total)
FROM vista_pedidos;
```

### promedio de lo que se gasta la gente en mi tienda

```sql
SELECT 
AVG(Total)
FROM vista_pedidos;
```

### pedido mas barato

```sql
SELECT 
AVG(Total)
FROM vista_pedidos;
```

### pedido mas caro

```sql
SELECT 
MAX(Total)
FROM vista_pedidos;
```

### cuantos pedidos se han realizado

```sql
SELECT 
COUNT(Total)
FROM vista_pedidos;
```

<a id="agrupamiento-de-registros"></a>
## Agrupamiento de registros

En el vasto mundo de la programación y la gestión de datos, el agrupamiento de registros es una técnica fundamental que permite organizar y analizar información con precisión. Este proceso, también conocido como agregación o resumen, consiste en combinar filas de una tabla o conjunto de datos según ciertos criterios definidos por el usuario.

Imagina un escenario donde tienes una base de datos que almacena información detallada sobre los clientes de una empresa. Cada cliente tiene múltiples registros que incluyen detalles como ventas, compras y servicios realizados. Agrupar estos registros por cliente te permitiría obtener una visión general de las actividades económicas de cada uno, facilitando la toma de decisiones estratégicas.

El agrupamiento de registros se realiza mediante consultas SQL, un lenguaje universalmente utilizado para interactuar con bases de datos relacionales. En esta carpeta, aprenderás cómo utilizar funciones agregadas como SUM(), AVG(), MAX() y MIN() para calcular valores resumidos de los grupos formados. Estas funciones son esenciales para obtener estadísticas importantes sobre los datos agrupados.

Además del cálculo de valores agregados, el agrupamiento también permite seleccionar registros específicos dentro de cada grupo utilizando la cláusula HAVING. Esta cláusula es similar a la cláusula WHERE, pero se aplica después del agrupamiento y nos permite filtrar los grupos basándonos en las condiciones que definamos.

La comprensión del agrupamiento de registros es crucial para cualquier programador o administrador de sistemas que trabaje con grandes conjuntos de datos. Permite no solo obtener información detallada, sino también resumirla de manera efectiva, lo que facilita la toma de decisiones y la identificación de tendencias.

En este submódulo, exploraremos en profundidad cómo utilizar las funciones agregadas y la cláusula HAVING para realizar consultas de agrupamiento. Aprenderás a organizar tus datos de manera efectiva y a extraer información valiosa que puede ayudarte a mejorar el rendimiento y la eficiencia de tu sistema.

Además, aprenderás técnicas avanzadas como el uso de subconsultas y composiciones internas para realizar agrupamientos más complejos. Estas habilidades te permitirán abordar desafíos más difíciles en el análisis de datos y la toma de decisiones basada en información.

El dominio del agrupamiento de registros es una herramienta poderosa que puede transformar los datos brutos en información valiosa. A través de este proceso, puedes obtener insights cruciales sobre tus operaciones, identificar tendencias y tomar decisiones informadas. En esta carpeta, te guiaré paso a paso a través del proceso de agrupamiento de registros, proporcionándote las herramientas necesarias para dominar esta técnica esencial.

Al finalizar este módulo, tendrás una comprensión profunda del agrupamiento de registros y cómo aplicarlo en tus proyectos de programación. Aprenderás a utilizar funciones agregadas, la cláusula HAVING y técnicas avanzadas para realizar consultas de agrupamiento eficientes y efectivas. Este conocimiento te permitirá extraer información valiosa de grandes conjuntos de datos y tomar decisiones basadas en datos precisos y relevantes.

En resumen, el agrupamiento de registros es una técnica fundamental en la programación y gestión de datos que permite organizar y analizar información con precisión. A través de este proceso, puedes obtener insights cruciales sobre tus operaciones, identificar tendencias y tomar decisiones informadas. En esta carpeta, te guiaré paso a paso a través del proceso de agrupamiento de registros, proporcionándote las herramientas necesarias para dominar esta técnica esencial.

### seleccion de productos

```sql
SELECT * 
FROM clientes;
```

### altero los clientes

```sql
ALTER TABLE `clientes` ADD `localidad` VARCHAR(255) NOT NULL AFTER `email`;
-- y relleno con datos de localidad en update
```

### seleccion con agrupacion

```sql
SELECT COUNT(Identificador)
FROM clientes;
```

### seleccion con agrupacion ahora si

```sql
SELECT 
localidad,
COUNT(Identificador)
FROM clientes
GROUP BY(localidad)
;
```

<a id="composiciones-internas"></a>
## Composiciones internas

En el mundo digital actual, la capacidad de realizar consultas complejas sobre bases de datos es una habilidad fundamental para cualquier desarrollador o administrador de sistemas. La carpeta `Primero/Bases de datos/003-Realización de consultas/005-Composiciones internas` del árbol GLOBAL nos guía a través de este aspecto crucial, ofreciendo un enfoque profundo y detallado sobre cómo combinar múltiples operaciones de consulta para obtener resultados más sofisticados.

La composición interna de consultas es una técnica poderosa que permite a los usuarios construir consultas complejas a partir de subconsultas. Esta práctica no solo aumenta la flexibilidad en el análisis y recuperación de datos, sino que también mejora significativamente la eficiencia del proceso. Al dividir una consulta grande en varias partes más pequeñas, se facilita su comprensión y depuración, además de permitiendo un uso más eficiente de los recursos disponibles.

En esta carpeta, encontramos una serie de lecciones que ilustran cómo combinar diferentes tipos de operaciones para crear consultas más complejas. Desde la proyección y selección de registros hasta el agrupamiento y composiciones externas, cada concepto se explica con claridad y ejemplos prácticos. La importancia de entender cómo funcionan estas combinaciones no puede ser subestimada, ya que son fundamentales para resolver problemas complejos en la gestión de datos.

La carpeta también destaca el uso de subconsultas, una técnica esencial en la composición interna de consultas. Las subconsultas permiten a los usuarios realizar operaciones dentro de una consulta principal, lo que puede ser especialmente útil cuando se necesita filtrar o ordenar datos basados en criterios complejos. La explicación detallada de cómo crear y utilizar subconsultas es un paso crucial para cualquier desarrollador que quiera dominar el arte de la programación de consultas.

Además, la carpeta aborda la combinación de múltiples selecciones, una técnica que permite a los usuarios combinar varias condiciones en una sola consulta. Esta práctica es especialmente útil cuando se necesita obtener datos que cumplen con múltiples criterios simultáneamente. La explicación proporcionada en esta carpeta demuestra cómo utilizar operadores lógicos para combinar estas condiciones de manera efectiva.

La importancia de la optimización de consultas no puede ser subestimada, especialmente cuando se trata de bases de datos grandes y complejas. La carpeta `Primero/Bases de datos/003-Realización de consultas/005-Composiciones internas` destaca el papel que juegan las composiciones internas en la optimización de consultas. Al combinar operaciones de manera eficiente, se pueden reducir los tiempos de ejecución y mejorar significativamente la rendimiento del sistema.

En conclusión, la carpeta `Primero/Bases de datos/003-Realización de consultas/005-Composiciones internas` es un recurso invaluable para cualquier persona que quiera dominar el arte de la programación de consultas en bases de datos. Al proporcionar una explicación detallada y práctica sobre cómo combinar diferentes tipos de operaciones, esta carpeta ofrece a los usuarios las herramientas necesarias para resolver problemas complejos y mejorar significativamente su eficiencia en la gestión de datos.

### seleccion basica de pedidos

```sql
SELECT * FROM pedidos;
```

### primer join con clientes

```sql
SELECT 
pedidos.fecha,
clientes.nombre,
clientes.apellidos
FROM pedidos
LEFT JOIN clientes
ON pedidos.id_cliente = clientes.Identificador
;
```

### vista de pedidos

```sql
SELECT 
pedidos.fecha,
clientes.nombre,
clientes.apellidos,
productos.nombre,
productos.precio,
productos.precio*0.16 as IVA,
productos.precio*1.16 as Total
FROM pedidos

LEFT JOIN clientes
ON pedidos.id_cliente = clientes.Identificador

LEFT JOIN productos
ON pedidos.id_producto = productos.Identificador
;
```

### Descripcion del problema

```markdown
Tenemos pedidos hasta el momento que:
1.-Toman un unico cliente (eso está bien)
2.-Toman un único producto (eso no está bien)
3.-Solo permite comprar una unica unidad (eso está peor todavía)

La inmensa mayoría de empresas:
1.-Permiten que un pedido tenga múltiples productos
2.-De cada producto se pueden comprar multiples unidades
3.-"Lineas de pedido"

En bases de datos existen fundamentalmente tres tipos de relaciones
1:1 = 1 persona tiene un DNI
1:n = 1 persona tiene multiples numeros de telefono
n:n = 1 alumno puede tener n profesores, un profesor puede tener n alumnos

Cuando existen relaciones de 1 a 1, se agrupan en una misma tabla

Que ocurre si UN pedido tiene N lineas de pedido = solución: se crea una tabla externa
```

### Pedidos con lineas

```sql
CREATE TABLE `empresarial`.`pedidosconlineas` (`Identificador` INT NOT NULL AUTO_INCREMENT , `fecha` DATE NOT NULL , `id_cliente` INT NOT NULL , PRIMARY KEY (`Identificador`)) ENGINE = InnoDB;

CREATE TABLE `empresarial`.`lineaspedido` (`Identificador` INT NOT NULL AUTO_INCREMENT , `producto_id` INT NOT NULL , `unidades` INT NOT NULL , PRIMARY KEY (`Identificador`)) ENGINE = InnoDB;
```

### claves foraneas

```sql
ALTER TABLE `lineaspedido` ADD CONSTRAINT `lineaspedidoaproductos` FOREIGN KEY (`producto_id`) REFERENCES `productos`(`Identificador`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `lineaspedido` ADD `pedidos_id` INT NOT NULL AFTER `unidades`;

ALTER TABLE `lineaspedido` ADD CONSTRAINT `lineapedidoapedido` FOREIGN KEY (`pedidos_id`) REFERENCES `pedidos`(`Identificador`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `lineaspedido` DROP FOREIGN KEY `lineapedidoapedido`; ALTER TABLE `lineaspedido` ADD CONSTRAINT `lineapedidoapedido` FOREIGN KEY (`pedidos_id`) REFERENCES `pedidosconlineas`(`Identificador`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `pedidosconlineas` ADD  CONSTRAINT `pedidosaclientes2` FOREIGN KEY (`id_cliente`) REFERENCES `clientes`(`Identificador`) ON DELETE RESTRICT ON UPDATE RESTRICT;
```

### creamos pedido

```sql
-- el cliente hace un pedido
INSERT INTO `pedidosconlineas` (`Identificador`, `fecha`, `id_cliente`) VALUES (NULL, '2025-09-25', '12');

-- insertamos lineas de pedido

INSERT INTO `lineaspedido` (`Identificador`, `producto_id`, `unidades`, `pedidos_id`) VALUES (NULL, '17', '2', '1');
```

### cruzamos tablas

```sql
SELECT * FROM `pedidosconlineas`;
```

### cruzamos con tabla clientes

```sql
SELECT 
pedidosconlineas.fecha,
clientes.nombre,
clientes.apellidos
FROM `pedidosconlineas`
LEFT JOIN clientes 
ON pedidosconlineas.id_cliente = clientes.Identificador
;
```

### cruzamos con la tabla de lineas de pedido

```sql
SELECT 
pedidosconlineas.fecha,
clientes.nombre,
clientes.apellidos
FROM `pedidosconlineas`

LEFT JOIN clientes 
ON pedidosconlineas.id_cliente = clientes.Identificador

LEFT JOIN lineaspedido
ON lineaspedido.pedidos_id = pedidosconlineas.Identificador
;
```

### ajustamos la proyeccion

```sql
SELECT 
pedidosconlineas.fecha,
clientes.nombre,
clientes.apellidos,
lineaspedido.unidades,
lineaspedido.producto_id

FROM `pedidosconlineas`

LEFT JOIN clientes 
ON pedidosconlineas.id_cliente = clientes.Identificador

LEFT JOIN lineaspedido
ON lineaspedido.pedidos_id = pedidosconlineas.Identificador
;
```

### cruzamos con productos

```sql
SELECT 
pedidosconlineas.fecha,
clientes.nombre,
clientes.apellidos,
lineaspedido.unidades,
productos.nombre,
productos.precio

FROM `pedidosconlineas`

LEFT JOIN clientes 
ON pedidosconlineas.id_cliente = clientes.Identificador

LEFT JOIN lineaspedido
ON lineaspedido.pedidos_id = pedidosconlineas.Identificador

LEFT JOIN productos
ON lineaspedido.producto_id = productos.Identificador
;
```

### calculos

```sql
SELECT 
pedidosconlineas.fecha,
clientes.nombre,
clientes.apellidos,
lineaspedido.unidades,
productos.nombre,
productos.precio,
productos.precio*lineaspedido.unidades AS Subtotal,
productos.precio*lineaspedido.unidades * 0.16 AS IVA,
productos.precio*lineaspedido.unidades * 1.16 AS Total

FROM `pedidosconlineas`

LEFT JOIN clientes 
ON pedidosconlineas.id_cliente = clientes.Identificador

LEFT JOIN lineaspedido
ON lineaspedido.pedidos_id = pedidosconlineas.Identificador

LEFT JOIN productos
ON lineaspedido.producto_id = productos.Identificador
;
```

### sumatorio

```sql
SELECT 
pedidosconlineas.fecha,
clientes.nombre,
clientes.apellidos,
SUM(productos.precio*lineaspedido.unidades * 1.16) AS Total

FROM `pedidosconlineas`

LEFT JOIN clientes 
ON pedidosconlineas.id_cliente = clientes.Identificador

LEFT JOIN lineaspedido
ON lineaspedido.pedidos_id = pedidosconlineas.Identificador

LEFT JOIN productos
ON lineaspedido.producto_id = productos.Identificador

GROUP BY pedidosconlineas.Identificador
;
```

<a id="composiciones-externas"></a>
## Composiciones externas

En el mundo digital actual, la capacidad de realizar consultas complejas es una habilidad fundamental para cualquier profesional que trabaje con bases de datos. En esta subunidad didáctica, nos adentramos en el fascinante mundo de las composiciones externas, un concepto esencial para optimizar y mejorar la eficiencia de nuestras búsquedas en los sistemas de información.

Las composiciones externas son una técnica avanzada que permite combinar dos o más consultas SQL en una sola consulta. Esta práctica no solo simplifica el código, sino que también puede aumentar significativamente la velocidad de ejecución al reducir el número de accesos a la base de datos. En este contexto, es crucial entender cómo funcionan y cuándo aplicarlas para obtener los mejores resultados.

La primera parte de esta subunidad se centra en la comprensión teórica de las composiciones externas. Aprenderemos sobre los diferentes tipos de composiciones que existen, como las composiciones internas y las composiciones externas propias. Cada tipo tiene sus propias ventajas y desventajas, y conocer cómo elegir el más adecuado para una consulta específica es un paso crucial en la optimización del rendimiento.

A medida que avanzamos, nos sumergimos en ejemplos prácticos de composiciones externas. Estos ejemplos no solo demuestran cómo se aplican las teorías aprendidas, sino que también proporcionan una visión real de cómo estas técnicas pueden ser utilizadas en situaciones reales. A través de estos ejemplos, los estudiantes podrán experimentar la eficiencia y simplicidad que ofrece el uso de composiciones externas.

La subunidad también aborda los desafíos asociados con las composiciones externas. Es importante entender cómo manejar problemas como la redundancia de datos y la complejidad del código, especialmente cuando se combinan múltiples consultas. Además, aprenderemos sobre técnicas para optimizar estas consultas y reducir su tiempo de ejecución.

Además de las composiciones externas propias, esta subunidad también explora el uso de subconsultas en el contexto de las composiciones externas. Las subconsultas son una herramienta poderosa que permite realizar búsquedas más complejas dentro de una consulta principal. Aprender cómo integrar subconsultas con composiciones externas nos proporcionará un conjunto completo de técnicas para resolver problemas de búsqueda en bases de datos.

La importancia de la optimización no se puede subestimar cuando se trata de consultas complejas. En esta subunidad, dedicamos tiempo a discutir estrategias y técnicas para optimizar las composiciones externas. Aprenderemos sobre el uso de índices, la selección de columnas adecuadas en las cláusulas SELECT, y cómo evitar los problemas comunes que pueden surgir durante la optimización.

Finalmente, esta subunidad concluye con una reflexión sobre el papel de las composiciones externas en el desarrollo de aplicaciones. Aprenderemos cómo estas técnicas pueden mejorar la eficiencia y la escalabilidad de nuestras aplicaciones, y cómo son cruciales para mantener un buen rendimiento en sistemas de información modernos.

En resumen, esta subunidad didáctica es una valiosa introducción a las composiciones externas, ofreciendo tanto conocimientos teóricos como ejemplos prácticos. A través de su estudio, los estudiantes adquirirán habilidades cruciales para optimizar y mejorar la eficiencia de sus consultas en bases de datos, preparándolos para enfrentar desafíos más complejos en el futuro.

<a id="subconsultas"></a>
## Subconsultas

La realización de consultas es una habilidad fundamental en el manejo de bases de datos, permitiendo a los usuarios extraer información precisa y relevante de grandes volúmenes de datos. En esta subunidad didáctica, nos adentramos en el mundo de las subconsultas, herramientas poderosas que añaden un nivel adicional de complejidad y flexibilidad a nuestras consultas.

Las subconsultas son consultas anidadas dentro de otras consultas, lo que les permite realizar operaciones más sofisticadas. Por ejemplo, podríamos tener una consulta principal que selecciona todos los empleados en un departamento específico, y una subconsulta que identifique cuáles de estos empleados tienen un salario superior a la media del departamento.

La estructura básica de una subconsulta es similar a cualquier otra consulta SQL: comenzamos con la palabra clave `SELECT`, seguida por las columnas que deseamos recuperar. A continuación, especificamos la tabla o vistas desde donde queremos obtener los datos. Finalmente, añadimos el cláusula `WHERE` para filtrar los resultados según nuestras necesidades.

Es importante destacar que una subconsulta siempre se ejecuta dentro de una consulta principal y su resultado puede ser utilizado como filtro, columna adicional o incluso como parte de la cláusula `FROM`. Esta flexibilidad es lo que hace que las subconsultas sean tan útiles en situaciones donde necesitamos realizar operaciones más complejas.

Para ilustrar cómo funcionan las subconsultas, consideremos un ejemplo práctico. Imaginemos que tenemos una base de datos de una tienda en línea y queremos identificar los productos que tienen una reseña promedio superior a 4 estrellas. Podríamos escribir la siguiente consulta:

```sql
SELECT producto_id, nombre, AVG(calificación) AS calificación_promedio
FROM reseñas
GROUP BY producto_id, nombre
HAVING AVG(calificación) > (SELECT AVG(calificación) FROM reseñas);
```

En este ejemplo, la subconsulta `(SELECT AVG(calificación) FROM reseñas)` calcula la calificación promedio general de todas las reseñas. La consulta principal luego filtra los productos cuya calificación promedio sea superior a esta media.

Las subconsultas pueden ser anidadas en múltiples niveles, lo que permite realizar operaciones aún más complejas. Por ejemplo, podríamos tener una subconsulta dentro de otra subconsulta, cada una realizando diferentes tipos de filtrado o cálculo.

Es crucial entender cómo funcionan las subconsultas y cuándo son adecuadas para usarlas. Aunque pueden añadir significativa complejidad a nuestras consultas, también pueden hacer que nuestro código sea más legible y eficiente si se usan correctamente.

En resumen, las subconsultas son una herramienta poderosa en el arsenal del programador de bases de datos. Permiten realizar operaciones más sofisticadas y flexibles, aunque requieren un buen conocimiento de la sintaxis SQL y la lógica de programación. Con práctica y experiencia, se convertirán en una habilidad esencial para cualquier profesional que trabaje con bases de datos.

<a id="combinacion-de-multiples-selecciones"></a>
## Combinación de múltiples selecciones

En el mundo de la programación y la gestión de datos, las consultas son una herramienta fundamental para extraer información relevante y estructurada. En esta subunidad didáctica, nos adentramos en la combinación de múltiples selecciones, un concepto esencial que permite a los desarrolladores realizar búsquedas más complejas y precisas.

La combinación de múltiples selecciones implica la utilización de varias condiciones en una sola consulta. Esta técnica es especialmente útil cuando necesitamos filtrar datos basados en criterios específicos, pero estos criterios son demasiado complejos para ser manejados por una única condición. Al combinar estas condiciones, podemos crear consultas que sean tanto precisas como exhaustivas.

Para ilustrar este concepto, imagina que tienes un sistema de gestión de bibliotecas. Quieres encontrar todos los libros escritos por autores españoles que hayan sido publicados después del año 2000 y que tengan una puntuación mayor a 4 estrellas. Esta tarea sería imposible de realizar con una sola condición, pero gracias a la combinación de múltiples selecciones, es una cuestión sencilla.

La sintaxis para combinar múltiples selecciones varía según el sistema o lenguaje que estés utilizando. En muchos casos, se utiliza el operador `AND` para unir varias condiciones, lo que significa que todas las condiciones deben ser verdaderas para que la consulta devuelva un resultado. Sin embargo, también existe el operador `OR`, que permite que al menos una de las condiciones sea verdadera.

Es importante recordar que la combinación de múltiples selecciones no solo aumenta la precisión de las consultas, sino que también puede afectar su rendimiento. Por lo tanto, es crucial optimizar estas consultas para asegurar que se ejecuten eficientemente incluso con grandes conjuntos de datos.

Además de `AND` y `OR`, existen otros operadores que pueden utilizarse para combinar múltiples selecciones. El operador `NOT`, por ejemplo, permite negar una condición, lo que es útil cuando queremos encontrar todos los registros que no cumplen con un cierto criterio. También hay operadores como `IN` y `BETWEEN`, que permiten seleccionar valores dentro de un rango o en una lista específica.

La combinación de múltiples selecciones también puede utilizarse para realizar consultas más complejas, como las subconsultas. Una subconsulta es una consulta anidada dentro de otra consulta principal. Esta técnica es especialmente útil cuando necesitamos utilizar el resultado de una consulta secundaria en la condición de una consulta principal.

En resumen, la combinación de múltiples selecciones es un poderoso recurso que permite a los desarrolladores realizar consultas más complejas y precisas. Aunque puede aumentar el rendimiento de las consultas, también requiere una comprensión sólida del sistema o lenguaje utilizado para su implementación. Con práctica y experiencia, este concepto se convertirá en una herramienta esencial en tu arsenal de programador.

<a id="optimizacion-de-consultas"></a>
## Optimización de consultas

La optimización de consultas es una etapa crucial en el desarrollo eficiente de aplicaciones que interactúan con bases de datos. Este proceso busca mejorar la velocidad y eficiencia de las operaciones de consulta, reduciendo tiempos de respuesta y minimizando el uso de recursos. Comenzamos por entender que cada consulta a una base de datos es un viaje por su estructura interna, donde los motores de bases de datos buscan y recuperan los datos solicitados.

El primer paso en la optimización de consultas es conocer las características de tu base de datos y cómo se organiza. Esto implica entender el modelo relacional utilizado, las tablas involucradas, las claves primarias y foráneas, así como los índices que han sido creados para mejorar el acceso a los datos. Con esta información en mente, podemos identificar consultas que podrían estar realizando búsquedas innecesariamente amplias o recorriendo grandes cantidades de registros.

Una técnica fundamental es la proyección selectiva, donde se especifican solo las columnas necesarias en una consulta. Esto no solo reduce el volumen de datos transferidos entre el servidor y el cliente, sino que también minimiza el tiempo necesario para procesar los resultados. Además, la selección precisa de registros mediante cláusulas WHERE es crucial; cuanto más específica sea esta selección, menos registros se tendrán que examinar.

La optimización también implica la utilización de índices de manera inteligente. Los índices son estructuras de datos que permiten buscar rápidamente los registros en una base de datos. Sin embargo, su creación y mantenimiento requieren recursos adicionales. Por lo tanto, es necesario equilibrar el uso de índices para mejorar la velocidad de consulta con el costo de su creación y actualización.

La estructura de las consultas también juega un papel importante en su eficiencia. Las consultas que utilizan operadores como JOINs pueden ser especialmente costosas si no están optimizadas correctamente. En estos casos, es recomendable utilizar índices compuestos o reorganizar la consulta para minimizar el número de tablas involucradas.

Además, la optimización de consultas implica considerar las técnicas de almacenamiento y recuperación de datos. Por ejemplo, si una tabla se actualiza frecuentemente, es posible que sea más eficiente almacenar los datos en un formato que permita una rápida modificación. En contraste, si los datos son menos modificados, un formato optimizado para la lectura podría ser preferible.

La optimización de consultas también debe considerar el uso de subconsultas y composiciones internas. Estos métodos pueden mejorar la eficiencia al reducir el número de operaciones que se realizan en la base de datos. Sin embargo, es crucial evaluar cuidadosamente su impacto en el rendimiento total del sistema.

La optimización de consultas no se limita a técnicas internas; también implica considerar el contexto general de la aplicación y las necesidades del usuario final. Consultas que son eficientes en un entorno específico pueden ser ineficientes en otro, dependiendo de factores como la carga de trabajo, la disponibilidad de recursos y los patrones de acceso a los datos.

En conclusión, la optimización de consultas es una habilidad clave para desarrolladores de software que trabajan con bases de datos. A través del conocimiento profundo de las características de la base de datos, la selección inteligente de técnicas de consulta y el equilibrio entre velocidad y recursos, se pueden crear aplicaciones más eficientes y responsivas. Este proceso requiere una comprensión profunda de los principios de diseño de bases de datos y un enfoque meticuloso en la evaluación y mejora continua del rendimiento de las consultas.

<a id="ejercicio-de-final-de-unidad-2"></a>
## Ejercicio de final de unidad

### actividad

```markdown

```


<a id="tratamiento-de-datos"></a>
# Tratamiento de datos

<a id="insercion-borrado-y-modificacion-de-registros"></a>
## Inserción, borrado y modificación de registros

En el vasto mundo de la programación y la gestión de datos, el tratamiento de registros es una tarea fundamental que requiere un profundo conocimiento y habilidad. Esta subunidad didáctica nos guía a través del proceso de inserción, borrado y modificación de registros en las bases de datos, dos operaciones cruciales para mantener los datos actualizados y precisos.

La inserción de registros es el primer paso en la gestión de datos. Consiste en agregar nuevos elementos a una base de datos existente. Este proceso requiere un entendimiento profundo del modelo de datos utilizado y la estructura de las tablas donde se almacenarán los datos. La correcta inserción de registros garantiza que la información esté disponible para su consulta y análisis, lo cual es esencial en cualquier sistema informático.

El borrado de registros es otro aspecto fundamental del tratamiento de datos. Este proceso implica eliminar elementos existentes de una base de datos, lo cual puede ser necesario cuando se quieren limpiar los datos obsoletos o incorrectos. El borrado debe realizarse con precaución para evitar la pérdida accidental de información valiosa. La implementación correcta del borrado de registros ayuda a mantener la integridad y consistencia de la base de datos.

La modificación de registros es un proceso que permite actualizar los datos existentes en una base de datos. Este proceso es crucial cuando se requiere cambiar la información de un registro debido a cambios en las circunstancias o en la información misma. La correcta modificación de registros garantiza que la información siempre esté actualizada y precisa, lo cual es fundamental para cualquier sistema informático.

La inserción, borrado y modificación de registros son operaciones complejas que requieren un buen conocimiento del lenguaje de consulta utilizado en la base de datos. En esta subunidad didáctica, aprenderemos a realizar estas operaciones con precisión y eficiencia, utilizando los comandos adecuados del lenguaje de consulta.

La inserción de registros se realiza mediante el comando INSERT INTO, seguido del nombre de la tabla y una lista de valores correspondientes a las columnas. Es importante asegurarse de que los valores insertados sean correctos y cumplen con las restricciones definidas en la base de datos.

El borrado de registros se realiza mediante el comando DELETE FROM, seguido del nombre de la tabla y una cláusula WHERE que especifica qué registros deben ser eliminados. Es importante tener cuidado al usar esta operación, ya que no hay forma de recuperar los registros eliminados a menos que se haya implementado un sistema de copias de seguridad.

La modificación de registros se realiza mediante el comando UPDATE, seguido del nombre de la tabla y una cláusula SET que especifica qué valores deben ser actualizados. La cláusula WHERE es necesaria para identificar los registros que deben ser modificados. Es importante asegurarse de que solo se actualicen los registros deseados para evitar errores.

La inserción, borrado y modificación de registros son operaciones fundamentales en la gestión de datos. Aprender a realizar estas operaciones con precisión es crucial para cualquier programador o administrador de sistemas informáticos. En esta subunidad didáctica, aprenderemos a realizar estas operaciones con eficiencia y precisión, utilizando los comandos adecuados del lenguaje de consulta.

La inserción, borrado y modificación de registros son operaciones complejas que requieren un buen conocimiento del lenguaje de consulta utilizado en la base de datos. En esta subunidad didáctica, aprenderemos a realizar estas operaciones con precisión y eficiencia, utilizando los comandos adecuados del lenguaje de consulta.

La inserción, borrado y modificación de registros son operaciones fundamentales en la gestión de datos. Aprender a realizar estas operaciones con precisión es crucial para cualquier programador o administrador de sistemas informáticos. En esta subunidad didáctica, aprenderemos a realizar estas operaciones con eficiencia y precisión, utilizando los comandos adecuados del lenguaje de consulta.

La inserción, borrado y modificación de registros son operaciones complejas que requieren un buen conocimiento del lenguaje de consulta utilizado en la base de datos. En esta subunidad didáctica, aprenderemos a realizar estas operaciones con precisión y eficiencia, utilizando los comandos adecuados del lenguaje de consulta.

La inserción, borrado y modificación de registros son operaciones fundamentales en la gestión de datos. Aprender a realizar estas operaciones con precisión es crucial para cualquier programador o administrador de sistemas informáticos. En esta subunidad didáctica, aprenderemos a realizar estas operaciones con eficiencia y precisión, utilizando los comandos adecuados del lenguaje de consulta.

La inserción, borrado y modificación de registros son operaciones complejas que requieren un buen conocimiento del lenguaje de consulta utilizado en la base de datos. En esta subunidad didáctica, aprenderemos a realizar estas operaciones con precisión y eficiencia, utilizando los comandos adecuados del lenguaje de consulta.

La inserción, borrado y modificación de registros son operaciones fundamentales en la gestión de datos. Aprender a realizar estas operaciones con precisión es crucial para cualquier programador o administrador de sistemas informáticos. En esta subunidad didáctica, aprenderemos a realizar estas operaciones con eficiencia y precisión, utilizando los comandos adecuados del lenguaje de consulta.

### Modelo CRUD

```markdown
El modelo CRUD explica el 99% del trabajo diario con las bases de datos
Tu creas una tabla una vez, y no estás creando tablas nuevas todos los dias

En todo momento, en el 99% de tu tiempo, estás realizando 4 operaciones
C Create
R Read
U Update
D Delete

Verbos SQL:

C Create - INSERT
R Read - SELECT
U Update - UPDATE
D Delete - DELETE
```

### insercion

```sql
INSERT INTO 
clientes 
VALUES
  ( 
    NULL,
    'Nombre del nuevo cliente',
    'Apellidos del nuevo cliente',
    '620891718',
    'info@jocarsa.com',
    'localidad del nuevo cliente'
   );
```

### que pasa si ponemos un campo de menos

```sql
INSERT INTO 
clientes 
VALUES
  ( 
    NULL,
    'Nombre del nuevo cliente',
    'Apellidos del nuevo cliente',
    '620891718',
    'info@jocarsa.com'
   );
```

### que pasa si pongo un campo de mas

```sql
INSERT INTO 
clientes 
VALUES
  ( 
    NULL,
    'Nombre del nuevo cliente',
    'Apellidos del nuevo cliente',
    '620891718',
    'info@jocarsa.com',
    'localidad del nuevo cliente',
    'campo que me invento'
   );
```

### columnas nombradas

```sql
ALTER TABLE `clientes` CHANGE `telefono` `telefono` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL;
ALTER TABLE `clientes` CHANGE `email` `email` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL;
ALTER TABLE `clientes` CHANGE `localidad` `localidad` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL;


INSERT INTO 
clientes (nombre,apellidos)
VALUES
  ( 
    'Nombre del nuevo cliente',
    'Apellidos del nuevo cliente'
   );
```

### modificacion de registros

```sql
UPDATE
clientes
SET 
nombre = "Jose Vicente";
-- Cuidado porque esto actualiza TODA la tabla de clientes
```

### modificacion con un where

```sql
UPDATE
clientes
SET 
nombre = "Jose Vicente"
WHERE
telefono = 620891718;
```

### eliminar registros

```sql
DELETE FROM
clientes;
-- Nunca ejecutéis esto
```

### eliminacion con condiciones

```sql
DELETE FROM
clientes
WHERE telefono = '620891718';
```

### copia de seguridad de base de datos

```sql
josevicente@josevicenteportatil:~$ cd Escritorio/
josevicente@josevicenteportatil:~/Escritorio$ mkdir micopiadeseguridad
josevicente@josevicenteportatil:~/Escritorio$ cd copiadeseguridad

josevicente@josevicenteportatil:~/Escritorio/micopiadeseguridad$ mysqldump -u   usuarioempresarial -p empresarial > copia_de_seguridad_empresarial.sql
Enter password: 
mysqldump: Error: 'Access denied; you need (at least one of) the PROCESS privilege(s) for this operation' when trying to dump tablespaces


GRANT PROCESS ON *.* TO 'usuarioempresarial'@'localhost';
FLUSH PRIVILEGES

mysqldump -u 	usuarioempresarial -p empresarial > copia_de_seguridad_empresarial.sql

mysqldump = comando 
-u = te voy a pasar un usuario
usuarioempresarial = el usuario que se va a utilizar 
-p = te voy a pedir la contraseña 
empresarial = nombre de la base de datos 
> = lo va a volcar en un archivo externo 
copia_de_seguridad_empresarial.sql = nombre del archivo de copia de seguridad
```

<a id="integridad-referencial"></a>
## Integridad referencial

En el mundo digital de la programación, las bases de datos son como los cerebros de nuestras aplicaciones. Son donde almacenamos y gestionamos toda la información relevante, permitiendo que nuestros programas interactúen eficientemente con ella. En esta sección, nos adentramos en un aspecto crucial pero a menudo subestimado del manejo de bases de datos: la integridad referencial.

La integridad referencial es una regla fundamental que asegura la consistencia y coherencia de los datos almacenados en las tablas de una base de datos. Esta propiedad se basa en el concepto de que cualquier relación entre dos o más tablas debe mantenerse, es decir, si un valor en una tabla se modifica o elimina, todos los registros relacionados deben ser actualizados o eliminados de manera coherente.

Imagina que tienes una biblioteca digital. Cada libro tiene un autor asociado. La integridad referencial garantiza que si cambias el nombre del autor de un libro, todos los demás libros atribuidos a ese autor también se actualicen automáticamente. De lo contrario, podrías tener inconsistencias en tu base de datos, donde algunos libros tienen el nombre del autor correcto y otros no.

Esta regla es especialmente importante cuando hablamos de relaciones entre tablas. Por ejemplo, si tienes una tabla de "Pedidos" que está relacionada con una tabla de "Clientes", la integridad referencial asegura que cada pedido esté asociado a un cliente válido existente en la base de datos. Si intentas crear un pedido para un cliente que no existe, el sistema debe rechazar esta operación y mostrar un error.

La implementación de la integridad referencial se realiza mediante restricciones en las tablas de la base de datos. Estas restricciones pueden ser de varios tipos:

1. **Restricciones de clave foránea**: Estas aseguran que los valores en una columna (o conjunto de columnas) de una tabla sean presentes en otra tabla relacionada. Por ejemplo, si tienes una columna "ClienteID" en la tabla "Pedidos", esta columna debe contener solo valores que existan en la columna "ClienteID" de la tabla "Clientes".

2. **Restricciones de clave única**: Estas aseguran que los valores en una columna (o conjunto de columnas) sean únicos dentro de esa tabla. Por ejemplo, si tienes una columna "Email" en la tabla "Clientes", esta columna debe contener solo valores únicos.

3. **Restricciones de nulidad**: Estas aseguran que ciertas columnas no puedan contener valores nulos (NULL). Esto es útil para campos que siempre deben tener un valor, como el nombre del cliente o la dirección de envío.

La importancia de la integridad referencial no se puede subestimar. Aunque a menudo parece una preocupación técnica, en realidad afecta directamente la confiabilidad y la eficiencia de nuestras aplicaciones. Un sistema sin integridad referencial es como un edificio con pilares que están desalineados: puede parecer funcional en el momento, pero está en peligro de colapsar.

Además, al implementar la integridad referencial correctamente, podemos aprovechar las ventajas de los sistemas gestores de bases de datos (DBMS) que ofrecen características avanzadas como cascada de eliminación y actualización. Estas características permiten que el sistema automáticamente maneje cambios en una tabla y refleje esos cambios en todas las tablas relacionadas, lo que ahorra tiempo y reduce errores humanos.

En resumen, la integridad referencial es un concepto fundamental en el manejo de bases de datos. Es la base sobre la cual se construyen relaciones sólidas entre los diferentes conjuntos de datos almacenados. Al entender y aplicar correctamente esta regla, podemos crear sistemas de información robustos y confiables que respalden nuestras aplicaciones con precisión y eficiencia.

Esta comprensión es crucial no solo para desarrolladores experimentados, sino también para principiantes en el campo. A medida que avanzamos en nuestra carrera como programadores, nos encontraremos con situaciones cada vez más complejas donde la integridad referencial será un factor clave en la diseño y gestión de nuestras bases de datos.

Así que, si quieres construir aplicaciones confiables y eficientes, asegúrate de entender y aplicar la integridad referencial. Es una habilidad esencial que te permitirá crear sistemas de información sólidos y duraderos.

### intento de eliminar cliente 12

```markdown
¿Realmente desea ejecutar "DELETE FROM clientes WHERE `clientes`.`Identificador` = 12"?

Resultado:

#1451 - Cannot delete or update a parent row: a foreign key constraint fails (`empresarial`.`pedidos`, CONSTRAINT `pedidosaclientes` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`Identificador`) ON DELETE RESTRICT ON UPDATE RESTRICT)

# Si me meto en el foreign key, 
ON DELETE = RESTRICT
ON UPDATE = RESTRICT

Propagar la eliminación

ON DELETE = CASCADE
ON UPDATE = CASCADE

ALTER TABLE `lineaspedido` DROP FOREIGN KEY `lineapedidoapedido`; ALTER TABLE `lineaspedido` ADD CONSTRAINT `lineapedidoapedido` FOREIGN KEY (`pedidos_id`) REFERENCES `pedidosconlineas`(`Identificador`) ON DELETE CASCADE ON UPDATE CASCADE; ALTER TABLE `lineaspedido` DROP FOREIGN KEY `lineaspedidoaproductos`; ALTER TABLE `lineaspedido` ADD CONSTRAINT `lineaspedidoaproductos` FOREIGN KEY (`producto_id`) REFERENCES `productos`(`Identificador`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `pedidos` DROP FOREIGN KEY `pedidosaclientes`; ALTER TABLE `pedidos` ADD CONSTRAINT `pedidosaclientes` FOREIGN KEY (`id_cliente`) REFERENCES `clientes`(`Identificador`) ON DELETE CASCADE ON UPDATE CASCADE; ALTER TABLE `pedidos` DROP FOREIGN KEY `pedidosaproductos`; ALTER TABLE `pedidos` ADD CONSTRAINT `pedidosaproductos` FOREIGN KEY (`id_producto`) REFERENCES `productos`(`Identificador`) ON DELETE CASCADE ON UPDATE CASCADE;
```

### Opciones de integridad referencial

```markdown
Opciones:

CASCADE: Si eliminas el registro dependiente, se eliminan en cascada todos los que lo usan (MUCHO CUIDADOOOOOOO!!!). Esta es la opción más segura, pero si se te va la mano te puedes cargar la base de datos entera.

RESTRICT: No puedes eliminar un registro, porque entonces eliminarías todos los hijos. Si quieres, primero elimina los hijos, y luego el registro original. Esta es la opción por defecto, pero es muy restrictiva y no te deja eliminar en un futuro.

NULL: Inserta valores NULL en los registros hijos (no se eliminan, pero se inserta un vacio)

NO ACTION: No ejecutes ninguna acción
```

### copia de seguridad

```markdown
mysqldump -u 	usuarioempresarial -p empresarial > copia_de_seguridad_empresarial.sql
```

### copia de seguridad pero con contraseña

```markdown
mysqldump -u usuarioempresarial -p'usuarioempresarial' empresarial > copia_de_seguridad_empresarial.sql
```

### copia de seguridad con python

```python
import subprocess

usuario = "usuarioempresarial"
password = "usuarioempresarial"
base_datos = "empresarial"
archivo_salida = "copia_de_seguridad.sql"

comando = [
    "mysqldump",
    f"-u{usuario}",
    f"-p{password}",
    base_datos
]

with open(archivo_salida, "w") as salida:
    subprocess.run(comando, stdout=salida, check=True)

print(f"Copia de seguridad creada en {archivo_salida}")
```

### copia con fecha

```python
import subprocess
from datetime import datetime

ahora = datetime.now()

anio = ahora.year.zfill(2)
mes = ahora.month.zfill(2)
dia = ahora.day.zfill(2)
hora = ahora.hour.zfill(2)
minuto = ahora.minute.zfill(2)
segundo = ahora.second.zfill(2)

usuario = "usuarioempresarial"
password = "usuarioempresarial"
base_datos = "empresarial"
archivo_salida = str(anio)+str(mes)+str(dia)+str(hora)+str(minuto)+str(segundo)+"_copia_de_seguridad.sql"

comando = [
    "mysqldump",
    f"-u{usuario}",
    f"-p{password}",
    base_datos
]

with open(archivo_salida, "w") as salida:
    subprocess.run(comando, stdout=salida, check=True)

print(f"Copia de seguridad creada en {archivo_salida}")
```

### zerofill

```python
import subprocess
from datetime import datetime

ahora = datetime.now()

anio = str(ahora.year).zfill(4)
mes = str(ahora.month).zfill(2)
dia = str(ahora.day).zfill(2)
hora = str(ahora.hour).zfill(2)
minuto = str(ahora.minute).zfill(2)
segundo = str(ahora.second).zfill(2)

usuario = "usuarioempresarial"
password = "usuarioempresarial"
base_datos = "empresarial"
archivo_salida = str(anio)+str(mes)+str(dia)+str(hora)+str(minuto)+str(segundo)+"_copia_de_seguridad.sql"

comando = [
    "mysqldump",
    f"-u{usuario}",
    f"-p{password}",
    base_datos
]

with open(archivo_salida, "w") as salida:
    subprocess.run(comando, stdout=salida, check=True)

print(f"Copia de seguridad creada en {archivo_salida}")
```

### cron

```markdown
crontab -e
```

### Caso ZIP

```markdown
ZIP = 
Mejoramos el uso de espacio en disco (dependiendo de lo que se comprima)
Perdemos acceso directo al archivo
Si lo queremos usar, tenemos que abrir (descomprimir), acceder, y cerrar = tiempo de carga mas lento

NoZIP:
El uso de espacio en disco es mayor
Pero el acceso al archivo es mas directo = mejores tasas de velocidad

En linux, instalar zip:
sudo apt install zip
```

### ahora comprimir

```python
import subprocess
from datetime import datetime
import zipfile
import os

ahora = datetime.now()

anio = str(ahora.year).zfill(4)
mes = str(ahora.month).zfill(2)
dia = str(ahora.day).zfill(2)
hora = str(ahora.hour).zfill(2)
minuto = str(ahora.minute).zfill(2)
segundo = str(ahora.second).zfill(2)

usuario = "usuarioempresarial"
password = "usuarioempresarial"
base_datos = "empresarial"
archivo_salida = f"{anio}{mes}{dia}{hora}{minuto}{segundo}_copia_de_seguridad.sql"
archivo_zip = archivo_salida.replace(".sql", ".zip")

comando = [
    "mysqldump",
    f"-u{usuario}",
    f"-p{password}",
    base_datos
]

# Crear la copia SQL
with open(archivo_salida, "w") as salida:
    subprocess.run(comando, stdout=salida, check=True)

print(f"Copia de seguridad creada en {archivo_salida}")

# Comprimir a ZIP
with zipfile.ZipFile(archivo_zip, "w", zipfile.ZIP_DEFLATED) as zipf:
    zipf.write(archivo_salida)

print(f"Copia comprimida en {archivo_zip}")

# (Opcional) eliminar el SQL y dejar solo el ZIP
# os.remove(archivo_salida)
```

### y borrar el sql

```python
import subprocess
from datetime import datetime
import zipfile
import os

ahora = datetime.now()

anio = str(ahora.year).zfill(4)
mes = str(ahora.month).zfill(2)
dia = str(ahora.day).zfill(2)
hora = str(ahora.hour).zfill(2)
minuto = str(ahora.minute).zfill(2)
segundo = str(ahora.second).zfill(2)

usuario = "usuarioempresarial"
password = "usuarioempresarial"
base_datos = "empresarial"
archivo_salida = f"{anio}{mes}{dia}{hora}{minuto}{segundo}_copia_de_seguridad.sql"
archivo_zip = archivo_salida.replace(".sql", ".zip")

comando = [
    "mysqldump",
    f"-u{usuario}",
    f"-p{password}",
    base_datos
]

# Crear la copia SQL
with open(archivo_salida, "w") as salida:
    subprocess.run(comando, stdout=salida, check=True)

print(f"Copia de seguridad creada en {archivo_salida}")

# Comprimir a ZIP
with zipfile.ZipFile(archivo_zip, "w", zipfile.ZIP_DEFLATED) as zipf:
    zipf.write(archivo_salida)

# Eliminar el SQL y dejar solo el ZIP
os.remove(archivo_salida)

print(f"Copia comprimida en {archivo_zip} (se eliminó el SQL)")
```

### Motores de MySQL instalados

```markdown
Motores de MySQL:

Actual: InnoDB
https://dev.mysql.com/doc/refman/8.4/en/innodb-storage-engine.html
Alternativos:
https://dev.mysql.com/doc/refman/8.4/en/storage-engines.html

InnoDB:
Es el motor por defecto
Tiene cell level locking
Esto quiere decir que solo se bloquea una celda, no se bloquea, ni la fila entera, ni la tabla entera
Es un motor que tiene un rendimiento muy bueno, y se considera el motor por defecto para todo

Archive:
Le aplica compresión a la tabla sobre la cual lo apliquemos (similar a ZIP)
tiempos de acceso mucho mas lentos
pero tambien menor uso de espacio en disco
Es el motor apropiado para tablas de copia de seguridad, logs, etc

Blackhole
Todo lo que se acerque a esta tabla, desaparece
Hay algunas veces en las que para meter un dato en una tabla tienes que meter un dato obligatoriamente en otra tabla (pero te sobra), la tabla blackhole viene bien para que ese que dato que sobra desaparezca automaticamente.

Merge MyISAM
Cuando tienes bases de datos TAN grandes que no te caben en un solo ordenador, las puedes dividir en varios servidores
Este motor nos permite dividir tablas en varios servidores PERO que se comporten como una sola tabla (MySQL Cluster)

MyISAM
Es el antiguo motor por defecto en MySQL, tiene row-level-locking lo que quiere decir que cuando alguien accede a un registro, se bloquea todo el registro. Existe en MySQL por retrocompatibilidad

Memory
Lo guarda todo, en lugar de en el disco duro, en la RAM
Tiempos de acceso mucho menores, velocidad mucho mayor
Recomendado para chats o videojuegos
Pero es peligroso porque si se va la luz, se borra todo
Hay tecnicas mixtas para copiar cada X minutos el contenido de una tabla memory en otra tabla de seguridad (InnoDB)

CSV
Comma Separated Values
Permite guardar los datos en archivos CSV estandar
Mucho mas compatibles, pero mucho menor rendimiento
No soportan claves, no soportan restricciones
Table level locking
Si el sistema explota, puedes recuperar los datos directamente
```

### Instalacion de MySQL

```markdown
Instalación:

Yo recomiendo el XAMPP, por que lleva:
1.-MySQL Server
2.-phpMyAdmin como cliente sobre Apache

Otra forma de instalacion

Recomiendo instalación Full:
1.-MySQL server
2.-MySQL Workbench
```

### creo cron

```markdown
crontab -e

* * * * * /usr/bin/python3 "/var/www/html/dam2526/Primero/Bases de datos/004-Tratamiento de datos/002-Integridad referencial/101-Ejercicios/backup.py" >> "/var/www/html/dam2526/Primero/Bases de datos/004-Tratamiento de datos/002-Integridad referencial/101-Ejercicios/backup.log" 2>&1
```

### aplicacion mysql

```python
print("Escoge una opcion:")
print("1.-Insertar un cliente")
print("2.-Listar los clientes")
print("3.-Actualizar un cliente")
print("4.-Borrar un cliente")
opcion = int(input("Escoge tu opción"))
```

### tratamos las opciones

```python
print("Escoge una opcion:")
print("1.-Insertar un cliente")
print("2.-Listar los clientes")
print("3.-Actualizar un cliente")
print("4.-Borrar un cliente")
opcion = int(input("Escoge tu opción"))

if opcion == 1:
  print("Insertamos un cliente")
elif opcion == 2:
  print("Listamos los clientes")
elif opcion == 3:
  print("Actualizamos un cliente")
elif opcion == 4:
  print("Eliminamos un cliente")
```

### nos conectamos a MySQL

```python
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

print("Escoge una opcion:")
print("1.-Insertar un cliente")
print("2.-Listar los clientes")
print("3.-Actualizar un cliente")
print("4.-Borrar un cliente")
opcion = int(input("Escoge tu opción"))

if opcion == 1:
  print("Insertamos un cliente")
elif opcion == 2:
  print("Listamos los clientes")
elif opcion == 3:
  print("Actualizamos un cliente")
elif opcion == 4:
  print("Eliminamos un cliente")
```

### Desarrollo la parte de insercion de cliente

```python
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

print("Escoge una opcion:")
print("1.-Insertar un cliente")
print("2.-Listar los clientes")
print("3.-Actualizar un cliente")
print("4.-Borrar un cliente")
opcion = int(input("Escoge tu opción"))

if opcion == 1:
  print("Insertamos un cliente")
  nombre = input("Introduce el nombre del cliente")
  apellidos = input("Introduce los apellidos del cliente")
  telefono = input("Introduce el telefono del cliente")
  email = input("Introduce el email del cliente")
  localidad = input("Introduce la localidad del cliente")
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
elif opcion == 2:
  print("Listamos los clientes")
elif opcion == 3:
  print("Actualizamos un cliente")
elif opcion == 4:
  print("Eliminamos un cliente")
  
  
cursor.close() 

conexion.close()
```

### me aseguro

```python
import mysql.connector

conexion = mysql.connector.connect(
    host="localhost",      
    user="usuarioempresarial",    
    password="usuarioempresarial",  
    database="empresarial"      
)

cursor = conexion.cursor()

print("Escoge una opcion:")
print("1.-Insertar un cliente")
print("2.-Listar los clientes")
print("3.-Actualizar un cliente")
print("4.-Borrar un cliente")
opcion = int(input("Escoge tu opción"))

if opcion == 1:
  print("Insertamos un cliente")
  nombre = input("Introduce el nombre del cliente")
  apellidos = input("Introduce los apellidos del cliente")
  telefono = input("Introduce el telefono del cliente")
  email = input("Introduce el email del cliente")
  localidad = input("Introduce la localidad del cliente")
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
elif opcion == 2:
  print("Listamos los clientes")
elif opcion == 3:
  print("Actualizamos un cliente")
elif opcion == 4:
  print("Eliminamos un cliente")
  
  
cursor.close() 

conexion.close()
```

### arranco un bucle infinito

```python
import mysql.connector

conexion = mysql.connector.connect(
    host="localhost",      
    user="usuarioempresarial",    
    password="usuarioempresarial",  
    database="empresarial"      
)

cursor = conexion.cursor()
while True:
  print("Escoge una opcion:")
  print("1.-Insertar un cliente")
  print("2.-Listar los clientes")
  print("3.-Actualizar un cliente")
  print("4.-Borrar un cliente")
  opcion = int(input("Escoge tu opción"))

  if opcion == 1:
    print("Insertamos un cliente")
    nombre = input("Introduce el nombre del cliente: ")
    apellidos = input("Introduce los apellidos del cliente: ")
    telefono = input("Introduce el telefono del cliente: ")
    email = input("Introduce el email del cliente: ")
    localidad = input("Introduce la localidad del cliente: ")
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
  elif opcion == 2:
    print("Listamos los clientes")
    
  elif opcion == 3:
    print("Actualizamos un cliente")
  elif opcion == 4:
    print("Eliminamos un cliente")
  
  
cursor.close() 

conexion.close()
```

### Listado de clientes

```python
import mysql.connector

conexion = mysql.connector.connect(
    host="localhost",      
    user="usuarioempresarial",    
    password="usuarioempresarial",  
    database="empresarial"      
)

cursor = conexion.cursor()
while True:
  print("Escoge una opcion:")
  print("1.-Insertar un cliente")
  print("2.-Listar los clientes")
  print("3.-Actualizar un cliente")
  print("4.-Borrar un cliente")
  opcion = int(input("Escoge tu opción"))

  if opcion == 1:
    print("Insertamos un cliente")
    nombre = input("Introduce el nombre del cliente: ")
    apellidos = input("Introduce los apellidos del cliente: ")
    telefono = input("Introduce el telefono del cliente: ")
    email = input("Introduce el email del cliente: ")
    localidad = input("Introduce la localidad del cliente: ")
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
  elif opcion == 2:
    print("Listamos los clientes")
    cursor.execute("SELECT * FROM clientes")
    resultados = cursor.fetchall()
    for fila in resultados:
      print(fila)
  elif opcion == 3:
    print("Actualizamos un cliente")
  elif opcion == 4:
    print("Eliminamos un cliente")
  
  
cursor.close() 

conexion.close()
```

### Desarrollamos la parte de la eliminacion

```python
import mysql.connector

conexion = mysql.connector.connect(
    host="localhost",      
    user="usuarioempresarial",    
    password="usuarioempresarial",  
    database="empresarial"      
)

cursor = conexion.cursor()
while True:
  print("Escoge una opcion:")
  print("1.-Insertar un cliente")
  print("2.-Listar los clientes")
  print("3.-Actualizar un cliente")
  print("4.-Borrar un cliente")
  opcion = int(input("Escoge tu opción"))

  if opcion == 1:
    print("Insertamos un cliente")
    nombre = input("Introduce el nombre del cliente: ")
    apellidos = input("Introduce los apellidos del cliente: ")
    telefono = input("Introduce el telefono del cliente: ")
    email = input("Introduce el email del cliente: ")
    localidad = input("Introduce la localidad del cliente: ")
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
  elif opcion == 2:
    print("Listamos los clientes")
    cursor.execute("SELECT * FROM clientes")
    resultados = cursor.fetchall()
    for fila in resultados:
      print(fila)
  elif opcion == 3:
    print("Actualizamos un cliente")
  elif opcion == 4:
    print("Eliminamos un cliente")
    id = input("Introduce el id del cliente que quieres eliminar: ")
    cursor.execute('''
      DELETE FROM clientes
      WHERE Identificador = '''+id+'''
    ''')
    conexion.commit()
  
  
cursor.close() 

conexion.close()
```

### backup

```
mysqldump: [Warning] Using a password on the command line interface can be insecure.
Copia de seguridad creada en /var/www/html/dam2526/Primero/Bases de datos/004-Tratamiento de datos/002-Integridad referencial/101-Ejercicios/20251002174737_copia_de_seguridad.sql
Copia comprimida en /var/www/html/dam2526/Primero/Bases de datos/004-Tratamiento de datos/002-Integridad referencial/101-Ejercicios/20251002174737_copia_de_seguridad.zip (se eliminó el SQL)
mysqldump: [Warning] Using a password on the command line interface can be insecure.
Copia de seguridad creada en /var/www/html/dam2526/Primero/Bases de datos/004-Tratamiento de datos/002-Integridad referencial/101-Ejercicios/20251002174801_copia_de_seguridad.sql
Copia comprimida en /var/www/html/dam2526/Primero/Bases de datos/004-Tratamiento de datos/002-Integridad referencial/101-Ejercicios/20251002174801_copia_de_seguridad.zip (se eliminó el SQL)
mysqldump: [Warning] Using a password on the command line interface can be insecure.
Copia de seguridad creada en /var/www/html/dam2526/Primero/Bases de datos/004-Tratamiento de datos/002-Integridad referencial/101-Ejercicios/20251002174901_copia_de_seguridad.sql
Copia comprimida en /var/www/html/dam2526/Primero/Bases de datos/004-Tratamiento de datos/002-Integridad referencial/101-Ejercicios/20251002174901_copia_de_seguridad.zip (se eliminó el SQL)
mysqldump: [Warning] Using a password on the command line interface can be insecure.
Copia de seguridad creada en /var/www/html/dam2526/Primero/Bases de datos/004-Tratamiento de datos/002-Integridad referencial/101-Ejercicios/20251002175001_copia_de_seguridad.sql
Copia comprimida en /var/www/html/dam2526/Primero/Bases de datos/004-Tratamiento de datos/002-Integridad referencial/101-Ejercicios/20251002175001_copia_de_seguridad.zip (se eliminó el SQL)
```

### backup

```python
#!/usr/bin/env python3
import subprocess
from datetime import datetime
import zipfile
import os

# Ruta absoluta de la carpeta
BASE_DIR = "/var/www/html/dam2526/Primero/Bases de datos/004-Tratamiento de datos/002-Integridad referencial/101-Ejercicios"

ahora = datetime.now()

anio = str(ahora.year).zfill(4)
mes = str(ahora.month).zfill(2)
dia = str(ahora.day).zfill(2)
hora = str(ahora.hour).zfill(2)
minuto = str(ahora.minute).zfill(2)
segundo = str(ahora.second).zfill(2)

usuario = "usuarioempresarial"
password = "usuarioempresarial"
base_datos = "empresarial"
archivo_salida = os.path.join(BASE_DIR, f"{anio}{mes}{dia}{hora}{minuto}{segundo}_copia_de_seguridad.sql")
archivo_zip = archivo_salida.replace(".sql", ".zip")

comando = [
    "mysqldump",
    f"-u{usuario}",
    f"-p{password}",
    base_datos
]

# Crear la copia SQL
with open(archivo_salida, "w") as salida:
    subprocess.run(comando, stdout=salida, check=True)

print(f"Copia de seguridad creada en {archivo_salida}")

# Comprimir a ZIP
with zipfile.ZipFile(archivo_zip, "w", zipfile.ZIP_DEFLATED) as zipf:
    zipf.write(archivo_salida, os.path.basename(archivo_salida))

# Eliminar el SQL y dejar solo el ZIP
os.remove(archivo_salida)

print(f"Copia comprimida en {archivo_zip} (se eliminó el SQL)")
```

### copia_de_seguridad

```sql
-- MySQL dump 10.13  Distrib 8.0.43, for Linux (x86_64)
--
-- Host: localhost    Database: empresarial
-- ------------------------------------------------------
-- Server version	8.0.43-0ubuntu0.24.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `Identificador` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `telefono` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `localidad` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`Identificador`),
  CONSTRAINT `chk_email_format` CHECK (regexp_like(`email`,_utf8mb4'^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,}$')),
  CONSTRAINT `chk_telefono_length` CHECK ((char_length(`telefono`) = 9))
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Carlos','García López','612345678','carlos.garcia@example.com','Valencia'),(2,'María','Martínez Fernández','623456789','maria.martinez@example.com','Valencia'),(3,'José','Rodríguez Sánchez','634567890','jose.rodriguez@example.com','Madrid'),(4,'Laura','Gómez Díaz','645678901','laura.gomez@example.com','Madrid'),(5,'Antonio','Fernández Ruiz','656789012','antonio.fernandez@example.com','Madrid'),(6,'Ana','López Jiménez','667890123','ana.lopez@example.com','Valencia'),(7,'Francisco','Díaz Moreno','678901234','francisco.diaz@example.com','Madrid'),(8,'Lucía','Ruiz Hernández','689012345','lucia.ruiz@example.com','Madrid'),(9,'David','Sánchez Torres','690123456','david.sanchez@example.com','Valencia'),(10,'Elena','Romero Ramos','601234567','elena.romero@example.com','Madrid'),(11,'Manuel','Navarro Ortega','602345678','manuel.navarro@example.com','Madrid'),(13,'Pedro','Rubio Molina','604567890','pedro.rubio@example.com','Madrid'),(14,'Sara','Ortega Serrano','605678901','sara.ortega@example.com','Valencia'),(15,'Javier','Morales Gil','606789012','javier.morales@example.com','Madrid'),(16,'Beatriz','Hernández Cruz','607890123','beatriz.hernandez@example.com','Madrid'),(17,'Miguel','Torres León','608901234','miguel.torres@example.com','Valencia'),(18,'Carmen','Domínguez Flores','609012345','carmen.dominguez@example.com','Madrid'),(19,'Raúl','Vargas Castillo','611223344','raul.vargas@example.com','Valencia'),(20,'Patricia','Santos Delgado','622334455','patricia.santos@example.com','Madrid'),(22,'Nombre del nuevo cliente','Apellidos del nuevo cliente',NULL,NULL,NULL),(25,'Jose Vicente','Carratala','620891718','info@jocarsa.com','Valencia');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lineaspedido`
--

DROP TABLE IF EXISTS `lineaspedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lineaspedido` (
  `Identificador` int NOT NULL AUTO_INCREMENT,
  `producto_id` int NOT NULL,
  `unidades` int NOT NULL,
  `pedidos_id` int NOT NULL,
  PRIMARY KEY (`Identificador`),
  KEY `lineapedidoapedido` (`pedidos_id`),
  KEY `lineaspedidoaproductos` (`producto_id`),
  CONSTRAINT `lineapedidoapedido` FOREIGN KEY (`pedidos_id`) REFERENCES `pedidosconlineas` (`Identificador`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lineaspedidoaproductos` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`Identificador`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lineaspedido`
--

LOCK TABLES `lineaspedido` WRITE;
/*!40000 ALTER TABLE `lineaspedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `lineaspedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos` (
  `Identificador` int NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `id_cliente` int NOT NULL,
  `id_producto` int NOT NULL,
  PRIMARY KEY (`Identificador`),
  KEY `pedidosaclientes` (`id_cliente`),
  KEY `pedidosaproductos` (`id_producto`),
  CONSTRAINT `pedidosaclientes` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`Identificador`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pedidosaproductos` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`Identificador`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (2,'2025-09-26',1,4),(3,'2025-09-09',2,18),(4,'2025-09-17',7,11);
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidosconlineas`
--

DROP TABLE IF EXISTS `pedidosconlineas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidosconlineas` (
  `Identificador` int NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `id_cliente` int NOT NULL,
  PRIMARY KEY (`Identificador`),
  KEY `pedidosaclientes2` (`id_cliente`),
  CONSTRAINT `pedidosaclientes2` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`Identificador`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidosconlineas`
--

LOCK TABLES `pedidosconlineas` WRITE;
/*!40000 ALTER TABLE `pedidosconlineas` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidosconlineas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `Identificador` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` double(10,2) NOT NULL,
  `peso` double(10,2) NOT NULL,
  PRIMARY KEY (`Identificador`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'Portátil Lenovo ThinkPad E14','Portátil empresarial de 14 pulgadas con procesador Intel i5 y 16GB RAM.',899.99,1.50),(2,'Smartphone Samsung Galaxy S24','Teléfono inteligente con pantalla AMOLED de 6.5 pulgadas y 128GB de memoria.',1099.00,0.18),(3,'Auriculares Sony WH-1000XM5','Auriculares inalámbricos con cancelación activa de ruido.',349.99,0.25),(4,'Impresora HP LaserJet Pro M404','Impresora láser monocromo rápida y compacta.',229.50,7.60),(5,'Monitor LG UltraWide 34\"','Monitor ultrapanorámico de 34 pulgadas con resolución QHD.',599.90,6.80),(6,'Teclado Logitech MX Keys','Teclado inalámbrico retroiluminado con teclas silenciosas.',119.00,0.80),(7,'Ratón Logitech MX Master 3S','Ratón inalámbrico ergonómico con precisión avanzada.',99.99,0.14),(8,'Disco SSD Samsung 1TB','Unidad de estado sólido NVMe PCIe Gen4 de 1TB.',139.90,0.05),(9,'Servidor Dell PowerEdge T40','Servidor torre para pymes con Intel Xeon.',1150.00,11.20),(10,'Tablet Apple iPad 10.2\"','Tablet de 10.2 pulgadas con 64GB de almacenamiento.',429.00,0.49),(11,'Cámara Canon EOS 250D','Cámara réflex digital con lente 18-55mm.',639.00,0.90),(12,'Proyector Epson EB-S41','Proyector SVGA de 3300 lúmenes para presentaciones.',299.00,2.50),(13,'Silla ergonómica Hbada','Silla de oficina ergonómica con soporte lumbar.',199.99,13.00),(14,'Disco Duro Externo WD 2TB','Disco duro externo portátil con conexión USB 3.0.',79.90,0.23),(15,'Router ASUS RT-AX88U','Router WiFi 6 de alto rendimiento con 8 puertos LAN.',289.00,1.00),(16,'Smartwatch Garmin Forerunner 255','Reloj inteligente multideporte con GPS integrado.',349.90,0.12),(17,'Altavoz JBL Charge 5','Altavoz Bluetooth portátil resistente al agua.',179.00,0.95),(18,'Microondas Samsung MG23','Microondas con grill de 23 litros.',145.00,13.00),(19,'Cafetera Nespresso Essenza Mini','Cafetera de cápsulas compacta y rápida.',89.00,2.30),(20,'Dispositivo NAS Synology DS220+','Servidor NAS de 2 bahías para uso doméstico o empresarial.',329.00,1.30);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vista_pedidos`
--

DROP TABLE IF EXISTS `vista_pedidos`;
/*!50001 DROP VIEW IF EXISTS `vista_pedidos`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_pedidos` AS SELECT 
 1 AS `fecha`,
 1 AS `nombre de cliente`,
 1 AS `apellidos`,
 1 AS `nombre de producto`,
 1 AS `precio`,
 1 AS `IVA`,
 1 AS `Total`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `vista_pedidos`
--

/*!50001 DROP VIEW IF EXISTS `vista_pedidos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_pedidos` AS select `pedidos`.`fecha` AS `fecha`,`clientes`.`nombre` AS `nombre de cliente`,`clientes`.`apellidos` AS `apellidos`,`productos`.`nombre` AS `nombre de producto`,`productos`.`precio` AS `precio`,(`productos`.`precio` * 0.16) AS `IVA`,(`productos`.`precio` * 1.16) AS `Total` from ((`pedidos` left join `clientes` on((`pedidos`.`id_cliente` = `clientes`.`Identificador`))) left join `productos` on((`pedidos`.`id_producto` = `productos`.`Identificador`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-02 17:04:33
```

<a id="subconsultas-y-composiciones-en-ordenes-de-edicion"></a>
## Subconsultas y composiciones en órdenes de edición

En el mundo digital actual, el manejo eficiente de datos es una habilidad crucial para cualquier desarrollador o administrador de sistemas. Dentro del ámbito de las bases de datos, el tratamiento de datos es un aspecto fundamental que involucra la inserción, modificación y eliminación de registros. Sin embargo, estos procesos no se realizan en aislamiento; a menudo requieren una interacción compleja con otros elementos del sistema.

Una de las técnicas más poderosas para manipular los datos en una base de datos es el uso de subconsultas y composiciones en órdenes de edición. Estas herramientas permiten realizar operaciones avanzadas sobre los datos, combinando consultas y modificaciones de manera eficiente y precisa.

Las subconsultas son bloques de código que devuelven un conjunto de resultados que pueden ser utilizados como parte de una consulta principal. En el contexto del tratamiento de datos, las subconsultas se utilizan para filtrar o seleccionar registros específicos antes de realizar operaciones de inserción, modificación o eliminación. Por ejemplo, si necesitas actualizar los precios de un producto en función de su categoría, puedes utilizar una subconsulta para identificar cuáles productos pertenecen a esa categoría y luego aplicar la actualización.

Las composiciones en órdenes de edición son técnicas que permiten combinar múltiples operaciones de inserción, modificación o eliminación en un solo flujo. Esto es especialmente útil cuando se necesita realizar una serie de cambios relacionados entre sí. Por ejemplo, si estás creando un nuevo cliente y necesitas crear automáticamente una cuenta asociada, puedes utilizar una composición para asegurarte de que ambos registros se creen correctamente juntos.

La combinación de subconsultas y composiciones en órdenes de edición permite a los desarrolladores abordar problemas complejos de gestión de datos de manera eficiente. Estas técnicas no solo simplifican el código, sino que también mejoran la legibilidad y mantenibilidad del sistema. Además, permiten una mayor flexibilidad en las operaciones realizadas sobre los datos, adaptándose a las necesidades cambiantes del negocio.

Es importante destacar que el uso de subconsultas y composiciones debe ser realizado con precaución para evitar problemas de rendimiento. La optimización de estas técnicas es crucial para mantener la eficiencia del sistema en entornos de alta carga. Herramientas de análisis y monitoreo pueden ayudar a identificar posibles problemas y optimizar el código según sea necesario.

En resumen, las subconsultas y composiciones en órdenes de edición son herramientas poderosas para el tratamiento de datos en bases de datos. Permiten realizar operaciones avanzadas de manera eficiente y precisa, combinando consultas y modificaciones de manera coherente. Su uso adecuado es fundamental para mantener la integridad y consistencia de los datos en cualquier sistema informático moderno.

### localstorage

```html
<!doctype html>
<html lang="es">
  <head>
    <title>
      Local Storage
    </title>
  </head>
  <body>
    <script>
      localStorage.setItem("minombre","Jose Vicente")
    </script>
  </body>
</html>
```

### recuperar datos

```html
<!doctype html>
<html lang="es">
  <head>
    <title>
      Local Storage
    </title>
  </head>
  <body>
    <script>
      console.log(localStorage.getItem("minombre"));
    </script>
  </body>
</html>
```

### guardar datos complejos

```html
<!doctype html>
<html lang="es">
  <head>
    <title>
      Local Storage
    </title>
  </head>
  <body>
    <script>
      var mis_datos = {
        "nombre":"Jose Vicente",
        "apellidos":"Carratala Sanchis",
        "email":"info@jocarsa.com"
      };
      localStorage.setItem("mis_datos",mis_datos);
    </script>
  </body>
</html>
```

### convertir objeto a cadena

```html
<!doctype html>
<html lang="es">
  <head>
    <title>
      Local Storage
    </title>
  </head>
  <body>
    <script>
      var mis_datos = {
        "nombre":"Jose Vicente",
        "apellidos":"Carratala Sanchis",
        "email":"info@jocarsa.com"
      };
      var cadena_json = JSON.stringify(mis_datos);
      localStorage.setItem("mis_datos",cadena_json);
    </script>
  </body>
</html>
```

### recuperar un objeto complejo

```html
<!doctype html>
<html lang="es">
  <head>
    <title>
      Local Storage
    </title>
  </head>
  <body>
    <script>
   
      console.log(localStorage.getItem("mis_datos"));
    </script>
  </body>
</html>
```

### convertir string a objeto

```html
<!doctype html>
<html lang="es">
  <head>
    <title>
      Local Storage
    </title>
  </head>
  <body>
    <script>
      console.log(JSON.parse(localStorage.getItem("mis_datos")));
    </script>
  </body>
</html>
```

<a id="transacciones"></a>
## Transacciones

En el mundo digital de la programación, las transacciones son como los pilares que sostienen una estructura sólida. Son operaciones fundamentales que garantizan la integridad y consistencia de los datos en sistemas de bases de datos. Imagina un edificio donde cada piso es una tabla de la base de datos, y cada habitación es un registro dentro de esa tabla. Las transacciones son como las escaleras que te permiten moverte entre estos pisos y habitaciones, asegurando que no se pierdan o alteren los datos mientras lo haces.

Imagina que estás en una tienda virtual y quieres comprar un producto. Antes de finalizar la compra, el sistema realiza varias transacciones detrás de escenas. Primero, verifica si tienes suficiente dinero en tu cuenta bancaria para cubrir el costo del producto. Luego, reduce el saldo en tu cuenta y aumenta el número de unidades disponibles del producto en el inventario. Si todo esto ocurre sin problemas, la transacción se completa con éxito, y tu pedido es procesado. Pero si algo falla en cualquier paso, como no tener suficiente dinero o un problema con el inventario, la transacción se cancela automáticamente para evitar que los datos queden inconsistentes.

Las transacciones son cruciales porque garantizan que las operaciones de inserción, borrado y modificación de datos sean atómicas. Esto significa que si una transacción falla en algún punto, todas las modificaciones realizadas hasta ese momento se deshacen, como si no hubiera ocurrido nada. Es como si estuvieras construyendo un castillo con bloques de construcción. Si te das cuenta de que el último bloque no se ajusta bien, puedes quitar todos los bloques y empezar de nuevo sin preocuparte por la estructura del castillo.

Las transacciones también son idempotentes, lo que significa que si ejecutas una transacción dos veces, el resultado será el mismo que si la ejecutaste solo una vez. Es como si estuvieras cocinando un plato. Si preparas una receta correctamente, no importa cuántas veces la repites, siempre obtendrás el mismo sabor.

Además, las transacciones son confiables y duraderas. Una vez que se completa una transacción, los cambios realizados en los datos permanecen incluso si ocurre un fallo del sistema. Es como si guardaras tu trabajo en un cajón de seguridad. No importa cuántas veces el sistema te diga que hay problemas, tus cambios estarán seguros y no se perderán.

Las transacciones también son aisladas, lo que significa que mientras una transacción está en curso, los demás usuarios no pueden ver los cambios hasta que la transacción se complete. Es como si estuvieras jugando un juego de cartas con amigos. Mientras tú estás jugando tu turno, tus amigos no pueden mirar o interferir en tus cartas.

En resumen, las transacciones son el corazón de cualquier sistema de bases de datos. Son la garantía de que los datos se manejen correctamente y consistentemente, asegurando que nuestras aplicaciones funcionen como se espera. Desde la compra de productos en línea hasta la gestión de inventarios y finanzas corporativas, las transacciones son esenciales para mantener la integridad de nuestros sistemas digitales.

### tienda online

```sql
Quiero crear la base de datos MySQL de una tienda online, que tendrá (PK en cada tabla):
-Productos
-Categorias (FK desde productos a categorías)
-Pedidos (FK a clientes)
-Lineas de pedido (FK a pedidos y a productos)
-Clientes
-Gestión del stock (FK a productos)

Quiero obtener los sql create table para darle forma a esta tabla
Quieo crear todas las vistas que sea necesario para unir todos los FK de la base de datos de forma humanamente entendible (tantas views como sea necesario)
```

### crear la basededatos

```sql
sudo mysql -u root -p

CREATE DATABASE tiendaonline2526;

USE tiendaonline2526;
```

### crear tablas

```sql
-- ============================
-- 1) Tabla CATEGORIAS
-- ============================
CREATE TABLE categorias (
    id_categoria      INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre            VARCHAR(100) NOT NULL,
    descripcion       TEXT NULL,
    activa            TINYINT(1) NOT NULL DEFAULT 1,
    fecha_creacion    DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    
    CONSTRAINT uq_categorias_nombre UNIQUE (nombre)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;

-- ============================
-- 2) Tabla CLIENTES
-- ============================
CREATE TABLE clientes (
    id_cliente        INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre            VARCHAR(100) NOT NULL,
    apellidos         VARCHAR(150) NOT NULL,
    email             VARCHAR(150) NOT NULL,
    telefono          VARCHAR(30),
    direccion         VARCHAR(255),
    cp                VARCHAR(10),
    ciudad            VARCHAR(100),
    provincia         VARCHAR(100),
    pais              VARCHAR(100),
    fecha_registro    DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    activo            TINYINT(1) NOT NULL DEFAULT 1,
    
    CONSTRAINT uq_clientes_email UNIQUE (email)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;

-- ============================
-- 3) Tabla PRODUCTOS
-- ============================
CREATE TABLE productos (
    id_producto       INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_categoria      INT UNSIGNED NOT NULL,
    nombre            VARCHAR(150) NOT NULL,
    descripcion       TEXT,
    sku               VARCHAR(50),
    precio            DECIMAL(10,2) NOT NULL,
    impuesto_porcentaje DECIMAL(5,2) NOT NULL DEFAULT 21.00, -- % IVA, por ejemplo
    activo            TINYINT(1) NOT NULL DEFAULT 1,
    fecha_alta        DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    
    CONSTRAINT fk_productos_categorias
        FOREIGN KEY (id_categoria)
        REFERENCES categorias (id_categoria)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
        
    CONSTRAINT uq_productos_sku UNIQUE (sku),
    INDEX idx_productos_categoria (id_categoria),
    INDEX idx_productos_nombre (nombre)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;

-- ============================
-- 4) Tabla PEDIDOS
-- ============================
CREATE TABLE pedidos (
    id_pedido         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_cliente        INT UNSIGNED NOT NULL,
    fecha_pedido      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    estado            ENUM('pendiente','pagado','enviado','cancelado','devuelto')
                        NOT NULL DEFAULT 'pendiente',
    total_bruto       DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    total_impuestos   DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    total             DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    observaciones     TEXT,
    
    CONSTRAINT fk_pedidos_clientes
        FOREIGN KEY (id_cliente)
        REFERENCES clientes (id_cliente)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
        
    INDEX idx_pedidos_cliente (id_cliente),
    INDEX idx_pedidos_fecha (fecha_pedido),
    INDEX idx_pedidos_estado (estado)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;

-- ============================
-- 5) Tabla GESTION_STOCK
--    (movimientos de stock)
-- ============================
CREATE TABLE gestion_stock (
    id_movimiento     INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_producto       INT UNSIGNED NOT NULL,
    tipo_movimiento   ENUM('entrada','salida','ajuste') NOT NULL,
    cantidad          INT NOT NULL,
    fecha_movimiento  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    referencia        VARCHAR(255) NULL, -- p.ej. "Pedido #123"
    observaciones     TEXT NULL,
    
    CONSTRAINT fk_stock_productos
        FOREIGN KEY (id_producto)
        REFERENCES productos (id_producto)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
        
    INDEX idx_stock_producto (id_producto),
    INDEX idx_stock_fecha (fecha_movimiento),
    INDEX idx_stock_tipo (tipo_movimiento)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;

-- ============================
-- 6) Tabla LINEAS_PEDIDO
-- ============================
CREATE TABLE lineas_pedido (
    id_linea_pedido   INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_pedido         INT UNSIGNED NOT NULL,
    id_producto       INT UNSIGNED NOT NULL,
    cantidad          INT NOT NULL,
    precio_unitario   DECIMAL(10,2) NOT NULL, -- copia del precio en el momento del pedido
    impuesto_porcentaje DECIMAL(5,2) NOT NULL,
    total_linea       DECIMAL(10,2) NOT NULL,
    
    CONSTRAINT fk_lineas_pedido_pedidos
        FOREIGN KEY (id_pedido)
        REFERENCES pedidos (id_pedido)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
        
    CONSTRAINT fk_lineas_pedido_productos
        FOREIGN KEY (id_producto)
        REFERENCES productos (id_producto)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
        
    INDEX idx_lineas_pedido_pedido (id_pedido),
    INDEX idx_lineas_pedido_producto (id_producto)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;
```

### vistas

```sql
CREATE OR REPLACE VIEW vw_productos_categorias AS
SELECT
    p.id_producto,
    p.nombre              AS producto,
    p.descripcion         AS descripcion_producto,
    p.sku,
    p.precio,
    p.impuesto_porcentaje,
    p.activo              AS producto_activo,
    c.id_categoria,
    c.nombre              AS categoria,
    c.descripcion         AS descripcion_categoria,
    c.activa              AS categoria_activa
FROM productos p
JOIN categorias c ON p.id_categoria = c.id_categoria;


CREATE OR REPLACE VIEW vw_pedidos_clientes AS
SELECT
    pe.id_pedido,
    pe.fecha_pedido,
    pe.estado,
    pe.total_bruto,
    pe.total_impuestos,
    pe.total,
    cl.id_cliente,
    CONCAT(cl.nombre, ' ', cl.apellidos) AS cliente,
    cl.email,
    cl.telefono,
    cl.ciudad,
    cl.provincia,
    cl.pais
FROM pedidos pe
JOIN clientes cl ON pe.id_cliente = cl.id_cliente;


CREATE OR REPLACE VIEW vw_lineas_pedido_detalle AS
SELECT
    lp.id_linea_pedido,
    -- Pedido
    pe.id_pedido,
    pe.fecha_pedido,
    pe.estado,
    pe.total          AS total_pedido,
    
    -- Cliente
    cl.id_cliente,
    CONCAT(cl.nombre, ' ', cl.apellidos) AS cliente,
    cl.email              AS email_cliente,
    
    -- Producto
    pr.id_producto,
    pr.nombre             AS producto,
    pr.sku,
    pr.precio             AS precio_actual_producto,
    
    -- Categoría
    ca.id_categoria,
    ca.nombre             AS categoria,
    
    -- Datos de la línea
    lp.cantidad,
    lp.precio_unitario,
    lp.impuesto_porcentaje,
    lp.total_linea
FROM lineas_pedido lp
JOIN pedidos pe   ON lp.id_pedido   = pe.id_pedido
JOIN clientes cl  ON pe.id_cliente  = cl.id_cliente
JOIN productos pr ON lp.id_producto = pr.id_producto
JOIN categorias ca ON pr.id_categoria = ca.id_categoria;

CREATE OR REPLACE VIEW vw_stock_actual AS
SELECT
    p.id_producto,
    p.nombre          AS producto,
    p.sku,
    c.id_categoria,
    c.nombre          AS categoria,
    
    COALESCE(SUM(
        CASE
            WHEN gs.tipo_movimiento = 'entrada' THEN gs.cantidad
            WHEN gs.tipo_movimiento = 'salida'  THEN -gs.cantidad
            WHEN gs.tipo_movimiento = 'ajuste'  THEN gs.cantidad
            ELSE 0
        END
    ), 0) AS stock_actual
FROM productos p
LEFT JOIN categorias c    ON p.id_categoria = c.id_categoria
LEFT JOIN gestion_stock gs ON p.id_producto = gs.id_producto
GROUP BY
    p.id_producto,
    p.nombre,
    p.sku,
    c.id_categoria,
    c.nombre;


CREATE OR REPLACE VIEW vw_pedidos_resumen AS
SELECT
    pe.id_pedido,
    pe.fecha_pedido,
    pe.estado,
    cl.id_cliente,
    CONCAT(cl.nombre, ' ', cl.apellidos) AS cliente,
    
    SUM(lp.cantidad * lp.precio_unitario)                   AS total_bruto_calculado,
    SUM(lp.cantidad * lp.precio_unitario * lp.impuesto_porcentaje / 100) AS total_impuestos_calculado,
    SUM(lp.total_linea)                                     AS total_calculado
FROM pedidos pe
JOIN clientes cl  ON pe.id_cliente  = cl.id_cliente
LEFT JOIN lineas_pedido lp ON pe.id_pedido = lp.id_pedido
GROUP BY
    pe.id_pedido,
    pe.fecha_pedido,
    pe.estado,
    cl.id_cliente,
    cliente;

CREATE OR REPLACE VIEW vw_movimientos_stock_detalle AS
SELECT
    gs.id_movimiento,
    gs.fecha_movimiento,
    gs.tipo_movimiento,
    gs.cantidad,
    gs.referencia,
    gs.observaciones,
    p.id_producto,
    p.nombre AS producto,
    p.sku,
    c.id_categoria,
    c.nombre AS categoria
FROM gestion_stock gs
JOIN productos p ON gs.id_producto = p.id_producto
JOIN categorias c ON p.id_categoria = c.id_categoria;
```

### crear nuevo usuario

```sql
CREATE USER 
'tiendaonline2526'@'localhost' 
IDENTIFIED  BY 'tiendaonline2526';

GRANT USAGE ON *.* TO 'tiendaonline2526'@'localhost';

ALTER USER 'tiendaonline2526'@'localhost' 
REQUIRE NONE 
WITH MAX_QUERIES_PER_HOUR 0 
MAX_CONNECTIONS_PER_HOUR 0 
MAX_UPDATES_PER_HOUR 0 
MAX_USER_CONNECTIONS 0;

GRANT ALL PRIVILEGES ON `tiendaonline2526`.* 
TO 'tiendaonline2526'@'localhost';

FLUSH PRIVILEGES;
```

### prompt para crear datos

```sql
Y luego por ultimo quiero insert into tantos como haga falta para insertar datos de demostracion - ten en cuenta los FK para insertar primero datos en tablas que no tengan dependencias, y luego datos en las tablas que si que las contengan - las tablas están vacías, con lo cual asume que todos los PK empiezan en 1.
```

### insert into

```sql
USE tienda_online;

-- =========================================
-- 1) CATEGORÍAS
--    (sin dependencias)
-- =========================================
-- Tras este INSERT:
--  id_categoria = 1 -> Electrónica
--  id_categoria = 2 -> Libros
--  id_categoria = 3 -> Ropa
--  id_categoria = 4 -> Hogar

INSERT INTO categorias (nombre, descripcion, activa) VALUES
('Electrónica', 'Ordenadores, periféricos y gadgets', 1),
('Libros', 'Libros y material de lectura', 1),
('Ropa', 'Ropa y complementos', 1),
('Hogar', 'Artículos para el hogar y decoración', 1);

-- =========================================
-- 2) CLIENTES
--    (sin dependencias)
-- =========================================
-- Tras este INSERT:
--  id_cliente = 1 -> Ana García
--  id_cliente = 2 -> Luis Martínez
--  id_cliente = 3 -> Marta López
--  id_cliente = 4 -> Carlos Sánchez

INSERT INTO clientes 
(nombre, apellidos, email, telefono, direccion, cp, ciudad, provincia, pais, activo) VALUES
('Ana',   'García Pérez',   'ana.garcia@example.com',   '+34 600 111 111', 'Calle Mayor 1',      '46001', 'Valencia',   'Valencia',   'España', 1),
('Luis',  'Martínez Ruiz',  'luis.martinez@example.com','+34 600 222 222', 'Av. Constitución 23','28001', 'Madrid',     'Madrid',     'España', 1),
('Marta', 'López Sánchez',  'marta.lopez@example.com',  '+34 600 333 333', 'Calle Colón 45',     '08001', 'Barcelona',  'Barcelona',  'España', 1),
('Carlos','Sánchez Vidal',  'carlos.sanchez@example.com','+34 600 444 444','Calle Paz 10',       '30001', 'Murcia',     'Murcia',     'España', 1);

-- =========================================
-- 3) PRODUCTOS
--    (dependen de categorías)
-- =========================================
-- Tras este INSERT:
--  id_producto = 1 -> Portátil 14" básico (cat 1)
--  id_producto = 2 -> Ratón inalámbrico (cat 1)
--  id_producto = 3 -> Libro "Aprende Python" (cat 2)
--  id_producto = 4 -> Libro "HTML y CSS" (cat 2)
--  id_producto = 5 -> Camiseta básica (cat 3)
--  id_producto = 6 -> Sudadera con capucha (cat 3)
--  id_producto = 7 -> Lámpara de escritorio (cat 4)
--  id_producto = 8 -> Taza de café (cat 4)

INSERT INTO productos
(id_categoria, nombre, descripcion, sku, precio, impuesto_porcentaje, activo) VALUES
(1, 'Portátil 14" básico', 'Portátil de 14 pulgadas para uso ofimático', 'ELEC-001', 600.00, 21.00, 1),
(1, 'Ratón inalámbrico',   'Ratón óptico inalámbrico con receptor USB', 'ELEC-002',  20.00, 21.00, 1),
(2, 'Libro "Aprende Python"', 'Libro de programación en Python para principiantes', 'LIB-001', 30.00, 21.00, 1),
(2, 'Libro "HTML y CSS"',  'Guía práctica de maquetación web',             'LIB-002', 25.00, 21.00, 1),
(3, 'Camiseta básica',     'Camiseta de algodón unisex',                    'ROP-001', 15.00, 21.00, 1),
(3, 'Sudadera con capucha','Sudadera gruesa con capucha',                   'ROP-002', 40.00, 21.00, 1),
(4, 'Lámpara de escritorio','Lámpara LED articulada para escritorio',       'HOG-001', 35.00, 21.00, 1),
(4, 'Taza de café',        'Taza de cerámica 300ml',                        'HOG-002',  8.00, 21.00, 1);

-- =========================================
-- 4) GESTIÓN DE STOCK
--    (depende de productos)
-- =========================================
-- Para cada producto:
--   - 1 movimiento de ENTRADA (100 uds, carga inicial)
--   - varios movimientos de SALIDA asociados a pedidos demo

-- Entradas iniciales de stock (100 uds de cada producto)
INSERT INTO gestion_stock (id_producto, tipo_movimiento, cantidad, referencia, observaciones) VALUES
(1, 'entrada', 100, 'Carga inicial', 'Stock inicial del almacén'),
(2, 'entrada', 100, 'Carga inicial', 'Stock inicial del almacén'),
(3, 'entrada', 100, 'Carga inicial', 'Stock inicial del almacén'),
(4, 'entrada', 100, 'Carga inicial', 'Stock inicial del almacén'),
(5, 'entrada', 100, 'Carga inicial', 'Stock inicial del almacén'),
(6, 'entrada', 100, 'Carga inicial', 'Stock inicial del almacén'),
(7, 'entrada', 100, 'Carga inicial', 'Stock inicial del almacén'),
(8, 'entrada', 100, 'Carga inicial', 'Stock inicial del almacén');

-- Salidas de stock ligadas a las líneas de pedido que crearemos después
-- Pedido #1: (id_pedido = 1)
--   - 1x producto 1 (Portátil 14")
--   - 2x producto 2 (Ratón inalámbrico)
INSERT INTO gestion_stock (id_producto, tipo_movimiento, cantidad, referencia, observaciones) VALUES
(1, 'salida', 1, 'Pedido #1', 'Venta al cliente Ana García'),
(2, 'salida', 2, 'Pedido #1', 'Venta al cliente Ana García');

-- Pedido #2: (id_pedido = 2)
--   - 1x producto 3 (Libro Python)
--   - 1x producto 4 (Libro HTML y CSS)
--   - 2x producto 8 (Taza de café)
INSERT INTO gestion_stock (id_producto, tipo_movimiento, cantidad, referencia, observaciones) VALUES
(3, 'salida', 1, 'Pedido #2', 'Venta al cliente Luis Martínez'),
(4, 'salida', 1, 'Pedido #2', 'Venta al cliente Luis Martínez'),
(8, 'salida', 2, 'Pedido #2', 'Venta al cliente Luis Martínez');

-- Pedido #3: (id_pedido = 3)
--   - 3x producto 5 (Camiseta básica)
--   - 1x producto 6 (Sudadera con capucha)
INSERT INTO gestion_stock (id_producto, tipo_movimiento, cantidad, referencia, observaciones) VALUES
(5, 'salida', 3, 'Pedido #3', 'Venta al cliente Marta López'),
(6, 'salida', 1, 'Pedido #3', 'Venta al cliente Marta López');

-- Pedido #4: (id_pedido = 4)
--   - 1x producto 7 (Lámpara de escritorio)
--   - 1x producto 1 (Portátil 14")
INSERT INTO gestion_stock (id_producto, tipo_movimiento, cantidad, referencia, observaciones) VALUES
(7, 'salida', 1, 'Pedido #4', 'Venta al cliente Ana García'),
(1, 'salida', 1, 'Pedido #4', 'Venta al cliente Ana García');

-- =========================================
-- 5) PEDIDOS
--    (dependen de clientes)
-- =========================================
-- IMPORTANTE: asumimos tablas vacías, así que:
--   id_pedido = 1,2,3,4 en este orden.
-- Los totales están calculados a partir de las líneas
-- (21% de IVA sobre el bruto).

-- Pedido 1: cliente 1 (Ana García)
-- Líneas:
--   1x Portátil 14" (600.00)
--   2x Ratón inalámbrico (20.00)
-- Bruto: 640.00
-- IVA (21%): 134.40
-- Total: 774.40

INSERT INTO pedidos
(id_cliente, fecha_pedido, estado, total_bruto, total_impuestos, total, observaciones) VALUES
(1, '2025-01-10 10:30:00', 'pagado',   640.00, 134.40, 774.40, 'Compra online paga con tarjeta'),

-- Pedido 2: cliente 2 (Luis Martínez)
-- Líneas:
--   1x Libro "Aprende Python" (30.00)
--   1x Libro "HTML y CSS" (25.00)
--   2x Taza de café (8.00)
-- Bruto: 71.00
-- IVA (21%): 14.91
-- Total: 85.91
(2, '2025-01-12 16:45:00', 'enviado',   71.00,  14.91,  85.91, 'Envío por mensajería 24h'),

-- Pedido 3: cliente 3 (Marta López)
-- Líneas:
--   3x Camiseta básica (15.00)
--   1x Sudadera con capucha (40.00)
-- Bruto: 85.00
-- IVA (21%): 17.85
-- Total: 102.85
(3, '2025-01-15 09:15:00', 'pagado',    85.00,  17.85, 102.85, 'Pedido recogida en tienda'),

-- Pedido 4: cliente 1 (Ana García)
-- Líneas:
--   1x Lámpara de escritorio (35.00)
--   1x Portátil 14" (600.00)
-- Bruto: 635.00
-- IVA (21%): 133.35
-- Total: 768.35
(1, '2025-01-20 18:20:00', 'pendiente', 635.00, 133.35, 768.35, 'Pendiente de pago por transferencia');

-- =========================================
-- 6) LÍNEAS DE PEDIDO
--    (dependen de pedidos y productos)
-- =========================================
-- Recordatorio:
--   Pedido 1 -> id_pedido = 1
--   Pedido 2 -> id_pedido = 2
--   Pedido 3 -> id_pedido = 3
--   Pedido 4 -> id_pedido = 4
--
-- Todos los productos tienen impuesto_porcentaje = 21.00
-- total_linea = bruto_linea + IVA_linea

INSERT INTO lineas_pedido
(id_pedido, id_producto, cantidad, precio_unitario, impuesto_porcentaje, total_linea) VALUES

-- Pedido 1 (id_pedido = 1)
--  1x producto 1 (600.00) -> bruto 600, IVA 126.00, total 726.00
(1, 1, 1, 600.00, 21.00, 726.00),
--  2x producto 2 (20.00)  -> bruto 40, IVA 8.40, total 48.40
(1, 2, 2,  20.00, 21.00,  48.40),

-- Pedido 2 (id_pedido = 2)
--  1x producto 3 (30.00)  -> bruto 30, IVA 6.30, total 36.30
(2, 3, 1,  30.00, 21.00,  36.30),
--  1x producto 4 (25.00)  -> bruto 25, IVA 5.25, total 30.25
(2, 4, 1,  25.00, 21.00,  30.25),
--  2x producto 8 (8.00)   -> bruto 16, IVA 3.36, total 19.36
(2, 8, 2,   8.00, 21.00,  19.36),

-- Pedido 3 (id_pedido = 3)
--  3x producto 5 (15.00)  -> bruto 45, IVA 9.45, total 54.45
(3, 5, 3,  15.00, 21.00,  54.45),
--  1x producto 6 (40.00)  -> bruto 40, IVA 8.40, total 48.40
(3, 6, 1,  40.00, 21.00,  48.40),

-- Pedido 4 (id_pedido = 4)
--  1x producto 7 (35.00)  -> bruto 35, IVA 7.35, total 42.35
(4, 7, 1,  35.00, 21.00,  42.35),
--  1x producto 1 (600.00) -> bruto 600, IVA 126.00, total 726.00
(4, 1, 1, 600.00, 21.00, 726.00);
```

<a id="politicas-de-bloqueo-concurrencia"></a>
## Políticas de bloqueo. Concurrencia

En el vasto mundo de las bases de datos, la concurrencia es un fenómeno inevitable que surge cuando varios usuarios intentan acceder simultáneamente a los mismos recursos. Este escenario plantea desafíos significativos en términos de integridad y consistencia de los datos, por lo que es crucial establecer políticas de bloqueo adecuadas para gestionar eficazmente la concurrencia.

La política de bloqueo se refiere a las reglas y mecanismos utilizados para controlar el acceso concurrente a los recursos de una base de datos. Estas políticas son fundamentales para evitar conflictos entre transacciones, garantizar la coherencia de los datos y prevenir situaciones como la pérdida de datos o inconsistencias.

Existen varios tipos de bloqueos que pueden aplicarse en las bases de datos, cada uno con sus propias características y efectos. El bloqueo compartido (S) permite a múltiples transacciones leer un recurso simultáneamente, mientras que el bloqueo exclusivo (X) impide que cualquier otra transacción acceda al recurso hasta que la transacción actual lo libere. Otros tipos de bloqueos incluyen los bloqueos de escritura (IX), los bloqueos de lectura (SIX) y los bloqueos de intento de bloqueo (IS).

La elección del tipo de bloqueo adecuado depende del escenario específico y de las necesidades de la aplicación. Por ejemplo, si se requiere que varias transacciones puedan leer un conjunto de datos simultáneamente sin interferir entre sí, el bloqueo compartido sería apropiado. Sin embargo, si una transacción necesita modificar los datos, será necesario utilizar el bloqueo exclusivo para evitar conflictos.

La gestión del bloqueo es un aspecto complejo que requiere consideraciones cuidadosas. Una política de bloqueo eficaz debe equilibrar la concurrencia y la integridad de los datos. Esto implica no solo seleccionar el tipo correcto de bloqueo, sino también implementar estrategias para minimizar el tiempo de espera y maximizar la utilización del recurso.

Además de las políticas de bloqueo, es crucial considerar la concurrencia en el diseño de las transacciones. Las transacciones deben ser cortas y atomicas para reducir el riesgo de conflictos. Además, se debe implementar un mecanismo de detección de deadlock, que es una situación en la que dos o más transacciones están esperando mutuamente a que las otras liberen recursos.

La concurrencia también plantea desafíos en términos de rendimiento. Las bases de datos deben estar diseñadas para manejar múltiples solicitudes simultáneamente sin sacrificar el tiempo de respuesta. Esto implica optimizar la gestión del bloqueo, reducir el tiempo de espera y utilizar técnicas avanzadas como la paralelización.

En conclusión, las políticas de bloqueo y la gestión de la concurrencia son elementos cruciales en el diseño y operación eficiente de bases de datos. Al entender y aplicar adecuadamente estas estrategias, se puede garantizar una alta integridad y consistencia de los datos, mientras se maximiza la concurrencia y el rendimiento del sistema.

### creación de una base de datos

```markdown
La base de datos no se crea con un CREATE DATABASE sino que es un archivo.
```

### tipos de datos en SQLite

```markdown
TEXT = Texto
INTEGER = numeros enteros
BLOB = almacenar datos binarios
REAL = Numeros reales
NUMERIC = Numeros con decimales
```

### Create Table

```sql
CREATE TABLE "clientes" (
	"Identificador"	INTEGER,
	"nombre"	TEXT,
	"apellidos"	TEXT,
	"email"	TEXT,
	"direccion"	TEXT,
	PRIMARY KEY("Identificador" AUTOINCREMENT)
);
```

### Tabla de pedidos

```sql
CREATE TABLE "productos" (
	"Identificador"	INTEGER,
	"nombre"	TEXT,
	"descripcion"	TEXT,
	"precio"	TEXT,
	"categoria"	TEXT,
	PRIMARY KEY("Identificador" AUTOINCREMENT)
);
```

### Insertar un cliente

```sql
INSERT INTO clientes VALUES(
  NULL,
  'Jose Vicente',
  'Carratala Sanchis',
  'info@jocarsa.com',
  'La calle de Jose Vicente'
);
```

### seleccion de clientes

```sql
SELECT * FROM clientes;
```

### Insertar un producto

```sql
INSERT INTO productos VALUES(
  NULL,
  'Raton',
  'Raton de ordenador',
  '5.42',
  'Informatica'
);
```

### seleccionar los productos

```sql
SELECT * FROM productos;
```

### actualizar precio de un producto

```sql
UPDATE productos
SET precio = "6.54"
WHERE Identificador = 1;

SELECT * FROM productos;
```

### eliminar

```sql
DELETE FROM productos WHERE Identificador = 1;

SELECT * FROM productos;

INSERT INTO productos VALUES(
  NULL,
  'Raton',
  'Raton de ordenador',
  '5.42',
  'Informatica'
);
```

### crear tabla pedidos

```sql
CREATE TABLE "pedidos" (
    "Identificador" INTEGER PRIMARY KEY AUTOINCREMENT,
    "cliente_id" INTEGER UNIQUE,
    "producto_id" INTEGER UNIQUE,
    "fecha" TEXT,
    "cantidad" INTEGER,
    "total" REAL,
    FOREIGN KEY("cliente_id") REFERENCES "clientes"("Identificador") ON DELETE CASCADE,
    FOREIGN KEY("producto_id") REFERENCES "productos"("Identificador") ON DELETE CASCADE
);
```

### primero creamos la tabla

```sql
-- 1️⃣ Crear la tabla pedidos (sin relaciones todavía)
CREATE TABLE "pedidos" (
    "Identificador" INTEGER PRIMARY KEY AUTOINCREMENT,
    "cliente_id" INTEGER UNIQUE,
    "producto_id" INTEGER UNIQUE,
    "fecha" TEXT,
    "cantidad" INTEGER,
    "total" REAL
);
```

### clave externa 1

```sql
-- 2️⃣ Añadir la relación 1:1 con clientes
ALTER TABLE "pedidos"
ADD FOREIGN KEY ("cliente_id") REFERENCES "clientes"("Identificador") ON DELETE CASCADE;
```

### clave externa 2

```sql
-- 3️⃣ Añadir la relación 1:1 con productos
ALTER TABLE "pedidos"
ADD FOREIGN KEY ("producto_id") REFERENCES "productos"("Identificador") ON DELETE CASCADE;
```

### de un golpe

```sql
-- 1️⃣ Crear la nueva tabla con las claves foráneas
CREATE TABLE "pedidos" (
    "Identificador" INTEGER PRIMARY KEY AUTOINCREMENT,
    "cliente_id" INTEGER,
    "producto_id" INTEGER,
    "fecha" TEXT,
    "cantidad" INTEGER,
    "total" REAL,
    FOREIGN KEY ("cliente_id") REFERENCES "clientes"("Identificador") ON DELETE CASCADE,
    FOREIGN KEY ("producto_id") REFERENCES "productos"("Identificador") ON DELETE CASCADE
);
```

### inserción de pedido

```sql
-- incorrecta

INSERT INTO pedidos VALUES(
  NULL,
  5,
  7,
  "2025-10-16",
  5,
  20.5
);

-- correcta

INSERT INTO pedidos VALUES(
  NULL,
  1,
  2,
  "2025-10-16",
  5,
  20.5
);
```

### conectar en python

```python
import sqlite3
```

### abrir y select

```python
import sqlite3

basededatos = sqlite3.connect("empresa.db")

cursor = basededatos.cursor()

cursor.execute("SELECT * FROM clientes")
filas = cursor.fetchall()

for fila in filas:
  print(fila)
```

### insertar

```python
import sqlite3

basededatos = sqlite3.connect("empresa.db")

cursor = basededatos.cursor()

cursor.execute('''
  INSERT INTO clientes
  VALUES (
    NULL,
    'Juan',
    'Garcia Lopez',
    'juan@jocarsa.com',
    'La calle de Juan'
  );
''')

basededatos.commit()
```

### actualizar

```python
import sqlite3

basededatos = sqlite3.connect("empresa.db")

cursor = basededatos.cursor()

cursor.execute('''
  UPDATE clientes
  SET direccion = 'La otra calle de Juan'
  WHERE Identificador = 2;
''')

basededatos.commit()
```

### eliminar

```python
import sqlite3

basededatos = sqlite3.connect("empresa.db")

cursor = basededatos.cursor()

cursor.execute('''
  DELETE FROM clientes
  WHERE Identificador = 2;
''')

basededatos.commit()
```

### crear programa de gestion

```python
import sqlite3

print("\033[2J")  # Borrar pantalla
print("\033[0;0H", end="")
print("Programa de gestión")
print("Selecciona una entidad:")

basededatos = sqlite3.connect("empresa.db")
cursor = basededatos.cursor()
cursor.execute('''
  SELECT name 
  FROM sqlite_master 
  WHERE type='table'
  ORDER BY name;
  ''')
contador = 1
filas = cursor.fetchall()
for fila in filas:
  print(str(contador)+"-"+fila[0])
  contador += 1
opcion = input("Tu opción elegida: ")
```

### seleccion de opcion

```python
import sqlite3

print("\033[2J")  # Borrar pantalla
print("\033[0;0H", end="")
print("Programa de gestión")
print("Selecciona una entidad:")

basededatos = sqlite3.connect("empresa.db")
cursor = basededatos.cursor()
cursor.execute('''
  SELECT name 
  FROM sqlite_master 
  WHERE type='table'
  ORDER BY name;
  ''')
contador = 1
filas = cursor.fetchall()
tabla = ""
tablas = [0]
for fila in filas:
  print(str(contador)+"-"+fila[0])
  contador += 1
  tablas.append(fila[0])
opcion = input("Tu opción elegida: ")
tabla = tablas[int(opcion)]
print("\033[2J")  # Borrar pantalla
print("\033[0;0H", end="")
print("La tabla seleccionada es: "+tabla)
```

### siguientes opciones

```python
import sqlite3

print("\033[2J")  # Borrar pantalla
print("\033[0;0H", end="")
print("Programa de gestión")
print("Selecciona una entidad:")

basededatos = sqlite3.connect("empresa.db")
cursor = basededatos.cursor()
cursor.execute('''
  SELECT name 
  FROM sqlite_master 
  WHERE type='table'
  ORDER BY name;
  ''')
contador = 1
filas = cursor.fetchall()
tabla = ""
tablas = [0]
for fila in filas:
  print(str(contador)+"-"+fila[0])
  contador += 1
  tablas.append(fila[0])
opcion = input("Tu opción elegida: ")
tabla = tablas[int(opcion)]
print("\033[2J")  # Borrar pantalla
print("\033[0;0H", end="")
print("La tabla seleccionada es: "+tabla)
print("Selecciona una operación: ")
print("1.-Crear un registro")
print("2.-Listado de registros")
print("3.-Actualizar un registro")
print("4.-Eliminar un registro")
opcion = input("Selecciona una opcion: ")
```

### comentarios hasta el momento

```python
import sqlite3

basededatos = sqlite3.connect("empresa.db")
cursor = basededatos.cursor()

# Pantalla de selección de entidad ############################

print("\033[2J")  # Borrar pantalla
print("\033[0;0H", end="")
print("Programa de gestión")
print("Selecciona una entidad:")

cursor.execute('''
  SELECT name 
  FROM sqlite_master 
  WHERE type='table'
  ORDER BY name;
  ''')
contador = 1
filas = cursor.fetchall()
tabla = ""
tablas = [0]
for fila in filas:
  print(str(contador)+"-"+fila[0])
  contador += 1
  tablas.append(fila[0])
opcion = input("Tu opción elegida: ")
tabla = tablas[int(opcion)]

# Pantalla de selección de operación ############################

print("\033[2J")  # Borrar pantalla
print("\033[0;0H", end="")
print("La tabla seleccionada es: "+tabla)
print("Selecciona una operación: ")
print("1.-Crear un registro")
print("2.-Listado de registros")
print("3.-Actualizar un registro")
print("4.-Eliminar un registro")
opcion = int(input("Selecciona una opcion: "))

# Pantalla de operación ############################

print("\033[2J")  # Borrar pantalla
print("\033[0;0H", end="")
if opcion == 1:
  print("Insertamos un registro nuevo")
  cursor.execute('''
    PRAGMA table_info('''+tabla+''');
    ''')
  filas = cursor.fetchall()
  columnas = []
  for fila in filas:
    columnas.append(input("Introduce nuevo dato para "+fila[1]+": "))
  print(columnas)
  nombres_columnas = [f[1] for f in filas]

  # INSERT dinámico con placeholders
  placeholders = ",".join(["?"] * len(nombres_columnas))
  sql = f"INSERT INTO {tabla} ({','.join(nombres_columnas)}) VALUES ({placeholders})"

  cursor.execute(sql, columnas)
  basededatos.commit()
  print("Registro insertado.")
elif opcion == 2:
  print("Listamos los registros")
elif opcion == 3:
  print("Actualizamos un registro")
elif opcion == 4:
  print("Eliminamos un registro")
  
  
  
  
  
  
  
```

### aplicacion hasta el momento

```python
import sqlite3

basededatos = sqlite3.connect("empresa.db")
cursor = basededatos.cursor()

# Pantalla de selección de entidad ############################

print("\033[2J")  # Borrar pantalla
print("\033[0;0H", end="")
print("Programa de gestión")
print("Selecciona una entidad:")

cursor.execute('''
  SELECT name 
  FROM sqlite_master 
  WHERE type='table'
  ORDER BY name;
  ''')
contador = 1
filas = cursor.fetchall()
tabla = ""
tablas = [0]
for fila in filas:
  print(str(contador)+"-"+fila[0])
  contador += 1
  tablas.append(fila[0])
opcion = input("Tu opción elegida: ")
tabla = tablas[int(opcion)]

# Pantalla de selección de operación ############################

print("\033[2J")  # Borrar pantalla
print("\033[0;0H", end="")
print("La tabla seleccionada es: "+tabla)
print("Selecciona una operación: ")
print("1.-Crear un registro")
print("2.-Listado de registros")
print("3.-Actualizar un registro")
print("4.-Eliminar un registro")
opcion = int(input("Selecciona una opcion: "))

# Pantalla de operación ############################

print("\033[2J")  # Borrar pantalla
print("\033[0;0H", end="")
if opcion == 1:
  print("Insertamos un registro nuevo")
  cursor.execute('''
    PRAGMA table_info('''+tabla+''');
    ''')
  filas = cursor.fetchall()
  columnas = []
  for fila in filas:
    columnas.append(input("Introduce nuevo dato para "+fila[1]+": "))
  print(columnas)
  nombres_columnas = [f[1] for f in filas]

  # INSERT dinámico con placeholders
  placeholders = ",".join(["?"] * len(nombres_columnas))
  sql = f"INSERT INTO {tabla} ({','.join(nombres_columnas)}) VALUES ({placeholders})"

  cursor.execute(sql, columnas)
  basededatos.commit()
  print("Registro insertado.")
elif opcion == 2:
  print("Listamos los registros")
elif opcion == 3:
  print("Actualizamos un registro")
elif opcion == 4:
  print("Eliminamos un registro")
  
  
  
  
  
  
  
```

### bucle infinito

```python
import sqlite3

basededatos = sqlite3.connect("empresa.db")
cursor = basededatos.cursor()
while True:
  # Pantalla de selección de entidad ############################

  print("\033[2J")  # Borrar pantalla
  print("\033[0;0H", end="")
  print("Programa de gestión")
  print("Selecciona una entidad:")

  cursor.execute('''
    SELECT name 
    FROM sqlite_master 
    WHERE type='table'
    ORDER BY name;
    ''')
  contador = 1
  filas = cursor.fetchall()
  tabla = ""
  tablas = [0]
  for fila in filas:
    print(str(contador)+"-"+fila[0])
    contador += 1
    tablas.append(fila[0])
  opcion = input("Tu opción elegida: ")
  tabla = tablas[int(opcion)]

  # Pantalla de selección de operación ############################

  print("\033[2J")  # Borrar pantalla
  print("\033[0;0H", end="")
  print("La tabla seleccionada es: "+tabla)
  print("Selecciona una operación: ")
  print("1.-Crear un registro")
  print("2.-Listado de registros")
  print("3.-Actualizar un registro")
  print("4.-Eliminar un registro")
  opcion = int(input("Selecciona una opcion: "))

  # Pantalla de operación ############################

  print("\033[2J")  # Borrar pantalla
  print("\033[0;0H", end="")
  if opcion == 1:
    print("Insertamos un registro nuevo")
    cursor.execute('''
      PRAGMA table_info('''+tabla+''');
      ''')
    filas = cursor.fetchall()
    columnas = []
    for fila in filas:
      columnas.append(input("Introduce nuevo dato para "+fila[1]+": "))
    print(columnas)
    nombres_columnas = [f[1] for f in filas]

    # INSERT dinámico con placeholders
    placeholders = ",".join(["?"] * len(nombres_columnas))
    sql = f"INSERT INTO {tabla} ({','.join(nombres_columnas)}) VALUES ({placeholders})"

    cursor.execute(sql, columnas)
    basededatos.commit()
    print("Registro insertado.")
  elif opcion == 2:
    print("Listamos los registros")
  elif opcion == 3:
    print("Actualizamos un registro")
  elif opcion == 4:
    print("Eliminamos un registro")
  
  
  
  
  
  
  
```

### pantalla de bienvenida

```python
import sqlite3

basededatos = sqlite3.connect("empresa.db")
cursor = basededatos.cursor()

print("\033[2J")  # Borrar pantalla
print("\033[0;0H", end="")
print("Programa de gestión")
print("(c) 2025 Jose Vicente Carratala")
input("Pulsa una tecla para continuar...")

while True:
  # Pantalla de selección de entidad ############################

  print("\033[2J")  # Borrar pantalla
  print("\033[0;0H", end="")

  print("Selecciona una entidad:")

  cursor.execute('''
    SELECT name 
    FROM sqlite_master 
    WHERE type='table'
    ORDER BY name;
    ''')
  contador = 1
  filas = cursor.fetchall()
  tabla = ""
  tablas = [0]
  for fila in filas:
    print(str(contador)+"-"+fila[0])
    contador += 1
    tablas.append(fila[0])
  opcion = input("Tu opción elegida: ")
  tabla = tablas[int(opcion)]

  # Pantalla de selección de operación ############################

  print("\033[2J")  # Borrar pantalla
  print("\033[0;0H", end="")
  print("La tabla seleccionada es: "+tabla)
  print("Selecciona una operación: ")
  print("1.-Crear un registro")
  print("2.-Listado de registros")
  print("3.-Actualizar un registro")
  print("4.-Eliminar un registro")
  opcion = int(input("Selecciona una opcion: "))

  # Pantalla de operación ############################

  print("\033[2J")  # Borrar pantalla
  print("\033[0;0H", end="")
  if opcion == 1:
    print("Insertamos un registro nuevo")
    cursor.execute('''
      PRAGMA table_info('''+tabla+''');
      ''')
    filas = cursor.fetchall()
    columnas = []
    for fila in filas:
      columnas.append(input("Introduce nuevo dato para "+fila[1]+": "))
    print(columnas)
    nombres_columnas = [f[1] for f in filas]

    # INSERT dinámico con placeholders
    placeholders = ",".join(["?"] * len(nombres_columnas))
    sql = f"INSERT INTO {tabla} ({','.join(nombres_columnas)}) VALUES ({placeholders})"

    cursor.execute(sql, columnas)
    basededatos.commit()
    print("Registro insertado.")
  elif opcion == 2:
    print("Listamos los registros")
  elif opcion == 3:
    print("Actualizamos un registro")
  elif opcion == 4:
    print("Eliminamos un registro")
  
  
  
  
  
  
  
```

### desarrollo manual de listados

```python
import sqlite3

basededatos = sqlite3.connect("empresa.db")
cursor = basededatos.cursor()

print("\033[2J")  # Borrar pantalla
print("\033[0;0H", end="")
print("Programa de gestión")
print("(c) 2025 Jose Vicente Carratala")
input("Pulsa una tecla para continuar...")

while True:
  # Pantalla de selección de entidad ############################

  print("\033[2J")  # Borrar pantalla
  print("\033[0;0H", end="")

  print("Selecciona una entidad:")

  cursor.execute('''
    SELECT name 
    FROM sqlite_master 
    WHERE type='table'
    ORDER BY name;
    ''')
  contador = 1
  filas = cursor.fetchall()
  tabla = ""
  tablas = [0]
  for fila in filas:
    print(str(contador)+"-"+fila[0])
    contador += 1
    tablas.append(fila[0])
  opcion = input("Tu opción elegida: ")
  tabla = tablas[int(opcion)]

  # Pantalla de selección de operación ############################

  print("\033[2J")  # Borrar pantalla
  print("\033[0;0H", end="")
  print("La tabla seleccionada es: "+tabla)
  print("Selecciona una operación: ")
  print("1.-Crear un registro")
  print("2.-Listado de registros")
  print("3.-Actualizar un registro")
  print("4.-Eliminar un registro")
  opcion = int(input("Selecciona una opcion: "))

  # Pantalla de operación ############################

  print("\033[2J")  # Borrar pantalla
  print("\033[0;0H", end="")
  if opcion == 1:
    print("Insertamos un registro nuevo")
    cursor.execute('''
      PRAGMA table_info('''+tabla+''');
      ''')
    filas = cursor.fetchall()
    columnas = []
    for fila in filas:
      columnas.append(input("Introduce nuevo dato para "+fila[1]+": "))
    print(columnas)
    nombres_columnas = [f[1] for f in filas]

    # INSERT dinámico con placeholders
    placeholders = ",".join(["?"] * len(nombres_columnas))
    sql = f"INSERT INTO {tabla} ({','.join(nombres_columnas)}) VALUES ({placeholders})"

    cursor.execute(sql, columnas)
    basededatos.commit()
    print("Registro insertado.")
  elif opcion == 2:
    print("Listamos los registros")
    cursor.execute('''
      SELECT * FROM '''+tabla+''';
      ''')
    filas = cursor.fetchall()
    for fila in filas:
      print(fila)
    input("Pulsa una tecla para continuar...")
  elif opcion == 3:
    print("Actualizamos un registro")
  elif opcion == 4:
    print("Eliminamos un registro")
  
  
  
  
  
  
  
```

### ayuda de la inteligencia artificial

```python
#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import sqlite3
import os
import sys
from textwrap import shorten

DB_PATH = "empresa.db"

# =======================
# ANSI / Estilo consola
# =======================
RESET = "\033[0m"
BOLD = "\033[1m"
DIM = "\033[2m"
ITALIC = "\033[3m"
UNDER = "\033[4m"

FG_BLACK   = "\033[30m"
FG_RED     = "\033[31m"
FG_GREEN   = "\033[32m"
FG_YELLOW  = "\033[33m"
FG_BLUE    = "\033[34m"
FG_MAGENTA = "\033[35m"
FG_CYAN    = "\033[36m"
FG_WHITE   = "\033[37m"

BG_BLACK   = "\033[40m"
BG_RED     = "\033[41m"
BG_GREEN   = "\033[42m"
BG_YELLOW  = "\033[43m"
BG_BLUE    = "\033[44m"
BG_MAGENTA = "\033[45m"
BG_CYAN    = "\033[46m"
BG_WHITE   = "\033[47m"

CLEAR = "\033[2J"
HOME = "\033[0;0H"

# Box-drawing
HL = "─"
VL = "│"
TL = "┌"
TR = "┐"
BL = "└"
BR = "┘"
TJ = "┬"
BJ = "┴"
LJ = "├"
RJ = "┤"
CJ = "┼"

PAGE_SIZE = 20
TRUNC = 40  # truncado visual por celda

def cls():
    print(CLEAR + HOME, end="")

def banner():
    title = f"{BOLD}{FG_CYAN}Programa de gestión{RESET}"
    author = f"{DIM}(c) 2025 Jose Vicente Carratala{RESET}"
    bar = HL * 60
    print(f"{TL}{bar}{TR}")
    print(f"{VL} {title:<58}{VL}")
    print(f"{VL} {author:<58}{VL}")
    print(f"{BL}{bar}{BR}")

def pause(msg="Pulsa una tecla para continuar..."):
    try:
        input(f"{DIM}{msg}{RESET}")
    except (EOFError, KeyboardInterrupt):
        sys.exit(0)

def error(msg):
    print(f"{FG_RED}{BOLD}✗ {msg}{RESET}")

def success(msg):
    print(f"{FG_GREEN}{BOLD}✓ {msg}{RESET}")

def info(msg):
    print(f"{FG_CYAN}{msg}{RESET}")

def ask(prompt):
    return input(f"{FG_YELLOW}? {prompt}{RESET}")

def ask_int(prompt, minv=None, maxv=None):
    while True:
        val = input(f"{FG_YELLOW}? {prompt}{RESET}")
        try:
            n = int(val)
            if minv is not None and n < minv:
                error(f"El valor debe ser ≥ {minv}.")
                continue
            if maxv is not None and n > maxv:
                error(f"El valor debe ser ≤ {maxv}.")
                continue
            return n
        except ValueError:
            error("Introduce un número válido.")

def connect(db_path):
    try:
        return sqlite3.connect(db_path)
    except sqlite3.Error as e:
        error(f"No se pudo abrir la BD: {e}")
        sys.exit(1)

# =======================
# Utilidades de esquema
# =======================
def list_tables(cur):
    cur.execute("""
        SELECT name
        FROM sqlite_master
        WHERE type='table' AND name NOT LIKE 'sqlite_%'
        ORDER BY name;
    """)
    return [r[0] for r in cur.fetchall()]

def table_info(cur, table):
    cur.execute(f"PRAGMA table_info({table});")
    # cid, name, type, notnull, dflt_value, pk
    cols = cur.fetchall()
    return cols

def primary_keys(columns_info):
    # Devuelve lista de nombres de columnas que forman la PK (orden por cid/PRAGMA)
    pks = [c[1] for c in columns_info if c[5] > 0]
    # PRAGMA pk>0 indica orden, así que ordenamos por c[5]
    pks = [c[1] for c in sorted(columns_info, key=lambda x: x[5] if x[5] else 0) if c[5] > 0]
    return pks

def column_names(columns_info):
    return [c[1] for c in columns_info]

def is_integer_pk_autoinc(columns_info, col_name):
    # Heurística: tipo contiene "INT" y es PK
    for c in columns_info:
        if c[1] == col_name:
            return c[5] > 0 and "INT" in (c[2] or "").upper()
    return False

# =======================
# Render de tablas
# =======================
def format_table(headers, rows, max_width=TRUNC):
    # calcular anchos
    widths = [len(str(h)) for h in headers]
    for row in rows:
        for i, cell in enumerate(row):
            cell_s = "" if cell is None else str(cell)
            lw = len(cell_s)
            if lw > max_width:
                lw = max_width
            if lw > widths[i]:
                widths[i] = lw

    def hline(left, mid, right):
        parts = []
        for w in widths:
            parts.append(HL * (w + 2))
        return left + mid.join(parts) + right

    def render_row(values):
        cells = []
        for i, v in enumerate(values):
            s = "" if v is None else str(v)
            s = shorten(s, width=widths[i], placeholder="…") if len(s) > widths[i] else s
            cells.append(f" {s:<{widths[i]}} ")
        return VL + VL.join(cells) + VL

    top = hline(TL, TJ, TR)
    sep = hline(LJ, CJ, RJ)
    bot = hline(BL, BJ, BR)

    lines = [top, render_row([f"{BOLD}{h}{RESET}" for h in headers]), sep]
    for r in rows:
        lines.append(render_row(r))
    lines.append(bot)
    return "\n".join(lines)

def paginated_print(headers, rows):
    if not rows:
        info("No hay registros.")
        return
    total = len(rows)
    page = 0
    while True:
        cls()
        banner()
        start = page * PAGE_SIZE
        end = min(start + PAGE_SIZE, total)
        subset = rows[start:end]
        print(f"{DIM}Mostrando {start+1}-{end} de {total}{RESET}\n")
        print(format_table(headers, subset))
        print()
        cmd = input(f"{DIM}[N]ext, [P]rev, [Q]uit ▶ {RESET}").strip().lower()
        if cmd in ("q", ""):
            break
        if cmd == "n" and end < total:
            page += 1
        elif cmd == "p" and page > 0:
            page -= 1

# =======================
# CRUD Operations
# =======================
def op_create(cur, con, table):
    cls()
    banner()
    print(f"{BOLD}Insertar en {table}{RESET}\n")
    cols = table_info(cur, table)
    names = column_names(cols)
    values = []
    for c in cols:
        name, ctype, notnull, dflt, pk = c[1], c[2], c[3], c[4], c[5]
        hint = []
        if pk: hint.append("PK")
        if notnull and dflt is None: hint.append("NOT NULL")
        if dflt is not None: hint.append(f"DEF={dflt}")
        if ctype: hint.append(ctype)
        tag = f" ({', '.join(hint)})" if hint else ""
        val = input(f"{FG_YELLOW}· {name}{RESET}{DIM}{tag}{RESET} (Enter=NULL): ").strip()
        if val == "":
            values.append(None)
        else:
            values.append(val)

    placeholders = ",".join(["?"] * len(names))
    sql = f"INSERT INTO {table} ({','.join(names)}) VALUES ({placeholders})"
    try:
        cur.execute(sql, values)
        con.commit()
        success("Registro insertado.")
    except sqlite3.Error as e:
        error(f"No se pudo insertar: {e}")
    pause()

def op_list(cur, table):
    cls()
    banner()
    print(f"{BOLD}Listado de {table}{RESET}\n")
    cols = table_info(cur, table)
    names = column_names(cols)
    try:
        cur.execute(f"SELECT {', '.join(names)} FROM {table};")
        rows = cur.fetchall()
        paginated_print(names, rows)
    except sqlite3.Error as e:
        error(f"No se pudo listar: {e}")
        pause()

def read_by_pk(cur, table, pk_cols, pk_values):
    where = " AND ".join([f"{c}=?" for c in pk_cols])
    sql = f"SELECT * FROM {table} WHERE {where} LIMIT 1;"
    cur.execute(sql, pk_values)
    return cur.fetchone()

def op_update(cur, con, table):
    cls()
    banner()
    print(f"{BOLD}Actualizar en {table}{RESET}\n")
    cols = table_info(cur, table)
    names = column_names(cols)
    pk_cols = primary_keys(cols)
    if not pk_cols:
        error("Esta tabla no tiene clave primaria definida. Actualización no soportada.")
        return pause()

    # Pedir PK(s)
    pk_values = []
    print(f"{FG_CYAN}Introduce la clave primaria para localizar el registro:{RESET}")
    for pk in pk_cols:
        v = input(f"· {pk}: ").strip()
        if v == "":
            error("La clave primaria no puede quedar vacía.")
            return pause()
        pk_values.append(v)

    # Leer registro actual
    row = read_by_pk(cur, table, pk_cols, pk_values)
    if not row:
        error("No se encontró el registro con esa PK.")
        return pause()

    # Mostrar registro actual
    print("\nRegistro actual:")
    print(format_table(names, [row]))
    print()

    # Solicitar nuevos valores (Enter = mantener)
    new_values = []
    for i, c in enumerate(cols):
        cname = c[1]
        current = row[i]
        if cname in pk_cols:
            # Bloqueamos edición de PK por simplicidad (se podría permitir)
            print(f"{DIM}{cname} (PK) = {current} (no editable){RESET}")
            new_values.append(current)
        else:
            val = input(f"{FG_YELLOW}· {cname}{RESET} {DIM}[actual: {current}]{RESET} (Enter=mantener): ")
            if val.strip() == "":
                new_values.append(current)
            else:
                new_values.append(val)

    # Construir UPDATE
    set_clause = ", ".join([f"{n}=?" for n in names if n not in pk_cols])
    where = " AND ".join([f"{c}=?" for c in pk_cols])
    params = [new_values[names.index(n)] for n in names if n not in pk_cols] + pk_values

    sql = f"UPDATE {table} SET {set_clause} WHERE {where};"
    try:
        cur.execute(sql, params)
        con.commit()
        success(f"Filas afectadas: {cur.rowcount}")
    except sqlite3.Error as e:
        error(f"No se pudo actualizar: {e}")
    pause()

def op_delete(cur, con, table):
    cls()
    banner()
    print(f"{BOLD}Eliminar en {table}{RESET}\n")
    cols = table_info(cur, table)
    names = column_names(cols)
    pk_cols = primary_keys(cols)
    if not pk_cols:
        error("Esta tabla no tiene clave primaria definida. Eliminación no soportada.")
        return pause()

    # Pedir PK(s)
    pk_values = []
    print(f"{FG_CYAN}Introduce la clave primaria del registro a eliminar:{RESET}")
    for pk in pk_cols:
        v = input(f"· {pk}: ").strip()
        if v == "":
            error("La clave primaria no puede quedar vacía.")
            return pause()
        pk_values.append(v)

    # Confirmación mostrando el registro
    row = read_by_pk(cur, table, pk_cols, pk_values)
    if not row:
        error("No se encontró el registro con esa PK.")
        return pause()

    print("\nRegistro a eliminar:")
    print(format_table(names, [row]))
    print()
    conf = input(f"{FG_RED}{BOLD}¿Seguro que deseas eliminarlo? (s/N): {RESET}").strip().lower()
    if conf != "s":
        info("Cancelado.")
        return pause()

    where = " AND ".join([f"{c}=?" for c in pk_cols])
    sql = f"DELETE FROM {table} WHERE {where};"
    try:
        cur.execute(sql, pk_values)
        con.commit()
        success(f"Filas afectadas: {cur.rowcount}")
    except sqlite3.Error as e:
        error(f"No se pudo eliminar: {e}")
    pause()

# =======================
# Menús
# =======================
def select_table(cur):
    while True:
        cls()
        banner()
        print(f"{BOLD}Selecciona una entidad (tabla){RESET}\n")
        tables = list_tables(cur)
        if not tables:
            error("No hay tablas en la base de datos.")
            pause("Crea alguna tabla y vuelve a ejecutar. Pulsa una tecla…")
            sys.exit(0)

        for i, t in enumerate(tables, 1):
            print(f"{FG_CYAN}{i:>2}{RESET} {VL} {t}")
        print()
        op = ask_int("Tu opción elegida: ", minv=1, maxv=len(tables))
        return tables[op - 1]

def select_operation(table):
    cls()
    banner()
    print(f"{BOLD}Tabla seleccionada: {FG_GREEN}{table}{RESET}\n")
    print(f"{BOLD}Selecciona una operación:{RESET}")
    print(f"  {FG_CYAN}1{RESET} {VL} Crear un registro")
    print(f"  {FG_CYAN}2{RESET} {VL} Listado de registros")
    print(f"  {FG_CYAN}3{RESET} {VL} Actualizar un registro")
    print(f"  {FG_CYAN}4{RESET} {VL} Eliminar un registro")
    print(f"  {FG_CYAN}5{RESET} {VL} Cambiar de tabla")
    print(f"  {FG_CYAN}0{RESET} {VL} Salir")
    print()
    return ask_int("Selecciona una opción: ", minv=0, maxv=5)

# =======================
# Main loop
# =======================
def main():
    con = connect(DB_PATH)
    cur = con.cursor()

    cls()
    banner()
    pause()

    current_table = None

    while True:
        if not current_table:
            current_table = select_table(cur)

        op = select_operation(current_table)
        if op == 0:
            cls()
            info("Hasta pronto 👋")
            break
        elif op == 1:
            op_create(cur, con, current_table)
        elif op == 2:
            op_list(cur, current_table)
        elif op == 3:
            op_update(cur, con, current_table)
        elif op == 4:
            op_delete(cur, con, current_table)
        elif op == 5:
            current_table = None

    try:
        con.close()
    except Exception:
        pass

if __name__ == "__main__":
    try:
        main()
    except KeyboardInterrupt:
        cls()
        info("Interrumpido por el usuario.")
```

### mas mejoras

```python
#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import sqlite3
import os
import sys
import re
from shutil import get_terminal_size

DB_PATH = "empresa.db"

# =======================
# ANSI / Estilo consola
# =======================
# Colores base
RESET_RAW = "\033[0m"
BOLD = "\033[1m"
DIM = "\033[2m"
UNDER = "\033[4m"

FG_BLACK   = "\033[30m"
FG_RED     = "\033[31m"
FG_GREEN   = "\033[32m"
FG_YELLOW  = "\033[33m"
FG_BLUE    = "\033[34m"
FG_MAGENTA = "\033[35m"
FG_CYAN    = "\033[36m"
FG_WHITE   = "\033[37m"

BG_BLACK   = "\033[40m"
BG_RED     = "\033[41m"
BG_GREEN   = "\033[42m"
BG_YELLOW  = "\033[43m"
BG_BLUE    = "\033[44m"
BG_MAGENTA = "\033[45m"
BG_CYAN    = "\033[46m"
BG_WHITE   = "\033[47m"

CLEAR = "\033[2J"
HOME = "\033[0;0H"

# Box-drawing
HL = "─"; VL = "│"; TL = "┌"; TR = "┐"; BL = "└"; BR = "┘"; TJ = "┬"; BJ = "┴"; LJ = "├"; RJ = "┤"; CJ = "┼"

# =======================
# Tema (Light por defecto)
# =======================
LIGHT_THEME = True   # pon False para no forzar blanco
ZEBRA_ROWS  = True   # alterna leve sombreado filas

THEME_FG = FG_BLACK if LIGHT_THEME else FG_WHITE
THEME_BG = BG_WHITE if LIGHT_THEME else BG_BLACK

# Importante: RESET que vuelve al tema, no al terminal por defecto
RESET = f"{RESET_RAW}{THEME_FG}{THEME_BG}"

# =======================
# Config
# =======================
PAGE_SIZE = 20
TRUNC = 40  # truncado visual por celda
TABLE_MIN_WIDTH = 20

# =======================
# Utils: longitud visible
# =======================
ANSI_RE = re.compile(r"\x1b\[[0-9;]*m")

def strip_ansi(s: str) -> str:
    return ANSI_RE.sub("", s)

def vislen(s: str) -> int:
    return len(strip_ansi(s))

def pad_visible(s: str, width: int, align="left") -> str:
    """Rellena según longitud visible (ignora códigos ANSI)."""
    cur = vislen(s)
    pad = max(0, width - cur)
    if align == "right":
        return " " * pad + s
    elif align == "center":
        left = pad // 2
        right = pad - left
        return " " * left + s + " " * right
    return s + " " * pad

def truncate_visible(s: str, width: int) -> str:
    if vislen(s) <= width:
        return s
    raw = strip_ansi(s)
    if width <= 3:
        return "." * width
    return raw[: width - 3] + "..."

def term_width(default=80) -> int:
    try:
        return max(TABLE_MIN_WIDTH, get_terminal_size().columns)
    except Exception:
        return default

def cls():
    print(CLEAR + HOME + RESET, end="")

def apply_theme():
    # Establece el tema global al inicio
    print(RESET, end="")

# =======================
# Mensajería
# =======================
def banner():
    w = min(80, term_width() - 2)  # ancho cómodo
    bar = HL * w
    title = f"{BOLD}Programa de gestión{RESET}"
    author = f"{DIM}(c) 2025 Jose Vicente Carratala{RESET}"
    print(f"{THEME_FG}{THEME_BG}", end="")
    print(TL + bar + TR)
    print(VL + pad_visible(" " + title, w) + VL)
    print(VL + pad_visible(" " + author, w) + VL)
    print(BL + bar + BR)

def pause(msg="Pulsa una tecla para continuar..."):
    try:
        input(f"{DIM}{msg}{RESET}")
    except (EOFError, KeyboardInterrupt):
        sys.exit(0)

def error(msg):
    print(f"{FG_RED}{BOLD}✗ {msg}{RESET}")

def success(msg):
    print(f"{FG_GREEN}{BOLD}✓ {msg}{RESET}")

def info(msg):
    print(f"{FG_CYAN}{msg}{RESET}")

def ask(prompt):
    return input(f"{FG_YELLOW}? {prompt}{RESET}")

def ask_int(prompt, minv=None, maxv=None):
    while True:
        val = input(f"{FG_YELLOW}? {prompt}{RESET}")
        try:
            n = int(val)
            if minv is not None and n < minv:
                error(f"El valor debe ser ≥ {minv}."); continue
            if maxv is not None and n > maxv:
                error(f"El valor debe ser ≤ {maxv}."); continue
            return n
        except ValueError:
            error("Introduce un número válido.")

# =======================
# BD helpers
# =======================
def connect(db_path):
    try:
        return sqlite3.connect(db_path)
    except sqlite3.Error as e:
        error(f"No se pudo abrir la BD: {e}")
        sys.exit(1)

def list_tables(cur):
    cur.execute("""
        SELECT name
        FROM sqlite_master
        WHERE type='table' AND name NOT LIKE 'sqlite_%'
        ORDER BY name;
    """)
    return [r[0] for r in cur.fetchall()]

def table_info(cur, table):
    cur.execute(f"PRAGMA table_info({table});")
    # cid, name, type, notnull, dflt_value, pk
    return cur.fetchall()

def primary_keys(columns_info):
    # Ordenadas por índice pk (>0)
    return [c[1] for c in sorted(columns_info, key=lambda x: x[5] if x[5] else 0) if c[5] > 0]

def column_names(columns_info):
    return [c[1] for c in columns_info]

# =======================
# Render de tablas (alineación perfecta)
# =======================
def format_table(headers, rows, max_width=TRUNC):
    # calcular anchos (por longitud visible)
    widths = [max(1, vislen(str(h))) for h in headers]
    for row in rows:
        for i, cell in enumerate(row):
            cell_s = "" if cell is None else str(cell)
            lw = min(vislen(cell_s), max_width)
            widths[i] = max(widths[i], lw)

    def hline(left, mid, right):
        parts = [HL * (w + 2) for w in widths]
        return left + mid.join(parts) + right

    def render_row(values, style=None, zebra=False):
        cells = []
        for i, v in enumerate(values):
            s = "" if v is None else str(v)
            s = truncate_visible(s, widths[i])
            s = pad_visible(s, widths[i])
            cells.append(" " + s + " ")
        line = VL + VL.join(cells) + VL
        if zebra:
            # leve dim en filas alternas (sin cambiar fondo)
            line = f"{DIM}{line}{RESET}"
        if style:
            line = style + line + RESET
        return line

    top = hline(TL, TJ, TR)
    sep = hline(LJ, CJ, RJ)
    bot = hline(BL, BJ, BR)

    # Encabezado invertido para contraste
    header_style = f"{BOLD}{THEME_BG}{THEME_FG}"
    lines = [top, render_row(headers, style=header_style), sep]
    for idx, r in enumerate(rows):
        zebra = ZEBRA_ROWS and (idx % 2 == 1)
        lines.append(render_row(r, zebra=zebra))
    lines.append(bot)
    return "\n".join(lines)

def paginated_print(headers, rows, title=None):
    if not rows:
        info("No hay registros.")
        return
    total = len(rows)
    page = 0
    while True:
        cls(); apply_theme(); banner()
        if title:
            print(f"{BOLD}{title}{RESET}\n")
        start = page * PAGE_SIZE
        end = min(start + PAGE_SIZE, total)
        subset = rows[start:end]
        rango = f"{DIM}Mostrando {start+1}-{end} de {total}{RESET}"
        print(rango + "\n")
        print(format_table(headers, subset))
        print()
        cmd = input(f"{DIM}[N]ext, [P]rev, [Q]uit ▶ {RESET}").strip().lower()
        if cmd in ("q", ""):
            break
        if cmd == "n" and end < total:
            page += 1
        elif cmd == "p" and page > 0:
            page -= 1

# =======================
# CRUD
# =======================
def op_create(cur, con, table):
    cls(); apply_theme(); banner()
    print(f"{BOLD}➕ Insertar en {table}{RESET}\n")
    cols = table_info(cur, table)
    names = column_names(cols)
    values = []
    for c in cols:
        name, ctype, notnull, dflt, pk = c[1], c[2], c[3], c[4], c[5]
        hint = []
        if pk: hint.append("PK")
        if notnull and dflt is None: hint.append("NOT NULL")
        if dflt is not None: hint.append(f"DEF={dflt}")
        if ctype: hint.append(ctype)
        tag = f" ({', '.join(hint)})" if hint else ""
        val = input(f"{FG_YELLOW}· {name}{RESET}{DIM}{tag}{RESET} (Enter=NULL): ").strip()
        values.append(None if val == "" else val)

    placeholders = ",".join(["?"] * len(names))
    sql = f"INSERT INTO {table} ({','.join(names)}) VALUES ({placeholders})"
    try:
        cur.execute(sql, values); con.commit()
        success("Registro insertado.")
    except sqlite3.Error as e:
        error(f"No se pudo insertar: {e}")
    pause()

def op_list(cur, table):
    cls(); apply_theme(); banner()
    print(f"{BOLD}📋 Listado de {table}{RESET}\n")
    cols = table_info(cur, table)
    names = column_names(cols)
    try:
        cur.execute(f"SELECT {', '.join(names)} FROM {table};")
        rows = cur.fetchall()
        paginated_print(names, rows)
    except sqlite3.Error as e:
        error(f"No se pudo listar: {e}")
        pause()

def read_by_pk(cur, table, pk_cols, pk_values):
    where = " AND ".join([f"{c}=?" for c in pk_cols])
    sql = f"SELECT * FROM {table} WHERE {where} LIMIT 1;"
    cur.execute(sql, pk_values)
    return cur.fetchone()

def op_update(cur, con, table):
    cls(); apply_theme(); banner()
    print(f"{BOLD}✏️  Actualizar en {table}{RESET}\n")
    cols = table_info(cur, table)
    names = column_names(cols)
    pk_cols = primary_keys(cols)
    if not pk_cols:
        error("Esta tabla no tiene clave primaria definida. Actualización no soportada.")
        return pause()

    pk_values = []
    print(f"{FG_CYAN}Introduce la clave primaria para localizar el registro:{RESET}")
    for pk in pk_cols:
        v = input(f"· {pk}: ").strip()
        if v == "":
            error("La clave primaria no puede quedar vacía."); return pause()
        pk_values.append(v)

    row = read_by_pk(cur, table, pk_cols, pk_values)
    if not row:
        error("No se encontró el registro con esa PK."); return pause()

    print("\nRegistro actual:")
    print(format_table(names, [row]))
    print()

    new_values = []
    for i, c in enumerate(cols):
        cname = c[1]
        current = row[i]
        if cname in pk_cols:
            print(f"{DIM}{cname} (PK) = {current} (no editable){RESET}")
            new_values.append(current)
        else:
            val = input(f"{FG_YELLOW}· {cname}{RESET} {DIM}[actual: {current}]{RESET} (Enter=mantener): ")
            new_values.append(current if val.strip() == "" else val)

    set_clause = ", ".join([f"{n}=?" for n in names if n not in pk_cols])
    where = " AND ".join([f"{c}=?" for c in pk_cols])
    params = [new_values[names.index(n)] for n in names if n not in pk_cols] + pk_values

    sql = f"UPDATE {table} SET {set_clause} WHERE {where};"
    try:
        cur.execute(sql, params); con.commit()
        success(f"Filas afectadas: {cur.rowcount}")
    except sqlite3.Error as e:
        error(f"No se pudo actualizar: {e}")
    pause()

def op_delete(cur, con, table):
    cls(); apply_theme(); banner()
    print(f"{BOLD}🗑️  Eliminar en {table}{RESET}\n")
    cols = table_info(cur, table)
    names = column_names(cols)
    pk_cols = primary_keys(cols)
    if not pk_cols:
        error("Esta tabla no tiene clave primaria definida. Eliminación no soportada.")
        return pause()

    pk_values = []
    print(f"{FG_CYAN}Introduce la clave primaria del registro a eliminar:{RESET}")
    for pk in pk_cols:
        v = input(f"· {pk}: ").strip()
        if v == "":
            error("La clave primaria no puede quedar vacía."); return pause()
        pk_values.append(v)

    row = read_by_pk(cur, table, pk_cols, pk_values)
    if not row:
        error("No se encontró el registro con esa PK."); return pause()

    print("\nRegistro a eliminar:")
    print(format_table(names, [row]))
    print()
    conf = input(f"{FG_RED}{BOLD}¿Seguro que deseas eliminarlo? (s/N): {RESET}").strip().lower()
    if conf != "s":
        info("Cancelado."); return pause()

    where = " AND ".join([f"{c}=?" for c in pk_cols])
    sql = f"DELETE FROM {table} WHERE {where};"
    try:
        cur.execute(sql, pk_values); con.commit()
        success(f"Filas afectadas: {cur.rowcount}")
    except sqlite3.Error as e:
        error(f"No se pudo eliminar: {e}")
    pause()

# =======================
# Menús
# =======================
def select_table(cur):
    while True:
        cls(); apply_theme(); banner()
        print(f"{BOLD}Selecciona una entidad (tabla){RESET}\n")
        tables = list_tables(cur)
        if not tables:
            error("No hay tablas en la base de datos.")
            pause("Crea alguna tabla y vuelve a ejecutar. Pulsa una tecla…")
            sys.exit(0)

        w = len(str(len(tables)))
        for i, t in enumerate(tables, 1):
            left = pad_visible(str(i).rjust(w), w)
            print(f"{FG_CYAN}{left}{RESET} {VL} {t}")
        print()
        op = ask_int("Tu opción elegida: ", minv=1, maxv=len(tables))
        return tables[op - 1]

def select_operation(table):
    cls(); apply_theme(); banner()
    print(f"{BOLD}Tabla seleccionada: {FG_GREEN}{table}{RESET}\n")
    print(f"{BOLD}Selecciona una operación:{RESET}")
    print(f"  {FG_CYAN}1{RESET} {VL} Crear un registro")
    print(f"  {FG_CYAN}2{RESET} {VL} Listado de registros")
    print(f"  {FG_CYAN}3{RESET} {VL} Actualizar un registro")
    print(f"  {FG_CYAN}4{RESET} {VL} Eliminar un registro")
    print(f"  {FG_CYAN}5{RESET} {VL} Cambiar de tabla")
    print(f"  {FG_CYAN}0{RESET} {VL} Salir")
    print()
    return ask_int("Selecciona una opción: ", minv=0, maxv=5)

# =======================
# Main
# =======================
def main():
    con = connect(DB_PATH)
    cur = con.cursor()

    cls(); apply_theme(); banner()
    pause()

    current_table = None
    while True:
        if not current_table:
            current_table = select_table(cur)

        op = select_operation(current_table)
        if op == 0:
            cls(); apply_theme()
            info("Hasta pronto 👋")
            break
        elif op == 1:
            op_create(cur, con, current_table)
        elif op == 2:
            op_list(cur, current_table)
        elif op == 3:
            op_update(cur, con, current_table)
        elif op == 4:
            op_delete(cur, con, current_table)
        elif op == 5:
            current_table = None

    try:
        con.close()
    except Exception:
        pass

if __name__ == "__main__":
    try:
        main()
    except KeyboardInterrupt:
        cls(); apply_theme()
        info("Interrumpido por el usuario.")
```

### Conceptos de consola

```python
Todos los sistemas operativos tienen terminal/consola:

En Windows, es el CMD (vestigio del antiguo MS-DOS)
En macOS, es la terminal (el UNIX que realmente hay debajo de macOS)
Y en Linux, es la terminal

Los tres sistemas operativos, a dia de hoy (2025), soportan
1.-Programas de consola/terminal - programados en cualquier lenguaje
2.-Programas de ventanas (tkinter) - programados en cualquier lenguaje
```

<a id="simulacro-examen"></a>
## Simulacro examen

### Creo la base de datos

```sql
sudo mysql -u root -p

CREATE DATABASE blog2526;
```

### creo tablas

```sql
CREATE TABLE entradas (
  `Identificador` INT NOT NULL , 
  `titulo` VARCHAR(150) NOT NULL , 
  `contenido` VARCHAR(255) NOT NULL , 
  `fecha` VARCHAR(50) NOT NULL , 
  `autor` INT NOT NULL 
) ENGINE = InnoDB;

CREATE TABLE autores (
  `Identificador` INT NOT NULL , 
  `nombre` VARCHAR(150) NOT NULL , 
  `apellidos` VARCHAR(255) NOT NULL , 
  `email` VARCHAR(150) NOT NULL 
) ENGINE = InnoDB;
```

### añadir claves primarias

```sql
DESCRIBE entradas;

ALTER TABLE entradas
  ADD PRIMARY KEY (`Identificador`);
  
  ALTER TABLE entradas
  MODIFY COLUMN Identificador INT NOT NULL AUTO_INCREMENT;
  
  DESCRIBE entradas;
  
  
DESCRIBE autores;

ALTER TABLE autores
  ADD PRIMARY KEY (`Identificador`);
  
  ALTER TABLE autores
  MODIFY COLUMN Identificador INT NOT NULL AUTO_INCREMENT;
  
  DESCRIBE autores;
```

### clave foranea de autores a entradas

```sql
ALTER TABLE entradas 
ADD CONSTRAINT `autoresaentradas` 
FOREIGN KEY (`autor`) REFERENCES `autores`(`Identificador`) 
ON DELETE RESTRICT 
ON UPDATE RESTRICT;
```

### insercion de datos de muestra

```sql
INSERT INTO autores (nombre, apellidos, email) VALUES
('Carlos', 'Pérez Gómez', 'carlos.perez@example.com'),
('María', 'López Sánchez', 'maria.lopez@example.com'),
('Javier', 'Martínez Ruiz', 'javier.martinez@example.com'),
('Lucía', 'García Torres', 'lucia.garcia@example.com'),
('Andrés', 'Ramírez Fernández', 'andres.ramirez@example.com'),
('Elena', 'Moreno Díaz', 'elena.moreno@example.com'),
('Sergio', 'Hernández Navarro', 'sergio.hernandez@example.com'),
('Patricia', 'Gómez León', 'patricia.gomez@example.com'),
('Raúl', 'Castillo Ortega', 'raul.castillo@example.com'),
('Laura', 'Santos Vega', 'laura.santos@example.com'),
('Diego', 'Cano Romero', 'diego.cano@example.com'),
('Marta', 'Jiménez Soto', 'marta.jimenez@example.com'),
('Rubén', 'Pardo Iglesias', 'ruben.pardo@example.com'),
('Nuria', 'Cruz Herrera', 'nuria.cruz@example.com'),
('Héctor', 'Vázquez Molina', 'hector.vazquez@example.com'),
('Adriana', 'Reyes Campos', 'adriana.reyes@example.com'),
('Pablo', 'Suárez Gil', 'pablo.suarez@example.com'),
('Sara', 'Nieto Rivas', 'sara.nieto@example.com'),
('Álvaro', 'Ruiz Pastor', 'alvaro.ruiz@example.com'),
('Clara', 'Ortega Lozano', 'clara.ortega@example.com');
```

### insercion de entradas

```sql
INSERT INTO entradas (titulo, contenido, fecha, autor) VALUES
('Introducción a la programación en Python', 'Una guía para comenzar a programar con Python desde cero.', '2025-01-05', 1),
('Cómo crear tu primera página web con HTML y CSS', 'Aprende los fundamentos del diseño web con ejemplos prácticos.', '2025-01-10', 2),
('JavaScript moderno: funciones flecha y promesas', 'Exploramos las características modernas del lenguaje JavaScript.', '2025-01-12', 3),
('Instalar y configurar MySQL en Ubuntu', 'Guía paso a paso para instalar MySQL en sistemas basados en Linux.', '2025-01-15', 4),
('Buenas prácticas de seguridad en PHP', 'Cómo proteger tu aplicación web frente a ataques comunes.', '2025-01-18', 5),
('Introducción a Docker para desarrolladores', 'Aprende a crear contenedores para tus proyectos de desarrollo.', '2025-01-20', 6),
('Versionado de código con Git y GitHub', 'Todo lo que necesitas saber para trabajar en equipo con control de versiones.', '2025-01-22', 7),
('APIs RESTful con Flask y Python', 'Construye tus propias APIs usando el microframework Flask.', '2025-01-25', 8),
('Diseño responsivo con CSS Grid y Flexbox', 'Técnicas modernas para crear sitios adaptativos y elegantes.', '2025-01-28', 9),
('Automatización de tareas con Python', 'Ejemplos de cómo automatizar procesos repetitivos con scripts.', '2025-02-02', 10),
('Introducción a React.js', 'Cómo empezar a desarrollar interfaces modernas con React.', '2025-02-05', 11),
('Bases de datos NoSQL: una visión general', 'Compara MongoDB, Redis y otros sistemas de almacenamiento.', '2025-02-07', 12),
('Optimización de rendimiento en WordPress', 'Consejos para acelerar tu sitio web WordPress.', '2025-02-10', 13),
('Cómo desplegar una app en la nube con AWS', 'Pasos esenciales para llevar tu aplicación a producción.', '2025-02-12', 14),
('Aprendiendo Node.js paso a paso', 'Una introducción práctica al entorno de ejecución de JavaScript.', '2025-02-14', 15),
('Machine Learning con Python y scikit-learn', 'Primeros pasos en el aprendizaje automático.', '2025-02-18', 16),
('Cómo proteger tu red doméstica', 'Recomendaciones básicas de ciberseguridad para usuarios domésticos.', '2025-02-20', 17),
('Programación orientada a objetos en Java', 'Conceptos clave como clases, objetos, herencia y polimorfismo.', '2025-02-22', 18),
('Diseño de bases de datos relacionales', 'Cómo modelar tus datos correctamente con claves primarias y foráneas.', '2025-02-25', 19),
('Inteligencia artificial en la web moderna', 'Exploramos el papel de la IA en las aplicaciones actuales.', '2025-02-28', 20);
```

### seleccion de autores para aclararnos

```sql
SELECT * FROM autores;
```

### left join

```sql
SELECT 
entradas.titulo,
entradas.contenido,
entradas.fecha,
autores.nombre,
autores.apellidos,
autores.email
 FROM
entradas
LEFT JOIN autores
ON entradas.autor = autores.Identificador;
```

### crear una vista

```sql
CREATE VIEW entradas_con_autores AS 
SELECT 
entradas.titulo,
entradas.contenido,
entradas.fecha,
autores.nombre,
autores.apellidos,
autores.email
 FROM
entradas
LEFT JOIN autores
ON entradas.autor = autores.Identificador;

SELECT
*
FROM
entradas_con_autores;
```

### crear usuario con privilegios

```sql
CREATE USER 
'blog2526'@'localhost' 
IDENTIFIED BY 'blog2526';

GRANT USAGE ON *.* TO 'blog2526'@'localhost';

ALTER USER 'blog2526'@'localhost' 
REQUIRE NONE 
WITH MAX_QUERIES_PER_HOUR 0 
MAX_CONNECTIONS_PER_HOUR 0 
MAX_UPDATES_PER_HOUR 0 
MAX_USER_CONNECTIONS 0;

GRANT ALL PRIVILEGES ON `blog2526`.* 
TO 'blog2526'@'localhost';

FLUSH PRIVILEGES;
```

<a id="simulacro-de-examen-2"></a>
## Simulacro de examen 2

### Enunciado

```markdown
Actividad de final de unidad:

Crea la base de datos de tu propio blog/portafolio

Crea al menos dos tablas:
1.-la tabla de noticias/piezas de portafolio, que tendrá:
-Identificador (PK)
-titulo
-descripcion
-fecha
-imagen
-autor (FK)

2.-La tabla de autores
-Identificador (PK)
-nombre
-apellidos
-email

Crea las claves primarias de cada una de las dos tablas

Crea la clave foránea de una tabla a otra

Inserta un registro en cada tabla

Crea una peticion cruzada (left join)

Crea una vista

Crea un usuario con permisos para poder acceder

Actividad de final de unidad:

Sobre la base de datos creada en la unidad anterior (portafolio/blog):

-Inserta un numero representativo de articulos de portafolio/blog
-Selecciona de varias formas los artículos (fecha ascendiente/descendiente, por ejemplo)

Selecciona desde la vista creada


Actividad de final de unidad:

Sobre la base de datos creada en la unidad anterior (portafolio/blog):


Asegura que puedes realizar operaciones de actualización sobre los datos de la tabla

Asegura que puedes realizar operaciones de eliminación sobre los datos de la tabla
```

### resolucion del examen

```sql
Recomiendo enormemente hacer el examen de bases de datos dentro de la maquina virtual

ssh josevicente@192.168.1.176

sudo mysql -u root -p

CREATE DATABASE portafolio;

SHOW DATABASES;

USE portafolio;

SHOW TABLES;

CREATE TABLE piezas(
  Identificador INT auto_increment PRIMARY KEY,
  titulo VARCHAR(255),
  descripcion TEXT,
  fecha VARCHAR(255),
  id_autor INT
);

SHOW TABLES;

DESCRIBE piezas;

CREATE TABLE autores(
  Identificador INT auto_increment PRIMARY KEY,
  nombre VARCHAR(255),
  apellidos VARCHAR(255),
  email VARCHAR(255)
);

SHOW TABLES;

DESCRIBE autores;

ALTER TABLE piezas 
ADD CONSTRAINT autores_a_piezas 
FOREIGN KEY (id_autor) 
REFERENCES autores(Identificador) 
ON DELETE RESTRICT 
ON UPDATE RESTRICT;

SELECT * FROM piezas;

SELECT * FROM autores;
```

### le damos algo de contenido a la base de datos

```sql
INSERT INTO autores VALUES(
  NULL,
  'Jose Vicente',
  'Carratala Sanchis',
  'info@jocarsa.com'
);

SELECT * FROM autores;

INSERT INTO piezas VALUES(
  NULL,
  'Titulo de la pieza 1',
  'Descripción de la pieza 1',
  '2025-11-03',
  1
);

SELECT * FROM piezas;
```

### alteramos taba

```sql
ALTER TABLE piezas
ADD COLUMN imagen VARCHAR(255);

DESCRIBE piezas;
```

### peticion cruzada

```sql
ALTER TABLE piezas
ADD COLUMN imagen VARCHAR(255);

DESCRIBE piezas;
```

### vista cruzada

```sql
SELECT 
autores.nombre,
autores.apellidos,
autores.email,
piezas.titulo,
piezas.descripcion,
piezas.fecha,
piezas.imagen
 FROM piezas
LEFT JOIN autores
ON piezas.id_autor = autores.Identificador;

Ahora creamos la vista
CREATE VIEW piezas_con_autores AS 
SELECT 
autores.nombre,
autores.apellidos,
autores.email,
piezas.titulo,
piezas.descripcion,
piezas.fecha,
piezas.imagen
 FROM piezas
LEFT JOIN autores
ON piezas.id_autor = autores.Identificador;

SELECT * FROM piezas_con_autores;
```

### crear usuario con permisos

```sql
CREATE USER 
'portafolio'@'localhost' 
IDENTIFIED  BY 'Portafolio123$';

GRANT USAGE ON *.* TO 'portafolio'@'localhost';

ALTER USER 'portafolio'@'localhost' 
REQUIRE NONE 
WITH MAX_QUERIES_PER_HOUR 0 
MAX_CONNECTIONS_PER_HOUR 0 
MAX_UPDATES_PER_HOUR 0 
MAX_USER_CONNECTIONS 0;

GRANT ALL PRIVILEGES ON `portafolio`.* 
TO 'portafolio'@'localhost';

FLUSH PRIVILEGES;
```

### demostramos actualizacion

```sql
SELECT * FROM piezas;

UPDATE piezas SET imagen = 'josevicente.jpg' WHERE Identificador = 1;

SELECT * FROM piezas;

DELETE FROM piezas WHERE Identificador = 1;

SELECT * FROM piezas;
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


<a id="programacion-de-bases-de-datos"></a>
# Programación de bases de datos

<a id="introduccion-lenguaje-de-programacion"></a>
## Introducción. Lenguaje de programación

La programación de bases de datos es una disciplina que combina conocimientos de informática con habilidades matemáticas para crear sistemas eficientes y seguros para almacenar, recuperar y gestionar grandes cantidades de información. En esta subunidad, nos adentramos en el concepto fundamental de lenguaje de programación (LDP) dentro del contexto de las bases de datos.

El LDP es un conjunto de reglas sintácticas y semánticas que permite a los desarrolladores crear instrucciones que interactúan con la base de datos. Este lenguaje es el medio mediante el cual se manipulan los datos, desde su inserción hasta su eliminación y modificación. Es una herramienta poderosa para automatizar tareas repetitivas y optimizar el acceso a la información.

El LDP no es un lenguaje de programación tradicional como C++ o Java, sino que es específico para las operaciones en bases de datos. Algunos ejemplos populares incluyen SQL (Structured Query Language) para bases de datos relacionales y PL/SQL (Procedural Language/SQL) para Oracle. Estos lenguajes ofrecen una sintaxis especializada que facilita la manipulación de los datos almacenados en la base de datos.

La importancia del LDP radica en su capacidad para realizar operaciones complejas con solo unas pocas líneas de código. Por ejemplo, con un comando SQL simple como `SELECT * FROM tabla`, se puede recuperar toda la información de una tabla específica. Sin embargo, el poder real del LDP se demuestra cuando se utilizan estructuras más avanzadas como las subconsultas y los procedimientos almacenados.

Además del lenguaje de programación, es crucial entender cómo se organizan y gestionan los datos dentro de la base de datos. Esto implica conocer conceptos como claves primarias, índices y restricciones de validación. Estos elementos son fundamentales para garantizar la integridad y eficiencia del sistema.

La programación de bases de datos también aborda el tema de las transacciones. Una transacción es una serie de operaciones que se ejecutan como un bloque único, asegurando que todas las operaciones sean exitosas o ninguna tenga lugar. Esto es crucial para mantener la consistencia y coherencia de los datos en sistemas empresariales.

En resumen, el LDP es una herramienta esencial para cualquier desarrollador de bases de datos. Permite a los profesionales crear soluciones eficientes y seguras que manejen grandes volúmenes de información. A través del estudio de este lenguaje, se adquiere un conocimiento profundo sobre cómo interactuar con las bases de datos, lo que es fundamental para el desarrollo de aplicaciones informáticas modernas.

### blob

```markdown
Los campos blob en MySQL permiten meter datos binarios
-documentos
-imagenes
-loque sea
Dentro de una base de datos MySQL

La pregunta es si lo queremos

TINYBLOB = 255byes = un cuarto de KB

BLOB = 65535bytes = 64KB

MEDIUMBLOB 16777215 = 16MB

LONGBLOB = 4GB
```

### admin

```
<?php
session_start();

// Conexión a la base de datos (una sola vez, al inicio del archivo)
$c = new mysqli("localhost","training_center","training_center","training_center");
if ($c->connect_error) {
  die("Error de conexión: " . $c->connect_error);
}
// Conexión a la base de datos (una sola vez, al inicio del archivo)
$c = new mysqli("localhost","training_center","training_center","training_center");
if ($c->connect_error) {
  die("Error de conexión: " . $c->connect_error);
}

/*-----------------------------------------------------------
  0-bis) Metadatos de columnas de la tabla inscripciones
         (incluye detección de BLOB)
-----------------------------------------------------------*/
$tableColumns = [];
$blobColumns  = [];

$colsRes = $c->query("
  SELECT COLUMN_NAME, DATA_TYPE
  FROM information_schema.columns
  WHERE table_schema='training_center'
    AND table_name='inscripciones'
  ORDER BY ORDINAL_POSITION
");
if ($colsRes) {
  while ($col = $colsRes->fetch_assoc()) {
    $name = $col['COLUMN_NAME'];
    $tableColumns[] = $name;
    $dataType = strtolower($col['DATA_TYPE']);
    if (in_array($dataType, ['blob','tinyblob','mediumblob','longblob'])) {
      $blobColumns[$name] = true;
    }
  }
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
      .thumb-image{
  max-width:60px;
  max-height:60px;
  border-radius:4px;
  cursor:zoom-in;
  object-fit:cover;
  box-shadow:0 0 0 1px rgba(0,0,0,0.1);
}

/* Modal de imagen */
.image-modal{
  position:fixed;
  inset:0;
  display:none;
  align-items:center;
  justify-content:center;
  z-index:9999;
}
.image-modal.is-visible{
  display:flex;
}
.image-modal__backdrop{
  position:absolute;
  inset:0;
  background:rgba(0,0,0,0.6);
}
.image-modal__content{
  position:relative;
  max-width:90%;
  max-height:90%;
  padding:10px;
  background:#fff;
  border-radius:8px;
  box-shadow:0 8px 24px rgba(0,0,0,0.4);
}
.image-modal__content img{
  max-width:100%;
  max-height:80vh;
  display:block;
}
.filters-row input{
  border:1px solid lightgray;
  padding:5px;
  width:100%;
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
        <td>
          <?php if (isset($blobColumns[$campo]) && $valor !== null && $valor !== ''): ?>
            <?php
              $mime = 'image/jpeg';
              if (strpos($valor, "\x89PNG") === 0) {
                $mime = 'image/png';
              } elseif (strpos($valor, "GIF8") === 0) {
                $mime = 'image/gif';
              }
              $b64 = base64_encode($valor);
              $src = 'data:'.$mime.';base64,'.$b64;
            ?>
            <img src="<?= $src; ?>"
                 data-full="<?= $src; ?>"
                 class="thumb-image"
                 style="max-width:120px; max-height:120px;"
                 alt="Documento">
          <?php else: ?>
            <?= htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8'); ?>
          <?php endif; ?>
        </td>
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

         <table id="inscripciones-table">
  <thead>
    <tr>
      <?php
        // Cabeceras de las columnas originales
        foreach ($tableColumns as $colName) {
          echo '<th>'.htmlspecialchars($colName, ENT_QUOTES, 'UTF-8').'</th>';
        }

        // Columna Emails nuevos + Estado CRM + Acciones
        echo '<th>Emails nuevos</th>';
        echo '<th>Estado CRM</th>';
        echo '<th>Acciones</th>';
      ?>
    </tr>
    <tr class="filters-row">
      <?php
        $filterColsCount = count($tableColumns) + 3; // Emails nuevos + Estado CRM + Acciones
        for ($i = 0; $i < $filterColsCount; $i++) {
          echo '<th><input type="text" class="column-filter" placeholder="Filtrar..."></th>';
        }
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

  // Mostrar todas las columnas originales (incluyendo BLOB como imagen)
  foreach($f as $clave=>$valor){
    // Si es columna BLOB, intentamos mostrar miniatura
    if (isset($blobColumns[$clave]) && $valor !== null && $valor !== '') {

      // Detección simple del tipo de imagen
      $mime = 'image/jpeg';
      if (strpos($valor, "\x89PNG") === 0) {
        $mime = 'image/png';
      } elseif (strpos($valor, "GIF8") === 0) {
        $mime = 'image/gif';
      }

      $b64 = base64_encode($valor);
      $src = 'data:'.$mime.';base64,'.$b64;

      // data-sort="imagen" para que el ordenado tenga un valor textual
      echo '<td data-sort="imagen">';
      echo '<img src="'.$src.'" data-full="'.$src.'" class="thumb-image" alt="Documento">';
      echo '</td>';
    } else {
      echo '<td>'.htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8').'</td>';
    }
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
<div id="image-modal" class="image-modal">
  <div class="image-modal__backdrop"></div>
  <div class="image-modal__content">
    <img id="image-modal-img" src="" alt="Documento">
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  /*---------------- MODAL DE IMAGEN ----------------*/
  const modal    = document.getElementById('image-modal');
  const modalImg = document.getElementById('image-modal-img');

  if (modal && modalImg) {
    // Abrir modal al hacer clic en una miniatura
    document.body.addEventListener('click', function(e) {
      const thumb = e.target.closest('.thumb-image');
      if (thumb) {
        const src = thumb.getAttribute('data-full') || thumb.getAttribute('src');
        if (src) {
          modalImg.src = src;
          modal.classList.add('is-visible');
        }
      }
    });

    // Cerrar modal al hacer clic en fondo
    modal.addEventListener('click', function(e) {
      if (e.target === modal || e.target.classList.contains('image-modal__backdrop')) {
        modal.classList.remove('is-visible');
        modalImg.src = '';
      }
    });

    // Cerrar con Escape
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && modal.classList.contains('is-visible')) {
        modal.classList.remove('is-visible');
        modalImg.src = '';
      }
    });
  }

  /*---------------- TABLA: ORDENACIÓN + FILTROS ----------------*/
  const table = document.getElementById('inscripciones-table');
  if (table && table.tBodies.length > 0) {
    const tbody = table.tBodies[0];

    // Obtener texto base para orden y filtro
    const getCellText = (row, idx) => {
      const cell = row.cells[idx];
      if (!cell) return '';
      const dataSort = cell.getAttribute('data-sort');
      if (dataSort !== null) {
        return dataSort.toLowerCase();
      }
      return (cell.textContent || '').trim().toLowerCase();
    };

    /*--- Ordenación al hacer clic en cabeceras ---*/
    const headerRow   = table.querySelector('thead tr:first-child');
    const headerCells = headerRow ? headerRow.querySelectorAll('th') : [];

    headerCells.forEach((th, index) => {
      th.style.cursor = 'pointer';
      th.addEventListener('click', function() {
        const rows = Array.from(tbody.rows);
        const currentDir = th.getAttribute('data-sort-dir') === 'asc' ? 'desc' : 'asc';

        // Limpiar indicador en otras columnas
        headerCells.forEach(h => h.removeAttribute('data-sort-dir'));
        th.setAttribute('data-sort-dir', currentDir);

        rows.sort((a, b) => {
          const va = getCellText(a, index);
          const vb = getCellText(b, index);

          // Intento de orden numérico si ambos parecen números
          const na = parseFloat(va.replace(',', '.'));
          const nb = parseFloat(vb.replace(',', '.'));
          const bothNumeric = !isNaN(na) && !isNaN(nb);

          if (bothNumeric) {
            return currentDir === 'asc' ? na - nb : nb - na;
          }
          return currentDir === 'asc'
            ? va.localeCompare(vb)
            : vb.localeCompare(va);
        });

        rows.forEach(r => tbody.appendChild(r));
      });
    });

    /*--- Filtros por columna (multicriterio) ---*/
    const filterInputs = table.querySelectorAll('thead .column-filter');

    const applyFilters = () => {
      const filters = Array.from(filterInputs).map(input =>
        (input.value || '').trim().toLowerCase()
      );

      Array.from(tbody.rows).forEach(row => {
        let visible = true;

        filters.forEach((value, colIdx) => {
          if (!value) return; // sin filtro en esta columna

          const cellText = getCellText(row, colIdx);
          if (cellText.indexOf(value) === -1) {
            visible = false;
          }
        });

        row.style.display = visible ? '' : 'none';
      });
    };

    filterInputs.forEach(input => {
      input.addEventListener('input', applyFilters);
    });
  }
});
</script>

  </body>
</html>
```

### altero tabla

```sql
ALTER TABLE inscripciones
MODIFY nombre VARCHAR(100) NOT NULL;
```

### index

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

      .ayuda_campo{
        margin: 0;
        font-size: 0.8em;
        color: #777;
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

            // LABEL = nombre técnico de la columna
            echo '<label for="'.$campo.'">Introduce '.$campo.'</label>';

            // PÁRRAFO = comentario explicativo
            if ($comentario != "") {
              echo '<p class="ayuda_campo">'.$comentario.'</p>';
            }

            // Variables de ayuda según longitud/tipo
            $textoAyudaExtra = "";

            /* ---------- Mantener tus tipos de campo exactamente ---------- */

            if (str_contains($tipo, "varchar")) {
               // Extraer longitud: varchar(N)
               $maxlengthAttr = "";
               if (preg_match('/varchar\((\d+)\)/i', $tipo, $m)) {
                 $maxChars = (int)$m[1];
                 $maxlengthAttr = ' maxlength="'.$maxChars.'"';
                 $textoAyudaExtra = "Máximo {$maxChars} caracteres.";
               }
               echo '<input type="text" name="'.$campo.'" id="'.$campo.'"'.$maxlengthAttr.'>';
            }
            else if ($tipo == "date") {
               echo '<input type="date" name="'.$campo.'" id="'.$campo.'">';
            }
            else if ($tipo == "int") {
               // Entero simple (no se ha pedido longitud explícitamente)
               echo '<input type="number" name="'.$campo.'" id="'.$campo.'">';
            }
            else if (str_contains($tipo, "decimal")) {
               // decimal(p,s) → se calcula max y step
               $stepAttr = ' step="0.01"';
               $maxAttr  = "";
               if (preg_match('/decimal\((\d+),(\d+)\)/i', $tipo, $mDec)) {
                 $precision = (int)$mDec[1];
                 $scale     = (int)$mDec[2];
                 $enteros   = $precision - $scale;

                 // Valor máximo positivo aproximado: 99...9.99...9
                 if ($enteros > 0) {
                   $maxParteEntera = str_repeat('9', $enteros);
                 } else {
                   $maxParteEntera = "0";
                 }
                 $maxParteDecimal = $scale > 0 ? str_repeat('9', $scale) : "";
                 $maxValue = $maxParteEntera;
                 if ($scale > 0) {
                   $maxValue .= ".".$maxParteDecimal;
                 }

                 // step acorde con el número de decimales
                 if ($scale > 0) {
                   $stepAttr = ' step="0.'.str_repeat('0', $scale-1).'1"';
                 } else {
                   $stepAttr = ' step="1"';
                 }

                 $maxAttr = ' max="'.$maxValue.'"';
                 $textoAyudaExtra = "Hasta {$precision} dígitos en total, de los cuales {$scale} decimales. "
                                  . "Valor máximo aproximado: ±{$maxValue}.";
               }
               echo '<input type="number" name="'.$campo.'" id="'.$campo.'"'.$stepAttr.$maxAttr.'>';
            }
            else if (str_contains($tipo, "tinyint")) {
               // En tu lógica es un checkbox 0/1
               echo '<div class="control_formulario_checkbox">';
               echo '<label for="'.$campo.'">Introduce '.$campo.'</label>';
               echo '<input type="checkbox" name="'.$campo.'" id="'.$campo.'">';
               echo '</div>';

               // Información al usuario sobre el almacenamiento
               if (preg_match('/tinyint\((\d+)\)/i', $tipo, $mTi)) {
                 $anchoTiny = (int)$mTi[1];
                 $textoAyudaExtra = "Este campo se almacena como TINYINT({$anchoTiny}), normalmente 0 = no y 1 = sí.";
               } else {
                 $textoAyudaExtra = "Este campo se almacena internamente como TINYINT (0/1).";
               }
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

               // Información de límites por tipo de BLOB
               $tipoLower = strtolower($tipo);
               if (str_contains($tipoLower, "tinyblob")) {
                 $textoAyudaExtra = "Tamaño máximo de archivo aproximado: 255 bytes (TINYBLOB).";
               } elseif (str_contains($tipoLower, "mediumblob")) {
                 $textoAyudaExtra = "Tamaño máximo de archivo aproximado: 16 MB (MEDIUMBLOB, 16.777.215 bytes).";
               } elseif (str_contains($tipoLower, "longblob")) {
                 $textoAyudaExtra = "Tamaño máximo de archivo aproximado: 4 GB (LONGBLOB, 4.294.967.295 bytes).";
               } else {
                 // BLOB "normal"
                 $textoAyudaExtra = "Tamaño máximo de archivo aproximado: 64 KB (BLOB, 65.535 bytes).";
               }
            }

            // Texto de ayuda adicional (longitudes, límites, etc.)
            if ($textoAyudaExtra !== "") {
              echo '<p class="ayuda_campo">'.$textoAyudaExtra.'</p>';
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

<a id="variables-del-sistema-y-variables-de-usuario"></a>
## Variables del sistema y variables de usuario

En el vasto mundo de la programación de bases de datos, las variables desempeñan un papel fundamental como elementos esenciales que almacenan y manipulan información. En esta subunidad didáctica, nos adentramos en dos tipos distintos de variables: las variables del sistema y las variables de usuario.

Las variables del sistema son aquellas que están predefinidas por el entorno de desarrollo o la base de datos que estamos utilizando. Estas variables proporcionan información valiosa sobre el estado actual del sistema, como el número de registros afectados por una consulta, el nombre del usuario actualmente conectado, o incluso detalles técnicos sobre el rendimiento del servidor. Su principal ventaja radica en su accesibilidad y facilidad de uso, ya que no requieren ninguna declaración explícita para ser utilizadas.

Por otro lado, las variables de usuario son aquellas que se definen por los programadores durante la codificación. Estas pueden almacenar cualquier tipo de dato que sea necesario para el funcionamiento del programa, desde simples valores numéricos hasta complejas estructuras de datos personalizadas. La ventaja de las variables de usuario radica en su flexibilidad y adaptabilidad, permitiendo a los programadores crear un estado interno específico para cada instancia de ejecución del programa.

La distinción entre estas dos categorías es crucial para entender cómo se maneja la información dentro de una aplicación que interactúa con bases de datos. Las variables del sistema son útiles para obtener información general sobre el entorno, mientras que las variables de usuario permiten un control más preciso y personalizado del flujo de datos dentro del programa.

En el contexto práctico, es común utilizar tanto variables del sistema como variables de usuario en la misma aplicación. Por ejemplo, al realizar una consulta a la base de datos, podemos usar una variable del sistema para almacenar el número total de registros afectados, mientras que usamos variables de usuario para almacenar los detalles específicos de cada registro que se procesa.

La gestión adecuada de estas variables es fundamental para evitar errores y garantizar el correcto funcionamiento del programa. Es importante recordar siempre la distinción entre las dos categorías y utilizarlas según su propósito específico, lo cual contribuye a una programación más eficiente y segura.

En resumen, las variables del sistema y las variables de usuario son herramientas esenciales en el mundo de la programación de bases de datos. Cada una tiene sus propias características y ventajas, y su correcto uso es crucial para crear aplicaciones robustas y funcionales. A través de esta subunidad didáctica, hemos explorado los conceptos básicos de estas variables y su importancia en el desarrollo de software que interactúa con bases de datos.

<a id="funciones"></a>
## Funciones

En la etapa de programación de bases de datos, las funciones desempeñan un papel crucial como bloques fundamentales que encapsulan operaciones específicas. Estas funciones permiten modularizar el código, facilitando su mantenimiento y reutilización en diferentes partes del sistema. Al definir funciones, se pueden abstraer lógica compleja en unidades más simples y manejables.

Las funciones en bases de datos son similares a las funciones en otros lenguajes de programación, ya que permiten la creación de rutinas que realizan tareas específicas y devuelven un resultado. Esta capacidad es fundamental para mantener el código limpio y organizado, especialmente cuando se trabaja con operaciones repetitivas o complejas.

En el contexto de las bases de datos, las funciones pueden ser utilizadas en consultas SQL para realizar cálculos, validaciones o cualquier otra tarea que no pueda realizarse directamente en la consulta. Por ejemplo, una función puede calcular el promedio de un conjunto de valores, validar si un valor cumple con ciertas condiciones, o incluso generar un código único.

La creación y uso de funciones en bases de datos requiere una comprensión sólida del lenguaje SQL y de las características específicas del sistema gestor de base de datos (SGBD) que se esté utilizando. Cada SGBD tiene sus propias reglas y sintaxis para definir y utilizar funciones, lo que puede variar significativamente entre ellos.

Además de las funciones definidas por el usuario, los SGBDs suelen proporcionar una serie de funciones predefinidas que pueden ser utilizadas directamente en consultas. Estas funciones pueden incluir operaciones matemáticas básicas, funciones de cadena, funciones de fecha y hora, entre otras. El uso de estas funciones predefinidas puede simplificar el código y mejorar la eficiencia de las consultas.

La programación de bases de datos también implica la gestión de parámetros en las funciones. Los parámetros permiten que las funciones reciban valores dinámicos, lo que les hace más versátiles y flexibles. Al definir parámetros, se puede especificar el tipo de dato esperado y si es necesario o no que el valor sea proporcionado al llamar a la función.

La programación de bases de datos también implica la gestión de excepciones en las funciones. Aunque los SGBDs suelen manejar automáticamente ciertos errores comunes, es importante conocer cómo se pueden capturar y gestionar excepciones específicas para evitar problemas inesperados durante el funcionamiento del sistema.

En resumen, las funciones son una herramienta poderosa en la programación de bases de datos. Permiten modularizar el código, facilitar su mantenimiento y reutilización, y realizar operaciones complejas de manera eficiente. Al dominar el uso de funciones en bases de datos, se puede mejorar significativamente la calidad y la eficiencia del sistema informático.

<a id="estructuras-de-control-de-flujo"></a>
## Estructuras de control de flujo

En la programación de bases de datos, las estructuras de control de flujo desempeñan un papel crucial para manejar el flujo de ejecución del programa. Estas estructuras permiten tomar decisiones basadas en ciertas condiciones o repetir bloques de código bajo determinados criterios. La comprensión y correcta utilización de estas estructuras son fundamentales para crear programas eficientes y robustos.

La primera estructura de control que exploraremos es la estructura de selección, también conocida como condicional. Esta estructura permite ejecutar diferentes bloques de código dependiendo del valor de una expresión booleana. En Python, esto se logra con las sentencias `if`, `elif` y `else`. La sintaxis básica es:

```python
if condición:
    # Código a ejecutar si la condición es verdadera
elif otra_condición:
    # Código a ejecutar si la primera condición es falsa pero esta es verdadera
else:
    # Código a ejecutar si ninguna de las condiciones anteriores es verdadera
```

La estructura de repetición, por otro lado, permite ejecutar un bloque de código varias veces. Hay dos tipos principales: `for` y `while`. La estructura `for` se utiliza cuando sabemos el número exacto de repeticiones o cuando iteramos sobre una secuencia (como una lista). Por ejemplo:

```python
for i in range(5):
    print(i)
```

La estructura `while`, por otro lado, se ejecuta mientras una condición sea verdadera. Es útil cuando no sabemos cuántas veces se repetirá el bloque de código. Aquí hay un ejemplo sencillo:

```python
i = 0
while i < 5:
    print(i)
    i += 1
```

Además de las estructuras básicas, también existen estructuras de control más complejas como los bucles anidados y los bucles con `break` y `continue`. Los bucles anidados permiten ejecutar un bucle dentro de otro, lo que es útil para procesar tablas o matrices. Por ejemplo:

```python
for i in range(3):
    for j in range(2):
        print(i, j)
```

El uso de `break` y `continue` permite controlar el flujo del bucle. `Break` termina la ejecución del bucle en cuanto se cumple una cierta condición, mientras que `continue` salta a la siguiente iteración sin ejecutar el código restante.

La comprensión y práctica de estas estructuras de control son esenciales para escribir programas eficientes y correctos. Cada una tiene sus propias características y aplicaciones específicas, por lo que es importante conocer cómo utilizarlas adecuadamente en diferentes situaciones. A través del estudio y la práctica, se desarrolla la capacidad de resolver problemas complejos mediante el control preciso del flujo de ejecución del programa.

En resumen, las estructuras de control de flujo son herramientas poderosas en la programación de bases de datos. Permiten tomar decisiones y repetir bloques de código bajo determinados criterios, lo que es fundamental para crear programas eficientes y robustos. A través del estudio y la práctica, se desarrolla la capacidad de resolver problemas complejos mediante el control preciso del flujo de ejecución del programa.

<a id="procedimientos-almacenados-funciones-de-usuario"></a>
## Procedimientos almacenados. Funciones de usuario

En el vasto universo de la programación, una de las disciplinas más fascinantes es la programación de bases de datos. Esta rama se ocupa del desarrollo de componentes que permiten interactuar con los datos almacenados en sistemas de gestión de base de datos (SGBDs). En esta subunidad didáctica, nos adentramos en el fascinante mundo de los procedimientos almacenados y las funciones de usuario.

Los procedimientos almacenados son bloques de código precompilado que se almacenan en la base de datos. Estos pueden ser invocados desde cualquier programa o script que tenga acceso a la base de datos, lo que permite una mayor eficiencia y seguridad en el acceso a los datos. Al estar compilados en el SGBD, estos procedimientos son ejecutados directamente por el motor de la base de datos, lo que puede reducir significativamente el tiempo de respuesta.

Las funciones de usuario, por otro lado, son similares a los procedimientos almacenados pero están diseñadas para devolver un valor. A diferencia de los procedimientos, las funciones pueden ser utilizadas en consultas SQL como cualquier otra expresión. Esto les hace muy útiles para realizar cálculos complejos o transformaciones de datos directamente en la base de datos.

La programación de estos componentes es una habilidad esencial para cualquier desarrollador que trabaje con bases de datos. Permite no solo optimizar el acceso a los datos, sino también encapsular lógica de negocio dentro del SGBD, lo que facilita su mantenimiento y escalabilidad.

Para comenzar a programar procedimientos almacenados y funciones de usuario, es importante entender la sintaxis específica del SGBD que se esté utilizando. Cada uno tiene sus propias características y ventajas, por lo que es crucial familiarizarse con ellas para aprovechar al máximo estas herramientas.

Además de la sintaxis, también es fundamental conocer cómo gestionar los parámetros de entrada y salida, así como cómo manejar las excepciones que pueden surgir durante la ejecución. La gestión adecuada de errores es un aspecto crucial en el desarrollo de software robusto y confiable.

La programación de procedimientos almacenados y funciones de usuario también implica una buena práctica de diseño. Es importante considerar la modularidad del código, la reutilización y la seguridad al diseñar estos componentes. La separación de responsabilidades y la encapsulación de lógica en unidades más pequeñas facilitan el mantenimiento y la evolución del software.

En conclusión, la programación de bases de datos es una disciplina rica y diversa que ofrece numerosas oportunidades para mejorar la eficiencia y seguridad de los sistemas informáticos. Los procedimientos almacenados y las funciones de usuario son herramientas poderosas que permiten encapsular lógica de negocio dentro del SGBD, lo que facilita su mantenimiento y escalabilidad. A través de una comprensión profunda de la sintaxis específica del SGBD, la gestión adecuada de parámetros y excepciones, y buenas prácticas de diseño, los desarrolladores pueden crear componentes eficientes y seguros para interactuar con las bases de datos.

<a id="eventos-y-disparadores"></a>
## Eventos y disparadores

En el mundo digital de la programación, los eventos y disparadores son un concepto fundamental que permite a las aplicaciones reaccionar dinámicamente ante ciertas acciones o cambios. Estos elementos son esenciales para crear interactividad y funcionalidad avanzada en sistemas informáticos.

Los eventos representan acciones específicas que ocurren dentro de una aplicación, como el clic de un botón, la entrada de datos por parte del usuario o el cambio de estado de una variable. Estos eventos son los estímulos que desencadenan las acciones que se quieren ejecutar en respuesta.

Los disparadores, por otro lado, son bloques de código que se ejecutan automáticamente cuando un evento ocurre. Son como pequeños motores internos dentro del sistema que responden a ciertas condiciones o acciones, realizando tareas específicas sin intervención directa del usuario.

La programación de eventos y disparadores es una técnica poderosa que permite a los desarrolladores crear aplicaciones más dinámicas y responsivas. Al asociar eventos con funciones o métodos, se puede implementar una serie de acciones que respondan a ciertas interacciones del usuario o cambios en el estado del sistema.

Este proceso de programación implica la definición clara de qué evento debe desencadenar un determinado disparador y cómo este disparador debe ejecutar su lógica. A través de esta asociación, se puede crear una serie de reacciones que permiten a las aplicaciones responder de manera eficiente a diversos escenarios.

Es importante destacar que la programación de eventos y disparadores no es un proceso estático, sino dinámico. Esto significa que los disparadores pueden ser modificados o eliminados en tiempo real, adaptándose al comportamiento del sistema y a las necesidades cambiantes del usuario.

Además, esta técnica permite una gran flexibilidad en la creación de interfaces de usuario. Por ejemplo, se puede programar un evento para que, cuando el usuario haga clic en un botón, se ejecute una función que actualice los datos en la base de datos o muestre un mensaje informativo.

En resumen, la programación de eventos y disparadores es una herramienta fundamental en el desarrollo de aplicaciones informáticas. Permite a los desarrolladores crear sistemas interactivos y responsivos, adaptándose a las acciones del usuario y al estado del sistema de manera dinámica. Este concepto es esencial para entender cómo funcionan muchas aplicaciones modernas y cómo se pueden crear nuevas funcionalidades interactivas y eficientes.

<a id="excepciones"></a>
## Excepciones

En el mundo digital actual, las bases de datos son una parte esencial de cualquier sistema informático. La programación de bases de datos requiere un conocimiento profundo de cómo manejar los errores que pueden surgir durante la ejecución de operaciones en estos sistemas. Esta subunidad se centra específicamente en el tema de excepciones, que son eventos inesperados o situaciones anormales que ocurren durante la ejecución del código y que pueden interrumpir su flujo normal.

Las excepciones son un mecanismo fundamental para manejar errores de manera eficiente. Al programar bases de datos, es crucial entender cómo capturar, identificar y gestionar estas excepciones para mantener el sistema robusto y funcional. Cada excepción tiene una serie de propiedades que nos proporcionan información sobre lo que ocurrió, como su tipo, su mensaje y su origen.

La gestión de excepciones en bases de datos implica la creación de bloques try-catch, donde el bloque try contiene el código susceptible a generar una excepción, mientras que el bloque catch se encarga de manejarla. Este enfoque permite aislar las partes del código que pueden fallar y proporciona un camino alternativo para continuar ejecutando el programa sin interrupciones.

Además de capturar excepciones, es importante entender cómo generarlas intencionalmente cuando ocurren situaciones anormales. Las excepciones personalizadas nos permiten crear mensajes de error claros y específicos que facilitan la depuración y el mantenimiento del código. Al definir nuestras propias excepciones, podemos proporcionar contexto adicional sobre lo que salió mal, lo que es invaluable para solucionar problemas.

La programación de bases de datos también implica la gestión de transacciones, que son conjuntos de operaciones que deben realizarse juntas o no en absoluto. Las excepciones desempeñan un papel crucial en este proceso, ya que si ocurre una excepción durante una transacción, es necesario revertir todas las operaciones realizadas hasta ese punto para mantener la integridad del sistema.

Además de manejar errores, las excepciones también pueden utilizarse para implementar políticas de seguridad. Por ejemplo, al intentar acceder a un recurso protegido sin los permisos adecuados, se puede generar una excepción específica que indique el error y permita tomar medidas como solicitar nuevas credenciales o denegar la operación.

La programación de bases de datos es un campo complejo que requiere un enfoque meticuloso para garantizar su correcto funcionamiento. El manejo adecuado de excepciones es una parte fundamental de este proceso, ya que permite crear sistemas informáticos más robustos y seguros. Al comprender cómo capturar, generar y gestionar excepciones, podemos mejorar la calidad del código y proporcionar un mejor servicio a los usuarios finales.

En conclusión, el manejo de excepciones en la programación de bases de datos es una habilidad crucial que permite crear sistemas informáticos más confiables y seguros. Al comprender cómo capturar, generar y gestionar excepciones, podemos mejorar la calidad del código y proporcionar un mejor servicio a los usuarios finales. Esta subunidad ha cubierto los fundamentos del manejo de excepciones en bases de datos, proporcionando una base sólida para el desarrollo de sistemas informáticos más robustos y seguros.

<a id="cursores"></a>
## Cursores

En el mundo de la programación de bases de datos, los cursores desempeñan un papel crucial como intermediarios entre el lenguaje de programación y las operaciones directamente sobre la base de datos. Algunos de estos cursores son conocidos como cursores estándar, mientras que otros son cursores dinámicos o cursores posicionales. Los cursores estándar permiten a los desarrolladores recorrer un conjunto de resultados devuelto por una consulta SQL, procesando cada fila individualmente. Por otro lado, los cursores dinámicos son más flexibles y pueden ejecutar consultas que cambian en tiempo real, lo que es útil para aplicaciones donde las condiciones de búsqueda pueden variar.

Los cursores posicionales, por su parte, permiten a los desarrolladores moverse libremente entre las filas del conjunto de resultados. Esto puede ser especialmente útil cuando se necesita acceder a una fila específica o cuando se desea realizar operaciones complejas como la actualización o eliminación de datos en función de ciertas condiciones.

La programación con cursores requiere un conocimiento profundo de los conceptos de control de flujo y estructuras de datos. Los desarrolladores deben entender cómo abrir, moverse y cerrar cursores, así como cómo manejar las excepciones que pueden surgir durante el proceso. Además, es crucial conocer cómo optimizar el uso de cursores para mejorar el rendimiento de la aplicación.

La manipulación de cursores también implica un buen entendimiento del lenguaje SQL. Los desarrolladores deben saber cómo formular consultas adecuadas y cómo utilizar las funciones de control de flujo dentro de los cursores para realizar operaciones complejas en una sola pasada por el conjunto de resultados.

En la práctica, los cursores se utilizan en una variedad de escenarios. Por ejemplo, cuando se necesita procesar un gran volumen de datos y no es posible cargar todo en memoria a la vez, o cuando se requiere realizar operaciones complejas como la actualización de múltiples filas basadas en ciertas condiciones.

La programación con cursores puede ser un desafío debido a su naturaleza más compleja que el acceso directo a la base de datos. Sin embargo, también ofrece una gran flexibilidad y control sobre los procesos de manipulación de datos. A través del uso de cursores, los desarrolladores pueden crear aplicaciones más eficientes y robustas, capaces de manejar situaciones complejas con mayor precisión.

En resumen, los cursores son herramientas poderosas en el arsenal del programador de bases de datos. Su capacidad para recorrer y manipular conjuntos de resultados de manera controlada hace que sean esenciales para aplicaciones que requieren un alto nivel de personalización y complejidad. A medida que se adquiere experiencia con la programación de cursores, los desarrolladores pueden descubrir nuevas formas de optimizar el rendimiento y mejorar la funcionalidad de sus aplicaciones.


<a id="interpretacion-de-diagramas-entidadrelacion"></a>
# Interpretación de Diagramas EntidadRelación

<a id="el-modelo-er-entidades-y-relaciones-cardinalidades-debilidad"></a>
## El modelo ER. Entidades y relaciones. Cardinalidades. Debilidad

El modelo de datos Entidad-Relación (ER) es una representación gráfica que permite visualizar la estructura lógica de una base de datos. Este modelo utiliza tres tipos de símbolos: entidades, atributos y relaciones.

Las **entidades** son los objetos o conceptos sobre los cuales se almacenan datos en la base de datos. Cada entidad tiene un nombre único que describe el objeto representado. Por ejemplo, una entidad podría ser "Cliente" o "Producto".

Los **atributos**, por otro lado, son las características o propiedades que definen a cada entidad. Cada atributo está asociado con una entidad y tiene un nombre y un tipo de dato específico. Por ejemplo, el atributo "Nombre" para la entidad "Cliente" podría ser de tipo texto.

Las **relaciones** representan los vínculos entre las entidades. Una relación indica cómo se relacionan dos o más entidades y puede tener una cardinalidad que define cuántas instancias de cada entidad pueden estar involucradas en la relación. Por ejemplo, la relación "Compra" podría tener una cardinalidad de uno a muchos, indicando que un cliente puede hacer muchas compras.

La **debilidad** en el modelo ER se refiere a la ausencia de entidades fuertes o centrales. Una entidad débil no tiene identidad propia y depende de otra entidad para su existencia. Por ejemplo, una relación entre "Cliente" y "Factura" podría ser débil si cada factura solo existe en el contexto de un cliente.

El modelo ER es una herramienta poderosa para diseñar bases de datos porque permite visualizar claramente las relaciones entre diferentes partes del sistema. Al interpretar diagramas ER, podemos entender cómo los datos se organizan y cómo interactúan entre sí, lo que facilita la planificación y el desarrollo de sistemas informáticos.

La comprensión del modelo ER es fundamental para cualquier profesional en programación o gestión de bases de datos, ya que proporciona una base sólida para diseñar estructuras de datos eficientes y coherentes. A través del estudio de este modelo, podemos aprender a representar conceptos complejos de manera visual y a analizar cómo estos conceptos se relacionan entre sí, lo que nos ayuda a crear sistemas informáticos más robustos y escalables.

El modelo ER también es útil para la comunicación entre diferentes partes de un proyecto. Al usar diagramas ER, los desarrolladores pueden compartir una comprensión común del diseño de la base de datos, lo que facilita la colaboración y el mantenimiento del sistema a lo largo del tiempo.

En resumen, el modelo ER es una herramienta esencial para el diseño y gestión de bases de datos. Al interpretar diagramas ER, podemos entender cómo los datos se organizan y cómo interactúan entre sí, lo que nos ayuda a crear sistemas informáticos más robustos y escalables. Este conocimiento es fundamental para cualquier profesional en programación o gestión de bases de datos.

### Definiciones

```markdown
En bases de datos trabajamos con "tablas"
En programación trabajamos con "clases"

Un cliente: es una "tabla"? o es una "clase"?

Un cliente es una entidad
Una entidad es un bloque de construcción conceptual que define un elemento que puede representar a un objeto del mundo real o puede representar a un objeto ficticio

Modelar en base a entidades nos permite abstraernos
Nos permite primero pensar en forma de teoría
Y luego darle forma a esa teoria en forma de práctica (p.ej. bases de datos)
```

### Ejemplo diagrama en texto

```markdown
Cliente
  +id int
  -nombre varchar
  -apellidos varchar
  -email varchar (constraint email)
  -direccion varchar
```

### Herramientas para definir entidades

```markdown
-Puedo definir entidades en texto
-Puedo utilizar Excel
-Puedo utilizar herramientas de diagramado: Dia Diagram
http://dia-installer.de/index.html.es

-Podéis utilizar la herramienta jocarsa de diagramado
https://jocarsa.github.io/diagrama/
```

### entidad cliente

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
  width: 299.9999999999999px;
  height: 230.39998834783373px;
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

<div class="shape entity" style="left:40px;top:40px;width:219.9999999999999px;height:150.39998834783373px;">
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
  </div>
</div>
</div>
</body>
</html>
```

### entidad cliente

```json
{
  "formas": [
    {
      "id": "forma-1",
      "tipo": "entity",
      "left": "364.361px",
      "top": "116.556px",
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
        }
      ]
    }
  ],
  "flechas": []
}
```

### entidad cliente

```
<svg xmlns="http://www.w3.org/2000/svg" width="299.9999999999999" height="230.39998834783373" viewBox="0 0 299.9999999999999 230.39998834783373">

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
        
<rect class="shape-entity" x="40" y="40" width="219.9999999999999" height="150.39998834783373" />
<line x1="40" y1="66.40000169927423" x2="259.9999999999999" y2="66.40000169927423" stroke="#e5e7eb" stroke-width="1"/>
<text x="149.99999999999994" y="57.999999653209336" text-anchor="middle">Cliente</text>
<text x="123.89999944513488" y="86.40000334652987">id</text>
<text x="123.89999944513488" y="110.39999519694933">nombre</text>
<text x="123.89999944513488" y="134.3999870473688">apellidos</text>
<text x="123.89999944513488" y="158.39998843453142">email</text>
</svg>
```

### dos entidades

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
  width: 577.8750055486505px;
  height: 230.83748557350842px;
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

<div class="shape entity" style="left:40px;top:40px;width:219.99995838512064px;height:150.39998834783373px;">
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
  </div>
</div>
<div class="shape entity" style="left:317.87496393377126px;top:40.43749722567472px;width:220.00004161487917px;height:150.39998834783373px;">
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
      <div class="property-name">numero_pedido</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">id_cliente</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
</div>
</body>
</html>
```

### dos entidades

```json
{
  "formas": [
    {
      "id": "forma-1",
      "tipo": "entity",
      "left": "189.783px",
      "top": "136.975px",
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
        }
      ]
    },
    {
      "id": "forma-2",
      "tipo": "entity",
      "left": "467.655px",
      "top": "137.419px",
      "width": "",
      "height": "",
      "entityName": "Pedido",
      "properties": [
        {
          "id": "prop-5",
          "name": "id"
        },
        {
          "id": "prop-6",
          "name": "fecha"
        },
        {
          "id": "prop-7",
          "name": "numero_pedido"
        },
        {
          "id": "prop-8",
          "name": "id_cliente"
        }
      ]
    }
  ],
  "flechas": []
}
```

### dos entidades

```
<svg xmlns="http://www.w3.org/2000/svg" width="577.8750055486505" height="230.83748557350842" viewBox="0 0 577.8750055486505 230.83748557350842">

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
        
<rect class="shape-entity" x="40" y="40" width="219.99995838512064" height="150.39998834783373" />
<line x1="40" y1="66.39999736439097" x2="259.99995838512064" y2="66.39999736439097" stroke="#e5e7eb" stroke-width="1"/>
<text x="149.99997919256032" y="58.00000312111594" text-anchor="middle">Cliente</text>
<text x="123.89999944513494" y="86.39999250932172">id</text>
<text x="123.89999944513494" y="110.39999389648435">nombre</text>
<text x="123.89999944513494" y="134.4000022194602">apellidos</text>
<text x="123.89999944513494" y="158.3999966708096">email</text>
<rect class="shape-entity" x="317.87496393377126" y="40.43749722567472" width="220.00004161487917" height="150.39998834783373" />
<line x1="317.87496393377126" y1="66.83749459006569" x2="537.8750055486504" y2="66.83749459006569" stroke="#e5e7eb" stroke-width="1"/>
<text x="427.8749847412108" y="58.43750034679066" text-anchor="middle">Pedido</text>
<text x="382.1374983354047" y="86.83749667080966">id</text>
<text x="382.1374983354047" y="110.83749112215907">fecha</text>
<text x="382.1374983354047" y="134.8374994451349">numero_pedido</text>
<text x="382.1374983354047" y="158.83749389648432">id_cliente</text>
</svg>
```

### Tipos de relaciones - cardinalidad

```markdown
Tres tipos principales de cardinalidad son:

1.-Relación de 1 a 1
Un elemento de una entidad corresponde a un elemento de otra entidad

1 cliente puede 1 nombre (a un elemento de una "tabla" le corresponde solo un elemento de otra "tabla")

Cuando tenemos este caso, la solución, en base a normalización de bases de datos, suele ser incorporar ese dato en la tabla (no tiene sentido tener dos tablas separadas)

2.-Relación de 1 a n

A un elemento de una tabla le corresponden n elementos de la otra tabla

Hay que tener en cuenta la direccionalidad de la cardinalidad

Un pedido solo puede tener un cliente (desde ese punto de vista es 1 a 1)
Pero un cliente puede hacer n pedidos (desde ese punto de vista es 1 a n)

Si se da este caso, esto pide tener dos tablas en la base de datos, dos entidades diferentes

3.-Relación de n a n
Quiere decir:
a n elementos de una "tabla" le corresponden n elementos de la otra "tabla"

Ejemplo:
Un estudiante puede tener n asignaturas
Una asignaturas puede tener n estudiantes

No es común, pero, como en el caso del centro de estudios, tampoco es infrecuente

Cuando se dan estos casos, se suele solucionar la cardinalidad con una tabla intermedia
```

### correspondencia 1 a n

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
  width: 577.8750101725259px;
  height: 230.83750406901032px;
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

<div class="shape entity" style="left:40px;top:40px;width:219.99998304578983px;height:150.40000067816834px;">
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
  </div>
</div>
<div class="shape entity" style="left:317.87501017252595px;top:40.43750339084201px;width:219.99999999999991px;height:150.40000067816834px;">
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
      <div class="property-name">numero_pedido</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">id_cliente</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="arrow" style="left:198.08750788370764px;top:84.30569400224206px;width:175.98220725317339px;transform:rotate(0.40058871203078056rad);"></div>
</div>
</body>
</html>
```

### correspondencia 1 a n

```json
{
  "formas": [
    {
      "id": "forma-1",
      "tipo": "entity",
      "left": "189.783px",
      "top": "136.975px",
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
        }
      ]
    },
    {
      "id": "forma-2",
      "tipo": "entity",
      "left": "467.655px",
      "top": "137.419px",
      "width": "",
      "height": "",
      "entityName": "Pedido",
      "properties": [
        {
          "id": "prop-5",
          "name": "id"
        },
        {
          "id": "prop-6",
          "name": "fecha"
        },
        {
          "id": "prop-7",
          "name": "numero_pedido"
        },
        {
          "id": "prop-8",
          "name": "id_cliente"
        }
      ]
    }
  ],
  "flechas": [
    {
      "desde": {
        "shapeId": "forma-1",
        "propId": "prop-1",
        "side": "right"
      },
      "hasta": {
        "shapeId": "forma-2",
        "propId": "prop-8",
        "side": "left"
      },
      "tipo": "simple",
      "estilo": "straight"
    }
  ]
}
```

### correspondencia 1 a n

```
<svg xmlns="http://www.w3.org/2000/svg" width="577.8750101725259" height="230.83750406901032" viewBox="0 0 577.8750101725259 230.83750406901032">

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
        
<rect class="shape-entity" x="40" y="40" width="219.99998304578983" height="150.40000067816834" />
<line x1="40" y1="66.4000023735894" x2="259.9999830457898" y2="66.4000023735894" stroke="#e5e7eb" stroke-width="1"/>
<text x="149.9999915228949" y="57.99999830457899" text-anchor="middle">Cliente</text>
<text x="123.90000406901038" y="86.40000406901041">id</text>
<text x="123.90000406901038" y="110.40000237358939">nombre</text>
<text x="123.90000406901038" y="134.4000091552734">apellidos</text>
<text x="123.90000406901038" y="158.39999898274735">email</text>
<rect class="shape-entity" x="317.87501017252595" y="40.43750339084201" width="219.99999999999991" height="150.40000067816834" />
<line x1="317.87501017252595" y1="66.83749728732637" x2="537.8750101725259" y2="66.83749728732637" stroke="#e5e7eb" stroke-width="1"/>
<text x="427.8750101725259" y="58.43749321831596" text-anchor="middle">Pedido</text>
<text x="382.13746134440095" y="86.83749898274738">id</text>
<text x="382.13746134440095" y="110.8375057644314">fecha</text>
<text x="382.13746134440095" y="134.83749559190534">numero_pedido</text>
<text x="382.13746134440095" y="158.83750237358936">id_cliente</text>
<path class="conn" d="M 198.08750788370764 84.30569400224206 L 360.13748168945307 152.9318060825289" marker-end="url(#arrow-end)" />
</svg>
```

### caso centro de formacion

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
  width: 580.6249999999998px;
  height: 378.11251163482655px;
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

<div class="shape entity" style="left:40.037479400634766px;top:211.71251773834223px;width:219.99999999999991px;height:126.39999389648433px;">
  <div class="entity-header">Asignatura</div>
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
  </div>
</div>
<div class="shape entity" style="left:40px;top:40px;width:219.9999809265136px;height:150.39999961853022px;">
  <div class="entity-header">Alumno</div>
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
  </div>
</div>
<div class="shape entity" style="left:320.62499999999994px;top:105.6249952316284px;width:219.99999999999991px;height:150.40000915527338px;">
  <div class="entity-header">Matricula</div>
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
      <div class="property-name">alumno_id</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">asignatura_id</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="arrow" style="left:204.9874728918075px;top:253.22922123171003px;width:167.8045839845535px;transform:rotate(-0.19382181144901595rad);"></div>
<div class="arrow" style="left:198.08748662471766px;top:85.23177119693266px;width:202.70510001760024px;transform:rotate(0.5616737052975951rad);"></div>
</div>
</body>
</html>
```

### caso centro de formacion

```json
{
  "formas": [
    {
      "id": "forma-1",
      "tipo": "entity",
      "left": "216.375px",
      "top": "268.825px",
      "width": "",
      "height": "",
      "entityName": "Asignatura",
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
          "name": "descripcion"
        }
      ]
    },
    {
      "id": "forma-2",
      "tipo": "entity",
      "left": "216.338px",
      "top": "97.1125px",
      "width": "",
      "height": "",
      "entityName": "Alumno",
      "properties": [
        {
          "id": "prop-4",
          "name": "id"
        },
        {
          "id": "prop-5",
          "name": "nombre"
        },
        {
          "id": "prop-6",
          "name": "apellidos"
        },
        {
          "id": "prop-7",
          "name": "email"
        }
      ]
    },
    {
      "id": "forma-3",
      "tipo": "entity",
      "left": "496.963px",
      "top": "162.738px",
      "width": "",
      "height": "",
      "entityName": "Matricula",
      "properties": [
        {
          "id": "prop-8",
          "name": "id"
        },
        {
          "id": "prop-9",
          "name": "fecha"
        },
        {
          "id": "prop-10",
          "name": "alumno_id"
        },
        {
          "id": "prop-11",
          "name": "asignatura_id"
        }
      ]
    }
  ],
  "flechas": [
    {
      "desde": {
        "shapeId": "forma-1",
        "propId": "prop-1",
        "side": "right"
      },
      "hasta": {
        "shapeId": "forma-3",
        "propId": "prop-11",
        "side": "left"
      },
      "tipo": "simple",
      "estilo": "straight"
    },
    {
      "desde": {
        "shapeId": "forma-2",
        "propId": "prop-4",
        "side": "right"
      },
      "hasta": {
        "shapeId": "forma-3",
        "propId": "prop-10",
        "side": "left"
      },
      "tipo": "simple",
      "estilo": "straight"
    }
  ]
}
```

### caso centro de formacion

```
<svg xmlns="http://www.w3.org/2000/svg" width="580.6249999999998" height="378.11251163482655" viewBox="0 0 580.6249999999998 378.11251163482655">

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
        
<rect class="shape-entity" x="40.037479400634766" y="211.71251773834223" width="219.99999999999991" height="126.39999389648433" />
<line x1="40.037479400634766" y1="238.11250448226923" x2="260.03747940063465" y2="238.11250448226923" stroke="#e5e7eb" stroke-width="1"/>
<text x="150.0374794006347" y="229.71251034736628" text-anchor="middle">Asignatura</text>
<text x="117.07498931884766" y="258.11249637603754">id</text>
<text x="117.07498931884766" y="282.1125116348266">nombre</text>
<text x="117.07498931884766" y="306.11250782012934">descripcion</text>
<rect class="shape-entity" x="40" y="40" width="219.9999809265136" height="150.39999961853022" />
<line x1="40" y1="66.39999628067017" x2="259.99998092651356" y2="66.39999628067017" stroke="#e5e7eb" stroke-width="1"/>
<text x="149.99999046325678" y="57.99999499320984" text-anchor="middle">Alumno</text>
<text x="123.89997863769531" y="86.39999294281004">id</text>
<text x="123.89997863769531" y="110.39998912811278">nombre</text>
<text x="123.89997863769531" y="134.39999485015863">apellidos</text>
<text x="123.89997863769531" y="158.39999103546137">email</text>
<rect class="shape-entity" x="320.62499999999994" y="105.6249952316284" width="219.99999999999991" height="150.40000915527338" />
<line x1="320.62499999999994" y1="132.02499151229856" x2="540.6249999999999" y2="132.02499151229856" stroke="#e5e7eb" stroke-width="1"/>
<text x="430.6249999999999" y="123.62499737739562" text-anchor="middle">Matricula</text>
<text x="391.64995574951166" y="152.02500247955317">id</text>
<text x="391.64995574951166" y="176.0249986648559">fecha</text>
<text x="391.64995574951166" y="200.0250031948089">alumno_id</text>
<text x="391.64995574951166" y="224.0250101089477">asignatura_id</text>
<path class="conn" d="M 204.9874728918075 253.22922123171003 L 369.6499633789062 220.90828942560034" marker-end="url(#arrow-end)" />
<path class="conn" d="M 198.08748662471766 85.23177119693266 L 369.6499633789062 193.19321868219862" marker-end="url(#arrow-end)" />
</svg>
```

### caso tienda online

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
  width: 817.0249837239581px;
  height: 364.4375101725259px;
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

<div class="shape entity" style="left:40px;top:40.01250203450519px;width:219.99999999999994px;height:126.40000406901038px;">
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
  </div>
</div>
<div class="shape entity" style="left:294.3500162760416px;top:198.03750610351554px;width:219.99999999999994px;height:126.40000406901038px;">
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
      <div class="property-name">precio</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="shape entity" style="left:289.68749999999994px;top:40px;width:219.99999999999994px;height:126.40000406901038px;">
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
      <div class="property-name">cliente_id</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="shape entity" style="left:557.0249837239581px;top:98.687510172526px;width:219.99999999999994px;height:174.40000406901038px;">
  <div class="entity-header">LineasPedido</div>
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
<div class="arrow" style="left:198.08752441406247px;top:83.75626538824127px;width:158.31921494545765px;transform:rotate(0.2901860677521058rad);"></div>
<div class="arrow" style="left:449.5749918619791px;top:85.2301196227952px;width:189.76540990434972px;transform:rotate(0.5614093340038653rad);"></div>
<div class="arrow" style="left:449.0624999999999px;top:239.71417731907204px;width:163.21856764761617px;transform:rotate(-0.15937732576534783rad);"></div>
</div>
</body>
</html>
```

### caso tienda online

```json
{
  "formas": [
    {
      "id": "forma-1",
      "tipo": "entity",
      "left": "34.0792px",
      "top": "135.625px",
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
        }
      ]
    },
    {
      "id": "forma-2",
      "tipo": "entity",
      "left": "288.433px",
      "top": "293.654px",
      "width": "",
      "height": "",
      "entityName": "Producto",
      "properties": [
        {
          "id": "prop-4",
          "name": "id"
        },
        {
          "id": "prop-5",
          "name": "nombre"
        },
        {
          "id": "prop-6",
          "name": "precio"
        }
      ]
    },
    {
      "id": "forma-3",
      "tipo": "entity",
      "left": "283.771px",
      "top": "135.621px",
      "width": "",
      "height": "",
      "entityName": "Pedido",
      "properties": [
        {
          "id": "prop-7",
          "name": "id"
        },
        {
          "id": "prop-8",
          "name": "fecha"
        },
        {
          "id": "prop-9",
          "name": "cliente_id"
        }
      ]
    },
    {
      "id": "forma-5",
      "tipo": "entity",
      "left": "551.104px",
      "top": "194.308px",
      "width": "",
      "height": "",
      "entityName": "LineasPedido",
      "properties": [
        {
          "id": "prop-14",
          "name": "id"
        },
        {
          "id": "prop-15",
          "name": "fecha"
        },
        {
          "id": "prop-16",
          "name": "pedido_id"
        },
        {
          "id": "prop-17",
          "name": "producto_id"
        },
        {
          "id": "prop-18",
          "name": "cantidad"
        }
      ]
    }
  ],
  "flechas": [
    {
      "desde": {
        "shapeId": "forma-1",
        "propId": "prop-1",
        "side": "right"
      },
      "hasta": {
        "shapeId": "forma-3",
        "propId": "prop-9",
        "side": "left"
      },
      "tipo": "simple",
      "estilo": "straight"
    },
    {
      "desde": {
        "shapeId": "forma-3",
        "propId": "prop-7",
        "side": "right"
      },
      "hasta": {
        "shapeId": "forma-5",
        "propId": "prop-16",
        "side": "left"
      },
      "tipo": "simple",
      "estilo": "straight"
    },
    {
      "desde": {
        "shapeId": "forma-2",
        "propId": "prop-4",
        "side": "right"
      },
      "hasta": {
        "shapeId": "forma-5",
        "propId": "prop-17",
        "side": "left"
      },
      "tipo": "simple",
      "estilo": "straight"
    }
  ]
}
```

### caso tienda online

```
<svg xmlns="http://www.w3.org/2000/svg" width="817.0249837239581" height="364.4375101725259" viewBox="0 0 817.0249837239581 364.4375101725259">

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
        
<rect class="shape-entity" x="40" y="40.01250203450519" width="219.99999999999994" height="126.40000406901038" />
<line x1="40" y1="66.41249847412108" x2="259.99999999999994" y2="66.41249847412108" stroke="#e5e7eb" stroke-width="1"/>
<text x="149.99999999999997" y="58.01249821980793" text-anchor="middle">Cliente</text>
<text x="123.90000406901041" y="86.41249593098956">id</text>
<text x="123.90000406901041" y="110.4125061035156">nombre</text>
<text x="123.90000406901041" y="134.4125061035156">apellidos</text>
<rect class="shape-entity" x="294.3500162760416" y="198.03750610351554" width="219.99999999999994" height="126.40000406901038" />
<line x1="294.3500162760416" y1="224.43750254313144" x2="514.3500162760415" y2="224.43750254313144" stroke="#e5e7eb" stroke-width="1"/>
<text x="404.3500162760415" y="216.0375022888183" text-anchor="middle">Producto</text>
<text x="381.6249999999999" y="244.43751017252598">id</text>
<text x="381.6249999999999" y="268.4374898274739">nombre</text>
<text x="381.6249999999999" y="292.4374898274739">precio</text>
<rect class="shape-entity" x="289.68749999999994" y="40" width="219.99999999999994" height="126.40000406901038" />
<line x1="289.68749999999994" y1="66.39999643961586" x2="509.6874999999999" y2="66.39999643961586" stroke="#e5e7eb" stroke-width="1"/>
<text x="399.6874999999999" y="57.99999618530271" text-anchor="middle">Pedido</text>
<text x="371.7875162760416" y="86.40000406901041">id</text>
<text x="371.7875162760416" y="110.39999389648435">fecha</text>
<text x="371.7875162760416" y="134.39999389648435">cliente_id</text>
<rect class="shape-entity" x="557.0249837239581" y="98.687510172526" width="219.99999999999994" height="174.40000406901038" />
<line x1="557.0249837239581" y1="125.0875066121419" x2="777.024983723958" y2="125.0875066121419" stroke="#e5e7eb" stroke-width="1"/>
<text x="667.0249837239581" y="116.68750635782874" text-anchor="middle">LineasPedido</text>
<text x="632.2124837239581" y="145.08749389648435">id</text>
<text x="632.2124837239581" y="169.08749389648432">fecha</text>
<text x="632.2124837239581" y="193.08749389648435">pedido_id</text>
<text x="632.2124837239581" y="217.0874938964843">producto_id</text>
<text x="632.2124837239581" y="241.0874938964843">cantidad</text>
<path class="conn" d="M 198.08752441406247 83.75626538824127 L 349.7875162760416 129.05622443923264" marker-end="url(#arrow-end)" />
<path class="conn" d="M 449.5749918619791 85.2301196227952 L 610.2124837239581 186.25737834269952" marker-end="url(#arrow-end)" />
<path class="conn" d="M 449.0624999999999 239.71417731907204 L 610.2124837239581 213.81082674993823" marker-end="url(#arrow-end)" />
</svg>
```

### caso tienda online con categorias

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
  width: 821.9874877929686px;
  height: 388.437520345052px;
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

<div class="shape entity" style="left:44.962504069010414px;top:40.01250203450522px;width:219.99999999999994px;height:126.40001424153643px;">
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
  </div>
</div>
<div class="shape entity" style="left:299.312520345052px;top:198.0375162760416px;width:219.99999999999994px;height:150.40000406901038px;">
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
      <div class="property-name">precio</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">categoria_id</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="shape entity" style="left:294.6500040690104px;top:40px;width:219.99999999999994px;height:126.40001424153643px;">
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
      <div class="property-name">cliente_id</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="shape entity" style="left:561.9874877929686px;top:98.6875px;width:219.99999999999994px;height:174.40000406901038px;">
  <div class="entity-header">LineasPedido</div>
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
<div class="shape entity" style="left:40px;top:243.3625081380208px;width:219.99999999999994px;height:102.4000040690104px;">
  <div class="entity-header">Categoria</div>
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
  </div>
</div>
<div class="arrow" style="left:203.05002848307288px;top:83.7562758456234px;width:158.31921769311606px;transform:rotate(0.29018612587092824rad);"></div>
<div class="arrow" style="left:454.5374959309895px;top:85.23011989264339px;width:189.7654150326733px;transform:rotate(0.5614093769739963rad);"></div>
<div class="arrow" style="left:466.77500406901027px;top:239.65559476710516px;width:150.62364183910387px;transform:rotate(-0.172043463442806rad);"></div>
<div class="arrow" style="left:194.71250406901038px;top:286.4850857909054px;width:159.13771240526012px;transform:rotate(0.15921284452516443rad);"></div>
</div>
</body>
</html>
```

### caso tienda online con categorias

```json
{
  "formas": [
    {
      "id": "forma-1",
      "tipo": "entity",
      "left": "34.0792px",
      "top": "135.625px",
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
        }
      ]
    },
    {
      "id": "forma-2",
      "tipo": "entity",
      "left": "288.433px",
      "top": "293.654px",
      "width": "",
      "height": "",
      "entityName": "Producto",
      "properties": [
        {
          "id": "prop-4",
          "name": "id"
        },
        {
          "id": "prop-5",
          "name": "nombre"
        },
        {
          "id": "prop-6",
          "name": "precio"
        },
        {
          "id": "prop-21",
          "name": "categoria_id"
        }
      ]
    },
    {
      "id": "forma-3",
      "tipo": "entity",
      "left": "283.771px",
      "top": "135.621px",
      "width": "",
      "height": "",
      "entityName": "Pedido",
      "properties": [
        {
          "id": "prop-7",
          "name": "id"
        },
        {
          "id": "prop-8",
          "name": "fecha"
        },
        {
          "id": "prop-9",
          "name": "cliente_id"
        }
      ]
    },
    {
      "id": "forma-5",
      "tipo": "entity",
      "left": "551.104px",
      "top": "194.308px",
      "width": "",
      "height": "",
      "entityName": "LineasPedido",
      "properties": [
        {
          "id": "prop-14",
          "name": "id"
        },
        {
          "id": "prop-15",
          "name": "fecha"
        },
        {
          "id": "prop-16",
          "name": "pedido_id"
        },
        {
          "id": "prop-17",
          "name": "producto_id"
        },
        {
          "id": "prop-18",
          "name": "cantidad"
        }
      ]
    },
    {
      "id": "forma-6",
      "tipo": "entity",
      "left": "29.1208px",
      "top": "338.983px",
      "width": "",
      "height": "",
      "entityName": "Categoria",
      "properties": [
        {
          "id": "prop-19",
          "name": "id"
        },
        {
          "id": "prop-20",
          "name": "nombre"
        }
      ]
    }
  ],
  "flechas": [
    {
      "desde": {
        "shapeId": "forma-1",
        "propId": "prop-1",
        "side": "right"
      },
      "hasta": {
        "shapeId": "forma-3",
        "propId": "prop-9",
        "side": "left"
      },
      "tipo": "simple",
      "estilo": "straight"
    },
    {
      "desde": {
        "shapeId": "forma-3",
        "propId": "prop-7",
        "side": "right"
      },
      "hasta": {
        "shapeId": "forma-5",
        "propId": "prop-16",
        "side": "left"
      },
      "tipo": "simple",
      "estilo": "straight"
    },
    {
      "desde": {
        "shapeId": "forma-2",
        "propId": "prop-4",
        "side": "right"
      },
      "hasta": {
        "shapeId": "forma-5",
        "propId": "prop-17",
        "side": "left"
      },
      "tipo": "simple",
      "estilo": "straight"
    },
    {
      "desde": {
        "shapeId": "forma-6",
        "propId": "prop-19",
        "side": "right"
      },
      "hasta": {
        "shapeId": "forma-2",
        "propId": "prop-21",
        "side": "left"
      },
      "tipo": "simple",
      "estilo": "straight"
    }
  ]
}
```

### caso tienda online con categorias

```
<svg xmlns="http://www.w3.org/2000/svg" width="821.9874877929686" height="388.437520345052" viewBox="0 0 821.9874877929686 388.437520345052">

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
        
<rect class="shape-entity" x="44.962504069010414" y="40.01250203450522" width="219.99999999999994" height="126.40001424153643" />
<line x1="44.962504069010414" y1="66.41250356038411" x2="264.9625040690104" y2="66.41250356038411" stroke="#e5e7eb" stroke-width="1"/>
<text x="154.96250406901038" y="58.01250330607096" text-anchor="middle">Cliente</text>
<text x="128.86250813802081" y="86.41250610351562">id</text>
<text x="128.86250813802081" y="110.41251055399576">nombre</text>
<text x="128.86250813802081" y="134.4125061035156">apellidos</text>
<rect class="shape-entity" x="299.312520345052" y="198.0375162760416" width="219.99999999999994" height="150.40000406901038" />
<line x1="299.312520345052" y1="224.4375127156575" x2="519.312520345052" y2="224.4375127156575" stroke="#e5e7eb" stroke-width="1"/>
<text x="409.312520345052" y="216.03751246134436" text-anchor="middle">Producto</text>
<text x="373.83750406901027" y="244.43752034505204">id</text>
<text x="373.83750406901027" y="268.43752034505206">nombre</text>
<text x="373.83750406901027" y="292.437520345052">precio</text>
<text x="373.83750406901027" y="316.437520345052">categoria_id</text>
<rect class="shape-entity" x="294.6500040690104" y="40" width="219.99999999999994" height="126.40001424153643" />
<line x1="294.6500040690104" y1="66.40000152587892" x2="514.6500040690103" y2="66.40000152587892" stroke="#e5e7eb" stroke-width="1"/>
<text x="404.6500040690104" y="58.00000127156577" text-anchor="middle">Pedido</text>
<text x="376.750020345052" y="86.40000406901041">id</text>
<text x="376.750020345052" y="110.40000851949054">fecha</text>
<text x="376.750020345052" y="134.40001424153644">cliente_id</text>
<rect class="shape-entity" x="561.9874877929686" y="98.6875" width="219.99999999999994" height="174.40000406901038" />
<line x1="561.9874877929686" y1="125.08751424153645" x2="781.9874877929685" y2="125.08751424153645" stroke="#e5e7eb" stroke-width="1"/>
<text x="671.9874877929686" y="116.68751017252603" text-anchor="middle">LineasPedido</text>
<text x="637.1749877929686" y="145.08751424153644">id</text>
<text x="637.1749877929686" y="169.08750406901038">fecha</text>
<text x="637.1749877929686" y="193.0875040690104">pedido_id</text>
<text x="637.1749877929686" y="217.08750406901035">producto_id</text>
<text x="637.1749877929686" y="241.08750406901035">cantidad</text>
<rect class="shape-entity" x="40" y="243.3625081380208" width="219.99999999999994" height="102.4000040690104" />
<line x1="40" y1="269.76250457763666" x2="259.99999999999994" y2="269.76250457763666" stroke="#e5e7eb" stroke-width="1"/>
<text x="149.99999999999997" y="261.3625043233235" text-anchor="middle">Categoria</text>
<text x="127.2750040690104" y="289.76251220703125">id</text>
<text x="127.2750040690104" y="313.76251220703125">nombre</text>
<path class="conn" d="M 203.05002848307288 83.7562758456234 L 354.750020345052 129.05624449942866" marker-end="url(#arrow-end)" />
<path class="conn" d="M 454.5374959309895 85.23011989264339 L 615.1749877929686 186.25738824537743" marker-end="url(#arrow-end)" />
<path class="conn" d="M 466.77500406901027 239.65559476710516 L 615.1749877929686 213.86942964695723" marker-end="url(#arrow-end)" />
<path class="conn" d="M 194.71250406901038 286.4850857909054 L 351.8375040690104 311.7149467611779" marker-end="url(#arrow-end)" />
</svg>
```

### caso de que un producto tenga muchas categorias

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
  width: 817.3374837239581px;
  height: 485.0875040690104px;
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

<div class="shape entity" style="left:40.3125px;top:40.01250203450522px;width:219.99999999999994px;height:126.40001424153643px;">
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
  </div>
</div>
<div class="shape entity" style="left:289.99999999999994px;top:40px;width:219.99999999999994px;height:126.40001424153643px;">
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
      <div class="property-name">cliente_id</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="shape entity" style="left:557.3374837239581px;top:98.6875px;width:219.99999999999994px;height:174.40000406901038px;">
  <div class="entity-header">LineasPedido</div>
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
<div class="shape entity" style="left:40.02500406901042px;top:342.6875px;width:219.99999999999994px;height:102.4000040690104px;">
  <div class="entity-header">Categoria</div>
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
  </div>
</div>
<div class="shape entity" style="left:40px;top:191.3625081380208px;width:219.99999999999994px;height:126.40000406901038px;">
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
      <div class="property-name">atributo</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="shape entity" style="left:307.33752441406244px;top:280.05000813802076px;width:219.99999999999994px;height:126.40000406901038px;">
  <div class="entity-header">Entidad</div>
  <div class="entity-properties">
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">id</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">producto_id</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">categoria_id</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="arrow" style="left:198.40002441406247px;top:83.75627073265511px;width:158.31921743552306px;transform:rotate(0.29018612042228886rad);"></div>
<div class="arrow" style="left:449.8874918619791px;top:85.23011494130446px;width:189.7654175968351px;transform:rotate(0.561409398459061rad);"></div>
<div class="arrow" style="left:195.08752441406247px;top:236.68061831578078px;width:196.3873654535851px;transform:rotate(0.5752975064181314rad);"></div>
<div class="arrow" style="left:194.7375081380208px;top:384.70924034584186px;width:165.70740981764874px;transform:rotate(-0.08386594787429323rad);"></div>
<div class="arrow" style="left:195.08752441406247px;top:233.5433102148876px;width:415.9300454950762px;transform:rotate(-0.04867308072567927rad);"></div>
</div>
</body>
</html>
```

### caso de que un producto tenga muchas categorias

```json
{
  "formas": [
    {
      "id": "forma-1",
      "tipo": "entity",
      "left": "34.0792px",
      "top": "135.625px",
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
        }
      ]
    },
    {
      "id": "forma-3",
      "tipo": "entity",
      "left": "283.771px",
      "top": "135.621px",
      "width": "",
      "height": "",
      "entityName": "Pedido",
      "properties": [
        {
          "id": "prop-7",
          "name": "id"
        },
        {
          "id": "prop-8",
          "name": "fecha"
        },
        {
          "id": "prop-9",
          "name": "cliente_id"
        }
      ]
    },
    {
      "id": "forma-5",
      "tipo": "entity",
      "left": "551.104px",
      "top": "194.308px",
      "width": "",
      "height": "",
      "entityName": "LineasPedido",
      "properties": [
        {
          "id": "prop-14",
          "name": "id"
        },
        {
          "id": "prop-15",
          "name": "fecha"
        },
        {
          "id": "prop-16",
          "name": "pedido_id"
        },
        {
          "id": "prop-17",
          "name": "producto_id"
        },
        {
          "id": "prop-18",
          "name": "cantidad"
        }
      ]
    },
    {
      "id": "forma-7",
      "tipo": "entity",
      "left": "33.7917px",
      "top": "438.304px",
      "width": "",
      "height": "",
      "entityName": "Categoria",
      "properties": [
        {
          "id": "prop-22",
          "name": "id"
        },
        {
          "id": "prop-23",
          "name": "nombre"
        }
      ]
    },
    {
      "id": "forma-9",
      "tipo": "entity",
      "left": "33.7667px",
      "top": "286.983px",
      "width": "",
      "height": "",
      "entityName": "Producto",
      "properties": [
        {
          "id": "prop-27",
          "name": "id"
        },
        {
          "id": "prop-28",
          "name": "nombre"
        },
        {
          "id": "prop-29",
          "name": "atributo"
        }
      ]
    },
    {
      "id": "forma-10",
      "tipo": "entity",
      "left": "301.108px",
      "top": "375.663px",
      "width": "",
      "height": "",
      "entityName": "Entidad",
      "properties": [
        {
          "id": "prop-30",
          "name": "id"
        },
        {
          "id": "prop-31",
          "name": "producto_id"
        },
        {
          "id": "prop-32",
          "name": "categoria_id"
        }
      ]
    }
  ],
  "flechas": [
    {
      "desde": {
        "shapeId": "forma-1",
        "propId": "prop-1",
        "side": "right"
      },
      "hasta": {
        "shapeId": "forma-3",
        "propId": "prop-9",
        "side": "left"
      },
      "tipo": "simple",
      "estilo": "straight"
    },
    {
      "desde": {
        "shapeId": "forma-3",
        "propId": "prop-7",
        "side": "right"
      },
      "hasta": {
        "shapeId": "forma-5",
        "propId": "prop-16",
        "side": "left"
      },
      "tipo": "simple",
      "estilo": "straight"
    },
    {
      "desde": {
        "shapeId": "forma-9",
        "propId": "prop-27",
        "side": "right"
      },
      "hasta": {
        "shapeId": "forma-10",
        "propId": "prop-31",
        "side": "left"
      },
      "tipo": "simple",
      "estilo": "straight"
    },
    {
      "desde": {
        "shapeId": "forma-7",
        "propId": "prop-22",
        "side": "right"
      },
      "hasta": {
        "shapeId": "forma-10",
        "propId": "prop-32",
        "side": "left"
      },
      "tipo": "simple",
      "estilo": "straight"
    },
    {
      "desde": {
        "shapeId": "forma-9",
        "propId": "prop-27",
        "side": "right"
      },
      "hasta": {
        "shapeId": "forma-5",
        "propId": "prop-17",
        "side": "left"
      },
      "tipo": "simple",
      "estilo": "straight"
    }
  ]
}
```

### caso de que un producto tenga muchas categorias

```
<svg xmlns="http://www.w3.org/2000/svg" width="817.3374837239581" height="485.0875040690104" viewBox="0 0 817.3374837239581 485.0875040690104">

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
        
<rect class="shape-entity" x="40.3125" y="40.01250203450522" width="219.99999999999994" height="126.40001424153643" />
<line x1="40.3125" y1="66.41250356038411" x2="260.31249999999994" y2="66.41250356038411" stroke="#e5e7eb" stroke-width="1"/>
<text x="150.31249999999997" y="58.01250330607096" text-anchor="middle">Cliente</text>
<text x="124.21250406901041" y="86.4125010172526">id</text>
<text x="124.21250406901041" y="110.41250610351562">nombre</text>
<text x="124.21250406901041" y="134.41251055399573">apellidos</text>
<rect class="shape-entity" x="289.99999999999994" y="40" width="219.99999999999994" height="126.40001424153643" />
<line x1="289.99999999999994" y1="66.40000152587892" x2="509.9999999999999" y2="66.40000152587892" stroke="#e5e7eb" stroke-width="1"/>
<text x="399.9999999999999" y="58.00000127156577" text-anchor="middle">Pedido</text>
<text x="372.1000162760416" y="86.3999989827474">id</text>
<text x="372.1000162760416" y="110.40000406901041">fecha</text>
<text x="372.1000162760416" y="134.40000851949054">cliente_id</text>
<rect class="shape-entity" x="557.3374837239581" y="98.6875" width="219.99999999999994" height="174.40000406901038" />
<line x1="557.3374837239581" y1="125.08750661214192" x2="777.337483723958" y2="125.08750661214192" stroke="#e5e7eb" stroke-width="1"/>
<text x="667.3374837239581" y="116.68750635782877" text-anchor="middle">LineasPedido</text>
<text x="632.5249837239581" y="145.08750851949054">id</text>
<text x="632.5249837239581" y="169.08751424153644">fecha</text>
<text x="632.5249837239581" y="193.0875040690104">pedido_id</text>
<text x="632.5249837239581" y="217.08750406901035">producto_id</text>
<text x="632.5249837239581" y="241.08750406901035">cantidad</text>
<rect class="shape-entity" x="40.02500406901042" y="342.6875" width="219.99999999999994" height="102.4000040690104" />
<line x1="40.02500406901042" y1="369.0875167846679" x2="260.0250040690104" y2="369.0875167846679" stroke="#e5e7eb" stroke-width="1"/>
<text x="150.02500406901038" y="360.6875165303548" text-anchor="middle">Categoria</text>
<text x="127.30000813802081" y="389.0875244140625">id</text>
<text x="127.30000813802081" y="413.0875244140624">nombre</text>
<rect class="shape-entity" x="40" y="191.3625081380208" width="219.99999999999994" height="126.40000406901038" />
<line x1="40" y1="217.76250457763663" x2="259.99999999999994" y2="217.76250457763663" stroke="#e5e7eb" stroke-width="1"/>
<text x="149.99999999999997" y="209.3625043233235" text-anchor="middle">Producto</text>
<text x="126.90000406901041" y="237.76251220703122">id</text>
<text x="126.90000406901041" y="261.7625122070312">nombre</text>
<text x="126.90000406901041" y="285.76251220703125">atributo</text>
<rect class="shape-entity" x="307.33752441406244" y="280.05000813802076" width="219.99999999999994" height="126.40000406901038" />
<line x1="307.33752441406244" y1="306.45000457763666" x2="527.3375244140624" y2="306.45000457763666" stroke="#e5e7eb" stroke-width="1"/>
<text x="417.3375244140624" y="298.05000432332355" text-anchor="middle">Entidad</text>
<text x="381.86250813802076" y="326.45001220703125">id</text>
<text x="381.86250813802076" y="350.45003255208326">producto_id</text>
<text x="381.86250813802076" y="374.45003255208326">categoria_id</text>
<path class="conn" d="M 198.40002441406247 83.75627073265511 L 350.1000162760416 129.05623848619658" marker-end="url(#arrow-end)" />
<path class="conn" d="M 449.8874918619791 85.23011494130446 L 610.5249837239581 186.25738811045332" marker-end="url(#arrow-end)" />
<path class="conn" d="M 195.08752441406247 236.68061831578078 L 359.86250813802076 343.53192644333376" marker-end="url(#arrow-end)" />
<path class="conn" d="M 194.7375081380208 384.70924034584186 L 359.86250813802076 370.8283166203039" marker-end="url(#arrow-end)" />
<path class="conn" d="M 195.08752441406247 233.5433102148876 L 610.5249837239581 213.30670606115396" marker-end="url(#arrow-end)" />
</svg>
```

<a id="el-modelo-er-ampliado-generalizacion-y-especializacion-agregacion"></a>
## El modelo ER ampliado. Generalización y especialización. Agregación

El modelo ER ampliado es una extensión del modelo básico de entidad-relación que permite representar relaciones más complejas entre entidades, introduciendo conceptos como generalización, especialización y agregación. Esta extensión es crucial para modelar sistemas empresariales donde las relaciones entre objetos son dinámicas y pueden variar significativamente.

La generalización en el modelo ER ampliado permite representar una jerarquía de entidades, donde una entidad más general (superclase) puede tener subentidades más específicas (subclases). Este concepto es útil para modelar relaciones como "Persona" (general) y "Estudiante" o "Profesor" (específicas), permitiendo compartir atributos comunes entre entidades relacionadas.

La especialización, por otro lado, permite que una subentidad herede atributos y relaciones de su superclase. Esto facilita la gestión de datos en sistemas empresariales donde diferentes tipos de objetos comparten características básicas pero también tienen diferencias significativas.

La agregación es un concepto que representa una relación "parte-todo" entre entidades, donde una entidad (todo) contiene o está compuesta por otras entidades (partes). Por ejemplo, en un sistema de gestión de bibliotecas, la entidad "Librería" puede estar compuesta por varias entidades "Sección", cada una con sus propias características y relaciones.

Estos conceptos permiten crear modelos ER más precisos y detallados que reflejan las relaciones complejas entre objetos en el mundo real. Al utilizar generalización, especialización y agregación, los diseñadores de sistemas pueden representar mejor la realidad empresarial, lo que facilita la implementación y mantenimiento de bases de datos eficientes.

La interpretación de estos diagramas ER ampliados es crucial para entender cómo se organizan y relacionan los datos en un sistema. Permite a los desarrolladores visualizar las entidades, sus relaciones y las jerarquías que existen dentro del sistema, lo que facilita la planificación y diseño de bases de datos robustas y escalables.

En resumen, el modelo ER ampliado es una herramienta poderosa para modelar sistemas empresariales complejos. Al entender y aplicar conceptos como generalización, especialización y agregación, los diseñadores pueden crear modelos que reflejen eficazmente las relaciones entre objetos en el mundo real, lo que resulta en bases de datos más precisas y eficientes.

### Generalizacion

```markdown
En ocasiones ocurre que varias clases realmente derivan de una superclase
Cuando esto ocurre, tenemos propiedades duplicadas
No queremos propiedades duplicadas

Para ello, consideramos la creación de una clase superior (en programación de hecho decidiremos si es una clase abstracta)
```

### generalizacion

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
  width: 559.6000269839636px;
  height: 230.93748393811669px;
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

<div class="shape entity" style="left:40px;top:40.53749486019734px;width:219.99999999999991px;height:150.39998907791934px;">
  <div class="entity-header">Alumno</div>
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
      <div class="property-name">dni</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="shape entity" style="left:299.60002698396374px;top:40px;width:219.99999999999991px;height:150.40000513980257px;">
  <div class="entity-header">Profesor</div>
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
      <div class="property-name">dni</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
</div>
</body>
</html>
```

### generalizacion

```json
{
  "formas": [
    {
      "id": "forma-1",
      "tipo": "entity",
      "left": "226.263px",
      "top": "149.411px",
      "width": "",
      "height": "",
      "entityName": "Alumno",
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
          "name": "dni"
        }
      ]
    },
    {
      "id": "forma-2",
      "tipo": "entity",
      "left": "485.87px",
      "top": "148.868px",
      "width": "",
      "height": "",
      "entityName": "Profesor",
      "properties": [
        {
          "id": "prop-5",
          "name": "id"
        },
        {
          "id": "prop-6",
          "name": "nombre"
        },
        {
          "id": "prop-7",
          "name": "apellidos"
        },
        {
          "id": "prop-8",
          "name": "dni"
        }
      ]
    }
  ],
  "flechas": []
}
```

### generalizacion

```
<svg xmlns="http://www.w3.org/2000/svg" width="559.6000269839636" height="230.93748393811669" viewBox="0 0 559.6000269839636 230.93748393811669">

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
        
<rect class="shape-entity" x="40" y="40.53749486019734" width="219.99999999999991" height="150.39998907791934" />
<line x1="40" y1="66.93750481856495" x2="259.9999999999999" y2="66.93750481856495" stroke="#e5e7eb" stroke-width="1"/>
<text x="149.99999999999994" y="58.53750610351561" text-anchor="middle">Alumno</text>
<text x="123.89999871504935" y="86.93750963712992">id</text>
<text x="123.89999871504935" y="110.93749076441712">nombre</text>
<text x="123.89999871504935" y="134.93747791491052">apellidos</text>
<text x="123.89999871504935" y="158.93747108861015">dni</text>
<rect class="shape-entity" x="299.60002698396374" y="40" width="219.99999999999991" height="150.40000513980257" />
<line x1="299.60002698396374" y1="66.40000795063217" x2="519.6000269839636" y2="66.40000795063217" stroke="#e5e7eb" stroke-width="1"/>
<text x="409.6000269839637" y="58.000002208508924" text-anchor="middle">Profesor</text>
<text x="383.49999357524666" y="86.40001477693255">id</text>
<text x="383.49999357524666" y="110.39999590421975">nombre</text>
<text x="383.49999357524666" y="134.39999610499328">apellidos</text>
<text x="383.49999357524666" y="158.4000083521792">dni</text>
</svg>
```

### solucion con generalizacion

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
  width: 626.8750381469724px;
  height: 394.2750024795531px;
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

<div class="shape entity" style="left:189.3750381469726px;top:40px;width:219.99999999999991px;height:150.39999961853022px;">
  <div class="entity-header">Persona</div>
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
      <div class="property-name">dni-nie</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="shape entity" style="left:40px;top:251.87500476837153px;width:220.00003814697257px;height:102.39999771118161px;">
  <div class="entity-header">Alumno</div>
  <div class="entity-properties">
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">id</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">NIA</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="shape entity" style="left:366.8750381469726px;top:251.87500476837153px;width:219.99999999999991px;height:102.39999771118161px;">
  <div class="entity-header">Profesor</div>
  <div class="entity-properties">
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">id</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">correo_corporativo</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="arrow" style="left:239.58527805246655px;top:190.39999961853022px;width:78.5377006921602px;transform:rotate(2.2425279770177866rad);"></div>
<div class="arrow" style="left:370.422275379818px;top:190.39999961853022px;width:84.57235470649327px;transform:rotate(0.8137860295221024rad);"></div>
</div>
</body>
</html>
```

### solucion con generalizacion

```json
{
  "formas": [
    {
      "id": "forma-3",
      "tipo": "entity",
      "left": "359.7px",
      "top": "-29.95px",
      "width": "",
      "height": "",
      "entityName": "Persona",
      "properties": [
        {
          "id": "prop-9",
          "name": "id"
        },
        {
          "id": "prop-10",
          "name": "nombre"
        },
        {
          "id": "prop-11",
          "name": "apellidos"
        },
        {
          "id": "prop-12",
          "name": "dni-nie"
        }
      ]
    },
    {
      "id": "forma-4",
      "tipo": "entity",
      "left": "210.325px",
      "top": "181.938px",
      "width": "",
      "height": "",
      "entityName": "Alumno",
      "properties": [
        {
          "id": "prop-13",
          "name": "id"
        },
        {
          "id": "prop-15",
          "name": "NIA"
        }
      ]
    },
    {
      "id": "forma-5",
      "tipo": "entity",
      "left": "537.2px",
      "top": "181.938px",
      "width": "",
      "height": "",
      "entityName": "Profesor",
      "properties": [
        {
          "id": "prop-14",
          "name": "id"
        },
        {
          "id": "prop-16",
          "name": "correo_corporativo"
        }
      ]
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
        "shapeId": "forma-3",
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
    }
  ]
}
```

### solucion con generalizacion

```
<svg xmlns="http://www.w3.org/2000/svg" width="626.8750381469724" height="394.2750024795531" viewBox="0 0 626.8750381469724 394.2750024795531">

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
        
<rect class="shape-entity" x="189.3750381469726" y="40" width="219.99999999999991" height="150.39999961853022" />
<line x1="189.3750381469726" y1="66.40000104904175" x2="409.37503814697254" y2="66.40000104904175" stroke="#e5e7eb" stroke-width="1"/>
<text x="299.37503814697254" y="57.99999976158142" text-anchor="middle">Persona</text>
<text x="273.2750167846679" y="86.40000247955321">id</text>
<text x="273.2750167846679" y="110.39999508857726">nombre</text>
<text x="273.2750167846679" y="134.39999485015866">apellidos</text>
<text x="273.2750167846679" y="158.3999910354614">dni-nie</text>
<rect class="shape-entity" x="40" y="251.87500476837153" width="220.00003814697257" height="102.39999771118161" />
<line x1="40" y1="278.2750225067138" x2="260.00003814697254" y2="278.2750225067138" stroke="#e5e7eb" stroke-width="1"/>
<text x="150.00001907348627" y="269.8750128746032" text-anchor="middle">Alumno</text>
<text x="139.3125381469726" y="298.27502155303944">id</text>
<text x="139.3125381469726" y="322.2750219106673">NIA</text>
<rect class="shape-entity" x="366.8750381469726" y="251.87500476837153" width="219.99999999999991" height="102.39999771118161" />
<line x1="366.8750381469726" y1="278.2750225067138" x2="586.8750381469725" y2="278.2750225067138" stroke="#e5e7eb" stroke-width="1"/>
<text x="476.87503814697254" y="269.8750128746032" text-anchor="middle">Profesor</text>
<text x="421.78751373291" y="298.27502155303944">id</text>
<text x="421.78751373291" y="322.2750219106673">correo_corporativo</text>
<path class="conn" d="M 239.58527805246655 190.39999961853022 L 190.7079400333157 251.8750047683715" marker-end="url(#arrow-end)" />
<path class="conn" d="M 370.422275379818 190.39999961853022 L 428.50245205334323 251.8750047683715" marker-end="url(#arrow-end)" />
</svg>
```

### Entidades abstractas

```markdown
Son aquellas que no instancian directamente objetos o tablas, sino que solo sirven para derivar otras entidades.

Ejemplo: 
Centro de formación, entidad "persona".
La entidad "persona" no me sirve de nada
Se dice que la clase persona es abstracta, porque:
-alumno hereda de persona, instancio alumno
-profesor hereda de persona, instancio profesor
-empleado hereda de persona, instancio empleado

Pero no instancio directamente de persona
```

### ejemplo con empleado

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
  width: 798.125076293945px;
  height: 394.2750024795531px;
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

<div class="shape entity" style="left:279.37503814697254px;top:40px;width:219.99999999999991px;height:150.39999961853022px;">
  <div class="entity-header">Persona</div>
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
      <div class="property-name">dni-nie</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="shape entity" style="left:40px;top:251.87500476837153px;width:220.00003814697257px;height:102.39999771118161px;">
  <div class="entity-header">Alumno</div>
  <div class="entity-properties">
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">id</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">NIA</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="shape entity" style="left:286.25003814697254px;top:250.62500476837153px;width:219.99999999999991px;height:102.39999771118161px;">
  <div class="entity-header">Profesor</div>
  <div class="entity-properties">
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">id</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">correo_corporativo</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="shape entity" style="left:538.1250762939451px;top:246.87500476837153px;width:219.99999999999991px;height:102.39999771118161px;">
  <div class="entity-header">EmpleadoPAS</div>
  <div class="entity-properties">
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">id</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">usuario_sistema</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="arrow" style="left:293.5613267794745px;top:190.39999961853022px;width:99.57011461851437px;transform:rotate(2.4761540958532944rad);"></div>
<div class="arrow" style="left:392.1452993023429px;top:190.39999961853022px;width:60.26585639774321px;transform:rotate(1.5339743982630256rad);"></div>
<div class="arrow" style="left:495.7755981656396px;top:190.39999961853022px;width:97.84928284752645px;transform:rotate(0.6152506144910285rad);"></div>
</div>
</body>
</html>
```

### ejemplo con empleado

```json
{
  "formas": [
    {
      "id": "forma-3",
      "tipo": "entity",
      "left": "359.7px",
      "top": "-29.95px",
      "width": "",
      "height": "",
      "entityName": "Persona",
      "properties": [
        {
          "id": "prop-9",
          "name": "id"
        },
        {
          "id": "prop-10",
          "name": "nombre"
        },
        {
          "id": "prop-11",
          "name": "apellidos"
        },
        {
          "id": "prop-12",
          "name": "dni-nie"
        }
      ]
    },
    {
      "id": "forma-4",
      "tipo": "entity",
      "left": "120.325px",
      "top": "181.938px",
      "width": "",
      "height": "",
      "entityName": "Alumno",
      "properties": [
        {
          "id": "prop-13",
          "name": "id"
        },
        {
          "id": "prop-15",
          "name": "NIA"
        }
      ]
    },
    {
      "id": "forma-5",
      "tipo": "entity",
      "left": "366.575px",
      "top": "180.688px",
      "width": "",
      "height": "",
      "entityName": "Profesor",
      "properties": [
        {
          "id": "prop-14",
          "name": "id"
        },
        {
          "id": "prop-16",
          "name": "correo_corporativo"
        }
      ]
    },
    {
      "id": "forma-6",
      "tipo": "entity",
      "left": "618.45px",
      "top": "176.938px",
      "width": "",
      "height": "",
      "entityName": "EmpleadoPAS",
      "properties": [
        {
          "id": "prop-17",
          "name": "id"
        },
        {
          "id": "prop-18",
          "name": "usuario_sistema"
        }
      ]
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
        "shapeId": "forma-3",
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
        "shapeId": "forma-3",
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
    }
  ]
}
```

### ejemplo con empleado

```
<svg xmlns="http://www.w3.org/2000/svg" width="798.125076293945" height="394.2750024795531" viewBox="0 0 798.125076293945 394.2750024795531">

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
        
<rect class="shape-entity" x="279.37503814697254" y="40" width="219.99999999999991" height="150.39999961853022" />
<line x1="279.37503814697254" y1="66.40000104904175" x2="499.37503814697243" y2="66.40000104904175" stroke="#e5e7eb" stroke-width="1"/>
<text x="389.3750381469725" y="57.99999976158142" text-anchor="middle">Persona</text>
<text x="363.27501678466786" y="86.40000247955321">id</text>
<text x="363.27501678466786" y="110.39999508857726">nombre</text>
<text x="363.27501678466786" y="134.39999485015866">apellidos</text>
<text x="363.27501678466786" y="158.3999910354614">dni-nie</text>
<rect class="shape-entity" x="40" y="251.87500476837153" width="220.00003814697257" height="102.39999771118161" />
<line x1="40" y1="278.2750225067138" x2="260.00003814697254" y2="278.2750225067138" stroke="#e5e7eb" stroke-width="1"/>
<text x="150.00001907348627" y="269.8750128746032" text-anchor="middle">Alumno</text>
<text x="139.31249999999997" y="298.27502155303944">id</text>
<text x="139.31249999999997" y="322.2750219106673">NIA</text>
<rect class="shape-entity" x="286.25003814697254" y="250.62500476837153" width="219.99999999999991" height="102.39999771118161" />
<line x1="286.25003814697254" y1="277.0250225067138" x2="506.25003814697243" y2="277.0250225067138" stroke="#e5e7eb" stroke-width="1"/>
<text x="396.2500381469725" y="268.6250128746032" text-anchor="middle">Profesor</text>
<text x="341.16251373291004" y="297.02502155303944">id</text>
<text x="341.16251373291004" y="321.0250219106673">correo_corporativo</text>
<rect class="shape-entity" x="538.1250762939451" y="246.87500476837153" width="219.99999999999991" height="102.39999771118161" />
<line x1="538.1250762939451" y1="273.2750225067138" x2="758.125076293945" y2="273.2750225067138" stroke="#e5e7eb" stroke-width="1"/>
<text x="648.1250762939451" y="264.8750128746032" text-anchor="middle">EmpleadoPAS</text>
<text x="601.0375061035154" y="293.27502155303944">id</text>
<text x="601.0375061035154" y="317.2750368118285">usuario_sistema</text>
<path class="conn" d="M 293.5613267794745 190.39999961853022 L 215.23488509487427 251.8750047683715" marker-end="url(#arrow-end)" />
<path class="conn" d="M 392.1452993023429 190.39999961853022 L 394.36390292962676 250.6250047683715" marker-end="url(#arrow-end)" />
<path class="conn" d="M 495.7755981656396 190.39999961853022 L 575.6821432486341 246.8750047683715" marker-end="url(#arrow-end)" />
</svg>
```

### especializacion

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
  width: 613.9249674479164px;
  height: 378.225008646647px;
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

<div class="shape entity" style="left:190.0999959309895px;top:40px;width:219.99999999999991px;height:150.40000067816834px;">
  <div class="entity-header">Alumno</div>
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
  </div>
</div>
<div class="shape entity" style="left:40px;top:235.82499610053156px;width:219.99999999999991px;height:102.4000125461154px;">
  <div class="entity-header">AlumnoPresencial</div>
  <div class="entity-properties">
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">id</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">tarjeta_acceso_centro</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="shape entity" style="left:353.9249674479165px;top:234.19998592800556px;width:219.99999999999991px;height:102.4000125461154px;">
  <div class="entity-header">AlumnoOnline</div>
  <div class="entity-properties">
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">id</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">mediumseagreen</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="arrow" style="left:234.40804417044046px;top:190.40000067816834px;width:60.31633176375316px;transform:rotate(2.2888119750509315rad);"></div>
<div class="arrow" style="left:372.4833008821071px;top:190.40000067816834px;width:60.79354083727748px;transform:rotate(0.8044813073809017rad);"></div>
</div>
</body>
</html>
```

### especializacion

```json
{
  "formas": [
    {
      "id": "forma-1",
      "tipo": "entity",
      "left": "491.038px",
      "top": "116.279px",
      "width": "",
      "height": "",
      "entityName": "Alumno",
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
        }
      ]
    },
    {
      "id": "forma-2",
      "tipo": "entity",
      "left": "340.947px",
      "top": "312.111px",
      "width": "",
      "height": "",
      "entityName": "AlumnoPresencial",
      "properties": [
        {
          "id": "prop-5",
          "name": "id"
        },
        {
          "id": "prop-6",
          "name": "tarjeta_acceso_centro"
        }
      ]
    },
    {
      "id": "forma-3",
      "tipo": "entity",
      "left": "654.872px",
      "top": "310.478px",
      "width": "",
      "height": "",
      "entityName": "AlumnoOnline",
      "properties": [
        {
          "id": "prop-7",
          "name": "id"
        },
        {
          "id": "prop-8",
          "name": "mediumseagreen"
        }
      ]
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
        "shapeId": "forma-1",
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

### especializacion

```
<svg xmlns="http://www.w3.org/2000/svg" width="613.9249674479164" height="378.225008646647" viewBox="0 0 613.9249674479164 378.225008646647">

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
        
<rect class="shape-entity" x="190.0999959309895" y="40" width="219.99999999999991" height="150.40000067816834" />
<line x1="190.0999959309895" y1="66.39999813503688" x2="410.0999959309894" y2="66.39999813503688" stroke="#e5e7eb" stroke-width="1"/>
<text x="300.09999593098945" y="58.00000042385525" text-anchor="middle">Alumno</text>
<text x="273.9999999999999" y="86.39999983045787">id</text>
<text x="273.9999999999999" y="110.39999813503688">nombre</text>
<text x="273.9999999999999" y="134.39999643961585">apellidos</text>
<text x="273.9999999999999" y="158.39999474419483">email</text>
<rect class="shape-entity" x="40" y="235.82499610053156" width="219.99999999999991" height="102.4000125461154" />
<line x1="40" y1="262.2250048319498" x2="259.9999999999999" y2="262.2250048319498" stroke="#e5e7eb" stroke-width="1"/>
<text x="149.99999999999994" y="253.82499334547245" text-anchor="middle">AlumnoPresencial</text>
<text x="86.5" y="282.225000169542">id</text>
<text x="86.5" y="306.225006951226">tarjeta_acceso_centro</text>
<rect class="shape-entity" x="353.9249674479165" y="234.19998592800556" width="219.99999999999991" height="102.4000125461154" />
<line x1="353.9249674479165" y1="260.6000116136338" x2="573.9249674479164" y2="260.6000116136338" stroke="#e5e7eb" stroke-width="1"/>
<text x="463.92496744791646" y="252.20000012715647" text-anchor="middle">AlumnoOnline</text>
<text x="413.56251356336793" y="280.600006951226">id</text>
<text x="413.56251356336793" y="304.60001373291004">mediumseagreen</text>
<path class="conn" d="M 234.40804417044046 190.40000067816834 L 194.72644051946116 235.82499610053162" marker-end="url(#arrow-end)" />
<path class="conn" d="M 372.4833008821071 190.40000067816834 L 414.642711452557 234.19998592800556" marker-end="url(#arrow-end)" />
</svg>
```

### Agregacion

```markdown
Mediante la agregación, diferentes clases trabajan de forma conjunta para declarar una entidad mayor

La entidad mayor, no tiene sentido sin la composición de las entidades menores

Pero las entidades menores, tienen sentido consigo mismas

-Un coche

Yo tengo una rueda. Una rueda, es un objeto, es una entidad

Tambien tengo un motor

Tambien tengo la carroceria
```

### entidades de coches sueltas

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
  width: 821.7500610351562px;
  height: 188.7125142415364px;
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

<div class="shape entity" style="left:40px;top:46.31251017252603px;width:219.99999999999994px;height:102.4000040690104px;">
  <div class="entity-header">Rueda</div>
  <div class="entity-properties">
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">id</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">diametro</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="shape entity" style="left:309.0875040690104px;top:40px;width:219.99997965494785px;height:102.4000040690104px;">
  <div class="entity-header">Carroceria</div>
  <div class="entity-properties">
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">id</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">tipo_metal</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="shape entity" style="left:561.7500610351562px;top:46.01250203450519px;width:219.99999999999994px;height:79.99999999999997px;">
  <div class="entity-header">Chapa</div>
  <div class="entity-properties">
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">id</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
</div>
</body>
</html>
```

### entidades de coches sueltas

```json
{
  "formas": [
    {
      "id": "forma-1",
      "tipo": "entity",
      "left": "181.658px",
      "top": "197.183px",
      "width": "",
      "height": "",
      "entityName": "Rueda",
      "properties": [
        {
          "id": "prop-1",
          "name": "id"
        },
        {
          "id": "prop-2",
          "name": "diametro"
        }
      ]
    },
    {
      "id": "forma-2",
      "tipo": "entity",
      "left": "450.737px",
      "top": "190.863px",
      "width": "",
      "height": "",
      "entityName": "Carroceria",
      "properties": [
        {
          "id": "prop-3",
          "name": "id"
        },
        {
          "id": "prop-4",
          "name": "tipo_metal"
        }
      ]
    },
    {
      "id": "forma-3",
      "tipo": "entity",
      "left": "703.4px",
      "top": "196.875px",
      "width": "",
      "height": "",
      "entityName": "Chapa",
      "properties": [
        {
          "id": "prop-5",
          "name": "id"
        }
      ]
    }
  ],
  "flechas": []
}
```

### entidades de coches sueltas

```
<svg xmlns="http://www.w3.org/2000/svg" width="821.7500610351562" height="188.7125142415364" viewBox="0 0 821.7500610351562 188.7125142415364">

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
        
<rect class="shape-entity" x="40" y="46.31251017252603" width="219.99999999999994" height="102.4000040690104" />
<line x1="40" y1="72.71250661214192" x2="259.99999999999994" y2="72.71250661214192" stroke="#e5e7eb" stroke-width="1"/>
<text x="149.99999999999997" y="64.31250635782877" text-anchor="middle">Rueda</text>
<text x="123.68749999999997" y="92.71249389648435">id</text>
<text x="123.68749999999997" y="116.71249389648435">diametro</text>
<rect class="shape-entity" x="309.0875040690104" y="40" width="219.99997965494785" height="102.4000040690104" />
<line x1="309.0875040690104" y1="66.40000661214192" x2="529.0874837239583" y2="66.40000661214192" stroke="#e5e7eb" stroke-width="1"/>
<text x="419.0874938964843" y="58.000006357828774" text-anchor="middle">Carroceria</text>
<text x="387.812520345052" y="86.39999389648435">id</text>
<text x="387.812520345052" y="110.39999389648435">tipo_metal</text>
<rect class="shape-entity" x="561.7500610351562" y="46.01250203450519" width="219.99999999999994" height="79.99999999999997" />
<line x1="561.7500610351562" y1="72.41249847412108" x2="781.7500610351562" y2="72.41249847412108" stroke="#e5e7eb" stroke-width="1"/>
<text x="671.7500610351562" y="64.01249821980792" text-anchor="middle">Chapa</text>
<text x="666.4375610351561" y="92.4125061035156">id</text>
</svg>
```

### coche por agregacion

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
  width: 825.750061035156px;
  height: 367.06250508626295px;
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

<div class="shape entity" style="left:40px;top:189.65000915527338px;width:219.99999999999994px;height:102.4000040690104px;">
  <div class="entity-header">Rueda</div>
  <div class="entity-properties">
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">id</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">diametro</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="shape entity" style="left:299.0875040690104px;top:200.66250101725254px;width:219.99997965494785px;height:126.40000406901038px;">
  <div class="entity-header">Carroceria</div>
  <div class="entity-properties">
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">id</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">tipo_metal</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">numero_bastidor</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="shape entity" style="left:565.7500610351561px;top:185.33750915527338px;width:219.99999999999994px;height:79.99999999999997px;">
  <div class="entity-header">Chapa</div>
  <div class="entity-properties">
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">id</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="shape entity" style="left:294.4000040690104px;top:40px;width:219.99997965494785px;height:102.4000040690104px;">
  <div class="entity-header">Coche</div>
  <div class="entity-properties">
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">id</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">matricula</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="arrow arrow-double" style="left:237.0382853873625px;top:189.65000915527338px;width:93.19021022966439px;transform:rotate(-0.5317326936266109rad);"></div>
<div class="arrow arrow-double" style="left:407.37171885678913px;top:200.66250101725257px;width:58.28396366391503px;transform:rotate(-1.5979379983706976rad);"></div>
<div class="arrow arrow-double" style="left:594.8330757822941px;top:185.33750915527338px;width:96.89258849727445px;transform:rotate(-2.682488278522301rad);"></div>
</div>
</body>
</html>
```

### coche por agregacion

```json
{
  "formas": [
    {
      "id": "forma-1",
      "tipo": "entity",
      "left": "181.658px",
      "top": "197.183px",
      "width": "",
      "height": "",
      "entityName": "Rueda",
      "properties": [
        {
          "id": "prop-1",
          "name": "id"
        },
        {
          "id": "prop-2",
          "name": "diametro"
        }
      ]
    },
    {
      "id": "forma-2",
      "tipo": "entity",
      "left": "440.737px",
      "top": "208.196px",
      "width": "",
      "height": "",
      "entityName": "Carroceria",
      "properties": [
        {
          "id": "prop-3",
          "name": "id"
        },
        {
          "id": "prop-4",
          "name": "tipo_metal"
        },
        {
          "id": "prop-7",
          "name": "numero_bastidor"
        }
      ]
    },
    {
      "id": "forma-3",
      "tipo": "entity",
      "left": "707.4px",
      "top": "192.871px",
      "width": "",
      "height": "",
      "entityName": "Chapa",
      "properties": [
        {
          "id": "prop-5",
          "name": "id"
        }
      ]
    },
    {
      "id": "forma-4",
      "tipo": "entity",
      "left": "436.058px",
      "top": "47.525px",
      "width": "",
      "height": "",
      "entityName": "Coche",
      "properties": [
        {
          "id": "prop-6",
          "name": "id"
        },
        {
          "id": "prop-8",
          "name": "matricula"
        }
      ]
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
        "shapeId": "forma-4",
        "propId": null,
        "side": null
      },
      "tipo": "doble",
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
      "tipo": "doble",
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
      "tipo": "doble",
      "estilo": "straight"
    }
  ]
}
```

### coche por agregacion

```
<svg xmlns="http://www.w3.org/2000/svg" width="825.750061035156" height="367.06250508626295" viewBox="0 0 825.750061035156 367.06250508626295">

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
        
<rect class="shape-entity" x="40" y="189.65000915527338" width="219.99999999999994" height="102.4000040690104" />
<line x1="40" y1="216.05000559488926" x2="259.99999999999994" y2="216.05000559488926" stroke="#e5e7eb" stroke-width="1"/>
<text x="149.99999999999997" y="207.65000534057612" text-anchor="middle">Rueda</text>
<text x="123.68749999999997" y="236.0499928792317">id</text>
<text x="123.68749999999997" y="260.0499928792317">diametro</text>
<rect class="shape-entity" x="299.0875040690104" y="200.66250101725254" width="219.99997965494785" height="126.40000406901038" />
<line x1="299.0875040690104" y1="227.0624974568684" x2="519.0874837239583" y2="227.0624974568684" stroke="#e5e7eb" stroke-width="1"/>
<text x="409.0874938964843" y="218.66249720255527" text-anchor="middle">Carroceria</text>
<text x="359.36248779296864" y="247.06250508626295">id</text>
<text x="359.36248779296864" y="271.06250508626295">tipo_metal</text>
<text x="359.36248779296864" y="295.06250508626295">numero_bastidor</text>
<rect class="shape-entity" x="565.7500610351561" y="185.33750915527338" width="219.99999999999994" height="79.99999999999997" />
<line x1="565.7500610351561" y1="211.73750559488926" x2="785.750061035156" y2="211.73750559488926" stroke="#e5e7eb" stroke-width="1"/>
<text x="675.7500610351561" y="203.33750534057612" text-anchor="middle">Chapa</text>
<text x="670.4375610351561" y="231.7374928792317">id</text>
<rect class="shape-entity" x="294.4000040690104" y="40" width="219.99997965494785" height="102.4000040690104" />
<line x1="294.4000040690104" y1="66.39999643961588" x2="514.3999837239583" y2="66.39999643961588" stroke="#e5e7eb" stroke-width="1"/>
<text x="404.3999938964843" y="57.99999618530273" text-anchor="middle">Coche</text>
<text x="377.11248779296864" y="86.39999898274738">id</text>
<text x="377.11248779296864" y="110.39999898274738">matricula</text>
<path class="conn" d="M 237.0382853873625 189.65000915527338 L 317.36170850912174 142.4000040690104" marker-start="url(#arrow-start)" marker-end="url(#arrow-end)" />
<path class="conn" d="M 407.37171885678913 200.66250101725257 L 405.7899888758386 142.40000406901038" marker-start="url(#arrow-start)" marker-end="url(#arrow-end)" />
<path class="conn" d="M 594.8330757822941 185.33750915527338 L 507.97373913579827 142.4000040690104" marker-start="url(#arrow-start)" marker-end="url(#arrow-end)" />
</svg>
```

### diagrama

```
<svg xmlns="http://www.w3.org/2000/svg" width="626.8750381469724" height="394.2750024795531" viewBox="0 0 626.8750381469724 394.2750024795531">

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
        
<rect class="shape-entity" x="189.3750381469726" y="40" width="219.99999999999991" height="150.39999961853022" />
<line x1="189.3750381469726" y1="66.40000104904175" x2="409.37503814697254" y2="66.40000104904175" stroke="#e5e7eb" stroke-width="1"/>
<text x="299.37503814697254" y="57.99999976158142" text-anchor="middle">Persona</text>
<text x="273.2750167846679" y="86.40000247955321">id</text>
<text x="273.2750167846679" y="110.39999508857726">nombre</text>
<text x="273.2750167846679" y="134.39999485015866">apellidos</text>
<text x="273.2750167846679" y="158.3999910354614">dni-nie</text>
<rect class="shape-entity" x="40" y="251.87500476837153" width="220.00003814697257" height="102.39999771118161" />
<line x1="40" y1="278.2750225067138" x2="260.00003814697254" y2="278.2750225067138" stroke="#e5e7eb" stroke-width="1"/>
<text x="150.00001907348627" y="269.8750128746032" text-anchor="middle">Alumno</text>
<text x="139.3125381469726" y="298.27502155303944">id</text>
<text x="139.3125381469726" y="322.2750219106673">NIA</text>
<rect class="shape-entity" x="366.8750381469726" y="251.87500476837153" width="219.99999999999991" height="102.39999771118161" />
<line x1="366.8750381469726" y1="278.2750225067138" x2="586.8750381469725" y2="278.2750225067138" stroke="#e5e7eb" stroke-width="1"/>
<text x="476.87503814697254" y="269.8750128746032" text-anchor="middle">Profesor</text>
<text x="421.78751373291" y="298.27502155303944">id</text>
<text x="421.78751373291" y="322.2750219106673">correo_corporativo</text>
<path class="conn" d="M 239.58527805246655 190.39999961853022 L 190.7079400333157 251.8750047683715" marker-end="url(#arrow-end)" />
<path class="conn" d="M 370.422275379818 190.39999961853022 L 428.50245205334323 251.8750047683715" marker-end="url(#arrow-end)" />
</svg>
```

<a id="paso-del-diagrama-er-al-modelo-relacional"></a>
## Paso del diagrama ER al modelo relacional

La interpretación de diagramas Entidad-Relación (ER) es un proceso fundamental para el diseño de bases de datos relacionales. Este proceso permite convertir los conceptos abstractos representados en un diagrama ER en una estructura tabular concreta que pueda ser utilizada por sistemas de gestión de bases de datos.

El primer paso en este proceso consiste en la identificación y análisis de las entidades, sus atributos y las relaciones entre ellas. Cada entidad se representa como un rectángulo dividido en dos partes: el nombre de la entidad y una lista de sus atributos. Los atributos son los datos que caracterizan a cada instancia de la entidad.

Las relaciones, por otro lado, se representan como líneas que conectan las entidades, indicando cómo estas están relacionadas entre sí. Las relaciones pueden ser uno a uno, uno a muchos o muchos a muchos, y su cardinalidad (número de instancias) debe ser especificada para evitar ambigüedades.

El siguiente paso es la normalización del modelo relacional. La normalización es un proceso que busca eliminar las redundancias y las dependencias implícitas en el modelo, asegurando que cada tabla contenga solo datos relacionados entre sí y que no haya duplicidad de información.

La creación de tablas a partir del diagrama ER implica la definición de claves primarias y foráneas. Las claves primarias son los atributos únicos que identifican una instancia de una entidad, mientras que las claves foráneas se utilizan para establecer relaciones entre diferentes tablas.

Además, es importante considerar el tipo de datos adecuado para cada atributo en la tabla. Los tipos de datos deben ser seleccionados teniendo en cuenta la naturaleza del dato y cómo será utilizado en la base de datos.

El proceso de paso del diagrama ER al modelo relacional también implica la definición de restricciones semánticas, que aseguran que los datos ingresados en las tablas sean consistentes con el dominio de aplicación. Estas restricciones pueden incluir reglas de integridad referencial, valores nulos permitidos o no, y rangos de valores válidos.

Finalmente, es crucial realizar pruebas exhaustivas del modelo relacional para asegurar su correcto funcionamiento. Esto implica la creación de consultas SQL que recuperen los datos de manera coherente y verificarse que las relaciones entre tablas sean respetadas.

En conclusión, el paso del diagrama ER al modelo relacional es un proceso meticuloso pero fundamental para el diseño de bases de datos relacionales. A través de este proceso, se transforman los conceptos abstractos en una estructura tabular concreta que puede ser utilizada por sistemas de gestión de bases de datos, asegurando así la consistencia y eficiencia del almacenamiento y recuperación de información.

### El modelo relacional

```markdown
El modelo relacional es el que establece entidades, y las relaciones entre ellas

En bases de datos relacionales, se articula como

- Motor de bases de datos
  - Bases de datos
    - Tablas
      - Columnas
        - Filas o tuplas o registros

Las tablas pueden ir relacionadas entre si
PK para definir el identificador de la tabla
FK para relacionar unas tablas con otras con garantias de atomicidad

Como convertir el modelo ER en el modelo relacional
Cada entidad, se convertirá en una tabla
Cada propiedad, se convertirá en un campo

Y cada flecha, se convertirá en un Foreign Key (FK suele apuntar siempre a PK)
```

### Ejemplo tienda online

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
  width: 817.0250244140622px;
  height: 364.4375101725259px;
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

<div class="shape entity" style="left:40px;top:40.01249186197916px;width:219.99997965494785px;height:126.40000406901038px;">
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
  </div>
</div>
<div class="shape entity" style="left:294.3500162760416px;top:198.03750610351554px;width:220.0000406901041px;height:126.40000406901038px;">
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
      <div class="property-name">precio</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="shape entity" style="left:289.68749999999994px;top:40px;width:220.0000406901041px;height:126.40000406901038px;">
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
      <div class="property-name">cliente_id</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="shape entity" style="left:557.0250244140623px;top:98.68749999999997px;width:219.99999999999994px;height:174.40000406901038px;">
  <div class="entity-header">LineasPedido</div>
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
<div class="arrow" style="left:198.0874837239583px;top:83.75626504799169px;width:158.3192541290471px;transform:rotate(0.29018599833141073rad);"></div>
<div class="arrow" style="left:449.5750325520832px;top:85.23010972011733px;width:189.76541503267325px;transform:rotate(0.5614093769739965rad);"></div>
<div class="arrow" style="left:449.0625406901041px;top:239.7141575120908px;width:163.21856458957456px;transform:rotate(-0.1593772092056784rad);"></div>
</div>
</body>
</html>
```

### Ejemplo tienda online

```json
{
  "formas": [
    {
      "id": "forma-1",
      "tipo": "entity",
      "left": "34.0792px",
      "top": "135.625px",
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
        }
      ]
    },
    {
      "id": "forma-2",
      "tipo": "entity",
      "left": "288.433px",
      "top": "293.654px",
      "width": "",
      "height": "",
      "entityName": "Producto",
      "properties": [
        {
          "id": "prop-4",
          "name": "id"
        },
        {
          "id": "prop-5",
          "name": "nombre"
        },
        {
          "id": "prop-6",
          "name": "precio"
        }
      ]
    },
    {
      "id": "forma-3",
      "tipo": "entity",
      "left": "283.771px",
      "top": "135.621px",
      "width": "",
      "height": "",
      "entityName": "Pedido",
      "properties": [
        {
          "id": "prop-7",
          "name": "id"
        },
        {
          "id": "prop-8",
          "name": "fecha"
        },
        {
          "id": "prop-9",
          "name": "cliente_id"
        }
      ]
    },
    {
      "id": "forma-5",
      "tipo": "entity",
      "left": "551.104px",
      "top": "194.308px",
      "width": "",
      "height": "",
      "entityName": "LineasPedido",
      "properties": [
        {
          "id": "prop-14",
          "name": "id"
        },
        {
          "id": "prop-15",
          "name": "fecha"
        },
        {
          "id": "prop-16",
          "name": "pedido_id"
        },
        {
          "id": "prop-17",
          "name": "producto_id"
        },
        {
          "id": "prop-18",
          "name": "cantidad"
        }
      ]
    }
  ],
  "flechas": [
    {
      "desde": {
        "shapeId": "forma-1",
        "propId": "prop-1",
        "side": "right"
      },
      "hasta": {
        "shapeId": "forma-3",
        "propId": "prop-9",
        "side": "left"
      },
      "tipo": "simple",
      "estilo": "straight"
    },
    {
      "desde": {
        "shapeId": "forma-3",
        "propId": "prop-7",
        "side": "right"
      },
      "hasta": {
        "shapeId": "forma-5",
        "propId": "prop-16",
        "side": "left"
      },
      "tipo": "simple",
      "estilo": "straight"
    },
    {
      "desde": {
        "shapeId": "forma-2",
        "propId": "prop-4",
        "side": "right"
      },
      "hasta": {
        "shapeId": "forma-5",
        "propId": "prop-17",
        "side": "left"
      },
      "tipo": "simple",
      "estilo": "straight"
    }
  ]
}
```

### Ejemplo tienda online

```
<svg xmlns="http://www.w3.org/2000/svg" width="817.0250244140622" height="364.4375101725259" viewBox="0 0 817.0250244140622 364.4375101725259">

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
        
<rect class="shape-entity" x="40" y="40.01249186197916" width="219.99997965494785" height="126.40000406901038" />
<line x1="40" y1="66.41249847412108" x2="259.9999796549479" y2="66.41249847412108" stroke="#e5e7eb" stroke-width="1"/>
<text x="149.99998982747394" y="58.01249821980793" text-anchor="middle">Cliente</text>
<text x="123.89998372395831" y="86.41249593098956">id</text>
<text x="123.89998372395831" y="110.41249593098956">nombre</text>
<text x="123.89998372395831" y="134.4125061035156">apellidos</text>
<rect class="shape-entity" x="294.3500162760416" y="198.03750610351554" width="220.0000406901041" height="126.40000406901038" />
<line x1="294.3500162760416" y1="224.43750254313144" x2="514.3500569661456" y2="224.43750254313144" stroke="#e5e7eb" stroke-width="1"/>
<text x="404.35003662109364" y="216.0375022888183" text-anchor="middle">Producto</text>
<text x="381.6249999999999" y="244.4374898274739">id</text>
<text x="381.6249999999999" y="268.4374898274739">nombre</text>
<text x="381.6249999999999" y="292.437510172526">precio</text>
<rect class="shape-entity" x="289.68749999999994" y="40" width="220.0000406901041" height="126.40000406901038" />
<line x1="289.68749999999994" y1="66.39999643961586" x2="509.687540690104" y2="66.39999643961586" stroke="#e5e7eb" stroke-width="1"/>
<text x="399.687520345052" y="57.99999618530271" text-anchor="middle">Pedido</text>
<text x="371.7875162760416" y="86.39999389648435">id</text>
<text x="371.7875162760416" y="110.39999389648435">fecha</text>
<text x="371.7875162760416" y="134.39999389648435">cliente_id</text>
<rect class="shape-entity" x="557.0250244140623" y="98.68749999999997" width="219.99999999999994" height="174.40000406901038" />
<line x1="557.0250244140623" y1="125.0875066121419" x2="777.0250244140623" y2="125.0875066121419" stroke="#e5e7eb" stroke-width="1"/>
<text x="667.0250244140623" y="116.68750635782874" text-anchor="middle">LineasPedido</text>
<text x="632.2125244140623" y="145.08749389648435">id</text>
<text x="632.2125244140623" y="169.08749389648432">fecha</text>
<text x="632.2125244140623" y="193.08749389648435">pedido_id</text>
<text x="632.2125244140623" y="217.0874938964843">producto_id</text>
<text x="632.2125244140623" y="241.0874938964843">cantidad</text>
<path class="conn" d="M 198.0874837239583 83.75626504799169 L 349.7875162760416 129.05622477948222" marker-end="url(#arrow-end)" />
<path class="conn" d="M 449.5750325520832 85.23010972011733 L 610.2125244140623 186.25737807285137" marker-end="url(#arrow-end)" />
<path class="conn" d="M 449.0625406901041 239.7141575120908 L 610.2125244140623 213.8108262118674" marker-end="url(#arrow-end)" />
</svg>
```

### ejemplo tienda online convertido a SQL

```sql
-- Seleccionar base de datos (opcional)
-- CREATE DATABASE tienda;
-- USE tienda;

-- Tabla Cliente
CREATE TABLE Cliente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre    VARCHAR(100) NOT NULL,
    apellidos VARCHAR(150) NOT NULL
) ENGINE=InnoDB;

-- Tabla Producto
CREATE TABLE Producto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    precio DECIMAL(10,2) NOT NULL
) ENGINE=InnoDB;

-- Tabla Pedido
CREATE TABLE Pedido (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    cliente_id INT NOT NULL,
    CONSTRAINT fk_pedido_cliente
        FOREIGN KEY (cliente_id)
        REFERENCES Cliente(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB;

-- Tabla LineasPedido
CREATE TABLE LineasPedido (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    pedido_id   INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL,
    CONSTRAINT fk_linea_pedido
        FOREIGN KEY (pedido_id)
        REFERENCES Pedido(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT fk_linea_producto
        FOREIGN KEY (producto_id)
        REFERENCES Producto(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB;
```

### Ejemplo centro de formacion con relacion de n a n

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
  width: 580.6249346051897px;
  height: 378.11249869210377px;
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

<div class="shape entity" style="left:40.037493024553584px;top:211.7125047956194px;width:219.99999999999994px;height:126.39999389648435px;">
  <div class="entity-header">Asignatura</div>
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
  </div>
</div>
<div class="shape entity" style="left:40px;top:40px;width:219.99999999999994px;height:150.4000091552734px;">
  <div class="entity-header">Alumno</div>
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
  </div>
</div>
<div class="shape entity" style="left:320.62499999999994px;top:105.62498910086494px;width:219.99993460518968px;height:150.3999873570033px;">
  <div class="entity-header">Matricula</div>
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
      <div class="property-name">alumno_id</div>
      <div class="port port-right"></div>
    </div>
    <div class="entity-property">
      <div class="port port-left"></div>
      <div class="property-name">asignatura_id</div>
      <div class="port port-right"></div>
    </div>
  </div>
</div>
<div class="arrow" style="left:204.98746190752297px;top:253.22919475689145px;width:167.80459429011117px;transform:rotate(-0.1938217844790185rad);"></div>
<div class="arrow" style="left:198.08748109000067px;top:85.23177439821053px;width:202.70510380894262px;transform:rotate(0.5616736837541834rad);"></div>
</div>
</body>
</html>
```

### Ejemplo centro de formacion con relacion de n a n

```json
{
  "formas": [
    {
      "id": "forma-1",
      "tipo": "entity",
      "left": "216.375px",
      "top": "268.825px",
      "width": "",
      "height": "",
      "entityName": "Asignatura",
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
          "name": "descripcion"
        }
      ]
    },
    {
      "id": "forma-2",
      "tipo": "entity",
      "left": "216.338px",
      "top": "97.1125px",
      "width": "",
      "height": "",
      "entityName": "Alumno",
      "properties": [
        {
          "id": "prop-4",
          "name": "id"
        },
        {
          "id": "prop-5",
          "name": "nombre"
        },
        {
          "id": "prop-6",
          "name": "apellidos"
        },
        {
          "id": "prop-7",
          "name": "email"
        }
      ]
    },
    {
      "id": "forma-3",
      "tipo": "entity",
      "left": "496.963px",
      "top": "162.738px",
      "width": "",
      "height": "",
      "entityName": "Matricula",
      "properties": [
        {
          "id": "prop-8",
          "name": "id"
        },
        {
          "id": "prop-9",
          "name": "fecha"
        },
        {
          "id": "prop-10",
          "name": "alumno_id"
        },
        {
          "id": "prop-11",
          "name": "asignatura_id"
        }
      ]
    }
  ],
  "flechas": [
    {
      "desde": {
        "shapeId": "forma-1",
        "propId": "prop-1",
        "side": "right"
      },
      "hasta": {
        "shapeId": "forma-3",
        "propId": "prop-11",
        "side": "left"
      },
      "tipo": "simple",
      "estilo": "straight"
    },
    {
      "desde": {
        "shapeId": "forma-2",
        "propId": "prop-4",
        "side": "right"
      },
      "hasta": {
        "shapeId": "forma-3",
        "propId": "prop-10",
        "side": "left"
      },
      "tipo": "simple",
      "estilo": "straight"
    }
  ]
}
```

### Ejemplo centro de formacion con relacion de n a n

```
<svg xmlns="http://www.w3.org/2000/svg" width="580.6249346051897" height="378.11249869210377" viewBox="0 0 580.6249346051897 378.11249869210377">

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
        
<rect class="shape-entity" x="40.037493024553584" y="211.7125047956194" width="219.99999999999994" height="126.39999389648435" />
<line x1="40.037493024553584" y1="238.11247689383367" x2="260.03749302455356" y2="238.11247689383367" stroke="#e5e7eb" stroke-width="1"/>
<text x="150.03749302455356" y="229.7124873570033" text-anchor="middle">Asignatura</text>
<text x="117.0749947684152" y="258.1124943324497">id</text>
<text x="117.0749947684152" y="282.1124768938337">nombre</text>
<text x="117.0749947684152" y="306.11248125348766">descripcion</text>
<rect class="shape-entity" x="40" y="40" width="219.99999999999994" height="150.4000091552734" />
<line x1="40" y1="66.3999911717006" x2="259.99999999999994" y2="66.3999911717006" stroke="#e5e7eb" stroke-width="1"/>
<text x="149.99999999999997" y="57.99999209812709" text-anchor="middle">Alumno</text>
<text x="123.89998953683033" y="86.39999839237757">id</text>
<text x="123.89998953683033" y="110.40000683920724">nombre</text>
<text x="123.89998953683033" y="134.3999873570033">apellidos</text>
<text x="123.89998953683033" y="158.39999171665733">email</text>
<rect class="shape-entity" x="320.62499999999994" y="105.62498910086494" width="219.99993460518968" height="150.3999873570033" />
<line x1="320.62499999999994" y1="132.02499662126812" x2="540.6249346051897" y2="132.02499662126812" stroke="#e5e7eb" stroke-width="1"/>
<text x="430.62496730259477" y="123.62498937334333" text-anchor="middle">Matricula</text>
<text x="391.6499720982142" y="152.02500043596535">id</text>
<text x="391.6499720982142" y="176.0250047956194">fecha</text>
<text x="391.6499720982142" y="200.02498735700334">alumno_id</text>
<text x="391.6499720982142" y="224.0249828611101">asignatura_id</text>
<path class="conn" d="M 204.98746190752297 253.22919475689145 L 369.64996337890614 220.90826540676994" marker-end="url(#arrow-end)" />
<path class="conn" d="M 198.08748109000067 85.23177439821053 L 369.64996337890614 193.19322020671757" marker-end="url(#arrow-end)" />
</svg>
```

### caso centrode formacion en sql

```sql
-- Tabla Alumno
CREATE TABLE Alumno (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre     VARCHAR(100) NOT NULL,
    apellidos  VARCHAR(150) NOT NULL,
    email      VARCHAR(150) NOT NULL
) ENGINE=InnoDB;

-- Tabla Asignatura
CREATE TABLE Asignatura (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre       VARCHAR(150) NOT NULL,
    descripcion  TEXT
) ENGINE=InnoDB;

-- Tabla Matricula
CREATE TABLE Matricula (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    alumno_id INT NOT NULL,
    asignatura_id INT NOT NULL,

    CONSTRAINT fk_matricula_alumno
        FOREIGN KEY (alumno_id)
        REFERENCES Alumno(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,

    CONSTRAINT fk_matricula_asignatura
        FOREIGN KEY (asignatura_id)
        REFERENCES Asignatura(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB;
```

<a id="restricciones-semanticas-del-modelo-relacional"></a>
## Restricciones semánticas del modelo relacional

En el mundo de la programación y la gestión de datos, los diagramas de entidad-relación (ER) son una herramienta fundamental para representar las relaciones entre diferentes entidades. Estos gráficos proporcionan una visión visual de cómo se organizan los datos en un sistema, facilitando su comprensión y diseño.

La interpretación de estos diagramas implica no solo entender la estructura básica, sino también considerar las restricciones semánticas del modelo relacional. Las restricciones semánticas son reglas que aseguran la consistencia y coherencia de los datos en el sistema. Estas restricciones pueden ser implícitas o explícitas y afectan directamente cómo se modelan y gestionan las relaciones entre entidades.

En primer lugar, es crucial entender que las restricciones semánticas del modelo relacional impiden la creación de estados inconsistentes dentro del sistema. Por ejemplo, si tenemos una entidad "Alumno" con una relación con otra entidad "Materia", no podemos tener un registro de un alumno inscrito en una materia que no existe o que ha sido eliminada.

Además, las restricciones semánticas también pueden influir en la forma en que se definen las claves primarias y foráneas. Una clave primaria es un identificador único para cada fila en una tabla, mientras que una clave foránea es un valor que hace referencia a la clave primaria de otra tabla. Las restricciones semánticas pueden exigir que las claves foráneas siempre apunten a valores válidos dentro de la tabla referenciada.

La interpretación de diagramas ER también requiere considerar las cardinalidades, que indican cuántos registros de una entidad pueden estar asociados con un registro de otra entidad. Por ejemplo, si tenemos una relación "Profesor-Materia", donde cada profesor puede enseñar varias materias y cada materia puede ser enseñada por varios profesores, la cardinalidad sería 1:N (uno a muchos).

Las restricciones semánticas también pueden afectar la forma en que se manejan las relaciones de tipo many-to-many. En estos casos, es común crear una tabla intermedia para gestionar las relaciones entre las entidades involucradas. Las restricciones semánticas pueden exigir que esta tabla tenga claves foráneas que apunten a ambas entidades y que no permitan duplicados.

La interpretación de diagramas ER también implica considerar la normalización, que es el proceso de eliminar redundancias y dependencias implícitas en las tablas. Las restricciones semánticas pueden influir en cómo se normalizan las tablas, ya que algunas restricciones pueden requerir una mayor normalización para garantizar la consistencia de los datos.

En conclusión, la interpretación de diagramas ER es un proceso complejo que requiere una comprensión profunda del modelo relacional y sus restricciones semánticas. Al entender estas restricciones, podemos diseñar sistemas de gestión de datos más robustos y consistentes, lo que facilita su mantenimiento y evolución a lo largo del tiempo.

<a id="normalizacion-de-modelos-relacionales"></a>
## Normalización de modelos relacionales

La normalización de modelos relacionales es una técnica fundamental para garantizar la integridad y eficiencia de las bases de datos. Este proceso implica la eliminación de redundancias y dependencias no funcionales en los diagramas de entidad-relación, transformándolos en estructuras optimizadas que facilitan el acceso y manipulación de los datos.

El objetivo principal de la normalización es evitar problemas como la inconsistencia de datos, la redundancia innecesaria y las dificultades en la actualización. A través del proceso de normalización, se aplican reglas sistemáticas para dividir un modelo relacional complejo en subconjuntos más simples e independientes.

La primera etapa del proceso de normalización es el primer nivel de normalización (1NF), que requiere que cada tabla tenga una estructura básica: cada columna debe contener valores únicos y no nulos, y cada fila debe ser única. Este nivel asegura la integridad de los datos básicos.

El segundo nivel de normalización (2NF) se centra en eliminar dependencias parciales, garantizando que ninguna columna sea funcionalmente dependiente solo de una parte de la clave primaria. Esto implica que cada columna debe estar directamente relacionada con toda la clave primaria y no con partes individuales.

El tercer nivel de normalización (3NF) busca eliminar dependencias transitivas, asegurando que ninguna columna esté funcionalmente dependiente de otras columnas no claves. Este nivel es crucial para evitar inconsistencias y redundancias innecesarias en los datos.

Además de estos tres niveles básicos, existen niveles superiores como la 4NF (normalización de Boyce-Codd) y la 5NF (normalización de Fourth Normal Form), que abordan problemas más complejos relacionados con dependencias funcionales transitivas y dependencias no funcionales.

La normalización no solo mejora la estructura interna de las bases de datos, sino que también facilita su mantenimiento y escalabilidad. Al eliminar redundancias y dependencias innecesarias, se reduce el riesgo de errores y la complejidad del sistema.

Además, la normalización contribuye a la eficiencia en términos de rendimiento. Bases de datos bien normalizadas tienden a ser más rápidas al realizar consultas y actualizaciones, ya que cada tabla contiene solo los datos esenciales y están relacionados de manera coherente.

En resumen, la normalización de modelos relacionales es una práctica esencial en el diseño de bases de datos. A través del proceso de normalización, se eliminan redundancias y dependencias no funcionales, lo que resulta en estructuras de datos más eficientes, fáciles de mantener y menos propensas a errores. Este proceso es fundamental para garantizar la integridad y consistencia de los datos almacenados en las bases de datos relacionales.

### Normalización en bases de datos

```markdown
Son conjuntos de reglas
"Recetas"
Para sanear las bases de datos
y que tengan una forma que sea luego escalable y mantenible

Son recetas generales, luego caso a caso se puede justificar saltarse las reglas de normalización

Pero son una serie de preguntas que debemos hacernos y una serie de acciones que debemos tomar para que nuestras bases de datos se puedan mantener y ampliar con el tiempo
```

### terminologia aplicada

```markdown
Origen:
https://es.wikipedia.org/wiki/Normalizaci%C3%B3n_de_bases_de_datos

Terminología equivalente

Figura 1.0: Trabajo (Código, Nombre, Posición, Salario), donde Código es la Clave Primaria.
Entidad = tabla
Registro = fila o tupla
Atributo = columna
Clave = llave o código de identificación
Clave Candidata = superclave mínima
Clave Primaria = clave candidata elegida
Clave Externa = clave ajena o clave foránea
Clave Alternativa = clave secundaria
Dependencia Multivaluada = dependencia multivalor = dependencia múltiple
RDBMS = Del inglés Relational Data Base Management System, que significa Sistema de gestión de bases de datos relacionales.
1FN = Significa Primera Forma Normal o 1NF, del inglés First Normal Form.
```

### Primera forma normal

```markdown
Primera Forma Normal (1FN)
Artículo principal: Primera forma normal
Una tabla está en primera forma si:

Todos los atributos son atómicos. Un atributo es atómico si los elementos del dominio son simples e indivisibles.
No debe existir variación en el número de columnas.
Los campos no clave deben identificarse por la clave (dependencia funcional).
Debe existir una independencia del orden tanto de las filas como de las columnas; es decir, si los datos cambian de orden no deben cambiar sus significados.
Esta forma normal elimina los valores repetidos dentro de una base de datos.
```

### segunda forma normal

```markdown
Segunda Forma Normal (2FN)
Artículo principal: Segunda forma normal
Dependencia funcional. Una relación está en 2FN si está en 1FN y si los atributos que no forman parte de ninguna clave dependen de forma completa de la clave principal. Es decir, que no existen dependencias parciales. Todos los atributos que no son clave principal deben depender únicamente de la clave principal.

En otras palabras, podríamos decir que la segunda forma normal está basada en el concepto de dependencia completamente funcional. Una dependencia funcional 
x
→
y
{\displaystyle x\rightarrow y} es completamente funcional si al eliminar los atributos A de X significa que la dependencia no es mantenida, esto es que 
A
∈
X
,
X
−
{
A
}
↛
Y
{\displaystyle A\in X,X-\{A\}\nrightarrow Y}. Una dependencia funcional 
x
→
y
{\displaystyle x\rightarrow y} es una dependencia parcial si hay algunos atributos 
A
∈
X
{\displaystyle A\in X} que pueden ser eliminados de X y la dependencia todavía se mantiene, esto es 
A
∈
X
,
X
−
{
A
}
→
Y
{\displaystyle A\in X,X-\{A\}\rightarrow Y}.

Por ejemplo {DNI, ID_PROYECTO} 
→
{\displaystyle \rightarrow } HORAS_TRABAJO (con el DNI de un empleado y el ID de un proyecto sabemos cuántas horas de trabajo por semana trabaja un empleado en dicho proyecto) es completamente funcional dado que ni DNI 
→
{\displaystyle \rightarrow } HORAS_TRABAJO ni ID_PROYECTO 
→
{\displaystyle \rightarrow } HORAS_TRABAJO mantienen la dependencia. Sin embargo {DNI, ID_PROYECTO} 
→
{\displaystyle \rightarrow } NOMBRE_EMPLEADO es parcialmente dependiente dado que DNI 
→
{\displaystyle \rightarrow } NOMBRE_EMPLEADO mantiene la dependencia.
```

### Tercera forma normal

```markdown
Tercera Forma Normal (3FN)
Artículo principal: Tercera forma normal
La 3NF fue definida originalmente por E.F. Codd.[2]​ La tabla se encuentra en 3FN si es 2FN y si no existe ninguna dependencia funcional transitiva en los atributos que no son clave.

Un ejemplo de este concepto sería que, una dependencia funcional X 
→
{\displaystyle \rightarrow } Y en un esquema de relación R es una dependencia transitiva si hay un conjunto de atributos Z que no es un subconjunto de alguna clave de R, donde se mantiene X 
→
{\displaystyle \rightarrow } Z y Z 
→
{\displaystyle \rightarrow } Y.

Por ejemplo, la dependencia SSN 
→
{\displaystyle \rightarrow } DMGRSSN es una dependencia transitiva en EMP_DEPT de la siguiente figura. Decimos que la dependencia de DMGRSSN el atributo clave SSN es transitiva vía DNUMBER porque las dependencias SSN→DNUMBER y DNUMBER→DMGRSSN son mantenidas, y DNUMBER no es un subconjunto de la clave de EMP_DEPT. Intuitivamente, podemos ver que la dependencia de DMGRSSN sobre DNUMBER es indeseable en EMP_DEPT dado que DNUMBER no es una clave de EMP_DEPT.

Formalmente, un esquema de relación 
R
{\displaystyle R} está en 3 Forma Normal Elmasri-Navâthe,[3]​ si para toda dependencia funcional 
X
→
A
{\displaystyle X\rightarrow A}, se cumple al menos una de las siguientes condiciones:

X
{\displaystyle X} es superllave o clave.
A
{\displaystyle A} es atributo primo de 
R
{\displaystyle R}; esto es, si es miembro de alguna clave en 
R
{\displaystyle R}.
Además el esquema debe cumplir necesariamente, con las condiciones de segunda forma normal.
```

<a id="ejercicios"></a>
## Ejercicios

<a id="criterios-de-evaluacion"></a>
## Criterios de evaluación


<a id="uso-de-bases-de-datos-no-relacionales"></a>
# Uso de bases de datos no relacionales

<a id="caracteristicas-de-las-bases-de-datos-no-relacionales"></a>
## Características de las bases de datos no relacionales

Las bases de datos no relacionales son una alternativa a las tradicionales basadas en relaciones que han ganado popularidad en los últimos años. Estas bases de datos se caracterizan por su capacidad para manejar y almacenar tipos de datos complejos y heterogéneos, ofreciendo un alto nivel de escalabilidad y flexibilidad.

La principal ventaja de las bases de datos no relacionales radica en su diseño flexible, que permite representar y almacenar datos de manera más natural y eficiente. A diferencia de las bases de datos relacionales, que utilizan una estructura tabular con filas y columnas, las bases de datos no relacionales pueden organizar los datos en documentos, grafos o columnas, lo que les hace ideales para aplicaciones que requieren un alto nivel de personalización y adaptabilidad.

Un ejemplo destacado de la flexibilidad de las bases de datos no relacionales es su capacidad para manejar datos JSON. Este formato de datos es ampliamente utilizado en el mundo web debido a su simplicidad y facilidad de uso, lo que permite a las bases de datos no relacionales almacenar y recuperar información de manera eficiente.

Además, las bases de datos no relacionales son conocidas por su alta escalabilidad horizontal. Esto significa que pueden manejar grandes volúmenes de datos distribuidos en múltiples servidores, lo que les hace ideales para aplicaciones web y móviles con un alto nivel de tráfico.

Otra ventaja importante de las bases de datos no relacionales es su capacidad para manejar transacciones complejas. A diferencia de las bases de datos relacionales, que utilizan un modelo ACID (Atomicidad, Consistencia, Isolación, Durabilidad), las bases de datos no relacionales pueden utilizar diferentes modelos de consistencia y atomicidad, lo que les permite optimizar el rendimiento en aplicaciones con altos niveles de concurrencia.

Sin embargo, es importante tener en cuenta que las bases de datos no relacionales también tienen sus desventajas. A diferencia de las bases de datos relacionales, que ofrecen una alta consistencia y confiabilidad, las bases de datos no relacionales pueden experimentar inconsistencias temporales o incluso perdida de datos en casos de fallos.

En resumen, las bases de datos no relacionales son una alternativa poderosa a las tradicionales basadas en relaciones. Su capacidad para manejar y almacenar datos de manera flexible y eficiente, su alta escalabilidad horizontal y su capacidad para manejar transacciones complejas hacen que sean ideales para aplicaciones web y móviles con un alto nivel de tráfico y personalización. Sin embargo, es importante tener en cuenta sus desventajas y elegir el tipo de base de datos adecuada según las necesidades específicas del proyecto.

<a id="tipos-de-bases-de-datos-no-relacionales"></a>
## Tipos de bases de datos no relacionales

Las bases de datos no relacionales representan una innovadora forma de almacenar y gestionar información que se distingue por su capacidad para manejar datos complejos y heterogéneos. En este submódulo, exploraremos los diversos tipos de bases de datos no relacionales, cada uno con sus propias características y aplicaciones específicas.

El primer tipo que destacamos son las bases de datos orientadas a documentos, como MongoDB o Couchbase. Estas bases almacenan datos en formato JSON, lo que les permite representar estructuras complejas de manera natural y eficiente. La ventaja principal es su escalabilidad horizontal, ya que se pueden distribuir los datos entre múltiples servidores sin necesidad de un diseño riguroso de tablas.

A continuación, nos encontramos con las bases de datos orientadas a columnas, como Apache Cassandra o Google Bigtable. Estas bases son ideales para aplicaciones que requieren altos niveles de rendimiento y consistencia en consultas de lectura y escritura. La estructura de columnas permite una optimización del almacenamiento y la recuperación de datos, lo que es crucial en entornos con alta carga.

Las bases de datos orientadas a gráficas, como Neo4j o Amazon Neptune, son perfectas para manejar relaciones complejas entre los datos. En lugar de tablas relacionales, estas bases almacenan nodos y relaciones, lo que facilita el modelado de datos en forma natural y permite realizar consultas eficientes sobre las relaciones entre ellos.

Además, existen las bases de datos orientadas a columnas con almacenamiento distribuido, como HBase o Amazon DynamoDB. Estas combinan la escalabilidad horizontal de las bases de datos no relacionales con el rendimiento de las bases de datos orientadas a columnas, lo que las hace ideales para aplicaciones que requieren altos niveles de consistencia y rendimiento.

Las bases de datos orientadas a objetos, como OrientDB o ArangoDB, almacenan los datos en formato objeto, lo que facilita la persistencia y recuperación de objetos complejos. Esta estructura permite una representación natural de las relaciones entre los objetos y es especialmente útil para aplicaciones basadas en modelos orientados a objetos.

Finalmente, las bases de datos vectoriales, como Milvus o Faiss, son optimizadas para manejar datos de alta dimensionalidad, como imágenes y texto. Estas bases utilizan técnicas de indexación eficiente para realizar búsquedas rápidas en conjuntos de datos grandes.

Cada uno de estos tipos de bases de datos no relacionales tiene sus propias fortalezas y debilidades, lo que las hace adecuadas para diferentes escenarios y aplicaciones. La elección del tipo de base de datos no relacional depende de factores como el tamaño del conjunto de datos, la naturaleza de las relaciones entre los datos, los patrones de acceso a los datos y las necesidades específicas del negocio.

Al explorar estos tipos de bases de datos no relacionales, es importante entender cómo cada uno aborda los desafíos típicos asociados con el almacenamiento y gestión de grandes volúmenes de datos. Cada tipo tiene sus propias ventajas y limitaciones, lo que permite a los desarrolladores elegir la solución más adecuada para su proyecto.

En resumen, las bases de datos no relacionales ofrecen una gama diversa de opciones para almacenar y gestionar información compleja y heterogénea. Cada tipo tiene sus propias características y aplicaciones específicas, lo que permite a los desarrolladores elegir la solución más adecuada para su proyecto. Al comprender las ventajas y limitaciones de cada tipo, es posible aprovechar al máximo las capacidades de estas bases de datos para mejorar el rendimiento y escalabilidad de las aplicaciones.

<a id="elementos-de-las-bases-de-datos-no-relacionales"></a>
## Elementos de las bases de datos no relacionales

En el vasto mundo de la informática, las bases de datos desempeñan un papel crucial en almacenar, gestionar y recuperar información. Mientras que las bases de datos relacionales han sido dominantes durante décadas, los sistemas no relacionales han emergido como una alternativa valiosa para ciertos tipos de aplicaciones. En esta subunidad didáctica, exploraremos los elementos fundamentales de las bases de datos no relacionales, abordando sus características distintivas y cómo se utilizan en la práctica.

Las bases de datos no relacionales son un tipo de sistema que almacena y gestiona datos sin seguir el modelo relacional convencional. En lugar de organizar los datos en tablas con filas y columnas, estas bases de datos permiten una estructura más flexible y escalable. Los elementos clave de las bases de datos no relacionales incluyen documentos, grafos y columnas.

Los documentos son uno de los tipos más comunes de bases de datos no relacionales. En este tipo de sistema, los datos se almacenan en formato JSON o BSON, lo que permite una representación flexible y jerárquica de la información. Cada documento es independiente y puede tener un esquema diferente, lo que facilita el almacenamiento de datos complejos y heterogéneos.

Los grafos son otro tipo popular de bases de datos no relacionales. En este modelo, los datos se representan como nodos (vértices) y aristas (edges), lo que permite una representación natural de relaciones entre entidades. Los grafos son ideales para aplicaciones que requieren consultas complejas sobre relaciones entre objetos.

Las bases de datos columnares también son un elemento importante en el ecosistema de las bases de datos no relacionales. En este tipo de sistema, los datos se almacenan en columnas, lo que permite una optimización de la lectura y escritura de datos según el patrón de acceso. Las columnas pueden estar distribuidas en diferentes servidores para mejorar la escalabilidad.

Además de estos tipos básicos, las bases de datos no relacionales también incluyen elementos como los sistemas de almacenamiento de clave-valor, que almacenan pares de claves y valores sin estructura adicional. Estos sistemas son ideales para aplicaciones que requieren alta velocidad de acceso a datos.

La elección del tipo de base de datos no relacional depende de las necesidades específicas de la aplicación. Los documentos son una buena opción cuando se necesita almacenar datos complejos y heterogéneos, mientras que los grafos son útiles para aplicaciones que requieren consultas complejas sobre relaciones entre objetos. Las columnares son ideales para aplicaciones que requieren alta velocidad de acceso a datos según un patrón específico.

Las bases de datos no relacionales también presentan desafíos en términos de consistencia y escalabilidad. A diferencia de las bases de datos relacionales, los sistemas no relacionales pueden no garantizar la consistencia ACID (Atomicidad, Coherencia, Isolación, Durabilidad) en todas las operaciones. Sin embargo, esto puede ser compensado con una mayor escalabilidad y flexibilidad.

En conclusión, las bases de datos no relacionales representan un paradigma alternativo a los sistemas tradicionales de bases de datos relacionales. Aunque presentan desafíos en términos de consistencia y escalabilidad, ofrecen una flexibilidad y eficiencia que pueden ser beneficiosas para ciertos tipos de aplicaciones. En esta subunidad didáctica, hemos explorado los elementos clave de las bases de datos no relacionales, abordando sus características distintivas y cómo se utilizan en la práctica. A medida que avanzamos en el estudio de estas tecnologías, es importante entender cómo seleccionar y utilizar adecuadamente las bases de datos no relacionales para optimizar el rendimiento y la eficiencia de nuestras aplicaciones.

<a id="sistemas-gestores-de-bases-de-datos-no-relacionales"></a>
## Sistemas gestores de bases de datos no relacionales

En el vasto universo de la informática, las bases de datos desempeñan un papel crucial como almacenes de información. Aunque los sistemas de gestión de bases de datos relacionales han sido dominantes durante décadas, recientemente se ha abierto una nueva frontera con las bases de datos no relacionales. Este cambio refleja la evolución del manejo y almacenamiento de grandes volúmenes de datos complejos.

Las bases de datos no relacionales son sistemas que almacenan y gestionan datos sin necesidad de cumplir con los modelos relacionales tradicionales. Estos sistemas ofrecen una flexibilidad y escalabilidad significativas, adaptándose a las necesidades cambiantes del mundo digital actual. Algunas de las principales ventajas de estas bases de datos incluyen la capacidad para manejar datos semi-estructurados o no estructurados, la alta disponibilidad y el rendimiento optimizado.

En esta subunidad didáctica, nos adentramos en los sistemas gestores de bases de datos no relacionales. Comenzamos explorando las características distintivas que los diferencian del modelo relacional. Aprenderemos sobre los tipos diferentes de bases de datos no relacionales, como las bases de datos orientadas a documentos, columnares, clave-valor y gráficas.

Además, nos familiarizaremos con los elementos básicos de estos sistemas, desde la estructura de sus datos hasta las operaciones que se pueden realizar. Estudiaremos cómo crear, modificar y consultar información en estas bases de datos, así como cómo optimizar su rendimiento para manejar grandes volúmenes de datos.

Es importante destacar que cada tipo de base de datos no relacional tiene sus propias ventajas y desventajas. Por lo tanto, la elección del sistema gestor adecuado depende de las necesidades específicas del proyecto, como el tamaño del conjunto de datos, los tipos de consultas requeridas y la escalabilidad deseada.

A medida que avanzamos en este estudio, nos encontraremos con herramientas y tecnologías específicas diseñadas para facilitar el trabajo con bases de datos no relacionales. Estas herramientas pueden incluir interfaces gráficas, bibliotecas de programación y sistemas de gestión de versiones, entre otros.

Finalmente, reflexionaremos sobre las implicaciones prácticas de utilizar bases de datos no relacionales en proyectos reales. Aprenderemos cómo implementar estas tecnologías en entornos de desarrollo modernos y cómo realizar pruebas y mantenimiento efectivos para asegurar la integridad y seguridad de los datos.

En resumen, este estudio nos proporciona una comprensión profunda de las bases de datos no relacionales y sus sistemas gestores. A través de un enfoque práctico y detallado, adquiriremos habilidades valiosas para trabajar con estos sistemas en proyectos futuros, preparándonos para enfrentar los desafíos del mundo digital actual.

<a id="herramientas-de-los-sistemas-gestores-de-bases-de-datos-no-relacionales-para-la-gestion-de-la-informacion-almacenada"></a>
## Herramientas de los sistemas gestores de bases de datos no relacionales para la gestión de la información almacenada

En el mundo digital actual, la gestión de grandes volúmenes de datos ha convertido en una tarea esencial para cualquier organización. A diferencia de las bases de datos relacionales tradicionales, que siguen un modelo tabular estricto, las bases de datos no relacionales han surgido como una solución más flexible y escalable para almacenar y gestionar información compleja.

Estas bases de datos no relacionales se caracterizan por su capacidad para manejar diferentes tipos de datos estructurados y semi-estructurados, lo que les permite adaptarse a las necesidades cambiantes del negocio. Algunos ejemplos populares incluyen MongoDB, Cassandra y Couchbase.

La gestión de la información en estos sistemas no relacionales requiere herramientas específicas que permitan optimizar el acceso, la consulta y la modificación de los datos. Estas herramientas son fundamentales para aprovechar al máximo las capacidades de estas bases de datos y asegurar su eficiencia operativa.

Una de las principales herramientas utilizadas en sistemas gestores de bases de datos no relacionales es MongoDB Compass. Este software ofrece una interfaz gráfica intuitiva que facilita la exploración, el análisis y la gestión de los datos almacenados. Con MongoDB Compass, los usuarios pueden crear vistas personalizadas, realizar búsquedas complejas y visualizar los datos de manera interactiva.

Otra herramienta es Apache Cassandra Query Language (CQL), un lenguaje de consulta diseñado para trabajar con bases de datos distribuidas. CQL permite a los desarrolladores escribir consultas eficientes y escalables, incluso en entornos donde los datos están fragmentados entre múltiples nodos.

Además, herramientas como Apache Solr y Elasticsearch son excelentes opciones para el almacenamiento y búsqueda de grandes conjuntos de datos no estructurados. Estas plataformas ofrecen funcionalidades avanzadas de indexación y recuperación que permiten realizar búsquedas rápidas y precisas sobre los datos.

La gestión de la información en bases de datos no relacionales también implica la implementación de políticas de seguridad robustas. Herramientas como Apache Shiro o Spring Security pueden ser utilizadas para controlar el acceso a los datos, asegurando que solo los usuarios autorizados puedan realizar operaciones sobre ellos.

En conclusión, las herramientas disponibles para gestionar bases de datos no relacionales son esenciales para aprovechar al máximo la flexibilidad y escalabilidad de estos sistemas. Desde interfaces gráficas intuitivas hasta lenguajes de consulta avanzados, estas herramientas ofrecen una gama completa de opciones que permiten a los desarrolladores optimizar el acceso y la manipulación de los datos en entornos empresariales modernos.


<a id="actividad-libre-de-final-de-evaluacion-la-milla-extra"></a>
# Actividad libre de final de evaluación - La milla extra

<a id="la-milla-extra-primera-evaluacion"></a>
## La Milla Extra - Primera evaluación

### ejercicio

```markdown

```
