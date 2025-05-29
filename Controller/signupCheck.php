<?php
session_start();
require_once '../model/user_model.php'; 

if (isset($_POST['submit'])) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm-password'] ?? '';

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
        header('Location: ../view/login.php');
        exit();
    } else {
        $_SESSION['register_errors'] = ["Registration failed"];
        header('Location: ../view/signup.html');
        exit();
    }
} else {
    header('Location: ../view/signup.html');
    exit();
}
