<?php

define('MODULO_DEFECTO', 'home');
define('LAYOUT_DEFECTO', 'layout_default.php');
define('LAYOUT_ADMINISTRATOR', 'layout_administrator.php');
define('LAYOUT_USER', 'layout_user.php');
define('MODULO_PATH', realpath('modules'));
define('LAYOUT_PATH', realpath('layouts'));

/* MODULO POR DEFECTO */
$conf['home'] = array(
    'archivo' => 'pages/defaultHome.php',
    'layout' => LAYOUT_DEFECTO
);


?>

