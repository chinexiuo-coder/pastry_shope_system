<?php

include '../includes/db.php';

$stmt = $pdo->prepare("
INSERT INTO suppliers
(
SupplierName,
ContactName,
Phone,
City,
Coountry,
Address
)

VALUES (?,?,?,?)
");

$stmt->execute([

$_POST['SupplierName'],
$_POST['ContactName'],
$_POST['Phone'],
$_POST['City'],
$_POST['Country'],
$_POST['Address']

]);

echo json_encode([
"message"=>"Supplier added successfully"
]);

?>