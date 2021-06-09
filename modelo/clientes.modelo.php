<?php
require_once 'conexion.php';
class ClientesModelo
{
    public static function mdlCrearCliente($cliente)
    {
        $sqlInsert = "INSERT INTO tbl_clientes (id_cliente,nombre_cliente,correo_cliente,telefono_cliente,wsp_cliente,direccion_cliente,credito_cliente,porcentaje_cliente)
            VALUES (NULL,:nombre,:correo,:telefono,:wsp,:direccion,
            :credito,:porcentaje)";

        $pps = Conexion::conectar()->prepare($sqlInsert);

        $pps->bindParam(":nombre", $cliente['nombre']);
        $pps->bindParam(":correo", $cliente['correo']);
        $pps->bindParam(":telefono", $cliente['telefono']);
        $pps->bindParam(":wsp", $cliente['wsp']);
        $pps->bindParam(":direccion", $cliente['direccion']);
        $pps->bindParam(":credito", $cliente['credito']);
        $pps->bindParam(":porcentaje", $cliente['porcentaje']);

        $pps->execute();

        return $pps->rowCount() > 0;

        $pps = null;
    }

    public static function mdlCrearClienteImport($cliente)
    {
        $sqlInsert = "INSERT INTO tbl_clientes (id_cliente,nombre_cliente,telefono_cliente,observaciones,estado,vigencia,tipo)
            VALUES (?,?,?,?,?,?,?) ";

        $pps = Conexion::conectar()->prepare($sqlInsert);

        $pps->bindValue(1, $cliente['id_cliente']);
        $pps->bindValue(2, $cliente['nombre_cliente']);
        $pps->bindValue(3, $cliente['telefono_cliente']);
        $pps->bindValue(4, $cliente['observaciones']);
        $pps->bindValue(5, $cliente['estado']);
        $pps->bindValue(6, $cliente['vigencia']);
        $pps->bindValue(7, $cliente['tipo']);

        $pps->execute();
        return $pps->rowCount() > 0;

        $pps = null;
    }

    public static function mdlActualizarClienteImport($cliente)
    {
        $sqlInsert = "UPDATE tbl_clientes SET nombre_cliente = ?,telefono_cliente = ?,observaciones = ?,estado = ?,vigencia = ? ,tipo = ? WHERE id_cliente = ?";

        $pps = Conexion::conectar()->prepare($sqlInsert);

        $pps->bindValue(1, $cliente['nombre_cliente']);
        $pps->bindValue(2, $cliente['telefono_cliente']);
        $pps->bindValue(3, $cliente['observaciones']);
        $pps->bindValue(4, $cliente['estado']);
        $pps->bindValue(5, $cliente['vigencia']);
        $pps->bindValue(6, $cliente['tipo']);
        $pps->bindValue(7, $cliente['id_cliente']);


        $pps->execute();
        return $pps->rowCount() > 0;

        $pps = null;
    }

    public static function mdlMostrarCliente($cliente)
    {

        if ($cliente != null) {
            $sqlSelect = "SELECT * FROM tbl_clientes WHERE id_cliente = :id";
            $pps = Conexion::conectar()->prepare($sqlSelect);
            $pps->bindParam(":id", $cliente);

            $pps->execute();
            return $pps->fetch();
        } else {

            $sqlSelect = "SELECT * FROM tbl_clientes";
            $pps = Conexion::conectar()->prepare($sqlSelect);

            $pps->execute();
            return $pps->fetchAll();
        }

        $pps = null;
    }

    public static function mdlMostrarAsistencias($ast_socio)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_asistencia_ast WHERE ast_socio = ? ORDER BY ast_id DESC ";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $ast_socio);
            $pps->execute();
            return $pps->fetchAll();
        } catch (PDOException $th) {
            //throw $th;
            return false;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlRegistrarAsistencia($datos)
    {
        try {
            //code...
            $sql = "INSERT  INTO tbl_asistencia_ast (ast_socio,ast_fecha_inicio) VALUES(?,?)";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $datos['ast_socio']);
            $pps->bindValue(2, $datos['ast_fecha_inicio']);
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

    public static function MostrarinfoById($dts)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_clientes WHERE id_cliente =?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $dts['id_cliente']);
            $pps->execute();
            return $pps->fetch();
        } catch (PDOException $th) {
            //throw $th;
            return false;
        } finally {
            $pps = null;
            $con = null;
        }
    }
    public static function MostrarinfoById2($id)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_clientes WHERE id_cliente =?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $id);
            $pps->execute();
            return $pps->fetch();
        } catch (PDOException $th) {
            //throw $th;
            return false;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlActualizarCliente($cliente)
    {
        $sqlInsert = "UPDATE tbl_clientes SET nombre_cliente = ?,correo_cliente=?,telefono_cliente = ?,
        observaciones = ?,vigencia = ? ,tipo = ?, fecha_registro=? WHERE id_cliente = ?";

        $pps = Conexion::conectar()->prepare($sqlInsert);
        $pps->bindValue(1, $cliente['nombre_cliente']);
        $pps->bindValue(2, $cliente['correo_cliente']);
        $pps->bindValue(3, $cliente['telefono_cliente']);
        $pps->bindValue(4, $cliente['observaciones']);
        $pps->bindValue(5, $cliente['vigencia']);
        $pps->bindValue(6, $cliente['tipo']);
        $pps->bindValue(7, $cliente['fecha_registro']);
        $pps->bindValue(8, $cliente['id_cliente']);

        $pps->execute();
        return $pps->rowCount() > 0;

        $pps = null;
    }

    public static function eliminarClienteById($cliente)
    {
        $sql= "DELETE FROM tbl_clientes WHERE id_cliente = ?";
        $pps = Conexion::conectar()->prepare($sql);
        $pps->bindValue(1, $cliente['id_cliente']);

        $pps->execute();
        return $pps->rowCount() > 0;

        $pps = null;
    }
}
