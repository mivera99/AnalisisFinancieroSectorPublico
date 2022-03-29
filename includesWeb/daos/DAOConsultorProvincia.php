<?php
require_once('includesWeb/config.php');
require_once('includesWeb/provincia.php');

/*Clase encargada de actualizar la información del objeto Usuario en la BBDD*/
class DAOConsultorProvincia {

        public function getAllProvincias(){
            $db = getConexionBD();
            $sql ="SELECT CODIGO, NOMBRE FROM provincias";
            $result = mysqli_query($db, $sql);
            if(!$result){
                return false;
            }
            $elements = array();
            while($resultado = mysqli_fetch_assoc($result)){
                $provCode = $resultado['CODIGO'];
                $sql2 = "SELECT AUTONOMIA FROM municipios WHERE PROVINCIA = '$provCode' LIMIT 1 ";
                $result2 = mysqli_query($db, $sql2);
                if(!$result2){
                    return false;
                }
                $resultado2 = mysqli_fetch_assoc($result2);
                $provincia = new Provincia();
                $provincia->setCodigo($resultado['CODIGO']);
                $provincia->setNombre($resultado['NOMBRE']);
                $provincia->setCCAACode($resultado2['AUTONOMIA']);
                array_push($elements, $provincia);
            }

            return $elements;
        }

        public function getProvinciaById($id){
            $db = getConexionBD();
            $sql ="SELECT CODIGO, NOMBRE FROM provincias WHERE CODIGO = '$id'";
            $result = mysqli_query($db, $sql);
            if(!$result){
                return false;
            }
            $elements = array();
            $resultado = mysqli_fetch_assoc($result);
            $provincia = new Provincia();
            $provincia->setCodigo($resultado['CODIGO']);
            $provincia->setNombre($resultado['NOMBRE']);

            return $provincia;
        }
    
}
?>