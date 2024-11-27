<?php
session_start();
include "../db/db.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
    header("Location: ../view/akornorlogin.php");
    exit();
}

$order_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Delete the order only if it belongs to the logged-in user and is pending
$stmt = $conn->prepare("DELETE FROM orders WHERE order_id = ? AND user_id = ? AND status = 'pending'");
$stmt->bind_param("ii", $order_id, $user_id);
if ($stmt->execute()) {
    header("Location: ../view/dashboard.php");
} else {
    echo "Failed to cancel the order.";
}
?>