<?php

session_start();

$email = '';
$password = '';
$errors = [];

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
            echo "Logged in successfully!";
          
            $_SESSION['user'] = $email;
        } else {
            $errors['general'] = "Invalid email or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head><title>Login</title></head>
<body>
    <h2>Login</h2>

    <?php if (!empty($errors['general'])): ?>
        <p style="color:red;"><?php echo $errors['general']; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br>
        <?php if (!empty($errors['email'])) echo '<span style="color:red;">' . $errors['email'] . '</span><br>'; ?>

        <label>Password:</label><br>
        <input type="password" name="password" required><br>
        <?php if (!empty($errors['password'])) echo '<span style="color:red;">' . $errors['password'] . '</span><br>'; ?>

        <button type="submit">Login</button>
    </form>
</body>
</html>
