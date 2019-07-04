<?php

require_once 'core/app.php';
require_once 'core/controller.php';
require_once "models/database.php";
require_once "include/vars.php";
// require_once "include/onemilionpixels.sql";

// try {
//     $db =  new PDO('localhost', 'root', '');

//     $sql = file_get_contents('onemilionpixels.sql');
//     $qr = $db->exec($sql);
// } catch(PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }