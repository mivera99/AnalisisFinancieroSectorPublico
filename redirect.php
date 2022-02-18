<?php
$nombre = htmlspecialchars(trim(strip_tags($_REQUEST["facilities"])));

$facility = '';
$tipo = '';

if(strpos($nombre, '(CCAA)')){
    $arr = explode('(CCAA)',$nombre);
    $facility = trim($arr[0]); // Se eliminan los espacios en balcno al inicio y al final de la cadena
    $urlcode = urlencode($facility);
    header('Location:infoCCAA?ccaa='.$urlcode.'');
}
else {
    if(strpos($nombre, '(MUNICIPIO)')){
        $arr = explode('(MUNICIPIO)',$nombre);
        $facility = trim($arr[0]); // Se eliminan los espacios en balcno al inicio y al final de la cadena
        $urlcode = urlencode($facility);
        header('Location:infoMunicipio?mun='.$urlcode.'');
    }
    else {
        if(strpos($nombre, '(DIPUTACIÓN)')){
            $arr = explode('(DIPUTACIÓN)',$nombre);
            $facility = trim($arr[0]); // Se eliminan los espacios en balcno al inicio y al final de la cadena
            $urlcode = urlencode($facility);
            header('Location:infoDiputacion?dip='.$urlcode.'');
        }
        else {
            header('Location:index');
        }
    }
}
?>