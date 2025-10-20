Contexto
En nuestro mundo digital y tecnológico actual, los dispositivos como los Raspberrys Pi se han convertido en herramientas esenciales para el aprendizaje y desarrollo personal. Además, el modelado e impresión 3D son habilidades cada vez más populares que permiten crear prototipos y objetos físicos a partir de modelos digitales. En este ejercicio, vamos a explorar cómo podemos utilizar vistas en una base de datos relacional para simplificar la visualización de información compleja, como los registros de pedidos en un negocio.

Enunciado paso a paso
Comprende el contexto: Imagina que eres dueño de una tienda en línea y quieres crear una vista que muestre todos los detalles de tus pedidos, incluyendo la fecha del pedido, el nombre del cliente, el producto comprado, su precio, IVA y el precio total.

Identifica las tablas involucradas: En tu base de datos, tienes tres tablas principales: pedidos, clientes y productos. Necesitarás unir estas tablas para obtener la información completa de cada pedido.

Escribe la consulta SQL: Utiliza la sentencia SELECT junto con LEFT JOIN para combinar las tres tablas en una sola vista. Asegúrate de usar los identificadores correctos (id_cliente, Identificador y id_producto) para establecer las relaciones entre las tablas.

Crea la vista: Utiliza el comando CREATE VIEW para guardar esta consulta como una vista llamada vista_pedidos. Esta vista te permitirá acceder fácilmente a todos los detalles de los pedidos sin tener que escribir la consulta compleja cada vez.

Prueba la vista: Finalmente, prueba tu vista ejecutando un SELECT sobre ella y verifica que muestre los datos esperados.

Restricciones
No uses librerías externas ni estructuras no vistas.
Asegúrate de usar solo los conceptos y funciones vistos en la clase.
Criterios de evaluación
Introducción y contextualización (25%): Explica claramente el contexto del problema y cómo las habilidades de modelado e impresión 3D pueden aplicarse en un entorno empresarial.

Desarrollo técnico correcto y preciso (25%): Escribe la consulta SQL correctamente, utilizando LEFT JOIN y alias para las tablas.

Aplicación práctica con ejemplo claro (25%): Prueba la vista generada y verifica que muestre los datos esperados de manera coherente y precisa.

Cierre/Conclusión enlazando con la unidad (25%): Concluye el ejercicio, enfatizando cómo las vistas pueden simplificar el acceso a información compleja y su utilidad en un entorno empresarial.

---

## Solución

### Introducción y Contextualización

En nuestro negocio de miniaturas de coches de carreras, hemos ido creando tablas para gestionar clientes, productos y pedidos. Sin embargo, cada vez que queremos consultar información completa de un pedido (quién lo compró, qué miniatura adquirió, cuánto pagó), tenemos que escribir consultas largas con múltiples JOINs. 

Aquí es donde entran las **vistas**: son como "ventanas" a nuestros datos que simplifican consultas complejas. Una vista es básicamente una consulta guardada que podemos reutilizar como si fuera una tabla normal. Esto nos ahorra tiempo y reduce la posibilidad de errores al escribir la misma consulta repetidamente.

### Desarrollo Técnico

Vamos a crear una vista llamada `vista_pedidos` que nos muestre toda la información relevante de nuestros pedidos de manera clara y organizada.

Primero, escribimos la consulta SQL que queremos guardar como vista:

```sql
CREATE VIEW vista_pedidos AS
SELECT 
    p.Identificador AS 'ID_Pedido',
    p.fecha AS 'Fecha',
    c.nombre AS 'Cliente',
    c.email AS 'Email_Cliente',
    pr.marca AS 'Marca',
    pr.modelo AS 'Modelo',
    pr.año AS 'Año',
    p.cantidad AS 'Cantidad',
    pr.precio AS 'Precio_Unitario',
    (pr.precio * 0.21) AS 'IVA_Unitario',
    (pr.precio * 1.21) AS 'Precio_con_IVA',
    p.precio_total AS 'Total_Pedido'
FROM pedidos p
LEFT JOIN clientes c ON p.Identificador_cliente = c.Identificador
LEFT JOIN productos pr ON p.Identificador_producto = pr.Identificador;
```

**Explicación del código:**
- Usamos `CREATE VIEW` para crear una nueva vista
- `LEFT JOIN` nos asegura que veamos todos los pedidos, incluso si falta información en clientes o productos
- Los alias (AS) hacen que los nombres de columnas sean más legibles
- Calculamos el IVA (21%) y el precio con IVA directamente en la vista

### Aplicación Práctica

Una vez creada la vista, podemos usarla como si fuera una tabla normal. Por ejemplo:

```sql
SELECT * FROM vista_pedidos;
```

Esto nos devolvería algo como:

```
| ID_Pedido | Fecha      | Cliente      | Email_Cliente       | Marca   | Modelo | Año  | Cantidad | Precio_Unitario | IVA_Unitario | Precio_con_IVA | Total_Pedido |
|-----------|------------|--------------|---------------------|---------|--------|------|----------|-----------------|--------------|----------------|--------------|
| 1         | 2025-10-20 | Juan Pérez   | juan@email.com      | Ferrari | F40    | 1987 | 2        | 25000.00        | 5250.00      | 30250.00       | 50000.00     |
| 2         | 2025-10-19 | María García | maria@email.com     | Porsche | 911    | 1985 | 1        | 18000.00        | 3780.00      | 21780.00       | 18000.00     |
```

También podemos filtrar los resultados:

```sql
SELECT * FROM vista_pedidos 
WHERE Cliente = 'Juan Pérez';
```

O buscar pedidos de una marca específica:

```sql
SELECT * FROM vista_pedidos 
WHERE Marca = 'Ferrari'
ORDER BY Fecha DESC;
```

La ventaja es que no tenemos que reescribir todos los JOINs cada vez. Simplemente consultamos la vista como si fuera una tabla.

### Conclusión

Las vistas son una herramienta fundamental en bases de datos relacionales que nos permiten:

1. **Simplificar consultas complejas**: En lugar de escribir JOINs repetidamente, usamos la vista
2. **Mejorar la seguridad**: Podemos dar acceso a una vista sin exponer las tablas originales
3. **Mantener la consistencia**: Todos usan la misma "definición" de cómo ver los datos
4. **Ahorrar tiempo**: Las consultas son más cortas y fáciles de mantener

En nuestro negocio de miniaturas, `vista_pedidos` nos permite consultar rápidamente el historial de ventas, generar informes para contabilidad, o enviar notificaciones a clientes sin tener que preocuparnos de cómo están estructuradas las tablas subyacentes. Es como tener un atajo directo a la información que más necesitamos.