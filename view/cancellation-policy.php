<?php
    session_start();
    if(isset($_COOKIE['status'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancellation Policy</title>
    <link rel="stylesheet" href="../assets/css/cancellation-policy.css">
</head>
<body>
    <form method = "POST">
        <div class="container">
        <h2>Cancellation Policy</h2>
        <div class="policy">
            <p><strong>Flexible Rate:</strong></p>
            <ul>
                <li>Full refund if canceled at least 7 days before check-in.</li>
                <li>50% refund if canceled 2-6 days before check-in.</li>
                <li>No refund if canceled less than 2 days before check-in.</li>
            </ul>
            <p><strong>Non-Refundable Rate:</strong></p>
            <ul>
                <li>No refund for cancellations at any time.</li>
            </ul>
            <p>All cancellations are processed immediately, and refunds (if applicable) will be credited to your original payment method within 7-10 business days.</p>
        </div>

        <h3>Your Bookings</h3>
        <div id="cancellation-success" class="success"></div>
        <p>Please contact support to view or cancel bookings.</p>
        <a class="back-button" href="index.php">Back</a>
    </div>
    </form>    
</body>
</html>
<?php
    }else{
        header('location: login.html');
    }

?>
