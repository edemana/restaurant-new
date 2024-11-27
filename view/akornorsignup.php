<?php
// Include database connection
include '../db/db.php';

$emailError = $passwordError = "";
$registrationSuccess = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  try {
    $fname = trim(htmlspecialchars($_POST['fname']));
    $lname = trim(htmlspecialchars($_POST['lname']));
    $email = trim(htmlspecialchars($_POST['email']));
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    if ($password !== $confirmPassword) {
      throw new Exception("Passwords do not match");
    }

    if (empty($fname) || empty($lname) || empty($email) || empty($password)) {
      throw new Exception("All fields are required");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      throw new Exception("Invalid email format");
    }

    $stmt = $conn->prepare("SELECT user_id FROM user WHERE email = ?");
    if (!$stmt) {
      throw new Exception("Database error: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      throw new Exception("User already registered with this email");
    }
    $stmt->close();

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $role = 2;
    $stmt = $conn->prepare("INSERT INTO user ( fname, lname,  email, password, role) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
      throw new Exception("Database error: " . $conn->error);
    }

    $stmt->bind_param("sssss", $fname, $lname, $email, $hashedPassword, $role);

    if (!$stmt->execute()) {
      throw new Exception("Registration failed: " . $stmt->error);
    }

    // Registration successful
    $registrationSuccess = true;
    header("Location: ../view/akornorlogin.php?registration=success");

  } catch (Exception $e) {
    $emailError = $e->getMessage();
    error_log("Registration error: " . $e->getMessage());
  }
}
?>
<!DOCTYPE html>
<html lang="eng">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="UTF-8" />
  <meta name="Author" content="Papa Yaw Badu" />
  <title>Register - Akornor Hub</title>
  <link rel="stylesheet" href="../assets/css/login.css" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="shortcut icon" href="../assets/images/favicon.ico" type="image/x-icon">

</head>

<body>
  <!-- Registration Form -->
  <div class="wrapper">
    <nav class="nav animate-fade-right duration-1000 delay-200">
      <div class="nav-logo">
        <p>Akornor Hub</p>
      </div>
      <div class="nav-menu" id="navMenu">
        <ul>
          <li><a href="../akornorhome.php" class="link active">Home</a></li>
          <li><a href="About_Us.html" class="link">About Us</a></li>
          <li><a href="Contact_Us.html" class="link">Contact Us</a></li>
        </ul>
      </div>
      <div class="nav-button">
        <a href="../view/akornorlogin.php">
          <button class="btn white-btn" id="loginBtn">Log In</button>
        </a>
        <button class="btn" id="signupBtn">Sign Up</button>
      </div>
      <div class="nav-menu-btn">
        <i class="bx bx-menu"></i>
      </div>
    </nav>
    <div class="form-box">
      <div class="signup-container animate-zoom-in duration-1000 delay-400" id="signup">
        <form id="signupForm" action="../view/akornorsignup.php" method="POST">
          <div class="top">
            <span>
              Already have an account?
              <a href="../view/akornorlogin.php" onclick="login()">Login</a>
            </span>
            <header>Sign Up</header>
          </div>
          <div class="two-forms">
            <div class="input-box">
              <input type="text" id="firstname" class="input-field" name="fname" placeholder="Firstname" />
              <i class="bx bx-user"></i>
              <div id="firstnameError" class="error-message"></div>
            </div>
            <div class="input-box">
              <input type="text" id="lastname" class="input-field" name="lname" placeholder="Lastname" />
              <i class="bx bx-user"></i>
              <div id="lastnameError" class="error-message"></div>
            </div>
          </div>

          <div class="input-box">
            <input type="email" id="email" class="input-field" name="email" placeholder="Email" />
            <i class="bx bx-envelope"></i>
            <div id="emailError" class="error-message"><?php echo $emailError; ?></div>
          </div>
          <div class="input-box">
            <input type="password" id="password" class="input-field" name="password" placeholder="Password" />
            <i class="bx bx-lock-alt"></i>
            <div id="passwordError" class="error-message"></div>
          </div>
          <div class="input-box">
            <input type="password" id="confirm-password" class="input-field" name="confirm-password"
              placeholder="Confirm Password" required />
            <i class="bx bx-lock-alt"></i>
            <div id="confirmPasswordError" class="error-message"></div>
          </div>
          <div class="input-box">
            <input type="submit" class="submit" value="Sign Up" />
          </div>
      </div>
      </form>
    </div>
  </div>
  </div>

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <!-- <script src="/../assets/javascript/register.js"></script> -->
  <script src="../assets/javascript/signupValidation.js"></script>




</body>

</html>