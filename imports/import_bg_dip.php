<?php
require_once("includesWeb/config.php");
require_once('imports/configFile.php');
require("includes/vendor/autoload.php");

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;


class Importer_bg_dip{
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

    public function import_bg_dip($filename){
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
                //Para eliminar espacios vacios y enters
                $valor = preg_replace('/\s+/',' ', html_entity_decode(preg_replace('/_x([0-9a-fA-F]{4})_/', '&#x$1;', $valor)));
                if($x>1)
                    $values[$y-1]=$valor;   
                else{
                    if($valor != "")
                        $fields[$y-1]=$valor;    
                }
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
                
                $query = "SELECT CODIGO FROM provincias WHERE NOMBRE = '$PROVINCIA'";
                $result = mysqli_query($conn, $query);
                if(!$result){
                    echo mysqli_error($conn);
                    return false;
                }
                $dato_sql = mysqli_fetch_assoc($result);
                $PROVINCIA = $dato_sql['CODIGO'];

                $AUTONOMIA = addslashes($values[8]);
                $query = "SELECT CODIGO FROM ccaas WHERE NOMBRE = '$AUTONOMIA'";
                $result = mysqli_query($conn, $query);
                if(!$result){
                    echo mysqli_error($conn);
                    return false;
                }
                $dato_sql = mysqli_fetch_assoc($result);
                $AUTONOMIA = $dato_sql['CODIGO'];


                $TELEFONO = $values[9];
                $FAX = $values[10];
                $WEB = addslashes($values[11]);
                $MAIL = addslashes($values[12]);

                $sql = "SELECT CODIGO FROM diputaciones WHERE CODIGO = '$CODIGO_DIP'";
                $result = mysqli_query($conn,$sql);
                if(!$result){
                    echo mysqli_error($conn);
                    return false;
                }
                // si no devuelve ninguna fila, eso quiere decir que la fila no existe, entonces se inserta con el valor dado
                if(mysqli_num_rows($result)==0){
                    $insert = "INSERT INTO diputaciones VALUES ('$CODIGO_DIP','$DIPUTACION','$CIF',NULLIF('$TIPOVIA',''),NULLIF('$NOMBREVIA',''), NULLIF('$NUMVIA',''), NULLIF('$CODPOSTAL',''), '$PROVINCIA', '$AUTONOMIA',
                    NULLIF('$TELEFONO',''), NULLIF('$FAX',''), NULLIF('$WEB',''), NULLIF('$MAIL',''))";
                    $result = mysqli_query($conn,$insert);
                }
                else {
                    //si ya existe la fila, entonces se actualiza el valor del campo con el nuevo valor dado ($value)
                    $update = "UPDATE diputaciones SET NOMBRE = NULLIF('$DIPUTACION',''), CIF = NULLIF('$CIF',''),
                    TIPOVIA = NULLIF('$TIPOVIA',''),NOMBREVIA = NULLIF('$NOMBREVIA',''),NUMVIA = NULLIF('$NUMVIA',''), CODPOSTAL = NULLIF('$CODPOSTAL',''),
                    PROVINCIA='$PROVINCIA',AUTONOMIA = '$AUTONOMIA',TELEFONO = NULLIF('$TELEFONO',''),FAX = NULLIF('$FAX',''),
                    WEB = NULLIF('$WEB',''),MAIL = NULLIF('$MAIL','') WHERE CODIGO = '$CODIGO_DIP'";
                    $result = mysqli_query($conn, $update);
                }
                if(!$result){
                    echo mysqli_error($conn);
                    return false;
                }
                //evalua cada valor array de valores. 
                for($k = 0; $k < count($fields);$k++){
                    //En este caso en particular, a partir de la posición 12, comienzan los datos pertenecientes a la tabla deudas_dip
                    if($k > 13){
                        //descompone el campo en varios strings que seran almacenados en un array
                        $arrayStr = explode('_',$fields[$k]);
                        $tipo = $arrayStr[0]; // obtenemos el tipo de la deuda del array de strings
                        $year = $arrayStr[1]; // obtenemos el anho de la deuda del array de strings
                        $value = $values[$k]; // obtenemos el valor correspondiente a ese campo
                        //revisamos si el valor existe previamente en la tabla 
                        $sql = "SELECT CODIGO, ANHO FROM deudas_dip WHERE CODIGO = '$CODIGO_DIP' AND ANHO = '$year'";
                        $result = mysqli_query($conn,$sql);
                        if(!$result){
                            echo mysqli_error($conn);
                            return false;
                        }
                        // si no devuelve ninguna fila, eso quiere decir que la fila no existe, entonces se inserta con el valor dado
                        if(mysqli_num_rows($result)==0){
                            $insert = "INSERT INTO deudas_dip (CODIGO, ANHO, $tipo) VALUES ('$CODIGO_DIP','$year', NULLIF('$value',''))";
                            $result = mysqli_query($conn,$insert);
                        }
                        else {
                            //si ya existe la fila, entonces se actualiza el valor del campo con el nuevo valor dado ($value)
                            $update = "UPDATE deudas_dip SET $tipo = NULLIF('$value','') WHERE ANHO = '$year' AND CODIGO = '$CODIGO_DIP'";
                            $result = mysqli_query($conn, $update);
                        }
                        if(!$result){
                            echo mysqli_error($conn);
                            return false;
                        }
                    }
                }
                $values = array();
            }
        }

        return true;
    }
}
?>