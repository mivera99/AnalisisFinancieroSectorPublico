<?php
session_start();
require_once('includesWeb/daos/DAOConsultor.php');


if(isset($_COOKIE["mun"])){
    $nombre = $_COOKIE["mun"];
    //echo "Hola, soy " . $nombre . "!";
}
else {
    //echo "<b>NO HAY COOKIE :(</b><br>";
}


/* RECOGEMOS LOS DATOS DEL MUNICIPIO */

$daomun = new DAOConsultor();
$municipio = $daomun->getMunicipio($nombre);

$prog = $daomun->getProgMun(new Municipio(), $municipio->getCodigo());


/* AÑADIMOS LA LIBRERÍA TCPDF */
require_once('includes/tcpdf/tcpdf_import.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Noster Economía');
$pdf->setTitle($nombre . ' (Programas de Gastos)');

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

$html .= '
    <h3>Programas de gasto</h3><span style="text-align:left"><table cellspacing="0" cellpadding="5" border="1">
        <thead>
            <tr>
                <th style="width:500"></th>
                <th style="width:110"><b>2022</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th style="width:500">Administración General de la Seguridad y Protección Civil</th>
                <td style="width:110">' . number_format($prog->getAgspc(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Seguridad y Orden Público</th>
                <td  style="width:110">' . number_format($prog->getSop(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Ordenación del Tráfico y del Estacionamiento</th>
                <td  style="width:110">' . number_format($prog->getOte(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Movilidad Urbana</th>
                <td  style="width:110">' . number_format($prog->getMu(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Protección Civil</th>
                <td  style="width:110">' . number_format($prog->getPc(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Servicio de Prevención y Extinción de Incendios</th>
                <td  style="width:110">' . number_format($prog->getSpei(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Promoción y Gestión de Vivienda de Protección Pública</th>
                <td  style="width:110">' . number_format($prog->getPgvpp(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Conservación y Rehabilitación de la Edificación</th>
                <td  style="width:110">' . number_format($prog->getCre(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Pavimentación de Vías Públicas</th>
                <td  style="width:110">' . number_format($prog->getPvp(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Alcantarillado</th>
                <td  style="width:110">' . number_format($prog->getA(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Recogida, Gestión y Tratamiento de Residuos</th>
                <td  style="width:110">' . number_format($prog->getRgtr(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Recogida de Residuos</th>
                <td  style="width:110">' . number_format($prog->getRr(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Gestión de Residuos Sólidos Urbanos</th>
                <td  style="width:110">' . number_format($prog->getA(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Tratamiento de Residuos</th>
                <td  style="width:110">' . number_format($prog->getTr(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Limpieza Viaria</th>
                <td  style="width:110">' . number_format($prog->getLv(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Cementerios y Servicios Funerarios</th>
                <td  style="width:110">' . number_format($prog->getCsf(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Alumbrado Público</th>
                <td  style="width:110">' . number_format($prog->getAp(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Parques y Jardines</th>
                <td  style="width:110">' . number_format($prog->getPj(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Pensiones</th>
                <td  style="width:110">' . number_format($prog->getP(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Servicios Sociales y Promoción Social</th>
                <td  style="width:110">' . number_format($prog->getSsps(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Fomento del Empleo</th>
                <td  style="width:110">' . number_format($prog->getFe(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Sanidad</th>
                <td  style="width:110">' . number_format($prog->getS(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Educación</th>
                <td  style="width:110">' . number_format($prog->getE(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Cultura</th>
                <td  style="width:110">' . number_format($prog->getC(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Deporte</th>
                <td  style="width:110">' . number_format($prog->getD(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Agricultura, Ganadería y Pesca</th>
                <td  style="width:110">' . number_format($prog->getAgp(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Industria y Energía</th>
                <td  style="width:110">' . number_format($prog->getIe(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Comercio</th>
                <td  style="width:110">' . number_format($prog->getC(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Transporte Público</th>
                <td  style="width:110">' . number_format($prog->getTp(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Infraestructuras del Transporte</th>
                <td  style="width:110">' . number_format($prog->getIt(), 2, ",",".") . ' €' . '</td>
            </tr>
            <tr>
                <th style="width:500">Investigación, Desarrollo e Innovación</th>
                <td  style="width:110">' . number_format($prog->getIdi(), 2, ",",".") . ' €' . '</td>
            </tr>
        </tbody>
    </table>
    </span>
    <br>
    <br>
';

$html .= '
    </span>
';

$pdf->writeHTML($html, true, false, false, false, 'C');


/* EXPORTACIÓN DEL ARCHIVO */

$pdf->lastPage();
ob_end_clean();

$pdf->Output('EjemploMUN.pdf', 'I');
?>