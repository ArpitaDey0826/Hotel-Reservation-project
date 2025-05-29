<?php
    session_start();
    if(isset($_SESSION['status'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review System</title>
    <link rel="stylesheet" href="../Assets/css/review-system.css">
</head>
<body>
    <form method="POST">
        <div class="container">
        <h2>Review System</h2>

        <div id="submission-form">
            <h3>Submit a Review</h3>
            <div id="review-success" class="success">Review submitted successfully!</div>
            <label for="rating">Star Rating:</label>
            <select id="rating" name="rating" required>
                <option value="">Select rating</option>
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
            </select>
            <div id="rating-error" class="error">Please select a rating.</div>
            <label for="comment">Comment:</label>
            <textarea id="comment" name="comment" rows="4" required></textarea>
            <div id="comment-error" class="error">Please enter a comment (5-500 characters).</div>
            <label for="traveler-type">Traveler Type:</label>
            <select id="traveler-type" name="traveler-type" required>
                <option value="">Select traveler type</option>
                <option value="solo">Solo</option>
                <option value="couple">Couple</option>
                <option value="family">Family</option>
                <option value="business">Business</option>
            </select>
            <div id="traveler-type-error" class="error">Please select a traveler type.</div>
            <button onclick="validateReview()">Submit Review</button>
            <a class="back-button" href="index.php">Back</a>
        </div>

        <div id="review-display">
            <h3>Reviews</h3>
            <p>Please contact support to view reviews.</p>
        </div>
    </div>
    </form>
    <script src="../Assets/js/review-system.js"></script>
</body>
</html>
<?php
    }else{
        header('location: login.html');
    }
?>