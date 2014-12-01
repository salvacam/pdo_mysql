<?php
require '../require/comun.php';
$pagina=0;
if(Leer::get("pagina")!= null){
    $pagina = Leer::get("pagina");
}
$bd = new BaseDatos();
$modelo = new ModeloPersona($bd);
$filas = $modelo->getList($pagina);
$paginas= $modelo->getNumeroPaginas();
$enlaces = Util::getEnlacesPaginacion($pagina, $paginas);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Persona</title>
        <script src="../js/main.js"></script>
    </head>
    <body>Seccion 1: Listado<br/>        
        <table border="1">
        <?php
        foreach ($filas as $indice => $objeto) {
        ?>
            <tr>
                <td><?php echo $objeto->getApellidos(); ?></td>
                <td><?php echo $objeto->getNombre(); ?></td>
                <td><?php echo $objeto->getId(); ?></td>
                <td><a data-id='<?php echo $objeto->getId();?>' 
                       data-nombre='<?php echo $objeto->getNombre(). " ". $objeto->getApellidos();?>' 
                       class='borrar' href='phpDelete.php?id=<?php echo $objeto->getId();?>'>borrar</a></td>
                <td><a class='editar' data-id='<?php echo $objeto->getId();?>'
                       href='phpUpdate.php?id=<?php echo $objeto->getId();?>'>editar</a></td>
            </tr>
        <?php
        }        
        ?>        
            <tr>
                <td colspan="5">                    
                    <?php echo $enlaces["inicio"]; ?>
                    <?php echo $enlaces["anterior"]; ?>
                    <?php echo $enlaces["primero"]; ?>
                    <?php echo $enlaces["segundo"]; ?>
                    <?php echo $enlaces["actual"]; ?>
                    <?php echo $enlaces["cuarto"]; ?>
                    <?php echo $enlaces["quinto"]; ?>
                    <?php echo $enlaces["siguiente"]; ?>
                    <?php echo $enlaces["ultimo"]; ?>
                </td>
            </tr>
        </table>
        <br/>
        Sección 2: Formulario insertar<br/>
        <form action="phpInsert.php" method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" value="" id="nombre" placeholder="nombre" required/>
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" value="" id="apellidos" placeholder="apellidos" required/>
            <input type="submit" value="Alta" />
        </form>
        <br/>
        <form action="" method="POST" id="formulario">
            <input type="hidden" name="id" value="" id="idformulario"/>
        </form>
    </body>
</html>
<?php
$bd->closeConexion();