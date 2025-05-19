<?php
    session_start();
    if(isset($_COOKIE['status'])){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>
    <form method = "POST">
        <div class="header">
            <h1>Hotel Admin Dashboard</h1>
        </div>
        <div class="container">
            <div class="section">
                <h2>Quick Actions</h2>
                <div class="action-grid">
                    <a href="book-room.html" class="action-btn">Book a Room</a>
                    <a href="concierge-requests.html" class="action-btn">Submit Concierge Request</a>
                    <a href="billing-summary.html" class="action-btn">View Billing Summary</a>
                    <a href="group-bookings.html" class="action-btn">Manage Group Bookings</a>
                </div>
                <a class="back-button" href="index.php">Back</a>
            </div>
        </div>
        <div class="footer">
            <p>Contact us for any querry :01533573770</p>
        </div>
    </form>
</body>
</html>
<?php
    }else{
        header('location: login.html');
    }

?>
