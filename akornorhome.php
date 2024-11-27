<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="../EVPH-Project/assets/css/style.css" />
  <link rel="shortcut icon" href="../assets/images/favicon.ico" type="image/x-icon">


  <title>Akornor Hub | Home</title>
</head>

<body>
  <div class="wrapper">
    <nav>
      <div class="nav-container animate-zoom-in duration-1000">
        <div class="nav-logo">
          <p>Akornor Hub</p>
        </div>
        <div class="nav-menu" id="navMenu">

          <ul>
            <li><a href="view/menu.php" class="link active">Menu</a></li>
            <li><a href="view/About_Us.html" class="link">About Us</a></li>
            <li><a href="view/Contact_Us.html" class="link">Contact Us</a></li>
          </ul>
        </div>
        <div class="nav-button">
          <a href="../EVPH-Project/view/akornorlogin.php">
            <button class="btn white-btn animate-zoom-in duration-1000" id="loginBtn">
              Log In
            </button>
          </a>
          <a href="../EVPH-Project/view/akornorsignup.php">
            <button class="btn animate-zoom-in duration-1000" id="signupBtn">
              Sign Up
            </button>
          </a>
        </div>
        <div class="search">
          <input type="search" placeholder="search foods" />
          <i class="fa-solid fa-magnifying-glass"></i>
        </div>
    </nav>

    <!-- Landing Page -->
    <section class="landingpage">
      <div class="content">
        <div class="heading" data-aos="fade-right" data-aos-duration="2000">
          <h1>Welcome to Akornor Hub!</h1>
          <p>
            Akornor has an amazing variety of dishes that consists of both local and continental choices.<br>
            It houses the Ashesi Pool Association which has competitive games every
            friday night and you can always play a round with your friends
          </p>
          <p>Place your Orders and check out the amazing food on our menu today</p>
          <p>Click on the preview to get a taste of our webApp services</p>

          <div class="button-container">
            <a href="./view/akornorsignup.php"><button class="btn" data-aos="fade-left" data-aos-duration="2000"
                data-aos-delay="00" data-aos-margin="">
                Get Started
              </button></a>
          </div>
        </div>

    </section>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
  </div>
</body>

</html>