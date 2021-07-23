<?php
if(!isset($_SESSION)) { 
  session_start(); 
}
if(!isset($_SESSION['session_id'])) {
  header('location:/lab3/php/ejercicio14/index.php');
  exit();
}
?>