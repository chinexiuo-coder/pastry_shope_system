<?php

include '../includes/db.php';

if(isset($_GET['id'])) {

    $stmt = $pdo->prepare("SELECT * FROM customers WHERE CustomerID = ?");
    $stmt->execute([$_GET['id']]);

    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

} else {

    $stmt = $pdo->query("SELECT * FROM customers");

    echo json_encode([
        "data" => $stmt->fetchAll(PDO::FETCH_ASSOC)
    ]);

}

?>