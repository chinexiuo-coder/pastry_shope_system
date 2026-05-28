<?php
include '../includes/db.php';

$stmt = $pdo->prepare("
UPDATE shippers SET
ShipperName=?,
Phone=?
WHERE ShipperID=?
");

$stmt->execute([
$_POST['ShipperName'],
$_POST['Phone'],
$_POST['ShipperID']
]);

echo json_encode(["message"=>"Shipper updated"]);
?>