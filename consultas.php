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
    <script src="functions.js"></script>
    <script src="functions2.js"></script>

    <title>Análisis Financiero del Sector Público</title>
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
        

        <div id ="contenidoConsultas">
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
                        <h3>Filtros</h3>
                        <p>Información: Los filtros se usarán para conocer qué entidades cumplen con los siguientes criterios. </p>
                        <br>
                        <input type="radio" id="selectyear" name="selection" value="SelectYear" onclick="hideOption('selection','sel')">
                        <label for="selectyear">Consultar por año</label>
                        <input type="radio" id="selectinterval" name="selection" value="SelectInterval" onclick="hideOption('selection','sel')">
                        <label for="selectinterval">Consultar por intervalo de años</label>
                        <div class="sel" id="indyear">
                            <p>Año</p>
                            <select name="anhoCCAA">
                                <option value="inicio" selected>Seleccione un año</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
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
                            <select id="fromCCAA" name="from" onchange="changeTo('toCCAA','fromCCAA')">
                                <option value="inicio" selected>Seleccione un año</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option> 
                            </select>
                            hasta 
                            <select id="toCCAA" name="to" onchange="changeFrom('fromCCAA', 'toCCAA')">
                                <option value="inicio" selected>Seleccione un año</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option> 
                            </select>
                            </p>
                        </div>
                        <br>
                        <p>Scoring </p>
                        <select name="scoringCCAA">
                            <option value="inicio" selected>Seleccione un rating</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
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
                        <p>PMP</p>
                        <select name="pmpCCAA">
                            <option value="inicio" selected>Seleccione un tramo</option>
                            <option value="tramo1">0 - 10 días</option>
                            <option value="tramo2">10 - 20 días</option>
                            <option value="tramo3">20 - 30 días</option>
                            <option value="tramo4">30 - 40 días</option>
                            <option value="tramo5">40 - 50 días</option>
                            <option value="tramo6">> 50 días</option>
                        </select>
                        <p>Deuda comercial pendiente de pago</p>
                        <select name="dcppCCAA">
                            <option value="inicio" selected>Seleccione un tramo</option>
                            <option value="tramo1">0% - 4%</option>
                            <option value="tramo2">4% - 8%</option>
                            <option value="tramo3">8% - 12%</option>
                            <option value="tramo4">12% - 16%</option>
                            <option value="tramo5">16% - 20%</option>
                            <option value="tramo6">> 20%</option>
                        </select>
                        <p>Ingresos no financieros</p>
                        <select name="ingrnofinCCAA">
                            <option value="inicio" selected>Seleccione un tramo</option>
                            <option value="tramo1">0 - 1M</option>
                            <option value="tramo2">1M - 5M</option>
                            <option value="tramo3">5M - 50M</option>
                            <option value="tramo4">> 50M</option>
                        </select>
                        <br><br>
                        <h3>Mostrar</h3>
                        <p>Información: Las casillas se utilizan para mostrar los campos de las entidades que cumplen con los criterios. Marca la casilla del campo que desea ver</p>
                        <br>
                        <input type="checkbox" id="allCCAA" name="selectAll" value="All" onclick="enableAll('selectCCAA','allCCAA')">
                        <label for="allCCAA"> Seleccionar todo </label><br>

                        <input type="checkbox" id="scoring" class="selectCCAA" name="scoringCCAA_C" value="Scoring" onclick="checkAllButton('selectCCAA','allCCAA')">
                        <label for="scoring"> Scoring </label>
                        <input type="checkbox" id="poblacion" class="selectCCAA" name="poblacionCCAA_C" value="Poblacion" onclick="checkAllButton('selectCCAA','allCCAA')">
                        <label for="poblacion"> Poblacion </label>
                        <input type="checkbox" id="endeudamiento" class="selectCCAA" name="endeudamientoCCAA_C" value="Endeudamiento" onclick="checkAllButton('selectCCAA','allCCAA')">
                        <label for="endeudamiento"> Endeudamiento </label>
                        <input type="checkbox" id="ahorro_neto" class="selectCCAA" name="ahorronetoCCAA_C" value="AhorroNeto" onclick="checkAllButton('selectCCAA','allCCAA')">
                        <label for="ahorro_neto"> Ahorro neto </label>
                        <input type="checkbox" id="pmp" class="selectCCAA" name="pmpCCAA_C" value="PMP" onclick="checkAllButton('selectCCAA','allCCAA')">
                        <label for="pmp"> PMP </label>
                        <input type="checkbox" id="dcpp" class="selectCCAA" name="dcppCCAA_C" value="DCPP" onclick="checkAllButton('selectCCAA','allCCAA')">
                        <label for="dcpp"> Deuda comercial pendiente de pago </label>
                        <input type="checkbox" id="ingrnofin" class="selectCCAA" name="ingrnofinCCAA_C" value="Ingrnofin" onclick="checkAllButton('selectCCAA','allCCAA')">
                        <label for="ingrnofin"> Ingresos no financieros </label>
                        <p>Tipo de gasto</p>
                        <select name="gastoCCAA">
                            <option value="inicio" selected>Seleccione un tramo</option>
                            <option value="personal">Por gastos de personal</option>
                            <option value="bienesservicios">Por gastos de bienes y servicios</option>
                            <option value="financieros">Por gastos financieros</option>
                            <option value="inversiones">Por inversiones</option>
                        </select>
                        <br><br>
                        <button type="submit" class="form-button">Consultar</button>
                    </fieldset>
                </form>
            </div>

            <div id="contentDIP" class="tabcontent">
                <form action='procesarConsultaDIP.php' method='POST'>
                <h3 class="form-name">Consultas de diputaciones</h3>
                    <fieldset>
                        <h3>Filtros</h3>
                        <p>Información: Los filtros se usarán para conocer qué entidades cumplen con los siguientes criterios. </p>
                        <br>
                        <input type="radio" id="selectyearDIP" name="selectionDIP" value="SelectYear" onclick="hideOption('selectionDIP','selDIP')">
                        <label for="selectyearDIP">Consultar por año</label>
                        <input type="radio" id="selectintervalDIP" name="selectionDIP" value="SelectInterval" onclick="hideOption('selectionDIP','selDIP')">
                        <label for="selectintervalDIP">Consultar por intervalo de años</label>

                        <div class="selDIP" id="indyear">
                            <p>Año</p>
                            <select name="anhoDIP">
                                <option value="inicio" selected>Seleccione un año</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
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
                            <select id="fromDIP" name="from" onchange="changeTo('toDIP', 'fromDIP')">
                                <option value="inicio" selected>Seleccione un año</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option> 
                            </select>
                            hasta 
                            <select id="toDIP" name="to" onchange="changeFrom('fromDIP', 'toDIP')">
                                <option value="inicio" selected>Seleccione un año</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option> 
                            </select>
                            </p>
                        </div>
                        <p>Scoring </p>
                        <select name="scoringDIP">
                            <option value="inicio" selected>Seleccione un rating</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                        </select>
                        <p>Comunidad Autónoma</p>
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
                            <option value="tramo4">> 50M</option>
                        </select>
                        <p>PMP</p>
                        <select name="pmpDIP">
                            <option value="inicio" selected>Seleccione un tramo</option>
                            <option value="tramo1">0 - 10 días</option>
                            <option value="tramo2">10 - 20 días</option>
                            <option value="tramo3">20 - 30 días</option>
                            <option value="tramo4">30 - 40 días</option>
                            <option value="tramo5">40 - 50 días</option>
                            <option value="tramo6">> 50 días</option>
                        </select>
                        <p>Ingresos no financieros</p>
                        <select name="ingrnofinDIP">
                            <option value="inicio" selected>Seleccione un tramo</option>
                            <option value="tramo1">0 - 1M</option>
                            <option value="tramo2">1M - 5M</option>
                            <option value="tramo3">5M - 50M</option>
                            <option value="tramo4">> 50M</option>
                        </select>
                        <br><br>
                        <h3>Mostrar</h3>
                        <p>Información: Las casillas se utilizan para mostrar los campos de las entidades que cumplen con los criterios. Marca la casilla del campo que desea ver</p>
                        <br>
                        <input type="checkbox" id="allDIP" name="selectAll" value="All" onclick="enableAll('selectDIP','allDIP')">
                        <label for="allDIP"> Seleccionar todo </label><br>

                        <input type="checkbox" id="scoringDIP" class="selectDIP" name="scoringDIP_C" value="Scoring" onclick="checkAllButton('selectDIP','allDIP')">
                        <label for="scoringDIP"> Scoring </label>
                        <input type="checkbox" id="autonomiaDIP" class="selectDIP" name="autonomiaDIP_C" value="Autonomia" onclick="checkAllButton('selectDIP','allDIP')">
                        <label for="autonomiaDIP"> Comunidad Autónoma </label>
                        <input type="checkbox" id="endeudamientoDIP" class="selectDIP" name="endeudamientoDIP_C" value="Endeudamiento" onclick="checkAllButton('selectDIP','allDIP')">
                        <label for="endeudamientoDIP"> Endeudamiento </label>
                        <input type="checkbox" id="ahorro_netoDIP" class="selectDIP" name="ahorronetoDIP_C" value="AhorroNeto" onclick="checkAllButton('selectDIP','allDIP')">
                        <label for="ahorro_netoDIP"> Ahorro neto </label>
                        <input type="checkbox" id="fondliqDIP" class="selectDIP" name="fondliqDIP_C" value="FondLiq" onclick="checkAllButton('selectDIP','allDIP')">
                        <label for="fondliqDIP"> Fondos líquidos </label>
                        <input type="checkbox" id="pmpDIP" class="selectDIP" name="pmpDIP_C" value="PMP" onclick="checkAllButton('selectDIP','allDIP')">
                        <label for="pmpDIP"> PMP </label>
                        <input type="checkbox" id="ingrnofinDIP" class="selectDIP" name="ingrnofinDIP_C" value="Ingrnofin" onclick="checkAllButton('selectDIP','allDIP')">
                        <label for="ingrnofinDIP"> Ingresos no financieros </label>
                        <p>Tipo de gasto</p>
                        <select name="gastoDIP">
                            <option value="inicio" selected>Seleccione un tramo</option>
                            <option value="personal">Por gastos de personal</option>
                            <option value="bienesservicios">Por gastos de bienes y servicios</option>
                            <option value="financieros">Por gastos financieros</option>
                            <option value="inversiones">Por inversiones</option>
                        </select>
                        <br><br>
                        <button type="submit" class="form-button">Consultar</button>
                    </fieldset>
                </form>
            </div>

            <div id="contentMUN" class="tabcontent">
                <form action='procesarConsultaMUN.php' method='POST'>
                <h3 class="form-name">Consultas de municipios</h3>
                    <fieldset class="fieldsetConsultasMUN">
                        <h3>Filtros</h3>
                        <p>Información: Los filtros se usarán para conocer qué entidades cumplen con los siguientes criterios. </p>
                        <br>
                        <input type="radio" id="selectyearMUN" name="selectionMUN" value="SelectYear" onclick="hideOption('selectionMUN','selMUN')">
                        <label for="selectyearMUN">Consultar por año</label>
                        <input type="radio" id="selectintervalMUN" name="selectionMUN" value="SelectInterval" onclick="hideOption('selectionMUN','selMUN')">
                        <label for="selectintervalMUN">Consultar por intervalo de años</label>
                        <div class="selMUN" id="indyear">
                            <p>Año</p>
                            <select name="anhoMUN">
                                <option value="inicio" selected>Seleccione un año</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
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
                            <select id="fromMUN" name="from" onchange="changeTo('toMUN','fromMUN')">
                                <option value="inicio" selected>Seleccione un año</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option> 
                            </select>
                            hasta 
                            <select id="toMUN" name="to" onchange="changeFrom('fromMUN','toMUN')">
                                <option value="inicio" selected>Seleccione un año</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option> 
                            </select>
                            </p>
                        </div>
                        <p>Scoring </p>
                        <select name="scoringMUN">
                            <option value="inicio" selected>Seleccione un rating</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                        </select>
                        <p>Población</p>
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
                        <p>Comunidad Autónoma</p>
                        <select id="ccaaMUN" name="autonomiasMUN">
                            <option value="inicio" selected>Seleccione una autonomía</option>
                            <?php
                            foreach($ccaaCombobox as $ccaa){
                                echo '<option value="'.$ccaa->getCodigo().'">'.$ccaa->getNombre().'</option>';
                            }
                            ?>
                        </select>
                        <p>Provincia</p>
                        <select id="provMUN" name="provinciasMUN">
                            <option value="inicio" selected>Seleccione una provincia</option>
                            <?php
                            foreach($provCombobox as $prov){
                                echo '<option value="'.$prov->getCodigo().'">'.$prov->getNombre().'</option>';
                            }
                            ?>
                        </select>
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
                            <option value="tramo4">> 50M</option>
                        </select>
                        <p>PMP</p>
                        <select name="pmpMUN">
                            <option value="inicio" selected>Seleccione un tramo</option>
                            <option value="tramo1">0 - 10 días</option>
                            <option value="tramo2">10 - 20 días</option>
                            <option value="tramo3">20 - 30 días</option>
                            <option value="tramo4">30 - 40 días</option>
                            <option value="tramo5">40 - 50 días</option>
                            <option value="tramo6">> 50 días</option>
                        </select>
                        <p>Ingresos no financieros</p>
                        <select name="ingrnofinMUN">
                            <option value="inicio" selected>Seleccione un tramo</option>
                            <option value="tramo1">0 - 1M</option>
                            <option value="tramo2">1M - 5M</option>
                            <option value="tramo3">5M - 50M</option>
                            <option value="tramo4">> 50M</option>
                        </select>
                        <br><br>
                        <h3>Mostrar</h3>
                        <p>Información: Las casillas se utilizan para mostrar los campos de las entidades que cumplen con los criterios. Marca la casilla del campo que desea ver</p>
                        <br>
                        <input type="checkbox" id="allMUN" name="selectAll" value="All" onclick="enableAll('selectMUN','allMUN')">
                        <label for="allMUN"> Seleccionar todo </label><br>

                        <input type="checkbox" id="scoringMUN" class="selectMUN" name="scoringMUN_C" value="Scoring" onclick="checkAllButton('selectMUN','allMUN')">
                        <label for="scoringMUN"> Scoring </label>
                        <input type="checkbox" id="poblacionMUN" class="selectMUN" name="poblacionMUN_C" value="Poblacion" onclick="checkAllButton('selectMUN','allMUN')">
                        <label for="poblacionMUN"> Poblacion </label>
                        <input type="checkbox" id="autonomiaMUN" class="selectMUN" name="autonomiaMUN_C" value="Autonomia" onclick="checkAllButton('selectMUN','allMUN')">
                        <label for="autonomiaMUN"> Comunidad Autónoma </label>
                        <input type="checkbox" id="provinciaMUN" class="selectMUN" name="provinciaMUN_C" value="Provincia" onclick="checkAllButton('selectMUN','allMUN')">
                        <label for="provinciaMUN"> Provincia </label>
                        <input type="checkbox" id="endeudamientoMUN" class="selectMUN" name="endeudamientoMUN_C" value="Endeudamiento" onclick="checkAllButton('selectMUN','allMUN')">
                        <label for="endeudamientoMUN"> Endeudamiento </label>
                        <input type="checkbox" id="ahorro_netoMUN" class="selectMUN" name="ahorronetoMUN_C" value="AhorroNeto" onclick="checkAllButton('selectMUN','allMUN')">
                        <label for="ahorro_netoMUN"> Ahorro neto </label>
                        <input type="checkbox" id="fondliqMUN" class="selectMUN" name="fondliqMUN_C" value="FondLiq" onclick="checkAllButton('selectMUN','allMUN')">
                        <label for="fondliqMUN"> Fondos líquidos </label>
                        <input type="checkbox" id="pmpMUN" class="selectMUN" name="pmpMUN_C" value="PMP" onclick="checkAllButton('selectMUN','allMUN')">
                        <label for="pmpMUN"> PMP </label>
                        <input type="checkbox" id="ingrnofinMUN" class="selectMUN" name="ingrnofinMUN_C" value="Ingrnofin" onclick="checkAllButton('selectMUN','allMUN')">
                        <label for="ingrnofinMUN"> Ingresos no financieros </label>
                        <p>Tipo de gasto</p>
                        <select name="gastoMUN">
                            <option value="inicio" selected>Seleccione un tipo</option>
                            <option value="personal">Por gastos de personal</option>
                            <option value="bienesservicios">Por gastos de bienes y servicios</option>
                            <option value="financieros">Por gastos financieros</option>
                            <option value="inversiones">Por inversiones</option>
                        </select>
                        <p>Programa de gasto</p>
                        <select name="progMUN">
                            <option value="inicio" selected>Seleccione un tipo</option>
                            <option value="agspc">Administración general de la seguridad y protección civil</option>
                            <option value="sop">Seguridad y orden público</option>
                            <option value="ote">Ordenación del tráfico y del estacionamiento</option>
                            <option value="mu">Movilidad urbana</option>
                            <option value="pc">Protección civil</option>
                            <option value="spei">Servicio de prevención y extinción de incendios</option>
                            <option value="pgvpp">Promoción y gestión de vivienda de protección pública</option>
                            <option value="cre">Conservación y rehabilitación de la edificación</option>
                            <option value="pvp">Pavimentación de vías públicas</option>
                            <option value="a">Alcantarillado</option>
                            <option value="rgtr">Recogida, gestión y tratamiento de residuos</option>
                            <option value="rr">Recogida de residuos</option>
                            <option value="grsu">Gestión de residuos sólidos urbanos</option>
                            <option value="tr">Tratamiento de residuos</option>
                            <option value="lv">Limpieza viaria</option>
                            <option value="csf">Cementerios y servicios funerarios</option>
                            <option value="ap">Alumbrado público</option>
                            <option value="pj">Parques y jardines</option>
                            <option value="p">Pensiones</option>
                            <option value="ssps">Servicios sociales y promoción social</option>
                            <option value="fe">Fomento del empleo</option>
                            <option value="s">Sanidad</option>
                            <option value="e">Educación</option>
                            <option value="c">Cultura</option>
                            <option value="d">Deporte</option>
                            <option value="agp">Agricultura, ganadería y pesca</option>
                            <option value="ie">Industria y energía</option>
                            <option value="com">Comercio</option>
                            <option value="tp">Transporte público</option>
                            <option value="it">Infraestructuras del transporte</option>
                            <option value="idi">Investigación, desarrollo e innovación</option>
                        </select>
                        <br><br>
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