<?php
require_once("includesWeb/config.php");
require_once('imports/configFile.php');
require_once("includes/vendor/autoload.php");

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;


class Importer_prog_mun{

    public function import_prog_mun($filename, $realname){
        $path = $filename;
        $doc = IOFactory::load($path);

        $hoja = $doc->getSheet(0);

        $rows = $hoja->getHighestDataRow();
        $cols = $hoja->getHighestDataColumn();
        $cols = Coordinate::columnIndexFromString($cols);

        $conn = getConexionBD();
        for($x = 1; $x < $rows + 1; $x++){
        
            for($y = 1; $y < $cols + 1; $y++){
        
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

                $ANHO = intval(((explode('_',(explode('.',$realname))[0]))[3])/100)-2;

                $MUNICIPIO=addslashes($values[1]);
                
                $AGSPC=floatval(str_replace(',', '.', $values[2]));

                $SOP=floatval(str_replace(',', '.', $values[3]));

                $OTE=floatval(str_replace(',', '.', $values[4]));

                $MU=floatval(str_replace(',', '.', $values[5]));

                $PC=floatval(str_replace(',', '.', $values[6]));
                
                $SPEI=floatval(str_replace(',', '.', $values[7]));
                                
                $PGVPP=floatval(str_replace(',', '.', $values[8]));
                                                
                $CRE=floatval(str_replace(',', '.', $values[9]));
                                                                
                $PVP=floatval(str_replace(',', '.', $values[10]));
                                                                                
                $A=floatval(str_replace(',', '.', $values[11]));
                                                                                
                $RGTR=floatval(str_replace(',', '.', $values[12]));
                                                                                                                
                $RR=floatval(str_replace(',', '.', $values[13]));
                                                                                                                
                $GRSU=floatval(str_replace(',', '.', $values[14]));
                                                                                                                                
                $TR=floatval(str_replace(',', '.', $values[15]));

                $LV=floatval(str_replace(',', '.', $values[16]));

                $CSF=floatval(str_replace(',', '.', $values[17]));

                $AP=floatval(str_replace(',', '.', $values[18]));

                $PJ=floatval(str_replace(',', '.', $values[19]));

                $P=floatval(str_replace(',', '.', $values[20]));

                $SSPS=floatval(str_replace(',', '.', $values[21]));
                
                $FE=floatval(str_replace(',', '.', $values[22]));

                $S=floatval(str_replace(',', '.', $values[23]));

                $E=floatval(str_replace(',', '.', $values[24]));

                $C=floatval(str_replace(',', '.', $values[25]));

                $D=floatval(str_replace(',', '.', $values[26]));

                $AGP=floatval(str_replace(',', '.', $values[27]));

                $IE=floatval(str_replace(',', '.', $values[28]));

                $COM=floatval(str_replace(',', '.', $values[29]));

                $TP=floatval(str_replace(',', '.', $values[30]));

                $IT=floatval(str_replace(',', '.', $values[31]));

                $IDI=floatval(str_replace(',', '.', $values[32]));

                $sql = "SELECT CODIGO, ANHO FROM prog_mun WHERE CODIGO='$CODIGO_MUN' AND ANHO='$ANHO'";
                $result = mysqli_query($conn,$sql);
                if(!$result){
                    echo mysqli_error($conn);
                    return false;
                }
                if(mysqli_num_rows($result)==0){ //No hay nada, hay que insertar
                    $insert="INSERT INTO prog_mun VALUES ('$CODIGO_MUN','$ANHO',NULLIF('$AGSPC',''),NULLIF('$SOP',''),NULLIF('$OTE',''),
                        NULLIF('$MU',''),NULLIF('$PC',''),NULLIF('$SPEI',''),NULLIF('$PGVPP',''),NULLIF('$CRE',''),NULLIF('$PVP',''),NULLIF('$A',''),
                        NULLIF('$RGTR',''),NULLIF('$RR',''),NULLIF('$GRSU',''),NULLIF('$TR',''),NULLIF('$LV',''),NULLIF('$CSF',''),NULLIF('$AP',''),
                        NULLIF('$PJ',''),NULLIF('$P',''),NULLIF('$SSPS',''),NULLIF('$FE',''),NULLIF('$S',''),NULLIF('$E',''),NULLIF('$C',''),
                        NULLIF('$D',''),NULLIF('$AGP',''),NULLIF('$IE',''),NULLIF('$COM',''),NULLIF('$TP',''),NULLIF('$IT',''),NULLIF('$IDI',''))";
                    $result=mysqli_query($conn,$insert);
                    if (!$result) {
                        echo mysqli_error($conn);
                        return false;
                    }
                }
                else { //Actualizar
                    $update="UPDATE prog_mun SET AGSPC=NULLIF('$AGSPC',''), SOP=NULLIF('$SOP',''), OTE=NULLIF('$OTE',''),
                    MU=NULLIF('$MU',''), PC=NULLIF('$PC',''), SPEI=NULLIF('$SPEI',''), PGVPP=NULLIF('$PGVPP',''), CRE=NULLIF('$CRE',''), PVP=NULLIF('$PVP',''), A=NULLIF('$A',''),
                    RGTR=NULLIF('$RGTR',''), RR=NULLIF('$RR',''), GRSU=NULLIF('$GRSU',''), TR=NULLIF('$TR',''), LV=NULLIF('$LV',''), CSF=NULLIF('$CSF',''), AP=NULLIF('$AP',''),
                    PJ=NULLIF('$PJ',''), P=NULLIF('$P',''), SSPS=NULLIF('$SSPS',''), FE=NULLIF('$FE',''), S=NULLIF('$S',''), E=NULLIF('$E',''), C=NULLIF('$C',''),
                    D=NULLIF('$D',''), AGP=NULLIF('$AGP',''), IE=NULLIF('$IE',''), COM=NULLIF('$COM',''), TP=NULLIF('$TP',''), IT=NULLIF('$IT',''), IDI=NULLIF('$IDI','') WHERE ANHO = '$ANHO' AND CODIGO = '$CODIGO_MUN'";
                    $result=mysqli_query($conn,$update);
                    if (!$result) {
                        echo mysqli_error($conn);
                        return false;
                    }
                }

                $values = array();
            }
        }

        return true;
    }

}
?>