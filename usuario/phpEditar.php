<?php

require '../require/comun.php';
$sesion->autentificado("viewlogin.php");
$usuario = $sesion->getUsuario();
$login = Leer::post("login");
$clave = Leer::post("clave");
$claveNueva = Leer::post("claveNueva");
$claveConfirmada = Leer::post("claveConfirmada");
$nombre = Leer::post("nombre");
$apellidos = Leer::post("apellidos");
$email = Leer::post("email");
//validar php
/* if(!Validar::isAltaUsuario($login, $clave, $claveconfirmada, $nombre, $apellidos, $correo)){
  header ("Location: viewalta.php");
  exit();
  } */
$nuevoUsuario = new Usuario($login, $claveNueva, $nombre, $apellidos, $email);
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$cambioDeClave = strlen($claveNueva)> 0 && $claveNueva==$claveConfirmada ;
$cambioDeCorreo = $email!=$usuario->getEmail();
if($cambioDeClave){
    $r = $modelo->editConClave($nuevoUsuario, $usuario->getLogin(), $usuario->getClave());
} else {
    $r = $modelo->editSinClave($nuevoUsuario, $usuario->getLogin());
}
if($cambioDeCorreo && $r>0){
    $r = $modelo->desactivar($usuario->getLogin());//implementar
    $id = md5($email.Configuracion::PEZARANA.$login);    
    $enlace = "Click aqui: <a href='".Entorno::getEnlaceCarpeta("phpconfirmar.php?id=$id")."'>Validar cuenta</a>";       
    $correo = Correo::enviarGmail(Configuracion::ORIGENGMAIL, $email, "alta en web", $enlace, Configuracion::CLAVEGMAIL);  
    header("Location: phplogout.php");    
    exit();
}
$sesion->setUsuario($usuario);
$bd->closeConexion();
//header("Location:viewprivado.php?r=$r");       
