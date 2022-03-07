<?php
require_once("includesWeb/config.php");
require_once('imports/configFile.php');

//Aumentamos la memoria de PHP para poder cargar la burrada de datos que tenemos
/*ini_set('memory_limit', '2G');
ini_set("default_charset", "UTF-8");
ini_set('max_execution_time', 1200);
*/
/*
Importar libreria PHPSpreadsheet
*/

/*require "../includes/vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;

//Path del archivo
$path = "../files/BLOQUE_GENERAL_MUN_202109.xlsx";
//Cargamos el archivo en la variable de documento "doc"
$doc = IOFactory::load($path);

//Número total de hojas
$totalHojas = $doc->getSheetCount();
*/
//Recorrido por hojas...
/*
for($i = 0; $i < $totalHojas; $i++){
    $hoja = $doc->getSheet($i);
}
*/
/*
$hoja = $doc->getSheet(2);

//Última fila con datos
$rows = $hoja->getHighestDataRow();//Número
echo $rows."<br>";
$cols = $hoja->getHighestDataColumn();//Letra, hay que convertirlo a numero
echo $cols."<br>";
$cols = Coordinate::columnIndexFromString($cols);//Conversion a numero
echo $cols.'<br>';

$conn = getConexionBD();//new mysqli("localhost", "root", "", "dbs_01");
//$conn = new mysqli("localhost", "root", "", "dbs_01");
$conn->set_charset("utf8");
*/

require("includes/vendor/autoload.php");
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;
class Importer_scoring_mun{

    //Función convertir dato string de un decimal en Excel (con ",") a float para PHP y MySQL
    private function excelDecimalTranslation(&$var) {
        //Cambiamos las "," por "."
        //En Excel se usa la "," para separar los decimales
        //En SQL se usa el "." para separar decimales
        //Seguimos teniendo un dato string
        $var = str_replace(',', '.', $var);
        //Convertimos el string en float
        $var = (float)$var;
    }

