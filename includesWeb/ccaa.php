<?php

class CCAA{

    //Datos generales
    private $codigo;
    private $nombre;
    private $nombre_presidente;
    private $apellido1;
    private $apellido2;
    private $vigencia;
    private $partido;
    private $cif;
    private $tipo_via;
    private $nombre_via;
    private $num_via;
    private $cod_postal;
    private $telefono;
    private $fax;
    private $web;
    private $mail;

    private $year;
    private $tipo;

    /* CUENTAS */
    private $incr_pib;
    private $empresas;
    private $ccaa_pib;
    private $r_soste_financiera;
    private $r_efic;
    private $r_rigidez;
    private $r_soste_endeuda;
    private $r_eje_ingr_corr;
    private $r_eje_gastos_corr;
    private $pagos_obligaciones;
    private $r_eficacia_rec;

    /* INGRESOS */
    private $impuestos_directos1;
    private $impuestos_indirectos1;
    private $tasas_precios_otros1;
    private $transferencias_corrientes1;
    private $ingresos_patrimoniales1;
    private $total_ingresos_corrientes1;
    private $enajenacion_inversiones_reales1;
    private $transferencias_capital1;
    private $total_ingresos_no_corrientes1;
    private $activos_financieros1;
    private $pasivos_financieros1;
    private $total_ingresos1;

    private $gastos_personal1;
    private $gastos_corrientes_bienes_servicios1;
    private $gastos_financieros1;
    private $transferencias_corrientes_gastos1;
    private $fondo_contingencia1;
    private $total_gastos_corrientes1;
    private $inversiones_reales1;
    private $transferencias_capital_gastos1;
    private $total_gastos_no_financieros1;
    private $activos_financieros_gastos1;
    private $pasivos_financieros_gastos1;
    private $total_gastos1;

    /*Cuentas mensuales */
    private $paro;
    private $pmp;
    private $r_dcpp;
    private $deuda_viva;
    private $deuda_viva_ingr_cor;
    private $transac_inmobiliarias;

    /*Deudas CCAAs*/
    private $pibc;
    private $pib;
    private $resultado;

    //Datos de scoring (tabla SCORING_CCAA)
    private $scoring;
    private $tendencia;
    private $poblacion;

    public function getCodigo(){
        return $this->codigo;
    }

    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    
    public function getNombrePresidente(){
        return $this->nombre_presidente;
    }

    public function setNombrePresidente($nombreP){
        $this->nombre_presidente = $nombreP;
    }

    public function getApellido1(){
        return $this->apellido1;
    }

    public function setApellido1($apellido1){
        $this->apellido1 = $apellido1;
    }

    public function getApellido2(){
        return $this->apellido2;
    }

    public function setApellido2($apellido2){
        $this->apellido2 = $apellido2;
    }
    
    public function getVigencia(){
        return $this->vigencia;
    }

    public function setVigencia($vigencia){
        $this->vigencia = $vigencia;
    }

    public function getPartido(){
        return $this->partido;
    }

    public function setPartido($partido){
        $this->partido = $partido;
    }
    
    public function getCif(){
        return $this->cif;
    }

    public function setCif($cif){
        $this->cif = $cif;
    }
    
    public function getTipoVia(){
        return $this->tipo_via;
    }
    
    public function setTipoVia($tipovia){
        $this->tipo_via = $tipovia;
    }
    
    public function getNombreVia(){
        return $this->nombre_via;
    }

    public function setNombreVia($nombrevia){
        $this->nombre_via = $nombrevia;
    }
    
    public function getNumVia(){
        return $this->num_via;
    }

    public function setNumVia($numvia){
        $this->num_via = $numvia;
    }
    
