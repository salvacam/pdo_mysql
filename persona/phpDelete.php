<?php
require '../require/comun.php';

$bd = new BaseDatos();
if(!$bd->isConetado()){
    header("Location: index.php?op=delete&r=-1");
    exit();
}

$id = Leer::request("id");

$persona = new Persona($id);
$modelo = new ModeloPersona($bd);
$r = $modelo->delete($persona);
//$r = $modelo->deletePorId($id);

/*
$consultaSql = "delete from persona where id=:id;";
$parametros["id"] = $id;

$r = $bd->setConsulta($consultaSql, $parametros);
$cuenta = $bd->getNumeroFilas();

$bd->closeConsulta();
*/
$cuenta = $bd->getNumeroFilas();

$bd->closeConexion();

header("Location: index.php?op=delete&r=$id&cuenta=$cuenta");
