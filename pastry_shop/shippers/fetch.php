<?php
include '../includes/db.php';
header('Content-Type: application/json');

/* =========================
   IF EDIT (GET 1 RECORD)
========================= */
if(isset($_GET['id'])){

    $stmt = $pdo->prepare("SELECT * FROM shippers WHERE ShipperID = ?");
    $stmt->execute([$_GET['id']]);

    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
    exit;
}

/* =========================
   IF TABLE LOAD (ALL DATA)
========================= */
$stmt = $pdo->query("SELECT * FROM shippers ORDER BY ShipperID DESC");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* IMPORTANT: DataTables format */
echo json_encode([
    "data" => $data
]);