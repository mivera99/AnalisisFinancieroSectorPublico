<?php
require('includesWeb/usuario.php');
require('includesWeb/config.php');

/*Clase encargada de actualizar la información del objeto Usuario en la BBDD*/
class DAOUsuario {

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
                    $rol='No definido';
                    if($fila['rol']=='admin'){
                        $rol = 'Administrador';
                    }
                    else if($fila['rol']=='gestor'){
                        $rol = 'Gestor';
                    }
                    $p->setrol($rol);
                    return $p;
                }
            }
            return false;
        }
        else{
            return false;
        }
    }

    public function insertaUsuario($emailS,$contraseniaS,$nombre, $rol){
        //por defecto se inserta como usuario registrado
        $db = getConexionBD();
        $passwordS = password_hash($contraseniaS, PASSWORD_DEFAULT, ['cost'=>12]);
        
        $sql = "INSERT INTO usuarios (correo, contrasenia, nombre, rol) VALUES ('$emailS','$passwordS','$nombre','$rol')";
        
        return mysqli_query($db,$sql);
    }

    public function update($oldmail, $newemailS, $contrasenia,$nombre, $rol){
        $db = getConexionBD();
        
        $hash = password_hash($contrasenia, PASSWORD_DEFAULT, ['cost'=>12]);
        if($rol==NULL)
            $sql = "UPDATE usuarios SET correo='$newemailS', nombre = '$nombre', contrasenia = '$hash' WHERE correo = '$oldmail'";
        else
            $sql = "UPDATE usuarios SET correo='$newemailS', nombre = '$nombre', contrasenia = '$hash', rol = '$rol' WHERE correo = '$oldmail'";
        
        $res = mysqli_query($db,$sql);
        if($res){
            return true;
        }
        else{
            echo mysqli_error($db);
        }
        return false;
    }

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