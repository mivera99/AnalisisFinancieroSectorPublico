<?php

class Diputacion{

    private $codigo;
    private $nombre;
    private $cif;
    private $tipo_via;
    private $nombre_via;
    private $num_via;
    private $cod_postal;
    private $provincia;
    private $autonomia;
    private $telefono;
    private $fax;
    private $web;
    private $mail;

    /* OTROS */
    private $scoring;
    private $tendencia;

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

    /* LIQUIDEZ */
    private $fondos_liquidos;
    private $remanente_tesoreria_gastos_generales;
    private $remanente_tesoreria_gastos_generales_media_diputaciones;
    private $liquidez_inmediata;
    private $solvencia_corto_plazo_media_diputaciones;
    private $solvencia_corto_plazo_media_diputaciones2;
    private $solvencia_corto_plazo;

    /* EFICIENCIA */
    private $eficiencia;
    private $eficiencia_media_diputaciones;

    /* GESTIÓN PRESUPUESTARIA */
    private $ejecucion_ingresos_corrientes;
    private $ejecucion_ingresos_corrientes_media_diputaciones;
    private $ejecucion_gastos_corrientes;
    private $ejecucion_gastos_corrientes_media_diputaciones;

    /* CUMPLIMIENTO DE PAGOS */
    private $deuda_comercial;
    private $periodo_medio_pagos;
    private $periodo_medio_pagos_media_diputaciones;
    private $pagos_sobre_obligaciones_reconocidas;
    private $pagos_sobre_obligaciones_reconocidas_media_diputaciones;

    /* GESTIÓN TRIBUTARIA */
    private $derechos_pendientes_cobro;
    private $eficacia_recaudatoria;
    private $eficacia_recaudatoria_media_diputaciones;

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
    
    public function getTendencia(){
        return $this->tendencia;
    }

