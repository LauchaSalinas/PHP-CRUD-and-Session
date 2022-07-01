document.getElementById("btnSubmit").onclick = function() {
    var confirmaCrear = confirm("Esta seguro que desea crear la cuenta?");
    if(confirmaCrear) Login();
}

function Login(){
    var request = $.ajax({
        type: "POST",
        url: "./signup.php",
        processData: false,
        contentType: false,
        cache: false,
        data: new FormData($("#form")[0]),
        success: function(respuestaDelServer) {
            var objetoDato = JSON.parse(respuestaDelServer);
            console.log(objetoDato);
            if(objetoDato.success){
                document.getElementById("form").reset();
                document.getElementById("infoLogin").innerHTML = 
                    "\
                    <h1>Creación exitosa!</h1>"
                    + objetoDato.respuesta_estado + "</br>"
                    + "ID: "
                    + objetoDato.session_id + "</br>";
                document.getElementById("btnIngresoApp").removeAttribute("hidden");
                document.getElementById("btnCierraSesion").removeAttribute("hidden");
                document.getElementById("btnIngresoApp").style.visibility = "visible";
                document.getElementById("btnCierraSesion").style.visibility = "visible";
            }
            if(!objetoDato.success){
                document.getElementById("infoLogin").innerHTML =
                "\
                <h1>Error en la creación!</h1>"
                + objetoDato.respuesta_estado +"\
                ";
                document.getElementById("btnIngresoApp").style.visibility = "hidden";
                document.getElementById("btnCierraSesion").style.visibility = "hidden";
            }
            //PopUpMostrarMensaje(objetoDato.respuesta_estado, objetoDato.success);
        }//cierra funcion asignada al success
    });//cierra ajax
}

document.querySelector("#password").addEventListener("keydown", function (e){
    if (e.code === 'Enter'){
        Login();
    }});

$(function() {
    setTimeout(function(){
        document.getElementById("background-image").className = "background-imageA";
    }
        ,1000
    )
    

});