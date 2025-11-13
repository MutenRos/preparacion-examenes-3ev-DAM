

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
"""
Sistema de Gestión de Portfolio - Versión Refactorizada
Aplicación CRUD para gestionar proyectos en una base de datos MySQL
Autor: Dario
Fecha: Noviembre 2025
"""

# Importación de la librería mysql.connector para conectar con MySQL
import mysql.connector

class DatabaseConnection:
    """
    Clase para gestionar la conexión a la base de datos MySQL.
    Encapsula las credenciales y el método de conexión.
    """
    
    def __init__(self, host, user, password, database):
        """
        Inicializa los parámetros de conexión a la base de datos.
        
        Args:
            host (str): Dirección del servidor MySQL (localhost)
            user (str): Usuario de la base de datos (root)
            password (str): Contraseña del usuario (root)
            database (str): Nombre de la base de datos (Examen)
        """
        self.host = host              # Guardamos el host
        self.user = user              # Guardamos el usuario
        self.password = password      # Guardamos la contraseña
        self.database = database      # Guardamos el nombre de la BD

    def connect(self):
        """
        Establece y retorna una conexión con la base de datos MySQL.
        SSL está deshabilitado para evitar problemas de compatibilidad.
        
        Returns:
            connection: Objeto de conexión MySQL
        """
        return mysql.connector.connect(
            host=self.host,
            user=self.user,
            password=self.password,
            database=self.database,
            ssl_disabled=True         # Deshabilitamos SSL por compatibilidad
        )

class ProjectManager:
    """
    Clase para gestionar las operaciones CRUD sobre la tabla de Proyectos.
    Implementa: Crear, Leer, Actualizar y Eliminar proyectos.
    """
    
    def __init__(self, db_connection):
        """
        Inicializa el gestor de proyectos con una conexión a la BD.
        
        Args:
            db_connection (DatabaseConnection): Objeto de conexión a la BD
        """
        self.db_connection = db_connection  # Guardamos la conexión
    
    def ver_proyectos(self):
        """
        Lista todos los proyectos almacenados en la base de datos.
        Muestra: ID, Nombre, Descripción, Fecha y Categoría.
        """
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
        """
        Añade un nuevo proyecto a la base de datos.
        Solicita: nombre, descripción, fecha y categoría del proyecto.
        """
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
        """
        Actualiza un proyecto existente en la base de datos.
        Solicita el ID del proyecto y los nuevos valores para sus campos.
        """
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
        """
        Elimina un proyecto de la base de datos.
        Solicita confirmación antes de eliminar (operación irreversible).
        """
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
    """
    Muestra el mensaje de bienvenida al usuario al iniciar la aplicación.
    Indica que el script se ha iniciado correctamente.
    """
    print("Bienvenido al gestor de portfolio")
    print(".·.·.·.·.·.·.·.·.·.·.·.·.·.·.·.·.·.")

def main():
    """
    Función principal que ejecuta el bucle del menú de la aplicación.
    Gestiona la interacción del usuario con las operaciones CRUD.
    """
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

Así tenemos nuestro código refactorizado con:
- ✅ **Clases bien definidas**: `DatabaseConnection` para la gestión de la conexión y `ProjectManager` para las operaciones CRUD
- ✅ **Código organizado**: Separación de responsabilidades clara
- ✅ **Documentación completa**: Docstrings y comentarios explicativos
- ✅ **Mantenibilidad mejorada**: Fácil de extender y modificar
- ✅ **Función bienvenida incluida**: No faltaba nada

El código está listo para el examen de Entornos de Desarrollo. Ahora solo faltaría subirlo a GitHub siguiendo las instrucciones del examen:

1. Crear un repositorio nuevo en GitHub
2. Clonarlo en tu equipo
3. Añadir el archivo refactorizado
4. Hacer commit con un mensaje descriptivo
5. Push al repositorio

Y con esto, ¡otro 10 más conseguido! 🎯