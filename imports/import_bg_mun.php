<?php
require_once("includesWeb/config.php");
require_once('imports/configFile.php');
require("includes/vendor/autoload.php");

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;


class Importer_bg_mun{

    public function import_bg_mun($filename, $realname){
        $path = $filename;
        $doc = IOFactory::load($path);

        $hoja = $doc->getSheet(0);

        $rows = $hoja->getHighestDataRow();
        $cols = $hoja->getHighestDataColumn();
        $cols = Coordinate::columnIndexFromString($cols);


        $conn = getConexionBD();

        $fileMonth = intval((explode('_',(explode('.',$realname))[0]))[3])%100; // hecho para obtener el mes del titulo del archivo excel

        for($x = 1; $x < $rows + 1; $x++){
        
            for($y = 1; $y < $cols; $y++){
        
                $valor = $hoja->getCellByColumnAndRow($y,$x);
                //Para eliminar espacios vacios y enters
                $valor = preg_replace('/\s+/',' ', html_entity_decode(preg_replace('/_x([0-9a-fA-F]{4})_/', '&#x$1;', $valor)));
        
                if($x>1)
                    $values[$y-1]=$valor;
                else {  
                    if($valor != "")
                        $fields[$y-1]=$valor;
                }
            }
            if($x>1 && $values[0]!= "") {
                $CODIGO_MUN=$values[0];
                $CIF_MUNICIPIO=$values[1];
                $MUNICIPIO=addslashes($values[2]);
        
                $CODIGO_PROV=$values[3];
                $PROVINCIA=$values[4];
                $query = "SELECT CODIGO, NOMBRE FROM provincias WHERE CODIGO = '$CODIGO_PROV'";
                $result = mysqli_query($conn, $query);
                if(!$result){
                    echo mysqli_error($conn);
                    return false;
                }
                if(mysqli_num_rows($result) == 0){
                    $insert = "INSERT INTO provincias VALUES ('$CODIGO_PROV',NULLIF('$PROVINCIA',''))";
                    $result = mysqli_query($conn,$insert);
                }
                if(!$result){
                    echo mysqli_error($conn);
                    return false;
                }
                else {
                    $AUTONOMIA=$values[5];
                    $request = "SELECT CODIGO FROM ccaas WHERE NOMBRE = '$AUTONOMIA'";
                    $result_query = mysqli_query($conn,$request);
                    if(!$result_query){
                        echo mysqli_error($conn);
                        return false;
                    }
                    if(mysqli_num_rows($result_query)==0){
                        $sql = "INSERT INTO ccaas (NOMBRE) VALUES ('$AUTONOMIA')";
                        $result = mysqli_query($conn,$sql);
                        if(!$result){
                            echo mysqli_error($conn);
                            return false;
                        }
                        $request = "SELECT CODIGO FROM ccaas WHERE NOMBRE = '$AUTONOMIA'";
                        $result_query = mysqli_query($conn,$request);
                        if(!$result_query){
                            echo mysqli_error($conn);
                            return false;
                        }
                    }
                    $dato_ccaa = mysqli_fetch_assoc($result_query);
                    $CODIGO_CCAA = $dato_ccaa['CODIGO'];
        
                    $NOMBREALCALDE=addslashes($values[7]);
                    $APELLIDO1ALCALDE=addslashes($values[8]);
                    $APELLIDO2ALCALDE=addslashes($values[9]);
                
                    if($values[10]!=""){
                        $tiempo = strtotime($values[10]);
                        $VIGENCIA=date("Y-m-d", $tiempo);
                    }
                    else {
                        $VIGENCIA="";
                    }
                    $PARTIDO=addslashes($values[11]);
                    $TIPOVIA=$values[12];
                    $NOMBREVIA=$values[13];
                    $NUMVIA=$values[14];
                    $CODPOSTAL=$values[15];
                    $TELEFONO=$values[16];
                    $FAX=$values[17];
                    $WEB=$values[18];
                    $MAIL=$values[19];
                    
                    $sql = "SELECT CODIGO FROM municipios WHERE CODIGO='$CODIGO_MUN'";
                    $result = mysqli_query($conn,$sql);
                    if(!$result){
                        echo mysqli_error($conn);
                        return false;
                    }
                    if(mysqli_num_rows($result)==0){
                        $insert="INSERT INTO municipios VALUES ('$CODIGO_MUN','$CIF_MUNICIPIO','$MUNICIPIO',NULLIF('$CODIGO_PROV',''),NULLIF('$CODIGO_CCAA',''),NULLIF('$NOMBREALCALDE',''),
                            NULLIF('$APELLIDO1ALCALDE',''),NULLIF('$APELLIDO2ALCALDE',''),NULLIF('$VIGENCIA',''),NULLIF('$PARTIDO',''),NULLIF('$TIPOVIA',''),NULLIF('$NOMBREVIA',''),NULLIF('$NUMVIA',''),
                            NULLIF('$CODPOSTAL',''),NULLIF('$TELEFONO',''),NULLIF('$FAX',''),NULLIF('$WEB',''),NULLIF('$MAIL',''))";
                        $result=mysqli_query($conn,$insert);
                        if (!$result) {
                            echo mysqli_error($conn);
                            return false;
                        }
                    }
                    else {
                        //si ya existe la fila, entonces se actualiza el valor del campo con el nuevo valor dado del documento ($value)
                        $update = "UPDATE municipios SET CIF = NULLIF('$CIF_MUNICIPIO',''),NOMBRE = NULLIF('$MUNICIPIO',''),PROVINCIA = NULLIF('$CODIGO_PROV',''), AUTONOMIA = NULLIF('$CODIGO_CCAA',''), NOMBREALCALDE = NULLIF('$NOMBREALCALDE',''), APELLIDO1ALCALDE = NULLIF('$APELLIDO1ALCALDE',''),
                        APELLIDO2ALCALDE = NULLIF('$APELLIDO2ALCALDE',''),VIGENCIA = NULLIF('$VIGENCIA',''),PARTIDO = NULLIF('$PARTIDO',''),
                        TIPOVIA = NULLIF('$TIPOVIA',''), NOMBREVIA = NULLIF('$NOMBREVIA',''),NUMVIA = NULLIF('$NUMVIA',''),CODPOSTAL = NULLIF('$CODPOSTAL',''),TELEFONO = NULLIF('$TELEFONO',''),FAX = NULLIF('$FAX',''),
                        WEB = NULLIF('$WEB',''),MAIL = NULLIF('$MAIL','') WHERE CODIGO = '$CODIGO_MUN'";
                        $result=mysqli_query($conn,$update);
                        if (!$result) {
                            echo mysqli_error($conn);
                            return false;
                        }
                    }
        
                    //POBLACION
                    //descompone el campo en varios strings que seran almacenados en un array
                    $arrayStr = explode('_',$fields[6]);
                    $tipo = $arrayStr[0]; // obtenemos el tipo del campo. En este caso, el campo
                    $year = $arrayStr[1]; // obtenemos el anho de la poblacion
                    $value = $values[6]; // obtenemos el valor correspondiente a ese campo
                    //revisamos si el valor existe previamente en la tabla 
                    $sql = "SELECT CODIGO, ANHO FROM scoring_mun WHERE CODIGO = '$CODIGO_MUN' AND ANHO = '$year'";
                    $result = mysqli_query($conn,$sql);
                    if(!$result){
                        echo mysqli_error($conn);
                        return false;
                    }
                    // si no devuelve ninguna fila, eso quiere decir que la fila no existe, entonces se inserta con el valor dado
                    if(mysqli_num_rows($result)==0){
                        $insert = "INSERT INTO scoring_mun (CODIGO, ANHO, POBLACION) VALUES ('$CODIGO_MUN','$year', NULLIF('$value',''))";
                        $result = mysqli_query($conn,$insert);
                    }
                    else {
                        //si ya existe la fila, entonces se actualiza el valor del campo con el nuevo valor dado del documento ($value)
                        $update = "UPDATE scoring_mun SET POBLACION = NULLIF('$value','') WHERE ANHO = '$year' AND CODIGO = '$CODIGO_MUN'";
                        $result = mysqli_query($conn, $update);
                    }
                    if(!$result){
                        echo mysqli_error($conn);
                        return false;
                    }

                    for($k = 0; $k < count($fields);$k++){
                        //En este caso en particular, a partir de la posición 23, comienzan los datos pertenecientes a la tabla deudas_mun
                        if($k>=20 && $k<23){
                            $value = $values[$k];
                            $trimestre = ceil($fileMonth/3);
                            $arrayStr = explode('_',$fields[$k]);
                            $year='';
                            $tipo='';
                            if(count($arrayStr)==3){
                                $tipo = $arrayStr[0].'_'.$arrayStr[1];
                                $year = $arrayStr[2];
                            }
                            else{
                                $tipo = $arrayStr[0];
                                $year = $arrayStr[1];
                            }
                            if($year!= '' && $tipo != ''){
                                $sql = "SELECT CODIGO, ANHO, TRIMESTRE FROM cuentas_mun_pmp WHERE CODIGO = '$CODIGO_MUN' AND ANHO = '$year' AND TRIMESTRE = '$trimestre'";
                                $result = mysqli_query($conn,$sql);
                                if(!$result){
                                    echo mysqli_error($conn);
                                    return false;
                                }
                                // si no devuelve ninguna fila, eso quiere decir que la fila no existe, entonces se inserta con el valor dado
                                if(mysqli_num_rows($result)==0){
                                    $insert = "INSERT INTO cuentas_mun_pmp (CODIGO, ANHO, TRIMESTRE, $tipo) VALUES ('$CODIGO_MUN','$year', NULLIF('$trimestre',''),NULLIF('$value',''))";
                                    $result = mysqli_query($conn,$insert);
                                }
                                else {
                                    //si ya existe la fila, entonces se actualiza el valor del campo con el nuevo valor dado del documento ($value)
                                    $update = "UPDATE cuentas_mun_pmp SET $tipo = NULLIF('$value','') WHERE ANHO = '$year' AND CODIGO = '$CODIGO_MUN' AND TRIMESTRE = '$trimestre'";
                                    $result = mysqli_query($conn, $update);
                                }
                                //Si alguna de las 2 consultas anteriores, ya sea inserción o actualización, da error, entonces me muestra el mensaje de error
                                if(!$result){
                                    echo mysqli_error($conn);
                                    return false;
                                }
                            }
                        }
                        else if($k >= 23){
                            //descompone el campo en varios strings que seran almacenados en un array
                            $arrayStr = explode('_',$fields[$k]);
                            $tipo = $arrayStr[0]; // obtenemos el tipo de la deuda del array de strings
                            $year = $arrayStr[1]; // obtenemos el anho de la deuda del array de strings
                            $value = str_replace(',', '.', $values[$k]); // obtenemos el valor correspondiente a ese campo
                            //revisamos si el valor existe previamente en la tabla 
                            $sql = "SELECT CODIGO, $year FROM deudas_mun WHERE CODIGO = '$CODIGO_MUN' AND ANHO = '$year'";
                            $result = mysqli_query($conn,$sql);
                            if(!$result){
                                echo mysqli_error($conn);
                                return false;
                            }
                            // si no devuelve ninguna fila, eso quiere decir que la fila no existe, entonces se inserta con el valor dado
                            if(mysqli_num_rows($result)==0){
                                $insert = "INSERT INTO deudas_mun (CODIGO, ANHO, $tipo) VALUES ('$CODIGO_MUN','$year', NULLIF('$value',''))";
                                $result = mysqli_query($conn,$insert);
                            }
                            else {
                                //si ya existe la fila, entonces se actualiza el valor del campo con el nuevo valor dado del documento ($value)
                                $update = "UPDATE deudas_mun SET $tipo = NULLIF('$value','') WHERE ANHO = '$year' AND CODIGO = '$CODIGO_MUN'";
                                $result = mysqli_query($conn, $update);
                            }
                            //Si alguna de las 2 consultas anteriores, ya sea inserción o actualización, da error, entonces me muestra el mensaje de error
                            if(!$result){
                                echo mysqli_error($conn);
                                return false;
                            }
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