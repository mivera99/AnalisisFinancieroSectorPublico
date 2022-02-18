<?php
session_start();
require_once('includesWeb/daos/DAOConsultor.php');

$nombre = htmlspecialchars(trim(strip_tags($_GET["ccaa"])));

$daoccaa = new DAOConsultor();
$ccaa = $daoccaa->getCCAA($nombre);
$ccaaNac = $daoccaa->getCCAA('NACIONAL');

$encontrado = false;
if($ccaa && $ccaaNac){
    $encontrado = true;
    /*Preparación de datos para las gráficas*/
    /*PIB CCAA y PIB Nacional*/
    $datosPib = array();
    $etiquetasPib = array();
    foreach($ccaa->getIncrPib() as $clave=>$valor){
        array_unshift($etiquetasPib, $clave);
        array_unshift($datosPib, $valor*100);
    }
    $datosPibNac = array();
    $etiquetasPibNac = array();
    foreach($ccaaNac->getIncrPib() as $clave=>$valor){
        array_unshift($etiquetasPibNac, $clave);
        array_unshift($datosPibNac, $valor*100);
    }
    /*Paro CCAA y paro nacional*/
    $datosParo = array();
    $etiquetasParo = array();
    foreach($ccaa->getParo() as $array){
        array_unshift($etiquetasParo, $array[0]);
        array_unshift($datosParo, $array[2]*100);
    }
    $datosParoNac = array();
    $etiquetasParoNac = array();
    foreach($ccaaNac->getParo() as $array){
        array_unshift($etiquetasParoNac, $array[0]);
        array_unshift($datosParoNac, $array[2]*100);
    }
    /*Transacciones inmobiliarias CCAA y transacciones nacionales*/
    $datosTransac = array();
    $etiquetasTransac = array();
    foreach($ccaa->getTransacInmobiliarias() as $array){
        array_unshift($etiquetasTransac, $array[0]);
        array_unshift($datosTransac, $array[2]*100);
    }
    $datosTransacNac = array();
    $etiquetasTransacNac = array();
    foreach($ccaaNac->getTransacInmobiliarias() as $array){
        array_unshift($etiquetasTransacNac, $array[0]);
        array_unshift($datosTransacNac, $array[2]*100);
    }
    /*Crecimiento de empresas CCAA y crecimiento de empresas a nivel nacional*/
    $datosEmpresas = array();
    $etiquetasEmpresas = array();
    foreach($ccaa->getEmpresas() as $clave=>$valor){
        array_unshift($etiquetasEmpresas, $clave);
        array_unshift($datosEmpresas, $valor*100);
    }
    $datosEmpresasNac = array();
    $etiquetasEmpresasNac = array();
    foreach($ccaaNac->getEmpresas() as $clave=>$valor){
        array_unshift($etiquetasEmpresasNac, $clave);
        array_unshift($datosEmpresasNac, $valor*100);
    }
    /*Resultado presupuestario CCAA y nacional*/
    $datosPresupuestario = array();
    $etiquetasPresupuestario = array();
    foreach($ccaa->getCCAAPib() as $clave=>$valor){
        array_unshift($etiquetasPresupuestario, $clave);
        array_unshift($datosPresupuestario, $valor*100);
    }
    $datosPresupuestarioNac = array();
    $etiquetasPresupuestarioNac = array();
    foreach($ccaaNac->getCCAAPib() as $clave=>$valor){
        array_unshift($etiquetasPresupuestarioNac, $clave);
        array_unshift($datosPresupuestarioNac, $valor*100);
    }
    /*Deuda viva CCAA y nacional*/
    $datosDeudaVivaIngrCor = array();
    $etiquetasDeudaVivaIngrCor = array();
    foreach($ccaa->getDeudaVivaIngrCor() as $array){
        array_unshift($etiquetasDeudaVivaIngrCor, $array[0]);
        array_unshift($datosDeudaVivaIngrCor, $array[2]*100);
    }
    $datosDeudaVivaNac = array();
    $etiquetasDeudaVivaNac = array();
    foreach($ccaaNac->getDeudaVivaIngrCor() as $array){
        array_unshift($etiquetasDeudaVivaNac, $array[0]);
        array_unshift($datosDeudaVivaNac, $array[2]*100);
    }
    /*Ingresos corrientes CCAA */
    $datosIngresosCor = array();
    $etiquetasIngresosCor = array();
    foreach($ccaaNac->getTotalIngresosCorrientes1() as $clave=>$valor){
        array_unshift($etiquetasIngresosCor, $clave);
        array_unshift($datosIngresosCor, $valor*100);
    }
    /*Ingresos no financieros CCAA*/
    $datosIngresosNoFinancieros = array();
    $etiquetasIngresosNoFinancieros = array();
    foreach($ccaaNac->getTotalIngresosNoCorrientes1() as $clave=>$valor){
        array_unshift($etiquetasIngresosNoFinancieros, $clave);
        array_unshift($datosIngresosNoFinancieros, $valor*100);
    }
    /*Dato ingreso no financiero per cápita*/
    $datosIngresosTotales = array();
    $etiquetasIngresosTotales = array();
    foreach($ccaaNac->getTotalIngresos1() as $clave=>$valor){
        array_unshift($etiquetasIngresosTotales, $clave);
        array_unshift($datosIngresosTotales, $valor*100);
    }
    /*Gastos corrientes CCAA */
    $datosGastosCor = array();
    $etiquetasGastosCor = array();
    foreach($ccaaNac->getTotalGastosCorrientes1() as $clave=>$valor){
        array_unshift($etiquetasGastosCor, $clave);
        array_unshift($datosGastosCor, $valor*100);
    }
    /*Gastos no financieros CCAA*/
    $datosGastosNoFinancieros = array();
    $etiquetasGastosNoFinancieros = array();
    foreach($ccaaNac->getTotalGastosNoFinancieros1() as $clave=>$valor){
        array_unshift($etiquetasGastosNoFinancieros, $clave);
        array_unshift($datosGastosNoFinancieros, $valor*100);
    }
    /*Dato gasto no financiero per cápita*/
    $datosGastosFinancieros = array();
    $etiquetasGastosFinancieros = array();
    foreach($ccaaNac->getTotalGastos1() as $clave=>$valor){
        array_unshift($etiquetasGastosFinancieros, $clave);
        array_unshift($datosGastosFinancieros, $valor*100);
    }
    /*Ahorro Neto*/
    $datos = array();
    $etiquetas = array();
    foreach($ccaa->getRSosteFinanciera() as $clave=>$valor){
        array_unshift($etiquetas, $clave);
        array_unshift($datos, $valor*100);
    }
    /*Apalancamiento Operativo*/ 
    $datosApalancamiento=array();
    $etiquetasApalancamiento=array();
    foreach($ccaa->getRRigidez() as $clave=>$valor){
        array_unshift($etiquetasApalancamiento, $clave);
        array_unshift($datosApalancamiento, $valor*100);
    }
    /*Sostenibilidad de la deuda CCAA, y media CCAA*/ 
    $datosSostenibilidad=array();
    $etiquetasSostenibilidad=array();
    foreach($ccaa->getRRigidez() as $clave=>$valor){
        array_unshift($etiquetasSostenibilidad, $clave);
        array_unshift($datosSostenibilidad, $valor*100);
    }
    /*PMP CCAA, y media PMP CCAA*/ 
    $datosPMP=array();
    $etiquetasPMP=array();
    foreach($ccaa->getPMP() as $array){
        array_unshift($etiquetasPMP, $array[0]);
        array_unshift($datosPMP, $array[2]);
    }
    $datosPMPNac=array();
    $etiquetasPMPNac=array();
    foreach($ccaaNac->getPMP() as $array){
        array_unshift($etiquetasPMPNac, $array[0]);
        array_unshift($datosPMPNac, $array[2]);
    }
    /*Eficiencia CCAA, y media eficiencia CCAA*/ 
    $datosEficiencia=array();
    $etiquetasEficiencia=array();
    foreach($ccaa->getREfic() as $clave=>$valor){
        array_unshift($etiquetasEficiencia, $clave);
        array_unshift($datosEficiencia, $valor*100);
    }
    $datosEficienciaNac=array();
    $etiquetasEficienciaNac=array();
    foreach($ccaaNac->getREfic() as $clave=>$valor){
        array_unshift($etiquetasEficienciaNac, $clave);
        array_unshift($datosEficienciaNac, $valor*100);
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

    <script src="node_modules/chart.js/dist/chart.js"></script>
    <!--<script src="graphics.js"></script>-->

    <title>Análisis Financiero del Sector Público - Comunidad Autónoma</title>
</head>
    <body>
        <div id = "cabecera">
            <?php require("includesWeb/comun/cabecera.php");?>  
        </div>
        
        <div id ="contenido"> 
            <?php
            if($encontrado){
                echo '<h2>'.$ccaa->getNombre().'</h2>';
                $ratings = $ccaa->getScoring();
                foreach($ratings as $clave => $valor){
                    echo '<h2>Rating '.$clave.'</h2>';
                    echo '<button class="scoring '.$valor.'">'.$valor.'</button><p>Tendencia: '.($ccaa->getTendencia())[$clave].'</p>';
                }
                echo "<br>";
                echo '<h3>Datos generales</h3>';
                echo '<p><b>Presidente de la comunidad: </b>'.$ccaa->getNombrePresidente().' '.$ccaa->getApellido1().' '.$ccaa->getApellido2().'</p>';
                echo '<p><b>Vigencia: </b>'.$ccaa->getVigencia().'</p>';
                echo '<p><b>Partido político: </b>'.$ccaa->getPartido().'</p>';
                echo '<p><b>CIF: </b>'.$ccaa->getCif().'</p>';
                echo '<p><b>Via: </b>'.$ccaa->getTipoVia().' '.$ccaa->getNombreVia().', '.$ccaa->getNumVia().'</p>';
                echo '<p><b>Teléfono: </b>'.$ccaa->getTelefono().'</p>';
                echo '<p><b>Código Postal: </b>'.$ccaa->getCodigoPostal().'</p>';
                echo '<p><b>Fax: </b>'.$ccaa->getFax().'</p>';
                echo '<p><b>Sitio web: </b><a href="https://'.$ccaa->getWeb().'" target="_blank">'.$ccaa->getWeb().'</a></p>';
                echo '<p><b>Correo electrónico: </b>'.$ccaa->getMail().'</p>';
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
                    var datosEmpresasNac = <?php echo json_encode($datosEmpresas)?>;
                    var etiquetasEmpresasNac = <?php echo json_encode($etiquetasEmpresas)?>;
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
                                    text:'Ahorro PIB nacional',
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
                foreach($ccaa->getCCAAPib() as $clave=>$valor){
                    echo '<p><b>Resultado presupuestario '.$clave.': </b>'.($valor*100).'%</p>';
                }
                foreach($ccaaNac->getCCAAPib() as $clave=>$valor){
                    echo '<p><b>Resultado presupuestario nacional '.$clave.': </b>'.($valor*100).'%</p>';
                }
                foreach($ccaa->getDeudaVivaIngrCor() as $array){
                    echo '<p><b>Deuda viva sobre ingresos corrientes '.$array[0].' trimestre '.$array[1].' : </b>'.($array[2]*100).'%</p>';
                }
                foreach($ccaaNac->getDeudaVivaIngrCor() as $array){
                    echo '<p><b>Deuda viva nacional sobre ingresos corrientes '.$array[0].' trimestre '.$array[1].' : </b>'.($array[2]*100).'%</p>';
                }
                ?>
                <br><br>
                <h3>Ingresos (en €)</h3>
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th colspan="3">Liquidación derechos reconocidas</th>
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
                            <td>1. Impuestos directos</td>
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
                <br><br>
                <h3>Gastos (en €)</h3>
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th colspan="3" style="height:40px">Liquidación  obligaciones reconocidas</th>
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
                <br><br>
                <h3>Solvencia (en %)</h3>
                <!--METER LOS GRAFICOS AQUI-->
                <?php
                foreach($ccaa->getRSosteFinanciera() as $clave=>$valor){
                    echo '<p><b>Sostenibilidad financiera año '.$clave.': </b>'.($valor*100).'%</p>';
                }
                echo '<br>';
                foreach($ccaa->getRRigidez() as $clave=>$valor){
                    echo '<p><b>Apalancamiento operativo año '.$clave.': </b>'.($valor*100).'%</p>';
                }
                echo '<br>';
                foreach($ccaa->getRSosteEndeuda() as $clave=>$valor){
                    echo '<p><b>Sostenibilidad de la deuda año '.$clave.': </b>'.($valor*100).'%</p>';
                }
                ?>
                <!-- GRAFICAS-->
                <script>
                    var datos = <?php echo json_encode($datos)?>;
                    var etiquetas = <?php echo json_encode($etiquetas)?>;
                    var datosA = <?php echo json_encode($datosApalancamiento)?>;
                    var etiquetasA = <?php echo json_encode($etiquetasApalancamiento)?>;
                </script>

                <!--Grafica de ahorro neto-->
                <br><br>
                <div class="graficos">
                    <canvas id="ahorroNeto" height="300" width="500"></canvas>
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
                    const ahorroNeto = new Chart(chart, configChart);
                </script>
                <!-- Grafica de apalancamiento operativo--> 
                <br><br>
                <div class="graficos">
                    <canvas id="apalancamientoOperativoA" height="300" width="500"></canvas>
                </div>
                <script>
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
                    const apalancamientoOperativoA = new Chart(chartA, configChartA);
                </script>
                <br><br>
                <h3>Liquidez</h3>
                <?php
                foreach($ccaa->getPMP() as $array){
                    echo '<p>PMP '.$array[0].' (Mes '.$array[1].'): '.$array[2].'</p>';
                }
                foreach($ccaaNac->getPMP() as $array){
                    echo '<p>PMP medio '.$array[0].' (Mes '.$array[1].'): '.$array[2].'</p>';
                }
                ?>
                <br><br>
                <h3>Eficiencia (en %)</h3>
                <?php
                foreach($ccaa->getREfic() as $clave=>$valor){
                    echo '<p><b>Eficiencia '.$clave.': </b>'.($valor*100).'%</p>';
                }
                foreach($ccaaNac->getREfic() as $clave=>$valor){
                    echo '<p><b>Eficiencia media '.$clave.': </b>'.($valor*100).'%</p>';
                }
                ?>
                <br><br>
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