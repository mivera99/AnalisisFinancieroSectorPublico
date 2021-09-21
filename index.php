<?php
$conn = new mysqli("localhost", "root", "", "dbs_01");

//IMPORTANTE
//Para poder guardar las tildes con el cortejamiento de datos utf-8
$conn->set_charset("utf8");

$affectedRow = 0;

$xml = simplexml_load_file("BLOQUE_GENERAL_CCAA_EXPORT.xml") or die("Error: Cannot create object");

foreach ($xml->children() as $row) {
    $CODIGO_CCAA = $row->CODIGO_CCAA;
    $NOMBRE_CCAA = $row->NOMBRE_CCAA;
    $POBLACION_2017 = $row->POBLACION_2017;
    $NOMBREPRESIDENTE = $row->NOMBREPRESIDENTE;
    $APELLIDO1PRESIDENTE = $row->APELLIDO1PRESIDENTE;
    $APELLIDO2PRESIDENTE = $row->APELLIDO2PRESIDENTE;
    
    $tiempo = strtotime($row->VIGENCIA);
    $VIGENCIA=date('Y-m-d',$tiempo);
    
    $PARTIDO = $row->PARTIDO;
    $CIF = $row->CIF;
    $TIPOVIA = $row->TIPOVIA;
    $NOMBREVIA = $row->NOMBREVIA;
    $NUMVIA = $row->NUMVIA;
    $CODPOSTAL = $row->CODPOSTAL;
    $TELEFONO = $row->TELEFONO;
    $FAX = $row->FAX;
    $WEB = $row->WEB;
    $MAIL = $row->MAIL;
    $REFPIB = $row->REFPIB;
    $PIB = $row->PIB;
    $REFPIBC = $row->REFPIBC;
    $PIBC = $row->PIBC;
    $REFRESULTADO = $row->REFRESULTADO;
    $RESULTADO = $row->RESULTADO;
    $REFDEUDAVIVA = $row->REFDEUDAVIVA;
    $DEUDAVIVA = $row->DEUDAVIVA;

    echo($CODIGO_CCAA."<br>");
    echo($NOMBRE_CCAA."<br>");
    echo($POBLACION_2017."<br>");
    echo($NOMBREPRESIDENTE."<br>");
    echo($APELLIDO1PRESIDENTE."<br>");
    echo($APELLIDO2PRESIDENTE."<br>");
    echo($VIGENCIA."<br>");
    echo("<br><br><br>");
    


    $sql = "INSERT INTO bloque_general_ccaa(CODIGO_CCAA,NOMBRE_CCAA,POBLACION_2017,NOMBREPRESIDENTE,
    APELLIDO1PRESIDENTE, APELLIDO2PRESIDENTE, VIGENCIA, PARTIDO, CIF, TIPOVIA, NOMBREVIA, NUMVIA, 
    CODPOSTAL, TELEFONO,FAX, WEB, MAIL, REFPIB, PIB, REFPIBC, PIBC, REFRESULTADO, RESULTADO, REFDEUDAVIVA, 
    DEUDAVIVA) VALUES ('" . $CODIGO_CCAA . "','" . $NOMBRE_CCAA . "','" . $POBLACION_2017 . "',
    '" . $NOMBREPRESIDENTE . "','".$APELLIDO1PRESIDENTE."','".$APELLIDO2PRESIDENTE."','".$VIGENCIA."',
    '".$PARTIDO."','".$CIF."','".$TIPOVIA."','".$NOMBREVIA."','".$NUMVIA."','".$CODPOSTAL."','".$TELEFONO."','".
    $FAX."','".$WEB."','".$MAIL."','".$REFPIB."','".$PIB."','".$REFPIBC."','".$PIBC."','".$REFRESULTADO."',
    '".$RESULTADO."','".$REFDEUDAVIVA."','".$DEUDAVIVA."')";
    
    $result = mysqli_query($conn, $sql);
    
    if (!empty($result)) {
        $affectedRow ++;
    } else {
        $error_message = mysqli_error($conn) . "n";
    }
    
}
?>
<h2>Insert XML Data to MySql Table Output</h2>
<?php

if ($affectedRow > 0) {
    $message = $affectedRow . " records inserted";
} else {
    $message = "No records inserted";
}

?>

<?php //insertarXML(totalVariables, variables["nombres"], fichero);?>