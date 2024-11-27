document.getElementById("signupForm").addEventListener("submit", function (e) {
  e.preventDefault(); // Prevent form submission

  // Clear previous error messages
  document.getElementById("firstnameError").innerText = "";
  document.getElementById("lastnameError").innerText = "";
  document.getElementById("emailError").innerText = "";
  document.getElementById("passwordError").innerText = "";
  document.getElementById("confirmPasswordError").innerText = "";

  // Initialize valid to true
  let valid = true;

  // Get form values
  const firstname = document.getElementById("firstname").value.trim();
  const lastname = document.getElementById("lastname").value.trim();
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();
  const confirmPassword = document
    .getElementById("confirm-password")
    .value.trim();

  // Email validation regex
  const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

  // Password validation regex
  const passwordRegex = /^(?=.*[A-Z])(?=.*\d{3,})(?=.*[@#$%^&+=!]).{8,}$/;

  // Validate firstname
  if (!firstname) {
    document.getElementById("firstnameError").innerText =
      "First name is required.";
    valid = false;
  }

  // Validate lastname
  if (!lastname) {
    document.getElementById("lastnameError").innerText =
      "Last name is required.";
    valid = false;
  }

  // Validate email
  if (!email) {
    document.getElementById("emailError").innerText = "Email is required.";
    valid = false;
  } else if (!emailRegex.test(email)) {
    document.getElementById("emailError").innerText = "Invalid email format.";
    valid = false;
  }

  // Validate password
  if (!password) {
    document.getElementById("passwordError").innerText =
      "Password is required.";
    valid = false;
  } else if (!passwordRegex.test(password)) {
    document.getElementById("passwordError").innerText =
      "Password must be at least 8 characters, include 1 uppercase letter, 3 digits, and 1 special character.";
    valid = false;
  }

  // Validate confirm password
  if (!confirmPassword) {
    document.getElementById("confirmPasswordError").innerText =
      "Confirm password is required.";
    valid = false;
  } else if (confirmPassword !== password) {
    document.getElementById("confirmPasswordError").innerText =
      "Passwords do not match.";
    valid = false;
  }

  console.log(valid);

  // If valid, submit the form
  if (valid) {
    document.getElementById("signupForm").submit();
  }
});
