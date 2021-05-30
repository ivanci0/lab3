<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Ejercicio 04 Muestra variables de servidor</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
		<link rel="stylesheet" type="text/css" href="./style.css"/>
	</head>
</html>
<?php
  $aServer = [
    "SERVER_ADDR", 
    "SERVER_PORT", 
    "SERVER_NAME", 
    "DOCUMENT_ROOT"
  ];
  $aCliente = ["REMOTE_ADDR", "REMOTE_PORT"];
  $aRequerimiento = ["SCRIPT_NAME", "REQUEST_METHOD"];

  function tablaFiltrada($filtro) {
    echo "<table><tbody>";
    foreach($_SERVER as $key_name => $key_value) {
      if (in_array($key_name, $filtro)) {
        echo "<tr><td>" . $key_name . "</td><td>" . $key_value . "</td></tr>";
      }
    }
    echo "</tbody></table>";
  }

  echo "<h1>Variables de servidor</h1>";
  tablaFiltrada($aServer);

  echo "<h1>Variables de cliente</h1>";
  tablaFiltrada($aCliente);

  echo "<h1>Variables de requerimiento</h1>";
  tablaFiltrada($aRequerimiento);

  echo "<h1>TODAS</h1>";
  foreach($_SERVER as $key_name => $key_value) {
    echo $key_name . "=" . $key_value . "<br/>";
  }
?>