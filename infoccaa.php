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
        array_push($etiquetasIngresosCor, $clave);
        array_push($datosIngresosCor, $valor);
    }
    /*Ingresos no financieros CCAA*/
    $datosIngresosNoFinancieros = array();
    $etiquetasIngresosNoFinancieros = array();
    foreach($ccaa->getTotalIngresosNoCorrientes1() as $clave=>$valor){
        array_push($etiquetasIngresosNoFinancieros, $clave);
        array_push($datosIngresosNoFinancieros, $valor);
    }
    /*Dato ingreso no financiero per cápita*/
    $datosIngresosTotales = array();
    $etiquetasIngresosTotales = array();
    foreach($ccaa->getTotalIngresos1() as $clave=>$valor){
        array_push($etiquetasIngresosTotales, $clave);
        array_push($datosIngresosTotales, $valor);
    }
    /*Gastos corrientes CCAA */
    $datosGastosCor = array();
    $etiquetasGastosCor = array();
    foreach($ccaa->getTotalGastosCorrientes1() as $clave=>$valor){
        array_push($etiquetasGastosCor, $clave);
        array_push($datosGastosCor, $valor);
    }
    /*Gastos no financieros CCAA*/
    $datosGastosNoFinancieros = array();
    $etiquetasGastosNoFinancieros = array();
    foreach($ccaa->getTotalGastosNoFinancieros1() as $clave=>$valor){
        array_push($etiquetasGastosNoFinancieros, $clave);
        array_push($datosGastosNoFinancieros, $valor);
    }
    /*Dato gasto no financiero per cápita*/
    $datosGastosFinancieros = array();
    $etiquetasGastosFinancieros = array();
    foreach($ccaa->getTotalGastos1() as $clave=>$valor){
        array_push($etiquetasGastosFinancieros, $clave);
        array_push($datosGastosFinancieros, $valor);
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
    <!--  ====== ICONOS ====== -->
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>

    <title>Análisis Financiero del Sector Público - Comunidad Autónoma</title>
</head>
    <body>
        <div id = "cabeceraIni">
            <?php require("includesWeb/comun/cabecera.php");?>  
        </div>

        <div id="menu-superior">
            <div id ="contenidoIni">     
                <?php require("includesWeb/comun/buscador.php");?>  
            </div>
        </div>
        
        <div id ="contenidoCCAA">
            <h3>Comunidad Autónoma</h3>
            <?php
            if($encontrado){
                echo '<p>Nota: el rating se corresponde con los últimos datos disponibles.</p>';
                echo '<h2>'.$ccaa->getNombre().'</h2>';
                $i=0;
                foreach($ccaa->getScoring() as $clave => $valor){
                    echo '<h2>Rating '.$clave.'</h2>';
                    echo '<button class="scoring '.$valor.'">'.$valor.'</button><p>Tendencia: '.($ccaa->getTendencia())[$clave].'</p>';

                    switch($valor){
                        case "A":
                            switch(($ccaa->getTendencia())[$clave]){
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
                            switch(($ccaa->getTendencia())[$clave]){
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
                            switch(($ccaa->getTendencia())[$clave]){
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
                            switch(($ccaa->getTendencia())[$clave]){
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
                            switch(($ccaa->getTendencia())[$clave]){
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

                    echo "<i>" . $infoRating . "</i><br><br>";
                    if($i==0){
                        echo '<p>';
                        $array= array_values($ccaa->getCCAAPib());
                        $dato = end($array)*100;
                        if($dato>=0) echo'Resultado presupuestario positivo. ';
                        else if ($dato<0 && $dato>=-1) echo'Buen resultado presupuestario. ';
                        else if ($dato<-1 && $dato>=-2) echo'Razonable resultado presupuestario. ';
                        else if ($dato<-2 && $dato>=-5) echo'Mal resultado presupuestario en el último ejercicio. ';
                        else if ($dato<-5) echo'Muy mal resultado presupuestario en el último ejercicio. ';

                        $array= array_values(($ccaa->getDeudaVivaIngrCor()));
                        $dato = end($array)[2]*100;
                        if($dato>=0 && $dato<50) echo'Bajo nivel de deuda financiera. ';
                        else if ($dato>=50 && $dato<75) echo'Moderado nivel de deuda financiera. ';
                        else if ($dato>=75 && $dato<100) echo'Aceptable nivel de deuda financiera. ';
                        else if ($dato>=100 && $dato<150) echo'Alto nivel de deuda financiera. ';
                        else if ($dato>=150) echo'Excesivo nivel de deuda financiera. ';
                        
                        $array= array_values($ccaa->getRSosteFinanciera());
                        $dato = end($array)*100;
                        if($dato>=0) echo'Con buena capacidad de ahorro en el último ejercicio. ';
                        else if ($dato>=-5 && $dato<0) echo'Sin capacidad de ahorro pero en niveles aceptables. ';
                        else if ($dato>=-10 && $dato<-5) echo'Con porcentaje de desahorro medio-alto. ';
                        else if ($dato>=-20 && $dato<-10) echo'Elevado nivel de desahorro. ';
                        else if ($dato<=-20) echo'Nula capacidad de ahorro que le obliga a fuertes incrementos de deuda. ';
                        
                        $array= array_values($ccaa->getRRigidez());
                        $dato = end($array)*100;
                        if($dato<=50) echo'Muy bajo apalancamiento operativo. ';
                        else if ($dato>=50 && $dato<60) echo'Reducido apalancamiento operativo. ';
                        else if ($dato>=60 && $dato<75) echo'Cuenta con un nivel de apalancamiento operativo controlado. ';
                        else if ($dato>=75 && $dato<90) echo'Alto apalancamiento operativo. ';
                        else if ($dato>=90) echo'Elevado apalancamiento operativo. ';
                        
                        $array= array_values($ccaa->getRSosteEndeuda());
                        $dato = end($array)*100;
                        if($dato>=0 && $dato<10) echo'Nulo nivel de carga financiera. ';
                        else if ($dato>=10 && $dato<20) echo'Bajo nivel de carga financiera. ';
                        else if ($dato>=20 && $dato<30) echo'Nivel de carga financiera controlado. ';
                        else if ($dato>=30 && $dato<50) echo'Alto nivel de carga financiera. ';
                        else if ($dato>=50) echo'Nivel excesivo de carga financiera. ';

                        $array= array_values(($ccaa->getPMP()));
                        $dato = end($array)[2];
                        if($dato>=0 && $dato<30) echo'Pago de facturas muy rápido. ';
                        else if ($dato>=30 && $dato<60) echo'Pago de facturas en tiempo aceptable. ';
                        else if ($dato>=60 && $dato<90) echo'Pago de facturas lento. ';
                        else if ($dato>=90 && $dato<120) echo'Tarda mucho en abonar las facturas. ';
                        else if ($dato>=120) echo'Excesivo tiempo en el abono de facturas. ';
                        
                        $array= array_values($ccaa->getREfic());
                        $dato = end($array)*100;
                        if($dato<=80) echo'Muy eficiente en términos de gastos ordinarios. ';
                        else if ($dato>=80 && $dato<100) echo'Eficiente en términos de gastos ordinarios. ';
                        else if ($dato>=100 && $dato<125) echo'Nivel de eficiencia intermedio. ';
                        else if ($dato>=125 && $dato<150) echo'Bajo de nivel de eficiencia. ';
                        else if ($dato>=150) echo'Muy poco eficiente en términos de gastos ordinarios. ';

                        $array= array_values($ccaa->getREjeIngrCorr());
                        $dato = end($array)*100;
                        if($dato>=99) echo'Muy buena previsión de ingresos. ';
                        else if ($dato>=97.5 && $dato<990) echo'Buena previsión de ingresos. ';
                        else if ($dato>=95 && $dato<97.5) echo'Razonable previsión de ingresos. ';
                        else if ($dato>=90 && $dato<95) echo'Baja capacidad de previsión de ingresos. ';
                        else if ($dato<=90) echo'Mala previsión de ingresos. ';

                        $array= array_values($ccaa->getREjeGastosCorr());
                        $dato = end($array)*100;
                        if($dato>=99) echo'Muy buen nivel de cumplimiento de gastos. ';
                        else if ($dato>=97.5 && $dato<99) echo'Buen nivel de cumplimiento de gastos. ';
                        else if ($dato>=95 && $dato<97.5) echo'Razonable cumplimiento de gastos. ';
                        else if ($dato>=90 && $dato<95) echo'Baja ejecución presupuestaria de gastos. ';
                        else if ($dato<=90) echo'Mala ejecución de gastos.';

                        $array= array_values(($ccaa->getRDCPP()));
                        $dato = end($array)[2]*100;
                        if($dato==0) echo'Sin deuda comercial. ';
                        else if ($dato>0 && $dato<=5) echo'Bajo nivel de deuda comercial. ';
                        else if ($dato>5 && $dato<=10) echo'Razonable nivel de deuda comercial. ';
                        else if ($dato>10 && $dato<=20) echo'Alto nivel de deuda comercial. ';
                        else if ($dato>20) echo'Muy alto nivel de deuda comercial. ';
                        
                        $array= array_values($ccaa->getPagosObligaciones());
                        $dato = end($array)*100;
                        if($dato>=99) echo'Elevado nivel de pagos sobre gastos reconocidos. ';
                        else if ($dato>=95 && $dato<99) echo'Nivel de pagos razonable sobre gastos reconocidos. ';
                        else if ($dato>=90 && $dato<95) echo'Aceptable nivel de pagos sobre gastos reconocidos. ';
                        else if ($dato>=85 && $dato<90) echo'Bajo nivel de pagos sobre gastos reconocidos. ';
                        else if ($dato<=85) echo'Muy bajo porcentaje de pagos sobre obligaciones reconocidas. ';

                        $array= array_values($ccaa->getREficaciaRec());
                        $dato = end($array)*100;
                        if($dato>=95) echo'Muy buen nivel de eficacia recaudatoria. ';
                        else if ($dato>=90 && $dato<95) echo'Razonable nivel de eficacia recaudatoria. ';
                        else if ($dato>=85 && $dato<90) echo'Aceptable nivel de eficacia recaudatoria. ';
                        else if ($dato>=80 && $dato<85) echo'Bajo nivel de eficacia recaudatoria. ';
                        else if ($dato<=80) echo'Muy bajo nivel de eficacia recaudatoria. ';
                        echo '</p><br>';
                    }
                    $i++;
                }
            ?>
                <br>
                <a href="pdfCCAA.php" target="_blank"><button type="button" id="verPDFCCAA">Ver Informe</button></a>
                <a <?php echo 'href="procesarExportacion.php?nombre='.urlencode($ccaa->getNombre()).'&tipo=ccaa"';?> target="_blank"><button type="button" id="verPDFCCAA" >Exportar información</button></a>
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
                            <th colspan="2">Población (Año <?php echo key($ccaa->getPoblacion()).'): '. number_format(($ccaa->getPoblacion())[key($ccaa->getPoblacion())], 0, '','.');?> habs.</th>
                            <th colspan="2">PIB per cápita (Año <?php echo key($ccaa->getPibc()).'): '. number_format(($ccaa->getPibc())[key($ccaa->getPibc())]*1000, 0, '','.');?>€</th>
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
                <h3><b>Resultado presupuestario y endeudamiento</b></h3>
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
                    if($i==0){ 
                        ?>
                        <th>
                            <div class="celda-presupuesto">
                                Resultado presupuestario
                                <div class="info">
                                    <img src="icons/info.svg" alt="información" height="14px">
                                    <span class="extra-info">Mide el déficit público en relación al PIB de la comunidad. Mejor cuanto más bajo</span>
                                </div>
                            </div>
                        </th>
                        <?php
                    }
                    else if ($i==1) echo '<th>Resultado presupuestario nacional</th>';
                    else if ($i==2) {
                        ?> 
                        <th>
                            <div class="celda-endeudamiento">
                                Endeudamiento
                                <div class="info">
                                    <img src="icons/info.svg" alt="información" height="14px">
                                    <span class="extra-info">Mide la deuda sobre ingresos corrientes. Mejor cuanto más bajo</span>
                                </div>
                            </div>
                        </th>
                        <?php
                    }
                    else if ($i==3) echo '<th>Endeudamiento media nacional</th>';
                    if($i<2){
                        foreach($tmp as $clave=>$valor){
                            $porcentaje = $valor*100;
                            $color = "";
                            if($porcentaje>=0) $color="darkgreenCell";
                            else if ($porcentaje<0 && $porcentaje>=-1) $color="greenCell";
                            else if ($porcentaje<-1 && $porcentaje>=-2) $color="lightgreenCell";
                            else if ($porcentaje<-2 && $porcentaje>=-5) $color="orangeCell";
                            else if ($porcentaje<-5) $color="redCell";
                            else $color="greyCell";
                            echo '<td class="'.$color.'">'.$porcentaje.'%</td>';
                        }
                    }
                    else {
                        foreach($tmp as $array){
                            $porcentaje = ($array[2]*100);
                            $color="";
                            if($porcentaje>=0 && $porcentaje<50) $color="darkgreenCell";
                            else if ($porcentaje>=50 && $porcentaje<75) $color="greenCell";
                            else if ($porcentaje>=75 && $porcentaje<100) $color="lightgreenCell";
                            else if ($porcentaje>=100 && $porcentaje<150) $color="orangeCell";
                            else if ($porcentaje>=150) $color="redCell";
                            else $color="greyCell";
                            echo '<td class="'.$color.'">'.$porcentaje.'%</td>';
                        }
                    }
                    echo '</tr>';
                    echo'</tbody>';
                    echo '</table>';
                    echo '<br>';
                }
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
                <h3>Solvencia</h3>
                <!--METER LOS GRAFICOS AQUI-->
                <?php
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
                    if($i==0) {
                        ?>
                        <th>
                        <div class="celda-sostenibilidad-financiera">
                            Sostenibilidad financiera
                            <div class="info">
                                <img src="icons/info.svg" alt="información" height="14px">
                                <span class="extra-info">Mide el ahorro neto sobre ingresos corrientes. Mejor cuanto más alto</span>
                            </div>
                        </div>
                        </th>
                        <?php
                    }
                    else if ($i==1){ 
                        ?>
                        <th>
                        <div class="celda-apalancamiento">
                            Apalancamiento
                            <div class="info-apalancamiento">
                                <img src="icons/info.svg" alt="información" height="14px">
                                <span class="extra-info">Mide gastos de difícil ajuste (personal, amortización e intereses) sobre ingresos corrientes</span>
                            </div>
                        </div>
                        </th>
                        <?php
                    }
                    else if ($i==2) {
                        ?>
                        <th>
                        <div class="celda-sostenibilidad-deuda">
                            Sostenibilidad de la deuda
                            <div class="info-sostenibilidad-deuda">
                                <img src="icons/info.svg" alt="información" height="14px">
                                <span class="extra-info">Mide la carga financiera entre ingresos corrientes</span>
                            </div>
                        </div>
                        </th>
                        <?php
                    }
                    foreach($tmp as $clave=>$valor){
                        $porcentaje = ($valor*100);
                        $color="";
                        if($i==0) {
                            if($porcentaje>=0) $color="darkgreenCell";
                            else if ($porcentaje>=-5 && $porcentaje<0) $color="greenCell";
                            else if ($porcentaje>=-10 && $porcentaje<-5) $color="lightgreenCell";
                            else if ($porcentaje>=-20 && $porcentaje<-10) $color="orangeCell";
                            else if ($porcentaje<=-20) $color="redCell";
                            else $color="greyCell";
                        }
                        else if($i==1){
                            if($porcentaje<=50) $color="darkgreenCell";
                            else if ($porcentaje>=50 && $porcentaje<60) $color="greenCell";
                            else if ($porcentaje>=60 && $porcentaje<75) $color="lightgreenCell";
                            else if ($porcentaje>=75 && $porcentaje<90) $color="orangeCell";
                            else if ($porcentaje>=90) $color="redCell";
                            else $color="greyCell";
                        }
                        else if($i==2){
                            if($porcentaje>=0 && $porcentaje<10) $color="darkgreenCell";
                            else if ($porcentaje>=10 && $porcentaje<20) $color="greenCell";
                            else if ($porcentaje>=20 && $porcentaje<30) $color="lightgreenCell";
                            else if ($porcentaje>=30 && $porcentaje<50) $color="orangeCell";
                            else if ($porcentaje>=50) $color="redCell";
                            else $color="greyCell";
                        }
                        echo '<td class="'.$color.'">'.$porcentaje.'%</td>';
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
                                    text:'Sostenibilidad financiera',
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
                                    text:'Apalancamiento operativo',
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
                    if($i==0) {
                        ?>
                        <th>
                        <div class="celda-pmp">
                            Periodo medio de pago
                            <div class="info">
                                <img src="icons/info.svg" alt="información" height="14px">
                                <span class="extra-info">Mide el número de días que se tarda en pagar a proveedores desde los 30 días legales</span>
                            </div>
                        </th>
                        </div>
                        <?php
                    }
                    else if ($i==1) echo '<th>Periodo medio de pago nacional</th>';
                    foreach($tmp as $array){
                        $dias=$array[2];
                        $color="";
                        if($dias>=0 && $dias<30) $color="darkgreenCell";
                        else if ($dias>=30 && $dias<60) $color="greenCell";
                        else if ($dias>=60 && $dias<90) $color="lightgreenCell";
                        else if ($dias>=90 && $dias<120) $color="orangeCell";
                        else if ($dias>=120) $color="redCell";
                        else $color="greyCell";
                        echo '<td class="'.$color.'">'.$dias.' días</td>';
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
                    <div class="type_chart">
                        <input type="radio" id="selectBar" name="selectionChart" value="SelectBar" onclick="changeChart(pmp, configChartPMP, 'selectionChart')">
                        <label for="selectBar">Barras</label>
                        <input type="radio" id="selectLine" name="selectionChart" value="SelectLine" onclick="changeChart(pmp, configChartPMP, 'selectionChart')">
                        <label for="selectLine">Líneas</label>
                    </div>
                    <canvas id="pmpNac" height="300" width="500"></canvas>
                    <div class="type_chart">
                        <input type="radio" id="selectBarPmpNac" name="selectionPMPNac" value="SelectBar" onclick="changeChart(pmpNac, configChartPMPNac, 'selectionPMPNac')">
                        <label for="selectBarPmpNac">Barras</label>
                        <input type="radio" id="selectLinePmpNac" name="selectionPMPNac" value="SelectLine" onclick="changeChart(pmpNac, configChartPMPNac, 'selectionPMPNac')">
                        <label for="selectLinePmpNac">Líneas</label>
                    </div>
                    <br><br>
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
                </div>
                <br><br>
                <h3>Eficiencia</h3>
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
                    if($i==0) {
                        ?>
                        <th>
                        <div class="celda-eficiencia">
                            Eficiencia
                            <div class="info">
                                <img src="icons/info.svg" alt="información" height="14px">
                                <span class="extra-info">Mide gastos de personal + bienes y servicios entre ingresos corrientes propios recurrentes</span>
                            </div>
                        </div>
                        </th>
                        <?php
                    }
                    else if ($i==1) echo '<th>Eficiencia media</th>';
                    foreach($tmp as $clave=>$valor){
                        $porcentaje = ($valor*100);
                        $color="";
                        if($porcentaje<=80) $color="darkgreenCell";
                        else if ($porcentaje>=80 && $porcentaje<100) $color="greenCell";
                        else if ($porcentaje>=100 && $porcentaje<125) $color="lightgreenCell";
                        else if ($porcentaje>=125 && $porcentaje<150) $color="orangeCell";
                        else if ($porcentaje>=150) $color="redCell";
                        else $color="greyCell";
                        echo '<td class="'.$color.'">'.($porcentaje).'%</td>';
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
                <h3>Gestión presupuestaria</h3>
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
                    if($i==0) {
                        ?>
                        <th>
                        <div class="celda-ejecucion-ingresos">
                            Ejecución sobre ingresos corrientes
                            <div class="info">
                                <img src="icons/info.svg" alt="información" height="14px">
                                <span class="extra-info">Mide el porcentaje de derechos reconocidos sobre los ingresos presupuestados</span>
                            </div>
                        </div>
                        </th>
                        <?php
                    }
                    else if ($i==1) echo '<th>Ejecución media sobre ingresos corrientes</th>';
                    else if ($i==2) {
                        ?>
                        <th>
                        <div class="celda-ejecucion-gastos">
                            Ejecución sobre gastos corrientes
                            <div class="info">
                                <img src="icons/info.svg" alt="información" height="14px">
                                <span class="extra-info">Mide el porcentaje de obligaciones reconocidas sobre los gastos presupuestados</span>
                            </div>
                        </div>
                        </th>
                        <?php
                    }
                    else if ($i==3) echo '<th>Ejecución media sobre gastos corrientes</th>';
                    foreach($tmp as $clave=>$valor){
                        $porcentaje = ($valor*100);
                        $color="";
                        if($porcentaje>=99) $color="darkgreenCell";
                        else if ($porcentaje>=97.5 && $porcentaje<99) $color="greenCell";
                        else if ($porcentaje>=95 && $porcentaje<97.5) $color="lightgreenCell";
                        else if ($porcentaje>=90 && $porcentaje<95) $color="orangeCell";
                        else if ($porcentaje<=90) $color="redCell";
                        else $color="greyCell";
                        echo '<td class="'.$color.'">'.($porcentaje).'%</td>';
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
                <h3>Deuda comercial pendiente de pago</h3>
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
                    if($i==0) {
                        ?>
                        <th>
                        <div class="celda-pmp">
                            Deuda comercial sobre obligaciones reconocidas
                            <div class="info">
                                <img src="icons/info.svg" alt="información" height="14px">
                                <span class="extra-info">Mide los pagos pendientes de la deuda comercial</span>
                            </div>
                        </div>
                        </th>
                        <?php
                    }
                    else if ($i==1) echo '<th>Deuda comercial media sobre obligaciones reconocidas</th>';
                    foreach($tmp as $array){
                        $porcentaje=($array[2]*100);
                        $color="";
                        if($porcentaje==0) $color="darkgreenCell";
                        else if ($porcentaje>0 && $porcentaje<=5) $color="greenCell";
                        else if ($porcentaje>5 && $porcentaje<=10) $color="lightgreenCell";
                        else if ($porcentaje>10 && $porcentaje<=20) $color="orangeCell";
                        else if ($porcentaje>20) $color="redCell";
                        else $color="greyCell";
                        echo '<td class="'.$color.'">'.($porcentaje).'%</td>';
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
                <h3>Cumplimiento de pagos</h3>
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
                    if($i==0) {
                        ?>
                        <th>
                        <div class="celda-pagos-obligaciones">
                            Pagos sobre obligaciones reconocidas
                            <div class="info">
                                <img src="icons/info.svg" alt="información" height="14px">
                                <span class="extra-info">Mide el porcentaje de pagos sobre las obligaciones reconocidas</span>
                            </div>
                        </div>
                        </th>
                        <?php
                    }
                    else if ($i==1) echo '<th>Porcentaje medio de gastos pagados</th>';
                    foreach($tmp as $clave=>$valor){
                        $porcentaje = ($valor*100);
                        $color="";
                        if($porcentaje>=99) $color="darkgreenCell";
                        else if ($porcentaje>=95 && $porcentaje<99) $color="greenCell";
                        else if ($porcentaje>=90 && $porcentaje<95) $color="lightgreenCell";
                        else if ($porcentaje>=85 && $porcentaje<90) $color="orangeCell";
                        else if ($porcentaje<=85) $color="redCell";
                        else $color="greyCell";
                        echo '<td class="'.$color.'">'.($porcentaje).'%</td>';
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
                <h3>Gestión tributaria</h3>
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
                    if($i==0) {
                        ?>
                        <th>
                        <div class="celda-eficacia-recaudatoria">
                            Eficacia recaudatoria
                            <div class="info">
                                <img src="icons/info.svg" alt="información" height="14px">
                                <span class="extra-info">Mide los ingresos cobrados sobre los ingresos devengados</span>
                            </div>
                        </div>
                        </th>
                        <?php
                    }
                    else if ($i==1) echo '<th>Eficacia media recaudatoria</th>';
                    foreach($tmp as $clave=>$valor){
                        $porcentaje=($valor*100);
                        $color="";
                        if($porcentaje>=95) $color="darkgreenCell";
                        else if ($porcentaje>=90 && $porcentaje<95) $color="greenCell";
                        else if ($porcentaje>=85 && $porcentaje<90) $color="lightgreenCell";
                        else if ($porcentaje>=80 && $porcentaje<85) $color="orangeCell";
                        else if ($porcentaje<=80) $color="redCell";
                        else $color="greyCell";
                        echo '<td class="'.$color.'">'.($porcentaje).'%</td>';
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
            <div style="height:15vh"></div>
        </div>

        <br><br><br>

        <div id = "pie">
            <?php require("includesWeb/comun/pie.php");?>
        </div>
    </body>
</html>