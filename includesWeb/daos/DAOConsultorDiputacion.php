<?php

require_once('includesWeb/config.php');

class DAOConsultorDiputacion {

    public function getGeneralInfo($nombre){
        $db = getConexionBD();
        $sql = "SELECT * FROM diputaciones WHERE NOMBRE = '$nombre'";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $diputacion = new Diputacion();
        $diputacion_res = mysqli_fetch_array($result);

        $diputacion->setCodigo($diputacion_res['CODIGO']);
        $diputacion->setNombre($diputacion_res['NOMBRE']);
        $diputacion->setCif($diputacion_res['CIF']);

        $ccaaCode = $diputacion_res['AUTONOMIA'];
        $sql = "SELECT NOMBRE FROM ccaas WHERE CODIGO = '$ccaaCode'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $autonomia = mysqli_fetch_array($result);
        $diputacion->setAutonomia($autonomia['NOMBRE']);

        $provinciaCode = $diputacion_res['PROVINCIA'];
        $sql = "SELECT NOMBRE FROM provincias WHERE CODIGO = '$provinciaCode'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $provincia = mysqli_fetch_array($result);
        $diputacion->setProvincia($provincia['NOMBRE']);

        $diputacion->setTipoVia($diputacion_res['TIPOVIA']);
        $diputacion->setNumVia($diputacion_res['NUMVIA']);
        $diputacion->setNombreVia($diputacion_res['NOMBREVIA']);
        $diputacion->setTelefono($diputacion_res['TELEFONO']);
        $diputacion->setCodigoPostal($diputacion_res['CODPOSTAL']);
        $diputacion->setFax($diputacion_res['FAX']);
        $diputacion->setMail($diputacion_res['MAIL']);
        $diputacion->setWeb($diputacion_res['WEB']);

        return $diputacion;
    }

}

?>