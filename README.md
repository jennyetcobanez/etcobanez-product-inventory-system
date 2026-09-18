# etcobanez-product-inventory-system
# Product Inventory System

A simple PHP + MySQL CRUD application for managing product inventory,
built for the "GitHub Setup and Sample CRUD Application" activity.

## Files (inside `sample-crud/`)
- `db.php` – database connection
- `index.php` – Read: lists all products
- `create.php` – Create: add a new product
- `edit.php` – Update: edit an existing product
- `delete.php` – Delete: remove a product
- `database.sql` – creates the database/table and sample data

## Features
- Add, view, edit, and delete products
- Tracks product name, category, quantity, and price
- Flags low-stock items (quantity ≤ 5) in the product list

## Setup

1. Start **Apache** and **MySQL** in XAMPP.
2. Go to `http://localhost/phpmyadmin` → **SQL** tab → run `sample-crud/database.sql`.
   This creates the `product_inventory_db` database and `products` table.
3. Copy this repository folder into your XAMPP `htdocs` folder.
4. Visit:
   `http://localhost/etcobanez-product-inventory-system/sample-crud/index.php`

## Branch

The CRUD application lives on the `sample-crud` branch, not on `main`.

## Tools Used
- Visual Studio Code
- Git
- XAMPP (Apache, PHP, MySQL, phpMyAdmin)
- MySQL Workbench
- GitHub
