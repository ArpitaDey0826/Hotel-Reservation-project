function validateSignup() {
    const emailInput = document.getElementById('email');
    const email = emailInput.value.trim();
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;
    let isValid = true;

    // Hide all error messages initially
    document.getElementById('email-error').style.display = 'none';
    document.getElementById('password-error').style.display = 'none';
    document.getElementById('confirm-password-error').style.display = 'none';
    document.getElementById('signup-error').style.display = 'none';

    // Use HTML5 built-in email validity check
    if (!emailInput.checkValidity()) {
        document.getElementById('email-error').style.display = 'block';
        isValid = false;
    }

    // Prevent admin email usage
    if (email.toLowerCase() === 'admin@hotel.com') {
        document.getElementById('signup-error').textContent = 'This email is reserved for admin use.';
        document.getElementById('signup-error').style.display = 'block';
        isValid = false;
    }

    // Password length check
    if (!password || password.length < 6) {
        document.getElementById('password-error').style.display = 'block';
        isValid = false;
    }

    // Password match check
    if (password !== confirmPassword) {
        document.getElementById('confirm-password-error').style.display = 'block';
        isValid = false;
    }

    return isValid;
}
