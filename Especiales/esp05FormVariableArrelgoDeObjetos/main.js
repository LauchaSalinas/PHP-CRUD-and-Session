var selectCat = document.getElementById("cat");
var newOpt;
var cats;

//lo hice de esta forma porque queria mantener el archivo en formato json, en vez de una string textual de json, espero se tome como valido
// $.getJSON("../cats.json", function (json) {
//     cats = json;
// })

cats = JSON.parse(catsJSON);


var form = document.getElementById("form");
form.target = "_blank";
form.method = "GET";
form.action = './respuestaFormulario.html';
var btnEnviar = document.getElementById("btnSubmit");

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