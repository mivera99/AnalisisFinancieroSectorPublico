<?php
require_once("includesWeb/daos/DAOCargador.php");

$nombre = htmlspecialchars(trim(strip_tags($_REQUEST['nombre'])));; 

$cargador = new DAOCargador();

$cargador->export_ccaa($nombre);

//header('Location:infoCCAA.php?ccaa='.$nombre.'');
exit();

?>