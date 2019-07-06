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

$path = dirname(dirname(dirname(__FILE__)));

class Init {
    private $SITE_FNs = "61982, 62001";
    private $SITE_CREATORs = "Габриела Геренска, Слави Стоев";
    private $SITE_ADMIN_EMAIL = "gabolinno@gmail.com, slavi.stoev97@gmial.com";
    private $SITE_INFO = "This project was created during 2019, on Web Technologies, Sofia University, FMI, lead by: Milen Petrov";

    //private $SITE_URL = "http://localhost/web_technologies_2018_2019/public/";
    //private $ROOT_FOLDER = "C:\xampp\htdocs\web_technologies_2018_2019";
    private $DB_USER = "root";
    private $DB_PASS = "";
    private $DB_NAME = "onemilionpixels";
}