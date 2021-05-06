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
}
