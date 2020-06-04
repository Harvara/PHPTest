<?php

define("ROOT_PATH", '/home/henry/Documents/Intern/PHPTest');


class DatabaseConnection
{
    private $localSettings;

    public function __construct(){
        require_once ROOT_PATH."/config/settings.php";
        $this->localSettings=$settings;
    }

    public function create()
    {
        try {
            $pdo = new PDO(
                "mysql:host={$this->localSettings["host"]};dbname={$this->localSettings["db"]}",
                $this->localSettings["dbuser"],
                $this->localSettings["pw"]);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("SLQ Connection Error" . $e);
        }
        return $pdo;
    }
}