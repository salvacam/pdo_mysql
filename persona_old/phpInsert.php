
<?php
require '../require/comun.php';

$bd = new BaseDatos();
if(!$bd->isConetado()){
    header("Location: index.php?op=insert&r=-1");
    exit();
}

$nombre = Leer::post("nombre");
$apellidos = Leer::post("apellidos");

$persona = new Persona(null, $nombre, $apellidos);
$modelo = new ModeloPersona($bd);
$r = $modelo->add($persona);
/*
$consultaSql = "insert into persona values (null, :nombre, :apellidos);";
$parametros["nombre"] = $nombre;
$parametros["apellidos"] = $apellidos;

$r = $bd->setConsulta($consultaSql, $parametros);
$id= $bd->getAutonumerico();
$cuenta = $bd->getNumeroFilas();
$bd->closeConsulta();
*/
$id= $bd->getAutonumerico();
$cuenta = $bd->getNumeroFilas();
 
$bd->closeConexion();
header("Location: index.php?op=insert&r=$id&cuenta=$cuenta");