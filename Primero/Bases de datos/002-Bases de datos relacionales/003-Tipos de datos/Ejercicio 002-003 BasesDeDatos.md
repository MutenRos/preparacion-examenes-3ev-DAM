Contexto
En nuestra actualidad digital, el manejo eficiente de datos es crucial para cualquier organización o proyecto de tecnología. Uno de los aspectos fundamentales en esta gestión es entender y utilizar adecuadamente los tipos de datos en una base de datos relacional. Este conocimiento nos permite almacenar información precisa y optimizar la eficiencia de nuestras aplicaciones.

Enunciado paso a paso
Definición de tipos de datos:

Identifica y explica los 4 tipos básicos de datos mencionados en el material de clase: INT, VARCHAR, TEXT, y DATE.
Ejemplo práctico con Raspberrys:

Imagina que tienes un proyecto de control de temperatura utilizando un Raspberry Pi. Necesitas almacenar la temperatura medida cada 5 minutos. ¿Qué tipo de dato sería el más adecuado para este caso? Justifica tu respuesta.
Aplicación del tipo VARCHAR:

Para almacenar información sobre los usuarios de tu proyecto, necesitas registrar sus nombres completos. ¿Cuál sería el tipo de dato más apropiado y por qué?
Uso del tipo TEXT:

En un sistema de gestión de proyectos, necesitas almacenar descripciones detalladas de las tareas. ¿Qué tipo de dato se recomienda para este caso? Explana tu elección.
Aplicación del tipo DATE:

Para una aplicación de seguimiento de citas médicas, necesitas registrar la fecha de cada cita programada. ¿Cuál sería el tipo de dato ideal y por qué?
Restricciones
Solo puedes utilizar los tipos de datos mencionados en el material de clase.
No utilices conceptos que no se hayan presentado en el curso.
Criterios de evaluación
Introducción y contextualización (25%): El estudiante debe mostrar una comprensión adecuada del contexto y la relevancia de los tipos de datos en la gestión de bases de datos.
Desarrollo técnico correcto y preciso (25%): El estudiante debe identificar correctamente los tipos de datos y justificar sus elecciones con base en el contexto del proyecto.
Aplicación práctica con ejemplo claro (25%): El estudiante debe proporcionar ejemplos prácticos aplicando los tipos de datos a situaciones reales, como el control de temperatura o la gestión de citas médicas.
Cierre/Conclusión enlazando con la unidad (25%): El estudiante debe relacionar su comprensión del tema con las habilidades y conocimientos adquiridos en la asignatura.


Para tener una base de datos relacional, completa y funcional, es fundamental que todos los campos de nuestras tablas contengan datos, y no solo eso, el tipo de dato apropiado que se demanda. Es por eso, que en formularios "publicos" nos da error cuando intentamos escribir una letra en el campo `edad`, por ejemplo, o n o nos deja incluir nombres en nuestro nombre.

Eso ocurre por que cada campo espera un `tipo de dato` concreto, y si no es asi, nos dara error.
los tipos de datos mas comunmente utilizados son:
- INT: para numeros enteros, como por ejemplo la edad, o la cantidad de productos en stock.
- VARCHAR: para cadenas de texto cortas, como nombres, apellidos, direcciones de email, etc.
- TEXT: para cadenas de texto largas, como descripciones de productos, comentarios, etc.   
- DATE: para fechas, como fechas de nacimiento, fechas de pedidos, etc.

Por ejemplo, para un control de temperatura de una raspberry pi, nuestros campos a rellenar podrian ser:
-DATE: para la fecha y hora de la medicion
-INT: para la temperatura medida en grados centigrados 
-TEXT: para una descripcion de de la anomalia en caso de suceder.

Para almacenar los nombres completos de nuestros usuarios, seguramente queramos usar varios campos `VARCHAR`, uno para el nombre, otro para los apellidos, y otro por si tuviera segundo nombre.

En la base de datos de mi trabajo, cada producto tiene un campo de observaciones, en el que nos vamos dejando notassobre el estado del producto, su llegada prevista, el nivel de urgencia etc, y no tengo ni pruebas ni dudas que es un campo tipo `TEXT`, ya que puede contener mucha informacion.

Y por ultimo, para una aplicacion de seguimiento de citas medicas, el campo de fecha de la cita, obviamente sera un campo tipo `DATE`, ya que solo puede contener fechas, acompañado de los campos necesarios del paciente en cuestion y un telefono de contacto, que nos dejaria tambien con los campos `VARCHAR` y `INT` necesarios.

En funcion del tipo de dato esperado o requerido, el sistema de gestion de bases de datos nos permitira o no introducir datos erroneos, y eso es fundamental para mantener la integridad de los datos en nuestra base de datos.
