<?php
    session_start();
    if(isset($_COOKIE['status'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Summary</title>
    <link rel="stylesheet" href="../assets/css/billing-summary.css">
</head>
<body>
    <form method = "POST">
        <div class="container">
        <h2>Billing Summary</h2>
        <div id="billing-success" class="success">Receipt generated successfully!</div>
        <div id="billing-error" class="error"></div>

        <h3>Generate Receipt</h3>
        <label for="booking-id">Booking ID:</label>
        <input type="text" id="booking-id" required>
        <div id="booking-id-error" class="error">Please enter a valid Booking ID (e.g., BK12345 or GB12345).</div>
        <label for="email">Email for Receipt:</label>
        <input type="email" id="email" required>
        <div id="email-error" class="error">Please enter a valid email address.</div>
        <label for="split-count">Number of Payment Splits:</label>
        <input type="number" id="split-count" min="1" value="1" required>
        <div id="split-count-error" class="error">Please enter a valid number (minimum 1).</div>
        <div id="split-entries"></div>
        <button onclick="validateReceipt()">Generate Receipt</button>
        <a class="back-button" href="index.php">Back</a>
    </div>
    </form>
    <script src="../assets/js/billing-summary.js"></script>
</body>
</html>
<?php
    }else{
        header('location: login.html');
    }

?>