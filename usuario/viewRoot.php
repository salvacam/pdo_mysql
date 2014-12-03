<?php
require '../require/comun.php';
$sesion->administrador("viewlogin.php");
$u = $sesion->getUsuario();
var_dump($u);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Solo para el root</h1>
    </body>
</html>
