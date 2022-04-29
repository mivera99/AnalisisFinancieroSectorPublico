<?php
require_once("configFileExport.php");
require_once("includes/vendor/autoload.php");
require_once("includesWeb/daos/DAOConsultor.php");

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Exporter_ccaa {

    public function export_ccaa($ccaaNombre){        
        $daoccaa = new DAOConsultor();
        $ccaa = $daoccaa->getCCAA($ccaaNombre);
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

        $index=1;
        $count=1;
        foreach($ccaa->getImpuestosDirectos1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,$clave);
            $index++;
        }
        $count++;
        $index=1;
        foreach($ccaa->getImpuestosDirectos1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=1;
        foreach($ccaa->getImpuestosIndirectos1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=1;
        foreach($ccaa->getTasasPreciosOtros1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=1;
        foreach($ccaa->getTransferenciasCorrientes1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=1;
        foreach($ccaa->getIngresosPatrimoniales1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=1;
        foreach($ccaa->getTotalIngresosCorrientes1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=1;
        foreach($ccaa->getEnajenacionInversionesReales1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=1;
        foreach($ccaa->getTransferenciasCapital1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=1;
        foreach($ccaa->getTotalIngresosNoCorrientes1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=1;
        foreach($ccaa->getActivosFinancieros1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=1;
        foreach($ccaa->getPasivosFinancieros1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=1;
        foreach($ccaa->getTotalIngresos1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }

        $count=1;
        $index=6;
        foreach($ccaa->getGastosPersonal1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,$clave);
            $index++;
        }

        $count++;
        $index=6;
        foreach($ccaa->getGastosPersonal1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=6;
        foreach($ccaa->getGastosCorrientesBienesServicios1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=6;
        foreach($ccaa->getGastosFinancieros1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=6;
        foreach($ccaa->getTransferenciasCorrientesGastos1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=6;
        foreach($ccaa->getFondoContingencia1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=6;
        foreach($ccaa->getTotalGastosCorrientes1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=6;
        foreach($ccaa->getInversionesReales1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=6;
        foreach($ccaa->getTransferenciasCapitalGastos1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=6;
        foreach($ccaa->getTotalGastosNoFinancieros1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=6;
        foreach($ccaa->getActivosFinancieros1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=6;
        foreach($ccaa->getPasivosFinancierosGastos1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }
        $count++;
        $index=6;
        foreach($ccaa->getTotalGastos1() as $clave=>$valor){
            $active_sheet->setCellValue($alphabet[$index].$count,number_format($valor, 2, ',','.'));
            $index++;
        }


        $writer = new Xlsx($file);
        $filename = __DIR__.'/'.str_replace(' ', '_', str_replace(',','',str_replace('-','',strtolower($ccaa->getNombre())))).'_finanzas.xlsx';
        $writer->save($filename);
        return $filename;
    }

}

?>