<?php
require_once 'conexion.php';

class ProductosModelo
{
    /*=============================================
	REGISTRO DE PRODUCTO
	=============================================*/
    public static function mdlIngresarProducto($producto)
    {
        $sqlInsert = "INSERT INTO tbl_productos (codigo,producto,marca,
        categoria,descripcion,caracteristicas_producto,existencia,precio_compra,
        precio_publico,precio_mayoreo,precio_especial,fecha,imagen) 
        VALUES(:codigo,:nombre,:marca,:categoria,:descripcion,:caracteristicas
        ,:existencia,:precio_compra,:precio_publico,:precio_mayoreo,
        :precio_especial,:fecha,:imagen) ";

        $stmt = Conexion::conectar()->prepare($sqlInsert);
        $stmt->bindParam(":codigo", $producto['codigo']);
        $stmt->bindParam(":nombre", $producto['nombre']);
        $stmt->bindParam(":marca", $producto['marca']);
        $stmt->bindParam(":categoria", $producto['categoria']);
        $stmt->bindParam(":descripcion", $producto['descripcion']);
        $stmt->bindParam(":caracteristicas", $producto['caracteristicas']);
        $stmt->bindParam(":existencia", $producto['existencia']);
        $stmt->bindParam(":precio_compra", $producto['precio_compra']);
        $stmt->bindParam(":precio_publico", $producto['precio_publico']);
        $stmt->bindParam(":precio_mayoreo", $producto['precio_mayoreo']);
        $stmt->bindParam(":precio_especial", $producto['precio_especial']);
        $stmt->bindParam(":fecha", $producto['fecha']);
        $stmt->bindParam(":imagen", $producto['imagen']);

