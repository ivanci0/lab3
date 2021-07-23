<?php
  require("./datosConexionBase.php");
  include("../manejoSesion.inc");

  /**
   * Este es el posta
   */

  sleep(2);
  $orden = $_GET["orden"];
  $f_id = $_GET["f_id"];
  $f_doc_type = $_GET["f_doc_type"];
  $f_description = $_GET["f_description"];
  $f_settlement_date = $_GET["f_settlement_date"];
  $f_amount = $_GET["f_amount"];
  $respuesta = "";

  // ::: Empieza conexion con el servidor :::
  $mysqli = new mysqli(SERVER,USUARIO,PASS,BASE);

  if ($mysqli->connect_errno<>0) {
    logError($mysqli->connect_errno);
    die("error => $mysqli->connect_errno");
  }

  // ::: Si no falla crea el query :::
  $sql = "select * from movimientos where ";
  $sql = $sql . "id LIKE ? and ";
  $sql = $sql . "doc_type LIKE ? and ";
  $sql = $sql . "description LIKE ? and ";
  $sql = $sql . "settlement_date LIKE ? and ";
  $sql = $sql . "amount LIKE ?";
  $sql = $sql . " order by " . $orden;

  if ( !($sentencia = $mysqli->prepare($sql)) ) {
    $respuesta = $respuesta . "<br />Falló la preparación del template: (" . $mysqli->errno . ") " . $mysqli->error;
    logError($respuesta);
    die("error => $respuesta");

  } else {
    $likeVarId = "%" . $f_id . "%";
    $likeVarDocType = "%" . $f_doc_type . "%";
    $likeVarDescription = "%" . $f_description . "%";
    $likeVarSettlementDate = "%" . $f_settlement_date . "%";
    $likeVarAmount = "%" . $f_amount . "%";

    if ( !$sentencia->bind_param('sssss', $likeVarId, $likeVarDocType, $likeVarDescription, $likeVarSettlementDate, $likeVarAmount) ) {
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
      }
    }
  }

?>