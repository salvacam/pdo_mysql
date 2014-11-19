<?php

function autoload($clase) {
    if (file_exists('clases/' . $clase . '.php')) {
        require 'clases/' . $clase . '.php';
    } else {
        require '../clases/' . $clase . '.php';
    }
}

spl_autoload_register('autoload');
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $servidor = 'localhost';
        $baseDatos = 'bdphp';
        $usuario = 'userphp';
        $clave = 'clavephp';
        $conexion = new BaseDatos($servidor, $baseDatos, $usuario, $clave);
        if ($conexion->isConetado()) {
            echo "conectado <br/>";
        } else {
            echo "sin conexión" . "<br/>";
        }

        echo "*********** Autonumerico ********<br/>";
        echo "getAutonumerico: " . $conexion->getAutonumerico() . "<br/>";

        echo "*********** setBaseDatos ********<br/>";
        echo "base de datos: " . $conexion->getBaseDatos() . "<br/>";
        $conexion->setBaseDatos("nueva");
        echo "base de datos: " . $conexion->getBaseDatos() . "<br/>";
        echo ($conexion->isConetado() ? "conectado <br/>" : "sin conexión" . "<br/>");

        $conexion->setBaseDatos("bdphp");
        echo ($conexion->isConetado() ? "conectado <br/>" : "sin conexión" . "<br/>");

        echo "**********ConsultaSQL*********<br/>";
        $conexion->setConsultaSql('select * from producto;');
        echo "nº filas: " . $conexion->getNumeroFilas() . "<br/><br/>";
        while ($fila = $conexion->getFila()) {
            echo $fila[0] . " ";
            echo $fila[1] . " ";
            echo $fila[2] . "<br/>";
        }

        echo "**********ConsultaPreparada*********<br/>";
        $consultaSql = "insert into producto values (null, ?, ?);";
        $param = ["hola", 34];
        $conexion->setConsultaPreparada($consultaSql, $param);

        echo "getAutonumerico: " . $conexion->getAutonumerico() . "<br/>";

        $conexion->setConsultaPreparada('select * from producto;', null);
        echo "nº filas: " . $conexion->getNumeroFilas() . "<br/><br/>";
        while ($fila = $conexion->getFila()) {
            echo $fila[0] . " ";
            echo $fila[1] . " ";
            echo $fila[2] . "<br/>";
        }

        echo "**********Consulta*********<br/>";
        $consultaSql = "insert into producto values (null, :nombre, :precio);";
        $param = array(
            "nombre" => "adios",
            "precio" => 43);
        $conexion->setConsulta($consultaSql, $param);

        echo "getAutonumerico: " . $conexion->getAutonumerico() . "<br/>";

        $conexion->setConsultaPreparada('select * from producto;', null);
        echo "nº filas: " . $conexion->getNumeroFilas() . "<br/><br/>";
        while ($fila = $conexion->getFila()) {
            echo $fila[0] . " ";
            echo $fila[1] . " ";
            echo $fila[2] . "<br/>";
        }

        echo "**********Transacciones*********<br/>";
        $conexion->setTransaccion();

        $sql = "update producto set precio = precio * 1.1";
        $conexion->setConsultaSql($sql);
        $sql = "delete from producto where id=12;";
        $conexion->setConsultaSql($sql);

        //probar transaccion();
        //$sen
       
        //$conexion->transaccion($sentencias, $param);

        $conexion->setConsulta('select * from producto;', null);
        echo "nº filas: " . $conexion->getNumeroFilas() . "<br/><br/>";
        while ($fila = $conexion->getFila()) {
            echo $fila[0] . " ";
            echo $fila[1] . " ";
            echo $fila[2] . "<br/>";
        }

        /*
        $conexion->validaTransaccion();
        echo "<br/><br/>Validar transaccion<br/>";
        */
        $conexion->anulaTransaccion();
        echo "<br/><br/>Anular transaccion<br/>";
        $conexion->setConsulta('select * from producto;', null);
        echo "nº filas: " . $conexion->getNumeroFilas() . "<br/><br/>";
        while ($fila = $conexion->getFila()) {
            echo $fila[0] . " ";
            echo $fila[1] . " ";
            echo $fila[2] . "<br/>";
        }

        $conexion->closeConexion();
        //echo "Cerrar conexion: " . $conexion->closeConexion() . "<br/>";
        ?>
    </body>
</html>
