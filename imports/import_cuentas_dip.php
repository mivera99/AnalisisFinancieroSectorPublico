<?php
require_once("includesWeb/config.php");
require_once('imports/configFile.php');
require_once("includes/vendor/autoload.php");

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Importer_cuentas_dip{
    public function import_cuentas_dip($filename){
        //Cargamos el archivo en la variable de documento "doc"
        $path = $filename;
        $doc = IOFactory::load($path);

        $hoja = $doc->getSheet(1);
        
        $rows = $hoja->getHighestDataRow();
        $cols = $hoja->getHighestDataColumn();
        $cols = Coordinate::columnIndexFromString($cols);

        $conn = getConexionBD();

        //Recorrer hoja
        for($x = 1; $x < $rows + 1; $x++){

            //Recoger nombres de columnas
            for($y = 1; $y <= $cols; $y++){

                $valor = $hoja->getCellByColumnAndRow($y,$x);
                //Para eliminar espacios vacios y enters (limpieza de caracteres del archivo excel)
                $valor = preg_replace('/\s+/',' ', html_entity_decode(preg_replace('/_x([0-9a-fA-F]{4})_/', '&#x$1;', $valor)));
                if($x>1)
                    $values[$y-1]=$valor;
                else
                    $fields[$y-1]=$valor; 
            }
            if($x>1 && $values[0]!= "") {

                /* EMPIEZA LA TOMA DE DATOS */

                $CODIGO_DIP = $values[0];
                for($k=3;$k<165;$k+=54){ //Iteramos por años

                    $columna = explode("_",$fields[$k]);
                    $year=end($columna);

                    //Añadimos el primer formato de datos INGRESOS
                    $q = $k;
                    $q_end = $q+27;
                    for($q;$q<$q_end;$q+=3){
                        $nombre = $fields[$q];
                        $col = explode("_",$nombre);
                        $tipo = $col[0];
                        $tipo = mb_substr($tipo, 0, 12);

                        $v1 = str_replace(',', '.', $values[$q]);      //PRES
                        $v2 = str_replace(',', '.', $values[$q+1]);    //DERE
                        $v3 = str_replace(',', '.', $values[$q+2]);    //RECA

                        // Se revisa si la fila ya existe en la tabla o no
                        $query = "SELECT CODIGO, ANHO, TIPO, PRES, DERE, RECA FROM cuentas_dip_ingresos WHERE ANHO = '$year' AND CODIGO = '$CODIGO_DIP' AND TIPO = '$tipo'";
                        $result = mysqli_query($conn,$query);
                        if(!$result){
                            echo mysqli_error($conn)."<br>";
                            return false;
                        }
                        //Si no existe, entonces se inserta como una nueva fila
                        if(mysqli_num_rows($result)==0){
                            $insert = "INSERT INTO cuentas_dip_ingresos(CODIGO, ANHO, TIPO, PRES, DERE, RECA) VALUES ('$CODIGO_DIP','$year','$tipo',NULLIF('$v1',''),NULLIF('$v2',''),NULLIF('$v3',''))";
                            mysqli_query($conn,$insert);
                            echo mysqli_error($conn)."<br>";
                        }
                        else {
                            
                            $row = mysqli_fetch_array($result);
                            $v1 = ($v1 === '') ? $row['PRES'] : $v1;
                            $v2 = ($v2 === '') ? $row['DERE'] : $v2;
                            $v3 = ($v3 === '') ? $row['RECA'] : $v3;
                            //Si ya existe, entonces se actualiza con el nuevo valor dado en el excel
                            $update = "UPDATE cuentas_dip_ingresos SET 
                                        PRES = NULLIF('$v1',''), 
                                        DERE = NULLIF('$v2',''), 
                                        RECA = NULLIF('$v3','') 
                                        WHERE ANHO = '$year' AND CODIGO = '$CODIGO_DIP' AND TIPO = '$tipo'";
                            mysqli_query($conn, $update);
                        }
                    }

                    //Añadimos el segundo formato de datos GASTOS
                    $q_end = $q+27;

                    for($q;$q<$q_end;$q+=3){
                        $nombre = $fields[$q];
                        $col = explode("_",$nombre);
                        $tipo = $col[0];
                        $tipo = mb_substr($tipo, 0, 12);

                        $v1 = str_replace(',', '.', $values[$q]);      //PRES
                        $v2 = str_replace(',', '.', $values[$q+1]);    //OBLG
                        $v3 = str_replace(',', '.', $values[$q+2]);    //PAGOS

                        // Se revisa si la fila ya existe en la tabla o no
                        $query = "SELECT CODIGO, ANHO, TIPO, PRES, OBLG, PAGOS FROM cuentas_dip_gastos WHERE ANHO = '$year' AND CODIGO = '$CODIGO_DIP' AND TIPO = '$tipo'";
                        $result = mysqli_query($conn,$query);
                        if(!$result){
                            echo mysqli_error($conn)."<br>";
                            return false;
                        }
                        //Si no existe, entonces se inserta como una nueva fila
                        if(mysqli_num_rows($result)==0){
                            $insert = "INSERT INTO cuentas_dip_gastos(CODIGO, ANHO, TIPO, PRES, OBLG, PAGOS) VALUES ('$CODIGO_DIP','$year','$tipo',NULLIF('$v1',''),NULLIF('$v2',''),NULLIF('$v3',''))";
                            mysqli_query($conn,$insert);
                        }
                        else {
                            $row = mysqli_fetch_array($result);
                            $v1 = (!empty($v1)) ? $v1 : $row['PRES'];
                            $v2 = (!empty($v2)) ? $v2 : $row['OBLG'];
                            $v3 = (!empty($v3)) ? $v3 : $row['PAGOS'];
                            //Si ya existe, entonces se actualiza con el nuevo valor dado en el excel
                            $update = "UPDATE cuentas_dip_gastos SET 
                                        PRES = NULLIF('$v1',''), 
                                        OBLG = NULLIF('$v2',''), 
                                        PAGOS = NULLIF('$v3','') 
                                        WHERE ANHO = '$year' AND CODIGO = '$CODIGO_DIP' AND TIPO = '$tipo'";
                            mysqli_query($conn, $update);
                        }
                    }
                }

                //PMP
                for($k=165;$k<(165+6);$k++){
                    $columna = explode("_",$fields[$k]);
                    $year=end($columna);

                    $nombre = $fields[$k];
                    $col = explode("_",$nombre);
                    $tipo = $col[0];
                    $tipo = mb_substr($tipo, 0, 12);
                    
                    $year = (int)$year;
                    $trimestre = ($year%100)/3;
                    $year = (int)($year/100);

                    $valor = $values[$k];
                    
                    // Se revisa si la fila ya existe en la tabla o no
                    $query = "SELECT CODIGO, ANHO, TRIMESTRE FROM cuentas_dip_pmp WHERE ANHO = '$year' AND CODIGO = '$CODIGO_DIP' AND TRIMESTRE = '$trimestre'";
                    $result = mysqli_query($conn,$query);
                    if(!$result){
                        echo mysqli_error($conn)."<br>";
                        return false;
                    }
                    //Si no existe, entonces se inserta como una nueva fila
                    if(mysqli_num_rows($result)==0){
                        $insert = "INSERT INTO cuentas_dip_pmp(CODIGO, ANHO, TRIMESTRE, PMP) VALUES ('$CODIGO_DIP','$year','$trimestre',NULLIF('$valor',''))";
                        mysqli_query($conn,$insert);
                    }
                    else {
                        if($valor !== '') {
                            //Si ya existe, entonces se actualiza con el nuevo valor dado en el excel
                            $update = "UPDATE cuentas_dip_pmp SET PMP = NULLIF('$valor','') WHERE ANHO = '$year' AND CODIGO = '$CODIGO_DIP' AND TRIMESTRE = '$trimestre'";
                            mysqli_query($conn, $update);
                        }
                    }
                }
                $values = array();
            }
        }
        //cierraConexion();

        return true;
    }
}
?>