<?php

/* extract($_POST);
  $destino = $_SERVER['DOCUMENT_ROOT'] . '/' . 'onlineStore/images/accesorios';
  $tamano = $_FILES['txtImagenProducto']['size'];
  $tipo = $_FILES['txtImagenProducto']['type'];
  copy($_FILES['txtImagenProducto']['tmp_name'], $destino . '/' . $_FILES['txtImagenProducto']['name']); */


//echo $_POST['txtProducto'] . " - " . $_POST['idMarca'] . ' - ' . $_POST['idCategoria'] . ' - ' 
//. $_POST['txtDescripcionProducto'] . ' - ' . $_POST['txtExistenciaProducto'] . ' - ' . $_POST['txtCostoProducto'] . ' - ' . $_POST['txtType'];
include_once '../class/Producto.class.php';
$newProducto = new Producto();
if (isset($_POST["txtType"])) {
    if ($_POST["txtType"] == "add") {


        $newProducto->titulo = strtoupper($_POST['txtProducto']);
        $newProducto->descripcion = strtoupper($_POST['txtDescripcionProducto']);
        $newProducto->existencias = $_POST['txtExistenciaProducto'];
        $newProducto->costo = $_POST['txtCostoProducto'];
        $newProducto->idCategoria = $_POST['idCategoria'];
        $newProducto->idMarca = $_POST['idMarca'];
        $res = $newProducto->uploadFile($_FILES['txtImagenProducto']['tmp_name'], $_FILES['txtImagenProducto']['name']);
        //verificacion de error al momento de subir la imagen
        if ($res == "true") {
            $newProducto->addProducto();
        } else {
            echo "error";
        }
    } else if ($_POST["txtType"] == "search") {
        $newProducto->tipoSearch = $_POST["txtTipoSearch"];
        if ($newProducto->tipoSearch == "t") {
            $newProducto->titulo = "%" . strtoupper($_POST["txtProducto"]) . "%";
        } else {
            $newProducto->descripcion = "%" . strtoupper($_POST["txtProducto"]) . "%";
        }

        $newProducto->searchProducto();
    } else if ($_POST["txtType"] == "update") {
        $newProducto->idProducto = $_POST["txtIdProducto"];
        $newProducto->descripcion = strtoupper($_POST["txtProducto"]);
        $newProducto->updateProducto();
    } else if ($_POST["txtType"] == "delete") {
        $newProducto->idProducto = $_POST["txtIdProducto"];
        $newProducto->deleteProducto();
    } else if ($_POST["txtType"] == "cargar") {
        $newProducto->fijar = $_POST["txtFijar"];
        $newProducto->cargarComboProducto();
    }
}
?>
