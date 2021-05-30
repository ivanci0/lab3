<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Ejercicio 01 PHP Basico</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
		<link rel="stylesheet" type="text/css" href="./style.css"/>
	</head>
</html>
<h4>Texto en html escrito fuera de las marcas de php</h4>
<hr/>
<?php
	$miVariable = "valor1";
	$aPalabras = ["Hola", "Hello"];
	$aPalabras2 = ["Mesa", "Table", "Tavolo", "Tabelle"];
	$aPalabras3 = ["Avion", "Airplane", "Aereo", "Flugzeug"];
	$aDiccionarioBasico = [];
	define("MICONSTANTE","valorConstante");
	$renglonDeLiquidacion = ["legEmpleado"=>"c0001","Apellido"=> "Witt" , "salarioBasico"=>20000,"fechaIngr"=>"02/04/2019"];
	$x = 4;
	$y = 3;
	$z = ( $x + $y );
	$m = $x * $y;
	$d = $y / $x;

	echo "<h4>Todo texto y/o html <span style = 'color:blue'>entregado por el procesador php</span> usando la sentencia echo.</h4>";
	echo "<hr/>";

	echo "<h4>Sin usar concatenador <span style = 'color:blue'>\$miVariable</span> : ";
	echo $miVariable;
	echo "</h4>";
	echo "<h4>Usando concatenador <span style = 'color:blue'>\$miVariable</span> : " . $miVariable . "</h4>";
	echo "<hr/>";

	$miVariable = true;
	echo "<h4>Variable tipo booleana o logica (verdadero) <span style = 'color:blue'>\$miVariable</span> : " . $miVariable . "</h4>";
	$miVariable = false;
	echo "<h4>Variable tipo booleana o logica (false) <span style = 'color:blue'>\$miVariable</span> : " . $miVariable . "</h4>";
	echo "<hr/>";

	echo "<h4><span style = 'color:blue'>MICONSTANTE</span> : " . MICONSTANTE . "</h4>";
	echo "<h4>Tipo de <span style = 'color:blue'>MICONSTANTE</span> : " . gettype(MICONSTANTE) . "</h4>";
	echo "<hr/>";

	echo "<h3>Arreglos:</h3>";
	echo "<h4><span style = 'color:blue'>\$aPalabras[0]</span> : " . $aPalabras[0] . "</h4>";
	echo "<h4><span style = 'color:blue'>\$aPalabras[1]</span> : " . $aPalabras[1] . "</h4>";
	echo "<h4>Tipo de <span style = 'color:blue'>\$aPalabras</span> : " . gettype($aPalabras) . "</h4>";
	echo "<h4>Por programa se agregan dos elementos nuevos</h4>";
	array_push($aPalabras, "Ciao", "Hallo");
	echo "<h3>Todos los elementos originales y agregados:</h3>";
	echo "<ul>";
	foreach($aPalabras as $aPalabra) {
		echo "<li>" . $aPalabra . "</li>";
	}
	echo "</ul>";

	array_push($aDiccionarioBasico, $aPalabras, $aPalabras2, $aPalabras3);
	echo "<h3>Arreglo de dos dimenciones (diccionario)</h3>";
	echo "<h4>La variable <span style = 'color:blue'>\$aDiccionarioBasico</span> : " . gettype($aDiccionarioBasico) . "</h4>";
	echo "<table>";
	echo "<thead><tr><th>Español</th><th>Ingles</th><th>Italiano</th><th>Aleman</th></tr></thead>";
	echo "<tbody>";
	foreach($aDiccionarioBasico as $aPalabras) {
		echo "<tr>";
		foreach($aPalabras as $aPalabra) {
			echo "<td>" . $aPalabra . "</td>";
		}
		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";
	echo "<h3>Tambien se puede expresar el valor de \$aDiccionarioBasico[1][3] : " . $aDiccionarioBasico[1][3] . "</h3>";
	echo "<h3>Cantidad de elementos de \$aDiccionarioBasico : " . sizeof($aDiccionarioBasico) . "</h3>";
	echo "<hr/>";

	echo "<h3>Variables tipo arreglo asociativo</h3>";
	echo "Legajo empleado: " . $renglonDeLiquidacion['legEmpleado'];
	echo "<br/>Apellido: " . $renglonDeLiquidacion['Apellido'];
	echo "<br/>Salario basico: " . $renglonDeLiquidacion['salarioBasico'];
	echo "<br/>Fecha de ingreso: " . $renglonDeLiquidacion['fechaIngr'];
	echo "<br/>";
	echo "<br/>Cantidad de elementos: " . sizeof($renglonDeLiquidacion);
	echo "<br/>Tipo de dato: " . gettype($renglonDeLiquidacion);
	echo "<hr/>";

	echo "<h4>Expresiones aritmeticas</h4>";
	echo "<h4>La variable \$x tiene el siguiente valor : " . $x . "</h4>";
	echo "<h4>La variable \$y tiene el siguiente valor : " . $y . "</h4>";
	echo "<h4>La variable \$x tiene el siguiente tipo : " . gettype($x) . "</h4>";
	echo "<h4>La variable \$y tiene el siguiente tipo : " . gettype($y) . "</h4>";
	echo "<h4>Asi se imprime una expresion aritmetica por ejemplo de Suma: ( \$x + \$y ) = " . $z . "</h4>";
	echo "<h4>Asi se imprime una expresion aritmetica por ejemplo de Multiplicacion: \$x * \$y = " . $m . "</h4>";
	echo "<h4>Asi se imprime una expresion aritmetica por ejemplo de Division: \$y / \$x = " . $d . "</h4>";
?>