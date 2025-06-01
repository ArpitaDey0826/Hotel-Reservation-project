<?php
session_start();
require_once '../Model/user_model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($email === "admin@gmail.com" && $password === "admin123") {
        $_SESSION['username'] = 'admin';
        $_SESSION['status'] = "Admin logged in";
        header('Location: ../view/dashboard.php');
        exit();
    }

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
