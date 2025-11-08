from flask import Flask 
import mysql.connector

conexion = mysql.connector.connect(
    host="localhost",
    user="blogexamen",
    password="Blogexamen123$",
    database="blogexamen"
)

cursor = conexion.cursor() 

aplicacion = Flask(__name__)

@aplicacion.route("/")
def raiz():
  cadena = '''
    <!doctype html>
    <html>
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Blog de Proyectos 3D - RaspberryPi</title>
        <style>
          /* Reset y configuración base */
          * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
          }
          
          body, html {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
          }
          
          /* Contenedor principal con sombra y bordes redondeados */
          header, main, footer {
            background: white;
            padding: 40px;
            max-width: 800px;
            margin: 20px auto;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
          }
          
          /* Header con gradiente y mejor tipografía */
          header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            padding: 50px;
            border-radius: 15px 15px 0 0;
            margin-bottom: 0;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
          }
          
          header h1 {
            font-size: 2.5em;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            letter-spacing: 1px;
          }
          
          /* Main con espaciado mejorado */
          main {
            display: flex;
            flex-direction: column;
            gap: 30px;
            padding: 40px;
            border-radius: 0;
            margin-top: 0;
            margin-bottom: 0;
          }
          
          /* Artículos con hover effect y mejor diseño */
          article {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 30px;
            border-radius: 12px;
            border-left: 5px solid #667eea;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
          }
          
          article:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            border-left-width: 8px;
          }
          
          article h3 {
            color: #667eea;
            font-size: 1.8em;
            margin-bottom: 15px;
            font-weight: 600;
          }
          
          article time {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9em;
            margin-bottom: 15px;
            font-weight: 500;
          }
          
          article p {
            color: #333;
            line-height: 1.8;
            margin: 10px 0;
            font-size: 1.05em;
          }
          
          article p:first-of-type {
            font-style: italic;
            color: #666;
            font-weight: 500;
          }
          
          /* Footer mejorado */
          footer {
            background: #2d3748;
            color: white;
            text-align: center;
            padding: 30px;
            border-radius: 0 0 15px 15px;
            margin-top: 0;
            font-size: 0.95em;
          }
          
          /* Animación sutil para los artículos */
          @keyframes fadeIn {
            from {
              opacity: 0;
              transform: translateY(20px);
            }
            to {
              opacity: 1;
              transform: translateY(0);
            }
          }
          
          article {
            animation: fadeIn 0.5s ease;
          }
          
          /* Responsive design */
          @media (max-width: 768px) {
            header, main, footer {
              padding: 20px;
              margin: 10px;
            }
            
            header h1 {
              font-size: 1.8em;
            }
            
            article h3 {
              font-size: 1.4em;
            }
          }
        </style>  
      </head>
      <body>
        <header>
          <h1>🖨️ Blog de Proyectos 3D 🔧</h1>
        </header>
        <main>'''
  cursor.execute("SELECT * FROM posts_completos;")
  filas = cursor.fetchall()
  for fila in filas:
    cadena += '''
          <article>
            <h3>'''+fila[0]+'''</h3>
            <time>📅 '''+fila[1]+'''</time>
            <p>✍️ Por: '''+fila[3]+''' '''+fila[4]+'''</p>
            <p>'''+fila[2]+'''</p>
          </article>
    '''
  cadena += '''
        </main>
        <footer>
          <p>© 2025 Blog de Impresión 3D y Raspberry Pi</p>
          <p>Desarrollado con Flask y MySQL 🐍</p>
        </footer>
      </body>
    </html>
  '''
  return cadena
  
if __name__ == "__main__":
  aplicacion.run(debug=True, port=5000)
