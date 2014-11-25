<?php
require '../require/comun.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $id = Leer::request("id");
        $bd = new BaseDatos();
        
        //$consultaSql = "select * from persona where id=:id;";
        //$param["id"] = $id;
        
        if ($bd->isConetado()) {
            $modelo = new ModeloPersona($bd);
            $persona = $modelo->get($id);
            $nombre = $persona->getNombre();
            $apellidos = $persona->getApellidos();        
        }        
        //$bd->setConsulta($consultaSql, $param);
        //$fila = $bd->getFila();        
        //$nombre = $fila[1];
        //$apellidos = $fila[2];
        //$bd->closeConsulta();
        
        $bd->closeConexion();
        ?>
        <form action="phpUpdate.php" method="POST">
            <input type="hidden" name="id" id="id" value="<?php echo $id; ?>"/>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" value="<?php echo $nombre; ?>" id="nombre" required/>
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" value="<?php echo $apellidos; ?>" id="apellidos" required/>
            <input type="submit" value="Editar" />
        </form>
    </body>
</html>