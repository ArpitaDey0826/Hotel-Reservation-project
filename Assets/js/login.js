function validateLogin() {
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    let isValid = true;

    document.getElementById('email-error').style.display = 'none';
    document.getElementById('password-error').style.display = 'none';
    document.getElementById('login-error').style.display = 'none';
    document.getElementById('login-success').style.display = 'none';

    if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        document.getElementById('email-error').style.display = 'block';
        isValid = false;
    }
    if (!password) {
        document.getElementById('password-error').style.display = 'block';
        isValid = false;
    }

    if (isValid) {
        document.getElementById('login-success').style.display = 'block';
    } else {
        document.getElementById('login-error').textContent = 'Invalid email or password.';
        document.getElementById('login-error').style.display = 'block';
    }
}