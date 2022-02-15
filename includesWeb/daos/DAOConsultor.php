<?php
require_once('includesWeb/config.php');
require_once('includesWeb/ccaa.php');
require_once('includesWeb/municipio.php');
require_once('includesWeb/diputacion.php');
require_once('includesWeb/daos/DAOConsultorCCAA.php');
require_once('includesWeb/daos/DAOConsultorMunicipio.php');
require_once('includesWeb/daos/DAOConsultorDiputacion.php');

class DAOConsultor{

    public function getAllFacilities(){ 
        $facilities = array();
        $conn = getConexionBD();
        $ccaa_sql = "SELECT NOMBRE FROM ccaas";
        $result = mysqli_query($conn, $ccaa_sql);
        if(!$result){
            mysqli_error($conn);
            cierraConexion();
            return false;
        }
        while($nombre = mysqli_fetch_array($result)){
            array_push($facilities, ["CCAA" => $nombre['NOMBRE']]);
        }

        $dip_sql = "SELECT NOMBRE FROM diputaciones";
        $result = mysqli_query($conn, $dip_sql);
        if(!$result){
            mysqli_error($conn);
            cierraConexion();
            return false;
        }
        while($nombre = mysqli_fetch_array($result)){
            array_push($facilities, ["DIPUTACION" => $nombre['NOMBRE']]);
        }
        $mun_sql = "SELECT NOMBRE FROM municipios";
        $result = mysqli_query($conn, $mun_sql);
        if(!$result){
            mysqli_error($conn);
            cierraConexion();
            return false;
        }
        while($nombre = mysqli_fetch_array($result)){
            array_push($facilities, ["MUNICIPIO" => $nombre['NOMBRE']]);
        }

        cierraConexion();
        return $facilities;
    }

    public function getCCAA($nombre){
        $ccaa = new CCAA();
        $daoccaa = new DAOConsultorCCAA();

        $tmpCCAA = $daoccaa->getGeneralInfo($nombre);
        if(!$tmpCCAA){
            return false;
        }
        
        $ccaa->setCodigo($tmpCCAA->getCodigo());
        $ccaa->setNombre($tmpCCAA->getNombre());
        $ccaa->setNombrePresidente($tmpCCAA->getNombrePresidente());
        $ccaa->setApellido1($tmpCCAA->getApellido1());
        $ccaa->setApellido2($tmpCCAA->getApellido2());
        $ccaa->setVigencia($tmpCCAA->getVigencia());
        $ccaa->setPartido($tmpCCAA->getPartido());
        $ccaa->setCif($tmpCCAA->getCif());
        $ccaa->setTipoVia($tmpCCAA->getTipoVia());
        $ccaa->setNumVia($tmpCCAA->getNumVia());
        $ccaa->setNombreVia($tmpCCAA->getNombreVia());
        $ccaa->setTelefono($tmpCCAA->getTelefono());
        $ccaa->setCodigoPostal($tmpCCAA->getCodigoPostal());
        $ccaa->setFax($tmpCCAA->getFax());
        $ccaa->setMail($tmpCCAA->getMail());
        $ccaa->setWeb($tmpCCAA->getWeb());

        return $ccaa;
    }

