<?php
session_start();
require_once('includesWeb/daos/DAOConsultor.php');

$scoring = NULL;
$poblacion = NULL;
$endeudamiento = NULL;
$ahorro_neto = NULL;
$fondliq = NULL;
$anho = NULL;
$pmp=NULL;
$ingrnofin=NULL;
$gasto=NULL;

$choice = NULL;
$from=NULL;
$to=NULL;
$autonomia=NULL;
$provincia=NULL;

$checked_boxes=array();

if(!empty($_REQUEST['scoringMUN_C'])) array_push($checked_boxes, true);
else array_push($checked_boxes,false);
if(!empty($_REQUEST['poblacionMUN_C'])) array_push($checked_boxes, true);
else array_push($checked_boxes,false);
if(!empty($_REQUEST['autonomiaMUN_C'])) array_push($checked_boxes, true);
else array_push($checked_boxes,false);
if(!empty($_REQUEST['provinciaMUN_C'])) array_push($checked_boxes, true);
else array_push($checked_boxes,false);
if(!empty($_REQUEST['endeudamientoMUN_C'])) array_push($checked_boxes, true);
else array_push($checked_boxes,false);
if(!empty($_REQUEST['ahorronetoMUN_C'])) array_push($checked_boxes, true);
else array_push($checked_boxes,false);
if(!empty($_REQUEST['fondliqMUN_C'])) array_push($checked_boxes, true);
else array_push($checked_boxes,false);
if(!empty($_REQUEST['pmpMUN_C'])) array_push($checked_boxes, true);
else array_push($checked_boxes,false);
if(!empty($_REQUEST['ingrnofinMUN_C'])) array_push($checked_boxes, true);
else array_push($checked_boxes,false);


if(!empty($_REQUEST['scoringMUN']) && $_REQUEST['scoringMUN']!='inicio'){
    $scoring = htmlspecialchars(trim(strip_tags($_REQUEST['scoringMUN'])));
}

if(!empty($_REQUEST['poblacionMUN'])&& $_REQUEST['poblacionMUN']!='inicio'){
    $poblacion = htmlspecialchars(trim(strip_tags($_REQUEST['poblacionMUN'])));
}

if(!empty($_REQUEST['endeudamientoMUN']) && $_REQUEST['endeudamientoMUN']!='inicio'){
    $endeudamiento = htmlspecialchars(trim(strip_tags($_REQUEST['endeudamientoMUN'])));
}

if(!empty($_REQUEST['ahorro_netoMUN']) && $_REQUEST['ahorro_netoMUN']!='inicio'){
    $ahorro_neto = htmlspecialchars(trim(strip_tags($_REQUEST['ahorro_netoMUN'])));
}

if(!empty($_REQUEST['fondliqMUN']) && $_REQUEST['fondliqMUN']!='inicio'){
    $fondliq = htmlspecialchars(trim(strip_tags($_REQUEST['fondliqMUN'])));
}

if(!empty($_REQUEST['pmpMUN']) && $_REQUEST['pmpMUN']!='inicio'){
    $pmp = htmlspecialchars(trim(strip_tags($_REQUEST['pmpMUN'])));
}

if(!empty($_REQUEST['ingrnofinMUN']) && $_REQUEST['ingrnofinMUN']!='inicio'){
    $ingrnofin = htmlspecialchars(trim(strip_tags($_REQUEST['ingrnofinMUN'])));
}

if(!empty($_REQUEST['gastoMUN']) && $_REQUEST['gastoMUN']!='inicio'){
    $gasto = htmlspecialchars(trim(strip_tags($_REQUEST['gastoMUN'])));
}

if(isset($_REQUEST['selectionMUN'])){
    $choice = htmlspecialchars(trim(strip_tags($_REQUEST['selectionMUN'])));
    if($choice == 'SelectYear'){
        //echo '<p>Radio button del año pulsado</p><br>';
        if(!empty($_REQUEST['anhoMUN']) && $_REQUEST['anhoMUN']!='inicio'){
            //echo '<p>El año tiene un valor que no es inicio</p><br>';
            $anho = htmlspecialchars(trim(strip_tags($_REQUEST['anhoMUN'])));
        }
    }
    else {
        //echo '<p>Radio button pulsado</p><br>';
        if(!empty($_REQUEST['from']) && !empty($_REQUEST['to'])){
            if($_REQUEST['from']!='inicio'){
                //echo '<p>El año from tiene un valor que no es inicio</p><br>';
                $from = htmlspecialchars(trim(strip_tags($_REQUEST['from'])));
            }
            //echo '<p>valor de from: '.$from.'</p><br>';
            if($_REQUEST['to']!='inicio'){
                //echo '<p>El año to tiene un valor que no es inicio</p><br>';
                $to = htmlspecialchars(trim(strip_tags($_REQUEST['to'])));
            }
            //echo '<p>valor de to: '.$to.'</p><br>';
        
        }
    }
}

if(!empty($_REQUEST['autonomiasMUN']) && $_REQUEST['autonomiasMUN']!='inicio'){
    $autonomia = htmlspecialchars(trim(strip_tags($_REQUEST['autonomiasMUN'])));
}

if(!empty($_REQUEST['provinciasMUN']) && $_REQUEST['provinciasMUN']!='inicio'){
    $provincia = htmlspecialchars(trim(strip_tags($_REQUEST['provinciasMUN'])));
}

$muns = (new DAOConsultor())->consultarMUNs($scoring, $poblacion, $endeudamiento, $ahorro_neto, $fondliq, $choice, $anho, $from, $to, $autonomia, $provincia, $pmp, $ingrnofin, $gasto, $checked_boxes);
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
    <title>Análisis Financiero Sector Público - Consulta MUNs</title>
