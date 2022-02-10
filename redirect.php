<?php
$nombre = htmlspecialchars(trim(strip_tags($_REQUEST["facilities"])));

$facility = '';
$tipo = '';

if(strpos($nombre, '(CCAA)')){
    $arr = explode('(CCAA)',$nombre);
    $facility = trim($arr[0]); // Se eliminan los espacios en balcno al inicio y al final de la cadena
    header('Location:infoCCAA.php?ccaa='.$facility.'');
}
else {
    if(strpos($nombre, '(MUNICIPIO)')){
        $arr = explode('(MUNICIPIO)',$nombre);
        $facility = trim($arr[0]); // Se eliminan los espacios en balcno al inicio y al final de la cadena
        header('Location:infoMunicipio.php?mun='.$facility.'');
    }
    else {
        if(strpos($nombre, '(DIPUTACIÓN)')){
            $arr = explode('(DIPUTACIÓN)',$nombre);
            $facility = trim($arr[0]); // Se eliminan los espacios en balcno al inicio y al final de la cadena
            header('Location:infoDiputacion.php?dip='.$facility.'');
        }
        else {
            header('Location:index.php');
        }
    }
}

/*$arr = explode(' (', $nombre);
$arr[1] = substr($arr[1], 0, -1);

if(count($arr)==2){
    if($arr[1]=="CCAA"){
        header('Location:infoCCAA.php?ccaa='.$arr[0].'');
    }
    else if($arr[1]=="MUNICIPIO"){
        header('Location:infoMunicipio.php?mun='.$arr[0].'');
    }
    else if($arr[1]=="DIPUTACIÓN"){
        header('Location:infoDiputacion.php?dip='.$arr[0].'');
    }
    else{
        header('Location:index.php');
    }
}
else {
    header('Location:index.php');
}
*/
?>