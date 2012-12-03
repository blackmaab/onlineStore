<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Categoria
 *
 * @author malvarado
 */
include_once 'DataSource.class.php';

class Categoria extends DataSource {

    //Código Fuente

    public $idCategoria = null;
    public $descripcion;
    public $fijar;

    public function __construct() {
        $this->conexion(); //inicializa la conexion a la base de datos
        $this->conection->query("SET NAMES 'utf8'");
    }

    public function addCategoria() {
        try {
            $this->conection->beginTransaction();
            $this->sqlQuery = "INSERT INTO categoria VALUES('',:descripcion)";
            $this->resultSet = $this->conection->prepare($this->sqlQuery);
            $this->resultSet->bindParam(":descripcion", $this->descripcion);
            $this->resultSet->execute();
            $this->conection->commit();
            $this->borrarCache();
            echo "true";
        } catch (PDOException $e) {
            $this->borrarCache();
            //$this->conection->rollBack();
            print_r("Error al guardar el Categoria: " . $e->getMessage() . "\n");
        }
    }

    public function searchCategoria() {
        try {

            $this->sqlQuery = "SELECT * FROM categoria WHERE descripcion like :descripcion";
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
                    echo "<td align='center'><input type='image' src='images/tabla/edit.png' onclick='selCategoria(\"" . $row["idcategoria"] . "\",\"" . $row["descripcion"] . "\")'></td>";
                    echo "<td align='center'><input type='image' src='images/tabla/del.png' onclick='deleteCategoria(\"" . $row["idcategoria"] . "\")'></td></tr>";
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
            print_r("Error al consultar el Categoria: " . $e->getMessage() . "\n");
        }
    }

    public function updateCategoria() {
        try {
            $this->conection->beginTransaction();
            $this->sqlQuery = "UPDATE categoria SET descripcion=:descripcion WHERE idcategoria=:idCategoria";
            $this->resultSet = $this->conection->prepare($this->sqlQuery);
            $this->resultSet->bindParam(":descripcion", $this->descripcion);
            $this->resultSet->bindParam(":idCategoria", $this->idCategoria);
            $this->resultSet->execute();
            $this->conection->commit();
            $this->borrarCache();
            echo "true";
        } catch (PDOException $e) {
            $this->borrarCache();
            $this->conection->rollBack();
            echo "Error al actualizar la Categoria: " . $e->getMessage() . "\n";
        }
    }

    public function deleteCategoria() {
        try {
            $this->conection->beginTransaction();
            $this->sqlQuery = "DELETE FROM categoria WHERE idcategoria=:idCategoria";
            $this->resultSet = $this->conection->prepare($this->sqlQuery);
            $this->resultSet->bindParam(":idCategoria", $this->idCategoria);
            $this->resultSet->execute();
            $this->conection->commit();
            $this->borrarCache();
            echo "true";
        } catch (PDOException $e) {
            $this->borrarCache();
            $this->conection->rollBack();
            echo "Error al eliminar Categoria: " . $e->getMessage() . "\n";
        }
    }

    public function cargarComboCategoria() {
        try {

            $this->sqlQuery = "SELECT * FROM categoria ORDER BY descripcion ASC";
            $this->resultSet = $this->conection->prepare($this->sqlQuery);
            //$this->resultSet->bindParam(":descripcion", $this->descripcion);
            $this->resultSet->execute();
            $coicidencias = $this->resultSet->rowCount();
            if ($coicidencias > 0) {
                $seleccionar = "";
                echo "<option value='-'>Elija un area de empleo</option>";
                while ($row = $this->resultSet->fetch(PDO::FETCH_ASSOC)) {
                    if ($this->fijar == $row["idcategoria"]) {
                        $seleccionar = "selected='selected'";
                    }
                    echo "<option value='" . $row["idcategoria"] . "' " . $seleccionar . ">" . $row["descripcion"] . "</option>";
                    $seleccionar = "";
                }
            } else {
                echo "<option value='-'>No hay datos</option>";
            }


            $this->borrarCache();
        } catch (PDOException $e) {
            $this->borrarCache();
            //$this->conection->rollBack();
            print_r("Error al cargar el pais: " . $e->getMessage() . "\n");
        }
    }

    public function listarCategoria() {
        $this->sqlQuery = "SELECT * FROM categoria ORDER BY descripcion ASC";
        $this->resultSet = $this->conection->prepare($this->sqlQuery);
        //$this->resultSet->bindParam(":descripcion", $this->descripcion);
        $this->resultSet->execute();
        $coicidencias = $this->resultSet->rowCount();
        if ($coicidencias > 0) {
            $arreglo = array();
            $contador = 0;
            while ($row = $this->resultSet->fetch(PDO::FETCH_ASSOC)) {
                $arreglo[$contador] = $row["descripcion"];
                $contador++;
            }
            return $arreglo;
        }else{
            return false;
        }
    }

}

?>
