<?php
require_once('includesWeb/config.php');
//Aumentamos la memoria de PHP para poder cargar la burrada de datos que tenemos
ini_set('memory_limit', '50G');
ini_set("default_charset", "UTF-8");
ini_set('max_execution_time', 7200);

/*
Importar libreria PHPSpreadsheet
*/
/*
require "../includes/vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;
*/

$conn = getConexionBD();
//$conn = new mysqli("localhost", "root", "", "dbs_01");
$conn->set_charset("utf8");
$values=array();
$fields=array();

?>