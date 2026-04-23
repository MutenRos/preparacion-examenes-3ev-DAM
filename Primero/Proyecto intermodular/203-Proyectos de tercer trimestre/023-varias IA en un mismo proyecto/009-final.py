import requests
import time
import os
import re

# --------------------------------------------------
# CONFIGURACIÓN
# --------------------------------------------------
ARCHIVO_TEMARIO = "programacion.txt"
ARCHIVO_SALIDA = "resultado.md"

MODELO_TEXTO = "llama3.1:8b"
MODELO_CODIGO = "codellama:7b"

URL = "http://localhost:11434/api/generate"
LENGUAJE = "C++"

PAUSA_ENTRE_PETICIONES = 1
GENERAR_ARCHIVOS_POR_CAPITULO = False
DIRECTORIO_CAPITULOS = "capitulos"

REINTENTAR_SALIDA_DEFECTUOSA = True
MAX_INTENTOS = 2


# --------------------------------------------------
# PROMPT BASE
# --------------------------------------------------
PROMPT_SISTEMA_LIBRO = f"""
Eres un autor técnico especializado en redactar manuales y cuadernos de trabajo de programación en {LENGUAJE}, en español.

OBJETIVO:
Redactar un manual didáctico, claro, progresivo y técnicamente correcto.

ESTILO:
- Español neutro.
- Tono profesional, sobrio y didáctico.
- Sin frases vacías ni entusiasmo artificial.
- Sin texto de asistente conversacional.
- Sin saludos ni despedidas.
- Sin frases como "aquí tienes", "por supuesto", "no dudes en preguntarme".
- Sin repetir innecesariamente el nombre del tema.

REGLA PEDAGÓGICA FUNDAMENTAL:
- Nunca anticipes conceptos futuros.
- Solo puedes usar en la explicación y en los ejercicios los conceptos que ya hayan aparecido hasta el punto actual del temario.
- Puedes utilizar el contexto completo del temario para saber hacia dónde va el libro, pero no para adelantar contenidos.
- Si un concepto todavía no ha sido introducido en secciones anteriores o en la sección actual, no debe aparecer en el ejercicio.
- Esto es obligatorio incluso si el concepto haría el código más elegante o más corto.

REGLAS GENERALES:
- Respeta exactamente el tema del capítulo y del subcapítulo.
- No introduzcas conceptos avanzados si no son imprescindibles.
- No añadas apartados no pedidos.
- No añadas comandos de terminal salvo cuando se pidan de forma explícita en el ejercicio.
- No escribas marcadores como [explicación breve].
- No escribas texto provisional.
- No uses using namespace std;
- Usa siempre std:: de forma explícita.

REGLAS PARA TEORÍA:
- No pongas código.
- No pongas pseudocódigo.
- Explica con precisión y de forma breve.
- No conviertas la teoría en un resumen genérico del lenguaje.

REGLAS PARA EJERCICIOS:
- El ejercicio debe ser pequeño, coherente y acumulativo.
- Cada paso debe partir exactamente del código del paso anterior.
- Cada paso debe mostrar el programa completo hasta ese momento.
- Cada paso debe ser compilable por sí mismo.
- Cada paso debe introducir un único avance pequeño y fácil de entender.
- No pongas fragmentos aislados salvo que el tema trate precisamente de fragmentos.
- No expliques cosas que el código no hace realmente.
- No mezcles varios objetivos en un mismo ejercicio.
- Si el tema es básico, el ejercicio debe ser básico.
"""


# --------------------------------------------------
# FUNCIONES DE ARCHIVO
# --------------------------------------------------
def leer_archivo(ruta):
    with open(ruta, "r", encoding="utf-8") as f:
        return f.read()


def leer_lineas(ruta):
    with open(ruta, "r", encoding="utf-8") as f:
        return f.readlines()


def escribir_archivo(ruta, contenido):
    with open(ruta, "w", encoding="utf-8") as f:
        f.write(contenido)


def append_salida(ruta, texto):
    with open(ruta, "a", encoding="utf-8") as f:
        f.write(texto)
        f.flush()


