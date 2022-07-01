document.getElementById("btnSubmit").onclick = function() {
    Login();
}

function Login(){
    var request = $.ajax({
        type: "POST",
        url: "./ingresoAlSistema.php",
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
                    <h1>Login exitoso!</h1>"
                    + objetoDato.respuesta_estado + "</br>"
                    + "ID: "
                    + objetoDato.session_id + "</br>";
                document.getElementById("btnIngresoApp").removeAttribute("hidden");
                document.getElementById("btnCierraSesion").removeAttribute("hidden");
                document.getElementById("btnSubmit").style.display = "none";
            }
            if(!objetoDato.success){
                document.getElementById("infoLogin").innerHTML =
                "\
                <h1>Error en el Login!</h1>"
                + objetoDato.respuesta_estado +"\
                ";
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
