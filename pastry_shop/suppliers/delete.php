<?php

include '../includes/db.php';

$stmt = $pdo->prepare("
DELETE FROM suppliers
WHERE SupplierID=?
");

$stmt->execute([
$_POST['id']
]);

echo json_encode([
"message"=>"Supplier deleted successfully"
]);

?>