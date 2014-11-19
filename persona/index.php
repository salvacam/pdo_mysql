<?php
require '../require/comun.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Persona</title>
        <script src="../js/main.js"></script>
    </head>
    <body>
        <?php
        echo "Seccion 0: Operacion<br/>";
        if (Leer::get("op") != null) {
            echo 'operacion: ' . Leer::get("op") . "<br/>";
            $resultado = "error";
            if (Leer::get("cuenta") == 1) {
                $resultado = "ok";
            }
            echo "resultado: " . $resultado . "<br/>";
            echo "id: " . Leer::get("r") . "<br/>";
        }

        echo "<br/>Seccion 1: Listado<br/>";
        $bd = new BaseDatos();

        if ($bd->isConetado()) {
            $modelo = new ModeloPersona($bd);
            $persona = $modelo->getList();
            foreach ($persona as $valor) {
                echo $valor->getId() . ' ';
                echo "<a data-id='" . $valor->getId() . "' class='editar' href=''>" .
                $valor->getNombre() . " " . $valor->getApellidos() .
                "</a> ";
                echo "<a data-id='" . $valor->getId() . "' data-nombre='" .
                $valor->getNombre() . " " . $valor->getApellidos() .
                "' class='borrar' href=''>borrar</a><br/>";
            }
            /*
              $consultaSql = "select * from persona";
              $bd->setConsulta($consultaSql);
              echo "Hay " . $bd->getNumeroFilas() . " personas.<br/>";
              while ($fila = $bd->getFila()) {
              echo $fila[0] . " ";
              echo "<a data-id='$fila[0]' class='editar' href=''>". $fila[1] . " " . $fila[2]. "</a> ";
              echo "<a data-id='$fila[0]' data-nombre='$fila[1] $fila[2]' class='borrar' href=''>borrar</a><br/>";
              //echo "<a data-nombre='$fila[1] $fila[2]' class='borrar' href='phpDelete.php?id=$fila[0]'>borrar</a><br/>";
              }
              $bd->closeConsulta(); */
            $bd->closeConexion();
        }
        ?>        
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
        <!--
        Sección 3: Formulario borrar<br/>
        <form action="phpDelete.php" method="GET">
            <label for="id">Id</label>
            <input type="text" name="id" value="" id="id" placeholder="id" required/>
            <input type="submit" value="Borrar" />
        </form>
        -->
        <form action="" method="POST" id="formulario">
            <input type="hidden" name="id" value="" id="idformulario"/>
        </form>
    </body>
</html>
