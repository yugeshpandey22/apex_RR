<?php
require 'config/db.php';
try {
    $pdo->exec("ALTER TABLE banners ADD COLUMN mobile_image_path VARCHAR(255) AFTER image_path");
    echo "Column mobile_image_path added successfully.\n";
} catch (PDOException $e) {
    if (strpos($e->getMessage(), 'Duplicate column name') !== false) {
        echo "Column already exists.\n";
    } else {
        echo "Error: " . $e->getMessage() . "\n";
    }
}
