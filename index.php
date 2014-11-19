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
        try {
            $con = new PDO(
                'mysql:host=' . $servidor . ';dbname=' . $baseDatos, 
                $usuario, 
                $clave, 
                array(
                    PDO::ATTR_PERSISTENT => true,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8')
            );
        } catch (PDOException $e) {
            echo "sin conexión" ."<br/>";
            exit();
        }
        echo "conectado <br/>";
        
        $consultaSql = "select * from producto";
        $res = $con->query($consultaSql);
        echo "registros ". $res->rowCount()."<br/>";
        while( $fila = $res->fetch() ) {
            echo $fila[0]." ";
            echo $fila[1]." ";
            echo $fila[2] . "<br/>";
            /*echo $fila["id"]." ";
            echo $fila["nombre"]." ";
            echo $fila["precio"] . "<br/>";
         foreach ($fila as $key => $value) {
                echo $key."<br/>";
            }*/
        }
        $res->closeCursor();
        $con= null;
        ?>
        <br/>
        <form action="phpInsert.php" method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" value="" id="nombre" placeholder="nombre" required/>
            <label for="precio">Precio</label>
            <input id="precio" name="precio" placeholder="precio" type="number" value="" required/>
            <input type="submit" value="insertar" />
        </form>
    </body>
</html>
