Título
Funciones en Departamentos

Contexto
En nuestro proyecto intermodular sobre Búsqueda de Información, hemos explorado cómo las funciones pueden ayudar a organizar y automatizar tareas dentro de diferentes departamentos. Imagina que eres un asistente en un taller de Modelado e Impresión 3D, donde utilizas Raspberrys para controlar máquinas CNC. Vamos a crear una función que calcule el volumen de un objeto impreso.

Enunciado paso a paso
Definición de la Función: Crea una función llamada calcular_volumen que acepte tres parámetros: longitud, ancho y altura.
Cálculo del Volumen: Dentro de la función, calcula el volumen utilizando la fórmula ( \text{volumen} = \text{longitud} \times \text{ancho} \times \text{altura} ).
Retorno del Resultado: Devuelve el valor del volumen.
Prueba de la Función: Llama a la función calcular_volumen con valores específicos (por ejemplo, longitud = 10 cm, ancho = 5 cm, altura = 2 cm) y muestra el resultado.
Restricciones
No usar funciones externas ni estructuras de datos complejas.
Solo utilizar operaciones básicas y control de flujo.
Criterios de evaluación
Introducción y contextualización (25%): El estudiante comprende la importancia de las funciones en el contexto del proyecto y cómo se aplican a un problema real.
Desarrollo técnico correcto y preciso (25%): La función está correctamente definida, implementada y utiliza los parámetros adecuadamente.
Aplicación práctica con ejemplo claro (25%): El estudiante prueba la función con datos específicos y muestra el resultado de manera clara.
Cierre/Conclusión enlazando con la unidad (25%): El estudiante refuerza el aprendizaje al relacionar las funciones con su aplicación práctica en el taller de Modelado e Impresión 3D.

---



En nuestro proyecto ERP que estamos desarrollando (ejercicios 001-001 y 001-002), vimos que necesitamos un sistema completo de gestión empresarial. Uno de los módulos clave es **Producción**, donde las empresas manufactureras necesitan calcular costes de materiales, volúmenes de productos, tiempos de fabricación, etc.

El ejercicio propone calcular el volumen de un objeto 3D, pero voy a **aplicarlo directamente a casos reales del ERP**:

**Casos de uso en producción industrial:**
1. **Calcular volumen de productos** → Para optimizar el espacio en almacén (tabla `inventario`)
2. **Calcular consumo de materiales** → Para las órdenes de fabricación (tabla `consumos_materiales`)
3. **Calcular costes de producción** → Para las listas de materiales BOM (tabla `lineas_bom`)
4. **Calcular tiempos de fabricación** → Para las rutas de producción (tabla `operaciones_ruta`)

**¿Por qué son importantes las funciones en un ERP?**
- **Reutilización:** Calculas el volumen una vez, lo usas en 20 partes del código
- **Mantenimiento:** Si cambias la fórmula, solo modificas una función
- **Claridad:** `calcular_volumen(10, 5, 2)` es más claro que `10 * 5 * 2` perdido en el código
- **Validación:** Puedes validar datos de entrada en un solo punto

Voy a crear funciones reales que usaríamos en el módulo de producción del ERP:

