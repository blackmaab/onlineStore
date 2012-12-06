<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author malvarado
 */
include_once 'DataSource.class.php';

class Usuario extends DataSource {

    //Código Fuente

    public $idUsuario = null;
    public $nombre;
    public $apellido;
    public $direccion;
    public $telefono;
    public $email;
    public $user;
    public $pass;
    public $tipo;
    public $estado;
    public $descripcion;
    public $fijar;

    public function __construct() {
        $this->conexion(); //inicializa la conexion a la base de datos
        $this->conection->query("SET NAMES 'utf8'");
    }

    public function generarPK() {
        $this->sqlQuery = "select count(*) as total from dato_usuario";
        $this->resultSet = $this->conection->prepare($this->sqlQuery);
        $this->resultSet->execute();
        $row = $this->resultSet->fetch(PDO::FETCH_ASSOC);
        $this->idUsuario = $row["total"];
    }

    public function addUsuario() {
        try {
            $this->conection->beginTransaction();
            $this->sqlQuery = "INSERT INTO dato__usuario VALUES(:idUsuario,:nombre,:apellido,:direccion,:telefono)";
            $this->resultSet = $this->conection->prepare($this->sqlQuery);
            $this->resultSet->bindParam(":idUsuario", $this->idUsuario);
            $this->resultSet->bindParam(":nombre", $this->nombre);
            $this->resultSet->bindParam(":apellido", $this->apellido);
            $this->resultSet->bindParam(":direccion", $this->direccion);
            $this->resultSet->bindParam(":telefono", $this->telefono);
            $this->resultSet->execute();
            
            $this->sqlQuery = "INSERT INTO usuario VALUES(:user,MD5(:pass),:tipo,:estado:idUsuario)";
            $this->resultSet->bindParam(":user", $this->user);
            $this->resultSet->bindParam(":pass", $this->pass);
            $this->resultSet->bindParam(":tipo", $this->tipo);
            $this->resultSet->bindParam(":estado", $this->estado);
            $this->resultSet->bindParam(":idUsuario", $this->idUsuario);
            $this->resultSet->execute();
            $this->conection->commit();
            $this->borrarCache();
            echo "true";
        } catch (PDOException $e) {
            $this->borrarCache();
            //$this->conection->rollBack();
            print_r("Error al guardar el Usuario: " . $e->getMessage() . "\n");
        }
    }

    public function searchUsuario() {
        try {

            $this->sqlQuery = "SELECT * FROM Usuario WHERE descripcion like :descripcion";
            $this->resultSet = $this->conection->prepare($this->sqlQuery);
            $this->resultSet->bindParam(":descripcion", $this->descripcion);
            $this->resultSet->execute();
            $coicidencias = $this->resultSet->rowCount();
            $datos = "";
            if ($coicidencias > 0) {
                echo "<table class='ui-widget ui-widget-content' >";
                echo "<thead>";
                echo "<tr class='ui-widget-header'>";
                echo "<th>#</th>";
                echo "<th>Descripción</th>";
                echo "<th>Editar</th>";
                echo "<th>Eliminar</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                $cont = 1;
                while ($row = $this->resultSet->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr><td><b>" . ($cont++) . "</b></td>";
                    echo "<td>" . $row["descripcion"] . "</td>";
                    echo "<td align='center'><input type='image' src='images/tabla/edit.png' onclick='selUsuario(\"" . $row["idUsuario"] . "\",\"" . $row["descripcion"] . "\")'></td>";
                    echo "<td align='center'><input type='image' src='images/tabla/del.png' onclick='deleteUsuario(\"" . $row["idUsuario"] . "\")'></td></tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<h1>No se encontraron coicidencias</h1>";
            }


            $this->borrarCache();
        } catch (PDOException $e) {
            $this->borrarCache();
            //$this->conection->rollBack();
            print_r("Error al consultar el Usuario: " . $e->getMessage() . "\n");
        }
    }

    public function updateUsuario() {
        try {
            $this->conection->beginTransaction();
            $this->sqlQuery = "UPDATE Usuario SET descripcion=:descripcion WHERE idUsuario=:idUsuario";
            $this->resultSet = $this->conection->prepare($this->sqlQuery);
            $this->resultSet->bindParam(":descripcion", $this->descripcion);
            $this->resultSet->bindParam(":idUsuario", $this->idUsuario);
            $this->resultSet->execute();
            $this->conection->commit();
            $this->borrarCache();
            echo "true";
        } catch (PDOException $e) {
            $this->borrarCache();
            $this->conection->rollBack();
            echo "Error al actualizar la Usuario: " . $e->getMessage() . "\n";
        }
    }

    public function deleteUsuario() {
        try {
            $this->conection->beginTransaction();
            $this->sqlQuery = "DELETE FROM Usuario WHERE idUsuario=:idUsuario";
            $this->resultSet = $this->conection->prepare($this->sqlQuery);
            $this->resultSet->bindParam(":idUsuario", $this->idUsuario);
            $this->resultSet->execute();
            $this->conection->commit();
            $this->borrarCache();
            echo "true";
        } catch (PDOException $e) {
            $this->borrarCache();
            $this->conection->rollBack();
            echo "Error al eliminar Usuario: " . $e->getMessage() . "\n";
        }
    }

    public function cargarComboUsuario() {
        try {

            $this->sqlQuery = "SELECT * FROM Usuario ORDER BY descripcion ASC";
            $this->resultSet = $this->conection->prepare($this->sqlQuery);
            //$this->resultSet->bindParam(":descripcion", $this->descripcion);
            $this->resultSet->execute();
            $coicidencias = $this->resultSet->rowCount();
            if ($coicidencias > 0) {
                $seleccionar = "";
                echo "<option value='-'>Elija una Usuario</option>";
                while ($row = $this->resultSet->fetch(PDO::FETCH_ASSOC)) {
                    if ($this->fijar == $row["idUsuario"]) {
                        $seleccionar = "selected='selected'";
                    }
                    echo "<option value='" . $row["idUsuario"] . "' " . $seleccionar . ">" . $row["descripcion"] . "</option>";
                    $seleccionar = "";
                }
            } else {
                echo "<option value='-'>No hay datos</option>";
            }


            $this->borrarCache();
        } catch (PDOException $e) {
            $this->borrarCache();
            //$this->conection->rollBack();
            print_r("Error al cargar la Usuario: " . $e->getMessage() . "\n");
        }
    }

    public function listarUsuario() {
        $this->sqlQuery = "SELECT * FROM Usuario ORDER BY descripcion ASC";
        $this->resultSet = $this->conection->prepare($this->sqlQuery);
        //$this->resultSet->bindParam(":descripcion", $this->descripcion);
        $this->resultSet->execute();
        $coicidencias = $this->resultSet->rowCount();
        if ($coicidencias > 0) {
            $arreglo = array();
            $contador = 0;
            while ($row = $this->resultSet->fetch(PDO::FETCH_ASSOC)) {
                $arreglo[$contador] = array($row["idUsuario"], $row["descripcion"]);
                $contador++;
            }
            return $arreglo;
        } else {
            return false;
        }
    }

}

?>
