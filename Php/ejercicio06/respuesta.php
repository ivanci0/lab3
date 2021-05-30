<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Respuesta PHP</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	</head>
</html>
<?php
	echo "Valores pasados:";
	echo "<br/>";
	echo "Nombre = " . $_GET['nombre'];
	echo "<br/>";
	echo "Apellido = " . $_GET['apellido'];
	echo "<br/>";
	echo "<button onclick='window.close();'>Cerrar</button>";
?>