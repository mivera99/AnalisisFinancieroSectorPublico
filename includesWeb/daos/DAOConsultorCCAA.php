<?php
require_once('includesWeb/config.php');

class DAOConsultorCCAA {

    public function getGeneralInfo($nombre){
        $db = getConexionBD();
        $sql = "SELECT CODIGO, NOMBRE, NOMBRE_PRESIDENTE, APELLIDO1_PRESIDENTE, APELLIDO2_PRESIDENTE, VIGENCIA, PARTIDO, CIF, TIPO_VIA, NUM_VIA, NOMBRE_VIA, TELEFONO, COD_POSTAL, FAX, MAIL, WEB FROM ccaas WHERE NOMBRE = '$nombre'";
        $result = mysqli_query($db, $sql);
        if(!$result || mysqli_num_rows($result)==0){
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
        $ccaa = new CCAA();
        /* INGRESOS */
        $sql = "SELECT DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAINGR1' LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $impuestos_directos1 = mysqli_fetch_assoc($result);
        
        if(isset($impuestos_directos1['DER_REC']))
            $ccaa->setImpuestosDirectos1($impuestos_directos1['DER_REC']);

        //Impuestos Indirectos
        $sql = "SELECT DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAINGR2' LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $impuestos_indirectos1 = mysqli_fetch_assoc($result);
        
        if(isset($impuestos_indirectos1['DER_REC']))
            $ccaa->setImpuestosIndirectos1($impuestos_indirectos1['DER_REC']);

        //Tasas Precios Otros
        $sql = "SELECT DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAINGR3' LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $tasas_precios_otros1 = mysqli_fetch_assoc($result);
        
        if(isset($tasas_precios_otros1['DER_REC']))
            $ccaa->setTasasPreciosOtros1($tasas_precios_otros1['DER_REC']);

        //Transferencias Corrientes
        $sql = "SELECT DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAINGR4' LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $transferencias_corrientes1 = mysqli_fetch_assoc($result);
        
        if(isset($transferencias_corrientes1['DER_REC']))
            $ccaa->setTransferenciasCorrientes1($transferencias_corrientes1['DER_REC']);

        //Ingresos Patrimoniales
        $sql = "SELECT DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAINGR5' LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $ingresos_patrimoniales1 = mysqli_fetch_assoc($result);
        
        if(isset($ingresos_patrimoniales1['DER_REC']))
            $ccaa->setIngresosPatrimoniales1($ingresos_patrimoniales1['DER_REC']);

        //Total Ingresos Corrientes
        $sql = "SELECT DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAINGRESOS CORRIENTES' LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $total_ingresos_corrientes = mysqli_fetch_assoc($result);
        
        if(isset($total_ingresos_corrientes['DER_REC']))
            $ccaa->setTotalIngresosCorrientes1($total_ingresos_corrientes['DER_REC']);

        //Enajenación de Inversiones Reales
        $sql = "SELECT DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAINGR6' LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $enajenacion_inversiones_reales1 = mysqli_fetch_assoc($result);
        
        if(isset($enajenacion_inversiones_reales1['DER_REC']))
            $ccaa->setEnajenacionInversionesReales1($enajenacion_inversiones_reales1['DER_REC']);

        //Transferencias de Capital
        $sql = "SELECT DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAINGR7' LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $transferencias_capital1 = mysqli_fetch_assoc($result);
        
        if(isset($transferencias_capital1['DER_REC']))
            $ccaa->setTransferenciasCapital1($transferencias_capital1['DER_REC']);

        //Ingresos No Financieros
        $sql = "SELECT DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDA INGRESOS NO FINANCIEROS' LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $total_ingresos_no_corrientes1 = mysqli_fetch_assoc($result);
        
        if(isset($total_ingresos_no_corrientes1['DER_REC']))
            $ccaa->setTotalIngresosNoCorrientes1($total_ingresos_no_corrientes1['DER_REC']);

        //Activos Financieros
        $sql = "SELECT DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAINGR8' LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $activos_financieros1 = mysqli_fetch_assoc($result);
        
        if(isset($activos_financieros1['DER_REC']))
            $ccaa->setActivosFinancieros1($activos_financieros1['DER_REC']);

        //Pasivos Financieros
        $sql = "SELECT DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAINGR9' LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $pasivos_financieros1 = mysqli_fetch_assoc($result);
        
        if(isset($pasivos_financieros1['DER_REC']))
            $ccaa->setPasivosFinancieros1($pasivos_financieros1['DER_REC']);

        //TOTAL INGRESOS

        $sql = "SELECT DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDA INGRESOS TOTALES' LIMIT 3";
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
        $ccaa = new CCAA();

        /* GASTOS */
        $sql = "SELECT OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAGAST1' LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $gastos_personal1 = mysqli_fetch_assoc($result);
        
        if(isset($gastos_personal1['OBLG_REC']))
            $ccaa->setGastosPersonal1($gastos_personal1['OBLG_REC']);

        //Gastos Corrientes de Bienes y Servicios
        $sql = "SELECT OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAGAST2' LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $gastos_corrientes_bienes_servicios1 = mysqli_fetch_assoc($result);
        
        if(isset($gastos_corrientes_bienes_servicios1['OBLG_REC']))
            $ccaa->setGastosCorrientesBienesServicios1($gastos_corrientes_bienes_servicios1['OBLG_REC']);

        //Gastos Financieros
        $sql = "SELECT OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAGAST3' LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $gastos_financieros1 = mysqli_fetch_assoc($result);
        
        if(isset($gastos_financieros1['OBLG_REC']))
            $ccaa->setGastosFinancieros1($gastos_financieros1['OBLG_REC']);

        //Transferencias Corrientes
        $sql = "SELECT OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAGAST4' LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $transferencias_corrientes_gastos1 = mysqli_fetch_assoc($result);
        
        if(isset($transferencias_corrientes_gastos1['OBLG_REC']))
            $ccaa->setTransferenciasCorrientesGastos1($transferencias_corrientes_gastos1['OBLG_REC']);

        //Fondo Contingencia
        $sql = "SELECT OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAGAST5' LIMIT 3";
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
        $sql = "SELECT OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAGAST6' LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $inversiones_reales1 = mysqli_fetch_assoc($result);
        
        if(isset($inversiones_reales1['OBLG_REC']))
            $ccaa->setInversionesReales1($inversiones_reales1['OBLG_REC']);

        //Transferencias de Capital
        $sql = "SELECT OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAGAST7' LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $transferencias_capital_gastos1 = mysqli_fetch_assoc($result);
        
        if(isset($transferencias_capital_gastos1['OBLG_REC']))
            $ccaa->setTransferenciasCapitalGastos1($transferencias_capital_gastos1['OBLG_REC']);

        //Gastos No Financieros
        $sql = "SELECT OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAGASTOS NO FINANCIEROS' LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $total_gastos_no_financieros1 = mysqli_fetch_assoc($result);
        
        if(isset($total_gastos_no_financieros1['OBLG_REC']))
            $ccaa->setTotalGastosNoFinancieros1($total_gastos_no_financieros1['OBLG_REC']);

        //Activos Financieros
        $sql = "SELECT OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAGAST8' LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $activos_financieros_gastos1 = mysqli_fetch_assoc($result);
        
        if(isset($activos_financieros_gastos1['OBLG_REC']))
            $ccaa->setActivosFinancierosGastos1($activos_financieros_gastos1['OBLG_REC']);

        //Pasivos Financieros
        $sql = "SELECT OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDAGAST9' LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $pasivos_financieros_gastos1 = mysqli_fetch_assoc($result);
        
        if(isset($pasivos_financieros_gastos1['OBLG_REC']))
            $ccaa->setPasivosFinancierosGastos1($pasivos_financieros_gastos1['OBLG_REC']);

        //TOTAL GASTOS

        $sql = "SELECT OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND ANHO = '$year' AND TIPO = 'PARTIDA GASTOS TOTALES' LIMIT 3";
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
        $sql = "SELECT RATING, TENDENCIA, POBLACION FROM scoring_ccaa WHERE CODIGO = '$codigo' AND ANHO = '$year'";
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
        $sql = "SELECT INCR_PIB, N_EMPRESAS, CCAA_PIB, R_SOSTE_FINANCIERA, R_EFIC, R_RIGIDEZ, R_SOSTE_ENDEUDA, R_EJE_INGR_CORR, R_EJE_GASTOS_CORR, PAGOS_OLIGACIONALES, R_EFICACIA_REC  FROM cuentas_ccaa_general WHERE CODIGO = '$codigo' AND ANHO = '$year'";
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
        $sql = "SELECT PARO, PMP, R_DCPP, DEUDAVIVA, DEUDA_VIVA_INGR_COR, TRANSAC_INMOBILIARIAS FROM cuentas_ccaa_general_mensual WHERE CODIGO = '$codigo' AND ANHO = '$year' AND MES = '$month'";
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
        $sql = "SELECT PIB, PIBC, RESULTADO FROM deudas_ccaa WHERE CODIGO = '$codigo' AND ANHO = '$year'";
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

    public function getRatingCCAA($codigo){
        $db = getConexionBD();
        $sql = "SELECT DISTINCT ANHO, POBLACION FROM scoring_ccaa WHERE CODIGO = '$codigo' AND POBLACION IS NOT NULL ORDER BY ANHO DESC";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $ccaa = new CCAA();
        $poblacion = mysqli_fetch_assoc($result);

        $sql = "SELECT DISTINCT ANHO, RATING, TENDENCIA FROM scoring_ccaa WHERE CODIGO = '$codigo' AND RATING IS NOT NULL AND TENDENCIA IS NOT NULL ORDER BY ANHO DESC LIMIT 2";
        $scoring = mysqli_fetch_assoc($result);
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $ratings=array();
        $tendencias=array();
        while($scoring = mysqli_fetch_assoc($result)){
            $key=$scoring['ANHO'];
            $value=$scoring['RATING'];
            $ratings[$key]=$value;

            $key=$scoring['ANHO'];
            $value=$scoring['TENDENCIA'];
            $tendencias[$key]=$value;
        }
        $ccaa->setScoring($ratings);
        $ccaa->setTendencia($tendencias);

        $elements=array();
        $key=$poblacion['ANHO'];
        $value=$poblacion['POBLACION'];
        $elements[$key]=$value;
        $ccaa->setPoblacion($elements);
        
        return $ccaa;
    }

    public function getCuentasGeneralCCAA($codigo){
        $db = getConexionBD();
        $ccaa = new CCAA();
        
        $sql = "SELECT ANHO, INCR_PIB FROM cuentas_ccaa_general WHERE CODIGO = '$codigo' AND INCR_PIB IS NOT NULL ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($incr_pib = mysqli_fetch_assoc($result)){
            $key=$incr_pib['ANHO'];
            $value=$incr_pib['INCR_PIB'];
            $elements[$key]=$value;
        }
        $ccaa->setIncrPib($elements);
        
        $sql = "SELECT ANHO, N_EMPRESAS FROM cuentas_ccaa_general WHERE CODIGO = '$codigo' AND N_EMPRESAS IS NOT NULL ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($empresas = mysqli_fetch_assoc($result)){
            $key=$empresas['ANHO'];
            $value=$empresas['N_EMPRESAS'];
            $elements[$key]=$value;
        }
        $ccaa->setEmpresas($elements);

        $sql = "SELECT ANHO, CCAA_PIB FROM cuentas_ccaa_general WHERE CODIGO = '$codigo' AND CCAA_PIB IS NOT NULL ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($ccaa_pib = mysqli_fetch_assoc($result)){
            $key=$ccaa_pib['ANHO'];
            $value=$ccaa_pib['CCAA_PIB'];
            $elements[$key]=$value;
        }
        $ccaa->setCCAAPib($elements);

