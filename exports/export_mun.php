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
        $municipio = $daomun->getMunicipio($munNombre);

        $muns= array();

        $mun2018 = $daomun->getEconomiaMUN(new Municipio(), $municipio->getCodigo(), 2018);
        array_push($muns,$mun2018);
        $mun2019 = $daomun->getEconomiaMUN(new Municipio(), $municipio->getCodigo(), 2019);
        array_push($muns,$mun2019);
        $mun2020 = $daomun->getEconomiaMUN(new Municipio(), $municipio->getCodigo(), 2020);
        array_push($muns,$mun2020);
        $file = new SpreadSheet();
        $active_sheet = $file->getActiveSheet();
        
        $alphabet=array();
        foreach(range('A','Z') as $letter){
            array_push($alphabet, $letter);
        }

        $active_sheet->setCellValue('A1','INGRESOS');
        $active_sheet->setCellValue('A2','IMPUESTOS_DIRECTOS');
        $active_sheet->setCellValue('A3','IMPUESTOS_INDIRECTOS');
        $active_sheet->setCellValue('A4','TASAS_PRECIOS_PUBLICOS_Y_OTROS_INGRESOS');
        $active_sheet->setCellValue('A5','TRANSFERENCIAS_CORRIENTES');
        $active_sheet->setCellValue('A6','INGRESOS_PATRIMONIALES');
        $active_sheet->setCellValue('A7','TOTAL_INGRESOS_CORRIENTES');
        $active_sheet->setCellValue('A8','ENAJENACION_INVERSIONES_REALES');
        $active_sheet->setCellValue('A9','TRANSFERENCIAS_DE_CAPITAL');
        $active_sheet->setCellValue('A10','INGRESOS_NO_FINANCIEROS');
        $active_sheet->setCellValue('A11','ACTIVOS_FINANCIEROS');
        $active_sheet->setCellValue('A12','PASIVOS_FINANCIEROS');
        $active_sheet->setCellValue('A13','INGRESOS_TOTALES');
        $active_sheet->setCellValue('B1', 2018);
        $active_sheet->setCellValue('C1', 2019);
        $active_sheet->setCellValue('D1', 2020);
        
        $active_sheet->setCellValue('F1','GASTOS');
        $active_sheet->setCellValue('F2','GASTOS_DEL_PERSONAL');
        $active_sheet->setCellValue('F3','GASTOS_CORRIENTES_BIENES_SERVICIOS');
        $active_sheet->setCellValue('F4','GASTOS_FINANCIEROS');
        $active_sheet->setCellValue('F5','TRANSFERENCIAS_CORRIENTES');
        $active_sheet->setCellValue('F6','FONDO_CONTINGENCIA');
        $active_sheet->setCellValue('F7','TOTAL_GASTOS_CORRIENTES');
        $active_sheet->setCellValue('F8','INVERSIONES_REALES');
        $active_sheet->setCellValue('F9','TRANSFERENCIAS_CAPITAL');
        $active_sheet->setCellValue('F10','GASTOS_NO_FINANCIEROS');
        $active_sheet->setCellValue('F11','ACTIVOS_FINANCIEROS');
        $active_sheet->setCellValue('F12','PASIVOS_FINANCIEROS');
        $active_sheet->setCellValue('F13','GASTOS_TOTALES');
        $active_sheet->setCellValue('G1', 2018);
        $active_sheet->setCellValue('H1', 2019);
        $active_sheet->setCellValue('I1', 2020);

        $index=1;
        $count=2;
        foreach($muns as $mun){
            $active_sheet->setCellValue($alphabet[$index].$count, number_format($mun->getImpuestosDirectos1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($mun->getImpuestosIndirectos1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($mun->getTasasPreciosOtros1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($mun->getTransferenciasCorrientes1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($mun->getIngresosPatrimoniales1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($mun->getTotalIngresosCorrientes1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($mun->getEnajenacionInversionesReales1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($mun->getTransferenciasCapital1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($mun->getTotalIngresosNoCorrientes1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($mun->getActivosFinancieros1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($mun->getPasivosFinancieros1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($mun->getTotalIngresos1(), 2, ',','.'));
            
            $count=2;
            $active_sheet->setCellValue($alphabet[$index+5].$count, number_format($mun->getGastosPersonal1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index+5].$count,number_format($mun->getGastosCorrientesBienesServicios1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index+5].$count,number_format($mun->getGastosFinancieros1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index+5].$count,number_format($mun->getTransferenciasCorrientesGastos1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index+5].$count,number_format($mun->getFondoContingencia1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index+5].$count,number_format($mun->getTotalGastosCorrientes1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index+5].$count,number_format($mun->getInversionesReales1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index+5].$count,number_format($mun->getTransferenciasCapitalGastos1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index+5].$count,number_format($mun->getTotalGastosNoFinancieros1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index+5].$count,number_format($mun->getActivosFinancierosGastos1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index+5].$count,number_format($mun->getPasivosFinancierosGastos1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index+5].$count,number_format($mun->getTotalGastos1(), 2, ',','.'));
            $index++;
            $count=2;
        }

        $writer = new Xlsx($file);
        $filename = __DIR__.'/'.str_replace(' ', '_', str_replace(',','',str_replace('-','',strtolower($mun->getNombre())))).'_finanzas.xlsx';
        $writer->save($filename);
        return $filename;
    }

}

?>