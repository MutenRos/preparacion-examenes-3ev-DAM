

Sistema de evaluación

El examen es el 50% de la nota de la evaluación

Únicamente puedes consultar tus propios apuntes

No puedes realizar consultas en internet ni usar herramientas de IA durante el examen

Debes grabar tu pantalla en todo momento

Crea tu código con versiones incrementales

Presenta, organiza, y comenta adecuadamente el código

Redacta la respuesta del examen siguiendo la rúbrica de evaluación

Preguntas específicas del examen

Parte desde el código realizado en el examen de programación

Refactoriza el código del examen de programación: Aplica extracción a funciones

Asegúrate de que el código sigue funcionando

Aplica documentación: docstrings, comentarios, comentarios por línea

Crea un repositorio nuevo en GitHub, clónalo en tu equipo, haz commit y push con el proyecto




Pues habiendo completado tarde y "mal" el examen de programacion, procederemos con el de entrornos de desarrollo. Digo mal por que intencionadamente hemos dejado el codigo crudo sin comentar ni organizar, para asi tener material con el que trabajar en este examen. Vamos a refactorizar el codigo y comentarlo adecuadamente para los demas usuarios que puedan llegar a utilizarlo.

Partimos del codigo que teniamos en el examen de programacion:


```Python
import mysql.connector

def conectar():
    return mysql.connector.connect(
        host="localhost",
        user="root",
        password="root",
        database="Examen",
        ssl_disabled=True
    )

def bienvenida():
    print("Bienvenido al gestor de portfolio")
    print(".·.·.·.·.·.·.·.·.·.·.·.·.·.·.·.·.·.")

def ver_proyectos():
    conexion = conectar()
    cursor = conexion.cursor()
    cursor.execute("SELECT * FROM Proyectos")
    proyectos = cursor.fetchall()
    
    print("\n--- Lista de Proyectos ---")
    for proyecto in proyectos:
        print(f"ID: {proyecto[0]}, Nombre: {proyecto[1]}, Descripcion: {proyecto[2]}, Fecha: {proyecto[3]}, Categoria: {proyecto[4]}")
    print()
    
    cursor.close()
    conexion.close()

def anadir_proyecto():
    print("\n--- Añadir Nuevo Proyecto ---")
    nombre = input("Nombre del proyecto: ")
    descripcion = input("Descripción: ")
    fecha = input("Fecha (YYYY-MM-DD): ")
    categoria = input("ID de categoría: ")
    
    conexion = conectar()
    cursor = conexion.cursor()
    sql = "INSERT INTO Proyectos (Nombre, Descripcion, Fecha, Categoria) VALUES (%s, %s, %s, %s)"
    cursor.execute(sql, (nombre, descripcion, fecha, categoria))
    conexion.commit()
    
    print("✔ Proyecto añadido correctamente\n")
    cursor.close()
    conexion.close()

def actualizar_proyecto():
    print("\n--- Actualizar Proyecto ---")
    id_proyecto = input("ID del proyecto a actualizar: ")
    nombre = input("Nuevo nombre: ")
    descripcion = input("Nueva descripción: ")
    fecha = input("Nueva fecha (YYYY-MM-DD): ")
    categoria = input("Nuevo ID de categoría: ")
    
    conexion = conectar()
    cursor = conexion.cursor()
    sql = "UPDATE Proyectos SET Nombre=%s, Descripcion=%s, Fecha=%s, Categoria=%s WHERE ID=%s"
    cursor.execute(sql, (nombre, descripcion, fecha, categoria, id_proyecto))
    conexion.commit()
    
    print("✔ Proyecto actualizado correctamente\n")
    cursor.close()
    conexion.close()

def eliminar_proyecto():
    print("\n--- Eliminar Proyecto ---")
    id_proyecto = input("ID del proyecto a eliminar: ")
    confirmacion = input(f"¿Seguro que quieres eliminar el proyecto {id_proyecto}? (s/n): ")
    
    if confirmacion.lower() == 's':
        conexion = conectar()
        cursor = conexion.cursor()
        sql = "DELETE FROM Proyectos WHERE ID=%s"
        cursor.execute(sql, (id_proyecto,))
        conexion.commit()
        
        print("✔ Proyecto eliminado correctamente\n")
        cursor.close()
        conexion.close()
    else:
        print("⚠ Operación cancelada\n")

def main():
    bienvenida()
    while True:
        print("\nSeleccione una opcion:")
        print("1. Ver proyectos")
        print("2. Añadir proyecto")
        print("3. Actualizar proyecto")
        print("4. Eliminar proyecto")
        print("5. Salir")
        
        opcion = input("Opcion: ")
        
        if opcion == "1":
            ver_proyectos()
        elif opcion == "2":
            anadir_proyecto()
        elif opcion == "3":
            actualizar_proyecto()
        elif opcion == "4":
            eliminar_proyecto()
        elif opcion == "5":
            print("Saliendo...")
            break
        else:
            print("Opcion no valida, intente de nuevo.")

if __name__ == "__main__":
    main()
```

