# RESUMEN EJECUTIVO - EJERCICIO 004-004 BASES DE DATOS

## ✅ Solución Completada

### 📋 Descripción del Ejercicio

Crear una **base de datos relacional completa** (tiendaonline2526) con:
- Tablas relacionadas (categorías, clientes, productos, stock, pedidos)
- Datos de prueba realistas
- Consultas de verificación de integridad
- Aplicación web PHP para visualizar pedidos

---

## 📁 Archivos Generados

### 1. **SOLUCION_004-004.md** (Documentación completa)
- Explicación paso a paso del ejercicio
- Scripts SQL comentados
- Aplicación PHP interactiva
- Análisis de transacciones ACID

### 2. **01-crear-base-datos.sql**
- Creación de la BD `tiendaonline2526`
- Charset UTF-8 para caracteres especiales

### 3. **02-crear-tablas.sql**
Crea 6 tablas relacionadas:

```
categorias
├── Electrónica, Ropa, Hogar, Deportes, Libros
│
productos (FK: id_categoria)
├── 15 productos de ejemplo
│   └── Laptop, iPhone, Sudaderas, Libros, etc.
│
gestion_stock (FK: id_producto, 1:1)
├── Inventario de cada producto
│   └── Cantidad, mínima, máxima
│
clientes
├── 5 clientes de prueba
│   └── Juan, María, Carlos, Ana, Pedro
│
pedidos (FK: id_cliente)
├── 6 pedidos de ejemplo
│   └── Estados: pendiente, procesando, enviado, entregado
│
lineas_pedido (FK: id_pedido, id_producto) [N:M]
├── 13 detalles de pedidos
│   └── Producto, cantidad, precio, subtotal
```

### 4. **07-insertar-datos.sql**
Carga de datos completa:
- ✅ 5 categorías
- ✅ 5 clientes con datos reales
- ✅ 15 productos con descripción y precio
- ✅ 15 registros de stock (niveles mínimo/máximo)
- ✅ 6 pedidos con estado
- ✅ 13 líneas de pedido (relaciones N:M)
- ✅ Cálculo automático de totales (TRANSACCIÓN)

### 5. **08-consultas-verificacion.sql**
11 grupos de consultas SQL avanzadas:

| # | Consulta | Propósito |
|---|----------|-----------|
| 1 | Verificación básica | Ver datos de cada tabla |
| 2 | Pedidos completos | JOINs múltiples con clientes |
| 3 | Pedidos por cliente | Filtrar por nombre específico |
| 4 | Estado de stock | Identificar reordenes necesarias |
| 5 | Ventas por categoría | Análisis de ingresos |
| 6 | Detalle de pedido | Vista completa con productos |
| 7 | Cliente con más pedidos | Análisis de valor |
| 8 | Producto más vendido | Ranking de ventas |
| 9 | Estadísticas por estado | KPIs de gestión |
| 10 | Integridad referencial | Validar relaciones foráneas |
| 11 | Resumen ejecutivo | Dashboard de métricas |

### 6. **index.php** (Aplicación web)
Interfaz interactiva con:
- ✅ Tabla de pedidos con paginación
- ✅ Códigos de estado con colores
- ✅ Modal emergente con detalles
- ✅ Estadísticas en tiempo real
- ✅ Diseño responsive (Bootstrap-style)
- ✅ AJAX para cargar detalles sin recargar

### 7. **detalles_pedido.php** (Backend AJAX)
- Consulta dinámica por ID de pedido
- Información completa del cliente
- Detalles de todos los productos
- Totales y subtotales

---

## 🎯 Conceptos Demostrados

### ✅ Relaciones de Bases de Datos

| Tipo | Ejemplo | Beneficio |
|------|---------|-----------|
| **1:N** | Cliente → Pedidos | Un cliente tiene muchos pedidos |
| **N:1** | Pedidos → Clientes | Cada pedido pertenece a 1 cliente |
| **1:1** | Productos → Stock | 1 producto = 1 registro de stock |
| **N:M** | Pedidos ↔ Productos | Muchos productos en muchos pedidos |

### ✅ Claves Foráneas (FK)

```sql
-- Integridad referencial ON DELETE CASCADE
FOREIGN KEY (id_producto) REFERENCES productos(id_producto) ON DELETE CASCADE

-- Integridad referencial ON DELETE RESTRICT
FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente) ON DELETE RESTRICT
```

**Resultado:** No se puede eliminar un cliente con pedidos activos ✓

### ✅ Transacciones ACID

```sql
START TRANSACTION;
UPDATE pedidos SET total = (SELECT SUM(subtotal) FROM lineas_pedido...);
COMMIT;
```

