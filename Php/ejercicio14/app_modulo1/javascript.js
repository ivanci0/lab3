$(document).ready( function() {

  const vaciarTabla = () => {
    let miDiv = document.getElementById("bodyData");
    while (miDiv.firstChild) {
      miDiv.removeChild(miDiv.firstChild);
    }
    $("#cuenta").html(`<h2>Nro de registros: 0</h2>`);
  }

  const llenarTd = (td, texto, tipoDato, estilo = "", click = null) => {
    td.innerHTML = texto;
    td.className = "cellData " + estilo;
    td.setAttribute("campo-dato", tipoDato);
    td.onclick = click;
  }

  const getDocDescription = (docId) => {
    const docs = {
      1: "Factura A",
      2: "Factura B",
      3: "Factura C",
      4: "Nota de Credito",
      5: "Nota de Debito"
    };
    return docs[docId];
  }

  const toggleMain = () => {
    $("#main").toggleClass("mainDesactivado");
    $("#header").toggleClass("mainDesactivado");
    $("#footer").toggleClass("mainDesactivado");
  }

  const altaLista = () => {
    if (document.getElementById("descripcion").checkValidity() == true &&
        document.getElementById("fecha").checkValidity() == true &&
        document.getElementById("importe").checkValidity() == true &&
        document.getElementById("tipoDocs").checkValidity() == true)
    {
      $("#submitAlta").attr("disabled",false);
    } else {
      $("#submitAlta").attr("disabled",true);
    }
  }

  const modiLista = () => {
    if (document.getElementById("modiDescripcion").checkValidity() == true &&
        document.getElementById("modiFecha").checkValidity() == true &&
        document.getElementById("modiImporte").checkValidity() == true &&
        document.getElementById("modiTipoDocs").checkValidity() == true)
    {
      $("#submitModi").attr("disabled",false);
    } else {
      $("#submitModi").attr("disabled",true);
    }
  }

  const onPdfClick = (id) => {
    if (confirm("¿Seguro que queres ver el pdf?")) {
      verPDF(id);
    }
  }

  const onModiClick = (id) => {
    $("#modi").addClass("activo");
    toggleMain();
    CompletaFichaArticulo(id);
  }

  const onBorrarClick = (id) => {
    if (confirm("¿Seguro que queres borrar?")) {
      baja(id);
    }
  }

  const CompletaFichaArticulo = (id) => {
    $.ajax({
      type: 'GET',
      url: './salidaJsonMovimiento.php',
      data: { id },
      success: function (respuesta, estado) {
        let data = JSON.parse(respuesta);
        
        fillTiposDoc($("#modiTipoDocs"), data.docType);
        $("#modiId").val(data.id);
        $("#modiDescripcion").val(data.description);
        $("#modiFecha").val(data.settlementDate);
        $("#modiImporte").val(data.amount);
      }
    });
  }

  const llenarTabla = (orden = "settlement_date") => {
    $("#bodyData").html("<p>Eserando respuesta ..</p>");
    $.ajax({
      type: 'GET',
      url: './salidaJsonMovimientos.php',
      data: {
        orden,
        f_id: $("#id").val(),
        f_doc_type: $("#doc_type").val(),
        f_description: $("#description").val(),
        f_settlement_date: $("#settlement_date").val(),
        f_amount: $("#amount").val()
      },
      success: function (respuesta, estado) {
        vaciarTabla();
        let data = JSON.parse(respuesta);

        let trs = data.movimientos.map(movimiento => {

          let tr = document.createElement("tr")
          let tds = Array.from({length: 8}, () => document.createElement("td"))
  
          llenarTd(tds[0], movimiento.id, "id", "centrada");
          llenarTd(tds[1], getDocDescription(movimiento.docType), "tipoDoc");
          llenarTd(tds[2], movimiento.description, "descripcion");
          llenarTd(tds[3], movimiento.settlementDate, "fecha", "centrada");
          llenarTd(tds[4], movimiento.amount, "importe", "centrada");
          llenarTd(tds[5], "<button class='btCelda'>Doc.pdf</button>", "articulos_btPdf", "centrada", () => onPdfClick(movimiento.id));
          llenarTd(tds[6], "<button class='btCelda'>Modi</button>", "articulos_btModi", "centrada", () => onModiClick(movimiento.id));
          llenarTd(tds[7], "<button class='btCelda'>Borrar</button>", "articulos_btBorrar", "centrada", () => onBorrarClick(movimiento.id));
  
          tr.append(...tds);
          return tr;
        });
        
        $("#cuenta").html(`<h2>Nro de registros: ${data.cuenta}</h2>`);
        $("#bodyData").append(trs);
      }
    });
  }

  const fillTiposDoc = (select, selected = "") => {
    $.ajax({
      type: 'GET',
      url: './salidaJsonTiposDocumento.php',
      success: function (respuesta, estado) {
        let data = JSON.parse(respuesta);

        let options = data.tiposDocumento.map(option => {
          let opt = document.createElement("option");
          opt.setAttribute("value", option.id);
          opt.innerHTML = option.description;
          return opt;
        });
        let first = document.createElement("option")
        first.setAttribute("value", "")
        first.innerHTML = "Seleccione una opcion..."
        
        select.empty();
        select.append(first);
        select.append(options);
        select.val(selected);
      }
    });
  }

  const baja = (id) => {
    //console.log("Hace la baja de ", id);
    $.ajax({
      type: 'POST',
      url: './baja.php',
      data: {
        id: id
      },
      success: function (respuesta, estado) {
        llenarTabla();
        let data = JSON.parse(respuesta);
        
        //console.log("se dio la baja", data);
        toggleMain();
        $("#respuesta_main").html(`<h3>Se dio la baja de ${id} correctamente</h3>`);
        $("#respuesta").addClass("activo");
      }
    });
  }

  const verPDF = (id) => {
    //console.log("hace la consulta", id)
    $.ajax({
      type: 'GET',
      url: './traeDoc.php',
      data: { id },
      success: function (respuesta, estado) {
        let data = JSON.parse(respuesta);

        //console.log("funca", data, respuesta);
        
        toggleMain();
        $("#respuesta_main").empty();
        $("#respuesta_main").html("<iframe width='100%' height='359px' src='data:application/pdf;base64,"+data.file+"'></iframe>");
        $("#respuesta").addClass("activo");
      }
    });
  }
  
  $("#btnModal").click(() => {
    fillTiposDoc($("#alta #tipoDocs"), "");
    $("#alta").addClass("activo")
    toggleMain();
  });
  $("#btnCerrar").click(() => {
    $("#alta").removeClass("activo")
    toggleMain();
  });
  $("#modi #btnCerrar").click(() => {
    $("#modi").removeClass("activo")
    toggleMain();
  });
  $("#respuesta #btnCerrar").click(() => {
    $("#respuesta").removeClass("activo")
    toggleMain();
  });

  $("#formAlta").on("keyup", () => {
    altaLista();
  });

  $("#formAlta").on('submit', function(event) {
    event.preventDefault();
    //console.log("hace alta");
    
    $.ajax({
      type: 'POST',
      url: './alta.php',
      enctype: 'multipart/form-data',
      processData: false,
      contentType: false,
      cache: false,
      data: new FormData($("#formAlta")[0]),
      success: function (respuesta, estado) {
        llenarTabla();

        let data = JSON.parse(respuesta);
        
        //console.log("se dio el alta", data, estado);
        $("#respuesta_main").html(`
          <h3>Datos recibidos para el alta:</h3>
          <h4>Tipo de documento:</h4> ${$("#tipoDocs").val()}
          <h4>Descripcion:</h4> ${$("#descripcion").val()}
          <h4>Fecha:</h4> ${$("#fecha").val()}
          <h4>Importe:</h4> ${$("#importe").val()}
          <h4>Archivo:</h4> ${$("#pdfDoc").val()}
        `);
        $("#alta").removeClass("activo");
        $("#respuesta").addClass("activo");
      },
      error: function (respuesta, estado) {
        //console.log("con errores", respuesta, estado)
      }
    });
  });

  $("#formModi").on("keyup", () => {
    modiLista();
  });

  $("#formModi").on('submit', function (event) {
    event.preventDefault();
    //console.log("hace modi");

    $.ajax({
      type: 'POST',
      url: './modi.php',
      enctype: 'multipart/form-data',
      processData: false,
      contentType: false,
      cache: false,
      data: new FormData($("#formModi")[0]),
      success: function (respuesta, estado) {
        llenarTabla();

        let data = JSON.parse(respuesta);
        
        //console.log("se dio la modificacion", data);
        $("#respuesta_main").html(`
          <h3>Datos recibidos para la modificacion:</h3>
          <h4>ID:</h4> ${$("#modiId").val()}
          <h4>Tipo de documento:</h4> ${$("#modiTipoDocs").val()}
          <h4>Descripcion:</h4> ${$("#modiDescripcion").val()}
          <h4>Fecha:</h4> ${$("#modiFecha").val()}
          <h4>Importe:</h4> ${$("#modiImporte").val()}
        `);
        $("#modi").removeClass("activo");
        $("#respuesta").addClass("activo");
      },
      error: function (respuesta, estado) {
        //console.log("con errores", respuesta);
      },
      complete: function (respuesta, estado) {
        //console.log("finalizo", respuesta)
      }
    });
  });

  $("[name='ordenar']").click((event) => {
    $("#orden").val($(event.target).attr("campo-dato"));
    llenarTabla($(event.target).attr("data-orden"));
  });

  $("#vaciar").click(() => vaciarTabla());
  $("#cargar").click(() => llenarTabla());
  $("#cerrarSesion").click(() => location.href="../destruirSesion.php");
});