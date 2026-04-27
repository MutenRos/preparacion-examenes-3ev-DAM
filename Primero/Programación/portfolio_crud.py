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
