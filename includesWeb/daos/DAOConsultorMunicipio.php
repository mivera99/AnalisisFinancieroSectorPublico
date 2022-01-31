<?php

class DAOConsultorMunicipio{

    public function getGeneralInfo($nombre){
        $db = getConexionBD();
        $sql = "SELECT * FROM municipios WHERE NOMBRE = '$nombre'";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $municipio = new Municipio();
        $municipio_res = mysqli_fetch_array($result);

        $municipio->setCodigo($municipio_res['CODIGO']);
        $municipio->setNombre($municipio_res['NOMBRE']);
        
        $ccaaCode = $municipio_res['AUTONOMIA'];
        $sql = "SELECT NOMBRE FROM ccaas WHERE CODIGO = '$ccaaCode'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $autonomia = mysqli_fetch_array($result);
        $municipio->setAutonomia($autonomia['NOMBRE']);

        $provinciaCode = $municipio_res['PROVINCIA'];
        $sql = "SELECT NOMBRE FROM provincias WHERE CODIGO = '$provinciaCode'";
        $result = mysqli_query($db,$sql);
        if(!$result){
            return false;
        }
        $provincia = mysqli_fetch_array($result);
        $municipio->setProvincia($provincia['NOMBRE']);
        
        $municipio->setNombrePresidente($municipio_res['NOMBREALCALDE']);
        $municipio->setApellido1($municipio_res['APELLIDO1ALCALDE']);
        $municipio->setApellido2($municipio_res['APELLIDO2ALCALDE']);
        $municipio->setVigencia($municipio_res['VIGENCIA']);
        $municipio->setPartido($municipio_res['PARTIDO']);
        $municipio->setCif($municipio_res['CIF']);
        $municipio->setTipoVia($municipio_res['TIPO_VIA']);
        $municipio->setNumVia($municipio_res['NUM_VIA']);
        $municipio->setNombreVia($municipio_res['NOMBRE_VIA']);
        $municipio->setTelefono($municipio_res['TELEFONO']);
        $municipio->setCodigoPostal($municipio_res['COD_POSTAL']);
        $municipio->setFax($municipio_res['FAX']);
        $municipio->setMail($municipio_res['MAIL']);
        $municipio->setWeb($municipio_res['WEB']);

        return $municipio;
    }

}


?>