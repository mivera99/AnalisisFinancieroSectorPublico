<?php

class DAOConsultorMunicipio{

    public function getGeneralInfo($nombre){
        $db = getConexionBD();
        $sql = "SELECT * FROM municipios WHERE NOMBRE = '$nombre'";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $municipio = new Municipio();
        $municipio_res = mysqli_fetch_assoc($result);

        $municipio->setCodigo($municipio_res['CODIGO']);
        $municipio->setNombre($municipio_res['NOMBRE']);
        
        $ccaaCode = $municipio_res['AUTONOMIA'];
        $sql = "SELECT NOMBRE FROM ccaas WHERE CODIGO = '$ccaaCode'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $autonomia = mysqli_fetch_assoc($result);
        $municipio->setAutonomia($autonomia['NOMBRE']);

        $provinciaCode = $municipio_res['PROVINCIA'];
        $sql = "SELECT NOMBRE FROM provincias WHERE CODIGO = '$provinciaCode'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $provincia = mysqli_fetch_array($result);
        $municipio->setProvincia($provincia['NOMBRE']);
        
        $municipio->setNombreAlcalde($municipio_res['NOMBREALCALDE']);
        $municipio->setApellido1($municipio_res['APELLIDO1ALCALDE']);
        $municipio->setApellido2($municipio_res['APELLIDO2ALCALDE']);
        $municipio->setVigencia($municipio_res['VIGENCIA']);
        $municipio->setPartido($municipio_res['PARTIDO']);
        $municipio->setCif($municipio_res['CIF']);
        $municipio->setTipoVia($municipio_res['TIPOVIA']);
        $municipio->setNumVia($municipio_res['NUMVIA']);
        $municipio->setNombreVia($municipio_res['NOMBREVIA']);
        $municipio->setTelefono($municipio_res['TELEFONO']);
        $municipio->setCodigoPostal($municipio_res['CODPOSTAL']);
        $municipio->setFax($municipio_res['FAX']);
        $municipio->setMail($municipio_res['MAIL']);
        $municipio->setWeb($municipio_res['WEB']);

        $cod = $municipio_res['CODIGO'];
        $sql = "SELECT RATING FROM scoring_mun WHERE CODIGO = '$cod' AND ANHO = '2021'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $scoring = mysqli_fetch_assoc($result);
        $municipio->setScoring($scoring['RATING']);


        /* INGRESOS */
        $cod = $municipio_res['CODIGO'];
        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2020' AND TIPO = 'PARTIDAINGR1'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $impuestos_directos1 = mysqli_fetch_assoc($result);
        $municipio->setImpuestosDirectos1($impuestos_directos1['DERE']);

        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2019' AND TIPO = 'PARTIDAINGR1'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $impuestos_directos2 = mysqli_fetch_assoc($result);
        $municipio->setImpuestosDirectos2($impuestos_directos2['DERE']);

        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2018' AND TIPO = 'PARTIDAINGR1'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $impuestos_directos3 = mysqli_fetch_assoc($result);
        $municipio->setImpuestosDirectos3($impuestos_directos3['DERE']);

        //Impuestos Indirectos
        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2020' AND TIPO = 'PARTIDAINGR2'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $impuestos_indirectos1 = mysqli_fetch_assoc($result);
        $municipio->setImpuestosIndirectos1($impuestos_indirectos1['DERE']);

        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2019' AND TIPO = 'PARTIDAINGR2'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $impuestos_indirectos2 = mysqli_fetch_assoc($result);
        $municipio->setImpuestosIndirectos2($impuestos_indirectos2['DERE']);

        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2018' AND TIPO = 'PARTIDAINGR2'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $impuestos_indirectos3 = mysqli_fetch_assoc($result);
        $municipio->setImpuestosIndirectos3($impuestos_indirectos3['DERE']);

        //Tasas Precios Otros
        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2020' AND TIPO = 'PARTIDAINGR3'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $tasas_precios_otros1 = mysqli_fetch_assoc($result);
        $municipio->setTasasPreciosOtros1($tasas_precios_otros1['DERE']);

        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2019' AND TIPO = 'PARTIDAINGR3'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $tasas_precios_otros2 = mysqli_fetch_assoc($result);
        $municipio->setTasasPreciosOtros2($tasas_precios_otros2['DERE']);

        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2018' AND TIPO = 'PARTIDAINGR3'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $tasas_precios_otros3 = mysqli_fetch_assoc($result);
        $municipio->setTasasPreciosOtros3($tasas_precios_otros3['DERE']);

        //Transferencias Corrientes
        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2020' AND TIPO = 'PARTIDAINGR4'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $transferencias_corrientes1 = mysqli_fetch_assoc($result);
        $municipio->setTransferenciasCorrientes1($transferencias_corrientes1['DERE']);

        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2019' AND TIPO = 'PARTIDAINGR4'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $transferencias_corrientes2 = mysqli_fetch_assoc($result);
        $municipio->setTransferenciasCorrientes2($transferencias_corrientes2['DERE']);

        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2018' AND TIPO = 'PARTIDAINGR4'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $transferencias_corrientes3 = mysqli_fetch_assoc($result);
        $municipio->setTransferenciasCorrientes3($transferencias_corrientes3['DERE']);

        //Ingresos Patrimoniales
        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2020' AND TIPO = 'PARTIDAINGR5'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $ingresos_patrimoniales1 = mysqli_fetch_assoc($result);
        $municipio->setIngresosPatrimoniales1($ingresos_patrimoniales1['DERE']);

        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2019' AND TIPO = 'PARTIDAINGR5'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $ingresos_patrimoniales2 = mysqli_fetch_assoc($result);
        $municipio->setIngresosPatrimoniales2($ingresos_patrimoniales2['DERE']);

        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2018' AND TIPO = 'PARTIDAINGR5'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $ingresos_patrimoniales3 = mysqli_fetch_assoc($result);
        $municipio->setIngresosPatrimoniales3($ingresos_patrimoniales3['DERE']);

        //Total Ingresos Corrientes
        $totalIngresosCorrientes1 = floatval($impuestos_directos1['DERE']) + floatval($impuestos_indirectos1['DERE']) + floatval($tasas_precios_otros1['DERE']) + floatval($transferencias_corrientes1['DERE']) + floatval($ingresos_patrimoniales1['DERE']);
        $municipio->setTotalIngresosCorrientes1($totalIngresosCorrientes1);

        $totalIngresosCorrientes2 = floatval($impuestos_directos2['DERE']) + floatval($impuestos_indirectos2['DERE']) + floatval($tasas_precios_otros2['DERE']) + floatval($transferencias_corrientes2['DERE']) + floatval($ingresos_patrimoniales2['DERE']);
        $municipio->setTotalIngresosCorrientes2($totalIngresosCorrientes2);

        $totalIngresosCorrientes3 = floatval($impuestos_directos3['DERE']) + floatval($impuestos_indirectos3['DERE']) + floatval($tasas_precios_otros3['DERE']) + floatval($transferencias_corrientes3['DERE']) + floatval($ingresos_patrimoniales3['DERE']);
        $municipio->setTotalIngresosCorrientes3($totalIngresosCorrientes3);

        //Enajenación de Inversiones Reales
        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2020' AND TIPO = 'PARTIDAINGR6'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $enajenacion_inversiones_reales1 = mysqli_fetch_assoc($result);
        $municipio->setEnajenacionInversionesReales1($enajenacion_inversiones_reales1['DERE']);

        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2019' AND TIPO = 'PARTIDAINGR6'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $enajenacion_inversiones_reales2 = mysqli_fetch_assoc($result);
        $municipio->setEnajenacionInversionesReales2($enajenacion_inversiones_reales2['DERE']);

        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2018' AND TIPO = 'PARTIDAINGR6'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $enajenacion_inversiones_reales3 = mysqli_fetch_assoc($result);
        $municipio->setEnajenacionInversionesReales3($enajenacion_inversiones_reales3['DERE']);

        //Transferencias de Capital
        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2020' AND TIPO = 'PARTIDAINGR7'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $transferencias_capital1 = mysqli_fetch_assoc($result);
        $municipio->setTransferenciasCapital1($transferencias_capital1['DERE']);

        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2019' AND TIPO = 'PARTIDAINGR7'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $transferencias_capital2 = mysqli_fetch_assoc($result);
        $municipio->setTransferenciasCapital2($transferencias_capital2['DERE']);

        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2018' AND TIPO = 'PARTIDAINGR7'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $transferencias_capital3 = mysqli_fetch_assoc($result);
        $municipio->setTransferenciasCapital3($transferencias_capital3['DERE']);

        //Ingresos No Financieros
        $total_ingresos_no_corrientes1 = floatval($enajenacion_inversiones_reales1['DERE']) + floatval($transferencias_capital1['DERE']);
        $municipio->setTotalIngresosNoCorrientes1($total_ingresos_no_corrientes1);

        $total_ingresos_no_corrientes2 = floatval($enajenacion_inversiones_reales2['DERE']) + floatval($transferencias_capital2['DERE']);
        $municipio->setTotalIngresosNoCorrientes2($total_ingresos_no_corrientes2);

        $total_ingresos_no_corrientes3 = floatval($enajenacion_inversiones_reales3['DERE']) + floatval($transferencias_capital3['DERE']);
        $municipio->setTotalIngresosNoCorrientes3($total_ingresos_no_corrientes3);

        //Activos Financieros
        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2020' AND TIPO = 'PARTIDAINGR8'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $activos_financieros1 = mysqli_fetch_assoc($result);
        $municipio->setActivosFinancieros1($activos_financieros1['DERE']);

        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2019' AND TIPO = 'PARTIDAINGR8'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $activos_financieros2 = mysqli_fetch_assoc($result);
        $municipio->setActivosFinancieros2($activos_financieros2['DERE']);

        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2018' AND TIPO = 'PARTIDAINGR8'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $activos_financieros3 = mysqli_fetch_assoc($result);
        $municipio->setActivosFinancieros3($activos_financieros3['DERE']);

        //Pasivos Financieros
        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2020' AND TIPO = 'PARTIDAINGR9'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $pasivos_financieros1 = mysqli_fetch_assoc($result);
        $municipio->setPasivosFinancieros1($pasivos_financieros1['DERE']);

        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2019' AND TIPO = 'PARTIDAINGR9'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $pasivos_financieros2 = mysqli_fetch_assoc($result);
        $municipio->setPasivosFinancieros2($pasivos_financieros2['DERE']);

        $sql = "SELECT DERE FROM cuentas_mun_ingresos WHERE CODIGO = '$cod' AND ANHO = '2018' AND TIPO = 'PARTIDAINGR9'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $pasivos_financieros3 = mysqli_fetch_assoc($result);
        $municipio->setPasivosFinancieros3($pasivos_financieros3['DERE']);

        //TOTAL INGRESOS
        $total_ingresos1 = $totalIngresosCorrientes1 + $total_ingresos_no_corrientes1 + $activos_financieros1['DERE'] + $pasivos_financieros1['DERE'];
        $municipio->setTotalIngresos1($total_ingresos1);

        $total_ingresos2 = floatval($totalIngresosCorrientes2) + floatval($total_ingresos_no_corrientes2) + floatval($activos_financieros2['DERE']) + floatval($pasivos_financieros2['DERE']);
        $municipio->setTotalIngresos2($total_ingresos2);

        $total_ingresos3 = floatval($totalIngresosCorrientes3) + floatval($total_ingresos_no_corrientes3) + floatval($activos_financieros3['DERE']) + floatval($pasivos_financieros3['DERE']);
        $municipio->setTotalIngresos3($total_ingresos3);



        return $municipio;
    }

}


?>