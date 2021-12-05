<?php
require_once('includesWeb/cargador.php');
require_once('includesWeb/config.php');
require_once('imports/import_bg_ccaa.php');
require_once('imports/import_bg_dip.php');
require_once('imports/import_bg_mun.php');
require_once('imports/import_cuentas_ccaa.php');
require_once('imports/import_cuentas_dip.php');
require_once('imports/import_cuentas_mun.php');
require_once('imports/import_scoring_ccaa.php');
require_once('imports/import_scoring_dip.php');
require_once('imports/import_scoring_mun.php');

class DAOCargador {
    private function checkFile($filename){
        if(strtolower(pathinfo(basename($file['name']),PATH_EXTENSION)) && $file['size']>500000000){
            return true;
        }
        return false;
    }

    public function carga($file){
        if(checkfile($file)){
            $cargador = Cargador::getInstance();
            $cargador.setPath($file);
            $tmp_name = ($cargador.getPath())['tmp_name'];
            $realname = ($cargador.getPath())['name'];
            $filenamestr = explode('_',(explode('.',$realname))[0]);
            if(strtolower($filenamestr[2])=='ccaa'){
                if(import_ccaas($tmp_name, $realname)){
                    return true;
                }
            }
            else if(strtolower($filenamestr[2])=='dip'){
                if(import_dips($tmp_name, $realname)){
                    return true;
                }
            }
            else if(strtolower($filenamestr[2])=='mun'){
                if(import_muns($tmp_name, $realname)){
                    return true;
                }
            }
        }
        return false;
    }

    private function import_ccaas($tmp_name,$realname){
        if((new Import_bg_ccaa()).import_bg_ccaa($tmp_name) && (new Import_cuentas_ccaa()).import_cuentas_ccaa($tmp_name)&&(new Import_scoring_ccaa()).import_scoring_ccaa($tmp_name, $realname)){
            return true;
        }
        return false;
    }

    private function import_dips(){
        if((new Import_bg_dip()).import_bg_dip($tmp_name) && (new Import_cuentas_dip()).import_cuentas_dip($tmp_name)&&(new Import_scoring_dip()).import_scoring_dip($tmp_name, $realname)){
            return true;
        }
        return false;
    }

    private function import_muns(){
        if((new Import_bg_mun()).import_bg_mun($tmp_name) && (new Import_cuentas_mun()).import_cuentas_mun($tmp_name)&&(new Import_scoring_mun()).import_scoring_mun($tmp_name, $realname)){
            return true;
        }
        return false;
    }

}

?>