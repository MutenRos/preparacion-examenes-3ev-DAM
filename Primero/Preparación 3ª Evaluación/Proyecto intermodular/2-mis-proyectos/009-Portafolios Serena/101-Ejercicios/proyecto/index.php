<?php
require_once 'auth.php';
$user = current_user();
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Generador de proyectos</title>
	<style>
		*{box-sizing:border-box;}
		body{
			margin:0;
			font-family:Arial,sans-serif;
			background:linear-gradient(135deg,#0f172a,#1e293b);
			color:white;
			min-height:100vh;
		}
		.container{
			max-width:1100px;
			margin:auto;
			padding:40px 20px;
		}
		header{
			display:flex;
			justify-content:space-between;
			align-items:center;
			gap:20px;
			margin-bottom:60px;
		}
		.brand{
			font-size:24px;
			font-weight:bold;
		}
		nav a{
			display:inline-block;
			margin-left:10px;
			padding:10px 16px;
			border-radius:10px;
			text-decoration:none;
			color:white;
			background:rgba(255,255,255,0.12);
			border:1px solid rgba(255,255,255,0.15);
		}
		.hero{
			display:grid;
			grid-template-columns:1.2fr 1fr;
			gap:30px;
			align-items:center;
		}
		.card{
			background:rgba(255,255,255,0.08);
			border:1px solid rgba(255,255,255,0.12);
			border-radius:18px;
			padding:30px;
			backdrop-filter:blur(10px);
		}
		h1{
			font-size:48px;
			line-height:1.1;
			margin:0 0 20px 0;
		}
		p{
			line-height:1.6;
			color:rgba(255,255,255,0.9);
		}
		.cta{
			margin-top:25px;
		}
		.cta a{
			display:inline-block;
			margin-right:10px;
			margin-bottom:10px;
			padding:12px 18px;
			border-radius:12px;
			text-decoration:none;
			color:white;
			background:#2563eb;
		}
		.cta a.secondary{
			background:rgba(255,255,255,0.12);
			border:1px solid rgba(255,255,255,0.15);
		}
		ul{
			padding-left:20px;
			line-height:1.8;
		}
		@media (max-width: 800px){
			.hero{
				grid-template-columns:1fr;
			}
			h1{
				font-size:34px;
			}
			header{
				flex-direction:column;
				align-items:flex-start;
			}
			nav a{
				margin-left:0;
				margin-right:10px;
				margin-top:10px;
			}
		}
	</style>
</head>
<body>
	<div class="container">
		<header>
			<div class="brand">Generador de proyectos IA</div>
			<nav>
				<?php if ($user): ?>
					<a href="dashboard.php">Dashboard</a>
					<a href="logout.php">Cerrar sesión</a>
				<?php else: ?>
					<a href="login.php">Log in</a>
					<a href="signup.php">Sign in</a>
				<?php endif; ?>
			</nav>
		</header>

		<section class="hero">
			<div class="card">
				<h1>Crea proyectos web a partir de prompts</h1>
				<p>
					Esta aplicación permite a cada usuario registrarse, iniciar sesión y gestionar tantos proyectos como necesite.
					Cada proyecto guarda su prompt, el código generado y su historial más reciente dentro de una base de datos SQLite.
				</p>
				<p>
					Al abrir un proyecto, se lanza el generador visual actual: escribes una petición y la web generada aparece en segundo plano,
					mientras el panel flotante permite seguir refinando el resultado.
				</p>
				<div class="cta">
					<?php if ($user): ?>
						<a href="dashboard.php">Ir al dashboard</a>
					<?php else: ?>
						<a href="signup.php">Crear cuenta</a>
						<a class="secondary" href="login.php">Iniciar sesión</a>
					<?php endif; ?>
				</div>
			</div>

			<div class="card">
				<h2>Qué incluye</h2>
				<ul>
					<li>Home pública con descripción del producto</li>
					<li>Registro e inicio de sesión contra SQLite</li>
					<li>Dashboard privado por usuario</li>
					<li>Creación ilimitada de proyectos</li>
					<li>Guardado de prompts y código generado</li>
					<li>Ejecución del generador dentro de cada proyecto</li>
				</ul>
			</div>
		</section>
	</div>
</body>
</html>
