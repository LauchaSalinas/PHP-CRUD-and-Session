var selectCat = document.getElementById("cat");
var newOpt;
var arts;
var cats;
var btnCargar = document.getElementById("btnMostrar");
var btnOcultar = document.getElementById("btnOcultar");
var btnClose =  document.getElementById("btnCloseWindow");

var form = document.getElementById("form");
form.target = "_blank";
form.method = "GET";
form.action = './respuestaFormulario.html';
var btnEnviar = document.getElementById("btnSubmit");

//lo hice de esta forma porque queria mantener el archivo en formato json, en vez de una string textual de json, espero se tome como valido
$.getJSON("../arts.json", function (json1) {
    arts = json1;
})

cats = JSON.parse(catsJSON);

$(function() {

    cats.opciones.forEach(element => {
        newOpt = document.createElement("option");

        newOpt.setAttribute("value", element.cat);
        
        if( parseInt(element.id) == 0 ){
            newOpt.setAttribute("selected", true);
        }
        newOpt.innerHTML = newOpt.value;

        selectCat.appendChild(newOpt);   
    });

});


btnEnviar.onclick = function(){
    if(form.checkValidity())
    {
        form.submit();
        form.reset();
    }
}

var tblBody = document.getElementById("cuerpoTabla");


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

btnClose.onmouseleave = function(){
    btnClose.innerHTML = "";
}

// Limpia el formulario al cerrar la ventana modal
btnClose.onclick = function(){
    form.reset();
}

// Cargado el documento el container está activo y la vent. modal escondida
$(document).ready(function(){
    $('#container').attr("class","activeContainer");
    $('#modalWindow').attr("class","modalWindowDisabled");
});

// Desactiva container y muestra vent. modal
$('#btnFormulario').click(function(){
    $('#container').attr("class","deactivatedContainer");
    $('#modalWindow').attr("class","modalWindowEnabled");
});

// Esconde vent. modal y acyiva container
$('#btnCloseWindow').click(function(){
    $('#container').attr("class","activeContainer");
    $('#modalWindow').attr("class","modalWindowDisabled");
});