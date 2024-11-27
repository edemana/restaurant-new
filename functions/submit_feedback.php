<?php
session_start();
include "../db/db.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
    header("Location: ../view/akornorlogin.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$category = $_POST['category'] ?? null;
$rating = $_POST['rating'] ?? null;
$comments = $_POST['comments'] ?? null;

// Debugging: Check received POST data
if (is_null($category)) {
    die("Category is missing. POST data: " . print_r($_POST, true));
}

// Validate inputs
if (!in_array($category, ['Customer Service', 'Food Quality', 'Pool Table'])) {
    die("Invalid category selected.");
}
if (is_null($rating) || $rating < 1 || $rating > 5) {
    die("Invalid rating provided.");
}

// Insert feedback into the database
$stmt = $conn->prepare("INSERT INTO feedback (user_id, category, rating, comments) VALUES (?, ?, ?, ?)");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("isis", $user_id, $category, $rating, $comments);

if ($stmt->execute()) {
    header("Location: ../view/dashboard.php?feedback=success");
} else {
    die("Failed to submit feedback: " . $stmt->error);
}

$stmt->close();
?>