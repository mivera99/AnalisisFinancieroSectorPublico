<?php

class Provincia{

    private $codigo=0;
    private $nombre="";
    private $ccaaCode=0;

    public function getCodigo(){
        return $this->codigo;
    }
    public function setCodigo($codigo){
        return $this->codigo=$codigo;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        return $this->nombre=$nombre;
    }
    public function getCCAACode(){
        return $this->ccaaCode;
    }
    public function setCCAACode($ccaaCode){
        return $this->ccaaCode=$ccaaCode;
    }
}

?>