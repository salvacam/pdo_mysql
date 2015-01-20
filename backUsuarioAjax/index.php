<?php
require '../require/comun.php';
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>Back-end usuarios con Ajax</title>
        <script src="./js/ajax.js"></script>
        <script src="./js/codigo.js"></script>
        <link rel="stylesheet" href="./css/estilo.css">
    </head>

    <body>
        <h1>ajax</h1>
        <h3>
            <?php
            $usuario = new Usuario("pepe", "clave", "pepe", "PEP", "pel@le.es", "2014-09-12", 1, 0, "usuario");
            //echo "[".$usuario->getJSON().",".$usuario->getJSON()."]";
            ?>

        </h3>
        <div id="mostrar">
        </div>
    </body>

</html>
