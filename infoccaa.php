<?php
session_start();
$nombre = htmlspecialchars(trim(strip_tags($_REQUEST["facilities"])));
$ccaa = (new DAOConsultor())->getCCAA($nombre);
$encontrado = false;
if($ccaa){
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

    <title>Análisis Financiero del Sector Público - Comunidad Autónoma</title>
</head>
    <body>
        <div id = "cabecera">
            <?php require("includesWeb/comun/cabecera.php");?>  
        </div>
        
        <div id ="contenido"> 
            <h2>Comunidad de Madrid</h2>
            <?php
            if($encontrado){
                echo '<h2>'.$ccaa->getNombre().'</h2>';
                echo '<h2>Información general</h2>';
                echo '<p>Presidente de la comunidad: '.$ccaa->getNombrePresidente().' '.$ccaa->getApellido1().' '.$ccaa->getApellido2().'</p>';
                echo '<p>Vigencia: '.$ccaa->getVigencia().'</p>';
                echo '<p>Partido político'.$ccaa->getPartido().'</p>';
                echo '<p>CIF: '.$ccaa->getCif().'</p>';
                echo '<p>Via: '.$ccaa->getTipoVia().' '.$ccaa->getNombreVia().' '.$ccaa->getNumVia().'</p>';
                echo '<p>Teléfono: '.$ccaa->getTelefono().'</p>';
                echo '<p>Código Postal: '.$ccaa->getCodigoPostal().'</p>';
                echo '<p>Fax: '.$ccaa->getFax().'</p>';
                echo '<p>Sitio web: '.$ccaa->getWeb().'</p>';
                echo '<p>Correo electrónico: '.$ccaa->getMail().'</p>';
            }
            else {
                echo '<p>Comunidad autónoma no encontrada</p>';
            }
            ?>
        </div>

        <div id = "pie">
            <?php require("includesWeb/comun/pie.php");?>
        </div>
    </body>
</html>