<!doctype html>
<html>
	<head>
	</head>
	<body>
		<select name="cliente">
		<option>Selecciona un cliente...</option>
		<?php
			$conexion = new mysqli("localhost", "mitienda", "Mitienda123$", "mitienda");
			$resultado = $conexion->query("SELECT * FROM clientes");
			while ($fila = $resultado->fetch_assoc()) {
				 echo "<option
				 	nombre='".$fila["nombre"]."'
				 	apellidos='".$fila["apellidos"]."'
				 	email='".$fila["email"]."'
				 	direccion='".$fila["direccion"]."'
				 	cp='".$fila["cp"]."'
				 	localidad='".$fila["localidad"]."'
				 >".$fila["nombre"]." ".$fila["apellidos"]."</option>";
			}
			$conexion->close();
		?>
		</select>
		<div id="datos_cliente">
			<h3><span id="nombre"></span> <span id="apellidos"></span></h3>
			<p id="email"></p>
			<p id="direccion"></p>
			<p><span id="cp"></span> <span id="localidad"></span></p>
		</div>
		<script>
			let selector = document.querySelector("select")
			selector.onchange = function(){
				let opcion = this.selectedOptions[0]
				document.querySelector("#nombre").textContent = opcion.getAttribute("nombre")
				document.querySelector("#apellidos").textContent = opcion.getAttribute("apellidos")
				document.querySelector("#email").textContent = opcion.getAttribute("email")
				document.querySelector("#direccion").textContent = opcion.getAttribute("direccion")
				document.querySelector("#cp").textContent = opcion.getAttribute("cp")
				document.querySelector("#localidad").textContent = opcion.getAttribute("localidad")
			}
		</script>
	</body>
</html>
