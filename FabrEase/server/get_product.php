<?php 

include('connect.php');

$stmt = $conn->prepare("SELECT * FROM products LIMIT 4");

$stmt->execute();

$get_product = $stmt->get_result();



?>