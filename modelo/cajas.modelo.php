
<?php
/**
 *  Desarrollador: ifixitmor
 *  Fecha de creación: 10/01/2021 19:49
 *  Desarrollado por: Softmor
 *  Software de Morelos SA.DE.CV 
 *  Sitio web: https://softmor.com
 *  Facebook:  https://www.facebook.com/softmor/
 *  Instagram: http://instagram.com/softmormx
 *  Twitter: https://twitter.com/softmormx
 */
require_once 'conexion.php';

class CajasModelo
{
    public static function mdlAgregarCajas($cja)
    {
        try {
            //code...
            $sql = "INSERT INTO tbl_caja_cja (cja_nombre,cja_id_sucursal,cja_usuario_registro,cja_fecha_registro,cja_uso) VALUES(?,?,?,?,?)";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $cja['cja_nombre']);
            $pps->bindValue(2, $cja['cja_id_sucursal']);
            $pps->bindValue(3, $cja['cja_usuario_registro']);
            $pps->bindValue(4, $cja['cja_fecha_registro']);
            $pps->bindValue(5, $cja['cja_uso']);
            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }
    public static function mdlActualizarCajas()
    {
        try {
            //code...
            $sql = "";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);

            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }
    public static function mdlMostrarCajasDisponibles($cja_uso = 0)
    {
        try {
            //code...


            $sql = "SELECT * FROM tbl_caja_cja WHERE  cja_uso = ?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $cja_uso);
            $pps->execute();
            return $pps->fetchAll();
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlMostrarCajas()
    {
        try {
            //code...


            $sql = "SELECT * FROM tbl_caja_cja WHERE cja_id_sucursal = ? ";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $_SESSION['session_suc']['scl_id']);
            $pps->execute();
            return $pps->fetchAll();
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }


    public static function mdlMostrarCajasById($copn_id = "")
    {
        try {
            //code...
            if ($copn_id != "") {

                $sql = "SELECT copn.*,usr.*,cja.* FROM tbl_caja_open_copn copn  JOIN  tbl_usuarios usr ON usr.id = copn.copn_usuario_abrio JOIN tbl_caja_cja cja ON cja.cja_id_caja = copn.copn_id_caja    WHERE copn.copn_id = ? ";
                $con = Conexion::conectar();
                $pps = $con->prepare($sql);
                $pps->bindValue(1, $copn_id);
                $pps->execute();
                return $pps->fetch();
            } elseif ($copn_id == "") {
                $sql = "SELECT copn.*,usr.*,cja.* FROM tbl_caja_open_copn copn  JOIN  tbl_usuarios usr ON usr.id = copn.copn_usuario_abrio JOIN tbl_caja_cja cja ON cja.cja_id_caja = copn.copn_id_caja    ORDER BY copn_id DESC ";
                $con = Conexion::conectar();
                $pps = $con->prepare($sql);
                $pps->execute();
                return $pps->fetchAll();
            }
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }
    public static function mdlEliminarCajas()
    {
        try {
            //code...
            $sql = "";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);

            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlAbrirCaja($copn)
    {
        try {
            //code...
            $sql = "INSERT INTO tbl_caja_open_copn  (copn_ingreso_inicio,copn_usuario_abrio,copn_fecha_abrio,copn_id_caja) VALUES (?,?,?,?)";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $copn['copn_ingreso_inicio']);
            $pps->bindValue(2, $copn['copn_usuario_abrio']);
            $pps->bindValue(3, $copn['copn_fecha_abrio']);
            $pps->bindValue(4, $copn['copn_id_caja']);
            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (PDOException $th) {
            return false;
        } finally {
            $pps = null;
            $con = null;
        }
    }
    public static function mdlConsultarUltimaCajaAbierta($copn)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_caja_open_copn WHERE copn_usuario_abrio = ? AND copn_id_caja = ? ORDER BY copn_id DESC LIMIT 1 ";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);

            $pps->bindValue(1, $copn['copn_usuario_abrio']);
            $pps->bindValue(2, $copn['copn_id_caja']);

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
    public static function mdlActualizarDisponibilidadCaja($cja_uso, $cja_id_caja, $cja_copn_id)
    {
        try {
            //code...
            $sql = "UPDATE tbl_caja_cja SET cja_uso = ?, cja_copn_id = ? WHERE cja_id_caja = ? ";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $cja_uso);
            $pps->bindValue(2, $cja_copn_id);
            $pps->bindValue(3, $cja_id_caja);
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

    public static function mdlCerrarCaja($copn)
    {
        try {
            //code...
            $sql = "UPDATE tbl_caja_open_copn SET copn_usuario_cerro = ?, copn_ingreso_efectivo = ?, 
            copn_ingreso_banco = ?, copn_efectivo_real = ?, copn_banco_real = ?, copn_fecha_cierre = ? WHERE copn_id = ? ";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $copn['copn_usuario_cerro']);
            $pps->bindValue(2, $copn['copn_ingreso_efectivo']);
            $pps->bindValue(3, $copn['copn_ingreso_banco']);
            $pps->bindValue(4, $copn['copn_efectivo_real']);
            $pps->bindValue(5, $copn['copn_banco_real']);
            $pps->bindValue(6, $copn['copn_fecha_cierre']);
            $pps->bindValue(7, $copn['copn_id']);
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


    public static function mdlReporteVentasByMPCorte($venta_mp, $estado_corte)
    {
        try {
            $sql = "SELECT SUM(total) AS venta_total FROM tbl_ventas WHERE venta_mp = ? AND estado_corte = ?
            ";
            $con = conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $venta_mp);
            $pps->bindValue(2, $estado_corte);
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

    public static function mdlReportePagosByMPCorte($pmbs_mp, $pmbs_corte)
    {
        try {
            if ($pmbs_mp == "") {
                $sql = "SELECT SUM(pmbs_monto) AS pagos_total FROM tbl_pagos_pmbs WHERE pmbs_mp != 'EFECTIVO' AND pmbs_corte = ?
                ";
                $con = conexion::conectar();
                $pps = $con->prepare($sql);
                $pps->bindValue(1, $pmbs_corte);
                $pps->execute();
                return $pps->fetch();
            } else {
                $sql = "SELECT SUM(pmbs_monto) AS pagos_total FROM tbl_pagos_pmbs WHERE pmbs_mp = ? AND pmbs_corte = ?
                ";
                $con = conexion::conectar();
                $pps = $con->prepare($sql);
                $pps->bindValue(1, $pmbs_mp);
                $pps->bindValue(2, $pmbs_corte);
                $pps->execute();
                return $pps->fetch();
            }
        } catch (PDOException $th) {
            //throw $th;
            return false;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlVentasFiltro($datos)
    {

        if ($datos['vts_mp'] == "") {
            $sql = "SELECT vts.*,usr.nombre FROM tbl_ventas vts JOIN tbl_usuarios usr ON usr.id = vts.id_vendedor WHERE vts.fecha BETWEEN ? AND ? AND vts.id_vendedor LIKE '%" . $datos['vts_vendedor'] . "%'";
            $con = conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $datos['vts_fecha_inicio']);
            $pps->bindValue(2, $datos['vts_fecha_fin']);
            $pps->execute();
            return $pps->fetchAll();
        } elseif ($datos['vts_mp'] == "EFECTIVO") {
            $sql = "SELECT vts.*,usr.nombre FROM tbl_ventas vts JOIN tbl_usuarios usr ON usr.id = vts.id_vendedor WHERE vts.fecha BETWEEN ? AND ? AND venta_mp = 'EFECTIVO' AND vts.id_vendedor LIKE '%" . $datos['vts_vendedor'] . "%' ";
            $con = conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $datos['vts_fecha_inicio']);
            $pps->bindValue(2, $datos['vts_fecha_fin']);
            $pps->execute();
            return $pps->fetchAll();
        } elseif ($datos['vts_mp'] != "EFECTIVO") {
            $sql = "SELECT vts.*,usr.nombre FROM tbl_ventas vts JOIN tbl_usuarios usr ON usr.id = vts.id_vendedor WHERE vts.fecha BETWEEN ? AND ? AND venta_mp != 'EFECTIVO' AND vts.id_vendedor LIKE '%" . $datos['vts_vendedor'] . "%' ";
            $con = conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $datos['vts_fecha_inicio']);
            $pps->bindValue(2, $datos['vts_fecha_fin']);
            $pps->execute();
            return $pps->fetchAll();
        }
    }

    public static function mdlPagosFiltro($datos)
    {

        if ($datos['pmbs_mp'] == "") {
            $sql = "SELECT pgs.*,usr.nombre FROM tbl_pagos_pmbs pgs JOIN tbl_usuarios usr ON usr.id = pgs.id_vendedor WHERE pgs.pmbs_fecha_pago BETWEEN ? AND ? AND pgs.id_vendedor LIKE '%" . $datos['pmbs_vendedor'] . "%' ORDER BY pgs.pmbs_id DESC  ";
            $con = conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $datos['pmbs_fecha_inicio']);
            $pps->bindValue(2, $datos['pmbs_fecha_fin']);
            $pps->execute();
            return $pps->fetchAll();
        } elseif ($datos['pmbs_mp'] == "EFECTIVO") {
            $sql = "SELECT pgs.*,usr.nombre FROM tbl_pagos_pmbs pgs JOIN tbl_usuarios usr ON usr.id = pgs.id_vendedor WHERE pgs.pmbs_fecha_pago BETWEEN ? AND ? AND pmbs_mp = 'EFECTIVO' AND pgs.id_vendedor LIKE '%" . $datos['pmbs_vendedor'] . "%' ORDER BY pgs.pmbs_id DESC ";
            $con = conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $datos['pmbs_fecha_inicio']);
            $pps->bindValue(2, $datos['pmbs_fecha_fin']);
            $pps->execute();
            return $pps->fetchAll();
        } elseif ($datos['pmbs_mp'] != "EFECTIVO") {
            $sql = "SELECT pgs.*,usr.nombre FROM tbl_pagos_pmbs pgs JOIN tbl_usuarios usr ON usr.id = pgs.id_vendedor WHERE pgs.pmbs_fecha_pago BETWEEN ? AND ? AND pmbs_mp != 'EFECTIVO' AND pgs.id_vendedor LIKE '%" . $datos['pmbs_vendedor'] . "%' ORDER BY pgs.pmbs_id DESC ";
            $con = conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $datos['pmbs_fecha_inicio']);
            $pps->bindValue(2, $datos['pmbs_fecha_fin']);
            $pps->execute();
            return $pps->fetchAll();
        }
    }

    public static function mdlConsultarPagosTiket($pmbs_id)
    {
        try {
            //code...
            if ($pmbs_id == "") {
                $sql = "SELECT pmbs.*,cts.*,usr.* FROM tbl_pagos_pmbs pmbs  JOIN tbl_usuarios usr ON  usr.id = pmbs.id_vendedor JOIN tbl_clientes cts ON cts.id_cliente = pmbs.id_cliente  ORDER BY pmbs.pmbs_id DESC LIMIT 1";

                $con = Conexion::conectar();
                $pps = $con->prepare($sql);
                $pps->execute();
                return $pps->fetch();
            } elseif ($pmbs_id != null) {
                $sql = "SELECT pmbs.*,cts.*,usr.* FROM tbl_pagos_pmbs pmbs  JOIN tbl_usuarios usr ON  usr.id = pmbs.id_vendedor JOIN tbl_clientes cts ON cts.id_cliente = pmbs.id_cliente  WHERE pmbs.pmbs_id = ? ";

                $con = Conexion::conectar();
                $pps = $con->prepare($sql);
                $pps->bindValue(1, $pmbs_id);
                $pps->execute();
                return $pps->fetch();
            }
        } catch (PDOException $th) {
            throw $th;
        }
    }

    //SELECT pmbs.*,rmbs.*,cts.*,mbs.* FROM tbl_pagos_pmbs pmbs JOIN tbl_registro_membresias_rmbs rmbs ON rmbs.rmbs_id = pmbs.pmbs_rmbs JOIN tbl_clientes cts ON cts.id_cliente = rmbs.cliente_id JOIN tbl_membresias_mbs mbs ON mbs.mbs_id = rmbs.mbs_id
    //SELECT vts.*,usr.nombre FROM tbl_ventas vts JOIN tbl_usuarios usr ON usr.id = vts.id_vendedor WHERE vts.fecha BETWEEN '' AND '';
}
