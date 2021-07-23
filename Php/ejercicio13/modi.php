<?php
  require("./datosConexionBase.php");

  $id = $_POST["id"];
  $docType = $_POST["doc_type"];
  $description = $_POST["description"];
  $settlementDate = $_POST["settlement_date"];
  $amount = $_POST["amount"];
  $file = file_get_contents("". $_FILES['pdfDoc']['tmp_name']);
  $respuesta = "";

  // ::: Empieza conexion con el servidor :::
  $mysqli = new mysqli(SERVER,USUARIO,PASS,BASE);

  if ($mysqli->connect_errno<>0) {
    logError($mysqli->connect_errno);
    die("error => $mysqli->connect_errno");
  }

  // ::: Si no falla crea el query :::
  $sql = "update movimientos set id=?,doc_type=?,description=?,settlement_date=?,amount=?,file=? where id=?;";

  if ( !($sentencia = $mysqli->prepare($sql)) ) {
    $respuesta = $respuesta . "<br />Falló la preparación del template: (" . $mysqli->errno . ") " . $mysqli->error;
    logError($respuesta);
    die("error => $respuesta");

  } else {

    if ( !$sentencia->bind_param('ssssiss', $id, $docType, $description, $settlementDate, $amount, $file, $id) ) {
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

        $objMovimientoCreado = new stdClass();
        $objMovimientoCreado->resultado=$resultado;
        $salidaJson = json_encode($objMovimientoCreado);
        $mysqli->close();
        echo $salidaJson;
      }
    }
  }

?>