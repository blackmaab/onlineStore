<?php
include_once '../class/Marca.class.php';
$newMarca = new Marca();
if (isset($_POST["txtType"])) {
    if ($_POST["txtType"] == "add") {
        $newMarca->descripcion = strtoupper($_POST["txtMarca"]);
        $newMarca->addMarca();
    } else if ($_POST["txtType"] == "search") {
        $newMarca->descripcion = strtoupper($_POST["txtMarca"]) . "%";
        $newMarca->searchMarca();
    } else if ($_POST["txtType"] == "update") {
        $newMarca->idMarca = $_POST["txtIdMarca"];
        $newMarca->descripcion = strtoupper($_POST["txtMarca"]);
        $newMarca->updateMarca();
    } else if ($_POST["txtType"] == "delete") {
        $newMarca->idMarca = $_POST["txtIdMarca"];
        $newMarca->deleteMarca();
    }else if ($_POST["txtType"] == "cargar") {
        $newMarca->fijar=$_POST["txtFijar"];
        $newMarca->cargarComboMarca();
    }

}
?>
