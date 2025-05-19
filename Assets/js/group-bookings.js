let roomEntryCount = 0;

        function addRoomEntry() {
            roomEntryCount++;
            const roomEntries = document.getElementById('room-entries');
            const div = document.createElement('div');
            div.className = 'room-entry';
            div.id = `room-entry-${roomEntryCount}`;
            div.innerHTML = `
                <select id="room-type-${roomEntryCount}" required>
                    <option value="">Select room type</option>
                    <option value="standard">Standard ($100/night)</option>
                    <option value="deluxe">Deluxe ($150/night)</option>
                    <option value="suite">Suite ($200/night)</option>
                </select>
                <input type="number" id="room-quantity-${roomEntryCount}" min="1" placeholder="Quantity" required>
                <button onclick="removeRoomEntry(${roomEntryCount})">Remove</button>
            `;
            roomEntries.appendChild(div);
        }

        function removeRoomEntry(id) {
            const entry = document.getElementById(`room-entry-${id}`);
            if (entry) entry.remove();
        }

        function validateGroupBooking() {
            const groupName = document.getElementById('group-name').value.trim();
            const contactEmail = document.getElementById('contact-email').value.trim();
            const checkIn = document.getElementById('check-in').value;
            const checkOut = document.getElementById('check-out').value;
            const paymentTerms = document.getElementById('payment-terms').value;
            const eventSpace = document.getElementById('event-space').value;
            let isValid = true;

            document.getElementById('group-name-error').style.display = 'none';
            document.getElementById('contact-email-error').style.display = 'none';
            document.getElementById('check-in-error').style.display = 'none';
            document.getElementById('check-out-error').style.display = 'none';
            document.getElementById('payment-terms-error').style.display = 'none';
            document.getElementById('event-space-error').style.display = 'none';
            document.getElementById('group-success').style.display = 'none';

            if (!groupName) {
                document.getElementById('group-name-error').style.display = 'block';
                isValid = false;
            }
            if (!contactEmail || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(contactEmail)) {
                document.getElementById('contact-email-error').style.display = 'block';
                isValid = false;
            }

            const roomEntries = document.querySelectorAll('.room-entry');
            roomEntries.forEach((entry, index) => {
                const roomType = document.getElementById(`room-type-${index + 1}`).value;
                const quantity = parseInt(document.getElementById(`room-quantity-${index + 1}`).value);
                if (!roomType || !quantity || quantity < 1) {
                    isValid = false;
                    alert('Please fill out all room entries correctly.');
                }
            });

            if (roomEntries.length === 0) {
                alert('Please add at least one room.');
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
                document.getElementById('room-entries').innerHTML = '';
                roomEntryCount = 0;
            }
        }

        addRoomEntry();