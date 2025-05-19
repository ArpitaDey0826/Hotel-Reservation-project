function resetPassword() {
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm-password").value;

    const passwordError = document.getElementById("password-error");
    const confirmPasswordError = document.getElementById("confirm-password-error");
    const resetSuccess = document.getElementById("reset-success");
    const resetError = document.getElementById("reset-error");

    passwordError.style.display = "none";
    confirmPasswordError.style.display = "none";
    resetSuccess.style.display = "none";
    resetError.style.display = "none";

    // Validation
    if (password.length < 6 || password.length > 20) {
        passwordError.style.display = "block";
        return false;
    }

    if (password !== confirmPassword) {
        confirmPasswordError.style.display = "block";
        return false;
    }

    // If everything is valid
    resetSuccess.style.display = "block";
    return false; // Prevent actual form submission for now
}
