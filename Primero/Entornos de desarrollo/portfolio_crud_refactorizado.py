"""
Sistema de Gestión de Portfolio - Versión Refactorizada
Aplicación CRUD para gestionar proyectos en una base de datos MySQL
Autor: Dario
Fecha: Noviembre 2025
"""

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
            host (str): Dirección del servidor MySQL
            user (str): Usuario de la base de datos
            password (str): Contraseña del usuario
            database (str): Nombre de la base de datos a utilizar
        """
        self.host = host
        self.user = user
        self.password = password
        self.database = database

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
            ssl_disabled=True
        )

class ProjectManager:
    """
    Clase para gestionar las operaciones CRUD sobre la tabla de Proyectos.
    Implementa las operaciones: Crear, Leer, Actualizar y Eliminar.
    """
    
    def __init__(self, db_connection):
        """
        Inicializa el gestor de proyectos con una conexión a la base de datos.
        
        Args:
            db_connection (DatabaseConnection): Objeto de conexión a la base de datos
        """
        self.db_connection = db_connection
    
    def ver_proyectos(self):
        """
        Lista todos los proyectos almacenados en la base de datos.
        Muestra: ID, Nombre, Descripción, Fecha y Categoría de cada proyecto.
        """
        conexion = self.db_connection.connect()
        cursor = conexion.cursor()
        cursor.execute("SELECT * FROM Proyectos")
        proyectos = cursor.fetchall()
        
        print("\n--- Lista de Proyectos ---")
        for proyecto in proyectos:
            print(f"ID: {proyecto[0]}, Nombre: {proyecto[1]}, Descripcion: {proyecto[2]}, Fecha: {proyecto[3]}, Categoria: {proyecto[4]}")
        print()
        
        cursor.close()
        conexion.close()
    
    def anadir_proyecto(self):
        """
        Añade un nuevo proyecto a la base de datos.
        Solicita al usuario: nombre, descripción, fecha y categoría del proyecto.
        """
        print("\n--- Añadir Nuevo Proyecto ---")
        nombre = input("Nombre del proyecto: ")
        descripcion = input("Descripción: ")
        fecha = input("Fecha (YYYY-MM-DD): ")
        categoria = input("ID de categoría: ")
        
        conexion = self.db_connection.connect()
        cursor = conexion.cursor()
        sql = "INSERT INTO Proyectos (Nombre, Descripcion, Fecha, Categoria) VALUES (%s, %s, %s, %s)"
        cursor.execute(sql, (nombre, descripcion, fecha, categoria))
        conexion.commit()
        
        print("✔ Proyecto añadido correctamente\n")
        cursor.close()
        conexion.close()
    
    def actualizar_proyecto(self):
        """
        Actualiza un proyecto existente en la base de datos.
        Solicita el ID del proyecto a actualizar y los nuevos valores para sus campos.
        """
        print("\n--- Actualizar Proyecto ---")
        id_proyecto = input("ID del proyecto a actualizar: ")
        nombre = input("Nuevo nombre: ")
        descripcion = input("Nueva descripción: ")
        fecha = input("Nueva fecha (YYYY-MM-DD): ")
        categoria = input("Nuevo ID de categoría: ")
        
        conexion = self.db_connection.connect()
        cursor = conexion.cursor()
        sql = "UPDATE Proyectos SET Nombre=%s, Descripcion=%s, Fecha=%s, Categoria=%s WHERE ID=%s"
        cursor.execute(sql, (nombre, descripcion, fecha, categoria, id_proyecto))
        conexion.commit()
        
        print("✔ Proyecto actualizado correctamente\n")
        cursor.close()
        conexion.close()
    
    def eliminar_proyecto(self):
        """
        Elimina un proyecto de la base de datos.
        Solicita confirmación antes de proceder con la eliminación (operación irreversible).
        """
        print("\n--- Eliminar Proyecto ---")
        id_proyecto = input("ID del proyecto a eliminar: ")
        confirmacion = input(f"¿Seguro que quieres eliminar el proyecto {id_proyecto}? (s/n): ")
        
        if confirmacion.lower() == 's':
            conexion = self.db_connection.connect()
            cursor = conexion.cursor()
            sql = "DELETE FROM Proyectos WHERE ID=%s"
            cursor.execute(sql, (id_proyecto,))
            conexion.commit()
            
            print("✔ Proyecto eliminado correctamente\n")
            cursor.close()
            conexion.close()
        else:
            print("⚠ Operación cancelada\n")

def bienvenida():
    """
    Muestra el mensaje de bienvenida al usuario al iniciar la aplicación.
    """
    print("Bienvenido al gestor de portfolio")
    print(".·.·.·.·.·.·.·.·.·.·.·.·.·.·.·.·.·.")

def main():
    """
    Función principal que ejecuta el bucle del menú de la aplicación.
    Gestiona la interacción del usuario con las operaciones CRUD.
    """
    bienvenida()
    
    # Configuración de la conexión a la base de datos
    db_connection = DatabaseConnection(
        host="localhost",
        user="root",
        password="root",
        database="Examen"
    )
    
    # Inicialización del gestor de proyectos
    project_manager = ProjectManager(db_connection)
    
    # Bucle principal del menú
    while True:
        print("\nSeleccione una opcion:")
        print("1. Ver proyectos")          # Listar todos los proyectos
        print("2. Añadir proyecto")        # Crear un nuevo proyecto
        print("3. Actualizar proyecto")    # Modificar un proyecto existente
        print("4. Eliminar proyecto")      # Borrar un proyecto
        print("5. Salir")                  # Cerrar la aplicación
        
        opcion = input("Opcion: ")
        
        if opcion == "1":
            project_manager.ver_proyectos()
        elif opcion == "2":
            project_manager.anadir_proyecto()
        elif opcion == "3":
            project_manager.actualizar_proyecto()
        elif opcion == "4":
            project_manager.eliminar_proyecto()
        elif opcion == "5":
            print("Saliendo...")
            break
        else:
            print("Opcion no valida, intente de nuevo.")

if __name__ == "__main__":
    main()