    public function getEconomiaCCAA($ccaa, $codigo, $year){
        if(get_class($ccaa)!='CCAA')
            return false;

        $daoccaa = new DAOConsultorCCAA();

        $tmpCCAA = $daoccaa->getIngresos($codigo, $year);
        if(!$tmpCCAA){
            return false;
        }
        //Impuestos Directos
        $ccaa->setImpuestosDirectos1($tmpCCAA->getImpuestosDirectos1());
        //Impuestos Indirectos
        $ccaa->setImpuestosIndirectos1($tmpCCAA->getImpuestosIndirectos1());
        //Tasas Precios Otros
        $ccaa->setTasasPreciosOtros1($tmpCCAA->getTasasPreciosOtros1());
        //Transferencias Corrientes
        $ccaa->setTransferenciasCorrientes1($tmpCCAA->getTransferenciasCorrientes1());
        //Ingresos Patrimoniales
        $ccaa->setIngresosPatrimoniales1($tmpCCAA->getIngresosPatrimoniales1());
        //Total Ingresos Corrientes
        $ccaa->setTotalIngresosCorrientes1($tmpCCAA->getTotalIngresosCorrientes1());
        //Enajenación de Inversiones Reales
        $ccaa->setEnajenacionInversionesReales1($tmpCCAA->getEnajenacionInversionesReales1());
        //Transferencias de Capital
        $ccaa->setTransferenciasCapital1($tmpCCAA->getTransferenciasCapital1());
        //Ingresos No Financieros
        $ccaa->setTotalIngresosNoCorrientes1($tmpCCAA->getTotalIngresosNoCorrientes1());
        //Activos Financieros
        $ccaa->setActivosFinancieros1($tmpCCAA->getActivosFinancieros1());
        //Pasivos Financieros
        $ccaa->setPasivosFinancieros1($tmpCCAA->getPasivosFinancieros1());
        //TOTAL INGRESOS
        $ccaa->setTotalIngresos1($tmpCCAA->getTotalIngresos1());

        $tmpCCAA = $daoccaa->getGastos($codigo, $year);
        if(!$tmpCCAA){
            return false;
        }
        //Gastos Personal
        $ccaa->setGastosPersonal1($tmpCCAA->getGastosPersonal1());
        //Gastos Corrientes de Bienes y Servicios 
        $ccaa->setGastosCorrientesBienesServicios1($tmpCCAA->getGastosCorrientesBienesServicios1());
        //Gastos Financieros
        $ccaa->setGastosFinancieros1($tmpCCAA->getGastosFinancieros1());
        //Transferencias Corrientes
        $ccaa->setTransferenciasCorrientesGastos1($tmpCCAA->getTransferenciasCorrientesGastos1());
        //Fondo de Contingencia
        $ccaa->setFondoContingencia1($tmpCCAA->getFondoContingencia1());
        //Total Gastos Corrientes
        $ccaa->setTotalGastosCorrientes1($tmpCCAA->getTotalGastosCorrientes1());
        //Inversiones Reales
        $ccaa->setInversionesReales1($tmpCCAA->getInversionesReales1());
        //Transferencias de Capital
        $ccaa->setTransferenciasCapitalGastos1($tmpCCAA->getTransferenciasCapitalGastos1());
        //Gastos No Financieros
        $ccaa->setTotalGastosNoFinancieros1($tmpCCAA->getTotalGastosNoFinancieros1());
        //Activos Financieros
        $ccaa->setActivosFinancierosGastos1($tmpCCAA->getActivosFinancierosGastos1());
        //Pasivos Financieros
        $ccaa->setPasivosFinancierosGastos1($tmpCCAA->getPasivosFinancierosGastos1());
        //TOTAL GASTOS
        $ccaa->setTotalGastos1($tmpCCAA->getTotalGastos1());

        $tmpCCAA = $daoccaa->getCuentasGeneral($codigo, $year);
        if(!$tmpCCAA){
            return false;
        }

        $ccaa->setIncrPib($tmpCCAA->getIncrPib());
        $ccaa->setEmpresas($tmpCCAA->getEmpresas());
        $ccaa->setCCAAPib($tmpCCAA->getCCAAPib());
        $ccaa->setRSosteFinanciera($tmpCCAA->getRSosteFinanciera());
        $ccaa->setREfic($tmpCCAA->getREfic());
        $ccaa->setRRigidez($tmpCCAA->getRRigidez());
        $ccaa->setRSosteEndeuda($tmpCCAA->getRSosteEndeuda());
        $ccaa->setREjeIngrCorr($tmpCCAA->getREjeIngrCorr());
        $ccaa->setREjeGastosCorr($tmpCCAA->getREjeGastosCorr());
        $ccaa->setPagosObligaciones($tmpCCAA->getPagosObligaciones());
        $ccaa->setREficaciaRec($tmpCCAA->getREficaciaRec());

        return $ccaa;
    }

