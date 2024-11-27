<?php
session_start();
include '../db/db.php';

// Declare error variables
$emailError = $passwordError = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Prepare query to fetch user details from the database
  $stmt = $conn->prepare("SELECT user_id, password, role FROM user WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  // Check if the user exists
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row["user_id"];
    $hashedPassword = $row["password"];
    $role = $row['role'];

    // Verify the password
    if (password_verify($password, $hashedPassword)) {
      // Set session variables
      $_SESSION['user_id'] = $user_id;
      $_SESSION['role'] = $role;
      $_SESSION['email'] = $email;
      $_SESSION['fname'] = $fname;
      $_SESSION['lname'] = $lname;


      // Redirect to the dashboard based on user role
      if ($role === 'admin') {
        header("Location: ../view/dashboard.php");

      }

      if ($role === "customer") {
        header("Location: ../view/dashboard.php");
        exit();
      }

    } else {
      $passwordError = "Invalid password.";
    }
  } else {
    $emailError = "No account found with that email.";
  }
  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/login.css" />
  <link rel="shortcut icon" href="../assets/images/favicon.ico" type="image/x-icon" />
  <title>Login | Akornor Hub</title>
  <style>
    .error-message {
      color: red;
      font-size: 0.9em;
      margin-top: 5px;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <nav class="nav animate-fade-right duration-1000 delay-200">

      <div class="nav-logo">
        <p href="./akornorhome.php">Akornor Hub</p>
      </div>
      <div class="nav-menu" id="navMenu">
        <ul>
          <li><a href="../akornorhome.php" class="link active">Home</a></li>
          <li><a href="About_Us.html" class="link">About Us</a></li>
          <li><a href="Contact_Us.html" class="link">Contact Us</a></li>
        </ul>
      </div>
      <div class="nav-button">
        <a href="../view/akornorsignup.php">
          <button class="btn">Sign Up</button>
        </a>
      </div>
    </nav>

    <!-- Login Form -->
    <div class="form-box">
      <div class="login-container animate-zoom-in duration-1000 delay-400 ">
        <form action="" method="POST">
          <div class="top">
            <span>Don't have an account? <a href="../view/akornorsignup.php">Sign Up</a>
            </span>
            <header>Login</header>
          </div>
          <div class="input-box">
            <input type="email" name="email" class="input-field" placeholder="Email" required />
            <i class="bx bx-user"></i>
            <div class="error-message">
              <?php echo $emailError; ?>
            </div>
          </div>
          <div class="input-box">
            <input type="password" name="password" class="input-field" placeholder="Password" required />
            <i class="bx bx-lock-alt"></i>
            <div class="error-message">
              <?php echo $passwordError; ?>
            </div>
          </div>
          <div class="input-box">
            <input type="submit" class="submit" value="Sign In" />
          </div>
          <div class="two-col">
            <div class="one">
              <input type="checkbox" id="login-check" />
              <label for="login-check"> Remember Me</label>
            </div>
            <div class="two">
              <label><a href="#">Forgot password?</a></label>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="../assets/javascript/loginValidation.js"></script>
</body>

</html>