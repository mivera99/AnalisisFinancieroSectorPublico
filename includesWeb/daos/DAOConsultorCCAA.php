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

        $ccaa->setCodigo($ccaa_res['CODIGO']);
        $ccaa->setNombre($ccaa_res['NOMBRE']);
        $ccaa->setNombrePresidente($ccaa_res['NOMBRE_PRESIDENTE']);
        $ccaa->setApellido1($ccaa_res['APELLIDO1_PRESIDENTE']);
        $ccaa->setApellido2($ccaa_res['APELLIDO2_PRESIDENTE']);
        $ccaa->setVigencia($ccaa_res['VIGENCIA']);
        $ccaa->setPartido($ccaa_res['PARTIDO']);
        $ccaa->setCif($ccaa_res['CIF']);
        $ccaa->setTipoVia($ccaa_res['TIPO_VIA']);
        $ccaa->setNumVia($ccaa_res['NUM_VIA']);
        $ccaa->setNombreVia($ccaa_res['NOMBRE_VIA']);
        $ccaa->setTelefono($ccaa_res['TELEFONO']);
        $ccaa->setCodigoPostal($ccaa_res['COD_POSTAL']);
        $ccaa->setFax($ccaa_res['FAX']);
        $ccaa->setMail($ccaa_res['MAIL']);
        $ccaa->setWeb($ccaa_res['WEB']);

        return $ccaa;
    }

}

?>