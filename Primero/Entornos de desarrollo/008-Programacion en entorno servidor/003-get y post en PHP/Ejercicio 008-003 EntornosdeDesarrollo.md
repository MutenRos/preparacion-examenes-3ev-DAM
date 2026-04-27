Actividad
El objetivo de esta actividad es mejorar los estilos y aspectos visuales de una página web que muestra datos de una base de datos MySQL utilizando PHP. La página incluye un menú lateral con enlaces a diferentes tablas de la base de datos, y una tabla principal que muestra los datos de la tabla seleccionada.

Paso 1: Modificar el estilo del menú
Actualiza el estilo del menú lateral para que tenga bordes redondeados y un color de fondo indigo. Asegúrate de que cada enlace tenga un tamaño adecuado y una transición suave al pasar el ratón por encima.

Paso 2: Mejorar la tabla principal
Añade una clase CSS llamada redondeado a la tabla principal para darle bordes redondeados. Asegúrate de que las celdas del encabezado tengan un fondo indigo y los datos alternen entre blanco y gris claro.

Paso 3: Integrar el estilo en el archivo
Integra estos cambios en el archivo 012-mas ajustes esteticos.php para que se apliquen correctamente a la página web.

Restricciones
No usar librerías externas.
Mantener el formato y estructura de los archivos originales.
Solo modificar los estilos CSS y no cambiar la lógica PHP.
Criterios de evaluación
Introducción y contextualización (25%)

Explica brevemente qué se espera lograr con estos ajustes estéticos y cómo afectan a la experiencia del usuario.
Desarrollo técnico correcto y preciso (25%)

Verifica que los cambios en el estilo sean precisos y que cumplan con las especificaciones dadas.
Asegúrate de que el código PHP siga siendo funcional sin errores.
Aplicación práctica con ejemplo claro (25%)

Proporciona un ejemplo claro de cómo se verá la página web después de aplicar los ajustes estéticos.
Incluye capturas de pantalla o descripciones detalladas para ilustrar los cambios.
Cierre/Conclusión enlazando con la unidad (25%)

Concluye explicando cómo estos ajustes pueden mejorar la experiencia del usuario y cómo se integran con el resto del proyecto.
Asegúrate de que el alumnado comprenda el valor de la estética en las interfaces web.

## SOLUCIÓN

### Introducción y contextualización (25%)

Los ajustes estéticos son cruciales en la experiencia del usuario. Una interfaz bien diseñada mejora:
- **Usabilidad**: bordes redondeados y colores consistentes guían la atención del usuario
- **Contraste visual**: alternancia de colores en tablas facilita lectura de datos
- **Transiciones suaves**: feedback visual al interactuar (hover) confirma acciones

Sin estética, incluso datos correctos parecen poco profesionales.

### Desarrollo técnico correcto y preciso (25%)

#### Cambios CSS implementados en `012-mas ajustes esteticos.php`:

```css
/* Menú mejorado con transiciones */
nav a {
  transition: all 0.3s ease;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
nav a:hover {
  transform: translateX(10px);
  box-shadow: 0 4px 12px rgba(75,0,130,0.3);
  background: indigo;
  color: white;
}

/* Tabla con bordes redondeados y alternancia */
table {
  border-collapse: separate;
  border-spacing: 0;
  border: 3px solid indigo;
  border-radius: 8px;
  overflow: hidden;
}

table th {
  background: indigo;
  color: white;
  padding: 12px;
  font-weight: bold;
}

/* Alternancia de colores en datos */
table tbody tr:nth-child(odd) {
  background: white;
}
table tbody tr:nth-child(even) {
  background: #f0f8ff;
}

table tbody tr:hover {
  background: #e6e6fa;
  cursor: pointer;
}

table td {
  padding: 12px;
  border-bottom: 1px solid #ddd;
}

.redondeado {
  border-radius: 8px;
}
```

**PHP**: Sin cambios. La lógica funciona correctamente como estaba.

### Aplicación práctica con ejemplo claro (25%)

**Antes**: Interfaz básica, lineal, sin feedback visual.

**Después**: 
- Menú con efecto deslizamiento al hover (translateX 10px) → usuario ve que puede interactuar
- Tabla con esquema de colores: encabezado indigo, datos alternados blanco/#f0f8ff
- Hover sobre filas → resalta con color #e6e6fa para identificar datos rápidamente
- Bordes redondeados en tabla → aspecto moderno y pulido
- Sombras en botones → profundidad y jerarquía visual

### Cierre/Conclusión (25%)

La estética no es decorativa, es **funcional**. Estos ajustes:
- ✓ Mejoran legibilidad (contraste, espaciado, alternancia)
- ✓ Proporcionan feedback (transiciones, hover)
- ✓ Construyen identidad visual (colores consistentes, tipografía)
- ✓ Facilitan navegación (efectos visuales)

En proyectos reales, la estética y la funcionalidad van juntas. Un ERP bien diseñado retiene usuarios y mejora la experiencia general del desarrollo web.