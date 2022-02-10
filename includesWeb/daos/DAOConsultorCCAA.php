<?php
require_once('includesWeb/config.php');
require_once('includesWeb/ccaa.php');

class DAOConsultorCCAA {

    public function getGeneralInfo($nombre){
        $db = getConexionBD();
        $sql = "SELECT * FROM ccaas WHERE NOMBRE = '$nombre'";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $ccaa = new CCAA();
        $ccaa_res = mysqli_fetch_assoc($result);
        
        if(isset($ccaa_res['CODIGO']))
            $ccaa->setCodigo($ccaa_res['CODIGO']);
        
        if(isset($ccaa_res['NOMBRE']))
            $ccaa->setNombre($ccaa_res['NOMBRE']);
        
        if(isset($ccaa_res['NOMBRE_PRESIDENTE']))
            $ccaa->setNombrePresidente($ccaa_res['NOMBRE_PRESIDENTE']);
        
        if(isset($ccaa_res['APELLIDO1_PRESIDENTE']))
            $ccaa->setApellido1($ccaa_res['APELLIDO1_PRESIDENTE']);
        
        if(isset($ccaa_res['APELLIDO2_PRESIDENTE']))
            $ccaa->setApellido2($ccaa_res['APELLIDO2_PRESIDENTE']);
        
        if(isset($ccaa_res['VIGENCIA']))
            $ccaa->setVigencia($ccaa_res['VIGENCIA']);
        
        if(isset($ccaa_res['PARTIDO']))
            $ccaa->setPartido($ccaa_res['PARTIDO']);
        
        if(isset($ccaa_res['CIF']))
            $ccaa->setCif($ccaa_res['CIF']);
        
        if(isset($ccaa_res['TIPO_VIA']))
            $ccaa->setTipoVia($ccaa_res['TIPO_VIA']);
        
        if(isset($ccaa_res['NUM_VIA']))
            $ccaa->setNumVia($ccaa_res['NUM_VIA']);
        
        if(isset($ccaa_res['NOMBRE_VIA']))
            $ccaa->setNombreVia($ccaa_res['NOMBRE_VIA']);
        
        if(isset($ccaa_res['TELEFONO']))
            $ccaa->setTelefono($ccaa_res['TELEFONO']);
        
        if(isset($ccaa_res['COD_POSTAL']))
            $ccaa->setCodigoPostal($ccaa_res['COD_POSTAL']);
        
        if(isset($ccaa_res['FAX']))
            $ccaa->setFax($ccaa_res['FAX']);
        
        if(isset($ccaa_res['MAIL']))
            $ccaa->setMail($ccaa_res['MAIL']);
        
        if(isset($ccaa_res['WEB']))
            $ccaa->setWeb($ccaa_res['WEB']);

        return $ccaa;
    }

