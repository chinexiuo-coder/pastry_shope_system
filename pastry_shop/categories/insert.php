<?php
include '../includes/db.php';

$name = $_POST['CategoryName'];
$desc = $_POST['Description'];

$stmt = $pdo->prepare("INSERT INTO categories (CategoryName, Description) VALUES (?, ?)");
$stmt->execute([$name, $desc]);

echo json_encode(["message"=>"Category added"]);
?>