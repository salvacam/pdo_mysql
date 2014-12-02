<?php

require '../require/comun.php';
$id = Leer::get("id");
//echo $id."<br/>";
//echo 'md5($email.Configuracion::PEZARANA.$login)';
/*
 * select * from usuario where md5(concat(email,"pez araña",login))="e64c6120e5006a2eb0e571eaf67da0f2";
 * update usuario set isactivo = 1 where md5(concat(email,"pez araña",login))="e64c6120e5006a2eb0e571eaf67da0f2";
 */
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$r = $modelo->activa($id);
if ($r == 1) {
    header("Location:viewconfirmado.php");
} else {    
    header("Location:viewerror.php");
}
