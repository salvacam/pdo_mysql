<?php
require '../require/comun.php';
$sesion->administrador("../usuario/");
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$filas = $modelo->getList();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Usuario</title>
        <script src="../js/main.js"></script>
    </head>
    <body>Seccion 1: Listado<br/>        
        <table border="1">  
            <tr>
                <th>Id</th>  
                <th>Tipo</th>
                <th>Estado</th>
                <th>Venta</th>  <!-- alquiler o venta -->
                <th>Precio</th>
                <th>Hab.</th>                
                <th>Baños</th>
                <th>Provincia</th>
                <th>Ciudad</th>
                <th>Direccion</th>
                <th>Email</th>
                <th>Tlf</th>
                <th>Hora</th>                
                <th>Activo</th>
                <th>Borrar</th>
                <th>Editar</th>                
            </tr>
            <?php
            foreach ($filas as $indice => $objeto) {
                ?>
                <tr>
                    <td><?php echo $objeto->getLogin(); ?></td>
                    <td><?php echo $objeto->getClave(); ?></td>
                    <td><?php echo $objeto->getNombre(); ?></td>
                    <td><?php echo $objeto->getApellidos(); ?></td>                    
                    <td><?php echo $objeto->getEmail(); ?></td>                    
                    <td><?php echo $objeto->getFechaalta(); ?></td>
                    <td><?php echo $objeto->getIsactivo(); ?></td>                    
                    <td><?php echo $objeto->getIsroot(); ?></td>
                    <td><?php echo $objeto->getRol(); ?></td>                    
                    <td><?php echo $objeto->getFechalogin(); ?></td>
                    <td><a data-id='<?php echo $objeto->getLogin(); ?>' 
                           data-nombre='<?php echo $objeto->getNombre() . " " . $objeto->getApellidos(); ?>' 
                           class='borrar' href='phpDelete.php?id=<?php echo $objeto->getLogin(); ?>'>borrar</a></td>
                    <td><a data-login='<?php echo $objeto->getLogin(); ?>'
                           href='viewEditar.php?login=<?php echo $objeto->getLogin(); ?>'>editar</a></td>
                </tr>
                <?php
            }
            ?>        
        </table>
        <br/>
        <a href="viewEditar.php">Insertar</a>
        <form action="" method="POST" id="formulario">
            <input type="hidden" name="id" value="" id="idformulario"/>
        </form>
    </body>
</html>
<?php
$bd->closeConexion();
?>