    public function getCuentasMensualesInfo($ccaa, $codigo, $year, $month){
        if(get_class($ccaa)!='CCAA')
            return false;

        $daoccaa = new DAOConsultorCCAA();

        $tmpCCAA = $daoccaa->getCuentasGeneralMensual($codigo, $year, $month);
        if(!$tmpCCAA){
            return false;
        }
        
        $ccaa->setParo($tmpCCAA->getParo());
        $ccaa->setPMP($tmpCCAA->getPMP());
        $ccaa->setRDCPP($tmpCCAA->getRDCPP());
        $ccaa->setDeudaViva($tmpCCAA->getDeudaViva());
        $ccaa->setDeudaVivaIngrCor($tmpCCAA->getDeudaVivaIngrCor());
        $ccaa->setTransacInmobiliarias($tmpCCAA->getTransacInmobiliarias());

        return $ccaa;
    }

    public function getRatingInfo($ccaa, $codigo, $year){
        if(get_class($ccaa)!='CCAA')
            return false;

        $daoccaa = new DAOConsultorCCAA();

        $tmpCCAA = $daoccaa->getRatingInfo($codigo, $year);
        if(!$tmpCCAA){
            return false;
        }
        
        $ccaa->setScoring($tmpCCAA->getScoring());
        $ccaa->setTendencia($tmpCCAA->getTendencia());
        $ccaa->setPoblacion($tmpCCAA->getPoblacion());

        return $ccaa;
    }

    public function getDeudasCCAA($ccaa, $codigo, $year){
        if(get_class($ccaa)!='CCAA')
            return false;

        $daoccaa = new DAOConsultorCCAA();

        $tmpCCAA = $daoccaa->getDeudas($codigo, $year);
        if(!$tmpCCAA){
            return false;
        }
        
        $ccaa->setPib($tmpCCAA->getPib());
        $ccaa->setPibc($tmpCCAA->getPibc());
        $ccaa->setResultado($tmpCCAA->getResultado());

        return $ccaa;
    }

    public function getMunicipio($nombre){

        $municipio = new Municipio();
        $daomunicipio = new DAOConsultorMunicipio();

        $tmpMunicipio = $daomunicipio->getGeneralInfo($nombre);
        if(!$tmpMunicipio){
            return false;
        }

        $municipio->setCodigo($tmpMunicipio->getCodigo());
        $municipio->setNombre($tmpMunicipio->getNombre());
        $municipio->setNombreAlcalde($tmpMunicipio->getNombreAlcalde());
        $municipio->setApellido1($tmpMunicipio->getApellido1());
        $municipio->setApellido2($tmpMunicipio->getApellido2());
        $municipio->setAutonomia($tmpMunicipio->getAutonomia());
        $municipio->setProvincia($tmpMunicipio->getProvincia());
        $municipio->setVigencia($tmpMunicipio->getVigencia());
        $municipio->setPartido($tmpMunicipio->getPartido());
        $municipio->setCif($tmpMunicipio->getCif());
        $municipio->setTipoVia($tmpMunicipio->getTipoVia());
        $municipio->setNombreVia($tmpMunicipio->getNombreVia());
        $municipio->setNumVia($tmpMunicipio->getNumVia());
        $municipio->setTelefono($tmpMunicipio->getTelefono());
        $municipio->setCodigoPostal($tmpMunicipio->getCodigoPostal());
        $municipio->setFax($tmpMunicipio->getFax());
        $municipio->setMail($tmpMunicipio->getMail());
        $municipio->setWeb($tmpMunicipio->getWeb());
        $municipio->setScoring($tmpMunicipio->getScoring());

        return $municipio;
    }

