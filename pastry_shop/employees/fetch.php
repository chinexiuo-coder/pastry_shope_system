<?php
include '../includes/db.php';

header('Content-Type: application/json');

try {

    if (isset($_GET['id'])) {

        // SINGLE EMPLOYEE (FOR EDIT)
        $stmt = $pdo->prepare("SELECT * FROM employees WHERE EmployeeID = ?");
        $stmt->execute([$_GET['id']]);

        echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));

    } else {

        // ALL EMPLOYEES (FOR DATATABLE)
        $stmt = $pdo->query("SELECT * FROM employees ORDER BY EmployeeID DESC");
        $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // IMPORTANT: DataTables requires "data" key
        echo json_encode([
            "data" => $employees
        ]);
    }

} catch (PDOException $e) {

    echo json_encode([
        "data" => [],
        "error" => $e->getMessage()
    ]);
}
?>