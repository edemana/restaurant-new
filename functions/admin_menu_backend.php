<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $categot

    function adminUpdateMenu($name, $description, $price) {
        global $conn;
        $sql = "INSERT INTO menu_items (name, description, price) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssd", $name, $description, $price);

        if ($stmt->execute()) {
            echo "Menu item added!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    adminUpdateMenu($name, $description, $price);
}
?>
