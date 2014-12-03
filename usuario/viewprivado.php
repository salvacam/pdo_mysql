<?php
require '../require/comun.php';
$sesion->autentificado("viewlogin.php");
$u = $sesion->getUsuario();
var_dump($u);
echo Leer::get("r");
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Privado</h1>
        <a href="vieweditar.php">Editar cuenta</a>
    </body>
</html>
