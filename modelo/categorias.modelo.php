<?php
require_once 'conexion.php';

class CategoriasModelo
{
    /*=============================================
	REGISTRO DE CATEGORIA
	=============================================*/
    public static function mdlIngresarCategoria($categoria)
    {
        $sqlInsert = "INSERT INTO tbl_categorias (categoria,caracteristicas_categoria) 
        VALUES(:nombre,:caracteristicas) ";

        $stmt = Conexion::conectar()->prepare($sqlInsert);

        $stmt->bindParam(":nombre", $categoria['nombre']);
        $stmt->bindParam(":caracteristicas", $categoria['caracteristicas']);


        return $stmt->execute();
        $stmt = null;
    }

    /*=============================================
	ACTUALIZACION DE CATEGORIA 
	=============================================*/
    public static function mdlActualizarCategoria($categoria)
    {
        $sqlUpdate = "UPDATE  tbl_categorias SET categoria = :nombre,  
        caracteristicas_categoria = :caracteristicas  WHERE id = :id ";

        $stmt = Conexion::conectar()->prepare($sqlUpdate);

        $stmt->bindParam(":nombre", $categoria['nombre']);
        $stmt->bindParam(":caracteristicas", $categoria['caracteristicas']);
        $stmt->bindParam(":id", $categoria['id']);

        return $stmt->execute();
        
        $stmt = null;
    }
    /*=============================================
	ELIMINACION DE CATEGORIA 
	=============================================*/
    public static function mdlEliminarCategoria($categoria)
    {
        $sqlDelete = "DELETE FROM tbl_categorias  WHERE id = :id";

        $stmt = Conexion::conectar()->prepare($sqlDelete);

        $stmt->bindParam(":id", $categoria);

        return $stmt->execute();
        $stmt = null;
    }
    /*=============================================
	MOSTRAR TODAS LAS CATEGORIAS O 1 
	=============================================*/
    public static function mdlMostrarCategoria($categoria)
    {


        if ($categoria != null) {

            $sqlDelete = "SELECT * FROM  tbl_categorias  WHERE id = :id";
            $stmt = Conexion::conectar()->prepare($sqlDelete);
            $stmt->bindParam(":id", $categoria);

            $stmt->execute();
            return $stmt->fetch();
        } else {

            $sqlDelete = "SELECT * FROM tbl_categorias ORDER BY categoria ASC";
            $stmt = Conexion::conectar()->prepare($sqlDelete);

            $stmt->execute();
            return $stmt->fetchAll();

        }







        return $stmt->execute();
        $stmt = null;
    }
}
