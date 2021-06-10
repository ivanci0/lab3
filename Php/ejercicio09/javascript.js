$(document).ready( function() {

  function toggleVisibility() {
    $("#elModal").toggleClass("visible");
    $("#contenedor").toggleClass("mainDesactivado");
    $("#header").toggleClass("mainDesactivado");
    $("#footer").toggleClass("mainDesactivado");
  }

  function onSend() {
    $("#resultado").html("<h3>Esperando respuesta...</h3>");
  }
  function onSuccess(respuesta, estado) {
    $("#resultado").html("<h3>Resultado de la transformacion a json en el servidor: </h3><h4>"+respuesta+"</h4>");
  }
  function enviarDatos() {
    if (confirm("¿Esta seguro que desea enviar datos?")) {

    }
    $.ajax({
      type: "POST",
      url: './respuesta.php',
      data: {
        idUsuario: $("#idUsuario").val(),
        login: $("#login").val(),
        apellido: $("#apellido").val(),
        nombre: $("#nombre").val(),
        fecha: $("#fecha").val()
      },
      beforeSend: onSend,
      success: function(respuesta, estado) {onSuccess(respuesta, estado)},
    })
  }

  // ::::: Handlers :::::
  $("#btnModal").click(toggleVisibility);
  $("#btnCerrar").click(toggleVisibility);
  $("#submit").click(enviarDatos);
});