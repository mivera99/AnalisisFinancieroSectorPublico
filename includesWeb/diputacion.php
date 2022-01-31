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