```python
# =====================================================
# MÓDULO: FUNCIONES DE PRODUCCIÓN PARA ERP
# Aplicación: Sistema de gestión empresarial
# Contexto: Proyecto Intermodular DAM
# =====================================================

# FUNCIÓN 1: Calcular volumen de un producto (base del ejercicio)
def calcular_volumen(longitud, ancho, altura):
    """
    Calcula el volumen de un producto rectangular
    Usado en: Optimización de almacenamiento, cálculo de espacio en pallets
    
    Parámetros:
        longitud (float): Longitud en cm
        ancho (float): Ancho en cm
        altura (float): Altura en cm
    
    Retorna:
        float: Volumen en cm³
    """
    volumen = longitud * ancho * altura
    return volumen


# FUNCIÓN 2: Calcular peso de material consumido
def calcular_peso_material(volumen, densidad):
    """
    Calcula el peso de material necesario para fabricar un producto
    Usado en: Tabla consumos_materiales, gestión de inventario
    
    Parámetros:
        volumen (float): Volumen en cm³
        densidad (float): Densidad del material en g/cm³
    
    Retorna:
        float: Peso en gramos
    """
    peso = volumen * densidad
    return peso


# FUNCIÓN 3: Calcular coste de material
def calcular_coste_material(peso_gramos, precio_kg):
    """
    Calcula el coste del material consumido en una orden de fabricación
    Usado en: Tabla ordenes_fabricacion, cálculo de costes de producción
    
    Parámetros:
        peso_gramos (float): Peso del material en gramos
        precio_kg (float): Precio por kilogramo en euros
    
    Retorna:
        float: Coste en euros
    """
    peso_kg = peso_gramos / 1000
    coste = peso_kg * precio_kg
    return coste


# FUNCIÓN 4: Calcular tiempo total de fabricación
def calcular_tiempo_fabricacion(tiempo_setup, tiempo_ejecucion, cantidad):
    """
    Calcula el tiempo total necesario para fabricar una cantidad de productos
    Usado en: Tabla operaciones_ruta, planificación de producción
    
    Parámetros:
        tiempo_setup (float): Tiempo de preparación en minutos
        tiempo_ejecucion (float): Tiempo de ejecución por unidad en minutos
        cantidad (int): Cantidad de productos a fabricar
    
    Retorna:
        float: Tiempo total en minutos
    """
    tiempo_total = tiempo_setup + (tiempo_ejecucion * cantidad)
    return tiempo_total


# FUNCIÓN 5: Calcular capacidad de almacén aprovechada
def calcular_ocupacion_almacen(volumen_productos, capacidad_ubicacion):
    """
    Calcula el porcentaje de ocupación de una ubicación de almacén
    Usado en: Tabla ubicaciones_almacen, optimización de espacio
    
    Parámetros:
        volumen_productos (float): Volumen total de productos en cm³
        capacidad_ubicacion (float): Capacidad máxima en cm³
    
    Retorna:
        float: Porcentaje de ocupación (0-100)
    """
    ocupacion = (volumen_productos / capacidad_ubicacion) * 100
    return ocupacion


# FUNCIÓN 6: Calcular coste total de orden de fabricación
def calcular_coste_orden(coste_materiales, tiempo_fabricacion_minutos, coste_hora_maquina):
    """
    Calcula el coste total de una orden de fabricación
    Usado en: Tabla ordenes_fabricacion, rentabilidad de productos
    
    Parámetros:
        coste_materiales (float): Coste de materiales en euros
        tiempo_fabricacion_minutos (float): Tiempo total en minutos
        coste_hora_maquina (float): Coste por hora de máquina en euros
    
    Retorna:
        float: Coste total en euros
    """
    tiempo_fabricacion_horas = tiempo_fabricacion_minutos / 60
    coste_maquina = tiempo_fabricacion_horas * coste_hora_maquina
    coste_total = coste_materiales + coste_maquina
    return coste_total
```

Imagina una **PYME valenciana de metalurgia** (nuestro nicho del ejercicio 001-002) que fabrica piezas mecanizadas. Vamos a calcular los costes de una orden de fabricación real:

**PRODUCTO:** Soporte de acero inoxidable para maquinaria industrial

