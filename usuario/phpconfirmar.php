<?php
require '../require/comun.php';
$bd = new BaseDatos();
$login = Leer::request("login");
$modelo = new ModeloUsuario($bd);
$r = $modelo->alta($login);
    $resultado = "usuario NO activado";
if($r > -1){
    $resultado = "usuario activado";
} 
$bd->closeConexion();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            echo $resultado;
        ?>
        <a href="index.php">Inicio</a>
    </body>
</html>
