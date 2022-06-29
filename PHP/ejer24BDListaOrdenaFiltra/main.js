var selectCat = document.getElementById("cat");
var selectCat2 = document.getElementById("orden");
var newOpt;
var arts;
var btnCargar = document.getElementById("btnMostrar");
var btnOcultar = document.getElementById("btnOcultar");
var btnClose =  document.getElementById("btnCloseWindow");

var form = document.getElementById("form");
form.target = "_blank";
form.method = "GET";
form.action = './respuestaFormulario.html';
var btnEnviar = document.getElementById("btnSubmit");

var cats = JSON.parse(categories);
var cols = JSON.parse(columns);

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

    cols.opciones.forEach(element => {
        newOpt = document.createElement("option");

        newOpt.setAttribute("value", element.cat);
        
        if( parseInt(element.id) == 0 ){
            newOpt.setAttribute("selected", true);
        }
        newOpt.innerHTML = newOpt.value;

        selectCat2.appendChild(newOpt);   
    });
});

btnEnviar.onclick = function(){
    EnviarNuevo();
}

var tblBody = document.getElementById("cuerpoTabla");


var newRow;
var newCell;
var cargado = 0;

btnCargar.onclick = function() {
    LlenarTabla();
}

btnOcultar.onclick = function() {
    $("#totalRegistros").html("Nro de registros: 0");
    $('#tabla tbody').empty();
}

btnClose.onmouseleave = function(){
    btnClose.innerHTML = "";
}

// Limpia el formulario al cerrar la ventana modal
btnClose.onclick = function(){
    limpiarForm();
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

// Esconde vent. modal y activa container
$('#btnCloseWindow').click(function(){
    $('#container').attr("class","activeContainer");
    $('#modalWindow').attr("class","modalWindowDisabled");
});

function LlenarTabla(){
    // console.debug($("#orden").val());
    // console.debug($("#filtroCodigo").val());
    // console.debug($("#filtroCategoria").val());
    // console.debug($("#filtroValor").val());
    // console.debug($("#filtroDescripcion").val());
    // console.debug($("#filtroFechaAlta").val());
    // console.debug($("#filtroSaldo").val());
    
    var request = $.ajax({
        type: "GET",
        url: "./salidaJsonArticulos.php",
        data: {
            orden: $("#orden").val(), 
            filtroCodigo: $("#filtroCodigo").val(), 
            filtroCategoria: $("#filtroCategoria").val(), 
            filtroValor: $("#filtroValor").val(), 
            filtroDescripcion: $("#filtroDescripcion").val(), 
            filtroFechaAlta:$("#filtroFechaAlta").val(),
            filtroSaldo:$("#filtroSaldo").val()
        },
        success: function(respuestaDelServer,estado) {
            $('#tabla tbody').empty();
            var objJson=JSON.parse(respuestaDelServer);
            objJson.articulos.forEach(element => {
                
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
            });//cierra for each
            $("#totalRegistros").html("Nro de registros: " + objJson.cuenta);
            $("#footerValor").html(objJson.totalValor);
            $("#footerStock").html(objJson.totalStock);
        }//cierra funcion asignada al success
    });//cierra ajax
}

function EnviarNuevo(){
    // console.debug($("#codArticulo").val().toUpperCase());
    // console.debug($("#cat").val().toUpperCase());
    // console.debug($("#valor").val());
    // console.debug($("#desc").val().toUpperCase());
    // console.debug($("#fechaAlta").val());
    // console.debug($("#stock").val());
    
    var request = $.ajax({
        type: "GET",
        url: "./entradaJsonArticulos.php",
        data: {
            filtroCodigo: $("#codArticulo").val().toUpperCase(), 
            filtroCategoria: $("#cat").val().toUpperCase(), 
            filtroValor: $("#valor").val(), 
            filtroDescripcion: $("#desc").val().toUpperCase(), 
            filtroFechaAlta:$("#fechaAlta").val(),
            filtroSaldo:$("#stock").val()
        },
        success: function(respuestaDelServer,estado) {
            console.debug(respuestaDelServer);
            alert(estado);
        }//cierra funcion asignada al success
    });//cierra ajax
}

function limpiarForm(){
    document.getElementById("codArticulo").value = "";
    document.getElementById("cat").selectedIndex = "0";
    document.getElementById("valor").value = "";
    document.getElementById("desc").value = "";
    document.getElementById("fechaAlta").value = "";
    document.getElementById("stock").value = "";
}

document.getElementById("orden").addEventListener("change",function(){
    LlenarTabla()
});

$("#ordenCodigo").click(function (){
    document.getElementById("orden").selectedIndex = "1";
    LlenarTabla();
});

$("#ordenCategoria").click(function (){
    document.getElementById("orden").selectedIndex = "2";
    LlenarTabla();
});

$("#ordenValor").click(function (){
    document.getElementById("orden").selectedIndex = "3";
    LlenarTabla();
});
$("#ordenDescripcion").click(function (){
    document.getElementById("orden").selectedIndex = "4";
    LlenarTabla();
});
$("#ordenFechaAlta").click(function (){
    document.getElementById("orden").selectedIndex = "5";
    LlenarTabla();
});
$("#ordenSaldo").click(function (){
    document.getElementById("orden").selectedIndex = "6";
    LlenarTabla();
});
