<?php
  if (isset($_POST['idUsuario'])) {
    sleep(3);
    
    $objProveedor = new stdclass;
    $objProveedor->idUsuario = $_POST['idUsuario'];
    $objProveedor->login = $_POST['login'];
    $objProveedor->apellido = $_POST['apellido'];
    $objProveedor->nombre = $_POST['nombre'];
    $objProveedor->fecha = $_POST['fecha'];

    $respuesta = json_encode($objProveedor);

    echo("$respuesta");
  }
?>