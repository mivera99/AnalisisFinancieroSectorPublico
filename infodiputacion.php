<?php
session_start();
require_once('includesWeb\daos\DAOConsultor.php');
$nombre = htmlspecialchars(trim(strip_tags($_GET["dip"])));

$diputacion = (new DAOConsultor())->getDiputacion($nombre);
$encontrado = false;
if($diputacion){
    $encontrado = true;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--  ====== STYLES (CSS) ===== -->
    <link rel="stylesheet" href="styles.css">

    <!--  ====== FONTS ===== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    
    <!--  ====== FUNCIÓN AUTOCOMPLETAR BÚSQUEDA ===== -->
    <script src="functions.js"></script>

    <script src="node_modules/chart.js/dist/chart.js"></script>

    <title>Análisis Financiero del Sector Público - Diputación</title>
</head>
    <body>

        <div id = "cabecera">
            <?php require("includesWeb/comun/cabecera.php");?>  
        </div>

        <div id ="contenido"> 
            <h3>Diputación</h3>
            <?php
            if($encontrado){
                echo '<h2>'.$diputacion->getNombre().'</h2>';
                echo '<h2>Información general</h2>';
                echo '<p>Provincia: '.$diputacion->getProvincia().'</p>';
                echo '<p>Autonomía: '.$diputacion->getAutonomia().'</p>';
                echo '<p>CIF: '.$diputacion->getCif().'</p>';
                echo '<p>Via: '.$diputacion->getTipoVia().' '.$diputacion->getNombreVia().' '.$diputacion->getNumVia().'</p>';
                echo '<p>Teléfono: '.$diputacion->getTelefono().'</p>';
                echo '<p>Código Postal: '.$diputacion->getCodigoPostal().'</p>';
                echo '<p>Fax: '.$diputacion->getFax().'</p>';
                echo '<p>Sitio web: '.$diputacion->getWeb().'</p>';
                echo '<p>Correo electrónico: '.$diputacion->getMail().'</p>';
            }
            else {
                echo '<p>Diputación no encontrada</p>';
            }
            ?>
        </div>

        <div id = "pie">
            <?php require("includesWeb/comun/pie.php");?>
        </div>

    </body>
</html>