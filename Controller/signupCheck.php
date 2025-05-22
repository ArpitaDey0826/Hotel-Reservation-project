<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data directly, no validation
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm-password'] ?? ''; // Not used here, but received

    // Connect to DB
    $con = mysqli_connect('127.0.0.1', 'root', '', 'hotel');
    if (!$con) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Insert user (no password hashing, no validation)
    $sql = "INSERT INTO signup (s_email, s_password) VALUES ('$email', '$password')";

    if (mysqli_query($con, $sql)) {
        $_SESSION['status'] = "Signed up successfully!";
        header('Location: ../view/login.html');
        exit();
    } else {
        $_SESSION['register_errors'] = ["Registration failed: " . mysqli_error($con)];
        header('Location: ../view/signup.html');
        exit();
    }

    mysqli_close($con);
} else {
    // Not a POST request
    header('Location: ../view/signup.html');
    exit();
}
