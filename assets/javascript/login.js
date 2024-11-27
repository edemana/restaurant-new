document
  .getElementById("loginForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the form from submitting

    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;

    const emailError = document.getElementById("emailError");
    const passwordError = document.getElementById("passwordError");

    emailError.textContent = "";
    passwordError.textContent = "";

    let valid = true;

    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (email === "") {
      emailError.textContent = "Email cannot be empty.";
      valid = false;
    } else if (!email.match(emailPattern)) {
      emailError.textContent = "Please enter a valid email address.";
      valid = false;
    }

    // Password validation rules
    const passwordPattern = /^(?=.*[A-Z])(?=.*\d{3,})(?=.*[!@#$%^&*]).{8,}$/;
    if (!password.match(passwordPattern)) {
      passwordError.textContent =
        "Password must contain at least 8 characters, 1 uppercase letter, 3 digits, and 1 special character.";
      valid = false;
    }

    // If form is valid, proceed
    if (valid) {
      alert("Login successful");
      // Proceed with actual form submission logic or redirection
    }
  });
