function validateSignup() {
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;
    let isValid = true;

    document.getElementById('email-error').style.display = 'none';
    document.getElementById('password-error').style.display = 'none';
    document.getElementById('confirm-password-error').style.display = 'none';
    document.getElementById('signup-error').style.display = 'none';
    document.getElementById('signup-success').style.display = 'none';

    if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        document.getElementById('email-error').style.display = 'block';
        isValid = false;
    }
    if (email === 'admin@hotel.com') {
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

    if (isValid) {
        document.getElementById('signup-success').style.display = 'block';
        document.querySelectorAll('input').forEach(el => el.value = '');
    }
}