<?php
require_once("configFileExport.php");
require_once("includes/vendor/autoload.php");
require_once("includesWeb/daos/DAOConsultor.php");

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Exporter_mun {

    public function export_ccaa($munNombre){        
        $daomun = new DAOConsultor();
        $mun = $daoccaa->getCCAA($munNombre);
        $file = new SpreadSheet();
        $active_sheet = $file->getActiveSheet();
        $count = 2;
        foreach($ccaa->getImpuestosDirectos1() as $clave=>$valor){
            $active_sheet->setCellValue('A'.$count,$clave);
            $count++;
        }
        $count=2;
        $active_sheet->setCellValue('B1','IMPUESTOS_DIRECTOS');
        foreach($ccaa->getImpuestosDirectos1() as $clave=>$valor){
            $active_sheet->setCellValue('B'.$count,number_format($valor, 2, ',','.'));
            $count++;
        }
        $count=2;
        $active_sheet->setCellValue('C1','IMPUESTOS_INDIRECTOS');
        foreach($ccaa->getImpuestosIndirectos1() as $clave=>$valor){
            $active_sheet->setCellValue('C'.$count,number_format($valor, 2, ',','.'));
            $count++;
        }
        $count=2;
        $active_sheet->setCellValue('D1','TASAS_PRECIOS_PUBLICOS_Y_OTROS_INGRESOS');
        foreach($ccaa->getTasasPreciosOtros1() as $clave=>$valor){
            $active_sheet->setCellValue('D'.$count,number_format($valor, 2, ',','.'));
            $count++;
        }
        $count=2;
        $active_sheet->setCellValue('E1','TRANSFERENCIAS_CORRIENTES');
        foreach($ccaa->getTransferenciasCorrientes1() as $clave=>$valor){
            $active_sheet->setCellValue('E'.$count,number_format($valor, 2, ',','.'));
            $count++;
        }
        $count=2;
        $active_sheet->setCellValue('F1','INGRESOS_PATRIMONIALES');
        foreach($ccaa->getIngresosPatrimoniales1() as $clave=>$valor){
            $active_sheet->setCellValue('F'.$count,number_format($valor, 2, ',','.'));
            $count++;
        }
        $count=2;
        $active_sheet->setCellValue('G1','TOTAL_INGRESOS_CORRIENTES');
        foreach($ccaa->getTotalIngresosCorrientes1() as $clave=>$valor){
            $active_sheet->setCellValue('G'.$count,number_format($valor, 2, ',','.'));
            $count++;
        }
        $count=2;
        $active_sheet->setCellValue('H1','ENAJENACION_DE_INVERSIONES_REALES');
        foreach($ccaa->getEnajenacionInversionesReales1() as $clave=>$valor){
            $active_sheet->setCellValue('H'.$count,number_format($valor, 2, ',','.'));
            $count++;
        }
        $count=2;
        $active_sheet->setCellValue('I1','TRANSFERENCIAS_DE_CAPITAL');
        foreach($ccaa->getTransferenciasCapital1() as $clave=>$valor){
            $active_sheet->setCellValue('I'.$count,number_format($valor, 2, ',','.'));
            $count++;
        }
        $count=2;
        $active_sheet->setCellValue('J1','INGRESOS_NO_FINANCIEROS');
        foreach($ccaa->getTotalIngresosNoCorrientes1() as $clave=>$valor){
            $active_sheet->setCellValue('J'.$count,number_format($valor, 2, ',','.'));
            $count++;
        }
        $count=2;
        $active_sheet->setCellValue('K1','ACTIVOS_FINANCIEROS');
        foreach($ccaa->getActivosFinancieros1() as $clave=>$valor){
            $active_sheet->setCellValue('K'.$count,number_format($valor, 2, ',','.'));
            $count++;
        }
        $count=2;
        $active_sheet->setCellValue('L1','PASIVOS_FINANCIEROS');
        foreach($ccaa->getPasivosFinancieros1() as $clave=>$valor){
            $active_sheet->setCellValue('L'.$count,number_format($valor, 2, ',','.'));
            $count++;
        }
        $count=2;
        $active_sheet->setCellValue('M1','INGRESOS_TOTALES');
        foreach($ccaa->getTotalIngresos1() as $clave=>$valor){
            $active_sheet->setCellValue('M'.$count,number_format($valor, 2, ',','.'));
            $count++;
        }

        $writer = new Xlsx($file);
        $filename = __DIR__.'/'.str_replace(' ', '_', str_replace(',','',str_replace('-','',strtolower($ccaa->getNombre())))).'_ingresos.xlsx';
        $writer->save($filename);
        return $filename;
    }

}

?>