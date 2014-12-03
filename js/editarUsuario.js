window.addEventListener("load", function() {
    var modificar = document.getElementById("modificar");
    var login = document.getElementById("login");
    var clave = document.getElementById("clave");
    var claveNueva = document.getElementById("claveNueva");
    var claveConfirmada = document.getElementById("claveConfirmada");
    var nombre = document.getElementById("nombre");
    var apellidos = document.getElementById("apellidos");
    var email = document.getElementById("email");
    modificar.addEventListener("click", validar);


    function validar() {
        var error = "";
        if (login.value.lenght < 1) {
            error += "el login debe existir\n";
        }
        if (claveNueva.value.lenght > 1 || claveConfirmada.value.lenght > 1) {
            if(clave.value < 1){                
                error += "si cambia la clave escribe la anterior\n";
            }
            if(claveNueva.value != claveConfirmada.value.lenght){
                error += "las nuevas claves no coinciden\n";                
            }
        }
        //nombre apellidos y email

    }

});



