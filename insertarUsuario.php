<?php
session_start();
require_once('includesWeb\daos\DAOConsultor.php');
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

    <!-- ======= FUNCIÓN PARA MOSTRAR LA CONTRASEÑA ==== -->
    <script src="functions2.js"></script>

    <title>Análisis Financiero Sector Público - Creación de usuario</title>
</head>
<body>

    <div id = "cabecera">
        <?php require("includesWeb/comun/cabecera.php");?>  
    </div>

    <div id ="contenido"> 
        <form action='procesarinsertarUsuario.php' method='POST'>
            <h2 class="form-name">Nuevo Usuario</h2>
            <fieldset>
                <p>Nombre * </p><input type='text' name='username' required> <br><br>
                <p>Email * </p><input type='email' name='email' required> <br><br>
                <p>Contraseña * </p><input type='password' name='password' id='password' required>
                <button type="button" onclick=showPassword()>Mostrar contraseña</button><br><br>                     
                <p>Rol del usuario * </p>
                <select name="rol">
                    <option value="admin">Administrador</option>
                    <option value="gestor" selected>Gestor</option>
                </select>
                <br><br>
                <button type="submit" class="form-button">Crear usuario</button>
            </fieldset>
        </form>
        <p><b>AVISO</b>: se recomienda encarecidamente al usuario recién creado cambiar la contraseña</p>
    </div>

    <div id = "pie">
        <?php require("includesWeb/comun/pie.php");?>
    </div>

</body>
</html>