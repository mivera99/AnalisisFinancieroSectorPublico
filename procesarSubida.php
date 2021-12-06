<?php

require_once('includesWeb/daos/DAOCargador.php');

$done = false;
$cargador = new DAOCargador();
if($cargador.carga($_FILES['file_button'])){
    $done =true;
}

?>