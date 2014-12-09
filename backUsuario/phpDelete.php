<?php
require '../require/comun.php';
$sesion->administrador("../usuario/");
$bd = new BaseDatos();
$id = Leer::request("id");
$modelo = new ModeloUsuario($bd);
//$r = $modelo->deletePorId($id);
$r = $modelo->deletePorId("af");
$bd->closeConexion();
header("Location: index.php?op=delete&r=$r");