<?php

include '../includes/db.php';

$productName = $_POST['ProductName'];
$categoryID = $_POST['CategoryID'];
$unit = $_POST['Unit'];
$price = $_POST['Price'];

$sql = "INSERT INTO products
(ProductName, CategoryID, Unit, Price)
VALUES
(?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $productName,
    $categoryID,
    $unit,
    $price
]);

echo json_encode([
    "message" => "Product added successfully"
]);