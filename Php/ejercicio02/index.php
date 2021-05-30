<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Ejercicio 02 Include</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
		<link rel="stylesheet" type="text/css" href="./style.css"/>
	</head>
</html>
<?php
  echo "<h3>En este ejemplo se utiliza la funcion include() que hubica codigo php definido en el archivo ejemplo2.inc</h3>";
  echo "<h3>Antes de insertar el include las variables declaradas en el mismo no existen <br/>Las variables son:</h3>";
  echo $arreglo1["nombre"];
  echo $arreglo1["apellido"];
  echo $arreglo1["año"];
  echo $arreglo2["nombre"];
  echo $arreglo2["apellido"];
  echo $arreglo2["año"];

  # Esto tira fatal error y para todo el script, parece que php8 cambio este de error de "warning" a "fatal error"
  # echo "<h3>La longitud de los arreglos es : " . count($arreglo1) . "</h3>";

  include("./ejemplo2.inc");
  echo "<h3>Aqui ya se ejecuto la funcion include().</h3>";
  echo "<h3>Las 2 variables de tipo array asociativo en el inc son:</h3>";

  echo "<table>";
	echo "<tbody>";
	foreach($aPersonas as $aPersona) {
		echo "<tr>";
		foreach($aPersona as $attr) {
			echo "<td>" . $attr . "</td>";
		}
		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";

  echo "<h3>La longitud de los arreglos es : " . count($arreglo1) . "</h3>";
?>