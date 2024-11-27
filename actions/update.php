<?php
session_start();
include "../db/db.php";
// echo $_SESSION['user_id'];

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
        // Update user details
        //var_dump($_POST);
        if (isset($_SESSION['user_id'], $_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['role'])) {
            $user_id = intval($_POST['user_id']);
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $role = $_POST['role'];


            $stmt = $conn->prepare("UPDATE user SET fname = ?, lname = ?, email = ?, role = ? WHERE user_id = ?");
            $stmt->bind_param("sssss", $fname, $lname, $email, $role, $user_id);
            if ($stmt->execute()) {
                header("Location: ../view/dashboard.php");
            } else {
                echo "Failed to update user.";
            }
        } else {
            header('Location: ../view/dashboard.php');
        }
        break;

    case 'menu_item':
        // Update menu item details
        if (isset($_POST['item_id'], $_POST['name'], $_POST['price'], $_POST['availability'])) {
            $item_id = intval($_POST['item_id']);
            $name = $_POST['name'];
            $price = floatval($_POST['price']);
            $availability = intval($_POST['availability']);

            $stmt = $conn->prepare("UPDATE menu_items SET name = ?, price = ?, availability = ? WHERE item_id = ?");
            $stmt->bind_param("sdii", $name, $price, $availability, $item_id);
            if ($stmt->execute()) {
                echo "Menu item updated successfully.";
            } else {
                echo "Failed to update menu item.";
            }
        } else {
            echo "Required data not provided.";
        }
        break;

    case 'order':
        // Update order status
        if (isset($_POST['order_id'], $_POST['status'])) {
            $order_id = intval($_POST['order_id']);
            $status = $_POST['status'];

            $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
            $stmt->bind_param("si", $status, $order_id);
            if ($stmt->execute()) {
                echo "Order status updated successfully.";
            } else {
                echo "Failed to update order.";
            }
        } else {
            echo "Required data not provided.";
        }
        break;

    case "reservation":
        // Update reservation status
        if (isset($_POST['reservation_id'], $_POST['status'])) {
            $order_id = intval($_POST['reservation_id']);
            $status = $_POST['status'];

            $stmt = $conn->prepare("UPDATE reservations SET status = ? WHERE reservation_id = ?");
            $stmt->bind_param("si", $status, $order_id);
            if ($stmt->execute()) {
                echo "Reservation status updated successfully.";
            } else {
                echo "Failed to update reservation.";
            }
        } else {
            echo "Required data not provided.";
        }
        break;

    case "feedback":
        // Update feedback status
        if (isset($_POST['feedback_id'], $_POST['user_id'], $_POST['item_id'], $_POST['rating'], $_POST['comments'], $_POST['created_at'])) {
            $order_id = intval($_POST['feedback_id']);
            $user_id = intval($_POST['user_id']);
            $item_id = intval($_POST['item_id']);
            $rating = intval($_POST['rating']);
            $comments = $_POST['comments'];
            $created_at = $_POST['created_at'];


            $stmt = $conn->prepare("UPDATE feedback SET rating = ?, comments = ?, user_id = ?, item_id = ?, created_at = ? WHERE feedback_id = ?");
            $stmt->bind_param("iisss", $user_id, $item_id, $rating, $comments, $created_at);
            if ($stmt->execute()) {
                echo "Feedback status updated successfully.";
            } else {
                echo "Failed to update feedback.";
            }
        } else {
            echo "Required data not provided.";
        }
        break;


    default:
        echo "Invalid action.";
        break;
}
?>