    public function getEconomiaMUN($mun, $codigo, $year){
        if(get_class($mun)!='Municipio')
            return false;

        $daomun = new DAOConsultorMunicipio();

        /* INGRESOS */
        $tmpMunicipio = $daomun->getIngresos($codigo, $year);
        if(!$tmpMunicipio){
            return false;
        }
        //Impuestos Directos
        $mun->setImpuestosDirectos1($tmpMunicipio->getImpuestosDirectos1());
        //Impuestos Indirectos
        $mun->setImpuestosIndirectos1($tmpMunicipio->getImpuestosIndirectos1());
        //Tasas Precios Otros
        $mun->setTasasPreciosOtros1($tmpMunicipio->getTasasPreciosOtros1());
        //Transferencias Corrientes
        $mun->setTransferenciasCorrientes1($tmpMunicipio->getTransferenciasCorrientes1());
        //Ingresos Patrimoniales
        $mun->setIngresosPatrimoniales1($tmpMunicipio->getIngresosPatrimoniales1());
        //Total Ingresos Corrientes
        $mun->setTotalIngresosCorrientes1($tmpMunicipio->getTotalIngresosCorrientes1());
        //Enajenación de Inversiones Reales
        $mun->setEnajenacionInversionesReales1($tmpMunicipio->getEnajenacionInversionesReales1());
        //Transferencias de Capital
        $mun->setTransferenciasCapital1($tmpMunicipio->getTransferenciasCapital1());
        //Ingresos No Financieros
        $mun->setTotalIngresosNoCorrientes1($tmpMunicipio->getTotalIngresosNoCorrientes1());
        //Activos Financieros
        $mun->setActivosFinancieros1($tmpMunicipio->getActivosFinancieros1());
        //Pasivos Financieros
        $mun->setPasivosFinancieros1($tmpMunicipio->getPasivosFinancieros1());
        //TOTAL INGRESOS
        $mun->setTotalIngresos1($tmpMunicipio->getTotalIngresos1());




        /* GASTOS */
        $tmpMunicipio = $daomun->getGastos($codigo, $year);
        if(!$tmpMunicipio){
            return false;
        }
        //Gastos Personal
        $mun->setGastosPersonal1($tmpMunicipio->getGastosPersonal1());
        //Gastos Corrientes de Bienes y Servicios 
        $mun->setGastosCorrientesBienesServicios1($tmpMunicipio->getGastosCorrientesBienesServicios1());
        //Gastos Financieros
        $mun->setGastosFinancieros1($tmpMunicipio->getGastosFinancieros1());
        //Transferencias Corrientes
        $mun->setTransferenciasCorrientesGastos1($tmpMunicipio->getTransferenciasCorrientesGastos1());
        //Fondo de Contingencia
        $mun->setFondoContingencia1($tmpMunicipio->getFondoContingencia1());
        //Total Gastos Corrientes
        $mun->setTotalGastosCorrientes1($tmpMunicipio->getTotalGastosCorrientes1());
        //Inversiones Reales
        $mun->setInversionesReales1($tmpMunicipio->getInversionesReales1());
        //Transferencias de Capital
        $mun->setTransferenciasCapitalGastos1($tmpMunicipio->getTransferenciasCapitalGastos1());
        //Gastos No Financieros
        $mun->setTotalGastosNoFinancieros1($tmpMunicipio->getTotalGastosNoFinancieros1());
        //Activos Financieros
        $mun->setActivosFinancierosGastos1($tmpMunicipio->getActivosFinancierosGastos1());
        //Pasivos Financieros
        $mun->setPasivosFinancierosGastos1($tmpMunicipio->getPasivosFinancierosGastos1());
        //TOTAL GASTOS
        $mun->setTotalGastos1($tmpMunicipio->getTotalGastos1());


        /* ENDEUDAMIENTO */
        if($year >= 2019){
            $tmpMunicipio = $daomun->getEndeudamiento($codigo, $year);
            if(!$tmpMunicipio){
                return false;
            }
            //Deuda Financiera
            $mun->setDeudaFinanciera($tmpMunicipio->getDeudaFinanciera());
            //Endeudamiento
            $mun->setEndeudamiento($tmpMunicipio->getEndeudamiento());
            //Endeudamiento Media Diputaciones
            $mun->setEndeudamientoMediaDiputaciones($tmpMunicipio->getEndeudamientoMediaDiputaciones());
        }

        /* SOLVENCIA */
        if($year >= 2019){
            $tmpMunicipio = $daomun->getSostenibilidad($codigo, $year);
            if(!$tmpMunicipio){
                return false;
            }
            //Sostenibilidad Financiera
            $mun->setSostenibilidadFinanciera($tmpMunicipio->getSostenibilidadFinanciera());
            //Sostenibilidad Financiera Media Diputaciones
            $mun->setSostenibilidadFinancieraMediaDiputaciones($tmpMunicipio->getSostenibilidadFinancieraMediaDiputaciones());
            //Apalancamiento Operativo
            $mun->setApalancamientoOperativo($tmpMunicipio->getApalancamientoOperativo());
            //Apalancamiento Operativo Media Diputaciones
            $mun->setApalancamientoOperativoMediaDiputaciones($tmpMunicipio->getApalancamientoOperativoMediaDiputaciones());
            //Sostenibilidad de la Deuda
            $mun->setSostenibilidadDeuda($tmpMunicipio->getSostenibilidadDeuda());
            //Sostenibilidad de la Deuda Media Diputaciones
            $mun->setSostenibilidadDeudaMediaDiputaciones($tmpMunicipio->getSostenibilidadDeudaMediaDiputaciones());
        }

        /* LIQUIDEZ */
        if($year >= 2019){
            $tmpMunicipio = $daomun->getLiquidez($codigo, $year);
            if(!$tmpMunicipio){
                return false;
            }
            //Fondos Liquidos
            $mun->setFondosLiquidos($tmpMunicipio->getFondosLiquidos());
            //Remanente Tesoreria Gastos Generales
            $mun->setRemanenteTesoreriaGastosGenerales($tmpMunicipio->getRemanenteTesoreriaGastosGenerales());
            //Remanente Tesoreria Gastos Generales Media Diputaciones
            $mun->setRemanenteTesoreriaGastosGeneralesMediaDiputaciones($tmpMunicipio->getRemanenteTesoreriaGastosGeneralesMediaDiputaciones());
            //Liquidez Inmediata
            $mun->setLiquidezInmediata($tmpMunicipio->getLiquidezInmediata());
            //Solvencia Corto Plazo Media Diputaciones
            $mun->setSolvenciaCortoPlazoMediaDiputaciones($tmpMunicipio->getSolvenciaCortoPlazoMediaDiputaciones());
            //Solvencia Corto Plazo Media Diputaciones2
            $mun->setSolvenciaCortoPlazoMediaDiputaciones2($tmpMunicipio->getSolvenciaCortoPlazoMediaDiputaciones2());
            //Solvencia Corto Plazo
            $mun->setSolvenciaCortoPlazo($tmpMunicipio->getSolvenciaCortoPlazo());
        }

        /* EFICIENCIA */
        if($year >= 2019){
            $tmpMunicipio = $daomun->getEficiencia($codigo, $year);
            if(!$tmpMunicipio){
                return false;
            }
            //Eficiencia
            $mun->setEficiencia($tmpMunicipio->getEficiencia());
            //Eficiencia Media Diputaciones
            $mun->setEficienciaMediaDiputaciones($tmpMunicipio->getEficienciaMediaDiputaciones());
        }

        /* GESTION PRESUPUESTARIA */
        if($year >= 2019){
            $tmpMunicipio = $daomun->getGestionPresupuestaria($codigo, $year);
            if(!$tmpMunicipio){
                return false;
            }
            //EjecucionIngresosCorrientes
            $mun->setEjecucionIngresosCorrientes($tmpMunicipio->getEjecucionIngresosCorrientes());
            //EjecucionIngresosCorrientesMediaDiputaciones
            $mun->setEjecucionIngresosCorrientesMediaDiputaciones($tmpMunicipio->getEjecucionIngresosCorrientesMediaDiputaciones());
            //EjecucionGastosCorrientes
            $mun->setEjecucionGastosCorrientes($tmpMunicipio->getEjecucionGastosCorrientes());
            //EjecucionGastosCorrientesMediaDiputaciones
            $mun->setEjecucionGastosCorrientesMediaDiputaciones($tmpMunicipio->getEjecucionGastosCorrientesMediaDiputaciones());
        }

        /* CUMPLIMIENTO PAGOS */
        if($year >= 2019){
            $tmpMunicipio = $daomun->getCumplimientoPagos($codigo, $year);
            if(!$tmpMunicipio){
                return false;
            }
            //DeudaComercial
            $mun->setDeudaComercial($tmpMunicipio->getDeudaComercial());
            //PeriodoMedioPagos
            $mun->setPeriodoMedioPagos($tmpMunicipio->getPeriodoMedioPagos());
            //PeriodoMedioPagosMediaDiputaciones
            $mun->setPeriodoMedioPagosMediaDiputaciones($tmpMunicipio->getPeriodoMedioPagosMediaDiputaciones());
            //PagosSobreObligacionesReconocidas
            $mun->setPagosSobreObligacionesReconocidas($tmpMunicipio->getPagosSobreObligacionesReconocidas());
            //PagosSobreObligacionesReconocidasMediaDiputaciones
            $mun->setPagosSobreObligacionesReconocidasMediaDiputaciones($tmpMunicipio->getPagosSobreObligacionesReconocidasMediaDiputaciones());
        }

        /* GESTION TRIBUTARIA */
        if($year >= 2019){
            $tmpMunicipio = $daomun->getGestionTributaria($codigo, $year);
            if(!$tmpMunicipio){
                return false;
            }
            //DerechosPendientesCobro
            $mun->setDerechosPendientesCobro($tmpMunicipio->getDerechosPendientesCobro());
            //EficaciaRecaudatoria
            $mun->setEficaciaRecaudatoria($tmpMunicipio->getEficaciaRecaudatoria());
            //EficaciaRecaudatoriaMediaDiputaciones
            $mun->setEficaciaRecaudatoriaMediaDiputaciones($tmpMunicipio->getEficaciaRecaudatoriaMediaDiputaciones());
        }

        return $mun;

    }

