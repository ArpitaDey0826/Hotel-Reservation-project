function updateSplitEntries() {
    const splitCount = parseInt(document.getElementById('split-count').value) || 1;
    const splitEntries = document.getElementById('split-entries');
    splitEntries.innerHTML = '';

    for (let i = 1; i <= splitCount; i++) {
        const div = document.createElement('div');
        div.className = 'split-entry';
        div.innerHTML = `
            <label>Split ${i}</label>
            <input type="number" id="split-amount-${i}" placeholder="Amount" min="0" step="0.01" required>
            <select id="split-method-${i}" required>
                <option value="">Select method</option>
                <option value="card">Card</option>
                <option value="cash">Cash</option>
            </select>
            <input type="text" id="split-payer-${i}" placeholder="Payer Name" required>
        `;
        splitEntries.appendChild(div);
    }
}

function validateReceipt() {
    const bookingId = document.getElementById('booking-id').value.trim();
    const email = document.getElementById('email').value.trim();
    const splitCount = parseInt(document.getElementById('split-count').value);
    let isValid = true;

    document.getElementById('booking-id-error').style.display = 'none';
    document.getElementById('email-error').style.display = 'none';
    document.getElementById('split-count-error').style.display = 'none';
    document.getElementById('billing-success').style.display = 'none';
    document.getElementById('billing-error').style.display = 'none';

    if (!bookingId || !/^[BG][KB]\d{5}$/.test(bookingId)) {
        document.getElementById('booking-id-error').style.display = 'block';
        isValid = false;
    }
    if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        document.getElementById('email-error').style.display = 'block';
        isValid = false;
    }
    if (!splitCount || splitCount < 1) {
        document.getElementById('split-count-error').style.display = 'block';
        isValid = false;
    }

    const splits = [];
    for (let i = 1; i <= splitCount; i++) {
        const amount = parseFloat(document.getElementById(`split-amount-${i}`).value) || 0;
        const method = document.getElementById(`split-method-${i}`).value;
        const payer = document.getElementById(`split-payer-${i}`).value.trim();
        if (!amount || amount <= 0 || !method || !payer) {
            document.getElementById('billing-error').textContent = `Please fill out all fields for Split ${i}.`;
            document.getElementById('billing-error').style.display = 'block';
            isValid = false;
        } else {
            splits.push({ amount, method, payer });
        }
    }

    if (isValid) {
        document.getElementById('billing-success').style.display = 'block';
        document.querySelectorAll('input, select').forEach(el => el.value = '');
        document.getElementById('split-entries').innerHTML = '';
        document.getElementById('split-count').value = '1';
        updateSplitEntries();
    }
}

document.getElementById('split-count').addEventListener('input', updateSplitEntries);
updateSplitEntries();