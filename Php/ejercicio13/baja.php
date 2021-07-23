<?php
  require("./datosConexionBase.php");

  $id = $_POST["id"];
  $respuesta = "";

  // ::: Empieza conexion con el servidor :::
  $mysqli = new mysqli(SERVER,USUARIO,PASS,BASE);

  if ($mysqli->connect_errno<>0) {
    logError($mysqli->connect_errno);
    die("error => $mysqli->connect_errno");
  }

  // ::: Si no falla crea el query :::
  $sql = "delete from movimientos where id=?;";

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

        $objMovimientoEliminado = new stdClass();
        $objMovimientoEliminado->resultado=$resultado;
        $salidaJson = json_encode($objMovimientoEliminado);
        $mysqli->close();
        echo $salidaJson;
      }
    }
  }

?>