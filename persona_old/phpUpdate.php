<?php
require '../require/comun.php';

$id = Leer::post("id");
$nombre = Leer::post("nombre");
$apellidos = Leer::post("apellidos");

$bd = new BaseDatos();
if(!$bd->isConetado()){
    header("Location: index.php?op=update&r=-1");
    exit();
}

$modelo = new ModeloPersona($bd);
$persona = new Persona($id, $nombre, $apellidos);
$modelo->edit($persona);


/*
$consultaSql = "update persona set nombre=:nombre, apellidos=:apellidos where id=:id;";
$parametros["id"] = $id;
$parametros["nombre"] = $nombre;
$parametros["apellidos"] = $apellidos;

$r = $bd->setConsulta($consultaSql, $parametros);

$id = $bd->getAutonumerico();
$cuenta = $bd->getNumeroFilas();

$bd->closeConsulta();
*/

$id = $bd->getAutonumerico();
$cuenta = $bd->getNumeroFilas();
$bd->closeConexion();

header("Location: index.php?op=update&r=$id&cuenta=$cuenta");

