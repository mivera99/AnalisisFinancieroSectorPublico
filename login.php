<?php
    require_once('includesWeb/daos/DAOUsuario.php');
    session_start();
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

    <!-- ====== FUNCIÓN PARA MOSTRAR LA CONTRASEÑA SI PULSAMOS UN BOTÓN ==== -->
    <script src="functions2.js"></script>
    <title>Análisis Financiero Sector Público - Iniciar sesión</title>
</head>
<body>
<div id="contenedor">

<div id="cabecera">
    <?php
        require('includesWeb/comun/cabecera.php');
    ?>
</div>
<div id="contenido">
    <?php
    //(new DAOUsuario())->insertaUsuario("admin@hotmail.com", "admin4444", "admin", "admin");
    ?>
    <form action='procesarLogin.php' method='POST'>
        <h2 class="form-name">Login</h2>
        <fieldset>
            <p>Email * </p><input type='email' name='email' required> <br><br>
            <p>Contraseña * </p><input type='password' name='password' id='password' required>
            <button type="button" onclick=showPassword()>Mostrar contraseña</button>  
            <br> 
            <br><br><br>
            <button type="submit" class="form-button">Enviar</button>
        </fieldset>
    </form>
</div>
<div id="pie">
    <?php
        require('includesWeb/comun/pie.php');
    ?>
</div>
</body>
</html>