- **Atomicidad:** Todo o nada
- **Consistencia:** Datos correctos
- **Aislamiento:** Sin interferencias
- **Durabilidad:** Persistencia garantizada

### ✅ Índices para Rendimiento

```sql
INDEX idx_email (email)
INDEX idx_nombre (nombre)
INDEX idx_disponibilidad (cantidad_disponible)
```

Mejoran búsquedas y JOINs en tablas grandes.

### ✅ Campos Computados

```sql
subtotal DECIMAL(12, 2) GENERATED ALWAYS AS (cantidad * precio_unitario) STORED
```

Se calcula automáticamente, siempre sincronizado.

---

## 📊 Datos de Ejemplo Insertados

### Categorías (5)
- Electrónica (Laptop, iPhone, AirPods)
- Ropa (Camiseta, Pantalón, Sudadera)
- Hogar (Almohada, Sábanas, Lámpara)
- Deportes (Zapatillas, Mochila, Bandas)
- Libros (El Quijote, Clean Code, Sapiens)

### Clientes (5)
- Juan García López (juan.garcia@email.com)
- María Rodríguez Martín (maria.rodriguez@email.com)
- Carlos López Pérez (carlos.lopez@email.com)
- Ana Martínez González (ana.martinez@email.com)
- Pedro Sánchez Ruiz (pedro.sanchez@email.com)

### Pedidos (6)
- Pedido 1: Juan (1x Laptop + 2x Camiseta) = 1339,97€ → Procesando
- Pedido 2: María (1x iPhone + 1x Zapatillas + 1x Sapiens) = 1149,97€ → Entregado
- Pedido 3: Carlos (2x Pantalón + 1x Almohada) = 170,97€ → Pendiente
- Pedido 4: Juan (1x Sudadera + 2x Bandas) = 89,97€ → Enviado
- Pedido 5: Ana (1x Sábanas + 1x Lámpara + 1x Clean Code) = 164,97€ → Entregado
- Pedido 6: Pedro (1x Quijote + 1x Mochila + 1x AirPods) = 314,97€ → Pendiente

**Total de ventas: 3230,82€**

---

## 🚀 Cómo Usar la Solución

### Paso 1: Crear la BD
```bash
mysql -u root -p < 01-crear-base-datos.sql
mysql -u root -p < 02-crear-tablas.sql
mysql -u root -p < 07-insertar-datos.sql
```

### Paso 2: Ejecutar consultas de verificación
```bash
mysql -u root -p tiendaonline2526 < 08-consultas-verificacion.sql
```

### Paso 3: Usar la aplicación PHP
```bash
php -S localhost:8000  # En el directorio de index.php
# Acceder a http://localhost:8000
```

---

## 💡 Lecciones Aprendidas

1. **Normalización:** Elimina redundancia y mejora integridad
2. **Relaciones:** Estructuran datos complejos eficientemente
3. **Transacciones:** Garantizan consistencia en operaciones múltiples
4. **Integridad Referencial:** Previene datos inconsistentes
5. **Escalabilidad:** Arquitectura lista para crecer

---

## 🎓 Aplicación en Proyectos Reales

Este modelo puede extenderse para:

✓ **E-commerce completo**
- Carrito de compras
- Pasarelas de pago
- Historial de devoluciones
- Sistema de reseñas

✓ **ERP empresarial**
- Gestión de inventario automática
- Alertas de stock bajo
- Proveedores y reordenes
- Facturación integrada

✓ **CRM**
- Historial de cliente
- Análisis de valor
- Seguimiento de pedidos
- Reportes de venta

---

## 📈 Métricas Finales

```
Total de Categorías:        5
Total de Clientes:          5
Total de Productos:         15
Total de Registros Stock:   15
Total de Pedidos:           6
Total de Líneas Pedido:     13
Total de Ventas:            3230.82€
Ticket Promedio:            538.47€
Productos Vendidos:         18
```

---

## ✅ Checklist de Cumplimiento

- ✅ Base de datos creada y funcional
- ✅ 6 tablas normalizadas (3NF)
- ✅ Relaciones foráneas implementadas
- ✅ Datos de prueba realistas
- ✅ Consultas de verificación
- ✅ Integridad referencial comprobada
- ✅ Transacciones ACID documentadas
- ✅ Aplicación PHP interactiva
- ✅ Documentación completa
- ✅ Código bien comentado

---

**Estado:** ✅ COMPLETADO  
**Alumno:** Darío Lacal  
**Asignatura:** Bases de Datos - Tratamiento de Datos  
**Evaluación:** 1ª Evaluación  
**Fecha:** 2025-12-07

