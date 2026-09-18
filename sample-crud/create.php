<?php
// create.php - Create: add a new product
include 'db.php';

$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $product_name = trim($_POST['product_name']);
    $category = trim($_POST['category']);
    $quantity = intval($_POST['quantity']);
    $price = floatval($_POST['price']);

    if ($product_name === "" || $category === "") {
        $error = "Product name and category are required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO products (product_name, category, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssid", $product_name, $category, $quantity, $price);
        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Product</title>
<style>
    body { font-family: Arial, sans-serif; background: #f4f6f8; margin: 0; padding: 30px; }
    .container { max-width: 500px; margin: auto; background: #fff; padding: 25px 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    h1 { color: #2c3e50; }
    label { display: block; margin-top: 12px; font-weight: bold; color: #444; }
    input { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
    .btn { display: inline-block; margin-top: 18px; padding: 9px 16px; border: none; border-radius: 5px; color: #fff; background: #27ae60; cursor: pointer; text-decoration: none; }
    .back { margin-left: 8px; color: #555; text-decoration: none; }
    .error { color: #c0392b; margin-top: 10px; }
</style>
</head>
<body>
<div class="container">
    <h1>Add New Product</h1>
    <?php if ($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
    <form method="POST" action="create.php">
        <label>Product Name</label>
        <input type="text" name="product_name" required>
        <label>Category</label>
        <input type="text" name="category" required>
        <label>Quantity</label>
        <input type="number" name="quantity" min="0" value="0" required>
        <label>Price</label>
        <input type="number" name="price" step="0.01" min="0" value="0.00" required>
        <button class="btn" type="submit">Save</button>
        <a class="back" href="index.php">Cancel</a>
    </form>
</div>
</body>
</html>