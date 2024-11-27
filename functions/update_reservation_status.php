<?php
session_start();
include "../db/db.php";

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../view/akornorlogin.php");
    exit();
}

$reservation_id = $_GET['id'];
$new_status = $_POST['status'];

// Update reservation status
$stmt = $conn->prepare("UPDATE reservations SET status = ? WHERE reservation_id = ?");
$stmt->bind_param("si", $new_status, $reservation_id);
if ($stmt->execute()) {
    header("Location: ../view/dashboard.php");
} else {
    echo "Failed to update reservation status.";
}
?>

<!-- Modal for Updating a Reservation -->
<div id="addItemModal" class="modal" style="display: none;">
                <div class="modal-content">
                    <span class="close" onclick="closeAddItemModal()">&times;</span>
                    <h3>Update Reservation Status</h3>
                    <form action="../functions/update_reservation_status.php" method="POST" class="add-menu-form">
                        <label for="reservation_id">Reservation ID:</label>
                        <input type="hidden" id=<?= $row['reservation_id'] ?> name="reservation_id"
                            value="<?= $row['reservation_id'] ?>">

                        <label for="availability">Status:</label>
                        <select id="availability" name="availability">
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>

                        <button type="submit">Update</button>
                    </form>
                </div>
            </div>
