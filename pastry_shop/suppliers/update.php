<?php
include '../includes/db.php';

$stmt = $pdo->prepare("
UPDATE suppliers SET 
SupplierName=?,
ContactName=?,
Phone=?,
City=?,
Country=?,
Address=?
WHERE SupplierID=?
");

$result = $stmt->execute([
$_POST['SupplierName'],
$_POST['ContactName'],
$_POST['Phone'],
$_POST['City'],
$_POST['Country'],
$_POST['Address'],
$_POST['SupplierID']
]);

echo json_encode([
"success" => $result,
"message" => "Supplier updated successfully"
]);
?>