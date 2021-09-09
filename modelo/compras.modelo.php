
<?php
/**
 *  Desarrollador: ifixitmor
 *  Fecha de creación: 11/02/2021 21:19
 *  Desarrollado por: Softmor
 *  Software de Morelos SA.DE.CV 
 *  Sitio web: https://softmor.com
 *  Facebook:  https://www.facebook.com/softmor/
 *  Instagram: http://instagram.com/softmormx
 *  Twitter: https://twitter.com/softmormx
 */
require_once 'conexion.php';

class ComprasModelo
{

    public static function  mdlCrearCompra($ventas)
    {
        try {
            //code...
            $sql = "INSERT INTO tbl_compras_cps (cps_folio,cps_proveedor,cps_fecha_compra,cps_fecha_pago,cps_cantidad,cps_tp,cps_mp,cps_estado_pagado,cps_fecha_pagado,cps_usuario_registro,cps_nota) VALUES (?,?,?,?,?,?,?,?,?,?,?) ";

            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $ventas['cps_folio']);
            $pps->bindValue(2, $ventas['cps_proveedor']);
            $pps->bindValue(3, $ventas['cps_fecha_compra']);
            $pps->bindValue(4, $ventas['cps_fecha_pago']);
            $pps->bindValue(5, $ventas['cps_cantidad']);
            $pps->bindValue(6, $ventas['cps_tp']);
            $pps->bindValue(7, $ventas['cps_mp']);
            $pps->bindValue(8, $ventas['cps_estado_pagado']);
            $pps->bindValue(9, $ventas['cps_fecha_pagado']);
            $pps->bindValue(10, $ventas['cps_usuario_registro']);
            $pps->bindValue(11, $ventas['cps_nota']);



            $pps->execute();

            return $pps->rowCount() > 0;
        } catch (PDOException $th) {

            throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlCrearAbonoCompra($abonos)
    {

        try {
            //code...
            $sql = "INSERT INTO tbl_abonos_abs_compras (abs_compra,abs_monto,abs_fecha,abs_usuario_registro,abs_adeudo,abs_mp) VALUES (?,?,?,?,?,?) ";

            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $abonos['abs_compra']);
            $pps->bindValue(2, $abonos['abs_monto']);
            $pps->bindValue(3, $abonos['abs_fecha']);
            $pps->bindValue(4, $abonos['abs_usuario_registro']);
            $pps->bindValue(5, $abonos['abs_adeudo']);
            $pps->bindValue(6, $abonos['abs_mp']);

            $pps->execute();

            return $pps->rowCount() > 0;
        } catch (\PDOException $th) {

            throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }
    public static function mdlConsultarCompra($cps_folio = "")
    {
        try {
            if ($cps_folio == "") {
                $sql = "SELECT cps.*,pvs.pvs_nombre FROM tbl_compras_cps cps JOIN  tbl_proveedores_pvs pvs ON  cps.cps_proveedor = pvs.pvs_id  ORDER BY cps.cps_folio +0 ";
                $con = Conexion::conectar();
                $pps = $con->prepare($sql);
                $pps->execute();
                return $pps->fetchAll();
            } elseif ($cps_folio != "") {
                $sql = "SELECT cps.*,pvs.pvs_nombre,abs.* FROM tbl_compras_cps cps JOIN  tbl_proveedores_pvs pvs ON  cps.cps_proveedor = pvs.pvs_id  JOIN tbl_abonos_abs_compras abs ON abs.abs_compra = cps.cps_folio WHERE cps.cps_folio  = ? ";
                $con = Conexion::conectar();
                $pps = $con->prepare($sql);
                $pps->bindValue(1, $cps_folio);
                $pps->execute();
                return $pps->fetch();
            }
        } catch (\PDOException $th) {
            throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }


    public static function mdlCrearProveedor($proveedor)
    {

        try {
            $sql = "INSERT INTO tbl_proveedores_pvs (pvs_nombre,pvs_telefono) VALUES(?,?)";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $proveedor['pvs_nombre']);
            $pps->bindValue(2, $proveedor['pvs_telefono']);
            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (\PDOException $th) {
            throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlConsultarProveedores($pvs_id = "")
    {
        try {
            if ($pvs_id == "") {
                $sql = "SELECT * FROM tbl_proveedores_pvs ORDER BY pvs_id DESC ";
                $con = Conexion::conectar();
                $pps = $con->prepare($sql);
                $pps->execute();
                return $pps->fetchAll();
            } elseif ($pvs_id != "") {
                $sql = "SELECT * FROM tbl_proveedores_pvs WHERE pvs_id  = ? ";
                $con = Conexion::conectar();
                $pps = $con->prepare($sql);
                $pps->bindValue(1, $pvs_id);
                $pps->execute();
                return $pps->fetch();
            }
        } catch (\PDOException $th) {
            throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlAdeudoCompra($cps_folio)
    {

        try {
            $sql = "SELECT abs.abs_adeudo FROM tbl_abonos_abs_compras abs WHERE abs.abs_compra = ? ORDER BY abs.abs_id DESC LIMIT 1";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $cps_folio);
            $pps->execute();
            return $pps->fetch();
        } catch (\PDOException $th) {
            throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlActualizarCompraAbono($datosA)
    {

        try {
            $sql = "UPDATE tbl_compras_cps SET cps_fecha_pagado = ? , cps_estado_pagado = ? WHERE cps_folio = ? ";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $datosA['cps_fecha_pagado']);
            $pps->bindValue(2, $datosA['cps_estado_pagado']);
            $pps->bindValue(3, $datosA['abs_compra']);
            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (\PDOException $th) {
            throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }
    public static function mdlConsultarGastosPorFecha($cps)
    {
        try {

            if ($cps['cps_proveedor'] == ""  && $cps['cps_fecha_compra_inicio'] == "" && $cps['cps_fecha_compra_fin'] == "") {
                $sql = "SELECT cps.*,pvs.pvs_nombre FROM tbl_compras_cps cps JOIN  tbl_proveedores_pvs pvs ON  cps.cps_proveedor = pvs.pvs_id  WHERE cps_estado_pagado LIKE '%$cps[cps_estado_pagado]%' ORDER BY cps.cps_folio ASC";
            } elseif ($cps['cps_proveedor'] != ""  && $cps['cps_fecha_compra_inicio'] == "" && $cps['cps_fecha_compra_fin'] == "") {
                $sql = "SELECT cps.*,pvs.pvs_nombre FROM tbl_compras_cps cps JOIN  tbl_proveedores_pvs pvs ON  cps.cps_proveedor = pvs.pvs_id  WHERE cps_estado_pagado LIKE '%$cps[cps_estado_pagado]%' AND cps_proveedor = '$cps[cps_proveedor]' ORDER BY cps.cps_folio ASC";
            } elseif ($cps['cps_proveedor'] != ""  && $cps['cps_fecha_compra_inicio'] != "" && $cps['cps_fecha_compra_fin'] != "") {
                $sql = "SELECT cps.*,pvs.pvs_nombre FROM tbl_compras_cps cps JOIN  tbl_proveedores_pvs pvs ON  cps.cps_proveedor = pvs.pvs_id  WHERE cps_estado_pagado LIKE '%$cps[cps_estado_pagado]%' AND cps_proveedor = '$cps[cps_proveedor]' AND cps_fecha_compra BETWEEN '$cps[cps_fecha_compra_inicio]' AND '$cps[cps_fecha_compra_fin]' ORDER BY cps.cps_folio ASC";
            } elseif ($cps['cps_proveedor'] == ""  && $cps['cps_fecha_compra_inicio'] != "" && $cps['cps_fecha_compra_fin'] != "") {
                $sql = "SELECT cps.*,pvs.pvs_nombre FROM tbl_compras_cps cps JOIN  tbl_proveedores_pvs pvs ON  cps.cps_proveedor = pvs.pvs_id  WHERE cps_estado_pagado LIKE '%$cps[cps_estado_pagado]%' AND cps_fecha_compra BETWEEN '$cps[cps_fecha_compra_inicio]' AND '$cps[cps_fecha_compra_fin]' ORDER BY cps.cps_folio ASC";
            }
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->execute();
            return $pps->fetchAll();
        } catch (PDOException $th) {
            return $th->getMessage();
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlEliminarCompra($cps_folio)
    {

        try {
            $sql = "DELETE FROM  tbl_compras_cps  WHERE cps_folio = ? ";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $cps_folio);
            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (\PDOException $th) {
            throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlConsultarComprasFecha($fecha_inicio, $fecha_final)
    {
        try {
            $sql = "SELECT * FROM tbl_abonos_abs_compras WHERE abs_fecha BETWEEN '$fecha_inicio' AND '$fecha_final' ";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->execute();
            return $pps->fetchAll();
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlConsultarComprasFecha2()
    {
        try {
            $sql = "SELECT * FROM tbl_abonos_abs_compras  ";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->execute();
            return $pps->fetchAll();
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlActualizarProductosExcel($pds)
    {
        try {

            $sql = "UPDATE tbl_productos SET existencia = existencia + ? WHERE codigo = ?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $pds['stock']);
            $pps->bindValue(2, $pds['codigo']);
            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlMostrarProductosAlamacenExistentes($pds_sku)
    {
        try {
            //code...
            $sql = "SELECT id,descripcion,stock FROM productos WHERE codigo = ?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $pds_sku);
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


    public static function mdlCrearCompraP($cps)
    {

        try {
            $sql = "INSERT INTO tbl_compras_cps (cps_id, cps_suc_nombre, cps_id_proveedor, 
            cps_folio, cps_productos, cps_fecha_compra, cps_num_articulos, cps_total, 
            cps_costo_envio, cps_gran_total, cps_tipo_pago, cps_metodo_pago, cps_monto) 
            VALUES (NULL,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $cps['cps_ams_id']);
            $pps->bindValue(2, $cps['cps_proveedor']);
            $pps->bindValue(3, $cps['cps_folio']);
            $pps->bindValue(4, $cps['cps_productos']);
            $pps->bindValue(5, $cps['cps_fecha']);
            $pps->bindValue(6,  $cps['cps_num_articulos']);
            $pps->bindValue(7,  $cps['cps_total']);
            $pps->bindValue(8, 0);
            $pps->bindValue(9,  $cps['cps_gran_total']);
            $pps->bindValue(10, $cps['cps_tipop']);
            $pps->bindValue(11, $cps['cps_mtdpago']);
            $pps->bindValue(12, $cps['cps_monto']);

            $pps->execute();
            return $con->lastInsertId();
        } catch (\PDOException $th) {
            throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlAllCompras()
    {
        try {
            //code...
            $sql = "SELECT cps.* FROM tbl_compras_cps cps ORDER BY cps.cps_id DESC";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->execute();

            return $pps->fetchAll();
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }
    public static function mdlAutocompleteProductos($producto)
    {
        try {
            //code...
            $sql = "SELECT tbl_productos.id,tbl_productos.producto,CONCAT(tbl_productos.codigo,' - ',tbl_productos.producto) as label, tbl_productos.codigo, tbl_productos.descripcion, tbl_categorias.categoria FROM tbl_productos JOIN tbl_categorias ON tbl_productos.categoria = tbl_categorias.id WHERE tbl_productos.producto LIKE '%$producto%' OR tbl_productos.codigo LIKE '%$producto%' OR tbl_productos.descripcion LIKE '%$producto%' OR tbl_categorias.categoria LIKE '%$producto%' ";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->execute();

            return $pps->fetchAll();
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlConsultarCompraPorID($cps_id)
    {
        try {

            $sql = "SELECT cps.*,pvs.pvs_nombre FROM tbl_compras_cps cps JOIN  tbl_proveedores_pvs pvs ON  cps.cps_id_proveedor = pvs.pvs_id WHERE cps.cps_id  = ? ";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $cps_id);
            $pps->execute();
            return $pps->fetch();
        } catch (\PDOException $th) {
            throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }
}
