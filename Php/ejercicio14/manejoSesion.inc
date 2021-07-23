<?php
if(!isset($_SESSION)) { 
  session_start(); 
}
if(!isset($_SESSION['session_id'])) {
  header('location:/Php/ejercicio14/index.php');
  exit();
}
?>