    public function getDiputacion($nombre){

        $diputacion = new Diputacion();
        $daodiputacion = new DAOConsultorDiputacion();

        $tmpDiputacion = $daodiputacion->getGeneralInfo($nombre);
        if(!$tmpDiputacion){
            return false;
        }

        $diputacion->setCodigo($tmpDiputacion->getCodigo());
        $diputacion->setNombre($tmpDiputacion->getNombre());
        $diputacion->setScoring($tmpDiputacion->getScoring());
        $diputacion->setAutonomia($tmpDiputacion->getAutonomia());
        $diputacion->setProvincia($tmpDiputacion->getProvincia());
        $diputacion->setCif($tmpDiputacion->getCif());
        $diputacion->setTipoVia($tmpDiputacion->getTipoVia());
        $diputacion->setNumVia($tmpDiputacion->getNombreVia());
        $diputacion->setNumVia($tmpDiputacion->getNumVia());
        $diputacion->setTelefono($tmpDiputacion->getTelefono());
        $diputacion->setCodigoPostal($tmpDiputacion->getCodigoPostal());
        $diputacion->setFax($tmpDiputacion->getFax());
        $diputacion->setMail($tmpDiputacion->getMail());
        $diputacion->setWeb($tmpDiputacion->getWeb());

        return $diputacion;
    }


