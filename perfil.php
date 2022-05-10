<?php
    session_start();
    require('includesWeb/daos/DAOUsuario.php');

    $show_message = null;

    if(isset($_SESSION['email'])){
        $usuario = (new DAOUsuario())->getUsuario($_SESSION['email'], $_SESSION['password']);
    }

    if (isset($_SESSION['mensaje'])) {
        $show_message = $_SESSION['mensaje'];
        $_SESSION['mensaje'] = null;
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
	<title>Análisis Financiero Sector Público - Perfil</title>
</head>

<body>
<div id="contenedor">

    <div id = "cabeceraIni">
        <?php require("includesWeb/comun/cabecera.php");?>  
    </div>

    <div id="menu-superior">
        <div id ="contenidoIni">     
        <?php require("includesWeb/comun/buscador.php");?>  
        </div>
    </div>

	<div id="contenido">
        <h2>Tu perfil</h2>
        <p>Nombre: <b><?php echo $usuario->getnombreusuario();?></b></p> 
        <p>Email: <b><?php echo $usuario->getcorreo();?></b></p> 
        <p>Contraseña: <b><?php echo $_SESSION['password'];?></b></p> 
        <p>Rol: <b><?php echo $usuario->getRol();?></b></p> 
        <br><br>
        <a href="editarperfil.php"><button>Editar perfil</button></a>
        <!--<a href="editarcontrasenia.php"><button>Cambiar contraseña</button></a>-->
        <a href="logout.php"><button>Cerrar sesión</button></a><br><br>
        <?php
            if($usuario->getrol()=='Administrador' || $usuario->getrol()=='Gestor'){
        ?>      
                <h2>Panel de control</h2><br>   
                
                <form action='procesarSubida.php' method='POST' enctype="multipart/form-data" onsubmit="return confirm('¿Está seguro de subir este archivo?')">
                    <h2 class="form-name">Subir archivo</h2>
                    <br>
                    <fieldset>
                        <p>Selecciona el archivo: </p><input type='file' name='file_button'> <br><br> 
                        <button>Subir archivo</button>
                    </fieldset>
                </form>
                <br><br>
                
                <?php
                if($usuario->getrol()=='Administrador'){
                ?>
                    <h3>Usuarios</h3>
                    <a href="insertarUsuario.php"><button>Añadir usuarios</button></a><br><br>
                    <a href="eliminarUsuarios.php"><button>Eliminar usuarios</button></a><br><br>
                <?php
                }
            }

            if (isset($show_message)) {
                echo "<script>alert('{$show_message}');</script>";
                $show_message=null;
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