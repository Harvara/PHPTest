<?php

define("ROOT_PATH", '/home/henry/Documents/Intern/PHPTest');


/*
$f= fopen(ROOT_PATH."/config/settings.php","r");

echo fread($f, filesize(ROOT_PATH."/config/settings.php"));

fclose($f);

*/
class DatabaseConnection
{
    public function create()
    {
        require_once ROOT_PATH."/config/settings.php";
        try {
            $pdo = new PDO(
                "mysql:host={$settings["host"]};dbname={$settings["db"]}",
                $settings["dbuser"],
                $settings["pw"]);
            // set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("SLQ Connection Error" . $e);
        }
        return $pdo;
    }
}