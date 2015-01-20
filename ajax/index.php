<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <input type="button" value="ajax" id="btajax" />
    </body>
    <script>
        var bt = document.getElementById("btajax");
        bt.addEventListener("click", function() {
            var peticionAsincrona;
            if (window.XMLHttpRequest) {
                peticionAsincrona = new XMLHttpRequest();
                peticionAsincrona.open("GET", "ajax.php", true);
                peticionAsincrona.onreadystatechange = function() {
                    if (peticionAsincrona.readyState == 4) {
                        if (peticionAsincrona.status == 200) {
                            var respuesta = peticionAsincrona.responseText;
                            alert(respuesta);
                        }
                        else {
                            alert("error: " + peticionAsincrona.responseText);
                        }
                    }
                }
                peticionAsincrona.send();
            }
        }, false);
    </script>
</html>
