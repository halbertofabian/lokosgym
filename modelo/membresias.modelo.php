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

    public static function mdlMostrarUltimaMembresiaCliente()
    {

        $sqlSelect = "SELECT rmbs.*,mbs.* FROM tbl_registro_membresias_rmbs rmbs JOIN tbl_membresias_mbs mbs ON rmbs.mbs_id =  mbs.mbs_id ORDER BY rmbs.rmbs_id DESC LIMIT 1";
        $stmt = Conexion::conectar()->prepare($sqlSelect);
        $stmt->execute();
        return $stmt->fetch();
        $stmt = null;
    }

    public static function mdlMostrarMembresiaCliente($rmbs_id)
    {

        $sqlSelect = "SELECT rmbs.*,mbs.* FROM tbl_registro_membresias_rmbs rmbs JOIN tbl_membresias_mbs mbs ON rmbs.mbs_id =  mbs.mbs_id  WHERE rmbs_id  =? ";
        $stmt = Conexion::conectar()->prepare($sqlSelect);
        $stmt->bindValue(1, $rmbs_id);
        $stmt->execute();
        return $stmt->fetch();
        $stmt = null;
    }


    public static function mdlMostrarTodasMembresiaCliente()
    {

        $sqlSelect = "SELECT rmbs.*,mbs.*,cts.* FROM tbl_registro_membresias_rmbs rmbs JOIN tbl_membresias_mbs mbs ON rmbs.mbs_id =  mbs.mbs_id JOIN tbl_clientes cts ON rmbs.cliente_id = cts.id_cliente ";
        $stmt = Conexion::conectar()->prepare($sqlSelect);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt = null;
    }

    //

    public static function mdlMostrarMembresiaID($mbs_id)
    {

        $sqlSelect = "SELECT * FROM tbl_membresias_mbs WHERE mbs_id = ?";
        $stmt = Conexion::conectar()->prepare($sqlSelect);
        $stmt->bindValue(1, $mbs_id);
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

    public static function mdlRegistrarMembresiaCliente($mbs)
    {
        try {
            //code...
            $sql = "INSERT INTO tbl_registro_membresias_rmbs  (cliente_id,rmbs_fecha_inicio,rmbs_fecha_termino,mbs_id,rmbs_costo_renovacion) VALUES (?,?,?,?,?)";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $mbs['cliente_id']);
            $pps->bindValue(2, $mbs['rmbs_fecha_inicio']);
            $pps->bindValue(3, $mbs['rmbs_fecha_termino']);
            $pps->bindValue(4, $mbs['mbs_id']);
            $pps->bindValue(5, $mbs['rmbs_costo_renovacion']);

            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (PDOException $th) {
            throw $th;
            return false;
        } finally {
            $pps = null;
            $con = null;
        }
    }


    public static function mdlActualizarMembresiaCliente($rmbs_fecha_termino,$rmbs_id)
    {
        try {
            //code...
            $sql = "UPDATE   tbl_registro_membresias_rmbs SET rmbs_fecha_termino = ? WHERE rmbs_id = ?  ";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $rmbs_fecha_termino);

            $pps->bindValue(2, $rmbs_id);

            $pps->execute();
            return $pps->rowCount()>0;
        } catch (PDOException $th) {
            throw $th;
            return false;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlRegistrarMembresiaPago($pmbs)
    {
        try {
            //code...
            $sql = "INSERT INTO tbl_pagos_pmbs  (pmbs_rmbs,pmbs_fecha_pago,pmbs_mp,pmbs_monto,pmbs_ref,pmbs_corte,id_vendedor) VALUES (?,?,?,?,?,?,?)";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $pmbs['pmbs_rmbs']);
            $pps->bindValue(2, $pmbs['pmbs_fecha_pago']);
            $pps->bindValue(3, $pmbs['pmbs_mp']);
            $pps->bindValue(4, $pmbs['pmbs_monto']);
            $pps->bindValue(5, $pmbs['pmbs_ref']);
            $pps->bindValue(6, $pmbs['pmbs_corte']);
            $pps->bindValue(7, $pmbs['id_vendedor']);

            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (PDOException $th) {
            throw $th;
            return false;
        } finally {
            $pps = null;
            $con = null;
        }
    }

   
}
