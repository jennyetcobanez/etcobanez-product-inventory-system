<?php
// index.php - Read: display all products
include 'db.php';

$sql = "SELECT * FROM products ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Product Inventory System</title>
<style>
    body { font-family: Arial, sans-serif; background: #f4f6f8; margin: 0; padding: 30px; }
    .container { max-width: 950px; margin: auto; background: #fff; padding: 25px 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    h1 { color: #2c3e50; }
    .btn { display: inline-block; padding: 8px 14px; border-radius: 5px; text-decoration: none; font-size: 14px; color: #fff; }
    .btn-add { background: #27ae60; margin-bottom: 15px; }
    .btn-edit { background: #2980b9; }
    .btn-delete { background: #c0392b; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { padding: 10px 12px; border-bottom: 1px solid #eee; text-align: left; }
    th { background: #2c3e50; color: #fff; }
    tr:hover { background: #f9f9f9; }
    .actions a { margin-right: 6px; }
    .empty { padding: 20px; text-align: center; color: #888; }
    .low-stock { color: #c0392b; font-weight: bold; }
</style>
</head>
<body>
<div class="container">
    <h1>Product Inventory</h1>
    <a class="btn btn-add" href="create.php">+ Add New Product</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Price (₱)</th>
            <th>Actions</th>
        </tr>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['product_name']) ?></td>
                <td><?= htmlspecialchars($row['category']) ?></td>
                <td class="<?= $row['quantity'] <= 5 ? 'low-stock' : '' ?>">
                    <?= htmlspecialchars($row['quantity']) ?>
                </td>
                <td><?= number_format($row['price'], 2) ?></td>
                <td class="actions">
                    <a class="btn btn-edit" href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                    <a class="btn btn-delete" href="delete.php?id=<?= $row['id'] ?>"
                       onclick="return confirm('Delete this product?');">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="6" class="empty">No products found.</td></tr>
        <?php endif; ?>
    </table>
</div>
</body>
</html>
<?php $conn->close(); ?>