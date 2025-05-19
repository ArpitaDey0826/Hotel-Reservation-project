function validateBooking() {
    const guestName = document.getElementById('guest-name').value.trim();
    const roomType = document.getElementById('room-type').value;
    const checkIn = document.getElementById('check-in').value;
    const checkOut = document.getElementById('check-out').value;
    const rateType = document.getElementById('rate-type').value;
    let isValid = true;

    document.getElementById('guest-name-error').style.display = 'none';
    document.getElementById('room-type-error').style.display = 'none';
    document.getElementById('check-in-error').style.display = 'none';
    document.getElementById('check-out-error').style.display = 'none';
    document.getElementById('rate-type-error').style.display = 'none';
    document.getElementById('booking-success').style.display = 'none';

    if (!guestName || guestName.length < 2) {
        document.getElementById('guest-name-error').style.display = 'block';
        isValid = false;
    }
    if (!roomType) {
        document.getElementById('room-type-error').style.display = 'block';
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
    if (!rateType) {
        document.getElementById('rate-type-error').style.display = 'block';
        isValid = false;
    }

    if (isValid) {
        document.getElementById('booking-success').style.display = 'block';
        document.querySelectorAll('input, select').forEach(el => el.value = '');
    }
}