function validateLogin() {
    let isValid = true;

    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();

    const emailError = document.getElementById("email-error");
    const passwordEmptyError = document.getElementById("password-error-empty");
    const passwordLengthError = document.getElementById("password-error-length");

    emailError.textContent = "";
    passwordEmptyError.textContent = "";
    passwordLengthError.textContent = "";

    if (email === "") {
        emailError.textContent = "Please enter your email.";
        isValid = false;
    } else if (!email.includes("@") || !email.includes(".")) {
        emailError.textContent = "Email must contain '@' and '.'.";
        isValid = false;
    }

    if (password === "") {
        passwordEmptyError.textContent = "Please enter your password.";
        isValid = false;
    } else if (password.length < 8) {
        passwordLengthError.textContent = "Password must be at least 8 characters.";
        isValid = false;
    }

    return isValid;
}