```python
# =====================================================
# CASO PRÁCTICO: ORDEN DE FABRICACIÓN OF25-00001234
# Cliente: Talleres Mecánicos Valencia SL
# Producto: Soporte acero inoxidable 304
# Cantidad: 50 unidades
# =====================================================

print("=" * 60)
print("SISTEMA ERP - MÓDULO DE PRODUCCIÓN")
print("Cálculo de Costes de Orden de Fabricación")
print("=" * 60)

# PASO 1: Calcular volumen del producto
print("\n1. DIMENSIONES Y VOLUMEN DEL PRODUCTO")
longitud = 15.0  # cm
ancho = 10.0     # cm
altura = 3.0     # cm

volumen_unitario = calcular_volumen(longitud, ancho, altura)
print(f"   Dimensiones: {longitud} x {ancho} x {altura} cm")
print(f"   Volumen unitario: {volumen_unitario} cm³")

# PASO 2: Calcular peso de material necesario
print("\n2. MATERIAL NECESARIO")
densidad_acero_inox = 7.93  # g/cm³ (acero inoxidable 304)
peso_unitario = calcular_peso_material(volumen_unitario, densidad_acero_inox)
print(f"   Material: Acero inoxidable 304")
print(f"   Densidad: {densidad_acero_inox} g/cm³")
print(f"   Peso unitario: {peso_unitario:.2f} gramos")
print(f"   Peso unitario: {peso_unitario/1000:.3f} kg")

# PASO 3: Calcular coste de material
print("\n3. COSTE DE MATERIALES")
precio_acero_kg = 8.50  # €/kg
cantidad_fabricar = 50
peso_total_gramos = peso_unitario * cantidad_fabricar
coste_material_total = calcular_coste_material(peso_total_gramos, precio_acero_kg)
print(f"   Precio acero: {precio_acero_kg} €/kg")
print(f"   Cantidad a fabricar: {cantidad_fabricar} unidades")
print(f"   Peso total: {peso_total_gramos/1000:.2f} kg")
print(f"   COSTE MATERIALES: {coste_material_total:.2f} €")

# PASO 4: Calcular tiempo de fabricación
print("\n4. TIEMPO DE FABRICACIÓN")
tiempo_setup_torno = 30.0        # minutos (preparar torno CNC)
tiempo_mecanizado_unidad = 12.0  # minutos por pieza
tiempo_total_fabricacion = calcular_tiempo_fabricacion(
    tiempo_setup_torno, 
    tiempo_mecanizado_unidad, 
    cantidad_fabricar
)
print(f"   Tiempo setup: {tiempo_setup_torno} minutos")
print(f"   Tiempo mecanizado/unidad: {tiempo_mecanizado_unidad} minutos")
print(f"   TIEMPO TOTAL: {tiempo_total_fabricacion} minutos")
print(f"   TIEMPO TOTAL: {tiempo_total_fabricacion/60:.2f} horas")

# PASO 5: Calcular coste total de la orden
print("\n5. COSTE TOTAL DE LA ORDEN")
coste_hora_torno_cnc = 45.00  # €/hora
coste_total_orden = calcular_coste_orden(
    coste_material_total,
    tiempo_total_fabricacion,
    coste_hora_torno_cnc
)
coste_unitario = coste_total_orden / cantidad_fabricar
print(f"   Coste materiales: {coste_material_total:.2f} €")
print(f"   Coste máquina (torno CNC): {(tiempo_total_fabricacion/60)*coste_hora_torno_cnc:.2f} €")
print(f"   COSTE TOTAL ORDEN: {coste_total_orden:.2f} €")
print(f"   COSTE UNITARIO: {coste_unitario:.2f} €/unidad")

# PASO 6: Calcular ocupación en almacén
print("\n6. GESTIÓN DE ALMACÉN")
volumen_total_productos = volumen_unitario * cantidad_fabricar
capacidad_pallet = 120000  # cm³ (pallet estándar 120x80x12.5 cm)
ocupacion_pallet = calcular_ocupacion_almacen(volumen_total_productos, capacidad_pallet)
print(f"   Volumen total productos: {volumen_total_productos:.2f} cm³")
print(f"   Capacidad pallet estándar: {capacidad_pallet} cm³")
print(f"   Ocupación del pallet: {ocupacion_pallet:.2f}%")

if ocupacion_pallet <= 100:
    print(f"   ✓ Los 50 soportes caben en 1 pallet")
else:
    pallets_necesarios = int(ocupacion_pallet / 100) + 1
    print(f"   ⚠ Se necesitan {pallets_necesarios} pallets")

# RESUMEN EJECUTIVO PARA TABLA ordenes_fabricacion
print("\n" + "=" * 60)
print("RESUMEN - ORDEN DE FABRICACIÓN OF25-00001234")
print("=" * 60)
print(f"Producto: Soporte acero inox 304 ({longitud}x{ancho}x{altura}cm)")
print(f"Cantidad: {cantidad_fabricar} unidades")
print(f"Peso total: {peso_total_gramos/1000:.2f} kg")
print(f"Tiempo fabricación: {tiempo_total_fabricacion/60:.2f} horas")
print(f"Coste total: {coste_total_orden:.2f} €")
print(f"Coste unitario: {coste_unitario:.2f} €")
print(f"Precio venta recomendado: {coste_unitario * 1.6:.2f} € (margen 60%)")
print("=" * 60)

# BONUS: Simulación de inserción en base de datos (sin ejecutar)
print("\n7. DATOS PARA INSERTAR EN ERP_DATABASE")
print("   Esto se insertaría en las siguientes tablas:")
print(f"""
   -- Tabla: ordenes_fabricacion
   INSERT INTO ordenes_fabricacion (codigo, producto_id, cantidad, 
       fecha_inicio, fecha_fin_prevista, estado) 
   VALUES ('OF25-00001234', 1, {cantidad_fabricar}, 
       '2025-11-02', '2025-11-03', 'En proceso');
   
   -- Tabla: consumos_materiales  
   INSERT INTO consumos_materiales (codigo, orden_fabricacion_id, 
       producto_id, cantidad, fecha_consumo)
   VALUES ('CONS25-00001234', 1, 2, {peso_total_gramos/1000:.2f}, 
       '2025-11-02 08:30:00');
   
   -- Tabla: partes_trabajo
   INSERT INTO partes_trabajo (codigo, orden_fabricacion_id, 
       operacion_id, fecha_inicio, tiempo_real)
   VALUES ('PT25-00001234', 1, 1, '2025-11-02 08:00:00', 
       {tiempo_total_fabricacion:.2f});
""")
```

