# w40k_simple.py
# Gestor MUY sencillo de miniaturas de Warhammer 40K
# Sin librerías externas, sin input(), fácil de leer.

# Cada miniatura será un diccionario con:
# {"id": 1, "nombre": "Intercessor", "faccion": "Adeptus Astartes", "puntos": 20}

def crear_repo():
    # Crea la "base de datos" en memoria (lista vacía)
    return []

def id_existe(repo, id_mini):
    # Devuelve True si ya hay una miniatura con ese id
    for m in repo:
        if m["id"] == id_mini:
            return True
    return False

def agregar(repo, mini):
    # Añade una miniatura si el id no está repetido
    if id_existe(repo, mini["id"]):
        print("Error: id repetido:", mini["id"])
        return
    repo.append(mini)

def listar(repo):
    # Devuelve la lista tal cual (para mostrarla)
    return repo

def buscar_nombre(repo, texto):
    # Busca por nombre (sin distinguir mayúsculas)
    t = texto.lower()
    resultados = []
    for m in repo:
        if t in m["nombre"].lower():
            resultados.append(m)
    return resultados

def buscar_faccion(repo, faccion):
    # Filtra por facción exacta (sin distinguir mayúsculas)
    f = faccion.lower()
    resultados = []
    for m in repo:
        if m["faccion"].lower() == f:
            resultados.append(m)
    return resultados

def eliminar(repo, id_mini):
    # Borra por id (si no existe, avisa)
    indice = -1
    for i, m in enumerate(repo):
        if m["id"] == id_mini:
            indice = i
            break
    if indice == -1:
        print("Aviso: no existe el id", id_mini)
        return
    del repo[indice]

# ---------------------------
# DEMOSTRACIÓN (sin input)
# ---------------------------
if __name__ == "__main__":
    bd = crear_repo()

    # Añadimos 3 miniaturas W40K
    agregar(bd, {"id": 1, "nombre": "Intercessor",  "faccion": "Adeptus Astartes", "puntos": 20})
    agregar(bd, {"id": 2, "nombre": "Boyz",         "faccion": "Orkos",            "puntos": 10})
    agregar(bd, {"id": 3, "nombre": "Fire Warrior", "faccion": "T'au",             "puntos": 9})

    # Listar
    print("Listado:")
    print(listar(bd))

    # Buscar por nombre
    print("\nBuscar por nombre 'war':")
    print(buscar_nombre(bd, "war"))

    # Buscar por facción
    print("\nBuscar por facción 'orkos':")
    print(buscar_faccion(bd, "orkos"))

    # Eliminar uno
    eliminar(bd, 2)
    print("\nListado tras eliminar id=2:")
    print(listar(bd))

    # Intento de eliminar inexistente
    eliminar(bd, 999)

    # Intento de id repetido
    agregar(bd, {"id": 1, "nombre": "Duplicado", "faccion": "Adeptus Astartes", "puntos": 25})

    print("\nFin de la demo.")
