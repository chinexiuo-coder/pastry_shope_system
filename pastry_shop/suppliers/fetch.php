<?php
include '../includes/db.php';
header('Content-Type: application/json');

if(isset($_GET['id'])){

    $stmt = $pdo->prepare("SELECT * FROM suppliers WHERE SupplierID=?");
    $stmt->execute([$_GET['id']]);

    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
    exit;
}

$stmt = $pdo->query("SELECT * FROM suppliers ORDER BY SupplierID DESC");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "data" => $data
]);
?>