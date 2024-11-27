<?php
session_start();
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="UTF-8">
    <title>Update User</title>
    <link rel="stylesheet" href="../assets/css/order.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>
    <form action="../actions/update.php?action=user" method="post">
        <header>
            Update User
        </header>

        <label for="fname">First
            Name:</label>
        <input type="text" id="fname" name="fname" required>

        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name="lname" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="role" class="form-label">Role:</label>
        <select id="ReviewType" name="Review Type" required class="form-input">
            <option value="admin">Admin</option>
            <option value="customer">Customer</option>
        </select>

        <input type="hidden" id="user_id" name="user_id"
            value="<?php echo htmlspecialchars($_GET['user_id'], ENT_QUOTES, 'UTF-8'); ?>">

        <button type="submit">Update User</button>
    </form>

</body>


</html>