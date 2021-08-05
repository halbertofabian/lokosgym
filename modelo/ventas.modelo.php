<?php
require_once 'conexion.php';
class VentasModelo
{
    public static function mdlMostrarUltimaVenta()
    {
        $sql = "SELECT * FROM tbl_ventas  ORDER BY fecha DESC ";
        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->execute();
        return $stmt->fetch();


        $stmt = null;
    }
    public static function mdlCrearVenta($datos)
    {
        $sqlInsert = "INSERT INTO tbl_ventas (id_venta,id_cliente,
        id_vendedor,forma_pago,neto,total,descuento,fecha,estado_corte,venta_mp,vts_efectivo,vts_tarjeta) VALUES(:id_venta,:id_cliente,
        :id_vendedor,:forma_pago,:neto,:total,:descuento,:fecha,:estado_corte,:venta_mp,:vts_efectivo,:vts_tarjeta)";

        $stmt = Conexion::conectar()->prepare($sqlInsert);

        $stmt->bindParam(':id_venta', $datos['id_venta']);
        $stmt->bindParam(':id_cliente', $datos['id_cliente']);
        $stmt->bindParam(':id_vendedor', $datos['id_vendedor']);
        $stmt->bindParam(':forma_pago', $datos['forma_pago']);
        $stmt->bindParam(':neto', $datos['neto']);
        $stmt->bindParam(':total', $datos['total']);
        $stmt->bindParam(':descuento', $datos['descuento']);
        $stmt->bindParam(':fecha', $datos['fecha']);
        $stmt->bindParam(':estado_corte', $datos['estado_corte']);
        $stmt->bindParam(':venta_mp', $datos['venta_mp']);
        $stmt->bindParam(':vts_efectivo', $datos['vts_efectivo']);
        $stmt->bindParam(':vts_tarjeta', $datos['vts_tarjeta']);

        $stmt->execute();

        return $stmt->errorInfo();



