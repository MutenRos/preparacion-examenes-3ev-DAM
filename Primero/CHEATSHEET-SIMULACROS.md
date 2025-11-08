# 📝 CHEATSHEET SIMULACROS DE EXAMEN - DAM PRIMERO

**Versión:** 1.0 - Basado en casos reales de examen  
**Actualizado:** Noviembre 2025  
**Enfoque:** Guía rápida para aprobar exámenes prácticos

---

## 📋 ÍNDICE

### 📚 POR ASIGNATURA

**🎨 LENGUAJES DE MARCAS**
1. [📄 Simulacro: CV Profesional con Flexbox](#-simulacro-cv-profesional-con-flexbox-lenguajes-de-marcas)

**🗄️ BASES DE DATOS**
2. [📝 Simulacro: Blog con Vista y LEFT JOIN](#-simulacro-blog-con-vista-y-left-join-bases-de-datos)

**💻 PROGRAMACIÓN**
3. [🔧 Simulacro: CRUD Blog en Consola](#-simulacro-crud-blog-en-consola-programación)

**🌐 PROYECTO INTERMODULAR (Web Full Stack)**
4. [� Simulacro: Tienda Online con SQLite](#️-simulacro-tienda-online-con-sqlite-proyecto-intermodular)
5. [💼 Simulacro: Portafolio con MySQL](#-simulacro-portafolio-con-mysql-proyecto-intermodular)
6. [📰 Simulacro: Blog Relacional MySQL](#-simulacro-blog-relacional-mysql-proyecto-intermodular)

**🖥️ SISTEMAS INFORMÁTICOS**
7. [� Simulacro: Instalación Debian Linux + LAMP](#-simulacro-instalación-debian-linux--lamp-sistemas-informáticos)

### 📑 RECURSOS GENERALES
- [⚡ Patrón General de Examen](#-patrón-general-de-examen)
- [✅ Checklist Pre-Examen](#-checklist-pre-examen)
- [🚫 Errores Comunes](#-errores-comunes)
- [⏱️ Gestión del Tiempo](#️-gestión-del-tiempo)

---

## ⚡ PATRÓN GENERAL DE EXAMEN

### Estructura típica (2 horas)

```
⏰ Distribución tiempo recomendada:
├── 15 min → Base de datos (crear BD, tablas, usuario, datos)
├── 30 min → Python + Flask (conexión, rutas, lógica)
├── 45 min → HTML + CSS (diseño, estructura, estilos)
├── 20 min → Pruebas y depuración
└── 10 min → Documentación y comentarios
```

### Pasos OBLIGATORIOS en TODO examen

**1. Crear base de datos y usuario**
```sql
-- SIEMPRE ejecutar en MySQL Workbench PRIMERO
CREATE DATABASE nombre_examen;
CREATE USER 'nombre_examen'@'localhost' IDENTIFIED BY 'Password_2025!';
GRANT ALL PRIVILEGES ON nombre_examen.* TO 'nombre_examen'@'localhost';
FLUSH PRIVILEGES;
USE nombre_examen;
```

**2. Crear tabla(s) con estructura correcta**
```sql
-- IMPORTANTE: AUTO_INCREMENT en ID
CREATE TABLE productos (
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(150) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    imagen VARCHAR(255),
    precio DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB;
```

**3. Insertar datos de prueba**
```sql
-- MÍNIMO 3-5 registros para verificar que funciona
INSERT INTO productos (nombre, descripcion, imagen, precio) VALUES
('Raspberry Pi 4 8GB', 'Placa desarrollo con 8GB RAM', 'raspberry-pi-4.jpg', 89.99),
('Arduino Uno R3', 'Microcontrolador para proyectos', 'arduino-uno.jpg', 24.95),
('ESP32 Dev Kit', 'WiFi + Bluetooth integrado', 'esp32.jpg', 12.50),
('Sensor DHT22', 'Temperatura y humedad digital', 'dht22.jpg', 5.99),
('Filamento PLA 1kg', 'Bobina PLA para impresora 3D', 'pla-black.jpg', 18.00);
```

**4. Estructura de archivos Python + Flask**
```
proyecto_examen/
├── app.py              ← TU CÓDIGO AQUÍ
├── static/             ← Si necesitas CSS o imágenes
│   ├── css/
│   │   └── style.css
│   └── imagenes/
└── templates/          ← Si usas plantillas (no en examen básico)
    └── base.html
```

**5. Template básico Python + Flask**
```python
import mysql.connector  # Si usas MySQL
# import sqlite3        # Si usas SQLite
from flask import Flask

app = Flask(__name__)

# CONEXIÓN BASE DE DATOS
def conectar():
    return mysql.connector.connect(
        host="localhost",
        user="nombre_examen",
        password="Password_2025!",
        database="nombre_examen"
    )

@app.route('/')
def inicio():
    # 1. Conectar BD
    conexion = conectar()
    cursor = conexion.cursor()
    
    # 2. Consultar datos
    cursor.execute("SELECT * FROM tabla")
    registros = cursor.fetchall()
    
    # 3. Generar HTML
    html = """<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Título Examen</title>
    <style>
        /* Estilos CSS aquí */
    </style>
</head>
<body>
    <!-- Contenido aquí -->
</body>
</html>
"""
    
    # 4. Cerrar conexión
    cursor.close()
    conexion.close()
    
    return html

if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=5000)
```

---

## � SIMULACRO: CV PROFESIONAL CON FLEXBOX (Lenguajes de Marcas)

### 🎯 Objetivo
Crear un **Currículum Vitae** profesional en formato A4 usando **HTML5 + CSS3 con Flexbox**. Este simulacro aparece en `Lenguajes de marcas/002-Utilización de lenguajes de marcas en entornos web/009-Simulacro examen 1`.

### 📊 Conceptos clave
- **Diseño con Flexbox** (layout de 2 columnas)
- **Tipografía personalizada** (@font-face)
- **Imagen de fondo** con background-size
- **Formato A4** (210mm x 297mm)
- **Transformaciones CSS** (translate, border-radius 50%)
- **Text-transform** (uppercase, capitalize)
- **Diseño imprimible**

---

### 🎨 CÓDIGO COMPLETO

**Archivo: `cv.html`**

```html
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currículum Vitae</title>
    <style>
        /* Importar fuentes personalizadas */
        @font-face {
            font-family: "LemonBold";
            src: url(LEMONMILK-Bold.otf);
        }
        @font-face {
            font-family: "LemonRegular";
            src: url(LEMONMILK-Light.otf);
        }
        
        /* Tamaño A4 y configuración general */
        main {
            width: 210mm;
            height: 297mm;
            margin: auto;
            font-family: LemonRegular;
            font-size: 10px;
            text-align: justify;
            
            /* Flexbox para 2 columnas */
            display: flex;
            flex-direction: row;
            align-items: top;
            justify-content: center;
            
            /* Imagen de fondo */
            background: url(fondocv.jpg) no-repeat center center;
            background-size: 100% 100%;
            
            gap: 130px;
            padding: 50px;
            color: #5c105a;
        }
        
        /* Encabezados en negrita */
        h1, h2, h3, h4 {
            font-family: LemonBold;
        }
        
        /* Columna izquierda (1/3 del espacio) */
        #izquierda {
            flex: 1;
        }
        
        /* Columna derecha (2/3 del espacio) */
        #derecha {
            flex: 2;
            padding-left: 20px;
        }
        
        /* Foto de perfil circular */
        #izquierda img {
            border-radius: 50%;
            border: 5px solid white;
            transform: translate(69px, 63px);
            width: 189px;
        }
        
        /* Lista sin bullets */
        #izquierda > ul {
            list-style: none;
            padding: 0;
            margin-top: 150px;
            margin-bottom: 50px;
        }
        
        /* Tamaños de encabezados */
        h1 {
            font-size: 35px;
            text-align: center;
            text-transform: uppercase;
            margin-top: 10px;
        }
        
        h2 {
            font-size: 12px;
            text-align: center;
            text-transform: uppercase;
            margin-bottom: 120px;
        }
        
        h3 {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 25px;
        }
    </style>
</head>
<body>
    <main>
        <!-- Columna izquierda: datos personales -->
        <div id="izquierda">
            <img src="josevicente.jpg" alt="Foto de perfil" width="150">
            
            <ul>
                <li>Fecha de nacimiento: 14/04/1978</li>
                <li>Edad: 47</li>
                <li>Nacionalidad: Española</li>
            </ul>
            
            <article>
                <h3>Contacto</h3>
                <p>Dirección: Calle Falsa 123, Ciudad, País</p>
                <p>Teléfono: +34 123 456 789</p>
                <p>Email: jose@example.com</p>
            </article>
            
            <article>
                <h3>Habilidades</h3>
                <ul>
                    <li>HTML5, CSS3, JavaScript</li>
                    <li>Diseño responsivo</li>
                    <li>Gestión de proyectos</li>
                </ul>
            </article>
            
            <article>
                <h3>Idiomas</h3>
                <ul>
                    <li>Español: Nativo</li>
                    <li>Inglés: Avanzado</li>
                    <li>Francés: Intermedio</li>
                </ul>
            </article>
        </div>
        
        <!-- Columna derecha: información profesional -->
        <div id="derecha">
            <h1>Jose Vicente <br>Carratalá Sanchis</h1>
            <h2>Profesor, desarrollador y diseñador</h2>
            
            <h3>Sobre mi</h3>
            <p>Soy un profesional con más de 20 años de experiencia en el desarrollo web y la enseñanza. Me apasiona crear soluciones innovadoras y compartir mis conocimientos con otros.</p>
            
            <h3>Formación Académica</h3>
            <ul>
                <li>Grado en Ingeniería Informática - Universidad de Valencia (2000-2004)</li>
                <li>Máster en Desarrollo Web - Universidad Politécnica de Madrid (2005-2006)</li>
            </ul>
            
            <h3>Experiencia Profesional</h3>
            <ul>
                <li>Profesor de Desarrollo Web - Instituto Tecnológico de Valencia (2010-presente)</li>
                <li>Desarrollador Web Freelance (2006-2010)</li>
            </ul>
            
            <h3>Proyectos Destacados</h3>
            <ul>
                <li>Desarrollo de una plataforma de e-learning para una universidad local.</li>
                <li>Diseño y desarrollo de sitios web para pequeñas y medianas empresas.</li>
            </ul>
            
            <h3>Referencias</h3>
            <p>Disponibles a solicitud.</p>
        </div>
    </main>
</body>
</html>
```

---

### 📝 CONCEPTOS EVALUADOS

✅ **Flexbox** (display: flex, flex-direction, flex)  
✅ **@font-face** (tipografía personalizada)  
✅ **background-size** (ajustar imagen de fondo)  
✅ **transform** (translate para posicionar)  
✅ **border-radius: 50%** (imagen circular)  
✅ **text-transform** (uppercase, mayúsculas)  
✅ **Unidades de medida** (mm para A4)  
✅ **Flexbox columnas** (flex: 1 vs flex: 2)  
✅ **gap** (espaciado entre columnas)  
✅ **list-style: none** (quitar bullets)  
✅ **text-align: justify/center**  
✅ **Semántica HTML5** (main, article, section)

---

### 💡 TIPS PARA EL EXAMEN

**1. Estructura Flexbox básica:**
```css
main {
    display: flex;
    flex-direction: row;  /* Horizontal */
}
#izquierda { flex: 1; }  /* 1 parte */
#derecha { flex: 2; }    /* 2 partes (doble ancho) */
```

**2. Imagen circular:**
```css
img {
    border-radius: 50%;
    width: 200px;
    height: 200px;
    object-fit: cover;  /* Evita deformación */
}
```

**3. Fuentes personalizadas:**
```css
@font-face {
    font-family: "MiFuente";
    src: url(archivo.otf);
}
body { font-family: MiFuente; }
```

**4. Fondo de página A4:**
```css
background: url(imagen.jpg) no-repeat center center;
background-size: cover;  /* O 100% 100% para estirar */
```

---

### ⏱️ TIEMPO ESTIMADO

- **HTML estructura:** 10 min
- **CSS Flexbox:** 15 min
- **Fuentes y colores:** 10 min
- **Imagen circular:** 5 min
- **Ajustes finales:** 10 min
- **Total:** ~50 minutos

---

## �🗄️ SIMULACRO 1: Tienda Online con SQLite

### Enunciado típico

> Crear una tienda online que muestre productos desde una base de datos SQLite.
> Debe incluir: imagen, nombre, descripción, precio y botón "Añadir al carrito".

### Paso 1: Base de datos (SQLite no necesita usuario)

```python
import sqlite3

# Crear BD y tabla (ejecutar UNA sola vez)
bd = sqlite3.connect('tiendaonline.db')
cursor = bd.cursor()

cursor.execute('''
CREATE TABLE IF NOT EXISTS productos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    descripcion TEXT,
    imagen TEXT,
    precio REAL NOT NULL
)
''')

# Insertar datos de prueba
productos_prueba = [
    ('Portátil Lenovo IdeaPad', 'Ryzen 5, 16GB RAM, SSD 512GB', 'lenovo.jpg', 799.99),
    ('Monitor LG 27"', '4K UHD, 60Hz, IPS', 'monitor-lg.jpg', 349.00),
    ('Teclado Mecánico', 'RGB, Switch Blue, USB', 'teclado.jpg', 89.95),
    ('Ratón Logitech MX', 'Inalámbrico, DPI ajustable', 'raton.jpg', 79.99),
    ('Webcam Logitech C920', '1080p Full HD', 'webcam.jpg', 89.00)
]

cursor.executemany(
    'INSERT INTO productos (nombre, descripcion, imagen, precio) VALUES (?, ?, ?, ?)',
    productos_prueba
)

bd.commit()
bd.close()
print("✅ Base de datos creada con 5 productos")
```

### Paso 2: Aplicación Flask completa

```python
import sqlite3
from flask import Flask

app = Flask(__name__)

@app.route('/')
def listar_productos():
    # Conectar a BD
    bd = sqlite3.connect('./tiendaonline.db')
    cursor = bd.cursor()
    
    # Obtener productos
    cursor.execute('SELECT * FROM productos')
    productos = cursor.fetchall()
    
    # Cerrar conexión
    bd.close()
    
    # Generar HTML
    html = '''<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online de Tecnología</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            min-height: 100vh;
        }
        
        header {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px 20px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        
        h1 {
            color: #667eea;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        
        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 15px;
        }
        
        nav ul li a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        nav ul li a:hover {
            color: #667eea;
        }
        
        .product-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .product-item {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .product-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
        }
        
        .product-item img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .product-item h3 {
            color: #333;
            padding: 15px 20px 10px;
            font-size: 1.3rem;
        }
        
        .product-item p {
            color: #666;
            padding: 0 20px;
            margin-bottom: 15px;
            line-height: 1.5;
        }
        
        .price {
            color: #667eea;
            font-size: 1.8rem;
            font-weight: bold;
            padding: 0 20px 15px;
        }
        
        button {
            width: calc(100% - 40px);
            margin: 0 20px 20px;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        button:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }
        
        button:active {
            transform: scale(0.98);
        }
        
        footer {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            margin-top: 40px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        footer p {
            color: #666;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>🛒 Tienda Online de Tecnología</h1>
        <nav>
            <ul>
                <li><a href="/">Inicio</a></li>
                <li><a href="/productos">Productos</a></li>
                <li><a href="/carrito">Carrito</a></li>
                <li><a href="/contacto">Contacto</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="product-list">
'''
    
    # Generar tarjeta por cada producto
    for producto in productos:
        id_prod, nombre, descripcion, imagen, precio = producto
        html += f'''
        <div class="product-item">
            <img src="/static/imagenes/{imagen}" alt="{nombre}" 
                 onerror="this.style.background='linear-gradient(135deg, #667eea 0%, #764ba2 100%)'; this.alt='Sin imagen'">
            <h3>{nombre}</h3>
            <p>{descripcion}</p>
            <div class="price">{precio:.2f}€</div>
            <button onclick="alert('Producto {nombre} añadido al carrito')">
                🛒 Añadir al carrito
            </button>
        </div>
'''
    
    html += '''
    </div>
    
    <footer>
        <p>&copy; 2025 Tienda Online de Tecnología</p>
        <p>Proyecto Intermodular - DAM Primero</p>
        <p>Simulacro de Examen</p>
    </footer>
</body>
</html>
'''
    
    return html

if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=5000)
```

### Conceptos evaluados

✅ Conexión SQLite  
✅ Consulta SELECT  
✅ Iteración sobre resultados (for loop)  
✅ String interpolation con f-strings  
✅ HTML válido (DOCTYPE, head, body)  
✅ CSS Grid para layout responsive  
✅ Gradientes CSS (background: linear-gradient)  
✅ Efectos hover (transform, box-shadow)  
✅ Manejo de imágenes (onerror, object-fit)  
✅ Formato de precio (:.2f)

---

## 💼 SIMULACRO 2: Portafolio con MySQL

### Enunciado típico

> Crear un portafolio web dinámico que muestre proyectos desde MySQL.
> Incluir: título, descripción, imagen, enlace URL, diseño moderno tipo tarjetas.

### Paso 1: Base de datos MySQL

```sql
-- 1. Crear BD y usuario
CREATE DATABASE portafolio;
CREATE USER 'portafolio'@'localhost' IDENTIFIED BY 'Portafolio_2025!';
GRANT ALL PRIVILEGES ON portafolio.* TO 'portafolio'@'localhost';
FLUSH PRIVILEGES;
USE portafolio;

-- 2. Crear tabla
CREATE TABLE portafolio (
    Identificador INT NOT NULL AUTO_INCREMENT,
    titulo VARCHAR(150) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    imagen VARCHAR(255),
    video VARCHAR(255),
    url VARCHAR(255),
    PRIMARY KEY (Identificador)
) ENGINE=InnoDB;

-- 3. Insertar proyectos de ejemplo
INSERT INTO portafolio (titulo, descripcion, imagen, url) VALUES
('Sistema de Blog', 'Blog interactivo con Flask y MySQL, CRUD completo', 'blog.jpg', 'https://github.com/usuario/blog'),
('Dashboard IoT', 'Panel de control para Raspberry Pi con sensores', 'dashboard.jpg', 'https://github.com/usuario/iot'),
('Tienda Online', 'E-commerce con carrito y pasarela de pago', 'tienda.jpg', 'https://github.com/usuario/tienda'),
('Gestor de Tareas', 'App de productividad con recordatorios', 'tareas.jpg', 'https://github.com/usuario/tareas'),
('Portfolio Personal', 'Web responsive con animaciones CSS', 'portfolio.jpg', 'https://github.com/usuario/portfolio');
```

### Paso 2: Aplicación Flask con diseño avanzado

```python
import base64
import mysql.connector
from flask import Flask

app = Flask(__name__)

# SVG placeholder si falta imagen (TRUCO EXAMEN: evita errores 404)
svg_placeholder = """
<svg xmlns='http://www.w3.org/2000/svg' width='1200' height='800' viewBox='0 0 1200 800'>
  <defs>
    <linearGradient id='g' x1='0' y1='0' x2='1' y2='1'>
      <stop offset='0%' stop-color='#132020'/>
      <stop offset='100%' stop-color='#102020'/>
    </linearGradient>
    <pattern id='grid' width='40' height='40' patternUnits='userSpaceOnUse'>
      <path d='M40 0 L0 0 0 40' fill='none' stroke='#2a3b3b' stroke-width='1'/>
    </pattern>
  </defs>
  <rect width='1200' height='800' fill='url(#g)'/>
  <rect width='1200' height='800' fill='url(#grid)' opacity='.2'/>
  <text x='50%' y='50%' dominant-baseline='middle' text-anchor='middle'
        font-family='Arial' font-size='34' fill='#cfe7e3'>Sin imagen</text>
</svg>
"""
svg_b64 = base64.b64encode(svg_placeholder.encode("utf-8")).decode("ascii")
PLACEHOLDER_IMG = f"data:image/svg+xml;base64,{svg_b64}"

def conectar():
    return mysql.connector.connect(
        host="localhost",
        user="portafolio",
        password="Portafolio_2025!",
        database="portafolio"
    )

@app.route("/")
def inicio():
    conexion = conectar()
    cursor = conexion.cursor()
    cursor.execute("SELECT * FROM portafolio")
    proyectos = cursor.fetchall()
    cursor.close()
    conexion.close()
    
    html = f"""<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Portafolio | Jose Vicente Carratalá</title>
  <style>
    /* ===== Reset ===== */
    *, *::before, *::after {{ box-sizing: border-box; }}
    html, body {{ height: 100%; margin: 0; }}
    
    /* ===== Variables CSS ===== */
    :root {{
      --bg: #0f1717;
      --bg-soft: #111d1d;
      --card: rgba(20, 32, 32, 0.8);
      --edge: rgba(255, 255, 255, 0.08);
      --text: #e2e8e8;
      --muted: #a7b7b7;
      --accent: #87f0d6;
      --ring: #2ee6b9;
      --shadow: 0 10px 30px rgba(0, 0, 0, 0.35), 0 2px 8px rgba(0, 0, 0, 0.2);
      --shadow-lg: 0 18px 40px rgba(0, 0, 0, 0.45);
      --radius: 16px;
    }}
    
    body {{
      background: radial-gradient(1200px 800px at 12% -10%, #112020 0%, var(--bg) 60%) fixed;
      color: var(--text);
      font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
      line-height: 1.5;
    }}
    
    .wrap {{ max-width: 1200px; margin: 0 auto; padding: 24px; }}
    
    /* ===== Header ===== */
    header {{ text-align: center; }}
    h1 {{
      margin: 0 0 6px;
      font-size: clamp(28px, 3vw, 40px);
      font-weight: 800;
      letter-spacing: 0.3px;
      text-shadow: 0 1px 0 rgba(0, 0, 0, 0.25);
    }}
    h2 {{
      margin: 0;
      font-weight: 500;
      color: var(--muted);
    }}
    .ribbon {{
      height: 4px;
      margin: 18px auto 28px;
      width: min(260px, 60%);
      background: linear-gradient(90deg, transparent, var(--ring), transparent);
      border-radius: 999px;
      filter: blur(0.5px);
    }}
    
    /* ===== Toolbar ===== */
    .toolbar {{
      display: flex;
      gap: 12px;
      align-items: center;
      justify-content: flex-end;
      margin-bottom: 16px;
    }}
    .chip {{
      padding: 6px 10px;
      border: 1px solid var(--edge);
      border-radius: 999px;
      background: rgba(255, 255, 255, 0.02);
      color: var(--muted);
      font-size: 13px;
    }}
    
    /* ===== Grid de proyectos ===== */
    main.grid {{
      display: grid;
      gap: 22px;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    }}
    
    .card {{
      background: var(--card);
      border: 1px solid var(--edge);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      overflow: hidden;
      position: relative;
      transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    }}
    
    .card::after {{
      content: "";
      position: absolute;
      inset: 0;
      pointer-events: none;
      border-radius: inherit;
      background: linear-gradient(180deg, transparent, rgba(46, 230, 185, 0.18), transparent);
      opacity: 0;
      transition: opacity 0.25s ease;
    }}
    
    .card:hover {{
      transform: translateY(-2px);
      box-shadow: var(--shadow-lg);
      border-color: rgba(46, 230, 185, 0.25);
    }}
    
    .card:hover::after {{
      opacity: 1;
    }}
    
    .thumb {{
      width: 100%;
      aspect-ratio: 16/10;
      object-fit: cover;
      display: block;
      background: #0c1414;
    }}
    
    .content {{
      padding: 14px 16px 18px;
    }}
    
    .content h3 {{
      margin: 2px 0 8px;
      font-size: 18px;
      line-height: 1.25;
    }}
    
    .content p {{
      margin: 0;
      color: var(--muted);
      font-size: 14px;
      min-height: 2.6em;
    }}
    
    .link {{
      display: inline-block;
      margin-top: 12px;
      padding: 6px 12px;
      background: rgba(135, 240, 214, 0.1);
      border: 1px solid rgba(135, 240, 214, 0.3);
      border-radius: 6px;
      color: var(--accent);
      text-decoration: none;
      font-size: 13px;
      transition: background 0.2s, border-color 0.2s;
    }}
    
    .link:hover {{
      background: rgba(135, 240, 214, 0.15);
      border-color: rgba(135, 240, 214, 0.5);
    }}
    
    /* ===== Footer ===== */
    footer {{
      text-align: center;
      margin-top: 40px;
      padding: 20px;
      color: var(--muted);
      font-size: 14px;
    }}
    
    /* ===== Responsive ===== */
    @media (max-width: 600px) {{
      .wrap {{ padding: 16px; }}
      h1 {{ font-size: 24px !important; }}
      main.grid {{ grid-template-columns: 1fr; }}
    }}
  </style>
</head>
<body>
  <div class="wrap">
    <header>
      <h1>Jose Vicente Carratalá Sanchis</h1>
      <h2>Desarrollador Full Stack | DAM 2025</h2>
      <div class="ribbon"></div>
    </header>
    
    <div class="toolbar">
      <span class="chip">🚀 {len(proyectos)} Proyectos</span>
      <span class="chip">💼 Full Stack</span>
    </div>
    
    <main class="grid">
"""
    
    # Generar tarjeta por cada proyecto
    for proyecto in proyectos:
        id_p, titulo, desc, imagen, video, url = proyecto
        img_src = f"/static/imagenes/{imagen}" if imagen else PLACEHOLDER_IMG
        url_link = url if url else "#"
        
        html += f"""
      <article class="card" tabindex="0">
        <img src="{img_src}" alt="{titulo}" class="thumb"
             onerror="this.src='{PLACEHOLDER_IMG}'">
        <div class="content">
          <h3>{titulo}</h3>
          <p>{desc}</p>
          <a href="{url_link}" class="link" target="_blank" rel="noopener">
            Ver proyecto →
          </a>
        </div>
      </article>
"""
    
    html += """
    </main>
    
    <footer>
      <p>&copy; 2025 Jose Vicente Carratalá Sanchis | DAM Primero</p>
      <p>Proyecto Intermodular - Simulacro Examen</p>
    </footer>
  </div>
</body>
</html>
"""
    
    return html

if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=5000)
```

### Conceptos evaluados

✅ Conexión MySQL con credenciales  
✅ SVG inline con Base64 (placeholder avanzado)  
✅ CSS Variables (--bg, --accent, etc.)  
✅ Grid responsive (auto-fit, minmax)  
✅ Pseudo-elementos (::after para overlay)  
✅ Transiciones suaves (transform, opacity)  
✅ Backdrop effects (radial-gradient)  
✅ Accesibilidad (tabindex, alt, aria)  
✅ Error handling en imágenes (onerror)  
✅ Diseño moderno tipo Glassmorphism

---

## 📰 SIMULACRO 3: Blog Completo

### Enunciado típico

> Sistema de blog con autores, categorías y entradas.
> Mostrar: título, autor, fecha, categoría, extracto.
> Debe tener navegación, buscador y estadísticas.

### Paso 1: Base de datos relacional

```sql
CREATE DATABASE blog2526;
CREATE USER 'blog2526'@'localhost' IDENTIFIED BY 'Blog_2025!';
GRANT ALL PRIVILEGES ON blog2526.* TO 'blog2526'@'localhost';
FLUSH PRIVILEGES;
USE blog2526;

-- Tabla autores
CREATE TABLE autores (
    id_autor INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    bio TEXT,
    PRIMARY KEY (id_autor)
) ENGINE=InnoDB;

-- Tabla categorías
CREATE TABLE categorias (
    id_categoria INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50) UNIQUE NOT NULL,
    descripcion VARCHAR(255),
    PRIMARY KEY (id_categoria)
) ENGINE=InnoDB;

-- Tabla entradas
CREATE TABLE entradas (
    id_entrada INT NOT NULL AUTO_INCREMENT,
    titulo VARCHAR(200) NOT NULL,
    contenido TEXT NOT NULL,
    fecha_publicacion DATE NOT NULL,
    id_autor INT NOT NULL,
    id_categoria INT NOT NULL,
    visitas INT DEFAULT 0,
    estado VARCHAR(20) DEFAULT 'publicado',
    PRIMARY KEY (id_entrada),
    FOREIGN KEY (id_autor) REFERENCES autores(id_autor),
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria),
    INDEX idx_fecha (fecha_publicacion),
    INDEX idx_estado (estado)
) ENGINE=InnoDB;

-- Insertar datos de prueba
INSERT INTO autores (nombre, email, bio) VALUES
('Ana García', 'ana@blog.com', 'Desarrolladora Full Stack especializada en Python'),
('Carlos Ruiz', 'carlos@blog.com', 'Experto en bases de datos y optimización'),
('María López', 'maria@blog.com', 'Diseñadora UX/UI y Frontend Developer');

INSERT INTO categorias (nombre, descripcion) VALUES
('Programación', 'Tutoriales y guías de desarrollo'),
('Bases de Datos', 'SQL, NoSQL y optimización'),
('Frontend', 'HTML, CSS, JavaScript y frameworks');

INSERT INTO entradas (titulo, contenido, fecha_publicacion, id_autor, id_categoria, visitas) VALUES
('Introducción a Flask', 'Flask es un micro-framework de Python...', '2025-01-10', 1, 1, 245),
('SQL avanzado: JOINS', 'Los JOINS permiten combinar tablas...', '2025-01-15', 2, 2, 189),
('CSS Grid vs Flexbox', 'Cuándo usar cada uno para layouts...', '2025-01-20', 3, 3, 312),
('Python POO básico', 'Clases, objetos y herencia explicados...', '2025-01-25', 1, 1, 156),
('Diseño responsive 2025', 'Mobile-first y media queries modernas...', '2025-02-01', 3, 3, 278);
```

### Paso 2: Aplicación Flask con funcionalidades avanzadas

```python
import mysql.connector
from flask import Flask, request
from datetime import datetime

app = Flask(__name__)

def conectar():
    return mysql.connector.connect(
        host="localhost",
        user="blog2526",
        password="Blog_2025!",
        database="blog2526"
    )

@app.route('/')
def inicio():
    conexion = conectar()
    cursor = conexion.cursor(dictionary=True)  # ← dictionary=True devuelve dict en vez de tuplas
    
    # Consulta con JOIN
    cursor.execute("""
        SELECT 
            e.id_entrada,
            e.titulo,
            e.contenido,
            e.fecha_publicacion,
            e.visitas,
            a.nombre AS autor,
            c.nombre AS categoria
        FROM entradas e
        INNER JOIN autores a ON e.id_autor = a.id_autor
        INNER JOIN categorias c ON e.id_categoria = c.id_categoria
        WHERE e.estado = 'publicado'
        ORDER BY e.fecha_publicacion DESC
        LIMIT 10
    """)
    entradas = cursor.fetchall()
    
    # Estadísticas
    cursor.execute("""
        SELECT 
            COUNT(*) as total_entradas,
            SUM(visitas) as total_visitas,
            (SELECT COUNT(*) FROM autores) as total_autores
        FROM entradas
        WHERE estado = 'publicado'
    """)
    stats = cursor.fetchone()
    
    cursor.close()
    conexion.close()
    
    html = f"""<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog DAM 2526</title>
    <style>
        * {{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }}
        
        :root {{
            --primary: #667eea;
            --primary-dark: #5568d3;
            --secondary: #764ba2;
            --bg: #f7fafc;
            --text: #2d3748;
            --text-light: #718096;
            --border: #e2e8f0;
        }}
        
        body {{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
        }}
        
        /* Navbar */
        .navbar {{
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 1rem 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }}
        
        .navbar .container {{
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }}
        
        .logo {{
            font-size: 1.5rem;
            font-weight: 700;
        }}
        
        .nav-links {{
            display: flex;
            list-style: none;
            gap: 2rem;
        }}
        
        .nav-links a {{
            color: white;
            text-decoration: none;
            transition: opacity 0.3s;
        }}
        
        .nav-links a:hover {{
            opacity: 0.8;
        }}
        
        /* Hero */
        .hero {{
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 4rem 0;
            text-align: center;
        }}
        
        .hero h1 {{
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }}
        
        .stats-cards {{
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            max-width: 900px;
            margin: 2rem auto 0;
        }}
        
        .stat-card {{
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1.5rem;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
        }}
        
        .stat-number {{
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }}
        
        .stat-label {{
            font-size: 0.9rem;
            opacity: 0.9;
        }}
        
        /* Container */
        .container {{
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }}
        
        /* Entradas Grid */
        .entradas-grid {{
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }}
        
        .entrada-card {{
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }}
        
        .entrada-card:hover {{
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }}
        
        .entrada-header {{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }}
        
        .categoria-badge {{
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }}
        
        .fecha {{
            color: var(--text-light);
            font-size: 0.9rem;
        }}
        
        .entrada-card h2 {{
            color: var(--text);
            margin-bottom: 1rem;
            font-size: 1.4rem;
        }}
        
        .excerpt {{
            color: var(--text-light);
            margin-bottom: 1rem;
            line-height: 1.8;
        }}
        
        .entrada-footer {{
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid var(--border);
            font-size: 0.9rem;
        }}
        
        .autor {{
            color: var(--text);
        }}
        
        .stats {{
            color: var(--text-light);
        }}
        
        /* Footer */
        footer {{
            background: white;
            padding: 2rem 0;
            margin-top: 4rem;
            box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.05);
            text-align: center;
            color: var(--text-light);
        }}
        
        @media (max-width: 768px) {{
            .entradas-grid {{
                grid-template-columns: 1fr;
            }}
            .hero h1 {{
                font-size: 2rem;
            }}
        }}
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="logo">📝 Blog DAM</div>
            <ul class="nav-links">
                <li><a href="/">Inicio</a></li>
                <li><a href="/crear">Crear entrada</a></li>
                <li><a href="/estadisticas">Estadísticas</a></li>
            </ul>
        </div>
    </nav>
    
    <div class="hero">
        <div class="container">
            <h1>📚 Blog de Desarrollo y Programación</h1>
            <p style="font-size: 1.1rem; opacity: 0.9;">
                Tutoriales, proyectos y experiencias con Python, Bases de Datos y Web
            </p>
            
            <div class="stats-cards">
                <div class="stat-card">
                    <span class="stat-number">{stats['total_entradas']}</span>
                    <span class="stat-label">Entradas</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number">{stats['total_visitas']:,}</span>
                    <span class="stat-label">Visitas</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number">{stats['total_autores']}</span>
                    <span class="stat-label">Autores</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="entradas-grid">
"""
    
    # Generar tarjeta por cada entrada
    for entrada in entradas:
        # Truncar contenido a 150 caracteres
        extracto = entrada['contenido'][:150] + '...' if len(entrada['contenido']) > 150 else entrada['contenido']
        
        html += f"""
            <article class="entrada-card">
                <div class="entrada-header">
                    <span class="categoria-badge">{entrada['categoria']}</span>
                    <span class="fecha">{entrada['fecha_publicacion'].strftime('%d/%m/%Y')}</span>
                </div>
                
                <h2>{entrada['titulo']}</h2>
                <p class="excerpt">{extracto}</p>
                
                <div class="entrada-footer">
                    <span class="autor">✍️ {entrada['autor']}</span>
                    <span class="stats">👁️ {entrada['visitas']} visitas</span>
                </div>
            </article>
"""
    
    html += """
        </div>
    </div>
    
    <footer>
        <p>&copy; 2025 Blog DAM 2526 - Proyecto Intermodular</p>
        <p>Simulacro de Examen Completo</p>
    </footer>
</body>
</html>
"""
    
    return html

if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=5000)
```

### Conceptos evaluados

✅ Base de datos relacional (3 tablas + FK)  
✅ JOINS (INNER JOIN múltiples tablas)  
✅ Agregaciones (COUNT, SUM)  
✅ Subconsultas en SELECT  
✅ cursor(dictionary=True) para resultados  
✅ Índices para optimización  
✅ Formato de fechas (strftime)  
✅ Truncar texto (slice [:150])  
✅ CSS Grid avanzado  
✅ Gradientes en múltiples elementos  
✅ Backdrop-filter (glassmorphism)  
✅ Diseño responsivo con media queries

---

## 📝 SIMULACRO 4: BLOG CON VISTA Y LEFT JOIN

### 🎯 Objetivo
Blog personal con sistema de autores usando **VISTA SQL** y **LEFT JOIN**. Este simulacro aparece en Bases de datos/004-Tratamiento de datos/006-Simulacro examen.

### 📊 Conceptos clave
- **2 tablas relacionadas** (autores → entradas con FK)
- **CREATE VIEW** para simplificar consultas
- **LEFT JOIN** para combinar datos
- **Diseño minimalista** estilo blog
- **Layout centrado** con ancho fijo

---

### 1️⃣ PASO 1: BASE DE DATOS (MySQL)

**Crear database y usuario:**
```sql
CREATE DATABASE blog2526;

CREATE USER 'blog2526'@'localhost' 
IDENTIFIED BY 'blog2526';

GRANT USAGE ON *.* TO 'blog2526'@'localhost';

ALTER USER 'blog2526'@'localhost' 
REQUIRE NONE 
WITH MAX_QUERIES_PER_HOUR 0 
MAX_CONNECTIONS_PER_HOUR 0 
MAX_UPDATES_PER_HOUR 0 
MAX_USER_CONNECTIONS 0;

GRANT ALL PRIVILEGES ON `blog2526`.* 
TO 'blog2526'@'localhost';

FLUSH PRIVILEGES;
USE blog2526;
```

**Crear tablas:**
```sql
-- Tabla de autores
CREATE TABLE autores (
  Identificador INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(150) NOT NULL,
  apellidos VARCHAR(255) NOT NULL,
  email VARCHAR(150) NOT NULL,
  PRIMARY KEY (Identificador)
) ENGINE = InnoDB;

-- Tabla de entradas del blog
CREATE TABLE entradas (
  Identificador INT NOT NULL AUTO_INCREMENT,
  titulo VARCHAR(150) NOT NULL,
  contenido VARCHAR(255) NOT NULL,
  fecha VARCHAR(50) NOT NULL,
  autor INT NOT NULL,
  PRIMARY KEY (Identificador)
) ENGINE = InnoDB;
```

**Añadir claves foráneas:**
```sql
ALTER TABLE entradas 
ADD CONSTRAINT autoresaentradas 
FOREIGN KEY (autor) 
REFERENCES autores(Identificador) 
ON DELETE RESTRICT 
ON UPDATE RESTRICT;

ALTER TABLE entradas 
ADD INDEX autoresaentradas (autor);
```

**Insertar autores de muestra:**
```sql
INSERT INTO autores (nombre, apellidos, email) VALUES
('Carlos', 'Pérez Gómez', 'carlos.perez@example.com'),
('María', 'López Sánchez', 'maria.lopez@example.com'),
('Javier', 'Martínez Ruiz', 'javier.martinez@example.com'),
('Lucía', 'García Torres', 'lucia.garcia@example.com'),
('Andrés', 'Ramírez Fernández', 'andres.ramirez@example.com'),
('Elena', 'Moreno Díaz', 'elena.moreno@example.com'),
('Sergio', 'Hernández Navarro', 'sergio.hernandez@example.com'),
('Patricia', 'Gómez León', 'patricia.gomez@example.com'),
('Raúl', 'Castillo Ortega', 'raul.castillo@example.com'),
('Laura', 'Santos Vega', 'laura.santos@example.com');
```

**Insertar entradas del blog:**
```sql
INSERT INTO entradas (titulo, contenido, fecha, autor) VALUES
('Titulo de prueba', 'Contenido de prueba', '2025-05-05', 2),
('Cómo crear tu primera página web con HTML y CSS', 'Aprende los fundamentos del diseño web con ejemplos prácticos.', '2025-01-10', 2),
('JavaScript moderno: funciones flecha y promesas', 'Exploramos las características modernas del lenguaje JavaScript.', '2025-01-12', 3),
('Instalar y configurar MySQL en Ubuntu', 'Guía paso a paso para instalar MySQL en sistemas basados en Linux.', '2025-01-15', 4),
('Buenas prácticas de seguridad en PHP', 'Cómo proteger tu aplicación web frente a ataques comunes.', '2025-01-18', 5),
('Introducción a Docker para desarrolladores', 'Aprende a crear contenedores para tus proyectos de desarrollo.', '2025-01-20', 6),
('Versionado de código con Git y GitHub', 'Todo lo que necesitas saber para trabajar en equipo con control de versiones.', '2025-01-22', 7),
('APIs RESTful con Flask y Python', 'Construye tus propias APIs usando el microframework Flask.', '2025-01-25', 8),
('Diseño responsivo con CSS Grid y Flexbox', 'Técnicas modernas para crear sitios adaptativos y elegantes.', '2025-01-28', 9),
('Automatización de tareas con Python', 'Ejemplos de cómo automatizar procesos repetitivos con scripts.', '2025-02-02', 10);
```

**Crear VISTA para simplificar consultas:**
```sql
CREATE VIEW entradas_con_autores AS 
SELECT 
  entradas.titulo,
  entradas.contenido,
  entradas.fecha,
  autores.nombre,
  autores.apellidos,
  autores.email
FROM 
  entradas
LEFT JOIN 
  autores 
ON 
  entradas.autor = autores.Identificador;
```

**Verificar la vista:**
```sql
SELECT * FROM entradas_con_autores;
```

---

### 2️⃣ PASO 2: APLICACIÓN FLASK

**Archivo: `app.py`**

```python
import mysql.connector
from flask import Flask

aplicacion = Flask(__name__)

# Conexión global (mejor práctica: usar pool de conexiones)
conexion = mysql.connector.connect(
    host="localhost",
    user="blog2526",
    password="blog2526",
    database="blog2526"
)

@aplicacion.route("/")
def raiz():
    cursor = conexion.cursor() 
    
    # Consulta a la VISTA (simplifica el código)
    cursor.execute("SELECT * FROM entradas_con_autores;")
    
    # Generar HTML con estructura semántica
    cadena = '''
    <!doctype html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>El Blog de Jose Vicente</title>
        <style>
            * {
                padding: 2px;
                margin: 2px;
            }
            
            body {
                background: grey;
                font-family: sans-serif;
            }
            
            header, main, footer {
                width: 500px;
                background: white;
                padding: 20px;
                margin: auto;
            }
            
            article {
                padding-bottom: 20px;
                border-bottom: 1px solid grey;
                margin-bottom: 20px;
            }
            
            p {
                font-size: 11px;
            }
        </style>
    </head>
    <body>
        <header>
            <h1>El blog de Jose Vicente</h1>
        </header>
        <main>
    '''
    
    # Iterar sobre resultados
    lineas = cursor.fetchall()
    for linea in lineas:
        # linea = (titulo, contenido, fecha, nombre, apellidos, email)
        cadena += f'''
            <article>
                <h3>{linea[0]}</h3>
                <p>{linea[3]} {linea[4]} - {linea[5]}</p>
                <time>{linea[2]}</time>
                <p>{linea[1]}</p>
            </article>
        '''
    
    cadena += '''
        </main>
        <footer>
            <p>&copy; 2025 Jose Vicente - Todos los derechos reservados</p>
        </footer>
    </body>
    </html>
    '''
    
    return cadena

if __name__ == "__main__":
    aplicacion.run(debug=True, host='0.0.0.0', port=5000)
```

---

### 3️⃣ MEJORAS OPCIONALES (si sobra tiempo)

**Versión mejorada con estilos modernos:**

```python
# Solo cambiar la parte del <style> en app.py

style_mejorado = '''
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 20px;
    }
    
    header, main, footer {
        max-width: 700px;
        background: white;
        padding: 30px;
        margin: 20px auto;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    
    header h1 {
        color: #667eea;
        font-size: 2.5em;
        text-align: center;
        margin-bottom: 10px;
    }
    
    article {
        padding: 20px 0;
        border-bottom: 2px solid #f0f0f0;
        margin-bottom: 20px;
        transition: transform 0.3s;
    }
    
    article:hover {
        transform: translateX(10px);
    }
    
    article h3 {
        color: #333;
        margin-bottom: 10px;
    }
    
    article p {
        color: #666;
        line-height: 1.6;
        margin: 5px 0;
    }
    
    time {
        color: #667eea;
        font-weight: bold;
        font-size: 0.9em;
    }
    
    footer {
        text-align: center;
        color: #999;
        font-size: 0.9em;
    }
</style>
'''
```

---

### 📝 CONCEPTOS EVALUADOS

✅ CREATE DATABASE y CREATE USER  
✅ FOREIGN KEY con ON DELETE/UPDATE  
✅ LEFT JOIN entre tablas  
✅ **CREATE VIEW** (simplifica consultas complejas)  
✅ Consultas a vistas SQL  
✅ mysql.connector (conexión MySQL)  
✅ Flask básico (decorador @aplicacion.route)  
✅ Generación dinámica de HTML  
✅ Estructura semántica (header, main, article, footer)  
✅ CSS centrado con margin: auto  
✅ Border-bottom para separadores  
✅ Tipografía y espaciado consistente

---

### 💡 DIFERENCIA CLAVE CON SIMULACRO 3

| Aspecto | Simulacro 3 | Simulacro 4 |
|---------|-------------|-------------|
| **Tablas** | 3 tablas (autores, categorías, entradas) | 2 tablas (autores, entradas) |
| **JOIN** | INNER JOIN en Python | LEFT JOIN en VISTA SQL |
| **Consulta** | SELECT con JOIN manual | SELECT * FROM vista |
| **Complejidad** | Media-alta | Media |
| **Vista SQL** | No | **Sí (clave del simulacro)** |

**¿Cuándo usar VISTA?**
- Simplifica consultas complejas repetitivas
- Oculta complejidad del JOIN
- Mejora rendimiento (MySQL cachea)
- Facilita mantenimiento

---

### ⏱️ TIEMPO ESTIMADO

- **Base de datos:** 12 min (tablas + FK + vista)
- **Insertar datos:** 5 min
- **Flask básico:** 15 min
- **HTML/CSS:** 15 min
- **Pruebas:** 8 min
- **Total:** ~55 minutos

---

## 🔧 SIMULACRO: CRUD BLOG EN CONSOLA (Programación)

### 🎯 Objetivo
Aplicación de **consola** tipo WordPress con CRUD completo de blog (Create, Read, Update, Delete). Este simulacro aparece en `Programación/005-Lectura y escritura de información/010-Simulacro examen programacion`.

### 📊 Conceptos clave
- **CRUD completo** en terminal
- **Interfaz tipo WordPress** con colores ANSI
- **Paginación** de resultados
- **Búsqueda** en múltiples campos
- **LEFT JOIN** para combinar tablas
- **Validación de entrada** (input no vacío, enteros)
- **Menú interactivo** con emojis
- **Confirmación** antes de eliminar

---

### 💻 CÓDIGO COMPLETO (simplificado para examen)

**Archivo: `blog_crud.py`**

```python
#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import mysql.connector
from textwrap import shorten

# ===========================
#  🎨 COLORES CONSOLA
# ===========================
class C:
    RESET = "\033[0m"
    BOLD = "\033[1m"
    GREEN = "\033[38;5;42m"
    RED = "\033[38;5;196m"
    YELLOW = "\033[38;5;220m"

def toast_ok(msg): 
    print(f"{C.GREEN}✔ {msg}{C.RESET}")

def toast_error(msg): 
    print(f"{C.RED}✘ {msg}{C.RESET}")

def toast_warn(msg): 
    print(f"{C.YELLOW}⚠ {msg}{C.RESET}")

# ===========================
#  🗄️ CONEXIÓN
# ===========================
def conectar():
    return mysql.connector.connect(
        host="localhost",
        user="blog2526",
        password="blog2526",
        database="blog2526"
    )

# ===========================
#  📊 OPERACIONES CRUD
# ===========================
def listar_entradas(conn):
    """Listar todas las entradas con LEFT JOIN"""
    cursor = conn.cursor()
    sql = """
    SELECT 
        e.Identificador, 
        e.titulo, 
        e.contenido, 
        e.fecha,
        CONCAT(a.nombre, ' ', a.apellidos) AS autor
    FROM entradas e
    LEFT JOIN autores a ON e.autor = a.Identificador
    ORDER BY e.fecha DESC
    """
    cursor.execute(sql)
    entradas = cursor.fetchall()
    
    print("\n" + "="*80)
    print(f"{'ID':<5} {'Título':<30} {'Fecha':<12} {'Autor':<25}")
    print("-"*80)
    
    for entrada in entradas:
        # Truncar título si es muy largo
        titulo = shorten(entrada[1], width=28, placeholder="…")
        autor = entrada[4] if entrada[4] else "Sin autor"
        print(f"{entrada[0]:<5} {titulo:<30} {entrada[3]:<12} {autor:<25}")
    
    print("="*80)
    cursor.close()

def insertar_entrada(conn, titulo, contenido, fecha, autor_id):
    """Insertar nueva entrada"""
    cursor = conn.cursor()
    sql = "INSERT INTO entradas (titulo, contenido, fecha, autor) VALUES (%s, %s, %s, %s)"
    cursor.execute(sql, (titulo, contenido, fecha, autor_id))
    conn.commit()
    cursor.close()
    toast_ok("Entrada creada correctamente")

def actualizar_entrada(conn, id_entrada, titulo, contenido, fecha, autor_id):
    """Actualizar entrada existente"""
    cursor = conn.cursor()
    sql = """
    UPDATE entradas 
    SET titulo=%s, contenido=%s, fecha=%s, autor=%s 
    WHERE Identificador=%s
    """
    cursor.execute(sql, (titulo, contenido, fecha, autor_id, id_entrada))
    conn.commit()
    cursor.close()
    toast_ok("Entrada actualizada")

def eliminar_entrada(conn, id_entrada):
    """Eliminar entrada"""
    cursor = conn.cursor()
    sql = "DELETE FROM entradas WHERE Identificador=%s"
    cursor.execute(sql, (id_entrada,))
    conn.commit()
    cursor.close()
    toast_ok("Entrada eliminada")

def buscar_entradas(conn, termino):
    """Buscar entradas por título o contenido"""
    cursor = conn.cursor()
    sql = """
    SELECT 
        e.Identificador, 
        e.titulo, 
        e.contenido, 
        e.fecha,
        CONCAT(a.nombre, ' ', a.apellidos) AS autor
    FROM entradas e
    LEFT JOIN autores a ON e.autor = a.Identificador
    WHERE e.titulo LIKE %s OR e.contenido LIKE %s
    ORDER BY e.fecha DESC
    """
    like_term = f"%{termino}%"
    cursor.execute(sql, (like_term, like_term))
    resultados = cursor.fetchall()
    cursor.close()
    return resultados

# ===========================
#  📝 VALIDACIÓN INPUT
# ===========================
def input_nonempty(prompt):
    """Input que no puede estar vacío"""
    while True:
        valor = input(prompt).strip()
        if valor:
            return valor
        toast_warn("Este campo no puede estar vacío")

def input_int(prompt):
    """Input que debe ser entero"""
    while True:
        valor = input(prompt).strip()
        if valor.isdigit():
            return int(valor)
        toast_warn("Debe ser un número entero")

# ===========================
#  🖥️ MENÚ PRINCIPAL
# ===========================
def mostrar_menu():
    print("\n" + "="*80)
    print(f"{C.BOLD}  📝 GESTIÓN DE BLOG - Panel de Administración  {C.RESET}")
    print("="*80)
    print("  1. 📚 Listar entradas")
    print("  2. ✏️  Añadir entrada")
    print("  3. 🔄 Actualizar entrada")
    print("  4. 🗑️  Eliminar entrada")
    print("  5. 🔎 Buscar entrada")
    print("  0. 🚪 Salir")
    print("="*80)

def main():
    conn = conectar()
    
    try:
        while True:
            mostrar_menu()
            opcion = input("\n→ Selecciona opción: ").strip()
            
            if opcion == "1":
                # LISTAR
                listar_entradas(conn)
                input("\nPulsa ENTER para continuar...")
                
            elif opcion == "2":
                # AÑADIR
                print("\n" + C.BOLD + "AÑADIR NUEVA ENTRADA" + C.RESET)
                titulo = input_nonempty("Título: ")
                contenido = input_nonempty("Contenido (máx 255 caracteres): ")
                if len(contenido) > 255:
                    contenido = contenido[:255]
                    toast_warn("Contenido truncado a 255 caracteres")
                fecha = input_nonempty("Fecha (YYYY-MM-DD): ")
                autor_id = input_int("ID del autor: ")
                
                insertar_entrada(conn, titulo, contenido, fecha, autor_id)
                
            elif opcion == "3":
                # ACTUALIZAR
                print("\n" + C.BOLD + "ACTUALIZAR ENTRADA" + C.RESET)
                id_entrada = input_int("ID de la entrada a actualizar: ")
                titulo = input_nonempty("Nuevo título: ")
                contenido = input_nonempty("Nuevo contenido: ")
                if len(contenido) > 255:
                    contenido = contenido[:255]
                fecha = input_nonempty("Nueva fecha (YYYY-MM-DD): ")
                autor_id = input_int("Nuevo ID autor: ")
                
                actualizar_entrada(conn, id_entrada, titulo, contenido, fecha, autor_id)
                
            elif opcion == "4":
                # ELIMINAR
                print("\n" + C.BOLD + "ELIMINAR ENTRADA" + C.RESET)
                id_entrada = input_int("ID de la entrada a eliminar: ")
                confirmacion = input(f"¿Seguro que quieres eliminar la entrada {id_entrada}? (s/n): ")
                
                if confirmacion.lower() == 's':
                    eliminar_entrada(conn, id_entrada)
                else:
                    toast_warn("Operación cancelada")
                    
            elif opcion == "5":
                # BUSCAR
                print("\n" + C.BOLD + "BUSCAR ENTRADAS" + C.RESET)
                termino = input("Término de búsqueda: ").strip()
                resultados = buscar_entradas(conn, termino)
                
                if resultados:
                    print(f"\n{len(resultados)} resultado(s) encontrado(s):")
                    print("-"*80)
                    for r in resultados:
                        print(f"ID: {r[0]} | {r[1]} | {r[3]}")
                    print("-"*80)
                else:
                    toast_warn("No se encontraron resultados")
                    
                input("\nPulsa ENTER para continuar...")
                
            elif opcion == "0":
                # SALIR
                print("\n👋 ¡Hasta pronto!")
                break
                
            else:
                toast_error("Opción no válida")
                
    finally:
        conn.close()

if __name__ == "__main__":
    main()
```

---

### 📝 CONCEPTOS EVALUADOS

✅ **mysql.connector** (conexión y cursor)  
✅ **CRUD completo** (Create, Read, Update, Delete)  
✅ **LEFT JOIN** entre tablas  
✅ **CONCAT** en SQL (nombre + apellidos)  
✅ **LIKE** para búsquedas  
✅ **ORDER BY** DESC (más recientes primero)  
✅ **Validación de entrada** (no vacío, enteros)  
✅ **Confirmación** antes de eliminar  
✅ **Colores ANSI** en consola  
✅ **Truncar texto** con textwrap.shorten  
✅ **Try-finally** para cerrar conexión  
✅ **Menú while True** con opciones

---

### 💡 DIFERENCIA CON SIMULACROS WEB

| Aspecto | CRUD Consola | Simulacros Web |
|---------|--------------|----------------|
| **Interfaz** | Terminal con colores ANSI | HTML + CSS |
| **Framework** | Ninguno (Python puro) | Flask |
| **Salida** | print() | return HTML |
| **Input** | input() | Formularios/URL params |
| **Validación** | While loops | JavaScript o backend |
| **Estilo** | Códigos escape \033 | CSS |

---

### ⏱️ TIEMPO ESTIMADO

- **Conexión DB:** 5 min
- **CRUD básico:** 20 min (4 funciones × 5 min)
- **Menú interactivo:** 10 min
- **Validación:** 10 min
- **Pruebas:** 10 min
- **Total:** ~55 minutos

---

## 🐧 SIMULACRO: INSTALACIÓN DEBIAN LINUX + LAMP (Sistemas Informáticos)

### 🎯 Objetivo
Instalar **Debian Linux** (distribución base sin GUI) y configurar **stack LAMP** (Linux, Apache, MySQL, Python). Este simulacro aparece en `Sistemas informáticos/002-Instalación de sistemas operativos/015-Simulacro - Instalacion de Debian Linux`.

### 📊 Conceptos clave
- **Instalación de SO** desde ISO
- **Particionado de disco** guiado
- **Configuración de red** y hostname
- **Gestión de usuarios** y sudo
- **Instalación de paquetes** (apt)
- **Configuración de servicios** (Apache, MySQL)
- **Permisos de usuario** (usermod -aG)
- **Verificación de servicios** (systemctl)

---

### 🔧 PROCESO DE INSTALACIÓN

#### **FASE 1: INSTALACIÓN DE DEBIAN**

**1. Configuración inicial**
```
✓ Instalación: Clásica (no gráfica)
✓ Idioma: Español
✓ Ubicación: España
✓ Teclado: Español
```

**2. Configuración de red**
```
Nombre de máquina: debianserver
Dominio: home (o dejar vacío)
```

**3. Usuarios y contraseñas**
```
Contraseña de root: TAME123$
Nombre completo: [Tu nombre]
Nombre de usuario: josevicente (o el tuyo)
Contraseña de usuario: TAME123$
```

**4. Particionado de disco**
```
✓ Método: Guiado - utilizar disco completo
✓ Esquema: Todos los ficheros en una partición (recomendado para novatos)
✓ Confirmar cambios: SÍ
```

**5. Gestor de paquetes**
```
✗ NO analizar otros CD/DVD
✗ NO usar réplica de red (si no tienes internet)
```

**6. Selección de software**
```
✗ DESMARCAR: Entorno de escritorio
✗ DESMARCAR: Servidor web
✗ DESMARCAR: Servidor SSH
✓ MARCAR SOLO: Utilidades estándar del sistema
```

**7. GRUB (gestor de arranque)**
```
✓ Instalar en: /dev/sda (disco principal)
```

**8. Reiniciar**
```
Quitar la ISO y arrancar desde disco duro
```

---

#### **FASE 2: CONFIGURACIÓN POST-INSTALACIÓN**

**1. Login como root**
```bash
debian login: root
Password: TAME123$
```

**2. Añadir usuario a sudoers**
```bash
# Como root:
usermod -aG sudo josevicente

# Verificar:
groups josevicente
# Debe aparecer: josevicente : josevicente sudo
```

**3. Cerrar sesión root y entrar como usuario**
```bash
exit
# Login como usuario normal
debian login: josevicente
Password: TAME123$
```

---

#### **FASE 3: INSTALACIÓN LAMP STACK**

**1. Actualizar repositorios**
```bash
sudo apt update
sudo apt upgrade -y
```

**2. Instalar Apache**
```bash
sudo apt install apache2 -y

# Verificar servicio
sudo systemctl status apache2

# Verificar desde navegador (en otra máquina):
# http://[IP_DEL_SERVIDOR]
```

**3. Obtener IP del servidor**
```bash
ip addr show

# Buscar línea similar a:
# inet 192.168.1.100/24
```

**4. Instalar MySQL Server**
```bash
sudo apt install mysql-server -y

# Verificar servicio
sudo systemctl status mysql

# Entrar a MySQL como root
sudo mysql

# Dentro de MySQL:
mysql> CREATE DATABASE prueba;
mysql> SHOW DATABASES;
mysql> EXIT;
```

**5. Instalar Python**
```bash
# Verificar Python (ya viene instalado en Debian)
python3 --version

# Instalar pip
sudo apt install python3-pip -y

# Instalar Flask
pip3 install flask

# Instalar MySQL connector
pip3 install mysql-connector-python
```

**6. Crear aplicación de prueba**
```bash
# Crear archivo
nano /home/josevicente/test_web.py
```

```python
from flask import Flask
app = Flask(__name__)

@app.route('/')
def home():
    return '''
    <!DOCTYPE html>
    <html>
    <head><title>Debian LAMP</title></head>
    <body>
        <h1>¡Servidor Debian funcionando!</h1>
        <p>LAMP Stack instalado correctamente:</p>
        <ul>
            <li>Linux: Debian</li>
            <li>Apache: Activo</li>
            <li>MySQL: Activo</li>
            <li>Python: Flask funcionando</li>
        </ul>
    </body>
    </html>
    '''

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=8080)
```

**7. Ejecutar aplicación**
```bash
python3 test_web.py

# Acceder desde navegador:
# http://[IP_SERVIDOR]:8080
```

---

### 📝 COMANDOS CLAVE

**Gestión de usuarios:**
```bash
usermod -aG sudo usuario     # Añadir a sudoers
groups usuario               # Ver grupos del usuario
passwd usuario               # Cambiar contraseña
```

**Gestión de servicios:**
```bash
sudo systemctl status apache2    # Ver estado
sudo systemctl start apache2     # Iniciar
sudo systemctl stop apache2      # Detener
sudo systemctl restart apache2   # Reiniciar
sudo systemctl enable apache2    # Auto-inicio
```

**Gestión de paquetes:**
```bash
sudo apt update              # Actualizar lista de paquetes
sudo apt upgrade             # Actualizar paquetes instalados
sudo apt install paquete     # Instalar paquete
sudo apt remove paquete      # Desinstalar paquete
sudo apt search término      # Buscar paquete
```

**Red:**
```bash
ip addr show                 # Ver IP
ping google.com              # Probar conexión
hostname                     # Ver nombre de máquina
```

---

### 📝 CONCEPTOS EVALUADOS

✅ **Instalación de SO** (Debian desde ISO)  
✅ **Particionado guiado** (disco completo)  
✅ **Configuración de red** (hostname, dominio)  
✅ **Gestión de usuarios** (root vs usuario normal)  
✅ **Permisos sudo** (usermod -aG)  
✅ **APT** (update, upgrade, install)  
✅ **Servicios systemctl** (status, start, stop)  
✅ **Apache** (servidor web)  
✅ **MySQL** (base de datos)  
✅ **Python + Flask** (aplicación web)  
✅ **Verificación** de servicios activos  
✅ **Acceso remoto** (IP, puertos)

---

### 💡 TROUBLESHOOTING COMÚN

**Problema: "usuario is not in the sudoers file"**
```bash
# Solución: Entrar como root y añadir
su root
usermod -aG sudo usuario
exit
# Volver a loguearse como usuario
```

**Problema: "Unable to locate package"**
```bash
# Solución: Actualizar repositorios
sudo apt update
sudo apt install nombre_paquete
```

**Problema: Apache no arranca**
```bash
# Ver logs de error
sudo journalctl -u apache2 -n 50

# Verificar puerto 80 libre
sudo netstat -tulpn | grep :80
```

**Problema: No puedo acceder desde otro PC**
```bash
# Verificar firewall (si existe)
sudo ufw status

# Verificar IP correcta
ip addr show

# Probar localhost primero
curl http://localhost
```

---

### ⏱️ TIEMPO ESTIMADO

- **Instalación Debian:** 20 min (incluye descargar ISO)
- **Configuración inicial:** 5 min
- **Instalación Apache:** 5 min
- **Instalación MySQL:** 5 min
- **Instalación Python/Flask:** 10 min
- **Pruebas y verificación:** 10 min
- **Total:** ~55 minutos (excluyendo descarga de ISO)

---

## ✅ CHECKLIST PRE-EXAMEN

### Antes del examen

- [ ] MySQL Workbench abierto y funcional
- [ ] VS Code instalado con extensión Python
- [ ] Python 3.x instalado (`python --version`)
- [ ] Flask instalado (`pip install flask`)
- [ ] mysql-connector-python instalado (`pip install mysql-connector-python`)
- [ ] Navegador Chrome/Firefox abierto
- [ ] Apuntes y cheatsheets impresos

### Durante el examen (primeros 5 min)

- [ ] Leer COMPLETO el enunciado ANTES de empezar
- [ ] Identificar: ¿SQLite o MySQL?
- [ ] Anotar en papel: tablas necesarias
- [ ] Anotar campos de cada tabla
- [ ] Crear carpeta del proyecto (`mkdir examen_XXX`)
- [ ] Abrir VS Code en esa carpeta

### Orden de ejecución RECOMENDADO

1. ✅ **Base de datos** (15 min)
   - Crear BD y usuario
   - Crear tablas con AUTO_INCREMENT
   - Insertar 3-5 registros de prueba
   - **Verificar con SELECT * antes de continuar**

2. ✅ **Python básico** (20 min)
   - Crear `app.py`
   - Importar librerías
   - Función de conexión
   - Ruta `/` básica con consulta SELECT
   - HTML mínimo (DOCTYPE + h1)
   - **Probar que conecta y muestra datos**

3. ✅ **HTML estructura** (15 min)
   - Header con título
   - Container principal
   - Bucle for para listar datos
   - Footer básico
   - **Verificar que muestra todos los registros**

4. ✅ **CSS diseño** (30 min)
   - Reset CSS (`*, box-sizing`)
   - Variables CSS (colores)
   - Grid o Flexbox para layout
   - Estilos de tarjetas
   - Efectos hover
   - **Probar responsive en navegador (F12, modo móvil)**

5. ✅ **Mejoras finales** (15 min)
   - Placeholder para imágenes sin URL
   - Formateo de números/fechas
   - Añadir botones (aunque no funcionen)
   - Comentarios en código

6. ✅ **Revisión final** (10 min)
   - Reiniciar servidor Flask
   - Probar en navegador limpio (Ctrl+Shift+N)
   - Verificar TODAS las funcionalidades del enunciado
   - Añadir comentarios explicativos
   - Guardar y hacer backup

---

## 🚫 ERRORES COMUNES

### 🔴 Base de datos

❌ **Olvidar AUTO_INCREMENT en ID**
```sql
id INT NOT NULL  -- ❌ MAL: no se autogenera
id INT NOT NULL AUTO_INCREMENT  -- ✅ BIEN
```

❌ **No usar FLUSH PRIVILEGES**
```sql
GRANT ALL PRIVILEGES ON bd.* TO 'usuario'@'localhost';
-- ❌ Falta:
FLUSH PRIVILEGES;  -- ✅ OBLIGATORIO
```

❌ **No usar la BD antes de crear tablas**
```sql
CREATE DATABASE examen;
CREATE TABLE productos ...  -- ❌ MAL: no estás en la BD
-- ✅ BIEN:
USE examen;
CREATE TABLE productos ...
```

❌ **Tipos de datos incorrectos**
```sql
precio FLOAT  -- ❌ MAL: pierde precisión
precio DECIMAL(10,2)  -- ✅ BIEN: exacto para dinero
```

### 🔴 Python/Flask

❌ **Olvidar cerrar conexión**
```python
conexion = conectar()
cursor = conexion.cursor()
# ... código ...
return html  -- ❌ MAL: no cierras

# ✅ BIEN:
cursor.close()
conexion.close()
return html
```

❌ **No manejar None en SQL**
```python
# Si imagen puede ser NULL en BD
html += f'<img src="/static/{imagen}">'  -- ❌ MAL: falla si imagen=None

# ✅ BIEN:
img_src = f"/static/{imagen}" if imagen else "placeholder.jpg"
html += f'<img src="{img_src}">'
```

❌ **Olvidar host='0.0.0.0' para acceder desde red**
```python
app.run(debug=True)  -- ❌ Solo localhost

app.run(debug=True, host='0.0.0.0', port=5000)  -- ✅ Accesible en red
```

❌ **No usar f-strings correctamente**
```python
# ❌ MAL:
html = "<h1>" + titulo + "</h1>"

# ✅ BIEN:
html = f"<h1>{titulo}</h1>"
```

### 🔴 HTML/CSS

❌ **Olvidar comillas en atributos**
```html
<img src={imagen}>  ❌ MAL
<img src="{imagen}">  ✅ BIEN
```

❌ **No escapar comillas dentro de f-strings**
```python
# ❌ MAL: comillas conflictivas
html = f"<div class="card">"  # ❌ Error de sintaxis

# ✅ BIEN: usar comillas opuestas
html = f'<div class="card">'  # ✅ Funciona
html = f"""<div class="card">"""  # ✅ También funciona
```

❌ **Grid sin minmax responsive**
```css
grid-template-columns: repeat(3, 1fr);  /* ❌ No responsive */

grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));  /* ✅ Responsive */
```

❌ **No incluir viewport meta**
```html
<head>
  <meta charset="UTF-8">
  <title>...</title>  ❌ Falta viewport
</head>

<!-- ✅ BIEN: -->
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>...</title>
</head>
```

---

## ⏱️ GESTIÓN DEL TIEMPO

### Examen de 2 horas - Cronómetro mental

```
⏰ 0:00 - 0:05  → Leer enunciado COMPLETO, planificar en papel
⏰ 0:05 - 0:20  → Base de datos (crear, tablas, datos, verificar)
⏰ 0:20 - 0:40  → Python básico (conexión, SELECT, HTML mínimo)
⏰ 0:40 - 0:55  → Estructura HTML (header, grid/flex, footer)
⏰ 0:55 - 1:25  → CSS completo (variables, grid, hover, responsive)
⏰ 1:25 - 1:40  → Mejoras (imágenes, formatos, botones)
⏰ 1:40 - 1:50  → Pruebas finales (reiniciar, probar todo)
⏰ 1:50 - 2:00  → Comentarios, backup, entregar
```

### Estrategia de priorización

**🟢 IMPRESCINDIBLE (no aprobar sin esto):**
- Base de datos creada y con datos
- Conexión Python-BD funcional
- Mostrar al menos 1 registro en HTML
- HTML válido (DOCTYPE, head, body)

**🟡 IMPORTANTE (sube nota):**
- Mostrar TODOS los registros
- CSS básico (colores, padding, font)
- Grid o Flexbox para layout
- Responsive básico

**🔵 EXTRA (nota excelente):**
- Efectos hover suaves
- Gradientes y sombras
- Placeholder para imágenes
- Código comentado
- Formato de fechas/precios
- Design moderno (glassmorphism, etc.)

### Si te quedas sin tiempo

**30 min restantes y HTML sin estilos:**
```css
/* CSS ULTRA-RÁPIDO que funciona */
* { box-sizing: border-box; }
body {
  font-family: Arial, sans-serif;
  background: #f5f5f5;
  padding: 20px;
}
.container {
  max-width: 1200px;
  margin: 0 auto;
}
.grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 20px;
}
.card {
  background: white;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}
.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 4px 20px rgba(0,0,0,0.15);
}
```
**→ Copia esto y tendrás un diseño profesional en 2 minutos**

**15 min restantes y BD sin datos:**
```sql
-- INSERT RÁPIDO (copia y pega 5 veces cambiando valores)
INSERT INTO tabla (campo1, campo2, campo3) VALUES ('Valor1', 'Valor2', 100);
```

**5 min restantes:**
- NO añadas nada nuevo
- Verifica que funciona (F5 en navegador)
- Añade comentario en Python:
```python
"""
Proyecto: [Nombre del examen]
Autor: [Tu nombre]
Fecha: [Hoy]
Descripción: [1 línea de qué hace]
"""
```
- GUARDA TODO (Ctrl+S)

---

## 🎯 CONSEJOS FINALES

### Mental

✅ **Lee el enunciado DOS veces** antes de empezar  
✅ **No intentes memorizar** código completo, entiende la lógica  
✅ **Si algo no funciona**, comenta el código y sigue con el resto  
✅ **Mejor entregar algo básico que funciona** que complejo que falla  
✅ **No reinventes la rueda**: usa patrones que conoces  

### Técnico

✅ **Guarda cada 5 minutos** (Ctrl+S automático)  
✅ **Prueba en navegador después de CADA cambio importante**  
✅ **console.log() / print()** son tus amigos para depurar  
✅ **F12 en navegador** para ver errores de JavaScript/CSS  
✅ **Terminal de Flask** muestra errores de Python  

### Código limpio

✅ **Indentación consistente** (4 espacios o Tab)  
✅ **Nombres descriptivos** (`productos` mejor que `p`)  
✅ **Un concepto por función** (no hagas funciones de 200 líneas)  
✅ **Comentarios solo donde NO es obvio** qué hace el código  
✅ **CSS organizado**: reset → variables → layout → componentes → responsive  

---

**🍀 ¡MUCHA SUERTE EN TU EXAMEN!**

*Recuerda: La práctica hace al maestro. Haz estos 8 simulacros AL MENOS 3 veces antes del examen real.*

---

## 🚀 SIMULACRO: DESPLIEGUE EN UBUNTU SERVER (Sistemas Informáticos)

### 🎯 Objetivo
**Desplegar aplicación web** en Ubuntu Server: instalar SO, configurar Apache, transferir archivos con FileZilla (SFTP) y ejecutar aplicación Flask. Este simulacro aparece en `Sistemas informáticos/002-Instalación de sistemas operativos/016-Simulacro - Integración con Ubuntu Server`.

### 📊 Conceptos clave
- **Instalación Ubuntu Server** (sin GUI)
- **Transferencia de archivos** (FileZilla SFTP)
- **Apache** como servidor web
- **Despliegue de Flask** en producción
- **Gestión de permisos** (/var/www/html)
- **Configuración de red** (adaptador puente)
- **Instalación de dependencias** (pip, --break-system-packages)

---

### 🔧 PROCESO COMPLETO

#### **FASE 1: INSTALACIÓN UBUNTU SERVER**

**1. Crear máquina virtual**
```
✓ Procesador: 4 núcleos
✓ RAM: 4196 MB
✓ Disco: 100-125 GB
✓ ISO: Ubuntu Server (última versión LTS)
```

**2. Instalación**
```
✓ Idioma: Español (o English para mejor compatibilidad)
✓ Instalación: Ubuntu Server (normal, no minimizada)
✓ Red: Adaptador de red por defecto (NAT)
✓ Disco: Utilizar disco entero, particionado por defecto
✓ Confirmar cambios: SÍ
```

**3. Configuración de usuario**
```
Nombre completo: [Tu nombre]
Nombre de usuario: josevicente
Contraseña: TAME123$
```

**4. Opciones adicionales**
```
✗ NO Ubuntu Pro (por ahora)
✗ NO OpenSSH (lo instalaremos después)
✗ NO aplicaciones predeterminadas
```

**5. Finalizar instalación**
```
Esperar a que termine
Reiniciar
Quitar ISO
```

---

#### **FASE 2: CONFIGURACIÓN POST-INSTALACIÓN**

**1. Login inicial**
```bash
ubuntu login: josevicente
Password: TAME123$
```

**2. Actualizar sistema**
```bash
sudo apt update
sudo apt upgrade -y
```

**3. Instalar Apache**
```bash
sudo apt install apache2 -y

# Verificar que funciona
sudo systemctl status apache2
```

**4. Obtener IP del servidor**
```bash
ip addr show

# Buscar algo como:
# inet 192.168.1.129/24
```

**5. Probar Apache desde navegador**
```
Abrir navegador en TU PC (no en el servidor):
http://192.168.1.129

Deberías ver: "Apache2 Ubuntu Default Page"
```

**6. Cambiar a Adaptador Puente (para acceso desde red local)**
```
1. Apagar máquina virtual: sudo poweroff
2. En VirtualBox → Configuración → Red
3. Adaptador 1: Cambiar de NAT a "Adaptador puente"
4. Nombre: Seleccionar tu tarjeta de red física
5. Iniciar máquina de nuevo
6. Verificar nueva IP: ip addr show
```

---

#### **FASE 3: CREAR PÁGINA WEB BÁSICA**

**1. Ir al directorio web**
```bash
cd /var/www/html
```

**2. Crear archivo HTML**
```bash
sudo nano miweb.html
```

**3. Contenido del archivo:**
```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Primera Página en Ubuntu Server</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            padding: 50px;
        }
        h1 { font-size: 3em; }
    </style>
</head>
<body>
    <h1>¡Servidor Ubuntu funcionando!</h1>
    <p>Apache instalado correctamente en Ubuntu Server</p>
</body>
</html>
```

**4. Guardar archivo:**
```
Ctrl + O (guardar)
Enter (confirmar)
Ctrl + X (salir)
```

**5. Probar desde navegador:**
```
http://192.168.1.129/miweb.html
```

---

#### **FASE 4: TRANSFERENCIA DE ARCHIVOS CON FILEZILLA**

**1. Instalar FileZilla Client** (en TU PC, no en el servidor)
```
Descargar desde: https://filezilla-project.org/
Instalar versión Client (no Server)
```

**2. Instalar OpenSSH en el servidor**
```bash
sudo apt install openssh-server -y
sudo systemctl start ssh
sudo systemctl enable ssh
```

**3. Configurar conexión SFTP en FileZilla**
```
Abrir FileZilla
File → Site Manager → New Site

Configuración:
- Protocolo: SFTP - SSH File Transfer Protocol
- Host: 192.168.1.129 (IP del servidor)
- Port: 22
- Logon Type: Normal
- User: josevicente
- Password: TAME123$

Conectar
```

**4. Primera vez: Aceptar clave SSH**
```
Aparecerá ventana "Unknown host key"
✓ Marcar: "Always trust this host"
OK
```

**5. Interfaz de FileZilla**
```
Izquierda: Tu PC (local)
Derecha: Servidor Ubuntu (remoto)
```

**6. Transferir archivos**
```
Arrastra archivos desde izquierda → derecha

Para subir a /var/www/html:
1. Primero subir a /home/josevicente
2. Luego en terminal: sudo mv archivo /var/www/html/
```

---

#### **FASE 5: DESPLEGAR APLICACIÓN FLASK**

**1. Preparar aplicación Flask en TU PC**
```python
# Archivo: app.py
from flask import Flask
app = Flask(__name__)

@app.route('/')
def home():
    return '''
    <!DOCTYPE html>
    <html>
    <head>
        <title>Flask Ubuntu</title>
        <style>
            body { 
                font-family: Arial; 
                background: #667eea; 
                color: white; 
                text-align: center; 
                padding: 100px; 
            }
        </style>
    </head>
    <body>
        <h1>🚀 Flask en Ubuntu Server</h1>
        <p>Aplicación desplegada correctamente</p>
    </body>
    </html>
    '''

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=False)
```

**2. Transferir con FileZilla**
```
Subir app.py a /home/josevicente/
```

**3. En el servidor: Instalar dependencias**
```bash
# Instalar pip
sudo apt install python3-pip -y

# Instalar Flask (Ubuntu 24+ requiere --break-system-packages)
pip3 install flask --break-system-packages

# O crear virtual environment (método recomendado):
sudo apt install python3-venv -y
python3 -m venv mi_env
source mi_env/bin/activate
pip install flask
```

**4. Ejecutar aplicación**
```bash
cd /home/josevicente
python3 app.py
```

**5. Acceder desde navegador**
```
http://192.168.1.129:5000
```

**6. Ejecutar en segundo plano (para que no se cierre al salir)**
```bash
nohup python3 app.py &

# Ver si está corriendo:
ps aux | grep python

# Detener:
pkill -f app.py
```

---

### 📝 CONCEPTOS EVALUADOS

✅ **Instalación Ubuntu Server** (sin GUI)  
✅ **Configuración de red** (adaptador puente vs NAT)  
✅ **Apache** (instalación y configuración)  
✅ **FileZilla SFTP** (transferencia de archivos segura)  
✅ **OpenSSH** (servidor SSH para SFTP)  
✅ **Permisos Unix** (chmod, chown, sudo)  
✅ **Python pip** (--break-system-packages en Ubuntu 24+)  
✅ **Virtual environments** (python3 -venv)  
✅ **Flask en producción** (host='0.0.0.0')  
✅ **Procesos en background** (nohup, &)  
✅ **Gestión de servicios** (systemctl)  
✅ **HTML en Apache** (/var/www/html)

---

### 💡 DIFERENCIA CON SIMULACRO DEBIAN

| Aspecto | Debian LAMP | Ubuntu Server Despliegue |
|---------|-------------|--------------------------|
| **Enfoque** | Instalación básica LAMP | Despliegue de aplicación real |
| **Transferencia** | No (todo en terminal) | **Sí (FileZilla SFTP)** |
| **Apache** | Instalación básica | Uso activo (/var/www/html) |
| **Flask** | Prueba local | **Despliegue en producción** |
| **Red** | NAT | **Adaptador puente** |
| **Permisos** | Básico (sudo) | **Avanzado (chmod, chown)** |
| **Archivos** | Crear con nano | **Transferir con SFTP** |

---

### ⏱️ TIEMPO ESTIMADO

- **Instalación Ubuntu Server:** 15 min
- **Configuración Apache + SSH:** 10 min
- **Configuración FileZilla:** 10 min
- **Transferencia de archivos:** 5 min
- **Instalación Flask:** 5 min
- **Despliegue y pruebas:** 10 min
- **Total:** ~55 minutos (excluyendo descarga ISO)

---

## 📊 RESUMEN FINAL

**SIMULACROS INCLUIDOS EN ESTE CHEATSHEET:**

1. 📄 **CV Profesional con Flexbox** (Lenguajes de Marcas) - HTML/CSS puro
2. 📝 **Blog con Vista y LEFT JOIN** (Bases de Datos) - SQL avanzado con vistas
3. 🔧 **CRUD Blog en Consola** (Programación) - Python terminal con validación
4. 🛒 **Tienda Online con SQLite** (Proyecto Intermodular) - Flask + SQLite
5. 💼 **Portafolio con MySQL** (Proyecto Intermodular) - Flask + MySQL + CSS avanzado
6. 📰 **Blog Relacional MySQL** (Proyecto Intermodular) - 3 tablas + JOINs
7. 🐧 **Instalación Debian LAMP** (Sistemas Informáticos) - Linux + Apache + MySQL + Python
8. 🚀 **Despliegue en Ubuntu Server** (Sistemas Informáticos) - FileZilla + SFTP + Producción

**TOTAL: 8 SIMULACROS COMPLETOS CUBRIENDO TODAS LAS ASIGNATURAS DE DAM PRIMERO**

**Tecnologías dominadas:** HTML5, CSS3 (Flexbox, Grid, Variables), Python, Flask, MySQL, SQLite, SQL (JOINs, Views, FK), Linux (Debian + Ubuntu Server), Apache, FileZilla (SFTP), SSH, Git, Terminal, CRUD completo, Despliegue en producción
