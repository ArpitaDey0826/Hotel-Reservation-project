<?php
session_start();
require_once '../Model/user_model.php';

if (!isset($_SESSION['status'])) {
    header('location: ../view/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking-id'] ?? '';
    $service = $_POST['service'] ?? '';
    $request_details = $_POST['request-details'] ?? '';

    if (empty($booking_id) || empty($service) || empty($request_details)) {
    echo "All fields are required.";
    exit();
}

    $result = insertConciergeRequest( $service, $request_details, $booking_id);
    if ($result === 'success') {
        header('Location: ../view/index.php');
        exit();
    } else {
        header('Location: ../view/concierge-requests.php?error=failed');
        exit();
    }
} else {
    header('Location: ../view/concierge-requests.php?error=invalid');
    exit();
}
?>