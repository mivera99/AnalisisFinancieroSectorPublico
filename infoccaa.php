<?php
session_start();
require_once('includesWeb/daos/DAOConsultor.php');

$nombre = htmlspecialchars(trim(strip_tags($_GET["ccaa"])));

$daoccaa = new DAOConsultor();
$ccaa = $daoccaa->getCCAA($nombre);
$ccaaNac = $daoccaa->getCCAA('NACIONAL');

$ccaa2018 = $daoccaa->getEconomiaCCAA(new CCAA(), $ccaa->getCodigo(), 2018);
$ccaa2019 = $daoccaa->getEconomiaCCAA(new CCAA(), $ccaa->getCodigo(), 2019);
$ccaa2020 = $daoccaa->getEconomiaCCAA(new CCAA(), $ccaa->getCodigo(), 2020);
$ccaa2020 = $daoccaa->getRatingInfo($ccaa2020, $ccaa->getCodigo(), 2020);
$ccaa2021 = $daoccaa->getRatingInfo(new CCAA(), $ccaa->getCodigo(), 2021);

$ccaa2019Deudas = $daoccaa->getDeudasCCAA(new CCAA(), $ccaa->getCodigo(), 2019);

$ccaa2021Mes6 = $daoccaa->getCuentasMensualesInfo(new CCAA(), $ccaa->getCodigo(), 2021, 6);
$ccaa2020Mes6 = $daoccaa->getCuentasMensualesInfo(new CCAA(), $ccaa->getCodigo(), 2020, 6);
$ccaa2019Mes6 = $daoccaa->getCuentasMensualesInfo(new CCAA(), $ccaa->getCodigo(), 2019, 6);
$ccaa2018Mes6 = $daoccaa->getCuentasMensualesInfo(new CCAA(), $ccaa->getCodigo(), 2018, 6);

$ccaa2021Mes3 = $daoccaa->getCuentasMensualesInfo(new CCAA(), $ccaa->getCodigo(), 2021, 3);
$ccaa2020Mes3 = $daoccaa->getCuentasMensualesInfo(new CCAA(), $ccaa->getCodigo(), 2020, 3);
$ccaa2019Mes3 = $daoccaa->getCuentasMensualesInfo(new CCAA(), $ccaa->getCodigo(), 2019, 3);
$ccaa2018Mes3 = $daoccaa->getCuentasMensualesInfo(new CCAA(), $ccaa->getCodigo(), 2018, 3);

$ccaa2020nac = $daoccaa->getEconomiaCCAA(new CCAA(), 20, 2020);
$ccaa2019nac = $daoccaa->getEconomiaCCAA(new CCAA(), 20, 2019);
$ccaa2018nac = $daoccaa->getEconomiaCCAA(new CCAA(), 20, 2018);

$ccaa2021nacMes3 = $daoccaa->getCuentasMensualesInfo(new CCAA(), 20, 2021, 3);
$ccaa2020nacMes3 = $daoccaa->getCuentasMensualesInfo(new CCAA(), 20, 2020, 3);
$ccaa2019nacMes3 = $daoccaa->getCuentasMensualesInfo(new CCAA(), 20, 2019, 3);
$ccaa2018nacMes3 = $daoccaa->getCuentasMensualesInfo(new CCAA(), 20, 2018, 3);

$ccaa2020nacMes6 = $daoccaa->getCuentasMensualesInfo(new CCAA(), 20, 2020, 6);
$ccaa2019nacMes6 = $daoccaa->getCuentasMensualesInfo(new CCAA(), 20, 2019, 6);
$ccaa2018nacMes6 = $daoccaa->getCuentasMensualesInfo(new CCAA(), 20, 2018, 6);

$ccaa2020Mes5 = $daoccaa->getCuentasMensualesInfo(new CCAA(), $ccaa->getCodigo(), 2020, 5);
$ccaa2019Mes5 = $daoccaa->getCuentasMensualesInfo(new CCAA(), $ccaa->getCodigo(), 2019, 5);
$ccaa2020nacMes5 = $daoccaa->getCuentasMensualesInfo(new CCAA(), 20, 2020, 5);
$ccaa2019nacMes5 = $daoccaa->getCuentasMensualesInfo(new CCAA(), 20, 2019, 5);


