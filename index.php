<?php
$conn = new mysqli("localhost", "root", "", "dbs_01");

//IMPORTANTE
//Para poder guardar las tildes con el cortejamiento de datos utf-8
$conn->set_charset("utf8");

$affectedRow = 0;



/*

INSERCIÓN DE LOS DATOS XML -> PHP -> MySQL



$xml = simplexml_load_file("BLOQUE_GENERAL_CCAA_EXPORT.xml") or die("Error: Cannot create object");


foreach ($xml->children() as $row) {
    $CODIGO_CCAA = $row->CODIGO_CCAA;
    $NOMBRE_CCAA = addslashes($row->NOMBRE_CCAA);
    $POBLACION_2017 = $row->POBLACION_2017;
    $NOMBREPRESIDENTE = addslashes($row->NOMBREPRESIDENTE);
    $APELLIDO1PRESIDENTE = addslashes($row->APELLIDO1PRESIDENTE);
    $APELLIDO2PRESIDENTE = addslashes($row->APELLIDO2PRESIDENTE);
    
    if($row->VIGENCIA){
        $tiempo = (string)($row->VIGENCIA);
        $tiempo2 = date_create_from_format("d/m/Y",$tiempo);
        $VIGENCIA = date_format($tiempo2,"Y/m/d");
    }
    
    $PARTIDO = addslashes($row->PARTIDO);
    $CIF = $row->CIF;
    $TIPOVIA = addslashes($row->TIPOVIA);
    $NOMBREVIA = addslashes($row->NOMBREVIA);
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


    $sql = "INSERT INTO bloque_general_ccaa(CODIGO_CCAA,NOMBRE_CCAA,POBLACION_2017,NOMBREPRESIDENTE,
    APELLIDO1PRESIDENTE, APELLIDO2PRESIDENTE, VIGENCIA, PARTIDO, CIF, TIPOVIA, NOMBREVIA, NUMVIA, 
    CODPOSTAL,TELEFONO,FAX,WEB,MAIL,REFPIB, PIB, REFPIBC, PIBC, REFRESULTADO, RESULTADO, REFDEUDAVIVA, 
    DEUDAVIVA) VALUES ('$CODIGO_CCAA','$NOMBRE_CCAA','$POBLACION_2017','$NOMBREPRESIDENTE','$APELLIDO1PRESIDENTE','$APELLIDO2PRESIDENTE',
    '$VIGENCIA','$PARTIDO','$CIF','$TIPOVIA','$NOMBREVIA','$NUMVIA','$CODPOSTAL','$TELEFONO','$FAX','$WEB','$MAIL','$REFPIB','$PIB',
    '$REFPIBC','$PIBC','$REFRESULTADO','$RESULTADO','$REFDEUDAVIVA','$DEUDAVIVA')";
    
    $VIGENCIA=null;

    $result = mysqli_query($conn, $sql);
    
    if (!empty($result)) {
        $affectedRow ++;
    } else {
        echo mysqli_error($conn);
        $error_message = mysqli_error($conn) . "n";
    }

    
}




echo("<h2>Insert XML Data to MySql Table Output</h2>");

if ($affectedRow > 0) {
    $message = $affectedRow . " records inserted";
} else {
    $message = "No records inserted";
}

echo($message);




*/



/*

Presentamos los datos por pantalla, en formato tabla

*/


/*

BLOQUE_GENERAL_CCAA

*/

$sql = "SELECT * FROM bloque_general_ccaa";

$result = mysqli_query($conn, $sql);
$columnas = mysqli_fetch_fields($result);
echo "<pre>";
echo "<table border='1'>";
foreach($columnas AS $value){
    echo "<th> $value->name </th>";
}
$all = $result->fetch_all();
for($x = 0; $x < count($all); $x++){
    echo "<tr>";

    for ($y = 0; $y < count($columnas); $y++) {
        echo "<td>".$all[$x][$y]."</td>";
    }

    echo "</tr>";
}

/*

*/
?>

<?php //insertarXML(totalVariables, variables["nombres"], fichero);?>