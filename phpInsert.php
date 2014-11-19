<?php

function autoload($clase) {
    if (file_exists('clases/' . $clase . '.php')) {
        require 'clases/' . $clase . '.php';
    } else {
        require '../clases/' . $clase . '.php';
    }
}

spl_autoload_register('autoload');

$bd = new BaseDatos();
if(!$bd->isConetado()){
    header("Location: index.php?r=-1");
    exit();
}

/*
$servidor = 'localhost';
$baseDatos = 'bdphp';
$usuario = 'userphp';
$clave = 'clavephp';
try {
    $con = new PDO(
            'mysql:host=' . $servidor . ';dbname=' . $baseDatos, $usuario, $clave, array(
        PDO::ATTR_PERSISTENT => true,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8')
    );
} catch (PDOException $e) {
    header("Location: index.php?r=-1");
    exit();
}
*/
$nombre = Leer::post("nombre");
$precio = Leer::post("precio");

//echo $nombre ."<br/>";
//echo $precio ."<br/>";
/*
  $consultaSql = "insert into producto values(null, '$nombre',$precio);";
  //echo "<br/>".$consultaSql;
  $res = $con->query($consultaSql);

  //',1);delete from producto;insert into producto values(null,'hola
 */

/* * ********** Sentencias preparadas  ********************** */
/*
//$consultaSql = "insert into producto values (null, ?, ?);";
$consultaSql = "insert into producto values (null, :nombre, :precio);";
$res = $con->prepare($consultaSql);
//$res->bindValue(1, $nombre);
//$res->bindValue(2, $precio);
$res->bindValue("nombre", $nombre);
$res->bindValue("precio", $precio);
$res->execute();
$cuenta = $res->rowCount();
$id = $con->lastInsertId();
//echo $id;
$con = null;
*/

$consultaSql = "insert into producto values (null, :nombre, :precio);";
$parametros["nombre"] = $nombre;
$parametros["precio"] = $precio;

$bd->setConsulta($consultaSql, $parametros);
$id= $bd->getAutonumerico();
$cuenta = $bd->getNumeroFilas();

$bd->closeConexion();

header("Location: index.php?r=$cuenta&id=$id");
/*header("Location: index.php");
$consultaSql = "insert into producto values(null, 'mouse', 7.15);";
$res = $con->query( $consultaSql );
$consultaSql = "insert into producto values(null, 'teclado', 4.27);";
$res = $con->query( $consultaSql );*/