$encontrado = false;
if($ccaa){
    $encontrado = true;
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
                            <th>2018</th>
                            <th>2019</th>
                            <th>2020</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1. Impuestos directos</td>
                            <td><?php echo number_format($ccaa2018->getImpuestosDirectos1(), 2, ',','.');?></td>
                            <td><?php echo number_format($ccaa2019->getImpuestosDirectos1(), 2, ',','.');?></td>
                            <td><?php echo number_format($ccaa2020->getImpuestosDirectos1(), 2, ',','.');?></td>
                        </tr>
                        <tr>
                            <td>2. Impuestos indirectos</td>
                            <td><?php echo number_format($ccaa2018->getImpuestosIndirectos1(), 2, ',','.');?></td>
                            <td><?php echo number_format($ccaa2019->getImpuestosIndirectos1(), 2, ',','.');?></td>
                            <td><?php echo number_format($ccaa2020->getImpuestosIndirectos1(), 2, ',','.');?></td>
                        </tr>
                        <tr>
                            <td>3. Tasas, precios, públicos y otros ingresos</td>
                            <td><?php echo number_format($ccaa2018->getTasasPreciosOtros1(), 2, ',','.');?></td>
                            <td><?php echo number_format($ccaa2019->getTasasPreciosOtros1(), 2, ',','.');?></td>
                            <td><?php echo number_format($ccaa2020->getTasasPreciosOtros1(), 2, ',','.');?></td>
                        </tr>
                        <tr>
                            <td>4. Transferencias corrientes</td>
                            <td><?php echo number_format($ccaa2018->getTransferenciasCorrientes1(), 2, ',','.');?></td>
                            <td><?php echo number_format($ccaa2019->getTransferenciasCorrientes1(), 2, ',','.');?></td>
                            <td><?php echo number_format($ccaa2020->getTransferenciasCorrientes1(), 2, ',','.');?></td>
                        </tr>
                        <tr>
                            <td>5. Ingresos patrimoniales</td>
                            <td><?php echo number_format($ccaa2018->getIngresosPatrimoniales1(), 2, ',','.');?></td>
                            <td><?php echo number_format($ccaa2019->getIngresosPatrimoniales1(), 2, ',','.');?></td>
                            <td><?php echo number_format($ccaa2020->getIngresosPatrimoniales1(), 2, ',','.');?></td>
                        </tr>
                        <tr>
                            <th>Total ingresos corrientes</th>
                            <th><?php echo number_format($ccaa2018->getTotalIngresosCorrientes1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getTotalIngresosCorrientes1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getTotalIngresosCorrientes1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <td>6. Enajenación de inversiones reales</td>
                            <td><?php echo number_format($ccaa2018->getEnajenacionInversionesReales1(), 2, ',','.');?></td>
                            <td><?php echo number_format($ccaa2019->getEnajenacionInversionesReales1(), 2, ',','.');?></td>
                            <td><?php echo number_format($ccaa2020->getEnajenacionInversionesReales1(), 2, ',','.');?></td>
                        </tr>
                        <tr>
                            <td>7. Transferencias de capital</td>
                            <td><?php echo number_format($ccaa2018->getTransferenciasCapital1(), 2, ',','.');?></td>
                            <td><?php echo number_format($ccaa2019->getTransferenciasCapital1(), 2, ',','.');?></td>
                            <td><?php echo number_format($ccaa2020->getTransferenciasCapital1(), 2, ',','.');?></td>
                        </tr>
                        <tr>
                            <th>Ingresos no financieros</th>
                            <th><?php echo number_format($ccaa2018->getTotalIngresosNoCorrientes1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getTotalIngresosNoCorrientes1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getTotalIngresosNoCorrientes1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <td>8. Activos financieros</td>
                            <td><?php echo number_format($ccaa2018->getActivosFinancieros1(), 2, ',','.');?></td>
                            <td><?php echo number_format($ccaa2019->getActivosFinancieros1(), 2, ',','.');?></td>
                            <td><?php echo number_format($ccaa2020->getActivosFinancieros1(), 2, ',','.');?></td>
                        </tr>
                        <tr>
                            <td>9. Pasivos financieros</td>
                            <td><?php echo number_format($ccaa2018->getPasivosFinancieros1(), 2, ',','.');?></td>
                            <td><?php echo number_format($ccaa2019->getPasivosFinancieros1(), 2, ',','.');?></td>
                            <td><?php echo number_format($ccaa2020->getPasivosFinancieros1(), 2, ',','.');?></td>
                        </tr>
                        <tr>
                            <th>Ingresos totales</th>
                            <th><?php echo number_format($ccaa2018->getTotalIngresos1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getTotalIngresos1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getTotalIngresos1(), 2, ',','.');?></th>
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
                            <th>2018</th>
                            <th>2019</th>
                            <th>2020</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1. Gastos del personal</th>
                            <td><?php echo number_format($ccaa2018->getGastosPersonal1(), 2, ',','.');?></th>
                            <td><?php echo number_format($ccaa2019->getGastosPersonal1(), 2, ',','.');?></th>
                            <td><?php echo number_format($ccaa2020->getGastosPersonal1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <td>2. Gastos corrientes en bienes y servicios</th>
                            <td><?php echo number_format($ccaa2018->getGastosCorrientesBienesServicios1(), 2, ',','.');?></th>
                            <td><?php echo number_format($ccaa2019->getGastosCorrientesBienesServicios1(), 2, ',','.');?></th>
                            <td><?php echo number_format($ccaa2020->getGastosCorrientesBienesServicios1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <td>3. Gastos financieros</th>
                            <td><?php echo number_format($ccaa2018->getGastosFinancieros1(), 2, ',','.');?></th>
                            <td><?php echo number_format($ccaa2019->getGastosFinancieros1(), 2, ',','.');?></th>
                            <td><?php echo number_format($ccaa2020->getGastosFinancieros1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <td>4. Transferencias corrientes</th>
                            <td><?php echo number_format($ccaa2018->getTransferenciasCorrientesGastos1(), 2, ',','.');?></th>
                            <td><?php echo number_format($ccaa2019->getTransferenciasCorrientesGastos1(), 2, ',','.');?></th>
                            <td><?php echo number_format($ccaa2020->getTransferenciasCorrientesGastos1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <td>5. Fondo de contingencia</th>
                            <td><?php echo number_format($ccaa2018->getFondoContingencia1(), 2, ',','.');?></th>
                            <td><?php echo number_format($ccaa2019->getFondoContingencia1(), 2, ',','.');?></th>
                            <td><?php echo number_format($ccaa2020->getFondoContingencia1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <th>Total gastos corrientes</th>
                            <th><?php echo number_format($ccaa2018->getTotalGastosCorrientes1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getTotalGastosCorrientes1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getTotalGastosCorrientes1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <td>6. Inversiones reales</th>
                            <td><?php echo number_format($ccaa2018->getInversionesReales1(), 2, ',','.');?></th>
                            <td><?php echo number_format($ccaa2019->getInversionesReales1(), 2, ',','.');?></th>
                            <td><?php echo number_format($ccaa2020->getInversionesReales1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <td>7. Transferencias de capital</th>
                            <td><?php echo number_format($ccaa2018->getTransferenciasCapitalGastos1(), 2, ',','.');?></th>
                            <td><?php echo number_format($ccaa2019->getTransferenciasCapitalGastos1(), 2, ',','.');?></th>
                            <td><?php echo number_format($ccaa2020->getTransferenciasCapitalGastos1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <th>Gastos no financieros</th>
                            <th><?php echo number_format($ccaa2018->getTotalGastosNoFinancieros1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getTotalGastosNoFinancieros1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getTotalGastosNoFinancieros1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <td>8. Activos financieros</th>
                            <td><?php echo number_format($ccaa2018->getActivosFinancieros1(), 2, ',','.');?></th>
                            <td><?php echo number_format($ccaa2019->getActivosFinancieros1(), 2, ',','.');?></th>
                            <td><?php echo number_format($ccaa2020->getActivosFinancierosGastos1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <td>9. Pasivos financieros</th>
                            <td><?php echo number_format($ccaa2018->getPasivosFinancierosGastos1(), 2, ',','.');?></th>
                            <td><?php echo number_format($ccaa2019->getPasivosFinancierosGastos1(), 2, ',','.');?></th>
                            <td><?php echo number_format($ccaa2020->getPasivosFinancierosGastos1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <th>Gasto total</th>
                            <th><?php echo number_format($ccaa2018->getTotalGastos1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getTotalGastos1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getTotalGastos1(), 2, ',','.');?></th>
                        </tr>
                    </tbody>
                </table>
                <br><br>
                <h3>Solvencia</h3>
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
                <?php
                $datos = array();
                $etiquetas = array();
                foreach($ccaa->getRSosteFinanciera() as $clave=>$valor){
                    array_push($etiquetas, $clave);
                    array_push($datos, $valor*100);
                }
                $datosApalancamiento=array();
                $etiquetasApalancamiento=array();
                foreach($ccaa->getRRigidez() as $clave=>$valor){
                    array_push($etiquetasApalancamiento, $clave);
                    array_push($datosApalancamiento, $valor*100);
                }
                ?>
                <script>
                    var datos = <?php echo json_encode($datos)?>;
                    var etiquetas = <?php echo json_encode($etiquetas)?>;
                    var datosA = <?php echo json_encode($datosApalancamiento)?>;
                    var etiquetasA = <?php echo json_encode($etiquetasApalancamiento)?>;
                </script>

                <!--Grafica de ahorro neto-->
                <br><br>
                <div class="graficos">
                    <canvas id="ahorroNeto" height="500" width="700"></canvas>
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
                    <canvas id="apalancamientoOperativoA" height="500" width="700"></canvas>
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
                <h3>Eficiencia</h3>
                <?php
                foreach($ccaa->getREfic() as $clave=>$valor){
                    echo '<p><b>Eficiencia '.$clave.': </b>'.($valor*100).'%</p>';
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