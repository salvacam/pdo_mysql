<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <input type="button" value="ajax" id="btajax" />
        <div id="mostrar"></div>
    </body>
    <script>
        var bt = document.getElementById("btajax");
        bt.addEventListener("click", function() {
            var peticionAsincrona;
            if (window.XMLHttpRequest) {
                peticionAsincrona = new XMLHttpRequest();
                peticionAsincrona.open("GET", "tabla.php", true);
                peticionAsincrona.onreadystatechange = function() {
                    if (peticionAsincrona.readyState == 4) {
                        if (peticionAsincrona.status == 200) {
                            document.getElementById("mostrar").innerHTML= "";
                            var ojson = JSON.parse(peticionAsincrona.responseText);
                            var tabla = document.createElement("table");
                            tabla.setAttribute("border","1");
                            for (var i = 0; i < ojson.tabla[0].fila; i++) {
                                var tr = document.createElement("tr");
                                for (var j = 0; j < ojson.tabla[0].columna; j++){
                                    var td = document.createElement("td");
                                    td.textContent = i+" - "+j;
                                    tr.appendChild(td);
                                }
                                tabla.appendChild(tr);
                            }
                            document.getElementById("mostrar").appendChild(tabla);
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
