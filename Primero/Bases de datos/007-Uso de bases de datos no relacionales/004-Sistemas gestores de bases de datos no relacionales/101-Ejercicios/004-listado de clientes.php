<?php

$conexion = new mysqli("localhost", "mitienda", "Mitienda123$", "mitienda");


$resultado = $conexion->query("SELECT * FROM clientes");

while ($fila = $resultado->fetch_assoc()) {
    echo $fila["nombre"] . "<br>";
}

$conexion->close();
?>
