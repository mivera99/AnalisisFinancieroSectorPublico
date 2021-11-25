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
$path = "../files/BLOQUE_GENERAL_CCAA_202109.xlsx";
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

$conn = new mysqli("localhost", "root", "", "dbs_01");
//$conn = new mysqli("db5005176895.hosting-data.io", "dbu1879501", "ij1YGZo@gIEKAJ#&PcCXpHR0o", "dbs4330017");
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
$fields = array();
for($i = 1; $i < $filas+1; $i++){
    for($j = 1; $j <= $columnas; $j++){
        $value = $hoja->getCellByColumnAndRow($j,$i);
        $value = preg_replace('/\s+/',' ', html_entity_decode(preg_replace('/_x([0-9a-fA-F]{4})_/', '&#x$1;', $value)));
        if($i>1)
            $vals[$j-1]=$value;
        else
            $fields[$j-1]=$value;
    }
    if($i>1 && $vals[0]!=""){
        $CODIGO_CCAA=$vals[1];
        //Se comienza a leer todas las filas. Se empieza desde la columna 3 porque es donde empieza la información que queremos guardar en la BBDD. 
        for($k=0;$k<count($fields);$k++){
            if($k>=3){
                $value = addslashes($vals[$k]); // Guardamos el valor de la columna
                // Posteriormente este nombre del Excel se puede sustituir por el nombre del archivo que incluya el usuario como input
                $strArray = explode('_',(explode('.','BLOQUE_GENERAL_CCAA_202109.xlsx'))[0]); // Extraemos el año del título del Excel
                $fieldStr= explode('_',$fields[$k]); //Más tarde revisar si el tamaño de fields es 2, sino lanzar error
                /*Por defecto, guardamos el año en el que se crea el Excel,
                es decir, el año que está contenida en el título del archivo Excel*/ 
                $year=intval(intval($strArray[3])/100); 
                $tipo=$fieldStr[0]; // Guardamos el nombre de la columna
                if($fieldStr[1]=='N-1'){
                    /* Si la columna donde nos encontramos contiene el string 'N-1', entonces restamos -1 al año del título del Excel y lo guardamos 
                    en la variable. El año se encuentra en la tercera posición del sarray strArray*/
                    $year=$year-1;
                }

                //Consulta para averiguar si ya existe la fila 
                $query="SELECT CODIGO,ANHO FROM scoring_ccaa WHERE ANHO = '$year' AND CODIGO='$CODIGO_CCAA'";
                $result= mysqli_query($conn,$query);
                if(!$result){
                    echo mysqli_error($conn);
                }
                if(mysqli_num_rows($result)==0){
                    //Si la fila no existe, lo inserta por primera vezz en la BBDD
                    $insert="INSERT INTO scoring_ccaa(CODIGO,ANHO,$tipo) VALUES ('$CODIGO_CCAA','$year',NULLIF('$value',''))";
                    $result = mysqli_query($conn,$insert);
                }
                else {
                    //Si ya existe, entonces se actualiza con el nuevo valor dado en el excel
                    $update = "UPDATE scoring_ccaa SET $tipo = NULLIF('$value','') WHERE ANHO = '$year' AND CODIGO = '$CODIGO_CCAA'";
                    $result = mysqli_query($conn, $update);
                }
                //Si alguna de las 2 consultas anteriores, ya sea inserción o actualización, da error, entonces me muestra el mensaje de error
                if(!$result){
                    echo mysqli_error($conn);
                }
            }
        }
        $vals = array();
    }
}
mysqli_close($conn);
?>

</body>
</html>