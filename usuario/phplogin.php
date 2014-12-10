<?php
require '../require/comun.php';
$login = Leer::post("login");
$clave = Leer::post("clave");
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$usuario = $modelo->login($login, $clave);
if($usuario == false ){
    $sesion->cerrar();
    $bd->closeConexion();
    header("Location:viewlogin.php?error=Login incorrecto o usuario inactivo");
} else {
    $sesion->setUsuario($usuario);
    $modelo->fechalogin($usuario);
    $bd->closeConexion();
    header("Location:viewprivado.php");
}