<?php

/**
 * Class BaseDatos
 *
 * @version 0.1
 * @author izv
 * @license http://...
 * @copyright izv by 2daw
 * Esta clase dispone de métodos para el tratamiento de consultas SQL.
 * 
 */
class BaseDatos_mia {

    private $conectado = false;
    private $conexion;
    private $servidor;
    private $baseDatos;
    private $usuario;
    private $clave;
    private $sentencia = NULL;

    function __construct($servidor, $baseDatos, $usuario, $clave) {
        $this->servidor = $servidor;
        $this->baseDatos = $baseDatos;
        $this->usuario = $usuario;
        $this->clave = $clave;
        $this->conectar();
    }

    private function conectar() {
        try {
            $this->conexion = new PDO(
                    'mysql:host=' . $this->servidor . ';dbname=' . $this->baseDatos, $this->usuario, $this->clave, array(
                PDO::ATTR_PERSISTENT => true,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8')
            );
            $this->conectado = true;
        } catch (PDOException $e) {
            $this->conectado = false;
        }
    }

    /**
     * Cierra la conexion
     * @access public
     */
    function closeConexion() {
        $con = null;
    }

    /**
     * Devuelve el ID de la última fila insertada 
     * @access public
     * @return string|int devuelve el campo ID de la última fila insertada
     */
    function getAutonumerico() {
        return $this->conexion->lastInsertId();
    }

    /**
     * Devuelve la siguiente fila del último select ejecutado 
     * @access public
     * @return array|null devuelve un array asociativo con los campos de la consulta
     */
    function getFila() {
        if ($this->sentencia) {
            return $this->sentencia->fetch();
        } else {
            return NULL;
        }
    }

    /**
     * Devuelve el número de fila de la última consulta 
     * @access public
     * @return int devuelve un entero con el número de filas afectadas, -1 si no hay consulta 
     */
    function getNumeroFilas() {
        if ($this->sentencia) {
            return $this->sentencia->rowCount();
        } else {
            return -1;
        }
    }

    /**
     * Devuelve si esta o no conectado a la base de datos
     * @access public
     * @return boolean devuelve un booleano, si esta o no conectado 
     */
    function isConetado() {
        return $this->conectado;
    }

    /**
     * Establece la base de datos a la que se va ha conectar.
     * @access public
     * @param string $param Cadena con el nombre de la base de datos
     */
    function setBaseDatos($param) {
        $this->baseDatos = $param;
        $this->conectar();
    }
     /**
     * Devuelve el nombre de la base de datos
     * @access public
     * @return string devuelve un string con el nombre de la base de datos 
     */
    function getBaseDatos() {
        return $this->baseDatos;
    }

    /**
     * Ejecuta una sentencia sql con una consulta preparada tipo dock
     * @access public
     * @param string $sql Cadena la consulta sql
     * @param array $param Array con los parametros de la sentecia
     * @return int devuelve un entero con el número de filas afectados
     */
    function setConsulta($sql, $param) {        
        $this->sentencia = $this->conexion->prepare($sql);
        if ($param != NULL){
            foreach ($param as $key => $value) {                
               $this->sentencia->bindValue($key, $value);
            } 
        }
        $this->sentencia->execute();
        return $this->getNumeroFilas();
    }

    /**
     * Ejecuta una sentencia sql con una consulta preparada
     * @access public
     * @param string $sql Cadena la consulta sql
     * @param array $param Array con los parametros de la sentecia
     */
    function setConsultaPreparada($sql, $param) {
        $this->sentencia = $this->conexion->prepare($sql);
        if ($param != NULL){
            for ($i= 0; $i < sizeof($param); $i++) {
               $this->sentencia->bindValue($i+1, $param[$i]);
            }        
        }
        $this->sentencia->execute();
    }

    /**
     * Ejecuta una sentencia sql
     * @access public
     * @param string $sql Cadena con la consulta sql
     */
    function setConsultaSql($sql) {
        $this->sentencia = $this->conexion->query($sql);
    }

    /**
     * Inicia una transaccion
     * @access public
     */
    function setTransaccion() {
        $this->conexion->beginTransaction();
    }
    
    /**
     * Ejecuta una transaccion con consultas preparadas
     * @access public
     * @param array $sql array de cadena con las consulta sql
     * @param array $parametros Array con los parametros de la sentecia
     * @return boolean si se ha realizado o no la transaccion
     */
    function transaccion($sentencias, $parametros){
        $this->setTransaccion();
        $error = true;
        foreach ($sentencias as $key => $value) {
            $res = $this->setConsulta($value, $parametros[$key]);
            if($res < 1){
                $error= false;
                break;
            }
        }
        
        if($error){
            $this->anulaTransaccion();
            return false;
        } else {
            $this->validaTransaccion();
            return true;
        }
    }

    /**
     * Anula la transaccion
     * @access public
     */
    function anulaTransaccion() {
        $this->conexion->rollBack();
    }

    /**
     * Valida una transaccion
     * @access public
     * @return true|false devuelve un booleano si ha podido o no validar la tr
     */
    function validaTransaccion() {
        $this->conexion->commit();
    }
}
