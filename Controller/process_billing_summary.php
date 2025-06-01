<?php
session_start();
require_once '../Model/user_model.php';

if (!isset($_SESSION['status'])) {
    header('Location: ../view/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking-id'] ?? '';
    $email = $_POST['email'] ?? '';
    $split_count = $_POST['split'] ?? '';
    $amount = $_POST['amount'] ?? '';
    $method = $_POST['method'] ?? '';
    $payer = $_POST['payer'] ?? '';

    if (empty($booking_id) || empty($email) || empty($split_count) || empty($amount) || empty($method) || empty($payer)) {
        header('Location: ../view/billing-summary.php?error=empty_fields');
        exit();
    }

    $result = insertBillingSummary($booking_id, $email, $split_count, $amount, $method, $payer);

    if ($result === 'success') {
        header('Location: ../view/index.php?message=success');
        exit();
    } else {
        echo $result;
        header('Location: ../view/billing-summary.php?error=failed');
        exit();
    }
} else {
    header('Location: ../view/billing-summary.php?error=invalid_request');
    exit();
}
?>
