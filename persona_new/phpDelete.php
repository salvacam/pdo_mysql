<?php
require '../require/comun.php';
$bd = new BaseDatos();
$id = Leer::request("id");
$modelo = new ModeloPersona($bd);
//$persona = new Persona($id);
//$r = $modelo->delete($persona);
$r = $modelo->deletePorId($id);
$bd->closeConexion();
header("Location: index.php?op=delete&r=$r");