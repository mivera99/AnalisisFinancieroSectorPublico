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
require_once('imports/import_prog_mun.php');
require_once('exports/export_ccaa.php');

class DAOCargador {
    
    private function checkFile($file){
        if(strtolower(pathinfo(basename($file['name']),PATHINFO_EXTENSION)) == "xlsx" && $file['size']<500000000){
            return true;
        }
        return false;
    }

    public function carga($file){
        if($this->checkFile($file)){
            $cargador = Cargador::getInstance();
            $cargador->setPath($file);
            $tmp_name = ($cargador->getPath())['tmp_name'];
            $realname = ($cargador->getPath())['name'];
            $filenamestr = explode('_',(explode('.',$realname))[0]);
            if(strtolower($filenamestr[2])=='ccaa'){
                if($this->import_ccaas($tmp_name, $realname)){
                    return true;
                }
            }
            else if(strtolower($filenamestr[2])=='dip'){
                if($this->import_dips($tmp_name, $realname)){
                    return true;
                }
            }
            else if(strtolower($filenamestr[2])=='mun'){
                if(strtolower($filenamestr[4])=='prog'){
                    if($this->import_prog($tmp_name, $realname)){
                        return true;
                    }
                }
                else if($this->import_muns($tmp_name, $realname)){
                    return true;
                }
            }

        }
        return false;
    }

    private function import_ccaas($tmp_name,$realname){
        if((new Importer_bg_ccaa())->import_bg_ccaa($tmp_name) && (new Importer_cuentas_ccaa())->import_cuentas_ccaa($tmp_name)&&(new Importer_scoring_ccaa())->import_scoring_ccaa($tmp_name, $realname)){
            return true;
        }
        return false;
    }

    private function import_dips($tmp_name,$realname){
        if((new Importer_bg_dip())->import_bg_dip($tmp_name) && (new Importer_cuentas_dip())->import_cuentas_dip($tmp_name)&&(new Importer_scoring_dip())->import_scoring_dip($tmp_name, $realname)){
            return true;
        }
        return false;
    }

    private function import_muns($tmp_name,$realname){
        if((new Importer_bg_mun())->import_bg_mun($tmp_name, $realname) && (new Importer_cuentas_mun())->import_cuentas_mun($tmp_name)&&(new Importer_scoring_mun())->import_scoring_mun($tmp_name, $realname)){
            return true;
        }
        return false;
    }

    private function import_prog($tmp_name,$realname){
        if((new Importer_prog_mun())->import_prog_mun($tmp_name, $realname)){
            return true;
        }
        return false;
    }

    public function export_ccaa($ccaaNombre){
        if((new Exporter_ccaa())->export_ccaa($ccaaNombre)){
            return true;
        }
        return false;
    }


}

?>