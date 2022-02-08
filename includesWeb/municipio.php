<?php

class Municipio{

    /* DATOS GENERALES */
    private $codigo;
    private $nombre;
    private $provincia;
    private $autonomia;
    private $nombre_alcalde;
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

    /* OTROS */
    private $scoring;

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

    /* GASTOS */
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


    /* ENDEUDAMIENTO */
    private $deuda_financiera;
    private $endeudamiento;
    private $endeudamiento_media;

    /* SOLVENCIA */
    private $sostenibilidad_financiera;
    private $sostenibilidad_financiera_media;
    private $apalancamiento_operativo;
    private $apalancamiento_operativo_media;
    private $sostenibilidad_deuda;
    private $sostenibilidad_deuda_media;


    public function getCodigo(){
        return $this->codigo;
    }

    public function setCodigo($cod){
        $this->codigo = $cod;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    
    public function getProvincia(){
        return $this->provincia;
    }

    public function setProvincia($provincia){
        $this->provincia = $provincia;
    }
    
    public function getAutonomia(){
        return $this->autonomia;
    }
    
    public function setAutonomia($autonomia){
        $this->autonomia = $autonomia;
    }

    public function getNombreAlcalde(){
        return $this->nombre_alcalde;
    }

    public function setNombreAlcalde($nombreA){
        $this->nombre_alcalde = $nombreA;
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
    
    public function setTipoVia($tipo_via){
        $this->tipo_via = $tipo_via;
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

    public function getScoring(){
        return $this->scoring;
    }

    public function setScoring($scoring){
        $this->scoring = $scoring;
    }

    /* INGRESOS */
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


    /* ENDEUDAMIENTO */
    
    public function getDeudaFinanciera(){
        return $this->deuda_financiera;
    }

    public function setDeudaFinanciera($deuda_financiera){
        $this->deuda_financiera = $deuda_financiera;
    }

    public function getEndeudamiento(){
        return $this->endeudamiento;
    }

    public function setEndeudamiento($endeudamiento){
        $this->endeudamiento = $endeudamiento;
    }

    public function getEndeudamientoMediaDiputaciones(){
        return $this->endeudamiento_media;
    }

    public function setEndeudamientoMediaDiputaciones($endeudamiento_media){
        $this->endeudamiento_media = $endeudamiento_media;
    }


    /* SOLVENCIA */
    public function getSostenibilidadFinanciera() {
        return $this->sostenibilidad_financiera;
    }

    public function setSostenibilidadFinanciera($sostenibilidad_financiera) {
        $this->sostenibilidad_financiera = $sostenibilidad_financiera;
    }

    public function getSostenibilidadFinancieraMediaDiputaciones() {
        return $this->sostenibilidad_financiera_media;
    }

    public function setSostenibilidadFinancieraMediaDiputaciones($sostenibilidad_financiera_media) {
        $this->sostenibilidad_financiera_media = $sostenibilidad_financiera_media;
    }

    public function getApalancamientoOperativo() {
        return $this->apalancamiento_operativo;
    }

    public function setApalancamientoOperativo($apalancamiento_operativo) {
        $this->apalancamiento_operativo = $apalancamiento_operativo;
    }

    public function getApalancamientoOperativoMediaDiputaciones() {
        return $this->apalancamiento_operativo_media;
    }

    public function setApalancamientoOperativoMediaDiputaciones($apalancamiento_operativo_media) {
        $this->apalancamiento_operativo_media = $apalancamiento_operativo_media;
    }

    public function getSostenibilidadDeuda() {
        return $this->sostenibilidad_deuda;
    }

    public function setSostenibilidadDeuda($sostenibilidad_deuda) {
        $this->sostenibilidad_deuda = $sostenibilidad_deuda;
    }

    public function getSostenibilidadDeudaMediaDiputaciones() {
        return $this->sostenibilidad_deuda_media;
    }

    public function setSostenibilidadDeudaMediaDiputaciones($sostenibilidad_deuda_media) {
        $this->sostenibilidad_deuda_media = $sostenibilidad_deuda_media;
    }

}


?>