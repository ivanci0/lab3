<?php
  include("../manejoSesion.inc");
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Ejercicio 14 Sesion</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="./style.css"/>
    <script src="../../../especiales/jquery-3.6.0.js"></script> 
    <script type="text/javascript" src="./javascript.js"></script>
	</head>

	<body>
    <header id="header">
      <h1>Movimientos</h1>
      <div class="btnGroup">
        <label>Orden:</label>
        <input id="orden" value="fecha" readonly/>
        <button id="cargar" class="btn">Cargar datos</button>
        <button id="vaciar" class="btn">Vaciar datos</button>
        <button id="btnModal" class="btn">Cargar form</button>
        <button id="cerrarSesion" class="btn">Cerrar sesion</button>
      </div>
    </header>

    <main id="main">
      <div class="tableResponsive">
        <table id="tabla">
          <thead>
            <tr>
              <th campo-dato="id" name="ordenar" data-orden="id">ID</th>
              <th campo-dato="tipoDoc" name="ordenar" data-orden="doc_type">Tipo de documento</th>
              <th campo-dato="descripcion" name="ordenar" data-orden="description">Descripcion</th>
              <th campo-dato="fecha" name="ordenar" data-orden="settlement_date">Fecha</th>
              <th campo-dato="importe" name="ordenar" data-orden="amount">Importe</th>
              <th campo-dato="pdf" data-orden="pdf">PDF</th>
              <th campo-dato="modis" data-orden="modis">Modis</th>
              <th campo-dato="bajas" data-orden="bajas">Bajas</th>
            </tr>
          </thead>
          <thead>
            <tr>
              <td><input class="tdInput" id="id"/></td>
              <td><input class="tdInput" id="doc_type"/></td>
              <td><input class="tdInput" id="description"/></td>
              <td><input class="tdInput" id="settlement_date"/></td>
              <td><input class="tdInput" id="amount"/></td>
            </tr>
          </thead>
          <tbody id="bodyData">

          </tbody>
        </table>
      </div>
    </main>

    <div id="alta" class="modal">
      <div class="modalHeader"><h2>Encabezado modal</h2><button id="btnCerrar" type="button">X</button></div>
      <div class="modalBody">
        <header><h1>Formulario para alta - Carga de movimiento</h1></header>
        <main>
          <form id="formAlta" method="post" enctype="multipart/form-data">
            <div class="formGroup">
              <label>Descripcion</label>
              <input class="formInput" type="text" name="description" id="descripcion" required/>
            </div>
            <div class="formGroup">
              <label>Fecha</label>
              <input class="formInput" type="date" name="settlement_date" id="fecha" required/>
            </div>
            <div class="formGroup">
              <label>Importe</label>
              <input class="formInput" type="number" name="amount" id="importe" required/>
            </div>
            <div class="formGroup">
              <label>Tipo de movimiento</label>
              <select id="tipoDocs" class="formInput" name="doc_type" required></select>
            </div>
            <div class="formGroup">
              <label>Documento Pdf: </label>
              <input type="file" id="pdfDoc" name="pdfDoc" accept=".pdf"/>
            </div>
            <div class="control">
              <button type="submit" id="submitAlta" disabled>Enviar</button>
            </div>
          </form>
        </main>
        <footer><h1>Pie del formulario</h1></footer>
      </div>
    </div>

    <div id="modi" class="modal">
      <div class="modalHeader"><h2>Encabezado modal</h2><button id="btnCerrar" type="button">X</button></div>
      <div class="modalBody">
        <header><h1>Formulario para Modificacion de movimiento</h1></header>
        <main>
          <form id="formModi" method="post" enctype="multipart/form-data">
            <input id="modiId" name="id" value="" hidden/>
            <div class="formGroup">
              <label>Descripcion</label>
              <input class="formInput" type="text" name="description" id="modiDescripcion" required/>
            </div>
            <div class="formGroup">
              <label>Fecha</label>
              <input class="formInput" type="date" name="settlement_date" id="modiFecha" required/>
            </div>
            <div class="formGroup">
              <label>Importe</label>
              <input class="formInput" type="number" name="amount" id="modiImporte" required/>
            </div>
            <div class="formGroup">
              <label>Tipo de movimiento</label>
              <select class="formInput" name="doc_type" id="modiTipoDocs" required></select>
            </div>
            <div class="formGroup">
              <label>Documento Pdf: </label>
              <input type="file" id="modiPdfDoc" name="pdfDoc" accept=".pdf"/>
            </div>
            <div class="control">
              <button type="submit" id="submitModi" disabled>Enviar</button>
            </div>
          </form>
        </main>
        <footer><h1>Pie del formulario</h1></footer>
      </div>
    </div>

    <div id="respuesta" class="modal">
      <div class="modalHeader"><h2>Encabezado modal</h2><button id="btnCerrar" type="button">X</button></div>
      <div class="modalBody">
        <header><h1>Respuesta del servidor</h1></header>
        <main id="respuesta_main">
        </main>
        <footer><h1>Pie del formulario</h1></footer>
      </div>
    </div>

    <footer id="footer">
      <div id="cuenta"><h2>Nro de registros: 0</h2></div>
      <h1>Pie del formulario</h1>
    </footer>
	</body>
</html>