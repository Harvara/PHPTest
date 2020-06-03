<?php

require_once "config/settings.php";
require_once "vendor/autoload.php";

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