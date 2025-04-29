<?php
session_start();

$errors = [];
$success = false;

if (!isset($_SESSION['captcha_result'])) {
    $num1 = rand(1, 10);
    $num2 = rand(1, 10);
    $_SESSION['captcha_result'] = $num1 + $num2;
} else {
    $num1 = rand(1, 10);
    $num2 = rand(1, 10);
    $_SESSION['captcha_result'] = $num1 + $num2;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $captcha = trim($_POST['captcha'] ?? '');

    if (empty($name)) $errors[] = "Name is required.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
    if (empty($subject)) $errors[] = "Subject is required.";
    if (empty($message)) $errors[] = "Message is required.";

    if ((int)$captcha !== $_SESSION['captcha_result']) {
        $errors[] = "Incorrect CAPTCHA answer.";
    }

    if (empty($errors)) {
        $success = true;
        session_destroy();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us - Hotel Reservation</title>
  <style>
    * { box-sizing: border-box; }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      padding: 40px 20px;
      margin: 0;
      background: linear-gradient(to right, #fdfcfb, #e2d1c3);
      display: flex;
      justify-content: center;
      align-items: flex-start;
      min-height: 100vh;
    }
    .page {
      max-width: 600px;
      width: 100%;
      background: #fff;
      padding: 30px 25px;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
      animation: fadeIn 0.4s ease-in-out;
    }
    h2 { text-align: center; color: #2c3e50; margin-bottom: 25px; }
    label { font-weight: bold; color: #2c3e50; }
    input, textarea {
      width: 100%;
      padding: 12px 14px;
      margin-top: 6px;
      margin-bottom: 18px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1rem;
    }
    input:focus, textarea:focus {
      border-color: #b48a56;
      outline: none;
    }
    .captcha { margin: 15px 0; }
    button {
      width: 100%;
      background: #b48a56;
      color: white;
      border: none;
      padding: 12px;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
    }
    button:hover { background: #a97639; transform: translateY(-2px); }
    .success { color: #27ae60; font-size: 1.2em; text-align: center; margin-bottom: 15px; }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
<?php if ($success): ?>
  <div class="page">
    <h2>Thank You!</h2>
    <p class="success">Your message has been submitted successfully.</p>
    <p style="text-align:center;">An auto-receipt email has been sent to your inbox (simulated).</p>
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>"><button>Send Another</button></a>
  </div>
<?php else: ?>
  <div class="page">
    <h2>Contact Us - Hotel Reservation</h2>
    <?php if (!empty($errors)): ?>
      <div style="color:red; margin-bottom:15px;">
        <ul>
          <?php foreach ($errors as $error): ?>
            <li><?php echo htmlspecialchars($error); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
      <label for="name">Name:</label>
      <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name ?? ''); ?>" required>

      <label for="email">Email:</label>
      <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>

      <label for="subject">Subject:</label>
      <input type="text" name="subject" id="subject" value="<?php echo htmlspecialchars($subject ?? ''); ?>" required>

      <label for="message">Message:</label>
      <textarea name="message" id="message" rows="5" required><?php echo htmlspecialchars($message ?? ''); ?></textarea>

      <div class="captcha">
        <label><?php echo "What is $num1 + $num2?"; ?></label>
        <input type="text" name="captcha" placeholder="Enter CAPTCHA" required>
      </div>

      <button type="submit">Submit</button>
    </form>
  </div>
<?php endif; ?>
</body>
</html>
