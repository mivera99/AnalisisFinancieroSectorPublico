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
    /*private $impuestos_directos2;
    private $impuestos_directos3;*/
    private $impuestos_indirectos1;
    /*private $impuestos_indirectos2;
    private $impuestos_indirectos3;*/
    private $tasas_precios_otros1;
    /*private $tasas_precios_otros2;
    private $tasas_precios_otros3;*/
    private $transferencias_corrientes1;
    /*private $transferencias_corrientes2;
    private $transferencias_corrientes3;*/
    private $ingresos_patrimoniales1;
    /*private $ingresos_patrimoniales2;
    private $ingresos_patrimoniales3;*/
    private $total_ingresos_corrientes1;
    /*private $total_ingresos_corrientes2;
    private $total_ingresos_corrientes3;*/
    private $enajenacion_inversiones_reales1;
    /*private $enajenacion_inversiones_reales2;
    private $enajenacion_inversiones_reales3;*/
    private $transferencias_capital1;
    /*private $transferencias_capital2;
    private $transferencias_capital3;*/
    private $total_ingresos_no_corrientes1;
    /*private $total_ingresos_no_corrientes2;
    private $total_ingresos_no_corrientes3;*/
    private $activos_financieros1;
    /*private $activos_financieros2;
    private $activos_financieros3;*/
    private $pasivos_financieros1;
    /*private $pasivos_financieros2;
    private $pasivos_financieros3;*/
    private $total_ingresos1;
    /*private $total_ingresos2;
    private $total_ingresos3;*/

    //Datos economicos (gastos)
    /*private $cred_ini;
    private $mod_cred;
    private $cred_tot;
    private $oblg_rec;
    private $pagos_cor;
    private $pagos_cer;
    */
    private $gastos_personal1;
    /*private $gastos_personal2;
    private $gastos_personal3;*/
    private $gastos_corrientes_bienes_servicios1;
    /*private $gastos_corrientes_bienes_servicios2;
    private $gastos_corrientes_bienes_servicios3;*/
    private $gastos_financieros1;
    /*private $gastos_financieros2;
    private $gastos_financieros3;*/
    private $transferencias_corrientes_gastos1;
    /*private $transferencias_corrientes_gastos2;
    private $transferencias_corrientes_gastos3;*/
    private $fondo_contingencia1;
    /*private $fondo_contingencia2;
    private $fondo_contingencia3;*/
    private $total_gastos_corrientes1;
    /*private $total_gastos_corrientes2;
    private $total_gastos_corrientes3;*/
    private $inversiones_reales1;
    /*private $inversiones_reales2;
    private $inversiones_reales3;*/
    private $transferencias_capital_gastos1;
    /*private $transferencias_capital_gastos2;
    private $transferencias_capital_gastos3;*/
    private $total_gastos_no_financieros1;
    /*private $total_gastos_no_financieros2;
    private $total_gastos_no_financieros3;*/
    private $activos_financieros_gastos1;
    /*private $activos_financieros_gastos2;
    private $activos_financieros_gastos3;*/
    private $pasivos_financieros_gastos1;
    /*private $pasivos_financieros_gastos2;
    private $pasivos_financieros_gastos3;*/
    private $total_gastos1;
    /*private $total_gastos2;
    private $total_gastos3;*/

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

    /*public function getImpuestosDirectos2(){
        return $this->impuestos_directos2;
    }

    public function setImpuestosDirectos2($impuestos_directos2){
        $this->impuestos_directos2 = $impuestos_directos2;
    }

    public function getImpuestosDirectos3(){
        return $this->impuestos_directos3;
    }

    public function setImpuestosDirectos3($impuestos_directos3){
        $this->impuestos_directos3 = $impuestos_directos3;
    }*/

    public function getImpuestosIndirectos1(){
        return $this->impuestos_indirectos1;
    }

    public function setImpuestosIndirectos1($impuestos_indirectos1){
        $this->impuestos_indirectos1 = $impuestos_indirectos1;
    }

    /*public function getImpuestosIndirectos2(){
        return $this->impuestos_indirectos2;
    }

    public function setImpuestosIndirectos2($impuestos_indirectos2){
        $this->impuestos_indirectos2 = $impuestos_indirectos2;
    }

    public function getImpuestosIndirectos3(){
        return $this->impuestos_indirectos3;
    }

    public function setImpuestosIndirectos3($impuestos_indirectos3){
        $this->impuestos_indirectos3 = $impuestos_indirectos3;
    }*/

    public function getTasasPreciosOtros1(){
        return $this->tasas_precios_otros1;
    }

    public function setTasasPreciosOtros1($tasas_precios_otros1){
        $this->tasas_precios_otros1 = $tasas_precios_otros1;
    }

    /*public function getTasasPreciosOtros2(){
        return $this->tasas_precios_otros2;
    }

    public function setTasasPreciosOtros2($tasas_precios_otros2){
        $this->tasas_precios_otros2 = $tasas_precios_otros2;
    }

    public function getTasasPreciosOtros3(){
        return $this->tasas_precios_otros3;
    }

    public function setTasasPreciosOtros3($tasas_precios_otros3){
        $this->tasas_precios_otros3 = $tasas_precios_otros3;
    }*/

    public function getTransferenciasCorrientes1(){
        return $this->transferencias_corrientes1;
    }

    public function setTransferenciasCorrientes1($transferencias_corrientes1){
        $this->transferencias_corrientes1 = $transferencias_corrientes1;
    }

    /*public function getTransferenciasCorrientes2(){
        return $this->transferencias_corrientes2;
    }

    public function setTransferenciasCorrientes2($transferencias_corrientes2){
        $this->transferencias_corrientes2 = $transferencias_corrientes2;
    }

    public function getTransferenciasCorrientes3(){
        return $this->transferencias_corrientes3;
    }

    public function setTransferenciasCorrientes3($transferencias_corrientes3){
        $this->transferencias_corrientes3 = $transferencias_corrientes3;
    }*/

    public function getIngresosPatrimoniales1(){
        return $this->ingresos_patrimoniales1;
    }

    public function setIngresosPatrimoniales1($ingresos_patrimoniales1){
        $this->ingresos_patrimoniales1 = $ingresos_patrimoniales1;
    }

    /*public function getIngresosPatrimoniales2(){
        return $this->ingresos_patrimoniales2;
    }

    public function setIngresosPatrimoniales2($ingresos_patrimoniales2){
        $this->ingresos_patrimoniales2 = $ingresos_patrimoniales2;
    }

    public function getIngresosPatrimoniales3(){
        return $this->ingresos_patrimoniales3;
    }

    public function setIngresosPatrimoniales3($ingresos_patrimoniales3){
        $this->ingresos_patrimoniales3 = $ingresos_patrimoniales3;
    }
*/
    public function getTotalIngresosCorrientes1(){
        return $this->total_ingresos_corrientes1;
    }

    public function setTotalIngresosCorrientes1($total_ingresos_corrientes1){
        $this->total_ingresos_corrientes1 = $total_ingresos_corrientes1;
    }

    /*public function getTotalIngresosCorrientes2(){
        return $this->total_ingresos_corrientes2;
    }

    public function setTotalIngresosCorrientes2($total_ingresos_corrientes2){
        $this->total_ingresos_corrientes2 = $total_ingresos_corrientes2;
    }

    public function getTotalIngresosCorrientes3(){
        return $this->total_ingresos_corrientes3;
    }

    public function setTotalIngresosCorrientes3($total_ingresos_corrientes3){
        $this->total_ingresos_corrientes3 = $total_ingresos_corrientes3;
    }
*/
    public function getEnajenacionInversionesReales1(){
        return $this->enajenacion_inversiones_reales1;
    }

    public function setEnajenacionInversionesReales1($enajenacion_inversiones_reales1){
        $this->enajenacion_inversiones_reales1 = $enajenacion_inversiones_reales1;
    }

    /*public function getEnajenacionInversionesReales2(){
        return $this->enajenacion_inversiones_reales2;
    }

    public function setEnajenacionInversionesReales2($enajenacion_inversiones_reales2){
        $this->enajenacion_inversiones_reales2 = $enajenacion_inversiones_reales2;
    }

    public function getEnajenacionInversionesReales3(){
        return $this->enajenacion_inversiones_reales3;
    }

    public function setEnajenacionInversionesReales3($enajenacion_inversiones_reales3){
        $this->enajenacion_inversiones_reales3 = $enajenacion_inversiones_reales3;
    }
*/
    public function getTransferenciasCapital1(){
        return $this->transferencias_capital1;
    }

    public function setTransferenciasCapital1($transferencias_capital1){
        $this->transferencias_capital1 = $transferencias_capital1;
    }

    /*public function getTransferenciasCapital2(){
        return $this->transferencias_capital2;
    }

    public function setTransferenciasCapital2($transferencias_capital2){
        $this->transferencias_capital2 = $transferencias_capital2;
    }

    public function getTransferenciasCapital3(){
        return $this->transferencias_capital3;
    }

    public function setTransferenciasCapital3($transferencias_capital3){
        $this->transferencias_capital3 = $transferencias_capital3;
    }
*/
    public function getTotalIngresosNoCorrientes1(){
        return $this->total_ingresos_no_corrientes1;
    }

    public function setTotalIngresosNoCorrientes1($total_ingresos_no_corrientes1){
        $this->total_ingresos_no_corrientes1 = $total_ingresos_no_corrientes1;
    }

    /*public function getTotalIngresosNoCorrientes2(){
        return $this->total_ingresos_no_corrientes2;
    }

    public function setTotalIngresosNoCorrientes2($total_ingresos_no_corrientes2){
        $this->total_ingresos_no_corrientes2 = $total_ingresos_no_corrientes2;
    }

    public function getTotalIngresosNoCorrientes3(){
        return $this->total_ingresos_no_corrientes3;
    }

    public function setTotalIngresosNoCorrientes3($total_ingresos_no_corrientes3){
        $this->total_ingresos_no_corrientes3 = $total_ingresos_no_corrientes3;
    }
*/
    public function getActivosFinancieros1(){
        return $this->activos_financieros1;
    }

    public function setActivosFinancieros1($activos_financieros1){
        $this->activos_financieros1 = $activos_financieros1;
    }

    /*public function getActivosFinancieros2(){
        return $this->activos_financieros2;
    }

    public function setActivosFinancieros2($activos_financieros2){
        $this->activos_financieros2 = $activos_financieros2;
    }

    public function getActivosFinancieros3(){
        return $this->activos_financieros3;
    }

    public function setActivosFinancieros3($activos_financieros3){
        $this->activos_financieros3 = $activos_financieros3;
    }
*/
    public function getPasivosFinancieros1(){
        return $this->pasivos_financieros1;
    }

    public function setPasivosFinancieros1($pasivos_financieros1){
        $this->pasivos_financieros1 = $pasivos_financieros1;
    }

    /*public function getPasivosFinancieros2(){
        return $this->pasivos_financieros2;
    }

    public function setPasivosFinancieros2($pasivos_financieros2){
        $this->pasivos_financieros2 = $pasivos_financieros2;
    }

    public function getPasivosFinancieros3(){
        return $this->pasivos_financieros3;
    }

    public function setPasivosFinancieros3($pasivos_financieros3){
        $this->pasivos_financieros3 = $pasivos_financieros3;
    }
*/
    public function getTotalIngresos1(){
        return $this->total_ingresos1;
    }

    public function setTotalIngresos1($total_ingresos1){
        $this->total_ingresos1 = $total_ingresos1;
    }

    /*public function getTotalIngresos2(){
        return $this->total_ingresos2;
    }

    public function setTotalIngresos2($total_ingresos2){
        $this->total_ingresos2 = $total_ingresos2;
    }

    public function getTotalIngresos3(){
        return $this->total_ingresos3;
    }

    public function setTotalIngresos3($total_ingresos3){
        $this->total_ingresos3 = $total_ingresos3;
    }
*/
    /* GETTERS Y SETTERS DE LOS GASTOS*/
    /*public function getCredIni(){
        return $this->cred_ini;
    }

    public function setCredIni($credini){
        $this->cred_ini = $credini;
    }

    public function getModCred(){
        return $this->mod_cred;
    }

    public function setModCred($modcred){
        $this->mod_cred = $modcred;
    }

    public function getCredTot(){
        return $this->cred_tot;
    }

    public function setCredTot($credtot){
        $this->cred_tot = $credtot;
    }

    public function getOblgRec(){
        return $this->oblg_rec;
    }

    public function setOblgRec($oblgrec){
        $this->oblg_rec = $oblgrec;
    }

    public function getPagosCor(){
        return $this->pagos_cor;
    }

    public function setPagosCor($pagoscor){
        $this->pagos_cor = $pagoscor;
    }

    public function getPagosCer(){
        return $this->pagos_cer;
    }

    public function setPagosCer($pagoscer){
        $this->pagos_cer = $pagoscer;
    }*/
    public function getGastosPersonal1(){
        return $this->gastos_personal1;
    }

    public function setGastosPersonal1($gastos_personal){
        $this->gastos_personal1 = $gastos_personal;
    }

    /*public function getGastosPersonal2(){
        return $this->gastos_personal2;
    }

    public function setGastosPersonal2($gastos_personal){
        $this->gastos_personal2 = $gastos_personal;
    }

    public function getGastosPersonal3(){
        return $this->gastos_personal3;
    }

    public function setGastosPersonal3($gastos_personal){
        $this->gastos_personal3 = $gastos_personal;
    }*/

    public function getGastosCorrientesBienesServicios1(){
        return $this->gastos_corrientes_bienes_servicios1;
    }

    public function setGastosCorrientesBienesServicios1($gastos_corrientes_bienes_servicios1){
        $this->gastos_corrientes_bienes_servicios1 = $gastos_corrientes_bienes_servicios1;
    }

    /*public function getGastosCorrientesBienesServicios2(){
        return $this->gastos_corrientes_bienes_servicios2;
    }

    public function setGastosCorrientesBienesServicios2($gastos_corrientes_bienes_servicios2){
        $this->gastos_corrientes_bienes_servicios2 = $gastos_corrientes_bienes_servicios2;
    }

    public function getGastosCorrientesBienesServicios3(){
        return $this->gastos_corrientes_bienes_servicios3;
    }

    public function setGastosCorrientesBienesServicios3($gastos_corrientes_bienes_servicios3){
        $this->gastos_corrientes_bienes_servicios3 = $gastos_corrientes_bienes_servicios3;
    }*/

    public function getGastosFinancieros1(){
        return $this->gastos_financieros1;
    }

    public function setGastosFinancieros1($gastos_financieros1){
        $this->gastos_financieros1 = $gastos_financieros1;
    }

    /*public function getGastosFinancieros2(){
        return $this->gastos_financieros2;
    }

    public function setGastosFinancieros2($gastos_financieros2){
        $this->gastos_financieros2 = $gastos_financieros2;
    }

    public function getGastosFinancieros3(){
        return $this->gastos_financieros3;
    }

    public function setGastosFinancieros3($gastos_financieros3){
        $this->gastos_financieros3 = $gastos_financieros3;
    }*/

    public function getTransferenciasCorrientesGastos1(){
        return $this->transferencias_corrientes_gastos1;
    }

    public function setTransferenciasCorrientesGastos1($transferencias_corrientes_gastos1){
        $this->transferencias_corrientes_gastos1 = $transferencias_corrientes_gastos1;
    }

    /*public function getTransferenciasCorrientesGastos2(){
        return $this->transferencias_corrientes_gastos2;
    }

    public function setTransferenciasCorrientesGastos2($transferencias_corrientes_gastos2){
        $this->transferencias_corrientes_gastos2 = $transferencias_corrientes_gastos2;
    }

    public function getTransferenciasCorrientesGastos3(){
        return $this->transferencias_corrientes_gastos3;
    }

    public function setTransferenciasCorrientesGastos3($transferencias_corrientes_gastos3){
        $this->transferencias_corrientes_gastos3 = $transferencias_corrientes_gastos3;
    }*/

    public function getFondoContingencia1(){
        return $this->fondo_contingencia1;
    }

    public function setFondoContingencia1($fondo_contingencia1){
        $this->fondo_contingencia1 = $fondo_contingencia1;
    }

    /*public function getFondoContingencia2(){
        return $this->fondo_contingencia2;
    }

    public function setFondoContingencia2($fondo_contingencia2){
        $this->fondo_contingencia2 = $fondo_contingencia2;
    }

    public function getFondoContingencia3(){
        return $this->fondo_contingencia3;
    }

    public function setFondoContingencia3($fondo_contingencia3){
        $this->fondo_contingencia3 = $fondo_contingencia3;
    }*/

    public function getTotalGastosCorrientes1(){
        return $this->total_gastos_corrientes1;
    }

    public function setTotalGastosCorrientes1($total_gastos_corrientes1){
        $this->total_gastos_corrientes1 = $total_gastos_corrientes1;
    }

    /*public function getTotalGastosCorrientes2(){
        return $this->total_gastos_corrientes2;
    }

    public function setTotalGastosCorrientes2($total_gastos_corrientes2){
        $this->total_gastos_corrientes2 = $total_gastos_corrientes2;
    }

    public function getTotalGastosCorrientes3(){
        return $this->total_gastos_corrientes3;
    }

    public function setTotalGastosCorrientes3($total_gastos_corrientes3){
        $this->total_gastos_corrientes3 = $total_gastos_corrientes3;
    }*/

    public function getInversionesReales1(){
        return $this->inversiones_reales1;
    }

    public function setInversionesReales1($inversiones_reales1){
        $this->inversiones_reales1 = $inversiones_reales1;
    }

    /*public function getInversionesReales2(){
        return $this->inversiones_reales2;
    }

    public function setInversionesReales2($inversiones_reales2){
        $this->inversiones_reales2 = $inversiones_reales2;
    }

    public function getInversionesReales3(){
        return $this->inversiones_reales3;
    }

    public function setInversionesReales3($inversiones_reales3){
        $this->inversiones_reales3 = $inversiones_reales3;
    }*/

    public function getTransferenciasCapitalGastos1(){
        return $this->transferencias_capital_gastos1;
    }

    public function setTransferenciasCapitalGastos1($transferencias_capital_gastos1){
        $this->transferencias_capital_gastos1 = $transferencias_capital_gastos1;
    }

    /*public function getTransferenciasCapitalGastos2(){
        return $this->transferencias_capital_gastos2;
    }

    public function setTransferenciasCapitalGastos2($transferencias_capital_gastos2){
        $this->transferencias_capital_gastos2 = $transferencias_capital_gastos2;
    }

    public function getTransferenciasCapitalGastos3(){
        return $this->transferencias_capital_gastos3;
    }

    public function setTransferenciasCapitalGastos3($transferencias_capital_gastos3){
        $this->transferencias_capital_gastos3 = $transferencias_capital_gastos3;
    }*/

    public function getTotalGastosNoFinancieros1(){
        return $this->total_gastos_no_financieros1;
    }

    public function setTotalGastosNoFinancieros1($total_gastos_no_financieros1){
        $this->total_gastos_no_financieros1 = $total_gastos_no_financieros1;
    }

    /*public function getTotalGastosNoFinancieros2(){
        return $this->total_gastos_no_financieros2;
    }

    public function setTotalGastosNoFinancieros2($total_gastos_no_financieros2){
        $this->total_gastos_no_financieros2 = $total_gastos_no_financieros2;
    }

    public function getTotalGastosNoFinancieros3(){
        return $this->total_gastos_no_financieros3;
    }

    public function setTotalGastosNoFinancieros3($total_gastos_no_financieros3){
        $this->total_gastos_no_financieros3 = $total_gastos_no_financieros3;
    }*/

    public function getActivosFinancierosGastos1(){
        return $this->activos_financieros_gastos1;
    }

    public function setActivosFinancierosGastos1($activos_financieros_gastos1){
        $this->activos_financieros_gastos1 = $activos_financieros_gastos1;
    }

    /*public function getActivosFinancierosGastos2(){
        return $this->activos_financieros_gastos2;
    }

    public function setActivosFinancierosGastos2($activos_financieros_gastos2){
        $this->activos_financieros_gastos2 = $activos_financieros_gastos2;
    }

    public function getActivosFinancierosGastos3(){
        return $this->activos_financieros_gastos3;
    }

    public function setActivosFinancierosGastos3($activos_financieros_gastos3){
        $this->activos_financieros_gastos3 = $activos_financieros_gastos3;
    }*/

    public function getPasivosFinancierosGastos1(){
        return $this->pasivos_financieros_gastos1;
    }

    public function setPasivosFinancierosGastos1($pasivos_financieros_gastos1){
        $this->pasivos_financieros_gastos1 = $pasivos_financieros_gastos1;
    }

    /*public function getPasivosFinancierosGastos2(){
        return $this->pasivos_financieros_gastos2;
    }

    public function setPasivosFinancierosGastos2($pasivos_financieros_gastos2){
        $this->pasivos_financieros_gastos2 = $pasivos_financieros_gastos2;
    }

    public function getPasivosFinancierosGastos3(){
        return $this->pasivos_financieros_gastos3;
    }

    public function setPasivosFinancierosGastos3($pasivos_financieros_gastos3){
        $this->pasivos_financieros_gastos3 = $pasivos_financieros_gastos3;
    }*/

    public function getTotalGastos1(){
        return $this->total_gastos1;
    }

    public function setTotalGastos1($total_gastos1){
        $this->total_gastos1 = $total_gastos1;
    }

    /*public function getTotalGastos2(){
        return $this->total_gastos2;
    }

    public function setTotalGastos2($total_gastos2){
        $this->total_gastos2 = $total_gastos2;
    }

    public function getTotalGastos3(){
        return $this->total_gastos3;
    }

    public function setTotalGastos3($total_gastos3){
        $this->total_gastos3 = $total_gastos3;
    }*/
    // TABLA SCORING
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