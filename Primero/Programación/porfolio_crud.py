import mysql.connector

def conectar():
    return mysql.connector.connect(
        host="localhost",
        user="dario",
        password="692145043-Dario",
        database="Examen"
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
                5RUD completas
- Manejar entrada de usuario con validación
- Crear menús interactivos con while/if/elif
- Gestionar cursores y conexiones de base de datos
- Confirmar operaciones críticas antes de ejecutarlas

Y con esto, otro 10 más para la saca! 🎯
- Añadir proyecto (Create)
```python
def anadir_proyecto():
    nombre = input("Nomb
            else:
                toast_error("Opción no válida")
                
    finally:
        conn.close()

if __name__ == "__main__":
    main()def conectar():
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
