<?php
include '../includes/db.php';

$stmt = $pdo->prepare("DELETE FROM shippers WHERE ShipperID=?");
$stmt->execute([$_POST['id']]);

echo json_encode(["message"=>"Shipper deleted"]);
?>