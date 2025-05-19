<?php
    session_start();
    if(isset($_COOKIE['status'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Room</title>
    <link rel="stylesheet" href="../assets/css/book-room.css">
</head>
<body>
    <form method = "POST">
        <div class="container">
        <h2>Book a Room</h2>
        <div id="booking-success" class="success">Booking confirmed! Please check your email.</div>
        <label for="guest-name">Guest Name:</label>
        <input type="text" id="guest-name" required>
        <div id="guest-name-error" class="error">Please enter a valid name.</div>
        <label for="room-type">Room Type:</label>
        <select id="room-type" required>
            <option value="">Select room type</option>
            <option value="standard">Standard ($100/night)</option>
            <option value="deluxe">Deluxe ($150/night)</option>
            <option value="suite">Suite ($200/night)</option>
        </select>
        <div id="room-type-error" class="error">Please select a room type.</div>
        <label for="check-in">Check-In Date:</label>
        <input type="date" id="check-in" required>
        <div id="check-in-error" class="error">Please select a valid future date.</div>
        <label for="check-out">Check-Out Date:</label>
        <input type="date" id="check-out" required>
        <div id="check-out-error" class="error">Check-out must be after check-in.</div>
        <label for="rate-type">Rate Type:</label>
        <select id="rate-type" required>
            <option value="">Select rate type</option>
            <option value="flexible">Flexible</option>
            <option value="non-refundable">Non-Refundable</option>
        </select>
        <div id="rate-type-error" class="error">Please select a rate type.</div>
        <button onclick="validateBooking()">Book Now</button>
        <a class="back-button" href="index.php">Back</a>
    </div>
    </form>
    <script src="../assets/js/book-room.js"></script>
</body>
</html>
<?php
    }else{
        header('location: login.html');
    }

?>
