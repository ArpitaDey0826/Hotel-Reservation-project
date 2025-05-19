<?php
$errors = [];
$successMessage = "";
$name = $email = $phone = $location = $checkIn = $checkOut = $guests = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
   
    $name = trim($_POST["name"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $phone = trim($_POST["phone"] ?? '');
    $location = trim($_POST["location"] ?? '');
    $checkIn = $_POST["check_in"] ?? '';
    $checkOut = $_POST["check_out"] ?? '';
    $guests = $_POST["guests"] ?? '';

    if (empty($name)) {
        $errors['name'] = "Name is required.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email address.";
    }

    if (empty($phone) || !preg_match('/^\d{10,}$/', $phone)) {
        $errors['phone'] = "Phone must be at least 10 digits.";
    }

    if (empty($location)) {
        $errors['location'] = "Please select a location.";
    }

    if (empty($checkIn)) {
        $errors['check_in'] = "Check-in date is required.";
    }

    if (empty($checkOut)) {
        $errors['check_out'] = "Check-out date is required.";
    } elseif (!empty($checkIn) && $checkOut <= $checkIn) {
        $errors['check_out'] = "Check-out must be after check-in.";
    }

    if (empty($guests) || $guests < 1 || $guests > 10) {
        $errors['guests'] = "Guests must be between 1 and 10.";
    }

    if (empty($errors)) {
        $successMessage = "Form submitted successfully!";
    
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Reservation - PHP Validation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .error-message { color: red; font-size: 13px; }
        .success-message { color: green; font-size: 16px; margin-top: 15px; }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Hotel Reservation Form</h2>

    <?php if (!empty($successMessage)): ?>
        <div class="success-message"><?= $successMessage ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($name) ?>">
            <div class="error-message"><?= $errors['name'] ?? '' ?></div>
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($email) ?>">
            <div class="error-message"><?= $errors['email'] ?? '' ?></div>
        </div>

        <div class="form-group">
            <label>Phone:</label>
            <input type="tel" name="phone" class="form-control" value="<?= htmlspecialchars($phone) ?>">
            <div class="error-message"><?= $errors['phone'] ?? '' ?></div>
        </div>

        <div class="form-group">
            <label>Location:</label>
            <select name="location" class="form-control">
                <option value="">Select Location</option>
                <option value="new-york" <?= $location == 'new-york' ? 'selected' : '' ?>>New York</option>
                <option value="los-angeles" <?= $location == 'los-angeles' ? 'selected' : '' ?>>Los Angeles</option>
                <option value="chicago" <?= $location == 'chicago' ? 'selected' : '' ?>>Chicago</option>
            </select>
            <div class="error-message"><?= $errors['location'] ?? '' ?></div>
        </div>

        <div class="form-group">
            <label>Check-in Date:</label>
            <input type="date" name="check_in" class="form-control" value="<?= htmlspecialchars($checkIn) ?>">
            <div class="error-message"><?= $errors['check_in'] ?? '' ?></div>
        </div>

        <div class="form-group">
            <label>Check-out Date:</label>
            <input type="date" name="check_out" class="form-control" value="<?= htmlspecialchars($checkOut) ?>">
            <div class="error-message"><?= $errors['check_out'] ?? '' ?></div>
        </div>

        <div class="form-group">
            <label>Number of Guests:</label>
            <input type="number" name="guests" class="form-control" min="1" max="10" value="<?= htmlspecialchars($guests) ?>">
            <div class="error-message"><?= $errors['guests'] ?? '' ?></div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
