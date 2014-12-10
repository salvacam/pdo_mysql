<?php
require '../require/comun.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Recuperar contraseña o login</title>
    </head>
    <body>
        <form action="phpolvido.php" method="POST">            
            <input type="text" name="login" value="" id="login" placeholder="login"/>
            o
            <input type="email" name="email" value="" id="email" placeholder="email"/>
            <input type="submit" value="Recuperar" />
        </form>
    </body>
</html>
