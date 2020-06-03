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
        Message::withContent($res)
    );
}


$f = fopen("php://stdin","r");

echo "Create new Message".PHP_EOL;

echo "Enter Content:" . PHP_EOL;
$messageContent = fgets($f);
$messageContent=rtrim($messageContent, "\r\n");

echo "Enter Sender IP:" . PHP_EOL;
$messageSender = fgets($f);
$messageSender=rtrim($messageSender, "\r\n");

array_push($messages, Message::withContentAndSender($messageContent,$messageSender));

fclose($f);



foreach ($messages as $message){
    $message->printMessage();
}