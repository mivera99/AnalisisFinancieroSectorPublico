<?php
require_once('includesWeb/config.php');

class DAOConsultorCCAA {

    public function getGeneralInfo($nombre){
        $db = getConexionBD();
        $sql = "SELECT * FROM ccaas WHERE nombre = '$nombre'";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }

        


    }

}

?>