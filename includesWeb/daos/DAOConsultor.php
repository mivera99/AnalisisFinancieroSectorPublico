<?php
require_once('includesWeb/config.php');
class DAOConsultor{

    public function getAllFacilities(){
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
            array_push($facilities, $nombre['NOMBRE']);
        }
        $dip_sql = "SELECT NOMBRE FROM diputaciones";
        $result = mysqli_query($conn, $dip_sql);
        if(!$result){
            mysqli_error($conn);
            cierraConexion();
            return false;
        }
        while($nombre = mysqli_fetch_array($result)){
            array_push($facilities, $nombre['NOMBRE']);
        }
        $mun_sql = "SELECT NOMBRE FROM municipios";
        $result = mysqli_query($conn, $mun_sql);
        if(!$result){
            mysqli_error($conn);
            cierraConexion();
            return false;
        }

        while($nombre = mysqli_fetch_array($result)){
            array_push($facilities, $nombre['NOMBRE']);
        }

        cierraConexion();
        return $facilities;
    }
}
?>