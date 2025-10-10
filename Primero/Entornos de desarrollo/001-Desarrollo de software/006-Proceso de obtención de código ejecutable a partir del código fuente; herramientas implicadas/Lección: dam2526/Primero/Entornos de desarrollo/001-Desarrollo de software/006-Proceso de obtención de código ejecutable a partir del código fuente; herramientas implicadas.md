Automatizar tareas esta bien, pero hay veces que nos gustaria decidir a nosotros mismos cuando ejecutar un script, como por ejemplo, habilitar y deshabilitar ciertas funciones del equipo en funcion de la tarea que vayamos a realizar. Si bien es cierto, que la terminal de comandos de la raspberry puede llegar a ser tan simple como la de cualquier sistema `Linux`, estaremos deacuerdo que un archivo ejecutable es la opcion mas cómoda.

El proyecto de hoy va a ser crear un archivo ejecutable a partir de un script fuente en `C`

```c
#include <stdio.h>
int mainI() {
    printf("Hola mundo desde RPI!");
    return 0;
}
```

Este seria el codigo fuente de nuestro programa.
Despues de ser compilado, al ejecutar el archivo resultante desde la consola de nuestro terminal, nos devolveria algo como:

```c
"Hola mundo desde RPI!"
```

Aunque existen alternativas que no necesitan ser compiladas, aprender a convertir el codigo fuente en ejecutable es una habilidad crucial.