**Salida esperada del código anterior:**

```
============================================================
SISTEMA ERP - MÓDULO DE PRODUCCIÓN
Cálculo de Costes de Orden de Fabricación
============================================================

1. DIMENSIONES Y VOLUMEN DEL PRODUCTO
   Dimensiones: 15.0 x 10.0 x 3.0 cm
   Volumen unitario: 450.0 cm³

2. MATERIAL NECESARIO
   Material: Acero inoxidable 304
   Densidad: 7.93 g/cm³
   Peso unitario: 3568.50 gramos
   Peso unitario: 3.569 kg

3. COSTE DE MATERIALES
   Precio acero: 8.5 €/kg
   Cantidad a fabricar: 50 unidades
   Peso total: 178.43 kg
   COSTE MATERIALES: 1516.61 €

4. TIEMPO DE FABRICACIÓN
   Tiempo setup: 30.0 minutos
   Tiempo mecanizado/unidad: 12.0 minutos
   TIEMPO TOTAL: 630.0 minutos
   TIEMPO TOTAL: 10.50 horas

5. COSTE TOTAL DE LA ORDEN
   Coste materiales: 1516.61 €
   Coste máquina (torno CNC): 472.50 €
   COSTE TOTAL ORDEN: 1989.11 €
   COSTE UNITARIO: 39.78 €/unidad

6. GESTIÓN DE ALMACÉN
   Volumen total productos: 22500.00 cm³
   Capacidad pallet estándar: 120000 cm³
   Ocupación del pallet: 18.75%
   ✓ Los 50 soportes caben en 1 pallet

============================================================
RESUMEN - ORDEN DE FABRICACIÓN OF25-00001234
============================================================
Producto: Soporte acero inox 304 (15.0x10.0x3.0cm)
Cantidad: 50 unidades
Peso total: 178.43 kg
Tiempo fabricación: 10.50 horas
Coste total: 1989.11 €
Coste unitario: 39.78 €
Precio venta recomendado: 63.65 € (margen 60%)
============================================================


### **¿Cómo se integran estas funciones en nuestro ERP?**

**1. Módulo de Producción (Python/Flask):**
```python
# app/modules/produccion/calculos.py
from funciones_produccion import (
    calcular_volumen,
    calcular_peso_material,
    calcular_coste_material,
    calcular_tiempo_fabricacion,
    calcular_coste_orden
)

