<?php
session_start();
require_once('includesWeb/daos/DAOConsultor.php');

$scoring = NULL;
$poblacion = NULL;
$endeudamiento = NULL;
$ahorro_neto = NULL;
$fondliq = NULL;
$anho = NULL;

$choice = NULL;
$from=NULL;
$to=NULL;

if(!empty($_REQUEST['scoringDIP']) && $_REQUEST['scoringDIP']!='inicio'){
    $scoring = htmlspecialchars(trim(strip_tags($_REQUEST['scoringDIP'])));
}

if(!empty($_REQUEST['poblacionDIP'])&& $_REQUEST['poblacionDIP']!='inicio'){
    $poblacion = htmlspecialchars(trim(strip_tags($_REQUEST['poblacionDIP'])));
}

if(!empty($_REQUEST['endeudamientoDIP']) && $_REQUEST['endeudamientoDIP']!='inicio'){
    $endeudamiento = htmlspecialchars(trim(strip_tags($_REQUEST['endeudamientoDIP'])));
}

if(!empty($_REQUEST['ahorro_netoDIP']) && $_REQUEST['ahorro_netoDIP']!='inicio'){
    $ahorro_neto = htmlspecialchars(trim(strip_tags($_REQUEST['ahorro_netoDIP'])));
}

if(!empty($_REQUEST['fondliqDIP']) && $_REQUEST['fondliqDIP']!='inicio'){
    $fondliq = htmlspecialchars(trim(strip_tags($_REQUEST['fondliqDIP'])));
}

if(isset($_REQUEST['selectionDIP'])){
    $choice = htmlspecialchars(trim(strip_tags($_REQUEST['selectionDIP'])));
    if($choice == 'SelectYear'){
        //echo '<p>Radio button del año pulsado</p><br>';
        if(!empty($_REQUEST['anhoDIP']) && $_REQUEST['anhoDIP']!='inicio'){
            //echo '<p>El año tiene un valor que no es inicio</p><br>';
            $anho = htmlspecialchars(trim(strip_tags($_REQUEST['anhoDIP'])));
        }
    }
    else {
        //echo '<p>Radio button pulsado</p><br>';
        if(!empty($_REQUEST['from']) && !empty($_REQUEST['to'])){
            if($_REQUEST['from']!='inicio'){
                //echo '<p>El año from tiene un valor que no es inicio</p><br>';
                $from = htmlspecialchars(trim(strip_tags($_REQUEST['from'])));
            }
            //echo '<p>valor de from: '.$from.'</p><br>';
            if($_REQUEST['to']!='inicio'){
                //echo '<p>El año to tiene un valor que no es inicio</p><br>';
                $to = htmlspecialchars(trim(strip_tags($_REQUEST['to'])));
            }
            //echo '<p>valor de to: '.$to.'</p><br>';
        
        }
    }
}

if(!empty($_REQUEST['autonomiasDIP']) && $_REQUEST['autonomiasDIP']!='inicio'){
    $autonomia = htmlspecialchars(trim(strip_tags($_REQUEST['autonomiasMUN'])));
}

if(!empty($_REQUEST['provinciasDIP']) && $_REQUEST['provinciasDIP']!='inicio'){
    $provincia = htmlspecialchars(trim(strip_tags($_REQUEST['provinciasDIP'])));
}

/*echo '<p>Scoring: '.$scoring.'</p><br>';
echo '<p>Año: '.$anho.'</p><br>';
echo '<p>From: '.$from.'</p><br>';
echo '<p>To: '.$to.'</p><br>';*/
/*echo '<p>'.$scoring.'</p><br>';
echo '<p>'.$scoring.'</p><br>';
echo '<p>'.$scoring.'</p><br>';*/

$dips = (new DAOConsultor())->consultarDIPs($scoring, $poblacion, $endeudamiento, $ahorro_neto, $fondliq, $choice, $anho, $from, $to, $autonomia, $provincia);
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

    <!-- ====== FUNCIÓN PARA MOSTRAR LA CONTRASEÑA SI PULSAMOS UN BOTÓN ==== -->
    <script src="functions2.js"></script>
    <title>Análisis Financiero Sector Público - Consulta DIPs</title>
</head>
<body>
<div id="contenedor">

<div id="cabecera">
    <?php
        require('includesWeb/comun/cabecera.php');
    ?>
</div>
<div id="consultaDIP">
    <?php
    if(count($dips)>0){
        echo '<p>Se han encontrado '.count($dips).' resultados</p>';
        $year=0;
        $i=0;
        while($i<count($dips)){
            echo '<h2>'.key($dips[$i]).'</h2>';
            echo '<table>';
            $year = key($dips[$i]);
            while($i < count($dips) && $year==key($dips[$i])){
                echo '<tr>';
                echo '<td>'.($i+1).'</td>';
                echo '<td>Nombre: '.$dips[$i][$year]->getNombre().'</td>';
                if(!empty($dips[$i][$year]->getPoblacion())) echo '<td class="ratingCell">'.number_format($dips[$i][$year]->getPoblacion(), 0, '','.').'</td>';
                if(!empty($dips[$i][$year]->getScoring())) echo '<td class="ratingCell">'.$dips[$i][$year]->getScoring().'</td>';
                if(!empty($dips[$i][$year]->getRSosteFinanciera())) echo '<td class="ratingCell">'.($dips[$i][$year]->getRSosteFinanciera()*100).'%</td>';
                if(!empty($dips[$i][$year]->getEndeudamiento())) echo '<td class="ratingCell">'.($dips[$i][$year]->getEndeudamiento()*100).'%</td>';
                if(!empty($dips[$i][$year]->getSostenibilidad())) echo '<td class="ratingCell">'.($dips[$i][$year]->getSostenibilidad()*100).'%</td>';
                if(!empty($dips[$i][$year]->getAutonomia())) echo '<td class="ratingCell">'.($dips[$i][$year]->getAutonomia()*100).'%</td>';
                if(!empty($dips[$i][$year]->getProvincia())) echo '<td class="ratingCell">'.($dips[$i][$year]->getProvincia()*100).'%</td>';
                echo '</tr>';
                $i+=1;
            }
            echo '</table>';
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