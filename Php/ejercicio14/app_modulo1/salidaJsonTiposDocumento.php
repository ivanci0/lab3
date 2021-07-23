<?php
  require("./datosConexionBase.php");
  include("../manejoSesion.inc");

  $respuesta = "";

  // ::: Empieza conexion con el servidor :::
  $mysqli = new mysqli(SERVER,USUARIO,PASS,BASE);

  if ($mysqli->connect_errno<>0) {
    logError($mysqli->connect_errno);
    die("error => $mysqli->connect_errno");
  }

  // ::: Si no falla crea el query :::
  $sql = "select * from tipo_documentos";

  if ( !($sentencia = $mysqli->prepare($sql)) ) {
    $respuesta = $respuesta . "<br />Falló la preparación del template: (" . $mysqli->errno . ") " . $mysqli->error;
    logError($respuesta);
    die("error => $respuesta");

  } else {

    if ( !$sentencia->execute() ) {
      $respuesta = $respuesta . "<br />Falló la ejecución de parametros simples: (" . $sentencia->errno . ") " . $sentencia->error;
      logError($respuesta);
      die("error => $respuesta");
      
    } else {
      $resultado = $sentencia->get_result();

      $tiposDocumento = [];

      while($fila=$resultado->fetch_assoc()) {
        $objTiposDocumento = new stdClass();
        $objTiposDocumento->id=$fila['id'];
        $objTiposDocumento->description=$fila['description'];
        array_push($tiposDocumento,$objTiposDocumento);
      }

      $objTiposDocumentos = new stdClass();
      $objTiposDocumentos->tiposDocumento=$tiposDocumento;
      $salidaJson = json_encode($objTiposDocumentos);
      $mysqli->close();
      echo $salidaJson;
    }
  }

?>