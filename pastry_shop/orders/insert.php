<?php

include '../includes/db.php';

header('Content-Type: application/json');

try{

$stmt = $pdo->prepare("

INSERT INTO orders
(
    CustomerID,
    EmployeeID,
    OrderDate,
    ShipperID
)

VALUES
(
    ?, ?, ?, ?
)

");

$result = $stmt->execute([

    $_POST['CustomerID'],
    $_POST['EmployeeID'],
    $_POST['OrderDate'],
    $_POST['ShipperID']

]);

echo json_encode([

    "success" => true,
    "message" => "Order added successfully"

]);

}catch(PDOException $e){

echo json_encode([

    "success" => false,
    "message" => $e->getMessage()

]);

}

?>