<?php
require '../require/comun.php';
$bd = new BaseDatos();
$id = Leer::request("id");
$modelo = new ModeloPersona($bd);
$persona = $modelo->get($id);
$bd->closeConexion();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="phpUpdate.php" method="POST">
            <input type="hidden" name="id" id="id" value="<?php echo $id; ?>"/>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" value="<?php echo $persona->getNombre(); ?>" id="nombre" required/>
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" value="<?php echo $persona->getApellidos(); ?>" id="apellidos" required/>
            <input type="submit" value="Editar" />
        </form>
    </body>
</html>
