<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/modal.css">
    <link rel="stylesheet" href="../assets/css/modal1.css">
    <link rel="stylesheet" href="../assets/css/modal2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="shortcut icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <title>Admin Dashboard</title>
</head>

<body>
    <?php include("../utils/navigation.php"); ?>
    <div class="dashboard-container">
        <div class="main-content">
            <h1>Welcome, Admin!</h1>

            <!-- User Section -->
            <section class="user-section" data-aos="fade-right" data-aos-duration="2000">
                <div class="card">
                    <h2>Users</h2>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $userResult->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= $row['user_id'] ?></td>
                                    <td><?= htmlspecialchars($row['fname'] . ' ' . $row['lname']) ?></td>
                                    <td><?= htmlspecialchars($row['email']) ?></td>
                                    <td><?= htmlspecialchars($row['role']) ?></td>
                                    <td>
                                        <button onclick="confirmDeleteUser(<?= $row['user_id'] ?>)">Delete</button>
                                        <button onclick="confirmUpdateUser(<?= $row['user_id'] ?>)">Update</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Menu Section -->
            <section class="menu-section" data-aos="fade-right" data-aos-duration="2000">
                <div class="card">
                    <h2>Menu Items</h2>
                    <button onclick="showAddItemModal()">Add Item</button>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Item ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Availability</th>
                                <th>Actions</th>
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
                                    <td><?= $row['availability'] ? 'Available' : 'Unavailable' ?></td>
                                    <td>
                                        <button
                                            onclick="showEditItemModal(<?= $row['item_id'] ?>, '<?= htmlspecialchars($row['name']) ?>', '<?= htmlspecialchars($row['description']) ?>', <?= $row['price'] ?>, '<?= htmlspecialchars($row['category']) ?>', <?= $row['availability'] ?>)">Edit</button>
                                        <button onclick="confirmDelete(<?= $row['item_id'] ?>)">Delete</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Modal for Adding a New Menu Item -->
            <div id="addItemModal" class="modal" style="display: none;">
                <div class="modal-content">
                    <span class="close" onclick="closeAddItemModal()">&times;</span>
                    <h3>Add New Menu Item</h3>
                    <form action="../utils/add_menu.php" method="POST" class="add-menu-form">
                        <label for="name">Item Name:</label>
                        <input type="text" id="name" name="name" required>

                        <label for="description">Description:</label>
                        <textarea id="description" name="description" rows="3"></textarea>

                        <label for="price">Price:</label>
                        <input type="number" id="price" name="price" step="0.01" required>

                        <label for="category">Category:</label>
                        <input type="text" id="category" name="category">

                        <label for="availability">Availability:</label>
                        <select id="availability" name="availability">
                            <option value="1">Available</option>
                            <option value="0">Unavailable</option>
                        </select>

                        <button type="submit">Add Item</button>
                    </form>
                </div>
            </div>

            <!-- Modal for Editing a Menu Item -->
            <div id="editItemModal" class="modal" style="display: none;">
                <div class="modal-content">
                    <span class="close" onclick="closeEditItemModal()">&times;</span>
                    <h3>Edit Menu Item</h3>
                    <form action="../utils/edit_menu.php" method="POST" class="edit-menu-form">
                        <input type="hidden" id="edit_item_id" name="item_id">

                        <label for="edit_name">Item Name:</label>
                        <input type="text" id="edit_name" name="name" required>

                        <label for="edit_description">Description:</label>
                        <textarea id="edit_description" name="description" rows="3"></textarea>

                        <label for="edit_price">Price:</label>
                        <input type="number" id="edit_price" name="price" step="0.01" required>

                        <label for="edit_category">Category:</label>
                        <input type="text" id="edit_category" name="category">

                        <label for="edit_availability">Availability:</label>
                        <select id="edit_availability" name="availability">
                            <option value="1">Available</option>
                            <option value="0">Unavailable</option>
                        </select>

                        <button type="submit">Save Changes</button>
                    </form>
                </div>
            </div>


            <!-- Orders Section -->
            <section class="orders-section" data-aos="fade-right" data-aos-duration="2000">
                <div class="card">
                    <h2>Orders</h2>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>User ID</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Payment Method</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $ordersResult->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= $row['order_id'] ?></td>
                                    <td><?= $row['user_id'] ?></td>
                                    <td><?= $row['total_price'] ?></td>
                                    <td><?= htmlspecialchars($row['status']) ?></td>
                                    <td><?= htmlspecialchars($row['payment_method']) ?></td>
                                    <td><?= $row['created_at'] ?></td>
                                    <td>
                                        <button onclick="showUpdateOrderStatusModal(<?= $row['order_id'] ?>)">Update
                                            Status</button>
                                        <button onclick="confirmDeleteOrder(<?= $row['order_id'] ?>)">Cancel</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </section>
            <!-- Modal for Updating Order Status -->
            <div id="updateOrderStatusModal" class="modal" style="display: none;">
                <div class="modal-content">
                    <span class="close" onclick="closeUpdateOrderStatusModal()">&times;</span>
                    <h3>Update Order Status</h3>
                    <form action="../functions/update_order_status.php" method="POST">
                        <label for="order_id">Order ID:</label>
                        <input type="hidden" id="order_id" name="order_id" value="">

                        <label for="status">Status:</label>
                        <select id="status" name="status" required>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>

                        <button type="submit">Update</button>
                    </form>
                </div>
            </div>




            <!-- Reservations Section -->
            <section class="reservations-section" data-aos="fade-right" data-aos-duration="2000">
                <div class="card">
                    <h2>Reservations</h2>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Reservation ID</th>
                                <th>User ID</th>
                                <th>Time</th>
                                <th>People</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $reservationsResult->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= $row['reservation_id'] ?></td>
                                    <td><?= $row['user_id'] ?></td>
                                    <td><?= $row['reservation_time'] ?></td>
                                    <td><?= $row['number_of_people'] ?></td>
                                    <td><?= htmlspecialchars($row['status']) ?></td>
                                    <td>
                                        <button
                                            onclick="showUpdateReservationStatusModal(<?= $row['reservation_id'] ?>)">Update
                                            Status</button>
                                        <button
                                            onclick="confirmDeleteReservation(<?= $row['reservation_id'] ?>)">Cancel</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </section>
            <!-- Modal for Updating Reservation Status -->
            <div id="updateReservationStatusModal" class="modal" style="display: none;">
                <div class="modal-content">
                    <span class="close" onclick="closeUpdateReservationStatusModal()">&times;</span>
                    <h3>Update Reservation Status</h3>
                    <form action="../functions/update_reservation_status.php" method="POST">
                        <label for="reservation_id">Reservation ID:</label>
                        <input type="hidden" id="reservation_id" name="reservation_id" value="">

                        <label for="status">Status:</label>
                        <select id="status" name="status" required>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>

                        <button type="submit">Update</button>
                    </form>
                </div>
            </div>


            <!-- Feedback Section -->
            <section class="feedback-section" data-aos="fade-right" data-aos-duration="2000">
                <div class="card">
                    <h2>Feedback</h2>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Feedback ID</th>
                                <th>User ID</th>
                                <th>Category</th>
                                <th>Rating</th>
                                <th>Comments</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $feedbackResult->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= $row['feedback_id'] ?></td>
                                    <td><?= $row['user_id'] ?></td>
                                    <td><?= $row['category'] ?></td>
                                    <td><?= $row['rating'] ?></td>
                                    <td><?= htmlspecialchars($row['comments']) ?></td>
                                    <td><?= $row['created_at'] ?></td>
                                    <!-- <td>
                                        <button onclick="confirmFeedbackUpdate(<?= $row['feedback_id'] ?>)">Update</button>
                                        <button onclick="confirmDeleteFeedback(<?= $row['feedback_id'] ?>)">Delete</button>
                                    </td> -->
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="../assets/javascript/navigation.js"></script>
    <script>
        function addMenuItem() {
            var menuItem = document.getElementById("menuItem").value;
            window.location.href = "../utils/add_menu.php";
        }
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this item?")) {
                window.location.href = "../actions/delete.php?action=menu_item&item_id=" + id;
            }
        }
        function confirmUpdate(id) {
            if (confirm("Are you sure you want to update this item?")) {
                window.location.href = "../actions/update.php?action=menu_item&item_id=" + id;
            }
        }
        function confirmUpdateUser(id) {
            if (confirm("Are you sure you want to update this user?")) {
                window.location.href = "../utils/update_user.php?user_id=" + id;
            }
        }
        function confirmOrderUpdate(id) {
            window.location.href = "../functions/update_order_status.php?order_id=&order_id=" + id;
        }
        function confirmReservationUpdate(id) {
            if (confirm("Are you sure you want to update this reservation?")) {
                window.location.href = "../functions/update_reservation_status.php?reservation_id=&reservation_id=" + id;
            }
        }

        function confirmDeleteUser(id) {
            if (confirm("Are you sure you want to delete this user?")) {
                window.location.href = "../actions/delete.php?action=user&user_id=" + id;
            }
        }
        function confirmDeleteReservation(id) {
            if (confirm("Are you sure you want to delete this reservation?")) {
                window.location.href = "../actions/delete.php?action=reservation&reservation_id=" + id;
            }
        }

        function confirmDeleteFeedback(id) {
            if (confirm("Are you sure you want to delete this feedback?")) {
                window.location.href = "../actions/delete.php?action=feedback&feedback_id=" + id;
            }
        }

        function confirmDeleteOrder(id) {
            if (confirm("Are you sure you want to delete this order?")) {
                window.location.href = "../actions/delete.php?action=order&order_id=" + id;
            }
        }


    </script>

    <script>
        // Show the modal
        function showAddItemModal() {
            document.getElementById('addItemModal').style.display = 'block';
        }

        // Close the modal
        function closeAddItemModal() {
            document.getElementById('addItemModal').style.display = 'none';
        }

        function showUpdateOrderStatusModal(orderId) {
            document.getElementById('order_id').value = orderId;
            document.getElementById('updateOrderStatusModal').style.display = 'block';
        }

        // Function to close the modal
        function closeUpdateOrderStatusModal() {
            document.getElementById('updateOrderStatusModal').style.display = 'none';
        }

        // Function to show the modal
        function showUpdateReservationStatusModal(reservationId) {
            document.getElementById('reservation_id').value = reservationId;
            document.getElementById('updateReservationStatusModal').style.display = 'block';
        }
        function closeUpdateReservationStatusModal() {
            document.getElementById('updateReservationStatusModal').style.display = 'none';

        }

        // Show Edit Item Modal and populate fields
        function showEditItemModal(itemId, name, description, price, category, availability) {
            document.getElementById('edit_item_id').value = itemId;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_description').value = description;
            document.getElementById('edit_price').value = price;
            document.getElementById('edit_category').value = category;
            document.getElementById('edit_availability').value = availability ? '1' : '0';
            document.getElementById('editItemModal').style.display = 'block';
        }

        // Close Edit Item Modal
        function closeEditItemModal() {
            document.getElementById('editItemModal').style.display = 'none';
        }
    </script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>


</body>

</html>