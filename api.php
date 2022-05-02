<?php 
session_start();
header('Content-Type: application/json');
require('includesWeb/daos/DAOConsultor.php');

//La variable $_SERVER tiene entre otros, la petición HTTP que se está realizando a la web
$metodo = $_SERVER['REQUEST_METHOD']; //Solo nos interesa "GET"

/* EJEMPLO VARIABLE */
// $id = $_REQUEST['id'] ?? null; //Si no se nos proporciona el ID en la petición, por defecto lo dejamos en null

$peticion = $_REQUEST['request'] ?? null;
$id = $_REQUEST['id'] ?? null;
$nombre = $_REQUEST['name'] ?? null;
$anio = $_REQUEST['year'] ?? null;

if($metodo == "GET"){
    switch($peticion){
        case "getAllFacilities":
            $dao = new DAOConsultor();
            $peticion = new stdClass();

            $result = $dao->getAllFacilities();

            $peticion->getAllFacilities = $result;
            echo json_encode($peticion);
            break;
        
        case "getAllProvincias":
            $dao = new DAOConsultor();
            $peticion = new stdClass();

            $result = array();
            $provincias = $dao->getAllProvincias();
            foreach($provincias as $provincia){
                $element = new stdClass();
                $element->Codigo = $provincia->getCodigo();
                $element->Nombre = $provincia->getNombre();
                $element->Autonomia = $provincia->getCCAACode();
                array_push($result, $element);
            }

            $peticion->getAllProvincias = $result;
            echo json_encode($peticion);
            break;

        case "getProvinciaById":
            if($id){
                $dao = new DAOConsultor();
                $peticion = new stdClass();

                $id = intval($id);
                $provincia = $dao->getProvinciaById($id);

                $result = new stdClass();
                $result->Codigo = $provincia->getCodigo();
                $result->Nombre = $provincia->getNombre();


                $peticion->getPrivinciaById = $result;
                echo json_encode($peticion);
            }
            else{
                echo "ERROR: 'getProvinciaById' necesita el campo 'id' para poder devolver un valor";
            }
            break;

        case "getAllCCAAs":
            $dao = new DAOConsultor();
            $peticion = new stdClass();

            $result = array();
            $ccaas = $dao->getAllCCAAs();
            foreach($ccaas as $ccaa){
                $element = new stdClass();
                $element->Codigo = $ccaa->getCodigo();
                $element->Nombre = $ccaa->getNombre();
                array_push($result, $element);
            }

            $peticion->getAllCCAAs = $result;
            echo json_encode($peticion);
            break;
        
        case "getCCAAById":
            if($id){
                $dao = new DAOConsultor();
                $peticion = new stdClass();

                $id = intval($id);
                $ccaa = $dao->getCCAAById($id);

                $result = new stdClass();
                $result->Codigo = $ccaa->getCodigo();
                $result->Nombre = $ccaa->getNombre();


                $peticion->getCCAAById = $result;
                echo json_encode($peticion);
            }
            else{
                echo "ERROR: 'getCCAAById' necesita el campo 'id' para poder devolver un valor";
            }
            break;

        case "getCCAA":
            if($nombre){
                $dao = new DAOConsultor();
                $peticion = new stdClass();

                $ccaa = $dao->getCCAA($nombre);

                $result = new stdClass();
                $result->Codigo = $ccaa->getCodigo();
                $result->Nombre = $ccaa->getNombre();
                $result->NombrePresidente = $ccaa->getNombrePresidente();
                $result->Apellido1 = $ccaa->getApellido1();
                $result->Apellido2 = $ccaa->getApellido2();
                $result->Vigencia = $ccaa->getVigencia();
                $result->Partido = $ccaa->getPartido();
                $result->CIF = $ccaa->getCIF();
                $result->TipoVia = $ccaa->getTipoVia();
                $result->NumVia = $ccaa->getNumVia();
                $result->NombreVia = $ccaa->getNombreVia();
                $result->Telefono = $ccaa->getTelefono();
                $result->CodigoPostal = $ccaa->getCodigoPostal();
                $result->Fax = $ccaa->getFax();
                $result->Mail = $ccaa->getMail();
                $result->Web = $ccaa->getWeb();

                //Scoring
                $ratings = $ccaa->getScoring();
                $result->Scoring = $ratings;


                //Tendencia
                $tendencias = $ccaa->getTendencia();
                $result->Tendencia = $tendencias;


                //Poblacion
                $poblacion = $ccaa->getPoblacion();
                $result->Poblacion = $poblacion;


                //CuentasGeneralesCCAA
                $cuentasGenerales = new stdClass();
                $cuentasGenerales->IncrPib = $ccaa->getIncrPib();
                $cuentasGenerales->Empresas = $ccaa->getEmpresas();
                $cuentasGenerales->RSosteFinanciera = $ccaa->getRSosteFinanciera();
                $cuentasGenerales->REfic = $ccaa->getREfic();
                $cuentasGenerales->RRigidez = $ccaa->getRRigidez();
                $cuentasGenerales->RSosteEndeuda = $ccaa->getRSosteEndeuda();
                $cuentasGenerales->REjeIngrCorr = $ccaa->getREjeIngrCorr();
                $cuentasGenerales->REjeGastosCorr = $ccaa->getREjeGastosCorr();
                $cuentasGenerales->PagosObligaciones = $ccaa->getPagosObligaciones();
                $cuentasGenerales->REficaciaRec = $ccaa->getREficaciaRec();

                $result->CuentasGenerales = $cuentasGenerales;


                //DeudasCCAA
                $deudas = new stdClass();
                $deudas->Pib = $ccaa->getPib();
                $deudas->Pibc = $ccaa->getPibc();
                $deudas->Resultado = $ccaa->getResultado();

                $result->Deudas = $deudas;


                /* CuentasGeneralMensual */
                $cuentasGeneralMenusal = new stdClass();

                //Paro
                $paro = $ccaa->getParo();
                $paroarray = array();
                foreach($paro as $elem){
                    $paroclass = new stdClass();
                    $paroclass->Año = $elem[0];
                    $paroclass->Trimestre = $elem[1];
                    $paroclass->Valor = $elem[2];
                    array_push($paroarray,$paroclass);
                }
                $cuentasGeneralMenusal->Paro = $paroarray;

                //PMP
                $pmp = $ccaa->getPMP();
                $pmparray = array();
                foreach($pmp as $elem){
                    $pmpclass = new stdClass();
                    $pmpclass->Año = $elem[0];
                    $pmpclass->Trimestre = $elem[1];
                    $pmpclass->Valor = $elem[2];
                    array_push($pmparray,$pmpclass);
                }
                $cuentasGeneralMenusal->PMP = $pmparray;

                //RDCPP
                $rdcpp = $ccaa->getRDCPP();
                $rdcpparray = array();
                foreach($rdcpp as $elem){
                    $rdcppclass = new stdClass();
                    $rdcppclass->Año = $elem[0];
                    $rdcppclass->Trimestre = $elem[1];
                    $rdcppclass->Valor = $elem[2];
                    array_push($rdcpparray,$rdcppclass);
                }
                $cuentasGeneralMenusal->RDCPP = $rdcpparray;

                //DeudaViva
                $deudaviva = $ccaa->getDeudaViva();
                $deudavivaarray = array();
                foreach($deudaviva as $elem){
                    $deudavivaclass = new stdClass();
                    $deudavivaclass->Año = $elem[0];
                    $deudavivaclass->Trimestre = $elem[1];
                    $deudavivaclass->Valor = $elem[2];
                    array_push($deudavivaarray,$deudavivaclass);
                }
                $cuentasGeneralMenusal->DeudaViva = $deudavivaarray;

                //DeudaVivaIngrCorr
                $cuentasGeneralMenusal->DeudaVivaIngrCorr = $ccaa->getDeudaVivaIngrCor();
                $dvic = $ccaa->getDeudaVivaIngrCor();
                $dvicarray = array();
                foreach($dvic as $elem){
                    $dvicclass = new stdClass();
                    $dvicclass->Año = $elem[0];
                    $dvicclass->Trimestre = $elem[1];
                    $dvicclass->Valor = $elem[2];
                    array_push($dvicarray,$dvicclass);
                }
                $cuentasGeneralMenusal->DeudaVivaIngrCorr = $dvicarray;
                
                //TransacInmobiliarias
                $ti = $ccaa->getTransacInmobiliarias();
                $tiarray = array();
                foreach($ti as $elem){
                    $ticlass = new stdClass();
                    $ticlass->Año = $elem[0];
                    $ticlass->Trimestre = $elem[1];
                    $ticlass->Valor = $elem[2];
                    array_push($tiarray,$ticlass);
                }
                $cuentasGeneralMenusal->TransaccionesImobliarias = $tiarray;
                
                $result->CuentasGeneralMensual = $cuentasGeneralMenusal;



                //Ingresos
                $ingresos = new stdClass();

                $ingresos->ImpuestosDirectos = $ccaa->getImpuestosDirectos1();
                $ingresos->ImpuestosIndirectos = $ccaa->getImpuestosIndirectos1();
                $ingresos->TasasPreciosOtros = $ccaa->getTasasPreciosOtros1();
                $ingresos->TransferenciasCorrientes = $ccaa->getTransferenciasCorrientes1();
                $ingresos->IngresosPatrimoniales = $ccaa->getIngresosPatrimoniales1();
                $ingresos->TotalIngresosCorrientes = $ccaa->getTotalIngresosCorrientes1();
                $ingresos->EnajenacionInversionesReales = $ccaa->getEnajenacionInversionesReales1();
                $ingresos->TransferenciasCapital = $ccaa->getTransferenciasCapital1();
                $ingresos->TotalIngresosNoCorrientes = $ccaa->getTotalIngresosNoCorrientes1();
                $ingresos->ActivosFinancieros = $ccaa->getActivosFinancieros1();
                $ingresos->PasivosFinancieros = $ccaa->getPasivosFinancieros1();
                $ingresos->TotalIngresos = $ccaa->getTotalIngresos1();

                $result->Ingresos = $ingresos;

                //Gastos
                $gastos = new stdClass();

                $gastos->GastosPersonal = $ccaa->getGastosPersonal1();
                $gastos->GastosCorrientesBienesServicios = $ccaa->getGastosCorrientesBienesServicios1();
                $gastos->GastosFinancieros = $ccaa->getGastosFinancieros1();
                $gastos->TransferenciasCorrientes = $ccaa->getTransferenciasCorrientesGastos1();
                $gastos->FondoContingencia = $ccaa->getFondoContingencia1();
                $gastos->TotalGastosCorrientes = $ccaa->getTotalGastosCorrientes1();
                $gastos->InversionesReales = $ccaa->getInversionesReales1();
                $gastos->TransferenciasCapital = $ccaa->getTransferenciasCapitalGastos1();
                $gastos->TotalGastosNoFinancieros = $ccaa->getTotalGastosNoFinancieros1();
                $gastos->ActivosFinancieros = $ccaa->getActivosFinancierosGastos1();
                $gastos->PasivosFinancieros = $ccaa->getPasivosFinancierosGastos1();
                $gastos->TotalGastos = $ccaa->getTotalGastos1();

                $result->Gastos = $gastos;
                

                $peticion->getCCAA = $result;
                echo json_encode($peticion);
            }
            else{
                echo "ERROR: 'getCCAA' necesita el campo 'nombre' para poder devolver un valor";
            }
            break;
        
        case "getMunicipio":
            if($nombre){
                $dao = new DAOConsultor();
                $peticion = new stdClass();

                $mun = $dao->getMunicipio($nombre);

                $result = new stdClass();
                $result->Codigo = $mun->getCodigo();
                $result->Nombre = $mun->getNombre();
                $result->NombreAlcalde = $mun->getNombreAlcalde();
                $result->Apellido1 = $mun->getApellido1();
                $result->Apellido2 = $mun->getApellido2();
                $result->Autonomia = $mun->getAutonomia();
                $result->Provincia = $mun->getProvincia();
                $result->Vigencia = $mun->getVigencia();
                $result->Partido = $mun->getPartido();
                $result->Cif = $mun->getCif();
                $result->TipoVia = $mun->getTipoVia();
                $result->NombreVia = $mun->getNombreVia();
                $result->NumVia = $mun->getNumVia();
                $result->Telefono = $mun->getTelefono();
                $result->CodigoPostal = $mun->getCodigoPostal();
                $result->Fax = $mun->getFax();
                $result->Mail = $mun->getMail();
                $result->Web = $mun->getWeb();
                $result->Scoring = $mun->getScoring();
                $result->Tendencia  = $mun->getTendencia();


                $peticion->getMunicipio = $result;
                echo json_encode($peticion);
            }
            else{
                echo "ERROR: 'getMunicipio' necesita el campo 'name' para poder devolver un valor";
            }
            break;
        
        case "getEconomiaMUN":
            if($id && $anio){
                $dao = new DAOConsultor();
                $peticion = new stdClass();
                $mun_aux = new Municipio();

                $id = intval($id);
                $anio = intval($anio);

                $mun = $dao->getEconomiaMUN($mun_aux,$id,$anio);

                $result = new stdClass();
                
                //Ingresos
                $ingresos = new stdClass();
                $ingresos->ImpuestosDirectos = $mun->getImpuestosDirectos1();
                $ingresos->ImpuestosIndirectos = $mun->getImpuestosIndirectos1();
                $ingresos->TasasPreciosOtros = $mun->getTasasPreciosOtros1();
                $ingresos->TransferenciasCorrientes = $mun->getTransferenciasCorrientes1();
                $ingresos->IngresosPatrimoniales = $mun->getIngresosPatrimoniales1();
                $ingresos->TotalIngresosCorrientes = $mun->getTotalIngresosCorrientes1();
                $ingresos->EnajenacionInversionesReales = $mun->getEnajenacionInversionesReales1();
                $ingresos->TransferenciasCapital = $mun->getTransferenciasCapital1();
                $ingresos->TotalIngresosNoCorrientes = $mun->getTotalIngresosNoCorrientes1();
                $ingresos->ActivosFinancieros = $mun->getActivosFinancieros1();
                $ingresos->PasivosFinancieros = $mun->getPasivosFinancieros1();
                $ingresos->TotalIngresos = $mun->getTotalIngresos1();

                $result->Ingresos = $ingresos;

                //Gastos
                $gastos = new stdClass();
                $gastos->GastosPersonal = $mun->getGastosPersonal1();
                $gastos->GastosCorrientesBienesServicios = $mun->getGastosCorrientesBienesServicios1();
                $gastos->GastosFinancieros = $mun->getGastosFinancieros1();
                $gastos->TransferenciasCorrientesGastos = $mun->getTransferenciasCorrientesGastos1();
                $gastos->FondoContingencia = $mun->getFondoContingencia1();
                $gastos->TotalGastosCorrientes = $mun->getTotalGastosCorrientes1();
                $gastos->InversionesReales = $mun->getInversionesReales1();
                $gastos->TransferenciasCapitalGastos = $mun->getTransferenciasCapitalGastos1();
                $gastos->TotalGastosNoFinancieros = $mun->getTotalGastosNoFinancieros1();
                $gastos->ActivosFinancierosGastos = $mun->getActivosFinancierosGastos1();
                $gastos->PasivosFinancierosGastos = $mun->getPasivosFinancierosGastos1();
                $gastos->TotalGastos = $mun->getTotalGastos1();

                $result->Gastos = $ingresos;

                //Endeudamiento
                $endeudamiento = new stdClass();
                $endeudamiento->SostenibilidadFinanciera = $mun->getSostenibilidadFinanciera();
                $endeudamiento->SostenibilidadFinancieraMediaDiputaciones = $mun->getSostenibilidadFinancieraMediaDiputaciones();
                $endeudamiento->ApalancamientoOperativo = $mun->getApalancamientoOperativo();
                $endeudamiento->ApalancamientoOperativoMediaDiputaciones = $mun->getApalancamientoOperativoMediaDiputaciones();
                $endeudamiento->SostenibilidadDeuda = $mun->getSostenibilidadDeuda();
                $endeudamiento->SostenibilidadDeudaMediaDiputaciones = $mun->getSostenibilidadDeudaMediaDiputaciones();

                $result->Endeudamiento = $endeudamiento;

                //Liquidez
                $liquidez = new stdClass();
                $liquidez->FondosLiquidos = $mun->getFondosLiquidos();
                $liquidez->RemanenteTesoreriaGastosGenerales = $mun->getRemanenteTesoreriaGastosGenerales();
                $liquidez->RemanenteTesoreriaGastosGeneralesMediaDiputaciones = $mun->getRemanenteTesoreriaGastosGeneralesMediaDiputaciones();
                $liquidez->LiquidezInmediata = $mun->getLiquidezInmediata();
                $liquidez->SolvenciaCortoPlazoMediaDiputaciones = $mun->getSolvenciaCortoPlazoMediaDiputaciones();
                $liquidez->SolvenciaCortoPlazoMediaDiputaciones2 = $mun->getSolvenciaCortoPlazoMediaDiputaciones2();
                $liquidez->SolvenciaCortoPlazo = $mun->getSolvenciaCortoPlazo();

                $result->Liquidez = $liquidez;

                //Eficiencia
                $eficiencia = new stdClass();
                $eficiencia->Eficiencia = $mun->getEficiencia();
                $eficiencia->EficienciaMediaDiputaciones = $mun->getEficienciaMediaDiputaciones();

                $result->Eficiencia = $eficiencia;

                //Gestion Presupuestaria
                $gest = new stdClass();
                $gest->EjecucionIngresosCorrientes = $mun->getEjecucionIngresosCorrientes();
                $gest->EjecucionIngresosCorrientesMediaDiputaciones = $mun->getEjecucionIngresosCorrientesMediaDiputaciones();
                $gest->EjecucionGastosCorrientes = $mun->getEjecucionGastosCorrientes();
                $gest->EjecucionGastosCorrientesMediaDiputaciones = $mun->getEjecucionGastosCorrientesMediaDiputaciones();

                $result->GestionPresupuestaria = $gest;

                //Cumplimiento Pagos
                $cum = new stdClass();
                $cum->DeudaComercial = $mun->getDeudaComercial();
                $cum->PMP = $mun->getPeriodoMedioPagos();
                $cum->PMPMediaDiputaciones = $mun->getPeriodoMedioPagosMediaDiputaciones();
                $cum->PagosSobreObligacionesReconocidas = $mun->getPagosSobreObligacionesReconocidas();
                $cum->PagosSobreObligacionesReconocidasMediaDiputaciones = $mun->getPagosSobreObligacionesReconocidasMediaDiputaciones();

                $result->CumplimientoPagos = $cum;

                //Gestion Tributaria
                $gest = new stdClass();
                $gest->DerechosPendientesCobro = $mun->getDerechosPendientesCobro();
                $gest->EficaciaRecaudatoria = $mun->getEficaciaRecaudatoria();
                $gest->EficaciaRecaudatoriaMediaDiputaciones = $mun->getEficaciaRecaudatoriaMediaDiputaciones();

                $result->GestionTributaria = $gest;


                $peticion->getEconomiaMUN = $result;
                echo json_encode($peticion);


            }
            else{
                if(!$id){
                    echo "ERROR: 'getEconomiaMUN' necesita el campo 'id' para poder devolver un valor";
                }
                if(!$anio){
                    echo "ERROR: 'getEconomiaMUN' necesita el campo 'year' para poder devolver un valor"; 
                }
            }
            break;

        case "getProgMUN":
            if($id){
                $dao = new DAOConsultor();
                $peticion = new stdClass();
                $mun_aux = new Municipio();

                $mun = $dao->getProgMUN($mun_aux,$id);

                $result = new stdClass();
                $result->Agp = $mun->getAgp();
                $result->Sop = $mun->getSop();
                $result->Ote = $mun->getOte();
                $result->Mu = $mun->getMu();
                $result->Pc = $mun->getPc();
                $result->Spei = $mun->getSpei();
                $result->Pgvpp = $mun->getPgvpp();
                $result->Cre = $mun->getCre();
                $result->Pvp = $mun->getPvp();
                $result->A = $mun->getA();
                $result->Rgtr = $mun->getRgtr();
                $result->Rr = $mun->getRr();
                $result->Grsu = $mun->getGrsu();
                $result->Tr = $mun->getTr();
                $result->Lv = $mun->getLv();
                $result->Csf = $mun->getCsf();
                $result->Ap = $mun->getAp();
                $result->Pj = $mun->getPj();
                $result->P = $mun->getP();
                $result->Ssps = $mun->getSsps();
                $result->Fe = $mun->getFe();
                $result->S = $mun->getS();
                $result->E = $mun->getE();
                $result->C = $mun->getC();
                $result->D = $mun->getD();
                $result->Agp = $mun->getAgp();
                $result->Ie = $mun->getIe();
                $result->Com = $mun->getCom();
                $result->Tp = $mun->getTp();
                $result->It = $mun->getIt();
                $result->Idi = $mun->getIdi();


                $peticion->getProgMUN = $result;
                echo json_encode($peticion);
            }
            else{
                echo "ERROR: 'getProgMUN' necesita el campo 'name' para poder devolver un valor";
            }
            break;

        case "getDiputacion":
            if($nombre){
                $dao = new DAOConsultor();
                $peticion = new stdClass();

                $dip = $dao->getDiputacion($nombre);

                $result = new stdClass();
                $result->Codigo = $dip->getCodigo();
                $result->Nombre = $dip->getNombre();
                $result->Autonomia = $dip->getAutonomia();
                $result->Provincia = $dip->getProvincia();
                $result->Cif = $dip->getCif();
                $result->TipoVia = $dip->getTipoVia();
                $result->NombreVia = $dip->getNombreVia();
                $result->NumVia = $dip->getNumVia();
                $result->Telefono = $dip->getTelefono();
                $result->CodigoPostal = $dip->getCodigoPostal();
                $result->Fax = $dip->getFax();
                $result->Mail = $dip->getMail();
                $result->Web = $dip->getWeb();
                $result->Scoring = $dip->getScoring();
                $result->Tendencia  = $dip->getTendencia();


                $peticion->getDiputacion = $result;
                echo json_encode($peticion);
            }
            else{
                echo "ERROR: 'getDiputacion' necesita el campo 'name' para poder devolver un valor";
            }
            break;
        
        case "getEconomiaDIP":
            if($id && $anio){
                $dao = new DAOConsultor();
                $peticion = new stdClass();
                $dip_aux = new Diputacion();

                $anio = intval($anio);

                $dip = $dao->getEconomiaDIP($dip_aux,$id,$anio);
                echo gettype($dip);

                $result = new stdClass();
                
                //Ingresos
                $ingresos = new stdClass();
                $ingresos->ImpuestosDirectos = $dip->getImpuestosDirectos1();
                $ingresos->ImpuestosIndirectos = $dip->getImpuestosIndirectos1();
                $ingresos->TasasPreciosOtros = $dip->getTasasPreciosOtros1();
                $ingresos->TransferenciasCorrientes = $dip->getTransferenciasCorrientes1();
                $ingresos->IngresosPatrimoniales = $dip->getIngresosPatrimoniales1();
                $ingresos->TotalIngresosCorrientes = $dip->getTotalIngresosCorrientes1();
                $ingresos->EnajenacionInversionesReales = $dip->getEnajenacionInversionesReales1();
                $ingresos->TransferenciasCapital = $dip->getTransferenciasCapital1();
                $ingresos->TotalIngresosNoCorrientes = $dip->getTotalIngresosNoCorrientes1();
                $ingresos->ActivosFinancieros = $dip->getActivosFinancieros1();
                $ingresos->PasivosFinancieros = $dip->getPasivosFinancieros1();
                $ingresos->TotalIngresos = $dip->getTotalIngresos1();

                $result->Ingresos = $ingresos;

                //Gastos
                $gastos = new stdClass();
                $gastos->GastosPersonal = $dip->getGastosPersonal1();
                $gastos->GastosCorrientesBienesServicios = $dip->getGastosCorrientesBienesServicios1();
                $gastos->GastosFinancieros = $dip->getGastosFinancieros1();
                $gastos->TransferenciasCorrientesGastos = $dip->getTransferenciasCorrientesGastos1();
                $gastos->FondoContingencia = $dip->getFondoContingencia1();
                $gastos->TotalGastosCorrientes = $dip->getTotalGastosCorrientes1();
                $gastos->InversionesReales = $dip->getInversionesReales1();
                $gastos->TransferenciasCapitalGastos = $dip->getTransferenciasCapitalGastos1();
                $gastos->TotalGastosNoFinancieros = $dip->getTotalGastosNoFinancieros1();
                $gastos->ActivosFinancierosGastos = $dip->getActivosFinancierosGastos1();
                $gastos->PasivosFinancierosGastos = $dip->getPasivosFinancierosGastos1();
                $gastos->TotalGastos = $dip->getTotalGastos1();

                $result->Gastos = $ingresos;

                //Endeudamiento
                $endeudamiento = new stdClass();
                $endeudamiento->SostenibilidadFinanciera = $dip->getSostenibilidadFinanciera();
                $endeudamiento->SostenibilidadFinancieraMediaDiputaciones = $dip->getSostenibilidadFinancieraMediaDiputaciones();
                $endeudamiento->ApalancamientoOperativo = $dip->getApalancamientoOperativo();
                $endeudamiento->ApalancamientoOperativoMediaDiputaciones = $dip->getApalancamientoOperativoMediaDiputaciones();
                $endeudamiento->SostenibilidadDeuda = $dip->getSostenibilidadDeuda();
                $endeudamiento->SostenibilidadDeudaMediaDiputaciones = $dip->getSostenibilidadDeudaMediaDiputaciones();

                $result->Endeudamiento = $endeudamiento;

                //Liquidez
                $liquidez = new stdClass();
                $liquidez->FondosLiquidos = $dip->getFondosLiquidos();
                $liquidez->RemanenteTesoreriaGastosGenerales = $dip->getRemanenteTesoreriaGastosGenerales();
                $liquidez->RemanenteTesoreriaGastosGeneralesMediaDiputaciones = $dip->getRemanenteTesoreriaGastosGeneralesMediaDiputaciones();
                $liquidez->LiquidezInmediata = $dip->getLiquidezInmediata();
                $liquidez->SolvenciaCortoPlazoMediaDiputaciones = $dip->getSolvenciaCortoPlazoMediaDiputaciones();
                $liquidez->SolvenciaCortoPlazoMediaDiputaciones2 = $dip->getSolvenciaCortoPlazoMediaDiputaciones2();
                $liquidez->SolvenciaCortoPlazo = $dip->getSolvenciaCortoPlazo();

                $result->Liquidez = $liquidez;

                //Eficiencia
                $eficiencia = new stdClass();
                $eficiencia->Eficiencia = $dip->getEficiencia();
                $eficiencia->EficienciaMediaDiputaciones = $dip->getEficienciaMediaDiputaciones();

                $result->Eficiencia = $eficiencia;

                //Gestion Presupuestaria
                $gest = new stdClass();
                $gest->EjecucionIngresosCorrientes = $dip->getEjecucionIngresosCorrientes();
                $gest->EjecucionIngresosCorrientesMediaDiputaciones = $dip->getEjecucionIngresosCorrientesMediaDiputaciones();
                $gest->EjecucionGastosCorrientes = $dip->getEjecucionGastosCorrientes();
                $gest->EjecucionGastosCorrientesMediaDiputaciones = $dip->getEjecucionGastosCorrientesMediaDiputaciones();

                $result->GestionPresupuestaria = $gest;

                //Cumplimiento Pagos
                $cum = new stdClass();
                $cum->DeudaComercial = $dip->getDeudaComercial();
                $cum->PMP = $dip->getPeriodoMedioPagos();
                $cum->PMPMediaDiputaciones = $dip->getPeriodoMedioPagosMediaDiputaciones();
                $cum->PagosSobreObligacionesReconocidas = $dip->getPagosSobreObligacionesReconocidas();
                $cum->PagosSobreObligacionesReconocidasMediaDiputaciones = $dip->getPagosSobreObligacionesReconocidasMediaDiputaciones();

                $result->CumplimientoPagos = $cum;

                //Gestion Tributaria
                $gest = new stdClass();
                $gest->DerechosPendientesCobro = $dip->getDerechosPendientesCobro();
                $gest->EficaciaRecaudatoria = $dip->getEficaciaRecaudatoria();
                $gest->EficaciaRecaudatoriaMediaDiputaciones = $dip->getEficaciaRecaudatoriaMediaDiputaciones();

                $result->GestionTributaria = $gest;


                $peticion->getEconomiaDIP = $result;
                echo json_encode($peticion);


            }
            else{
                if(!$id){
                    echo "ERROR: 'getEconomiaDIP' necesita el campo 'id' para poder devolver un valor";
                }
                if(!$anio){
                    echo "ERROR: 'getEconomiaDIP' necesita el campo 'year' para poder devolver un valor"; 
                }
            }
            break;

        default:
            echo "ERROR: '{$peticion}': Petición no soportada. Por favor introduce alguna de las siguientes: getAllFacilities";

    }
}
else{
    echo "ERROR: Únicamente se permite peticiones del tipo 'GET'";
}

?>