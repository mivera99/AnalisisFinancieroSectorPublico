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
ini_set('max_execution_time', 7000);

/*
Importar libreria PHPSpreadsheet
*/

require "../includes/vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;

//Path del archivo
$path = "../files/BLOQUE_GENERAL_MUN.xlsx";
//Cargamos el archivo en la variable de documento "doc"
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

$conn = new mysqli("localhost", "root", "", "dbs_01");
//$conn = new mysqli("db5005176895.hosting-data.io", "dbu1879501", "ij1YGZo@gIEKAJ#&PcCXpHR0o", "dbs4330017");
$conn->set_charset("utf8");
$values=array();
$fields=array();

for($x = 1; $x < $rows + 1; $x++){

    echo "<tr>";

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
        }
        if(mysqli_num_rows($result) == 0){
            $insert = "INSERT INTO provincias VALUES ('$CODIGO_PROV',NULLIF('$PROVINCIA',''))";
            mysqli_query($conn,$insert);
        }

        $AUTONOMIA=$values[5];
        $request = "SELECT CODIGO FROM ccaas WHERE NOMBRE = '$AUTONOMIA'";
        $result_query = mysqli_query($conn,$request);
        if(mysqli_num_rows($result_query)==0){
            $sql = "INSERT INTO ccaas (NOMBRE) VALUES ('$AUTONOMIA')";
            mysqli_query($conn,$sql);
            $request = "SELECT CODIGO FROM ccaas WHERE NOMBRE = '$AUTONOMIA'";
            $result_query = mysqli_query($conn,$request);
        }
        $dato_ccaa = mysqli_fetch_assoc($result_query);
        $CODIGO_CCAA = $dato_ccaa['CODIGO'];

        $POBLACION_2020=$values[6]; // debe de estar dividido de anhos?
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
        
        $sql="INSERT INTO municipios VALUES ('$CODIGO_MUN','$CIF_MUNICIPIO','$MUNICIPIO',NULLIF('$CODIGO_PROV',''),NULLIF('$CODIGO_CCAA',''),
        NULLIF('$POBLACION_2020',''),NULLIF('$NOMBREALCALDE',''),NULLIF('$APELLIDO1ALCALDE',''),NULLIF('$APELLIDO2ALCALDE',''),NULLIF('$VIGENCIA',''),NULLIF('$PARTIDO',''),NULLIF('$TIPOVIA',''),NULLIF('$NOMBREVIA',''),NULLIF('$NUMVIA',''),
        NULLIF('$CODPOSTAL',''),NULLIF('$TELEFONO',''),NULLIF('$FAX',''),NULLIF('$WEB',''),NULLIF('$MAIL',''))";
        $result=mysqli_query($conn,$sql);
        if (!$result) {
            echo mysqli_error($conn);
        }
        //Como sé yo en que trimestre es esto?
        $PARO_2021=$values[20];
        $TRANSAC_INMOBILIARIAS_2021=$values[21];
        $TRANSAC_INMOBILIARIAS_2020=$values[22];

        $arrayStr1 = explode('_',$fields[20]);
        $arrayStr2 = explode('_',$fields[21]);
        $arrayStr3 = explode('_',$fields[22]);

        $year1 = $arrayStr1[1];
        $year2 = $arrayStr3[2];

        $sql1 = "INSERT INTO cuentas_mun_pmp VALUES ('$CODIGO_MUN','$year2',4, NULL, NULL,'$TRANSAC_INMOBILIARIAS_2020')";
        $sql2 = "INSERT INTO cuentas_mun_pmp VALUES ('$CODIGO_MUN','$year1',4, NULL, '$PARO_2021','$TRANSAC_INMOBILIARIAS_2021')";

        mysqli_query($conn,$sql1);
        mysqli_query($conn,$sql2);

        for($k = 0; $k < count($fields);$k++){
            //En este caso en particular, a partir de la posición 23, comienzan los datos pertenecientes a la tabla deudas_mun
            if($k >= 23){
                //descompone el campo en varios strings que seran almacenados en un array
                $arrayStr = explode('_',$fields[$k]);
                $tipo = $arrayStr[0]; // obtenemos el tipo de la deuda del array de strings
                $year = $arrayStr[1]; // obtenemos el anho de la deuda del array de strings
                $value = $values[$k]; // obtenemos el valor correspondiente a ese campo
                //revisamos si el valor existe previamente en la tabla 
                $sql = "SELECT CODIGO, $tipo FROM deudas_mun WHERE CODIGO = '$CODIGO_MUN' AND ANHO = '$year' AND $tipo = '$value'";
                $result = mysqli_query($conn,$sql);
                if(!$result){
                    echo mysqli_error($conn);
                }
                // si no devuelve ninguna fila, eso quiere decir que la fila no existe, entonces se inserta con el valor dado
                if(mysqli_num_rows($result)==0){
                    $insert = "INSERT INTO deudas_mun (CODIGO, ANHO, $tipo) VALUES ('$CODIGO_MUN','$year', NULLIF('$value',''))";
                    mysqli_query($conn,$insert);
                }
                else {
                    //si ya existe la fila, entonces se actualiza el valor del campo con el nuevo valor dado del documento ($value)
                    $update = "UPDATE deudas_mun SET $tipo = NULLIF('$value','') WHERE ANHO = '$year' AND CODIGO = '$CODIGO_MUN'";
                    mysqli_query($conn, $update);
                }
            }
        }

        $values = array();
    }
}
/*
$sql = "SELECT * FROM municipios";

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