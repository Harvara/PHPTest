<?php

require "Message.php";


$m1 = new Message("Hello World");

echo $m1->getMessage() . PHP_EOL;

if ($m1->checkMeta("127.0.0.2")){
    echo "sender found";
}else{
    echo "sender not found";
}
