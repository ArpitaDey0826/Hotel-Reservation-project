<?php
session_start();

$email = $password = '';
$emailError = $passwordError = $loginError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'Please enter a valid email address.';
    }

    if (empty($password)) {
        $passwordError = 'Please enter your password.';
    }

    if (empty($emailError) && empty($passwordError)) {
        if ($email === "admin@example.com" && $password === "admin123") {
            $_SESSION['status'] = 'loggedin';
            header("Location: ../view/dashboard.php");
            exit();
        } else {
            $loginError = 'Invalid email or password.';
        }
    }
}
?>
