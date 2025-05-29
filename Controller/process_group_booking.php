<?php
session_start();
require_once '../Model/user_model.php';

if (!isset($_SESSION['status'])) {
    header('Location: ../view/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $group_name = $_POST['group-name'] ?? '';
    $contact_email = $_POST['contact-email'] ?? '';
    $room_number = $_POST['room-number'] ?? '';
    $check_in = $_POST['check-in'] ?? '';
    $check_out = $_POST['check-out'] ?? '';
    $payment_terms = $_POST['payment-terms'] ?? '';
    $event_space = $_POST['event-space'] ?? '';

    if (
        empty($group_name) ||
        empty($contact_email) || !filter_var($contact_email, FILTER_VALIDATE_EMAIL) ||
        empty($room_number) || !is_numeric($room_number) || $room_number <= 0 ||
        empty($check_in) || empty($check_out) || $check_in >= $check_out ||
        empty($payment_terms) ||
        empty($event_space)
    ) {
        header('Location: ../view/group-bookings.php?error=invalid_input');
        exit();
    }

    $result = insertGroupBooking($group_name, $contact_email, $room_number, $check_in, $check_out, $payment_terms, $event_space);

    if ($result === 'success') {
        header('Location: ../view/billing-summary.php');
        exit();
    } else {
        header('Location: ../view/group-bookings.php?error=failed');
        exit();
    }
} else {
    header('Location: ../view/group-bookings.php?error=invalid_request');
    exit();
}
?>
