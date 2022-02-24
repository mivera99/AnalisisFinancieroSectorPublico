<?php
//require("includesWeb/config.php");
require("configFile.php");
//Aumentamos la memoria de PHP para poder cargar la burrada de datos que tenemos
/*ini_set('memory_limit', '1G');
ini_set("default_charset", "UTF-8");
ini_set('max_execution_time', 1200);
*/
/*
Importar libreria PHPSpreadsheet
*/
/*
require "../includes/vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;

//Path del archivo
$path = "../files/BLOQUE_GENERAL_CCAA_202109.xlsx";
//Cargamos el archivo en la variable de documento "doc"
//$path = $_FILES['file_button']['tmp_name'];
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

$conn = getConexionBD();//new mysqli("localhost", "root", "", "dbs_01");
//$conn = new mysqli("localhost", "root", "", "dbs_01");
$conn->set_charset("utf8");
$values=array();
$fields=array();
*/

//require "../includes/vendor/autoload.php";
require("includes/vendor/autoload.php");
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;
class Importer_bg_ccaa{

    
    public function import_bg_ccaa($filename){ //=null para PHP 7.X


        //Path del archivo
        //$path = "../files/BLOQUE_GENERAL_CCAA_202109.xlsx";
        //Cargamos el archivo en la variable de documento "doc"
        $path = $filename;
        $doc = IOFactory::load($path);

        $hoja = $doc->getSheet(0);

        $rows = $hoja->getHighestDataRow();
        $cols = $hoja->getHighestDataColumn();
        $cols = Coordinate::columnIndexFromString($cols);


        $conn = getConexionBD();

        for($x = 1; $x < $rows + 1; $x++){

            for($y = 1; $y <= $cols; $y++){

                $valor = $hoja->getCellByColumnAndRow($y,$x);
                //Para eliminar espacios vacios y enters (limpieza de caracteres del archivo excel)
                $valor = preg_replace('/\s+/',' ', html_entity_decode(preg_replace('/_x([0-9a-fA-F]{4})_/', '&#x$1;', $valor)));
                if($x>1)
                    $values[$y-1]=$valor;
                else
                    $fields[$y-1]=strtoupper($valor); 
            }
            if($x>1 && $values[0]!= "") {

                $CODIGO_CCAA = $values[0];
                $NOMBRE_CCAA = addslashes($values[1]);

                $NOMBREPRESIDENTE = addslashes($values[3]);
                $APELLIDO1PRESIDENTE = addslashes($values[4]);
                $APELLIDO2PRESIDENTE = addslashes($values[5]);

                if($values[6]!=""){
                    $tiempo = date_create_from_format("d/m/Y",$values[6]);
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
                $sql = "SELECT CODIGO FROM ccaas WHERE CODIGO='$CODIGO_CCAA'";
                $result = mysqli_query($conn,$sql);
                if(!$result){
                    echo mysqli_error($conn);
                    return false;
                }
                if(mysqli_num_rows($result)==0){
                    $insert = "INSERT INTO ccaas VALUES ('$CODIGO_CCAA','$NOMBRE_CCAA',NULLIF('$NOMBREPRESIDENTE',''),NULLIF('$APELLIDO1PRESIDENTE',''),NULLIF('$APELLIDO2PRESIDENTE',''),
                        NULLIF('$VIGENCIA',''),NULLIF('$PARTIDO',''),NULLIF('$CIF',''),NULLIF('$TIPOVIA',''),NULLIF('$NOMBREVIA',''),NULLIF('$NUMVIA',''),NULLIF('$CODPOSTAL',''),NULLIF('$TELEFONO',''),NULLIF('$FAX',''),
                        NULLIF('$WEB',''),NULLIF('$MAIL',''))";
                    if (!mysqli_query($conn, $insert)) {
                        echo mysqli_error($conn);
                        return false;
                    }
                }
                else {
                    //si ya existe la fila, entonces se actualiza el valor del campo con el nuevo valor dado del documento ($value)
                    $update = "UPDATE ccaas SET NOMBRE = NULLIF('$NOMBRE_CCAA',''), NOMBRE_PRESIDENTE = NULLIF('$NOMBREPRESIDENTE',''), APELLIDO1_PRESIDENTE = NULLIF('$APELLIDO1PRESIDENTE',''),
                    APELLIDO2_PRESIDENTE = NULLIF('$APELLIDO2PRESIDENTE',''),VIGENCIA = NULLIF('$VIGENCIA',''),PARTIDO = NULLIF('$PARTIDO',''),CIF = NULLIF('$CIF',''),TIPO_VIA = NULLIF('$TIPOVIA',''),
                    NOMBRE_VIA = NULLIF('$NOMBREVIA',''),NUM_VIA = NULLIF('$NUMVIA',''),COD_POSTAL = NULLIF('$CODPOSTAL',''),TELEFONO = NULLIF('$TELEFONO',''),FAX = NULLIF('$FAX',''),
                    WEB = NULLIF('$WEB',''),MAIL = NULLIF('$MAIL','') WHERE CODIGO = '$CODIGO_CCAA'";
                    if (!mysqli_query($conn, $update)) {
                        echo mysqli_error($conn);
                        return false;
                    }
                }
                $VIGENCIA=null;

                //POBLACION
                //descompone el campo en varios strings que seran almacenados en un array
                $arrayStr = explode('_',$fields[2]);
                $tipo = $arrayStr[0]; // obtenemos el tipo del campo. En este caso, el campo
                $year = $arrayStr[1]; // obtenemos el anho de la poblacion
                $value = $values[2]; // obtenemos el valor correspondiente a ese campo
                //revisamos si el valor existe previamente en la tabla 
                $sql = "SELECT CODIGO, ANHO FROM scoring_ccaa WHERE CODIGO = '$CODIGO_CCAA' AND ANHO = '$year'";
                $result = mysqli_query($conn,$sql);
                if(!$result){
                    echo mysqli_error($conn);
                    return false;
                }
                // si no devuelve ninguna fila, eso quiere decir que la fila no existe, entonces se inserta con el valor dado
                if(mysqli_num_rows($result)==0){
                    $insert = "INSERT INTO scoring_ccaa (CODIGO, ANHO, POBLACION) VALUES ('$CODIGO_CCAA','$year', NULLIF('$value',''))";
                    mysqli_query($conn,$insert);
                    echo mysqli_error($conn);
                }
                else {
                    //si ya existe la fila, entonces se actualiza el valor del campo con el nuevo valor dado del documento ($value)
                    $update = "UPDATE scoring_ccaa SET POBLACION = NULLIF('$value','') WHERE ANHO = '$year' AND CODIGO = '$CODIGO_CCAA'";
                    mysqli_query($conn, $update);
                }

                // Se espera poder añadir el resto de campos previos al 16 dentro de este loop
                for($k=0;$k<count($fields);$k++){
                    // En este caso en particular, a partir de la posicion 16 comienzan los datos correspondientes a la tabla deudas_ccaa
                    if($k > 16){
                        // Inicializacion de los valores año, valor y tipo
                        $year=$values[$k];
                        $value = $values[$k+1];
                        $type = $fields[$k+1];

                        if($type == "DEUDAVIVA"){
                            //Dividir el string de Año-trimestre
                            $deudaviva_year = substr($year, 0, 4);
                            $deudaviva_month = substr($year, 4);
                            
                            // Se revisa si la fila ya existe en la tabla o no
                            $query = "SELECT CODIGO, ANHO, MES, DEUDAVIVA FROM cuentas_ccaa_general_mensual WHERE ANHO = '$deudaviva_year' AND MES = $deudaviva_month AND CODIGO = '$CODIGO_CCAA'";
                            $result = mysqli_query($conn,$query);
                            if(!$result){
                                echo mysqli_error($conn);
                                return false;
                            }
                            //Si no existe, entonces se inserta como una nueva fila
                            if(mysqli_num_rows($result)==0){
                                $insert = "INSERT INTO cuentas_ccaa_general_mensual(CODIGO, ANHO, MES, DEUDAVIVA) VALUES ('$CODIGO_CCAA','$deudaviva_year','$deudaviva_month', NULLIF('$value',''))";
                                mysqli_query($conn,$insert);
                            }
                            else {
                                //Si ya existe, entonces se actualiza con el nuevo valor dado en el excel
                                $update = "UPDATE cuentas_ccaa_general_mensual SET DEUDAVIVA = NULLIF('$value','') WHERE ANHO = '$deudaviva_year' AND MES = $deudaviva_month AND CODIGO = '$CODIGO_CCAA'";
                                mysqli_query($conn, $update);
                            }
                        }
                        else {
                            // Se revisa si la fila ya existe en la tabla o no
                            $query = "SELECT CODIGO, ANHO, $type FROM deudas_ccaa WHERE ANHO = '$year' AND CODIGO = '$CODIGO_CCAA'";
                            $result = mysqli_query($conn,$query);
                            if(!$result){
                                echo mysqli_error($conn);
                                return false;
                            }
                            //Si no existe, entonces se inserta como una nueva fila
                            if(mysqli_num_rows($result)==0){
                                $insert = "INSERT INTO deudas_ccaa(CODIGO, ANHO, $type) VALUES ('$CODIGO_CCAA','$year',NULLIF('$value',''))";
                                mysqli_query($conn,$insert);
                            }
                            else {
                                //Si ya existe, entonces se actualiza con el nuevo valor dado en el excel
                                $update = "UPDATE deudas_ccaa SET $type = NULLIF('$value','') WHERE ANHO = '$year' AND CODIGO = '$CODIGO_CCAA'";
                                mysqli_query($conn, $update);
                            }
                        }

                        $k++;
                    }
                }
                $values = array();
            }
        }

        /*

        Presentamos los datos por pantalla, en formato tabla

        */
        /*
        $sql = "SELECT * FROM ccaas";

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
        echo '<br>';

        $sql = "SELECT * FROM deudas_ccaa";

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
        ////cierraConexion();

        return true;
    }
}
?>
<?php //insertarXML(totalVariables, variables["nombres"], fichero);?>