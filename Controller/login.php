<?php
session_start();
$email = $password = '';
$emailError = $passwordError = $loginError = $loginSuccess = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validate email
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'Please enter a valid email address.';
    }

    // Validate password
    if (empty($password)) {
        $passwordError = 'Please enter your password.';
    }

    // If no validation errors
    if (empty($emailError) && empty($passwordError)) {
        // Replace this with actual database check
        if ($email === "admin@example.com" && $password === "admin123") {
            $_SESSION['status'] = 'loggedin';
            $loginSuccess = 'Login successful!';
            header("Location: dashboard.php");
            exit();
        } else {
            $loginError = 'Invalid email or password.';
        }
    }
}
?>
