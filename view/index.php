<?php
    session_start();
    if(isset($_SESSION['status'])){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Reservation System - Landing Page</title>
    <link rel="stylesheet" href="../Assets/css/index.css">
</head>

<body>
    <form method = "POST">
        <div class="header">
            <h1>Welcome to Our Hotel Reservation System</h1>
            <p>Manage your stay with ease and convenience</p>
            <div class="auth-links">
                <a href="login.html">Log Out</a>
            </div>
        </div>
        <div class="container">
            <div class="nav-grid">
                <div class="nav-card">
                    <a href="book-room.php">Book a Room</a>
                    <p>Reserve your stay with preferred room type and dates.</p>
                </div>
                <div class="nav-card">
                    <a href="group-bookings.php">Group Bookings</a>
                    <p>Reserve multiple rooms and coordinate event spaces.</p>
                </div>
                <div class="nav-card">
                    <a href="billing-summary.php">Billing Summary</a>
                    <p>View charges, split payments, and generate receipts.</p>
                </div>                
                <div class="nav-card">
                    <a href="cancellation-policy.php">Cancellation Policy</a>
                    <p>View terms and cancel bookings.</p>
                </div>                
                <div class="nav-card">
                    <a href="concierge-requests.php">Concierge Requests</a>
                    <p>Order services, book experiences, and track requests.</p>
                </div>
                <div class="nav-card">
                    <a href="review-system.php">Review System</a>
                    <p>Submit ratings, comments, and filter reviews by traveler type.</p>
                </div>
                
            </div>
        </div>

        <div class="container">
            <h2>Explore Our Features</h2>
            <div class="nav-grid">
                <div class="nav-card">
                    <a href="hotel types.html">Room Types</a>
                    <p>View room categories, compare amenities, and explore 360° virtual tours.</p>
                </div>
                <div class="nav-card">
                    <a href="calender.html">Availability Calendar</a>
                    <p>Check available rooms, seasonal pricing, and modify your stay duration in real time.</p>
                </div>
                <div class="nav-card">
                    <a href="guest.html">Guest Profiles</a>
                    <p>Manage preferences, view past stays, and track loyalty rewards.</p>
                </div>
                <div class="nav-card">
                    <a href="amenities.html">Amenities List</a>
                    <p>Filter by spa, gym, or pool; view details and operating hours.</p>
                </div>
                <div class="nav-card">
                    <a href="Housekeeping.html">Housekeeping Status</a>
                    <p>Get real-time room readiness, report issues, and track cleaning progress.</p>
                </div>
            </div>
        </div>
        <div class="footer">
            <p>© 2025 Hotel Reservation System. All rights reserved.</p>
        </div>
    </form>

</body>

</html>
<?php
    }else{
        header('location: login.html');
    }

?>
