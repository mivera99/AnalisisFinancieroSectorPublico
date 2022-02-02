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
    private $impuestos_directos2;
    private $impuestos_directos3;
    private $impuestos_indirectos1;
    private $impuestos_indirectos2;
    private $impuestos_indirectos3;
    private $tasas_precios_otros1;
    private $tasas_precios_otros2;
    private $tasas_precios_otros3;
    private $transferencias_corrientes1;
    private $transferencias_corrientes2;
    private $transferencias_corrientes3;
    private $ingresos_patrimoniales1;
    private $ingresos_patrimoniales2;
    private $ingresos_patrimoniales3;
    private $total_ingresos_corrientes1;
    private $total_ingresos_corrientes2;
    private $total_ingresos_corrientes3;
    private $enajenacion_inversiones_reales1;
    private $enajenacion_inversiones_reales2;
    private $enajenacion_inversiones_reales3;
    private $transferencias_capital1;
    private $transferencias_capital2;
    private $transferencias_capital3;
    private $total_ingresos_no_corrientes1;
    private $total_ingresos_no_corrientes2;
    private $total_ingresos_no_corrientes3;
    private $activos_financieros1;
    private $activos_financieros2;
    private $activos_financieros3;
    private $pasivos_financieros1;
    private $pasivos_financieros2;
    private $pasivos_financieros3;
    private $total_ingresos1;
    private $total_ingresos2;
    private $total_ingresos3;

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
    
    public function setTipoVia($cod){
        $this->codigo = $cod;
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

    public function getImpuestosDirectos2(){
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
    }

    public function getImpuestosIndirectos1(){
        return $this->impuestos_indirectos1;
    }

    public function setImpuestosIndirectos1($impuestos_indirectos1){
        $this->impuestos_indirectos1 = $impuestos_indirectos1;
    }

    public function getImpuestosIndirectos2(){
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
    }

    public function getTasasPreciosOtros1(){
        return $this->tasas_precios_otros1;
    }

    public function setTasasPreciosOtros1($tasas_precios_otros1){
        $this->tasas_precios_otros1 = $tasas_precios_otros1;
    }

    public function getTasasPreciosOtros2(){
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
    }

    public function getTransferenciasCorrientes1(){
        return $this->transferencias_corrientes1;
    }

    public function setTransferenciasCorrientes1($transferencias_corrientes1){
        $this->transferencias_corrientes1 = $transferencias_corrientes1;
    }

    public function getTransferenciasCorrientes2(){
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
    }

    public function getIngresosPatrimoniales1(){
        return $this->ingresos_patrimoniales1;
    }

    public function setIngresosPatrimoniales1($ingresos_patrimoniales1){
        $this->ingresos_patrimoniales1 = $ingresos_patrimoniales1;
    }

    public function getIngresosPatrimoniales2(){
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

    public function getTotalIngresosCorrientes1(){
        return $this->total_ingresos_corrientes1;
    }

    public function setTotalIngresosCorrientes1($total_ingresos_corrientes1){
        $this->total_ingresos_corrientes1 = $total_ingresos_corrientes1;
    }

    public function getTotalIngresosCorrientes2(){
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

    public function getEnajenacionInversionesReales1(){
        return $this->enajenacion_inversiones_reales1;
    }

    public function setEnajenacionInversionesReales1($enajenacion_inversiones_reales1){
        $this->enajenacion_inversiones_reales1 = $enajenacion_inversiones_reales1;
    }

    public function getEnajenacionInversionesReales2(){
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

    public function getTransferenciasCapital1(){
        return $this->transferencias_capital1;
    }

    public function setTransferenciasCapital1($transferencias_capital1){
        $this->transferencias_capital1 = $transferencias_capital1;
    }

    public function getTransferenciasCapital2(){
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

    public function getTotalIngresosNoCorrientes1(){
        return $this->total_ingresos_no_corrientes1;
    }

    public function setTotalIngresosNoCorrientes1($total_ingresos_no_corrientes1){
        $this->total_ingresos_no_corrientes1 = $total_ingresos_no_corrientes1;
    }

    public function getTotalIngresosNoCorrientes2(){
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

    public function getActivosFinancieros1(){
        return $this->activos_financieros1;
    }

    public function setActivosFinancieros1($activos_financieros1){
        $this->activos_financieros1 = $activos_financieros1;
    }

    public function getActivosFinancieros2(){
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

    public function getPasivosFinancieros1(){
        return $this->pasivos_financieros1;
    }

    public function setPasivosFinancieros1($pasivos_financieros1){
        $this->pasivos_financieros1 = $pasivos_financieros1;
    }

    public function getPasivosFinancieros2(){
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

    public function getTotalIngresos1(){
        return $this->total_ingresos1;
    }

    public function setTotalIngresos1($total_ingresos1){
        $this->total_ingresos1 = $total_ingresos1;
    }

    public function getTotalIngresos2(){
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

}


?>