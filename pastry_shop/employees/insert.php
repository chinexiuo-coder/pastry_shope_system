<?php
include '../includes/db.php';

header('Content-Type: application/json');

try {

    $stmt = $pdo->prepare("
        INSERT INTO employees (LastName, FirstName, BirthDate)
        VALUES (?, ?, ?)
    ");

    $stmt->execute([
        $_POST['LastName'],
        $_POST['FirstName'],
        $_POST['BirthDate']
    ]);

    echo json_encode([
        "status" => "success",
        "message" => "Employee added successfully"
    ]);

} catch (PDOException $e) {

    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
?>