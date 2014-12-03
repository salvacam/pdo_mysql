<?php
require '../require/comun.php';
$sesion->administrador("../usuario/");
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

$usuario = new Usuario($login, $clave, $nombre, $apellidos, $email, null, $isactivo, $isroot, $rol, null);
/*echo $usuario->getLogin() ." - " . $usuario->getClave() ." - ".
        $usuario->getNombre() ." - ".$usuario->getApellidos() ." - ".        
        $usuario->getEmail() ." - ".$usuario->getFechaalta() ." - ".        
        $usuario->getIsactivo() ." - ".$usuario->getIsroot() ." - ".        
        $usuario->getRol() ." - ".$usuario->getFechalogin(). "<br/>";
echo "<br/>";
  */     
$modelo = new ModeloUsuario($bd);
$r = $modelo->add($usuario); 
$bd->closeConexion();
//header("Location: index.php?op=insert&r=$r");