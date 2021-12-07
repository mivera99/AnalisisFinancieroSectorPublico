<?php

class Cargador {
    
    private static $instance = null;
    private $path;

    public function setPath($path){
        $this->path = $path;
    }

    public function getPath(){
        return $this->path;
    }

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new Cargador();
        }
        return self::$instance;

    }

}
?>