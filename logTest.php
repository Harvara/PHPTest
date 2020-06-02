<?php
require "vendor/autoload.php";


use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger("myApp");
$log->pushHandler(new Streamhandler("logs/development.log", Logger::DEBUG));
$log->pushHandler(new Streamhandler("logs/production.log", Logger::WARNING));


$log->debug("this is a debug message");
$log->warning("this is a warning message");