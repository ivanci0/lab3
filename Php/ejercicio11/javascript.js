$(document).ready( function() {

  const vaciarTabla = () => {
    let miDiv = document.getElementById("bodyData");
    while (miDiv.firstChild) {
      miDiv.removeChild(miDiv.firstChild);
    }
    $("#cuenta").html(`<h2>Nro de registros: 0</h2>`);
  }

  const llenarTd = (td, texto, tipoDato, estilo = "") => {
    td.innerText = texto;
    td.className = "cellData " + estilo;
    td.setAttribute("campo-dato", tipoDato)
  }

  const llenarTabla = (orden = "settlement_date") => {
    $("#bodyData").html("<p>Eserando respuesta ..</p>");
    $.ajax({
      type: 'GET',
      url: './salidaJson.php',
      data: {orden},
      success: function (respuesta, estado) {
        vaciarTabla();
        let data = JSON.parse(respuesta);

        let trs = data.movimientos.map(movimiento => {

          let tr = document.createElement("tr")
          let tds = Array.from({length: 5}, v => document.createElement("td"))
  
          llenarTd(tds[0], movimiento.id, "id", "centrada");
          llenarTd(tds[1], movimiento.docType, "tipoDoc");
          llenarTd(tds[2], movimiento.description, "descripcion");
          llenarTd(tds[3], movimiento.settlementDate, "fecha", "centrada");
          llenarTd(tds[4], movimiento.amount, "importe", "centrada");
  
          tr.append(...tds);
          return tr;
        });
        
        $("#cuenta").html(`<h2>Nro de registros: ${data.cuenta}</h2>`);
        $("#bodyData").append(trs);
      }
    });
  }
  
  $("[name='orden']").click((event) => {
    $("#orden").val($(event.target).attr("campo-dato"));
    llenarTabla(event.target.id);
  });
  $("#vaciar").click(() => vaciarTabla());
  $("#cargar").click(() => llenarTabla());
});