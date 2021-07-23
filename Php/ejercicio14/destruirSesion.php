<?php
  include('./manejoSesion.inc');

  session_destroy();
  header('location:./formularioDeLogin.html');
?>
