En tu laboratorio de modelado e impresión 3D, has estado trabajando en un proyecto para diseñar una caja para almacenar tus miniaturas de coches de carreras del siglo pasado. Para organizar eficientemente estas miniaturas, has decidido implementar un sistema digital utilizando Raspberrys y bases de datos relacionales.

Para esta actividad, necesitas entender cómo funciona la clave primaria en una base de datos relacional, lo que te permitirá identificar de manera única cada miniatura en tu caja. A continuación, se te proporcionan los ejemplos que hemos visto en clase para modificar las tablas de productos y clientes.

Enunciado paso a paso
Identificación del concepto clave primaria:

Una clave primaria es un número único e irrepetible que identifica inequívocamente a un registro en una tabla.
Modificación de la tabla productos para agregar una clave primaria:

Abre el archivo SQL proporcionado (003-altero tabla de productos.sql) y ejecuta las siguientes instrucciones:
ALTER TABLE `empresarial`.`productos`
  ADD PRIMARY KEY (`Identificador`);
  
  ALTER TABLE productos
  MODIFY COLUMN Identificador INT NOT NULL AUTO_INCREMENT;
Esta operación añade la columna Identificador como clave primaria y asegura que sea numérica, autoincremental y no nula.
Aplicación práctica con ejemplo claro:

Considera una tabla llamada miniaturas_coches en tu base de datos para almacenar información sobre tus miniaturas.
Añade la columna Identificador como clave primaria a esta tabla utilizando un comando similar al proporcionado.
Restricciones
No utilices librerías externas ni funciones que no estén vistas en clase.
Mantén el alcance estricto del tema actual, es decir, solo utiliza conocimientos y herramientas aprendidos hasta ahora.
Criterios de evaluación
Introducción y contextualización (25%): Explica cómo la clave primaria se relaciona con tu proyecto de miniaturas de coches y cómo esta actividad te ayudará a organizar tus datos.
Desarrollo técnico correcto y preciso (25%): Muestra el código SQL que has ejecutado para modificar la tabla miniaturas_coches y asegúrate de que comprendas los conceptos detrás de cada comando.
Aplicación práctica con ejemplo claro (25%): Proporciona un ejemplo práctico de cómo podrías utilizar esta clave primaria en tu proyecto, por ejemplo, para identificar y recuperar una miniatura específica.
Cierre/Conclusión enlazando con la unidad (25%): Reflexiona sobre cómo este concepto te será útil en el futuro y cómo puedes aplicarlo a otros proyectos similares que involucren bases de datos relacionales.




Si nuestro negocio va bien y empezamos a ampliar nuestro catalogo de miniaturas, encontrarlas rapida y facilmente en nuestra base de datos. Para ello, usaremos una `clave primaria`, que es un numero unico e irrepetible que identifica inequívocamente a un registro en una tabla. Tambien podemos conocer este termino como `id` o `ref`.
Para añadir una clave primaria a nuestra tabla de miniaturas de coches, usaremos el siguiente comando SQL:

```sql  
ALTER TABLE miniaturas_coches
  ADD PRIMARY KEY (id);