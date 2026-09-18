<?php
// edit.php - Update: edit an existing product
include 'db.php';

$error = "";
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST['id']);
    $product_name = trim($_POST['product_name']);
    $category = trim($_POST['category']);
    $quantity = intval($_POST['quantity']);
    $price = floatval($_POST['price']);

    if ($product_name === "" || $category === "") {
        $error = "Product name and category are required.";
    } else {
        $stmt = $conn->prepare("UPDATE products SET product_name=?, category=?, quantity=?, price=? WHERE id=?");
        $stmt->bind_param("ssidi", $product_name, $category, $quantity, $price, $id);
        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Fetch existing record to populate the form
$stmt = $conn->prepare("SELECT * FROM products WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

if (!$product) {
    die("Product not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Product</title>
<style>
    body { font-family: Arial, sans-serif; background: #f4f6f8; margin: 0; padding: 30px; }
    .container { max-width: 500px; margin: auto; background: #fff; padding: 25px 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    h1 { color: #2c3e50; }
    label { display: block; margin-top: 12px; font-weight: bold; color: #444; }
    input { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
    .btn { display: inline-block; margin-top: 18px; padding: 9px 16px; border: none; border-radius: 5px; color: #fff; background: #2980b9; cursor: pointer; text-decoration: none; }
    .back { margin-left: 8px; color: #555; text-decoration: none; }
    .error { color: #c0392b; margin-top: 10px; }
</style>
</head>
<body>
<div class="container">
    <h1>Edit Product</h1>
    <?php if ($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
    <form method="POST" action="edit.php">
        <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
        <label>Product Name</label>
        <input type="text" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>" required>
        <label>Category</label>
        <input type="text" name="category" value="<?= htmlspecialchars($product['category']) ?>" required>
        <label>Quantity</label>
        <input type="number" name="quantity" min="0" value="<?= htmlspecialchars($product['quantity']) ?>" required>
        <label>Price</label>
        <input type="number" name="price" step="0.01" min="0" value="<?= htmlspecialchars($product['price']) ?>" required>
        <button class="btn" type="submit">Update</button>
        <a class="back" href="index.php">Cancel</a>
    </form>
</div>
</body>
</html>