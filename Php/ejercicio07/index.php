<?php

function formulario() {
  echo("
    <!DOCTYPE html>
    <html lang='es'>
      <head>
        <title>Ejercicio 07 Formulario a encriptar</title>
        <meta http-equiv='Content-Type' content='text/html;charset=utf-8'/>
        <link rel='stylesheet' type='text/css' href='./style.css'/>
      </head>
      <body>
        <form action='./index.php' method='POST'>
          <div>
            <label>Ingrese la clave a encriptar: </label>
            <input type='text' name='clave'/>
          </div>
          <button type='submit'>Obtener encriptacion</button>
        </form>
      </body>
    </html>
  ");
}

function respuesta($clave) {
  $md5 = md5($clave);
  $sha1 = sha1($clave);
  echo("
    <!DOCTYPE html>
    <html lang='es'>
      <head>
        <title>Respuesta PHP</title>
        <meta http-equiv='Content-Type' content='text/html;charset=utf-8'/>
      </head>
      <body>
        Clave: $clave
        <br/>
        Clave encriptada en md5: $md5
        <br/>
        Clave encriptada en sha1: $sha1
      </body>
    </html>
  ");
}

if (isset($_POST['clave'])) {
  respuesta($_POST['clave']);
} else {
  formulario();
}
?>