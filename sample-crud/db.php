<?php
// db.php - Database connection

$host = "localhost";
$user = "root";     // default XAMPP MySQL username
$pass = "";          // default XAMPP MySQL password (blank)
$dbname = "product_inventory_db";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>