<?php
session_start();
require_once('includesWeb/daos/DAOConsultor.php');


if(isset($_COOKIE["mun"]))
    $nombre = $_COOKIE["mun"];

/* RECOGEMOS LOS DATOS DEL MUNICIPIO */

$daomun = new DAOConsultor();
$municipio = $daomun->getMunicipio($nombre);


$mun2018 = $daomun->getEconomiaMUN(new Municipio(), $municipio->getCodigo(), 2018);
$mun2019 = $daomun->getEconomiaMUN(new Municipio(), $municipio->getCodigo(), 2019);
$mun2020 = $daomun->getEconomiaMUN(new Municipio(), $municipio->getCodigo(), 2020);


/* AÑADIMOS LA LIBRERÍA TCPDF */
require_once('includes/tcpdf/tcpdf_import.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Noster Economía');
$pdf->setTitle($nombre . ' (Municipio)');

$pdf->setPrintHeader(false);
//$pdf->setPrintFooter(false);

$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP-25, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM-25);

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

if(@file_exists(dirname(__FILE__) . '/lang/eng.php')){
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

$pdf->setFont('helvetica', '', 10);

$pdf->AddPage();


$html = '
    <span style="text-align:justify;">
    <h1>' . $nombre . '</h1>
';

$quote1 = "";
$quote2 = "";
$quoteNum = 1;

foreach($municipio->getScoring() as $clave => $valor){
    $tend = $municipio->getTendencia();
    $html .='<i><b>Rating ' . $clave . ': ' . $valor . '</b><br>Tendencia: ' . $tend[$clave];

    
    switch($valor){
        case "A":
            switch($tend[$clave]){
                case "Positiva":
                    $infoRating = "La entidad muestra una elevada fortaleza financiera, lo que supone los niveles comparativos más bajos de riesgo, y una evolución positiva en los últimos años.";
                    break;
                case "Estable":
                    $infoRating = "La entidad muestra una elevada fortaleza financiera, lo que supone los niveles comparativos más bajos de riesgo, y una evolución estable en los últimos años.";
                    break;
                case "Negativa":
                    $infoRating = "La entidad muestra una elevada fortaleza financiera, lo que supone los niveles comparativos más bajos de riesgo, a pesar de la evolución negativa de los últimos años.";
                    break;
            }
            break;
        case "B":
            switch($tend[$clave]){
                case "Positiva":
                    $infoRating = "La entidad muestra una situación financiera holgada, con un nivel relativamente bajo de riesgo, y una evolución positiva en los últimos años.";
                    break;
                case "Estable":
                    $infoRating = "La entidad muestra una situación financiera holgada, con un nivel relativamente bajo de riesgo, que se ha comportado de forma estable durante los últimos años.";
                    break;
                case "Negativa":
                    $infoRating = "La entidad muestra una situación financiera holgada, con un nivel relativamente bajo de riesgo, a pesar del empeoramiento de los últimos años.";
                    break;
            }
            break;
        case "C":
            switch($tend[$clave]){
                case "Positiva":
                    $infoRating = "La entidad muestra una situación financiera media lo que supone un nivel medio-alto de riesgo, a pesar de la evolución positiva de los últimos años.";
                    break;
                case "Estable":
                    $infoRating = "La entidad muestra una situación financiera media lo que supone un nivel medio-alto de riesgo, con un comportamiento similar durante los últimos años.";
                    break;
                case "Negativa":
                    $infoRating = "La entidad muestra una situación financiera media lo que supone un nivel medio-alto de riesgo tras una evolución negativa en los últimos años.";
                    break;
            }
            break;
        case "D":
            switch($tend[$clave]){
                case "Positiva":
                    $infoRating = "La entidad muestra una situación financiera complicada lo que supone un nivel alto de riesgo, a pesar de la evolución positiva de los últimos años.";
                    break;
                case "Estable":
                    $infoRating = "La entidad muestra una situación financiera complicada lo que supone un nivel alto de riesgo, con un comportamiento similar durante los últimos años.";
                    break;
                case "Negativa":
                    $infoRating = "La entidad muestra una situación financiera complicada lo que supone un nivel alto de riesgo, tras una evolución negativa en los últimos años.";
                    break;
            }
            break;
        case "E":
            switch($tend[$clave]){
                case "Positiva":
                    $infoRating = "La entidad muestra una situación financiera muy deteriorada lo que supone un nivel muy elevado de riesgo, a pesar de la la evolución positiva de los últimos años.";
                    break;
                case "Estable":
                    $infoRating = "La entidad muestra una situación financiera muy deteriorada lo que supone un nivel muy elevado de riesgo, con un comportamiento similar durante los últimos años.";
                    break;
                case "Negativa":
                    $infoRating = "La entidad muestra una situación financiera muy deteriorada lo que supone un nivel muy elevado de riesgo, y una evolución negativa en los últimos años.";
                    break;
            }
            break;
    }

    if($quoteNum == 1){
        $quote1 = $infoRating;
    }
    else if ($quoteNum == 2){
        $quote2 = $infoRating;
    }

    $html .= '<sup>'.$quoteNum.'</sup></i><br><br>';

    $quoteNum++;
}

$html .= '
    <h3>Información General</h3>
    <b>Provincia:  </b>'.$municipio->getProvincia().'
    <br><b>Autonomía:  </b>'.$municipio->getAutonomia().'
    <br><b>Alcalde del municipio:  </b>'.$municipio->getNombreAlcalde().' '.$municipio->getApellido1().' '.$municipio->getApellido2().'
    <br><b>Vigencia:  </b>'.$municipio->getVigencia().'
    <br><b>Partido político: </b>'.$municipio->getPartido().'
    <br><b>CIF:  </b>'.$municipio->getCif().'
    <br><b>Via:  </b>'.$municipio->getTipoVia().' '.$municipio->getNombreVia().' '.$municipio->getNumVia().'
    <br><b>Teléfono:  </b>'.$municipio->getTelefono().'
    <br><b>Código Postal:  </b>'.$municipio->getCodigoPostal().'
';

if($municipio->getFax() == ''){
    $html .= '<br><b>Fax: </b>N/A ';
}
else{
    $html .= '<br><b>Fax: </b>'.$municipio->getFax().'';
}

if($municipio->getWeb() == ''){
    $html .= '<br><b>Sitio web:  </b>N/A';
}
else{
    $html .= '<br><b>Sitio web:  </b><a href="https://'.$municipio->getWeb().'" target="_blank">'.$municipio->getWeb().'</a>';
}

if($municipio->getMail() == ''){
    $html .= '<br><b>Correo electrónico: </b>N/A';
}
else{
    $html .= '<br><b>Correo electrónico: </b>'.$municipio->getMail();
}

//Ingresos

$html .= '
    <br><br>
    <h3>Ingresos (en €)</h3><span style="text-align:left"><table cellspacing="0" cellpadding="5" border="1">
        <thead>
            <tr>
                <th style="width:300"></th>
                <th colspan="3" style="height:30" style="width:330"><b>Liquidación derechos reconocidos</b></th>
            </tr>
            <tr>
                <th style="width:300"><b>Ingresos</b></th>
                <th style="width:110"><b>2018</b></th>
                <th style="width:110"><b>2019</b></th>
                <th style="width:110"><b>2020</b></th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td style="width:300">1. Impuestos Directos</td>
                <td style="width:110">' . number_format($mun2018->getImpuestosDirectos1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2019->getImpuestosDirectos1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2020->getImpuestosDirectos1(), 2, ",",".") . '</td>
            </tr>
            <tr>
                <td style="width:300">2. Impuestos Indirectos</td>
                <td style="width:110">' . number_format($mun2018->getImpuestosIndirectos1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2019->getImpuestosIndirectos1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2020->getImpuestosIndirectos1(), 2, ",",".") . '</td>
            </tr>
            <tr>
                <td style="width:300">3. Tasas, Precios Públicos y Otros Ingresos</td>
                <td style="width:110">' . number_format($mun2018->getTasasPreciosOtros1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2019->getTasasPreciosOtros1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2020->getTasasPreciosOtros1(), 2, ",",".") . '</td>
            </tr>
            <tr>
                <td style="width:300">4. Transferencias Corrientes</td>
                <td style="width:110">' . number_format($mun2018->getTransferenciasCorrientes1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2019->getTransferenciasCorrientes1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2020->getTransferenciasCorrientes1(), 2, ",",".") . '</td>
            </tr>
            <tr>
                <td style="width:300">5. Ingresos Patrimoniales</td>
                <td style="width:110">' . number_format($mun2018->getIngresosPatrimoniales1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2019->getIngresosPatrimoniales1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2020->getIngresosPatrimoniales1(), 2, ",",".") . '</td>
            </tr>
            <tr>
                <th style="width:300"><b>Total Ingresos Corrientes</b></th>
                <th style="width:110">' . number_format($mun2018->getTotalIngresosCorrientes1(), 2, ",",".") . '</th>
                <th style="width:110">' . number_format($mun2019->getTotalIngresosCorrientes1(), 2, ",",".") . '</th>
                <th style="width:110">' . number_format($mun2020->getTotalIngresosCorrientes1(), 2, ",",".") . '</th>
            </tr>
            <tr>
                <td style="width:300">6. Enajenación de Inversiones Reales</td>
                <td style="width:110">' . number_format($mun2018->getEnajenacionInversionesReales1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2019->getEnajenacionInversionesReales1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2020->getEnajenacionInversionesReales1(), 2, ",",".") . '</td>
            </tr>
            <tr>
                <td style="width:300">7. Transferencias de Capital</td>
                <td style="width:110">' . number_format($mun2018->getTransferenciasCapital1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2019->getTransferenciasCapital1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2020->getTransferenciasCapital1(), 2, ",",".") . '</td>
            </tr>
            <tr>
                <th style="width:300"><b>Ingresos No Financieros</b></th>
                <th style="width:110">' . number_format($mun2018->getTotalIngresosNoCorrientes1(), 2, ",",".") . '</th>
                <th style="width:110">' . number_format($mun2019->getTotalIngresosNoCorrientes1(), 2, ",",".") . '</th>
                <th style="width:110">' . number_format($mun2020->getTotalIngresosNoCorrientes1(), 2, ",",".") . '</th>
            </tr>
            <tr>
                <td style="width:300">8. Activos Financieros</td>
                <td style="width:110">' . number_format($mun2018->getActivosFinancieros1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2019->getActivosFinancieros1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2020->getActivosFinancieros1(), 2, ",",".") . '</td>
            </tr>
            <tr>
                <td style="width:300">9. Pasivos Financieros</td>
                <td style="width:110">' . number_format($mun2018->getPasivosFinancieros1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2019->getPasivosFinancieros1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2020->getPasivosFinancieros1(), 2, ",",".") . '</td>
            </tr>
            <tr>
                <th style="width:300"><b>TOTAL INGRESOS</b></th>
                <th style="width:110">' . number_format($mun2018->getTotalIngresos1(), 2, ",",".") . '</th>
                <th style="width:110">' . number_format($mun2019->getTotalIngresos1(), 2, ",",".") . '</th>
                <th style="width:110">' . number_format($mun2020->getTotalIngresos1(), 2, ",",".") . '</th>
            </tr>
        </tbody>
        
    </table>
    </span>


';

$html .= '
    </span>
';

$pdf->writeHTML($html, true, false, false, false, 'C');


/* PÁGINA 2 */

$pdf->AddPage();

//Gastos

$html = '
    <br><br>
    <span style="text-align:justify;">
    <h3>Gastos (en €)</h3><span style="text-align:left"><table cellspacing="0" cellpadding="5" border="1">
        <thead>
            <tr>
                <th style="width:300"></th>
                <th colspan="3" style="width:330"><b>Liquidación obligaciones reconocidas</b></th>
            </tr>
            <tr>
                <th style="width:300"><b>Gastos</b></th>
                <th style="width:110"><b>2018</b></th>
                <th style="width:110"><b>2019</b></th>
                <th style="width:110"><b>2020</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width:300">1. Gastos del Personal</td>
                <td style="width:110">' . number_format($mun2018->getGastosPersonal1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2019->getGastosPersonal1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2020->getGastosPersonal1(), 2, ",",".") . '</td>
            </tr>
            <tr>
                <td style="width:300">2. Gastos Corrientes en Bienes y Servicios</td>
                <td style="width:110">' . number_format($mun2018->getGastosCorrientesBienesServicios1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2019->getGastosCorrientesBienesServicios1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2020->getGastosCorrientesBienesServicios1(), 2, ",",".") . '</td>
            </tr>
            <tr>
                <td style="width:300">3. Gastos Financieros</td>
                <td style="width:110">' . number_format($mun2018->getGastosFinancieros1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2019->getGastosFinancieros1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2020->getGastosFinancieros1(), 2, ",",".") . '</td>
            </tr>
            <tr>
                <td style="width:300">4. Transferencias Corrientes</td>
                <td style="width:110">' . number_format($mun2018->getTransferenciasCorrientesGastos1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2019->getTransferenciasCorrientesGastos1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2020->getTransferenciasCorrientesGastos1(), 2, ",",".") . '</td>
            </tr>
            <tr>
                <td style="width:300">5. Fondo de contingencia</td>
                <td style="width:110">' . number_format($mun2018->getFondoContingencia1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2019->getFondoContingencia1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2020->getFondoContingencia1(), 2, ",",".") . '</td>
            </tr>
            <tr>
                <th style="width:300"><b>Total gastos corrientes</b></th>
                <th style="width:110">' . number_format($mun2018->getTotalGastosCorrientes1(), 2, ",",".") . '</th>
                <th style="width:110">' . number_format($mun2019->getTotalGastosCorrientes1(), 2, ",",".") . '</th>
                <th style="width:110">' . number_format($mun2020->getTotalGastosCorrientes1(), 2, ",",".") . '</th>
            </tr>
            <tr>
                <td style="width:300">6. Inversiones Reales</td>
                <td style="width:110">' . number_format($mun2018->getInversionesReales1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2019->getInversionesReales1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2020->getInversionesReales1(), 2, ",",".") . '</td>
            </tr>
            <tr>
                <td style="width:300">7. Transferencias de capital</td>
                <td style="width:110">' . number_format($mun2018->getTransferenciasCapitalGastos1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2019->getTransferenciasCapitalGastos1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2020->getTransferenciasCapitalGastos1(), 2, ",",".") . '</td>
            </tr>
            <tr>
                <th style="width:300"><b>Gastos No financieros</b></th>
                <th style="width:110">' . number_format($mun2018->getTotalGastosNoFinancieros1(), 2, ",",".") . '</th>
                <th style="width:110">' . number_format($mun2019->getTotalGastosNoFinancieros1(), 2, ",",".") . '</th>
                <th style="width:110">' . number_format($mun2020->getTotalGastosNoFinancieros1(), 2, ",",".") . '</th>
            </tr>
            <tr>
                <td style="width:300">8. Activos Financieros</td>
                <td style="width:110">' . number_format($mun2018->getActivosFinancieros1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2019->getActivosFinancieros1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2020->getActivosFinancierosGastos1(), 2, ",",".") . '</td>
            </tr>
            <tr>
                <td style="width:300">9. Pasivos Financieros</td>
                <td style="width:110">' . number_format($mun2018->getPasivosFinancierosGastos1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2019->getPasivosFinancierosGastos1(), 2, ",",".") . '</td>
                <td style="width:110">' . number_format($mun2020->getPasivosFinancierosGastos1(), 2, ",",".") . '</td>
            </tr>
            <tr>
                <th style="width:300"><b>TOTAL GASTOS</b></th>
                <th style="width:110">' . number_format($mun2018->getTotalGastos1(), 2, ",",".") . '</th>
                <th style="width:110">' . number_format($mun2019->getTotalGastos1(), 2, ",",".") . '</th>
                <th style="width:110">' . number_format($mun2020->getTotalGastos1(), 2, ",",".") . '</th>
            </tr>
        </tbody>
    </table>
    </span>
';

$html .= '
    <br><br>
    <h3>Endeudamiento</h3>
    <b>Deuda Financiera 2020: </b>' . number_format($mun2020->getDeudaFinanciera(), 2, ",",".") . "€" . '
    <br><b>Deuda Financiera 2019: </b>' . number_format($mun2019->getDeudaFinanciera(), 2, ",",".") . "€" . '<br>
    <br><span style="text-align:left"><table cellspacing="0" cellpadding="5" border="1">
        <thead>
            <tr>
                <th style="width:410"></th>
                <th style="width:110"><b>2019</b></th>
                <th style="width:110"><b>2020</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th style="width:410">Endeudamiento</th>
                <td style="width:110">' . number_format($mun2019->getEndeudamiento()*100, 2, ",",".") . "%" . '</td>
                <td style="width:110">' . number_format($mun2020->getEndeudamiento()*100, 2, ",",".") . "%" . '</td>
            </tr>
            <tr>
                <th style="width:410">Endeudamiento Media Ayuntamientos</th>
                <td style="width:110">' . number_format($mun2019->getEndeudamientoMediaDiputaciones()*100, 2, ",",".") . "%" . '</td>
                <td style="width:110">' . number_format($mun2020->getEndeudamientoMediaDiputaciones()*100, 2, ",",".") . "%" . '</td>
            </tr>
        </tbody>
    </table>
    </span>
';

$html .= '
    <br><br>
    <h3>Solvencia</h3>
    <br><span style="text-align:left"><table cellspacing="0" cellpadding="5" border="1">
        <thead>
            <tr>
                <th style="width:410"></th>
                <th style="width:110"><b>2019</b></th>
                <th style="width:110"><b>2020</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th style="width:410">Sostenibilidad Financiera</th>
                <td style="width:110">' . number_format($mun2019->getSostenibilidadFinanciera()*100, 2, ",",".") . "%" . '</td>
                <td style="width:110">' . number_format($mun2020->getSostenibilidadFinanciera()*100, 2, ",",".") . "%" . '</td>
            </tr>
            <tr>
                <th style="width:410">Sostenibilidad Financiera Media Ayuntamientos</th>
                <td style="width:110">' . number_format($mun2019->getSostenibilidadFinancieraMediaDiputaciones()*100, 2, ",",".") . "%" . '</td>
                <td style="width:110">' . number_format($mun2020->getSostenibilidadFinancieraMediaDiputaciones()*100, 2, ",",".") . "%" . '</td>
            </tr>
        </tbody>
    </table>
    <br><br><span style="text-align:left"><table cellspacing="0" cellpadding="5" border="1">
        <thead>
            <tr>
                <th style="width:410"></th>
                <th style="width:110"><b>2019</b></th>
                <th style="width:110"><b>2020</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th style="width:410">Apalancamiento Operativo</th>
                <td style="width:110">' . number_format($mun2019->getApalancamientoOperativo()*100, 2, ",",".") . "%" . '</td>
                <td style="width:110">' . number_format($mun2020->getApalancamientoOperativo()*100, 2, ",",".") . "%" . '</td>
            </tr>
            <tr>
                <th style="width:410">Apalancamiento Operativo Media Ayuntamientos</th>
                <td style="width:110">' . number_format($mun2019->getApalancamientoOperativoMediaDiputaciones()*100, 2, ",",".") . "%" . '</td>
                <td style="width:110">' . number_format($mun2020->getApalancamientoOperativoMediaDiputaciones()*100, 2, ",",".") . "%" . '</td>
            </tr>
        </tbody>
    </table>
    <br><br><span style="text-align:left"><table cellspacing="0" cellpadding="5" border="1">
        <thead>
            <tr>
                <th style="width:410"></th>
                <th style="width:110"><b>2019</b></th>
                <th style="width:110"><b>2020</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th style="width:410">Sostenibilidad de la Deuda</th>
                <td style="width:110">' . number_format($mun2019->getSostenibilidadDeuda()*100, 2, ",",".") . "%" . '</td>
                <td style="width:110">' . number_format($mun2020->getSostenibilidadDeuda()*100, 2, ",",".") . "%" . '</td>
            </tr>
            <tr>
                <th style="width:410">Sostenibilidad de la Deuda Media Ayuntamientos</th>
                <td style="width:110">' . number_format($mun2019->getSostenibilidadDeudaMediaDiputaciones()*100, 2, ",",".") . "%" . '</td>
                <td style="width:110">' . number_format($mun2020->getSostenibilidadDeudaMediaDiputaciones()*100, 2, ",",".") . "%" . '</td>
            </tr>
        </tbody>
    </table>
    </span>
';



$pdf->writeHTML($html, true, false, false, false, 'C');


/* PÁGINA 3 */
$pdf->AddPage();

$html = '
    <br><br>
    <span style="text-align:justify;">
    <h3>Liquidez</h3>
    <b>Fondos líquidos 2020: </b>' . number_format($mun2020->getFondosLiquidos(), 2, ",",".") . "€" . '
    <br><b>Fondos líquidos 2019: </b>' . number_format($mun2019->getFondosLiquidos(), 2, ",",".") . "€" . '
    <br><br><span style="text-align:left"><table cellspacing="0" cellpadding="5" border="1">
        <thead>
            <tr>
                <th style="width:410"></th>
                <th style="width:110"><b>2019</b></th>
                <th style="width:110"><b>2020</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th style="width:410">Remanente de Tesorería Gastos Generales</th>
                <td style="width:110">' . number_format($mun2019->getRemanenteTesoreriaGastosGenerales()*100, 2, ",",".") . "%" . '</td>
                <td style="width:110">' . number_format($mun2020->getRemanenteTesoreriaGastosGenerales()*100, 2, ",",".") . "%" . '</td>
            </tr>
            <tr>
                <th style="width:410">Remanente de Tesorería Gastos Generales Media Ayuntamientos</th>
                <td style="width:110">' . number_format($mun2019->getRemanenteTesoreriaGastosGeneralesMediaDiputaciones()*100, 2, ",",".") . "%" . '</td>
                <td style="width:110">' . number_format($mun2020->getRemanenteTesoreriaGastosGeneralesMediaDiputaciones()*100, 2, ",",".") . "%" . '</td>
            </tr>
        </tbody>
    </table>
    <br><br><span style="text-align:left"><table cellspacing="0" cellpadding="5" border="1">
        <thead>
            <tr>
                <th style="width:410"></th>
                <th style="width:110"><b>2019</b></th>
                <th style="width:110"><b>2020</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th style="width:410">Liquidez Inmediata</th>
                <td style="width:110">' . number_format($mun2019->getLiquidezInmediata()*100, 2, ",",".") . "%" . '</td>
                <td style="width:110">' . number_format($mun2020->getLiquidezInmediata()*100, 2, ",",".") . "%" . '</td>
            </tr>
            <tr>
                <th style="width:410">Solvencia Corto Plazo Media Ayuntamientos</th>
                <td style="width:110">' . number_format($mun2019->getSolvenciaCortoPlazoMediaDiputaciones()*100, 2, ",",".") . "%" . '</td>
                <td style="width:110">' . number_format($mun2020->getSolvenciaCortoPlazoMediaDiputaciones()*100, 2, ",",".") . "%" . '</td>
            </tr>
        </tbody>
    </table>
    <br><br><span style="text-align:left"><table cellspacing="0" cellpadding="5" border="1">
        <thead>
            <tr>
                <th style="width:410"></th>
                <th style="width:110"><b>2019</b></th>
                <th style="width:110"><b>2020</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th style="width:410">Solvencia Corto Plazo</th>
                <td style="width:110">' . number_format($mun2019->getSolvenciaCortoPlazo()*100, 2, ",",".") . "%" . '</td>
                <td style="width:110">' . number_format($mun2020->getSolvenciaCortoPlazo()*100, 2, ",",".") . "%" . '</td>
            </tr>
            <tr>
                <th style="width:410">Solvencia Corto Plazo Media Ayuntamientos</th>
                <td style="width:110">' . number_format($mun2019->getSolvenciaCortoPlazoMediaDiputaciones2()*100, 2, ",",".") . "%" . '</td>
                <td style="width:110">' . number_format($mun2020->getSolvenciaCortoPlazoMediaDiputaciones2()*100, 2, ",",".") . "%" . '</td>
            </tr>
        </tbody>
    </table>
    </span>
';

$html .= '
    <br><br>
    <h3>Eficiencia</h3>
    <br><span style="text-align:left"><table cellspacing="0" cellpadding="5" border="1">
        <thead>
            <tr>
                <th style="width:410"></th>
                <th style="width:110"><b>2019</b></th>
                <th style="width:110"><b>2020</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th style="width:410">Eficiencia</th>
                <td style="width:110">' . number_format($mun2019->getEficiencia()*100, 2, ",",".") . "%" . '</td>
                <td style="width:110">' . number_format($mun2020->getEficiencia()*100, 2, ",",".") . "%" . '</td>
            </tr>
            <tr>
                <th style="width:410">Eficiencia Media Ayuntamientos</th>
                <td style="width:110">' . number_format($mun2019->getEficienciaMediaDiputaciones()*100, 2, ",",".") . "%" . '</td>
                <td style="width:110">' . number_format($mun2020->getEficienciaMediaDiputaciones()*100, 2, ",",".") . "%" . '</td>
            </tr>
        </tbody>
    </table>
    </span>
';

$html .= '
    <br><br>
    <h3>Gestión Presupuestaria</h3>
    <br><span style="text-align:left"><table cellspacing="0" cellpadding="5" border="1">
        <thead>
            <tr>
            <th style="width:410"></th>
            <th style="width:110"><b>2019</b></th>
            <th style="width:110"><b>2020</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th style="width:410">Ejecución Ingresos corrientes</th>
                <td style="width:110">' .number_format($mun2019->getEjecucionIngresosCorrientes()*100, 2, ",",".") . "%" . '</td>
                <td style="width:110">' .number_format($mun2020->getEjecucionIngresosCorrientes()*100, 2, ",",".") . "%" . '</td>
            </tr>
            <tr>
                <th>Ejecución Ingresos Corrientes Media Ayuntamientos</th>
                <td style="width:110">' .number_format($mun2019->getEjecucionIngresosCorrientesMediaDiputaciones()*100, 2, ",",".") . "%" . '</td>
                <td style="width:110">' .number_format($mun2020->getEjecucionIngresosCorrientesMediaDiputaciones()*100, 2, ",",".") . "%" . '</td>
            </tr>
        </tbody>
    </table>
    <br><br><span style="text-align:left"><table cellspacing="0" cellpadding="5" border="1">
        <thead>
            <tr>
            <th style="width:410"></th>
            <th style="width:110"><b>2019</b></th>
            <th style="width:110"><b>2020</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th style="width:410">Ejecución Gastos corrientes</th>
                <td style="width:110">' .number_format($mun2019->getEjecucionGastosCorrientes()*100, 2, ",",".") . "%" . '</td>
                <td style="width:110">' .number_format($mun2020->getEjecucionGastosCorrientes()*100, 2, ",",".") . "%" . '</td>
            </tr>
            <tr>
                <th style="width:410">Ejecución Gastos Corrientes Media Ayuntamientos</th>
                <td style="width:110">' .number_format($mun2019->getEjecucionGastosCorrientesMediaDiputaciones()*100, 2, ",",".") . "%" . '</td>
                <td style="width:110">' .number_format($mun2020->getEjecucionGastosCorrientesMediaDiputaciones()*100, 2, ",",".") . "%" . '</td>
            </tr>
        </tbody>
    </table>
    </span>
';

$html .= '
    </span>
';

$pdf->writeHTML($html, true, false, false, false, 'C');


/* PÁGINA 4 */
$pdf->AddPage();

$html = '
    <br><br>
    <span style="text-align:justify;">
    <h3>Cumplimiento de Pagos</h3>
    <b>Deuda Comercial 2020: </b>' . number_format($mun2020->getDeudaComercial(), 2, ",",".") . "€" . '
    <br><b>Deuda Comercial 2019: </b>' . number_format($mun2019->getDeudaComercial(), 2, ",",".") . "€" . '
    <br><br><span style="text-align:left"><table cellspacing="0" cellpadding="5" border="1">
        <thead>
            <tr>
            <th style="width:410"></th>
            <th style="width:110"><b>2019</b></th>
            <th style="width:110"><b>2020</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th style="width:410">Periodo Medio de Pagos</th>
                <td style="width:110">' . number_format($mun2019->getPeriodoMedioPagos(), 2, ",",".") . " días" . '</td>
                <td style="width:110">' . number_format($mun2020->getPeriodoMedioPagos(), 2, ",",".") . " días" . '</td>
            </tr>
            <tr>
                <th style="width:410">Periodo Medio de Pagos Media Ayuntamientos</th>
                <td style="width:110">' . number_format($mun2019->getPeriodoMedioPagosMediaDiputaciones(), 2, ",",".") . " días" . '</td>
                <td style="width:110">' . number_format($mun2020->getPeriodoMedioPagosMediaDiputaciones(), 2, ",",".") . " días" . '</td>
            </tr>
        </tbody>
    </table>
    <br><br><span style="text-align:left"><table cellspacing="0" cellpadding="5" border="1">
        <thead>
            <tr>
                <th style="width:410"></th>
                <th style="width:110"><b>2019</b></th>
                <th style="width:110"><b>2020</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th style="width:410">Pagos sobre Obligaciones Reconocidas</th>
                <td style="width:110">' . number_format($mun2019->getPagosSobreObligacionesReconocidas()*100, 2, ",",".") . "%" . '</td>
                <td style="width:110">' . number_format($mun2020->getPagosSobreObligacionesReconocidas()*100, 2, ",",".") . "%" . '</td>
            </tr>
            <tr>
                <th style="width:410">Pagos sobre Obligaciones Reconocidas Media Ayuntamientos</th>
                <td style="width:110">' . number_format($mun2019->getPagosSobreObligacionesReconocidasMediaDiputaciones()*100, 2, ",",".") . "%" . '</td>
                <td style="width:110">' . number_format($mun2020->getPagosSobreObligacionesReconocidasMediaDiputaciones()*100, 2, ",",".") . "%" . '</td>
            </tr>
        </tbody>
    </table>
    </span>
';

$html .= '
    <br><br>
    <h3>Gestión Tributaria</h3>
    <b>Derechos Pendientes de Cobro 2020: </b>' . number_format($mun2020->getDerechosPendientesCobro(), 2, ",",".") . "€" . '
    <br><b>Derechos Pendientes de Cobro 2019: </b>' . number_format($mun2019->getDerechosPendientesCobro(), 2, ",",".") . "€" . '
    <br><br><span style="text-align:left"><table cellspacing="0" cellpadding="5" border="1">
        <thead>
            <tr>
            <th style="width:410"></th>
            <th style="width:110"><b>2019</b></th>
            <th style="width:110"><b>2020</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th style="width:410">Eficacia Recaudatoria</th>
                <td style="width:110">' . number_format($mun2019->getEficaciaRecaudatoria()*100, 2, ",",".") . "%" . '</td>
                <td style="width:110">' . number_format($mun2020->getEficaciaRecaudatoria()*100, 2, ",",".") . "%" . '</td>
            </tr>
            <tr>
                <th style="width:410">Eficacia Recaudatoria Media Ayuntamientos</th>
                <td style="width:110">' . number_format($mun2019->getEficaciaRecaudatoriaMediaDiputaciones()*100, 2, ",",".") . "%" . '</td>
                <td style="width:110">' . number_format($mun2020->getEficaciaRecaudatoriaMediaDiputaciones()*100, 2, ",",".") . "%" . '</td>
            </tr>
        </tbody>
    </table>
';

$html .= '
    </span>
';

$pdf->writeHTML($html, true, false, false, false, 'C');


/* EXPORTACIÓN DEL ARCHIVO */

$pdf->lastPage();
ob_end_clean();

$pdf->Output('Informe_municipio.pdf', 'I');
?>