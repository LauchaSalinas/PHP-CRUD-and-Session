var selectCat = document.getElementById("cat");
var newOpt;
var arts;
var cats;
var btnClose =  document.getElementById("btnCloseWindow");

var form = document.getElementById("form");
form.target = "_blank";
form.method = "GET";
form.action = './respuestaFormulario.html';
var btnEnviar = document.getElementById("btnSubmit");

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