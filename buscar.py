import os

keyword = input("Introduce el keyword a buscar: ").lower()

for root, dirs, files in os.walk("."):
    for filename in files:
        filepath = os.path.join(root, filename)

        try:
            with open(filepath, "r", encoding="utf-8", errors="ignore") as f:
                for line_number, line in enumerate(f, start=1):
                    if keyword in line.lower():
                        print(f"[{filepath}] Línea {line_number}: {line.strip()}")
        except:
            # Archivo binario o sin permisos, lo ignoramos
            pass

