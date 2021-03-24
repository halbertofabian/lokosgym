<?php
class Conexion
{
    public static  function conectar()
    {
        // $link = new PDO("mysql:host=localhost;dbname=u203735599_soft_lokosgym",
        //            "u203735599_soft_lokosgym",
        //            "zkNa~2wK");
        $link = new PDO(
            "mysql:host=localhost;dbname=db_lokosgym_2",
            "root",
            ""
        );

        $link->exec("set names utf8");

        return $link;
    }
}
