<?php
include '../includes/db.php';

$stmt = $pdo->prepare("
INSERT INTO shippers(ShipperName,Phone)
VALUES (?,?)
");

$stmt->execute([
$_POST['ShipperName'],
$_POST['Phone']
]);

echo json_encode(["message"=>"Shipper added"]);
?>