    public function getIngresos($codigo, $year){
        $db = getConexionBD();
        /*$sql = "SELECT * FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND ANHO = '$year'";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $ccaa = new CCAA();
        $ccaa_res = mysqli_fetch_assoc($result);

        $ccaa->setPrevIni($ccaa_res['PREV_INI']);
        $ccaa->setModPrevIni($ccaa_res['MOD_PREV_INI']);
        $ccaa->setPrevDef($ccaa_res['PREV_DEF']);
        $ccaa->setDerRec($ccaa_res['DER_REC']);
        $ccaa->setRecaudaCor($ccaa_res['RECAUDA_COR']);
        $ccaa->setRecaudaCer($ccaa_res['RECAUDA_CER']);
        */
        $ccaa = new CCAA();
        /* INGRESOS */
        $sql = "SELECT DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAINGR1'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $impuestos_directos1 = mysqli_fetch_assoc($result);
        
        if(isset($impuestos_directos1['DER_REC']))
            $ccaa->setImpuestosDirectos1($impuestos_directos1['DER_REC']);

        //Impuestos Indirectos
        $sql = "SELECT DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAINGR2'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $impuestos_indirectos1 = mysqli_fetch_assoc($result);
        
        if(isset($impuestos_indirectos1['DER_REC']))
            $ccaa->setImpuestosIndirectos1($impuestos_indirectos1['DER_REC']);

        //Tasas Precios Otros
        $sql = "SELECT DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAINGR3'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $tasas_precios_otros1 = mysqli_fetch_assoc($result);
        
        if(isset($tasas_precios_otros1['DER_REC']))
            $ccaa->setTasasPreciosOtros1($tasas_precios_otros1['DER_REC']);

        //Transferencias Corrientes
        $sql = "SELECT DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAINGR4'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $transferencias_corrientes1 = mysqli_fetch_assoc($result);
        
        if(isset($transferencias_corrientes1['DER_REC']))
            $ccaa->setTransferenciasCorrientes1($transferencias_corrientes1['DER_REC']);

        //Ingresos Patrimoniales
        $sql = "SELECT DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAINGR5'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $ingresos_patrimoniales1 = mysqli_fetch_assoc($result);
        
        if(isset($ingresos_patrimoniales1['DER_REC']))
            $ccaa->setIngresosPatrimoniales1($ingresos_patrimoniales1['DER_REC']);

        //Total Ingresos Corrientes
        $sql = "SELECT DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAINGRESOS CORRIENTES'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $total_ingresos_corrientes = mysqli_fetch_assoc($result);
        
        if(isset($total_ingresos_corrientes['DER_REC']))
            $ccaa->setTotalIngresosCorrientes1($total_ingresos_corrientes['DER_REC']);

        //Enajenación de Inversiones Reales
        $sql = "SELECT DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAINGR6'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $enajenacion_inversiones_reales1 = mysqli_fetch_assoc($result);
        
        if(isset($enajenacion_inversiones_reales1['DER_REC']))
            $ccaa->setEnajenacionInversionesReales1($enajenacion_inversiones_reales1['DER_REC']);

        //Transferencias de Capital
        $sql = "SELECT DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAINGR7'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $transferencias_capital1 = mysqli_fetch_assoc($result);
        
        if(isset($transferencias_capital1['DER_REC']))
            $ccaa->setTransferenciasCapital1($transferencias_capital1['DER_REC']);

        //Ingresos No Financieros
        $sql = "SELECT DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDA INGRESOS NO FINANCIEROS'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $total_ingresos_no_corrientes1 = mysqli_fetch_assoc($result);
        
        if(isset($total_ingresos_no_corrientes1['DER_REC']))
            $ccaa->setTotalIngresosNoCorrientes1($total_ingresos_no_corrientes1['DER_REC']);

        //Activos Financieros
        $sql = "SELECT DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAINGR8'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $activos_financieros1 = mysqli_fetch_assoc($result);
        
        if(isset($activos_financieros1['DER_REC']))
            $ccaa->setActivosFinancieros1($activos_financieros1['DER_REC']);

        //Pasivos Financieros
        $sql = "SELECT DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAINGR9'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $pasivos_financieros1 = mysqli_fetch_assoc($result);
        
        if(isset($pasivos_financieros1['DER_REC']))
            $ccaa->setPasivosFinancieros1($pasivos_financieros1['DER_REC']);

        //TOTAL INGRESOS

        $sql = "SELECT DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDA INGRESOS TOTALES'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $total_ingresos1 = mysqli_fetch_assoc($result);
        
        if(isset($total_ingresos1['DER_REC']))
            $ccaa->setTotalIngresos1($total_ingresos1['DER_REC']);

        return $ccaa;
    }

