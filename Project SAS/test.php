<?php
include 'db.php';

try {
    echo "Testing database connection...<br>";
    
    // Test categories table
    $categoriesStmt = $pdo->query("SELECT * FROM categories");
    $categories = $categoriesStmt->fetchAll();
    echo "Categories found: " . count($categories) . "<br>";
    
    // Test assets table
    $assetsStmt = $pdo->query("
        SELECT assets.serial_number, assets.device_name, assets.price, assets.status,
               categories.name AS category_name
        FROM assets
        INNER JOIN categories ON assets.category_id = categories.id
        ORDER BY assets.id DESC
    ");
    $assets = $assetsStmt->fetchAll();
    echo "Assets found: " . count($assets) . "<br>";
    
    echo "<pre>";
    print_r($assets);
    echo "</pre>";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
