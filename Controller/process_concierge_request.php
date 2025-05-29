<?php
session_start();
require_once '../Model/user_model.php';

if (!isset($_SESSION['status'])) {
    header('location: login.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking-id'] ?? '';
    $service = $_POST['service'] ?? '';
    $request_details = $_POST['request-details'] ?? '';

    if (empty($booking_id) || empty($service) || empty($request_details)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
        exit();
    }

    $result = insertConciergeRequest($booking_id, $service, $request_details);
    if ($result === 'success') {
        header('Location: ../view/index.php');
        exit();
    } else {
        header('Location: bookroom.php?error=failed');
        exit();
    }
} else {
    header('Location: bookroom.php?error=invalid');
    exit();
}
?>