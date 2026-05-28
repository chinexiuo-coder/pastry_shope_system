<?php
include '../includes/db.php';

$id = $_POST['id'];

$stmt = $pdo->prepare("DELETE FROM categories WHERE CategoryID=?");
$stmt->execute([$id]);

echo json_encode(["message"=>"Category deleted"]);
?>