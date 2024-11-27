<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="UTF-8">
    <title>Update Reservation</title>
    <link rel="stylesheet" href="../assets/css/order.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>
    <form action="../actions/update.php?action=reservation" method="post">
        <header>
            Update Reservation
        </header>

        <label for="reservation_time">Reservation Date and Time:</label>
        <input type="datetime-local" id="reservation_time" name="reservation_time" required>

        <label for="number_of_people">Number of Guests:</label>
        <input type="number" id="number_of_people" name="number_of_people" min="1" max="20" required>

        <label for="status">Status:</label>
        <select id="status" name="status" required class="form-input">
            <option value="pending">Pending</option>
            <option value="confirmed">Confirmed</option>
            <option value="cancelled">Cancelled</option>
            <option value="completed">Completed</option>
        </select>

        <input type="hidden" id="reservation_id" name="reservation_id" 
            value="<?php echo htmlspecialchars($_GET['reservation_id'], ENT_QUOTES, 'UTF-8'); ?>">

        <input type="hidden" id="user_id" name="user_id" 
            value="<?php echo htmlspecialchars($_SESSION['user_id'], ENT_QUOTES, 'UTF-8'); ?>">

        <button type="submit">Update Reservation</button>
    </form>

</body>


</html>