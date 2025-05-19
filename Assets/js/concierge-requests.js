function validateConciergeRequest() {
    const bookingId = document.getElementById('booking-id').value.trim();
    const service = document.getElementById('service').value;
    const requestDetails = document.getElementById('request-details').value.trim();
    let isValid = true;

    document.getElementById('booking-id-error').style.display = 'none';
    document.getElementById('service-error').style.display = 'none';
    document.getElementById('request-details-error').style.display = 'none';
    document.getElementById('concierge-success').style.display = 'none';

    if (!bookingId || !/^[BG][KB]\d{5}$/.test(bookingId)) {
        document.getElementById('booking-id-error').style.display = 'block';
        isValid = false;
    }
    if (!service) {
        document.getElementById('service-error').style.display = 'block';
        isValid = false;
    }
    if (!requestDetails) {
        document.getElementById('request-details-error').style.display = 'block';
        isValid = false;
    }

    if (isValid) {
        document.getElementById('concierge-success').style.display = 'block';
        document.querySelectorAll('input, select, textarea').forEach(el => el.value = '');
    }
}