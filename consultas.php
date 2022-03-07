<?php
session_start();
require_once('includesWeb/daos/DAOConsultor.php');

$ccaaCombobox = (new DAOConsultor())->getAllCCAAs();
$provCombobox = (new DAOConsultor())->getAllProvincias();

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
    <script src="functions2.js"></script>

    <script src="node_modules/chart.js/dist/chart.js"></script>

    <title>Análisis Financiero del Sector Público</title>
</head>
    <body>
        <div id = "cabecera">
            <?php require("includesWeb/comun/cabecera.php");?>  
        </div>

        <div id ="contenido">
            <script>
                resetFields();
            </script>
            <div class="tab">  
                <button class="tablinks" onclick="showFacility(event, 'contentCCAA')">Comunidades Autónomas</button>
                <button class="tablinks" onclick="showFacility(event, 'contentDIP')">Diputaciones</button>
                <button class="tablinks" onclick="showFacility(event, 'contentMUN')">Municipios</button>
            </div>

            <div id="contentCCAA" class="tabcontent">
                <form action='procesarConsultaCCAA.php' method='POST'>
                    <h3 class="form-name">Consultas de comunidades autónomas</h3>
                    <fieldset>
                        <!--<script> hideOption(); </script>-->
                        <input type="radio" id="selectyear" name="selection" value="SelectYear" onclick="hideOption('selection','sel')">
                        <label for="selectyear">Consultar por año</label>
                        <input type="radio" id="selectinterval" name="selection" value="SelectInterval" onclick="hideOption('selection','sel')">
                        <label for="selectinterval">Consultar por intervalo de años</label>
                        <div class="sel" id="indyear">
                            <p>Año</p>
                            <select name="anhoCCAA">
                                <option value="inicio" selected>Seleccione un año</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                            </select>           
                        </div>
                        <div class="sel" id="interval">
                            <p><b>Rango de años</b></p>
                            <p>Desde 
                            <select name="from">
                                <option value="inicio" selected>Seleccione un año</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option> 
                            </select>
                            hasta 
                            <select name="to">
                                <option value="inicio" selected>Seleccione un año</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option> 
                            </select>
                            </p>
                        </div>
                        <br><br>
                        <p>Scoring </p><!--<input type="text" maxlength="1" name="scoringCCAA"/>-->
                        <select name="scoringCCAA">
                            <option value="inicio" selected>Seleccione un rating</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                            <option value="F">F</option>
                        </select>
                        <p>Población </p>
                        <select name="poblacionCCAA">
                            <option value="inicio" selected>Seleccione un tramo de población</option>
                            <option value="tramo1">0 - 750.000</option>
                            <option value="tramo2">750.000 - 1.500.000</option>
                            <option value="tramo3">1.500.000 - 3.000.000</option>
                            <option value="tramo4">3.000.000 - 6.000.000</option>
                            <option value="tramo5">> 6.000.000</option>
                        </select>
                        <!--<input type='number' min="1" name="poblacionCCAA">--> <br><br>
                        <!--<p>Cantidad mínima <input type="number" id="minVal" name="min" min="0" onchange="compareMin()"/> Cantidad máxima<input type="number" id="maxVal" name="max" min="1" onchange="compareMax()"/></p>-->
                        <p>Endeudamiento</p>
                        <select name="endeudamientoCCAA">
                            <option value="inicio" selected>Seleccione un tramo</option>
                            <option value="tramo1">0% - 20%</option>
                            <option value="tramo2">20% - 40%</option>
                            <option value="tramo3">40% - 80%</option>
                            <option value="tramo4">80% - 120%</option>
                            <option value="tramo5">> 120%</option>
                        </select>
                        <p>Ahorro neto</p>
                        <select name="ahorro_netoCCAA">
                            <option value="inicio" selected>Seleccione un tramo</option>
                            <option value="tramo1">< -20%</option>
                            <option value="tramo2">-20% - 0%</option>
                            <option value="tramo3">0% - 20%</option>
                            <option value="tramo4">20% - 50%</option>
                            <option value="tramo5">> 50%</option>
                        </select>
                        <p>Fondos líquidos</p>
                        <select name="fondliqCCAA">
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
                        <input type="radio" id="selectyearDIP" name="selectionDIP" value="SelectYear" onclick="hideOption('selectionDIP','selDIP')">
                        <label for="selectyearDIP">Consultar por año</label>
                        <input type="radio" id="selectintervalDIP" name="selectionDIP" value="SelectInterval" onclick="hideOption('selectionDIP','selDIP')">
                        <label for="selectintervalDIP">Consultar por intervalo de años</label>
                        <div class="selDIP" id="indyear">
                            <p>Año</p>
                            <select name="anhoDIP">
                                <option value="inicio" selected>Seleccione un año</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                            </select>           
                        </div>
                        <div class="selDIP" id="interval">
                            <p><b>Rango de años</b></p>
                            <p>Desde 
                            <select name="from">
                                <option value="inicio" selected>Seleccione un año</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option> 
                            </select>
                            hasta 
                            <select name="to">
                                <option value="inicio" selected>Seleccione un año</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option> 
                            </select>
                            </p>
                        </div>
                        <!--<p>Año</p>
                        <select name="anhoDIP">
                            <option value="inicio" selected>Seleccione un año</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                        </select>-->
                        <p>Scoring </p><!--<input type="text" maxlength="1" name="scoringDIP"/>-->
                        <select name="scoringDIP">
                            <option value="inicio" selected>Seleccione un rating</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                            <option value="F">F</option>
                        </select>
                        <!--<p>Cantidad mínima <input type="number" id="minVal" name="min" min="0" onchange="compareMin()"/> Cantidad máxima<input type="number" id="maxVal" name="max" min="1" onchange="compareMax()"/></p>-->
                        <p>Provincia</p>
                        <select name="provinciasDIP">
                            <option value="inicio" selected>Seleccione una provincia</option>
                            <?php
                            foreach($provCombobox as $prov){
                                echo '<option value="'.$prov->getCodigo().'">'.$prov->getNombre().'</option>';
                            }
                            ?>
                        </select>
                        <p>Autonomía</p>
                        <select name="autonomiasDIP">
                            <option value="inicio" selected>Seleccione una autonomía</option>
                            <?php
                            foreach($ccaaCombobox as $ccaa){
                                echo '<option value="'.$ccaa->getCodigo().'">'.$ccaa->getNombre().'</option>';
                            }
                            ?>
                        </select>
                        <p>Endeudamiento</p>
                        <select name="endeudamientoDIP">
                            <option value="inicio" selected>Seleccione un tramo</option>
                            <option value="tramo1">0% - 20%</option>
                            <option value="tramo2">20% - 40%</option>
                            <option value="tramo3">40% - 80%</option>
                            <option value="tramo4">80% - 120%</option>
                            <option value="tramo5">> 120%</option>
                        </select>
                        <p>Ahorro neto</p>
                        <select name="ahorro_netoDIP">
                            <option value="inicio" selected>Seleccione un tramo</option>
                            <option value="tramo1">< -20%</option>
                            <option value="tramo2">-20% - 0%</option>
                            <option value="tramo3">0% - 20%</option>
                            <option value="tramo4">20% - 50%</option>
                            <option value="tramo5">> 50%</option>
                        </select>
                        <p>Fondos líquidos</p>
                        <select name="fondliqDIP">
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
                        <input type="radio" id="selectyearMUN" name="selectionMUN" value="SelectYear" onclick="hideOption('selectionMUN','selMUN')">
                        <label for="selectyearMUN">Consultar por año</label>
                        <input type="radio" id="selectintervalMUN" name="selectionMUN" value="SelectInterval" onclick="hideOption('selectionMUN','selMUN')">
                        <label for="selectintervalMUN">Consultar por intervalo de años</label>
                        <div class="selMUN" id="indyear">
                            <p>Año</p>
                            <select name="anhoMUN">
                                <option value="inicio" selected>Seleccione un año</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                            </select>           
                        </div>
                        <div class="selMUN" id="interval">
                            <p><b>Rango de años</b></p>
                            <p>Desde 
                            <select name="from">
                                <option value="inicio" selected>Seleccione un año</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option> 
                            </select>
                            hasta 
                            <select name="to">
                                <option value="inicio" selected>Seleccione un año</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option> 
                            </select>
                            </p>
                        </div>
                        <!--<p>Año</p>
                        <select name="anhoMUN">
                            <option value="inicio" selected>Seleccione un año</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                        </select>-->
                        <p>Scoring </p><!--<input type="text" maxlength="1" name="scoringMUN"/>-->
                        <select name="scoringMUN">
                            <option value="inicio" selected>Seleccione un rating</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                            <option value="F">F</option>
                        </select>
                        <p>Población</p> <!--</p><input type='number' min="1" name="poblacionMUN">-->
                        <select name="poblacionMUN">
                            <option value="inicio" selected>Seleccione un tramo de población</option>
                            <option value="tramo1">0 - 100</option>
                            <option value="tramo2">100 - 500</option>
                            <option value="tramo3">500 - 1.000</option>
                            <option value="tramo4">1.000 - 2.000</option>
                            <option value="tramo5">2.000 - 5.000</option>
                            <option value="tramo6">5.000 - 10.000</option>
                            <option value="tramo7">10.000 - 20.000</option>
                            <option value="tramo8">20.000 - 50.000</option>
                            <option value="tramo9">50.000 - 100.000</option>
                            <option value="tramo10">100.000 - 500.000</option>
                            <option value="tramo11">> 500.000</option>
                        </select>
                        <p>Provincia</p>
                        <select name="provinciasMUN">
                            <option value="inicio" selected>Seleccione una provincia</option>
                            <?php
                            foreach($provCombobox as $prov){
                                echo '<option value="'.$prov->getCodigo().'">'.$prov->getNombre().'</option>';
                            }
                            ?>
                        </select>
                        <p>Autonomía</p>
                        <select name="autonomiasMUN">
                            <option value="inicio" selected>Seleccione una autonomía</option>
                            <?php
                            foreach($ccaaCombobox as $ccaa){
                                echo '<option value="'.$ccaa->getCodigo().'">'.$ccaa->getNombre().'</option>';
                            }
                            ?>
                        </select>
                        <!--<p>Cantidad mínima <input type="number" id="minVal" name="min" min="0" onchange="compareMin()"/> Cantidad máxima<input type="number" id="maxVal" name="max" min="1" onchange="compareMax()"/></p>-->
                        <p>Endeudamiento</p>
                        <select name="endeudamientoMUN">
                            <option value="inicio" selected>Seleccione un tramo</option>
                            <option value="tramo1">0% - 20%</option>
                            <option value="tramo2">20% - 40%</option>
                            <option value="tramo3">40% - 80%</option>
                            <option value="tramo4">80% - 120%</option>
                            <option value="tramo5">> 120%</option>
                        </select>
                        <p>Ahorro neto</p>
                        <select name="ahorro_netoMUN">
                            <option value="inicio" selected>Seleccione un tramo</option>
                            <option value="tramo1">< -20%</option>
                            <option value="tramo2">-20% - 0%</option>
                            <option value="tramo3">0% - 20%</option>
                            <option value="tramo4">20% - 50%</option>
                            <option value="tramo5">> 50%</option>
                        </select>
                        <p>Fondos líquidos</p>
                        <select name="fondliqMUN">
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