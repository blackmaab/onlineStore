<?php

/**
 * Description of Marca
 *
 * @author malvarado
 */
include_once 'DataSource.class.php';

class Marca extends DataSource {

    //Código Fuente

    public $idMarca = null;
    public $descripcion;
    public $fijar;

    public function __construct() {
        $this->conexion(); //inicializa la conexion a la base de datos
        $this->conection->query("SET NAMES 'utf8'");
    }

    public function addMarca() {
        try {
            $this->conection->beginTransaction();
            $this->sqlQuery = "INSERT INTO marca VALUES('',:descripcion)";
            $this->resultSet = $this->conection->prepare($this->sqlQuery);
            $this->resultSet->bindParam(":descripcion", $this->descripcion);
            $this->resultSet->execute();
            $this->conection->commit();
            $this->borrarCache();
            echo "true";
        } catch (PDOException $e) {
            $this->borrarCache();
            //$this->conection->rollBack();
            print_r("Error al guardar el Marca: " . $e->getMessage() . "\n");
        }
    }

    public function searchMarca() {
        try {

            $this->sqlQuery = "SELECT * FROM marca WHERE descripcion like :descripcion";
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
                    echo "<td align='center'><input type='image' src='images/tabla/edit.png' onclick='selMarca(\"" . $row["idmarca"] . "\",\"" . $row["descripcion"] . "\")'></td>";
                    echo "<td align='center'><input type='image' src='images/tabla/del.png' onclick='deleteMarca(\"" . $row["idmarca"] . "\")'></td></tr>";
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
            print_r("Error al consultar el Marca: " . $e->getMessage() . "\n");
        }
    }

    public function updateMarca() {
        try {
            $this->conection->beginTransaction();
            $this->sqlQuery = "UPDATE marca SET descripcion=:descripcion WHERE idmarca=:idMarca";
            $this->resultSet = $this->conection->prepare($this->sqlQuery);
            $this->resultSet->bindParam(":descripcion", $this->descripcion);
            $this->resultSet->bindParam(":idMarca", $this->idMarca);
            $this->resultSet->execute();
            $this->conection->commit();
            $this->borrarCache();
            echo "true";
        } catch (PDOException $e) {
            $this->borrarCache();
            $this->conection->rollBack();
            echo "Error al actualizar la Marca: " . $e->getMessage() . "\n";
        }
    }

    public function deleteMarca() {
        try {
            $this->conection->beginTransaction();
            $this->sqlQuery = "DELETE FROM marca WHERE idmarca=:idMarca";
            $this->resultSet = $this->conection->prepare($this->sqlQuery);
            $this->resultSet->bindParam(":idMarca", $this->idMarca);
            $this->resultSet->execute();
            $this->conection->commit();
            $this->borrarCache();
            echo "true";
        } catch (PDOException $e) {
            $this->borrarCache();
            $this->conection->rollBack();
            echo "Error al eliminar Marca: " . $e->getMessage() . "\n";
        }
    }

    public function cargarComboMarca() {
        try {

            $this->sqlQuery = "SELECT * FROM marca ORDER BY descripcion ASC";
            $this->resultSet = $this->conection->prepare($this->sqlQuery);
            //$this->resultSet->bindParam(":descripcion", $this->descripcion);
            $this->resultSet->execute();
            $coicidencias = $this->resultSet->rowCount();
            if ($coicidencias > 0) {
                $seleccionar = "";
                echo "<option value='-'>Elija una marca</option>";
                while ($row = $this->resultSet->fetch(PDO::FETCH_ASSOC)) {
                    if ($this->fijar == $row["idmarca"]) {
                        $seleccionar = "selected='selected'";
                    }
                    echo "<option value='" . $row["idmarca"] . "' " . $seleccionar . ">" . $row["descripcion"] . "</option>";
                    $seleccionar = "";
                }
            } else {
                echo "<option value='-'>No hay datos</option>";
            }


            $this->borrarCache();
        } catch (PDOException $e) {
            $this->borrarCache();
            //$this->conection->rollBack();
            print_r("Error al cargar el marca: " . $e->getMessage() . "\n");
        }
    }

    public function listarMarca() {
        $this->sqlQuery = "SELECT * FROM marca ORDER BY descripcion ASC";
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
