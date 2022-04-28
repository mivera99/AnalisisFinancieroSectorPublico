<?php
require_once("configFileExport.php");
require_once("includes/vendor/autoload.php");
require_once("includesWeb/daos/DAOConsultor.php");

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Exporter_mun {

    public function export_mun($munNombre){        
        $daomun = new DAOConsultor();
        $municipio = $daomun->getMunicipio($nombre);


        $mun2018 = $daomun->getEconomiaMUN(new Municipio(), $municipio->getCodigo(), 2018);
        $mun2019 = $daomun->getEconomiaMUN(new Municipio(), $municipio->getCodigo(), 2019);
        $mun2020 = $daomun->getEconomiaMUN(new Municipio(), $municipio->getCodigo(), 2020);
        $file = new SpreadSheet();
        $active_sheet = $file->getActiveSheet();
        
        $index=1;
        $count=1;
        foreach($mun->getImpuestosDirectos1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,$clave);
            $index++;
        }

        $count++;
        $index=1;
        foreach($mun->getImpuestosDirectos1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        
        $count++;
        $index=1;
        foreach($mun->getImpuestosIndirectos1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=1;
        foreach($mun->getTasasPreciosOtros1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=1;
        foreach($mun->getTransferenciasCorrientes1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=1;
        foreach($mun->getIngresosPatrimoniales1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=1;
        foreach($mun->getTotalIngresosCorrientes1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=1;
        foreach($mun->getEnajenacionInversionesReales1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=1;
        foreach($mun->getTransferenciasCapital1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=1;
        foreach($mun->getTotalIngresosNoCorrientes1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=1;
        foreach($mun->getActivosFinancieros1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=1;
        foreach($mun->getPasivosFinancieros1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=1;
        foreach($mun->getTotalIngresos1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }

        $writer = new Xlsx($file);
        $filename = __DIR__.'/'.str_replace(' ', '_', str_replace(',','',str_replace('-','',strtolower($mun->getNombre())))).'_ingresos.xlsx';
        $writer->save($filename);
        return $filename;
    }

}

?>