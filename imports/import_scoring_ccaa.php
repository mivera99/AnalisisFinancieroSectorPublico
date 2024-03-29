<?php
require_once("includesWeb/config.php");
require("includes/vendor/autoload.php");

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Importer_scoring_ccaa{
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

    public function import_scoring_ccaa($filename,$realname){
        $path = $filename;
        $doc = IOFactory::load($path);

        $hoja = $doc->getSheet(2);

        $rows = $hoja->getHighestDataRow();
        $cols = $hoja->getHighestDataColumn();
        $cols = Coordinate::columnIndexFromString($cols);

        $conn = getConexionBD();

        for($i = 1; $i < $rows+1; $i++){
            for($j = 1; $j <= $cols; $j++){
                $value = $hoja->getCellByColumnAndRow($j,$i);
                $value = preg_replace('/\s+/',' ', html_entity_decode(preg_replace('/_x([0-9a-fA-F]{4})_/', '&#x$1;', $value)));
                if($i>1)
                    $vals[$j-1]=$value;
                else
                    $fields[$j-1]=$value;
            }
            if($i>1 && $vals[1]!=""){
                $CODIGO_CCAA=$vals[1];
                //Se comienza a leer todas las rows. Se empieza desde la columna 3 porque es donde empieza la información que queremos guardar en la BBDD. 
                for($k=0;$k<count($fields);$k++){
                    if($k>=3){
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
        
                        //Consulta para averiguar si ya existe la fila 
                        $query="SELECT CODIGO,ANHO FROM scoring_ccaa WHERE ANHO = '$year' AND CODIGO='$CODIGO_CCAA'";
                        $result= mysqli_query($conn,$query);
                        if(!$result){
                            echo mysqli_error($conn);
                            return false;
                        }
                        if(mysqli_num_rows($result)==0){
                            //Si la fila no existe, lo inserta por primera vezz en la BBDD
                            $insert="INSERT INTO scoring_ccaa(CODIGO,ANHO,$tipo) VALUES ('$CODIGO_CCAA','$year',NULLIF('$value',''))";
                            $result = mysqli_query($conn,$insert);
                        }
                        else {
                            if($value !== '') {
                                //Si ya existe y el valor nuevo no está vacío, entonces se actualiza con el nuevo valor dado en el excel
                                $update = "UPDATE scoring_ccaa SET $tipo = NULLIF('$value','') WHERE ANHO = '$year' AND CODIGO = '$CODIGO_CCAA'";
                                $result = mysqli_query($conn, $update);
                            }
                        }
                        //Si alguna de las 2 consultas anteriores, ya sea inserción o actualización, da error, entonces me muestra el mensaje de error
                        if(!$result){
                            echo mysqli_error($conn);
                            return false;
                        }
                    }
                }
                $vals = array();
            }
        }
        ////cierraConexion();

        return true;
    }

}

?>