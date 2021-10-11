<?php

//Aumentamos la memoria de PHP para poder cargar la burrada de datos que tenemos
ini_set('memory_limit', '1G');
ini_set("default_charset", "UTF-8");
ini_set('max_execution_time', 200);

/*
Importar libreria PHPSpreadsheet
*/

require "../includes/vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;

//Path del archivo
$path = "../files/BLOQUE_GENERAL_CCAA.xlsx";
//Cargamos el archivo en la variable de documento "doc"
$doc = IOFactory::load($path);

//Número total de hojas
$totalHojas = $doc->getSheetCount();

$hoja = $doc->getSheet(0);

//Última fila con datos
$rows = $hoja->getHighestDataRow();//Número
echo $rows."<br>";
$cols = $hoja->getHighestDataColumn();//Letra, hay que convertirlo a numero
echo $cols."<br>";
$cols = Coordinate::columnIndexFromString($cols);//Conversion a numero
echo $cols."<br>";


$conn = new mysqli("localhost", "root", "", "dbs_01");
//$conn = new mysqli("db5005176895.hosting-data.io", "dbu1879501", "ij1YGZo@gIEKAJ#&PcCXpHR0o", "dbs4330017");
$conn->set_charset("utf8");
$values=array();


for($x = 1; $x < $rows + 1; $x++){


    for($y = 1; $y <= $cols; $y++){

        $valor = $hoja->getCellByColumnAndRow($y,$x);
        //Para eliminar espacios vacios y enters
        $valor = preg_replace('/\s+/',' ', html_entity_decode(preg_replace('/_x([0-9a-fA-F]{4})_/', '&#x$1;', $valor)));
        if($x>1)
            $values[$y-1]=$valor;
    }
    if($x>1 && $values[0]!= "") {

        $CODIGO_CCAA = $values[0];
        $NOMBRE_CCAA = addslashes($values[1]);
        $POBLACION_2017 = $values[2];
        $NOMBREPRESIDENTE = addslashes($values[3]);
        $APELLIDO1PRESIDENTE = addslashes($values[4]);
        $APELLIDO2PRESIDENTE = addslashes($values[5]);

        if($values[6]!=""){
            //$VIGENCIA = date_create_from_format("m-d-Y", $values[6]);
            
            //echo '<br>Dato del Excel:'.$values[6].'<br>';
            
            //$tiempo = strtotime($values[6]);
            
            //echo 'Despues del strtotime():'.$tiempo.'<br>';
            
            //$VIGENCIA = date("Y-m-d", $tiempo);
            
            //echo '<br>Valor de Vigencia:'.$VIGENCIA.'<br>';
            //$VIGENCIA=$values[6];
            
            $tiempo = date_create_from_format("d/m/Y",$values[6]);
            //echo date_format($tiempo2,"Y/m/d").'<br>';
            $VIGENCIA = date_format($tiempo,"Y/m/d");
        }
        else{
            $VIGENCIA=$values[6];
        }

        $PARTIDO = addslashes($values[7]);
        $CIF = $values[8];
        $TIPOVIA = addslashes($values[9]);
        $NOMBREVIA = addslashes($values[10]);
        $NUMVIA = $values[11];
        $CODPOSTAL = $values[12];
        $TELEFONO = $values[13];
        $FAX = $values[14];
        $WEB = $values[15];
        $MAIL = $values[16];
        $REFPIB = $values[17];
        $PIB = $values[18];
        $REFPIBC = $values[19];
        $PIBC = $values[20];
        $REFRESULTADO = $values[21];
        $RESULTADO = $values[22];
        $REFDEUDAVIVA = $values[23];
        $DEUDAVIVA = $values[24];

        $sql = "INSERT INTO bloque_general_ccaa VALUES ('$CODIGO_CCAA','$NOMBRE_CCAA',NULLIF('$POBLACION_2017',''),NULLIF('$NOMBREPRESIDENTE',''),NULLIF('$APELLIDO1PRESIDENTE',''),NULLIF('$APELLIDO2PRESIDENTE',''),
        NULLIF('$VIGENCIA',''),NULLIF('$PARTIDO',''),NULLIF('$CIF',''),NULLIF('$TIPOVIA',''),NULLIF('$NOMBREVIA',''),NULLIF('$NUMVIA',''),NULLIF('$CODPOSTAL',''),NULLIF('$TELEFONO',''),NULLIF('$FAX',''),NULLIF('$WEB',''),NULLIF('$MAIL',''),NULLIF('$REFPIB',''),NULLIF('$PIB',''),NULLIF('$REFPIBC',''),NULLIF('$PIBC',''),
        NULLIF('$REFRESULTADO',''),NULLIF('$RESULTADO',''),NULLIF('$REFDEUDAVIVA',''),NULLIF('$DEUDAVIVA',''))";
    
        $VIGENCIA=null;

        $result = mysqli_query($conn, $sql);
            if (!empty($result)) {
                //$affectedRow ++;
            } else {
                echo mysqli_error($conn);
                $error_message = mysqli_error($conn) . "n";
            }
            $values = array();
        }
}



/*

Presentamos los datos por pantalla, en formato tabla

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


?>

<?php //insertarXML(totalVariables, variables["nombres"], fichero);?>