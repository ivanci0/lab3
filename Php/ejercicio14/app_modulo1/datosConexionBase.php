<?php
  include("../manejoSesion.inc");

  // Constantes
  define('SERVER','btirzrtxgqzusk0diwim-mysql.services.clever-cloud.com:3306');
  define("USUARIO",'ur7qiiys6dm1yljg');
  define("PASS",'P68hKakU5VgUQFJUUZ8M');
  define("BASE",'btirzrtxgqzusk0diwim');

  // funciones generales
  function logError($error) {
    $puntero = fopen("./errores.log","a");
    fwrite($puntero, "Fallo conexion base de datos: ");
    fwrite($puntero, $error . " ");
    $fecha = date("Y-m-d");
    fwrite($puntero, date("Y-m-d H-i") . " ");
    fwrite($puntero, "\n");
    fclose($puntero);
  }
?>