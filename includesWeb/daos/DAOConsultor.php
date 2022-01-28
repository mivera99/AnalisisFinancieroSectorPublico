<?php
require_once('includesWeb/config.php');
class DAOConsultor{

    public function getAllFacilities(){ //Modificar el array que te devuelva, debe contener un array de pares clave valor <clave,valor>. Clave es MUNICPIO, DIPUTACION o MUNICIPIO. Valor es el nombre de la facility. 
        $facilities = array();
        $conn = getConexionBD();
        $ccaa_sql = "SELECT NOMBRE FROM ccaas";
        $result = mysqli_query($conn, $ccaa_sql);
        if(!$result){
            mysqli_error($conn);
            cierraConexion();
            return false;
        }
        while($nombre = mysqli_fetch_array($result)){
            array_push($facilities, ["CCAA" => $nombre['NOMBRE']]);
        }

        $dip_sql = "SELECT NOMBRE FROM diputaciones";
        $result = mysqli_query($conn, $dip_sql);
        if(!$result){
            mysqli_error($conn);
            cierraConexion();
            return false;
        }
        while($nombre = mysqli_fetch_array($result)){
            array_push($facilities, ["DIPUTACION" => $nombre['NOMBRE']]);
        }
        $mun_sql = "SELECT NOMBRE FROM municipios";
        $result = mysqli_query($conn, $mun_sql);
        if(!$result){
            mysqli_error($conn);
            cierraConexion();
            return false;
        }
        while($nombre = mysqli_fetch_array($result)){
            array_push($facilities, ["MUNICIPIO" => $nombre['NOMBRE']]);
        }

        cierraConexion();
        return $facilities;
    }
}
?>