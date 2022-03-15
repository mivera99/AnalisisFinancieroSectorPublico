<?php
session_start();
require_once('includesWeb/daos/DAOConsultor.php');

$nombre = htmlspecialchars(trim(strip_tags(urldecode($_GET["dip"]))));

$daodip = new DAOConsultor();
$diputacion = $daodip->getDiputacion($nombre);


$dip2018 = $daodip->getEconomiaDIP(new Diputacion(), $diputacion->getCodigo(), 2018);
$dip2019 = $daodip->getEconomiaDIP(new Diputacion(), $diputacion->getCodigo(), 2019);
$dip2020 = $daodip->getEconomiaDIP(new Diputacion(), $diputacion->getCodigo(), 2020);

setcookie("dip", $nombre);

$encontrado = false;
if($diputacion){
    $encontrado = true;
    /*Preparación de datos para las gráficas*/
    /*Ingresos Corrientes*/
    $datosIngresosCor = array();
    $etiquetasIngresosCor = array();
    array_push($etiquetasIngresosCor,"2018","2019","2020");
    array_push($datosIngresosCor,$dip2018->getTotalIngresosCorrientes1(),$dip2019->getTotalIngresosCorrientes1(),$dip2020->getTotalIngresosCorrientes1());

    /*Ingresos no Financieros*/
    $datosIngresosNoFinancieros = array();
    $etiquetasIngresosNoFinancieros = array();
    array_push($etiquetasIngresosNoFinancieros,"2018","2019","2020");
    array_push($datosIngresosNoFinancieros,$dip2018->getTotalIngresosNoCorrientes1(),$dip2019->getTotalIngresosNoCorrientes1(),$dip2020->getTotalIngresosNoCorrientes1());

    /*Ingresos Totales*/
    $datosIngresosTotales = array();
    $etiquetasIngresosTotales = array();
    array_push($datosIngresosTotales,"2018","2019","2020");
    array_push($etiquetasIngresosTotales,$dip2018->getTotalIngresos1(),$dip2019->getTotalIngresos1(),$dip2020->getTotalIngresos1());
    
    /*Gastos Corrientes*/
    $datosGastosCor = array();
    $etiquetasGastosCor = array();
    array_push($etiquetasGastosCor,"2018","2019","2020");
    array_push($datosGastosCor,$dip2018->getTotalGastosCorrientes1(),$dip2019->getTotalGastosCorrientes1(),$dip2020->getTotalGastosCorrientes1());

    /*Gastos no Financieros*/
    $datosGastosNoFinancieros = array();
    $etiquetasGastosNoFinancieros = array();
    array_push($etiquetasGastosNoFinancieros,"2018","2019","2020");
    array_push($datosGastosNoFinancieros,$dip2018->getTotalGastosNoFinancieros1(),$dip2019->getTotalGastosNoFinancieros1(),$dip2020->getTotalGastosNoFinancieros1());

    /*Gastos Totales*/
    $datosGastosTotales = array();
    $etiquetasGastosTotales = array();
    array_push($datosGastosTotales,"2018","2019","2020");
    array_push($etiquetasGastosTotales,$dip2018->getTotalGastos1(),$dip2019->getTotalGastos1(),$dip2020->getTotalGastos1());

    /*Endeudamiento*/
    $datosEndeudamiento = array();
    $etiquetasEndeudamiento = array();
    array_push($etiquetasEndeudamiento,"2019","2020");
    array_push($datosEndeudamiento,$dip2019->getEndeudamiento()*100,$dip2020->getEndeudamiento()*100);

    /*Endeudamiento Medio Diputaciones*/
    $datosEndeudamientoM = array();
    $etiquetasEndeudamientoM = array();
    array_push($etiquetasEndeudamientoM,"2019","2020");
    array_push($datosEndeudamientoM,$dip2019->getEndeudamientoMediaDiputaciones()*100,$dip2020->getEndeudamientoMediaDiputaciones()*100);

    /*Sostenibilidad Financiera*/
    $datosSostenibilidadFinanciera = array();
    $etiquetas20192020 = array();
    array_push($etiquetas20192020,"2019","2020");
    array_push($datosSostenibilidadFinanciera,$dip2019->getSostenibilidadFinanciera()*100,$dip2020->getSostenibilidadFinanciera()*100);

    /*Sostenibilidad Financiera Media*/
    $datosSostenibilidadFinancieraM = array();
    array_push($datosSostenibilidadFinancieraM,$dip2019->getSostenibilidadFinancieraMediaDiputaciones()*100,$dip2020->getSostenibilidadFinancieraMediaDiputaciones()*100);

    /*Apalancamiento*/
    $datosApalancamiento = array();
    array_push($datosApalancamiento,$dip2019->getApalancamientoOperativo()*100,$dip2020->getApalancamientoOperativo()*100);

    /*Apalancamiento Media*/
    $datosApalancamientoM = array();
    array_push($datosApalancamientoM,$dip2019->getApalancamientoOperativoMediaDiputaciones()*100,$dip2020->getApalancamientoOperativoMediaDiputaciones()*100);

    /*Sostenibilidad Deuda*/
    $datosSostenibilidadDeuda = array();
    array_push($datosSostenibilidadDeuda,$dip2019->getSostenibilidadDeuda()*100,$dip2020->getSostenibilidadDeuda()*100);

    /*Sostenibilidad Deuda Media*/
    $datosSostenibilidadDeudaM = array();
    array_push($datosSostenibilidadDeudaM,$dip2019->getSostenibilidadDeudaMediaDiputaciones()*100,$dip2020->getSostenibilidadDeudaMediaDiputaciones()*100);

    /*Remanente Tesoreria*/
    $datosRemanenteTesoreria = array();
    array_push($datosRemanenteTesoreria,$dip2019->getRemanenteTesoreriaGastosGenerales()*100,$dip2020->getRemanenteTesoreriaGastosGenerales()*100);

    /*Remanente Tesoreria Media*/
    $datosRemanenteTesoreriaM = array();
    array_push($datosRemanenteTesoreriaM,$dip2019->getRemanenteTesoreriaGastosGeneralesMediaDiputaciones()*100,$dip2020->getRemanenteTesoreriaGastosGeneralesMediaDiputaciones()*100);

    /*Liquidez Inmediata*/
    $datosLiquidezInmediata = array();
    array_push($datosLiquidezInmediata,$dip2019->getLiquidezInmediata()*100,$dip2020->getLiquidezInmediata()*100);

    /*Liquidez Inmediata M*/
    $datosLiquidezInmediataM = array();
    array_push($datosLiquidezInmediataM,$dip2019->getSolvenciaCortoPlazoMediaDiputaciones()*100,$dip2020->getSolvenciaCortoPlazoMediaDiputaciones()*100);

    /*Solvencia Corto Plazo*/
    $datosSolvenciaCortoPlazo = array();
    array_push($datosSolvenciaCortoPlazo,$dip2019->getSolvenciaCortoPlazo()*100,$dip2020->getSolvenciaCortoPlazo()*100);

    /*Solvencia Corto Plazo Media*/
    $datosSolvenciaCortoPlazoM = array();
    array_push($datosSolvenciaCortoPlazoM,$dip2019->getSolvenciaCortoPlazoMediaDiputaciones2()*100,$dip2020->getSolvenciaCortoPlazoMediaDiputaciones2()*100);

    /*Eficiencia*/
    $datosEficiencia = array();
    array_push($datosEficiencia,$dip2019->getEficiencia()*100,$dip2020->getEficiencia()*100);

    /*Eficiencia Media*/
    $datosEficienciaM = array();
    array_push($datosEficienciaM,$dip2019->getEficienciaMediaDiputaciones()*100,$dip2020->getEficienciaMediaDiputaciones()*100);

    /*Ejecucion Ingresos Corrientes*/
    $datosEjecucionIngresosCorrientes = array();
    array_push($datosEjecucionIngresosCorrientes,$dip2019->getEjecucionIngresosCorrientes()*100,$dip2020->getEjecucionIngresosCorrientes()*100);

    /*Ejecucion Ingresos Corrientes Media*/
    $datosEjecucionIngresosCorrientesM = array();
    array_push($datosEjecucionIngresosCorrientesM,$dip2019->getEjecucionIngresosCorrientesMediaDiputaciones()*100,$dip2020->getEjecucionIngresosCorrientesMediaDiputaciones()*100);

    /*Ejecucion Gastos Corrientes*/
    $datosEjecucionGastosCorrientes = array();
    array_push($datosEjecucionGastosCorrientes,$dip2019->getEjecucionGastosCorrientes()*100,$dip2020->getEjecucionGastosCorrientes()*100);

    /*Ejecucion Gastos Corrientes Media*/
    $datosEjecucionGastosCorrientesM = array();
    array_push($datosEjecucionGastosCorrientesM,$dip2019->getEjecucionGastosCorrientesMediaDiputaciones()*100,$dip2020->getEjecucionGastosCorrientesMediaDiputaciones()*100);
   
    /*PMP*/
    $datosPMP = array();
    array_push($datosPMP,$dip2019->getPeriodoMedioPagos(),$dip2020->getPeriodoMedioPagos());

    /*PMP Media*/
    $datosPMPM = array();
    array_push($datosPMPM,$dip2019->getPeriodoMedioPagosMediaDiputaciones(),$dip2020->getPeriodoMedioPagosMediaDiputaciones());
       
    /*Pagos sobre Obligaciones Reconocidas*/
    $datosPagosSobreObligaciones = array();
    array_push($datosPagosSobreObligaciones,$dip2019->getPagosSobreObligacionesReconocidas()*100,$dip2020->getPagosSobreObligacionesReconocidas()*100);

    /*Pagos sobre Obligaciones Reconocidas Media*/
    $datosPagosSobreObligacionesM = array();
    array_push($datosPagosSobreObligacionesM,$dip2019->getPagosSobreObligacionesReconocidasMediaDiputaciones()*100,$dip2020->getPagosSobreObligacionesReconocidasMediaDiputaciones()*100);
   
    /*Eficacia Recaudatoria*/
    $datosEficaciaRecaudatoria = array();
    array_push($datosEficaciaRecaudatoria,$dip2019->getEficaciaRecaudatoria()*100,$dip2020->getEficaciaRecaudatoria()*100);

    /*Eficacia Recaudatoria Media*/
    $datosEficaciaRecaudatoriaM = array();
    array_push($datosEficaciaRecaudatoriaM,$dip2019->getEficaciaRecaudatoriaMediaDiputaciones()*100,$dip2020->getEficaciaRecaudatoriaMediaDiputaciones()*100);
}
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

    <title>Análisis Financiero del Sector Público - Diputación</title>
