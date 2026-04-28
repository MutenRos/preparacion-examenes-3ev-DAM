#include <stdio.h>
#include <time.h>

int main() {
    clock_t inicio, fin;
    double tiempo;

    inicio = clock();

    for (long long i = 0; i < 2000000000LL; i++) {
        ;
    }

    fin = clock();

    tiempo = (double)(fin - inicio) / CLOCKS_PER_SEC;

    printf("Tiempo: %f segundos\n", tiempo);

    return 0;
}
