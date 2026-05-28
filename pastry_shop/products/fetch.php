<?php

include '../includes/db.php';

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $stmt = $pdo->prepare("
        SELECT *
        FROM products
        WHERE ProductID=?
    ");

    $stmt->execute([$id]);

    echo json_encode($stmt->fetchAll());

}else{

    $stmt = $pdo->query("
        SELECT
        products.*,
        categories.CategoryName
        FROM products
        LEFT JOIN categories
        ON products.CategoryID = categories.CategoryID
    ");

    echo json_encode([
        "data" => $stmt->fetchAll()
    ]);

}