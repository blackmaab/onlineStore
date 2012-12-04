<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Producto
 *
 * @author malvarado
 */
include_once 'DataSource.class.php';

class Producto extends DataSource {

    //Código Fuente

    public $idProducto = null;
    public $titulo;
    public $descripcion;
    public $existencias;
    public $costo;
    public $url_image;
    public $idMarca = null;
    public $idCategoria = null;
    public $tipoSearch;
    public $fijar;

    public function __construct() {
        $this->conexion(); //inicializa la conexion a la base de datos
        $this->conection->query("SET NAMES 'utf8'");
    }

    public function addProducto() {
        try {
            $this->conection->beginTransaction();
            $this->sqlQuery = "INSERT INTO producto VALUES('',:titulo,:descripcion,:existencias,:costo,:url_image,:idmarca,:idcategoria)";
            $this->resultSet = $this->conection->prepare($this->sqlQuery);
            $this->resultSet->bindParam(":titulo", $this->titulo);
            $this->resultSet->bindParam(":descripcion", $this->descripcion);
            $this->resultSet->bindParam(":existencias", $this->existencias);
            $this->resultSet->bindParam(":costo", $this->costo);
            $this->resultSet->bindParam(":url_image", $this->url_image);
            $this->resultSet->bindParam(":idmarca", $this->idMarca);
            $this->resultSet->bindParam(":idcategoria", $this->idCategoria);
            $this->resultSet->execute();
            $this->conection->commit();
            $this->borrarCache();
            echo "true";
        } catch (PDOException $e) {
            $this->borrarCache();
//            $this->conection->rollBack();
            $this->deleteFile(); //borrando el archivo que fue subido
            print_r("Error al guardar el Producto: " . $e->getMessage() . "\n");
        }
    }

