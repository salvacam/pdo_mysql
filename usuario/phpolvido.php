<?php

require '../require/comun.php';
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);

$email = Leer::post("email");
$login = Leer::post("login");

if ($login != "") {
    $usuario = $modelo->get($login);
    if ($usuario != null) {
        $email = $usuario->getEmail();
        $id = md5($login . Configuracion::PEZARANA . $email);
        $enlace = "Click aqui: <a href='" . Entorno::getEnlaceCarpeta("viewrecupera.php?id=$id&login=$login") . "'>Cambiar contraseña</a>";
        /* $correo = Correo::enviarGmail(Configuracion::ORIGENGMAIL, $email, "recuperacion clave", $enlace, Configuracion::CLAVEGMAIL);
          if (!$correo) {
          header("Location: index.php");
          exit();
          } */
        echo $enlace;
        exit();
    }
}

if ($email != "") {
    $parametros["email"] = $email;
    $filas = $modelo->getList("email=:email", $parametros);
    $mensaje = "";
    foreach ($filas as $indice => $objeto) {
        $login = $objeto->getLogin();
        $email = $objeto->getEmail();
        $id = md5($login . Configuracion::PEZARANA . $email);
        $mensaje .= "Usuario: $login . Click aqui: <a href='" . Entorno::getEnlaceCarpeta("viewrecupera.php?id=$id&login=$login") . "'>Cambiar contraseña</a><br/>";
    }
    /* $correo = Correo::enviarGmail(Configuracion::ORIGENGMAIL, $email, "recuperacion clave", $mensaje, Configuracion::CLAVEGMAIL);
      if (!$correo) {
      header("Location: index.php");
      exit();
      } */
    echo $mensaje;
    exit();
}
$bd->closeConexion();
//header("Location: index.php");