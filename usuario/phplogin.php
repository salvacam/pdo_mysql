<?php
require '../require/comun.php';
$login = Leer::post("login");
$clave = Leer::post("clave");
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$usuario = $modelo->login($login, $clave);
$bd->closeConexion();
if($usuario == false ){
    $sesion->cerrar();
    header("Location:viewlogin.php?error=Login incorrecto o usuario inactivo");
} else {
    $sesion->setUsuario($usuario);
    header("Location:viewprivado.php");
}