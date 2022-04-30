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
$nombre = $_REQUEST['nombre'] ?? null;

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






                $peticion->getCCAA = $result;
                echo json_encode($peticion);
            }
            else{
                echo "ERROR: 'getCCAA' necesita el campo 'nombre' para poder devolver un valor";
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