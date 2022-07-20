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
    LlenarTabla(true);
}

// Vaciar la tabla
document.getElementById("btnVaciar").onclick = function() {
    $("#totalRegistros").html("Nro de registros: 0");
    $('#tabla tbody').empty();
}

// Abrir ventana modal de Cargar 
//      Desactiva container y muestra vent. modal
$('#btnCargar').click(function(){
    MostrarVentanaModalArticulos();
    document.getElementById("mwHeader").innerHTML = "<h4>Formulario para Alta - Maestro de Artículos</h4>";
});
// boton Submit - Cargar nuevo articulo
$('#btnSubmit').click(function(){
    var tipoOperacion = document.getElementById("mwHeader").innerHTML.indexOf("Alta");
    console.log(tipoOperacion);
    if(tipoOperacion == -1){
        ModificarArticulo();
    }
    else EnviarNuevo();
});

// Esconde vent. modal Alta Modi y activa container
$('#btnCloseWindow').click(function(){
    limpiarForm();
    CerrarVentanaModalArticulos();
});

// Esconde vent. modal Alta Modi y activa container
$('#btnCloseWindowPDF').click(function(){
    CerrarVentanaModalPDF()
});

//Vacia la Tabla
document.getElementById("btnVaciar").onclick = function() {
    $("#totalRegistros").html("Nro de registros: 0");
    $('#tabla tbody').empty();
}

// Esconde vent. modal Alta Modi y activa container
$('#btnCloseWindowInfo').click(function(){
    CerrarPopUp()
});


// Definición de funciones

function MostrarVentanaModalArticulos(){
    $('#modalWindow').attr("class","modalWindowEnabled");
    $('#container').attr("class","deactivatedContainer");
}

function CerrarVentanaModalArticulos(){
    $('#container').attr("class","activeContainer");
    $('#modalWindow').attr("class","modalWindowDisabled");
}

function MostrarVentanaModalPDF(){
    $('#modalWindowPDF').attr("class","modalWindowPDFEnabled");
}

function CerrarVentanaModalPDF(){
    $('#modalWindowPDF').attr("class","modalWindowPDFDisabled");
    document.getElementById("ContainerPDF").removeChild(document.getElementById("ContainerPDF").firstChild); //Remueve el pdf anterior para que no se vea al cambiar
}

function CerrarPopUp(){
    $('#PopUpInfo').attr("class","PopUpInfoDisabled");
}

function checkValForm (){
    if (document.getElementById('form').checkValidity()==true) document.getElementById('btnSubmit').disabled = false;
    else document.getElementById('btnSubmit').disabled = true;
}

function LlenarTabla(boolPopUp){
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
            console.log(objJson);
            objJson.articulos.forEach(element => {
                
                newRow = document.createElement("tr");

                newCell = document.createElement("td");
                newCell.setAttribute("campo-dato", "codigo");
                newCell.innerHTML = element.cod;
                newRow.appendChild(newCell)
                
                newCell = document.createElement("td");
                newCell.setAttribute("campo-dato", "cat");
                newCell.innerHTML = element.cat;
                newRow.appendChild(newCell)
                
                newCell = document.createElement("td");
                newCell.setAttribute("campo-dato", "valor");
                newCell.innerHTML = element.val;
                newRow.appendChild(newCell)
                
                newCell = document.createElement("td");
                newCell.setAttribute("campo-dato", "descripcion");
                newCell.innerHTML = element.desc;
                newRow.appendChild(newCell)
                
                newCell = document.createElement("td");
                newCell.setAttribute("campo-dato", "fechaAlta");
                newCell.innerHTML = element.fechaAlta;
                newRow.appendChild(newCell)
                
                newCell = document.createElement("td");
                newCell.setAttribute("campo-dato", "saldo");
                newCell.innerHTML = element.stock;
                newRow.appendChild(newCell)

                newCell = document.createElement("td");
                newCell.setAttribute("campo-dato", "edicion");
                newCell.innerHTML = "\
                    <img src='../../Recursos/Imagenes/pdf.png' class='btCeldaPDF'></img>\
                    <img src='../../Recursos/Imagenes/modi.png' class='btCeldaModi' id="+element.cod+"></img>\
                    <img src='../../Recursos/Imagenes/delete.png' class='btCeldaDelete'></img>";
                newRow.appendChild(newCell);

                document.getElementById("cuerpoTabla").appendChild(newRow);
            });//cierra for each
            $("#totalRegistros").html("Nro de registros: " + objJson.cuenta);
            $("#footerValor").html(objJson.totalValor);
            $("#footerStock").html(objJson.totalStock);
            if(boolPopUp) PopUpMostrarMensaje(objJson.respuesta_estado, objJson.success);
        }//cierra funcion asignada al success
    });//cierra ajax
}

