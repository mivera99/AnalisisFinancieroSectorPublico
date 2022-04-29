<?php
require_once("includesWeb/daos/DAOCargador.php");

$nombre = urldecode(htmlspecialchars(trim(strip_tags($_REQUEST['nombre'])))); 
$type = htmlspecialchars(trim(strip_tags($_REQUEST['tipo'])));
$cargador = new DAOCargador();

$filename = $cargador->export($nombre,$type);
$nombre = str_replace(' ', '_', str_replace(',','',str_replace('-','',strtolower($nombre)))).'_ingresos.xlsx';
header('Content-Type: text/xlsx; charset=utf-8');
header('Content-Disposition: attachment; filename="'.$nombre.'";');
if($filename!='') {
    flush();
    readfile($filename);
    unlink($filename);
}
exit();
?>