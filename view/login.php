<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
  <link rel="stylesheet" href="../Assets/css/styles.css" />
</head>
<body>
  <form method="POST" action="../Controller/loginCheck.php" onsubmit="return validateLogin()">
    <div class="container">
      <h2>Login</h2>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required />
      <span id="email-error" class="error"></span>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required />
      <span id="password-error" class="error"></span>

      <button type="submit" name="submit">Login</button>

      <p><a href="signup.html">Don't have an account? Sign up</a></p>
      <p><a href="forgot-password.html">Forgot your password?</a></p>

      <?php      
      session_start();
      if (isset($_SESSION['login_error'])) {
          echo '<p style="color:red;">' . $_SESSION['login_error'] . '</p>';
          unset($_SESSION['login_error']);
      }
      ?>
    </div>
  </form>

  <script src="../Assets/js/login.js"></script>    
</body>
</html>
