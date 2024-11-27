<?php
include "../db/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $item_id = $_POST['item_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $availability = $_POST['availability'];

    $stmt = $conn->prepare("UPDATE menu_items SET name = ?, description = ?, price = ?, category = ?, availability = ? WHERE item_id = ?");
    $stmt->bind_param("ssdssi", $name, $description, $price, $category, $availability, $item_id);

    if ($stmt->execute()) {
        header("Location: ../view/dashboard.php?update=success");
    } else {
        echo "Failed to update menu item.";
    }
}
?>
