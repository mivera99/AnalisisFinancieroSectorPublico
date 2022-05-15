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

// Hay un array de checkboxes. Si el usuario activa una checkbox, se guarda como true, sino como false. 
// Asi se sabe que checkboxes ha seleccionado el usuario y cuales no
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

// Revisa los filtros. Si el usuario ha seleccionado un filtro, se guarda su valor, sino se deja a NULL 
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
    echo '<h3>Filtros seleccionados</h3>';
    if(empty($scoring)&&empty($poblacion)&&empty($endeudamiento)&&empty($ahorro_neto)&&empty($pmp)&&empty($anho)&&empty($dcpp)&&empty($ingrnofin)&&empty($choice)&&empty($from)&&empty($to)){
        echo '<p>Ninguno</p>';
    }
    else {
        if(!empty($scoring)) echo '<p><b>Scoring</b>: '.$scoring.'</p>';
        if(!empty($poblacion)) {
            $msg="";
            if($poblacion=='tramo1') $msg="0-750.000";
            else if($poblacion=='tramo2') $msg="750.000-1.500.000";
            else if($poblacion=='tramo3') $msg="1.500.000-3.000.000";
            else if($poblacion=='tramo4') $msg="3.000.000-6.000.000";
            else if($poblacion=='tramo5') $msg=">6.000.000";
            echo '<p><b>Población</b>: '.$msg.'</p>';
        }
        if(!empty($endeudamiento)){ 
            $msg="";
            if($endeudamiento=='tramo1') $msg="0-20%";
            else if($endeudamiento=='tramo2') $msg="20%-40%";
            else if($endeudamiento=='tramo3') $msg="40%-80%";
            else if($endeudamiento=='tramo4') $msg="80%-120%";
            else if($endeudamiento=='tramo5') $msg=">120%";
            echo '<p><b>Endeudamiento</b>: '.$msg.'</p>';
        }
        if(!empty($ahorro_neto)) {
            $msg="";
            if($ahorro_neto=='tramo1') $msg="<-20%";
            else if($ahorro_neto=='tramo2') $msg="-20%-0%";
            else if($ahorro_neto=='tramo3') $msg="0%-20%";
            else if($ahorro_neto=='tramo4') $msg="20%-50%";
            else if($ahorro_neto=='tramo5') $msg=">50%";
            echo '<p><b>Ahorro neto</b>: '.$msg.'</p>';
        }
        if(!empty($pmp)) {
            $msg="";
            if($pmp=='tramo1') $msg="0-10 días";
            else if($pmp=='tramo2') $msg="10-20 días";
            else if($pmp=='tramo3') $msg="20-30 días";
            else if($pmp=='tramo4') $msg="30-40 días";
            else if($pmp=='tramo5') $msg="40-50 días";
            else if($pmp=='tramo6') $msg=">50 días";
            echo '<p><b>PMP</b>: '.$msg.'</p>';
        }
        if(!empty($dcpp)) { 
            $msg="";
            if($dcpp=='tramo1') $msg="0-4%";
            else if($dcpp=='tramo2') $msg="4-8%";
            else if($dcpp=='tramo3') $msg="8-12%";
            else if($dcpp=='tramo4') $msg="12-16%";
            else if($dcpp=='tramo5') $msg="16-20%";
            else if($dcpp=='tramo6') $msg=">20%";
            echo '<p><b>Deuda comercial pendiente de pago</b>: '.$msg.'</p>';
        }
        if(!empty($ingrnofin)) {
            $msg="";
            if($ingrnofin=='tramo1') $msg="0-1M";
            else if($ingrnofin=='tramo2') $msg="1M-5M";
            else if($ingrnofin=='tramo3') $msg="5M-50M";
            else if($ingrnofin=='tramo4') $msg=">50M";
            echo '<p><b>Nivel de ingresos no financieros</b>: '.$msg.'</p>';
        }
        if(!empty($gasto) && $_REQUEST['gastoCCAA']=='personal') echo '<p>Gasto: Gastos de personal</p>';
        if(!empty($gasto) && $_REQUEST['gastoCCAA']=='bienesservicios') echo '<p>Gasto: Gastos corrientes de bienes y servicios</p>';
        if(!empty($gasto) && $_REQUEST['gastoCCAA']=='financieros') echo '<p>Gasto: Gastos financieros</p>';
        if(!empty($gasto) && $_REQUEST['gastoCCAA']=='inversiones') echo '<p>Gasto: Inversiones</p>';
    }
    echo '<br>';
    if(!empty($ccaas)){
        echo '<p>Se han encontrado '.$ccaas['total'].' resultados</p>';
        foreach($ccaas as $year=>$ccaa_array){
            if(!is_int($ccaa_array)){
                echo '<h2>'.$year.'</h2>';
                echo '<p>'.count($ccaa_array).' resultados</p>';
                echo '<table>';
                echo '<tr>';
                echo '<td></td>';
                echo '<td>Nombre</td>';
                if($checked_boxes[0]) echo '<td class="ratingCell">Scoring</td>';
                if($checked_boxes[1]) echo '<td class="ratingCell">Población</td>';
                if($checked_boxes[2]) echo '<td class="ratingCell">Endeudamiento</td>';
                if($checked_boxes[3]) echo '<td class="ratingCell">Ahorro neto</td>';
                if($checked_boxes[4]) echo '<td class="ratingCell">PMP</td>';
                if($checked_boxes[5]) echo '<td class="ratingCell">Deuda comercial pendiente de pago</td>';
                if($checked_boxes[6]) echo '<td class="ratingCell">Nivel de ingresos no financieros</td>';
                if(!empty($gasto) && $_REQUEST['gastoCCAA']=='personal') echo '<td class="ratingCell">Gastos de personal</td>';
                if(!empty($gasto) && $_REQUEST['gastoCCAA']=='bienesservicios') echo '<td class="ratingCell">Gastos corrientes de bienes y servicios</td>';
                if(!empty($gasto) && $_REQUEST['gastoCCAA']=='financieros') echo '<td class="ratingCell">Gastos financieros</td>';
                if(!empty($gasto) && $_REQUEST['gastoCCAA']=='inversiones') echo '<td class="ratingCell">Inversiones</td>';
                echo '</tr>';
                $i=0;
                foreach($ccaa_array as $ccaa){ 
                    echo '<tr>';
                    echo '<td class="ratingCell">'.($i+1).'</td>';
                    echo '<td>'.$ccaa->getNombre().'</td>';
                    if(!empty($ccaa->getScoring())) echo '<td class="ratingCell">'.$ccaa->getScoring().'</td>';
                    else if($checked_boxes[0]) echo '<td class="ratingCell">-</td>';
                    if(!empty($ccaa->getPoblacion()) && $ccaa->getPoblacion()!=0) echo '<td class="ratingCell">'.number_format($ccaa->getPoblacion(), 0, '','.').'</td>';
                    else if($checked_boxes[1]) echo '<td class="ratingCell">-</td>';
                    if(!empty($ccaa->getDeudaVivaIngrCor())&& $ccaa->getDeudaVivaIngrCor()!=0) echo '<td class="ratingCell">'.($ccaa->getDeudaVivaIngrCor()*100).'%</td>';
                    else if($checked_boxes[2]) echo '<td class="ratingCell">-</td>';
                    if(!empty($ccaa->getRSosteFinanciera())&& $ccaa->getRSosteFinanciera()!=0) echo '<td class="ratingCell">'.($ccaa->getRSosteFinanciera()*100).'%</td>';
                    else if($checked_boxes[3]) echo '<td class="ratingCell">-</td>';
                    if(!empty($ccaa->getPMP())&& $ccaa->getPMP()!=0) echo '<td class="ratingCell">'.($ccaa->getPMP()).' días</td>';
                    else if($checked_boxes[4]) echo '<td class="ratingCell">-</td>';
                    if(!empty($ccaa->getRDCPP())&& $ccaa->getRDCPP()!=0) echo '<td class="ratingCell">'.($ccaa->getRDCPP()*100).'%</td>';
                    else if($checked_boxes[5]) echo '<td class="ratingCell">-</td>';
                    if(!empty($ccaa->getTotalIngresosNoCorrientes1())&& $ccaa->getTotalIngresosNoCorrientes1()!=0) echo '<td class="ratingCell">'.number_format($ccaa->getTotalIngresosNoCorrientes1(), 0, '','.').'€</td>';
                    else if($checked_boxes[6]) echo '<td class="ratingCell">-</td>';
                    if(!empty($ccaa->getGastosPersonal1())&& $ccaa->getGastosPersonal1()!=0) echo '<td class="ratingCell">'.number_format($ccaa->getGastosPersonal1(), 0, '','.').'€</td>';
                    else if(!empty($ccaa->getGastosCorrientesBienesServicios1())&& $ccaa->getGastosCorrientesBienesServicios1()!=0) echo '<td class="ratingCell">'.number_format($ccaa->getGastosCorrientesBienesServicios1(), 0, '','.').'€</td>';
                    else if(!empty($ccaa->getTransferenciasCorrientesGastos1())&& $ccaa->getTransferenciasCorrientesGastos1()!=0) echo '<td class="ratingCell">'.number_format($ccaa->getTransferenciasCorrientesGastos1(), 0, '','.').'€</td>';
                    else if(!empty($ccaa->getInversionesReales1())&& $ccaa->getInversionesReales1()!=0) echo '<td class="ratingCell">'.number_format($ccaa->getInversionesReales1(), 0, '','.').'€</td>';
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
</div>
<div id="pie">
    <?php
        require('includesWeb/comun/pie.php');
    ?>
</div>
</body>
</html>