</head>
    <body>

        <div id = "cabecera">
            <?php require("includesWeb/comun/cabecera.php");?>  
        </div>

        <div id ="contenidoDIP"> 
            <h3>Diputación</h3>
            <?php
            if($encontrado){
                echo '<h2>'.$diputacion->getNombre().'</h2>';
                foreach($diputacion->getScoring() as $clave => $valor){
                    echo '<h2>Rating '.$clave.'</h2>';
                    $tend = $diputacion->getTendencia();
                    echo '<button class="scoring '.$valor.'">'.$valor.'</button><p>Tendencia: '.$tend[$clave].'</p>';
                }
            ?>

            <br>
            <button type="button" id="verPDFDIP" onclick="window.open('pdfDIP.php','_blank')">Ver Informe</button>

            <?php

                echo '<br><br>';
                echo '<h2>Información general</h2>';
                echo '<p>Provincia: '.$diputacion->getProvincia().'</p>';
                echo '<p>Autonomía: '.$diputacion->getAutonomia().'</p>';
                echo '<p>CIF: '.$diputacion->getCif().'</p>';
                echo '<p>Via: '.$diputacion->getTipoVia().' '.$diputacion->getNombreVia().' '.$diputacion->getNumVia().'</p>';
                echo '<p>Teléfono: '.$diputacion->getTelefono().'</p>';
                echo '<p>Código Postal: '.$diputacion->getCodigoPostal().'</p>';
                if($diputacion->getFax() == ''){
                    echo '<p>Fax: N/A </p>';
                }
                else{
                    echo '<p>Fax: '.$diputacion->getFax().'</p>';
                }

                if($diputacion->getWeb() == ''){
                    echo '<p><b>Sitio web:  </b>N/A</p>';
                }
                else{
                    echo '<p><b>Sitio web:  </b><a href="https://'.$diputacion->getWeb().'" target="_blank">'.$diputacion->getWeb().'</a></p>';
                }

                if($diputacion->getMail() == ''){
                    echo '<p>Correo electrónico: N/A </p>';
                }
                else{
                    echo '<p>Correo electrónico: '.$diputacion->getMail().'</p>';
                }
            ?>



<br><br>
            <h3>Ingresos (en €)</h3>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th colspan="3" style="height:40px">Liquidación derechos reconocidos</th>
                    </tr>
                    <tr>
                        <th style="height:40px">Ingresos</th>
                        <th>2018</th>
                        <th>2019</th>
                        <th>2020</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>1. Impuestos Directos</td>
                        <td style="width:14%"><?php echo number_format($dip2018->getImpuestosDirectos1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2019->getImpuestosDirectos1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getImpuestosDirectos1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <td>2. Impuestos Indirectos</td>
                        <td style="width:14%"><?php echo number_format($dip2018->getImpuestosIndirectos1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2019->getImpuestosIndirectos1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getImpuestosIndirectos1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <td>3. Tasas, Precios Públicos y Otros Ingresos</td>
                        <td style="width:14%"><?php echo number_format($dip2018->getTasasPreciosOtros1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2019->getTasasPreciosOtros1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getTasasPreciosOtros1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <td>4. Transferencias Corrientes</td>
                        <td style="width:14%"><?php echo number_format($dip2018->getTransferenciasCorrientes1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2019->getTransferenciasCorrientes1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getTransferenciasCorrientes1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <td>5. Ingresos Patrimoniales</td>
                        <td style="width:14%"><?php echo number_format($dip2018->getIngresosPatrimoniales1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2019->getIngresosPatrimoniales1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getIngresosPatrimoniales1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <th style="height:40px">Total Ingresos Corrientes</th>
                        <th><?php echo number_format($dip2018->getTotalIngresosCorrientes1(), 2, ',','.');?></th>
                        <th><?php echo number_format($dip2019->getTotalIngresosCorrientes1(), 2, ',','.');?></th>
                        <th><?php echo number_format($dip2020->getTotalIngresosCorrientes1(), 2, ',','.');?></th>
                    </tr>
                    <tr>
                        <td>6. Enajenación de Inversiones Reales</td>
                        <td style="width:14%"><?php echo number_format($dip2018->getEnajenacionInversionesReales1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2019->getEnajenacionInversionesReales1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getEnajenacionInversionesReales1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <td>7. Transferencias de Capital</td>
                        <td style="width:14%"><?php echo number_format($dip2018->getTransferenciasCapital1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2019->getTransferenciasCapital1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getTransferenciasCapital1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <th style="height:40px">Ingresos No Financieros</th>
                        <th><?php echo number_format($dip2018->getTotalIngresosNoCorrientes1(), 2, ',','.');?></th>
                        <th><?php echo number_format($dip2019->getTotalIngresosNoCorrientes1(), 2, ',','.');?></th>
                        <th><?php echo number_format($dip2020->getTotalIngresosNoCorrientes1(), 2, ',','.');?></th>
                    </tr>
                    <tr>
                        <td>8. Activos Financieros</td>
                        <td style="width:14%"><?php echo number_format($dip2018->getActivosFinancieros1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2019->getActivosFinancieros1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getActivosFinancieros1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <td>9. Pasivos Financieros</td>
                        <td style="width:14%"><?php echo number_format($dip2018->getPasivosFinancieros1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2019->getPasivosFinancieros1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getPasivosFinancieros1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <th style="height:40px">TOTAL INGRESOS</th>
                        <th><?php echo number_format($dip2018->getTotalIngresos1(), 2, ',','.');?></th>
                        <th><?php echo number_format($dip2019->getTotalIngresos1(), 2, ',','.');?></th>
                        <th><?php echo number_format($dip2020->getTotalIngresos1(), 2, ',','.');?></th>
                    </tr>
                </tbody>
                
            </table>
            <br><br>

            <!-- GRÁFICAS INGRESOS -->
            <script>
                var datosI = <?php echo json_encode($datosIngresosCor)?>;
                var etiquetasI = <?php echo json_encode($etiquetasIngresosCor)?>;
                var datosIN = <?php echo json_encode($datosIngresosNoFinancieros)?>;
                var etiquetasIN = <?php echo json_encode($etiquetasIngresosNoFinancieros)?>;
                var datosIT = <?php echo json_encode($datosIngresosTotales)?>;
                var etiquetasIT = <?php echo json_encode($etiquetasIngresosTotales)?>;
            </script>
                            <div class="graficos">
                    <canvas id="ingr" height="300" width="500"></canvas>
                    <canvas id="ingrN" height="300" width="500"></canvas>
                    <canvas id="ingrT" height="300" width="500"></canvas>
                    <br><br>
                </div>
                <script>
                    const chartIngr = document.getElementById('ingr').getContext('2d');
                    const configChartIngr = {
                        type: 'bar',
                        data: {
                            labels:etiquetasI,
                            datasets: [{
                                label: 'Ingresos corrientes al año',
                                data: datosI,
                                backgroundColor: [
                                    'rgba(0, 62, 153, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(0, 62, 153, 1)'
                                ],
                                borderWidth: 2
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            responsive: false,
                            plugins:{
                                title:{
                                    display: true,
                                    text:'Ingresos corrientes',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };
                    const chartIngrN = document.getElementById('ingrN').getContext('2d');
                    const configChartIngrN = {
                        type: 'bar',
                        data: {
                            labels:etiquetasIN,
                            datasets: [{
                                label: 'Ingresos no financieros al año',
                                data: datosIN,
                                backgroundColor: [
                                    'rgba(0, 62, 153, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(0, 62, 153, 1)'
                                ],
                                borderWidth: 2
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            responsive: false,
                            plugins:{
                                title:{
                                    display: true,
                                    text:'Ingresos no financieros',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };
                    const chartIngrT = document.getElementById('ingrT').getContext('2d');
                    const configChartIngrT = {
                        type: 'bar',
                        data: {
                            labels:etiquetasIT,
                            datasets: [{
                                label: 'Ingresos totales al año',
                                data: datosIT,
                                backgroundColor: [
                                    'rgba(0, 62, 153, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(0, 62, 153, 1)'
                                ],
                                borderWidth: 2
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            responsive: false,
                            plugins:{
                                title:{
                                    display: true,
                                    text:'Ingresos totales',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };
                    const ingrcor = new Chart(chartIngr, configChartIngr);
                    const ingrcorN = new Chart(chartIngrN, configChartIngrN);
                    const ingrcorT = new Chart(chartIngrT, configChartIngrT);
                </script>

            <br><br>
            <h3>Gastos (en €)</h3>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th colspan="3" style="height:40px">Liquidación obligaciones reconocidas</th>
                    </tr>
                    <tr>
                    <th style="height:40px">GASTOS</th>
                        <th>2018</th>
                        <th>2019</th>
                        <th>2020</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1. Gastos del Personal</td>
                        <td style="width:14%"><?php echo number_format($dip2018->getGastosPersonal1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2019->getGastosPersonal1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getGastosPersonal1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <td>2. Gastos Corrientes en Bienes y Servicios</td>
                        <td style="width:14%"><?php echo number_format($dip2018->getGastosCorrientesBienesServicios1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2019->getGastosCorrientesBienesServicios1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getGastosCorrientesBienesServicios1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <td>3. Gastos Financieros</td>
                        <td style="width:14%"><?php echo number_format($dip2018->getGastosFinancieros1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2019->getGastosFinancieros1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getGastosFinancieros1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <td>4. Transferencias Corrientes</td>
                        <td style="width:14%"><?php echo number_format($dip2018->getTransferenciasCorrientesGastos1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2019->getTransferenciasCorrientesGastos1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getTransferenciasCorrientesGastos1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <td>5. Fondo de contingencia</td>
                        <td style="width:14%"><?php echo number_format($dip2018->getFondoContingencia1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2019->getFondoContingencia1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getFondoContingencia1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <th style="height:40px">Total gastos corrientes</th>
                        <th><?php echo number_format($dip2018->getTotalGastosCorrientes1(), 2, ',','.');?></th>
                        <th><?php echo number_format($dip2019->getTotalGastosCorrientes1(), 2, ',','.');?></th>
                        <th><?php echo number_format($dip2020->getTotalGastosCorrientes1(), 2, ',','.');?></th>
                    </tr>
                    <tr>
                        <td>6. Inversiones Reales</td>
                        <td style="width:14%"><?php echo number_format($dip2018->getInversionesReales1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2019->getInversionesReales1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getInversionesReales1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <td>7. Transferencias de capital</td>
                        <td style="width:14%"><?php echo number_format($dip2018->getTransferenciasCapitalGastos1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2019->getTransferenciasCapitalGastos1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getTransferenciasCapitalGastos1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <th style="height:40px">Gastos No financieros</th>
                        <th><?php echo number_format($dip2018->getTotalGastosNoFinancieros1(), 2, ',','.');?></th>
                        <th><?php echo number_format($dip2019->getTotalGastosNoFinancieros1(), 2, ',','.');?></th>
                        <th><?php echo number_format($dip2020->getTotalGastosNoFinancieros1(), 2, ',','.');?></th>
                    </tr>
                    <tr>
                        <td>8. Activos Financieros</td>
                        <td style="width:14%"><?php echo number_format($dip2018->getActivosFinancieros1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2019->getActivosFinancieros1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getActivosFinancierosGastos1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <td>9. Pasivos Financieros</td>
                        <td style="width:14%"><?php echo number_format($dip2018->getPasivosFinancierosGastos1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2019->getPasivosFinancierosGastos1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getPasivosFinancierosGastos1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <th style="height:40px">TOTAL GASTOS</th>
                        <th><?php echo number_format($dip2018->getTotalGastos1(), 2, ',','.');?></th>
                        <th><?php echo number_format($dip2019->getTotalGastos1(), 2, ',','.');?></th>
                        <th><?php echo number_format($dip2020->getTotalGastos1(), 2, ',','.');?></th>
                    </tr>
                </tbody>
            </table>
            <br><br>

            <!-- GRAFICAS-->
            <script>
                var datosG = <?php echo json_encode($datosGastosCor)?>;
                var etiquetasG = <?php echo json_encode($etiquetasGastosCor)?>;
                var datosGN = <?php echo json_encode($datosGastosNoFinancieros)?>;
                var etiquetasGN = <?php echo json_encode($etiquetasGastosNoFinancieros)?>;
                var datosGT = <?php echo json_encode($datosGastosTotales)?>;
                var etiquetasGT = <?php echo json_encode($etiquetasGastosTotales)?>;
            </script>
            
            <div class="graficos">
                    <canvas id="gastos" height="300" width="500"></canvas>
                    <canvas id="gastosN" height="300" width="500"></canvas>
                    <canvas id="gastosT" height="300" width="500"></canvas>
                    <br><br>
                </div>
                <script>
                    const chartGastos = document.getElementById('gastos').getContext('2d');
                    const configChartGastos = {
                        type: 'line',
                        data: {
                            labels: etiquetasG,
                            datasets: [{
                                label: 'Gastos corrientes al año',
                                data: datosG,
                                backgroundColor: [
                                    'rgba(0, 62, 153, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(0, 62, 153, 1)'
                                ],
                                borderWidth: 2
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            responsive: false,
                            plugins:{
                                title:{
                                    display: true,
                                    text:'Gastos corrientes',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };
                    const chartGastosN = document.getElementById('gastosN').getContext('2d');
                    const configChartGastosN = {
                        type: 'line',
                        data: {
                            labels:etiquetasGN,
                            datasets: [{
                                label: 'Gastos no financieros al año',
                                data: datosGN,
                                backgroundColor: [
                                    'rgba(0, 62, 153, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(0, 62, 153, 1)'
                                ],
                                borderWidth: 2
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            responsive: false,
                            plugins:{
                                title:{
                                    display: true,
                                    text:'Gastos no financieros',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };
                    const chartGastosT = document.getElementById('gastosT').getContext('2d');
                    const configChartGastosT = {
                        type: 'line',
                        data: {
                            labels:etiquetasGT,
                            datasets: [{
                                label: 'Gastos totales',
                                data: datosGT,
                                backgroundColor: [
                                    'rgba(0, 62, 153, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(0, 62, 153, 1)'
                                ],
                                borderWidth: 2
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            responsive: false,
                            plugins:{
                                title:{
                                    display: true,
                                    text:'Gastos totales',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };
                    const gastos = new Chart(chartGastos, configChartGastos);
                    const gastosN = new Chart(chartGastosN, configChartGastosN);
                    const gastosT = new Chart(chartGastosT, configChartGastosT);
                </script>

            <br><br>

            <h3>Endeudamiento</h3>
            <br>
            <p><b>Deuda Financiera 2020: </b><?php echo number_format($dip2020->getDeudaFinanciera(), 2, ',','.') . "€";?></p>
            <p><b>Deuda Financiera 2019: </b><?php echo number_format($dip2019->getDeudaFinanciera(), 2, ',','.') . "€";?></p>
            <br>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>2019</th>
                        <th>2020</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                            <div class="celda-endeudamiento">
                                Endeudamiento
                                <div class="info">
                                    <img src="info.svg" alt="información" height="14px">
                                    <span class="extra-info">Mide la deuda sobre ingresos corrientes. Mejor cuanto más bajo</span>
                                </div>
                            </div>
                        </th>
                        <td style="width:14%"><?php echo number_format($dip2019->getEndeudamiento()*100, 2, ',','.') . "%";?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getEndeudamiento()*100, 2, ',','.') . "%";?></td>
                    </tr>
                    <tr>
                        <th>Endeudamiento Media Diputaciones</th>
                        <td style="width:14%"><?php echo number_format($dip2019->getEndeudamientoMediaDiputaciones()*100, 2, ',','.') . "%";?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getEndeudamientoMediaDiputaciones()*100, 2, ',','.') . "%";?></td>
                    </tr>
                </tbody>
            </table>
            <br><br>
            <!--GRÁFICAS-->
            <script>
                var datosE = <?php echo json_encode($datosEndeudamiento)?>;
                var etiquetasE = <?php echo json_encode($etiquetas20192020)?>;
                var datosEM = <?php echo json_encode($datosEndeudamientoM)?>;
                var etiquetasEM = <?php echo json_encode($etiquetas20192020)?>;
            </script>
            <div class="graficos">
                    <canvas id="end" height="300" width="500"></canvas>
                    <canvas id="endM" height="300" width="500"></canvas>
                    <br><br>
            </div>
            <script>
                const chartEnd = document.getElementById('end').getContext('2d');
                const configEnd = {
                    type: 'bar',
                    data: {
                        labels:etiquetasE,
                        datasets: [{
                            label: 'Endeudamiento anual',
                            data: datosE,
                            backgroundColor: [
                                'rgba(0, 62, 153, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 62, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: false,
                        plugins:{
                            title:{
                                display: true,
                                text:'Endeudamiento',
                                color: '#003E99',
                                font:{
                                    size:20
                                }
                            }
                        }
                    }
                };
                const chartEndM = document.getElementById('endM').getContext('2d');
                const configEndM = {
                    type: 'bar',
                    data: {
                        labels:etiquetasEM,
                        datasets: [{
                            label: 'Endeudamiento Medio Diputaciones Anual',
                            data: datosEM,
                            backgroundColor: [
                                'rgba(0, 62, 153, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 62, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: false,
                        plugins:{
                            title:{
                                display: true,
                                text:'Endeudamiento Medio Diputaciones',
                                color: '#003E99',
                                font:{
                                    size:20
                                }
                            }
                        }
                    }
                };
                const end = new Chart(chartEnd, configEnd);
                const endM = new Chart(chartEndM, configEndM);
            </script>






            <h3>Solvencia</h3>
            <br>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>2019</th>
                        <th>2020</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                        <div class="celda-sostenibilidad-financiera">
                            Sostenibilidad Financiera
                            <div class="info">
                                <img src="info.svg" alt="información" height="14px">
                                <span class="extra-info">Mide el ahorro sobre ingresos corrientes. Mejor cuanto más alto</span>
                            </div>
                        </div>
                        </th>
                        <td style="width:14%"><?php echo number_format($dip2019->getSostenibilidadFinanciera()*100, 2, ',','.') . "%";?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getSostenibilidadFinanciera()*100, 2, ',','.') . "%";?></td>
                    </tr>
                    <tr>
                        <th>Sostenibilidad Financiera Media Diputaciones</th>
                        <td style="width:14%"><?php echo number_format($dip2019->getSostenibilidadFinancieraMediaDiputaciones()*100, 2, ',','.') . "%";?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getSostenibilidadFinancieraMediaDiputaciones()*100, 2, ',','.') . "%";?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>2019</th>
                        <th>2020</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                        <div class="celda-apalancamiento">
                            Apalancamiento 
                            <div class="info-apalancamiento">
                                <img src="info.svg" alt="información" height="14px">
                                <span class="extra-info">Mide gastos de difícil ajuste (personal, amortización e intereses) sobre ingresos corrientes</span>
                            </div>
                        </div>
                        </th>
                        <td style="width:14%"><?php echo number_format($dip2019->getApalancamientoOperativo()*100, 2, ',','.') . "%";?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getApalancamientoOperativo()*100, 2, ',','.') . "%";?></td>
                    </tr>
                    <tr>
                        <th>Apalancamiento Operativo Media Diputaciones</th>
                        <td style="width:14%"><?php echo number_format($dip2019->getApalancamientoOperativoMediaDiputaciones()*100, 2, ',','.') . "%";?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getApalancamientoOperativoMediaDiputaciones()*100, 2, ',','.') . "%";?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>2019</th>
                        <th>2020</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                        <div class="celda-sostenibilidad-deuda">
                            Sostenibilidad de la Deuda
                            <div class="info-sostenibilidad-deuda">
                                <img src="info.svg" alt="información" height="14px">
                                <span class="extra-info">Mide la carga financiera entre ingresos corrientes</span>
                            </div>
                        </div>
                        </th>
                        <td style="width:14%"><?php echo number_format($dip2019->getSostenibilidadDeuda()*100, 2, ',','.') . "%";?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getSostenibilidadDeuda()*100, 2, ',','.') . "%";?></td>
                    </tr>
                    <tr>
                        <th>Sostenibilidad de la Deuda Media Diputaciones</th>
                        <td style="width:14%"><?php echo number_format($dip2019->getSostenibilidadDeudaMediaDiputaciones()*100, 2, ',','.') . "%";?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getSostenibilidadDeudaMediaDiputaciones()*100, 2, ',','.') . "%";?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <br>

            <!--GRÁFICAS-->
            <script>
                var datosSostenibilidadFinanciera = <?php echo json_encode($datosSostenibilidadFinanciera)?>;
                var etiquetas20192020 = <?php echo json_encode($etiquetas20192020)?>;
                var datosSostenibilidadFinancieraM = <?php echo json_encode($datosSostenibilidadFinancieraM)?>;
            </script>
            <div class="graficos">
                    <canvas id="sosFin" height="300" width="500"></canvas>
                    <canvas id="sosFinM" height="300" width="500"></canvas>
                    <br><br>
            </div>
            <script>
                const chartSosFin = document.getElementById('sosFin').getContext('2d');
                const configSosFin = {
                    type: 'bar',
                    data: {
                        labels:etiquetas20192020,
                        datasets: [{
                            label: 'Sostenibilidad Financiera',
                            data: datosSostenibilidadFinanciera,
                            backgroundColor: [
                                'rgba(0, 62, 153, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 62, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: false,
                        plugins:{
                            title:{
                                display: true,
                                text:'Sostenibilidad Financiera',
                                color: '#003E99',
                                font:{
                                    size:20
                                }
                            }
                        }
                    }
                };
                const chartSosFinM = document.getElementById('sosFinM').getContext('2d');
                const configSosFinM = {
                    type: 'bar',
                    data: {
                        labels:etiquetas20192020,
                        datasets: [{
                            label: 'Sostenibilidad Financiera Media Diputaciones',
                            data: datosSostenibilidadFinancieraM,
                            backgroundColor: [
                                'rgba(0, 62, 153, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 62, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: false,
                        plugins:{
                            title:{
                                display: true,
                                text:'Sostenibilidad Financiera Media Diputaciones',
                                color: '#003E99',
                                font:{
                                    size:20
                                }
                            }
                        }
                    }
                };
                const sosFin = new Chart(chartSosFin, configSosFin);
                const sosFinM = new Chart(chartSosFinM, configSosFinM);
            </script>

            <br><br>

            <script>
                var datosApalancamiento = <?php echo json_encode($datosApalancamiento)?>;
                var datosApalancamientoM = <?php echo json_encode($datosApalancamientoM)?>;
            </script>
            <div class="graficos">
                    <canvas id="apal" height="300" width="500"></canvas>
                    <canvas id="apalM" height="300" width="500"></canvas>
                    <br><br>
            </div>
            <script>
                const chartApal = document.getElementById('apal').getContext('2d');
                const configApal = {
                    type: 'bar',
                    data: {
                        labels:etiquetas20192020,
                        datasets: [{
                            label: 'Apalancamiento Operativo',
                            data: datosApalancamiento,
                            backgroundColor: [
                                'rgba(0, 62, 153, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 62, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: false,
                        plugins:{
                            title:{
                                display: true,
                                text:'Apalancamiento Operativo',
                                color: '#003E99',
                                font:{
                                    size:20
                                }
                            }
                        }
                    }
                };
                const chartApalM = document.getElementById('apalM').getContext('2d');
                const configApalM = {
                    type: 'bar',
                    data: {
                        labels:etiquetas20192020,
                        datasets: [{
                            label: 'Apalancamiento Operativo Media Diputaciones',
                            data: datosApalancamientoM,
                            backgroundColor: [
                                'rgba(0, 62, 153, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 62, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: false,
                        plugins:{
                            title:{
                                display: true,
                                text:'Apalancamiento Operativo Medio Diputaciones',
                                color: '#003E99',
                                font:{
                                    size:20
                                }
                            }
                        }
                    }
                };
                const apal = new Chart(chartApal, configApal);
                const apalM = new Chart(chartApalM, configApalM);
            </script>

            <br><br>

            <script>
                var datosSostenibilidadDeuda = <?php echo json_encode($datosSostenibilidadDeuda)?>;
                var datosSostenibilidadDeudaM = <?php echo json_encode($datosSostenibilidadDeudaM)?>;
            </script>
            <div class="graficos">
                    <canvas id="sosDeu" height="300" width="500"></canvas>
                    <canvas id="sosDeuM" height="300" width="500"></canvas>
                    <br><br>
            </div>
            <script>
                const charSosDeu = document.getElementById('sosDeu').getContext('2d');
                const configSosDeu = {
                    type: 'bar',
                    data: {
                        labels:etiquetas20192020,
                        datasets: [{
                            label: 'Sostenibilidad Deuda',
                            data: datosSostenibilidadDeuda,
                            backgroundColor: [
                                'rgba(0, 62, 153, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 62, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: false,
                        plugins:{
                            title:{
                                display: true,
                                text:'Sostenibilidad Deuda',
                                color: '#003E99',
                                font:{
                                    size:20
                                }
                            }
                        }
                    }
                };
                const charSosDeuM = document.getElementById('sosDeuM').getContext('2d');
                const configSosDeuM = {
                    type: 'bar',
                    data: {
                        labels:etiquetas20192020,
                        datasets: [{
                            label: 'Sostenibilidad Deuda Media Diputaciones',
                            data: datosSostenibilidadDeudaM,
                            backgroundColor: [
                                'rgba(0, 62, 153, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 62, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: false,
                        plugins:{
                            title:{
                                display: true,
                                text:'Sostenibilidad Deuda Media Diputaciones',
                                color: '#003E99',
                                font:{
                                    size:20
                                }
                            }
                        }
                    }
                };
                const sosDeu = new Chart(charSosDeu, configSosDeu);
                const sosDeuM = new Chart(charSosDeuM, configSosDeuM);
            </script>


            <!-- TO DO -->
            <h3>Liquidez</h3>
            <br>
            <p><b>Fondos líquidos 2020: </b><?php echo number_format($dip2020->getFondosLiquidos(), 2, ',','.') . "€";?></p>
            <p><b>Fondos líquidos 2019: </b><?php echo number_format($dip2019->getFondosLiquidos(), 2, ',','.') . "€";?></p>
            <br>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>2019</th>
                        <th>2020</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                        <div class="celda-remanente">
                            Remanente de Tesorería Gastos Generales
                            <div class="info">
                                <img src="info.svg" alt="información" height="14px">
                                <span class="extra-info">Mide el remanente de tesorería entre ingresos corrientes</span>
                            </div>
                        </div>
                        </th>
                        <td style="width:14%"><?php echo number_format($dip2019->getRemanenteTesoreriaGastosGenerales()*100, 2, ',','.') . "%";?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getRemanenteTesoreriaGastosGenerales()*100, 2, ',','.') . "%";?></td>
                    </tr>
                    <tr>
                        <th>Remanente de Tesorería Gastos Generales Media Diputaciones</th>
                        <td style="width:14%"><?php echo number_format($dip2019->getRemanenteTesoreriaGastosGeneralesMediaDiputaciones()*100, 2, ',','.') . "%";?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getRemanenteTesoreriaGastosGeneralesMediaDiputaciones()*100, 2, ',','.') . "%";?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>2019</th>
                        <th>2020</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                        <div class="celda-liquidez-inmediata">
                            Liquidez Inmediata
                            <div class="info">
                                <img src="info.svg" alt="información" height="14px">
                                <span class="extra-info">Mide los fondos líquidos entre obligaciones pendientes de pago</span>
                            </div>
                        </div>
                        </th>
                        <td style="width:14%"><?php echo number_format($dip2019->getLiquidezInmediata()*100, 2, ',','.') . "%";?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getLiquidezInmediata()*100, 2, ',','.') . "%";?></td>
                    </tr>
                    <tr>
                        <th>Solvencia Corto Plazo Media Diputaciones</th>
                        <td style="width:14%"><?php echo number_format($dip2019->getSolvenciaCortoPlazoMediaDiputaciones()*100, 2, ',','.') . "%";?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getSolvenciaCortoPlazoMediaDiputaciones()*100, 2, ',','.') . "%";?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>2019</th>
                        <th>2020</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                        <div class="celda-solvencia-corto">
                            Solvencia Corto Plazo
                            <div class="info">
                                <img src="info.svg" alt="información" height="14px">
                                <span class="extra-info">Mide fondos líquidos + derechos pendientes de cobro entre obligaciones pendientes de pago</span>
                            </div>
                        </div>
                        </th>
                        <td style="width:14%"><?php echo number_format($dip2019->getSolvenciaCortoPlazo()*100, 2, ',','.') . "%";?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getSolvenciaCortoPlazo()*100, 2, ',','.') . "%";?></td>
                    </tr>
                    <tr>
                        <th>Solvencia Corto Plazo Media Diputaciones</th>
                        <td style="width:14%"><?php echo number_format($dip2019->getSolvenciaCortoPlazoMediaDiputaciones2()*100, 2, ',','.') . "%";?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getSolvenciaCortoPlazoMediaDiputaciones2()*100, 2, ',','.') . "%";?></td>
                    </tr>
                </tbody>
            </table>
            <br><br>

            <script>
                var datosRemanenteTesoreria = <?php echo json_encode($datosRemanenteTesoreria)?>;
                var datosRemanenteTesoreriaM = <?php echo json_encode($datosRemanenteTesoreriaM)?>;
            </script>
            <div class="graficos">
                    <canvas id="reman" height="300" width="500"></canvas>
                    <canvas id="remanM" height="300" width="500"></canvas>
                    <br><br>
            </div>
            <script>
                const charReman = document.getElementById('reman').getContext('2d');
                const configReman = {
                    type: 'bar',
                    data: {
                        labels:etiquetas20192020,
                        datasets: [{
                            label: 'Remanente de Tesorería Gastos Generales',
                            data: datosRemanenteTesoreria,
                            backgroundColor: [
                                'rgba(0, 62, 153, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 62, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: false,
                        plugins:{
                            title:{
                                display: true,
                                text:'Remanente de Tesorería Gastos Generales',
                                color: '#003E99',
                                font:{
                                    size:20
                                }
                            }
                        }
                    }
                };
                const charRemanM = document.getElementById('remanM').getContext('2d');
                const configRemanM = {
                    type: 'bar',
                    data: {
                        labels:etiquetas20192020,
                        datasets: [{
                            label: 'Remanente de Tesorería Gastos Generales Media Diputaciones',
                            data: datosRemanenteTesoreriaM,
                            backgroundColor: [
                                'rgba(0, 62, 153, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 62, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: false,
                        plugins:{
                            title:{
                                display: true,
                                text:'Remanente de Tesorería Gastos Generales Media Diputaciones',
                                color: '#003E99',
                                font:{
                                    size:20
                                }
                            }
                        }
                    }
                };
                const reman = new Chart(charReman, configReman);
                const remanM = new Chart(charRemanM, configRemanM);
            </script>
            <br><br>

            <script>
                var datosLiquidezInmediata = <?php echo json_encode($datosLiquidezInmediata)?>;
                var datosLiquidezInmediataM = <?php echo json_encode($datosLiquidezInmediataM)?>;
            </script>
            <div class="graficos">
                    <canvas id="liqI" height="300" width="500"></canvas>
                    <canvas id="liqIM" height="300" width="500"></canvas>
                    <br><br>
            </div>
            <script>
                const charLiqI = document.getElementById('liqI').getContext('2d');
                const configLiqI = {
                    type: 'bar',
                    data: {
                        labels:etiquetas20192020,
                        datasets: [{
                            label: 'Liquidez Inmediata',
                            data: datosLiquidezInmediata,
                            backgroundColor: [
                                'rgba(0, 62, 153, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 62, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: false,
                        plugins:{
                            title:{
                                display: true,
                                text:'Liquidez Inmediata',
                                color: '#003E99',
                                font:{
                                    size:20
                                }
                            }
                        }
                    }
                };
                const charLiqIM = document.getElementById('liqIM').getContext('2d');
                const configLiqIM = {
                    type: 'bar',
                    data: {
                        labels:etiquetas20192020,
                        datasets: [{
                            label: 'Liquidez Inmediata Media Diputaciones',
                            data: datosLiquidezInmediataM,
                            backgroundColor: [
                                'rgba(0, 62, 153, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 62, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: false,
                        plugins:{
                            title:{
                                display: true,
                                text:'Liquidez Inmediata Media Diputaciones',
                                color: '#003E99',
                                font:{
                                    size:20
                                }
                            }
                        }
                    }
                };
                const liqI = new Chart(charLiqI, configLiqI);
                const liqIM = new Chart(charLiqIM, configLiqIM);
            </script>

            <br><br>

            <script>
                var datosSolvenciaCortoPlazo = <?php echo json_encode($datosSolvenciaCortoPlazo)?>;
                var datosSolvenciaCortoPlazoM = <?php echo json_encode($datosSolvenciaCortoPlazoM)?>;
            </script>
            <div class="graficos">
                    <canvas id="solC" height="300" width="500"></canvas>
                    <canvas id="solCM" height="300" width="500"></canvas>
                    <br><br>
            </div>
            <script>
                const charSolC = document.getElementById('solC').getContext('2d');
                const configSolC = {
                    type: 'bar',
                    data: {
                        labels:etiquetas20192020,
                        datasets: [{
                            label: 'Solvencia Corto Plazo',
                            data: datosSolvenciaCortoPlazo,
                            backgroundColor: [
                                'rgba(0, 62, 153, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 62, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: false,
                        plugins:{
                            title:{
                                display: true,
                                text:'Solvencia Corto Plazo',
                                color: '#003E99',
                                font:{
                                    size:20
                                }
                            }
                        }
                    }
                };
                const charSolCM = document.getElementById('solCM').getContext('2d');
                const configSolCM = {
                    type: 'bar',
                    data: {
                        labels:etiquetas20192020,
                        datasets: [{
                            label: 'Solvencia Corto Plazo Media Diputaciones',
                            data: datosSolvenciaCortoPlazoM,
                            backgroundColor: [
                                'rgba(0, 62, 153, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 62, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: false,
                        plugins:{
                            title:{
                                display: true,
                                text:'Solvencia Corto Plazo Media Diputaciones',
                                color: '#003E99',
                                font:{
                                    size:20
                                }
                            }
                        }
                    }
                };
                const solC = new Chart(charSolC, configSolC);
                const solCM = new Chart(charSolCM, configSolCM);
            </script>
            <br><br>




            <!-- TO DO -->
            <h3>Eficiencia</h3>
            <br>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>2019</th>
                        <th>2020</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                        <div class="celda-eficiencia">
                            Eficiencia
                            <div class="info">
                                <img src="info.svg" alt="información" height="14px">
                                <span class="extra-info">Mide gastos de personal + bienes y servicios entre ingresos corrientes propios recurrentes</span>
                            </div>
                        </div>
                        </th>
                        <td style="width:14%"><?php echo number_format($dip2019->getEficiencia()*100, 2, ',','.') . "%";?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getEficiencia()*100, 2, ',','.') . "%";?></td>
                    </tr>
                    <tr>
                        <th>Eficiencia Media Diputaciones</th>
                        <td style="width:14%"><?php echo number_format($dip2019->getEficienciaMediaDiputaciones()*100, 2, ',','.') . "%";?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getEficienciaMediaDiputaciones()*100, 2, ',','.') . "%";?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <br>
            <br><br>

            <script>
                var datosEficiencia = <?php echo json_encode($datosEficiencia)?>;
                var datosEficienciaM = <?php echo json_encode($datosEficienciaM)?>;
            </script>
            <div class="graficos">
                    <canvas id="efi" height="300" width="500"></canvas>
                    <canvas id="efiM" height="300" width="500"></canvas>
                    <br><br>
            </div>
            <script>
                const charEfi = document.getElementById('efi').getContext('2d');
                const configEfi = {
                    type: 'bar',
                    data: {
                        labels:etiquetas20192020,
                        datasets: [{
                            label: 'Eficiencia',
                            data: datosEficiencia,
                            backgroundColor: [
                                'rgba(0, 62, 153, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 62, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: false,
                        plugins:{
                            title:{
                                display: true,
                                text:'Eficiencia',
                                color: '#003E99',
                                font:{
                                    size:20
                                }
                            }
                        }
                    }
                };
                const charEfiM = document.getElementById('efiM').getContext('2d');
                const configEfiM = {
                    type: 'bar',
                    data: {
                        labels:etiquetas20192020,
                        datasets: [{
                            label: 'Eficiencia Media Diputaciones',
                            data: datosEficienciaM,
                            backgroundColor: [
                                'rgba(0, 62, 153, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 62, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: false,
                        plugins:{
                            title:{
                                display: true,
                                text:'Eficiencia Media Diputaciones',
                                color: '#003E99',
                                font:{
                                    size:20
                                }
                            }
                        }
                    }
                };
                const efi = new Chart(charEfi, configEfi);
                const efiM = new Chart(charEfiM, configEfiM);
            </script>
            <br><br>




            <!-- TO DO -->
            <h3>Gestión Presupuestaria</h3>
            <br>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>2019</th>
                        <th>2020</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                        <div class="celda-ejecucion-ingresos">
                            Ejecución Ingresos corrientes
                            <div class="info">
                                <img src="info.svg" alt="información" height="14px">
                                <span class="extra-info">Mide el porcentaje de derechos reconocidos sobre los ingresos presupuestados</span>
                            </div>
                        </div>
                        </th>
                        <td style="width:14%"><?php echo number_format($dip2019->getEjecucionIngresosCorrientes()*100, 2, ',','.') . "%";?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getEjecucionIngresosCorrientes()*100, 2, ',','.') . "%";?></td>
                    </tr>
                    <tr>
                        <th>Ejecución Ingresos Corrientes Media Diputaciones</th>
                        <td style="width:14%"><?php echo number_format($dip2019->getEjecucionIngresosCorrientesMediaDiputaciones()*100, 2, ',','.') . "%";?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getEjecucionIngresosCorrientesMediaDiputaciones()*100, 2, ',','.') . "%";?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>2019</th>
                        <th>2020</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                        <div class="celda-ejecucion-gastos">
                            Ejecución Gastos corrientes
                            <div class="info">
                                <img src="info.svg" alt="información" height="14px">
                                <span class="extra-info">Mide el porcentaje de obligaciones reconocidas sobre los gastos presupuestados</span>
                            </div>
                        </div>
                        </th>
                        <td style="width:14%"><?php echo number_format($dip2019->getEjecucionGastosCorrientes()*100, 2, ',','.') . "%";?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getEjecucionGastosCorrientes()*100, 2, ',','.') . "%";?></td>
                    </tr>
                    <tr>
                        <th>Ejecución Gastos Corrientes Media Diputaciones</th>
                        <td style="width:14%"><?php echo number_format($dip2019->getEjecucionGastosCorrientesMediaDiputaciones()*100, 2, ',','.') . "%";?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getEjecucionGastosCorrientesMediaDiputaciones()*100, 2, ',','.') . "%";?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <br>

            <script>
                var datosEjecucionIngresosCorrientes = <?php echo json_encode($datosEjecucionIngresosCorrientes)?>;
                var datosEjecucionIngresosCorrientesM = <?php echo json_encode($datosEjecucionIngresosCorrientesM)?>;
            </script>
            <div class="graficos">
                    <canvas id="efiIng" height="300" width="500"></canvas>
                    <canvas id="efiIngM" height="300" width="500"></canvas>
                    <br><br>
            </div>
            <script>
                const charEfiIng = document.getElementById('efiIng').getContext('2d');
                const configEfiIng = {
                    type: 'bar',
                    data: {
                        labels:etiquetas20192020,
                        datasets: [{
                            label: 'Ejecucion Ingresos Corrientes',
                            data: datosEjecucionIngresosCorrientes,
                            backgroundColor: [
                                'rgba(0, 62, 153, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 62, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: false,
                        plugins:{
                            title:{
                                display: true,
                                text:'Ejecucion Ingresos Corrientes',
                                color: '#003E99',
                                font:{
                                    size:20
                                }
                            }
                        }
                    }
                };
                const charEfiIngM = document.getElementById('efiIngM').getContext('2d');
                const configEfiIngM = {
                    type: 'bar',
                    data: {
                        labels:etiquetas20192020,
                        datasets: [{
                            label: 'Ejecucion Ingresos Corrientes Media Diputaciones',
                            data: datosEjecucionIngresosCorrientesM,
                            backgroundColor: [
                                'rgba(0, 62, 153, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 62, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: false,
                        plugins:{
                            title:{
                                display: true,
                                text:'Ejecucion Ingresos Corrientes Media Diputaciones',
                                color: '#003E99',
                                font:{
                                    size:20
                                }
                            }
                        }
                    }
                };
                const efiIng = new Chart(charEfiIng, configEfiIng);
                const efiIngM = new Chart(charEfiIngM, configEfiIngM);
            </script>
            <br><br>

            <script>
                var datosEjecucionGastosCorrientes = <?php echo json_encode($datosEjecucionGastosCorrientes)?>;
                var datosEjecucionGastosCorrientesM = <?php echo json_encode($datosEjecucionGastosCorrientesM)?>;
            </script>
            <div class="graficos">
                    <canvas id="efiGas" height="300" width="500"></canvas>
                    <canvas id="efiGasM" height="300" width="500"></canvas>
                    <br><br>
            </div>
            <script>
                const charEfiGas = document.getElementById('efiGas').getContext('2d');
                const configEfiGas = {
                    type: 'bar',
                    data: {
                        labels:etiquetas20192020,
                        datasets: [{
                            label: 'Ejecucion Gastos Corrientes',
                            data: datosEjecucionGastosCorrientes,
                            backgroundColor: [
                                'rgba(0, 62, 153, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 62, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: false,
                        plugins:{
                            title:{
                                display: true,
                                text:'Ejecucion Gastos Corrientes',
                                color: '#003E99',
                                font:{
                                    size:20
                                }
                            }
                        }
                    }
                };
                const charEfiGasM = document.getElementById('efiGasM').getContext('2d');
                const configEfiGasM = {
                    type: 'bar',
                    data: {
                        labels:etiquetas20192020,
                        datasets: [{
                            label: 'Ejecucion Gastos Corrientes Media Diputaciones',
                            data: datosEjecucionGastosCorrientesM,
                            backgroundColor: [
                                'rgba(0, 62, 153, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 62, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: false,
                        plugins:{
                            title:{
                                display: true,
                                text:'Ejecucion Gastos Corrientes Media Diputaciones',
                                color: '#003E99',
                                font:{
                                    size:20
                                }
                            }
                        }
                    }
                };
                const efiGas = new Chart(charEfiGas, configEfiGas);
                const efiGasM = new Chart(charEfiGasM, configEfiGasM);
            </script>
            <br><br>




            <!-- TO DO -->
            <h3>Cumplimiento de Pagos</h3>
            <br>
            <p><b>Deuda Comercial 2020: </b><?php echo number_format($dip2020->getDeudaComercial(), 2, ',','.') . "€";?></p>
            <p><b>Deuda Comercial 2019: </b><?php echo number_format($dip2019->getDeudaComercial(), 2, ',','.') . "€";?></p>
            <br>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>2019</th>
                        <th>2020</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                        <div class="celda-pmp">
                            Periodo Medio de Pagos
                            <div class="info">
                                <img src="info.svg" alt="información" height="14px">
                                <span class="extra-info">Mide el número de días teórico que se tarda en pagar a terceros</span>
                            </div>
                        </div>
                        </th>
                        <td style="width:14%"><?php echo number_format($dip2019->getPeriodoMedioPagos(), 2, ',','.') . " días";?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getPeriodoMedioPagos(), 2, ',','.') . " días";?></td>
                    </tr>
                    <tr>
                        <th>Periodo Medio de Pagos Media Diputaciones</th>
                        <td style="width:14%"><?php echo number_format($dip2019->getPeriodoMedioPagosMediaDiputaciones(), 2, ',','.') . " días";?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getPeriodoMedioPagosMediaDiputaciones(), 2, ',','.') . " días";?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>2019</th>
                        <th>2020</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                        <div class="celda-pagos-obligaciones">
                            Pagos sobre Obligaciones Reconocidas
                            <div class="info">
                                <img src="info.svg" alt="información" height="14px">
                                <span class="extra-info">Mide el porcentaje de pagos sobre las obligaciones reconocidas</span>
                            </div>
                        </div>
                        </th>
                        <td style="width:14%"><?php echo number_format($dip2019->getPagosSobreObligacionesReconocidas()*100, 2, ',','.') . "%";?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getPagosSobreObligacionesReconocidas()*100, 2, ',','.') . "%";?></td>
                    </tr>
                    <tr>
                        <th>Pagos sobre Obligaciones Reconocidas Media Diputaciones</th>
                        <td style="width:14%"><?php echo number_format($dip2019->getPagosSobreObligacionesReconocidasMediaDiputaciones()*100, 2, ',','.') . "%";?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getPagosSobreObligacionesReconocidasMediaDiputaciones()*100, 2, ',','.') . "%";?></td>
                    </tr>
                </tbody>
            </table>
            <br><br>

            <script>
                var datosPMP = <?php echo json_encode($datosPMP)?>;
                var datosPMPM = <?php echo json_encode($datosPMPM)?>;
            </script>
            <div class="graficos">
                    <canvas id="pmp" height="300" width="500"></canvas>
                    <canvas id="pmpM" height="300" width="500"></canvas>
                    <br><br>
            </div>
            <script>
                const charPMP = document.getElementById('pmp').getContext('2d');
                const configPMP = {
                    type: 'bar',
                    data: {
                        labels:etiquetas20192020,
                        datasets: [{
                            label: 'PMP',
                            data: datosPMP,
                            backgroundColor: [
                                'rgba(0, 62, 153, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 62, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: false,
                        plugins:{
                            title:{
                                display: true,
                                text:'PMP',
                                color: '#003E99',
                                font:{
                                    size:20
                                }
                            }
                        }
                    }
                };
                const charPMPM = document.getElementById('pmpM').getContext('2d');
                const configPMPM = {
                    type: 'bar',
                    data: {
                        labels:etiquetas20192020,
                        datasets: [{
                            label: 'PMP Media Diputaciones',
                            data: datosPMPM,
                            backgroundColor: [
                                'rgba(0, 62, 153, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 62, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: false,
                        plugins:{
                            title:{
                                display: true,
                                text:'PMP Media Diputaciones',
                                color: '#003E99',
                                font:{
                                    size:20
                                }
                            }
                        }
                    }
                };
                const PMP = new Chart(charPMP, configPMP);
                const PMPM = new Chart(charPMPM, configPMPM);
            </script>
            <br><br>

            <script>
                var datosPagosSobreObligaciones = <?php echo json_encode($datosPagosSobreObligaciones)?>;
                var datosPagosSobreObligacionesM = <?php echo json_encode($datosPagosSobreObligacionesM)?>;
            </script>
            <div class="graficos">
                    <canvas id="pagosObl" height="300" width="500"></canvas>
                    <canvas id="pagosOblM" height="300" width="500"></canvas>
                    <br><br>
            </div>
            <script>
                const charPagosObl = document.getElementById('pagosObl').getContext('2d');
                const configPagosObl = {
                    type: 'bar',
                    data: {
                        labels:etiquetas20192020,
                        datasets: [{
                            label: 'Pagos sobre Obligaciones Reconocidas',
                            data: datosPagosSobreObligaciones,
                            backgroundColor: [
                                'rgba(0, 62, 153, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 62, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: false,
                        plugins:{
                            title:{
                                display: true,
                                text:'Pagos sobre Obligaciones Reconocidas',
                                color: '#003E99',
                                font:{
                                    size:20
                                }
                            }
                        }
                    }
                };
                const charPagosOblM = document.getElementById('pagosOblM').getContext('2d');
                const configPagosOblM = {
                    type: 'bar',
                    data: {
                        labels:etiquetas20192020,
                        datasets: [{
                            label: 'Pagos sobre Obligaciones Reconocidas Media Diputaciones',
                            data: datosPagosSobreObligacionesM,
                            backgroundColor: [
                                'rgba(0, 62, 153, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 62, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: false,
                        plugins:{
                            title:{
                                display: true,
                                text:'Pagos sobre Obligaciones Reconocidas Media Diputaciones',
                                color: '#003E99',
                                font:{
                                    size:20
                                }
                            }
                        }
                    }
                };
                const pagosObl = new Chart(charPagosObl, configPagosObl);
                const pagosOblM = new Chart(charPagosOblM, configPagosOblM);
            </script>
            <br><br>



            <!-- TO DO -->
            <h3>Gestión Tributaria</h3>
            <br>
            <p><b>Derechos Pendientes de Cobro 2020: </b><?php echo number_format($dip2020->getDerechosPendientesCobro(), 2, ',','.') . "€";?></p>
            <p><b>Derechos Pendientes de Cobro 2019: </b><?php echo number_format($dip2019->getDerechosPendientesCobro(), 2, ',','.') . "€";?></p>
            <br>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>2019</th>
                        <th>2020</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                        <div class="celda-eficacia-recaudatoria">
                            Eficacia Recaudatoria
                            <div class="info">
                                <img src="info.svg" alt="información" height="14px">
                                <span class="extra-info">Mide los ingresos cobrados sobre los ingresos devengados</span>
                            </div>
                        </div>
                        </th>
                        <td style="width:14%"><?php echo number_format($dip2019->getEficaciaRecaudatoria()*100, 2, ',','.') . "%";?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getEficaciaRecaudatoria()*100, 2, ',','.') . "%";?></td>
                    </tr>
                    <tr>
                        <th>Eficacia Recaudatoria Media Diputaciones</th>
                        <td style="width:14%"><?php echo number_format($dip2019->getEficaciaRecaudatoriaMediaDiputaciones()*100, 2, ',','.') . "%";?></td>
                        <td style="width:14%"><?php echo number_format($dip2020->getEficaciaRecaudatoriaMediaDiputaciones()*100, 2, ',','.') . "%";?></td>
                    </tr>
                </tbody>
            </table>
            <br><br>

            <script>
                var datosEficaciaRecaudatoria = <?php echo json_encode($datosEficaciaRecaudatoria)?>;
                var datosEficaciaRecaudatoriaM = <?php echo json_encode($datosEficaciaRecaudatoriaM)?>;
            </script>
            <div class="graficos">
                    <canvas id="efiR" height="300" width="500"></canvas>
                    <canvas id="efiRM" height="300" width="500"></canvas>
                    <br><br>
            </div>
            <script>
                const charEfiR = document.getElementById('efiR').getContext('2d');
                const configEfiR = {
                    type: 'bar',
                    data: {
                        labels:etiquetas20192020,
                        datasets: [{
                            label: 'Eficacia Recaudatoria',
                            data: datosEficaciaRecaudatoria,
                            backgroundColor: [
                                'rgba(0, 62, 153, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 62, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: false,
                        plugins:{
                            title:{
                                display: true,
                                text:'Eficacia Recaudatoria',
                                color: '#003E99',
                                font:{
                                    size:20
                                }
                            }
                        }
                    }
                };
                const charEfiRM = document.getElementById('efiRM').getContext('2d');
                const configEfiRM = {
                    type: 'bar',
                    data: {
                        labels:etiquetas20192020,
                        datasets: [{
                            label: 'Eficacia Recaudatoria Media Diputaciones',
                            data: datosEficaciaRecaudatoriaM,
                            backgroundColor: [
                                'rgba(0, 62, 153, 0.2)'
                            ],
                            borderColor: [
                                'rgba(0, 62, 153, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: false,
                        plugins:{
                            title:{
                                display: true,
                                text:'Eficacia Recaudatoria Media Diputaciones',
                                color: '#003E99',
                                font:{
                                    size:20
                                }
                            }
                        }
                    }
                };
                const efiR = new Chart(charEfiR, configEfiR);
                const efiRM = new Chart(charEfiRM, configEfiRM);
            </script>












            <?php
            }
            else {
                echo '<p>Diputación no encontrada</p>';
            }
            ?>
        </div>

        <div id = "pie">
            <?php require("includesWeb/comun/pie.php");?>
        </div>

    </body>
</html>