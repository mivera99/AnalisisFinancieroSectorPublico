<?php
session_start();
require_once('includesWeb/daos/DAOUsuario.php');
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

    <title>Análisis Financiero del Sector Público - Eliminación de usuarios</title>
</head>
    <body>

        <div id = "cabecera">
            <?php require("includesWeb/comun/cabecera.php");?>  
        </div>

        <div id ="contenido"> 
            <form action='procesareliminarUsuarios.php' method='POST' onsubmit="return confirm('¿Está seguro de eliminar los usuarios seleccionados?')">
                <h2>Eliminar Usuarios</h2>
                <?php
                $usuarios=(new DAOUsuario())->getAllUsuarios($_SESSION["email"]);
                if(count($usuarios)!=1)
                    echo '<p>'.count($usuarios).' usuarios encontrados</p>';
                else 
                    echo '<p>'.count($usuarios).' usuario encontrado</p>';

                if(count($usuarios)>0){
                ?>
                    <fieldset>
                        <p>Selecciona aquellos usuarios que desea eliminar</p><br>
                        <select name="usuarios[]" multiple size="8">
                        <?php
                            foreach($usuarios as $usuario) {
                                $infoUsuario=$usuario->getnombreusuario()." - Correo.".$usuario->getcorreo();
                                $correo=$usuario->getcorreo();
                                echo"<option value=\"$correo\">$infoUsuario</option>";
                            }
                        ?>
                        </select><br><br>
                    <button type="submit">Eliminar</button>
                    </fieldset>
                <?php
                }
                ?>
            </form>

        </div>

        <div id = "pie">
            <?php require("includesWeb/comun/pie.php");?>
        </div>

    </body>
</html>