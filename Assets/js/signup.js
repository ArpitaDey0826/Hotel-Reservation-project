function validateSignup() {
    const emailInput = document.getElementById('email');
    const email = emailInput.value.trim();
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;
    let isValid = true;

    document.getElementById('email-error').style.display = 'none';
    document.getElementById('password-error').style.display = 'none';
    document.getElementById('confirm-password-error').style.display = 'none';
    document.getElementById('signup-error').style.display = 'none';

    if (!emailInput.checkValidity()) {
        document.getElementById('email-error').style.display = 'block';
        isValid = false;
    }

    if (email.toLowerCase() === 'admin@hotel.com') {
        document.getElementById('signup-error').textContent = 'This email is reserved for admin use.';
        document.getElementById('signup-error').style.display = 'block';
        isValid = false;
    }

    if (!password || password.length < 6) {
        document.getElementById('password-error').style.display = 'block';
        isValid = false;
    }

    if (password !== confirmPassword) {
        document.getElementById('confirm-password-error').style.display = 'block';
        isValid = false;
    }

    return isValid;
}
