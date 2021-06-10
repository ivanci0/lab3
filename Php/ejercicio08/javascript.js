$(document).ready( function() {

  function toggleVisibility() {
    $("#flecha").toggleClass("visible");
  }
  function onSend() {
    $("#resultado").html("<h2>Esperando respuesta...</h2>");
    $("#estado").html("<h2>Estado del requerimiento:</h2>");
  }
  function onSuccess(respuesta, estado) {
    $("#resultado").html("<h2>Resultado: </h2><h4>"+respuesta+"</h4>");
    $("#estado").append("<h4>"+estado+"</h4>");
  }
  function enviarDatos() {
    $.ajax({
      type: "POST",
      url: './respuesta.php',
      data: {clave: $("#clave").val()},
      beforeSend: onSend,
      success: function(respuesta, estado) {onSuccess(respuesta, estado)},
    })
  }

  // ::::: Handlers :::::
  $("#img_container").hover(toggleVisibility);
  $("#img_container").click(enviarDatos);
});