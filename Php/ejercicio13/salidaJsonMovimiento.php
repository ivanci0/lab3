<?php
  require("./datosConexionBase.php");

  $f_id = $_GET["id"];

  // ::: Empieza conexion con el servidor :::
  $mysqli = new mysqli(SERVER,USUARIO,PASS,BASE);

  if ($mysqli->connect_errno<>0) {
    logError($mysqli->connect_errno);
    die("error => $mysqli->connect_errno");
  }

  // ::: Si no falla crea el query :::
  $sql = "select * from movimientos where id = ?";

  if ( !($sentencia = $mysqli->prepare($sql)) ) {
    $respuesta = $respuesta . "<br />Falló la preparación del template: (" . $mysqli->errno . ") " . $mysqli->error;
    logError($respuesta);
    die("error => $respuesta");

  } else {

    if ( !$sentencia->bind_param('s', $f_id) ) {
      $respuesta = $respuesta . "<br />Falló la vinculación de parámetros simples: (" . $sentencia->errno . ") " . $sentencia->error;
      logError($respuesta);
      die("error => $respuesta");

    } else {
      if ( !$sentencia->execute() ) {
        $respuesta = $respuesta . "<br />Falló la ejecución de parametros simples: (" . $sentencia->errno . ") " . $sentencia->error;
        logError($respuesta);
        die("error => $respuesta");
        
      } else {
        $resultado = $sentencia->get_result();

        $fila=$resultado->fetch_assoc();
        $objMovimiento = new stdClass();
        $objMovimiento->id=$fila['id'];
        $objMovimiento->docType=$fila['doc_type'];
        $objMovimiento->description=$fila['description'];
        $objMovimiento->settlementDate=$fila['settlement_date'];
        $objMovimiento->amount=$fila['amount'];

        $salidaJson = json_encode($objMovimiento);
        $mysqli->close();
        echo $salidaJson;
      }
    }
  }

?>