    public function setTendencia($tendencia){
        $this->tendencia = $tendencia;
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


    /**
     * Get the value of fondos_liquidos
     */ 
    public function getFondosLiquidos()
    {
        return $this->fondos_liquidos;
    }

    /**
     * Set the value of fondos_liquidos
     *
     * @return  self
     */ 
    public function setFondosLiquidos($fondos_liquidos)
    {
        $this->fondos_liquidos = $fondos_liquidos;

        return $this;
    }

    /**
     * Get the value of remanente_tesoreria_gastos_generales
     */ 
    public function getRemanenteTesoreriaGastosGenerales()
    {
        return $this->remanente_tesoreria_gastos_generales;
    }

    /**
     * Set the value of remanente_tesoreria_gastos_generales
     *
     * @return  self
     */ 
    public function setRemanenteTesoreriaGastosGenerales($remanente_tesoreria_gastos_generales)
    {
        $this->remanente_tesoreria_gastos_generales = $remanente_tesoreria_gastos_generales;

        return $this;
    }

    /**
     * Get the value of remanente_tesoreria_gastos_generales_media_diputaciones
     */ 
    public function getRemanenteTesoreriaGastosGeneralesMediaDiputaciones()
    {
        return $this->remanente_tesoreria_gastos_generales_media_diputaciones;
    }

    /**
     * Set the value of remanente_tesoreria_gastos_generales_media_diputaciones
     *
     * @return  self
     */ 
    public function setRemanenteTesoreriaGastosGeneralesMediaDiputaciones($remanente_tesoreria_gastos_generales_media_diputaciones)
    {
        $this->remanente_tesoreria_gastos_generales_media_diputaciones = $remanente_tesoreria_gastos_generales_media_diputaciones;

        return $this;
    }

    /**
     * Get the value of liquidez_inmediata
     */ 
    public function getLiquidezInmediata()
    {
        return $this->liquidez_inmediata;
    }

    /**
     * Set the value of liquidez_inmediata
     *
     * @return  self
     */ 
    public function setLiquidezInmediata($liquidez_inmediata)
    {
        $this->liquidez_inmediata = $liquidez_inmediata;

        return $this;
    }

    /**
     * Get the value of solvencia_corto_plazo_media_diputaciones
     */ 
    public function getSolvenciaCortoPlazoMediaDiputaciones()
    {
        return $this->solvencia_corto_plazo_media_diputaciones;
    }

    /**
     * Set the value of solvencia_corto_plazo_media_diputaciones
     *
     * @return  self
     */ 
    public function setSolvenciaCortoPlazoMediaDiputaciones($solvencia_corto_plazo_media_diputaciones)
    {
        $this->solvencia_corto_plazo_media_diputaciones = $solvencia_corto_plazo_media_diputaciones;

        return $this;
    }

    /**
     * Get the value of solvencia_corto_plazo
     */ 
    public function getSolvenciaCortoPlazo()
    {
        return $this->solvencia_corto_plazo;
    }

    /**
     * Set the value of solvencia_corto_plazo
     *
     * @return  self
     */ 
    public function setSolvenciaCortoPlazo($solvencia_corto_plazo)
    {
        $this->solvencia_corto_plazo = $solvencia_corto_plazo;

        return $this;
    }

    /**
     * Get the value of eficacia_recaudatoria_media_diputaciones
     */ 
    public function getEficaciaRecaudatoriaMediaDiputaciones()
    {
        return $this->eficacia_recaudatoria_media_diputaciones;
    }

    /**
     * Set the value of eficacia_recaudatoria_media_diputaciones
     *
     * @return  self
     */ 
    public function setEficaciaRecaudatoriaMediaDiputaciones($eficacia_recaudatoria_media_diputaciones)
    {
        $this->eficacia_recaudatoria_media_diputaciones = $eficacia_recaudatoria_media_diputaciones;

        return $this;
    }

    /**
     * Get the value of eficacia_recaudatoria
     */ 
    public function getEficaciaRecaudatoria()
    {
        return $this->eficacia_recaudatoria;
    }

    /**
     * Set the value of eficacia_recaudatoria
     *
     * @return  self
     */ 
    public function setEficaciaRecaudatoria($eficacia_recaudatoria)
    {
        $this->eficacia_recaudatoria = $eficacia_recaudatoria;

        return $this;
    }

    /**
     * Get the value of derechos_pendientes_cobro
     */ 
    public function getDerechosPendientesCobro()
    {
        return $this->derechos_pendientes_cobro;
    }

    /**
     * Set the value of derechos_pendientes_cobro
     *
     * @return  self
     */ 
    public function setDerechosPendientesCobro($derechos_pendientes_cobro)
    {
        $this->derechos_pendientes_cobro = $derechos_pendientes_cobro;

        return $this;
    }

    /**
     * Get the value of pagos_sobre_obligaciones_reconocidas_media_diputaciones
     */ 
    public function getPagosSobreObligacionesReconocidasMediaDiputaciones()
    {
        return $this->pagos_sobre_obligaciones_reconocidas_media_diputaciones;
    }

    /**
     * Set the value of pagos_sobre_obligaciones_reconocidas_media_diputaciones
     *
     * @return  self
     */ 
    public function setPagosSobreObligacionesReconocidasMediaDiputaciones($pagos_sobre_obligaciones_reconocidas_media_diputaciones)
    {
        $this->pagos_sobre_obligaciones_reconocidas_media_diputaciones = $pagos_sobre_obligaciones_reconocidas_media_diputaciones;

        return $this;
    }

    /**
     * Get the value of pagos_sobre_obligaciones_reconocidas
     */ 
    public function getPagosSobreObligacionesReconocidas()
    {
        return $this->pagos_sobre_obligaciones_reconocidas;
    }

    /**
     * Set the value of pagos_sobre_obligaciones_reconocidas
     *
     * @return  self
     */ 
    public function setPagosSobreObligacionesReconocidas($pagos_sobre_obligaciones_reconocidas)
    {
        $this->pagos_sobre_obligaciones_reconocidas = $pagos_sobre_obligaciones_reconocidas;

        return $this;
    }

    /**
     * Get the value of periodo_medio_pagos_media_diputaciones
     */ 
    public function getPeriodoMedioPagosMediaDiputaciones()
    {
        return $this->periodo_medio_pagos_media_diputaciones;
    }

    /**
     * Set the value of periodo_medio_pagos_media_diputaciones
     *
     * @return  self
     */ 
    public function setPeriodoMedioPagosMediaDiputaciones($periodo_medio_pagos_media_diputaciones)
    {
        $this->periodo_medio_pagos_media_diputaciones = $periodo_medio_pagos_media_diputaciones;

        return $this;
    }

    /**
     * Get the value of periodo_medio_pagos
     */ 
    public function getPeriodoMedioPagos()
    {
        return $this->periodo_medio_pagos;
    }

    /**
     * Set the value of periodo_medio_pagos
     *
     * @return  self
     */ 
    public function setPeriodoMedioPagos($periodo_medio_pagos)
    {
        $this->periodo_medio_pagos = $periodo_medio_pagos;

        return $this;
    }

    /**
     * Get the value of deuda_comercial
     */ 
    public function getDeudaComercial()
    {
        return $this->deuda_comercial;
    }

    /**
     * Set the value of deuda_comercial
     *
     * @return  self
     */ 
    public function setDeudaComercial($deuda_comercial)
    {
        $this->deuda_comercial = $deuda_comercial;

        return $this;
    }

    /**
     * Get the value of ejecucion_gastos_corrientes_media_diputaciones
     */ 
    public function getEjecucionGastosCorrientesMediaDiputaciones()
    {
        return $this->ejecucion_gastos_corrientes_media_diputaciones;
    }

    /**
     * Set the value of ejecucion_gastos_corrientes_media_diputaciones
     *
     * @return  self
     */ 
    public function setEjecucionGastosCorrientesMediaDiputaciones($ejecucion_gastos_corrientes_media_diputaciones)
    {
        $this->ejecucion_gastos_corrientes_media_diputaciones = $ejecucion_gastos_corrientes_media_diputaciones;

        return $this;
    }

    /**
     * Get the value of ejecucion_gastos_corrientes
     */ 
    public function getEjecucionGastosCorrientes()
    {
        return $this->ejecucion_gastos_corrientes;
    }

    /**
     * Set the value of ejecucion_gastos_corrientes
     *
     * @return  self
     */ 
    public function setEjecucionGastosCorrientes($ejecucion_gastos_corrientes)
    {
        $this->ejecucion_gastos_corrientes = $ejecucion_gastos_corrientes;

        return $this;
    }

    /**
     * Get the value of ejecucion_ingresos_corrientes_media_diputaciones
     */ 
    public function getEjecucionIngresosCorrientesMediaDiputaciones()
    {
        return $this->ejecucion_ingresos_corrientes_media_diputaciones;
    }

    /**
     * Set the value of ejecucion_ingresos_corrientes_media_diputaciones
     *
     * @return  self
     */ 
    public function setEjecucionIngresosCorrientesMediaDiputaciones($ejecucion_ingresos_corrientes_media_diputaciones)
    {
        $this->ejecucion_ingresos_corrientes_media_diputaciones = $ejecucion_ingresos_corrientes_media_diputaciones;

        return $this;
    }

    /**
     * Get the value of ejecucion_ingresos_corrientes
     */ 
    public function getEjecucionIngresosCorrientes()
    {
        return $this->ejecucion_ingresos_corrientes;
    }

    /**
     * Set the value of ejecucion_ingresos_corrientes
     *
     * @return  self
     */ 
    public function setEjecucionIngresosCorrientes($ejecucion_ingresos_corrientes)
    {
        $this->ejecucion_ingresos_corrientes = $ejecucion_ingresos_corrientes;

        return $this;
    }

    /**
     * Get the value of eficiencia_media_diputaciones
     */ 
    public function getEficienciaMediaDiputaciones()
    {
        return $this->eficiencia_media_diputaciones;
    }

    /**
     * Set the value of eficiencia_media_diputaciones
     *
     * @return  self
     */ 
    public function setEficienciaMediaDiputaciones($eficiencia_media_diputaciones)
    {
        $this->eficiencia_media_diputaciones = $eficiencia_media_diputaciones;

        return $this;
    }

    /**
     * Get the value of eficiencia
     */ 
    public function getEficiencia()
    {
        return $this->eficiencia;
    }

    /**
     * Set the value of eficiencia
     *
     * @return  self
     */ 
    public function setEficiencia($eficiencia)
    {
        $this->eficiencia = $eficiencia;

        return $this;
    }

    /**
     * Get the value of solvencia_corto_plazo_media_diputaciones2
     */ 
    public function getSolvenciaCortoPlazoMediaDiputaciones2()
    {
        return $this->solvencia_corto_plazo_media_diputaciones2;
    }

    /**
     * Set the value of solvencia_corto_plazo_media_diputaciones2
     *
     * @return  self
     */ 
    public function setSolvenciaCortoPlazoMediaDiputaciones2($solvencia_corto_plazo_media_diputaciones2)
    {
        $this->solvencia_corto_plazo_media_diputaciones2 = $solvencia_corto_plazo_media_diputaciones2;

        return $this;
    }

}

?>