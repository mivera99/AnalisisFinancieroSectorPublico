<?php
session_start();
require_once('includesWeb\daos\DAOConsultor.php');

$nombre = htmlspecialchars(trim(strip_tags($_GET["mun"])));
$municipio = (new DAOConsultor())->getMunicipio($nombre);
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
                echo '<p><b>Alcalde del municipio:  </b>'.$municipio->getNombreAlcalde().' '.$municipio->getApellido1().' '.$municipio->getApellido2().'</p>';
                echo '<p><b>Vigencia:  </b>'.$municipio->getVigencia().'</p>';
                echo '<p><b>Partido político: </b>'.$municipio->getPartido().'</p>';
                echo '<p><b>CIF:  </b>'.$municipio->getCif().'</p>';
                echo '<p><b>Via:  </b>'.$municipio->getTipoVia().' '.$municipio->getNombreVia().' '.$municipio->getNumVia().'</p>';
                echo '<p><b>Teléfono:  </b>'.$municipio->getTelefono().'</p>';
                echo '<p><b>Código Postal:  </b>'.$municipio->getCodigoPostal().'</p>';
                echo '<p><b>Fax:  </b>'.$municipio->getFax().'</p>';
                echo '<p><b>Sitio web:  </b>'.$municipio->getWeb().'</p>';
                echo '<p><b>Correo electrónico:  </b>'.$municipio->getMail().'</p>';

                echo '<br><br>';
                echo '<h3>Ingresos</h3>';
                echo '<br>';
                echo '<table>';
                echo '
                <tr>
                    <th>Ingresos</th>
                    <th>2018</th>
                    <th>2019</th>
                    <th>2020</th>
                </tr>
                ';
                echo '
                <tr>
                    <td>Impuestos Directos</td>
                    <td>' . $municipio->getImpuestosDirectos3() . '</td>
                    <td>' . $municipio->getImpuestosDirectos2() . '</td>
                    <td>' . $municipio->getImpuestosDirectos1() . '</td>
                </tr>
                ';
                echo '
                <tr>
                    <td>Impuestos Indirectos</td>
                    <td>' . $municipio->getImpuestosIndirectos3() . '</td>
                    <td>' . $municipio->getImpuestosIndirectos2() . '</td>
                    <td>' . $municipio->getImpuestosIndirectos1() . '</td>
                </tr>
                ';
                echo '
                <tr>
                    <td>Tasas, Precios Públicos y Otros Ingresos</td>
                    <td>' . $municipio->getTasasPreciosOtros3() . '</td>
                    <td>' . $municipio->getTasasPreciosOtros2() . '</td>
                    <td>' . $municipio->getTasasPreciosOtros1() . '</td>
                </tr>
                ';
                echo '
                <tr>
                    <td>Transferencias Corrientes</td>
                    <td>' . $municipio->getTransferenciasCorrientes3() . '</td>
                    <td>' . $municipio->getTransferenciasCorrientes2() . '</td>
                    <td>' . $municipio->getTransferenciasCorrientes1() . '</td>
                </tr>
                ';
                echo '
                <tr>
                    <td>Ingresos Patrimoniales</td>
                    <td>' . $municipio->getIngresosPatrimoniales3() . '</td>
                    <td>' . $municipio->getIngresosPatrimoniales2() . '</td>
                    <td>' . $municipio->getIngresosPatrimoniales1() . '</td>
                </tr>
                ';
                echo '
                <tr>
                    <th>Total Ingresos Corrientes</th>
                    <th>' . $municipio->getTotalIngresosCorrientes3() . '</th>
                    <th>' . $municipio->getTotalIngresosCorrientes2() . '</th>
                    <th>' . $municipio->getTotalIngresosCorrientes1() . '</th>
                </tr>
                ';
                echo '
                <tr>
                    <td>Enajenación de Inversiones Reales</td>
                    <td>' . $municipio->getEnajenacionInversionesReales3() . '</td>
                    <td>' . $municipio->getEnajenacionInversionesReales2() . '</td>
                    <td>' . $municipio->getEnajenacionInversionesReales1() . '</td>
                </tr>
                ';
                echo '
                <tr>
                    <td>Transferencias de Capital</td>
                    <td>' . $municipio->getTransferenciasCapital3() . '</td>
                    <td>' . $municipio->getTransferenciasCapital2() . '</td>
                    <td>' . $municipio->getTransferenciasCapital1() . '</td>
                </tr>
                ';
                echo '
                <tr>
                    <th>Ingresos No Financieros</th>
                    <th>' . $municipio->getTotalIngresosNoCorrientes3() . '</th>
                    <th>' . $municipio->getTotalIngresosNoCorrientes2() . '</th>
                    <th>' . $municipio->getTotalIngresosNoCorrientes1() . '</th>
                </tr>
                ';
                echo '
                <tr>
                    <td>Activos Financieros</td>
                    <td>' . $municipio->getActivosFinancieros3() . '</td>
                    <td>' . $municipio->getActivosFinancieros2() . '</td>
                    <td>' . $municipio->getActivosFinancieros1() . '</td>
                </tr>
                ';
                echo '
                <tr>
                    <td>Pasivos Financieros</td>
                    <td>' . $municipio->getPasivosFinancieros3() . '</td>
                    <td>' . $municipio->getPasivosFinancieros2() . '</td>
                    <td>' . $municipio->getPasivosFinancieros1() . '</td>
                </tr>
                ';
                echo '
                <tr>
                    <th>TOTAL INGRESOS</th>
                    <th>' . $municipio->getTotalIngresos3() . '</th>
                    <th>' . $municipio->getTotalIngresos2() . '</th>
                    <th>' . $municipio->getTotalIngresos1() . '</th>
                </tr>
                ';
                echo '</table>';
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