    public function getGastos($codigo, $year){
        $db = getConexionBD();
        /*$sql = "SELECT * FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND ANHO = '$year'";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $ccaa = new CCAA();
        $ccaa_res = mysqli_fetch_assoc($result);

        $ccaa->setCredIni($ccaa_res['CRED_INI']);
        $ccaa->setModCred($ccaa_res['MOD_CRED']);
        $ccaa->setCredTot($ccaa_res['CRED_TOT']);
        $ccaa->setOblgRec($ccaa_res['OBLG_REC']);
        $ccaa->setPagosCor($ccaa_res['PAGOS_COR']);
        $ccaa->setPagosCer($ccaa_res['PAGOS_CER']);
        */
        $ccaa = new CCAA();

        /* GASTOS */
        $sql = "SELECT OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAGAST1'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $gastos_personal1 = mysqli_fetch_assoc($result);
        
        if(isset($gastos_personal1['OBLG_REC']))
            $ccaa->setGastosPersonal1($gastos_personal1['OBLG_REC']);

        //Gastos Corrientes de Bienes y Servicios
        $sql = "SELECT OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAGAST2'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $gastos_corrientes_bienes_servicios1 = mysqli_fetch_assoc($result);
        
        if(isset($gastos_corrientes_bienes_servicios1['OBLG_REC']))
            $ccaa->setGastosCorrientesBienesServicios1($gastos_corrientes_bienes_servicios1['OBLG_REC']);

        //Gastos Financieros
        $sql = "SELECT OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAGAST3'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $gastos_financieros1 = mysqli_fetch_assoc($result);
        
        if(isset($gastos_financieros1['OBLG_REC']))
            $ccaa->setGastosFinancieros1($gastos_financieros1['OBLG_REC']);

        //Transferencias Corrientes
        $sql = "SELECT OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAGAST4'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $transferencias_corrientes_gastos1 = mysqli_fetch_assoc($result);
        
        if(isset($transferencias_corrientes_gastos1['OBLG_REC']))
            $ccaa->setTransferenciasCorrientesGastos1($transferencias_corrientes_gastos1['OBLG_REC']);

        //Fondo Contingencia
        $sql = "SELECT OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAGAST5'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $fondo_contingencia1 = mysqli_fetch_assoc($result);
        
        if(isset($fondo_contingencia1['OBLG_REC']))
            $ccaa->setFondoContingencia1($fondo_contingencia1['OBLG_REC']);

        //Total Gastos Corrientes
        if(isset($gastos_personal1['OBLG_REC']) && isset($gastos_corrientes_bienes_servicios1['OBLG_REC']) && isset($gastos_financieros1['OBLG_REC']) && isset($transferencias_corrientes_gastos1['OBLG_REC']) && isset($fondo_contingencia1['OBLG_REC'])){
            $total_gastos_corrientes1 = floatval($gastos_personal1['OBLG_REC']) + floatval($gastos_corrientes_bienes_servicios1['OBLG_REC']) + floatval($gastos_financieros1['OBLG_REC']) + floatval($transferencias_corrientes_gastos1['OBLG_REC']) + floatval($fondo_contingencia1['OBLG_REC']);
            $ccaa->setTotalGastosCorrientes1($total_gastos_corrientes1);
        }
        //Inversiones Reales
        $sql = "SELECT OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAGAST6'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $inversiones_reales1 = mysqli_fetch_assoc($result);
        
        if(isset($inversiones_reales1['OBLG_REC']))
            $ccaa->setInversionesReales1($inversiones_reales1['OBLG_REC']);

        //Transferencias de Capital
        $sql = "SELECT OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAGAST7'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $transferencias_capital_gastos1 = mysqli_fetch_assoc($result);
        
        if(isset($transferencias_capital_gastos1['OBLG_REC']))
            $ccaa->setTransferenciasCapitalGastos1($transferencias_capital_gastos1['OBLG_REC']);

        //Gastos No Financieros
        $sql = "SELECT OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAGASTOS NO FINANCIEROS'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $total_gastos_no_financieros1 = mysqli_fetch_assoc($result);
        
        if(isset($total_gastos_no_financieros1['OBLG_REC']))
            $ccaa->setTotalGastosNoFinancieros1($total_gastos_no_financieros1['OBLG_REC']);

        //Activos Financieros
        $sql = "SELECT OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAGAST8'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $activos_financieros_gastos1 = mysqli_fetch_assoc($result);
        
        if(isset($activos_financieros_gastos1['OBLG_REC']))
            $ccaa->setActivosFinancierosGastos1($activos_financieros_gastos1['OBLG_REC']);

        //Pasivos Financieros
        $sql = "SELECT OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAGAST9'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $pasivos_financieros_gastos1 = mysqli_fetch_assoc($result);
        
        if(isset($pasivos_financieros_gastos1['OBLG_REC']))
            $ccaa->setPasivosFinancierosGastos1($pasivos_financieros_gastos1['OBLG_REC']);

        //TOTAL GASTOS

        $sql = "SELECT OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDA GASTOS TOTALES'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $total_gastos1 = mysqli_fetch_assoc($result);
        
        if(isset($total_gastos1['OBLG_REC']))
            $ccaa->setTotalGastos1($total_gastos1['OBLG_REC']);


        return $ccaa;
    }

