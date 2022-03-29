<?php
session_start();
require_once('includesWeb/daos/DAOConsultor.php');

$scoring = NULL;
$poblacion = NULL;
$endeudamiento = NULL;
$ahorro_neto = NULL;
$pmp = NULL;
$anho = NULL;
$dcpp = NULL;
$ingrnofin = NULL;
$gasto = NULL;

$choice = NULL;
$from=NULL;
$to=NULL;
$checked_boxes=array();

if(!empty($_REQUEST['scoringCCAA_C'])) array_push($checked_boxes, true);
else array_push($checked_boxes,false);
if(!empty($_REQUEST['poblacionCCAA_C'])) array_push($checked_boxes, true);
else array_push($checked_boxes,false);
if(!empty($_REQUEST['endeudamientoCCAA_C'])) array_push($checked_boxes, true);
else array_push($checked_boxes,false);
if(!empty($_REQUEST['ahorronetoCCAA_C'])) array_push($checked_boxes, true);
else array_push($checked_boxes,false);
if(!empty($_REQUEST['pmpCCAA_C'])) array_push($checked_boxes, true);
else array_push($checked_boxes,false);
if(!empty($_REQUEST['dcppCCAA_C'])) array_push($checked_boxes, true);
else array_push($checked_boxes,false);
if(!empty($_REQUEST['ingrnofinCCAA_C'])) array_push($checked_boxes, true);
else array_push($checked_boxes,false);

if(!empty($_REQUEST['scoringCCAA']) && $_REQUEST['scoringCCAA']!='inicio') 
    $scoring = htmlspecialchars(trim(strip_tags($_REQUEST['scoringCCAA'])));

if(!empty($_REQUEST['poblacionCCAA']) && $_REQUEST['poblacionCCAA']!='inicio')
    $poblacion = htmlspecialchars(trim(strip_tags($_REQUEST['poblacionCCAA'])));

if(!empty($_REQUEST['endeudamientoCCAA']) && $_REQUEST['endeudamientoCCAA']!='inicio')
    $endeudamiento = htmlspecialchars(trim(strip_tags($_REQUEST['endeudamientoCCAA'])));

if(!empty($_REQUEST['ahorro_netoCCAA']) && $_REQUEST['ahorro_netoCCAA']!='inicio')
    $ahorro_neto = htmlspecialchars(trim(strip_tags($_REQUEST['ahorro_netoCCAA'])));

if(!empty($_REQUEST['pmpCCAA']) && $_REQUEST['pmpCCAA']!='inicio')
    $pmp = htmlspecialchars(trim(strip_tags($_REQUEST['pmpCCAA'])));

if(!empty($_REQUEST['dcppCCAA']) && $_REQUEST['dcppCCAA']!='inicio')
    $dcpp = htmlspecialchars(trim(strip_tags($_REQUEST['dcppCCAA'])));

if(!empty($_REQUEST['ingrnofinCCAA']) && $_REQUEST['ingrnofinCCAA']!='inicio')
    $ingrnofin = htmlspecialchars(trim(strip_tags($_REQUEST['ingrnofinCCAA'])));

if(!empty($_REQUEST['gastoCCAA']) && $_REQUEST['gastoCCAA']!='inicio')
    $gasto = htmlspecialchars(trim(strip_tags($_REQUEST['gastoCCAA'])));

if(isset($_REQUEST['selection'])){
    $choice = htmlspecialchars(trim(strip_tags($_REQUEST['selection'])));
    if($choice == 'SelectYear'){
        if(!empty($_REQUEST['anhoCCAA']) && $_REQUEST['anhoCCAA']!='inicio')
            $anho = htmlspecialchars(trim(strip_tags($_REQUEST['anhoCCAA'])));
    }
    else {
        if(!empty($_REQUEST['from']) && !empty($_REQUEST['to'])){
            if($_REQUEST['from']!='inicio')
                $from = htmlspecialchars(trim(strip_tags($_REQUEST['from'])));

            if($_REQUEST['to']!='inicio')
                $to = htmlspecialchars(trim(strip_tags($_REQUEST['to'])));

        }
    }
}

$ccaas = (new DAOConsultor())->consultarCCAAs($scoring, $poblacion, $endeudamiento, $ahorro_neto, $pmp, $choice, $anho, $from, $to, $dcpp, $ingrnofin, $gasto, $checked_boxes);
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

    <title>Análisis Financiero Sector Público - Consulta CCAAs</title>
</head>
<body>
<div id="contenedor">

<div id="cabecera">
    <?php
        require('includesWeb/comun/cabecera.php');
    ?>
