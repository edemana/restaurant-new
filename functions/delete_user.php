<?php
session_start();
require_once "../db/db.php";


function deleteUser($user_id)
{
    // Include database connection
    include "../db/db.php";

    // Check if user_id is valid
    if (!is_numeric($user_id) || $user_id <= 0) {
        return "Invalid User ID.";
    }

    // SQL to delete the user
    $query = "DELETE FROM user WHERE user_id = ?";

    if ($stmt = $conn->prepare($query)) {
        // Bind the user_id parameter
        $stmt->bind_param("i", $user_id);

        // Execute the query
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $stmt->close();
                $conn->close();
                return "User deleted successfully.";
            } else {
                $stmt->close();
                $conn->close();
                return "No user found with the provided ID.";
            }
        } else {
            $stmt->close();
            $conn->close();
            return "Error executing query: " . $stmt->error;
        }
    } else {
        $conn->close();
        return "Error preparing statement: " . $conn->error;

    }
}

if (isset($_POST['user_id'])) {
    $result = deleteUser($_POST['user_id']);
    $_SESSION['message'] = $result;
    header('Location: ../view/admin/dashboard.php'); // Adjust this path to your admin page
    exit();
} else if (isset($_GET['user_id'])) {
    $result = deleteUser($_GET['user_id']);
    $_SESSION['message'] = $result;
    header('Location: ../view/admin/dashboard.php'); // Adjust this path to your admin page
    exit();
}
