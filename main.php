<?php

require_once "vendor/autoload.php";
require_once "src/classes/Message.php";
require_once "src/classes/DatabaseConnection.php";

$messages = [];

$pdo= new DatabaseConnection();
$pdo = $pdo->create();


$sql="select * from Messages";
$statement = $pdo->prepare($sql);

$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $res){
    var_dump($res);
    array_push(
        $messages,
        Message::withContent($res)
    );
}

while(sizeof($messages)<5){
    readNewMessage();
}

foreach ($messages as $message){
    $message->printMessage();
    $message->saveMessageToDB($pdo);
}

function readNewMessage() {
    global $messages;
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