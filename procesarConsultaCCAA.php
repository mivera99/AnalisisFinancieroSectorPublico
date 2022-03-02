<?php
session_start();
require_once('includesWeb/daos/DAOConsultor.php');

$scoring = htmlspecialchars(trim(strip_tags($_REQUEST['scoringCCAA'])));
$poblacion = htmlspecialchars(trim(strip_tags($_REQUEST['poblacionCCAA'])));
/*$endeudamiento = htmlspecialchars(trim(strip_tags($_REQUEST['endeudamientoCCAA'])));
$ahorro_neto = htmlspecialchars(trim(strip_tags($_REQUEST['ahorro_netoCCAA'])));
$fondliq = htmlspecialchars(trim(strip_tags($_REQUEST['fondliqCCAA'])));
*/
$endeudamiento = $poblacion;
$ahorro_neto = $poblacion;
$fondliq = $poblacion;
$ccaas = (new DAOConsultor())->consultarCCAAs($scoring, $poblacion, $endeudamiento, $ahorro_neto, $fondliq);

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

    <!-- ====== FUNCIÓN PARA MOSTRAR LA CONTRASEÑA SI PULSAMOS UN BOTÓN ==== -->
    <script src="functions2.js"></script>
    <title>Análisis Financiero Sector Público - Consulta CCAAs</title>
</head>
<body>
<div id="contenedor">

<div id="cabecera">
    <?php
        require('includesWeb/comun/cabecera.php');
    ?>
</div>
<div id="contenido">
    <?php
    
    foreach($ccaas as $ccaa){
        echo '<p>Nombre: '.$ccaa->getNombre().', Rating: '.$ccaa->getRating().', Poblacion: '.$ccaa->getPoblacion().'</p><br>';
    }
    ?>

</div>
<div id="pie">
    <?php
        require('includesWeb/comun/pie.php');
    ?>
</div>
</body>
</html>
