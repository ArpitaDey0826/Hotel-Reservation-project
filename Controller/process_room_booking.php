<?php
session_start();
require_once '../Model/user_model.php';

if (!isset($_SESSION['status'])) {
    header('Location: ../view/login.php');
    exit();
}

if (isset($_POST['submit'])) {
    $guest_name = $_POST['guest-name'] ?? '';
    $room_type = $_POST['room-type'] ?? '';
    $check_in_date = $_POST['check-in'] ?? '';
    $check_out_date = $_POST['check-out'] ?? '';
    $rate_type = $_POST['rate-type'] ?? '';

    if (empty($guest_name) || empty($room_type) || empty($check_in_date) || empty($check_out_date) || empty($rate_type)) {
        header('Location: ../view/book-room.php?error=empty');
        exit();
    }

    $result = insertRoomBooking($guest_name, $room_type, $check_in_date, $check_out_date, $rate_type);
    if ($result === 'success') {
        header('Location: ../view/billing-summary.php');
        exit();
    } else {
        echo "Booking Failed. Reason: $result";
        header('Location: ../view/book-room.php?error=failed');
        exit();
    }
} else {
    header('Location: ../view/book-room.php?error=invalid');
    exit();
}
?>
