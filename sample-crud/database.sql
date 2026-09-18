-- Run this in phpMyAdmin (SQL tab) or MySQL Workbench
CREATE DATABASE IF NOT EXISTS product_inventory_db;
USE product_inventory_db;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100) NOT NULL,
    category VARCHAR(100) NOT NULL,
    quantity INT NOT NULL DEFAULT 0,
    price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Optional sample data
INSERT INTO products (product_name, category, quantity, price) VALUES
('Wireless Mouse', 'Electronics', 25, 349.00),
('Bond Paper (A4)', 'Office Supplies', 4, 210.50),
('Whiteboard Marker', 'Office Supplies', 40, 25.00);