def limpiar_salida(ruta):
    encabezado = (
        "# Manual y cuaderno de trabajo de C++\n\n"
        "Documento generado automáticamente a partir del temario.\n\n"
        "## Introducción general\n\n"
        "Este documento combina explicaciones teóricas y ejercicios guiados paso a paso "
        "para facilitar el aprendizaje progresivo de C++.\n\n"
        "---\n\n"
    )
    escribir_archivo(ruta, encabezado)


# --------------------------------------------------
# UTILIDADES
# --------------------------------------------------
def slugify(texto):
    texto = texto.lower().strip()
    texto = re.sub(r"[^\w\s-]", "", texto, flags=re.UNICODE)
    texto = re.sub(r"[\s_]+", "-", texto)
    texto = re.sub(r"-+", "-", texto)
    return texto.strip("-")


def es_unidad(linea):
    linea = linea.strip()
    return bool(linea) and (not linea.startswith("−")) and linea.endswith(":")


def es_subunidad(linea):
    return linea.strip().startswith("−")


def quitar_marca_subunidad(linea):
    return linea.strip().lstrip("−").strip()


def preparar_directorio_capitulos():
    if GENERAR_ARCHIVOS_POR_CAPITULO:
        os.makedirs(DIRECTORIO_CAPITULOS, exist_ok=True)


def ruta_capitulo(numero, titulo):
    nombre = f"{numero:02d}-{slugify(titulo)}.md"
    return os.path.join(DIRECTORIO_CAPITULOS, nombre)


def escribir_capitulo_si_corresponde(ruta, texto):
    if GENERAR_ARCHIVOS_POR_CAPITULO and ruta:
        append_salida(ruta, texto)


def construir_contexto_hasta_indice(lineas, indice_actual):
    """
    Devuelve el temario únicamente hasta la línea actual inclusive.
    Esto permite que el modelo vea solo lo ya explicado.
    """
    previas = []
    for i in range(indice_actual + 1):
        txt = lineas[i].rstrip("\n")
        if txt.strip():
            previas.append(txt)
    return "\n".join(previas)


def construir_contexto_posterior(lineas, indice_actual):
    """
    Contexto de lo que vendrá después, solo como referencia de rumbo.
    No debe usarse para anticipar conceptos en ejercicios.
    """
    posteriores = []
    for i in range(indice_actual + 1, len(lineas)):
        txt = lineas[i].rstrip("\n")
        if txt.strip():
            posteriores.append(txt)
    return "\n".join(posteriores)


# --------------------------------------------------
# LIMPIEZA Y VALIDACIÓN
# --------------------------------------------------
def limpiar_respuesta_modelo(texto):
    if not texto:
        return ""

    salida = texto.strip()

    patrones_inicio = [
        r"^Aquí tienes:?[\s\n]*",
        r"^A continuación:?[\s\n]*",
        r"^Claro:?[\s\n]*",
        r"^Por supuesto:?[\s\n]*",
        r"^Sure:?[\s\n]*",
        r"^Here is:?[\s\n]*",
        r"^Este es un ejemplo de .*?:[\s\n]*",
        r"^Ejercicio guiado para .*?:[\s\n]*",
    ]

    for patron in patrones_inicio:
        salida = re.sub(patron, "", salida, flags=re.IGNORECASE)

    salida = re.sub(r"\n{3,}", "\n\n", salida)
    return salida.strip()


def parece_salida_defectuosa(texto):
    if not texto:
        return True

    texto_min = texto.lower()

    marcadores_malos = [
        "aquí tienes",
        "por supuesto",
        "este es un ejemplo",
        "te proponemos",
        "no dudes en preguntarme",
        "espero que te haya resultado útil",
        "[explicación breve]",
    ]

    return any(m in texto_min for m in marcadores_malos)


def parece_ejercicio_incremental_valido(texto):
    bloques_cpp = re.findall(r"```cpp\n(.*?)```", texto, flags=re.DOTALL)
    if len(bloques_cpp) < 3:
        return False

    texto_min = texto.lower()
    if "#### compilación y ejecución" not in texto_min:
        return False
    if "#### resultado esperado" not in texto_min:
        return False

    for bloque in bloques_cpp:
        bloque_min = bloque.lower()
        if "int main" not in bloque_min:
            return False
        if "#include <iostream>" not in bloque and "std::" not in bloque:
            return False

    return True


