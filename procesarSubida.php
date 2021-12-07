<?php

require_once('includesWeb/daos/DAOCargador.php');

$done = false;
$cargador = new DAOCargador();
if($cargador->carga($_FILES['file_button'])){
    echo "<br>Se ha cargado el archivo correctamente<br>";
    $done =true;
}
else {
    echo "<br>ERROR: el archivo no se ha cargado correctamente<br>";
}

?>