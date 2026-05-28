<?php
include '../includes/db.php';

header('Content-Type: application/json');

try {

    $stmt = $pdo->prepare("
        UPDATE employees SET
        LastName = ?,
        FirstName = ?,
        BirthDate = ?
        WHERE EmployeeID = ?
    ");

    $stmt->execute([
        $_POST['LastName'],
        $_POST['FirstName'],
        $_POST['BirthDate'],
        $_POST['EmployeeID']
    ]);

    echo json_encode([
        "status" => "success",
        "message" => "Employee updated successfully"
    ]);

} catch(PDOException $e){

    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
?>