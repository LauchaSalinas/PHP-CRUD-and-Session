var objJson;
var cats = JSON.parse(categories);
var cols = JSON.parse(columns);
var newRow;
var newCell;

// CARGA INICIAL SCRIPT

$(function() {
    var newOpt;
    //cargar opciones para categorias de ventana modal
    cats.opciones.forEach(element => {
        newOpt = document.createElement("option");

        newOpt.setAttribute("value", element.cat);
        
        if( parseInt(element.id) == 0 ){
            newOpt.setAttribute("selected", true);
        }
        newOpt.innerHTML = newOpt.value;

        document.getElementById("cat").appendChild(newOpt);   
    });
    //cargar opciones para select de orden de divBotones
    cols.opciones.forEach(element => {
        newOpt = document.createElement("option");

        newOpt.setAttribute("value", element.cat);
        
        if( parseInt(element.id) == 0 ){
            newOpt.setAttribute("selected", true);
        }
        newOpt.innerHTML = newOpt.value;

        document.getElementById("orden").appendChild(newOpt);   
    });
});



// FUNCIONAMIENTO BOTONES

// Cargar la tabla
document.getElementById("btnMostrar").onclick = function() {
    LlenarTabla();
}

// Vaciar la tabla
document.getElementById("btnVaciar").onclick = function() {
    $("#totalRegistros").html("Nro de registros: 0");
    $('#tabla tbody').empty();
}

// Abrir ventana modal de Cargar 
//      Desactiva container y muestra vent. modal
$('#btnCargar').click(function(){
    $('#container').attr("class","deactivatedContainer");
    $('#modalWindow').attr("class","modalWindowEnabled");
});

// boton Submit - Cargar nuevo articulo
document.getElementById("btnSubmit").onclick = function(){
    EnviarNuevo();
}

// Esconde vent. modal y activa container
$('#btnCloseWindow').click(function(){
    limpiarForm();
    $('#container').attr("class","activeContainer");
    $('#modalWindow').attr("class","modalWindowDisabled");
});


// Definición de funciones

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
            objJson=JSON.parse(respuestaDelServer);
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

                newCell = document.createElement("td");
                newCell.setAttribute("campo-dato", "edicion")
                newCell.innerHTML = "\
                    <img src='../../Recursos/Imagenes/pdf.png' class='btCeldaPDF'></img>\
                    <img src='../../Recursos/Imagenes/modi.png' class='btCeldaModi' id="+element.cod+"></img>\
                    <img src='../../Recursos/Imagenes/delete.png' class='btCeldaDelete'></img>";
                newRow.appendChild(newCell)

                document.getElementById("cuerpoTabla").appendChild(newRow);
            });//cierra for each
            $("#totalRegistros").html("Nro de registros: " + objJson.cuenta);
            $("#footerValor").html(objJson.totalValor);
            $("#footerStock").html(objJson.totalStock);
        }//cierra funcion asignada al success
    });//cierra ajax
}

function EnviarNuevo(){
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

function editIcon(articulo){
    
    // $('#mainContainer').css("visibility","hidden");
    // $('#modalWindow').css("visibility","visible");
    $('#mainContainer').attr("class","deactivatedContainer");
    $('#modalWindow').attr("class","modalWindowEnabled");
    $('#tituloVentanaModal').html("Modificación de registro");

    var articulo = getArticulo( articulo );
    // #######################################################
    // CARGA DATOS EN LOS CAMPOS
    // #######################################################

    $( '#btnSubmit' ).click(function(){
        var confirmaSend = confirm("¿Seguro quiere modificar el articulo?");
        if(confirmaSend == true){
            //update( articulo ); IMPLEMENTAR LAU
        }
    });
};

// Obtener Datos articulo
function getArticulo( el ) {
    //var articulo = $( el ).parents('td').;
    $.ajax({
        type: "GET",
        url: "./salidaJsonArticulos.php",
        data: { jurisdiccion: articulo },

        success: function( response, state ){
            var objJson = JSON.parse( response );
            objJson.articulos.forEach( function( argValor, argIndice ) {
                $("#codArticulo").val() = $( el ).parents('td').attr('id')
                
                $( '#combo_region' ).focus( argValor.region_id );
                $( '#input_jurisdiccion' ).val( argValor.nombre_jurisdiccion );
                $( '#input_capital' ).val( argValor.capital );
                $( '#input_poblacion' ).val( argValor.poblacion );
                $( '#input_superficie' ).val( argValor.superficie_km2 );
                $( '#input_densidad' ).val( argValor.densidad_habKm2 );
                $( '#date' ).val( argValor.declaracion_autonomia );
            });
    
        }
    });
    return articulo;
}

// Event Listener para botones de Modi, PDF y Delete
if (window.addEventListener) {
    document.addEventListener('click', function (e) {
      if (e.target.getAttribute("class") != null){
        if (e.target.getAttribute("class").indexOf("btCeldaModi") === 0) {
            console.log(e.target.parentElement.parentElement.querySelector('[campo-dato^="codigo"]').innerHTML);
        }
        if (e.target.getAttribute("class").indexOf("btCeldaPDF") === 0) {
            console.log(e.target.parentElement.parentElement.querySelector('[campo-dato^="codigo"]').innerHTML);
        }
        if (e.target.getAttribute("class").indexOf("btCeldaDelete") === 0) {
            console.log(e.target.parentElement.parentElement.querySelector('[campo-dato^="codigo"]').innerHTML);
        }
      }
    });
}

//Funciones para ordenar clickeando el primer header

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

//Funcion para cambiar el ordenamiento dependiendo del select "Orden"

document.getElementById("orden").addEventListener("change",function(){
    LlenarTabla()
});



/* pendientes

JSON LOCAL
Arreglar json local para simular carga con totales de valor y stock + orden + filtrado + agregar todos los valores.

Implementar cada una de las funciones Editar
abra la misma ventana modal, modifique el titulo (verificar que la de cargar tambien modifique el titulo) y precargue los valores

Ventana de respuestas del servidor
Armar nueva ventana modal chica de costado temporaria para informar bajas, altas y modificaciones.

Implementar funcion eliminar
con un alert 

Implementar funcion PDF visor
Armar una nueva ventana modal para ver el PDF

Implementar funcion PDF Carga en alta y modi
sumar opción y conectar con el back

Backend
Implementar Log

*/
// pop up, terminar de implementar
$(document).ready(function(){
    setTimeout(function(){
        $('#modalInfo').attr("class","modalWindowInfoEnabled");
        setTimeout(function(){
            $('#modalInfo').attr("class","modalWindowInfoDisabled");
        }, 5000);
    }, 2000);
});