<?php
session_start();
require_once('includesWeb\daos\DAOConsultor.php');
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

    <title>Análisis Financiero del Sector Público - Inicio</title>
</head>
    <body>

        <div id = "cabecera">
            <?php require("includesWeb/comun/cabecera.php");?>  
        </div>

        <div id ="contenido"> 

            <h2>Informes financieros para la <b>transparencia</b> del sector público</h2>
            <p>Obten información detallada y actualizada sobre las comunidades autónomas, diputaciones y municipios.</p>
            <p>Provincias, diputaciones y municipios en segundos.</p>

            <?php
                $facilities = (new DAOConsultor())->getAllFacilities();
                //print_r($facilities);
            ?>
            <script>
                var nom = <?php echo json_encode($facilities);?>;
                cargarNombres(nom);
            </script>


            <br><br><br><br><br>
            <form autocomplete="off" action="ccaa.php" method="post">
                <div class="autocomplete" style="width:300px;">
                    <input id="facility" type="text" name="facilities" placeholder="Escribir aquí...">
                </div>
                <input type="submit" value="Consultar"> <?php // Meter el onlcik para redirigir a la página ed ccaa, diputacion o municipio?>
            </form>

            <script>
                /*An array containing all the country names in the world:*/
                var facilities = <?php echo json_encode($facilities);?>;
                /*initiate the autocomplete function on the "myInput" element, and pass along the comunidades array as possible autocomplete values:*/
                autocomplete(document.getElementById("facility"));
            </script>

            <br><br>
            <h2>Informes</h2>
            <br>
            <a href="ccaa.php"><button>Comunidad de Madrid (prueba)</button></a>
            <br><br><br><br>
        </div>

        <div id = "pie">
            <?php require("includesWeb/comun/pie.php");?>
        </div>

    </body>
</html>