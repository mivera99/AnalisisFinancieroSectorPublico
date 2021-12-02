<?php

//Aumentamos la memoria de PHP para poder cargar la burrada de datos que tenemos
ini_set('memory_limit', '2G');
ini_set("default_charset", "UTF-8");
ini_set('max_execution_time', 5000);

/*
Importar libreria PHPSpreadsheet
*/

require "../includes/vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;

//Path del archivo
$path = "../files/BLOQUE_GENERAL_MUN_202109.xlsx";
//Cargamos el archivo en la variable de documento "doc"
$doc = IOFactory::load($path);

//Número total de hojas
$totalHojas = $doc->getSheetCount();

$hoja = $doc->getSheet(1);

//Última fila con datos
$rows = $hoja->getHighestDataRow();//Número
echo $rows."<br>";
$cols = $hoja->getHighestDataColumn();//Letra, hay que convertirlo a numero
echo $cols."<br>";
$cols = Coordinate::columnIndexFromString($cols);//Conversion a numero
echo $cols."<br>";


$conn = new mysqli("localhost", "root", "", "dbs_01");
//$conn = new mysqli("localhost", "root", "", "dbs_01");
$conn->set_charset("utf8");
$values=array();
$fields=array();





//Recorrer hoja
//for($x = 1; $x < $rows + 1; $x++)
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


        // EMPIEZA LA TOMA DE DATOS

        $CODIGO_MUN = $values[0];


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

                $v1 = $values[$q];      //PRES
                $v2 = $values[$q+1];    //DERE
                $v3 = $values[$q+2];    //RECA

                
                // Se revisa si la fila ya existe en la tabla o no
                $query = "SELECT CODIGO, ANHO, TIPO FROM cuentas_mun_ingresos WHERE ANHO = '$year' AND CODIGO = '$CODIGO_MUN' AND TIPO = '$tipo'";
                $result = mysqli_query($conn,$query);
                if(!$result){
                    echo mysqli_error($conn)."<br>";
                }
                //Si no existe, entonces se inserta como una nueva fila
                if(mysqli_num_rows($result)==0){
                    $insert = "INSERT INTO cuentas_mun_ingresos(CODIGO, ANHO, TIPO, PRES, DERE, RECA) VALUES ('$CODIGO_MUN','$year','$tipo',NULLIF('$v1',''),NULLIF('$v2',''),NULLIF('$v3',''))";
                    mysqli_query($conn,$insert);
                    echo mysqli_error($conn)."<br>";
                }
                else {
                    //Si ya existe, entonces se actualiza con el nuevo valor dado en el excel
                    $update = "UPDATE cuentas_mun_ingresos SET PRES = NULLIF('$v1',''), DERE = NULLIF('$v2',''), RECA = NULLIF('$v3','') WHERE ANHO = '$year' AND CODIGO = '$CODIGO_MUN' AND TIPO = '$tipo'";
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

                $v1 = $values[$q];      //PRES
                $v2 = $values[$q+1];    //OBLG
                $v3 = $values[$q+2];    //PAGOS


                // Se revisa si la fila ya existe en la tabla o no
                $query = "SELECT CODIGO, ANHO, TIPO FROM cuentas_mun_gastos WHERE ANHO = '$year' AND CODIGO = '$CODIGO_MUN' AND TIPO = '$tipo'";
                $result = mysqli_query($conn,$query);
                if(!$result){
                  echo mysqli_error($conn)."<br>";
                }
                //    Si no existe, entonces se inserta como una nueva fila
                if(mysqli_num_rows($result)==0){
                    $insert = "INSERT INTO cuentas_mun_gastos(CODIGO, ANHO, TIPO, PRES, OBLG, PAGOS) VALUES ('$CODIGO_MUN','$year','$tipo',NULLIF('$v1',''),NULLIF('$v2',''),NULLIF('$v3',''))";
                    mysqli_query($conn,$insert);
                }
                else {
                    //Si ya existe, entonces se actualiza con el nuevo valor dado en el excel
                    $update = "UPDATE cuentas_mun_gastos SET PRES = NULLIF('$v1',''), OBLG = NULLIF('$v2',''), PAGOS = NULLIF('$v3','') WHERE ANHO = '$year' AND CODIGO = '$CODIGO_MUN' AND TIPO = '$tipo'";
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
            $query = "SELECT CODIGO, ANHO, TRIMESTRE FROM cuentas_mun_pmp WHERE ANHO = '$year' AND CODIGO = '$CODIGO_MUN' AND TRIMESTRE = '$trimestre'";
            $result = mysqli_query($conn,$query);
            if(!$result){
                echo mysqli_error($conn)."<br>";
            }
            //Si no existe, entonces se inserta como una nueva fila
            if(mysqli_num_rows($result)==0){
                $insert = "INSERT INTO cuentas_mun_pmp(CODIGO, ANHO, TRIMESTRE, PMP) VALUES ('$CODIGO_MUN','$year','$trimestre',NULLIF('$valor',''))";
                mysqli_query($conn,$insert);
            }
            else {
                //Si ya existe, entonces se actualiza con el nuevo valor dado en el excel
                $update = "UPDATE cuentas_mun_pmp SET PMP = NULLIF('$valor','') WHERE ANHO = '$year' AND CODIGO = '$CODIGO_MUN' AND TRIMESTRE = '$trimestre'";
                mysqli_query($conn, $update);
            }


        }





        $values = array();
    }
}


echo "<b><h2>Terminó</h2></b>";