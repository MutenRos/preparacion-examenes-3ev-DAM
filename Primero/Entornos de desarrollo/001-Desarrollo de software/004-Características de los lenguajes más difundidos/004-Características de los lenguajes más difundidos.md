Python, C++, C, Java y JavaScript son lenguajes con enfoques distintos: productividad y alto nivel (Python), rendimiento y control con abstracciones modernas (C++), control de bajo nivel (C), portabilidad y ecosistema empresarial (Java) y ubiquidad en la web (JavaScript).

# Python

- Características: tipado dinámico, sintaxis clara y amplio uso en automatización, data y scripting.
- Ejemplo (procedural, sin input): calcular factorial de manera explícita.

```python
def factorial(n):
    r=1
    for i in range(2,n+1):
        r*=i
    return r

print('5! =', factorial(5))
```

Versión aún más sencilla (tabla de multiplicar de 1 a 3):

```python
# tabla_demo.py
for i in range(1,4):
    for j in range(1,4):
        print(f"{i}x{j}={i*j}")
    print('---')
```

# C++

- Características: lenguaje de sistema con control de recursos y evolución por estándares (C++11/14/17/20) que añadieron abstracciones modernas.
- Uso típico: sistemas con requisitos de rendimiento (motores, sistemas embebidos).

# C vs Java

- C: control muy cercano al hardware, sin gestión automática de memoria; apto para kernels y drivers.
- Java: ejecuta sobre JVM, ofrece portabilidad, seguridad de tipos en tiempo de ejecución y un sólido ecosistema para aplicaciones empresariales.

```c
/* Concepto C: sumar un array (ilustrativo) */
// int sum(int *a,int n){int s=0;for(int i=0;i<n;i++)s+=a[i];return s;}
```

```java
// Concepto Java: sumar un array (ilustrativo)
// int sum(int[] a){int s=0; for(int v:a) s+=v; return s;}
```

Resumen: cada lenguaje destaca en distintos criterios (productividad, rendimiento, control, portabilidad, ubiquidad). La elección depende de requisitos del proyecto: tiempo de desarrollo, rendimiento esperado y entorno de ejecución.
