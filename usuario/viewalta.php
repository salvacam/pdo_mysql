<?php
require '../require/comun.php';
$error = Leer::get("error");
?>
<!DOCTYPE html>
<html> <head>
        <meta charset="UTF-8">
        <title>Alta Usuario</title>
        <!-- <script src="../js/alta.js"></script> -->
        <script src="../js/ajax.js"></script>
    </head>
    <body>
        <?php
        if ($error == -1) {
            echo "Error al crear el usuario";
        }
        ?>
        <form action="phpAlta.php" method="POST">            
            <label for="login">Login</label>                
            <input type="text" name="login" value="" id="login" required/>
            <span id="disponible"></span><br/>
            <label for="clave">Clave</label>
            <input type="password" name="clave" value="" id="clave" required/>            
            <label for="claveConfirmada">Confirmar clave</label>
            <input type="password" name="claveConfirmada" value="" id="claveConfirmada" required/>            
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" value="" id="nombre" required/>
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" value="" id="apellidos" required/>
            <label for="email">Email</label>
            <input type="email" name="email" value="" id="email" required/>               
            <!--comprobar por javascript los valores, que la clave coincida-->
            <input type="reset" value="limpiar"/>
            <input type="submit" value="Alta" id="alta" />
        </form>
    </body>
    <script>
        var login = document.getElementById("login");
        
        var verRespuesta = function(textoJson){
            //var json = JSON.parse(textoJson);
            //alert ("la respuesta es "+ json);
            alert(textoJson);
        }
        
        var ajax = new Ajax();
        ajax.setUrl("../usuario/phpcomprobar.php?login=" + encodeURIComponent(login.value));
        ajax.setRespuesta(verRespuesta);
        ajax.doPeticion();
        
        var disponible = document.getElementById("disponible");
        /*
        var alta = document.getElementById("alta");
        alta.disabled = true;
        
        login.addEventListener("blur", function() {
            disponible.textContent = "";
            var peticionAsincrona;
            if (window.XMLHttpRequest) {
                peticionAsincrona = new XMLHttpRequest();
                peticionAsincrona.open("GET", "../usuario/phpcomprobar.php?login=" + encodeURIComponent(login.value), true);
                peticionAsincrona.onreadystatechange = function() {
                    if (peticionAsincrona.readyState == 4) {
                        if (peticionAsincrona.status == 200) {
                            var respuesta = peticionAsincrona.responseText;
                            disponible.textContent = respuesta;
                            if (respuesta.indexOf("uso") >= 0)
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
        }); */
    </script>
</html>