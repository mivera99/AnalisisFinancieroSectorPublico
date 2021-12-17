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

    <title>Análisis Financiero del Sector Público</title>
</head>
    <body>

        <div id = "cabecera">
            <?php require("includesWeb/comun/cabecera.php");?>  
        </div>

        <div id ="contenido"> 

            <?php
                /*
                <h2>Informes financieros para la <b>transparencia</b> del sector público</h2>
                <p>Obten información detallada y actualizada sobre CCAAs.</p>
                <p>Provincias, diputaciones y municipios en segundos.</p>
                <br><br>
                */
            ?>

            <h2>Informes</h2>
            <br>
            <a href="ccaa.php"><button>Comunidad de Madrid (prueba)</button></a>
            <br><br><br><br>
            

            <form action='procesarSubida.php' method='POST' enctype="multipart/form-data">
            <!--<form action='imports/import_bg_ccaa.php'  method='POST' enctype='multipart/form-data'>-->
                <h2 class="form-name">Subir archivo</h2>
                <br>
                <fieldset>
                    <p>Selecciona el archivo: </p><input type='file' name='file_button'> <br><br> 
                    <br><br><br>
                    <button type="submit" class="form-button">Enviar</button>
                </fieldset>
            </form>
            <br><br>

        </div>

        <div id = "pie">
            <?php require("includesWeb/comun/pie.php");?>
        </div>

    </body>
</html>