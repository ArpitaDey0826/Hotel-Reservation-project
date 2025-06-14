<?php
    session_start();
    if(isset($_SESSION['status'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Bookings</title>
    <link rel="stylesheet" href="../Assets/css/group-bookings.css">
</head>
<body>
    <form method="POST" action = "../Controller/process_group_booking.php ">
        <div class="container">
            <h2>Group Bookings</h2>
            <div id="group-success" class="success">Group booking submitted successfully!</div>

            <h3>Group Information</h3>
            <label for="group-name">Group Name:</label>
            <input type="text" id="group-name" name="group-name" required>
            <div id="group-name-error" class="error">Please enter a group name.</div>
            <label for="contact-email">Contact Email:</label>
            <input type="email" id="contact-email" name="contact-email" required>
            <div id="contact-email-error" class="error">Please enter a valid email address.</div>

            <h3>Room Quantity</h3>
            <label for="room-number">Number of room:</label>
            <input type="number" id="room-number" name="room-number" min="1" required />
            <div id="room-number-error" class="error">Please enter a valid room number.</div>

            <h3>Booking Details</h3>
            <label for="check-in">Check-In Date:</label>
            <input type="date" id="check-in" name="check-in" required>
            <div id="check-in-error" class="error">Please select a valid future date.</div>
            <label for="check-out">Check-Out Date:</label>
            <input type="date" id="check-out" name="check-out" required>
            <div id="check-out-error" class="error">Check-out must be after check-in.</div>
            <label for="payment-terms">Payment Terms:</label>
            <select id="payment-terms" name="payment-terms" required>
                <option value="">Select payment terms</option>
                <option value="pay-now">Pay Now (Full Payment)</option>
                <option value="pay-later">Pay Later (Due at Check-In)</option>
                <option value="split">Split Payment (50% Now, 50% Later)</option>
            </select>
            <div id="payment-terms-error" class="error">Please select payment terms.</div>
            <label for="event-space">Event Space Required:</label>
            <select id="event-space" name="event-space" required>
                <option value="">Select option</option>
                <option value="none">None</option>
                <option value="conference">Conference Room</option>
                <option value="banquet">Banquet Hall</option>
            </select>
            <div id="event-space-error" class="error">Please select an event space option.</div>
            <button type="submit" name="submit" >Submit Group Booking</button>
            <a class="back-button" href="index.php">Back</a>
        </div>
    </form>
    <script src="../Assets/js/group-bookings.js"></script>
</body>
</html>
<?php
    }else{
        header('location: login.php');
    }
?>