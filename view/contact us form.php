<?php
session_start();
$success = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $subject = htmlspecialchars(trim($_POST['subject'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));
    $captchaInput = intval($_POST['captcha'] ?? 0);
    $captchaAnswer = $_SESSION['captcha_answer'] ?? null;

  
    if (empty($name)) $errors[] = "Name is required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
    if (empty($subject)) $errors[] = "Subject is required.";
    if (empty($message)) $errors[] = "Message is required.";
    if ($captchaInput !== $captchaAnswer) $errors[] = "Incorrect CAPTCHA.";

    if (empty($errors)) {
      
        $success = "Thank you! Your message has been sent successfully.";
    }
}

$a = rand(1, 10);
$b = rand(1, 10);
$_SESSION['captcha_answer'] = $a + $b;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - Hotel Reservation</title>
    <style>
      
    </style>
</head>
<body>
<div class="page active">
    <h2>Contact Us - Hotel Reservation</h2>

    <?php if ($success): ?>
        <div class="success"><?= $success ?></div>
    <?php else: ?>
        <?php if (!empty($errors)): ?>
            <ul style="color: red;">
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form method="POST" action="">
            <label>Name:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>

            <label>Subject:</label>
            <input type="text" name="subject" value="<?= htmlspecialchars($_POST['subject'] ?? '') ?>" required>

            <label>Message:</label>
            <textarea name="message" rows="5" required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>

            <label>What is <?= $a ?> + <?= $b ?>?</label>
            <input type="text" name="captcha" required>

            <button type="submit">Submit</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
