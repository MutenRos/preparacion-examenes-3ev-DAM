# Inicializar variables del podio
tiempo_mejor = float('inf')
tiempo_segundo = float('inf')
tiempo_tercero = float('inf')
modelo_mejor = ""
modelo_segundo = ""
modelo_tercero = ""

modelo = input("Introduce el modelo del coche: ")
tiempo = float(input("Introduce el tiempo en segundos: "))

# Ahora la logica para que se auto ordenen
if tiempo < tiempo_mejor:
    # El coche es el nuevo lider - reorganizar el podio
    tiempo_tercero = tiempo_segundo
    modelo_tercero = modelo_segundo
    tiempo_segundo = tiempo_mejor
    modelo_segundo = modelo_mejor
    tiempo_mejor = tiempo
    modelo_mejor = modelo
    print(f"{modelo} es el NUEVO LIDER con {tiempo}s")
elif tiempo < tiempo_segundo:
    # El coche es el segundo mejor - reorganizar
    tiempo_tercero = tiempo_segundo
    modelo_tercero = modelo_segundo
    tiempo_segundo = tiempo
    modelo_segundo = modelo
    print(f"{modelo} ocupa la SEGUNDA posicion con {tiempo}s")
elif tiempo < tiempo_tercero:
    # El coche es el tercer mejor
    tiempo_tercero = tiempo
    modelo_tercero = modelo
    print(f"{modelo} ocupa la TERCERA posicion con {tiempo}s")
else:
    # El coche no entra en el podio
    print("El coche no ha entrado en el podio")
