<?php
include_once '../class/Categoria.class.php';
$newCategoria = new Categoria();
if (isset($_POST["txtType"])) {
    if ($_POST["txtType"] == "add") {
        $newCategoria->descripcion = strtoupper($_POST["txtCategoria"]);
        $newCategoria->addCategoria();
    } else if ($_POST["txtType"] == "search") {
        $newCategoria->descripcion = strtoupper($_POST["txtCategoria"]) . "%";
        $newCategoria->searchCategoria();
    } else if ($_POST["txtType"] == "update") {
        $newCategoria->idCategoria = $_POST["txtIdCategoria"];
        $newCategoria->descripcion = strtoupper($_POST["txtCategoria"]);
        $newCategoria->updateCategoria();
    } else if ($_POST["txtType"] == "delete") {
        $newCategoria->idCategoria = $_POST["txtIdCategoria"];
        $newCategoria->deleteCategoria();
    }else if ($_POST["txtType"] == "cargar") {
        $newCategoria->fijar=$_POST["txtFijar"];
        $newCategoria->cargarComboCategoria();
    }

}
?>
