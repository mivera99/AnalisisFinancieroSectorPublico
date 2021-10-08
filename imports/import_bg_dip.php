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
$path = "../files/BLOQUE_GENERAL_DIP.xlsx";
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
$conn->set_charset("utf8");
$values=array();


//Función convertir dato string de un decimal en Excel (con ",") a float para PHP y MySQL
function excelDecimalTranslation(&$var) {
    //Cambiamos las "," por "."
    //En Excel se usa la "," para separar los decimales
    //En SQL se usa el "." para separar decimales
    //Seguimos teniendo un dato string
    $var = str_replace(',', '.', $var);
    //Convertimos el string en float
    $var = (float)$var;
}


for($x = 1; $x < $rows + 1; $x++){


    for($y = 1; $y <= $cols; $y++){

        $valor = $hoja->getCellByColumnAndRow($y,$x);
        //Para eliminar espacios vacios y enters
        $valor = preg_replace('/\s+/',' ', html_entity_decode(preg_replace('/_x([0-9a-fA-F]{4})_/', '&#x$1;', $valor)));
        if($x>1)
            $values[$y-1]=$valor;
    }
    if($x>1 && $values[0]!= "") {

        $CODIGO_DIP = addslashes($values[0]);
        $DIPUTACION = addslashes($values[1]);
        $CIF = addslashes($values[2]);
        $TIPOVIA = addslashes($values[3]);
        $NOMBREVIA = addslashes($values[4]);
        $NUMVIA = addslashes($values[5]);
        $CODPOSTAL = $values[6];
        $PROVINCIA = addslashes($values[7]);
        $AUTONOMIA = addslashes($values[8]);
        $TELEFONO = $values[9];
        $FAX = $values[10];
        $WEB = addslashes($values[11]);
        $MAIL = addslashes($values[12]);
        $INGRESOS_2020 = $values[13];
        $INGRESOS_2019 = $values[14];
        $FONDLIQUIDOS_2020 = $values[15];
        $FONDLIQUIDOS_2019 = $values[16];
        $DERPENDCOBRO_2020 = $values[17];
        $DERPENDCOBRO_2019 = $values[18];
        $DEUDACOM_2020 = $values[19];
        $DEUDACOM_2019 = $values[20];
        $DEUDAFIN_2020 = $values[21];
        $DEUDAFIN_2019 = $values[22];
        $LIQUAJUST_2020 = $values[23];
        $LIQUAJUST_2019 = $values[24];
        $INGRESOSCORR_2020 = $values[25];
        $INGRESOSCORR_2019 = $values[26];
        $GASTOCORR_2020 = $values[27];
        $GASTOCORR_2019 = $values[28];



        $sql = "INSERT INTO bloque_general_dip VALUES ('$CODIGO_DIP','$DIPUTACION','$CIF','$TIPOVIA','$NOMBREVIA','$NUMVIA','$CODPOSTAL','$PROVINCIA','$AUTONOMIA',
        '$TELEFONO','$FAX','$WEB','$MAIL','$INGRESOS_2020','$INGRESOS_2019','$FONDLIQUIDOS_2020','$FONDLIQUIDOS_2019','$DERPENDCOBRO_2020','$DERPENDCOBRO_2019',
        '$DEUDACOM_2020','$DEUDACOM_2019','$DEUDAFIN_2020','$DEUDAFIN_2019','$LIQUAJUST_2020','$LIQUAJUST_2019','$INGRESOSCORR_2020','$INGRESOSCORR_2019','$GASTOCORR_2020','$GASTOCORR_2019')";

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




$sql = "SELECT * FROM bloque_general_dip";

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