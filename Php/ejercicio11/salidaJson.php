<?php
  require("./datosConexionBase.php");
  sleep(2);

  $orden = $_GET["orden"];
  $mysqli = new mysqli(SERVER,USUARIO,PASS,BASE);
  $sql = "select * from movimientos order by " . $orden;

  if (!( $resultado = $mysqli->query($sql))) { //Devuelve un objeto $resultado
    die();
  }

  $resultadoCuentaRegistros = $resultado->num_rows;
  $movimientos = [];

  while($fila=$resultado->fetch_assoc()) {
    $objMovimiento = new stdClass();
    $objMovimiento->id=$fila['id'];
    $objMovimiento->docType=$fila['doc_type'];
    $objMovimiento->description=$fila['description'];
    $objMovimiento->settlementDate=$fila['settlement_date'];
    $objMovimiento->amount=$fila['amount'];
    array_push($movimientos,$objMovimiento);
  }

  $objMovimientos = new stdClass();
  $objMovimientos->movimientos=$movimientos;
  $objMovimientos->cuenta=$resultadoCuentaRegistros;
  $salidaJson = json_encode($objMovimientos);
  $mysqli->close();
  echo $salidaJson;
?>