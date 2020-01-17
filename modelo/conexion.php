<?php 
    class Conexion {
         public static  function conectar(){
            // $link = new PDO("mysql:host=localhost;dbname=u203735599_refac",
            //            "u203735599_refac",
            //            "T6od5MTpSGnK");
            $link = new PDO("mysql:host=localhost;dbname=db_refaccionaria",
            "root",
            "");
    
            $link->exec("set names utf8");
    
            return $link;
    
        }
    }