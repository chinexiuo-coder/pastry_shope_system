<?php

include '../includes/db.php';

header('Content-Type: application/json');

try {

    if(!isset($_POST['id']) || empty($_POST['id'])) {
        echo json_encode([
            "message" => "No ID received"
        ]);
        exit;
    }

    $id = $_POST['id'];

    // DEBUG (you can remove later)
    file_put_contents("debug.txt", $id);

    $stmt = $pdo->prepare("DELETE FROM customers WHERE CustomerID = ?");

    $stmt->execute([$id]);

    $rows = $stmt->rowCount();

    if($rows > 0) {

        echo json_encode([
            "message" => "Deleted successfully"
        ]);

    } else {

        echo json_encode([
            "message" => "No record deleted (ID not found)"
        ]);

    }

} catch(Exception $e) {

    echo json_encode([
        "message" => "Error: " . $e->getMessage()
    ]);

}

?>