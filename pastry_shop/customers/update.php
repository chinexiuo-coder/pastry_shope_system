<?php

include '../includes/db.php';

$stmt = $pdo->prepare("
    UPDATE customers SET
        CustomerName=?,
        ContactName=?,
        Address=?,
        City=?,
        Country=?
    WHERE CustomerID=?
");

$stmt->execute([
    $_POST['CustomerName'],
    $_POST['ContactName'],
    $_POST['Address'],
    $_POST['City'],
    $_POST['Country'],
    $_POST['CustomerID']
]);

echo json_encode([
    "message" => "Updated successfully"
]);

?>