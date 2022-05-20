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

$sum=0;

$checked_boxes=array();

// Hay un array de checkboxes. Si el usuario activa una checkbox, se guarda como true, sino como false. 
// Asi se sabe que checkboxes ha seleccionado el usuario y cuales no
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
if(!empty($_REQUEST['pmpMUN_C'])) array_push($checked_boxes, true);
else array_push($checked_boxes,false);
if(!empty($_REQUEST['fondliqMUN_C'])) array_push($checked_boxes, true);
else array_push($checked_boxes,false);
if(!empty($_REQUEST['ingrnofinMUN_C'])) array_push($checked_boxes, true);
else array_push($checked_boxes,false);


// Revisa los filtros. Si el usuario ha seleccionado un filtro, se guarda su valor, sino se deja a NULL 
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
    echo '<h3>Filtros seleccionados</h3>';
    // Para mostrar los filtros seleccionados por el usuario por pantalla
    if(empty($scoring)&&empty($poblacion)&&empty($endeudamiento)&&empty($ahorro_neto)&&empty($pmp)&&empty($anho)&&empty($dcpp)&&empty($ingrnofin)&&empty($choice)&&empty($from)&&empty($to)&&empty($fondliq)&&empty($autonomia)&&empty($provincia)){
        echo '<p>Ninguno</p>';
    }
    else {
        if(!empty($scoring)) echo '<p><b>Scoring</b>: '.$scoring.'</p>';
        if(!empty($poblacion)) {
            $msg="";
            if($poblacion=='tramo1') $msg="0-100";
            else if($poblacion=='tramo2') $msg="100-500";
            else if($poblacion=='tramo3') $msg="500-1.000";
            else if($poblacion=='tramo4') $msg="1.000-2.000";
            else if($poblacion=='tramo5') $msg="2.000-5.000";
            else if($poblacion=='tramo6') $msg="5.000-10.000";
            else if($poblacion=='tramo7') $msg="10.000-20.000";
            else if($poblacion=='tramo8') $msg="20.000-50.000";
            else if($poblacion=='tramo9') $msg="50.000-100.000";
            else if($poblacion=='tramo10') $msg="100.000-500.000";
            else if($poblacion=='tramo11') $msg="> 500.000";
            echo '<p><b>Población</b>: '.$msg.'</p>';
        }
        if(!empty($autonomia)) echo '<p><b>Autonomía</b>: '.((new DAOConsultor())->getCCAAById($autonomia))->getNombre().'</p>';
        if(!empty($provincia)) echo '<p><b>Provincia</b>: '.((new DAOConsultor())->getProvinciaById($provincia))->getNombre().'</p>';
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
    // Creación de la tabla
    if(!empty($muns)){
        echo '<p>Se han encontrado '.$muns['total'].' resultados</p>';
        foreach($muns as $year=>$mun_array){
            if(!is_int($mun_array)){
                $num_cols=0;
                echo '<h2>'.$year.'</h2>';
                echo '<p>'.count($mun_array).' resultados</p>';
                echo '<table>';
                echo '<tr>';
                echo '<td></td>';
                echo '<td>Nombre</td>';
                if($checked_boxes[0]) {
                    echo '<td class="ratingCell">Scoring</td>';
                    $num_cols++;
                }
                if($checked_boxes[1]) {
                    echo '<td class="ratingCell">Población</td>';
                    $num_cols++;
                }
                if($checked_boxes[2]) {
                    echo '<td class="ratingCell">Comunidad Autónoma</td>';
                    $num_cols++;
                }
                if($checked_boxes[3]) {
                    echo '<td class="ratingCell">Provincia</td>';
                    $num_cols++;
                }
                if($checked_boxes[4]) {
                    echo '<td class="ratingCell">Endeudamiento</td>';
                    $num_cols++;
                }
                if($checked_boxes[5]) {
                    echo '<td class="ratingCell">Ahorro neto</td>';
                    $num_cols++;
                }
                if($checked_boxes[6]) {
                    echo '<td class="ratingCell">Fondos líquidos</td>';
                    $num_cols++;
                }
                if($checked_boxes[7]) {
                    echo '<td class="ratingCell">PMP</td>';
                    $num_cols++;
                }
                if($checked_boxes[8]) {
                    echo '<td class="ratingCell">Nivel de ingresos no financieros</td>';
                    $num_cols++;
                }
                if(!empty($gasto)){
                    $num_cols++;
                    if($_REQUEST['gastoMUN']=='personal') echo '<td class="ratingCell">Gastos de personal</td>';
                    else if($_REQUEST['gastoMUN']=='bienesservicios') echo '<td class="ratingCell">Gastos corrientes de bienes y servicios</td>';
                    else if($_REQUEST['gastoMUN']=='financieros') echo '<td class="ratingCell">Gastos financieros</td>';
                    else if($_REQUEST['gastoMUN']=='inversiones') echo '<td class="ratingCell">Inversiones</td>';
                }
                if(!empty($prog)){
                    $num_cols++;
                    if($_REQUEST['progMUN']=='agspc') echo '<td class="ratingCell">Administración general de la seguridad y protección civil</td>';
                    else if($_REQUEST['progMUN']=='sop') echo '<td class="ratingCell">Seguridad y orden público</td>';
                    else if($_REQUEST['progMUN']=='ote') echo '<td class="ratingCell">Ordenación del tráfico y del estacionamiento</td>';
                    else if($_REQUEST['progMUN']=='mu') echo '<td class="ratingCell">Movilidad urbana</td>';
                    else if($_REQUEST['progMUN']=='pc') echo '<td class="ratingCell">Protección civil</td>';
                    else if($_REQUEST['progMUN']=='spei') echo '<td class="ratingCell">Servicio de prevención y extinción de incendios</td>';
                    else if($_REQUEST['progMUN']=='pgvpp') echo '<td class="ratingCell">Promoción y gestión de vivienda de protección pública</td>';
                    else if($_REQUEST['progMUN']=='cre') echo '<td class="ratingCell">Conservación y rehabilitación de la edificación</td>';
                    else if($_REQUEST['progMUN']=='pvp') echo '<td class="ratingCell">Pavimentación de vías públicas</td>';
                    else if($_REQUEST['progMUN']=='a') echo '<td class="ratingCell">Alcantarillado</td>';
                    else if($_REQUEST['progMUN']=='rgtr') echo '<td class="ratingCell">Recogida, gestión y tratamiento de residuos</td>';
                    else if($_REQUEST['progMUN']=='rr') echo '<td class="ratingCell">Recogida de residuos</td>';
                    else if($_REQUEST['progMUN']=='grsu') echo '<td class="ratingCell">Gestión de residuos sólidos urbanos</td>';
                    else if($_REQUEST['progMUN']=='tr') echo '<td class="ratingCell">Tratamiento de residuos</td>';
                    else if($_REQUEST['progMUN']=='lv') echo '<td class="ratingCell">Limpieza viaria</td>';
                    else if($_REQUEST['progMUN']=='csf') echo '<td class="ratingCell">Cementerios y servicios funerarios</td>';
                    else if($_REQUEST['progMUN']=='ap') echo '<td class="ratingCell">Alumbrado público</td>';
                    else if($_REQUEST['progMUN']=='pj') echo '<td class="ratingCell">Parques y jardines</td>';
                    else if($_REQUEST['progMUN']=='p') echo '<td class="ratingCell">Pensiones</td>';
                    else if($_REQUEST['progMUN']=='ssps') echo '<td class="ratingCell">Servicios sociales y promoción social</td>';
                    else if($_REQUEST['progMUN']=='fe') echo '<td class="ratingCell">Fomento del empleo</td>';
                    else if($_REQUEST['progMUN']=='s') echo '<td class="ratingCell">Sanidad</td>';
                    else if($_REQUEST['progMUN']=='e') echo '<td class="ratingCell">Educación</td>';
                    else if($_REQUEST['progMUN']=='c') echo '<td class="ratingCell">Cultura</td>';
                    else if($_REQUEST['progMUN']=='d') echo '<td class="ratingCell">Deporte</td>';
                    else if($_REQUEST['progMUN']=='agp') echo '<td class="ratingCell">Agricultura, ganadería y pesca</td>';
                    else if($_REQUEST['progMUN']=='ie') echo '<td class="ratingCell">Industria y energía</td>';
                    else if($_REQUEST['progMUN']=='com') echo '<td class="ratingCell">Comercio</td>';
                    else if($_REQUEST['progMUN']=='tp') echo '<td class="ratingCell">Transporte público</td>';
                    else if($_REQUEST['progMUN']=='it') echo '<td class="ratingCell">Infraestructuras del transporte</td>';
                    else if($_REQUEST['progMUN']=='idi') echo '<td class="ratingCell">Investigación, desarrollo e innovación</td>';
                }
                echo '</tr>';
                $i=0;
                foreach($mun_array as $mun){
                    echo '<tr>';
                    echo '<td class="ratingCell">'.($i+1).'</td>';
                    echo '<td>'.$mun->getNombre().'</td>';
                    if(!empty($mun->getScoring())) echo '<td class="ratingCell">'.$mun->getScoring().'</td>';
                    else if($checked_boxes[0]) echo '<td class="ratingCell">-</td>';
                    if(!empty($mun->getPoblacion())&&$mun->getPoblacion()!=0) echo '<td class="ratingCell">'.number_format($mun->getPoblacion(), 0, '','.').'</td>';
                    else if($checked_boxes[1]) echo '<td class="ratingCell">-</td>';
                    if(!empty($mun->getAutonomia())) echo '<td class="ratingCell">'.($mun->getAutonomia()).'</td>';
                    else if($checked_boxes[2]) echo '<td class="ratingCell">-</td>';
                    if(!empty($mun->getProvincia())) echo '<td class="ratingCell">'.($mun->getProvincia()).'</td>';
                    else if($checked_boxes[3]) echo '<td class="ratingCell">-</td>';
                    if(!empty($mun->getEndeudamiento())&&$mun->getEndeudamiento()!=0) echo '<td class="ratingCell">'.($mun->getEndeudamiento()*100).'%</td>';
                    else if($checked_boxes[4]) echo '<td class="ratingCell">-</td>';
                    if(!empty($mun->getSostenibilidadFinanciera())&&$mun->getSostenibilidadFinanciera()!=0) echo '<td class="ratingCell">'.($mun->getSostenibilidadFinanciera()*100).'%</td>';
                    else if($checked_boxes[5]) echo '<td class="ratingCell">-</td>';
                    if(!empty($mun->getLiquidezInmediata())&&$mun->getLiquidezInmediata()!=0) echo '<td class="ratingCell">'.number_format($mun->getLiquidezInmediata(), 0, '','.').'€</td>';
                    else if($checked_boxes[6]) echo '<td class="ratingCell">-</td>';
                    if(!empty($mun->getPeriodoMedioPagos())&&$mun->getPeriodoMedioPagos()!=0) echo '<td class="ratingCell">'.($mun->getPeriodoMedioPagos()).' días</td>';
                    else if($checked_boxes[7]) echo '<td class="ratingCell">-</td>';
                    if(!empty($mun->getTotalIngresosNoCorrientes1())&&$mun->getTotalIngresosNoCorrientes1()!=0) echo '<td class="ratingCell">'.number_format($mun->getTotalIngresosNoCorrientes1(), 0, '','.').'€</td>';
                    else if($checked_boxes[8]) echo '<td class="ratingCell">-</td>';
                    if(!empty($mun->getGastosPersonal1())&&$mun->getGastosPersonal1()!=0) echo '<td class="ratingCell">'.number_format($mun->getGastosPersonal1(), 0, '','.').'€</td>';
                    else if(!empty($mun->getGastosCorrientesBienesServicios1())&&$mun->getGastosCorrientesBienesServicios1()!=0) echo '<td class="ratingCell">'.number_format($mun->getGastosCorrientesBienesServicios1(), 0, '','.').'€</td>';
                    else if(!empty($mun->getTransferenciasCorrientesGastos1())&&$mun->getTransferenciasCorrientesGastos1()!=0) echo '<td class="ratingCell">'.number_format($mun->getTransferenciasCorrientesGastos1(), 0, '','.').'€</td>';
                    else if(!empty($mun->getInversionesReales1())&&$mun->getInversionesReales1()!=0) echo '<td class="ratingCell">'.number_format($mun->getInversionesReales1(), 0, '','.').'€</td>';
                    else if(!empty($gasto)) echo '<td class="ratingCell">-</td>';
                    if(!empty($mun->getAgspc())&&$mun->getAgspc()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getAgspc(), 0, '','.').'€</td>';
                        $sum+=$mun->getAgspc();
                    }
                    else if(!empty($mun->getSop())&&$mun->getSop()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getSop(), 0, '','.').'€</td>';
                        $sum+=$mun->getSop();
                    }
                    else if(!empty($mun->getOte())&&$mun->getOte()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getOte(), 0, '','.').'€</td>';
                        $sum+=$mun->getOte();
                    }
                    else if(!empty($mun->getMu())&&$mun->getMu()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getMu(), 0, '','.').'€</td>';
                        $sum+=$mun->getMu();
                    }
                    else if(!empty($mun->getPc())&&$mun->getPc()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getPc(), 0, '','.').'€</td>';
                        $sum+=$mun->getPc();
                    }
                    else if(!empty($mun->getSpei())&&$mun->getSpei()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getSpei(), 0, '','.').'€</td>';
                        $sum+=$mun->getSpei();
                    }
                    else if(!empty($mun->getPgvpp())&&$mun->getPgvpp()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getPgvpp(), 0, '','.').'€</td>';
                        $sum+=$mun->getPgvpp();
                    }
                    else if(!empty($mun->getCre())&&$mun->getCre()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getCre(), 0, '','.').'€</td>';
                        $sum+=$mun->getCre();
                    }
                    else if(!empty($mun->getPvp())&&$mun->getPvp()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getPvp(), 0, '','.').'€</td>';
                        $sum+=$mun->getPvp();
                    }
                    else if(!empty($mun->getA())&&$mun->getA()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getA(), 0, '','.').'€</td>';
                        $sum+=$mun->getA();
                    }
                    else if(!empty($mun->getRgtr())&&$mun->getRgtr()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getRgtr(), 0, '','.').'€</td>';
                        $sum+=$mun->getRgtr();
                    }
                    else if(!empty($mun->getRr())&&$mun->getRr()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getRr(), 0, '','.').'€</td>';
                        $sum+=$mun->getRr();
                    }
                    else if(!empty($mun->getGrsu())&&$mun->getGrsu()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getGrsu(), 0, '','.').'€</td>';
                        $sum+=$mun->getGrsu();
                    }
                    else if(!empty($mun->getTr())&&$mun->getTr()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getTr(), 0, '','.').'€</td>';
                        $sum+=$mun->getTr();
                    }
                    else if(!empty($mun->getLv())&&$mun->getLv()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getLv(), 0, '','.').'€</td>';
                        $sum+=$mun->getLv();
                    }
                    else if(!empty($mun->getCsf())&&$mun->getCsf()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getCsf(), 0, '','.').'€</td>';
                        $sum+=$mun->getCsf();
                    }
                    else if(!empty($mun->getAp())&&$mun->getAp()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getAp(), 0, '','.').'€</td>';
                        $sum+=$mun->getAp();
                    }
                    else if(!empty($mun->getPj())&&$mun->getPj()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getPj(), 0, '','.').'€</td>';
                        $sum+=$mun->getPj();
                    }
                    else if(!empty($mun->getP())&&$mun->getP()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getP(), 0, '','.').'€</td>';
                        $sum+=$mun->getP();
                    }
                    else if(!empty($mun->getSsps())&&$mun->getSsps()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getSsps(), 0, '','.').'€</td>';
                        $sum+=$mun->getSsps();
                    }
                    else if(!empty($mun->getFe())&&$mun->getFe()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getFe(), 0, '','.').'€</td>';
                        $sum+=$mun->getFe();
                    }
                    else if(!empty($mun->getS())&&$mun->getS()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getS(), 0, '','.').'€</td>';
                        $sum+=$mun->getS();
                    }
                    else if(!empty($mun->getE())&&$mun->getE()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getE(), 0, '','.').'€</td>';
                        $sum+=$mun->getE();
                    }
                    else if(!empty($mun->getC())&&$mun->getC()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getC(), 0, '','.').'€</td>';
                        $sum+=$mun->getC();
                    }
                    else if(!empty($mun->getD())&&$mun->getD()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getD(), 0, '','.').'€</td>';
                        $sum+=$mun->getD();
                    }
                    else if(!empty($mun->getAgp())&&$mun->getAgp()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getAgp(), 0, '','.').'€</td>';
                        $sum+=$mun->getAgp();
                    }
                    else if(!empty($mun->getIe())&&$mun->getIe()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getIe(), 0, '','.').'€</td>';
                        $sum+=$mun->getIe();
                    }
                    else if(!empty($mun->getCom())&&$mun->getCom()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getCom(), 0, '','.').'€</td>';
                        $sum+=$mun->getCom();
                    }
                    else if(!empty($mun->getTp())&&$mun->getTp()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getTp(), 0, '','.').'€</td>';
                        $sum+=$mun->getTp();
                    }
                    else if(!empty($mun->getIt())&&$mun->getIt()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getIt(), 0, '','.').'€</td>';
                        $sum+=$mun->getIt();
                    }
                    else if(!empty($mun->getIdi())&&$mun->getIdi()!=0) {
                        echo '<td class="ratingCell">'.number_format($mun->getIdi(), 0, '','.').'€</td>'; 
                        $sum+=$mun->getIdi();
                    }
                    else if(!empty($prog)) echo '<td class="ratingCell">-</td>';
                    echo '</tr>';
                    $i+=1;
                }
                if(!empty($prog)){
                    echo'<tfoot>';
                    echo'<tr>';
                    echo'<td colspan="'.($num_cols+1).'">Total gasto</td>';
                    echo'<td class="ratingCell">'.number_format($sum, 0, '','.').'€</td>';
                    echo'</tr>';
                    echo'</tfoot>';
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