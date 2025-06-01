function validateGroupBooking() {
    const groupName = document.getElementById('group-name').value.trim();
    const contactEmail = document.getElementById('contact-email').value.trim();
    const roomNumber = document.getElementById('room-number').value;
    const checkIn = document.getElementById('check-in').value;
    const checkOut = document.getElementById('check-out').value;
    const paymentTerms = document.getElementById('payment-terms').value;
    const eventSpace = document.getElementById('event-space').value;

    let isValid = true;

    document.getElementById('group-name-error').style.display = 'none';
    document.getElementById('contact-email-error').style.display = 'none';
    document.getElementById('room-number-error').style.display = 'none';
    document.getElementById('check-in-error').style.display = 'none';
    document.getElementById('check-out-error').style.display = 'none';
    document.getElementById('payment-terms-error').style.display = 'none';
    document.getElementById('event-space-error').style.display = 'none';
    document.getElementById('group-success').style.display = 'none';

    if (!groupName) {
        document.getElementById('group-name-error').style.display = 'block';
        isValid = false;
    }

    if (!contactEmail || contactEmail.indexOf('@') === -1 || contactEmail.indexOf('.') === -1 || contactEmail.indexOf('@') > contactEmail.lastIndexOf('.')) {
    document.getElementById('contact-email-error').style.display = 'block';
    isValid = false;
}

    if (!roomNumber || isNaN(roomNumber) || parseInt(roomNumber) < 1) {
        document.getElementById('room-number-error').style.display = 'block';
        isValid = false;
    }

    const today = new Date().toISOString().split('T')[0];

    if (!checkIn || checkIn < today) {
        document.getElementById('check-in-error').style.display = 'block';
        isValid = false;
    }

    if (!checkOut || checkOut <= checkIn) {
        document.getElementById('check-out-error').style.display = 'block';
        isValid = false;
    }

    if (!paymentTerms) {
        document.getElementById('payment-terms-error').style.display = 'block';
        isValid = false;
    }

    if (!eventSpace) {
        document.getElementById('event-space-error').style.display = 'block';
        isValid = false;
    }

    if (isValid) {
        document.getElementById('group-success').style.display = 'block';
        document.querySelectorAll('input, select').forEach(el => el.value = '');
    }

    return isValid; 
}
