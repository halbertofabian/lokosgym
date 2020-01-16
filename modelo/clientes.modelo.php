<?php
require_once 'conexion.php';
class ClientesModelo
{
    public static function mdlCrearCliente($cliente)
    {
        $sqlInsert = "INSERT INTO tbl_clientes 
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

        return $pps->execute();

        $pps = null;
    }

    public static function mdlMostrarCliente($cliente){
        
        if($cliente != null){
            $sqlSelect = "SELECT * FROM tbl_clientes WHERE id_cliente = :id";
            $pps = Conexion::conectar()->prepare($sqlSelect);
            $pps-> bindParam(":id",$cliente);
            
            $pps -> execute();
            return $pps->fetch();



        }else{

            $sqlSelect = "SELECT * FROM tbl_clientes";
            $pps = Conexion::conectar()->prepare($sqlSelect);

            $pps -> execute();
            return $pps->fetchAll();



        }

        $pps = null;
    }
}
