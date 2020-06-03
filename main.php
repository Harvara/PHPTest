<?php

require_once "config/settings.php";
require_once "vendor/autoload.php";

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


$sql="select * from Messages";
$statement = $pdo->prepare($sql);


$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);
echo "Content:" . $result["Content"] . PHP_EOL;



$sql="select * from Messages where SenderIP= :sip";
$statement = $pdo->prepare($sql);

$sip= "127.0.0.1";
$statement->bindValue(":sip",$sip);

$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);
echo "Content:" . $result["Content"] . PHP_EOL;


$sql="select * from Messages where ID = :id";
$statement = $pdo->prepare($sql);

$statement->bindValue(":id",1,PDO::PARAM_INT);


$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);
echo "Content:" . $result["Content"] . PHP_EOL;

