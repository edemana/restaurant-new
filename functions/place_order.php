<?php
session_start();
include "../db/db.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../view/akornorlogin.php");
    exit();
}

// Validate and sanitize POST data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $menu_item_id = filter_input(INPUT_POST, 'menu_item_id', FILTER_VALIDATE_INT);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
    $payment_method = filter_input(INPUT_POST, 'payment_method', FILTER_SANITIZE_STRING);

    if (!$menu_item_id || !$quantity || !$payment_method) {
        echo "Invalid input. Please try again.";
        exit();
    }

    // Start order transaction
    $conn->begin_transaction();
    try {
        // Insert the order into the database
        $stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, status, payment_method) VALUES (?, 0, 'pending', ?)");
        $stmt->bind_param("is", $user_id, $payment_method);
        $stmt->execute();
        $order_id = $stmt->insert_id;

        // Fetch item details and add to order details
        $stmt = $conn->prepare("SELECT price FROM menu_items WHERE item_id = ?");
        $stmt->bind_param("i", $menu_item_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $price_per_item = $row['price'];
            $total_price = $price_per_item * $quantity;

            // Insert order details
            $stmt = $conn->prepare("INSERT INTO order_details (order_id, item_id, quantity, price) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiid", $order_id, $menu_item_id, $quantity, $price_per_item);
            $stmt->execute();

            // Update total price in orders table
            $stmt = $conn->prepare("UPDATE orders SET total_price = ? WHERE order_id = ?");
            $stmt->bind_param("di", $total_price, $order_id);
            $stmt->execute();

            $conn->commit(); // Commit transaction
            header("Location: ../view/dashboard.php");
            exit();
        } else {
            throw new Exception("Item not found.");
        }
    } catch (Exception $e) {
        $conn->rollback(); // Rollback transaction
        echo "Error placing order: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
}
?>