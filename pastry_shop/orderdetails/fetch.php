<?php

include '../includes/db.php';

header('Content-Type: application/json');

/* FETCH SINGLE */
if(isset($_GET['id'])){

    $stmt = $pdo->prepare("
        SELECT * 
        FROM orderdetails
        WHERE OrderDetailID = ?
    ");

    $stmt->execute([$_GET['id']]);

    echo json_encode(
        $stmt->fetch(PDO::FETCH_ASSOC)
    );

    exit;
}

/* FETCH ALL */
$stmt = $pdo->query("
    SELECT * 
    FROM orderdetails
    ORDER BY OrderDetailID DESC
");

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "data" => $data
]);

?>