# --------------------------------------------------
# COMUNICACIÓN CON OLLAMA
# --------------------------------------------------
def llamar_ollama(modelo, prompt):
    data = {
        "model": modelo,
        "prompt": prompt,
        "stream": False,
        "options": {
            "temperature": 0.2
        }
    }

    response = requests.post(URL, json=data, timeout=300)
    response.raise_for_status()
    datos = response.json()
    return limpiar_respuesta_modelo(datos.get("response", "").strip())


def llamar_ollama_con_reintento(modelo, prompt, validar_incremental=False):
    ultimo_error = None

    for intento in range(MAX_INTENTOS):
        try:
            texto = llamar_ollama(modelo, prompt)

            if REINTENTAR_SALIDA_DEFECTUOSA and parece_salida_defectuosa(texto) and intento < MAX_INTENTOS - 1:
                continue

            if validar_incremental and not parece_ejercicio_incremental_valido(texto) and intento < MAX_INTENTOS - 1:
                continue

            return texto
        except Exception as e:
            ultimo_error = e
            time.sleep(1)

    return f"Error al consultar el modelo {modelo}: {ultimo_error}"


# --------------------------------------------------
# PROMPTS
# --------------------------------------------------
def construir_prompt_capitulo(contexto_hasta_ahora, contexto_posterior, unidad):
    return f"""
{PROMPT_SISTEMA_LIBRO}

TEMARIO YA RECORRIDO O DISPONIBLE HASTA ESTE PUNTO:
{contexto_hasta_ahora}

TEMARIO POSTERIOR, SOLO COMO REFERENCIA GENERAL DEL RUMBO DEL LIBRO:
{contexto_posterior}

CAPÍTULO ACTUAL:
{unidad}

TAREA:
Redacta la introducción del capítulo.

SALIDA OBLIGATORIA:
- Solo el texto de la introducción.
- Entre 3 y 5 párrafos breves.
- Sin listas.
- Sin código.
- Sin títulos decorativos.
- Explica qué se estudia en este capítulo y por qué es importante dentro del aprendizaje general de {LENGUAJE}.
- No anticipes detalles técnicos de subcapítulos futuros que aún no hayan aparecido.
"""


def construir_prompt_subcapitulo_intro(contexto_hasta_ahora, contexto_posterior, unidad, subunidad):
    return f"""
{PROMPT_SISTEMA_LIBRO}

TEMARIO YA RECORRIDO O DISPONIBLE HASTA ESTE PUNTO:
{contexto_hasta_ahora}

TEMARIO POSTERIOR, SOLO COMO REFERENCIA GENERAL DEL RUMBO DEL LIBRO:
{contexto_posterior}

CAPÍTULO ACTUAL:
{unidad}

SUBCAPÍTULO ACTUAL:
{subunidad}

TAREA:
Redacta la introducción del subcapítulo.

SALIDA OBLIGATORIA:
- Solo la introducción.
- Entre 2 y 4 párrafos breves.
- Sin listas.
- Sin código.
- Explica el concepto, su utilidad y su relación con el capítulo actual.
- No anticipes conceptos que pertenezcan a subcapítulos posteriores.
"""


