<?php
session_start();
$loginError = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../Assets/css/styles.css">
</head>
<body>
    <form method="POST" action="../Controller/loginCheck.php" onsubmit="return validateLogin()">
        <div class="container">
            <h2>Login</h2>

            <?php if ($loginError): ?>
                <div id="login-error" class="error" style="display: block;">
                    <?= htmlspecialchars($loginError) ?>
                </div>
            <?php else: ?>
                <div id="login-error" class="error" style="display: none;"></div>
            <?php endif; ?>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            <div id="email-error" class="error" style="display: none;">Please enter a valid email address.</div>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <div id="password-error" class="error" style="display: none;">Please enter a password.</div>

            <button type="submit" name="submit">Login</button>

            <p><a href="signup.php">Don't have an account? Sign up</a></p>
            <p><a href="forgot-password.php">Forgot your password?</a></p>
        </div>
    </form>
    <script src="../Assets/js/login.js"></script>
</body>
</html>
