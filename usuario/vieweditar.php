<?php
require '../require/comun.php';
$sesion->autentificado("viewlogin.php");
$usuario = $sesion->getUsuario();
?>
<!DOCTYPE html>
<html> <head>
        <meta charset="UTF-8">
        <title>Editar Usuario</title>
        <script src="../js/editarUsuario.js"></script>
    </head>
    <body>
        <form action="phpEditar.php" method="POST">            
            <label for="login">Login</label>                
            <input type="text" name="login" value="<?php echo $usuario->getLogin() ?>" id="login" required/>
            <label for="clave">Clave</label>
            <input type="password" name="clave" value="" id="clave" />            
            <label for="claveNueva">Clave Nueva</label>
            <input type="password" name="claveNueva" value="" id="claveNueva"/>            
            <label for="claveConfirmada">Confirmar Clave Nueva</label>
            <input type="password" name="claveConfirmada" value="" id="claveConfirmada"/>            
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" value="<?php echo $usuario->getNombre() ?>" id="nombre" required/>
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" value="<?php echo $usuario->getApellidos() ?>" id="apellidos" required/>
            <label for="email">Email</label>
            <input type="email" name="email" value="<?php echo $usuario->getEmail() ?>" id="email" required/>               
            <!--comprobar por javascript los valores, que la clave coincida-->
            <input type="submit" id="modificar" value="Modificar" />
        </form>
    </body>
</html>
