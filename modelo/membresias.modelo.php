<?php
require_once 'conexion.php';
class MembresiasModelo
{
    //SELECT * FROM `tbl_clientes` ORDER BY id_cliente DESC LIMIT 1
    public static function mdlMostrarUltimoCliente()
    {

        $sqlSelect = "SELECT * FROM tbl_clientes ORDER BY id_cliente DESC LIMIT 1";
        $stmt = Conexion::conectar()->prepare($sqlSelect);
        $stmt->execute();
        return $stmt->fetch();
        $stmt = null;
    }

    //SELECT * FROM `tbl_membresias_mbs` 
    public static function mdlTiposMembresias()
    {

        $sqlSelect = "SELECT * FROM tbl_membresias_mbs";
        $stmt = Conexion::conectar()->prepare($sqlSelect);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt = null;
    }

}
