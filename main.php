<?php

require "Message.php";
require "EncryptedMessage.php";

$m1 = new Message("Hello World");

echo $m1->getMessage() . PHP_EOL;

if ($m1->checkMeta("127.0.0.2")){
    echo "sender found" . PHP_EOL;
}else{
    echo "sender not found" . PHP_EOL;
}


$m2 = new EncryptedMessage("testmessage");
echo $m2->getMessage() . PHP_EOL;
$m2->encrypt();
echo $m2->getEncryptedContent() . PHP_EOL;


echo hash("sha256", "testmessage");