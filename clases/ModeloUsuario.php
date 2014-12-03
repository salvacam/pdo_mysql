<?php

class ModeloUsuario {

    //Implementamos los métodos que necesitamos para trabajar con la persona
    private $bd = null;
    private $tabla = "usuario";

    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }

    function add(Usuario $objeto) {
        $sql = "insert into $this->tabla values (:login, :clave, :nombre, "
                . ":apellidos, :email, curdate(), :isactivo, :isroot, :rol,"
                . "null );";
        $parametros["login"] = $objeto->getLogin();
        $parametros["clave"] = sha1($objeto->getClave());
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["apellidos"] = $objeto->getApellidos();
        $parametros["email"] = $objeto->getEmail();
        //$parametros["fechaalta"] = $objeto->getFechaalta();
        //$fecha = new DateTime(null, new DateTimeZone('Europe/Madrid'));
        //$parametros["fechaalta"] = $fecha->format('Y-m-d H:i');        
        $parametros["isactivo"] = $objeto->getIsactivo();
        $parametros["isroot"] = $objeto->getIsroot();
        $parametros["rol"] = $objeto->getRol();
        //$parametros["fechalogin"] = $objeto->getFechalogin();
        //$parametros["fechalogin"] = NULL;
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $r; //return 1 si se ha insertado     
    }

    function alta(Usuario $objeto) {
        $sql = "insert into $this->tabla values (:login, :clave, :nombre, "
                . ":apellidos, :email, curdate(), :isactivo, :isroot, :rol,"
                . "null );";
        $parametros["login"] = $objeto->getLogin();
        $parametros["clave"] = $objeto->getClave();
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["apellidos"] = $objeto->getApellidos();
        $parametros["email"] = $objeto->getEmail();
        $parametros["isactivo"] = 0;
        $parametros["isroot"] = 0;
        $parametros["rol"] = "usuario";
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        //mandar correo

        return $r; //return 1 si se ha insertado     
    }

    function delete(Usuario $objeto) {
        $sql = "delete from $this->tabla where login=:login;";
        $parametros["login"] = $objeto->getLogin();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    function deletePorId($id) {
        return $this->delete(new Usuario($id));
    }

    //clave principal autonumérica
    /*  function edit(Persona $objeto) {
      $sql = "update $this->tabla set nombre=:nombre, "
      . "apellidos=:apellidos where id=:id;";
      $parametros["nombre"] = $objeto->getNombre();
      $parametros["apellidos"] = $objeto->getApellidos();
      $parametros["id"] = $objeto->getId();
      $r = $this->bd->setConsulta($sql, $parametros);
      if (!$r) {
      return -1;
      }
      return $this->bd->getNumeroFilas();
      }
     */
    //clave principal no autonumérica
    //function editPK(Usuario $objetoOriginal, Usuario $objetoNuevo) {
    function editPK(Usuario $objeto, $loginpk) {
        $sql = "update $this->tabla set login=:login, clave=:clave, nombre=:nombre, "
                . "apellidos=:apellidos, email=:email, "
                //. "fechalta=:fechaalta "
                . "isactivo=:isactivo, isroot=:isroot, rol=:rol "
                //. "fechalogin=:fechalogin "
                . "where login=:loginpk;";
        $parametros["login"] = $objeto->getLogin();
        $parametros["clave"] = sha1($objeto->getClave());
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["apellidos"] = $objeto->getApellidos();
        $parametros["email"] = $objeto->getEmail();
        //$parametros["fechaalta"] = $objeto->getFechaalta();
        $parametros["isactivo"] = $objeto->getIsactivo();
        $parametros["isroot"] = $objeto->getIsroot();
        $parametros["rol"] = $objeto->getRol();
        //$parametros["fechalogin"] = $objeto->getFechalogin();
        //$parametros["loginpk"] = $objetoOriginal->getLogin();        
        $parametros["loginpk"] = $loginpk;
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    function editConClave(Usuario $objeto, $loginpk, $claveold) {
        $asignacion = "login=:login, clave=:clave, "
                . "nombre=:nombre, apellidos=:apellidos, "
                . "email=:email";
        $condicion = "login=:loginpk and clave=:claveold";
        $parametros["login"] = $objeto->getLogin();
        $parametros["clave"] = sha1($objeto->getClave());
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["apellidos"] = $objeto->getApellidos();
        $parametros["email"] = $objeto->getEmail();
        $parametros["loginpk"] = $loginpk;
        $parametros["claveold"] = $claveold;
        return $this->editConsulta($asignacion, $condicion, $parametros);
    }

    function editSinClave(Usuario $objeto, $loginpk) {
        $asignacion = "login=:login,"
                . "nombre=:nombre, apellidos=:apellidos,"
                . "email=:email";
        $condicion = "login=:loginpk";
        $parametros["login"] = $objeto->getLogin();
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["apellidos"] = $objeto->getApellidos();
        $parametros["email"] = $objeto->getEmail();
        $parametros["loginpk"] = $loginpk;
        
        return $this->editConsulta($asignacion, $condicion, $parametros);
    }

    function desactivar($loginpk) {
        $sql = "update $this->tabla set isactivo=0 where login=:login;";
        $parametros["login"] = $loginpk;
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    function editConsulta($asignacion, $condicion = "1=1", $parametros = array()) {
        $sql = "update $this->tabla set $asignacion where $condicion"; 
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    function activa($id) {
        $sql = "update usuario "
                . "set isactivo = 1 "
                . "where isactivo = 0 and md5(concat(email,'" . Configuracion::PEZARANA . "',login))=:id;";
        //si quiero poner al usuario desactivado, pongo -1, no 0 si no se podria volver a dar de alta
        $parametros["id"] = $id;
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    /*function activar($login) {
        $sql = "update $this->tabla set isactivo=1 where isactivo=0 and login=:login;";
        $parametros["login"] = $login;
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }*/

    function login($login, $clave) {
        $sql = "select login from usuario where clave=:clave and isactivo=1;";
        $parametros["clave"] = sha1($clave);
        $r = $this->bd->setConsulta($sql, $parametros);
        $resultado = $this->bd->getFila();
        $loginEncontrado = $resultado[0];
        if ($login == $loginEncontrado) {
            return $this->get($loginEncontrado);
        }
        return false;
    }

    function getConsulta() {
        
    }

    //le paso el id y me devuelve el objeto completo
    function get($login) {
        $sql = "select * from $this->tabla where login=:login;";
        $parametros["login"] = $login;
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            $usuario = new Usuario();
            $usuario->set($this->bd->getFila());
            return $usuario;
        }
        return null;
    }

    function count($condicion = "1=1", $parametros = array()) {
        $sql = "select count(*) from $this->tabla where $condicion";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            //return $this->bd->getFila()[0];
            return $this->bd->getFila();
        }
        return -1;
    }

    function getList($condicion = "1=1", $parametros = array(), $orderBy = "1") {
        $list = array(); //$list = [];
        $sql = "select * from $this->tabla where $condicion order by $orderBy";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            while ($fila = $this->bd->getFila()) {
                $usuario = new Usuario();
                $usuario->set($fila);
                $list[] = $usuario;
            }
        } else {
            return null;
        }
        return $list;
    }

    function selectHtml($id, $name, $condicion, $parametros, $orderBy = "1", $valorSeleccionado = "", $blanco = TRUE, $textoBlanco = "&nbsp") {
        $select = "<select name='name' id='id'>";
        if ($blanco) {
            $select .= "<option value=''>$textoBlanco</option>";
        }
        //while y añado todos los option que quiera (hacerlo con el getList)
        $lista = $this->getList($condicion, $parametros, $orderBy);
        foreach ($lista as $objeto) {
            $selected = "";
            if ($objeto->getId() == $valorSeleccionado) {
                $selected = "selected";
            }
            $select .= "<option $selected value='" . $objeto->getLogin() . "'>"
                    . $objeto->getNombre() . ", " . $objeto->getApellidos()
                    . $objeto->getEmail() . ", " . $objeto->getFechaalta()
                    . $objeto->getIsactivo() . ", " . $objeto->getIsroot()
                    . $objeto->getFechalogin() . "</option>";
        }
        $select .= "</select>";
        return $select;
    }

}
