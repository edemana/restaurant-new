<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="../assets/css/order.css">
    <link rel="shortcut icon" href="../assets/images/favicon.ico" type="image/x-icon">

    <style>

    </style>
</head>

<body>
    <?php include "../view/menu.php"; ?>
    <form action="../functions/place_order.php" method="post" data-aos="fade-right" data-aos-duration="2000">
        <header>
            <h1>Order Form</h1>
            <p>Place your orders and check out the amazing food on our menu today</p>
        </header>

        <label for="menu_item_id">Select Menu Item:</label>
        <select id="menu_item_id" name="menu_item_id" required>
            <?php
            include "../db/db.php";
            $result = $conn->query("SELECT item_id, name FROM menu_items WHERE availability = 1");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['item_id']}'>{$row['name']}</option>";
            }
            ?>
        </select>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="1" required />

        <label for="payment_method">Payment Method:</label>
        <select id="payment_method" name="payment_method" required>
            <option value="cash">Cash</option>
            <option value="card">Card</option>
            <option value="mealplan">Meal Plan</option>
            <option value="mobilemoney">Mobile Money</option>
        </select>

        <button type="submit" class="animate__animated animate__pulse animate__infinite">Place Order</button>
    </form>

    <script>
        document.querySelector('button').addEventListener('click', function () {
            this.classList.add('clicked');
        });
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>