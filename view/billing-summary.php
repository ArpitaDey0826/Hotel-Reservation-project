<?php
    session_start();
    if(isset($_SESSION['status'])){ 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Summary</title>
    <link rel="stylesheet" href="../Assets/css/billing-summary.css">
</head>
<body>
    <form method="POST" action="../Controller/process_billing_summary.php"  onsubmit="return validateReceipt();">
        <div class="container">
            <h2>Billing Summary</h2>
            <div id="billing-success" class="success">Receipt generated successfully!</div>
            <div id="billing-error" class="error"></div>

            <h3>Generate Receipt</h3>
            <label for="booking-id">Booking Name:</label>
            <input type="text" id="booking-id" name="booking-id" >
            <div id="booking-id-error" class="error">Please enter a valid Booking ID</div>

            <label for="email">Email for Receipt:</label>
            <input type="email" id="email" name="email" >
            <div id="email-error" class="error">Please enter a valid email address.</div>
            
            <label for="split">Split:</label>
            <input type="number" id="split" name="split"  min="0" value="1" >

            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" placeholder="Amount" min="0" >

            <label for="method">Payment Method:</label>
            <select id="method" name="method" >
                <option value="">Select method</option>
                <option value="card">Card</option>
                <option value="cash">Cash</option>
            </select>

            <label for="payer">Payer Name:</label>
            <input type="text" id="payer" name="payer" placeholder="Payer Name" >

            <button type="submit" name="submit">Generate Receipt</button>
            <a class="back-button" onclick="history.back()">Back</a>
        </div>
    </form>
    <script src="../Assets/js/billing-summary.js"></script>
</body>
</html>
<?php
    } else {
        header('location: login.php');
    }
?>
