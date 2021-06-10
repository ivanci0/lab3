<?php
  if (isset($_POST['clave'])) {
    sleep(3);
    $clave = $_POST['clave'];
    $md5 = md5($clave);
    $sha1 = sha1($clave);
    echo("
      Clave: $clave
      <br/>
      Clave encriptada en md5: $md5
      <br/>
      Clave encriptada en sha1: $sha1
    ");
  }
?>