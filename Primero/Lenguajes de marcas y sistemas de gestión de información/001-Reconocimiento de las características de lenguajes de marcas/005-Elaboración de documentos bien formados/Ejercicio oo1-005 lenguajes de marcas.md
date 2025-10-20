Contexto En un mundo donde la tecnología juega un papel cada vez más importante, aprender a manipular y validar documentos XML es una habilidad valiosa. En esta actividad, exploraremos cómo crear y validar documentos XML que describan a personas, utilizando tanto las herramientas de edición como los esquemas XSD para garantizar su estructura correcta.

Enunciado paso a paso

Crea un documento XML personalizado: Utilizando tus habilidades con Raspberrys y similares, crea un nuevo archivo XML que describa a una persona. Asegúrate de incluir todos los elementos necesarios como nombre completo, mote, edad y profesión.
Aplica el esquema XSD: Para garantizar la validez de tu documento, debes aplicar el esquema XSD proporcionado. Este esquema define cómo debe estructurarse un documento XML que describa a una persona.
Valida tu documento XML: Utiliza el validador online proporcionado para verificar que tu documento XML cumple con las reglas definidas en el esquema XSD.
Restricciones

No utilices librerías externas o herramientas de terceros.
Asegúrate de seguir la estructura y sintaxis del esquema XSD proporcionado.
Criterios de evaluación

Introducción y contextualización (25%): Explica claramente qué debe hacer el alumno para crear un documento XML personalizado que describa a una persona.
Desarrollo técnico correcto y preciso (25%): Asegúrate de aplicar correctamente el esquema XSD en tu documento XML.
Aplicación práctica con ejemplo claro (25%): Proporciona un ejemplo detallado de cómo debería verse el archivo XML final y cómo se debe validar usando el validador online.
Cierre/Conclusión enlazando con la unidad (25%): Reflexiona sobre la importancia de la validez de los documentos XML en proyectos futuros y cómo este ejercicio te ha ayudado a entender mejor esta técnica.

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



`XML` nos permite estructurar y ordenar informacion muy facilmente, pero para usar un `SGBD` para extraer esa informacion, el documento `XML` debera tener un formato especifico. Para este caso, contamos con un archivo `XSD` dado que dara validez a nuestros `XML`

El archivo `XSD` es el siguiente:

```xml
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
El archivo `XSD` define que el documento `XML` debe tener un elemento raiz llamado `persona`, y dentro de este, debe contener dos elementos hijos: `nombre` (de tipo cadena de texto) y `edad` (de tipo entero).
Ahora crearemos nuestro archivo `XML` siguiendo las reglas definidas en el `XSD`. Un ejemplo de un archivo `XML` bien formado y válido sería:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<persona>
  <nombre>Juan Pérez</nombre>
  <edad>30</edad>
</persona>
```
Una vez pasado por el validador online "https://www.liquid-technologies.com/online-xsd-validator" y nos dice "Document Valid", sabemos que nuestro archivo `XML` es correcto y cumple con las reglas definidas en el `XSD`.
