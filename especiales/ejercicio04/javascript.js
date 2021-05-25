$(document).ready( function() {

  const vaciarTabla = () => {
    let miDiv = document.getElementById("bodyData");
    while (miDiv.firstChild) {
      miDiv.removeChild(miDiv.firstChild);
    }
  }

  const llenarTd = (td, texto, tipoDato, estilo = "") => {
    td.innerText = texto;
    td.className = "cellData " + estilo;
    td.setAttribute("campo-dato", tipoDato)
  }

  const llenarTabla = () => {
    $.getJSON("../documentos.json", data => {
      vaciarTabla();
      let trs = data.map(articulo => {

        let tr = document.createElement("tr")
        let tds = Array.from({length: 5}, v => document.createElement("td"))

        llenarTd(tds[0], articulo.id, "id", "centrada");
        llenarTd(tds[1], articulo.tipoDoc, "tipoDoc");
        llenarTd(tds[2], articulo.descripcion, "descripcion");
        llenarTd(tds[3], articulo.fecha, "fecha", "centrada");
        llenarTd(tds[4], articulo.importe, "importe", "centrada");

        tr.append(...tds);
        return tr;
      });
      
      $("#bodyData").append(trs);
    });
  }

  $.getJSON("../tipoDocs.json", data => {
    let options = data.map(option => {
      let opt = document.createElement("option")
      opt.setAttribute("value", option.value);
      opt.innerHTML = option.description;
      return opt;
    });
    let first = document.createElement("option")
    first.setAttribute("value", "")
    first.innerHTML = "Seleccione una opcion..."
    
    $("#tipoDocs").append(first);
    $("#tipoDocs").append(options);
  });

  $("#btnModal").click(() => {
    $("#contenedor").addClass("activo")
    $("#main").addClass("mainDesactivado")
    $("#header").addClass("mainDesactivado")
    $("#footer").addClass("mainDesactivado")
  });
  $("#btnCerrar").click(() => {
    $("#contenedor").removeClass("activo")
    $("#main").removeClass("mainDesactivado")
    $("#header").removeClass("mainDesactivado")
    $("#footer").removeClass("mainDesactivado")
  });
  
  $("#vaciar").click(() => vaciarTabla());
  $("#cargar").click(() => llenarTabla());

  llenarTabla();
});