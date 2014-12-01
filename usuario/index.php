<?php
require '../require/comun.php';
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Usuario front-end</title>
    </head>

    <body>
        <?php
        if (Leer::get("op") == "alta") {
            echo "alta<br/>";
            var_dump($modelo->get(Leer::get("login")));
        }
        ?>
        <a href="viewalta.php">Alta Usuario</a>
        <a href="viewlogin.php">Login</a>
    </body>
</html>
