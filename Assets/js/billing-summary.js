function validateReceipt() {
    const bookingId = document.getElementById('booking-id').value.trim();
    const email = document.getElementById('email').value.trim();
    const amount = parseFloat(document.getElementById('amount').value) || 0;
    const method = document.getElementById('method').value;
    const payer = document.getElementById('payer').value.trim();
    let isValid = true;

    document.getElementById('booking-id-error').style.display = 'none';
    document.getElementById('email-error').style.display = 'none';
    document.getElementById('billing-error').style.display = 'none';
    document.getElementById('billing-success').style.display = 'none';

    if (!bookingId || !/^[BG][KB]\d{5}$/.test(bookingId)) {
        document.getElementById('booking-id-error').style.display = 'block';
        isValid = false;
    }

    let atPos = email.indexOf('@');
    let dotPos = email.lastIndexOf('.');
    if (!email || atPos <= 0 || dotPos <= atPos + 1 || dotPos === email.length - 1) {
        document.getElementById('email-error').style.display = 'block';
        isValid = false;
    }

    if (!amount || amount <= 0 || !method || !payer) {
        document.getElementById('billing-error').textContent = `Please fill out all payment fields correctly.`;
        document.getElementById('billing-error').style.display = 'block';
        isValid = false;
    }

    if (isValid) {
        document.getElementById('billing-success').style.display = 'block';
        document.querySelectorAll('input, select').forEach(el => el.value = '');
    }

    return false; 
}
