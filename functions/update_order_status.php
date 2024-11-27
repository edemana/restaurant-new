<?php
session_start();
include "../db/db.php";

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../view/akornorlogin.php");
    exit();
}

// Fetch order ID and new status
$order_id = $_POST['order_id'];
$new_status = $_POST['status'];

// Validate input
if (empty($order_id) || empty($new_status)) {
    echo "Invalid input.";
    exit();
}

// Update order status
$stmt = $conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
$stmt->bind_param("si", $new_status, $order_id);

if ($stmt->execute()) {
    header("Location: ../view/dashboard.php?update=success");
    exit();
} else {
    echo "Failed to update order status.";
}
?>