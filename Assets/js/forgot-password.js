function validateReset() {
    const email = document.getElementById('email').value.trim();
    let isValid = true;

    document.getElementById('email-error').style.display = 'none';
    document.getElementById('forgot-error').style.display = 'none';
    document.getElementById('forgot-success').style.display = 'none';

    if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        document.getElementById('email-error').style.display = 'block';
        isValid = false;
    }

    if (isValid) {
        document.getElementById('forgot-success').style.display = 'block';
    } else {
        document.getElementById('forgot-error').textContent = 'Invalid email address.';
        document.getElementById('forgot-error').style.display = 'block';
    }
}