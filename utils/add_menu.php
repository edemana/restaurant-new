<?php
session_start();
include "../db/db.php";

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../view/akornorlogin.php");
    exit();
}

// Get form inputs
$name = $_POST['name'] ?? null;
$description = $_POST['description'] ?? null;
$price = $_POST['price'] ?? null;
$category = $_POST['category'] ?? null;
$availability = $_POST['availability'] ?? 1; // Default to available

// Validate inputs
if (empty($name) || empty($price)) {
    die("Name and price are required fields.");
}

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO menu_items (name, description, price, category, availability) VALUES (?, ?, ?, ?, ?)");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("ssdsi", $name, $description, $price, $category, $availability);

// Execute and check for success
if ($stmt->execute()) {
    echo "Menu item added successfully!";
    header("Location: ../view/dashboard.php?menu_add=success");
} else {
    die("Failed to add menu item: " . $stmt->error);
}

?>