        $stmt = null;
    }

    public static function mdlCrearDetalleVenta($datos)
    {
        $sqlInsert = "INSERT INTO tbl_detalle_ventas (id_venta,id_producto
        ,cantidad,precio,neto,total) VALUES(:id_venta,:id_producto
        ,:cantidad,:precio,:neto,:total)";

        $stmt = Conexion::conectar()->prepare($sqlInsert);

        $stmt->bindParam(':id_venta', $datos['id_venta']);
        $stmt->bindParam(':id_producto', $datos['id_producto']);
        $stmt->bindParam(':cantidad', $datos['cantidad']);
        $stmt->bindParam(':precio', $datos['precio']);
        $stmt->bindParam(':neto', $datos['neto']);
        $stmt->bindParam(':total', $datos['total']);

        return $stmt->execute();



        $stmt = null;
    }

    public static function mdlUpdateStock($datos)
    {
        $sqlUpdateStock = " UPDATE tbl_productos SET existencia = :existencia 
        WHERE id =:id";

        $stmt = Conexion::conectar()->prepare($sqlUpdateStock);

        $stmt->bindParam(':existencia', $datos['existencia']);
        $stmt->bindParam(':id', $datos['id']);


        return $stmt->execute();



        $stmt = null;
    }
    public static function mdlMostrarVentaTicket($codigo)
    {
        $sql = "SELECT dv.id_venta,dv.cantidad, dv.precio, dv.neto,
         dv.total, tp.codigo,tp.producto, tp.caracteristicas_producto, 
         tp.precio_publico, tv.id_venta,tv.id_cliente,tv.id_vendedor,
         tv.forma_pago,tv.neto,tv.total,tv.descuento,tv.fecha,tv.vts_efectivo,tv.vts_tarjeta,tu.nombre,tu.apellido,tc.nombre_cliente 
         FROM tbl_detalle_ventas dv JOIN tbl_productos tp
          ON dv.id_producto = tp.id JOIN tbl_ventas tv 
          ON dv.id_venta = tv.id_venta JOIN tbl_usuarios tu
           ON tv.id_vendedor = tu.id JOIN tbl_clientes tc
           ON tv.id_cliente = tc.id_cliente
           
            WHERE tv.id_venta = :codigo";
        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(':codigo', $codigo);

        $stmt->execute();
        return $stmt->fetchAll();


        $stmt = null;
    }
    public static function mdlMostrarVentas()
    {
        $sql = "SELECT tv.*,tu.nombre FROM tbl_ventas tv JOIN tbl_usuarios tu ON tv.id_vendedor = tu.id GROUP BY tv.id_venta DESC ";
        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->execute();
        return $stmt->fetchAll();


        $stmt = null;
    }

    public static function mdlMostrarVentasByCorte($estado_corte)
    {
        $sql = "SELECT tv.*,tu.nombre FROM tbl_ventas tv JOIN tbl_usuarios tu ON tv.id_vendedor = tu.id WHERE estado_corte = ? GROUP BY tv.id_venta DESC ";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindValue(1, $estado_corte);
        $stmt->execute();

        return $stmt->fetchAll();
        $stmt = null;
    }
    public static function mdlMostrarVentasRangoFachas($dateStart, $dateEnd)
    {
        if ($dateStart == null) {
            $sql = "SELECT tv.*,tu.nombre FROM tbl_ventas tv JOIN tbl_usuarios tu ON tv.id_vendedor = tu.id GROUP BY tv.id_venta DESC ";
            $stmt = Conexion::conectar()->prepare($sql);

            $stmt->execute();
        } else if ($dateStart == $dateEnd) {
            $sql = "SELECT tv.*,tu.nombre FROM tbl_ventas tv JOIN tbl_usuarios tu ON tv.id_vendedor = tu.id WHERE tv.fecha like '%$dateEnd%' GROUP BY tv.id_venta DESC ";
            $stmt = Conexion::conectar()->prepare($sql);

            $stmt->execute();
        } else {

            $sql = "SELECT tv.*,tu.nombre FROM tbl_ventas tv JOIN tbl_usuarios tu ON tv.id_vendedor = tu.id WHERE tv.fecha BETWEEN '$dateStart' AND '$dateEnd' GROUP BY tv.id_venta DESC ";
            $stmt = Conexion::conectar()->prepare($sql);

            $stmt->execute();
        }



        return $stmt->fetchAll();

        //return print_r($stmt->errorInfo());

        $stmt = null;
    }

    public static function mdlMostrarVentasRangoFachasHome($dateStart, $dateEnd)
    {
        if ($dateStart == null) {
            $sql = "SELECT p.producto,p.precio_compra,dv.cantidad,dv.precio,dv.id_venta,v.total,v.descuento,v.fecha FROM tbl_detalle_ventas dv JOIN tbl_productos p ON dv.id_producto = p.id JOIN tbl_ventas v ON dv.id_venta = v.id_venta ORDER BY dv.id_venta DESC ";
            $stmt = Conexion::conectar()->prepare($sql);

            $stmt->execute();
        } else if ($dateStart == $dateEnd) {
            // $sql = "SELECT tv.*,tu.nombre FROM tbl_ventas tv JOIN tbl_usuarios tu ON tv.id_vendedor = tu.id WHERE tv.fecha like '%$dateEnd%' GROUP BY tv.id_venta DESC ";

            $sql = "SELECT p.producto,p.precio_compra,dv.cantidad,dv.precio,dv.id_venta,v.total,v.descuento,v.fecha FROM tbl_detalle_ventas dv JOIN tbl_productos p ON dv.id_producto = p.id JOIN tbl_ventas v ON dv.id_venta = v.id_venta WHERE v.fecha like '%$dateEnd%' ORDER BY dv.id_venta DESC";

            $stmt = Conexion::conectar()->prepare($sql);

            $stmt->execute();
        } else {

            // $sql = "SELECT tv.*,tu.nombre FROM tbl_ventas tv JOIN tbl_usuarios tu ON tv.id_vendedor = tu.id WHERE tv.fecha BETWEEN '$dateStart' AND '$dateEnd' GROUP BY tv.id_venta DESC ";
            $sql = "SELECT p.producto,p.precio_compra,dv.cantidad,dv.precio,dv.id_venta,v.total,v.descuento,v.fecha FROM tbl_detalle_ventas dv JOIN tbl_productos p ON dv.id_producto = p.id JOIN tbl_ventas v ON dv.id_venta = v.id_venta WHERE v.fecha BETWEEN '$dateStart' AND '$dateEnd' GROUP BY dv.id_venta DESC ";

            $stmt = Conexion::conectar()->prepare($sql);

            $stmt->execute();
        }



        return $stmt->fetchAll();

        //return print_r($stmt->errorInfo());

        $stmt = null;
    }

    public static function mdlMostrarVentasRangoFachasHome2($dateStart, $dateEnd, $usuario, $mp)
    {

        if ($dateStart != null && $dateEnd != null && $usuario != null && $mp != null) {
            $sql = "SELECT p.producto,p.precio_compra,dv.cantidad,dv.precio,dv.id_venta,v.total,v.descuento,v.fecha,v.venta_mp,us.nombre 
            FROM tbl_detalle_ventas dv 
            JOIN tbl_productos p ON dv.id_producto = p.id 
            JOIN tbl_ventas v ON dv.id_venta = v.id_venta
            JOIN tbl_usuarios us ON v.id_vendedor= us.id
            WHERE (v.fecha BETWEEN '$dateStart' AND '$dateEnd') AND (v.id_vendedor=?) AND (v.venta_mp=?) ORDER BY dv.id_venta DESC";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindValue(1, $usuario);
            $stmt->bindValue(2, $mp);
            $stmt->execute();
        } elseif ($usuario == null && $mp != null) {
            $sql = "SELECT p.producto,p.precio_compra,dv.cantidad,dv.precio,dv.id_venta,v.total,v.descuento,v.fecha,v.venta_mp,us.nombre 
            FROM tbl_detalle_ventas dv 
            JOIN tbl_productos p ON dv.id_producto = p.id 
            JOIN tbl_ventas v ON dv.id_venta = v.id_venta
            JOIN tbl_usuarios us ON v.id_vendedor= us.id
            WHERE (v.fecha BETWEEN '$dateStart' AND '$dateEnd') AND (v.venta_mp=?) ORDER BY dv.id_venta DESC";
            $stmt = Conexion::conectar()->prepare($sql);

            $stmt->bindValue(1, $mp);
            $stmt->execute();
        } elseif ($mp == null && $usuario != null) {
            $sql = "SELECT p.producto,p.precio_compra,dv.cantidad,dv.precio,dv.id_venta,v.total,v.descuento,v.fecha,v.venta_mp,us.nombre 
            FROM tbl_detalle_ventas dv 
            JOIN tbl_productos p ON dv.id_producto = p.id 
            JOIN tbl_ventas v ON dv.id_venta = v.id_venta
            JOIN tbl_usuarios us ON v.id_vendedor= us.id
            WHERE (v.fecha BETWEEN '$dateStart' AND '$dateEnd') AND (v.id_vendedor=?) ORDER BY dv.id_venta DESC";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindValue(1, $usuario);
            $stmt->execute();
        } elseif ($mp == null && $usuario == null) {
            $sql = "SELECT p.producto,p.precio_compra,dv.cantidad,dv.precio,dv.id_venta,v.total,v.descuento,v.fecha,v.venta_mp,us.nombre 
            FROM tbl_detalle_ventas dv 
            JOIN tbl_productos p ON dv.id_producto = p.id 
            JOIN tbl_ventas v ON dv.id_venta = v.id_venta
            JOIN tbl_usuarios us ON v.id_vendedor= us.id
            WHERE (v.fecha BETWEEN '$dateStart' AND '$dateEnd') ORDER BY dv.id_venta DESC";
            $stmt = Conexion::conectar()->prepare($sql);

            $stmt->execute();
        }

        return $stmt->fetchAll();
        //return print_r($stmt->errorInfo());
        $stmt = null;
    }

    // Reprtes
    public static function mdlMostrarSumVentas()
    {
        $sql = "SELECT SUM(total) AS total FROM tbl_ventas";
        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->execute();
        return $stmt->fetch();
        $stmt = null;
    }

    public static function mdlMostrarSumarCompras()
    {
        try {
            $sql = "SELECT p.*,dv.*,v.* FROM tbl_detalle_ventas dv JOIN tbl_productos p ON dv.id_producto = p.id JOIN tbl_ventas v ON dv.id_venta = v.id_venta";
            $pps = Conexion::conectar()->prepare($sql);
            $pps->execute();
            return $pps->fetchAll();
        } catch (\PDOException $th) {
            //throw $th;
            return false;
        } finally {
            $pps = null;
        }
    }
    public static function mdlMostrarSumarCompras2()
    {
        try {
            $sql = "SELECT * FROM tbl_productos";
            $pps = Conexion::conectar()->prepare($sql);
            $pps->execute();
            return $pps->fetchAll();
        } catch (\PDOException $th) {
            //throw $th;
            return false;
        } finally {
            $pps = null;
        }
    }

    public static function eliminarVentaById($dts)
    {
        try {
            //code...
            $sql = "DELETE FROM tbl_ventas WHERE id_venta=?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $dts['id_venta']);
            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }
    //`

}
