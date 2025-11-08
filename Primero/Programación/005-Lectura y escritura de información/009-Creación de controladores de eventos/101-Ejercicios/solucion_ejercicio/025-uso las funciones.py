import mysql.connector

# Me conecto a la base de datos
conexion = mysql.connector.connect(
    host="localhost",
    user="blogexamen",
    password="Blogexamen123$",
    database="blogexamen"
)

cursor = conexion.cursor()
######################################## FUNCIONES

def bienvenida():
  """
  Muestra el mensaje de bienvenida con el título de la aplicación y la versión.
  
  Esta función imprime en consola el nombre de la aplicación y los créditos.
  Es la primera función que se ejecuta al iniciar el programa.
  
  Args:
    Ninguno
    
  Returns:
    None
    
  Ejemplo:
    >>> bienvenida()
    Gestión de posts
    v0.1 Jose Vicente Carratalá
  """
  print("Gestión de posts")
  print("v0.1 Jose Vicente Carratalá")

def menu():
  """
  Muestra el menú principal con las opciones disponibles y retorna la opción elegida.
  
  Presenta las 4 operaciones CRUD que puede realizar el usuario:
  - Crear entrada nueva
  - Listar entradas existentes
  - Actualizar entrada por ID
  - Eliminar entrada por ID
  
  Args:
    Ninguno
    
  Returns:
    int: Número de opción elegida por el usuario (1-4)
    
  Ejemplo:
    >>> opcion = menu()
    Escoge una opción:
    1.-Crear entrada nueva
    2.-Listar entradas
    3.-Actualizar entrada
    4.-Eliminar entradas
    Escoge una opcion: 2
    >>> print(opcion)
    2
  """
  print("Escoge una opción:")
  print("1.-Crear entrada nueva")
  print("2.-Listar entradas")
  print("3.-Actualizar entrada")
  print("4.-Eliminar entradas")
  opcion = int(input("Escoge una opcion: "))
  return opcion

def insertar():
  """
  Inserta una nueva entrada (post) en la base de datos.
  
  Solicita al usuario los datos necesarios para crear un nuevo post:
  - Título del artículo
  - Fecha de publicación (formato texto)
  - Contenido completo del artículo
  - ID del autor (debe existir en la tabla autores)
  
  La función ejecuta un INSERT INTO y confirma los cambios con commit().
  
  Args:
    Ninguno (solicita datos por input())
    
  Returns:
    None
    
  Ejemplo:
    >>> insertar()
    Introduce el titulo: Carcasa para Raspberry Pi
    Introduce la fecha: 2025-11-02
    Introduce el contenido: Tutorial para diseñar e imprimir carcasa...
    Introduce el id del autor: 1
    
  Nota:
    ⚠️ Esta función usa concatenación de strings en SQL, lo cual NO es seguro.
    En producción debería usarse parametrización: cursor.execute("INSERT...", (titulo, fecha, contenido, autor))
  """
  titulo = input("Introduce el titulo: ")
  fecha = input("Introduce la fecha: ")
  contenido = input("Introduce el contenido: ")
  autor = input("Introduce el id del autor: ")
  cursor.execute("INSERT INTO posts VALUES (NULL,'"+titulo+"','"+fecha+"','"+contenido+"',"+autor+");")
  conexion.commit() 
  
def listar():
  """
  Lista todas las entradas (posts) almacenadas en la base de datos.
  
  Ejecuta un SELECT * FROM posts y muestra cada fila como una tupla.
  Útil para ver los posts existentes antes de actualizar o eliminar.
  
  Args:
    Ninguno
    
  Returns:
    None (imprime en consola)
    
  Ejemplo:
    >>> listar()
    (1, 'Impresión de carcasa RPi', '2025-11-01', 'Contenido del artículo...', 1)
    (2, 'Control de LEDs con GPIO', '2025-11-02', 'Tutorial de programación...', 1)
    
  Formato de cada tupla:
    (Identificador, titulo, fecha, contenido, autor_id)
  """
  cursor.execute("SELECT * FROM posts;")
  filas = cursor.fetchall()
  for fila in filas:
    print(fila)

def actualizar():
  """
  Actualiza una entrada existente en la base de datos por su ID.
  
  Solicita el identificador del post a modificar y los nuevos valores
  para todos los campos (título, fecha, contenido, autor).
  Ejecuta un UPDATE y confirma con commit().
  
  Args:
    Ninguno (solicita datos por input())
    
  Returns:
    None
    
  Ejemplo:
    >>> actualizar()
    Introduce el id de la entrada a actualizar: 3
    Introduce el titulo: Carcasa Raspberry Pi v2
    Introduce la fecha: 2025-11-03
    Introduce el contenido: Segunda versión mejorada con ventilación...
    Introduce el id del autor: 1
    
  Nota:
    Si el ID no existe, MySQL no dará error pero no actualizará ninguna fila.
    Considera añadir validación o mensaje de confirmación.
  """
  identificador = input("Introduce el id de la entrada a actualizar: ")
  titulo = input("Introduce el titulo: ")
  fecha = input("Introduce la fecha: ")
  contenido = input("Introduce el contenido: ")
  autor = input("Introduce el id del autor: ")
  cursor.execute("UPDATE posts SET titulo = '"+titulo+"', fecha = '"+fecha+"', contenido = '"+contenido+"', autor = "+autor+" WHERE Identificador = "+identificador+";")
  conexion.commit()
  
def eliminar():
  """
  Elimina una entrada (post) de la base de datos por su ID.
  
  Solicita el identificador del post a eliminar y ejecuta un DELETE FROM.
  La operación es PERMANENTE y no se puede deshacer.
  Confirma los cambios con commit().
  
  Args:
    Ninguno (solicita ID por input())
    
  Returns:
    None
    
  Ejemplo:
    >>> eliminar()
    Introduce el id de la entrada a eliminar: 5
    
  Advertencia:
    ⚠️ No pide confirmación antes de eliminar.
    Considera añadir un "¿Estás seguro? (S/N)" en producción.
    
  Nota:
    Si el ID no existe, MySQL no dará error pero no eliminará ninguna fila.
  """
  identificador = input("Introduce el id de la entrada a eliminar: ")
  cursor.execute("DELETE FROM posts WHERE Identificador = "+identificador+";")
  conexion.commit()
######################################## FUNCIONES  

# Programa principal
bienvenida()
while True:
  opcion = menu()
  
  if opcion == 1:
    insertar()
  elif opcion == 2:
    listar()
  elif opcion == 3:
    actualizar()
  elif opcion == 4:
    eliminar()
    
    
cursor.close()
conexion.close()
