<?php

include '../includes/db.php';

header('Content-Type: application/json');

$stmt = $pdo->prepare("

UPDATE orders SET

    CustomerID=?,
    EmployeeID=?,
    OrderDate=?,
    ShipperID=?

WHERE OrderID=?

");

$result = $stmt->execute([

    $_POST['CustomerID'],
    $_POST['EmployeeID'],
    $_POST['OrderDate'],
    $_POST['ShipperID'],
    $_POST['OrderID']

]);

echo json_encode([

    "success" => $result,
    "message" => "Order updated successfully"

]);

?>