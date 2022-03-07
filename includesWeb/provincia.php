<?php

class Provincia{

    private $codigo=0;
    private $nombre="";

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

}

?>