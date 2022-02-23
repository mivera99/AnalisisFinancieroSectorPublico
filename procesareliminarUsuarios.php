<?php
session_start();
require_once('includesWeb/daos/DAOUsuario.php');

$usuariosToRemove=$_REQUEST['usuarios'];
$daoUsuario = new DAOUsuario();
$i=0;
foreach($usuariosToRemove as $usuario){
    if($daoUsuario->delete($usuario)){
        $i++;
    }
}
unset($_REQUEST['usuarios']);
$_SESSION['mensaje'] = $i.' usuario(s) eliminado(s) correctamente';
header('Location:perfil');
exit();
?>