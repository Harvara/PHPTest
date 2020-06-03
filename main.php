<?php

require_once "Message.php";
require_once "EncryptedMessage.php";



$m1 = new Message();

echo $m1->getContent() . PHP_EOL;
echo $m1::MESSAGE_SERVER;
$m1->contactMessageServer();