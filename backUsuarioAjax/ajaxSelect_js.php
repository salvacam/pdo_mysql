<?php

header('Content-Type: application/json');
require '../require/comun.php';
//if ($sesion->isAdministrador()) {
    $bd = new BaseDatos();
    $modelo = new ModeloUsuario($bd);
    $pagina = 0;
    if (Leer::get("pagina") != null) {
        $pagina = Leer::get("pagina");
    }
    $numero = $modelo->count();
    $paginas = ceil($numero[0] / 3) - 1;
    echo '{"paginasTotal":"'.$paginas.'","usuarios":'.$modelo->getListJSON($pagina) . "}";
    $bd->closeConexion();
//}