</head>
<body>
<div id="contenedor">

<div id="cabecera">
    <?php
        require('includesWeb/comun/cabecera.php');
    ?>
</div>
<div id="consultaMUN">
    <?php
    if(count($muns)>0){
        echo '<p>Se han encontrado '.count($muns).' resultados</p>';
        $year=0;
        $i=0;
        while($i<count($muns)){
            echo '<h2>'.key($muns[$i]).'</h2>';
            echo '<table>';
            $year = key($muns[$i]);
            echo '<tr>';
            echo '<td></td>';
            echo '<td>Nombre</td>';
            if(!empty($scoring)|| $checked_boxes[0]) echo '<td class="ratingCell">Scoring</td>';
            if(!empty($poblacion)|| $checked_boxes[1]) echo '<td class="ratingCell">Población</td>';
            if(!empty($autonomia)|| $checked_boxes[2]) echo '<td class="ratingCell">Comunidad Autónoma</td>';
            if(!empty($provincia)|| $checked_boxes[3]) echo '<td class="ratingCell">Provincia</td>';
            if(!empty($endeudamiento)|| $checked_boxes[4]) echo '<td class="ratingCell">Endeudamiento</td>';
            if(!empty($ahorro_neto)|| $checked_boxes[5]) echo '<td class="ratingCell">Ahorro neto</td>';
            if(!empty($pmp)|| $checked_boxes[6]) echo '<td class="ratingCell">PMP</td>';
            if(!empty($fondliq)|| $checked_boxes[7]) echo '<td class="ratingCell">Fondos líquidos</td>';
            if(!empty($ingrnofin)|| $checked_boxes[8]) echo '<td class="ratingCell">Nivel de ingresos no financieros</td>';
            if(!empty($gasto) && $_REQUEST['gastoMUN']=='personal') echo '<td class="ratingCell">Gastos de personal</td>';
            else if(!empty($gasto) && $_REQUEST['gastoMUN']=='bienesservicios') echo '<td class="ratingCell">Gastos corrientes de bienes y servicios</td>';
            else if(!empty($gasto) && $_REQUEST['gastoMUN']=='financieros') echo '<td class="ratingCell">Gastos financieros</td>';
            else if(!empty($gasto) && $_REQUEST['gastoMUN']=='inversiones') echo '<td class="ratingCell">Inversiones</td>';
            echo '</tr>';
            while($i < count($muns) && $year==key($muns[$i])){
                echo '<tr>';
                echo '<td class="ratingCell">'.($i+1).'</td>';
                echo '<td>'.$muns[$i][$year]->getNombre().'</td>';
                if(!empty($muns[$i][$year]->getScoring())) echo '<td class="ratingCell">'.$muns[$i][$year]->getScoring().'</td>';
                else if(!empty($scoring)|| $checked_boxes[0]) echo '<td class="ratingCell">N/A</td>';
                if(!empty($muns[$i][$year]->getPoblacion())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getPoblacion(), 0, '','.').'</td>';
                else if(!empty($poblacion)|| $checked_boxes[1]) echo '<td class="ratingCell">N/A</td>';
                if(!empty($muns[$i][$year]->getAutonomia())) echo '<td class="ratingCell">'.($muns[$i][$year]->getAutonomia()).'</td>';
                else if(!empty($autonomia)|| $checked_boxes[2]) echo '<td class="ratingCell">N/A</td>';
                if(!empty($muns[$i][$year]->getProvincia())) echo '<td class="ratingCell">'.($muns[$i][$year]->getProvincia()).'</td>';
                else if(!empty($provincia)|| $checked_boxes[3]) echo '<td class="ratingCell">N/A</td>';
                if(!empty($muns[$i][$year]->getEndeudamiento())) echo '<td class="ratingCell">'.($muns[$i][$year]->getEndeudamiento()*100).'%</td>';
                else if(!empty($endeudamiento)|| $checked_boxes[4]) echo '<td class="ratingCell">N/A</td>';
                if(!empty($muns[$i][$year]->getSostenibilidadFinanciera())) echo '<td class="ratingCell">'.($muns[$i][$year]->getSostenibilidadFinanciera()*100).'%</td>';
                else if(!empty($ahorro_neto)|| $checked_boxes[5]) echo '<td class="ratingCell">N/A</td>';
                if(!empty($muns[$i][$year]->getLiquidezInmediata())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getLiquidezInmediata(), 0, '','.').'</td>';
                else if(!empty($fondliq)|| $checked_boxes[6]) echo '<td class="ratingCell">N/A</td>';
                if(!empty($muns[$i][$year]->getPeriodoMedioPagos())) echo '<td class="ratingCell">'.($muns[$i][$year]->getPeriodoMedioPagos()).' días</td>';
                else if(!empty($pmp)|| $checked_boxes[7]) echo '<td class="ratingCell">N/A</td>';
                if(!empty($muns[$i][$year]->getTotalIngresosNoCorrientes1())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getTotalIngresosNoCorrientes1(), 0, '','.').'€</td>';
                else if(!empty($ingrnofin)|| $checked_boxes[8]) echo '<td class="ratingCell">N/A</td>';
                if(!empty($muns[$i][$year]->getGastosPersonal1())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getGastosPersonal1(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getGastosCorrientesBienesServicios1())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getGastosCorrientesBienesServicios1(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getTransferenciasCorrientesGastos1())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getTransferenciasCorrientesGastos1(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getInversionesReales1())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getInversionesReales1(), 0, '','.').'€</td>';
                else if(!empty($gasto)) echo '<td class="ratingCell">N/A</td>';

                echo '</tr>';
                $i+=1;
            }
            echo '</table>';
        }
    }
    else{
        echo '<p>No se encontraron resultados</p>';
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