def construir_prompt_subcapitulo_ejercicio(contexto_hasta_ahora, contexto_posterior, unidad, subunidad):
    return f"""
{PROMPT_SISTEMA_LIBRO}

TEMARIO YA RECORRIDO O DISPONIBLE HASTA ESTE PUNTO:
{contexto_hasta_ahora}

TEMARIO POSTERIOR, SOLO COMO REFERENCIA GENERAL DEL RUMBO DEL LIBRO:
{contexto_posterior}

CAPÍTULO ACTUAL:
{unidad}

SUBCAPÍTULO ACTUAL:
{subunidad}

TAREA:
Redacta un único ejercicio guiado y estrictamente incremental sobre el subcapítulo actual.

REGLA PEDAGÓGICA CRÍTICA:
- El ejercicio solo puede usar conceptos presentes en el TEMARIO YA RECORRIDO O DISPONIBLE HASTA ESTE PUNTO.
- No puedes usar conceptos del TEMARIO POSTERIOR.
- Si dudas si un concepto pertenece al futuro, no lo uses.
- Prioriza la simplicidad pedagógica sobre la elegancia técnica.

REQUISITOS CRÍTICOS:
- El ejercicio debe corresponder exactamente al tema "{subunidad}".
- Debe haber entre 3 y 5 pasos.
- Cada paso debe partir del programa completo del paso anterior.
- Cada paso debe mostrar SIEMPRE el programa completo, no solo una línea o fragmento.
- Cada programa debe poder compilar por sí mismo.
- Cada paso debe introducir solo una mejora pequeña y fácil de seguir.
- El lector debe poder copiar el código de cualquier paso y ejecutarlo.
- Después del código de cada paso debes añadir instrucciones concretas para compilar y ejecutar ese paso.
- Después debes añadir el resultado esperado de ese paso.
- Las instrucciones de compilación deben usar g++.
- Usa un nombre de archivo sencillo como programa.cpp.
- El resultado esperado debe describir exactamente lo que aparecerá en pantalla, o explicar con claridad qué ocurrirá si hay entrada del usuario.
- No incluyas comandos de terminal fuera del apartado de compilación y ejecución.
- No pongas código bash fuera de ese apartado.
- No pongas marcadores como [explicación breve].
- No dejes funciones, clases o variables incompletas entre pasos.
- No cambies completamente de ejemplo a mitad del ejercicio.
- No repitas exactamente el mismo código salvo cuando sea imprescindible para el avance.
- Si añades algo en un paso, el siguiente debe conservarlo y ampliarlo.

FORMATO OBLIGATORIO:
### Ejercicio guiado

#### Título del ejercicio
[Título breve y técnico]

#### Paso 1
[explicación breve del primer programa]

```cpp
[programa completo y compilable]
```

#### Compilación y ejecución
```bash
g++ programa.cpp -o programa
./programa
```

#### Resultado esperado
[resultado exacto o descripción exacta de la salida]

#### Paso 2
[explicación breve de la pequeña ampliación]

```cpp
[programa completo y compilable, basado en el paso 1]
```

#### Compilación y ejecución
```bash
g++ programa.cpp -o programa
./programa
```

#### Resultado esperado
[resultado exacto o descripción exacta de la salida]

#### Paso 3
[explicación breve de la pequeña ampliación]

```cpp
[programa completo y compilable, basado en el paso 2]
```

#### Compilación y ejecución
```bash
g++ programa.cpp -o programa
./programa
```

#### Resultado esperado
[resultado exacto o descripción exacta de la salida]

#### Conclusión
[2 o 3 frases breves]

RESTRICCIONES ESPECÍFICAS:
- Si el tema es "Variables", empieza con un programa mínimo con una variable y luego amplíalo, sin usar estructuras futuras.
- Si el tema es "Tipos de datos", parte de un programa pequeño y añade nuevos tipos de forma progresiva, sin conversiones si aún no han aparecido.
- Si el tema es "Literales", el ejercicio debe practicar literales reales, no formato avanzado innecesario ni bibliotecas nuevas.
- Si el tema es "Constantes", usa un mismo programa que pase de valor fijo a constante, sin funciones si aún no han aparecido.
- Si el tema es "Comentarios", empieza con un programa mínimo y añade comentarios útiles progresivamente.
- Si el tema es "Objetos", la clase debe aparecer completa dentro de cada paso y crecer poco a poco, pero solo si el temario ya ha llegado a objetos.
- No uses ejemplos rebuscados.
- No inventes APIs ni bibliotecas no incluidas.
"""


# --------------------------------------------------
# GENERACIÓN
# --------------------------------------------------
def generar_bloque_capitulo(contexto_hasta_ahora, contexto_posterior, unidad):
    prompt = construir_prompt_capitulo(contexto_hasta_ahora, contexto_posterior, unidad)
    return llamar_ollama_con_reintento(MODELO_TEXTO, prompt)


def generar_intro_subcapitulo(contexto_hasta_ahora, contexto_posterior, unidad, subunidad):
    prompt = construir_prompt_subcapitulo_intro(contexto_hasta_ahora, contexto_posterior, unidad, subunidad)
    return llamar_ollama_con_reintento(MODELO_TEXTO, prompt)


def generar_ejercicio_subcapitulo(contexto_hasta_ahora, contexto_posterior, unidad, subunidad):
    prompt = construir_prompt_subcapitulo_ejercicio(contexto_hasta_ahora, contexto_posterior, unidad, subunidad)
    return llamar_ollama_con_reintento(MODELO_CODIGO, prompt, validar_incremental=True)


