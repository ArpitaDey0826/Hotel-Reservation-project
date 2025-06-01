document.addEventListener('DOMContentLoaded', function () {
    var xhttp = new XMLHttpRequest();
    xhttp.open('GET', '../Controller/fetch_data.php', true);
    xhttp.send();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);

            var bookingsBody = document.getElementById('room-bookings-body');

            bookingsBody.innerHTML = '';
            if (data.bookings && data.bookings.length > 0) {
                for (var i = 0; i < data.bookings.length; i++) {
                    var b = data.bookings[i];
                    var row = '<tr>' +
                        '<td>' + b.booking_id + '</td>' +
                        '<td>' + b.guest_name + '</td>' +
                        '<td>' + b.room_type + '</td>' +
                        '<td>' + b.check_in_date + '</td>' +
                        '<td>' + b.check_out_date + '</td>' +
                        '<td>' + b.rate_type + '</td>' +
                        '</tr>';
                    bookingsBody.innerHTML += row;
                }
            } else {
                bookingsBody.innerHTML = '<tr><td colspan="6">No room bookings found.</td></tr>';
            }

            var groupBody = document.querySelector('group-bookings-body');
            groupBody.innerHTML = '';
            if (data.groupBookings && data.groupBookings.length > 0) {
                for (var j = 0; j < data.groupBookings.length; j++) {
                    var g = data.groupBookings[j];
                    var row = '<tr>' +
                        '<td>' + (g.group_booking_id || 'N/A') + '</td>' +
                        '<td>' + (g.group_name || 'N/A') + '</td>' +
                        '<td>' + (g.group_booking_email || 'N/A') + '</td>' +
                        '<td>' + (g.group_room_type || 'N/A') + '</td>' +
                        '<td>' + (g.check_in_date || 'N/A') + '</td>' +
                        '<td>' + (g.check_out_date || 'N/A') + '</td>' +
                        '<td>' + (g.payment_term || 'N/A') + '</td>' +
                        '<td>' + (g.event_space || 'N/A') + '</td>' +
                        '</tr>';
                    groupBody.innerHTML += row;
                }
            } else {
                groupBody.innerHTML = '<tr><td colspan="8">No group bookings found.</td></tr>';
            }

            var billingBody = document.querySelector('billing-summaries-body');
            billingBody.innerHTML = '';
            if (data.billingSummaries && data.billingSummaries.length > 0) {
                for (var k = 0; k < data.billingSummaries.length; k++) {
                    var s = data.billingSummaries[k];
                    var row = '<tr>' +
                        '<td>' + (s.bill_id || 'N/A') + '</td>' +
                        '<td>' + (s.booking_id || 'N/A') + '</td>' +
                        '<td>' + (s.email_receipt || 'N/A') + '</td>' +
                        '<td>' + (s.split_number || 'N/A') + '</td>' +
                        '<td>' + (s.split_amount || 'N/A') + '</td>' +
                        '<td>' + (s.split_method || 'N/A') + '</td>' +
                        '<td>' + (s.payer_name || 'N/A') + '</td>' +
                        '</tr>';
                    billingBody.innerHTML += row;
                }
            } else {
                billingBody.innerHTML = '<tr><td colspan="7">No billing summaries found.</td></tr>';
            }
        }
    }
});
