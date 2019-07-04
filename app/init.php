<?php

require_once 'core/app.php';
require_once 'core/controller.php';
require_once "models/database.php";
require_once "include/vars.php";

try {
    $db =  new PDO('mysql:host=localhost;', 'root', '');
    $sql = "CREATE DATABASE onemilionpixels";
    $qr = $db->exec($sql);
    $db = null;

    $dir = dirname(dirname(__FILE__));
    $file = $dir . '\app\include\onemilionpixels.sql';

    $db = new Database;
    $sql = file_get_contents($file);
    $pdo = $db->connect();
    $qr = $pdo->exec($sql);
    $db->closeConnection($pdo);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}