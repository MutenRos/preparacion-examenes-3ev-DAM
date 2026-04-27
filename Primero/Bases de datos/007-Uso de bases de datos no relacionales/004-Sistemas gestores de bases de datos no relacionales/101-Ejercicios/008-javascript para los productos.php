<!doctype html>
<html>
	<head>
	</head>
	<body>
		<select name="cliente" id="selector_cliente">
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
			let selector = document.querySelector("#selector_cliente")
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
		<select id="selector_producto">
			<option>Selecciona un producto...</option>
		<?php
			$conexion = new mysqli("localhost", "mitienda", "Mitienda123$", "mitienda");
			$resultado = $conexion->query("SELECT * FROM productos");
			while ($fila = $resultado->fetch_assoc()) {
				 echo "<option
				 	nombreproducto='".$fila["nombre"]."'
				 	descripcion='".$fila["descripcion"]."'
				 	precio='".$fila["precio"]."'
				 	stock='".$fila["stock"]."'
				 	categoria='".$fila["categoria"]."'
				 	marca='".$fila["marca"]."'
				 >".$fila["nombre"]." ".$fila["precio"]."</option>";
			}
			$conexion->close();
		?>
		</select>
		<div id="datos_producto">
			<h3 id="nombreproducto"></h3>
			<p id="descripcion"></p>
			<p id="precio"></p>
			<p id="stock"></p>
			<p id="categoria"></p>
			<p id="marca"></p>
		</div>
		<script>
			let selector2 = document.querySelector("#selector_producto")
			selector2.onchange = function(){
				let opcion = this.selectedOptions[0]
				document.querySelector("#nombreproducto").textContent = opcion.getAttribute("nombreproducto")
				document.querySelector("#descripcion").textContent = opcion.getAttribute("descripcion")
				document.querySelector("#precio").textContent = opcion.getAttribute("precio")
				document.querySelector("#stock").textContent = opcion.getAttribute("stock")
				document.querySelector("#categoria").textContent = opcion.getAttribute("categoria")
				document.querySelector("#marca").textContent = opcion.getAttribute("marca")
			}
		</script>
	</body>
</html>
