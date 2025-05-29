<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('location: login.html');
    exit();
}

require_once '../Model/user_model.php';

$bookings = getRoomBookings();
$groupBookings = getGroupBookings();
$billingSummaries = getBillingSummaries();
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
        </div>

        <div class="section">
            <h2>Room Bookings</h2>
            <?php if (!empty($bookings) && is_array($bookings)): ?>
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
                    <tbody>
                        <?php foreach ($bookings as $booking): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($booking['booking_id']); ?></td>
                                <td><?php echo htmlspecialchars($booking['guest_name']); ?></td>
                                <td><?php echo htmlspecialchars($booking['room_type']); ?></td>
                                <td><?php echo htmlspecialchars($booking['check_in_date']); ?></td>
                                <td><?php echo htmlspecialchars($booking['check_out_date']); ?></td>
                                <td><?php echo htmlspecialchars($booking['rate_type']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No room bookings found.</p>
            <?php endif; ?>
        </div>

        <div class="section">
            <h2>Group Bookings</h2>
            <?php if (!empty($groupBookings) && is_array($groupBookings)): ?>
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
                    <tbody>
                        <?php foreach ($groupBookings as $group): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($group['group_booking_id']); ?></td>
                                <td><?php echo htmlspecialchars($group['group_name']); ?></td>
                                <td><?php echo htmlspecialchars($group['group_booking_email']); ?></td>
                                <td><?php echo htmlspecialchars($group['group_room_number']); ?></td>
                                <td><?php echo htmlspecialchars($group['check_in_date']); ?></td>
                                <td><?php echo htmlspecialchars($group['check_out_date']); ?></td>
                                <td><?php echo htmlspecialchars($group['payment_term']); ?></td>
                                <td><?php echo htmlspecialchars($group['event_space'] ?? 'N/A'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No group bookings found.</p>
            <?php endif; ?>
        </div>

        <div class="section">
            <h2>Billing Summaries</h2>
            <?php if (!empty($billingSummaries) && is_array($billingSummaries)): ?>
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
                    <tbody>
                        <?php foreach ($billingSummaries as $billing): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($billing['bill_id']); ?></td>
                                <td><?php echo htmlspecialchars($billing['booking_id']); ?></td>
                                <td><?php echo htmlspecialchars($billing['email_receipt']); ?></td>
                                <td><?php echo htmlspecialchars($billing['split_number']); ?></td>
                                <td><?php echo htmlspecialchars($billing['split_amount']); ?></td>
                                <td><?php echo htmlspecialchars($billing['split_method']); ?></td>
                                <td><?php echo htmlspecialchars($billing['payer_name']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No billing summaries found.</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="footer">
        <p>Contact us for any query: 01533573770</p>
    </div>
</body>
</html>