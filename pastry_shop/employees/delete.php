<?php
include '../includes/db.php';
header('Content-Type: application/json');

try {

$stmt = $pdo->prepare("DELETE FROM employees WHERE EmployeeID=?");
$stmt->execute([$_POST['id']]);

echo json_encode([
    "status" => "success",
    "message" => "Employee deleted successfully"
]);

} catch(Exception $e){
echo json_encode([
    "status" => "error",
    "message" => $e->getMessage()
]);
}
?>