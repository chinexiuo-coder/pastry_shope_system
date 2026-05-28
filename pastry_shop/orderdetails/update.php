<?php

include '../includes/db.php';

$stmt = $pdo->prepare("
    UPDATE orderdetails
    SET

    OrderID = ?,
    ProductID = ?,
    Quantity = ?

    WHERE OrderDetailID = ?
");

$result = $stmt->execute([

    $_POST['OrderID'],
    $_POST['ProductID'],
    $_POST['Quantity'],
    $_POST['OrderDetailID']

]);

echo json_encode([

    "success" => $result,
    "message" => "Order Detail updated successfully"

]);

?>