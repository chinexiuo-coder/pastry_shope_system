<?php

include '../includes/db.php';

$stmt = $pdo->prepare("
    DELETE FROM orderdetails
    WHERE OrderDetailID = ?
");

$result = $stmt->execute([

    $_POST['id']

]);

echo json_encode([

    "success" => $result,
    "message" => "Order Detail deleted successfully"

]);

?>