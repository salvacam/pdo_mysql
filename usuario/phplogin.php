<?php
require '../require/comun.php';
$bd = new BaseDatos();
$login = Leer::post("login");
$clave = Leer::post("clave");
$usuario = new Usuario($login, $clave);
$modelo = new ModeloUsuario($bd);
$usuario = $modelo->get($login);
if($usuario->getClave() == $clave){
    //crear sesion
    
    header("Location: index.php?op=login&r=1");
} else {
    header("Location: index.php?op=login&r=-1");
}    
$bd->closeConexion();