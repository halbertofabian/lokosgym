<?php
require_once 'conexion.php';
class VentasModelo
{
    public static function mdlMostrarUltimaVenta()
    {
        $sql = "SELECT * FROM tbl_ventas GROUP BY id_venta DESC ";
        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->execute();
        return $stmt->fetch();


        $stmt = null;
    }
    public static function mdlCrearVenta($datos)
    {
        $sqlInsert = "INSERT INTO tbl_ventas (id_venta,id_cliente,
        id_vendedor,forma_pago,neto,total,descuento,fecha) VALUES(:id_venta,:id_cliente,
        :id_vendedor,:forma_pago,:neto,:total,:descuento,:fecha)";

        $stmt = Conexion::conectar()->prepare($sqlInsert);

        $stmt->bindParam(':id_venta', $datos['id_venta']);
        $stmt->bindParam(':id_cliente', $datos['id_cliente']);
        $stmt->bindParam(':id_vendedor', $datos['id_vendedor']);
        $stmt->bindParam(':forma_pago', $datos['forma_pago']);
        $stmt->bindParam(':neto', $datos['neto']);
        $stmt->bindParam(':total', $datos['total']);
        $stmt->bindParam(':descuento', $datos['descuento']);
        $stmt->bindParam(':fecha', $datos['fecha']);

        return $stmt->execute();



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
         dv.total, tp.codigo, tp.caracteristicas_producto, 
         tp.precio_publico, tv.id_venta,tv.id_cliente,tv.id_vendedor,
         tv.forma_pago,tv.neto,tv.total,tv.descuento,tv.fecha,tu.nombre,tu.apellido 
         FROM tbl_detalle_ventas dv JOIN tbl_productos tp
          ON dv.id_producto = tp.id JOIN tbl_ventas tv 
          ON dv.id_venta = tv.id_venta JOIN tbl_usuarios tu
           ON tv.id_vendedor = tu.id WHERE tv.id_venta = :codigo";
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

    // Reprtes
    public static function mdlMostrarSumVentas()
    {
        $sql = "SELECT SUM(total) AS total FROM tbl_ventas";
        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->execute();
        return $stmt->fetch();
        $stmt = null;
    }
}