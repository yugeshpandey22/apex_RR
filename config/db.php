<?php
// config/db.php
define('BASE_URL', '/'); // Changed for live server
// Placeholder for database connection
$host = 'localhost';
$dbname = 'apex_db';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database Connection failed: " . $e->getMessage() . "<br>Please make sure the database name is correct in config/db.php.");
}