    public function getTelefono(){
        return $this->telefono;
    }

    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }
    
    public function getCodigoPostal(){
        return $this->cod_postal;
    }

    public function setCodigoPostal($codpostal){
        $this->cod_postal = $codpostal;
    }
    
    public function getFax(){
        return $this->fax;
    }

    public function setFax($fax){
        $this->fax = $fax;
    }
    
    public function getMail(){
        return $this->mail;
    }

    public function setMail($mail){
        $this->mail = $mail;
    }
    
    public function getWeb(){
        return $this->web;
    }

    public function setWeb($web){
        $this->web = $web;
    }

    /*GETTERS Y SETTERS DE LAS CUENTAS*/
    public function getIncrPib(){
        return $this->incr_pib;
    }

    public function setIncrPib($incr_pib){
        $this->incr_pib = $incr_pib;
    }

    public function getEmpresas(){
        return $this->empresas;
    }

    public function setEmpresas($empresas){
        $this->empresas = $empresas;
    }

    public function getCCAAPib(){
        return $this->ccaa_pib;
    }

    public function setCCAAPib($ccaa_pib){
        $this->ccaa_pib = $ccaa_pib;
    }

    public function getRSosteFinanciera(){
        return $this->r_soste_financiera;
    }

    public function setRSosteFinanciera($r_soste_financiera){
        $this->r_soste_financiera = $r_soste_financiera;
    }

    public function getREfic(){
        return $this->r_efic;
    }

    public function setREfic($r_efic){
        $this->r_efic = $r_efic;
    }

    public function getRRigidez(){
        return $this->r_rigidez;
    }

    public function setRRigidez($r_rigidez){
        $this->r_rigidez = $r_rigidez;
    }

    public function getRSosteEndeuda(){
        return $this->r_soste_endeuda;
    }

    public function setRSosteEndeuda($r_soste_endeuda){
        $this->r_soste_endeuda = $r_soste_endeuda;
    }

    public function getREjeIngrCorr(){
        return $this->r_eje_ingr_corr;
    }

    public function setREjeIngrCorr($r_eje_ingr_corr){
        $this->r_eje_ingr_corr = $r_eje_ingr_corr;
    }

    public function getREjeGastosCorr(){
        return $this->r_eje_gastos_corr;
    }

    public function setREjeGastosCorr($r_eje_gastos_corr){
        $this->r_eje_gastos_corr = $r_eje_gastos_corr;
    }

    public function getPagosObligaciones(){
        return $this->pagos_obligaciones;
    }

    public function setPagosObligaciones($pagos_obligaciones){
        $this->pagos_obligaciones = $pagos_obligaciones;
    }

    public function getREficaciaRec(){
        return $this->r_eficacia_rec;
    }

    public function setREficaciaRec($r_eficacia_rec){
        $this->r_eficacia_rec = $r_eficacia_rec;
    }

    /* GETTERS Y SETTERS DE LOS INGRESOS */
    public function getImpuestosDirectos1(){
        return $this->impuestos_directos1;
    }

    public function setImpuestosDirectos1($impuestos_directos1){
        $this->impuestos_directos1 = $impuestos_directos1;
    }

    public function getImpuestosIndirectos1(){
        return $this->impuestos_indirectos1;
    }

    public function setImpuestosIndirectos1($impuestos_indirectos1){
        $this->impuestos_indirectos1 = $impuestos_indirectos1;
    }


    public function getTasasPreciosOtros1(){
        return $this->tasas_precios_otros1;
    }

    public function setTasasPreciosOtros1($tasas_precios_otros1){
        $this->tasas_precios_otros1 = $tasas_precios_otros1;
    }

    public function getTransferenciasCorrientes1(){
        return $this->transferencias_corrientes1;
    }

    public function setTransferenciasCorrientes1($transferencias_corrientes1){
        $this->transferencias_corrientes1 = $transferencias_corrientes1;
    }

    public function getIngresosPatrimoniales1(){
        return $this->ingresos_patrimoniales1;
    }

    public function setIngresosPatrimoniales1($ingresos_patrimoniales1){
        $this->ingresos_patrimoniales1 = $ingresos_patrimoniales1;
    }

    public function getTotalIngresosCorrientes1(){
        return $this->total_ingresos_corrientes1;
    }

    public function setTotalIngresosCorrientes1($total_ingresos_corrientes1){
        $this->total_ingresos_corrientes1 = $total_ingresos_corrientes1;
    }

    public function getEnajenacionInversionesReales1(){
        return $this->enajenacion_inversiones_reales1;
    }

    public function setEnajenacionInversionesReales1($enajenacion_inversiones_reales1){
        $this->enajenacion_inversiones_reales1 = $enajenacion_inversiones_reales1;
    }

    public function getTransferenciasCapital1(){
        return $this->transferencias_capital1;
    }

    public function setTransferenciasCapital1($transferencias_capital1){
        $this->transferencias_capital1 = $transferencias_capital1;
    }

    public function getTotalIngresosNoCorrientes1(){
        return $this->total_ingresos_no_corrientes1;
    }

    public function setTotalIngresosNoCorrientes1($total_ingresos_no_corrientes1){
        $this->total_ingresos_no_corrientes1 = $total_ingresos_no_corrientes1;
    }

    public function getActivosFinancieros1(){
        return $this->activos_financieros1;
    }

    public function setActivosFinancieros1($activos_financieros1){
        $this->activos_financieros1 = $activos_financieros1;
    }

    public function getPasivosFinancieros1(){
        return $this->pasivos_financieros1;
    }

    public function setPasivosFinancieros1($pasivos_financieros1){
        $this->pasivos_financieros1 = $pasivos_financieros1;
    }

    public function getTotalIngresos1(){
        return $this->total_ingresos1;
    }

    public function setTotalIngresos1($total_ingresos1){
        $this->total_ingresos1 = $total_ingresos1;
    }

    /* GETTERS Y SETTERS DE LOS GASTOS*/
    public function getGastosPersonal1(){
        return $this->gastos_personal1;
    }

    public function setGastosPersonal1($gastos_personal){
        $this->gastos_personal1 = $gastos_personal;
    }

    public function getGastosCorrientesBienesServicios1(){
        return $this->gastos_corrientes_bienes_servicios1;
    }

    public function setGastosCorrientesBienesServicios1($gastos_corrientes_bienes_servicios1){
        $this->gastos_corrientes_bienes_servicios1 = $gastos_corrientes_bienes_servicios1;
    }

    public function getGastosFinancieros1(){
        return $this->gastos_financieros1;
    }

    public function setGastosFinancieros1($gastos_financieros1){
        $this->gastos_financieros1 = $gastos_financieros1;
    }

    public function getTransferenciasCorrientesGastos1(){
        return $this->transferencias_corrientes_gastos1;
    }

    public function setTransferenciasCorrientesGastos1($transferencias_corrientes_gastos1){
        $this->transferencias_corrientes_gastos1 = $transferencias_corrientes_gastos1;
    }

    public function getFondoContingencia1(){
        return $this->fondo_contingencia1;
    }

    public function setFondoContingencia1($fondo_contingencia1){
        $this->fondo_contingencia1 = $fondo_contingencia1;
    }

    public function getTotalGastosCorrientes1(){
        return $this->total_gastos_corrientes1;
    }

    public function setTotalGastosCorrientes1($total_gastos_corrientes1){
        $this->total_gastos_corrientes1 = $total_gastos_corrientes1;
    }

    public function getInversionesReales1(){
        return $this->inversiones_reales1;
    }

    public function setInversionesReales1($inversiones_reales1){
        $this->inversiones_reales1 = $inversiones_reales1;
    }

    public function getTransferenciasCapitalGastos1(){
        return $this->transferencias_capital_gastos1;
    }

    public function setTransferenciasCapitalGastos1($transferencias_capital_gastos1){
        $this->transferencias_capital_gastos1 = $transferencias_capital_gastos1;
    }

    public function getTotalGastosNoFinancieros1(){
        return $this->total_gastos_no_financieros1;
    }

    public function setTotalGastosNoFinancieros1($total_gastos_no_financieros1){
        $this->total_gastos_no_financieros1 = $total_gastos_no_financieros1;
    }

    public function getActivosFinancierosGastos1(){
        return $this->activos_financieros_gastos1;
    }

    public function setActivosFinancierosGastos1($activos_financieros_gastos1){
        $this->activos_financieros_gastos1 = $activos_financieros_gastos1;
    }

    public function getPasivosFinancierosGastos1(){
        return $this->pasivos_financieros_gastos1;
    }

    public function setPasivosFinancierosGastos1($pasivos_financieros_gastos1){
        $this->pasivos_financieros_gastos1 = $pasivos_financieros_gastos1;
    }

    public function getTotalGastos1(){
        return $this->total_gastos1;
    }

    public function setTotalGastos1($total_gastos1){
        $this->total_gastos1 = $total_gastos1;
    }

    /*Getters y setters de las cuentas mensuales*/

    public function getParo(){
        return $this->paro;
    }

    public function setParo($paro){
        $this->paro = $paro;
    }

    public function getPMP(){
        return $this->pmp;
    }

    public function setPMP($pmp){
        $this->pmp = $pmp;
    }

    public function getRDCPP(){
        return $this->r_dcpp;
    }

    public function setRDCPP($r_dcpp){
        $this->r_dcpp = $r_dcpp;
    }

    public function getDeudaViva(){
        return $this->deuda_viva;
    }

    public function setDeudaViva($deuda_viva){
        $this->deuda_viva = $deuda_viva;
    }

    public function getDeudaVivaIngrCor(){
        return $this->deuda_viva_ingr_cor;
    }

    public function setDeudaVivaIngrCor($deuda_viva_ingr_cor){
        $this->deuda_viva_ingr_cor = $deuda_viva_ingr_cor;
    }

    public function getTransacInmobiliarias(){
        return $this->transac_inmobiliarias;
    }

    public function setTransacInmobiliarias($transac_inmobiliarias){
        $this->transac_inmobiliarias = $transac_inmobiliarias;
    }

    /*Deudas CCAAs*/
    public function getPibc(){
        return $this->pibc;
    }

    public function setPibc($pibc){
        $this->pibc = $pibc;
    }

    public function getPib(){
        return $this->pib;
    }

    public function setPib($pib){
        $this->pib = $pib;
    }

    public function getResultado(){
        return $this->resultado;
    }

    public function setResultado($resultado){
        $this->resultado = $resultado;
    }

    /*Getters y setters del scoring*/
    public function getScoring(){
        return $this->scoring;
    }

    public function setScoring($scoring){
        $this->scoring = $scoring;
    }
    
    public function getTendencia(){
        return $this->tendencia;
    }

    public function setTendencia($tendencia){
        $this->tendencia = $tendencia;
    }

    public function getPoblacion(){
        return $this->poblacion;
    }

    public function setPoblacion($poblacion){
        $this->poblacion = $poblacion;
    }

}

?>