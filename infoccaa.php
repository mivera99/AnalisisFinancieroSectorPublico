<?php
session_start();
require_once('includesWeb/daos/DAOConsultor.php');

$nombre = htmlspecialchars(trim(strip_tags(urldecode($_GET["ccaa"]))));

$daoccaa = new DAOConsultor();
$ccaa = $daoccaa->getCCAA($nombre);
$ccaaNac = $daoccaa->getCCAA('NACIONAL');

setcookie("ccaa", $nombre);

$encontrado = false;
if($ccaa && $ccaaNac){
    $encontrado = true;
    /*Preparación de datos para las gráficas*/
    /*PIB CCAA y PIB Nacional*/
    $datosPib = array();
    $etiquetasPib = array();
    foreach($ccaa->getIncrPib() as $clave=>$valor){
        array_push($etiquetasPib, $clave);
        array_push($datosPib, $valor*100);
    }
    $datosPibNac = array();
    $etiquetasPibNac = array();
    foreach($ccaaNac->getIncrPib() as $clave=>$valor){
        array_push($etiquetasPibNac, $clave);
        array_push($datosPibNac, $valor*100);
    }
    /*Paro CCAA y paro nacional*/
    $datosParo = array();
    $etiquetasParo = array();
    foreach($ccaa->getParo() as $array){
        array_push($etiquetasParo, $array[0]);
        array_push($datosParo, $array[2]*100);
    }
    $datosParoNac = array();
    $etiquetasParoNac = array();
    foreach($ccaaNac->getParo() as $array){
        array_push($etiquetasParoNac, $array[0]);
        array_push($datosParoNac, $array[2]*100);
    }
    /*Transacciones inmobiliarias CCAA y transacciones nacionales*/
    $datosTransac = array();
    $etiquetasTransac = array();
    foreach($ccaa->getTransacInmobiliarias() as $array){
        array_push($etiquetasTransac, $array[0]);
        array_push($datosTransac, $array[2]*100);
    }
    $datosTransacNac = array();
    $etiquetasTransacNac = array();
    foreach($ccaaNac->getTransacInmobiliarias() as $array){
        array_push($etiquetasTransacNac, $array[0]);
        array_push($datosTransacNac, $array[2]*100);
    }
    /*Crecimiento de empresas CCAA y crecimiento de empresas a nivel nacional*/
    $datosEmpresas = array();
    $etiquetasEmpresas = array();
    foreach($ccaa->getEmpresas() as $clave=>$valor){
        array_push($etiquetasEmpresas, $clave);
        array_push($datosEmpresas, $valor*100);
    }
    $datosEmpresasNac = array();
    $etiquetasEmpresasNac = array();
    foreach($ccaaNac->getEmpresas() as $clave=>$valor){
        array_push($etiquetasEmpresasNac, $clave);
        array_push($datosEmpresasNac, $valor*100);
    }
    /*Resultado presupuestario CCAA y nacional*/
    $datosPresupuestario = array();
    $etiquetasPresupuestario = array();
    foreach($ccaa->getCCAAPib() as $clave=>$valor){
        array_push($etiquetasPresupuestario, $clave);
        array_push($datosPresupuestario, $valor*100);
    }
    $datosPresupuestarioNac = array();
    $etiquetasPresupuestarioNac = array();
    foreach($ccaaNac->getCCAAPib() as $clave=>$valor){
        array_push($etiquetasPresupuestarioNac, $clave);
        array_push($datosPresupuestarioNac, $valor*100);
    }
    /*Deuda viva CCAA y nacional*/
    $datosDeudaVivaIngrCor = array();
    $etiquetasDeudaVivaIngrCor = array();
    foreach($ccaa->getDeudaVivaIngrCor() as $array){
        array_push($etiquetasDeudaVivaIngrCor, $array[0]);
        array_push($datosDeudaVivaIngrCor, $array[2]*100);
    }
    $datosDeudaVivaNac = array();
    $etiquetasDeudaVivaNac = array();
    foreach($ccaaNac->getDeudaVivaIngrCor() as $array){
        array_push($etiquetasDeudaVivaNac, $array[0]);
        array_push($datosDeudaVivaNac, $array[2]*100);
    }
    /*Ingresos corrientes CCAA */
    $datosIngresosCor = array();
    $etiquetasIngresosCor = array();
    foreach($ccaa->getTotalIngresosCorrientes1() as $clave=>$valor){
        array_unshift($etiquetasIngresosCor, $clave);
        array_unshift($datosIngresosCor, $valor);
    }
    /*Ingresos no financieros CCAA*/
    $datosIngresosNoFinancieros = array();
    $etiquetasIngresosNoFinancieros = array();
    foreach($ccaa->getTotalIngresosNoCorrientes1() as $clave=>$valor){
        array_unshift($etiquetasIngresosNoFinancieros, $clave);
        array_unshift($datosIngresosNoFinancieros, $valor);
    }
    /*Dato ingreso no financiero per cápita*/
    $datosIngresosTotales = array();
    $etiquetasIngresosTotales = array();
    foreach($ccaa->getTotalIngresos1() as $clave=>$valor){
        array_unshift($etiquetasIngresosTotales, $clave);
        array_unshift($datosIngresosTotales, $valor);
    }
    /*Gastos corrientes CCAA */
    $datosGastosCor = array();
    $etiquetasGastosCor = array();
    foreach($ccaa->getTotalGastosCorrientes1() as $clave=>$valor){
        array_unshift($etiquetasGastosCor, $clave);
        array_unshift($datosGastosCor, $valor);
    }
    /*Gastos no financieros CCAA*/
    $datosGastosNoFinancieros = array();
    $etiquetasGastosNoFinancieros = array();
    foreach($ccaa->getTotalGastosNoFinancieros1() as $clave=>$valor){
        array_unshift($etiquetasGastosNoFinancieros, $clave);
        array_unshift($datosGastosNoFinancieros, $valor);
    }
    /*Dato gasto no financiero per cápita*/
    $datosGastosFinancieros = array();
    $etiquetasGastosFinancieros = array();
    foreach($ccaa->getTotalGastos1() as $clave=>$valor){
        array_unshift($etiquetasGastosFinancieros, $clave);
        array_unshift($datosGastosFinancieros, $valor);
    }
    /*Ahorro Neto*/
    $datos = array();
    $etiquetas = array();
    foreach($ccaa->getRSosteFinanciera() as $clave=>$valor){
        array_push($etiquetas, $clave);
        array_push($datos, $valor*100);
    }
    /*Apalancamiento Operativo*/ 
    $datosApalancamiento=array();
    $etiquetasApalancamiento=array();
    foreach($ccaa->getRRigidez() as $clave=>$valor){
        array_push($etiquetasApalancamiento, $clave);
        array_push($datosApalancamiento, $valor*100);
    }
    /*Sostenibilidad de la deuda CCAA, y media CCAA*/ 
    $datosSostenibilidad=array();
    $etiquetasSostenibilidad=array();
    foreach($ccaa->getRSosteEndeuda() as $clave=>$valor){
        array_push($etiquetasSostenibilidad, $clave);
        array_push($datosSostenibilidad, $valor*100);
    }
    /*PMP CCAA, y media PMP CCAA*/ 
    $datosPMP=array();
    $etiquetasPMP=array();
    foreach($ccaa->getPMP() as $array){
        array_push($etiquetasPMP, $array[0]);
        array_push($datosPMP, $array[2]);
    }
    $datosPMPNac=array();
    $etiquetasPMPNac=array();
    foreach($ccaaNac->getPMP() as $array){
        array_push($etiquetasPMPNac, $array[0]);
        array_push($datosPMPNac, $array[2]);
    }
    /*Eficiencia CCAA, y media eficiencia CCAA*/ 
    $datosEficiencia=array();
    $etiquetasEficiencia=array();
    foreach($ccaa->getREfic() as $clave=>$valor){
        array_push($etiquetasEficiencia, $clave);
        array_push($datosEficiencia, $valor*100);
    }
    $datosEficienciaNac=array();
    $etiquetasEficienciaNac=array();
    foreach($ccaaNac->getREfic() as $clave=>$valor){
        array_push($etiquetasEficienciaNac, $clave);
        array_push($datosEficienciaNac, $valor*100);
    }
    /*Ratios de ejecucion de ingresos CCAA */ 
    $datosEjeIngrCorr=array();
    $etiquetasEjeIngrCorr=array();
    foreach($ccaa->getREjeIngrCorr() as $clave=>$valor){
        array_push($etiquetasEjeIngrCorr, $clave);
        array_push($datosEjeIngrCorr, $valor*100);
    }
    $datosEjeIngrCorrNac=array();
    $etiquetasEjeIngrCorrNac=array();
    foreach($ccaaNac->getREjeIngrCorr() as $clave=>$valor){
        array_push($etiquetasEjeIngrCorrNac, $clave);
        array_push($datosEjeIngrCorrNac, $valor*100);
    }
    /*Ratios de ejecucion de gastos CCAA */ 
    $datosEjeGastosCorr=array();
    $etiquetasEjeGastosCorr=array();
    foreach($ccaa->getREjeGastosCorr() as $clave=>$valor){
        array_push($etiquetasEjeGastosCorr, $clave);
        array_push($datosEjeGastosCorr, $valor*100);
    }
    $datosEjeGastosCorrNac=array();
    $etiquetasEjeGastosCorrNac=array();
    foreach($ccaaNac->getREjeGastosCorr() as $clave=>$valor){
        array_push($etiquetasEjeGastosCorrNac, $clave);
        array_push($datosEjeGastosCorrNac, $valor*100);
    }
    /* Deuda comercial pendiente de pago */ 
    $datosRDCPP=array();
    $etiquetasRDCPP=array();
    foreach($ccaa->getRDCPP() as $array){
        array_push($etiquetasRDCPP, $array[0]);
        array_push($datosRDCPP, $array[2]);
    }
    $datosRDCPPNac=array();
    $etiquetasRDCPPNac=array();
    foreach($ccaaNac->getRDCPP() as $array){
        array_push($etiquetasRDCPPNac, $array[0]);
        array_push($datosRDCPPNac, $array[2]);
    }
    /* Pagos obligacionales */
    $datosPagosObligacionales=array();
    $etiquetasPagosObligacionales=array();
    foreach($ccaa->getPagosObligaciones() as $clave=>$valor){
        array_push($etiquetasPagosObligacionales, $clave);
        array_push($datosPagosObligacionales, $valor*100);
    }
    $datosPagosObligacionalesNac=array();
    $etiquetasPagosObligacionalesNac=array();
    foreach($ccaaNac->getPagosObligaciones() as $clave=>$valor){
        array_push($etiquetasPagosObligacionalesNac, $clave);
        array_push($datosPagosObligacionalesNac, $valor*100);
    }
    /* Eficacia recaudatoria */
    $datosREficaciaRec=array();
    $etiquetasREficaciaRec=array();
    foreach($ccaa->getREficaciaRec() as $clave=>$valor){
        array_push($etiquetasREficaciaRec, $clave);
        array_push($datosREficaciaRec, $valor*100);
    }
    $datosREficaciaRecNac=array();
    $etiquetasREficaciaRecNac=array();
    foreach($ccaaNac->getREficaciaRec() as $clave=>$valor){
        array_push($etiquetasREficaciaRecNac, $clave);
        array_push($datosREficaciaRecNac, $valor*100);
    }
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
    
    <script src="functions2.js"></script>

    <script src="node_modules/chart.js/dist/chart.js"></script>
    <!--<script src="graphics.js"></script>-->
    <!--  ====== ICONOS ====== -->
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>

    <title>Análisis Financiero del Sector Público - Comunidad Autónoma</title>
</head>
    <body>
        <div id = "cabecera">
            <?php require("includesWeb/comun/cabecera.php");?>  
        </div>
        
        <div id ="contenidoCCAA">
            <?php
            if($encontrado){
                echo '<h2>'.$ccaa->getNombre().'</h2>';
                foreach($ccaa->getScoring() as $clave => $valor){
                    echo '<h2>Rating '.$clave.'</h2>';
                    echo '<button class="scoring '.$valor.'">'.$valor.'</button><p>Tendencia: '.($ccaa->getTendencia())[$clave].'</p>';
                }
            ?>
                <br>
                <button type="button" id="verPDFCCAA" onclick="window.open('pdfCCAA.php','_blank')">Ver Informe</button>
            <?php

                echo "<br>";
                echo '<h3>Datos generales</h3>';
                echo '<p><b>Presidente de la comunidad: </b>'.$ccaa->getNombrePresidente().' '.$ccaa->getApellido1().' '.$ccaa->getApellido2().'</p>';
                echo '<p><b>Vigencia: </b>'.$ccaa->getVigencia().'</p>';
                echo '<p><b>Partido político: </b>'.$ccaa->getPartido().'</p>';
                echo '<p><b>CIF: </b>'.$ccaa->getCif().'</p>';
                echo '<p><b>Via: </b>'.$ccaa->getTipoVia().' '.$ccaa->getNombreVia().', '.$ccaa->getNumVia().'</p>';
                echo '<p><b>Teléfono: </b>';
                if($ccaa->getTelefono()!='') echo $ccaa->getTelefono().'</p>';
                else echo 'N/A</p>';
                echo '<p><b>Código Postal: </b>';
                if($ccaa->getCodigoPostal()!='') echo $ccaa->getCodigoPostal().'</p>';
                else echo 'N/A</p>';
                echo '<p><b>Fax: </b>';
                if($ccaa->getFax()!='') echo $ccaa->getFax().'</p>';
                else echo 'N/A</p>';
                echo '<p><b>Sitio web: </b>';
                if($ccaa->getWeb()!='') echo '<a href="https://'.$ccaa->getWeb().'" target="_blank">'.$ccaa->getWeb().'</a></p>';
                else echo 'N/A</p>';
                echo '<p><b>Correo electrónico: </b>';
                if($ccaa->getMail()!='') echo $ccaa->getMail().'</p>';
                else echo 'N/A</p>';
            ?>
                <br><br>
                <h3>Datos económicos</h3>
                <table>
                    <thead>
                     <tr>
                            <th colspan="2">Población (Año <?php echo key($ccaa->getPoblacion()).'): '. number_format(($ccaa->getPoblacion())[key($ccaa->getPoblacion())], 0, '','.');?></th>
                            <th colspan="2">PIB per cápita (Año <?php echo key($ccaa->getPibc()).'): '. number_format(($ccaa->getPibc())[key($ccaa->getPibc())]*1000, 0, '','.');?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                <h4>Incremento del PIB de la comunidad<h4>
                                <ul>
                                    <?php
                                    foreach($ccaa->getIncrPib() as $clave=>$valor){
                                        echo '<li>'.$clave.': '.($valor*100).'%</li>';
                                    }
                                    ?>
                                </ul>
                            </th>
                            <th>
                                <h4>Incremento del PIB nacional<h4>
                                <ul>
                                    <?php
                                    foreach($ccaaNac->getIncrPib() as $clave=>$valor){
                                        echo '<li>'.$clave.': '.($valor*100).'%</li>';
                                    }
                                    ?>
                                </ul>
                            </th>
                            <th>
                                <h4>Paro<h4>
                                <ul>
                                    <?php
                                    foreach($ccaa->getParo() as $array){
                                        echo '<li>'.$array[0].' (Trimestre '.$array[1].'): '.($array[2]*100).'%</li>';
                                    }
                                    
                                    ?>
                                </ul>
                            </th>
                            <th>
                                <h4>Paro nacional<h4>
                                <ul>
                                    <?php
                                    foreach($ccaaNac->getParo() as $array){
                                        echo '<li>'.$array[0].' (Trimestre '.$array[1].'): '.($array[2]*100).'%</li>';
                                    }
                                    ?>
                                </ul>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <h4>Transacciones inmobiliarias<h4>
                                <ul>
                                    <?php
                                    foreach($ccaa->getTransacInmobiliarias() as $array){
                                        echo '<li>'.$array[0].' (Trimestre '.$array[1].'): '.($array[2]*100).'%</li>';
                                    }
                                    ?>
                                </ul>
                            </th>
                            <th>
                                <h4>Transacciones inmobiliarias nacionales<h4>
                                <ul>
                                    <?php
                                    foreach($ccaaNac->getTransacInmobiliarias() as $array){
                                        echo '<li>'.$array[0].' (Trimestre '.$array[1].'): '.($array[2]*100).'%</li>';
                                    }
                                    ?>
                                </ul>
                            </th>
                            <th>
                                <h4>Crecimiento de las empresas en la comunidad<h4>
                                <ul>
                                    <?php
                                    foreach($ccaa->getEmpresas() as $clave=>$valor){
                                        echo '<li>'.$clave.': '.($valor*100).'%</li>';
                                    }
                                    ?>
                                </ul>
                            </th>
                            <th>
                                <h4>Crecimiento de las empresas a nivel nacional<h4>
                                <ul>
                                    <?php
                                    foreach($ccaaNac->getEmpresas() as $clave=>$valor){
                                        echo '<li>'.$clave.': '.($valor*100).'%</li>';
                                    }
                                    ?>
                                </ul>
                            </th>
                        </tr>
                    </tbody>
                </table>
                <!-- GRAFICAS-->
                <script>
                    var datosPib = <?php echo json_encode($datosPib)?>;
                    var etiquetasPib = <?php echo json_encode($etiquetasPibNac)?>;
                    var datosPibNac = <?php echo json_encode($datosPibNac)?>;
                    var etiquetasPibNac = <?php echo json_encode($etiquetasPibNac)?>;
                    
                    var datosParo = <?php echo json_encode($datosParo)?>;
                    var etiquetasParo = <?php echo json_encode($etiquetasParo)?>;
                    var datosParoNac = <?php echo json_encode($datosParoNac)?>;
                    var etiquetasParoNac = <?php echo json_encode($etiquetasParoNac)?>;
                    
                    var datosTransac = <?php echo json_encode($datosTransac)?>;
                    var etiquetasTransac = <?php echo json_encode($etiquetasTransac)?>;
                    var datosTransacNac = <?php echo json_encode($datosTransacNac)?>;
                    var etiquetasTransacNac = <?php echo json_encode($etiquetasTransacNac)?>;
                    
                    var datosEmpresas = <?php echo json_encode($datosEmpresas)?>;
                    var etiquetasEmpresas = <?php echo json_encode($etiquetasEmpresas)?>;
                    var datosEmpresasNac = <?php echo json_encode($datosEmpresasNac)?>;
                    var etiquetasEmpresasNac = <?php echo json_encode($etiquetasEmpresasNac)?>;
                </script>

                <!--Grafica de ahorro neto-->
                <br><br>
                <div class="graficos">
                    <canvas id="pibCCAA" height="300" width="500"></canvas>
                    <canvas id="pibCCAANac" height="300" width="500"></canvas>
                    <br><br><br>
                    <canvas id="paro" height="300" width="500"></canvas>
                    <canvas id="paroNac" height="300" width="500"></canvas>
                    <br><br>
                    <canvas id="transac" height="300" width="500"></canvas>
                    <canvas id="transacNac" height="300" width="500"></canvas>
                    <br><br>
                    <canvas id="empresas" height="300" width="500"></canvas>
                    <canvas id="empresasNac" height="300" width="500"></canvas>
                </div>
                <script>
                    const chartPib = document.getElementById('pibCCAA').getContext('2d');
                    const configChartPib = {
                        type: 'bar',
                        data: {
                            labels: etiquetasPib,
                            datasets: [{
                                label: 'Incremento del PIB en la comunidad autónoma',
                                data: datosPib,
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
                                    text:'PIB de la comunidad autónoma',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };
                    const chartPibNac = document.getElementById('pibCCAANac').getContext('2d');
                    const configChartPibNac = {
                        type: 'bar',
                        data: {
                            labels: etiquetasPibNac,
                            datasets: [{
                                label: 'Incremento del PIB nacional',
                                data: datosPibNac,
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
                                    text:'Incremento PIB nacional',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };

                    const chartParo = document.getElementById('paro').getContext('2d');
                    const configChartParo = {
                        type: 'bar',
                        data: {
                            labels: etiquetasParo,
                            datasets: [{
                                label: 'Paro de la comunidad',
                                data: datosParo,
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
                                    text:'Paro en la comunidad',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };
                    const chartParoNac = document.getElementById('paroNac').getContext('2d');
                    const configChartParoNac = {
                        type: 'bar',
                        data: {
                            labels: etiquetasParoNac,
                            datasets: [{
                                label: 'Paro nacional',
                                data: datosParoNac,
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
                                    text:'Paro nacional',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };

                    const chartTransac = document.getElementById('transac').getContext('2d');
                    const configChartTransac = {
                        type: 'bar',
                        data: {
                            labels: etiquetasTransac,
                            datasets: [{
                                label: 'Transacciones inmobiliarias de la comunidad',
                                data: datosTransac,
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
                                    text:'Transacciones inmobiliarias de la comunidad',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };
                    const chartTransacNac = document.getElementById('transacNac').getContext('2d');
                    const configChartTransacNac = {
                        type: 'bar',
                        data: {
                            labels: etiquetasTransacNac,
                            datasets: [{
                                label: 'Transacciones inmobiliarias nacionales',
                                data: datosTransacNac,
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
                                    text:'Transacciones inmobiliarias nacionales',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };

                    const chartEmpresas = document.getElementById('empresas').getContext('2d');
                    const configChartEmpresas = {
                        type: 'bar',
                        data: {
                            labels: etiquetasEmpresas,
                            datasets: [{
                                label: 'Crecimiento del número de empresas en la comunidad',
                                data: datosEmpresas,
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
                                    text:'Crecimiento del número de empresas en la comunidad',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };
                    const chartEmpresasNac = document.getElementById('empresasNac').getContext('2d');
                    const configChartEmpresasNac = {
                        type: 'bar',
                        data: {
                            labels: etiquetasEmpresasNac,
                            datasets: [{
                                label: 'Crecimiento del número de empresas a nivel nacional',
                                data: datosEmpresasNac,
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
                                    text:'Crecimiento del número de empresas a nivel nacional',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };
                    const pib = new Chart(chartPib, configChartPib);
                    const pibNac = new Chart(chartPibNac, configChartPibNac);
                    
                    const paro = new Chart(chartParo, configChartParo);
                    const paroNac = new Chart(chartParoNac, configChartParoNac);
                    
                    const transac = new Chart(chartTransac, configChartTransac);
                    const transacNac = new Chart(chartTransacNac, configChartTransacNac);
                    
                    const empresas = new Chart(chartEmpresas, configChartEmpresas);
                    const empresasNac = new Chart(chartEmpresasNac, configChartEmpresasNac);
                    
                </script>
                <br><br>
                <h3><b>Resultado presupuestario y endeudamiento (en %)</b></h3>
                <?php
                for($i=0;$i<4;$i++){
                    if($i==0) $tmp=$ccaa->getCCAAPib();
                    else if ($i==1) $tmp=$ccaaNac->getCCAAPib();
                    else if ($i==2) $tmp=$ccaa->getDeudaVivaIngrCor();
                    else if ($i==3) $tmp=$ccaaNac->getDeudaVivaIngrCor();
                    echo '<table class="dataTable">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th></th>';
                    if($i<2){
                        foreach($tmp as $clave=>$valor){
                            echo '<th>'.$clave.'</th>';
                        }
                    }
                    else {
                        foreach($tmp as $array){
                            echo '<th>'.$array[0].' (Trimestre '.$array[1].')</th>';
                        }
                    }
                    echo '</tr>';
                    echo'</thead>';
                    echo '<tbody>';
                    echo '<tr>';
                    if($i==0) echo '<th>Resultado presupuestario</th>';
                    else if ($i==1) echo '<th>Resultado presupuestario nacional</th>';
                    else if ($i==2) echo '<th>Deuda viva sobre ingresos corrientes</th>';
                    else if ($i==3) echo '<th>Deuda viva nacional sobre ingresos corrientes</th>';
                    if($i<2){
                        foreach($tmp as $clave=>$valor){
                            echo '<td>'.($valor*100).'%</td>';
                        }
                    }
                    else {
                        foreach($tmp as $array){
                            echo '<td>'.($array[2]*100).'%</td>';
                        }
                    }
                    echo '</tr>';
                    echo'</tbody>';
                    echo '</table>';
                    echo '<br>';
                }

                /*foreach($ccaa->getDeudaVivaIngrCor() as $array){
                    echo '<p><b>Deuda viva sobre ingresos corrientes '.$array[0].' trimestre '.$array[1].' : </b>'.($array[2]*100).'%</p>';
                }
                foreach($ccaaNac->getDeudaVivaIngrCor() as $array){
                    echo '<p><b>Deuda viva nacional sobre ingresos corrientes '.$array[0].' trimestre '.$array[1].' : </b>'.($array[2]*100).'%</p>';
                }*/
                ?>
                <!-- GRAFICAS-->
                <script>
                    var datosP = <?php echo json_encode($datosPresupuestario)?>;
                    var etiquetasP = <?php echo json_encode($etiquetasPresupuestario)?>;
                    var datosPNac = <?php echo json_encode($datosPresupuestarioNac)?>;
                    var etiquetasPNac = <?php echo json_encode($etiquetasPresupuestarioNac)?>;
                    var datosD = <?php echo json_encode($datosDeudaVivaIngrCor)?>;
                    var etiquetasD = <?php echo json_encode($etiquetasDeudaVivaIngrCor)?>;
                    var datosDNac = <?php echo json_encode($datosDeudaVivaNac)?>;
                    var etiquetasDNac = <?php echo json_encode($etiquetasDeudaVivaNac)?>;
                </script>

                <!--Grafica de ahorro neto-->
                <br><br>
                <div class="graficos">
                    <canvas id="presupuesto" height="300" width="500"></canvas>
                    <canvas id="presupuestoNac" height="300" width="500"></canvas>
                    <canvas id="deudaviva" height="300" width="500"></canvas>
                    <canvas id="deudavivaNac" height="300" width="500"></canvas>
                    <br><br>
                </div>
                <script>
                    const chartP = document.getElementById('presupuesto').getContext('2d');
                    const configChartP = {
                        type: 'bar',
                        data: {
                            labels:etiquetasP,
                            datasets: [{
                                label: 'Porcentaje de resultado presupuestario de la comunidad',
                                data: datosP,
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
                                    text:'Resultado presupuestario de la comunidad',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };
                    const chartPNac = document.getElementById('presupuestoNac').getContext('2d');
                    const configChartPNac = {
                        type: 'bar',
                        data: {
                            labels:etiquetasPNac,
                            datasets: [{
                                label: 'Porcentaje de resultado presupuestario nacional',
                                data: datosPNac,
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
                                    text:'Resultado presupuestario nacional',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };

                    const chartD = document.getElementById('deudaviva').getContext('2d');
                    const configChartD = {
                        type: 'bar',
                        data: {
                            labels:etiquetasD,
                            datasets: [{
                                label: 'Porcentaje de la deuda de la comunidad',
                                data: datosD,
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
                                    text:'Deuda de la comunidad',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };
                    const chartDNac = document.getElementById('deudavivaNac').getContext('2d');
                    const configChartDNac = {
                        type: 'bar',
                        data: {
                            labels:etiquetasDNac,
                            datasets: [{
                                label: 'Porcentaje de la deuda nacional',
                                data: datosDNac,
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
                                    text:'Deuda nacional',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };
                    const presupuesto = new Chart(chartP, configChartP);
                    const presupuestoNac = new Chart(chartPNac, configChartPNac);
                    const deudaviva = new Chart(chartD, configChartD);
                    const deudavivaNac = new Chart(chartDNac, configChartDNac);
                </script>
                <br><br>
                <h3>Ingresos (en €)</h3>
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th colspan="3">Liquidación derechos reconocidos</th>
                        </tr>
                        <tr>
                            <th>Ingresos</th>
                            <?php
                            foreach($ccaa->getImpuestosDirectos1() as $clave=>$valor){
                                echo '<th>'.$clave.'</th>';
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1. Impuestos directos 
                            <!--<ion-icon name="information-circle-outline" onclick="showDialog()"></ion-icon></td>-->
                            <?php
                            foreach($ccaa->getImpuestosDirectos1() as $clave=>$valor){
                                echo '<td>'.number_format($valor, 2, ',','.').'</td>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>2. Impuestos indirectos</td>
                            <?php
                            foreach($ccaa->getImpuestosIndirectos1() as $clave=>$valor){
                                echo '<td>'.number_format($valor, 2, ',','.').'</td>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>3. Tasas, precios, públicos y otros ingresos</td>
                            <?php
                            foreach($ccaa->getTasasPreciosOtros1() as $clave=>$valor){
                                echo '<td>'.number_format($valor, 2, ',','.').'</td>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>4. Transferencias corrientes</td>
                            <?php
                            foreach($ccaa->getTransferenciasCorrientes1() as $clave=>$valor){
                                echo '<td>'.number_format($valor, 2, ',','.').'</td>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>5. Ingresos patrimoniales</td>
                            <?php
                            foreach($ccaa->getIngresosPatrimoniales1() as $clave=>$valor){
                                echo '<td>'.number_format($valor, 2, ',','.').'</td>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <th>Total ingresos corrientes</th>
                            <?php
                            foreach($ccaa->getTotalIngresosCorrientes1() as $clave=>$valor){
                                echo '<th>'.number_format($valor, 2, ',','.').'</th>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>6. Enajenación de inversiones reales</td>
                            <?php
                            foreach($ccaa->getEnajenacionInversionesReales1() as $clave=>$valor){
                                echo '<td>'.number_format($valor, 2, ',','.').'</td>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>7. Transferencias de capital</td>
                            <?php
                            foreach($ccaa->getTransferenciasCapital1() as $clave=>$valor){
                                echo '<td>'.number_format($valor, 2, ',','.').'</td>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <th>Ingresos no financieros</th>
                            <?php
                            foreach($ccaa->getTotalIngresosNoCorrientes1() as $clave=>$valor){
                                echo '<th>'.number_format($valor, 2, ',','.').'</th>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>8. Activos financieros</td>
                            <?php
                            foreach($ccaa->getActivosFinancieros1() as $clave=>$valor){
                                echo '<td>'.number_format($valor, 2, ',','.').'</td>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>9. Pasivos financieros</td>
                            <?php
                            foreach($ccaa->getPasivosFinancieros1() as $clave=>$valor){
                                echo '<td>'.number_format($valor, 2, ',','.').'</td>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <th>Ingresos totales</th>
                            <?php
                            foreach($ccaa->getTotalIngresos1() as $clave=>$valor){
                                echo '<th>'.number_format($valor, 2, ',','.').'</th>';
                            }
                            ?>
                        </tr>
                    </tbody>
                </table>
                <!-- GRAFICAS-->
                <script>
                    var datosI = <?php echo json_encode($datosIngresosCor)?>;
                    var etiquetasI = <?php echo json_encode($etiquetasIngresosCor)?>;
                    var datosIN = <?php echo json_encode($datosIngresosNoFinancieros)?>;
                    var etiquetasIN = <?php echo json_encode($etiquetasIngresosNoFinancieros)?>;
                    var datosIT = <?php echo json_encode($datosIngresosTotales)?>;
                    var etiquetasIT = <?php echo json_encode($etiquetasIngresosTotales)?>;
                </script>

                <!--Grafica de ahorro neto-->
                <br><br>
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
                            <th colspan="3" style="height:40px">Liquidación  obligaciones reconocidos</th>
                        </tr>
                        <tr>
                            <th>GASTOS</th>
                            <?php
                            foreach($ccaa->getGastosPersonal1() as $clave=>$valor){
                                echo '<th>'.$clave.'</th>';
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1. Gastos del personal</th>
                            <?php
                            foreach($ccaa->getGastosPersonal1() as $clave=>$valor){
                                echo '<td>'.number_format($valor, 2, ',','.').'</td>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>2. Gastos corrientes en bienes y servicios</th>
                            <?php
                            foreach($ccaa->getGastosCorrientesBienesServicios1() as $clave=>$valor){
                                echo '<td>'.number_format($valor, 2, ',','.').'</td>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>3. Gastos financieros</th>
                            <?php
                            foreach($ccaa->getGastosFinancieros1() as $clave=>$valor){
                                echo '<td>'.number_format($valor, 2, ',','.').'</td>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>4. Transferencias corrientes</th>
                            <?php
                            foreach($ccaa->getTransferenciasCorrientesGastos1() as $clave=>$valor){
                                echo '<td>'.number_format($valor, 2, ',','.').'</td>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>5. Fondo de contingencia</th>
                            <?php
                            foreach($ccaa->getFondoContingencia1() as $clave=>$valor){
                                echo '<td>'.number_format($valor, 2, ',','.').'</td>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <th>Total gastos corrientes</th>
                            <?php
                            foreach($ccaa->getTotalGastosCorrientes1() as $clave=>$valor){
                                echo '<th>'.number_format($valor, 2, ',','.').'</th>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>6. Inversiones reales</th>
                            <?php
                            foreach($ccaa->getInversionesReales1() as $clave=>$valor){
                                echo '<td>'.number_format($valor, 2, ',','.').'</td>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>7. Transferencias de capital</th>
                            <?php
                            foreach($ccaa->getTransferenciasCapitalGastos1() as $clave=>$valor){
                                echo '<td>'.number_format($valor, 2, ',','.').'</td>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <th>Gastos no financieros</th>
                            <?php
                            foreach($ccaa->getTotalGastosNoFinancieros1() as $clave=>$valor){
                                echo '<th>'.number_format($valor, 2, ',','.').'</th>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>8. Activos financieros</th>
                            <?php
                            foreach($ccaa->getActivosFinancieros1() as $clave=>$valor){
                                echo '<td>'.number_format($valor, 2, ',','.').'</td>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>9. Pasivos financieros</th>
                            <?php
                            foreach($ccaa->getPasivosFinancierosGastos1() as $clave=>$valor){
                                echo '<td>'.number_format($valor, 2, ',','.').'</td>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <th>Gasto total</th>
                            <?php
                            foreach($ccaa->getTotalGastos1() as $clave=>$valor){
                                echo '<th>'.number_format($valor, 2, ',','.').'</th>';
                            }
                            ?>
                        </tr>
                    </tbody>
                </table>
                 <!-- GRAFICAS-->
                 <script>
                    var datosG = <?php echo json_encode($datosGastosCor)?>;
                    var etiquetasG = <?php echo json_encode($etiquetasGastosCor)?>;
                    var datosGN = <?php echo json_encode($datosGastosNoFinancieros)?>;
                    var etiquetasGN = <?php echo json_encode($etiquetasGastosNoFinancieros)?>;
                    var datosGT = <?php echo json_encode($datosGastosFinancieros)?>;
                    var etiquetasGT = <?php echo json_encode($etiquetasGastosFinancieros)?>;
                </script>

                <!--Grafica de ahorro neto-->
                <br><br>
                <div class="graficos">
                    <canvas id="gastos" height="300" width="500"></canvas>
                    <canvas id="gastosN" height="300" width="500"></canvas>
                    <canvas id="gastosT" height="300" width="500"></canvas>
                    <br><br>
                </div>
                <script>
                    const chartGastos = document.getElementById('gastos').getContext('2d');
                    const configChartGastos = {
                        type: 'bar',
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
                        type: 'bar',
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
                        type: 'bar',
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
                <h3>Solvencia (en %)</h3>
                <!--METER LOS GRAFICOS AQUI-->
                <?php
                /*foreach($ccaa->getRSosteFinanciera() as $clave=>$valor){
                    echo '<p><b>Sostenibilidad financiera año '.$clave.': </b>'.($valor*100).'%</p>';
                }
                echo '<br>';
                foreach($ccaa->getRRigidez() as $clave=>$valor){
                    echo '<p><b>Apalancamiento operativo año '.$clave.': </b>'.($valor*100).'%</p>';
                }
                echo '<br>';
                foreach($ccaa->getRSosteEndeuda() as $clave=>$valor){
                    echo '<p><b>Sostenibilidad de la deuda año '.$clave.': </b>'.($valor*100).'%</p>';
                }*/
                for($i=0;$i<3;$i++){
                    if($i==0) $tmp=$ccaa->getRSosteFinanciera();
                    else if ($i==1) $tmp=$ccaa->getRRigidez();
                    else if ($i==2) $tmp=$ccaa->getRSosteEndeuda();
                    echo '<table class="dataTable">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th></th>';
                    foreach($tmp as $clave=>$valor){
                        echo '<th>'.$clave.'</th>';
                    }
                    echo '</tr>';
                    echo'</thead>';
                    echo '<tbody>';
                    echo '<tr>';
                    if($i==0) echo '<th>Sostenibilidad financiera</th>';
                    else if ($i==1) echo '<th>Apalancamiento operativo</th>';
                    else if ($i==2) echo '<th>Sostenibilidad de la deuda</th>';
                    foreach($tmp as $clave=>$valor){
                        echo '<td>'.($valor*100).'%</td>';
                    }
                    echo '</tr>';
                    echo'</tbody>';
                    echo '</table>';
                    echo '<br>';
                }
                ?>
                <!-- GRAFICAS-->
                <script>
                    var datos = <?php echo json_encode($datos)?>;
                    var etiquetas = <?php echo json_encode($etiquetas)?>;
                    var datosA = <?php echo json_encode($datosApalancamiento)?>;
                    var etiquetasA = <?php echo json_encode($etiquetasApalancamiento)?>;
                    var datosSostenibilidad = <?php echo json_encode($datosSostenibilidad)?>;
                    var etiquetasSostenibilidad = <?php echo json_encode($etiquetasSostenibilidad)?>;
                </script>

                <!--Grafica de ahorro neto-->
                <br><br>
                <div class="graficos">
                    <canvas id="ahorroNeto" height="300" width="500"></canvas>
                    <canvas id="apalancamientoOperativoA" height="300" width="500"></canvas>
                    <canvas id="sostenibilidad" height="300" width="500"></canvas>
                    <br><br>
                </div>
                <script>
                    const chart = document.getElementById('ahorroNeto').getContext('2d');
                    const configChart = {
                        type: 'bar',
                        data: {
                            labels: etiquetas,
                            datasets: [{
                                label: 'Porcentaje de sostenibilidad financiera',
                                data: datos,
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
                                    text:'Ahorro Neto',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };
                    const chartA = document.getElementById('apalancamientoOperativoA').getContext('2d');
                    const configChartA = {
                        type: 'bar',
                        data: {
                            labels: etiquetasA,
                            datasets: [{
                                label: 'Porcentaje de apalancamiento operativo',
                                data: datosA,
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

                    const chartS = document.getElementById('sostenibilidad').getContext('2d');
                    const configChartS = {
                        type: 'bar',
                        data: {
                            labels:etiquetasSostenibilidad,
                            datasets: [{
                                label: 'Porcentaje de sostenibilidad de la deuda',
                                data: datosSostenibilidad,
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
                                    text:'Sostenibilidad de la deuda',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };
                    const ahorroNeto = new Chart(chart, configChart);
                    const apalancamientoOperativoA = new Chart(chartA, configChartA);
                    const sostenibilidad = new Chart(chartS, configChartS);

                </script>
                <br><br>
                <h3>Liquidez</h3>
                <?php
                /*foreach($ccaa->getPMP() as $array){
                    echo '<p>PMP '.$array[0].' (Mes '.$array[1].'): '.$array[2].' días</p>';
                }
                foreach($ccaaNac->getPMP() as $array){
                    echo '<p>PMP medio '.$array[0].' (Mes '.$array[1].'): '.$array[2].' días</p>';
                }*/
                for($i=0;$i<2;$i++){
                    if($i==0) $tmp=$ccaa->getPMP();
                    else if ($i==1) $tmp=$ccaaNac->getPMP();
                    echo '<table class="dataTable">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th></th>';
                    foreach($tmp as $array){
                        echo '<th>'.$array[0].' (Mes '.$array[1].')</th>';
                    }
                    echo '</tr>';
                    echo'</thead>';
                    echo '<tbody>';
                    echo '<tr>';
                    if($i==0) echo '<th>PMP</th>';
                    else if ($i==1) echo '<th>PMP medio</th>';
                    foreach($tmp as $array){
                        echo '<td>'.$array[2].' días</td>';
                    }
                    echo '</tr>';
                    echo'</tbody>';
                    echo '</table>';
                    echo '<br>';
                }
                ?>
                <script>
                    var datosPMP = <?php echo json_encode($datosPMP)?>;
                    var etiquetasPMP = <?php echo json_encode($etiquetasPMP)?>;
                    var datosPMPNac = <?php echo json_encode($datosPMPNac)?>;
                    var etiquetasPMPNac = <?php echo json_encode($etiquetasPMPNac)?>;
                </script>

                <!--Grafica de ahorro neto-->
                <br><br>
                <div class="graficos">
                    <canvas id="pmp" height="300" width="500"></canvas>
                    <canvas id="pmpNac" height="300" width="500"></canvas>
                    <br><br>
                </div>
                <script>
                    const chartPMP = document.getElementById('pmp').getContext('2d');
                    const configChartPMP = {
                        type: 'bar',
                        data: {
                            labels:etiquetasPMP,
                            datasets: [{
                                label: 'PMP de la comunidad',
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
                    const chartPMPNac = document.getElementById('pmpNac').getContext('2d');
                    const configChartPMPNac = {
                        type: 'bar',
                        data: {
                            labels:etiquetasPMPNac,
                            datasets: [{
                                label: 'PMP nacional',
                                data: datosPMPNac,
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
                                    text:'PMP nacional',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };
                    const pmp = new Chart(chartPMP, configChartPMP);
                    const pmpNac = new Chart(chartPMPNac, configChartPMPNac);
                </script>
                <input type="radio" id="selectBar" name="selectionChart" value="SelectBar" onclick="changeChart(pmp, configChartPMP, 'selectionChart')">
                <label for="selectBar">Barras</label>
                <input type="radio" id="selectLine" name="selectionChart" value="SelectLine" onclick="changeChart(pmp, configChartPMP, 'selectionChart')">
                <label for="selectLine">Líneas</label>
                <br><br>
                <input type="radio" id="selectBarPmpNac" name="selectionPMPNac" value="SelectBar" onclick="changeChart(pmpNac, configChartPMPNac, 'selectionPMPNac')">
                <label for="selectBarPmpNac">Barras</label>
                <input type="radio" id="selectLinePmpNac" name="selectionPMPNac" value="SelectLine" onclick="changeChart(pmpNac, configChartPMPNac, 'selectionPMPNac')">
                <label for="selectLinePmpNac">Líneas</label>
                <br><br>
                <h3>Eficiencia (en %)</h3>
                <?php
                for($i=0;$i<2;$i++){
                    if($i==0) $tmp=$ccaa->getREfic();
                    else if ($i==1) $tmp=$ccaaNac->getREfic();
                    echo '<table class="dataTable">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th></th>';
                    foreach($tmp as $clave=>$valor){
                        echo '<th>'.$clave.'</th>';
                    }
                    echo '</tr>';
                    echo'</thead>';
                    echo '<tbody>';
                    echo '<tr>';
                    if($i==0) echo '<th>Eficiencia</th>';
                    else if ($i==1) echo '<th>Eficiencia media</th>';
                    foreach($tmp as $clave=>$valor){
                        echo '<td>'.($valor*100).'%</td>';
                    }
                    echo '</tr>';
                    echo'</tbody>';
                    echo '</table>';
                    echo '<br>';
                }
                ?>
                 <script>
                    var datosE = <?php echo json_encode($datosEficiencia)?>;
                    var etiquetasE = <?php echo json_encode($etiquetasEficiencia)?>;
                    var datosEM = <?php echo json_encode($datosEficienciaNac)?>;
                    var etiquetasEM = <?php echo json_encode($etiquetasEficienciaNac)?>;
                </script>

                <!--Grafica de ahorro neto-->
                <br><br>
                <div class="graficos">
                    <canvas id="eficiencia" height="300" width="500"></canvas>
                    <canvas id="eficienciaMedia" height="300" width="500"></canvas>
                    <br><br>
                </div>
                <script>
                    const chartE = document.getElementById('eficiencia').getContext('2d');
                    const configChartE = {
                        type: 'bar',
                        data: {
                            labels: etiquetasE,
                            datasets: [{
                                label: 'Porcentaje de eficiencia',
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
                                    text:'Eficiencia',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };

                    const chartEM = document.getElementById('eficienciaMedia').getContext('2d');
                    const configChartEM = {
                        type: 'bar',
                        data: {
                            labels:etiquetasEM,
                            datasets: [{
                                label: 'Porcentaje de eficiencia media',
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
                                    text:'Eficiencia media',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };
                    const eficiencia = new Chart(chartE, configChartE);
                    const eficienciaMedia = new Chart(chartEM, configChartEM);
                </script>
                <br><br>
                <h3>Ejecución presupuestaria (en %)</h3>
                <?php
                for($i=0;$i<4;$i++){
                    if($i==0) $tmp=$ccaa->getREjeIngrCorr();
                    else if ($i==1) $tmp=$ccaaNac->getREjeIngrCorr();
                    else if ($i==2) $tmp=$ccaa->getREjeGastosCorr();
                    else if ($i==3) $tmp=$ccaaNac->getREjeGastosCorr();
                    echo '<table class="dataTable">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th></th>';
                    foreach($tmp as $clave=>$valor){
                        echo '<th>'.$clave.'</th>';
                    }
                    echo '</tr>';
                    echo'</thead>';
                    echo '<tbody>';
                    echo '<tr>';
                    if($i==0) echo '<th>Ejecución sobre ingresos corrientes</th>';
                    else if ($i==1) echo '<th>Ejecución media sobre ingresos corrientes</th>';
                    else if ($i==2) echo '<th>Ejecución sobre gastos corrientes</th>';
                    else if ($i==3) echo '<th>Ejecución media sobre gastos corrientes</th>';
                    foreach($tmp as $clave=>$valor){
                        echo '<td>'.($valor*100).'%</td>';
                    }
                    echo '</tr>';
                    echo'</tbody>';
                    echo '</table>';
                    echo '<br>';
                }
                ?>
                <script>
                    var datosRI = <?php echo json_encode($datosEjeIngrCorr)?>;
                    var etiquetasRI = <?php echo json_encode($etiquetasEjeIngrCorr)?>;
                    var datosRIN = <?php echo json_encode($datosEjeIngrCorrNac)?>;
                    var etiquetasRIN = <?php echo json_encode($etiquetasEjeIngrCorrNac)?>;
                    
                    var datosRG = <?php echo json_encode($datosEjeGastosCorr)?>;
                    var etiquetasRG = <?php echo json_encode($etiquetasEjeGastosCorr)?>;
                    var datosRGN = <?php echo json_encode($datosEjeGastosCorrNac)?>;
                    var etiquetasRGN = <?php echo json_encode($etiquetasEjeGastosCorrNac)?>;
                </script>
                <br><br>
                <div class="graficos">
                    <canvas id="ratioingrcorr" height="300" width="500"></canvas>
                    <canvas id="ratioingrcorrnac" height="300" width="500"></canvas>
                    <canvas id="ratiogastoscorr" height="300" width="500"></canvas>
                    <canvas id="ratiogastoscorrnac" height="300" width="500"></canvas>
                    <br><br>
                </div>
                <script>
                    const chartRI = document.getElementById('ratioingrcorr').getContext('2d');
                    const configChartRI = {
                        type: 'bar',
                        data: {
                            labels: etiquetasRI,
                            datasets: [{
                                label: 'Ejecución sobre ingresos corrientes',
                                data: datosRI,
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
                                    text:'Ejecución sobre ingresos corrientes',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };

                    const chartRIN = document.getElementById('ratioingrcorrnac').getContext('2d');
                    const configChartRIN = {
                        type: 'bar',
                        data: {
                            labels:etiquetasRIN,
                            datasets: [{
                                label: 'Ejecución media sobre ingresos corrientes',
                                data: datosRIN,
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
                                    text:'Ejecución media sobre ingresos corrientes',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };
                    const chartRG = document.getElementById('ratiogastoscorr').getContext('2d');
                    const configChartRG = {
                        type: 'bar',
                        data: {
                            labels:etiquetasRG,
                            datasets: [{
                                label: 'Ejecución sobre gastos corrientes',
                                data: datosRG,
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
                                    text:'Ejecución sobre gastos corrientes',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };
                    const chartRGN = document.getElementById('ratiogastoscorrnac').getContext('2d');
                    const configChartRGN = {
                        type: 'bar',
                        data: {
                            labels:etiquetasRGN,
                            datasets: [{
                                label: 'Ejecución media sobre gastos corrientes',
                                data: datosRGN,
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
                                    text:'Ejecución media sobre gastos corrientes',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };
                    const rIngrCorr = new Chart(chartRI, configChartRI);
                    const rIngrCorrNac = new Chart(chartRIN, configChartRIN);
                    const rGastosCorr = new Chart(chartRG, configChartRG);
                    const rGastosCorrNac = new Chart(chartRGN, configChartRGN);
                </script>
                <br>
                <h3>Deuda comercial pendiente de pago (en %)</h3>
                <?php
                for($i=0;$i<2;$i++){
                    if($i==0) $tmp=$ccaa->getRDCPP();
                    else if ($i==1) $tmp=$ccaaNac->getRDCPP();
                    echo '<table class="dataTable">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th></th>';
                    foreach($tmp as $array){
                        echo '<th>'.$array[0].' (Mes '.$array[1].')</th>';
                    }
                    echo '</tr>';
                    echo'</thead>';
                    echo '<tbody>';
                    echo '<tr>';
                    if($i==0) echo '<th>Porcentaje de pagos pendientes de deuda comercial</th>';
                    else if ($i==1) echo '<th>Porcentaje medio de pagos pendientes de deuda comercial</th>';
                    foreach($tmp as $array){
                        echo '<td>'.($array[2]*100).'%</td>';
                    }
                    echo '</tr>';
                    echo'</tbody>';
                    echo '</table>';
                    echo '<br>';
                }
                ?>
                <script>
                    var datosRDCPP = <?php echo json_encode($datosRDCPP)?>;
                    var etiquetasRDCPP = <?php echo json_encode($etiquetasRDCPP)?>;
                    var datosRDCPPN = <?php echo json_encode($datosRDCPPNac)?>;
                    var etiquetasRDCPPN = <?php echo json_encode($etiquetasRDCPPNac)?>;
                </script>

                <!--Grafica de ahorro neto-->
                <br><br>
                <div class="graficos">
                    <canvas id="rdcpp" height="300" width="500"></canvas>
                    <canvas id="rdcppnac" height="300" width="500"></canvas>
                    <br><br>
                </div>
                <script>
                    const chartRDCPP = document.getElementById('rdcpp').getContext('2d');
                    const configChartRDCPP = {
                        type: 'bar',
                        data: {
                            labels: etiquetasRDCPP,
                            datasets: [{
                                label: 'Porcentaje de deudas comerciales pendientes de pago cada año',
                                data: datosRDCPP,
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
                                    text:'Porcentaje de deudas comerciales pendientes de pago',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };

                    const chartRDCPPN = document.getElementById('rdcppnac').getContext('2d');
                    const configChartRDCPPN = {
                        type: 'bar',
                        data: {
                            labels:etiquetasRDCPPN,
                            datasets: [{
                                label: 'Porcentaje medio de deudas comerciales pendientes de pago cada año',
                                data: datosRDCPPN,
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
                                    text:'Porcentaje medio de deudas comerciales pendientes de pago',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };
                    const rdcpp = new Chart(chartRDCPP, configChartRDCPP);
                    const rdcppNac = new Chart(chartRDCPPN, configChartRDCPPN);
                </script>
                <br>
                <h3>Pagos obligacionales (en %)</h3>
                <?php
                for($i=0;$i<2;$i++){
                    if($i==0) $tmp=$ccaa->getPagosObligaciones();
                    else if ($i==1) $tmp=$ccaaNac->getPagosObligaciones();
                    echo '<table class="dataTable">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th></th>';
                    foreach($tmp as $clave=>$valor){
                        echo '<th>'.$clave.'</th>';
                    }
                    echo '</tr>';
                    echo'</thead>';
                    echo '<tbody>';
                    echo '<tr>';
                    if($i==0) echo '<th>Porcentaje de gastos pagados</th>';
                    else if ($i==1) echo '<th>Porcentaje medio de gastos pagados</th>';
                    foreach($tmp as $clave=>$valor){
                        echo '<td>'.($valor*100).'%</td>';
                    }
                    echo '</tr>';
                    echo'</tbody>';
                    echo '</table>';
                    echo '<br>';
                }
                ?>
                <script>
                    var datosPO = <?php echo json_encode($datosPagosObligacionales)?>;
                    var etiquetasPO = <?php echo json_encode($etiquetasPagosObligacionales)?>;
                    var datosPON = <?php echo json_encode($datosPagosObligacionalesNac)?>;
                    var etiquetasPON = <?php echo json_encode($etiquetasPagosObligacionalesNac)?>;
                </script>

                <!--Grafica de ahorro neto-->
                <br><br>
                <div class="graficos">
                    <canvas id="pagosobligaciones" height="300" width="500"></canvas>
                    <canvas id="pagosobligacionesnac" height="300" width="500"></canvas>
                    <br><br>
                </div>
                <script>
                    const chartPO = document.getElementById('pagosobligaciones').getContext('2d');
                    const configChartPO = {
                        type: 'bar',
                        data: {
                            labels: etiquetasPO,
                            datasets: [{
                                label: 'Porcentaje de gastos pagados cada año',
                                data: datosPO,
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
                                    text:'Porcentaje de gastos pagados',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };

                    const chartPON = document.getElementById('pagosobligacionesnac').getContext('2d');
                    const configChartPON = {
                        type: 'bar',
                        data: {
                            labels: etiquetasPON,
                            datasets: [{
                                label: 'Porcentaje medio de gastos pagados cada año',
                                data: datosPON,
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
                                    text:'Porcentaje medio de gastos pagados',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };
                    const pagosObligacionales = new Chart(chartPO, configChartPO);
                    const pagosObligacionalesNac = new Chart(chartPON, configChartPON);
                </script>
                <br>
                <h3>Eficacia recaudatoria (en %)</h3>
                <?php
                for($i=0;$i<2;$i++){
                    if($i==0) $tmp=$ccaa->getREficaciaRec();
                    else if ($i==1) $tmp=$ccaaNac->getREficaciaRec();
                    echo '<table class="dataTable">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th></th>';
                    foreach($tmp as $clave=>$valor){
                        echo '<th>'.$clave.'</th>';
                    }
                    echo '</tr>';
                    echo'</thead>';
                    echo '<tbody>';
                    echo '<tr>';
                    if($i==0) echo '<th>Eficacia recaudatoria</th>';
                    else if ($i==1) echo '<th>Eficacia media recaudatoria</th>';
                    foreach($tmp as $clave=>$valor){
                        echo '<td>'.($valor*100).'%</td>';
                    }
                    echo '</tr>';
                    echo'</tbody>';
                    echo '</table>';
                    echo '<br>';
                }
                ?>
                <script>
                    var datosER = <?php echo json_encode($datosREficaciaRec)?>;
                    var etiquetasER = <?php echo json_encode($etiquetasREficaciaRec)?>;
                    var datosERN = <?php echo json_encode($datosREficaciaRecNac)?>;
                    var etiquetasERN = <?php echo json_encode($etiquetasREficaciaRecNac)?>;
                </script>

                <!--Grafica de ahorro neto-->
                <br><br>
                <div class="graficos">
                    <canvas id="eficreca" height="300" width="500"></canvas>
                    <canvas id="eficrecanac" height="300" width="500"></canvas>
                    <br><br>
                </div>
                <script>
                    const chartER = document.getElementById('eficreca').getContext('2d');
                    const configChartER = {
                        type: 'bar',
                        data: {
                            labels: etiquetasER,
                            datasets: [{
                                label: 'Eficacia recaudatoria cada año',
                                data: datosER,
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
                                    text:'Eficacia recaudatoria',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };

                    const chartERN = document.getElementById('eficrecanac').getContext('2d');
                    const configChartERN = {
                        type: 'bar',
                        data: {
                            labels:etiquetasERN,
                            datasets: [{
                                label: 'Eficacia recaudatoria media cada año',
                                data: datosERN,
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
                                    text:'Eficacia recaudatoria media',
                                    color: '#003E99',
                                    font:{
                                        size:20
                                    }
                                }
                            }
                        }
                    };
                    const eficrecaudatoria = new Chart(chartER, configChartER);
                    const eficrecaudatoriaNac = new Chart(chartERN, configChartERN);
                </script>
            <?php
            }
            else {
                echo '<p>Comunidad autónoma no encontrada</p>';
            }
            ?>
        </div>

        <div id = "pie">
            <?php require("includesWeb/comun/pie.php");?>
        </div>
    </body>
</html>