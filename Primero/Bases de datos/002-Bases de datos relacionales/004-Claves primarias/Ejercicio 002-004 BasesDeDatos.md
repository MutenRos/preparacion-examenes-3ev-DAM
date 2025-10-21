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





Si nuestro negocio va bien, nuestro nventario de miniaturas crecera, y se hara mas complicado y tedioso buscar miniaturas en nuestra base de datos. Esto podemos solucionarlo con una `clave primaria`, un identificador, un codigo que nos permita identificar cada miniatura de manera unica e irrepetible.
Para implementar esto, modificaremos nuestra tabla `miniaturas_coches` para agregar una columna `Identificador` que servira como clave primaria. El codigo SQL para realizar esta modificacion es el siguiente:

```sql
ALTER TABLE `empresarial`.`miniaturas_coches`
  ADD COLUMN `Identificador` INT NOT NULL AUTO_INCREMENT PRIMARY KEY;
``` 
Con este comando, hemos agregado una columna `Identificador` que es de tipo entero, no nula, autoincremental y se establece como clave primaria. Esto significa que cada vez que agreguemos una nueva miniatura a nuestra tabla, se le asignara automaticamente un numero unico en la columna `Identificador`.

Esto funciona de maravilla con un sistema de pegatinas en las que se vea el identificador de cada miniatura, permitiendonos buscar y recuperar informacion de manera rapida y eficiente. Por ejemplo, si queremos encontrar una miniatura especifica, podemos usar su `Identificador` para hacer una consulta en la base de datos:

```sql
SELECT * FROM `miniaturas_coches` WHERE `Identificador` = 5;
```
Y nos devolveria algo como:
```
| Identificador | Marca      | Modelo        | Año  |
|---------------|------------|---------------|------|
| 5             | Ferrari    | F40           | 1987 |
```
La implementacion de una clave primaria en nuestra tabla `miniaturas_coches` nos permite organizar y gestionar eficientemente nuestro inventario de miniaturas. Este concepto es fundamental en el manejo de bases de datos relacionales y sera de gran utilidad en futuros proyectos donde necesitemos identificar registros de manera unica e irrepetible.