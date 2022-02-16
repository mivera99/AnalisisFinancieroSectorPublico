<?php
    require_once('includesWeb/daos/DAOUsuario.php');
    session_start();

    $nombre = htmlspecialchars(trim(strip_tags($_REQUEST['nombreusuario'])));
    $correo = htmlspecialchars(trim(strip_tags($_REQUEST['correo'])));
    $password = htmlspecialchars(trim(strip_tags($_REQUEST['password'])));
    if(isset($_REQUEST['rol'])){
        $rol = htmlspecialchars(trim(strip_tags($_REQUEST['rol'])));;
    }
    else {
        $rol = NULL;
    }

    if((new DAOUsuario())->update($_SESSION['email'], $correo, $password, $nombre, $rol)){
        $_SESSION['email']=$correo;
        $_SESSION['password']=$password;
    }

    header('Location:perfil.php');
?>