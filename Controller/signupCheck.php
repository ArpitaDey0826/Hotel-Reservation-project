<?php
session_start();
require_once '../model/user_model.php'; // Adjust the path if needed

if (isset($_POST['submit'])) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm-password'] ?? '';

    // Password match check
    if ($password !== $confirm_password) {
        $_SESSION['register_errors'] = ["Passwords do not match"];
        header('Location: ../view/signup.html');
        exit();
    }

    $result = registerUser($email, $password);

    if ($result === "exists") {
        $_SESSION['register_errors'] = ["Email already registered"];
        header('Location: ../view/signup.html');
        exit();
    } elseif ($result === "success") {
        $_SESSION['status'] = "Signed up successfully!";
        header('Location: ../view/login.html');
        exit();
    } else {
        $_SESSION['register_errors'] = ["Registration failed"];
        header('Location: ../view/signup.html');
        exit();
    }
} else {
    // Form was not submitted using the "submit" button
    header('Location: ../view/signup.html');
    exit();
}
