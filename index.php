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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    
    <!--  ====== FUNCIÓN AUTOCOMPLETAR BÚSQUEDA ===== -->
    <script src="functions.js"></script>
    <script src="functions2.js"></script>
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
            <script>
                cargarNombres();
            </script>
            <br><br>
            
            <form autocomplete="off" action="redirect.php" method="post">
                <div class="autocomplete">
                    <input id="facility" type="text" name="facilities" placeholder="Escribir aquí...">
                    <!--<select name="year">
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                    </select>-->
                    <button>Consultar</button>
                </div>
            </form>

            <script>
                autocomplete(document.getElementById("facility"));
            </script>
            <?php
                if (isset($show_message)) {
                    echo "<script>alert('{$show_message}');</script>";
                    $show_message=null;
                }
            ?>
        </div>

        <div id = "pie">
            <?php require("includesWeb/comun/pie.php");?>
        </div>

    </body>
</html>