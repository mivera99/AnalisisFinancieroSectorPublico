<?php

class CCAA{

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
        $this->codigo = $cod;
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
}

?>