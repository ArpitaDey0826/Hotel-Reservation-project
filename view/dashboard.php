<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('location: login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Admin Dashboard</title>
    <link rel="stylesheet" href="../Assets/css/dashboard.css">
</head>
<body>
    <div class="header">
        <h1>Hotel Admin Dashboard</h1>
    </div>
    <div class="container">
        <div class="section">          
            <a class="back-button" href="index.php">Back</a>
            <input type="text" id="search-room-bookings" placeholder="Search by guest name..." />
        </div>

        <div class="section">
            <h2>Room Bookings</h2>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Guest Name</th>
                        <th>Room Type</th>
                        <th>Check-In Date</th>
                        <th>Check-Out Date</th>
                        <th>Rate Type</th>
                    </tr>
                </thead>
                <tbody id="room-bookings-body">
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>Group Bookings</h2>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Group Booking ID</th>
                        <th>Group Name</th>
                        <th>Email</th>
                        <th>Room Type</th>
                        <th>Check-In Date</th>
                        <th>Check-Out Date</th>
                        <th>Payment Term</th>
                        <th>Event Space</th>
                    </tr>
                </thead>
                <tbody id="group-bookings-body">
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>Billing Summaries</h2>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Bill ID</th>
                        <th>Booking ID</th>
                        <th>Email Receipt</th>
                        <th>Split Number</th>
                        <th>Split Amount</th>
                        <th>Split Method</th>
                        <th>Payer Name</th>
                    </tr>
                </thead>
                <tbody id="billing-summaries-body">
                </tbody>
            </table>
        </div>
    </div>
    <div class="footer">
        <p>Contact us for any query: 01533573770</p>
    </div>

    <script>
    window.onload = function() {
        fetch('../Controller/fetch_data.php')
            .then(res => res.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                    return;
                }
                renderRoomBookings(data.bookings);
                renderGroupBookings(data.groupBookings);
                renderBillingSummaries(data.billingSummaries);
            })
            .catch(err => {
                console.error("Error loading data:", err);
            });
    };

    document.getElementById('search-room-bookings').addEventListener('input', function () {
        const query = this.value.trim();

        fetch(`../Controller/fetch_data.php?search=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                    return;
                }
                renderRoomBookings(data.bookings); 
            })
            .catch(err => {
                console.error("Search failed:", err);
            });
    });

    function renderRoomBookings(bookings) {
        const tbody = document.getElementById('room-bookings-body');
        tbody.innerHTML = '';
        bookings.forEach(b => {
            const row = `<tr>
                <td>${b.booking_id}</td>
                <td>${b.guest_name}</td>
                <td>${b.room_type}</td>
                <td>${b.check_in_date}</td>
                <td>${b.check_out_date}</td>
                <td>${b.rate_type}</td>
            </tr>`;
            tbody.innerHTML += row;
        });
    }

    function renderGroupBookings(groups) {
        const tbody = document.getElementById('group-bookings-body');
        tbody.innerHTML = '';
        groups.forEach(g => {
            const row = `<tr>
                <td>${g.group_booking_id}</td>
                <td>${g.group_name}</td>
                <td>${g.group_booking_email}</td>
                <td>${g.group_room_number}</td>
                <td>${g.check_in_date}</td>
                <td>${g.check_out_date}</td>
                <td>${g.payment_term}</td>
                <td>${g.event_space || 'N/A'}</td>
            </tr>`;
            tbody.innerHTML += row;
        });
    }

    function renderBillingSummaries(bills) {
        const tbody = document.getElementById('billing-summaries-body');
        tbody.innerHTML = '';
        bills.forEach(b => {
            const row = `<tr>
                <td>${b.bill_id}</td>
                <td>${b.booking_id}</td>
                <td>${b.email_receipt}</td>
                <td>${b.split_number}</td>
                <td>${b.split_amount}</td>
                <td>${b.split_method}</td>
                <td>${b.payer_name}</td>
            </tr>`;
            tbody.innerHTML += row;
        });
    }
    </script>
</body>
</html>
