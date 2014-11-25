<?php
require '../require/comun.php';
$bd = new BaseDatos();
$login = Leer::request("login");
$modelo = new ModeloUsuario($bd);
$usuario = $modelo->get($login);
$bd->closeConexion();
?>
<!DOCTYPE html>
<html> <head>
        <meta charset="UTF-8">
        <title>Insertar / Editar</title>
        <script src="../js/main.js"></script>
    </head>
    <body>
        <form action="<?php echo(isset($login) ? "phpUpdate.php" :  "phpInsert.php"); ?>" method="POST">            
            <input type="hidden" name="loginpk" id="loginpk" value="<?php echo $usuario->getLogin(); ?>"/>
            <input type="text" name="login" value="<?php echo $usuario->getLogin() ?>" id="login" placeholder="login" required/>
            <input type="password" name="clave" value="<?php echo $usuario->getClave() ?>" id="clave" placeholder="clave" required/>
            <input type="text" name="nombre" value="<?php echo $usuario->getNombre() ?>" id="nombre" placeholder="nombre" required/>
            <input type="text" name="apellidos" value="<?php echo $usuario->getApellidos() ?>" id="apellidos" placeholder="apellidos" required/>
            <input type="email" name="email" value="<?php echo $usuario->getEmail() ?>" id="email" placeholder="email" required/>            
            <!--<input type="hidden" name="isactivo" value="0" id="isactivo" />-->
            <br/><input type="checkbox" name="isactivo" id="isactivo" 
                <?php if ($usuario->getIsactivo()) echo "checked"; ?> />
            <label for="isactivo">Activo</label>
            <!--<input type="hidden" name="isroot" value="0" id="isroot" />-->            
            <input type="checkbox" name="isroot" id="isroot"
                <?php if ($usuario->getIsactivo()) echo "checked"; ?> />
            <label for="isroot">Root</label>
            <select name="rol" id="rol">
                <option id="usuario" value="usuario" selected="">Usuario</option>
                <option id="aministrador" value="administrador">Administrador</option>
            </select>
            <!--<input type="hidden" name="rol" value="usuario" id="rol" />-->
            <input type="submit" value="<?php echo(isset($login) ? "Editar" :  "Alta"); ?>" />
        </form>
    </body>
</html>