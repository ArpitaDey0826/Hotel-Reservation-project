<?php
session_start();

$email = '';
$password = '';
$errors = [];
$login_success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email address.";
    }

   
    if (empty($password)) {
        $errors['password'] = "Password is required.";
    }

   
    if (empty($errors)) {
       
        if ($email === "user@example.com" && $password === "password123") {
            $login_success = true;
            $_SESSION['user'] = $email; 
        } else {
            $errors['general'] = "Invalid email or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <style>
        .container { max-width: 400px; margin: 50px auto; font-family: Arial, sans-serif; }
        .error { color: red; font-size: 0.9em; }
        .success { color: green; font-size: 1em; margin-bottom: 10px; }
        label, input { display: block; width: 100%; margin-bottom: 5px; }
        input { padding: 8px; margin-bottom: 10px; }
        button { padding: 10px 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>

        <?php if ($login_success): ?>
            <div class="success">Logged in successfully!</div>
        <?php endif; ?>

        <?php if (!empty($errors['general'])): ?>
            <div class="error"><?php echo $errors['general']; ?></div>
        <?php endif; ?>

        <form method="post" action="">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($email); ?>">
            <?php if (!empty($errors['email'])): ?>
                <div class="error"><?php echo $errors['email']; ?></div>
            <?php endif; ?>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <?php if (!empty($errors['password'])): ?>
                <div class="error"><?php echo $errors['password']; ?></div>
            <?php endif; ?>

            <button type="submit">Login</button>
        </form>

        <p><a href="signup.html">Don't have an account? Sign up</a></p>
        <p><a href="forgot-password.html">Forgot your password?</a></p>
    </div>
</body>
</html>
