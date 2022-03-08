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
$autonomia=NULL;
$provincia=NULL;

if(!empty($_REQUEST['scoringMUN']) && $_REQUEST['scoringMUN']!='inicio'){
    $scoring = htmlspecialchars(trim(strip_tags($_REQUEST['scoringMUN'])));
}

if(!empty($_REQUEST['poblacionMUN'])&& $_REQUEST['poblacionMUN']!='inicio'){
    $poblacion = htmlspecialchars(trim(strip_tags($_REQUEST['poblacionMUN'])));
}

if(!empty($_REQUEST['endeudamientoMUN']) && $_REQUEST['endeudamientoMUN']!='inicio'){
    $endeudamiento = htmlspecialchars(trim(strip_tags($_REQUEST['endeudamientoMUN'])));
}

if(!empty($_REQUEST['ahorro_netoMUN']) && $_REQUEST['ahorro_netoMUN']!='inicio'){
    $ahorro_neto = htmlspecialchars(trim(strip_tags($_REQUEST['ahorro_netoMUN'])));
}

if(!empty($_REQUEST['fondliqMUN']) && $_REQUEST['fondliqMUN']!='inicio'){
    $fondliq = htmlspecialchars(trim(strip_tags($_REQUEST['fondliqMUN'])));
}

if(isset($_REQUEST['selectionMUN'])){
    $choice = htmlspecialchars(trim(strip_tags($_REQUEST['selectionMUN'])));
    if($choice == 'SelectYear'){
        //echo '<p>Radio button del año pulsado</p><br>';
        if(!empty($_REQUEST['anhoMUN']) && $_REQUEST['anhoMUN']!='inicio'){
            //echo '<p>El año tiene un valor que no es inicio</p><br>';
            $anho = htmlspecialchars(trim(strip_tags($_REQUEST['anhoMUN'])));
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

if(!empty($_REQUEST['autonomiasMUN']) && $_REQUEST['autonomiasMUN']!='inicio'){
    $autonomia = htmlspecialchars(trim(strip_tags($_REQUEST['autonomiasMUN'])));
}

if(!empty($_REQUEST['provinciasMUN']) && $_REQUEST['provinciasMUN']!='inicio'){
    $provincia = htmlspecialchars(trim(strip_tags($_REQUEST['provinciasMUN'])));
}

echo '<p>Scoring: '.$scoring.'</p><br>';
echo '<p>Año: '.$anho.'</p><br>';
echo '<p>From: '.$from.'</p><br>';
echo '<p>To: '.$to.'</p><br>';
echo '<p>Endeudamiento: '.$endeudamiento.'</p><br>';

$muns = (new DAOConsultor())->consultarMUNs($scoring, $poblacion, $endeudamiento, $ahorro_neto, $fondliq, $choice, $anho, $from, $to, $autonomia, $provincia);
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
    <title>Análisis Financiero Sector Público - Consulta MUNs</title>
</head>
<body>
<div id="contenedor">

<div id="cabecera">
    <?php
        require('includesWeb/comun/cabecera.php');
    ?>
</div>
<div id="contenido">
    <?php
    if(count($muns)>0){
        echo '<p>Se han encontrado '.count($muns).' resultados</p>';
        $year=0;
        $i=0;
        while($i<count($muns)){
            echo '<h2>'.key($muns[$i]).'</h2>';
            echo '<table>';
            $year = key($muns[$i]);
            while($i < count($muns) && $year==key($muns[$i])){
                echo '<tr>';
                echo '<td>'.($i+1).'</td>';
                echo '<td>Nombre: '.$muns[$i][$year]->getNombre().', Poblacion: '.$muns[$i][$year]->getPoblacion().'</td>';
                echo '<td>'.$muns[$i][$year]->getScoring().'</td>';
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