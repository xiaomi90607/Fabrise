<?php 

include('connect.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='fabric' LIMIT 4");

$stmt->execute();

$get_specific_product = $stmt->get_result();



?>