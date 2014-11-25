<?php
require '../require/comun.php';
$id = Leer::post("id");
$nombre = Leer::post("nombre");
$apellidos = Leer::post("apellidos");
$bd = new BaseDatos();
$modelo = new ModeloPersona($bd);
$persona = new Persona($id, $nombre, $apellidos);
$r = $modelo->edit($persona);
$bd->closeConexion();
header("Location: index.php?op=update&r=$r");
