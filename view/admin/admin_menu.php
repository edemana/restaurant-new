<div class="form-container">
    <h2>Add a New Menu Item</h2>
    <form id="adminMenuForm" action="../functions/admin_menu_backend.php" method="post">
        <label for="name">Item Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter item name" required />

        <label for="description">Description:</label>
        <textarea id="description" name="description" placeholder="Enter item description" required></textarea>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" placeholder="Enter price" required />

        <label for="category">Category:</label>
        <select id="category" name="category" required>
            <option value="Starter">Starter</option>
            <option value="Main Course">Main Course</option>
            <option value="Dessert">Dessert</option>
            <option value="Drink">Drink</option>
        </select>

        <label for="availability">Availability:</label>
        <select id="availability" name="availability" required>
            <option value="1">Available</option>
            <option value="0">Unavailable</option>
        </select>

        <button type="submit">Add Menu Item</button>
    </form>
</div>


<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script>
  document.getElementById("adminMenuForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const name = document.getElementById("name").value.trim();
    const description = document.getElementById("description").value.trim();
    const price = document.getElementById("price").value.trim();

    const nameError = document.getElementById("nameError");
    const descriptionError = document.getElementById("descriptionError");
    const priceError = document.getElementById("priceError");

    nameError.textContent = "";
    descriptionError.textContent = "";
    priceError.textContent = "";

    let valid = true;

    if (name === "") {
      nameError.textContent = "Item name cannot be empty.";
      valid = false;
    }

    if (description === "") {
      descriptionError.textContent = "Description cannot be empty.";
      valid = false;
    }

    if (price === "" || isNaN(price) || price <= 0) {
      priceError.textContent = "Please enter a valid price.";
      valid = false;
    }

    if (valid) {
      document.getElementById("adminMenuForm").submit(); // Submit the form
    }

  });
</script>

<style>
  .form-container {
    max-width: 500px;
    margin: 50px auto;
    padding: 30px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .form-container h2 {
    margin-bottom: 20px;
    text-align: center;
    color: #722F37;
  }

  .input-icon {
    display: flex;
    align-items: center;
    background-color: #f9f9f9;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 10px;
    margin-bottom: 15px;
  }

  .input-icon ion-icon {
    color: #722F37;
    margin-right: 10px;
  }

  .input-icon input {
    border: none;
    outline: none;
    width: 100%;
    padding: 10px;
    font-size: 16px;
  }

  .error {
    color: red;
    font-size: 14px;
    display: block;
    margin-bottom: 10px;
  }

  button[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #722F37;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  button[type="submit"]:hover {
    background-color: #e14b4e;
  }
</style>