    public function getRatingInfo($codigo, $year){
        $db = getConexionBD();
        $sql = "SELECT * FROM scoring_ccaa WHERE CODIGO = '$codigo' AND ANHO = '$year'";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $ccaa = new CCAA();
        $scoring = mysqli_fetch_assoc($result);

        if(isset($scoring['RATING']))
            $ccaa->setScoring($scoring['RATING']);
        
        if(isset($scoring['TENDENCIA']))
            $ccaa->setTendencia($scoring['TENDENCIA']);
        
        if(isset($scoring['POBLACION']))
            $ccaa->setPoblacion($scoring['POBLACION']);

        return $ccaa;
    }

    public function getCuentasGeneral($codigo, $year){
        $db = getConexionBD();
        $sql = "SELECT * FROM cuentas_ccaa_general WHERE CODIGO = '$codigo' AND ANHO = '$year'";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $ccaa = new CCAA();
        $cuentas = mysqli_fetch_assoc($result);

        if(isset($cuentas['INCR_PIB']))
            $ccaa->setIncrPib($cuentas['INCR_PIB']);
        
        if(isset($cuentas['N_EMPRESAS']))
            $ccaa->setEmpresas($cuentas['N_EMPRESAS']);
        
        if(isset($cuentas['CCAA_PIB']))
            $ccaa->setCCAAPib($cuentas['CCAA_PIB']);
        
        if(isset($cuentas['R_SOSTE_FINANCIERA']))
            $ccaa->setRSosteFinanciera($cuentas['R_SOSTE_FINANCIERA']);
        
        if(isset($cuentas['R_EFIC']))
            $ccaa->setREfic($cuentas['R_EFIC']);
        
        if(isset($cuentas['R_RIGIDEZ']))
            $ccaa->setRRigidez($cuentas['R_RIGIDEZ']);
        
        if(isset($cuentas['R_SOSTE_ENDEUDA']))
            $ccaa->setRSosteEndeuda($cuentas['R_SOSTE_ENDEUDA']);
        
        if(isset($cuentas['R_EJE_INGR_CORR']))
            $ccaa->setREjeIngrCorr($cuentas['R_EJE_INGR_CORR']);
        
        if(isset($cuentas['R_EJE_GASTOS_CORR']))
            $ccaa->setREjeGastosCorr($cuentas['R_EJE_GASTOS_CORR']);
        
        if(isset($cuentas['PAGOS_OBLIGACIONES']))
            $ccaa->setPagosObligaciones($cuentas['PAGOS_OBLIGACIONES']);
        
        if(isset($cuentas['R_EFICACIA_REC']))
            $ccaa->setREficaciaRec($cuentas['R_EFICACIA_REC']);

        return $ccaa;
    }

    public function getCuentasGeneralMensual($codigo, $year, $month){
        $db = getConexionBD();
        $sql = "SELECT * FROM cuentas_ccaa_general_mensual WHERE CODIGO = '$codigo' AND ANHO = '$year' AND MES = '$month'";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $ccaa = new CCAA();
        $cuentas = mysqli_fetch_assoc($result);
        if(isset($cuentas['PARO']))
            $ccaa->setParo($cuentas['PARO']);
        
        if(isset($cuentas['PMP']))
            $ccaa->setPMP($cuentas['PMP']);
        
        if(isset($cuentas['R_DCPP']))
            $ccaa->setRDCPP($cuentas['R_DCPP']);
        
        if(isset($cuentas['DEUDAVIVA']))
            $ccaa->setDeudaViva($cuentas['DEUDAVIVA']);
        
        if(isset($cuentas['DEUDA_VIVA_INGR_COR']))
            $ccaa->setDeudaVivaIngrCor($cuentas['DEUDA_VIVA_INGR_COR']);
        
        if(isset($cuentas['TRANSAC_INMOBILIARIAS']))
            $ccaa->setTransacInmobiliarias($cuentas['TRANSAC_INMOBILIARIAS']);

        return $ccaa;
    }

    public function getDeudas($codigo, $year){
        $db = getConexionBD();
        $sql = "SELECT * FROM deudas_ccaa WHERE CODIGO = '$codigo' AND ANHO = '$year'";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $ccaa = new CCAA();
        $deudas = mysqli_fetch_assoc($result);
        if(isset($deudas['PIB']))
            $ccaa->setPib($deudas['PIB']);
        
        if(isset($deudas['PIBC']))
            $ccaa->setPibc($deudas['PIBC']);
        
        if(isset($deudas['RESULTADO']))
            $ccaa->setResultado($deudas['RESULTADO']);

        return $ccaa;
    }

}

?>