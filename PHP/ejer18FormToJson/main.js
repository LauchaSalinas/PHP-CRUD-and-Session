var form = document.getElementById("form");

$("#btnSubmit").click (function(){
    //if(form.checkValidity())
    //{
        $.ajax({
            type: "POST",
            url: "./respuesta.php",
            data: {
                ID_Usuario: $("#ID_Usuario").val(), 
                Login: $("#Login").val(),
                Nombre: $("#Nombre").val(),
                Apellido: $("#Apellido").val(),
                Fecha_Nac: $("#Fecha_Nac").val()
            },
            success: function(respuestaDelServer, estado){
                $('#divResultado').html("<h4>Resultado de la transformación a JSON en el servidor:</h4><h4>" + respuestaDelServer + "</h4>");
            }

        });//cierra ajax
    //}
});

$("#btnCloseWindow").onmouseleave = function(){
    btnClose.innerHTML = "";
}

// Limpia el formulario al cerrar la ventana modal
$("#btnCloseWindow").onclick = function(){
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

// Esconde vent. modal y activa container
$('#btnCloseWindow').click(function(){
    $('#container').attr("class","activeContainer");
    $('#modalWindow').attr("class","modalWindowDisabled");
});