        $sql = "SELECT ANHO, R_SOSTE_FINANCIERA FROM cuentas_ccaa_general WHERE CODIGO = '$codigo' AND R_SOSTE_FINANCIERA IS NOT NULL ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($r_financiera = mysqli_fetch_assoc($result)){
            $key=$r_financiera['ANHO'];
            $value=$r_financiera['R_SOSTE_FINANCIERA'];
            $elements[$key]=$value;
        }
        $ccaa->setRSosteFinanciera($elements);

        $sql = "SELECT ANHO, R_EFIC FROM cuentas_ccaa_general WHERE CODIGO = '$codigo' AND R_EFIC IS NOT NULL ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($r_efic = mysqli_fetch_assoc($result)){
            $key=$r_efic['ANHO'];
            $value=$r_efic['R_EFIC'];
            $elements[$key]=$value;
        }
        $ccaa->setREfic($elements);

        $sql = "SELECT ANHO, R_RIGIDEZ FROM cuentas_ccaa_general WHERE CODIGO = '$codigo' AND R_RIGIDEZ IS NOT NULL ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($rigidez = mysqli_fetch_assoc($result)){
            $key=$rigidez['ANHO'];
            $value=$rigidez['R_RIGIDEZ'];
            $elements[$key]=$value;
        }
        $ccaa->setRRigidez($elements);

        $sql = "SELECT ANHO, R_SOSTE_ENDEUDA FROM cuentas_ccaa_general WHERE CODIGO = '$codigo' AND R_SOSTE_ENDEUDA IS NOT NULL ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($endeuda = mysqli_fetch_assoc($result)){
            $key=$endeuda['ANHO'];
            $value=$endeuda['R_SOSTE_ENDEUDA'];
            $elements[$key]=$value;
        }
        $ccaa->setRSosteEndeuda($elements);

        $sql = "SELECT ANHO, R_EJE_INGR_CORR FROM cuentas_ccaa_general WHERE CODIGO = '$codigo' AND R_EJE_INGR_CORR IS NOT NULL ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($ingresos = mysqli_fetch_assoc($result)){
            $key=$ingresos['ANHO'];
            $value=$ingresos['R_EJE_INGR_CORR'];
            $elements[$key]=$value;
        }
        $ccaa->setREjeIngrCorr($elements);
        
        $sql = "SELECT ANHO, R_EJE_GASTOS_CORR FROM cuentas_ccaa_general WHERE CODIGO = '$codigo' AND R_EJE_GASTOS_CORR IS NOT NULL ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($gastos = mysqli_fetch_assoc($result)){
            $key=$gastos['ANHO'];
            $value=$gastos['R_EJE_GASTOS_CORR'];
            $elements[$key]=$value;
        }
        $ccaa->setREjeGastosCorr($elements);

        $sql = "SELECT ANHO, PAGOS_OBLIGACIONES FROM cuentas_ccaa_general WHERE CODIGO = '$codigo' AND PAGOS_OBLIGACIONES IS NOT NULL ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($oblg = mysqli_fetch_assoc($result)){
            $key=$oblg['ANHO'];
            $value=$oblg['PAGOS_OBLIGACIONES'];
            $elements[$key]=$value;
        }
        $ccaa->setPagosObligaciones($elements);

        $sql = "SELECT ANHO, R_EFICACIA_REC FROM cuentas_ccaa_general WHERE CODIGO = '$codigo' AND R_EFICACIA_REC IS NOT NULL ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($eficacia = mysqli_fetch_assoc($result)){
            $key=$eficacia['ANHO'];
            $value=$eficacia['R_EFICACIA_REC'];
            $elements[$key]=$value;
        }
        $ccaa->setREficaciaRec($elements);

        return $ccaa;
    }

    public function getCuentasGeneralMensualCCAA($codigo){
        $db = getConexionBD();
        
        $ccaa = new CCAA();
        $sql = "SELECT ANHO, MAX(MES) AS MAX_MES, PARO FROM cuentas_ccaa_general_mensual WHERE CODIGO = '$codigo' AND PARO IS NOT NULL GROUP BY CODIGO, ANHO ORDER BY ANHO DESC, MES DESC LIMIT 3";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $elements=array();
        $elements2=array();
        while($paro = mysqli_fetch_assoc($result)){
            //if(!$this->in_multi_array($paro['ANHO'], $elements)){
                array_push($elements2, $paro['ANHO']);
                array_push($elements2, $paro['MAX_MES']/3);
                array_push($elements2, $paro['PARO']);
                array_push($elements, $elements2);
                $elements2 = array();
            //}
        }
        $ccaa->setParo($elements);

        $sql = "SELECT ANHO, MAX(MES) AS MAX_MES, PMP FROM cuentas_ccaa_general_mensual WHERE CODIGO = '$codigo' AND PMP IS NOT NULL GROUP BY CODIGO, ANHO ORDER BY ANHO DESC, MES DESC LIMIT 3";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $elements=array();
        $elements2=array();
        while($pmp = mysqli_fetch_assoc($result)){
            //if(!$this->in_multi_array($pmp['ANHO'], $elements)){
                array_push($elements2, $pmp['ANHO']);
                array_push($elements2, $pmp['MAX_MES']);
                array_push($elements2, $pmp['PMP']);
                array_push($elements, $elements2);
                $elements2 = array();
            //}
        }
        $ccaa->setPMP($elements);

        $sql = "SELECT ANHO, MAX(MES) AS MAX_MES, R_DCPP FROM cuentas_ccaa_general_mensual WHERE CODIGO = '$codigo' AND R_DCPP IS NOT NULL GROUP BY CODIGO, ANHO ORDER BY ANHO DESC, MES DESC LIMIT 3";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $elements=array();
        $elements2=array();
        while($rdcpp = mysqli_fetch_assoc($result)){
            //if(!$this->in_multi_array($rdcpp['ANHO'], $elements)){
                array_push($elements2, $rdcpp['ANHO']);
                array_push($elements2, $rdcpp['MAX_MES']);
                array_push($elements2, $rdcpp['R_DCPP']);
                array_push($elements, $elements2);
                $elements2 = array();
            //}
        }
        $ccaa->setRDCPP($elements);

        $sql = "SELECT ANHO, MAX(MES) AS MAX_MES, DEUDAVIVA FROM cuentas_ccaa_general_mensual WHERE CODIGO = '$codigo' AND DEUDAVIVA IS NOT NULL GROUP BY CODIGO, ANHO ORDER BY ANHO DESC, MES DESC LIMIT 3";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $elements=array();
        $elements2=array();
        while($deudaviva = mysqli_fetch_assoc($result)){
            //if(!$this->in_multi_array($deudaviva['ANHO'], $elements)){
                array_push($elements2, $deudaviva['ANHO']);
                array_push($elements2, $deudaviva['MAX_MES']/3);
                array_push($elements2, $deudaviva['DEUDAVIVA']);
                array_push($elements, $elements2);
                $elements2 = array();
            //}
        }
        $ccaa->setDeudaViva($elements);

        $sql = "SELECT ANHO, MAX(MES) AS MAX_MES, DEUDA_VIVA_INGR_COR FROM cuentas_ccaa_general_mensual WHERE CODIGO = '$codigo' AND DEUDA_VIVA_INGR_COR IS NOT NULL GROUP BY CODIGO, ANHO ORDER BY ANHO DESC, MES DESC LIMIT 3";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $elements=array();
        $elements2=array();
        while($deudavivaingrcor = mysqli_fetch_assoc($result)){
            //if(!$this->in_multi_array($deudavivaingrcor['ANHO'], $elements)){
                array_push($elements2, $deudavivaingrcor['ANHO']);
                array_push($elements2, $deudavivaingrcor['MAX_MES']/3);
                array_push($elements2, $deudavivaingrcor['DEUDA_VIVA_INGR_COR']);
                array_push($elements, $elements2);
                $elements2 = array();
            //}
        }
        $ccaa->setDeudaVivaIngrCor($elements);

        $sql = "SELECT ANHO, MAX(MES) AS MAX_MES, TRANSAC_INMOBILIARIAS FROM cuentas_ccaa_general_mensual WHERE CODIGO = '$codigo' AND TRANSAC_INMOBILIARIAS IS NOT NULL GROUP BY CODIGO, ANHO ORDER BY ANHO DESC, MES DESC LIMIT 3";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $elements=array();
        $elements2=array();
        while($transac = mysqli_fetch_assoc($result)){
            //if(!$this->in_multi_array($transac['ANHO'], $elements)){
                array_push($elements2, $transac['ANHO']);
                array_push($elements2, $transac['MAX_MES']/3);
                array_push($elements2, $transac['TRANSAC_INMOBILIARIAS']);
                array_push($elements, $elements2);
                $elements2 = array();
            //}
        }
        $ccaa->setTransacInmobiliarias($elements);

        return $ccaa;
    }

    public function getIngresosCCAA($codigo){
        $db = getConexionBD();
        $ccaa = new CCAA();
        /* INGRESOS */
        $sql = "SELECT ANHO, DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND TIPO = 'PARTIDAINGR1' ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($par1 = mysqli_fetch_assoc($result)){
            $key=$par1['ANHO'];
            $value=$par1['DER_REC'];
            $elements[$key]=$value;
        }
        $ccaa->setImpuestosDirectos1($elements);
        
        //Impuestos Indirectos
        $sql = "SELECT ANHO, DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND TIPO = 'PARTIDAINGR2' ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($par2 = mysqli_fetch_assoc($result)){
            $key=$par2['ANHO'];
            $value=$par2['DER_REC'];
            $elements[$key]=$value;
        }
        $ccaa->setImpuestosIndirectos1($elements);
        
        //Tasas Precios Otros
        $sql = "SELECT ANHO, DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND TIPO = 'PARTIDAINGR3' ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($par3 = mysqli_fetch_assoc($result)){
            $key=$par3['ANHO'];
            $value=$par3['DER_REC'];
            $elements[$key]=$value;
        }
        $ccaa->setTasasPreciosOtros1($elements);
        
        //Transferencias Corrientes
        $sql = "SELECT ANHO, DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND TIPO = 'PARTIDAINGR4' ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($par4 = mysqli_fetch_assoc($result)){
            $key=$par4['ANHO'];
            $value=$par4['DER_REC'];
            $elements[$key]=$value;
        }
        $ccaa->setTransferenciasCorrientes1($elements);
        
        //Ingresos Patrimoniales
        $sql = "SELECT ANHO, DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND TIPO = 'PARTIDAINGR5' ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($par5 = mysqli_fetch_assoc($result)){
            $key=$par5['ANHO'];
            $value=$par5['DER_REC'];
            $elements[$key]=$value;
        }
        $ccaa->setIngresosPatrimoniales1($elements);
        
        //Total Ingresos Corrientes
        $sql = "SELECT ANHO, DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND TIPO = 'PARTIDAINGRESOS CORRIENTES' ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($parc = mysqli_fetch_assoc($result)){
            $key=$parc['ANHO'];
            $value=$parc['DER_REC'];
            $elements[$key]=$value;
        }
        $ccaa->setTotalIngresosCorrientes1($elements);
        
        //Enajenación de Inversiones Reales
        $sql = "SELECT ANHO, DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND TIPO = 'PARTIDAINGR6' ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($par6 = mysqli_fetch_assoc($result)){
            $key=$par6['ANHO'];
            $value=$par6['DER_REC'];
            $elements[$key]=$value;
        }
        $ccaa->setEnajenacionInversionesReales1($elements);
        
        //Transferencias de Capital
        $sql = "SELECT ANHO, DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND TIPO = 'PARTIDAINGR7' ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($par7 = mysqli_fetch_assoc($result)){
            $key=$par7['ANHO'];
            $value=$par7['DER_REC'];
            $elements[$key]=$value;
        }
        $ccaa->setTransferenciasCapital1($elements);

        //Ingresos No Financieros
        $sql = "SELECT ANHO, DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND TIPO = 'PARTIDA INGRESOS NO FINANCIEROS' ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($pari = mysqli_fetch_assoc($result)){
            $key=$pari['ANHO'];
            $value=$pari['DER_REC'];
            $elements[$key]=$value;
        }
        $ccaa->setTotalIngresosNoCorrientes1($elements);

        //Activos Financieros
        $sql = "SELECT ANHO, DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND TIPO = 'PARTIDAINGR8' ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($par8 = mysqli_fetch_assoc($result)){
            $key=$par8['ANHO'];
            $value=$par8['DER_REC'];
            $elements[$key]=$value;
        }
        $ccaa->setActivosFinancieros1($elements);

        //Pasivos Financieros
        $sql = "SELECT ANHO, DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND TIPO = 'PARTIDAINGR9' ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($par9 = mysqli_fetch_assoc($result)){
            $key=$par9['ANHO'];
            $value=$par9['DER_REC'];
            $elements[$key]=$value;
        }
        $ccaa->setPasivosFinancieros1($elements);

        //TOTAL INGRESOS

        $sql = "SELECT ANHO, DER_REC FROM cuentas_ccaa_ingresos WHERE CODIGO = '$codigo' AND TIPO = 'PARTIDA INGRESOS TOTALES' ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($part = mysqli_fetch_assoc($result)){
            $key=$part['ANHO'];
            $value=$part['DER_REC'];
            $elements[$key]=$value;
        }
        $ccaa->setTotalIngresos1($elements);

        return $ccaa;
    }

    public function getGastosCCAA($codigo) {
        $db = getConexionBD();
        $ccaa = new CCAA();

        /* GASTOS */
        $sql = "SELECT ANHO, OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND TIPO = 'PARTIDAGAST1' ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($part = mysqli_fetch_assoc($result)){
            $key=$part['ANHO'];
            $value=$part['OBLG_REC'];
            $elements[$key]=$value;
        }
        $ccaa->setGastosPersonal1($elements);
        
        //Gastos Corrientes de Bienes y Servicios
        $sql = "SELECT ANHO, OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND TIPO = 'PARTIDAGAST2' ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($part = mysqli_fetch_assoc($result)){
            $key=$part['ANHO'];
            $value=$part['OBLG_REC'];
            $elements[$key]=$value;
        }
        $ccaa->setGastosCorrientesBienesServicios1($elements);
        
        //Gastos Financieros
        $sql = "SELECT ANHO, OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND TIPO = 'PARTIDAGAST3' ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($part = mysqli_fetch_assoc($result)){
            $key=$part['ANHO'];
            $value=$part['OBLG_REC'];
            $elements[$key]=$value;
        }
        $ccaa->setGastosFinancieros1($elements);
        
        //Transferencias Corrientes
        $sql = "SELECT ANHO, OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND TIPO = 'PARTIDAGAST4' ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($part = mysqli_fetch_assoc($result)){
            $key=$part['ANHO'];
            $value=$part['OBLG_REC'];
            $elements[$key]=$value;
        }
        $ccaa->setTransferenciasCorrientesGastos1($elements);
        
        //Fondo Contingencia
        $sql = "SELECT ANHO, OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND TIPO = 'PARTIDAGAST5' ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($part = mysqli_fetch_assoc($result)){
            $key=$part['ANHO'];
            $value=$part['OBLG_REC'];
            $elements[$key]=$value;
        }
        $ccaa->setFondoContingencia1($elements);
        
        //Total Gastos Corrientes
        /*if(isset($gastos_personal1['OBLG_REC']) && isset($gastos_corrientes_bienes_servicios1['OBLG_REC']) && isset($gastos_financieros1['OBLG_REC']) && isset($transferencias_corrientes_gastos1['OBLG_REC']) && isset($fondo_contingencia1['OBLG_REC'])){
            $total_gastos_corrientes1 = floatval($gastos_personal1['OBLG_REC']) + floatval($gastos_corrientes_bienes_servicios1['OBLG_REC']) + floatval($gastos_financieros1['OBLG_REC']) + floatval($transferencias_corrientes_gastos1['OBLG_REC']) + floatval($fondo_contingencia1['OBLG_REC']);
            $ccaa->setTotalGastosCorrientes1($total_gastos_corrientes1);
        }*/
        $elements=array();
        foreach($ccaa->getGastosPersonal1() as $clave=>$valor){
            $total_gastos_corrientes = floatval($valor) + floatval(($ccaa->getGastosCorrientesBienesServicios1())[$clave]) + floatval(($ccaa->getGastosFinancieros1())[$clave]) + floatval(($ccaa->getTransferenciasCorrientesGastos1())[$clave]) + floatval(($ccaa->getFondoContingencia1())[$clave]);
            $elements[$clave] = $total_gastos_corrientes;
            $total_gastos_corrientes = 0;
        }
        $ccaa->setTotalGastosCorrientes1($elements);

        //Inversiones Reales
        $sql = "SELECT ANHO, OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND TIPO = 'PARTIDAGAST6' ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($part = mysqli_fetch_assoc($result)){
            $key=$part['ANHO'];
            $value=$part['OBLG_REC'];
            $elements[$key]=$value;
        }
        $ccaa->setInversionesReales1($elements);
        
        //Transferencias de Capital
        $sql = "SELECT ANHO, OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND TIPO = 'PARTIDAGAST7' ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($part = mysqli_fetch_assoc($result)){
            $key=$part['ANHO'];
            $value=$part['OBLG_REC'];
            $elements[$key]=$value;
        }
        $ccaa->setTransferenciasCapitalGastos1($elements);
        
        //Gastos No Financieros
        $sql = "SELECT ANHO, OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND TIPO = 'PARTIDAGASTOS NO FINANCIEROS' ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($part = mysqli_fetch_assoc($result)){
            $key=$part['ANHO'];
            $value=$part['OBLG_REC'];
            $elements[$key]=$value;
        }
        $ccaa->setTotalGastosNoFinancieros1($elements);
        
        //Activos Financieros
        $sql = "SELECT ANHO, OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND TIPO = 'PARTIDAGAST8' ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($part = mysqli_fetch_assoc($result)){
            $key=$part['ANHO'];
            $value=$part['OBLG_REC'];
            $elements[$key]=$value;
        }
        $ccaa->setActivosFinancierosGastos1($elements);
        
        //Pasivos Financieros
        $sql = "SELECT ANHO, OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND TIPO = 'PARTIDAGAST9' ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($part = mysqli_fetch_assoc($result)){
            $key=$part['ANHO'];
            $value=$part['OBLG_REC'];
            $elements[$key]=$value;
        }
        $ccaa->setPasivosFinancierosGastos1($elements);
        
        //TOTAL GASTOS

        $sql = "SELECT ANHO, OBLG_REC FROM cuentas_ccaa_gastos WHERE CODIGO = '$codigo' AND TIPO = 'PARTIDA GASTOS TOTALES' ORDER BY ANHO DESC LIMIT 3";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($part = mysqli_fetch_assoc($result)){
            $key=$part['ANHO'];
            $value=$part['OBLG_REC'];
            $elements[$key]=$value;
        }
        $ccaa->setTotalGastos1($elements);

        return $ccaa;
    }

    public function getDeudasCCAA($codigo){
        $db = getConexionBD();
        $ccaa = new CCAA();

        $sql = "SELECT ANHO, PIB FROM deudas_ccaa WHERE CODIGO = '$codigo' AND PIB IS NOT NULL ORDER BY ANHO ASC LIMIT 3";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($pib = mysqli_fetch_assoc($result)){
            $key=$pib['ANHO'];
            $value=$pib['PIB'];
            $elements[$key]=$value;
        }
        $ccaa->setPib($elements);
        
        $sql = "SELECT ANHO, PIBC FROM deudas_ccaa WHERE CODIGO = '$codigo' AND PIBC IS NOT NULL ORDER BY ANHO ASC LIMIT 1";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($pibc = mysqli_fetch_assoc($result)){
            $key=$pibc['ANHO'];
            $value=$pibc['PIBC'];
            $elements[$key]=$value;
        }
        $ccaa->setPibc($elements);
        
        $sql = "SELECT ANHO, RESULTADO FROM deudas_ccaa WHERE CODIGO = '$codigo' AND RESULTADO IS NOT NULL ORDER BY ANHO ASC LIMIT 3";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($resultado = mysqli_fetch_assoc($result)){
            $key=$resultado['ANHO'];
            $value=$resultado['RESULTADO'];
            $elements[$key]=$value;
        }
        $ccaa->setResultado($elements);

        return $ccaa;
    }

    public function consultarCCAAs($scoring, $poblacion, $endeudamiento, $ahorro_neto, $pmp, $choice, $anho, $from, $to, $dcpp, $ingrnofin, $gasto){
        $db = getConexionBD();
        $conditions = "";
        $returning_values = "";
        $group_by = "";
        $order_by = "";
        $joins="";

        if(!empty($scoring)){
            if($conditions!=""){
                $conditions = $conditions . "AND ";
            }
            $conditions = $conditions."scoring_ccaa.RATING = '$scoring' ";
            $returning_values = $returning_values.",scoring_ccaa.RATING";
            //$order_by = $order_by . "scoring_ccaa.ANHO DESC, ";
            //$group_by = $group_by."scoring_ccaa.ANHO, ";
        }   
        
        if(!empty($poblacion)){
            if($conditions!=""){
                $conditions = $conditions . "AND ";
            }
            if($poblacion=='tramo1'){
                $conditions = $conditions."(scoring_ccaa.POBLACION) BETWEEN 0 AND 750000 ";
            }
            else if($poblacion=='tramo2'){
                $conditions = $conditions."(scoring_ccaa.POBLACION) BETWEEN 750000 AND 1500000 ";
            }
            else if($poblacion=='tramo3'){
                $conditions = $conditions."(scoring_ccaa.POBLACION) BETWEEN 1500000 AND 3000000 ";
            }
            else if($poblacion=='tramo4'){
                $conditions = $conditions."(scoring_ccaa.POBLACION) BETWEEN 3000000 AND 6000000 ";
            }
            else if($poblacion=='tramo5'){
                $conditions = $conditions."(scoring_ccaa.POBLACION) > 6000000 ";
            }
            $returning_values = $returning_values.",scoring_ccaa.POBLACION";
            //if(!strpos($order_by, 'scoring_ccaa.ANHO DESC, ')) $order_by = $order_by . "scoring_ccaa.ANHO DESC, ";
            //if(!strpos($group_by, 'scoring_ccaa.ANHO, ')) $order_by = $order_by . "scoring_ccaa.ANHO, ";
        }

        if(!empty($endeudamiento)){
            if($conditions!=""){
                $conditions = $conditions . "AND cuentas_ccaa_general_mensual.ANHO = scoring_ccaa.ANHO AND ";
            }
            if($endeudamiento=='tramo1'){
                $conditions = $conditions."(cuentas_ccaa_general_mensual.DEUDA_VIVA_INGR_COR*100) BETWEEN 0 AND 20 ";
            }
            else if($endeudamiento=='tramo2'){
                $conditions = $conditions."(cuentas_ccaa_general_mensual.DEUDA_VIVA_INGR_COR*100) BETWEEN 20 AND 40 ";
            }
            else if($endeudamiento=='tramo3'){
                $conditions = $conditions."(cuentas_ccaa_general_mensual.DEUDA_VIVA_INGR_COR*100) BETWEEN 40 AND 80 ";
            }
            else if($endeudamiento=='tramo4'){
                $conditions = $conditions."(cuentas_ccaa_general_mensual.DEUDA_VIVA_INGR_COR*100) BETWEEN 80 AND 120 ";
            }
            else if($endeudamiento=='tramo5'){
                $conditions = $conditions."(cuentas_ccaa_general_mensual.DEUDA_VIVA_INGR_COR*100) > 120 ";
            }
            if(strpos($returning_values, ', MAX(cuentas_ccaa_general_mensual.MES) as MAX_MES ')===false) $returning_values = $returning_values . ", MAX(cuentas_ccaa_general_mensual.MES)";
            $returning_values = $returning_values.",cuentas_ccaa_general_mensual.DEUDA_VIVA_INGR_COR";
            if(strpos($joins, 'INNER JOIN cuentas_ccaa_general_mensual ON cuentas_ccaa_general_mensual.CODIGO=ccaas.CODIGO')===false) $joins = $joins . "INNER JOIN cuentas_ccaa_general_mensual ON cuentas_ccaa_general_mensual.CODIGO=ccaas.CODIGO ";
            
        }
        
        if(!empty($ahorro_neto)){
            if($conditions!=""){
                $conditions = $conditions . "AND cuentas_ccaa_general.ANHO = scoring_ccaa.ANHO AND ";
            }
            
            if($ahorro_neto=='tramo1'){
                $conditions = $conditions."(cuentas_ccaa_general.R_SOSTE_FINANCIERA*100) < -20 ";
            }
            else if($ahorro_neto=='tramo2'){
                $conditions = $conditions."(cuentas_ccaa_general.R_SOSTE_FINANCIERA*100) BETWEEN -20 AND 0 ";
            }
            else if($ahorro_neto=='tramo3'){
                $conditions = $conditions."(cuentas_ccaa_general.R_SOSTE_FINANCIERA*100) BETWEEN 0 AND 20 ";
            }
            else if($ahorro_neto=='tramo4'){
                $conditions = $conditions."(cuentas_ccaa_general.R_SOSTE_FINANCIERA*100) BETWEEN 20 AND 50 ";
            }
            else if($ahorro_neto=='tramo5'){
                $conditions = $conditions."(cuentas_ccaa_general.R_SOSTE_FINANCIERA*100) > 50 ";
            }
            $returning_values = $returning_values.",cuentas_ccaa_general.R_SOSTE_FINANCIERA";
            if(strpos($joins, 'INNER JOIN cuentas_ccaa_general ON cuentas_ccaa_general.CODIGO=ccaas.CODIGO')===false) $joins = $joins . "INNER JOIN cuentas_ccaa_general ON cuentas_ccaa_general.CODIGO=ccaas.CODIGO ";
            //if(!strpos($group_by, 'cuentas_ccaa_general.ANHO, ')) $group_by = $group_by . "cuentas_ccaa_general.ANHO, ";
        }
        
        if(!empty($pmp)){
            if($conditions!=""){
                $conditions = $conditions . "AND cuentas_ccaa_general_mensual.ANHO = scoring_ccaa.ANHO AND ";
            }
            if($pmp=='tramo1'){
                $conditions = $conditions."(cuentas_ccaa_general_mensual.PMP) BETWEEN 0 AND 10 ";
            }
            else if($pmp=='tramo2'){
                $conditions = $conditions."(cuentas_ccaa_general_mensual.PMP) BETWEEN 10 AND 20 ";
            }
            else if($pmp=='tramo3'){
                $conditions = $conditions."(cuentas_ccaa_general_mensual.PMP) BETWEEN 20 AND 30 ";
            }
            else if($pmp=='tramo4'){
                $conditions = $conditions."(cuentas_ccaa_general_mensual.PMP) BETWEEN 30 AND 40 ";
            }
            else if($pmp=='tramo5'){
                $conditions = $conditions."(cuentas_ccaa_general_mensual.PMP) BETWEEN 40 AND 50 ";
            }
            else if($pmp=='tramo6'){
                $conditions = $conditions."(cuentas_ccaa_general_mensual.PMP) > 50 ";
            }
            if(strpos($returning_values, ', MAX(cuentas_ccaa_general_mensual.MES) as MAX_MES ')===false) $returning_values = $returning_values . ", MAX(cuentas_ccaa_general_mensual.MES)";
            $returning_values = $returning_values.",cuentas_ccaa_general_mensual.PMP";
            if(strpos($joins, 'INNER JOIN cuentas_ccaa_general_mensual ON cuentas_ccaa_general_mensual.CODIGO=ccaas.CODIGO')===false) $joins = $joins . "INNER JOIN cuentas_ccaa_general_mensual ON cuentas_ccaa_general_mensual.CODIGO=ccaas.CODIGO ";
            //if(!strpos($order_by, 'cuentas_ccaa_general_mensual.ANHO DESC, ')) $order_by = $order_by . "cuentas_ccaa_general_mensual.ANHO DESC, ";
            //if(!strpos($group_by, 'cuentas_ccaa_general_mensual.ANHO, ')) $group_by = $group_by . "cuentas_ccaa_general_mensual.ANHO, ";
        }

        if(!empty($dcpp)){
            if($conditions!=""){
                $conditions = $conditions . "AND cuentas_ccaa_general_mensual.ANHO = scoring_ccaa.ANHO AND ";
            }
            if($dcpp=='tramo1'){
                $conditions = $conditions."(cuentas_ccaa_general_mensual.R_DCPP*100) BETWEEN 0 AND 4 ";
            }
            else if($dcpp=='tramo2'){
                $conditions = $conditions."(cuentas_ccaa_general_mensual.R_DCPP*100) BETWEEN 4 AND 8 ";
            }
            else if($dcpp=='tramo3'){
                $conditions = $conditions."(cuentas_ccaa_general_mensual.R_DCPP*100) BETWEEN 8 AND 12 ";
            }
            else if($dcpp=='tramo4'){
                $conditions = $conditions."(cuentas_ccaa_general_mensual.R_DCPP*100) BETWEEN 12 AND 16 ";
            }
            else if($dcpp=='tramo5'){
                $conditions = $conditions."(cuentas_ccaa_general_mensual.R_DCPP*100) BETWEEN 16 AND 20 ";
            }
            else if($dcpp=='tramo6'){
                $conditions = $conditions."(cuentas_ccaa_general_mensual.R_DCPP*100) > 20 ";
            }
            if(strpos($returning_values, ', MAX(cuentas_ccaa_general_mensual.MES) as MAX_MES ')===false) $returning_values = $returning_values . ", MAX(cuentas_ccaa_general_mensual.MES)";
            $returning_values = $returning_values.", cuentas_ccaa_general_mensual.R_DCPP";
            if(strpos($joins, 'INNER JOIN cuentas_ccaa_general_mensual ON cuentas_ccaa_general_mensual.CODIGO=ccaas.CODIGO')===false) $joins = $joins . "INNER JOIN cuentas_ccaa_general_mensual ON cuentas_ccaa_general_mensual.CODIGO=ccaas.CODIGO ";
            //if(!strpos($order_by, 'cuentas_ccaa_general_mensual.ANHO DESC, ')) $order_by = $order_by . "cuentas_ccaa_general_mensual.ANHO DESC, ";
            //if(!strpos($group_by, 'cuentas_ccaa_general_mensual.ANHO, ')) $group_by = $group_by . "cuentas_ccaa_general_mensual.ANHO, ";
        }

        if(!empty($ingrnofin)){
            if($conditions!=""){
                $conditions = $conditions . "AND cuentas_ccaa_ingresos.ANHO = scoring_ccaa.ANHO AND ";
            }
            $conditions = $conditions."cuentas_ccaa_ingresos.TIPO='PARTIDA INGRESOS NO FINANCIEROS' AND ";
            if($ingrnofin=='tramo1'){
                $conditions = $conditions."(cuentas_ccaa_ingresos.DER_REC) BETWEEN 0 AND 1000000 ";
            }
            else if($ingrnofin=='tramo2'){
                $conditions = $conditions."(cuentas_ccaa_ingresos.DER_REC) BETWEEN 1000000 AND 5000000 ";
            }
            else if($ingrnofin=='tramo3'){
                $conditions = $conditions."(cuentas_ccaa_ingresos.DER_REC) BETWEEN 5000000 AND 50000000 ";
            }
            else if($ingrnofin=='tramo4'){
                $conditions = $conditions."(cuentas_ccaa_ingresos.DER_REC) > 50000000 ";
            }
            $returning_values = $returning_values.",cuentas_ccaa_ingresos.DER_REC";
            if(strpos($joins, 'INNER JOIN cuentas_ccaa_ingresos ON cuentas_ccaa_ingresos.CODIGO=ccaas.CODIGO')===false) $joins = $joins . "INNER JOIN cuentas_ccaa_ingresos ON cuentas_ccaa_ingresos.CODIGO=ccaas.CODIGO ";
            //if(!strpos($order_by, 'cuentas_ccaa_ingresos.ANHO DESC, ')) $order_by = $order_by . "cuentas_ccaa_ingresos.ANHO DESC, ";
            //if(!strpos($group_by, 'cuentas_ccaa_ingresos.ANHO, ')) $group_by = $group_by . "cuentas_ccaa_ingresos.ANHO, ";
        }

        if(!empty($gasto)){
            if($conditions!=""){
                $conditions = $conditions . "AND cuentas_ccaa_gastos.ANHO = scoring_ccaa.ANHO AND ";
            }
            if($gasto=='personal'){
                $conditions = $conditions."(cuentas_ccaa_gastos.TIPO) ='PARTIDAGAST1' ";
            }
            else if($gasto=='bienesservicios'){
                $conditions = $conditions."(cuentas_ccaa_gastos.TIPO) ='PARTIDAGAST2' ";
            }
            else if($gasto=='financieros'){
                $conditions = $conditions."(cuentas_ccaa_gastos.TIPO) ='PARTIDAGAST3' ";
            }
            else if($gasto=='inversiones'){
                $conditions = $conditions."(cuentas_ccaa_gastos.TIPO) ='PARTIDAGAST6' ";
            }
            $returning_values = $returning_values.",cuentas_ccaa_gastos.TIPO, cuentas_ccaa_gastos.OBLG_REC";
            if(strpos($joins, 'INNER JOIN cuentas_ccaa_gastos ON cuentas_ccaa_gastos.CODIGO=ccaas.CODIGO')===false) $joins = $joins . "INNER JOIN cuentas_ccaa_gastos ON cuentas_ccaa_gastos.CODIGO=ccaas.CODIGO ";
            //if(!strpos($order_by, 'cuentas_ccaa_gastos.ANHO DESC, ')) $order_by = $order_by . "cuentas_ccaa_gastos.ANHO DESC, ";
            //if(!strpos($group_by, 'cuentas_ccaa_gastos.ANHO, ')) $group_by = $group_by . "cuentas_ccaa_gastos.ANHO, ";
        }

        if(!empty($choice)){
            if($choice =='SelectYear'){
                if(!empty($anho)){
                    if($conditions!=""){
                        $conditions = $conditions . "AND ";
                    }
                    $conditions = $conditions."scoring_ccaa.ANHO = '$anho' ";
                }
            }
            else {
                if(!empty($from) && !empty($to)){
                    if($conditions!=""){
                        $conditions = $conditions . "AND ";
                    }
                    $conditions = $conditions."scoring_ccaa.ANHO BETWEEN '$from' AND '$to' ";
                }
                else if(!empty($from) && empty($to)){
                    
                    if($conditions!=""){
                        $conditions = $conditions . "AND ";
                    }
                    $conditions = $conditions."scoring_ccaa.ANHO >= '$from' ";
                }
                else if(empty($from) && !empty($to)){
                    
                    if($conditions!=""){
                        $conditions = $conditions . "AND ";
                    }
                    $conditions = $conditions."scoring_ccaa.ANHO <= '$to' ";
                }
            }
        }

        if($conditions!=""){
            $conditions =" WHERE ".$conditions;
        }
        
        //$sql = "SELECT DISTINCT(NOMBRE), ANHO, RATING, POBLACION FROM ccaas INNER JOIN scoring_ccaa ON ccaas.CODIGO = scoring_ccaa.CODIGO $conditions ORDER BY ANHO ASC";
        //$sql = "SELECT DISTINCT(ccaas.CODIGO), ccaas.NOMBRE, scoring_ccaa.ANHO $returning_values FROM ccaas INNER JOIN scoring_ccaa ON ccaas.CODIGO = scoring_ccaa.CODIGO INNER JOIN cuentas_ccaa_general ON cuentas_ccaa_general.CODIGO = ccaas.CODIGO AND cuentas_ccaa_general.CODIGO = ccaas.CODIGO INNER JOIN cuentas_ccaa_general_mensual ON cuentas_ccaa_general_mensual.CODIGO = ccaas.CODIGO AND cuentas_ccaa_general_mensual.CODIGO = scoring_ccaa.CODIGO AND cuentas_ccaa_general_mensual.CODIGO = cuentas_ccaa_general.CODIGO $conditions ORDER BY cuentas_ccaa_general_mensual.MES, scoring_ccaa.ANHO DESC, cuentas_ccaa_general.ANHO DESC, ccaas.CODIGO ASC";
        $sql = "SELECT ccaas.CODIGO, ccaas.NOMBRE, scoring_ccaa.ANHO $returning_values FROM ccaas INNER JOIN scoring_ccaa ON ccaas.CODIGO = scoring_ccaa.CODIGO $joins $conditions GROUP BY ccaas.CODIGO, scoring_ccaa.ANHO ORDER BY scoring_ccaa.ANHO DESC, ccaas.CODIGO ASC";
        //echo $sql;
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $elements=array();
        while($resultado = mysqli_fetch_assoc($result)){
            $elements2 = array();
            $ccaa = new CCAA();
            $ccaa->setNombre($resultado['NOMBRE']);
            if(!empty($resultado['RATING'])) $ccaa->setScoring($resultado['RATING']);
            if(!empty($resultado['POBLACION']))$ccaa->setPoblacion($resultado['POBLACION']);
            if(!empty($resultado['DEUDA_VIVA_INGR_COR']))$ccaa->setDeudaVivaIngrCor($resultado['DEUDA_VIVA_INGR_COR']);
            if(!empty($resultado['R_SOSTE_FINANCIERA']))$ccaa->setRSosteFinanciera($resultado['R_SOSTE_FINANCIERA']);
            if(!empty($resultado['PMP']))$ccaa->setPMP($resultado['PMP']);
            if(!empty($resultado['R_DCPP']))$ccaa->setRDCPP($resultado['R_DCPP']);
            if(!empty($resultado['DER_REC']))$ccaa->setTotalIngresosNoCorrientes1($resultado['DER_REC']);
            if(!empty($resultado['OBLG_REC'])) {
                if($resultado['TIPO']=='PARTIDAGAST1') $ccaa->setGastosPersonal1($resultado['OBLG_REC']);
                else if($resultado['TIPO']=='PARTIDAGAST2') $ccaa->setGastosCorrientesBienesServicios1($resultado['OBLG_REC']);
                else if($resultado['TIPO']=='PARTIDAGAST3') $ccaa->setTransferenciasCorrientesGastos1($resultado['OBLG_REC']);
                else if($resultado['TIPO']=='PARTIDAGAST6') $ccaa->setInversionesReales1($resultado['OBLG_REC']);
            }
            $elements2[$resultado['ANHO']]=$ccaa;
            array_push($elements, $elements2);
        }
        //echo '<p>'.$sql.'</p>';
        //echo $conditions;
        //var_dump($elements);
        return $elements;
    }   

    public function getAllCCAAs(){
        $db = getConexionBD();
        $sql ="SELECT CODIGO, NOMBRE FROM ccaas ORDER BY CODIGO ASC";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $elements = array();
        while($resultado = mysqli_fetch_assoc($result)){
            $ccaa = new CCAA();
            $ccaa->setCodigo($resultado['CODIGO']);
            $ccaa->setNombre($resultado['NOMBRE']);
            array_push($elements, $ccaa);
        }

        return $elements;
    }

    private function in_multi_array($element, $multiarray) {
        foreach($multiarray as $array){
            if (in_array($element, $array)) {
               return true;
            }
         }
        return false;
    }

}

?>