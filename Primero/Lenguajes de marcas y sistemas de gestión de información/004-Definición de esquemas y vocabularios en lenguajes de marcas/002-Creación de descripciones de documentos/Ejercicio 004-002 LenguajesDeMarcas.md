En este contexto, aprenderemos a validar documentos XML utilizando esquemas XSD (XML Schema Definition). Este proceso es crucial para asegurar que los datos en nuestros documentos sean correctos y consistentes. Además, podemos integrar estos conocimientos con nuestro hobby de modelado e impresión 3D, ya que el procesamiento y validación de XML puede ser aplicable a cualquier tipo de archivo estructurado, como los archivos de configuración o metadatos utilizados en proyectos 3D.

Enunciado paso a paso
Crea un esquema XSD (002-plantilla.xsd) que defina la estructura del documento XML (001-documento.xml). Asegúrate de incluir todos los elementos y atributos mencionados en el ejemplo.

Valida el documento XML (001-documento.xml) utilizando el esquema XSD creado en el paso anterior. Deberías ver un mensaje indicando que el XML es válido.

Crea otro documento XML no válido (004-documento no valido.xml). Asegúrate de hacer algún cambio que cause una validación fallida, como cambiar el nombre del elemento <nombre> a <minombre>.

Valida el nuevo documento XML no válido utilizando el mismo esquema XSD. Deberías ver un mensaje indicando que el XML es NO válido y mostrar el error específico.

Modifica el esquema XSD para permitir la versión 2.0 del documento XML (001-documento.xml). Asegúrate de ajustar los tipos de datos y las restricciones necesarias.

Valida nuevamente el documento XML con la versión modificada utilizando el nuevo esquema XSD. Deberías ver un mensaje indicando que el XML es válido.

Restricciones
No uses librerías externas o estructuras no vistas en este tema.
Solo puedes usar los conceptos y herramientas mencionados en la lista blanca.
Criterios de evaluación
Introducción y contextualización (25%): El estudiante debe entender el contexto del ejercicio y cómo se relaciona con su hobby de modelado e impresión 3D.

Desarrollo técnico correcto y preciso (25%): El esquema XSD debe definir correctamente la estructura del documento XML, y las validaciones deben producir los resultados esperados.

Aplicación práctica con ejemplo claro (25%): El estudiante debe crear y validar dos documentos XML distintos, uno válido y otro no válido, mostrando el resultado de cada validación.

Cierre/Conclusión enlazando con la unidad (25%): El estudiante debe explicar cómo los conocimientos adquiridos pueden aplicarse a proyectos futuros relacionados con modelado e impresión 3D o cualquier otro proyecto que requiera el procesamiento de datos estructurados.

## SOLUCIÓN

### Introducción y contextualización (25%)

Los esquemas XSD validan la estructura de documentos XML, garantizando consistencia de datos. Esto es esencial en:
- **Impresión 3D**: archivos STL, OBJ, G-Code contienen metadatos XML (configuraciones, materiales, calibración)
- **IoT/Raspberry**: configuración de sensores, actuadores (JSON/XML)
- **Interoperabilidad**: validación entre sistemas (CAD → impresora → base de datos)

XSD asegura que los datos sean correctos antes de procesarlos, evitando errores en producción.

### Desarrollo técnico correcto y preciso (25%)

#### Paso 1: Esquema XSD (002-plantilla.xsd)

```xml
<?xml version="1.0" encoding="UTF-8"?>
<xs:schema xmlns:xs="http://www.w3.org/2001/XMLSchema">
  
  <xs:element name="persona">
    <xs:complexType>
      <xs:sequence>
        <xs:element name="nombre" type="xs:string"/>
        <xs:element name="apellidos" type="xs:string"/>
        <xs:element name="edad" type="xs:integer" minOccurs="0"/>
      </xs:sequence>
      <xs:attribute name="version" type="xs:decimal" use="required"/>
    </xs:complexType>
  </xs:element>
  
</xs:schema>
```

**Elementos clave:**
- `xs:schema`: contenedor principal del esquema
- `xs:element`: define elementos XML
- `xs:complexType`: permite elementos anidados
- `xs:sequence`: orden específico de elementos
- `xs:attribute`: atributo obligatorio (version)
- `minOccurs="0"`: elemento opcional

#### Paso 2: Documento XML válido (001-documento.xml)

```xml
<?xml version="1.0" encoding="UTF-8"?>
<persona version="1.0" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
         xsi:noNamespaceSchemaLocation="002-plantilla.xsd">
  <nombre>Dario</nombre>
  <apellidos>Lacal Civera</apellidos>
  <edad>22</edad>
</persona>
```

