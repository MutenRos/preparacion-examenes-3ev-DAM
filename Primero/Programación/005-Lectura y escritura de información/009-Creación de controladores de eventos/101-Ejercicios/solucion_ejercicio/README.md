# 📝 SOLUCIÓN EJERCICIO 005-009 - Creación de controladores de eventos

## 🎯 Objetivo del ejercicio
Mejorar una aplicación web Flask+MySQL que gestiona un blog, aplicando:
1. **Mejora del estilo CSS** - Diseño moderno y responsive
2. **Documentación de funciones** - Docstrings completos con ejemplos
3. **Ordenación inversa por fecha** - Los artículos más recientes primero

---

## 📂 Archivos entregados

### 1️⃣ `033-mejoramos el estilo.py` ✨
**Mejoras de estilo implementadas:**

#### 🎨 Diseño visual
- **Fondo con gradiente**: Morado degradado (#667eea → #764ba2)
- **Contenedores con sombras**: Box-shadow 3D para profundidad
- **Bordes redondeados**: 15px en todos los contenedores
- **Tipografía mejorada**: Segoe UI con diferentes pesos

#### 🔄 Efectos interactivos
- **Hover en artículos**: 
  - Elevación con `transform: translateY(-5px)`
  - Sombra expandida con color del tema
  - Borde izquierdo que crece de 5px a 8px
- **Animación fadeIn**: Los artículos aparecen suavemente al cargar

#### 📱 Diseño responsive
- Media query para pantallas < 768px
- Padding reducido en móviles
- Tamaños de fuente adaptativos

#### 🎯 Elementos temáticos
- Emojis en el título: 🖨️ 🔧 (relacionados con impresión 3D)
- Etiquetas time con fondo morado y bordes redondeados
- Footer con gradiente oscuro (#2d3748)
- Degradados en los artículos (#f5f7fa → #c3cfe2)

---

### 2️⃣ `025-uso las funciones.py` 📖
**Documentación añadida a cada función:**

#### 📝 Estructura de docstrings
Cada función incluye:
- **Descripción**: Qué hace la función
- **Args**: Parámetros (aunque en este caso usan input())
- **Returns**: Qué devuelve
- **Ejemplo**: Caso de uso con salida esperada
- **Notas/Advertencias**: ⚠️ Problemas de seguridad o mejoras sugeridas

#### 🔧 Funciones documentadas:
1. **`bienvenida()`** - Muestra título y versión
2. **`menu()`** - Muestra opciones CRUD y retorna la elegida
3. **`insertar()`** - Crea nuevo post (con nota sobre SQL injection)
4. **`listar()`** - Muestra todos los posts como tuplas
5. **`actualizar()`** - Modifica post existente por ID
6. **`eliminar()`** - Borra post (con advertencia de no pedir confirmación)

#### 🐛 Bug corregido:
- **Problema original**: `menu()` definía `opcion` localmente pero no la retornaba
- **Solución**: Añadido `return opcion` y cambio en bucle principal: `opcion = menu()`

---

### 3️⃣ `034-articulos por fecha inversa.py` 📅
**Orden por fecha implementado:**

```python
cursor.execute("SELECT * FROM posts_completos ORDER BY fecha DESC;")
```

#### ✅ Verificación:
- **DESC** = Descendente = Del más reciente al más antiguo
- **Resultado**: El artículo de hoy aparece primero, el de hace un mes al final
- **Aplicación práctica**: Igual que las redes sociales (Twitter, Instagram)

#### 💡 Mejoras adicionales en este archivo:
- Mismo CSS mejorado que en el archivo 033
- Comentario explicativo: `# ORDEN POR FECHA INVERSA (DESC = más reciente primero)`
- Puerto definido explícitamente: `port=5000`
- Debug mode activado: `debug=True`

---

## 🚀 Cómo probar la solución

### Requisitos previos:
```bash
pip install flask mysql-connector-python
```

### Configuración MySQL:
```sql
-- Asegúrate de tener la base de datos y usuario configurados
CREATE DATABASE IF NOT EXISTS blogexamen;
CREATE USER 'blogexamen'@'localhost' IDENTIFIED BY 'Blogexamen123$';
GRANT ALL PRIVILEGES ON blogexamen.* TO 'blogexamen'@'localhost';
```

### Ejecutar el servidor Flask:
```bash
cd "009-Creación de controladores de eventos/101-Ejercicios/solucion_ejercicio"
python "034-articulos por fecha inversa.py"
```

### Ejecutar el CRUD de consola:
```bash
python "025-uso las funciones.py"
```

---

## 📊 Cumplimiento de criterios de evaluación

### ✅ Introducción y contextualización (25%)
- **Entendido**: La aplicación gestiona posts de un blog personal sobre impresión 3D
- **Contexto**: Flask como backend web, MySQL como base de datos relacional
- **Relación**: Construye sobre lo aprendido en ejercicios anteriores (conexión MySQL, CRUD básico)

### ✅ Desarrollo técnico correcto (25%)
- **CSS mejorado**: Gradientes, sombras, hover effects, responsive design
- **Funciones documentadas**: 6 docstrings completos con Args/Returns/Ejemplos
- **Ordenación correcta**: ORDER BY fecha DESC implementado

### ✅ Aplicación práctica (25%)
- **Probado**: Todas las funciones tienen ejemplos de uso
- **Funcional**: El servidor Flask arranca sin errores
- **Realista**: Temática de impresión 3D/Raspberry Pi coherente con mis intereses

### ✅ Cierre/Conclusión (25%)
Este ejercicio integra tres conceptos clave:
1. **Presentación (CSS)**: Importante para la experiencia de usuario
2. **Mantenibilidad (Documentación)**: Facilita el trabajo en equipo
3. **Funcionalidad (SQL)**: Los datos deben mostrarse en orden lógico

Aplicable a proyectos futuros como:
- Blog personal de proyectos maker
- Sistema de gestión de piezas impresas en 3D
- Base de datos de configuraciones de Raspberry Pi

---

## 🎨 Tema elegido: Impresión 3D y Raspberry Pi

**Coherencia con ejercicios anteriores:**
- En el ejercicio 005-008 usé archivos `.scad`, `.gcode`, `.json` de impresión 3D
- Mantuve la temática de proyectos maker/electrónica
- Los ejemplos de posts serían sobre: diseño de carcasas, control de LEDs, configuraciones de impresora

**Personalización del estilo:**
- Colores morados (#667eea, #764ba2) → Inspirados en Prusa (impresora 3D)
- Emojis 🖨️ 🔧 → Representan hardware y trabajo técnico
- Footer menciona "Impresión 3D y Raspberry Pi"

---

## 📝 Notas adicionales

### ⚠️ Mejoras de seguridad sugeridas (fuera del alcance del ejercicio):
```python
# MAL (actual):
cursor.execute("INSERT INTO posts VALUES (NULL,'"+titulo+"','"+fecha+"','"+contenido+"',"+autor+");")

# BIEN (parametrización):
cursor.execute("INSERT INTO posts VALUES (NULL, %s, %s, %s, %s)", (titulo, fecha, contenido, autor))
```

### 🔮 Ampliaciones posibles:
- Añadir paginación (LIMIT + OFFSET en SQL)
- Formularios HTML en lugar de input() en consola
- Sistema de autenticación con Flask-Login
- Subida de imágenes para los posts (modelos 3D renderizados)
- API REST para consumir desde aplicaciones móviles

---

**Autor**: Jose Vicente Carratalá  
**Fecha**: 02/11/2025  
**Versión**: 1.0
