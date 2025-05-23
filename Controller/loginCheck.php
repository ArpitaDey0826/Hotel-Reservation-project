<?php
session_start();
require_once '../model/user_model.php'; // Adjust path as needed

if (isset($_POST['submit'])) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (loginUser($email, $password)) {
        $_SESSION['username'] = $email;
        $_SESSION['status'] = "Login successful!";
        header('Location: ../view/index.php');
        exit();
    } else {
        $_SESSION['login_error'] = "Invalid email or password!";
        header('Location: ../view/login.php');
        exit();
    }
} else {
    header('Location: ../view/login.php');
    exit();
}
