<?php
require '../require/comun.php';
$error = Leer::get("error");
?>
<!DOCTYPE html>
<html> <head>
        <meta charset="UTF-8">
        <title>Login Usuario</title>
    </head>
    <body>
        <?php echo $error; ?>
        <form action="phplogin.php" method="POST">            
            <input type="text" name="login" value="" id="login" placeholder="login" required/>
            <input type="password" name="clave" value="" id="clave" placeholder="clave" required/>
            <input type="submit" value="Login" />
        </form>
    </body>
</html>