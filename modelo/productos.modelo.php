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

    static public function mdlMostrarProductosBusqueda($consulta,$categoria)
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
}
