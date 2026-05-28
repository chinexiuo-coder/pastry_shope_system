<?php

include '../includes/db.php';

$id = $_POST['ProductID'];

$productName = $_POST['ProductName'];
$categoryID = $_POST['CategoryID'];
$unit = $_POST['Unit'];
$price = $_POST['Price'];

$sql = "UPDATE products SET

ProductName=?,
CategoryID=?,
Unit=?,
Price=?

WHERE ProductID=?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $productName,
    $categoryID,
    $unit,
    $price,
    $id
]);

echo json_encode([
    "message" => "Product updated successfully"
]);