import tkinter as tk
import csv
# Crear ventana principal
ventana = tk.Tk()
ventana.title("Sistema de Impresión 3D")
# Etiquetas y entradas de texto
tk.Label(ventana, text="Nombre:").pack()
entrada_nombre = tk.Entry(ventana)
entrada_nombre.pack()
tk.Label(ventana, text="Apellidos:").pack()
entrada_apellidos = tk.Entry(ventana)
entrada_apellidos.pack()
tk.Label(ventana, text="Email:").pack()
entrada_email = tk.Entry(ventana)
entrada_email.pack()
def guardar_datos():
    nombre = entrada_nombre.get()
    apellidos = entrada_apellidos.get()
    email = entrada_email.get()
    with open('clientes.csv', 'a', newline='') as archivo:
        escritor = csv.writer(archivo)
        escritor.writerow([nombre, apellidos, email])
    actualizar_area_texto()
boton_guardar = tk.Button(ventana, text="Guardar Cliente", command=guardar_datos)
boton_guardar.pack()
# Área de texto para mostrar clientes
area_texto = tk.Text(ventana, height=10, width=50)
area_texto.pack()
def actualizar_area_texto():
    area_texto.delete(1.0, tk.END)
    try:
        with open('clientes.csv', 'r') as archivo:
            lector = csv.reader(archivo)
            for fila in lector:
                area_texto.insert(tk.END, f"Nombre: {fila[0]}, Apellidos: {fila[1]}, Email: {fila[2]}\n")
    except FileNotFoundError:
        pass
actualizar_area_texto()
# Iniciar el bucle principal de la interfaz gráfica
ventana.mainloop()