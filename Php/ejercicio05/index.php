<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Ejercicio 05 Variables de tipo objeto</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
		<link rel="stylesheet" type="text/css" href="./style.css"/>
	</head>
</html>
<?php
  $renglonesPedido = [];

  $objRenglonPedido = new stdclass;
  $objRenglonPedido->codArt = "cp001";
  $objRenglonPedido->precioUnitario=80;
  $objRenglonPedido->descripcion="Ala 800gr";
  $objRenglonPedido->cantidad=2;

  array_push($renglonesPedido, $objRenglonPedido, $objRenglonPedido);

  $objRenglonesPedido = new stdClass();
  $objRenglonesPedido->renglonesPedido=$renglonesPedido;
  $objRenglonesPedido->cantidadDeRenglones=count($renglonesPedido);

  $jsonRenglones= json_encode($objRenglonesPedido);

  echo "<h1>Variables de tipo objeto en PHP. Objeto renglon de pedido</h1>";
  echo "<h1 style='color:blue'>\$objRenglonPedido</h1>";
  echo "<br/>Codigo del articulo: " . $objRenglonPedido->codArt;
  echo "<br/>Descripcion del articulo: " . $objRenglonPedido->descripcion;
  echo "<br/>Precio unitario: " . $objRenglonPedido->precioUnitario;
  echo "<br/>Cantidad: " . $objRenglonPedido->cantidad;
  echo "<h1>Tipo de <span style='color:blue'>\$objRenglonPedido</span>: " . gettype($objRenglonPedido) ."</h1>";

  echo "<h1>Definamos arreglo de pedidos:</h1>";
  echo "<h1 style='color:blue'>\$renglonesPedido</h1>";
  echo "<h1>Tabula <span style='color:blue'>\$renglonesPedido</span>. Recorrer el arreglo de renglones y tabularlos con html</h1>";
  foreach ( $renglonesPedido as $objRenglonPedido ) {
    echo $objRenglonPedido->codArt . "&nbsp&nbsp";
    echo $objRenglonPedido->descripcion . "&nbsp&nbsp";
    echo $objRenglonPedido->precioUnitario . "&nbsp&nbsp";
    echo $objRenglonPedido->cantidad . "&nbsp&nbsp";
    echo "<br/>";
  }
  echo "<h3>Cantidad de renglones: " . count($renglonesPedido) . "</h3>";

  echo "<h1>Produccion de un objeto <span style='color:blue'>\$renglonesPedido</span> con dos atributos array renglonesPedido y cantidadDeRenglones</h1>";
  echo "Cantidad de renglones: " . $objRenglonesPedido->cantidadDeRenglones;

  echo "<h1>Produccion de un JSON jsonRenglones</h1>";
  echo $jsonRenglones;
?>