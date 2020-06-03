<?php

require_once "Message.php";
require_once "EncryptedMessage.php";


$m1 = new Message("Hello Wolrd");

echo $m1::MESSAGE_SERVER;
$m1->contactMessageServer();