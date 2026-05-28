<?php

include '../includes/db.php';

$stmt = $pdo->prepare("
    INSERT INTO orderdetails
    (
        OrderID,
        ProductID,
        Quantity
    )
    VALUES
    (
        ?,
        ?,
        ?
    )
");

$result = $stmt->execute([

    $_POST['OrderID'],
    $_POST['ProductID'],
    $_POST['Quantity']

]);

echo json_encode([

    "success" => $result,
    "message" => "Order Detail added successfully"

]);

?>