<?php
session_start();
require_once('includesWeb/daos/DAOUsuario.php');

$email = htmlspecialchars(trim(strip_tags($_REQUEST["email"])));
$password = htmlspecialchars(trim(strip_tags($_REQUEST["password"])));
$nombreusuario = htmlspecialchars(trim(strip_tags($_REQUEST["username"])));
$rol = htmlspecialchars(trim(strip_tags($_REQUEST["rol"])));
$insertado = false;
if(!(new DAOUsuario())->insertaUsuario($email, $password, $nombreusuario, $rol)){
    $insertado = true;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--  ====== STYLES (CSS) ===== -->
    <link rel="stylesheet" href="styles.css">

    <!--  ====== FONTS ===== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    
    <!--  ====== FUNCIÓN AUTOCOMPLETAR BÚSQUEDA ===== -->
    <script src="functions.js"></script>

    <script src="node_modules/chart.js/dist/chart.js"></script>

    <title>Análisis Financiero del Sector Público</title>
</head>
    <body>

        <div id = "cabecera">
            <?php require("includesWeb/comun/cabecera.php");?>  
        </div>

        <div id ="contenido"> 
            <?php
            if($insertado){
                echo '<p>Error. El usuario no se ha creado</p>';
            }
            else {
                echo '<p>Usuario creado correctamente</p>';
            }
            ?>
        </div>

        <div id = "pie">
            <?php require("includesWeb/comun/pie.php");?>
        </div>

    </body>
</html>