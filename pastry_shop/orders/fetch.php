<?php

include '../includes/db.php';

header('Content-Type: application/json');

/* EDIT FETCH */
if(isset($_GET['id'])){

    $stmt = $pdo->prepare("
        SELECT * FROM orders
        WHERE OrderID=?
    ");

    $stmt->execute([$_GET['id']]);

    echo json_encode(
        $stmt->fetch(PDO::FETCH_ASSOC)
    );

    exit;
}

/* TABLE FETCH */
$stmt = $pdo->query("
    SELECT * FROM orders
    ORDER BY OrderID DESC
");

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "data" => $data
]);

?>