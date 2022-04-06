<?php
session_start();
require_once('includesWeb/daos/DAOConsultor.php');

$scoring = NULL;
$poblacion = NULL;
$endeudamiento = NULL;
$ahorro_neto = NULL;
$fondliq = NULL;
$anho = NULL;
$autonomia = NULL;
$provincia = NULL;
$pmp=NULL;
$ingrnofin=NULL;
$gasto=NULL;

$choice = NULL;
$from=NULL;
$to=NULL;

$checked_boxes=array();

if(!empty($_REQUEST['scoringDIP_C'])) array_push($checked_boxes, true);
else array_push($checked_boxes,false);
if(!empty($_REQUEST['autonomiaDIP_C'])) array_push($checked_boxes, true);
else array_push($checked_boxes,false);
if(!empty($_REQUEST['endeudamientoDIP_C'])) array_push($checked_boxes, true);
else array_push($checked_boxes,false);
if(!empty($_REQUEST['ahorronetoDIP_C'])) array_push($checked_boxes, true);
else array_push($checked_boxes,false);
if(!empty($_REQUEST['fondliqDIP_C'])) array_push($checked_boxes, true);
else array_push($checked_boxes,false);
if(!empty($_REQUEST['pmpDIP_C'])) array_push($checked_boxes, true);
else array_push($checked_boxes,false);
if(!empty($_REQUEST['ingrnofinDIP_C'])) array_push($checked_boxes, true);
else array_push($checked_boxes,false);

if(!empty($_REQUEST['scoringDIP']) && $_REQUEST['scoringDIP']!='inicio'){
    $scoring = htmlspecialchars(trim(strip_tags($_REQUEST['scoringDIP'])));
}

if(!empty($_REQUEST['poblacionDIP'])&& $_REQUEST['poblacionDIP']!='inicio'){
    $poblacion = htmlspecialchars(trim(strip_tags($_REQUEST['poblacionDIP'])));
}

if(!empty($_REQUEST['endeudamientoDIP']) && $_REQUEST['endeudamientoDIP']!='inicio'){
    $endeudamiento = htmlspecialchars(trim(strip_tags($_REQUEST['endeudamientoDIP'])));
}

if(!empty($_REQUEST['ahorro_netoDIP']) && $_REQUEST['ahorro_netoDIP']!='inicio'){
    $ahorro_neto = htmlspecialchars(trim(strip_tags($_REQUEST['ahorro_netoDIP'])));
}

if(!empty($_REQUEST['fondliqDIP']) && $_REQUEST['fondliqDIP']!='inicio'){
    $fondliq = htmlspecialchars(trim(strip_tags($_REQUEST['fondliqDIP'])));
}

if(!empty($_REQUEST['pmpDIP']) && $_REQUEST['pmpDIP']!='inicio'){
    $pmp = htmlspecialchars(trim(strip_tags($_REQUEST['pmpDIP'])));
}

if(!empty($_REQUEST['ingrnofinDIP']) && $_REQUEST['ingrnofinDIP']!='inicio'){
    $ingrnofin = htmlspecialchars(trim(strip_tags($_REQUEST['ingrnofinDIP'])));
}

if(!empty($_REQUEST['gastoDIP']) && $_REQUEST['gastoDIP']!='inicio'){
    $gasto = htmlspecialchars(trim(strip_tags($_REQUEST['gastoDIP'])));
}

if(isset($_REQUEST['selectionDIP'])){
    $choice = htmlspecialchars(trim(strip_tags($_REQUEST['selectionDIP'])));
    if($choice == 'SelectYear'){
        if(!empty($_REQUEST['anhoDIP']) && $_REQUEST['anhoDIP']!='inicio'){
            $anho = htmlspecialchars(trim(strip_tags($_REQUEST['anhoDIP'])));
        }
    }
    else {
        if(!empty($_REQUEST['from']) && !empty($_REQUEST['to'])){
            if($_REQUEST['from']!='inicio'){
                $from = htmlspecialchars(trim(strip_tags($_REQUEST['from'])));
            }
            if($_REQUEST['to']!='inicio'){
                $to = htmlspecialchars(trim(strip_tags($_REQUEST['to'])));
            }
        }
    }
}

if(!empty($_REQUEST['autonomiasDIP']) && $_REQUEST['autonomiasDIP']!='inicio'){
    $autonomia = htmlspecialchars(trim(strip_tags($_REQUEST['autonomiasDIP'])));
}

$dips = (new DAOConsultor())->consultarDIPs($scoring, $poblacion, $endeudamiento, $ahorro_neto, $fondliq, $choice, $anho, $from, $to, $autonomia, $pmp, $ingrnofin, $gasto, $checked_boxes);
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

    <!-- ====== FUNCIONES JAVASCRIPT ==== -->
    <script src="functions2.js"></script>
    <title>Análisis Financiero Sector Público - Consulta DIPs</title>
</head>
<body>
<div id="contenedor">

<div id="cabecera">
    <?php
        require('includesWeb/comun/cabecera.php');
    ?>
