<?php

require_once "config/settings.php";
require_once "vendor/autoload.php";
require_once "src/classes/Message.php";


$messages = [];


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
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $res){
    array_push(
        $messages,
        new Message($res)
    );
}

foreach ($messages as $message){
    $message->printMessage();
}