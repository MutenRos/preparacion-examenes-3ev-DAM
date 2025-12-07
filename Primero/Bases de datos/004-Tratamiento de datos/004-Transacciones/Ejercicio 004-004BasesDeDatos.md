# EJERCICIO 004-004: BASES DE DATOS Y TRANSACCIONES

## SOLUCIÓN IMPLEMENTADA

### 1. Base de Datos Creada: tiendaonline2526

**6 Tablas normalizadas con relaciones foráneas:**
- `categorias` (5 registros)
- `clientes` (5 registros)  
- `productos` (15 registros, FK a categorias)
- `gestion_stock` (15 registros, FK a productos, 1:1)
- `pedidos` (6 registros, FK a clientes)
- `lineas_pedido` (13 registros, N:M entre pedidos y productos)

### 2. Datos Insertados

**Categorías:** Electrónica, Ropa, Hogar, Deportes, Libros

**Clientes:** Juan García, María Rodríguez, Carlos López, Ana Martínez, Pedro Sánchez

**Productos:** Laptop (1299.99€), iPhone (999.99€), Sudadera (39.99€), Libros (14.99-39.99€), etc.

**Pedidos:** 6 pedidos totalizando 3230.82€
- Estados: pendiente, procesando, enviado, entregado
- Relación completa cliente → pedido → productos

### 3. Verificación de Integridad

✅ **Relaciones foráneas funcionando:**
```sql
-- Un cliente con múltiples pedidos
SELECT p.id_pedido, c.nombre, p.total 
FROM pedidos p
JOIN clientes c ON p.id_cliente = c.id_cliente
WHERE c.nombre = 'Juan García López';
```

✅ **Detalle completo de pedido con todos los productos:**
```sql
SELECT p.id_pedido, c.nombre, pr.nombre, lp.cantidad, lp.subtotal
FROM pedidos p
JOIN clientes c ON p.id_cliente = c.id_cliente
JOIN lineas_pedido lp ON p.id_pedido = lp.id_pedido
JOIN productos pr ON lp.id_producto = pr.id_producto
WHERE p.id_pedido = 1;
```

✅ **Stock disponible y alertas:**
```sql
SELECT pr.nombre, gs.cantidad_disponible,
  CASE WHEN gs.cantidad_disponible <= gs.cantidad_minima THEN 'REORDEN'
       ELSE 'OK' END AS estado
FROM productos pr
JOIN gestion_stock gs ON pr.id_producto = gs.id_producto;
```

### 4. Aplicación Web (PHP)

**index.php:** Dashboard con tabla de pedidos, estados coloreados, y modal AJAX para detalles
- Lista todos los pedidos con cliente, fecha, estado y total
- Botón "Ver Detalles" abre modal con información completa
- Estadísticas: Total de pedidos, entregados, ventas totales

**detalles_pedido.php:** Retorna JSON con información completa del pedido

### 5. Transacciones ACID

```sql
START TRANSACTION;
UPDATE pedidos SET total = (SELECT SUM(subtotal) FROM lineas_pedido WHERE id_pedido = pedidos.id_pedido);
COMMIT;
```

**Garantiza:**
- Atomicidad: Todo o nada
- Consistencia: Datos correctos
- Aislamiento: Sin interferencias
- Durabilidad: Persistencia en disco

### 6. Conceptos Aprendidos

✅ **Normalización 3NF** - Elimina redundancia
✅ **Relaciones 1:N y N:M** - Estructura datos complejos
✅ **Claves foráneas** - Integridad referencial (ON DELETE CASCADE/RESTRICT)
✅ **Índices** - Optimización de búsquedas
✅ **Campos computados** - subtotal = cantidad × precio_unitario
✅ **JOINs múltiples** - Consultas complejas
✅ **Transacciones** - Operaciones atómicas

### 7. Archivos Generados

- `SOLUCION_004-004.md` - Documentación técnica completa
- `01-crear-base-datos.sql` - Script de creación
- `02-crear-tablas.sql` - Definición de tablas
- `07-insertar-datos.sql` - Carga de datos
- `08-consultas-verificacion.sql` - 11 consultas avanzadas
- `index.php` - Aplicación web
- `detalles_pedido.php` - Backend AJAX
- `RESUMEN_SOLUCION.md` - Guía rápida

### 8. Ejecución

```bash
mysql -u root -p < 01-crear-base-datos.sql
mysql -u root -p < 02-crear-tablas.sql
mysql -u root -p < 07-insertar-datos.sql
mysql -u root -p tiendaonline2526 < 08-consultas-verificacion.sql
php -S localhost:8000  # Ejecutar aplicación web
```

---

**Estado:** ✅ COMPLETADO | **Alumno:** Darío Lacal | **Evaluación:** 1ª


