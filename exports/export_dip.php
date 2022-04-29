<?php
require_once("configFileExport.php");
require_once("includes/vendor/autoload.php");
require_once("includesWeb/daos/DAOConsultor.php");

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Exporter_dip {

    public function export_dip($dipNombre){
        $daodip = new DAOConsultor();
        $diputacion = $daodip->getDiputacion($dipNombre);
        $dips= array();

        $dip2018 = $daodip->getEconomiaDIP(new Diputacion(), $diputacion->getCodigo(), 2018);
        array_push($dips,$dip2018);
        $dip2019 = $daodip->getEconomiaDIP(new Diputacion(), $diputacion->getCodigo(), 2019);
        array_push($dips,$dip2019);
        $dip2020 = $daodip->getEconomiaDIP(new Diputacion(), $diputacion->getCodigo(), 2020);
        array_push($dips,$dip2020);
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
        foreach($dips as $dip){
            $active_sheet->setCellValue($alphabet[$index].$count, number_format($dip->getImpuestosDirectos1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($dip->getImpuestosIndirectos1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($dip->getTasasPreciosOtros1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($dip->getTransferenciasCorrientes1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($dip->getIngresosPatrimoniales1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($dip->getTotalIngresosCorrientes1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($dip->getEnajenacionInversionesReales1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($dip->getTransferenciasCapital1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($dip->getTotalIngresosNoCorrientes1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($dip->getActivosFinancieros1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($dip->getPasivosFinancieros1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($dip->getTotalIngresos1(), 2, ',','.'));
            
            $count=2;
            $active_sheet->setCellValue($alphabet[$index+5].$count, number_format($dip->getGastosPersonal1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index+5].$count,number_format($dip->getGastosCorrientesBienesServicios1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index+5].$count,number_format($dip->getGastosFinancieros1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index+5].$count,number_format($dip->getTransferenciasCorrientesGastos1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index+5].$count,number_format($dip->getFondoContingencia1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index+5].$count,number_format($dip->getTotalGastosCorrientes1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index+5].$count,number_format($dip->getInversionesReales1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index+5].$count,number_format($dip->getTransferenciasCapitalGastos1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index+5].$count,number_format($dip->getTotalGastosNoFinancieros1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index+5].$count,number_format($dip->getActivosFinancierosGastos1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index+5].$count,number_format($dip->getPasivosFinancierosGastos1(), 2, ',','.'));
            $count++;
            $active_sheet->setCellValue($alphabet[$index+5].$count,number_format($dip->getTotalGastos1(), 2, ',','.'));
            $index++;
            $count=2;
        }
        
        $writer = new Xlsx($file);
        $filename = __DIR__.'/'.str_replace(' ', '_', str_replace(',','',str_replace('-','',strtolower($dip->getNombre())))).'_finanzas.xlsx';
        $writer->save($filename);
        return $filename;
    }

}

?>