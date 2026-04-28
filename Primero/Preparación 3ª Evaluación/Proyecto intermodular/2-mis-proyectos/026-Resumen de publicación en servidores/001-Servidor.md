Fundamentalmente tenemos dos tipos de servidores:

1.-Apache, puerto 80, multipropósito, te abre una carpeta /htdocs, y dentro puedes poner lo que quieras en subcarpetas

Luego si quieres puedes hacer virtualhosts, de tal forma que cada dominio o subdominio lleve a la carpeta correspondiente

Este es el método preferido para trabajar con el stack LAMP (PHP)

2.-Que es lo que ocurre cuando montamos aplicaciones flask
Trabajamos interamente un puerto determinado (p.ej.5000, 5001, 5002,...)
Problema: al final todo tiene que ir al puerto 80, porque la gente solo carga por el puerto 80

Reverse proxy -> La gente entra en tu servidor por el puerto 80, y el servidor sabe que te tiene que redirigir al puerto X






