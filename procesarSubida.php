<?php
require_once('includesWeb/daos/DAOCargador.php');

session_start();

$done = false;
$cargador = new DAOCargador();
if($cargador->carga($_FILES['file_button'])){
    $_SESSION['mensaje'] = 'Se ha cargado el archivo correctamente';
}
else {
    $_SESSION['mensaje'] = '¡Error! el archivo no se ha cargado correctamente';
}
header('Location:perfil');
exit();
?>