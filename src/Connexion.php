<?php
namespace App;

class Connexion{
    public static function getPDO()
    {
        $dbname = "blog";
        $servername = "localhost";
        $username = "root";
        $password = "";

        
        return  new \PDO("mysql:host=$servername;dbname=blog", $username, $password);
       
    }
}



?>