    public function import_scoring_mun($filename,$realname){
        $path = $filename;
        $doc = IOFactory::load($path);

        $hoja = $doc->getSheet(2);
        $vals=array();
        $fields=array();

        $rows = $hoja->getHighestDataRow();
        $cols = $hoja->getHighestDataColumn();
        $cols = Coordinate::columnIndexFromString($cols);

        $conn = getConexionBD();

        for($i = 1; $i <= $rows; $i++){
            for($j = 1; $j <= $cols; $j++){
                $value = $hoja->getCellByColumnAndRow($j,$i);
                $value = preg_replace('/\s+/',' ', html_entity_decode(preg_replace('/_x([0-9a-fA-F]{4})_/', '&#x$1;', $value)));
                if($i>1)
                    $vals[$j-1]=$value;
                else
                    $fields[$j-1]=$value;
            }
            if($i>1 && $vals[0]!= "") {
                $COD_MUN=$vals[0];
                for($k=3;$k<count($fields);$k++){
                    if($k>=3 && $k<55){
                        $value=$vals[$k]; //Obtenemos el dato
                        $this->excelDecimalTranslation($value); // transformamos en decimal
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
                        /*if($year!='' && $tipo!=''){
                            //Consulta para averiguar si ya existe la fila 
                            $query="SELECT CODIGO,ANHO FROM scoring_mun WHERE ANHO = '$year' AND CODIGO='$COD_MUN'";
                            $result= mysqli_query($conn,$query);
                            if(!$result){
                                echo mysqli_error($conn);
                            }
                            if(mysqli_num_rows($result)==0){
                                //Si la fila no existe, lo inserta por primera vezz en la BBDD
                                $insert="INSERT INTO scoring_mun(CODIGO,ANHO,$tipo) VALUES ('$COD_MUN','$year',NULLIF('$value',''))";
                                $result = mysqli_query($conn,$insert);
                            }
                            else {
                                //Si ya existe, entonces se actualiza con el nuevo valor dado en el excel
                                $update = "UPDATE scoring_mun SET $tipo = NULLIF('$value','') WHERE ANHO = '$year' AND CODIGO = '$COD_MUN'";
                                $result = mysqli_query($conn, $update);
                            }
                            //Si alguna de las 2 consultas anteriores, ya sea inserción o actualización, da error, entonces me muestra el mensaje de error
                            if(!$result){
                                echo mysqli_error($conn);
                            }
                        }*/
                    }
                    else if($k>=55){
                        $value = addslashes($vals[$k]); // Guardamos el valor de la columna
                        // Posteriormente este nombre del Excel se puede sustituir por el nombre del archivo que incluya el usuario como input
                        $strArray = explode('_',(explode('.',$realname))[0]); // Extraemos el año del título del Excel
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
                        /*
                        //Consulta para averiguar si ya existe la fila 
                        $query="SELECT CODIGO,ANHO FROM scoring_mun WHERE ANHO = '$year' AND CODIGO='$COD_MUN'";
                        $result= mysqli_query($conn,$query);
                        if(!$result){
                            echo mysqli_error($conn);
                        }
                        if(mysqli_num_rows($result)==0){
                            //Si la fila no existe, lo inserta por primera vezz en la BBDD
                            $insert="INSERT INTO scoring_mun(CODIGO,ANHO,$tipo) VALUES ('$COD_MUN','$year',NULLIF('$value',''))";
                            $result = mysqli_query($conn,$insert);
                        }
                        else {
                            //Si ya existe, entonces se actualiza con el nuevo valor dado en el excel
                            $update = "UPDATE scoring_mun SET $tipo = NULLIF('$value','') WHERE ANHO = '$year' AND CODIGO = '$COD_MUN'";
                            $result = mysqli_query($conn, $update);
                        }
                        //Si alguna de las 2 consultas anteriores, ya sea inserción o actualización, da error, entonces me muestra el mensaje de error
                        if(!$result){
                            echo mysqli_error($conn);
                        }*/
                    }
                    if($year!='' && $tipo!=''){
                        //Consulta para averiguar si ya existe la fila 
                        $query="SELECT CODIGO,ANHO FROM scoring_mun WHERE ANHO = '$year' AND CODIGO='$COD_MUN'";
                        $result= mysqli_query($conn,$query);
                        if(!$result){
                            echo mysqli_error($conn);
                            return false;
                        }
                        if(mysqli_num_rows($result)==0){
                            //Si la fila no existe, lo inserta por primera vez en la BBDD
                            $insert="INSERT INTO scoring_mun(CODIGO,ANHO,$tipo) VALUES ('$COD_MUN','$year',NULLIF('$value',''))";
                            $result = mysqli_query($conn,$insert);
                        }
                        else {
                            //Si ya existe, entonces se actualiza con el nuevo valor dado en el excel
                            $update = "UPDATE scoring_mun SET $tipo = NULLIF('$value','') WHERE ANHO = '$year' AND CODIGO = '$COD_MUN'";
                            $result = mysqli_query($conn, $update);
                        }
                        //Si alguna de las 2 consultas anteriores, ya sea inserción o actualización, da error, entonces me muestra el mensaje de error
                        if(!$result){
                            echo mysqli_error($conn);
                            return false;
                        }
                    }
                }

                //Recogemos los valores en string
                /*$R1_2020= $vals[3];
                $R2_2020=$vals[4];
                $R3_2020=$vals[5];
                $R4_2020=$vals[6];
                $R5_2020=$vals[7];
                $R6_2020=$vals[8];
                $R7_2020=$vals[9];
                $R8_2020= $vals[10];
                $R9_2020= $vals[11];
                $R10_2020= $vals[12];
                $R11_2020= $vals[13];
                $R12_2020= $vals[14];
                $R13_2020= $vals[15];
                $R1_2019= $vals[16];
                $R2_2019= $vals[17];
                $R3_2019= $vals[18];
                $R4_2019= $vals[19];
                $R5_2019= $vals[20];
                $R6_2019= $vals[21];
                $R7_2019= $vals[22];
                $R8_2019= $vals[23];
                $R9_2019= $vals[24];
                $R10_2019= $vals[25];
                $R11_2019= $vals[26];
                $R12_2019= $vals[27];
                $R13_2019= $vals[28];

                $R1_NAC_2020= $vals[29];
                $R2_NAC_2020= $vals[30];
                $R3_NAC_2020= $vals[31];
                $R4_NAC_2020= $vals[32];
                $R5_NAC_2020= $vals[33];
                $R6_NAC_2020= $vals[34];
                $R7_NAC_2020= $vals[35];
                $R8_NAC_2020= $vals[36];
                $R9_NAC_2020= $vals[37];
                $R10_NAC_2020= $vals[38];
                $R11_NAC_2020= $vals[39];
                $R12_NAC_2020= $vals[40];
                $R13_NAC_2020= $vals[41];
                $R1_NAC_2019= $vals[42];
                $R2_NAC_2019= $vals[43];
                $R3_NAC_2019= $vals[44];
                $R4_NAC_2019= $vals[45];
                $R5_NAC_2019= $vals[46];
                $R6_NAC_2019= $vals[47];
                $R7_NAC_2019= $vals[48];
                $R8_NAC_2019= $vals[49];
                $R9_NAC_2019= $vals[50];
                $R10_NAC_2019= $vals[51];
                $R11_NAC_2019= $vals[52];
                $R12_NAC_2019= $vals[53];
                $R13_NAC_2019= $vals[54];

                
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
                */


                /*$RATING_N_1=$vals[55];
                $TENDENCIA_N_1=$vals[56];
                $RATING_N=$vals[57];
                $TENDENCIA_N=$vals[58];
                $query="INSERT INTO scoring_mun VALUES ('$COD_MUN','$CIF_MUN','$MUN', NULLIF('$R1_2020',''), NULLIF('$R2_2020',''), NULLIF('$R3_2020',''),
                NULLIF('$R4_2020',''), NULLIF('$R5_2020',''), NULLIF('$R6_2020',''), NULLIF('$R7_2020',''), NULLIF('$R8_2020',''), NULLIF('$R9_2020',''), NULLIF('$R10_2020',''), NULLIF('$R11_2020',''), NULLIF('$R12_2020',''),
                NULLIF('$R13_2020',''), NULLIF('$R1_2019',''), NULLIF('$R2_2019',''), NULLIF('$R3_2019',''), NULLIF('$R4_2019',''), NULLIF('$R5_2019',''), NULLIF('$R6_2019',''), NULLIF('$R7_2019',''), NULLIF('$R8_2019',''),
                NULLIF('$R9_2019',''), NULLIF('$R10_2019',''), NULLIF('$R11_2019',''), NULLIF('$R12_2019',''), NULLIF('$R13_2019',''), NULLIF('$R1_NAC_2020',''), NULLIF('$R2_NAC_2020',''),
                NULLIF('$R3_NAC_2020',''), NULLIF('$R4_NAC_2020',''), NULLIF('$R5_NAC_2020',''), NULLIF('$R6_NAC_2020',''), NULLIF('$R7_NAC_2020',''), NULLIF('$R8_NAC_2020',''), NULLIF('$R9_NAC_2020',''),
                NULLIF('$R10_NAC_2020',''), NULLIF('$R11_NAC_2020',''), NULLIF('$R12_NAC_2020',''), NULLIF('$R13_NAC_2020',''), NULLIF('$R1_NAC_2019',''), NULLIF('$R2_NAC_2019',''),
                NULLIF('$R3_NAC_2019',''), NULLIF('$R4_NAC_2019',''), NULLIF('$R5_NAC_2019',''), NULLIF('$R6_NAC_2019',''), NULLIF('$R7_NAC_2019',''), NULLIF('$R8_NAC_2019',''), NULLIF('$R9_NAC_2019',''),
                NULLIF('$R10_NAC_2019',''), NULLIF('$R11_NAC_2019',''), NULLIF('$R12_NAC_2019',''), NULLIF('$R13_NAC_2019',''), NULLIF('$RATING_N_1',''), NULLIF('$TENDENCIA_N_1',''), NULLIF('$RATING_N',''), NULLIF('$TENDENCIA_N',''))";

                $result=mysqli_query($conn,$query);
                if (!$result) {
                    echo mysqli_error($conn);
                }*/
                $vals = array();
            }
        }
        //cierraConexion();

        return true;
    }

}

?>