**Validación**: ✓ **VÁLIDO**. Cumple esquema XSD.

#### Paso 3: Documento XML no válido (004-documento no valido.xml)

```xml
<?xml version="1.0" encoding="UTF-8"?>
<persona version="1.0" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
         xsi:noNamespaceSchemaLocation="002-plantilla.xsd">
  <minombre>Dario</minombre>
  <apellidos>Lacal Civera</apellidos>
  <edad>22</edad>
</persona>
```

**Validación**: ✗ **NO VÁLIDO**
```
Error: Element 'minombre' is not expected. Expected is 'nombre'.
```

#### Paso 4: Esquema XSD modificado (002-plantilla-v2.xsd) - Permite versión 2.0

```xml
<?xml version="1.0" encoding="UTF-8"?>
<xs:schema xmlns:xs="http://www.w3.org/2001/XMLSchema">
  
  <xs:element name="persona">
    <xs:complexType>
      <xs:sequence>
        <xs:element name="nombre" type="xs:string"/>
        <xs:element name="apellidos" type="xs:string"/>
        <xs:element name="edad" type="xs:integer" minOccurs="0"/>
        <xs:element name="email" type="xs:string" minOccurs="0"/>
        <xs:element name="telefono" type="xs:string" minOccurs="0"/>
      </xs:sequence>
      <xs:attribute name="version" use="required">
        <xs:simpleType>
          <xs:restriction base="xs:decimal">
            <xs:enumeration value="1.0"/>
            <xs:enumeration value="2.0"/>
          </xs:restriction>
        </xs:simpleType>
      </xs:attribute>
    </xs:complexType>
  </xs:element>
  
</xs:schema>
```

**Cambios:**
- Atributo `version` acepta 1.0 y 2.0
- Nuevos elementos opcionales: `email`, `telefono`

#### Paso 5: Documento XML versión 2.0 (001-documento-v2.xml)

```xml
<?xml version="1.0" encoding="UTF-8"?>
<persona version="2.0" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
         xsi:noNamespaceSchemaLocation="002-plantilla-v2.xsd">
  <nombre>Dario</nombre>
  <apellidos>Lacal Civera</apellidos>
  <edad>22</edad>
  <email>dario@example.com</email>
  <telefono>612345678</telefono>
</persona>
```

**Validación**: ✓ **VÁLIDO** con esquema v2.

### Aplicación práctica con ejemplo claro (25%)

**Caso real: Configuración de impresora 3D**

**Archivo de configuración (printer-config.xml):**
```xml
<?xml version="1.0" encoding="UTF-8"?>
<printer version="1.0">
  <model>Ender 3 Pro</model>
  <nozzle>0.4</nozzle>
  <bed>
    <width>220</width>
    <height>220</height>
    <depth>250</depth>
  </bed>
  <material>PLA</material>
  <temperature>200</temperature>
</printer>
```

**Esquema XSD (printer-schema.xsd):**
```xml
<xs:schema xmlns:xs="http://www.w3.org/2001/XMLSchema">
  <xs:element name="printer">
    <xs:complexType>
      <xs:sequence>
        <xs:element name="model" type="xs:string"/>
        <xs:element name="nozzle" type="xs:decimal"/>
        <xs:element name="bed">
          <xs:complexType>
            <xs:sequence>
              <xs:element name="width" type="xs:integer"/>
              <xs:element name="height" type="xs:integer"/>
              <xs:element name="depth" type="xs:integer"/>
            </xs:sequence>
          </xs:complexType>
        </xs:element>
        <xs:element name="material" type="xs:string"/>
        <xs:element name="temperature" type="xs:integer"/>
      </xs:sequence>
      <xs:attribute name="version" type="xs:decimal" use="required"/>
    </xs:complexType>
  </xs:element>
</xs:schema>
```

**Beneficios:**
- Validación antes de enviar configuración a impresora
- Evita errores (temperatura incorrecta, dimensiones inválidas)
- Estandarización entre diferentes modelos

### Cierre/Conclusión (25%)

Los esquemas XSD son fundamentales para:
- **Validación preventiva**: detectar errores antes de procesamiento
- **Documentación implícita**: el XSD describe la estructura esperada
- **Interoperabilidad**: garantiza compatibilidad entre sistemas

**Aplicaciones en modelado 3D:**
✓ Validar archivos de configuración (impresoras, slicers)
✓ Metadatos de modelos STL/OBJ (autor, licencia, parámetros)
✓ Proyectos Raspberry: validación de JSON/XML en sensores IoT

La validación rigurosa de datos estructurados es esencial en cualquier proyecto técnico, desde ERPs hasta sistemas embebidos.