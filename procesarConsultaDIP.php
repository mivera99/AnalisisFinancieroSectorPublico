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

// Hay un array de checkboxes. Si el usuario activa una checkbox, se guarda como true, sino como false. 
// Asi se sabe que checkboxes ha seleccionado el usuario y cuales no
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

// Revisa los filtros. Si el usuario ha seleccionado un filtro, se guarda su valor, sino se deja a NULL 
if(!empty($_REQUEST['scoringDIP']) && $_REQUEST['scoringDIP']!='inicio'){
    $scoring = htmlspecialchars(trim(strip_tags($_REQUEST['scoringDIP'])));
}

if(!empty($_REQUEST['poblacionDIP'])&& $_REQUEST['poblacionDIP']!='inicio'){
    $poblacion = htmlspecialchars(trim(strip_tags($_REQUEST['poblacionDIP'])));
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
    echo '<h3>Filtros seleccionados</h3>';
    // Para mostrar los filtros seleccionados por el usuario por pantalla
    if(empty($scoring)&&empty($poblacion)&&empty($endeudamiento)&&empty($ahorro_neto)&&empty($pmp)&&empty($anho)&&empty($dcpp)&&empty($ingrnofin)&&empty($choice)&&empty($from)&&empty($to)){
        echo '<p>Ninguno</p>';
    }
    else {
        if(!empty($scoring)) echo '<p><b>Scoring</b>: '.$scoring.'</p>';
        if(!empty($autonomia)) echo '<p><b>Autonomía</b>: '.((new DAOConsultor())->getCCAAById($autonomia))->getNombre().'</p>';
    }
    echo '<br>';
    // Creación de la tabla
    if(!empty($dips)){
        echo '<p>Se han encontrado '.$dips['total'].' resultados</p>';
        foreach($dips as $year=>$dip_array){
            if(!is_int($dip_array)) {
                echo '<h2>'.$year.'</h2>';
                echo '<p>'.count($dip_array).' resultados</p>';
                echo '<table>';
                echo '<tr>';
                echo '<td></td>';
                echo '<td>Nombre</td>';
                if(!empty($scoring)) echo '<td class="ratingCell">Scoring</td>';
                if(!empty($autonomia)) echo '<td class="ratingCell">Comunidad Autónoma</td>';
                if($checked_boxes[0]) echo '<td class="ratingCell">Endeudamiento</td>';
                if($checked_boxes[1]) echo '<td class="ratingCell">Ahorro neto</td>';
                if($checked_boxes[2]) echo '<td class="ratingCell">Fondos líquidos</td>';
                if($checked_boxes[3]) echo '<td class="ratingCell">PMP</td>';
                if($checked_boxes[4]) echo '<td class="ratingCell">Nivel de ingresos no financieros</td>';
                if(!empty($gasto) && $_REQUEST['gastoDIP']=='personal') echo '<td class="ratingCell">Gastos de personal</td>';
                if(!empty($gasto) && $_REQUEST['gastoDIP']=='bienesservicios') echo '<td class="ratingCell">Gastos corrientes de bienes y servicios</td>';
                if(!empty($gasto) && $_REQUEST['gastoDIP']=='financieros') echo '<td class="ratingCell">Gastos financieros</td>';
                if(!empty($gasto) && $_REQUEST['gastoDIP']=='inversiones') echo '<td class="ratingCell">Inversiones</td>';
                echo '</tr>';
                $i=0;
                foreach($dip_array as $dip){
                    echo '<tr>';
                    echo '<td class="ratingCell">'.($i+1).'</td>';
                    echo '<td>'.$dip->getNombre().'</td>';
                    if(!empty($dip->getScoring())) echo '<td class="ratingCell">'.$dip->getScoring().'</td>';
                    else if(!empty($scoring)) echo '<td class="ratingCell">-</td>';
                    if(!empty($dip->getAutonomia())) echo '<td class="ratingCell">'.$dip->getAutonomia().'</td>';
                    else if(!empty($autonomia)) echo '<td class="ratingCell">-</td>';
                    if(!empty($dip->getEndeudamiento())&&$dip->getEndeudamiento()!=0) echo '<td class="ratingCell">'.($dip->getEndeudamiento()*100).'%</td>';
                    else if($checked_boxes[0]) echo '<td class="ratingCell">-</td>';
                    if(!empty($dip->getSostenibilidadFinanciera())&&$dip->getSostenibilidadFinanciera()!=0) echo '<td class="ratingCell">'.($dip->getSostenibilidadFinanciera()*100).'%</td>';
                    else if($checked_boxes[1]) echo '<td class="ratingCell">-</td>';
                    if(!empty($dip->getLiquidezInmediata())&&$dip->getLiquidezInmediata()!=0) echo '<td class="ratingCell">'.number_format($dip->getLiquidezInmediata(), 0, '','.').'€</td>';
                    else if($checked_boxes[2]) echo '<td class="ratingCell">-</td>';
                    if(!empty($dip->getPeriodoMedioPagos())&&$dip->getPeriodoMedioPagos()!=0) echo '<td class="ratingCell">'.($dip->getPeriodoMedioPagos()).' días</td>';
                    else if($checked_boxes[3]) echo '<td class="ratingCell">-</td>';
                    if(!empty($dip->getTotalIngresosNoCorrientes1())&&$dip->getTotalIngresosNoCorrientes1()!=0) echo '<td class="ratingCell">'.number_format($dip->getTotalIngresosNoCorrientes1(), 0, '','.').'€</td>';
                    else if($checked_boxes[4]) echo '<td class="ratingCell">-</td>';
                    if(!empty($dip->getGastosPersonal1())&&$dip->getGastosPersonal1()!=0) echo '<td class="ratingCell">'.number_format($dip->getGastosPersonal1(), 0, '','.').'€</td>';
                    else if(!empty($dip->getGastosCorrientesBienesServicios1())&&$dip->getGastosCorrientesBienesServicios1()!=0) echo '<td class="ratingCell">'.number_format($dip->getGastosCorrientesBienesServicios1(), 0, '','.').'€</td>';
                    else if(!empty($dip->getTransferenciasCorrientesGastos1())&&$dip->getTransferenciasCorrientesGastos1()!=0) echo '<td class="ratingCell">'.number_format($dip->getTransferenciasCorrientesGastos1(), 0, '','.').'€</td>';
                    else if(!empty($dip->getInversionesReales1())&&$dip->getInversionesReales1()!=0) echo '<td class="ratingCell">'.number_format($dip->getInversionesReales1(), 0, '','.').'€</td>';
                    else if(!empty($gasto)) echo '<td class="ratingCell">-</td>';
                    echo '</tr>';
                    $i+=1;
                }
                echo '</table>';
            }
        }
    }
    else{
        echo '<p>No se encontraron resultados</p>';
    }
    ?>
    <div style="height:15vh"></div>
</div>
<div id="pie">
    <?php
        require('includesWeb/comun/pie.php');
    ?>
</div>
</body>
</html>