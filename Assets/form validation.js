function validateForm() {
    let isValid = true;
  
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const phone = document.getElementById("phone").value.trim();
    const password = document.getElementById("password").value.trim();
  
    document.getElementById("successMessage").innerText = "";
  
    // Name
    if (name.length < 3) {
      document.getElementById("nameError").innerText = "Name must be at least 3 characters.";
      isValid = false;
    } else {
      document.getElementById("nameError").innerText = "";
    }
  
    // Email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      document.getElementById("emailError").innerText = "Enter a valid email.";
      isValid = false;
    } else {
      document.getElementById("emailError").innerText = "";
    }
  
    // Phone
    const phoneRegex = /^[0-9]{10}$/;
    if (!phoneRegex.test(phone)) {
      document.getElementById("phoneError").innerText = "Phone must be 10 digits.";
      isValid = false;
    } else {
      document.getElementById("phoneError").innerText = "";
    }
  
    // Password
    if (password.length < 6) {
      document.getElementById("passwordError").innerText = "Password must be at least 6 characters.";
      isValid = false;
    } else {
      document.getElementById("passwordError").innerText = "";
    }
  
    // Final message
    if (isValid) {
      document.getElementById("successMessage").innerText = "Reservation submitted successfully!";
    }
  
    return isValid; // Prevents submission if false
  }
  