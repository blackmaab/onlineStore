<?php

session_start();
include_once '../class/Usuario.class.php';
$newUsuario = new Usuario();
if (isset($_POST["txtType"])) {
    if ($_POST["txtType"] == "add") {
        $newUsuario->nombre = strtoupper($_POST["txtNombre"]);
        $newUsuario->apellido = strtoupper($_POST["txtApellido"]);
        $newUsuario->direccion = strtoupper($_POST["txtDireccion"]);
        $newUsuario->telefono = $_POST["txtTelefono"];
        $newUsuario->email = strtoupper($_POST["txtEmail"]);

        $newUsuario->user = strtoupper($_POST["txtUserNew"]);
        $newUsuario->pass = $_POST["txtPassNew"];
        $newUsuario->addUsuario();
    } else if ($_POST["txtType"] == "search") {
        $newUsuario->descripcion = strtoupper($_POST["txtUsuario"]) . "%";
        $newUsuario->searchUsuario();
    } else if ($_POST["txtType"] == "update") {
        $newUsuario->idUsuario = $_POST["txtIdUsuario"];
        $newUsuario->descripcion = strtoupper($_POST["txtUsuario"]);
        $newUsuario->updateUsuario();
    } else if ($_POST["txtType"] == "delete") {
        $newUsuario->idUsuario = $_POST["txtIdUsuario"];
        $newUsuario->deleteUsuario();
    } else if ($_POST["txtType"] == "cargar") {
        $newUsuario->fijar = $_POST["txtFijar"];
        $newUsuario->cargarComboUsuario();
    } else if ($_POST["txtType"] == "verificar") {
        if (isset($_SESSION["usuario"])) {
            //echo $_SESSION["usuario"];
            echo "true";
        } else {
            echo "false";
        }
    } else if ($_POST["txtType"] == "autenticar") {
        $_SESSION["usuario"] = "mario";
        //session_destroy();
    }
}
?>

