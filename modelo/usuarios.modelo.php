
<?php
require_once 'conexion.php';
class UsuariosModelo
{

    public static function mdlAgregarUsuarios($datos)
    {
        $sqlInsert = "INSERT INTO tbl_usuarios (usuario,correo,
            clave,nombre,apellido,domicilio,telefono,usr_perfil) VALUES(:usuario,:correo,
            :clave,:nombre,:apellido,:domicilio,:telefono,:usr_perfil)";

        $stmt = Conexion::conectar()->prepare($sqlInsert);

        $stmt->bindParam(':usuario', $datos['usuario']);
        $stmt->bindParam(':correo', $datos['correo']);
        $stmt->bindParam(':clave', $datos['clave']);
        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':apellido', $datos['apellido']);
        $stmt->bindParam(':domicilio', $datos['domicilio']);
        $stmt->bindParam(':telefono', $datos['telefono']);
        $stmt->bindParam(':usr_perfil', $datos['usr_perfil']);

        return $stmt->execute();

        $stmt = null;
    }
    public static function mdlActualizarUsuarios($datos)
    {


        $sqlUpdate = "UPDATE   tbl_usuarios SET usuario = :usuario ,
            correo = :correo , clave  = :clave, nombre = :nombre ,
            apellido = :apellido , domicilio = :domicilio , telefono = :telefono, 
            usr_perfil = :usr_perfil 
            WHERE id = :id ";

        $stmt = Conexion::conectar()->prepare($sqlUpdate);

        $stmt->bindParam(':usuario', $datos['usuario']);
        $stmt->bindParam(':correo', $datos['correo']);
        $stmt->bindParam(':clave', $datos['clave']);
        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':apellido', $datos['apellido']);
        $stmt->bindParam(':domicilio', $datos['domicilio']);
        $stmt->bindParam(':telefono', $datos['telefono']);
        $stmt->bindParam(':usr_perfil', $datos['usr_perfil']);
        $stmt->bindParam(':id', $datos['id']);

        return $stmt->execute();

        $stmt = null;
    }

    public static function mdlMostrarUsuarios($usuario)
    {
        if ($usuario != null) {

            $sqlSelect = "SELECT * FROM tbl_usuarios   WHERE id = :id";
            $stmt = Conexion::conectar()->prepare($sqlSelect);
            $stmt->bindParam(":id", $usuario);

            $stmt->execute();
            return $stmt->fetch();
        } else {

            $sqlSelect = "SELECT * FROM tbl_usuarios ";
            $stmt = Conexion::conectar()->prepare($sqlSelect);

            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

    public static function mdlIniciarSesion($datos)
    {
        $sqlSesion = "SELECT   * FROM tbl_usuarios  WHERE 
        (usuario = :usuario OR correo = :correo OR telefono = :telefono)
         AND clave = :clave ";

        $stmt = Conexion::conectar()->prepare($sqlSesion);

        $stmt->bindParam(':usuario', $datos['value']);
        $stmt->bindParam(':correo', $datos['value']);
        $stmt->bindParam(':telefono', $datos['value']);
        $stmt->bindParam(':clave', $datos['pass']);

        $stmt->execute();
        return $stmt->fetch();

        $stmt = null;
    }

    public static function mdlActualizarCajaUsuario($usr_id, $usr_caja)
    {
        try {
            //code...
            $sql = "UPDATE tbl_usuarios SET usr_caja = ? WHERE id = ? ";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $usr_caja);
            $pps->bindValue(2, $usr_id);
            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (PDOException $th) {
            //throw $th;
            return false;
        } finally {
            $pps = null;
            $con = null;
        }
    }
}
