import tkinter as tk
import os
import sqlite3
from tkinter import messagebox

def procesar():
    """Función que procesa la indexación de archivos"""
    carpeta = entry_carpeta.get()
    disco = entry_disco.get()
    
    # Validar que ambos campos no estén vacíos
    if not carpeta or not disco:
        messagebox.showerror("Error", "Ambos campos son obligatorios.")
        return
    
    # Validar que la carpeta exista
    if not os.path.exists(carpeta):
        messagebox.showerror("Error", "La carpeta especificada no existe.")
        return
    
    try:
        # Conectar a la base de datos
        conn = sqlite3.connect("discos.db")
        cursor = conn.cursor()
        
        archivos_indexados = 0
        
        # Recorrer el directorio especificado
        for root, dirs, files in os.walk(carpeta):
            for file in files:
                try:
                    ruta_completa = os.path.join(root, file)
                    tamanio = os.path.getsize(ruta_completa)
                    creacion = int(os.path.getctime(ruta_completa))
                    modificacion = int(os.path.getmtime(ruta_completa))
                    
                    # Insertar en la base de datos
                    cursor.execute("""
                        INSERT INTO archivos (disco, ruta, archivo, tamanio, creacion, modificacion)
                        VALUES (?, ?, ?, ?, ?, ?)
                    """, (disco, root, file, tamanio, creacion, modificacion))
                    
                    archivos_indexados += 1
                    
                except Exception as e:
                    # Si hay error con un archivo específico, continuar con el siguiente
                    print(f"Error al procesar {file}: {e}")
                    continue
        
        # Guardar cambios y cerrar conexión
        conn.commit()
        conn.close()
        
        messagebox.showinfo("Éxito", f"Se indexaron {archivos_indexados} archivos correctamente.")
        
        # Limpiar los campos de entrada
        entry_carpeta.delete(0, tk.END)
        entry_disco.delete(0, tk.END)
        
    except sqlite3.Error as e:
        messagebox.showerror("Error de Base de Datos", f"Error al conectar con la base de datos: {e}")
    except Exception as e:
        messagebox.showerror("Error", f"Error inesperado: {e}")

# Crear la ventana principal
root = tk.Tk()
root.title("Indexador de Archivos")
root.geometry("500x200")

# Crear y posicionar los widgets
tk.Label(root, text="Carpeta a indexar:").pack(pady=5)
entry_carpeta = tk.Entry(root, width=50)
entry_carpeta.pack(pady=5)

tk.Label(root, text="Nombre del disco:").pack(pady=5)
entry_disco = tk.Entry(root, width=50)
entry_disco.pack(pady=5)

tk.Button(root, text="Procesar", command=procesar, bg="#4CAF50", fg="white", padx=20, pady=10).pack(pady=20)

# Iniciar el loop de la aplicación
root.mainloop()
