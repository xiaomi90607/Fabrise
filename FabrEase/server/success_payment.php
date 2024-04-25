<?php
session_start();

include('connect.php');

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $order_status = "paid";
    $user_id = $_SESSION['user_id'];
    $payment_date = date('Y-m-d H:i:s');

    // Change order status to 'paid'
    $stmt = $conn->prepare("UPDATE orders SET order_status = ? WHERE order_id = ?");
    $stmt->bind_param('si', $order_status, $order_id);
    $stmt->execute();
    $stmt->close();

    // Store payment information
    $stmt1 = $conn->prepare("INSERT INTO payments (order_id, user_id, payment_date) VALUES (?, ?, ?)");
    $stmt1->bind_param('iis', $order_id, $user_id, $payment_date);
    if ($stmt1->execute()) {
        $stmt1->close();

        // Redirect to user account with success message
        header("location: ../account.php?payment_message=paid successfully");
        exit;
    } else {
        // If there is an error in executing the statement, redirect to index.php
        header("location: index.php");
        exit;
    }
} else {
    // If transaction_id or order_id is not set, redirect to index.php
    header("location: index.php");
    exit;
}

?>
