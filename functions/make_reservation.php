<?php
session_start();
include "../db/db.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
    header("Location: ../view/akornorlogin.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch date and time from the form
$date = $_POST['date']; 
$time = $_POST['time']; 

// Merge date and time into a single datetime value
$reservation_time = $date . ' ' . $time;

// Validate the merged reservation time (ensure it's in the future)
if (strtotime($reservation_time) < time()) {
    echo "Reservation time must be in the future.";
    exit();
}

$number_of_people = $_POST['number_of_people'];

// Insert the reservation into the database
$stmt = $conn->prepare("INSERT INTO reservations (user_id, reservation_time, number_of_people, status) VALUES (?, ?, ?, 'pending')");
$stmt->bind_param("isi", $user_id, $reservation_time, $number_of_people);

if ($stmt->execute()) {
    // Redirect to the dashboard with success message
    header("Location: ../view/dashboard.php");
    exit();
} else {
    echo "Failed to make a reservation. Please try again.";
}

?>