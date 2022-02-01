<?php
$nombre = htmlspecialchars(trim(strip_tags($_REQUEST["facilities"])));

$arr = explode(' (', $nombre);
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

?>