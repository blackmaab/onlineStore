<?php

/**
 * Nombre de Archivo: dataSource.class.php
 * Fecha Creación: 11-08-2012 
 * Hora: 07:38:35 PM
 * @author Mario Alvarado
 */
class DataSource {

    //Código Fuente
    //variables de conexion
    private $hostname = "localhost";
    private $userData = "admin";
    private $passwordData = "admin";
    private $database = "onlineStore";
    public $conection;

    public function conexion() {
        try {
            $this->conection = new PDO("mysql:host=" . $this->hostname . ";dbname=" . $this->database, $this->userData, $this->passwordData, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            //$this->conection->query("SET NAMES 'utf8'");
            //echo "conexion establecida";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Metodo generales
     */
    public $sqlQuery;
    public $resultSet;

    public function borrarCache() {
        unset($this->sqlQuery); //destruye la variable
        unset($this->resultSet); //destruye la variable
        $this->conection = null; //cerrando la conexion
    }

}

//end class dataSource
?>
