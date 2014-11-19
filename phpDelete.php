<?php
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
$consultaSql = "delete from producto where id=2;";
$res = $con->query( $consultaSql );
$cuenta = $res->rowCount();
$con = null;
header("Location: index.php?r=$cuenta");
