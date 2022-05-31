var btnCargar = document.getElementById("btnMostrar");
var btnOcultar = document.getElementById("btnOcultar");
var tblBody = document.getElementById("cuerpoTabla");
var arts;

//lo hice de esta forma porque queria mantener el archivo en formato json, en vez de una string textual de json, espero se tome como valido
$.getJSON("../arts.json", function (json) {
    arts = json;
})

var newRow;
var newCell;
var cargado = 0;

btnCargar.onclick = function() {
    if(cargado == 0) {
        arts.items.forEach(element => {
        
            newRow = document.createElement("tr");

            newCell = document.createElement("td");
            newCell.setAttribute("campo-dato", "codigo")
            newCell.innerHTML = element.cod;
            newRow.appendChild(newCell)
            
            newCell = document.createElement("td");
            newCell.setAttribute("campo-dato", "cat")
            newCell.innerHTML = element.cat;
            newRow.appendChild(newCell)
            
            newCell = document.createElement("td");
            newCell.setAttribute("campo-dato", "valor")
            newCell.innerHTML = element.val;
            newRow.appendChild(newCell)
            
            newCell = document.createElement("td");
            newCell.setAttribute("campo-dato", "descripcion")
            newCell.innerHTML = element.desc;
            newRow.appendChild(newCell)
            
            newCell = document.createElement("td");
            newCell.setAttribute("campo-dato", "fechaAlta")
            newCell.innerHTML = element.fechaAlta;
            newRow.appendChild(newCell)
            
            newCell = document.createElement("td");
            newCell.setAttribute("campo-dato", "saldo")
            newCell.innerHTML = element.stock;
            newRow.appendChild(newCell)

            tblBody.appendChild(newRow);
        });
        cargado++;
    }
}

btnOcultar.onclick = function() {
    cargado = 0;
    $('#tabla tbody').empty();
}