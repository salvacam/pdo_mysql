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
    $fin = ceil($numero[0] / 3) - 1;       
    
    $arrayPaginas = array("0", ($pagina-2), ($pagina-1), ($pagina+1), ($pagina+2), $fin);
    $arrayTexto = "";
    for ($i = 0; $i < sizeof($arrayPaginas) ;$i++){
        $arrayTexto .= $arrayPaginas[$i].",";
    }
    $arrayTexto = substr($arrayTexto,0, -1);
    echo '{"paginas":['.$arrayTexto.'],"usuarios":'.$modelo->getListJSON($pagina).'}';
    $bd->closeConexion();
//}