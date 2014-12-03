<?php
require '../require/comun.php';
$error = Leer::get("error");
?>
<!DOCTYPE html>
<html> <head>
        <meta charset="UTF-8">
        <title>Alta Usuario</title>
    </head>
    <body>
        <?php 
            if ($error == -1){
                echo "Error al crear el usuario";
            }
        ?>
        <form action="phpAlta.php" method="POST">            
            <label for="login">Login</label>                
            <input type="text" name="login" value="" id="login" required/>
            <label for="clave">Clave</label>
            <input type="password" name="clave" value="" id="clave" required/>            
            <label for="claveConfirmada">Confirmar clave</label>
            <input type="password" name="claveConfirmada" value="" id="claveConfirmada" required/>            
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" value="" id="nombre" required/>
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" value="" id="apellidos" required/>
            <label for="email">Email</label>
            <input type="email" name="email" value="" id="email" required/>               
            <!--comprobar por javascript los valores, que la clave coincida-->
            <input type="reset" value="limpiar"/>
            <input type="submit" value="Alta" />
        </form>
    </body>
</html>