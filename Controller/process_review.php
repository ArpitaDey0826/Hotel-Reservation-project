<?php
session_start();
require_once '../Model/user_model.php';

if (!isset($_SESSION['status'])) {
    header('Location: ../view/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rating = $_POST['rating'] ?? '';
    $comment = $_POST['comment'] ?? '';
    $traveler_type = $_POST['traveler-type'] ?? '';

     if (empty($rating) || empty($comment) || empty($traveler_type)) {
        echo "All fields are required";
        exit();
    }

    $result = insertReview($rating, $comment, $traveler_type);
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