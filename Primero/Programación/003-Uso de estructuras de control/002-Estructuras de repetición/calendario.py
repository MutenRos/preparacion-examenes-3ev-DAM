
import datetime
hoy = datetime.date.today()
print(f"Hoy es: {hoy.day}/{hoy.month}/{hoy.year}")
meses = {
    1: "Enero", 2: "Febrero", 3: "Marzo", 4: "Abril",
    5: "Mayo", 6: "Junio", 7: "Julio", 8: "Agosto",
    9: "Septiembre", 10: "Octubre", 11: "Noviembre", 12: "Diciembre"
}
dias_en_mes = {
    1: 31, 2: 28, 3: 31, 4: 30,
    5: 31, 6: 30, 7: 31, 8: 31,
    9: 30, 10: 31, 11: 30, 12: 31
}
for mes in range(1, 13):
    print(f"\n{meses[mes]}:")
    for dia in range(1, dias_en_mes[mes] + 1):
        print(f"{dia}/{mes}")
notas = {}
dia_nota = int(input("Introduce el dia para añadir una nota con el formato DD/MM/AAAA: ").split('/')[0])
nota = input("Introduce la nota: ")
notas[dia_nota] = nota
print(f"Nota añadida para el dia {dia_nota}: {notas[dia_nota]}")