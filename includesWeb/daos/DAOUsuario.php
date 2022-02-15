<?php
require('includesWeb/usuario.php');
require('includesWeb/config.php');
//Clase encargada de actualizar la información del objeto Usuario en la BBDD
class DAOUsuario {

    //get usuario para el proceso de login
    public function getUsuario($emailS,$password) {
        $db = getConexionBD();
        $verificado=false;
        $sql = "SELECT nombre, correo, contrasenia, rol  FROM usuarios WHERE correo = '$emailS'";
        $rs = mysqli_query($db,$sql);
        if($rs){
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $hashed_password=$fila['contrasenia'];
                if (password_verify($password, $hashed_password)) {
                    $p = new Usuario();
                    $p->setnombreusuario($fila['nombre']);
                    $p->setcorreo($fila['correo']);
                    $p->setcontrasenia($password);
                    $p->setrol($fila['rol']);
                    return $p;
                }
            }
            return false;
        }
        else{
            return false;
        }
    }

    //get usuario para una vez registrado, tenemos problemas con la sal
    public function getUsuarioE($emailS) {
        $db = getConexionBD();
        $p = new Usuario();
        $sql2 = "SELECT correo, contrasenia, nombre, rol 
                FROM usuarios WHERE correo = '$emailS'";
        $res2 = mysqli_query($db,$sql2);
        $fila = mysqli_fetch_assoc($res2);
        if($fila){
            $p->setnombreusuario($fila['nombre']);
            $p->setcorreo($fila['correo']);
            $p->setcontrasenia($fila['contrasenia']);
            $p->setrol($fila['rol']);
        }
        else{
            $p->setcorreo(NULL);
        }
        return $p;
    }

    public function insertaUsuario($emailS,$contraseniaS,$nombre, $rol){
        //por defecto se inserta como usuario registrado
        $db = getConexionBD();
        $passwordS = password_hash($contraseniaS, PASSWORD_DEFAULT, ['cost'=>12]);
        
        $sql = "INSERT INTO usuarios (correo, contrasenia, nombre, rol) VALUES ('$emailS','$passwordS','$nombre','$rol')";
        
        return mysqli_query($db,$sql);
    }

    public function update($oldmail, $newemailS, $contrasenia,$nombre, $rol){
        //por defecto se iserta como usuario registrado
        $db = getConexionBD();
        
        $hash = password_hash($contrasenia, PASSWORD_DEFAULT, ['cost'=>12]);
        $sql = "UPDATE usuarios SET correo='$newemailS', nombre = '$nombre', contrasenia = '$hash', rol = '$rol' where correo = '$oldmail'";
        return mysqli_query($db,$sql);
    }

    /*public function updateurl($emailS,$url){
        //por defecto se iserta como usuario registrado
        $db = getConexionBD();
        $sql = "UPDATE usuario set urlfoto = '$url' where correo = '$emailS'";
        return mysqli_query($db,$sql);
    }*/

    public function updatecontrasenia($emailS,$passwordS){
        //por defecto se iserta como usuario registrado
        $db = getConexionBD();
        $passwordS = password_hash($passwordS, PASSWORD_DEFAULT, ['cost'=>12]);
        $sql = "UPDATE usuarios set contrasenia='$passwordS' where correo = '$emailS'";
        return mysqli_query($db,$sql);
    }

    /*public function contraseniasCoinciden($contra1, $contra2){
        return $contra1==$contra2;
    }*/

    public function delete($email){
        $db = getConexionBD();
        $query="DELETE FROM usuarios WHERE correo='$email'";
        $res=mysqli_query($db, $query);
        if($res){
            return true;
        }
        return false;
    }

    public function getAllUsuarios($correo){
        $db = getConexionBD();
        $sql = "SELECT * FROM usuarios WHERE correo != '$correo'"; //WHERE correo!='$correo'
        $res = mysqli_query($db,$sql);
        
        if(!$res){
            return false;
        }

        $allUsuarios = array();
        $i = 0;
        
        while($row = mysqli_fetch_assoc($res)) {
            $usuario = new Usuario();
            $usuario->setnombreusuario($row['nombre']);
            $usuario->setcorreo($row['correo']);
            $usuario->setcontrasenia($row['contrasenia']);
            $usuario->setrol($row['rol']);
            $allUsuarios[$i] = $usuario;
            $i += 1;
        }
        return $allUsuarios;
    }
}
?>