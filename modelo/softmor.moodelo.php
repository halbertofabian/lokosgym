<?php
require_once 'conexion.php';
class Softmor
{
    public static function issetItem($table, $item, $value)
    {
        $stmt = Conexion::conectar()->prepare("SELECT *  FROM $table WHERE $item = :val ");
        $stmt->bindParam(":val", $value, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();

        

        $stmt = null;
    }
}
