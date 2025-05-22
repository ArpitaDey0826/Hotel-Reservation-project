function validateLogin() {
    let isValid = true;

    // Get input values
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();

    // Get span error elements
    const emailError = document.getElementById("email-error");
    const passwordEmptyError = document.getElementById("password-error-empty");
    const passwordLengthError = document.getElementById("password-error-length");

    // Clear all error messages
    emailError.textContent = "";
    passwordEmptyError.textContent = "";
    passwordLengthError.textContent = "";

    //Validate email
    if (email === "") {
        emailError.textContent = "Please enter your email.";
        isValid = false;
    } else if (!email.includes("@") || !email.includes(".")) {
        emailError.textContent = "Email must contain '@' and '.'.";
        isValid = false;
    }

    // Validate password
    if (password === "") {
        passwordEmptyError.textContent = "Please enter your password.";
        isValid = false;
    } else if (password.length < 8) {
        passwordLengthError.textContent = "Password must be at least 8 characters.";
        isValid = false;
    }

    return isValid;
}
