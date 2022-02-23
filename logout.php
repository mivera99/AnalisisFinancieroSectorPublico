<?php
    session_start();
    session_unset();
    session_destroy();
    if(!isset($_SESSION['login'])){
        $_SESSION['mensaje'] = 'Se ha cerrado la sesión';
    }
    else {
        $_SESSION['mensaje'] = 'Error al cerrar sesión';
    }
    header('Location:index');
?>