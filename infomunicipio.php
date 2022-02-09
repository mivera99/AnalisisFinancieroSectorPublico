<?php
session_start();
require_once('includesWeb/daos/DAOConsultor.php');

$nombre = htmlspecialchars(trim(strip_tags($_GET["mun"])));

$daomun = new DAOConsultor();
$municipio = $daomun->getMunicipio($nombre);


$mun2018 = $daomun->getEconomiaMUN(new Municipio(), $municipio->getCodigo(), 2018);
$mun2019 = $daomun->getEconomiaMUN(new Municipio(), $municipio->getCodigo(), 2019);
$mun2020 = $daomun->getEconomiaMUN(new Municipio(), $municipio->getCodigo(), 2020);

$encontrado = false;
if($municipio){
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

    <title>Análisis Financiero del Sector Público - Municipio</title>
</head>
    <body>

        <div id = "cabecera">
            <?php require("includesWeb/comun/cabecera.php");?>  
        </div>

        <div id ="contenido"> 
            <h3>Municipio</h3>
            <?php
            if($encontrado){
                echo '<h2>'.$municipio->getNombre().'</h2>';
                echo '<button class="scoring '. $municipio->getScoring() . '">'. $municipio->getScoring() .'</button>';

                echo '<br><br>';
                echo '<h3>Información general</h3>';
                echo '<p><b>Provincia:  </b>'.$municipio->getProvincia().'</p>';
                echo '<p><b>Autonomía:  </b>'.$municipio->getAutonomia().'</p>';
                echo '<p><b>Alcalde del municipio:  </b>'.$municipio->getNombreAlcalde().' '.$municipio->getApellido1().' '.$municipio->getApellido1().'</p>';
                echo '<p><b>Vigencia:  </b>'.$municipio->getVigencia().'</p>';
                echo '<p><b>Partido político: </b>'.$municipio->getPartido().'</p>';
                echo '<p><b>CIF:  </b>'.$municipio->getCif().'</p>';
                echo '<p><b>Via:  </b>'.$municipio->getTipoVia().' '.$municipio->getNombreVia().' '.$municipio->getNumVia().'</p>';
                echo '<p><b>Teléfono:  </b>'.$municipio->getTelefono().'</p>';
                echo '<p><b>Código Postal:  </b>'.$municipio->getCodigoPostal().'</p>';
                echo '<p><b>Fax:  </b>'.$municipio->getFax().'</p>';
                echo '<p><b>Sitio web:  </b>'.$municipio->getWeb().'</p>';
                echo '<p><b>Correo electrónico:  </b>'.$municipio->getMail().'</p>';
            ?>
            <br><br>
            <h3>Ingresos (en €)</h3>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th colspan="3" style="height:40px">LIQUIDACIÓN derechos reconocidas</th>
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
                        <td style="width:14%"><?php echo number_format($mun2018->getImpuestosDirectos1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2019->getImpuestosDirectos1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getImpuestosDirectos1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <td>2. Impuestos Indirectos</td>
                        <td style="width:14%"><?php echo number_format($mun2018->getImpuestosIndirectos1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2019->getImpuestosIndirectos1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getImpuestosIndirectos1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <td>3. Tasas, Precios Públicos y Otros Ingresos</td>
                        <td style="width:14%"><?php echo number_format($mun2018->getTasasPreciosOtros1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2019->getTasasPreciosOtros1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getTasasPreciosOtros1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <td>4. Transferencias Corrientes</td>
                        <td style="width:14%"><?php echo number_format($mun2018->getTransferenciasCorrientes1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2019->getTransferenciasCorrientes1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getTransferenciasCorrientes1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <td>5. Ingresos Patrimoniales</td>
                        <td style="width:14%"><?php echo number_format($mun2018->getIngresosPatrimoniales1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2019->getIngresosPatrimoniales1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getIngresosPatrimoniales1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <th style="height:40px">Total Ingresos Corrientes</th>
                        <th><?php echo number_format($mun2018->getTotalIngresosCorrientes1(), 2, ',','.');?></th>
                        <th><?php echo number_format($mun2019->getTotalIngresosCorrientes1(), 2, ',','.');?></th>
                        <th><?php echo number_format($mun2020->getTotalIngresosCorrientes1(), 2, ',','.');?></th>
                    </tr>
                    <tr>
                        <td>6. Enajenación de Inversiones Reales</td>
                        <td style="width:14%"><?php echo number_format($mun2018->getEnajenacionInversionesReales1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2019->getEnajenacionInversionesReales1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getEnajenacionInversionesReales1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <td>7. Transferencias de Capital</td>
                        <td style="width:14%"><?php echo number_format($mun2018->getTransferenciasCapital1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2019->getTransferenciasCapital1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getTransferenciasCapital1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <th style="height:40px">Ingresos No Financieros</th>
                        <th><?php echo number_format($mun2018->getTotalIngresosNoCorrientes1(), 2, ',','.');?></th>
                        <th><?php echo number_format($mun2019->getTotalIngresosNoCorrientes1(), 2, ',','.');?></th>
                        <th><?php echo number_format($mun2020->getTotalIngresosNoCorrientes1(), 2, ',','.');?></th>
                    </tr>
                    <tr>
                        <td>8. Activos Financieros</td>
                        <td style="width:14%"><?php echo number_format($mun2018->getActivosFinancieros1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2019->getActivosFinancieros1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getActivosFinancieros1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <td>9. Pasivos Financieros</td>
                        <td style="width:14%"><?php echo number_format($mun2018->getPasivosFinancieros1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2019->getPasivosFinancieros1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getPasivosFinancieros1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <th style="height:40px">TOTAL INGRESOS</th>
                        <th><?php echo number_format($mun2018->getTotalIngresos1(), 2, ',','.');?></th>
                        <th><?php echo number_format($mun2019->getTotalIngresos1(), 2, ',','.');?></th>
                        <th><?php echo number_format($mun2020->getTotalIngresos1(), 2, ',','.');?></th>
                    </tr>
                </tbody>
                
            </table>
            <br><br>
            <h3>Gastos (en €)</h3>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th colspan="3" style="height:40px">LIQUIDACIÓN obligaciones reconocidas</th>
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
                        <td style="width:14%"><?php echo number_format($mun2018->getGastosPersonal1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2019->getGastosPersonal1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getGastosPersonal1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <td>2. Gastos Corrientes en Bienes y Servicios</td>
                        <td style="width:14%"><?php echo number_format($mun2018->getGastosCorrientesBienesServicios1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2019->getGastosCorrientesBienesServicios1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getGastosCorrientesBienesServicios1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <td>3. Gastos Financieros</td>
                        <td style="width:14%"><?php echo number_format($mun2018->getGastosFinancieros1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2019->getGastosFinancieros1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getGastosFinancieros1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <td>4. Transferencias Corrientes</td>
                        <td style="width:14%"><?php echo number_format($mun2018->getTransferenciasCorrientesGastos1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2019->getTransferenciasCorrientesGastos1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getTransferenciasCorrientesGastos1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <td>5. Fondo de contingencia</td>
                        <td style="width:14%"><?php echo number_format($mun2018->getFondoContingencia1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2019->getFondoContingencia1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getFondoContingencia1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <th style="height:40px">Total gastos corrientes</th>
                        <th><?php echo number_format($mun2018->getTotalGastosCorrientes1(), 2, ',','.');?></th>
                        <th><?php echo number_format($mun2019->getTotalGastosCorrientes1(), 2, ',','.');?></th>
                        <th><?php echo number_format($mun2020->getTotalGastosCorrientes1(), 2, ',','.');?></th>
                    </tr>
                    <tr>
                        <td>6. Inversiones Reales</td>
                        <td style="width:14%"><?php echo number_format($mun2018->getInversionesReales1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2019->getInversionesReales1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getInversionesReales1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <td>7. Transferencias de capital</td>
                        <td style="width:14%"><?php echo number_format($mun2018->getTransferenciasCapitalGastos1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2019->getTransferenciasCapitalGastos1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getTransferenciasCapitalGastos1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <th style="height:40px">Gastos No financieros</th>
                        <th><?php echo number_format($mun2018->getTotalGastosNoFinancieros1(), 2, ',','.');?></th>
                        <th><?php echo number_format($mun2019->getTotalGastosNoFinancieros1(), 2, ',','.');?></th>
                        <th><?php echo number_format($mun2020->getTotalGastosNoFinancieros1(), 2, ',','.');?></th>
                    </tr>
                    <tr>
                        <td>8. Activos Financieros</td>
                        <td style="width:14%"><?php echo number_format($mun2018->getActivosFinancieros1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2019->getActivosFinancieros1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getActivosFinancierosGastos1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <td>9. Pasivos Financieros</td>
                        <td style="width:14%"><?php echo number_format($mun2018->getPasivosFinancierosGastos1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2019->getPasivosFinancierosGastos1(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getPasivosFinancierosGastos1(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <th style="height:40px">TOTAL GASTOS</th>
                        <th><?php echo number_format($mun2018->getTotalGastos1(), 2, ',','.');?></th>
                        <th><?php echo number_format($mun2019->getTotalGastos1(), 2, ',','.');?></th>
                        <th><?php echo number_format($mun2020->getTotalGastos1(), 2, ',','.');?></th>
                    </tr>
                </tbody>
            </table>
            <br><br>
            <h3>Endeudamiento (en €)</h3>
            <br>
            <p><b>Deuda Financiera 2020: </b><?php echo number_format($mun2020->getDeudaFinanciera(), 2, ',','.');?></p>
            <p><b>Deuda Financiera 2019: </b><?php echo number_format($mun2019->getDeudaFinanciera(), 2, ',','.');?></p>
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
                        <th>Endeudamiento</th>
                        <td style="width:14%"><?php echo number_format($mun2019->getEndeudamiento(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getEndeudamiento(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <th>Endeudamiento Media Diputaciones</th>
                        <td style="width:14%"><?php echo number_format($mun2019->getEndeudamientoMediaDiputaciones(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getEndeudamientoMediaDiputaciones(), 2, ',','.');?></td>
                    </tr>
                </tbody>
            </table>
            <br><br>
            <h3>Solvencia (en €)</h3>
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
                        <th>Sostenibilidad Financiera</th>
                        <td style="width:14%"><?php echo number_format($mun2019->getSostenibilidadFinanciera(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getSostenibilidadFinanciera(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <th>Sostenibilidad Financiera Media Diputaciones</th>
                        <td style="width:14%"><?php echo number_format($mun2019->getSostenibilidadFinancieraMediaDiputaciones(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getSostenibilidadFinancieraMediaDiputaciones(), 2, ',','.');?></td>
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
                        <th>Apalancamiento Operativo</th>
                        <td style="width:14%"><?php echo number_format($mun2019->getApalancamientoOperativo(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getApalancamientoOperativo(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <th>Apalancamiento Operativo Media Diputaciones</th>
                        <td style="width:14%"><?php echo number_format($mun2019->getApalancamientoOperativoMediaDiputaciones(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getApalancamientoOperativoMediaDiputaciones(), 2, ',','.');?></td>
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
                        <th>Sostenibilidad de la Deuda</th>
                        <td style="width:14%"><?php echo number_format($mun2019->getSostenibilidadDeuda(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getSostenibilidadDeuda(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <th>Sostenibilidad de la Deuda Media Diputaciones</th>
                        <td style="width:14%"><?php echo number_format($mun2019->getSostenibilidadDeudaMediaDiputaciones(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getSostenibilidadDeudaMediaDiputaciones(), 2, ',','.');?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <br>

            <!-- TO DO -->
            <h3>Liquidez (en €)</h3>
            <br>
            <p><b>Fondos líquidos 2020: </b><?php echo number_format($mun2019->getFondosLiquidos(), 2, ',','.');?></p>
            <p><b>Fondos líquidos 2019: </b><?php echo number_format($mun2020->getFondosLiquidos(), 2, ',','.');?></p>
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
                        <th>Remanente de Tesorería Gastos Generales</th>
                        <td style="width:14%"><?php echo number_format($mun2019->getRemanenteTesoreriaGastosGenerales(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getRemanenteTesoreriaGastosGenerales(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <th>Remanente de Tesorería Gastos Generales Media Diputaciones</th>
                        <td style="width:14%"><?php echo number_format($mun2019->getRemanenteTesoreriaGastosGeneralesMediaDiputaciones(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getRemanenteTesoreriaGastosGeneralesMediaDiputaciones(), 2, ',','.');?></td>
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
                        <th>Liquidez Inmediata</th>
                        <td style="width:14%"><?php echo number_format($mun2019->getLiquidezInmediata(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getLiquidezInmediata(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <th>Solvencia Corto Plazo Media Diputaciones</th>
                        <td style="width:14%"><?php echo number_format($mun2019->getSolvenciaCortoPlazoMediaDiputaciones(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getSolvenciaCortoPlazoMediaDiputaciones(), 2, ',','.');?></td>
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
                        <th>Solvencia Corto Plazo</th>
                        <td style="width:14%"><?php echo number_format($mun2019->getSolvenciaCortoPlazo(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getSolvenciaCortoPlazo(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <th>Solvencia Corto Plazo Media Diputaciones</th>
                        <td style="width:14%"><?php echo number_format($mun2019->getSolvenciaCortoPlazoMediaDiputaciones2(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getSolvenciaCortoPlazoMediaDiputaciones2(), 2, ',','.');?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <br>

            <!-- TO DO -->
            <h3>Eficiencia (en €)</h3>
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
                        <th>Eficiencia</th>
                        <td style="width:14%"><?php echo number_format($mun2019->getEficiencia(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getEficiencia(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <th>Eficiencia Media Diputaciones</th>
                        <td style="width:14%"><?php echo number_format($mun2019->getEficienciaMediaDiputaciones(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getEficienciaMediaDiputaciones(), 2, ',','.');?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <br>


            <!-- TO DO -->
            <h3>Gestión Presupuestaria (en €)</h3>
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
                        <th>Ejecución Ingresos corrientes</th>
                        <td style="width:14%"><?php echo number_format($mun2019->getEjecucionIngresosCorrientes(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getEjecucionIngresosCorrientes(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <th>Ejecución Ingresos Corrientes Media Diputaciones</th>
                        <td style="width:14%"><?php echo number_format($mun2019->getEjecucionIngresosCorrientesMediaDiputaciones(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getEjecucionIngresosCorrientesMediaDiputaciones(), 2, ',','.');?></td>
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
                        <th>Ejecución Gastos corrientes</th>
                        <td style="width:14%"><?php echo number_format($mun2019->getEjecucionGastosCorrientes(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getEjecucionGastosCorrientes(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <th>Ejecución Gastos Corrientes Media Diputaciones</th>
                        <td style="width:14%"><?php echo number_format($mun2019->getEjecucionGastosCorrientesMediaDiputaciones(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getEjecucionGastosCorrientesMediaDiputaciones(), 2, ',','.');?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <br>

            <!-- TO DO -->
            <h3>Cumplimiento de Pagos (en €)</h3>
            <br>
            <p><b>Deuda Comercial 2020: </b><?php echo number_format($mun2019->getDeudaComercial(), 2, ',','.');?></p>
            <p><b>Deuda Comercial 2019: </b><?php echo number_format($mun2020->getDeudaComercial(), 2, ',','.');?></p>
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
                        <th>Periodo Medio de Pagos</th>
                        <td style="width:14%"><?php echo number_format($mun2019->getPeriodoMedioPagos(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getPeriodoMedioPagos(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <th>Periodo Medio de Pagos Media Diputaciones</th>
                        <td style="width:14%"><?php echo number_format($mun2019->getPeriodoMedioPagosMediaDiputaciones(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getPeriodoMedioPagosMediaDiputaciones(), 2, ',','.');?></td>
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
                        <th>Pagos sobre Obligaciones Reconocidas</th>
                        <td style="width:14%"><?php echo number_format($mun2019->getPagosSobreObligacionesReconocidas(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getPagosSobreObligacionesReconocidas(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <th>Pagos sobre Obligaciones Reconocidas Media Diputaciones</th>
                        <td style="width:14%"><?php echo number_format($mun2019->getPagosSobreObligacionesReconocidasMediaDiputaciones(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getPagosSobreObligacionesReconocidasMediaDiputaciones(), 2, ',','.');?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <br>

            <!-- TO DO -->
            <h3>Gestión Tributaria (en €)</h3>
            <br>
            <p><b>Derechos Pendientes de Cobro 2020: </b><?php echo number_format($mun2019->getDerechosPendientesCobro(), 2, ',','.');?></p>
            <p><b>Derechos Pendientes de Cobro 2019: </b><?php echo number_format($mun2020->getDerechosPendientesCobro(), 2, ',','.');?></p>
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
                        <th>Eficacia Recaudatoria</th>
                        <td style="width:14%"><?php echo number_format($mun2019->getEficaciaRecaudatoria(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getEficaciaRecaudatoria(), 2, ',','.');?></td>
                    </tr>
                    <tr>
                        <th>Eficacia Recaudatoria Media Diputaciones</th>
                        <td style="width:14%"><?php echo number_format($mun2019->getEficaciaRecaudatoriaMediaDiputaciones(), 2, ',','.');?></td>
                        <td style="width:14%"><?php echo number_format($mun2020->getEficaciaRecaudatoriaMediaDiputaciones(), 2, ',','.');?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <br>
            

            <?php
            }
            else {
                echo '<p>Municipio no encontrado</p>';
            }
            ?>
            
        </div>

        <div id = "pie">
            <?php require("includesWeb/comun/pie.php");?>
        </div>

    </body>
</html>