<?php
require 'config/db.php';
try {
    $sql = "CREATE TABLE IF NOT EXISTS page_banners (
        id INT AUTO_INCREMENT PRIMARY KEY,
        page_name VARCHAR(100) NOT NULL UNIQUE,
        desktop_image VARCHAR(255) NOT NULL,
        mobile_image VARCHAR(255),
        title VARCHAR(255),
        subtitle VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "Table page_banners created successfully.\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