</div>
<div id="consultaCCAA">
    <?php
    if(count($ccaas)>0){
        echo '<p>Se han encontrado '.count($ccaas).' resultados</p>';
        $year=0;
        $i=0;
        while($i<count($ccaas)){
            echo '<h2>'.key($ccaas[$i]).'</h2>';
            echo '<table>';
            $year = key($ccaas[$i]);
            echo '<tr>';
            echo '<td></td>';
            echo '<td>Nombre</td>';
            if(!empty($scoring)||$checked_boxes[0]) echo '<td class="ratingCell">Scoring</td>';
            if(!empty($poblacion)||$checked_boxes[1]) echo '<td class="ratingCell">Población</td>';
            if(!empty($endeudamiento)||$checked_boxes[2]) echo '<td class="ratingCell">Endeudamiento</td>';
            if(!empty($ahorro_neto)||$checked_boxes[3]) echo '<td class="ratingCell">Ahorro neto</td>';
            if(!empty($pmp)||$checked_boxes[4]) echo '<td class="ratingCell">PMP</td>';
            if(!empty($dcpp)||$checked_boxes[5]) echo '<td class="ratingCell">Deuda comercial pendiente de pago</td>';
            if(!empty($ingrnofin)||$checked_boxes[6]) echo '<td class="ratingCell">Nivel de ingresos no financieros</td>';
            if(!empty($gasto) && $_REQUEST['gastoCCAA']=='personal') echo '<td class="ratingCell">Gastos de personal</td>';
            if(!empty($gasto) && $_REQUEST['gastoCCAA']=='bienesservicios') echo '<td class="ratingCell">Gastos corrientes de bienes y servicios</td>';
            if(!empty($gasto) && $_REQUEST['gastoCCAA']=='financieros') echo '<td class="ratingCell">Gastos financieros</td>';
            if(!empty($gasto) && $_REQUEST['gastoCCAA']=='inversiones') echo '<td class="ratingCell">Inversiones</td>';
            echo '</tr>';
            while($i < count($ccaas) && $year==key($ccaas[$i])){
                echo '<tr>';
                echo '<td class="ratingCell">'.($i+1).'</td>';
                echo '<td>'.$ccaas[$i][$year]->getNombre().'</td>';
                if(!empty($ccaas[$i][$year]->getScoring())) echo '<td class="ratingCell">'.$ccaas[$i][$year]->getScoring().'</td>';
                else if(!empty($scoring)||$checked_boxes[0]) echo '<td class="ratingCell">N/A</td>';
                if(!empty($ccaas[$i][$year]->getPoblacion()) && !empty($poblacion)) echo '<td class="ratingCell">'.number_format($ccaas[$i][$year]->getPoblacion(), 0, '','.').'</td>';
                else if(!empty($poblacion)||$checked_boxes[1]) echo '<td class="ratingCell">N/A</td>';
                if(!empty($ccaas[$i][$year]->getDeudaVivaIngrCor())) echo '<td class="ratingCell">'.($ccaas[$i][$year]->getDeudaVivaIngrCor()*100).'%</td>';
                else if(!empty($endeudamiento)||$checked_boxes[2]) echo '<td class="ratingCell">N/A</td>';
                if(!empty($ccaas[$i][$year]->getRSosteFinanciera())) echo '<td class="ratingCell">'.($ccaas[$i][$year]->getRSosteFinanciera()*100).'%</td>';
                else if(!empty($ahorro_neto)||$checked_boxes[3]) echo '<td class="ratingCell">N/A</td>';
                if(!empty($ccaas[$i][$year]->getPMP())) echo '<td class="ratingCell">'.($ccaas[$i][$year]->getPMP()).' días</td>';
                else if(!empty($pmp)||$checked_boxes[4]) echo '<td class="ratingCell">N/A</td>';
                if(!empty($ccaas[$i][$year]->getRDCPP())) echo '<td class="ratingCell">'.($ccaas[$i][$year]->getRDCPP()*100).'%</td>';
                else if(!empty($dcpp)||$checked_boxes[5]) echo '<td class="ratingCell">N/A</td>';
                if(!empty($ccaas[$i][$year]->getTotalIngresosNoCorrientes1())) echo '<td class="ratingCell">'.number_format($ccaas[$i][$year]->getTotalIngresosNoCorrientes1(), 0, '','.').'€</td>';
                else if(!empty($ingrnofin)||$checked_boxes[6]) echo '<td class="ratingCell">N/A</td>';
                if(!empty($ccaas[$i][$year]->getGastosPersonal1())) echo '<td class="ratingCell">'.number_format($ccaas[$i][$year]->getGastosPersonal1(), 0, '','.').'€</td>';
                else if(!empty($ccaas[$i][$year]->getGastosCorrientesBienesServicios1())) echo '<td class="ratingCell">'.number_format($ccaas[$i][$year]->getGastosCorrientesBienesServicios1(), 0, '','.').'€</td>';
                else if(!empty($ccaas[$i][$year]->getTransferenciasCorrientesGastos1())) echo '<td class="ratingCell">'.number_format($ccaas[$i][$year]->getTransferenciasCorrientesGastos1(), 0, '','.').'€</td>';
                else if(!empty($ccaas[$i][$year]->getInversionesReales1())) echo '<td class="ratingCell">'.number_format($ccaas[$i][$year]->getInversionesReales1(), 0, '','.').'€</td>';
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