# --------------------------------------------------
# PROCESAMIENTO PRINCIPAL
# --------------------------------------------------
def main():
    lineas = leer_lineas(ARCHIVO_TEMARIO)

    limpiar_salida(ARCHIVO_SALIDA)
    preparar_directorio_capitulos()

    unidad_actual = None
    contador_capitulos = 0
    archivo_capitulo_actual = None

    for indice, linea in enumerate(lineas):
        texto = linea.strip()

        if not texto:
            continue

        print(f"Procesando: {texto}")

        contexto_hasta_ahora = construir_contexto_hasta_indice(lineas, indice)
        contexto_posterior = construir_contexto_posterior(lineas, indice)

        if es_unidad(texto):
            unidad_actual = texto[:-1].strip()
            contador_capitulos += 1

            if GENERAR_ARCHIVOS_POR_CAPITULO:
                archivo_capitulo_actual = ruta_capitulo(contador_capitulos, unidad_actual)
                escribir_archivo(archivo_capitulo_actual, f"# {unidad_actual}\n\n")

            bloque_titulo = f"# {unidad_actual}\n\n"
            append_salida(ARCHIVO_SALIDA, bloque_titulo)
            escribir_capitulo_si_corresponde(archivo_capitulo_actual, bloque_titulo)

            respuesta_capitulo = generar_bloque_capitulo(
                contexto_hasta_ahora=contexto_hasta_ahora,
                contexto_posterior=contexto_posterior,
                unidad=unidad_actual
            )
            bloque_capitulo = respuesta_capitulo + "\n\n---\n\n"

            append_salida(ARCHIVO_SALIDA, bloque_capitulo)
            escribir_capitulo_si_corresponde(archivo_capitulo_actual, bloque_capitulo)

            time.sleep(PAUSA_ENTRE_PETICIONES)

        elif es_subunidad(texto):
            if unidad_actual is None:
                unidad_actual = "Unidad sin título"

            subunidad = quitar_marca_subunidad(texto)

            bloque_subtitulo = f"## {subunidad}\n\n"
            append_salida(ARCHIVO_SALIDA, bloque_subtitulo)
            escribir_capitulo_si_corresponde(archivo_capitulo_actual, bloque_subtitulo)

            bloque_intro_header = "### Introducción\n\n"
            append_salida(ARCHIVO_SALIDA, bloque_intro_header)
            escribir_capitulo_si_corresponde(archivo_capitulo_actual, bloque_intro_header)

            respuesta_intro = generar_intro_subcapitulo(
                contexto_hasta_ahora=contexto_hasta_ahora,
                contexto_posterior=contexto_posterior,
                unidad=unidad_actual,
                subunidad=subunidad
            )

            bloque_intro = respuesta_intro + "\n\n"
            append_salida(ARCHIVO_SALIDA, bloque_intro)
            escribir_capitulo_si_corresponde(archivo_capitulo_actual, bloque_intro)

            time.sleep(PAUSA_ENTRE_PETICIONES)

            bloque_practica_header = "### Desarrollo práctico\n\n"
            append_salida(ARCHIVO_SALIDA, bloque_practica_header)
            escribir_capitulo_si_corresponde(archivo_capitulo_actual, bloque_practica_header)

            respuesta_ejercicio = generar_ejercicio_subcapitulo(
                contexto_hasta_ahora=contexto_hasta_ahora,
                contexto_posterior=contexto_posterior,
                unidad=unidad_actual,
                subunidad=subunidad
            )

            bloque_practica = respuesta_ejercicio + "\n\n---\n\n"
            append_salida(ARCHIVO_SALIDA, bloque_practica)
            escribir_capitulo_si_corresponde(archivo_capitulo_actual, bloque_practica)

            time.sleep(PAUSA_ENTRE_PETICIONES)

    print("Proceso completado. Resultado guardado en:", ARCHIVO_SALIDA)
    if GENERAR_ARCHIVOS_POR_CAPITULO:
        print("También se han generado archivos por capítulo en:", DIRECTORIO_CAPITULOS)


if __name__ == "__main__":
    main()
