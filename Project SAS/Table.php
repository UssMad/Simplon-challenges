<?php
include 'db.php';

$message = '';

$categoriesStmt = $pdo->query("SELECT * FROM categories ORDER BY name ASC");
$categories = $categoriesStmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serial_number = trim($_POST['serial_number'] ?? '');
    $device_name = trim($_POST['device_name'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $status = trim($_POST['status'] ?? '');
    $category_id = trim($_POST['category_id'] ?? '');

    if ($serial_number && $device_name && $price && $status && $category_id) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO assets (serial_number, device_name, price, status, category_id)
                VALUES (?, ?, ?, ?, ?)
            ");

            $stmt->execute([
                $serial_number,
                $device_name,
                $price,
                $status,
                $category_id
            ]);

            $message = "Asset added successfully.";
        } catch (PDOException $e) {
            $message = "Error inserting asset: " . $e->getMessage();
        }
    } else {
        $message = "Please fill in all fields.";
    }
}

$search = trim($_GET['search'] ?? '');

if ($search !== '') {
    $searchTerm = "%$search%";

    $assetsStmt = $pdo->prepare("
        SELECT assets.serial_number, assets.device_name, assets.price, assets.status,
               categories.name AS category_name
        FROM assets
        INNER JOIN categories ON assets.category_id = categories.id
        WHERE assets.device_name LIKE :search
           OR assets.serial_number LIKE :search
        ORDER BY assets.id DESC
    ");
    $assetsStmt->execute([':search' => $searchTerm]);

    $totalStmt = $pdo->prepare("
        SELECT SUM(price) AS total_value
        FROM assets
        WHERE device_name LIKE :search OR serial_number LIKE :search
    ");
    $totalStmt->execute([':search' => $searchTerm]);
} else {
    $assetsStmt = $pdo->query("
    
        SELECT assets.serial_number, assets.device_name, assets.price, assets.status,
               categories.name AS category_name
        FROM assets
        INNER JOIN categories ON assets.category_id = categories.id
        ORDER BY assets.id DESC
    ");

    $totalStmt = $pdo->query("SELECT SUM(price) AS total_value FROM assets");
}

$assets = $assetsStmt->fetchAll();
$totalRow = $totalStmt->fetch();
$totalValue = $totalRow['total_value'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Tracker - Modern Professional</title>
   
    <link rel="stylesheet" href="style-modern.css">
</head>
<body>
    <div class="container">
        <img src="data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22280%22%20height%3D%2260%22%20viewBox%3D%220%200%20280%2060%22%3E%3Cdefs%3E%3ClinearGradient%20id%3D%22grad1%22%20x1%3D%220%25%22%20y1%3D%220%25%22%20x2%3D%22100%25%22%20y2%3D%22100%25%22%3E%3Cstop%20offset%3D%220%25%22%20style%3D%22stop-color%3A%233B82F6%3Bstop-opacity%3A1%22%20%2F%3E%3Cstop%20offset%3D%22100%25%22%20style%3D%22stop-color%3A%231D4ED8%3Bstop-opacity%3A1%22%20%2F%3E%3C%2FlinearGradient%3E%3C%2Fdefs%3E%3C!--%20Icone%20Fond%20--%3E%3Crect%20x%3D%220%22%20y%3D%2210%22%20width%3D%2240%22%20height%3D%2240%22%20rx%3D%2210%22%20fill%3D%22url(%23grad1)%22%2F%3E%3C!--%20Lignes%20de%20stock%20--%3E%3Crect%20x%3D%2210%22%20y%3D%2220%22%20width%3D%2220%22%20height%3D%224%22%20rx%3D%222%22%20fill%3D%22white%22%20opacity%3D%220.9%22%2F%3E%3Crect%20x%3D%2210%22%20y%3D%2228%22%20width%3D%2214%22%20height%3D%224%22%20rx%3D%222%22%20fill%3D%22white%22%20opacity%3D%220.7%22%2F%3E%3Crect%20x%3D%2210%22%20y%3D%2236%22%20width%3D%2218%22%20height%3D%224%22%20rx%3D%222%22%20fill%3D%22white%22%20opacity%3D%220.5%22%2F%3E%3C!--%20Texte%20--%3E%3Ctext%20x%3D%2255%22%20y%3D%2240%22%20font-family%3D%22%27Segoe%20UI%27%2C%20Roboto%2C%20Arial%2C%20sans-serif%22%20font-size%3D%2226%22%20fill%3D%22%231E293B%22%20letter-spacing%3D%22-0.5%22%3EInventory%20%3Ctspan%20font-weight%3D%22800%22%20fill%3D%22%232563EB%22%3ETracker%3C%2Ftspan%3E%3C%2Ftext%3E%3C%2Fsvg%3E" alt="Inventory Tracker Pro Logo" class="logo-header">

        <?php if ($message): ?>
            <p><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <p class="total-value"><strong>Total Inventory Value:</strong> $<?= htmlspecialchars(number_format((float)$totalValue, 2)) ?></p>

        <form method="GET">
            <input type="text" name="search" placeholder="Search by device name or serial number"
                   value="<?= htmlspecialchars($search) ?>">
            <button type="submit">Search</button>
        </form>

        <form method="POST">
            <label>Serial Number</label>
            <input type="text" name="serial_number" required>

            <label>Device Name</label>
            <input type="text" name="device_name" required>

            <label>Price</label>
            <input type="number" step="0.01" name="price" required>

            <label>Status</label>
            <select name="status" required>
                <option value="In Stock">In Stock</option>
                <option value="Deployed">Deployed</option>
                <option value="Under Repair">Under Repair</option>
            </select>

            <label>Category</label>
            <select name="category_id" required>
                <option value="">Select Category</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= htmlspecialchars($category['id']) ?>">
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Add Asset</button>
        </form>

        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>Serial Number</th>
                    <th>Device Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($assets): ?>
                    <?php foreach ($assets as $asset): ?>
                        <tr>
                            <td><?= htmlspecialchars($asset['serial_number']) ?></td>
                            <td><?= htmlspecialchars($asset['device_name']) ?></td>
                            <td><?= htmlspecialchars($asset['category_name']) ?></td>
                            <td>$<?= htmlspecialchars(number_format((float)$asset['price'], 2)) ?></td>
                            <td>
                                <span class="status-<?= strtolower(str_replace(' ', '-', $asset['status'])) ?>">
                                    <?= htmlspecialchars($asset['status']) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No assets found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>