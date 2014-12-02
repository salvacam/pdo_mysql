<?php
require '../require/comun.php';
$login = Leer::post("login");
$clave = Leer::post("clave");
$claveConfirmada = Leer::post("claveConfirmada");
$nombre = Leer::post("nombre");
$apellidos = Leer::post("apellidos");
$email = Leer::post("email");
/*if(!Validar::isAltaUsuario($login, $clave, $claveconfirmada, $nombre, $apellidos, $correo)){
    header ("Location: viewalta.php");
    exit();
}*/
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$usuario = new Usuario($login, $clave, $nombre, $apellidos, $email);
$r = $modelo->add($usuario);
$bd->closeConexion();
if($r==1){
    $id = md5($email.Configuracion::PEZARANA.$login);
    $enlace = "Click aqui: <a href='".Entorno::getEnlaceCarpeta("phpconfirmar.php?id=$id")."'>Validar cuenta</a>";
    echo $enlace;    
    //$correo = Correo::enviarGmail(Configuracion::ORIGENGMAIL, $email, "alta en web", $enlace, Configuracion::CLAVEGMAIL);    
    /*$correo = Correo::enviarGmail(null, $email, "alta en web", $enlace, null);    
    if(!$correo){
        header ("Location: view.php");
        exit();    
    }*/
}
//header ("Location: viewalta.php");