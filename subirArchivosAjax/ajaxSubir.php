<?php
header('Content-Type: text/plain');
if (isset($_FILES["archivo"])) {
    $numerodearchivos = $_POST["numerodearchivos"];
    $texto = $_POST["texto"];
    $errores = 0;
    $resultado = "bien";
    if ($_FILES["archivo"]["error"] > 0) {
        foreach ($_FILES["archivo"]["error"] as $indice => $valor) {
            if ($valor == UPLOAD_ERR_OK) {
                $tmp = $_FILES["archivo"]["tmp_name"][$indice];
                $name = $_FILES["archivo"]["name"][$indice];
                move_uploaded_file($tmp, "ArchivosSubidos/".$name);
            } else {                
                $errores ++;
                $resultado ="error al subir $errores archivo(s)";
            }
        }
    } else {
        $resultado ="no se sube nada";
    }
    echo $resultado." - ". $texto; //hay que controlar si hay errores o no
}