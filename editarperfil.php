<?php
    session_start();
    require('includesWeb/daos/DAOUsuario.php');

    if(isset($_SESSION['email'])){
        $usuario = (new DAOUsuario())->getUsuario($_SESSION['email'], $_SESSION['password']);
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
    <script src="functions2.js"></script>

    <script src="node_modules/chart.js/dist/chart.js"></script>
	<title>Análisis Financiero Sector Público - Editar perfil</title>
</head>

<body>
<div id="contenedor">

	<div id="cabecera">
		<?php
			require('includesWeb/comun/cabecera.php');
		?>
	</div>

	<div id="contenido">
        <form action='procesareditarperfil.php' method='POST'>
            <h2>Editar perfil</h2>
            <fieldset>
                <p>Nombre * </p><input type='text' name='nombreusuario' value="<?php echo $usuario->getnombreusuario()?>" required> <br><br>
                <p>Email * </p><input type='email' name='correo' value="<?php echo $usuario->getcorreo()?>" required> <br><br>     
                <p>Contraseña * </p><input type='password' name='password' id='password' value="<?php echo $_SESSION['password']?>" required>
                <button type="button" onclick=showPassword()>Mostrar contraseña</button>  
                <?php
                if($usuario->getRol()=='Administrador'){
                ?>
                    <p>Rol *</p>
                    <select name='rol'>
                        <option value="admin" <?php if ($usuario->getRol()=='Administrador') echo 'selected'; else echo '';?>>Administrador</option>
                        <option value="gestor" <?php if ($usuario->getRol()=='Gestor') echo 'selected'; else echo '';?>>Gestor</option>
                    </select>
                <?php
                }
                ?>
                </br><br>
                <button type='submit' class='form-button' id='submit'>Guardar cambios</button>
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