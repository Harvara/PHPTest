<?php

require_once "vendor/autoload.php";
require_once "src/classes/Message.php";
require_once "src/classes/DatabaseConnection.php";

$messages = [];

echo "Loading Messages from DB" . PHP_EOL;

$pdo= new DatabaseConnection();
$pdo = $pdo->create();


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

echo "Got " . sizeof($messages) .  " Messages" .  PHP_EOL;

$f = fopen("php://stdin","r");

foreach ($messages as $message){
    $message->printMessage();
    fgets($f);
    $message->saveMessageToDB($pdo);
}

fclose($f);

function readNewMessage() {
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
}