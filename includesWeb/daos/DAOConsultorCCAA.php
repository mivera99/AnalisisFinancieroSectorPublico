<?php
require_once('includesWeb/config.php');
require_once('includesWeb/ccaa.php');

class DAOConsultorCCAA {

    public function getGeneralInfo($nombre){
        $db = getConexionBD();
        $sql = "SELECT * FROM ccaas WHERE NOMBRE = '$nombre'";
        $result = mysqli_query($db, $sql);
        if(!$result){
            return false;
        }
        $ccaa = new CCAA();
        $ccaa_res = mysqli_fetch_assoc($result);

        $ccaa->setCodigo($ccca_res['CODIGO']);
        $ccaa->setNombre($ccca_res['NOMBRE']);
        $ccaa->setNombrePresidente($ccca_res['NOMBRE_PRESIDENTE']);
        $ccaa->setApellido1($ccca_res['APELLIDO1_PRESIDENTE']);
        $ccaa->setApellido2($ccca_res['APELLIDO2_PRESIDENTE']);
        $ccaa->setVigencia($ccca_res['VIGENCIA']);
        $ccaa->setPartido($ccca_res['PARTIDO']);
        $ccaa->setCif($ccca_res['CIF']);
        $ccaa->setTipoVia($ccca_res['TIPO_VIA']);
        $ccaa->setNumVia($ccca_res['NUM_VIA']);
        $ccaa->setNombreVia($ccca_res['NOMBRE_VIA']);
        $ccaa->setTelefono($ccca_res['TELEFONO']);
        $ccaa->setCodigoPostal($ccca_res['COD_POSTAL']);
        $ccaa->setFax($ccca_res['FAX']);
        $ccaa->setMail($ccca_res['MAIL']);
        $ccaa->setWeb($ccca_res['WEB']);

        return $ccaa;
    }

}

?>