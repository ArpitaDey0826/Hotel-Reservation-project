<?php
$name = $email = $phone = $location = $checkin = $checkout = $guests = '';
$errors = [];
$success = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $name = trim($_POST["name"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $phone = trim($_POST["phone"] ?? '');
    $location = trim($_POST["location"] ?? '');
    $checkin = $_POST["check-in"] ?? '';
    $checkout = $_POST["check-out"] ?? '';
    $guests = $_POST["guests"] ?? '';

  
    if (empty($name)) {
        $errors['name'] = "Name is required.";
    }

   
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Valid email is required.";
    }

    if (empty($phone) || strlen($phone) < 10) {
        $errors['phone'] = "Phone number must be at least 10 digits.";
    }

    if (empty($location)) {
        $errors['location'] = "Location is required.";
    }

    if (empty($checkin)) {
        $errors['checkin'] = "Check-in date is required.";
    } elseif (strtotime($checkin) < strtotime(date('Y-m-d'))) {
        $errors['checkin'] = "Check-in date cannot be in the past.";
    }

    if (empty($checkout)) {
        $errors['checkout'] = "Check-out date is required.";
    } elseif (!empty($checkin) && strtotime($checkout) <= strtotime($checkin)) {
        $errors['checkout'] = "Check-out must be after check-in.";
    }

    if (empty($guests) || $guests < 1 || $guests > 10) {
        $errors['guests'] = "Guests must be between 1 and 10.";
    }

    if (empty($errors)) {
        $success = "Form submitted successfully!";
       
    }
}
?>
