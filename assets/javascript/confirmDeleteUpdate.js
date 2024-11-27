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
        function confirmReservationUpdate(id) {
            if (confirm("Are you sure you want to update this reservation?")) {
                window.location.href = "../actions/update.php?action=reservation&reservation_id=" + id;
            }
        }
        function confirmOrderUpdate(id) {
            if (confirm("Are you sure you want to update this order?")) {
                window.location.href = "../actions/update.php?action=order&order_id=" + id;
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

        