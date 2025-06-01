function validateReceipt() {
    const bookingId = document.getElementById('booking-id').value.trim();
    const email = document.getElementById('email').value.trim();
    const amount = document.getElementById('amount').value.trim();
    const method = document.getElementById('method').value;
    const payer = document.getElementById('payer').value.trim();

    let isValid = true;

    document.getElementById('booking-id-error').style.display = 'none';
    document.getElementById('email-error').style.display = 'none';
    document.getElementById('billing-error').style.display = 'none';
    document.getElementById('billing-success').style.display = 'none';

    if (bookingId === '') {
        document.getElementById('booking-id-error').style.display = 'block';
        isValid = false;
    }

    if (email === '' || email.indexOf('@') === -1 || email.indexOf('.') === -1) {
        document.getElementById('email-error').style.display = 'block';
        isValid = false;
    }

    if (amount === '' || isNaN(amount) || parseFloat(amount) <= 0 || method === '' || payer === '') {
        document.getElementById('billing-error').textContent = 'Please fill out all payment fields correctly.';
        document.getElementById('billing-error').style.display = 'block';
        isValid = false;
    }

    return isValid;
}
