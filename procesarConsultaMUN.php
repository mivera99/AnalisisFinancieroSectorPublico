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
$prog=NULL;

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

if(!empty($_REQUEST['progMUN']) && $_REQUEST['progMUN']!='inicio'){
    $prog = htmlspecialchars(trim(strip_tags($_REQUEST['progMUN'])));
}

if(isset($_REQUEST['selectionMUN'])){
    $choice = htmlspecialchars(trim(strip_tags($_REQUEST['selectionMUN'])));
    if($choice == 'SelectYear'){
        if(!empty($_REQUEST['anhoMUN']) && $_REQUEST['anhoMUN']!='inicio'){
            $anho = htmlspecialchars(trim(strip_tags($_REQUEST['anhoMUN'])));
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

if(!empty($_REQUEST['autonomiasMUN']) && $_REQUEST['autonomiasMUN']!='inicio'){
    $autonomia = htmlspecialchars(trim(strip_tags($_REQUEST['autonomiasMUN'])));
}

if(!empty($_REQUEST['provinciasMUN']) && $_REQUEST['provinciasMUN']!='inicio'){
    $provincia = htmlspecialchars(trim(strip_tags($_REQUEST['provinciasMUN'])));
}

$muns = (new DAOConsultor())->consultarMUNs($scoring, $poblacion, $endeudamiento, $ahorro_neto, $fondliq, $choice, $anho, $from, $to, $autonomia, $provincia, $pmp, $ingrnofin, $gasto, $prog, $checked_boxes);
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
            if(!empty($prog) && $_REQUEST['progMUN']=='agspc') echo '<td class="ratingCell">Administración general de la seguridad y protección civil</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='sop') echo '<td class="ratingCell">Seguridad y orden público</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='ote') echo '<td class="ratingCell">Ordenación del tráfico y del estacionamiento</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='mu') echo '<td class="ratingCell">Movilidad urbana</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='pc') echo '<td class="ratingCell">Protección civil</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='spei') echo '<td class="ratingCell">Servicio de prevención y extinción de incendios</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='pgvpp') echo '<td class="ratingCell">Promoción y gestión de vivienda de protección pública</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='cre') echo '<td class="ratingCell">Conservación y rehabilitación de la edificación</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='pvp') echo '<td class="ratingCell">Pavimentación de vías públicas</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='a') echo '<td class="ratingCell">Alcantarillado</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='rgtr') echo '<td class="ratingCell">Recogida, gestión y tratamiento de residuos</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='rr') echo '<td class="ratingCell">Recogida de residuos</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='grsu') echo '<td class="ratingCell">Gestión de residuos sólidos urbanos</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='tr') echo '<td class="ratingCell">Tratamiento de residuos</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='lv') echo '<td class="ratingCell">Limpieza viaria</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='csf') echo '<td class="ratingCell">Cementerios y servicios funerarios</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='ap') echo '<td class="ratingCell">Alumbrado público</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='pj') echo '<td class="ratingCell">Parques y jardines</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='p') echo '<td class="ratingCell">Pensiones</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='ssps') echo '<td class="ratingCell">Servicios sociales y promoción social</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='fe') echo '<td class="ratingCell">Fomento del empleo</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='s') echo '<td class="ratingCell">Sanidad</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='e') echo '<td class="ratingCell">Educación</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='c') echo '<td class="ratingCell">Cultura</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='d') echo '<td class="ratingCell">Deporte</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='agp') echo '<td class="ratingCell">Agricultura, ganadería y pesca</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='ie') echo '<td class="ratingCell">Industria y energía</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='com') echo '<td class="ratingCell">Comercio</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='tp') echo '<td class="ratingCell">Transporte público</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='it') echo '<td class="ratingCell">Infraestructuras del transporte</td>';
            else if(!empty($prog) && $_REQUEST['progMUN']=='idi') echo '<td class="ratingCell">Investigación, desarrollo e innovación</td>';
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
                if(!empty($muns[$i][$year]->getAgspc())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getAgspc(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getSop())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getSop(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getOte())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getOte(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getMu())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getMu(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getPc())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getPc(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getSpei())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getSpei(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getPgvpp())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getPgvpp(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getCre())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getCre(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getPvp())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getPvp(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getA())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getA(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getRgtr())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getRgtr(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getRr())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getRr(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getGrsu())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getGrsu(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getTr())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getTr(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getLv())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getLv(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getCsf())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getCsf(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getAp())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getAp(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getPj())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getPj(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getP())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getP(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getSsps())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getSsps(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getFe())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getFe(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getS())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getS(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getE())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getE(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getC())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getC(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getD())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getD(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getAgp())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getAgp(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getIe())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getIe(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getCom())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getCom(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getTp())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getTp(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getIt())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getIt(), 0, '','.').'€</td>';
                else if(!empty($muns[$i][$year]->getIdi())) echo '<td class="ratingCell">'.number_format($muns[$i][$year]->getIdi(), 0, '','.').'€</td>';
                else if(!empty($prog)) echo '<td class="ratingCell">N/A</td>';
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