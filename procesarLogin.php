<?php
    session_start();
    require('includesWeb/daos/DAOUsuario.php');
    $email = htmlspecialchars(trim(strip_tags($_REQUEST["email"])));
    $password = htmlspecialchars(trim(strip_tags($_REQUEST["password"])));
    
    $usuario = (new DAOUsuario())->getUsuario($email, $password);
    if($usuario){
        $_SESSION['login'] = true;
        $_SESSION['email'] = $usuario->getcorreo();
        $_SESSION['password'] = $usuario->getcontrasenia();
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

	<title>Proceso Login</title>
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
            if (!isset($_SESSION["login"])) { //Usuario incorrecto
        ?>
                <h1>ERROR</h1>
                <p>El usuario o contraseña no son válidos.</p>
        <?php
            }
            else { //Usuario registrado
                echo '<h1>Bienvenido</h1>';
            }
        ?>
    </div>
	<div id="pie">
		<?php
			require('includesWeb/comun/pie.php');
		?>
	</div>

</body>
</html>