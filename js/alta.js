window.addEventListener("load", function() {
    var login = document.getElementById("login");
    var disponible = document.getElementById("disponible");

    var alta = document.getElementById("alta");
    alta.disabled = true;

    login.addEventListener("blur", function() {
        disponible.textContent = "";
        var peticionAsincrona;
        if (window.XMLHttpRequest) {
            peticionAsincrona = new XMLHttpRequest();
            peticionAsincrona.open("GET", "../usuario/phpcomprobar.php?login="+encodeURIComponent(login.value), true);
            peticionAsincrona.onreadystatechange = function() {
                if (peticionAsincrona.readyState == 4) {
                    if (peticionAsincrona.status == 200) {
                        var respuesta = peticionAsincrona.responseText;
                        disponible.textContent = respuesta;
                        if(respuesta.indexOf("uso")>=0)
                            alta.disabled = true;
                        else 
                            alta.disabled = false;
                    }
                    else {
                        //alert("error: " + peticionAsincrona.responseText);
                    }
                }
            }
            peticionAsincrona.send();
        }
    });
});

