<?php

include '../includes/db.php';

$stmt = $pdo->prepare("
    DELETE FROM products WHERE ProductID=?
");

$stmt->execute([$_POST['id']]);

echo json_encode([
    "message" => "Product deleted successfully"
]);

?>