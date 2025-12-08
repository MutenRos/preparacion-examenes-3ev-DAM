Contexto
En nuestra clase sobre Definición de esquemas y vocabularios en lenguajes de marcas, hemos aprendido cómo validar documentos XML utilizando esquemas XSD (XML Schema Definition). Para aplicar este conocimiento, vamos a trabajar con un ejemplo práctico. El objetivo es validar un documento XML que contiene información sobre una persona, incluyendo sus roles, proyectos destacados e intereses técnicos.

Enunciado paso a paso
Entendiendo el problema:

Tenemos un archivo XML llamado 004-documento no valido.xml que necesita ser validado.
También tenemos un esquema XSD llamado 002-plantilla.xsd que define cómo debería estructurarse el documento XML.
Carga del esquema:

Usaremos la biblioteca Python xmlschema para cargar y validar el esquema XSD.
El nombre de la variable que contendrá el esquema será esquema_xsd.
Validación del documento XML:

Usaremos el método validate() del objeto esquema para verificar si el archivo 004-documento no valido.xml es válido según el esquema.
El nombre de la variable que contendrá el resultado de la validación será validacion_result.
Restricciones
No se permite usar librerías externas o estructuras que no hayamos visto en clase.
Solo puedes usar los conceptos y herramientas que se han explicado en los archivos proporcionados.
Criterios de evaluación
Introducción y contextualización (25%):

El alumno debe entender el contexto del problema y cómo aplicar lo aprendido en la clase.
Desarrollo técnico correcto y preciso (25%):

El código debe cargar correctamente el esquema XSD y validar el documento XML.
Aplicación práctica con ejemplo claro (25%):

El alumno debe proporcionar un ejemplo claro de cómo se realiza la validación.
Cierre/Conclusión enlazando con la unidad (25%):

El ejercicio debe cerrarse explicando cómo el resultado de la validación puede ser utilizado en contextos prácticos, como la integración de sistemas de gestión empresarial o la creación de aplicaciones web.

## SOLUCIÓN

### Introducción y contextualización (25%)

La validación XML mediante esquemas XSD es esencial en entornos profesionales:
- **APIs**: verificar datos antes de procesarlos
- **ERPs**: garantizar integridad de información empresarial
- **Configuraciones**: validar archivos de configuración antes de despliegue

Python con `xmlschema` automatiza validación, evitando errores manuales y asegurando consistencia.

### Desarrollo técnico correcto y preciso (25%)

#### Código de validación (validar.py):

```python
import xmlschema

# Cargar el esquema XSD
esquema_xsd = xmlschema.XMLSchema('002-plantilla.xsd')

# Validar documento XML
try:
    esquema_xsd.validate('004-documento no valido.xml')
    validacion_result = "VÁLIDO"
    print("✓ El documento XML es VÁLIDO según el esquema XSD")
except xmlschema.XMLSchemaValidationError as error:
    validacion_result = "NO VÁLIDO"
    print(f"✗ El documento XML es NO VÁLIDO")
    print(f"Error: {error}")
```

#### Esquema XSD (002-plantilla.xsd):

```xml
<?xml version="1.0" encoding="UTF-8"?>
<xs:schema xmlns:xs="http://www.w3.org/2001/XMLSchema">
  <xs:element name="persona">
    <xs:complexType>
      <xs:sequence>
        <xs:element name="nombre" type="xs:string"/>
        <xs:element name="apellidos" type="xs:string"/>
        <xs:element name="roles" minOccurs="0">
          <xs:complexType>
            <xs:sequence>
              <xs:element name="rol" type="xs:string" maxOccurs="unbounded"/>
            </xs:sequence>
          </xs:complexType>
        </xs:element>
        <xs:element name="proyectos" minOccurs="0">
          <xs:complexType>
            <xs:sequence>
              <xs:element name="proyecto" type="xs:string" maxOccurs="unbounded"/>
            </xs:sequence>
          </xs:complexType>
        </xs:element>
        <xs:element name="intereses" minOccurs="0">
          <xs:complexType>
            <xs:sequence>
              <xs:element name="interes" type="xs:string" maxOccurs="unbounded"/>
            </xs:sequence>
          </xs:complexType>
        </xs:element>
      </xs:sequence>
      <xs:attribute name="id" type="xs:string" use="required"/>
    </xs:complexType>
  </xs:element>
</xs:schema>
```

