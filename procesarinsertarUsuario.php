<?php
session_start();
require_once('includesWeb/daos/DAOUsuario.php');

$email = htmlspecialchars(trim(strip_tags($_REQUEST["email"])));
$password = htmlspecialchars(trim(strip_tags($_REQUEST["password"])));
$nombreusuario = htmlspecialchars(trim(strip_tags($_REQUEST["username"])));
$rol = htmlspecialchars(trim(strip_tags($_REQUEST["rol"])));
$insertado = false;
if(!(new DAOUsuario())->insertaUsuario($email, $password, $nombreusuario, $rol)){
    $_SESSION['mensaje']='Error. El usuario no se ha creado';
}
else {
    $_SESSION['mensaje']='Usuario creado correctamente';
}
header('Location:perfil');
exit();
?>