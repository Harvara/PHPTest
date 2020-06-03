<?php

require_once "config/dbConnection.php";

try {
    $pdo = new PDO(
        "mysql:host=$server;dbname=$db",
        $dbuser,
        $pw);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("SLQ Connection Error" . $e);
}