<?php
require '../require/comun.php';
$bd = new BaseDatos();
$nombre = Leer::post("nombre");
$apellidos = Leer::post("apellidos");
$persona = new Persona(null, $nombre, $apellidos);
$modelo = new ModeloPersona($bd);
$r = $modelo->add($persona); 
$bd->closeConexion();
header("Location: index.php?op=insert&r=$r");