def crear_orden_fabricacion(producto_id, cantidad):
    # Obtener datos del producto desde la BD
    producto = db.query("SELECT * FROM productos WHERE id = ?", producto_id)
    
    # Calcular costes usando nuestras funciones
    volumen = calcular_volumen(
        producto.longitud, 
        producto.ancho, 
        producto.altura
    )
    
    peso = calcular_peso_material(volumen, producto.densidad)
    coste_material = calcular_coste_material(peso * cantidad, producto.precio_kg)
    
    # Obtener datos de la ruta de fabricación
    ruta = db.query("SELECT * FROM rutas_fabricacion WHERE producto_id = ?", producto_id)
    tiempo = calcular_tiempo_fabricacion(
        ruta.tiempo_setup,
        ruta.tiempo_ejecucion,
        cantidad
    )
    
    coste_total = calcular_coste_orden(
        coste_material,
        tiempo,
        producto.coste_hora_maquina
    )
    
    # Insertar en base de datos
    db.insert("INSERT INTO ordenes_fabricacion (...) VALUES (...)")
    
    return coste_total
```

**2. API REST para el Supervisor de IA:**
```python
# app/api/produccion.py
@app.route('/api/produccion/calcular-coste', methods=['POST'])
def api_calcular_coste_produccion():
    data = request.json
    coste = calcular_coste_orden(
        data['coste_materiales'],
        data['tiempo_fabricacion'],
        data['coste_hora_maquina']
    )
    return jsonify({'coste_total': coste})
```

**3. Supervisor de IA - Optimización:**
El supervisor de IA usaría estas funciones para:
- **Predecir costes** de producción antes de aceptar pedidos
- **Optimizar rutas** de fabricación comparando tiempos
- **Sugerir precios** basados en costes reales + margen objetivo
- **Alertar** cuando el coste real > coste estimado

### **Ventajas de usar funciones en el ERP:**

✅ **Consistencia:** Todos los módulos calculan igual  
✅ **Mantenimiento:** Cambias la fórmula en un solo sitio  
✅ **Testing:** Puedes probar cada función aisladamente  
✅ **Documentación:** Cada función explica qué hace  
✅ **Reutilización:** La misma función sirve para presupuestos, órdenes, análisis  

### **Aplicación al mercado valenciano (Ejercicio 001-002):**

Las **PYMES industriales valencianas** necesitan exactamente estas funciones:
- **Talleres metalúrgicos:** Calcular costes de mecanizado CNC
- **Fábricas de plásticos:** Calcular consumo de material en inyección
- **Industria alimentaria:** Calcular tiempos de producción y lotes
- **Impresión 3D:** Calcular volumen de filamento y tiempo de impresión

**Precio de venta del módulo:** Las funciones de producción justifican parte de los 2.500€ de la licencia ERP, porque permiten a la empresa:
- Calcular costes reales automáticamente
- Optimizar tiempos de producción
- Mejorar rentabilidad por producto
- Tomar decisiones basadas en datos

---

**Relación con ejercicios anteriores:**
- **001-001:** Diseñamos las tablas de producción → Ahora las usamos con funciones
- **001-002:** Identificamos clientes industriales → Estas funciones son para ellos
- **001-004:** Aprendemos funciones → Las aplicamos al ERP real

**El proyecto ERP completo = Base de datos (001-001) + Mercado (001-002) + Lógica de negocio (funciones como estas)**