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
        $_SESSION['mensaje'] = 'Bienvenido, '. $usuario->getnombreusuario();
    }
    else
        $_SESSION['mensaje']='Error en el inicio de sesión';
    
    header('Location:index');
    exit();
?>