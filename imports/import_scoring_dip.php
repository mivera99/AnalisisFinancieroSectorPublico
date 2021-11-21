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
$path = "../files/BLOQUE_GENERAL_DIP_202109.xlsx";
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

$hoja2 = $doc->getSheet(2);

//Última fila con datos
$filas = $hoja2->getHighestDataRow();//Número
echo $filas."<br>";
$columnas = $hoja2->getHighestDataColumn();//Letra, hay que convertirlo a numero
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
$fields=array();
for($i = 1; $i <= $filas; $i++){
    for($j = 1; $j <= $columnas; $j++){
        $value = $hoja2->getCellByColumnAndRow($j,$i);
        $value = preg_replace('/\s+/',' ', html_entity_decode(preg_replace('/_x([0-9a-fA-F]{4})_/', '&#x$1;', $value)));
        if($i>1)
            $vals[$j-1]=$value;
        else
            $fields[$j-1]=$value;
    }
    if($i>1 && $vals[0]!= ""){ //Para evitar filas vacías
        $COD_DIP=$vals[0];
        for($k=1;$k<count($fields);$k++){
            if($k>=1 && $k<53){
                $value=$vals[$k]; //Obtenemos el dato
                excelDecimalTranslation($value); // transformamos en decimal
                $arrayStr=explode('_',$fields[$k]);
                $tipo='';
                $year='';
                if(count($arrayStr)==3){
                    $tipo = $arrayStr[0].'_'.$arrayStr[1];
                    $year = $arrayStr[2];
                }
                else{
                    $tipo = $arrayStr[0];
                    $year = $arrayStr[1];
                }
            }
            else if($k>=53){
                $value = addslashes($vals[$k]); // Guardamos el valor de la columna
                // Posteriormente este nombre del Excel se puede sustituir por el nombre del archivo que incluya el usuario como input
                $strArray = explode('_',(explode('.','BLOQUE_GENERAL_DIP_202109.xlsx'))[0]); // Extraemos el año del título del Excel
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
            }
            if($year!='' && $tipo!=''){
                //Consulta para averiguar si ya existe la fila 
                echo 'Nombre de field: '.$tipo.'<br>';
                echo 'Año: '.$year.'<br>';
                echo 'Valor de value: '.$value.'<br>';
                $query="SELECT CODIGO,ANHO FROM scoring_dip WHERE ANHO = '$year' AND CODIGO='$COD_DIP'";
                $result= mysqli_query($conn,$query);
                if(!$result){
                    echo mysqli_error($conn);
                }
                if(mysqli_num_rows($result)==0){
                    //Si la fila no existe, lo inserta por primera vez en la BBDD
                    $insert="INSERT INTO scoring_dip (CODIGO,ANHO,$tipo) VALUES ('$COD_DIP','$year',NULLIF('$value',''))";
                    $result = mysqli_query($conn,$insert);
                }
                else {
                    //Si ya existe, entonces se actualiza con el nuevo valor dado en el excel
                    $update = "UPDATE scoring_dip SET $tipo = NULLIF('$value','') WHERE ANHO = '$year' AND CODIGO = '$COD_DIP'";
                    $result = mysqli_query($conn, $update);
                }
                //Si alguna de las 2 consultas anteriores, ya sea inserción o actualización, da error, entonces me muestra el mensaje de error
                if(!$result){
                    echo mysqli_error($conn);
                }
            }
        }
        /*//Recogemos los valores en string
        $R1_2020= $vals[1];
        $R2_2020=$vals[2];
        $R3_2020=$vals[3];
        $R4_2020=$vals[4];
        $R5_2020=$vals[5];
        $R6_2020=$vals[6];
        $R7_2020=$vals[7];
        $R8_2020= $vals[8];
        $R9_2020= $vals[9];
        $R10_2020= $vals[10];
        $R11_2020= $vals[11];
        $R12_2020= $vals[12];
        $R13_2020= $vals[13];
        $R1_2019= $vals[14];
        $R2_2019= $vals[15];
        $R3_2019= $vals[16];
        $R4_2019= $vals[17];
        $R5_2019= $vals[18];
        $R6_2019= $vals[19];
        $R7_2019= $vals[20];
        $R8_2019= $vals[21];
        $R9_2019= $vals[22];
        $R10_2019= $vals[23];
        $R11_2019= $vals[24];
        $R12_2019= $vals[25];
        $R13_2019= $vals[26];

        $R1_NAC_2020= $vals[27];
        $R2_NAC_2020= $vals[28];
        $R3_NAC_2020= $vals[29];
        $R4_NAC_2020= $vals[30];
        $R5_NAC_2020= $vals[31];
        $R6_NAC_2020= $vals[32];
        $R7_NAC_2020= $vals[33];
        $R8_NAC_2020= $vals[34];
        $R9_NAC_2020= $vals[35];
        $R10_NAC_2020= $vals[36];
        $R11_NAC_2020= $vals[37];
        $R12_NAC_2020= $vals[38];
        $R13_NAC_2020= $vals[39];
        $R1_NAC_2019= $vals[40];
        $R2_NAC_2019= $vals[41];
        $R3_NAC_2019= $vals[42];
        $R4_NAC_2019= $vals[43];
        $R5_NAC_2019= $vals[44];
        $R6_NAC_2019= $vals[45];
        $R7_NAC_2019= $vals[46];
        $R8_NAC_2019= $vals[47];
        $R9_NAC_2019= $vals[48];
        $R10_NAC_2019= $vals[49];
        $R11_NAC_2019= $vals[50];
        $R12_NAC_2019= $vals[51];
        $R13_NAC_2019= $vals[52];

        
        //Traducimos de decimal excel a decimal PHP y MySQL
        
        excelDecimalTranslation($R1_2020);
        excelDecimalTranslation($R2_2020);
        excelDecimalTranslation($R3_2020);
        excelDecimalTranslation($R4_2020);
        excelDecimalTranslation($R5_2020);
        excelDecimalTranslation($R6_2020);
        excelDecimalTranslation($R7_2020);
        excelDecimalTranslation($R8_2020);
        excelDecimalTranslation($R9_2020);
        excelDecimalTranslation($R10_2020);
        excelDecimalTranslation($R11_2020);
        excelDecimalTranslation($R12_2020);
        excelDecimalTranslation($R13_2020);

        excelDecimalTranslation($R1_2019);
        excelDecimalTranslation($R2_2019);
        excelDecimalTranslation($R3_2019);
        excelDecimalTranslation($R4_2019);
        excelDecimalTranslation($R5_2019);
        excelDecimalTranslation($R6_2019);
        excelDecimalTranslation($R7_2019);
        excelDecimalTranslation($R8_2019);
        excelDecimalTranslation($R9_2019);
        excelDecimalTranslation($R10_2019);
        excelDecimalTranslation($R11_2019);
        excelDecimalTranslation($R12_2019);
        excelDecimalTranslation($R13_2019);
        
        excelDecimalTranslation($R1_NAC_2020);
        excelDecimalTranslation($R2_NAC_2020);
        excelDecimalTranslation($R3_NAC_2020);
        excelDecimalTranslation($R4_NAC_2020);
        excelDecimalTranslation($R5_NAC_2020);
        excelDecimalTranslation($R6_NAC_2020);
        excelDecimalTranslation($R7_NAC_2020);
        excelDecimalTranslation($R8_NAC_2020);
        excelDecimalTranslation($R9_NAC_2020);
        excelDecimalTranslation($R10_NAC_2020);
        excelDecimalTranslation($R11_NAC_2020);
        excelDecimalTranslation($R12_NAC_2020);
        excelDecimalTranslation($R13_NAC_2020);

        excelDecimalTranslation($R1_NAC_2019);
        excelDecimalTranslation($R2_NAC_2019);
        excelDecimalTranslation($R3_NAC_2019);
        excelDecimalTranslation($R4_NAC_2019);
        excelDecimalTranslation($R5_NAC_2019);
        excelDecimalTranslation($R6_NAC_2019);
        excelDecimalTranslation($R7_NAC_2019);
        excelDecimalTranslation($R8_NAC_2019);
        excelDecimalTranslation($R9_NAC_2019);
        excelDecimalTranslation($R10_NAC_2019);
        excelDecimalTranslation($R11_NAC_2019);
        excelDecimalTranslation($R12_NAC_2019);
        excelDecimalTranslation($R13_NAC_2019);



        $RATING_N_1=$vals[53];
        $TENDENCIA_N_1=$vals[54];
        $RATING_N=$vals[55];
        $TENDENCIA_N=$vals[56];
        $query="INSERT INTO scoring_dip VALUES ('$COD_DIP',NULLIF('$R1_2020',''), NULLIF('$R2_2020',''), NULLIF('$R3_2020',''),
        NULLIF('$R4_2020',''), NULLIF('$R5_2020',''), NULLIF('$R6_2020',''), NULLIF('$R7_2020',''), NULLIF('$R8_2020',''), NULLIF('$R9_2020',''), NULLIF('$R10_2020',''), NULLIF('$R11_2020',''), NULLIF('$R12_2020',''),
        NULLIF('$R13_2020',''), NULLIF('$R1_2019',''), NULLIF('$R2_2019',''), NULLIF('$R3_2019',''), NULLIF('$R4_2019',''), NULLIF('$R5_2019',''), NULLIF('$R6_2019',''), NULLIF('$R7_2019',''), NULLIF('$R8_2019',''),
        NULLIF('$R9_2019',''), NULLIF('$R10_2019',''), NULLIF('$R11_2019',''), NULLIF('$R12_2019',''), NULLIF('$R13_2019',''), NULLIF('$R1_NAC_2020',''), NULLIF('$R2_NAC_2020',''),
        NULLIF('$R3_NAC_2020',''), NULLIF('$R4_NAC_2020',''), NULLIF('$R5_NAC_2020',''), NULLIF('$R6_NAC_2020',''), NULLIF('$R7_NAC_2020',''), NULLIF('$R8_NAC_2020',''), NULLIF('$R9_NAC_2020',''),
        NULLIF('$R10_NAC_2020',''), NULLIF('$R11_NAC_2020',''), NULLIF('$R12_NAC_2020',''), NULLIF('$R13_NAC_2020',''), NULLIF('$R1_NAC_2019',''), NULLIF('$R2_NAC_2019',''),
        NULLIF('$R3_NAC_2019',''), NULLIF('$R4_NAC_2019',''), NULLIF('$R5_NAC_2019',''), NULLIF('$R6_NAC_2019',''), NULLIF('$R7_NAC_2019',''), NULLIF('$R8_NAC_2019',''), NULLIF('$R9_NAC_2019',''),
        NULLIF('$R10_NAC_2019',''), NULLIF('$R11_NAC_2019',''), NULLIF('$R12_NAC_2019',''), NULLIF('$R13_NAC_2019',''), NULLIF('$RATING_N_1',''), NULLIF('$TENDENCIA_N_1',''), NULLIF('$RATING_N',''), NULLIF('$TENDENCIA_N',''))";
        

        $res=mysqli_query($conn,$query);
        if (!empty($res)) {
            //$affectedRow ++;
        } else {
            echo mysqli_error($conn);
            $error_message = mysqli_error($conn) . "n";
            echo "<br>";
        }
        */
        $vals = array();
    }
}

/*$sql = "SELECT * FROM scoring_dip";

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
*/
mysqli_close($conn);
?>

</body>
</html>