        return $stmt->execute();
        //print_r($stmt->errorInfo());
        $stmt = null;
    }
    /*=============================================
	MOSTRAR  PRODUCTO
	=============================================*/
    public static function mdlMostrarProducto($producto)
    {


        if ($producto != null) {

            $sqlSelect = "SELECT tblP.*, tblC.* FROM tbl_productos tblP JOIN tbl_categorias tblC ON tblP.categoria = tblC.id  WHERE tblP.id = :id OR tblP.codigo = :id";
            $stmt = Conexion::conectar()->prepare($sqlSelect);
            $stmt->bindParam(":id", $producto);

            $stmt->execute();
            return $stmt->fetch();
        } else {

            $sqlSelect = "SELECT tblP.*, tblC.* FROM tbl_productos tblP JOIN tbl_categorias tblC ON tblP.categoria = tblC.id";
            $stmt = Conexion::conectar()->prepare($sqlSelect);

            $stmt->execute();
            return $stmt->fetchAll();
        }

        $stmt = null;
    }
    public static function mdlMostrarProductoBarras($producto)
    {

        $sqlSelect = "SELECT tblP.*, tblC.* FROM tbl_productos tblP JOIN tbl_categorias tblC ON tblP.categoria = tblC.id  WHERE  tblP.codigo = :id";
        $stmt = Conexion::conectar()->prepare($sqlSelect);
        $stmt->bindParam(":id", $producto);

        $stmt->execute();
        return $stmt->fetch();


        $stmt = null;
    }

    /*=============================================
	ACTUALIZACION DE PRODUCTO
	=============================================*/
    public static function mdlActualizarProducto($producto)
    {

        $sqlUpdate = "UPDATE  tbl_productos SET codigo =:codigo , producto = :nombre 
        , marca = :marca , categoria = :categoria
        , descripcion = :descripcion , caracteristicas_producto = :caracteristicas
        , existencia =  :existencia , precio_compra = :precio_compra
        , precio_publico = :precio_publico , precio_mayoreo = :precio_mayoreo
        , precio_especial = :precio_especial , imagen = :imagen 
            WHERE id = :id
        ";


        $stmt = Conexion::conectar()->prepare($sqlUpdate);
        $stmt->bindParam(":codigo", $producto['codigo']);
        $stmt->bindParam(":nombre", $producto['nombre']);
        $stmt->bindParam(":marca", $producto['marca']);
        $stmt->bindParam(":categoria", $producto['categoria']);
        $stmt->bindParam(":descripcion", $producto['descripcion']);
        $stmt->bindParam(":caracteristicas", $producto['caracteristicas']);
        $stmt->bindParam(":existencia", $producto['existencia']);
        $stmt->bindParam(":precio_compra", $producto['precio_compra']);
        $stmt->bindParam(":precio_publico", $producto['precio_publico']);
        $stmt->bindParam(":precio_mayoreo", $producto['precio_mayoreo']);
        $stmt->bindParam(":precio_especial", $producto['precio_especial']);
        $stmt->bindParam(":imagen", $producto['imagen']);
        $stmt->bindParam(":id", $producto['id']);

        return $stmt->execute();

        $stmt = null;
    }

    static public function mdlMostrarProductosBusqueda($consulta, $categoria)
    {

        if ($categoria == "" && $consulta != "") {
            $stmt = Conexion::conectar()->prepare("SELECT tblP.*, tblC.* FROM tbl_productos tblP JOIN tbl_categorias tblC ON tblP.categoria = tblC.id  WHERE codigo LIKE '" . $consulta . "%' OR producto LIKE '" . $consulta . "%' OR marca LIKE '" . $consulta . "%' OR descripcion LIKE '" . $consulta . "%' OR caracteristicas_producto LIKE '" . $consulta . "%'  OR tblC.categoria LIKE '" . $consulta . "%' GROUP BY producto ASC LIMIT 100 ");
        } elseif ($categoria != "" && $consulta == "") {
            $stmt = Conexion::conectar()->prepare("SELECT tblP.*, tblC.* FROM tbl_productos tblP JOIN tbl_categorias tblC ON tblP.categoria = tblC.id WHERE  tblP.categoria = ?  ");
            $stmt->bindValue(1, $categoria);
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT tblP.*, tblC.* FROM tbl_productos tblP JOIN tbl_categorias tblC ON tblP.categoria = tblC.id  ORDER BY producto ASC LIMIT 100 ");
        }

        $stmt->execute();

        return  $stmt->fetchAll();

        //print_r($stmt->errorInfo());      

        $stmt = null;
    }

    public static function isSerach($producto)
    {
        $sqlSearch = "SELECT 1 FROM tbl_productos WHERE codigo = :codigo ";

        $stmt = Conexion::conectar()->prepare($sqlSearch);

        $stmt->bindParam(':codigo', $producto);

        $stmt->execute();

        return $stmt->fetch();

        $stmt = null;
    }

    public static function mdlMostrarSumProductos()
    {
        $sql = "SELECT SUM(existencia) AS total FROM tbl_productos";
        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->execute();
        return $stmt->fetch();
        $stmt = null;
    }

    public static function eliminarProductoById($id)
    {
        $sql = "DELETE FROM tbl_productos WHERE id=? ";
        $pps = Conexion::conectar()->prepare($sql);
        $pps->bindValue(1, $id);

        $pps->execute();
        return $pps->rowCount() > 0;

        $pps = null;
    }

    public static function mdlMostrarcats()
    {
        $sql = "SELECT id, categoria FROM tbl_categorias";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt = null;
    }

    public static function mdlCrearCat($categoria)
    {
        try {
            //code...
            $sql = "INSERT INTO tbl_categorias(categoria, caracteristicas_categoria) VALUES (?,?)";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $categoria);
            $pps->bindValue(2, "");
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

    public static function mdlidNewCat()
    {
        $sql = "SELECT id FROM tbl_categorias ORDER BY id DESC LIMIT 1";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
        $stmt = null;
    }

    public static function mdlMostrarProductoByCodigo($codigo)
    {
        $sql = "SELECT * FROM tbl_productos WHERE codigo=?";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindValue(1, $codigo);
        $stmt->execute();
        return $stmt->fetch();
        $stmt = null;
    }

    public static function mdlCrearProductoImport($pd)
    {
        try {
            //code...
            $sql = "INSERT INTO tbl_productos(codigo, producto, marca, categoria, descripcion, caracteristicas_producto, 
            existencia, existencia_min, precio_compra, precio_publico, precio_mayoreo, precio_especial, fecha, usuario_registro, imagen) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $pd['codigo']);
            $pps->bindValue(2, $pd['producto']);
            $pps->bindValue(3, $pd['marca']);
            $pps->bindValue(4, $pd['categoria']);
            $pps->bindValue(5, $pd['descripcion']);
            $pps->bindValue(6, $pd['caracteristicas_producto']);
            $pps->bindValue(7, $pd['existencia']);
            $pps->bindValue(8, $pd['existencia_min']);
            $pps->bindValue(9, $pd['precio_compra']);
            $pps->bindValue(10, $pd['precio_publico']);
            $pps->bindValue(11, $pd['precio_mayoreo']);
            $pps->bindValue(12, $pd['precio_especial']);
            $pps->bindValue(13, $pd['fecha']);
            $pps->bindValue(14, $pd['usuario_registro']);
            $pps->bindValue(15, $pd['imagen']);

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

    public static function mdlActualizarProductoImport($pd)
    {
        try {
            $sql = "UPDATE tbl_productos SET producto=?,categoria=?,existencia=?,
            precio_compra=?,precio_publico=?,fecha=?,usuario_registro=? WHERE codigo=?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $pd['producto']);
            $pps->bindValue(2, $pd['categoria']);
            $pps->bindValue(3, $pd['existencia']);
            $pps->bindValue(4, $pd['precio_compra']);
            $pps->bindValue(5, $pd['precio_publico']);
            $pps->bindValue(6, $pd['fecha']);
            $pps->bindValue(7, $pd['usuario_registro']);
            $pps->bindValue(8, $pd['codigo']);
            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (PDOException $th) {
            throw $th;
            return false;
        } finally {
            $pps = null;
            $pps = null;
        }
    }
}
