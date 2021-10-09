<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importación de datos de Excel</title>
</head>
<body>
    
<?php

//Aumentamos la memoria de PHP para poder cargar la burrada de datos que tenemos
ini_set('memory_limit', '2G');
ini_set("default_charset", "UTF-8");


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

//Recorrido por hojas...
/*
for($i = 0; $i < $totalHojas; $i++){
    $hoja = $doc->getSheet($i);
}
*/

$hoja = $doc->getSheet(2);

//Última fila con datos
$filas = $hoja->getHighestDataRow();//Número
echo $filas."<br>";
$columnas = $hoja->getHighestDataColumn();//Letra, hay que convertirlo a numero
echo $columnas."<br>";
$columnas = Coordinate::columnIndexFromString($columnas);//Conversion a numero
echo $columnas.'<br>';

$conn = new mysqli("db5005176895.hosting-data.io", "dbu1879501", "ij1YGZo@gIEKAJ#&PcCXpHR0o", "dbs4330017");
$conn->set_charset("utf8");



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




$vals=array();
for($i = 2; $i <= $filas; $i++){
    for($j = 1; $j <= $columnas; $j++){
        $value = $hoja->getCellByColumnAndRow($j,$i);
        $value = preg_replace('/\s+/',' ', html_entity_decode(preg_replace('/_x([0-9a-fA-F]{4})_/', '&#x$1;', $value)));
        $vals[$j-1]=$value;
    }
    echo $CIF = addslashes($vals[0]);
    echo $CODIGO_CCAA = $vals[1];
    echo $NOMBRE_CCAA = addslashes($vals[2]);
    echo $RATING_N_1 = addslashes($vals[3]);
    echo $TENDENCIA_N_1=addslashes($vals[4]);
    echo $RATING_N = addslashes($vals[5]);
    echo $TENDENCIA_N = addslashes($vals[6]);
    echo "<br>";


    $query="INSERT INTO scoring_ccaa VALUES ('$CIF','$CODIGO_CCAA','$NOMBRE_CCAA','$RATING_N_1','$TENDENCIA_N_1','$RATING_N','$TENDENCIA_N')";

    $res=mysqli_query($conn,$query);
    if (!empty($res)) {
        //$affectedRow ++;
    } else {
        echo mysqli_error($conn);
        $error_message = mysqli_error($conn) . "n";
    }
    echo "<br><br>";
    $vals = array();
}

$sql = "SELECT * FROM scoring_ccaa ORDER BY CODIGO_CCAA";

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




mysqli_close($conn);
?>


</body>
</html>