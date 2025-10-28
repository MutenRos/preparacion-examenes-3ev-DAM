class Cliente:
    def __init__(self, nombre, apellido1, email):
        self.nombre = nombre
        self.apellido1 = apellido1
        self.email = email
    def __str__(self):
        return f"{self.nombre} {self.apellido1} - {self.email}"
def guardar_cliente(cliente):
    with open("agenda_clientes.txt", "a") as archivo:
        archivo.write(f"{cliente.nombre},{cliente.apellido1},{cliente.email}\n")
def listar_clientes():
    print("Lista de clientes:")
    try:
        with open("agenda_clientes.txt", "r") as archivo:
            for linea in archivo:
                nombre, apellido1, email = linea.strip().split(",")
                cliente = Cliente(nombre, apellido1, email)
                print(cliente)
    except FileNotFoundError:
        print("No hay clientes registrados.")
def actualizar_cliente(email_viejo, nuevo_nombre, nuevo_apellido1, nuevo_email):
    clientes = []
    try:
        with open("agenda_clientes.txt", "r") as archivo:
            for linea in archivo:
                nombre, apellido1, email = linea.strip().split(",")
                clientes.append(Cliente(nombre, apellido1, email))
    except FileNotFoundError:
        print("No hay clientes registrados.")
        return
    for cliente in clientes:
        if cliente.email == email_viejo:
            cliente.nombre = nuevo_nombre
            cliente.apellido1 = nuevo_apellido1
            cliente.email = nuevo_email
            break
    else:
        print("Cliente no encontrado.")
        return
    with open("agenda_clientes.txt", "w") as archivo:
        for cliente in clientes:
            archivo.write(f"{cliente.nombre},{cliente.apellido1},{cliente.email}\n")
    print("Cliente actualizado.")
def eliminar_cliente(email):
    clientes = []
    try:
        with open("agenda_clientes.txt", "r") as archivo:
            for linea in archivo:
                nombre, apellido1, email_cliente = linea.strip().split(",")
                clientes.append(Cliente(nombre, apellido1, email_cliente))
    except FileNotFoundError:
        print("No hay clientes registrados.")
        return
    for cliente in clientes:
        if cliente.email == email:
            clientes.remove(cliente)
            break
    else:
        print("Cliente no encontrado.")
        return
    with open("agenda_clientes.txt", "w") as archivo:
        for cliente in clientes:
            archivo.write(f"{cliente.nombre},{cliente.apellido1},{cliente.email}\n")
    print("Cliente eliminado.")
def mostrar_menu():
    print("1. Insertar cliente")
    print("2. Listar clientes")
    print("3. Actualizar cliente")
    print("4. Eliminar cliente")
def imprimeBienvenida():
    print("Bienvenido a la Agenda de Clientes")
imprimeBienvenida()
mostrar_menu()
opcion = input("Elige una opción (1-4): ")
if opcion == "1":
    nombre = input("Introduce el nombre del nuevo cliente: ")
    apellido1 = input("Introduce el primer apellido del nuevo cliente: ")
    email = input("Introduce el email del nuevo cliente: ")
    nuevo_cliente = Cliente(nombre, apellido1, email)
    guardar_cliente(nuevo_cliente)
    print("Cliente insertado.")
elif opcion == "2":
    listar_clientes()
elif opcion == "3":
    email_viejo = input("Introduce el email del cliente a actualizar: ")
    nuevo_nombre = input("Introduce el nuevo nombre del cliente: ")
    nuevo_apellido1 = input("Introduce el nuevo primer apellido del cliente: ")
    nuevo_email = input("Introduce el nuevo email del cliente: ")
    actualizar_cliente(email_viejo, nuevo_nombre, nuevo_apellido1, nuevo_email)
elif opcion == "4":
    email = input("Introduce el email del cliente a eliminar: ")
    eliminar_cliente(email)
    
