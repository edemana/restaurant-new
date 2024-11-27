<?php
session_start();
include "../db/db.php";

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../view/akornorlogin.php");
    exit();
}

// Identify the user's role
$role = $_SESSION['role'];


if ($role === 'admin') {
    // Fetch admin data
    $menuQuery = "SELECT * FROM menu_items";
    $menuResult = $conn->query($menuQuery);

} elseif ($role === 'customer') {
    $user_id = $_SESSION['user_id'];

    // Fetch customer data
    $menuQuery = "SELECT * FROM menu_items WHERE availability = 1";
    $menuResult = $conn->query($menuQuery);

} else {
    echo "Invalid role.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <title>Menu</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>
    <?php include "../utils/navigation.php"; ?>
    <div class="dashboard-container">
        <div class="main-content">
            <h1>Welcome!</h1>

            <!-- Menu Section -->
            <section class="menu-section">
                <div class="card">
                    <h2>Menu</h2>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Item ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Order</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $menuResult->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= $row['item_id'] ?></td>
                                    <td><?= htmlspecialchars($row['name']) ?></td>
                                    <td><?= htmlspecialchars($row['description']) ?></td>
                                    <td><?= $row['price'] ?></td>
                                    <td><?= htmlspecialchars($row['category']) ?></td>
                                    <td>
                                        <button onclick="confirmPlaceOrder(<?= $row['item_id'] ?>)">Order</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
    <script src="../assets/javascript/navigation.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
        function confirmPlaceOrder(item_id) {

            window.location.href = "../view/order.php?item_id=" + item_id;
        };

    </script>

</body>

</html>