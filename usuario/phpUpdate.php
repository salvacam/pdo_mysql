<?php
require '../require/comun.php';
$bd = new BaseDatos();

$login = Leer::post("login");
$clave = Leer::post("clave");
$nombre = Leer::post("nombre");
$apellidos = Leer::post("apellidos");
$email = Leer::post("email");
$isactivo = 0;
if(isset($_POST["isactivo"])){    
    $isactivo = 1;
}
$isroot = 0;
if(isset($_POST["isroot"])){    
    $isroot = 1;
}
$rol = Leer::post("rol");

$loginpk = Leer::post("loginpk");

$usuario = new Usuario($login, $clave, $nombre, $apellidos, $email, null, $isactivo, $isroot, $rol, null);
$modelo = new ModeloUsuario($bd);
$r = $modelo->editPK($usuario, $loginpk); 
$bd->closeConexion();
header("Location: index.php?op=insert&r=$r");