    public function getEconomiaDIP($dip, $codigo, $year){
        if(get_class($dip)!='Diputacion')
            return false;

        $daodip = new DAOConsultorDiputacion();

        /* INGRESOS */
        $tmpDiputacion = $daodip->getIngresos($codigo, $year);
        if(!$tmpDiputacion){
            return false;
        }
        //Impuestos Directos
        $dip->setImpuestosDirectos1($tmpDiputacion->getImpuestosDirectos1());
        //Impuestos Indirectos
        $dip->setImpuestosIndirectos1($tmpDiputacion->getImpuestosIndirectos1());
        //Tasas Precios Otros
        $dip->setTasasPreciosOtros1($tmpDiputacion->getTasasPreciosOtros1());
        //Transferencias Corrientes
        $dip->setTransferenciasCorrientes1($tmpDiputacion->getTransferenciasCorrientes1());
        //Ingresos Patrimoniales
        $dip->setIngresosPatrimoniales1($tmpDiputacion->getIngresosPatrimoniales1());
        //Total Ingresos Corrientes
        $dip->setTotalIngresosCorrientes1($tmpDiputacion->getTotalIngresosCorrientes1());
        //Enajenación de Inversiones Reales
        $dip->setEnajenacionInversionesReales1($tmpDiputacion->getEnajenacionInversionesReales1());
        //Transferencias de Capital
        $dip->setTransferenciasCapital1($tmpDiputacion->getTransferenciasCapital1());
        //Ingresos No Financieros
        $dip->setTotalIngresosNoCorrientes1($tmpDiputacion->getTotalIngresosNoCorrientes1());
        //Activos Financieros
        $dip->setActivosFinancieros1($tmpDiputacion->getActivosFinancieros1());
        //Pasivos Financieros
        $dip->setPasivosFinancieros1($tmpDiputacion->getPasivosFinancieros1());
        //TOTAL INGRESOS
        $dip->setTotalIngresos1($tmpDiputacion->getTotalIngresos1());




        /* GASTOS */
        $tmpDiputacion = $daodip->getGastos($codigo, $year);
        if(!$tmpDiputacion){
            return false;
        }
        //Gastos Personal
        $dip->setGastosPersonal1($tmpDiputacion->getGastosPersonal1());
        //Gastos Corrientes de Bienes y Servicios 
        $dip->setGastosCorrientesBienesServicios1($tmpDiputacion->getGastosCorrientesBienesServicios1());
        //Gastos Financieros
        $dip->setGastosFinancieros1($tmpDiputacion->getGastosFinancieros1());
        //Transferencias Corrientes
        $dip->setTransferenciasCorrientesGastos1($tmpDiputacion->getTransferenciasCorrientesGastos1());
        //Fondo de Contingencia
        $dip->setFondoContingencia1($tmpDiputacion->getFondoContingencia1());
        //Total Gastos Corrientes
        $dip->setTotalGastosCorrientes1($tmpDiputacion->getTotalGastosCorrientes1());
        //Inversiones Reales
        $dip->setInversionesReales1($tmpDiputacion->getInversionesReales1());
        //Transferencias de Capital
        $dip->setTransferenciasCapitalGastos1($tmpDiputacion->getTransferenciasCapitalGastos1());
        //Gastos No Financieros
        $dip->setTotalGastosNoFinancieros1($tmpDiputacion->getTotalGastosNoFinancieros1());
        //Activos Financieros
        $dip->setActivosFinancierosGastos1($tmpDiputacion->getActivosFinancierosGastos1());
        //Pasivos Financieros
        $dip->setPasivosFinancierosGastos1($tmpDiputacion->getPasivosFinancierosGastos1());
        //TOTAL GASTOS
        $dip->setTotalGastos1($tmpDiputacion->getTotalGastos1());


        /* ENDEUDAMIENTO */
        if($year >= 2019){
            $tmpDiputacion = $daodip->getEndeudamiento($codigo, $year);
            if(!$tmpDiputacion){
                return false;
            }
            //Deuda Financiera
            $dip->setDeudaFinanciera($tmpDiputacion->getDeudaFinanciera());
            //Endeudamiento
            $dip->setEndeudamiento($tmpDiputacion->getEndeudamiento());
            //Endeudamiento Media Diputaciones
            $dip->setEndeudamientoMediaDiputaciones($tmpDiputacion->getEndeudamientoMediaDiputaciones());
        }

        /* SOLVENCIA */
        if($year >= 2019){
            $tmpDiputacion = $daodip->getSostenibilidad($codigo, $year);
            if(!$tmpDiputacion){
                return false;
            }
            //Sostenibilidad Financiera
            $dip->setSostenibilidadFinanciera($tmpDiputacion->getSostenibilidadFinanciera());
            //Sostenibilidad Financiera Media Diputaciones
            $dip->setSostenibilidadFinancieraMediaDiputaciones($tmpDiputacion->getSostenibilidadFinancieraMediaDiputaciones());
            //Apalancamiento Operativo
            $dip->setApalancamientoOperativo($tmpDiputacion->getApalancamientoOperativo());
            //Apalancamiento Operativo Media Diputaciones
            $dip->setApalancamientoOperativoMediaDiputaciones($tmpDiputacion->getApalancamientoOperativoMediaDiputaciones());
            //Sostenibilidad de la Deuda
            $dip->setSostenibilidadDeuda($tmpDiputacion->getSostenibilidadDeuda());
            //Sostenibilidad de la Deuda Media Diputaciones
            $dip->setSostenibilidadDeudaMediaDiputaciones($tmpDiputacion->getSostenibilidadDeudaMediaDiputaciones());
        }

        /* LIQUIDEZ */
        if($year >= 2019){
            $tmpDiputacion = $daodip->getLiquidez($codigo, $year);
            if(!$tmpDiputacion){
                return false;
            }
            //Fondos Liquidos
            $dip->setFondosLiquidos($tmpDiputacion->getFondosLiquidos());
            //Remanente Tesoreria Gastos Generales
            $dip->setRemanenteTesoreriaGastosGenerales($tmpDiputacion->getRemanenteTesoreriaGastosGenerales());
            //Remanente Tesoreria Gastos Generales Media Diputaciones
            $dip->setRemanenteTesoreriaGastosGeneralesMediaDiputaciones($tmpDiputacion->getRemanenteTesoreriaGastosGeneralesMediaDiputaciones());
            //Liquidez Inmediata
            $dip->setLiquidezInmediata($tmpDiputacion->getLiquidezInmediata());
            //Solvencia Corto Plazo Media Diputaciones
            $dip->setSolvenciaCortoPlazoMediaDiputaciones($tmpDiputacion->getSolvenciaCortoPlazoMediaDiputaciones());
            //Solvencia Corto Plazo Media Diputaciones2
            $dip->setSolvenciaCortoPlazoMediaDiputaciones2($tmpDiputacion->getSolvenciaCortoPlazoMediaDiputaciones2());
            //Solvencia Corto Plazo
            $dip->setSolvenciaCortoPlazo($tmpDiputacion->getSolvenciaCortoPlazo());
        }

        /* EFICIENCIA */
        if($year >= 2019){
            $tmpDiputacion = $daodip->getEficiencia($codigo, $year);
            if(!$tmpDiputacion){
                return false;
            }
            //Eficiencia
            $dip->setEficiencia($tmpDiputacion->getEficiencia());
            //Eficiencia Media Diputaciones
            $dip->setEficienciaMediaDiputaciones($tmpDiputacion->getEficienciaMediaDiputaciones());
        }

        /* GESTION PRESUPUESTARIA */
        if($year >= 2019){
            $tmpDiputacion = $daodip->getGestionPresupuestaria($codigo, $year);
            if(!$tmpDiputacion){
                return false;
            }
            //EjecucionIngresosCorrientes
            $dip->setEjecucionIngresosCorrientes($tmpDiputacion->getEjecucionIngresosCorrientes());
            //EjecucionIngresosCorrientesMediaDiputaciones
            $dip->setEjecucionIngresosCorrientesMediaDiputaciones($tmpDiputacion->getEjecucionIngresosCorrientesMediaDiputaciones());
            //EjecucionGastosCorrientes
            $dip->setEjecucionGastosCorrientes($tmpDiputacion->getEjecucionGastosCorrientes());
            //EjecucionGastosCorrientesMediaDiputaciones
            $dip->setEjecucionGastosCorrientesMediaDiputaciones($tmpDiputacion->getEjecucionGastosCorrientesMediaDiputaciones());
        }

        /* CUMPLIMIENTO PAGOS */
        if($year >= 2019){
            $tmpDiputacion = $daodip->getCumplimientoPagos($codigo, $year);
            if(!$tmpDiputacion){
                return false;
            }
            //DeudaComercial
            $dip->setDeudaComercial($tmpDiputacion->getDeudaComercial());
            //PeriodoMedioPagos
            $dip->setPeriodoMedioPagos($tmpDiputacion->getPeriodoMedioPagos());
            //PeriodoMedioPagosMediaDiputaciones
            $dip->setPeriodoMedioPagosMediaDiputaciones($tmpDiputacion->getPeriodoMedioPagosMediaDiputaciones());
            //PagosSobreObligacionesReconocidas
            $dip->setPagosSobreObligacionesReconocidas($tmpDiputacion->getPagosSobreObligacionesReconocidas());
            //PagosSobreObligacionesReconocidasMediaDiputaciones
            $dip->setPagosSobreObligacionesReconocidasMediaDiputaciones($tmpDiputacion->getPagosSobreObligacionesReconocidasMediaDiputaciones());
        }

        /* GESTION TRIBUTARIA */
        if($year >= 2019){
            $tmpDiputacion = $daodip->getGestionTributaria($codigo, $year);
            if(!$tmpDiputacion){
                return false;
            }
            //DerechosPendientesCobro
            $dip->setDerechosPendientesCobro($tmpDiputacion->getDerechosPendientesCobro());
            //EficaciaRecaudatoria
            $dip->setEficaciaRecaudatoria($tmpDiputacion->getEficaciaRecaudatoria());
            //EficaciaRecaudatoriaMediaDiputaciones
            $dip->setEficaciaRecaudatoriaMediaDiputaciones($tmpDiputacion->getEficaciaRecaudatoriaMediaDiputaciones());
        }

        return $dip;

    }

}
?>