function EnviarNuevo(){
    var confirmaAlta = confirm("Esta seguro que deseea añadir el articulo ?");
    if (confirmaAlta)
    {
        var request = $.ajax({
            type: "POST",
            url: "./entradaJsonArticulos.php",
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData($("#form")[0]),
            success: function(respuestaDelServer,estado) {
                var objetoDato = JSON.parse(respuestaDelServer);
                console.log(objetoDato);
                PopUpMostrarMensaje(objetoDato.respuesta_estado, objetoDato.success);
                if(objetoDato.success){
                    limpiarForm();
                    CerrarVentanaModalArticulos();
                    LlenarTabla(false);
                }
            }//cierra funcion asignada al success
        });//cierra ajax
    }
}

function ModificarArticulo(){
    var confirmaModi = confirm("Esta seguro que deseea modificar el articulo ?");
    if (confirmaModi)
    {
        var request = $.ajax({
            type: "POST",
            url: "./Modi.php",
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData($("#form")[0]),
            success: function(respuestaDelServer,estado) {
                var objetoDato = JSON.parse(respuestaDelServer);
                console.log(objetoDato);
                PopUpMostrarMensaje(objetoDato.respuesta_estado, objetoDato.success);
                if(objetoDato.success){
                    limpiarForm();
                    CerrarVentanaModalArticulos();
                    LlenarTabla(false);
                }
            }//cierra funcion asignada al success
        });//cierra ajax
    }
}

function CargarPDF(art){
    var request = $.ajax({
        type: "GET",
        url: "./VerPDF.php",
        data: {codArticulo: art},
        success: function(respuestaDelServer,estado) {
            var objetoDato = JSON.parse(respuestaDelServer);
            console.log(objetoDato);
            $("#ContainerPDF").html("<iframe id='iframePDF' width='100%' height='100%' src='data:application/pdf;base64,"+objetoDato.documentoPDF+"'></iframe>");
            PopUpMostrarMensaje(objetoDato.respuesta_estado, objetoDato.success);
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
    document.getElementById("formPDF").value = "";
    checkValForm();
}

function ElminarArticulo(art){
    var confirmaEliminar = confirm("Esta seguro que deseea eliminar el articulo: " + art + " ?");
    if (confirmaEliminar)
    {
        var request = $.ajax({
            type: "GET",
            url: "./Eliminar.php",
            data: {codArticulo: art},
            success: function(respuestaDelServer,estado) {
                var objetoDato = JSON.parse(respuestaDelServer);
                console.log(objetoDato);
                PopUpMostrarMensaje(objetoDato.respuesta_estado, objetoDato.success);
                LlenarTabla(false);
            }//cierra funcion asignada al success
        });//cierra ajax
    }
}

function CargarVentanaModalConArt(art){
    document.querySelector("#codArticulo").value = art.querySelector('[campo-dato^="codigo"]').innerHTML;
    document.querySelector("#codArticuloOriginal").value = art.querySelector('[campo-dato^="codigo"]').innerHTML;
    document.querySelector("#cat").value = art.querySelector('[campo-dato^="cat"]').innerHTML
    document.querySelector("#valor").value = art.querySelector('[campo-dato^="valor"]').innerHTML
    document.querySelector("#desc").value = art.querySelector('[campo-dato^="descripcion"]').innerHTML
    document.querySelector("#fechaAlta").value = art.querySelector('[campo-dato^="fechaAlta"]').innerHTML
    document.querySelector("#stock").value = art.querySelector('[campo-dato^="saldo"]').innerHTML
}

function PopUpMostrarMensaje(mensaje, opcion)
{
    document.querySelector("#PopUpInfoBody").innerHTML = mensaje;
    configurarTipoPopUp(opcion);
    document.querySelector("#PopUpInfo").setAttribute("class","PopUpInfoEnabled");
    setTimeout(function(){
        document.querySelector("#PopUpInfo").setAttribute("class","PopUpInfoDisabled");
    }, 4000);
    
}

function configurarTipoPopUp(opcion)
{
    switch (opcion)
    {
        case true :
            $('#PopUpInfo').attr("type","PopUpInfoGreen");
            break;
        case false :
            $('#PopUpInfo').attr("type","PopUpInfoRed");
            break;
    }
}


// Event Listener para botones de Modi, PDF y Delete
if (window.addEventListener) {
    document.addEventListener('click', function (e) {
      if (e.target.getAttribute("class") != null){
        if (e.target.getAttribute("class").indexOf("btCeldaModi") === 0) {
            CargarVentanaModalConArt(e.target.parentElement.parentElement);
            MostrarVentanaModalArticulos();
            document.getElementById("mwHeader").innerHTML = "<h4>Formulario para Modificación - Maestro de Artículos</h4>";
        }
        if (e.target.getAttribute("class").indexOf("btCeldaPDF") === 0) {
            CargarPDF(e.target.parentElement.parentElement.querySelector('[campo-dato^="codigo"]').innerHTML);
            MostrarVentanaModalPDF();
        }
        if (e.target.getAttribute("class").indexOf("btCeldaDelete") === 0) {
            ElminarArticulo(e.target.parentElement.parentElement.querySelector('[campo-dato^="codigo"]').innerHTML);
        }
      }
    });
}



//event listener para el formulario
document.getElementById('form').addEventListener('change', function() {
    checkValForm();
});

document.getElementById('form').addEventListener('keyup', function() {
    checkValForm ()
});

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