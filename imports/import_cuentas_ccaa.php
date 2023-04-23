<?php
require_once("includesWeb/config.php");
require_once("includesWeb/config.php");
require("includes/vendor/autoload.php");

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Importer_cuentas_ccaa{
    public function import_cuentas_ccaa($filename){
        //Cargamos el archivo en la variable de documento "doc"
        $path = $filename;
        $doc = IOFactory::load($path);

        $hoja = $doc->getSheet(1); 

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
                    $fields[$y-1]=$valor; 
            }
            if($x>1 && $values[1]!= "") { // Se escoge la posicion 1 en este caso porque es la que se va a usar como clave en la BBDD
                /* EMPIEZA LA TOMA DE DATOS */
        
                $CODIGO_CCAA = intval($values[1]);
                //Añadimos el primer formato de datos (desde la columna D[3] hasta la BM[64], ambas incluidas)
                for($k=3;$k<=64;$k+=4){
                    // En este caso en particular, a partir de la posicion 16 comienzan los datos correspondientes a la tabla deudas_ccaa
                        // Inicializacion de los valores año, valor y tipo
                        $yearString = $values[$k];
                        $year1=(int)$values[$k];
                        $year2 = $year1-1;
                        $year3 = $year1-2;
        
                        $value1 = $values[$k+1];
                        $value2 = $values[$k+2];
                        $value3 = $values[$k+3];
        
                        $key = $fields[$k+1];
                        $key2 = $fields[$k+3];
        
                        $leyenda = array(
                            "INCREMENTO PIB FECHA_REF" => "INCR_PIB",
                            "TASA DE PARO EN EL ÚLTIMO TRIMESTRE EN LA FECHA DE REFERENCIA" => "PARO", //tabla mensual
                            "TRANSACCIONES INMOBILIARIAS FECHA_REF" => "TRANSAC_INMOBILIARIAS", //tabla mensual
                            "NÚMERO DE EMPRESAS EN LA FECHA DE REFERENCIA" => "N_EMPRESAS",
                            "PORCENTAJE DE LA CCAA EN EL PIB FECHA_REF" => "CCAA_PIB",
                            "DEUDA VIVA ENTRE INGRESOS CORRIENTES FECHA_REF" => "DEUDA_VIVA_INGR_COR", //tabla amensual
                            "RATIO DE SOSTENIBILIDAD FINANCIERA FECHA_REF" => "R_SOSTE_FINANCIERA",
                            "RATIO DE EFICIENCIA EN LA FECHA DE REFERENCIA" => "R_EFIC",
                            "RATIO DE RIGIDEZ EN EL AÑO LA FECHA DE REFERENCIA" => "R_RIGIDEZ",
                            "RATIO DE SOSTENIBILIDAD DEL ENDEUDAMIENTO FECHA_REF" => "R_SOSTE_ENDEUDA",
                            "PERIODO MEDIO DE PAGO EN LA FECHA_REF" => "PMP", //tabla mensual
                            "RATIO DE EJECUCIÓN DE INGRESOS CORRIENTES FECHA_REF" => "R_EJE_INGR_CORR",
                            "RATIO DE EJECUCIÓN DE GASTOS CORRIENTES FECHA_REF" => "R_EJE_GASTOS_CORR",
                            "RATIO DE DEUDA COMERCIAL PENDIENTE DE PAGO FECHA_REF" => "R_DCPP", //tabla mensual
                            "PAGOS RECONOCIDOS SOBRE OBLIGACIONES FECHA_REF" => "PAGOS_OBLIGACIONES",
                            "RATIO DE EFICACIA RECAUDATORIA FECHA_REF" => "R_EFICACIA_REC",
                        );
                        $type = $leyenda[$key];
        
                        if($key2 == "FECHA_REF"){ //Bloque tamaño 3
        
                            if($type == "PMP" || $type == "R_DCPP"){
                                $mes1 = $year1%100;
                                $mes2 = $mes1;
                                $mes3 = $mes1;
                                $year1 = (int)($year1/100);
                                $year2 = $year1-1;
                                $year3 = $year1-2;
        
                                /*
                                    AÑO N
                                */
        
                                // Se revisa si la fila ya existe en la tabla o no
                                $query = "SELECT CODIGO, ANHO, MES FROM cuentas_ccaa_general_mensual WHERE ANHO = '$year1' AND CODIGO = '$CODIGO_CCAA' AND MES = '$mes1'";
                                $result = mysqli_query($conn,$query);
                                if(!$result){
                                    echo mysqli_error($conn);
                                    return false;
                                }
                                //Si no existe, entonces se inserta como una nueva fila
                                if(mysqli_num_rows($result)==0){
                                    $insert = "INSERT INTO cuentas_ccaa_general_mensual(CODIGO, ANHO, MES, $type) VALUES ('$CODIGO_CCAA','$year1','$mes1',NULLIF('$value1',''))";
                                    mysqli_query($conn,$insert);
                                    echo mysqli_error($conn);
                                }
                                else {
                                    if($value1 !== '') {
                                        //Si ya existe, entonces se actualiza con el nuevo valor dado en el excel
                                        $update = "UPDATE cuentas_ccaa_general_mensual SET $type = NULLIF('$value1','') WHERE ANHO = '$year1' AND CODIGO = '$CODIGO_CCAA' AND MES = '$mes1'";
                                        mysqli_query($conn, $update);
                                    }
                                }
        
                                /*
                                    AÑO N-1
                                */
                            
                                // Se revisa si la fila ya existe en la tabla o no
                                $query = "SELECT CODIGO, ANHO, MES FROM cuentas_ccaa_general_mensual WHERE ANHO = '$year2' AND CODIGO = '$CODIGO_CCAA' AND MES = '$mes2'";
                                $result = mysqli_query($conn,$query);
                                if(!$result){
                                    echo mysqli_error($conn);
                                    return false;
                                }
                                //Si no existe, entonces se inserta como una nueva fila
                                if(mysqli_num_rows($result)==0){
                                    $insert = "INSERT INTO cuentas_ccaa_general_mensual(CODIGO, ANHO, MES, $type) VALUES ('$CODIGO_CCAA','$year2','$mes2',NULLIF('$value2',''))";
                                    mysqli_query($conn,$insert);
                                }
                                else {
                                    if($value2 !== '') {
                                        //Si ya existe, entonces se actualiza con el nuevo valor dado en el excel
                                        $update = "UPDATE cuentas_ccaa_general_mensual SET $type = NULLIF('$value2','') WHERE ANHO = '$year2' AND CODIGO = '$CODIGO_CCAA' AND MES = '$mes2'";
                                        mysqli_query($conn, $update);
                                    }
                                }
                            }
                            else {
                                /*
                                AÑO N
                            */
                                // Se revisa si la fila ya existe en la tabla o no
                                $query = "SELECT CODIGO, ANHO FROM cuentas_ccaa_general WHERE ANHO = '$year1' AND CODIGO = '$CODIGO_CCAA'";
                                $result = mysqli_query($conn,$query);
                                if(!$result){
                                    echo mysqli_error($conn);
                                    return false;
                                }
                                //Si no existe, entonces se inserta como una nueva fila
                                if(mysqli_num_rows($result)==0){
                                    $insert = "INSERT INTO cuentas_ccaa_general(CODIGO, ANHO, $type) VALUES ('$CODIGO_CCAA','$year1',NULLIF('$value1',''))";
                                    mysqli_query($conn,$insert);
                                }
                                else {
                                    if($value1 !== '') {
                                        //Si ya existe, entonces se actualiza con el nuevo valor dado en el excel
                                        $update = "UPDATE cuentas_ccaa_general SET $type = NULLIF('$value1','') WHERE ANHO = '$year1' AND CODIGO = '$CODIGO_CCAA'";
                                        mysqli_query($conn, $update);
                                    }
                                }
                            /*
                                AÑO N-1
                            */
                         
                                // Se revisa si la fila ya existe en la tabla o no
                                $query = "SELECT CODIGO, ANHO FROM cuentas_ccaa_general WHERE ANHO = '$year2' AND CODIGO = '$CODIGO_CCAA'";
                                $result = mysqli_query($conn,$query);
                                if(!$result){
                                    echo mysqli_error($conn);
                                    return false;
                                }
                                //Si no existe, entonces se inserta como una nueva fila
                                if(mysqli_num_rows($result)==0){
                                    $insert = "INSERT INTO cuentas_ccaa_general(CODIGO, ANHO, $type) VALUES ('$CODIGO_CCAA','$year2',NULLIF('$value2',''))";
                                    mysqli_query($conn,$insert);
                                }
                                else {
                                    if($value2 !== '') {
                                        //Si ya existe, entonces se actualiza con el nuevo valor dado en el excel
                                        $update = "UPDATE cuentas_ccaa_general SET $type = NULLIF('$value2','') WHERE ANHO = '$year2' AND CODIGO = '$CODIGO_CCAA'";
                                        mysqli_query($conn, $update);
                                    }
                                }
                            }
                            $k--;
                        }
                        else{ //Bloque tamaño 4
                            //echo 'Bloque 4';
                            if($type == "PARO" || $type == "DEUDA_VIVA_INGR_COR" || $type == "TRANSAC_INMOBILIARIAS"){
                                if($type == "PARO") {
                                    $yearArray = str_split($yearString);
                                    $year1 = $yearArray[0].$yearArray[1].$yearArray[2].$yearArray[3];
                                    $year1 = (int)$year1;
                                    $mes1 = $yearArray[5].$yearArray[6];
                                    $mes1 = ((int)$mes1)*3;
                                    $mes2 = $mes1;
                                    $mes3 = $mes1;
                                    $year2 = $year1-1;
                                    $year3 = $year1-2;
                                }
                                else{
                                    $mes1 = $year1%100;
                                    $mes2 = $mes1;
                                    $mes3 = $mes1;
                                    $year1 = (int)($year1/100);
                                    $year2 = $year1-1;
                                    $year3 = $year1-2;
                                }
                                    /*
                                    AÑO N
                                    */
        
                                    // Se revisa si la fila ya existe en la tabla o no
                                    $query = "SELECT CODIGO, ANHO, MES FROM cuentas_ccaa_general_mensual WHERE ANHO = '$year1' AND CODIGO = '$CODIGO_CCAA' AND MES = '$mes1'";
                                    $result = mysqli_query($conn,$query);
                                    if(!$result){
                                        echo mysqli_error($conn);
                                        return false;
                                    }
                                    //Si no existe, entonces se inserta como una nueva fila
                                    if(mysqli_num_rows($result)==0){
                                        $insert = "INSERT INTO cuentas_ccaa_general_mensual(CODIGO, ANHO, MES, $type) VALUES ('$CODIGO_CCAA','$year1','$mes1',NULLIF('$value1',''))";
                                        mysqli_query($conn,$insert);
                                        echo mysqli_error($conn);
                                    }
                                    else {
                                        if($value1 !== '') {
                                        //Si ya existe, entonces se actualiza con el nuevo valor dado en el excel
                                            $update = "UPDATE cuentas_ccaa_general_mensual SET $type = NULLIF('$value1','') WHERE ANHO = '$year1' AND CODIGO = '$CODIGO_CCAA' AND MES = '$mes1'";
                                            mysqli_query($conn, $update);
                                            echo mysqli_error($conn);
                                        }
                                    }
                                /*
                                    AÑO N-1
                                */
                                
                                    // Se revisa si la fila ya existe en la tabla o no
                                    $query = "SELECT CODIGO, ANHO, MES FROM cuentas_ccaa_general_mensual WHERE ANHO = '$year2' AND CODIGO = '$CODIGO_CCAA' AND MES = '$mes2'";
                                    $result = mysqli_query($conn,$query);
                                    if(!$result){
                                        echo mysqli_error($conn);
                                        return false;
                                    }
                                    //Si no existe, entonces se inserta como una nueva fila
                                    if(mysqli_num_rows($result)==0){
                                        $insert = "INSERT INTO cuentas_ccaa_general_mensual(CODIGO, ANHO, MES, $type) VALUES ('$CODIGO_CCAA','$year2','$mes2',NULLIF('$value2',''))";
                                        mysqli_query($conn,$insert);
                                    }
                                    else {
                                        if($value2 !== '') {
                                            //Si ya existe, entonces se actualiza con el nuevo valor dado en el excel
                                            $update = "UPDATE cuentas_ccaa_general_mensual SET $type = NULLIF('$value2','') WHERE ANHO = '$year2' AND CODIGO = '$CODIGO_CCAA' AND MES = '$mes2'";
                                            mysqli_query($conn, $update);
                                        }
                                    }
        
                                /*
                                    AÑO N-2
                                */
                                
                                    // Se revisa si la fila ya existe en la tabla o no
                                    $query = "SELECT CODIGO, ANHO, MES FROM cuentas_ccaa_general_mensual WHERE ANHO = '$year3' AND CODIGO = '$CODIGO_CCAA' AND MES = '$mes3'";
                                    $result = mysqli_query($conn,$query);
                                    if(!$result){
                                        echo mysqli_error($conn);
                                        return false;
                                    }
                                    //Si no existe, entonces se inserta como una nueva fila
                                    if(mysqli_num_rows($result)==0){
                                        $insert = "INSERT INTO cuentas_ccaa_general_mensual(CODIGO, ANHO, MES, $type) VALUES ('$CODIGO_CCAA','$year3','$mes3',NULLIF('$value3',''))";
                                        mysqli_query($conn,$insert);
                                    }
                                    else {
                                        if($value3 !== '') {
                                            //Si ya existe, entonces se actualiza con el nuevo valor dado en el excel
                                            $update = "UPDATE cuentas_ccaa_general_mensual SET $type = NULLIF('$value3','') WHERE ANHO = '$year3' AND CODIGO = '$CODIGO_CCAA' AND MES = '$mes3'";
                                            mysqli_query($conn, $update);
                                        }
                                    }
                            }
                            else{
        
                                /*
                                    AÑO N
                                */
                                    // Se revisa si la fila ya existe en la tabla o no
                                    $query = "SELECT CODIGO, ANHO FROM cuentas_ccaa_general WHERE ANHO = '$year1' AND CODIGO = '$CODIGO_CCAA'";
                                    $result = mysqli_query($conn,$query);
                                    if(!$result){
                                        echo mysqli_error($conn);
                                        return false;
                                    }
                                    //Si no existe, entonces se inserta como una nueva fila
                                    if(mysqli_num_rows($result)==0){
                                        $insert = "INSERT INTO cuentas_ccaa_general(CODIGO, ANHO, $type) VALUES ('$CODIGO_CCAA','$year1',NULLIF('$value1',''))";
                                        mysqli_query($conn,$insert);
                                        echo mysqli_error($conn);
                                    }
                                    else {
                                        if($value1 !== '') {
                                            //Si ya existe, entonces se actualiza con el nuevo valor dado en el excel
                                            $update = "UPDATE cuentas_ccaa_general SET $type = NULLIF('$value1','') WHERE ANHO = '$year1' AND CODIGO = '$CODIGO_CCAA'";
                                            mysqli_query($conn, $update);
                                            echo mysqli_error($conn);
                                        }
                                    }
                                /*
                                    AÑO N-1
                                */
                                
                                    // Se revisa si la fila ya existe en la tabla o no
                                    $query = "SELECT CODIGO, ANHO FROM cuentas_ccaa_general WHERE ANHO = '$year2' AND CODIGO = '$CODIGO_CCAA'";
                                    $result = mysqli_query($conn,$query);
                                    if(!$result){
                                        echo mysqli_error($conn);
                                        return false;
                                    }
                                    //Si no existe, entonces se inserta como una nueva fila
                                    if(mysqli_num_rows($result)==0){
                                        $insert = "INSERT INTO cuentas_ccaa_general(CODIGO, ANHO, $type) VALUES ('$CODIGO_CCAA','$year2',NULLIF('$value2',''))";
                                        mysqli_query($conn,$insert);
                                    }
                                    else {
                                        if($value2 !== '') {
                                            //Si ya existe, entonces se actualiza con el nuevo valor dado en el excel
                                            $update = "UPDATE cuentas_ccaa_general SET $type = NULLIF('$value2','') WHERE ANHO = '$year2' AND CODIGO = '$CODIGO_CCAA'";
                                            mysqli_query($conn, $update);
                                        }
                                    }
                                /*
                                    AÑO N-2
                                */
                                
                                    // Se revisa si la fila ya existe en la tabla o no
                                    $query = "SELECT CODIGO, ANHO FROM cuentas_ccaa_general WHERE ANHO = '$year3' AND CODIGO = '$CODIGO_CCAA'";
                                    $result = mysqli_query($conn,$query);
                                    if(!$result){
                                        echo mysqli_error($conn);
                                        return false;
                                    }
                                    //Si no existe, entonces se inserta como una nueva fila
                                    if(mysqli_num_rows($result)==0){
                                        $insert = "INSERT INTO cuentas_ccaa_general(CODIGO, ANHO, $type) VALUES ('$CODIGO_CCAA','$year3',NULLIF('$value3',''))";
                                        mysqli_query($conn,$insert);
                                    }
                                    else {
                                        if($value3 !== '') {
                                            //Si ya existe, entonces se actualiza con el nuevo valor dado en el excel
                                            $update = "UPDATE cuentas_ccaa_general SET $type = NULLIF('$value3','') WHERE ANHO = '$year3' AND CODIGO = '$CODIGO_CCAA'";
                                            mysqli_query($conn, $update);
                                        }
                                    }
                            }
                        }
                }
        
                for($k=65;$k<count($fields);$k+=292-64){
        
                    $columna = explode("_",$fields[$k]);
                    $year=end($columna);
        
                    //Añadimos el segundo formato de datos INGRESOS
                    $q = $k;
                    $q_end= $q+156;
                    for($q;$q<$q_end;$q+=6){
                        $nombre = $fields[$q];
                        $col = explode("_",$nombre);
                        $tipo = $col[0];
        
                        $v1 = str_replace(',', '.', $values[$q]);      //PREV_INI
                        $v2 = str_replace(',', '.', $values[$q+1]);    //MOD_PREV_INI
                        $v3 = str_replace(',', '.', $values[$q+2]);    //PREV_DEF
                        $v4 = str_replace(',', '.', $values[$q+3]);    //DER_REC
                        $v5 = str_replace(',', '.', $values[$q+4]);    //RECAUDA_COR
                        $v6 = str_replace(',', '.', $values[$q+5]);    //RECAUDA_CER
                        
                        // Se revisa si la fila ya existe en la tabla o no
                        $query = "SELECT CODIGO, ANHO, TIPO FROM cuentas_ccaa_ingresos WHERE ANHO = '$year' AND CODIGO = '$CODIGO_CCAA' AND TIPO = '$tipo'";
                        $result = mysqli_query($conn,$query);
                        if(!$result){
                            echo mysqli_error($conn)."<br>";
                            return false;
                        }
                        //Si no existe, entonces se inserta como una nueva fila
                        if(mysqli_num_rows($result)==0){
                            $insert = "INSERT INTO cuentas_ccaa_ingresos(CODIGO, ANHO, TIPO, PREV_INI, MOD_PREV_INI, PREV_DEF, DER_REC, RECAUDA_COR, RECAUDA_CER) VALUES ('$CODIGO_CCAA','$year','$tipo',NULLIF('$v1',''),NULLIF('$v2',''),NULLIF('$v3',''),NULLIF('$v4',''),NULLIF('$v5',''),NULLIF('$v6',''))";
                            mysqli_query($conn,$insert);
                        }
                        else {
                            $row = mysqli_fetch_array($result);
                            $v1 = ($v1 === '') ? $row['PREV_INI'] : $v1;
                            $v2 = ($v2 === '') ? $row['MOD_PREV_INI'] : $v2;
                            $v3 = ($v3 === '') ? $row['PREV_DEF'] : $v3;
                            $v4 = ($v4 === '') ? $row['DER_REC'] : $v4;
                            $v5 = ($v5 === '') ? $row['RECAUDA_COR'] : $v5;
                            $v6 = ($v6 === '') ? $row['RECAUDA_CER'] : $v6;
                            //Si ya existe, entonces se actualiza con el nuevo valor dado en el excel
                            $update = "UPDATE cuentas_ccaa_ingresos SET 
                                        PREV_INI = NULLIF('$v1',''), 
                                        MOD_PREV_INI = NULLIF('$v2',''), 
                                        PREV_DEF = NULLIF('$v3',''), 
                                        DER_REC = NULLIF('$v4',''), 
                                        RECAUDA_COR = NULLIF('$v5',''), 
                                        RECAUDA_CER = NULLIF('$v6','') 
                                        WHERE ANHO = '$year' AND CODIGO = '$CODIGO_CCAA' AND TIPO = '$tipo'";
                            mysqli_query($conn, $update);
                        }
        
                    }
        
                    //Añadimos el tercer formato de datos GASTOS
                    $w = $q_end;
                    $w_end= $w+72;
                    for($w;$w<$w_end;$w+=6){
                        $col = explode("_",$fields[$w]);
                        $tipo = $col[0];
                        //echo "<br><b>".$tipo."</b><br>";
        
                        $v1 = str_replace(',', '.', $values[$w]);      //CRED_INI
                        $v2 = str_replace(',', '.', $values[$w+1]);    //MOD_CRED_INI
                        $v3 = str_replace(',', '.', $values[$w+2]);    //CRED_TOT
                        $v4 = str_replace(',', '.', $values[$w+3]);    //OBLG_REC
                        $v5 = str_replace(',', '.', $values[$w+4]);    //PAGOS_COR
                        $v6 = str_replace(',', '.', $values[$w+5]);    //PAGOS_CER
                        // Se revisa si la fila ya existe en la tabla o no
                        $query = "SELECT CODIGO, ANHO, TIPO FROM cuentas_ccaa_gastos WHERE ANHO = '$year' AND CODIGO = '$CODIGO_CCAA' AND TIPO = '$tipo'";
                        $result = mysqli_query($conn,$query);
                        if(!$result){
                            echo mysqli_error($conn)."<br>";
                            return false;
                        }
                        //Si no existe, entonces se inserta como una nueva fila
                        if(mysqli_num_rows($result)==0){
                            $insert = "INSERT INTO cuentas_ccaa_gastos(CODIGO, ANHO, TIPO, CRED_INI, MOD_CRED_INI, CRED_TOT, OBLG_REC, PAGOS_COR, PAGOS_CER) VALUES ('$CODIGO_CCAA','$year','$tipo',NULLIF('$v1',''),NULLIF('$v2',''),NULLIF('$v3',''),NULLIF('$v4',''),NULLIF('$v5',''),NULLIF('$v6',''))";
                            mysqli_query($conn,$insert);
                        }
                        else {
                            $row = mysqli_fetch_array($result);
                            $v1 = ($v1 === '') ? $row['CRED_INI'] : $v1;
                            $v2 = ($v2 === '') ? $row['MOD_CRED_INI'] : $v2;
                            $v3 = ($v3 === '') ? $row['CRED_TOT'] : $v3;
                            $v4 = ($v4 === '') ? $row['OBLG_REC'] : $v4;
                            $v5 = ($v5 === '') ? $row['PAGOS_COR'] : $v5;
                            $v6 = ($v6 === '') ? $row['PAGOS_CER'] : $v6;
                            //Si ya existe, entonces se actualiza con el nuevo valor dado en el excel
                            $update = "UPDATE cuentas_ccaa_gastos SET 
                                        CRED_INI = NULLIF('$v1',''), 
                                        MOD_CRED_INI = NULLIF('$v2',''), 
                                        CRED_TOT = NULLIF('$v3',''), 
                                        OBLG_REC = NULLIF('$v4',''), 
                                        PAGOS_COR = NULLIF('$v5',''), 
                                        PAGOS_CER = NULLIF('$v6','') 
                                        WHERE ANHO = '$year' AND CODIGO = '$CODIGO_CCAA' AND TIPO = '$tipo'";
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