    public function uploadFile($file, $name) {
        $buscarCaracteres = array(' ', 'ñ', 'Ñ‘', 'á¡', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ü', 'ü');
        $reemplazarCaracteres = array('_', 'n', 'N', 'a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U', 'U', 'u');

        //quitando caracteres especiales
        $nameArchivo = strtolower(str_replace($buscarCaracteres, $reemplazarCaracteres, $name));

        $destino = $_SERVER['DOCUMENT_ROOT'] . '/' . 'onlineStore/images/' . $this->idCategoria;
        //$tamano = $_FILES['txtImagenProducto']['size'];
        //$tipo = $_FILES['txtImagenProducto']['type'];

        if (substr($nameArchivo, -4) == ".gif" || substr($nameArchivo, -5) == ".jpeg" || substr($nameArchivo, -4) == ".jpg" || substr($nameArchivo, -4) == ".png") {
            //cambiando el nombre de la imagen
            $date = date('d-m-Y_H-i-s-a');
            if (substr($nameArchivo, -5) == ".jpeg") {
                $newNameArchivo = substr($nameArchivo, 0, -5) . "(" . $date . ")" . substr($nameArchivo, -5);
            } else {
                $newNameArchivo = substr($nameArchivo, 0, -4) . "(" . $date . ")" . substr($nameArchivo, -4);
            }

            $this->url_image = 'images/' . $this->idCategoria . '/' . $newNameArchivo;
            //verificar si el directorio existe        
            if (@chdir($destino)) {
                copy($file, $destino . '/' . $newNameArchivo); //guardar imagen en el directorio nuevo                
            } else {
                mkdir($destino, 0777); //creacion del directorio nuevo
                copy($file, $destino . '/' . $newNameArchivo); //guardar imagen en el directorio nuevo                
            }
            return "true";
        } else {
            return "error";
        }
    }

    public function deleteFile() {
        $dir = $_SERVER['DOCUMENT_ROOT'] . '/onlineStore/' . $this->url_image;
        if (file_exists($dir)) {
            unlink($dir);
//if (unlink($dir))
            //echo "El archivo fue borrado";
        }
//        else
//            print "Este archivo no existe";
    }

    public function searchProducto() {
        try {

            if ($this->tipoSearch == "t") {
                $this->sqlQuery = "SELECT a . * , b.descripcion AS marca, c.descripcion AS categoria ";
                $this->sqlQuery.="FROM producto AS a ";
                $this->sqlQuery.="INNER JOIN marca AS b ON a.idmarca = b.idmarca ";
                $this->sqlQuery.="INNER JOIN categoria AS c ON a.idcategoria = c.idcategoria ";
                $this->sqlQuery.= "WHERE a.titulo like :titulo order by a.titulo asc";
            } else {
                $this->sqlQuery = "SELECT a . * , b.descripcion AS marca, c.descripcion AS categoria ";
                $this->sqlQuery.="FROM producto AS a ";
                $this->sqlQuery.="INNER JOIN marca AS b ON a.idmarca = b.idmarca ";
                $this->sqlQuery.="INNER JOIN categoria AS c ON a.idcategoria = c.idcategoria ";
                $this->sqlQuery.= "WHERE a.descripcion like :descripcion order by a.titulo asc";
            }

            $this->resultSet = $this->conection->prepare($this->sqlQuery);
            if ($this->tipoSearch == "t") {
                $this->resultSet->bindParam(":titulo", $this->titulo);
            } else {
                $this->resultSet->bindParam(":descripcion", $this->descripcion);
            }

            $this->resultSet->execute();
            $coicidencias = $this->resultSet->rowCount();
            $datos = "";
            if ($coicidencias > 0) {
                echo "<table class='ui-widget ui-widget-content'>";
                echo "<thead>";
                echo "<tr class='ui-widget-header'>";
                echo "<th>#</th>";
                echo "<th>Titulo</th>";
                echo "<th>Descripción</th>";
                echo "<th>Existencias</th>";
                echo "<th>Costo</th>";
                echo "<th>Imagen</th>";
                echo "<th>Marca</th>";
                echo "<th>Categor&iacute;a</th>";
                echo "<th>Editar</th>";
                echo "<th>Eliminar</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                $cont = 1;
                while ($row = $this->resultSet->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr><td><b>" . ($cont++) . "</b></td>";
                    echo "<td>" . $row["titulo"] . "</td>";
                    echo "<td>" . $row["descripcion"] . "</td>";
                    echo "<td>" . $row["existencias"] . "</td>";
                    echo "<td>" . $row["costo"] . "</td>";
                    echo "<td><img src='" . $row["url_image"] . "' alt='' height='96' width='96'/></td>";
                    echo "<td>" . $row["marca"] . "</td>";
                    echo "<td>" . $row["categoria"] . "</td>";
                    echo "<td align='center'><input type='image' src='images/tabla/edit.png' onclick='selProducto(\"" . $row["idproducto"] . "\",\"" . $row["descripcion"] . "\")'></td>";
                    echo "<td align='center'><input type='image' src='images/tabla/del.png' onclick='deleteProducto(\"" . $row["idproducto"] . "\")'></td></tr>";
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
            print_r("Error al consultar el Producto: " . $e->getMessage() . "\n");
        }
    }

    public function updateProducto() {
        try {
            $this->conection->beginTransaction();
            $this->sqlQuery = "UPDATE producto SET descripcion=:descripcion WHERE idproducto=:idProducto";
            $this->resultSet = $this->conection->prepare($this->sqlQuery);
            $this->resultSet->bindParam(":descripcion", $this->descripcion);
            $this->resultSet->bindParam(":idProducto", $this->idProducto);
            $this->resultSet->execute();
            $this->conection->commit();
            $this->borrarCache();
            echo "true";
        } catch (PDOException $e) {
            $this->borrarCache();
            $this->conection->rollBack();
            echo "Error al actualizar la Producto: " . $e->getMessage() . "\n";
        }
    }

    public function deleteProducto() {
        try {
            $this->conection->beginTransaction();
            $this->sqlQuery = "DELETE FROM producto WHERE idproducto=:idProducto";
            $this->resultSet = $this->conection->prepare($this->sqlQuery);
            $this->resultSet->bindParam(":idProducto", $this->idProducto);
            $this->resultSet->execute();
            $this->conection->commit();
            $this->borrarCache();
            echo "true";
        } catch (PDOException $e) {
            $this->borrarCache();
            $this->conection->rollBack();
            echo "Error al eliminar Producto: " . $e->getMessage() . "\n";
        }
    }

    public function cargarComboProducto() {
        try {

            $this->sqlQuery = "SELECT * FROM producto ORDER BY descripcion ASC";
            $this->resultSet = $this->conection->prepare($this->sqlQuery);
            //$this->resultSet->bindParam(":descripcion", $this->descripcion);
            $this->resultSet->execute();
            $coicidencias = $this->resultSet->rowCount();
            if ($coicidencias > 0) {
                $seleccionar = "";
                echo "<option value='-'>Elija una producto</option>";
                while ($row = $this->resultSet->fetch(PDO::FETCH_ASSOC)) {
                    if ($this->fijar == $row["idproducto"]) {
                        $seleccionar = "selected='selected'";
                    }
                    echo "<option value='" . $row["idproducto"] . "' " . $seleccionar . ">" . $row["descripcion"] . "</option>";
                    $seleccionar = "";
                }
            } else {
                echo "<option value='-'>No hay datos</option>";
            }


            $this->borrarCache();
        } catch (PDOException $e) {
            $this->borrarCache();
            //$this->conection->rollBack();
            print_r("Error al cargar la producto: " . $e->getMessage() . "\n");
        }
    }

    public function listarProducto() {
        $this->sqlQuery = "SELECT * FROM producto ORDER BY descripcion ASC";
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
        } else {
            return false;
        }
    }

}

?>
