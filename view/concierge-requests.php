<?php
    session_start();
    if(isset($_COOKIE['status'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concierge Requests</title>
    <link rel="stylesheet" href="../assets/css/concierge-requests.css">
</head>
<body>
    <form method = "POST">
        <div class="container">
        <h2>Concierge Requests</h2>
        <div id="concierge-success" class="success">Request submitted successfully!</div>

        <h3>Submit a Request</h3>
        <label for="booking-id">Booking ID:</label>
        <input type="text" id="booking-id" required>
        <div id="booking-id-error" class="error">Please enter a valid Booking ID (e.g., BK12345 or GB12345).</div>
        <label for="service">Service/Experience:</label>
        <select id="service" required>
            <option value="">Select a service</option>
            <optgroup label="Room Service">
                <option value="breakfast">Breakfast ($20)</option>
                <option value="extra-towels">Extra Towels (Free)</option>
                <option value="dinner">Dinner ($30)</option>
            </optgroup>
            <optgroup label="Local Experience">
                <option value="city-tour">City Tour ($50)</option>
                <option value="restaurant-reservation">Restaurant Reservation ($10)</option>
                <option value="museum-tickets">Museum Tickets ($25)</option>
            </optgroup>
            <optgroup label="Amenity">
                <option value="spa-massage">Spa Massage ($80)</option>
                <option value="gym-access">Gym Access ($15)</option>
                <option value="pool-access">Pool Access (Free)</option>
            </optgroup>
        </select>
        <div id="service-error" class="error">Please select a service.</div>
        <label for="request-details">Additional Details:</label>
        <textarea id="request-details" rows="4" required></textarea>
        <div id="request-details-error" class="error">Please provide request details.</div>
        <button onclick="validateConciergeRequest()">Submit Request</button>
        <a class="back-button" href="index.php">Back</a>

        <h3>Request History</h3>
        <p>Please contact support to view request history.</p>
    </div>
    </form>   

    <script src="../assets/js/concierge-requests.js"></script>
</body>
</html>
<?php
    }else{
        header('location: login.html');
    }

?>
