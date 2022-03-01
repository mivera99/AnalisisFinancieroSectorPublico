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

    <script src="node_modules/chart.js/dist/chart.js"></script>

    <title>Análisis Financiero del Sector Público</title>
</head>
    <body>
        <div id = "cabecera">
            <?php require("includesWeb/comun/cabecera.php");?>  
        </div>

        <div id ="contenido">
            <div class="tab">  
                <button class="tablinks" onclick="showFacility(event, 'contentCCAA')">Comunidades Autónomas</button>
                <button class="tablinks" onclick="showFacility(event, 'contentDIP')">Diputaciones</button>
                <button class="tablinks" onclick="showFacility(event, 'contentMUN')">Municipios</button>
            </div>

            <div id="contentCCAA" class="tabcontent">
                <form action='procesarConsultaCCAA.php' method='POST'>
                    <h3 class="form-name">Consultas de comunidades autónomas</h3>
                    <fieldset>
                        <p>Scoring </p><input type="text" maxlength="1" name="scoringCCAA" required/>
                        <p>Población </p><input type='number' min="1" name="poblacionCCAA" required> <br><br>
                        <!--<p>Cantidad mínima <input type="number" id="minVal" name="min" min="0" onchange="compareMin()"/> Cantidad máxima<input type="number" id="maxVal" name="max" min="1" onchange="compareMax()"/></p>-->
                        <p>Endeudamiento</p>
                        <select class="endeudamientoCCAA">
                            <option value="inicio" selected>Seleccione un tramo</option>
                            <option value="tramo1">0% - 20%</option>
                            <option value="tramo2">20% - 40%</option>
                            <option value="tramo3">40% - 80%</option>
                            <option value="tramo4">80% - 120%</option>
                            <option value="tramo5">> 120%</option>
                        </select>
                        <p>Ahorro neto</p>
                        <select class="ahorro_netoCCAA">
                            <option value="inicio" selected>Seleccione un tramo</option>
                            <option value="tramo1">< -20%</option>
                            <option value="tramo2">-20% - 0%</option>
                            <option value="tramo3">0% - 20%</option>
                            <option value="tramo4">20% - 50%</option>
                            <option value="tramo5">> 50%</option>
                        </select>
                        <p>Fondos líquidos</p>
                        <select class="fondliqCCAA">
                            <option value="inicio" selected>Seleccione un tramo</option>
                            <option value="tramo1">0 - 1M</option>
                            <option value="tramo2">1M - 5M</option>
                            <option value="tramo3">5M - 50M</option>
                            <option value="tramo4">< 50M</option>
                        </select>
                        <br>
                        <button type="submit" class="form-button">Consultar</button>
                    </fieldset>
                </form>
            </div>

            <div id="contentDIP" class="tabcontent">
                <form action='procesarConsultaDIP.php' method='POST'>
                <h3 class="form-name">Consultas de diputaciones</h3>
                    <fieldset>
                        <p>Scoring </p><input type="text" maxlength="1" name="scoringDIP" required/>
                        <!--<p>Cantidad mínima <input type="number" id="minVal" name="min" min="0" onchange="compareMin()"/> Cantidad máxima<input type="number" id="maxVal" name="max" min="1" onchange="compareMax()"/></p>-->
                        <p>Endeudamiento</p>
                        <select class="endeudamientoDIP">
                            <option value="inicio" selected>Seleccione un tramo</option>
                            <option value="tramo1">0% - 20%</option>
                            <option value="tramo2">20% - 40%</option>
                            <option value="tramo3">40% - 80%</option>
                            <option value="tramo4">80% - 120%</option>
                            <option value="tramo5">> 120%</option>
                        </select>
                        <p>Ahorro neto</p>
                        <select class="ahorro_netoDIP">
                            <option value="inicio" selected>Seleccione un tramo</option>
                            <option value="tramo1">< -20%</option>
                            <option value="tramo2">-20% - 0%</option>
                            <option value="tramo3">0% - 20%</option>
                            <option value="tramo4">20% - 50%</option>
                            <option value="tramo5">> 50%</option>
                        </select>
                        <p>Fondos líquidos</p>
                        <select class="fondliqDIP">
                            <option value="inicio" selected>Seleccione un tramo</option>
                            <option value="tramo1">0 - 1M</option>
                            <option value="tramo2">1M - 5M</option>
                            <option value="tramo3">5M - 50M</option>
                            <option value="tramo4">< 50M</option>
                        </select>
                        <br>
                        <button type="submit" class="form-button">Consultar</button>
                    </fieldset>
                </form>
            </div>

            <div id="contentMUN" class="tabcontent">
                <form action='procesarConsultaMUN.php' method='POST'>
                <h3 class="form-name">Consultas de municipios</h3>
                    <fieldset>
                        <p>Scoring </p><input type="text" maxlength="1" name="scoringMUN" required/>
                        <p>Población </p><input type='number' min="1" name="poblacionMUN" required> <br><br>
                        <!--<p>Cantidad mínima <input type="number" id="minVal" name="min" min="0" onchange="compareMin()"/> Cantidad máxima<input type="number" id="maxVal" name="max" min="1" onchange="compareMax()"/></p>-->
                        <p>Endeudamiento</p>
                        <select class="endeudamientoMUN">
                            <option value="inicio" selected>Seleccione un tramo</option>
                            <option value="tramo1">0% - 20%</option>
                            <option value="tramo2">20% - 40%</option>
                            <option value="tramo3">40% - 80%</option>
                            <option value="tramo4">80% - 120%</option>
                            <option value="tramo5">> 120%</option>
                        </select>
                        <p>Ahorro neto</p>
                        <select class="ahorro_netoMUN">
                            <option value="inicio" selected>Seleccione un tramo</option>
                            <option value="tramo1">< -20%</option>
                            <option value="tramo2">-20% - 0%</option>
                            <option value="tramo3">0% - 20%</option>
                            <option value="tramo4">20% - 50%</option>
                            <option value="tramo5">> 50%</option>
                        </select>
                        <p>Fondos líquidos</p>
                        <select class="fondliqMUN">
                            <option value="inicio" selected>Seleccione un tramo</option>
                            <option value="tramo1">0 - 1M</option>
                            <option value="tramo2">1M - 5M</option>
                            <option value="tramo3">5M - 50M</option>
                            <option value="tramo4">< 50M</option>
                        </select>
                        
                        <br> 
                        <button type="submit" class="form-button">Consultar</button>
                    </fieldset>
                </form>
            </div>

        </div>

        <div id = "pie">
            <?php require("includesWeb/comun/pie.php");?>
        </div>
    </body>
</html>