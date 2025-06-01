function validateLogin() {
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();
    const emailError = document.getElementById("email-error");
    const passwordError = document.getElementById("password-error");
    const loginError = document.getElementById("login-error");

    emailError.style.display = "none";
    passwordError.style.display = "none";
    loginError.style.display = "none";

    let isValid = true;

    if (email === "") {
        emailError.textContent = "Email is required.";
        emailError.style.display = "block";
        isValid = false;
    } else if (!email.includes('@') || !email.includes('.') || email.startsWith('@') || email.endsWith('.')) {
        emailError.textContent = "Please enter a valid email address.";
        emailError.style.display = "block";
        isValid = false;
    }

    if (password === "") {
        passwordError.textContent = "Password is required.";
        passwordError.style.display = "block";
        isValid = false;
    } else if (password.length < 6) {
        passwordError.textContent = "Password must be at least 6 characters long.";
        passwordError.style.display = "block";
        isValid = false;
    }

    if (!isValid) {
        loginError.textContent = "Please provide valid email and password!!";
        loginError.style.display = "block";
    }

    return isValid;
}
