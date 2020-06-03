<?php


require "EncryptedMessage.php";


$m2 = new EncryptedMessage("testmessage");

$m2->encrypt();

echo $m2->getUnencryptedContent() .  PHP_EOL;
echo $m2->getEncryptedContent() . PHP_EOL;


echo hash("sha256", "testmessage");