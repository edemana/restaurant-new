<?php
session_start();
include "../db/db.php";

// Check if the user is logged in and authorized
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "Unauthorized access.";
    exit();
}

// Check for action parameter
if (!isset($_GET['action'])) {
    echo "No action specified.";
    exit();
}

$action = $_GET['action'];

switch ($action) {
    case 'user':
        // Delete a user
        if (isset($_GET['user_id'])) {
            $user_id = intval($_GET['user_id']);
            $stmt = $conn->prepare("DELETE FROM user WHERE user_id = ?");
            $stmt->bind_param("i", $user_id);
            if ($stmt->execute()) {
                header("Location: ../view/dashboard.php");
                exit();
            } else {
                echo "Failed to delete user.";
            }
        } else {
            echo "User ID not provided.";
        }
        break;

    case 'order':
        // Delete an order
        if (isset($_GET['order_id'])) {
            $order_id = intval($_GET['order_id']);
            $stmt = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
            $stmt->bind_param("i", $order_id);
            if ($stmt->execute()) {
                header("Location: ../view/dashboard.php");
                exit();
            } else {
                echo "Failed to delete order.";
            }
        } else {
            echo "Order ID not provided.";
        }
        break;

    case 'menu_item':
        // Delete a menu item
        if (isset($_GET['item_id'])) {
            $item_id = intval($_GET['item_id']);
            $stmt = $conn->prepare("DELETE FROM menu_items WHERE item_id = ?");
            $stmt->bind_param("i", $item_id);
            if ($stmt->execute()) {
                header("Location: ../view/dashboard.php");
                exit();
            } else {
                echo "Failed to delete menu item.";
            }
        } else {
            echo "Menu item ID not provided.";
        }
        break;

    case 'reservation':
        // Delete a reservation
        if (isset($_GET['reservation_id'])) {
            $reservation_id = intval($_GET['reservation_id']);
            $stmt = $conn->prepare("DELETE FROM reservations WHERE reservation_id = ?");
            $stmt->bind_param("i", $reservation_id);
            if ($stmt->execute()) {
                header("Location: ../view/dashboard.php");
                exit();
            } else {
                echo "Failed to delete reservation.";
            }
        } else {
            echo "Reservation ID not provided.";
        }
        break;

    case "feedback":
        // Delete a feedback
        if (isset($_GET['feedback_id'])) {
            $item_id = intval($_GET['feedback_id']);
            $stmt = $conn->prepare("DELETE FROM feedback WHERE feedback_id = ?");
            $stmt->bind_param("i", $item_id);
            if ($stmt->execute()) {
                header("Location: ../view/dashboard.php");
                exit();
            } else {
                echo "Failed to delete feedback.";
            }
        } else {
            echo "Feedback ID not provided.";
        }
        break;

    default:
        echo "Invalid action.";
        break;
}
?>