<?php

include '../includes/db.php';

header('Content-Type: application/json');

if(isset($_POST['id'])) {

    // delete child first (IMPORTANT)
    $pdo->prepare("DELETE FROM orderdetails WHERE OrderID=?")->execute([$_POST['id']]);

    $pdo->prepare("DELETE FROM orders WHERE OrderID=?")->execute([$_POST['id']]);

    echo json_encode(["message" => "Order deleted"]);

} else {

    echo json_encode(["message" => "No ID received"]);

}

?>