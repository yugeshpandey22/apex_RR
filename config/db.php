<?php
// config/db.php

if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false || strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false) {
    // Localhost (XAMPP) Setting
    define('BASE_URL', '/apex/');
    $host = 'localhost';
    $dbname = 'apex_db';
    $user = 'root';
    $pass = '';
} else {
    // Live Server (cPanel) Setting
    define('BASE_URL', '/'); 
    $host = 'localhost';
    $dbname = 'bargain1_apex'; // YAHA CPANEL DATABASE KA NAAM DAALEIN
    $user = 'bargain1_apex'; // YAHA CPANEL USER KA NAAM DAALEIN
    $pass = 'LIVE_PASSWORD_HERE'; // YAHA NAYA PASSWORD DAALEIN
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database Connection failed: " . $e->getMessage() . "<br>Please make sure the database details are correct in config/db.php.");
}



