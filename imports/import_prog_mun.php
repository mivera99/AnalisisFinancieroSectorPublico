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

        //$fileMonth = intval((explode('_',(explode('.',$realname))[0]))[3])%100; // hecho para obtener el mes del titulo del archivo excel

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
                //echo "<b>" . $CODIGO_MUN . "<br>";
                //$CIF_MUNICIPIO=$values[1];

                $ANHO = intval(((explode('_',(explode('.',$realname))[0]))[3])/100)-1;
                //echo "AÑO: " . $ANHO . "<br>";



                $MUNICIPIO=addslashes($values[1]);
                // echo $MUNICIPIO . "</b><br>";
                
                $AGSPC=floatval(str_replace(',', '.', $values[2]));
                // echo $fields[2] . ": " . $AGSPC . "</b><br>";

                $SOP=floatval(str_replace(',', '.', $values[3]));
                // echo $fields[3] . ": " . $SOP . "</b><br>";

                $OTE=floatval(str_replace(',', '.', $values[4]));
                // echo $fields[4] . ": " . $OTE . "</b><br>";

                $MU=floatval(str_replace(',', '.', $values[5]));
                // echo $fields[5] . ": " . $MU . "</b><br>";

                $PC=floatval(str_replace(',', '.', $values[6]));
                // echo $fields[6] . ": " . $PC . "</b><br>";
                
                $SPEI=floatval(str_replace(',', '.', $values[7]));
                // echo $fields[7] . ": " . $SPEI . "</b><br>";
                                
                $PGVPP=floatval(str_replace(',', '.', $values[8]));
                // echo $fields[8] . ": " . $PGVPP . "</b><br>";
                                                
                $CRE=floatval(str_replace(',', '.', $values[9]));
                // echo $fields[9] . ": " . $CRE . "</b><br>";
                                                                
                $PVP=floatval(str_replace(',', '.', $values[10]));
                // echo $fields[10] . ": " . $PVP . "</b><br>";
                                                                                
                $A=floatval(str_replace(',', '.', $values[11]));
                // echo $fields[11] . ": " . $A . "</b><br>";
                                                                                                
                $RGTR=floatval(str_replace(',', '.', $values[12]));
                // echo $fields[12] . ": " . $RGTR . "</b><br>";
                                                                                                                
                $RR=floatval(str_replace(',', '.', $values[13]));
                // echo $fields[13] . ": " . $RR . "</b><br>";
                                                                                                                
                $GRSU=floatval(str_replace(',', '.', $values[14]));
                // echo $fields[14] . ": " . $GRSU . "</b><br>";
                                                                                                                                
                $TR=floatval(str_replace(',', '.', $values[15]));
                // echo $fields[15] . ": " . $TR . "</b><br>";

                $LV=floatval(str_replace(',', '.', $values[16]));
                // echo $fields[16] . ": " . $LV . "</b><br>";

                $CSF=floatval(str_replace(',', '.', $values[17]));
                // echo $fields[17] . ": " . $CSF . "</b><br>";

                $AP=floatval(str_replace(',', '.', $values[18]));
                // echo $fields[18] . ": " . $AP . "</b><br>";

                $PJ=floatval(str_replace(',', '.', $values[19]));
                // echo $fields[19] . ": " . $PJ . "</b><br>";

                $P=floatval(str_replace(',', '.', $values[20]));
                // echo $fields[20] . ": " . $P . "</b><br>";

                $SSPS=floatval(str_replace(',', '.', $values[21]));
                // echo $fields[21] . ": " . $SSPS . "</b><br>";

                $FE=floatval(str_replace(',', '.', $values[22]));
                // echo $fields[22] . ": " . $FE . "</b><br>";

                $S=floatval(str_replace(',', '.', $values[23]));
                // echo $fields[23] . ": " . $S . "</b><br>";

                $E=floatval(str_replace(',', '.', $values[24]));
                // echo $fields[24] . ": " . $E . "</b><br>";

                $C=floatval(str_replace(',', '.', $values[25]));
                // echo $fields[25] . ": " . $C . "</b><br>";

                $D=floatval(str_replace(',', '.', $values[26]));
                // echo $fields[26] . ": " . $D . "</b><br>";

                $AGP=floatval(str_replace(',', '.', $values[27]));
                // echo $fields[27] . ": " . $AGP . "</b><br>";

                $IE=floatval(str_replace(',', '.', $values[28]));
                // echo $fields[28] . ": " . $IE . "</b><br>";

                $COM=floatval(str_replace(',', '.', $values[29]));
                // echo $fields[29] . ": " . $COM . "</b><br>";

                $TP=floatval(str_replace(',', '.', $values[30]));
                // echo $fields[30] . ": " . $TP . "</b><br>";

                $IT=floatval(str_replace(',', '.', $values[31]));
                // echo $fields[31] . ": " . $IT . "</b><br>";

                $IDI=floatval(str_replace(',', '.', $values[32]));
                // echo $fields[32] . ": " . $IDI . "</b><br>";

        

                        
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