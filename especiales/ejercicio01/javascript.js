$(document).ready( function() {
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
});