Lo primero que vamos a hacer es comentarlo todo adecuadamente, para poder ver facilmente "que hace que" en el codigo, y a partir de ahi, veremos que podemos refactorizar para mejorar la estructura del codigo y su legibilidad. 

```Python
# crud examen bases de datos
# importacion de la libreria mysql.connector para conectar con la base de datos mysql, si las necesitara, aqui irian las demas librerias a importar.
import mysql.connector
# funcion para conectar con la base de datos mysql
#aqui pondremos nuestras credenciales y las de la base de datos a la que nos queremos conectar
def conectar():
    return mysql.connector.connect(
        host="localhost",
        user="root",
        password="root",
        database="Examen",
        ssl_disabled=True
    )
# este es el mensaje de bienvenida que vera el usuario al iniciar el script y mismo tiempo que nos indica que el script se ha iniciado correctamente.
def bienvenida():
    print("Bienvenido al gestor de portfolio")
    print(".·.·.·.·.·.·.·.·.·.·.·.·.·.·.·.·.·.")
# a continuacion, las 4 operaciones basicas de CRUD (Crear, Leer, Actualizar, Borrar) para gestionar los proyectos en la base de datos. 
# funcion de ver los proyectos almacenados en la base de datos
#aqui se extraen los datos de la tabla indicada
def ver_proyectos():
    conexion = conectar()
    cursor = conexion.cursor()
    cursor.execute("SELECT * FROM Proyectos")
    proyectos = cursor.fetchall()
#aqui se muestran por pantalla los datos extraidos
    print("\n--- Lista de Proyectos ---")
    for proyecto in proyectos:
        print(f"ID: {proyecto[0]}, Nombre: {proyecto[1]}, Descripcion: {proyecto[2]}, Fecha: {proyecto[3]}, Categoria: {proyecto[4]}")
    print()
    #y cerramos la conexion a espera de la siguiente consulta
    cursor.close()
    conexion.close()
# la estructura de todas las demas funciones es similar, cambiando sobretodo la consulta SQL y el resultado mostrado en pantalla.
#esta funcion añade nuevos proyectos a la base de datos
def anadir_proyecto():
    print("\n--- Añadir Nuevo Proyecto ---")
    nombre = input("Nombre del proyecto: ")
    descripcion = input("Descripción: ")
    fecha = input("Fecha (YYYY-MM-DD): ")
    categoria = input("ID de categoría: ")
    
    conexion = conectar()
    cursor = conexion.cursor()
    sql = "INSERT INTO Proyectos (Nombre, Descripcion, Fecha, Categoria) VALUES (%s, %s, %s, %s)"
    cursor.execute(sql, (nombre, descripcion, fecha, categoria))
    conexion.commit()
    
    print("✔ Proyecto añadido correctamente\n")
    cursor.close()
    conexion.close()
#aqui modificariamos los datos de un proyecto ya existente
def actualizar_proyecto():
    print("\n--- Actualizar Proyecto ---")
    id_proyecto = input("ID del proyecto a actualizar: ")
    nombre = input("Nuevo nombre: ")
    descripcion = input("Nueva descripción: ")
    fecha = input("Nueva fecha (YYYY-MM-DD): ")
    categoria = input("Nuevo ID de categoría: ")
    
    conexion = conectar()
    cursor = conexion.cursor()
    sql = "UPDATE Proyectos SET Nombre=%s, Descripcion=%s, Fecha=%s, Categoria=%s WHERE ID=%s"
    cursor.execute(sql, (nombre, descripcion, fecha, categoria, id_proyecto))
    conexion.commit()
    
    print("✔ Proyecto actualizado correctamente\n")
    cursor.close()
    conexion.close()
#y aqui con toda la precaucion del mundo, es donde eliminariamos un proyecto de la base de datos. 
#con todo el cuidado del mundo, ya que esta es una accion irreversible, a no ser que dispongamos de copia de seguridad, por eso añadimos una confirmacion, para hacer mas dificil el borrado accidenatl.
def eliminar_proyecto():
    print("\n--- Eliminar Proyecto ---")
    id_proyecto = input("ID del proyecto a eliminar: ")
    confirmacion = input(f"¿Seguro que quieres eliminar el proyecto {id_proyecto}? (s/n): ")
    
    if confirmacion.lower() == 's':
        conexion = conectar()
        cursor = conexion.cursor()
        sql = "DELETE FROM Proyectos WHERE ID=%s"
        cursor.execute(sql, (id_proyecto,))
        conexion.commit()
        
        print("✔ Proyecto eliminado correctamente\n")
        cursor.close()
        conexion.close()
    else:
        print("⚠ Operación cancelada\n")
#bucle principal del programa, que myestra el menu de CRUD y gestiona los inputs del usuario
def main():
    bienvenida()
    while True:
        print("\nSeleccione una opcion:")
        print("1. Ver proyectos")   #mostrar los proyectos almacenados
        print("2. Añadir proyecto")  #añadir un nuevo proyecto a la base de datos
        print("3. Actualizar proyecto")  #modificar un proyecto existente
        print("4. Eliminar proyecto")  #eliminar un proyecto de la base de datos
        print("5. Salir")  #salir del programa
        
        opcion = input("Opcion: ")
        
        if opcion == "1":
            ver_proyectos() #llamada a la funcion de ver proyectos
        elif opcion == "2":
            anadir_proyecto()  #llamada a la funcion de añadir proyecto
        elif opcion == "3":
            actualizar_proyecto()  #llamada a la funcion de actualizar proyecto
        elif opcion == "4":
            eliminar_proyecto()  #llamada a la funcion de eliminar proyecto
        elif opcion == "5":
            print("Saliendo...")
            break
        else:
            print("Opcion no valida, intente de nuevo.")

if __name__ == "__main__":  

    main()  #llamada a la funcion principal para iniciar el programa
```


