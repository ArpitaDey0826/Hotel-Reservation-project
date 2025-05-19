<?php
session_start();
$errors = [];
$success = false;

if (!isset($_SESSION['captcha_answer'])) {
    $_SESSION['captcha_answer'] = rand(1, 10) + rand(1, 10);
}
$captchaQuestion = $_SESSION['captcha_answer'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
   
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $captchaInput = intval($_POST['captcha'] ?? 0);

    if (empty($name)) $errors[] = "Name is required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "A valid email is required.";
    if (empty($subject)) $errors[] = "Subject is required.";
    if (empty($message)) $errors[] = "Message is required.";
    if ($captchaInput !== $_SESSION['captcha_answer']) $errors[] = "Incorrect CAPTCHA.";

    if (empty($errors)) {
    
        $success = true;
        unset($_SESSION['captcha_answer']); 
    } else {
        
        $_SESSION['captcha_answer'] = rand(1, 10) + rand(1, 10);
        $captchaQuestion = $_SESSION['captcha_answer'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - PHP Validation</title>
    <style>
        body { font-family: Arial; padding: 40px; background: #f9f9f9; }
        form { background: #fff; padding: 20px; max-width: 500px; margin: auto; border-radius: 10px; box-shadow: 0 0 10px #ccc; }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0; }
        .error { color: red; }
        .success { color: green; font-size: 18px; text-align: center; }
    </style>
</head>
<body>

<?php if ($success): ?>
    <div class="success">Thank you! Your message has been submitted successfully.</div>
<?php else: ?>
    <form method="post" action="">
        <h2>Contact Us</h2>

        <?php if (!empty($errors)): ?>
            <div class="error">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <label>Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($name ?? '') ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>" required>

        <label>Subject:</label>
        <input type="text" name="subject" value="<?= htmlspecialchars($subject ?? '') ?>" required>

        <label>Message:</label>
        <textarea name="message" rows="4" required><?= htmlspecialchars($message ?? '') ?></textarea>

        <label>CAPTCHA: What is <?= $captchaQuestion ?>?</label>
        <input type="text" name="captcha" required>

        <button type="submit">Submit</button>
    </form>
<?php endif; ?>

</body>
</html>
