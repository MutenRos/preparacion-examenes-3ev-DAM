import requests
import time

# --------------------------------------------------
# CONFIGURACIÓN
# --------------------------------------------------
ARCHIVO_TEMARIO = "programacion.txt"
ARCHIVO_SALIDA = "resultado.md"

IA_RAZONAMIENTO = "llama3.1:8b"
IA_CODIGO = "codellama:7b"

URL = "http://localhost:11434/api/generate"
SISTEMA = "en C++"

# Opcional: pequeña pausa entre peticiones para no saturar
PAUSA_ENTRE_PETICIONES = 1


# --------------------------------------------------
# FUNCIONES AUXILIARES
# --------------------------------------------------
def leer_archivo(ruta):
    with open(ruta, "r", encoding="utf-8") as f:
        return f.read()


def leer_lineas(ruta):
    with open(ruta, "r", encoding="utf-8") as f:
        return f.readlines()


def limpiar_salida(ruta):
    with open(ruta, "w", encoding="utf-8") as f:
        f.write("# Temario generado automáticamente\n\n")


def append_salida(ruta, texto):
    with open(ruta, "a", encoding="utf-8") as f:
        f.write(texto)
        f.flush()


def llamar_ollama(modelo, prompt):
    data = {
        "model": modelo,
        "prompt": prompt,
        "stream": False
    }

    try:
        response = requests.post(URL, json=data, timeout=300)
        response.raise_for_status()
        datos = response.json()
        return datos.get("response", "").strip()
    except Exception as e:
        return f"Error al consultar el modelo {modelo}: {e}"


def es_unidad(linea):
    """
    Consideramos unidad una línea que:
    - no empieza por '−'
    - termina en ':'
    """
    linea = linea.strip()
    return bool(linea) and (not linea.startswith("−")) and linea.endswith(":")


def es_subunidad(linea):
    """
    Consideramos subunidad una línea que empieza por '−'
    """
    linea = linea.strip()
    return linea.startswith("−")


def quitar_marca_subunidad(linea):
    return linea.strip().lstrip("−").strip()


def construir_prompt_unidad(temario_completo, unidad, sistema):
    return f"""Tienes que redactar contenido didáctico {sistema}.

TEMARIO COMPLETO:
{temario_completo}

UNIDAD CONCRETA:
{unidad}

INSTRUCCIONES:
- Quiero únicamente una explicación teórica.
- No pongas código.
- No pongas ejemplos de código.
- Escribe en español.
- Redacta de forma clara, ordenada y didáctica.
- Ten en cuenta el contexto del temario completo para situar esta unidad dentro del conjunto.
"""


def construir_prompt_subunidad_explicacion(temario_completo, unidad, subunidad, sistema):
    return f"""Tienes que redactar contenido didáctico {sistema}.

TEMARIO COMPLETO:
{temario_completo}

UNIDAD ACTUAL:
{unidad}

SUBUNIDAD CONCRETA:
{subunidad}

INSTRUCCIONES:
- Quiero únicamente una explicación teórica de esta subunidad.
- No pongas código.
- No pongas ejemplos de código.
- Escribe en español.
- Redacta de forma clara, ordenada y didáctica.
- Ten en cuenta el contexto del temario completo y de la unidad actual.
"""


def construir_prompt_subunidad_codigo(temario_completo, unidad, subunidad, sistema):
    return f"""Tienes que crear contenido práctico {sistema}.

TEMARIO COMPLETO:
{temario_completo}

UNIDAD ACTUAL:
{unidad}

SUBUNIDAD CONCRETA:
{subunidad}

INSTRUCCIONES:
- Genera un ejercicio de código paso a paso sobre esta subunidad.
- El ejercicio debe estar en C++.
- Cada paso debe avanzar de forma progresiva.
- Primero escribe un título breve del ejercicio.
- Después divide el ejercicio en pasos.
- En cada paso incluye una breve explicación y luego el código correspondiente.
- Usa formato Markdown.
- El código debe ir dentro de bloques de código Markdown con ```cpp
- El ejercicio debe ser didáctico, sencillo y coherente con la subunidad.
- Ten en cuenta el contexto del temario completo y de la unidad actual.
"""


# --------------------------------------------------
# PROCESAMIENTO PRINCIPAL
# --------------------------------------------------
def main():
    temario_completo = leer_archivo(ARCHIVO_TEMARIO)
    lineas = leer_lineas(ARCHIVO_TEMARIO)

    limpiar_salida(ARCHIVO_SALIDA)

    append_salida(ARCHIVO_SALIDA, "## Contexto general del temario\n\n")
    append_salida(ARCHIVO_SALIDA, "El siguiente documento se ha generado tomando como referencia el temario completo proporcionado.\n\n")
    append_salida(ARCHIVO_SALIDA, "---\n\n")

    unidad_actual = None

    for linea in lineas:
        texto = linea.strip()

        if not texto:
            continue

        print(f"Procesando: {texto}")

        if es_unidad(texto):
            unidad_actual = texto[:-1].strip()  # quitamos los dos puntos finales

            append_salida(ARCHIVO_SALIDA, f"# {unidad_actual}\n\n")
            append_salida(ARCHIVO_SALIDA, "_Generando explicación..._\n\n")

            prompt = construir_prompt_unidad(
                temario_completo=temario_completo,
                unidad=unidad_actual,
                sistema=SISTEMA
            )

            respuesta = llamar_ollama(IA_RAZONAMIENTO, prompt)

            append_salida(ARCHIVO_SALIDA, respuesta + "\n\n")
            append_salida(ARCHIVO_SALIDA, "---\n\n")

            time.sleep(PAUSA_ENTRE_PETICIONES)

        elif es_subunidad(texto):
            if unidad_actual is None:
                # Por seguridad, si hubiera una subunidad sin unidad previa
                unidad_actual = "Unidad sin título"

            subunidad = quitar_marca_subunidad(texto)

            append_salida(ARCHIVO_SALIDA, f"## {subunidad}\n\n")

            # 1. Explicación
            append_salida(ARCHIVO_SALIDA, "### Explicación\n\n")
            append_salida(ARCHIVO_SALIDA, "_Generando explicación..._\n\n")

            prompt_explicacion = construir_prompt_subunidad_explicacion(
                temario_completo=temario_completo,
                unidad=unidad_actual,
                subunidad=subunidad,
                sistema=SISTEMA
            )

            respuesta_explicacion = llamar_ollama(IA_RAZONAMIENTO, prompt_explicacion)

            append_salida(ARCHIVO_SALIDA, respuesta_explicacion + "\n\n")

            time.sleep(PAUSA_ENTRE_PETICIONES)

            # 2. Ejercicio paso a paso
            append_salida(ARCHIVO_SALIDA, "### Ejercicio paso a paso\n\n")
            append_salida(ARCHIVO_SALIDA, "_Generando ejercicio de código..._\n\n")

            prompt_codigo = construir_prompt_subunidad_codigo(
                temario_completo=temario_completo,
                unidad=unidad_actual,
                subunidad=subunidad,
                sistema=SISTEMA
            )

            respuesta_codigo = llamar_ollama(IA_CODIGO, prompt_codigo)

            append_salida(ARCHIVO_SALIDA, respuesta_codigo + "\n\n")
            append_salida(ARCHIVO_SALIDA, "---\n\n")

            time.sleep(PAUSA_ENTRE_PETICIONES)

    print("Proceso completado. Resultado guardado en:", ARCHIVO_SALIDA)


if __name__ == "__main__":
    main()