Ahora que ya tenemos el codigo comentado, vamos a ver que podemos refactorizar para mejorar su legibilidad y estructura. Podemos empezar por agrupar las funciones relacionadas en clases, por ejemplo, una clase para gestionar la conexion a la base de datos y otra para las operaciones CRUD. 
Aunque hay veces que no es necesario refactorizar (este codigo no lo veria necesario, posible si, pero necesario no, ya que es un codigo simple y directo), es importante saber cuando hacerlo y cuando no, para no complicar innecesariamente el codigo. Aun asi, lo vamos a refactorizar por "vicio", y por que de eso va el examen.

```Python

# Importación de la librería mysql.connector para conectar con MySQL
import mysql.connector

class DatabaseConnection:

    def __init__(self, host, user, password, database):
        
        self.host = "localhost"          # Guardamos el host
        self.user = "root"              # Guardamos el usuario
        self.password = "root"      # Guardamos la contraseña
        self.database = "Examen"      # Guardamos el nombre de la BD

    def connect(self):
        
        return mysql.connector.connect(
            host=self.host,
            user=self.user,
            password=self.password,
            database=self.database,
            ssl_disabled=True         # Deshabilitamos SSL por compatibilidad
        )

class ProjectManager:
   
    
    def __init__(self, db_connection):
      
        self.db_connection = db_connection  # Guardamos la conexión
    
    def ver_proyectos(self):
        
        # Conectamos a la base de datos
        conexion = self.db_connection.connect()
        cursor = conexion.cursor()
        
        # Ejecutamos la consulta SELECT para obtener todos los proyectos
        cursor.execute("SELECT * FROM Proyectos")
        proyectos = cursor.fetchall()  # Obtenemos todos los resultados
        
        # Mostramos los proyectos por pantalla
        print("\n--- Lista de Proyectos ---")
        for proyecto in proyectos:
            print(f"ID: {proyecto[0]}, Nombre: {proyecto[1]}, Descripcion: {proyecto[2]}, Fecha: {proyecto[3]}, Categoria: {proyecto[4]}")
        print()
        
        # Cerramos cursor y conexión
        cursor.close()
        conexion.close()
    
    def anadir_proyecto(self):
    
        print("\n--- Añadir Nuevo Proyecto ---")
        
        # Solicitamos datos del nuevo proyecto al usuario
        nombre = input("Nombre del proyecto: ")
        descripcion = input("Descripción: ")
        fecha = input("Fecha (YYYY-MM-DD): ")
        categoria = input("ID de categoría: ")
        
        # Conectamos a la base de datos
        conexion = self.db_connection.connect()
        cursor = conexion.cursor()
        
        # Preparamos la consulta INSERT con placeholders para evitar SQL injection
        sql = "INSERT INTO Proyectos (Nombre, Descripcion, Fecha, Categoria) VALUES (%s, %s, %s, %s)"
        cursor.execute(sql, (nombre, descripcion, fecha, categoria))
        conexion.commit()  # Confirmamos los cambios
        
        print("✔ Proyecto añadido correctamente\n")
        
        # Cerramos cursor y conexión
        cursor.close()
        conexion.close()
    
    def actualizar_proyecto(self):
    
        print("\n--- Actualizar Proyecto ---")
        
        # Solicitamos ID del proyecto a actualizar y los nuevos datos
        id_proyecto = input("ID del proyecto a actualizar: ")
        nombre = input("Nuevo nombre: ")
        descripcion = input("Nueva descripción: ")
        fecha = input("Nueva fecha (YYYY-MM-DD): ")
        categoria = input("Nuevo ID de categoría: ")
        
        # Conectamos a la base de datos
        conexion = self.db_connection.connect()
        cursor = conexion.cursor()
        
        # Ejecutamos UPDATE con los nuevos valores
        sql = "UPDATE Proyectos SET Nombre=%s, Descripcion=%s, Fecha=%s, Categoria=%s WHERE ID=%s"
        cursor.execute(sql, (nombre, descripcion, fecha, categoria, id_proyecto))
        conexion.commit()  # Confirmamos los cambios
        
        print("✔ Proyecto actualizado correctamente\n")
        
        # Cerramos cursor y conexión
        cursor.close()
        conexion.close()
    
    def eliminar_proyecto(self):
 
        print("\n--- Eliminar Proyecto ---")
        
        # Solicitamos ID del proyecto a eliminar
        id_proyecto = input("ID del proyecto a eliminar: ")
        # Pedimos confirmación para evitar borrados accidentales
        confirmacion = input(f"¿Seguro que quieres eliminar el proyecto {id_proyecto}? (s/n): ")
        
        if confirmacion.lower() == 's':
            # Si el usuario confirma, procedemos con la eliminación
            conexion = self.db_connection.connect()
            cursor = conexion.cursor()
            
            # Ejecutamos DELETE
            sql = "DELETE FROM Proyectos WHERE ID=%s"
            cursor.execute(sql, (id_proyecto,))
            conexion.commit()  # Confirmamos los cambios
            
            print("✔ Proyecto eliminado correctamente\n")
            
            # Cerramos cursor y conexión
            cursor.close()
            conexion.close()
        else:
            # Si el usuario cancela, no hacemos nada
            print("⚠ Operación cancelada\n")

def bienvenida():
  
    print("Bienvenido al gestor de portfolio")
    print(".·.·.·.·.·.·.·.·.·.·.·.·.·.·.·.·.·.")

def main():
 
    # Mostramos mensaje de bienvenida
    bienvenida()
    
    # Creamos la conexión a la base de datos con las credenciales
    db_connection = DatabaseConnection("localhost", "root", "root", "Examen")
    
    # Inicializamos el gestor de proyectos
    project_manager = ProjectManager(db_connection)
    
    # Bucle principal del menú
    while True:
        # Mostramos las opciones disponibles
        print("\nSeleccione una opcion:")
        print("1. Ver proyectos")          # Listar todos los proyectos (READ)
        print("2. Añadir proyecto")        # Crear un nuevo proyecto (CREATE)
        print("3. Actualizar proyecto")    # Modificar un proyecto (UPDATE)
        print("4. Eliminar proyecto")      # Borrar un proyecto (DELETE)
        print("5. Salir")                  # Cerrar la aplicación
        
        # Capturamos la opción del usuario
        opcion = input("Opcion: ")
        
        # Procesamos la opción seleccionada
        if opcion == "1":
            project_manager.ver_proyectos()        # Llamamos a ver proyectos
        elif opcion == "2":
            project_manager.anadir_proyecto()      # Llamamos a añadir proyecto
        elif opcion == "3":
            project_manager.actualizar_proyecto()  # Llamamos a actualizar proyecto
        elif opcion == "4":
            project_manager.eliminar_proyecto()    # Llamamos a eliminar proyecto
        elif opcion == "5":
            print("Saliendo...")
            break  # Salimos del bucle y terminamos el programa
        else:
            print("Opcion no valida, intente de nuevo.")

# Punto de entrada del programa
if __name__ == "__main__":  
    main()  # Ejecutamos la función principal
```

Al usar clases, hemos conseguido agrupar las funciones relacionadas, mejorando la organizacion del código y facilitando su mantenimiento, y gracias a los comentarios, cualquiera puede ver de lejos que parte se puede modificar para hacer cambios o ampliaciones en el futuro sin necesidad de consultarnos. El codigo, como podemos observar, se ha quedado mas o menos igual de extenso que antes, pero nos lo veiamos venir, por eso dijimos que no iba a ser tan necesario refactorizar, pero ordenado sy mejor comentado si que nos ha quedado.
y tras comprobar que funcxiona exactamente igualq ue antes, solo nos queda publicarlo en github ya que la base de datos la teniamos creada del examen de bases de datos.
``bash
git init
git add .
git commit -m "Examen 1ª Evaluación Entornos de Desarrollo - Refactorización y Documentación"
git branch -M main
git remote add origin <https://github.com/MutenRos/ExamenEntornos>
git push -u origin main
```

Cuando escuchemos el "clack" del teclado, sabremos que hemos terminado y que nuestro proyecto esta en github.
