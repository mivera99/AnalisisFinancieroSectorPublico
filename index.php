<?php
session_start();
require_once('includesWeb/daos/DAOConsultor.php');

$show_message = null;

if (isset($_SESSION['mensaje'])) {
    $show_message = $_SESSION['mensaje'];
    $_SESSION['mensaje'] = null;
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
    <script src="functions2.js"></script>

    <title>Análisis Financiero del Sector Público - Inicio</title>
</head>
    <body>

        <div id = "cabeceraIni">
            <?php require("includesWeb/comun/cabecera.php");?>  
        </div>

        <div id="menu-superior">
            <div id ="contenidoIni">     
            <?php require("includesWeb/comun/buscador.php");?>  
            </div>
        </div>

        <div id="contenido">
            <h2>Informes financieros para la <b>transparencia</b> del sector público</h2>
            <p>Obten información detallada y actualizada sobre las comunidades autónomas, diputaciones y municipios.</p>
        </div>

        <div id = "pie">
            <?php require("includesWeb/comun/pie.php");?>
        </div>

    </body>
</html>