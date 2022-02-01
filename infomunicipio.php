<?php
session_start();
require_once('includesWeb\daos\DAOConsultor.php');

$nombre = htmlspecialchars(trim(strip_tags($_GET["mun"])));
$municipio = (new DAOConsultor())->getMunicipio($nombre);
$encontrado = false;
if($municipio){
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

    <title>Análisis Financiero del Sector Público - Municipio</title>
</head>
    <body>

        <div id = "cabecera">
            <?php require("includesWeb/comun/cabecera.php");?>  
        </div>

        <div id ="contenido"> 
            <h3>Municipio</h3>
            <?php
            if($encontrado){
                echo '<h2>'.$municipio->getNombre().'</h2>';
                echo '<h2>Información general</h2>';
                echo '<p>Provincia: '.$municipio->getProvincia().'</p>';
                echo '<p>Autonomía: '.$municipio->getAutonomia().'</p>';
                echo '<p>Alcalde del municipio: '.$municipio->getNombreAlcalde().' '.$municipio->getApellido1().' '.$municipio->getApellido2().'</p>';
                echo '<p>Vigencia: '.$municipio->getVigencia().'</p>';
                echo '<p>Partido político'.$municipio->getPartido().'</p>';
                echo '<p>CIF: '.$municipio->getCif().'</p>';
                echo '<p>Via: '.$municipio->getTipoVia().' '.$municipio->getNombreVia().' '.$municipio->getNumVia().'</p>';
                echo '<p>Teléfono: '.$municipio->getTelefono().'</p>';
                echo '<p>Código Postal: '.$municipio->getCodigoPostal().'</p>';
                echo '<p>Fax: '.$municipio->getFax().'</p>';
                echo '<p>Sitio web: '.$municipio->getWeb().'</p>';
                echo '<p>Correo electrónico: '.$municipio->getMail().'</p>';
            }
            else {
                echo '<p>Municipio no encontrado</p>';
            }
            ?>
            
        </div>

        <div id = "pie">
            <?php require("includesWeb/comun/pie.php");?>
        </div>

    </body>
</html>