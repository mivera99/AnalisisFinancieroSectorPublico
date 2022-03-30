<?php
session_start();
$nombre = htmlspecialchars(trim(strip_tags($_REQUEST["facilities"])));

$facility = '';
$tipo = '';

if(strpos($nombre, '(CCAA)')){
    $arr = explode('(CCAA)',$nombre);
    $facility = trim($arr[0]); // Se eliminan los espacios en balcno al inicio y al final de la cadena
    $urlcode = urlencode($facility);
    header('Location:infoCCAA.php?ccaa='.$urlcode.'');
    exit();
}
else {
    if(strpos($nombre, '(MUNICIPIO)')){
        $arr = explode('(MUNICIPIO)',$nombre);
        $facility = trim($arr[0]); // Se eliminan los espacios en balcno al inicio y al final de la cadena
        $urlcode = urlencode($facility);
        header('Location:infoMunicipio.php?mun='.$urlcode.'');
        exit();
    }
    else {
        if(strpos($nombre, '(DIPUTACIÓN)')){
            $arr = explode('(DIPUTACIÓN)',$nombre);
            $facility = trim($arr[0]); // Se eliminan los espacios en balcno al inicio y al final de la cadena
            $urlcode = urlencode($facility);
            header('Location:infoDiputacion.php?dip='.$urlcode.'');
            exit();
        }
        else {
            $_SESSION['mensaje']='Disculpe, pero la institución no se ha encontrado. Inténtelo de nuevo';
            header('Location:index');
            exit();
        }
    }
}
?>