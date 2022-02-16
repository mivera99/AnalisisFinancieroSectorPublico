<?php
    class Usuario {
        private $nombreusuario = "";
        private $correo = "";
        private $contrasenia = "";
        private $rol = "";

        public function getnombreusuario(){
            return $this->nombreusuario;
        }
        public function setnombreusuario($x){
            return $this->nombreusuario=$x;
        }
        public function getcorreo(){
            return $this->correo;
        }
        public function setcorreo($x){
            return $this->correo=$x;
        }
        public function getcontrasenia(){
            return $this->contrasenia;
        }
        public function setcontrasenia($x){
            return $this->contrasenia=$x;
        }
        public function getrol(){
            return $this->rol;
        }
        public function setrol($x){
            return $this->rol=$x;
        }
    }
?>