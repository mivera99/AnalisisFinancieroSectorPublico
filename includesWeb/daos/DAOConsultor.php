<?php
require_once('includesWeb/config.php');
require_once('includesWeb/ccaa.php');
require_once('includesWeb/municipio.php');
require_once('includesWeb/diputacion.php');
require_once('includesWeb/DAOConsultorCCAA.php');
require_once('includesWeb/DAOConsultorMunicipio.php');
require_once('includesWeb/DAOConsultorDiputacion.php');

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

    public function getCCAA($nombre){
        $ccaa = new CCAA();
        $daoccaa = new DAOConsultorCCAA();

        $tmpCCAA = $daoccaa->getGeneralInfo($nombre);
        if(!$tmpCCAA){
            return false;
        }
        $ccaa->setCodigo($tmpCCAA->getCodigo());
        $ccaa->setNombre($tmpCCAA->getNombre());
        $ccaa->setNombrePresidente($tmpCCAA->getNombrePresidente());
        $ccaa->setApellido1($tmpCCAA->getApellido1());
        $ccaa->setApellido2($tmpCCAA->getApellido2());
        $ccaa->setVigencia($tmpCCAA->getVigencia());
        $ccaa->setPartido($tmpCCAA->getPartido());
        $ccaa->setCif($tmpCCAA->getCif());
        $ccaa->setTipoVia($tmpCCAA->getTipoVia());
        $ccaa->setNumVia($tmpCCAA->getNombreVia());
        $ccaa->setNumVia($tmpCCAA->getNumVia());
        $ccaa->setTelefono($tmpCCAA->getTelefono());
        $ccaa->setCodigoPostal($tmpCCAA->getCodigoPostal());
        $ccaa->setFax($tmpCCAA->getFax());
        $ccaa->setMail($tmpCCAA->getMail());
        $ccaa->setWeb($tmpCCAA->getWeb());
        
        return $ccaa;
    }

    public function getMunicipio($nombre){

        $municipio = new Municipio();
        $daomunicipio = new DAOConsultorMunicipio();

        $tmpMunicipio = $daomunicipio->getGeneralInfo($nombre);
        if(!$tmpMunicipio){
            return false;
        }

        $municipio->setCodigo($tmpMunicipio->getCodigo());
        $municipio->setNombre($tmpMunicipio->getNombre());
        $municipio->setNombrePresidente($tmpMunicipio->getNombrePresidente());
        $municipio->setApellido1($tmpMunicipio->getApellido1());
        $municipio->setApellido2($tmpMunicipio->getApellido2());
        $municipio->setVigencia($tmpMunicipio->getVigencia());
        $municipio->setPartido($tmpMunicipio->getPartido());
        $municipio->setCif($tmpMunicipio->getCif());
        $municipio->setTipoVia($tmpMunicipio->getTipoVia());
        $municipio->setNumVia($tmpMunicipio->getNombreVia());
        $municipio->setNumVia($tmpMunicipio->getNumVia());
        $municipio->setTelefono($tmpMunicipio->getTelefono());
        $municipio->setCodigoPostal($tmpMunicipio->getCodigoPostal());
        $municipio->setFax($tmpMunicipio->getFax());
        $municipio->setMail($tmpMunicipio->getMail());
        $municipio->setWeb($tmpMunicipio->getWeb());

        return $municipio;
    }

    public function getDiputacion($nombre){

        $diputacion = new Diputacion();
        $daodiputacion = new DAOConsultorDiputacion();

        $tmpDiputacion = $daodiputacion->getGeneralInfo($nombre);
        if(!$tmpDiputaciohn){
            return false;
        }

        $diputacion->setCodigo($tmpDiputacion->getCodigo());
        $diputacion->setNombre($tmpDiputacion->getNombre());
        $diputacion->setNombrePresidente($tmpDiputacion->getNombrePresidente());
        $diputacion->setApellido1($tmpDiputacion->getApellido1());
        $diputacion->setApellido2($tmpDiputacion->getApellido2());
        $diputacion->setVigencia($tmpDiputacion->getVigencia());
        $diputacion->setPartido($tmpDiputacion->getPartido());
        $diputacion->setCif($tmpDiputacion->getCif());
        $diputacion->setTipoVia($tmpDiputacion->getTipoVia());
        $diputacion->setNumVia($tmpDiputacion->getNombreVia());
        $diputacion->setNumVia($tmpDiputacion->getNumVia());
        $diputacion->setTelefono($tmpDiputacion->getTelefono());
        $diputacion->setCodigoPostal($tmpDiputacion->getCodigoPostal());
        $diputacion->setFax($tmpDiputacion->getFax());
        $diputacion->setMail($tmpDiputacion->getMail());
        $diputacion->setWeb($tmpDiputacion->getWeb());

        return $diputacion;
    }

}
?>