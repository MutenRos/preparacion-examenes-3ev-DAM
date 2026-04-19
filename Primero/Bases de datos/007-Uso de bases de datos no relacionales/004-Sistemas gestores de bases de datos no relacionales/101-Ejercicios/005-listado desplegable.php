<select name="cliente">
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
