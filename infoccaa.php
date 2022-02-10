<?php
session_start();
require_once('includesWeb/daos/DAOConsultor.php');
require_once('includesWeb/ccaa.php');

$nombre = htmlspecialchars(trim(strip_tags($_GET["ccaa"])));

$daoccaa = new DAOConsultor();
$ccaa = $daoccaa->getCCAA($nombre);

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
                
                echo '<h2>Rating 2020</h2>';
                echo '<button class="scoring '. $ccaa2020->getScoring() . '">'. $ccaa2020->getScoring() .'</button><p>Tendencia:'.$ccaa2020->getTendencia().'</p>';
                echo '<h2>Rating 2021</h2>';
                echo '<button class="scoring '. $ccaa2021->getScoring() . '">'. $ccaa2021->getScoring() .'</button><p>Tendencia:'.$ccaa2021->getTendencia().'</p>';
                echo "<br>";
                echo '<h3>Datos generales</h3>';
                echo '<p><b>Población: </b>'.$ccaa2020->getPoblacion().'</p>';
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
                            <th>Población: <?php echo $ccaa->getNombre();?></th>
                            <th></th>
                            <th>PIB per cápita: <?php echo $ccaa2019Deudas->getPibc();?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                <h4>Incremento del PIB de la comunidad<h4>
                                <ul>
                                    <li>2020: <?php echo ($ccaa2020->getIncrPib()*100).'%';?></li>
                                    <li>2019: <?php echo ($ccaa2019->getIncrPib()*100).'%';?></li>
                                    <li>2018: <?php echo ($ccaa2018->getIncrPib()*100).'%';?></li>
                                </ul>
                            </th>
                            <th>
                                <h4>Incremento del PIB nacional<h4>
                                <ul>
                                    <li>2020: <?php echo ($ccaa2020nac->getIncrPib()*100).'%';?></li>
                                    <li>2019: <?php echo ($ccaa2019nac->getIncrPib()*100).'%';?></li>
                                    <li>2018: <?php echo ($ccaa2018nac->getIncrPib()*100).'%';?></li>
                                </ul>
                            </th>
                            <th>
                                <h4>Paro<h4>
                                <ul>
                                    <li>2020: <?php echo ($ccaa2020Mes6->getParo()*100).'%';?></li>
                                    <li>2019: <?php echo ($ccaa2019Mes6->getParo()*100).'%';?></li>
                                    <li>2018: <?php echo ($ccaa2018Mes6->getParo()*100).'%';?></li>
                                </ul>
                            </th>
                            <th>
                                <h4>Paro nacional<h4>
                                <ul>
                                    <li>2020: <?php echo ($ccaa2020nacMes6->getParo()*100).'%';?></li>
                                    <li>2019: <?php echo ($ccaa2019nacMes6->getParo()*100).'%';?></li>
                                    <li>2018: <?php echo ($ccaa2018nacMes6->getParo()*100).'%';?></li>
                                </ul>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <h4>Transacciones inmobiliarias<h4>
                                <ul>
                                    <li>2020: <?php echo ($ccaa2020Mes3->getTransacInmobiliarias()*100).'%';?></li>
                                    <li>2019: <?php echo ($ccaa2019Mes3->getTransacInmobiliarias()*100).'%';?></li>
                                    <li>2018: <?php echo ($ccaa2018Mes3->getTransacInmobiliarias()*100).'%';?></li>
                                </ul>
                            </th>
                            <th>
                                <h4>Transacciones inmobiliarias nacionales<h4>
                                <ul>
                                    <li>2020: <?php echo ($ccaa2020nacMes3->getTransacInmobiliarias()*100).'%';?></li>
                                    <li>2019: <?php echo ($ccaa2019nacMes3->getTransacInmobiliarias()*100).'%';?></li>
                                    <li>2018: <?php echo ($ccaa2018nacMes3->getTransacInmobiliarias()*100).'%';?></li>
                                </ul>
                            </th>
                            <th>
                                <h4>Crecimiento de las empresas en la comunidad<h4>
                                <ul>
                                    <li>2020: <?php echo ($ccaa2020->getEmpresas()*100).'%';?></li>
                                    <li>2019: <?php echo ($ccaa2019->getEmpresas()*100).'%';?></li>
                                    <li>2018: <?php echo ($ccaa2018->getEmpresas()*100).'%';?></li>
                                </ul>
                            </th>
                            <th>
                                <h4>Crecimiento de las empresas a nivel nacional<h4>
                                <ul>
                                    <li>2020: <?php echo ($ccaa2020nac->getEmpresas()*100).'%';?></li>
                                    <li>2019: <?php echo ($ccaa2019nac->getEmpresas()*100).'%';?></li>
                                    <li>2018: <?php echo ($ccaa2018nac->getEmpresas()*100).'%';?></li>
                                </ul>
                            </th>
                        </tr>
                    </tbody>
                </table>
                <br><br>
                <h3><b>Resultado presupuestario y endeudamiento</b></h3>
                <p><b>Resultado presupuestario 2020: </b><?php echo $ccaa2020->getCCAAPib();?></p>
                <p><b>Resultado presupuestario 2019: </b><?php echo $ccaa2019->getCCAAPib();?></p>
                <p><b>Resultado presupuestario 2018: </b><?php echo $ccaa2018->getCCAAPib();?></p>
                <p><b>Resultado presupuestario nacional 2020: </b><?php echo $ccaa2020nac->getCCAAPib();?></p>
                <p><b>Resultado presupuestario nacional 2019: </b><?php echo $ccaa2019nac->getCCAAPib();?></p>
                <p><b>Resultado presupuestario nacional 2018: </b><?php echo $ccaa2018nac->getCCAAPib();?></p>
                <p><b>Deuda viva sobre ingresos corrientes 2021 trimestre n : </b><?php echo $ccaa2021Mes3->getDeudaVivaIngrCor();?></p>
                <p><b>Deuda viva sobre ingresos corrientes 2020 trimestre n : </b><?php echo $ccaa2020Mes3->getDeudaVivaIngrCor();?></p>
                <p><b>Deuda viva sobre ingresos corrientes 2019 trimestre n : </b><?php echo $ccaa2019Mes3->getDeudaVivaIngrCor();?></p>
                <p><b>Deuda viva nacional sobre ingresos corrientes 2021 trimestre n : </b><?php echo $ccaa2021nacMes3->getDeudaVivaIngrCor();?></p>
                <p><b>Deuda viva nacional sobre ingresos corrientes 2020 trimestre n : </b><?php echo $ccaa2020nacMes3->getDeudaVivaIngrCor();?></p>
                <p><b>Deuda viva nacional sobre ingresos corrientes 2019 trimestre n : </b><?php echo $ccaa2019nacMes3->getDeudaVivaIngrCor();?></p>
                <br><br>
                <p></p>
                <h3>Ingresos (en €)</h3>
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>LIQUIDACIÓN derechos reconocidas</th>
                        </tr>
                        <tr>
                            <th>INGRESOS</th>
                            <th>2018</th>
                            <th>2019</th>
                            <th>2020</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>1. Impuestos Directos</th>
                            <th><?php echo number_format($ccaa2018->getImpuestosDirectos1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getImpuestosDirectos1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getImpuestosDirectos1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <th>2. Impuestos Indirectos</th>
                            <th><?php echo number_format($ccaa2018->getImpuestosIndirectos1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getImpuestosIndirectos1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getImpuestosIndirectos1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <th>3. Tasas, Precios, Públicos y Otros Ingresos</th>
                            <th><?php echo number_format($ccaa2018->getTasasPreciosOtros1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getTasasPreciosOtros1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getTasasPreciosOtros1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <th>4. Transferencias Corrientes</th>
                            <th><?php echo number_format($ccaa2018->getTransferenciasCorrientes1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getTransferenciasCorrientes1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getTransferenciasCorrientes1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <th>5. Ingresos patrimoniales</th>
                            <th><?php echo number_format($ccaa2018->getIngresosPatrimoniales1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getIngresosPatrimoniales1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getIngresosPatrimoniales1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <th>Total ingresos corrientes</th>
                            <th><?php echo number_format($ccaa2018->getTotalIngresosCorrientes1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getTotalIngresosCorrientes1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getTotalIngresosCorrientes1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <th>6. Enajenación de Inversiones Reales</th>
                            <th><?php echo number_format($ccaa2018->getEnajenacionInversionesReales1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getEnajenacionInversionesReales1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getEnajenacionInversionesReales1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <th>7. Transferencias de Capital</th>
                            <th><?php echo number_format($ccaa2018->getTransferenciasCapital1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getTransferenciasCapital1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getTransferenciasCapital1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <th>Ingresos No financieros</th>
                            <th><?php echo number_format($ccaa2018->getTotalIngresosNoCorrientes1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getTotalIngresosNoCorrientes1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getTotalIngresosNoCorrientes1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <th>8. Activos Financieros</th>
                            <th><?php echo number_format($ccaa2018->getActivosFinancieros1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getActivosFinancieros1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getActivosFinancieros1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <th>9. Pasivos Financieros</th>
                            <th><?php echo number_format($ccaa2018->getPasivosFinancieros1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getPasivosFinancieros1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getPasivosFinancieros1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <th>TOTAL INGRESOS</th>
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
                            <th>LIQUIDACIÓN obligaciones reconocidas</th>
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
                            <th>1. Gastos del Personal</th>
                            <th><?php echo number_format($ccaa2018->getGastosPersonal1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getGastosPersonal1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getGastosPersonal1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <th>2. Gastos Corrientes en Bienes y Servicios</th>
                            <th><?php echo number_format($ccaa2018->getGastosCorrientesBienesServicios1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getGastosCorrientesBienesServicios1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getGastosCorrientesBienesServicios1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <th>3. Gastos Financieros</th>
                            <th><?php echo number_format($ccaa2018->getGastosFinancieros1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getGastosFinancieros1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getGastosFinancieros1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <th>4. Transferencias Corrientes</th>
                            <th><?php echo number_format($ccaa2018->getTransferenciasCorrientesGastos1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getTransferenciasCorrientesGastos1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getTransferenciasCorrientesGastos1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <th>5. Fondo de contingencia</th>
                            <th><?php echo number_format($ccaa2018->getFondoContingencia1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getFondoContingencia1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getFondoContingencia1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <th>Total gastos corrientes</th>
                            <th><?php echo number_format($ccaa2018->getTotalGastosCorrientes1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getTotalGastosCorrientes1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getTotalGastosCorrientes1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <th>6. Inversiones Reales</th>
                            <th><?php echo number_format($ccaa2018->getInversionesReales1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getInversionesReales1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getInversionesReales1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <th>7. Transferencias de capital</th>
                            <th><?php echo number_format($ccaa2018->getTransferenciasCapitalGastos1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getTransferenciasCapitalGastos1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getTransferenciasCapitalGastos1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <th>Gastos No financieros</th>
                            <th><?php echo number_format($ccaa2018->getTotalGastosNoFinancieros1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getTotalGastosNoFinancieros1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getTotalGastosNoFinancieros1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <th>8. Activos Financieros</th>
                            <th><?php echo number_format($ccaa2018->getActivosFinancieros1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getActivosFinancieros1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getActivosFinancierosGastos1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <th>9. Pasivos Financieros</th>
                            <th><?php echo number_format($ccaa2018->getPasivosFinancierosGastos1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getPasivosFinancierosGastos1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getPasivosFinancierosGastos1(), 2, ',','.');?></th>
                        </tr>
                        <tr>
                            <th>TOTAL GASTOS</th>
                            <th><?php echo number_format($ccaa2018->getTotalGastos1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2019->getTotalGastos1(), 2, ',','.');?></th>
                            <th><?php echo number_format($ccaa2020->getTotalGastos1(), 2, ',','.');?></th>
                        </tr>
                    </tbody>
                </table>
                <br><br>
                <h3>Solvencia</h3>
                <!--METER LOS GRAFICOS AQUI-->
                <p><B>Sostenibilidad financiera año 2020: </b><?php echo $ccaa2020->getRSosteFinanciera();?></p>
                <p><B>Sostenibilidad financiera año 2019: </b><?php echo $ccaa2019->getRSosteFinanciera();?></p>
                <p><B>Sostenibilidad financiera año 2018: </b><?php echo $ccaa2018->getRSosteFinanciera();?></p>
                <br>
                <p><B>Apalancamiento operativo año 2020: </b><?php echo $ccaa2020->getRRigidez();?></p>
                <p><B>Apalancamiento operativo año 2019: </b><?php echo $ccaa2019->getRRigidez();?></p>
                <p><B>Apalancamiento operativo año 2018: </b><?php echo $ccaa2018->getRRigidez();?></p>
                <br>
                <p><B>Sostenibilidad de la deuda año 2020: </b><?php echo $ccaa2020->getRSosteEndeuda();?></p>
                <p><B>Sostenibilidad de la deuda año 2019: </b><?php echo $ccaa2019->getRSosteEndeuda();?></p>
                <p><B>Sostenibilidad de la deuda año 2018: </b><?php echo $ccaa2018->getRSosteEndeuda();?></p>
                
                <!-- GRAFICAS-->
                <?php
                $datos = array($ccaa2018->getRSosteFinanciera()*100,$ccaa2019->getRSosteFinanciera()*100,$ccaa2020->getRSosteFinanciera()*100);
                $etiquetas = array(2018,2019,2020);
                $datosApalancamiento = array($ccaa2018->getRRigidez()*100, $ccaa2019->getRRigidez()*100,$ccaa2020->getRRigidez()*100);
                ?>
                <script>
                    var datos = <?php echo json_encode($datos)?>;
                    var etiquetas = <?php echo json_encode($etiquetas)?>;
                    var datosA = <?php echo json_encode($datosApalancamiento)?>;
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
                            labels: etiquetas,
                            datasets: [{
                                label: 'Apalancamiento operativo',
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
                <p><b>PMP 2020: </b><?php echo $ccaa2020Mes5->getPMP();?></p>
                <p><b>PMP 2019: </b><?php echo $ccaa2019Mes5->getPMP();?></p>
                <p><b>PMP media 2020: </b><?php echo $ccaa2020nacMes5->getPMP();?></p>
                <p><b>PMP media 2019: </b><?php echo $ccaa2019nacMes5->getPMP();?></p>
                <br><br>
                <h3>Eficiencia</h3>
                <p><b>Eficiencia 2020: </b><?php echo $ccaa2020->getREfic();?></p>
                <p><b>Eficiencia 2019: </b><?php echo $ccaa2019->getREfic();?></p>
                <p><b>Eficiencia 2018: </b><?php echo $ccaa2018->getREfic();?></p>
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