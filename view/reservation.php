<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../assets/css/reservation.css" />
  <link rel="shortcut icon" href="../assets/images/favicon.ico" type="image/x-icon">

  <title>Akornor Reservation</title>
</head>

<body>
  <div class="container">
    <header>
      <h1>Akornor Reservation</h1>
      <p>Reserve a table for your next meal</p>
    </header>
    <form action="../functions/make_reservation.php" method="post" data-aos="fade-right" data-aos-duration="2000">
      <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />

      <label for="date"><ion-icon name="calendar-outline"></ion-icon> Date:</label>
      <input type="date" id="date" name="date" required />

      <label for="time"><ion-icon name="time-outline"></ion-icon> Time:</label>
      <input type="time" id="time" name="time" required />

      <label for="num_people"><ion-icon name="people-outline"></ion-icon> Number of People:</label>
      <input type="number" id="number_of_people" name="number_of_people" min="1" required />

      <label for="table"><ion-icon name="restaurant-outline"></ion-icon> Table:</label>
      <select name="table" id="table" required>
        <option value="1">Table 1</option>
        <option value="2">Table 2</option>
        <option value="3">Table 3</option>
        <option value="4">Table 4</option>
        <option value="5">Table 5</option>
      </select>

      <button type="submit">Reserve Table</button>
    </form>
  </div>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>