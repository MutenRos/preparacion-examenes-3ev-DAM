# Proyecto Formularios PRO

Aplicación multiusuario en PHP + SQLite para crear formularios mediante un lenguaje de marcaje.

## Credenciales iniciales
- Usuario: `admin`
- Clave: `admin123`

## Estructura
- `/admin` panel privado
- `/public/form.php?h=HASH` formulario público
- `/inc` librerías
- `/data/app.sqlite` base de datos SQLite

## Arranque
1. Copia el proyecto al servidor PHP
2. Asegúrate de que `/data` tenga permisos de escritura
3. Ejecuta `init.php` una vez
4. Entra en `/admin/login.php`

## Sintaxis soportada

[text] Nombre
[number] Edad
[email] Correo
[date] Fecha
[textarea] Comentario

[radio] Selecciona tu ciclo
	[case] DAM
		[text] Has elegido DAM
	[case] SMR
		[text] Has elegido SMR

[select] Especialidad
	[case] Web
		[text] Te gusta web
	[case] Multiplataforma
		[text] Te gusta multiplataforma

[checkbox] Intereses
	[case] Redes
		[text] Interés en redes
	[case] Sistemas
		[text] Interés en sistemas

También se puede usar:
[text][required] Nombre obligatorio

Importante: usa tabulaciones reales en las líneas anidadas.
