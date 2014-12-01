<?php

class Validar {

    static function isCorreo($v) {
        return filter_var($v, FILTER_VALIDATE_EMAIL); //apartir de la 5.2.3 de php  
    }

    static function isEntero($v) {
        return filter_var($v, FILTER_VALIDATE_INT);
    }

    static function isNumero($v) {
        return filter_var($v, FILTER_VALIDATE_FLOAT);
    }

    static function isTelefono($v) {
        return self::isCondicion($v, '/^[6-9][0-9]{8}$/');
        // con una expresion regular 9 numeros que empiezan por 6, 7, 8 ó 9
    }

    static function isURL($v) {
        return filter_var($v, FILTER_VALIDATE_URL);
    }

    static function isIP($v) {
        return filter_var($v, FILTER_VALIDATE_IP);
    }

    static function isFecha($v) {
        //return self::isCondicion($v,'/^(0[1-9]|1[0-9]|2[0-9]|3[01])(.|-)(0[1-9]|1[012])(.|-)[0-9]{4}$/');        
        // con una expresion regular DD.MM.YYYY
        return self::isCondicion($v, '/^(0[1-9]|1[0-9]|2[0-9]|3[01])(.|-)(0[1-9]|1[012])(.|-)(19[5-9]|20[012])[0-9]$/');
        // con una expresion regular DD.MM.YYYY año desde 1950 hasta 2029
    }

    static function isDNI($v) {
        //if(self::isCondicion($v, '/^(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))$/')){        
       if(!self::isCondicion($v, '/^(\d{8})([-]?)([A-Z]{1})$/')){
            echo "numero <br/>";
            return false;            
        }
        $numeros= ["T", "R", "W", "A", "G", "M", "Y", "F", "P", "D", "X", 
		"B", "N", "J", "Z", "S", "Q", "V", "H", "L", "C", "K", "E"];	
        $letra = substr($v, -1, 1);
        $numero = substr($v, 0, 8);        
        return ($letra == $numeros[$numero%23]);
    }

    static function isCodigoPostal($v) {
        return self::isCondicion($v, '/^(((0[1-9]|5[0-2])|[1-4][0-9])|AD)[0-9]{3}$/');
        // con una expresion regular 
        //PP->01 - 52 , AD Andorra
        // 0 capital de provincia
        // 1-9 si no es de capital de provincia
        //01-99 distrito , localidad, municipio
    }

    static function isLongitudMinima($v, $l = 1) {
        if (strlen($v) >= $l) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    static function isLongitudMaxima($v, $l = 1) {
        if (strlen($v) <= $l) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    static function isLongitud($v, $lmin = 1, $lmax = -1) {
        if (strlen($v) >= $lmin && strlen($v) <= $lmax) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    static function isScript($v) {
        return self::isCondicion($v, '/^(<)(script)(>).*?(<)(\\/)(script)(>)$/');
        //veo que el inicio de la cadena sea <script> y el fin </script>
    }

    static function isLogin($v) {
        return self::isCondicion($v, '/^[A-Za-z][A-Za-z0-9][5,9]$/');
        //1º empieza con /
        //2º acaba con /
        //^x empieza con x
        //x$ acaba con x
    }

    static function isClave($v) {
        return self::isCondicion($v, '/[A-Za-z0-9][6,10]$/');
    }

    static function isCondicion($v, $condicion) {
        return preg_match($condicion, $v);
    }

    static function isAltaUsuario($login, $clave, $claveconfirmada, $nombre, $apellidos, $correo) {
        return self::isLogin($login) && self::isClave($clave)
            && ($clave == $claveconfirmada) && self::isCorreo($correo) 
            && self::isLongitudMinima($nombre, 1) && self::isLongitudMinima($apellidos, 1);
    }

    /*
      $search = array ("[", "]", "&", "'" ,"\"");
      $repalce =  array ("&lt;", "&gt,", "&amp;", "&apos;", "&quot;");

      $final = str_replace($search, $repalce, $cadena);
     */
}
