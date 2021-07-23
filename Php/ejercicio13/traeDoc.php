<?php
  require("./datosConexionBase.php");

  $id = $_GET["id"];
  $respuesta = "";

  // ::: Empieza conexion con el servidor :::
  $mysqli = new mysqli(SERVER,USUARIO,PASS,BASE);

  if ($mysqli->connect_errno<>0) {
    logError($mysqli->connect_errno);
    die("error => $mysqli->connect_errno");
  }

  // ::: Si no falla crea el query :::
  $sql = "select file from movimientos where id=?;";

  if ( !($sentencia = $mysqli->prepare($sql)) ) {
    $respuesta = $respuesta . "<br />Falló la preparación del template: (" . $mysqli->errno . ") " . $mysqli->error;
    logError($respuesta);
    die("error => $respuesta");

  } else {

    if ( !$sentencia->bind_param('s', $id) ) {
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
        $file = $resultado->fetch_assoc();

        $objMovimiento = new stdClass();
        $objMovimiento->file = base64_encode($file['file']);
        $salidaJson = json_encode($objMovimiento, JSON_INVALID_UTF8_SUBSTITUTE);
        $mysqli->close();
        echo $salidaJson;
      }
    }
  }

?>