</div>
<div id="consultaDIP">
    <?php
    if(count($dips)>0){
        echo '<p>Se han encontrado '.count($dips).' resultados</p>';
        $year=0;
        $i=0;
        while($i<count($dips)){
            echo '<h2>'.key($dips[$i]).'</h2>';
            echo '<table>';
            $year = key($dips[$i]);
            echo '<tr>';
            echo '<td></td>';
            echo '<td>Nombre</td>';
            if(/*!empty($scoring)||*/$checked_boxes[0]) echo '<td class="ratingCell">Scoring</td>';
            if(/*!empty($autonomia)||*/$checked_boxes[1]) echo '<td class="ratingCell">Comunidad Autónoma</td>';
            if(/*!empty($endeudamiento)||*/$checked_boxes[2]) echo '<td class="ratingCell">Endeudamiento</td>';
            if(/*!empty($ahorro_neto)||*/$checked_boxes[3]) echo '<td class="ratingCell">Ahorro neto</td>';
            if(/*!empty($fondliq)||*/$checked_boxes[4]) echo '<td class="ratingCell">Fondos líquidos</td>';
            if(/*!empty($pmp)||*/$checked_boxes[5]) echo '<td class="ratingCell">PMP</td>';
            if(/*!empty($ingrnofin)||*/$checked_boxes[6]) echo '<td class="ratingCell">Nivel de ingresos no financieros</td>';
            if(!empty($gasto) && $_REQUEST['gastoDIP']=='personal') echo '<td class="ratingCell">Gastos de personal</td>';
            if(!empty($gasto) && $_REQUEST['gastoDIP']=='bienesservicios') echo '<td class="ratingCell">Gastos corrientes de bienes y servicios</td>';
            if(!empty($gasto) && $_REQUEST['gastoDIP']=='financieros') echo '<td class="ratingCell">Gastos financieros</td>';
            if(!empty($gasto) && $_REQUEST['gastoDIP']=='inversiones') echo '<td class="ratingCell">Inversiones</td>';
            echo '</tr>';
            while($i < count($dips) && $year==key($dips[$i])){
                echo '<tr>';
                echo '<td class="ratingCell">'.($i+1).'</td>';
                echo '<td>'.$dips[$i][$year]->getNombre().'</td>';
                if(!empty($dips[$i][$year]->getScoring())) echo '<td class="ratingCell">'.$dips[$i][$year]->getScoring().'</td>';
                else if(!/*empty($scoring)||*/$checked_boxes[0]) echo '<td class="ratingCell">N/A</td>';
                if(!empty($dips[$i][$year]->getAutonomia())) echo '<td class="ratingCell">'.$dips[$i][$year]->getAutonomia().'</td>';
                else if(/*!empty($autonomia)||*/$checked_boxes[1]) echo '<td class="ratingCell">N/A</td>';
                if(!empty($dips[$i][$year]->getEndeudamiento())) echo '<td class="ratingCell">'.($dips[$i][$year]->getEndeudamiento()*100).'%</td>';
                else if(/*!empty($endeudamiento)||*/$checked_boxes[2]) echo '<td class="ratingCell">N/A</td>';
                if(!empty($dips[$i][$year]->getSostenibilidadFinanciera())) echo '<td class="ratingCell">'.($dips[$i][$year]->getSostenibilidadFinanciera()*100).'%</td>';
                else if(/*!empty($ahorro_neto)||*/$checked_boxes[3]) echo '<td class="ratingCell">N/A</td>';
                if(!empty($dips[$i][$year]->getLiquidezInmediata())) echo '<td class="ratingCell">'.number_format($dips[$i][$year]->getLiquidezInmediata(), 0, '','.').'€</td>';
                else if(/*!empty($fondliq)||*/$checked_boxes[4]) echo '<td class="ratingCell">N/A</td>';
                if(!empty($dips[$i][$year]->getPeriodoMedioPagos())) echo '<td class="ratingCell">'.($dips[$i][$year]->getPeriodoMedioPagos()).' días</td>';
                else if(/*!empty($pmp)||*/$checked_boxes[5]) echo '<td class="ratingCell">N/A</td>';
                if(!empty($dips[$i][$year]->getTotalIngresosNoCorrientes1())) echo '<td class="ratingCell">'.number_format($dips[$i][$year]->getTotalIngresosNoCorrientes1(), 0, '','.').'€</td>';
                else if(/*!empty($ingrnofin)||*/$checked_boxes[6]) echo '<td class="ratingCell">N/A</td>';
                if(!empty($dips[$i][$year]->getGastosPersonal1())) echo '<td class="ratingCell">'.number_format($dips[$i][$year]->getGastosPersonal1(), 0, '','.').'€</td>';
                else if(!empty($dips[$i][$year]->getGastosCorrientesBienesServicios1())) echo '<td class="ratingCell">'.number_format($dips[$i][$year]->getGastosCorrientesBienesServicios1(), 0, '','.').'€</td>';
                else if(!empty($dips[$i][$year]->getTransferenciasCorrientesGastos1())) echo '<td class="ratingCell">'.number_format($dips[$i][$year]->getTransferenciasCorrientesGastos1(), 0, '','.').'€</td>';
                else if(!empty($dips[$i][$year]->getInversionesReales1())) echo '<td class="ratingCell">'.number_format($dips[$i][$year]->getInversionesReales1(), 0, '','.').'€</td>';
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