#### Documento XML no válido (004-documento no valido.xml):

```xml
<?xml version="1.0" encoding="UTF-8"?>
<persona id="001">
  <minombre>Dario</minombre>
  <apellidos>Lacal Civera</apellidos>
  <roles>
    <rol>Desarrollador</rol>
    <rol>Estudiante DAM</rol>
  </roles>
  <proyectos>
    <proyecto>ERP Sistema de Gestión</proyecto>
    <proyecto>Impresora 3D IoT</proyecto>
  </proyectos>
  <intereses>
    <interes>Raspberry Pi</interes>
    <interes>Modelado 3D</interes>
    <interes>Python</interes>
  </intereses>
</persona>
```

**Error esperado:**
```
Element 'minombre' is not expected. Expected is 'nombre'.
```

#### Documento XML válido corregido (003-documento valido.xml):

```xml
<?xml version="1.0" encoding="UTF-8"?>
<persona id="001">
  <nombre>Dario</nombre>
  <apellidos>Lacal Civera</apellidos>
  <roles>
    <rol>Desarrollador</rol>
    <rol>Estudiante DAM</rol>
  </roles>
  <proyectos>
    <proyecto>ERP Sistema de Gestión</proyecto>
    <proyecto>Impresora 3D IoT</proyecto>
  </proyectos>
  <intereses>
    <interes>Raspberry Pi</interes>
    <interes>Modelado 3D</interes>
    <interes>Python</interes>
  </intereses>
</persona>
```

**Validación:** ✓ **VÁLIDO**

### Aplicación práctica con ejemplo claro (25%)

#### Ejemplo completo con manejo de errores:

```python
import xmlschema
from pathlib import Path

def validar_xml(archivo_xml, archivo_xsd):
    """
    Valida un documento XML contra un esquema XSD.
    
    Args:
        archivo_xml: Ruta al archivo XML
        archivo_xsd: Ruta al esquema XSD
        
    Returns:
        tuple: (es_valido, mensaje)
    """
    try:
        # Cargar esquema
        esquema_xsd = xmlschema.XMLSchema(archivo_xsd)
        
        # Validar documento
        esquema_xsd.validate(archivo_xml)
        
        return True, "✓ Documento XML válido"
        
    except xmlschema.XMLSchemaValidationError as error:
        return False, f"✗ Error de validación: {error.reason}"
        
    except FileNotFoundError as error:
        return False, f"✗ Archivo no encontrado: {error}"
        
    except Exception as error:
        return False, f"✗ Error inesperado: {error}"

# Uso práctico
archivos = [
    ('003-documento valido.xml', '002-plantilla.xsd'),
    ('004-documento no valido.xml', '002-plantilla.xsd')
]

for xml_file, xsd_file in archivos:
    es_valido, mensaje = validar_xml(xml_file, xsd_file)
    print(f"\nArchivo: {xml_file}")
    print(mensaje)
    
    if es_valido:
        # Procesar documento válido
        esquema = xmlschema.XMLSchema(xsd_file)
        datos = esquema.to_dict(xml_file)
        print(f"Datos parseados: {datos}")
```

**Salida esperada:**
```
Archivo: 003-documento valido.xml
✓ Documento XML válido
Datos parseados: {'@id': '001', 'nombre': 'Dario', 'apellidos': 'Lacal Civera', ...}

Archivo: 004-documento no valido.xml
✗ Error de validación: Element 'minombre' is not expected
```

### Cierre/Conclusión (25%)

La validación automatizada con Python + XSD es fundamental en:

**Integración de sistemas empresariales:**
- Validar datos antes de insertar en ERP/CRM
- Garantizar formato correcto en APIs REST
- Evitar corrupción de bases de datos

**Aplicaciones web:**
- Validar formularios complejos (backend)
- Verificar importación masiva de datos (CSV → XML → validación)
- Middleware de validación entre microservicios

**Casos de uso prácticos:**
✓ Sistema de pedidos: validar XML antes de procesar compra
✓ Configuración de aplicaciones: verificar parámetros antes de arrancar
✓ Intercambio de datos B2B: asegurar compatibilidad entre empresas

La biblioteca `xmlschema` permite integrar validación en pipelines CI/CD, tests automatizados y sistemas de producción, asegurando robustez y fiabilidad.