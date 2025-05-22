<?php
session_start();

if (isset($_POST['submit'])) {
    // Get submitted email and password directly (no escaping)
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Connect to DB
    $con = mysqli_connect('127.0.0.1', 'root', '', 'hotel');
    if (!$con) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Directly insert variables into SQL query (UNSAFE)
    $sql = "SELECT * FROM signup WHERE s_email = '$email' AND s_password = '$password'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) === 1) {
        $_SESSION['username'] = $email;
        $_SESSION['status'] = "Login successful!";
        header('Location: ../view/index.html');
        exit();
    } else {
        $_SESSION['login_error'] = "Invalid email or password!";
        header('Location: ../view/login.php');
        exit();
    }

    mysqli_close($con);
} else {
    // Form not submitted properly
    header('Location: ../view/login.php');
    exit();
}