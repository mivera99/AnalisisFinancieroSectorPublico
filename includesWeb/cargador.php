<?php

class Cargador {
    private $path;
    private static $instance = null;

    private function __construct(){
        $this->path = $path;
    }

    public function setPath($path){
        $this->path = $path;
    }

    public function getPath(){
        return $path;
    }

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new Cargador();
        }
        return self::$instance;

    }

}
?>