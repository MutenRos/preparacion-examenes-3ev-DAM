# Ejercicio 002-008: Claves Ajenas en Bases de Datos

## Introducción y Contextualización

Continuando con nuestro negocio de miniaturas de coches de carreras del siglo pasado, ahora que tenemos identificadas nuestras miniaturas con claves primarias, necesitamos registrar las ventas que realizamos. Para ello, no basta con tener una tabla de `miniaturas_coches` y otra de `clientes`, sino que necesitamos una tercera tabla `pedidos` que conecte ambas.

Las **claves ajenas** (o foreign keys) son el mecanismo que nos permite establecer relaciones entre tablas diferentes. Son columnas que hacen referencia a la clave primaria de otra tabla, creando así un vínculo entre los datos. Esto es fundamental para mantener la integridad referencial de nuestra base de datos.

En este ejercicio, vamos a crear una tabla de pedidos que relacione nuestros clientes con los productos que compran.

## Desarrollo Técnico

Primero, asumimos que ya tenemos creadas las tablas `clientes` y `productos` con sus respectivas claves primarias. Ahora vamos a crear la tabla `pedidos`:

```sql
CREATE TABLE `empresarial`.`pedidos` (
  `Identificador` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `fecha` DATE NOT NULL,
  `cantidad` INT NOT NULL,
  `precio_total` DECIMAL(10,2) NOT NULL,
  `Identificador_cliente` INT NOT NULL,
  `Identificador_producto` INT NOT NULL
);
```

Esta tabla tiene su propia clave primaria (`Identificador`), pero también incluye dos columnas especiales: `Identificador_cliente` e `Identificador_producto`. Estas columnas van a almacenar referencias a las claves primarias de las tablas `clientes` y `productos` respectivamente.

Ahora añadimos las claves ajenas para establecer las relaciones:

```sql
ALTER TABLE `empresarial`.`pedidos`
  ADD CONSTRAINT `fk_pedidos_clientes`
  FOREIGN KEY (`Identificador_cliente`)
  REFERENCES `clientes` (`Identificador`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE `empresarial`.`pedidos`
  ADD CONSTRAINT `fk_pedidos_productos`
  FOREIGN KEY (`Identificador_producto`)
  REFERENCES `productos` (`Identificador`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;
```

Las cláusulas `ON DELETE CASCADE` y `ON UPDATE CASCADE` significan que:
- Si eliminamos un cliente, se eliminarán automáticamente todos sus pedidos
- Si cambiamos el identificador de un producto, se actualizará automáticamente en todos los pedidos

## Aplicación Práctica

Ahora que tenemos la estructura preparada, podemos insertar un pedido real. Supongamos que el cliente con `Identificador = 3` (Juan Pérez) compra 2 unidades del producto con `Identificador = 5` (Ferrari F40):

```sql
INSERT INTO `empresarial`.`pedidos` 
  (`fecha`, `cantidad`, `precio_total`, `Identificador_cliente`, `Identificador_producto`)
VALUES 
  ('2025-10-20', 2, 50000.00, 3, 5);
```

Ahora podemos hacer consultas complejas que relacionen las tres tablas:

```sql
SELECT 
  p.Identificador AS 'Nº Pedido',
  c.nombre AS 'Cliente',
  pr.marca AS 'Marca',
  pr.modelo AS 'Modelo',
  p.cantidad AS 'Cantidad',
  p.precio_total AS 'Total'
FROM pedidos p
INNER JOIN clientes c ON p.Identificador_cliente = c.Identificador
INNER JOIN productos pr ON p.Identificador_producto = pr.Identificador
WHERE p.Identificador = 1;
```

Esto nos devolvería algo como:

```
| Nº Pedido | Cliente      | Marca   | Modelo | Cantidad | Total     |
|-----------|--------------|---------|--------|----------|-----------|
| 1         | Juan Pérez   | Ferrari | F40    | 2        | 50000.00  |
```

## Conclusión

Las claves ajenas son esenciales para crear relaciones entre tablas y mantener la integridad de los datos en bases de datos relacionales. En nuestro caso, nos permiten:

1. **Evitar la duplicación de datos**: No necesitamos repetir toda la información del cliente o del producto en cada pedido
2. **Mantener la consistencia**: Si actualizamos los datos de un cliente, no tenemos que modificar múltiples registros
3. **Garantizar la integridad referencial**: No podemos crear un pedido con un cliente o producto que no existe

Este concepto es fundamental en cualquier sistema de gestión de bases de datos real, ya sea para un negocio de miniaturas, una tienda online o cualquier aplicación que requiera relacionar diferentes entidades. Las claves ajenas son la base del modelo relacional y nos permiten estructurar nuestros datos de manera lógica y eficiente.