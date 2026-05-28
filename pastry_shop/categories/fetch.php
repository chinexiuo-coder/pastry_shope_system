<?php
include '../includes/db.php';

header('Content-Type: application/json');

/* IF EDIT MODE (single record) */
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM categories WHERE CategoryID = ?");
    $stmt->execute([$id]);

    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

/* LOAD ALL DATA */
$stmt = $pdo->query("SELECT * FROM categories ORDER BY CategoryID DESC");

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);