<?php
include '../includes/db.php';

$id = $_POST['CategoryID'];
$name = $_POST['CategoryName'];
$desc = $_POST['Description'];

$stmt = $pdo->prepare("
    UPDATE categories 
    SET CategoryName = ?, Description = ?
    WHERE CategoryID = ?
");

$stmt->execute([$name, $desc, $id]);

echo json_encode([
    "message" => "Category updated successfully"
]);
?>