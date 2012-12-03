<?php
include("config.php");

if (!empty($_GET['mod'])) {
    $modulo = $_GET['mod'];
} else {
    $modulo = MODULO_DEFECTO;
}

//verificacion de existencia del modulo
if (!empty($conf[$modulo]['layout'])) {
    $path_layout = LAYOUT_PATH . '/' . $conf[$modulo]["layout"];
    include($path_layout);
} else {
    $modulo = "404";
    $path_layout = LAYOUT_PATH . '/' . $conf[$modulo]["layout"];
    include($path_layout);
}
?>
